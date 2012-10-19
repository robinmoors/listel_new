<?php

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------


   $paginanaam=$paginatitel = "Lijst geregistreerde gebruikers met login";






if(isset($_GET['a_order']) ){
	$a_order = $_GET['a_order'];
}
else {
	$a_order = "naam";
}



   if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan")){
      require("../includes/html_html.inc");
      print("<head>");
      require("../includes/html_head.inc");

?>
<style type="text/css">
  .mainblock { height: auto;}
  td  {font-size: 9px;}
</style>

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









		if( isset($a_order) && ($a_order != "naam")){
      if ((strpos($a_order,"voornaam")===FALSE)) {
   			$a_order = $a_order.",naam,voornaam";
      }
		}
		else{
			$a_order = "naam";
		}


      $query = "SELECT hulpverleners.naam, hulpverleners.voornaam, organisatie.naam as orgnaam, functies.naam as functie,
                       hulpverleners.login, validatiedatum
                   from hulpverleners inner join functies on functies.id = fnct_id
                           left join organisatie on (hulpverleners.organisatie = organisatie.id)
                where validatiestatus = 'gevalideerd' and hulpverleners.actief=1 ORDER BY $a_order";


      print ("<h1>$paginatitel</h1>");
      if ( $result=mysql_query($query) ){

        $aantal = mysql_num_rows($result);
        if (isset($_GET['start'])) {
          print("<h2>$aantal gebruikers, hier getoond vanaf de {$_GET['start']}<sup>e</sup></h2>\n");
        }
        else  {
          print("<h2>$aantal gebruikers</h2>\n");
          $_GET['start']=1;
        }
        if ($aantal > 50) {
          for ($i=1; $i< $aantal; $i = $i + 50) {
            $start = $i;
            $einde = min($i+49, $aantal);
            print(" <a href=\"lijst_geregistreerden.php?a_order=$a_order&start=$start\">$start..$einde</a>");
          }
        }
        
        if (isset($_GET['start'])) {
          $query = "SELECT hulpverleners.naam, hulpverleners.voornaam, organisatie.naam as orgnaam, functies.naam as functie,
                       hulpverleners.login, validatiedatum
                   from hulpverleners inner join functies on functies.id = fnct_id
                           left join organisatie on (hulpverleners.organisatie = organisatie.id)
                  where validatiestatus = 'gevalideerd' and hulpverleners.actief=1 ORDER BY $a_order LIMIT {$_GET['start']},50";
          $result=mysql_query($query);
        }

        
        print("
         <table class=\"klein\">
            <tr>
         <th><a href=\"lijst_geregistreerden.php?a_order=naam,voornaam\">Naam</a></th>
         <th><a href=\"lijst_geregistreerden.php?a_order=organisatie.naam\">Organisatie</a></th>
         <th><a href=\"lijst_geregistreerden.php?a_order=functies.naam\">Discipline</a></th>
         <th><a href=\"lijst_geregistreerden.php?a_order=login\">Login</a></th>
         <th><a href=\"lijst_geregistreerden.php?a_order=validatiedatum\">Validatiedatum</a></th>
         ");
	  		print("</tr>");

         $teller = 0;
         for ($i=0; $i < $aantal; $i++){
            $records= mysql_fetch_array($result);
        		print("
              <tr>
                 <td>{$records['naam']} {$records['voornaam']}</td>
                 <td>{$records['orgnaam']}</td>
                 <td>{$records['functie']}</td>
                 <td>{$records['login']}</td>
                 <td>{$records['validatiedatum']}</td>
              </tr>\n");
        }
        print("</table>");
  }
  else{

         

         print ("Er werden geen records gevonden " .mysql_error());



         }





      print("</div>");

      print("</div>");

      print("</div>");



      ("../s/footer.inc");



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

