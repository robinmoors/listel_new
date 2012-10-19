<?php



foreach ($_SESSION as $var => $inhoud) {

  switch ($var) {
     case "login":
     case "paswoord":
     case "toegang":
     case "groep":
     case "bheer_sitnr":
	   case "usersid":
	   case "overleg_gemeente":
	   case "vorigelogindatum" :
	   case "voornaam":
	   case "naam":
	   case "email":
	   case "profiel":
	   case "validatieStatus" :
	   case "isOrganisator":
	   case "tp_project" :
	   case "organisatie":
       break;
     default:
       unset($_SESSION[$var]);
  }
}

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



