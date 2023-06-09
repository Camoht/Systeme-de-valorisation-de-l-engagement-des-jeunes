<html>
  <head>
    <?php
    //Include some files
    include 'constants.php';
    echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Student"].'>';
    echo '<script src='.$GLOBALS["File"]["Ask_reference"]["js"][0].'></script>';
    echo '<script src='.$GLOBALS["File"]["Ask_reference"]["js"][1].'></script>';
    ?>
    <title>Demande de référence</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
    echo $BANDEAUJEUNE;
    session_start();
    ?>
    <!--Form to send a reference to the referent-->
    <h3>Créer une demande de référence</h3>
    <form method='POST' action="#">
      <!--Reference's data-->
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
        <!--Learnt knowledge's data-->
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
      </div>
      <button type='submit' name='envoyer'>Envoyer</button>
    </form>
    <?php
      if(isset($_SESSION['User_id'])){
        echo $BACK;
        if(isset($_POST['envoyer'])){
          //Verification of the number of references for this user
          $refNumberPath = $GLOBALS["File"]["Data"]."/" . $_SESSION["User_id"];
          if(!is_dir($refNumberPath)){ //Unnecessary precautions (if the user doesn't have data file)
            mkdir($refNumberPath, 0777, true);
          }
          if(!file_exists($refNumberPath . "/".$GLOBALS["File"]["inData"][1])){ //Create necessary file
            touch($refNumberPath . "/".$GLOBALS["File"]["inData"][1]);
          }
          $refNumberPath = $GLOBALS["File"]["Data"]."/" . $_SESSION["User_id"] . "/".$GLOBALS["File"]["inData"][1];
          $refNumberFile = fopen($refNumberPath, 'r+');
          if(filesize($refNumberPath) === 0){ //First reference
            fputs($refNumberFile, '001');
            $refNumber = 1;
          }
          else{ //Update the reference's number
            $refNumber = intval(fgets($refNumberFile));
            $refNumber++;
          }

          //Retrieval of the number of references
          $refNumberForm = str_pad($refNumber, 3, '0', STR_PAD_LEFT);
          fseek($refNumberFile, 0);
          fputs($refNumberFile, $refNumberForm);
          fclose($refNumberFile);

          //Create reference's file
          $newReference = 'ref' . $refNumberForm . '.txt';
          touch($GLOBALS["File"]["Data"]."/" . $_SESSION["User_id"] . '/' . $newReference);
          $newReferencePath = $GLOBALS["File"]["Data"]."/" . $_SESSION["User_id"] . '/' . $newReference;
          $newReferenceFile = fopen($newReferencePath, 'w+');
          fputs($newReferenceFile, "0\n"); //The request has not yet been validated
          fputs($newReferenceFile, str_replace("\n", "&é(-è_çà", $_POST['description'])."\n");
          fputs($newReferenceFile, $_POST['duration']."\n");
          fputs($newReferenceFile, $_POST['environment']."\n");
          fputs($newReferenceFile, str_replace("\n", "&é(-è_çà", $_POST['referent'])."\n");
          fputs($newReferenceFile, $_POST['email']."\n");

          //Array with names of categories
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

          //String to store checkbox values
          $checkboxValues = '';
          //Category path
          foreach ($categories as $key => $category) {
            //Check if the box is checked
            if (isset($_POST['cat' . ($key + 1)])) {
              //Checkbox is checked, append "0" to string
              $checkboxValues .= $category . ':0,';
            }
          }
          $checkboxValues = rtrim($checkboxValues, ',');
          //Save values ​​to a file
          fputs($newReferenceFile, $checkboxValues);

          //Create absolute link
          $relativLink = dirname($_SERVER['SCRIPT_NAME']) . "/".$GLOBALS["File"]["Confirm_reference"]["php"]."?studentId=" . $_SESSION["User_id"] . "&refnb=" . $refNumberForm;
          $adresseSite = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
          $adresseSite .= $_SERVER['HTTP_HOST'];
          $completeadresse = $adresseSite . $relativLink;
          
          //Send the link
          $to = $_POST['email'];
          $from ="leprojetjeunes64@gmail.com";
          $subject = "Demande de validation d'engagement d'un jeune";
          $message = "Bonjour,\n
          Un jeune a besoin de votre aide pour valider une expérience !\n\n
          Le projet Jeunes 6.4 a pour but de mettre en avant des expériences professionnelles auprès de recruteurs,
          pour cela les jeunes peuvent faire appel à leur référent de mission pour valider leurs missions et leurs compétences.\n
          C'est là que vous intervenez ! Un jeune vous a identifié comme son référent. Vous pouvez permettre cette validation en cliquant sur le lien ci-dessous :\n"
          . $completeadresse;
          $headers = ['From' => $from];

          //Notice the user the status of the mail
          if(mail($to, $subject, $message, $headers)){
            echo "Le mail a bien été envoyé !";
          }
          else{
            echo "<h4>Le mail n'a pas pu être envoyé ... Vous pouvez cependant copier ce lien et l'envoyer manuellement à votre référent : </h4>";
            echo "<a href='referent.php?studentId=" . $_SESSION["User_id"] . "&refnb=" . $refNumberForm . "' id='link'>Lien vers la demande</a>";
            echo "<button id='copyButton' onclick='copyLink()'>Copier le lien</button>";
          }
          fclose($newReferenceFile);
        }
      }
      else echo "Vous n'avez pas la permission d'envoyer depuis cette page";
    ?>
  </body>
</html>
