<?php
/**
 * Crisp Persona Theme Customizer
 *
 * @package Crisp Persona
 */


/**
 * Load up the menu page
 */
function crisp_persona_add_customize_page() {
  add_theme_page(
    __( 'Customize', 'crisp-persona' ),
    __( 'Customize', 'crisp-persona' ),
    'edit_theme_options',
    'customize.php'
  );
}

add_action( 'admin_menu', 'crisp_persona_add_customize_page' );


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function crisp_persona_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';


  // Avatar

  $wp_customize->add_section( 'crisp_persona_avatar_settings', array(
    'title'           => __('Avatar Photo','crisp-persona'),
    'priority'        => 20,
    'description'     => __( 'Upload the avatar photo','crisp-persona' )
  ) );

  $wp_customize->add_setting('crisp_persona_options[avatar_url]', array(
    //'default'             => get_template_directory_uri().'/images/avatar.png',
    'capability'          => 'edit_theme_options',
    'type'                => 'option',
    'transport'           => 'refresh',
    'sanitize_callback'   => 'crisp_persona_options_validate'
  ) );

  $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'avatar_url', array(
      'label'         => __('Avatar Photo Upload (125 x 125 is ideal)', 'crisp-persona'),
      'section'       => 'crisp_persona_avatar_settings',
      'settings'      => 'crisp_persona_options[avatar_url]'
  ) ) );


  // Social links

  $socials = array (
    'show_rss_icon'  => __( 'Show RSS Icon','crisp-persona' ),
    'facebook_url'   => __( 'Facebook URL','crisp-persona' ),
    'gplus_url'      => __( 'Google+ URL','crisp-persona' ), 
    'linkedin_url'   => __( 'LinkedIn URL','crisp-persona' ),
    'instagram_url'  => __( 'Instagram URL','crisp-persona' ),
    'twitter_url'    => __( 'Twitter URL','crisp-persona' )
  ); 

  $wp_customize->add_section( 'crisp_persona_social_settings', array(
    'title'          => __( 'Social Links','crisp-persona' ),
    'priority'       => 30,
    'description'    => __( 'Set up your social profiles','crisp-persona' )
  ) );

  //Social fields generator with url sanitization
  $priority = 1;
  foreach ($socials as $key => $label) {
    $option_name = 'crisp_persona_options['.$key.']';
    $wp_customize->add_setting( $option_name, array(
      'default'             => $wp_customize->get_setting($option_name),
      'capability'          => 'edit_theme_options',
      'type'                => 'option',
      'transport'           => 'refresh',
      'sanitize_callback'   => 'crisp_persona_options_validate'
    ) );

    $wp_customize->add_control( $key, array(
      'label'       => $label,
      'priority'    => $priority,
      'section'     => 'crisp_persona_social_settings',
      'type'        => ($key == 'show_rss_icon' ? 'checkbox' : 'text'),
      'settings'    => $option_name
    ) );

    $priority++;
  }


}
add_action( 'customize_register', 'crisp_persona_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function crisp_persona_customize_preview_js() {
	wp_enqueue_script( 'crisp_persona_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', 'crisp_persona_customize_preview_js' );


/**
 * Sanitize options input
 */
function crisp_persona_options_validate( $input ) {
  if( is_array($input) ) {
    $output = array();
    foreach( $input as $key => $val ) {
      $output[$key] = wp_filter_nohtml_kses( $val );
    }
  }else{
    $output = wp_filter_nohtml_kses( $input );
  }

  return $output;
}
