<?php include "../config/config.php";
include "../config/bdd.php";

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}

$sql = 'SELECT location.id, location.id_livre, location.id_usager, livre.titre, usager.nom, usager.prenom, location.date_debut, location.date_fin, etat.libelle, location.statut
FROM location
INNER JOIN livre                
ON location.id_livre = livre.id
INNER JOIN usager
ON location.id_usager= usager.id
INNER JOIN etat
ON location.etat_debut=etat.id';

$requete = $bdd->query($sql);
$locations = $requete->fetchALL(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste locations</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo URL_ADMIN ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" class="overflow-scroll">
    <div id="wrapper">

        <!-- INCLUDE SIDEBAR --> <?php include PATH_ADMIN . "includes/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- INCLUDE TOPBAR --> <?php include PATH_ADMIN . "includes/topbar.php"; ?>

                <!-- ********************************* TITRE DE LA PAGE ******************************************************
 ************************************* ET BTN AJOUTER UN LIVRE****************************************************** -->

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Liste des locations</h1>
                        <div class="mb-3 text-center">
                            <a href="<?php echo URL_ADMIN . "location/add.php" ?>" name="btn_add_location" class=" btn btn-success">Ajouter une location</a>
                        </div>

                    </div>

                </div>

                <?php

                // ********************************AFFICHAGE DES SESSIONS******************************************************
                // *************************************************************************************************************

                if (isset($_SESSION['erreur_add_location']) && $_SESSION['erreur_add_location'] == false) {
                    echo alert('success', 'La location a bien été ajoutée');
                    unset($_SESSION['erreur_add_location']);
                }else if (isset($_SESSION['erreur_add_location']) && $_SESSION['erreur_add_location'] == true){
                    echo alert('danger', 'La location n\'a pas été créée');
                    unset($_SESSION['erreur_add_location']);
                }

                if(isset($_SESSION['erreur_clore_location']) && $_SESSION['erreur_clore_location']==true){
                    echo alert('danger','La location n\'a pas été close');
                    unset($_SESSION['erreur_clore_location']);
                }else if(isset($_SESSION['erreur_clore_location']) && $_SESSION['erreur_clore_location']==false){
                    echo alert('success', 'La location a bien été archivée');
                    unset($_SESSION['erreur_clore_location']);
                }

                // *********************************AFFICHAGE LISTE DES LOCATIONS******************************************************
                // *************************************************************************************************************

                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Numéro de la location</th>
                            <th scope="col">Titre du livre</th>
                            <th scope="col">Usager</th>
                            <th scope="col">Etat du début</th>
                            <th scope="col">Etat de fin</th>
                            <th scope="col">Date de début</th>
                            <th scope="col">Date de fin</th>
                            <th scope="col" class='colonne_btn'></th>
                            <th scope="col" class='colonne_btn'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($locations as $location) : ?>
                            <!-- statut 1 = location en cours => disponibilite livre= 0-->
                            <?php if ($location['statut'] == 1) : ?>
                                <tr>
                                    <th><?= $location['id'] ?></th>
                                    <td><a href="<?= URL_ADMIN . 'livre/single.php?id=' . $location['id_livre'] ?>"><?= $location['titre'] ?></a></td>
                                    <td><a href="<?= URL_ADMIN . 'usager/single.php?id=' . $location['id_usager'] ?>"><?= $location['nom'] . ' ' . $location['prenom'] ?></a></td>
                                    <td><?= $location['libelle'] ?></td>
                                    <td class='font-italic'>En attente</td>
                                    <td><?= $location['date_debut'] ?></td>
                                    <td class='font-italic'>En attente</td>
                                    <td><a href="<?= URL_ADMIN . 'location/single.php?id=' . $location['id'] ?>" class="btn btn-primary">Voir</a></td>
                                    <td><a href="<?= URL_ADMIN . 'location/update.php?id=' . $location['id'] ?>" class="btn btn-warning">Clore</a></td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>

                    </tbody>
                </table>

                <!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php"; ?>

</body>

</html>