<?php

opcache_reset();
echo "OPcache cleared!";


session_start();

header("Location:  sources/welcome_page.php");
exit(); 

?>