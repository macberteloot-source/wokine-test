# Test technique Wokine — intégration Figma en template WordPress

Intégration de la page d'accueil de la maquette « Wokine - Test technique » sous la forme d'un **template de page WordPress** : `template-test.php`.

## Contenu

```
template-test.php                     Template de page (Template Name: Test Wokine)
assets/template-test/
├── css/template-test.css             Styles de la page
├── js/template-test.js               Carrousel « Nos dernières nouveautés » 
├── img/                              Images de la maquette (WebP optimisés) et SVG
└── fonts/                            Anton et Inter (woff2, licence OFL)
```

## Installation

1. Copier `template-test.php` et le dossier `assets/` à la racine du thème actif (ou du thème enfant).
2. Dans l'admin : **Pages → Ajouter**, puis dans le panneau de droite **Modèle → Test Wokine**.
3. Publier et afficher la page.

Aucune extension, aucune base de données ni configuration n'est nécessaire.

## Choix techniques

**Fidélité à la maquette.** Les valeurs (couleurs, tailles, interlignages, espacements, rayons) sont relevées dans Figma. À 1440 px, les sections ont exactement les hauteurs de la maquette : hero 864 px, introduction 458 px, solutions 928 px, nouveautés 769 px. Les flèches du carrousel sont placées au pixel près.

**Template autonome.** La maquette n'a ni en-tête ni pied de page. Le template produit donc une page complète (`wp_head()`, `wp_body_open()`, `wp_footer()`) et s'affiche à l'identique quel que soit le thème, classique ou en blocs. Pour l'intégrer au header et au footer d'un thème, il suffit de remplacer le début du document par `get_header()` et la fin par `get_footer()`.

**Ressources chargées uniquement sur cette page.** Le CSS et le JS sont mis en file d'attente dans le template, avant `wp_head()`. La version de chaque fichier suit sa date de modification, ce qui vide le cache navigateur à chaque mise à jour. Le script est chargé en `defer`.

**Contenus séparés de la présentation.** Les textes sont regroupés dans des tableaux PHP en haut du template, et toutes les sorties sont échappées (`esc_html`, `esc_url`, `esc_attr`). Dans un projet réel, ces tableaux seraient remplacés par des champs ACF, et la section « Nos dernières nouveautés » par une requête sur les produits (`WP_Query` ou `wc_get_products()`). Le gabarit de carte est déjà une boucle.

**CSS.**
- Tout est préfixé `wt-`, pour éviter les conflits avec le thème.
- Les couleurs et typographies sont des variables CSS.
- Les remises à zéro passent par `:where()` (spécificité nulle).
- Les tailles de titres sont fluides avec `clamp()` : elles valent exactement la maquette à 1440 px et se réduisent sur les écrans plus étroits.
- Les titres en dégradé utilisent `background-clip: text`.

**Carrousel.**
- Le défilement est natif (`overflow-x` et `scroll-snap`) : il fonctionne au doigt, au trackpad et au clavier, même sans JavaScript.
- Le script ajoute seulement les flèches (une carte par clic), leur état désactivé en début et en fin de piste (60 % d'opacité, a peu près comme dans la maquette) et les touches ← → quand la piste a le focus.
- Pas de jQuery ni de librairie de slider.

**Comportements non définis par la maquette.**
- Le bouton « Télécharger la fiche technique », à 0 % d'opacité dans Figma, apparaît au survol et au focus de la carte. Sur les écrans tactiles, sans survol possible, il reste visible.
- Toute la carte produit est cliquable, sauf le bouton « fiche technique », qui garde son propre lien.
- Effets légers au survol : zoom des images et décalage du chevron « Voir plus ». Ils sont désactivés si l'utilisateur a demandé à réduire les animations.

**Responsive** (la maquette ne fournit que le desktop) :

| Largeur | Comportement |
|---|---|
| 1440 px | Identique à la maquette |
| ≤ 900 px | L'introduction passe sur une colonne |
| ≤ 767 px | Cartes « solutions » empilées, titre et bouton des nouveautés en colonne, cartes produits un peu plus étroites, coins arrondis réduits à 16 px |

Tout a été vérifié à 1440, 1024 et 390 px, sans défilement horizontal parasite.

**Accessibilité.**
- Hiérarchie des titres : un `h1` dans le hero, un `h2` par section, des `h3` pour les cartes.
- Images décoratives avec `alt=""`.
- Liens « Voir plus » complétés pour les lecteurs d'écran (« Voir plus : Aenean aliquam »).
- Flèches du carrousel en `<button>` avec `aria-label`.
- Focus visible au clavier.

**Performance.**
- Les images d'origine (11 à 13 Mo en PNG) sont converties en WebP : 99 Ko pour le hero en 2880 px.
- Le hero utilise `srcset` (768, 1440 et 2880 px) et `fetchpriority="high"`, car c'est l'image principale de la page.
- Les autres images sont en `loading="lazy"`, avec des dimensions déclarées pour éviter les décalages de mise en page.

**Polices.** Anton et Inter sont auto-hébergées (woff2, licence OFL) : aucun appel à Google Fonts. Satoshi est chargée depuis le CDN de Fontshare (licence gratuite ITF) ; en production, je l'auto-hébergerais aussi.

## Qualité

- `php -l` : aucune erreur.
- WordPress Coding Standards (`phpcs --standard=WordPress`) : 0 erreur, 0 avertissement.

## Usage de l'IA

J'ai réalisé ce test avec l'aide de Claude, en suivant cette méthode :
- lecture de la maquette par le connecteur Figma (valeurs exactes, images exportées) ;
- intégration (partiellement fait avec claude) ;

## Travail fait a la main
- comparaison des captures de rendu avec la maquette à 1440 px, puis correction des écarts (hauteurs de section, position des flèches, troncature du texte des cartes)() ;
- tests à 1024 et 390 px ;
- vérification du carrousel au clic et au clavier.
-correction d'integration 

J'ai relu et compris chaque partie du code, et je peux en expliquer les choix.
