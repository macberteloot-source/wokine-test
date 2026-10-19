/**
 * Template « Test Wokine » — carrousel « Nos dernières nouveautés ».
 *
 * Le défilement est natif (overflow-x + scroll-snap en CSS) : il fonctionne au doigt,
 * au trackpad et au clavier même sans JavaScript. Ce script ajoute seulement :
 *   - les flèches « précédent / suivant », qui avancent d'une carte ;
 *   - leur état désactivé en début et en fin de piste (60 % d'opacité, comme la maquette).
 *
 * Aucune dépendance (ni jQuery, ni librairie de slider).
 */
( function () {
	'use strict';

	document.querySelectorAll( '[data-wt-carrousel]' ).forEach( function ( carrousel ) {
		var piste = carrousel.querySelector( '[data-wt-piste]' );
		var precedent = carrousel.querySelector( '[data-wt-precedent]' );
		var suivant = carrousel.querySelector( '[data-wt-suivant]' );

		if ( ! piste || ! precedent || ! suivant ) {
			return;
		}

		// Largeur d'un pas : une carte + l'écart entre deux cartes.
		function pas() {
			var carte = piste.querySelector( 'li' );
			var ecart = parseFloat( getComputedStyle( piste ).columnGap ) || 0;
			return carte ? carte.getBoundingClientRect().width + ecart : piste.clientWidth;
		}

		function mettreAJour() {
			var max = piste.scrollWidth - piste.clientWidth;
			precedent.disabled = piste.scrollLeft <= 1;
			suivant.disabled = piste.scrollLeft >= max - 1;
		}

		precedent.addEventListener( 'click', function () {
			piste.scrollBy( { left: -pas() } );
		} );

		suivant.addEventListener( 'click', function () {
			piste.scrollBy( { left: pas() } );
		} );

		// Flèches gauche / droite quand la piste a le focus.
		piste.addEventListener( 'keydown', function ( evenement ) {
			if ( 'ArrowRight' === evenement.key || 'ArrowLeft' === evenement.key ) {
				evenement.preventDefault();
				piste.scrollBy( { left: 'ArrowRight' === evenement.key ? pas() : -pas() } );
			}
		} );

		piste.addEventListener( 'scroll', mettreAJour, { passive: true } );
		window.addEventListener( 'resize', mettreAJour );
		mettreAJour();
	} );
}() );
