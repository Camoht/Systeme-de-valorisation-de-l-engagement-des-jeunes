<?php

    //HTML ofter used
    $_SESSION["BANDEAU"]='
    <div class="bandeau">
        <table class="entete">
            <tr id="jeune">
                <td>JEUNE</td>
            </tr>
            <tr id="valeuramonengagement">
                <td>Je donne de la valeur à mon engagement</td>
            </tr>
        </table>
    </div>
    <form method="POST" action="#">
        <div class="selection">
            <table class="selection tab">
                <tr>
                    <td id="selectionjeune">JEUNE</td>
                    <td id="selectionreferent"> RÉFÉRENT </td>
                    <td id="selectionconsultant"> CONSULTANT </td>
                    <td id="selectionpartenaires"> PARTENAIRES </td>
                </tr>
            </table>
        </div>
    </form>';

    //Information about the user
    $_SESSION["User_id"]="001";

    //Text
    /*$_SESSION["Text"]["Visitor"]="
    Bienvenue sur le site internet Jeune6.4 ! <br/>
    Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...). <br/>
    Ils peuvent demander aux référents de confirmer leurs expèriences et les savoirs-êtres obtenus, imprimer ses mêmes références ou inviter quelqu'un à les consuter. <br/>
    Un référent peut quant à lui valoriser un jeune et son expèrience. <br/>
    Le consultant ne peut que consluter les expèriences des jeunes. <br/>
    ";
    
    $_SESSION["Text"]["Ask_reference"]="
    Bienvenue sur le site internet Jeune6.4 ! <br/>
    Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...). <br/>
    Un jeune vous a identifié comme son référent. <br/>
    Veuillez cliquer sur le lien ci-dessous pour confirmer et valoriser son expèrience. <br/>
    ";

    $_SESSION["Text"]["Show_reference"]="
    Bienvenue sur le site internet Jeune6.4 ! <br/>
    Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...). <br/>
    Un jeune souhaite vous faire part de ses expèriences. <br/>
    Veuillez cliquer sur le lien ci-dessous pour les découvrir. <br/>
    ";

    $_SESSION["Text"]["Thanks_Referent"]="
    <h3> Vous avez validé la référence. Merci pour votre participation ! </h3>
    ";
    */

    //Asked field
    $_SESSION["Ask"]["User"]=array (
        0 => "Nom",
        1 => "Prénom",
        2 => "Date de naissance",
        3 => "E-mail"
    );

    $_SESSION["Ask"]["Reference"]=array (
        0 => "Description",
        1 => "Durée",
        2 => "Milieu",
        3 => "Données personnelles du référent",
        4 => "Adresse e-mail du référent",
        5 => "Savoirs-êtres acquis"
    );

    //Files
    $_SESSION["Files"]["Data"]="Data";
    $_SESSION["Files"]["inData"][0]="user.txt";
    $_SESSION["Files"]["inData"][1]="refNumber.txt";
        //Émilien
    $_SESSION["Files"]["Referent_welcome"]["html"]="HTML REFERENT remerciement.html";
    $_SESSION["Files"]["css"]["Student"]="student.css";
        //Nathan
    $_SESSION["Files"]["Student_welcome"]["html"]="";
    $_SESSION["Files"]["Ask_reference"]["php"]="request.php";
    $_SESSION["Files"]["Ask_reference"]["js"][0]="link.js";
    $_SESSION["Files"]["Ask_reference"]["js"][1]="checkboxes.js";
        //Xavier
    $_SESSION["Files"]["Visitor_welcome"]["html"]="";
    $_SESSION["Files"]["Create_account"]["php"]="createaccount.php";
    $_SESSION["Files"]["Create_account"]["js"]="createaccount.js";
        //Camille
    $_SESSION["Files"]["Cansultant_welcome"]["html"]="";
    $_SESSION["Files"]["Print_references"]["php"]="references.php";
    $_SESSION["Files"]["Print_references"]["js"]="createRefFile.js";
    $_SESSION["Files"]["Print_references"]["js_link"]="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js";

?>