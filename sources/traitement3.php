<?php

extract($_POST);

try{
    include("connexion.php");

    $req=$conn->prepare("select count(*) as nb from donateur where email =?");
    $req->execute(array($Email));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    if($resultat[0]["nb"]==0){
        echo "<script>
        window.location.href = 'mot_pass_oublier.php';
        alert('le mail que vous avez saisie ne correspond pas à un compte');
    </script>";
    }else{
        $req2=$conn->prepare("update donateur set pwrd=? where email=?");
        $req2->execute(array($mot_de_passe1,$Email));
        echo "<script>
        window.location.href = 'login.php';
        alert('Votre mot de passe à été changé avec succès');
    </script>";
    }


}catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
    }

?>