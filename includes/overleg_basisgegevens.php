<?php

/*

  if (!(isset($overlegInfo['locatie']) &&

        isset($overlegInfo['aanwezig_aanwezig']) &&

        isset($overlegInfo['akkoord_patient'])))

    $ontbrekendeBasisGegevens = "true";

  else

    $ontbrekendeBasisGegevens = "false";

*/

    $ontbrekendeBasisGegevens = "false";

    

  if ($overlegInfo['id']>0) {

      $saveOMBmetOverleg = "+ \"&overlegID={$overlegInfo['id']}\"";

  }



?>



<script type="text/javascript">



var ontbrekendeBasisGegevens = <?= $ontbrekendeBasisGegevens ?>;



function saveOMB(patientcode, actief) {

   var request = createREQ();

   var rand1 = parseInt(Math.random()*9);

   var rand2 = parseInt(Math.random()*999999);

   var url = "../php/omb_vraag_opslaan_ajax.php?code=" + patientcode + "&omb_actief=" + actief + "&rand" + rand1 + "=" + rand2 <?= $saveOMBmetOverleg ?>;



   request.open("GET", url);

   request.send(null);

   
   if (actief==1) {
     document.getElementById('ombformulier').style.display = "block";
   }
   if (actief==-1) document.getElementById('ombformulier').style.display = "none";

}



function extraGegevensOpslaan() {

  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);



  var locatie = -1;

  var instemming=-1;

  var aanwezig=-1;

  for(var i = 0; i < document.doeoverlegform.overleg_instemming.length; i++) {

    if(document.doeoverlegform.overleg_instemming[i].checked) {

      instemming=document.doeoverlegform.overleg_instemming[i].value;

      i=document.doeoverlegform.overleg_instemming.length;

    }

  }

  for(var i = 0; i < document.doeoverlegform.overleg_locatie_id.length; i++) {

    if(document.doeoverlegform.overleg_locatie_id[i].checked) {

      locatie=document.doeoverlegform.overleg_locatie_id[i].value;

      i=document.doeoverlegform.overleg_locatie_id.length;

    }

  }

  for(var i = 0; i < document.doeoverlegform.aanwezig_patient.length; i++) {

    if(document.doeoverlegform.aanwezig_patient[i].checked) {

      aanwezig=document.doeoverlegform.aanwezig_patient[i].value;

      i=document.doeoverlegform.aanwezig_patient.length;

    }

  }



  var vertegenwoordiger;

  if (document.doeoverlegform.vertegenwoordiger) {

    vertegenwoordiger = document.doeoverlegform.vertegenwoordiger.value;

    if (aanwezig == -1) fout += " - geen aanwezigheid aangeduid\n";

  }

  else {

    vertegenwoordiger = -1;

  }

  var fout="";

  if (locatie == -1) fout = " - geen locatie gekozen\n";

  if (instemming == -1) fout += " - niet aangeduid of patient akkoord gaat\n";



    if (document.doeoverlegform.overleg_dd.value == ""  ||

        document.doeoverlegform.overleg_mm.value == ""  ||

        document.doeoverlegform.overleg_jj.value == "") {

       fout += " - geen datum ingegeven.\n";

    }

    else if (document.doeoverlegform.overleg_dd.value < 1 || document.doeoverlegform.overleg_dd.value > 31  ||

        document.doeoverlegform.overleg_mm.value < 1  || document.doeoverlegform.overleg_mm.value > 12 ||

        document.doeoverlegform.overleg_jj.value < 1970 || document.doeoverlegform.overleg_jj.value > 2069 ) {

       fout += " - geen geldige datum.\n";

    }



        var datum = "" + document.doeoverlegform.overleg_jj.value + ""

                  + document.doeoverlegform.overleg_mm.value  + ""

                  + document.doeoverlegform.overleg_dd.value;





  if (document.doeoverlegform.overleg_locatie_id2.checked) {

    locatie = 2;

  }



  var url = "overleg_locatie_ajax.php?locatie=" + locatie +

            "&instemming=" + instemming +

            "&aanwezig=" + aanwezig +

            "&datum=" + datum +

            "&vertegenwoordiger=" + vertegenwoordiger +

            "&locatieTekst=" + document.doeoverlegform.overleg_locatie.value +

            "&tijdstip=" + document.doeoverlegform.overleg_uur.value +

            "&id=<?= $overlegID ?>&rand" + rand1 + "=" + rand2;

  request.onreadystatechange = function() {

    if (request.readyState < 4) {

//       alert(request.responseText);

    }

    else {

      var result = request.responseText;

      var spatie = 0;

      while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {

        alert("De bijkomende gegevens over het overleg zijn succesvol opgeslagen.");

<?php

  if (isset($_GET['afronden']))

    print("window.location = 'overleg_alles.php?tab=Basisgegevens2?afronden=1';");

  else

    print("window.location = 'overleg_alles.php?tab=Basisgegevens2';");

?>

         ontbrekendeBasisGegevens = false;

      }

    }

  }



  // en nu nog de request uitsturen

  if (fout == "") {

    request.open("GET", url);

    request.send(null);

  }

  else {

    alert("Niet opgeslagen want, \n\n" + fout);

  }

}

