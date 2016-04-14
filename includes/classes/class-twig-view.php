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

		$this->filters();
	}

	function get_js() {
		if ( is_admin() ) {
			return array();
		} else {
			return array(
				"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js",
				Config::getViewsUrl( 'web/assets/js/app.min.js' )
			);
		}
	}

	function get_css() {
		if ( is_admin() ) {
			return array();
		} else {
			return array(
				"https://fonts.googleapis.com/css?family=Open+Sans:400,700|Gentium+Basic:400,700&subset=latin,latin-ext",
				"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css",
				Config::getViewsUrl( 'web/assets/css/app.min.css' )
			);
		}
	}

	/**
	 * @param string $template
	 * @param array $content
	 */
	function render( $template, $content ) {
		echo $this->twig->render( $template, $content );
	}

	function filters() {
		$filters = array(
			new Twig_SimpleFilter( 'uploads', array( $this, 'filter_uploads' ) )
		);

		foreach ( $filters as $filter ) {
			$this->twig->addFilter( $filter );
		}
	}

	function filter_uploads( $file ) {
		return Config::getUploadsUrl( $file );
	}
}