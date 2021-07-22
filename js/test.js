//A revoir ...
(function () {
    "use strict";

    let audio;


    document.addEventListener("DOMContentLoaded", init);

    function init(evt) {
        audio = document.querySelector('audio');
        window.addEventListener('unload', sauvegarderDonnees);
        var audioRecup = sessionStorage.getItem('lancerPlayer');

        
        if(audioRecup == "false"){
            audio.muted = false;
            audio.play();
        }else{
            audio.muted = true;
        }
    }

    function sauvegarderDonnees(evt){
        sessionStorage.setItem('lancerPlayer', audio.paused);

        console.log(audio.paused);
    }

})();
