<?php
    if (isset($_POST)){

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
    }

?>