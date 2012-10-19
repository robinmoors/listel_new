<?php

ob_start();

session_start();



function bool_123($waarde) {

  if ($waarde==1) return 1;

  if ($waarde==-1) return 2;

  if ($waarde==0) return 3;

}



if ($_POST['sep']==",")

  $sep = ",";

else

  $sep = ";";





   require("../includes/clearSessie.inc");

   require("../includes/dbconnect2.inc");

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {



$bestandsnaam = "stats_omb";







$begindatum = "{$_POST['beginjaar']}{$_POST['beginmaand']}{$_POST['begindag']}";

$einddatum = "{$_POST['eindjaar']}{$_POST['eindmaand']}{$_POST['einddag']}";



$begin = "{$_POST['begindag']}/{$_POST['beginmaand']}/{$_POST['beginjaar']}";

$eind = "{$_POST['einddag']}/{$_POST['eindmaand']}/{$_POST['eindjaar']}";





$csvOutput = "Overzicht van de OMB-registraties : $begin tot $eind\nVergeet de replace van !!! door punt-komma niet!!!!!!\n";



$query= "select omb_registratie.*, profiel from omb_registratie, logins

         where auteur = logins.id

           and jaar*10000+maand*100+dag >= $begindatum

           and jaar*10000+maand*100+dag <= $einddatum

           and afgerond >= 1";

           

$result=mysql_query($query) or die(mysql_error() . "<br /> $query");





$csvOutput .= "\n\nnummer $sep registratienummer $sep startnummer $sep provincie $sep postcode $sep datum $sep wijze $sep bekendheid meldpunt $sep bekendheid meldpunt doorverwijzing intern $sep bekendheid meldpunt doorverwijzing extern $sep bekendheid meldpunt doorverwijzing IE $sep melding vraag $sep melder naam $sep melder adres $sep melder postcode $sep melder gemeente $sep melder tel $sep melder email $sep melder relatie tot slachtoffer: hoofdrelatie $sep melder relatie tot slachtoffer: wie exact $sep slachtoffer naam $sep slachtoffer geslacht $sep slachtoffer leeftijd $sep slachtoffer adres $sep slachtoffer postcode $sep slachtoffer gemeente $sep slachtoffer tel nr $sep slachtoffer email $sep slachtoffer op hoogte melding $sep slachtoffer probleemfactoren: 1 $sep slachtoffer probleemfactoren: 1 detail $sep slachtoffer probleemfactoren: 2 $sep slachtoffer probleemfactoren: 2 detail $sep slachtoffer probleemfactoren: 3 $sep slachtoffer probleemfactoren: 3 detail $sep slachtoffer probleemfactoren: 4 $sep slachtoffer probleemfactoren: 4 detail $sep slachtoffer beleving ouderenmis(be)handeling $sep slachtoffer woonsituatie samen $sep slachtoffer woonsituatie samen ja met wie $sep slachtoffer woonsituatie samen andere woonvorm $sep slachtoffer woonsituatie samen andere woonvorm invulvak $sep slachtoffers meerdere $sep slachtoffers meerdere: wie $sep pleger naam $sep pleger geslacht $sep pleger leeftijd $sep pleger adres $sep pleger postcode $sep pleger gemeente $sep pleger tel nr $sep pleger op hoogte van melding $sep pleger probleemfactoren: 1 $sep pleger probleemfactoren: 1 detail $sep pleger probleemfactoren: 2 $sep pleger probleemfactoren: 2 detail $sep pleger probleemfactoren: 3 $sep pleger probleemfactoren: 3 detail $sep pleger probleemfactoren: 4 $sep pleger probleemfactoren: 4 detail $sep pleger relatie tot slachtoff: hoofdrelatie $sep pleger relatie tot slachtoff: wie exact $sep plegers meerdere $sep plegers meerdere wie $sep aangemelde vorm: 1 $sep aangemelde vorm: 2 $sep aangemelde vorm: 3 $sep aangemelde vorm: 4 $sep aangemelde vorm: 5 $sep aangemelde vorm: 6 $sep aangemelde vorm: 7 $sep aangemeld multiple problem $sep hulp aanwezig $sep hulp aanwezig 1: $sep hulp aanwezig 1: detail hulp $sep aanwezig 2: $sep hulp aanwezig 2: detail $sep hulp aanwezig 3: $sep hulp aanwezig 3: detail $sep hulp aanwezig 4: $sep hulp aanwezig 4: detail $sep hulp aanwezig 5: $sep hulp aanwezig 5: detail $sep hulp aanwezig 6: $sep hulp aanwezig 6: detail $sep justitie op hoogte $sep justitie op hoogte ja keuzelijst $sep justitie op hoogte ja wie $sep mantelzorgers aanwezig $sep mantelzorgers aanwezig ja wie $sep andere contactpersonen aanwezig $sep andere contactpersonen aanwezig ja wie $sep opvolgingsmomenten steunpunt $sep afsluiting dossier datum $sep afsluiting dossier stand van zaken $sep afsluiting dossier doorverwijzing $sep afsluiting dossier doorverwijzing invulvak $sep uiteindelijke vorm: 1 $sep uiteindelijke vorm: 2 $sep uiteindelijke vorm: 3 $sep uiteindelijke vorm: 4 $sep uiteindelijke vorm: 5 $sep uiteindelijke vorm: 6 $sep uiteindelijke vorm: 7 $sep uiteindelijke vorm multiple problem $sep situatieschets $sep vorige registratie $sep profiel\n";



$aantalRecords = mysql_num_rows($result);

for ($iii=0; $iii < $aantalRecords ; $iii++) {

  $rij = mysql_fetch_assoc($result);

  foreach ($rij as $key => $value) {

    $rij[$key] = utf8_decode($rij[$key]);

  }



  $registratieID = $rij['id'];



  $csvOutput .= '"' . $rij['id'] . "\"$sep";

  $csvOutput .= '"' . $rij['jaar'] . "/" . vul0Aan($rij['maand'],2) . "/" . vul0Aan($rij['dag'],2) . "/Li-" . vul0Aan($rij['dagnummer'],3) . "\"$sep";

  $csvOutput .= '"' . $rij['omb_bron'] . "\"$sep";

  $csvOutput .= '"' . "Limburg" . "\"$sep";



  $plegerGemeente = getGemeenteInfo($rij['slachtoffer_gemeente']);

  $csvOutput .= '"' . $plegerGemeente['dlzip'] . "\"$sep";

  $csvOutput .= '"' . vul0Aan($rij['dag'],2) . "/" . vul0Aan($rij['maand'],2) . "/" . $rij['jaar'] . "\"$sep";



  $contactWijze = getFirstRecord("select * from omb_contactwijze where id = 0{$rij['contactwijze']}");

  $csvOutput .= '"' . $contactWijze['contactwijze'] . "\"$sep";



  $bekendheid = getFirstRecord("select * from omb_bekendheid where id = 0{$rij['bekendheid']}");

  if ($rij['bekendheid']==1 || $rij['bekendheid']==2) {

    $csvOutput .= '"' . "doorverwijzing" . "\"$sep";

  }

  else {

    $csvOutput .= '"' . $bekendheid['bekendheid'] . "\"$sep";

  }



  $csvOutput .= '"' . $rij['doorverwijzing_intern'] . "\"$sep";

  $csvOutput .= '"' . $rij['doorverwijzing_extern'] . "\"$sep";

  $csvOutput .= '"' . "" . "\"$sep"; // IE is niet verduidelijkt



  $meldingVraag = getFirstRecord("select * from omb_vraag where id = 0{$rij['genre_melding']}");

  $csvOutput .= '"' . $meldingVraag['vraag'] . "\"$sep";



  // melder-gegevens

  if ($rij['melder_soort']=="ander") {

    $melderGemeente = getGemeenteInfo($rij['melder_gemeente']);

    $csvOutput .= '"' . $rij['melder_naam'] . "\"$sep";

    $csvOutput .= '"' . $rij['melder_adres'] . "\"$sep";

    $csvOutput .= '"' . $melderGemeente['dlzip'] . "\"$sep";

    $csvOutput .= '"' . $melderGemeente['dlnaam'] . "\"$sep";

    $csvOutput .= '"' . $rij['melder_telefoon'] . "\"$sep";

    $csvOutput .= '"' . $rij['melder_email'] . "\"$sep";

    $melderRelatie = getFirstRecord("select * from omb_hoofdrelatie where id = 0{$rij['melder_relatie']}");

    $csvOutput .= '"' . $melderRelatie['hoofdrelatie'] . "\"$sep";

    $csvOutput .= '"' . $rij['melder_relatie_detail'] . "\"$sep";

  }

  else if ($rij['melder_soort']=="slachtoffer") {

    $melderGemeente = getGemeenteInfo($rij['slachtoffer_gemeente']);

    $csvOutput .= '"' . $rij['slachtoffer_naam'] . "\"$sep";

    $csvOutput .= '"' . $rij['slachtoffer_adres'] . "\"$sep";

    $csvOutput .= '"' . $melderGemeente['dlzip'] . "\"$sep";

    $csvOutput .= '"' . $melderGemeente['dlnaam'] . "\"$sep";

    $csvOutput .= '"' . $rij['slachtoffer_telefoon'] . "\"$sep";

    $csvOutput .= '"' . $rij['slachtoffer_email'] . "\"$sep";

    $csvOutput .= '"' . "slachtoffer" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }

  else {

    $hvlInfo = getFirstRecord("select hvl.*, dlzip, dlnaam, f.naam as fnct_naam from hulpverleners hvl, gemeente, functies f where hvl.id = 0{$rij['melderhvl_id']} and hvl.gem_id = gemeente.id and hvl.fnct_id = f.id");

    $csvOutput .= '"' . $hvlInfo['naam'] . " " . $hvlInfo['naam'] . "\"$sep";

    $csvOutput .= '"' . $hvlInfo['adres'] . "\"$sep";

    $csvOutput .= '"' . $hvlInfo['dlzip'] . "\"$sep";

    $csvOutput .= '"' . $hvlInfo['dlnaam'] . "\"$sep";

    $csvOutput .= '"' . $hvlInfo['telefoon'] . "\"$sep";

    $csvOutput .= '"' . $hvlInfo['email'] . "\"$sep";

    $csvOutput .= '"' . "hulpverlener" . "\"$sep";

    $csvOutput .= '"' . $hvlInfo['fnct_naam'] . "\"$sep";

  }



  // slachtoffer

  $melderGemeente = getGemeenteInfo($rij['slachtoffer_gemeente']);

  $csvOutput .= '"' . $rij['slachtoffer_naam'] . "\"$sep";

  if ($rij['slachtoffer_geslacht'] =="M")

    $csvOutput .= '"' . 1 . "\"$sep";

  else if ($rij['slachtoffer_geslacht'] =="V")

    $csvOutput .= '"' . 2 . "\"$sep";

  else

    $csvOutput .= '"' . 3 . "\"$sep";



  $csvOutput .= '"' . $rij['slachtoffer_leeftijd'] . "\"$sep";

  $csvOutput .= '"' . $rij['slachtoffer_adres'] . "\"$sep";

  $csvOutput .= '"' . $melderGemeente['dlzip'] . "\"$sep";

  $csvOutput .= '"' . $melderGemeente['dlnaam'] . "\"$sep";

  $csvOutput .= '"' . $rij['slachtoffer_telefoon'] . "\"$sep";

  $csvOutput .= '"' . $rij['slachtoffer_email'] . "\"$sep";

  $csvOutput .= '"' . bool_123($rij['slachtoffer_weetmelding']) . "\"$sep";



  // probleemfactoren slachtoffer

  $qryFactor = "select P.probleemfactor, detail from omb_aanwezigeprobleemfactor, omb_probleemfactor P

                     where registratie_id = $registratieID

                       and wie = 'slachtoffer'

                       and omb_aanwezigeprobleemfactor.probleemfactor = P.id";



  $resultFactor = mysql_query($qryFactor) or die($qryFactor);

  $i=0;

  if (mysql_num_rows($resultFactor)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  min(4,mysql_num_rows($resultFactor));  $i++) {

      $rijFactor = mysql_fetch_assoc($resultFactor);

      foreach ($rijFactor as $key => $value) {

        $rijFactor[$key] = utf8_decode($rijFactor[$key]);

      }

      $csvOutput .= '"' . $rijFactor['probleemfactor'] . "\"$sep";

      $csvOutput .= '"' . $rijFactor['detail'] . "\"$sep";

    }

  }

  // en nu een paar lege vakjes

  for (;$i<4;$i++) {

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }

  

  $csvOutput .= '"' . bool_123($rij['slachtoffer_ervaartmishandeling']) . "\"$sep";



  // oppassen met "andere woonvorm" en "andere woonvorm detail"

  if ($rij['samenwonen'] == 2) {

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . $rij['samenwonen'] . "\"$sep";

    $csvOutput .= '"' . $rij['samenwonen_detail'] . "\"$sep";

  }

  else if ($rij['samenwonen'] == 1) {

    $csvOutput .= '"' . 1 . "\"$sep";

    $csvOutput .= '"' . $rij['samenwonen_detail'] . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }

  else if ($rij['samenwonen'] == -1) {

    $csvOutput .= '"' . 2 . "\"$sep";

    $csvOutput .= '"' . $rij['samenwonen_detail'] . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }

  else {

    $csvOutput .= '"' . 3 . "\"$sep";

    $csvOutput .= '"' . $rij['samenwonen_detail'] . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }



  $csvOutput .= '"' . bool_123($rij['slachtoffer_meer']) . "\"$sep";

  $csvOutput .= '"' . $rij['slachtoffer_meer_detail'] . "\"$sep";



  // pleger

  $plegerGemeente = getGemeenteInfo($rij['pleger_gemeente']);

  $csvOutput .= '"' . $rij['pleger_naam'] . "\"$sep";

  if ($rij['pleger_geslacht'] =="M")

    $csvOutput .= '"' . 1 . "\"$sep";

  else if ($rij['pleger_geslacht'] =="V")

    $csvOutput .= '"' . 2 . "\"$sep";

  else

    $csvOutput .= '"' . 3 . "\"$sep";

  $csvOutput .= '"' . $rij['pleger_leeftijd'] . "\"$sep";

  $csvOutput .= '"' . $rij['pleger_adres'] . "\"$sep";

  $csvOutput .= '"' . $melderGemeente['dlzip'] . "\"$sep";

  $csvOutput .= '"' . $melderGemeente['dlnaam'] . "\"$sep";

  $csvOutput .= '"' . $rij['pleger_telefoon'] . "\"$sep";

  $csvOutput .= '"' . bool_123($rij['pleger_opdehoogte']) . "\"$sep";



  // probleemfactoren pleger

  $qryFactor = "select P.probleemfactor, detail from omb_aanwezigeprobleemfactor, omb_probleemfactor P

                     where registratie_id = $registratieID

                       and wie = 'pleger'

                       and omb_aanwezigeprobleemfactor.probleemfactor = P.id";

  $resultFactor = mysql_query($qryFactor) or die($qryFactor);

  $i=0;

  if (mysql_num_rows($resultFactor)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  min(4,mysql_num_rows($resultFactor));  $i++) {

      $rijFactor = mysql_fetch_assoc($resultFactor);

      foreach ($rijFactor as $key => $value) {

        $rijFactor[$key] = utf8_decode($rijFactor[$key]);

      }

      $csvOutput .= '"' . $rijFactor['probleemfactor'] . "\"$sep";

      $csvOutput .= '"' . $rijFactor['detail'] . "\"$sep";

    }

  }

  // en nu een paar lege vakjes

  for (;$i<4;$i++) {

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }



  $plegerRelatie = getFirstRecord("select * from omb_hoofdrelatie where id = 0{$rij['pleger_relatie']}");

  $csvOutput .= '"' . $plegerRelatie['hoofdrelatie'] . "\"$sep";

  $csvOutput .= '"' . $rij['pleger_relatie_detail'] . "\"$sep";





  if ($rij['plegers_aantal'] == 'meer') {

    $csvOutput .= '"' . 3 . "\"$sep";

  }

  else {

    $csvOutput .= '"' . $rij['plegers_aantal'] . "\"$sep";

  }

  $csvOutput .= '"' . $rij['plegers_extra'] . "\"$sep";



  // aangemelde vorm

  $qryVorm = "select omb_mishandeling.mishandeling from omb_mishandelvorm, omb_mishandeling

                     where registratie_id = $registratieID

                       and genre = 'aanmelding'

                       and omb_mishandelvorm.mishandeling = omb_mishandeling.id";

  $resultVorm = mysql_query($qryVorm) or die($qryVorm);

  $i=0;

  if (mysql_num_rows($resultVorm)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  min(7,mysql_num_rows($resultVorm));  $i++) {

      $rijVorm = mysql_fetch_assoc($resultVorm);

      foreach ($rijVorm as $key => $value) {

        $rijVorm[$key] = utf8_decode($rijVorm[$key]);

      }

      $csvOutput .= '"' . $rijVorm['mishandeling'] . "\"$sep";

    }

  }

  // en nu een paar lege vakjes

  for (;$i<7;$i++) {

    $csvOutput .= '"' . "" . "\"$sep";

  }

  if (mysql_num_rows($resultVorm)>2) {

    $csvOutput .= '"' . "WAAR" . "\"$sep";

  }

  else {

    $csvOutput .= '"' . "ONWAAR" . "\"$sep";

  }



  // hulp aanwezig

  $qryHulp = "select omb_hulpvorm.hulpvorm, detail from omb_hulpvorm, omb_hulp

                     where registratie_id = $registratieID

                       and genre = omb_hulpvorm.id";

  $resultHulp = mysql_query($qryHulp) or die($qryHulp);

  $i=0;

  if (mysql_num_rows($resultHulp)>0) {

    $csvOutput .= '"' . 1 . "\"$sep";

    for ($i=0;$i <  mysql_num_rows($resultHulp);  $i++) {

      $rijHulp = mysql_fetch_assoc($resultHulp);

      foreach ($rijHulp as $key => $value) {

        $rijHulp[$key] = utf8_decode($rijHulp[$key]);

      }

      $csvOutput .= '"' . $rijHulp['hulpvorm'] . "\"$sep";

      $csvOutput .= '"' . $rijHulp['detail'] . "\"$sep";

    }

  }

  else {

    $csvOutput .= '"' . 2 . "\"$sep";

  }

  // en nu een paar lege vakjes

  for (;$i<6;$i++) {

    $csvOutput .= '"' . "" . "\"$sep";

    $csvOutput .= '"' . "" . "\"$sep";

  }

  

  // justitie

  $csvOutput .= '"' . bool_123($rij['justitie_weetmelding']) . "\"$sep";

  $justitiesoort = getFirstRecord("select justitie from omb_justitie where id = 0{$rij['justitie_soort']}");

  $csvOutput .= '"' . $justitiesoort['justitie'] . "\"$sep";

  $csvOutput .= '"' . $rij['justitie_detail'] . "\"$sep";



  // mantelzorgers

  $csvOutput .= '"' . bool_123($rij['mantelzorgers_aanwezig']) . "\"$sep";

  $csvOutput .= '"' . $rij['mantelzorgers_detail'] . "\"$sep";

  // contactpersonen

  $csvOutput .= '"' . bool_123($rij['contactpersonen_aanwezig']) . "\"$sep";

  $csvOutput .= '"' . $rij['contactpersonen_detail'] . "\"$sep";



  // opvolging en afsluiting

  $csvOutput .= '"' . bool_123($rij['opvolging_steunpunt']) . "\"$sep";



  if ($rij['afsluiten_dag'] > 0)

    $csvOutput .= '"' . $rij['afsluiten_dag'] . "/" . $rij['afsluiten_maand'] . "/" . $rij['afsluiten_jaar'] . "\"$sep";

  else

    $csvOutput .= '"' . "" . "\"$sep";





  $stand = getFirstRecord("select standvanzaken from omb_standvanzaken where id = 0{$rij['standvanzaken']}");

  $csvOutput .= '"' . $stand['standvanzaken'] . "\"$sep";



  if ($rij['standvanzaken']==5)

    $csvOutput .= '"' . "WAAR" . "\"$sep";

  else

    $csvOutput .= '"' . "ONWAAR" . "\"$sep";



  $csvOutput .= '"' . "" . "\"$sep";



  // aangemelde vorm

  $qryVorm = "select omb_mishandeling.mishandeling from omb_mishandelvorm, omb_mishandeling

                     where registratie_id = $registratieID

                       and genre = 'opvolging'

                       and omb_mishandelvorm.mishandeling = omb_mishandeling.id";

  $resultVorm = mysql_query($qryVorm) or die($qryVorm);

  $i=0;

  if (mysql_num_rows($resultVorm)>0) {

    //print("alert(" . mysql_num_rows($resultSlachtoffer) . ");");

    for ($i=0;$i <  min(7,mysql_num_rows($resultVorm));  $i++) {

      $rijVorm = mysql_fetch_assoc($resultVorm);

      foreach ($rijVorm as $key => $value) {

        $rijVorm[$key] = utf8_decode($rijVorm[$key]);

      }

      $csvOutput .= '"' . $rijVorm['mishandeling'] . "\"$sep";

    }

  }

  // en nu een paar lege vakjes

  for (;$i<7;$i++) {

    $csvOutput .= '"' . "" . "\"$sep";

  }

  if (mysql_num_rows($resultVorm)>2) {

    $csvOutput .= '"' . "WAAR" . "\"$sep";

  }

  else {

    $csvOutput .= '"' . "ONWAAR" . "\"$sep";

  }



  // extra: situatieschets

  $csvOutput .= '"' . $rij['situatieschets'] . "\"$sep";

  $csvOutput .= '"' . $rij['vorige'] . "\"$sep";



  $csvOutput .= '"' . $rij['profiel'] . "\"$sep";



  $csvOutput .="\n";

}



