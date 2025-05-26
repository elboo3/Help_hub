document.getElementById('back-arrow').addEventListener('click', function () {
  let addresse =  window.location.pathname.split('/').pop(); // Get only ' ex: login.php'

  let destination = ''
  switch (addresse) {
    case 'login.php':
      destination = 'login_choix.php'
      break
    case 'mot_pass_oublier.php':
      destination = 'login.php'
      break
    case 'sign_up_donateur.php':
      destination = 'login.php'
      break
    case 'sign_up_responsable.php':
      destination = 'login.php'
      break
  }

  window.location.href=destination;
})
