<?php

use Timber\Twig_Function as Timber_Twig_Function;

/**
 * Customize Twig
 *
 * @param Twig_Environment $twig
 * @return $twig
 */
add_filter( 'timber/twig', function( Twig_Environment $twig ) {
	/**
	 * Get an icon.
	 *
	 * @see get_icon()
	 */
	$twig->addFunction( new Timber_Twig_Function( 'icon', 'get_icon' ) );

	return $twig;
});
