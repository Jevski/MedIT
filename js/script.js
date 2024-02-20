jQuery(document).ready(function($) {
  
    const container= document.querySelector(".form-container");
    

// clicking on the form without closing the overlay//
      container.addEventListener('click', function(event) {
        event.stopPropagation();
    });

   //trying to autofill ref num//
   /* 
    const photoContactButton =document.querySelector('.photo-contact-button')
    const reference = document.getElementsByClassName(".ref");
   

    console.log(reference);
    photoContactButton?.addEventListener("click", function() {
      reference[0].val = ($references); 
    });
*/




  $('.home-gallery-image').on('mouseenter', function() {
      console.log('Mouse entered over the image!');
      $('.lightbox-icons').toggle('.inactive');
      // You can add any actions you want to perform when hovering over the image
  });

  $('.more-photos img').on('mouseenter', function() {
    console.log('Mouse entered over the image!');
    $('.lightbox-icons').toggle('.inactive');
    // You can add any actions you want to perform when hovering over the image
});
 

    
//Contact button on page//
  $(".photo-contact-button").click(function() {
    $('.form-overlay').toggle();
       $('.form-container').toggle();
        
  });
  

//contact button in header//
  $(".menu-item-21 a").click(function() {
    $('.form-overlay').toggle();
        $('.form-container').toggle();
        return false;
  });

  //closing form//
  $(".form-overlay").click(function(){
      $('.form-overlay').toggle();
      $('.form-container').toggle();
      
  });
});

//Select 2//
$(document).ready(function() {
  $('.category-filter, .format-filter, .time-filter').select2({
    
  });



//Mobile Menu//
  $(".hamburger-menu, .cross-menu").click(function(){
    $('.cross-menu').toggle();
    $('.hamburger-menu').toggle();
    $(".open-nav-menu").toggle();
    return false;
  });

  




//Ajax //
var page = 2;
var canLoadMore= true;


$('#load-more-photos').on('click', function() {
  if (canLoadMore){
    var format = $('#format-select').val();
    var category = $('#category-select').val();
    var order = $('#order-select').val();

  $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: {
          action: 'load_more_photos',
          page:page,
          format:format,
          category:category,
          order:order,
          nonce: ajaxurl.load_more_photos_nonce,
      },
      success: function(response) {
          $('.ajax-container').append(response);
          page++;
      },
      error: function(xhr, status, error) {
          console.error(xhr.responseText);
      }
    
  });
}

});






























/*
var page = 2;
var canLoadMore = true;

 // Charger plus de photos au clic sur le bouton "Charger plus"
 $('#load-more-photos').on('click', function() {
  if (canLoadMore) {
      var format = $('#format-select').val();
      var categorie = $('#categorie-select').val();
      var order = $('#order-select').val();
console.log(categorie);
      $.ajax({
          url: ajax_object.ajaxurl,
          type: 'POST',
          data: {
              action: 'load_more_photos',
              page: page,
              format: format,
              categorie: categorie,
              order: order,
              nonce: ajax_object.load_more_photos_nonce,
          },
          success: function(response) {
              $('#photos-container').append(response);
              page++;
          }
      });
  }
});
*/



});