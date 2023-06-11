<?php

    //Information about the user
    $_SESSION["User_id"]="";

    //Files' name
    $GLOBALS["File"]["Data"]="Data";
    $GLOBALS["File"]["inData"][0]="user.txt";
    $GLOBALS["File"]["inData"][1]="refNumber.txt";
    $GLOBALS["File"]["inData"][2]="comRef";
        //Émilien
    $GLOBALS["File"]["Referent_welcome"]="";
    $GLOBALS["File"]["Referent_thanks"]="Remerciement_referent.php";
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
    $GLOBALS["File"]["Look_references"]["php"]="look_references.php";
    $GLOBALS["File"]["Print_references"]["php"]="print_references.php";
    $GLOBALS["File"]["Share_references"]["php"]="share_references.php";
    $GLOBALS["File"]["Print_references"]["js"]="createRefFile.js";
    $GLOBALS["File"]["Print_references"]["js_link"]="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js";

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
                    <td id="selectionjeune"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">JEUNE</a></td>
                    <td id="selectionreferent"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">RÉFÉRENT</a></td>
                    <td id="selectionconsultant"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">CONSULTANT</a></td>
                    <td id="selectionpartenaires"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][1].'">PARTENAIRES</a></td>
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
                    <td id="selectionjeune"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">JEUNE</a></td>
                    <td id="selectionreferent"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">RÉFÉRENT</a></td>
                    <td id="selectionconsultant"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">CONSULTANT</a></td>
                    <td id="selectionpartenaires"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][1].'">PARTENAIRES</a></td>
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
                    <td id="selectionjeune"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">JEUNE</a></td>
                    <td id="selectionreferent"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">RÉFÉRENT</a></td>
                    <td id="selectionconsultant"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">CONSULTANT</a></td>
                    <td id="selectionpartenaires"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][1].'">PARTENAIRES</a></td>
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
                    <td id="selectionjeune"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">JEUNE</a></td>
                    <td id="selectionreferent"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">RÉFÉRENT</a></td>
                    <td id="selectionconsultant"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][0].'">CONSULTANT</a></td>
                    <td id="selectionpartenaires"><a href="'.$GLOBALS["File"]["Visitor_welcome"]["php"][1].'">PARTENAIRES</a></td>
                </tr>
            </table>
        </div>
    </form>';
?>
