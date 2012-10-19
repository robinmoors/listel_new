<?php

function psyContactZiekenhuis($patient, $patientPsy) {
  if ($patient['type']==16) {
    $jong1 = "of een K-dienst";
  }
?>
<li style="list-style-image:none;">
Er is voorafgaand <strong>contact met de geestelijke gezondheidszorg</strong> in het kader van de psychiatrische aandoening dat voldoet aan <strong>minstens</strong> &eacute;&eacute;n van de volgende voorwaarden:
<table>
<tr>
<td><input type="checkbox" value="1" id="ziekenhuis" name="ziekenhuis" <?= printChecked(1,$patientPsy['ziekenhuis']) ?> /></td>
<td>
een ziekenhuisopname in een psychiatrisch ziekenhuis, een psychiatrische afdeling van een algemeen ziekenhuis <?= $jong1 ?> van minstens 14 dagen uiterlijk &eacute;&eacute;n jaar geleden;
</td>
</tr>
<?php
  if ($patient['type']==16) {
?>
<tr>
<td><input type="checkbox" value="1" id="outreach" name="outreach" <?= printChecked(1,$patientPsy['outreach']) ?> /></td>
<td>
een tenlasteneming gedurende minstens 14 dagen door een project outreach voor kinderen en jongeren van de FOD Volksgezondheid uiterlijk &eacute;&eacute;n jaar geleden;
</td>
</tr>
<?php
  }
  else {
?>
<tr>
<td><input type="checkbox" value="1" id="art107" name="art107" <?= printChecked(1,$patientPsy['art107']) ?> /></td>
<td>
een tenlasteneming gedurende minstens 14 dagen door de mobiele equipes die zijn voorzien in het kader van artikel 107 van de ziekenhuiswet uiterlijk &eacute;&eacute;n jaar geleden;
</td>
</tr>
<?php
  }
?>

<tr>
<td><input type="checkbox" value="1" id="ziekenhuis_ander" name="ziekenhuis_ander" <?= printChecked(1,$patientPsy['ziekenhuis_ander']) ?> /></td>
<td>
een opname gedurende minstens 14 dagen in andere ziekenhuisdienst waar een psychiater in consult is bijgeroepen,
uiterlijk &eacute;&eacute;n jaar geleden. Een van de volgende nomenclatuurnummers werd hiervoor aangerekend: 599443, 599465, 596562, 596584.
</td>
</tr>
<?php
  if ($patient['type']==16) {
?>
<tr>
<td><input type="checkbox" value="1" id="cgg" name="cgg" <?= printChecked(1,$patientPsy['cgg']) ?> /></td>
<td>
minstens 6 maanden begeleid zijn door een CGG uiterlijk &eacute;&eacute;n jaar geleden;
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="politie" name="politie" <?= printChecked(1,$patientPsy['politie']) ?> /></td>
<td>
aangemeld door politie, parket of jeugdrechter uiterlijk &eacute;&eacute;n maand geleden;
</td>
</tr>
<?php
  }
?>
</table>
</li>


<?php
     }

function pdfAanvinken($actief, $tekst) {
  global $pdf,$mm,$options1;
  $pdf->ezSetDy(1*$mm);
  if ($actief==1) {
    $pdf->ezImage("../images/checkbox_checked.jpg", 18, 11, "none", "left");
  }
  else {
    $pdf->ezImage("../images/checkbox_unchecked.jpg", 18, 11, "none", "left");
  }

  $pdf->ezSetDy(11*$mm);
  $y = $pdf->ezText($tekst, 10, $options1);
  $pdf->ezSetDy(-4*$mm);

}
function pdfContactZiekenhuis($patient) {
  global $pdf,$mm;
  
  if ($patient['type']==16) {
    $jong1 = "of een K-dienst";
  }

  pdfAanvinken($patient['ziekenhuis'],"een ziekenhuisopname in een psychiatrisch ziekenhuis, een psychiatrische afdeling van een algemeen ziekenhuis $jong1 van minstens 14 dagen uiterlijk één jaar geleden;");
  if ($patient['type']==16) {
    pdfAanvinken($patient['outreach'],"een tenlasteneming gedurende minstens 14 dagen door een project outreach voor kinderen en jongeren van de FOD Volksgezondheid uiterlijk één jaar geleden;");
  }
  else {
    pdfAanvinken($patient['art107'],"een tenlasteneming gedurende minstens 14 dagen door de mobiele equipes die zijn voorzien in het kader van artikel 107 van de ziekenhuiswet uiterlijk één jaar geleden;");
  }

  pdfAanvinken($patient['ziekenhuis_ander'],"een opname gedurende minstens 14 dagen in andere ziekenhuisdienst waar een psychiater in consult is bijgeroepen, uiterlijk één jaar geleden. Een van de volgende nomenclatuurnummers werd hiervoor aangerekend: 599443, 599465, 596562, 596584.");
  if ($patient['type']==16) {
    pdfAanvinken($patient['cgg'],"minstens 6 maanden begeleid zijn door een CGG uiterlijk één jaar geleden;");
    pdfAanvinken($patient['politie'],"aangemeld door politie, parket of jeugdrechter uiterlijk één maand geleden;");
  }
}

function psyDomeinenStart($patient, $psyPatient) {
  if ($psyPatient['domeinen']==0) {
    $domeinen = Array();
  }
  else {
    $domeinen = getUniqueRecord("select * from psy_domeinen where id = {$psyPatient['domeinen']}");
  }
  if ($patient['type'] == 16) {
    psyDomeinenJong($domeinen);
  }
  else {
    psyDomeinenOud($domeinen);
  }
}

function psyDomeinenDatum($patient, $datum) {
  global $eersteOverleg, $domeinen;
  
  if ($datum == undefined || $datum == "") $datum = date("Ymd");
  // datum in formaat YYYYmmdd
  $domeinQuery = "select * from psy_domeinen where code = \"{$patient['code']}\" and datum <= $datum order by datum desc, id desc";
  $domeinResult = mysql_query($domeinQuery) or die("kan de de domeinen op datum van $datum niet ophalen.");
  if (mysql_num_rows($domeinResult) == 0) {
    $domein2Query = "select domeinen from patient_psy where code = \"{$patient['code']}\"";
    $domein2Result = mysql_query($domein2Query) or die("kan de basisdomeinen van de patient niet ophalen.");
    $domein2 = mysql_fetch_assoc($domein2Result);
    if ($domein2['domeinen']==0) {
      $titel = "Er zijn nog geen domeinen ingevuld voor deze pati&euml;nt op $datum. <br/>Vervolledig <strong>eerst</strong> het dossier via <a href=\"patient_psy_vragen.php?code={$_SESSION['pat_code']}\">Patientfiches -> Gegevens aanpassen</a>!!!";
      $domeinen = Array();
    }
    else {
      $domeinQuery = "select * from psy_domeinen where id = {$domein2['domeinen']}";
      $domeinResult = mysql_query($domeinQuery) or die("kan de de domeinen op datum van $datum niet ophalen.");
      if (mysql_num_rows($domeinResult) == 0) {
        $titel = "Er zijn nog geen domeinen ingevuld voor deze pati&euml;nt op $datum. <br/>Vervolledig <strong>eerst</strong> het dossier via <a href=\"patient_psy_vragen.php?code={$_SESSION['pat_code']}\">Patientfiches -> Gegevens aanpassen</a>!!!";
        $domeinen = Array();
      }
      else {
        $domeinen = mysql_fetch_assoc($domeinResult);
        $titel = "De toestand op " . mooieDatum($domeinen['datum']);
      }
    }
  }
  else {
    $domeinen = mysql_fetch_assoc($domeinResult);
    $titel = "De toestand op " . mooieDatum($domeinen['datum']);
  }
  print("<h2 id=\"domeinenInfo\">$titel</h2><ul style=\"list-style-type:none;\">");
  if ($patient['type'] == 16) {
    psyDomeinenJong($domeinen);
  }
  else {
    psyDomeinenOud($domeinen);
  }
  print("</ul>");
?>
  <p>
    Je bent niet verplicht om dit te wijzigen, maar je kan steeds <input type="button" value="een nieuwe toestand opslaan" onclick="savePsyDomeinen('<?=$patient['code'] ?>',<?= $datum ?>,<?php if ($eersteOverleg) print("true"); else print("false"); ?>);" id="knopPsyDomeinen" />
  </p>

<?php
}

