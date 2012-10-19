<?php

session_start();




   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="Overzicht OMB-registraties";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");

?>

<script language="javascript" type="text/javascript" src="../javascript/prototype.js"></script>

<script type="text/javascript" src="../javascript/omb.js"></script>

<?php

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



// begin mainblock

?>

<h3>Zoek een OMB-registratie</h3>



<form method="post" action="omb_registratie.php">

Geef het registratienummer in (jjjj/mm/dd/LI-nnn) :

<input type="text" size="5" name="zoekjjjj"/>/<input type="text" size="5" name="zoekmm"/>

<input type="text" size="5" name="zoekdd"/>/Li-<input type="text" size="5" name="zoekdagnummer"/>

<br/>

<input type="submit" value="zoek registratie" />

</form>



<h3>Overzicht OMB-registraties</h3>

<?php
if (isset($_POST['aantal'])) {
  $aantal = $_POST['aantal'];
}
else {
  $aantal = 40;
}
?>
<p><form method="post"><input type="submit" value="Toon"/> <input type="text" name="aantal" value="<?= $aantal ?>"/> registraties. </form>

</form>
<table>

<?php

  if ($_SESSION['profiel']=="caw") {

    $qry = "select distinct omb_registratie.id, dag,maand,jaar,dagnummer, afgerond, naam, voornaam, profiel

            from omb_registratie left join logins on logins.id = auteur

            where voorCAW = 1 or (logins.profiel = 'caw')

            order by jaar desc,maand desc,dag desc, dagnummer desc limit 0,$aantal";

  }

  else {

    preset($_SESSION['usersid']);
    if ($_SESSION['profiel']!="listel") $extravoorwaarde = " where auteur = {$_SESSION['usersid']} ";

    $qry = "select omb_registratie.id, dag,maand,jaar,dagnummer, afgerond, naam, voornaam, voorCAW, profiel

            from omb_registratie inner join logins on logins.id = auteur $extravoorwaarde order by jaar desc,maand desc,dag desc, dagnummer desc limit 0,$aantal";

  }

  //print($qry);

  $result = mysql_query($qry) or die("kan registraties niet ophalen $qry");

  

  for ($i=0; $i<mysql_num_rows($result); $i++) {

     $rij = mysql_fetch_assoc($result);

     if ($rij['maand']<10) $rij['maand']="0".$rij['maand'];

     if ($rij['dag']<10) $rij['dag']="0".$rij['dag'];

     if ($rij['dagnummer']<10) $rij['dagnummer']="00".$rij['dagnummer'];

     else if ($rij['dagnummer']<100) $rij['dagnummer']="0".$rij['dagnummer'];



     $magWissen = "<td>&nbsp;</td>";

     if ($rij['afgerond']==1) {

       $txtAfgerond = " (afgerond door {$rij['profiel']}) ";
       if ($_SESSION['profiel']=="listel" && ($rij['profiel']== 'caw')) {
         $magWissen = "<td><a href=\"javascript:wisOMB({$rij['id']});\"><img src=\"../images/wis.gif\" alt=\"wis\" /></a></td> ";
       }
     }
     else if ($rij['afgerond']==2) {

       $txtAfgerond = " (volledig afgerond) ";
       if ($_SESSION['profiel']=="listel" && ($rij['profiel']== 'caw')) {
         $magWissen = "<td><a href=\"javascript:wisOMB({$rij['id']});\"><img src=\"../images/wis.gif\" alt=\"wis\" /></a></td> ";
       }
     }
     else {

       $txtAfgerond = "";

       $magWissen = "<td><a href=\"javascript:wisOMB({$rij['id']});\"><img src=\"../images/wis.gif\" alt=\"wis\" /></a></td> ";

     }

     if ($_SESSION['profiel']=="listel" && ($rij['voorCAW']==0)) {

       $voorCAW = "<td id=\"caw{$rij['id']}\"><a href=\"javascript:voorCAW({$rij['id']});\"><img src=\"../images/caw.gif\" alt=\"geef aan caw\" /></a></td>";

     }

     else {

       $voorCAW = "<td></td>";

     }





     print("<tr id=\"rij{$rij['id']}\">{$voorCAW}{$magWissen}<td><a href=\"omb_registratie.php?zoekid={$rij['id']}\">{$rij['jaar']}/{$rij['maand']}/{$rij['dag']}/LI-{$rij['dagnummer']}</a> door {$rij['naam']} {$rij['voornaam']}</td><td>$txtAfgerond</td></tr>\n");

  }

?>



</table>



<?php

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