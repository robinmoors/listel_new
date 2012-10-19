<?php
session_start();
$paginanaam="Teamoverleg plannen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
	{
	//----------------------------------------------------------
	/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
	//----------------------------------------------------------
	//----------------------------------------------------------
	// patient_id maken adhv de datum van het eerste overleg
	$aantal=mysql_num_rows(mysql_query("SELECT * FROM overleg WHERE overleg_pat_nr=".$_SESSION['pat_nr']." AND overleg_type=0"));
	if ($aantal==0) 
		{
		$patient_id=substr($_SESSION['pat_id'],0,6).$_POST['overleg_jj'].$_POST['overleg_mm'].
							$_POST['overleg_dd'].substr($_SESSION['pat_id'],12,7);
		$_SESSION['pat_id']=$patient_id;
		$doequery=mysql_query("UPDATE patienten SET pat_id='".$patient_id."' WHERE pat_nr=".$_SESSION['pat_nr']);
		}
	//----------------------------------------------------------
	// een overlegrecord starten
	$overlegQry="
		INSERT INTO
			overleg
				(overleg_datum,
				overleg_pat_nr,
				overleg_instemming,
				overleg_afwezig,
				overleg_locatie_id)
		VALUES
				(20".$_POST['overleg_jj'].$_POST['overleg_mm'].$_POST['overleg_dd'].",".
				$_SESSION['pat_nr'].",".
				$_POST['overleg_instemming'].",".
				$_POST['overleg_afwezig'].",".
				$_POST['overleg_locatie_id'].")";
		$result=mysql_query($overlegQry);
		$_SESSION['overleg_id']=mysql_insert_id(); 
		 print($overlegQry);// $_SESSION['overleg_id']
	//----------------------------------------------------------
	//----------------------------------------------------------
// een blanco taakfiche aanmaken
		$taakficheQry="
		INSERT INTO
			taakfiche
				(taakf_text,taakf_overleg_id)
		VALUES
				('Taakafspraken',".$_SESSION['overleg_id'].")";
		$result=mysql_query($taakficheQry);
//----------------------------------------------------------

//----------------------------------------------------------
// een blanco KATZ aanmaken
		$passlength = 16;
		$pass = "";
		$i = 0;
		while($i <= $passlength)
   		{
   		$pass .= chr(rand(65,90));
   		$i++;
   		}
		$KatzQry="
		INSERT INTO
			katz
				(katz_totaal,katz_code,katz_overleg_id)
		VALUES
				(0,'".$pass."',".$_SESSION['overleg_id'].")";
		$result=mysql_query($KatzQry);
		$_SESSION['katz_id']=mysql_insert_id();
//----------------------------------------------------------

	
	//---------------------------------------------------------
	print("
			<script>
         		function redirect()
            		{
            		document.location = \"overleg_plannen_doe_katz.php\";
            		}
         		setTimeout(\"redirect()\",0);
			 </script>"); // Redirect to overleg_plannen_doe_katz.php
	//---------------------------------------------------------
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