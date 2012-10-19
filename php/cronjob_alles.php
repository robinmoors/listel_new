<?php


$opsommingListel = "";
$verslagListel = "";

function mailDringendAfTeRonden($qry, $tabel) {
  global $verslagListel;
  global $opsommingListel;
  
  $algemeneTekst = <<< TEKST
<p>
Hieronder, bij <em>Dringend af te ronden vergoedbare overleggen</em>, ziet u alle overleggen die 3 weken geleden plaats vonden en nog niet afgerond zijn.<br/>
Denk eraan nu af te ronden en binnen de week op te sturen naar LISTEL vzw om de vergoeding te kunnen ontvangen. Ter herinnering :
<p>
<h4>CHECKLIST MVO - CONTROLE documenten</h4>

<ol>
<li><span style="color:red">Bijlage 64</span> correct ingevuld met juiste organisaties van de deelnemers en afdeling toewijzing ipv hoofdzetel?</li>
<li>Bijlage 64 correct getekend in puntje 2. en puntje 3. door pati&euml;nt of vertegenwoordiger ?</li>
<li>Deelnemers papieren dossier = e-zorgplan ?</li>
<li>Als NIEUWE deelnemer > 'Voorpagina zorgplan' getekend, gekopieerd, en het origineel in het kaftje aan huis bij pati&euml;nt gestoken ?</li>
<li>is de <span style="color:red">Verklaring Huisarts</span> getekend en ingevuld door de huisarts (een van de twee opties aanduiden!)?</li>
<li>is de <span style="color:red">Verklaring bankrekeningnummers</span> volledig getekend en hebben deelnemers hun reknr gecontroleerd indien ze vergoedbaar zijn?</li>
<li>heb ik de <span style="color:red">de Verklaring organisator</span> getekend en goed ingevuld?</li>
<li>zijn login aanvragen die ik meestuur correct met persoonlijk emailadres ingevuld en heb ik dan in de database ingegeven ?</li>
JA op alles ?</li>
<li>Is het overleg AFGEROND ?</li>
<li>heb ik van alles een kopie voor mezelf gemaakt ?</li>
</ol>
<p>
DAN opsturen naar LISTEL vzw tav Anick Noben , A.Rodenbachstraat 29/1, 3500 Hasselt
</p>
TEKST;
  
  $opsommingListel .= "<h1>Dringend af te ronden vergoedbare overleggen voor $tabel</h1>\n<ul>";
  $verslagListel .= "<h1>Dringend af te ronden vergoedbare overleggen voor $tabel</h1>\n";
  
  $result = mysql_query($qry) or die("Kan het werk niet berekenen...<br/>$qry<br/>" . mysql_error());
  
  for ($i=0; $i< mysql_num_rows($result); $i++) {
    $persoon = mysql_fetch_assoc($result);
    foreach ($persoon as $key => $value) {
      $persoon[$key] = utf8_decode($persoon[$key]);
    }
    $titel = "{$persoon['voornaam']} {$persoon['naam']}";
//print("$titel<br/>");

    if ($tabel == "hulpverleners") $soort = "hulp";
    else $soort = $persoon['profiel'];
    
    if ($tabel == "logins") $isOrganisator = 1;
    else $isOrganisator = $persoon['is_organisator'];
    
    if ($tabel == "hulpverleners") $id = $persoon['id'];
    else if ($persoon['profiel']=="OC") $id = $persoon['overleg_gemeente'];
    else if ($persoon['profiel']=="rdc") $id = $persoon['organisatie'];
    else $id = $persoon['tp_project'];

    if ($id > 0 && $isOrganisator) {
      $drieWekenGeleden = date("Ymd",time()-21*24*60*60);
      $boodschap = getAfTeRondenOverleg($soort, $id, $persoon['id'], "and keuze_vergoeding > 0 and datum = $drieWekenGeleden", "vergoedbare");
      if (strpos($boodschap,"href")>20) {
        $opsommingListel .= "<li>$titel</li>\n";
        $verslagListel .= "<h2>$titel</h2>\n";
        $verslagListel .= $boodschap . "<hr/>\n";
        $inhoudMail = "<style type=\"text/css\">h1 {font-size: 15px;}</style><h4>Beste $titel,</h4>$algemeneTekst $boodschap<p><br/>Deze mail werd automatisch gegenereerd door het e- zorgplan.<br/><br/><br/>Nog een prettige week!<br/><br/>Groeten<br/><br/>Het LISTEL E- zorgplan</p>";
        $verslagListel .= $inhoudMail . "<hr/>\n";
        htmlmailZonderCopy($persoon['email'],"Werkoverzicht LISTEL e-zorgplan",$boodschap);
      }
    }
  }
  $opsommingListel .= "</ul><hr/><hr/>";
}

