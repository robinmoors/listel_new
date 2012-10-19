<?php
    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
	//----------------------------------------------------------
	
include("../includes/clearSessie.inc");

$paginanaam="Lijst In- en Exclusies van TP";



if(isset($_GET['a_order']) ){
	$a_order = $_GET['a_order'];
}

if( isset($a_order) && ($a_order != "patient_code") ){
		$a_order = $a_order.", code";
}
else{
		$a_order = "code";
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
        <h1>Inclusiedocumenten</h1>

        <table class=\"klein\">
            <tr>
                <th>Code</th>
                <th><a href=\"lijst_tp_afdrukken.php?a_order=naam\">Naam</a></th>
            </tr>");
  $query = "select patient, naam, voornaam, patient_tp.id as ptpid from patient, patient_tp where code = patient and in_email = 1 and in_print = 0 order by $a_order";
	//print($query);

    if ($result=mysql_query($query)){
        $teller = 0;
        for ($i=0; $i < mysql_num_rows ($result); $i++){
            $records= mysql_fetch_array($result);
            $teller++;
            if (mysql_num_rows ($result) == 0) {
              print("<tr><td>Niks af te drukken.</td></tr>");
            }
			//print_r($records);
            $veldpat_code=($records['patient']!="")?					$records['patient']:"-- code unknown --";
            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";
            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";
            print("
                <tr>
                    <td>".$veldpat_code."</td>
                    <td><a target=\"_blank\" href=\"print_tp_inclusie.php?id={$records['ptpid']}\">".$veldpat_naam." ".$veldpat_voornaam."</a></td>
                </tr>");
            }
            print("</table>");
        }

    else{
		    //print(mysql_error());
        print ("Er werden geen records gevonden");
		print(mysql_error());
    }

    //--------------//

    print ("
        <h1>Exclusiedocumenten</h1>

        <table class=\"klein\">
            <tr>
                <th>Code</th>
                <th><a href=\"lijst_tp_afdrukken.php?a_order=naam\">Naam</a></th>
            </tr>
	");

  $query = "select patient, naam, voornaam, patient_tp.id as ptpid from patient, patient_tp where code = patient and uit_email = 1 and uit_print = 0 order by $a_order";
	//print($query);

    if ($result=mysql_query($query)){
        $teller = 0;
        if (mysql_num_rows ($result) == 0) {
          print("<tr><td>Niks af te drukken.</td></tr>");
        }
        for ($i=0; $i < mysql_num_rows ($result); $i++){
            $records= mysql_fetch_array($result);
            $teller++;
			//print_r($records);
            $veldpat_code=($records['patient']!="")?					$records['patient']:"-- code unknown --";
            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";
            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";
            print("
                <tr>
                    <td>".$veldpat_code."</td>
                    <td><a target=\"_blank\" href=\"print_tp_inclusie.php?exclusie=1&id={$records['ptpid']}\">".$veldpat_naam." ".$veldpat_voornaam."</a></td>
                </tr>");
            }
            print("</table>");
        }

    else{
		    //print(mysql_error());
        print ("Er werden geen records gevonden");
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