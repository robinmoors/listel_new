<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Wis Pati&euml;nt";



if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){

    

    $_SESSION['pat_code']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";



    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");

    include("../includes/bevestigdel.inc");



    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");



    include("../includes/header.inc");

    include("../includes/kruimelpad.inc");



    print("<div class=\"contents\">");



    include("../includes/menu.inc");



    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");



    //----------------------------------------------------------

    // indien een wispat_id wordt doorgegeven pas dan de patient

    // gegevens aan door de patient op non-actief te zetten

    // patienten worden nooit echt gewist



$patientInfo=mysql_fetch_array(mysql_query("SELECT * FROM patient WHERE id=".$_GET['wispat_nr']));



if ($_SESSION['profiel']!="listel") {

  die("Alleen listel-co&ouml;rdinatoren kunnen pati&euml;nten wissen.");

}

else if ($_GET['bevestiging']=="ja") {


  // er is bevestigd dat alle overleggen gewist moeten worden

  $deleteOmb = "delete from omb_registratie where id in (select omb_id from overleg where patient_code = '{$patientInfo['code']}' and omb_id is not null)";
  $deleteOverleggen = "delete from overleg where patient_code = '{$patientInfo['code']}'";
  $deleteMenos1 = "delete from menos_files where patient = '{$patientInfo['code']}'";
  $deleteMenos3 = "delete from menos_interventie where patient = '{$patientInfo['code']}'";
  $deleteMenos4 = "delete from patient_menos where patient = '{$patientInfo['code']}'";

  if (mysql_query($deleteOmb) && mysql_query($deleteOverleggen)
                              && mysql_query($deleteMenos1)
                              && mysql_query($deleteMenos3)
                              && mysql_query($deleteMenos4)
     ) {

   	$query2 = "UPDATE patient SET actief = 0, menos=0 WHERE id = ". $_GET['wispat_nr'];

    $doe2 = mysql_query($query2);

   	$query2 = "UPDATE patient_tp SET actief = 0 WHERE patient = '{$patientInfo['code']}'";

    $doe2 = mysql_query($query2);

          print("Het item is <b>succesvol op non-actief gezet</b>



				 <script>

				 function redirect()

					{

					document.location = \"". $_GET['backpage']."?a_order={$_GET['order']}" ."\";

					}

				 setTimeout(\"redirect()\",1500);

				 </script>

		   ");

  }
  else {
    print("---------" . mysql_error() );
  }

}

else {

  $qryHangendeOverleggen = "select overleg.* from overleg, patient where patient_code = code and patient.id = {$_GET['wispat_nr']} order by datum asc";
  $resultHangendeOverleggen = mysql_query($qryHangendeOverleggen);

  if (mysql_num_rows($resultHangendeOverleggen)==0) {

    // we kunnen veilig wissen

    $deleteMenos1 = "delete from menos_files where patient = '{$patientInfo['code']}'";
    $deleteMenos3 = "delete from menos_interventie where patient = '{$patientInfo['code']}'";
    $deleteMenos4 = "delete from patient_menos where patient = '{$patientInfo['code']}'";

    mysql_query($deleteOmb) && mysql_query($deleteOverleggen)
                              && mysql_query($deleteMenos1)
                              && mysql_query($deleteMenos3)
                              && mysql_query($deleteMenos4);
   	$query2 = "UPDATE patient SET actief = 0, menos=0 WHERE id = ". $_GET['wispat_nr'];

    $doe2 = mysql_query($query2);

   	$query2 = "UPDATE patient_tp SET actief = 0 WHERE patient = '{$patientInfo['code']}'";

    $doe2 = mysql_query($query2);

          print("Het item is <b>succesvol op non-actief gezet</b>



				 <script>

				 function redirect()

					{

					document.location = \"". $_GET['backpage']."?a_order={$_GET['order']}" ."\";

					}

				 setTimeout(\"redirect()\",1500);

				 </script>

		   ");

  }

  else {

    // lijst de overleggen op, en vraag bevestiging!

    print("<p>Deze pati&euml;nt <strong>{$patientInfo['naam']} {$patientInfo['voornaam']}</strong> heeft AL overleggen!</p>\n");

    print("<table><tr><th>Datum</th><th>Locatie</th><th>Soort</th></tr>\n");

    for ($i=0;$i<mysql_num_rows($resultHangendeOverleggen); $i++) {

      $rijOverleg = mysql_fetch_assoc($resultHangendeOverleggen);

      $mooieDatum = substr($rijOverleg['datum'],6,2)."/".substr($rijOverleg['datum'],4,2)."/".substr($rijOverleg['datum'],0,4);

      if ($rijOverleg['locatie']==0) $locatie = "thuis";

      else if ($rijOverleg['locatie']==1) $locatie = "elders";

      else if ($rijOverleg['locatie']==2) $locatie = "centrum";

      else $locatie = $rijOverleg['locatieTekst'];

      print("<tr><td>$mooieDatum</td><td>$locatie</td><td>{$rijOverleg['genre']}</td></tr>");

    }

?>

    </table>



    <p>Ben je h&eacute;&eacute;l h&eacute;&eacute;l zeker dat je deze pati&euml;nt <strong>&eacute;n al</strong> zijn overleggen wil wissen?<br/>

    <form method="get">

       <input type="hidden" name="bevestiging" value="ja" />

       <input type="hidden" name="wispat_nr" value="<?= $_GET['wispat_nr'] ?>" />

       <input type="hidden" name="backpage" value="<?= $_GET['backpage'] ?>" />

       <input type="hidden" name="order" value="<?= $_GET['order'] ?>" />

       <input type="submit" value="Ja, ik ben zeker" />

    </form>

    

    <form method="get" action="<?= "{$_GET['backpage']}" ?>">

       <input type="hidden" name="a_order" value="<?= $_GET['order'] ?>" />

       <input type="submit" value="Neen, geen denken aan. Breng mij terug naar de pati&euml;ntenlijst." />

    </form>



<?php

  }

}





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

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>