function psyDomeinenJong($domeinen) {
?>
<li style="list-style-image:none;">
Er is <strong>verlies van bepaalde vaardigheden</strong> of beschikt slechts over beperkte vaardigheden in minimum 3 van de volgende domeinen:
<table>
<tr>
<td><input type="checkbox" value="1" id="basis" name="basis" <?= printChecked(1,$domeinen['basis']) ?> /></td>
<td title="dit domein omvat de activiteiten die onmisbaar zijn voor de bevrediging van de persoonlijke basisbehoeften: wassen, aankleden, eten, ...">
basisautonomie
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="gemeenschap" name="gemeenschap" <?= printChecked(1,$domeinen['gemeenschap']) ?> /></td>
<td title="leren omgaan met geld, (kleine) aankopen doen, zelfstandig verplaatsen (fiets, openbaar vervoer, ...).">
autonomie binnen de gemeenschap
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="taal" name="taal" <?= printChecked(1,$domeinen['taal']) ?> /></td>
<td title="dit domein betreft de communicatie in zijn receptieve en expressieve aspecten. De beoogde vaardigheden hebben hoofdzakelijk betrekking op de mogelijkheden om contact te hebben met anderen.">
taal en communicatie
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="gezin" name="gezin" <?= printChecked(1,$domeinen['gezin']) ?> /></td>
<td title="het gaat hier om de handhaving van een vertrouwensrelatie met ouders of andere zorgverantwoordelijken, en van bekwaamheden in het samenleven met andere kinderen, al dan niet broers en zussen.">
functioneren in het gezin of in de gezinsvervangende context
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="sociaal" name="sociaal" <?= printChecked(1,$domeinen['sociaal']) ?> /></td>
<td title="de hier beoogde vaardigheden zijn die vaardigheden die vereist zijn om aan te sluiten bij leeftijdsgenoten  Het betreft hier de houding tegenover zichzelf (zelfkennis en zelfbeeld), de houding tegenover anderen (inter-persoonlijke relaties), de deelname aan het buurtleven.">
sociale aansluiting
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="school" name="school" <?= printChecked(1,$domeinen['school']) ?> /></td>
<td title="hier gaat het om de essenti&euml;le componenten voor een inschakeling in een schoolcontext: motivatie, basisbekwaamheden, sociale vaardigheden, de capaciteiten om te functioneren in een gezagsrelatie. Het gaat zowel om de cognitieve vaardigheden als om het psychisch en emotioneel functioneren die deze kunnen onderdrukken.">
school
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="motoriek" name="motoriek" <?= printChecked(1,$domeinen['motoriek']) ?> /></td>
<td title="dit domein omvat de motorische vaardigheden van een individu, zoals: lichaamshouding, basisvaardigheden op motorisch vlak, fijne motoriek, psychomotorische vaardigheden en de mogelijkheden voor het verrichten van fysieke activiteiten.">
motoriek
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="persoonlijk" name="persoonlijk" <?= printChecked(1,$domeinen['persoonlijk']) ?> /></td>
<td title="dit domein omvat bepaalde gedragingen, houdingen of symptomen die maatschappelijk ongewenst zijn. Waar de vorige domeinen betrekking hebben op vaardigheden die zouden moeten verworven worden of hersteld worden, legt dit domein de nadruk op houdingen of gedragingen die zouden moeten verdwijnen.">
aangepast persoonlijk gedrag
</td>
</tr>
</table>
</li>

<?php
}

function psyDomeinenOud($domeinen) {
?>
<li style="list-style-image:none;">
Er is <strong>verlies van bepaalde vaardigheden</strong> of beschikt slechts over beperkte vaardigheden in minimum 3 van de volgende domeinen:
<table>
<tr>
<td><input type="checkbox" value="1" id="basis" name="basis" <?= printChecked(1,$domeinen['basis']) ?> /></td>
<td title="dit domein omvat de activiteiten die onmisbaar zijn voor de bevrediging van de persoonlijke basisbehoeften: wassen, aankleden, eten, ...">
basisautonomie
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="woon" name="woon" <?= printChecked(1,$domeinen['woon']) ?> /></td>
<td title="betreft hier de noodzakelijke vaardigheden voor de dagdagelijkse organisatie op huishoudelijk vlak: koken, het huishouden doen, wassen en strijken, zorg dragen voor zijn gezondheid en zijn veiligheid.">
woonautonomie
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="gemeenschap" name="gemeenschap" <?= printChecked(1,$domeinen['gemeenschap']) ?> /></td>
<td title="dit domein omvat de vaardigheden die vereist zijn om zich te verplaatsen in de samenleving, om de middelen die de samenleving biedt aan te wenden, om inkopen te doen, geld te beheren en de wetten en de reglementen van de samenleving te respecteren.">
autonomie binnen de gemeenschap
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="taal" name="taal" <?= printChecked(1,$domeinen['taal']) ?> /></td>
<td title="dit domein betreft de communicatie in zijn receptieve en expressieve aspecten. De beoogde vaardigheden hebben hoofdzakelijk betrekking op de mogelijkheden om contact te hebben met anderen.">
taal en communicatie
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="maatschappij" name="maatschappij" <?= printChecked(1,$domeinen['maatschappij']) ?> /></td>
<td title="de hier beoogde vaardigheden zijn die vaardigheden die vereist zijn om zich in te schakelen in een groep of een vereniging. Het betreft hier de houding tegenover zichzelf (zelfkennis en zelfbeeld), de houding tegenover anderen (inter-persoonlijke relaties), de deelname aan het leven van de gemeenschap.">
maatschappelijke aanpassing
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="werk" name="werk" <?= printChecked(1,$domeinen['werk']) ?> /></td>
<td title="hier gaat het om de essenti&euml;le componenten voor een professionele integratie: motivatie, basisbekwaamheden, vaardigheden, de capaciteiten om zich in te schakelen in een ploeg.">
werk
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="school" name="school" <?= printChecked(1,$domeinen['school']) ?> /></td>
<td title="dit domein omvat de intellectuele vaardigheden van het individu, zowel wat elementaire kennis betreft als wat lezen, schrijven en rekenen betreft.">
schoolse kennis
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="motoriek" name="motoriek" <?= printChecked(1,$domeinen['motoriek']) ?> /></td>
<td title="dit domein omvat de motorische vaardigheden van een individu, zoals: lichaamshouding, basisvaardigheden op motorisch vlak, fijne motoriek, psychomotorische vaardigheden en de mogelijkheden voor het verrichten van fysieke activiteiten.">
motoriek
</td>
</tr>
<tr>
<td><input type="checkbox" value="1" id="persoonlijk" name="persoonlijk" <?= printChecked(1,$domeinen['persoonlijk']) ?> /></td>
<td title="dit domein omvat bepaalde gedragingen, houdingen of symptomen die maatschappelijk ongewenst zijn. Waar de vorige domeinen betrekking hebben op vaardigheden die zouden moeten verworven worden of hersteld worden, legt dit domein de nadruk op houdingen of gedragingen die zouden moeten verdwijnen.">
aangepast persoonlijk gedrag
</td>
</tr>
</table>
</li>
<?php
}


