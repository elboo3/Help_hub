<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css?v=<?php echo time();?>">
</head>
<body>
    <form action="traitement1.php" method="post" class="inscri  form-control">
    <img src="back-arrow.png" id="back-arrow" alt="">
        <h3>Inscription Donateur</h3>

        <input type="text" name="Nom" id="Nom" placeholder="Nom" class="form-control" required>
        <p class="controle">le nom composer seulement des lettre</p>

        <input type="text" name="Prenom" id="Prenom" placeholder="Prénom" class="form-control" required>
        <p class="controle">le prénom composer seulement des lettre</p>

        <input type="email" name="Email" id="Email" placeholder="Email" class="form-control" required>
        <p class="controle">forme invalide</p>

        <input type="text" name="CIN" id="CIN" placeholder="CIN" class="form-control" maxlength="8" required>
        <p class="controle">CIN composer seulement de 8 chiffre</p>

        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" class="form-control" required>
        <p class="controle">le pseudo composer seulement des lettre</p>

        
        <input type="password" name="mot de passe" id="mot de passe" placeholder="mot de passe"class="form-control" required>
        <p class="controle">le mot de passe composer au minimum 8 chiffre ou lettre et se termine par $ ou # </p>

        
        
        <input type="submit" value="S’inscrire" class="btn" name="dona">


    </form>
    <script src="controle.js?<?php echo time();?>"></script>
    <script src="back-arrow.js?v=<?php echo time(); ?>"></script>
</body>
</html>