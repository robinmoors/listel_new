<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Pati&euml;nten";







if(isset($_GET['a_order'])){
  if (trim($_GET['a_order'])=="") {
    $a_order = "naam";
  }
  else {
  	$a_order = $_GET['a_order'];
  }


}







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







    if ($_SESSION['profiel']=="listel") $wissen = "<th>Wissen</th>";

    print ("<h1>Lijst Pati&euml;nten</h1>\n");
    if ($_SESSION['isOrganisator']==1) print("        <a href=\"patient_nieuw.php\">TOEVOEGEN</a><br /><br />\n");
    

    if ($_SESSION['profiel']=="listel") {
      $deelvzwGET = "&deelvzw={$_GET['deelvzw']}";
?>
<p>
   <!-- Toon alleen pati&euml;nten uit -->
      <form method="get" style="display:inline;"><input type="hidden" name="deelvzw" value="H"/><input type="submit" value="SEL Hasselt" /></form>
   of
      <form method="get" style="display:inline;"><input type="hidden" name="deelvzw" value="G"/><input type="submit" value="SEL Genk" /></form>
   of
      <form method="get" style="display:inline;"><input type="submit" value="Alles" /></form>
</p>
<?php
    }




    $a_order=(isset($a_order)&&($a_order!="naam"))?$a_order.",naam,voornaam":"naam,voornaam";
        if($_SESSION["profiel"]=="OC"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM gemeente,
                                              (patient LEFT JOIN patient_tp on patient.code = patient_tp.patient)
                       WHERE (patient.actief=1 or
                              (patient.actief=-1 and patient_tp.actief = 1 and patient_tp.rechtenOC > 0 and patient_tp.rechtenOC <= $vandaag))
                              AND gem_id=gemeente.id and gemeente.zip =  {$_SESSION['overleg_gemeente']}
                              AND patient.toegewezen_genre = 'gemeente'
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="rdc"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient
                       WHERE  patient.actief=1
                              AND patient.toegewezen_genre = 'rdc' and patient.toegewezen_id = {$_SESSION['organisatie']}
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hulp" && $_SESSION['isOrganisator']){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient
                       WHERE patient.actief=1
                              AND patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                       ORDER BY $a_order";
          $queryNog = "SELECT distinct patient.*  FROM patient, huidige_betrokkenen
                       WHERE (patient.actief=1 or patient.menos=1)
                             AND patient.code = huidige_betrokkenen.patient_code
                             AND genre = 'hulp' and persoon_id = {$_SESSION['usersid']}
                             AND (rechten = 1 or overleggenre = 'menos')
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hulp"){
          $vandaag = date("Ymd");
          $query = "SELECT distinct patient.*  FROM patient, huidige_betrokkenen
                       WHERE (patient.actief=1 or patient.menos=1)
                             AND patient.code = huidige_betrokkenen.patient_code
                             AND genre = 'hulp' and persoon_id = {$_SESSION['usersid']}
                             AND (rechten = 1 or overleggenre = 'menos')
                       ORDER BY $a_order";
        }
        else if($_SESSION["profiel"]=="hoofdproject"){
          $query = "SELECT distinct patient.* FROM patient_tp, patient
                       WHERE patient.actief=-1 AND patient_tp.actief = 1
                       AND patient_tp.patient = patient.code AND
                             patient_tp.project = {$_SESSION['tp_project']}
            ORDER BY
              $a_order";
        }
        else if($_SESSION["profiel"]=="bijkomend project"){
            $query = "SELECT distinct patient.* FROM patient_tp, patient
                       WHERE patient.actief=-1 AND patient_tp.actief = 1
                       AND patient_tp.patient = patient.code AND
                             patient_tp.project = {$_SESSION['tp_project']}
            ORDER BY
              $a_order";
        }
        else if($_SESSION["profiel"]=="listel") {
          if ($_GET['deelvzw']=="H") {
            print("<h2>SEL Hasselt</h2>");
            $deelvzw = " and deelvzw = \"{$_GET['deelvzw']}\" ";
          }
          else if ($_GET['deelvzw']=="G")  {
            print("<h2>SEL Genk</h2>");
            $deelvzw = " and deelvzw = \"{$_GET['deelvzw']}\" ";
          }
          $query = "
             SELECT distinct
            code,
            voornaam,
            patient.naam,
            patient.id,
            deelvzw,
            menos
          FROM
            patient inner join gemeente on patient.gem_id = gemeente.id
          WHERE
            (actief=1 or actief = -1 or menos = 1)
            $deelvzw
          ORDER BY
            $a_order";
        }
        else if($_SESSION["profiel"]=="menos") {
          $query = "
             SELECT distinct
            code,
            voornaam,
            patient.naam,
            patient.id
          FROM
            patient inner join patient_menos on patient.code = patient_menos.patient
          WHERE
            menos = 1
          ORDER BY
            $a_order";
        }
        else if($_SESSION["profiel"]=="psy") {
             $actief = "(patient.einddatum=0 AND patient.actief=1)";
             $beperking = "   AND patient.toegewezen_genre = 'psy'
                              AND patient.toegewezen_id = {$_SESSION['organisatie']}
                          ";
             $overlegBeperking = ""; // mag alle overleggen zien
                 // "(overleg.toegewezen_genre = 'psy' AND (overleg.genre = 'psy')";
             $tpTabel = "";
             $tpRechten = "";
             $ofNogGeenOverleg = "OR max(afgerond) is NULL";
             $minimumAantal = 1;
             $menosBeperking = " AND false ";
                  $query = "SELECT patient.*  FROM $beperkingTabel
                                              (patient $tpTabel)
                       WHERE ($actief $tpRechten)
                             $beperking
                       ORDER BY
                         naam,voornaam";
        }






	//print($query);