function extraGegevensPsyOpslaan() {
  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);
  var rand2 = parseInt(Math.random()*999999);

  var locatie = -1;
  var ambulant=-1;
  var huisartsBelangrijk=-1;


  for(var i = 0; i < document.doeoverlegform.ambulant.length; i++) {
    if(document.doeoverlegform.ambulant[i].checked) {
      ambulant=document.doeoverlegform.ambulant[i].value;
      i=document.doeoverlegform.ambulant.length;
    }
  }

  for(var i = 0; i < document.doeoverlegform.overleg_locatie_id.length; i++) {
    if(document.doeoverlegform.overleg_locatie_id[i].checked) {
      locatie=document.doeoverlegform.overleg_locatie_id[i].value;
      i=document.doeoverlegform.overleg_locatie_id.length;
    }
  }

  if (document.doeoverlegform.huisarts_belangrijk.checked) {
    huisartsBelangrijk=document.doeoverlegform.huisarts_belangrijk.value;
  }

  var fout="";
  if (locatie == -1) fout = " - geen locatie gekozen\n";
  if (ambulant == -1) fout += " - niet aangeduid of patient ambulant is of in een ziekenhuis opgenomen is\n";
  if (huisartsBelangrijk == -1) fout += " - de huisarts moet uitgenodigd worden of er moet er een gezocht worden\n";

    if (document.doeoverlegform.overleg_dd.value == ""  ||
        document.doeoverlegform.overleg_mm.value == ""  ||
        document.doeoverlegform.overleg_jj.value == "") {
       fout += " - geen datum ingegeven.\n";
    }
    else if (document.doeoverlegform.overleg_dd.value < 1 || document.doeoverlegform.overleg_dd.value > 31  ||
        document.doeoverlegform.overleg_mm.value < 1  || document.doeoverlegform.overleg_mm.value > 12 ||
        document.doeoverlegform.overleg_jj.value < 1970 || document.doeoverlegform.overleg_jj.value > 2069 ) {
       fout += " - geen geldige datum.\n";
    }

        var datum = "" + document.doeoverlegform.overleg_jj.value + ""
                  + document.doeoverlegform.overleg_mm.value  + ""
                  + document.doeoverlegform.overleg_dd.value;

  var url = "overleg_psy_extragegevens_ajax.php?locatie=" + locatie +
            "&ambulant=" + ambulant +
            "&huisartsBelangrijk=" + huisartsBelangrijk +
            "&datum=" + datum +
            "&id=<?= $overlegID ?>&rand" + rand1 + "=" + rand2;

  request.onreadystatechange = function() {

    if (request.readyState < 4) {

//       alert(request.responseText);

    }

    else {

      var result = request.responseText;

      var spatie = 0;

      while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {

        alert("De bijkomende gegevens over het overleg zijn succesvol opgeslagen.");

<?php

  if (isset($_GET['afronden']))

    print("window.location = 'overleg_alles.php?tab=Basisgegevens2?afronden=1';");

  else

    print("window.location = 'overleg_alles.php?tab=Basisgegevens2';");

?>

         ontbrekendeBasisGegevens = false;

      }

    }

  }



  // en nu nog de request uitsturen

  if (fout == "") {

    request.open("GET", url);

    request.send(null);

  }

  else {

    alert("Niet opgeslagen want, \n\n" + fout);

  }

}

</script>

<?php

// als      $overlegID niet bestaat of == -1; dan leeg formulier om in te vullen

// anders   ingevuld formulier zonder verzendknop; ($overlegInfo bestaat dan)





//include("../includes/toonSessie.inc");

    $geenKeuzeVergoeding = true;

    if (isset($overlegID) && ($overlegID > 0)) {

      // effe alle huidige waarden van het overleg ophalen voor in het formulier

      $defaultChecked = "";

      $checked = " checked=\"checked\" ";

      $datum = $overlegInfo['datum'];
      $datumIsAlIngevuld = true;

      $dag = substr($datum, 6, 2);

      $maand = substr($datum, 4, 2);

      $jaar = substr($datum, 0, 4);

      $tijdstip = $overlegInfo['tijdstip'];

      $locatieTekst = $overlegInfo['locatieTekst'];



      switch ($overlegInfo['locatie']) {

         case 0: $locatie0 = $checked; break;

         case 1: $locatie1 = $checked; break;

         case 2: $locatie2 = $checked; break;

         case 3: $locatie3 = $checked; break;

      }

      if (!isset($overlegInfo['locatie']))

        $locatie0 = "";

      switch ($overlegInfo['akkoord_patient']) {

         case 0: $niet_akkoord = $checked; break;

         case 1: $akkoord = $checked; break;

      }

      if (!issett($overlegInfo['akkoord_patient']))

        $niet_akkoord = "";

      switch ($overlegInfo['aanwezig_patient']) {

         case 0: $afwezig = $checked; break;

         case 1: $aanwezig = $checked; break;

         case 2: $vertegenwoordigd = $checked; break;

      }

      if (!issett($overlegInfo['aanwezig_patient']))

        $afwezig = "";

      $geenKeuzeVergoeding = false;

      switch ($overlegInfo['keuze_vergoeding']) {

         case 0:

         case -1:

                 $geen_vergoeding = $checked; break;

         case 1: $vergoeding = $checked; break;
         case 2: $vergoeding = $checked; break;

         default: $geenKeuzeVergoeding = true;

      }

      

    }

    else {

      $defaultChecked = " checked=\"checked\" ";

    }



  if (tp_opgenomen($_SESSION['pat_code'])) {

    $nextTab = "overleg_locatie";

    $minjaar = "2006";

  }

  else {

    $nextTab = "submit";

    $minjaar = "1970";

  }

  

  // OMB-vraag

  if (substr($patientInfo['gebdatum'],0,4)<=(date("Y")-55)) {

    $ombmogelijk = true;

    $ombvraagverplicht = " if (document.doeoverlegform.ombvermoeden[0].checked || document.doeoverlegform.ombvermoeden[1].checked) return true; else {alert('De vraag naar ouderenmis(be)handeling is niet beantwoord!\\nDoe dit eerst.');return false;}; ";

    $nextTab = "";

    if ($patientInfo['omb_actief']=="") {

       $ombactief = "";

       print("<script type=\"text/javascript\">var ombintevullen=false;</script>\n");

    }

    else if ($overlegInfo['omb_actief']==1) {

       $ombactief = " checked=\"checked\" ";

       print("<script type=\"text/javascript\">var ombintevullen=true;</script>\n");

       $ombintevullen = true;

    }

    else if ($overlegInfo['omb_actief']==-1) {

      $ombpassief = " checked=\"checked\" ";

      print("<script type=\"text/javascript\">var ombintevullen=false;</script>\n");

    }

    if ($patientInfo['omb_actief']==1) {

       print("<script type=\"text/javascript\">var ombintevullen=true;</script>\n");

    }

    else {

      print("<script type=\"text/javascript\">var ombintevullen=false;</script>\n");

    }

  }

  else {

      print("<script type=\"text/javascript\">var ombintevullen=false;</script>\n");

  }



    ?>

