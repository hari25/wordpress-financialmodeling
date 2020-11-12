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

// =========================================
// CUSTOM POST TYPE SETUP
// =========================================
include_once( 'settings/custom-post-type.php' );

// =========================================
// ACF FIELDS SETUP
// =========================================
include_once( 'settings/acf-fields.php' );

//pagination for post types

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

//Registering a Header menu

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

//use this function to display the related stock recommended posts or news articles of a company

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

//make api request
function make_api_request( $tag, $param ) {
	$name = strtoupper($tag);
 	$response = wp_remote_get ( $this->apiUrl .$param . $name .'?apikey='. API_KEY, array ( 'sslverify' => false ) );
    if (!is_wp_error ($response) ) {
        $body =  wp_remote_retrieve_body($response);
        $data = json_decode( $body );
        return $data;
        
    }
    else{
    	return null;
    }
} 


?>