<?php



function toonEvaluatie($evaluatie) {

  $overlegType= $evaluatie['locatie'];

  $datum=substr($evaluatie['datum'],6,2)."/".substr($evaluatie['datum'],4,2)."/".substr($evaluatie['datum'],0,4);

  if (isset($evaluatie['katz_id'])) {

    if ($evaluatie['katz_id'] < 0)

      $evaluatie['katz_id'] = -$evaluatie['katz_id'];

    $katz = mysql_fetch_array(mysql_query("select * from katz where id = {$evaluatie['katz_id']}"));

    $txtKatzScore = $katz['totaal'];

    $infoKatz = "<a target=\"_blank\" href=\"katz_invullen.php?bekijk=1&katzID={$evaluatie['katz_id']}\">$txtKatzScore</a>";

  }

  else {

    $txtKatzScore = "";

    $infoKatz = " ";

  }

  $printActie = "<a target=\"_blank\" href=\"print_evaluatie.php?id={$evaluatie['id']}\">print</a>";

  $divID = "evaluatie{$evaluatie['id']}";

  if ($evaluatie['genre'] == "patient") {

   $naampje[0] = $_SESSION['pat_naam'] . ' ' . $_SESSION['pat_voornaam'];

  }

  else {

    if ($evaluatie['genre'] == "mantel") {

      $tabel = "mantelzorgers";

    }

    else if ($evaluatie['genre'] == "hulp") {

      $tabel = "hulpverleners";

    }

    else if ($evaluatie['genre'] == "orgpersoon") {

      $tabel = "hulpverleners";

    }

    else {

      $tabel = "logins";

    }

    $naampje = mysql_fetch_array(mysql_query("select concat(naam, concat(' ', voornaam))

                    from $tabel where id = {$evaluatie['uitvoerder_id']}"));

  }



  print ("<tr>");

  if (!(
      (($_SESSION['profiel']=="hulp")
          && ($evaluatie['genre']=="hulp")
          && ($_SESSION['usersid']!=$evaluatie['uitvoerder_id']))
      // ik ben een hulp en de evaluatie is door een hulp gedaan, maar ik ben het niet:: dan moet ik er af blijven

      ||
      ($evaluatie['creatiedatum'] == 0 && ($_SESSION['profiel']=="hulp"))
      // een evaluatie zonder creatiedatum, en ik ben hulpverlener: ik mag niet wissen

      ||
      (!($_SESSION['profiel']=="OC") && $evaluatie['creatiedatum'] > 0 && $evaluatie['creatiedatum'] < time()-60*60*24)
      // ik ben géén OC-TGZ en de evaluatie is te oud: ik moet er af blijven (oc-tgz mag wel oude evaluatie wissen)
     )) {
    // geen van bovengaande gevallen: nu mag ik de evaluatie wel wissen! (bv. omdat ik menos ben of oc-tgz of listel)
    print("
          <td><a href=\"wis_evaluatie.php?evaluatie_id={$evaluatie['id']}\">

            <img src=\"../images/wis.gif\" alt=\"wis\"  style=\"border: 0px;\" onclick=\"return confirm('Bent u zeker dat u de evaluatie van $datum wil wissen?');\" /></a>

          </td>");

 print("
          <td>$overlegType</td>

          <td><a href=\"#\" onClick=\"vertoon('$divID');\">".$datum."</a></td>

          <td>{$naampje[0]}</td>

          <td>$printActie</td>

          </tr>");



  echo <<< EINDE

              <tr ><td colspan="6"><div style="margin: 3px; border:1px solid #DDD;display:none" id="$divID">

                   <table cellpadding="5" width="100%">

                   <tr>

                      <th class="even" width="30%">Uitvoerder </td>

                      <th class="even" width="10%">Katz-score </td>

                      <th class="even" width="60%">Voortgang  </td>

                   </tr>

                   <tr>

                      <td valign="top">{$naampje[0]} </td>

                      <td valign="top">$infoKatz </td>

                      <td valign="top">{$evaluatie['vooruitgang']} </td>

                   </tr></table>

EINDE;



   print("</div></td></tr>");
  }

}



	//----------------------------------------------------------

	/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

	//----------------------------------------------------------



$paginanaam="Lijst evaluaties met mogelijkheid tot verwijderen!";



if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){
  if (isset($_POST['pat_code'])) $_SESSION['pat_code'] = $_POST['pat_code'];

	include("../includes/html_html.inc");

  print("<head>");

	include("../includes/html_head.inc");

	print("</head>");
?>

<script language="javascript">
  function vertoon(id) {
     var ding = document.getElementById(id);
     if (ding.style.display == "none")
       ding.style.display = "block";
     else
       ding.style.display = "none";
  }
</script>

<?php
	print("<body>");
	print("<div align=\"center\">");
	print("<div class=\"pagina\">");

  include("../includes/header.inc");
	include("../includes/pat_id.inc");

	print("<div class=\"contents\">");
	include("../includes/menu.inc");

  print("<div class=\"main\">");
	print("<div class=\"mainblock\">");

	if( isset($_GET['interventie_id']) ){

		//---------------------------------------------------------------------
		$qry="

			DELETE FROM

        menos_interventie

			WHERE

				id=".$_GET['interventie_id'];

		$result=mysql_query($qry);

		if ($result) {

       print("<div style=\"background-color: #8f8;\"><p>De interventie is gewist.</p></div>");

    }



		//---------------------------------------------------------------------

	}



  alleInterventies($_SESSION['pat_code'], true, "");




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