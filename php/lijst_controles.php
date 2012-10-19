<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Controles";







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

?>
<p>
   <!-- Toon alleen pati&euml;nten uit -->
      <form method="get" style="display:inline;"><input type="hidden" name="deelvzw" value="H"/><input type="submit" value="Alleen Hasselt" /></form>
   of
      <form method="get" style="display:inline;"><input type="hidden" name="deelvzw" value="G"/><input type="submit" value="Alleen Genk" /></form>
   of
      <form method="get" style="display:inline;"><input type="submit" value="Alles" /></form>
</p>
<?php

    print ("

        <h1>De nog te controleren overleggen</h1>





        <table class=\"klein\">



            <tr>

                <th><a href=\"lijst_controles.php?a_order=datum\">Datum</a></th>

                <th>Code</th>
                <th>&nbsp;</th>
                <th><a href=\"lijst_controles.php?a_order=naam\">Naam</a></th>

                <th>Controle</th>

                <th>Factuur</th>

            </tr>

	");







	if( isset($a_order) && ($a_order != "patient_code") ){

	

		$a_order = $a_order.", patient_code";

	

	}



	else{



		$a_order = "datum";



	}



          if ($_GET['deelvzw']=="H") {
            print("<h2>SEL Hasselt</h2>");
            $deelvzw = " and (deelvzw = \"{$_GET['deelvzw']}\" or deelvzw is NULL) ";
          }
          else if ($_GET['deelvzw']=="G")  {
            print("<h2>SEL Genk</h2>");
            $deelvzw = " and deelvzw = \"{$_GET['deelvzw']}\" ";
          }


  $query = "select overleg.id, patient_code, datum, patient.naam, voornaam, factuur_datum, controle , keuze_vergoeding, deelvzw, omb_id

            from overleg, patient inner join gemeente on patient.gem_id = gemeente.id
            where code = patient_code and afgerond = 1 and ((factuur_datum is NULL  and datum >'20070100' and controle <> 1) or controle = 0)
                  $deelvzw
                  and (keuze_vergoeding > 0 or (omb_id > 0 and (keuze_vergoeding=-88 or keuze_vergoeding =0))) and  (overleg.genre = 'gewoon' or overleg.genre is NULL) order by $a_order";



	//print($query);





    if ($result=mysql_query($query) or die("stoemme query: $query")) {

        

        $teller = 0;

        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            $teller++;



			//print_r($records);





            $veldpat_code=($records['patient_code']!="")?					$records['patient_code']:"";

            $veldpat_datum=($records['datum']!="")?						$records['datum']:"";

            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";

            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";



            $mooieDatum = substr($veldpat_datum, 6,2) . "/" . substr($veldpat_datum, 4,2) . "/" . substr($veldpat_datum, 0,4);



            if ($records['factuur_datum'] == "") {

              $factuur = "";

            }

            else {

              $factuur = "oude factuur";

            }

            if ($records['controle'] == 1) {

              $controle = "";

            }

            else {

              $controle = "controle";

            }

            if ($records['keuze_vergoeding']!=1 && $records['omb_id'] > 0) {

               $ombtekst = " (OMB) ";

            }
            else if ($records['keuze_vergoeding']==2) {

               $ombtekst = " (organisator) ";

            }

            else {

               $ombtekst = "";

            }
            if ($records['soort_problematiek']=="psychisch") {

               $ombtekst .= " (psychisch) ";

            }
            
            if ($records['deelvzw']=="") $records['deelvzw']="H";


            print("

                <tr>

                    <td>".$mooieDatum."</td>

                    <td>".$veldpat_code."</td>
                    <td><strong>{$records['deelvzw']}</strong></td>
                    <td>$veldpat_naam $veldpat_voornaam</a></td>

                    <td><a target=\"_blank\" href=\"controle.php?code={$veldpat_code}&overleg=".$records['id']."\">$controle</a></td>

                    <td><a target=\"_blank\" href=\"print_factuur.php?id=".$records['id']."\">$factuur</a>$ombtekst</td>



                </tr>

			");

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