$csvOutput .="\n";

$csvOutput .="\n";

$csvOutput .="\n";

$csvOutput .="\n";





//*******************  verzamelstatistieken ************************



// startnummer $sep provincie $sep postcode $sep datum $sep wijze $sep bekendheid meldpunt $sep bekendheid meldpunt doorverwijzing intern $sep bekendheid meldpunt doorverwijzing extern $sep bekendheid meldpunt doorverwijzing IE $sep melding vraag $sep melder naam $sep melder adres $sep melder postcode $sep melder gemeente $sep melder tel $sep melder email $sep melder relatie tot slachtoffer: hoofdrelatie $sep melder relatie tot slachtoffer: wie exact $sep slachtoffer naam $sep slachtoffer geslacht $sep slachtoffer leeftijd $sep slachtoffer adres $sep slachtoffer postcode $sep slachtoffer gemeente $sep slachtoffer tel nr $sep slachtoffer email $sep slachtoffer op hoogte melding $sep slachtoffer probleemfactoren: 1 $sep slachtoffer probleemfactoren: 1 detail $sep slachtoffer probleemfactoren: 2 $sep slachtoffer probleemfactoren: 2 detail $sep slachtoffer probleemfactoren: 3 $sep slachtoffer probleemfactoren: 3 detail $sep slachtoffer probleemfactoren: 4 $sep slachtoffer probleemfactoren: 4 detail $sep slachtoffer beleving ouderenmis(be)handeling $sep slachtoffer woonsituatie samen $sep slachtoffer woonsituatie samen ja met wie $sep slachtoffer woonsituatie samen andere woonvorm $sep slachtoffer woonsituatie samen andere woonvorm invulvak $sep slachtoffers meerdere $sep slachtoffers meerdere: wie $sep pleger naam $sep pleger geslacht $sep pleger leeftijd $sep pleger adres $sep pleger postcode $sep pleger gemeente $sep pleger tel nr $sep pleger op hoogte van melding $sep pleger probleemfactoren: 1 $sep pleger probleemfactoren: 1 detail $sep pleger probleemfactoren: 2 $sep pleger probleemfactoren: 2 detail $sep pleger probleemfactoren: 3 $sep pleger probleemfactoren: 3 detail $sep pleger probleemfactoren: 4 $sep pleger probleemfactoren: 4 detail $sep pleger relatie tot slachtoff: hoofdrelatie $sep pleger relatie tot slachtoff: wie exact $sep plegers meerdere $sep plegers meerdere wie $sep aangemelde vorm: 1 $sep aangemelde vorm: 2 $sep aangemelde vorm: 3 $sep aangemelde vorm: 4 $sep aangemelde vorm: 5 $sep aangemelde vorm: 6 $sep aangemelde vorm: 7 $sep aangemeld multiple problem $sep hulp aanwezig $sep hulp aanwezig 1: $sep hulp aanwezig 1: detail hulp $sep aanwezig 2: $sep hulp aanwezig 2: detail $sep hulp aanwezig 3: $sep hulp aanwezig 3: detail $sep hulp aanwezig 4: $sep hulp aanwezig 4: detail $sep hulp aanwezig 5: $sep hulp aanwezig 5: detail $sep hulp aanwezig 6: $sep hulp aanwezig 6: detail $sep justitie op hoogte $sep justitie op hoogte ja keuzelijst $sep justitie op hoogte ja wie $sep mantelzorgers aanwezig $sep mantelzorgers aanwezig ja wie $sep andere contactpersonen aanwezig $sep andere contactpersonen aanwezig ja wie $sep opvolgingsmomenten steunpunt $sep afsluiting dossier datum $sep afsluiting dossier stand van zaken $sep afsluiting dossier doorverwijzing $sep afsluiting dossier doorverwijzing invulvak $sep uiteindelijke vorm: 1 $sep uiteindelijke vorm: 2 $sep uiteindelijke vorm: 3 $sep uiteindelijke vorm: 4 $sep uiteindelijke vorm: 5 $sep uiteindelijke vorm: 6 $sep uiteindelijke vorm: 7 $sep uiteindelijke vorm multiple problem $sep\n";