function updateDomeinen($data, $id) {
  $datum = date("Ymd");

  if (!isset($data['basis'])) $data['basis'] = 0;
  if (!isset($data['gemeenschap'])) $data['gemeenschap'] = 0;
  if (!isset($data['taal'])) $data['taal'] = 0;
  if (!isset($data['school'])) $data['school'] = 0;
  if (!isset($data['motoriek'])) $data['motoriek'] = 0;
  if (!isset($data['woon'])) $data['woon'] = 0;
  if (!isset($data['maatschappij'])) $data['maatschappij'] = 0;
  if (!isset($data['werk'])) $data['werk'] = 0;
  if (!isset($data['gezin'])) $data['gezin'] = 0;
  if (!isset($data['sociaal'])) $data['sociaal'] = 0;
  if (!isset($data['persoonlijk'])) $data['persoonlijk'] = 0;

  $qry = "update psy_domeinen set
               datum = $datum,
               basis = {$data['basis']},
               gemeenschap = {$data['gemeenschap']},
               taal = {$data['taal']},
               school = {$data['school']},
               motoriek = {$data['motoriek']},
               woon = {$data['woon']},
               maatschappij = {$data['maatschappij']},
               werk = {$data['werk']},
               gezin = {$data['gezin']},
               sociaal = {$data['sociaal']},
               persoonlijk = {$data['persoonlijk']}
          where id = $id";
   mysql_query($qry) or die("Kan de domeinen niet aanpassen");
}

function saveDomeinen($data) {
  if (!isset($data['basis'])) $data['basis'] = 0;
  if (!isset($data['gemeenschap'])) $data['gemeenschap'] = 0;
  if (!isset($data['taal'])) $data['taal'] = 0;
  if (!isset($data['school'])) $data['school'] = 0;
  if (!isset($data['motoriek'])) $data['motoriek'] = 0;
  if (!isset($data['persoonlijk'])) $data['persoonlijk'] = 0;
  if (!isset($data['woon'])) $data['woon'] = 0;
  if (!isset($data['maatschappij'])) $data['maatschappij'] = 0;
  if (!isset($data['werk'])) $data['werk'] = 0;
  if (!isset($data['gezin'])) $data['gezin'] = 0;
  if (!isset($data['sociaal'])) $data['sociaal'] = 0;
  if (!isset($data['datum'])) {$datum = date("Ymd");} else {$datum = $data['datum'];}
  
  $qry = "insert into psy_domeinen
                 (code, datum, basis, gemeenschap, taal,
                  school, motoriek, persoonlijk,
                  woon, maatschappij, werk,
                  gezin, sociaal)
          values (\"{$data['patient']}\", $datum, {$data['basis']}, {$data['gemeenschap']}, {$data['taal']},
                   {$data['school']}, {$data['motoriek']}, {$data['persoonlijk']},
                   {$data['woon']}, {$data['maatschappij']}, {$data['werk']},
                   {$data['gezin']}, {$data['sociaal']})";
   mysql_query($qry) or die("Kan de domeinen niet opslaan " . $qry . mysql_error());
   return mysql_insert_id();
}



function isPatientPsy($patientGenre) {
  return ($patientGenre == 16) || ($patientGenre == 18);
}

/********************
 * Begeleidingsplan *
 ********************/
function toonBegeleidingsplanVolledig($overlegID, $afgerond) {
  // eerst effe kijken of er al een plan is voor dit overleg
  $qry = "select * from psy_plan where overleg_id = $overlegID order by id asc";
  $bestaatPlan = mysql_query($qry) or die("we kunnen niet controleren of er al een plan bestaat voor deze patient");
  if (mysql_num_rows($bestaatPlan)==0) {
    // en nu zoeken naar het vorige plan
    $zoekQry = "select id, datum from overleg
              where datum < (select datum from overleg where id = $overlegID)
              and patient_code = '{$_SESSION['pat_code']}'
              and genre = 'psy'
              order by datum desc
              limit 0,1";
    $vorigOverlegResult = mysql_query($zoekQry) or die("Kan het vorige plan niet ophalen. $zoekQry " . mysql_error());
    if (mysql_num_rows($vorigOverlegResult) == 1) {
      $vorigOverleg = mysql_fetch_array($vorigOverlegResult);
      $mooieVorigeDatum = mooieDatum($vorigOverleg['datum']);
      print("<div style=\"background-color:yellow;\">Hieronder vind je het begeleidingsplan van het vorige overleg op $mooieVorigeDatum.<br/>Je kan de afspraken evalueren en bijsturen, of verwijderen door op het min-teken te klikken.</div>");
      $overlegID = $vorigOverleg['id'];
    }
    else {
      print("<script type=\"text/javascript\">nietAllesIngevuldOpBegeleidingsplan = true;</script>\n");
    }

  }


  global $mensenGlobaal;
  if ($afgerond == 1) {
    $mensenGlobaal = getSelectMensen(getQueryHVLAfgerond($overlegID),getQueryMZAfgerond($overlegID),getQuerySpeciaal());
  }
  else {
    $mensenGlobaal = getSelectMensen(getQueryHVLHuidig($_SESSION['pat_code']),getQueryMZHuidig($_SESSION['pat_code']),getQuerySpeciaal());
  }

?>
<script type="text/javascript">
  function insertAfspraak(domein, object) {
     var n = object.value;
     var tabelID = domein + 'PlanIntern';
     var rij = $$$(tabelID).insertRow(n);
     var mensenCel = rij.insertCell(0);
     mensenCel.innerHTML = "<select name=\"" + domein + "Persoon" + n + "[]\" size=\"4\" multiple=\"multiple\"><?= $mensenGlobaal ?></select>";
     var afspraakCel = rij.insertCell(1);
     afspraakCel.innerHTML = "<textarea name=\"" + domein + "Afspraak" + n + "\" style=\"width:345px;height:50px;\"></textarea>";
     var einddatumCel = rij.insertCell(2);
     var id = "div" + domein + n;
     einddatumCel.innerHTML = "<div style=\"text-align:right;\" id=\"" + id+ "\"><a class=\"subtiel\" href=\"javascript:verwijderRij('" + tabelID + "','" + id + "',aantalAfspraken" + domein + ");\">-</a><br/> <br/><input style=\"width:99px;\"name=\"" + domein + "Einddatum" + n + "\" value=\"\"/></div>";
     object.add();
  }
</script>
<?php
  global $domeinen;

  toonBegeleidingsplan("basis","basisautonomie","dit domein omvat de activiteiten die onmisbaar zijn voor de bevrediging van de persoonlijke basisbehoeften: wassen, aankleden, eten, ...",$domeinen['basis'],$overlegID, $afgerond);
  toonBegeleidingsplan("woon","woonautonomie","betreft hier de noodzakelijke vaardigheden voor de dagdagelijkse organisatie op huishoudelijk vlak: koken, het huishouden doen, wassen en strijken, zorg dragen voor zijn gezondheid en zijn veiligheid.",$domeinen['woon'],$overlegID, $afgerond);
  toonBegeleidingsplan("gemeenschap","autonomie binnen de gemeenschap","vaardigheden die vereist zijn om zich te verplaatsen in de samenleving, (leren) omgaan met geld, (kleine) aankopen doen, zelfstandig verplaatsen (fiets, openbaar vervoer, ...), de wetten en de reglementen van de samenleving respecteren",$domeinen['gemeenschap'],$overlegID, $afgerond);
  toonBegeleidingsplan("taal","taal en communicatie","dit domein betreft de communicatie in zijn receptieve en expressieve aspecten. De beoogde vaardigheden hebben hoofdzakelijk betrekking op de mogelijkheden om contact te hebben met anderen.",$domeinen['taal'],$overlegID, $afgerond);
  toonBegeleidingsplan("maatschappij","maatschappelijke aanpassing","de hier beoogde vaardigheden zijn die vaardigheden die vereist zijn om zich in te schakelen in een groep of een vereniging. Het betreft hier de houding tegenover zichzelf (zelfkennis en zelfbeeld), de houding tegenover anderen (inter-persoonlijke relaties), de deelname aan het leven van de gemeenschap.",$domeinen['maatschappij'],$overlegID, $afgerond);
  toonBegeleidingsplan("werk","werk","hier gaat het om de essenti&euml;le componenten voor een professionele integratie: motivatie, basisbekwaamheden, vaardigheden, de capaciteiten om zich in te schakelen in een ploeg.",$domeinen['werk'],$overlegID, $afgerond);
  toonBegeleidingsplan("gezin","functioneren in het gezin of in de gezinsvervangende context","het gaat hier om de handhaving van een vertrouwensrelatie met ouders of andere zorgverantwoordelijken, en van bekwaamheden in het samenleven met andere kinderen, al dan niet broers en zussen.",$domeinen['gezin'],$overlegID, $afgerond);

  global $patientInfo;
  if ($patientInfo['type']==18) {
     toonBegeleidingsplan("school","schoolse kennis","Dit omvat de intellectuele vaardigheden van het individu, zowel wat elementaire kennis betreft als wat lezen, schrijven en rekenen betreft.",$domeinen['school'],$overlegID, $afgerond);
  }
  else {
     toonBegeleidingsplan("school","school","Het gaat hier om de essenti&euml;le componenten voor een inschakeling in een schoolcontext: motivatie, basisbekwaamheden, sociale vaardigheden, de capaciteiten om te functioneren in een gezagsrelatie. Het gaat zowel om de cognitieve vaardigheden als om het psychisch en emotioneel functioneren die deze kunnen onderdrukken.",$domeinen['school'],$overlegID, $afgerond);
  }
  toonBegeleidingsplan("sociaal","sociale aansluiting","de hier beoogde vaardigheden zijn die vaardigheden die vereist zijn om aan te sluiten bij leeftijdsgenoten  Het betreft hier de houding tegenover zichzelf (zelfkennis en zelfbeeld), de houding tegenover anderen (inter-persoonlijke relaties), de deelname aan het buurtleven.",$domeinen['sociaal'],$overlegID, $afgerond);
  toonBegeleidingsplan("motoriek","motoriek","dit domein omvat de motorische vaardigheden van een individu, zoals: lichaamshouding, basisvaardigheden op motorisch vlak, fijne motoriek, psychomotorische vaardigheden en de mogelijkheden voor het verrichten van fysieke activiteiten.",$domeinen['motoriek'],$overlegID, $afgerond);
  toonBegeleidingsplan("persoonlijk","aangepast persoonlijk gedrag","dit domein omvat bepaalde gedragingen, houdingen of symptomen die maatschappelijk ongewenst zijn. Waar de vorige domeinen betrekking hebben op vaardigheden die zouden moeten verworven worden of hersteld worden, legt dit domein de nadruk op houdingen of gedragingen die zouden moeten verdwijnen.",$domeinen['persoonlijk'],$overlegID, $afgerond);
}

