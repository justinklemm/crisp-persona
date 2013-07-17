<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Crisp Persona
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function crisp_persona_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'type'      => 'scroll',
		'container' => 'content',
		'footer'    => 'site-container',
	) );
}
add_action( 'after_setup_theme', 'crisp_persona_infinite_scroll_setup' );
