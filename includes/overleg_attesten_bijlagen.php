<div>

<ul>

<?php



$baseURL = $baseURL1 = "overleg_alles.php";



/*************************************************************************************

 * $overlegInfo bevat het overleg waarvan de deelnemers opgehaald moeten worden!!

 *  print_r($overlegInfo);

 *************************************************************************************/
    if ($overlegInfo['keuze_vergoeding']<=0) {
        $displayVerklaringHuisArts = " style=\"display:none;\" ";
        $verklaringHuisArts = "true";
    }
    else {
      if ($overlegInfo['verklaring_huisarts']=="thuis") {
        $checkedThuis = " checked=\"checked\" ";
        $verklaringHuisArts = "true";
      }
      else if ($overlegInfo['verklaring_huisarts']=="opgenomen") {
        $checkedOpgenomen = " checked=\"checked\" ";
        $verklaringHuisArts = "true";
      }
      else {
        $verklaringHuisArts = "false";
      }
    }
?>
<script type="text/javascript">
  var verklaringHuisArtsOK = <?=  $verklaringHuisArts ?>;

  function saveVerklaringHuisArts(antwoord) {
   var request = createREQ();
   var rand1 = parseInt(Math.random()*9);
   var rand2 = parseInt(Math.random()*999999);

<?php
  if (!isset($overlegID)) $overlegID = 0;
?>

   var url = "../php/huisarts_verklaring_opslaan_ajax.php?antwoord=" + antwoord + "&overlegID=" + <?= $overlegID ?>;

   document.getElementById(antwoord).innerHTML = "Saving " + document.getElementById(antwoord).innerHTML;

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
          document.getElementById(antwoord).innerHTML = document.getElementById(antwoord).innerHTML.substr(7);
          verklaringHuisArtsOK = true;
       }
     }
   }

   request.open("GET", url);
   request.send(null);
  }





</script>
<div <?= $displayVerklaringHuisArts ?>>
<li id="verklaringHuisartsAanduiden" >
<p>Duid hier aan wat de huisarts op zijn verklaring ingevuld heeft.
<br/><input type="radio" name="verklaringHuisarts" value="thuis" onclick="saveVerklaringHuisArts('thuis');" <?= $checkedThuis ?>/>
            <span id="thuis">Pati&euml;nt verblijft thuis.</span>
<br/><input type="radio" name="verklaringHuisarts" value="opgenomen" onclick="saveVerklaringHuisArts('opgenomen');" <?= $checkedOpgenomen ?>/>
            <span id="opgenomen">Pati&euml;nt is opgenomen.</span>
</p>

</li>
</div>

