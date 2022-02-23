<?php include "../config/config.php";
include "../config/bdd.php";

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}

$sql = "SELECT utilisateur.id AS id_utilisateur, utilisateur.nom, utilisateur.prenom, utilisateur.pseudo, utilisateur.mail, utilisateur.num_telephone, utilisateur.avatar, utilisateur.adresse, utilisateur.ville, utilisateur.code_postal, role.libelle FROM role_utilisateur INNER JOIN role ON role_utilisateur.id_role=role.id INNER JOIN utilisateur ON role_utilisateur.id_utilisateur=utilisateur.id";
$requete = $bdd->query($sql);

$utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste utilisateurs</title>

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

                <div class="container-fluid">

<!-- ************************************** TITRE DE LA PAGE ******************************************************
 ************************************* ET BTN AJOUTER UN UTILSATEUR****************************************************** -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Liste utilisateurs</h1>
                        <div class="mb-3 text-center">
                            <a href="<?php echo URL_ADMIN . "utilisateur/add.php" ?>" name="btn_add_livre" class=" btn btn-success">Ajouter un utilisateur</a>
                        </div>
                    </div>
                </div>



            </div>

            <?php
// ****************************************AFFICHAGE DES SESSIONS******************************************************
// *************************************************************************************************************
           
            if (isset($_SESSION['error_update_utilisateur']) && $_SESSION['error_update_utilisateur'] == false) {
                echo alert('success', 'L\'utilisateur est bien modifié !');
                unset($_SESSION['error_update_utilisateur']);
            }

            if (isset($_SESSION['error_add_utilisateur']) && $_SESSION['error_add_utilisateur'] == false) {
                echo alert('success', 'L\'utilisateur est bien ajouté !');
                unset($_SESSION['error_add_utilisateur']);
            }

            if (isset($_SESSION['erreur_supp_utilisateur']) && $_SESSION['erreur_supp_utilisateur'] == false) {
                echo alert('success', 'L\'utilisateur a bien été supprimé!');
                unset($_SESSION['erreur_supp_utilisateur']);
            }

            if (isset($_SESSION['erreur_supp_utilisateur']) && $_SESSION['erreur_supp_utilisateur'] == true) {
                echo alert('success', 'ATTENTION! L\'utilisateur n\'a pas été supprimé!');
                unset($_SESSION['erreur_supp_utilisateur']);
            }

            if (isset($_SESSION['erreur_modif_image']) && $_SESSION['erreur_modif_image'] == true) {
                echo alert('danger', 'ATTENTION! L\'image n\'a pas été modifiée!');
                unset($_SESSION['erreur_modif_image']);
            }
            
            if(isset($_SESSION['error_supp_avatar']) && $_SESSION['error_supp_avatar']==true)
                echo alert('danger','l\avatar n\'a pas pu être supprimer');
            ?>

  <!-- *********************************AFFICHAGE LISTE DES LIVRES******************************************************
     ************************************************************************************************************* -->          
            <table class="table table-light ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Ville</th>
                        <th scope="col">Code postale</th>
                        <th scope="col">Role</th>
                        <th scope="col" class="colonne_btn"></th>
                        <th scope="col" class="colonne_btn"></th>
                        <th scope="col" class="colonne_btn"></th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($utilisateurs as $utilisateur) : ?>
                        <tr>
                            <th scope="row"><?= $utilisateur["id_utilisateur"] ?></th>
                            <td class=""><?= $utilisateur["nom"] ?></td>
                            <td class=""><?= $utilisateur["prenom"] ?></td>
                            <td class=""><?= $utilisateur["pseudo"] ?></td>
                            <td class=""><?= $utilisateur["mail"] ?></td>
                            <td class=""><?= $utilisateur["num_telephone"] ?></td>
                            <td class=""><img witdh="50px" height="70px" src="<?= URL_ADMIN . "img/avatars/" . $utilisateur["avatar"] ?>"></td>
                            <td class=""><?= $utilisateur["adresse"] ?></td>
                            <td class=""><?= $utilisateur["ville"] ?></td>
                            <td class=""><?= $utilisateur["code_postal"] ?> </td>
                            <td class=""><?= $utilisateur["libelle"] ?> </td>
                            <td class=""><a href="<?= URL_ADMIN ?>utilisateur/single.php?id=<?= $utilisateur["id_utilisateur"] ?>" class="btn btn-primary">Voir</a></td>
                            <td class=""><a href="<?= URL_ADMIN ?>utilisateur/update.php?id=<?= $utilisateur["id_utilisateur"] ?>" class="btn btn-warning">Modifier</a></td>
                            <td class=""><a href="<?= URL_ADMIN ?>utilisateur/action.php?id=<?= $utilisateur["id_utilisateur"] ?>" class="btn btn-danger">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php"; ?>

</body>
</html>