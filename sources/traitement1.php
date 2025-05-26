<?php
session_start();


if (isset($_SESSION['role'])) {

    extract($_POST);
    try {

        include("connexion.php");

        if ($_SESSION['role'] == 'donateur') {
            $select_requete1 = "select count(*) as nb from donateur where email=? or cin=?";
            $location1 = "login.php";

            $select_requete2 = "select count(*)as nb from donateur where pseudo = ?";
            $location2 = "sign_up_donateur.php";

            $insert_requete = "insert into donateur(nom,prenom,email,CIN,pseudo,pwrd)
                            values(?,?,?,?,?,?)";
            $array=array($Nom, $Prenom, $Email, $CIN, $pseudo, $mot_de_passe);
            $location3 = "login.php";
        } else {
            $select_requete1 = "select count(*) as nb from responsable_association where email=? or cin=?";
            $location1 = "login.php";

            $select_requete2 = "select count(*)as nb from responsable_association where pseudo = ?";
            $location2 = "sign_up_responsable.php";

            $insert_requete = "insert into responsable_association(nom,prenom,email,CIN,nom_association,adresse_association,matricule_fiscale,logo,pseudo,pwrd)
                            values(?,?,?,?,?,?,?,?,?,?)";
            $array=array($Nom, $Prenom, $Email, $CIN,$nom_association,$adresse,$matricule_fiscale,$logo, $pseudo, $mot_de_passe);
            $location3 = "login.php";
        }
        //verifer si le donnateur ou le responsable est déjà inscrit
        $req = $conn->prepare($select_requete1);
        $req->execute(array($Email, $CIN));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        if ($resultat[0]["nb"] == 1) {
            echo "<script>
        window.location.href = '".$location1."';
    alert('Une inscription trouver ,utiliser votre pseudo et pwrd pour connecter');
    </script>";
        } else {
            //avant l'insertion on vérifie si le pseudo est déja utiliser
            $req2 = $conn->prepare($select_requete2);
            $req2->execute(array($pseudo));
            $resultat2 = $req2->fetchAll(PDO::FETCH_ASSOC);
            if ($resultat2[0]["nb"] == 1) {
                echo "<script>
        window.location.href = '$location2';
    alert('ce pseudo est déjà utiliser');
    </script>";
            } else {
                $req3 = $conn->prepare($insert_requete);
                $req3->execute($array);
                echo "<script>
        window.location.href = '$location3';
    alert('inscription avec succés');
    </script>";
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
