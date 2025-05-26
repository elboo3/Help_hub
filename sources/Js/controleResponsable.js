let form = document.querySelector('.detail_projet_responsable')
let btn_retour = document.getElementById('retour')
let p = document.detail_projet_responsable.querySelectorAll('p')
let btn_modifier = document.getElementById('modifier')
let btn_supprimer = document.getElementById('supprimer')
let btn_ajouter = document.getElementById('ajouter')
let champ_date_limite = document.querySelector('#date_limite')




function retour () {
  window.location.href = 'dashboard_responsable.php'
}

btn_retour.addEventListener('click',function(){retour()})

form.addEventListener('submit', function (event) {
   
    for (let i = 0; i < p.length; i++) {
        if (p[i].style.display == 'block') {
            event.preventDefault()
            alert('Veuillez remplir correctement les champs !!')
            
        }
        } 
   
 
})



champ_date_limite.addEventListener('change', function () {

    let dateSaisie = new Date(champ_date_limite.value);
    let maintenant = new Date();

    dateSaisie.setHours(0, 0, 0, 0);
    maintenant.setHours(0, 0, 0, 0);
    
    if (dateSaisie> maintenant) {
        
        p[0].style.display = 'none'
        
    }
    else {
        
        p[0].style.display = 'block';
        
    }
})

if (btn_supprimer) {
btn_supprimer.addEventListener('click', function () {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
        form.action = 'suppression_projet.php';

    }
})
}

if (btn_modifier) {
btn_modifier.addEventListener('click', function () {

    form.action = 'modification_projet.php';
})
}
