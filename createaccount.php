<!DOCTYPE html>
<html>
    <head>
        <?php
        //Include some files
        include 'constants.php';
        echo '<script type="text/javascript" src='.$_SESSION["Files"]["Create_account"]["js"].'></script>';
        ?>

        <title>Créer un compte</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        include 'constants_js.php';
        echo $_SESSION["BANDEAU"];
        ?>

        <!--Give to the user, te abilitie to give informations-->
        <form id="choice">
            <div class="cadre">
                <table class="texte">
                    <tr>
                        <td>NOM: </td>
                        <td><input type='text' name='name' id="name"/></td>
                    </tr>
                    <tr>
                        <td>PRENOM: </td>
                        <td><input type='text' name='surname' id="surname"/></td>
                    </tr>
                    <tr>
                        <td>DATE DE NAISSANCE: </td>
                        <td><input type='text' name='birth' id="birth"/></td>
                    </tr>
                    <tr>
                        <td>EMAIL: </td>
                        <td><input type='text' name='email' id="email"/></td>
                    </tr>
                    <tr>
                        <td>MOT DE PASSE: </td>
                        <td><input type='text' name='password' id="password"/></td>
                    </tr>
                    <tr><td><button type='submit' name='submit'>Envoyer</button></td></tr>
                </table>
            </div>
        </form>

        <!--Space for the AJAX response-->
        <div id="phpreponse"></div>
    </body>
</html>