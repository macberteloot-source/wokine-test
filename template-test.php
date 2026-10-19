<?php
/**
 * Template Name: Test Wokine
 * Template Post Type: page
 *
 * Intégration de la maquette Figma « Wokine - Test technique » (page d'accueil).
 *
 * La maquette n'a ni en-tête ni pied de page : le template produit donc une page
 * complète (doctype, wp_head(), wp_footer()) pour rester fidèle au design quel que
 * soit le thème actif. Pour l'intégrer au header et au footer du thème, il suffit de
 * remplacer le bloc <html>…<body> par get_header() et la fin par get_footer().
 *
 * Les contenus sont regroupés dans des tableaux en haut du fichier : la présentation
 * est séparée des données. Dans un vrai projet, ils viendraient de champs ACF
 * (ou des produits WooCommerce pour la section « Nos dernières nouveautés »).
 *
 * @package Wokine_Test
 */

defined( 'ABSPATH' ) || exit;

/*
 * -------------------------------------------------------------------------
 * Ressources : chargées uniquement sur cette page, avant wp_head().
 * -------------------------------------------------------------------------
 */
$wt_dossier = 'assets/template-test/';

$wt_version = static function ( $fichier ) use ( $wt_dossier ) {
	$chemin = get_theme_file_path( $wt_dossier . $fichier );
	return file_exists( $chemin ) ? (string) filemtime( $chemin ) : null;
};

$wt_img = static function ( $fichier ) use ( $wt_dossier ) {
	return get_theme_file_uri( $wt_dossier . 'img/' . $fichier );
};

// Satoshi est distribuée par Fontshare (licence gratuite ITF) : chargée depuis leur CDN.
wp_enqueue_style( 'wokine-test-satoshi', 'https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700&display=swap', array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_style( 'wokine-test', get_theme_file_uri( $wt_dossier . 'css/template-test.css' ), array( 'wokine-test-satoshi' ), $wt_version( 'css/template-test.css' ) );
wp_enqueue_script(
	'wokine-test',
	get_theme_file_uri( $wt_dossier . 'js/template-test.js' ),
	array(),
	$wt_version( 'js/template-test.js' ),
	array(
		'strategy'  => 'defer',
		'in_footer' => true,
	)
);

/*
 * -------------------------------------------------------------------------
 * Contenus de la maquette.
 * -------------------------------------------------------------------------
 */
$wt_hero = array(
	'logo'  => 'Logo',
	'titre' => 'Bibendum semper elementum tellus neque viverra. Egestas at.',
);

$wt_intro = array(
	'titre_debut' => 'L’expertise au service',
	'titre_fin'   => 'de vos lorem ipsum',
	'texte'       => 'Volutpat sed hendrerit tellus lorem. Mollis urna arcu tincidunt tellus arcu nisi. Eleifend est tristique sollicitudin arcu purus nisl nunc rutrum diam. Nisl pellentesque augue suspendisse ultrices eu orci eu neque senectus. Elementum pretium nulla varius elit velit nisi dui nulla. Ut sit tellus gravida morbi.',
	'bouton'      => 'Contactez-nous',
	'lien'        => '#',
);

$wt_solutions = array(
	'titre'     => 'Des solutions techniques complètes pour tous vos projets',
	'principal' => array(
		'titre' => 'Aenean aliquam',
		'texte' => 'Imperdiet faucibus egestas ipsum et mattis. Duis non et justo vestibulum vitae. Tortor tincidunt felis neque congue. In et tempus dignissim ullamcorper eget pellentesque vestibulum pellentesque. Viverra eget elit id eget. Ut cursus sed et massa morbi feugiat. Ac faucibus ante congue nisi a amet elit est. Fermentum.',
		'lien'  => '#',
	),
	'image'     => array(
		'titre' => 'Sed sollicitudin malesuada gravida',
		'lien'  => '#',
	),
	'rose'      => array(
		'titre' => 'A hendrerit tincidunt elementum a',
		'lien'  => '#',
	),
);

$wt_produits_titre  = 'Nos dernières nouveautés';
$wt_produits_bouton = array(
	'texte' => 'Tous nos produits',
	'lien'  => '#',
);

$wt_produit_type = array(
	'titre' => 'Vehicula dapibus',
	'texte' => 'Tristique cras interdum volutpat faucibus viverra cursus id. Orci blandit nunc nibh arcu non sit volutpat. Vitae id ut dui tellus.',
	'lien'  => '#',
	'fiche' => '#',
);
$wt_produits     = array();
foreach ( array( 1, 2, 3, 4, 5, 1 ) as $wt_n ) {
	$wt_produits[] = $wt_produit_type + array( 'image' => 'produit-' . $wt_n . '.webp' );
}

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'wt' ); ?>>
<?php wp_body_open(); ?>

