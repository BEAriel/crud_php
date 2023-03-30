<?php
    //demarrer une session
    session_start();
    require_once('connect.php'); //connexion à la base de donnée
    $sql = 'SELECT * FROM `liste`';
    $query = $db->prepare($sql); //prepare la requete
    $query->execute(); //execute la requete
    $result = $query->fetchAll(PDO::FETCH_ASSOC); //recupere les data pas en double
    //var_dump($result); //affiche le contenu des variables
    require_once('close.php'); //ferme la connexion avec la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Liste des produits</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['erreur'].'</div>';
                        $_SESSION["erreur"] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>';
                        $_SESSION["message"] = "";
                    }
                ?>
                <h1>LISTE DES PRODUITS</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>PRODUIT</th>
                        <th>PRIX</th>
                        <th>NOMBRE</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php
                            //on boucle sur la variable result
                            foreach ($result as $produit) {
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?= $produit['produit'] ?></td>
                                <td><?= $produit['prix'] ?> Fcfa</td>
                                <td><?= $produit['nombre'] ?></td>
                                <td><a href="details.php?id=<?=$produit['id']?>" >Voir</a> <a href="edit.php?id=<?=$produit['id']?>">Modifier</a> <a href="delete.php?id=<?=$produit['id']?>">Supprimer</a> </td>
                            </tr>
                        <?php   
                            }
                        ?>   
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>
</body>
</html>