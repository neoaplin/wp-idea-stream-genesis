<?php
/**
 * The Template for displaying all single ideas.
 *
 * @package WP Idea Stream 2012 theme
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-meta">
							<?php wp_idea_stream_posted_on(); ?>
							<?php wp_idea_stream_ratings_single();?>
						</div><!-- .entry-meta -->
						<?php if ( comments_open() ) : ?>
							<div class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'wp-idea-stream' ) . '</span>', __( '1 Reply', 'wp-idea-stream' ), __( '% Replies', 'wp-idea-stream' ) ); ?>
							</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>
					</header><!-- .entry-header -->

					<?php if ( is_search() ) : // Only display Excerpts for Search ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php else : ?>
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-idea-stream' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp-idea-stream' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					<?php endif; ?>

					<footer class="entry-meta">
						<span class="cat-links">
							<?php wp_idea_stream_posted_in_cat(); ?>
						</span>
						<span class="meta-sep">|</span>

						<?php $tags_idea = wp_idea_stream_posted_in_tag();
						if($tags_idea):?>
						<span class="tag-links">
							<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'wp-idea-stream' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_idea ); ?>
						</span>
						<span class="meta-sep">|</span>
						<?php endif;?>
						<?php edit_post_link( __( 'Edit', 'wp-idea-stream' ), '<span class="edit-link">', '</span>' ); ?>
						<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
							<div class="author-info">
								<div class="author-avatar">
									<?php echo get_avatar( get_the_idea_author_meta( 'user_email' ), 60 ); ?>
								</div><!-- .author-avatar -->
								<div class="author-description">
									<h2><?php printf( esc_attr__( 'About %s', 'wp-idea-stream' ), get_idea_author() ); ?></h2>
									<p><?php the_idea_author_meta( 'description' ); ?></p>
									<div class="author-link">
										<a href="<?php echo get_author_idea_url( get_the_idea_author_meta( 'ID' ) ); ?>">
											<?php printf( __( 'View all ideas by %s <span class="meta-nav">&rarr;</span>', 'wp-idea-stream' ), get_idea_author() ); ?>
										</a>
									</div><!-- .author-link	-->
								</div><!-- .author-description -->
							</div><!-- .author-info -->
						<?php endif; ?>
						
						<?php wp_idea_stream_sharing_services();?>
						
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>