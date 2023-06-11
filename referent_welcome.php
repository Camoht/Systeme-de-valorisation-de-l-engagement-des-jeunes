<html>
    <head>
        <title>Espace référent</title>
        <meta charset="utf-8">
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Referent"].'>';
        ?>
    </head>
    <body>
        <?php
            echo $BANDEAUREFERENT;
        ?>    
        <table class="consigne">
            <tr>
                <td id="titre">Bienvenue sur le site Jeunes 6.4 !</td>
            </tr>
            <tr>
                <td id="explication">
                Le projet Jeunes 6.4 a pour but de mettre en avant des expériences professionnelles auprès de recruteurs,
                pour cela les jeunes peuvent faire appel à leur référent de mission pour valider leurs missions et leurs compétences.<br/>
                C'est là que vous intervenez ! Si un jeune vous identifie comme son référent. Nous vous proposons de confirmer et valoriser son expérience.</td>
            </tr>
        </table>    
    </body>
</html>