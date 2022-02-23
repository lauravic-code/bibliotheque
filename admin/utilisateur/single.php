<?php
include "../config/config.php";

if (!isConnect()) {
    header('location:login.php');
    die;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    include "../config/bdd.php";
    $sql = "SELECT * FROM utilisateur WHERE id=:id";

    $requete = $bdd->prepare($sql);
    $data = [":id" => $id];

    $requete->execute($data);
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
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

    <title>Utilisateur</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo URL_ADMIN ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        
<!-- iNCLUDE SIDEBAR --><?php include PATH_ADMIN . "includes/sidebar.php"; ?>

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
               
<!-- INCLUDE TOPBAR --> <?php include PATH_ADMIN . "includes/topbar.php" ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $utilisateur['nom']." ".$utilisateur['prenom'] ?></h1>
                    </div>
                </div>

                <div id="card_single">
                    <div class="img_single">
                        <img class="card-img-top w-25"!important src="<?= URL_ADMIN ."img/avatars/".$utilisateur["avatar"] ?>" alt="<?= $utilisateur["avatar"] ?>" >
                    </div>

                    <div class="card-body">
                        <p class="card-text">Adresse mail : <?= $utilisateur['mail'] ?></p>
                        <p class="card-text">Numéro de téléphone : <?= $utilisateur['num_telephone'] ?></p>
                    </div>
                </div>

                <div class="mb-3 text-center">
                            <a href="<?php echo URL_ADMIN."utilisateur/index.php" ?>" name="btn_retour_index" class=" btn btn-primary">Retour</a>
                        </div>
            </div>

<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN."includes/footer.php";?>            

</body>
</html>