<script type="text/javascript">

<!--

function checkRadios()

    {

    var melding="";

    var waarde="";

    var radios= new Array("overleg_locatie_id");

    /*

    for (var radio=0;radio<radios.length;radio++)

        {

        radioObj=eval("document.forms['doeoverlegform'].elements['"+radios[radio]+"']");

           for(var i = 0; i < radioObj.length; i++)

              {

            if(radioObj[i].checked)

                 {

                var waarde=radioObj[i].value;

                i=radioObj.length;

                }

            }

        if (waarde!="")

            {

            //melding=melding+radios[radio]+" - "+waarde+"\n";

            var ingevuld=true;

            waarde="";

            }

        else 

            {

            melding="U hebt geen locatie opgegeven";

            var ingevuld=false;

            i=radioObj.length;

            radio=radios.length;

            }

        }

    */



    var ingevuld = true;



    if (document.doeoverlegform.overleg_dd.value == ""  ||

        document.doeoverlegform.overleg_mm.value == ""  ||

        document.doeoverlegform.overleg_jj.value == "") {

       ingevuld = false;

       melding = melding + "\nU hebt geen datum ingegeven.";

    }

    else if (document.doeoverlegform.overleg_dd.value < 1 || document.doeoverlegform.overleg_dd.value > 31  ||

        document.doeoverlegform.overleg_mm.value < 1  || document.doeoverlegform.overleg_mm.value > 12 ||

        document.doeoverlegform.overleg_jj.value < <?= $minjaar ?> || document.doeoverlegform.overleg_jj.value > 2069 ) {

       ingevuld = false;

       melding = melding + "\nDit is geen geldige datum.";

    }



    if (!ingevuld)

        {

        alert(melding);

        return false;

        }

    else 

        {

        var datum = document.doeoverlegform.overleg_dd.value + "/"

                  + document.doeoverlegform.overleg_mm.value + "/"

                  + document.doeoverlegform.overleg_jj.value;

<?php

  $queryElkOverleg = "SELECT * FROM overleg WHERE patient_code = '{$_SESSION['pat_code']}' AND afgerond=1";

  if (mysql_num_rows(mysql_query($queryElkOverleg)) == 0) {

      $doeControleOpStartJaar = "true";

      $startjaar =  substr($_SESSION['pat_code'], 6,2);

      $extraWaarschuwing = "\\n\\nPas op! Dit jaar komt niet overeen het startjaar van het dossier!\\n Ben je 100% zeker?";

    }

    else {

      $doeControleOpStartJaar = "false";

      $startjaar = -1;

      $extraWaarschuwing = "";

    }

?>

        if (<?= $doeControleOpStartJaar ?> && (document.doeoverlegform.overleg_jj.value.substr(2,2) != <?= $startjaar ?> )) {

           return confirm("Bevestig dat de datum van het overleg " + datum + " is. <?= $extraWaarschuwing ?>");

        }

        else {

           return confirm("Bevestig dat de datum van het overleg " + datum + " is.");

        }

    }

}

//-->

</script>

<?php





  if (!issett($overlegID) || $overlegID == -1) {

     $disable = "";

  }

  else {

     $disable = " disabled=\"disabled\" style=\"background-color: #f4f4f4; color: #080808; border: none;\"  ";

  }





//$disable = "";





  $pat_type=$patientInfo['type'];

  $locatie=(($pat_type==1)OR($pat_type==2))?

        "<td><input type=\"radio\" name=\"overleg_locatie_id\" $locatie2 value=\"2\" /></td>

        <td>In deskundig ziekenhuiscentrum</td></tr><tr>":""; // eventueel invoegen van een derde

  // locatie indien het patienttype  PVS of MRS is

  // --------------------------------------------------------

  //---------------------------------------------------------

  







?>



