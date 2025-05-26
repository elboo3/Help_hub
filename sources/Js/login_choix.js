//pour la page choix de sign_up

let choix = document.querySelectorAll(".choix");// soit donateur soit responsable

let form = document.querySelector("form");
//pour la page choix de sign_up

function choixSignUp(event) {
    
    
    if(event.target.classList.contains("responsable") || event.target.parentElement.classList.contains("responsable")) {
        
        document.getElementById("choix").value= "responsable";
    }
    else{
        document.getElementById("choix").value= "donateur";
    }
    

    form.submit();

}


choix.forEach(element => {
    element.children[0].addEventListener("click", function(event){choixSignUp(event)});
    element.children[1].addEventListener("click", function(event){choixSignUp(event)});
    element.addEventListener("click", function(event){choixSignUp(event)});
});