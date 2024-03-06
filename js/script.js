jQuery(document).ready(function($) {

    const container = $(".form-container");
  
    // Clicking on the form without closing the overlay
    container.click(function(event) {
        event.stopPropagation();
    });
  
   var mouseEnterFunction = () => {
    element.removeClass('inactive');
   }

   var mouseExitFunction = () => {
    element.addClass('inactive');
   }
  
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
  
    // mobile cntact button//
 
  
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

    //lightbox 

    // $('#category-select, #format-select, #order-select').on('change', function() {
    //     var selectedCategory = $('#category-select').val();
    //     var selectedFormat = $('#format-select').val();
    //     var selectedDate = $('#order-select').val();
    //     // Réinitialiser les variables et le contenu de la galerie
    //     offset = 0;
    //     $('.ajax-container').empty();
        
    //     load_more_photos_action();
    //     offset+= numberphoto;
    //     // Vérifier si tous les sélecteurs sont à leur valeur par défaut
    //     var allSelectorsDefault = selectedCategory === '' && selectedFormat === '' && selectedDate === '';
    //     // Afficher le bouton "Load More" si tous les sélecteurs sont à leur valeur par défaut
    //     if (allSelectorsDefault) {
    //         $('#load-more-photos').hide();
    //     } else {
    //         $('#load-more-photos').show();
    //     }
    // });
    
    
    
    // $('#category-select, #format-select, #order-select').on('change', function() {
    //     console.log('clicked');
    //     // Reset pagination

    
    //     // Reset the photos displayed
    //     $('.ajax-container').empty();
    //     load_more_photos_action();
    // });
    
  
  
  // populating the container with 2 images upon arriving on the site//

    // load_more_photos_action();
  
    // $('#load-more-photos').on('click', function() {
      
    //     load_more_photos_action();
    // });
    
    
    //ajax call for loading more iamges//
  
    // function load_more_photos_action() {
    //     if (canLoadMore) {
    //         var format = $('#format-select').val();
    //         var category = $('#category-select').val();
    //         var order = $('#order-select').val();
    //               // console.log(format);
    //               // console.log(category);
    //               // console.log(order);
    //         $.ajax({
    //             url: ajaxurl,
    //             type: 'POST',
    //             data: {
    //                 action: 'load_more_photos',
    //                 offset: offset,
    //                 numberphoto: numberphoto,
    //                 format: format,
    //                 category: category,
    //                 order: order,
    //             },
    //             success: function(response) {
    //                 $('.ajax-container').append(response);
    //                 offset += numberphoto;
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText);
    //             }
    //         });
    //     }
    // }
    
  
  
  
  //Select 2 filter changes//
  
      $('.time-filter').select2({
          placeholder: 'Trier par',
      });
  
      $('.format-filter').select2({
          placeholder: 'Format',
      });
  
      $('.category-filter').select2({
          placeholder: 'Categories',
      });
  
  
  // animation for arrow change upon dropdown menu//
  
      $('.category-filter, .format-filter, .time-filter').on('select2:open select2:close', function (e) {
          // Find the arrow within the current filter's container
          $(this).siblings('.select2').find('.select2-selection__arrow').toggleClass('rotate-arrow');
        });
    
    
// to open the lightbox from the hover screen//        
    function openFullscreen() {
      console.log('You clicked the button');
      $('.lightbox-overlay').toggleClass('inactive');
      $('.lightbox-modale').toggleClass('inactive');
  }
  
  $('.fullscreen-button').on('click', openFullscreen);


  });