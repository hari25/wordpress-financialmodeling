<?php
get_header();
if(have_posts()) : while(have_posts()) : the_post(); 
// 	$author_id=$post->post_author;
// print_r($author_id);
// echo the_author_meta( 'user_nicename' , $author_id );
	$obj = get_post_type_object( 'stock_articles' );
	$tag =  get_the_tags(); ?> 
	<section id="stock-article">
		<div class="container">
			<div class="info">
			    <strong>Title:</strong> <?php echo the_title(); ?><br/>
			    <strong>Article Type</strong> <?php echo $obj->labels->singular_name; ?><br/>
			    <strong>Publish Date</strong> <?php echo get_the_date(); ?><br/>
			    <strong>Author</strong> <?php the_author(); ?>
			</div>
			<div class="content">
				<?php echo the_content();
				//this short code accepts the company symbol which is added as a tag when creating the post
				if($tag){
					echo do_shortcode( '[profile name="'. $tag[0]->name . '"]' );
				}  ?>
			</div>
		</div>
	</section>
    
<?php endwhile; endif;
//get_footer();
?>