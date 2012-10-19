<?php

require("mailfuncties.inc.php");

function tp_roepnaam($tp_record) {

   return "<span title=\"{$tp_record['naam']}\">Project {$tp_record['nummer']}</span>";

}



function tp_record($id) {

  $qry = "select * from tp_project where id = $id";

  $result = mysql_query($qry);

  return mysql_fetch_assoc($result);

}



function printChecked($waarde1, $waarde2) {

    if ($waarde1 == $waarde2) {
      print(" checked=\"checked\"");
    }

}



function isProject() {

  return ($_SESSION['profiel']=="hoofdproject" || $_SESSION['profiel']=="bijkomend project");

}



function is_tp_opgenomen_op($overlegdatum) {

  $datedatum = substr($overlegdatum, 0, 4) . "-" . substr($overlegdatum, 4, 2) . "-" . substr($overlegdatum, 6, 2);

  $qry = "select * from patient_tp

          where patient = \"{$_SESSION['pat_code']}\"

          and begindatum <= '$datedatum'

          and (einddatum >= '$datedatum' or einddatum is null)";

  $result = mysql_query($qry);

  if (mysql_num_rows($result)==0)

    return 0;

  else {

    $rij = mysql_fetch_assoc($result);

    return $rij['project'];

  }

}



function tp_project_van_patient_op_datum($code,$overlegdatum) {

  $datedatum = substr($overlegdatum, 0, 4) . "-" . substr($overlegdatum, 4, 2) . "-" . substr($overlegdatum, 6, 2);

  $qry = "select * from patient_tp

          where patient = \"$code\"

          and begindatum <= '$datedatum'

          and (einddatum >= '$datedatum' or einddatum is null)";

  $result = mysql_query($qry);

  if (mysql_num_rows($result)==0)

    return 0;

  else {

    $rij = mysql_fetch_assoc($result);

    return $rij;

  }

}



function project_van_patient($patient) {

  $qry = "select tp_project.* from patient_tp, tp_project

          where patient = \"$patient\"

          and patient_tp.project = tp_project.id

          and patient_tp.actief = 1";

  $result = mysql_query($qry) or die($qry . " " . mysql_error());

  if (mysql_num_rows($result)==0)

    return 0;

  else {

    $rij = mysql_fetch_assoc($result);

    return $rij;

  }

}



function tpVisueel($patient) {

   $projectnr = project_van_patient($patient);

   if ($projectnr != 0) {

     $tpCode = " - <span style='background-color: #FFD780'>TP {$projectnr['nummer']}</span> ";

   }

   else {

     $tpCode = "";

   }

   return $tpCode;

}



function getHuidigOverleg() {

  $sql = "select * from overleg

          where afgerond = 0 and patient_code = \"{$_SESSION['pat_code']}\"";

  return mysql_fetch_assoc(mysql_query($sql));

}



function getNrHuidigOverleg($patient) {

  $sql = "select id from overleg

          where afgerond = 0 and patient_code = \"$patient\"";

  $result = mysql_query($sql);

  if (mysql_num_rows($result) == 1) {

    $overleg = mysql_fetch_assoc($result);

    return $overleg['id'];

  }

  else

    return -1; // géén overleg

}



function tp_opgenomen($code) {

  $qry = "select * from patient_tp where patient = \"$code\" and actief = 1";

  return (mysql_num_rows(mysql_query($qry))==1);

}



function is_tp_patient() {

   return tp_opgenomen($_SESSION['pat_code']);

}



function isEersteOverlegTP() {

  $qryInTP = "select * from patient_tp where patient = \"{$_SESSION['pat_code']}\" and actief = 1";

  $resultQry = mysql_query($qryInTP) or die("$qry geeft een fout " .mysql_error());

  if (mysql_num_rows($resultQry)==1) {

    $inclusiegegevens = mysql_fetch_assoc($resultQry);

    $begindatumMetStreepjes = $inclusiegegevens['begindatum'];

    $beginDatum = substr($begindatumMetStreepjes, 0, 4) . substr($begindatumMetStreepjes, 5, 2) . substr($begindatumMetStreepjes, 8, 2);

    

    $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.actief = 1    AND

              afgerond=1 AND genre = 'TP' 

              and overleg.datum >= $beginDatum ";

    if (mysql_num_rows(mysql_query($queryElkOverleg)) == 0) {

      return true;

    }

    else {

     return false;

    }

  }

  else return false;

}



function isEersteOverlegTP_op($overlegdatum) {

  $datedatum = substr($overlegdatum, 0, 4) . "-" . substr($overlegdatum, 4, 2) . "-" . substr($overlegdatum, 6, 2);

  $qry = "select * from patient_tp

          where patient = \"{$_SESSION['pat_code']}\"

          and ((begindatum <= '$datedatum' and (einddatum >= '$datedatum' or einddatum is null))

               ) order by actief desc";

  //print("$qry ALLEZ SEG");

  $resultQry = mysql_query($qry) or die("$qry geeft een fout " .mysql_error());

  if ((mysql_num_rows($resultQry)>0)) {

    $inclusiegegevens = mysql_fetch_assoc($resultQry);

    $begindatumMetStreepjes = $inclusiegegevens['begindatum'];

    $beginDatum = substr($begindatumMetStreepjes, 0, 4) . substr($begindatumMetStreepjes, 5, 2) . substr($begindatumMetStreepjes, 8, 2);



    $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              afgerond=1 AND genre = 'TP'

              and datum >= $beginDatum

              and datum < \"$overlegdatum\" ";

    $resultElkOverleg = mysql_query($queryElkOverleg) or die("$queryElkOverleg geeft een fout " .mysql_error());

    if (mysql_num_rows($resultElkOverleg) == 0) {

      return true;

    }

    else {

     return false;

    }

  }

  else {

    //print("Waarschuwing: deze patient is op de overlegdatum niet opgenomen in een TP. Dit kan gekke effecten geven.");

    return false;

    

  }

}



function isEersteOverlegTP_datum($overlegdatum) {

   return isEersteOverlegTP_op($overlegdatum);

}



function isEersteOverlegTP_datum2($overlegdatum) {

  $dateDatum = substr($overlegdatum, 0, 4) . "-" . substr($overlegdatum, 4, 2) . "-" . substr($overlegdatum, 6, 2);

    $qryProject = "select project, begindatum from patient_tp where patient = '{$_SESSION['pat_code']}' and

                      begindatum <= '$dateDatum' and (einddatum is null or '$dateDatum' <= einddatum)";

    $resultProject = mysql_query($qryProject);

    if (mysql_num_rows($resultProject)==0) {

       return false;

    }



    $rijProject = mysql_fetch_assoc($resultProject);

    $project = $rijProject['project'];

    $begindatumMetStreepjes = $rijProject['begindatum'];

    $beginDatum = substr($begindatumMetStreepjes, 0, 4) . substr($begindatumMetStreepjes, 5, 2) . substr($begindatumMetStreepjes, 8, 2);



    $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.project = $project AND

              datum >= replace(begindatum, '-', '') AND

              (  datum <= replace(einddatum, '-', '')

                   or

                 einddatum is NULL

              ) AND

              datum >= $beginDatum

              AND

              datum < \"$overlegdatum\" AND

              genre = 'TP' ";



    if (mysql_num_rows(mysql_query($queryElkOverleg)) == 0) {

      return true;

    }

    else {

     return false;

    }

}

function voorgaandOverlegTP_datum($overlegdatum, $vergoed = false) {

  $dateDatum = substr($overlegdatum, 0, 4) . "-" . substr($overlegdatum, 4, 2) . "-" . substr($overlegdatum, 6, 2);

  if ($vergoed) $vergoeding = " and keuze_vergoeding = 1 ";

    $qryProject = "select project, begindatum from patient_tp where patient = '{$_SESSION['pat_code']}' and

                      begindatum <= '$dateDatum' and (einddatum is null or '$dateDatum' <= einddatum)";

    $resultProject = mysql_query($qryProject);

    if (mysql_num_rows($resultProject)==0) {

       return -1;

    }



    $rijProject = mysql_fetch_assoc($resultProject);

    $project = $rijProject['project'];

    $begindatumMetStreepjes = $rijProject['begindatum'];

    $beginDatum = substr($begindatumMetStreepjes, 0, 4) . substr($begindatumMetStreepjes, 5, 2) . substr($begindatumMetStreepjes, 8, 2);



    $queryElkOverleg = "SELECT overleg.* FROM overleg, patient_tp

        WHERE overleg.patient_code = '{$_SESSION['pat_code']}' AND

              overleg.patient_code = patient_tp.patient AND

              patient_tp.project = $project AND

              datum >= replace(begindatum, '-', '') AND

              (  datum <= replace(einddatum, '-', '')

                   or

                 einddatum is NULL

              ) AND

              datum >= $beginDatum

              AND

              datum < \"$overlegdatum\" AND

              genre = 'TP'

              $vergoeding

        ORDER by datum DESC";



    $overlegResult = mysql_query($queryElkOverleg);

    if (mysql_num_rows($overlegResult) == 0) {

      return -1;

    }

    else {

     $overleg = mysql_fetch_assoc($overlegResult);

     return $overleg;

    }

}



function patient_roepnaam($code) {

  if (!tp_opgenomen($code)) {

    $qry = "select naam, voornaam, code, type from patient where code = \"$code\"";

    $result = mysql_query($qry);

    $patient = mysql_fetch_assoc($result);

    while (strrpos($patient['naam']," ")==strlen($patient['naam'])-1) {
      $patient['naam'] = substr($patient['naam'],0,strlen($patient['naam'])-1);
    }

    if ($patient['type']==16 || $patient['type']==18)
       return "{$patient['code']}-PSY {$patient['naam']} {$patient['voornaam']}";
    else
       return "{$patient['code']} {$patient['naam']} {$patient['voornaam']}";

  }

  else {

    $qry = "select patient.naam, voornaam, code, tp_project.naam as projectnaam, tp_project.nummer as projectnummer

            from patient, patient_tp, tp_project

            where code = \"$code\" and patient = code and patient_tp.project = tp_project.id

            order by patient_tp.actief desc, patient_tp.einddatum desc" ;

    $result = mysql_query($qry);

    $patient = mysql_fetch_assoc($result);

    while (strrpos($patient['naam']," ")==strlen($patient['naam'])-1) {
      $patient['naam'] = substr($patient['naam'],0,strlen($patient['naam'])-1);
    }

    return "{$patient['code']} {$patient['naam']} {$patient['voornaam']} (TP {$patient['projectnummer']})";

  }

}



function patient_roepnaam_opOverleg($code, $id) {

  $datum = mysql_fetch_assoc(mysql_query("select datum, genre from overleg where id  = $id"));

  $overlegdatum = $datum['datum'];

  $datedatum = substr($overlegdatum, 0, 4) . "-" . substr($overlegdatum, 4, 2) . "-" . substr($overlegdatum, 6, 2);

  $qry = "select * from patient_tp

          where patient = \"$code\"

          and begindatum <= '$datedatum'

          and (einddatum >= '$datedatum' or einddatum is null)";

  $resultTP = mysql_query($qry) or die(mysql_error() . $qry);

  if ((mysql_num_rows($resultTP)==1)) {

    $rijTP = mysql_fetch_assoc($resultTP);

    $qry = "select patient.naam, voornaam, code, tp_project.naam as projectnaam, tp_project.nummer as projectnummer

            from patient, patient_tp, tp_project

            where code = \"$code\" and patient = code and patient_tp.project = tp_project.id and patient_tp.project = {$rijTP['project']}" ;

    $result = mysql_query($qry)  or die(mysql_error() . $qry);

    $patient = mysql_fetch_assoc($result);

    while (strrpos($patient['naam']," ")==strlen($patient['naam'])-1) {
      $patient['naam'] = substr($patient['naam'],0,strlen($patient['naam'])-1);
    }

    return "{$patient['code']} {$patient['naam']} {$patient['voornaam']} (TP {$patient['projectnummer']}) ";

  }

  else {

    $qry = "select naam, voornaam, code, type from patient where code = \"$code\"";

    $result = mysql_query($qry);

    $patient = mysql_fetch_assoc($result);

    while (strrpos($patient['naam']," ")==strlen($patient['naam'])-1) {
      $patient['naam'] = substr($patient['naam'],0,strlen($patient['naam'])-1);
    }

    if ($datum['genre']=="TP")

      return "{$patient['code']} {$patient['naam']} {$patient['voornaam']} (TP ??)";

    else if ($patient['type']==16 || $patient['type']==18)
       return "{$patient['code']}-PSY {$patient['naam']} {$patient['voornaam']}";
    else

      return "{$patient['code']} {$patient['naam']} {$patient['voornaam']} ";

  }

}



function toonPlannen($qry) {

    //print($qry);

    $result = mysql_query($qry) or die($qry . " is fout want " . mysql_error());

    for ($i=0; $i < mysql_num_rows($result); $i++) {

      $rij = mysql_fetch_assoc($result);

      print("<tr><td class=\"label\">{$rij['naam']}</td>

                 <td class=\"input\"><input type=\"text\" class=\"lang\" name=\"plan[{$rij['nr']}]\" value=\"{$rij['plan']}\" /></td></tr>\n");

    }

  }



  function toonPlannen2($qry, $vorige) {

    global $oud, $naamListel;

    //print($qry);

    $result = mysql_query($qry) or die($qry . " is fout want " . mysql_error());

    

    for ($i=0; $i < mysql_num_rows($result); $i++) {

      $rij = mysql_fetch_assoc($result);

      if ($rij['naam']=="GDT - LISTEL vzw") {
        $rij['naam'] = $naamListel;
      }
      print("<tr><td class=\"rand\">{$rij['naam']}</td>\n");

      if ($vorige) {

        $naam = $rij['naam'];

        $vorigePlan = $oud[$naam];

        print("<td class='rand'>$vorigePlan</td>");

      }

      print("    <td class=\"rand\">{$rij['plan']}</td></tr>\n");

    }

  }








function toonZoekOrganisatie($form, $valOrganisatie="", $beperking="", $extraJavascript="") {

  print("<script type=\"text/javascript\">");

  $query = "SELECT * FROM organisatie

            where actief = 1 $beperking

	          ORDER BY naam";



  if ($result=mysql_query($query)){

    print ("var orgList = Array();var organisaties=Array();");

    for ($i=0; $i < mysql_num_rows ($result); $i++){

      $records= mysql_fetch_array($result);

      echo <<< EINDEJS

        orgList[2*$i] = "{$records['naam']}";

        orgList[2*$i+1]={$records['id']};

        organisaties[{$records['id']}] = new Array();

        organisaties[{$records['id']}]['id'] = "{$records['id']}";

        organisaties[{$records['id']}]['naam'] = "{$records['naam']}";

        organisaties[{$records['id']}]['adres'] = "{$records['adres']}";

        organisaties[{$records['id']}]['gem_id'] = "{$records['gem_id']}";

        organisaties[{$records['id']}]['tel'] = "{$records['tel']}";

        organisaties[{$records['id']}]['fax'] = "{$records['fax']}";

        organisaties[{$records['id']}]['gsm'] = "{$records['gsm']}";

        organisaties[{$records['id']}]['email'] = "{$records['email_inhoudelijk']}";

        organisaties[{$records['id']}]['genre'] = "{$records['genre']}";
        organisaties[{$records['id']}]['ggz'] = "{$records['ggz']}";
        organisaties[{$records['id']}]['art107'] = "{$records['art107']}";

EINDEJS;



if ($records['reknr'] == "") {

  $qry2 = "SELECT reknr, iban, bic FROM organisatie

            where actief = 1 $beperking

            and id = {$records['hoofdzetel']}";

  if ($result2=mysql_query($qry2)){

    $records2= mysql_fetch_array($result2);

    print("        organisaties[{$records['id']}]['reknr'] = \"{$records2['reknr']}\";\n");
    print("        organisaties[{$records['id']}]['iban'] = \"{$records2['iban']}\";\n");
    print("        organisaties[{$records['id']}]['bic'] = \"{$records2['bic']}\";\n");

  }

  else {

    print("        organisaties[{$records['id']}]['reknr'] = \"{$records['reknr']}\";\n");
    print("        organisaties[{$records['id']}]['iban'] = \"{$records['iban']}\";\n");
    print("        organisaties[{$records['id']}]['bic'] = \"{$records['bic']}\";\n");

  }

}

else

  print("        organisaties[{$records['id']}]['reknr'] = \"{$records['reknr']}\";\n");
  print("        organisaties[{$records['id']}]['iban'] = \"{$records['iban']}\";\n");
  print("        organisaties[{$records['id']}]['bic'] = \"{$records['bic']}\";\n");

    }

  }

  else{print(mysql_error());}

  print("</script>");

  

  if ($extraJavascript != "") {

    $extraJS = "if (!isNaN(parseInt(\$F('organisatie')))) { $extraJavascript }";

  }



  echo <<< EINDE

    <div class="inputItem" id="Organisatie">

        <div class="label160" >Organisatie<div class="reqfield">*</div>&nbsp;: </div>

        <div class="waarde">

            <input style="width: 230px;" onKeyUp="refreshListOveral('$form','organisatieInput','organisatie',1,'OrganisatieS',orgList,20);$extraJS"

            onmouseUp="showCombo('OrganisatieS',100)"

            onfocus="document.getElementById('OrganisatieS').style.display='block';('$form','organisatieInput','organisatie',1,'OrganisatieS',orgList,20)"

            type="text" name="organisatieInput" value="$valOrganisatie">

            <input type="button"  value="<<"

            onClick="resetList('$form','organisatieInput','organisatie',1,'OrganisatieS',orgList,20,100)" />

        </div>

    </div>

    <div class="inputItem" id="OrganisatieS" style="display:none">

        <div class="label160">Kies eventueel&nbsp;:</div>

        <div class="waarde">

            <select style="font-size: 10px;" onClick="handleSelectClick('$form','organisatieInput','organisatie',1,'OrganisatieS');$extraJS"

            name="organisatie" id="organisatie" size="5">

            </select>

        </div>

    </div><!--Organisatie -->

EINDE;





}



