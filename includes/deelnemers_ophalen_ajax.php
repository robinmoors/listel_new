

<style type="text/css">

   .aanwezig {

      background-color: rgb(70%, 100%, 70%);

   }

   .afwezig {

      background-color: rgb(100%, 70%, 70%);

   }

   .onbekend {

      background-color: rgb(70%, 70%, 70%);

   }

</style>
<?php


if (!isset($rechtenFunctie)) {
    $rechtenFunctie = "Huidig('{$_SESSION['pat_code']}',";
    $rechtenArray = "huidig_";
?>
<script type="text/javascript">
  var rechten=new Array();
</script>
<?php
}
?>

<script type="text/javascript">

function veranderAanwezigheid(divID, betrokkeneID) {

  var request = createREQ();

  

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "overleg_deelnemers_aanwezigheid_ajax.php?id=" + betrokkeneID +

<?php

   if ($aanpassenBijAfgerond) {

     print(" \"&tabel=afgeronde\" + ");

     $betrokkenenTabel = "afgeronde_betrokkenen";

     $tabelSubsidieStatus = "afgeronde";

     $kolomSubsidieStatus = "overleg_id";

     $waardeSubsidieStatus = $overlegID;

   }

   else {

     $betrokkenenTabel = "huidige_betrokkenen";

     $tabelSubsidieStatus = "huidige";

     $kolomSubsidieStatus = "patient_code";

     $waardeSubsidieStatus = $_SESSION['pat_code'];

   }

?>

            "&overlegID=<?= $overlegID ?>&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState < 4) {

       document.getElementById(divID).className = "onbekend";

    }

    else {

      var result = request.responseText;

      var spatie = 0;

      while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else if (result.substr(3,1) == "0") {

         updateStatus(result.substr(5));

         document.getElementById(divID).className = "afwezig";

         //document.getElementById('status').innerHTML = result;

      }

      else {

         updateStatus(result.substr(5));

         document.getElementById(divID).className = "aanwezig";

         //document.getElementById('status').innerHTML = result;

      }

      

<?php

  if ($checkSubsidiestatus) { // dit wordt bepaald in ofwel includes/overleg_basisgegevens.php of php/controle.php

?>

      // en dan nu de subsidiestatus aanpassen (van het zorgplan)

      //alert("herbereken subsidiestatus");

      berekenSubsidiestatus("subsidiestatusDiv", "<?= $_SESSION['pat_code'] ?>", "<?= $tabelSubsidieStatus ?>", "<?= $kolomSubsidieStatus ?>", "<?= $waardeSubsidieStatus ?>", 0);

<?php

  }

?>

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}