function toonPatienten($query) {
   global $wissen, $deelvzwGET;
   if ($_SESSION['profiel']=="listel") {
     $deelvzwTH = "<th><a href=\"lijst_patienten.php?a_order=deelvzw$deelvzwGET\">Deel</a></th>";
   }

    if ($result=mysql_query($query)){

        print("
          <table class=\"klein\">
            <tr>
                $wissen
                <th><a href=\"lijst_patienten.php?a_order=code$deelvzwGET\">Kenmerk</a></th>
                <th><a href=\"lijst_patienten.php?a_order=naam$deelvzwGET\">Naam</a></th>
                $deelvzwTH
            </tr>
    	  ");
        $teller = 0;

        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            $teller++;



			//print_r($records);





            $veldpat_code=($records['code']!="")?					$records['code']:"";

            $veldpat_id=($records['id']!="")?						$records['id']:"";

            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";

            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";



            //$veldpat_startdatum=($records['startdatum']!="")?		$records['startdatum']:"";



            $tpCode = tpVisueel($veldpat_code);

            print("          <tr>\n");

            if ($_SESSION['profiel']=="listel") {

               print("

                    <td style=\"text-align: center;\">

						           <a href=\"wis_patient.php?wispat_nr=".$veldpat_id."&backpage=lijst_patienten.php&order=$a_order\"

							            ><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a>

					          </td> \n");

            }
            if ($_SESSION['profiel']=="listel") {
               $deelvzwTD = "<td>{$records['deelvzw']}</td>";
            }

            if ($records['menos']==1) {
               $tpCode = $tpCode . "-menos";
            }
            if ($records['type']==16 || $records['type']==18) {
               $tpCode = $tpCode . "-PSY";
            }

            print("

                    <td>".$veldpat_code."$tpCode</td>

                    <td><a href=\"patient_aanpassen.php?code=".$veldpat_code."\">".$veldpat_naam." ".$veldpat_voornaam."</a></td>
                    $deelvzwTD


                </tr>

			");



            }

            print("</table>");

        }



    else{

		//print(mysql_error());

        

        print ("Er werden geen records gevonden $query");



		//print(mysql_error());

    }

}

   if (isset($queryNog)) {
     print("<h1>Van volgende pati&euml;nten ben je organisator</h1>");
   }

   toonPatienten($query);
   
   if (isset($queryNog)) {
     print("<h1>Bij volgende pati&euml;nten ben je betrokkenen hulpverlener</h1>");
     toonPatienten($queryNog);
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