$eindRecord = $aantalRecords + 8;

// aantal opvolgingen

$csvOutput .= "Aantal opvolgingen: $sep=$aantalRecords-aantal.lege.cellen(C9:C$eindRecord)$sep\n";



// soorten contactname

$csvOutput .= "\nSoorten contactname\n";

  $contactQry = "select * from omb_contactwijze order by id";

  $resultContact = mysql_query($contactQry);

  for ($i=0; $i < mysql_num_rows($resultContact); $i++) {

    $contactRij = mysql_fetch_assoc($resultContact);

    foreach ($contactRij as $key => $value) {

      $contactRij[$key] = utf8_decode($contactRij[$key]);

    }

    $csvOutput .= "{$contactRij['contactwijze']}$sep=aantal.als(G9:G$eindRecord!!!\"{$contactRij['contactwijze']}\")$sep\n";

  }





$csvOutput .= "\nBekendheid meldpunt\n";

  $bekendheidQry = "select * from omb_bekendheid order by id";

  $resultbekendheid = mysql_query($bekendheidQry);

  for ($i=0; $i < mysql_num_rows($resultbekendheid); $i++) {

    $bekendheidRij = mysql_fetch_assoc($resultbekendheid);

    foreach ($bekendheidRij as $key => $value) {

      $bekendheidRij[$key] = utf8_decode($bekendheidRij[$key]);

    }

    $csvOutput .= "{$bekendheidRij['bekendheid']}$sep=aantal.als(H9:H$eindRecord!!!\"{$bekendheidRij['bekendheid']}\")$sep\n";

  }





