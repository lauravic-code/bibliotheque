<?php 

if(isset($_POST['btn_connect'])){
    include "config/config.php";
    include "config/bdd.php";

    $mail= htmlentities($_POST['mail']);
    $mdp=htmlentities($_POST['mdp']);

    $sql="SELECT * FROM utilisateur WHERE mail=?";
    $requete = $bdd->prepare($sql);
    $requete->execute([$mail]);

    $user=$requete->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        $_SESSION['connect']=false;
        header('location:login.php');
        die;
    }

    if(!password_verify($mdp,$user['mot_de_passe'])){
        $_SESSION['connect']=false;
        header('location:login.php');
        die;
    }
  
    
    unset($user['mdp']);

    $_SESSION['user']=$user;
    $_SESSION['date_connect'] = new DateTime();  
    checkroles($user['id'],$bdd);
    $_SESSION['connect']=true;
    
 
    header('location:index.php');
    die;
    
}


if(isset($_GET['connect']) && $_GET['connect']=="false"){

    $_SESSION=[];
 
    header('location: ../index.php');
    die;
}


