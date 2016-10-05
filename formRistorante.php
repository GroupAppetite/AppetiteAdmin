<?php

    if(isset($_POST["completed"])){
            $server = "fdb13.biz.nf";
            $user   = "2194486_pren";
            $pass   = "IlDatabaseForte1";
            $db     = "2194486_pren";
            
            try{
                $conn = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->prepare("Insert into ristorante(citta, nome_r, descrizione, indirizzo,"
                        . "fascia_prezzo) Values (:c,:n,:d,:i,:f)");
                $stmt->bindParam(":c", $_POST["citta"]);
                $stmt->bindParam(":n", $_POST["nome_r"]);
                $stmt->bindParam(":d", $_POST["desc"]);
                $stmt->bindParam(":i", $_POST["ind"]);
                $stmt->bindParam(":f", $_POST["f_p"]);
                $stmt->execute();
                
            } catch (PDOException $e) {
                echo $sql."<br>".$e->getMessage();
            }
            
            $conn = null;
            include("success_input.php");
        } else {
            include("form.php");
        }
?>

