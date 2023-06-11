<!DOCTYPE html>

<html>
    <head>
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Student"].'>';
        echo '<script src='.$GLOBALS["File"]["Ask_reference"]["js"][0].'></script>'
        ?>

        <title>Mes références</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <div id="alert"><!--Space to notice if an email has been sent or not--></div>

        <?php

            echo $BANDEAUJEUNE;
            session_start();
            if(isset($_SESSION['User_id'])){
                echo '<h3>Mes références</h3>';
                
                function nb_zero($i){
                    // Use to create a number with 3 figures.
                    // $i : (int) between 1 and 999.
                    // Return "00", "0" or "" depending on i's number of figures (string).
                
                    if($i<10){
                        return "00";
                    } else if($i<100){
                        return "0";
                    } else {
                        return "";
                    }
                }

                function show_list_of_knowledge($list){
                    //Create a table to show the list of knowledge.
                    //$list : (char) the line in the reference's file containing the list of knowledge (format : "knowledge1:1,knowledge2:0")

                    echo "<table><tr><td>";
                    for($i=0;$i<strlen($list);$i++){

                        //Separating knowledges
                        if($list[$i]==','){
                            echo "</td></tr><tr><td>";

                        //Writing knowledges
                        } elseif($list[$i]!=':'){
                            echo $list[$i];

                        //Is the knowledge validated by the referer ?
                        } else {
                            $i++;
                            if($list[$i]=='0'){ //No : create an uncheck checkbox
                                echo '<input type="checkbox" disabled>';
                            } elseif($list[$i]=='1') { //Yes : create a check checkbox
                                echo '<input type="checkbox" checked disabled>';
                            }
                        }
                    }
                    echo "</td></tr></table>";
                }

                function show_ref($i){
                    // Show the content of reference's file if it has been validated by the referent.
                    // $i : (int) the id of reference's file (between 1 and 999).
                    // Return TRUE if the reference's file has been correctly displayed, FALSE if not.

                    //Variables
                    $Table_ref_content=array (
                        0 => "Description",
                        1 => "Durée",
                        2 => "Milieu",
                        3 => "Données personnelles du référent",
                        4 => "Adresse e-mail du référent",
                        5 => "Savoirs-êtres acquis"
                    );

                    //Open the reference's file
                    $ref_id="ref".nb_zero($i).$i.".txt";
                    $file=fopen($GLOBALS["File"]["Data"].'/'.$_SESSION["User_id"].'/'.$ref_id, 'r');

                    //Check if the reference has been validated by the referent
                    $first_lig=fgets($file);
                    if($first_lig=="0\n" || $first_lig=="0"){
                        echo '<input type="checkbox" id="'.$ref_id.'" name="'.$i.'" hidden>'; //to avoid problems with the js code
                        return FALSE;
                    }

                    echo '<input type="checkbox" id="'.$ref_id.'" name="'.$i.'">';
                    echo "<div id='text_".$ref_id."'>"."<table>";
                    foreach($Table_ref_content as $ref_content){
                        
                        //List of knowledge (last line of references' files) has to be displayed with the show_list_of_knowledge function
                        if(array_search($ref_content, $Table_ref_content)==count($Table_ref_content)-1){
                            echo "<tr><td>".$ref_content."</td><td>";
                            
                            show_list_of_knowledge(fgets($file));
                            echo "</td></tr>";

                        //The content of reference's file
                        } else {
                            echo "<tr><td>".$ref_content."</td><td>".str_replace("&é(-è_çà", "<br/>", fgets($file))."</td></tr>";
                        }
                    }

                    //Add the referent's comment if there are
                    if(file_exists($GLOBALS["File"]["Data"].'/'.$_SESSION["User_id"].'/'.$GLOBALS["File"]["inData"][2].nb_zero($i).$i.".txt")){
                        fclose($file);
                        $file=fopen($GLOBALS["File"]["Data"].'/'.$_SESSION["User_id"].'/'.$GLOBALS["File"]["inData"][2].nb_zero($i).$i.".txt", 'r');

                        echo "<tr><td>Commentaires</td><td>";
                        while (!feof($file)){
                            echo fgets($file)."<br/>";
                        }
                        echo "</td><tr/>";
                    }

                    echo "</table></div>";
                    echo "</br>";

                    fclose($file);

                    return TRUE;
                }

                function show_student(){
                    // Show the content of user's file.

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
                    echo "<table>";
                    foreach($Table_user_content as $user_content){
                        echo "<tr><td>".$user_content."</td><td>".fgets($file)."</td></tr>";
                    }
                    echo "</table>";

                    fclose($file);
                }

                function show_all_ref(){
                    // Create a list of references that the student can choose.

                    //Get the names of references' files (Get the name of user's files and delete thoses who are not references' files like "." and "..")
                    $file_names=scandir($GLOBALS["File"]["Data"].'/'.$_SESSION["User_id"].'/');
                    foreach($file_names as $file){
                        if(substr($file, 0, 3)!="ref"){
                            $file_names=array_diff($file_names,array($file));
                        }
                    }

                    //Show the content of references' files (if they are)
                    if(count($file_names)==0){
                        echo "Vous n'avez pas de références à choisir<br/>";
                        echo "Veuillez en créer<br/>";
                    } else {

                        //Ask what the student whant to do
                        echo "<div id=choice>";
                        echo "<form method='POST' action=#>";
                        echo "Veuillez indiquer l'email du Consultant auquel vous voulez envoyer les références séléctionnées :<input type='text' name='email'>";
                        echo "<button type=submit name='button_link'>Envoyer</button>";
                        echo "</div>";

                        //Give the user the ability to check his references
                        echo '<div id="intro">Veuillez sélectionner les références validées que vous souhaitez partager :</div>';
                        for($i=1; $i<count($file_names); $i++){
                            show_ref($i);
                        }
                        echo "</form>";

                        if(isset($_POST['button_link'])){

                            //Get validated references' id
                            $idref="";
                            for($i=1; $i<count($file_names); $i++){
                                if(isset($_POST[$i])){
                                    $idref.="&".$i."=on";
                                }
                            }

                            //Create absolute link
                            $relativLink = dirname($_SERVER['SCRIPT_NAME'])."/".$GLOBALS["File"]["Consultant"]["php"]."?email=".$_POST['email']."&button_link=".$idref;
                            $adresseSite = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
                            $adresseSite .= $_SERVER['HTTP_HOST'];
                            $completeadresse = $adresseSite . $relativLink;
                            
                            //Send the link
                            $to = $_POST['email'];
                            $from ="leprojetjeunes64@gmail.com";
                            $subject = "Partage de l'engagement d'un jeune";
                            $message = "Bonjour,\n
                            Un jeune vous partage son expérience !\n\n
                            Le projet Jeunes 6.4 a pour but de mettre en avant des expériences professionnelles auprès de recruteurs,
                            pour cela les jeunes font appel à leur référent de mission pour valider leurs missions et leurs compétences.\n
                            C'est là que vous intervenez ! Un jeune a choisi de vous partager sonexpérience. Vous pouvez consulter celle-ci en cliquant sur le lien ci-dessous :\n"
                            . $completeadresse;
                            $headers = ['From' => $from];
                            
                    
                            //Notice the user the status of the mail
                            if(mail($to, $subject, $message, $headers)){
                            echo "Le mail a bien été envoyé !";
                            }
                            else{
                            echo "Le mail n'a pas pu être envoyé ... Vous pouvez cependant copier ce lien et l'envoyer manuellement à votre référent : ";
                            echo "<a href='".$GLOBALS["File"]["Consultant"]["php"]."?email=".$_POST['email']."&button_link=".$idref."' id='link'>Lien vers la demande</a>";
                            echo "<button id='copyButton' onclick='copyLink()'>Copier le lien</button>";
                            }
                        }
                    }
                }

                show_all_ref();
                echo $BACK;
            }
            else echo "Vous n'avez pas la permission de consulter cette page";
        ?>
    </body>
</html>
