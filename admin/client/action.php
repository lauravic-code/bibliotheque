<?php 

include '../config/bdd.php';

if(isset($_POST['btn_contact_biblio']) || isset($_POST['btn_add_contact'])){
    $nom =htmlentities($_POST['nom']);
    $mail =htmlentities($_POST['mail']);
    $objet =htmlentities($_POST['objet']);
    $msg = htmlentities($_POST['msg']);

    $sql = "INSERT INTO contact VALUES (NULL, :nom, :mail, :objet, :msg, NOW())";

    var_dump($sql);
    $requete = $bdd->prepare($sql);
        $data = array(
            ':nom' => $nom, 
            ':mail' => $mail, 
            ':objet' => $objet, 
            ':msg' => $msg
        );    
        
        var_dump($requete);

        if( $requete->execute($data)){
            echo 'bonjour';
        }
   
}


?>