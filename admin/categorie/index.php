<?php

include "../config/config.php";
include "../config/bdd.php";

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}


$sql = "SELECT * from categorie ";
$requete = $bdd->query($sql);
$categories = $requete->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste des categories</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
    
  <!-- INCLUDE SIDEBAR --> <?php include PATH_ADMIN . "includes/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

<!-- INCLUDE TOPBAR --> <?php include PATH_ADMIN . "includes/topbar.php"; ?>

 <!-- ********************************* TITRE DE LA PAGE ******************************************************
 ************************************* ET BTN AJOUTER UN CATEGORIE****************************************************** -->
               
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Liste des categories</h1>
                        <div class="mb-3 text-center">
                            <a href="<?php echo URL_ADMIN . "categorie/add.php" ?>" name="btn_add_categorie" class=" btn btn-success">Ajouter un categorie</a>
                        </div>
                    </div>

                </div>

                <?php

// ********************************AFFICHAGE DES SESSIONS******************************************************
// *************************************************************************************************************
                if (isset($_SESSION['error_update_categorie']) && $_SESSION['error_update_categorie'] == false) {
                    echo alert('success', 'Le categorie est bien modifiée !');
                    unset($_SESSION['error_update_categorie']);
                }

                if (isset($_SESSION['error_add_categorie']) && $_SESSION['error_add_categorie'] == false) {
                    echo alert('success', 'Le categorie est bien ajoutée !');
                    unset($_SESSION['error_add_categorie']);
                }

                ?>

<!-- *********************************AFFICHAGE LISTE DES CATEGORIES******************************************************
     ************************************************************************************************************* -->
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">libellé</th>
                            <th scope="col" class="colonne_btn"></th>
                            <th scope="col" class="colonne_btn"></th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($categories as $categorie) : ?>
                            <tr>
                                <th scope="row"><?= $categorie["id"] ?></th>
                                <td><?= $categorie["libelle"] ?>
                                </td>
 
                                <td><a href="<?= URL_ADMIN ?>categorie/single.php?id=<?= $categorie["id"] ?>" class="btn btn-primary">Voir</a></td>
                                <td><a href="<?= URL_ADMIN ?>categorie/update.php?id=<?= $categorie["id"] ?>" class="btn btn-warning">Modifier</a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
   
<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php";?>
            
            

</body>
</html>