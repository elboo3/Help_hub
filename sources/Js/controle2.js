let pass1=document.getElementById("pass1");
let pass2=document.getElementById("pass2");
let email=document.getElementById("Email");
let p =document.querySelectorAll("p");
let form=document.querySelector("form");
let btn=document.querySelector("div");




function validerEmail(input) {
    // Expression régulière pour valider une adresse email
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if(regex.test(input.value)){
        input.className="form-control border-success focus-ring focus-ring-success";
        input.nextElementSibling.style.visibility="hidden";
    }
        
    else{
        input.className="form-control border-danger focus-ring focus-ring-danger";
        input.nextElementSibling.style.visibility="visible";

    }
    

}
email.addEventListener("keyup",function(){validerEmail(email)});




//verifier que le mot de passe est valide 
function motPassValider(input){
    
    const regex = /^[a-zA-Z0-9]{7,}[#$]$/;
    if(regex.test(input.value) || input.value.length==0){
        input.className="form-control border-success focus-ring focus-ring-success";
        input.nextElementSibling.style.visibility="hidden";
    }
    else{
        input.className="form-control border-danger focus-ring focus-ring-danger";
        input.nextElementSibling.style.visibility="visible";
    }
}

pass1.addEventListener("keyup",function(){motPassValider(pass1)});


//verifier que le réacriture de mot de passe est valide
function identique(input){
    if(pass1.value!=pass2.value){
        
        input.className="form-control border-danger focus-ring focus-ring-danger";
        input.nextElementSibling.style.visibility="visible";
    }else{
        input.className="form-control border-success focus-ring focus-ring-success";
        input.nextElementSibling.style.visibility="hidden";
    }
}

pass2.addEventListener("keyup",function(){identique(pass2)});

form.addEventListener("submit", function(event) {
    Valide = true; 
        for(i=0;i<p.length && Valide;i++){
            if(p[i].style.display == "block")
                Valide=false;
        }
    
        if (!Valide) {
            event.preventDefault();  
            alert("Veuillez remplir correctement tous les champs.");
        }
    });


    if(btn1){
        
    // Gestion du premier champ mot de passe
    btn1.addEventListener("click", function () {
        visualiser(img1, pass1);  // Pass1 est le champ de mot de passe à afficher/masquer
    });
    }
    
    if(btn2){
        
    // Gestion du second champ mot de passe
    btn2.addEventListener("click", function () {
        visualiser(img2, pass2);  // Pass2 est le champ de mot de passe à afficher/masquer
    });
    }
    
    
