<?php

session_start();

$paginanaam="Verslag Therapeutisch Project";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {





    $tabel = $_POST['tabel']; // "huidige" of "afgeronde"



    $overlegID = $_POST['id'];



    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    $querypat = "

         SELECT 

                p.naam,

                p.voornaam,

                p.adres,

                g.dlzip,

                g.dlnaam,
                g.deelvzw,
                p.gebdatum,

                p.id, p.code,

                p.mutnr,

                patient_tp.project,

                patient_tp.opname_overige,

                tp_project.naam as project_naam,

                tp_project.nummer as project_nummer,

                datum, tp_verslag, tp_auteur

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

              datum >= replace(patient_tp.begindatum, '-', '') AND

              (  datum <= replace(patient_tp.einddatum, '-', '')

                   or

                 patient_tp.einddatum is NULL

              ) and

                p.gem_id=g.id"; // Query

      if ($resultpat=mysql_query($querypat))

        {

            $alleInfo= mysql_fetch_array($resultpat);

        }

      else {

        die("dieje query $querypat alles van het patient en project op te halen toch..." .mysql_error());

      }



    if ($tabel == "afgeronde")

      $voorwaarde = "overleg_id = $overlegID";

    else

      $voorwaarde = "patient_code = '{$alleInfo['code']}'";





    $datum = $alleInfo['datum'];

    $mooieDatum = substr($datum, 6,2) . "/" . substr($datum, 4,2) . "/" . substr($datum, 0,4);

    

    if (isEersteOverlegTP_op($datum)) {

      $soortVergadering = "inclusieoverleg";

      $lidwoord = "het";

    }

    else {

      $soortVergadering = "opvolgvergadering";

      $lidwoord = "de";

    }

    

    if ($alleInfo['opname_overige']!="") {

      $opnameOverige = "<span style='margin-left: 50px;'>{$alleInfo['opname_overige']}</span><br/>";

    }

    

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    ?>

    <style type="text/css">

      .rand{border-bottom:1px solid black;border-right:1px solid black;}

      .randtable{border-top:1px solid black;border-left:1px solid black;}

    </style>

    </head>

    <body onLoad="parent.print()">

    <div align="left">

    <div class="pagina">

    <table width="530">



    <tr><td style="valign: center;">

<?php
  if ($alleInfo['deelvzw']=="G") {
    $src = "SelG.jpg";
    $naamListel = "SEL Genk";
  }
  else if ($alleInfo['deelvzw']=="H") {
    $src = "SelH.jpg";
    $naamListel = "SEL Hasselt";
  }
  else {
    $src = "logo_top_pagina_klein.gif";
    $naamListel = "GDT Listel vzw";
  }
?>
               <img style="float:left;margin-right: 30px;" src="../images/<?= $src ?>" height="100" />

               <br/>Therapeutisch project nr. <?= $alleInfo['project_nummer'] ?><br/><br/>

               "<strong><?= $alleInfo['project_naam'] ?>"</strong>

           </td>

       </tr>

       

       <tr><td><hr /></td></tr>

       

       <tr>

        <td style="text-align:center">

          <h1 style="font-size: 40px;">Verslag</h1>

          <h2><?= $soortVergadering ?></h2>

        </td>

       </tr>



       <tr><td><hr /></td></tr>





    <tr><td><u>Identificatiegegevens van de pati&euml;nt</u></td></tr>

    <tr><td>Naam en voornaam: <?php print($alleInfo['naam']." ".$alleInfo['voornaam']);?><br />

<!--    Adres: <?php print ($alleInfo['adres']); ?> -

           <?php if ($alleInfo['dlzip']!=-1) print ($alleInfo['dlzip']); ?>

           <?php print ($alleInfo['dlnaam']); ?>

           <br />

-->

    Geboortedatum: <?php print(substr($alleInfo['gebdatum'],6,2)."/".substr($alleInfo['gebdatum'],4,2)."/".substr($alleInfo['gebdatum'],0,4));?><br />

<!--    Inschrijvingsnummer VI: <?php print($alleInfo['mutnr']);?><br />&nbsp;</td></tr>   -->





       <tr><td><hr /></td></tr>



       <tr>

         <td>

            Datum van <?= "$lidwoord $soortVergadering : $mooieDatum " ?>

         </td>

       </tr>



<?php

  if ($soortVergadering == "inclusieoverleg") {

     $qryPartners = "select organisatie.naam from patient_tpopname , organisatie

                     where patient_tpopname.patient = '{$alleInfo['code']}' and project = {$alleInfo['project']} and partner = organisatie.id

                     order by organisatie.naam";

     $resultPartners = mysql_query($qryPartners) or die($qryPartners . mysql_error());

     $partners = "";

     for ($j = 0; $j < mysql_num_rows($resultPartners); $j++) {

        $rijPartner = mysql_fetch_assoc($resultPartners);

        $partners .= "<span style='margin-left: 50px;'>{$rijPartner['naam']}</span><br/>";

     }

?>

<tr>



<td>

  <div style="text-decoration: underline">Gemaakte Afspraken</div>

<p>  Pati&euml;nt <?php print($alleInfo['naam']." ".$alleInfo['voornaam']);?> wordt opgenomen in het therapeutisch project op voorstel van

   <br /><?="$partners" ?><?= $opnameOverige ?><br/>

</p>

<p>

Het voorstel tot inclusie werd onderzocht tijdens het overleg tussen de partners van het project.

</p>

<p>

Hieruit wordt besloten dat:

</p>

<p>



<ul>

<li>De pati&euml;nt tot de doelgroep van het therapeutisch project behoort en de tenlasteneming van de pati&euml;nt binnen de werkingsgebied van het project kan plaatsvinden

</li>

<li>De tenlasteneming van de pati&euml;nt in het raam van het therapeutisch project gunstig is voor zijn gezondheidstoestand, zijn autonomie, zijn integratie in zijn leefomgeving en/of socio-economische leefomstandigheden

</li>

<li>De partners van het project zijn het eens geworden over een plan van tenlasteneming dat de verwachte inbreng van ieder van hen ten opzichte van de pati&euml;nt toelicht, alsook over het al dan niet betrekken van externe partners bij de uitvoering van het behandelingsplan. (cfr. Plan van tenlasteneming)

</li>

</ul>





  <div style="text-decoration: underline"><h2>Bijkomende afspraken</h2></div>

</td>

</tr>

<?php

  }

  else {

    print('<tr><td><div style="text-decoration: underline"><h2>Afspraken</h2></div></td></tr>\n');

  }

?>

<tr>

<td>

<?php

if (($_SESSION['profiel']=="OC" && $alleInfo['tp_auteur']=="OC") || ($_SESSION['profiel'] != "OC")) {

  if ($alleInfo['tp_verslag']!= "") {

    print("<div >" . nl2br($alleInfo['tp_verslag']));

  }

  else {

    print('<div style="min-height: 500px">');

  }

}

else {

  print('<div style="min-height: 500px">');

}

?>

</div>

</td>

</tr>

<tr>

<td>

    <table cellpadding="15" width="100%"  class="randtable"><tr>

        <th class="rand" >Organisatie</th>

        <th class="rand" >Naam</th>

        <th class="rand" >Functie</th>

        <th class="rand" >Handtekening</th>

        </tr>

<!--

        <tr><td class='rand' valign='top'>GDT LISTEL vzw</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='bottom'>.................</td></tr>

-->

<?php

     $qryPartners = "select organisatie.naam as orgnaam,

                            organisatie.genre as orggenre,

                            org2.naam as namens_naam,

                            hulpverleners.naam,

                            hulpverleners.voornaam,

                            functies.naam as functie,

                            {$tabel}_betrokkenen.genre

                     from {$tabel}_betrokkenen left join organisatie org2 on namens = org2.id,

                          hulpverleners,

                          organisatie,

                          functies

                     where overleggenre = 'gewoon' AND
                       ({$tabel}_betrokkenen.genre = 'orgpersoon' or   {$tabel}_betrokkenen.genre = 'hulp')
                       and persoon_id = hulpverleners.id

                       and hulpverleners.organisatie = organisatie.id

                       and hulpverleners.fnct_id = functies.id

                       and $voorwaarde

                       and aanwezig = 1

                     order by {$tabel}_betrokkenen.genre DESC, {$tabel}_betrokkenen.namens, functies.rangorde, {$tabel}_betrokkenen.id";

     $resultPartners = mysql_query($qryPartners) or die($qryPartners . mysql_error());

     $eindePartners = false;

     for ($j = 0; $j < mysql_num_rows($resultPartners); $j++) {

        $rijPartner = mysql_fetch_assoc($resultPartners);

        if (!$eindePartners && $rijPartner['genre']=="hulp" &&

               ($rijPartner['orggenre']=="ZVL" || $rijPartner['orggenre']=="HVL")) {

          $eindePartners = true;

          print("<tr><td class=\"rand\" colspan=\"4\">$naamListel vertegenwoordigd door:</td></tr>");

        }

        if ($rijPartner['namens_naam'] != "" && $rijPartner['namens_naam'] != $rijPartner['orgnaam']) {

            print("<tr><td class='rand' valign='top'>{$rijPartner['namens_naam']} <strong>vertegenwoordigd door</strong><br/>{$rijPartner['orgnaam']} <!-- {$rijPartner['orggenre']} --></td>

                   <td class='rand' valign='top'>{$rijPartner['naam']} {$rijPartner['voornaam']}</td>

                   <td class='rand' valign='top'>{$rijPartner['functie']}</td>

                   <td class='rand' valign='bottom'>.................</td></tr>\n");

        }

        else {

            print("<tr><td class='rand' valign='top'>{$rijPartner['orgnaam']} <!--{$rijPartner['orggenre']}--></td>

                   <td class='rand' valign='top'>{$rijPartner['naam']} {$rijPartner['voornaam']}</td>

                   <td class='rand' valign='top'>{$rijPartner['functie']}</td>

                   <td class='rand' valign='bottom'>.................</td></tr>\n");

        }

     }

            print("<tr><td class='rand' valign='top'>&nbsp;</td>

                   <td class='rand' valign='top'>{$alleInfo['naam']} {$alleInfo['voornaam']}</td>

                   <td class='rand' valign='top'>Pati&euml;nt</td>

                   <td class='rand' valign='bottom'>.................</td></tr>\n");



?>

<?php

    $queryMZ = "

         SELECT

                bl.id,

                m.naam as naam,

                m.voornaam,

                bl.persoon_id,

                v.naam as verwantschap_naam,

                v.rangorde,

                aanwezig

            FROM

                {$tabel}_betrokkenen bl,

                mantelzorgers m,

                verwantschap v

            WHERE
                overleggenre = 'gewoon' AND
                bl.persoon_id = m.id AND

                bl.genre = 'mantel' AND

                v.id = m.verwsch_id AND

                $voorwaarde

                and aanwezig = 1

            ORDER BY

                v.rangorde,m.naam";

     $resultMZ = mysql_query($queryMZ) or die($queryMZ . mysql_error());

     for ($j = 0; $j < mysql_num_rows($resultMZ); $j++) {

        $rijPartner = mysql_fetch_assoc($resultMZ);

            print("<tr><td class='rand' valign='top'>&nbsp;</td>

                   <td class='rand' valign='top'>{$rijPartner['naam']} {$rijPartner['voornaam']}</td>

                   <td class='rand' valign='top'>{$rijPartner['verwantschap_naam']}</td>

                   <td class='rand' valign='bottom'>.................</td></tr>\n");

     }



?>

        <tr><td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='bottom'>.................</td></tr>

        <tr><td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='bottom'>.................</td></tr>

        <tr><td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='top'>.................</td>

                   <td class='rand' valign='bottom'>.................</td></tr>

        </table>

</td>

</tr>

<tr>

<td style="font-size:9px;text-align:justify">

Door hun handtekening te plaatsen, verklaren de deelnemende zorg- en hulpverleners

dat zij akkoord gaan met het bijgevoegd verslag en dat een kopie van dit verslag

zal bezorgd worden aan <?= $naamListel ?> in het kader van de facturatie van het overleg .

<br/>

Een duplicaat van dit verslag wordt administratief bewaard volgens de wet dd. 08/12/92

op de bescherming van de persoonlijke levenssfeer t.o.v. de verwerking van persoonsgegevens zoals gewijzigd.

U hebt inzage in de gegevens die betrekking hebben op uw persoon, en kan ze steeds laten verbeteren.

De door u verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, Rodenbachstraat 29/1, worden verwerkt.

Zij zullen uitsluitend worden gebruikt voor administratieve afhandeling van het dossier  en desgevallend voor facturatie van overleg.

<br/>

U tekent voor toestemming om de op de elektronische en/of papieren invulformulieren<sup>*</sup> vermelde persoonsgegevens,

op het beveiligde gedeelte van  de  website van LISTEL vzw te plaatsen.<br/>

<sup>*</sup>Deze elektronische/papieren formulieren zijn:

Handtekenlijst met/voor verslag, Betrokkenen in de thuiszorg, Plan van tenlasteneming, Katz-score, en Verklaring Bankrekeningnummers.





</td>

</tr>



<?php

if ($soortVergadering == "opvolgvergadering") {

?>

<tr>

<td>   <p>&nbsp;</p>

De volgende opvolgvergadering is gepland op:  .................<br/>

<span style="font-size:9px;">(minstens 3 maanden na het huidig overleg)</span>



</td>

</tr>

<?php

  }

?>

</table>

</div></div></body></html>

<?php

    //----------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //----------------------------------------------------------

    }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>