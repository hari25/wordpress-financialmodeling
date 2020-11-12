
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="site-info">
			<?php $blog_info = get_bloginfo( 'name' ); ?>
			<?php if ( ! empty( $blog_info ) ) : ?>
				<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<p>Copyright © 2020</p>
			<?php endif; ?>
			
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
