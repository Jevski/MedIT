jQuery(document).ready(function($) {

    const lightbox = $('<div class="lightbox"></div>');
    const page = $('.page');
    $('body').prepend(lightbox);

    const lightboxOverlay = $('.lightbox');
    const lightBoxImages = $('.home-gallery-image');

    $(lightBoxImages).each(function() {
        $(this).on("click", function(){
            lightbox.toggleClass("lightbox-active");
        });
    });

    lightboxOverlay.on("click", function(){
        lightboxOverlay.removeClass("lightbox-active");
    });

    // const hoverIcons = $(".lightbox-icons");

    // lightBoxImages.on('mouseenter', function() {
    //     console.log('Mouse entered over the image!');
    //     hoverIcons.toggleClass('active');
    //     // You can add any actions you want to perform when hovering over the image
    // });
    console.log(lightBoxImages);
});


