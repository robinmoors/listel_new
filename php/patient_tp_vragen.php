<?php

session_start();



function komtVoorInAntwoorden($antwoordenArray, $antwoord) {

   if (!is_array($antwoordenArray))

     return 0;

   if (in_array($antwoord, $antwoordenArray))

     return 1;

   else

     return 0;

}


   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="TP: project-gerelateerde vragen";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project"))

      {

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



if ($_SESSION['code']!=$_GET['code'] && (isset($_GET['code']))) {

  $_SESSION['pat_code']=$_GET['code'];

}



    $tp_basisgegevens = tp_record($_SESSION['tp_project']);

    $tp_Record = project_van_patient($_SESSION['pat_code']);

    if ((isset($_SESSION['pat_code'])) && ($tp_Record != 0) && ($tp_Record['id'] != $tp_basisgegevens['id'])) die("Hey manneke: deze patient is niet opgenomen in jouw project!!<br/>Dat mag niet!!");



     $tp_basisgegevens = tp_record($_SESSION['tp_project']);



if (isset($_POST['patient'])) {
  if ($_POST['begindag']<10) $begindatum = "-0" . $_POST['begindag'];
  else $begindatum = "-" . $_POST['begindag'];
  
  if ($_POST['beginmaand']<10) $begindatum = $_POST['beginjaar'] . "-0" . $_POST['beginmaand'] . $begindatum;
  else $begindatum = $_POST['beginjaar'] . "-" . $_POST['beginmaand'] . $begindatum;

  $update = "update patient_tp set
               begindatum =\"$begindatum\",
               omschrijving = \"{$_POST['omschrijving']}\",

               hoofddiagnose = \"{$_POST['hoofddiagnose']}\",

               diagnosegenre = \"{$tp_basisgegevens['diagnosegenre']}\",

               aanvullend1 = \"{$_POST['aanvullend1']}\",

               aanvullend2 = \"{$_POST['aanvullend2']}\",

               aanvullend3 = \"{$_POST['aanvullend3']}\",

               aanvullend4 = \"{$_POST['aanvullend4']}\",

               aanvullend5 = \"{$_POST['aanvullend5']}\",

               aanvullend6 = \"{$_POST['aanvullend6']}\",

               aanvullend7 = \"{$_POST['aanvullend7']}\",

               aanvullend8 = \"{$_POST['aanvullend8']}\",

               opname_overige = \"{$_POST['opname_overige']}\",

               toestemming = \"{$_POST['toestemming']}\"

             where patient = \"{$_POST['patient']}\"";



  if (isset($_POST['opname'])) {

    $resetOpname = "delete from patient_tpopname where patient = \"{$_POST['patient']}\" and project = {$_SESSION['tp_project']}";

    $values = "";

    foreach ($_POST['opname'] as $partner) {

      $values .= ", (\"{$_POST['patient']}\", {$_SESSION['tp_project']}, $partner)";

    }

    $values = substr($values, 1);

    $insertOpname = "insert into patient_tpopname (patient, project, partner) values $values";

    $okOpname = mysql_query($resetOpname) && mysql_query($insertOpname);

  }

  else

    $okOpname = true;



  $resetVragen = "delete from patient_tpvragen where patient = \"{$_POST['patient']}\" and tp = {$_SESSION['tp_project']}";

  if (isset($_POST['antwoord'])) {

    $resetVragen = "delete from patient_tpvragen where patient = \"{$_POST['patient']}\" and tp = {$_SESSION['tp_project']}";

    $values = "";

    foreach ($_POST['antwoord'] as $vraagnummer => $antwoordenOpVraag) {

      foreach ($antwoordenOpVraag as $antwoord) {

        $values .= ", (\"{$_POST['patient']}\", {$_SESSION['tp_project']}, $vraagnummer, $antwoord)";

      }

    }

    $values = substr($values, 1);

    $insertVragen = "insert into patient_tpvragen (patient, tp, vraag, antwoord) values $values";

    $okVragen = mysql_query($resetVragen) && mysql_query($insertVragen) or die(mysql_error() . "<br/>$insertVragen");

  }

  else

    $okVragen = mysql_query($resetVragen);

  

  if (isset($_POST['secundairediagnose'])) {

    $resetSecundair = "delete from patient_secundair where patient = \"{$_POST['patient']}\" and project = {$_SESSION['tp_project']}";

    $values = "";

    foreach ($_POST['secundairediagnose'] as $dsm) {

      $values .= ", (\"{$_POST['patient']}\", {$_SESSION['tp_project']}, '$dsm')";

    }

    $values = substr($values, 1);

    $insertSecundair = "insert into patient_secundair (patient, project, dsm) values $values";

    $okSecundair = mysql_query($resetSecundair) && mysql_query($insertSecundair);

  }

  else

    $okSecundair = true;



  if (mysql_query($update) && $okOpname && $okVragen && $okSecundair) {

    print("<p style='background-color: #8f8'>Gegevens succesvol opgeslagen.</p>");

  }

  else  {

    print("$insertSecundair - $okOpname - $okVragen" .mysql_error());

  }

}





$qryPatient = "select * from patient_tp where patient = \"{$_SESSION['pat_code']}\"";

$resultPatient = mysql_query($qryPatient);

$patient=mysql_fetch_assoc($resultPatient);



$qryAntwoorden = "select * from patient_tpvragen where patient = \"{$_SESSION['pat_code']}\" and tp = {$_SESSION['tp_project']}";

$resultAntwoorden = mysql_query($qryAntwoorden);

for ($i=0; $i<mysql_num_rows($resultAntwoorden);$i++) {

  $antwoordRij = mysql_fetch_assoc($resultAntwoorden);

  $antwoorden[$antwoordRij['vraag']][$i] = $antwoordRij['antwoord'];

}

// begin mainblock

?>

   <h1>Project-gerelateerde gegevens <?= $_SESSION['pat_code'] ?></h1>



<form method="post">

<table class="form">

<tr>

  <td class="label">Inclusiedatum </td>

<?php
  if ($patient['begindatum']=="")
    $patient['begindatum'] = date("Y-m-d");
?>

  <td class="input">
     <input type="text" style="width: 33px;" name="begindag" value="<?= substr($patient['begindatum'],8,2) ?>" />-
     <input type="text" style="width: 33px;" name="beginmaand" value="<?= substr($patient['begindatum'],5,2) ?>" />-
     <input type="text" style="width: 58px;" name="beginjaar" value="<?= substr($patient['begindatum'],0,4) ?>" />
  </td>

</tr>



<tr>

  <td class="label">Toestemming met opname </td>

  <td class="input"><input type="checkbox" name="toestemming" value="1" <?php printChecked(1,$patient['toestemming']); ?>/>

       <a href="print_tp_toestemming.php?code=<?= $_SESSION['pat_code'] ?>" target="_blank">Toestemmingsformulier afdrukken</a></td>

</tr>



<tr>

  <td class="label">Opname in het project op voorstel van</td>

  <td class="input">

   <select name="opname[]" size="4" multiple="multiple">

<?php

   $qryAlle = "select organisatie.id, organisatie.naam

               from organisatie, tp_partner

               where (tp = {$_SESSION['tp_project']} and partner = organisatie.id)

                  or (organisatie.id = 13 and tp = {$_SESSION['tp_project']})

               order by organisatie.naam";

   $qryOpname = "select patient_tpopname.partner, organisatie.naam

               from organisatie, patient_tpopname

               where patient = '{$_SESSION['pat_code']}' and project = {$_SESSION['tp_project']}

                 and partner = organisatie.id

               order by organisatie.naam";

   $resultAlle = mysql_query($qryAlle);

   $resultOpname = mysql_query($qryOpname) or die($qryOpname . "<br/>" . mysql_error());

   if (mysql_num_rows($resultOpname)==0) {

     $rijOpname['partner'] = -1;

     $nogOpname = 0;

   }

   else {

     $rijOpname = mysql_fetch_assoc($resultOpname);

     $nogOpname = mysql_num_rows($resultOpname)-1;

   }

   



   for ($i=0; $i < mysql_num_rows($resultAlle); $i++) {

     $rijAlle = mysql_fetch_assoc($resultAlle);

     if ($rijOpname['partner'] == $rijAlle['id']) {

       $selected = " selected=\"selected\" ";

       if ($nogOpname > 0) {

         $rijOpname = mysql_fetch_assoc($resultOpname);

       }

       else {

         $rijOpname['partner'] = -1;

       }

       $nogOpname--;

     }

     else {

       $selected = " ";

     }

     print("<option $selected value=\"{$rijAlle['id']}\">{$rijAlle['naam']}</option>\n");

     // 'hack' om GDT maar 1x te tonen

     if ($rijAlle['id']==13) {

       for ($j = 0; $j < mysql_num_rows($resultAlle)/2-1; $j++) {

         $i++; $rijAlle = mysql_fetch_assoc($resultAlle);

       }

     }

   }

?>

   </select>

   

   <br />

   Overige: <input type="text" name="opname_overige" value="<?= $patient['opname_overige'] ?>" />

   

  </td>

</tr>



<tr>

  <td class="label">Hoofddiagnose</td>

  <td class="input">

   <select name="hoofddiagnose" size="4" >

<?php

   $qryAlle = "select * from tp_dsm where tp = {$_SESSION['tp_project']} order by dsm";

   $qrySecundair = "select dsm from patient_secundair

               where patient = '{$_SESSION['pat_code']}' and project = {$_SESSION['tp_project']}

               order by dsm";

   $resultAlle = mysql_query($qryAlle);

   $resultSecundair = mysql_query($qrySecundair);

   $nogSecundair = mysql_num_rows($resultSecundair);

   if ($nogSecundair > 0) {

      $huidigeDSM = mysql_fetch_assoc($resultSecundair);

      $nogSecundair--;

   }

   else {

     $huidigeDSM['dsm'] = "den deze bestaat zeker niet";

   }

   for ($i=0; $i < mysql_num_rows($resultAlle); $i++) {

     $rijAlle = mysql_fetch_assoc($resultAlle);

     if ($patient['hoofddiagnose'] == $rijAlle['dsm']) {

       $selected = " selected=\"selected\" ";

     }

     else {

       $selected = " ";

     }

     print("<option $selected>{$rijAlle['dsm']}</option>");

     if ($huidigeDSM['dsm'] == $rijAlle['dsm']) {

       $selected = " selected=\"selected\" ";

       if ($nogSecundair > 0) {

         $huidigeDSM = mysql_fetch_assoc($resultSecundair);

         $nogSecundair--;

       }

     }

     else {

       $selected = " ";

     }

     $select2 .= "<option $selected>{$rijAlle['dsm']}</option>\n";

   }

?>

   </select>

  </td>

</tr>



<tr>

  <td class="label">Secundaire diagnose<br/>(Gebruik ctrl-klik)</td>

  <td class="input">

   <select name="secundairediagnose[]" size="4" multiple="multiple">

<?=  $select2 ?>

   </select>

  </td>

</tr>



<tr>

  <td class="label">Bijkomende informatie omtrent probleemsituatie</td>

  <td class="input"><textarea name="omschrijving"><?= $patient['omschrijving'] ?></textarea></td>

</tr>



<tr>

<td colspan="2">

<br /><strong>Duid hieronder de elementen aan waaraan deze pati&euml;nt voldoet.  </strong>

</td>

</tr>

<?php

  if ($tp_basisgegevens['aanvullend1']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend1" value="1" <?php printChecked(1,$patient['aanvullend1']); ?>/>

       <?= $tp_basisgegevens['aanvullend1']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend2']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend2" value="1" <?php printChecked(1,$patient['aanvullend2']); ?>/>

       <?= $tp_basisgegevens['aanvullend2']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend3']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend3" value="1" <?php printChecked(1,$patient['aanvullend3']); ?>/>

       <?= $tp_basisgegevens['aanvullend3']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend4']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend4" value="1" <?php printChecked(1,$patient['aanvullend4']); ?>/>

       <?= $tp_basisgegevens['aanvullend4']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend5']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend5" value="1" <?php printChecked(1,$patient['aanvullend5']); ?>/>

       <?= $tp_basisgegevens['aanvullend5']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend6']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend6" value="1" <?php printChecked(1,$patient['aanvullend6']); ?>/>

       <?= $tp_basisgegevens['aanvullend6']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend7']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend7" value="1" <?php printChecked(1,$patient['aanvullend7']); ?>/>

       <?= $tp_basisgegevens['aanvullend7']?></td>

</tr>

<?php

  }

  if ($tp_basisgegevens['aanvullend8']!="") {

?>

<tr>

  <td class="label">&nbsp; </td>

  <td class="input"><input type="checkbox" name="aanvullend8" value="1" <?php printChecked(1,$patient['aanvullend8']); ?>/>

       <?= $tp_basisgegevens['aanvullend8']?></td>

</tr>

<?php

  }

?>







<!-- en dan nu de specifieke statistischegegevens -->



<tr>

<td colspan="2">

<br /><strong>Vul hieronder de project-specifieke vragen in. </strong>

</td>

</tr>

<?php

  $qryVragen = "select nr, vraag from tp_vragen where tp = {$_SESSION['tp_project']} order by nr";

  $resultVragen = mysql_query($qryVragen);

  for ($j=0; $j < mysql_num_rows($resultVragen); $j++) {

    $vraag = mysql_fetch_assoc($resultVragen);

    if ($j%2 == 1) {

      $kleur = " style='background-color: #ffd' ";

    }

    else {

      $kleur = "";

    }

    print("<tr $kleur><td class=\"label\" style='vertical-align: top'>{$vraag['vraag']}$ster</td>\n<td class=\"input\">");

    $qryAntwoord = "select optie, antwoord from tp_antwoorden where tp  = {$_SESSION['tp_project']} and vraag = {$vraag['nr']} order by optie";

    $resultAntwoord = mysql_query($qryAntwoord);

    $vraagNr = $vraag['nr'];

    $ingevuldAntwoord = $antwoorden[$vraagNr];

    for ($k=0; $k < mysql_num_rows($resultAntwoord); $k++) {

      $antwoord = mysql_fetch_assoc($resultAntwoord);

      print("<input type=\"checkbox\" name=\"antwoord[{$vraag['nr']}][$k]\" value=\"{$antwoord['optie']}\" ");

      printChecked(komtVoorInAntwoorden($antwoorden[$vraag['nr']], $antwoord['optie']),1);

      print("/>{$antwoord['antwoord']}<br/> \n");

    }

  }

  print("</select></td></tr>");

?>

<tr>

  <td class="label">Gegevens: </td>

  <td class="input"><input type="submit" value="opslaan" onclick="if (!document.forms[0].toestemming.checked) alert('Pas op. De patient heeft blijkbaar nog geen toestemming gegeven.\nPas wanneer die toestemming binnen is, zal je een overleg kunnen afronden.');"/></td>

</tr>



</table>

<input type="hidden" name="patient" value="<?= $_SESSION['pat_code'] ?>" />

</form>

<?php



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

    }

    else {

      print("Alleen de hoofdprojectcoordinator kan dit doen. Contacteer hem/haar!");

    }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>