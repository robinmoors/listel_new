<?php

require("../includes/dbconnect2.inc");

$paginanaam="Overzicht zorgplannen volgens organisatie";

require("../includes/clearSessie.inc");

//require("../includes/toonSessie.inc");



if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");

    require("../includes/bevestigdel.inc");
    print('<script type="text/javascript" src="../javascript/prototype.js"></script>');
    print("<script type='text/javascript'>function hide(){}");
    print("//var orgList = orgListAlles;\n</script>");


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

// Haal alle patienten op "van een bepaalde organisatie"


















    $a_order=(isset($a_order)&&($a_order!="naam"))?$a_order.",naam,voornaam":"naam,voornaam";

    

        if($_SESSION["profiel"]=="OC"){

          $vandaag = date("Ymd");

/*
                      $query = "
SELECT distinct patient.*, max(patient_tp.rechtenOC) FROM gemeente, huidige_betrokkenen betr, hulpverleners hvl,
(patient left join patient_tp on patient.code = patient)
left join overleg on patient.code = code
WHERE patient.gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']}
$statusVoorwaarde
and betr.patient_code = patient.code
and betr.genre = 'hulp'
and betr.persoon_id = hvl.id
and hvl.organisatie = {$_POST['organisatie']}
group by patient.code
having patient.actief = 1
or (patient.actief = -1 and
((sum(overleg.genre is null) + sum(overleg.genre ='gewoon') > 0)  or max(patient_tp.rechtenOC) > 2000))
                       ORDER BY $a_order    ";
*/
/*
                      $query = "
SELECT distinct patient.*, max(patient_tp.rechtenOC) FROM
gemeente inner join (patient left join patient_tp on patient.code = patient)
                          on (patient.gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']})
         inner join huidige_betrokkenen betr
                          on (betr.patient_code = patient.code and betr.genre = 'hulp')
         inner join hulpverleners hvl
                          on (betr.persoon_id = hvl.id and hvl.organisatie = {$_POST['organisatie']})
where patient_tp.patient is null or rechtenOC > 2000
group by patient.code
having patient.actief = 1
or (patient.actief = -1) ORDER BY $a_order    ";
*/

                      $query = "
SELECT distinct patient.* FROM
gemeente inner join patient
                          on (patient.gem_id=gemeente.id and gemeente.zip = {$_SESSION['overleg_gemeente']})
         inner join huidige_betrokkenen betr
                          on (overleggenre = 'gewoon' and betr.patient_code = patient.code and betr.genre = 'hulp')
         inner join hulpverleners hvl
                          on (betr.persoon_id = hvl.id and hvl.organisatie = {$_POST['organisatie']})
WHERE patient.actief = 1
ORDER BY $a_order    ";

        }
        else if($_SESSION["profiel"]=="rdc"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.* FROM patient, hulpverleners hvl, huidige_betrokkenen betr
                       WHERE (patient.einddatum=0 AND patient.actief=1)
                              and overleggenre = 'gewoon'
                              AND patient.toegewezen_genre = 'rdc' and patient.toegewezen_id = {$_SESSION['organisatie']}
                              and betr.patient_code = patient.code
                              and betr.genre = 'hulp'
                              and betr.persoon_id = hvl.id
                              and hvl.organisatie = {$_POST['organisatie']}
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hulp" && $_SESSION['isOrganisator']){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient, hulpverleners hvl, huidige_betrokkenen betr
                       WHERE (patient.einddatum=0 AND patient.actief=1)
                              and overleggenre = 'gewoon'
                              AND patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                              and betr.patient_code = patient.code
                              and betr.genre = 'hulp'
                              and betr.persoon_id = hvl.id
                              and hvl.organisatie = {$_POST['organisatie']}
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hulp"){
          die("Dit is enkel bedoeld voor de patienten waar je organisator van bent.");
        }
        else if($_SESSION["profiel"]=="hoofdproject"){

          $query = "SELECT distinct patient.* FROM patient_tp, patient, hulpverleners hvl, huidige_betrokkenen betr
                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1
                       AND patient_tp.patient = patient.code AND
                             patient_tp.project = {$_SESSION['tp_project']}
                              and overleggenre = 'gewoon'
                              and betr.patient_code = patient.code
                              and betr.genre = 'hulp'
                              and betr.persoon_id = hvl.id
                              and hvl.organisatie = {$_POST['organisatie']}
            ORDER BY
              $a_order";

        }

        else if($_SESSION["profiel"]=="bijkomend project"){

            $query = "SELECT distinct patient.* FROM patient_tp, patient, hulpverleners hvl, huidige_betrokkenen betr

                       WHERE patient_tp.einddatum is NULL AND patient.actief=-1 AND patient_tp.actief = 1

                       AND patient_tp.patient = patient.code AND

                             patient_tp.project = {$_SESSION['tp_project']}
                              and overleggenre = 'gewoon'
                              and betr.patient_code = patient.code
                              and betr.genre = 'hulp'
                              and betr.persoon_id = hvl.id
                              and hvl.organisatie = {$_POST['organisatie']}
            ORDER BY
              $a_order";

        }

        else if($_SESSION["profiel"]=="listel") {

          $query = "

             SELECT

             distinct patient.*

          FROM

            patient, hulpverleners hvl, huidige_betrokkenen betr

          WHERE

            (einddatum=0 or einddatum is NULL) AND

            (patient.actief=1 or patient.actief = -1)
                              and overleggenre = 'gewoon'
                              and betr.patient_code = patient.code
                              and betr.genre = 'hulp'
                              and betr.persoon_id = hvl.id
                              and hvl.organisatie = {$_POST['organisatie']}
          ORDER BY

            $a_order";

        }

