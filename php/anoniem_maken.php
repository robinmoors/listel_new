<?php

session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Af te ronden overleggen";

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


function zotteNaam($i) {
  $voorzetsel = $i%26;
  return substr( chr(65+$voorzetsel).md5(uniqid(rand(), true)),0,8);
}

// begin mainblock
$sql ="select * from patient";
$result = mysql_query($sql);
for ($i=0; $i < mysql_num_rows($result); $i++) {
  $rij = mysql_fetch_assoc($result);
  $naam = zotteNaam($i);
  $update = "update patient set naam = '$naam', adres = '{$naam}straat $i' where id = {$rij['id']}";
  mysql_query($update);
  print("$i $naam<br/>");
}




// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>