<form id="basisgegevens" action="overleg_alles.php?tab=NieuwOverleg" method="post" name="doeoverlegform" onsubmit="return checkRadios();">

   <fieldset>

      <div class="inputItem" id="IIStartdatum">

         <div class="label220">Datum overleg (dd/mm/jjjj)<div class="reqfield">*</div>&nbsp;: </div>

         <div class="waarde">

            <input <?= $disable ?> type="text" size="2" value="<?= $dag ?>" name="overleg_dd" id="overleg_dd"

                onKeyup="checkForNumbersOnly(this,2,0,31,'doeoverlegform','overleg_mm')" 

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input <?= $disable ?> type="text" size="2" value="<?= $maand ?>" name="overleg_mm" id="overleg_mm"

                onKeyup="checkForNumbersOnly(this,2,0,12,'doeoverlegform','overleg_jj')" 

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input <?= $disable ?> type="text" size="2" value="<?= $jaar ?>" name="overleg_jj" id="overleg_jj"

                onkeyup="checkForNumbersOnly(this,4,<?= $minjaar ?>,2069,'doeoverlegform','<?= $nextTab ?>')"

                onblur="checkForNumbersLength(this,4)" />

         </div> 
      </div><!--overleg_dd,overleg_mm,overleg_jj-->

<?php
  $aanvraagRecordControleViaBasisgegevens = true;
  // ofwel bestaat dit overleg al
  if ($overlegID > 0) {
    // ofwel bestaat er al een aanvraag_record voor dit overleg
    // TE DOEN
    $zoekAanvraagQry = "select * from aanvraag_overleg where overleg_id = $overlegID";
    $aanvraagResult = mysql_query($zoekAanvraagQry) or die("wat is dat met het zoeken naar een aanvraag? " . mysql_error());
    if (mysql_num_rows($aanvraagResult) > 0) {
      // er bestaat al een aanvraag en dus laten we die zien
      $aanvraagRecord = mysql_fetch_assoc($aanvraagResult);

      $doel = "";
      if ($aanvraagRecord['doel_informeren']==1) {
        if ($doel != "") $doel .= ", informeren";
        else $doel = "informeren";
      }
      if ($aanvraagRecord['doel_overtuigen']==1) {
        if ($doel != "") $doel .= ", overtuigen";
        else $doel = "overtuigen";
      }
      if ($aanvraagRecord['doel_organiseren']==1) {
        if ($doel != "") $doel .= ", organiseren";
        else $doel = "organiseren";
      }
      if ($aanvraagRecord['doel_debriefen']==1) {
        if ($doel != "") $doel .= ", debriefen";
        else $doel = "debriefen";
      }
      if ($aanvraagRecord['doel_beslissen']==1) {
        if ($doel != "") $doel .= ", beslissen";
        else $doel = "beslissen";
      }
      if ($aanvraagRecord['doel_andere']!="") {
        if ($doel != "") $doel .= ", {$aanvraagRecord['doel_andere']}";
        else $doel = "{$aanvraagRecord['doel_andere']}";
      }
      if ($aanvraagRecord['naam_aanvrager'] == "patient") {
        $infoAanvrager = "pati&euml;nt";

      }
      else {
        $infoAanvrager = "{$aanvraagRecord['naam_aanvrager']}, {$aanvraagRecord['discipline_aanvrager']}, {$aanvraagRecord['organisatie_aanvrager']} {$aanvraagRecord['info_aanvrager']}";
      }
      echo <<< INFO
      <div class="inputItem" id="infoBlok">
         <div style="margin-left:20px;font-size:90%;background-color: #f0e5d6;width:500px;">Aanvrager: {$infoAanvrager}<br/>
                                           Doel: {$doel} <br/>&nbsp;  </div>
      </div>
INFO;
    }
    // als er nog geen aanvraag-record bestaat, moeten we niks doen.
  }
  // ofwel komt dit overleg uit een aanvraag voort
  else if (isset($_GET['aanvraag'])) {
    $aanvraagRecord = getUniqueRecord("select * from aanvraag_overleg where id = {$_GET['aanvraag']}");

      $doel = "";
      if ($aanvraagRecord['doel_informeren']==1) {
        if ($doel != "") $doel .= ", informeren";
        else $doel = "informeren";
      }
      if ($aanvraagRecord['doel_overtuigen']==1) {
        if ($doel != "") $doel .= ", overtuigen";
        else $doel = "overtuigen";
      }
      if ($aanvraagRecord['doel_organiseren']==1) {
        if ($doel != "") $doel .= ", organiseren";
        else $doel = "organiseren";
      }
      if ($aanvraagRecord['doel_debriefen']==1) {
        if ($doel != "") $doel .= ", debriefen";
        else $doel = "debriefen";
      }
      if ($aanvraagRecord['doel_beslissen']==1) {
        if ($doel != "") $doel .= ", beslissen";
        else $doel = "beslissen";
      }
      if ($aanvraagRecord['doel_andere']!="") {
        if ($doel != "") $doel .= ", {$aanvraagRecord['doel_andere']}";
        else $doel = "{$aanvraagRecord['doel_andere']}";
      }
      if ($aanvraagRecord['naam_aanvrager'] == "patient") {
        $infoAanvrager = "pati&euml;nt";

      }
      else {
        $infoAanvrager = "{$aanvraagRecord['naam_aanvrager']}, {$aanvraagRecord['discipline_aanvrager']}, {$aanvraagRecord['organisatie_aanvrager']} {$aanvraagRecord['info_aanvrager']}";
      }
      echo <<< INFO
      <div class="inputItem" id="infoBlok">
         <div style="margin-left:20px;font-size:90%;background-color: #f0e5d6;width:500px;">Aanvrager: {$infoAanvrager}<br/>
                                           Doel: {$doel} <br/>&nbsp;  </div>
      </div>
INFO;
    $naAanvraag31dagen = date("Ymd",$aanvraagRecord['timestamp']+60*60*24*31);
    $extraControleTijdigheid = "if (!testTijdigOverleg($naAanvraag31dagen)) return false;";
    
    if (issett($overlegID)) $nietMeerWijzigen = " onkeydown=\"return false;\" ";
?>
      <div class="inputItem" id="laatBlok" style="display:none;">

         <div class="label220">Waarom kan het overleg niet<br/>
                                tijdig georganiseerd worden?<div class="reqfield">*</div>&nbsp;: </div>

         <div class="waarde">
           <textarea id="laat" name="laat" style="width:275px;height:50px;" <?= $nietMeerWijzigen ?> ><?= $aanvraagRecord['reden_status'] ?></textarea>
         </div>
      </div><!--overleg_dd,overleg_mm,overleg_jj-->
<?php
  }
  // we zijn nu 'rechtstreeks' een overleg aan het maken!
  else if ($patientInfo['tp_record']>0) {
    // als we een tp-overleg hebben, dan moet er geen aanvraag-record zijn
  }
  else {
    // nu is het een gewoon overleg ('gewoon' in de zin van niet-TP)
    // eerst kijken of er al een aanvraag bestaat.
    $zoekAanvraagQry = "select * from aanvraag_overleg where patient_code = '{$_SESSION['pat_code']}'";
    $aanvraagResult = mysql_query($zoekAanvraagQry) or die("wat is dat met het zoeken naar een aanvraag? " . mysql_error());
    if (mysql_num_rows($aanvraagResult) > 0) {
      // er bestaat al een aanvraag en dus laten we die zien
      $aanvraagRecord = mysql_fetch_assoc($aanvraagResult);

      $doel = "";
      if ($aanvraagRecord['doel_informeren']==1) {
        if ($doel != "") $doel .= ", informeren";
        else $doel = "informeren";
      }
      if ($aanvraagRecord['doel_overtuigen']==1) {
        if ($doel != "") $doel .= ", overtuigen";
        else $doel = "overtuigen";
      }
      if ($aanvraagRecord['doel_organiseren']==1) {
        if ($doel != "") $doel .= ", organiseren";
        else $doel = "organiseren";
      }
      if ($aanvraagRecord['doel_debriefen']==1) {
        if ($doel != "") $doel .= ", debriefen";
        else $doel = "debriefen";
      }
      if ($aanvraagRecord['doel_beslissen']==1) {
        if ($doel != "") $doel .= ", beslissen";
        else $doel = "beslissen";
      }
      if ($aanvraagRecord['doel_andere']!="") {
        if ($doel != "") $doel .= ", {$aanvraagRecord['doel_andere']}";
        else $doel = "{$aanvraagRecord['doel_andere']}";
      }
      if ($aanvraagRecord['naam_aanvrager'] == "patient") {
        $infoAanvrager = "pati&euml;nt";

      }
      else {
        $infoAanvrager = "{$aanvraagRecord['naam_aanvrager']}, {$aanvraagRecord['discipline_aanvrager']}, {$aanvraagRecord['organisatie_aanvrager']} {$aanvraagRecord['info_aanvrager']}";
      }
      echo <<< INFO
      <div class="inputItem" id="infoBlok">
         <div style="margin-left:20px;font-size:90%;background-color: #f0e5d6;width:500px;">Aanvrager: {$infoAanvrager}<br/>
                                           Doel: {$doel} <br/>&nbsp;  </div>
      </div>
INFO;
    $naAanvraag31dagen = date("Ymd",$aanvraagRecord['timestamp']+60*60*24*31);
    $extraControleTijdigheid = "if (!testTijdigOverleg($naAanvraag31dagen)) return false;";

?>
      <div class="inputItem" id="laatBlok" style="display:none;">

         <div class="label220">Waarom kan het overleg niet<br/>
                                tijdig georganiseerd worden?<div class="reqfield">*</div>&nbsp;: </div>

         <div class="waarde">
           <textarea id="laat" name="laat" style="width:275px;height:50px;" ><?= $aanvraagRecord['reden_status'] ?></textarea>
         </div>
      </div><!--overleg_dd,overleg_mm,overleg_jj-->
<?php
     } // EINDE: er bestaat al een aanvraag
     else {
       // Zo nee:  laten invullen wie de aanvrager van het overleg is
       /***********************************************************/
       /*********** begin aanvrager van het overleg ***************/
       /***********************************************************/
?>
        <div class="inputItem" id="IIContactpersoon">
         <div class="label220">Aanvrager<div class="reqfield">*</div>&nbsp;: </div>
    <div class="waarde">
        <select size="1" name="aanvrager_complex" >
<?php
//----------------------------------------------------------
// Vul Input-select-element vanuit dbase met lijst
// betrokken hulpverleners voor deze patient (HVL's)
    $queryHVL = "
        SELECT
            hb.persoon_id,
            hb.genre,
            h.naam,
            h.voornaam,
            h.organisatie,
            o.naam as org_naam,
            f.naam  as functienaam
        FROM
            hulpverleners h left join organisatie o on h.organisatie = o.id,
            huidige_betrokkenen hb,
            functies f
        WHERE
            hb.overleggenre = 'gewoon' AND
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            (hb.genre = 'hulp' or hb.genre='orgpersoon') AND
            h.fnct_id=f.id
            $extraVW
        ORDER BY
            f.rangorde, hb.id, h.naam";


    $switch=false;

    if ($result=mysql_query($queryHVL))
    {
        $aantalxvl=mysql_num_rows ($result);
        for ($i=0; $i < mysql_num_rows ($result); $i++)
        {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['persoon_id'] && ($genre == "hulp" || $genre == "orgpersoon"))
                 {$selected=" selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"{$records['org_naam']}|hulp|{$records['voornaam']} {$records['naam']}\" ".$selected." $stijl>".$records['naam']." ".$records['voornaam']." ({$records['functienaam']})</option>\n");
        }
    }
    // betrokken mantelzorgers voor deze patient (ZVL's)
    $queryMZ = "
        SELECT
            hb.persoon_id,
            h.naam,
            h.voornaam,
            f.naam  as functienaam
        FROM
            mantelzorgers h,
            huidige_betrokkenen hb,
            verwantschap f
        WHERE
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            hb.genre = 'mantel' AND
            h.verwsch_id=f.id
        ORDER BY
            f.rangorde, hb.id, h.naam";
    if ($result=mysql_query($queryMZ))
        {
        $aantalxvl=mysql_num_rows ($result);
        for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['persoon_id'] && $genre == "mantel")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"{$records['functienaam']}|mantel|{$records['voornaam']} {$records['naam']}\" ".$selected.">".$records['naam']." ".$records['voornaam']." ({$records['functienaam']})</option>\n");
            }
        }
