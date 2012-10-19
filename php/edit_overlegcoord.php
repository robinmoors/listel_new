<?php

//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------



if (isset($_GET['listel']) && $_GET['listel']==1) {

   $paginanaam="Listelcoordinator aanpassen";

   $paginatitel="Gegevens Listelco&ouml;rdinator";

   $profielLogin = "listel";

}
else if (isset($_GET['menos']) && $_GET['menos']==1) {
   $paginanaam="Menoscoordinator aanpassen";
   $paginatitel="Gegevens Menosco&ouml;rdinator";
   $profielLogin = "menos";
}
else if (isset($_GET['tp'])) {

   $paginanaam="Projectcoordinator aanpassen";

   $paginatitel="Gegevens projectco&ouml;rdinator";

   if ($_GET['tp'] == "hoofd") {

     $profielLogin = "hoofdproject";

     $hoofdSelected = "checked=\"checked\"";

   }

   else {

     $profielLogin = "bijkomend project";

     $bijkomendSelected = "checked=\"checked\"";

   }

}

else if (isset($_GET['caw']) && $_GET['caw']==1) {

   $paginanaam="CAW-coordinator aanpassen";

   $paginatitel="Gegevens CAW-co&ouml;rdinator";

   $profielLogin = "caw";

}

else if (isset($_GET['rdc']) && $_GET['rdc']==1) {

   $paginanaam="RDC-coordinator aanpassen";

   $paginatitel="Gegevens RDC-co&ouml;rdinator";

   $profielLogin = "rdc";

}
else if (isset($_GET['ziekenhuis']) && $_GET['ziekenhuis']==1) {
   $paginanaam="Ziekenhuislogin aanpassen";
   $paginatitel="Gegevens Ziekenhuislogin";
   $profielLogin = "ziekenhuis";
}
else if (isset($_GET['psy']) && $_GET['psy']==1) {
   $paginanaam="Overlegcoordinator psychiatrische patienten aanpassen";
   $paginatitel="Gegevens overlegc&ouml;ordinator psychiatrische pati&euml;nten";
   $profielLogin = "psy";
}
else {

   $paginanaam="Overlegcoordinator aanpassen";

   $paginatitel="Gegevens overlegco&ouml;rdinator";

   $profielLogin = "OC";

}

   if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel")){

      

      require("../includes/html_html.inc");



      print("<head>");

      print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");



      require("../includes/html_head.inc");



//------------------------------------------------------------

// Postcodelijst Opstellen voor javascript

//------------------------------------------------------------

	print("<script type=\"text/javascript\">");

	$query = "

		SELECT

			dlzip,dlnaam,id

		FROM

      gemeente

    ORDER BY

			dlzip";



	if ($result=mysql_query($query)){

		

		print ("var gemeenteList = Array(");

		for ($i=0; $i < mysql_num_rows ($result); $i++){

			

			$records= mysql_fetch_array($result);

			print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");



		}



      print ("\"9999 onbekend\",\"9999\");");

      }

   print("</script>");

//----------------------------------------------------------

// Einde Postcodelijst Opstellen voor javascript

//----------------------------------------------------------



      print("</head>");

      print("<body onload=\"hideCombo('IIPostCodeS')\">");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");



      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");



      print("<div class=\"contents\">");



      require("../includes/menu.inc");



      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");





if( isset($_GET['a_overlcrd_delId']) && isset($_GET['backpage'])  ){

  if (isset($_GET['listel']) && $_GET['listel'] == 1) {

    $backpage = $_GET['backpage'] . "?listel=1";

  }
  if (isset($_GET['menos']) && $_GET['menos'] == 1) {
    $backpage = $_GET['backpage'] . "?menos=1";
  }
  else if (isset($_GET['tp'])) {

    $backpage = $_GET['backpage'] . "?tp=" . $_GET['tp'];

  }

  else if (isset($_GET['caw']) && $_GET['caw'] == 1) {

    $backpage = $_GET['backpage'] . "?caw=1";

  }

  else if (isset($_GET['rdc']) && $_GET['rdc'] == 1) {
    $backpage = $_GET['backpage'] . "?rdc=1";
  }
  else if (isset($_GET['za']) && $_GET['za'] == 1) {
    $backpage = $_GET['backpage'] . "?za=1";
  }
  else if (isset($_GET['ziekenhuis']) && $_GET['ziekenhuis'] == 1) {
    $backpage = $_GET['backpage'] . "?ziekenhuis=1";
  }
  else if (isset($_GET['psy']) && $_GET['psy'] == 1) {
    $backpage = $_GET['backpage'] . "?psy=1";
  }
  else {

    $backpage = $_GET['backpage'];

  }

  if (isset($_GET['za']) && $_GET['za'] == 1) {
    changeActive($_GET['a_overlcrd_delId'], $backpage);
  }
  else {
   	changeActive($_GET['a_overlcrd_delId'], $backpage, "logins");
  }






}

