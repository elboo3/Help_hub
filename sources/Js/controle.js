let cin = document.getElementById('CIN')
let email = document.getElementById('Email')
let pseudo = document.getElementById('pseudo')
let password = document.getElementById('mot de passe')
let nom = document.getElementById('Nom')
let prenom = document.getElementById('Prenom')
let p = document.querySelectorAll('.controle')
let form = document.querySelector('form')

//pour la page  de sign_up_responsable

let matricule_fiscale = document.getElementById('matricule_fiscale')
let logo = document.getElementById('logo')

// verifier que la CIN est valide
function CinValide (input) {
  valide = true
  for (let i = 0; i < input.value.length && valide; i++) {
    if (input.value[i] < '0' || input.value[i] > '9') {
      valide = false
    }
  }
  if (!valide || input.value.length != 8) {
    danger(input)
  } else {
    success(input)
  }
}

cin.addEventListener('keyup', function () {
  CinValide(cin)
})

//////////////////////////////////////////////

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

//verifier que le pseudo est valide
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

pseudo.addEventListener('keyup', function () {
  pseudo_valide(pseudo)
})

//verifier que le mot de passe est valide
function motPassValider (input) {
  const regex = /^[a-zA-Z0-9]{7,}[#$]$/
  if (regex.test(input.value) || input.value.length == 0) {
    success(input)
  } else {
    danger(input)
  }
}

password.addEventListener('keyup', function () {
  motPassValider(password)
})

//verifier aussi le nom et le prenom

nom.addEventListener('keyup', function () {
  pseudo_valide(nom)
})

prenom.addEventListener('keyup', function () {
  pseudo_valide(prenom)
})

form.addEventListener('submit', function (event) {
  Valide = true
  for (i = 0; i < p.length && Valide; i++) {
    if (p[i].style.visibility == 'visible') Valide = false
  }

  if (!Valide) {
    event.preventDefault()
    alert('Veuillez remplir correctement tous les champs.')
  }
})

function matriculeFiscaleValide (input) {
  const regex = /^\$[A-Z]{3}[0-9]{2}$/

  if (regex.test(input.value) || input.value.length == 0) {
    success(input)
  } else {
    danger(input)
  }
}

matricule_fiscale.addEventListener('keyup', function () {
  matriculeFiscaleValide(matricule_fiscale)
})

function logo_selection () {
  if (logo.files[0]) {
    document.getElementById('preview').src = URL.createObjectURL(logo.files[0])
    document.getElementById('preview').style.display = 'block'
  }
}

logo.addEventListener('change', function () {
  logo_selection()
})

function nextParagraphe (element) {
  let nextP = element

  while ((nextP = nextP.nextElementSibling)) {
    if (nextP.tagName.toLowerCase() == 'p') {
      break
    }
  }
  return nextP
}

function success (input) {
  input.className = 'form-control border-success focus-ring focus-ring-success zone_text'
  input.style.width = '85%'
  input.style.height = '40px'

  nextParagraphe(input).style.visibility = 'hidden'
}

function danger (input) {
  input.className = 'form-control border-danger focus-ring focus-ring-danger zone_text'
  input.style.width = '85%'
  input.style.height = '40px'

  nextParagraphe(input).style.visibility = 'visible'
}

