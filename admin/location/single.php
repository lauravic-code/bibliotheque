<?php

include '../config/config.php';
include '../config/bdd.php';

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
}
if (isset($_GET['id'])) {

    $id_loc = intval($_GET['id']);

    if ($id_loc <= 0) {
        header('location:' . URL_ADMIN . 'location/index.php');
    }

    $sql = 'SELECT location.id AS id_location, location.id_livre as id_livre, location.id_usager as id_usager, livre.num_ISBN, livre.titre, livre.illustration, usager.nom, usager.prenom, usager.mail, location.date_debut, location.date_fin, etat.libelle, location.statut, location.etat_retour
    FROM location
    INNER JOIN livre                
    ON location.id_livre = livre.id
    INNER JOIN usager
    ON location.id_usager= usager.id
    INNER JOIN etat
    ON location.etat_debut=etat.id
    WHERE location.id = ?';

    $requete = $bdd->prepare($sql);
    if (!$requete->execute([$id_loc])) {
        header('location:' . URL_ADMIN . 'location/index.php');
    }

    $location = $requete->fetch(PDO::FETCH_ASSOC);

    $sql='SELECT libelle
    FROM etat
    INNER JOIN locations
    ON location.etat_retour=etat.id_livre
    WHERE location.id=?';

    $requete=$bdd->prepare($sql);
    $requete->execute([$id_loc]);

    $sql='SELECT libelle
    FROM etat
    INNER JOIN location
    ON location.etat_retour=etat.id
    WHERE location.id=?';

    $requete=$bdd->prepare($sql);
    $requete->execute([$id_loc]);
    $etat_retour=$requete->fetch(PDO::FETCH_ASSOC);

    // var_dump($etat_retour);
    // die;


    // définition du statut
    if ($location['statut'] == 0) {
        $statut = 'Terminée';
    } else {
        $statut = 'En cours';
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Location <?= $location['titre'] ?></title>

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

                <!-- ********************************* TITRE DE LA PAGE ******************************************************-->

                <div class="container-fluid">

                    <div class="mb-3 align-items-center justify-content-between mb-4">
                        
                        <div class="location">
                            <h1 class="h3 mb-0 text-gray-800">Location n° : <?= $id_loc ?></h1>
                            <p>Statut location : <?= $statut ?></p>
                        </div>

                        <div class="livre">
                            <h2>INFO LIVRE</h2>
                            <p>TITRE : <a href="<?=URL_ADMIN."livre/single.php?id=".$location['id_livre'] ?>"><?=$location['titre'] ?></a></p>
                            <p>Numéro ISBN : <?= $location['num_ISBN'] ?></p>
                            <img alt="<?= $location['titre'] ?>" src="<?= URL_ADMIN . 'img/cover/' . $location['illustration'] ?>">
                        </div>
                            <?php if($location['statut']==0):?>
                                <p>Etat du début: <?= $location['libelle'] ?></p>
                                <p>Etat de retour: <?= $etat_retour['libelle'] ?></p>
                            <?php endif ?>

                        <div class="usager">
                            <h2>INFO USAGER</h2>
                            <p>Nom de l'usager : <a href="<?= URL_ADMIN.'usager/single.php?id='.$location['id_usager']?>"><?= $location['nom'] . " " . $location['prenom'] ?></a></p>
                            <p>Adresse mail : <?= $location['mail'] ?></p>
                        </div>
                        <div class="bouton_retour">
                            <a class="btn btn-primary" href="<?= URL_ADMIN.'location/index.php' ?>">Retour</a>
                            <a class="btn btn-warning" href="<?= URL_ADMIN.'location/update.php?id='.$id_loc?>">Clore</a>
                        </div>




<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN."includes/footer.php";?>            

</body>
</html>