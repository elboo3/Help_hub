
<?php
session_start();


try {
    include("connexion.php");
    echo'<script>alert($_SESSION["role"]);</script>';
    
    if ($_SESSION["role"] == 'donateur') {

        $req = $conn->prepare("select count(*) as nb 
        from donateur
        where id_donateur not in (select id_donateur where pseudo =?) 
        and (pseudo =? or email=?)");

        $req->execute(array($_SESSION['pseudo'], $_POST['pseudo'], $_POST['Email']));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        if ($resultat[0]['nb'] > 0) {
            echo "<script>
window.location.href = 'MonProfile.php';
alert('Le mail et / ou pseudo est utiliser dans autre inscription');
</script>";
        } else {
            if (strlen($_POST['ancien_mot_de_passe']) == 0) {
                //appliquer les mise a jour sauf le pwrd
                $req2 = $conn->prepare("update donateur
                set nom = ? ,
                    prenom = ? ,
                    email = ? ,
                    pseudo= ? 
                    where pseudo=?");
                $req2->execute(array($_POST['Nom'], $_POST['Prenom'], $_POST['Email'], $_POST['pseudo'], $_SESSION['pseudo']));
                $_SESSION['pseudo'] = $_POST['pseudo'];
                echo "<script>
window.location.href = 'MonProfile.php';
alert('modification avec succes');
</script>";
            } else {
                //verifier que l ancien pwrd est correcte 
                $req3 = $conn->prepare("select * from donateur where pseudo=? and pwrd=?");
                $req3->execute(array($_SESSION['pseudo'], $_POST['ancien_mot_de_passe']));
                $resultat2 = $req3->fetchAll(PDO::FETCH_ASSOC);
                if (count($resultat2) == 0) {
                    echo "<script>
window.location.href = 'MonProfile.php';
alert('mot de passe incorecte');
</script>";
                } else {
                    $req4 = $conn->prepare("update donateur
                set nom =?,
                    prenom =?,
                    email =?,
                    pseudo=?,
                    pwrd=?
                    where pseudo=?");
                    $req4->execute(array($_POST['Nom'], $_POST['Prenom'], $_POST['Email'], $_POST['pseudo'], $_POST['nouveau_mot_de_passe'], $_SESSION['pseudo']));
                    $_SESSION['pseudo'] = $_POST['pseudo'];
                    echo "<script>
window.location.href = 'MonProfile.php';
alert('modification avec succes');
</script>";
                }
            }
        }
    }
    else{
        
        
        if($_FILES['logo']['error'] == UPLOAD_ERR_OK){
            $logoData=file_get_contents($_FILES['logo']['tmp_name']);
        }
        else{
            $logoData=$_SESSION['logo'];
        }

      

        $req = $conn->prepare("select count(*) as nb 
        from responsable_association 
        where id_responsable not in (select id_responsable where pseudo =?) 
        and (pseudo =? or email=?)");

        $req->execute(array($_SESSION['pseudo'], $_POST['pseudo'], $_POST['Email']));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        if ($resultat[0]['nb'] > 0) {
            echo "<script>
window.location.href = 'MonProfile.php';
alert('Le mail et / ou pseudo est utiliser dans autre inscription');
</script>";
        } else {
            if (strlen($_POST['ancien_mot_de_passe']) == 0) {
                //appliquer les mise a jour sauf le pwrd
                $req2 = $conn->prepare("update responsable_association
                set nom = ? ,
                    prenom = ? ,
                    email = ? ,
                    pseudo= ?,
                    nom_association=?,
                    adresse_association=?,
                    matricule_fiscale=?,
                    logo=?
                    where pseudo=?");
                $req2->execute(array($_POST['Nom'], $_POST['Prenom'], $_POST['Email'], $_POST['pseudo'],$_POST['nom_association'],$_POST['adresse'],$_POST['matricule_fiscale'],$logoData, $_SESSION['pseudo']));
                $_SESSION['pseudo'] = $_POST['pseudo'];
                echo "<script>
window.location.href = 'MonProfile.php';
alert('modification avec succes');
</script>";
            } else {
                //verifier que l ancien pwrd est correcte 
                $req3 = $conn->prepare("select * from responsable_association where pseudo=? and pwrd=?");
                $req3->execute(array($_SESSION['pseudo'], $_POST['ancien_mot_de_passe']));
                $resultat2 = $req3->fetchAll(PDO::FETCH_ASSOC);
                if (count($resultat2) == 0) {
                    echo "<script>
window.location.href = 'MonProfile.php';
alert('mot de passe incorecte');
</script>";
                } else {
                    $req4 = $conn->prepare("update responsable_association
                set nom = ? ,
                    prenom = ? ,
                    email = ? ,
                    pseudo= ?,
                    pwrd=?,
                    nom_association=?,
                    adresse_association=?,
                    matricule_fiscale=?,
                    logo=? 
                    where pseudo=?");
                    $req4->execute(array($_POST['Nom'], $_POST['Prenom'], $_POST['Email'], $_POST['pseudo'], $_POST['nouveau_mot_de_passe'],$_POST['nom_association'],$_POST['adresse'],$_POST['matricule_fiscale'],$logoData, $_SESSION['pseudo']));
                    $_SESSION['pseudo'] = $_POST['pseudo'];
                    echo "<script>
window.location.href = 'MonProfile.php';
alert('modification avec succes');
</script>";
                }
            }
        }

    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
