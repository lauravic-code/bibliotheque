<?php

include '../config/config.php';
include '../config/bdd.php';

// *************************************************** ADD LIVRE ****************************************************
// *******************************************************************************************************************
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
               'id_livre' => $id_livre
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
// *******************************************************************************************************************

if (isset($_POST['btn_update_livre'])) {
    
    $id = intval($_POST['id']);
    if ($id <= 0) {
        // erreur
        header('location:index.php');
        die;
    }
    $num_ISBN = htmlentities($_POST['num_ISBN']);
    $titre = htmlentities($_POST['titre']);
    $resum = htmlentities($_POST['resume']);
    $prix = htmlentities($_POST['prix']);
    $nb_pages = htmlentities($_POST['nb_pages']);
    $date = date_create($_POST['date_achat']);
    $date_achat = $date->format("Y-m-d");
    $disponibilite = htmlentities($_POST['disponibilite']);
    $categories= $_POST['categorie'];
    $auteurs=$_POST['auteur'];

    if(!empty($_FILES['illustration']['name'])){
       
        $illustration = htmlentities($_FILES['illustration']['name']);
  
        $dossier_temp = $_FILES["illustration"]["tmp_name"];
        $dossier_destination = PATH_ADMIN . "img/cover/" . $illustration;

        if (!move_uploaded_file($dossier_temp, $dossier_destination)) {
            echo alert("danger", 'l\'image n\'a pas été téléchargée');
         die;
        }

        $sql = "UPDATE livre SET num_ISBN = :num_ISBN, titre = :titre, resume = :resum, prix = :prix, nb_pages=:nb_pages, date_achat =:date_achat, disponibilite = :disponibilite, illustration = :illustration WHERE id= :id";
        
        $requete = $bdd->prepare($sql);
        $data = [
            ':id' => $id,
            ':num_ISBN' => $num_ISBN,
            ':titre' => $titre,
            ':resum' => $resum,
            ':prix' => $prix,
            ':nb_pages' => $nb_pages,
            ':date_achat' => $date_achat,
            ':disponibilite' => $disponibilite,
            ':illustration' => $illustration
        ];

    }else{
    
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
            ':disponibilite' => $disponibilite,
        ];
    }


    if (!$requete->execute($data)) { 

        $_SESSION['error_update_livre'] = true;
        header('location:update.php');
        die();
      
    } 

        $_SESSION['error_update_livre'] = false;

        $sql= 'DELETE FROM categorie_livre WHERE id_livre = :id_livre ';
        $requete=$bdd->prepare($sql);

        $data=[':id_livre'=>$id];

        // var_dump($requete);
        // die;

        if(!$requete->execute($data)){
            echo 'marche pas';
            // erreur
            $requete->errorInfo();
            die;
            header('location: update.php?id='.$id);
        };

        // echo 'marche';
        // var_dump($requete);
        // die;
// var_dump($categories);
// die;

        foreach($categories as $id_categorie){
        // var_dump($categories);
        // die;
        // var_dump($id_categorie);
        $sql='INSERT INTO categorie_livre VALUES(:id_categorie, :id_livre)';
        $requete=$bdd->prepare($sql);
        $data=[
            ':id_categorie' => $id_categorie,
            ':id_livre' => $id
        ];
        // var_dump($id_categorie);
        // var_dump($id);
        // var_dump($data);
        // var_dump($requete);
        // die;
        if(!$requete->execute($data)){
            // erreur
            echo 'probleme';
            die;
            header('location:update.php?id='.$id);
        }
        }

        $sql= 'DELETE FROM auteur_livre WHERE id_livre = :id_livre ';
        $requete=$bdd->prepare($sql);

        $data=[':id_livre'=>$id];

        // var_dump($requete);
        // die;

        if(!$requete->execute($data)){
            echo 'marche pas';
            // erreur
            $requete->errorInfo();
            die;
            header('location: update.php?id='.$id);
        };

        foreach($auteurs as $id_auteur){
        // var_dump($categories);
        // var_dump($id_categorie);
        $sql='INSERT INTO auteur_livre VALUES(:id_auteur, :id_livre, NOW())';
        $requete=$bdd->prepare($sql);
        $data=[
            ':id_auteur' => $id_auteur,
            ':id_livre' => $id
        ];


        // var_dump($id_categorie);
        // var_dump($id);
        // var_dump($data);
        // var_dump($requete);
        // die;
        if(!$requete->execute($data)){
            // erreur
            echo 'probleme';
            die;
            header('location:update.php?id='.$id);
        };
        }



        header('location:index.php');
        die();
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

        $sql='DELETE FROM categorie_livre WHERE id_livre=:id';
        $requete=$bdd->prepare($sql);
        $data=[':id'=>$id];

        if(!$requete->execute($data)){
            var_dump($requete);
            die;
        };

        $sql='DELETE FROM auteur_livre WHERE id_livre=:id';
        $requete=$bdd->prepare($sql);
        $data=[':id'=>$id];

        $requete->execute($data);

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
