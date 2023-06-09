<html>
    <head>
        <link rel="stylesheet" type="text/css" href="student.css">
        <title>Demande de référence</title>
        <meta charset="utf-8">
        <script src="checkboxes.js"></script>
        <script src="link.js"></script>
    </head>
    <body>
      <div class="bandeau">
			  <table class="entete">
        		  <tr id="jeune">
					  <td>JEUNE</td>
				  </tr>
				  <tr id="valeuramonengagement">
					  <td>Je donne de la valeur à mon engagement</td>
				  </tr>
			  </table>
        	<form method='POST' action="#">
		  </div>
		  <div class="selection">
			<table class="selection tab">
			<tr>
			<td id="selectionjeune">JEUNE</td>
			<td id="selectionreferent"> RÉFÉRENT </td>
			<td id="selectionconsultant"> CONSULTANT </td>
			<td id="selectionpartenaires"> PARTENAIRES </td>
			</tr>
			</table>
		</div>
        <h3>Créer une demande de référence</h3>
        <form method='POST' action="#">
            <table class="texte">
                <tr>
                    <td>Description de l'engagement :<textarea id="réponse" type='text' name='description'></textarea></td>
                </tr>
                <tr>
                    <td>Durée de l'engagement :<input id="réponse" type='text' name='duration'></td>
                </tr>
                <tr>
                    <td>Milieu de l'engagement (association, club, ...) :<input id="réponse" type='text' name='environment'></td>
                </tr>
                <tr>
                    <td>Données personnelles du référent :<textarea id="réponse" type='text' name='referent'></textarea></td>
                </tr>
                <tr>
                    <td>Email du référent :<input id="réponse" type='text' name='email'></td>
                </tr>
            </table>
              <div class="box">
                    <h2 id="listesavoirfaire">Liste de vos savoir-faires(cochez)</h2>
                    <table class="check">
                        <tr>
                          <th>Savoir-être</th>
                          <th>Je suis</th>
                        </tr>
                        <tr>
                          <td>Autonome</td>
                          <td><input type="checkbox" id="cat1" name="cat1" value="valeur-cat1" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Passionné</td>
                          <td><input type="checkbox" id="cat2" name="cat2" value="valeur-cat2" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Réfléchi</td>
                          <td><input type="checkbox" id="cat3" name="cat3" value="valeur-cat3" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>À l'écoute</td>
                          <td><input type="checkbox" id="cat4" name="cat4" value="valeur-cat4" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Organisé</td>
                          <td><input type="checkbox" id="cat5" name="cat5" value="valeur-cat5" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Fiable</td>
                          <td><input type="checkbox" id="cat6" name="cat6" value="valeur-cat6" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Patient</td>
                          <td><input type="checkbox" id="cat7" name="cat7" value="valeur-cat7" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Responsable</td>
                          <td><input type="checkbox" id="cat8" name="cat8" value="valeur-cat8" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Sociable</td>
                          <td><input type="checkbox" id="cat9" name="cat9" value="valeur-cat9" onchange="countCheck(this)"></td>
                        </tr>
                        <tr>
                          <td>Optimiste</td>
                          <td><input type="checkbox" id="cat10" name="cat10" value="valeur-cat10" onchange="countCheck(this)"></td>
                        </tr>
                      </table>
                </tr>
            </table>
              </div>
            <button type='submit' name='envoyer'>Envoyer</button>
        </form>
        <?php
            $studentId = '045'; //(à déterminer en fonction de l'utilisateur connecté)
            if(isset($_POST['envoyer'])){
                //Verification of the number of references for this user
                $refNumberPath = 'Data/' . $studentId;
                if(!is_dir($refNumberPath)){
                    mkdir($refNumberPath, 0777, true);
                }
                if(!file_exists($refNumberPath . '/refNumber.txt')){
                    touch($refNumberPath . '/refNumber.txt');
                }
                $refNumberPath = 'Data/' . $studentId . '/refNumber.txt';
                $refNumberFile = fopen($refNumberPath, 'r+');
                if(filesize($refNumberPath) === 0){
                    fputs($refNumberFile, '001');
                    $refNumber = 1;
                }
                else{
                    $refNumber = intval(fgets($refNumberFile));
                    $refNumber++;
                }
                //Retrieval of the number of references
                $refNumberForm = str_pad($refNumber, 3, '0', STR_PAD_LEFT);
                fseek($refNumberFile, 0);
                fputs($refNumberFile, $refNumberForm);
                fclose($refNumberFile);

                $newReference = 'ref' . $refNumberForm . '.txt';
                touch('Data/' . $studentId . '/' . $newReference);
                $newReferencePath = 'Data/' . $studentId . '/' . $newReference;
                $newReferenceFile = fopen($newReferencePath, 'w+');
                fputs($newReferenceFile, "0\n"); //The request has not yet been validated
                fputs($newReferenceFile, str_replace("\n", ". ", $_POST['description'])."\n");
                fputs($newReferenceFile, $_POST['duration']."\n");
                fputs($newReferenceFile, $_POST['environment']."\n");
                fputs($newReferenceFile, str_replace("\n", ". ", $_POST['referent'])."\n");
                fputs($newReferenceFile, $_POST['email']."\n");

                // Array with names of categories
                $categories = array(
                    'Autonome',
                    'Passionné',
                    'Réfléchi',
                    'À l\'écoute',
                    'Organisé',
                    'Fiable',
                    'Patient',
                    'Responsable',
                    'Sociable',
                    'Optimiste'
                );

                // String to store checkbox values
                $checkboxValues = '';
                // Category path
                foreach ($categories as $key => $category) {
                    // Check if the box is checked
                    if (isset($_POST['cat' . ($key + 1)])) {
                        // Checkbox is checked, append "0" to string
                        $checkboxValues .= $category . ':0,';
                    }
                }
                $checkboxValues = rtrim($checkboxValues, ',');
                // Save values ​​to a file
                fputs($newReferenceFile, $checkboxValues);
                
                echo "<a href='referent.php?studentId=" . $studentId . "&refnb=" . $refNumberForm . "' id='link'>Lien vers la demande</a>";
                echo "<button id='copyButton' onclick='copyLink()'>Copier le lien</button>";
                fclose($newReferenceFile);
            }
        ?>
    </body>
</html>
</html>
