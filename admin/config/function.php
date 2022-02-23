<?php 

// FONCTION ALERT ********* fonction alert dans toutes les pages
function alert($couleur,$message){ ?>
    <div class="alert alert-<?= $couleur ?>" role="alerte">
    <?= $message?></div>
    <?php }

// FONCTION ISCONNECT ******** vérifie si la personne est bien connectée
function isConnect(){
    if(isset($_SESSION['connect']) && $_SESSION['connect']==true){
        return true;
    }
    return false;
}


// FONCTION CHECKROLES ******** renseigne le ou les roles de l'utilisateur connecté
function checkroles($id,$bdd){
    if (intval($id) <= 0) {
        return false; 
        die('id non correct');
    }

    $sql= 'SELECT libelle
           FROM role_utilisateur
           INNER JOIN role
           ON role_utilisateur.id_role = role.id
           WHERE id_utilisateur= ?';


    $requete=$bdd->prepare($sql);
    $requete->execute([$id]);
    $roles=$requete->fetchAll(PDO::FETCH_NUM);

    if(count($roles)>1){
        $roles = array_merge($roles[0],$roles[1]);
    
    }else{
        $roles= $roles[0];
    }
    $_SESSION['user']['role']=$roles;
    return true;
}


// FONCTION ISADMIN ******** renvoie true si l'utilisateur est admin (si 'Admin' est bien dans le tableau)
function isAdmin(){
    return in_array('Admin',$_SESSION['user']['role']);
    // $_SESSION['user']['roles'] est déclaré dans la fonction checkroles
    foreach($_SESSION['user']['role'] as $role){
        if($role='Admin'){
            return true;
        }
        return false;
    }
}

// FONCTION ISSALARIE ******** renvoie true si l'utilisateur est salarié (si 'salarié' est bien dans le tableau)
function isSalarie(){
    return in_array('Salarié',$_SESSION['user']['role']);
    // $_SESSION['user']['roles'] est déclaré dans la fonction checkroles
    foreach($_SESSION['user']['role'] as $role){
        if($role='Salarié'){
            return true;
        }
        return false;
    }
}