$csvOutput .= "\nDoorverwijzing intern\n";

    $csvOutput .= "huisarts$sep=aantal.als(I9:I$eindRecord!!!\"huisarts\")$sep\n";

    $csvOutput .= "thuisverpleging$sep=aantal.als(I9:I$eindRecord!!!\"thuisverpleging\")$sep\n";

    $csvOutput .= "dienst voor gezinszorg$sep=aantal.als(I9:I$eindRecord!!!\"dienst voor gezinszorg\")$sep\n";

    $csvOutput .= "dienst voor oppashulp$sep=aantal.als(I9:I$eindRecord!!!\"dienst voor oppashulp\")$sep\n";

    $csvOutput .= "POP/SEL$sep=aantal.als(I9:I$eindRecord!!!\"POP/SEL\")$sep\n";

    $csvOutput .= "OCMW$sep=aantal.als(I9:I$eindRecord!!!\"OCMW\")$sep\n";

    $csvOutput .= "paramedische hulp$sep=aantal.als(I9:I$eindRecord!!!\"paramedische hulp\")$sep\n";

    $csvOutput .= "ziekenfonds$sep=aantal.als(I9:I$eindRecord!!!\"ziekenfonds\")$sep\n";

    $csvOutput .= "CAW - slachtofferhulp$sep=aantal.als(I9:I$eindRecord!!!\"CAW - slachtofferhulp\")$sep\n";

    $csvOutput .= "CGG$sep=aantal.als(I9:I$eindRecord!!!\"CGG\")$sep\n";

    $csvOutput .= "expertisecentrum dementie$sep=aantal.als(I9:I$eindRecord!!!\"expertisecentrum dementie\")$sep\n";

    $csvOutput .= "dienstencentrum$sep=aantal.als(I9:I$eindRecord!!!\"dienstencentrum\")$sep\n";

    $csvOutput .= "dienst voor kortverblijf$sep=aantal.als(I9:I$eindRecord!!!\"dienst voor kortverblijf\")$sep\n";

    $csvOutput .= "dagverzorgingscentrum$sep=aantal.als(I9:I$eindRecord!!!\"dagverzorgingscentrum\")$sep\n";

    $csvOutput .= "ziekenhuis$sep=aantal.als(I9:I$eindRecord!!!\"ziekenhuis\")$sep\n";

    $csvOutput .= "ROB$sep=aantal.als(I9:I$eindRecord!!!\"ROB\")$sep\n";

    $csvOutput .= "RVT$sep=aantal.als(I9:I$eindRecord!!!\"RVT\")$sep\n";

    $csvOutput .= "andere$sep=aantal.als(I9:I$eindRecord!!!\"andere\")$sep\n";



