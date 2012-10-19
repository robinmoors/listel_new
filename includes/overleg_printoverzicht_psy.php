<?php

  // zowel bruikbaar vanuit overleg_alles als 'zelfstandig' vanuit print_overleg.php

  if (isset($_GET['id'])) {

    $overlegID = $_GET['id'];

    $query = "select * from overleg where id = $overlegID";

    if ($result = mysql_query($query)) {

      if (mysql_num_rows($result) > 0) {

         $overlegInfo = mysql_fetch_array($result);
         $deelvzwRecord = mysql_fetch_assoc(mysql_query("select deelvzw from gemeente, patient where code = '{$overlegInfo['patient_code']}' and gem_id = gemeente.id"));

         $_SESSION['overleg_dd'] = substr($overlegInfo['datum'],6,2);

         $_SESSION['overleg_mm'] = substr($overlegInfo['datum'],4,2);

         $_SESSION['overleg_jj'] = substr($overlegInfo['datum'],0,4);

         $datum = "{$_SESSION['overleg_dd']}/{$_SESSION['overleg_mm']}/{$_SESSION['overleg_jj']}";
         $niksMeerDoen = false;
       }

       else {

          print("<h1>Er is geen overleg geregistreerd met volgnummer {$_GET['id']}</h1>");

          print("<p>Er kan dan ook niks afgedrukt worden!</p>");

          $niksMeerDoen = true;

       }

     }

     else {

       die("Wat is dat nu toch met die query $query?");

     }

  }

  else {

   print("<h1>Wat meenemen naar het overleg?</h1>\n");

  }

    $mutnr = mysql_fetch_assoc(mysql_query("select mutnr, mut_id, rijksregister from patient where code = '{$_SESSION['pat_code']}'"));

    if (isset($mutnr['mutnr']) && $mutnr['mutnr'] != "" && $mutnr['mut_id'] != 1) {

      $display3 = "none";

?>

<script language="javascript" type="text/javascript">

  var geenMutualiteit = false;

</script>

<?php

    }

    else {

      $display3 = "block";
?>

<script language="javascript" type="text/javascript">

  var geenMutualiteit = true;

</script>

<?php

    }



  print("<h2>Na afronden overleg door de referentiepersoon te bezorgen aan de pati&euml;nt of zijn familie:</h2>");


  $urlParam = "?overleg=$overlegID";

  $urlParam2 = "?overleg_id=$overlegID";



  if ($overlegInfo['afgerond'] == 1) {

    $tabel = "afgeronde";

  }

  else {

    $tabel = "huidige";

  }





  // opzoeken of de patient voor dit overleg een gdt had aangevraagd



// default tonen we géén enkele waarschuwing, bv. na patientoverzicht

if (!isset($display))

  $display = "none";

if (!isset($display2))

  $display2 = "none";

if (!isset($display3)) {

  $display3 = "none";
}
if (!isset($displayContact))

  $displayContact = "none";



