<?php

session_start();



if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")))  {

	echo "Ongeldige bewerking";

	exit;

}

// verwacht variabele $_GET['refID'] en $_GET['overlegID'];  of $_GET['id']

// voor resp. het toevoegen of het aanpassen



if (isset($_POST['retour'])) {

  $retour = $_POST['retour'];

  $retourText = $_POST['retourText'];

}

else if (substr($_GET['refID'], 0, 7) == "overleg") {

  $retour = "overleg_alles.php?tab=Taakfiches";

  $retourText = "overleg";

}

else {

  $retour = "fill_evaluatie_01.php?id=" . substr($_GET['refID'],9);

  $retourText = "evaluatie";

}



//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------



	include("../includes/html_html.inc");

	print("<head>");

	include("../includes/html_head.inc");
?>
<style type="text/css">
  h4 {padding-left: 8px;}
</style>
<?php
	print("</head>");

	print("<body>");

	print("<div align=\"center\">");

	print("<div class=\"pagina\">");

	include("../includes/header.inc");

?>

<style>

  h4 {margin: 6px 0 2px -7px;}

</style>

<?

	include("../includes/pat_id.inc");

	print("<div class=\"contents\">");

	include("../includes/menu.inc");

	print("<div class=\"main\">");

	print("<div class=\"mainblock\">");

	 

  if (isset($_GET['wis']) && $_GET['wis'] == 1 ) {

    mysql_query("delete from taakfiche where id = {$_GET['id']}");



    print("<div>De taakfiche is gewist.<br />&nbsp;<br />");

    if ($_SESSION['vanuitPatientOverzicht'])

			print("<a href=\"patientoverzicht.php?pat_nr=" . $_SESSION['pat_nr'] . "\">Keer terug naar het zorgplan zonder taakfiche op te slaan.</a>");

		else if ($_POST['nogeen']==0)

			print("<a href=\"$retour\">Keer terug naar $retourText zonder taakfiche op te slaan.</a>");

    print("<br />&nbsp;</div>");

  }

	else if (!isset($_POST['action']) || $_POST['nogeen']==1)

		//---------------------------------------------------------------

		// Toon formulier

		{



  $overlegID = $_GET['overlegID'];

  // van ofwel het huidige overleg, ofwel het vorige overleg bij een evaluatie

  $overleg = mysql_fetch_array(mysql_query("select * from overleg where id = $overlegID"));

  //include("../includes/toonSessie.inc");





	function getVerantwoordelijken($taakficheID) {

	global $overleg;

	

	

	$mensen = array();

	



	//

	// Patient zelf

	// --------------

  $qry =  "SELECT DISTINCT id as pat_nr, naam as pat_naam, voornaam as pat_voornaam,mens_id

						FROM patient LEFT JOIN taakfiche_mensen

						ON (mens_id = id AND mens_type = 'pat' AND taakfiche_id = '" . $taakficheID . "' )

            WHERE code = '" . $_SESSION['pat_code'] . "' ";

	$res = mysql_query($qry);





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

	 if ($overleg['afgerond'] == 1) $tabel = "afgeronde"; else $tabel  = "huidige";

	 // bij evaluaties kijken we naar de toestand van het vorige overleg

   if ($tabel == "huidige" || (strpos($_GET['refID'],"valuatie")==1)) {
      $voorwaarde = "bl.patient_code = '{$_SESSION['pat_code']}'";
      $tabel = "huidige";
   }
   else
      $voorwaarde = "bl.overleg_id = {$_GET['overlegID']}";



   $qry = "SELECT DISTINCT hvl.id as hvl_id, hvl.naam as hvl_naam, hvl.voornaam as hvl_voornaam,mens_id

                       FROM {$tabel}_betrokkenen bl,functies f, hulpverleners as hvl LEFT JOIN taakfiche_mensen

                       ON (mens_id = hvl.id AND mens_type = 'hvl' AND taakfiche_id = '" . $taakficheID . "'  )

                       WHERE overleggenre = 'gewoon' and $voorwaarde AND hvl.id = bl.persoon_id

                             AND bl.genre = 'hulp' and f.id = hvl.fnct_id

                       ORDER BY f.rangorde, bl.id";

   $res = mysql_query($qry);


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

  $res = mysql_query("SELECT DISTINCT mzorg.id, mzorg.naam, mzorg.voornaam,mens_id

                      FROM {$tabel}_betrokkenen bl,verwantschap v,mantelzorgers mzorg LEFT JOIN taakfiche_mensen

                      ON (mens_id = mzorg.id AND mens_type = 'mz' AND taakfiche_id = '" . $taakficheID . "' )

                      WHERE overleggenre = 'gewoon' and $voorwaarde

                      AND mzorg.id = bl.persoon_id AND bl.genre = 'mantel'

                      and v.id = mzorg.verwsch_id

                      ORDER BY v.rangorde, mzorg.naam");

	if (mysql_num_rows($res))

		$mensen[] = '<h4>Mantelzorger(s)</h4>';

	while ($mz = mysql_fetch_object($res)) {

		$s  = '';

		if (!is_null($mz->mens_id))

			$s = ' checked="checked"';

			

		$mensen[] = '<input type="checkbox" name="mensen[' . $taak . '][mz][]" id="mz_' . $taak . '_' . $mz->id . '" value="' . $mz->id . '"' . $s . ' /><label for="mz_' . $taak . '_' . $mz->id . '">' . $mz->naam . ' ' . $mz->voornaam . '</label><br />';

	}

	

	// -----------------

	// Overlegcoordinator

	// -----------------

  /*
	$qry = "SELECT DISTINCT logins.id as overlcrd_id, naam as overlcrd_naam, voornaam as overlcrd_voornaam,mens_id

                        FROM overleg,logins LEFT JOIN taakfiche_mensen

                        ON (mens_id = logins.id AND mens_type = 'oc' AND taakfiche_mensen.taakfiche_id = '" . $taakficheID . "'  )

                        WHERE profiel = 'OC' and overleg.id = {$overleg['id']} AND logins.id = coordinator_id ";
  */
	$qry = "SELECT * from taakfiche_mensen
          where mens_type = 'oc' AND taakfiche_id = 0" . $taakficheID;

  //print($qry);

  $res = mysql_query($qry) or die(mysql_error());





	if (mysql_num_rows($res)>0)
	  $s = ' checked="checked"';
  else
		$s  = '';

			
		$mensen[] = '<h4>Overlegco&ouml;rdinator</h4>';
    $organisator = organisatorVanOverleg($overleg);
    
    $mensen[] = '<input type="checkbox" name="mensen[' . $taak . '][oc][]" id="oc_' . $taak . '_1111111" value="1111111"' . $s . ' /><label for="oc_' . $taak . '_1111111">' . $organisator .'</label><br />';

	

	return implode("\n",$mensen);	

	

	}

	function getTaakFiche($taakficheID) {

	

	 // haal teksten op

	 $res = mysql_query("SELECT *

							FROM taakfiche WHERE id = $taakficheID");

	 $obj = mysql_fetch_array($res);

	 

	 return $obj;

	}

	if (isset($_GET['id']))	{

     $taakfiche = getTaakFiche($_GET['id']);

     $taak = $taakfiche['taak'];

     $frequentie = $taakfiche['frequentie'];

     $categorie = $taakfiche['categorie'];

     $introTekst = "Bewerk deze taakfiche van ";

  }

  else {

     $taak = $frequentie = "";

     $introTekst = "Voeg een taakfiche toe voor ";

  }

  if (isset($readOnly)) {

    $introTekst = "Bekijk een taakfiche van ";

  }



  ?>

  

  

<h2 style="text-align: left"><strong><?= $introTekst ?>

<?php echo $_SESSION['pat_naam'] . " " . $_SESSION['pat_voornaam'] . " (" . $_SESSION['pat_code'] ?>

)</strong></h2>

<p>
De taakfiches zijn een werkdocument dat valt onder het beroepsgeheim. Het kan niet doorgegeven worden aan anderen
zonder de uitdrukkelijke toestemming van de overlegco&ouml;rdinator thuisgezondheidszorg.
</p>

<form action="taakfiche_bewerken.php?overlegID=<?= $_GET['overlegID'] ?>&refID=<?= $_GET['refID'] ?>" method="post" name="f" >

	<table>

	  <tr >

	   <td valign="top">

       <h3>Domein</h3>

	   </td>

	   <td >

      <select name="categorie">

        <option <?php if($categorie == 'Verzorging') print("selected=\"selected\""); ?> >Verzorging</option>

		    <option <?php if($categorie == 'Mobiliteit') print("selected=\"selected\""); ?> >Mobiliteit</option>

		    <option <?php if($categorie == 'Huishouden') print("selected=\"selected\""); ?> >Huishouden</option>

		    <option <?php if($categorie == 'Toezicht') print("selected=\"selected\""); ?> >Toezicht</option>

		    <option <?php if($categorie == 'Sociaal leven') print("selected=\"selected\""); ?> >Sociaal leven</option>

		    <option <?php if($categorie == 'Financieel') print("selected=\"selected\""); ?> >Financieel</option>

		    <option <?php if($categorie == 'Hulpmiddelen') print("selected=\"selected\""); ?> >Hulpmiddelen</option>

		    <option <?php if($categorie == 'Andere') print("selected=\"selected\""); ?> >Andere</option>

      </select>

	   </td>

	  </tr>

	  <tr >

       <td valign="top">

         <h3>Taakafspraak</h3>

       </td>

       <td>

       		<textarea style="border: 1px solid black;font-family: Arial, Helvetica, sans-serif;font-size:12px"

                    rows="4" wrap="soft" cols="60" name="tekst"><?php print($taak);?></textarea>

       </td>

	  </tr>

	  <tr >

       <td valign="top">

         <h3>Frequentie<br />van de zorg</h3>

       </td>

       <td>

       		<input type="text" size="54" maxlength="80" name="frequentie" value="<?php print($frequentie);?>" />

       </td>

	  </tr>

	  <tr >

      <td valign="top">

        	<h3>Betrokkenen</h3>

      </td>

      <td>

    		<?php echo getVerantwoordelijken($_GET['id']); ?>

      </td>

	  </tr>

	</table>

<?php

	if (isset($_GET['id']))

    print("<input type=\"hidden\" name=\"id\" value=\"{$_GET['id']}\" />\n");

    print("<input type=\"hidden\" name=\"refID\" value=\"{$_GET['refID']}\" />\n");

    print("<input type=\"hidden\" name=\"overlegID\" value=\"{$_GET['overlegID']}\" />\n");





  if (!isset($readOnly)) {

?>

	<fieldset>

		<div class="inputItem" id="IIButton">

			<div class="label220">Deze gegevens</div>

			<div class="waarde">

        <input type="hidden" name="nogeen"  value="0" />

        <input type="hidden" name="retour" value="<?= $retour ?>" />

        <input type="hidden" name="retourText" value="<?= $retourText ?>" />

				<input type="submit" value="Opslaan en terug naar <?= $retourText ?>" name="action"

              onClick="document.f.nogeen.value = 0;" />

				<input type="submit" value="Opslaan en nog een taakfiche maken" name="action"

              onClick="document.f.nogeen.value = 1;" />

			</div>

		</div><!--action-->

	</fieldset>

</form>

<!-- Einde Formulier -->



<div>

<br />

<?php

    if ($_SESSION['vanuitPatientOverzicht'])

			print("<a href=\"patientoverzicht.php?pat_nr=" . $_SESSION['pat_nr'] . "\">Keer terug naar het zorgenplan zonder taakfiche op te slaan.</a>");

		else if ($_POST['nogeen']==0 || isset($_POST['nogeen']))

			print("<a href=\"$retour\">Keer terug naar $retourText zonder taakfiche op te slaan.</a>");



?>

<br />&nbsp;

</div>

<?php

    }

  }

  if (isset($_POST['action'])) // er is een actie: dus updaten of toevoegen!

		{

		if (isset($_POST['id']))  {

      // id van taakfiche bestaat, dus updaten

  		$qry="

	  		UPDATE taakfiche

		  	SET

			  	categorie ='".$_POST['categorie']."',

				  taak='".$_POST['tekst']."',

				  frequentie = '{$_POST['frequentie']}'

			  WHERE

				  id={$_POST['id']}";

	  	$doeQry=mysql_query($qry);

      $taakficheID = $_POST['id'];

    }

    else {

      // refID bestaat, dus nieuwe maken

  		$qry="

	  		insert into taakfiche (ref_id, categorie, taak, frequentie)

        values (\"{$_POST['refID']}\", \"{$_POST['categorie']}\",\"{$_POST['tekst']}\",\"{$_POST['frequentie']}\")";

  		$doeQry=mysql_query($qry);

      $taakficheID = mysql_insert_id();

    }

		

		//die($qry);



		// yse - update taakfiches_mensen - eerst alle records verwijderen, daarna toevoegen

		

		if (isset($_POST['id']))  {

  		mysql_query("DELETE FROM taakfiche_mensen WHERE taakfiche_id = {$_POST['id']}");

  }



		foreach ($_POST['mensen'] as $taak => $array) {

			foreach ($array as $mens_type => $mensen) {

				foreach ($mensen as $mens => $mens_id) {

				mysql_query("INSERT INTO taakfiche_mensen SET mens_id = '" . $mens_id . "', mens_type = '" . $mens_type . "', 

						taakfiche_id = $taakficheID");

				}

			}

		}

		

		//---------------------------------------------------------------

		// Redirect back to overleg.php

		if ($_SESSION['vanuitPatientOverzicht'])

			print("<script type=\"text/javascript\">document.location=\"patientoverzicht.php?pat_nr=" . $_SESSION['pat_nr'] . "\"</script>");

		else if ($_POST['nogeen']==0)

			print("<script type=\"text/javascript\">document.location=\"{$_POST['retour']}\"</script>");

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





//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>