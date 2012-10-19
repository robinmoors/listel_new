<?php

ob_start();

session_start();

/****************
*** DEBUG-versie als je &debug=1 toevoegt aan de URL
****************/

   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "stats_TP";





$begindatum = "{$_GET['beginjaar']}{$_GET['beginmaand']}{$_GET['begindag']}";

$einddatum = "{$_GET['eindjaar']}{$_GET['eindmaand']}{$_GET['einddag']}";



if ($begindatum == "") $begindatum = "18999999";

if ($einddatum == "") $einddatum = "20999999";



$beginMooi = "{$_GET['begindag']}/{$_GET['beginmaand']}/{$_GET['beginjaar']}";

$eindMooi = "{$_GET['einddag']}/{$_GET['eindmaand']}/{$_GET['eindjaar']}";



$beginDate = "{$_GET['beginjaar']}-{$_GET['beginmaand']}-{$_GET['begindag']}";

$eindDate = "{$_GET['eindjaar']}-{$_GET['eindmaand']}-{$_GET['einddag']}";



$mm = 595.28/210;





include('../ezpdf/class.ezpdf.php');



$pdf =& new Cezpdf('A4', 'portrait');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../ezpdf/fonts/Times-Roman.afm');





   $options = array('aleft'=>35*$mm,

                 'aright' => 210*$mm-35*$mm,

                 'justification' => 'left');

   $options2 = array('aleft'=>55*$mm,

                 'aright' => 210*$mm-35*$mm,

                 'justification' => 'left');





