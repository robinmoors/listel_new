<!-- 
redirect from index.html
@param: login, paswoord
-->

<?php

   session_start();
   ob_start();

   $paginanaam="Welkom bij LISTEL vzw";

   require ("../includes/html_html.inc");

   print("\n<head>\n");

   require "../includes/html_head.inc";

   print("\n</head>\n");

   print("<body>\n");

   print("<div align=\"center\">\n");

   print("<div class=\"pagina\">\n");

   require("../includes/header.inc");

   require("../includes/kruimelpad.inc");

   print("\n<div class=\"contents\">\n");

   require("../includes/menu.inc");

   print("\n<div class=\"main\">\n");

   print("<div class=\"mainblock\">\n");



   	$HuidigUur = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));

	





	if (isset($_POST["login"])) // het loginForm werd gebruikt

		{

		

		/*

    $_SESSION = array();

    session_destroy();

    */

    foreach ($_SESSION as $var => $inhoud) {

       unset($_SESSION[$var]);

    }

			$_SESSION["login"]="";

			$_SESSION["paswoord"]="";
			$_SESSION["isOrganisator"]="";
			$_SESSION["organisatie"]="";

			$_SESSION["toegang"]="";

			$_SESSION["groep"]="";

			$_SESSION["profiel"]="";

			$_SESSION["tp_project"]="";

			$_SESSION["bheer_sitnr"]="";



		//---------------------------------------------

		// Toegang tot de site wordt gecontroleerd

		//---------------------------------------------

		//----------------------------------------------------------

  	/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

	  //----------------------------------------------------------



		//---------------------------------------------

		// Haal alle beheerders op die voldoen

		//---------------------------------------------

		$paswoord = sha1($_POST['paswoord']);


function probeerDezeLogin($tabel, $paswoord) {
    global $records, $HuidigUur;
    if ($tabel == "logins") {
      $extraKolommen = "sit_id, overleg_gemeente, tp_project, profiel, 'gevalideerd' as validatiestatus, (profiel <> 'listel' and profiel <> 'caw') as is_organisator, organisatie, ";
    }
    else if ($tabel == "hulpverleners") {
      $extraKolommen = "validatiestatus, is_organisator, organisatie, ";
      $where = " and validatiestatus in ('halfweg','gevalideerd')";
    }
    else {
      $extraKolommen = "validatiestatus, 0 as is_organisator, 0 as organisatie, ";
      $where = " and validatiestatus in ('halfweg','gevalideerd')";
    }

		$query = "
			SELECT
				login,
				paswoord,
				logindatum,
				id,
        $extraKolommen
				voornaam, naam,
				email
			FROM
        $tabel
			WHERE
        actief = 1 AND
				login ='".addslashes(htmlspecialchars($_POST['login']))."' AND
				paswoord ='".$paswoord."'
        $where";
		$result = mysql_query($query) or die(mysql_error());
		//print($query  );
		if (mysql_num_rows($result)<>0 ) // een correcte record gevonden dus beheerder bestaat
		{
       $records= mysql_fetch_array($result);
 	     $result = mysql_query("UPDATE $tabel SET logindatum='$HuidigUur', ipadres='".$_SERVER['REMOTE_ADDR']."' WHERE login ='".addslashes(htmlspecialchars($_POST['login']))."' AND paswoord ='".$paswoord."'") or die ("Coundn't execute query.");
       return true;
    }
    else {
      return false;
    }
}

    $ingelogd = false;
    if (probeerDezeLogin("logins", $paswoord)) {
      $ingelogd = true;
			$_SESSION["profiel"]=$records['profiel'];
			if ($records['profiel']==NULL){
			  $_SESSION["profiel"]="listel";
			}
    }
    else if (probeerDezeLogin("hulpverleners", $paswoord)) {
       $ingelogd = true;
       $_SESSION["profiel"]="hulp";
    }
/*
    else if (probeerDezeLogin("mantelzorgers", $paswoord)) {
       $ingelogd = true;
       $_SESSION["profiel"]="mantel";
    }
    else if (probeerDezeLogin("patient", $paswoord)) {
       $ingelogd = true;
       $_SESSION["profiel"]="patient";
    }
*/
    if ($ingelogd) {
			$_SESSION["login"]=$_POST["login"];
			$_SESSION["paswoord"]=$paswoord;
			if ($records['validatiestatus']=="") $_SESSION["validatieStatus"] = "geenkeuze";
			else $_SESSION["validatieStatus"] = $records['validatiestatus'];
			$_SESSION["isOrganisator"] = $records['is_organisator'];
			$_SESSION["toegang"]="toegestaan";
			$_SESSION["vorigelogindatum"]=date("d/m/Y H:i:s",$records['logindatum']);
			$_SESSION["voornaam"]=$records['voornaam'];
			$_SESSION["naam"]=$records['naam'];
			$_SESSION["bheer_sitnr"]=$records['sit_id'];
			if (isset($records['overleg_gemeente']) && $records['overleg_gemeente'] != "") $_SESSION['overleg_gemeente']=$records['overleg_gemeente'];
			$_SESSION["usersid"]=$records['id'];
      $_SESSION["email"]=$records['email'];
      $_SESSION["tp_project"]=$records['tp_project'];
      $_SESSION["organisatie"]=$records['organisatie'];
			print("<p>Hallo {$_SESSION['voornaam']}</p>");
			print("<script language=\"javascript\">window.location = \"welkom.php\";</script>");
		}
		else // fout inloggegevens dus geen toegang
		{
			print("Toegang geweigerd aan ".$_POST["login"]."<br />
				<script>function redirect(){document.location = \"..\";}setTimeout(\"redirect()\",5000);</script>");
			$_SESSION["login"]="";
			$_SESSION["paswoord"]="";
			$_SESSION["toegang"]="";
			$_SESSION["groep"]="";
			$_SESSION["profiel"]="";
			$_SESSION["tp_project"]="";
			$_SESSION["bheer_sitnr"]="";
			print("Controleer of je login en paswoord correct zijn ingevuld want
				er werden geen overeenkomstige beheerders gevonden in de database");
			}
		}
	else // poging om niet via inlogForm toegang te krijgen weigeren
		{
		if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
			{
			print("<h2>Welkom {$_SESSION['voornaam']}, op het Listel e-zorgplan.</h2>");
			if (strpos($_SESSION['vorigelogindatum'], "01/01/1970") > 0) {
  			print("<p>Ter informatie: uw vorige login was op <strong>{$_SESSION['vorigelogindatum']}</strong><br />
                  Indien dit niet klopt, neem dan onmiddellijk contact op met Listel vzw.</p>");
      }
      if ($_SESSION['profiel']!="bijkomend project") {
        $nieuw = '<li><b><a href="patient_nieuw.php">Nieuwe pati&euml;nten</a> registreren</b></li>';
      }
      if ($_SESSION['profiel']=="listel") {
         echo <<< EINDE
               <p>Deze site maakt het mogelijk om effici&euml;nter de gegevens van
               (vergoedbaar) multidisciplinair overleg en evaluaties rond pati&euml;nten te registreren. U kan hier in grote lijnen volgende dingen doen:</p>
               <ul>
               $nieuw

               <li><b>Een teamoverleg <a href="select_zplan.php?actie=nieuw">voorbereiden</a>, <a href="select_zplan.php?actie=bewerken">bewerken</a>

               of <a href="select_zplan.php?actie=afsluiten">afronden</a></b></li>

               <li><a href="select_zplan.php?a_next_php=fill_evaluatie_01.php"><b>Evaluaties</b></a> bijhouden</li>

               </ul>

               <p>U kan starten door deze basisitems uit het bovenstaand lijstje of uit het menu aan de linkerzijde te kiezen.

               U kan terug op deze pagina belanden door op het logo van LISTEL of &quot;home&quot; in het menu te klikken.</p>

               

EINDE;

      }

      else {

         print("Bekijk hier een heleboel gegevens over alle overleggen.");

      }



      }

		else // inloggegevens nog te controleren

			{

			print("Toegang geweigerd <br />

				<script>function redirect(){document.location = \"..\";}setTimeout(\"redirect()\",5000);</script>");

         print("Controleer of de gegevens correct zijn ingevuld want 

				er werden geen overeenkomstige beheerders gevonden in de database. Probeer eventueel opnieuw.");

         }

      }

      print("</div>\n");

      print("</div>\n");

      print("</div>\n");

      require("../includes/footer.inc");
		//---------------------------------------------------------

		/* Sluit Dbconnectie */ //require('../includes/dbclose.inc');

		//---------------------------------------------------------

      print("</div>\n");

      print("</div>\n");

      print("</body>\n");

      print("</html>\n");

?>

