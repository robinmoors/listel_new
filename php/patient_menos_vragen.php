<?php

session_start();



function eindePagina() {
     // einde mainblock
      print("</div>");
      print("</div>");
      print("</div>");
      require("../includes/dbclose.inc");
      require("../includes/footer.inc");
      print("</div>");
      print("</div>");
      print("</body>");
      print("</html>");
      //---------------------------------------------------------
      /* Geen Toegang */ require("../includes/check_access.inc");
      //---------------------------------------------------------

      //---------------------------------------------------------
      /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
      //---------------------------------------------------------
}

function eindeFormulier() {
  global $patientCode;
?>

<script type="text/javascript">
function testKatz() {
  var f = document.f;
  if (f.complexeVerzorging.checked && !f.katz[0].checked && !f.katz[1].checked && !f.katz[2].checked) {
    f.complexeVerzorging.focus();
    alert("Je hebt bij de complexe verzorging geen katz-forfait aangeduid");
    return false;
  }
  return true;
}
</script>
<table class="form">
<tr>
  <td class="label">Gegevens </td>
  <td class="input"><input type="submit" value="opslaan" onclick="return testKatz();"/></td>
</tr>

</table>

<input type="hidden" name="patient" value="<?= $patientCode ?>" />

</form>
<?php
}

   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Menos-gerelateerde vragen";

   if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")
          && ($_SESSION['profiel'] == "menos"))) {
      print("Alleen de menoscoordinator kan dit doen. Contacteer hem/haar!");
    }
    else  {
      require("../includes/html_html.inc");
      print("<head>");
      require("../includes/html_head.inc");
      print("</head>");
      print("<body>");
      print("<div align=\"center\">");
      print("<div class=\"pagina\">");
      require("../includes/header.inc");
      require("../includes/kruimelpad.inc");
      print("<div class=\"contents\">");
      require("../includes/menu.inc");
      print("<div class=\"main\">");
      print("<div class=\"mainblock\">");

if (isset($_POST['pat_code']) && $_POST['pat_code']!="") {    // via select_zplan
  $_GET['code']=$_POST['pat_code'];
  $_SESSION['pat_code']=$_POST['pat_code'];
  $patientCode = $_POST['pat_code'];
}
else if (isset($_POST['patient']) && $_POST['patient']!="") { // via deze pagina
  $_GET['code']=$_POST['patient'];
  $_SESSION['pat_code']=$_POST['patient'];
  $patientCode = $_POST['patient'];
}
else if ($_SESSION['code']!=$_GET['code'] && (isset($_GET['code'])) && $_GET['code']!="") { // via code
  $_SESSION['pat_code']=$_GET['code'];
  $patientCode = $_GET['code'];
}
else {  // via sessie
  $patientCode = $_SESSION['pat_code'];
}


/*
`patient` VARCHAR( 20 ) NOT NULL ,
`complexe_verzorging` TINYTEXT NULL ,
`katz_id` INT NULL ,
`diagnose_dementie` TINYINT NULL ,
`diagnose` TEXT NULL ,
`edmonton_schaal` TINYINT NULL ,
`edmonton_id` INT NULL ,
`informed_consent` TINYINT NOT NULL ,
`begindatum` DATE NOT NULL ,
`einddatum` DATE NULL
*/


if (isset($_POST['patient'])) {
  $_SESSION['pat_code'] = $_POST['patient'];
  $update = "update patient_menos set               ";
  if (isset($_POST['stap2'])) {
    $update .= " complexe_verzorging = 0{$_POST['complexeVerzorging']},  ";
    if ($_POST['complexeVerzorging']==1)
       $update .= " katz = '{$_POST['katz']}',  ";
    else
       $update .= " katz = '',  ";
    $update .= " diagnose_dementie = 0{$_POST['diagnoseDementie']}, ";
    $update .= " diagnose = \"{$_POST['diagnose']}\", ";
    $update .= " edmonton_schaal = 0{$_POST['edmontonSchaal']}, ";
    $update .= " jonger = 0{$_POST['jonger']}, ";
    $update .= " uitzondering = 0{$_POST['uitzondering']}, ";
  }
  if (isset($_POST['stap4']))
    $update .= " informed_consent = 0{$_POST['informedConsent']}, ";
  if (isset($_POST['stap5'])) {
    $update .= " meetschaal_dag = \"{$_POST['meetschaal_dag']}\", ";
    $update .= " meetschaal_maand = \"{$_POST['meetschaal_maand']}\", ";
    $update .= " meetschaal_jaar = \"{$_POST['meetschaal_jaar']}\", ";
    $update .= " economie = 0{$_POST['economie']}, ";
    $update .= " hc = 0{$_POST['hc']}, ";
    $update .= " who = 0{$_POST['who']}, ";
    $update .= " zarit = 0{$_POST['zarit']}, ";
  }
  if (isset($_POST['stap6']))
    $update .= " afspraken = \"{$_POST['afspraken']}\", ";
  $update = substr($update, 0, strlen($update)-2) . " where patient = \"{$_POST['patient']}\"";
  if (mysql_query($update)) {
    print("<p style='background-color: #8f8'>Gegevens succesvol opgeslagen. </p>");
  }
  else  {
    print("$update" .mysql_error());
  }
}


$qryPatient = "select * from patient inner join patient_menos on (code = patient and patient = \"{$_SESSION['pat_code']}\")";
$resultPatient = mysql_query($qryPatient);
$patient=mysql_fetch_assoc($resultPatient);


if ($patient['complexe_verzorging']==1) {
  $toonComplex = "block";
}
else {
  $toonComplex = "none";
}
if ($patient['diagnose_dementie']==1) {
  $toonDiagnose = "block";
}
else {
  $toonDiagnose = "none";
}
if ($patient['edmonton_schaal']==1) {
  $toonEdmonton = "block";
}
else {
  $toonEdmonton = "none";
}
if ($patient['uitzondering']==1) {
  $toonUitzondering = "block";
}
else {
  $toonUitzondering = "none";
}
if ($patient['jong']==1) {
  $toonJong = "block";
}
else {
  $toonJong = "none";
}

// begin mainblock
?>
   <h1>Menos-gerelateerde gegevens <?= $_SESSION['pat_code'] ?></h1>


<h2>Stap 1 : Bewerk het zorgteam</h2>

<?php
  $aantalRecord = getUniqueRecord("select count(*) as aantal from huidige_betrokkenen
                                   where overleggenre = 'menos' and patient_code = '{$_SESSION['pat_code']}'");
  $aantalBetrokkenen = $aantalRecord['aantal']-1;
?>
<p>
Momenteel zitten er (buiten de pati&euml;nt zelf) <?= $aantalBetrokkenen ?> personen in het zorgteam. <br/>
Via de link <a href="zorgteam_bewerken.php">Zorgteam bewerken</a> kan je dit team bekijken en aanpassen.
</p>

<?php
  if ($aantalBetrokkenen == 0) {
     print("<p>Zodra je het zorgteam hebt samengesteld, kan je verder gaan met de volgende stappen.</p>");
     eindePagina();
     die();
  }
?>

<form name="f" method="post">


<h2>Stap 2 : Inclusiecriteria</h2>
<input type="hidden" name="stap2" value="1" />


<table class="form">
<tr>

  <td class="label" valign="top">Reden van opname</td>
  <td class="input">
     <div>
        <div>
          <input type="checkbox" name="complexeVerzorging" value="1" <?php printChecked(1,$patient['complexe_verzorging']); ?>
                 onclick="switchVisible(this,'complexJa');"
          />
          Complexe verzorging
        </div>
        
        <div id="complexJa" style="margin-left:30px;display:<?= $toonComplex ?>">
           <table>
             <tr>
               <td rowspan="3" valign="top">Katz met forfait</td>
               <td><input type="radio" name="katz" value="A" <?php printChecked('A',$patient['katz']); ?> /> A</td>
             </tr>
             <tr>
               <td><input type="radio" name="katz" value="B" <?php printChecked('B',$patient['katz']); ?> /> B</td>
             </tr>
             <tr>
               <td><input type="radio" name="katz" value="C" <?php printChecked('C',$patient['katz']); ?> /> C</td>
             </tr>
           </table>
        </div>

        <div>
          <input type="checkbox" name="diagnoseDementie" value="1" <?php printChecked(1,$patient['diagnose_dementie']); ?>
                 onclick="switchVisible(this,'dementieJa');"
          />
          Diagnose dementie (door een geneesheer- specialist)
        </div>
        <div id="dementieJa" style="margin-left:24px;display:<?= $toonDiagnose ?>">
          Vul hier de diagnose in <br/>
          <textarea cols="60" rows="6" name="diagnose"><?= $patient['diagnose'] ?></textarea>
        </div>

        <div>
          <input type="checkbox" name="edmontonSchaal" value="1" <?php printChecked(1,$patient['edmonton_schaal']); ?> />
          Edmonton schaal (kwetsbaarheid &gt;= 6)
        </div>

        <div style="width:24px;display:inline;float:left;">
          <input type="checkbox" name="uitzondering" value="1" <?php printChecked(1,$patient['uitzondering']); ?>
                 onclick="switchVisible(this,'uitzonderingJa');"
          />
        </div>
        <div style="float:left;display:inline;width:300px;">
          Deze persoon voldoet niet aan de formele inclusiecriteria, maar wordt wel opgevolgd.
        </div>
        <div id="uitzonderingJa" style="clear:both;margin-left:24px;font-size:75%;display:<?= $toonUitzondering ?>">
          Hij/zij telt niet mee in de statistieken.
        </div>

<?php
  $jongerDan60 = false; // deze test laat ik even weg. Ik ga de uitzondering algemeen benoemen.
  if ($jongerDan60) {
?>
        <div>
          <input type="checkbox" name="jonger" value="1" <?php printChecked(1,$patient['jonger']); ?> />
          Uitzondering! Personen jonger dan 60 jaar
        </div>
<?php
  }
?>

     </div>

  </td>
</tr>
</table>

<?php
  if ($patient['complexe_verzorging']==0
       && $patient['diagnose_dementie']==0
       && $patient['edmonton_schaal']==0
       && $patient['uitzondering']==0) {
     eindeFormulier();
     print("<p>Zodra je het zorgteam hebt samengesteld, kan je verder gaan met de volgende stappen.</p>");
     eindePagina();
     die();
  }
?>

<h2>Stap 3 : Brief voor de huisarts</h2>

<p>Druk <a href="print_menos_huisarts_pdf.php" target="_blank">deze notificatie voor de huisarts</a> af en stuur hem op.</p>

<h2>Stap 4 : Informed Consent</h2>
<input type="hidden" name="stap4" value="1" />

<table class="form">
<tr>
  <td class="label" valign="top">Informed Consent</td>
  <td class="input"><input type="checkbox" name="informedConsent" value="1" <?php printChecked(1,$patient['informed_consent']); ?> />
    Is er een informed consent ondertekend?
    <div style="margin-left:24px; font-size:9px">
      Gelieve aan de pati&euml;nt/mantelzorger mee te delen dat ze steeds de keuze hebben om ook weer vrijwillig uit het project te stappen.
    </div>
   </td>
</tr>
</table>

<?php
  if ($patient['informed_consent']==0) {
     eindeFormulier();
     print("<p>Wanneer er een informed consent is, kan je verder gaan met de meetschalen.</p>");
     eindePagina();
     die();
  }
?>


<h2>Stap 5 : BelRAI Meetschalen (via <a href="https://www.ehealth.fgov.be/nl/secured/webapp/index.html" target="_blank">externe link</a> )
</h2>
<input type="hidden" name="stap5" value="1" />

<table class="form">

<?php
  if ($patient['meetschaal_dag'] == 0) $patient['meetschaal_dag'] = "";
  if ($patient['meetschaal_maand'] == 0) $patient['meetschaal_maand'] = "";
  if ($patient['meetschaal_jaar'] == 0) $patient['meetschaal_jaar'] = "";
?>
<tr>
  <td class="label" valign="top">Datum laatste update</td>
  <td class="input">
      <input type="text" style="width: 24px;" value="<?= $patient['meetschaal_dag'] ?>" name="meetschaal_dag" />/
      <input type="text" style="width: 24px;" value="<?= $patient['meetschaal_maand'] ?>" name="meetschaal_maand" />/
      <input type="text" style="width: 48px;" value="<?= $patient['meetschaal_jaar'] ?>" name="meetschaal_jaar" />
  </td>
</tr>

<tr>
  <td class="label" rowspan="4" valign="top">Welke zijn ingevuld?</td>
  <td class="input"><input type="checkbox" name="economie" value="1" <?php printChecked(1,$patient['economie']); ?> />
    Economische vragenlijst
  </td>
</tr>
<tr>
  <td class="input"><input type="checkbox" name="hc" value="1" <?php printChecked(1,$patient['hc']); ?> />
    HC <em>Het 'interRAI-beoordelingsinstrument' voor de thuiszorg in Belgi&euml;</em>
  </td>
</tr>
<tr>
  <td class="input"><input type="checkbox" name="who" value="1" <?php printChecked(1,$patient['who']); ?> />
    WHO-QoL-8
  </td>
</tr>
<tr>
  <td class="input"><input type="checkbox" name="zarit" value="1" <?php printChecked(1,$patient['zarit']); ?> />
      Zarit-12 burdenschaal
  </td>
</tr>
</table>

<h2>Stap 6 : Afspraken</h2>
<input type="hidden" name="stap6" value="1" />

<table class="form">


<tr>
  <td class="label" valign="top">Afspraken </td>
  <td class="input">
          <textarea cols="60" rows="6" name="afspraken"><?= $patient['afspraken'] ?></textarea>
  </td>
</tr>
</table>

<?php
   eindeFormulier();
?>
<hr/>

<?php
// begin bestanden
if (!function_exists('menos_files')) {
   function menos_files() {
     global $patientCode;
     
       $fileQuery = "SELECT * FROM menos_files WHERE patient = '{$patientCode}' ";
       $file_res = mysql_query($fileQuery) or die($fileQuery);
       // bestaande files weergeven

         print('<form method="post" enctype="multipart/form-data" name="uploadform" onsubmit="document.uploadform.submit.disabled=\'true\';document.uploadform.submit.value=\'Bezig met versturen\'">');
         print("<input type=\"hidden\" name=\"pat_code\" value=\"{$patientCode}\"/>");
         if (mysql_num_rows($file_res)) {
             print("Een toegevoegd bestand kan verwijderd worden door het aan te vinken en vervolgens op de knop \"Bestand(en) verwijderen\" te klikken.<br />");
             print("<ul style=\"margin: 10px 0\">");
             while ($overleg_file = mysql_fetch_object($file_res)) {
                print("<li>");
                  print("<input type=\"checkbox\" name=\"delfiles[]\" value=\"" . $overleg_file->filename . "\">\n");
                  print("<a target=\"_blank\" href=\"/_download_menos/" . $overleg_file->filename . "\">" . $overleg_file->alias . "</a> ({$overleg_file->created})\n");
                print("</li>");
             }
             print("</ul>\n");
             $verwijderknop = "<br /><input type=\"submit\" name=\"submit2\" value=\"Aangevinkt(e) bestand(en) verwijderen\"  />&nbsp;";
         }

         print("<input type=\"file\" name=\"upload\">
             <input type=\"submit\" name=\"submit\" value=\"Bijlage toevoegen\"  />
             $verwijderknop
            </form>");
         print("</p></li>");
    }

         // yse - afsluiten upload docs
         // nieuwe files toevoegen
         if ($_FILES['upload']['tmp_name']) {
            $alias = pathinfo(strtolower($_FILES['upload']['name']));
            $filename = md5(uniqid(rand(), true)) . '.' . $alias["extension"];

            //toegelaten extensies
            $extensies_ok = array('pdf','xls','doc','docx','txt');

            if (in_array($alias["extension"],$extensies_ok)) {
                move_uploaded_file($_FILES['upload']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/_download_menos/' . $filename);
                // insert query
                $created = date("d/m/Y H:i");
                $insertQry = "INSERT into menos_files (patient, filename, alias, created)
                        VALUES ('$patientCode','" . $filename . "','" . $alias["basename"] . "','$created')";
                mysql_query($insertQry);

                $msg = "<p style='background-color:#8f8'>Bestand toegevoegd</p>";
            }
            else {
                $msg = '<span class="accentcel">Enkel .txt, PDF, Word-documenten en Excel documenten zijn toegestaan</span>';
            }
         }
         print($msg);

         // files verwijderen
         if (is_array($_POST['delfiles'])) {
            foreach ($_POST['delfiles'] as $bestand) {
                mysql_query("DELETE FROM menos_files WHERE patient = '$patientCode' AND filename = '" . $bestand . "'");
                unlink($_SERVER['DOCUMENT_ROOT'] . '/_download_menos/' . $bestand);
            }
         }
}
?>

<table class="form">


<tr>
  <td class="label" valign="top">Bijlagen</td>
  <td class="input">
    <?php menos_files(); ?>
  </td>
</table>


<?php


       eindePagina();
    }


?>