$csvOutput .= "\nDoorverwijzing extern\n";

    $csvOutput .= "Antwerpen$sep=aantal.als(J9:J$eindRecord!!!\"Antwerpen\")$sep\n";

    $csvOutput .= "Limburg$sep=aantal.als(J9:J$eindRecord!!!\"Limburg\")$sep\n";

    $csvOutput .= "Oost-Vlaanderen$sep=aantal.als(J9:J$eindRecord!!!\"Oost-Vlaanderen\")$sep\n";

    $csvOutput .= "Vlaams-Brabant$sep=aantal.als(J9:J$eindRecord!!!\"Vlaams-Brabant\")$sep\n";

    $csvOutput .= "West-Vlaanderen$sep=aantal.als(J9:J$eindRecord!!!\"West-Vlaanderen\")$sep\n";

    $csvOutput .= "Brussel$sep=aantal.als(J9:J$eindRecord!!!\"Brussel\")$sep\n";

    $csvOutput .= "Vlaams Meldpunt$sep=aantal.als(J9:J$eindRecord!!!\"Vlaams Meldpunt\")$sep\n";



$csvOutput .= "\nMelding vraag\n";

  $qry = "select * from omb_vraag order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['vraag']}$sep=aantal.als(L9:L$eindRecord!!!\"{$rij['vraag']}\")$sep\n";

  }