function mailKatzHerinneringen($qry) {
  global $verslagListel;
  global $opsommingListel;

  $opsommingListel .= "<h1>Katz-herinneringen</h1>\n<ul>";
  $verslagListel .= "<h1>Katz-herinneringen</h1>\n";

  $result = mysql_query($qry) or die("Kan het werk niet berekenen...<br/>$qry<br/>" . mysql_error());

  for ($i=0; $i< mysql_num_rows($result); $i++) {
    $persoon = mysql_fetch_assoc($result);
    foreach ($persoon as $key => $value) {
      $persoon[$key] = utf8_decode($persoon[$key]);
    }
    $titel = "{$persoon['voornaam']} {$persoon['naam']}";
//print("$titel<br/>");

    $id = $persoon['id'];

    if ($id > 0) {

      $boodschap = getKatzMailHerinnering($id);
      if (strpos($boodschap,"href")>20) {
        $opsommingListel .= "<li>$titel</li>\n";
        $verslagListel .= "<h2>$titel</h2>\n";
        $verslagListel .= $boodschap . "<hr/>\n";
        $boodschap = "<p>Beste $titel,<br/><br/>hierbij sturen wij u het LISTEL-werkoverzicht.<br/><p>$boodschap</p><p><br/>Deze mail werd automatisch gegenereerd door het e- zorgplan. Vragen in verband met deze mail of het antwoord op deze mail kan u richten t.a.v. van de overlegco&ouml;rdinator thuisgezondheidszorg die dit overleg organiseerde.<br/><br/><br/>Nog een prettige week!<br/><br/>Groeten<br/><br/>Het LISTEL E- zorgplan</p>";
        htmlmailZonderCopy($persoon['email'],"Werkoverzicht LISTEL e-zorgplan",$boodschap);
      }
    }
  }
  $opsommingListel .= "</ul><hr/><hr/>";
}

function verwittig($qry, $tabel) {
  global $opsommingListel;

  $opsommingListel .= "<h1>Verwittiging voor inactieve logins bij de $tabel</h1>\n<ul>";

  $result = mysql_query($qry) or die("Kan de verwittigingen niet berekenen...<br/>$qry<br/>" . mysql_error());

  for ($i=0; $i< mysql_num_rows($result); $i++) {
    $persoon = mysql_fetch_assoc($result);
    foreach ($persoon as $key => $value) {
      $persoon[$key] = utf8_decode($persoon[$key]);
    }
    $datum = date("d/m/Y H:i:s",$persoon['logindatum']);
    $titel = "{$persoon['voornaam']} {$persoon['naam']}";
    $opsommingListel .= "<li>$titel : laatste login op $datum</li>\n";

    $boodschap = "<p>Beste $titel,<br/><br/>uw login op het LISTEL e-zorgplan is al elf maanden niet meer gebruikt (laatste login op $datum). Wij herinneren u er aan dat logins na twaalf maanden inactiviteit uitgeschakeld worden.<br/>Indien u uw login wil blijven gebruiken, volstaat het om even in- en uit te loggen om de login actief te houden.</p><p><br/>Deze mail werd automatisch gegenereerd door het e- zorgplan. <br/><br/><br/>Nog een prettige week!<br/><br/>Groeten<br/><br/>Het LISTEL E- zorgplan</p>";
    htmlmailZonderCopy($persoon['email'],"Inactieve login voor het LISTEL e-zorgplan",$boodschap);
  }
  $opsommingListel .= "</ul><hr/><hr/>";
}

