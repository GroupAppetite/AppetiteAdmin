<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Appetite</title>
        <style>
            .prenotazione{
                margin: 5px;
                border: 1px solid black;
            }
        </style>
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
            require_once('./private/DBClass.php');
            if($_GET["mode"]=="prenotazioni"){
                include("mode/prenotazioni.php");
            } else {
                include("formRistorante.php");
            }
        ?>
    </body>
</html>