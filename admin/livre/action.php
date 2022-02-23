<?php

include '../config/config.php';
include '../config/bdd.php';

// *************************************************** ADD LIVRE ****************************************************


if (isset($_POST['btn_add_livre'])) {

    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $illustration = htmlentities($_FILES['illustration']['name']);
    $resum = htmlentities($_POST['resume']);
    $prix = htmlentities($_POST['prix']);
    $nb_page = htmlentities($_POST['nb_page']);
    $date_achat = htmlentities($_POST['date_achat']);
    $disponibilite = htmlentities($_POST['disponibilite']);
    $dossier_temp = $_FILES["illustration"]["tmp_name"];
    $dossier_destination = PATH_ADMIN . "img/cover/" . $illustration;

    if (!move_uploaded_file($dossier_temp, $dossier_destination)) {
        echo alert("danger", 'l\'image n\'a pas été téléchargée');
        echo ('pas bon');
    }

    $sql = "INSERT INTO livre VALUES (NULL, :num_ISBN, :titre, :illustration, :resum, :prix, :nb_page, :date_achat, :disponibilite)";

    $requete = $bdd->prepare($sql);
    $data = array(
        ':num_ISBN' => $num_ISBN,
        ':titre' => $titre,
        ':illustration' => $illustration,
        ':resum' => $resum,
        ':prix' => $prix,
        ':nb_page' => $nb_page,
        ':date_achat' => $date_achat,
        ':disponibilite' => $disponibilite,
    );

    if ($requete->execute($data)) {
        $_SESSION['error_add_livre'] = false;
        header('location:update.php');
        die();
    } 

        $id_livre = $bdd->lastInsertId();
        foreach($_POST['categorie'] as $id_categorie){
           $sql='INSERT INTO categorie_livre VALUES (:id_categorie, :id_livre)';
           $requete=$bdd->prepare($sql);

           $data=[
               'id_categorie' => $id_categorie,
               'id_livre' => $id_categorie
           ];

           if(!$requete->execute($data)){
               echo 'petit pb là';
           }
        }
        $_SESSION['error_add_livre'] = true;
        header('location:index.php');
        die();
}
// *************************************************** UPDATE LIVRE ****************************************************

if (isset($_POST['btn_update_livre'])) {

    if (empty($_FILES['illustration']['name'])) {
    
        $id = intval($_POST['id']);
        $num_ISBN = htmlentities($_POST['num_ISBN']);
        $titre = htmlentities($_POST['titre']);
        $resum = htmlentities($_POST['resume']);
        $prix = htmlentities($_POST['prix']);
        $nb_pages = htmlentities($_POST['nb_pages']);
        $date = date_create($_POST['date_achat']);
        $date_achat = $date->format("Y-m-d");
        $disponibilite = htmlentities($_POST['disponibilite']);
      

        $sql = "UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, resume = :resum, prix = :prix, nb_pages=:nb_pages, date_achat =:date_achat, disponibilite = :disponibilite WHERE id= :id";

        $requete = $bdd->prepare($sql);
        $data = [
            ':id' => $id,
            ':num_ISBN' => $num_ISBN,
            ':titre' => $titre,
            ':resum' => $resum,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':disponibilite' => $disponibilite
        ];


        if ($requete->execute($data)) {
            $_SESSION['error_update_livre'] = false;
            header('location:index.php');
            die();
        } else {
            $_SESSION['error_update_livre'] = true;
            header('location:update.php');
            die();
        }
    } else {
      
        $id = intval($_POST['id']);
        $num_ISBN = htmlentities($_POST['num_ISBN']);
        $titre = htmlentities($_POST['titre']);
        $illustration = htmlentities($_FILES['illustration']['name']);
        $resum = htmlentities($_POST['resume']);
        $prix = htmlentities($_POST['prix']);
        $nb_pages = htmlentities($_POST['nb_pages']);
        $date = date_create($_POST['date_achat']);
        $date_achat = $date->format("Y-m-d");
        $disponibilite = htmlentities($_POST['disponibilite']);
        $dossier_temp = $_FILES["illustration"]["tmp_name"];
        $dossier_destination = PATH_ADMIN . "img/cover/" . $illustration;
    
        if (!move_uploaded_file($dossier_temp, $dossier_destination)) {
            echo alert("danger", 'l\'image n\'a pas été téléchargée');
            die;
        }

        $sql = "UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, illustration = :illustration, resume = :resum, prix = :prix, nb_pages=:nb_pages, date_achat =:date_achat, disponibilite = :disponibilite WHERE id= :id";

        $requete = $bdd->prepare($sql);
        $data = [
            ':id' => $id,
            ':num_ISBN' => $num_ISBN,
            ':titre' => $titre,
            ':illustration' => $illustration,
            ':resum' => $resum,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':disponibilite' => $disponibilite
        ];


        if ($requete->execute($data)) {
            $_SESSION['error_update_livre'] = false;
            header('location:index.php');
            die();
        } else {
            $_SESSION['error_update_livre'] = true;
            header('location:update.php');
            die();
        }
    }
}

// *************************************************** DELETE LIVRE ****************************************************

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    if ($id > 0) {

        $sql = 'SELECT illustration FROM livre WHERE id= ?';
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);

        $hold_illustration = $requete->fetch(PDO::FETCH_ASSOC);
        $hold_illustration = $hold_illustration['illustration'];

        $dossier_illustration = PATH_ADMIN . "img/cover/" . $hold_illustration;

        if (!file($dossier_illustration)) {
            echo ('file');
            die;
            $SESSION['erreur_file_cover'] = true;
            header('location:index.php');
            die;
        }

        if (!unlink($dossier_illustration)) {
            echo ('unlink');
            die;
            $SESSION['erreur_unlik_cover'] = true;
            header('location:index.php');
            die;
        }


        $sql = "DELETE FROM livre WHERE id=:id";
        $requete = $bdd->prepare($sql);

        $data = array(
            ":id" => $id
        );

        if ($requete->execute($data)) {
            $_SESSION['erreur_supp_livre'] = false;
            header('location:index.php');
            die;
        } else {
            $_SESSION['erreur_supp_livre'] = true;
            header('location:index.php');
            die;
        }
    }
}
