<?php
session_start();

try{
    include('connexion.php');
    
    $req=$conn->prepare("select  sum(montant_participation) as total, max(montant_participation) as Max ,count(montant_participation) as number
                        from donateur_projet
                        where id_donateur=(select id_donateur from donateur where pseudo =?)");
    $req->execute(array($_SESSION['pseudo']));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
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
    
    <section class="Stat">
        <h3 class="text-primary fw-bold">Dashboard</h3>
        
        <div>
            <div class="chiffre">
                <p><span class="text-xs font-weight-bold text-primary">Montant Total de donnation : </span> <br> <?php echo $resultat[0]['total'] ?> DT<i class="bi bi-calculator-fill"></i></p>
                <p><span class="text-xs font-weight-bold text-danger">Montant Max de donnation :</span><br>  <?php echo $resultat[0]['Max'] ?> DT <i class="bi bi-graph-up-arrow"></i></p>
                <p><span class="text-xs font-weight-bold text-success">Nombre Totale de donnation :</span> <br> <?php echo $resultat[0]['number'] ?>  Fois  <i class="bi bi-cash-stack"></i></p>
            </div>

            <div class=" classement">
                <h3 class="text-primary fw-bold">Classement des donateur</h3>
                <table border="1" class="table table-bordered " id="class">
                
                </table>
            </div>
            
            
        </div>
    </section>
    <section class="main">
    <h3 class="text-primary fw-bold">Historique de Dons</h3>
    <form class="Liste_Projet"> 
        
    </form>
    </section>
    </div>
    


    <?php 

include('footer.php'); 


?>
</body>
</html>


<?php




try{

    $req=$conn->prepare("select pseudo , sum(montant_participation) as total
                        from donateur_projet 
                        INNER JOIN donateur on  donateur_projet.id_donateur=donateur.id_donateur
                        group by pseudo
                        order by total  desc");
    $req->execute();
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

echo '<script>
let tab=document.getElementById("class");
tab.innerHTML="<tr><th>Rank</th><th>pseudo</th><th>Montant Totale</th></tr>";
</script>';
for($i = 0; $i < count($resultat); $i++){
    if($i == 0) {
        echo "<script> tab.innerHTML += '<tr><td><i class=\"fas fa-trophy\" style=\"color: gold;\"></i></td><td>" . $resultat[$i]['pseudo'] . "</td><td>" . $resultat[$i]['total'] . " DT</td></tr>';</script>  ";
    }
    elseif($i == 1) {
        echo " <script>tab.innerHTML += '<tr><td><i class=\"fas fa-trophy\" style=\"color: silver;\"></i></td><td>" . $resultat[$i]['pseudo'] . "</td><td>" . $resultat[$i]['total'] . " DT</td></tr>'; </script>";
    }
    elseif($i == 2) {
        echo " <script>tab.innerHTML += '<tr><td><i class=\"fas fa-trophy\" style=\"color: #cd7f32;\"></i></td><td>" . $resultat[$i]['pseudo'] . "</td><td>" . $resultat[$i]['total'] . " DT</td></tr>';</script> ";
    }
    else {
        echo " <script>tab.innerHTML += '<tr><td>" . ($i + 1) . "</td><td>" . $resultat[$i]['pseudo'] . "</td><td>" . $resultat[$i]['total'] . " DT</td></tr>';</script> ";
    }
}
//recuperer historique des dons de donnateur

$req2=$conn->prepare("select donateur_projet.id_projet,montant_participation,titre,nom,nom_association
                    from donateur_projet 
                    INNER JOIN projet on  donateur_projet.id_projet=projet.id_projet
                    INNER JOIN responsable_association ON responsable_association.id_responsable = projet.id_responsable
                    where donateur_projet.id_donateur=(select id_donateur from donateur where pseudo =?)
                    ");

$req2->execute(array($_SESSION['pseudo']));
$resultat2= $req2->fetchAll(PDO::FETCH_ASSOC);



echo '<script>let div;</script>';
for ($i = 0; $i < count($resultat2); $i++) {
echo '<script>
    div = document.createElement("div");
    div.innerHTML = "<p><span class=\'text-xs font-weight-bold text-primary\'>Numéro Projet :</span> ' . $resultat2[$i]["id_projet"] . ' <br><span class=\'text-xs font-weight-bold text-primary\'>Titre:</span> ' . $resultat2[$i]["titre"] . ' <br><span class=\'text-xs font-weight-bold text-primary\'>Responsable:</span> ' . $resultat2[$i]["nom"] . ' (' . $resultat2[$i]["nom_association"] . ')</p> <p><span class=\'text-xs font-weight-bold text-success\'>Montant de participation </span><br><span class=\'h5 mb-0 font-weight-bold text-gray-800\'> ' . $resultat2[$i]["montant_participation"] . ' DT </span></p>";
    document.querySelector(".Liste_Projet").append(div);
</script>';
}
}catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
}

echo '<script>
function Dec(){
    window.location.href = "login.php";
}
</script>';
?>