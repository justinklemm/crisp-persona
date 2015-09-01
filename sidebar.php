<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Crisp Persona
 */

// Get custom theme options
$crisp_persona_options = get_option( 'crisp_persona_options' );
?>

	<div class="site-personal" role="complementary">

		<header class="site-header" role="banner">
			<div class="site-avatar"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img <?php if($crisp_persona_options['avatar_round']){ echo('class="round" '); } ?>src="<?php if($crisp_persona_options['avatar_url']){ echo($crisp_persona_options['avatar_url']); }else{ echo(get_template_directory_uri().'/images/avatar.png'); } ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></div>
			<div class="site-branding">
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
				<div class="site-description"><?php bloginfo( 'description' ); ?></div>
				<div class="bottom"></div>
			</div>
		</header><!-- .site-header -->

		<?php
		// Only social social box if there's something to show...
		if(
			!empty( $crisp_persona_options['mail_url'] ) ||
			!empty( $crisp_persona_options['github_url'] ) ||
			!empty( $crisp_persona_options['facebook_url'] ) ||
			!empty( $crisp_persona_options['instagram_url'] ) ||
			!empty( $crisp_persona_options['twitter_url'] ) ||
			!empty( $crisp_persona_options['gplus_url'] ) ||
			!empty( $crisp_persona_options['linkedin_url'] ) ||
			!empty( $crisp_persona_options['show_rss_icon'] )
		){
		?>
		<aside class="widget social-links">
			<div class="title">Find me on the web</div>
			<ul class="linear group">
				<?php if( !empty( $crisp_persona_options['mail_url'] ) ){ ?><li><a class="mail" href="<?php echo esc_url( $crisp_persona_options['mail_url'] ); ?>" title="Mail"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['github_url'] ) ){ ?><li><a class="github" href="<?php echo esc_url( $crisp_persona_options['github_url'] ); ?>" title="GitHub"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['facebook_url'] ) ){ ?><li><a class="facebook" href="<?php echo esc_url( $crisp_persona_options['facebook_url'] ); ?>" title="Facebook"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['instagram_url'] ) ){ ?><li><a class="instagram" href="<?php echo esc_url( $crisp_persona_options['instagram_url'] ); ?>" title="Instagram"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['twitter_url'] ) ){ ?><li><a class="twitter" href="<?php echo esc_url( $crisp_persona_options['twitter_url'] ); ?>" title="Twitter"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['gplus_url'] ) ){ ?><li><a class="gplus" href="<?php echo esc_url( $crisp_persona_options['gplus_url'] ); ?>" title="Google+"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['linkedin_url'] ) ){ ?><li><a class="linkedin" href="<?php echo esc_url( $crisp_persona_options['linkedin_url'] ); ?>" title="Linked In"></a></li><?php } ?>
				<?php if( !empty( $crisp_persona_options['show_rss_icon'] ) ){ ?><li><a class="rss" href="<?php bloginfo('rss2_url'); ?>" title="RSS"></a></li><?php } ?>
			</ul>
		</aside>
		<?php } ?>

		<?php
		// Include other dynamic sidebar widget
		if( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( 'sidebar-1' );
		?>

	</div><!-- .site-personal -->