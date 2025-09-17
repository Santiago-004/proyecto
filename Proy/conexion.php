<?php
    try {
        $conn = new PDO('mysql:host=localhost;dbname=sghmac;port=3306', 'root', 'Torres18');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
?>