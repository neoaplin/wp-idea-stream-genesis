<?php
/**
 * The template for displaying ideas by category.
 *
 * @package WP Idea Stream 2012 theme
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s | %s ideas were posted in this category so far', 'wp-idea-stream' ), '<span>' . single_cat_title( '', false ) . '</span>', '<span>' . wp_idea_stream_number_ideas() . '</span>' );?></h1>
				
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				?>
				
			</header><!-- .archive-header -->
			
			<?php do_action('wp_idea_stream_before_cat_loop');?>
			
			<?php if ( ! have_posts() ) : ?>
				<article id="post-0" class="post error404 not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'No Ideas!', 'wp-idea-stream' ); ?></h1>
					</header>
					<div class="entry-content">
						<p>
						<?php 
						if(is_user_logged_in()){
							printf( __('OOps, It looks like no idea has been submitted yet, <a href="%s" title="Submit your idea">add yours</a>', 'wp-idea-stream'), wp_idea_stream_new_form() );
						}else{
							_e( 'OOps, It looks like no idea has been submitted yet, please log in to add yours!', 'wp-idea-stream' );
						}
						?>
						</p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
			<?php endif; ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<header class="entry-header">
						
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-idea-stream' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						
						<div class="entry-meta">
							<?php wp_idea_stream_posted_on(); ?>
							<?php wp_idea_stream_ratings();?>
						</div><!-- .entry-meta -->
						
						<?php if ( comments_open() ) : ?>
							<div class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'wp-idea-stream' ) . '</span>', __( '1 Reply', 'wp-idea-stream' ), __( '% Replies', 'wp-idea-stream' ) ); ?>
							</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>
					</header><!-- .entry-header -->

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->

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
					</footer><!-- .entry-meta -->
				</article><!-- #post -->
				
			<?php endwhile; // End the loop. Whew. ?>

			<?php do_action('wp_idea_stream_after_cat_loop');?>

			<div id="nav-below" class="navigation">
				<?php wp_idea_stream_paginate_link('paged'); ?>
			</div><!-- #nav-below -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>