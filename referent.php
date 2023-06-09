<html>
    <head>
        <title>Referent</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>    Bienvenue sur le site Jeune6.4 !<br>
    Ce site permet aux jeunes de mettre en avant leurs expériences professionnels (stages, bénévolats, etc...).<br>
    Un jeune vous a identifié comme son référent.<br>
    Nous vous proposons de confirmer et valoriser son expérience ci-dessous.<br></h2>
        <?php
            echo "Données de l'élève : \n";

            $studentId = $_GET['studentId'];
            $refnb = $_GET['refnb'];
            $refPath = 'Data/' . $studentId . '/ref' . $refnb .'.txt';
            $commentPath = 'Data/' . $studentId . '/comRef' . $refnb .'.txt';
            $userPath = 'Data/' . $studentId . '/user.txt';


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
                                echo("Nom : " . $line . "<br>");
                                break;
                            case 2:
                                echo("Prénom : " . $line . "<br>");
                                break;
                            case 3:
                                echo("Date de naissance : " . str_replace("_", "/", $line . "<br>"));
                                break;
                            case 4:
                                echo("Email : " . $line . "<br>");
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

                        header('Location: HTML REFERENT remerciement.html');
                        exit();
                    }
                }
            }

            if(file_exists($refPath)){
                $refFile = fopen($refPath, 'r+');
                echo "Expérience : ";
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
                                    header('Location: HTML REFERENT remerciement.html');
                                    exit();
                                } 
                            case 2:
                                echo("Description de l'engagement : " . $line . "<br>");
                                break;
                            case 3:
                                echo("Durée de l'engagement : " . $line . "<br>");
                                break;
                            case 4:
                                echo("Lieu : " . $line . "<br>");
                                break;
                            case 5:
                                echo("Nom du référent : " . $line . "<br>");
                                break;
                            case 7:
                                // Diviser la dernière ligne en mots et numéros en utilisant une virgule comme séparateur
                                $motsNumeros = explode(',', $line);

                                // Afficher les mots et les numéros associés
                                echo("Savoir-faires (Cochez si vous approuvez)<br>");
                                foreach ($motsNumeros as $motNumero) {
                                    // Diviser chaque mot et numéro
                                    list($mot, $numero) = explode(':', $motNumero);

                                    // Afficher le mot et la case à cocher
                                    echo $mot;
                                    echo '<input type="checkbox" name="' . $mot . '" value="1"><br>';
                                }
                                break;
                            default:
                                // Gérer le cas où une ligne supplémentaire est rencontrée ou ignorer si nécessaire
                                break;
                        }
                    }
                }
                echo "Commentaires éventuels :<textarea type='text' name='comment'></textarea>";
                fclose($refFile);
                echo "<button type='submit' name='envoyer'>Envoyer</button>";
                echo("</form>");
            }
            else{
                echo("Erreur lors de l'ouverture de la référence");
            }
        ?>
    </body>
</html>