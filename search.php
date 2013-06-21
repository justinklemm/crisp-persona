<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Crisp Persona
 */

get_header(); ?>

<div class="hfeed site">

	<div class="site-main">

		<?php get_sidebar(); ?>

		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'crisp_persona' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php crisp_persona_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</div><!-- .site-content -->

	</div><!-- .site-main -->

	<?php get_footer(); ?>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>