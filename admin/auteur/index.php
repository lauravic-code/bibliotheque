<?php

include "../config/config.php";
include "../config/bdd.php";

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}


$sql = "SELECT * from auteur ";
$requete = $bdd->query($sql);
$auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste des auteurs</title>

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
 ************************************* ET BTN AJOUTER UN AUTEUR****************************************************** -->
               
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Liste des auteurs</h1>
                        <div class="mb-3 text-center">
                            <a href="<?php echo URL_ADMIN . "auteur/add.php" ?>" name="btn_add_auteur" class=" btn btn-success">Ajouter un auteur</a>
                        </div>
                    </div>

                </div>

                <?php

// ********************************AFFICHAGE DES SESSIONS******************************************************
// *************************************************************************************************************
                if (isset($_SESSION['error_update_auteur']) && $_SESSION['error_update_auteur'] == false) {
                    echo alert('success', 'Le auteur est bien modifié !');
                    unset($_SESSION['error_update_auteur']);
                }

                if (isset($_SESSION['error_add_auteur']) && $_SESSION['error_add_auteur'] == false) {
                    echo alert('success', 'Le auteur est bien ajouté !');
                    unset($_SESSION['error_add_auteur']);
                }

                if (isset($_SESSION['erreur_supp_auteur']) && $_SESSION['erreur_supp_auteur'] == false) {
                    echo alert('success', 'le auteur a bien été supprimé!');
                    unset($_SESSION['erreur_supp_auteur']);
                }

                if (isset($_SESSION['erreur_supp_auteur']) && $_SESSION['erreur_supp_auteur'] == true) {
                    echo alert('success', 'ATTENTION! le auteur n\'a pas été supprimé!');
                    unset($_SESSION['erreur_supp_auteur']);
                }

                if(isset($SESSION['erreur_supp_cover']) && $SESSION['erreur_supp_cover']==true){
                    echo alert('danger', 'la couverture du auteur n\'a pas été supprimée');
                    unset($SESSION['erreur_supp_cover']);
                }


                ?>

<!-- *********************************AFFICHAGE LISTE DES AUTEURS******************************************************
     ************************************************************************************************************* -->
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Nom de plume</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">ville</th>
                            <th scope="col">Code postal</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Numéro de téléphone</th>
                            <th scope="col">Photo</th>
                            <th scope="col" class="colonne_btn"></th>
                            <th scope="col" class="colonne_btn"></th>
                            <th scope="col" class="colonne_btn"></th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($auteurs as $auteur) : ?>
                            <tr>
                                <th scope="row"><?= $auteur["id"] ?></th>
                                <td><?= $auteur["nom"] ?>
                                </td>
                                <td><?= $auteur["prenom"] ?>
                                </td>
                                <td><?= $auteur["nom_de_plume"] ?>
                                </td>
                                <td><?= $auteur["adresse"]?>
                                </td>
                                <td><?= $auteur["ville"] ?>
                                </td>
                                <td><?= $auteur["code_postal"] ?>
                                </td>
                                <td><?= $auteur["mail"] ?>
                                </td>
                                <td><?= $auteur["numero"] ?>
                                </td>
                                <td><img witdh="50px" height="70px" src="<?= URL_ADMIN . "img/photo_auteur/" . $auteur["photo"] ?>">
                                </td>

                                <td><a href="<?= URL_ADMIN ?>auteur/single.php?id=<?= $auteur["id"] ?>" class="btn btn-primary">Voir</a></td>
                                <td><a href="<?= URL_ADMIN ?>auteur/update.php?id=<?= $auteur["id"] ?>" class="btn btn-warning">Modifier</a></td>
                                <td><a href="<?= URL_ADMIN ?>auteur/action.php?id=<?= $auteur["id"] ?>" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
   
<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php";?>
            
            

</body>
</html>