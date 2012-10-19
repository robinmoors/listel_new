<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

	//----------------------------------------------------------

	

include("../includes/clearSessie.inc");



$paginanaam="Lijst Uittreksels voor organisatie van overleg";







if(isset($_GET['a_order']) ){



	$a_order = $_GET['a_order'];



}





if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION["profiel"]=="listel") ){

    

    $_SESSION['pat_code']="";

    $_SESSION['pat_naam']="";

    $_SESSION['pat_voornaam']="";



    include("../includes/html_html.inc");



    print("<head>");



    include("../includes/html_head.inc");
    print('<script type="text/javascript" src="../javascript/prototype.js"></script>');
    print("<script type='text/javascript'>function hide(){}");
    print("//var orgList = orgListAlles;\n</script>");



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



    print ("

        <h1>Uittreksels voor organisatie van overleg</h1>  ");
        

?>
<p>
   <!-- Toon alleen pati&euml;nten uit -->
      <form method="get" style="display:inline;"><input type="hidden" name="extra" value=" "/><input type="submit" value="Alles (ook al afgedrukte)" /></form>
   of
      <form method="get" style="display:inline;"><input type="hidden" name="extra" value=" and organisatie_factuur = ''"/><input type="submit" value="Alleen niet-afgedrukte" /></form>
</p>

<?php

  if (!isset($_GET['extra'])) {
    $_GET['extra'] = " and organisatie_factuur = ''";
  }



    print("
        <table class=\"klein\">



            <tr>

                <th><a href=\"lijst_facturen_organisatie.php?a_order=datum&extra={$_GET['extra']}\">Datum</a></th>

                <th>Code</th>
                <th>&nbsp;</th>

                <th><a href=\"lijst_facturen_organisatie.php?a_order=naam&extra={$_GET['extra']}\">Naam</a></th>

            </tr>

	");



  if (isset($_GET['a_order']))
    $a_order = $_GET['a_order'];



	if( isset($a_order) && ($a_order != "patient_code") ){

	

		$a_order = $a_order.", patient_code";

	

	}



	else{



		$a_order = "datum";



	}


  if ($_GET['organisator']>0) {
    // echte organisatie
    print("<p>Hieronder vind je alleen uittreksels voor de organisatie die je beneden in het menu ziet (organisatie-id {$_GET['organisator']})</p>");
    $query = "select distinct overleg.id, overleg.organisatie_factuur, patient_code, datum, patient.naam, patient.voornaam, deelvzw from overleg,
                     (patient inner join gemeente on patient.gem_id = gemeente.id)
                        left join logins on logins.overleg_gemeente = gemeente.zip
               where code = patient_code and afgerond = 1 and controle = 1 and (keuze_vergoeding = 1)
                 and datum >= $beginOrganisatieVergoeding
                 and (genre is null or genre = 'gewoon')
                 and ((overleg.toegewezen_genre = 'gemeente' and logins.organisatie = {$_GET['organisator']})
                      or
                      (overleg.toegewezen_genre = 'rdc' and overleg.toegewezen_id = {$_GET['organisator']})
                     )
                 {$_GET['extra']}
                 order by $a_order";
  }
  else if ($_GET['organisator']<0) {
    // hulpverlener als organisator
    print("<p>Hieronder vind je alleen uittreksels voor de zorg- of hulpverlener nr " . (-$_GET['organisator']) . ", die je beneden in het formulier ziet.</p>");
    $query = "select overleg.id, overleg.organisatie_factuur, patient_code, datum, patient.naam, voornaam, deelvzw from overleg, patient inner join gemeente on patient.gem_id = gemeente.id
               where code = patient_code and afgerond = 1 and controle = 1 and (keuze_vergoeding = 1)
                 and datum >= $beginOrganisatieVergoeding
                 and (genre is null or genre = 'gewoon')
                 and overleg.toegewezen_genre = 'hulp' and overleg.toegewezen_id = -{$_GET['organisator']}
                 {$_GET['extra']}
                 order by $a_order";
  }
  else {
    $query = "select overleg.id, overleg.organisatie_factuur, patient_code, datum, patient.naam, voornaam, deelvzw from overleg, patient inner join gemeente on patient.gem_id = gemeente.id
               where code = patient_code and afgerond = 1 and controle = 1 and (keuze_vergoeding = 1)
                 and datum >= $beginOrganisatieVergoeding
                 and (genre is null or genre = 'gewoon')
                 {$_GET['extra']}
                 order by $a_order";
  }


	//print($query);





    if ($result=mysql_query($query)){

        

        $teller = 0;

        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            $teller++;



			//print_r($records);





            $veldpat_code=($records['patient_code']!="")?					$records['patient_code']:"";

            $veldpat_datum=($records['datum']!="")?						$records['datum']:"";

            $veldpat_naam=($records['naam']!="")?					$records['naam']:"";

            $veldpat_voornaam=($records['voornaam']!="")?			$records['voornaam']:"";



            if ($records['organisatie_factuur']=="")

              $afdrukinfo = "-- nog niet opgevraagd --";

            else

              $afdrukinfo = "afgedrukt op {$records['organisatie_factuur']}";



            print("

                <tr>

                    <td>".$veldpat_datum."</td>

                    <td>".$veldpat_code."</td>
                    <td><strong>{$records['deelvzw']}</strong></td>

                    <td><a target=\"_blank\" href=\"$siteadresPDF/php/print_factuur_organisatie.php?id=".$records['id']."\">".$veldpat_naam." ".$veldpat_voornaam."</a></td>

                    <td>$afdrukinfo</td>

                </tr>

			");



            }

            print("</table>");

        }



    else{

		//print(mysql_error());

        

        Print ("Er werden geen records gevonden");



		print(mysql_error());

    }

?>
<hr/>
<p>Of zoek naar uittreksels voor een bepaalde organisator.</p>
<form method="get" name="f">
<select name="organisator">
<?php
$qryOrgs = "select distinct org.naam, org.id from organisatie org, logins
            where logins.organisatie = org.id
              and (profiel = 'OC' or profiel ='rdc')
            order by org.naam";
$resultOrgs = mysql_query($qryOrgs) or die(mysql_error());
for ($i=0; $i<mysql_num_rows($resultOrgs);$i++) {
  $rij = mysql_fetch_assoc($resultOrgs);
  if ($_GET['organisator']==$rij['id']) {
    $selected = " selected=\"selected\" ";
  }
  else {
    $selected = "";
  }
  print("<option value=\"{$rij['id']}\" $selected>{$rij['naam']}</option>\n");
}
$qryPersonen = "select hulpverleners.id, hulpverleners.naam, voornaam, organisatie.genre from overleg, hulpverleners left join organisatie on hulpverleners.organisatie = organisatie.id
                where overleg.toegewezen_genre = 'hulp' and overleg.toegewezen_id = hulpverleners.id order by naam";
$resultPersonen = mysql_query($qryPersonen) or die(mysql_error());
for ($i=0; $i<mysql_num_rows($resultPersonen);$i++) {
  $rij = mysql_fetch_assoc($resultPersonen);
  if ($_GET['organisator']==-$rij['id']) {
    $selected = " selected=\"selected\" ";
  }
  else {
    $selected = "";
  }
  print("<option value=\"-{$rij['id']}\" $selected>{$rij['naam']} {$rij['voornaam']} ({$rij['genre']})</option>\n");
}

?>
</select>
<input type="submit" value="zoek" />
</form>


<?php

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