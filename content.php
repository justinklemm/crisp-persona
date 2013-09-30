<?php
/**
 * @package Crisp Persona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta"><?php crisp_persona_posted_on(); ?></div><!-- .entry-meta -->
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php if(has_post_thumbnail()){ the_post_thumbnail('large', array('class' => 'featured-image featured-image-bottom')); } ?></a>
	</header><!-- .entry-header -->

	<?php /*if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else :*/ ?>
	<div class="entry-content">
		<?php
		if( get_option('rss_use_excerpt') ){
			the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'crisp_persona' ) );
			?><p><a href="<?php the_permalink(); ?>" class="more-link"><?php _e( 'Continue reading <span class="meta-nav">&rarr;</span>', 'crisp_persona' ) ?></a></p><?php
		}else{
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'crisp_persona' ) );
		}

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'crisp_persona' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<?php //endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'crisp_persona' ) );
				if ( $categories_list && crisp_persona_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'crisp_persona' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'crisp_persona' ) );
				if ( $tags_list ) :
			?>
			<?php if ( $categories_list && crisp_persona_categorized_blog() ) : ?><span class="sep"> | </span><?php endif; ?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'crisp_persona' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<?php if ( ( $categories_list && crisp_persona_categorized_blog() ) || $tags_list ) : ?><span class="sep"> | </span><?php endif; ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'crisp_persona' ), __( '1 Comment', 'crisp_persona' ), __( '% Comments', 'crisp_persona' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'crisp_persona' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-## -->
