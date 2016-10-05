<?php

class DBClass{
    public function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once 
    
    try{

        // Try and connect to the database, if a connection has not been established yet

             // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('dbconfig.ini'); 
        
            $server = $config['servername'];
            $user   = $config['username'];
            $pass   = $config['password'];
            $db     = $config['dbname'];
        
            $connection = new PDO("mysql:host=$server;dbname=$db",$user,$pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$connection = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);

    } catch (PDOException $e) {
        echo $sql."<br>".$e->getMessage();
    }
    /*
        // If connection was not successful, handle the error
    if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error(); 
    }*/
    return $connection;
    
}


}


// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?> 
