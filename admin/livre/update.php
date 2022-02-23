<?php


include "../config/config.php";

if(!isConnect()){
    header('location:' .URL_ADMIN .'login.php' );
    die;
}

include "../config/bdd.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $sql = "SELECT * FROM livre WHERE id= :id";
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];
        $requete->execute($data);
        $livre = $requete->fetch(PDO::FETCH_ASSOC);
    } else {
        header('location:index.php');
    }
} else {
    header('location:index.php');
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modification livre</title>

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

<!-- INCLUDE TOPBAR -->  <?php include PATH_ADMIN . "includes/topbar.php"; ?>
                
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Modifier un livre</h1>
                    </div>
                </div>

                <form class="" action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $livre['id'] ?>">
                    <div class="mb-3">
                        <label for="num_ISBN" class="form-label">num_ISBN :</label>
                        <input type="number" name="num_ISBN" class="form-control" id="num_ISBN" value="<?php echo $livre['num_ISBN'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" name="titre" class="form-control" id="titre" value="<?php echo $livre['titre'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="illustration" class="form-label">Illustration :</label>
                        <input type="file" name="illustration" class="form-control" id="illustration" value="<?php echo $livre['illustration'] ?>"><img src="<?=URL_ADMIN."img/cover/".$livre["illustration"]?>>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé :</label>
                        <textarea name="resume" class="form-control" id="resume" rows="3"><?php echo $livre['resume'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix :</label>
                        <input type="number" name="prix" class="form-control" id="prix" value="<?php echo $livre['prix'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nb_pages" class="form-label">Nombre de pages :</label>
                        <input type="text" name="nb_pages" class="form-control" id="nb_pages" value="<?php echo $livre['nb_pages'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="date_achat" class="form-label">Date d'achat :</label>
                        <input type="text" name="date_achat" class="form-control" id="date_achat" value="<?php $date = date_create($livre["date_achat"]);
                                                                                                            echo $date->format("d-m-Y"); ?>"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="disponibilite" class="form-label">Disponibilité :</label>
                        <input name="disponibilite" class="form-control" id="disponibilite" rows="3" value="<?php echo $livre["disponibilite"] ?>"></textarea>
                    </div>
                    <div class="d-flex">
                        <div class="mb-3  mr-3">
                            <input type="submit" name="btn_update_livre" class=" btn btn-primary" value="Modifier">
                        </div>
                        <div class="mb-3">
                            <a href="<?= URL_ADMIN . "livre/index.php" ?>" class="btn btn-warning">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>
 
<!-- INCLUDE FOOTER --> <?php  include PATH_ADMIN . "includes/footer.php";?>
            
</body>
</html>