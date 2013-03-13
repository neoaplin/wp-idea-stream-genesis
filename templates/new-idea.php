<?php
/**
 * The template for displaying the new idea form.
 *
 * @package WP Idea Stream 2012 theme
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="idea-form">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Submit your idea!', 'wp-idea-stream' ); ?></h1>
				</header>

				<div class="entry-content">
					<?php do_action('wp_idea_stream_before_form_new_idea');?>

					<?php do_action('wp_idea_stream_insert_editor');?>
				</div><!-- .entry-content -->
				<footer class="entry-meta">
					<?php do_action('wp_idea_stream_after_form_new_idea');?>
				</footer><!-- .entry-meta -->
			</article><!-- #post -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>