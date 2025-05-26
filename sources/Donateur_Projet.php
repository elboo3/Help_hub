<?php
date_default_timezone_set('Africa/Tunis'); // or your correct timezone

session_start();


$id_donateur;


try{


    include("connexion.php");

    //recupere l'id de donateur
    $req = $conn->prepare("select id_donateur from donateur where pseudo =?");
    $req->execute(array($_SESSION['pseudo']));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    $id_donateur= $resultat[0]['id_donateur'];

    $date_participation = date('Y-m-d H:i:s'); // Example output: 2025-04-27 14:30:00

    //Ajouter la donnation
    $req2=$conn->prepare("insert into donateur_projet (id_donateur,id_projet,montant_participation,date_participation)
                            values(?,?,?,?)");
    $req2->execute(array($id_donateur,$_SESSION["id_projet"],$_POST["Montant"],$date_participation));
    //mise a jour de montant a collecter 
    $req3=$conn->prepare("update projet 
                    set  montant_total_collecter=montant_total_collecter+?
                    where id_projet=?");
    $req3->execute(array($_POST["Montant"],$_SESSION["id_projet"]));
}catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
}
include 'AjoutDonation.php';
?>