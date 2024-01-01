<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'postgres');
define('DB_PASS', 'admin');
define('DB_NAME', 'hotel_management');

// Establish database connection.
try {
    $dbh = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to PostgreSQL successfully!";
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>