// betrokken overlegcoordinatoren voor deze patient (ZVL's)
    $queryOC = "
        SELECT
            oc.id,
            oc.naam,
            oc.voornaam
        FROM
            logins oc,
            patient,
            gemeente
        WHERE
            oc.profiel = 'OC' AND
            oc.actief = 1 AND
            overleg_gemeente = gemeente.zip
            and gemeente.id = patient.gem_id
            and patient.code ='".$_SESSION["pat_code"]."'";
    if ($result=mysql_query($queryOC))
        {
        for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['id'] && $genre == "oc")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"oc|oc|{$records['voornaam']} {$records['naam']}\" ".$selected.">".$records['naam']." ".$records['voornaam']." (OC TGZ)</option>\n");
            }
        }

// betrokken PROJECTcoordinatoren voor deze patient (ZVL's)
    $queryTP = "
        SELECT
            oc.id,
            oc.naam,
            oc.voornaam,
            oc.profiel
        FROM
            logins oc,
            patient_tp
        WHERE
            (oc.profiel = 'hoofdproject' || oc.profiel = 'bijkomend project') AND
            oc.actief = 1 AND
            oc.tp_project = patient_tp.project
            and patient ='".$_SESSION["pat_code"]."'";
    if ($result=mysql_query($queryTP) or die($queryTP . mysql_error()))
    {
        for ($i=0; $i < mysql_num_rows ($result); $i++)
        {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['id'] && $genre == "oc")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"{$records['profiel']}|{$records['profiel']}|{$records['voornaam']} {$records['naam']}\" ".$selected.">".$records['naam']." ".$records['voornaam']."</option>\n");
        }
    }


        if($persoonID==-1 && $genre == "patient")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
        print ("
               <option value=\"-1|patient|patient\" ".$selected.">".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (patient)</option>\n");
        $selected=($switch)?"":"selected=\"selected\"";
        print("<option value=\"10431|onbenoemd|onbenoemd\"".$selected.">Onbenoemd</option>");
//----------------------------------------------------------
?>
        </select>
        <input type="hidden" name="zonderAanvraag" value="1" />
        <div>Pas eventueel eerst de <a href="zorgteam_bewerken.php">teamsamenstelling</a> aan.</div>
    </div><!-- aanvrager -->
<?php

     /***********************************************************/
     /*********** einde aanvrager van het overleg ***************/
     /***********************************************************/
     }
  }
  /** volledig einde van het tonen/aanpassen van de aanvraag van het overleg **/
  
  if (substr($patientInfo['gebdatum'],0,4)<=(date("Y")-55)) {

?>

      <div class="inputItem" id="IIOMB">

         <div class="label220">Is er een vermoeden van ouderenmis(be)handeling?<div class="reqfield">*</div>&nbsp;: </div>

         <div class="waarde">

            <input type="radio" name="ombvermoeden" value="1" <?= $ombactief ?> onclick="ombintevullen=true;saveOMB('<?= $_SESSION['pat_code'] ?>', 1);" />ja

            <input type="radio" name="ombvermoeden" value="-1" <?= $ombpassief ?> onclick="ombintevullen=false;saveOMB('<?= $_SESSION['pat_code'] ?>', -1);" />nee

         </div>

      </div><!--ombvermoeden-->

<?php

  }

