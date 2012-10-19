<?php
session_start();
$paginanaam="Overleg plannen mantelzorger aanpassen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
//----------------------------------------------------------
	{
	//------------------------------------------------------------
	if(isset($a_mzorg_id)&&($a_mzorg_id!="")&&($a_action=="edit"))
		{
		$query="
			SELECT 
			m.mzorg_id,
			m.mzorg_naam,
			m.mzorg_voornaam,
			m.mzorg_verwsch_id,
			m.mzorg_tel,
			m.mzorg_fax,
			m.mzorg_gsm,
			m.mzorg_adres,
			m.mzorg_gem_id,
			m.mzorg_email,
			g.gemte_dlzip,
			g.gemte_dlnaam   
		FROM 
			mantelzorgers m,
			gemeente g
		WHERE 
			m.mzorg_gem_id=g.gemte_id AND
			m.mzorg_id=".$a_mzorg_id;
		if ($result = mysql_query($query))
			{/* Een uitvoerbare Query */     
			if (mysql_num_rows($result)<>0 ) 
				{ 
				//---------------------------------------------
				// een correcte record gevonden
				//---------------------------------------------
				$records= mysql_fetch_array($result);
				$varmzorg_id=$records['mzorg_id'];                  
				$varmzorg_naam=$records['mzorg_naam'];  
				$varmzorg_voornaam=$records['mzorg_voornaam'];  
				$varmzorg_verwsch_id=$records['mzorg_verwsch_id'];  
				$varmzorg_tel=$records['mzorg_tel'];  
				$varmzorg_fax=$records['mzorg_fax'];  
				$varmzorg_gsm=$records['mzorg_gsm'];  
				$varmzorg_adres=$records['mzorg_adres'];  
				$vargemte_dlzip=$records['gemte_dlzip'];  
				$vargemte_dlnaam=$records['gemte_dlnaam'];  
				$varmzorg_email=$records['mzorg_email'];  
				}
			else
				{
				//---------------------------------------------
				// GEEN correcte record gevonden
				//---------------------------------------------
				print("Geen record gevonden om aan te passen");
				}
			}
		else
			{ /* Query niet uitvoerbaar */ }
		} // Gegevens mantelzorger oproepen om aan te passen
	//------------------------------------------------------------

	//----------------------------------------------------------
	print("<script type=\"text/javascript\">");
	$query = "
		SELECT
			gemte_dlzip,gemte_dlnaam,gemte_id
		FROM
			gemeente
      ORDER BY
         gemte_dlzip";
	if ($result=mysql_query($query))
		{
		print ("var gemeenteList = Array(");
		for ($i=0; $i < mysql_num_rows ($result); $i++)
			{
			$records= mysql_fetch_array($result);
			print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");
			}
      print ("\"9999 onbekend\",\"9999\");");
      }
	print("</script>"); // Postcodelijst Opstellen voor javascript
	//----------------------------------------------------------
	include("../includes/html_html.inc");
	print("<head>");
	include("../includes/html_head.inc");
	print("</head>");
	print("<body onload=\"hideCombo('IIPostCodeS')\">");
	print("<div align=\"center\">");
	print("<div class=\"pagina\">");
	include("../includes/header.inc");
	include("../includes/pat_id.inc");
	print("<div class=\"contents\">");
	include("../includes/menu.inc");
	print("<div class=\"main\">");
	print("<div class=\"mainblock\">");
	print("<h1>Overleg plannen</h1>
			<p>Vul onderstaand formulier in met de gegevens van de <b>mantelzorgers(*)</b> 
			die op het overleg aanwezig zullen zijn.</p>");
	if (isset($_POST['update']))
		{
		//----------------------------------------------------------
		if(IsSet($_POST['mzorg_naam'])&&($_POST['mzorg_naam']!="")&&($_SESSION['pat_id']!=""))
			{
			$postcode=(IsSet($_POST['mzorg_gem_id']))?$_POST['mzorg_gem_id']:9999;
      		$query = "
         		UPDATE
         			mantelzorgers
				SET
               		mzorg_naam='"		.$_POST['mzorg_naam']."',
               		mzorg_voornaam='"	.$_POST['mzorg_voornaam']."',
               		mzorg_verwsch_id='"	.$_POST['mzorg_verwsch_id']."',
               		mzorg_tel='"		.$_POST['mzorg_tel']."',
               		mzorg_gsm='"		.$_POST['mzorg_gsm']."',
               		mzorg_adres='"		.$_POST['mzorg_adres']."',
               		mzorg_gem_id="		.$postcode.",
               		mzorg_email='"		.$_POST['mzorg_email']."'
				WHERE
					mzorg_id=".$_POST['mzorg_id'];
      		if ($result=mysql_query($query))  
         		{ // succesvolle toevoeging aan dbase
				$melding="Gegevens van deze mantelzorger werden <b>succesvol bijgewerkt</b>,<br>";
				}
      		else
         		{$melding="Gegevens van deze mantelzorger werden <b>NIET succesvol ingevoegd</b>,<br>".$query;}
     	 	}
   		else
      		{$melding="Er ontbreken gegevens: mzorg_naam of pat_id";}  // Mantelzorger-gegevens updaten
		//----------------------------------------------------------
		
		//----------------------------------------------------------
		print("<script type=\"text/javascript\">document.location=\"overleg_plannen_select_mz.php\"</script>"); // Redirect to add mantelzorger
		//---------------------------------------------------------
		}
	else
		{
		//---------------------------------------------------------------------------
		/* Toon form MZ selecteren */ include('../forms/edit_mz.php');
		//---------------------------------------------------------------------------
		//----------------------------------------------------------
		$query = "
			SELECT
				bl.betrokmz_id,
				m.mzorg_naam,
				m.mzorg_voornaam,
				v.verwsch_naam,
				m.mzorg_id
			FROM
				mantelzorgers m,
				verwantschap v,
         		betroklijstmz bl
			WHERE
				v.verwsch_id=m.mzorg_verwsch_id AND
				bl.betrokmz_mz_id=m.mzorg_id AND
				bl.betrokmz_pat_nr='".$_SESSION['pat_nr']."' AND
				m.mzorg_id<>".$a_mzorg_id."
			ORDER BY
				v.verwsch_rangorde,m.mzorg_naam";
		if ($result=mysql_query($query))
			{
			print ("
				<div align=\"center\">
				<table>
				<tr>
					<th width=\"30\">Nr</th>
					<th width=\"150\">Naam Manterlzorger</th>
					<th width=\"100\">Verwantschap</th>
					<th width=\"100\">Actie</th>
				</tr>");
			for ($i=0; $i < mysql_num_rows ($result); $i++)
				{
				$teller=$i+1;
				$records= mysql_fetch_array($result);
				$veld1=($records[0]!="")?$records[0]:"&nbsp;&nbsp;";
				$veld2=($records[1]!="")?$records[1]:"&nbsp;&nbsp;";
				$veld3=($records[2]!="")?$records[2]:"&nbsp;&nbsp;";
				$veld4=($records[3]!="")?$records[3]:"&nbsp;&nbsp;";
				$veld5=($records[4]!="")?$records[4]:"&nbsp;&nbsp;";
				print ("
					<tr>
					<td valign=top class='tabellen'>".$teller."</td>
					<td valign=top class='tabellen'><a href=\"overleg_plannen_edit_mz.php?a_betrokmz_id=".
					$veld1."&a_action=edit&a_mzorg_id=".$veld5."\">".$veld2." ".$veld3."</td>
					<td valign=top class='tabellen'>".$veld4."</td>
					<td valign=top class='tabellen'><a href=\"overleg_plannen_select_mz.php?a_betrokmz_id=".
					$veld1."&a_action=del&a_mzorg_id=".$veld5."\">wis</a></td></tr>");
				}
			print ("
				</table></div>");
			} // MantelzorgersLijstje weergeven
		//----------------------------------------------------------
		}
	print("&nbsp;<br />&nbsp;<br /><div style=\"text-align:left\">
			<p>(*) Onder <b>mantelzorgers</b> wordt verstaan: familieleden, buren, vrienden, kennissen, ...</p></div>");

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
/* Sluit Dbconnectie */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>