else{



//------------------------------------------------------------

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan 

// de tabel HULPVERLENERS toe te voegen of om een bestaande

// record van deze tabel aan te passen. Indien a_hvl_id per

// URL wordt doorgegeven dan moeten de gegevens aangepast

// worden anders wordt er een nieuwe record aangemaakt.

//------------------------------------------------------------



if (!isset($_POST['action'])){

	

	if (isset($_GET['a_overlcrd_id'])){

	//------------------------------------------------------------

	// Haal gegevens van hulpverlener op die voldoen

	//------------------------------------------------------------

		

		$action="Aanpassen";



if (isset($_GET['listel']) && $_GET['listel']==1) {

		$query = "

			SELECT

				o.id,

				o.naam AS onaam,

				o.voornaam,

				o.adres,

				o.gem_id,

				o.tel,

				o.fax,

				o.gsm,

				o.email,

				o.login,

				o.profiel,

				l.dlnaam,

				l.dlzip

			FROM

				logins o,

				gemeente l

			WHERE

				l.id=o.gem_id AND

				o.profiel = 'listel' AND

				o.id=".$_GET['a_overlcrd_id'];

}

else if (isset($_GET['tp'])) {

		$query = "

			SELECT

				o.id,

				o.naam AS onaam,

				o.voornaam,

				o.adres,

				o.gem_id,

				o.tel,

				o.fax,

				o.gsm,

				o.email,

				o.login,

        o.profiel,

        o.organisatie,

        o.tp_project,

				gemeente.dlnaam,

				gemeente.dlzip,

				organisatie.naam as orgNaam

			FROM

				(logins o left join gemeente on o.gem_id = gemeente.id) left join organisatie on o.organisatie = organisatie.id

			WHERE

				(o.profiel = 'hoofdproject' or o.profiel = 'bijkomend project') AND

				o.id=".$_GET['a_overlcrd_id'];

}
else if (isset($_GET['menos']) && $_GET['menos']==1) {
		$query = "
			SELECT
				o.id,
				o.naam AS onaam,
				o.voornaam,
				o.adres,
				o.gem_id,
				o.tel,
				o.fax,
				o.gsm,
				o.email,
				o.login,
				o.profiel,
				l.dlnaam,
				l.dlzip
			FROM
				logins o left join gemeente l on l.id = o.gem_id
			WHERE
				o.profiel = 'menos' AND
				o.id=".$_GET['a_overlcrd_id'];
}
else if (isset($_GET['caw']) && $_GET['caw']==1) {

		$query = "

			SELECT

				o.id,

				o.naam AS onaam,

				o.voornaam,

				o.adres,

				o.gem_id,

				o.tel,

				o.fax,

				o.gsm,

				o.email,

				o.login,

				o.profiel,

				l.dlnaam,

				l.dlzip

			FROM

				logins o,

				gemeente l

			WHERE

				l.id=o.gem_id AND

				o.profiel = 'caw' AND

				o.id=".$_GET['a_overlcrd_id'];

}
else if (isset($_GET['rdc']) && $_GET['rdc']==1) {
		$query = "
			SELECT
				o.id,
				o.naam AS onaam,
				o.voornaam,
				o.adres,
				o.gem_id,
				o.tel,
				o.fax,
				o.gsm,
				o.email,
				o.login,
        o.profiel,
        o.organisatie,
				gemeente.dlnaam,
				gemeente.dlzip,
				organisatie.naam as orgNaam
			FROM
				(logins o left join gemeente on o.gem_id = gemeente.id) left join organisatie on o.organisatie = organisatie.id
			WHERE
				(o.profiel = 'rdc') AND
				o.id=".$_GET['a_overlcrd_id'];
}
else if (isset($_GET['ziekenhuis']) && $_GET['ziekenhuis']==1) {
		$query = "
			SELECT
				o.id,
				o.naam AS onaam,
				o.voornaam,
				o.adres,
				o.gem_id,
				o.tel,
				o.fax,
				o.gsm,
				o.email,
				o.login,
        o.profiel,
        o.organisatie,
				gemeente.dlnaam,
				gemeente.dlzip,
				organisatie.naam as orgNaam
			FROM
				(logins o left join organisatie on o.organisatie = organisatie.id) left join gemeente on o.gem_id = gemeente.id
			WHERE
				(o.profiel = 'ziekenhuis') AND
				o.id=".$_GET['a_overlcrd_id'];
}
else if (isset($_GET['psy']) && $_GET['psy']==1) {
		$query = "
			SELECT
				o.id,
				o.naam AS onaam,
				o.voornaam,
				o.adres,
				o.gem_id,
				o.tel,
				o.fax,
				o.gsm,
				o.email,
				o.login,
        o.profiel,
        o.organisatie,
				gemeente.dlnaam,
				gemeente.dlzip,
				organisatie.naam as orgNaam
			FROM
				(logins o left join organisatie on o.organisatie = organisatie.id) left join gemeente on o.gem_id = gemeente.id
			WHERE
				(o.profiel = 'psy') AND
				o.id=".$_GET['a_overlcrd_id'];
}
else {

		$query = "

			SELECT

				o.id,  

				o.naam AS onaam,  

				o.voornaam,  

				o.adres,  

				o.gem_id,  

				o.tel,  

				o.fax,  

				o.gsm,  

				o.email,  

				o.sit_id,

        o.overleg_gemeente,

        o.login,

        o.profiel,

        s.nr,

				s.naam AS snaam,

				l.dlnaam,

				l.dlzip,
        o.organisatie,
        organisatie.naam as orgNaam
			FROM

				sit s,

				gemeente l,

				logins o left join organisatie on o.organisatie = organisatie.id

			WHERE

        o.profiel = 'oc' AND

        l.id=o.gem_id AND

				o.sit_id=s.id AND

				o.id=".$_GET['a_overlcrd_id'];

}

		$result = mysql_query($query);

		if (mysql_num_rows($result)<>0 ){

		//---------------------------------------------

		// een correcte record gevonden

		//---------------------------------------------

			

			$records= mysql_fetch_array($result);

			$valID=				$records['id'];

			$valNaam=			$records['onaam'];

			$valVoornaam=		$records['voornaam'];

			$valAdres=			$records['adres'];

			$valGemeente=		$records['dlzip']." ".$records['dlnaam'];

			$valTel=			$records['tel'];

			$valFax=			$records['fax'];

			$valGsm=			$records['gsm'];

			$valEmail=			$records['email'];

			$valsitid=			$records['sit_id'];

			$valOverlegGemeente = $records['overleg_gemeente'];

			$valLogin = $records['login'];

			$valOrganisatie = $records['organisatie'];

			$valOrganisatieNaam = $records['orgNaam'];

			$valProfiel = $records['profiel'];

			$valTP = $records['tp_project'];

      if ($valProfiel == "hoofdproject") {

        $hoofdSelected = "checked=\"checked\"";

        $bijkomendSelected = "";

      }

      else {

        $hoofdSelected = "";

        $bijkomendSelected = "checked=\"checked\"";

      }

		}



		else {

		//--------------------------------------------------

		// foute gegevens, geen record gevonden die voldeed

		//--------------------------------------------------

      	

      		print("Geen record gevonden");

      	}

	}



	else{

		

		$action="toevoegen";

		$valID="";

		$valNaam="";

		$valVoornaam="";

		$valAdres="";

		$valGemeente="";

		$valTel="";

		$valFax="";

		$valGsm="";

		$valEmail="";

		$valsitid="";

		$valOverlegGemeente = 9999;

	}

?>



<script language="javascript" src="../includes/formuliervalidatie.js">

</script>



<script language="javascript" type="text/javascript">

function checkAlles()

	{

	fouten = "";



	fouten = fouten + checkLeeg 	('editoverlcrdform', 'naam', 	'- Vul een naam in');

	fouten = fouten + checkLeeg 	('editoverlcrdform', 'voornaam', 	'- Vul een voornaam in');

	fouten = fouten + checkLeeg 	('editoverlcrdform', 'login', 	'- Vul een login in');





	return valideer();

	}

</script>





<form action="edit_overlegcoord.php" method="post" name="editoverlcrdform" onsubmit="return checkAlles();"  autocomplete="off">

   <fieldset>



      <div class="legende"><?= $paginatitel ?>:</div>

      <div>&nbsp;</div>





      <div class="label160">Naam<div class="reqfield">*</div>&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valNaam)?>"

            name="naam" />

      </div><!--Naam -->





      <div class="label160">Voornaam<div class="reqfield">*</div>&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valVoornaam)?>"

            name="voornaam" />

      </div><!--Voornaam -->











      <div class="label160" ondblclick="invoer('adres');invoerPC()">Adres&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valAdres)?>"

            name="adres" />

        <span  id="adres" style="display:none" ondblclick="invoer('adres');invoerPC();"></span>

      </div>





      <div class="inputItem" id="IIPostCode">

         <div class="label160" ondblclick="invoer('adres');invoerPC()">Postcode&nbsp;: </div>

         <div class="waarde">

            <span id="postcodeinvoer">

            <input

               onKeyUp="refreshList('editoverlcrdform','postCodeInput','overlcrd_gem_id',1,'IIPostCodeS',gemeenteList,20)"

               onmouseUp="showCombo('IIPostCodeS',100)"

               onfocus="showCombo('IIPostCodeS',100)"

               type="text"

               name="postCodeInput"

               id="postCodeInput"

               value="<?php print($valGemeente)?>"

            />

            <input

               type="button"

               onClick="resetList('editoverlcrdform','postCodeInput','overlcrd_gem_id',1,'IIPostCodeS',gemeenteList,20,100)"

               value="<<"

            />

           </span>

           <span id="postcodevast" ondblclick="invoer('adres');invoerPC();"></span>

         </div>

      </div>

      





      <div class="inputItem" id="IIPostCodeS">

         <div class="label160">Kies eventueel&nbsp;:</div>

         <div class="waarde">

            <select

               onClick="handleSelectClick('editoverlcrdform','postCodeInput','overlcrd_gem_id',1,'IIPostCodeS')"

               name="gem_id"

			   id="overlcrd_gem_id"

               size="5">

            </select>

         </div>

      </div><!--Adres -->













      <div class="label160" ondblclick="invoer('tel')">Telefoon&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valTel)?>"

            name="tel" />

        <span  id="tel" style="display:none" ondblclick="invoer('tel')"></span>

      </div><!--Telefoon -->





      <div class="label160" ondblclick="invoer('fax')">Fax&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valFax)?>"

            name="fax"/>

        <span  id="fax" style="display:none" ondblclick="invoer('fax')"></span>

      </div><!--Fax -->





      <div class="label160" ondblclick="invoer('gsm')">GSM&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valGsm)?>"

            name="gsm"/>

        <span  id="gsm" style="display:none" ondblclick="invoer('gsm')"></span>

      </div><!--GSM -->





		<div class="label160" ondblclick="invoer('email')">E-mail&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valEmail)?>"

            name="email"/>

        <span  id="email" style="display:none" ondblclick="invoer('email')"></span>

      </div><!--E-mail -->



