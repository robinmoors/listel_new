<?php

require("../includes/dbconnect2.inc");

$paginanaam="Overzicht zorgenplannen";

require("../includes/clearSessie.inc");

//require("../includes/toonSessie.inc");



if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");

    require("../includes/bevestigdel.inc");

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    require("../includes/header.inc");

    require("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    require("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");





//----------------------------------------------------------

// Reset de sessie-vars

    $_SESSION['pat_code']="";

    $_SESSION['pat_id']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";

//----------------------------------------------------------



//----------------------------------------------------------

// Haal alle patienten op "van een Regionale SIT"





if (!isset($_GET['status']) || ($_GET['status']=="alles")) {

  $_GET['status'] = "alles";

  $statusVoorwaarde = "";

}

else {

  $statusVoorwaarde = " AND subsidiestatus = \"{$_GET['status']}\" ";

}

?>

<!--
<form method="get" name="f">

Toon de zorgplannen met status

<select name="status" onchange="document.f.submit();" >

  <option <?php if ($_GET['status']=="niet-verdedigbaar") print(" selected=\"selected\""); ?>>niet-verdedigbaar</option>

  <option <?php if ($_GET['status']=="niet-verdedigd") print(" selected=\"selected\""); ?>>niet-verdedigd</option>

  <option <?php if ($_GET['status']=="verdedigbaar") print(" selected=\"selected\""); ?>>verdedigbaar</option>

  <option <?php if ($_GET['status']=="verdedigd") print(" selected=\"selected\""); ?>>verdedigd</option>

  <option <?php if ($_GET['status']=="ok") print(" selected=\"selected\""); ?>>ok</option>

  <option <?php if ($_GET['status']=="alles") print(" selected=\"selected\""); ?>>alles</option>

</select>
<input type="hidden" name="deelvzw" value="<?= $_GET['deelvzw'] ?>" />
</form>

-->

<?php

    if ($_SESSION['profiel']=="listel") {
      $deelvzwGET = "&deelvzw={$_GET['deelvzw']}";
      if ($_GET['deelvzw'] == "G") {
        $uit = " uit deelvzw Genk";
        $deelvzw = " and deelvzw = \"{$_GET['deelvzw']}\" ";
      }
      else if ($_GET['deelvzw'] == "H") {
        $uit = " uit deelvzw Hasselt";
        $deelvzw = " and deelvzw = \"{$_GET['deelvzw']}\" ";
      }
?>
<p>
   <!-- Toon alleen pati&euml;nten uit -->
      <form method="get" style="display:inline;">
            <input type="hidden" name="status" value="<?= $_GET['status'] ?>"/>
            <input type="hidden" name="deelvzw" value="H"/><input type="submit" value="Alleen Hasselt" /></form>
   of
      <form method="get" style="display:inline;">
            <input type="hidden" name="status" value="<?= $_GET['status'] ?>"/>
            <input type="hidden" name="deelvzw" value="G"/><input type="submit" value="Alleen Genk" /></form>
   of
      <form method="get" style="display:inline;">
            <input type="hidden" name="status" value="<?= $_GET['status'] ?>"/>
            <input type="submit" value="Alles" /></form>
</p>
<?php
    }







if ($_GET['status']=="alles") {

  print("<h1>Overzicht zorgplannen $uit</h1>\n");

}

else {

  print("<h1>Overzicht ZP met subsidiestatus {$_GET['status']} $uit</h1>\n");

}






    if (isset($_GET['a_order'])) $a_order = $_GET['a_order'];


    $a_order=(isset($a_order)&&($a_order!="naam"))?$a_order.",naam,voornaam":"naam,voornaam";

    

        if($_SESSION["profiel"]=="OC"){

          $vandaag = date("Ymd");

                      $query = "
SELECT distinct patient.*, max(patient_tp.rechtenOC) FROM gemeente, (patient left join patient_tp on patient.code = patient)
left join overleg on patient_code = code WHERE gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']}
and patient.toegewezen_genre = 'gemeente'
$statusVoorwaarde
group by patient.code
having patient.actief = 1
or (patient.actief = -1 and
((sum(overleg.genre is null) + sum(overleg.genre ='gewoon') > 0)  or max(patient_tp.rechtenOC) > 2000))
                       ORDER BY $a_order    ";
        }
        else if($_SESSION["profiel"]=="rdc"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient
                       WHERE (patient.actief=1)
                              AND patient.toegewezen_genre = 'rdc' and patient.toegewezen_id = {$_SESSION['organisatie']}
                              $statusVoorwaarde
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hulp" && $_SESSION['isOrganisator']){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient
                       WHERE (patient.actief=1)
                              AND patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                              $statusVoorwaarde
                       ORDER BY $a_order";
          $queryNog = "SELECT distinct patient.*  FROM patient, huidige_betrokkenen
                       WHERE ((patient.actief=1) or patient.menos=1)
                             AND patient.code = huidige_betrokkenen.patient_code
                             AND genre = 'hulp' and persoon_id = {$_SESSION['usersid']}
                             AND (rechten = 1 or overleggenre = 'menos')
                              $statusVoorwaarde
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hulp"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient, huidige_betrokkenen
                       WHERE ((patient.actief=1) or patient.menos=1)
                             AND patient.code = huidige_betrokkenen.patient_code
                             AND genre = 'hulp' and persoon_id = {$_SESSION['usersid']}
                             AND (rechten = 1 or overleggenre = 'menos')
                              $statusVoorwaarde
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hoofdproject"){

          $query = "SELECT distinct patient.* FROM patient_tp, patient
                       WHERE patient.actief=-1 AND patient_tp.actief = 1
                       AND patient_tp.patient = patient.code AND
                             patient_tp.project = {$_SESSION['tp_project']}
$statusVoorwaarde
            ORDER BY
              $a_order";

        }

        else if($_SESSION["profiel"]=="bijkomend project"){

            $query = "SELECT distinct patient.* FROM patient_tp, patient

                       WHERE patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}

$statusVoorwaarde            ORDER BY

              $a_order";

        }

        else if($_SESSION["profiel"]=="listel") {

          $query = "

             SELECT distinct

             patient.*, deelvzw

          FROM

            patient inner join gemeente on patient.gem_id = gemeente.id

          WHERE

           (actief=1 or actief = -1 or menos = 1)

$statusVoorwaarde
            $deelvzw

          ORDER BY

            $a_order";

        }
        else if($_SESSION["profiel"]=="menos") {
          $query = "
          SELECT distinct
            naam, voornaam, code, menos,
            concat(substring(begindatum,1,4),substring(begindatum,6,2),substring(begindatum,9,2))  as startdatum
          FROM
            patient inner join patient_menos on patient.code = patient_menos.patient
          WHERE
            patient_menos.einddatum is NULL AND
            menos = 1
          ORDER BY
            $a_order";
        }
        else if($_SESSION["profiel"]=="psy"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient
                       WHERE (patient.actief=1)
                              AND patient.toegewezen_genre = 'psy' and patient.toegewezen_id = {$_SESSION['organisatie']}
                              $statusVoorwaarde
                       ORDER BY $a_order";
        }


