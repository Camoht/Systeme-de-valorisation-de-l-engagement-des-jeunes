<?php
    
    function empty_field(){
        //Function verifying if the fields are empty or not.
        //return 0 is all the fields are filled and 1 if they are not

        if ($_POST["name"]==""){
            return 1;
        }
        else if ($_POST["surname"]==""){
            return 1;
        }
        else if ($_POST["birth"]==""){
            return 1;
        }
        else if ($_POST["email"]==""){
            return 1;
        }
        else if ($_POST["password"]==""){
            return 1;
        }
        else {
            return 0;
        }
    }

    
    function format_date(){
        //Function verifying if the birth date given by the user is on the dd/mm/yyyy format
        //Return 0 if the date format is correct and 1 if it is not

        if(strlen($_POST["birth"])!=10){
            return 1;
        }
        else{
            list($day, $month, $year) = explode('/', $_POST["birth"]);

            if (checkdate($month, $day, $year)==""){
                return 1;
            }
            else{
                return 0;
            }
        }
    }

    
    function reused_mail (){
        //Function verifiyng if the email adress given by the user is already used on another account
        //Return 0 if the adress email isn't used by someone else and 1 if it is

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
            if($mail==$_POST["email"]){
                return 1;
            }
        }
        return 0;
    }


    function format_mail (){
        //Function verifiyng if the email adress given by the user is usable
        //Return 0 if the email adress is usable and 1 if unusable

        if(stristr($_POST["email"], '@')=="") {
            return 1;
        }
        if(stristr($_POST["email"], '.')=="") {
            return 1;
        }
        else{
            return 0;
        }
    } 


    //Display error notes if the linked functions return 1
    if (empty_field()==1){
        echo"Le remplissage de tous les champs est obligatoire. <br/>";
    }
    if (format_date()==1){
        echo"Vous devez écrire votre date de naissance au format suivant : dd/mm/aaaa <br/>";
    }
    if (reused_mail()==1){
        echo"L'adresse email est déjà utilisée par un autre compte. <br/>";
    }
    if (format_mail()==1){
        echo"L'adresse email fournie est erronée. <br/>";
    }



?>