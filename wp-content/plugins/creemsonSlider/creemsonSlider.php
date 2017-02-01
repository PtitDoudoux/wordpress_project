<?php
/*
Plugin Name: CreemsonSlider
Description : 
Version : 0.1
Author : Creemson
*/
?>
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
class Creemson_Slider
{
    public function __construct()
    {
        add_filter('wp_title', array($this, 'modify_page_title'), 20) ;
    }

    public function modify_page_title($title)
    {
        return $title . ' | Creemson' ;
    }
}

new Creemson_Slider();
*/

    add_action('init','creemsonslider_init');
    add_action('add_meta_boxes','creemsonslider_metaboxes');
    add_action('save_post','creemsonslider_savepost',10,2);
    add_action('manage_edit-slide_columns', 'creemsonslider_columnfilter');
    add_action('manage_posts_custom_column', 'creemsonslider_column');
    add_shortcode('creemsonSlider','creemsonslider_show');


    //Initialise les functions liées au carrousel
    function creemsonslider_init(){

        $labels = array(
            'name' => 'CreemsonSlider',
            'singular_name' => 'Slide',
            'add_new' => 'Ajouter un Slide',
            'add_new_item' => 'Ajouter un nouveau slide'
        );
        //ajoute un type de post
    	register_post_type('slide',array(
    			'public' => true,
                'publicly_queryable'=> false,
                'labels' => $labels,
                'menu_position'=>9,
                'capability_type'=>'post',
                'supports'=> array('title','thumbnail')
    		));
        //ajoute la fonction image à la une
        add_theme_support( 'post-thumbnails' ); 
        //ajoute une taille d'image par défaut
        //add_image_size('thumb_slide',50,50,true);
        add_image_size('slider','',500,true);
    }

    /*
    *   Ajoute une apercu de l'image dans la liste des slides
    */
    function creemsonslider_columnfilter($columns){
        $thumb = array('thumbnail'=>'Image');
        $columns = array_slice($columns, 0, 1) + $thumb +array_slice($columns, 1,null);
        return $columns;
    }

    function creemsonslider_column($column){
        global $post;       
        if($column == 'thumbnail'){

            echo edit_post_link(get_the_post_thumbnail($post->ID),null,null, $post->ID);
        }
    }

    /*
    *   Gere les metaboxes
    */
    function creemsonslider_metaboxes(){
        add_meta_box(
            'creemsonslider',
            'Lien',
            'creemsonslider_metabox',
            'slide',
            'normal',
            'high'
            );
    }

    /*
    *   Metabox pour gérer le lien
    */
    function creemsonslider_metabox($object){
        wp_nonce_field('creemsonslider','creemsonslider_nonce');
        ?>
        <div class="meta-box-item-title">
            <h4>Lien de ce slide</h4>
        </div>
        <div class="meta-box-item-content">
            <input type="text" name="creemsonslider_link" style="width: 100%;" value="<?= esc_attr(get_post_meta($object->ID, 'creemsonslider_link',true)); ?>">
        </div>

        <?php
    }

    /*
    *gere la sauvegarde de la metabox
    */
    function creemsonslider_savepost($post_id, $post){
       //var_dump($_POST);
       //var_dump($post);
        if(!isset($_POST['creemsonslider_link']) || !wp_verify_nonce($_POST['creemsonslider_nonce'],'creemsonslider')){
            return $post_id;
        }
        // verifie les droits de l'utilisateur
        $type = get_post_type_object($post->post_type);
        if(!current_user_can($type->cap->edit_post)){
           return $post_id; 
        }

        update_post_meta($post_id, 'creemsonslider_link', $_POST['creemsonslider_link']);
    }



    /*
    *affiche le slider
    */
    function creemsonslider_show($limit = 10){
        //on importe le js et le css
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', null,'2.2.4',true);
        wp_enqueue_script('owl-carousel',plugins_url().'/creemsonslider/js/owl-carousel/owl.carousel.min.js', array('jquery'),'1.3.2',true);
        wp_enqueue_style('owl-carousel',plugins_url().'/creemsonslider/css/owl-carousel/owl.carousel.css');
        wp_enqueue_style('owl-carousel',plugins_url().'/creemsonslider/css/owl-carousel/owl.theme.css');
        wp_enqueue_style('owl-carousel',plugins_url().'/creemsonslider/css/owl-carousel/owl.transitions.css');
        //wp_enqueue_style('cremsonslider',plugins_url().'/creemsonslider/css/creemsonslider.css');


        add_action('wp_footer','creemsonslider_script',30);

        include('/wp-content/plugins/creemsonSlider/template.php');

        //var_dump($slides);
    }




    /*
    *  Le script du creemsonslider
    */
    function creemsonslider_script(){
        ?>
        <script type="text/javascript">
            (function($) {
                //console.log('yo');
                $("#creemsonslider").owlCarousel({
                    autoHeight : true, 
                    //Default
                    items : 1,
                    itemsCustom : false,
                    itemsDesktop : [479,4],
                    //itemsDesktopSmall : [980,3],
                    //itemsTablet: [768,2],
                    itemsTabletSmall: false,
                    itemsMobile : [479,1],
                    singleItem : false,
                    itemsScaleUp : false,
                    //navigation
                    navigation : true,
                    navigationText : ["prev","next"],
                    rewindNav : true,
                    scrollPerPage : false,
                    autoPlay: true,

                    // Responsive 
                    responsive: true,
                    responsiveRefreshRate : 200,
                    responsiveBaseWidth: window,
                 
                    // CSS Styles
                    baseClass : "owl-carousel",
                    theme : "owl-theme",
                });
                //console.log('yoyo');
             })(jQuery);
        </script>
        <?php
    }