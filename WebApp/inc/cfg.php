<?php 
    /*
           
            [BlackFox's Team] On Hajj Hackathon Event
        Abdullah - Abdulrahman - Saleh - Joudi - Mahmoud
        
    */
    $dsn = 'mysql:host=localhost;dbname=hajj';
    $username = 'root';
    $password = '';
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); # UTF8

    $con = new PDO($dsn, $username, $password, $options);


?>