<?php
    //-- doe de katz als $katzScore gezet is
    if (issett($overlegInfo['katz_id'])) {
      print("\n<script language=\"javascript\">var katzLeeg = false; </script>\n");
      $queryKatz = "select * from katz where id = {$overlegInfo['katz_id']}";
      if ($katzResult = mysql_query($queryKatz)) $katz = mysql_fetch_array($katzResult);
      else die("dat mag niet. Die katz-query zou juist moeten zijn!");
      $katzScore = $katz['totaal'];
      print("<li><p>Huidige KATZ-score is $katzScore. ");
      if ($katzScore < 5) {
        if ($katz['goedkeuring_inspectie'] == 1) {
          print("\n<br />Dit is goedgekeurd door de inspectie.");
          print("\n<script language=\"javascript\">var katzTeLaag = true;
                        var nogNietGoedgekeurd = false;</script>\n");
        }
        else {
          if ($overlegInfo['datum'] < 20100000) {
            print("\n<br />Hierdoor is dit zorgplan niet meer subsidieerbaar, tenzij de inspectie dit goedkeurt.
                    <script language=\"javascript\">var katzTeLaag = true;  var nogNietGoedgekeurd = true; </script>\n");
          }
        }
      }
      else {
         print("<script language=\"javascript\">var katzTeLaag = false;  var nogNietGoedgekeurd = true; </script>\n");
      }

      /*
      if ($katzScore >= 5) {

         print("voorwaarde voldaan. \n<script language=\"javascript\">var katzTeLaag = false;  var nogNietGoedgekeurd = true; </script>\n");

      } else if ($katz['goedkeuring_inspectie'] == 1) {

         print("in principe te weinig, maar dit is voor vergoeding goedgekeurd door de inspectiediensten.");

         print("\n<script language=\"javascript\">var katzTeLaag = true;

                        var nogNietGoedgekeurd = false;</script>\n");

      }

      else {

         print("voorwaarde in principe <strong>niet</strong> in orde, maar je kan de goedkeuring van de inspectie afwachten. \n

                <script language=\"javascript\">var katzTeLaag = true;  var nogNietGoedgekeurd = true; </script>\n");

      }

      */

      if (isset($readOnly) && $readOnly) {

        print(" <br /> Bekijk de <a href=\"katz_invullen.php?bekijk=1&katzID={$overlegInfo['katz_id']}{$menosParam}\">ingevulde katz-vragenlijst.</a></p></li>");

      }

      else {

        print("<br /> Als je wil, kan je <a href=\"katz_invullen.php?{$menosParam}\">hier (her)berekenen.</a></p></li>");

      }

    }

    else if ($overlegInfo['afgerond']==0) {  // nog niet afgerond

      print("\n<script language=\"javascript\">var katzLeeg = true; var katzTeLaag = true; var nogNietGoedgekeurd = true;</script>\n");

      print("<span id='katzScoreInvullen'><li><p>De KATZ-score is (nog) <b>niet</b> ingevuld. <br />");

      if (!isset($readOnly) || !$readOnly) {

        print("<a href=\"katz_invullen.php?{$menosParam}\">Doe dat hier.</a></p></li>");

      }

      print("</span>");

    }

    else { // afgerond

      print("\n<script language=\"javascript\">var katzLeeg = true; var katzTeLaag = true; var nogNietGoedgekeurd = true;</script>\n");

    }

    // einde katzScore



    // ************************ begin evaluatieinstrument

    if ($overlegInfo['genre']=="TP") {
          print("\n<script language=\"javascript\">var evalInstrLeeg = true; </script>\n");
    }
    else {
       // als het oude evaluatie-instrument is ingevuld
       if ($overlegInfo['evalinstr_id']>0) {
          $vrijblijvend = "";
          print("\n<script language=\"javascript\">var evalInstrLeeg = false; </script>\n");
          if ($overlegInfo['keuze_vergoeding']==1) $vergoedUitleg = " De voorwaarde voor een vergoedbaar overleg in het kader van GDT is voldaan.<br/>";
          if ($overlegInfo['keuze_vergoeding']==2) $vergoedUitleg = " De voorwaarde voor de vergoeding van de organisator is voldaan.<br/>";

          if (isset($readOnly) && $readOnly) {
             $werkwoord2 = "Bekijk";
             $extra = "&evalinstr={$overlegInfo['evalinstr_id']}&overleg_id={$overlegInfo['id']}";
          }
          else {
            $werkwoord2 = "Bewerk";
            $extra = "";
          }

          print("<li><p>Evaluatie-instrument is ingevuld. {$vergoedUitleg} $werkwoord2 <a href=\"ingeven_evaluatie_instr_01.php?action=Aanpassen$extra\">het ingevulde formulier</a>.</p></li>");
       }
       else if ($overlegInfo['eval_nieuw']>0) {
          // het nieuwe is volledig ingevuld
          $vrijblijvend = "";
          print("\n<script language=\"javascript\">var evalInstrLeeg = false; </script>\n");
          if ($overlegInfo['keuze_vergoeding']==1) $vergoedUitleg = " De voorwaarde voor een vergoedbaar overleg in het kader van GDT is voldaan.<br/>";
          if ($overlegInfo['keuze_vergoeding']==2) $vergoedUitleg = " De voorwaarde voor de vergoeding van de organisator is voldaan.<br/>";

          if (isset($readOnly) && $readOnly) {
             $werkwoord2 = "Bekijk";
             $extra = "&eval_nieuw={$overlegInfo['eval_nieuw']}&overleg_id={$overlegInfo['id']}";
          }
          else {
            $werkwoord2 = "Bewerk";
            $extra = "";
          }

          print("<li><p>Evaluatie-instrument is ingevuld. {$vergoedUitleg} $werkwoord2 <a href=\"evaluatie_instrument_nieuw.php?action=Aanpassen$extra\">het ingevulde formulier</a>.</p></li>");
       }
       else if ($overlegInfo['eval_nieuw']<0) {
          // het nieuwe is ingevuld, maar nog niet af
          print("\n<script language=\"javascript\">var evalInstrLeeg = true; </script>\n");
          $nogGeenEval = true;
          if ($_SESSION['actie'] == "afwerken") {
            $werkwoord = "moet";
          }
          else {
            $werkwoord = "kan";
          }
          if ($overlegInfo['keuze_vergoeding']==1) {
            print("<li><p>Het evaluatie-instrument is (nog) <b>niet volledig</b> ingevuld. <br />Dit is een verplichte voorwaarde voor vergoeding in het kader van GDT. <br />");
            $vrijblijvend = "";
          }
          else if ($overlegInfo['keuze_vergoeding']==2) {
            print("<li><p>Het evaluatie-instrument is (nog) <b>niet volledig</b> ingevuld. <br />Dit is een verplichte voorwaarde voor de vergoeding van de organisator. <br />");
            $vrijblijvend = "";
          }
          else if ($overlegInfo['afgerond']==0) { // nog niet afgerond, en (nog) niet gekozen voor vergoeding
            print("<li><p>Het evaluatie-instrument is (nog) niet volledig ingevuld. <br />");
            $vrijblijvend = "<strong>vrijblijvend</strong>";
          }

          if (!isset($readOnly) || !$readOnly) {
            print("Je $werkwoord dat $vrijblijvend <a href=\"evaluatie_instrument_nieuw.php\">hier doen</a>.</p></li>");
          }

          $gdtOK=false;
          $fout .= "Het evaluatie-instrument is nog niet ingevuld.\n";
       }
       else {
          print("\n<script language=\"javascript\">var evalInstrLeeg = true; </script>\n");
          $nogGeenEval = true;
          if ($_SESSION['actie'] == "afwerken") {
            $werkwoord = "moet";
          }
          else {
            $werkwoord = "kan";
          }
          if ($overlegInfo['keuze_vergoeding']==1) {
            print("<li><p>Het evaluatie-instrument is (nog) <b>niet</b> ingevuld. <br />Dit is een verplichte voorwaarde voor vergoeding in het kader van GDT. <br />");
            $vrijblijvend = "";
          }
          else if ($overlegInfo['keuze_vergoeding']==2) {
            print("<li><p>Het evaluatie-instrument is (nog) <b>niet</b> ingevuld. <br />Dit is een verplichte voorwaarde voor de vergoeding van de organisator. <br />");
            $vrijblijvend = "";
          }
          else if ($overlegInfo['afgerond']==0) { // nog niet afgerond, en (nog) niet gekozen voor vergoeding
            print("<li><p>Het evaluatie-instrument is (nog) niet ingevuld. <br />");
            $vrijblijvend = "<strong>vrijblijvend</strong>";
          }

          if (!isset($readOnly) || !$readOnly) {
            print("Je $werkwoord dat $vrijblijvend <a href=\"evaluatie_instrument_nieuw.php\">hier doen</a>.</p></li>");
          }

          $gdtOK=false;
          $fout .= "Het evaluatie-instrument is nog niet ingevuld.\n";
       }

     }

    // ************************ einde evaluatieinstrument





    if ((!isset($readOnly) || !$readOnly)) { // } && (!isset($overlegInfo['evalinstr_id']) ||  !isset($overlegInfo['katz_id']))) {

      print("<span id='katzScoreEmail'>");

      require("../includes/doe_email.php");

      print("</span>");

    }



    if ($overlegInfo['genre']=="TP") {

      require("../includes/doe_email_tp.php");

      print("\n$alleenKatzWanneerHuisartsen\n");









      if (isProject() || $overlegInfo['tp_verslag'] == "" || $overlegInfo['tp_auteur'] == "OC") {

?>

<hr/><br/><li><strong>Verslag</strong> waarvan de gehandtekende versie naar LISTEL vzw gestuurd moet worden.<br/>

    <textarea id="verslag" style="width:460px; font-family: Arial, Verdana, sans-serif;font-size: 11px"><?= $overlegInfo['tp_verslag'] ?></textarea><br />

<?php

  if (!isset($readOnly) ) {

?>

             <input id="verslagopslaan" type="button" value="Verslag opslaan" onclick="this.style.display='none';tpOpslaan('verslag');" />

             <span id="verslagopslaan2" style="display:none;">Verslag aan het opslaan</span></span>

<?php

  }

?>



</li>

<?php

  }

?>



<script type="text/javascript">



function tpOpslaan(item) {

  if (item=='verslag') {

    document.getElementById("verslagopslaan2").style.display="inline";

    document.getElementById("verslagopslaan").style.display="none";

  }

  var request = createREQ();



  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);



  var url = "tp_opslaan_ajax.php";



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

        alert("Het " + item + " in tekstvorm is succesvol opgeslagen.");

        if (item=='verslag') {

          document.getElementById("verslagopslaan").style.display="inline";

          document.getElementById("verslagopslaan2").style.display="none";

        }

      }

    }

  }



  // en nu nog de request uitsturen

  request.open("POST", url);

  request.setRequestHeader('Content-Type','application/x-www-form-urlencoded','charset=UTF-8');

  var urlParams = item + "=" + document.getElementById(item).value +

            "&id=<?= $overlegID ?>&rand" + rand1 + "=" + rand2;



  request.send(urlParams);

}

