<?php

    //HTML ofter used
    $BANDEAUJEUNE='     
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

    $BANDEAUREFERENT='
    <div class="bandeau">
        <table class="entete">
            <tr id="referent">
                <td>RÉFÉRENT</td>
            </tr>
            <tr id="valeuramonengagement">
                <td>Je confirme la valeur de ton engagement</td>
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

    $BANDEAUCONSULTANT='
    <div class="bandeau">
        <table class="entete">
            <tr id="consultant">
                <td>CONSULTANT</td>
            </tr>
            <tr id="valeuramonengagement">
                <td>Je donne de la valeur à ton engagement</td>
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

    $BANDEAUPARTENAIRES='
    <div class="bandeau">
        <table class="entete">
            <tr id="partenaires">
                <td>PARTENAIRES</td>
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
    $_SESSION["User_id"]="";

    //Files' name
    $GLOBALS["File"]["Data"]="Data";
    $GLOBALS["File"]["inData"][0]="user.txt";
    $GLOBALS["File"]["inData"][1]="refNumber.txt";
    $GLOBALS["File"]["inData"][2]="comRef";
        //Émilien
    $GLOBALS["File"]["Referent_welcome"]["html"]="HTML REFERENT remerciement.html";
    $GLOBALS["File"]["css"]["Student"]="student.css";
    $GLOBALS["File"]["css"]["Referent"]="referent.css";
    $GLOBALS["File"]["css"]["Consultant"]="consultant.css";
    $GLOBALS["File"]["css"]["Partenaire"]="partenaires.css";
        //Nathan
    $GLOBALS["File"]["Student_welcome"]["html"]="";
    $GLOBALS["File"]["Ask_reference"]["php"]="request.php";
    $GLOBALS["File"]["Ask_reference"]["js"][0]="link.js";
    $GLOBALS["File"]["Ask_reference"]["js"][1]="checkboxes.js";
        //Xavier
    $GLOBALS["File"]["Visitor_welcome"]["php"][0]="visitor_objectives.php";
    $GLOBALS["File"]["Visitor_welcome"]["php"][1]="visitor_partners.php";
    $GLOBALS["File"]["Create_account"]["php"]="createaccount.php";
    $GLOBALS["File"]["Create_account"]["js"]="createaccount.js";
    $GLOBALS["File"]["Connect"]["php"]="connect.php";
    $GLOBALS["File"]["Connect"]["js"]="connect.js";
    $GLOBALS["File"]["Student_welcome"]["php"]="connected.php";
    $GLOBALS["File"]["Change_profil"]["js"]="profile.js";
    $GLOBALS["File"]["Change_profil"]["php"]="profile.php";
        //Camille
    $GLOBALS["File"]["Consultant_welcome"]["html"]="";
    $GLOBALS["File"]["Print_references"]["php"]="references.php";
    $GLOBALS["File"]["Print_references"]["js"]="createRefFile.js";
    $GLOBALS["File"]["Print_references"]["js_link"]="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js";

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
?>
