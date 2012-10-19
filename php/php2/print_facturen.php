<?php

session_start();





   require("../includes/dbconnect2.inc");

   initRiziv();

   print("hoeh");



/*********************************************

           rizivtarieven

           thuis        elders                registratie

gewoon     773172       773216                773290

PVS        776532       776554                776576



           niet-        wel-

           ziekenhuis   ziekenhuis            niet-ZH   wel-ZH

TP         427350       427361                427372     427383



**********************************************/





function printMutualiteit($mutualiteit) {

  global $pdf, $mm, $overlegvoorwaarde;



  $rizivListel = "9-47011-97-001";



  $overlegQuery = "select * from overleg where $overlegvoorwaarde ";



  $pdf->ezSetY(210*$mm-15*$mm);



  $options = array('aleft'=>35*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'center');

  $pdf->ezText("<b>BIJLAGE 71</b>",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("Ge&iuml;ntegreerde diensten voor thuisverzorging\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("Factuur voor de verstrekkingen in het kader van de therapeutische projecten\n",11,$options);



  $pdf->ezSetY(210*$mm-30*$mm);

  $options = array('aleft'=>35*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("RIZIV-nr: $rizivListel\n\n\n\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("GDT \"POP LISTEL vzw\"\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("A. Rodenbachstraat 29 bus 1\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("B-3500  HASSELT\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("011/81.94.70\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("Factuurnummer: XXX\n",11,$options);

  $pdf->ezSetDy(-12);



  $pdf->ezSetY(210*$mm-30*$mm);

  $options = array('aleft'=>180*$mm,

                 'aright' => 841.89-35*$mm,

                 'justification' => 'left');

  $pdf->ezText("{$mutualiteit['naam']}\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("{$mutualiteit['dienst']}\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("{$mutualiteit['adres']}\n",11,$options);

  $pdf->ezSetDy(-12);

  $pdf->ezText("{$mutualiteit['dlzip']} {$mutualiteit['dlnaam']}\n",11,$options);

  $pdf->ezSetDy(-12);







  

}



   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && $_SESSION['profiel'] == "listel")

      {







//die($qryPartners);

//mainblock



$mm = 595.28/210;





include('../ezpdf/class.ezpdf.php');



$pdf =& new Cezpdf('A4', 'landscape');

//$pdf->ezSetMargins(0,0,0,0);

$pdf->selectFont('../../ezpdf/fonts/Times-Roman.afm');





/***  straks nog overleggen aanpassen zodat factuurdatum verwijst naar 'deze' factuur ***/

/*** voorlopig dus alle niet gefactureerde TP-overleggen ***/



$overlegvoorwaarde = " ((factuur_datum is NULL or factuur_datum = '') and genre = 'TP') ";



$mutualiteiten =   "select distinct m.naam, m.dienst, m.adres, g.dlzip, g.dlnaam

                    from overleg, patient, verzekering m, gemeente g where $overlegvoorwaarde

                    and overleg.patient_code = patient.code and mut_id = m.id and m.gem_id = g.id";



$resultMutualiteiten = mysql_query($mutualiteiten) or die($mutualiteiten . " wil niet <br/>" . mysql_error());



for ($i=0; $i<mysql_num_rows($resultMutualiteiten); $i++) {

  $rijMutualiteit = mysql_fetch_assoc($resultMutualiteiten);

  printMutualiteit($rijMutualiteit);

  if ($i+1 < mysql_num_rows($resultMutualiteiten)) $pdf->ezNewPage();

}







$pdf->ezStream();



      require("../includes/dbclose.inc");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>