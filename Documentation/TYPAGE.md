## Guide basé sur **la méthode inspirée de l'article d'Ángel Cardiel**, avec la classe `AbstractEnumType` et PostgreSQL.

---

## 🎯 Utilisation des types ENUM PostgreSQL personnalisés avec Symfony + Doctrine

Ce projet utilise une méthode propre et compatible PostgreSQL pour gérer des types ENUM, sans s'appuyer sur les `enum PHP 8.1+`.
On suit ici la méthode inspirée de l’article d’Ángel Cardiel, avec une classe abstraite `AbstractEnumType`.

---

### ✅ Objectifs

* Utiliser de vrais types `ENUM` PostgreSQL (`reaction_type`, `notification_type`)
* Les mapper proprement dans Doctrine
* Éviter les erreurs `Unknown database type` lors des migrations
* Conserver un code compatible avec Symfony, Doctrine et PostgreSQL

---

### 🧱 1. Créer la classe `AbstractEnumType`

```php
// src/DBAL/Types/AbstractEnumType.php

namespace App\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class AbstractEnumType extends Type
{
    protected string $schema = 'public';
    protected string $name;
    protected array $values = [];

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $this->schema . '."' . $this->getName() . '"';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if (!in_array($value, $this->getValidValues(), true)) {
            throw new \InvalidArgumentException("Invalid '{$this->name}' value.");
        }

        return $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getValidValues(): array
    {
        return $this->values;
    }
}
```

---

### 🔧 2. Créer les types concrets

#### `NotificationTypeType`

```php
// src/DBAL/Types/NotificationTypeType.php

namespace App\DBAL\Types;

class NotificationTypeType extends AbstractEnumType
{
    protected string $name = 'notification_type';
    protected array $values = [
        'reaction',
        'comment',
        'validation',
        'alert',
        'info',
    ];
}
```

#### `ReactionTypeType`

```php
// src/DBAL/Types/ReactionTypeType.php

namespace App\DBAL\Types;

class ReactionTypeType extends AbstractEnumType
{
    protected string $name = 'reaction_type';
    protected array $values = [
        'like',
        'love',
        'haha',
        'wow',
        'grrr',
    ];
}
```

---

### ⚙️ 3. Enregistrer les types dans `doctrine.yaml`

```yaml
doctrine:
  dbal:
    types:
      notification_type: App\DBAL\Types\NotificationTypeType
      reaction_type: App\DBAL\Types\ReactionTypeType
    mapping_types:
      notification_type: string
      reaction_type: string
```

---

### 🧠 4. Enregistrement au boot dans `Kernel.php`

```php
use App\DBAL\Types\NotificationTypeType;
use App\DBAL\Types\ReactionTypeType;
use Doctrine\DBAL\Types\Type;

public function boot(): void
{
    parent::boot();

    if (!Type::hasType('notification_type')) {
        Type::addType('notification_type', NotificationTypeType::class);
    }

    if (!Type::hasType('reaction_type')) {
        Type::addType('reaction_type', ReactionTypeType::class);
    }
}
```

---

### 🧬 5. Utilisation dans les entités

```php
#[ORM\Column(type: 'notification_type')]
private string $type;
```

> ✅ Pas besoin d’utiliser une `enum PHP`, car les valeurs sont validées via `AbstractEnumType`.

---

### 🛠️ 6. Créer manuellement les types ENUM dans PostgreSQL

Dans ta migration :

```php
$this->addSql("CREATE TYPE reaction_type AS ENUM ('like', 'love', 'haha', 'wow', 'grrr');");
$this->addSql("CREATE TYPE notification_type AS ENUM ('reaction', 'comment', 'validation', 'alert', 'info');");
```

Et dans les colonnes :

```sql
type reaction_type NOT NULL
```

---

### ✅ Résultat

* 🎯 Types ENUM PostgreSQL natifs
* ⚙️ Doctrine comprend parfaitement les colonnes
* ✅ Pas de bug `Unknown database type`
* 🧼 Code clair, sans `enum PHP`, mais 100% strict et validé

---

