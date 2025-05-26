<?php
session_start();

extract($_POST);


if (count($_POST) > 1) {
    
try {
    include("connexion.php");

    $req = $conn->prepare("INSERT INTO projet(titre,description,date_limite,montant_total_a_collecter,id_responsable) VALUES(?,?,?,?,(SELECT responsable_association.id_responsable FROM responsable_association WHERE responsable_association.pseudo=?));");
    $req->execute(array($titre,$description,$date_limite,$montant_total_a_collecter,$_SESSION['pseudo']));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    echo"<script>alert('L\'ajout à été afféctué avec succes !! ');</script>";
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time(); ?>">
</head>

<body>

<?php 

include('header.php'); 
include("nav.php");


?>



    <div class="main">
        <div>
            <div></div>
            <button class="btn btn-danger" id="retour"><i class="bi bi-x-lg"></i></button>
        </div>



        <form class="detail_projet_responsable" name="detail_projet_responsable" action="ajout_projet.php" method="post">
            <h3 class="text-primary fw-bold">Projet Detailles : </h3>

            
            
            <label for="titre">Titre de projet : <input type="text" value="" id="titre" name="titre" required></label>
            
            <label for="description">Description :<br> <textarea type="text" id="description" name="description" required></textarea></label>

            <label for="date_limite">Date limite : <input type="date" value="" id="date_limite" class="" name="date_limite" required></label>
            <p>la date doit être supérieur à la date actuelle</p>
            <label for="montant_total_a_collecter">Montant à collecter : <input type="number" value="" id="montant_total_a_collecter" name="montant_total_a_collecter" required></label>

            <div>
                <input type="submit" value="Ajouter" class="btn btn-primary" id="ajouter" name="ajouter">  
            </div>


        </form>

    </div>

    <?php include('footer.php'); ?>

    <script src="controleResponsable.js?v=<?php echo time(); ?>"></script>
</body>

</html>

