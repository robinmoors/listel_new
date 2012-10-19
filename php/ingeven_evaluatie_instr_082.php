<?php

//------------------------------------------------------------------------------

function markselected($fieldval,$fieldname,$value)

	{

	$selected=($fieldval==$value)?"checked=\"checked\"":"";

	print("<td align=\"center\"><input type=\"radio\" name=\"".$fieldname."\" 

	value=\"".$value."\" ".$selected." /></td>\n");

	}

function check4empty($PostValue)

	{$qrystring=(!isset($_POST[$PostValue]))?"0":$_POST[$PostValue];

	return $qrystring;}

//------------------------------------------------------------------------------

//------------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//------------------------------------------------------------



   session_start();

//	$_SESSION['overleg_id']=$_POST['overleg_id'];

   $paginanaam="Evaluatieinstrument Stap 8.2.";

   if ($_SESSION['binnenViaCode'] || (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")))

      {

      include("../includes/html_html.inc");

      print("<head>");

?>

<script type="text/javascript">

<!--

function checkRadios(){var melding="";

	waarde=""

	var radios= new Array("ei_082_01_s","ei_082_02_s","ei_082_03_s","ei_082_04_s","ei_082_05_s","ei_082_06_s","ei_082_07_s","ei_082_08_s","ei_082_10_s","ei_082_11_s","ei_082_12_s","ei_082_13_s","ei_082_14_s","ei_082_16_s","ei_082_17_s","ei_082_18_s","ei_082_19_s","ei_082_20_s","ei_082_21_s");

	for (var radio=0;radio<radios.length;radio++)

		{radioObj=eval("document.forms['evaluatieInstrForm'].elements['"+radios[radio]+"']");

   	for(var i = 0; i < radioObj.length; i++)

      	{if(radioObj[i].checked)

         	{var waarde=radioObj[i].value;

				i=radioObj.length;}}

		if (waarde!="")

			{melding=melding+radios[radio]+" - "+waarde+"\n";

			var ingevuld=true;

			waarde="";}

		else {melding="U heeft iets niet ingegeven";

			var ingevuld=false;

			i=radioObj.length;

			radio=radios.length;}}

	if (!ingevuld)

		{alert(melding);

		return false;}

	else {return true;}}

//-->

</script>

<?php

      include("../includes/html_head.inc");
?>
<style type="text/css">
.mainblock {
  height:1000px;
}
</style>

<?php
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

//		print($_SESSION['overleg_id']);



switch(true)

	{

	case(!(isset($_POST['action']))):

		//------------------------------

		$Var_ei_082_01_s="";

		$Var_ei_082_01_t="";

		$Var_ei_082_02_s="";

		$Var_ei_082_02_t="";

		$Var_ei_082_03_s="";

		$Var_ei_082_03_t="";

		$Var_ei_082_04_s="";

		$Var_ei_082_04_t="";

		$Var_ei_082_05_s="";

		$Var_ei_082_05_t="";

		$Var_ei_082_06_s="";

		$Var_ei_082_06_t="";

		$Var_ei_082_07_s="";

		$Var_ei_082_07_t="";

		$Var_ei_082_08_s="";

		$Var_ei_082_08_t="";

		$Var_ei_082_09_s="";

		$Var_ei_082_09_t="";

		$Var_ei_082_10_s="";

		$Var_ei_082_10_t="";

		$Var_ei_082_11_s="";

		$Var_ei_082_11_t="";

		$Var_ei_082_12_s="";

		$Var_ei_082_12_t="";

		$Var_ei_082_13_s="";

		$Var_ei_082_13_t="";

		$Var_ei_082_14_s="";

		$Var_ei_082_14_t="";

		$Var_ei_082_15_s="";

		$Var_ei_082_15_t="";

		$Var_ei_082_16_s="";

		$Var_ei_082_16_t="";

		$Var_ei_082_17_s="";

		$Var_ei_082_17_t="";

		$Var_ei_082_18_s="";

		$Var_ei_082_18_t="";

		$Var_ei_082_19_s="";

		$Var_ei_082_19_t="";

		$Var_ei_082_20_s="";

		$Var_ei_082_20_t="";

		$Var_ei_082_21_s="";

		$Var_ei_082_21_t="";

		$Var_ei_082_22_s="";

		$Var_ei_082_22_t="";

		$Var_ei_082_23_s="";

		$Var_ei_082_23_t="";

		$Var_ei_082_24_s="";

		$Var_ei_082_24_t="";

		$Var_ei_082_25_s="";

		$Var_ei_082_25_t="";

		$Var_ei_082_26_s="";

		$Var_ei_082_26_t="";

		$Var_ei_082_27_s="";

		$Var_ei_082_27_t="";

 // Reset values

		//------------------------------



		if((isset($_SESSION['action']))AND($_SESSION['action']=="Aanpassen"))

			{

			//---------------------------

			$qry="

				SELECT

					ei_082_01_s,ei_082_01_t,

					ei_082_02_s,ei_082_02_t,

					ei_082_03_s,ei_082_03_t,

					ei_082_04_s,ei_082_04_t,

					ei_082_05_s,ei_082_05_t,

					ei_082_06_s,ei_082_06_t,

					ei_082_07_s,ei_082_07_t,

					ei_082_08_s,ei_082_08_t,

					ei_082_09_s,ei_082_09_t,

					ei_082_10_s,ei_082_10_t,

					ei_082_11_s,ei_082_11_t,

					ei_082_12_s,ei_082_12_t,

					ei_082_13_s,ei_082_13_t,

					ei_082_14_s,ei_082_14_t,

					ei_082_15_s,ei_082_15_t,

					ei_082_16_s,ei_082_16_t,

					ei_082_17_s,ei_082_17_t,

					ei_082_18_s,ei_082_18_t,

					ei_082_19_s,ei_082_19_t,

					ei_082_20_s,ei_082_20_t,

					ei_082_21_s,ei_082_21_t,

					ei_082_22_s,ei_082_22_t,

					ei_082_23_s,ei_082_23_t,

					ei_082_24_s,ei_082_24_t,

					ei_082_25_s,ei_082_25_t,

					ei_082_26_s,ei_082_26_t,

					ei_082_27_s,ei_082_27_t

				FROM

					evalinstr

				WHERE

                    ei_id = {$_SESSION['evalinstr_id']}";

//			print($qry);

			$result=mysql_query($qry);

			$records=mysql_fetch_array($result); // Get record

			//---------------------------

			//-------------------------------------------------

			$Var_ei_082_01_s=$records['ei_082_01_s'];

			$Var_ei_082_01_t=$records['ei_082_01_t'];

			$Var_ei_082_02_s=$records['ei_082_02_s'];

			$Var_ei_082_02_t=$records['ei_082_02_t'];

			$Var_ei_082_03_s=$records['ei_082_03_s'];

			$Var_ei_082_03_t=$records['ei_082_03_t'];

			$Var_ei_082_04_s=$records['ei_082_04_s'];

			$Var_ei_082_04_t=$records['ei_082_04_t'];

			$Var_ei_082_05_s=$records['ei_082_05_s'];

			$Var_ei_082_05_t=$records['ei_082_05_t'];

			$Var_ei_082_06_s=$records['ei_082_06_s'];

			$Var_ei_082_06_t=$records['ei_082_06_t'];

			$Var_ei_082_07_s=$records['ei_082_07_s'];

			$Var_ei_082_07_t=$records['ei_082_07_t'];

			$Var_ei_082_08_s=$records['ei_082_08_s'];

			$Var_ei_082_08_t=$records['ei_082_08_t'];

			$Var_ei_082_09_s=$records['ei_082_09_s'];

			$Var_ei_082_09_t=$records['ei_082_09_t'];

			$Var_ei_082_10_s=$records['ei_082_10_s'];

			$Var_ei_082_10_t=$records['ei_082_10_t'];

			$Var_ei_082_11_s=$records['ei_082_11_s'];

			$Var_ei_082_11_t=$records['ei_082_11_t'];

			$Var_ei_082_12_s=$records['ei_082_12_s'];

			$Var_ei_082_12_t=$records['ei_082_12_t'];

			$Var_ei_082_13_s=$records['ei_082_13_s'];

			$Var_ei_082_13_t=$records['ei_082_13_t'];

			$Var_ei_082_14_s=$records['ei_082_14_s'];

			$Var_ei_082_14_t=$records['ei_082_14_t']; 

			$Var_ei_082_15_s=$records['ei_082_15_s'];

			$Var_ei_082_15_t=$records['ei_082_15_t']; 

			$Var_ei_082_16_s=$records['ei_082_16_s'];

			$Var_ei_082_16_t=$records['ei_082_16_t']; 

			$Var_ei_082_17_s=$records['ei_082_17_s'];

			$Var_ei_082_17_t=$records['ei_082_17_t']; 

			$Var_ei_082_18_s=$records['ei_082_18_s'];

			$Var_ei_082_18_t=$records['ei_082_18_t']; 

			$Var_ei_082_19_s=$records['ei_082_19_s'];

			$Var_ei_082_19_t=$records['ei_082_19_t']; 

			$Var_ei_082_20_s=$records['ei_082_20_s'];

			$Var_ei_082_20_t=$records['ei_082_20_t']; 

			$Var_ei_082_21_s=$records['ei_082_21_s'];

			$Var_ei_082_21_t=$records['ei_082_21_t']; 

			$Var_ei_082_22_s=$records['ei_082_22_s'];

			$Var_ei_082_22_t=$records['ei_082_22_t']; 

			$Var_ei_082_23_s=$records['ei_082_23_s'];

			$Var_ei_082_23_t=$records['ei_082_23_t']; 

			$Var_ei_082_24_s=$records['ei_082_24_s'];

			$Var_ei_082_24_t=$records['ei_082_24_t']; 

			$Var_ei_082_25_s=$records['ei_082_25_s'];

			$Var_ei_082_25_t=$records['ei_082_25_t']; 

			$Var_ei_082_26_s=$records['ei_082_26_s'];

			$Var_ei_082_26_t=$records['ei_082_26_t']; 

			$Var_ei_082_27_s=$records['ei_082_27_s'];

			$Var_ei_082_27_t=$records['ei_082_27_t']; 

			// Update values according to dbase

			//-------------------------------------------------

			}

?>

<form action="ingeven_evaluatie_instr_082.php" method="post" name="evaluatieInstrForm" onsubmit="return checkRadios()">

   <fieldset>

      <div class="legende">8.2. Hulpmiddelen: producten en technologie <br/>voor persoonlijk gebruik dagelijks leven</div>

      <div>&nbsp;</div>

      <div class="waarde">

            <table cellpadding="0" cellspacing="0">

				<tr>

					<th valign="top" align="center">&nbsp;-&nbsp;</th>

					<th valign="top" align="center">&nbsp;&plusmn;&nbsp;</th>

					<th valign="top" align="center">&nbsp;+&nbsp;</th>

					<th valign="top" align="center">&nbsp;NVT&nbsp;</th>

					<th valign="top">Item</th>

					<th valign="top">Bijkomende opmerkingen</th>

				</tr>

            <tr class="verplicht">

					<td valign="top" colspan="6" class="titel">Slapen / Rusten</td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_01_s,"ei_082_01_s",1);

markselected($Var_ei_082_01_s,"ei_082_01_s",2);

markselected($Var_ei_082_01_s,"ei_082_01_s",3);

markselected($Var_ei_082_01_s,"ei_082_01_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Speciale matras (gel, vezel)</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_01_t" size="35" value="<?php print($Var_ei_082_01_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_02_s,"ei_082_02_s",1);

markselected($Var_ei_082_02_s,"ei_082_02_s",2);

markselected($Var_ei_082_02_s,"ei_082_02_s",3);

markselected($Var_ei_082_02_s,"ei_082_02_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Decubitusmateriaal</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_02_t" size="35" value="<?php print($Var_ei_082_02_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_03_s,"ei_082_03_s",1);

markselected($Var_ei_082_03_s,"ei_082_03_s",2);

markselected($Var_ei_082_03_s,"ei_082_03_s",3);

markselected($Var_ei_082_03_s,"ei_082_03_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Bed / zijsponden</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_03_t" size="35" value="<?php print($Var_ei_082_03_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_04_s,"ei_082_04_s",1);

markselected($Var_ei_082_04_s,"ei_082_04_s",2);

markselected($Var_ei_082_04_s,"ei_082_04_s",3);

markselected($Var_ei_082_04_s,"ei_082_04_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Bedtafel</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_04_t" size="35" value="<?php print($Var_ei_082_04_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_05_s,"ei_082_05_s",1);

markselected($Var_ei_082_05_s,"ei_082_05_s",2);

markselected($Var_ei_082_05_s,"ei_082_05_s",3);

markselected($Var_ei_082_05_s,"ei_082_05_s",4);

?>

				<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Bedverhoger</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_05_t" size="35" value="<?php print($Var_ei_082_05_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_06_s,"ei_082_06_s",1);

markselected($Var_ei_082_06_s,"ei_082_06_s",2);

markselected($Var_ei_082_06_s,"ei_082_06_s",3);

markselected($Var_ei_082_06_s,"ei_082_06_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Oprichter</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_06_t" size="35" value="<?php print($Var_ei_082_06_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_07_s,"ei_082_07_s",1);

markselected($Var_ei_082_07_s,"ei_082_07_s",2);

markselected($Var_ei_082_07_s,"ei_082_07_s",3);

markselected($Var_ei_082_07_s,"ei_082_07_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Rugsteun</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_07_t" size="35" value="<?php print($Var_ei_082_07_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_08_s,"ei_082_08_s",1);

markselected($Var_ei_082_08_s,"ei_082_08_s",2);

markselected($Var_ei_082_08_s,"ei_082_08_s",3);

markselected($Var_ei_082_08_s,"ei_082_08_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Fixatiegordel</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_08_t" size="35" value="<?php print($Var_ei_082_08_t);?>" /></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_09_s,"ei_082_09_s",1);

markselected($Var_ei_082_09_s,"ei_082_09_s",2);

markselected($Var_ei_082_09_s,"ei_082_09_s",3);

markselected($Var_ei_082_09_s,"ei_082_09_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_09_t" size="35" value="<?php print($Var_ei_082_09_t);?>" /></td>

				</tr>

            <tr class="verplicht">

					<td colspan="6" class="titel">Verplaatsen</td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_10_s,"ei_082_10_s",1);

markselected($Var_ei_082_10_s,"ei_082_10_s",2);

markselected($Var_ei_082_10_s,"ei_082_10_s",3);

markselected($Var_ei_082_10_s,"ei_082_10_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Tillift</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_10_t" size="35" value="<?php print($Var_ei_082_10_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_11_s,"ei_082_11_s",1);

markselected($Var_ei_082_11_s,"ei_082_11_s",2);

markselected($Var_ei_082_11_s,"ei_082_11_s",3);

markselected($Var_ei_082_11_s,"ei_082_11_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Rolstoel</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_11_t" size="35" value="<?php print($Var_ei_082_11_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_12_s,"ei_082_12_s",1);

markselected($Var_ei_082_12_s,"ei_082_12_s",2);

markselected($Var_ei_082_12_s,"ei_082_12_s",3);

markselected($Var_ei_082_12_s,"ei_082_12_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Gaankader</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_12_t" size="35" value="<?php print($Var_ei_082_12_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_13_s,"ei_082_13_s",1);

markselected($Var_ei_082_13_s,"ei_082_13_s",2);

markselected($Var_ei_082_13_s,"ei_082_13_s",3);

markselected($Var_ei_082_13_s,"ei_082_13_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Vierpikkel / kruk</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_13_t" size="35" value="<?php print($Var_ei_082_13_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_14_s,"ei_082_14_s",1);

markselected($Var_ei_082_14_s,"ei_082_14_s",2);

markselected($Var_ei_082_14_s,"ei_082_14_s",3);

markselected($Var_ei_082_14_s,"ei_082_14_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Wandelstok</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_14_t" size="35" value="<?php print($Var_ei_082_14_t);?>" /></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_15_s,"ei_082_15_s",1);

markselected($Var_ei_082_15_s,"ei_082_15_s",2);

markselected($Var_ei_082_15_s,"ei_082_15_s",3);

markselected($Var_ei_082_15_s,"ei_082_15_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_15_t" size="35" value="<?php print($Var_ei_082_15_t);?>" /></td>

				</tr>

            <tr class="verplicht">

					<td colspan="6" class="titel">Toiletbezoek / incontinentie :</td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_16_s,"ei_082_16_s",1);

markselected($Var_ei_082_16_s,"ei_082_16_s",2);

markselected($Var_ei_082_16_s,"ei_082_16_s",3);

markselected($Var_ei_082_16_s,"ei_082_16_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Sonde / stoma</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_16_t" size="35" value="<?php print($Var_ei_082_16_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_17_s,"ei_082_17_s",1);

markselected($Var_ei_082_17_s,"ei_082_17_s",2);

markselected($Var_ei_082_17_s,"ei_082_17_s",3);

markselected($Var_ei_082_17_s,"ei_082_17_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Urinaal / bedpan</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_17_t" size="35" value="<?php print($Var_ei_082_17_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_18_s,"ei_082_18_s",1);

markselected($Var_ei_082_18_s,"ei_082_18_s",2);

markselected($Var_ei_082_18_s,"ei_082_18_s",3);

markselected($Var_ei_082_18_s,"ei_082_18_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;WC-stoel</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_18_t" size="35" value="<?php print($Var_ei_082_18_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_19_s,"ei_082_19_s",1);

markselected($Var_ei_082_19_s,"ei_082_19_s",2);

markselected($Var_ei_082_19_s,"ei_082_19_s",3);

markselected($Var_ei_082_19_s,"ei_082_19_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;WC-verhoger</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_19_t" size="35" value="<?php print($Var_ei_082_19_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_20_s,"ei_082_20_s",1);

markselected($Var_ei_082_20_s,"ei_082_20_s",2);

markselected($Var_ei_082_20_s,"ei_082_20_s",3);

markselected($Var_ei_082_20_s,"ei_082_20_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Grijpstaven</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_20_t" size="35" value="<?php print($Var_ei_082_20_t);?>" /></td>

				</tr>

            <tr class="verplicht">

<?php 

markselected($Var_ei_082_21_s,"ei_082_21_s",1);

markselected($Var_ei_082_21_s,"ei_082_21_s",2);

markselected($Var_ei_082_21_s,"ei_082_21_s",3);

markselected($Var_ei_082_21_s,"ei_082_21_s",4);

?>

					<td valign="top" rowspan="2">&nbsp;&nbsp;&bull;&nbsp;Incontinentiemateriaal<br />

					&nbsp;&nbsp;&nbsp;&nbsp;(onderleggers, luiers,<br/>

					&nbsp;&nbsp;&nbsp;&nbsp;conveen, broekjes)</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_21_t" size="35" value="<?php print($Var_ei_082_21_t);?>" /></td>

				</tr>

            <tr class="verplicht">

					<td valign="top" class="begincel" colspan="4"></td>

					<td valign="top" align="center"></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_22_s,"ei_082_22_s",1);

markselected($Var_ei_082_22_s,"ei_082_22_s",2);

markselected($Var_ei_082_22_s,"ei_082_22_s",3);

markselected($Var_ei_082_22_s,"ei_082_22_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_22_t" size="35" value="<?php print($Var_ei_082_22_t);?>" /></td>

				</tr>

            <tr>

					<td colspan="6" class="titel">Specifieke hulpmiddelen :</td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_23_s,"ei_082_23_s",1);

markselected($Var_ei_082_23_s,"ei_082_23_s",2);

markselected($Var_ei_082_23_s,"ei_082_23_s",3);

markselected($Var_ei_082_23_s,"ei_082_23_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Eten</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_23_t" size="35" value="<?php print($Var_ei_082_23_t);?>" /></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_24_s,"ei_082_24_s",1);

markselected($Var_ei_082_24_s,"ei_082_24_s",2);

markselected($Var_ei_082_24_s,"ei_082_24_s",3);

markselected($Var_ei_082_24_s,"ei_082_24_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Kleden</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_24_t" size="35" value="<?php print($Var_ei_082_24_t);?>" /></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_25_s,"ei_082_25_s",1);

markselected($Var_ei_082_25_s,"ei_082_25_s",2);

markselected($Var_ei_082_25_s,"ei_082_25_s",3);

markselected($Var_ei_082_25_s,"ei_082_25_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Vrijetijdsbesteding</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_25_t" size="35" value="<?php print($Var_ei_082_25_t);?>" /></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_26_s,"ei_082_26_s",1);

markselected($Var_ei_082_26_s,"ei_082_26_s",2);

markselected($Var_ei_082_26_s,"ei_082_26_s",3);

markselected($Var_ei_082_26_s,"ei_082_26_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Overige ...</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_26_t" size="35" value="<?php print($Var_ei_082_26_t);?>" /></td>

				</tr>

            <tr>

<?php 

markselected($Var_ei_082_27_s,"ei_082_27_s",1);

markselected($Var_ei_082_27_s,"ei_082_27_s",2);

markselected($Var_ei_082_27_s,"ei_082_27_s",3);

markselected($Var_ei_082_27_s,"ei_082_27_s",4);

?>

					<td valign="top">&nbsp;&nbsp;&bull;&nbsp;Specifieke hulpmiddelen<br />

					 &nbsp;&nbsp;&nbsp;&nbsp;voor ziekte of aandoening</td>

					<td valign="top" align="center"><input type="text"  name="ei_082_27_t" size="35" value="<?php print($Var_ei_082_27_t);?>" /></td>

				</tr>

            </table>

      </div>

   </fieldset>

	<fieldset>

		<div class="inputItem" id="IIButton">

         <div class="label220">Deze gegevens</div>

         <div class="waarde">

         <input type="submit" value="Opslaan" name="action" />

         </div> 

      </div><!--action-->

	</fieldset>

</form>

<!-- Einde Formulier -->

<?php

		break;

	case((isset($_POST['action']))AND($_POST['action']=="Opslaan")):

		//-------------------------------

		$qry="

				UPDATE evalinstr

				SET

					ei_082_01_s=".check4empty('ei_082_01_s').",ei_082_01_t='".$_POST['ei_082_01_t']."',

					ei_082_02_s=".check4empty('ei_082_02_s').",ei_082_02_t='".$_POST['ei_082_02_t']."',

					ei_082_03_s=".check4empty('ei_082_03_s').",ei_082_03_t='".$_POST['ei_082_03_t']."',

					ei_082_04_s=".check4empty('ei_082_04_s').",ei_082_04_t='".$_POST['ei_082_04_t']."',

					ei_082_05_s=".check4empty('ei_082_05_s').",ei_082_05_t='".$_POST['ei_082_05_t']."',

					ei_082_06_s=".check4empty('ei_082_06_s').",ei_082_06_t='".$_POST['ei_082_06_t']."',

					ei_082_07_s=".check4empty('ei_082_07_s').",ei_082_07_t='".$_POST['ei_082_07_t']."',

					ei_082_08_s=".check4empty('ei_082_08_s').",ei_082_08_t='".$_POST['ei_082_08_t']."',

					ei_082_09_s=".check4empty('ei_082_09_s').",ei_082_09_t='".$_POST['ei_082_09_t']."',

					ei_082_10_s=".check4empty('ei_082_10_s').",ei_082_10_t='".$_POST['ei_082_10_t']."',

					ei_082_11_s=".check4empty('ei_082_11_s').",ei_082_11_t='".$_POST['ei_082_11_t']."',

					ei_082_12_s=".check4empty('ei_082_12_s').",ei_082_12_t='".$_POST['ei_082_12_t']."',

					ei_082_13_s=".check4empty('ei_082_13_s').",ei_082_13_t='".$_POST['ei_082_13_t']."',

					ei_082_14_s=".check4empty('ei_082_14_s').",ei_082_14_t='".$_POST['ei_082_14_t']."',

					ei_082_15_s=".check4empty('ei_082_15_s').",ei_082_15_t='".$_POST['ei_082_15_t']."',

					ei_082_16_s=".check4empty('ei_082_16_s').",ei_082_16_t='".$_POST['ei_082_16_t']."',

					ei_082_17_s=".check4empty('ei_082_17_s').",ei_082_17_t='".$_POST['ei_082_17_t']."',

					ei_082_18_s=".check4empty('ei_082_18_s').",ei_082_18_t='".$_POST['ei_082_18_t']."',

					ei_082_19_s=".check4empty('ei_082_19_s').",ei_082_19_t='".$_POST['ei_082_19_t']."',

					ei_082_20_s=".check4empty('ei_082_20_s').",ei_082_20_t='".$_POST['ei_082_20_t']."',

					ei_082_21_s=".check4empty('ei_082_21_s').",ei_082_21_t='".$_POST['ei_082_21_t']."',

					ei_082_22_s=".check4empty('ei_082_22_s').",ei_082_22_t='".$_POST['ei_082_22_t']."',

					ei_082_23_s=".check4empty('ei_082_23_s').",ei_082_23_t='".$_POST['ei_082_23_t']."',

					ei_082_24_s=".check4empty('ei_082_24_s').",ei_082_24_t='".$_POST['ei_082_24_t']."',

					ei_082_25_s=".check4empty('ei_082_25_s').",ei_082_25_t='".$_POST['ei_082_25_t']."',

					ei_082_26_s=".check4empty('ei_082_26_s').",ei_082_26_t='".$_POST['ei_082_26_t']."',

					ei_082_27_s=".check4empty('ei_082_27_s').",ei_082_27_t='".$_POST['ei_082_27_t']."'

				WHERE

                    ei_id = {$_SESSION['evalinstr_id']}";

			//print($qry);

			$result=mysql_query($qry); // Update record

		//-------------------------------

		//--------------------------------------

		print("<script type=\"text/javascript\">

		document.location=\"ingeven_evaluatie_instr_09.php\"

		</script>"); // Redirect to next page

		//--------------------------------------

		break;

	case (true):

		print("<p>Foute toegang van deze pagina</p>");

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

/* Geen Toegang */

  if (!isset($_SESSION['binnenViaCode']) || !$_SESSION['binnenViaCode'])

     include("../includes/check_access.inc");

//---------------------------------------------------------

?>