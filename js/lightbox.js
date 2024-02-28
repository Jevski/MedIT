jQuery(document).ready(function($) {

    function load_lightbox_image(){
        var imageLightbox = $('.lightbox-image'); // Select the element where you want to display the image
    
        $.ajax({
            url: ajaxurl,
            type: 'GET',
            data: {
                action: 'get_image_postID',
            },
            success: function (response){
                // Append the response (which should contain the post thumbnail HTML) to the imageLightbox element
                imageLightbox.html(response);
            }
        })
    }

    $('.fullscreen-button').on('click', function() {
        load_lightbox_image();
    });
    
// closing of the main lightbox//
    $(".lightbox-cross").click(function(){
        $('.lightbox-overlay, .lightbox-modale').toggleClass('inactive');
    })

    
    var image = $('.home-gallery-image');

    // Add event handlers for mouseenter and mouseleave
    image.on('mouseenter', function() {
      // Add the 'inactive' class to the related lightbox-icons
      $(this).find('.lightbox-icons').toggleClass('inactive');
    });
 


 
//   $(".random-photo, .photos-two-related img").on('mouseenter', function() {
//     console.log('Mouse entered over the image!')
//     $('.lightbox-icons').toggleClass('inactive');
//     // You can add any actions you want to perform when hovering over the image
// });



});





