<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('America/New_York');

//database credentials
try {
    //create PDO connection
    // $db = new PDO("mysql:host='.DBHOST.';port=3306;dbname='.DBNAME, DBUSER, DBPASS.'");
    $db = new PDO('mysql:host=0.0.0.0;dbname=yii1db', 'root', 'P2ssw0$d');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "adasd";
    //show error
    echo '<p>'.$e->getMessage().'</p>';
    exit;
}