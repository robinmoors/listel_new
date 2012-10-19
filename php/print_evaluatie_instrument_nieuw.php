<?php

session_start();



//------------------------------------------------------------------------------

//------------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//------------------------------------------------------------







  $evalinstrID = $_POST['id'];


  $values = array();
  $values['vraag'] = array();
  $values['vraag']['v1_1']="gebruik maken van communicatie-apparatuur en -technieken (bv. telefoon)";
  $values['vraag']['v1_2']="zich zelfstandig buitenshuis verplaatsen";
  $values['vraag']['v1_3']="zich zelfstandig verplaatsen (zonder openbaar of priv&eacute; vervoer)";
  $values['vraag']['v1_4']="zorg dragen voor eigen gezondheid op vlak van medicatie";
  $values['vraag']['v1_5']="&nbsp;&nbsp;&nbsp;-	aanschaf medicatie";
  $values['vraag']['v1_6']="&nbsp;&nbsp;&nbsp;-	klaarzetten medicatie";
  $values['vraag']['v1_7']="&nbsp;&nbsp;&nbsp;-	inname medicatie";
  $values['vraag']['v1_8']="zorg dragen voor eigen gezondheid op vlak van voeding";
  $values['vraag']['v1_9']="boodschappen doen";
  $values['vraag']['v1_10']="eenvoudige maaltijden bereiden (voedsel roeren, koken, ..) ";
  $values['vraag']['v1_11']="het huishouden doen:";
  $values['vraag']['v1_12']="&nbsp;&nbsp;&nbsp;-	wassen en drogen kledij";
  $values['vraag']['v1_13']="&nbsp;&nbsp;&nbsp;-	schoonmaken kookruimte en afwas";
  $values['vraag']['v1_14']="&nbsp;&nbsp;&nbsp;-	schoonmaken woonruimte en sanitair";
  $values['vraag']['v1_15']="&nbsp;&nbsp;&nbsp;-	bedienen huishoudelijk apparatuur bv. wasmachine";
  $values['vraag']['v1_16']="&nbsp;&nbsp;&nbsp;-	verwijderen van afval";
  $values['vraag']['v1_17']="eenvoudige financi&euml;le transacties uitvoeren bv. geld gebruiken";
  $values['vraag']['v1_18']="instaan voor eigen administratie";
  $values['vraag']['v1_19']="deelnemen aan activiteiten i.k.v. recreatie en vrije tijd";
  $values['vraag']['v1_20']="zich verplaatsen binnen de woning (doorgang woning)";
  $values['vraag']['v1_21']="de woning is bereikbaar";
  $values['vraag']['v1_22']="de woning is bruikbaar";

  $values['vraag']['v2_1']="transfers uitvoeren in zitpositie";
  $values['vraag']['v2_2']="transfers uitvoeren in ligpositie";
  $values['vraag']['v2_3']="zich binnenshuis verplaatsen";
  $values['vraag']['v2_4']="zich wassen";
  $values['vraag']['v2_5']="zorgdragen voor toiletgang  (urineren, defecatie, menstruatie)";
  $values['vraag']['v2_6']="zich kleden:";
  $values['vraag']['v2_7']="&nbsp;&nbsp;&nbsp;-	aantrekken kleding";
  $values['vraag']['v2_8']="&nbsp;&nbsp;&nbsp;-	uittrekken kleding";
  $values['vraag']['v2_9']="&nbsp;&nbsp;&nbsp;-	aantrekken voetbedekking";
  $values['vraag']['v2_10']="&nbsp;&nbsp;&nbsp;-	uittrekken voetbedekking";
  $values['vraag']['v2_11']="eten  en drinken (naar de mond brengen, in stukken snijden, eetgerei gebruiken,...)";

  $values['vraag']['v3_1']="bewustzijn (mate van bewustzijn en alertheid)";
  $values['vraag']['v3_2']="ori&euml;ntatie (kan zich ori&euml;nteren in tijd, plaats en ruimte )";
  $values['vraag']['v3_3']="geheugen (kan informatie terug vinden)";

  $values['vraag']['v4_1']="zich gedragen volgens de sociale regels in gezelschap";
  $values['vraag']['v4_2']="informele sociale relaties aangaan, onderhouden ";
  $values['vraag']['v4_3']="omgaan met medebewoners";
  $values['vraag']['v4_4']="familiale relaties aangaan, onderhouden";

  $values['vraag']['v5_1']="is de naaste familie betrokken  ";
  $values['vraag']['v5_2']="is de verre familie betrokken (ooms, tantes,..)";
  $values['vraag']['v5_3']="is er contact met vrienden ( evt. buren)";
  $values['vraag']['v5_4']="zijn producten en technologie voor persoonlijk gebruik bij dagelijkse activiteiten aanwezig  (bv. telefoon)";
  $values['vraag']['v5_5']="zijn technische aspecten van de woning aangepast naar de behoefte (bv. bredere deuren , traplift) ";
  $values['vraag']['v5_6']="zijn zorg- en/of hulpverleners vanuit de eerstelijnsgezondheidszorg betrokken";
  $values['vraag']['v5_7']="zijn persoonlijke verzorgers en assistenten ingeschakeld (excl. Familie, vrienden en professionele hulpverlening)";

     $zoekEvalId = abs($evalinstrID);
     $qry = "select * from evalinstr_nieuw where id = $zoekEvalId";
     $resultEval = mysql_query($qry) or die($qry . mysql_error());
     if (mysql_num_rows($resultEval) > 0) {
       $values['keuze'] = mysql_fetch_assoc($resultEval);
     }



  function toonKeuze($index) {
    global $values;

    if ($values['keuze'][$index]==1) $een = " X ";
    if ($values['keuze'][$index]==-1) $minEen = " X ";

    $extraIndex = "extra" . substr($index, 1);

    print("<tr><td>&nbsp; $een &nbsp;</td>
               <td>&nbsp; $minEen &nbsp;</td>
               <td>{$values['vraag'][$index]}</td>
               <td>{$values['keuze'][$extraIndex]}</td>
           </tr>
          ");
  }


   $paginanaam="Evaluatieinstrument";

    if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan"))
      {
      include("../includes/html_html.inc");
      print("<head>");
      include("../includes/html_head.inc");
?>



<style type="text-css">
fieldset {
  min-height: auto;
  overflow:visible;
}

</style>

<?php
      print("</head>");

        if ($_GET['actie']=="print" || $_POST['actie']=="print") {
           print("<body onload=\"parent.print();\">");
        }
        else{print("<body>");}
        if ($_GET['actie'] != "print" && $_POST['actie']!="print") {
          print("<div align=\"center\">");
          print("<div class=\"pagina\">");
          include("../includes/header.inc");
          include("../includes/kruimelpad.inc");
          print("<div class=\"contents\">");
          include("../includes/menu.inc");
          print("<div class=\"main\">");
          print("<div class=\"mainblock\">");
        }


       $dd = substr($_POST['datum'],6,2);
       $mm = substr($_POST['datum'],4,2);
       $jj = substr($_POST['datum'],0,4);


       $patientInfo=mysql_fetch_array(mysql_query("SELECT deelvzw FROM  patient inner join gemeente on gemeente.id = gem_id WHERE code='{$_SESSION['pat_code']}'"));


echo <<< EINDE

                <div style="text-align:center">

                <table width="100%">

                    <tr>

                        <td valign="top"><img src="../images/Sel{$patientInfo['deelvzw']}.jpg" height="100" /></td>

                        <td valign="top">

                            <div style="text-align:center">

                                   <h2>{$_SESSION['pat_naam']} {$_SESSION['pat_voornaam']} ({$_SESSION['pat_code']})</h2>

                                   <h3>Het evaluatie-instrument bij het overleg van $dd/$mm/$jj</h3>

                            </div>

                        </td>

                    </tr>

                </table>

                </div>

EINDE;
?>
<div>
        Ingevuld door: <strong>
<?php
//----------------------------------------------------------
// Vul Input-select-element vanuit dbase met lijst
// betrokken hulpverleners voor deze patient (HVL's)

      $query2 = "
         SELECT
                h.naam as hvl_naam,
                h.voornaam
         FROM
                hulpverleners h
            WHERE
                h.id = {$values['keuze']['uitvoerder_id']}
         ";


      if ($result2=mysql_query($query2))
      {
         for ($i=0; $i < mysql_num_rows ($result2); $i++)
         {
            $records2 = mysql_fetch_assoc($result2);
            print ($records2['hvl_naam']." ".$records2['voornaam']);
        }
     }

     else {

       print("mannekes $query2");

     }

//----------------------------------------------------------
?>
         </strong>
         op
         <?php print($values['keuze']['dd']."/".$values['keuze']['mm']."/".$values['keuze']['jjjj']);?>
</div>

  <div id="Deel1">
  <h2>1. IADL (Instrumentele Activiteiten Dagelijks Leven)</h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>De pati&euml;nt kan</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=22; $i++) {
        toonKeuze("v1_$i");
      }
    ?>
  </table>
  </div>


  <div id="Deel23" >
  <h2>2.	ADL (Activiteiten Dagelijks Leven)  (zie ook KATZ-schaal)</h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>De pati&euml;nt kan</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=11; $i++) {
        toonKeuze("v2_$i");
      }
    ?>
  </table>
  <h2>3.	Functies van het organisme </h2>
  <table>
    <tr>
      <th>+</th>
      <th>-</th>
      <th>De functie is goed(+) of niet goed(-)</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=3; $i++) {
        toonKeuze("v3_$i");
      }
    ?>
  </table>
  </div>

  <div id="Deel45">
  <h2>4.	Functioneren in sociale omgeving </h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>De pati&euml;nt kan</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=4; $i++) {
        toonKeuze("v4_$i");
      }
    ?>
  </table>
  <h2>5.	Externe factoren </h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>&nbsp;</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=7; $i++) {
        toonKeuze("v5_$i");
      }
    ?>
  </table>
  </div>

  <div id="Deel6">
   <fieldset>
      <div class="legende">6.	Aanwezige hulpmiddelen (bv. tillift, gaankader,...)</div>
      <div>&nbsp;</div>
      <div class="waarde">
            <?= $values['keuze']['v6'] ?>
      </div>
      <div>&nbsp;</div>
   </fieldset>
   <fieldset>
      <div class="legende">7.	Tegemoetkomingen </div>
      <div>&nbsp;</div>
      <div class="waarde">
            <?= $values['keuze']['v7'] ?>
      </div>
      <div>&nbsp;</div>
   </fieldset>
   <fieldset>
      <div class="legende">8.	Bijkomende aandachtspunten</div>
      <div>&nbsp;</div>
      <div class="waarde">
            <?= $values['keuze']['v8'] ?>
      </div>
      <div>&nbsp;</div>
   </fieldset>
  </div>


<!-- Einde Formulier -->

<?php

//---------------------------------------------------------

/* Sluit Dbconnectie */ include("../includes/dbclose.inc");

//---------------------------------------------------------

      print("</div>");

      if ($_GET['actie']!="print" && $_POST['actie']!="print") {

      print("</div>");

      print("</div>");

        include("../includes/footer.inc");

        print("</div>");

        print("</div>");

      }

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>