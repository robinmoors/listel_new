<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Controles TP {$_GET['soort']}";







if(isset($_GET['a_order']) && $_GET['a_order']!="" ){



	$a_order = $_GET['a_order'];



}
else {
  $a_order = "datum";
}







if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION["profiel"]=="listel") ){

    

    $_SESSION['pat_code']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";



    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");

?>

<style type="text/css">

  td {font-size:11px;}

</style>



<?php





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



    print ("

        <h1>De nog te controleren overleggen TP {$_GET['soort']}</h1>





        <table class=\"klein\">



            <tr>

                <th><a href=\"lijst_controlesTP.php?a_order=datum&soort={$_GET['soort']}\">Datum</a></th>

                <th>Code</th>
                <th>&nbsp;</th>
                <th><a href=\"lijst_controlesTP.php?a_order=naam&soort={$_GET['soort']}\">Naam</a></th>

                <th>Controle</th>

            </tr>

	");







	if( isset($a_order) && ($a_order != "patient_code") ){

	

		$a_order = $a_order.", patient_code";

	

	}



	else{



		$a_order = "datum";



	}

  if ($_GET['soort']=="ForK") {

     $tpProjectVoorwaarde = " patient_tp.project = $_TP_FOR_K ";

  }

  else {

     $tpProjectVoorwaarde = " NOT(patient_tp.project = $_TP_FOR_K) ";
  }





  $query = "select overleg.id, patient_code, overleg.datum, patient.naam, voornaam, factuur_datum, controle, keuze_vergoeding, omb_id, deelvzw

            from overleg, patient inner join gemeente on patient.gem_id = gemeente.id, patient_tp

            where

              patient.code = patient_tp.patient and $tpProjectVoorwaarde



              and replace(patient_tp.begindatum,'-','') <= overleg.datum

              and (patient_tp.einddatum is null or replace(patient_tp.einddatum,'-','') >= overleg.datum)



              and code = patient_code and afgerond = 1 and controle = 0 and  (overleg.genre = 'TP')

              and (keuze_vergoeding > 0 or (omb_id > 0 and (keuze_vergoeding = 0 or keuze_vergoeding = -88)))

              order by $a_order";



	//print($query);





    if ($result=mysql_query($query) or die(mysql_error() . "<br/>$query ")){

        

        $teller = 0;

        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);
            if ($records['deelvzw']=="") $records['deelvzw']="H";


            $teller++;



			//print_r($records);





            $veldpat_code=($records['patient_code']!="")?					$records['patient_code']:"";

            $veldpat_datum=($records['datum']!="")?						$records['datum']:"";

            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";

            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";



            $mooieDatum = substr($veldpat_datum, 6,2) . "/" . substr($veldpat_datum, 4,2) . "/" . substr($veldpat_datum, 0,4);





            if ($records['controle'] == 1) {

              $controle = "";

            }

            else {

              $controle = "controle";

            }

            $tpNr = tpVisueel($veldpat_code);



            if ($records['keuze_vergoeding']<1) {

              // alleen omb, want als er vergoeding is

              if (ombvergoedbaar($records['id'])) {

              print("

                <tr>

                    <td>".$mooieDatum."</td>

                    <td>".$veldpat_code."</td>
                    <td><strong>{$records['deelvzw']}</strong></td>
                    <td>$veldpat_naam $veldpat_voornaam $tpNr</a></td>

                    <td><a target=\"_blank\" href=\"controle.php?code={$veldpat_code}&overleg=".$records['id']."\">$controle</a> OMB</td>

                </tr>

			");

              }

            }

            else {

              print("

                <tr>

                    <td>".$mooieDatum."</td>

                    <td>".$veldpat_code."</td>
                    <td><strong>{$records['deelvzw']}</strong></td>
                    <td>$veldpat_naam $veldpat_voornaam $tpNr</a></td>

                    <td><a target=\"_blank\" href=\"controle.php?code={$veldpat_code}&overleg=".$records['id']."\">$controle</a></td>

                </tr>

			");

           }



            }

            print("</table>");

        }



    else{

		//print(mysql_error());

        

        Print ("Er werden geen records gevonden");



		print(mysql_error());

    }





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

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>