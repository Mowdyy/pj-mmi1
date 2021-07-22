(function () {
        "use strict";
        let chat;

        window.setInterval(refreshChat, 500); //Refresh tout les demi-secondes le chat

        window.setInterval(suppChat, 43200000); //supprime toutes les 12h le chat

        function suppChat(evt){
        	window.fetch("suppChat.php").then(function (response) {
                    return response.text();
                })
                    .then(function (suppMsg) {
                        document.querySelector(".direct-chat-box").innerHTML = suppMsg;

                })
        }

        function refreshChat(evt) {

        	chat = document.querySelector(".direct-chat-box");
        	chat.scrollTop = chat.scrollHeight;

            window.fetch("chatRefresh.php").then(function (response) {
                    return response.text();
                })
                .then(function (nvDonnees) {
                	document.querySelector(".direct-chat-box").innerHTML = nvDonnees;
 
                })
        }
}());