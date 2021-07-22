(function () {
    "use strict";

    document.addEventListener("DOMContentLoaded", init);
    let like;
    let play;
    let icons;
    let color;
    let fleche;
    let favoris;
    let heart;
    let volume;
    let volumeControl;
    let anim;
    let audio;
    let com;
    let voir;
    let plus;
    
    function init(evt) {

        voir = $(".voir-plus button i");
        plus = $(".voir-plus p");
        com = $(".commentaires-text");
        heart = $(".fa-heart");
        like = $(".fa-thumbs-up");
        play = $(".fa-play-circle");
        color = $(".fa-thumbs-up");
        fleche = $(".fleche i");
        favoris = $(".favoris-header");
        $('.ecrire-chat form input').on('focus', supprimerLecteurEspace).on('blur', ajouterLecteurEspace);
        $('#autoresizing').on('input', agrandir).on('focus', supprimerLecteurEspace).on('blur', ajouterLecteurEspace); 


        icons = $(".controls i");
        volume = $(".controls i:nth-child(3)");
        volumeControl = document.getElementById("volume-control");
        anim = $('.lecteur-js');
        audio = document.querySelector('audio');

        voir.click(voirPlus);
        like.click(changeLike);
        play.click(changePlay);
        play.click(activer);
        color.click(colorer);
        fleche.click(disparaitre);
        heart.click(colorerEnRouge);
        icons.mousedown(scale);
        icons.mouseup(unscale);
        volumeControl.addEventListener("input", changeVolume);
        volume.click(displayVolume);
        $(document).keypress(gererLecteurEspace);

        window.addEventListener('unload', sauvegarderDonnees);
        let audioRecup = sessionStorage.getItem('lancerPlayer');
        let volumeRecup = parseFloat(sessionStorage.getItem('musique'));
        audio.volume = volumeRecup;
        volumeControl.value = volumeRecup * 100;


        if (audioRecup == "false") {
            lancer();
            changePlay();
        } else {
            arreter();
        }
        
    }

    function gererLecteurEspace(e) {
        if (e.keyCode === 32) {
            changePlay();
            activer();
            play.trigger("click");
        }
    }

    function supprimerLecteurEspace(evt) {
        $(document).off("keypress");
    }

    function ajouterLecteurEspace(evt) {
        $(document).keypress(gererLecteurEspace);
    }

    function changeLike(evt) {
        like.toggleClass("far");
        like.toggleClass("fas");
    }

    function changePlay(evt) {
        play.toggleClass("fa-play-circle");
        play.toggleClass("fa-stop-circle");
        $('.fa-stop-circle').click(arreter);
        $('.fa-play-circle').click(lancer);

    }

    function activer(evt) {
        anim.toggleClass("anim-lecteur");
    }
    
    function voirPlus(evt) {
        com.toggleClass("commentaires-text-js");
        voir.toggleClass("fas fa-chevron-down");
        voir.toggleClass("fas fa-chevron-up");
        document.querySelector(".voir-plus p").innerHTML = "Voir moins";
        voir.off("click", voirPlus); 
        voir.click(voirMoins);
    }
    
    function voirMoins (evt) {
        com.toggleClass("commentaires-text-js");
        voir.toggleClass("fas fa-chevron-down");
        voir.toggleClass("fas fa-chevron-up");
        document.querySelector(".voir-plus p").innerHTML = "Voir plus";
        voir.off("click", voirMoins);
        voir.click(voirPlus);
    }
    

    function scale(evt) {
        $(this).css('transform', 'scale(0.9)');
    }

    function unscale(evt) {
        $(this).css('transform', 'scale(1)');
    }

    function colorer(evt) {
        $(this).toggleClass("colored");
    }

    function colorerEnRouge(evt) {
        heart.toggleClass("coloredred");
        heart.toggleClass("far");
        heart.toggleClass("fas");
    }

    function agrandir(evt) {
        this.style.height = (this.scrollHeight) + 'px';

    }

    $('.fa-play-circle').click(lancer);

    function lancer(evt) {
        audio.muted = false;
        audio.play();
    }

    function arreter(evt) {
        audio.muted = true;
    }

    function disparaitre(evt) {
        fleche.toggleClass("fas fa-angle-double-left");
        fleche.toggleClass("fas fa-angle-double-right");
        favoris.toggleClass("favoris-display");
        favoris.toggleClass("favoris-undisplay");
        fleche.toggleClass("fleche-display");
        fleche.toggleClass("fleche-undisplay");
    }

    function changeVolume(evt) {
        audio.volume = volumeControl.value / 100;
        if (audio.volume == 0) {
            volume.removeClass("fa-volume-down");
            volume.addClass("fa-volume-mute");
        } else {
            volume.removeClass('fa-volume-mute');
            volume.addClass("fa-volume-down");
        }
    }

    function displayVolume(evt) {
        volumeControl.classList.toggle("displayVolume");
    }

    function sauvegarderDonnees(evt) {
        sessionStorage.setItem('lancerPlayer', audio.muted);
        sessionStorage.setItem('musique', audio.volume);
        console.log(audio.muted);
    }
})();
