
<?php


$url = basename($_SERVER['PHP_SELF']);

$ch = "";

if (isset($_SESSION['role']) && $_SESSION['role'] == 'responsable') {

    $ch = ' <nav>
        
<div style="display: flex; justify-content: center; align-items: center; padding: 10px;  width: 100%; height:100px; ">
    <img src="logo_website.png" alt="Help Hub Logo" 
         style="width: 110px; height: 110px; border-radius: 100px; ">
</div>

        <ul class="nav flex-column">

            <li class="nav-item active">
                <a class="nav-link" href="dashboard_responsable.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="ajout_projet.php">
                    <i class="fas fa-user-circle"></i>
                    <span>Ajouter Un Project</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="MonProfile.php">
                    <i class="fas fa-user-circle"></i>
                    <span>Mon profile</span>
                </a>
            </li>


            <li class="nav-item active">
                <a class="nav-link" href="login.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>';
} else {
    $ch = '

    <nav>
<div style="display: flex; justify-content: center; align-items: center; padding: 10px;  width: 100%; height:100px; ">
    <img src="logo_website.png" alt="Help Hub Logo" 
         style="width: 110px; height: 110px; border-radius: 100px; ">
</div>

        <ul class="nav flex-column">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard_donateur.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        

        

            <li class="nav-item active">
                <a class="nav-link" href="ProjetDispo.php">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Projets</span>
                </a>
            </li>


            <li class="nav-item active">
                <a class="nav-link" href="MonProfile.php">
                    <i class="fas fa-user-circle"></i>
                    <span>Mon profile</span>
                </a>
            </li>


            <li class="nav-item active">
            <a class="nav-link" href="login.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>';
}
echo $ch;
?>