function insertBegeleidingsDetail($domein, $nr, $mensen, $afspraak, $einddatum) {
?>
         <tr>
           <td>
             <select name="<?= $domein ?>Persoon<?= $nr ?>[]" multiple="multiple" size="4"><?= $mensen ?></select>
           </td>
           <td><textarea name="<?= $domein ?>Afspraak<?= $nr ?>" style="width:345px;height:50px;"><?= $afspraak ?></textarea></td>
           <td><div style="text-align:right;" id="div<?= $domein ?><?= $nr ?>"><a class="subtiel" href="javascript:verwijderRij('<?= $domein ?>PlanIntern','div<?= $domein ?><?= $nr ?>',aantalAfspraken<?= $domein ?>);">-</a><br/> <br/><input style="width:99px;" name="<?= $domein ?>Einddatum<?= $nr ?>" value="<?= $einddatum ?>" /></div></td>
         </tr>
<?php
}

function getSelectMensen($qryHVL, $qryMantel, $qrySpeciaal) {
  $resultHVL = mysql_query($qryHVL) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryHVL " .mysql_error());
  $txt = "";
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    if ($mens['plan']>0) {
      $selected = " selected=\"selected\" ";
    }
    else {
      $selected = "";
    }
    $txt .= "<option value='hulp|{$mens['id']}' $selected>{$mens['naam']}</option>";
  }
  $offset = $i;
  $resultMantel = mysql_query($qryMantel) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryMantel " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultMantel); $i++) {
    $mens = mysql_fetch_assoc($resultMantel);
    if ($mens['plan']>0) {
      $selected = " selected=\"selected\" ";
    }
    else {
      $selected = "";
    }
    $txt .= "<option value='mantel|{$mens['id']}' $selected>{$mens['naam']}</option>";
  }

  $resultSpeciaal = mysql_query($qrySpeciaal) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qrySpeciaal " .mysql_error());
  $speciaal = array();
  for ($i=0; $i < mysql_num_rows($resultSpeciaal); $i++) {
    $mens = mysql_fetch_assoc($resultSpeciaal);
    $speciaal[$mens['genre']]=1;
  }
  if ($speciaal['patient']==1)
    $txt .= "<option value='patient|0' selected=\"selected\" >Patient</option>";
  else
    $txt .= "<option value='patient|0' >Patient</option>";
  if ($speciaal['oc']==1)
    $txt .= "<option value='oc|0' selected=\"selected\" >OC</option>";
  else
    $txt .= "<option value='oc|0' >OC</option>";
  if ($speciaal['ander']==1)
    $txt .= "<option value='ander|0' selected=\"selected\" >Ander</option>";
  else
    $txt .= "<option value='ander|0' >Ander</option>";
  return $txt;
}


