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

        if( $requete->execute($data)){
            $_SESSION['error_add_categorie'] = false;
            header('location:update.php');
            die();
        }else{
            $_SESSION['error_add_categorie'] = true;
            header('location:index.php');
            die();
        }
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

 
    if( $requete->execute($data)){
        $_SESSION['error_update_categorie']=false;
        header('location:index.php');
        die();
    }else{
        $_SESSION['error_update_categorie']=true;
        header('location:update.php');
        die();
    }


}

