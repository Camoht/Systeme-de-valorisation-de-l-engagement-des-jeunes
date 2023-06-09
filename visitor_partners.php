<!DOCTYPE html>
<html>
    <head>
        <title>Espace visiteur</title>
        <meta charset="utf-8">
    </head>
    <body>

        <!--Text-->
        <p>
        <h3>Bienvenue sur le site internet Jeune6.4 ! </h3>
        Nous remercions les partenaires suivant qui ont permis la réalisation de se projet
        </p>
        
        <?php
        //Include some files
        include 'constants.php';

        //Button to create an account
        echo '<a href='.$_SESSION["Files"]["Create_account"]["php"][0].'><button>Créer un compte</button></a>';
        
        //Button to show the first page accessible by the visitors about the objectives
        echo '<a href='.$_SESSION["Files"]["Visitor_welcome"]["php"][0].'><button>Voir les objectifs</button></a>';
        ?>

    </body>
</html>

