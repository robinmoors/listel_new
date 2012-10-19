<?php

session_start();

// deze structuur komt voor een stuk ook terug in patientoverzicht.php



if (isset($_POST['pat_code']))

  $_SESSION['pat_code'] = $_POST['pat_code'];

if (isset($_GET['code'])) {

   $_SESSION['pat_code'] = $_GET['code'];

}



$paginanaam="Controle {$_SESSION['pat_code']}";





if (!isset($_SESSION['pat_code'])) {

 //---------------------------------------------------------------

/* Open Empty Html */ include('../includes/open_empty_html.inc');

//---------------------------------------------------------------



?>

    Deze pagina is enkel toegankelijk wanneer u een patient geselecteerd hebt.

    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.

    <script type="text/javascript">

     function redirect()

     {

         <?php print("document.location = \"/\";"); ?>

     }

     setTimeout("redirect()",500);



    </script>



<?php

//-----------------------------------------------------------------

/* Close Empty Html */ include('../includes/close_empty_html.inc');

//-----------------------------------------------------------------



}

else if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")&&($_SESSION['profiel']=="listel"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    //----------------------------------------------------------

    $patient = mysql_fetch_array(mysql_query("select * from patient left join patient_tp on (code=patient) where code = '{$_SESSION['pat_code']}'"));

    $patientInfo = $patient;

    $_SESSION['pat_naam'] = $patient['naam'];

    $_SESSION['pat_voornaam'] = $patient['voornaam'];



    //----------------------------------------------------------





    $_SESSION['vanuitPatientOverzicht'] = true;

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

?>

<script language="javascript">
  var rechten = new Array();
  var vergoeding = new Array();
  var startVergoeding = new Array();

  function vertoon(id) {

     var ding = document.getElementById(id);

     if (ding.style.display == "none")

       ding.style.display = "block";

     else

       ding.style.display = "none";

  }





function keurGoed(katz, td, id, overleg) {

  // en dan een Ajax-request

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "katz_keurGoed_ajax.php?id=" + id +

            "&overlegID=" + overleg + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var result = request.responseText;

      var spatie = 0;

      while ((spatie < result.length && result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {

        if (result.length > 3) {

          alert("De goedkeuring is genoteerd.\n" + result.substr(3));

        }

        else {

          alert("De goedkeuring door de inspectie is genoteerd.");

        }

        document.getElementById(td).innerHTML = katz + "+";

      }

    }

  }

  // en nu nog de request uitsturen

  var vraag1 = prompt("Bevestig dat deze katzscore goedgekeurd is door de inspectiediensten.\Typ hiervoor 'ja'.");

  if (vraag1 == "Ja" || vraag1 == "JA" || vraag1 == "ja") {

    request.open("GET", url);

    request.send(null);

  }

}



function updateStatus(status) {

  // komt uit overleg_alles.php, waar dat zin had, maar hier niet meer.

  // daarom direct de functie verlaten.

  return;

}



