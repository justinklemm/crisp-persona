<?php
/**
 * @package Crisp Persona
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if(has_post_thumbnail()){ the_post_thumbnail('large', array('class' => 'featured-image')); } ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta"><?php crisp_persona_posted_on(); ?></div>
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

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'crisp_persona' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'crisp_persona' ) );

			if ( ! crisp_persona_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'crisp_persona' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'crisp_persona' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'crisp_persona' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'crisp_persona' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', 'crisp_persona' ), '<span class="edit-link"> | ', '</span>' ); ?>

		<?php
		// Get custom theme options
		$crisp_persona_options = get_option( 'crisp_persona_options' );

		$postTitle = get_the_title();
		$postUrl = get_permalink();
		$encodedTitle = urlencode($postTitle);
		$encodedUrl = urlencode($postUrl);
		?>
		<ul id="social-sharing" class="linear social-sharing">
			<li><a href="http://twitter.com/share" class="socialite twitter-share" data-text="<?php echo($postTitle); if($crisp_persona_options['twitter_handle']){ echo(" by @{$crisp_persona_options['twitter_handle']}"); } ?>" data-url="<?php echo($postUrl); ?>" data-count="vertical" rel="nofollow" target="_blank"><span class="vhidden">Share on Twitter</span></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo($encodedUrl); ?>" class="socialite googleplus-one" data-size="tall" data-href="<?php echo($postUrl); ?>" rel="nofollow" target="_blank"><span class="vhidden">Share on Google+</span></a></li>
			<li><a href="http://www.facebook.com/sharer.php?u=<?php echo($encodedUrl); ?>&amp;t=<?php echo($encodedTitle); ?>" class="socialite facebook-like" data-href="<?php echo($postUrl); ?>" data-send="false" data-layout="box_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden">Share on Facebook</span></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo($encodedUrl); ?>&amp;title=<?php echo($encodedTitle); ?>" class="socialite linkedin-share" data-url="<?php echo($postUrl); ?>" data-counter="top" rel="nofollow" target="_blank"><span class="vhidden">Share on LinkedIn</span></a></li>
		</ul>
	</footer><!-- .entry-meta -->
	
</article><!-- #post-## -->