?>

   </fieldset>



<?php

  $displayGeenTP = $displayAjaxKnop = "block";

  $displayWelTP = "none";

  if (tp_opgenomen($_SESSION['pat_code'])) {

    $display = $display1 = "block";

    $displayGeenTP = "none";

    $displayWelTP = "block";

    if ($jaar > 0)

      $displayAjaxKnop = "block";

    else

      $displayAjaxKnop = "none";

  }

  else if ($geenKeuzeVergoeding) {

    $display = $display1 = "none";

  }

  else {

    $display = "block";

    if ($overlegInfo['keuze_vergoeding'] > 0)

      $display1 = "block";

    else

      $display1 = "none";

  }

  if ($_GET['tab'] == "extraGegevens") {

    $opvallend = ""; //moest vroeger opvallen, nu niet meer "border: 3px red dashed";

  }

?>

   <fieldset style="display:<?= $display1 ?>;<?= $opvallend ?>">

      <div class="inputItem" id="IIOverleg_locatie_id" style="clear:both;display:<?= $displayGeenTP ?>;">

         <div class="label220">Plaats van het overleg<sup><font color="#CC3300">*</font></sup>&nbsp;: </div>

         <div class="waardex">
           <table><tr><td><input  type="radio" name="overleg_locatie_id" <?= $locatie0 ?> value="0" /></td>
                      <td>Bij pati&euml;nt thuis</td></tr>
                  <tr><?php print($locatie);?>
                      <td><input type="radio" name="overleg_locatie_id" <?= $locatie1 ?> value="1" /></td>
                      <td>Elders</td></tr>
           </table>
         </div>  

      </div><!--overleg_locatie_id-->

      <div class="inputItem" id="IIOverleg_locatie_id2" style="clear:both;display:<?= $displayWelTP ?>;">

         <div class="label220">Plaats van het overleg<sup><font color="#CC3300">*</font></sup>&nbsp;: </div>

         <div class="waardex">

            <input  type="text" name="overleg_locatie" value="<?= $locatieTekst ?>" />

         </div>

      </div><!--overleg_locatie-->

      <div class="inputItem" id="IIOverleg_locatie_id3" style="clear:both;display:<?= $displayWelTP ?>;">

         <div class="label220">Vink aan als pati&euml;nt verblijft in een deskundig ziekenhuiscentrum&nbsp;: </div>

         <div class="waardex">

            <input  type="checkbox" name="overleg_locatie_id2" value="2" <?= $locatie2 ?> />

         </div>

      </div><!--overleg_locatie-->

      <div class="inputItem" id="IIOverleg_uur" style="clear:both;display:<?= $displayWelTP ?>;">

         <div class="label220">Tijdstip van het overleg<sup><font color="#CC3300">*</font></sup>&nbsp;: </div>

         <div class="waardex">

            <input  type="text" name="overleg_uur" value="<?= $tijdstip ?>" />

         </div>

      </div><!--overleg_uur-->

