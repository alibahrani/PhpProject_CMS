<?php 
    define("DB_SERVER", "localhost");
    define("DB_USER", "alibahrani");
    define("DB_pass", "password");
    define("DB_name", "online_order");
//1.Create a database connection
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_pass, DB_name);
    //Test if connection occurred 
    if(mysqli_connect_errno()){
        die("Database connection failed: " . mysqli_connect_error() . "(". mysqli_connect_errno() . ")");
    }
    

?>