$csvOutput .= "\nMelder relatie tot slachtoffer: hoofdrelatie\n";

  $qry = "select * from omb_hoofdrelatie order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['hoofdrelatie']}$sep=aantal.als(S9:S$eindRecord!!!\"{$rij['hoofdrelatie']}\")$sep\n";

  }



$csvOutput .= "\nSlachtoffer geslacht\n";

    $csvOutput .= "M$sep=aantal.als(V9:V$eindRecord!!!1)$sep\n";

    $csvOutput .= "V$sep=aantal.als(V9:V$eindRecord!!!2)$sep\n";



$csvOutput .= "\nSlachtoffer leeftijd\n";

    $csvOutput .= "<55$sep=aantal.als(W9:W$eindRecord!!!\"<55\")$sep\n";

    $csvOutput .= "55-64$sep=aantal.als(W9:W$eindRecord!!!\"<65\")-aantal.als(W9:W$eindRecord!!!\"<55\")$sep\n";

    $csvOutput .= "65-74$sep=aantal.als(W9:W$eindRecord!!!\"<75\")-aantal.als(W9:W$eindRecord!!!\"<65\")$sep\n";

    $csvOutput .= "75-84$sep=aantal.als(W9:W$eindRecord!!!\"<85\")-aantal.als(W9:W$eindRecord!!!\"<75\")$sep\n";

    $csvOutput .= "85-94$sep=aantal.als(W9:W$eindRecord!!!\"<95\")-aantal.als(W9:W$eindRecord!!!\"<85\")$sep\n";

    $csvOutput .= ">=95$sep=aantal.als(W9:W$eindRecord!!!\">=95\")$sep\n";

    

