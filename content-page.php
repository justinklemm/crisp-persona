<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Crisp Persona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if(has_post_thumbnail()){ the_post_thumbnail('large', array('class' => 'featured-image')); } ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'crisp_persona' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'crisp_persona' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	
</article><!-- #post-## -->
