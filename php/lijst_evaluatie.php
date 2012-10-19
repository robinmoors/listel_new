<?php

	// NOT DONE YET - robin


	//----------------------------------------------------------
	/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
	//----------------------------------------------------------

$paginanaam="Lijst evaluaties met mogelijkheid tot verwijderen!";

if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){
	
	//------------------------------------------------------------------------------------
	/* Haal patientgegevens op basis van pat_nr */ include("../includes/patient_geg.php");
	//------------------------------------------------------------------------------------

	include("../includes/html_html.inc");

	print("<head>");

	include("../includes/html_head.inc");

	print("</head>");
	print("<body>");
	print("<div align=\"center\">");
	print("<div class=\"pagina\">");

	include("../includes/header.inc");
	include("../includes/pat_id.inc");

	print("<div class=\"contents\">");

	include("../includes/menu.inc");

	print("<div class=\"main\">");
	print("<div class=\"mainblock\">");


	if( isset($_GET['overleg_id']) ){
		
		//---------------------------------------------------------------------

		$qry="
			DELETE FROM
				overleg
			WHERE
				overleg_id=".$_GET['overleg_id'];
		$result=mysql_query($qry);

		$qry="
			DELETE FROM
				taakfiche
			WHERE
				taakf_overleg_id=".$_GET['overleg_id'];

		$result=mysql_query($qry);

		$qry="
			DELETE FROM
				katz
			WHERE
				katz_overleg_id=".$_GET['overleg_id'];

		$result = mysql_query($qry); // verwijder overleg met bijhorende taakfiche en katzscore 

		//---------------------------------------------------------------------
	}

	$qry="
		SELECT
			o.datum,
			o.overleg_hvl_id,
			t.taakf_diverse_text,
			o.overleg_katzscore,
			o.overleg_id,
			h.hvl_naam,
			h.hvl_voornaam
		FROM
			overleg o,
			taakfiche t,
			hulpverleners h
		WHERE
			o.overleg_id=t.taakf_overleg_id AND
			o.overleg_pat_nr=".$_SESSION['pat_nr']." AND
			h.hvl_id=o.overleg_hvl_id
		ORDER BY
			o.overleg_datum";


//	print($qry);


	print("<h1>Evaluaties</h1>");
	print("<table width=\"100%\">
		<tr>
			<th></th>
			<th>Datum</th>
			<th>Vorm</th>
			<th>Contact</th>
			<th>Voortgang</th>
			<th>Katz</th>
		</tr>
	");


	if ($result=mysql_query($qry))
		{
		for ($i=0; $i < mysql_num_rows ($result); $i++)
			{
			$records= mysql_fetch_array($result);
			$datum=substr($records['overleg_datum'],6,2)."/".
					substr($records['overleg_datum'],4,2)."/".
					substr($records['overleg_datum'],0,4);
			switch ($records[1]){
				case (0):
					$vorm="T";
					$link="<a href=\"overleg.php?actie=afwerken&alleenGroen&a_overleg_id=".$records['overleg_id']."\">";
					break;
				case (1):
					$vorm="HB";
					$link="<a href=\"fill_evaluatie_01.php?overleg_id=".$records['overleg_id']."\">";
					break;
				case (2):
					$vorm="BB";
					$link="<a href=\"fill_evaluatie_01.php?overleg_id=".$records['overleg_id']."\">";
					break;
				case (3):
					$vorm="TO";
					$link="<a href=\"fill_evaluatie_01.php?overleg_id=".$records['overleg_id']."\">";
					break;}
            print ("<tr>
               <td><a href=\"lijst_evaluatie.php?overleg_id=".$records['overleg_id']."\">Wis</a></td>
               <td>".$link.$datum."</a></td>
               <td>".$vorm."</td>
               <td>".$records['hvl_naam']." ".$records['hvl_voornaam']."</td>
               <td>".$records['taakf_diverse_text']."</td>
               <td>".$records['overleg_katzscore']."</td>
					</tr>");
            }
		}
	print("<tr><td colspan=\"5\"><div align=\"center\"><br />T=team - HB=huisbezoek - BB=bureelbezoek<br />
				TO=telefonisch overleg</div></td></tr>");
	print("</table>");
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