function initRiziv() {

  global $rizivtarieven;

  $query = "select * from riziv_tarieven where actief = 1 order by datum desc";

  $result = mysql_query($query);

  for ($i=0; $i < mysql_num_rows($result); $i++) {

    $rij = mysql_fetch_assoc($result);

    $rizivtarieven[$i]=$rij;

  }

}



function rizivTarief($datum) {

   global $rizivtarieven;

   $i = 0;

   while ($rizivtarieven[$i]['datum'] > $datum) $i++;

   return $rizivtarieven[$i];

}



function ombvergoedbaar($overlegid) {

   $overlegInfo = getFirstRecord("select * from overleg where id=$overlegid");

   // omb-vergoeding is niet cumuleerbaar met andere vergoeding

   if ($overlegInfo== null) return null;

   

   if ($overlegInfo['keuze_vergoeding']==1) {
        if (!(isset($overlegInfo['akkoord_patient']) && ($overlegInfo['akkoord_patient'] == 0))) {
          return false; // want de patient gaat akkoord en men wil vergoeding voor het gewone overleg.
        }
        // else : men wil vergoeding en de patient gaat niet akkoord. Dan kan er omb-vergoeding zijn
        //        en moeten we de andere dingen controleren.
   }

   if ($overlegInfo['keuze_vergoeding']==-1) return false; // weigeren is alles weigeren

   // omb moet natuurlijk geactiveerd zijn

   if ($overlegInfo['omb_actief']!=1) return false;



   if ($overlegInfo['afgerond']==1) {

     // aantal professionelen aanwezig

     $qryZVL="

      	SELECT

		      count(bl.persoon_id) as aantal

	      FROM

		      afgeronde_betrokkenen bl,

		      overleg,

		      hulpverleners h inner join organisatie org on (h.organisatie = org.id)

	      WHERE
          bl.overleggenre = 'gewoon' AND
          overleg.id = $overlegid AND

          overleg.id = bl.overleg_id AND

          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

          bl.persoon_id=h.id AND

          org.genre = 'ZVL' AND

		      bl.aanwezig=1

     ";

     $qryProfnietZVL="

      	SELECT

		      count(bl.persoon_id) as aantal

	      FROM

		      afgeronde_betrokkenen bl,

		      overleg,

		      hulpverleners h inner join organisatie org on (h.organisatie = org.id)

	      WHERE
          bl.overleggenre = 'gewoon' AND
          overleg.id = $overlegid AND

          overleg.id = bl.overleg_id AND

          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

          bl.persoon_id=h.id AND

          org.genre in ('HVL', 'XVLP', 'XVLNP') AND

		      bl.aanwezig=1

        GROUP BY org.id

     ";

     // aantal iedereen aanwezig

     $qryTot="

      	SELECT

		      count(bl.persoon_id) as aantal

	      FROM

		      afgeronde_betrokkenen bl,

		      overleg

	      WHERE
          bl.overleggenre = 'gewoon' AND
          overleg.id = $overlegid AND

          overleg.id = bl.overleg_id AND

		      bl.aanwezig=1

     ";

   }

   else {

     // aantal professionelen aanwezig

     $qryZVL="

      	SELECT

		      count(bl.persoon_id) as aantal

	      FROM

		      huidige_betrokkenen bl,

		      overleg,

		      hulpverleners h inner join organisatie org on (h.organisatie = org.id)

	      WHERE
          bl.overleggenre = 'gewoon' AND
          overleg.id = $overlegid AND

          overleg.patient_code = bl.patient_code AND

          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

          bl.persoon_id=h.id AND

          org.genre = 'ZVL' AND

		      bl.aanwezig=1

     ";

     $qryProfnietZVL="

      	SELECT

		      count(bl.persoon_id) as aantal

	      FROM

		      huidige_betrokkenen bl,

		      overleg,

		      hulpverleners h inner join organisatie org on (h.organisatie = org.id)

	      WHERE
          bl.overleggenre = 'gewoon' AND
          overleg.id = $overlegid AND

          overleg.patient_code = bl.patient_code AND

          (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND

          bl.persoon_id=h.id AND

          org.genre in ('HVL', 'XVLP', 'XVLNP') AND

		      bl.aanwezig=1

        GROUP BY org.id

     ";

     // aantal iedereen aanwezig

     $qryTot="

      	SELECT

		      count(bl.persoon_id) as aantal

	      FROM

		      huidige_betrokkenen bl,

		      overleg

	      WHERE
          bl.overleggenre = 'gewoon' AND
          overleg.id = $overlegid AND

          overleg.patient_code = bl.patient_code AND

		      bl.aanwezig=1

     ";

   }



   $resultZVL=mysql_query($qryZVL);
   $recordsZVL=mysql_fetch_array($resultZVL);

   $resultProfnietZVL=mysql_query($qryProfnietZVL);
   $recordsProfnietZVL=mysql_fetch_array($resultProfnietZVL);

   $aantalProf = $recordsZVL['aantal']+$recordsProfnietZVL['aantal'];

   $resultTot=mysql_query($qryTot);
   $recordsTot=mysql_fetch_array($resultTot);
   $aantalTot = $recordsTot['aantal'];

   return ($aantalProf >= 2 && $aantalTot >= 3);

}



function getUniqueRecord($qry) {

  // pre: vereist dat er slechts één record is. Anders die()

  $result = mysql_query($qry) or die("getUniqueRecord - query fout - $qry - " . mysql_error());

  if (mysql_num_rows($result)!=1) die("getUniqueRecord $qry - fout aantal records - " . mysql_num_rows($result));

  

  return mysql_fetch_assoc($result);

}



function getFirstRecord($qry) {

  $result = mysql_query($qry) or die("getFirstRecord - query fout - $qry - " . mysql_error());



  if (mysql_num_rows($result)==0) return null;

  else return mysql_fetch_assoc($result);

}



function vul0Aan($getal, $aantal) {

   if (strlen($getal)>= $aantal) {

     return $getal;

   }

   $nullen = "";

   for ($i=strlen($getal);$i<$aantal;$i++) {

     $nullen .= "0";

   }

   return $nullen . $getal;

}



function getGemeenteInfo($gemeenteID) {

   return getFirstRecord("select * from gemeente where id = 0$gemeenteID");

}



function berekenSubsidiestatus($minStatus, $vorigeTekststatus, $code, $tabel, $kolom, $waarde) {

   $nieuweStatus = berekenGetalSubsidiestatus($minStatus, $vorigeTekststatus, $code, $tabel, $kolom, $waarde);

   return aanpassenTekstStatus($code, $nieuweStatus, $vorigeTekststatus);

}



function berekenGetalSubsidiestatus($minStatus, $vorigeTekststatus, $code, $tabel, $kolom, $waarde) {

  if ($minStatus%180 == 0) return "ok";

  $status = 1;

  // katz-score zit opgeslagen in minStatus

  if ($minStatus%4 == 0) $status = 4;

  else if ($minStatus%2 == 0) $status = 2;

  

  // op zoek naar een huisarts

  if ($minStatus%9 == 0) $status = $status * 9;

  else {

    $qryZoekHA = "select aanwezig from {$tabel}_betrokkenen betr,

                                       hulpverleners hvl

                  where $kolom = '$waarde'
                    and betr.overleggenre = 'gewoon'
                    and (betr.genre = 'hulp' or betr.genre = 'orgpersoon')

                    and betr.persoon_id = hvl.id

                    and hvl.fnct_id = 1

                  order by aanwezig desc;";

    $resultHA = mysql_query($qryZoekHA);

    if (!$resultHA) return("KO: $qryZoekHA");

    if (mysql_num_rows($resultHA) > 0) {

      $rijHA = mysql_fetch_assoc($resultHA);

      if ($rijHA['aanwezig']==1) {

        $status = $status*9;

      }

      else {

        $status = $status*3;  // afwezige, maar betrokken huisarts

      }

    }

  }

  

  // op zoek naar het aantal aanwezige personen op dit overleg

  if ($minStatus%5 == 0) $status = $status * 5;

  else {

    $qryAantalHVL = "select aanwezig from {$tabel}_betrokkenen betr,

                                       hulpverleners hvl,

                                       organisatie org

                  where $kolom = '$waarde'
                    and betr.overleggenre = 'gewoon'
                    and (betr.genre = 'hulp' or betr.genre = 'orgpersoon')

                    and betr.persoon_id = hvl.id

                    and hvl.organisatie = org.id

                    and org.genre in ('ZVL','HVL','XVL', 'XVLP')

                    and aanwezig = 1

                  order by aanwezig desc;";

    $resultAantalHVL = mysql_query($qryAantalHVL);

    if (!$resultAantalHVL) return("KO: $qryAantalHVL");



    $aantalMensen = mysql_num_rows($resultAantalHVL);



    if ($kolom == "overleg_id") {

        $qryAantalMZ = "select aanwezig from {$tabel}_betrokkenen, overleg

                  where $kolom = '$waarde'
                    and overleggenre = 'gewoon'
                    and overleg.id = overleg_id

                    and genre = 'mantel'

                    and aanwezig = 1

                  order by aanwezig desc;";

    }

    else {

      $qryAantalMZ = "select aanwezig from {$tabel}_betrokkenen

                  where $kolom = '$waarde'
                    and overleggenre = 'gewoon'
                    and genre = 'mantel'

                    and aanwezig = 1

                  order by aanwezig desc;";

    }

    $resultAantalMZ = mysql_query($qryAantalMZ);

    if (!$resultAantalMZ) return("KO: $qryAantalMZ");



    if (mysql_num_rows($resultAantalMZ) > 0) {

       $aantalMensen++;

    }



    if ($aantalMensen >= 3) {

      $status = $status*5;

    }

  }

  return $status;

}



function aanpassenTekstStatus($code, $status, $vorigeTekststatus) {

  // de nieuwe status is nu berekend

  // en we gaan vergelijken met de oude tekststatus om te zien

  // of we een nieuwe versie moeten opslaan

  if ($status%180==0) {

    $nieuweStatus = "ok";

    if (!($vorigeTekststatus == "ok")) {

      // het was nog niet ok, maar het wordt nu ok

      saveSubsidiestatus($code, "ok");

    }

  }

  else if ($status%30==0) {  // nu verdedigbaar

    if ($vorigeTekststatus == "ok") {

      // het was daarnet nog ok geweest, dus we stellen sowieso verdedigbaar én verdedigd

      saveSubsidiestatus($code, "verdedigd");

      $nieuweStatus = "verdedigd";

    }

    else if ($vorigeTekststatus == "niet-verdedigbaar") {

      // betere status

      saveSubsidiestatus($code, "verdedigbaar");

      $nieuweStatus = "verdedigbaar";

    }

    // dus: als het al verdedigd of niet-verdedigd was, dan wijzigen we niks

    if ($vorigeTekststatus == "" || (($vorigeTekststatus != "verdedigd") && ($vorigeTekststatus != "niet-verdedigd"))) {

      saveSubsidiestatus($code, "verdedigbaar");

      $nieuweStatus = "verdedigbaar";

    }

    else {

      $nieuweStatus = $vorigeTekststatus;

    }

  }

  else {

    $nieuweStatus= "niet-verdedigbaar";

    saveSubsidiestatus($code, "niet-verdedigbaar");

  }

  

  return $nieuweStatus;

}



function saveSubsidiestatus($code, $status) {

    $qry = "update patient set subsidiestatus = '$status' where code = '$code'";

    mysql_query($qry);

}



function geenRekeningNummer($org_id) {

  $qry = "select organisatie.iban as rek1, hoofdzetel.iban as rek2 from organisatie left join organisatie hoofdzetel on organisatie.hoofdzetel = hoofdzetel.id

              where organisatie.id = $org_id";

  $result = getUniqueRecord($qry);

  return ((strlen($result['rek1']) + strlen($result['rek2'])) == 0);

}



function mooieDatum($datum) {

  return substr($datum, 6,2) . "/" . substr($datum,4,2) . "/" . substr($datum, 0,4);

}

function mooieDatumVanLang($datum) {
  return substr($datum, 8,2) . "/" . substr($datum,5,2) . "/" . substr($datum, 0,4);
}


function initiaal($voornaam, $naam) {

  $metSpatie = substr(strrchr($naam, " "),1,1);

  if (strlen($metSpatie)==0)

    return substr($voornaam, 0, 1) . substr($naam, 0, 1);

  return substr($voornaam, 0, 1) . $metSpatie;

}



function bankcode2bic($code) {
if ($code >= 0 && $code <= 0) return 'BPOT BE B1';
if ($code >= 1 && $code <= 40) return 'GEBA BE BB';
if ($code >= 41 && $code <= 45) return 'VRIJ';
if ($code >= 46 && $code <= 49) return 'GEBA BE BB';
if ($code >= 50 && $code <= 99) return 'GKCC BE BB';
if ($code >= 100 && $code <= 101) return 'NBBE BE BB';
if ($code >= 102 && $code <= 102) return 'nav';
if ($code >= 103 && $code <= 108) return 'NICA BE BB';
if ($code >= 109 && $code <= 109) return 'BKCP BE B1 BKB';
if ($code >= 110 && $code <= 110) return 'BKCP BE BB';
if ($code >= 111 && $code <= 111) return 'ABER BE 21';
if ($code >= 112 && $code <= 112) return 'VRIJ';
if ($code >= 113 && $code <= 114) return 'BKCP BE B1 BKB';
if ($code >= 115 && $code <= 115) return 'VRIJ';
if ($code >= 116 && $code <= 116) return 'VRIJ';
if ($code >= 117 && $code <= 118) return 'VRIJ';
if ($code >= 119 && $code <= 121) return 'BKCP BE B1 BKB';
if ($code >= 122 && $code <= 123) return 'BKCP BE B1 OBK';
if ($code >= 124 && $code <= 124) return 'BKCP BE B1 BKB';
if ($code >= 125 && $code <= 126) return 'CPHB BE 75';
if ($code >= 127 && $code <= 127) return 'BKCP BE B1 BKB';
if ($code >= 128 && $code <= 128) return 'VRIJ';
if ($code >= 129 && $code <= 129) return 'BKCP BE B1 BKB';
if ($code >= 130 && $code <= 130) return 'VRIJ';
if ($code >= 131 && $code <= 131) return 'BKCP BE B1 BKB';
if ($code >= 132 && $code <= 132) return 'BNAG BE BB';
if ($code >= 133 && $code <= 134) return 'BKCP BE B1 BKB';
if ($code >= 135 && $code <= 136) return 'VRIJ';
if ($code >= 137 && $code <= 137) return 'GEBA BE BB';
if ($code >= 138 && $code <= 138) return 'VRIJ';
if ($code >= 139 && $code <= 139) return 'nav';
if ($code >= 140 && $code <= 149) return 'GEBA BE BB';
if ($code >= 150 && $code <= 165) return 'VRIJ';
if ($code >= 166 && $code <= 166) return 'nav';
if ($code >= 167 && $code <= 167) return 'nav';
if ($code >= 168 && $code <= 170) return 'VRIJ';
if ($code >= 171 && $code <= 171) return 'CEVT BE 71';
if ($code >= 172 && $code <= 172) return 'RABO BE 22';
if ($code >= 173 && $code <= 175) return 'VRIJ';
if ($code >= 176 && $code <= 177) return 'BSCH BE BR';
if ($code >= 178 && $code <= 179) return 'COBA BE BX';
if ($code >= 180 && $code <= 182) return 'VRIJ';
if ($code >= 183 && $code <= 183) return 'BARB BE BB';
if ($code >= 184 && $code <= 184) return 'VRIJ';
if ($code >= 185 && $code <= 185) return 'HBKA BE 22';
if ($code >= 186 && $code <= 188) return 'VRIJ';
if ($code >= 189 && $code <= 189) return 'SMBC BE BB';
if ($code >= 190 && $code <= 199) return 'CREG BE BB';
if ($code >= 200 && $code <= 214) return 'GEBA BE BB';
if ($code >= 215 && $code <= 219) return 'VRIJ';
if ($code >= 220 && $code <= 251) return 'GEBA BE BB';
if ($code >= 252 && $code <= 256) return 'VRIJ';
if ($code >= 257 && $code <= 257) return 'GEBA BE BB';
if ($code >= 258 && $code <= 258) return 'VRIJ';
if ($code >= 259 && $code <= 298) return 'GEBA BE BB';
if ($code >= 299 && $code <= 299) return 'GEBA BE BB';
if ($code >= 300 && $code <= 399) return 'BBRU BE BB';
if ($code >= 400 && $code <= 499) return 'KRED BE BB';
if ($code >= 500 && $code <= 500) return 'SBOS BE B1';
if ($code >= 501 && $code <= 501) return 'DHBN BE BB';
if ($code >= 502 && $code <= 502) return 'VRIJ';
if ($code >= 503 && $code <= 503) return 'DRES BE BX';
if ($code >= 504 && $code <= 504) return 'VOWA BE B1';
if ($code >= 505 && $code <= 506) return 'NAP';
if ($code >= 507 && $code <= 507) return 'DIER BE 21';
if ($code >= 508 && $code <= 508) return 'PARB BE BZ-MDC';
if ($code >= 509 && $code <= 509) return 'ABNA BE BR';
if ($code >= 510 && $code <= 510) return 'VAPE BE 21';
if ($code >= 511 && $code <= 511) return 'NAP';
if ($code >= 512 && $code <= 512) return 'DNIB BE 21';
if ($code >= 513 && $code <= 513) return 'SGAB BE B2';
if ($code >= 514 && $code <= 514) return 'PUIL BE BB';
if ($code >= 515 && $code <= 515) return 'IRVT BE BB';
if ($code >= 516 && $code <= 516) return 'VRIJ';
if ($code >= 517 && $code <= 517) return 'FORD BE 21';
if ($code >= 518 && $code <= 518) return 'NAP';
if ($code >= 519 && $code <= 519) return 'BNYM BE BB';
if ($code >= 520 && $code <= 520) return 'AACA BE 41';
if ($code >= 521 && $code <= 521) return 'FVLB BE 22';
if ($code >= 522 && $code <= 522) return 'UTWB BE BB';
if ($code >= 523 && $code <= 523) return 'TRIO BE 91';
if ($code >= 524 && $code <= 524) return 'WAFA BE BB';
if ($code >= 525 && $code <= 529) return 'VRIJ';
if ($code >= 530 && $code <= 530) return 'SHIZ BE BB';
if ($code >= 531 && $code <= 531) return 'NAP';
if ($code >= 532 && $code <= 534) return 'VRIJ';
if ($code >= 535 && $code <= 535) return 'FBHL BE 22';
if ($code >= 536 && $code <= 537) return 'VRIJ';
if ($code >= 538 && $code <= 538) return 'nav';
if ($code >= 539 && $code <= 539) return 'NAP';
if ($code >= 540 && $code <= 540) return 'VRIJ';
if ($code >= 541 && $code <= 541) return 'BKID BE 22';
if ($code >= 542 && $code <= 544) return 'VRIJ';
if ($code >= 545 && $code <= 545) return 'NAP';
if ($code >= 546 && $code <= 546) return 'WAFA BE BB';
if ($code >= 547 && $code <= 547) return 'VRIJ';
if ($code >= 548 && $code <= 548) return 'LOCY BE BB';
if ($code >= 549 && $code <= 549) return 'CHAS BE BX';
if ($code >= 550 && $code <= 560) return 'GKCC BE BB';
if ($code >= 561 && $code <= 561) return 'BCRT BE B1';
if ($code >= 562 && $code <= 569) return 'GKCC BE BB';
if ($code >= 570 && $code <= 579) return 'CITI BE BX';
if ($code >= 580 && $code <= 580) return 'VRIJ';
if ($code >= 581 && $code <= 581) return 'MHCB BE BB';
if ($code >= 582 && $code <= 582) return 'VRIJ';
if ($code >= 583 && $code <= 583) return 'DEGR BE BB';
if ($code >= 584 && $code <= 584) return 'ICIC GB 2L';
if ($code >= 585 && $code <= 585) return 'RCBP BE BB';
if ($code >= 586 && $code <= 586) return 'CFFR BE B1';
if ($code >= 587 && $code <= 587) return 'nav';
if ($code >= 588 && $code <= 588) return 'CMCI BE B1';
if ($code >= 589 && $code <= 589) return 'VRIJ';
if ($code >= 590 && $code <= 594) return 'BSCH BE BB';
if ($code >= 595 && $code <= 601) return 'CTBK BE BX';
if ($code >= 602 && $code <= 602) return 'NAP';
if ($code >= 603 && $code <= 609) return 'VRIJ';
if ($code >= 610 && $code <= 613) return 'BDCH BE 22';
if ($code >= 614 && $code <= 623) return 'VRIJ';
if ($code >= 624 && $code <= 625) return 'GKCC BE BB';
if ($code >= 626 && $code <= 629) return 'VRIJ';
if ($code >= 630 && $code <= 631) return 'BBRU BE BB';
if ($code >= 632 && $code <= 633) return 'LOYD BE BB';
if ($code >= 634 && $code <= 636) return 'BNAG BE BB';
if ($code >= 637 && $code <= 637) return '';
if ($code >= 638 && $code <= 638) return 'GKCC BE BB';
if ($code >= 639 && $code <= 639) return 'VRIJ';
if ($code >= 640 && $code <= 640) return 'ADIA BE 22';
if ($code >= 641 && $code <= 641) return 'VRIJ';
if ($code >= 642 && $code <= 642) return 'BBVA BE BB';
if ($code >= 643 && $code <= 643) return 'BMPB BE BB';
if ($code >= 644 && $code <= 644) return 'VRIJ';
if ($code >= 645 && $code <= 645) return 'JVBA BE 22';
if ($code >= 646 && $code <= 647) return 'BNAG BE BB';
if ($code >= 648 && $code <= 650) return 'VRIJ';
if ($code >= 651 && $code <= 651) return 'KEYT BE BB';
if ($code >= 652 && $code <= 652) return 'HBKA BE 22';
if ($code >= 653 && $code <= 655) return 'VRIJ';
if ($code >= 656 && $code <= 656) return 'ETHI BE BB';
if ($code >= 657 && $code <= 657) return 'GKCC BE BB';
if ($code >= 658 && $code <= 658) return 'HABB BE BB';
if ($code >= 659 && $code <= 663) return 'VRIJ';
if ($code >= 664 && $code <= 664) return 'BCDM BE B1';
if ($code >= 665 && $code <= 665) return 'SPAA BE 22';
if ($code >= 666 && $code <= 666) return 'nav';
if ($code >= 667 && $code <= 667) return 'VRIJ';
if ($code >= 668 && $code <= 668) return 'SBIN BE 2X';
if ($code >= 669 && $code <= 669) return 'nav';
if ($code >= 670 && $code <= 670) return 'VRIJ';
if ($code >= 671 && $code <= 671) return 'EURB BE 99';
if ($code >= 672 && $code <= 672) return 'GKCC BE BB';
if ($code >= 673 && $code <= 673) return 'HBKA BE 22';
if ($code >= 674 && $code <= 674) return 'ABNA BE BR';
if ($code >= 675 && $code <= 675) return 'BYBB BE BB';
if ($code >= 676 && $code <= 676) return 'DEGR BE BB';
if ($code >= 677 && $code <= 677) return 'VRIJ';
if ($code >= 678 && $code <= 678) return 'DELE BE 22';
if ($code >= 679 && $code <= 679) return 'PCHQ BE BB';
if ($code >= 680 && $code <= 680) return 'GKCC BE BB';
if ($code >= 681 && $code <= 681) return 'VRIJ';
if ($code >= 682 && $code <= 683) return 'GKCC BE BB';
if ($code >= 684 && $code <= 684) return 'VRIJ';
if ($code >= 685 && $code <= 686) return 'BOFA BE 3X';
if ($code >= 687 && $code <= 687) return 'MGTC BE BE';
if ($code >= 688 && $code <= 688) return 'SGAB BE B2';
if ($code >= 689 && $code <= 689) return 'VRIJ';
if ($code >= 690 && $code <= 690) return 'BNPA BE BB';
if ($code >= 691 && $code <= 691) return 'FTSB NL 2R';
if ($code >= 692 && $code <= 692) return 'nav';
if ($code >= 693 && $code <= 693) return 'BOTK BE BX';
if ($code >= 694 && $code <= 694) return 'BDCH BE 22';
if ($code >= 695 && $code <= 695) return 'VRIJ';
if ($code >= 696 && $code <= 696) return 'CRLY BE BB';
if ($code >= 697 && $code <= 699) return 'VRIJ';
if ($code >= 700 && $code <= 709) return 'AXAB BE 22';
if ($code >= 710 && $code <= 719) return 'VRIJ';
if ($code >= 720 && $code <= 724) return 'ABNA BE BR';
if ($code >= 725 && $code <= 727) return 'KRED BE BB';
if ($code >= 728 && $code <= 729) return 'CREG BE BB';
if ($code >= 730 && $code <= 731) return 'KRED BE BB';
if ($code >= 732 && $code <= 732) return 'CREG BE BB';
if ($code >= 733 && $code <= 741) return 'KRED BE BB';
if ($code >= 742 && $code <= 742) return 'CREG BE BB';
if ($code >= 743 && $code <= 749) return 'KRED BE BB';
if ($code >= 750 && $code <= 774) return 'AXAB BE 22';
if ($code >= 775 && $code <= 799) return 'GKCC BE BB';
if ($code >= 800 && $code <= 816) return 'AXAB BE 22';
if ($code >= 817 && $code <= 824) return 'VRIJ';
if ($code >= 825 && $code <= 826) return 'DEUT BE BE';
if ($code >= 827 && $code <= 827) return 'ETHI BE BB';
if ($code >= 828 && $code <= 828) return 'HBKA BE 22';
if ($code >= 829 && $code <= 829) return 'NYA';
if ($code >= 830 && $code <= 839) return 'GKCC BE BB';
if ($code >= 840 && $code <= 840) return 'PRIB BE BB';
if ($code >= 841 && $code <= 841) return 'COVE BE 71';
if ($code >= 842 && $code <= 842) return 'UBSW BE BB';
if ($code >= 843 && $code <= 843) return 'BCRT BE B1';
if ($code >= 844 && $code <= 844) return 'RABO BE 22';
if ($code >= 845 && $code <= 845) return 'DEGR BE BB';
if ($code >= 846 && $code <= 846) return 'IRVT BE B1';
if ($code >= 847 && $code <= 848) return 'VRIJ';
if ($code >= 849 && $code <= 849) return 'BPPB BE B1';
if ($code >= 850 && $code <= 853) return 'SPAA BE 22';
if ($code >= 854 && $code <= 858) return 'VRIJ';
if ($code >= 859 && $code <= 863) return 'SPAA BE 22';
if ($code >= 864 && $code <= 864) return 'VRIJ';
if ($code >= 865 && $code <= 866) return 'SPAA BE 22';
if ($code >= 867 && $code <= 867) return 'VRIJ';
if ($code >= 868 && $code <= 868) return 'SPAA BE 22';
if ($code >= 869 && $code <= 869) return 'NAP';
if ($code >= 870 && $code <= 872) return 'BNAG BE BB';
if ($code >= 873 && $code <= 873) return 'PCHQ BE BB';
if ($code >= 874 && $code <= 874) return 'BNAG BE BB';
if ($code >= 875 && $code <= 876) return 'VRIJ';
if ($code >= 877 && $code <= 879) return 'BNAG BE BB';
if ($code >= 880 && $code <= 889) return 'HBKA BE 22';
if ($code >= 890 && $code <= 899) return 'VDSP BE 91';
if ($code >= 900 && $code <= 902) return 'NAP';
if ($code >= 903 && $code <= 903) return 'COBA BE BB';
if ($code >= 904 && $code <= 904) return 'VRIJ';
if ($code >= 905 && $code <= 905) return 'BHBE BE B1';
if ($code >= 906 && $code <= 906) return 'GOFF BE 22';
if ($code >= 907 && $code <= 907) return 'SPAA BE 22';
if ($code >= 908 && $code <= 908) return 'CEKV BE 81';
if ($code >= 909 && $code <= 909) return 'nav';
if ($code >= 910 && $code <= 910) return 'HBKA BE 22';
if ($code >= 911 && $code <= 911) return 'nav';
if ($code >= 912 && $code <= 912) return 'nav';
if ($code >= 913 && $code <= 919) return 'VRIJ';
if ($code >= 920 && $code <= 923) return 'HBKA BE 22';
if ($code >= 924 && $code <= 924) return 'VRIJ';
if ($code >= 925 && $code <= 925) return 'HBKA BE 22';
if ($code >= 926 && $code <= 928) return 'VRIJ';
if ($code >= 929 && $code <= 939) return 'HBKA BE 22';
if ($code >= 940 && $code <= 940) return 'CLIQ BE B1';
if ($code >= 941 && $code <= 941) return 'VRIJ';
if ($code >= 942 && $code <= 942) return 'PUIL BE BB';
if ($code >= 943 && $code <= 943) return 'nav';
if ($code >= 944 && $code <= 944) return 'VRIJ';
if ($code >= 945 && $code <= 945) return 'JPMG BE BB';
if ($code >= 946 && $code <= 946) return 'VRIJ';
if ($code >= 947 && $code <= 947) return 'AARB BE B1';
if ($code >= 948 && $code <= 948) return 'VRIJ';
if ($code >= 949 && $code <= 949) return 'HSBC BE BB';
if ($code >= 950 && $code <= 959) return 'CTBK BE BX';
if ($code >= 960 && $code <= 960) return 'ABNA BE BR';
if ($code >= 961 && $code <= 961) return 'HBKA BE 22';
if ($code >= 962 && $code <= 962) return 'ETHI BE BB';
if ($code >= 963 && $code <= 963) return 'AXAB BE 22';
if ($code >= 964 && $code <= 964) return 'NAP';
if ($code >= 965 && $code <= 965) return 'ETHI BE BB';
if ($code >= 966 && $code <= 966) return 'NAP';
if ($code >= 967 && $code <= 967) return 'VRIJ';
if ($code >= 968 && $code <= 968) return 'ENIB BE BB';
if ($code >= 969 && $code <= 969) return 'PUIL BE BB';
if ($code >= 970 && $code <= 971) return 'HBKA BE 22';
if ($code >= 972 && $code <= 972) return 'NAP';
if ($code >= 973 && $code <= 973) return 'ARSP BE 22';
if ($code >= 974 && $code <= 974) return '-';
if ($code >= 975 && $code <= 975) return 'AXAB BE 22';
if ($code >= 976 && $code <= 976) return 'HBKA BE 22';
if ($code >= 977 && $code <= 977) return 'VRIJ';
if ($code >= 978 && $code <= 980) return 'ARSP BE 22';
if ($code >= 981 && $code <= 984) return 'PCHQ BE BB';
if ($code >= 985 && $code <= 988) return 'BPOT BE B1';
if ($code >= 989 && $code <= 989) return 'nav';
if ($code >= 990 && $code <= 999) return '';
}

function bewerkRechtenVoorOverleg($overlegID) {
  if ($_SESSION['profiel']=="listel") return true;

  $info = getUniqueRecord("select * from overleg, patient.actief, patient.gem_id where id = $overlegID and code = patient_code");

  if ($info['actief']==0 || $info['afgerond']==1) return false;

  switch ($_SESSION['profiel']) {
    case "OC":
      $gemeente = getUniqueRecord("select * from gemeente where id = {$info['gem_id']}");
      return ($info['toegewezen_genre']=="gemeente" && $gemeente['zip']==$_SESSION['overleg_gemeente']);
      break;
    case "hoofdproject":
    case "bijkomend project":
      if ($info['actief']==1) return false;
      $tpInfo = getUniqueRecord("select * from patient_tp where patient = '{$info['code']}' and actief = 1");
      return ($tpInfo['project']==$_SESSION['tp_project']);
      break;
    case "caw":
      return false;
      break;
    case "rdc":
      return ($info['toegewezen_genre']=="rdc" && $info['toegewezen_id']==$_SESSION['organisatie']);
      break;
    case "hulp":
      return ($info['toegewezen_genre']=="hulp" && $info['toegewezen_id']==$_SESSION['usersid']);
      break;
    case "psy":
      return ($info['toegewezen_genre']=="psy" && $info['toegewezen_id']==$_SESSION['organisatie']);
      break;
    case "patient":
      return false;
      break;
    case "mantel":
      return false;
      break;
  }
}

function toonRechten($soort, $voorwaardeKolom, $voorwaardeWaarde, $magVeranderen) {
  $divID = "{$soort}Rechten{$voorwaardeWaarde}";
  
  
  print("&nbsp;&nbsp;<img src=\"../images/oog_half.jpg\" width=\"18\" alt=\"rechten\" onclick=\"vertoon('$divID');\"/>");
  
  print("\n<div id=\"$divID\" style=\"display:none;\"><p>Let op! Een persoon kan enkel een bijlage zien wanneer hij/zij rechten heeft voor het overleg <strong>&eacute;n</strong> voor de bijlage. Het volstaat dus <u>niet</u> om enkel het oogje hier open te zetten.</p>\n");

  toonRechtenDeel("select hvl.naam, hvl.voornaam, hvl.id, recht.rechten from hulpverleners hvl, {$soort}_rechten recht
                   where (recht.genre = 'hulp' or recht.genre = 'orgpersoon')
                     and hvl.id = recht.id
                     and $voorwaardeKolom = \"$voorwaardeWaarde\"", 'hulp', $divID, $soort, $voorwaardeWaarde, $magVeranderen);
/* mantelzorgers en patient voorlopig nog geen rechten geven
  toonRechtenDeel("select hvl.naam, hvl.voornaam, hvl.id, recht.rechten from mantelzorgers hvl, {$soort}_rechten recht
                   where recht.genre = 'mantel'
                     and hvl.id = recht.id
                     and $voorwaardeKolom = \"$voorwaardeWaarde\"", 'mantel', $divID, $soort, $voorwaardeWaarde, $magVeranderen);
  toonRechtenDeel("select 'patient' as naam, '' as voornaam, 0 as id, recht.rechten from patient, {$soort}_rechten recht
                   where (recht.genre = 'patient')
                     and patient.code = \"{$_SESSION['pat_code']}\"
                     and $voorwaardeKolom = \"$voorwaardeWaarde\"", 'patient', $divID, $soort, $voorwaardeWaarde, $magVeranderen);
*/
  print("</div><!-- einde $divID -->\n");
}

function toonRechtenDeel($qry, $genre, $divID, $soort, $sleutel, $magVeranderen) {
  $resultDeel = mysql_query($qry) or print("Ik kan een stuk van de rechten niet tonen omdat $qry volgende fout geeft.<br/>" . mysql_error());
  if (mysql_num_rows($resultDeel)==0) return;

  if ($soort == "overleg_files") $kolom = "bijlage";
  else $kolom = "evaluatieID";
  
  $JSRechten = "";
  print("<table>");
  for ($i=0; $i<mysql_num_rows($resultDeel); $i++) {
    $mensRechten = mysql_fetch_assoc($resultDeel);
    if ($i%3==0) print("<tr>");
    
    $persoonImgID = "{$divID}{$genre}{$mensRechten['id']}";
    $JSRechten .= "rechten['$persoonImgID']={$mensRechten['rechten']};\n";

    if ($magVeranderen) {
      $onclick = " onclick=\"veranderRechtenExtras('$persoonImgID', '$kolom', '$sleutel', '$genre', {$mensRechten['id']});\"";
      $titleNiet = " title=\"klik om rechten toe te kennen\"";
      $titleWel = " title=\"klik om rechten af te nemen\"";
    }
    else {
      $onclick = "";
      $titleNiet = " title=\"heeft geen rechten\"";
      $titleWel = " title=\"heeft wel rechten\"";
    }

    if ($mensRechten['rechten']==0) {
      $rechtenImg = "\n      <td><img id=\"$persoonImgID\" width=\"18\" src=\"../images/oog_dicht.jpg\" alt=\"geen rechten\" $onclick $titleNiet/></td>";
    }
    else {
      $rechtenImg = "\n      <td><img id=\"$persoonImgID\" width=\"18\" src=\"../images/oog_open.jpg\" alt=\"wel rechten\"  $onclick $titleWel/></td>";
    }
    print("<td style=\"font-size:9px;\">{$mensRechten['naam']} {$mensRechten['voornaam']}</td> $rechtenImg");
    
    if (i%3==2) print("</tr>");
  }
  if (i%3>0) print("</tr>");
  print("</table>\n");
  print("<script type=\"text/javascript\">$JSRechten</script>\n");
}

function isZorgBemiddelaar() {
  if ($_SESSION['profiel']=="OC") return false;
  if ($_SESSION['profiel']=="rdc") return false;
  if ($_SESSION['profiel']=="listel") return false;
  if ($_SESSION['profiel']=="psy") return false;
  if ($_SESSION['profiel']=="super") return true;
  // profiel is hulp
  $laatsteOverlegResult = mysql_query("select * from overleg where patient_code = \"{$_SESSION['pat_code']}\" order by datum desc");
  if (mysql_num_rows($laatsteOverlegResult)==0) return false;
  
  $laatsteOverleg = mysql_fetch_assoc($laatsteOverlegResult);
  return ($laatsteOverleg['contact_hvl']==$_SESSION['usersid']);
}

function getZorgBemiddelaarVan($rijksregister) {
  $laatsteOverlegResult = mysql_query("select naam, voornaam, code, contact_hvl, contact_mz from overleg inner join patient on rijksregister = $rijksregister and patient_code = code and toestemming_zh = 1 order by datum desc");
  if (mysql_num_rows($laatsteOverlegResult)==0) return -1;

  $laatsteOverleg = mysql_fetch_assoc($laatsteOverlegResult);
  if ($laatsteOverleg['contact_hvl']!=0) {
    // zoek hvl
    $queryHVL = "
         SELECT
                h.id,
                h.naam as hvl_naam,
                h.voornaam as hvl_voornaam,
                h.adres,
                h.tel, h.gsm, h.email,
                f.naam as fnct_naam,
                h.riziv1, h.riziv2, h.riziv3,
                org.naam as partner_naam,
                org.id as partner_id,
                org.id as organisatie,
                org.gem_id as partner_gem_id,
                org.adres as partner_adres,
                org.tel as partner_tel,
                g.dlzip,
                g.dlnaam
            FROM
                functies f,
                gemeente g,
                hulpverleners h
                LEFT JOIN organisatie org ON ( org.id = h.organisatie )
            WHERE
                h.fnct_id = f.id AND
                h.id = {$laatsteOverleg['contact_hvl']} AND
                g.id = h.gem_id
            ORDER BY
                f.rangorde"; // Query
      if ($resultHVL=mysql_query($queryHVL))
      {
         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)
         {
            $recordsHVL= mysql_fetch_array($resultHVL);
            $veld1=($recordsHVL['hvl_naam']!="")    ?$recordsHVL['hvl_naam']    :"&nbsp;";
            $veld2=($recordsHVL['hvl_voornaam']!="")?$recordsHVL['hvl_voornaam']:"&nbsp;";
            $veld3=($recordsHVL['fnct_naam']!="")   ?$recordsHVL['fnct_naam']   :"&nbsp;";
            //$veld3=($recordsHVL['betrokhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;
            $partner=(($recordsHVL['partner_id']==999)OR($recordsHVL['partner_id']==1000))?"":"<br />".$recordsHVL['partner_naam'];
            $veld3=$veld3.$partner;
            $rizivnr=   substr($recordsHVL['riziv1'],0,1)."-".
                        substr($recordsHVL['riziv1'],1,5)."-".
                        $recordsHVL['riziv2']."-".$recordsHVL['riziv3'];

            $hvl_adres=     $recordsHVL['adres'];
            $hvl_dlzip=     $recordsHVL['dlzip'];
            $hvl_dlnaam=    $recordsHVL['dlnaam'];
            $hvl_tel=       $recordsHVL['tel'];
            $hvl_gsm=       $recordsHVL['gsm'];
            $hvl_email=     $recordsHVL['email'];
            $partner_adres= $recordsHVL['partner_adres'];
            $partner_tel=   $recordsHVL['partner_tel'];
            $partner_gsm=   $recordsHVL['partner_gsm'];
            //-------------------------------------------------------------------
            // indien een hvl werkt voor een partner toon deze dan
            $partner=       (($recordsHVL['partner_id']==999)OR($recordsHVL['partner_id']==1000))?"":"<br />".
                                    $recordsHVL['partner_naam'];
                $qry8="SELECT dlzip,dlnaam FROM gemeente WHERE id=".$recordsHVL['partner_gem_id'];
                if (isset($recordsHVL['partner_gem_id']) && $recordsHVL['partner_gem_id'] != 9999) {
                  $gemeente=mysql_fetch_array(mysql_query($qry8));
                  $partner_dlzip=$gemeente['dlzip'];
                  $partner_dlnaam=$gemeente['dlnaam'];
                }
            // heeft deze hvl geen adres, gebruik de partner dan
            if($hvl_adres=="")
                {
                $hvl_adres=$partner_adres;
                $hvl_dlzip=$partner_dlzip;
                $hvl_dlnaam=$partner_dlnaam;
              }
            if ($hvl_dlzip == -1) $hvl_dlzip = "";
            //-------------------------------------------------------------------
            //-------------------------------------------------------------------
            // heeft deze hvl geen telefoon/gsm, gebruik de partner dan
            $hvl_tel=(trim($hvl_tel)=="")?$partner_tel:trim($hvl_tel);
            $hvl_gsm=(trim($hvl_gsm)==0)?$partner_gsm:$recordsHVL['gsm'];
            //-------------------------------------------------------------------

            return "<table>
                     <tr>
                       <th colspan=\"2\">Er is een zorgplan geregistreerd voor <br/><em>{$laatsteOverleg['voornaam']} {$laatsteOverleg['naam']}({$laatsteOverleg['code']})</em>.<br/>
                           De zorgbemiddelaar is volgende zorg- of hulpverlener.
                       </th>
                     </tr>
                     <tr>
                     <td valign=\"top\">$veld1 $veld2<br />
                       $hvl_adres<br /> $hvl_dlzip $hvl_dlnaam <br />
                       $hvl_tel  $hvl_gsm <br/>{$recordsHVL['email']}</td>
                     <td valign=\"top\">$veld3</td>
                     </tr></table>";
            }}
  }
  else if ($laatsteOverleg['contact_mz']!=0) {
    // zoek mz
    $query = "
         SELECT
                m.*,
                v.naam as verwsch_naam,
                v.rangorde,
                gemeente.dlzip, gemeente.dlnaam
            FROM
                verwantschap v,
                mantelzorgers m
                LEFT JOIN gemeente ON (gemeente.id = m.gem_id)
            WHERE
                v.id = m.verwsch_id AND
                m.id = {$laatsteOverleg['contact_mz']}
            ORDER BY
                v.rangorde,m.naam";
      if ($result=mysql_query($query))
      {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
         {
            $records= mysql_fetch_array($result);
            $veld1=($records['naam']!="")?$records['naam']:"&nbsp;";
            $veld2=($records['voornaam']!="")?$records['voornaam']:"&nbsp;";
            //$markering_o=($records['betrokmz_contact']==1)?"<b>":"";
            //$markering_s=($records['betrokmz_contact']==1)?"</b>":"";
            if ($records['dlzip']==-1) $records['dlzip'] = "";
            if (isset($records['adres']) && $records['adres'] != "")
            $adres =   "{$records['adres']}, {$records['dlzip']} {$records['dlnaam']}<br />";
            return "<table>
                     <tr>
                       <th colspan=\"2\">Er is een zorgplan geregistreerd op naam van <br/><em>{$laatsteOverleg['voornaam']} {$laatsteOverleg['naam']}({$laatsteOverleg['code']})</em>.<br/>
                           De zorgbemiddelaar is volgende mantelzorger.
                       </th>
                     </tr>
                      <tr>
                        <td valign=\"top\"><br />$veld1 $veld2 <br />
                            $adres <br/>
                            {$records['tel']} {$records['gsm']}<br/> {$records['email']}</td>
                        <td valign=\"top\"><br />{$records['verwsch_naam']} </td>
                      </tr>
                   </table>";
         }
      }
  }
  else {
    return -1;
  }
}


