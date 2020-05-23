// On vérifie que l'utilisateur est connecté
if(user != 0){
    // L'utilisateur est connecté
    // On initialise l'URL de Mercure
    const url = new URL('http://localhost:3000/.well-known/mercure')
    // On ajoute le "topic" correspondant à nos notifications de chat
    url.searchParams.append('topic', 'https://intro-mercure.test/users/chat')
    // On ajoute le "topic" pour les notifications de messages privés
    url.searchParams.append('topic', 'https://intro-mercure.test/users/message/'+user)

    const eventSource = new EventSource(url)

    eventSource.onmessage = e => {
        // Une notification est reçue
        let donnees = JSON.parse(e.data)
        if(donnees.sujet == 'chat'){
            $("#discussion").prepend(`<p>${donnees.pseudo} a écrit le ${donnees.date} : ${donnees.message}</p>`)
            $("#messages .toast-body").text(`Il y a un nouveau message de ${donnees.pseudo} dans le chat`)
            $("#messages").toast('show')
        }

        if(donnees.sujet == 'message'){
            $("#private .toast-body").text(`Vous avez un nouveau message privé de ${donnees.exp}`)
            $("#private").toast('show')
            $("#pm").text(donnees.total)
        }
    }


    window.addEventListener('beforeunload', function(){
        if(eventSource != null){
            eventSource.close()
        }
    })
}

window.onload = () => {
    // On va chercher la zone de texte
    let texte = document.querySelector("#texte")
    texte.addEventListener("keyup", verifEntree)
    
    // On va chercher le bouton "valid"
    let valid = document.querySelector("#valid")
    valid.addEventListener("click", ajoutMessage)
}
function verifEntree(e){
    if(e.key == "Enter"){
        ajoutMessage()
    }
}
function ajoutMessage() {
    // On récupère la valeur dans le champ "texte"
    let message = document.querySelector("#texte").value

    // On vérifie si on a un message
    if (message != "") {
        // On crée un objet JS pour le message
        let donnees = {}
        donnees["message"] = message

        // On convertit les données en json
        let donneesJson = JSON.stringify(donnees)

        // On envoie les données en POST en Ajax
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest()

        // On gère la réponse
        xmlhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
                if(this.status == 201) {
                    // On a une réponse
                    // On efface le champ texte
                    document.querySelector("#texte").value = ""
                }else{
                    // On reçoit une erreur, on l'affiche
                    let reponse = JSON.parse(this.response)
                    alert(reponse.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "ajax/ajoutMessage.php");

        // On envoie la requête avec les données
        xmlhttp.send(donneesJson);
    }
}
