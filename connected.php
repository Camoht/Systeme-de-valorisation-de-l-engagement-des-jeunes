<html>
    <head>
        <?php
            //Include some files
            include 'constants.php';
            echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Student"].'>';
        ?>
        <title>Vous êtes connecté</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            echo $BANDEAUJEUNE;
            session_start();
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
                    $file=fopen($GLOBALS["File"]["Data"]."/".$_SESSION["User_id"]."/".$GLOBALS["File"]["inData"][0], 'r');

                    //Write the content of user's file
                    echo "<table class='profil'><tr><td COLSPAN=2><h3>Mon profil</h3></td></tr>";
                    foreach($Table_user_content as $user_content){
                        echo "<tr><td>".$user_content."</td><td>".fgets($file)."</td></tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                    fclose($file);
            }
            show_student();

            echo"
            <table class='texte'>
                <tr>
                    <td>Modifier le profil :</td>
                    <td><button type='submit' name='submit_profile'><a href="."profile2.php".">Sélectionner</a><Sélectionner</button></td>
                </tr>
                <tr>
                    <td>Demande de référence :</td>
                    <td><button type='submit' name='submit_request'><a href=".$GLOBALS["File"]["Ask_reference"]["php"].">Sélectionner</a></button></td>
                </tr>
                <tr>
                    <td>Afficher la liste de références :</td>
                    <td><button type='submit' name='submit_list'><a href=".">Sélectionner</a></button></td>
                </tr>
                <tr>
                    <td>Envoyer les références au consultant :</td>
                    <td><button type='submit' name='submit_send'><a href=".$GLOBALS["File"]["Print_references"]["php"].">Sélectionner</a></button></td>
                </tr>
                <tr>
                    <td>Inclure des référence au CV :</td>
                    <td><button type='submit' name='submit_include'><a href=".$GLOBALS["File"]["Print_references"]["php"].">Sélectionner</a></button></td>
                </tr>
            </table>
            ";
            ?>
		</div>
    </body>
</html>
