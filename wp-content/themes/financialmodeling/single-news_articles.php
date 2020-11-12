<?php
get_header();
if(have_posts()) : while(have_posts()) : the_post(); 
	$obj = get_post_type_object( 'news_articles' ); ?>
	<section id="news-article">
		<div class="container">
			<div class="info">
			    <strong>Title:</strong> <?php echo the_title(); ?><br/>
			    <strong>Article Type</strong> <?php echo $obj->labels->singular_name; ?><br/>
			    <strong>Publish Date</strong> <?php echo get_the_date(); ?><br/>
			    <strong>Author</strong> <?php  the_author(); ?>
			</div>
			<div class="content">
				<?php echo the_content(); ?>
			</div>
		</div>
	</section>
    
<?php endwhile; endif;
//get_footer();
?>