<?php

  if ($profielLogin == "OC") {

?>

		<div class="label160">Werkend voor POP&nbsp;: </div>

         <div class="waarde">

            <select

               size="1"

               name="sit_id" />



<?php

//----------------------------------------------------------

// Vul Input select element vanuit dbase

//----------------------------------------------------------



      $query = "

         SELECT

            	s.id,  

				s.nr,  

				s.naam  

         FROM

            sit s

         ORDER BY

            s.nr

		";



      if ($result=mysql_query($query)){

         

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);



				$selected = ($valsitid == $records['id'])?"selected=\"selected\"":"";



            print ("

               <option value=\"".$records['id']."\" ".$selected.">".$records['nr']." ".$records['naam']."</option>\n");

            }

         }



//----------------------------------------------------------

?>



            </select>

         </div><!--Sit -->

		<div class="label160">Co&ouml;rdinator voor&nbsp;: </div>

         <div class="waarde">



<?php



if (isset($valsitid) && $valsitid != "") {

  $query_gem = "SELECT zip, gemeente.naam, count(*) as aantal FROM gemeente, logins

                WHERE gemeente.sit_id = logins.sit_id AND logins.id = ".$_GET['a_overlcrd_id']." AND logins.profiel = 'OC'

                GROUP BY  zip, gemeente.naam

                ORDER BY gemeente.naam ASC";

}

