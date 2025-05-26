<?php
session_start();
$_SESSION['role']=null;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
</head>

<body>

    <form action="login.php" method="post" class="choix_inscri">
    
        <h3>S'Authentifier</h3>


        <div>
            <input type="text" id="choix" name="choix" value="" hidden>
            <div id="donateur" class="choix donateur">
                <img src="donateur.png" alt="donateur.png" class="img donateur">
                <p class="">Donateur</p>
            </div>

            <div id="responsable" class="choix responsable">
                <img src="responsable.png" alt="responsable.png" class="img responsable">
                <p>Responsable</p>
            </div>

        </div>

    </form>




</body>
<script src="login_choix.js?v=<?php echo time();?>" >    
</script>

</html>