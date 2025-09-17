<?php
    try {
        $conn = new PDO('mysql:host=localhost;dbname=eurotechdb;port=3306', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Error in the conection: " . $e->getMessage());
    }
?>