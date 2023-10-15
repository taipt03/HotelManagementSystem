<?php 
    // DB credentials.
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','hbmsdb');
    // Establish database connection.
    try {
        $dbh = new PDO("mysql:host=localhost; port=3307; dbname=hbmsdb", "root", ""); // array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
?>