<?php
/**
 * Template Name: Company
 */
get_header(); 
$logo = get_field('company_logo');
$name = get_field('company_name');
$desc = get_field('company_description');
$recommended = get_field('recommended');
$tag = get_field('company_symbol');
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

?>
<section id="company">
    <div class="container">
        <div class="content text-center">
            <div class="desc col">
                <h1 class="title"><?php echo $name; ?></h1>
                <p><?php echo $desc; ?></p>
            </div>
            <div class="logo col text-center">
                <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['alt'];?>" />
            </div>

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
                $news_args = array('post_type' => 'news_articles','posts_per_page' => 10, 'order' => 'DESC', 'tag' =>$tag, 'paged' => $paged ); 
                $news_loop = new WP_Query($new_args); //we need this for pagination?>

                <!-- shows related news articles of the company -->
                <div class="news-articles"> 
                    <h2 class="topic">Other Coverage</h2>
                    <?php get_custom_posts($news_args); ?>
                </div>
        </div>
        <nav class="pagination">
            <?php pagination_bar( $news_loop ); ?>
        </nav>


    </div>
    
</section>

<?php 
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_5fa8a3ea5eb70',
    'title' => 'Company page info',
    'fields' => array(
        array(
            'key' => 'field_5fa8a411eec3a',
            'label' => 'Company logo',
            'name' => 'company_logo',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        array(
            'key' => 'field_5fa8a42feec3b',
            'label' => 'Company Name',
            'name' => 'company_name',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_5fa8a43aeec3c',
            'label' => 'company description',
            'name' => 'company_description',
            'type' => 'textarea',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => '',
            'new_lines' => '',
        ),
        array(
            'key' => 'field_5fa8a468eec3d',
            'label' => 'company symbol',
            'name' => 'company_symbol',
            'type' => 'text',
            'instructions' => 'eg: enter SBUX for Starbucks',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_5fa8a495eec3e',
            'label' => 'Recommended',
            'name' => 'recommended',
            'type' => 'checkbox',
            'instructions' => 'if checked recommendation articles for this company will be displayed from the stock articles post type',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'true' => 'Show',
                'false' => 'Don\'t show',
            ),
            'allow_custom' => 0,
            'default_value' => array(
            ),
            'layout' => 'vertical',
            'toggle' => 0,
            'return_format' => 'value',
            'save_custom' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'company.php',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));

endif;
 get_footer(); ?>