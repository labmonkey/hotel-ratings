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
		$paths = array(
			Config::getViewsDir( 'web/templates' ),
			//Config::getViewsDir( 'admin/templates' )
		);
		$this->loader = new Twig_Loader_Filesystem($paths);
		$this->twig   = new Twig_Environment( $this->loader, array(
			'cache' => Config::getRootDir( 'cache' ),
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