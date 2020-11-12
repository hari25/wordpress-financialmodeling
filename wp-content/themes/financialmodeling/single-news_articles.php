<?php
get_header();
if(have_posts()) : while(have_posts()) : the_post(); 
	$obj = get_post_type_object( 'news_articles' ); ?>
	<section id="news-article">
		<div class="container">
			<div class="info mb-50">
				<h1><?php echo the_title(); ?></h1>
				<p>by <span class="pink"><?php the_author(); ?></span> | <?php echo get_the_date(); ?> </p>
			    
			    <strong>Article Type:</strong> <?php echo $obj->labels->singular_name; ?><br/>
			    
			</div>
			<div class="content">
				<div class="inner-content">
					<?php echo the_content();?>
				</div>
			</div>
		</div>
	</section>
    
<?php endwhile; endif;
//get_footer();
?>