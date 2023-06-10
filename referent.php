<html>
    <head>
        <title>Referent</title>
        <meta charset="utf-8">
        <?php
            include 'constants.php';
            echo '<link rel="stylesheet" type="text/css" href='.$_SESSION["Files"]["css"]["Referent"].'>';
            echo '<script src='.$_SESSION["Files"]["Ask_reference"]["js"][0].'></script>';
            echo '<script src='.$_SESSION["Files"]["Ask_reference"]["js"][1].'></script>';
            ?>
    </head>
    <body>
        <?php
             echo $_SESSION["BANDEAUREFERENT"];
        ?>
        <table class="consigne">
            <tr>
                <td id="titre">Bienvenue sur le site Jeune6.4 !</td>
            </tr>
            <tr>
                <td id="explication">Ce site permet aux jeunes de mettre en avant leurs expériences professionnels (stages, bénévolats, etc...).<br>
                Un jeune vous a identifié comme son référent.<br>
                Nous vous proposons de confirmer et valoriser son expérience ci-dessous.<br></td>
            </tr>
        </table>
        <?php
            $refnb = $_GET['refnb'];
            $refPath = $_SESSION["Files"]["Data"]."/" . $_SESSION["User_id"] . '/ref' . $refnb .'.txt';
            $commentPath = $_SESSION["Files"]["Data"]."/" . $_SESSION["User_id"] . '/'.$_SESSION["Files"]["inData"][2]. '. $refnb .'.'txt';
            $userPath = $_SESSION["Files"]["Data"]."/" . $_SESSION["User_id"] . "/".$_SESSION["Files"]["inData"][0];

            echo "<table class='texte'>";
            echo "<tr>";
            echo "<td>Données de l élève :<br/></td>";

            $ligneCount = 0;
            if(file_exists($userPath)){
                $userFile = fopen($userPath, 'r+');

                while (($line = fgets($userFile)) !== false) {
                    $ligneCount++;

                    // Supprimer les espaces en début et en fin de ligne
                    $line = trim($line);
                    
                    // Vérifier si la ligne est vide
                    if (!empty($line)) {
                        switch ($ligneCount) {
                            case 1:
                                echo("<tr><td>Nom : " . $line . "<br></td></tr>");
                                break;
                            case 2:
                                echo("<tr><td>Prénom : " . $line . "<br></td></tr>");
                                break;
                            case 3:
                                echo("<tr><td>Date de naissance : " . str_replace("_", "/", $line . "<br></td></tr>"));
                                break;
                            case 4:
                                echo("<tr><td>Email : " . $line . "<br></td></tr>");
                                break;
                            default:
                                // Gérer le cas où une ligne supplémentaire est rencontrée ou ignorer si nécessaire
                                break;
                        }
                    }
                }
            }

            $ligneCount = 0;

            if(isset($_POST['envoyer'])){
                
                touch($commentPath);
                if (is_writable($commentPath)) {
                    $commentFile = fopen($commentPath, 'r+');
                    fputs($commentFile, $_POST['comment']);
                    fclose($commentFile);
                }

                if (is_writable($refPath)) {
  
                    $refFile = fopen($refPath, 'r+');
            
                    if ($refFile) {
                        
                        rewind($refFile);   //Modification of first line because the reference has been validated
                        fputs($refFile, "1");

                        $fileContent = file($refPath);
                        $lastLine = end($fileContent);
                        $wordsNumbers = explode(',', $lastLine);

                        $updatedValues = [];

                        foreach ($wordsNumbers as $wordNumber) {
                            list($word, $number) = explode(':', $wordNumber);
                            if (isset($_POST[$word])) {
                                $number = 1;
                            }
                            $updatedValues[] = $word . ':' . $number;
                        }
                        $newLine = implode(',', $updatedValues);
                        $fileContent[count($fileContent) - 1] = $newLine;
                        file_put_contents($refPath, implode('', $fileContent));

                        fclose($refFile);

                        header('Location: '.$_SESSION["Files"]["Referent_welcome"]["html"]);
                        exit();
                    }
                }
            }

            if(file_exists($refPath)){
                $refFile = fopen($refPath, 'r+');
                echo "<tr><td>Expérience : </td></tr>";
                echo("<form method='POST'>");

                while (($line = fgets($refFile)) !== false) {
                    $ligneCount++;

                    // Supprimer les espaces en début et en fin de ligne
                    $line = trim($line);
                    
                    // Vérifier si la ligne est vide
                    if (!empty($line)) {
                        switch ($ligneCount) {
                            case 1:
                                if ($line == "1"){  //The reference has already been validated
                                    header('Location: '.$_SESSION["Files"]["Referent_welcome"]["html"]);
                                    exit();
                                } 
                            case 2:
                                echo("<tr><td>Description de l'engagement : " . str_replace('&é(-è_çà', "<br>", $line) . "<br></td></tr>");
                                break;
                            case 3:
                                echo("<tr><td>Durée de l'engagement : " . $line . "<br></td></tr>");
                                break;
                            case 4:
                                echo("<tr><td>Lieu : " . $line . "<br></td></tr>");
                                break;
                            case 5:
                                echo("<tr><td>Données du référent : " . str_replace('&é(-è_çà', "<br>", $line) . "<br></td></tr>");
                                break;
                            case 7:
                                // Diviser la dernière ligne en mots et numéros en utilisant une virgule comme séparateur
                                $motsNumeros = explode(',', $line);

                                // Afficher les mots et les numéros associés
                                echo("<tr><td>Savoir-faires (Cochez si vous approuvez)<br></td></tr>");
                                foreach ($motsNumeros as $motNumero) {
                                    // Diviser chaque mot et numéro
                                    list($mot, $numero) = explode(':', $motNumero);

                                    // Afficher le mot et la case à cocher
                                    echo '<tr><td>';
                                    echo $mot;
                                    echo '<input type="checkbox" name="' . $mot . '" value="1"><br>';
                                    echo '</td></tr>';
                                }
                                break;
                            default:
                                // Gérer le cas où une ligne supplémentaire est rencontrée ou ignorer si nécessaire
                                break;
                        }
                    }
                }
                echo "<tr><td>Commentaires éventuels :<textarea type='text' name='comment'></textarea></td></tr>";
                fclose($refFile);
                echo "<tr><td><button type='submit' name='envoyer'>Envoyer</button></td></tr>";
                echo("</form>");
                echo "</table>";
            }
            else{
                echo("Erreur lors de l'ouverture de la référence");
            }
        ?>
    </body>
</html>
