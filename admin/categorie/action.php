<?php 

include '../config/config.php';
include '../config/bdd.php';

// *************************************************** ADD CATEGORIE ****************************************************


if(isset($_POST['btn_add_categorie'])){

    $libelle =htmlentities($_POST['libelle']);


    $sql = "INSERT INTO categorie VALUES (NULL, :libelle)";

    $requete = $bdd->prepare($sql);
        $data = array(
            ':libelle' => $libelle);    

        if( !$requete->execute($data)){ 
            $_SESSION['error_add_categorie'] = true;
            header('location:index.php');
            die();
           
        }

        // enregistrement de ACTION-UTILISATEUR

        $id_categorie=$bdd->lastInsertId();
        

        $sql='SELECT id FROM action WHERE libelle="ajouter"';
        $requete=$bdd->query($sql);
    
        $id_action=$requete->fetch(PDO::FETCH_ASSOC);
        $id_action=implode($id_action);
    
        
        $sql='INSERT INTO utilisateur_action (id_utilisateur, id_action, id_categorie, date) VALUES(:id_utilisateur, :id_action, :id_categorie , NOW())';
        $requete=$bdd->prepare($sql);
        $data=[
            ':id_utilisateur'=> $_SESSION['user']['id'],
            ':id_action'=> $id_action,
            ':id_categorie'=> $id_categorie
        ];

        if( !$requete->execute($data)){ 
            $_SESSION['error_add_categorie'] = true;
            header('location:index.php');
            die();
        }
        
        $_SESSION['error_add_categorie'] = false;
            header('location:index.php');
            die();
}
// *************************************************** UPDATE CATEGORIE ****************************************************

if(isset($_POST['btn_update_categorie'])){
    
    $id= intval($_POST['id']);
    $libelle =htmlentities($_POST['libelle']);
 

    $sql= "UPDATE categorie SET libelle = :libelle WHERE id= :id";

    $requete = $bdd->prepare($sql);
    $data= [
        ':id' => $id,
        ':libelle'=> $libelle,
    ];

 
    if( !$requete->execute($data)){
        $_SESSION['error_update_categorie']=true;
        header('location:update.php');
        die();
        
    }
    
    $sql='SELECT id FROM action WHERE libelle="modifier"';
    $requete=$bdd->query($sql);

    $id_action=$requete->fetch(PDO::FETCH_ASSOC);
    $id_action=implode($id_action);

    
    $sql='INSERT INTO utilisateur_action (id_utilisateur, id_action, id_categorie, date) VALUES(:id_utilisateur, :id_action, :id_categorie , NOW())';
    $requete=$bdd->prepare($sql);
    $data=[
        ':id_utilisateur'=> $_SESSION['user']['id'],
        ':id_action'=> $id_action,
        ':id_categorie'=>htmlentities($id)
    ];

    if( !$requete->execute($data)){ 
        $_SESSION['error_update_categorie'] = true;
        header('location:index.php');
        die();
    }
    $_SESSION['error_update_categorie']=false;
        header('location:index.php');
        die();


}

