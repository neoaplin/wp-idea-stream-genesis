<?php
/**
 * The template for displaying ideas by author.
 *
 * @package WP Idea Stream 2012 theme
 */

get_header(); ?>
<?php
 

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'custom_loop');

wp_get_current_user();

$usr = $current_user->user_login;

function custom_loop() {

$args = array ('post_type' => 'ideas', 'author_name' => 'admin' );
query_posts ($args);
?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Author Archives: %s | Amount of submitted ideas so far: %s', 'wp-idea-stream' ), "<span class='vcard'><a class='url fn n' href='" . get_author_idea_url( get_the_idea_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_idea_author() ) . "' rel='me'>" . get_idea_author() . "</a></span>", '<span>' . wp_idea_stream_number_ideas() . '</span>'  ); ?></h1>
			</header><!-- .archive-header -->

			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_idea_author_meta( 'user_email' ), 60 ); ?>
				</div><!-- .author-avatar -->
				
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'wp-idea-stream' ), get_idea_author() ); ?></h2>
					
					<?php
					// If a user has filled out their description, show a bio on their entries.
					if ( get_the_idea_author_meta( 'description' ) ) : ?>
						<p><?php the_idea_author_meta( 'description' ); ?></p>
					<?php else:?>
						<p><?php _e("This user hasn't filled his info","wp-idea-stream");?></p>
					<?php endif; ?>
				</div><!-- .author-description	-->
				<?php if(wp_idea_stream_loggedin_user_displayed()):?>
					<div id="ideastream-desc-edit" style="display:none;clear:both;margin-left:104px"><?php wp_idea_stream_desc_edit();?></div>
					<div id="ideastream-desc-action" class="author-description"><a href="javascript:void(0)" title="Edit description" id="ideastream-edit-btn"><?php _e('Edit','wp-idea-stream');?></a></div>
				<?php endif; ?>
			</div><!-- .author-info -->

			<?php /* Start the Loop */ ?>
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
				
			<?php endwhile; ?>

			<?php do_action('wp_idea_stream_after_idea_author_loop');?>

			<div id="nav-below" class="navigation">
				<?php wp_idea_stream_paginate_link(); ?>
			</div><!-- #nav-below -->

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
}
genesis();
?>
<!--
<?php get_sidebar(); ?>
<?php get_footer(); ?>-->