if (!($niksMeerDoen)) { // al de rest

  if (issett($overlegID) && ombvergoedbaar($overlegID)) {
    $displayBankrekOMB = "block";
  }
  else {
    $displayBankrekOMB = "none";
  }


  if ($overlegInfo['keuze_vergoeding'] > 0) {

    if ($nietVergoedbaar) {
        $display2 = "block";
    }

    else {
      $display2 = "none";
      if ($overlegInfo['keuze_vergoeding'] != 2) {
        $displayBankrekOMB = "none";
      }

    }

  }
  if (is_tp_patient()) {
      $displayBankrekOMB = "none";
  }

  if ($overlegInfo['keuze_vergoeding'] > 0 || is_tp_patient()) {

    $display = "block";


  }

  else {

    $display2 = "none";

    $display = "none";

  }



  if ($overlegInfo['keuze_vergoeding'] > 0 || is_tp_patient()) {

    if (isset($mutnr['rijksregister']) && $mutnr['rijksregister'] != "") {

      $displayRR = "none";

?>

<script language="javascript" type="text/javascript">

  var geenRijksRegister = false;

</script>

<?php

    }

    else {

      $displayRR = "block";

?>

<script language="javascript" type="text/javascript">

  var geenRijksRegister = true;

</script>

<?php

    }

  }

  else {

    $displayRR = "none";

  }



?>



  <div id="contactPersonenTekort" style="display:<?= $displayContact ?>; background-color: #FCC;">

  <?php

    if ($_SESSION['actie']=="afronden")

      print("<p>Pas op! Je hebt nog geen referentiepersoon aangeduid.

             <br /> Dit is verplicht. Doe dit vooraleer onderstaande documenten af te drukken.</p>\n");

  ?>

  </div>



  <div id="geenInschrijvingsnummer" style="display:<?= $display3 ?>; background-color: #FCC;">

  <?php

    if ($_SESSION['actie']=="afronden")

      print("<p>Pas op! Het inschrijvingsnummer van de pati&euml;nt bij de mutualiteit, of de mutualiteit zelf, is niet gekend bij ons.

              <br /> Hierdoor kunnen wij g&eacute;&eacute;n geldige facturatie uitvoeren.<br />

              Je moet daarom eerst <a href=\"patient_aanpassen.php?code={$_SESSION['pat_code']}\">het inschrijvingsnummer invullen</a>

              <br /> vooraleer onderstaande documenten af te drukken.</p> \n");

  ?>

  </div>



  <div id="geenRijksregister" style="display:<?= $displayRR ?>; background-color: #FCC;">

  <?php

    if ($_SESSION['actie']=="afronden")

      print("<p>Pas op! Het rijksregisternummer van de pati&euml;nt is niet gekend bij ons.

              <br /> Hierdoor kunnen wij g&eacute;&eacute;n geldige facturatie uitvoeren.<br />

              Je moet daarom eerst <a href=\"patient_aanpassen.php?code={$_SESSION['pat_code']}\">het rijksregisternummer invullen</a>

              <br /> vooraleer onderstaande documenten af te drukken.</p> \n");

  ?>

  </div>



  <div id="geenKeuzeVergoeding" style="display:none;background-color: #FCC;">

    <p>Pas op: je hebt nog geen keuze gemaakt i.v.m. vergoeding van het overleg.

    <br />Je doet dit best vooraleer je documenten afdrukt.</p>

  </div>



  <div id="probleemVergoeding" style="display:<?= $display2 ?>; background-color: #FCC;">

    <p>Probleem: je hebt gekozen voor vergoeding, maar de teamsamenstelling is niet in orde.

    <br />Een aantal documenten kunnen dus niet afgedrukt worden.</p>

  </div>



<p>

<style>

  .kolom1 {

    width: 333px;

  }

</style>





<table>

<?php

?>

<!--
    <tr>

        <td align="right" class="kolom1">

        Uitnodiging voor het overleg(pdf) :&nbsp;

        </td>

        <td>

        <form method="post" action="<?= $siteadresPDF ?>/php/print_psy_uitnodiging.php" target="_blank">

           <input type="hidden" name="tabel" value="<?=$tabel ?>" />

           <input type="hidden" name="id" value="<?= $overlegID ?>" />

           <input type="submit" value="Print" /></form>

        </td>

    </tr>
-->
<!--
    <tr>

        <td align="right" class="kolom1">

        Uitnodiging voor partners &eacute;n mantelzorgers (pdf) :&nbsp;

        </td>

        <td>

        <form method="post" action="<?= $siteadresPDF ?>/php/print_psy_uitnodiging.php?ookMantelzorgers=1" target="_blank">

           <input type="hidden" name="tabel" value="<?=$tabel ?>" />

           <input type="hidden" name="id" value="<?= $overlegID ?>" />

           <input type="submit" value="Print" /></form>

        </td>

    </tr>
-->


    <tr>
        <td align="right" class="kolom1">
        Crisisplan :&nbsp;
        </td>
        <td>
        <form method="post" action="print_psy_crisisplan.php" target="_blank">
           <input type="hidden" name="tabel" value="<?=$tabel ?>" />
           <input type="hidden" name="id" value="<?= $overlegID ?>" />
           <input type="submit" value="Print" /></form>
        </td>
    </tr>
    <tr>
        <td align="right" class="kolom1">
        Begeleidingsplan :&nbsp;
        </td>
        <td>
        <form method="post" action="print_psy_begeleidingsplan.php" target="_blank">
           <input type="hidden" name="tabel" value="<?=$tabel ?>" />
           <input type="hidden" name="id" value="<?= $overlegID ?>" />
           <input type="submit" value="Print" /></form>
        </td>
    </tr>


</table>

<?php
function zoekNaam($menscode) {
    switch ($menscode['mens_type']) {
        case "oc":
           $qry2 = "select naam, voornaam from logins
                    where id = {$menscode['mens_id']}";
           $functie = "Overlegcoordinator ";
           break;
        case "hvl":
           $qry2 = "select h.naam, voornaam, f.naam as func_naam from hulpverleners h, functies f
                    where h.id = {$menscode['mens_id']} and f.id = h.fnct_id";
           break;
        case "mz":
           $qry2 = "select naam, voornaam from mantelzorgers
                    where id = {$menscode['mens_id']}";
           $functie = "Mantelzorger ";
           break;
        case "pat":
           $qry2 = "select naam, voornaam from patient
                    where id = {$menscode['mens_id']}";
           $functie = "Patient ";
           break;
    }
    $mens = mysql_fetch_array(mysql_query($qry2));
    //print($qry2);
    if (!isset($functie)) $functie = $mens['func_naam'];
    return "<strong>$functie</strong> " . $mens['naam'] . " " . $mens['voornaam'];
}

?>




  <h2 style="display:<?= $display ?>">Laten tekenen voor vergoeding en opsturen naar de GDT (LISTEL vzw)</h2>
  <table id="vergoeding2" style="display:none;"></table> <!-- voor compatibiliteit met gewoon overleg -->
  <table id="vergoeding1" style="display:<?= $display ?>">

<?php
 if (isset($overlegID) && isEersteOverlegPsy($_SESSION['pat_code'],$overlegInfo['datum'])) {
 ?>
    <tr>
        <td align="right" class="kolom1">
        Verklaring organisator (Bijlage 1 deel 1):&nbsp;<br/>
        </td>
        <td>
        <form method="post" action="print_psy_organisator1.php" target="_blank">
           <input type="hidden" name="tabel" value="<?=$tabel ?>" />
           <input type="hidden" name="id" value="<?= $overlegID ?>" />
           <input type="submit" value="Print" /></form>
        </td>
    </tr>
    <tr>
        <td align="right" class="kolom1">
        Verklaring arts (Bijlage 2):&nbsp;<br/>
        </td>
        <td>
        <form method="post" action="print_psy_arts.php" target="_blank">
           <input type="hidden" name="tabel" value="<?=$tabel ?>" />
           <input type="hidden" name="id" value="<?= $overlegID ?>" />
           <input type="submit" value="Print" /></form>
        </td>
    </tr>
 <?php
 }

?>
    <tr>
        <td align="right" class="kolom1">
        Verklaring organisator (Bijlage 1 deel 2):&nbsp;<br/>
        (op te sturen bij ieder overleg)
        </td>
        <td>
        <form method="post" action="print_psy_organisator2.php" target="_blank">
           <input type="hidden" name="tabel" value="<?=$tabel ?>" />
           <input type="hidden" name="id" value="<?= $overlegID ?>" />
           <input type="submit" value="Print" /></form>
        </td>
    </tr>
   </table>

<?php
  if (($overlegInfo['afgerond'] == 1 && $overlegInfo['keuze_vergoeding'] > 0) && ($_SESSION['profiel']=="listel")) {

    if ($overlegInfo['genre']=="TP" && $overlegInfo['factuur_datum']=="via factuurid") {

?>

  <table>

    <tr>

        <td align="right" class="kolom1">

        <strong>Opgenomen in </strong> :&nbsp;

        </td>

        <td>

        <form method="post" action="print_facturenTP.php?factuurID=<?= $overlegInfo['factuur_code'] ?>" target="_blank">

          <input type="submit" value="deze factuur" /></form>

        </td>

    </tr>

    <tr>

        <td align="right" class="kolom1">

        <em>Iets mis met de factuur?</em> :&nbsp;

        </td>

        <td>

        <form method="post" action="factuur_annuleren.php?overleg=<?= $overlegInfo['id'] ?>" target="_blank">

          <input type="submit" value="schrap uit factuur" /></form>

        </td>

    </tr>

  </table>

<?php

    }

    else if (($overlegInfo['factuur_datum']=="via factuurid") || ($overlegInfo['factuur_datum']=="via factuurid-")){
      if ($overlegInfo['keuze_vergoeding']==1) {
?>

  <table>

    <tr>

        <td align="right" class="kolom1">

        <strong>Opgenomen in </strong> :&nbsp;

        </td>

        <td>

        <form method="post" action="print_facturenGDT.php?factuurID=<?= $overlegInfo['factuur_code'] ?>" target="_blank">

          <input type="submit" value="deze factuur" /></form>

        </td>

    </tr>

    <tr>

        <td align="right" class="kolom1">

        <em>Iets mis met de factuur?</em> :&nbsp;

        </td>

        <td>

        <form method="post" action="factuur_annuleren.php?overleg=<?= $overlegInfo['id'] ?>" target="_blank">

          <input type="submit" value="schrap uit factuur" /></form>

        </td>

    </tr>

  </table>

<?php
       }
   }
   if ($overlegInfo['keuze_vergoeding']>=1 &&
       $overlegInfo['datum']>= $beginOrganisatieVergoeding  &&
       $overlegInfo['organisatie_factuur'] > 0
       ) {
?>
  <table>
    <tr>
        <td align="right" class="kolom1">
          <strong>Organisator wordt </strong> :&nbsp;
        </td>
        <td>
        <form method="post" action="print_facturenOrganisatie.php?factuurID=<?= $overlegInfo['organisatie_factuur'] ?>&deelvzw=<?= $deelvzwRecord['deelvzw']?>" target="_blank">
          <input type="submit" value="uitbetaald op dit uittreksel" /></form>
        </td>
    </tr>
  </table>
<?php
    }
    else if ($overlegInfo['keuze_vergoeding']>=1 &&
             $overlegInfo['datum']>= $beginOrganisatieVergoeding &&
             $overlegInfo['genre'] != "TP") {
?>
  <table>
    <tr>
        <td align="right" class="kolom1">
          <strong>Organisator wordt </strong> :&nbsp;
        </td>
        <td>
           vergoed, maar er is nog geen factuur.
        </td>
    </tr>
  </table>
<?php
    }

    if ($overlegInfo['genre']!="TP" && $overlegInfo['factuur_datum'] != "") {

?>

  <table>

    <tr>

        <td align="right" class="kolom1">

        <strong>Factuur</strong> :&nbsp;

        </td>

        <td>

        <form method="post" action="print_factuur.php?id=<?= $overlegID ?>" target="_blank">

          <input type="submit" value="Print" /></form>

        </td>

    </tr>

  </table>

<?php

    }

}


} // einde !$niksMeerTeDoen

print("<h3>Bewaar steeds een kopie van deze documenten!</h3>\n");



  /********** nog niet geregistreerde gebruikers ******************/
    $niemandGevonden = true;
    $qryPersonen = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id
            FROM
                {$tabel}_betrokkenen bl,
                hulpverleners h
            WHERE
                /* bl.overleggenre = 'gewoon' AND */
                (bl.genre = 'orgpersoon' or bl.genre = 'hulp') AND
                bl.persoon_id = h.id AND
                (h.validatiestatus is null or h.validatiestatus = 'geenkeuze') and
                $voorwaarde
                $beperking";
     $resultPersonen = mysql_query($qryPersonen) or die("problemen met $qryPersonen " . mysql_error());
     if ($niemandGevonden && mysql_num_rows($resultPersonen) > 0) {
       $niemandGevonden = false;
       print("<h2>Stuur op naar LISTEL vzw om nieuwe gebruikers te registreren</h2>\n");
       print("\n<p>Volgende deelnemers hebben nog geen toegang tot het platform.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }


     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("   <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=hulpverleners\">{$persoon['naam']}</a></li>\n");
     }
  
  /********** vervallen logins ******************/
    $niemandVervallen = true;
    $qryPersonen = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id
            FROM
                {$tabel}_betrokkenen bl,
                hulpverleners h
            WHERE
                /* bl.overleggenre = 'gewoon' AND */
               (bl.genre = 'orgpersoon' or bl.genre = 'hulp') AND
                bl.persoon_id = h.id AND
                (h.validatiestatus = 'weigering') and h.logindatum > 0 and
                $voorwaarde
                $beperking";
     $resultPersonen = mysql_query($qryPersonen) or die("problemen met $qryPersonen " . mysql_error());
     if ($niemandVervallen && mysql_num_rows($resultPersonen) > 0) {
       print("<h2>Stuur op naar LISTEL vzw indien onderstaande deelnemers hun vervallen login terug willen activeren</h2>\n");
       $niemandVervallen = false;
       print("\n<p>De login van volgende deelnemers is vervallen.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }


     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("   <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=hulpverleners\">{$persoon['naam']}</a></li>\n");
     }
/*  MANTELZORGERS EN PATIENT VOORLOPIG NOG NIET LATEN REGISTREREN!
    $qryPersonen = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id
            FROM
                {$tabel}_betrokkenen bl,
                mantelzorgers h
            WHERE
                bl.overleggenre = 'gewoon' AND
               (bl.genre = 'mantel') AND
                bl.persoon_id = h.id AND
                (h.validatiestatus is null or h.validatiestatus = 'geenkeuze') and
                $voorwaarde
                $beperking";
     $resultPersonen = mysql_query($qryPersonen) or die("problemen met $qryPersonen " . mysql_error());
     if ($niemandGevonden && mysql_num_rows($resultPersonen) > 0) {
       $niemandGevonden = false;
       print("\n<p>Volgende deelnemers hebben nog geen toegang tot het platform.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("  <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=mantelzorgers\">{$persoon['naam']}</a></li>\n");
     }


    $qryPatient = "
         SELECT
                concat(h.naam, ' ', h.voornaam) as naam,
                h.id, h.code
            FROM
                patient h
            WHERE
                (h.validatiestatus is null or h.validatiestatus = 'geenkeuze') and
                h.code = '{$_SESSION['pat_code']}' ";
     $resultPersonen = mysql_query($qryPatient) or die("problemen met $qryPatient " . mysql_error());
     if ($niemandGevonden && mysql_num_rows($resultPersonen) > 0) {
       $niemandGevonden = false;
       print("\n<p>Volgende deelnemers hebben nog geen toegang tot het platform.<br/>Klik op de link om hun registratieformulier af te drukken.<ul>");
     }

     for ($p=0; $p<mysql_num_rows($resultPersonen); $p++) {
       $persoon = mysql_fetch_assoc($resultPersonen);
       print("  <li><a target=\"_blank\" href=\"$siteadresPDF/php/print_registratiepdf.php?id={$persoon['id']}&tabel=patient\">Pati&euml;nt zelf</a></li>\n");
     }
*/
     if ($niemandGevonden && $niemandVervallen) {
       print("<p>Alle deelnemers aan dit overleg hebben toegang tot het platform, of hebben dit aangevraagd of geweigerd.</p>\n");
     }
     else {
       print("</ul></p>\n");
     }

  /********** nog niet geregistreerde gebruikers ******************/


    // bestanden yse

/************ begin bestanden ************/

if ($_SESSION['profiel'] == "OC" || $_SESSION['profiel']=="listel") {
  if (issett($overlegID)) {
    if ($_SESSION['profiel']=="OC") {

      $file_res = mysql_query("SELECT * FROM overleg_files WHERE overleg_id = $overlegID and (auteurgenre is null or auteurgenre = 'OC')");

    } else {

      $file_res = mysql_query("SELECT * FROM overleg_files WHERE overleg_id = $overlegID");

    }



         if (mysql_num_rows($file_res)) {

            print("<hr /><strong>Bijlagen</strong><br />");

             print("<ul style=\"margin: 10px 0\">");

             while ($overleg_file = mysql_fetch_object($file_res)) {

                print("<li><a href=\"/_download/" . $overleg_file->filename . "\">" . $overleg_file->alias . "</a></li>");

             }

             print("</ul><hr />");

         }
   }
/********** einde bestanden  ************/
}


