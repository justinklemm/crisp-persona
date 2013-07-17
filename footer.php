<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Crisp Persona
 */
?>

	<footer class="site-footer group" role="contentinfo">
		<div class="footer-content">
			
			<div class="footer-links group">
				<div class="col popular-posts">
					<h3>Popular Posts</h3>
					<ul>
					<?php
					$popular = new WP_Query( array( 'posts_per_page' => 2, 'meta_key' => 'post_view_count', 'orderby' => 'meta_value_num', 'order' => 'DESC' ) );
					while ( $popular->have_posts() ) : $popular->the_post();
					?>
					<li class="post">
						<div class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
						<p class="post-content"><?php echo crisp_persona_truncate( get_the_content() ); ?></p>
					</li>
					<?php endwhile; ?>
					</ul>
				</div>
				<div class="col category-links">
					<h3>Categories</h3>
					<ul>
					<?php
						wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 6,
						) );
					?>
					</ul>
				</div>
				<div class="col page-links">

					<h3>Other Sections</h3>
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false ) ); ?>
				</div>
			</div>

			<div class="site-info">
				<?php $theme = wp_get_theme(); ?>
				<p>I'm using the <a href="<?php echo $theme->get( 'ThemeURI' ); ?>"><?php echo $theme->get( 'Name' ); ?></a> WordPress theme.</p>
			</div>
		</div><!-- .footer-content -->
	</footer><!-- .site-footer -->
