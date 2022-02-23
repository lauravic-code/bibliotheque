<?php 

    $dsn = 'mysql:dbname=bibliotheque_mathieu;localhost';
    $utilisateur= 'bibliotheque';
    $mdp = 'WuvLgLPmd7n4-1Kc';


    try{
        $bdd= new PDO($dsn,$utilisateur,$mdp,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(PDOException $e){
        die("erreur dans la connexion à la base de données");
    }
    
?>