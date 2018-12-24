<?php
/**
 * Plugin Name: Qzzr Shortcode Plugin
 * Description: Enables shortcode to embed Qzzr quizzes. Usage: <code>[qzzr quiz="123" width="100%" height="auto"]</code>. This code is available to copy and paste directly from the Qzzr share screen.
 * Version: 1.0.1
 * License: GPL
 * Author: Qzzr
 * Author URI: http://qzzr.co
 * 
 * @package qzzr-shortcode
 */

/**
 * Qzzr shortcode.
 * 
 * @param array $atts Attributes of qzzr shortcode.
 * @param array $content Contents between qzzr shortcode.
 */
function create_qzzr_embed_js( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'quiz'     => '',
			'height'   => 'auto',
			'width'    => '100%',
			'offset'   => '',
			'redirect' => '',
		),
		$atts
	);


	if ( ! $atts['quiz'] ) {

		$error = "
		<div style='border: 20px solid red; border-radius: 40px; padding: 40px; margin: 50px 0 70px;'>
			<h3>Uh oh!</h3>
			<p style='margin: 0;'>Something is wrong with your Qzzr shortcode. If you copy and paste it from the Qzzr share screen, you should be good.</p>
		</div>";

		return $error;

	} else {

		wp_enqueue_script( 'qzzr', '//dcc4iyjchzom0.cloudfront.net/widget/loader.js', array(), false, false ); 

		$qzzr_hook = "<div class='quizz-container' data-quiz='" . $atts['quiz'] . "' data-width='" . $atts['width'] . "' data-height='" . $atts['height'] . "'";
		
		if ( filter_var( $redirect, FILTER_VALIDATE_BOOLEAN ) ) {
			$qzzr_hook .= " data-auto-redirect='true'";
		}
		
		if ( $atts['offset'] ) {
			$qzzr_hook .= " data-offset='" . $atts['offset'] . "'";
		}

		$qzzr_hook .= '></div>';

		return "$qzzr_hook";

	}
}

add_shortcode( 'qzzr', 'create_qzzr_embed_js' );
