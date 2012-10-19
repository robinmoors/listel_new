<?php

session_start();


   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");





function is_alphachar($text) {



    for ($i = 0; $i < strlen($text); $i++) {

    	

    	if (!ereg("[A-Za-z0-9]", $text[$i])) {

    		return 1;

    	}

    }

    }





$form .= "Vul hier uw <b>oud paswoord</b> en uw gewenste <b>nieuw paswoord</b> in.";

$form .= "<form action=\"chpw.php\" method=\"POST\">";

$form .= "<small><b>Oud paswoord:</b></small> <br><input type=\"password\" name=\"paswoord\"><br>";

$form .= "<small><b>Nieuw paswoord:</b></small> <br><input type=\"password\" name=\"password\"><br>";

$form .= "<small><b>Nieuw paswoord</b> (herhaling):</small> <br><input type=\"password\" name=\"passwordhh\"><br>";

$form .= "<input type=\"submit\" value=\"Verander!\">";

$form .= "<br><br>";



if($_POST[paswoord] == ""){

echo $form;

} 



else if(strlen($_POST[password]) < 6){

echo '<br><font color="#FF0000"><b>ERROR: Paswoord moet minimum 6 karakters bevatten.</b></font><br><br>';

echo $form;

} 



else if($_POST[password] != $_POST[passwordhh]){

echo '<br><font color="#FF0000"><b>ERROR: De opgegeven paswoorden zijn niet hetzelfde.</b></font><br><br>';

echo $form;

}



else {

$paswoord = SHA1($_POST[password]);

$opaswoord = SHA1($_POST[paswoord]);

$username = $_SESSION['login'];


if ($_SESSION['profiel']=="hulp") {
  $tabel = "hulpverleners";
}
else if ($_SESSION['profiel']=="mantel") {
  $tabel = "mantelzorgers";
}
else if ($_SESSION['profiel']=="patient") {
  $tabel = "patient";
}
else {
  $tabel = "logins";
}

$sql = "SELECT login FROM $tabel

	WHERE login = '$username' AND paswoord = '$opaswoord'";

	

$result = mysql_query($sql)

	or die ("Couldn't execute query.");

	

$num = mysql_num_rows($result);



if ($num != 1) {

echo '<br><font color="#FF0000"><b>ERROR: Oud paswoord is verkeerd!</b></font><br><br>';

echo $form;

}

else {





$result = mysql_query("UPDATE $tabel SET paswoord='$paswoord' WHERE login='$username' and id=".$_SESSION["usersid"]."") or die ("Coundn't execute query.");

$_SESSION["paswoord"]=$paswoord;

echo '<b>PROFICIAT </b>'; echo $username; echo '. <br><br> Uw paswoord is succesvol veranderd. Volgende keer bij het inloggen 

zal u uw nieuwe wachtwoord moeten gebruiken.<br>';

}

}





      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>