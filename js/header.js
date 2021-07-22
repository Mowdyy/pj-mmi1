(function () {
        "use strict";

        document.addEventListener("DOMContentLoaded", init);
        let coeur
        let liOther
        let bulle
        let li

        function init(evt) {

            coeur = $(".menu .fa-heart");
            bulle = $(".menu .fa-comment");
            li = $(".menu a i");
            liOther = $(".menu .fa-home, .menu .fa-search");

            coeur.click(changeCoeur);
            bulle.click(changeBulle);
            liOther.click(deselection);
            li.click(color);

        }

        function changeCoeur(evt) {
            coeur.removeClass("far");
            coeur.addClass("fas");
        }

        function changeBulle(evt) {
            bulle.toggleClass("fa-comment");
            bulle.toggleClass("fa-comment-slash");
        }

        function deselection(evt) {
            if (window.matchMedia("(max-width: 1199px)").matches) {
                $(".menu li:nth-child(2) i").removeClass("fas");
                $(".fa-heart").addClass("far");
            }
        }

        function color(evt) {
            $(".colored").removeClass("coloredred");
            $(this).toggleClass("coloredred");
        }
})();
