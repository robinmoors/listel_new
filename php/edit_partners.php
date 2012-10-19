<?php

   session_start();

if ($_SESSION['profiel']=="listel") {

  $werkwoord = "aanpassen";

}

else {

  $werkwoord = "bekijken";

}

   $paginanaam="$werkwoord van Organisaties";

   if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      include("../includes/html_html.inc");

      print("<head>");

      include("../includes/html_head.inc");

    require("../includes/checkForNumbersOnly.inc");

    require("../includes/checkCheque.inc");

//------------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//------------------------------------------------------------



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

	if ($result=mysql_query($query))

		{

		print ("var gemeenteList = Array(");

		for ($i=0; $i < mysql_num_rows ($result); $i++)

			{

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

      include("../includes/header.inc");

      include("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      include("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");





//------------------------------------------------------------

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan 

// de tabel HULPVERLENERS toe te voegen of om een bestaande

// record van deze tabel aan te passen. Indien a_hvl_id per

// URL wordt doorgegeven dan moeten de gegevens aangepast

// worden anders wordt er een nieuwe record aangemaakt.

//------------------------------------------------------------





if ($_SESSION["profiel"]=="listel" && isset($_POST['wis']) && $_POST['wis']==1) {

      $a_partner_id =  $_POST['organisatie'];



			$query="

				update

           organisatie

        set

          actief = 0

        WHERE

					id=".$a_partner_id;



			$doe=mysql_query($query);

      if ($doe) {

        print("De organisatie is op non-actief gezet.");

  			print("

         <script>

         function redirect()

            {

            document.location = \"lijst_partners.php\";

            }

         setTimeout(\"redirect()\",500);

         </script>");

      }



}

else if (!isset($_POST['action']))

	{

  if (isset($_POST['a_partner_id'])) $a_partner_id =  $_POST['a_partner_id'];
  if (isset($_GET['a_partner_id'])) $a_partner_id =  $_GET['a_partner_id'];

  if (isset($_POST['organisatie'])) $a_partner_id =  $_POST['organisatie'];

	if (isset($a_partner_id))

	//------------------------------------------------------------

	// Haal gegevens van organisatie op die voldoen

	//------------------------------------------------------------

		{

		$action="Aanpassen";

		$query = "

			SELECT

				o.*,

        g.dlnaam,

				g.dlzip

			FROM

				organisatie o,

				gemeente g

			WHERE

				g.id=o.gem_id AND

				o.id=".$a_partner_id;

		$result = mysql_query($query);

		if (mysql_num_rows($result)<>0 )

		//---------------------------------------------

		// een correcte record gevonden

		//---------------------------------------------

			{

			$records= mysql_fetch_array($result);

			$valID=				$records['id'];

			$valNaam=			$records['naam'];

			$valHoofdzetel=	$records['hoofdzetel'];

			$valAdres=			$records['adres'];

			$valGemeente=		$records['dlzip']." ".$records['dlnaam'];

      $valReknr1=         substr($records['reknr'],0,3);

      $valReknr2=         substr($records['reknr'],4,7);

      $valReknr3=         substr($records['reknr'],12,2);

                $valBIC = $records['bic'];
                $valIBAN = $records['iban'];

                if ($valIBAN == "" && $valReknr1 > 0) {
                   // effe IBAN en BIC berekenen
                   $valBIC = bankcode2bic($valReknr1);

                   $eersteGetal = "{$valReknr3}{$valReknr3}111400";
                   $modulo97 = fmod($eersteGetal,97);
                   $controleIBAN = 98-$modulo97;
                   if ($controleIBAN < 10)
                     $valIBAN = "BE0" . "{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                   else
                     $valIBAN = "BE{$controleIBAN}{$valReknr1}{$valReknr2}{$valReknr3}";
                }


			$valTel=				$records['tel'];

			$valFax=				$records['fax'];

			$valGsm=				$records['gsm'];

			$valGemId = $records['gem_id'];

      $valEmail1 = $records['email_inhoudelijk'];

      $valContact1 = $records['contact_inhoudelijk'];

      $valEmail2 = $records['email_administratie'];

      $valContact2 = $records['contact_administratie'];

      if (isset($records['genre']))

        $valGenre = $records['genre'];

      else

        $valGenre = "onbepaald";



			}

		else 

		//--------------------------------------------------

		// foute gegevens, geen record gevonden die voldeed

		//--------------------------------------------------

      	{

      	print("Geen record gevonden $query");

      	}

		}

	else

		{

		$action="toevoegen";

		$valID="";

		$valNaam="";

		$valAdres="";

		$valGemeente="";

		$valTel="";

		$valFax="";

		$valGsm="";

		$valEmail="";

		$valGenre="onbepaald";

    $valGemId = -1;

		}

?>

<script language="javascript" src="../includes/formuliervalidatie.js">

</script>



<script language="javascript" type="text/javascript">

var gemeente = <?= $valGemId ?>;

function checkAlles()

	{

	fouten = "";



	fouten = fouten + checkLeeg 	('editpartnerform', 'partner_naam', 	'- Vul een naam in');

	//fouten = fouten + checkLeeg 	('editpartnerform', 'partner_adres', 	'- Vul een adres in');

	//if (gemeente == -1)

 //   fouten = fouten + checkLeeg 	('editpartnerform', 'partner_gem_id', 	'- Vul een postcode in');





	return valideer();

	}

</script>

<form action="edit_partners.php" method="post" name="editpartnerform" onSubmit="return checkAlles();" autocomplete="off">

   <fieldset>

      <div class="legende">Organisaties <?= $werkwoord ?>:</div>

      <div>&nbsp;</div>

      <div class="label220">Naam<div class="reqfield">*</div>&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="40"

            value="<?php print($valNaam)?>"

            name="partner_naam" />

      </div><!--Naam -->

      <div class="label220">Statuut<div class="reqfield">*</div>&nbsp;: </div>

      <div class="waarde">

         <input type="hidden" name="hoofdzetel" value="<?php print($valHoofdzetel)?>" />

         <input

            type="radio"

            onclick="document.editpartnerform.hoofdzetel.value=-1;"

            name="hoofdzetelradio" <?php if($valHoofdzetel==-1) print('checked="checked"'); ?>/> Hoofdzetel

         <br/>

         <input

            type="radio"  id="vestiging"

            onclick="document.editpartnerform.hoofdzetel.value=document.editpartnerform.hoofdzetelSelect.value;"

            name="hoofdzetelradio" <?php if($valHoofdzetel!=-1) print('checked="checked"'); ?>/> Vestiging van

   <select name="hoofdzetelSelect" size="1" style="font-size:9px;width:190px;"

           onchange="document.editpartnerform.hoofdzetel.value=document.editpartnerform.hoofdzetelSelect.value;document.getElementById('vestiging').checked='checked';">

     <option value="-1">-- selecteer een hoofdzetel --</option>

<?php

   $qryHoofdzetels = "select naam, id from organisatie where actief = 1 and hoofdzetel = -1 order by naam";

   $resultHoofdzetels = mysql_query($qryHoofdzetels) or die("$qryHoofdzetels geeft volgende fout <br/>" . mysql_error());

   for ($ii = 0; $ii < mysql_num_rows($resultHoofdzetels); $ii++) {

      $rijHoofdzetel = mysql_fetch_assoc($resultHoofdzetels);

      if ($rijHoofdzetel['id'] == $valHoofdzetel) $selected = " selected=\"selected\" ";

      else $selected = "";

      print("<option value=\"{$rijHoofdzetel['id']}\" $selected>{$rijHoofdzetel['naam']}</option>\n");

   }

?>

   </select>

   <br/>                               &nbsp;

      </div><!--Hoofdzetel of vestiging -->



      <div class="label220">Adres&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valAdres)?>"

            name="partner_adres" />

      </div>

      <div class="inputItem" id="IIPostCode">

         <div class="label220">Postcode&nbsp;: </div>

         <div class="waarde">

            <input

               onKeyUp="refreshList('editpartnerform','postCodeInput','partner_gem_id',1,'IIPostCodeS',gemeenteList,20)"

               onmouseUp="showCombo('IIPostCodeS',100)"

               onfocus="refreshList('editpartnerform','postCodeInput','partner_gem_id',1,'IIPostCodeS',gemeenteList,20)"

               type="text"

               name="postCodeInput"

               value="<?php print($valGemeente)?>">

            <input

               type="button"

               onClick="resetList('editpartnerform','postCodeInput','partner_gem_id',1,'IIPostCodeS',gemeenteList,20,100)"

               value="<<">

         </div>

      </div>

      <div class="inputItem" id="IIPostCodeS">

         <div class="label220">Kies eventueel&nbsp;:</div>

         <div class="waarde">

            <select

               onClick="handleSelectClick('editpartnerform','postCodeInput','partner_gem_id',1,'IIPostCodeS')"

               name="partner_gem_id"

               size="5">

            </select>

         </div>

      </div><!--Adres -->



    <div class="label220">Bankrekeningnummer&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="3" value="<?php print($valReknr1)?>" name="reknr1"

            onkeyup="checkForNumbersOnly(this,3,-1,1000,'editpartnerform','reknr2')" />

            &nbsp;-&nbsp;

        <input type="text" size="7" value="<?php print($valReknr2)?>" name="reknr2"

            onkeyup="checkForNumbersOnly(this,7,-1,10000000,'editpartnerform','reknr3')" />

            &nbsp;-&nbsp;

        <input type="text" size="2" value="<?php print($valReknr3)?>" name="reknr3"

            onkeyup="checkForNumbersOnly(this,2,-1,100,'editpartnerform','partner_tel')" onblur="checkCheque2();bankrek2iban('editpartnerform')" />

      </div><!--Bankrekening -->

    <div class="label220">IBAN&nbsp;: </div>
    <div class="waarde">
        <input type="text" size="34" value="<?php print($valIBAN)?>" name="IBAN"  onblur="iban2bankrek('editpartnerform');checkCheque();" />

      &nbsp;&nbsp;</div><!--IBAN -->


    <div class="label220">BIC&nbsp;: </div>
    <div class="waarde">
        <input type="text" size="34" value="<?php print($valBIC)?>" name="BIC" />

      &nbsp;&nbsp;</div><!--BIC -->


      <div class="label220">Tel. &nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valTel)?>"

            name="partner_tel"  />

      </div><!--Tel -->

      <div class="label220">Fax &nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valFax)?>"

            name="partner_fax"  />

      </div><!--Fax -->

      <div class="label220">GSM &nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valGsm)?>"

            name="partner_gsm" />

      </div><!--GSM -->

		<div class="label220">Contactpersoon inhoudelijk&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valContact1)?>"

            name="contact1" />

      </div><!--E-mail -->

		<div class="label220">E-mail van deze persoon&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valEmail1)?>"

            name="email1" />

      </div><!--E-mail -->

		<div class="label220">Contactpersoon administratief&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valContact2)?>"

            name="contact2" />

      </div><!--E-mail -->

		<div class="label220">E-mail van deze persoon&nbsp;: </div>

      <div class="waarde">

         <input

            type="text"

            size="35"

            value="<?php print($valEmail2)?>"

            name="email2" />

      </div><!--E-mail -->

      

		<div class="label220">Werkingsgebied&nbsp;: </div>

      <div class="waarde">

         <input

            type="radio"

            value="ZVL"

            <?php if ($valGenre=="ZVL") print("checked=\"checked\""); ?>

            name="genre" /> ZVL : Zorgverleners<br />

         <input

            type="radio"

            value="HVL"

            <?php if ($valGenre=="HVL") print("checked=\"checked\""); ?>

            name="genre" /> HVL : Hulpverleners opgenomen in GDT<br />

         <input

            type="radio"

            value="XVLP"

            <?php if ($valGenre=="XVLP") print("checked=\"checked\""); ?>

            name="genre" /> XVLP : Hulpverleners <strong>niet</strong> opgenomen in GDT<br />

         <input

            type="radio"

            value="XVLNP"

            <?php if ($valGenre=="XVLNP") print("checked=\"checked\""); ?>

            name="genre" /> XVLNP : niet-professionelen<br />

