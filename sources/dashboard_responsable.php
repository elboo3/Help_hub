<?php
session_start();

$_SESSION['id_projet']="";


try {
    include('connexion.php');


    $req = $conn->prepare("SELECT projet.* from projet,responsable_association WHERE responsable_association.id_responsable=projet.id_responsable and responsable_association.pseudo=? ORDER BY projet.montant_total_collecter DESC;");
    $req->execute(array($_SESSION['pseudo']));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time(); ?>">
    <title>Document</title>


</head>

<body>
<?php 

include('header.php'); 
include("nav.php");

?>

    
    <div class="dashboard">


        <section class="main">


            <form id="form_projets_responsable" action="" method="post">

                <input type="text" name="id_projet" id="id_projet" value="" hidden>

                <div class="container_plus_financés">
                    <?php

                    $ch = "<h3 class='text-primary fw-bold'>Projets les plus financés</h3>";
                    

                    $ch .= "<div id='btn_ajouter_projet'><button class='btn'>
  <img src='ajouter_projet.jpg' alt='Ajouter un projet'>
</button></div>
";

                    if (count($resultat) == 0) {
                        $ch .= "<h4 class='fw-bold'>Aucun projet trouvé</h4>";
                    } else {
                        

                        for ($i = 0; $i < count($resultat); $i++) {
                            $titre = $resultat[$i]["titre"];
                            $description = $resultat[$i]["description"];
                            $montant_collecte = $resultat[$i]["montant_total_collecter"];
                            $montant_total = $resultat[$i]["montant_total_a_collecter"];
                            $id_projet = $resultat[$i]["id_projet"];
                            // Éviter la division par 0
                            $pourcentage = $montant_total > 0 ? round(($montant_collecte / $montant_total) * 100, 2) : 0;

                            if ($pourcentage > 100) {
                                $pourcentage = 100;
                            }
                            $ch .= "
    <div class='projets_plus_financés' data-id='$id_projet' >
        <div data-id='$id_projet'>
            <h4 data-id='$id_projet'><strong>$titre</strong></h4>
            <p data-id='$id_projet'>$description</p>
        </div>
    
        <div class='montant' data-id='$id_projet'>
            <p data-id='$id_projet'>Montant collecté: $montant_collecte</p>
            <p data-id='$id_projet'>Montant total à collecter: $montant_total</p>
        </div>
        <div class='progress-container' data-id='$id_projet'>
            <div class='progress-bar' style='width: {$pourcentage}%;' data-id='$id_projet'>{$pourcentage}%</div>
        </div>   
    </div>
 
    ";
                        }
                    }

                    echo $ch;
                    ?>

                </div>

            </form>
        </section>
    </div>

    <?php include('footer.php'); ?>

</body>
<script>
    var tab = document.querySelectorAll('.projets_plus_financés');

    for (var i = 0; i < tab.length; i++) {
        tab[i].addEventListener('click', function() {
            

            // Récupérer l'ID du projet à partir de l'attribut 'value'
            document.getElementById("id_projet").value = this.getAttribute('data-id');
            document.getElementById("form_projets_responsable").action = "detailProjetResponsable.php";
            // Soumettre le formulaire

            document.getElementById("form_projets_responsable").submit();

        });
    }
    document.getElementById("btn_ajouter_projet").addEventListener('click', function() {
        document.getElementById("form_projets_responsable").action = "ajout_projet.php";
        document.getElementById("form_projets_responsable").submit();
    });
</script>

</html>