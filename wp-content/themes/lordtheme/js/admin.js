jQuery(document).ready(function(){

    jQuery('.cache_vimeo').animate({
        opacity: 1,
        background: "black"
        }, 5000, function() {
            jQuery('.cache_vimeo').css('opacity', '0');
    });

    jQuery('.toTop').animate({ scrollTop: 0 }, 'fast');

    /* BOUTON AJOUTER MEDIA IMAGE*/
    jQuery('#contact_img_button').click(function(e) {

        var contact_uploader;

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (contact_uploader) {
            contact_uploader.open();
            return;
        }

        //Extend the wp.media object
        contact_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        contact_uploader.on('select', function() {
            attachment = contact_uploader.state().get('selection').first().toJSON();
            jQuery('#contact_img').val(attachment.url);
        });

        //Open the uploader dialog
        contact_uploader.open();
     });
    /* END BOUTON AJOUTER MEDIA */ 

    /* BOUTON AJOUTER MEDIA VIDEO*/
    jQuery('#url_vid_button').click(function(e) {

        var contact_uploader;

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (contact_uploader) {
            contact_uploader.open();
            return;
        }

        //Extend the wp.media object
        contact_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        contact_uploader.on('select', function() {
            attachment = contact_uploader.state().get('selection').first().toJSON();
            jQuery('#url_vid').val(attachment.url);
        });

        //Open the uploader dialog
        contact_uploader.open();
     });
    /* END BOUTON AJOUTER MEDIA */ 

    /* BOUTON MEDIA BIOGRAPHIE */
    jQuery('#url_bio_button').click(function(e) {

        var contact_uploader;

        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (contact_uploader) {
            contact_uploader.open();
            return;
        }

        //Extend the wp.media object
        contact_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        contact_uploader.on('select', function() {
            attachment = contact_uploader.state().get('selection').first().toJSON();
            jQuery('#background_color_bio').val(attachment.url);
        });

        //Open the uploader dialog
        contact_uploader.open();
     });
    /* END BOUTON MEDIA BIOGRAPHIE */

    // jQuery('#menu-item-124').click(function(){
    //     jQuery('html, body').animate({
    //         scrollTop: $("#Work").offset().top
    //     }, 2000);
    // });

    /* SCROLL TO ANCRE */
    jQuery('a[href^="#"]').click(function(){
        var id = jQuery(this).attr("href");
        console.log(id);
        jQuery('html, body').animate({
            scrollTop:jQuery(id).offset().top}, 
            'slow'
        );
        return false;
    });
    /* END SCROLL TO ANCRE */

    /* MUTE BUTTON VIDEO HOME */
    var video = jQuery('#video_home');

    jQuery('.mute').click(function(){
        
        if(video.prop('muted')){
            video.prop('muted', false);
            jQuery(".mute").append("<img src='../wp-content/uploads/2016/07/sound.png' class='sound_header'>");
        }
        else{
            video.prop('muted', 'muted');
            jQuery(".mute").append("<img src='../wp-content/uploads/2016/07/mute.png' class='sound_header'>");
        }
    });
    /* END MUTE BUTTON VIDEO HOME */

    /* HEADER BACKGROUND */
    var workHeight = jQuery('#Work').position();
    //console.log(workHeight.top);

    var myPosition;
    jQuery(document).scroll(function(){
        workHeight = jQuery('#Work').position();

        myPosition =  jQuery(document).scrollTop();

        if(myPosition > workHeight.top){
            jQuery('header').css('opacity','1');
        }else{
            jQuery('header').css('opacity','0.4');
        }
    });

    /* END HEADER BACKGROUND*/
});