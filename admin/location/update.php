<?php


include "../config/config.php";

if(!isConnect()){
    header('location:' .URL_ADMIN .'login.php' );
    die;
}

include "../config/bdd.php";

if(isset($_GET['id'])){

    $id_location=intval($_GET['id']);

    if($id_location<=0){
        header('location:index.php');
        die;
    }
    
    $sql='SELECT location.id, location.id_livre, location.id_usager, livre.titre, livre.illustration, usager.nom, usager.prenom, usager.mail, location.date_debut, location.date_fin, etat.libelle, location.statut, location.etat_retour
    FROM location
    INNER JOIN livre                
    ON location.id_livre = livre.id
    INNER JOIN usager
    ON location.id_usager= usager.id
    INNER JOIN etat
    ON location.etat_debut=etat.id
    WHERE location.id=?';

    $requete=$bdd->prepare($sql);
    if(!$requete->execute([$id_location])){
        header('location:'.URL_ADMIN.'location/index.php');
    };
    $location=$requete->fetch(PDO::FETCH_ASSOC);    

    // var_dump($location);
    // die;

    $sql='SELECT * FROM etat';
    $requete=$bdd->query($sql);
    $etats=$requete->fetchAll(PDO::FETCH_ASSOC);
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

    <title>Clore une location</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo URL_ADMIN ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                        <h1 class="h3 mb-0 text-gray-800">Modifier une location</h1>
                    </div>

                    <div class="usager">

                   
                        <h2>TITRE DU LIVRE</h2>
                        <p><a href="<?=URL_ADMIN.'livre/single.php?id='.$location['id_livre']?>"><?= $location['titre']?></a></p>
                        <img alt="<?=$location['illustration']?>" src="<?=URL_ADMIN.'img/cover/' . $location['illustration']?>">

                        <h2 class="my-3">USAGER</h2>
                        <div class="row mx-3">
                        <p>Nom : <a href="<?=URL_ADMIN.'usager/single.php?id='.$location['id_usager']?>"><?= $location['nom']." ".$location['prenom']?></a></p>
                        <p class="mx-3">Adresse mail : <?= $location['mail']?></p>
                    </div>
                    <h2>LOCATION</h2>
                    <p>Date de début : <?= $location['date_debut']?></p>
                <form action="action.php" method="POST">
                        <input type="hidden" name="id_livre" value="<?=$location['id_livre']?>">
                        <input type="hidden" name="id_loc" value="<?=$location['id']?>">
                    
                   
                        <p>Etat de début : <?=$location['libelle']?></p>
                    
                        <label for="etat_retour" name="etat_retour">Etat de fin :</label>
                        <select class="etat_retour" name="etat_retour">
                            <?php foreach($etats as $etat): ?>
                                <option value="<?= $etat['id']?>"><?= $etat['libelle']?></option>
                            <?php endforeach?>
                        </select>                        

                        <div class='bouton'>
                            <input type="submit" name="btn_clore_location" class='btn btn-success'value="Clore">
                            <a class='btn btn-warning' href="<?=URL_ADMIN.'location/index.php'?>">Annuler</a>
                        </div>
                     </form>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $('.etat_retour').select2();

            </script>

            <!-- INCLUDE FOOTER --> <?php include PATH_ADMIN."includes/footer.php";?>            

</body>
</html>