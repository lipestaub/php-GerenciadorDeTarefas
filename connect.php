<?php
    try {
        $conn = new PDO('mysql:host=localhost;dbname=test', 'root', '');
    }
    catch (PDOException $e) {
        echo "Erro ao conectar: '" . $e->getMessage() . "'";
    }
?>