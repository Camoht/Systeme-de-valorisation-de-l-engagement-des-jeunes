<?php
    session_start();

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
        </div>"
    </form>';

    //Information about the user
    $_SESSION["User_id"]="";

    //Text ??
    $_SESSION["Text"]["Visitor"]="
    Bienvenue sur le site internet Jeune6.4 !
    Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...).
    Ils peuvent demander aux référents de confirmer leurs expèriences et les savoirs-êtres obtenus, imprimer ses mêmes références ou inviter quelqu'un à les consuter.
    Un référent peut quant à lui valoriser un jeune et son expèrience.
    Le consultant ne peut que consluter les expèriences des jeunes.
    ";
    
    $_SESSION["Text"]["Ask_reference"]="
    Bienvenue sur le site internet Jeune6.4 !
    Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...).
    Un jeune vous a identifié comme son référent.
    Veuillez cliquer sur le lien ci-dessous pour confirmer et valoriser son expèrience.
    ";

    $_SESSION["Text"]["Show_reference"]="
    Bienvenue sur le site internet Jeune6.4 !
    Ce site permet aux jeunes de mettre en avant leurs expèriences professionnels (stages, bénévolats, etc...).
    Un jeune souhaite vous faire part de ses expèriences.
    Veuillez cliquer sur le lien ci-dessous pour les découvrir.
    ";

    $_SESSION["Text"]["Thanks_Referent"]="
    <h3> Vous avez validé la référence. Merci pour votre participation ! </h3>
    ";

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
        //Émilien
    $_SESSION["Files"]["css"]["Student"]="student.css";
        //Nathan
    $_SESSION["Files"]["Ask_reference"]["php"]="request.php";
    $_SESSION["Files"][""]["js"]="link.js";
    $_SESSION["Files"][""]["js"]="checkboxes.js";
        //Xavier
    $_SESSION["Files"]["Create_account"]["php"]="createaccount.php";
    $_SESSION["Files"]["Create_account"]["js"]="createaccount.js";
        //Camille
    $_SESSION["Files"]["Print_references"]["php"]="references.php";
    $_SESSION["Files"]["Print_references"]["js"]="createRefFile.js";

?>