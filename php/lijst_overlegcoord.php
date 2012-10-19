<?php

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------

if (isset($_GET['listel']) && $_GET['listel']==1) {

   $paginanaam="Listelcoordinatoren";

   $paginatitel="Listelco&ouml;rdinatoren";

}

else if (isset($_GET['tp'])) {

   $paginanaam="Projectcoordinatoren";

   $paginatitel="Projectco&ouml;rdinatoren";

}

else if (isset($_GET['caw'])) {

   $paginanaam="CAW-coordinatoren";

   $paginatitel="CAW-co&ouml;rdinatoren";

}

else if (isset($_GET['rdc'])) {
   $paginanaam="Overlegcoordinatoren RDC";
   $paginatitel="Overlegco&ouml;rdinatoren RDC";
}
else if (isset($_GET['za'])) {
   $paginanaam="Overlegcoordinatoren ZA";
   $paginatitel="Overlegco&ouml;rdinatoren ZA";
}
else if (isset($_GET['menos'])) {
   $paginanaam="Menoscoordinatoren";
   $paginatitel="Menosco&ouml;rdinatoren";
}
else if (isset($_GET['ziekenhuis'])) {
   $paginanaam="Ziekenhuislogins";
   $paginatitel="Ziekenhuislogins";
}
else if (isset($_GET['psy'])) {
   $paginanaam="Logins Psychiatrische overlegcoordinatoren";
   $paginatitel="Logins Psychiatrische overlegco&ouml;rdinatoren";
}
else {

   $paginanaam="Overlegcoordinatoren OCMW";

   $paginatitel="Overlegco&ouml;rdinatoren OCMW";

}



if(isset($_GET['a_order']) ){



	$a_order = $_GET['a_order'];



}



   if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan")){

      

      require("../includes/html_html.inc");



      print("<head>");



      require("../includes/html_head.inc");

      require("../includes/bevestigdel.inc");

