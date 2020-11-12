<?php
get_header();
if(have_posts()) : while(have_posts()) : the_post(); 
	$obj = get_post_type_object( 'stock_articles' );
	$tag =  get_the_tags(); ?> 
	<section id="stock-article">
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
				<?php //this short code accepts the company symbol which is added as a tag when creating the post
				if($tag){
					echo '<aside>';
					echo do_shortcode( '[profile name="'. $tag[0]->name . '"]' );
					echo '</aside>';
				}  ?>
			</div>
		</div>
	</section>
    
<?php endwhile; endif;
//get_footer();
?>