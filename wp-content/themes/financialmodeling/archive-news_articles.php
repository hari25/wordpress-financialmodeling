<?php

get_header(); 

?>

<section id="news-archive">
    <div class="container">
        <?php global $post;
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                
            $args = array('post_type' => 'news_articles', 'posts_per_page' => 10, 'order' => 'DESC', 'paged' => $paged);
            $loop = new WP_Query($args);
            if ( $loop->have_posts() ):
                while ($loop->have_posts()) : $loop->the_post(); 
                    $post_tags = get_the_tags()  ?>
                    
                    <div class="news-article-info">
                        <h3><?php echo get_the_title();?></h3>
                            <?php if($post_tags){
                                foreach ($post_tags as  $tag) {
                                    echo do_shortcode( '[symbol name="'.$tag->name.'"]' );
                                }
                            }
                        ?>
                        <a href="<?php echo get_the_permalink();?>">View Article<span> -></span></a><br/>
                    </div>
                <?php endwhile; ?>
                <nav class="pagination">
                    <?php pagination_bar( $loop ); ?>
                </nav>
                <?php wp_reset_query();
            endif; ?>
        </div>
</section>
 <?php get_footer(); ?>