function isNuOrganisator() {
  $laatsteOverlegResult = mysql_query("select * from overleg where patient_code = \"{$_SESSION['pat_code']}\" and afgerond = 0") or die("foutje");
  if (mysql_num_rows($laatsteOverlegResult)==0)
    $laatsteOverlegResult = mysql_query("select * from patient where code = \"{$_SESSION['pat_code']}\"") or die("foutje2");

  $laatsteOverleg = mysql_fetch_assoc($laatsteOverlegResult);

  if ($_SESSION['profiel']=="OC") return $laatsteOverleg['toegewezen_genre']=="gemeente";
  if ($_SESSION['profiel']=="rdc") return ($laatsteOverleg['toegewezen_genre']=="rdc") && ($laatsteOverleg['toegewezen_id']==$_SESSION['organisatie']);
  if ($_SESSION['profiel']=="listel") return false;
  if ($_SESSION['profiel']=="super") return true;
  if ($_SESSION['profiel']=="hulp") return ($laatsteOverleg['toegewezen_genre']=="hulp") && ($laatsteOverleg['toegewezen_id']==$_SESSION['usersid']);
  if ($_SESSION['profiel']=="psy") return ($laatsteOverleg['toegewezen_genre']=="psy") && ($laatsteOverleg['toegewezen_id']==$_SESSION['organisatie']);
}