<!--
         <input
            type="radio"
            value="rdc"
            <?php if ($valGenre=="rdc") print("checked=\"checked\""); ?>
            name="genre" /> Regionaal Dienstencentrum<br />
-->
         <input

            type="radio"

            value="onbepaald"

            <?php if ($valGenre=="onbepaald" || $valGenre == "") print("checked=\"checked\""); ?>

            name="genre" /> Onbepaald <br />



      </div><!--E-mail -->

		<div class="label220">GGZ&nbsp;: </div>
      <div class="waarde">
         <input
            type="checkbox"
            value="1"
            <?php printChecked(1, $records['ggz']);?>
            name="partner_ggz" />
      </div>
		<div class="label220">Art. 107&nbsp;: </div>
      <div class="waarde">
         <input
            type="checkbox"
            value="1"
            <?php printChecked(1, $records['art107']);?>
            name="partner_art107" />
      </div>
		<div class="label220">Mobiele equipe&nbsp;: </div>
      <div class="waarde">
         <input
            type="checkbox"
            value="1"
            <?php printChecked(1, $records['mobiele_equipe']);?>
            name="partner_mobiele_equipe" />
      </div>

   </fieldset>

<?php

  if($_SESSION["profiel"]=="listel"){

?>

   <fieldset>

      <div class="label220">Deze gegevens</div>

      <div class="waarde">

			<input type="hidden" name="action" value="<?php print($action)?>" />

			<input type="hidden" name="partner_id" value="<?php print($valID)?>" />

         <input

            type="submit"

            value="<?php print($action)?>" />

      </div><!--Button opslaan -->

   </fieldset>

<?php

  }

