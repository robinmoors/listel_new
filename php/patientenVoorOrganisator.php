<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");
$paginanaam="Lijst Pati&euml;nten voor {$_GET['naam']}";


if(isset($_GET['a_order']) ){
	$a_order = $_GET['a_order'];
}

if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){
    $_SESSION['pat_code']="";
    $_SESSION['pat_naam']="";
    $_SESSION['pat_voornaam']="";

    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
    include("../includes/bevestigdel.inc");
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


    print ("<h1>Lijst Pati&euml;nten voor {$_GET['naam']}</h1>\n");

    print("
        <table class=\"klein\">
            <tr>
                <th><a href=\"patientenVoorOrganisator.php?naam={$_GET['naam']}&a_order=patient.code&soort={$_GET['soort']}&id={$_GET['id']}\">Kenmerk</a></th>
                <th><a href=\"patientenVoorOrganisator.php?naam={$_GET['naam']}&a_order=patient.naam&soort={$_GET['soort']}&id={$_GET['id']}\">Naam</a></th>
            </tr>
	");

    $a_order=(isset($a_order)&&($a_order!="patient.naam"))?$a_order.",patient.naam,patient.voornaam":"patient.naam,patient.voornaam";
    $result = patientenVanOrganisator($_GET['soort'],$_GET['id'],$a_order);

        $teller = 0;
        for ($i=0; $i < mysql_num_rows ($result); $i++){
            $records= mysql_fetch_array($result);
            $teller++;

			//print_r($records);
            $veldpat_code=($records['code']!="")?					$records['code']:"";
            $veldpat_id=($records['id']!="")?						$records['id']:"";
            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";
            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";

            //$veldpat_startdatum=($records['startdatum']!="")?		$records['startdatum']:"";

            $tpCode = tpVisueel($veldpat_code);
            print("          <tr>\n");
            print("
                    <td><a href=\"patientoverzicht.php?pat_code=".$veldpat_code."\">".$veldpat_code."</a>$tpCode</td>
                    <td><a href=\"patient_aanpassen.php?code=".$veldpat_code."\">".$veldpat_naam." ".$veldpat_voornaam."</a></td>
                </tr>
			");
            }
            print("</table>");

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