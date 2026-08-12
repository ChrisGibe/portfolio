# Formation WebGL — distorsion qui suit la souris

> **But de ce fichier** : servir de point de reprise. Si le contexte de la conversation
> est vidé, il suffit de rouvrir une discussion et de donner ce fichier à Claude pour
> qu'il reprenne exactement là où on en était, avec la même méthode.

---

## 🎯 Objectif de la formation

Comprendre **en profondeur** comment marche l'effet de distorsion de
[`AboutExperience.js`](./AboutExperience.js) — en particulier :

1. comment on **récupère le mouvement de la souris**,
2. comment on **crée une distorsion qui suit le curseur**.

`AboutExperience` fait trop de choses à la fois (ping-pong de masques, brush,
reveal 2 textures, momentum, mode mobile…), donc il est illisible pour apprendre.
On **reconstruit uniquement la distorsion**, from scratch, dans un module neuf et
minimal `WebGLTest`, branché sur le composant ACF `cp-webgl-test`
(canvas `#webgl-test-canvas`).

À chaque étape on **compare** notre version "test" avec la ligne équivalente
d'`AboutExperience`.

## 🧠 Méthode de travail (IMPORTANT — à respecter)

- **On code à deux.** Claude **explique**, montre **où** et **quoi**, mais **c'est
  l'utilisateur (Christophe) qui écrit le code**. Claude ne balance pas de gros
  blocs de code tout faits.
- **Explorer → comprendre → écrire.** On avance **une étape à la fois** : on
  discute le concept, Christophe écrit, on teste à l'écran, on note, on passe à la
  suite. Objectif = **retenir**, pas produire vite.
- Christophe a **les bases** Three.js / shaders (scène, caméra, mesh, material,
  uniforms, vertex/fragment). Pas besoin de réexpliquer ces fondamentaux, mais on
  peut y revenir si besoin.
- Langue : **français**.

## 🛠️ Contexte technique du projet

- Thème WordPress : `web/app/themes/cgibelli/`, bundler **Webpack 5**, gestionnaire **Yarn**.
- Build : `yarn watch` (dev, rebuild auto) / `yarn production` (build one-shot).
  Le bundle `assets/scripts/app.js` est déjà enqueue par WordPress — **aucun
  changement PHP d'enqueue nécessaire**.
- Entrée JS unique : [`_src/js/app.js`](../../app.js). Les modules sont bootés à la
  main dans un `DOMContentLoaded` (pas de registre). Pour ajouter notre module :
  `import { WebGLTest } from './modules/cgibelli/WebGLTest'` + `new WebGLTest()`.
- Utils réutilisables (pattern EventEmitter) :
  [`utils/Sizes.js`](../../utils/Sizes.js) → `.on('resize')`,
  [`utils/Time.js`](../../utils/Time.js) → `.on('tick')` (boucle RAF).
  ⚠️ Chaque Experience instancie SES PROPRES `Sizes`/`Time` (une boucle RAF par
  instance, pas de singleton).
- Composant ACF déjà créé : `acf/blocks/tequilarapido/cp-webgl-test.php`
  (contient `<canvas id="webgl-test-canvas">`).

## 🗺️ Plan de la formation (étapes)

> On coche au fur et à mesure. Chaque étape = un concept + un test visuel + une note.

- [ ] **Étape 1 — Squelette : une image plein écran (aucune distorsion).**
  Valider le pipeline minimal. Créer `WebGLTest.js` (canvas + garde-fou, renderer,
  caméra **orthographique** `(-1,1,1,-1)` + **plane 2×2** = plein écran, ShaderMaterial
  1 uniform `uTexture`, TextureLoader), shaders `shaders/test/vertex.glsl` /
  `shaders/test/fragment.glsl` (`texture2D(uTexture, vUv)`), booter dans `app.js`, ajouter
  `data-texture` au PHP. But : voir l'image.
  → *Comparaison About* : ici pas de `coverUv`, l'image est étirée (on l'ajoutera).

- [ ] **Étape 2 — Capter la souris (visualisée, sans distorsion).**
  `pointermove` → convertir `clientX/Y` (pixels DOM) en UV `0..1` via
  `getBoundingClientRect()`, **flipper Y** (DOM top-left → WebGL bottom-left).
  Envoyer au shader via uniform `uMouse`. Dessiner un **disque de debug** qui suit
  la souris pour VOIR la donnée arriver.
  → *Comparaison About* : c'est exactement `AboutExperience.onPointerMove` (≈ l.327-333).

- [ ] **Étape 3 — Distorsion simple qui suit la souris.**
  Concept clé : *distordre = déplacer l'UV avant de sampler la texture* (on ne bouge
  jamais l'image, on ment sur l'endroit où on lit). `falloff = smoothstep(radius, 0,
  length(vUv - uMouse))` = spotlight localisé. Correction d'aspect sur la distance.
  → *Comparaison About* : cœur de `main.fragment.glsl` (le bloc `vec2 d = vUv - uCursor`…).

- [ ] **Étape 4 — Distorsion "vivante" avec bruit fbm.**
  Réutiliser `noise.glsl` (simplex + fbm) via `//__NOISE__`. Remplacer le
  déplacement radial par un **wobble animé** :
  `fbm(vUv * uFreq + vec2(uTime, 0.))`. Piloter `uTime` depuis `update()` → ça bouge
  même souris immobile.
  → *Comparaison About* : les lignes `vec2 wobble = vec2(fbm(...), fbm(...))`.

- [ ] **Étape 5 — Lissage du curseur (le "feel").**
  `cursor += (target - cursor) * SMOOTH` chaque frame (easing/lerp) → mouvement
  fluide, pas saccadé. Envoyer la valeur LISSÉE à `uMouse`.
  → *Comparaison About* : `CURSOR_SMOOTH` (≈ l.532-534). On n'implémente PAS le
  momentum d'About, on explique juste la différence de but.

À la fin de l'étape 5 : toute la distorsion d'About est reconstruite et comprise
ligne par ligne, dans un fichier lisible.

---

## 📚 Glossaire des concepts (rempli au fur et à mesure)

<!-- On ajoute ici, à chaque étape, une explication courte "avec nos mots". -->

- **Caméra orthographique + plane 2×2** : (à remplir en étape 1)
- **3 espaces de coordonnées** (pixels DOM / UV 0..1 / clip -1..1) et flip Y : (étape 2)
- **UV displacement = distorsion** : (étape 3)
- **falloff / spotlight** (`smoothstep`) : (étape 3)
- **fbm / simplex noise** : (étape 4)
- **easing / lerp du curseur** : (étape 5)

## 🔁 Journal de progression

- **[fait]** Infra : switch `.glsl.js` → `.glsl` (loader `asset/source`, injection
  `//__NOISE__`). Build vérifié.
- **[à venir]** Étape 1…

---

## ▶️ Comment reprendre après un reset de contexte

Donner ce fichier à Claude et dire par ex. :
« On reprend la formation WebGL décrite dans `NOTES.md`. On est à l'étape X.
Rappelle-toi la méthode : on code à deux, tu expliques, c'est moi qui écris. »
