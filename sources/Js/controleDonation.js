let form=document.getElementById("donation");
let p =document.getElementById("Controle");
let btn=document.getElementById("retour");
let btn2=document.getElementById("retour2");

function retour(){
    window.location.href = "ProjetDispo.php";
}
function retour2(){
    window.location.href = "detailProjet.php";
}
if(btn){
    btn.addEventListener("click",retour);
}

function Dec(){
    window.location.href = "login.php";
}


    

if(form){
    form.addEventListener("submit", function(event) {

        if(p.style.display == "block" || document.getElementById("Montant").value==""){
            event.preventDefault();  
        alert("Veuillez remplir correctement le montant .");
        }
        

});
}

if(btn2){
    btn2.addEventListener("click",retour2);
}








