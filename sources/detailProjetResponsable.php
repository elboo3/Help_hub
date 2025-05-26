<?php
session_start();

extract($_POST);



$_SESSION['id_projet'] = $_POST['id_projet'];

try {
    include("connexion.php");

    $req = $conn->prepare("SELECT projet.* FROM projet WHERE id_projet=?;");
    $req->execute(array($_SESSION['id_projet']));
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time(); ?>">
</head>

<body class="dashboard_responsable">
    <?php include('header.php'); 

    include("nav.php");
    ?>
    
    <div class="main">
        <div class="row1">
            <div></div>
            <button class="btn btn-danger" id="retour"><i class="bi bi-x-lg"></i></button>
        </div>



        <div class="row2">
            <form class="detail_projet_responsable" name="detail_projet_responsable" action="" method="post">
                <h3 class="text-primary fw-bold">Projet Detailles : </h3>

                <label for="titre">Numéro de projet : <input type="text" value="<?php echo $resultat[0]['id_projet']; ?>" id="id_projet" name="id_projet" readonly></label>

                <label for="titre">Titre de projet : <input type="text" value="<?php echo $resultat[0]['titre']; ?>" id="titre" name="titre"></label>

                <label for="description">Description :<br> <textarea type="text" id="description" name="description"><?php echo $resultat[0]['description']; ?></textarea></label>

                <label for="date_limite">Date limite : <input type="date" value="<?php echo $resultat[0]['date_limite']; ?>" id="date_limite" name="date_limite"></label>
                <p>la date doit être supérieur à la date actuelle</p>
                <label for="montant_total_a_collecter">Montant à collecter : <input type="number" value="<?php echo $resultat[0]['montant_total_a_collecter']; ?>" id="montant_total_a_collecter" name="montant_total_a_collecter"></label>

                <div>
                    <input type="submit" value="Modifier" class="btn btn-primary" id="modifier">
                    <input type="submit" value="Supprimer" class="btn btn-danger" id="supprimer">
                </div>
            </form>
            <div class=".liste_donateurs">
                <?php
                $ch = "";

                try {
                    include("connexion.php");

                    $req = $conn->prepare("SELECT donateur.id_donateur,donateur.nom,donateur.prenom,donateur_projet.montant_participation,donateur_projet.date_participation FROM donateur_projet,donateur WHERE donateur_projet.id_donateur=donateur.id_donateur AND donateur_projet.id_projet=?  order by donateur_projet.date_participation desc;");
                    $req->execute(array($_SESSION['id_projet']));
                    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

                   

                    if (count($resultat) > 0) {


                        $ch .= "<table border='1' id='table_donateurs' class='table table-hover '><thead>
        <th>Identifinat</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Montant de Participation</th>
        <th>Date de Participation</th>
    </thead><tbody>";
                        for ($i = 0; $i < count($resultat); $i++) {
                            
                            $ch .= "<tr>
            <td>".$resultat[$i]['id_donateur']."</td>
            <td>".$resultat[$i]['nom']."</td>
            <td>".$resultat[$i]['prenom']."</td>
            <td>".$resultat[$i]['montant_participation']."</td>
            <td>".$resultat[$i]['date_participation']."</td>
        </tr>";
                        }
                        $ch .= "</tbody></table>";

                        $ch.='<script>
    let bouton_supprimer=document.getElementById("supprimer");
    bouton_supprimer.style.display="none";
    </script>';
                    } else {
                        $ch .= "<h3>Aucun donateur !!</h3>";
                        $ch.='<script>
    let bouton_supprimer=document.getElementById("supprimer");
    bouton_supprimer.style.display="block";
    </script>';
                    }
                    



                    echo $ch;
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }

                ?>
            </div>


        </div>
    </div>
    <?php include('footer.php'); ?>

    <script src="controleResponsable.js?v=<?php echo time(); ?>"></script>  

    
</body>
</html>
