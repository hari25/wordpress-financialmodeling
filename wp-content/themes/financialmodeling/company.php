<?php
/**
 * Template Name: Company
 */
get_header(); 
$recommended = get_field('recommended');
$tag = get_field('company_symbol');
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


// creating the key and checking if the data is already available in cache
$profile_cache_key = 'profile'. $tag;

$profile_response = get_transient( $profile_cache_key );

if ( false === $profile_response ) {
     $profile_response = make_data_request($tag, 'profile/');
    set_transient( $profile_cache_key, $profile_response );
} 

$companyName =  $profile_response[0]->companyName;
$description =  $profile_response[0]->description;
$image =  $profile_response[0]->image;

?>
<section id="company">
    <div class="container">
        <div class="content text-center">
            <div class="desc col">
                <?php if(!empty($companyName)): ?>
                    <h1 class="title"><?php echo $companyName; ?></h1>
                <?php endif; ?>
                <?php if(!empty($description)): ?>
                    <p><?php echo $description; ?></p>
                <?php endif; ?>
            </div>
            <?php if(!empty($image)): ?>
                <div class="logo col text-center">
                    <img src="<?php echo $image;?>" alt="<?php echo $companyName ;?>  logo " />
                </div>
            <?php endif; ?>

        </div>
        <?php echo do_shortcode( '[company name="'.$tag.'"]' ); ?>

        <!-- we could achieve the following by creating a gutenberg block using ACF Pro -->
        <div class="info">
            <?php if($recommended[0] === "true" && $paged < 2 ): 
                
                $stock_args = array('post_type' => 'stock_articles','posts_per_page' => -1, 'order' => 'DESC', 'tag' =>$tag );
                ?>
                <div class="stock-recommendations">
                    <h2 class="topic">Recommendations</h2>
                    <?php get_custom_posts($stock_args); ?>
                </div>
                
            <?php endif; //recommended check?>

            <?php 
                $args = array('post_type' => 'news_articles','posts_per_page' => 10, 'order' => 'DESC', 'newstag' =>$tag, 'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1) ); 
                $loop = new WP_Query($args); //we need this for pagination?>

                <!-- shows related news articles of the company -->
                <div class="news-articles"> 
                    <h2 class="topic">Other Coverage</h2>
                    <?php get_custom_posts($args); ?>
                </div>
        </div>
        <nav class="pagination">
            <?php pagination_bar( $loop ); ?>
        </nav>


    </div>
    
</section>

<?php get_footer(); ?>