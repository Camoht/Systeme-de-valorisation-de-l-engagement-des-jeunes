<?php

    include 'constants.php';

    function in_table($tab, $id){
        //So javascript code can get information from php

        foreach ($tab as $key => $value){
            //Explore information's variables in php
            if(gettype($value)=="array"){
                $new_id=$id."[".$key."]";
                in_table($value, $new_id);
            } else {
                //Convert in HTML so Javascript can get it
                echo '<div id='.'$GLOBALS[File]'.$id."[".$key."]>".$value.'</div>';
            }
        }
    }

    echo '<div hidden id=Files_names>';
    in_table($GLOBALS["File"], "");
    echo '</div>';
?>