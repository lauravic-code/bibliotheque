<?php

include '../config/config.php';

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
}

include '../config/bdd.php';

$sql = "SELECT usager.nom, usager.prenom, usager.id FROM usager";
$requete = $bdd->query($sql);
$usagers = $requete->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT livre.titre, livre.num_ISBN, livre.id FROM livre WHERE disponibilite = 1";
$requete = $bdd->query($sql);
$livres = $requete->fetchAll(PDO::FETCH_ASSOC);

// var_dump($usagers);
// var_dump($livres);
// die;
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ajouter une location</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Custom styles for this template-->
    <link href="<?php echo URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">


</head>

<bodyid="page-top">
    <div id="wrapper">
        <!-- INCLUDE SIDEBAR --> <?php include PATH_ADMIN . "includes/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- INCLUDE TOPBAR --> <?php include PATH_ADMIN . "includes/topbar.php"; ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Créer une location</h1>
                    </div>

                    <form action="action.php" method="POST">

                        <div class="mb-3">
                            <select for ="usager" class="usager-select" name="usager" id="usager-select">
                                <option value="">Choisir un usager</option>
                                <?php foreach ($usagers as $usager) : ?>
                                    <option value="<?= $usager['id'] ?>"><?= $usager['nom']." ".$usager['prenom'] ?></option>
                                <?php endforeach ?>
                            </select>

                            <select for="livre" class="livre-select" name="livre" id="livre-select">
                                <option value="">Choisir un livre</option>
                                <?php foreach ($livres as $livre) : ?>
                                    <option value="<?= $livre['id'] ?>"><?= $livre['titre'] ?></option>
                                <?php endforeach ?>
                            </select>
                
                        
                        </div>

                        <div class="d-flex">
                            <div class="mb-3  mr-3">
                                <input type="submit" name="btn_add_location" class=" btn btn-primary" value="Ajouter"></input>
                            </div>
                            <div class="mb-3">
                                <a href="<?= URL_ADMIN . "/index.php" ?>" class="btn btn-warning">Annuler</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

            <!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php"; ?>>

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $('.usager').select2();
                $('.livre').select2();
            </script>




            </body>