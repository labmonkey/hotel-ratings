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
		$this->loader = new Twig_Loader_Filesystem();
		$this->loader->addPath( Config::getViewsDir( 'admin/templates' ), 'admin' );
		$this->loader->addPath( Config::getViewsDir( 'web/templates' ), 'web' );

		$this->twig = new Twig_Environment( $this->loader, array(
			'cache' => false,
			//'cache' => Config::getRootDir( 'cache' ),
			'debug' => true,
		) );

		$this->twig->addExtension(new Twig_Extension_Debug());
		$this->filters();
	}

	function get_js() {
		$js = array(
			Config::getViewsUrl( 'web/assets/js/app.min.js' )
		);
		if ( is_admin() ) {
			$js = array_merge( $js, array() );
		}

		return $js;
	}

	function get_css() {
		$css = array(
			"https://fonts.googleapis.com/css?family=Open+Sans:400,700|Gentium+Basic:400,700&subset=latin,latin-ext",
			"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css",
			Config::getViewsUrl( 'web/assets/css/app.min.css' )
		);

		if ( is_admin() ) {
			$css = array_merge( $css, array() );
		}

		return $css;
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

	static function webTemplate( $path ) {
		return "@web/$path";
	}

	static function adminTemplate( $path ) {
		return "@admin/$path";
	}
}