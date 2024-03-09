jQuery(document).ready(function($) {

var baseURL = scripts_params.theme_url;

const nextBtn = $('.lightbox-next');
var galleryImage =$('.gallery-image');


//how many images 
var page = 2;
// create a start point for the code
var offset = 0;
//boolean for if the function can run
var canLoadMore = true;
//increment when calling to as not show the same image twice
var numberphoto = 2;


load_more_photos_action();

// Base URL for theme
var baseURL = scripts_params.theme_url;

// Index of the current photo being displayed
let currentPhotoIndex = 0;

// Array to store fetched photo data
let photoData = [];

// Handler for toggling lightbox visibility on mouse enter
function handlerIn() {
    $(this).find('.small-lightbox').toggleClass('inactive');
}

// Handler for toggling lightbox visibility on mouse leave
function handlerOut() {
    $(this).find('.small-lightbox').toggleClass('inactive');
}

// AJAX call to fetch more photos
function load_more_photos_action() {
    if (canLoadMore) {
        // Retrieve filter values
        var id_format = $('#format-select').val();
        var id_category = $('#category-select').val();
        var orderascdesc = $('#order-select').val();

        var category = '';
        var format = '';
        var order = '';

        // Construct query parameters based on filters
        if (id_category !== '' && id_category !== undefined) {
            category = 'mota-category=' + id_category + '&';
        }
        if (id_format !== '' && id_format !== undefined) {
            format = 'mota-format=' + id_format + '&';
        }
        if (orderascdesc !== '' && orderascdesc !== undefined) {
            order = 'order=' + orderascdesc + '&';
        }

        // Construct the request URL
        var requestURL = `${scripts_params.rest_url}wp/v2/photos?${category}${format}${order}per_page=${page}&offset=${offset}&_embed=true`;

        // Perform AJAX request
        $.ajax({
            url: requestURL,
            type: 'GET',
            success: function(response) {
                if (response.length === 0) {
                    // No more posts available, display error message
                    $('.ajax-container').append('<p>Pas de photos trouvées.</p>');
                } else {
                    // Iterate over fetched photos
                    $.each(response, function(index, photo) {
                        // Extract relevant data from photo object
                        var category = photo['_embedded']['wp:term'][0][0]['name'];
                        var Format = photo['_embedded']['wp:term'][1][0]['name'];
                        var title = photo['title']['rendered'];

                        // Create HTML elements for image and lightbox
                        var imageDiv = $('<div class="home-gallery-image"></div>'); 
                        var imageAjax = $('<div id="img-' + photo.id + '"><img class="gallery-image" src="' + photo._embedded['wp:featuredmedia'][0].source_url + '" class="fullscreen-button-image" data-image-id="' + photo.id.title + '"></div>'); 
                        var customDiv = $('<div class="small-lightbox inactive"></div>'); 
                        var customIconFull = $('<img class="fullscreen-button" title="'+ title + '" cat="'+ category +'" id="post-' + photo.id + '" src="' + scripts_params.theme_url + '/assets/Icons/Icon_fullscreen.png">');
                        var customIconView = $('<a href="' + photo.link + '"> <img class="view-button" src="' + scripts_params.theme_url + '/assets/Icons/Icon_eye.png"></a>'); 
                        var customCat= $(`<div class="customCategory">${category}</div>`);
                        var customTitle= $(`<div class="customTitle">${title}</div>`);

                        // Add hover functionality
                        $(imageDiv).on("mouseenter", handlerIn).on("mouseleave", handlerOut);
                        
                        // Append elements to the lightbox div
                        customDiv.append(customIconView, customIconFull, customCat, customTitle);
                        imageDiv.append(imageAjax, customDiv);
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

// Event listener for filter changes
$('#category-select, #format-select, #order-select').change(function() {
    offset = 0; // Reset the offset
    $('.ajax-container').empty(); // Clear the container
    load_more_photos_action(); // Load more photos based on new filters
});

// Event listener for "Load More" button
$('#load-more-photos').on('click', function() {
    load_more_photos_action();
});

// Event listener for closing the lightbox
$(".lightbox-cross img").click(function() {
    $('.lightbox-overlay, .lightbox-modale').toggleClass('inactive');
});

});


