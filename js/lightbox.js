// jQuery(document).ready(function($){
// load_photos_single();


// var baseURL = scripts_params.theme_url;


// let currentPhotoIndex = 0;
// let photoData = []; // Array to store fetched photo data

// const lightboxImg = $('#lightbox-info-img');
// const nextBtn = $('.lightbox-next');

// var galleryImage =$('.gallery-image');
// var page = 2;
// var offset = 0;
// var canLoadMore = true;
// var numberphoto = 2;

// function load_photos_single() {
//     var requestURL = `${scripts_params.rest_url}wp/v2/photos?per_page=${page}&offset=${offset}&_embed=true`;

//     $.ajax({
//         url: requestURL,
//         type: 'GET',
//         success: function(response) {
//             if (response.length === 0) {
                
//             } else {
//                 $.each(response, function(index, photo) {
                    

                   
//                 });
//                 offset += numberphoto;
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// }








// });