function veranderStatus(veld, waarde, overleg, overlegDatum) {

  // ajax-functie

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "overleg_verander_status_ajax.php?veld=" + veld + "&waarde=" + waarde +

            "&overlegID=" + overleg + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var result = request.responseText;

      var spatie = 0;

      while ((spatie < result.length && result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;

      result = result.substring(spatie,result.length);



      if (result.substr(0,2) == "KO") {

        alert("Er is iets ambetant misgegaan, nl. " + result);

      }

      else {

        if (veld == "keuze_vergoeding") {

          if (waarde == 1) {
              vergoeding[overleg]=1;
              document.getElementById("keuze_vergoeding"+overleg).innerHTML = "Deelnemers (+ organisator na 1/1/2010) worden <strong>wel</strong> vergoed. <input type=\"button\" value=\"Schrap vergoeding\" onclick=\"veranderStatus('keuze_vergoeding',0," + overleg + "," + overlegDatum + ");\" />";

          }
          else if (waarde == 2) {
              vergoeding[overleg]=1;
              document.getElementById("keuze_vergoeding"+overleg).innerHTML = "Organisator wordt <strong>wel</strong> vergoed. <input type=\"button\" value=\"Schrap vergoeding\" onclick=\"veranderStatus('keuze_vergoeding',0," + overleg + "," + overlegDatum + ");\" />";

          }

          else {
              vergoeding[overleg]=-1;
              document.getElementById("keuze_vergoeding"+overleg).innerHTML = "Overleg wordt <strong>niet</strong> vergoed. <input type=\"button\" value=\"Maak vergoedbaar\" onclick=\"veranderStatus('keuze_vergoeding'," + startVergoeding[overleg] + "," + overleg + "," + overlegDatum + ");\" />";

          }

        }

        else if (veld == "geld_voor_hvl") {

          if (waarde == 0) {

              document.getElementById("geld_voor_hvl"+overleg).innerHTML = "<strong>G&eacute;&eacute;n</strong> geld in de pot. <input type=\"button\" value=\"Plaats geld in de pot\" onclick=\"veranderStatus('geld_voor_hvl',1," + overleg + "," + overlegDatum + ");\" />";

          }

          else {

              document.getElementById("geld_voor_hvl"+overleg).innerHTML = "Er zit <strong>w&eacute;l</strong> geld in de pot. <input type=\"button\" value=\"Schrap geld in de pot\" onclick=\"veranderStatus('geld_voor_hvl',0," + overleg + "," + overlegDatum + ");\" />";

          }

        }

        else if (veld == "controle") {

          document.getElementById("controle"+overleg).innerHTML = "Controle is afgerond.";

          controleerMinimaleSubsidiestatus("<?= $_SESSION['pat_code'] ?>", overleg);  // gedefinieerd in functies.js

          if (document.getElementById('omb'+overleg)) {

            doeOMB(overleg); // toon eventueel een omb-factuur

          }
        }

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}


function doeOMB(overleg) {

  var request = createREQ();

  var rand1 = parseInt(Math.random()*9);

  var rand2 = parseInt(Math.random()*999999);

  var url = "omb_set_vergoedbaarheid_ajax.php?overlegID=" + overleg + "&patient=" + "<?= $_SESSION['pat_code'] ?>" + "&rand" + rand1 + "=" + rand2;



  request.onreadystatechange = function() {

    if (request.readyState == 4) {

      var result = parseInt(request.responseText);

      if (result == 0) {

          document.getElementById("omb"+overleg).innerHTML = "Dit overleg wordt niet vergoed in het kader van OMB.";

      }

      else if (result == 1) {

          document.getElementById("omb"+overleg).innerHTML = "Dit is het eerste OMB-overleg: <a href=\"<?= $siteadresPDF ?>/php/print_factuur_omb.php?id="+overleg+"\">Druk het OMB-uittreksel af.</a>";

      }

      else {

          document.getElementById("omb"+overleg).innerHTML = "Dit is het " + result + "e OMB-overleg. Het kan vergoed worden wanneer er geld overblijft in de pot.";

      }

    }

  }

  // en nu nog de request uitsturen

  request.open("GET", url);

  request.send(null);

}





</script>

<style>

    h4 {font-style:normal;margin: 10px 0 7px 10px;}

    ul.list { margin-left: 35px;}

    

    .even {

      background-color: #DDD;

    }

	

	.lijntjes {

	  border-collapse:collapse;

	  border: 1px solid black;

	}

	.lijntjes td {

	   padding: 2px;

	   border:1px solid black;

	}

</style>

<?

    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

    





//include("../includes/toonSessie.inc");





    $patientHeader =  "<b>".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (".$_SESSION['pat_code'].")</b>";





    print("<h2>Te controleren voor $patientHeader</h2>");

    print("<p>Controleer hieronder alle overleggen rond deze patient.<br />

              Klik op de datum om meer info te krijgen of om die info terug weg te doen.</p>");



  if (isset($_GET['order'])) {

    $order =  $_GET['order'];

    if ($order == "ASC")

      $newOrder = "DESC";

    else

      $newOrder = "ASC";

  }

  else {

    $order = "DESC";

    $newOrder = "ASC";

  }



if (isset($_GET['overleg'])) {

  $qryOverleg="

        SELECT

            *

        FROM

            overleg o

        WHERE

            o.patient_code='".$_SESSION['pat_code']."'

        AND o.id = {$_GET['overleg']}

        ORDER BY

            o.datum $order";

}

else {

  $qryOverleg="

        SELECT

            *

        FROM

            overleg o

        WHERE

            o.patient_code='".$_SESSION['pat_code']."'

        AND controle = 0 AND keuze_vergoeding > 0 AND afgerond = 1

        ORDER BY

            o.datum $order";

}



function zoekNaam($menscode) {

    switch ($menscode['mens_type']) {

        case "oc":

           $qry2 = "select naam, voornaam from logins

                    where id = {$menscode['mens_id']}";

           break;

        case "hvl":

           $qry2 = "select naam, voornaam from hulpverleners

                    where id = {$menscode['mens_id']}";

           break;

        case "mz":

           $qry2 = "select naam, voornaam from mantelzorgers

                    where id = {$menscode['mens_id']}";

           break;

        case "pat":

           $qry2 = "select naam, voornaam from patient

                    where id = {$menscode['mens_id']}";

           break;

    }

    $mens = mysql_fetch_array(mysql_query($qry2));

    return $mens['naam'] . " " . $mens['voornaam'];

}





function toonOverleg($recordsOverleg) {

  $datum=substr($recordsOverleg['datum'],6,2)."/".substr($recordsOverleg['datum'],4,2)."/".substr($recordsOverleg['datum'],0,4);

    $voorwaarde = " overleg_id = {$recordsOverleg['id']} "; // voor het tonen van de juiste deelnemers

    $tabel = "afgeronde";



  if ($recordsOverleg['genre'] == "TP") {

    $overlegType = "<span style='background-color: #FFD780'>Teamoverleg TP </span>";

    if (isEersteOverlegTP_datum($recordsOverleg['datum'])) {

      $overlegType = "<span style='background-color: #FFD780'>Inclusievergadering TP </span>";

    }

    $locatie = $recordsOverleg['locatieTekst'];

  }

  else {

    $overlegType = "Teamoverleg GDT";

    if ($recordsOverleg['locatie']==0) {

      $locatie = " thuis";

    }

    else {

      $locatie = " elders";

    }

  }


  if (isset($recordsOverleg['katz_id'])) {

    $katz = mysql_fetch_array(mysql_query("select * from katz where id = {$recordsOverleg['katz_id']}"));

    $txtKatzScore = $katz['totaal'];

    if ($txtKatzScore < 5) {

      if ($katz['goedkeuring_inspectie']==1) {

        $txtKatzScore .= "+";

        $katzTitle = "title=\"goedgekeurd na inspectie\"";

      }

      else {

        $tdID = "td" .  $recordsOverleg['katz_id'];

        $txtKatzScore .= ""; //" <br /><input type=\"button\" value=\"inspectie\" onClick=\"keurGoed({$txtKatzScore},'$tdID',{$katz['id']}, {$recordsOverleg['id']});\" />";

        $katzTitle = " id = \"$tdID\"";

      }

    }

    $infoKatz = "<a target=\"_blank\" href=\"katz_invullen.php?bekijk=1&katzID={$recordsOverleg['katz_id']}\">$txtKatzScore</a>";

  }

  else {

    $txtKatzScore = "";

    $infoKatz = "";

  }

  $divID = "overleg{$recordsOverleg['id']}";

  $printActie = "<a target=\"_blank\" href=\"print_overleg.php?id={$recordsOverleg['id']}&datum=$datum\">print</a>";





  print ("<tr>

          <td><strong>$overlegType</strong>$locatie</td>

          <td><a href=\"#\" onClick=\"vertoon('$divID');\">".$datum."</a></td>

          <td $katzTitle>$txtKatzScore</td>

          <td>$printActie</td>

          </tr>");

  if ($_GET['overleg']== $recordsOverleg['id']) {

    $display="block";

  }

  else {

    $display="none";

  }



echo <<< EINDE

              <tr ><td colspan="6"><div style="margin: 3px; border:1px solid #DDD;display:$display" id="$divID">



EINDE;

   $overlegInfo = $recordsOverleg;

   $overlegID = $recordsOverleg['id'];

   $aanpassenBijAfgerond = true;

   $extraParameterSelectPersonen = "?overleg=$overlegID";

   $extraParameterSelectPersonen2 = "&overleg=$overlegID";

   $baseURL = "controle.php?pat_code={$_SESSION['pat_code']}&overleg={$_GET['overleg']}";

   $rechtenFunctie = "Afgerond($overlegID,";
   $rechtenArray = "afgerond_{$overlegID}";

   require("../includes/deelnemers_ophalen_ajax.php");

   if ($recordsOverleg['geld_voor_hvl'] == 1) {

       $geldVoorHVLTekst1 = "Er zit geld in de pot.";

       $geldVoorHVLTekst2 = "Schrap geld in de pot";

       $geldVoorHVLWaarde = 0;

   }

   else {

       $geldVoorHVLTekst1 = "G&eacute;&eacute;n geld in de pot.";

       $geldVoorHVLTekst2 = "Plaats geld in de pot";

       $geldVoorHVLWaarde = 1;

   }

   if ($recordsOverleg['genre']=="TP") {

     $tonen =  " style='display:none;' ";

   }



  if ($recordsOverleg['keuze_vergoeding']==1) {
      if ($recordsOverleg['genre'] == "TP") {
echo <<< EINDE
   <div id="keuze_vergoeding{$recordsOverleg['id']}" >
         Overleg TP wordt vergoed. <input type="button" value="Schrap vergoeding" onclick="veranderStatus('keuze_vergoeding',0,{$recordsOverleg['id']},{$recordsOverleg['datum']});" />
   </div>
EINDE;
      }
      else {
echo <<< EINDE
   <div id="keuze_vergoeding{$recordsOverleg['id']}" >
         Overleg (deelnemers + organisator na 1/1/2010) wordt vergoed. <input type="button" value="Schrap vergoeding" onclick="veranderStatus('keuze_vergoeding',0,{$recordsOverleg['id']},{$recordsOverleg['datum']});" />
   </div>
EINDE;
      }
   }

else if ($recordsOverleg['keuze_vergoeding']==2) {

echo <<< EINDE

   <div id="keuze_vergoeding{$recordsOverleg['id']}" >

         Organisator wordt vergoed. <input type="button" value="Schrap vergoeding" onclick="veranderStatus('keuze_vergoeding',0,{$recordsOverleg['id']},{$recordsOverleg['datum']});" />

   </div>

EINDE;

   }

else {
  $potentieleVergoeding = potentieleVergoeding($recordsOverleg['id']);

echo <<< EINDE

   <div id="keuze_vergoeding{$recordsOverleg['id']}" >

         Overleg wordt <strong>niet</strong> vergoed. <input type="button" value="Maak vergoedbaar" onclick="veranderStatus('keuze_vergoeding',$potentieleVergoeding,{$recordsOverleg['id']},{$recordsOverleg['datum']});" />

   </div>

EINDE;

   }

echo <<< EINDE

   <div id="geld_voor_hvl{$recordsOverleg['id']}" $tonen>

         $geldVoorHVLTekst1 <input type="button" value="$geldVoorHVLTekst2" onclick="veranderStatus('geld_voor_hvl',$geldVoorHVLWaarde,{$recordsOverleg['id']},{$recordsOverleg['datum']});" />

   </div>

EINDE;

  if ($recordsOverleg['omb_id']>0) {

echo <<< EINDE

   <div id="omb{$recordsOverleg['id']}" >

     Dit is een overleg met OMB-registratie. <br/>Afhankelijk van de deelnemers kan je hier straks een factuur vinden.

   </div>

EINDE;

  }

echo <<< EINDE

   <div id="controle{$recordsOverleg['id']}" >

      <input type="button" value="Rond de controle af" onclick="veranderStatus('controle',1,{$recordsOverleg['id']},{$recordsOverleg['datum']});" />

   </div>

EINDE;



   print("</div></td></tr>");





}









   print("<table width=\"100%\"><tr>

                    <th>Type</th>

                    <th><a href=\"patientoverzicht.php?pat_code={$_SESSION['pat_code']}&order=$newOrder\">Datum</a></th>

                    <th>Katz</th>

                    <th>Vergoeding</th>

                    <th>&nbsp;</th>

                    </tr>");

   if ($resultOverleg=mysql_query($qryOverleg)) {

     $aantalOverleg = mysql_num_rows($resultOverleg);

     for ($ii=0; $ii < $aantalOverleg; $ii++) {

       $huidigOverleg = mysql_fetch_assoc($resultOverleg);
       if ($huidigOverleg['keuze_vergoeding']=="")
         $keuzeVergoedingVoorDitOverleg = -100;
       else
         $keuzeVergoedingVoorDitOverleg = $huidigOverleg['keuze_vergoeding'];

       $potentieleVergoeding = potentieleVergoeding($huidigOverleg['id']);

       print("<script type=\"text/javascript\">
                 startVergoeding[{$huidigOverleg['id']}]=$potentieleVergoeding;
                 vergoeding[{$huidigOverleg['id']}]=$keuzeVergoedingVoorDitOverleg;
              </script>");
       toonOverleg($huidigOverleg);

     }

     print("</table>");

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

  toonSubsidiestatus("subsidiestatusDiv", "{$patientInfo['code']}",

    "<?= berekenSubsidiestatus($patientInfo['minimum_subsidiestatus'], "{$patientInfo['subsidiestatus']}", "{$patientInfo['code']}", "afgeronde" , "overleg_id", "{$huidigOverleg['id']}");  ?>");

//  berekenSubsidiestatus("subsidiestatusDiv", "<?= $patientInfo['code'] ?>", "afgeronde" , "overleg_id", "<?= $huidigOverleg['id'] ?>", 1);

<?php
  }
?>
</script>



<?php

       $checkSubsidiestatus = true;

    }

    else {

      print("$qryOverleg is fout gegaan!");

    }



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------





?>