<?php

  if (isEersteOverlegTP()) {
    print('<input type="hidden" name="aanwezig_patient" value="0" />');
  }
  else if (!isPatientPsy($patientInfo['type'])) {

?>

      <div class="inputItem" id="IIAanwezig" >

         <div class="label220">Wie is er aanwezig op het overleg? <div class="reqfield">*</div></div>

         <div class="waardex"><table><tr>

            <td><input type="radio" name="aanwezig_patient" value="1" <?= $aanwezig ?>  /></td>

            <td>Pati&euml;nt zelf</td></tr><tr>

            <td><input type="radio" name="aanwezig_patient" value="2" <?= $vertegenwoordigd ?>  /></td>

            <td>Vertegenwoordig(st)er        <br />

            <select name="vertegenwoordiger">

               <option value="-1"> -- selecteer mantelzorger --</option>

<?php

      // vertegenwoordiger te kiezen uit de mantelzorgers

      if (!(isset($tabel))) {

        $tabel = "huidige";

      }

      if (!(isset($voorwaarde))) {

        $voorwaarde = " bl.patient_code='{$_SESSION['pat_code']}' ";

      }

      $queryMZ = "

         SELECT

                m.naam as naam,

                m.voornaam,

                bl.persoon_id,

                v.naam as verwantschap_naam

            FROM

                {$tabel}_betrokkenen bl,

                mantelzorgers m,

                verwantschap v

            WHERE
                bl.overleggenre = 'gewoon' AND
                bl.persoon_id = m.id AND

                bl.genre = 'mantel' AND

                v.id = m.verwsch_id AND

                $voorwaarde

            ORDER BY

                v.rangorde,m.naam";



      if ($result=mysql_query($queryMZ)) {

         for ($i=0; $i < mysql_num_rows ($result); $i++) {

            $records= mysql_fetch_array($result);

            $veld = $records['naam'] . " " . $records['voornaam'] . " -- " . $records['verwantschap_naam'];

            if ($overlegInfo['vertegenwoordiger'] ==  $records['persoon_id'])

              $selected = "selected=\"selected\"";

            else

              $selected = "";

            print ("<option $selected value=\"{$records['persoon_id']}\">$veld</option>");

         }

      }

    //----------------------------------------------------------

?>

            </select>

            </td></tr><tr>

            <td><input type="radio" name="aanwezig_patient" value="0" <?= $afwezig ?> <?= $defaultChecked ?> /></td>

            <td>Niemand is aanwezig</td></tr></table>

         </div>  

      </div><!--overleg_afwezig-->

<?php

  }
  if (!isPatientPsy($patientInfo['type'])) {
?>

      <div class="inputItem" id="IIAkkoord" style="display:<?= $displayGeenTP ?>;">

         <div class="label220">Instemming met de deelnemers van het overleg. De pati&euml;nt of zijn vertegenwoordiger <div class="reqfield">*</div></div>

         <div class="waardex"><table><tr>

            <td><input type="radio" name="overleg_instemming" value="1" <?= $akkoord ?> <?= $defaultChecked ?> /></td>

            <td>Stemt in</td></tr><tr>

            <td><input type="radio" name="overleg_instemming" value="0" <?= $niet_akkoord ?>/></td>

            <td>Stemt niet in</td></tr></table>

         </div>

      </div><!--instemming-->
      <div class="inputItem" id="IIExtraGegevensOpslaan" style="display:<?= $displayAjaxKnop ?>;">

        <div class="label220">&nbsp;<br />Deze gegevens</div>

        <div class="waarde">&nbsp;<br />

            <input type="button" value="opslaan" name="opslaan"

                   onclick="extraGegevensOpslaan()" />

        </div><!--Button opslaan -->

      </div>
<?php
  }
  else {
?>
      <div class="inputItem" id="IIZiekenhuis">
         <div class="label220" style="position:relative;top:4px;">Is de pati&euml;nt<div class="reqfield">*</div> :</div>
         <div class="waardex">
            <table style="position:relative;top:-14px;">
             <tr>
             <td>
              <input type="radio" name="ambulant" value="ambulant" <?php printChecked($overlegInfo['ambulant'],"ambulant"); ?> /> ambulant<br/>
              <input type="radio" name="ambulant" value="ziekenhuis" <?php printChecked($overlegInfo['ambulant'],"ziekenhuis"); ?> /> opgenomen in een ziekenhuis?</td><br/>
             </td>
             </tr>
             </table>
         </div>
      </div><!--ambulant-->
      <div class="inputItem" id="IIsErEenDokterInDeZaal" style="position:relative;top:-8px;">

         <div class="label220">Huisarts<div class="reqfield">*</div> :</div>

         <div class="waardex" style="position:relative;top:-4px;"><table><tr>

            <td valign="top"><input type="checkbox" name="huisarts_belangrijk" value="1" <?php printChecked($overlegInfo['huisarts_belangrijk'],1); ?> /></td>

            <td>De huisarts wordt uitgenodigd. <br/>Indien de pati&euml;nt geen huisarts heeft,<br/>wordt er een huisarts gezocht.</td></tr><tr> </table>

         </div>

      </div><!--huisarts uitgenodigd-->
      <div class="inputItem" id="IIExtraGegevensOpslaan" style="display:<?= $displayAjaxKnop ?>;">

        <div class="label220">&nbsp;<br />Deze gegevens</div>

        <div class="waarde">&nbsp;<br />

            <input type="button" value="opslaan" name="opslaan"

                   onclick="extraGegevensPsyOpslaan();" />

        </div><!--Button opslaan -->

      </div>

<?php
  }
