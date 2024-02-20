jQuery(document).ready(function($) {

    const lightbox = document.createElement('div');
    lightbox.classList = 'lightbox';
    const page = document.querySelector('.page');
    document.body.insertBefore(lightbox, page);

    const lightboxOverlay= document.querySelector('.lightbox');
    const lightBoxImages = document.querySelectorAll('.home-gallery-image');
    const fullScreenButton = document.querySelector(".fullscreen-button");



    const images = document.querySelectorAll('img');
    images.forEach(image => {
        fullScreenButton.addEventListener('click', e => {
            const img = document.createElement('img')



            jQuery(document).ready(function($) {
                // AJAX call to fetch an image from your custom post type
                $('.fullscreen-button').click(function() {
                    $.ajax({
                        url: customAjax.ajaxUrl,
                        type: 'POST',
                        data: {
                            action: 'load_custom_image',
                            nonce: customAjax.nonce
                        },
                        success: function(response) {
                            // Assuming the response contains the image URL
                            var imageUrl = response.data.image_url;
                            var_dump($image_url);
                            // Display the image
                            $('#lightbox').html('<img src="' + imageUrl + '" alt="Custom Image">');
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
              });
            
        })
    })
    
        fullScreenButton.addEventListener('click', e => {
            lightbox.classList.toggle('lightbox-active')
            
           
        lightboxOverlay.addEventListener("click", function(){
            lightboxOverlay.classList.remove("lightbox-active");
        });
    });

    //const hoverIcons = document.querySelector(".lightbox-icons");

    //lightBoxImages.addEventListener('mouseenter', function() {
       // console.log('Mouse entered over the image!');
       // hoverIcons.classList.toggle('active');
        // You can add any actions you want to perform when hovering over the image
   // });

   
});

