<?php

// data source name
$dsn = "mysql:host=db;dbname=NoteApp;charset=utf8mb4";
$user = "notesuser";
$pass = "notespassword";

// connection
try{
    // start a new connection with PDO
    $db = new PDO($dsn, $user, $pass);
    // set attribute
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    // error message if failed to connect to database
    die('Connection Failed: '. $e->getMessage());
}

?>