$csvOutput .= "\nSlachtoffer op de hoogte van melding\n";

    $csvOutput .= "ja$sep=aantal.als(AC9:AC$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(AC9:AC$eindRecord!!!2)$sep\n";



$csvOutput .= "\nSlachtoffer probleemfactoren\n";

  $qry = "select * from omb_probleemfactor order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['probleemfactor']}$sep=aantal.als(AD9:AJ$eindRecord!!!\"{$rij['probleemfactor']}\")$sep\n";

  }



$csvOutput .= "\nSlachtoffer beleving ouderenmis(be)handeling\n";

    $csvOutput .= "ja$sep=aantal.als(AL9:AL$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(AL9:AL$eindRecord!!!2)$sep\n";



$csvOutput .= "\nSlachtoffer woonsituatie samen\n";

    $csvOutput .= "ja$sep=aantal.als(AM9:AM$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(AM9:AM$eindRecord!!!2)$sep\n";

    $csvOutput .= "andere vorm$sep=aantal(AO9:AO$eindRecord)$sep\n";



$csvOutput .= "\nSlachtoffers meerdere\n";

    $csvOutput .= "ja$sep=aantal.als(AQ9:AQ$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(AQ9:AQ$eindRecord!!!2)$sep\n";





$csvOutput .= "\nPleger geslacht\n";

    $csvOutput .= "M$sep=aantal.als(AT9:AT$eindRecord!!!1)$sep\n";

    $csvOutput .= "V$sep=aantal.als(AT9:AT$eindRecord!!!2)$sep\n";



$csvOutput .= "\nPleger leeftijd\n";

    $csvOutput .= "<55$sep=aantal.als(AU9:AU$eindRecord!!!\"<55\")$sep\n";

    $csvOutput .= "55-64$sep=aantal.als(AU9:AU$eindRecord!!!\"<65\")-aantal.als(AU9:AU$eindRecord!!!\"<55\")$sep\n";

    $csvOutput .= "65-74$sep=aantal.als(AU9:AU$eindRecord!!!\"<75\")-aantal.als(AU9:AU$eindRecord!!!\"<65\")$sep\n";

    $csvOutput .= "75-84$sep=aantal.als(AU9:AU$eindRecord!!!\"<85\")-aantal.als(AU9:AU$eindRecord!!!\"<75\")$sep\n";

    $csvOutput .= "85-94$sep=aantal.als(AU9:AU$eindRecord!!!\"<95\")-aantal.als(AU9:AU$eindRecord!!!\"<85\")$sep\n";

    $csvOutput .= ">=95$sep=aantal.als(AU9:AU$eindRecord!!!\">=95\")$sep\n";



$csvOutput .= "\nPleger op de hoogte van melding\n";

    $csvOutput .= "ja$sep=aantal.als(AZ9:AZ$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(AZ9:AZ$eindRecord!!!2)$sep\n";



$csvOutput .= "\nPleger probleemfactoren\n";

  $qry = "select * from omb_probleemfactor order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['probleemfactor']}$sep=aantal.als(BA9:BG$eindRecord!!!\"{$rij['probleemfactor']}\")$sep\n";

  }



$csvOutput .= "\nPleger relatie tot slachtoffer: hoofdrelatie\n";

  $qry = "select * from omb_hoofdrelatie order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['hoofdrelatie']}$sep=aantal.als(BI9:BI$eindRecord!!!\"{$rij['hoofdrelatie']}\")$sep\n";

  }

  

