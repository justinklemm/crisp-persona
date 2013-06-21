<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Crisp Persona
 */

get_header(); ?>

<div class="hfeed site">

	<div class="site-main">

		<?php get_sidebar(); ?>

		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'crisp_persona' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'crisp_persona' ); ?></p>

					<?php //get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( crisp_persona_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'crisp_persona' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

					<?php
					/* translators: %1$s: smiley */
					//$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'crisp_persona' ), convert_smilies( ':)' ) ) . '</p>';
					//the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php //the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- .site-content -->

	</div><!-- .site-main -->

	<?php get_footer(); ?>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>