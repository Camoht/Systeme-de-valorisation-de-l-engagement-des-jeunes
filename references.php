<!DOCTYPE html>

<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
        <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
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
        $_GET["user_id"]="003";
        $_GET["ref_content"]=array (
            0 => "Description",
            1 => "Durée",
            2 => "Milieu",
            3 => "Données personnelles du référent",
            4 => "Adresse e-meil du référent",
            5 => "Savoirs-êtres et savoirs-faire démontrés durant l'engagement"
        );

        function show_list_of_knowledge($list){
            //Create a table to show the list of knowledge.
            //$list : (char) the line in the reference's file containing the list of knowledge (format : "knowledge1:1,knowledge2:0")

            echo "<table><td><tr>";
            for($i=0;$i<strlen($list);$i++){
                if($list[$i]==','){ //Separating knowledges
                    echo "</tr></td><td>";

                } elseif($list[$i]!=':'){ //Knowledge
                    echo $list[$i];

                } else { //Is the knowledge validated by the referer ?
                    $i++;
                    if($list[$i]=='0'){ //No : create an uncheck checkbox
                        echo '<input type="checkbox" disabled>';
                    } elseif($list[$i]=='1') { //Yes : create a check checkbox
                        echo '<input type="checkbox" checked disabled>';
                    }
                }
            }
            echo "</tr></td></table>";
        }

        function show_ref($ref_id){
            //Show the content of reference's file.
            //$ref_id : (char) the name of the file.

            $file=fopen($_GET["folder"].'/'.$_GET["user_id"].'/'.$ref_id, 'r');

            echo '<input type="checkbox" id="'.$ref_id.'">'."<div id='text_".$ref_id."'><table>";
            echo "<th></th>";
            foreach($_GET["ref_content"] as $ref_content){
                if(array_search($ref_content, $_GET["ref_content"])==count($_GET["ref_content"])-1){ //List of knowledge (last line of references' files) has to be displayed with the show_list_of_knowledge function.
                    echo "<tr><td>".$ref_content."</td><td>";
                    show_list_of_knowledge(fgets($file));
                    echo "</td></tr>";
                } else {
                    echo "<tr><td>".$ref_content."</td><td>".fgets($file)."</td></tr>";
                }
            }
            echo "</table></div>";
            echo "</br>";

            fclose($file);
        }

        function show_all_ref(){
            //Create a list of references that the student can choose.
            
            //Get the names of references' file
            $file_names=scandir($_GET["folder"].'/'.$_GET["user_id"].'/');
            $file_names=array_diff($file_names,[".","..","user.txt"]);

            //Show the content of references' files (if they are)
            if(count($file_names)==0){
                echo "Vous n'avez pas de références à choisir<br/>";
                echo "Veuillez en créer<br/>";
            } else {
                echo '<div id="intro">Voici les références que vous pouvez choisir :</div><br/><br/>';
                echo "<form method='post' action='javascript:create_file()'>";
                foreach($file_names as $ref_id){
                    show_ref($ref_id);
                }

                //Ask the user the format (HTML or PDF).
                echo "<div id=choice>";
                echo '<input type="radio" name="drone" value="HTML" id="HTML" checked><label for="HTML">HTML</label>';
                echo '<input type="radio" name="drone" value="PDF" id="PDF"><label for="PDF">PDF</label>';
                echo "<button type='submit' name='boutton' id='valider' value='".count($file_names)."'>Valider</button>";
                echo "</form>";
                echo "</div>";
            }
        }

        show_all_ref();

        ?>

    </body>
</html>