?>

<?php

function toonZPs($query) {
   if ($_SESSION['profiel']=="listel") {
     $deelvzwTH = "<th width=\"4%\"><a href=\"zorgenplannen_overzicht.php?a_order=deelvzw&status={$_GET['status']}&deelvzw={$_GET['deelvzw']}\">H/G</a></th>";
   }

    print("      <table width=\"100%\" class=\"klein\" cellpadding=\"2\" id=\"tabelOverzicht\">

            <tr>

                <th width=\"35%\"><a href=\"zorgenplannen_overzicht.php?a_order=code&status={$_GET['status']}&deelvzw={$_GET['deelvzw']}\">zorgplannummer</a></th>
<!--
                <th width=\"4%\"><a href=\"zorgenplannen_overzicht.php?a_order=subsidiestatus&status={$_GET['status']}&deelvzw={$_GET['deelvzw']}\">&euro;</a></th>
-->
                <th width=\"42%\"><a href=\"zorgenplannen_overzicht.php?a_order=naam&status={$_GET['status']}&deelvzw={$_GET['deelvzw']}\">Naam</a></th>

                $deelvzwTH
                <th width=\"15%\"><a href=\"zorgenplannen_overzicht.php?a_order=startdatum&status={$_GET['status']}&deelvzw={$_GET['deelvzw']}\">Startdatum</a></th>

            </tr>");



      if ($result=mysql_query($query))

         {

         $teller = 0;

         if (mysql_num_rows($result) == 0) {

           print("<p>Er werden geen zorgplannen met deze status gevonden.</p>");

         }





         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $teller++;

            $veld00=($records['code']!="")?         $records['code']:"";

            $veld01=($records['naam']!="")?         $records['naam']:"";

            $veld02=($records['voornaam']!="")?     $records['voornaam']:"";

            $veld03=($records['startdatum']!="")?   $records['startdatum']:"";

            if ($veld03=="" && $records['menos']==1) {
              $rijMenos = getFirstRecord("
                 SELECT concat(substring(begindatum,1,4),substring(begindatum,6,2),substring(begindatum,9,2))  as startdatum
                 FROM patient_menos
                 WHERE patient_menos.patient = '{$records['code']}'");
              $veld03 = $rijMenos['startdatum'];
            }

            $tpCode = tpVisueel($records['code']);
            if ($records['menos']==1) {
               $tpCode = $tpCode . "-menos";
            }
            if ($records['type']==16 || $records['type']==18) {
               $tpCode = $tpCode . "-PSY";
            }

            

            $inhoud = "";

            switch ($records['subsidiestatus']) {

               case "niet-verdedigbaar":

                 $kleur = "red";

                 break;

               case "niet-verdedigd":

                 $kleur = "orange";

                 break;

               case "verdedigbaar":

                 $kleur = "white";

                 $inhoud="<img src=\"../images/grijsbolleke.gif\" alt=\"grijs\"/>";

                 break;

               case "verdedigd":

               case "ok":

                 $kleur = "green";

                 break;

               default:

                 $kleur= "white";

            }




            if ($_SESSION['profiel']=="listel") {
               $deelvzwTD = "<td>{$records['deelvzw']}</td>";
            }

        print("

            <tr>

               <td><a href=\"patientoverzicht.php?pat_code=".$veld00."\">".$veld00."$tpCode</a></td>
<!--
               <td><div style=\"width:9px;height:9px;background-color: $kleur\">$inhoud</div></td>
-->
               <td>".$veld01." ".$veld02."</td>
               $deelvzwTD
               <td>".substr($veld03,6,2)."/".substr($veld03,4,2)."/".substr($veld03,0,4)."</td>

                </tr>");

            }

            print("</table>");

         }

      else

         {

             print ("Er werden geen records gevonden" .mysql_error());

         }
}

   if (isset($queryNog)) {
     print("<h1>Van volgende pati&euml;nten ben je organisator</h1>");
   }

   toonZPs($query);

   if (isset($queryNog)) {
     print("<h1>Bij volgende pati&euml;nten ben je betrokkenen hulpverlener</h1>");
     toonZPs($queryNog);
   }

//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>