else {

  $query_gem = "SELECT zip, gemeente.naam, count(*) as aantal FROM gemeente

                where sit_id > 0

                GROUP BY  zip, gemeente.naam

                ORDER BY gemeente.naam ASC";

}

$result_gem = mysql_query($query_gem) or die(mysql_error());



echo "<select name=\"overleg_gemeente\" size=\"1\">";

// Gemeentes weergeven

echo "<option value=\"9999\">Onbepaald</option>";

while($gem = mysql_fetch_object($result_gem)) {

  if ($gem->zip == $valOverlegGemeente) $selected = " selected=\"selected\" ";

  else $selected = "";

	echo "<option value=\"".$gem->zip."\" $selected >".$gem->naam. " (" . $gem->aantal . " deelgemeentes) </option>";

}

echo "</select>";

print("      </div> <!-- overleg_gemeente -->\n");



}



if (!isset($_GET['listel']) && !isset($_GET['menos'])) {

  // toon organisatie

?>

<script type="text/javascript">

var organisaties = new Array();

function toonOrganisatie(nr) {

   verbergInvoer(nr, 'adres');

   verbergInvoer(nr, 'tel');

   verbergInvoer(nr, 'fax');

   verbergInvoer(nr, 'gsm');

   verbergInvoer(nr, 'email');

   toonPC(nr);

}



function startWaarde() {
<?php

   if ($valOrganisatie != "" && $valOrganisatie != 999 && $valOrganisatie != 1000) {

     if ($valAdres == "") {

       print("   verbergInvoer($valOrganisatie, 'adres');\n");

     }

     if ($valTel == "") {

       print("   verbergInvoer($valOrganisatie, 'tel');\n");

     }

     if ($valGsm == "") {

       print("   verbergInvoer($valOrganisatie, 'gsm');\n");

     }

     if ($valEmail == "") {

       print("   verbergInvoer($valOrganisatie, 'email');\n");

     }

     if ($valFax == "") {

       print("   verbergInvoer($valOrganisatie, 'fax');\n");

     }

     if ($valGem2 == "" || $valGem2 == 9999) {

       print("   toonPC($valOrganisatie);");

     }

   }

?>

}



function verbergInvoer(nr,id) {

  document.editoverlcrdform.elements[id].value = "";

  document.getElementById(id).style.display='block';

  document.getElementById(id).innerHTML=organisaties[nr][id];

  document.editoverlcrdform.elements[id].style.display='none';

}

function invoer(id) {

  document.editoverlcrdform.elements[id].value = "";

  document.getElementById(id).style.display='none';

  document.editoverlcrdform.elements[id].style.display='block';

}



function zoekGemeente(nr) {

   for (i=1; i< gemeenteList.length; i=i+2) {

     if (nr == gemeenteList[i])

       return gemeenteList[i-1];

   }

}

function toonPC(nr) {

 gemeente = zoekGemeente(organisaties[nr]['gem_id']);

 selectObj = document.editoverlcrdform.gem_id;

 selectObj.length = 0;  // maak selectlijst leeg

 selectObj[0] = new Option(gemeente,organisaties[nr]['gem_id']);

 selectObj[1] = new Option("Onbepaald",9999);

 selectObj.options[1].selected = true;

 //handleSelectClick('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS')

 //alert(1);

 document.getElementById("postcodeinvoer").style.display='none';

 document.getElementById("postcodevast").style.display='block';

 document.getElementById("postcodevast").innerHTML=gemeente;

 document.editoverlcrdform.elements['postCodeInput'].value = gemeente;

}



function invoerPC(id) {

 selectObj = document.editoverlcrdform.gem_id;

 selectObj.options[0].selected = true;

  document.getElementById("postcodeinvoer").style.display='block';

  document.getElementById("postcodevast").style.display='none';

}

</script>



<?php

        //-----------------------------------------------------------

 if (isset($_GET['tp'])) {

   $orgGenre = " and (genre = 'HVL' or genre = 'XVL' or genre = 'XVLP' or genre = 'XVLNP' or genre is NULL) ";

 }
 else if (isset($_GET['ziekenhuis'])) {

   $orgGenre = " ";

 }
 else if (isset($_GET['psy'])) {

   $orgGenre = " ";

 }
 else {

   $orgGenre = " and (genre = 'HVL' or genre is NULL) ";

 }



  toonZoekOrganisatie("editoverlcrdform", $valOrganisatieNaam, "$orgGenre", "toonOrganisatie(\$F('organisatie'));");



?>

  

<script language="javascript">

var origineel = new Array();

origineel['organisatie'] = document.editoverlcrdform.organisatie.selectedIndex;

</script>



<?php
}
  if (isset($_GET['tp'])) {
  // toon profiel

?>

      <div class="label160"><div class="reqfield">*</div>Profiel &nbsp;: </div>

      <div class="waarde">

<?php

  if ($_SESSION['profiel']=="listel" || ($_SESSION['profiel']=="hoofdproject" && ($_SESSION['usersid']==$_GET['a_overlcrd_id']))) {

?>

         <input type="radio" name="profiel" value="hoofdproject" <?= $hoofdSelected ?> /> Hoofdprojectco&ouml;rdinator

         <br />

<?php

  }

  else if (!isset($_POST['action'])) {

     $bijkomendSelected = " checked=\"checked\"";

  }

?>         <input type="radio" name="profiel" value="bijkomend project" <?= $bijkomendSelected ?> /> Bijkomende co&ouml;rdinator

         <br />&nbsp;

      </div>



      <div class="label160"><div class="reqfield">*</div>Therapeutisch project &nbsp;: </div>

      <div class="waarde">

        <select name="tp_project">

<?php



 // therapeutisch project

 if ($_SESSION['profiel'] == "listel") {

   $qryTP = "select id, nummer, naam from tp_project";

 }

 else {

   $qryTP = "select id, nummer, naam from tp_project where id={$_SESSION['tp_project']}";

 }

 $resultTP = mysql_query($qryTP);

 for ($i=0; $i < mysql_num_rows($resultTP); $i++) {

    $recordTP = mysql_fetch_array($resultTP);

    if ($recordTP['id'] == $_GET['tp_project'] ||$recordTP['id'] == $valTP) {

      $selected = " selected=\"selected\" ";

    }

    else {

      $selected = "";

    }

    print("<option value=\"{$recordTP['id']}\" $selected >" . tp_roepnaam($recordTP) . "</option>\n");

 }

 



?>

        </select>

      </div>

<?php

}
else if ($_GET['rdc']==1) {
  print("<input type=\"hidden\"  name=\"profiel\" value=\"$profielLogin\" />");
}
else {

  print("<input type=\"hidden\"  name=\"profiel\" value=\"$profielLogin\" />");
}
?>

      <div class="label160"><div class="reqfield">*</div>Login&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valLogin)?>"

            name="login" />

      </div><!--login -->

      

      <div class="label160">Verander paswoord&nbsp;: </div>

      <div class="waarde">

         <input

            type="checkbox"

            value="1"

            name="setpasswd"

            onclick="if (this.checked) document.getElementById('pwd').style.visibility = 'visible'; else document.getElementById('pwd').style.visibility = 'hidden'; " />

      </div><!--pwd -->

    <div id="pwd" classs="waarde" style="visibility:hidden">

      <div class="label160">Nieuw paswoord&nbsp;: </div>

      <div class="waarde">

         <input

            type="password"

            name="passwd1" />

      </div><!--pwd1 -->

      <div class="label160">Nieuw paswoord (herhaling)&nbsp;: </div>

      <div class="waarde">

         <input

            type="password"

            name="passwd2" />

      </div><!--pwd2 -->

