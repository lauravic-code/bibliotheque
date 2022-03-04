<?php

include '../config/config.php';

if(!isConnect()){
    header('location:'.URL_ADMIN.'login.php');
}

include '../config/bdd.php';

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ajouter un usager</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">


</head>

<bodyid="page-top">
    <div id="wrapper">
 <!-- INCLUDE SIDEBAR -->  <?php include PATH_ADMIN . "includes/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
<!-- INCLUDE TOPBAR --> <?php include PATH_ADMIN . "includes/topbar.php"; ?>
 
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Créer un usager</h1>
                    </div>

                    <form action="action.php" method="POST">

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" name="nom" class="form-control" id="nom">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom :</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" >
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse :</label>
                        <input type="text" name="adresse" class="form-control" id="adresse" >
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville :</label>
                        <input type="text" name="ville" class="form-control" id="ville" >
                    </div>
                    <div class="mb-3">
                        <label for="code_postale" class="form-label">Code postale :</label>
                        <input type="number" name="code_postale" class="form-control" id="code_postale" >
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mail :</label>
                        <input type="mail" name="mail" class="form-control" id="mail" >
                    </div>
                   
                        <div  class="d-flex">
                        <div class="mb-3  mr-3">
                                <input type="submit" name="btn_add_usager" class=" btn btn-primary" value="Ajouter"></input>
                            </div>
                        <div class="mb-3">
                            <a href="<?= URL_ADMIN."usager/index.php"?>" class="btn btn-warning">Annuler</a>
                        </div>
                        </div>

                    </form>
                </div>

            </div>
            
<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php"; ?>>




</body>