?>
<style type="text/css">
  .mainblock { height: auto;}
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









		if( isset($a_order) && ($a_order != "ovnaam") ){

		

			$a_order = $a_order.",ovnaam";

		

		}

		else{



			$a_order = "ovnaam";

		

		}





    if (isset($_GET['listel']) && $_GET['listel']==1) {

      $query = "SELECT *, naam as ovnaam from logins where profiel = 'listel' and actief=1 ORDER BY $a_order";

      $listel = "&listel=1";

      $listel2 = "?listel=1";

    }
    else if (isset($_GET['menos']) && $_GET['menos']==1) {
      $query = "SELECT *, naam as ovnaam from logins where profiel = 'menos' and actief=1 ORDER BY $a_order";
      $listel = "&menos=1";
      $listel2 = "?menos=1";
    }
    else if ($_SESSION['profiel'] == "hoofdproject" && isset($_GET['tp']) && $_GET['tp']==1) {

      $query = "SELECT logins.*, profiel, logins.naam as ovnaam, tp.naam, tp.nummer from logins, tp_project as tp

                where (profiel = 'hoofdproject' or profiel = 'bijkomend project')

                      and logins.tp_project = tp.id

                      and logins.actief=1

                      and logins.tp_project = {$_SESSION['tp_project']}  ORDER BY $a_order";

      $listel = "&tp=1";

      $listel2 = "?tp=1";

    }

    else if (isset($_GET['tp']) && $_GET['tp']==1) {

      $query = "SELECT logins.*, profiel, logins.naam as ovnaam, tp.naam, tp.nummer from logins, tp_project as tp

                where (profiel = 'hoofdproject' or profiel = 'bijkomend project')

                      and logins.tp_project = tp.id

                      and logins.actief=1  ORDER BY $a_order";

      $listel = "&tp=1";

      $listel2 = "?tp=1";

    }

    else if (isset($_GET['caw']) && $_GET['caw']==1) {

      $query = "SELECT *, naam as ovnaam from logins where profiel = 'caw' and actief=1 ORDER BY $a_order";

      $listel = "&caw=1";

      $listel2 = "?caw=1";

    }

    else if (isset($_GET['rdc']) && $_GET['rdc']==1) {

      $query = "SELECT logins.*, logins.naam as ovnaam, gemeente.deelvzw from logins
                                                                left join (organisatie inner join gemeente on organisatie.gem_id = gemeente.id)
                                                                     on logins.organisatie = organisatie.id
                where profiel = 'rdc' and logins.actief=1 ORDER BY $a_order";

      $listel = "&rdc=1";

      $listel2 = "?rdc=1";

    }

    else if (isset($_GET['za']) && $_GET['za']==1) {

      $query = "SELECT hulpverleners.*, hulpverleners.naam as ovnaam, gemeente.dlnaam, gemeente.dlzip, gemeente.zip,
                       concat_ws('',gemeente.deelvzw, gem2.deelvzw) as deelvzw from hulpverleners
                                                                left join (organisatie inner join gemeente on organisatie.gem_id = gemeente.id)
                                                                     on hulpverleners.organisatie = organisatie.id
                                                                        and not(hulpverleners.organisatie in (996,997,998,999))
                                                                left join gemeente gem2
                                                                     on hulpverleners.gem_id = gem2.id
                                                                        and (hulpverleners.organisatie is NULL or hulpverleners.organisatie in ('',996,997,998,999) or gemeente.deelvzw is null)
                where is_organisator = 1 and hulpverleners.actief=1 ORDER BY $a_order";

      $listel = "&za=1";

      $listel2 = "?za=1";

    }
    else if (isset($_GET['ziekenhuis']) && $_GET['ziekenhuis']==1) {
      $query = "SELECT logins.*, logins.naam as ovnaam from logins
                                                                left join organisatie
                                                                on logins.organisatie = organisatie.id
                where profiel = 'ziekenhuis' and logins.actief=1 ORDER BY $a_order";
      $listel = "&ziekenhuis=1";
      $listel2 = "?ziekenhuis=1";
    }
    else if (isset($_GET['psy']) && $_GET['psy']==1) {
      $query = "SELECT logins.*, logins.naam as ovnaam, organisatie.naam as orgnaam from logins
                                                                left join organisatie
                                                                on logins.organisatie = organisatie.id
                where profiel = 'psy' and logins.actief=1 ORDER BY $a_order";
      $listel = "&psy=1";
      $listel2 = "?psy=1";
    }
    else {

      $query = "

			SELECT
        DISTINCT
				ov.id,

				ov.naam AS ovnaam,

				ov.voornaam,

				ov.adres,

				ov.gem_id,

				ov.tel,

				ov.fax,

				ov.gsm,

				ov.email,

				ov.sit_id,



				s.nr,

				s.naam AS snaam,
				gemeente.deelvzw

			FROM

				logins ov left join gemeente on ov.overleg_gemeente = gemeente.dlzip,
				sit s

			WHERE

        ov.actief = 1 AND

        ov.profiel = 'OC' AND

				ov.id<>1 AND

				ov.sit_id = s.id

			AND

				ov.actief <> 0

         ORDER BY ".

				$a_order;

    }



      print ("<h1>$paginatitel</h1>");
      

      if ($_GET['za']==1) {
        print("			<a href=\"edit_verlener.php\">TOEVOEGEN</a><br /><br />  \n");
      }
      else {
        print("			<a href=\"edit_overlegcoord.php{$listel2}\">TOEVOEGEN</a><br /><br />  \n");
      }



      print("
         <table class=\"klein\">

            <tr>

					<th>Wissen</th>



         <th><a href=\"lijst_overlegcoord.php?a_order=ovnaam{$listel}\">Naam</a></th>

         <th>&nbsp;</th>");



     if (isset($_GET['tp'])) {

            print("<th><a href=\"lijst_overlegcoord.php?a_order=tp.nummer,profiel ASC&tp=1\">Therapeutisch project</a></th>");

     }

     else if (isset($_GET['rdc'])) {

            print("<th>&nbsp;</th><th><a href=\"lijst_overlegcoord.php?rdc=1&a_order=deelvzw\">SEL</a></th>");

     }
     else if (isset($_GET['za'])) {

            print("<th>&nbsp;</th><th><a href=\"lijst_overlegcoord.php?za=1&a_order=concat_ws('',gemeente.deelvzw, gem2.deelvzw)\">SEL</a></th>");

     }
     else if (isset($_GET['ziekenhuis'])) {
            print("<th>&nbsp;</th><th>&nbsp;</th>");
    }
     else if (isset($_GET['psy'])) {
            print("<th><a href=\"lijst_overlegcoord.php?psy=1&a_order=organisatie.naam\">Organisatie</a></th><th>&nbsp;</th>");
    }
     else if (!isset($_GET['listel']) && !isset($_GET['tp']) && !isset($_GET['menos']) && !isset($_GET['caw']) && !isset($_GET['rdc']) && !isset($_GET['za'])) {

            print("<th><a href=\"lijst_overlegcoord.php?a_order=s.nr\">POP</a></th><th><a href=\"lijst_overlegcoord.php?a_order=deelvzw\">SEL</a></th>");

     }



			print("</tr>");



      if ( $result=mysql_query($query) ){

         

         $teller = 0;



         for ($i=0; $i < mysql_num_rows($result); $i++){

            

            $records= mysql_fetch_array($result);



            $veld00 = ($records['id']!="")?			$records['id']:"";

            $veld01 = ($records['ovnaam']!="")?		$records['ovnaam']:"";

            $veld02 = ($records['voornaam']!="")?	$records['voornaam']:"";

            $veld03 = ($records['adres']!="")?		$records['adres']:"";

            $veld04 = ($records['tel']!="")?		$records['tel']:"";

            $veld05 = ($records['fax']!="")?		$records['fax']:"";

            $veld06 = ($records['gsm']!="")?		$records['gsm']:"";

            $veld07 = ($records['email']!="")?		$records['email']:"";

            $veld08 = ($records['sit_id']!="")?		$records['sit_id']:"";

            $veld09 = ($records['nr']!="")?			$records['nr']:"";

            $veld10 = ($records['snaam']!="")?		$records['snaam']:"";

            $veld11 = ($records['gem_id']!="")?		$records['gem_id']:"";





			//print("veld 00 ".$veld00."<br />veld01 ".$veld01."<br />veld02 ".$veld02."<br />veld03 ".$veld03."<br />veld04 ".$veld04."<br />veld05 ".$veld05."<br />veld06 ".$veld06."<br />veld07 ".$veld07."<br />veld08 ".$veld08."<br />veld09 ".$veld09."<br />veld10 ".$veld10."<br />veld11 ".$veld11."<br /><br /><br />");





/*

				if($veld01=="" || $veld02=="" || $veld03=="" || $veld04=="" || $veld07=="" || $veld08=="" || $veld09=="" || $veld10=="" || $veld11=="9999"){

					

					$okstring="<input type=\"checkbox\" />";



				}

				else{

					

					$okstring="<input type=\"checkbox\" checked=\"checked\" />";

				}

*/



    $naam = "$veld01 $veld02";

    if ($records['profiel']=="hoofdproject") $naam = "<strong>$naam</strong>";

		print("

            <tr>

               <td style=\"text-align: center;\">

					<a href=\"edit_overlegcoord.php?a_overlcrd_delId=".$veld00."&backpage=lijst_overlegcoord.php{$listel}\"

              onclick=\"return bevestigdel('edit_overlegcoord.php?a_overlcrd_delId=".$veld00."&backpage=lijst_overlegcoord.php')\">

            <img src='../images/wis.gif' alt='wis' style='border: 0px;'>

          </a>

				</td>

					<td>$naam</td>\n");
					
      if ($_GET['za']==1) {
        print("			<td><a href=\"edit_verlener.php?id={$veld00}\">bewerk</a></td> \n");
      }
      else {
        print("			<td><a href=\"edit_overlegcoord.php?a_overlcrd_id=".$veld00."{$listel}\">bewerk</a></td>\n ");
      }

    $deelvzw = $records['deelvzw'];

    if (isset($_GET['tp'])) print("<td>".tp_roepnaam($records)."</td>");
    else if (isset($_GET['psy'])) print("<td>{$records['orgnaam']}</td>");
    else if (!isset($_GET['listel'])) print("<td>".$veld09." ".$veld10."</td><td>$deelvzw</td>");
    else print("<td>$deelvzw</td>");

    print("</tr>");

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

