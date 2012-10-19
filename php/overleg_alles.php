<?php

session_start();

$paginanaam="Werken aan het teamoverleg";


/* structuur van deze centrale pagina uit het Listel-project

  1. de pagina kan url-variabelen hebben

     a. tab geeft aan welke tab geopend moet worden.

     b. afronden geeft aan of het om afronden gaat

        -- geen tab en geen afronden == nieuw overleg

        -- wel tab, geen afronden == bewerken

        -- wel tab, afronden=1 == afronden

        -- geen tab, wel afronden = mag niet!

  2. wanneer er geen tab is gedefinieerd, gaat het om een nieuw overleg

     en gebeuren volgende acties

     a. om te beginnen maken we de variabele overlegID leeg.

     b. dan kijken we of er nog een actief overleg is,

        zo ja, geven we een melding + de kans om dat actieve overleg af te ronden

     c. is er nog geen actief overleg, dan wordt de tab "basisgegevens" geopend

        en worden de andere tabs gedesactiveerd (italic)

        Dit gebeurt helemaal onderaan deze pagina omdat pas dan de tabs ingeladen zijn.

     d. in de tab "basisgegevens" kan de gebruiker nu de gegevens van een nieuw overleg ingeven;

        Bij het posten van het formulier, gaan we voor tab de waarde "NieuwOverleg" meegeven

        via de action van het formulier (met een reload van deze pagina).

  3. Wanneer de tab de waarde "NieuwOverleg" heeft, maken we een nieuw overleg aan,

    en zetten we de variabele overlegID op.

    Daarna veranderen we de waarde van tab in "Teamoverleg", zodat die tab getoond wordt.

  4. a. Is tab gelijk aan extraGegevens, dan moeten we extra "basisgegevens" ivm vergoeding ingeven.

        Wanneer die gegevens opgeslagen zijn, gaan we naar de tab "Basisgegevens2"

     b. bij "Basisgegevens2" tonen we de basisgegevens én activeren ook de andere tabs

        Dat is dus verschillend tov de gewone "Basisgegevens" waar alleen "Basisgegevens" werkt

  5. Is het een andere tab, dan kijken we naar de waarde van $overlegID.

     a. bestaat die dan tonen we de tab voor dat overleg.

     b. Bestaat die niet, dan tonen we een foutmelding dat er geen actief overleg is.

  6. Bijkomend: wanneer tab een waarde heeft, wordt in "Basisgegevens" alleen getoond,

     anders is het aanpasbaar.

  7. Bij therapeutisch project is het anders. Belangrijk verschil is het extra tabje "plan".

*/







function eindePagina() {

	print("</div>");

	print("</div>");

	print("</div>");

	require("../includes/footer.inc");

	print("</div>");

	print("</div>");

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

    //---------------------------------------------------------

	print("</body>");

	print("</html>");



     //---------------------------------------------------------

     /* Geen Toegang */ require("../includes/check_access.inc");

     //---------------------------------------------------------

}





