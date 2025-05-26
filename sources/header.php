
<?php



$url = basename($_SERVER['PHP_SELF']);

$ch = "";
if (isset($_SESSION['role']) && $_SESSION['role'] === 'responsable') {

    $ch = ' 
<header>
        <div></div>
        <div class="user">
        <p>' . $_SESSION['pseudo'] . '</p>
            <div><img src="profile_img.png" alt=""></div>
        </div>
    </header>';
}
else {
    $ch = '
     <header>
    <form class="input-group" method="post" action="resultat_recherche.php">
            <input type="text" class="form-control" placeholder="Search for..." name="search">
            <button class="btn btn-primary">
                <i class="fas fa-search text-white"></i>
            </button>
        </form>

        <div class="user">
            <p>'.$_SESSION['pseudo'].'</p>
            <div><img src="profile_img.png" alt=""></div>
        </div>
    </header>';
}

echo $ch;
?>
