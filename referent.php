<html>
    <head>
        <title>Referent</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Un élève souhaite que vous validiez cette expérience : </h2>
        <?php
            $studentId = $_GET['studentId'];
            $refnb = $_GET['refnb'];
            $refPath = 'Data/' . $studentId . '/ref' . $refnb .'.txt';

            $ligneCount = 0;

            if(isset($_POST['envoyer'])){
                if (is_writable($refPath)) {
  
                    $refFile = fopen($refPath, 'r+');
            
                    if ($refFile) {
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

                echo("<form method='POST'>");

                while (($line = fgets($refFile)) !== false) {
                    $ligneCount++;

                    // Supprimer les espaces en début et en fin de ligne
                    $line = trim($line);
                    
                    // Vérifier si la ligne est vide
                    if (!empty($line)) {
                        switch ($ligneCount) {
                            case 1:
                                echo("Description de l'engagement : " . $line . "<br>");
                                break;
                            case 2:
                                echo("Durée de l'engagement : " . $line . "<br>");
                                break;
                            case 3:
                                echo("Lieu : " . $line . "<br>");
                                break;
                            case 4:
                                echo("Nom du référent : " . $line . "<br>");
                                break;
                            case 6:
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