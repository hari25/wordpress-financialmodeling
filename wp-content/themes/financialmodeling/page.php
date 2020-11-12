<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test
 */

//get_header();
?>

	<main id="primary" class="site-main">
		<h1>This is the page.php</h1>
		<?php 
			if (have_posts()) : while (have_posts()) : the_post();

				$the_content = apply_filters('the_content', get_the_content());

				if ( !empty($the_content) ) : ?>
				<article <?php echo post_class('constrained-width'); ?> id="post-<?php the_ID(); ?>">
					<?php echo $the_content; ?>
				</article>
				<?php endif;
			
			endwhile; endif; ?>

	</main><!-- #main -->

<?php
//get_sidebar();
//get_footer();
