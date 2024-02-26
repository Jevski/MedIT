jQuery(document).ready(function($) {

  const container = $(".form-container");

  // Clicking on the form without closing the overlay
  container.click(function(event) {
      event.stopPropagation();
  });




  // Autofill ref num
  $(document).ready(function() {
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
});




  // Contact button in header
  $(".menu-item-21 a").click(function() {
      $('.form-overlay, .form-container').toggle();
      return false;
  });

 //fullscreen button
 
  $(".random-photo").on('mouseenter', function() {
    console.log('Mouse entered over the image!')
    $('.lightbox-icons').toggleClass('inactive');
    // You can add any actions you want to perform when hovering over the image
});


  // Closing form
  $(".form-overlay").click(function() {
      $('.form-overlay, .form-container').toggle();
  });

  // Script for filters
  $('format-category').hover(
      function() {
          // Mouse enter
          $(this).css('background-color', 'red');
      },
      function() {
          // Mouse leave
          $(this).css('background-color', ''); // Revert to default
      }
  );

  // Mobile Menu
  $(".hamburger-menu, .cross-menu").click(function() {
      $('.cross-menu, .hamburger-menu').toggle();
      $(".open-nav-menu").toggle();
      return false;
  });

  // Ajax
  var offset = 0;
  var canLoadMore = true;
  var numberphoto = 2;

  load_more_photos();

  $('#load-more-photos').on('click', function() {
      load_more_photos();
  });

  function load_more_photos() {
      if (canLoadMore) {
          var format = $('#format-select').val();
          var category = $('#category-select').val();
          var order = $('#order-select').val();
console.log(format);
console.log(category);
console.log(order);
          $.ajax({
              url: ajaxurl,
              type: 'POST',
              data: {
                  action: 'load_more_photos',
                  offset: offset,
                  numberphoto: numberphoto,
                  format: format,
                  category: category,
                  order: order,
              },
              success: function(response) {
                  $('.ajax-container').append(response);
                  offset += numberphoto;
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
              }
          });
      }
  }

  

  $(".random-photo").click(function(){
      $.ajax({
          url: templateParts,
          method: 'GET',
          dataType: 'html',
          success: function(response){
              $('.template-lightbox-container').html(response);
          },
          error: function(xhr, status, error) {
              console.error('Error:', error);
          }
      });
  });

});

//Select 2 filter changes//

$(document).ready(function() {
    $('.time-filter').select2({
        placeholder: 'Trier par',
    });
});
$(document).ready(function() {
    $('.format-filter').select2({
        placeholder: 'Format',
    });
});

$(document).ready(function() {
    $('.category-filter').select2({
        placeholder: 'Categories',
    });
});

$(document).ready(function() {
    

    $('.category-filter, .format-filter, .time-filter').on('select2:open select2:close', function (e) {
        // Find the arrow within the current filter's container
        $(this).siblings('.select2').find('.select2-selection__arrow').toggleClass('rotate-arrow');
      });
  });
