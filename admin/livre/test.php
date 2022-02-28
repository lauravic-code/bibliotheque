<?php

include '../config/config.php';
include '../config/bdd.php';

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
        var_dump($categories);
        die;
    
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
    
    
        if ($requete->execute($data)) {
            $_SESSION['error_update_livre'] = false;
            header('location:index.php');
            die();

             $sql='DELETE categorie.id FROM categorie_livre WHERE id= :id';

        $requete=$bdd->prepare($sql);
        $data=[
            ':id' => $id
        ];
        $requete->execute($data);
        
        } else {
            $_SESSION['error_update_livre'] = true;
            header('location:update.php');
            die();
        }
    }
    