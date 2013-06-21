<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Crisp Persona
 */

if ( ! function_exists( 'crisp_persona_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function crisp_persona_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?> group">
		<h2 class="screen-reader-text"><?php _e( 'Read more', 'crisp_persona' ); ?></h2>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'crisp_persona' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'crisp_persona' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'crisp_persona' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'crisp_persona' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // crisp_persona_content_nav

if ( ! function_exists( 'crisp_persona_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function crisp_persona_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'crisp_persona' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'crisp_persona' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="group">
				<div class="comment-meta">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s', 'crisp_persona' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					<a class="time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>"><?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'crisp_persona' ), get_comment_date(), get_comment_time() ); ?></time></a>
					<?php edit_comment_link( __( 'Edit', 'crisp_persona' ), '<span class="edit-link"> | ', '<span>' ); ?>
				</div><!-- .comment-meta -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="pending"><?php _e( 'Your comment is awaiting moderation.', 'crisp_persona' ); ?></div>
				<?php endif; ?>
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
			<?php
				comment_reply_link( array_merge( $args,array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				) ) );
			?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for crisp_persona_comment()

if ( ! function_exists( 'crisp_persona_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function crisp_persona_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'crisp_persona' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		'/about/', //esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'About %s', 'crisp_persona' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;
/**
 * Returns true if a blog has more than 1 category
 */
function crisp_persona_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so crisp_persona_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so crisp_persona_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in crisp_persona_categorized_blog
 */
function crisp_persona_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'crisp_persona_category_transient_flusher' );
add_action( 'save_post', 'crisp_persona_category_transient_flusher' );