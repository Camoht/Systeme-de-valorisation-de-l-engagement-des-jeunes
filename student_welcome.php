<html>
    <head>
        <title>Espace jeune</title>
        <meta charset="utf-8">
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Student"].'>';
        ?>
    </head>
    <body>
        <?php
            echo $BANDEAUJEUNE;
            echo "<h3>Bienvenue sur l'espace Jeunes</h3>";
            echo"
            <table class='texte'>
                <tr>
                    <td>Se connecter :</td>
                    <td><button type='submit'><a href=".$GLOBALS["File"]["Connect"]["php"].">Sélectionner</a><Sélectionner</button></td>
                </tr>
                <tr>
                    <td>Créer un compte :</td>
                    <td><button type='submit'><a href=".$GLOBALS["File"]["Create_account"]["php"].">Sélectionner</a></button></td>
                </tr>
            </table>
            ";
        ?>        
    </body>
</html>