function schrap($qry, $tabel, $opdracht) {
  global $opsommingListel;

  $opsommingListel .= "<h1><strong>Schrapping</h1> van inactieve logins bij de $tabel</h1>\n<ul>";

  $result = mysql_query($qry) or die("Kan de schrappingen niet berekenen...<br/>$qry<br/>" . mysql_error());

  for ($i=0; $i< mysql_num_rows($result); $i++) {
    $persoon = mysql_fetch_assoc($result);
    foreach ($persoon as $key => $value) {
      $persoon[$key] = utf8_decode($persoon[$key]);
    }
    $datum = date("d/m/Y H:i:s",$persoon['logindatum']);
    $titel = "{$persoon['voornaam']} {$persoon['naam']}";
    $opsommingListel .= "<li>$titel : laatste login op $datum</li>\n";

    $boodschap = "<p>Beste $titel,<br/><br/>uw login op het LISTEL e-zorgplan is al twaalf maanden niet meer gebruikt (laatste login op $datum) wordt daarom geschrapt.</p><p><br/>Deze mail werd automatisch gegenereerd door het e- zorgplan. Vragen in verband met deze mail kan u richten t.a.v. Anick Noben.<br/><br/><br/>Nog een prettige week!<br/><br/>Groeten<br/><br/>Het LISTEL E- zorgplan</p>";
    htmlmailZonderCopy($persoon['email'],"Login voor het LISTEL e-zorgplan is geschrapt",$boodschap);
    
    mysql_query("update $tabel set $opdracht where id = {$persoon['id']}") or die("update $tabel set $opdracht where id = {$persoon['id']} lukt niet");
  }
  $opsommingListel .= "</ul><hr/><hr/>";
}

function verwittigMenos($qry) {
  global $opsommingListel;

  $boodschap = "<h1>In te vullen meetschalen</h1>\nBeste menos-coordinatoren,<br/>Voor volgende pati&euml;nten is de laatste meetschaal al ouder dan 5 maanden.<ul>";
  $opsommingListel .= $boodschap;

  $result = mysql_query($qry) or die("Kan het werk niet berekenen...<br/>$qry<br/>" . mysql_error());

  for ($i=0; $i< mysql_num_rows($result); $i++) {
    $persoon = mysql_fetch_assoc($result);
    foreach ($persoon as $key => $value) {
      $persoon[$key] = utf8_decode($persoon[$key]);
    }
    $boodschap .= "<li>{$persoon['voornaam']} {$persoon['naam']} ({$persoon['patient']}) - {$persoon['meetschaal_dag']}/{$persoon['meetschaal_maand']}/{$persoon['meetschaal_jaar']}</li>";
  }
  $boodschap .= "</ul>";
  $opsommingListel .= $boodschap;
  htmlmailZonderCopy("l.abdelmalek@cgglitp.be,dr.kris.aerts@gmail.com","In te vullen meetschalen op LISTEL e-zorgplan",$boodschap);
}

