<?php
    
    function empty_field(){
        //Function verifying if the fields are empty or not.
        //return 0 is all the fields are filled and 1 if they are not

        if ($_POST["name"]=="" || $_POST["surname"]=="" || $_POST["birth"]=="" || $_POST["email"]=="" || $_POST["password"]==""){
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

        //Explore data files
        $folder_names=scandir('Data/');
        $folder_names=array_diff($folder_names,[".",".."]);
        foreach ($folder_names as $user_id){
            $file=fopen("Data/".$user_id."/user.txt", 'r');

            //Skip the useless informations in data files
            for($i=0; $i<3; $i++){
                fgets($file);
            }

            //Get the already used email adresses to compare with the one the user wrote
            $mail=fgets($file);
            if($mail==$_POST["email"]."\n"){
                return 1;
            }

        }
        return 0;
    }


    function format_mail (){
        //Function verifiyng if the email adress given by the user is usable
        //Return 0 if the email adress is usable and 1 if unusable

        if(stristr($_POST["email"], '@')=="" || stristr($_POST["email"], '.')=="") {
            return 1;
        }
        else{
            return 0;
        }
    } 

    function nb_zero($i){
        // Use to create a number with 3 figures.
        // i : (int) between 1 and 999.
        // Return "00", "0" or "" depending on i's number of figures (string).
    
        if($i<10){
            return "00";
        } else if($i<100){
            return "0";
        } else {
            return "";
        }
    }

    //Display error notes if the linked functions return 1
    if (empty_field()==1){
        echo"Le remplissage de tous les champs est obligatoire. <br/>";
    }
    else if (format_date()==1){
        echo"Vous devez écrire votre date de naissance au format suivant : dd/mm/aaaa <br/>";
    }
    else if (reused_mail()==1){
        echo"L'adresse email est déjà utilisée par un autre compte. <br/>";
    }
    else if(format_mail()==1){
        echo"L'adresse email fournie est erronée. <br/>";
    }
    else{
        //Create the data file of the new user
        $folder_names=scandir($_SESSION["Files"]["Data"].'/');
        $folder_names=array_diff($folder_names,[".",".."]);
        $users_number=count($folder_names)+1;
        mkdir($_SESSION["Files"]["Data"]."/".nb_zero($users_number).$users_number, 0777);
        $file = fopen($_SESSION["Files"]["Data"]."/".nb_zero($users_number).$users_number."/".$_SESSION["Files"]["inData"][0], 'w');

        //Fill the new file with data
        fwrite($file, $_POST["name"]."\n".$_POST["surname"]."\n".$_POST["birth"]."\n".$_POST["email"]."\n".$_POST["password"]);
    }
?>