$csvOutput .= "\nPlegers meerdere\n";

    $csvOutput .= "1$sep=aantal.als(BK9:BK$eindRecord!!!1)$sep\n";

    $csvOutput .= "2$sep=aantal.als(BK9:BK$eindRecord!!!2)$sep\n";

    $csvOutput .= "meer$sep=aantal.als(BK9:BK$eindRecord!!!3)$sep\n";



$csvOutput .= "\nMishandeling: aangemelde vorm\n";

  $qry = "select * from omb_mishandeling order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['mishandeling']}$sep=aantal.als(BM9:BS$eindRecord!!!\"{$rij['mishandeling']}\")$sep\n";

  }



$csvOutput .= "\nMishandeling: multiple probleem\n";

    $csvOutput .= "WAAR$sep=aantal.als(BT9:BT$eindRecord!!!WAAR)$sep\n";

    $csvOutput .= "ONWAAR$sep=aantal.als(BT9:BT$eindRecord!!!ONWAAR)$sep\n";



$csvOutput .= "\nHulp aanwezig\n";

    $csvOutput .= "ja$sep=aantal.als(BU9:BU$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(BU9:BU$eindRecord!!!2)$sep\n";



$csvOutput .= "\nHulpvorm\n";

  $qry = "select * from omb_hulpvorm order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['hulpvorm']}$sep=aantal.als(BV9:CF$eindRecord!!!\"{$rij['hulpvorm']}\")$sep\n";

  }



$csvOutput .= "\nJustitie op de hoogte\n";

    $csvOutput .= "ja$sep=aantal.als(CH9:CH$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(CH9:CH$eindRecord!!!2)$sep\n";



$csvOutput .= "\nJustitie op hoogte ja keuzelijst\n";

  $qry = "select * from omb_justitie order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['justitie']}$sep=aantal.als(CI9:CI$eindRecord!!!\"{$rij['justitie']}\")$sep\n";

  }



$csvOutput .= "\nMantelzorg aanwezig\n";

    $csvOutput .= "ja$sep=aantal.als(CK9:CK$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(CK9:CK$eindRecord!!!2)$sep\n";



$csvOutput .= "\nAndere contactpersonen aanwezig\n";

    $csvOutput .= "ja$sep=aantal.als(CM9:CM$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(CM9:CM$eindRecord!!!2)$sep\n";



$csvOutput .= "\nOpvolgingsmomenten steunpunt\n";

    $csvOutput .= "ja$sep=aantal.als(CO9:CO$eindRecord!!!1)$sep\n";

    $csvOutput .= "nee$sep=aantal.als(CO9:CO$eindRecord!!!2)$sep\n";



$csvOutput .= "\nAfsluiting dossier stand van zaken\n";

  $qry = "select * from omb_standvanzaken order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['standvanzaken']}$sep=aantal.als(CQ9:CQ$eindRecord!!!\"{$rij['standvanzaken']}\")$sep\n";

  }

  

$csvOutput .= "\nAfsluiting dossier doorverwijzing\n";

    $csvOutput .= "WAAR$sep=aantal.als(CR9:CR$eindRecord!!!WAAR)$sep\n";

    $csvOutput .= "ONWAAR$sep=aantal.als(CR9:CR$eindRecord!!!ONWAAR)$sep\n";



$csvOutput .= "\nMishandeling: uiteindelijke vorm\n";

  $qry = "select * from omb_mishandeling order by id";

  $result = mysql_query($qry);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "{$rij['mishandeling']}$sep=aantal.als(CT9:CZ$eindRecord!!!\"{$rij['mishandeling']}\")$sep\n";

  }



$csvOutput .= "\nUiteindelijke vorm: multiple probleem\n";

    $csvOutput .= "WAAR$sep=aantal.als(DA9:DA$eindRecord!!!WAAR)$sep\n";

    $csvOutput .= "ONWAAR$sep=aantal.als(DA9:DA$eindRecord!!!ONWAAR)$sep\n";



$csvOutput .= "\nMishandeling: uiteindelijke vorm\n";



  $qry = "select omb_registratie.*, patient_code from overleg, omb_registratie where datum >= $begindatum and datum <= $einddatum and overleg.omb_id =  omb_registratie.id and omb_id is not null";

  $result = mysql_query($qry) or die($qry);

  $aantal = mysql_num_rows($result);



$csvOutput .= "\nAantal registraties gekoppeld aan een overleg\n$aantal\n\n";

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "$sep$sep{$rij['jaar']}/{$rij['maand']}/{$rij['dag']}/LI-{$rij['dagnummer']}$sep{$rij['patient_code']}\n";

  }



  $qry = "select code from patient where startdatum <= $einddatum and (einddatum is null or einddatum = 0 or einddatum >= $begindatum) and omb_actief = 1";

  $result = mysql_query($qry);

  $aantal = mysql_num_rows($result);



$csvOutput .= "\nAantal zorgplannen met actief omb_vermoeden\n$aantal\n\n";

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    foreach ($rij as $key => $value) {

      $rij[$key] = utf8_decode($rij[$key]);

    }

    $csvOutput .= "$sep$sep{$rij['code']}\n";

  }





header("Content-Type: text/csv");

header("Cache-Control: must-revalidate, post-check=0,pre-check=0");

header("Content-Transfer-Encoding: binary");

header("Content-Disposition: attachment; filename=\"{$bestandsnaam}.csv\"");

header("Content-length: " . strlen($csvOutput));

print($csvOutput);



      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>