function getMensen($qryHVL, $qryMantel, $qrySpeciaal) {
  $resultHVL = mysql_query($qryHVL) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryHVL " .mysql_error());
  $mensen = array();
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    $mensen[$i] = $mens;
  }
  $offset = $i;
  $resultMantel = mysql_query($qryMantel) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryMantel " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultMantel); $i++) {
    $mens = mysql_fetch_assoc($resultMantel);
    $mensen[$offset+$i] = $mens;
  }
  $offset = $offset+$i;
  $resultSpeciaal = mysql_query($qrySpeciaal) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qrySpeciaal " .mysql_error());
  $speciaal = array();
  for ($i=0; $i < mysql_num_rows($resultSpeciaal); $i++) {
    $mens = mysql_fetch_assoc($resultSpeciaal);
    $mens['naam']=$mens['genre'];
    $mens['plan']=1;
    $mens['id']=1;
    $mensen[$offset+$i]=$mens;
  }
  return $mensen;
}
function getQueryHVLHuidig($code,$plan=0,$aanwezigVerplicht=0) {
  if ($aanwezigVerplicht == 1) {
    $where = " where aanwezig = 1 ";
  }
  if ($plan == -1) {
     return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naamKort, bereikbaarheid,
                 hvl.*, bl.genre, bl.id as betrokkene_id, f.naam as functie
             from ((hulpverleners hvl inner join huidige_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'hulp' and bl.patient_code = '$code')
                   inner join functies f on f.id = hvl.fnct_id)
             $where
             order by bl.id
             ";
  }
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam,
                 hvl.id, plan.plan, bl.genre
             from (hulpverleners hvl inner join huidige_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'hulp' and bl.patient_code = '$code')
                   left join psy_plan_mens plan on bl.persoon_id = plan.persoon_id and bl.genre = plan.genre  and plan.plan = $plan
             $where
             order by bl.id
             ";
}
function getQueryHVLAfgerond($overleg,$plan=0,$aanwezigVerplicht=0) {
  if ($aanwezigVerplicht == 1) {
    $where = " where aanwezig = 1 ";
  }
  if ($plan == -1) {
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naamKort, bereikbaarheid,
                    hvl.*, bl.genre, bl.id as betrokkene_id, f.naam as functie
             from (hulpverleners hvl inner join afgeronde_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'hulp' and bl.overleg_id = $overleg)
                  inner join functies f on f.id = hvl.fnct_id
             $where
             order by bl.id
             ";
  }
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam,
                    hvl.id, plan.plan, bl.genre
             from (hulpverleners hvl inner join afgeronde_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'hulp' and bl.overleg_id = $overleg)
                   left join psy_plan_mens plan on bl.persoon_id = plan.persoon_id and bl.genre = plan.genre  and plan.plan = $plan
             $where
             order by bl.id
             ";
}
function getQueryMZHuidig($code,$plan=0,$aanwezigVerplicht=0) {
  if ($aanwezigVerplicht == 1) {
    $where = " where aanwezig = 1 ";
  }
  if ($plan == -1) {
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naamKort, bereikbaarheid,
                 hvl.*, bl.genre, bl.id as betrokkene_id, f.naam as functie
             from (mantelzorgers hvl inner join huidige_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'mantel' and bl.patient_code = '$code')
                  inner join verwantschap f on f.id = hvl.verwsch_id
             $where
             order by bl.id
             ";
  }
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam,
                 hvl.id, plan.plan, bl.genre
             from (mantelzorgers hvl inner join huidige_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'mantel' and bl.patient_code = '$code')
                   left join psy_plan_mens plan on bl.persoon_id = plan.persoon_id and bl.genre = plan.genre  and plan.plan = $plan
             $where
             order by bl.id
             ";
}
function getQueryMZAfgerond($overleg,$plan=0,$aanwezigVerplicht=0) {
  if ($aanwezigVerplicht == 1) {
    $where = " where aanwezig = 1 ";
  }
  if ($plan == -1) {
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naamKort, bereikbaarheid,
                    hvl.*, bl.genre, bl.id as betrokkene_id, f.naam as functie
             from (mantelzorgers hvl inner join afgeronde_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'mantel' and bl.overleg_id = $overleg)
                  inner join verwantschap f on f.id = hvl.verwsch_id
             $where
             order by bl.id
             ";
  }
  return "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam,
                    hvl.id, plan.plan, bl.genre
             from (mantelzorgers hvl inner join afgeronde_betrokkenen bl on bl.persoon_id = hvl.id and bl.genre = 'mantel' and bl.overleg_id = $overleg)
                   left join psy_plan_mens plan on bl.persoon_id = plan.persoon_id and bl.genre = plan.genre  and plan.plan = $plan
             $where
             order by bl.id
             ";
}
function getQuerySpeciaal($plan=0) {
  //HIERHIER: ook nog voor mantel en patient zelf, en dan ook nog voor huidige_betrokkenen
  return "select *
             from psy_plan_mens where plan = $plan and genre in ('oc','patient','ander')
             ";
}
function toonPlanDetails($domein, $overleg, $afgerond) {
   $qry = "select * from psy_plan where overleg_id = $overleg and domein = '$domein' order by id";
   $result = mysql_query($qry) or die("kan het begeleidingsplan voor $domein niet ophalen ($qry)");
   for ($i=0; $i < mysql_num_rows($result); $i++) {
     $rij = mysql_fetch_assoc($result);
     if ($afgerond == 1) {
       $mensen = getSelectMensen(getQueryHVLAfgerond($overleg,$rij['id']),getQueryMZAfgerond($overleg,$rij['id']),getQuerySpeciaal($rij['id']));
     }
     else {
       $mensen = getSelectMensen(getQueryHVLHuidig($_SESSION['pat_code'],$rij['id']),getQueryMZHuidig($_SESSION['pat_code'],$rij['id']),getQuerySpeciaal($rij['id']));
     }
     insertBegeleidingsDetail($domein, $i+1, $mensen, $rij['afspraak'], $rij['einddatum']);
     if ($rij['afspraak'] == "" || $rij['einddatum'] == "") {
        print("<script type=\"text/javascript\">nietAllesIngevuldOpBegeleidingsplan = true;</script>\n");
     }
   }
   return $i;
}

function toonBegeleidingsplan($domeinTabel, $domeinLang, $tooltip, $actief, $overleg, $afgerond) {
  global $mensenGlobaal;
  if ($actief == 0) {
    $verberg = " style=\"display:none;\" ";
  }
?>
   <div class="planTabel" id="<?= $domeinTabel ?>Plan"  <?= $verberg ?>>
      <h2 title="<?= $tooltip ?>"><?= $domeinLang ?></h2>
      <table id="<?= $domeinTabel ?>PlanIntern" style="width:570px;border: 1px solid;">
         <tr>
           <th>Actienemer(s)</th>
           <th>Afspraak</th>
           <th>Einddatum</th>
         </tr>
<?php
  if ($actief == 1) {
    $nr = toonPlanDetails($domeinTabel,$overleg, $afgerond);
  }
  else {
    $nr = 0;
  }
     //insertBegeleidingsDetail($domeinTabel, $nr+1, $mensenGlobaal,"","");
?>
<script type="text/javascript">
  var aantalAfspraken<?= $domeinTabel ?> = new BoxedInteger(<?= $nr+1 ?>);
</script>
      <tr>
      <td colspan="3"><a class="subtiel" href="javascript:insertAfspraak('<?= $domeinTabel ?>',aantalAfspraken<?= $domeinTabel ?>);">+</a></td>
      </tr>
      </table>
      <hr/>
   </div>
<?php
}

/******** begeleidingsplan beknopt ************/
function toonBegeleidingsplanBeknopt($overlegID) {
  // eerst effe kijken of er al een plan is voor dit overleg
  $qry = "select * from psy_plan where overleg_id = $overlegID
          order by (domein='basis')*1+
                   (domein='woon')*2+
                   (domein='gemeenschap')*3+
                   (domein='taal')*4+
                   (domein='maatschappij')*5+
                   (domein='werk')*6+
                   (domein='gezin')*7+
                   (domein='school')*8+
                   (domein='sociaal')*9+
                   (domein='motoriek')*10+
                   (domein='persoonlijk')*11 asc,
                    id asc";
  $planTextResult = mysql_query($qry) or die("we kunnen het plan van dit overleg niet ophalen " .mysql_error() . $qry);

  print("<table>\n");
  print("<tr><th>Domein</th><th>Actienemer(s)</th><th>Afspraak</th><th>Einddatum</th></tr>\n");
  for ($i=0; $i<mysql_num_rows($planTextResult); $i++) {
    $planText = mysql_fetch_assoc($planTextResult);
    print("  <tr><td valign=\"top\">{$planText['domein']}</td><td>");
    printMensenPlan($planText['id']);
    print("</td><td valign=\"top\">{$planText['afspraak']}</td><td valign=\"top\">{$planText['einddatum']}</td></tr>\n");
  }
  
  print("</table>\n");
}


