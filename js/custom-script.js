jQuery(document).ready(function($) {

var baseURL = scripts_params.theme_url;


let currentPhotoIndex = 0;
let photoData = []; // Array to store fetched photo data

const lightboxImg = $('#lightbox-info-img');
const nextBtn = $('.lightbox-next');

var galleryImage =$('.gallery-image');
var page = 2;
var offset = 0;
var canLoadMore = true;
var numberphoto = 2;


load_more_photos_action();

  // Handler for toggler lightbox
function handlerIn() {
    $(this).find('.small-lightbox').toggleClass('inactive');
}

function handlerOut() {
    $(this).find('.small-lightbox').toggleClass('inactive');
}

//Ajax call for photos//

function load_more_photos_action() {
    if (canLoadMore) {
        var id_format = $('#format-select').val();
        var id_category = $('#category-select').val();
        var orderascdesc = $('#order-select').val();

        var category = '';
        var format = '';
        var order = '';

        if (id_category  !== '' && id_category !== undefined){
            category = 'mota-category=' + id_category + '&';
        }
        if (id_format  !== '' && id_format!== undefined){
            format = 'mota-format=' + id_format + '&';
        }
        if (orderascdesc  !== '' && orderascdesc !== undefined){
            order =  'order=' +orderascdesc + '&';
        }
        

        var requestURL = `${scripts_params.rest_url}wp/v2/photos?${category}${format}${order}per_page=${page}&offset=${offset}&_embed=true`;

        $.ajax({
            url: requestURL,
            type: 'GET',
            success: function(response) {
               // console.log(response);
                if (response.length === 0) {
                    // No more posts available, display error message
                    $('.ajax-container').append('<p>Pas de photos trouvées.</p>');
                  
                } else {
                    

                    $.each(response, function(index, photo) {
                        var category = photo['_embedded']['wp:term'][0][0]['name'];
                        // console.log(category); 
                        var Format = photo['_embedded']['wp:term'][1][0]['name'];
                        // console.log(Format);
                        var title = photo['title']['rendered'];
                        // console.log(title);
                        
                        // structure of image gallery//
                        var imageDiv = $('<div class="home-gallery-image"></div>'); 
                        var imageAjax = $('<div id="img-' + photo.id + '"><img class="gallery-image" src="' + photo._embedded['wp:featuredmedia'][0].source_url + '" class="fullscreen-button-image" data-image-id="' + photo.id.title + '"></div>'); // Create image element
                        var customDiv = $('<div class="small-lightbox inactive"></div>'); // Create your lightbox div
                        //getting the icons for the hover lightbox
                        var customIconFull = $('<img class="fullscreen-button" title="'+ title + '" cat="'+ category +'" id="post-' + photo.id + '" src="' + scripts_params.theme_url + '/assets/Icons/Icon_fullscreen.png">'); // Create image inside custom div with PHP output
                        var customIconView = $('<a href="' + photo.link + '"> <img class="view-button" src="' + scripts_params.theme_url + '/assets/Icons/Icon_eye.png"></a>');                        
                        // getting the details for the hover lightbox
                        var customCat= $(`<div class="customCategory">${category}</div>`);
                        var customTitle= $(`<div class="customTitle">${title}</div>`);
 


                        // function for hover
                            $(imageDiv ).on( "mouseenter", handlerIn ).on( "mouseleave", handlerOut );
                            
                        // Append icons to the custom div
                        customDiv.append(customIconView, customIconFull,customCat, customTitle);
                    
                        //Append image div to the lightbox div
                        imageDiv.append(imageAjax, customDiv);
                    
                        
                        // Append the constructed lightbox div to the ajax container
                        $('.ajax-container').append(imageDiv);
                        // $('.lightbox-info-title').append(customTitle, customCat);

                        
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




//filters changes//
$('#category-select, #format-select, #order-select').change(function() {

    // Reset the offset variable to 0
    offset = 0;
    // Clear the content of the container
    $('.ajax-container').empty();
    // Load more photos based on the new filters
    load_more_photos_action();
    // Show or hide the "Load More" button based 
});


//loading more with the button//
$('#load-more-photos').on('click', function() {

      load_more_photos_action();
      
  });

// close the lightbox//
  $(".lightbox-cross img").click(function(){
    $('.lightbox-overlay, .lightbox-modale').toggleClass('inactive');
})



});


