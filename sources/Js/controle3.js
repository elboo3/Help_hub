let pseudo = document.getElementById('pseudo')
let password = document.getElementById('mot de passe')



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
    input.className =
      'form-control border-success focus-ring focus-ring-success';
    input.nextElementSibling.style.visibility="hidden";
  } else {
    input.className = 'form-control border-danger focus-ring focus-ring-danger';

    input.nextElementSibling.style.visibility="visible";
  }
}

pseudo.addEventListener('keyup',function(){pseudo_valide(pseudo)})

function motPassValider (input) {
  const regex = /^[a-zA-Z0-9]{7,}[#$]$/
  if (regex.test(input.value) || input.value.length == 0) {
    input.className =
      'form-control border-success focus-ring focus-ring-success';
    
      input.nextElementSibling.style.visibility="hidden";
  } else {
    input.className = 'form-control border-danger focus-ring focus-ring-danger';
    
    input.nextElementSibling.style.visibility="visible";
  }
}

password.addEventListener('keyup', function(){motPassValider(password)})


