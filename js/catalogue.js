(function () {
    "use strict";
    document.addEventListener("DOMContentLoaded", init);

    let favoris
    let box

    function init(evt) {

        favoris = $(".wrap-container .btn-favoris");
        box = $(".wrap-container > a");
        
        favoris.click(changeFavorisIcon);
        favoris.mousedown(scale);
        favoris.mouseup(unscale);
        box.hover(resetBorder);
    }

    function changeFavorisIcon(evt) {
        $(this).children().toggleClass("far");
        $(this).children().toggleClass("fas");
        $(this).children().toggleClass("remplir");
    }

    function scale(evt) {
        $(this).css('transform', 'scale(0.9)');
    }

    function unscale(evt) {
        $(this).css('transform', 'scale(1)');
    }
    
    function resetBorder(evt) {
        $(this).find(".fav-banner").toggleClass("filter");
    }


})();
