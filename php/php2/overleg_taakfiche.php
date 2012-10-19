<?php
session_start();
$paginanaam="Evaluatie ingeven";
if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
if (!isset($_SESSION['overleg_id']) && !isset($_GET['overleg_id'])) {
	echo "Ongeldige bewerking";
	exit;
}

if ($_GET['overleg_id'])
	$_SESSION['overleg_id'] = $_GET['overleg_id'];
	



//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
//----------------------------------------------------------
$overleg = mysql_fetch_object(mysql_query("SELECT overleg_type,taakf_id FROM overleg,taakfiche WHERE overleg_id = '" . $_SESSION['overleg_id'] . "' AND taakf_overleg_id = overleg_id"));

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
	 
	if (!isset($_POST['action']))
		//---------------------------------------------------------------
		// Toon formulier
		{
	
?>
<style type="text/css">
		@import "../css/domtab.css";
</style>
<!--[if gt IE 6]>
	<style type="text/css">
		html>body ul.domtabs a:link,
		html>body ul.domtabs a:visited,
		html>body ul.domtabs a:active,
		html>body ul.domtabs a:hover{
			height:3em;
		}
	</style>
<![endif]-->
	<script type="text/javascript" src="../javascript/domtab.js"></script>
	<script type="text/javascript">
		document.write('<style type="text/css">');    
		document.write('div.domtab div{display:none;}<');
		document.write('/s'+'tyle>');    
    </script>
<!-- Start Formulier -->
<?php 

    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/patient_geg.php');
    //----------------------------------------------------------

	//include("../includes/toonSessie.inc");


	function getVerantwoordelijken($taak) {
	global $overleg;
	
	$overlegType = $overleg->overleg_type;
	$overlegID = $_SESSION['overleg_id'];
	
	$taakficheID = $overleg->taakf_id;
	
	
	$mensen = array();
	

	
	/* TAKEN
		verzorging: 1  | mobiliteit: 2 | huishouden: 3 | sociaal: 4  | financien: 5 | diverse: 6
	*/
	
	
	//
	// Patient zelf
	// --------------
	$res = mysql_query("SELECT DISTINCT pat_nr, pat_naam, pat_voornaam,mens_id
						FROM patienten LEFT JOIN taakfiche_mensen 
						ON (mens_id = pat_nr AND mens_type = 'pat' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "' ) WHERE pat_nr = '" . $_SESSION['pat_nr'] . "' ");
					
	if (mysql_num_rows($res))
		$mensen[] = '';
	while ($pat = mysql_fetch_object($res)) {
		$s  = '';
		if (!is_null($pat->mens_id))
			$s = ' checked="checked"';
			
		$mensen[] = '<input type="checkbox" name="mensen[' . $taak . '][pat][]" id="pat_' . $taak . '_' . $pat->pat_nr . '" value="' . $pat->pat_nr . '"' . $s . ' /><label for="pat_' . $taak . '_' . $pat->pat_nr . '">' . $pat->pat_naam . ' ' . $pat->pat_voornaam . '</label><br />';
	}
	
	
	//
	// Hulpverleners
	// --------------
	 if (!$overlegType) {
    $res = mysql_query("SELECT DISTINCT hvl_id, hvl_naam, hvl_voornaam,mens_id
                        FROM betroklijsthvl,hulpverleners LEFT JOIN taakfiche_mensen 
                        ON (mens_id = hvl_id AND mens_type = 'hvl' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "'  ) 
                        WHERE betrokhvl_pat_nr = '" . $_SESSION['pat_nr'] . "' AND hvl_id = betrokhvl_hvl_id  AND betrokhvl_temp = '1' ");
    } else {
        $res = mysql_query("SELECT DISTINCT hvl_id, hvl_naam, hvl_voornaam,mens_id
                        FROM aanweziglijsthvl,hulpverleners LEFT JOIN taakfiche_mensen 
                        ON (mens_id = hvl_id AND mens_type = 'hvl' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "'  ) WHERE aanwhvl_overleg_id = '" . $overlegID . "' AND hvl_id = aanwhvl_hvl_id  ");
   }
   
   
	if (mysql_num_rows($res))
		$mensen[] = '<h4>Zorg en hulpverlener(s)</h4>';
	while ($hvl = mysql_fetch_object($res)) {
		$s  = '';
		if (!is_null($hvl->mens_id))
			$s = ' checked="checked"';
			
		$mensen[] = '<input type="checkbox" name="mensen[' . $taak . '][hvl][]" id="hvl_' . $taak . '_' . $hvl->hvl_id . '" value="' . $hvl->hvl_id . '"' . $s . ' /><label for="hvl_' . $taak . '_' . $hvl->hvl_id . '">' . $hvl->hvl_naam . ' ' . $hvl->hvl_voornaam . '</label><br />';
	}
	
	// -----------------
	// Mantelzorgers
	// -----------------
	 if (!$overlegType) {
        $res = mysql_query("SELECT DISTINCT mzorg_id, mzorg_naam, mzorg_voornaam,mens_id
                        FROM betroklijstmz,mantelzorgers LEFT JOIN taakfiche_mensen 
                        ON (mens_id = mzorg_id AND mens_type = 'mz' AND taak = '" . $taak . "'  AND taakfiche_id = '" . $taakficheID . "' ) WHERE betrokmz_pat_nr = '" . $_SESSION['pat_nr'] . "' AND mzorg_id = betrokmz_mz_id AND betrokmz_temp = '1'"); } else {
            $res = mysql_query("SELECT DISTINCT mzorg_id, mzorg_naam, mzorg_voornaam,mens_id
                        FROM aanweziglijstmz,mantelzorgers LEFT JOIN taakfiche_mensen 
                        ON (mens_id = mzorg_id AND mens_type = 'mz' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "') WHERE aanwmz_overleg_id = '" . $overlegID . "' AND mzorg_id = aanwmz_mz_id");       
    }
	if (mysql_num_rows($res))
		$mensen[] = '<h4>Mantelzorger(s)</h4>';
	while ($mz = mysql_fetch_object($res)) {
		$s  = '';
		if (!is_null($mz->mens_id))
			$s = ' checked="checked"';
			
		$mensen[] = '<input type="checkbox" name="mensen[' . $taak . '][mz][]" id="mz_' . $taak . '_' . $mz->mzorg_id . '" value="' . $mz->mzorg_id . '"' . $s . ' /><label for="mz_' . $taak . '_' . $mz->mzorg_id . '">' . $mz->mzorg_naam . ' ' . $mz->mzorg_voornaam . '</label><br />';
	}
	
	// -----------------
	// Overlegcoordinatoren
	// -----------------
	if (!$overlegType) {
        $res = mysql_query("SELECT DISTINCT overlcrd_id, overlcrd_naam, overlcrd_voornaam,mens_id
                        FROM betroklijstoc,logins LEFT JOIN taakfiche_mensen
                        ON (mens_id = overlcrd_id AND mens_type = 'oc' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "'  ) 
                        WHERE logins.actief = 1 and betrokoc_pat_nr = '" . $_SESSION['pat_nr'] . "' AND overlcrd_id = betrokoc_oc_id ");
    } else {
        $res = mysql_query("SELECT DISTINCT overlcrd_id, overlcrd_naam, overlcrd_voornaam,mens_id
                        FROM aanweziglijstoc,logins LEFT JOIN taakfiche_mensen
                        ON (mens_id = overlcrd_id AND mens_type = 'oc' AND taak = '" . $taak . "' AND taakfiche_id = '" . $taakficheID . "') 
                        WHERE logins.actief = 1 and aanwoc_overleg_id = '" . $overlegID . "' AND overlcrd_id =aanwoc_oc_id ");
    }
	
	if (mysql_num_rows($res))					
		$mensen[] = '<h4>Overlegco&ouml;rdinator</h4>';
	while ($oc = mysql_fetch_object($res)) {
		$s  = '';
		if (!is_null($oc->mens_id))
			$s = ' checked="checked"';
			
		$mensen[] = '<input type="checkbox" name="mensen[' . $taak . '][oc][]" id="oc_' . $taak . '_' . $oc->overlcrd_id . '" value="' . $oc->overlcrd_id . '"' . $s . ' /><label for="oc_' . $taak . '_' . $oc->overlcrd_id . '">' . $oc->overlcrd_naam . ' ' . $oc->overlcrd_voornaam . '</label><br />';
	}
	
	return implode("\n",$mensen);	
	
	}
	function getTaakFiche() {
	
	 $info = array();
	
	 // haal teksten op
	 $res = mysql_query("SELECT taakf_verzorging_text as verzorging,
							taakf_mobiliteit_text as mobiliteit,
							taakf_huishouden_text as huishouden, 
							taakf_sociaal_text as sociaal, 
							taakf_financien_text as financien, 
							taakf_diverse_text as diverse 
							FROM taakfiche WHERE taakf_overleg_id = '" . $_SESSION['overleg_id'] . "'");
	 $obj = mysql_fetch_object($res);
	 
	 return $obj;
	}
	$taakfiche = getTaakFiche(); ?>
<form action="overleg_taakfiche.php" method="post" name="evaluatieInstrForm">
<div class="domtab">
	<ul class="domtabs">
		<li><a href="#t1">Verzorging</a></li>
		<li><a href="#t2">Mobiliteit</a></li>
		<li><a href="#t3">Huishouden</a></li>
		<li><a href="#t4">Sociaal leven</a></li>
		<li><a href="#t5">Financi&euml;n</a></li>
		<li><a href="#t6">Andere</a></li>
	</ul>
	<div>
		<h2><a name="t1" id="t1">Taakfiche Verzorging</a></h2>
		<textarea rows="4" wrap="soft" cols="30" name="taakf_verzorging_text"><?php print($taakfiche->verzorging);?></textarea>
		<!--Verzorging text -->
		<h3>Afspra(a)k(en) tussen</h3>
		<?php echo getVerantwoordelijken(1); ?>
	</div>
	<div>
		<h2><a name="t2" id="t2">Taakfiche Mobiliteit</a></h2>
		<textarea rows="4" wrap="soft" cols="30" name="taakf_mobiliteit_text"><?php print($taakfiche->mobiliteit);?></textarea>
		<h3>Afspra(a)k(en) tussen</h3>
		<?php echo getVerantwoordelijken(2); ?>
	</div>
	<div>
		<h2><a name="t3" id="t3">Taakfiche Huishouden</a></h2>
		<textarea rows="4" wrap="soft" cols="30" name="taakf_huishouden_text"><?php print($taakfiche->huishouden);?></textarea>
		<h3>Afspra(a)k(en) tussen </h3>
		<?php echo getVerantwoordelijken(3); ?>
	</div>
	<div>
		<h2><a name="t4" id="t4">Taakfiche Sociaal leven</a></h2>
		<textarea rows="4" wrap="soft" cols="30" name="taakf_sociaal_text"><?php print($taakfiche->sociaal);?></textarea>
		<h3>Afspra(a)k(en) tussen</h3>
		<?php echo getVerantwoordelijken(4); ?>
	</div>
	<div>
		<h2><a name="t5" id="t5">Taakfiche Financi&euml;n</a></h2>
		<textarea rows="4" wrap="soft" cols="30" name="taakf_financien_text"><?php print($taakfiche->financien);?></textarea>
		<h3>Afspra(a)k(en) tussen</h3>
		<?php echo getVerantwoordelijken(5); ?>
	</div>
	<div>
		<h2><a name="t6" id="t6">Taakfiche Andere</a></h2>
		<textarea rows="4" wrap="soft" cols="30" name="taakf_diverse_text"><?php print($taakfiche->diverse);?></textarea>
		<h3>Afspra(a)k(en) tussen</h3>
		<?php echo getVerantwoordelijken(6); ?>
	</div>
</div>
	<fieldset>
		<div class="inputItem" id="IIButton">
			<div class="label220">Deze gegevens</div>
			<div class="waarde">
				
				<input type="submit" value="Opslaan" name="action" />
			</div> 
		</div><!--action-->
	</fieldset>
</form>
<!-- Einde Formulier -->
<?php
		}
	else
		//---------------------------------------------------------------
		// Opslaan taakfichegegevens: Een taakfiche is uniek aan een overleg
		// en wordt vanaf het eerste moment aangemaakt. Bijgevolg de werkelijke
		// data opslaan wil zeggen een updat van die originele en unieke record.
		// deze record moet wel even terug opgezocht worden.
		{
		$qry="SELECT taakf_id FROM taakfiche WHERE taakf_overleg_id=".$_SESSION['overleg_id'];
		$result=mysql_query($qry);
		$records=mysql_fetch_array($result);
		
		
		$qry="
			UPDATE taakfiche
			SET
				taakf_verzorging_text='".$_POST['taakf_verzorging_text']."',  
				taakf_mobiliteit_text='".$_POST['taakf_mobiliteit_text']."',  
				taakf_huishouden_text='".$_POST['taakf_huishouden_text']."',  
				taakf_sociaal_text='".$_POST['taakf_sociaal_text']."',  
				taakf_financien_text='".$_POST['taakf_financien_text']."',  
				taakf_diverse_text='".$_POST['taakf_diverse_text']."'
			WHERE
				taakf_id=".$records[0];
		//print($qry);
		$doeQry=mysql_query($qry);
		
		// yse - update taakfiches_mensen - eerst alle records verwijderen, daarna toevoegen
		
		mysql_query("DELETE FROM taakfiche_mensen WHERE taakfiche_id = '" . $records[0] . "'");
				
		foreach ($_POST['mensen'] as $taak => $array) {
			foreach ($array as $mens_type => $mensen) {
				foreach ($mensen as $mens => $mens_id) {
				mysql_query("INSERT INTO taakfiche_mensen SET mens_id = '" . $mens_id . "', mens_type = '" . $mens_type . "', 
						taakfiche_id = '" . $records[0] . "', taak = '" . $taak . "'");
				}
			}
		}
		
		//---------------------------------------------------------------
		// Redirect back to overleg.php
		if ($_SESSION['vanuitPatientOverzicht'])
			print("<script type=\"text/javascript\">document.location=\"patientoverzicht.php?pat_nr=" . $_SESSION['pat_nr'] . "\"</script>");
		else
			print("<script type=\"text/javascript\">document.location=\"overleg.php\"</script>");
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