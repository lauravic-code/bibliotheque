
<?php 
    session_start();
    include 'C:/wamp64/www/bibliotheque/admin/config/config.php'
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2df565c170.js" crossorigin="anonymous"></script>
    <title>Contact</title>
</head>

<body class="body">
    <header>

        <!-- *******************************HEADER************************************ -->
        <!-- ************************************************************************* -->

        <!------------------------LIGNE TOP------------------------------------->
        <div id="menu_autrePage">
            <div id="ligne_top" class=""></div>

            <div id="ensemble_barre_menu_contact" class="">

                <!----------------------- MENU -->
                <div id="navBarre2" class="barre_menu barre_bleu">
                    <ul id="menu" class="">
                        <li id=li_menupcpal><a class="a_menuPcpal" href="index.php">Accueil</a></li>
                        <li id=li_menupcpal><a class="a_menuPcpal" href="agenda.php">Agenda</a></li>
                        <li id=li_menupcpal><a class="a_menuPcpal" href="catalogue.php">Catalogue</a></li>
                        <ul id="sousMenuCat" class="">
                            <li>Par catégorie</li>
                            <li>Par titre</li>
                        </ul>
                    </ul>
                </div>
                <!----------------------- DIV VIDE -->
                <div id="div_vide" class="barre_menu"></div>

            </div>
        </div>

        <!------------------------ETIQUETTES------------------------------------->
        <div id="blockEtiquettes" class="">
            <div id="etiquette_connection_contact" class="etiquette etiquette_contact">
                <div id="txtEtiquetteConnection" class="textEtiquette"></div>
                <div id="imgEtiquetteConnection" class="imgEtiquette"><a class="" href=""><i class="far white fa-user"></i></a></div>
            </div>
            <div id="horaire" class="etiquette etiquette_contact">
                <div id="txtHoraire" class="textEtiquette"></div>
                <div id="imgHoraire" class="imgEtiquette"><a class="" href=""><i class="far white fa-clock"></i></a></div>
            </div>
            <div id="lieu" class="etiquette etiquette_contact">
                <div id="txtLieu" class="textEtiquette"></div>
                <div id="imgLieu" class="imgEtiquette"><a class="" href=""><i class="fas white fa-map-marker-alt"></i></a></div>
            </div>
            <div id="contact" class="etiquette etiquette_contact">
                <div id="txtContact" class="textEtiquette"></div>
                <div id="imgContact" class="imgEtiquette"><a class="" href="contact.php"><i class="far white fa-envelope"></i></a></div>
            </div>
        </div>
    </header>


    <!-- *******************************FORMULAIRE************************************ -->
    <!-- ************************************************************************* -->

    <?php
    
    if(isset($_SESSION["alert"])){
        echo '<p>' . implode($_SESSION["alert"]) . '</p>';     
        unset($_SESSION['alert']);
        unset($_SESSION['error']);
         }
    ?>



    <section id="section1_contact">
        <div class="marchepas">
            <div id="titre_form" class="">
                <h1 id="h1_contact">Que peut-on faire pour vous?</h1>
            </div>
            <div id="div_formulaire" class="">
                <form id="form_contact" action="<?php echo URL_ADMIN?>client/action.php" method="POST" class="">
                    <div id="partie1_form">
                        <div id="colonne1_form">
                            <div class="form">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" value="" id="nom" class="input_contact">
                            </div>
                                <div class="form">
                                    <label for="mail">Mail</label>
                                    <input type="text" name="mail" value="" id="mail" class="input_contact">
                                </div>
                        </div>
                        <div id="colonne2_form">
                            
                            <div class="form">
                                <label for="objet">Objet</label>
                                <input type="text" name="objet" value="" id="objet" class="input_contact">
                            </div>
                        </div>
                    </div>
                    <div id="partie2_form">
                        <div class="avisquest champquest">
                            <p>Votre message:</p>
                            <textarea id="msg" name="msg" rows="15" cols="80"></textarea>
                        </div>
                    </div>
                    <div id="div_btn_contact">
                        <input class="btn_contact_biblio" name="btn_contact_biblio" type="submit" value="Envoyer">
                    </div>
                </form>

            </div>
        </div>
    </section>

    <?php include("includes/footer.php") ?>

    </body>

</html>