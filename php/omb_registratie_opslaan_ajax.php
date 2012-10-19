<?php

session_start();   // $_SESSION['pat_code']





$paginanaam="NVT: omb opslaan met ajax";



if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {

  print("KO;Geen toegang");

}

else if (!(isset($_POST['dd'])) && !(isset($_POST['id'])) ) {

  print("KO;Geen gegevens");

}

else {

  //----------------------------------------------------------

  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

  //----------------------------------------------------------




  preset($_POST['dd']);
  preset($_POST['mm']);
  preset($_POST['jjjj']);


  if ($_POST['id']==-1) {

    // id bepalen

    $qryZoekGrootste = "select max(dagnummer) from omb_registratie where dag = {$_POST['dd']} and maand = {$_POST['mm']} and jaar = {$_POST['jjjj']}";

    $resultGrootste = mysql_query($qryZoekGrootste) or die("1verkeerde zoekGrootste-query");

    if (mysql_num_rows($resultGrootste)==0)

      $dagnummer = 1;

    else {

      $rijGrootste = mysql_fetch_array($resultGrootste);

      $dagnummer = $rijGrootste[0]+1;

    }



    preset($_SESSION['usersid']);

    $qryMaakBasisRegistratie = "insert into omb_registratie (auteur,dag,maand,jaar,dagnummer) values ({$_SESSION['usersid']},{$_POST['dd']},{$_POST['mm']},{$_POST['jjjj']},$dagnummer)";

    mysql_query($qryMaakBasisRegistratie) or die("2kan geen registratie maken");

    $ombid = mysql_insert_id();



    if ($dagnummer < 10) $dagcode = "00$dagnummer";

    else if ($dagnummer < 100) $dagcode = "0$dagnummer";

    else $dagcode = "$dagnummer";



    $omb_bron = "{$_POST['jjjj']}/{$_POST['mm']}/{$_POST['dd']}/LI-$dagcode";



    $succes = "OK$omb_bron$ombid";



    if ($_POST['patient']!="" && $_POST['omb_bron']=="") {

       mysql_query("update patient set omb_bron = \"$omb_bron\" where code = \"{$_POST['patient']}\"") or die("0probleem met update patient");

    }

    

  }

  else {

    $ombid = $_POST['id'];

    $succes = "++$ombid";

  }

//  print_r($_POST);



  if ($_POST['contactwijze']>-1) {

    $update .=  "  contactwijze = {$_POST['contactwijze']},";

  }

  else {

    $update .=  "  contactwijze = NULL,";

  }

  if ($_POST['genre']>-1) {

    $update .=  " genre_melding = {$_POST['genre']},";

  }

  else {

    $update .=  "  genre_melding = NULL,";

  }

  if ($_POST['bekendheid']>-1) {

    $update .=  " bekendheid = {$_POST['bekendheid']},";

  }

  else {

    $update .=  "  bekendheid = NULL,";

  }

  if ($_POST['bekendheid']==1 || $_POST['bekendheid']==2) {

     $update .=  " doorverwijzing_intern = \"{$_POST['doorverwijzing_intern']}\",";

     $update .=  " doorverwijzing_extern = \"{$_POST['doorverwijzing_extern']}\",";

  }

  else {

     $update .=  " doorverwijzing_intern = \"\",";

     $update .=  " doorverwijzing_extern = \"\",";

  }



  if ($_POST['meldersoort']!="") {

    $update .=  " melder_soort = \"{$_POST['meldersoort']}\",";

  }

  if ($_POST['meldersoort']=="hulpverleners") {

    preset($_POST['melderid']);
    $update .=  " melderhvl_id = {$_POST['melderid']},";

  }

  else if ($_POST['meldersoort']=="ander") {

    $update .=  " melder_naam = \"{$_POST['meldernaam']}\",";

    $update .=  " melder_adres = \"{$_POST['melderadres']}\",";

    $update .=  " melder_gemeente = \"{$_POST['meldergemeenteID']}\",";

    $update .=  " melder_telefoon = \"{$_POST['meldertelefoon']}\",";

    $update .=  " melder_email = \"{$_POST['melderemail']}\",";

    if ($_POST['melder_relatie']>-1) {

      $update .=  " melder_relatie = {$_POST['melder_relatie']},";

    }

    else {

      $update .=  "  melder_relatie = NULL,";

    }

    if ($_POST['melder_relatiedetail']!="") {

      $update .=  " melder_relatiedetail = \"{$_POST['melder_relatiedetail']}\",";

    }

    else {

      $update .=  " melder_relatiedetail = NULL,";

    }

  }



  if ($_POST['slachtoffernaam']!="") {

    $update .=  " slachtoffer_naam = \"{$_POST['slachtoffernaam']}\",";

  }

  else {

    $update .=  " slachtoffer_naam = NULL,";

  }

  if ($_POST['slachtoffergeslacht']!="") {

    $update .=  " slachtoffer_geslacht = \"{$_POST['slachtoffergeslacht']}\",";

  }

  else {

    $update .=  " slachtoffer_geslacht = NULL,";

  }

  if ($_POST['slachtofferleeftijd']!="") {

    $update .=  " slachtoffer_leeftijd = \"{$_POST['slachtofferleeftijd']}\",";

  }

  else {

    $update .=  " slachtoffer_leeftijd = NULL,";

  }

  if ($_POST['slachtofferadres']!="") {

    $update .=  " slachtoffer_adres = \"{$_POST['slachtofferadres']}\",";

  }

  else {

    $update .=  " slachtoffer_adres = NULL,";

  }

  if ($_POST['slachtoffergemeenteID']!="") {

    $update .=  " slachtoffer_gemeente = \"{$_POST['slachtoffergemeenteID']}\",";

  }

  else {

    $update .=  " slachtoffer_gemeente = NULL,";

  }

  if ($_POST['slachtoffertelefoon']!="") {

    $update .=  " slachtoffer_telefoon = \"{$_POST['slachtoffertelefoon']}\",";

  }

  else {

    $update .=  " slachtoffer_telefoon = NULL,";

  }

  if ($_POST['slachtofferemail']!="") {

    $update .=  " slachtoffer_email = \"{$_POST['slachtofferemail']}\",";

  }

  else {

    $update .=  " slachtoffer_email = NULL,";

  }



  if ($_POST['slachtoffer_weetmelding']!="") {

    $update .=  " slachtoffer_weetmelding = \"{$_POST['slachtoffer_weetmelding']}\",";

  }

  else {

    $update .=  " slachtoffer_weetmelding = NULL,";

  }

  if ($_POST['slachtoffer_ervaartmishandeling']!="") {

    $update .=  " slachtoffer_ervaartmishandeling = \"{$_POST['slachtoffer_ervaartmishandeling']}\",";

  }

  else {

    $update .=  " slachtoffer_ervaartmishandeling = NULL,";

  }



  if ($_POST['samenwonen']!="") {

    $update .=  " samenwonen = \"{$_POST['samenwonen']}\",";

  }

  else {

    $update .=  " samenwonen = NULL,";

  }

  if ($_POST['samenwonen_detail']!="") {

    $update .=  " samenwonen_detail = \"{$_POST['samenwonen_detail']}\",";

  }

  else {

    $update .=  " samenwonen_detail = NULL,";

  }



  if ($_POST['slachtoffer_meer']!="") {

    $update .=  " slachtoffer_meer = \"{$_POST['slachtoffer_meer']}\",";

  }

  else {

    $update .=  " slachtoffer_meer = NULL,";

  }

  if ($_POST['slachtoffer_meer_detail']!="") {

    $update .=  " slachtoffer_meer_detail = \"{$_POST['slachtoffer_meer_detail']}\",";

  }

  else {

    $update .=  " slachtoffer_meer_detail = NULL,";

  }



  if ($_POST['plegernaam']!="") {

    $update .=  " pleger_naam = \"{$_POST['plegernaam']}\",";

  }

  else {

    $update .=  " pleger_naam = NULL,";

  }

  if ($_POST['plegergeslacht']!="") {

    $update .=  " pleger_geslacht = \"{$_POST['plegergeslacht']}\",";

  }

  else {

    $update .=  " pleger_geslacht = NULL,";

  }

  if ($_POST['plegerleeftijd']!="") {

    $update .=  " pleger_leeftijd = \"{$_POST['plegerleeftijd']}\",";

  }

  else {

    $update .=  " pleger_leeftijd = NULL,";

  }

  if ($_POST['plegeradres']!="") {

    $update .=  " pleger_adres = \"{$_POST['plegeradres']}\",";

  }

  else {

    $update .=  " pleger_adres = NULL,";

  }

  if ($_POST['plegergemeenteID']!="") {

    $update .=  " pleger_gemeente = \"{$_POST['plegergemeenteID']}\",";

  }

  else {

    $update .=  " pleger_gemeente = NULL,";

  }

  if ($_POST['plegertelefoon']!="") {

    $update .=  " pleger_telefoon = \"{$_POST['plegertelefoon']}\",";

  }

  else {

    $update .=  " pleger_telefoon = NULL,";

  }



  if ($_POST['pleger_weetmelding']!="") {

    $update .=  " pleger_opdehoogte = \"{$_POST['pleger_weetmelding']}\",";

  }

  else {

    $update .=  " pleger_opdehoogte = NULL,";

  }

  if ($_POST['pleger_relatie']>-1) {

      $update .=  " pleger_relatie = {$_POST['pleger_relatie']},";

  }

  else {

      $update .=  " pleger_relatie = NULL,";

  }

  if ($_POST['pleger_relatiedetail']!="") {

    $update .=  " pleger_relatiedetail = \"{$_POST['pleger_relatiedetail']}\",";

  }

  else {

    $update .=  " pleger_relatiedetail = NULL,";

  }

  if ($_POST['pleger_aantal']!="") {

    $update .=  " plegers_aantal = \"{$_POST['pleger_aantal']}\",";

  }

  else {

    $update .=  " plegers_aantal = NULL,";

  }

  if ($_POST['pleger_aantaldetail']!="") {

    $update .=  " plegers_extra = \"{$_POST['pleger_aantaldetail']}\",";

  }

  else {

    $update .=  " plegers_extra = NULL,";

  }



  if ($_POST['situatieschets']!="") {

    $update .=  " situatieschets = \"{$_POST['situatieschets']}\",";

  }

  else {

    $update .=  " situatieschets = NULL,";

  }



  if ($_POST['vorige']!="") {

    $update .=  " vorige = \"{$_POST['vorige']}\",";

  }

  else {

    $update .=  " vorige = NULL,";

  }



  if ($_POST['justitie_weetmelding']!="") {

    $update .=  " justitie_weetmelding = \"{$_POST['justitie_weetmelding']}\",";

  }

  else {

    $update .=  " justitie_weetmelding = NULL,";

  }

  if ($_POST['justitie_weetmelding']=="1") {

    $update .= "  justitie_soort = {$_POST['justitie_soort']},";

    if ($_POST['justitie_detail']!="") {

      $update .=  " justitie_detail = \"{$_POST['justitie_detail']}\",";

    }

    else {

      $update .=  " justitie_detail = NULL,";

    }

  }

  else {

    $update .=  " justitie_soort = NULL,";

    $update .=  " justitie_detail = NULL,";

  }



  if ($_POST['mantelzorgers_aanwezig']!="") {

    $update .=  " mantelzorgers_aanwezig = \"{$_POST['mantelzorgers_aanwezig']}\",";

  }

  else {

    $update .=  " mantelzorgers_aanwezig = NULL,";

  }

  if ($_POST['mantelzorgers_detail']!="") {

    $update .=  " mantelzorgers_detail = \"{$_POST['mantelzorgers_detail']}\",";

  }

  else {

    $update .=  " mantelzorgers_detail = NULL,";

  }

  if ($_POST['contactpersonen_aanwezig']!="") {

    $update .=  " contactpersonen_aanwezig = \"{$_POST['contactpersonen_aanwezig']}\",";

  }

  else {

    $update .=  " contactpersonen_aanwezig = NULL,";

  }

  if ($_POST['contactpersonen_detail']!="") {

    $update .=  " contactpersonen_detail = \"{$_POST['contactpersonen_detail']}\",";

  }

  else {

    $update .=  " contactpersonen_detail = NULL,";

  }



  if ($_POST['opvolging_steunpunt']!="") {

    $update .=  " opvolging_steunpunt = \"{$_POST['opvolging_steunpunt']}\",";

  }

  else {

    $update .=  " opvolging_steunpunt = NULL,";

  }

  if ($_POST['standvanzaken']>-1) {

    $update .=  " standvanzaken = {$_POST['standvanzaken']},";

  }

  else {

    $update .= "  standvanzaken = NULL,";

  }

  if ($_POST['afronddd']!="") {

    $update .=  " afsluiten_dag = \"{$_POST['afronddd']}\",";

  }

  else {

    $update .=  " afsluiten_dag = NULL,";

  }

  if ($_POST['afrondmm']!="") {

    $update .=  " afsluiten_maand = \"{$_POST['afrondmm']}\",";

  }

  else {

    $update .=  " afsluiten_maand = NULL,";

  }

  if ($_POST['afrondjjjj']!="") {

    $update .=  " afsluiten_jaar = \"{$_POST['afrondjjjj']}\",";

  }

  else {

    $update .=  " afsluiten_jaar = NULL,";

  }

  if ($_POST['afronddetail']!="") {

    $update .=  " afsluiten_detail = \"{$_POST['afronddetail']}\",";

  }

  else {

    $update .=  " afsluiten_detail = NULL,";

  }



  if ($_POST['omb_bron']!="") {

    $update .=  " omb_bron = \"{$_POST['omb_bron']}\",";

  }





  if (($_GET['afgerond']==1)  && (($_SESSION['profiel']=="listel") || ($_SESSION['profiel']=="caw")))

    $_GET['afgerond']=2;

      

  $qryUpdateReg1 =

  "  update omb_registratie

     set

        $update

        afgerond = {$_GET['afgerond']},

        id = $ombid

     where id = $ombid";

     

   mysql_query($qryUpdateReg1) or die("3Update 1 van registratie is mislukt ($qryUpdateReg1) omwille van " . mysql_error());

   

   

  //*************************************************************//

  // en dan nu de meervoudige waarden

  //*************************************************************//



  // probleemfactoren

  mysql_query("delete from omb_aanwezigeprobleemfactor where registratie_id = $ombid") or die("4Verwijderen oude probleemfactoren is mislukt omwille van " . mysql_error());

  if (count($_POST['probleemfactor']['slachtoffer'])>0) {

    foreach ($_POST['probleemfactor']['slachtoffer'] as $nr => $waarde) {

      if ($waarde > 0) {

        $detail = $_POST['probleemdetail']['slachtoffer'][$nr];

        $values .=  ", ($ombid, 'slachtoffer', $waarde, \"$detail\")" ;

      }

    }

  }

  if (count($_POST['probleemfactor']['pleger'])>0) {

    foreach ($_POST['probleemfactor']['pleger'] as $nr => $waarde) {

      if ($waarde > 0) {

        $detail = $_POST['probleemdetail']['pleger'][$nr];

        $values .=  ", ($ombid, 'pleger', $waarde, \"$detail\")" ;

      }

    }

  }

  if (strlen($values)>1) {

    $qrySlachtofferProbleemfactoren =

      "

        insert into omb_aanwezigeprobleemfactor

        values

      " . substr($values, 1);



    mysql_query($qrySlachtofferProbleemfactoren) or die("5Update 2 is mislukt ($qrySlachtofferProbleemfactoren) omwille van " . mysql_error());

  }



  // hulp

  $values = "";

  mysql_query("delete from omb_hulp where registratie_id = $ombid") or die("6Verwijderen oude hulp is mislukt omwille van " . mysql_error());

  if (count($_POST['hulp'])>0) {

    foreach ($_POST['hulp'] as $nr => $waarde) {

      if ($waarde > 0) {

        $detail = $_POST['hulpdetail'][$nr];

        $values .=  ", ($ombid, $waarde, \"$detail\")" ;

      }

    }

  }

  if (strlen($values)>1) {

    $qryHulp =

      "

        insert into omb_hulp  (registratie_id, genre, detail)

        values

      " . substr($values, 1);



    mysql_query($qryHulp) or die("7Update 3 is mislukt ($qryHulp) omwille van " . mysql_error());

  }



  // mishandelvormen

  $values = "";

  mysql_query("delete from omb_mishandelvorm where registratie_id = $ombid") or die("8Verwijderen oude mishandelvormen is mislukt omwille van " . mysql_error());

  if (count($_POST['mishandelvorm']['aanmelding'])>0) {

    foreach ($_POST['mishandelvorm']['aanmelding'] as $nr => $waarde) {

      if ($waarde > 0) {

        $values .=  ", ($ombid, $waarde, 'aanmelding')" ;

      }

    }

  }

  if (count($_POST['mishandelvorm']['opvolging'])>0) {

    foreach ($_POST['mishandelvorm']['opvolging'] as $nr => $waarde) {

      if ($waarde > 0) {

        $values .=  ", ($ombid, $waarde, 'opvolging')" ;

      }

    }

  }

  if (strlen($values)>1) {

    $qrySlachtofferMishandelvormen =

      "

        insert into omb_mishandelvorm

        values

      " . substr($values, 1);



    mysql_query($qrySlachtofferMishandelvormen) or die("9Update 4 is mislukt ($qrySlachtofferMishandelvormen) omwille van " . mysql_error());

  }

   if ($_POST['invullen']>0) {

     if ($_GET['afgerond']==1) {

       mysql_query("update overleg set omb_id = $ombid where id = {$_POST['invullen']}") or die("0probleem met update overleg");

     }

     else {

       mysql_query("update overleg set omb_id = -$ombid where id = {$_POST['invullen']}") or die("0probleem met update overleg");

     }

   }

   else if ($_GET['afgerond']==1) {

      // hoort dit bij een overleg?

      mysql_query("update overleg set omb_id = abs(omb_id) where omb_id =  -$ombid") or die("0probleem met update overleg");;

   }





  //---------------------------------------------------------

  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

  //---------------------------------------------------------

}



   print($succes);



?>

