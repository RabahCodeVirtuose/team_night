
---

## 🔁 1. **Où sont stockés les rôles ?**

Les rôles sont généralement stockés dans l'entité `User` (ou `Users` dans ton cas) sous forme de tableau de chaînes :

```php
#[ORM\Column]
private array $roles = [];
```

Et tu as un getter comme :

```php
public function getRoles(): array
{
    $roles = $this->roles;
    // Symfony exige que chaque utilisateur ait au moins ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
}
```

👉 Tu peux les stocker en BDD en JSON (PostgreSQL gère bien ça), ou juste comme texte si tu fais le mapping toi-même.

---

## 🧠 2. **Comment Symfony utilise ces rôles ?**

Symfony utilise ces rôles dans **le système de sécurité**, pour :

* Contrôler l’accès à certaines pages ou routes (via `security.yaml`)
* Montrer ou cacher des boutons dans Twig
* Empêcher des actions via des annotations ou contrôles explicites dans les contrôleurs

---

## 🔐 3. **Contrôle d'accès dans `security.yaml`**

Tu peux faire un contrôle global :

```yaml
access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
    - { path: ^/profile, roles: ROLE_USER }
```

Ou plus finement, par annotation dans un contrôleur :

```php
#[IsGranted('ROLE_ADMIN')]
public function adminDashboard() { ... }
```

Ou dans un `Voter`.

---

## ✅ 4. **Comment donner un rôle à un utilisateur ?**

Soit :

* Manuellement en base de données : `["ROLE_ADMIN"]`
* Via une interface admin dans ton application
* Ou dans des fixtures :

```php
$user->setRoles(['ROLE_ADMIN']);
```

⚠️ Les rôles doivent **toujours commencer par `ROLE_`** sinon Symfony les ignore.

---

## 🧪 5. **Comment tester si un utilisateur a un rôle ?**

Dans un contrôleur :

```php
$this->isGranted('ROLE_ADMIN') // true ou false
```

Dans un template Twig :

```twig
{% if is_granted('ROLE_ADMIN') %}
    <a href="/admin">Admin</a>
{% endif %}
```

---

## 🧱 6. **Structure complète du cycle des rôles**

| Étape        | Détail                                                                 |
| ------------ | ---------------------------------------------------------------------- |
| Stockage     | Dans la BDD via l'entité `User`, champ `roles` (array)                 |
| Récupération | Méthode `getRoles()` dans l'entité                                     |
| Utilisation  | `security.yaml`, annotations, votants                                  |
| Sécurité     | Symfony lit les rôles de l'utilisateur connecté et applique les règles |
| Affectation  | Manuellement, via admin, ou via des scripts                            |

---

### 🔥 Tu veux aller plus loin ?

Tu peux aussi :

* Créer des **voters personnalisés**
* Gérer des hiérarchies de rôles (`ROLE_ADMIN` > `ROLE_USER`)
* Utiliser `AccessDecisionManager` pour des cas avancés

---

