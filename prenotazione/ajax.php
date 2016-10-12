<?php

$server = "fdb13.biz.nf";
$user   = "2194486_pren";
$pass   = "IlDatabaseForte1";
$db     = "2194486_pren";

try{

    // Connecting to the database
    $conn = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $response = array();

    // Handling the supported actions:

    

            
            $conn = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           

            $id = (int)$_GET["lastid"];
            
            $result = $conn->prepare("SELECT * FROM prenotazione WHERE numero > :v");
            $result->bindParam(":v", $id, PDO::PARAM_INT);
            $result->execute();


            $chats = array();
            $results = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value) {
                $chats[] = $value;
            }

        $response = array('chats' => $chats);



    echo json_encode($response);
}catch (PDOException $e) {
    echo $sql."<br>".$e->getMessage();
}
catch(Exception $e){
    die(json_encode(array('error' => $e->getMessage())));
}


?>