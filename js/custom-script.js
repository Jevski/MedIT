jQuery(document).ready(function($) {
    var smallLightbox = $('.small-lightbox');
    var galleryImage = $('.gallery-image');
    var mouseEnterFunction = () => {
        smallLightbox.removeClass('inactive');
       }
    
       var mouseExitFunction = () => {
        smallLightbox.addClass('inactive');
       }

var baseURL = 'http://mota-photographe.local/wp-content/themes/MotaTheme';

var page = 2;
var offset = 0;
var canLoadMore = true;
var numberphoto = 2;


var fullscreenbutton= "/assets/Icons/Icon_fullscreen.png";
console.log(fullscreenbutton);

var img1 = document.createElement("imgButton");
img1.src = "/assets/Icons/Icon_fullscreen.png";

load_more_photos_action();
  
   

function load_more_photos_action() {
    if (canLoadMore) {
        var id_format = $('#format-select').val();
        var id_category = $('#category-select').val();
        var id_order = $('#order-select').val();

        console.log(id_order);
        var category = '';
        var format = '';
        var order = '';

        if (id_category  !== '' && id_category !== undefined){
            category = 'mota-category=' + id_category + '&';
        }
        if (id_format  !== '' && id_format!== undefined){
            format = 'mota-format=' + id_format + '&';
        }
        if (id_order  !== '' && id_order !== undefined){
            order =  id_order + '&';
        }
        

        // var requestURL = scripts_params.rest_url + 'wp/v2/photos?' + category + format + order + 'per_page=' + page + '&offset=' + offset + '&_embed=true';

        var requestURL = `${scripts_params.rest_url}wp/v2/photos?${category}${format}${order}per_page=${page}&offset=${offset}&_embed=true`;

        $.ajax({
            url: requestURL,
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response.length === 0) {
                    // No more posts available, display error message
                    $('.ajax-container').append('<p>Pas de photos trouvées.</p>');
                    canLoadMore = false; // Disable further loading
                    if (canLoadMore) {
                        $('#load-more-photos').show();
                    } else {
                        $('#load-more-photos').hide();
                    }
                } else {

                    $.each(response, function(index, photo) {
                        var imageDiv = '<div class="home-gallery-image"></div>'; // Create lightbox-hover div
                        var image = '<img class="gallery-image" src="' + photo._embedded['wp:featuredmedia'][0].source_url + '" class="fullscreen-button-image" data-image-id="' + photo.id + '">'; // Create image element
                        var customDiv = '<div class="small-lightbox "></div>'; // Create your custom div
                        var customIconFull = `<img class="fullscreen-button2"  src="${baseURL}/assets/Icons/Icon_fullscreen.png">`; // Create image inside custom div with PHP output
                        var customIconView = `<img class="view-button2 " src="${baseURL}/assets/Icons/Icon_eye.png">`; // Create image inside custom div with PHP output
console.log(image);

                        // js functions for hover
                        $(galleryImage).hover(mouseEnterFunction, mouseExitFunction);
                            // Add the 'inactive' class to the related lightbox-icons
                            
                          

                        // Append image to the custom div
                        // customDiv.append(customIconView);
                        // customDiv.append(customIconFull);
                    
                        // Append image and custom div to the lightbox-hover div
                        // imageDiv.append(image);
                        // imageDiv.append(customDiv);
                    
                        // Append the constructed lightbox-hover div to the container
                        $('.ajax-container').append(imageDiv);
                    });
                    offset += numberphoto;
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}

$('.lightbox-hover').click(function(){
    console.log('you hovered over')
    $(this).siblings('.your-custom-div').toggleClass('inactive');
    
});




$('#category-select, #format-select, #order-select').change(function() {
    // Reset the offset variable to 0
    offset = 0;
    // Clear the content of the container
    $('.ajax-container').empty();
    // Load more photos based on the new filters
    load_more_photos_action();
    // Show or hide the "Load More" button based 
});


$('#load-more-photos').on('click', function() {
    console.log('youve clicked the button');
      load_more_photos_action();
      
  });



  $(".lightbox-cross img").click(function(){
    $('.lightbox-overlay, .lightbox-modale').toggleClass('inactive');
})



  // big lightbox

//   $(document).on('click', '.fullscreen-button', function() {
//     var motaCategory = 'category';
//     var motaFormat = 'format';

//     var requestImage = scripts_params.rest_url + 'wp/v2/photos?' + motaCategory + '&' + motaFormat + '&_embed=true';

//     $.ajax({
//         url: requestImage,
//         type: 'GET',
//         success: function(response, photo) {
//             // Assuming response contains the data to populate the lightbox
//             $('.lightbox-overlay').append('<img class="lightbox-image" src="' + photo._embedded['wp:featuredmedia'][0].source_url + '" data-image-id="' + photo.id + '">');
//             // Open your lightbox and populate it with the response data
//             openLightbox(response);
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// });

var image = $('.home-gallery-image');

    // Add event handlers for mouseenter and mouseleave
    image.on('mouseenter', function() {
      // Add the 'inactive' class to the related lightbox-icons
      $(this).find('.lightbox-icons').toggleClass('inactive');
    });

});
