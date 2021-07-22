(function () {
    "use strict";

    document.addEventListener("DOMContentLoaded", init);
    let translate;
    let translate1;
    let cargo;
    let chat;

    function init(evt) {
        translate = $('.fa-times');
        translate1 = $('.fa-comment');
        cargo = $('.cargo-chat');
        chat = document.querySelector(".direct-chat-box");
        
        translate.click(deplacer);
        translate1.click(deplacer);
        
        chat.scrollTop = chat.scrollHeight;
    }

    function deplacer(evt) {
        cargo.toggleClass("translate");
        translate.toggleClass("fa-times");
        translate.toggleClass("fa-angle-double-up"); 
    }

})();