<!--

          Vul hier uw <b>2x</b> het nieuwe paswoord in. <br />

          (Een oud paswoord kunnen we niet ophalen<br /> omdat het versleuteld bewaard wordt.)<br />

-->

    </div>

<?php
  if ($profielLogin != "listel" && $profielLogin != "caw" && $profielLogin != "ziekenhuis" && $valID >0) {
    switch ($profielLogin) {
        case "OC":
          $soort = "OC";
          $id = $valOverlegGemeente;
        break;
        case "menos":
          $soort = "menos";
          $id = 1;
        break;
        case "rdc":
          $soort = "rdc";
          $id = $valOrganisatie;
        break;
        case "psy":
          $soort = "psy";
          $id = $valID;
        break;
        case "hoofdproject":
        case "bijkomend project":
          $soort = "TP";
          $id = $valTP;
        break;
    }
?>
      <div class="label160">Organisator van &nbsp;: </div>
      <div class="waarde">
         <a href="patientenVoorOrganisator.php?naam=<?= $valNaam . " " . $valVoornaam ?>&soort=<?= $soort ?>&id=<?= $id ?>"><?php print(aantalPatientenVanOrganisator($soort, $id)) ?> pati&euml;nten</a>
      </div><!--aantal patienten -->
<?php
  }
