#### 1
---

### 🧱 STRUCTURE DES COMPOSANTS À GÉNÉRER

> 👉 Utilise cette commande-type pour chaque composant :
> `ng generate component components/<nom> --standalone`

#### 🏠 Accueil / Journal

* `HomeComponent` → Composant principal affichant les publications validées
* `PublicationCardComponent` → Affiche une publication dans une card
* `ReactionButtonsComponent` → Affiche les réactions (like, haha, grrr...)
* `SouvenirBadgeComponent` → Badge “Souvenir” si `isSouvenir = true`

#### 🧭 Menu / Navigation

* `NavbarComponent` → Menu principal (journal, packs, réserver…)
* `FooterComponent` (optionnel, selon le design)

#### 📦 Packs & Services

* `PackListComponent` → Affiche la liste des packs Bronze/Silver/Gold
* `PackDetailComponent` → Affiche le détail d’un pack
* `ServiceListComponent` → Liste tous les services disponibles (DJ, salle, etc.)
* `ServiceCardComponent` → Une card service (nom, prix, photo)

#### 🛒 Panier / Simulateur

* `SimulatorComponent` → Interface principale du simulateur
* `CartComponent` → Panier dynamique
* `CartItemComponent` → Affiche un élément du panier
* `QuoteSummaryComponent` → Résumé de devis généré

#### 🎞️ Souvenirs

* `SouvenirGalleryComponent` → Grille d’affichage des publications souvenirs

#### 🔔 Notifications

* `NotificationListComponent` → Liste des notifications utilisateur
* `NotificationItemComponent` → Un item (ex: “Rabah a réagi à votre post”)

#### 👤 Mon compte / Profil

* `ProfileComponent` → Infos utilisateur, préférences, etc.
* `EditProfileComponent` → Modification des infos utilisateur
* `MyPublicationsComponent` → Publications personnelles (en attente ou publiées)

#### 🧑‍💼 Auth & sécurité

* `LoginComponent`
* `RegisterComponent`
* `LogoutButtonComponent`
* `AuthGuardService` (à créer côté service)

---

### ⚙️ SERVICES À CRÉER (dans `src/app/services/`)

> Commande :
> `ng generate service services/<nom>`

* `AuthService` → Connexion / JWT / stockage token
* `UserService` → Données utilisateur (profil, publications, etc.)
* `PublicationService` → CRUD des publications
* `ReactionService` → Ajouter/supprimer une réaction
* `NotificationService` → Récupérer les notifications
* `PackService` → Packs disponibles
* `ServiceService` → Tous les services (DJ, traiteur…)
* `CartService` → Gestion du panier
* `QuoteService` → Calcul du devis / envoi réservation
* `SouvenirService` → Publications souvenirs

---

### 📦 MODULES / ROUTING

> Avec `Angular 17+`, chaque composant `--standalone` peut gérer ses routes.

Tu vas aussi créer un **fichier de routes principal** (ou lazy-loaded) :

```ts
export const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'packs', component: PackListComponent },
  { path: 'packs/:id', component: PackDetailComponent },
  { path: 'services', component: ServiceListComponent },
  { path: 'simulator', component: SimulatorComponent },
  { path: 'souvenirs', component: SouvenirGalleryComponent },
  { path: 'notifications', component: NotificationListComponent },
  { path: 'profile', component: ProfileComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  // ...
]
```

---

### 🧰 AUTRES ÉLÉMENTS UTILES

* `Interceptors/JwtInterceptor.ts` → Injecter automatiquement le JWT dans les requêtes
* `Guards/AuthGuard.ts` → Protéger certaines routes
* `Helpers/DatePipe.ts` → Formatage personnalisé
* `Enums/ReactionType.ts`, `NotificationType.ts` → Enum frontend pour cohérence

---

#### 2

---

### 🧭 PLAN DE CRÉATION FRONTEND — **ÉTAPE PAR ÉTAPE**

#### 🔰 1. Initialisation du projet + base technique

1. `AppComponent` → si pas encore fait (`ng new`)
2. `AppRouting` → fichier de routes principal
3. `NavbarComponent` → menu haut visible partout
4. `FooterComponent` (facultatif, si prévu)
5. `LoginComponent` + `RegisterComponent`
6. `AuthService` + `JwtInterceptor` + `AuthGuard`
7. **Test de login + redirection avec token dans LocalStorage**

✔️ **Objectif** : Tu te connectes, tu navigues dans l'app, t'as un token, t’as un menu fonctionnel.

---

#### 🏠 2. Mise en place du journal (accueil)

1. `HomeComponent` → route `/`
2. `PublicationCardComponent`
3. `ReactionButtonsComponent`
4. `PublicationService`

✔️ **Objectif** : Tu affiches des publications validées (`isApproved = true`) dans des cards, avec les réactions en bas.

---

#### 🛡️ 3. Auth & Profil utilisateur

1. `ProfileComponent` → affiche les infos de l’utilisateur connecté
2. `EditProfileComponent` → pour mettre à jour ses données
3. `MyPublicationsComponent` → pour voir ses propres publications

✔️ **Objectif** : Tu gères la session utilisateur, son profil et ses contenus.

---

#### 🎞️ 4. Souvenirs

1. `SouvenirGalleryComponent`
2. Réutilise `PublicationCardComponent`

✔️ **Objectif** : Afficher les publications `isSouvenir = true` dans une galerie dédiée.

---

#### 📦 5. Packs et services

1. `PackListComponent` → page listant les packs Bronze/Silver/Gold
2. `PackDetailComponent`
3. `ServiceListComponent` + `ServiceCardComponent`
4. `PackService` + `ServiceService`

✔️ **Objectif** : Explorer l’offre, voir les packs et les services.

---

#### 🛒 6. Simulateur / Réservation

1. `SimulatorComponent` → orchestrateur
2. `CartComponent` → résumé du panier
3. `CartItemComponent`
4. `QuoteSummaryComponent`
5. `CartService` + `QuoteService`

✔️ **Objectif** : Sélectionner des services et voir le prix estimé.

---

#### 🔔 7. Notifications

1. `NotificationListComponent`
2. `NotificationItemComponent`
3. `NotificationService`

✔️ **Objectif** : L’utilisateur est alerté quand quelqu’un réagit ou commente.

---

### 🧱 Récapitulatif visuel du plan

| Étape | À créer (composants + services)       | Objectif                     |
| ----- | ------------------------------------- | ---------------------------- |
| 1     | Auth, navbar, routing, interceptor    | Se connecter et naviguer     |
| 2     | Journal + cards + réactions           | Afficher le fil d’actualités |
| 3     | Profil utilisateur + ses publications | Gérer son compte             |
| 4     | Souvenirs                             | Galerie dédiée               |
| 5     | Packs + services                      | Découvrir l’offre            |
| 6     | Simulateur, panier, devis             | Réserver / simuler           |
| 7     | Notifications                         | Alertes utilisateur          |

---

