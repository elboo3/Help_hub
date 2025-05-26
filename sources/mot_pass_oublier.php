<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css?v=<?php echo time();?>">
</head>
<body>
    <form action="traitement3.php" method="post" class="motPass form-control">
    <img src="back-arrow.png" id="back-arrow" alt="">
        <h3>Réinitialisation du mot de passe</h3>
        <input type="email" name="Email" id="Email" placeholder="Email" class=" form-control" required>
        <p>forme invalide</p>
        <input type="password" name="mot_de_passe1" id="pass1" placeholder="nouveau mot de passe"class=" form-control">
        
        <p>le mot de passe composer au minimum 8 chiffre ou lettre et se termine par $ ou # </p>
        <input type="password" name="mot_de_passe2" id="pass2" placeholder="Confirmez votre nouveau mot de passe"class="form-control">
        
        <p>mot de passe incorrecte</p>
        <input type="submit" value="Valider" class="btn">
    </form>
    <script src="controle2.js?v=<?php echo time(); ?>"></script>
    <script src="back-arrow.js?v=<?php echo time(); ?>"></script>
</body>
</html>