
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
        //On ecrit le code html
?>

<style type="text/css">
    .owl-buttons{
        position: absolute;
        bottom: 4%;
        left: 1%;
        color: white;

    } 

    .owl-prev:hover, .owl-next:hover{
        cursor: pointer;
        color: black;
    }   
    .owl-buttons i{
        font-size: 30px;

    }
</style>
<?php
        $myargs = array(
            'post_type' => 'slide',
            'post_per_page' => $limit,
        );
        $slides = new WP_Query($myargs);


        echo '<div id="creemsonslider" class="owl-carousel">';
            while($slides->have_posts()){
                echo '<div class="slide" style="text-align:center; background-color:#333333">';
                    $slides->the_post();
                    global $post;
                echo '<a href="'.esc_attr(get_post_meta($post->ID, 'creemsonslider_link',true)).'">';
                    the_post_thumbnail('slider');
                echo '</a></div>';
            }

        echo '</div>';
?>
<script type="text/javascript">
jQuery(document).ready(function(){
    
    jQuery('.owl-next').html('<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>');
    jQuery('.owl-prev').html('<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>');
});

</script>