?>

   </fieldset>

   <fieldset>



<script language="javascript">

function testPWD() {

   var f = document.editoverlcrdform;

   if (f.setpasswd.checked) {

     if (f.passwd1.value != f.passwd2.value) {

       alert("De paswoorden zijn niet gelijk!");

       return false;

     }

     else if (f.passwd1.value == "")

       alert("Het paswoord is niet ingevuld!");

   }

   return true;

}



</script>



      <div class="label160">Deze gegevens</div>

      <div class="waarde">

			<input type="hidden" name="action" value="<?php print($action)?>" />

			<input type="hidden" name="id" value="<?php print($valID)?>" />

         <input

            type="submit"

            value="<?php print($action)?>"

            onclick="return testPWD();" />

      </div><!--Button opslaan -->


   </fieldset>

</form>



<script type="text/javascript">document.forms['editoverlcrdform'].elements['naam'].focus();startWaarde();</script>



<?php

  if ($valOrganisatieNaam != "") {

   echo <<< EINDE

     <script type="text/javascript">
        document.editoverlcrdform.organisatieInput.value = "$valOrganisatieNaam";
        refreshListOveral('editoverlcrdform','organisatieInput','organisatie',1,'OrganisatieS',orgList,20);
     </script>

EINDE;

  }





}