?>




<?php








function toonZPs($query) {
    print("      <table width=\"100%\" class=\"klein\" cellpadding=\"2\" id=\"tabelOverzicht\">

            <tr>

                <th width=\"35%\">zorgplannummer</th>
<!--
                <th width=\"4%\">&euro;</th>
-->
                <th width=\"46%\">Naam</th>

                <th width=\"15%\">Startdatum</th>

            </tr>
    <!--
            <tr>

                <th width=\"35%\"><a href=\"zorgenplannen_per_organisatie.php?a_order=code\">zorgplannummer</a></th>

                <th width=\"4%\"><a href=\"zorgenplannen_per_organisatie.php?a_order=subsidiestatus\">&euro;</a></th>

                <th width=\"46%\"><a href=\"zorgenplannen_per_organisatie.php?a_order=naam\">Naam</a></th>

                <th width=\"15%\"><a href=\"zorgenplannen_per_organisatie.php?a_order=startdatum\">Startdatum</a></th>

            </tr>
    -->");



      if ($result=mysql_query($query))

         {

         $teller = 0;

         if (mysql_num_rows($result) == 0) {

           print("<p>Er werden geen zorgplannen met deze organisatie gevonden. Selecteer een andere organisatie!</p>");

         }





         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $teller++;

            $veld00=($records['code']!="")?         $records['code']:"";

            $veld01=($records['naam']!="")?         $records['naam']:"";

            $veld02=($records['voornaam']!="")?     $records['voornaam']:"";

            $veld03=($records['startdatum']!="")?   $records['startdatum']:"";

            $tpCode = tpVisueel($records['code']);

            

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





        print("

            <tr>

               <td><a href=\"patientoverzicht.php?pat_code=".$veld00."\">".$veld00."$tpCode</a></td>
<!--
               <td><div style=\"width:9px;height:9px;background-color: $kleur\">$inhoud</div></td>
-->
               <td>".$veld01." ".$veld02."</td>

                    <td>".substr($veld03,6,2)."/".substr($veld03,4,2)."/".substr($veld03,0,4)."</td>

                </tr>");

            }

            print("</table>");
            print("<br/><hr/><br/>");
            if (mysql_num_rows($result)>0) print("<p>Probeer eventueel een andere organisatie</p>");
         }

      else

         {

             print ("Er werden geen records gevonden omdat er een fout was met $query, nl. " . mysql_error());

         }
}

function toonFormulier() {
?>
<form method="post" name="f">
<?php

    toonZoekOrganisatie("f", "", "", "");

?>

      <div class="label160">&nbsp; </div>

      <div class="waarde">
         <input type="submit" value="Zoek zorgplannen"/>
      </div>


</form>
<?php
}

if (isset($_POST['organisatie'])) {

   print("<h1>Overzicht zorgplannen</h1>\n");
   print("<p>Bij volgende zorgplannen zijn er momenteel zorg- of hulpverleners van <strong>{$_POST['organisatieInput']}</strong> betrokken.</p>\n");
   if (isset($queryNog)) {
     print("<h1>Van volgende pati&euml;nten ben je organisator </h1>");
   }

//   print($query);
   toonZPs($query);

   if (isset($queryNog)) {
     print("<h1>Bij volgende pati&euml;nten ben je betrokkenen hulpverlener</h1>");
     toonZPs($queryNog);
   }

   toonFormulier();
}

else {

  print("<h1>Zoek zorgplannen op organisatie</h1>\n");
  print("<p>Selecteer hieronder een organisatie om de zorgplannen op te vragen <br/>waarbij zorg- of hulpverleners van deze organisatie betrokken zijn.</p>\n");

  toonFormulier();

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