?>

</form>



<?php

	}

else if ($_SESSION["profiel"]=="listel")

	{

//----------------------------------------------------------

// Record wegschrijven

//----------------------------------------------------------

// Controle of sleutelvars ingegeven zijn voor wegschrijven

//----------------------------------------------------------
   $partner_ggz=(!isset($_POST['partner_ggz']))?0:$_POST['partner_ggz'];
   $partner_art107=(!isset($_POST['partner_art107']))?0:$_POST['partner_art107'];
   $partner_mobiele_equipe=(!isset($_POST['partner_mobiele_equipe']))?0:$_POST['partner_mobiele_equipe'];

   if(IsSet($_POST['action'])&&($_POST['action']=="toevoegen"))

      {

		$partner_gem_idstring=(!isset($_POST['partner_gem_id']))?"":$_POST['partner_gem_id'].",";

		$partner_gem_idfield=(!isset($_POST['partner_gem_id']))?"":"gem_id,";



    if ($_POST['genre']!="onbepaald") {

      $veldGenre = ", genre";

      $waardeGenre = ", '{$_POST['genre']}'";

    }

      $sql = "

         INSERT INTO

          organisatie

               (

					naam,

					hoofdzetel,

					reknr,
					iban,
					bic,

					tel,

					fax,

					gsm,

					adres, ".

					$partner_gem_idfield."

					email_inhoudelijk,

          contact_inhoudelijk,

          email_administratie,

          contact_administratie,
          ggz,
          art107,
          mobiele_equipe

          $veldGenre

          

               )

         VALUES

               (

               '".$_POST['partner_naam']."',

			         '".$_POST['hoofdzetel']."',

			         \"{$_POST['reknr1']}-{$_POST['reknr2']}-{$_POST['reknr3']}\",
                '".$_POST['IBAN'].    "',
                '".$_POST['BIC'].   "',

               '".$_POST['partner_tel']."',

               '".$_POST['partner_fax']."',

               '".$_POST['partner_gsm']."',

               '".$_POST['partner_adres']."',

               ".$partner_gem_idstring."

               '{$_POST['email1']}',

               '{$_POST['contact1']}',

               '{$_POST['email2']}',

               '{$_POST['contact2']}',
               $partner_ggz,
               $partner_art107,
               $partner_mobiele_equipe

               $waardeGenre

         )";

      }

   else

      {

		$partner_gem_idupdate=(!isset($_POST['partner_gem_id']))?",":",gem_id=".$_POST['partner_gem_id'].",";

    if ($_POST['genre']=="onbepaald") {

      $waardeGenre = " NULL ";

    }

    else

      $waardeGenre = " '{$_POST['genre']}'";

		$sql = "

         UPDATE

          organisatie

			SET

				naam='".$_POST['partner_naam']."',

				hoofdzetel = {$_POST['hoofdzetel']},

			  reknr = \"{$_POST['reknr1']}-{$_POST['reknr2']}-{$_POST['reknr3']}\",
        iban = '".$_POST['IBAN'].    "',
        bic = '".$_POST['BIC'].   "',

				tel='".$_POST['partner_tel']."',

				fax='".$_POST['partner_fax']."',

				gsm='".$_POST['partner_gsm']."',

				adres='".$_POST['partner_adres']."'

				".$partner_gem_idupdate."

				contact_inhoudelijk ='{$_POST['contact1']}',

				email_inhoudelijk ='{$_POST['email1']}',

				contact_administratie ='{$_POST['contact2']}',

				email_administratie ='{$_POST['email2']}',
				ggz = $partner_ggz,
        art107 = $partner_art107,
        mobiele_equipe = $partner_mobiele_equipe,
				genre = $waardeGenre

			WHERE

				id=".$_POST['partner_id'];

		}

      if ($result=mysql_query($sql))

         {

			print("Formuliergegevens zijn <b>succesvol ingevoegd.</b>");

			print("

         <script>

         function redirect()

            {

            document.location = \"lijst_partners.php\";

            }

         setTimeout(\"redirect()\",500);

         </script>");

			}

      else

         {

			print("FormulierGegevens zijn <b>niet succesvol ingevoegd</b>,<br>".$sql);

			}

	}



		

		

		

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