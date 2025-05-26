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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<?php 

include('header.php'); 
include("nav.php");

?>

    <div class="remerciment">
        
        <div><img src="mercii.png" alt="remerciment"></div>
        <p>Un grand merci pour votre contribution ! Grâce à votre soutien, nos projets prennent vie et ont un réel impact. Ensemble, construisons un avenir meilleur !</p>
        <button class="btn btn-danger" id="retour2"><i class="bi bi-x-lg"></i></button>
    </div>

    <?php 

include('footer.php'); 


?>
    <script src="controleDonation.js?v=<?php echo time(); ?>"></script>
</body>
</html>