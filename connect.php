<html>
    <head>
        <?php
        //Include some files
        include 'constants.php';
        echo '<link rel="stylesheet" type="text/css" href='.$GLOBALS["File"]["css"]["Student"].'>';
        echo '<script type="text/javascript" src='.$GLOBALS["File"]["Connect"]["js"].'></script>';
        ?>

        <title>Se connecter</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            echo $BANDEAUJEUNE; 
            include 'constants_js.php';
        ?>
        <form id="choice">
            <div class="cadre">
                <table class="texte">
                    <tr>
                        <td>EMAIL: </td>
                        <td><input type='text' name='email' id="email"/></td>
                    </tr>
                    <tr>
                        <td>MOT DE PASSE: </td>
                        <td><input type='text' name='password' id="password"/></td>
                    </tr>
                        <td><button type='submit' name='submit'>Envoyer</button></td>
                </table>
            </div>
        </form>

        <?php

        if(isset($_POST["email"])){
            function empty_field(){
                //Function verifying if the fields are empty or not.
                //Return 0 is all the fields are filled and 1 if they are not

                if ($_POST["email"]=="" || $_POST["password"]==""){
                    return 1;
                }
                else {
                    return 0;
                }
            }
            
            function Valid_logs (){
                //Check if the logs are valid
                //Return 0 if the log are valids, and 1 if not

                //Explore data files
                $folder_names=scandir($GLOBALS["File"]["Data"].'/');
                $folder_names=array_diff($folder_names,[".",".."]);
                foreach ($folder_names as $user_id){
                    $file=fopen($GLOBALS["File"]["Data"]."/".$user_id."/".$GLOBALS["File"]["inData"][0], 'r');

                    //Skip the useless informations in data files
                    for($i=0; $i<3; $i++){
                        fgets($file);
                    }
                    
                    //Get the already used email adresses to compare with the one the user wrote
                    $mail=trim(fgets($file));
                    if($mail==trim($_POST["email"]) || $mail==trim($_POST["email"])."\n"){
                        $password=fgets($file);
                        if($password==$_POST["password"] || $password==$_POST["password"]."\n"){
                            //Fill globals variables to register the user's id
                            session_start();
                            $_SESSION["User_id"]=$user_id;
                            return 0;
                        }
                        return 1;
                    }
                }
                return 1;
            }

            //Display error notes if the linked functions return 1
            if (empty_field()==1){
                echo"Le remplissage de tous les champs est obligatoire. <br/>";
            }
            else if (Valid_logs()==1){
                echo"Votre adresse email ou votre mot de passe est incorrect. <br/>";
            }
            else {
                header('Location: '.$GLOBALS["File"]["Student_welcome"]["php"]);
                exit();
            }
        }
        ?>
    </body>
</html>