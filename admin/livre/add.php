<?php
include "../config/config.php";
include "../config/bdd.php";

if (!isConnect()) {

    header('location:' . URL_ADMIN . 'login.php');
}

$sql = 'SELECT * FROM categorie';
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

    <title>Ajout de livre</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body id="page-top">
    <div id="wrapper">
        <!-- INCLUDE SIDEBAR --> <?php include PATH_ADMIN . "includes/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- INCLUDE TOPBAR --> <?php include PATH_ADMIN . "includes/topbar.php"; ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Ajouter un livre</h1>
                    </div>

                    <form action="action.php" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col_dte col-9">
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <label for="num_ISBN" class="form-label">num_ISBN :</label>
                                        <input type="number" name="num_ISBN" class="form-control" id="num_ISBN">
                                    </div>
                                    <div class="mb-3 col-9 ms-2">
                                        <label for="titre" class="form-label">Titre :</label>
                                        <input type="text" name="titre" class="form-control" id="titre">
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div class="mb-3">
                                        <div class="select_cat_block d-flex flex-column col-25">
                                            <label for="categorie[]" class="form-label">Catégorie :</label>
                                            <select class="select-cat" name="categorie[]" multiple id="cat">
                                                <?php foreach ($categories as $categorie) : ?>
                                                    <option value="<?= $categorie['id'] ?>"><?= $categorie['libelle'] ?> </option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>

                                        <div class="mb-3 col-10">
                                            <label for="nb_page" class="form-label">Nombre de pages :</label>
                                            <input type="number" name="nb_page" class="form-control" id="nb_page">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="resume" class="form-label">Résumé :</label>
                                    <textarea type="text" name="resume" class="form-control" id="resume" rows="10"></textarea>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <label for="prix" class="form-label">Prix :</label>
                                        <input type="number" name="prix" class="form-control" id="prix">
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="date_achat" class="form-label">Date d'achat :</label>
                                        <input type="date" name="date_achat" class="form-control" id="date_achat"></textarea>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="disponibilite" class="form-label">Disponibilité :</label>
                                        <input name="disponibilite" class="form-control" id="disponibilite" rows="3"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="illustration" class="form-label">Illustration :</label>
                                <input type="file" name="illustration" class="form-control" id="illustration">
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="mb-3  mr-3">
                                <input type="submit" name="btn_add_livre" class=" btn btn-primary" value="Ajouter"></input>
                            </div>
                            <div class="mb-3">
                                <a href="<?= URL_ADMIN . "livre/index.php" ?>" class="btn btn-warning">Annuler</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

            <!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php"; ?>

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $('.select-cat').select2();
            </script>

</body>

</html>