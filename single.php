<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Crisp Persona
 */

get_header(); ?>

<div class="hfeed site">

	<div class="site-main">

		<?php get_sidebar(); ?>

		<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php //crisp_persona_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- .site-content -->

	</div><!-- .site-main -->

	<?php get_footer(); ?>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>