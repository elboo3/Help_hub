<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
   

</head>

<body>
    <form action="traitement1.php" method="post" class="inscri inscri_responsable">
        <img src="back-arrow.png" id="back-arrow" alt="">
        <h3>Inscription Responsable</h3>



        <input type="text" name="Nom" id="Nom" placeholder="Nom" class="zone_text" required>
        <p class="controle">le nom composer seulement des lettre</p>

        <input type="text" name="Prenom" id="Prenom" placeholder="Prénom" class="zone_text" required>
        <p class="controle">le prénom composer seulement des lettre</p>

        <input type="email" name="Email" id="Email" placeholder="Email" class="zone_text" required>
        <p class="controle">forme invalide</p>

        <input type="text" name="CIN" id="CIN" placeholder="CIN" class="zone_text" maxlength="8" required>
        <p class="controle">CIN composer seulement de 8 chiffre</p>


        <input type="text" name="nom_association" id="nom_association" placeholder="Nom de l'Association" class="zone_text" required>
        <input type="text" name="adresse" id="adresse" placeholder="Adresse de l'Association" class="zone_text" required>
        <p class="controle">l'adresse composer seulement des lettre et chiffre</p>

        <input type="text" name="matricule_fiscale" id="matricule_fiscale" placeholder="matricule_fiscale Fiscale" class="zone_text" maxlength="6" required>
        <p class="controle">l'matricule_fiscale doit etre sous cette forme : $AAA11</p>

        <div id="logo_box" >
        <p>Selectionnez un logo :</p><br>
            <input type="file" name="logo" id="logo" placeholder="logo" accept=".jpg,.png,.jpeg" required class="">
            <img src="" alt="" id="preview">
        </div>




        <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" class="zone_text" required>
        <p>le pseudo composer seulement des lettre</p>

        <input type="password" name="mot de passe" id="mot de passe" placeholder="mot de passe" class="zone_text" required>
        
        <p>le mot de passe composer au minimum 8 chiffre ou lettre et se termine par $ ou # </p>

        <input type="submit" value="S’inscrire" class="btn" name="responsable">


    </form>
    
    <script src="controle.js?v=<?php echo time(); ?>"></script>
    <script src="back-arrow.js?v=<?php echo time(); ?>"></script>
</body>

</html>