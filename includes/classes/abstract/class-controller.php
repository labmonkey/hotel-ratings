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
class Controller {
	protected $template, $content, $slug;

	/* @var View */
	protected $view;

	protected $css, $js, $title;

	function __construct( $view ) {
		$this->view = $view;

		$this->css = array();

		$this->js = array();

		$this->title = '';

		$this->slug = '';

		$this->handleForms( get_col( $_POST, 'action' ), $_POST );
	}

	/**
	 * @param $content
	 *
	 * @return array
	 */
	function add_content( $content ) {
		$content['page'] = array(
			'title' => $this->title,
			'slug'  => $this->slug,
			'css'   => array_merge( $this->view->get_css(), $this->css ),
			'js'    => array_merge( $this->view->get_js(), $this->js ),
		);

		$content['site'] = array(
			'name' => 'Hotel reviews'
		);

		if ( session()->is_user_logged_in() ) {
			$content['user'] = session()->get_current_user();
		}

		$content['pages'] = array(
			'account' => Config::getRootUrl( 'account' ),
			'logout'  => Config::getRootUrl( '?action=logout' ),
			'admin'   => Config::getAdminUrl(),
			'web'     => Config::getRootUrl()
		);

		return $content;
	}

	function display() {
		$this->content = $this->add_content( array() );
		$this->view->render( $this->template, $this->content );
	}

	function handleForms( $action, $data ) {

	}
}