function opvolgingAanvraag() {
  global $opsommingListel;

  if (date("d")<7) {
    $maand = date("n");
    if (date("n") == 2)
      $zesDagen = mktime(date("G"),date("i"),date("s"),date("n")-1,28+date("j")-6,date("Y"));
    else if (date("n") == 1 || date("n") == 3 || date("n") == 5 || date("n") == 7 || date("n") == 8 || date("n") == 10 || date("n") == 12)
      $zesDagen = mktime(date("G"),date("i"),date("s"),date("n")-1,31+date("j")-6,date("Y"));
    else
      $zesDagen = mktime(date("G"),date("i"),date("s"),date("n")-1,30+date("j")-6,date("Y"));
  }
  else
    $zesDagen = mktime(date("G"),date("i"),date("s"),date("n"),date("j")-6,date("Y"));
  $qry = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                 1 as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister and (p.actief = 1 or p.actief = -1 or p.menos = 1))
            where
               a.timestamp < $zesDagen and (ontvangst is NULL and status in ('aanvraag'))
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";


  $result = mysql_query($qry);
  if (mysql_num_rows($result) == 0) return;
  
  $tekst = "";
  $headerBestaande = true;
  $headerOvername = true;
  $headerNieuw = true;
  $dringend = 0;

  if (mysql_num_rows($result)>0) {
    for ($i = 0; $i < mysql_num_rows($result); $i++) {
      $patient = mysql_fetch_assoc($result);
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
        $info = "{$patient['pat_naam']} {$patient['voornaam']} ({$patient['code']})";
      }
      $nietWeigeren = false;
      switch ($linksoort) {
         case "overleg":
           $linktitel = "<a href=\"$siteadres/php/overleg_alles.php?patient={$patient['code']}&aanvraag={$patient['id']}\">maak een overleg</a>";
           break;
         case "overname":
           if ($patient['status'] == "overname")
              $linktitel = "<a href=\"$siteadres/php/patient_overnemen.php?code={$patient['code']}&aanvraag={$patient['id']}\" target=\"_blank\">cre&euml;er nieuwe patient</a>";
           else {
              $linktitel = "<em>de overname is aangevraagd</em>";
              $nietWeigeren = true;
           }
           break;
         case "nieuw":
           $linktitel = "<a href=\"$siteadres/php/patient_nieuw.php?rr={$patient['rijksregister']}\">cre&euml;er nieuwe patient</a>";
           break;
      }

      $datum = date("d/m/Y",$patient['timestamp']);
      $tekst .= "<li>$info op $datum: $linktitel";
      if ($nietWeigeren) {
        $tekst .= "</li>\n";
      }
      else {
        $tekst .= " of <a href=\"$siteadres/php/aanvraag_overleg_weigeren.php?aanvraag={$patient['id']}\">weiger</a></li>\n";
      }

      if ($soort == "listel" || $soort =="") {
        if ($patient['keuze_organisator']=="ocmw") {
          $gemeenteInfo = getUniqueRecord("select * from gemeente where id ={$patient['gemeente_id']}");
          $aangevraagd = "ocmw {$gemeenteInfo['dlnaam']}: ";
          $aangevraagd .= "<ul>";
          $ocQry = "select * from logins where overleg_gemeente = {$gemeenteInfo['zip']} and actief = 1 and not (naam like '%help%') ";
          $ocResult = mysql_query($ocQry) or die("kan oc niet vinden $ocQry");
          for ($o = 0; $o < mysql_num_rows($ocResult); $o++) {
            $oc = mysql_fetch_assoc($ocResult);
            $aangevraagd .= "<li>{$oc['voornaam']} {$oc['naam']} {$oc['tel']} {$oc['email']}</li>";
          }
          $aangevraagd .= "</ul>";
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

      $tekst .= "<div style=\"margin-left:20px;font-size:90%;background-color: #f0e5d6;width:500px;\">Aanvrager: {$patient['naam_aanvrager']}, {$patient['discipline_aanvrager']}, {$patient['organisatie_aanvrager']}{$patient['info_aanvrager']}<br/>
                                           $orgTekst
                                           Doel: $doel <br/>&nbsp;  </div>\n";
    }
    $tekst .= ("</ul>");
  }
  // mail $tekst naar Wendy;
  $opsommingListel .= "<h2>Opvolging aanvraag overleg</h2>$tekst";
  htmlmail("Wendy.Coemans@listel.be","Niet tijdig bekeken aanvragen voor een overleg", "Dag Wendy,<br/><p>Volgende aanvragen werden niet binnen de 5 dagen bekeken.</p>$tekst");
}


