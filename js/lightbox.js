jQuery(document).ready(function($) {



// closing of the main lightbox//
    $(".lightbox-cross").click(function(){
        $('.lightbox-overlay, .lightbox-modale').toggleClass('inactive');
    })


    let url_value = lightbox_imgage.getAttribute('src');

    
    //Next photo in the lightbox//
    $(".fullscreen-button").click(function(){
        
        $('.')
    })

    const lightboxOverlay = $('.lightbox');
    const lightBoxImages = $('.home-gallery-image');

    $(lightBoxImages).each(function() {
        $(this).on("click", function(){
            lightbox.toggleClass("lightbox-active");
        });
    });

    lightboxOverlay.on("click", function(){
        lightboxOverlay.removeClass("lightbox-active");
    });

// Nav Lightbox//
//navigation lightbox
let lightbox_cat = document.getElementById("lightbox-info-cat");
let lightbox_ref = document.getElementById("lightbox-info-ref");
let lightbox_img = document.getElementById("lightbox-info-img");

//fonction clic gauche
function leftLightbox() {
    //récupération de l'url de l'image en cours
    let url_value = lightbox_img.getAttribute('src');

    //parcours du tableau pour savoir où on se trouve
    for(let i = 0; i< dataPhotos.length; i++){
        if(url_value == dataPhotos[i]['thumbnail']){
            var currentImage = i;
        }
    }

    //affichage selon le cas de figure
    if(currentImage == 0){
        //si on se trouve en début de tableau, on retourne à la fin
        currentImage = dataPhotos.length-1;
        //affichage de la nouvelle image
        lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
        lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
        lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
    }else{
        //cas d'affichage normal
        currentImage--;
        //affichage de la nouvelle image
        lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
        lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
        lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
    }

}

//fonction clic droit
function rightLightbox() {
    //récupération de l'url de l'image en cours
    let url_value = lightbox_img.getAttribute('src');

    //parcours du tableau pour savoir où on se trouve
    for(let i = 0; i< dataPhotos.length; i++){
        if(url_value == dataPhotos[i]['thumbnail']){
            var currentImage = i;
        }
    }

    //affichage selon le cas de figure
    if(currentImage == dataPhotos.length-1){
        //si on se trouve en bout de tableau, on retourne au début
        currentImage = 0;
        //affichage de la nouvelle image
        lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
        lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
        lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
    }else{
        //cas d'affichage normal
        currentImage++;
        //affichage de la nouvelle image
        lightbox_img.src = dataPhotos[currentImage]['thumbnail'];
        lightbox_cat.innerHTML = dataPhotos[currentImage]['categorie'];
        lightbox_ref.innerHTML = dataPhotos[currentImage]['reference'];
    }

}

});




