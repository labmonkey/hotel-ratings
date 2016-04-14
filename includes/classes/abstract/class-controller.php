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

		$this->content = $this->add_content( array() );
	}

	/**
	 * @param $content
	 *
	 * @return array
	 */
	function add_content( $content ) {
		$content['page'] = array(
			'title' => $this->title,
			'css'   => array_merge( $this->view->get_css(), $this->css ),
			'js'    => array_merge( $this->view->get_js(), $this->js ),
		);

		$content['site'] = array(
			'name' => 'Hotel reviews'
		);

		return $content;
	}

	function display() {
		$this->view->render( $this->template, $this->content );
	}
}