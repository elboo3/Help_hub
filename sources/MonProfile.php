<?php

session_start();



try {
    include("connexion.php");

    if ($_SESSION["role"] == 'donateur') {
        $req = $conn->prepare("select nom ,prenom ,email, cin   
                        from donateur 
                        where pseudo=?");
        $req->execute(array($_SESSION['pseudo']));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        echo '<style> 
    .responsable{
    display:hidden;
}
    </style>';
    }
    //en cas responsable
    else {
        $req = $conn->prepare("select nom ,prenom ,email, cin , nom_association ,adresse_association, matricule_fiscale , logo  from responsable_association where pseudo=?;");

        $req->execute(array($_SESSION['pseudo']));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        echo '<style> 
    .responsable{
    display:none;
}
    </style>';


        $logoData = base64_encode($resultat[0]['logo']);
        $_SESSION['logo'] = $resultat[0]['logo'];
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>

    <?php

    include('header.php');
    include("nav.php");

    ?>

    <form action="traitement4.php" class="form-control Modif" method="post" enctype="multipart/form-data">
        <h3 class="text-primary fw-bold border-bottom pb-2">Mon profile</h3>
        <div class="info">
            <label for="Nom">Nom :</label>
            <input type="text" name="Nom" id="Nom" placeholder="Nom" class="form-control zone_texte" value=<?php echo $resultat[0]['nom']; ?> required>
        </div>
        <p>le nom composer seulement des lettre</p>
        <div class="info">
            <label for="Prenom">Prenom :</label>
            <input type="text" name="Prenom" id="Prenom" placeholder="Prenom" class="form-control zone_texte" value=<?php echo $resultat[0]['prenom']; ?> required>
        </div>
        <p>le prénom composer seulement des lettre</p>
        <div class="info">
            <label for="Email">Email :</label>
            <input type="email" name="Email" id="Email" placeholder="Email" class="form-control zone_texte" value=<?php echo $resultat[0]['email']; ?> required>
        </div>

        <p>forme invalide</p>
        <div class="info">
            <label for="CIN">CIN :</label>
            <input type="text" name="CIN" id="CIN" placeholder="CIN" class="form-control zone_texte" maxlength="8" value=<?php echo $resultat[0]['cin']; ?> required disabled>
        </div>



        <?php

        if ($_SESSION["role"] == 'responsable') {
            echo '
            
             <div class="info">
         <label for="nom_association">Nom de l\'association :</label>
         <input type="text" name="nom_association" id="nom_association" placeholder="Nom de l\'Association" class="form-control zone_texte responsable" value="' . htmlspecialchars($resultat[0]['nom_association']) . '" required>
       </div>

       <div class="info">
         <label for="adresse">Adresse de l\'asscociation :</label>
         <input type="text" name="adresse" id="adresse" placeholder="Adresse de l\'Association" class="form-control zone_texte responsable" value="' . htmlspecialchars($resultat[0]['adresse_association']) . '" required>
       </div>
       <p>l\'adresse composer seulement des lettre et chiffre</p>
        
       <div class="info">
         <label for="matricule_fiscale">Matricule Fiscale :</label>
         <input type="text" name="matricule_fiscale" id="matricule_fiscale" placeholder="matricule_fiscale Fiscale" class="form-control zone_texte responsable" maxlength="6" value="' . htmlspecialchars($resultat[0]['matricule_fiscale']) . '" required>
       </div>
       <p>le matricule fiscale doit etre sous cette forme : $AAA11</p>
       
        
       <div class="info">
         <label for="adresse">Logo de l\'association :</label>
         
         <div id="logo_box" class="form-control zone_texte responsable">
                <input type="file" name="logo" id="logo" accept=".jpg,.jpeg,.png">
                <img src="data:image/png;base64,' . $logoData . '" alt="" id="preview" name="preview" >
        </div>
       </div>
            
            ';

            //ajuster le hauteur de form pour les champs de responsable
            echo '<style>
        .Modif{
            height: 1250px;
        }
       </style>';
        }

        ?>





        <div class="info">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" class="form-control zone_texte" value=<?php echo $_SESSION['pseudo']; ?> required>
        </div>
        <p>le pseudo composer seulement des lettre</p>
        <div class="info">
            <label for="ancien_mot_de_passe">Ancien mot de passe :</label>
            <input type="password" name="ancien_mot_de_passe" id="ancien_mot_de_passe" placeholder="Ancien mot de passe" class="form-control zone_texte">
        </div>
        <p>le pwrd composer seulement des lettre et des chiffre se termine par $ ou # de longeure 8</p>

        <div class="info">
            <label for="nouveau_mot_de_passe">Nouveau mot de passe :</label>
            <input type="password" name="nouveau_mot_de_passe" id="nouveau_mot_de_passe" placeholder="Nouveau mot de passe" class="form-control zone_texte">
        </div>
        <p>s'il vous plait saisir d'abord l'ancien pwrd</p>
        

        <br>
        <br>
        <input type="submit" value="Appliquer les modification" class="btn btn-primary" id="ok">
    </form>

    <?php

    include('footer.php');


    ?>
    <script>
        if (<?php echo $_SESSION['role']; ?> == 'responsable') {
            document.body.id = "responsable_profile";

        } else {
            document.body.id = "donateur_profile";
        }
    </script>
</body>
<script src="controle4.js?v=<?php echo time(); ?>"></script>

</html>