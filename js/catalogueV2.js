(function () {
    "use strict";
    document.addEventListener("DOMContentLoaded", init);

    let favoris

    function init(evt) {

        favoris = $(".legende .bouton-favoris");

        favoris.hover(hoverIcon);
        favoris.click(remplirIcon);
        favoris.mousedown(scale);
        favoris.mouseup(unscale);
        
        console.log(window.location.href);
        let adresse = window.location.href.split('/');
        console.log(adresse[-1]);
        
    }

    function hoverIcon(evt) {

        if ($(this).children().hasClass("fa-heart")) {
            if (!$(this).children().hasClass("remplir")) {
                $(this).children().toggleClass("far");
                $(this).children().toggleClass("fas");
                $(this).children().toggleClass("hoverCoeur");
            }
        } else {
            $(this).children().toggleClass("hoverPoubelle");
        }
    }

    function remplirIcon(evt) {
        $(this).children().toggleClass("remplir");
        $(this).off();
        $(this).click(viderIcon);
        favoris.mousedown(scale);
        favoris.mouseup(unscale);
    }

    function viderIcon(evt) {
        $(this).children().toggleClass("far");
        $(this).children().toggleClass("fas");
        $(this).children().toggleClass("remplir");
        $(this).off();
        $(this).click(remplirIcon);
        $(this).hover(hoverIcon);
        favoris.mousedown(scale);
        favoris.mouseup(unscale);

        $(this).children().toggleClass("far");
        $(this).children().toggleClass("fas");
    }

    function scale(evt) {
        $(this).css('transform', 'scale(0.9)');
    }

    function unscale(evt) {
        $(this).css('transform', 'scale(1)');
    }

})();
