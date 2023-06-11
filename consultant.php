<html>
    <head>
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Consultant"].'>';
        ?>

        <title>Consultant</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <div id="alert"><!--Space to notice if an email has been sent or not--></div>

        <?php

        echo $BANDEAUCONSULTANT;
        session_start();
        
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

            //Don't read first line (corresponding to validated or not)
            $first_lig=fgets($file);

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
            // Create a list of references to show.

            //Display a description of the project
            echo
            "<div>
                <h3>Description du site</h3>
                Bienvenue sur le site internet Jeune6.4 ! <br/>
                Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...). <br/>
                Un jeune souhaite vous faire part de ses expériences. <br/>
            </div>";

            //Display the student's data
            echo "<div>";
            echo "<h3>Description du jeune</h3>";
            show_student();
            echo "</div>";

            //Get the names of references' files (Get the name of user's files and delete thoses who are not references' files, like "." and "..")
            $file_names=scandir($GLOBALS["File"]["Data"].'/'.$_SESSION["User_id"].'/');
            foreach($file_names as $file){
                if(substr($file, 0, 3)!="ref"){
                    $file_names=array_diff($file_names,array($file));
                }
            }

            //Get validated references' id
            echo "<h3>Voici ses références</h3>";
            for($i=1; $i<count($file_names); $i++){
                if(isset($_GET[$i])){
                    show_ref($i);
                }
            }
        }

        show_all_ref();
        ?>
    </body>
</html>