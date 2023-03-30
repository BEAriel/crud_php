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
        } 
    }else{
        $_SESSION['erreur'] = "URL invalide";
        header('location: index.php');      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Détails du produit</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails du produit <?=$produit['produit']?></h1>
                <p>ID: <?=$produit['id']?></p>
                <p>Produit : <?=$produit['produit']?></p>
                <p>Prix: <?=$produit['prix']?></p>
                <p>Nombre: <?=$produit['nombre']?></p>
                <p><a href="index.php">Retour à l'acceuil</a><a href="edit.php?id=<?=$produit['id']?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>