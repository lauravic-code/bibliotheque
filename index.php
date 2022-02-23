<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2df565c170.js" crossorigin="anonymous"></script>
    <title>Accueil</title>
</head>

<body class="body">

    <!-- *******************************HEADER************************************ -->
    <!-- ************************************************************************* -->

    <header>
        <div id="blockHeader" class="">

            <!------------------------LIGNE TOP------------------------------------->

            <div id="ligne_top" class=""></div>

            <!------------------------ETIQUETTES------------------------------------->
            <div id="blockEtiquettes" class="">
                <div id="etiquette_connection" class="etiquette">
                    <div id="txtEtiquetteConnection" class="textEtiquette"></div>
                    <div id="imgEtiquetteConnection" class="imgEtiquette"><a class="" href=""><i class="far white fa-user fa-user-top"></i></a></div>
                </div>
                <div id="horaire" class="etiquette">
                    <div id="txtHoraire" class="textEtiquette"></div>
                    <div id="imgHoraire" class="imgEtiquette"><a class="" href=""><i class="far white fa-clock"></i></a></div>
                </div>
                <div id="lieu" class="etiquette">
                    <div id="txtLieu" class="textEtiquette"></div>
                    <div id="imgLieu" class="imgEtiquette"><a class="" href=""><i class="fas white fa-map-marker-alt"></i></a></div>
                </div>
                <div id="contact" class="etiquette">
                    <div id="txtContact" class="textEtiquette"></div>
                    <div id="imgContact" class="imgEtiquette"><a class="" href="contact.php"><i class="far white fa-envelope"></i></a></div>
                </div>
            </div>

            <!---------------------- RECHERCHE ------------------------------>

            <div id="searchZone" class="">
                <div id="rectRecherche">
                    <form action="get" id="form_search">
                        <input type="text" id="input_search" class="search" value="Saisissez votre recherche.">
                        <btn id="btn_search" class=""><i class="fas fa-search"></i></btn>
                    </form>
                </div>
            </div>
            <div id="loupe"></div>


        </div>
        <!------------------------BARRE------------------------------------>

        <div id="ensemble_barre_menu" class="">

            <!----------------------- MENU -->
            <div id="navBarre" class="barre_menu barre_bleu">
                <ul id="menu" class="">
                    <li id=li_menupcpal><a class="a_menuPcpal" href="index.html">Accueil</a></li>
                    <li id=li_menupcpal><a class="a_menuPcpal" href="agenda.html">Agenda</a></li>
                    <li id=li_menupcpal><a class="a_menuPcpal" href="catalogue.html">Catalogue</a></li>
                    <ul id="sousMenuCat" class="">
                        <li>Par catégorie</li>
                        <li>Par titre</li>
                    </ul>
                </ul>
            </div>

            <!----------------------- DIV VIDE -->
            <div id="div_vide" class="barre_menu"></div>


            <!------------------------- MON COMPTE -->
            <div id="connection" class="barre_menu">
                <a id="a_connection" href="">
                    <div id="txtConnection">Mon compte</div>
                    <div id="logo_monCompte"><i class="far fa-user"></i></div>
                    <!-- <div id="elipse_monCompte">
                    </div> -->
                </a>


            </div>
        </div>
    </header>


    <!-- ****************************SECTION 1************************************ -->
    <!-- ************************************************************************** -->

    <!------------------------ACTUALITE------------------------------------>
    <section id="session1">
        <div id="videAgauche"></div>
    <div id="gpe_actualite" class="">
        <div id="actualite1" class="actualite">
            <div id="txtActualite1" class="txtActualite">
                <h1 id="h1_actualite">ACTUALITES</h1>
                <p>Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans fb g On sait depuis longtemps.Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans fb g On sait depuis longtemps.</p>
            </div>
            <div id="img_actualite1" class="img_actualite"><img id="poster_actualite1" class="poster_actualite" src="img/affiche-litterature-vin.jpg" alt=""></div>
        </div>

        <div id="actualite2" class="actualite">
            <div id="img_actualite2" class="img_actualite"><img id="poster_actualite2" class="poster_actualite" src="img/festival_livre.png" alt=""></div>
            <div id="txtActualite2" class="txtActualite">
                <p>Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans fb g On sait depuis longtemps.Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans fb g On sait depuis longtemps.</p>
            </div>
        </div>
