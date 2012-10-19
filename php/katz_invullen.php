<?php

$magAltijd = true;
//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------

    session_start();

    $paginanaam="KATZ-score";





// als evalID gezet is in GET of POST, is het een evaluatie-katz, anders overleg-katz
// behalve wanneer het menos gezet als _GET



//include("../includes/toonSessie.inc");





    // eerst nakijken of er een code is meegegeven én of die code bestaat

    // als er geen code ingegeven is, kijken we naar toegang

    if (isset($_GET['code'])) {
       $qryCode = "select * from overleg where logincode = \"{$_GET['code']}\"";

       if ($codeResult = mysql_query($qryCode)) {

          if (mysql_num_rows($codeResult) == 1) {

            $codeRij = mysql_fetch_array($codeResult);

            $overlegID = $codeRij['id'];

            $_SESSION['pat_code'] = $codeRij['patient_code'];

            if (isset($codeRij['katz_id'])) $overlegInfo['katz_id'] = $codeRij['katz_id'];

            $goedeCode = true;

            $_SESSION['binnenViaCode'] = true;
            $binnenViaCode = true;

          }

       }

       else {

         die("stomme code-query  $qryCode");

       }

    }



    if ($_SESSION['binnenViaCode'] || $binnenViaCode || (isset($_GET['code']) && $goedeCode) || (!isset($_GET['code']) && isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan")))

        {

        if (isset($_GET['menosPeople'])) {
          $katzRetour = "overleg_alles.php?tab=Attesten";
          $tabel = "overleg";
          $overlegGenreVoorwaarde = " bl.overleggenre = 'menos' AND ";
          $katzRetour = "overleg_alles.php?tab=Attesten";
          require("../includes/patientoverleg_geg.php");
        }
        else if (isset($_GET['menos'])) {
          $katzRetour = "patient_menos_vragen.php?code={$_SESSION['pat_code']}";
          $overlegID = 0;
          $tabel = "patient_menos";
          $overlegGenreVoorwaarde = " bl.overleggenre = 'menos' AND ";
        }
        else if (isset($_GET['evalID'])) {
          $katzRetour = "fill_evaluatie_01.php?id={$_GET['evalID']}";
          $overlegInfo = mysql_fetch_array(mysql_query("select id, patient, katz_id from evaluatie
                                                        where id = {$_GET['evalID']}"));
          $patientInfo = mysql_fetch_array(mysql_query("select patient.*, deelvzw from patient inner join gemeente on gem_id = gemeente.id
                                                        where code = \"{$overlegInfo['patient']}\""));
          $overlegID =  $_GET['evalID'];
          $tabel = "evaluatie";
        } else if (isset($_POST['evalID'])) {

          $katzRetour = "fill_evaluatie_01.php?id={$_POST['evalID']}";

          $overlegInfo = mysql_fetch_array(mysql_query("select id, patient, katz_id from evaluatie

                                                        where id = {$_POST['evalID']}"));

          $patientInfo = mysql_fetch_array(mysql_query("select patient.*, deelvzw from patient inner join gemeente on gem_id = gemeente.id

                                                        where code = \"{$overlegInfo['patient']}\""));

          $overlegID =  $_POST['evalID'];

          $tabel = "evaluatie";
        } else if (!$_SESSION['binnenViaCode']) {
          $katzRetour = "overleg_alles.php?tab=Attesten";
          $tabel = "overleg";
          require("../includes/patientoverleg_geg.php");
        }
        else {        // binnen via code
          $tabel = "overleg";
          $patientInfo = mysql_fetch_array(mysql_query("select patient.*, deelvzw from patient inner join gemeente on gem_id = gemeente.id
                                                        where code = \"{$_SESSION['pat_code']}\""));
        }

        //print_r($overlegInfo);

        if ($patientInfo['deelvzw']=="") $patientInfo['deelvzw']="H";


        if (isset($_GET['katzID'])) {

          $overlegInfo['katz_id'] = $_GET['katzID'];

          // als katzID gezet is via URL, dan die katz bekijken!

        }

        

        if ($overlegInfo['katz_id'] < 0)

          $overlegInfo['katz_id'] = -$overlegInfo['katz_id'];





        $ophalen = false;

        if (isset($overlegInfo['katz_id'])) {

            $ophalen = true;

            $sql="

                SELECT *

                FROM

                    katz

                WHERE

                    id={$overlegInfo['katz_id']}

                    ";

        }

        if ($ophalen) {

          if($result=mysql_query($sql)) {

              if(mysql_num_rows($result)>0)

                  {$records= mysql_fetch_array($result);}

              else

                  {

                    $records['id']         ="";

                    $records['datum']      ="";

                    $records['wassen']     ="";

                    $records['kleden']     ="";

                    $records['verpla']     ="";

                    $records['toilet']     ="";

                    $records['continent']  ="";

                    $records['eten']       ="";

                    $records['orient']     ="";

                    $records['rust']       ="";

                    $records['woon']       ="";

                    $records['mantel']     ="";

                    $records['sanitair']   ="";

                    $records['totaal']     ="";

                    $records['code']       ="";

                    if ($_SESSION['profiel']=="hulp")
                      $records['hvl_id']       =$_SESSION['usersid'];
                    else
                      $records['hvl_id']       ="";

                    $records['dd']         =date("d");

                    $records['mm']         =date("m");

                    $records['jj']         =date("Y");

                    }

                }

              else {

                print("is er nu weer een fout met die query $sql");

              }

            }

            if (!isset($records['dd']) && isset($_POST['overleg_dd'])) {

               $records['dd'] = "{$_POST['overleg_dd']}";

               $records['mm'] = "{$_POST['overleg_mm']}";

               $records['jj'] = "{$_POST['overleg_jj']}";

            }



            if ((!isset($records['dd']) || $records['dd'] == 0) && ($_POST['actie']!="print")) {

               $records['dd']         = date("d");

            }

            if ((!isset($records['mm']) || $records['mm'] == 0) && ($_POST['actie']!="print")) {

               $records['mm']         = date("m");

            }

            if ((!isset($records['jj']) || $records['jj'] == 0) && ($_POST['actie']!="print")) {

               $records['jj']         = date("Y");

            }
            if ($records['hvl_id'] == "" && $_SESSION['profiel']=="hulp")
                      $records['hvl_id']       =$_SESSION['usersid'];

        include("../includes/html_html.inc");

        print("<head>");

        include("../includes/html_head.inc");

        

    if (isset($_GET['hvl_id']) && ($records['hvl_id'] != "")) $records['hvl_id'] = $_GET['hvl_id'];

        

?>

<script type="text/javascript">

<!--

function calculateKatz()

    {

    var waarde=0;

    var totaal1=0;

    var totaal2=0;

    var totaal3=0;

    var totaal4=0;

    var totaal5=0;

    var radios1= new Array("katz_wassen","katz_kleden","katz_verpla","katz_toilet","katz_continent","katz_eten");

    var radios2= new Array("katz_orient","katz_rust");

    var radios3= new Array("katz_woon");

    var radios4= new Array("katz_mantel");

    var radios5= new Array("katz_sanitair");

    for (var radio=0;radio<radios1.length;radio++)

        {radioObj=eval("document.forms['katz'].elements['"+radios1[radio]+"']");

    for(var i = 0; i < radioObj.length; i++)

        {if(radioObj[i].checked)

            {var waarde=parseInt(radioObj[i].value);

                if (waarde>totaal1)totaal1=waarde;

                i=radioObj.length;};waarde=0;}}

    for (var radio=0;radio<radios2.length;radio++)

        {radioObj=eval("document.forms['katz'].elements['"+radios2[radio]+"']");

    for(var i = 0; i < radioObj.length; i++)

        {if(radioObj[i].checked)

            {var waarde=parseInt(radioObj[i].value);

                if (waarde>totaal2)totaal2=waarde;

                i=radioObj.length;};waarde=0;}}

    for (var radio=0;radio<radios3.length;radio++)

        {radioObj=eval("document.forms['katz'].elements['"+radios3[radio]+"']");

    for(var i = 0; i < radioObj.length; i++)

        {if(radioObj[i].checked)

            {var waarde=parseInt(radioObj[i].value);

                if (waarde>totaal3)totaal3=waarde;

                i=radioObj.length;};waarde=0;}}

    for (var radio=0;radio<radios4.length;radio++)

        {radioObj=eval("document.forms['katz'].elements['"+radios4[radio]+"']");

    for(var i = 0; i < radioObj.length; i++)

        {if(radioObj[i].checked)

            {var waarde=parseInt(radioObj[i].value);

                if (waarde>totaal4)totaal4=waarde;

                i=radioObj.length;};waarde=0;}}

    for (var radio=0;radio<radios5.length;radio++)

        {radioObj=eval("document.forms['katz'].elements['"+radios5[radio]+"']");

    for(var i = 0; i < radioObj.length; i++)

        {if(radioObj[i].checked)

            {var waarde=parseInt(radioObj[i].value);

                if (waarde>totaal5)totaal5=waarde;

                i=radioObj.length;};waarde=0;}}

    totaal=totaal1+totaal2+totaal3+totaal4+totaal5;

    document.getElementById('score').innerHTML=totaal;

    document.getElementById('totaal').value=totaal;}    

function checkRadios()

   {var melding="";

    waarde=""

    var radios= new Array("katz_wassen","katz_kleden","katz_verpla","katz_toilet","katz_continent","katz_eten","katz_orient","katz_rust","katz_woon","katz_mantel","katz_sanitair");

    for (var radio=0;radio<radios.length;radio++)

        {radioObj=eval("document.forms['katz'].elements['"+radios[radio]+"']");

    for(var i = 0; i < radioObj.length; i++)

        {if(radioObj[i].checked)

            {var waarde=radioObj[i].value;

                i=radioObj.length;}}

        if (waarde!="")

            {melding=melding+radios[radio]+" - "+waarde+"\n";

            var ingevuld=true;

            waarde="";}

        else {melding=" - U hebt niet alle vragen beantwoord.\n";

            var ingevuld=false;

            i=radioObj.length;

            radio=radios.length;}}

    // en er voor zorgen dat invuller ingevuld is

    if (ingevuld) melding = ""; // correctheidsmelding afzetten

    if (document.katz.katz_dd.value.length == 0 ||

        document.katz.katz_mm.value.length == 0 ||

        document.katz.katz_jj.value.length == 0 ) {

       var ingevuld = false;

       melding = melding + " - U hebt geen datum ingevuld.\n";

    }

    if (document.katz.katz_hvl_id.value == 0) {

      var ingevuld = false;

      melding = melding + " - U hebt niet aangeduid wie deze katz-score ingevuld heeft!\n";

    }

    

    if (!ingevuld)

        {alert("We kunnen deze katz-score niet opslaan, want \n\n" + melding);

        return false;}

    else {return true;}}



//-->



</script>

<?php

        print("</head>");

        if (!isset($_POST['actie'])){print("<body onload=\"calculateKatz()\">");}

        else if ($_POST['actie']=="print") {

           print("<style type=\"text/css\">.print {visibility:hidden;}</style>");

           print("<body onload=\"parent.print();\">");

        }

        else {print("<body>");}

        if ($_GET['actie']=="pseudoprint") {

           $_POST['actie'] = "print";

        }

        print("<div align=\"center\">");

        print("<div class=\"pagina\">");

        if ($_POST['actie'] != "print") {

          include("../includes/header.inc");

          include("../includes/kruimelpad.inc");

          print("<div class=\"contents\">");

          include("../includes/menu.inc");

          print("<div class=\"main\">");

          print("<div class=\"mainblock\">");

        }

//  include("../includes/toonSessie.inc");

        if (!isset($_POST['actie']) || ($_POST['actie'] == "print")

              || ($_POST['submit'] == "Doe nieuwe katz") || ($_POST['submit'] == "Herbereken"))

            {



            if ($_POST['actie'] == "print" || isset($_GET['bekijk'])) {

               $disabled = "return false;";

               $disabledLang = " onClick=\"blur();\" ";

            }

            else {

               $disabled = $disabledLang = "";

            }

            if ($_POST['actie']!="print") print("{$_SESSION['pat_code']}");

?>

<!-- formulier -->

<form action="katz_invullen.php" onsubmit="return checkRadios()" name="katz" method="post">

<input type="hidden" name="katz_totaal" value="0" id="totaal"/>

<input type="hidden" name="a_katz_id" value="<?php print($records['id']);?>" />

<?php

if ($_POST['actie']=="print") {

?>

                <div style="text-align:center">

                <table width="100%">

                    <tr>

<?php
  if ($patientInfo['deelvzw']=="") {
print("                        <td><img src=\"../images/logo_top_pagina_klein.gif\" width=\"100\"></td>\n");
  }
  else {
print("                        <td><img src=\"../images/Sel{$patientInfo['deelvzw']}.jpg\" height=\"100\" /></td>\n");
  }
?>
                        <td>

                            <div style="text-align:center">

                                <h2>Score zorgbehoevendheid</h2>

                                <?php print($patientInfo['code']);?><br />

                                <?php print($patientInfo['naam']." ".$patientInfo['voornaam']);?>

                                

                            </div>

                        </td>

                    </tr>

                </table>

                </div>

<?php

}

else {

   print("<h1>Score zorgbehoevendheid</h1>");

}

?>





<div class="inputItem" id="IINaam">



        <div class="waarde">

        Ingevuld door<span class="reqfield">*</span>&nbsp;:

            <select size="1" name="katz_hvl_id"  <?php print($disabledLang); ?> >

<?php

//----------------------------------------------------------

// Vul Input-select-element vanuit dbase met lijst

// betrokken hulpverleners voor deze patient (HVL's)



// verwijderd uit WHERE: AND f.groep_id in (1,2)

// zodat alle hulpverleners kunnen invullen

// HIERHIERHIER menos_betrokkenen ophalen
      if (!isset($overlegGenreVoorwaarde)) {
          $overlegGenreVoorwaarde = " bl.overleggenre = 'gewoon' AND ";
      }

      $query2 = "

         SELECT

                bl.persoon_id,

                h.naam as hvl_naam,

                h.voornaam,

                f.naam as fnct_naam

         FROM

                hulpverleners h,

                huidige_betrokkenen bl,

                functies f

            WHERE
                $overlegGenreVoorwaarde
                bl.patient_code='".$_SESSION["pat_code"]."' AND

                bl.persoon_id=h.id AND

                (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

                h.fnct_id=f.id

         ORDER BY

            h.naam";



        $switch=false;

      if ($result2=mysql_query($query2))

         {

            $aantalxvl=mysql_num_rows ($result2);

         for ($i=0; $i < mysql_num_rows ($result2); $i++)

            {

            $records2= mysql_fetch_array($result2);

            if($records2['persoon_id']==$records['hvl_id']){$selected=" selected=\"selected\"";$switch=true;}
            else if ($records2['persoon_id']==$_GET['hvl_id'] && $records['hvl_id']==0) {
               $selected=" selected=\"selected\"";$switch=true;
            }
            else{$selected="";};

            print ("

               <option $disabledLang value=\"".$records2['persoon_id']."\" ".$selected.">".$records2['hvl_naam']." ".$records2['voornaam']."</option>\n");

            }

            $selected=($switch)?"":" selected=\"selected\"";

            print("<option $disabledLang value=\"0\"".$selected.">Onbenoemd</select>");

         }

     else {

       print("mannekes $query2");

     }

//----------------------------------------------------------



    //-----------------------------------------------------------------------------

    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");

    //-----------------------------------------------------------------------------



    function zichtbaar($veld, $waarde) {

      global $records;

      if ($records[$veld] == $waarde)

        print("style=\"visibility: visible;\"");

    }

?>

         </select>

         op

        <span class="iinputItem" id="IIStartdatum">

         <span class="waarde2">

            <input type="text" size="2" value="<?php print($records['dd']);?>" name="katz_dd"  <?php print($disabledLang); ?>

                onKeyup="checkForNumbersOnly(this,2,0,31,'katz','katz_mm')"

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input type="text" size="2" value="<?php print($records['mm']);?>" name="katz_mm"  <?php print($disabledLang); ?>

                onKeyup="checkForNumbersOnly(this,2,0,12,'katz','katz_jj')"

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input type="text" size="2" value="<?php print($records['jj']);?>" name="katz_jj" <?php print($disabledLang); ?>

                onKeydown="checkForNumbersOnly(this,4,1970,2069,'katz','katz_jj')"

                onblur="checkForNumbersLength(this,4)" />

         </span>

      </span><!--overleg_dd,overleg_mm,overleg_jj-->





        </div>

</div><!--Naam interviewer-->

<p>

<table width="100%" style="clear: both;">

<tr>

<th colspan="6" align="left">A. Fysische afhankelijkheid</th>

</tr>

<tr>

<td colspan="2"></td>

<td width="15%" align="center">volledig<br />onafhankelijk</td>

<td width="15%" align="center">gedeeltelijk<br />met moeite</td>

<td width="15%" align="center">hulp<br />derden</td>

<td width="15%" align="center">volledig<br />afhankelijk</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Wassen</td>

<td class="print" <?php zichtbaar('wassen','1a'); ?> width="15%" align="center"><input type="radio" name="katz_wassen" onClick="<?php print($disabled); ?>calculateKatz('katz_wassen',0)" value="1a" <?php $selected=($records['wassen']=="1a")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('wassen','2b'); ?> width="15%" align="center"><input type="radio" name="katz_wassen" onClick="<?php print($disabled); ?>calculateKatz('katz_wassen',1)" value="2b" <?php $selected=($records['wassen']=="2b")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('wassen','2c'); ?> width="15%" align="center"><input type="radio" name="katz_wassen" onClick="<?php print($disabled); ?>calculateKatz('katz_wassen',2)" value="2c" <?php $selected=($records['wassen']=="2c")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('wassen','2d'); ?> width="15%" align="center"><input type="radio" name="katz_wassen" onClick="<?php print($disabled); ?>calculateKatz('katz_wassen',3)" value="2d" <?php $selected=($records['wassen']=="2d")?"checked=\"checked\"":"";print($selected);?> > 2</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Kleden</td>

<td class="print" <?php zichtbaar('kleden','1a'); ?> width="15%" align="center"><input type="radio" name="katz_kleden" onClick="<?php print($disabled); ?>calculateKatz('katz_kleden',0)" value="1a" <?php $selected=($records['kleden']=="1a")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('kleden','2b'); ?> width="15%" align="center"><input type="radio" name="katz_kleden" onClick="<?php print($disabled); ?>calculateKatz('katz_kleden',1)" value="2b" <?php $selected=($records['kleden']=="2b")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('kleden','3c'); ?> width="15%" align="center"><input type="radio" name="katz_kleden" onClick="<?php print($disabled); ?>calculateKatz('katz_kleden',2)" value="3c" <?php $selected=($records['kleden']=="3c")?"checked=\"checked\"":"";print($selected);?> > 3</td>

<td class="print" <?php zichtbaar('kleden','3d'); ?> width="15%" align="center"><input type="radio" name="katz_kleden" onClick="<?php print($disabled); ?>calculateKatz('katz_kleden',3)" value="3d" <?php $selected=($records['kleden']=="3d")?"checked=\"checked\"":"";print($selected);?> > 3</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Verplaatsen</td>

<td class="print" <?php zichtbaar('verpla','1a'); ?> width="15%" align="center"><input type="radio" name="katz_verpla" onClick="<?php print($disabled); ?>calculateKatz('katz_verpla',0)" value="1a" <?php $selected=($records['verpla']=="1a")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('verpla','2b'); ?> width="15%" align="center"><input type="radio" name="katz_verpla" onClick="<?php print($disabled); ?>calculateKatz('katz_verpla',1)" value="2b" <?php $selected=($records['verpla']=="2b")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('verpla','4c'); ?> width="15%" align="center"><input type="radio" name="katz_verpla" onClick="<?php print($disabled); ?>calculateKatz('katz_verpla',2)" value="4c" <?php $selected=($records['verpla']=="4c")?"checked=\"checked\"":"";print($selected);?> > 4</td>

<td class="print" <?php zichtbaar('verpla','4d'); ?> width="15%" align="center"><input type="radio" name="katz_verpla" onClick="<?php print($disabled); ?>calculateKatz('katz_verpla',3)" value="4d" <?php $selected=($records['verpla']=="4d")?"checked=\"checked\"":"";print($selected);?> > 4</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Toiletbezoek</td>

<td class="print" <?php zichtbaar('toilet','1a'); ?> width="15%" align="center"><input type="radio" name="katz_toilet" onClick="<?php print($disabled); ?>calculateKatz('katz_toilet',0)" value="1a" <?php $selected=($records['toilet']=="1a")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('toilet','2b'); ?> width="15%" align="center"><input type="radio" name="katz_toilet" onClick="<?php print($disabled); ?>calculateKatz('katz_toilet',1)" value="2b" <?php $selected=($records['toilet']=="2b")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('toilet','5c'); ?> width="15%" align="center"><input type="radio" name="katz_toilet" onClick="<?php print($disabled); ?>calculateKatz('katz_toilet',2)" value="5c" <?php $selected=($records['toilet']=="5c")?"checked=\"checked\"":"";print($selected);?> > 5</td>

<td class="print" <?php zichtbaar('toilet','5d'); ?> width="15%" align="center"><input type="radio" name="katz_toilet" onClick="<?php print($disabled); ?>calculateKatz('katz_toilet',3)" value="5d" <?php $selected=($records['toilet']=="5d")?"checked=\"checked\"":"";print($selected);?> > 5</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Continentie</td>

<td class="print" <?php zichtbaar('continent','1a'); ?> width="15%" align="center"><input type="radio" name="katz_continent" onClick="<?php print($disabled); ?>calculateKatz('katz_continent',0)" value="1a" <?php $selected=($records['continent']=="1a")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('continent','2b'); ?> width="15%" align="center"><input type="radio" name="katz_continent" onClick="<?php print($disabled); ?>calculateKatz('katz_continent',1)" value="2b" <?php $selected=($records['continent']=="2b")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('continent','6c'); ?> width="15%" align="center"><input type="radio" name="katz_continent" onClick="<?php print($disabled); ?>calculateKatz('katz_continent',2)" value="6c" <?php $selected=($records['continent']=="6c")?"checked=\"checked\"":"";print($selected);?> > 6</td>

<td class="print" <?php zichtbaar('continent','6d'); ?> width="15%" align="center"><input type="radio" name="katz_continent" onClick="<?php print($disabled); ?>calculateKatz('katz_continent',3)" value="6d" <?php $selected=($records['continent']=="6d")?"checked=\"checked\"":"";print($selected);?> > 6</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Eten</td>

<td class="print" <?php zichtbaar('eten','1a'); ?> width="15%" align="center"><input type="radio" name="katz_eten" onClick="<?php print($disabled); ?>calculateKatz('katz_eten',0)" value="1a" <?php $selected=($records['eten']=="1a")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('eten','2b'); ?> width="15%" align="center"><input type="radio" name="katz_eten" onClick="<?php print($disabled); ?>calculateKatz('katz_eten',1)" value="2b" <?php $selected=($records['eten']=="2b")?"checked=\"checked\"":"";print($selected);?> > 2</td>

<td class="print" <?php zichtbaar('eten','7c'); ?> width="15%" align="center"><input type="radio" name="katz_eten" onClick="<?php print($disabled); ?>calculateKatz('katz_eten',2)" value="7c" <?php $selected=($records['eten']=="7c")?"checked=\"checked\"":"";print($selected);?> > 7</td>

<td class="print" <?php zichtbaar('eten','7d'); ?> width="15%" align="center"><input type="radio" name="katz_eten" onClick="<?php print($disabled); ?>calculateKatz('katz_eten',3)" value="7d" <?php $selected=($records['eten']=="7d")?"checked=\"checked\"":"";print($selected);?> > 7</td>

</tr>

</table></p>

<p>

<table width="100%">

<tr>

<th colspan="6" align="left">B. Psychische afhankelijkheid</th>

</tr>

<tr>

<td colspan="2"></td>

<td width="20%" align="center">geen<br />probleem</td>

<td width="20%" align="center">occasioneel</td>

<td width="20%" align="center">voortdurend</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Ori&euml;ntatie tijd en ruimte</td>

<td class="print" <?php zichtbaar('orient','0a'); ?> width="20%" align="center"><input type="radio" name="katz_orient" onClick="<?php print($disabled); ?>calculateKatz('katz_orient',0)" value="0a" <?php $selected=($records['orient']=="0a")?"checked=\"checked\"":"";print($selected);?> > 0</td>

<td class="print" <?php zichtbaar('orient','1b'); ?> width="20%" align="center"><input type="radio" name="katz_orient" onClick="<?php print($disabled); ?>calculateKatz('katz_orient',1)" value="1b" <?php $selected=($records['orient']=="1b")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('orient','2c'); ?> width="20%" align="center"><input type="radio" name="katz_orient" onClick="<?php print($disabled); ?>calculateKatz('katz_orient',2)" value="2c" <?php $selected=($records['orient']=="2c")?"checked=\"checked\"":"";print($selected);?> > 2</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Rusteloosheid</td>

<td class="print" <?php zichtbaar('rust','0a'); ?> width="20%" align="center"><input type="radio" name="katz_rust" onClick="<?php print($disabled); ?>calculateKatz('katz_rust',0)" value="0a" <?php $selected=($records['rust']=="0a")?"checked=\"checked\"":"";print($selected);?> > 0</td>

<td class="print" <?php zichtbaar('rust','1b'); ?> width="20%" align="center"><input type="radio" name="katz_rust" onClick="<?php print($disabled); ?>calculateKatz('katz_rust',1)" value="1b" <?php $selected=($records['rust']=="1b")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('rust','2c'); ?> width="20%" align="center"><input type="radio" name="katz_rust" onClick="<?php print($disabled); ?>calculateKatz('katz_rust',2)" value="2c" <?php $selected=($records['rust']=="2c")?"checked=\"checked\"":"";print($selected);?> > 2</td>

</tr>

</table></p>

<p>

<table width="100%">

<tr>

<th colspan="6" align="left">C. Sociale context</th>

</tr>

<tr>

<td colspan="2"></td>

<td width="20%" align="center">met beschikb.<br />valide persoon</td>

<td width="20%" align="center">met niet-valide<br />of niet-beschikb.<br />persoon</td>

<td width="20%" align="center">alleen</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Woonsituatie<br />(onder hetzelfde dak)</td>

<td class="print" <?php zichtbaar('woon','0a'); ?> width="20%" align="center"><input type="radio" name="katz_woon" onClick="<?php print($disabled); ?>calculateKatz('katz_woon',0)" value="0a" <?php $selected=($records['woon']=="0a")?"checked=\"checked\"":"";print($selected);?> > 0</td>

<td class="print" <?php zichtbaar('woon','1b'); ?> width="20%" align="center"><input type="radio" name="katz_woon" onClick="<?php print($disabled); ?>calculateKatz('katz_woon',1)" value="1b" <?php $selected=($records['woon']=="1b")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('woon','2c'); ?> width="20%" align="center"><input type="radio" name="katz_woon" onClick="<?php print($disabled); ?>calculateKatz('katz_woon',2)" value="2c" <?php $selected=($records['woon']=="2c")?"checked=\"checked\"":"";print($selected);?> > 2</td>

</tr>

<tr>

<td colspan="2"></td>

<td width="20%" align="center">intensief<br />frequent<br />maximum</td>

<td width="20%" align="center">partieel<br />regelmatig<br />soms</td>

<td width="20%" align="center">alleen<br />minimum<br />sporadisch</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Mantelzorg<br />(niet onder hetzelfde dak)</td>

<td class="print" <?php zichtbaar('mantel','0a'); ?> width="20%" align="center"><input type="radio" name="katz_mantel" onClick="<?php print($disabled); ?>calculateKatz('katz_mantel',0)" value="0a" <?php $selected=($records['mantel']=="0a")?"checked=\"checked\"":"";print($selected);?> > 0</td>

<td class="print" <?php zichtbaar('mantel','1b'); ?> width="20%" align="center"><input type="radio" name="katz_mantel" onClick="<?php print($disabled); ?>calculateKatz('katz_mantel',1)" value="1b" <?php $selected=($records['mantel']=="1b")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('mantel','2c'); ?> width="20%" align="center"><input type="radio" name="katz_mantel" onClick="<?php print($disabled); ?>calculateKatz('katz_mantel',2)" value="2c" <?php $selected=($records['mantel']=="2c")?"checked=\"checked\"":"";print($selected);?> > 2</td>

</tr>

</table></p>

<p>

<table width="100%">

<tr>

<th colspan="6" align="left">D. Comfort</th>

</tr>

<tr>

<td colspan="2"></td>

<td width="20%" align="center">ingerichte<br />badkamer</td>

<td width="20%" align="center">stromend warm<br />water (keuken)</td>

<td width="20%" align="center">geen stromend<br />water</td>

</tr>

<tr>

<td width="10%">&nbsp;</td>

<td width="30%">Woonsituatie<br />(onder hetzelfde dak)</td>

<td class="print" <?php zichtbaar('sanitair','0a'); ?> width="20%" align="center"><input type="radio" name="katz_sanitair" onClick="<?php print($disabled); ?>calculateKatz('katz_sanitair',0)" value="0a" <?php $selected=($records['sanitair']=="0a")?"checked=\"checked\"":"";print($selected);?> > 0</td>

<td class="print" <?php zichtbaar('sanitair','1b'); ?> width="20%" align="center"><input type="radio" name="katz_sanitair" onClick="<?php print($disabled); ?>calculateKatz('katz_sanitair',1)" value="1b" <?php $selected=($records['sanitair']=="1b")?"checked=\"checked\"":"";print($selected);?> > 1</td>

<td class="print" <?php zichtbaar('sanitair','2c'); ?> width="20%" align="center"><input type="radio" name="katz_sanitair" onClick="<?php print($disabled); ?>calculateKatz('katz_sanitair',2)" value="2c" <?php $selected=($records['sanitair']=="2c")?"checked=\"checked\"":"";print($selected);?> > 2</td>

</tr>

</table></p>

<div class="inputItem" id="IIButton" style="height: 52px;">

    <div class="label280" style="height:52px;width: auto"><h1>Globale KATZ score: <span id="score"><?php print($records['totaal']);?></span></h1>

    <?php if ($records['goedkeuring_inspectie']==1) print("<p style=\"margin-top:-8px;\">-- Goedgekeurd na inspectie -- </p>"); ?></div>

    <div class="waarde" style="position: relative; top: 8px; ">

<?php

  if (isset($_GET['bekijk'])) {

      print("<input type=\"button\" onClick=\"history.go(-1);\" value=\"Terug naar zorgplan\"></form>");

  }

  else if ($_POST['actie'] == "print") {

      // geen actie meer voorzien, want we zijn gewoon aan het printen

  }

  else {

     if (isset($_GET['evalID'])) {

       print("<input type=\"hidden\" name=\"evalID\" value=\"{$_GET['evalID']}\" /> \n");
       print("<input type=\"hidden\" name=\"overlegID\" value=\"{$_GET['evalID']}\" /> \n");

     } else if (isset($_POST['evalID'])) {

       print("<input type=\"hidden\" name=\"evalID\" value=\"{$_POST['evalID']}\" /> \n");
       print("<input type=\"hidden\" name=\"overlegID\" value=\"{$_POST['evalID']}\" /> \n");

     }

     else {

       print("<input type=\"hidden\" name=\"overlegID\" value=\"$overlegID\" /> \n");

     }

     print("<input type=\"hidden\" name=\"tabel\" value=\"$tabel\" />\n");



?>

       <input type="hidden" name="katzRetour" value="<?= $katzRetour ?>" />

        <input type="submit" onClick="calculateKatz(this)" value="Opslaan" name="actie" /></form>

<?php

  }

?>

    </div>

</div>

<!-- eindeformulier -->

<?php

            }

        else

            {

                $katz_dd = "{$_POST['katz_dd']}";

                if (strlen($katz_dd) == 1) {$katz_dd = "0" . "{$katz_dd}";}

                $katz_mm = "{$_POST['katz_mm']}";

                if (strlen($katz_mm) == 1) {$katz_mm = "0" . "{$katz_mm}";}

                $katz_jj = "{$_POST['katz_jj']}";

                if (strlen($katz_jj) == 1) {$katz_jj = "200" . "{$katz_jj}";}

                //print_r($overlegInfo);

                //die("katzid=" . $overlegInfo['id'] . $overlegInfo['katz_id']);

                if (isset($overlegInfo['katz_id'])) {
                  // update!
                  $katz_qry1="
                    UPDATE
                        katz
                    SET
                        hvl_id = {$_POST['katz_hvl_id']},
                        dd=\"$katz_dd\",
                        mm=\"$katz_mm\",
                        jj=\"$katz_jj\",
                        wassen='".$_POST['katz_wassen']."',
                        kleden='".$_POST['katz_kleden']."',
                        verpla='".$_POST['katz_verpla']."',
                        toilet='".$_POST['katz_toilet']."',
                        continent='".$_POST['katz_continent']."',
                        eten='".$_POST['katz_eten']."',
                        orient='".$_POST['katz_orient']."',
                        rust='".$_POST['katz_rust']."',
                        woon='".$_POST['katz_woon']."',
                        mantel='".$_POST['katz_mantel']."',
                        sanitair='".$_POST['katz_sanitair']."',
                        hvl_id='".$_POST['katz_hvl_id']."',
                        totaal=".$_POST['katz_totaal']."
                    WHERE
                        id={$overlegInfo['katz_id']}";
                    $katzToevoegen = mysql_query($katz_qry1);
                }
                else {
                  // nieuw katz-record
                  $katz_qry1="
                    INSERT INTO
                        katz (hvl_id, dd, mm, jj, wassen, kleden,
                              verpla, toilet, continent, eten, orient,
                              rust, woon, mantel, sanitair, totaal)
                    VALUES
                        ({$_POST['katz_hvl_id']},
                         \"$katz_dd\",
                         \"$katz_mm\",
                         \"$katz_jj\",
                         '".$_POST['katz_wassen']."',
                         '".$_POST['katz_kleden']."',
                         '".$_POST['katz_verpla']."',
                         '".$_POST['katz_toilet']."',
                         '".$_POST['katz_continent']."',
                         '".$_POST['katz_eten']."',
                         '".$_POST['katz_orient']."',
                         '".$_POST['katz_rust']."',
                         '".$_POST['katz_woon']."',
                         '".$_POST['katz_mantel']."',
                         '".$_POST['katz_sanitair']."',
                         ".$_POST['katz_totaal'].")";
                  $katzToevoegen = mysql_query($katz_qry1);
                  //die($katzToevoegen);

                  $katzNr = mysql_insert_id();
                  if ($_POST['tabel']=="menos") {
                    $katz_qry2="
                      UPDATE
                          {$_POST['tabel']}
                      SET
                        katz_id = $katzNr
                      WHERE
                        patient='{$_SESSION['pat_code']}'";
                  }
                  else {
                    $katz_qry2="
                      UPDATE
                          {$_POST['tabel']}
                      SET
                        katz_id = $katzNr
                      WHERE
                        id={$_POST['overlegID']}";
                  }
                  $katzToevoegen = $katzToevoegen && mysql_query($katz_qry2);

                  // katz_aanvraag wissen
                  if ($_POST['tabel']=="overleg") {
                        $deleteKatzAanvraag = "delete from katz_aanvraag where overleg = $overlegID and (wat='katz' or wat='katz_evaluatie')";
                        mysql_query($deleteKatzAanvraag);
                        $updateKatzAanvraag = "update katz_aanvraag set wat='evaluatie' where overleg = $overlegID and wat='katz+evaluatie'";
                        mysql_query($updateKatzAanvraag);
                  }
                }

                if ($katzToevoegen)

                    {// Query werd succesvol uitgevoerd

        /*************** begin subsidiestatus aanpassen (indien nodig) ************/

            $minimumStatus = $patientInfo['minimum_subsidiestatus'];

            if ($minimumStatus%4 > 0 && $minimumStatus%2 > 0 && $_POST['katz_totaal'] >=5) {

              mysql_query("update patient set minimum_subsidiestatus = minimum_subsidiestatus*4 where code = '{$patientInfo['code']}'") or die("Katz-score van {$_POST['katz_totaal']} is wel opgeslagen, maar de update van de subsidiestatus is niet gelukt omwille van <br/>" . mysql_error());

            }

            else if ($minimumStatus%4 > 0 && $_POST['katz_totaal'] >=5) {

              mysql_query("update patient set minimum_subsidiestatus = minimum_subsidiestatus*2 where code = '{$patientInfo['code']}'") or die("Katz-score van {$_POST['katz_totaal']} is wel opgeslagen, maar de update van de subsidiestatus is niet gelukt omwille van <br/>" . mysql_error());

            }

            else if ($minimumStatus%2 > 0 && $_POST['katz_totaal'] >=1) {

              mysql_query("update patient set minimum_subsidiestatus = minimum_subsidiestatus*2 where code = '{$patientInfo['code']}'") or die("Katz-score van {$_POST['katz_totaal']} is wel opgeslagen, maar de update van de subsidiestatus is niet gelukt omwille van <br/>" . mysql_error());

            }

            else if ($_POST['katz_totaal'] <5 && $minimumStatus%4 == 0 && isset($overlegInfo['katz_id'])) {

              // deze katz is een update waarbij ik onder de 5 zak en toch heb ik een status van meer dan 4 opgeslagen

              // toch effe checken dus wat nu effectief de maximale status is

              $maxKatzRij1 = getFirstRecord("select max(totaal) as maxKatz from katz k, evaluatie e where k.id = e.katz_id and e.patient = '$code'");

              $maxKatzRij2 = getFirstRecord("select max(totaal) as maxKatz from katz k, overleg o where k.id = o.katz_id and o.patient_code = '$code'");

              $grootsteKatz = max($maxKatzRij1['maxKatz'],$maxKatzRij2['maxKatz']);

              if ($grootsteKatz < 5) {

                 $nieuweMinimum = $minimumStatus/2;

                 mysql_query("update patient set minimum_subsidiestatus = $nieuweMinimum where code = '{$patientInfo['code']}'") or die("Katz-score van {$_POST['katz_totaal']} is wel opgeslagen, maar de update van de subsidiestatus is niet gelukt omwille van <br/>" . mysql_error());

              }

            }

        /*************** einde subsidiestatus aanpassen (indien nodig) ************/

        /************ begin email sturen naar organisator van het overleg ***********************/

        $organisator = organisatorRecordVanOverleg($overlegInfo);

           $msg = "De katz-score bij patient {$_SESSION['pat_code']} is ingevuld. Je kan nu verder met het overleg af te ronden.";


           if ((!isset($_GET['evalID'])) && (!isset($_POST['evalID'])) ) {
              htmlmail($organisator['email'],"Listel: katz-score {$_SESSION['pat_code']} ingevuld.","Beste overlegco&ouml;rdinator<br/>$msg \n<br /><p>Met dank voor uw medewerking, <br />Het LISTEL e-zorgplan www.listel.be </p>");
          }

        /************ einde email sturen naar OC TGZ ***********************/







                    

                    if ($_SESSION['binnenViaCode']) {

                       print("<h1>De katz-score is succesvol opgeslagen.</h1><p>Bedankt.<br/><br/><br/><br/><br/><br/><br/><br/>&nbsp;</p>");

                    }

                    else {

                       print("<h1>De katz-score is succesvol opgeslagen.</h1><p>Bedankt.<br/><br/><br/><br/><br/><br/><br/><br/>&nbsp;</p>");

                      print("

                       <script>

                       function redirect()

                          {

                            document.location = \"{$_POST['katzRetour']}\";

                          }

                       setTimeout(\"redirect()\",1000);

                       </script>");

                    }

                }

                else

                {   /* Query werd NIET succesvol uitgevoerd */

                    print("godver fout opgetreden".$katz_qry2);}

                }





        //---------------------------------------------------------

        /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

        //---------------------------------------------------------

      print("</div>");

      print("</div>");

      print("</div>");

      if ($_POST['actie']!="print") {

        include("../includes/footer.inc");

        print("</div>");

        print("</div>");

      }

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */

if (!$_SESSION['binnenViaCode'] && !$binnenViaCode) {
  require("../includes/check_access.inc");
}
//---------------------------------------------------------

?>