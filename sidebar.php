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
			<div class="site-avatar"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php if($crisp_persona_options['avatar_url']){ echo($crisp_persona_options['avatar_url']); }else{ echo(get_template_directory_uri().'/images/avatar.png'); } ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></div>
			<div class="site-branding">
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
				<div class="site-description"><?php bloginfo( 'description' ); ?></div>
				<div class="bottom"></div>
			</div>
		</header><!-- .site-header -->

		<?php
		// Only social social box if there's something to show...
		if(
			$crisp_persona_options['facebook_url'] ||
			$crisp_persona_options['instagram_url'] ||
			$crisp_persona_options['twitter_url'] ||
			$crisp_persona_options['gplus_url'] ||
			$crisp_persona_options['linkedin_url'] ||
			$crisp_persona_options['show_rss_icon'] != 'no'
		){
		?>
		<aside class="widget social-links">
			<div class="title">Find me on the web</div>
			<ul class="linear group">
				<?php if($crisp_persona_options['facebook_url']){ ?><li><a class="facebook" href="<?php echo($crisp_persona_options['facebook_url']); ?>">Facebook</a></li><?php } ?>
				<?php if($crisp_persona_options['instagram_url']){ ?><li><a class="instagram" href="<?php echo($crisp_persona_options['instagram_url']); ?>">Instagram</a></li><?php } ?>
				<?php if($crisp_persona_options['twitter_url']){ ?><li><a class="twitter" href="<?php echo($crisp_persona_options['twitter_url']); ?>">Twitter</a></li><?php } ?>
				<?php if($crisp_persona_options['gplus_url']){ ?><li><a class="gplus" href="<?php echo($crisp_persona_options['gplus_url']); ?>">Google+</a></li><?php } ?>
				<?php if($crisp_persona_options['linkedin_url']){ ?><li><a class="linkedin" href="<?php echo($crisp_persona_options['linkedin_url']); ?>">Linked In</a></li><?php } ?>
				<?php if($crisp_persona_options['show_rss_icon'] != 'no'){ ?><li><a class="rss" href="<?php echo esc_url( home_url( '/' ) ); ?>feed/">RSS</a></li><?php } ?>
			</ul>
		</aside>
		<?php } ?>

		<?php
		// Include other dynamic sidebar widget
		if(function_exists('dynamic_sidebar')) dynamic_sidebar( 'sidebar-1' );
		?>

	</div><!-- .site-personal -->