function printMensenPlan($planId) {
  $qryHVL = "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam
             from (hulpverleners hvl inner join psy_plan_mens ppm on ppm.persoon_id = hvl.id and ppm.genre = 'hulp' and ppm.plan = $planId)
             ";
  $qryMantel = "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam
             from (mantelzorgers hvl inner join psy_plan_mens ppm on ppm.persoon_id = hvl.id and ppm.genre = 'mantel' and ppm.plan = $planId)
             ";
  $qrySpeciaal = "select genre as naam from psy_plan_mens where plan = $planId and genre in ('oc','patient','ander')
             ";

  $resultHVL = mysql_query($qryHVL) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryHVL " .mysql_error());
  $txt = "";
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    $txt .= "{$mens['naam']}<br/>\n";
  }
  $offset = $i;
  $resultMantel = mysql_query($qryMantel) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryMantel " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultMantel); $i++) {
    $mens = mysql_fetch_assoc($resultMantel);
    $txt .= "{$mens['naam']}<br/>\n";
  }

  $resultSpeciaal = mysql_query($qrySpeciaal) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qrySpeciaal " .mysql_error());
  $speciaal = array();
  for ($i=0; $i < mysql_num_rows($resultSpeciaal); $i++) {
    $mens = mysql_fetch_assoc($resultSpeciaal);
    $speciaal[$mens['genre']]=1;
  }
  if ($speciaal['patient']==1)
    $txt .= "Patient<br/>\n";
  if ($speciaal['oc']==1)
    $txt .= "OC<br/>\n";
  if ($speciaal['ander']==1)
    $txt .= "Ander<br/>\n";
  print($txt);
}

/******** einde begeleidingsplan beknopt ************/

/******** begin begeleidingsplan PDF *************/
function pdfBegeleidingsplanVolledig($overlegID, $afgerond) {

/*
  global $mensenGlobaal;

  if ($afgerond == 1) {
    $mensenGlobaal = getSelectMensen(getQueryHVLAfgerond($overlegID),getQueryMZAfgerond($overlegID),getQuerySpeciaal());
  }
  else {
    $mensenGlobaal = getSelectMensen(getQueryHVLHuidig($_SESSION['pat_code']),getQueryMZHuidig($_SESSION['pat_code']),getQuerySpeciaal());
  }
*/
  global $domeinen;

  pdfBegeleidingsplan("basis","basisautonomie","dit domein omvat de activiteiten die onmisbaar zijn voor de bevrediging van de persoonlijke basisbehoeften: wassen, aankleden, eten, ...",$domeinen['basis'],$overlegID, $afgerond);
  pdfBegeleidingsplan("woon","woonautonomie","betreft hier de noodzakelijke vaardigheden voor de dagdagelijkse organisatie op huishoudelijk vlak: koken, het huishouden doen, wassen en strijken, zorg dragen voor zijn gezondheid en zijn veiligheid.",$domeinen['woon'],$overlegID, $afgerond);
  pdfBegeleidingsplan("gemeenschap","autonomie binnen de gemeenschap","vaardigheden die vereist zijn om zich te verplaatsen in de samenleving, (leren) omgaan met geld, (kleine) aankopen doen, zelfstandig verplaatsen (fiets, openbaar vervoer, ...), de wetten en de reglementen van de samenleving respecteren",$domeinen['gemeenschap'],$overlegID, $afgerond);
  pdfBegeleidingsplan("taal","taal en communicatie","dit domein betreft de communicatie in zijn receptieve en expressieve aspecten. De beoogde vaardigheden hebben hoofdzakelijk betrekking op de mogelijkheden om contact te hebben met anderen.",$domeinen['taal'],$overlegID, $afgerond);
  pdfBegeleidingsplan("maatschappij","maatschappelijke aanpassing","de hier beoogde vaardigheden zijn die vaardigheden die vereist zijn om zich in te schakelen in een groep of een vereniging. Het betreft hier de houding tegenover zichzelf (zelfkennis en zelfbeeld), de houding tegenover anderen (inter-persoonlijke relaties), de deelname aan het leven van de gemeenschap.",$domeinen['maatschappij'],$overlegID, $afgerond);
  pdfBegeleidingsplan("werk","werk","hier gaat het om de essenti&euml;le componenten voor een professionele integratie: motivatie, basisbekwaamheden, vaardigheden, de capaciteiten om zich in te schakelen in een ploeg.",$domeinen['werk'],$overlegID, $afgerond);
  pdfBegeleidingsplan("gezin","functioneren in het gezin of in de gezinsvervangende context","het gaat hier om de handhaving van een vertrouwensrelatie met ouders of andere zorgverantwoordelijken, en van bekwaamheden in het samenleven met andere kinderen, al dan niet broers en zussen.",$domeinen['gezin'],$overlegID, $afgerond);

  global $patient;
  if ($patient['type']==18) {
     pdfBegeleidingsplan("school","schoolse kennis","Dit omvat de intellectuele vaardigheden van het individu, zowel wat elementaire kennis betreft als wat lezen, schrijven en rekenen betreft.",$domeinen['school'],$overlegID, $afgerond);
  }
  else {
     pdfBegeleidingsplan("school","school","Het gaat hier om de essenti&euml;le componenten voor een inschakeling in een schoolcontext: motivatie, basisbekwaamheden, sociale vaardigheden, de capaciteiten om te functioneren in een gezagsrelatie. Het gaat zowel om de cognitieve vaardigheden als om het psychisch en emotioneel functioneren die deze kunnen onderdrukken.",$domeinen['school'],$overlegID, $afgerond);
  }
  pdfBegeleidingsplan("sociaal","sociale aansluiting","de hier beoogde vaardigheden zijn die vaardigheden die vereist zijn om aan te sluiten bij leeftijdsgenoten  Het betreft hier de houding tegenover zichzelf (zelfkennis en zelfbeeld), de houding tegenover anderen (inter-persoonlijke relaties), de deelname aan het buurtleven.",$domeinen['sociaal'],$overlegID, $afgerond);
  pdfBegeleidingsplan("motoriek","motoriek","dit domein omvat de motorische vaardigheden van een individu, zoals: lichaamshouding, basisvaardigheden op motorisch vlak, fijne motoriek, psychomotorische vaardigheden en de mogelijkheden voor het verrichten van fysieke activiteiten.",$domeinen['motoriek'],$overlegID, $afgerond);
  pdfBegeleidingsplan("persoonlijk","aangepast persoonlijk gedrag","dit domein omvat bepaalde gedragingen, houdingen of symptomen die maatschappelijk ongewenst zijn. Waar de vorige domeinen betrekking hebben op vaardigheden die zouden moeten verworven worden of hersteld worden, legt dit domein de nadruk op houdingen of gedragingen die zouden moeten verdwijnen.",$domeinen['persoonlijk'],$overlegID, $afgerond);
}




