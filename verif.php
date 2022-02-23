<?php 
    session_start();

unset ($_SESSION['error']);
unset($_SESSION['alert']);

if(isset($_POST['btn_contact'])){

    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['tel']) && isset($_POST['msg'])){
        if(strlen($_POST['nom'])<=2){
            $_SESSION['error'][]='nom';
            $_SESSION['alert'][]="le champ nom doit comporter plus de 2 caractères. <br>";
            echo("pb de nom");
        }

        if(strlen($_POST['prenom'])<=2){
            $_SESSION['error'][]='prenom';
            $_SESSION['alert'][]="le champ prénom doit comporter plus de 2 caractères. <br>";
            echo("pb de prenom");
        }

        if(filter_var(($_POST["mail"]), FILTER_VALIDATE_EMAIL)){
            $_SESSION['ok'][]='mail';
        }
        else{
            $_SESSION['error'][]='mail';
            $_SESSION['alert'][]="le champ email nest pas valide. <br>";
            echo("pb de mail");
        }

        if(empty($_POST['msg'])){
            $_SESSION['error'][]='msg';
            $_SESSION['alert'][]='le champs message doit être renseigner. <br>';
            echo("pb de msg");
        }

        if(isset($_SESSION['error'])){
         header('location:contact.php');
        }
         else{
             header('location:resultat.php');
        }
}
  

}


    
  