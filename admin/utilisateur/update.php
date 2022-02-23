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
        $sql = "SELECT * FROM utilisateur WHERE id= :id";
        $requete = $bdd->prepare($sql);
        $data = [':id' => $id];
        $requete->execute($data);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
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

    <title>Modification utilisateur</title>

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
 
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Modifier un utilisateur</h1>
                    </div>
                </div>

                <form class="" action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $utilisateur['id'] ?>">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" name="nom" class="form-control" id="nom" value="<?php echo $utilisateur['nom'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom :</label>
                        <input type="text" name="prenom" class="form-control" id="prenom" value="<?php echo $utilisateur['prenom'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo :</label>
                        <input type="text" name="pseudo" class="form-control" id="pseudo" value="<?php echo $utilisateur['pseudo'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mail :</label>
                        <input type="mail" name="mail" class="form-control" id="mail" value="<?php echo $utilisateur['mail'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="num_telephone" class="form-label">Téléphone :</label>
                        <input type="num_telephone" name="num_telephone" class="form-control" id="num_telephone" value="<?php echo $utilisateur['num_telephone'] ?>">
                    </div>
                   
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar :</label>
                        <input type="file" name="avatar" class="form-control" id="avatar" ><img src="<?=URL_ADMIN."img/avatars/".$utilisateur["avatar"]?>">
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse :</label>
                        <input type="text" name="adresse" class="form-control" id="adresse" value="<?php echo $utilisateur['adresse'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="ville" class="form-label">Ville :</label>
                        <input type="text" name="ville" class="form-control" id="ville" value="<?php echo $utilisateur['ville'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="code_postal" class="form-label">Code_postal :</label>
                        <input type="text" name="code_postal" class="form-control" id="code_postal" value="<?php echo $utilisateur['code_postal'] ?>">
                    </div>
                
                    <div class="d-flex">
                    <div class="mb-3  mr-3">
                            <input type="submit" name="btn_update_utilisateur" class=" btn btn-primary" value="Modifier">
                        </div>
                        <div class="mb-3">
                            <a href="<?=URL_ADMIN."utilisateur/index.php" ?>" class="btn btn-warning">Annuler</a>
                        </div>
                    </div>

                </form>

            </div>

<!-- INCLUDE FOOTER --> <?php  include PATH_ADMIN . "includes/footer.php";?>

</body>
</html>