<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Uittreksels OMB";







if(isset($_GET['a_order']) ){



	$a_order = $_GET['a_order'];



}







if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION["profiel"]=="listel") ){

    

    $_SESSION['pat_code']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";



    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");



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

        <h1>Uittreksels OMB</h1>





        <table class=\"klein\">



            <tr>

                <th><a href=\"lijst_facturen_omb.php?a_order=datum\">Datum</a></th>

                <th>Code</th>

                <th><a href=\"lijst_facturen_omb.php?a_order=naam\">Naam</a></th>

            </tr>

	");







	if( isset($a_order) && ($a_order != "patient_code") ){

	

		$a_order = $a_order.", patient_code";

	

	}



	else{



		$a_order = "datum";



	}





  $query = "select overleg.id, overleg.omb_factuur, patient_code, datum, naam, voornaam from overleg, patient where code = patient_code and afgerond = 1 and (keuze_vergoeding = 0 or keuze_vergoeding = 2 or keuze_vergoeding = -88) and omb_rangorde = 1 order by $a_order";



	//print($query);





    if ($result=mysql_query($query)){

        

        $teller = 0;

        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            $teller++;



			//print_r($records);





            $veldpat_code=($records['patient_code']!="")?					$records['patient_code']:"";

            $veldpat_datum=($records['datum']!="")?						$records['datum']:"";

            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";

            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";



            if ($records['omb_factuur']=="")

              $afdrukinfo = "-- nog niet opgevraagd --";

            else

              $afdrukinfo = "afgedrukt op {$records['omb_factuur']}";



            print("

                <tr>

                    <td>".$veldpat_datum."</td>

                    <td>".$veldpat_code."</td>

                    <td><a target=\"_blank\" href=\"$siteadresPDF/php/print_factuur_omb.php?id=".$records['id']."\">".$veldpat_naam." ".$veldpat_voornaam."</a></td>

                    <td>$afdrukinfo</td>

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