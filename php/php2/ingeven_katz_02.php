<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
//----------------------------------------------------------
   session_start();
   $paginanaam="KATZ-score ingeven";
	if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
      {
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
		$katz_qry="
			UPDATE
				katz 
			SET
				katz_wassen='".$_POST['katz_wassen']."',
				katz_kleden='".$_POST['katz_kleden']."',
				katz_verpla='".$_POST['katz_verpla']."',
				katz_toilet='".$_POST['katz_toilet']."',
				katz_continent='".$_POST['katz_continent']."',
				katz_eten='".$_POST['katz_eten']."',
				katz_orient='".$_POST['katz_orient']."',
				katz_rust='".$_POST['katz_rust']."',
				katz_woon='".$_POST['katz_woon']."',
				katz_mantel='".$_POST['katz_mantel']."',
				katz_sanitair='".$_POST['katz_sanitair']."',
				katz_totaal=".$_POST['katz_totaal']."
			WHERE
				katz_overleg_id=".$_SESSION['overleg_id'];
		print(katz_qry);
		$result=mysql_query($katz_qry);
		$qry="
			UPDATE
				overleg
			SET
				overleg_katzscore=".$_POST['katz_totaal']."
			WHERE
				overleg_id=".$_SESSION['overleg_id'];
		$result=mysql_query($qry);
		if ($result=mysql_query($qry))
			{
			// Query werd succesvol uitgevoerd
			//$_SESSION['katz_done']="done";
			print("steven".$katz_qry);
			print("<script>
         			function redirect()
            			{
							document.location=\"lijst_evaluatie.php?a_overleg_id="
							.$_SESSION['overleg_id']."&katz_totaal=".$_POST['katz_totaal']."\"
            			}
         			setTimeout(\"redirect()\",0);
         			</script>");
			}
		else
			{
			/* Query werd NIET succesvol uitgevoerd */
			print("fout".$katz_qry."---".$qry);
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