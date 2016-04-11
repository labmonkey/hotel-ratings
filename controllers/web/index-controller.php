<?php
/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 09/04/16
 *
 * Summary:
 * TODO summary of this file
 */

$loader = new Twig_Loader_Filesystem( dirname( __FILE__ ) . '/public/templates' );
$twig   = new Twig_Environment( $loader, array(
	'cache' => dirname( __FILE__ ) . '/cache',
) );


echo $twig->render( 'layout/base.twig', array( 'name' => 'Fabien' ) );

