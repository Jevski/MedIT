jQuery(document).ready(function($) {

var baseURL = scripts_params.rest_url;


//how many images 
var page = 2;
// create a start point for the code
var offset = 0;
//boolean for if the function can run
var canLoadMore = true;
//increment when calling to as not show the same image twice
var numberphoto = 2;
// Pre load the page
load_more_photos_action();

// Base URL for theme
var baseURL = scripts_params.theme_url;

// Index of the current photo being displayed
let currentPhotoIndex = 0;


// Handler for toggling lightbox visibility on mouse enter
function handlerIn() {
    $(this).find('.small-lightbox').toggleClass('inactive');
}

// Handler for toggling lightbox visibility on mouse leave
function handlerOut() {
    $(this).find('.small-lightbox').toggleClass('inactive');
}



//  var imageIds = []; // Array to store information of all photos

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
                        var title = photo['title']['rendered'];
                        var photoId = photo.id;

                        // Create HTML elements for image and lightbox
                        var imageDiv = $('<div class="home-gallery-image"></div>'); 
                        var imageAjax = $('<div class="" id="img-' + photo.id + '"><img class="gallery-image" src="' + photo._embedded['wp:featuredmedia'][0].source_url + '" class="fullscreen-button-image" data-image-id="' + photo.id.title + '"></div>'); 
                        var customDiv = $('<div class="small-lightbox inactive"></div>'); 
                        var getAllInfo = $('<div class="get-all-info" title="' + title + '" cat="' + category + '" id="post-' + photo.id + '"></div>'); // Create get-all-info element
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
                       
                        // Push photo information into allPhotosInfo array
                        imageIds.push({
                            title: title,
                            category: category,
                            id: photoId
                        });

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

//console.log(imageIds);


// Click event to open the lightbox from the hover screen
var currentImageId = ''; // Global variable to store the ID of the currently displayed image
var imageIds = []; // Array to store image information


// Opening lightbox and filling the information
$(document).on('click', '.fullscreen-button', function(){
    // Toggle the visibility of elements with classes 'lightbox-overlay' and 'lightbox-modale'
    $('.lightbox-overlay').toggleClass('inactive');
    $('.lightbox-modale').toggleClass('inactive');

    // Gets the ID, category, and title attributes of the clicked element
    const id = $(this).attr('id').replace('post-', '');
    const cat = $(this).attr('cat');
    const title = $(this).attr('title');
    
    // Sets the global variable to the ID of the currently displayed image
    currentImageId = id;
    // Replaces the source image of the lightbox with the image in Imageblock.php
    $('#lightbox-info-img').attr('src', $('#img-' + id + ' img').attr('src'));
    $('.lightbox-info-cat').text(cat);
    $('.lightbox-info-title').text(title);
    console.log(imageIds);
});


//Navigation Next button
$(document).on('click', '.lightbox-next', function(){
    // Find the index of the current image ID in the array of image IDs
    var currentIndex = imageIds.findIndex(image => image.id === currentImageId);

    // Calculate the index of the next image
    var nextIndex = (currentIndex + 1) % imageIds.length;

    // Get the ID, category, and title of the next image
    var nextImageId = imageIds[nextIndex].id;
    var nextTitleId = imageIds[nextIndex].title;
    var nextCatId = imageIds[nextIndex].category;

    // Update the global variable with the ID of the next image
    currentImageId = nextImageId;
    
    // Load the next image into the lightbox
    $('#lightbox-info-img').attr('src', $('#img-' + nextImageId + ' img').attr('src'));
    $('.lightbox-info-cat').text(nextCatId);
    $('.lightbox-info-title').text(nextTitleId);
});



// Navigation previous button
$(document).on('click', '.lightbox-previous', function(){
    // Find the index of the current image ID in the array of image IDs
    var currentIndex = imageIds.findIndex(image => image.id === currentImageId);

    // Calculate the index of the previous image
    var previousIndex = (currentIndex - 1 + imageIds.length) % imageIds.length;

    // Get the ID, category, and title of the previous image
    var previousImageId = imageIds[previousIndex].id;
    var previousTitleId = imageIds[previousIndex].title;
    var previousCatId = imageIds[previousIndex].category;

    // Update the global variable with the ID of the previous image
    currentImageId = previousImageId;
    
    // Load the previous image into the lightbox
    $('#lightbox-info-img').attr('src', $('#img-' + previousImageId + ' img').attr('src'));
    $('.lightbox-info-cat').text(previousCatId);
    $('.lightbox-info-title').text(previousTitleId);
});


// Select 2 filter changes
// Initializes Select2 for elements with classes 'time-filter', 'format-filter', and 'category-filter'
$('.time-filter, .format-filter, .category-filter').select2({});




// Animation for arrow change upon dropdown menu
// Toggles a class to rotate the arrow inside the dropdown menu upon opening or closing
$('.category-filter, .format-filter, .time-filter').on('select2:open select2:close', function (e) {
    // Finds the arrow within the current filter's container and toggles a class
    $(this).siblings('.select2').find('.select2-selection__arrow').toggleClass('rotate-arrow');
    
});





// Event listener for filter changes
$('#category-select, #format-select, #order-select').change(function() {
    offset = 0; // Reset the offset
    $('.ajax-container').empty(); // Clear the container
    load_more_photos_action(); // Load more photos based on new filters
    imageIds = [];
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


