ajouter enumeration


---

##  Implémentation d’énumérations (ENUM) PostgreSQL avec Symfony, Doctrine et PHP 8.1+

Ce projet utilise des `enum` PHP modernes (`ReactionType`, `NotificationType`) stockés comme **types ENUM natifs PostgreSQL**, avec une conversion automatique assurée par **Doctrine**. Voici les étapes suivies pour garantir une intégration propre et scalable :

---

### 1. Déclaration de l’`enum` PHP

```php
// src/Enum/ReactionType.php
namespace App\Enum;

enum ReactionType: string
{
    case LIKE = 'like';
    case LOVE = 'love';
    case HAHA = 'haha';
    case WOW  = 'wow';
    case GRRR = 'grrr';
}
```

---

### 2. Création d’un type Doctrine personnalisé

```php
// src/DBAL/Types/ReactionTypeType.php
namespace App\DBAL\Types;

use App\Enum\ReactionType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class ReactionTypeType extends Type
{
    public const NAME = 'reaction_type';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        return ReactionType::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value instanceof ReactionType ? $value->value : throw new \InvalidArgumentException();
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
```

---

### 3. Enregistrement dans `doctrine.yaml`

```yaml
# config/packages/doctrine.yaml
doctrine:
  dbal:
    types:
      reaction_type: App\DBAL\Types\ReactionTypeType
      notification_type: App\DBAL\Types\NotificationTypeType
```

---

### 4. Enregistrement global (nécessaire pour les migrations)

Dans `src/Kernel.php` :

```php
use Doctrine\DBAL\Types\Type;

protected function boot(): void
{
    parent::boot();

    if (!Type::hasType('reaction_type')) {
        Type::addType('reaction_type', \App\DBAL\Types\ReactionTypeType::class);
    }

    if (!Type::hasType('notification_type')) {
        Type::addType('notification_type', \App\DBAL\Types\NotificationTypeType::class);
    }
}
```

---

### 5. Utilisation dans les entités

```php
#[ORM\Column(type: ReactionTypeType::NAME, enumType: ReactionType::class)]
private ReactionType $type;
```

---

### 6. Création manuelle des types ENUM dans PostgreSQL

Ajout dans une migration Doctrine :

```php
$this->addSql("CREATE TYPE reaction_type AS ENUM ('like', 'love', 'haha', 'wow', 'grrr');");
$this->addSql("CREATE TYPE notification_type AS ENUM ('reaction', 'comment', 'validation', 'alert', 'info');");
```

---

### 7. Correction manuelle des types dans les colonnes

Remplacer ce que Doctrine génère parfois à tort :

```sql
type 'like','love','haha' ...
```

par :

```sql
type reaction_type NOT NULL
```

---

### 8. Migration

```bash
php bin/console doctrine:migrations:migrate
```

---

### 9. Vérification dans PostgreSQL

```sql
\d+ reaction;
\d+ notification;
```

Les colonnes `type` doivent être de type `reaction_type` et `notification_type`.

---

### 10. Fonctionnement automatique

Doctrine convertit automatiquement vers/depuis l’`enum` PHP :

```php
$reaction = new Reaction();
$reaction->setType(ReactionType::LIKE);

$repo->find(1)->getType()->value; // "like"
```

---

### ✅ Résultat

* ✅ Enums PHP modernes
* ✅ Types ENUM PostgreSQL natifs
* ✅ Conversion automatique Doctrine
* ✅ Architecture propre et stricte
* ✅ Prêt pour API Platform, formulaires, validation, etc.

---