if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {

//---------------------------------------------------------------

/* Open Empty Html */ require('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    U bent niet geautoriseerd tot deze pagina.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ require('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



exit;

}





if (isset($_POST['pat_code'])) {
  $_SESSION['pat_code'] = $_POST['pat_code'];
}
else if (isset($_GET['patient'])) {
  $_SESSION['pat_code'] = $_GET['patient'];
}


if (!isset($_SESSION['pat_code'])) {

//---------------------------------------------------------------

/* Open Empty Html */ require('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    Deze pagina is enkel toegankelijk wanneer u een patient geselecteerd hebt.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ require('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



exit;

}



// we hebben toegang tot de pagina én er is een patient geselecteerd





//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------
if (!heeftPatientRechten($_SESSION['pat_code'])) die("je hebt geen rechten voor deze patient");

  $qryPat = "select actief, type, rijksregister from patient where code =\"{$_SESSION['pat_code']}\"";
  $patResult = mysql_query($qryPat);
  if (mysql_num_rows($patResult) == 1) {
    $patient = mysql_fetch_assoc($patResult);
    if ($patient['type']==16 || $patient['type']==18) {
      $patientPsy = getFirstRecord("select * from patient_psy where code = \"{$_SESSION['pat_code']}\" order by id desc");
      $extraHoog = " style=\"height:1400px;\" ";
    }
  }
  else {
    die("er is meer dan 1 patient met deze code (of geen)!");
  }


	require("../includes/html_html.inc");

	print("<head>");

	require("../includes/html_head.inc");

    //-----------------------------------------------------------------------------

    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");

    //-----------------------------------------------------------------------------

    // --------------------------------------------------------



  print("<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/domtab4.css\" />\n");
?>
<script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<?php
  print("</head>");


	print("<body>");

	print("<div align=\"center\">");

	print("<div class=\"pagina\">");

	require("../includes/header.inc");

	require("../includes/pat_id.inc");

	print("<div class=\"contents\" $extraHoog >");

	require("../includes/menu.inc");

	print("<div class=\"main\" id=\"main\"  $extraHoog >");

	print("<div class=\"mainblock\"  $extraHoog >");

  if ($_SESSION['profiel']=="menos") {
    $overlegGenre = "menos";
    $menosParam = "menosPeople=1";
    $extraParameterSelectPersonen = "?menos=1";
    $extraParameterSelectPersonen2 = "&menos=1";
    $overlegVoorwaarde = " and overleg.genre = 'menos' ";
  }
  else {
    if ($patient['type']==16 || $patient['type']==18) {
      $overlegGenre = "psy";
    }
    else {
      $overlegGenre = "gewoon";
    }
    $overlegVoorwaarde = " AND (overleg.genre is NULL or overleg.genre in ('gewoon','psy','TP')) ";
  }



if ($_GET['tab']== "NieuwOverleg") {

  if (mysql_num_rows(mysql_query(

                      "SELECT * FROM overleg

                      WHERE patient_code = '{$_SESSION['pat_code']}' AND afgerond=0
                      $overlegVoorwaarde
                      ")

                    ) == 0) {

    // wanneer er een refresh gebeurt, zou er een overleg gemaakt kunnen worden

    // terwijl er nog een actief overleg is.

    // Daarom deze extra test.

    // We geven geen foutmelding, omdat de refresh gewoon hetzelfde overleg maakt.

    // en dat doen we gewoon niet. We springen direct naar het teamoverleg.

    require("../includes/overleg_maken.php");

  }

  $_GET['tab'] = "Teamoverleg";

}





    //----------------------------------------------------------

    /* Haal patient- en overleggegevens op */

       require('../includes/patientoverleg_geg.php');

    // zet: session: pat_naam, pat_id, pat_code

    // zet: lokaal: overlegID, overlegStatus, zorgplanStatus, eersteOverleg, teamStatus

    // zet: lokaal: overlegInfo: array met alles van overleg in DB

    // overlegStatus: - info over zorgplan opstarten + vergoedbaar indien ...

    //                - aantal resterende vergoedbare overleggen, indien ...

    //                - of vervolgoverleg zonder voorwaarden, zonder vergoeding

    //    dus alleen relevant bij nieuw overleg

    //----------------------------------------------------------

  if ($overlegGenre == "psy" && ($overlegInfo['genre']=="gewoon" || $overlegInfo['genre']=="")) {
    $overlegGenre = "gewoon";
  }

  // waarschuwing voor 18+ die nog in 16- zit
  if ($overlegID <= 0 && $patient['type']==16) {
    print("<script type=\"text/javascript\">if (leeftijd(\"{$patient['rijksregister']}\")>=18) alert(\"Deze patient is al 18, maar zit nog in het circuit jongeren. Overgang naar het circuit volwassenen kan eventueel via 'Gegevens aanpassen'.\");</script>");
  }


?>



<script language="javascript" type="text/javascript">



<?php
  if ($overlegInfo['keuze_vergoeding']!=0)
   $keuzeVergoeding = $overlegInfo['keuze_vergoeding'];
  else
   $keuzeVergoeding = 0;

  if ($overlegInfo['id']>0) {
     $potentieleVergoeding  = potentieleVergoeding($overlegInfo['id']);
  }
  else {
     $potentieleVergoeding  = 1;
  }


  print("var keuzeVergoeding = $keuzeVergoeding ; var potentieleVergoeding = $potentieleVergoeding;");

  $aantalHVL = mysql_num_rows(mysql_query(

        "select * from huidige_betrokkenen

         where patient_code = '{$_SESSION['pat_code']}'
               and overleggenre = 'gewoon'
               and (genre = 'hulp' or genre = 'orgpersoon');"));

  if (($aantalHVL == 0) || ($overlegInfo['contact_hvl'] != 0)) {

    print("var contactHVL = true;");

    $vw1 = true;

  }

  else {

    print("var contactHVL = false;");

    $vw1 = false;

  }



  $aantalMZ = mysql_num_rows(mysql_query(

        "select * from huidige_betrokkenen

         where patient_code = '{$_SESSION['pat_code']}'
               and overleggenre = 'gewoon'
               and genre = 'mantel';"));

  if (($aantalMZ == 0) || ($overlegInfo['contact_mz'] != 0)  || $overlegInfo['genre']=="psy") {

    print("var contactMZ = true;");

    $vw2 = true;

  }

  else {

    print("var contactMZ = false;");

    $vw2 = false;

  }

  if ($overlegInfo['genre']=="psy") {
    print("var soortContact = \"referentiepersoon\";");
  }
  else {
    print("var soortContact = \"zorgbemiddelaar\";");
  }




  if ($vw1 && $vw2) {

    $displayContact = "none";

  }

  else {

    $displayContact = "block";

  }

?>



function testAlles() {
<?php
  if ($patientInfo['toestemming_zh']==0) {
?>

    //alert("Het overleg kan niet afgerond worden want de patient moet nog toestemming geven aan het ziekenhuis om zijn gegevens en de gegevens van de zorgbemiddelaar op te vragen bij opname door middel van zijn rijksregisternummer. \nGelieve aan te vinken bij 'patientenfiches – gegevens aanpassen' of de patient al dan niet toestemming geeft.");
    // of confirm van maken?
    //Sinds okt. 2011 kunnen ziekenhuizen een zorgplan opvragen, maar voor deze patient is er nog niet aangeduid of hij/zij al dan niet toestemming geeft.\nGelieve dit aan te duiden bij \"Patientenfiches -> Gegevens aanpassen.\".");
    var gaNaar = confirm("Het overleg kan niet afgerond worden want de patient moet nog toestemming geven aan het ziekenhuis om zijn identificatiegegevens en de gegevens van de zorgbemiddelaar op te vragen bij opname door middel van zijn rijksregisternummer. \nGelieve aan te vinken bij 'patientenfiches - gegevens aanpassen' of de patient al dan niet toestemming geeft.\nLet op: de patient geeft toestemming door de voorpagina zorgplan te ondertekenen.\n\nKlik op OK om direct naar de gegevens van de patient te gaan, en op Annuleren om terug naar het overleg te gaan.");
    if (gaNaar) {
      window.location = "patient_aanpassen.php?patient=<?= $patientInfo['code'] ?>";
    }
    return false;

<?php
  }
?>

<?php
  if ($patientInfo['zorgtraject_datum']=="0000-00-00") {
?>
    // eerst aanduiden of de patient in een zorgtraject opgenomen is
    var gaNaar = confirm("Het overleg kan niet afgerond worden. Je moet eerst aanduiden of de patient in een zorgtraject diabetes of chronische nierinsufficiente opgenomen is.\nGelieve dit onderaan aan te vinken bij 'patientenfiches - gegevens aanpassen'.\nKlik op OK om direct naar de gegevens van de patient te gaan, en op Annuleren om terug naar het overleg te gaan.");
    if (gaNaar) {
      window.location = "patient_aanpassen.php?patient=<?= $patientInfo['code'] ?>&verspring=zorgtraject";
    }
    return false;

<?php
  }
?>

  document.f.verificatie.value = "-1";

<?php

  if ($overlegInfo['datum'] > date("Ymd")) {

     $dag = substr($overlegInfo['datum'],6,2);

     $maand = substr($overlegInfo['datum'],4,2);

     $jaar = substr($overlegInfo['datum'],0,4);

     print("  alert('Het overleg van $dag/$maand/$jaar nog niet voorbij.\\nJe kan het dus niet afronden!');return false;");

  }

  print("  var ok = false;");

  if (is_tp_patient())
    print("  ok = testAllesTP();\n");
  else if ($overlegInfo['genre']=="menos")
    print("  ok = testMenos();\n");
  else if ($overlegInfo['genre']=="psy")
    print("  ok = testAllesPsy();\n");
  else
    print("  ok = testAllesGewoon();\n");

?>

  if (ok)  {

     document.f.verificatie.value = "1";

     //alert("geverifieerd");

  }

  return ok;

}



function testAllesTP() {

<?php

  if ((substr($patientInfo['gebdatum'],0,4)<=(date("Y")-55)) && ($overlegInfo['omb_id'] < 1)) {

?>

   if (ombintevullen) {

     alert("Het formulier voor ouderenmis(be)handeling is nog niet volledig ingevuld.\nDoe dit (via het tabblad Attesten).");

     return false;

   }

<?php

  }



  if ($overlegInfo['genre']=="TP" && strpos($overlegStatus,"inclusievergadering") ) {

?>

    if (document.f.vergoedingTPweigeren.value=='nietIncluderen') {

       return confirm("Ben je zeker dat deze patient geweigerd wordt voor inclusie?");

       // als de patient geweigerd wordt, moet je al deze voorwaarden niet testen!

    }

<?php

  }



  if ($patientInfo['toestemming']==0) {

    print('alert("De patient heeft nog geen toestemming verleend voor opname in het therapeutisch project.\\nZolang je dit niet aanvinkt op de pagina waar we je nu naartoe leiden, kan je niet afronden.\\n\\nWe leiden je nu naar deze pagina.");');

    print("window.location = \"patient_tp_vragen.php?code={$_SESSION['pat_code']}\";return false;");

  }


  if ($patientInfo['hoofddiagnose']=="" && is_tp_patient()) {

      echo <<< EINDE

      alert("U hebt voor deze patient nog geen hoofddiagnose ingevuld.\\nPas nadat die ingevuld is, kan je een overleg plannen.\\n\\nWij leiden je nu naar de pagina waar je dit kan invullen.");

      window.location = "patient_tp_vragen.php?code={$_SESSION['pat_code']}";

EINDE;

     $hoofdDiagnoseTest = "alert('U hebt voor deze patient nog geen hoofddiagnose ingevuld.\\nPas nadat die ingevuld is, kan je verder met het overleg plannen.'); return false;";

  }

?>



    if (document.getElementById('verslag').value=="") {

      alert("Het verslag is nog niet ingevuld.\nVul het eerst in op de tab 'Attesten en bijlagen' vooraleer af te ronden.");

      return false;

    }



<?php

  if ($_SESSION['profiel']=="OC") {

?>

    if (!planIngevuld) {

      alert("De projectcoordinator heeft het plan van tenlasteneming nog niet ingevuld.\n" +

            "Vraag hem/haar om dit te doen en rond dan af.");

      return false;

    }

<?php

  }

  else {

?>

    if (!planIngevuld) {

      alert("Het plan van tenlasteneming nog niet ingevuld.\n" +

            "Vul het in en rond (opnieuw) af.");

      return false;

    }

<?php

  }

?>



    if (huisartsAanwezig() && katzLeeg) {

      alert("Er is een huisarts aanwezig maar de katz-score is nog niet ingevuld.\nVul die eerst in vooraleer af te ronden.");

      return false;

    }



    if (geenRijksRegister) {

      alert("Het rijksregisternummer  is nog niet gekend,\n" +

            "en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.");

      return false;

    }

    if (geenMutualiteit) {

      alert("Het inschrijvingsnummer bij de verzekeringsinstelling (mutualiteit) is nog niet gekend,\n" +

            "en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.");

      return false;

    }



<?php

   $qryOrgs = "select organisatie.naam from organisatie left join organisatie org2 on organisatie.hoofdzetel = org2.id, huidige_betrokkenen

               where huidige_betrokkenen.genre = 'org' and patient_code = \"{$_SESSION['pat_code']}\"
                     and overleggenre = 'gewoon'
                     and organisatie.id = huidige_betrokkenen.persoon_id

                     and ((organisatie.iban is NULL or organisatie.iban = '') and (org2.iban is NULL or org2.iban = ''))";

   $resultOrgs = mysql_query($qryOrgs);

   $aantalStouteOrgs = mysql_num_rows($resultOrgs);

   if ($aantalStouteOrgs > 0) {

     $fouten = "";

     for ($i=0; $i<$aantalStouteOrgs; $i++) {

       $organisatie = mysql_fetch_assoc($resultOrgs);

       $fouten .= ", {$organisatie['naam']}";

     }

     $fouten = substr($fouten, 2);

     echo <<< EINDE

       alert("De rekeningnummers van de interne partners:\\n   $fouten zijn niet gekend.\\nDaarom kan nog niet afgerond worden.\\n\\nVraag aan Listel om deze rekeningnummers in te vullen.");

       return false;

EINDE;

   }

?>

  var recentgenoegvoorombvergoeding = ((document.doeoverlegform.overleg_jj.value > 2008) || (document.doeoverlegform.overleg_jj.value == 2007 && document.doeoverlegform.overleg_mm.value > 10));



  if ((ombintevullen && recentgenoegvoorombvergoeding) || (vergoedbaar && (keuzeVergoeding == -88 || keuzeVergoeding == 1))) {

    // als het vergoedbaar is, én er is nog geen keuze gemaakt, of men wil een vergoeding
    // dan moeten alle rekeningnummers ingevuld zijn.
    // Deze test doen we NIET wanneer er enkel voor de organisator een vergoeding wordt gevraagd.

    if (fouteRekeningnummers != "") {

      alert(fouteRekeningnummers);

      return false;

    }

  }



  if (!contactMZ && !contactHVL) {

     alert("Je hebt nog geen zorgbemiddelaar noch een contactpersoon geselecteerd.\nDit is verplicht!");

     return false;

  }

  else if (!contactMZ) {

     alert("Je hebt nog geen contactpersoon voor de mantelzorgers geselecteerd.\nDit is verplicht!");

     return false;

  }

  else if (!contactHVL) {

     alert("Je hebt nog geen zorgbemiddelaar geselecteerd.\nDit is verplicht!");

     return false;

  }



  if (!inclusieMail) {

    alert("Gelieve Listel eerst te verwittigen van de inclusie\nvia de knop net boven de 'afronden'-knop.\nDaarna kan je veilig afronden.");

    return false;

  }

  
/*
  if (subsidiestatusWordtBerekend) {

    alert("Gelieve nog even te wachten met afronden tot er op het tab-blad 'Basisgegevens' een nieuwe Vlaamse subsidiestatus staat");

    return false;

  }
*/
<?php
  if ($overlegInfo['datum'] < 20100000) {
?>

  if (subsidieStatus == "verdedigbaar") {

    alert("Dit zorgplan kan waarschijnlijk goedgekeurd worden door de inspectie,\nmaar u hebt nog niet beslist of u dit wil voorleggen of niet.\nMaak een keuze in het tab-blad 'Basisgegevens' en rond dan af.");

    return false;

  }

  if (subsidieStatus == "") {

    alert("De subsidiestatus van dit zorgplan is nog niet berekend. Neem contact op met Listel om dit in orde te brengen.");

    return false;

  }

<?php
 }
?>


  // ofwel geen vergoeding gekozen, ofwel alles in orde

  var ok = confirm("Wil u dit overleg definitief afsluiten?\nNa deze stap zijn geen wijzigingen meer mogelijk!");

  if (ok) {

    var invoer = prompt("Hebt u de aanwezigheidslijst aangepast aan de werkelijke toestand op het overleg? Dit is cruciaal voor een juiste facturatie!","Typ 'ja' om dit te bevestigen en af te ronden.");

    if (invoer == "ja" || invoer == "JA" || invoer == "Ja") {

      ok = true;

      alert("Vergeet niet om het gehandtekende verslag binnen de 5 dagen naar Listel te sturen!");

    }

    else {

      ok = false;

    }

  }



  return ok;

}

function testMenos() {
  return confirm("Wil u dit overleg definitief afsluiten?\nNa deze stap zijn geen wijzigingen meer mogelijk!");
}

function testAllesGewoon() {
<?php
  if (isset($overlegInfo['id'])) {
    $qryTaakfichesGevonden = "select id         from taakfiche     where substr(ref_id,1,7) = 'overleg' and substr(ref_id,8) = {$overlegInfo['id']}";
    $resultTaakfichesGevonden = mysql_query($qryTaakfichesGevonden) or die($qryTaakfichesGevonden . " is fout.");
    if (mysql_num_rows($resultTaakfichesGevonden) == 0) {
?>
   if (aantalBijlagen == 0) {
       alert("Je moet ofwel een bijlage toevoegen, of taakfiche(s) invullen. \nEen schematische omschrijving van de geplande zorg, besproken op het overleg, is verplicht op te nemen in het elektronisch zorgplan als onderdeel van de minimale inhoud van een geldig zorgplan.");
       return false;
   }
<?php
    }
  }
  if ((substr($patientInfo['gebdatum'],0,4)<=(date("Y")-55)) && ($overlegInfo['omb_id'] < 1)) {
    if ($overlegGenre =="psy") {
      $tabBladOmb = "Attesten";
    }
    else {
      $tabBladOmb = "Crisisplan";
    }

?>

   if (ombintevullen) {

     alert("Het formulier voor ouderenmis(be)handeling is nog niet volledig ingevuld.\nDoe dit (via het tabblad <?= $tabBladOmb ?>).");

     return false;

   }

<?php

  }

?>


<?php
  if ($overlegInfo['datum'] < 20100000) {
?>

   // bij een te lage katz-score een waarschuwing over het zorgplan

   if (!katzLeeg && katzTeLaag && nogNietGoedgekeurd) {

//     alert("Pas op! De katz-score is in principe te laag voor subsidieerbaarheid van het zorgplan.\n" +

//            "Zet dit zorgplan stop of wacht de goedkeuring van de inspectiediensten af.");

   }

  if (keuzeVergoeding==-88 && vergoedbaar) {

    alert("Dit overleg kan vergoed worden, maar u hebt nog geen keuze gemaakt\n" +

          "om de procedure voor vergoeding al dan niet op te starten.\n\n" +

          "Doe dit nu, onderaan de teamsamenstelling.");

    return false;

  }

<?php
  }
?>

  if (katzLeeg) {

    alert("De katz-score is niet ingevuld.\nVul die eerst in vooraleer af te ronden.");

    return false;

  }



  var recentgenoegvoorombvergoeding = ((document.doeoverlegform.overleg_jj.value > 2008) || (document.doeoverlegform.overleg_jj.value == 2007 && document.doeoverlegform.overleg_mm.value > 10));



  if ((ombintevullen && recentgenoegvoorombvergoeding) || (vergoedbaar && (keuzeVergoeding == -88 || keuzeVergoeding == 1))) {

    // als het vergoedbaar is, én er is nog geen keuze gemaakt, of men wil een vergoeding
    // dan moeten alle rekeningnummers ingevuld zijn.
    // Deze test doen we NIET wanneer er enkel voor de organisator een vergoeding wordt gevraagd.


    if (fouteRekeningnummers != "") {

      alert(fouteRekeningnummers);

      return false;

    }

  }





  if (keuzeVergoeding>0) {

    if (!vergoedbaar) {

      alert("De teamsamenstelling is niet in orde voor vergoeding.\n" +

            "Zet dit recht of verander de keuze voor vergoeding onderaan bij het tabje 'Basisgegevens'");

      return false;

    }

    if (ontbrekendeBasisGegevens) {

      alert("Er ontbreken nog basisgegevens over dit overleg.\nVul die nu in!");

      window.location = "overleg_alles.php?tab=Basisgegevens2";

      return false;

    }



    if (geenRijksRegister) {

      alert("Het rijksregisternummer  is nog niet gekend,\n" +

            "en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.");

      return false;

    }



    if (geenMutualiteit) {

      alert("Het inschrijvingsnummer bij de verzekeringsinstelling (mutualiteit) is nog niet gekend,\n" +

            "en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.");

      return false;

    }



/*

    if (katzTeLaag && nogNietGoedgekeurd) {

      alert("Pas op! De katz-score is in principe te laag.\n" +

            "Ofwel moet je de keuze voor vergoeding veranderen bij het tabje 'Basisgegevens',\n" +

            "ofwel moet je de goedkeuring van de inspectiediensten afwachten.");

    }

*/

    if (huisartsAanwezig() && !verklaringHuisArtsOK) {
      alert("Je hebt de verklaring van de huisarts nog niet ingevuld op het tabblad 'Attesten en bijlagen'.\n Vul dit eerst in vooraleer af te ronden.");
      return false;
    }

    if (evalInstrLeeg) {

      alert("Het evaluatie-instrument is niet ingevuld.\n Vul dit eerst in vooraleer af te ronden.");

      return false;

    }

  }

  

  if (!contactMZ && !contactHVL) {

     alert("Je hebt nog geen zorgbemiddelaar en contactpersoon geselecteerd.\nDit is verplicht!");

     return false;

  }

  else if (!contactMZ) {

     alert("Je hebt nog geen contactpersoon voor de mantelzorgers geselecteerd.\nDit is verplicht!");

     return false;

  }

  else if (!contactHVL) {

     alert("Je hebt nog geen zorgbemiddelaar geselecteerd.\nDit is verplicht!");

     return false;

  }


/*
  if (subsidiestatusWordtBerekend) {

    alert("Gelieve nog even te wachten met afronden tot er op het tab-blad 'Basisgegevens' een nieuwe Vlaamse subsidiestatus staat");

    return false;

  }
*/

<?php
  if ($overlegInfo['datum'] < 20100000) {
?>

  if (subsidieStatus == "verdedigbaar") {

    alert("Dit zorgplan kan waarschijnlijk goedgekeurd worden door de inspectie,\nmaar u hebt nog niet beslist of u dit wil voorleggen of niet.\nMaak een keuze in het tab-blad 'Basisgegevens' en rond dan af.");

    return false;

  }

  if (subsidieStatus == "") {

    alert("De subsidiestatus van dit zorgplan is nog niet berekend. Neem contact op met Listel om dit in orde te brengen.");

    return false;

  }

<?php
  }
?>

  // ofwel geen vergoeding gekozen, ofwel alles in orde

  var ok = confirm("Wil u dit overleg definitief afsluiten?\nNa deze stap zijn geen wijzigingen meer mogelijk!");

  if (ok) {

    var invoer = prompt("Hebt u de aanwezigheidslijst aangepast aan de werkelijke toestand op het overleg? Dit is cruciaal voor een juiste facturatie!","Typ 'ja' om dit te bevestigen en af te ronden.");

    if (invoer == "ja" || invoer == "JA" || invoer == "Ja") {

      ok = true;

    }

    else {

      ok = false;

    }

  }
  
  if (ok) {
    ok = confirm("Heb je de nodige OOGJES opengezet van externe gebruikers zowel in je TEAMSAMENSTELLING als op BIJLAGE niveau?\nEn heb je login weigering aangeduid bij de personen die er geen wensen?");
  }

  return ok;

}

function testAllesPsy() {
  var foutenPsy = "";
  var waarschuwingPsy = 0;
<?php
   if ($patientPsy['hoofddiagnose'] == "000.00") {
?>
    waarschuwingPsy = 1;
<?php
   }
?>

 if (!(keuzeVergoeding == -1 || keuzeVergoeding == 0  || keuzeVergoeding == -88)) {
  // alleen als er een vergoeding gevraagd is, moeten we controleren

<?php
   if (bijkomendBevat000($_SESSION['pat_code'])) {
?>
    waarschuwingPsy += 10;
<?php
   }
?>
  if (waarschuwingPsy != 0) {
    var waarschuwingBron = "";
    if (waarschuwingPsy == 1) {
      waarschuwingBron = "De hoofddiagnose is ";
    }
    else if (waarschuwingPsy == 10) {
      waarschuwingBron = "Een van de bijkomende diagnoses is ";
    }
    else  {
      waarschuwingBron = "Zowel de hoofddiagnose als een van de bijkomende diagnoses zijn ";
    }

    alert("Let op. " + waarschuwingBron + "nog steeds 000.00." +
          "\nIndien de arts de DSM IV of ICD-10 codes heeft ingevuld op zijn/haar verklaring, \ngelieve dan deze over te nemen in de patientgegevens (via opslaan naar opstartvragen) eer je het overleg afrondt.");
  }

  if (!ggzHeeftTaak && !genoegDomeinen) {
    foutenPsy += ("  - Bij minstens 3 domeinen in het begeleidingsplan moeten ZVL/HVL betrokken zijn. \n  - Bovendien moet minstens een GGZ-medewerker een taak hebben.!\n");
  }
  else if (!genoegDomeinen) {
    foutenPsy += ("  - Bij minstens 3 domeinen in het begeleidingsplan  moeten ZVL/HVL betrokken zijn.\n");
  }
  else if (!ggzHeeftTaak) {
    foutenPsy += ("  - Geen enkele GGZ-medewerker heeft een taak in het begeleidingsplan !\n");
  }

  if (!tekstvakkenBegeleidingsplan) {
    foutenPsy += ("  - Je moet de bovenste tekstvakken van het begeleidingsplan nog invullen.\n");
  }
  if (nietAllesIngevuldOpBegeleidingsplan) {
    foutenPsy += ("  - Je hebt niet alle afspraken volledig ingevuld in het begeleidingsplan. Er ontbreken afspraken, einddata of actienemers.\n");
  }
  if (!crisisSituatieIngevuld) {
    foutenPsy += ("  - Je moet bij het crisisplan nog invullen wat er moet gebeuren in het geval van een crisissituatie.\n");
  }
  if (!alleBereikbaarheden) {
    foutenPsy += ("  - Je moet bij het crisisplan van elke betrokkene de bereikbaarheid invullen.\n");
  }

<?php
  if ((substr($patientInfo['gebdatum'],0,4)<=(date("Y")-55)) && ($overlegInfo['omb_id'] < 1)) {
?>
   if (ombintevullen) {
     foutenPsy += ("  - Het formulier voor ouderenmis(be)handeling is nog niet volledig ingevuld.\n    Doe dit (via het tabblad Crisisplan).\n");
   }
<?php
  }
?>


  var recentgenoegvoorombvergoeding = ((document.doeoverlegform.overleg_jj.value > 2008) || (document.doeoverlegform.overleg_jj.value == 2007 && document.doeoverlegform.overleg_mm.value > 10));
  if ((ombintevullen && recentgenoegvoorombvergoeding) || (vergoedbaar && (keuzeVergoeding == -88 || keuzeVergoeding == 1))) {
    // als het vergoedbaar is, én er is nog geen keuze gemaakt, of men wil een vergoeding
    // dan moeten alle rekeningnummers ingevuld zijn.
    // Deze test doen we NIET wanneer er enkel voor de organisator een vergoeding wordt gevraagd.
    if (fouteRekeningnummers != "") {
      foutenPsy += "  - " + (fouteRekeningnummers);
    }
  }

  if (keuzeVergoeding>0) {
    if (!vergoedbaar) {
      foutenPsy += ("  - De teamsamenstelling is niet in orde voor vergoeding.\n" +
            "    Zet dit recht of verander de keuze voor vergoeding onderaan bij het tabje 'Basisgegevens'\n");
    }
    if (ontbrekendeBasisGegevens) {
      alert("Er ontbreken nog basisgegevens over dit overleg.\nVul die nu in!");
      window.location = "overleg_alles.php?tab=Basisgegevens2";
      return false;
    }

    if (geenRijksRegister) {
      foutenPsy += ("  - Het rijksregisternummer  is nog niet gekend,\n" +
            "    en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.\n");
    }

    if (geenMutualiteit) {
      foutenPsy += ("  - Het inschrijvingsnummer bij de verzekeringsinstelling (mutualiteit) is nog niet gekend,\n" +
            "    en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.\n");
    }
    if (!crisisPlanVolledig) {
       foutenPsy += ("  - Er ontbreken nog emailadressen of telefoonnummers voor op het crisisplan.\n   De regelgeving verplicht dit.\n");
    }
  }


 if (!contactHVL) {
     foutenPsy += ("  - Je hebt nog geen referentiepersoon geselecteerd.\n");
  }

  if (!checkJaarGeleden()) {
    return false;
  }

 }

  if (foutenPsy != "") {
    alert("We kunnen nog niet afronden, want\n" + foutenPsy);
    return false;
  }

  // ofwel geen vergoeding gekozen, ofwel alles in orde
  var ok = confirm("Wil u dit overleg definitief afsluiten?\nNa deze stap zijn geen wijzigingen meer mogelijk!");
  if (ok) {
    var invoer = prompt("Hebt u de aanwezigheidslijst aangepast aan de werkelijke toestand op het overleg? Dit is cruciaal voor een juiste facturatie!","Typ 'ja' om dit te bevestigen en af te ronden.");
    if (invoer == "ja" || invoer == "JA" || invoer == "Ja") {
      ok = true;
    }
    else {
      ok = false;
    }
  }
  if (ok) {
    ok = confirm("Heb je de nodige OOGJES opengezet van externe gebruikers zowel in je TEAMSAMENSTELLING als op BIJLAGE niveau?\nEn heb je login weigering aangeduid bij de personen die er geen wensen?");
  }
  if (ok) {
    ok = confirm("Heb je nagekeken of de domeinen aangepast moeten worden?");
  }

  return ok;

}


function updateStatus(status) {

  // aangepaste versie zit ook in controle.php

  var hoogte = document.getElementById('Teamoverleg').style.height;

  hoogte = parseInt(hoogte.substr(0, hoogte.length-2)) + 400;

<?php
  if (!isset($extraHoog)) {
?>
  if (hoogte < 800) hoogte = 800;
<?php
  }
?>
  document.getElementById('main').style.height = hoogte + "px";

  vergoedbaar = (status.indexOf("OK") >= 0);

  var statusText = status.substr(3);

  var statusVenster = document.getElementById('status');

  statusVenster.innerHTML = statusText;

  if (vergoedbaar) {

     statusVenster.style.backgroundColor = "#B4FFB4";
<?php

  if (!is_tp_patient()) {

?>

     switch (keuzeVergoeding) {

        case -1:  // vergoeding geweigerd

           document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

           document.getElementById('tochstartvergoedingDiv').style.display = 'block';

           document.getElementById('stopvergoedingDiv').style.display = 'none';

           document.getElementById('geenKeuzeVergoeding').style.display = 'none';

        break;

        case -88: // nog geen keuze gemaakt

           document.getElementById('vergoedbaarheidsDiv').style.display = 'block';

           document.getElementById('tochstartvergoedingDiv').style.display = 'none';

           document.getElementById('stopvergoedingDiv').style.display = 'none';

           document.getElementById('geenKeuzeVergoeding').style.display = 'block';

           break;

        case 0:  //  geen recht op vergoeding
           document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

           document.getElementById('tochstartvergoedingDiv').style.display = 'block';

           document.getElementById('stopvergoedingDiv').style.display = 'none';

           document.getElementById('geenKeuzeVergoeding').style.display = 'none';

           break;

        case 1:  // gekozen voor vergoeding
        case 2:  // gekozen voor vergoeding

           document.getElementById('vergoeding1').style.display = 'block';

           document.getElementById('vergoeding2').style.display = 'block';

           document.getElementById('probleemVergoeding').style.display = 'none';

           

           document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

           document.getElementById('tochstartvergoedingDiv').style.display = 'none';

           document.getElementById('stopvergoedingDiv').style.display = 'block';

           document.getElementById('geenKeuzeVergoeding').style.display = 'none';



     }

<?php

  }

?>

  }

  else {

     statusVenster.style.backgroundColor = "#FFB4B4";

<?php

  if (!is_tp_patient()) {

?>

     document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

     document.getElementById('geenKeuzeVergoeding').style.display = 'none';

     switch (keuzeVergoeding) {

        case -1:

        case 0:

        case -88:

           document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

           document.getElementById('tochstartvergoedingDiv').style.display = 'none';

           document.getElementById('stopvergoedingDiv').style.display = 'none';

           break;

        case 1:
        case 2:

          document.getElementById('vergoeding1').style.display = 'none';

          document.getElementById('vergoeding2').style.display = 'none';

          document.getElementById('probleemVergoeding').style.display = 'block';



           document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

           document.getElementById('tochstartvergoedingDiv').style.display = 'none';

           document.getElementById('stopvergoedingDiv').style.display = 'block';

     }

<?php

  }

?>

  }

}







function kiesVergoeding(keuze) {

/*

 // vroeger heette de parameter eersteKeer, en dat hing daar van af

 // welke confirm getoond wordt.

 // nu heet parameter "keuze" en slaan we de confirm over

 if (eersteKeer)

     keuze = confirm("Dit overleg is vergoedbaar.\n" +

                      "Wil u de procedure voor vergoeding opstarten?\n\n" +

                      "OK = ja\nCancel of Annuleren = nee.");

  else

     keuze = confirm("Kies hier al dan niet voor een vergoeding.\n" +

                      "Wil u de procedure voor vergoeding opstarten?\n\n" +

                      "OK = ja\nCancel of Annuleren = nee.");

*/

  if (keuze) {

    keuzeVergoeding = potentieleVergoeding;

  }

  else {

    keuzeVergoeding = -1;

  }





  // en dan een Ajax-request

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "overleg_keuze_vergoeding_invullen_ajax.php?id=" + <?= $overlegID ?> +

            "&keuze=" + keuzeVergoeding + "&rand" + rand1 + "=" + rand2;



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

/*  vroeger in de tab "basisgegevens"

        document.doeoverlegform.vergoeding[keuzeVergoeding].checked = true;

        document.getElementById('IIKeuzeVergoeding').style.display = 'block';

*/

        if (keuze) {

          document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

          document.getElementById('tochstartvergoedingDiv').style.display = 'none';

          document.getElementById('stopvergoedingDiv').style.display = 'block';

          if (vergoedbaar) {

            document.getElementById('vergoeding1').style.display = 'block';

            document.getElementById('vergoeding2').style.display = 'block';

            document.getElementById('probleemVergoeding').style.display = 'none';

          }

          else {

            document.getElementById('vergoeding1').style.display = 'none';

            document.getElementById('vergoeding2').style.display = 'none';

            document.getElementById('probleemVergoeding').style.display = 'block';

          }

          document.getElementById('vergoedingAanvraag').innerHTML = '(vergoeding aangevraagd)';

          alert("Uw keuze om de vergoeding aan te vragen, is genoteerd.\nGelieve nu bijkomende gegevens omtrent het overleg in te vullen.");

          document.location = "overleg_alles.php?tab=extraGegevens";

        }

        else {

          document.getElementById('vergoedbaarheidsDiv').style.display = 'none';

          document.getElementById('tochstartvergoedingDiv').style.display = 'none';

          document.getElementById('stopvergoedingDiv').style.display = 'none';

          if (vergoedbaar) {
            document.getElementById('tochstartvergoedingDiv').style.display = 'block';
          }

          document.getElementById('vergoeding1').style.display = 'none';

          document.getElementById('vergoeding2').style.display = 'none';

          document.getElementById('probleemVergoeding').style.display = 'none';

          document.getElementById('vergoedingAanvraag').innerHTML = '(vergoeding afgewezen)';

          document.getElementById('geenInschrijvingsnummer').style.display = 'none';

          alert("Uw keuze om de vergoeding NIET aan te vragen, is genoteerd.");

        }

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}



function inclusieSturen() {

    if (geenRijksRegister) {

      alert("Het rijksregisternummer  is nog niet gekend,\n" +

            "en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.");

      return false;

    }

    if (geenMutualiteit) {

      alert("Het inschrijvingsnummer bij de verzekeringsinstelling (mutualiteit) is nog niet gekend,\n" +

            "en die gegevens hebben we nodig voor de facturatie. Vul die in en rond (opnieuw) af.");

      return false;

    }



  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "tp_inclusie_sturen.php?overleg=" + <?= $overlegID ?> +

            "&patient=" + '<?= $_SESSION['pat_code'] ?>' +

            "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var result = request.responseText;

      var spatie = 0;

      while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.indexOf("OK") >= 0) {

        alert("Listel is verwittigd van de inclusie van deze patient.");

        inclusieMail = true;

        document.getElementById('formInclusieSturen').style.display = "none";

      }

      else {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}

</script>



<?php



print("<p style=\"text-align:left;\">Overleg voor <b>". patient_roepnaam($_SESSION['pat_code'])."</b>. ");



if ((!issett($overlegID)) || $overlegID == -1) {

  print(" <span id=\"vergoedingAanvraag\">&nbsp;</span> ");

}

else if ($overlegInfo['keuze_vergoeding'] == -1) {

  print(" <span id=\"vergoedingAanvraag\">(vergoeding geweigerd)</span> ");

}

else if ($overlegInfo['keuze_vergoeding'] == 1) {

  print(" <span id=\"vergoedingAanvraag\">(vergoeding voor deelnemers aangevraagd)</span> ");

}
else if ($overlegInfo['keuze_vergoeding'] == 2) {

  print(" <span id=\"vergoedingAanvraag\">(vergoeding voor organisator aangevraagd)</span> ");

}

else {

  print(" <span id=\"vergoedingAanvraag\">&nbsp;</span> ");

}



print("<br/></p>");



if (!isset($_GET['tab'])) {

   // het is een nieuw overleg

   $_SESSION['actie']="nieuw";

   if (issett($overlegID) && ($overlegID != -1)) {

      // er is echter al een overleg

     $dag = substr($overlegInfo['datum'],6,2);

     $maand = substr($overlegInfo['datum'],4,2);

     $jaar = substr($overlegInfo['datum'],0,4);

     print("<p>Er loopt nog een overleg voor deze patient op datum van $dag/$maand/$jaar.</p> ");

     print("<p>Zolang dit overleg niet afgerond is, kan er geen nieuw overleg opgestart worden.</p>");

     print("<p>Kies voor <a href=\"overleg_alles.php?tab=Teamoverleg\">bewerken</a> of <a href=\"overleg_alles.php?afronden=1&tab=Teamoverleg\">afronden</a> ");

     print("of maak een andere keuze uit het menu links.</p>");



     eindePagina();

     die();

   }

   else {

     // voor alle zekerheid overlegID nog eens afzetten

     $overlegID = -1;

     unset($overlegID);

     $status = $overlegStatus; // om te tonen in het statusvenster

   }

}

else {



  if ($_GET['afronden']==1) $_SESSION['actie']="afronden";

  else if ($_GET['wissen']==1) $_SESSION['actie']="wissen";

  else if (!isset($_SESSION['actie'])) $_SESSION['actie']="bewerken";



  if ($overlegID == -1) {

     // er is geen huidig overleg, dus kunnen we geen zinnige tab tonen

     print("<h2>Probleem</h2><p>Er werd nog g&eacute;&eacute;n overleg opgestart voor <strong>{$_SESSION['pat_code']} {$_SESSION['pat_naam']}</strong>.<br />

            Het overleg kan dan ook niet bewerkt worden. Het overleg dient via 'nieuw overleg' aangemaakt te worden. ");

     print("</p><p>Maak een nieuwe keuze uit het menu links.</p>");

     eindePagina();

     die();

  }

  else

   $status = $teamStatus;

   /*

   switch ($_GET['tab']) {

     case "Teamoverleg":

        $status = $teamStatus;

     break;

     case "Attesten":

        // nothing special to be done

     break;

     case "Afdrukpagina":

       // nothing special to be done

     break;

  }

  */



}


if ((!tp_opgenomen($_SESSION['pat_code'])) && $overlegGenre != "psy") { // && ($_SESSION['actie']=="afronden" || $_SESSION['actie']=="bewerken")) {

  $tabmenu = "

  <div class=\"tabmenu\" id=\"tabTaakfiches\"><a href=\"javascript:toon('Taakfiches');\">Taakfiches</a></div>";

  $tabcontent = "<div class=\"tabcontent\" id=\"Taakfiches\"><?php require(\"../includes/taakfiches.php\"); ?></div>";



}





?>





<div id="status">

 <?= $status ?>

</div>



<?php

if ($patientInfo['toestemming_zh']==0) {
?>
<div style="width:540px; background-color: #eee;  padding: 0px 1px;  margin: 2px;">
<p>
<!--
Sinds oktober 2011 kunnen ziekenhuizen opvragen of een pati&euml;nt een zorgplan heeft om
bij een ontslag de zorgbemiddelaar te kunnen contacteren. Daarom moet je eerst aanduiden of de pati&euml;nt al dan niet
toestemming geeft, vooraleer je dit overleg af kan ronden.
Dit doe je bij Pati&euml;ntenfiches -&gt; Gegevens aanpassen.
-->
Vergeet niet om aan de pati&euml;nt toestemming te vragen voor gegevensuitwisseling met het ziekenhuis
en dit aan te duiden bij de gegevens van de pati&euml;nt.
</p>
</div>

<?php
}

if (isEersteOverlegTP() && $overlegID >0 && ($patientInfo['in_email']!=1) && ($_SESSION['actie'] != "wissen") && ($_SESSION['actie'] != "weigeren") ) {

?>



<script type="text/javascript">var inclusieMail = false;</script>



<form method="post" onsubmit="return false;" id="formInclusieSturen">

   <fieldset class="normal">

        <div class="label220" style="font-size: 11px; width: 300px;">Zodra de pati&euml;nt effectief ge&iuml;ncludeerd is, dien je Listel binnen de 5 dagen op de hoogte te brengen.&nbsp;</div>

        <div class="waarde">

            <input type="button" value="Doe dit nu." onclick="<?= $hoofdDiagnoseTest ?>inclusieSturen()" />

        </div><!--Button opslaan -->

   </fieldset>

</form>



<?php

}

else {

  print('<script type="text/javascript">var inclusieMail = true;</script>');

}

      $volgendeDatum = $overlegInfo['volgende_datum'];
      $volgendeDag = substr($volgendeDatum, 6, 2);
      $volgendeMaand = substr($volgendeDatum, 4, 2);
      $volgendJaar = substr($volgendeDatum, 0, 4);


if ($_SESSION['actie']=="afronden") {



$formZichtbaarMaken = '<script type="text/javascript">function maakFormZichtbaar() {document.getElementById("afrondformulier").style.visibility="visible";document.getElementById("waarschuwing").style.display="none";}maakFormZichtbaar();</script>';

?>



<p id="waarschuwing">Druk op ctrl-F5 wanneer deze tekst gedurende langer dan 40 seconden zichtbaar blijft.</p>

<form style="visibility:hidden" id="afrondformulier" name="f" method="post" action="overleg_definitief_afronden.php" onSubmit="return testAlles();">

   <input type="hidden" name="verificatie" value="-1" />

   <fieldset class="normal">



<?php

  if ($overlegInfo['genre']=="TP" && strpos($overlegStatus,"inclusievergadering") ) {

?>

        <div class="label220">Dit overleg &nbsp;</div>

        <div class="waarde">

        <input type="hidden" name="vergoedingTPweigeren" value="0" />

        <input type="submit" value="definitief afronden ZONDER vergoeding" name="submit" onclick="document.f.vergoedingTPweigeren.value=1;"/>

        <br/><input type="submit" value="definitief afronden" name="submit"  onclick="document.f.vergoedingTPweigeren.value=0;"/>

        </div><!--Button opslaan -->

   </fieldset>

<?php

  }

  else {

?>
   <input type="hidden" name="volgend_dd" id="volgend_dd" value="<?= $volgendeDag ?>"/>
   <input type="hidden" name="volgend_mm" id="volgend_mm" value="<?= $volgendeMaand ?>" />
   <input type="hidden" name="volgend_jj" id="volgend_jj" value="<?= $volgendeJaar ?>"/>


        <div class="label220">Dit overleg &nbsp;</div>

        <div class="waarde">

            <input type="submit" value="definitief afronden" name="submit" />

        </div><!--Button opslaan -->

   </fieldset>

<?php

  }

?>

</form>



<?php

}

else if ($_SESSION['actie']=="wissen") {



$formZichtbaarMaken = '<script type="text/javascript">function maakFormZichtbaar() {document.getElementById("afrondformulier").style.visibility="visible";document.getElementById("waarschuwing").style.display="none";}maakFormZichtbaar();</script>';

?>



<p id="waarschuwing">Druk op ctrl-F5 wanneer deze tekst gedurende langer dan 40 seconden zichtbaar blijft.</p>

<form style="visibility:hidden" id="afrondformulier" name="f" method="post" action="overleg_definitief_afronden.php">



   <fieldset class="normal">

      <input type="hidden" name="overlegwissen" value="1" />



        <div class="label220">Dit overleg &nbsp;</div>

        <div class="waarde">

            <input type="submit" value="wissen: dit overleg gaat niet door." name="submit"  onclick="return confirm('Ben je zeker dat je dit overleg wil wissen?');"/>

        </div><!--Button opslaan -->

   </fieldset>

</form>



<?php

}

else if ($_SESSION['actie']=="weigeren") {



$formZichtbaarMaken = '<script type="text/javascript">function maakFormZichtbaar() {document.getElementById("afrondformulier").style.visibility="visible";document.getElementById("waarschuwing").style.display="none";}maakFormZichtbaar();</script>';

?>



<p id="waarschuwing">Druk op ctrl-F5 wanneer deze tekst gedurende langer dan 40 seconden zichtbaar blijft.</p>

<form style="visibility:hidden" id="afrondformulier" name="f" method="post" action="overleg_definitief_afronden.php"

      onsubmit="return confirm('Ben je zeker dat je deze patient weigert voor inclusie?');">



   <fieldset class="normal">



        <div class="label220">Deze pati&euml;nt &nbsp;</div>

        <div class="waarde">

        <input type="hidden" name="vergoedingTPweigeren" value="nietIncluderen" />

        <input type="submit" value="weigeren voor inclusie (en het overleg wissen)" name="submit" />

        </div><!--Button opslaan -->

   </fieldset>

</form>



<?php

}

?>







<div id="tabcontainer" style="height:1200px;"> <!-- 4 opties -->
  <div class="tabmenu" id="tabBasisgegevens"><a href="javascript:toon('Basisgegevens');">Basisgegevens</a></div>
<?php
if ($overlegGenre == "psy") {
?>
  <div class="tabmenu" id="tabDomeinen"><a href="javascript:toon('Domeinen');">Domeinen</a></div>
  <div class="tabmenu" id="tabTeamoverleg"><a href="javascript:toon('Teamoverleg');">Teamoverleg</a></div>
  <div class="tabmenu" id="tabBegeleidingsplan"><a href="javascript:toon('Begeleidingsplan');">Begeleidingsplan</a></div>
  <div class="tabmenu" id="tabCrisisplan"><a href="javascript:toon('Crisisplan');">Crisisplan</a></div>
<?php
}
else {
?>
  <div class="tabmenu" id="tabTeamoverleg"><a href="javascript:toon('Teamoverleg');">Teamoverleg</a></div>
  <div class="tabmenu" id="tabAttesten"><a href="javascript:toon('Attesten');">Attesten en bijlagen</a></div>
<?php
  if ((!tp_opgenomen($_SESSION['pat_code'])) && ($_SESSION['actie']=="afronden" || $_SESSION['actie']=="bewerken")) {
    print("<div class=\"tabmenu\" id=\"tabTaakfiches\"><a href=\"javascript:toon('Taakfiches');\">Taakfiches</a></div>");
  }

  if (is_tp_patient() && $_SESSION['profiel']!='OC') {
    print("<div class=\"tabmenu\" id=\"tabPlan\"><a href=\"javascript:toon('Plan');\">Plan van tenlasteneming</a></div>");
  }
}
?>
  <div class="tabmenu" id="tabAfdrukpagina"><a href="javascript:toon('Afdrukpagina');">Afdrukpagina</a></div>

<!-- vanaf hier de content -->

  <div class="tabcontent" id="Basisgegevens">
     <?php require("../includes/overleg_basisgegevens.php"); ?>
  </div>

<?php
if ($overlegGenre == "psy") {
    print("<div class=\"tabcontent\" id=\"Domeinen\">");
    psyDomeinenDatum($patientInfo, $overlegInfo['datum']);
    print("</div>");
?>
  <div class="tabcontent" id="Teamoverleg" style="height: 100px;">
    <?php
    //---------------------------------------------------------
    /* Deelnemers ophalen */ require("../includes/deelnemers_ophalen_ajax.php");
    //---------------------------------------------------------
    ?>
  </div>
    <script language="javascript">
      document.getElementById('Teamoverleg').style.height = <?= max(500,$hoogte) ?> + "px";
    </script>
  <div class="tabcontent" id="Begeleidingsplan" style="background-color:#f9eddf;">
    <!-- datum van het volgende overleg -->
<form id="volgendOverleg" name="volgendOverlegForm" onsubmit="return false;">
   <fieldset style="width:480px;">
      <div class="inputItem" id="IIStartdatum">
         <div class="label220" style="width:280px;">Datum volgend overleg (dd/mm/jjjj)<div class="reqfield">*</div>&nbsp;: <br/>
           <span style="font-size:80%;">Dit moet binnen het jaar georganiseerd worden.</span>
         </div>
         <div class="waarde">
            <input type="text" size="2" value="<?= $volgendeDag ?>" name="volgend_overleg_dd" id="volgend_overleg_dd"
                onkeyup="checkForNumbersOnly(this,2,0,31,'volgendOverlegForm','volgend_overleg_mm')"
                onblur="checkForNumbersLength(this,2);kopieer('dd');" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?= $volgendeMaand ?>" name="volgend_overleg_mm" id="volgend_overleg_mm"
                onkeyup="checkForNumbersOnly(this,2,0,12,'volgendOverlegForm','volgend_overleg_jj')"
                onblur="checkForNumbersLength(this,2);kopieer('mm');" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?= $volgendJaar ?>" name="volgend_overleg_jj" id="volgend_overleg_jj"
                onblur="checkForNumbersLength(this,4);;kopieer('jj');checkJaarGeleden();" />
         </div>
      </div>
   </fieldset>
</form>
   <!-- einde datum van het volgende overleg -->
    <?php
      require("../includes/psy_begeleidingsplan.php");
      require("../includes/doe_email_psy.php");
      require("../includes/overleg_bijlagen.php");
    /********************************  omb-formulier */
    if (($patientInfo['omb_actief']==1) || $ombmogelijk) {
      if (($patientInfo['omb_actief']==1) || $ombintevullen) $zichtbaar = "block";
      else $zichtbaar = "none";

      $bronMeenemen = "&omb_bron={$patientInfo['omb_bron']}&patient={$patientInfo['code']}";

      if ($overlegInfo['omb_id']>0) {
          print("<hr/><li id='ombformulier' style='display:$zichtbaar'>De vragenlijst voor OMB is ingevuld en afgerond. Je kan hem <a href=\"omb_registratie.php?zoekid={$overlegInfo['omb_id']}&terugNaarOverleg=1\">hier bekijken.</a><br/>Vergeet niet om de verklaring bankrekeningnummers naar LISTEL vzw op te sturen indien hierboven staat dat je een vergoeding voor OMB kunt krijgen.</li>");
      }
      else if ($overlegInfo['omb_id']<0) {
          print("<hr/><li id='ombformulier' style='display:$zichtbaar'>De vragenlijst voor OMB is nog niet afgerond. Je kan hem <a href=\"omb_registratie.php?zoekid={$overlegInfo['omb_id']}&terugNaarOverleg=1\">hier verder invullen en afronden.</a></li>");
      }
      else if ($overlegInfo['afgerond']==0) {
          print("<hr/><li id='ombformulier' style='display:$zichtbaar'>De vragenlijst voor OMB is (nog) niet ingevuld. <br/><a href=\"omb_registratie.php?overlegID={$overlegInfo['id']}&terugNaarOverleg=1$bronMeenemen\">Doe dit hier</a> zodat je eventueel kan genieten van de vergoeding OMB.</li>");
      }
    }
    /********************************  einde omb-formulier */

    ?>
    <hr/>

    
  </div>
  <div class="tabcontent" id="Crisisplan" style="background-color:#f9eddf;">
    <?php
      require("../includes/psy_crisisplan.php");
    ?>
  </div>
  <div class="tabcontent" id="Afdrukpagina">
     <?php require("../includes/overleg_printoverzicht_psy.php"); ?>
  </div>
<?php
}
else {

?>
  <div class="tabcontent" id="Teamoverleg" style="height: 100px;">
    <?php
    //---------------------------------------------------------
    /* Deelnemers ophalen */ require("../includes/deelnemers_ophalen_ajax.php");
    //---------------------------------------------------------
    ?>
  </div>
  <div class="tabcontent" id="Attesten">
     <?php require("../includes/overleg_attesten_bijlagen.php"); ?>
  </div>
    <script language="javascript">
      document.getElementById('Teamoverleg').style.height = <?= max(500,$hoogte) ?> + "px";
    </script>
<?php
  if ((!tp_opgenomen($_SESSION['pat_code'])) && ($_SESSION['actie']=="afronden" || $_SESSION['actie']=="bewerken")) {
    print("<div class=\"tabcontent\" id=\"Taakfiches\">\n");
    $refID = "overleg$overlegID";
    require("../includes/taakfiches.php");
    print("</div>");
  }

  if (is_tp_patient()) {
    // nagaan of het plan al ingevuld is
    $qryLeegPlan = "select * FROM overleg_tp_plan WHERE length(plan)>0 and overleg = $overlegID
                                                        AND NOT (genre = \"orgpersoon\")";
    $resultLeegPlan = mysql_query($qryLeegPlan);

    if ($overlegID > 0 && mysql_num_rows($resultLeegPlan) > 0)
      print('<script type="text/javascript">var planIngevuld = true;</script>');
    else
      print('<script type="text/javascript">var planIngevuld = false;document.getElementById("emailTP").style.display = "block";</script>');
    }

  if (is_tp_patient() && $_SESSION['profiel']!='OC') {
    print("<div class=\"tabcontent\" id=\"Plan\">\n");
    if ((issett($overlegID)) && ($overlegID > 0))
      require("../includes/overleg_tp_plan.php");
    print("</div>");
  }
?>
  <div class="tabcontent" id="Afdrukpagina">
     <?php require("../includes/overleg_printoverzicht.php"); ?>
  </div>

<?php
}
?>




</div> <!-- einde 4 opties -->



<?php





if (isset($_GET['tab'])) {

  $actieveTab = $_GET['tab'];
  if ($actieveTab == "Attesten" && $overlegInfo['genre']=="psy") {
    $actieveTab = "Begeleidingsplan";
  }
}

else {

  $actieveTab = "Basisgegevens";

}



?>

<script type="text/javascript">
<?php
  if ($overlegGenre == "psy") {
?>
  var alleItems = new Array("Basisgegevens","Domeinen","Teamoverleg","Begeleidingsplan","Crisisplan","Afdrukpagina");
<?php
  }
  else {
?>

  var alleItems = new Array("Basisgegevens","Teamoverleg","Attesten",
<?php
  if ((!tp_opgenomen($_SESSION['pat_code'])) && ($_SESSION['actie']=="afronden" || $_SESSION['actie']=="bewerken")) {
    print("\"Taakfiches\",");
  }
  if (is_tp_patient() && $_SESSION['profiel']!='OC') {
    print("\"Plan\",");
  }
?>"Afdrukpagina");
<?php
  }
?>

  function activeer(item) {
    var elemJS = document.getElementById(item);
    var tabJS = document.getElementById("tab"+item).firstChild;
    elemJS.style.display = 'block';
    tabJS.style.fontStyle = 'normal';
    tabJS.style.backgroundColor = '#FFCC66';
  }



  function desactiveer(item) {
    var elementje = document.getElementById(item);
    var tabje = document.getElementById("tab"+item).firstChild;
    elementje.style.display = 'none';
    tabje.style.fontStyle = 'normal';
    tabje.style.backgroundColor = 'white';
  }



  function disableTab(item) {

    desactiveer(item);

    var tab = document.getElementById("tab"+item).firstChild;

    tab.style.fontStyle = "italic";

    tab.style.color = '#D5CCCC';

  }



  function enableTab(item) {

    var tab = document.getElementById("tab"+item).firstChild;

    tab.style.color = '#D58700';

  }

</script>



<?php

if ($actieveTab != "Basisgegevens" && $actieveTab != "extraGegevens" ) {

?>

<script type="text/javascript">

  function toon(item) {

    // alleen wanneer er een andere tab dan Basisgegevens geselecteerd is

    // kan er écht geklikt worden op de verschillende tabs

    for (nr in alleItems) {

      desactiveer(alleItems[nr]);

    }

    activeer(item);

  }

</script>

<?php

} else {

?>

<script type="text/javascript">

  function toon(item) {

    for (nr in alleItems) {

      disableTab(alleItems[nr]);

    }

   enableTab("Basisgegevens");

   activeer("Basisgegevens");

  }

</script>

<?php

}



if ($actieveTab == "extraGegevens" || $actieveTab == "Basisgegevens2") {

  $actieveTab = "Basisgegevens";

}

?>





<script type="text/javascript">

  // af laten hangen van welke tab geopend moet worden

  toon("<?= $actieveTab ?>");

  updateStatus("<?= $status ?>");



</script>



<?php

  print($formZichtbaarMaken);

  eindePagina();

?>