</script>

<?php

  }



    /********************************  omb-formulier */



    if (($patientInfo['omb_actief']==1) || $ombmogelijk) {

      if (($patientInfo['omb_actief']==1) || $ombintevullen) $zichtbaar = "block";

      else $zichtbaar = "none";



      $bronMeenemen = "&omb_bron={$patientInfo['omb_bron']}&patient={$patientInfo['code']}";



      if ($overlegInfo['omb_id']>0) {

          print("<hr/><li id='ombformulier' style='display:$zichtbaar'>De vragenlijst voor OMB is ingevuld en afgerond. Je kan hem <a href=\"omb_registratie.php?zoekid={$overlegInfo['omb_id']}&terugNaarOverleg=1\">hier bekijken.</a><br/>Vergeet niet om de verklaring bankrekeningnummers naar LISTEL vzw op te sturen indien hierboven staat dat je een vergoeding voor OMB kunt krijgen.</li>");

      }

      else if ($overlegInfo['omb_id']<0) {

          print("<hr/><li id='ombformulier' style='display:$zichtbaar'>De vragenlijst voor OMB is nog niet afgerond. Je kan hem <a href=\"omb_registratie.php?zoekid={$overlegInfo['omb_id']}&terugNaarOverleg=1\">hier verder invullen en afronden.</a></li>");

      }

      else if ($overlegInfo['afgerond']==0) {

          print("<hr/><li id='ombformulier' style='display:$zichtbaar'>De vragenlijst voor OMB is (nog) niet ingevuld. <br/><a href=\"omb_registratie.php?overlegID={$overlegInfo['id']}&terugNaarOverleg=1$bronMeenemen\">Doe dit hier</a> zodat je eventueel kan genieten van de vergoeding OMB.</li>");

      }

    }





require("../includes/overleg_bijlagen.php");

?>

</ul>

</div>