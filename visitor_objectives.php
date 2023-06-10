<html>
    <head>
        <title>Espace visiteur</title>
        <meta charset="utf-8">
    </head>
    <body>

        <!--Text-->
        <p>
        <h3>Bienvenue sur le site internet Jeune6.4 ! </h3>
        Ce site permet aux étudiants de mettre en avant leurs expériences professionnelles (stages, bénévolats, etc...). <br/>
        Ils peuvent demander aux référents de confirmer leurs expériences et les savoirs-être obtenus, imprimer ces mêmes références ou inviter quelqu'un à les consuter. <br/>
        Un référent peut quant à lui valoriser un étudiant en validant son expérience. <br/>
        Le consultant ne peut que consulter les expériences des étudiants. <br/>
        </p>

        <?php
        //Include some files
        include 'constants.php';

        //Button to create an account
        echo '<a href='.$GLOBALS["File"]["Create_account"]["php"].'><button>Créer un compte</button></a>';
        
        //Button to show the second page accessible by the visitors about the partners
        echo '<a href='.$GLOBALS["File"]["Visitor_welcome"]["php"][1].'><button>Voir les partenaires</button></a>';
        ?>

    </body>
</html>