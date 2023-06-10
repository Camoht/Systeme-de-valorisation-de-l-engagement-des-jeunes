<!DOCTYPE html>
<html>
    <head>
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Student"].'>';
        echo '<script type="text/javascript" src='.$GLOBALS["File"]["Connect"]["js"].'></script>';
        ?>

        <title>Se connecter</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            echo $BANDEAUJEUNE; 
            include 'constants_js.php';
        ?>
        <form id="choice">
            <div class="cadre">
                <table class="texte">
                    <tr>
                        <td>EMAIL: </td>
                        <td><input type='text' name='email' id="email"/></td>
                    </tr>
                    <tr>
                        <td>MOT DE PASSE: </td>
                        <td><input type='text' name='password' id="password"/></td>
                    </tr>
                        <td><button type='submit' name='submit'>Envoyer</button></td>
                </table>
            </div>
        </form>
        <div id="phpreponse"><!--Response from AJAX resquest--></div>
    </body>
</html>