function isOrganisatorVan($overleg) {
  $laatsteOverlegResult = mysql_query("select * from overleg where id = $overleg") or die("foutje");
  if (mysql_num_rows($laatsteOverlegResult)==0) return false;

  $laatsteOverleg = mysql_fetch_assoc($laatsteOverlegResult);

  if ($_SESSION['profiel']=="OC") return $laatsteOverleg['toegewezen_genre']=="gemeente";
  if ($_SESSION['profiel']=="rdc") return ($laatsteOverleg['toegewezen_genre']=="rdc") && ($laatsteOverleg['toegewezen_id']==$_SESSION['organisatie']);
  if ($_SESSION['profiel']=="listel") return false;
  if ($_SESSION['profiel']=="super") return true;
  if ($_SESSION['profiel']=="hulp") return ($laatsteOverleg['toegewezen_genre']=="hulp") && ($laatsteOverleg['toegewezen_id']==$_SESSION['usersid']);
  if ($_SESSION['profiel']=="psy") return ($laatsteOverleg['toegewezen_genre']=="psy") && ($laatsteOverleg['toegewezen_id']==$_SESSION['organisatie']);
}

function patientenVanOrganisator($soort, $id, $order) {
  if ($soort == "hulp") {
    $qry = "select * from patient where toegewezen_genre = 'hulp' and toegewezen_id = $id order by $order";
  }
  else if ($soort == "rdc") {
    $qry = "select * from patient where toegewezen_genre = 'rdc' and toegewezen_id = $id order by $order";
  }
  else if ($soort == "OC") {
    $qry = "select patient.* from patient, gemeente where toegewezen_genre = 'gemeente' AND gem_id=gemeente.id and gemeente.zip = $id order by $order";
  }
  else if ($soort == "menos") {
    $qry = "select patient.* from patient where menos = 1 order by $order";
  }
  else if ($soort == "psy") {
    $qry = "select patient.* from patient where toegewezen_genre = 'psy' and toegewezen_id = $id order by $order";
  }
  else {
    // TP
    $qry = "select * from patient inner join patient_tp on patient.code = patient_tp.patient
              where patient_tp.actief = 1 and patient_tp.project = $id order by $order";
  }
  //print($qry);
  if ($result = mysql_query($qry)) {
    return $result;
  }
  else {
    die("$qry geeft volgende fout bij het ophalen van patienten voor organisator: " . mysql_error());
  }
}

function aantalPatientenVanOrganisator($soort, $id) {
  return mysql_num_rows(patientenVanOrganisator($soort, $id, "patient.id"));
}

function afTeRondenOverleg($soort, $id, $persoon) {
  echo getAfTeRondenOverleg($soort, $id, $persoon, "", "");
}

function updateAanvragen($soort, $id, $persoon) {
  //return ""; //HIERHIER
  $vandaag = date("Ymd");
  if ($soort=="menos") {
    $query = "select distinct a.*, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                  1 as juist
              from (aanvraag_overleg a inner join patient p on p.rijksregister = a.rijksregister)
            where
               (p.actief = 0 and p.menos = 1)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="OC") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'gemeente') as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
                                       inner join gemeente on (gemeente.id = gem_id or gemeente.id = gemeente_id)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'ocmw'
               and gemeente.zip = $id
               and (p.actief is null or p.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam

            ";
  }
  else if ($soort=="rdc") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'rdc' and toegewezen_id = $id) as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'rdc'
               and id_organisator = $id
               and (p.actief is null or p.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="hulp") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'hulp' and toegewezen_id = $persoon) as juist
              from hulpverleners hvl inner join aanvraag_overleg a on (hvl.id = $persoon and (hvl.organisatie = a.id_organisator or hvl.id = a.id_organisator))
                                       left join patient p on (p.rijksregister = a.rijksregister)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'hulp'
               and (p.actief is null or p.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="psy") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                (toegewezen_genre = 'psy' and toegewezen_id = $id) as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister)
            where
               keuze_organisator = 'psy'
               and id_organisator = $id
               and (p.actief is null or p.actief = 1)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";
  }
  else {  // TP
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                 1 as juist
              from (aanvraag_overleg a inner join patient p on p.rijksregister = a.rijksregister)
                                       inner join patient_tp on p.code = patient_tp.patient
            where
               patient_tp.project = $id
               and (patient_tp.actief = 1 and p.actief <> 0)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";
  }
  $pats = mysql_query($query) or die("$query " . mysql_error());

  $today = date("d/m/Y");

  if (mysql_num_rows($pats)>0) {
    for ($i = 0; $i < mysql_num_rows($pats); $i++) {
      $patient = mysql_fetch_assoc($pats);
      mysql_query("update aanvraag_overleg set ontvangst = '$today' where (ontvangst is null or ontvangst = '') and id = {$patient['id']}")
        or die("Kan aanvraag niet updaten " . mysql_error());
    }
  }
  else {

  }
  return $tekst;
}

