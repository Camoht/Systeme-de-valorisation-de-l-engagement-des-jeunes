<html>
    <head>
        <title>Vous êtes connecté</title>
        <meta charset="utf-8">
        <?php
            include 'constants.php';
            echo '<link rel="stylesheet" type="text/css" href='.$_SESSION["Files"]["css"]["Student"].'>';
        ?>
    </head>
    <body>
        <?php
            echo $_SESSION["BANDEAUJEUNE"];
        ?>
        <div class="cadre">
    <?php
    function show_student(){
            // Show the content of user's file.
            echo '<div>';
            //Variables
            $Table_user_content=array (
                0 => "Nom",
                1 => "Prénom",
                2 => "Date de naissance",
                3 => "E-mail"
            );
            //Open the user's file
            $file=fopen($_SESSION["Files"]["Data"]."/".$_SESSION["User_id"]."/user.txt", 'r');

            //Write the content of user's file
            echo "<table class='profil'>";
            foreach($Table_user_content as $user_content){
                echo "<tr><td>".$user_content."</td><td>".fgets($file)."</td></tr>";
            }
            echo "</table>";
            echo "</div>";
            fclose($file);
        }
        show_student();
        ?>
            <table class="texte">
                <tr>
                    <td>Modifier le profil: </td>
                    <td><button type='submit' name='submit_profile'>Envoyer</button></td>
                </tr>
                <tr>
                    <td>Demande de référence: </td>
                    <td><button type='submit' name='submit_request'>Envoyer</button></td>
                </tr>
                <tr>
                    <td>Afficher la liste de références: </td>
                    <td><button type='submit' name='submit_list'>Envoyer</button></td>
                </tr>
                <tr>
                    <td>Envoyer les références au consultant: </td>
                    <td><button type='submit' name='submit_send'>Envoyer</button></td>
                </tr>
                <tr>
                    <td>Inclure des référence au CV: </td>
                    <td><button type='submit' name='submit_include'>Envoyer</button></td>
                </tr>
            </table>
		</div>
    </body>
</html>
