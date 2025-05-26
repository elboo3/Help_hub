<?php
session_start();

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
    <div class="main">
        <div>
            <h3 class="text-primary fw-bold">Resultat du recherche : </h3>
            <button class="btn btn-danger" id="retour" ><i class="bi bi-x-lg"></i></button>
        </div>
        <form class="Liste_Projet" action="detailProjet.php" method="post"> 
            <input type="hidden" name="ID_Projet" id="ID_Projet">
        </form>
    </div>

    
    <?php 

include('footer.php'); 


?>
    
</body>
<script src="controleDonation.js?v=<?php echo time();?>"></script>
</html>


<?php

extract($_POST);
try{
    include("connexion.php");
    $req=$conn->prepare("select id_projet, titre, montant_total_a_collecter, nom, nom_association  
                        from projet  
                        INNER JOIN responsable_association ON responsable_association.id_responsable = projet.id_responsable
                        where DATE(date_limite)>CURDATE() AND montant_total_a_collecter > montant_total_collecter and description like ?");
    $req->execute(array("%$search%"));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    if(count($resultat)==0) {
        echo '<script>
        let p = document.createElement("p");
        p.className="empty";
        p.innerHTML=" Aucun résultat trouvé <i class=\'bi bi-folder-x\'></i>";
        document.querySelector(".Liste_Projet").append(p);
        </script>';
    }else{
        echo '<script>
        function recuperer(id){
            document.getElementById("ID_Projet").value = id;
            document.querySelector(".Liste_Projet").submit();
        }
    </script>';
    
        echo '<script>let div;</script>';
    for ($i = 0; $i < count($resultat); $i++) {
        echo '<script>
            div = document.createElement("div");
            div.innerHTML = "<p  onclick=\'recuperer(' . $resultat[$i]["id_projet"] . ')\'><span class=\'text-xs font-weight-bold text-primary\'>Numéro Projet :</span> ' . $resultat[$i]["id_projet"] . ' <br><span class=\'text-xs font-weight-bold text-primary\'>Titre:</span> ' . $resultat[$i]["titre"] . ' <br><span class=\'text-xs font-weight-bold text-primary\'>Responsable:</span> ' . $resultat[$i]["nom"] . ' (' . $resultat[$i]["nom_association"] . ')</p> <p onclick=\'recuperer(' . $resultat[$i]["id_projet"] . ')\'><span class=\'text-xs font-weight-bold text-success\'>Montant à collecter </span><br><span class=\'h5 mb-0 font-weight-bold text-gray-800\'> ' . $resultat[$i]["montant_total_a_collecter"] . ' DT </span></p>";
            document.querySelector(".Liste_Projet").append(div);
        </script>';
    }
    }



}catch(PDOException $e){
    echo "Erreur : ".$e->getMessage();
    }

?>