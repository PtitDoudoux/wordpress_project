<?php
/*
Plugin Name: CreemsonPortfolio
Description : 
Version : 0.1
Author : Creemson
*/
?>
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_action( 'init', 'creemsonportfolio_init' );
//add_action('wp_enqueue_scripts', 'enqueue_masonry_script');

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function creemsonportfolio_init() {
    $labels = array(
        'name'               => _x( 'CreemsonPortfolio', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Work', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Works', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Work', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'work', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Work', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Work', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Work', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Work', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Works', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Works', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Works:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No works found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No works found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'work' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,        
        'taxonomies' => array( 'category' ),
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'work', $args );
}

    /*
    *affiche le slider
    */
    function creemsonportfolio_show($limit = 10){
        //on importe le js et le css
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', null,'2.2.4',true);
        //Masonnery
        wp_deregister_script('masonry');
        wp_enqueue_script('masonry','https://npmcdn.com/masonry-layout@4.0.0/dist/masonry.pkgd.min.js', array('jquery'),'4.0.0',true);

        wp_enqueue_script('creemsonPortfolio',plugins_url().'/creemsonPortfolio/js/creemsonPortfolio.js', array('jquery'),'1.3.2',true);

        //wp_register_script( 'creemsonPortfolio-js', plugins_url().'/creemsonPortfolio/js/creemsonPortfolio.js' , array('jquery'), '1.3.2', true );

        //wp_enqueue_script( 'creemsonPortfolio-js' );
        //wp_register_script('creemsonPortfolio',plugins_url().'/creemsonPortfolio/js/creemsonPortfolio.js', array('jquery'),'1.3.2',true);

        wp_enqueue_style('creesomportfolio',plugins_url().'/creemsonPortfolio/css/owl-carousel/creesomportfolio.css');



        //add_action('wp_footer','creemsonportfolio_script',30);

        include('/wp-content/plugins/creemsonPortfolio/template.php');
    }


/*
|--------------------------------------------------------------------------
| FILTERS
|--------------------------------------------------------------------------
*/
 
//add_filter( 'template_include', 'creemsonPortfolio_template');
 
/*
|--------------------------------------------------------------------------
| PLUGIN FUNCTIONS
|--------------------------------------------------------------------------
*/
 
/**
 * Returns template file
 *
 * @since 1.0
 */
 /*
function creemsonPortfolio_template( $template ) {
 
    // Post ID
    $post_id = get_the_ID();
 
    // For all other CPT
    if ( get_post_type( $post_id ) != 'work' ) {
        return $template;
    }
 
    // Else use custom template
    if ( is_single() ) {
        return rc_tc_get_template_hierarchy( 'single' );
    }
 
}
*/