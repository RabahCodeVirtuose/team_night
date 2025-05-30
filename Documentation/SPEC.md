 un **résumé clair, structuré et complet de l’aspect front-end** de mon application TeamNight

---

### 🧩 **Architecture Front-End de TeamNight**

L’interface utilisateur de TeamNight a été pensée pour offrir une **expérience intuitive, moderne et accessible**, même à un public peu familier avec le web. Elle s’inspire des grands réseaux sociaux comme Facebook tout en répondant aux besoins spécifiques d’une plateforme événementielle.

#### 🏠 Accueil / Journal (composant principal)

Dès la connexion, l’utilisateur est redirigé vers un **journal dynamique**, sorte de fil d’actualité regroupant toutes les publications validées : événements passés, retours en images, annonces, souvenirs, etc. L’affichage est en **grille verticale responsive** (cards), optimisé pour la lisibilité et la fluidité.

#### 🧭 Menu de navigation (fixe en haut)

Le menu propose les entrées suivantes :

* **Journal** (accueil par défaut)
* **Découvrir nos packs** (accès aux offres Bronze, Silver, Gold, etc.)
* **Réserver un service** (accès au simulateur de devis ou à la réservation directe)
* **Souvenirs** (galerie d’événements mémorables)
* **Notifications** (réactions, commentaires, rappels)
* **Mon compte** (profil utilisateur)

#### 💬 Publications (cards)

Les publications sont **contrôlées** : elles peuvent être proposées par des collaborateurs mais doivent être validées par un administrateur (`isApproved = true`) pour apparaître dans le journal. Certaines publications sont marquées comme **souvenirs** (`isSouvenir = true`) et apparaissent dans une page dédiée.

#### ❤️ Réactions

Chaque publication peut recevoir des **réactions** : like, haha, grrr, etc., via une entité `Reaction` liée à l’utilisateur et à la publication. Les types sont gérés via **ENUM Doctrine** (`ReactionType`), et les réactions peuvent déclencher des **notifications** en temps réel.

#### 🔔 Notifications

Un système de **notifications** est prévu : l’utilisateur est averti lorsqu’un autre réagit ou commente ses publications. Une notification contient le type (enum `NotificationType`), un message, une date et une éventuelle URL de redirection.

#### 🛒 Panier / simulateur

Le front intègre un **simulateur de réservation** : l’utilisateur peut composer son propre événement en sélectionnant des services (DJ, traiteur, salle…) et constituer un **panier dynamique** pour simuler un devis ou procéder à une réservation.

#### 🎨 Technologies utilisées

* **Angular** avec **standalone components**
* **Routing dynamique**
* **Services Angular** pour interroger le backend Symfony
* **ECharts** pour les visualisations futures (statistiques, avis, etc.)
* Intégration progressive du **design DSFR** pour une UI cohérente et élégante

---
