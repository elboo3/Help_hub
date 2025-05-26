<?php

session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #4e73df;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        /* Title animation: fade in + scale up slightly */
        h1 {
            color: white;
            text-align: center;
            font-family: 'Arial', sans-serif;
            font-size: 2.5em;
            animation: fadeScale 2s ease-in-out forwards;
        }
        
        /* Image animation: fade in + slide from top */
        img {
            animation: fadeSlide 2s ease-out forwards;
            width: 300px;
            height: 300px;
            display: block;
            border-radius: 50%;    
            margin-bottom: 20px;
        }
        
        /* Animation keyframes */
        @keyframes fadeScale {
            0% {
                opacity: 0;
                transform: scale(0.1);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes fadeSlide {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        
        }
        #loading {
            width: 100px;
            height: 100px;
            animation: rotate 1s infinite linear; 
        }

        h3{
            color: white;
            text-align: center;
            font-family: 'Arial', sans-serif;
            font-size: 1.5em;
            
        }
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            50% {
                transform: rotate(180deg);
            }
            75% {
                transform: rotate(270deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }



    </style>
    <script>
        
        setTimeout(function() {
            window.location.href = "login_choix.php"; 
        }, 4000); 
    </script>
</head>
<body>
    
    <h1>Bienvenue au Help Hub</h1>
    <img src="logo_website.png">

    <img src="loading.png" alt="" id="loading">
    <h3>Chargement...</h3>

    
</body>
</html>