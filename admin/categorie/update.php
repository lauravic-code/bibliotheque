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
        $sql = "SELECT * FROM categorie WHERE id= :id";
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];
        $requete->execute($data);
        $categorie = $requete->fetch(PDO::FETCH_ASSOC);
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

    <title>Modification categorie</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Modifier un categorie</h1>
                    </div>
                </div>

                <form class="" action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $categorie['id'] ?>">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libellé :</label>
                        <input type="text" name="libelle" class="form-control" id="libelle" value="<?php echo $categorie['libelle'] ?>">
                    </div>
                        <div class="mb-3  mr-3">
                            <input type="submit" name="btn_update_categorie" class=" btn btn-primary" value="Modifier">
                        </div>
                        <div class="mb-3">
                            <a href="<?= URL_ADMIN . "categorie/index.php" ?>" class="btn btn-warning">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>
 
<!-- INCLUDE FOOTER --> <?php  include PATH_ADMIN . "includes/footer.php";?>
            
</body>
</html>