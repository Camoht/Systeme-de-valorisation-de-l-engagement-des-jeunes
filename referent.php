<html>
    <head>
        <?php
            include 'constants.php';
            echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Referent"].'>';
        ?>
        <title>Referent</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            echo $BANDEAUREFERENT;
        ?>

        <!--Description of the project-->
        <table class="consigne">
            <tr>
                <td id="titre">Bienvenue sur le site Jeunes 6.4 !</td>
            </tr>
            <tr>
                <td id="explication">
                Un jeune a besoin de votre aide pour valider une expérience !<br/>
                Le projet Jeunes 6.4 a pour but de mettre en avant des expériences professionnelles auprès de recruteurs,
                pour cela les jeunes peuvent faire appel à leur référent de mission pour valider leurs missions et leurs compétences.<br/>
                C'est là que vous intervenez ! Un jeune vous a identifié comme son référent. Nous vous proposons de confirmer et valoriser son expérience ci-dessous.</td>
            </tr>
        </table>

        <?php
            //Get information from link
            $refnb = $_GET['refnb'];
            $studentId = $_GET['studentId'];
            $refPath = $GLOBALS["File"]["Data"]."/" . $studentId . '/ref' . $refnb .'.txt';
            $commentPath = $GLOBALS["File"]["Data"]."/" . $studentId . '/'.$GLOBALS["File"]["inData"][2]. $refnb .'.txt';
            $userPath = $GLOBALS["File"]["Data"]."/" . $studentId . "/".$GLOBALS["File"]["inData"][0];
            
            //Show student's informations
            echo "
            <table class='texte'>
                <tr>
                    <td>Données de l élève :</td>
            ";
            $ligneCount = 0;
            if(file_exists($userPath)){
                $userFile = fopen($userPath, 'r+');
                while (($line = fgets($userFile)) !== false) {
                    $ligneCount++;

                    //Delete useless spaces
                    $line = trim($line);
                    
                    //Check if the line is empty
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
                            //If there is to much lines
                            break;
                        }
                    }
                }
            }

            //Valid knoledges
            $ligneCount = 0;
            if(isset($_POST['envoyer'])){
                
                //Create and fill the comment's file
                touch($commentPath);
                if (is_writable($commentPath)) {
                    $commentFile = fopen($commentPath, 'r+');
                    fputs($commentFile, $_POST['comment']);
                    fclose($commentFile);
                }

                //Change value of knowledges if validated
                if (is_writable($refPath)) {
                    $refFile = fopen($refPath, 'r+');
                    if ($refFile) {
                        
                        //Modification of first line because the reference has been validated
                        rewind($refFile);
                        fputs($refFile, "1");

                        //Get informations from data file
                        $fileContent = file($refPath);
                        $lastLine = end($fileContent);
                        $wordsNumbers = explode(',', $lastLine);

                        //Change value of knowledge (0 to 1)
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

                        //Go to thanks page
                        header('Location: '.$GLOBALS["File"]["Referent_thanks"]);
                        exit();
                    }
                }
            }

            if(file_exists($refPath)){
                $refFile = fopen($refPath, 'r+');
                echo "<tr><td>Expérience : </td></tr>";
                echo("<form method='POST'>");

                //Display dat's information
                while (($line = fgets($refFile)) !== false) {
                    $ligneCount++;

                    //Delete useless spaces
                    $line = trim($line);
                    
                    //Check if line is empty
                    if (!empty($line)) {
                        switch ($ligneCount) {
                            case 1:
                                if ($line == "1"){  //The reference has already been validated, go to thanks page
                                    header('Location: '.$_SESSION["Files"]["Referent_thanks"]);
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
                                //Divide last line with comma as seperators
                                $motsNumeros = explode(',', $line);

                                //Display words and associated numbers
                                echo("<tr><td>Savoir-faires (Cochez si vous approuvez)<br></td></tr>");
                                foreach ($motsNumeros as $motNumero) {
                                    //Divide each word from their numbers
                                    list($mot, $numero) = explode(':', $motNumero);

                                    //Display knowledge and checkboxes associated
                                    echo '<tr><td>';
                                    echo $mot;
                                    echo '<input type="checkbox" name="' . $mot . '" value="1"><br>';
                                    echo '</td></tr>';
                                }
                                break;
                            default:
                                //If there is to much lines
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