else{



	

//----------------------------------------------------------

// Record wegschrijven

//----------------------------------------------------------

// Controle of sleutelvars ingegeven zijn voor wegschrijven

//----------------------------------------------------------



   if(isset($_POST['action']) && ($_POST['action']=="toevoegen") ){

      



	  	$gem_idfield=(!isset($_POST['gem_id']))?",":",gem_id,";

      $gem_idstring=(!isset($_POST['gem_id']))?",":",".$_POST['gem_id'].",";



      if (isset($_POST['overleg_gemeente']) && $_POST['overleg_gemeente']!= 9999) {

         $overleg_gemeenteVeld = " overleg_gemeente, ";

         $overleg_gemeenteWaarde = " {$_POST['overleg_gemeente']}, ";

      }

      

      if ($_POST['setpasswd']==1 && $_POST['passwd1'] != "" && $_POST['passwd1'] == $_POST['passwd2'])  {
         $passwdVeld = " paswoord, ";
         $passwdWaarde = " '" . shA1($_POST['passwd1']) . "', ";
      }

      if (isset($_POST['sit_id'])) {

         $sitVeld = " sit_id, ";

         $sitWaarde = " '" . $_POST['sit_id'] . "', ";

      }

      if (isset($_POST['organisatie'])) {

         $orgVeld = " organisatie, ";

         $orgWaarde = " '" . $_POST['organisatie'] . "', ";

      }

      if (isset($_POST['tp_project'])) {

         $tpVeld = " tp_project, ";

         $tpWaarde = " " . $_POST['tp_project'] . ", ";

      }

      



      $sql = "

         INSERT INTO

          logins

               (

					naam,

					voornaam,

					tel,

					fax,

					gsm,

					adres".

					$gem_idfield."

					email,

					$overleg_gemeenteVeld

          $passwdVeld

  	      $sitVeld

          $tpVeld

          $orgVeld

          login,

          profiel

               )

         VALUES

               (

               '".$_POST['naam']."',

               '".$_POST['voornaam']."',

               '".$_POST['tel']."',

               '".$_POST['fax']."',

               '".$_POST['gsm']."',

               '".$_POST['adres']."'

               ".$gem_idstring."

               '".$_POST['email']."',

               $overleg_gemeenteWaarde

               $passwdWaarde

               $sitWaarde

               $tpWaarde

               $orgWaarde

               '{$_POST['login']}',

               '{$_POST['profiel']}'

					)";

    }

   else{

      

		$gem_idstring=(!isset($_POST['gem_id']))?",":",gem_id=".$_POST['gem_id'].",";

      if (isset($_POST['overleg_gemeente']) && ($_POST['overleg_gemeente']!= 9999)) {

         $overleg_gemeenteVeld = " overleg_gemeente = {$_POST['overleg_gemeente']}, ";

      }

      if (isset($_POST['sit_id'])) {

         $sitVeld = " sit_id = {$_POST['sit_id']}, ";

      }

      if (isset($_POST['organisatie'])) {

         $orgVeld = " organisatie = {$_POST['organisatie']}, ";

      }

      if (isset($_POST['tp_project'])) {

         $tpVeld = " tp_project = {$_POST['tp_project']}, ";

      }



      if ($_POST['setpasswd']==1 && $_POST['passwd1'] != "" && $_POST['passwd1'] == $_POST['passwd2'])  {

         $passwdVeld = " paswoord = '" . shA1($_POST['passwd1']) . "', ";

      }



		$sql = "

         UPDATE

          logins



		SET

            naam='".$_POST['naam']."',

            voornaam='".$_POST['voornaam']."',

            tel='".$_POST['tel']."',

            fax='".$_POST['fax']."',

            gsm='".$_POST['gsm']."',

            adres='".$_POST['adres']."'

               ".$gem_idstring."

            email='".$_POST['email']."',

            profiel = '{$_POST['profiel']}',

            $overleg_gemeenteVeld

            $passwdVeld

            $sitVeld

            $tpVeld

            $orgVeld

            login = '{$_POST['login']}'



		WHERE

			id=".$_POST['id'];

	}



       if ($_POST['login'] != "") {

         if ($_POST['id']>0) {

           $zoekLogin = mysql_num_rows(mysql_query("select login from logins where login = '{$_POST['login']}' and id <> {$_POST['id']} and actief=1"));

         }

         else {

           $zoekLogin = mysql_num_rows(mysql_query("select login from logins where login = '{$_POST['login']}' and actief=1"));

         }

         $dubbel = ($zoekLogin > 0);



       }

       else {

         $dubbel = false;

       }



      if ($dubbel) {

   			print("We hebben deze persoon NIET aangemaakt omdat zijn login al in gebruik is.");

      }

      else if ( $result=mysql_query($sql) ){

   			print("Formuliergegevens zijn <b>succesvol ingevoegd</b>");

			if ($_POST['profiel']=="listel") $params = "?listel=1";
			else if (($_POST['profiel']=="hoofdproject") || ($_POST['profiel']=="bijkomend project")) $params = "?tp=1";
			else if ($_POST['profiel']=="caw") $params = "?caw=1";
			else if ($_POST['profiel']=="rdc") $params = "?rdc=1";
			else if ($_POST['profiel']=="menos") $params = "?menos=1";
			else if ($_POST['profiel']=="ziekenhuis") $params = "?ziekenhuis=1";
			else if ($_POST['profiel']=="psy") $params = "?psy=1";

			print("

				 <script>

				 function redirect()

					{

					document.location = \"lijst_overlegcoord.php{$params}\";

					}

				 setTimeout(\"redirect()\",500);

				 </script>

			 ");

	  }

      else{



         print("FormulierGegevens zijn <b>niet succesvol ingevoegd</b>,<br>");



		 print($sql);



	  }

}



}// einde IF ITEM OP NON-ACTIEF = ja



		



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

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------





//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>