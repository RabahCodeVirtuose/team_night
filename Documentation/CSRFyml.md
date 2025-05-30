
---

## 🔒 À quoi sert ce `csrf.yaml` ?

Ce fichier permet de :

* **Activer la protection CSRF** même si ton firewall est `stateless` (typiquement pour une API).
* Déclarer les **`token_id` autorisés** pour différents contextes (submit de formulaire, login, logout, etc.).

---

## 🧩 Structure du fichier `csrf.yaml`

```yaml
# config/packages/csrf.yaml
framework:
    form:
        csrf_protection:
            token_id: submit   # ID utilisé par défaut pour générer un token CSRF dans les formulaires

    csrf_protection:
        stateless_token_ids:
            - submit          # utilisé pour les formulaires
            - authenticate    # utilisé par les firewalls/login
            - logout          # utilisé pour sécuriser les requêtes de logout
```

---

## 📍 Pourquoi le faire même en API ?

Même si tu es en JWT (donc normalement **stateless**), **certaines actions sensibles (comme le logout ou les form POST)** peuvent être exposées. Donc :

* Tu peux rendre ces actions plus sûres **en exigeant un token CSRF**.
* Symfony le vérifie si tu actives les `stateless_token_ids`.

---

## 📦 Comment Symfony gère les CSRF token ?

### Génération (côté frontend ou Twig) :

Tu peux générer un token avec :

```php
$csrfToken = $csrfTokenManager->getToken('submit')->getValue();
```

Tu l’envoies dans le header par exemple :

```
X-CSRF-TOKEN: <token>
```

Et Symfony attendra ce header si tu as activé `stateless_token_ids`.

---

## 🔧 Quand l’utiliser dans ton projet ?

✅ Tu peux l’utiliser **si tu prévois d’envoyer des formulaires depuis Angular vers Symfony**, sans passer par JWT pour certaines actions sensibles.

❌ Tu peux t’en passer si **tout ton système d’authentification est 100 % JWT**, et que **tu n’utilises pas de sessions** ni de formulaires Symfony classiques.



