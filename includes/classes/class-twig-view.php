<?php

/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 12/04/16
 *
 * Summary:
 * TODO summary of this file
 */
class TwigView extends View {
	/* @var Twig_Environment */
	private $twig;
	/* @var Twig_Loader_Filesystem */
	private $loader;

	function init() {
		if ( is_admin() ) {
			$paths = array(
				Config::getViewsDir( 'admin/templates' )
			);
		} else {
			$paths = array(
				Config::getViewsDir( 'web/templates' )
			);
		}

		$this->loader = new Twig_Loader_Filesystem( $paths );
		$this->twig   = new Twig_Environment( $this->loader, array(
			'cache' => false
			//'cache' => Config::getRootDir( 'cache' ),
		) );
	}

	/**
	 * @param string $template
	 * @param array $content
	 */
	function render( $template, $content ) {
		echo $this->twig->render( $template, $content );
	}
}