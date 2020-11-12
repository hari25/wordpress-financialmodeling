<?php
/**
 * Template Name: Stock Recommendation
 */
get_header(); 

?>


<?php global $post;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        
    $args = array('post_type' => 'stock_articles', 'posts_per_page' => 3, 'order' => 'DESC', 'paged' => $paged);
    $loop = new WP_Query($args);
    if ( $loop->have_posts() ):
        while ($loop->have_posts()) : $loop->the_post(); 
            $post_tags = get_the_tags()  ?>
            
            <section id="stock-recom-archive">
                <?php echo get_the_title(); 
                    if($post_tags){
                        foreach ($post_tags as  $tag) {
                            echo do_shortcode( '[symbol name="'.$tag->name.'"]' );
                        }
                    }
                ?>
                <a href="<?php echo get_the_permalink();?>">View Article</a>
            </section>
        <?php endwhile; ?>
        <nav class="pagination">
            <?php pagination_bar( $loop ); ?>
        </nav>
        <?php wp_reset_query();
    endif; 
 //get_footer(); ?>