<main class="wt-page" id="contenu">

	<?php /* ---------- Hero ---------- */ ?>
	<section class="wt-hero" aria-labelledby="wt-hero-titre">
		<div class="wt-hero__cadre">
			<img
				class="wt-hero__image"
				src="<?php echo esc_url( $wt_img( 'hero-1440.webp' ) ); ?>"
				srcset="<?php echo esc_url( $wt_img( 'hero-768.webp' ) ); ?> 768w, <?php echo esc_url( $wt_img( 'hero-1440.webp' ) ); ?> 1440w, <?php echo esc_url( $wt_img( 'hero-2880.webp' ) ); ?> 2880w"
				sizes="100vw"
				width="1440"
				height="960"
				alt=""
				fetchpriority="high"
				decoding="async"
			>
			<div class="wt-hero__contenu">
				<p class="wt-logo">
					<img src="<?php echo esc_url( $wt_img( 'logo-icon.svg' ) ); ?>" width="12" height="26" alt="">
					<span><?php echo esc_html( $wt_hero['logo'] ); ?></span>
				</p>
				<h1 class="wt-hero__titre" id="wt-hero-titre"><?php echo esc_html( $wt_hero['titre'] ); ?></h1>
			</div>
		</div>
	</section>

	<?php /* ---------- Introduction ---------- */ ?>
	<section class="wt-intro" aria-labelledby="wt-intro-titre">
		<h2 class="wt-intro__titre wt-degrade" id="wt-intro-titre">
			<?php echo esc_html( $wt_intro['titre_debut'] ); ?>
			<?php echo esc_html( $wt_intro['titre_fin'] ); ?>
		</h2>
		<div class="wt-intro__corps">
			<p class="wt-intro__texte"><?php echo esc_html( $wt_intro['texte'] ); ?></p>
			<a class="wt-bouton" href="<?php echo esc_url( $wt_intro['lien'] ); ?>"><?php echo esc_html( $wt_intro['bouton'] ); ?></a>
		</div>
	</section>

	<?php /* ---------- Solutions ---------- */ ?>
	<section class="wt-bloc wt-solutions" aria-labelledby="wt-solutions-titre">
		<div class="wt-bloc__fond">
			<div class="wt-solutions__deco" aria-hidden="true">
				<div class="wt-deco wt-deco--rectangle"><div><img src="<?php echo esc_url( $wt_img( 'deco-rectangle.svg' ) ); ?>" alt=""></div></div>
				<div class="wt-deco wt-deco--vague-1"><img src="<?php echo esc_url( $wt_img( 'deco-vague-1.svg' ) ); ?>" alt=""></div>
				<div class="wt-deco wt-deco--vague-2"><img src="<?php echo esc_url( $wt_img( 'deco-vague-2.svg' ) ); ?>" alt=""></div>
			</div>

			<h2 class="wt-solutions__titre wt-degrade" id="wt-solutions-titre"><?php echo esc_html( $wt_solutions['titre'] ); ?></h2>

			<div class="wt-solutions__grille">
				<article class="wt-carte wt-carte--marine wt-carte--large">
					<div class="wt-carte__haut">
						<h3 class="wt-carte__titre-large"><?php echo esc_html( $wt_solutions['principal']['titre'] ); ?></h3>
						<p class="wt-carte__texte"><?php echo esc_html( $wt_solutions['principal']['texte'] ); ?></p>
					</div>
					<a class="wt-lien" href="<?php echo esc_url( $wt_solutions['principal']['lien'] ); ?>">
						Voir plus<span class="screen-reader-text"> : <?php echo esc_html( $wt_solutions['principal']['titre'] ); ?></span>
						<img src="<?php echo esc_url( $wt_img( 'chevron-clair.svg' ) ); ?>" width="9" height="14" alt="">
					</a>
				</article>

				<article class="wt-carte wt-carte--image">
					<img class="wt-carte__fond" src="<?php echo esc_url( $wt_img( 'carte-960.webp' ) ); ?>" srcset="<?php echo esc_url( $wt_img( 'carte-480.webp' ) ); ?> 480w, <?php echo esc_url( $wt_img( 'carte-960.webp' ) ); ?> 960w" sizes="(max-width: 767px) 100vw, 474px" width="960" height="720" alt="" loading="lazy" decoding="async">
					<h3 class="wt-carte__titre"><?php echo esc_html( $wt_solutions['image']['titre'] ); ?></h3>
					<a class="wt-lien" href="<?php echo esc_url( $wt_solutions['image']['lien'] ); ?>">
						Voir plus<span class="screen-reader-text"> : <?php echo esc_html( $wt_solutions['image']['titre'] ); ?></span>
						<img src="<?php echo esc_url( $wt_img( 'chevron-blanc.svg' ) ); ?>" width="9" height="14" alt="">
					</a>
				</article>

				<article class="wt-carte wt-carte--rose">
					<h3 class="wt-carte__titre"><?php echo esc_html( $wt_solutions['rose']['titre'] ); ?></h3>
					<a class="wt-lien" href="<?php echo esc_url( $wt_solutions['rose']['lien'] ); ?>">
						Voir plus<span class="screen-reader-text"> : <?php echo esc_html( $wt_solutions['rose']['titre'] ); ?></span>
						<img src="<?php echo esc_url( $wt_img( 'chevron-fonce.svg' ) ); ?>" width="9" height="14" alt="">
					</a>
				</article>
			</div>
		</div>
	</section>

	<?php /* ---------- Nos dernières nouveautés ---------- */ ?>
	<section class="wt-bloc wt-produits" aria-labelledby="wt-produits-titre" data-wt-carrousel>
		<div class="wt-bloc__fond">
			<div class="wt-produits__tete">
				<h2 class="wt-produits__titre" id="wt-produits-titre"><?php echo esc_html( $wt_produits_titre ); ?></h2>
				<a class="wt-bouton" href="<?php echo esc_url( $wt_produits_bouton['lien'] ); ?>"><?php echo esc_html( $wt_produits_bouton['texte'] ); ?></a>
			</div>

			<ul class="wt-produits__liste" data-wt-piste tabindex="0" aria-label="<?php echo esc_attr( $wt_produits_titre ); ?>">
				<?php foreach ( $wt_produits as $wt_produit ) : ?>
					<li class="wt-produit">
						<div class="wt-produit__visuel">
							<img src="<?php echo esc_url( $wt_img( $wt_produit['image'] ) ); ?>" width="520" height="520" alt="" loading="lazy" decoding="async">
							<span class="wt-produit__badge">nouveauté</span>
							<a class="wt-produit__fiche" href="<?php echo esc_url( $wt_produit['fiche'] ); ?>">
								Télécharger la fiche technique
								<img src="<?php echo esc_url( $wt_img( 'telecharger.svg' ) ); ?>" width="16" height="16" alt="">
							</a>
						</div>
						<div class="wt-produit__infos">
							<h3 class="wt-produit__titre"><a href="<?php echo esc_url( $wt_produit['lien'] ); ?>"><?php echo esc_html( $wt_produit['titre'] ); ?></a></h3>
							<p class="wt-produit__texte"><?php echo esc_html( $wt_produit['texte'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="wt-produits__fleches">
				<button class="wt-fleche" type="button" data-wt-precedent aria-label="Produits précédents" disabled>
					<img class="wt-fleche__miroir" src="<?php echo esc_url( $wt_img( 'fleche-suivant.svg' ) ); ?>" width="18" height="18" alt="">
				</button>
				<button class="wt-fleche" type="button" data-wt-suivant aria-label="Produits suivants">
					<img src="<?php echo esc_url( $wt_img( 'fleche-suivant.svg' ) ); ?>" width="18" height="18" alt="">
				</button>
			</div>
		</div>
	</section>

</main>

<?php wp_footer(); ?>
</body>
</html>
