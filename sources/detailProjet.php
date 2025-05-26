
<?php
session_start();


if(isset($_POST['ID_Projet'])){
    $_SESSION["id_projet"]=$_POST['ID_Projet'];
}

try {
    include("connexion.php");
    
    $req=$conn->prepare("select projet.*,nom ,prenom,email,nom_association,adresse_association,logo
                        from projet 
                        INNER JOIN responsable_association ON responsable_association.id_responsable = projet.id_responsable
                        where id_projet=?");
    $req->execute(array($_SESSION["id_projet"]));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
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
        <h3 class="text-primary fw-bold">Projet № <?php echo $resultat[0]['id_projet'];?>  :  </h3>
        <button class="btn btn-danger" id="retour"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <h4>Proposer par : </h4>
        <section class="responsable">
            <div><img src="data:image/png;base64,<?php echo base64_encode($resultat[0]['logo']); ?>" alt="Logo association"></div>
            <p><?php echo $resultat[0]['nom_association']; ?><br>
                (<?php echo $resultat[0]['adresse_association']; ?>)</p>
        </section>
        <section class="detail_projet">
            <h4>Titre de projet : <?php echo $resultat[0]['titre']; ?></h4>
        <p><?php echo $resultat[0]['description']; ?></p>
        <h4>Date Limite pour les Dons</h4>
        <p><?php echo $resultat[0]['date_limite']; ?></p>
        <div class="Montant">
            <p><span>Montant à collecter : </span> <br><?php echo $resultat[0]['montant_total_a_collecter']; ?>  <i class="fas fa-donate"></i></p>
            <p><span>Montant  collecter : </span><br><?php echo $resultat[0]['montant_total_collecter']; ?>  <i class="fas fa-wallet"></i></p>
            <p><span>montant restant à collecter : </span><br><?php echo $resultat[0]['montant_total_a_collecter'] -$resultat[0]['montant_total_collecter']; ?><i class="fas fa-box-open"></i></p>
        </div>
        </section>
        <section class="donation">
            <h4>Faites un Don et Aidez à Atteindre notre Objectif</h4>
            <form action="Donateur_Projet.php" method="post" id="donation">
            <input type="number"  class="form-control" name="Montant" id="Montant" step="0.01" placeholder="Exemple 100 DT" onkeyup="controle()">
                <p id="Controle">*Le montant ne doit pas dépasser le montant restant</p>
                <button class="btn btn-success" >Participer</button>
            </form>
                
            
            
        </section>
        <p>pour plus de détail vous pouvez contacter le responsable de projet  :  <?php echo $resultat[0]['nom'].' '.$resultat[0]['prenom']; ?> :  <a href="mailto:<?php echo $resultat[0]['email']; ?>">      <?php echo $resultat[0]['email']; ?></a></p>
    </div>

    <?php 

include('footer.php'); 


?>
</body>
<script src="controleDonation.js?v=<?php echo time(); ?>"></script>
</html>

<?php
echo '
<script>
let montant=document.getElementById("Montant");
function controle(){
    if(montant.value>('.$resultat[0]["montant_total_a_collecter"]- $resultat[0]["montant_total_collecter"].')){
        document.getElementById("Controle").style.display = "block";
        montant.className="form-control border-danger focus-ring focus-ring-danger";
    }else{
    document.getElementById("Controle").style.display = "none";
    montant.className="form-control border-success focus-ring focus-ring-success";
}
}
montant.addEventListener("keyup",controle());
</script>';

?>