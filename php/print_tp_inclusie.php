<?php
session_start();
$paginanaam="Brief adviserend geneesheer ivm TP";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {
    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
    //----------------------------------------------------------
    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
?>
    </head>
    <body onLoad="parent.print();">
    <div align="center">
    <div class="pagina">
    <table width="570">
    <tr><td colspan="3">&nbsp;</td></tr>
<?php

// krijgt $_GET['id']
$qry = "select patient.naam, voornaam, hoofddiagnose, diagnosegenre, mut_id, sex, adres, dlzip, dlnaam, rijksregister, project, patient_tp.begindatum as startdatum, patient_tp.einddatum from patient, patient_tp, gemeente g
        where patient_tp.id = {$_GET['id']} 
          and patient = code
          and g.id = patient.gem_id";
$resultPatient = mysql_query($qry) or die(mysql_error());
$patientInfo = mysql_fetch_assoc($resultPatient);
$tpRecord = tp_record($patientInfo['project']);

            $querymut = "
         SELECT
                v.*,
                g.dlzip,
                g.dlnaam
            FROM
                verzekering v
                LEFT JOIN gemeente g ON (v.gem_id=g.id)
            WHERE
                v.id = {$patientInfo['mut_id']}"; // Query
            $recordsmut = mysql_fetch_array(mysql_query($querymut));


/*

$qryDsmcodes = "select dsm from tp_dsm where tp = {$patientInfo['project']}";
$resultDsm = mysql_query($qryDsmcodes) or die(mysql_error() . $qryDsmcodes);
$dsmcodes = "";
for ($d=0; $d < mysql_num_rows($resultDsm); $d++) {
  $rijDSM = mysql_fetch_assoc($resultDsm);
  $dsmcodes .= ", {$rijDSM['dsm']}";
}
$dsmcodes = substr($dsmcodes, 1);

*/

if (isset($_GET['exclusie'])) {
  $kolom = "uit_print";
}
else {
  $kolom = "in_print";
}
$update = "update patient_tp set $kolom = 1 where project = {$patientInfo['project']} and patient = \"{$_GET['patient']}\"";
mysql_query($update) or die("Kan niet opslaan dat dit document al afgedrukt is, en dus doe ik $update niet.");


$startdatum=$patientInfo['startdatum'];
$startdatumMooi=substr($patientInfo['startdatum'],8,2)."/".substr($patientInfo['startdatum'],5,2)."/".substr($patientInfo['startdatum'],0,4);
$einddatum=$patientInfo['einddatum'];
$einddatumMooi=substr($patientInfo['einddatum'],8,2)."/".substr($patientInfo['einddatum'],5,2)."/".substr($patientInfo['einddatum'],0,4);
$geslacht=($patientInfo['sex']==0)?"(M)":"(V)";

?>

<tr>
<td colspan="3" style="padding-left: 60%;">
<?php
echo <<< EINDE
<br/><br/><br/><br/>
                          {$recordsmut['naam']} <br />
                          t.a.v. Adviserend Geneesheer <br />
                          {$recordsmut['adres']} <br />
                          {$recordsmut['dlzip']} {$recordsmut['dlnaam']} <br />
<br/><br/><br/><br/>
EINDE;
?>
</td>
</tr>


<tr><td colspan="3"><div style="text-align:center"><strong>In een gesloten omslag te versturen naar de adviserend geneesheer</strong> <br/>
binnen de 14 dagen volgend op de opname/ het ontslag van de pati&euml;nt<br/>
<br/>
<strong>Kennisgeving van tenlasteneming / ontslag van een rechthebbende in het raam van een therapeutisch project <strong>
</div>
</td></tr>


<tr><td><br/><br/><br/><u>Identificatie van de rechthebbende:</u></td></tr>

<tr><td><?= "{$patientInfo['naam']} {$patientInfo['voornaam']} $geslacht" ?></td></tr>
<tr><td><?= "{$patientInfo['adres']}" ?> </td></tr>
<tr><td><?= "{$patientInfo['dlzip']} {$patientInfo['dlnaam']}" ?> </td></tr>
<tr><td>I.N.S.Z. <?= "{$patientInfo['rijksregister']}" ?></td></tr>






<tr><td colspan="3"><br/><br/><br/>
Ik ondergetekende Kristel Vanden Driessche, handelend <br />
als administratief co&ouml;rdinator van het therapeutische project met het nummer
<strong><?= $tpRecord['nummer'] ?></strong> en dat zich richt tot
<strong><?= $tpRecord['doelgroep'] ?></strong>
met een psychiatrische problematiek van het type (<?= $patientInfo['diagnosegenre'] ?>-code )
<strong><?= $patientInfo['hoofddiagnose'] ?></strong>
<br/><br/>
Geef hierbij kennis dat de bovenvermelde rechthebbende:

<p>&nbsp;</p>
<ul>
<?php
if (isset($_GET['exclusie'])) {
  print("&nbsp;&nbsp;<input type=\"radio\"> rechthebbende van het therapeutische project is sedert  <br/>\n");
  print("&nbsp;&nbsp;<input type=\"radio\"><span class=\"checkedThing\">X</span> het therapeutische project verlaten heeft op $einddatumMooi <br/>\n");
}
else {
  print("&nbsp;&nbsp;<input type=\"radio\"><span class=\"checkedThing\">X</span> rechthebbende van het therapeutische project is sedert $startdatumMooi <br/>\n");
  print("&nbsp;&nbsp;<input type=\"radio\"> het therapeutische project verlaten heeft op <br/>\n");
}
?>
</ul>


<tr><td colspan="1"><br/><br/><br/>&nbsp;</td><td>Gedaan te Hasselt</td></tr>
<tr><td colspan="1"></td><td>Op <?= date("d/m/Y") ?></td></tr>
<tr><td colspan="1"><br/><br/><br/><br/><br/>&nbsp;</td><td>Handtekening:</td></tr>




</table>
</div>
</div>
</body>
</html>
<?php

    //---------------------------------------------------------
    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");
    //---------------------------------------------------------
    }
//---------------------------------------------------------
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------

?>