function maakContactpersoon(kolom, id) {

  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "overleg_contactpersoon.php?kolom=" + kolom + "&id=" + id +

            "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var result = request.responseText;

      var spatie = 0;

      while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {
         if (kolom == "contact_mz") {
           alert("De (nieuwe) contactpersoon is opgeslagen.");
           contactMZ = true;
         }
         else {
           alert("De (nieuwe) " + soortContact + " is opgeslagen. Het is zijn/haar verantwoordelijkheid \nhet zorgplan periodiek op te volgen en te evalueren in samenspraak met de OCTGZ.");
           contactHVL = true;
         }
         if (contactMZ && contactHVL) {

             document.getElementById('contactPersonenTekort').style.display = "none";

         }

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}

</script>

<?php



/*************************************************************************************

 * $overlegInfo bevat het overleg waarvan de deelnemers opgehaald moeten worden!!

   print_r($overlegInfo);

 *************************************************************************************/

    if ($overlegInfo['genre']=="psy") {
       $soortZorgbemiddelaar = "referentiepersoon";
    }
    else {
       $soortZorgbemiddelaar = "zorgbemiddelaar";
    }

$hoogte = 40;



if (!isset($baseURL)) {
  $baseURL = $baseURL1 = "overleg_alles.php?tab=Teamoverleg";
}
if (strpos($baseURL,"?")===FALSE) {
  $baseURL = $baseURL . "?x=1";
}
if (!(isset($voorwaarde))) {
  $voorwaarde = " bl.patient_code='{$_SESSION['pat_code']}' ";
}

if (!(isset($tabel))) {

  $tabel = "huidige";

}



if (!isset($overlegGenre)) {
  if (!isset($overlegInfo) || $overlegInfo['genre']=='menos') {
    $overlegGenre = 'menos';
  }
  else {
    $overlegGenre = 'gewoon';
  }
}
if ($overlegGenre == "psy") {
  $overlegGenreBetrokkene = "gewoon";
}
else {
  $overlegGenreBetrokkene = $overlegGenre;
}



if (isset($_GET['stopID'])) {
  if ($overlegInfo['genre']=="TP" && $betrokkenenTabel == "huidige_betrokkenen") {

    $selectDeleteInfo = "select * from huidige_betrokkenen where id = {$_GET['stopID']}";

    $deleteInfo = mysql_fetch_assoc(mysql_query($selectDeleteInfo));

    $delQuery2 = "delete from overleg_tp_plan where persoon = {$deleteInfo['persoon_id']} and genre = '{$deleteInfo['genre']}' and overleg = {$overlegInfo['id']}";

    mysql_query($delQuery2) or print($delQuery2 . " is niet gelukt.");
    $delQuery = "delete from $betrokkenenTabel where id = {$_GET['stopID']}";
    if (mysql_query($delQuery))
    {
       $melding="Bedrijfsgegevens zijn <b>succesvol verwijderd</b>.<br>";
    }
  }
  else {
         $delQuery = "delete from $betrokkenenTabel where id = {$_GET['stopID']}";
         $genre = getUniqueRecord("select * from $betrokkenenTabel where id = {$_GET['stopID']}");

         if ($genre['genre']=="hulp" || $genre['genre']=="orgpersoon") {
            $hvl = getUniqueRecord("select hvl.* from hulpverleners hvl inner join $betrokkenenTabel betr
                               on betr.id = {$_GET['stopID']} and betr.persoon_id = hvl.id ");
            $soort = "";
         }
         else {
            $hvl = getUniqueRecord("select hvl.* from mantelzorgers hvl inner join $betrokkenenTabel betr
                               on betr.id = {$_GET['stopID']} and betr.persoon_id = hvl.id ");
            $soort = "de mantelzorger ";
         }
        if (mysql_query($delQuery))
        {
           $melding="Bedrijfsgegevens zijn <b>succesvol verwijderd</b>.<br>";
               /************** overdracht tussen zorgteams GDT en Menos *************/
               if (strpos($betrokkenenTabel,"uidige")>0) {
                 //die("<h1>Ja we gaan wissen!</h1>");
                 if (!isset($bijWieValue)) {
                   $bijWieValue = "'{$_SESSION['pat_code']}'";
                 }
                 $zoekMenosQry = "select patient_menos.*,patient.actief, menos
                                      from patient inner join patient_menos on patient = code and patient = $bijWieValue";
                 $zoekMenosResult = mysql_query($zoekMenosQry) or die("ik kan de menos-gegevens van deze patient niet controleren $zoekMenosQry");
                 if (mysql_num_rows($zoekMenosResult) > 0) {
                   // het is een menos-patient
                   $zoekMenos = mysql_fetch_assoc($zoekMenosResult);
                   if ($overlegGenre == 'menos' && (abs($zoekMenos['actief'])==1) && ($zoekMenos['menos2gdt_vraag'] == 1) && ($zoekMenos['menos2gdt_toestemming'] == 1)) {
                     // van menos naar gdt
                       // mail versturen
                       $mensen = organisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       htmlmail($adressen,"Listel: verwijdering uit GDT-zorgteam","Beste $namen<br/>Vanuit Menos is $soort {$hvl['voornaam']} {$hvl['naam']} verwijderd uit het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, wordt u hiervan verwittigd, maar de verwijdering gebeurt niet automatisch.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                   }
                   else if ($overlegGenreBetrokkene == 'gewoon' && (abs($zoekMenos['menos'])==1) && $zoekMenos['gdt2menos_vraag'] == 1 && $zoekMenos['gdt2menos_toestemming'] == 1) {
                     // van gdt naar menos
                       // mail versturen
                       $mensen = menosOrganisatorenVanPatient($bijWieValue);
                       for ($i=0; $i<mysql_num_rows($mensen); $i++) {
                         $pc  = mysql_fetch_assoc($mensen);
                         $namen .= ", {$pc['naam']} {$pc['voornaam']}";
                         $adressen .= ", {$pc['email']}";
                       }

                       $namen = substr($namen, 1);
                       $adressen = substr($adressen, 1);

                       htmlmail($adressen,"Listel: verwijdering uit Menos-zorgteam","Beste $namen<br/>Vanuit GDT is $soort {$hvl['voornaam']} {$hvl['naam']} verwijderd uit het zorgteam van pati&euml;nt $bijWieValue.
                                                   En zoals aangeduid op het formulier met de pati&euml;nt-gegevens, wordt u hiervan verwittigd, maar de verwijdering gebeurt niet automatisch.
                                                   <br />Het LISTEL e-zorgplan www.listel.be </p>");
                   }
                 }
               }
              /************** einde overdracht tussen zorgteams GDT en Menos *************/
        }
   }


}





//include("../includes/toonSessie.inc");

    $fouteRekeningnummers = "";

    print("<table width=\"520\" style=\"border:solid 1px black;padding:10px;\">");



if ($overlegInfo['genre']=="TP") {

?>

    <tr><td>

                    <table><tr><td>&nbsp;

                    <!--

                      <a href="overleg_plannen_select_partners_twee.php<?= $extraParameterSelectPersonen ?>">

                      <img src="../images/voegtoe.gif" alt="Toevoegen"  border="0"/></a>

                    -->

                    </td><td><b>Partners TP</b></td></tr></table>

                    </td></tr>



<?php
  if (!isset($overlegGenreVoorwaarde)) {
    $overlegGenreVoorwaarde = "bl.overleggenre = 'gewoon' AND";
  }

  $qryOrgs = "select organisatie.id as org_id, organisatie.naam from {$tabel}_betrokkenen bl, organisatie

              where bl.genre = 'org' AND
                $overlegGenreVoorwaarde
                persoon_id = organisatie.id AND

                $voorwaarde";

  $resultOrgs = mysql_query($qryOrgs) or die("foutje met $qryOrgs " . mysql_error());

  for ($orgnr = 0; $orgnr < mysql_num_rows($resultOrgs); $orgnr++) {

    $org = mysql_fetch_assoc($resultOrgs);

    

    // eerst alle subzetels/vestigingen toevoegen

    $queryVestigingen = "select id from organisatie

                         where hoofdzetel = {$org['org_id']}";

    $resultVestigingen = mysql_query($queryVestigingen) or die("dedoemme $queryVestigingen");

    $orgs = "";

    for ($ii=0;$ii<mysql_num_rows($resultVestigingen);$ii++) {

      $bijOrg = mysql_fetch_assoc($resultVestigingen);

      $orgs .= ", {$bijOrg['id']}";

    }





     // dan alle gelijkaardige organisatie pakken: de 'vijvers'

     $zoekTerm = "";

     $naam = $org['naam'];

     if (substr($naam,0,3)=='CGG') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'CGG%' ";

       $CGG = false;

     }

     else if (substr($naam,0,4)=='DAGG') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'DAGG%' ";

       $DAGG = false;

     }

     else if (substr($naam,0,4)=='VGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'VGGZ%' ";

       $VGGZ = false;

     }

     else if (substr($naam,0,5)=='RCGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'RCGGZ%' ";

       $RCGGZ = false;

     }

     else if (substr($naam,0,6)=='ARCGGZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'ARCGGZ%' ";

       $ARCGGZ = false;

     }

     else if (substr($naam,0,2)=='BW') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'BW%' ";

       $BW = false;

     }

     else if (substr($naam,0,2)=='PZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'PZ%' ";

       $PZ = false;

     }

     else if (substr($naam,0,3)=='KPZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'KPZ%' ";

       $KPZ = false;

     }

     else if (substr($naam,0,3)=='PTZ') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'PTZ%' ";

       $PTZ = false;

     }

     else if (substr($naam,0,3)=='PVT') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'PVT%' ";

       $PVT = false;

     }

     else if (substr($naam,0,3)=='CLB') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'CLB%' ";

       $CLB = false;

     }

     else if (substr($naam,0,4)=='VCLB') {

       $zoekTerm = "select id from organisatie where id <> {$org['org_id']} and naam LIKE 'VCLB%' ";

       $VCLB = false;

     }



     if ($zoekTerm <> "") {

       $resultVijvers = mysql_query($zoekTerm);

       for ($vijver = 0; $vijver < mysql_num_rows($resultVijvers); $vijver++) {

         $bijOrg = mysql_fetch_assoc($resultVijvers);

         $orgs .= ", {$bijOrg['id']}";

       }

     }





    // de organisatie zelf toevoegen!

    $orgs = "{$org['org_id']} $orgs";





    $extraParameterSelectPersonenZonderVraagteken = "&" . substr($extraParameterSelectPersonen,1);

    print("<tr><td><li><a href=\"overleg_plannen_select_partners_twee.php?org={$org['org_id']}&orgnaam={$org['naam']}$extraParameterSelectPersonenZonderVraagteken\">

                      <img height=\"15\" src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"/></a>

                      <b>{$org['naam']}</b></li></td></tr>");

    $hoogte += 25;

    if (!isset($overlegGenreVoorwaarde)) {
      $overlegGenreVoorwaarde = "bl.overleggenre = 'gewoon' AND";
    }

    $qryOrgPersonen = "
         SELECT
                bl.id,
                h.naam as hulpverlener_naam,
                h.voornaam as voornaam,
                bl.persoon_id,
                bl.rechten,
                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.reknr,
                h.iban,
                h.bic,

                h.tel,

                h.organisatie,
                h.validatiestatus,

                organisatie.naam as org_naam,

                aanwezig

            FROM

                {$tabel}_betrokkenen bl,

                hulpverleners h,

                organisatie

            WHERE
                $overlegGenreVoorwaarde
                bl.genre = 'orgpersoon' AND

                bl.persoon_id = h.id AND

                

                bl.namens = {$org['org_id']} AND

                h.organisatie = organisatie.id AND



                $voorwaarde

                $beperking";

// was                 h.organisatie in ($orgs) AND



     $resultPersonen = mysql_query($qryOrgPersonen) or die("problemen met $qryOrgPersonen " . mysql_error());

     if (mysql_num_rows($resultPersonen) == 0) {

       $hoogte += 25;

       print("<tr style='background-color: yellow'><td>-- geen vertegenwoordigers voor deze organisatie -- </td></tr>");

     }

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {

       $persoon = mysql_fetch_assoc($resultPersonen);

            $aanwezig = $persoon['aanwezig'] == 1;

            if ($aanwezig)  {

              $stijl = "aanwezig";

              $checked ="checked=\"checked\"  title=\"klik om afwezig te melden\"";

            }

            else {

              $stijl = "afwezig";

              $checked = " title=\"klik om aanwezig te melden\"";

            }

            if ($persoon['persoon_id'] == $overlegInfo['contact_hvl']) {

              $checkedCP = "checked=\"checked\"   title=\"dit is de $soortZorgbemiddelaar\"";

            }

            else {

              $checkedCP = " title=\"duid aan als $soortZorgbemiddelaar\"";

            }

            $hoogte += 25;

            $veld1=($persoon['hulpverlener_naam']!="")    ?$persoon['hulpverlener_naam']    :"&nbsp;";

            $veld2=($persoon['voornaam']!="")?$persoon['voornaam']:"&nbsp;";



            if ($persoon['org_naam']!=$org['naam']) {

              $organisatieNaam = $persoon['org_naam'];

            }

            else {

              $organisatieNaam = "";

            }
            if ($persoon['validatiestatus']=="" ||  $persoon['validatiestatus']=="geenkeuze"
                 || ($persoon['validatiestatus']=="weigering" && $persoon['logindatum']>0) // ooit ingelogd, dan is weigering gelijk aan vervallen
               ) {
              $validatieTonen = " style=\"font-style: italic;\" ";
            }
            else {
              $validatieTonen = "";
            }

            print ("

                <tr class=\"$stijl\" id=\"rij{$persoon['id']}\"><td>

                <table><tr><td><input type=\"checkbox\" name=\"id{$persoon['id']}\" $checked

                   onclick=\"{$checkVerandering}veranderAanwezigheid('rij{$persoon['id']}', {$persoon['id']})\"></td>

                <td width=\"210\" title=\"$titel\" $validatieTonen>".$veld1." ".$veld2."</td>

                <td>&nbsp;$organisatieNaam</td>

                </tr></table>

                </td>

                <td><input type=\"radio\" name=\"contactHVL$divID\" $checkedCP

                           onClick=\"{$checkVerandering}return maakContactpersoon('contact_hvl',{$persoon['persoon_id']});\"></td>

                <td><a href=\"$baseURL&stopID=".$persoon['id']."\">

                <img src=\"../images/wis2.gif\" alt=\"Verwijder als betrokkene\"  border=\"0\"></a></td>

                </tr>");

     }

  }







}

    if (isset($alleenGroen) && $alleenGroen) {

      $beperking = ""; //"AND aanwezig = 1";

    }

    else {

      $beperking = "";

    }







if (!function_exists('toonBetrokkenen')) {

function toonBetrokkenen($overlegInfo, $genre ,$tabel, $voorwaarde, $checkVerandering,$extraParameterSelectPersonen="", $extraParameterSelectPersonen2="", $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $teamGenre) {

    global $beperking, $hoogte, $huisarts, $patientInfo, $soortZorgbemiddelaar;

    if ($teamGenre=='menos') {
       $overlegGenreVoorwaarde = " bl.overleggenre = 'menos' AND ";
       $overlegGenre = "menos";
    }
    else {
       $overlegGenreVoorwaarde = " bl.overleggenre = 'gewoon' AND ";
       $overlegGenre = "gewoon";
    }

    $fouteRekeningnr = ""; // lokale variabele

    $hoogte += 25;

    

    //----------------------------------------------------------

    // HulpverlenersLijst weergeven

    //print ("<tr>    <td><b>Zorg&nbsp;en&nbsp;hulpverlening</b></td></tr>");

    //print ("<tr>    <td><hr /></td></tr>");
    if ($genre == "ZVL") {

      print ("<tr><td>

                    <table><tr><td><a href=\"overleg_plannen_select_zvl_twee.php$extraParameterSelectPersonen\">

                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>

                    </td><td><b>Zorgverleners</b></td></tr></table>

              </td></tr>");

      $orgGenre = "o.genre = 'ZVL' ";
    }

    else if ($genre == "HVL") {

      print ("<tr><td>

                    <table><tr><td><a href=\"overleg_plannen_select_hvl_twee.php$extraParameterSelectPersonen\">

                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>

                    </td><td><b>Hulpverleners opgenomen in GDT</b></td></tr></table>

              </td></tr>");

      $orgGenre = "o.genre = 'HVL' ";

    }

    else if ($genre == "XVL") {

      print ("<tr><td>

                    <table><tr><td><a href=\"overleg_plannen_select_xvl_twee.php$extraParameterSelectPersonen\">

                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>

                    </td><td><b>Hulpverleners niet-GDT en niet-professionelen</b></td></tr></table>

              </td></tr>");

      $orgGenre = "(o.genre = 'XVLNP' or o.genre = 'XVLP') ";

    }

    else if ($genre == "XVLP") {

      print ("<tr><td>

                    <table><tr><td><a href=\"overleg_plannen_select_xvl_twee.php?genre=xvlp$extraParameterSelectPersonen2\">

                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>

                    </td><td><b>Hulpverleners niet opgenomen in GDT</b></td></tr></table>

              </td></tr>");

      $orgGenre = "o.genre = 'XVLP' ";

    }

    else if ($genre == "XVLNP") {

      print ("<tr><td>

                    <table><tr><td><a href=\"overleg_plannen_select_xvl_twee.php?genre=xvlnp$extraParameterSelectPersonen2\">

                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>

                    </td><td><b>Niet-professionelen</b></td></tr></table>

              </td></tr>");

      $orgGenre = "o.genre = 'XVLNP' ";

    }
    else {
      $orgGenre = " 3 = 4 ";
    }

    $ggzVoorwaarde = "((o.ggz = 1) or f.id in (62,76,117))";
    if ($teamGenre == "psy" && $genre != "GGZ") {
      $orgGenre .= " and not $ggzVoorwaarde ";
    }
    else if ($genre == "GGZ") {
      print ("<tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_ggz_twee.php$extraParameterSelectPersonen\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>GGZ</b></td></tr></table>
              </td></tr>");
      $orgGenre = $ggzVoorwaarde;
    }

    $queryHVL = "

         SELECT 

                bl.id,
                bl.rechten,
                h.naam as hulpverlener_naam,

                h.voornaam as voornaam,
                h.validatiestatus,
                f.naam as functie_naam,

                bl.persoon_id,

                h.riziv1,

                h.riziv2,

                h.riziv3,

                h.reknr,
                h.iban,
                h.bic,
                h.tel,

                h.organisatie,
                o.genre as org_genre,
                o.art107,
                h.fnct_id,

                f.groep_id,

                aanwezig

            FROM 

                {$tabel}_betrokkenen bl,

                functies f,

                hulpverleners h

                left join organisatie o on h.organisatie = o.id

            WHERE
                $overlegGenreVoorwaarde
                bl.genre = 'hulp' AND

                h.fnct_id = f.id AND

                bl.persoon_id = h.id AND

                $orgGenre AND

                $voorwaarde

                $beperking

            ORDER BY

                f.rangorde, bl.id"; //




      if ($resultHVL=mysql_query($queryHVL))

         {

         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)

            {

            $recordsHVL= mysql_fetch_array($resultHVL);



            $veld1=($recordsHVL['hulpverlener_naam']!="")    ?$recordsHVL['hulpverlener_naam']    :"&nbsp;";

            $veld2=($recordsHVL['voornaam']!="")?$recordsHVL['voornaam']:"&nbsp;";

            $veld3=($recordsHVL['functie_naam']!="")   ?$recordsHVL['functie_naam']   :"&nbsp;";

            //$veld3=($recordsHVL['betrokhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;

            if (isset($recordsHVL['riziv1']) && $recordsHVL['riziv1'] != 0) {

              $titel = $rizivnr=   "rizivnr : " . substr($recordsHVL['riziv1'],0,1)."-".

                                   substr($recordsHVL['riziv1'],1,5)."-".

                                   $recordsHVL['riziv2']."-".$recordsHVL['riziv3'];

            }

            else {

              // organisatie ophalen

              if (issett($recordsHVL['organisatie'])) {

                 $orgNaam = mysql_fetch_array(mysql_query("select naam from organisatie where id = {$recordsHVL['organisatie']}"));

                 $titel = $orgNaam['naam'];

              }

              else

                $titel = $recordsHVL['tel'];

            }



            $aanwezig = $recordsHVL['aanwezig'] == 1;

            if ($aanwezig)  {

              $stijl = "aanwezig";

              $checked ="checked=\"checked\"  title=\"klik om afwezig te melden\"";

            }

            else {

              $stijl = "afwezig";

              $checked = " title=\"klik om aanwezig te melden\"";

            }

            if ($recordsHVL['persoon_id'] == $overlegInfo['contact_hvl']) {

              $checkedCP = "checked=\"checked\"   title=\"dit is de $soortZorgbemiddelaar\"";

            }

            else {

              $checkedCP = " title=\"duid aan als $soortZorgbemiddelaar\"";

            }



            $hoogte += 27;

            if ($genre == "ZVL" && $recordsHVL['iban'] == "") {

              if (geenRekeningNummer($recordsHVL['organisatie']))

                $fouteRekeningnr .= "   - {$recordsHVL['hulpverlener_naam']} {$recordsHVL['voornaam']} \\n ";

            }



            // huisartstest

            if ($recordsHVL['fnct_id']==1) {

              $huisarts .= "\n huisarts[$huisartsNr]=({$recordsHVL['aanwezig']}==1); ";

              $huisartsCheck = "toggleHuisarts($huisartsNr);";

              $huisartsNr++;

            }

            else {

              $huisartsCheck = "";

            }
            // als het een overleg psy is, mag niet iedereen contactpersoon zijn!
            if ($overlegInfo['genre']=="psy") {
               if (($recordsHVL['fnct_id']==13 ||
                    $recordsHVL['fnct_id']==65 ||
                    $recordsHVL['fnct_id']==62 ||
                    $recordsHVL['fnct_id']==72 ||
                    $recordsHVL['fnct_id']==117 ||
                    $recordsHVL['fnct_id']==125 ||
                    $recordsHVL['fnct_id']==126 ||
                    $recordsHVL['fnct_id']==127 ||
                    $recordsHVL['fnct_id']==8 ||
                    $recordsHVL['fnct_id']==10 ||
                    $recordsHVL['fnct_id']==76 ||  // kinderpsychiater
// ook alle VPL
                    $recordsHVL['fnct_id']==17 ||
                    $recordsHVL['fnct_id']==27 ||
                    $recordsHVL['fnct_id']==51 ||
                    $recordsHVL['fnct_id']==60 ||
                    $recordsHVL['fnct_id']==63 ||

                    $recordsHVL['org_genre'] =="ZVL")
                   )
               {
                 $magContactPersoon = ""; // niet onzichtbaar maken
               }
               else {
                 $magContactPersoon = " style=\"visibility:hidden;\" ";
               }
            }
            else {
              $magContactPersoon = ""; // niet onzichtbaar maken
            }
            $JSRechten .= "rechten['$rechtenArray'+'hulp{$recordsHVL['persoon_id']}']={$recordsHVL['rechten']};\n";

    if ($_SESSION['profiel']=="listel") {
      $magVeranderen = true;
    }
    else if ($overlegInfo['toegewezen_genre']=="gemeente" && $_SESSION['profiel']=="OC") {
      $magVeranderen = true;
    }
    else if ($overlegInfo['toegewezen_genre']=="hulp" && $_SESSION['profiel']=="hulp"
             && $overlegInfo['toegewezen_id']== $_SESSION['usersid']) {
      $magVeranderen = true;
    }
    else if ($overlegInfo['toegewezen_genre']=="psy" && $_SESSION['profiel']=="psy"
             && $overlegInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    else if ($overlegInfo['toegewezen_genre']=="rdc" && $_SESSION['profiel']=="rdc"
             && $overlegInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    // en nu nog eens proberen voor patientInfo
    else if ($patientInfo['toegewezen_genre']=="gemeente" && $_SESSION['profiel']=="OC") {
      $magVeranderen = true;
    }
    else if ($patientInfo['toegewezen_genre']=="hulp" && $_SESSION['profiel']=="hulp"
             && $patientInfo['toegewezen_id']== $_SESSION['usersid']) {
      $magVeranderen = true;
    }
    else if ($patientInfo['toegewezen_genre']=="psy" && $_SESSION['profiel']=="psy"
             && $patientInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    else if ($patientInfo['toegewezen_genre']=="rdc" && $_SESSION['profiel']=="rdc"
             && $patientInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    else {
      $magVeranderen = false;
    }
/*
   MET ONDERSTAANDE CODE MAG DE ZORGBEMIDDELAAR RECHTEN VERANDEREN.
    if (isZorgBemiddelaar()) {
      $magVeranderen = true;
    }
    else if ($tabel=="afgeronde") {
      $magVeranderen = false;
    }
    else if (isNuOrganisator()){
      $magVeranderen = true;
    }
    else {
      $magVeranderen = false;
    }
*/

    if ($magVeranderen) {
      $onclick = "  onclick=\"veranderRechten{$rechtenFunctie}'hulp',{$recordsHVL['persoon_id']});\"";
      $titleNiet = " title=\"klik om rechten toe te kennen\"";
      $titleWel = " title=\"klik om rechten af te nemen\"";
    }
    else {
      $onclick = "";
      $titleNiet = " title=\"heeft geen rechten\"";
      $titleWel = " title=\"heeft wel rechten\"";
    }
            if ($overlegInfo['genre']=="TP") {
              $rechtenImg = "";
            }
            else if ($overlegGenre == "menos") {
              $rechtenImg = "";
            }
            else if ($recordsHVL['rechten']==0) {
              $rechtenImg = "<td><img id=\"hulp{$rechtenArray}Rechten{$recordsHVL['persoon_id']}\" width=\"24\" src=\"../images/oog_dicht.jpg\" alt=\"geen rechten\" $onclick $titleNiet /></td>";
            }
            else {
              $rechtenImg = "<td><img id=\"hulp{$rechtenArray}Rechten{$recordsHVL['persoon_id']}\" width=\"24\" src=\"../images/oog_open.jpg\" alt=\"wel rechten\" $onclick $titleWel /></td>";
            }
            
            if ($overlegInfo['genre']!="TP" && ($recordsHVL['validatiestatus']=="" ||  $recordsHVL['validatiestatus']=="geenkeuze")) {
              $validatieTonen = " style=\"font-style: italic;\" ";
            }
            else {
              $validatieTonen = "";
            }


            print ("

                <tr class=\"$stijl\" id=\"rij{$recordsHVL['id']}\"><td>

                <table><tr><td><input type=\"checkbox\" name=\"id{$recordsHVL['id']}\" $checked

                   onclick=\"{$checkVerandering}{$huisartsCheck}veranderAanwezigheid('rij{$recordsHVL['id']}', {$recordsHVL['id']})\"></td>

                <td width=\"210\" title=\"$titel\" $validatieTonen>".$veld1." ".$veld2."</td>

                <td>".$veld3."</td>

                </tr></table>

                </td>

                <td><input type=\"radio\" name=\"contactHVL$divID\" $checkedCP $magContactPersoon

                           onClick=\"{$checkVerandering}return maakContactpersoon('contact_hvl',{$recordsHVL['persoon_id']});\"></td>

                <td><a href=\"$baseURL&stopID=".$recordsHVL['id']."\">

                <img src=\"../images/wis2.gif\" alt=\"Verwijder als betrokkene\"  border=\"0\"></a></td> 
                <td>$rechtenImg</td>

                </tr>");}}

    //----------------------------------------------------------



    //print("<h1>1: $fouteRekeningnummers</h1>");
    print("\n<script type=\"text/javascript\">\n$JSRechten\n</script>\n");

    return "$huisartsNr+!!+$fouteRekeningnr";

}

}



$huisartsNr = 0;


if ($overlegInfo['genre']=="psy") {
  $nrEnFouteReknr = toonBetrokkenen($overlegInfo, "GGZ", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $overlegGenre);
  $positie = strpos($nrEnFouteReknr,"+!!+");
  $huisartsNr = substr($nrEnFouteReknr,0,$positie);
  $fouteRekeningnummers .= substr($nrEnFouteReknr, $positie+4);
}


$nrEnFouteReknr = toonBetrokkenen($overlegInfo, "ZVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $overlegGenre);
$positie = strpos($nrEnFouteReknr,"+!!+");
$huisartsNr = substr($nrEnFouteReknr,0,$positie);
$fouteRekeningnummers .= substr($nrEnFouteReknr, $positie+4);

$nrEnFouteReknr = toonBetrokkenen($overlegInfo, "HVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $overlegGenre);
$positie = strpos($nrEnFouteReknr,"+!!+");
$huisartsNr = substr($nrEnFouteReknr,0,$positie);
$fouteRekeningnummers .= substr($nrEnFouteReknr, $positie+4);



if (isset($overlegInfo) && $overlegInfo['genre']=="TP") {

  $nrEnFouteReknr = toonBetrokkenen($overlegInfo, "XVLP", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $overlegGenre);

  $positie = strpos($nrEnFouteReknr,"+!!+");

  $huisartsNr = substr($nrEnFouteReknr,0,$positie);

  $fouteRekeningnummers .= substr($nrEnFouteReknr, $positie+4);



  $nrEnFouteReknr = toonBetrokkenen($overlegInfo, "XVLNP", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $overlegGenre);

  $positie = strpos($nrEnFouteReknr,"+!!+");

  $huisartsNr = substr($nrEnFouteReknr,0,$positie);

  $fouteRekeningnummers .= substr($nrEnFouteReknr, $positie+4);

}

else {

  $nrEnFouteReknr = toonBetrokkenen($overlegInfo, "XVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr, $rechtenArray, $rechtenFunctie, $overlegGenre);

  $positie = strpos($nrEnFouteReknr,"+!!+");

  $huisartsNr = substr($nrEnFouteReknr,0,$positie);

  $fouteRekeningnummers .= substr($nrEnFouteReknr, $positie+4);

}



/*

$ffouteRekeningnummers .= toonBetrokkenen("ZVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr);

$ffouteRekeningnummers .= toonBetrokkenen("HVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr);



if ($overlegInfo['genre']=="TP") {

  $ffouteRekeningnummers .= toonBetrokkenen("XVLP", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr);

  $ffouteRekeningnummers .= toonBetrokkenen("XVLNP", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr);

}

else {

  $ffouteRekeningnummers .= toonBetrokkenen("XVL", $tabel, $voorwaarde, $checkVerandering, $extraParameterSelectPersonen, $extraParameterSelectPersonen2, $baseURL, $huisartsNr);

}

*/





if (($huisartsNr > 0) && (isEersteOverlegTP())) {

  echo <<< EINDE

  <script language="javascript" type="text/javascript">

    function toggleHuisarts(nr) {};

    function huisartsAanwezig() {

       return false;

    }

  </script>

EINDE;



}

else if (($huisartsNr > 0) && (!isEersteOverlegTP())) {

  $alleenKatzWanneerHuisartsen = "<script type=\"text/javascript\">huisartsAanwezig();</script>";

  echo <<< EINDE



  <script language="javascript" type="text/javascript">

    function toggleHuisarts(nr) {

      huisarts[nr]=!huisarts[nr];

      huisartsAanwezig();

    }

    function huisartsAanwezig() {

      var aanwezig = false;

      for (i=0; i<huisarts.length; i++) {

        aanwezig = aanwezig || huisarts[i];

      }

      var katzInvullen = document.getElementById('katzScoreInvullen');

      var katzEmail = document.getElementById('katzScoreEmail');
      var verklaringHuisartsAanduiden = document.getElementById('verklaringHuisartsAanduiden');

      if (katzInvullen) {

        if (aanwezig) {

          katzInvullen.style.display="block";
          katzEmail.style.display="block";
          verklaringHuisartsAanduiden.style.display = "block";
        }

        else {

          katzInvullen.style.display="none";
          katzEmail.style.display="none";
          verklaringHuisartsAanduiden.style.display = "none";

        }

      }



      return aanwezig;

    }

    var huisarts = new Array();

    $huisarts

  </script>

EINDE;

}

else {

  $alleenKatzWanneerHuisartsen = "

      <script type=\"text/javascript\">

          if (document.getElementById('katzScoreInvullen')) {

              document.getElementById('katzScoreInvullen').style.display='none';

              document.getElementById('katzScoreEmail').style.display='none';

          }

      </script>";

  echo <<< EINDE



  <script language="javascript" type="text/javascript">

    function huisartsAanwezig() {return false; }

  </script>

EINDE;

}



    if ($fouteRekeningnummers != "") {

?>

<script language="javascript" type="text/javascript">

  var fouteRekeningnummers = "Van volgende hulpverleners is het rekeningnummer nog ongekend:\n <?= $fouteRekeningnummers ?>\nWe hebben die nodig om een geldige factuur te kunnen maken en daarom kan je niet afronden.";

  //alert(fouteRekeningnummers);

</script>

<?php

    }

    else {

?>

<script language="javascript" type="text/javascript">

  var fouteRekeningnummers = "";

  //alert("De rekeningnummers zijn in orde!");

</script>

<?php

    }

    //----------------------------------------------------------

    // MantelzorgersLijst weergeven

    //print ("<tr><td>&nbsp;</td></tr>");

    //print ("<tr><td><b>Mantelzorg</b></td></tr>");

    print ("<tr><td><hr /></td></tr>");

    print ("<tr><td>

                    <table><tr><td><a href=\"overleg_plannen_select_mz_twee.php$extraParameterSelectPersonen\">

                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>

                    </td><td><b>Mantelzorger</b></td></tr></table>                  

                    </td></tr>");   

    if (!isset($overlegInfo) || $overlegInfo['genre']=='menos') {
       $overlegGenreVoorwaarde = "bl.overleggenre = 'menos' AND";
    }
    else {
       $overlegGenreVoorwaarde = "bl.overleggenre = 'gewoon' AND";
    }


    $query = "

         SELECT

                bl.id,
                bl.rechten,
                m.naam as naam,
                m.voornaam,
                m.validatiestatus,

                bl.persoon_id,

                v.naam as verwantschap_naam,

                v.rangorde,

                aanwezig

            FROM 

                {$betrokkenenTabel} bl,

                mantelzorgers m,

                verwantschap v

            WHERE 
                $overlegGenreVoorwaarde
                bl.persoon_id = m.id AND

                bl.genre = 'mantel' AND

                v.id = m.verwsch_id AND

                $voorwaarde

                $beperking

            ORDER BY 

                v.rangorde,m.naam";


      if ($result=mysql_query($query))

         {

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            $veld1=($records['naam']!="")?$records['naam']:"&nbsp;";

            $veld2=($records['voornaam']!="")?$records['voornaam']:"&nbsp;";



            $aanwezig = $records['aanwezig'] == 1;



            if ($aanwezig)  {

              $stijl = "aanwezig";

              $checked ="checked=\"checked\"  title=\"klik om afwezig te melden\"";

            }

            else {

              $stijl = "afwezig";

              $checked = " title=\"klik om aanwezig te melden\"";

            }

            if ($records['persoon_id'] == $overlegInfo['contact_mz']) {

              $checkedCP = "checked=\"checked\" title=\"dit is de contactpersoon\" ";

            }

            else {

              $checkedCP = " title=\"duid aan als contactpersoon\" ";

            }

            $hoogte += 27;

            $JSRechten .= "rechten['$rechtenArray'+'mantel{$records['persoon_id']}']={$records['rechten']};\n";


/* MANTELZORGERS VOORLOPIG NOG NIET LATEN REGISTREREN
    if ($overlegInfo['toegewezen_genre']=="gemeente" && $_SESSION['profiel']=="OC") {
      $magVeranderen = true;
    }
    else if ($overlegInfo['toegewezen_genre']=="hulp" && $_SESSION['profiel']=="hulp"
             && $overlegInfo['toegewezen_id']== $_SESSION['usersid']) {
      $magVeranderen = true;
    }
    else if ($overlegInfo['toegewezen_genre']=="rdc" && $_SESSION['profiel']=="rdc"
             && $overlegInfo['toegewezen_id']== $_SESSION['organisatie']) {
      $magVeranderen = true;
    }
    else {
      $magVeranderen = false;
    }

   MET ONDERSTAANDE CODE MAG DE ZORGBEMIDDELAAR RECHTEN VERANDEREN.
    if (isZorgBemiddelaar()) {
      $magVeranderen = true;
    }
    else if ($tabel=="afgeronde") {
      $magVeranderen = false;
    }
    else if (isNuOrganisator()){
      $magVeranderen = true;
    }
    else {
      $magVeranderen = false;
    }
*/

    if ($magVeranderen) {
      $onclick = "  onclick=\"veranderRechten{$rechtenFunctie}'hulp',{$recordsHVL['persoon_id']});\"";
      $titleNiet = " title=\"klik om rechten toe te kennen\"";
      $titleWel = " title=\"klik om rechten af te nemen\"";
    }
    else {
      $onclick = "";
      $titleNiet = " title=\"heeft geen rechten\"";
      $titleWel = " title=\"heeft wel rechten\"";
    }
/*
            if ($overlegInfo['genre']=="TP") {
              $rechtenImg = "";
            }
            else if ($records['rechten']==0) {
              $rechtenImg = "<td><img id=\"mantel{$rechtenArray}Rechten{$records['persoon_id']}\" width=\"24\" src=\"../images/oog_dicht.jpg\" onclick=\"veranderRechten{$rechtenFunctie}'mantel',{$records['persoon_id']});\" alt=\"geen rechten\" title=\"klik om rechten toe te kennen\"/></td>";
            }
            else {
              $rechtenImg = "<td><img id=\"mantel{$rechtenArray}Rechten{$records['persoon_id']}\" width=\"24\" src=\"../images/oog_open.jpg\" onclick=\"veranderRechten{$rechtenFunctie}'mantel',{$records['persoon_id']});\" alt=\"wel rechten\" title=\"klik om rechten af te nemen\"/></td>";
            }


            if ($overlegInfo['genre']!="TP" && ($recordsHVL['validatiestatus']=="" ||  $recordsHVL['validatiestatus']=="geenkeuze")) {
              $validatieTonen = " style=\"font-style: italic;\" ";
            }
            else {
              $validatieTonen = "";
            }

 MANTELZORGERS VOORLOPIG NOG NIET LATEN REGISTREREN */
            print ("

                <tr class=\"$stijl\" id=\"rijMZ{$records['id']}\"><td>

                <table><tr><td><input type=\"checkbox\" name=\"id{$records['id']}\"  $checked

                       onclick=\"{$checkVerandering}veranderAanwezigheid('rijMZ{$records['id']}', {$records['id']})\"></td>

                    <td width=\"210\" $validatieTonen>".$veld1." ".$veld2."</td>

                    <td>".$records['verwantschap_naam']."</td></tr></table>

                    </td>

                    <td><input type=\"radio\" name=\"contactMZ\" $checkedCP

                           onClick=\"{$checkVerandering}return maakContactpersoon('contact_mz',{$records['persoon_id']});\"></td>

                    <td><a href=\"$baseURL&stopID=".$records['id']."\">

                      <img src=\"../images/wis2.gif\" alt=\"Verwijder als betrokkene\"  border=\"0\"></a></td> 
                    <td class=\"rechten\">$rechtenImg</td>
                </tr>");}}

    //----------------------------------------------------------


    // Patient zelf laten zien (ivm rechten)

/********* BEGIN EXTRA CODE VOOR PATIENT

    $query = "

         SELECT
                bl.id,
                bl.rechten,
                validatiestatus
            FROM
                {$tabel}_betrokkenen bl, patient
            WHERE
                $overlegGenreVoorwaarde
                bl.genre = 'patient' and
                patient.code = '{$_SESSION['pat_code']}' and
                $voorwaarde
            ";

      if ($result=mysql_query($query))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);

            $hoogte += 27;

            $JSRechten .= "rechten['$rechtenArray'+'patient0']={$records['rechten']};\n";

            if ($records['rechten']==0) {
              $rechtenImg = "<td><img id=\"patient{$rechtenArray}Rechten0\" width=\"24\" src=\"../images/oog_dicht.jpg\" onclick=\"veranderRechtenHuidig('{$_SESSION['pat_code']}','patient',0);\" alt=\"geen rechten\" title=\"klik om rechten toe te kennen\"/></td>";
            }
            else {
              $rechtenImg = "<td><img id=\"patient{$rechtenArray}Rechten0\" width=\"24\" src=\"../images/oog_open.jpg\" onclick=\"veranderRechtenHuidig('{$_SESSION['pat_code']}','patient',0);\" alt=\"wel rechten\" title=\"klik om rechten af te nemen\"/></td>";
            }
            
            if ($records['validatiestatus']=="" ||  $records['validatiestatus']=="geenkeuze") {
              $validatieTonen = " style=\"font-style: italic;\" ";
            }
            else {
              $validatieTonen = "";
            }

            print ("

                <tr cclass=\"$stijl\" id=\"rijMZ{$records['id']}\"><td>

                <table><tr><td>&nbsp;</td>

                    <td width=\"210\" $validatieTonen>Pati&euml;nt</td>

                    <td>&nbsp;</td></tr></table>

                    </td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    $rechtenImg
                </tr>");}}
********* EINDE EXTRA CODE VOOR PATIENT */

    //----------------------------------------------------------




    ?>



    <?php



    //----------------------------------------------------------

    

    print ("</table></p>");
    print("\n<script type=\"text/javascript\">\n$JSRechten\n</script>\n");

?>

<div id="vergoedbaarheidsDiv" style="display:none; background-color: #4F4">

<p>Dit overleg is vergoedbaar!

 <input type="button" value="Start de procedure" onclick="kiesVergoeding(true)"/>

 <input type="button" value="Weiger de procedure" onclick="kiesVergoeding(false)"/></p>

</div>

<div id="stopvergoedingDiv" style="display:none; background-color: #4F4">

<p>De procedure voor vergoeding loopt.

 <input type="button" value="Annuleer deze keuze" onclick="kiesVergoeding(false)"/></p>

</div>

<div id="tochstartvergoedingDiv" style="display:none; background-color: #F44">

<p>Dit overleg is vergoedbaar, maar de procedure is niet opgestart.

 <input type="button" value="Start toch op!" onclick="kiesVergoeding(true)"/></p>

</div>