function herinneringVolgendOverleg() {
  global $opsommingListel;

  if (date("d")<7) {
    $maand = date("n");
    if (date("n") == 2)
      $zesDagen = mktime(date("G"),date("i"),date("s"),date("n")-1,28+date("j")-6,date("Y"));
    else if (date("n") == 1 || date("n") == 3 || date("n") == 5 || date("n") == 7 || date("n") == 8 || date("n") == 10 || date("n") == 12)
      $zesDagen = mktime(date("G"),date("i"),date("s"),date("n")-1,31+date("j")-6,date("Y"));
    else
      $zesDagen = mktime(date("G"),date("i"),date("s"),date("n")-1,30+date("j")-6,date("Y"));
  }
  else
    $zesDagen = mktime(date("G"),date("i"),date("s"),date("n"),date("j")-6,date("Y"));
  $qry = "select distinct a.*, p.code, p.naam as pat_naam, p.voornaam, toegewezen_genre, toegewezen_id,
                 1 as juist
              from (aanvraag_overleg a left join patient p on p.rijksregister = a.rijksregister and (p.actief = 1 or p.actief = -1 or p.menos = 1))
            where
               a.timestamp < $zesDagen and (ontvangst is NULL and status in ('aanvraag'))
            order by dringend*1000 + (toegewezen_genre is not null)*100 + (p.code is not null) desc, pat_naam
            ";


  $result = mysql_query($qry);
  if (mysql_num_rows($result) == 0) return;

  $tekst = "";
  $headerBestaande = true;
  $headerOvername = true;
  $headerNieuw = true;
  $dringend = 0;

  if (mysql_num_rows($result)>0) {
    for ($i = 0; $i < mysql_num_rows($result); $i++) {
      $patient = mysql_fetch_assoc($result);
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
        $info = "{$patient['pat_naam']} {$patient['voornaam']} ({$patient['code']})";
      }
      $nietWeigeren = false;
      switch ($linksoort) {
         case "overleg":
           $linktitel = "<a href=\"$siteadres/php/overleg_alles.php?patient={$patient['code']}&aanvraag={$patient['id']}\">maak een overleg</a>";
           break;
         case "overname":
           if ($patient['status'] == "overname")
              $linktitel = "<a href=\"$siteadres/php/patient_overnemen.php?code={$patient['code']}&aanvraag={$patient['id']}\" target=\"_blank\">cre&euml;er nieuwe patient</a>";
           else {
              $linktitel = "<em>de overname is aangevraagd</em>";
              $nietWeigeren = true;
           }
           break;
         case "nieuw":
           $linktitel = "<a href=\"$siteadres/php/patient_nieuw.php?rr={$patient['rijksregister']}\">cre&euml;er nieuwe patient</a>";
           break;
      }

      $datum = date("d/m/Y",$patient['timestamp']);
      $tekst .= "<li>$info op $datum: $linktitel";
      if ($nietWeigeren) {
        $tekst .= "</li>\n";
      }
      else {
        $tekst .= " of <a href=\"$siteadres/php/aanvraag_overleg_weigeren.php?aanvraag={$patient['id']}\">weiger</a></li>\n";
      }

      if ($soort == "listel" || $soort =="") {
        if ($patient['keuze_organisator']=="ocmw") {
          $gemeenteInfo = getUniqueRecord("select * from gemeente where id ={$patient['gemeente_id']}");
          $aangevraagd = "ocmw {$gemeenteInfo['dlnaam']}: ";
          $aangevraagd .= "<ul>";
          $ocQry = "select * from logins where overleg_gemeente = {$gemeenteInfo['zip']} and actief = 1 and not (naam like '%help%') ";
          $ocResult = mysql_query($ocQry) or die("kan oc niet vinden $ocQry");
          for ($o = 0; $o < mysql_num_rows($ocResult); $o++) {
            $oc = mysql_fetch_assoc($ocResult);
            $aangevraagd .= "<li>{$oc['voornaam']} {$oc['naam']} {$oc['tel']} {$oc['email']}</li>";
          }
          $aangevraagd .= "</ul>";
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

      $tekst .= "<div style=\"margin-left:20px;font-size:90%;background-color: #f0e5d6;width:500px;\">Aanvrager: {$patient['naam_aanvrager']}, {$patient['discipline_aanvrager']}, {$patient['organisatie_aanvrager']}{$patient['info_aanvrager']}<br/>
                                           $orgTekst
                                           Doel: $doel <br/>&nbsp;  </div>\n";
    }
    $tekst .= ("</ul>");
  }
  // mail $tekst naar Wendy;
  $opsommingListel .= "<h2>Opvolging aanvraag overleg</h2>$tekst";
  htmlmail("Wendy.Coemans@listel.be","Niet tijdig bekeken aanvragen voor een overleg", "Dag Wendy,<br/><p>Volgende aanvragen werden niet binnen de 5 dagen bekeken.</p>$tekst");
}


require("../includes/dbconnect2.inc");

/********* eerst de katzherinneringen doorsturen *********/
$qry = "select * from hulpverleners
        where actief = 1 and email is not null
        order by naam, voornaam";
mailKatzHerinneringen($qry);


  /********* dan het werkoverzicht doorsturen *********/
  // query voor alle actieve logins (ocmw, rdc, tp)
  $qry = "select * from logins
        where actief = 1 and email is not null
          and profiel in ('OC','hoofdproject','bijkomend project','rdc')
          order by naam, voornaam";
  mailDringendAfTeRonden($qry,"logins");

  // query voor alle actieve organisatoren HVL
  //   (miv zorgbemiddelaars)
  $qry = "select * from hulpverleners
        where validatiestatus = 'gevalideerd'
          and actief = 1 and email is not null
        order by naam, voornaam";
  mailDringendAfTeRonden($qry,"hulpverleners");

  /********* en nu de logins verwittigen die al niet actief zijn **********/
if (date("w")==0) {
  if (date("m")<11)
    $elfMaanden = mktime(date("G"),date("i"),date("s"),date("n")+1,date("j"),date("Y")-1);
  else
    $elfMaanden = mktime(date("G"),date("i"),date("s"),date("n")-11,date("j"),date("Y"));

  $twaalfMaanden = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y")-1);


  // query voor alle actieve logins die al 2 maanden niet gebruikt zijn
  $qry = "select * from logins
        where actief = 1 and email is not null
          and login not like 'help%'
          and logindatum > 0
          and logindatum <= $elfMaanden
          and profiel in ('OC','hoofdproject','bijkomend project','rdc')
          order by naam, voornaam";
  verwittig($qry,"logins");

  // query voor alle actieve organisatoren HVL
  //   (miv zorgbemiddelaars)
  $qry = "select * from hulpverleners
        where validatiestatus = 'gevalideerd'
          and login not like 'help%'
          and logindatum > 0
          and logindatum <= $elfMaanden
          and actief = 1 and email is not null
        order by naam, voornaam";
  verwittig($qry,"hulpverleners");


  // query voor alle actieve logins die al 12 maanden niet gebruikt zijn
  $qry = "select * from logins
        where actief = 1 and email is not null
          and login not like 'help%'
          and logindatum > 0
          and logindatum <= $twaalfMaanden
          and profiel in ('OC','hoofdproject','bijkomend project','rdc')
          order by naam, voornaam";
  if (date("Ymd") > 20100531) schrap($qry,"logins","actief = 0");

  // query voor alle actieve organisatoren HVL
  //   (miv zorgbemiddelaars)
  $qry = "select * from hulpverleners
        where validatiestatus = 'gevalideerd'
          and login not like 'help%'
          and logindatum > 0
          and logindatum <= $twaalfMaanden
          and actief = 1 and email is not null
        order by naam, voornaam";
  if (date("Ymd") > 20100531) schrap($qry,"hulpverleners","validatiestatus = 'weigering'");
  
  
    /********* en nu menos verwittigen vanaf 5 maand na vorige schaal **********/

  $dag = date("d");
  $maand = date("m");
  $jaar = date("Y");

  // query voor alle actieve logins die al 2 maanden niet gebruikt zijn
  $qryMenos = "select naam, voornaam, patient_menos.* from patient inner join patient_menos on patient = code
        and menos = 1
          and
          (
            ($maand < 6 and (
                              (meetschaal_jaar+1 < $jaar)
                              or
                              (meetschaal_jaar+1 = $jaar and meetschaal_maand-7 < $maand)
                              or
                              (meetschaal_jaar+1 = $jaar and meetschaal_maand-7 = $maand and meetschaal_dag < $dag)
                            )
            )
            or
            ($maand >= 6 and (
                              (meetschaal_jaar < $jaar)
                              or
                              (meetschaal_jaar = $jaar and meetschaal_maand+5 < $maand)
                              or
                              (meetschaal_jaar+1 = $jaar and meetschaal_maand+5 = $maand and meetschaal_dag < $dag)
                            )
            )
          )
          order by naam, voornaam";
  verwittigMenos($qryMenos);

   //htmlmailZonderCopy("dr.kris.aerts@gmail.com","Listel: wekelijkse cronjob","$opsommingListel<hr/>$verslagListel");
 //print("$opsommingListel<hr/>$verslagListel");

}
  opvolgingAanvraag();






?>