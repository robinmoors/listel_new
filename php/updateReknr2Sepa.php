<?php

//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------



// voor iedereen: naam, voornaam, functie, organisatie, contactadres, gemeente, tel, fax, gsm, email

// voor zvl: riziv + rekeningnummer (niet direct verplicht)

// voor zelfstandige hvl, xvlp: rekeningnummer (verplicht)



$paginanaam="update bankrek";



if ( isset($_SESSION["toegang"] ) && ($_SESSION["toegang"]=="toegestaan") )

    {

    require("../includes/html_html.inc");

    print("<head>");

    print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");



    require("../includes/html_head.inc");

    require("../includes/checkForNumbersOnly.inc");

    require("../includes/checkCheque.inc");
?>


<style type="text/css">
 .mainblock { height: auto;}
</style>

<?php
    print("</head>");

    print("<body ooonload=\"hideCombo('IIPostCodeS');pasFormAan();\">");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");



    require("../includes/header.inc");

    require("../includes/kruimelpad.inc");



    print("<div class=\"contents\">");



    require("../includes/menu.inc");



    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");


    $qryHVL = "select id, reknr, bic, iban from hulpverleners where reknr is not null";
    $result = mysql_query($qryHVL) or die("$qryHVL " . mysql_error());;
    
    for ($i=0; $i < mysql_num_rows($result); $i++) {
       $records = mysql_fetch_assoc($result);

                $valReknr1=         substr($records['reknr'],0,3);
                $valReknr2=         substr($records['reknr'],4,7);
                $valReknr3=         substr($records['reknr'],12,2);

                $valBIC = $records['bic'];
                $valIBAN = $records['iban'];

                if ($valIBAN == "" && $valReknr2 > 0) {
                   // effe IBAN en BIC berekenen
                   $valBIC = bankcode2bic($valReknr1);

                   $eersteGetal = "{$valReknr3}{$valReknr3}111400";
                   $modulo97 = fmod($eersteGetal,97);
                   $controleIBAN = 98-$modulo97;
                   if ($controleIBAN < 10)
                     $valIBAN = "BE0". "{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                   else
                     $valIBAN = "BE{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                $updateQry = "update hulpverleners set iban = '$valIBAN', bic = '$valBIC' where id = {$records['id']}";
                mysql_query($updateQry) or die("$updateQry " . mysql_error());
                print("update ZVL/HVL {$records['id']}");
                }

    }

    $qryHVL = "select id, reknr, bic, iban from organisatie where reknr is not null";
    $result = mysql_query($qryHVL) or die("$qryHVL " . mysql_error());;

    for ($i=0; $i < mysql_num_rows($result); $i++) {
       $records = mysql_fetch_assoc($result);
                $valReknr1=         substr($records['reknr'],0,3);
                $valReknr2=         substr($records['reknr'],4,7);
                $valReknr3=         substr($records['reknr'],12,2);

                $valBIC = $records['bic'];
                $valIBAN = $records['iban'];

                if ($valIBAN == "" && $valReknr2 > 0) {
                   // effe IBAN en BIC berekenen
                   $valBIC = bankcode2bic($valReknr1);

                   $eersteGetal = "{$valReknr3}{$valReknr3}111400";
                   $modulo97 = fmod($eersteGetal,97);
                   $controleIBAN = 98-$modulo97;
                   if ($controleIBAN < 10)
                     $valIBAN = "BE0" . "{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                   else
                     $valIBAN = "BE{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                $updateQry = "update organisatie set iban = '$valIBAN', bic = '$valBIC' where id = {$records['id']}";
                mysql_query($updateQry) or die("$updateQry " . mysql_error());
                print("update ORG {$records['id']}");
                }

    }








    print("</div>");

    print("</div>");

    print("</div>");



    include("../includes/footer.inc");



    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>