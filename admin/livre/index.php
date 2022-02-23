<?php

include "../config/config.php";
include "../config/bdd.php";

if (!isConnect()) {
    header('location:' . URL_ADMIN . 'login.php');
    die;
}


$sql = "SELECT livre.id AS id_livre, categorie.id AS id_categorie, livre.num_ISBN, livre.titre, livre.illustration, livre.resume, livre.prix, livre.nb_pages, livre.date_achat, livre.disponibilite, categorie.libelle FROM categorie_livre INNER JOIN livre ON categorie_livre.id_livre=livre.id INNER JOIN categorie ON categorie_livre.id_categorie=categorie.id";
$requete = $bdd->query($sql);
$livres = $requete->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Liste des livres</title>

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

 <!-- ********************************* TITRE DE LA PAGE ******************************************************
 ************************************* ET BTN AJOUTER UN LIVRE****************************************************** -->
               
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Liste des livres</h1>
                        <div class="mb-3 text-center">
                            <a href="<?php echo URL_ADMIN . "livre/add.php" ?>" name="btn_add_livre" class=" btn btn-success">Ajouter un livre</a>
                        </div>
                    </div>

                </div>

                <?php

// ********************************AFFICHAGE DES SESSIONS******************************************************
// *************************************************************************************************************
                if (isset($_SESSION['error_update_livre']) && $_SESSION['error_update_livre'] == false) {
                    echo alert('success', 'Le livre est bien modifié !');
                    unset($_SESSION['error_update_livre']);
                }

                if (isset($_SESSION['error_add_livre']) && $_SESSION['error_add_livre'] == false) {
                    echo alert('success', 'Le livre est bien ajouté !');
                    unset($_SESSION['error_add_livre']);
                }

                if (isset($_SESSION['erreur_supp_livre']) && $_SESSION['erreur_supp_livre'] == false) {
                    echo alert('success', 'le livre a bien été supprimé!');
                    unset($_SESSION['erreur_supp_livre']);
                }

                if (isset($_SESSION['erreur_supp_livre']) && $_SESSION['erreur_supp_livre'] == true) {
                    echo alert('success', 'ATTENTION! le livre n\'a pas été supprimé!');
                    unset($_SESSION['erreur_supp_livre']);
                }

                if(isset($_SESSION['erreur_supp_cover']) && $_SESSION['erreur_supp_cover']==true){
                    echo alert('danger', 'la couverture du livre n\'a pas été supprimée');
                    unset($SESSION['erreur_supp_cover']);
                }


                ?>

<!-- *********************************AFFICHAGE LISTE DES LIVRES******************************************************
     ************************************************************************************************************* -->
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Num ISBN</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Illustration</th>
                            <th scope="col">Résumé</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Nb de pages</th>
                            <th scope="col">Date d'achat</th>
                            <th scope="col">Disponibilité</th>
                            <th scope="col" class="colonne_btn"></th>
                            <th scope="col" class="colonne_btn"></th>
                            <th scope="col" class="colonne_btn"></th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($livres as $livre) : 

                            // var_dump($livre);
                            // die;
                            $sql='SELECT libelle 
                            FROM categorie_livre
                            INNER JOIN categorie
                            ON id_categorie=categorie.id
                            WHERE id_livre= ?';

                            $requete=$bdd->prepare($sql);
                            $id_livre=$livre["id_livre"];
                            $requete->execute ([$id_livre]);
                            $cat=$requete->fetchAll(PDO::FETCH_NUM);
                            
                            // var_dpump($cat);

                            if(!empty($cat)){
                                if(count($cat)>1){
                                    foreach($cat as $libelle_cat){
                                    $list_cat[]= implode('',$libelle_cat);
                                }
                                    // var_dump(implode('',$cat[0]));
                                }else{
                                    $list_cat[]=implode('',$cat[0]);
                                }
                            }else{
                                $list_cat='non categorisé';
                            }

                            ?>

                            
                            <tr>
                                <th scope="row"><?= $livre["id_livre"] ?></th>
                                <td><?= $livre["num_ISBN"] ?>
                                </td>
                                <td><?= $livre["titre"] ?>
                                </td>
                                <td><img witdh="50px" height="70px" src="<?= URL_ADMIN . "img/cover/" . $livre["illustration"] ?>">
                                </td>
                                <td><?= substr($livre["resume"], 0, 50) ?> [...]
                                </td>
                                <td><?= implode("<br>", $list_cat)
                                ?>
                                </td>
                                <td><?= $livre["prix"] ?> €
                                </td>
                                <td><?= $livre["nb_pages"] ?>
                                </td>
                                <td><?php $date = date_create($livre["date_achat"]);
                                    echo $date->format("d/m/Y"); ?>
                                </td>
                                <td><?= $livre["disponibilite"] ?>
                                </td>
                                <td><a href="<?= URL_ADMIN ?>livre/single.php?id=<?= $livre["id_livre"] ?>" class="btn btn-primary">Voir</a></td>
                                <td><a href="<?= URL_ADMIN ?>livre/update.php?id=<?= $livre["id_livre"] ?>" class="btn btn-warning">Modifier</a></td>
                                <td><a href="<?= URL_ADMIN ?>livre/action.php?id=<?= $livre["id_livre"] ?>" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                            <?php $list_cat=[]?>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
   
<!-- INCLUDE FOOTER --> <?php include PATH_ADMIN . "includes/footer.php";?>
            
            

</body>
</html>