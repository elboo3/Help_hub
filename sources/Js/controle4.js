let email = document.getElementById('Email')
let pseudo = document.getElementById('pseudo')
let password = document.getElementById('ancien_mot_de_passe')
let password2 = document.getElementById('nouveau_mot_de_passe')
let nom = document.getElementById('Nom')
let prenom = document.getElementById('Prenom')
let p = document.getElementsByTagName('p')
let form = document.querySelector('form')
let btn = document.getElementById('ok')

//champs supplementaires pour le responsable
let nom_association = document.getElementById('nom_association')
let adresse = document.getElementById('adresse')
let matricule_fiscale = document.getElementById('matricule_fiscale')
let logo = document.getElementById('logo')

function validerEmail (input) {
  // Expression régulière pour valider une adresse email
  const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/
  if (regex.test(input.value)) {
    success(input)
  } else {
    danger(input)
  }
}
email.addEventListener('keyup', function () {
  validerEmail(email)
})

function pseudo_valide (input) {
  valide = true
  for (let i = 0; i < input.value.length && valide; i++) {
    if (
      input.value[i].toLowerCase() < 'a' ||
      input.value[i].toLowerCase() > 'z'
    )
      valide = false
  }
  if (valide || input.value.length == 0) {
    success(input)
  } else {
    danger(input)
  }
}

//verifier que le mot de passe est valide
function motPassValider (input) {
  const regex = /^[a-zA-Z0-9]{7,}[#$]$/
  if (regex.test(input.value) || input.value.length == 0) {
    success(input)
  } else {
    danger(input)
  }
}

nom.addEventListener('keyup', function () {
  pseudo_valide(nom)
})
prenom.addEventListener('keyup', function () {
  pseudo_valide(prenom)
})
pseudo.addEventListener('keyup', function () {
  pseudo_valide(pseudo)
})
password.addEventListener('keyup', function () {
  motPassValider(password)
})

function nouveauPass (input_ancien, input_nouveau) {
  if (input_ancien.value.length == 0) {
    danger(input_nouveau)
    nextParagraphe(input_nouveau).textContent="s'il vous plait saisir d'abord l'ancien pwrd";
    
  } 
  else {
    nextParagraphe(input_nouveau).textContent="le pwrd composer seulement des lettre et des chiffre se termine par $ ou # de longeure 8";
    success(input_ancien)
    motPassValider(input_nouveau)
  }
}

function matriculeFiscaleValide (input) {
  const regex = /^\$[A-Z]{3}[0-9]{2}$/

  if (regex.test(input.value) || input.value.length === 0) {
    success(input)
  } else {
    danger(input)
  }
}

if (matricule_fiscale) {
  matricule_fiscale.addEventListener('keyup', function () {
    matriculeFiscaleValide(matricule_fiscale)
  })
}

function require () {
  if (password.value.length == 0) password2.required = false
  else password2.required = true
}

password2.addEventListener('keyup', function () {
  nouveauPass(password, password2)
})

btn.addEventListener('mouseover', function () {
  require()
})

//bloquer la forme s il y a un eurreur de saisie par le donateur
form.addEventListener('submit', function (event) {
  Valide = true
  for (i = 0; i < p.length && Valide; i++) {
    if (p[i].style.display == 'block') Valide = false
  }

  if (!Valide) {
    event.preventDefault()
    alert('Veuillez remplir correctement tous les champs.')
  }
})

if (logo) {
  logo.addEventListener('change', function (event) {
    const file = event.target.files[0]
    if (file) {
      document.getElementById('preview').src = URL.createObjectURL(file)
      document.getElementById('preview').style.display = 'block' // Optional
    }
  })
}

function nextParagraphe (element) {
  let parent = element.parentElement 

  let nextP = parent

  while ((nextP = nextP.nextElementSibling)) {
    if (nextP.tagName.toLowerCase() == 'p') {
      
      break
    }
  }
  return nextP
}

function success (input) {
  input.className = 'form-control border-success focus-ring focus-ring-success'
  input.style.width = '70%'
  input.style.height = '40px'
  input.style.marginLeft = '180px'
  input.style.marginTop = '-30px'
  nextParagraphe(input).style.visibility = 'hidden'
}

function danger (input) {
  input.className = 'form-control border-danger focus-ring focus-ring-danger'
  input.style.width = '70%'
  input.style.height = '40px'
  input.style.marginLeft = '180px'
  input.style.marginTop = '-30px'
  nextParagraphe(input).style.visibility = 'visible'
}
