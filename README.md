 **guide complet en Markdown** pour documenter proprement l’approche basée sur l’article d’Ángel Cardiel (avec `AbstractEnumType`) que tu peux coller directement dans ton `README.md` :

---

````md
## 🧩 Intégration des types ENUM PostgreSQL avec Symfony + Doctrine (méthode `AbstractEnumType`)

Ce projet utilise une approche compatible avec PostgreSQL et Doctrine pour intégrer des types ENUM (par exemple : `reaction_type`, `notification_type`) en s'inspirant de la méthode `AbstractEnumType` décrite par Ángel Cardiel.

Cette solution permet :

- De stocker les valeurs ENUM comme vrais types PostgreSQL (`CREATE TYPE ... AS ENUM`)
- De faire le mapping proprement dans Doctrine
- D’éviter les erreurs `Unknown database type ...`
- De rester compatible avec Symfony, même sans utiliser les `enum` PHP 8.1+

---

### 🧱 1. Création d’une classe `AbstractEnumType`

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
````

---

### 🧩 2. Définition d’un type ENUM concret

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

Même chose pour `ReactionTypeType`.

---

### ⚙️ 3. Configuration dans `doctrine.yaml`

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

### 🧬 4. Enregistrement dans le `Kernel`

```php
// src/Kernel.php

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

### 🧾 5. Utilisation dans une entité

```php
#[ORM\Column(type: 'notification_type')]
private string $type;
```

---

### 🗃️ 6. Création des types ENUM dans la base PostgreSQL

Ajoute manuellement dans ta migration Doctrine :

```php
$this->addSql("CREATE TYPE notification_type AS ENUM ('reaction', 'comment', 'validation', 'alert', 'info');");
$this->addSql("CREATE TYPE reaction_type AS ENUM ('like', 'love', 'haha', 'wow', 'grrr');");
```

Et dans la création de table :

```sql
type notification_type NOT NULL
```

---

### ✅ Résultat

* Migration possible avec `make:migration` sans erreur
* Conversion automatique Doctrine ↔ PostgreSQL
* Données sécurisées via ENUM natif PostgreSQL
* Code maintenable et évolutif

---

