<?php

include '../config/config.php';
include '../config/bdd.php';

// *************************************************** ADD AUTEUR****************************************************

if (isset($_POST['btn_add_auteur'])) {

    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $nom_de_plume = htmlentities($_POST['nom_de_plume']);
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    $mail = htmlentities($_POST['mail']);
    $numero = htmlentities($_POST['numero']);
    $photo = htmlentities($_FILES['photo']['name']);
    $dossier_temp = $_FILES["photo"]["tmp_name"];
    $dossier_destination = PATH_ADMIN . "img/photo_auteur/" . $photo;

    if (!move_uploaded_file($dossier_temp, $dossier_destination)) {
        echo alert("danger", 'l\'image n\'a pas été téléchargée');
    }

    $sql = "INSERT INTO auteur VALUES (NULL, :nom, :prenom, :nom_de_plume, :adresse, :ville, :code_postal, :mail, :numero, :photo)";

    $requete = $bdd->prepare($sql);

    $data = array(

        ':nom' => $nom,
        ':prenom' => $prenom,
        ':nom_de_plume' => $nom_de_plume,
        ':adresse' => $adresse,
        ':ville' => $ville,
        ':code_postal' => $code_postal,
        ':mail' => $mail,
        ':numero' => $numero,
        ':photo' => $photo
    );

    if ($requete->execute($data)) {
        $_SESSION['error_add_auteur'] = false;
        header('location:' . URL_ADMIN . 'auteur/index.php');
        die();
    } else {
        $_SESSION['error_add_auteur'] = true;
        header('location:' . URL_ADMIN . 'auteur/add.php');
        die();
    }
}
// *************************************************** UPDATE AUTEUR****************************************************

if (isset($_POST['btn_update_auteur'])) {

    if (empty($_FILES['photo']['name'])) {

        $id= intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        // $photo = htmlentities($_FILES['photo']['name']);
        // $dossier_temp = $_FILES["photo"]["tmp_name"];
        // $dossier_destination = PATH_ADMIN . "img/photo_auteur/" . $photo;

        $sql = "UPDATE auteur SET nom = :nom, prenom = :prenom, nom_de_plume = :nom_de_plume, adresse= :adresse, ville= :ville, code_postal= :code_postal, mail = :mail, numero = :numero WHERE id= :id";
        $requete = $bdd->prepare($sql);

        $data = [
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':nom_de_plume' => $nom_de_plume,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
            ':mail' => $mail,
            ':numero' => $numero,
        ];

        if ($requete->execute($data)) {          
            $_SESSION['error_update_auteur'] = false;
            header('location:' . URL_ADMIN . 'auteur/index.php');
            die();
        }else {
            $_SESSION['error_update_auteur'] = true;
            header('location:' . URL_ADMIN . 'auteur/update.php');
            die();
        }
        die;
    } 
    
    else {

        $id= intval($_POST['id']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $nom_de_plume = htmlentities($_POST['nom_de_plume']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
        $mail = htmlentities($_POST['mail']);
        $numero = htmlentities($_POST['numero']);
        $photo = htmlentities($_FILES['photo']['name']);
        $dossier_temp = $_FILES["photo"]["tmp_name"];
        $dossier_destination = PATH_ADMIN . "img/photo_auteur/" . $photo;
        
        if (!move_uploaded_file($dossier_temp, $dossier_destination)) {
            echo alert("danger", 'l\'image n\'a pas été téléchargée');
        }

        $sql = "UPDATE auteur SET nom = :nom, prenom = :prenom, nom_de_plume = :nom_de_plume, adresse= :adresse, ville= :ville, code_postal= :code_postal, mail = :mail, numero = :numero, photo = :photo, WHERE id= :id";
        $requete = $bdd->prepare($sql);

        $data = [
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':nom_de_plume' => $nom_de_plume,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
            ':mail' => $mail,
            ':numero' => $numero,
            ':photo' => $photo
        ];


        if ($requete->execute($data)) {
            $_SESSION['error_update_auteur'] = false;
            header('location:' . URL_ADMIN . 'auteur/index.php');
            die();
        } else {

            $_SESSION['error_update_auteur'] = true;
            header('location:' . URL_ADMIN . 'auteur/update.php');
            die();
        }
    }
}

// *************************************************** DELETE AUTEUR****************************************************

if (isset($_GET["id"])) {

    $id = intval($_GET["id"]);
    if ($id > 0) {

        $sql = 'SELECT photo FROM auteur WHERE id=?';
        $requete = $bdd->prepare($sql);
        $requete->execute([$id]);

        $hold_photo = $requete->fetch(PDO::FETCH_ASSOC);
        $hold_photo = PATH_ADMIN . 'img/photo/' . $hold_photo;

        if (!file($hold_photo)) {
            $_SESSION['error_supp_photo'] = true;
            header('location:index.php');
            die;
        }

        if (!unlink($hold_photo)) {
            $_SESSION['error_supp_photo'] = true;
            header('location:index.php');
            die;
        }

        $sql = "DELETE FROM auteur WHERE id=:id";
        $requete = $bdd->prepare($sql);

        $data = array(
            ":id" => $id
        );

        if ($requete->execute($data)) {
            $_SESSION['error_supp_auteur'] = false;
            header('location:' . URL_ADMIN . 'auteur/index.php');
            die();
        } else {
            $_SESSION['error_supp_auteur'] = true;
            header('location:' . URL_ADMIN . 'auteur/index.php');
            die();
        }
    }
}
