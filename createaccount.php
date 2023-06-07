<?php
/*    if (isset($_POST)){

        $name2=$_POST["name"]."panda";
        echo "name2 : ".$name2."<br/>";

        echo "name : ".$_POST["name"]."<br/>";
        echo "surname : ".$_POST["surname"]."<br/>";
        echo "birth : ".$_POST["birth"]."<br/>";
        echo "email : ".$_POST["email"]."<br/>";
        echo "couou";
    }
    if ($request == 2){
        echo "booto";
    }*/

    $_POST["name"]="char";
    $_POST["surname"]="";
    $_POST["birth"]="azertyuiop";

    $_POST["email"]="azertyu@gmail.com";


    function empty_field(){
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
        else {
            return 0;
        }
    }

    function format_date(){
        echo strlen($_POST["birth"]);
        if(strlen($_POST["birth"])!=10){
            return 1;
        }
        else{
            list($day, $month, $year) = explode('/', $_POST["birth"]);

            if (checkdate($month, $day, $year)==0){
                return 1;
            }
            else{
                return 0;
            }
        }
    }


    function reused_mail (){
        $folder_names=scandir('Data/');
        $folder_names=array_diff($folder_names,[".",".."]);
        

        foreach ($folder_names as $user_id){
            $file=fopen("Data/".$user_id."/user.txt", 'r');
            for($i=0; $i<3; $i++){
                fgets($file);
            }
            $mail=fgets($file);
            if($mail==$_POST["email"]){
                return 1;
            }
        }
        return 0;
    }




    if (reused_mail()==0){
        echo"bananana";
    }
    else{
        echo"nooOOOoooOOOO";
    }



?>