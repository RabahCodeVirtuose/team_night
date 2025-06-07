
**explication complète mais claire** du système qu’on vient de mettre en place pour ta navbar qui se cache / réapparaît automatiquement selon le scroll (comme Facebook).

---

## 🧠 🧩 Vue d’ensemble

On a conçu un **système de détection du sens de scroll**, qui :

1. Écoute l’utilisateur quand il scrolle (`@HostListener`)
2. Compare la position actuelle du scroll à la précédente
3. Si on descend → on cache la navbar (en la faisant "glisser vers le haut")
4. Si on remonte → on la montre
5. Le tout sans détruire le composant (pas de `@if`), mais **en changeant juste une classe CSS**

---

## 🧠 🧱 Étapes en détail

### ✅ 1. `@HostListener('window:scroll', [])`

> C’est un **écouteur d’événements Angular**. Il agit exactement comme un `window.addEventListener('scroll', fn)`.

👉 Il nous permet d'exécuter la fonction `onScroll()` **à chaque scroll vertical** sur la fenêtre du navigateur.

---

### ✅ 2. Variables principales

```ts
isNavbarVisible = true;         // état actuel (affichée ou cachée)
lastScrollTop = 0;              // la dernière position verticale connue
debounceTimeout: any;           // pour lisser les déclenchements (éviter les vibrations)
```

---

### ✅ 3. Détection du sens de scroll

```ts
const delta = scrollTop - this.lastScrollTop;
```

👉 `delta > 0` : tu descends
👉 `delta < 0` : tu remontes

---

### ✅ 4. Anti-vibration = debounce

```ts
clearTimeout(this.debounceTimeout);
this.debounceTimeout = setTimeout(() => {
   // logique ici
}, 50);
```

🔥 C’est super important.

Sans ce délai (`setTimeout`), la fonction serait appelée **trop souvent**, ce qui rend le comportement instable ("vibrant", "flicker").

💡 On attend un peu après chaque scroll **avant de décider** si on cache ou affiche.

---

### ✅ 5. Mise à jour de l’état

```ts
if (delta > 20) {
  this.isNavbarVisible = false;
} else if (delta < -10) {
  this.isNavbarVisible = true;
}
```

📌 On a mis des **seuils** pour éviter que le moindre petit scroll fasse bouger la navbar :

* **descente > 20px** → cacher
* **remontée > 10px** → montrer

---

### ✅ 6. Utilisation de `[class.hidden]` dans le HTML

```html
<app-navbar-component [class.hidden]="!isNavbarVisible"></app-navbar-component>
```

🔥 Cette ligne ajoute ou enlève dynamiquement la classe CSS `hidden` selon l’état de `isNavbarVisible`.

---

### ✅ 7. CSS : la magie de `transform: translateY(-100%)`

```scss
app-navbar-component.hidden {
  transform: translateY(-100%);
  opacity: 0;
  pointer-events: none;
}
```

💡 On ne détruit pas le composant → on le **décale verticalement vers le haut (invisible)**.
`opacity: 0` + `pointer-events: none` = il ne gêne pas les clics.
`transition: transform 0.3s` = animation douce.

---

## 🧠 Résumé technique

| Élément                        | Rôle                                               |
| ------------------------------ | -------------------------------------------------- |
| `@HostListener`                | Réagit aux scrolls de l’utilisateur                |
| `delta`                        | Détecte le sens du scroll                          |
| `setTimeout`                   | Évite les déclenchements trop fréquents (debounce) |
| `isNavbarVisible`              | Contrôle si on affiche la navbar                   |
| `[class.hidden]`               | Active une classe CSS dynamique                    |
| `transform: translateY(-100%)` | Cache la navbar visuellement sans la détruire      |

---