function getPdfMensen($qryHVL, $qryMantel, $qrySpeciaal) {
  $resultHVL = mysql_query($qryHVL) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryHVL " .mysql_error());
  $mensen = "";
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    $mensen .= $mens['naam'] . "\n";
  }
  $offset = $i;
  $resultMantel = mysql_query($qryMantel) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryMantel " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultMantel); $i++) {
    $mens = mysql_fetch_assoc($resultMantel);
    $mensen .= $mens['naam'] . "\n";
  }
  $offset = $offset+$i;
  $resultSpeciaal = mysql_query($qrySpeciaal) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qrySpeciaal " .mysql_error());
  $speciaal = array();
  for ($i=0; $i < mysql_num_rows($resultSpeciaal); $i++) {
    $mens = mysql_fetch_assoc($resultSpeciaal);
    $mens['naam']=$mens['genre'];
    $mens['plan']=1;
    $mens['id']=1;
    $mensen .= $mens['naam'] . "\n";
  }
  return $mensen;
}
function pdfBegeleidingsplan($domein, $_1, $_2, $actief, $overleg, $afgerond) {
   global $pdf, $mm, $options;
   
   if ($actief == 0) return;
   
   $qry = "select * from psy_plan where overleg_id = $overleg and domein = '$domein' order by id";
   $result = mysql_query($qry) or die("kan het begeleidingsplan voor $domein niet ophalen ($qry)");
   for ($i=0; $i < mysql_num_rows($result); $i++) {
     $rij = mysql_fetch_assoc($result);
     $tabel[$i]['Actienemer(s)'] = pdfMensenPlan($rij['id']);;
     $tabel[$i]['Afspraak'] = pdfaccenten(str_replace("\r","",$rij['afspraak']));
     $tabel[$i]['Einddatum'] = $rij['einddatum'];
     $tabel[$i]['OK'] = " O ";
   }
   
     $tabel[$i+1]['Actienemer(s)'] = "\n\n";
     $tabel[$i+1]['Afspraak'] = "";
     $tabel[$i+1]['Einddatum'] = "";
     $tabel[$i+1]['OK'] = " O ";
if ($actief == 1) {
     $tabel[$i+2]['Actienemer(s)'] = "\n\n";
     $tabel[$i+2]['Afspraak'] = "";
     $tabel[$i+2]['Einddatum'] = "";
     $tabel[$i+2]['OK'] = " O ";
     $tabel[$i+3]['Actienemer(s)'] = "\n\n";
     $tabel[$i+3]['Afspraak'] = "";
     $tabel[$i+3]['Einddatum'] = "";
     $tabel[$i+3]['OK'] = " O ";
}
    $tabelOptions = array();
    $tabelOptions["width"] = 595.28-34*$mm;


   if ($actief == 1) {
     $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans-Bold.afm');
     $y = $pdf->ezText("$domein",12,$options);
     $pdf->selectFont('../ezpdf/fonts/Droid-Sans/DroidSans.afm');
   }
   else {
     $y = $pdf->ezText($domein,12,$options);
   }
   $pdf->ezSetY($y-2*$mm);
   $pdf->ezTable($tabel,"","",$tabelOptions);
   $pdf->ezText(" ",12,$options);
}


/******** begeleidingsplan beknopt ************/
function pdfBegeleidingsplanBeknopt($overlegID) {
  // eerst effe kijken of er al een plan is voor dit overleg
  $qry = "select * from psy_plan where overleg_id = $overlegID
          order by (domein='basis')*1+
                   (domein='woon')*2+
                   (domein='gemeenschap')*3+
                   (domein='taal')*4+
                   (domein='maatschappij')*5+
                   (domein='werk')*6+
                   (domein='gezin')*7+
                   (domein='school')*8+
                   (domein='sociaal')*9+
                   (domein='motoriek')*10+
                   (domein='persoonlijk')*11 asc,
                    id asc";
  $planTextResult = mysql_query($qry) or die("we kunnen het plan van dit overleg niet ophalen " .mysql_error() . $qry);

  print("<table>\n");
  print("<tr><th>Domein</th><th>Actienemer(s)</th><th>Afspraak</th><th>Einddatum</th></tr>\n");
  for ($i=0; $i<mysql_num_rows($planTextResult); $i++) {
    $planText = mysql_fetch_assoc($planTextResult);
    print("  <tr><td valign=\"top\">{$planText['domein']}</td><td>");
    pdfMensenPlan($planText['id']);
    print("</td><td valign=\"top\">{$planText['afspraak']}</td><td valign=\"top\">{$planText['einddatum']}</td></tr>\n");
  }

  print("</table>\n");
}


function pdfMensenPlan($planId) {
  $qryHVL = "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam
             from (hulpverleners hvl inner join psy_plan_mens ppm on ppm.persoon_id = hvl.id and ppm.genre = 'hulp' and ppm.plan = $planId)
             ";
  $qryMantel = "select concat(hvl.naam, ' ', substring(hvl.voornaam, 1,1), '.') as naam
             from (mantelzorgers hvl inner join psy_plan_mens ppm on ppm.persoon_id = hvl.id and ppm.genre = 'mantel' and ppm.plan = $planId)
             ";
  $qrySpeciaal = "select genre as naam from psy_plan_mens where plan = $planId and genre in ('oc','patient','ander')
             ";

  $resultHVL = mysql_query($qryHVL) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryHVL " .mysql_error());
  $txt = "";
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    $txt .= "{$mens['naam']}\n";
  }
  $offset = $i;
  $resultMantel = mysql_query($qryMantel) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qryMantel " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultMantel); $i++) {
    $mens = mysql_fetch_assoc($resultMantel);
    $txt .= "{$mens['naam']}\n";
  }

  $resultSpeciaal = mysql_query($qrySpeciaal) or die("fout met het ophalen van de mensen voor een begeleidingsplan $qrySpeciaal " .mysql_error());
  $speciaal = array();
  for ($i=0; $i < mysql_num_rows($resultSpeciaal); $i++) {
    $mens = mysql_fetch_assoc($resultSpeciaal);
    $speciaal[$mens['genre']]=1;
  }
  if ($speciaal['patient']==1)
    $txt .= "Patient\n";
  if ($speciaal['oc']==1)
    $txt .= "OC\n";
  if ($speciaal['ander']==1)
    $txt .= "Ander\n";
  return($txt);
}
/******** einde begeleidingsplan PDF *************/

