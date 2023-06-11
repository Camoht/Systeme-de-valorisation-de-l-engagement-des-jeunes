<html>
    <head>
        <title>Espace consultant</title>
        <meta charset="utf-8">
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Consultant"].'>';
        ?>
    </head>
    <body>
        <?php
            echo $BANDEAUCONSULTANT;
        ?>    
        <table class="consigne">
            <tr>
                <td id="titre">Bienvenue sur le site Jeunes 6.4 !</td>
            </tr>
            <tr>
                <td id="explication">
                Le projet Jeunes 6.4 a pour but de mettre en avant des expériences professionnelles auprès de recruteurs,
                pour cela les jeunes peuvent faire appel à leur référent de mission pour valider leurs missions et leurs compétences.<br/>
                Chaque mission peut donc être validé par un référent puis vous être envoyé pour vous assurer les savoirs-faire du jeune !</td>
            </tr>
        </table>    
    </body>
</html>