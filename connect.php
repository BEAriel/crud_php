<?php
    try {
        //connexion à la base
        $db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');
        //$db->exec('SET NAME "UTF8"'); interaction en UTF8
    } catch (PDOException $e) {
        echo "Erreur : ". $e->getMessage(); // obtient le message d'erreur
        die(); // empêche l'execution de la suite du code (break en js)
    }
?>