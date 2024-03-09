jQuery(document).ready(function($) {

  // Selects the form container element
const container = $(".form-container");
// Clicking on the form without closing the overlay
container.click(function(event) {
    // Prevents event propagation to parent elements
    event.stopPropagation();
});



// Autofill reference number
// Selects the input field with class 'ref'
const inputRef = $(".ref input");
// Click event for the photo contact button
$(".photo-contact-button").click(function() {
    // Toggles the visibility of elements with classes 'form-overlay' and 'form-container'
    $('.form-overlay, .form-container').toggle();
    
    // Sets the value of the input field with class 'ref' to the value of 'prepopulateRef'
    inputRef.val(prepopulateRef);
});

// Click event for the contact button in the header
$(".menu-item-21 a").click(function() {
    // Toggles the visibility of elements with classes 'form-overlay' and 'form-container'
    $('.form-overlay, .form-container').toggle();
    return false; // Prevents default link behavior
});

// Click event to close the form
$(".form-overlay").click(function() {
    // Toggles the visibility of elements with classes 'form-overlay' and 'form-container'
    $('.form-overlay, .form-container').toggle();
});

// Click event for the mobile menu
$(".hamburger-menu, .cross-menu").click(function() {
    // Toggles the visibility of elements with classes 'cross-menu', 'hamburger-menu', and 'open-nav-menu'
    $('.cross-menu, .hamburger-menu').toggle();
    $(".open-nav-menu").toggle();
    return false; // Prevents default link behavior
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

// Click event to open the lightbox from the hover screen

$(document).on('click', '.fullscreen-button', function(){
    // Toggles the visibility of elements with classes 'lightbox-overlay' and 'lightbox-modale'
    $('.lightbox-overlay').toggleClass('inactive');
    $('.lightbox-modale').toggleClass('inactive');

    // Gets the ID, category, and title attributes of the clicked element
    const id = $(this).attr('id').replace('post-', '');
    const cat = $(this).attr('cat');
    const title = $(this).attr('title');
    
    // Replaces the source image of the lightbox with the image in Imageblock.php
    $('#lightbox-info-img').attr('src', $('#img-' + id + ' img').attr('src'));
    $('.lightbox-info-cat').text(cat);
    $('.lightbox-info-title').text(title);
});

// Click event for navigating between lightbox images
$(document).on('click', '.lightbox-next, .lightbox-previous', function(e) {
    e.preventDefault();
    var postId = $(this).data('post-id');
    if (postId) {
        window.location.href = "<?php echo home_url(); ?>/?p=" + postId;
    }
});

// Handler functions for lightbox icons hover
function handlerInIcons() {
    // Toggles the visibility of elements with class 'lightbox-icons' on mouse enter
    $(this).find('.lightbox-icons').toggleClass('inactive');
}

function handlerOutIcons() {
    // Toggles the visibility of elements with class 'lightbox-icons' on mouse leave
    $(this).find('.lightbox-icons').toggleClass('inactive');
}

// Adds mouse enter and mouse leave event listeners to elements with class 'home-gallery-image'
$('.home-gallery-image').on("mouseenter", handlerInIcons).on("mouseleave", handlerOutIcons);









});

  
  