?>



    </fieldset>



<!-- stond vroeger hier, maar is zo een van die dingen die nogal eens verhuist

    <fieldset style="display:<?= $display ?>">

      <div class="inputItem" id="IIKeuzeVergoeding">

         <div class="label280">De vergoeding in het kader van GDT </div>

         <div class="waardex"><table><tr>

            <td><input type="radio" name="vergoeding" value="0" <?= $geen_vergoeding ?> /></td>

            <td>is NIET aangevraagd.</td></tr>

            <td><input type="radio" name="vergoeding" value="1" <?= $vergoeding ?> /></td>

            <td>is aangevraagd.</td></tr><tr>

            <tr><td colspan="2">

              <input type=""button" value=" Maak nieuwe keuze" onclick="kiesVergoeding(false);" />

            </td></tr>

            </table>

         </div>

   </fieldset>

-->

<?php

  if (!issett($overlegID) || $overlegID == -1) {

?>

   <fieldset>

        <div class="label220"></div>

        <div class="waarde">
            <input type="hidden" name="patient_type" value="<?= $patientInfo['type'] ?>" />
            <input type="submit" value="volgende stap" name="submit" onclick="<?= $extraControleTijdigheid ?><?= $ombvraagverplicht ?>" />
        </div><!--Button opslaan -->        

   </fieldset>

<?php

  }

?>

</form>



<?php

  if (($_GET['afronden']==1) || ($_SESSION['actie']=="afronden")) {

?>



<div id="subsidiestatusDiv" style="display:none;">

</div>



<script type="text/javascript">

  var subsidiestatusWordtBerekend = false;

  var subsidieStatus = "<?= $patientInfo['subsidiestatus'] ?>";

  var minimumStatus = "<?= $patientInfo['minimum_subsidiestatus'] ?>";

<?php
  if ($overlegInfo['datum'] < 20100000) {
?>
  toonSubsidiestatus("subsidiestatusDiv", "<?= $patientInfo['code'] ?>",

      "<?= berekenSubsidiestatus($patientInfo['minimum_subsidiestatus'], "{$patientInfo['subsidiestatus']}", "{$patientInfo['code']}", "huidige" , "patient_code", "{$patientInfo['code']}");  ?>");

//phpoproep berekenSubsidiestatus($patientInfo['minimum_subsidiestatus'], "{$patientInfo['subsidiestatus']}", "{$patientInfo['code']}", "huidige" , "patient_code", "{$patientInfo['code']}"); ");

<?php
 }
?>
</script>



<?php

     $checkSubsidiestatus = true;

  }

  else {

     $checkSubsidiestatus = false;

  }

?>