function toonCrisisPlan($qry,$referentiePersoon,$isHvl = false) {
  global $allesIngevuld, $alleBereikbaarheden;

  $resultHVL = mysql_query($qry) or die("fout met het ophalen van de mensen van het crisisplan $qry " .mysql_error());
  $txt = "";
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    if ($isHvl) {
       $mens = vervolledigGegevensHVL($mens);
       if ($mens['org_naam']!="")
         $orgOok = "{$mens['org_naam']}<br/>";
    }
    if ($mens['id']==$referentiePersoon) {
      $refPersoon = "<u>REFERENTIEPERSOON</u>";
    }
    else {
      $refPersoon = "";
    }
    if ($mens['email']=="" && $mens['gsm']=="" && $mens['tel']=="") $allesIngevuld = false;
    if ($mens['bereikbaarheid']=="") {
      $alleBereikbaarheden = false;
    }

    $gsmTekst = "";
    $telTekst = "";
    if ($mens['gsm']!="") {
      $gsmTekst="<tr><td>GSM</td><td>{$mens['gsm']}</td></tr>";
    }
    if ($mens['tel']!="") {
      $telTekst="<tr><td>Telefoon</td><td>{$mens['tel']}</td></tr>";
    }

    $txt .= <<< EINDE
<div id="crisis{$mens['genre']}{$mens['id']}" class="crisisplan">
<table>
  <tr><td colspan="2"><strong>{$mens['functie']} {$refPersoon}</strong></td></tr>
  <tr><td>Naam</td><td>{$mens['naam']} {$mens['voornaam']}</td></tr>
  <tr><td>Adres</td><td>$orgOok{$mens['adres']}<br/>{$mens['dlzip']} {$mens['dlnaam']}</td></tr>
  $telTekst
  $gsmTekst
  <tr><td>Email</td><td>{$mens['email']}</td></tr>
  <tr><td>Bereikbaarheid</td><td><textarea style="width:345px;height:30px;" name="n{$mens['betrokkene_id']}">{$mens['bereikbaarheid']}</textarea></td></tr>
</table>
</div>
EINDE;
  }
  return $txt;
}
function tabelCrisisPlan($qry,$referentiePersoon,$isHvl = false) {
  $resultHVL = mysql_query($qry) or die("fout met het ophalen van de mensen van het crisisplan $qry " .mysql_error());
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    if ($isHvl) {
       $mens = vervolledigGegevensHVL($mens);
       if ($mens['org_naam']!="")
         $orgOok = "{$mens['org_naam']}";
    }
    if ($mens['id']==$referentiePersoon) {
      $refPersoon = "<u>REFERENTIEPERSOON</u>\n";
    }
    else {
      $refPersoon = "";
    }

    $gsmTekst = "";
    $telTekst = "";
    if ($mens['gsm']!="") {
      $gsmTekst="GSM: {$mens['gsm']}";
    }
    if ($mens['tel']!="") {
      $telTekst="Tel: {$mens['tel']}";
    }

    $tabel1[$i]['Naam'] = "{$refPersoon}{$mens['naam']} {$mens['voornaam']}";
    $tabel1[$i]['Functie & organisatie'] = "{$mens['functie']}\n$orgOok";
    $tabel1[$i]['Tel. / GSM / email'] = "$telTekst\n$gsmTekst\n{$mens['email']}";
    $tabel1[$i]['Bereikbaarheid'] = "{$mens['bereikbaarheid']}";
  }
  return $tabel1;
}
function tabelDeelnemers($qry,$referentiePersoon,$patientnaam, $qry2) {
  $resultHVL = mysql_query($qry) or die("fout met het ophalen van de mensen van het psy-overleg $qry " .mysql_error());
  $refGevonden = false;
  for ($i=0; $i < mysql_num_rows($resultHVL); $i++) {
    $mens = mysql_fetch_assoc($resultHVL);
    $mens = vervolledigGegevensHVL($mens);
    foreach ($mens as $key => $value) {
      $mens[$key] = pdfaccenten($mens[$key]);
    }

    if ($mens['org_naam']!="")
      $orgOok = "{$mens['org_naam']}";
    if ($mens['id']==$referentiePersoon) {
      $refPersoon = "REFERENTIEPERSOON\n";
      $nr = 0;
      $refGevonden = true;
    }
    else {
      $refPersoon = "";
      if ($refGevonden) $nr = $i+1;
      else $nr = $i+2;
    }

    $gsmTekst = "";
    $telTekst = "";

    if ($mens['gsm']!="") {
      $gsmTekst="GSM: {$mens['gsm']}";
    }
    if ($mens['tel']!="") {
      $telTekst="Tel: {$mens['tel']}";
    }


    $tabel1[$i]['Naam'] = "{$refPersoon}{$mens['naam']} {$mens['voornaam']}";
    $tabel1[$i]['Discipline/sector'] = "{$mens['functie']}\n$orgOok";
                $rizivnr1=substr($mens['riziv1'],0,1)."-".substr($mens['riziv1'],1,5)."-";
                $rizivnr2=      ($mens['riziv2']<10)      ?"0".$mens['riziv2']:$mens['riziv2'];
                $rizivnr3=      ($mens['riziv3']<100)     ?"0".$mens['riziv3']:$mens['riziv3'];
                $rizivnr3=      ($mens['riziv3']<10)      ?"0".$rizivnr3:$rizivnr3;
                $rizivnr=$rizivnr1.$rizivnr2."-".$rizivnr3;
    if ($mens['riziv2']==0) $rizivnr = "";
    $tabel1[$i]['RIZIV-nummer'] = $rizivnr;
    $tabel1[$i]['Rekeningnummer'] = "{$mens['iban']}";
    $tabel1[$i]['Handtekening'] = "";
  }
  $offset = $i+1;
  $resultMZ = mysql_query($qry2) or die("fout met het ophalen van de mensen MZ van het psy-overleg $qry " .mysql_error());
  $refGevonden = false;
  for ($i=0; $i < mysql_num_rows($resultMZ); $i++) {
    $mens = mysql_fetch_assoc($resultMZ);
    $nr = $offset+$i;
    $tabel1[$nr]['Naam'] = "{$mens['naam']} {$mens['voornaam']}";
    $tabel1[$nr]['Discipline/sector'] = "mantelzorger\n ";
    $tabel1[$nr]['RIZIV-nummer'] = " ";
    $tabel1[$nr]['Rekeningnummer'] = "{$mens['reknr']}";
    $tabel1[$nr]['Handtekening'] = "";
  }
    $tabel1[$nr+1]['Naam'] = "$patientnaam";
    $tabel1[$nr+1]['Discipline/sector'] = "patient\n ";
    $tabel1[$nr+1]['RIZIV-nummer'] = " ";
    $tabel1[$nr+1]['Rekeningnummer'] = "";
    $tabel1[$nr+1]['Handtekening'] = "";

    $tabel1[$nr+2]['Naam'] = "";
    $tabel1[$nr+2]['Discipline/sector'] = "";
    $tabel1[$nr+2]['RIZIV-nummer'] = " ";
    $tabel1[$nr+2]['Rekeningnummer'] = "";
    $tabel1[$nr+2]['Handtekening'] = "";

    $tabel1[$nr+3]['Naam'] = "";
    $tabel1[$nr+3]['Discipline/sector'] = "";
    $tabel1[$nr+3]['RIZIV-nummer'] = " ";
    $tabel1[$nr+3]['Rekeningnummer'] = "";
    $tabel1[$nr+3]['Handtekening'] = "";

    $tabel1[$nr+4]['Naam'] = "";
    $tabel1[$nr+4]['Discipline/sector'] = "";
    $tabel1[$nr+4]['RIZIV-nummer'] = " ";
    $tabel1[$nr+4]['Rekeningnummer'] = "";
    $tabel1[$nr+4]['Handtekening'] = "";

  //sort($tabel1);
  return $tabel1;
}

function heeftGGZTaak($overlegID) {
   $qry="
    SELECT
        distinct(bl.persoon_id)
    FROM
        ((psy_plan pl inner join psy_plan_mens pm on pl.overleg_id = $overlegID and pm.genre = 'hulp' and pl.id = pm.plan)
          inner join huidige_betrokkenen bl on bl.persoon_id = pm.persoon_id and bl.genre = pm.genre),
        (hulpverleners h inner join organisatie o on h.organisatie = o.id)
    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.persoon_id=h.id AND
        ((o.ggz = 1) or h.fnct_id in (62,76,117))
        ";
   $result=mysql_query($qry) or print("KO;$qry" . mysql_error());
   $aantalGGZ=mysql_num_rows($result);

   return ($aantalGGZ > 0);
}
function aantalDomeinen($overlegID) {
   $qry="
    SELECT
        count(id)
    FROM
        psy_plan inner join psy_plan_mens on psy_plan.id = psy_plan_mens.plan and genre = 'hulp'
    WHERE overleg_id = $overlegID
    GROUP by domein
    HAVING count(id) > 0
        ";
   $result=mysql_query($qry) or print("KO;$qry" . mysql_error());
   return mysql_num_rows($result);
}



function isEersteOverlegPsy($code, $datum) {
  $qry = "select * from overleg where patient_code = \"$code\" and genre = 'psy' and datum < $datum";
  $resultQry = mysql_query($qry) or die("$qry geeft een fout " .mysql_error());
  return (mysql_num_rows($resultQry)==0);
}


function bijkomendBevat000($patientcode) {
   $qry = "select * from psy_comorbiditeit where patient = '$patientcode' and diagnose = '000.00'";
   $result = mysql_query($qry) or die("kan niet controleren of er geen 000.00 meer in zit");
   return mysql_num_rows($result) > 0;
}
?>


