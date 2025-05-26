<?php
extract($_POST);


session_start();
if($_SESSION['role']==null){
    
    $_SESSION['role']=$choix;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css?v=<?php echo time();?>">
</head>
<body>
    <form action="traitement2.php" method="post" class="authent  form-control" >
    <img src="back-arrow.png" id="back-arrow" alt="">
        <h3 id="header"></h3>

        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" class="form-control" required>
        <p class="controle">le pseudo composer seulement des lettre</p>

        <input type="password" name="mot de passe" id="mot de passe" placeholder="mot de passe"class="form-control" required>
        <p class="controle">le mot de passe composer au minimum 8 chiffre ou lettre et se termine par $ ou # </p>
        
        <a href="mot_pass_oublier.php">mot de passe oublié ?</a>
        <input type="submit" value="s'authentifier" class="btn" name='ok'>

    </form>

    <p>Nouveau dans notre paltforme? <a href="" id="creer_compte">Créer votre compte</a></p>

    <script src="controle3.js?v=<?php echo time();?>"></script>
    <script src="back-arrow.js?v=<?php echo time(); ?>"></script>
    
</body>
</html>
<?php





if($_SESSION['role']=="donateur"){
    echo"
    <script>
        document.getElementById('header').innerHTML='Authentification en tantque Donateur';
        document.getElementById('creer_compte').setAttribute('href','sign_up_donateur.php');
    </script>
    ";
}
else{
    echo"
    <script>
        document.getElementById('header').innerHTML='Authentification en tantque Responsable';
        document.getElementById('creer_compte').setAttribute('href','sign_up_responsable.php');
    </script>
    ";
}


?>