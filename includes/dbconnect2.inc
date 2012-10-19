<?php

if (!isset($__HTMLINC)) {
  ob_start();
  session_start();
  header('Content-Type: text/html; charset=utf-8' );
}

require('dbgegevens2.inc.php');

$HuidigUur = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));

function probeerLogin($tabel) {
   global $coordinatorID, $LoginDatum, $IPAdres, $HuidigUur, $magAltijd;
   if ($tabel != "logins") $where = " and validatiestatus in ('halfweg','gevalideerd')";
		$query = "
			SELECT
				id,
                                login,
				paswoord,
				logindatum,
				ipadres
			FROM
        $tabel
			WHERE
				login ='".$_SESSION['login']."' AND
				paswoord ='".$_SESSION['paswoord']."'
        $where";

		$result = mysql_query($query) or die(mysql_error());

		if (mysql_num_rows($result)<>0 ) // een correcte record gevonden dus beheerder bestaat
		{
			$records= mysql_fetch_array($result);
      $coordinatorID = $records['id'];
			$IPAdres = $records['ipadres'];
      $LoginDatum = $records['logindatum'];

			// tijd van inactiviteit controleren
			$LoginDatum = $LoginDatum + 1800;
			if ($LoginDatum < $HuidigUur && $LoginDatum >1800){
			    // Te lang inactief geweest
			   	$_SESSION = array();
  				session_destroy();
  				unset($_COOKIE[session_name()]);
    			print("<script>alert('Te lang inactief geweest');function redirect(){document.location = \"..\";}setTimeout(\"redirect()\",0);</script>");
			}
			else if ($IPAdres != $_SERVER['REMOTE_ADDR']){
			    // ander ip-adres
			    $_SESSION = array();
  				session_destroy();
  				unset($_COOKIE[session_name()]);
    			print("<script>alert('Er is een andere gebruiker actief met uw login, raadpleeg onmiddelijk de listel-coordinatoren.');function redirect(){document.location = \"..\";}setTimeout(\"redirect()\",0);</script>");
			}
			else {
			    // Inloggegevens refreshen
			   	$result = mysql_query("UPDATE $tabel SET logindatum='$HuidigUur' WHERE login ='".$_SESSION["login"]."' AND paswoord ='".$_SESSION["paswoord"]."'") or die ("Coundn't execute query.");
			}
      return true;
    }
    else if ($magAltijd) {
      return true;
    }

		else // fout inloggegevens dus geen toegang
  	{
       //print("$query");
      return false;
		}
}

//print_r($_SESSION);



require('../includes/changeActive.php'); // TOEGEVOEGD DOOR ROBIN MARX

//---------------------------------------------

// Maak Dbconnectie

//---------------------------------------------

if (!isset($connectieTeller)) {

  $connectieTeller = 0;

}

if ($connectieTeller == 0) {

  $connectieTeller++;

  $link = mysql_connect("$server", "$user", "$pass");

  if (!$link) die("Fout : Geen connectie met $user op" . $server . " mogelijk");



/*********** FIX voor de rare tekens **********/

mysql_query("SET NAMES 'utf8'");

/*********** FIX voor de rare tekens **********/







  $db = mysql_select_db($dbnaam) ;

  if (!$db) die("Fout : Kan " . $dbnaam . " op " . $server . " niet openen.");

}



  	 		//---------------------------------------------

			// controleer of persoon laatste halfuur actief is geweest

			//---------------------------------------------

			


	

	// inloggegevens controleren (kan niet echt anders als correct zijn)

	if($_SESSION["toegang"]=="toegestaan"){
    if (probeerLogin("logins")) {
       // ingelogd als OC, TP of Listel (oud soort login)
    }
    else if (probeerLogin("hulpverleners")) {
       // ingelogd als hulp
    }
    else if (probeerLogin("mantelzorgers")) {
       // ingelogd als mantel
    }
    else if (probeerLogin("patient")) {
       // ingelogd als mantel
    }
    else if ($magAltijd) {}
    else {
      // geen enkele tabel was ok!
      print("Toegang geweigerd <br />
            	<script>function redirect(){document.location = \"..\";}setTimeout(\"redirect()\",5000);</script>");
 		  print("Controleer of de gegevens correct zijn ingevuld want
 				 je login-gegevens kloppen niet.");
     }
   }


	

require("../includes/tp_functies.inc.php");



// omdat de sessie blijkbaar gemakkelijk vervuilt met project-parameters en zo

// de foute dingen sowieso nog eens wissen

if ($_SESSION['profiel']=="listel" || $_SESSION['profiel']=="OC") {

  $_SESSION["tp_project"] ="";

  unset($_SESSION["tp_project"]);

}

if ($_SESSION['profiel']!="OC") {

  $_SESSION['overleg_gemeente'] ="";

  unset($_SESSION['overleg_gemeente']);

  $_SESSION['bheer_sitnr'] ="";

  unset($_SESSION['bheer_sitnr']);

}



?>