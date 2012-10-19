<?php

session_start();





   require("../includes/dbconnect2.inc");



function printPagina($persoon,$extra) {

  global $pdf, $alleInfo, $mm, $tp_basisgegevens, $afdrukker;

  

  $pdf->ezImage("../images/logoke.jpg", 30, 100, "none", "left");



  $pdf->ezSetY(297*$mm-30*$mm);

  $options = array('aleft'=>100*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("{$persoon['naam']} {$persoon['voornaam']}\n{$persoon['orgnaam']}\n{$persoon['adres']}\n{$persoon['dlzip']} {$persoon['dlnaam']}",12,$options);



  $pdf->ezSetY(297*$mm-75*$mm);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("<b>Contactpersoon<b> {$afdrukker['langeNaam']}",12,$options);

  $pdf->ezSetDy(12);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'right');

  $pdf->ezText("d.d. " . date("d/m/Y"),12,$options);



  $pdf->ezSetY(297*$mm-105*$mm);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("Beste,\n\n\nU wordt, samen met alle andere betrokken partners $extra, vriendelijk uitgenodigd op het overleg van {$alleInfo['naam']} {$alleInfo['voornaam']}. Dit overleg is gepland in het kader van het therapeutisch project {$tp_basisgegevens['nummer']}.",12,$options);



  $pdf->ezText("\n\n\nDatum: {$alleInfo['mooieDatum']}\n\n", 12, $options);

  $pdf->ezText("Tijdstip: {$alleInfo['tijdstip']}\n\n", 12, $options);

  $pdf->ezText("Plaats: {$alleInfo['locatieTekst']}\n\n", 12, $options);

  

  $pdf->ezText("Gelieve tijdig te verwittigen indien u niet aanwezig kan zijn. Voor meer informatie kan u steeds contact opnemen met {$afdrukker['langeNaam']} (tel. {$afdrukker['tel']})\n\n\n", 12, $options);

  $pdf->ezText("Met vriendelijke groet,\n{$afdrukker['naam']} {$afdrukker['voornaam']}", 12, $options);



  $pdf->ezSetY(25*$mm);

  $options = array('aleft'=>25*$mm,

                 'aright' => 595.28-35*$mm,

                 'justification' => 'justify');

  $pdf->ezText("LISTEL vzw                 A. Rodenbachstraat 29/1 - 3500 Hasselt                           ", 12, $options);



  

}



if ($_SESSION['profiel'] == "OC") {

   $query2 = "SELECT * from overleg where

                    id = {$_POST['id']}

                    and tp_rechtenOC = 1";

   if (mysql_num_rows(mysql_query($query2))==1) {

     $rechten = true;

   }

   else {

     $rechten = false;

   }

}

else if ($_SESSION['profiel'] == "listel") {

  $rechten = true;

}

