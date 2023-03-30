<?php
    //demarrer une session
    session_start();

    if(isset($_GET['id']) && !empty($_GET['id'])){ //verifie si id passé dans l'url existe
        require_once('connect.php');

        //on netoie l'id envoyé
        $id = strip_tags($_GET['id']); // supprime tous les scripts
        $sql = "SELECT * FROM `liste` WHERE `id` = :id;";
        //prepare la requete
        $query = $db->prepare($sql);
        //accrocher les parametres 
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        //execute la requete
        $query->execute();
        //recupère les valeurs
        $produit = $query->fetch();   
        //on verifie si le produit existe
        if(!$produit){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('location: index.php');
            die();
        } 
        $sql = "DELETE FROM `liste` WHERE `id` = :id;";
        //prepare la requete
        $query = $db->prepare($sql);
        //accrocher les parametres 
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        //execute la requete
        $query->execute();
        //recupère les valeurs
        $produit = $query->fetch(); 
        $_SESSION['message'] = "Produit supprimé";
        header('location: index.php');  
    }else{
        $_SESSION['erreur'] = "URL invalide";
        header('location: index.php');      
    }
?>