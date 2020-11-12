<?php 
/**
 * Registers a stylesheet.
 */
add_action('init', 'my_register_styles');

function my_register_styles() {
    wp_register_style( 'fm-style', get_template_directory_uri() . '/assets/css/fm-style.css' );
    wp_register_style( 'bootstrap-style', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' );
    
}

//enqueue style sheet
add_action( 'wp_enqueue_scripts', 'my_enqueue_styles' );

function my_enqueue_styles() {
    
        wp_enqueue_style( 'fm-style' );
        wp_enqueue_style( 'bootstrap-style');
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), false );  
}

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'fm_flush_rewrite_rules' );

// Flush your rewrite rules
function fm_flush_rewrite_rules() {
	flush_rewrite_rules();
}

function financial_modeling_cpt_init() {

	// =========================================
	//   ADD News Article CUSTOM POST TYPE 
	// =========================================

    register_post_type( 'news_articles',
        array(
            'labels' => array(
                'name' => __( 'NewsArticles' ),
                'singular_name' => __( 'News Article' ),
                'menu_name'           => __( 'NewsArticles', THEME_TD ),
				'parent_item_colon'   => __( 'Parent News Article', THEME_TD ),
				'all_items'           => __( 'All NewsArticles', THEME_TD ),
				'view_item'           => __( 'View NewsArticles', THEME_TD ),
				'add_new_item'        => __( 'Add News Article', THEME_TD ),
				'add_new'             => __( 'Add New', THEME_TD ),
				'edit_item'           => __( 'Edit News Article', THEME_TD ),
				'update_item'         => __( 'Update News Article', THEME_TD ),
				'search_items'        => __( 'Search News Article', THEME_TD ),
				'not_found'           => __( 'Not Found', THEME_TD ),
				'not_found_in_trash'  => __( 'Not found in Trash', THEME_TD ),
            ),
            'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 6,
			'menu_icon'			  => 'dashicons-hammer',
            'has_archive'         => true,
            'rewrite'             => true,
			'show_in_rest'		  => true,
			'supports'            => array( 'title', 'page-attributes', 'editor' ),
			'taxonomies' => array('category', 'post_tag'), // this is IMPORTANT
			'hierarchical'        => false,
			'can_export'          => true,
			'capability_type'     => 'post',
			'rewrite' => [
				'slug'	=>	'news-article',
				'with_front' => false,
			],
        )
    );

    // =========================================
	//   ADD Stock Recommendation Article CUSTOM POST TYPE 
	// =========================================
    register_post_type( 'stock_articles',
        array(
            'labels' => array(
                'name' => __( 'stockArticles' ),
                'singular_name' => __( 'Stock Recommendation' ),
                'menu_name'           => __( 'stockArticles', THEME_TD ),
				'parent_item_colon'   => __( 'Parent stock Article', THEME_TD ),
				'all_items'           => __( 'All stockArticles', THEME_TD ),
				'view_item'           => __( 'View stockArticles', THEME_TD ),
				'add_new_item'        => __( 'Add stock Article', THEME_TD ),
				'add_new'             => __( 'Add New', THEME_TD ),
				'edit_item'           => __( 'Edit stock Article', THEME_TD ),
				'update_item'         => __( 'Update stock Article', THEME_TD ),
				'search_items'        => __( 'Search stock Article', THEME_TD ),
				'not_found'           => __( 'Not Found', THEME_TD ),
				'not_found_in_trash'  => __( 'Not found in Trash', THEME_TD ),
            ),
            'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 6,
			'menu_icon'			  => 'dashicons-hammer',
            'has_archive'         => true,
            'rewrite'             => true,
			'show_in_rest'		  => true,
			'supports'            => array( 'title', 'page-attributes', 'editor' ),
			'taxonomies' => array('category', 'post_tag'), // this is IMPORTANT
			'hierarchical'        => false,
			'can_export'          => true,
			'capability_type'     => 'post',
			'rewrite' => [
				'slug'	=>	'stock-article',
				'with_front' => false,
			],
        )
    );

}
// Hooking up our function to theme setup
add_action( 'init', 'financial_modeling_cpt_init', 0 );

function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

//use this function to display the related stock recommended posts of a company

function get_custom_posts( $args ) {

    $loop = new WP_Query($args);
    echo '<ul class="list-group list-group-flush">';

    if ( $loop->have_posts() ):
        while ($loop->have_posts()) : $loop->the_post();  ?>
            <li class="list-group-item">
	            <p>
	                <a href="<?php echo get_the_permalink();?>"><?php echo get_the_title(); ?></a>
	                
	            </p>
	        </li>
        <?php endwhile; 
    endif; //stock_loop check; 
    echo '</ul>';
    wp_reset_postdata();
}

// =========================================
//	INGEST MODULES
// =========================================

// Get a list of all the subdirectories in the Modules directory.
$dirs = array_filter(glob(get_template_directory() . '/modules/*'), 'is_dir');

foreach ( $dirs as $dir ) :
	// Get the last directory name.
	$moduleName = substr($dir, strrpos($dir, '/') + 1);
	// The directory name should match the name of the initializing php file
	$moduleInitFile = 'modules/' . $moduleName . '/' . $moduleName . '.php';
	include_once($moduleInitFile);
endforeach;


?>