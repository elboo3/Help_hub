<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
session_start();
extract($_POST);

print_r($_SESSION);
include("connexion.php");

$req = $conn->prepare("DELETE FROM projet WHERE id_projet=?;");
$req->execute(array($_SESSION['id_projet']));


echo "<script>alert('Le projet a été supprimé avec succès');</script>";
echo "<script>
    let form = document.createElement('form');
form.method = 'POST';
form.action = 'dashboard_responsable.php'; // Your target PHP file

// Create hidden input for IdProjet
let input = document.createElement('input');
input.type = 'hidden';
input.name = 'id_projet';
input.value =". $_SESSION['id_projet']."; // Replace with your actual data-id value

form.appendChild(input);
document.body.appendChild(form);
form.submit();
</script>";
?>
