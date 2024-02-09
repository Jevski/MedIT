jQuery(document).ready(function($) {

    const container = document.querySelector(".form-container");
    const overlay = document.querySelector(".form")
    const contactButton =  document.querySelector('.menu-item-21');
    console.log(contactButton);

    contactButton.addEventListener("click", function() {
      container.classList.add("active");
      container.classList.remove("inactive");
      overlay.classList.toggle("active");
      overlay.classList.toggle("inactive");
  });
});