function getAangevraagdeOverleggen($soort, $id, $persoon) {
  //return ""; // HIERHIER
  global $siteadres;
  $tekst = "";
  $vandaag = date("Ymd");
  if ($soort=="menos") {
    $query = "select distinct a.*, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id, p.type, p.actief,
                  1 as juist
              from (aanvraag_overleg a inner join patient p on p.rijksregister = a.rijksregister)
            where
               (p.actief = 0 and p.menos = 1)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="OC") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,  p.type, p.actief,
                (toegewezen_genre = 'gemeente') as juist
              from (aanvraag_overleg a left join patient p on (p.rijksregister = a.rijksregister and p.rijksregister > 0) or (a.patient_code = p.code and a.patient_code <> ''))
                                       left join gemeente on (gemeente.id = p.gem_id or gemeente.id = gemeente_id)
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'ocmw'
               and gemeente.zip = $id
               and (p.actief is null or p.actief = 1 or p.actief = 0 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="rdc") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id, p.type, p.actief,
                (toegewezen_genre = 'rdc' and toegewezen_id = $id) as juist
              from (aanvraag_overleg a left join patient p on (p.rijksregister = a.rijksregister and p.rijksregister > 0) or (a.patient_code = p.code and a.patient_code <> ''))
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'rdc'
               and id_organisator = $id
               and (p.actief is null or p.actief = 1 or p.actief = 0 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="hulp") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id, p.type, p.actief,
                (toegewezen_genre = 'hulp' and toegewezen_id = $persoon) as juist
              from hulpverleners hvl inner join aanvraag_overleg a on (hvl.id = $persoon and hvl.organisatie = a.id_organisator)
                                       left join patient p on (p.rijksregister = a.rijksregister and p.rijksregister > 0) or (a.patient_code = p.code and a.patient_code <> '')
                                       left join patient_tp on p.code = patient_tp.patient
            where
               keuze_organisator = 'hulp'
               and (p.actief is null or p.actief = 1 or p.actief = 0 or (patient_tp.actief = 1 and rechtenOC <= $vandaag))
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam
            ";
  }
  else if ($soort=="listel") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id, p.type, p.actief,
                 1 as juist
              from (aanvraag_overleg a left join patient p on (p.rijksregister = a.rijksregister and p.rijksregister > 0) or (a.patient_code = p.code and a.patient_code <> ''))
            where
               a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam";
  }
  else if ($soort=="psy") {
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id, p.type, p.actief,
                (toegewezen_genre = 'psy' and toegewezen_id = $id) as juist
              from (aanvraag_overleg a left join patient p on (p.rijksregister = a.rijksregister and p.rijksregister > 0) or (a.patient_code = p.code and a.patient_code <> ''))
            where
               keuze_organisator = 'psy'
               and id_organisator = $id
               and (p.actief is null or p.actief = 1)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam
            ";
  }
  else {  // TP
    $query = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id, p.type, p.actief,
                 1 as juist
              from (aanvraag_overleg a inner join patient p on p.rijksregister = a.rijksregister)
                                       inner join patient_tp on p.code = patient_tp.patient
            where
               patient_tp.project = $id
               and (patient_tp.actief = 1 and p.actief <> 0)
               and a.status in ('aanvraag','overname','overname_aangevraagd')
            order by dringend*1000 + (toegewezen_genre is not null)*100 + juist*10+(p.code is not null) desc, pat_naam
            ";
  }
  
  $pats = mysql_query($query) or die("$query " . mysql_error());

  //$tekst .= $query;
//print($query);
  $headerBestaande = true;
  $headerOvername = true;
  $headerNieuw = true;
  $dringend = 0;
  
  if (mysql_num_rows($pats)>0) {
    for ($i = 0; $i < mysql_num_rows($pats); $i++) {
      $patient = mysql_fetch_assoc($pats);
      foreach ($patient as $key => $value) {
        $patient[$key] = utf8_decode($patient[$key]);
      }
      if ($dringend == 0 && $patient['dringend']==1) {
        $dringend = 1;
        $tekst .= "<h1>Dringende aanvragen voor een overleg</h1>\n";
      }
      else if (($dringend == 0 && $patient['dringend']==0) || ($dringend == 1 && $patient['dringend']==0)) {
        $dringend = 2;
        if (!($headerBestaande && $headerOvername && $headerNieuw)) {
          $tekst .= "</ul>";
        }
        $headerBestaande = true;
        $headerOvername = true;
        $headerNieuw = true;
        $tekst .= "<h1>Niet-dringende aanvragen voor een overleg</h1>\n";
      }
      if ($headerBestaande && $patient['juist']==1) {
        $headerBestaande = false;
        $linksoort = "overleg";
        $tekst .= "<h3>&nbsp;&nbsp;&nbsp;Bestaande zorgplannen</h3><ul>\n";
      }
      else if ($headerOvername && $patient['juist']==0 && $patient['code']!="") {
        if (!($headerBestaande)) {
          $tekst .= "</ul>";
        }
        $headerOvername = false;
        $linksoort = "overname";
        $tekst .= "<h3>&nbsp;&nbsp;&nbsp;Over te nemen zorgplannen</h3><ul>\n";
      }
      else if ($headerNieuw && $patient['code']=="") {
        if (!($headerBestaande && $headerOvername)) {
          $tekst .= "</ul>";
        }
        $headerNieuw = false;
        $linksoort = "nieuw";
        $tekst .= "<h3>&nbsp;&nbsp;&nbsp;Nieuwe zorgplannen</h3><ul>\n";
      }
      // en nu de info over de aanvraag afdrukken!
      if ($patient['code']=="") {
        $info = "Rijksregister " . $patient['rijksregister'];
      }
      else {
        if ($patient['type']==16 || $patient['type']==18)
          $info = "{$patient['pat_naam']} {$patient['voornaam']} ({$patient['code']}-PSY)";
        else
          $info = "{$patient['pat_naam']} {$patient['voornaam']} ({$patient['code']})";
      }
      $nietWeigeren = false;
      if ($patient['code']!="" && $patient['actief']==0) {
        $archief = " (ARCHIEF) ";
        $linksoortKopie = $linksoort;
        $linksoort = "archief";
      }
      else {
        $archief = "";
      }
      switch ($linksoort) {
         case "overleg":
           $linktitel = "<a href=\"overleg_alles.php?patient={$patient['code']}&aanvraag={$patient['id']}\">maak een overleg</a>";
           break;
         case "overname":
           if ($patient['status'] == "aanvraag" || $patient['status'] == "overname")
              $linktitel = "<a href=\"patient_overnemen.php?code={$patient['code']}&aanvraag={$patient['id']}\" target=\"_blank\">Doe aanvraag tot overname</a>";
           else {
              $linktitel = "<em>de overname is aangevraagd</em>";
              $nietWeigeren = true;
           }
           break;
         case "archief":
           $linktitel = "<a href=\"patient_aanpassen.php?patient={$patient['code']}&activeer=1\" onclick=\"return confirm('Ben je zeker dat je {$patient['pat_naam']} {$patient['voornaam']} uit archief wil halen?');\">haal uit archief</a>";
           $linksoort = $linksoortKopie;
           break;
         case "nieuw":
           $linktitel = "<a href=\"patient_nieuw.php?rr={$patient['rijksregister']}\">cre&euml;er nieuwe patient</a>";
           break;
      }

      $datum = date("d/m/Y",$patient['timestamp']);
      $tekst .= "<li>$info $archief op $datum: $linktitel";
      if ($nietWeigeren) {
        $tekst .= "</li>\n";
      }
      else {
        $tekst .= " of <a href=\"aanvraag_overleg_weigeren.php?aanvraag={$patient['id']}\">weiger</a></li>\n";
      }
      if ($soort == "listel") {
        if ($patient['keuze_organisator']=="ocmw") {
          $aangevraagd = "ocmw";
        }
        else {
          if ($patient['id_organisator']>0) {
            $aangevraagdRecord = getFirstRecord("select naam from organisatie where id = {$patient['id_organisator']}");
            $aangevraagd = $aangevraagdRecord['naam'];
          }
          else {
            $aangevraagd = "?";
          }
        }
        $orgTekst = "Aangevraagd bij: $aangevraagd<br/>";
      }
      
      $doel = "";
      if ($patient['doel_informeren']==1) {
        if ($doel != "") $doel .= ", informeren";
        else $doel = "informeren";
      }
      if ($patient['doel_overtuigen']==1) {
        if ($doel != "") $doel .= ", overtuigen";
        else $doel = "overtuigen";
      }
      if ($patient['doel_organiseren']==1) {
        if ($doel != "") $doel .= ", organiseren";
        else $doel = "organiseren";
      }
      if ($patient['doel_debriefen']==1) {
        if ($doel != "") $doel .= ", debriefen";
        else $doel = "debriefen";
      }
      if ($patient['doel_beslissen']==1) {
        if ($doel != "") $doel .= ", beslissen";
        else $doel = "beslissen";
      }
      if ($patient['doel_andere']!="") {
        if ($doel != "") $doel .= ", {$patient['doel_andere']}";
        else $doel = "{$patient['doel_andere']}";
      }
      if ($patient['naam_aanvrager'] == "patient") {
        $infoAanvrager = "pati&euml;nt";
        
      }
      else {
        $infoAanvrager = "{$patient['naam_aanvrager']}, {$patient['discipline_aanvrager']}, {$patient['organisatie_aanvrager']} {$patient['info_aanvrager']}";
      }
      $tekst .= "<div style=\"margin-left:20px;font-size:90%;background-color: #f0e5d6;width:500px;\">Aanvrager: $infoAanvrager <br/>
                                           $orgTekst
                                           Doel: {$doel} <br/>&nbsp;  </div>\n";
    }
    $tekst .= ("</ul>");
  }
  else {

  }
  return $tekst;
}

function getAfTeRondenOverleg($soort, $id, $persoon, $voorwaarde, $beschrijving) {
  global $siteadres;
  $txt = "";
  if ($soort=="menos") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, overleg.datum, overleg.keuze_vergoeding, overleg.genre from overleg, patient
            where overleg.patient_code = patient.code
            and afgerond = 0
            and overleg.genre = 'menos'
            $voorwaarde
            order by (keuze_vergoeding = 1)+(keuze_vergoeding=2) desc,datum asc
            ";
  }
  else if ($soort=="OC") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, overleg.datum, overleg.keuze_vergoeding, overleg.genre from overleg, gemeente, patient
                   left join patient_tp on patient.code = patient_tp.patient
            where overleg.patient_code = patient.code
            and afgerond = 0
            and gem_id=gemeente.id
            and gemeente.zip = $id
            and (patient.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= overleg.datum))
            and patient.toegewezen_genre = 'gemeente'
            and overleg.coordinator_id = $persoon
            AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy'))
            $voorwaarde
            order by (keuze_vergoeding = 1)+(keuze_vergoeding=2) desc,datum asc
            ";
  }
  else if ($soort=="rdc") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, overleg.datum, overleg.keuze_vergoeding, overleg.genre from overleg, patient
            where overleg.patient_code = patient.code
            and afgerond = 0
            and (patient.actief = 1)
            and patient.toegewezen_genre = 'rdc'
            and patient.toegewezen_id = $id
            and overleg.coordinator_id = $persoon
            AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy'))
            $voorwaarde
            order by (keuze_vergoeding = 1)+(keuze_vergoeding=2) desc,datum asc
            ";
  }
  else if ($soort=="hulp") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, overleg.datum, overleg.keuze_vergoeding, overleg.genre from overleg, patient
            where overleg.patient_code = patient.code
            and afgerond = 0
            and (patient.actief = 1)
            and patient.toegewezen_genre = 'hulp'
            and patient.toegewezen_id = $id
            and overleg.coordinator_id = $persoon
            AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy'))
            $voorwaarde
            order by (keuze_vergoeding = 1)+(keuze_vergoeding=2) desc,datum asc
            ";
  }
  else if ($soort=="psy") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, overleg.datum, overleg.keuze_vergoeding, overleg.genre from overleg, patient
            where overleg.patient_code = patient.code
            and afgerond = 0
            and (patient.actief = 1)
            and patient.toegewezen_genre = 'psy'
            and patient.toegewezen_id = $id
            and overleg.coordinator_id = $persoon
            AND (overleg.genre = 'psy')
            $voorwaarde
            order by (keuze_vergoeding = 1)+(keuze_vergoeding=2) desc,datum asc
            ";
  }
  else {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, overleg.datum, overleg.keuze_vergoeding, overleg.genre from overleg, patient
                   inner join patient_tp on patient.code = patient_tp.patient
            where overleg.patient_code = patient.code
            and afgerond = 0
            and patient_tp.actief = 1 and patient.actief <> 0
            and patient_tp.project = $id
            and overleg.coordinator_id = $persoon
            AND (overleg.genre is NULL or overleg.genre in ('gewoon','TP','psy'))
            $voorwaarde
            order by (keuze_vergoeding = 1)+(keuze_vergoeding=2) desc,datum asc
            ";
  }

//  $txt .= "<h3>$query</h3>";
  $pats = mysql_query($query) or die("$query " . mysql_error());

  if (mysql_num_rows($pats)>0) {
    if ($beschrijving != "")  $dringend = "Dringend";
    else $dringend = "Nog";
    $titelNietVergoedbaar = false;
    for ($i = 0; $i < mysql_num_rows($pats); $i++) {
      $patient = mysql_fetch_array($pats);
      if ($i == 0 && ($patient['keuze_vergoeding']>0 || $patient['genre'] == "TP")) {
        $txt .= ("<h1>$dringend af te ronden vergoedbare overleggen</h1>\n");
        $txt .= ("<ul>\n");
      }
      else if (!$titelNietVergoedbaar && $patient['keuze_vergoeding']<1 && $patient['genre'] != "TP") {
        $txt .= ("</ul><h1>$dringend af te ronden niet-vergoedbare overleggen</h1>\n");
        $txt .= ("<ul>\n");
        $titelNietVergoedbaar = true;
      }
/*
      foreach ($patient as $key => $value) {
        $patient[$key] = utf8_decode($patient[$key]);
      }
*/
      $zestienDagenGeleden = date("Ymd",time()-16*24*60*60);
      $datum = substr($patient['datum'],6,2) . "/" . substr($patient['datum'],4,2) . "/" . substr($patient['datum'],0,4);

      if ($patient['datum'] < $zestienDagenGeleden) $txt .= "<strong>";
      $txt .= ("<li><a href=\"{$siteadres}/php/overleg_alles.php?tab=Teamoverleg&afronden=1&patient={$patient['code']}\">");
      $txt .= (patient_roepnaam($patient['code']) . ": overleg van $datum</a></li>\n");
      if ($patient['datum'] < $zestienDagenGeleden) $txt .= "</strong>";

    }
    $txt .= ("</ul>");
  }
  else {

  }
  return $txt;
}

function overTeDragenPatienten($soort, $id) {
  echo getOverTeDragenPatienten($soort, $id);
}
function getOverTeDragenPatienten($soort, $id) {
  global $siteadres;
    $txt = "";
    switch ($soort) {
       case "listel":
         $qry = "select * from aanvraag_overdracht, patient where patient.code = patient";
         break;
       case "OC":
         $qry = "select distinct aanvraag_overdracht.*, patient.naam, patient.voornaam from aanvraag_overdracht, logins, patient, gemeente
                       where logins.overleg_gemeente = $id
                         and van_genre = 'gemeente' and overleg_gemeente = gemeente.zip
                         and gemeente.id = patient.gem_id
                         and patient.code = patient";
         break;
       case "rdc":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient
                       where van_genre = 'rdc' and van_id = $id";
         break;
       case "hulp":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient
                       where van_genre = 'hulp' and van_id = $id";
         break;
       case "psy":
         $qry = "select * from aanvraag_overdracht inner join patient on patient.code = patient
                       where van_genre = 'psy' and van_id = $id";
         break;
       default: return "";
    }

    if ($qry=="") return "";
    
    $result = mysql_query($qry) or die("Opzoeken van alle aanvragen is niet gelukt omwille van " . mysql_error() . " in $qry");
    $aantal = mysql_num_rows($result);

    if ($aantal > 0) {
      $txt .= ("<h2>Aanvragen om het zorgplan over te nemen.</h2>\n");
      $txt .= ("<p>Keur deze goed via de link <a href=\"{$siteadres}/php/patient_overname_goedkeuren.php\">Over te dragen pati&euml;nten</a></p>\n");

      $txt .= ("<ul>");
      for ($i=0; $i<$aantal; $i++) {
        $rij = mysql_fetch_assoc($result);
/*
        foreach ($rij as $key => $value) {
          $rij[$key] = utf8_decode($rij[$key]);
        }
*/
        $txt .= ("<li>{$rij['patient']} - {$rij['voornaam']} {$rij['naam']} </li>\n");
      }
      $txt .= ("</ul>\n");
    }
    return $txt;
}