</div>
        <!--------------------------AGENDA------------------------------------>

        <div id="agenda" class="">
            <div id="text_agenda">
                <h2 id="h2_agenda">AGENDA</h2>
            </div>
            <div id="jour_agenda">
                <div id="jour1" class="jours">
                    <h3 class="h3_date">Lundi 10 janvier</h3>
                    <p class="p_agenda"><strong> 10:00 -</strong>    Rencontre avec auteur</p>
                </div>
                <div id="jour2" class="jours">
                    <h3 class="h3_date">Mardi 11 janvier</h3>
                    <p class="p_agenda"><strong> 11:00 -</strong>    Lecture enfant</p>
                </div>
                <div id="jour3" class="jours">
                    <h3 class="h3_date">Merc 12 janvier</h3>
                    <p class="p_agenda"><strong> 15:00 -</strong>    Conférence</p>
                </div>
                <div id="jour4" class="jours">
                    <h3 class="h3_date">Jeudi 13 janvier</h3>
                    <p class="p_agenda"><strong> 10:00 -</strong>    Spectacle autour du</p>
                </div>
                <div id="jour5" class="jours">
                    <h3 class="h3_date">vend 14 janvier</h3>
                    <p class="p_agenda"><strong> 16:00 -</strong>    Conférence</p>
                </div>
            </div>
        </div>
        <div id="videAdroite"></div>
    </section>

    <!-- ****************************SECTION 2************************************ -->
    <!-- ************************************************************************* -->

    <section id="session2">

        <!------------------------TITRE------------------------------------>
        <h1 id="h1_carousselLivre">LES SORTIES DE LA SEMAINE</h1>

        <!------------------------LIVRES------------------------------------>

        <div id="carousselLivre" class="">
            <div id="livre1" class="livreDelaSemaine">
                <img src="img/livre la semaine de 4 heures.jpg" alt="Livre 1" class="image_caroussel">
                <div id="resume_livre1" class="resume_livres">
                    <p>La majorité des personnes restent employées toute leur vie, et travaillent de 9H à 17H pendant 40 ans pour prendre leur retraite à 60 ans (ou plus) ; par le biais du livre La semaine de 4 heures, Tim Ferriss nous explique comment </p>
                </div>
            </div>
            <div id="livre2" class="livreDelaSemaine">
                <img src="img/livre le syndrome du spaguetti.jpg" alt="Livre 2" class="image_caroussel" >
                <div id="resume_livre2" class="resume_livres">
                    <p>À 17 ans, Anthony, obligé de faire face à l'absence de son père et aux gardes à vue de son frère, ne rêve plus depuis longtemps. Ils se sont croisés une fois par hasard</p>
                </div>
            </div>
            <div id="livre3" class="livreDelaSemaine">
                <img src="img/Dieu.jpg" alt="Livre 3" class="image_caroussel">
                <div id="resume_livre3" class="resume_livres">
                    <p>Réfléchissez et devenez riche de Napoleon Hill est l’un des meilleurs livres de développement personnel qui renseigne sur les secrets pour devenir riche. Il est également l’un des plus complets en matière d’intelligence financière pour avoir la liberté financière.</p>
                </div>
            </div>
            <div id="livre4" class="livreDelaSemaine">
                <img src="img/livre_de_beauvoir.jpeg" alt="Livre 4" class="image_caroussel">
                <div id="resume_livre4" class="resume_livres">
                    <p>Dès qu'il le découvre, le jeune écrivain sénégalais Diégane, monté à Paris plein d'ambition, en est possédé. Il décide d'enquêter sur son mystérieux auteur devenu paria : T.C. Elimane, lui aussi Africain francophone, a connu la gloire en 1938 avant d'être balayé par une accusation de plagiat et de disparaîtr</p>
                </div>
            </div>
        </div>
    </section>




    <!-- ****************************FOOTER************************************ -->
    <!-- ************************************************************************* -->

<?php include("includes/footer.php") ?>
</body>

</html>