<!DOCTYPE html>

<html>
    <head>
        <script type="text/javascript" src="references.js"></script>
        <title>Mes références</title>
        <meta charset="utf-8">
    </head>
    
    <body>
        <h1>Mes références</h1>

        <?php

        $_GET["folder"]="Data";
        $_GET["user_id"]="003";
        $_GET["ref_content"]=array (
            0 => "Descritpion",
            1 => "Durée",
            2 => "Milieu",
            3 => "Données personnelles du référent",
            4 => "Adresse e-meil du référent",
            5 => "Liste des savoirs-êtres et savoirs-faire démontrés durant l'engagement"
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
                    if($list[$i]=='0'){ //No : create an uncheck checkbox.
                        echo '<input type="checkbox" disabled>';
                    } elseif($list[$i]=='1') { //Yes : create a check checkbox.
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

            echo "<table>";
            echo "<td><tr>".'<input type="checkbox" value="'.$ref_id.'">'."</tr></td>";
            foreach($_GET["ref_content"] as $ref_content){
                if(array_search($ref_content, $_GET["ref_content"])==count($_GET["ref_content"])-1){ //List of knowledge has to be displayed with the show_list_of_knowledge function.
                    echo "<tr><td>".$ref_content."</td><td>";
                    show_list_of_knowledge(fgets($file));
                    echo "</td></tr>";
                } else {
                    echo "<tr><td>".$ref_content."</td><td>".fgets($file)."</td></tr>";
                }
            }
            echo "</table>";
            echo "</br>";

            fclose($file);
        }

        function show_all_ref(){
            //Create a list of references that the student can choose.
            
            //Get the file of references' names
            $file_names=scandir($_GET["folder"].'/'.$_GET["user_id"].'/');
            $file_names=array_diff($file_names,[".","..","user.txt"]);

            //Show the content of references' files (if they are)
            if(count($file_names)==0){
                echo "Vous n'avez pas de références à choisir<br/>";
                echo "Veuillez en créer<br/>";
            } else {
                echo 'Voici les références que vous pouvez choisir :<br/><br/>';
                echo "<form method='post' action='javascript:create_PDF()'>";
                foreach($file_names as $ref_id){
                    show_ref($ref_id);
                }
                echo "<button type='submit' name='boutton'>Valider</button>";
                echo "</form>";
            }
        }

        show_all_ref();

        ?>

    </body>
</html>