jQuery(document).ready(function($) {

    const container = $(".form-container");
  
    // Clicking on the form without closing the overlay
    container.click(function(event) {
        event.stopPropagation();
    });
  

  
    // Autofill ref num
    
      // Select the input field with class 'ref'
      const inputRef = $(".ref input");
      // Log the selected input field to the console
      // console.log(inputRef);
  
      $(".photo-contact-button").click(function() {
          // Toggle the visibility of elements with classes 'form-overlay' and 'form-container'
          $('.form-overlay, .form-container').toggle();
          
          // Set the value of the input field with class 'ref' to the value of 'prepopulateRef'
          inputRef.val(prepopulateRef);
      });
  
  
  
    // Contact button in header
    $(".menu-item-21 a").click(function() {
        $('.form-overlay, .form-container').toggle();
        return false;
    });
 
  
    // Closing form
    $(".form-overlay").click(function() {
        $('.form-overlay, .form-container').toggle();
    });
  
    
  
    // Mobile Menu
    $(".hamburger-menu, .cross-menu").click(function() {
        $('.cross-menu, .hamburger-menu').toggle();
        $(".open-nav-menu").toggle();
        return false;
    });

    
  
  
  
  //Select 2 filter changes//
  
      $('.time-filter, .format-filter, .category-filter').select2({
      });
  
     
  
  
  // animation for arrow change upon dropdown menu//
  
      $('.category-filter, .format-filter, .time-filter').on('select2:open select2:close', function (e) {
          // Find the arrow within the current filter's container
          $(this).siblings('.select2').find('.select2-selection__arrow').toggleClass('rotate-arrow');
        });
    
    
// to open the lightbox from the hover screen//
  
  $(document).on('click', '.fullscreen-button', function(){
      $('.lightbox-overlay').toggleClass('inactive');
      $('.lightbox-modale').toggleClass('inactive');
      console.log($(this));
        const id = $(this).attr('id').replace('post-', '');
        // console.log(id);
        const cat = $(this).attr('cat');
        console.log(cat);
        const title = $(this).attr('title');
        console.log(title);
        // Replace src image of lightbox with the img in Imageblock.php
    $('#lightbox-info-img').attr('src', $('#img-' + id + ' img').attr('src'));
    $('.lightbox-info-cat').text(cat);
    $('.lightbox-info-title').text(title);
    
  });


  

  
function handlerInIcons() {
    $(this).find('.lightbox-icons').toggleClass('inactive');
}

function handlerOutIcons() {
    $(this).find('.lightbox-icons').toggleClass('inactive');
}

$('.home-gallery-image').on( "mouseenter", handlerInIcons ).on( "mouseleave", handlerOutIcons );

  });
  