function tePlannen($soort, $id) {
  echo getTePlannen($soort, $id);
}
function getTePlannen($soort, $id) {
  $txt = "";
  if ($soort=="OC") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, patient.startdatum,
                     max(overleg.datum) as datum,
                     max(evaluatie.datum) as evaluatie_datum
                     from gemeente, patient
                   left join patient_tp on patient.code = patient_tp.patient
                   left join overleg on overleg.patient_code = patient.code
                   left join evaluatie on evaluatie.patient = patient.code
            where gem_id=gemeente.id
            and gemeente.zip = $id
            and (patient.actief = 1 or (patient_tp.actief = 1 and rechtenOC <= overleg.datum))
            and patient.toegewezen_genre = 'gemeente'
            group by patient.code
            order by greatest(max(overleg.datum), max(evaluatie.datum))";
  }
  else if ($soort=="rdc") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, patient.startdatum,
                     max(overleg.datum) as datum,
                     max(evaluatie.datum) as evaluatie_datum from patient
                   left join overleg on overleg.patient_code = patient.code
                   left join evaluatie on evaluatie.patient = patient.code
            where (patient.actief = 1)
            and patient.toegewezen_genre = 'rdc'
            and patient.toegewezen_id = $id
            group by patient.code
            order by greatest(max(overleg.datum), max(evaluatie.datum))";
  }
  else if ($soort=="hulp") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, patient.startdatum,
                     max(overleg.datum) as datum,
                     max(evaluatie.datum) as evaluatie_datum from patient
                   left join overleg on overleg.patient_code = patient.code
                   left join evaluatie on evaluatie.patient = patient.code
            where (patient.actief = 1)
            and patient.toegewezen_genre = 'hulp'
            and patient.toegewezen_id = $id
            group by patient.code
            order by greatest(max(overleg.datum), max(evaluatie.datum))";
  }
  else if ($soort=="psy") {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, patient.startdatum,
                     max(overleg.datum) as datum,
                     max(evaluatie.datum) as evaluatie_datum from patient
                   left join overleg on overleg.patient_code = patient.code
                   left join evaluatie on evaluatie.patient = patient.code
            where (patient.actief = 1)
            and patient.toegewezen_genre = 'psy'
            and patient.toegewezen_id = $id
            group by patient.code
            order by greatest(max(overleg.datum), max(evaluatie.datum))";
  }
  else {
    $query = "select patient.code as code, patient.naam as naam, patient.voornaam,
                     max(overleg.datum) as datum,
                     max(evaluatie.datum) as evaluatie_datum from patient
                   left join patient_tp on patient.code = patient_tp.patient
                   left join overleg on overleg.patient_code = patient.code
                   left join evaluatie on evaluatie.patient = patient.code
            where patient_tp.actief = 1 and patient.actief <> 0
            and patient_tp.project = $id
            group by patient.code
            order by greatest(max(overleg.datum), max(evaluatie.datum))";
  }

  $pats = mysql_query($query) or die("$query " . mysql_error());

  $aantal = 0;

  $txt .= ("<h1>Te plannen overleggen of evaluatie</h1>\n");
  $txt .= ("<ul>\n");
  for ($i = 0; $i < mysql_num_rows($pats); $i++) {
    $patient = mysql_fetch_array($pats);
/*
    foreach ($patient as $key => $value) {
      $patient[$key] = utf8_decode($patient[$key]);
    }
*/
    $jaar = date("Y")-1; //$jaar = date("Y");
    $maand = date("m");  //$maand = date("m")-3;
    $dag = date("d");    //$dag = date("d");
    if ($maand < 0) {
      $jaar--;
      $maand = $maand+12;
    }

    //$drieMaandGeleden = date("Ymd",time()-60*60*24*90); // 90 dagen geleden eigenlijk, maar soit
    $jaarGeleden = date("Ymd",time()-60*60*24*365);  // 365 dagen geleden
    if ($patient['datum']<$jaarGeleden && $patient['evaluatie_datum']<$jaarGeleden && $patient['begindatum']<$jaarGeleden) {
      if ($patient['datum'] == $patient['evaluatie_datum'] && $patient['datum'] == "") {
        $reden = " nog geen overleg of evaluatie.";
      }
      else if ($patient['datum'] >= $patient['evaluatie_datum']) {
        $datum = substr($patient['datum'],6,2) . "/" . substr($patient['datum'],4,2) . "/" . substr($patient['datum'],0,4);
        $reden = " laatste overleg op $datum.";
      }
      else {
        $datum = substr($patient['evaluatie_datum'],6,2) . "/" . substr($patient['evaluatie_datum'],4,2) . "/" . substr($patient['evaluatie_datum'],0,4);
        $reden = " laatste evaluatie op $datum.";
      }
      $txt .= ("<li>" . patient_roepnaam($patient['code']) . ", $reden</li>\n");
      $aantal++;
    }
  }
  $txt .= ("</ul>\n");
  if ($aantal == 0) $txt .= ("<p><em>Alle zorgplannen waarvan je organisator bent, zijn up to date.</em></p>");
  return $txt;
}


function tePlannenEvaluatie($id) {
  echo getTePlannenEvaluatie($id);
}
function getTePlannenEvaluatie($id) {
    $txt = "";
    // alle patienten waarvan deze persoon zorgbemiddelaar is
    $queryZB = "SELECT * FROM overleg o1
                WHERE contact_hvl = $id
                  AND datum = (select max(datum) from overleg o2 where o1.patient_code = o2.patient_code)";

  $pats = mysql_query($queryZB) or die("$queryZB " . mysql_error());

  if (mysql_num_rows($pats)==0) return ""; // dit lijstje niet laten zien als je van niemand zorgbemiddelaar bent
  $aantal = 0;

  $txt .= ("<h1>Te plannen evaluatie(s) als zorgbemiddelaar</h1>\n");
  $txt .= ("<ul>\n");
  for ($i = 0; $i < mysql_num_rows($pats); $i++) {
    $patient = mysql_fetch_array($pats);

    $query = "select patient.code as code, patient.naam as naam, patient.voornaam, patient.startdatum,
                     max(overleg.datum) as datum,
                     max(evaluatie.datum) as evaluatie_datum from patient
                   left join overleg on overleg.patient_code = patient.code
                   left join evaluatie on evaluatie.patient = patient.code
            where (patient.actief = 1)
            and patient.code = '{$patient['patient_code']}'
            group by patient.code
            order by greatest(max(overleg.datum), max(evaluatie.datum))";

    $laatsteDings = mysql_query($query) or die("$query " . mysql_error());
    if (mysql_num_rows($laatsteDings)>0) {
      $laatsteDatum = mysql_fetch_assoc($laatsteDings);

    $jaar = date("Y")-1; //$jaar = date("Y");
    $maand = date("m");  //$maand = date("m")-3;
    $dag = date("d");    //$dag = date("d");
    if ($maand < 0) {
      $jaar--;
      $maand = $maand+12;
    }

    //$drieMaandGeleden = date("Ymd",time()-60*60*24*90); // 90 dagen geleden eigenlijk, maar soit
    $jaarGeleden = date("Ymd",time()-60*60*24*365);  // 365 dagen geleden

      if ($laatsteDatum['datum']<$jaarGeleden && $laatsteDatum['evaluatie_datum']<$jaarGeleden && $laatsteDatum['begindatum']<$jaarGeleden) {
        if ($laatsteDatum['datum'] == $laatsteDatum['evaluatie_datum'] && $laatsteDatum['datum'] == "") {
          $reden = " nog geen overleg of evaluatie.";
        }
        else if ($laatsteDatum['datum'] >= $laatsteDatum['evaluatie_datum']) {
          $datum = substr($laatsteDatum['datum'],6,2) . "/" . substr($laatsteDatum['datum'],4,2) . "/" . substr($laatsteDatum['datum'],0,4);
          $reden = " laatste overleg op $datum.";
        }
        else {
          $datum = substr($laatsteDatum['evaluatie_datum'],6,2) . "/" . substr($laatsteDatum['evaluatie_datum'],4,2) . "/" . substr($laatsteDatum['evaluatie_datum'],0,4);
          $reden = " laatste evaluatie op $datum.";
        }
        $txt .= ("<li>" . patient_roepnaam($laatsteDatum['code']) . ", $reden</li>\n");
        $aantal++;
      }
      else {
        $patsOK .= "<li>" . patient_roepnaam($laatsteDatum['code']) . "</li>\n";
      }
    }
  }

  $txt .= ("</ul>\n");
  if ($aantal == 0) $txt .= ("<p><em>Alle zorgplannen waarvan je zorgbemiddelaar bent, zijn up to date.</em></p>");
  if ($patsOK != "") {
    $txt .= ("<hr/>Nog even ter info de zorgenplannen waarvan je zorgbemiddelaar bent, en die up to date zijn.<br/>\n<ul>$patsOK</ul>");
  }
  return $txt;
}

