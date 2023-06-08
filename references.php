<!DOCTYPE html>

<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script type="text/javascript" src="createRefFile.js"></script>
        <title>Mes références</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <h1>Mes références</h1>
        <div id="alert"><!--Space to notice if a page or a file has been created or not--></div>

        <?php

        //!Constantes sensées être obtenue plus tôt... J'ai supposées qu'elles seraient sous ce format...!
        $_GET["folder"]="Data";
        $_GET["user_id"]="001";
        $_GET["user_content"]=array (
            0 => "Nom",
            1 => "Prénom",
            2 => "Date de naissance",
            3 => "E-mail"
        );
        $_GET["ref_content"]=array (
            0 => "Description",
            1 => "Durée",
            2 => "Milieu",
            3 => "Données personnelles du référent",
            4 => "Adresse e-mail du référent",
            5 => "Savoirs-êtres acquis"
        );
        
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

            //Open the reference's file
            $ref_id="ref".nb_zero($i).$i.".txt";
            $file=fopen($_GET["folder"].'/'.$_GET["user_id"].'/'.$ref_id, 'r');

            //Check if the reference has been validated by the referent
            $first_lig=fgets($file);
            /*echo $first_lig."<br/>";
            //$first_lig=preg_replace('/[\xOO-\x1F\x8O-\xFF]/', ",$first_lig");
            //echo gettype($first_lig)."<br/>";
            if(strpos($first_lig, "\n")!=false){
                echo "ui"."<br/>";
            } else {
                echo "nion"."<br/>";
            }
            if($first_lig=="0\n" || $first_lig=="0"){
                echo "no !"."<br/>";
                echo '<input type="checkbox" id="'.$ref_id.'" name="'.$i.'" hidden>'; //To avoid problems with the js code
                return FALSE;
            } else {
                echo "si !"."<br/>";
            }*/

            $status_div="";
            $status_check="";
            //Hide somme tag for the consultant (when a link is created)
            if(isset($_GET['button_link'])){
                $status_check="hidden";
                if(!isset($_GET[$i])){
                    $status_div="hidden";
                }
            }

            echo '<input type="checkbox" id="'.$ref_id.'" name="'.$i.'" '.$status_check.'>';
            echo "<div id='text_".$ref_id."' ".$status_div.">"."<table>";
            foreach($_GET["ref_content"] as $ref_content){
                
                //List of knowledge (last line of references' files) has to be displayed with the show_list_of_knowledge function
                if(array_search($ref_content, $_GET["ref_content"])==count($_GET["ref_content"])-1){
                    echo "<tr><td>".$ref_content."</td><td>";
                    show_list_of_knowledge(fgets($file));
                    echo "</td></tr>";

                //The content of reference's file
                } else {
                    echo "<tr><td>".$ref_content."</td><td>".fgets($file)."</td></tr>";
                }
            }

            //Add the referent's comment if there are
            if(file_exists($_GET["folder"].'/'.$_GET["user_id"].'/'."comRef".nb_zero($i).$i.".txt")){
                fclose($file);
                $file=fopen($_GET["folder"].'/'.$_GET["user_id"].'/'."comRef".nb_zero($i).$i.".txt", 'r');

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

            //Open the user's file
            $file=fopen($_GET["folder"]."/".$_GET["user_id"]."/user.txt", 'r');

            //Write the content of user's file
            echo "<table>";
            foreach($_GET["user_content"] as $user_content){
                echo "<tr><td>".$user_content."</td><td>".fgets($file)."</td></tr>";
            }
            echo "</table>";

            fclose($file);
        }

        function show_all_ref(){
            // Create a list of references that the student can choose.

            //Get the names of references' files (Get the name of user's files and delete thoses who are not references' files like "." and "..")
            $file_names=scandir($_GET["folder"].'/'.$_GET["user_id"].'/');
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

                $status_choice="";
                $status_description="hidden";

                //Hide or display somme tag for the consultant (when a link is created)
                if(isset($_GET['button_link'])){
                    $status_choice="hidden";
                    $status_description="";
                }

                //Show a description of the project to the consultant
                echo "<div ".$status_description."><h3>Descritpion du projet</h3></div>";

                //Show the user's data to the consultant
                echo "<div ".$status_description.">";
                echo "<h3>Description du l'étudiant</h3>";
                show_student();
                echo "</div>";

                echo "<h3 ".$status_description.">Voici les références de l'étudiant</h3>";

                //Ask what the student whant to do
                echo "<div id=choice ".$status_choice.">";
                    //If he want to print references : ask the user the format (HTML or PDF)
                echo "Créer un fichier avec les références séléctionnée :";
                echo '<input type="radio" name="drone" value="HTML" id="HTML" checked><label for="HTML">HTML</label>';
                echo '<input type="radio" name="drone" value="PDF" id="PDF"><label for="PDF">PDF</label>';
                echo "<button name='boutton' id='valider' value='".count($file_names)."' onclick='create_file()'>Valider</button>";
                    //If he want to send references to the consultants
                echo "<form method='GET'>";
                echo "Créer un lien à envoyer au consultant : ";
                echo "<button type=submit name='button_link'>Valider</button>";
                echo "</div>";

                //Give the user the ability to check his references
                echo '<div id="intro" '.$status_choice.'>Voici les références que vous pouvez choisir :</div>';
                for($i=1; $i<=count($file_names); $i++){
                    show_ref($i);
                }
                echo "</form>";
            }
        }

        show_all_ref();

        ?>

    </body>
</html>