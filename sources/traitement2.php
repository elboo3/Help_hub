<?php
session_start();

extract($_POST);
$_SESSION['pseudo'] = $pseudo;
$_SESSION['pwrd'] = $mot_de_passe;



try {
    
    include('connexion.php');

    if ($_SESSION['role'] == 'donateur') {
        $req = $conn->prepare("select pwrd from donateur where pseudo =?");
        $req->execute(array($pseudo));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $req = $conn->prepare("select pwrd from responsable_association where pseudo =?");
        $req->execute(array($pseudo));
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    }



    if (empty($resultat)) {
        echo "<script>
        alert('pas d inscription existe ');
        window.location.href = 'login.php';
       
    </script>";
    } else {
        if ($resultat[0]['pwrd'] == $mot_de_passe and $_SESSION['role'] == 'donateur') {
            echo "<script>
        window.location.href = 'dashboard_donateur.php';
        </script>";
        } elseif ($resultat[0]['pwrd'] == $mot_de_passe and $_SESSION['role'] == 'responsable') {
            echo "<script>
        window.location.href = 'dashboard_responsable.php';
        </script>";
        } else {
            echo "<script>
            window.location.href = 'login.php';
        alert('mot de passe incorrecte');
        </script>";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
