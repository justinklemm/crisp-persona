<?php

add_action( 'admin_init', 'crisp_persona_options_init' );
add_action( 'admin_menu', 'crisp_persona_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function crisp_persona_options_init(){
	register_setting( 'crisp_persona_options_group', 'crisp_persona_options', 'crisp_persona_options_validate' );
}

/**
 * Load up the menu page
 */
function crisp_persona_options_add_page() {
	add_theme_page( __( 'Theme Options', 'crisp-persona' ), __( 'Theme Options', 'crisp-persona' ), 'edit_theme_options', 'crisp_persona_options', 'crisp_persona_options_page' );
}

/**
 * Sanitize options input
 */
function crisp_persona_options_validate( $input ) {
	$output = array();

	if( is_array($input) ) foreach( $input as $key => $val ) {
		$output[$key] = wp_filter_nohtml_kses( $val );
	}

	return $output;
}

/**
 * Create the options page
 */
function crisp_persona_options_page() {

	$crisp_persona_fields = array(
		'avatar_url' => array(
			'label'		=> 'Avatar (Photo) URL',
			'hint'		=> 'Photo shown in header. (125x125 is ideal)'
		),
		'twitter_handle' => array(
			'label'		=> 'Twitter Handle',
			'hint'		=> 'Used for social sharing links. (Do not include @)'
		),
		'show_rss_icon' => array(
			'label'		=> 'Show RSS Icon',
			'hint'		=> '',
			'options'	=> 	array(
											'yes'	=> 'Yes',
											'no'	=> 'No'
										)
		),
		'facebook_url' => array(
			'label'		=> 'Facebook URL',
			'hint'		=> '',
		),
		'gplus_url' => array(
			'label'		=> 'Google+ URL',
			'hint'		=> '',
		),
		'instagram_url' => array(
			'label'		=> 'Instagram URL',
			'hint'		=> '',
		),
		'linkedin_url' => array(
			'label'		=> 'LinkedIn URL',
			'hint'		=> '',
		),
		'twitter_url' => array(
			'label'		=> 'Twitter URL',
			'hint'		=> '',
		),
	);

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'crisp-persona' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'crisp-persona' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'crisp_persona_options_group' ); ?>
			<?php $crisp_persona_options = get_option( 'crisp_persona_options' ); ?>

			<table class="form-table">
				<?php foreach($crisp_persona_fields as $option => $details){ ?>
				<tr valign="top"><th scope="row"><?php _e( $details['label'], 'crisp-persona' ); ?>:</th>
					<td>
					<?php if(isset($details['options'])){ ?>
						<select name="crisp_persona_options[<?php echo $option; ?>]" value="<?php esc_attr_e( $crisp_persona_options[$option] ); ?>">
						<?php foreach($details['options'] as $val => $label){ ?>
						<option value="<?php echo $val; ?>"<?php echo ($crisp_persona_options[$option] == $val ? ' selected="selected"' : ''); ?>><?php _e( $label, 'crisp-persona' ); ?></option>
						<?php } ?>
						</select>
					<?php }else{ ?>
						<input class="regular-text" type="text" name="crisp_persona_options[<?php echo $option; ?>]" value="<?php esc_attr_e( $crisp_persona_options[$option] ); ?>" />
					<?php } ?>
					<?php if($details['hint']){ ?><label class="description" for="crisp_persona_options[<?php echo $option; ?>]"><?php _e( $details['hint'], 'crisp-persona' ); ?></label><?php } ?>
					</td>
				</tr>
				<?php } ?>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'crisp-persona' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}


// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