function toonTP($tp) {

   global $pdf, $options, $options2, $beginMooi, $eindMooi,$mm, $_TP_FOR_K;



   $pdf->ezSetY(297*$mm-15*$mm);

   $pdf->ezStartPageNumbers(195*$mm,15*$mm,10,'','p.{PAGENUM}/{TOTALPAGENUM}',1);



if ($tp['id']==$_TP_FOR_K) {

   $pdf->ezText("Terug te sturen naar de FOD Volksgezondheid, ter attentie van de Dienst Psychosociale Gezondheidszorg, op onderstaand adres :", 10, $options);

   $pdf->ezText("\n\nFOD Volksgezondheid", 11, $options); //, Veiligheid van de Voedselketen en Leefmilieu", 11, $options);

   $pdf->ezText("Directoraat-Generaal Org. Gezondheidszorgvoorzieningen", 11, $options);

   $pdf->ezText("Bestuursdirectie Gezondheidszorgbeleid", 11, $options);

   $pdf->ezText("T.a.v. de heer M. MOREELS", 11, $options);

   $pdf->ezText("Victor Hortaplein 40 bus 10", 11, $options);

   $pdf->ezText("bureau 1 D 08 A", 11, $options);

   $pdf->ezText("1060 BRUSSEL.", 11, $options);

   $pdf->ezText(" ", 11, $options);



}

else {

   $pdf->ezText("<b>Terug te sturen naar het RIZIV, ter attentie van de Directie Verzorgingsinstellingen - Tervurenlaan, 211 – 1150  Brussel.</b>",10,$options);

}

   $pdf->ezText("<b>Ten laatste de 3e maand volgend op de betrokken periode.</b>\n\n",10,$options);





   $pdf->ezText("<b>Gegevens met betrekking tot de activiteit van een therapeutisch project</b>\n\n",13,$options);



   $pdf->ezText("Deze vragenlijst moet jaarlijks worden ingevuld ter uitvoering van de overeenkomst die op ................... met het Verzekeringscomité is gesloten.\n\n",11,$options);



   $pdf->ezText("<b>Periode van 12 maanden waarop dit verslag van toepassing is:</b>",11,$options);

   $pdf->ezText("Van 1 april {$_GET['beginjaar']} tot 31 maart {$_GET['eindjaar']}.\n\n",11,$options);





   $pdf->ezText("<b>Algemene inlichtingen:</b>\n",11,$options);



   $qryCoord = "select * from logins where profiel = 'hoofdproject' and tp_project = {$tp['id']} and login not like '%help%' and actief=1";

   $tpCoord = mysql_fetch_assoc(mysql_query($qryCoord));

   foreach ($tpCoord as $key => $value) {

      $tpCoord[$key] = utf8_decode($tpCoord[$key]);

   }



   $pdf->ezText("Identificatie van het project",11,$options2);

   $pdf->ezText("Projectnummer: <b>{$tp['nummer']}</b>",11,$options2);

   $pdf->ezText("Identiteit van de administratieve coördinator: <b>GDT LISTEL vzw</b>",11,$options2);

   $pdf->ezText("Naam van de contactpersoon: <b>{$tpCoord['naam']} {$tpCoord['voornaam']}</b>",11,$options2);

   $pdf->ezText("Telefoonnummer: <b>{$tpCoord['tel']}</b>",11,$options2);

   $pdf->ezText("Email: <b>{$tpCoord['email']}</b>\n\n",11,$options2);





   $pdf->ezText("Wijzigingen die in de loop van het boekjaar aan het project worden aangebracht (doelgroep, werkingsgebied, partners) en in het bijzonder elke wijziging die wordt aangebracht aan het samenwerkingsakkoord dat de partners bindt

In voorkomend geval, een kopie bijvoegen van het samenwerkingsakkoord dat ten gevolge van die wijzigingen is aangepast\n...\n...\n...\n...\n",11,$options2);





    $pdf->ezText("<b>Inlichtingen met betrekking tot de doelgroep:</b>\n",11,$options);





    $pdf->ezText("De gegevens in onderstaande tabellen hebben betrekking op alle patiënten die behandeld werden in het kader van het therapeutisch project, zowel deze waarvoor overleg gefactureerd werd als deze waarvoor overleg plaatsvond maar dat niet gefactureerd werd.\n\n",11,$options);





   /* eerst de leeftijdsklasse */

   toonLeeftijd($tp);

   /* dan de pathologie */

   toonPathologie($tp);

   /* aanvullende elementen (ja/nee vragen) */

   toonAanvullend($tp);

   

   /* binnen of buiten het werkingsgebied */

   toonWerkingsgebied($tp);

   

   $pdf->ezText("\n\n\n<b>Inlichtingen met betrekking tot de activiteit:</b>\n",11,$options);



   

   /* activiteit */

   toonActiviteit($tp);

   /* levensduur van de gestopten */

   toonGestopten($tp);

   /* aantal overleggen en vergoeding */

   toonOverlegInfo($tp);

   

   $options3 = array('aleft'=>110*$mm,

                 'aright' => 210*$mm-35*$mm,

                 'justification' => 'left');

   // handtekening en zo

   $pdf->ezText("\n\n\nGedaan te ........................\nOp ........................\n\n\nNaam, voornaam........................\n\nHandelend in de hoedanigheid van administratief coördinator.\nHandtekening\n\n", 11, $options3);

}





function toonLeeftijd($tp) {

   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $einddatum ;

   if ($einddatum >= date("Ymd")) {

     $refJaar = date("Y");

     $refMaand = date("m");

     $refDag = date("d");

   }

   else {

     $refJaar = $_GET['eindjaar'];

     $refMaand = $_GET['eindmaand'];

     $refDag = $_GET['einddag'];

   }

   $jaar9 = $refJaar-9 . "$refMaand$refDag";

   $jaar19 = $refJaar-19 . "$refMaand$refDag";

   $jaar30 = $refJaar-30 . "$refMaand$refDag";

   $jaar40 = $refJaar-40 . "$refMaand$refDag";

   $jaar50 = $refJaar-50 . "$refMaand$refDag";

   $jaar60 = $refJaar-60 . "$refMaand$refDag";

   $jaar70 = $refJaar-70 . "$refMaand$refDag";

   $query =

   "select count(patient) as aantal_patienten,

          sum(gebdatum >  $jaar9) as 0_tem_8,

          sum(gebdatum >  $jaar19 and gebdatum <= $jaar9) as 9_tem_18,

          sum(gebdatum >  $jaar30 and gebdatum <= $jaar19) as 19_tem_29,

          sum(gebdatum >  $jaar40 and gebdatum <= $jaar30) as 30_tem_39,

          sum(gebdatum >  $jaar50 and gebdatum <= $jaar40) as 40_tem_49,

          sum(gebdatum >  $jaar60 and gebdatum <= $jaar50) as 50_tem_59,

          sum(gebdatum >  $jaar70 and gebdatum <= $jaar60) as 60_tem_69,

          sum(gebdatum <= $jaar70) as 70_en_meer

          from patient_tp inner join patient on code = patient

          where project = {$tp['id']}

            and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

   ";



   $resultaat = mysql_fetch_assoc(mysql_query($query));

   



   $pdf->ezText("aantal patiënten per leeftijdsklasse tijdens de periode\n",11,$options2);



   $tabel[0]["Leeftijdsklasse"] = "< 9 jaar";

   $tabel[0]["Aantal patiënten"] = $resultaat['0_tem_8'];

   $tabel[1]["Leeftijdsklasse"] = "9-18 jaar";

   $tabel[1]["Aantal patiënten"] = $resultaat['9_tem_18'];

   $tabel[2]["Leeftijdsklasse"] = "19-29 jaar";

   $tabel[2]["Aantal patiënten"] = $resultaat['19_tem_29'];

   $tabel[3]["Leeftijdsklasse"] = "30-39 jaar";

   $tabel[3]["Aantal patiënten"] = $resultaat['30_tem_39'];

   $tabel[4]["Leeftijdsklasse"] = "40-49 jaar";

   $tabel[4]["Aantal patiënten"] = $resultaat['40_tem_49'];

   $tabel[5]["Leeftijdsklasse"] = "50-59 jaar";

   $tabel[5]["Aantal patiënten"] = $resultaat['50_tem_59'];

   $tabel[6]["Leeftijdsklasse"] = "60-69 jaar";

   $tabel[6]["Aantal patiënten"] = $resultaat['60_tem_69'];

   $tabel[7]["Leeftijdsklasse"] = "> 69 jaar";

   $tabel[7]["Aantal patiënten"] = $resultaat['70_en_meer'];

   $tabel[8]["Leeftijdsklasse"] = "Totaal";

   $tabel[8]["Aantal patiënten"] = $resultaat['aantal_patienten'];



   $pdf->ezTable($tabel);



}



function toonPathologie($tp) {

   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $begindatum, $einddatum;

   $query = "";

   $query = "select count(id) as aantal,hoofddiagnose,diagnosegenre

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by hoofddiagnose,diagnosegenre

             order by diagnosegenre,hoofddiagnose ";



   $result=mysql_query($query) or die(mysql_error() . "<br /> $query");



   for ($i = 0; $i < mysql_num_rows($result); $i++) {

     $record = mysql_fetch_assoc($result);

     foreach ($record as $key => $value) {

       $record[$key] = utf8_decode($record[$key]);

     }

     $pathos["{$record['diagnosegenre']} {$record['hoofddiagnose']}"]['hoofd'] = $record['aantal'];

   }





   $query = "select count(sec.id) as aantal,sec.dsm as secundaire_diagnose, diagnosegenre

             from patient_tp, patient_secundair sec

             where patient_tp.project = {$tp['id']}

               and patient_tp.project = sec.project

               and patient_tp.patient = sec.patient

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by sec.dsm,diagnosegenre

             order by diagnosegenre,sec.dsm ";



   $result=mysql_query($query) or die(mysql_error() . "<br /> $query");



   for ($i = 0; $i < mysql_num_rows($result); $i++) {

     $record = mysql_fetch_assoc($result);

     foreach ($record as $key => $value) {

       $record[$key] = utf8_decode($record[$key]);

     }

     $pathos["{$record['diagnosegenre']} {$record['secundaire_diagnose']}"]['secundair'] = $record['aantal'];

   }



   

   $i=0;

   foreach ($pathos as $pathologiecode => $arrayke) {

     $tabel[$i]["Omschrijving / benaming"] = "  ";

     $tabel[$i]["ICD of DSM-code"] = $pathologiecode;

     $tabel[$i]["# Hoofddiagnose"] = $arrayke['hoofd'];

     $tabel[$i]["# Secundaire diagnose"] = $arrayke['secundair'];

     $i++;

   }

   

   $pdf->ezNewPage();

   $pdf->ezText("aantal patiënten per type pathologie (volgens de codes ICD 10 of DSM IV), waarbij een onderscheid wordt gemaakt tussen hoofddiagnose en secundaire diagnose\n",11,$options2);

   $pdf->ezTable($tabel);

}



function toonAanvullend($tp) {

   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $einddatum ;

   $query =

   "select

          sum(aanvullend1) as aanvullend_1,

          sum(aanvullend2) as aanvullend_2,

          sum(aanvullend3) as aanvullend_3,

          sum(aanvullend4) as aanvullend_4,

          sum(aanvullend5) as aanvullend_5,

          sum(aanvullend6) as aanvullend_6,

          sum(aanvullend7) as aanvullend_7,

          sum(aanvullend8) as aanvullend_8

          from patient_tp

          where project = {$tp['id']}

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

   ";





   $resultaat = mysql_fetch_assoc(mysql_query($query));

   foreach ($resultaat as $key => $value) {

       $resultaat[$key] = utf8_decode($resultaat[$key]);

   }



   $pdf->ezText("aantal patiënten uitgesplitst volgens de aanvullende bepalende elementen van de doelgroep\n",11,$options2);



   $j=0;

   for ($i=1; $i<=8; $i++) {

     if (strlen($tp["aanvullend$i"])>0) {

        $tabel[$j]["Aanvullende bepalende elementen die eigen zijn aan het project"] = $tp["aanvullend$i"];

        $tabel[$j]["Aantal patiënten"] = $resultaat["aanvullend_$i"];

        $j++;

     }

   }



   $pdf->ezTable($tabel);



}



function toonWerkingsgebied($tp) {

   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $begindatum, $einddatum, $sep;

   $query = "";



   /* tp_werkingsgebied.gemeente heeft volgende mogelijkheden

       -1 : limburg

       -2 : antwerpen & limburg

       >0 : gewone gemeente   */

   

   // eerst gewone gemeenten

   $query = "select patient.id

             from patient_tp inner join patient on (patient = code), tp_werkingsgebied, gemeente

             where project = {$tp['id']}

               and tp_werkingsgebied.tp = project

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

               and patient.gem_id = gemeente.id and gemeente.zip = tp_werkingsgebied.gemeente";

   $gewoon = mysql_num_rows(mysql_query($query));

   // is het limburg?

   $query = "select patient.id

             from patient_tp inner join patient on (patient = code), tp_werkingsgebied

             where project = {$tp['id']}

               and tp_werkingsgebied.tp = project

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

               and patient.gem_id >= 542

               and patient.gem_id < 760

               and tp_werkingsgebied.gemeente = - 1";

   $limburg = mysql_num_rows(mysql_query($query));

   // is het antwerpen + limburg?

   $query = "select patient.id

             from patient_tp inner join patient on (patient = code), tp_werkingsgebied

             where project = {$tp['id']}

               and tp_werkingsgebied.tp = project

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

               and

               (

                  (patient.gem_id >= 542 and patient.gem_id < 760)

                  or

                  (patient.gem_id >= 247 and patient.gem_id < 407)

               )

               and tp_werkingsgebied.gemeente = - 2";

   $antwlimburg = mysql_num_rows(mysql_query($query));

   // alle patienten

   $query = "select id

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

   ";

   $allen = mysql_num_rows(mysql_query($query));



    $pdf->ezText("\n\naantal patiënten die al dan niet tot de werkingsgebied van het project behoren (volgens hun hoofdverblijfplaats)\n",11,$options2);

    

    $tabel[0]["Volgens de hoofdverblijfplaats van de patiënt"] = "Patiënten die tot de werkingsgebied van het project behoren";

    $tabel[0]["Aantal patiënten"] = $gewoon + $limburg + $antwlimburg;

    $tabel[1]["Volgens de hoofdverblijfplaats van de patiënt"] = "Patiënten die niet tot de werkingsgebied van het project behoren";

    $tabel[1]["Aantal patiënten"] = $allen - ($gewoon + $limburg + $antwlimburg);



    $pdf->ezTable($tabel);

}


function toonActiviteitDebug($result, $info) {
   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $begindatum, $einddatum, $sep;
   $pdf->ezText("*******************************",11,$options2);
   $pdf->ezText("*          DEBUG INFO          *",11,$options2);
   $pdf->ezText("*******************************",11,$options2);
   $pdf->ezText($info,11,$options2);

   for ($di=0; $di < mysql_num_rows($result); $di++) {
     $rij = mysql_fetch_assoc($result);
     $pdf->ezText($rij['patient'],11,$options2);
   }
   $pdf->ezText("*******************************",11,$options2);
}

function toonActiviteit($tp) {
   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $begindatum, $einddatum, $sep;

   // eerst actieve patienten

   $query = "select patient_tp.patient

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '{$_GET['beginjaar']}-06-30'  and (patient_tp.einddatum >= '{$_GET['beginjaar']}-04-01' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by patient_tp.patient

   ";

   //die($query);
   $result =  mysql_query($query);
   $actief1 = mysql_num_rows($result);
   
   if ($_GET['debug']==1) toonActiviteitDebug($result, "eerste kwartaal");


   $query = "select patient_tp.patient

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '{$_GET['beginjaar']}-09-30'  and (patient_tp.einddatum >= '{$_GET['beginjaar']}-07-01' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by patient_tp.patient

   ";

   $result =  mysql_query($query);
   $actief2 = mysql_num_rows($result);

   if ($_GET['debug']==1) toonActiviteitDebug($result, "tweede kwartaal");

   $query = "select patient_tp.patient

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '{$_GET['beginjaar']}-12-31'  and (patient_tp.einddatum >= '{$_GET['beginjaar']}-10-01' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by patient_tp.patient

   ";

   //die($query);

   $result =  mysql_query($query);
   $actief3 = mysql_num_rows($result);

   if ($_GET['debug']==1) toonActiviteitDebug($result, "derde kwartaal");

   $query = "select patient_tp.patient

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '{$_GET['eindjaar']}-03-31'  and (patient_tp.einddatum >= '{$_GET['eindjaar']}-01-01' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by patient_tp.patient

   ";

   $result =  mysql_query($query);
   $actief4 = mysql_num_rows($result);

   if ($_GET['debug']==1) toonActiviteitDebug($result, "vierde kwartaal");

   $query = "select patient_tp.patient

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or (patient_tp.einddatum is NULL and patient_tp.actief = 1))

             group by patient_tp.patient

   ";

   $result =  mysql_query($query);
   $actiefTotaal = mysql_num_rows($result);

   if ($_GET['debug']==1) toonActiviteitDebug($result, "TOTAAL WERKJAAR");

   

   

   $pdf->ezText("\n\naantal patiënten dat daadwerkelijk ten laste is genomen op de afsluitingsdatum van het boekjaar en aantal patiënten dat per trimester ten laste is genomen\n\n",11,$options2);

   $pdf->ezText("<b>Aantal ten laste genomen patiënten</b>\n",11,$options2);

   $tabelActief[0]["Op de afsluitingsdatum\n van het boekjaar"] = $actiefTotaal;

   $tabelActief[0]["Tijdens het \neerste kwartaal"] = $actief1;

   $tabelActief[0]["Tijdens het \ntweede kwartaal"] = $actief2;

   $tabelActief[0]["Tijdens het \nderde kwartaal"] = $actief3;

   $tabelActief[0]["Tijdens het \nvierde kwartaal"] = $actief4;

   $pdf->ezTable($tabelActief);

   

   // dan gestarte patienten

   $query = "select patient_tp.id

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum >= '{$_GET['beginjaar']}-04-01'  and patient_tp.begindatum <= '{$_GET['beginjaar']}-06-30'

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";

   $gestart1 = mysql_num_rows(mysql_query($query));

   $query2 = "select patient_tp.id

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum >= '{$_GET['beginjaar']}-07-01'  and patient_tp.begindatum <= '{$_GET['beginjaar']}-09-30'

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";

   $gestart2 = mysql_num_rows(mysql_query($query2));

   $query = "select patient_tp.id

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum >= '{$_GET['beginjaar']}-10-01'  and patient_tp.begindatum <= '{$_GET['beginjaar']}-12-31'

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";

   $gestart3 = mysql_num_rows(mysql_query($query));

   $query = "select patient_tp.id

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum >= '{$_GET['eindjaar']}-01-01'  and patient_tp.begindatum <= '{$_GET['eindjaar']}-03-31'

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";

   $gestart4 = mysql_num_rows(mysql_query($query));

   // vervolgens stopgezette patienten

   $query = "select patient_tp.id

             from patient_tp

             where project = {$tp['id']}

               and actief = 0

               and patient_tp.einddatum >= '$beginDate'  and patient_tp.einddatum <= '$eindDate'

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";

   $gestopt = mysql_num_rows(mysql_query($query));



   

   $pdf->ezText("\n\naantal patiënten die in de loop van het boekjaar in of uit het project zijn gestapt en het aantal kwartalen dat de patiënten die uit het project zijn gestapt ten laste werden genomen\n\n",11,$options2);

   $tabelInUit[0]['Patiënten die in en uit het project zijn gestapt'] = "Patiënten die tijdens de periode <b>in</b> het project zijn gestapt";

   $tabelInUit[0]['Aantal patiënten'] =  $gestart1 + $gestart2 + $gestart3 + $gestart4;

   $tabelInUit[1]['Patiënten die in en uit het project zijn gestapt'] = "Patiënten die tijdens de periode <b>uit</b> het project zijn gestapt";

   $tabelInUit[1]['Aantal patiënten'] = $gestopt;

   $pdf->ezTable($tabelInUit);

   

   

}





function toonGestopten($tp) {

   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $begindatum, $einddatum, $sep;

   $queryStoppers = "select *

             from patient_tp

             where project = {$tp['id']}

               and actief = 0

               and patient_tp.einddatum >= '$beginDate'  and patient_tp.einddatum <= '$eindDate'

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";



   $termijn = Array();





   $termijn["Minder dan 3 maanden"] = 0;

   $termijn["3 maanden tot 6 maanden"] = 0;

   $termijn["6 maanden tot 9 maanden"] = 0;

   $termijn["9 maanden tot 1 jaar"] = 0;

   $termijn[">= 1 jaar tot 1,5 jaar"] = 0;

   $termijn[">= 1,5 jaar tot 2 jaar"] = 0;

   $termijn["Meer dan 2 jaar"] = 0;





   $stoppersResult = mysql_query($queryStoppers);

   for ($i=0;$i<mysql_num_rows($stoppersResult);$i++) {

     $stopper = mysql_fetch_assoc($stoppersResult);

     foreach ($stopper as $key => $value) {

       $stopper[$key] = utf8_decode($stopper[$key]);

     }

     $zpOutput .= "{$stopper['patient']}\n";

     $beginStopper = $stopper['begindatum'];

     $eindeStopper = $stopper['einddatum'];

     $aantalTrimesters = trimesterNummer($eindeStopper)-trimesterNummer($beginStopper)+1;

     if ($aantalTrimesters < 3) {

        $duurtijd = "Minder dan 3 maanden";

     }

     else if ($aantalTrimesters < 6) {

        $duurtijd = "3 maanden tot 6 maanden";

     }

     else if ($aantalTrimesters < 8) {

        $duurtijd = "6 maanden tot 9 maanden";

     }

     else if ($aantalTrimesters < 12) {

        $duurtijd = "9 maanden tot 1 jaar";

     }

     else if ($aantalTrimesters < 18) {

        $duurtijd = ">= 1 jaar tot 1,5 jaar";

     }

     else if ($aantalTrimesters < 24) {

        $duurtijd = ">= 1,5 jaar tot 2 jaar";

     }

     else

        $duurtijd = "Meer dan 2 jaar";



     $termijn[$duurtijd]++;

   }



   $i=0;

   foreach ($termijn as $duur => $aantal) {

     $tabel[$i]["Duur van de tenlasteneming van de patiënten\n die uit het project zijn gestapt"] = $duur;

     $tabel[$i]["Aantal patiënten"] = $aantal;

     $i++;

   }



   $pdf->ezText("\n\n");

   $pdf->ezTable($tabel);

}





function trimesterNummer($datum) {

  $jaar = substr($datum,0,4);

  $maand = substr($datum, 5,2);

  switch ($maand) {

     case 1:

     case 2:

     case 3:

       return $jaar*4+1;

     case 4:

     case 5:

     case 6:

       return $jaar*4+2;

     case 7:

     case 8:

     case 9:

       return $jaar*4+3;

     case 10:

     case 11:

     case 12:

       return $jaar*4+4;

     default:

       return -10000;

  }

}



function toonOverlegInfo($tp) {

   global $pdf, $mm, $options, $options2, $beginDate, $eindDate, $begindatum, $einddatum, $sep;



   // eerst actieve patienten

   $query = "select sum(genre = 'TP' and datum >= {$_GET['beginjaar']}0401 and datum < {$_GET['beginjaar']}0701) as aantal1,

                    sum(afgerond = 1 and keuze_vergoeding = 1 and genre = 'TP' and datum >= {$_GET['beginjaar']}0401 and datum < {$_GET['beginjaar']}0701) as geld1,

                    sum(genre = 'TP' and datum >= {$_GET['beginjaar']}0701 and datum < {$_GET['beginjaar']}1001) as aantal2,

                    sum(afgerond = 1 and keuze_vergoeding = 1 and genre = 'TP' and datum >= {$_GET['beginjaar']}0701 and datum < {$_GET['beginjaar']}1001) as geld2,

                    sum(genre = 'TP' and datum >= {$_GET['beginjaar']}1001 and datum < {$_GET['eindjaar']}0101) as aantal3,

                    sum(afgerond = 1 and keuze_vergoeding = 1 and genre = 'TP' and datum >= {$_GET['beginjaar']}1001 and datum < {$_GET['eindjaar']}0101) as geld3,

                    sum(genre = 'TP' and datum >= {$_GET['eindjaar']}0101 and datum < {$_GET['eindjaar']}0401) as aantal4,

                    sum(afgerond = 1 and keuze_vergoeding = 1 and genre = 'TP' and datum >= {$_GET['eindjaar']}0101 and datum < {$_GET['eindjaar']}0401) as geld4

             from patient_tp, overleg

             where project = {$tp['id']}

               and patient_tp.patient = overleg.patient_code

               and overleg.genre = 'TP'

   ";

   $record = mysql_fetch_assoc(mysql_query($query));

   

   

   $pdf->ezText("\n\naantal georganiseerde overlegvergaderingen en aantal gefactureerde overlegvergaderingen per kwartaal\n\n",11,$options2);

   $pdf->ezText("\n\n<b>Aantal georganiseerde overlegvergaderingen</b>\n\n",11,$options2);

   $tabelOverleg[0]["Tijdens het \neerste kwartaal"] = $record['aantal1'];

   $tabelOverleg[0]["Tijdens het \ntweede kwartaal"] = $record['aantal2'];

   $tabelOverleg[0]["Tijdens het \nderde kwartaal"] = $record['aantal3'];

   $tabelOverleg[0]["Tijdens het \nvierde kwartaal"] = $record['aantal4'];

   $pdf->ezTable($tabelOverleg);



   $pdf->ezText("\n\n<b>Aantal gefactureerde overlegvergaderingen</b>\n\n",11,$options2);

   $tabelFactuur[0]["Tijdens het \neerste kwartaal"] = $record['geld1'];

   $tabelFactuur[0]["Tijdens het \ntweede kwartaal"] = $record['geld2'];

   $tabelFactuur[0]["Tijdens het \nderde kwartaal"] = $record['geld3'];

   $tabelFactuur[0]["Tijdens het \nvierde kwartaal"] = $record['geld4'];

   $pdf->ezTable($tabelFactuur);



}



function toonX($tp) {

   global $pdf, $beginDate, $eindDate, $begindatum, $einddatum;

   $query = "";

   $pdf .= "\n\n\n********  *********\n\n";

   $query = "select

             from patient_tp

             where project = {$tp['id']}

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or patient_tp.einddatum is NULL)

               and not (patient_tp.einddatum is NULL and patient_tp.actief = 0)

   ";

   toonQueryResult($query);

}



function toonQueryResult($query) {

  global $pdf, $sep;

  $result=mysql_query($query) or die(mysql_error() . "<br /> $query");



  $aantalKolommen = mysql_num_fields($result);

  for ($i = 0; $i < $aantalKolommen; $i++) {

    $field = mysql_fetch_field($result);

    $kolom[$i] = utf8_decode($field->name);

    $pdf .= '"'. $kolom[$i] . "\"$sep";

  }

  $pdf .= "\n";





  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_array($result);

    for ($j = 0; $j < $aantalKolommen; $j++) {

      $pdf .= '"' . utf8_decode($rij[$kolom[$j]]) . "\"$sep";

    }

    $pdf .="\n";

  }

}





if ($_SESSION['profiel']=="OC") {

  die("Gij hebt hier niks te zoeken manneke");

}

else if ($_SESSION['profiel']=="listel") {

  $qryTP = "select tp.* from tp_project tp, patient_tp

             where tp.id = patient_tp.project

               and patient_tp.begindatum <= '$eindDate'  and (patient_tp.einddatum >= '$beginDate' or patient_tp.einddatum is NULL)

             group by tp.id";

  $resultTP = mysql_query($qryTP);

  for ($i=0;$i<mysql_num_rows($resultTP);$i++) {

    $tpDossier = mysql_fetch_assoc($resultTP);

     foreach ($tpDossier as $key => $value) {

       $tpDossier[$key] = utf8_decode($tpDossier[$key]);

     }

    toonTP($tpDossier);

  }

}

else {

  toonTP(tp_record($_SESSION['tp_project']));

}





$pdf->ezStream();

require("../includes/dbclose.inc");



      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>