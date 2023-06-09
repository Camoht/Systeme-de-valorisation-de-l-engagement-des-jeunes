<?php
    
    function empty_field(){
        //Function verifying if the fields are empty or not.
        //return 0 is all the fields are filled and 1 if they are not

        if ($_POST["email"]==""){
            return 1;
        }
        else if ($_POST["password"]==""){
            return 1;
        }
        else {
            return 0;
        }
    }

    

    
    function Valid_logs (){

        $folder_names=scandir('Data/');
        $folder_names=array_diff($folder_names,[".",".."]);
        
        //Explore data files
        foreach ($folder_names as $user_id){
            $file=fopen("Data/".$user_id."/user.txt", 'r');

            //Skip the useless informations in data files
            for($i=0; $i<3; $i++){
                fgets($file);
            }
            
            //Get the already used email adresses to compare with the one the user wrote
            $mail=fgets($file);
            if($mail==$_POST["email"] || $mail==$_POST["email"]."\n"){
                $password=fgets($file);
                if($password==$_POST["password"] || $password==$_POST["password"]."\n"){
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


?>