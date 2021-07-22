(function () {
    "use strict";

    const loader = document.querySelector('.loader');
    const main = document.querySelector('.main-accueil');
    
    
    
   
    document.addEventListener('DOMContentLoaded', (event) => {        
       
        if (sessionStorage.getItem('premierChargement') === null) {
            //Si premiere connexion au site depuis une page web, afficher le chargement.
             loader.style.display = "flex";             
            // fait apparaitre le chargement
            

            setTimeout(() => {
                //3 secondes de décalage par rapport au chargement de la page web.
                loader.classList.add('fonduChargement');
                 main.classList.remove('mainHide'); //remet le main sur le site pour que l'utilisateur puisse à nouveau scroll pendant l'animation.
            }, 3000);
            setTimeout(() => {
                loader.style.display = "none";
            }, 3300);
            
            sessionStorage.setItem('premierChargement', 'done');

        } else {
            //Si utilisateur à déja accéder au site 1 fois depuis cette fenetre de navigateur, il répete pas l'animation.
            loader.style.display = "none";
            main.classList.remove('mainHide');
        }
        
    })

   

})();
