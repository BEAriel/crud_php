<?php
    //demarrer une session
    session_start();
    //recuperer les données du formulaire
    
    if($_POST){
        if(isset($_POST['produit']) && !empty($_POST['produit'])
        && isset($_POST['prix']) && !empty($_POST['prix'])
        && isset($_POST['nombre']) && !empty($_POST['nombre'])
        ){
            require_once('connect.php'); //connexion à la base de donnée
            //on netoie les données envoyée
            $produit = strip_tags($_POST['produit']); // supprime tous les scripts
            $prix = strip_tags($_POST['prix']);
            $nombre = strip_tags($_POST['nombre']);
            $sql = "INSERT INTO `liste` (`produit`,`prix`,`nombre`) VALUES(:produit, :prix, :nombre);";
            $query = $db->prepare($sql);
            $query->bindValue(':produit', $produit, PDO::PARAM_STR);
            $query->bindValue(':prix', $prix, PDO::PARAM_STR);
            $query->bindValue(':nombre', $nombre, PDO::PARAM_INT);
            $query->execute();
            $_SESSION['message'] = "Produit ajouté";
            require_once('close.php'); //ferme la connexion avec la base de données
            header('location: index.php');  
        }
        else{
            $_SESSION["erreur"] = "Le formulaire est imcomplet";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ajouter un produit</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Ajouter un produit</h1>
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['erreur'].'</div>';
                        $_SESSION["erreur"] = "";
                    }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label for="produit">Produit</label>
                        <input type="text" id="produit" name="produit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="number" id="nombre" name="nombre" class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>