<?php 

include '../config/config.php';
include '../config/bdd.php';

// *************************************************** ADD UTILISATEUR****************************************************

if(isset($_POST['btn_add_utilisateur'])){

    $nom =htmlentities($_POST['nom']);
    $prenom =htmlentities($_POST['prenom']);
    $pseudo = htmlentities($_POST['pseudo']);
    $mail = htmlentities($_POST['mail']);
    $mot_de_passe= password_hash($mot_de_passe,PASSWORD_DEFAULT);
    $num_telephone = htmlentities($_POST['num_telephone']);
    $avatar =htmlentities($_FILES['avatar']['name']);
    $dossier_temp= $_FILES["avatar"]["tmp_name"];
    $dossier_destination=PATH_ADMIN."img/avatars/".$avatar;
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);
    
    if(!move_uploaded_file($dossier_temp,$dossier_destination)){
        echo alert("danger",'l\'image n\'a pas été téléchargée');
        echo ('pas bon');
    }
    
    $sql = "INSERT INTO utilisateur VALUES (NULL, :nom, :prenom, :pseudo, :mail, :mot_de_passe, :num_telephone, :avatar, :adresse, :ville, :code_postal)";
    
    $requete = $bdd->prepare($sql);

    $data = array(
    
            ':nom' => $nom, 
            ':prenom' => $prenom, 
            ':pseudo' => $pseudo, 
            ':mail' => $mail,
            ':mot_de_passe' => $mot_de_passe,
            ':num_telephone' => $num_telephone,
            ':avatar' => $avatar,
            ':adresse' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
        );    

        if( $requete->execute($data)){
            $_SESSION['error_add_utilisateur'] =false;
            header('location:'. URL_ADMIN . 'utilisateur/index.php');
            die();
        }else{
            $_SESSION['error_add_utilisateur'] = true;
            header('location:'. URL_ADMIN . 'utilisateur/add.php');
            die();
        }
}
// *************************************************** UPDATE UTILISATEUR****************************************************

if(isset($_POST['btn_update_utilisateur'])){  
    if(empty($_FILES['avatar']['name'])){

        $id= intval($_POST['id']);
        $nom =htmlentities($_POST['nom']);
        $prenom =htmlentities($_POST['prenom']);
        $pseudo = htmlentities($_POST['pseudo']);
        $mail = htmlentities($_POST['mail']);
        $num_telephone = htmlentities($_POST['num_telephone']);
        $adresse = htmlentities($_POST['adresse']);
        $ville = htmlentities($_POST['ville']);
        $code_postal = htmlentities($_POST['code_postal']);
    
        $sql= "UPDATE utilisateur SET id= :id, nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, num_telephone = :num_telephone, adresse= :adresse, ville= :ville, code_postal= :code_postal  WHERE id= :id";
        $requete = $bdd->prepare($sql);
        
        $data= [
            ':id' => $id,
            ':nom'=> $nom,
            ':prenom'=> $prenom,
            ':pseudo'=> $pseudo,
            ':mail'=> $mail,
            ':num_telephone'=> $num_telephone,
            ':adresse'=> $adresse,
            ':ville'=> $ville,
            ':code_postal'=>$code_postal
        ];
    
     
        if( $requete->execute($data)){
            $_SESSION['error_update_utilisateur']=false;
            header('location:' . URL_ADMIN . 'utilisateur/index.php');
            die();
        }else{
    
            $_SESSION['error_update_utilisateur']=true;
            header('location:' . URL_ADMIN . 'utilisateur/update.php');
            die();
        }
    }else{

    $id= intval($_POST['id']);
    $nom =htmlentities($_POST['nom']);
    $prenom =htmlentities($_POST['prenom']);
    $pseudo = htmlentities($_POST['pseudo']);
    $mail = htmlentities($_POST['mail']);
    $num_telephone = htmlentities($_POST['num_telephone']);
    $avatar=htmlentities($_FILES['avatar']['name']);
    $dossier_temp= $_FILES["avatar"]["tmp_name"];
    $dossier_destination=PATH_ADMIN."img/avatars/".$avatar;
    $adresse = htmlentities($_POST['adresse']);
    $ville = htmlentities($_POST['ville']);
    $code_postal = htmlentities($_POST['code_postal']);

    if(!move_uploaded_file($dossier_temp,$dossier_destination)){
        $_SESSION['erreur_modif_image']=true;
    }

    $sql= "UPDATE utilisateur SET id= :id, nom = :nom, prenom = :prenom, pseudo = :pseudo, mail = :mail, num_telephone = :num_telephone, avatar = :avatar, adresse= :adresse, ville= :ville, code_postal= :code_postal  WHERE id= :id";
    $requete = $bdd->prepare($sql);
    
    $data= [
        ':id' => $id,
        ':nom'=> $nom,
        ':prenom'=> $prenom,
        ':pseudo'=> $pseudo,
        ':mail'=> $mail,
        ':num_telephone'=> $num_telephone,
        ':avatar' => $avatar,
        ':adresse'=> $adresse,
        ':ville'=> $ville,
        ':code_postal'=>$code_postal
    ];
 
    if( $requete->execute($data)){
        $_SESSION['error_update_utilisateur']=false;
        header('location:' . URL_ADMIN . 'utilisateur/index.php');
        die();
    }else{

        $_SESSION['error_update_utilisateur']=true;
        header('location:' . URL_ADMIN . 'utilisateur/update.php');
        die();
    }
    }
}

// *************************************************** DELETE UTILISATEUR****************************************************

if(isset($_GET["id"])){

    $id=intval($_GET["id"]);
    if($id>0){

        $sql='SELECT avatar FROM utilisateur WHERE id=?';
        $requete=$bdd->prepare($sql);
        $requete->execute([$id]);

        $hold_avatar=$requete->fetch(PDO::FETCH_ASSOC);
        $hold_avatar=PATH_ADMIN.'img/avatar/'.$hold_avatar;

        if(!file($hold_avatar)){
            $_SESSION['error_supp_avatar']=true;
            header('location:index.php');
            die;
        }

        if(!unlink($hold_avatar)){
            $_SESSION['error_supp_avatar']=true;
            header('location:index.php');
            die;
        }

        $sql= "DELETE FROM utilisateur WHERE id=:id";
        $requete=$bdd->prepare($sql);

        $data=array(
            ":id"=> $id
        );

        if($requete->execute($data)){
            $_SESSION['error_supp_utilisateur']=false;
            header('location:' . URL_ADMIN . 'utilisateur/index.php');
            die();
        }else{
            $_SESSION['error_supp_utilisateur']=true;
            header('location:' . URL_ADMIN . 'utilisateur/index.php');
            die();
        }
    }
}

