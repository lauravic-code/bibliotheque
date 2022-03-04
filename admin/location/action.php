<?php

include '../config/config.php';
include '../config/bdd.php';


// ******************************************ADD LOCATION***********************************************
// *****************************************************************************************************

if(isset($_POST['btn_add_location'])){
    // statut 1 = location en cours => disponibilite livre= 0

    $id_livre= intval($_POST['livre']);
    $id_usager= intval($_POST['usager']);
    $date_debut= htmlentities($_POST['date']);

            // CHANGEMENT DISPONIBILITE DU LIVRE ---------------------------------------------
    $disponibilite='0';

    $sql='UPDATE livre SET disponibilite = :disponibilite WHERE id=:id';
    $requete=$bdd->prepare($sql);     
    $data=[
        ':disponibilite'=> $disponibilite,
        ':id' => $id_livre
    ];
    $requete->execute($data);

            //INSERT INTO DE LA NOUVELLE OCCURENCE DANS LA TABLE LOCATION---------------------
            // recuperation de l'etat du livre par son id

    $sql='SELECT id
    FROM etat
    INNER JOIN etat_livre
    ON etat_livre.id_etat=etat.id
    WHERE id_livre =:id';

    $requete=$bdd->prepare($sql);
    $data=[
        ':id'=>$id_livre
    ];
    $requete->execute($data);
    $etat_livre=$requete->fetch(PDO::FETCH_ASSOC);

    // declaration variabel $statut
    $statut="1";

    // INSERT INTO 	
    $sql='INSERT INTO location VALUES (NULL, :id_usager, :id_livre, NOW(), NULL, :etat_debut,  NULL, :statut )';
    $requete=$bdd->prepare($sql);
    $data=[
        ':id_usager'=>$id_usager,
        ':id_livre'=>$id_livre,
        ':etat_debut'=>intval($etat_livre['id']),
        ':statut'=> $statut
    ];

    if(!$requete->execute($data)){
        var_dump($requete);
        die;
        $_SESSION['erreur_add_location']=true;
        header('location:add.php');
    };

    // REDIRECTION après requete executée
    
        $_SESSION['erreur_add_location'] = false;
        header('location:index.php');
        die;
}
// ****************************************** UPDATE LOCATION ******************************************
// ****************************************(FERMETURE LOCATION)***************************************

if(isset($_POST['btn_clore_location'])){

    // statut 0 = location close => disponibilite livre= 1
    $id_livre=intval($_POST['id_livre']);
    $id_location=intval($_POST['id_loc']);
    // $date_fin=htmlentities($_POST['date_fin']);
    $etat_retour=intval($_POST['etat_retour']);


    $sql='UPDATE location SET date_fin = NOW() , etat_retour = :etat_retour, statut = 0 WHERE id=:id';
    $requete=$bdd->prepare($sql);
    $data=[
    
        ':etat_retour' => $etat_retour,
        ':id'=> $id_location
    ];

    if(!$requete->execute($data)){
        header('location: update.php?id='.$id_location);
    };

    $sql='UPDATE livre SET disponibilite = 1 WHERE id=?';
    $requete=$bdd->prepare($sql);
   
    if(!$requete->execute([$id_livre])){
        header('location:index.php');
        $_SESSION['erreur_clore_location']=true;
    };

    header('location:index.php?id='.$id_livre);
    $_SESSION['erreur_clore_location']=false;
}