function katzTeDoen($id) {
  echo getKatzTeDoen($id);
}
function getKatzTeDoen($id) {
    global $siteadres;
   $qry = "select *, katz_aanvraag.id as aanvraag_id from overleg, katz_aanvraag
           where katz_aanvraag.overleg = overleg.id
             and katz_aanvraag.hvl = $id";
   $result = mysql_query($qry) or die ("$qry" . mysql_error());
   if (mysql_num_rows($result) > 0) {
     $katz = false;
     $eval = FALSE;
     //$txt .= ("<h1>In te vullen Katz-formulieren en evaluatieinstrumenten.</h1>\n");
     $txt .= ("<ul>\n");
     for ($i=0; $i< mysql_num_rows($result); $i++) {
       $rij = mysql_fetch_assoc($result);
       $datum = mooieDatum($rij['datum']);
       if ($rij['wat']=="katz+evaluatie") {
         if ($rij['katz_id']==0 && $rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum<br/>");
           $txt .= "en <a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">het evaluatie-instrument</a></li>\n ";
           $katz = true;
           $eval = true;
         }
         else if ($rij['katz_id']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum</li>\n");
           $katz = true;
         }
         else if ($rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= "<li><a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het evaluatie-instrument</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
           $eval = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
       else if ($rij['wat']=="katz_evaluatie") {
         if ($rij['katz_id']==0 && $rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum<br/>\n");
           $txt .= "en <a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">het evaluatie-instrument</a></li>\n ";
           $katz = true;
           $eval = true;
         }
         else if ($rij['katz_id']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum</li>\n");
           $katz = true;
         }
         else if ($rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= "<li><a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het evaluatie-instrument</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
           $eval = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
       else if ($rij['wat']=="evaluatie") {
         if ($rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= "<li><a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het evaluatie-instrument</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
           $eval = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
       else if ($rij['wat']=="begeleidingsplan") {
           $txt .= "<li><a href=\"{$siteadres}/php/begeleidingsplan_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het begeleidingsplan</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
       }
       else {
         if ($rij['katz_id']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum</li>\n");
           $katz = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
     }
     $txt .= ("</ul>\n");
   }
   if ($katz && $eval) {
     $txt = "<h1>In te vullen Katz-formulieren en evaluatieinstrumenten.</h1>\n" . $txt;
   }
   else if ($katz) {
     $txt = "<h1>In te vullen Katz-formulieren.</h1>\n" . $txt;
   }
   else if ($eval) {
     $txt = "<h1>In te vullen evaluatieinstrumenten.</h1>\n" . $txt;
   }
   return $txt;
}

function getKatzMailHerinnering($id) {
  global $siteadres;

  $vandaag = mktime(0,0,0,date("n"),date("j"),date("Y"));
  $qry = "select *, katz_aanvraag.id as aanvraag_id from overleg, katz_aanvraag
           where katz_aanvraag.overleg = overleg.id
             and katz_aanvraag.hvl = $id
             and ($vandaag-wanneer)%604800 = 0
             and wanneer < $vandaag";
   $result = mysql_query($qry) or die ("$qry" . mysql_error());
   if (mysql_num_rows($result) > 0) {
     $katz = false;
     $eval = FALSE;
     //$txt .= ("<h1>In te vullen Katz-formulieren en evaluatieinstrumenten.</h1>\n");
     $txt .= ("<ul>\n");
     for ($i=0; $i< mysql_num_rows($result); $i++) {
       $rij = mysql_fetch_assoc($result);
       $datum = mooieDatum($rij['datum']);
       if ($rij['wat']=="katz+evaluatie") {
         if ($rij['katz_id']==0 && $rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum<br/>");
           $txt .= "en <a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">het evaluatie-instrument</a></li>\n ";
           $katz = true;
           $eval = true;
         }
         else if ($rij['katz_id']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum</li>\n");
           $katz = true;
         }
         else if ($rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= "<li><a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het evaluatie-instrument</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
           $eval = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
       else if ($rij['wat']=="katz_evaluatie") {
         if ($rij['katz_id']==0 && $rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum<br/>\n");
           $txt .= "en <a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">het evaluatie-instrument</a></li>\n ";
           $katz = true;
           $eval = true;
         }
         else if ($rij['katz_id']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum</li>\n");
           $katz = true;
         }
         else if ($rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= "<li><a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het evaluatie-instrument</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
           $eval = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
       else if ($rij['wat']=="evaluatie") {
         if ($rij['evalinstr_id']==0 && $rij['eval_nieuw']==0) {
           $txt .= "<li><a href=\"{$siteadres}/php/evaluatie_instrument_nieuw.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Het evaluatie-instrument</a> voor " . patient_roepnaam($rij['patient_code']) . " (overleg $datum)</li>\n ";
           $eval = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
       else {
         if ($rij['katz_id']==0) {
           $txt .= ("<li><a href=\"{$siteadres}/php/katz_invullen.php?hvl_id={$rij['hvl']}&code={$rij['logincode']}\">Katz</a> bij het overleg rond " . patient_roepnaam($rij['patient_code']) . " op $datum</li>\n");
           $katz = true;
         }
         else {
           // katz_aanvraag wissen
           mysql_query("delete katz_aanvraag where id = {$rij['aanvraag_id']}");
         }
       }
     }
     $txt .= ("</ul>\n");
   }
   if ($katz && $eval) {
     $txt = "<h1>In te vullen Katz-formulieren en evaluatieinstrumenten.</h1>\n" . $txt;
   }
   else if ($katz) {
     $txt = "<h1>In te vullen Katz-formulieren.</h1>\n" . $txt;
   }
   else if ($eval) {
     $txt = "<h1>In te vullen evaluatieinstrumenten.</h1>\n" . $txt;
   }
   return $txt;
}

function aantalEmails() {
  if ($_SESSION['profiel']=="hulp") {
    $persoon_genre = "hulp";
    $persoon_id = $_SESSION['usersid'];
  }
  else if ($_SESSION['profiel']=="menos") {
    $persoon_genre = "menos";
    $persoon_id = -666;
  }
  else if ($_SESSION['profiel']=="rdc") {
    $persoon_genre = "rdc";
    $persoon_id = $_SESSION['organisatie'];
  }
  else if ($_SESSION['profiel']=="OC") {
    $persoon_genre = "sit";
    $persoon_id = $_SESSION['overleg_gemeente'];
  }
  else if ($_SESSION['profiel']=="psy") {
    $persoon_genre = "psy";
    $persoon_id = $_SESSION['organisatie'];
  }
  else {
    return;
  }


  $aantal = getUniqueRecord("select count(*) as aantal from berichten_to where genre = '$persoon_genre' and persoon = $persoon_id and actief = 1 and gelezen = 0");
//  print("select count(*) as aantal from berichten_to where genre = '$persoon_genre' and persoon = $persoon_id and actief = 1 and gelezen = 0");
  if ($aantal['aantal']>0) {
    print("<h1>Er zijn {$aantal['aantal']} ongelezen berichten in <a href=\"berichten.php\">de brievenbus</a>.</h1>\n");
  }
}

function aantalPatientenBetrokkenBij($hulpverlenerID) {
    $query2 = "(SELECT distinct patient.* FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                               and (patient.actief = 1  or patient.menos = 1)
                                               and genre = 'hulp' and persoon_id = $hulpverlenerID and (rechten = 1 or overleggenre = 'menos')))
                union
               (select distinct * from patient where patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = $hulpverlenerID
                                and patient.actief = 1)";
    $result = mysql_query($query2) or die($query2 . mysql_error());
    return mysql_num_rows($result);
}

function werkVoor($soort, $id, $persoon, $isOrganisator) {
  print(getWerkVoor($soort, $id, $persoon, $isOrganisator));
  aantalEmails();
}
function getWerkVoor($soort, $id, $persoon, $isOrganisator) {
  $txt = "";
  if ($id == "") {
    switch ($soort) {
      case "OC":
        die("Voor deze overlegco&ouml;rdinator OC-TGZ is geen gemeente aangeduid waarvoor hij/zij de overleggen organiseert.");
      case "hulp":
        die("Hulpverlener heeft geen id");
      case "rdc":
        die("Voor deze overlegco&ouml;rdinator RDC is geen organisatie aangeduid waarvoor hij/zij de overleggen organiseert.");
      case "psy":
        die("Psy heeft geen id");
      default:
        die("Voor deze overlegco&ouml;rdinator TP is geen project aangeduid waarvoor hij/zij de overleggen organiseert.");

    }
  }

  if ($isOrganisator) {
    // aangevraagde overleggen
    $txt .= getAangevraagdeOverleggen($soort, $id, $persoon);

    // af te ronden overleggen
    $txt .= getAfTeRondenOverleg($soort, $id, $persoon, "", "");

    // over te dragen patienten
    $txt .= getOverTeDragenPatienten($soort, $id);

    // te plannen overleggen of evaluaties
    $txt .= getTePlannen($soort, $id);
  }
  
  if ($soort == "hulp") {
     // welke katzs nog te doen
     $txt .= getKatzTeDoen($id);

     // te plannen overleggen of evaluaties
     $txt .= getTePlannenEvaluatie($id);

     $aantalPats = aantalPatientenBetrokkenBij($id);
     if ($txt == "") {
       if (aantalPats==0) {
          return "<p>Zodra je toegevoegd wordt aan het zorgteam van een pati&euml;nt kan je de overleggen rond deze pati&euml;nt bekijken. Je kan dit enkel vanaf het moment dat dit overleg afgerond werd door de organisator &eacute;n deze u toegang gegeven heeft tot het overleg.</p>";
       }
       else {
          return "<p>U bent op dit moment betrokken bij $aantalPats pati&euml;nt(en). Als je nog geen pati&euml;nten kan selecteren, is dit omdat de overleggen nog niet afgerond zijn en/of de organisator van het overleg nog geen toegang tot het overleg heeft gegeven.</p>";
       }
     }
     else {
       $txt = "<p>U bent op dit moment betrokken bij $aantalPats pati&euml;nt(en).</p>" . $txt;
     }
  }
  
  return $txt;
}

function organisatorVanOverleg($overleg) {
  $genre = $overleg['toegewezen_genre'];
  $id = $overleg['id'];
  if ($genre=="gemeente") {
    $organisator1 = getUniqueRecord("select concat('OCMW ',gemeente.naam) as naam from gemeente, patient where gemeente.id = gem_id and code = \"{$_SESSION['pat_code']}\"");
    $organisator2 = getUniqueRecord("select concat(voornaam, ' ',naam) as naam from logins where id = \"{$overleg['coordinator_id']}\"");
    return $organisator2['naam'] . " (" . $organisator1['naam'] . ")";
  }
  else if ($genre=="rdc") {
    $organisator1 = getUniqueRecord("select naam from organisatie where id = {$_SESSION['organisatie']}");
    $organisator2 = getUniqueRecord("select concat(voornaam, ' ',naam) as naam from logins where id = \"{$overleg['coordinator_id']}\"");
    return $organisator2['naam'] . " (" . $organisator1['naam'] . ")";
  }
  else if ($genre=="hulp") {
    $organisator = getUniqueRecord("select concat(voornaam, ' ', naam) as naam from hulpverleners where id = {$overleg['coordinator_id']}");
  }
  else if ($genre=="TP") {
    $organisator = getUniqueRecord("select concat(voornaam, ' ', naam) as naam from logins where id = {$overleg['coordinator_id']}");
  }
  else if ($genre=="psy") {
    $organisator1 = getUniqueRecord("select naam from organisatie where id = {$_SESSION['organisatie']}");
    $organisator2 = getUniqueRecord("select concat(voornaam, ' ',naam) as naam from logins where id = \"{$overleg['coordinator_id']}\"");
    return $organisator2['naam'] . " (" . $organisator1['naam'] . ")";
  }
  else {
    $organisator['naam']= "N.N";
    $organisator['genre'] = "????";
  }
  return $organisator['naam'];
}

function organisatorenVanPatient($code) {
  if (strpos($code, "'",2)>0) {
     $patient = getUniqueRecord("select * from patient where code = $code");
  }
  else {
     $patient = getUniqueRecord("select * from patient where code = '$code'");
  }
  $genre = $patient['toegewezen_genre'];
  if ($genre=="gemeente") {
    $organisatoren = mysql_query("select 'ocmw' as orggenre, logins.* from logins, gemeente, patient where logins.naam not like '%help%' and logins.overleg_gemeente = gemeente.zip and gemeente.id = gem_id and code = \"$code}\" and logins.actief = 1");
  }
  else if ($genre=="rdc") {
    $organisatoren = mysql_query("select 'rdc' as orggenre, logins.* from logins where logins.naam not like '%help%' and  profiel = 'rdc' and organisatie = \"{$patient['toegewezen_id']}\" and logins.actief = 1");
  }
  else if ($genre=="hulp") {
    $organisatoren = mysql_query("select 'hulp' as orggenre, * from hulpverleners where naam not like '%help%' and id = \"{$patient['toegewezen_id']}\" and actief = 1");
  }
  else if ($genre=="psy") {
    $organisatoren = mysql_query("select 'psy' as orggenre, logins.* from logins where logins.naam not like '%help%' and organisatie = \"{$patient['toegewezen_id']}\" and logins.actief = 1");
  }
  return $organisatoren;
}

function organisatorenVanAanvraag($aanvraag, $patient) {
  if (!isset($aanvraag['organisator'])) { // de standaard organisator van de patient
     $genre  = $patient->toegewezen_genre;
     $orgId = $patient->toegewezen_id;
     $gem_id = $patient->gem_id;
  }
  else {
     $genre  = $aanvraag['organisator'];
     $orgId = $aanvraag['organisatorOrg'];
     if (isset($aanvraag['gem_id'])) {
       $gem_id = $aanvraag['gem_id'];
     }
     else {
       $gem_id = $patient->gem_id;
     }
  }

  if ($genre=="gemeente" || $genre=="ocmw") {
    //print("select distinct logins.* from logins, gemeente where logins.overleg_gemeente = gemeente.zip and gemeente.id = {$gem_id}");
    $organisatoren = mysql_query("select distinct logins.* from logins, gemeente where logins.naam not like '%help%' and logins.overleg_gemeente = gemeente.zip and gemeente.id = {$gem_id} and logins.actief = 1");
  }
  else if ($genre=="rdc") {
    //print("select distinct logins.* from logins where profiel = 'rdc' and organisatie = \"{$orgId}\"");
    $organisatoren = mysql_query("select distinct logins.* from logins where logins.naam not like '%help%' and  profiel = 'rdc' and organisatie = \"{$orgId}\" and logins.actief = 1");
  }
  else if ($genre=="hulp") {
    //print("select distinct * from hulpverleners where organisatie = {$orgId} and email is not null and is_organisator = 1");
    $organisatoren = mysql_query("select distinct * from hulpverleners where naam not like '%help%' and  organisatie = {$orgId} and email is not null and is_organisator = 1 and actief = 1");
  }
  else if ($genre=="psy") {
    $organisatoren = mysql_query("select 'psy' as orggenre, logins.* from logins where logins.naam not like '%help%' and profiel='psy' and organisatie = {$orgId} and logins.actief = 1");
  }
  return $organisatoren;
}

function menosOrganisatorenVanPatient($code) {
  $organisatoren = mysql_query("select logins.* from logins where profiel = 'menos' and actief = 1");
  return $organisatoren;
}

function organisatorRecordVanOverleg($overleg) {
  $genre = $overleg['toegewezen_genre'];
  $id = $overleg['id'];
  
  
  if ($genre=="gemeente") {
    $organisator1 = getUniqueRecord("select concat('OCMW ',gemeente.naam) as naam from gemeente, patient where gemeente.id = gem_id and code = \"{$overleg['patient_code']}\"");
    $organisator = getUniqueRecord("select concat(voornaam, ' ',naam) as loginnaam, logins.*, '' as iban, '' as bic from logins where id = \"{$overleg['coordinator_id']}\"");
    $organisator['langenaam'] = $organisator['loginnaam'] . " (" . $organisator1['naam'] . ")";
    $organisator['orgnaam'] = $organisator1['naam'];
  }
  else if ($genre=="rdc") {
    $organisator = getUniqueRecord("select concat(voornaam, ' ',naam) as loginnaam, logins.*, '' as iban, '' as bic, organisatie from logins where id = \"{$overleg['coordinator_id']}\"");
    $organisator1 = getUniqueRecord("select naam from organisatie where id = {$organisator['organisatie']}");
    $organisator['langenaam'] = $organisator['loginnaam'] . " (" . $organisator1['naam'] . ")";
    $organisator['orgnaam'] = $organisator1['naam'];
  }
  else if ($genre=="menos") {
    $organisator = getFirstRecord("select *, concat(voornaam, ' ', naam) as langenaam from logins where profiel = 'menos' and actief = 1");
    $organisator['loginnaam'] = $organisator['langenaam'];
    $organisator['orgnaam'] = "Menos";
  }
  else if ($genre=="hulp") {
    $organisator = getUniqueRecord("select *, concat(voornaam, ' ', naam) as langenaam, organisatie from hulpverleners where id = {$overleg['coordinator_id']}");
    $organisator['loginnaam'] = $organisator['langenaam'];
    if ($organisator['organisatie']>0) {
      $orgRecord = getUniqueRecord("select naam from organisatie where id = {$organisator['organisatie']}");
      $organisator['orgnaam'] = $orgRecord['naam'];
    }
  }
  else if ($genre=="psy") {
    $organisator = getUniqueRecord("select concat(voornaam, ' ',naam) as loginnaam, logins.*, '' as iban, '' as bic, organisatie from logins where id = \"{$overleg['coordinator_id']}\"");
    $organisator1 = getUniqueRecord("select naam from organisatie where id = {$organisator['organisatie']}");

    $organisator['langenaam'] = $organisator['loginnaam'] . " (" . $organisator1['naam'] . ")";
    $organisator['orgnaam'] = $organisator1['naam'];

  }
  else if ($genre=="TP") {
    $organisator = getUniqueRecord("select *, concat(voornaam, ' ', naam) as langenaam from logins where id = {$overleg['coordinator_id']}");
    $organisator['loginnaam'] = $organisator['langenaam'];
    if ($organisator['organisatie']>0) {
      $orgRecord = getUniqueRecord("select naam from organisatie where id = {$organisator['organisatie']}");
      $organisator['orgnaam'] = $orgRecord['naam'];
    }
  }
  else {
    $organisator['langenaam']= "N.N";
    $organisator['loginnaam'] = $organisator['langenaam'];
    $organisator['naam']= "N.N";
    $organisator['genre'] = "????";
    $organisator['iban'] = "__";
  }
  if (!isset($organisator['organisatie'])) $organisator['organisatie']=0;
  if ($organisator['iban']=="") {
    $bankrekInfo = getFirstRecord("
      select o.reknr as org_reknr,
                org2.reknr as org2_reknr,
                o.iban as org_iban,
                org2.iban as org2_iban,
                o.bic as org_bic,
                org2.bic as org2_bic
      from organisatie o left join organisatie org2 on (o.hoofdzetel = org2.id)
      where o.id = {$organisator['organisatie']}
    ");
    $organisator['reknr']=$bankrekInfo['org_reknr'];
    $organisator['iban']=$bankrekInfo['org_iban'];
    $organisator['bic']=$bankrekInfo['org_bic'];
    if ($organisator['iban']=="") {
      $organisator['reknr']=$bankrekInfo['org2_reknr'];
      $organisator['iban']=$bankrekInfo['org2_iban'];
      $organisator['bic']=$bankrekInfo['org2_bic'];
    }

  }
  return $organisator;
}

function nogVergoedbaarDitJaar($overlegInfo) {
   $jaarLang = substr($overlegInfo['datum'],0,4);
   $ditOverlegNietMeetellen = " AND id <> {$overlegInfo['id']} ";
   // heeft de patient nog recht op een vergoeding?
   $ditJaarQry = "select * from overleg
                  where substring(datum,1,4) = $jaarLang
                  and keuze_vergoeding = 1
                  and (genre = 'gewoon' or genre is null)
                  and patient_code = '{$overlegInfo['patient_code']}'
                  $ditOverlegNietMeetellen";
   $aantalDitJaar = mysql_num_rows(mysql_query($ditJaarQry)) ;

   if ($pvsVraag = mysql_fetch_array(mysql_query("select type from patient where code = '{$overlegInfo['patient_code']}'"))) {
      $gewonePatient = ($pvsVraag['type'] != 1);
   }

   else {

      die("miljaar geen pat_type");

   }
   if ($gewonePatient) {
      $nogRechtOp = 1 - $aantalDitJaar;
   }
   else {
      $nogRechtOp = 4 - $aantalDitJaar;
      // pvs-patienten hebben recht op 4 vergoedbare overleggen per jaar
   }
   return $nogRechtOp;
}


function potentieleVergoeding($overlegID) {
  // wanneer dit overleg vergoed zou worden, is dit dan een volledige vergoeding (1) of alleen voor de organisator? (2)
  $overlegInfo = getUniqueRecord("select * from overleg where id=$overlegID");

  // als het al bepaald is, dan behouden we die waarde
  if ($overlegInfo['keuze_vergoeding']>0)
    return $overlegInfo['keuze_vergoeding'];

  // TP krijgt volledige vergoeding
  if ($overlegInfo['genre']=="TP") return 1;
  
  // psychisch altijd alleen voor de organisator
  if ($overlegInfo['soort_problematiek']=="psychisch" && $overlegInfo['genre'] != "psy") return 2;

  if (nogVergoedbaarDitJaar($overlegInfo) > 0)
    return 1;
  else
    return 2;
}

function dubbeleOrganisatorVergoeding($overlegInfo) {
  // vereist: de organisator krijgt een vergoeding!
  // returns true als dit het eerste (vergoede) overleg is
  $alleOverlegInfo = mysql_query("select * from overleg
                                      where not(id={$overlegInfo['id']}) and keuze_vergoeding > 0
                                        and controle = 1
                                        and (datum < '{$overlegInfo['datum']}' or organisatie_dubbel = 1)
                                        and (genre = 'gewoon' or genre is null)
                                        and patient_code = \"{$overlegInfo['patient_code']}\"");
  if (mysql_num_rows($alleOverlegInfo)>0) return false;
  else return true;
}

function heeftPatientRechten($code) {
  // mag deze persoon nu iets zien van deze patient?
  if ($_SESSION['profiel']=="OC") {
    $qry = "select * from patient inner join gemeente on gemeente.id = gem_id
            where toegewezen_genre = 'gemeente'
              and {$_SESSION['overleg_gemeente']} = zip
              and code = \"$code\"";
    $result = mysql_query($qry) or die("kan niet bepalen of OC rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-OCMW géén rechten voor deze patient");
  }
  else if ($_SESSION['profiel']=="hulp") {
    // staat hij bij de huidige betrokkenen?
    $qry = "select * from huidige_betrokkenen
            where (genre = 'hulp' or genre = 'orgpersoon')
              and {$_SESSION['usersid']} = persoon_id
              and patient_code = \"$code\"";
    $result = mysql_query($qry) or die("kan niet bepalen of hulpverlener als betrokkenen rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)>0) return true;
    //of is hij organisator
    $qry = "select * from patient
            where toegewezen_genre = 'hulp'
              and {$_SESSION['usersid']} = toegewezen_id
              and code = \"$code\"";
    $result = mysql_query($qry) or die("kan niet bepalen of hulpverlener als organisator rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als hulpverlener géén rechten voor deze patient");
  }
  else if ($_SESSION['profiel']=="rdc") {
    $qry = "select * from patient inner join gemeente on gemeente.id = gem_id
            where toegewezen_genre = 'rdc'
              and toegewezen_id = {$_SESSION['organisatie']}
              and code = \"$code\"";
    $result = mysql_query($qry) or die("kan niet bepalen of RDC rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-RDC géén rechten voor deze patient");
  }
  else if ($_SESSION['profiel']=="menos") {
    $qry = "select * from patient
            where menos = 1";
    $result = mysql_query($qry) or die("kan niet bepalen of OC rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-OCMW géén rechten voor deze patient");
  }
  else if ($_SESSION['profiel']=="hoofdproject" || $_SESSION['profiel']=="bijkomend project") {
    $qry = "select project from patient_tp
            where project = {$_SESSION['tp_project']}
              and patient = \"$code\"";
    $result = mysql_query($qry) or die("kan niet bepalen of TP-coordinator rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als TP-coordinator géén rechten voor deze patient <br/>Of om het technisch te zeggen<br/><em> $qry</em>");
  }
  else if ($_SESSION['profiel']=="psy") {
    $qry = "select * from patient inner join gemeente on gemeente.id = gem_id
            where toegewezen_genre = 'psy'
              and toegewezen_id = {$_SESSION['organisatie']}
              and code = \"$code\"";
    $result = mysql_query($qry) or die("kan niet bepalen of PSY rechten heeft voor patient ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-PSY géén rechten voor deze patient");
  }
  else if ($_SESSION['profiel']=="caw") {
    die("je hebt geen rechten voor deze patient");
    return false;
  }
  else {
    die("je hebt geen rechten voor deze patient");
    return false;
  }
  return true;
}

function heeftOverlegRechten($overlegID) {
  // mag deze persoon nu iets zien van dit overleg
  if ($_SESSION['profiel']=="OC") {
    $qry = "select code from overleg inner join patient on code = patient_code
                                     inner join gemeente on gemeente.id = gem_id
            where verleg.toegewezen_genre = 'gemeente'
              and {$_SESSION['overleg_gemeente']} = zip
              and overleg.id = $overlegID";
    $result = mysql_query($qry) or die("kan niet bepalen of OC rechten heeft voor overleg ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-OCMW géén rechten voor dit overleg");
  }
  else if ($_SESSION['profiel']=="hulp") {
    // staat hij bij de huidige betrokkenen?
    $afgerondRecord = getUniqueRecord("select afgerond, patient_code from overleg where id = $overlegID");
    if ($afgerondRecord['afgerond']==0) {
      $qry = "select * from huidige_betrokkenen
              where genre = 'hulp' || genre = 'orgpersoon'
                and {$_SESSION['usersid']} = persoon_id
                and patient_code = \"{$afgerondRecord['patient_code']}\"";
    }
    else {
      $qry = "select * from afgeronde_betrokkenen
              where genre = 'hulp' || genre = 'orgpersoon'
                and {$_SESSION['usersid']} = persoon_id
                and overleg_id = $overlegID";
    }
    $result = mysql_query($qry) or die("kan niet bepalen of hulpverlener als betrokkenen rechten heeft voor overlegs ($qry) " . mysql_error());
    if (mysql_num_rows($result)>0) return;
    //of is hij organisator
    $qry = "select * from overleg
            where toegewezen_genre = 'hulp'
              and {$_SESSION['usersid']} = toegewezen_id
              and id = $overlegID";
    $result = mysql_query($qry) or die("kan niet bepalen of hulpverlener als organisator rechten heeft voor overleg ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als hulpverlener géén rechten voor dit overleg");
  }
  else if ($_SESSION['profiel']=="rdc") {
    $qry = "select code from overleg
            where toegewezen_genre = 'rdc'
              and toegewezen_id = {$_SESSION['organisatie']}
              and overleg.id = $overlegID";
    $result = mysql_query($qry) or die("kan niet bepalen of RDC rechten heeft voor overleg ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-RDC géén rechten voor dit overleg");
  }
  else if ($_SESSION['profiel']=="hoofdproject" || $_SESSION['profiel']=="bijkomend project") {
    $qry = "select patient from overleg inner join patient_tp on patient = patient_code
            where project = {$_SESSION['tp_project']}
              and overleg.id = $overlegID";
    $result = mysql_query($qry) or die("kan niet bepalen of TP-coordinator rechten heeft voor overleg ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als TP-coordinator géén rechten voor dit overleg");
  }
  else if ($_SESSION['profiel']=="psy") {
    $qry = "select code from overleg
            where toegewezen_genre = 'psy'
              and toegewezen_id = {$_SESSION['organisatie']}
              and overleg.id = $overlegID";
    $result = mysql_query($qry) or die("kan niet bepalen of PSY rechten heeft voor overleg ($qry) " . mysql_error());
    if (mysql_num_rows($result)==0) die("Je hebt als OCTGZ-PSy géén rechten voor dit overleg");
  }
  else if ($_SESSION['profiel']=="caw") {
    return false;
  }
  else {
    return false;
  }
}

function vervang($oud, $nieuw) {
  $update = "update huidige_betrokkenen set persoon_id = $nieuw
             where persoon_id = $oud and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update huidige_betrokkenen" . mysql_error());

  $update = "update afgeronde_betrokkenen set persoon_id = $nieuw
             where persoon_id = $oud and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update afgeronde_betrokkenen" . mysql_error());

  $update = "update aanvraag_overdracht set van_id = $nieuw
             where van_id = $oud and (van_genre = 'hulp' or van_genre='orgpersoon')";
  if (!mysql_query($update)) die("$update aanvraag_overdracht" . mysql_error());

  $update = "update aanvraag_overdracht set naar_id = $nieuw
             where naar_id = $oud and (naar_genre = 'hulp' or naar_genre='orgpersoon')";
  if (!mysql_query($update)) die("$update aanvraag_overdracht" . mysql_error());

  $update = "update berichten set auteur_id = $nieuw
             where auteur_id = $oud and (auteur_genre = 'hulp' or auteur_genre='orgpersoon')";
  if (!mysql_query($update)) die("$update berichten" . mysql_error());

  $update = "update berichten_to set persoon = $nieuw
             where persoon = $oud and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update berichten_to" . mysql_error());

  $update = "update evaluatie set uitvoerder_id = $nieuw
              where uitvoerder_id = $oud and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update evaluatie" . mysql_error());

  $update = "update evaluatie_rechten set id = $nieuw
              where id = $oud and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update evaluatie_rechten" . mysql_error());

  $update = "update katz set hvl_id = $nieuw
              where hvl_id = $oud";
  if (!mysql_query($update)) die("$update katz" . mysql_error());

  $update = "update katz_aanvraag set hvl = $nieuw
              where hvl = $oud";
  if (!mysql_query($update)) die("$update katz" . mysql_error());

  $update = "update omb_registratie set melderhvl_id = $nieuw
              where melderhvl_id = $oud";
  if (!mysql_query($update)) die("$update omb_registratie" . mysql_error());

  $update = "update overleg set toegewezen_id = $nieuw
              where toegewezen_id = $oud and toegewezen_genre = 'hulp'";
  if (!mysql_query($update)) die("$update overleg" . mysql_error());

  $update = "update overleg_files_rechten set id = $nieuw
              where id = $oud and (genre = 'hulp' or genre='orgpersoon')";
  if (!mysql_query($update)) die("$update overleg_files_rechten" . mysql_error());

  $zoekOfAlBestaat = "select * from overleg_tp_plan where persoon = $nieuw and (genre = 'hulp' or genre='orgpersoon')";
  $bestaatAl = mysql_query($zoekOfAlBestaat) or die("Fout op regel 2671 in tp_functies");
  if (mysql_num_rows($bestaatAl) == 0) {
    $update = "update overleg_tp_plan set persoon = $nieuw
               where persoon = $oud and (genre = 'hulp' or genre='orgpersoon')";
    if (!mysql_query($update)) die("$update overleg_tp_plan" . mysql_error());
  }
  
  $update = "update patient set toegewezen_id = $nieuw
              where toegewezen_id = $oud and toegewezen_genre = 'hulp'";
  if (!mysql_query($update)) die("$update patient" . mysql_error());

  $update = "update taakfiche_mensen set mens_id = $nieuw
              where mens_id = $oud and mens_type = 'hvl'";
  if (!mysql_query($update)) die("$update taakfiche_mensen" . mysql_error());


  $update = "update hulpverleners set mag_weg = 1 where id = $oud";
  if (!mysql_query($update)) die("$update hulpverleners" . mysql_error());

}

function magWeg($oud, $nieuw) {
  //zoek vervangt
  $zoekQry = "select vervangt from hulpverleners where id = $oud and vervangt is not null";
  
  $result = mysql_query($zoekQry) or die("Kan de vervangers niet vinden." . mysql_error());
  
  for ($i=0; $i<mysql_num_rows($result); $i++) {
    $rij = mysql_fetch_assoc($result);
    vervang($rij['vervangt'], $nieuw);
    magWeg($rij['vervangt'], $nieuw);
  }

}


/********* nog enkele variabelen instellen ******/
if ($dbnaam == "listelTP" || $dbnaam == "listelbe" || $siteadres=="http://localhost/listel") {
  $beginOrganisatieVergoeding = 20090101;
}
else {
  $beginOrganisatieVergoeding = 20100101;
}


$siteadresPDF = str_replace("https","http",$siteadres);


/*************************
 * menos-functies        *
 *************************/

function toonInterventie($interventie, $wisoptie) {
/*
  // een hulpverlener mag enkel zijn interventies zien
  if ($_SESSION['profiel']=="hulp") {
    if (!(($interventie['genre']=="hulp")
             && ($_SESSION['usersid']==$interventie['uitvoerder_id']))) return;
  }
*/

  $datum=substr($interventie['datum'],6,2)."/".substr($interventie['datum'],4,2)."/".substr($interventie['datum'],0,4);

  if ($interventie['genre'] == "patient") {
   $naampje[0] = $_SESSION['pat_naam'] . ' ' . $_SESSION['pat_voornaam'];
  }
  else if ($interventie['genre'] == "menos") {
   $naampje[0] = "Menosco&ouml;rdinator";
  }
  else {
    if ($interventie['genre'] == "mantel") {
      $tabel = "mantelzorgers";
    }
    else if ($interventie['genre'] == "hulp") {
      $tabel = "hulpverleners";
    }
    else {
      $tabel = "logins";
    }

    $naampje = mysql_fetch_array(mysql_query("select concat(naam, concat(' ', voornaam))
                    from $tabel where id = {$interventie['uitvoerder_id']}"));
  }

  $divID = "interventie{$interventie['id']}";

  print ("<tr>");

  if ($_SESSION['profiel']=="hulp") {
    // een evaluatie zonder creatiedatum, en ik ben hulpverlener: ik mag niet wissen
    if ($interventie['creatiedatum'] == 0 && ($_SESSION['profiel']=="hulp")) {
      $magWissen = false;
    }
    // ik mag alleen wissen als het mijn interventie is, en als het recent is
    else if ($interventie['genre']=="hulp"
         && ($_SESSION['usersid']==$interventie['uitvoerder_id'])) {
//         && $interventie['creatiedatum'] > 0 && $interventie['creatiedatum'] > time()-60*60*24) {
      $magWissen = $wisoptie;
    }
    else {
      $magWissen = false;
    }
  }
  else if ($_SESSION['profiel']=="OC") {
    $magWissen = $wisoptie;
  }
  else if ($_SESSION['profiel']=="rdc") {
    $magWissen = $wisoptie;
  }
  else if ($_SESSION['profiel']=="listel") {
    $magWissen = $wisoptie;
  }
  else if ($_SESSION['profiel']=="menos") {
    $magWissen = $wisoptie;
  }
  else if ($_SESSION['profiel']=="psy") {
    $magWissen = $wisoptie;
  }
  else {
     $magWissen = false;
  }
  
  if ($magWissen) {
    print("
          <td><a href=\"menos_interventie_wissen.php?interventie_id={$interventie['id']}\">
            <img src=\"../images/wis.gif\" alt=\"wis\"  style=\"border: 0px;\" onclick=\"return confirm('Bent u zeker dat u de interventie van $datum wil wissen?');\" /></a>
          ");
    print("  <a href=\"menos_interventie.php?id={$interventie['id']}\">
            <img src=\"../images/b_edit.png\" alt=\"bewerken\" style=\"border: 0px;\" /></a>");
  }
  else {
    print("<td>\n");
  }
    

 print("  </td>
          <td><a href=\"#\" onClick=\"vertoon('$divID');return false;\">".$datum."</a></td>
          <td>{$interventie['vorm']}</td>
          <td>{$naampje[0]}</td>
          </tr>");

  if ($interventie['vorm']=="vorming") {
    $subvormTH = "                      <th class=\"even\" width=\"30%\">Soort vorming</td>";
    $subvormTD = "                      <td valign=\"top\">{$interventie['subvorm']} </td>";
  }
  else if ($interventie['vorm']=="overleg") {
    $subvormTH = "                      <th class=\"even\" width=\"30%\">Soort overleg</td>";
    $subvormTD = "                      <td valign=\"top\">{$interventie['subvorm']} </td>";
  }


  echo <<< EINDE
              <tr ><td colspan="6"><div style="margin: 3px; border:1px solid #DDD;display:none" id="$divID">
                   <table cellpadding="5" width="100%">
                   <tr>
                      $subvormTH
                      <th class="even" width="10%">Uren </td>
                      <th class="even" width="60%">Vooruitgang  </td>
                   </tr>
                   <tr>
                      $subvormTD
                      <td valign="top">{$interventie['uren']} </td>
                      <td valign="top">{$interventie['vooruitgang']} </td>
                   </tr></table>
EINDE;
   print("</div></td></tr>");

}

function alleInterventies($patient, $wisoptie, $menostitel) {

  $records=mysql_fetch_array(mysql_query("SELECT * FROM patient WHERE code='{$_SESSION['pat_code']}'"));
  $_SESSION['pat_voornaam'] = $records['voornaam'];
  $_SESSION['pat_naam'] = $records['naam'];
  $patientHeader =  "<b>".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (".$_SESSION['pat_code'].")</b>";


	print("<h1>Interventies $menostitel voor $patientHeader</h1>");
	print("<table width=\"100%\">
		<tr>
			<th></th>
			<th>Datum</th>
			<th>Vorm</th>
			<th>Uitvoerder</th>
		</tr>
	");

  if ($profiel == "menos" || $profiel == "listel" || isBetrokkenBijMenos($patient, $_SESSION['profiel'], $_SESSION['usersid'])) {
    $qryInterventie="
        SELECT
            *
        FROM
            menos_interventie
        WHERE
            patient='".$patient."'
        ORDER BY
            datum DESC";
  }
  else {
    $qryInterventie="
        SELECT
            *
        FROM
            menos_interventie
        where 1 = 0
        ORDER BY
            datum DESC";
  }

	if ($result=mysql_query($qryInterventie)) {
		for ($i=0; $i < mysql_num_rows ($result); $i++) {
			$record= mysql_fetch_array($result);
      toonInterventie($record, $wisoptie);
		}
	}
	print("</table>");

}

function isBetrokkenBijMenos($patient, $profiel, $id) {
  if ($profiel == "menos") return true;


  $qry = "select * from huidige_betrokkenen where patient_code = '$patient' and genre = '$profiel' and overleggenre = 'menos' and persoon_id = $id";
  $aantal = mysql_num_rows(mysql_query($qry));
  //print($qry . " - $aantal");
  return ($aantal);
}

function bestaatInMenos($patient) {
  $qry = "select * from patient_menos where patient = \"{$patient}\"";
  $result = mysql_query($qry) or die("kan niet nakijken of deze patient al in menos zit/gezeten heeft");
  return mysql_num_rows($result)>0;
}

function preset(&$var) {
  //return;
  if (!isset($var)) $var = 0;
}

function issett($var) {
  return isset($var) && $var > 0;
}
/**
   geeft de zorgtraject-periode terug
   
   @param $patient het record van de patient
   @param $soort "diabetes" of "nieren"
   @param $start en $einde begin- en eindperiode waartussen we zoeken
   @return "" als de patient niet in dit zorgtraject zit
   
*/
function zorgtraject($patient, $soort, $start, $einde) {
   $qry = "select * from patient_zorgtraject where patient = '{$patient['code']}' order by id asc";
   $result = mysql_query($qry) or die("kan zorgtraject van {$patient['code']} niet ophalen.");
   $in = false;
   $uitkomst = "";
   for ($i=0; $i < mysql_num_rows($result) ;$i++) {
     $zorg = mysql_fetch_assoc($result);
     if (!$in) {
       if ($zorg[$soort] == 1) {
         // overgang van uit naar in

         // als intrede is voorbij eind-datum, stop ermee
         if ($zorg['datum'] > $einde) return $uitkomst;
         
         $datum = mooieDatumVanLang($zorg['datum']);
         $uitkomst .= "Van $datum ";
         $in = true;
       }
     }
     else {
       if ($zorg[$soort] == 0) {
         // overgang van uit naar in
         $datum = mooieDatumVanLang($zorg['datum']);
         $uitkomst .= "tot {$datum}. ";
         $in = false;
         
         // als uittrede vroeger is dan start-datum, gebruik dit niet
         if ($zorg['datum']<$start) $uitkomst = "";
       }
     }
     // als dit record voorbij eind-datum is, stop ermee
     if ($zorg['datum'] > $einde) return $uitkomst;
   }
   
   $soortLang = "zorgtraject_{$soort}";
   if ($patient[$soortLang]==1 && !$in) {
     $datum = mooieDatumVanLang($patient['zorgtraject_datum']);
     $uitkomst .= "Van {$datum} ";
   }
   if ($patient[$soortLang]==0 && $in) {
     $datum = mooieDatumVanLang($patient['zorgtraject_datum']);
     $uitkomst .= "tot {$datum}. ";
   }

   return $uitkomst;
}


function vervolledigGegevensHVL($hvlRecord) {
  // hvlRecord bevat minstens alle gegevens uit de tabel hulpverleners
  if ($hvlRecord['functie']=="") {
    $qry = "select naam from functies where id = {$hvlRecord['fnct_id']}";
    $result = mysql_query($qry) or die("kan functie niet ophalen van hvl $qry");
    $extra = mysql_fetch_assoc($result);
    $hvlRecord['functie']=$extra['naam'];
  }
  if ($hvlRecord['gem_id']=="" || $hvlRecord['gem_id']==9999 ) {
    $qry = "select organisatie.naam as org_naam, adres, tel, dlzip, dlnaam from organisatie inner join gemeente on gemeente.id = organisatie.gem_id and organisatie.id = {$hvlRecord['organisatie']}";
    $result = mysql_query($qry) or die("kan organisatie_adres niet ophalen van hvl $qry");
    $extra = mysql_fetch_assoc($result);
    $hvlRecord['org_naam']=$extra['org_naam'];
    $hvlRecord['adres']=$extra['adres'];
    $hvlRecord['dlzip']=$extra['dlzip'];
    $hvlRecord['dlnaam']=$extra['dlnaam'];
  }
  if ($hvlRecord['organisatie']==999) $hvlRecord['org_naam']= "Zelfstandig ZVL";
  if ($hvlRecord['organisatie']==998) $hvlRecord['org_naam']= "Zelfstandig HVL";
  if ($hvlRecord['organisatie']==997) $hvlRecord['org_naam']= "Zelfstandig XVLP";
  if ($hvlRecord['organisatie']==996) $hvlRecord['org_naam']= "Zelfstandig XVLNP";

  if ($hvlRecord['tel']=="" && $hvlRecord['gsm']=="" && $extra['tel'] != "") {
    $hvlRecord['tel'] = $extra['tel'];
  }
  if ($hvlRecord['dlzip']=="") {
    $qry = "select dlzip, dlnaam from gemeente where id = {$hvlRecord['gem_id']}";
    $result = mysql_query($qry) or die("kan organisatie_adres niet ophalen van hvl $qry");
    $extra = mysql_fetch_assoc($result);
    $hvlRecord['dlzip']=$extra['dlzip'];
    $hvlRecord['dlnaam']=$extra['dlnaam'];
  }
  return $hvlRecord;
}

function pdfaccenten($string) {
  // grave
  $string = str_replace("Ã¨","è", $string);
  $string = str_replace("Ã ","à", $string);
  // acute
  $string = str_replace("Ã©","é", $string);
  $string = str_replace("Ã¡","á", $string);

  // trema
  $string = str_replace("Ã¤","ä", $string);
  $string = str_replace("Ã«","ë", $string);
  $string = str_replace("Ã¯","ï", $string);
  $string = str_replace("Ã¶","ö", $string);
  $string = str_replace("Ã¼","ü", $string);

  return $string;
}
require("../includes/psy_functies.php");


?>