else {

  $rechten = false;

}



  // zoek projectnummer op

  $qry =  "select project from patient_tp, overleg

           where patient =  patient_code

           and   datum >= replace(begindatum, '-', '') AND

              (  datum <= replace(einddatum, '-', '')

                   or

                 einddatum is NULL

              )

           and overleg.id = {$_POST['id']}";

  $projectArray = mysql_fetch_assoc(mysql_query($qry));

  foreach ($projectArray as $key => $value) {

     $projectArray[$key] = utf8_decode($projectArray[$key]);

  }

  $projectID = $projectArray['project'];





   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project" || $rechten))

      {

    $tp_basisgegevens = tp_record($projectID);

    $overlegID = $_POST['id'];

    $tabel = $_POST['tabel'];



    $querypat = "

         SELECT

                p.naam,

                p.voornaam,

                p.adres,

                g.dlzip,

                g.dlnaam,

                p.gebdatum,

                p.id, p.code,

                p.mutnr,

                patient_tp.project,

                tp_project.naam as project_naam,

                tp_project.nummer as project_nummer,

                overleg.*

            FROM

                patient p, patient_tp,

                tp_project,

                gemeente g,

                overleg

            WHERE

                overleg.id = $overlegID AND

                p.code= overleg.patient_code AND

                p.code = patient_tp.patient AND

                patient_tp.project = tp_project.id AND

                patient_tp.actief = 1 AND

                p.gem_id=g.id"; // Query

      if ($resultpat=mysql_query($querypat))

        {

            $alleInfo= mysql_fetch_array($resultpat);

            foreach ($alleInfo as $key => $value) {

              $alleInfo[$key] = utf8_decode($alleInfo[$key]);

            }

        }

      else {

        die("dieje query $querypat alles van het patient en project op te halen toch..." .mysql_error());

      }



    if ($tabel == "afgeronde")

      $voorwaarde = "overleg_id = $overlegID";

    else

      $voorwaarde = "patient_code = '{$alleInfo['code']}'";





    $datum = $alleInfo['datum'];

    $alleInfo['mooieDatum'] = substr($datum, 6,2) . "/" . substr($datum, 4,2) . "/" . substr($datum, 0,4);



    $qryAfdrukker = "select * from logins where id = {$_SESSION['usersid']}";

    $afdrukker = mysql_fetch_assoc(mysql_query($qryAfdrukker));

    foreach ($afdrukker as $key => $value) {

      $afdrukker[$key] = utf8_decode($afdrukker[$key]);

    }

    if ($afdrukker['profiel'] == "OC") {

      $afdrukker['langeNaam'] ="{$afdrukker['naam']} {$afdrukker['voornaam']}, overlegcoördinator TGZ";

    }

    else {

      $afdrukker['langeNaam'] ="{$afdrukker['naam']} {$afdrukker['voornaam']}, {$afdrukker['profiel']}-coördinator";

    }



    if ($afdrukker['tel']=="") {

        $qryTelOrg="SELECT * FROM organisatie WHERE organisatie.id = {$afdrukker['organisatie']}";

        $resultTelOrg = mysql_query($qryTelOrg);

        if (mysql_num_rows($resultTelOrg) > 0) {

           $telOrg = mysql_fetch_assoc($resultTelOrg);

           $afdrukker['tel'] = $telOrg['tel'];

        }

    }

         $qryPartners = "select organisatie.naam as orgnaam,

                            hulpverleners.*,

                            gemeente.dlnaam, gemeente.dlzip

                     from {$tabel}_betrokkenen,

                          organisatie,

                          hulpverleners left join gemeente on (hulpverleners.gem_id = gemeente.id)

                     where overleggenre = 'gewoon' AND
                       ({$tabel}_betrokkenen.genre = 'orgpersoon' or {$tabel}_betrokkenen.genre = 'hulp')
                       and persoon_id = hulpverleners.id

                       and hulpverleners.organisatie = organisatie.id

                       and $voorwaarde

                       and aanwezig = 1

                     order by organisatie.id";

                     



//die($qryPartners);

//mainblock



$mm = 595.28/210;

include('../ezpdf/class.ezpdf.php');



$pdf =& new Cezpdf('A4');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');





$resultMensen = mysql_query($qryPartners);

for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {

  $persoon = mysql_fetch_assoc($resultMensen);

    foreach ($persoon as $key => $value) {

      $persoon[$key] = utf8_decode($persoon[$key]);

    }

    // desnoods adres van organisatie opzoeken

    if ($persoon['organisatie'] > 0 && ($persoon['gem_id'] == 0  || $persoon['gem_id'] == 9999) ) {

                 $qry8="SELECT dlzip,dlnaam, adres FROM gemeente, organisatie WHERE gemeente.id=organisatie.gem_id and organisatie.id = {$persoon['organisatie']}";

                  $gemeente=mysql_fetch_array(mysql_query($qry8)) or die($qry8 . mysql_error());

                  foreach ($gemeente as $key => $value) {

                    $gemeente[$key] = utf8_decode($gemeente[$key]);

                  }

                  $persoon['adres'] = $gemeente['adres'];

                  $persoon['dlzip'] = $gemeente['dlzip'];

                  $persoon['dlnaam'] = $gemeente['dlnaam'];

    }

    printPagina($persoon,"");

    if ($i+1 < mysql_num_rows($resultMensen)) $pdf->ezNewPage();

}





if ($_GET['ookMantelzorgers']==1) {

   $pdf->ezNewPage();

   printPagina($alleInfo," en mantelzorgers");



   $qryMZ = "select mantelzorgers.*,

                            gemeente.dlnaam, gemeente.dlzip,

                     ' ' as orgnaam

                     from {$tabel}_betrokkenen, mantelzorgers left join gemeente on (mantelzorgers.gem_id = gemeente.id)

                     where overleggenre = 'gewoon' AND
                       ({$tabel}_betrokkenen.genre = 'mantel')
                       and persoon_id = mantelzorgers.id

                       and $voorwaarde";



  $resultMensen = mysql_query($qryMZ) or die(mysql_error());

  for ($i=0; $i<mysql_num_rows($resultMensen); $i++) {

    $pdf->ezNewPage();

    $persoon = mysql_fetch_assoc($resultMensen);

    foreach ($persoon as $key => $value) {

      $persoon[$key] = utf8_decode($persoon[$key]);

    }

    printPagina($persoon," en mantelzorgers");

  }



}



$pdf->ezStream();



      require("../includes/dbclose.inc");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>