<?php
try {
    $pdo = new PDO('mysql:host=mysql;dbname=symfony', 'symfony', 'symfony');
    echo 'Conexión exitosa!';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
