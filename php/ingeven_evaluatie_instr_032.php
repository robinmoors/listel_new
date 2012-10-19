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
   $paginanaam="Evaluatieinstrument Stap 3.2.";
   if ($_SESSION['binnenViaCode'] || (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")))
      {
      include("../includes/html_html.inc");
      print("<head>");
      include("../includes/html_head.inc");
?>
<script type="text/javascript">
<!--
function checkRadios(){var melding="";
	waarde=""
	var radios= new Array("ei_032_08_s","ei_032_09_s","ei_032_10_s","ei_032_11_s","ei_032_13_s");
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
		$Var_ei_032_01_s="";
		$Var_ei_032_01_t="";
		$Var_ei_032_02_s="";
		$Var_ei_032_02_t="";
		$Var_ei_032_03_s="";
		$Var_ei_032_03_t="";
		$Var_ei_032_04_s="";
		$Var_ei_032_04_t="";
		$Var_ei_032_05_s="";
		$Var_ei_032_05_t="";
		$Var_ei_032_06_s="";
		$Var_ei_032_06_t="";
		$Var_ei_032_07_s="";
		$Var_ei_032_07_t="";
		$Var_ei_032_08_s="";
		$Var_ei_032_08_t="";
		$Var_ei_032_09_s="";
		$Var_ei_032_09_t="";
		$Var_ei_032_10_s="";
		$Var_ei_032_10_t="";
		$Var_ei_032_11_s="";
		$Var_ei_032_11_t="";
		$Var_ei_032_12_s="";
		$Var_ei_032_12_t="";
		$Var_ei_032_13_s="";
		$Var_ei_032_13_t="";
		$Var_ei_032_14_s="";
		$Var_ei_032_14_t="";
 // Reset values
		//------------------------------

		if((isset($_SESSION['action']))AND($_SESSION['action']=="Aanpassen"))
			{
			//---------------------------
			$qry="
				SELECT
					ei_032_01_s,ei_032_01_t,
					ei_032_02_s,ei_032_02_t,
					ei_032_03_s,ei_032_03_t,
					ei_032_04_s,ei_032_04_t,
					ei_032_05_s,ei_032_05_t,
					ei_032_06_s,ei_032_06_t,
					ei_032_07_s,ei_032_07_t,
					ei_032_08_s,ei_032_08_t,
					ei_032_09_s,ei_032_09_t,
					ei_032_10_s,ei_032_10_t,
					ei_032_11_s,ei_032_11_t,
					ei_032_12_s,ei_032_12_t,
					ei_032_13_s,ei_032_13_t,
					ei_032_14_s,ei_032_14_t
				FROM
					evalinstr
				WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
//			print($qry);
			$result=mysql_query($qry);
			$records=mysql_fetch_array($result); // Get record
			//---------------------------
			//-------------------------------------------------
			$Var_ei_032_01_s=$records['ei_032_01_s'];
			$Var_ei_032_01_t=$records['ei_032_01_t'];
			$Var_ei_032_02_s=$records['ei_032_02_s'];
			$Var_ei_032_02_t=$records['ei_032_02_t'];
			$Var_ei_032_03_s=$records['ei_032_03_s'];
			$Var_ei_032_03_t=$records['ei_032_03_t'];
			$Var_ei_032_04_s=$records['ei_032_04_s'];
			$Var_ei_032_04_t=$records['ei_032_04_t'];
			$Var_ei_032_05_s=$records['ei_032_05_s'];
			$Var_ei_032_05_t=$records['ei_032_05_t'];
			$Var_ei_032_06_s=$records['ei_032_06_s'];
			$Var_ei_032_06_t=$records['ei_032_06_t'];
			$Var_ei_032_07_s=$records['ei_032_07_s'];
			$Var_ei_032_07_t=$records['ei_032_07_t'];
			$Var_ei_032_08_s=$records['ei_032_08_s'];
			$Var_ei_032_08_t=$records['ei_032_08_t'];
			$Var_ei_032_09_s=$records['ei_032_09_s'];
			$Var_ei_032_09_t=$records['ei_032_09_t'];
			$Var_ei_032_10_s=$records['ei_032_10_s'];
			$Var_ei_032_10_t=$records['ei_032_10_t'];
			$Var_ei_032_11_s=$records['ei_032_11_s'];
			$Var_ei_032_11_t=$records['ei_032_11_t'];
			$Var_ei_032_12_s=$records['ei_032_12_s'];
			$Var_ei_032_12_t=$records['ei_032_12_t'];
			$Var_ei_032_13_s=$records['ei_032_13_s'];
			$Var_ei_032_13_t=$records['ei_032_13_t'];
			$Var_ei_032_14_s=$records['ei_032_14_s'];
			$Var_ei_032_14_t=$records['ei_032_14_t']; // Update values according to dbase
			//-------------------------------------------------
			}
?>
<!-- Start Formulier -->
<form action="ingeven_evaluatie_instr_032.php" method="post" name="evaluatieInstrForm" onsubmit="return checkRadios()">
   <fieldset>
      <div class="legende">3.2. Hygi&euml;nische verzorging</div>
      <div>&nbsp;</div>
      <div class="waarde">
            <table cellpadding="0" cellspacing="0">
				<tr>
					<th align="center">&nbsp;-&nbsp;</th>
					<th align="center">&nbsp;&plusmn;&nbsp;</th>
					<th align="center">&nbsp;+&nbsp;</th>
					<th align="center">&nbsp;NVT&nbsp;</th>
					<th>Item</th>
					<th>Bijkomende opmerkingen</th>
				</tr>
            <tr>
					<td colspan="6" class="titel">Wassen :</td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_01_s,"ei_032_01_s",1);
markselected($Var_ei_032_01_s,"ei_032_01_s",2);
markselected($Var_ei_032_01_s,"ei_032_01_s",3);
markselected($Var_ei_032_01_s,"ei_032_01_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Locatie</td>
					<td align="center"><input type="text"  name="ei_032_01_t" size="35" value="<?php print($Var_ei_032_01_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_02_s,"ei_032_02_s",1);
markselected($Var_ei_032_02_s,"ei_032_02_s",2);
markselected($Var_ei_032_02_s,"ei_032_02_s",3);
markselected($Var_ei_032_02_s,"ei_032_02_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Tijdstip</td>
					<td align="center"><input type="text"  name="ei_032_02_t" size="35" value="<?php print($Var_ei_032_02_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_03_s,"ei_032_03_s",1);
markselected($Var_ei_032_03_s,"ei_032_03_s",2);
markselected($Var_ei_032_03_s,"ei_032_03_s",3);
markselected($Var_ei_032_03_s,"ei_032_03_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Frequentie</td>
					<td align="center"><input type="text"  name="ei_032_03_t" size="35" value="<?php print($Var_ei_032_03_t);?>" /></td>
				</tr>
            <tr>
					<td colspan="6">&nbsp;</td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_04_s,"ei_032_04_s",1);
markselected($Var_ei_032_04_s,"ei_032_04_s",2);
markselected($Var_ei_032_04_s,"ei_032_04_s",3);
markselected($Var_ei_032_04_s,"ei_032_04_s",4);
?>
					<td>Haar- en baardverzorging</td>
					<td align="center"><input type="text"  name="ei_032_04_t" size="35" value="<?php print($Var_ei_032_04_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_05_s,"ei_032_05_s",1);
markselected($Var_ei_032_05_s,"ei_032_05_s",2);
markselected($Var_ei_032_05_s,"ei_032_05_s",3);
markselected($Var_ei_032_05_s,"ei_032_05_s",4);
?>
					<td>Hand- en voetverzorging</td>
					<td align="center"><input type="text"  name="ei_032_05_t" size="35" value="<?php print($Var_ei_032_05_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_06_s,"ei_032_06_s",1);
markselected($Var_ei_032_06_s,"ei_032_06_s",2);
markselected($Var_ei_032_06_s,"ei_032_06_s",3);
markselected($Var_ei_032_06_s,"ei_032_06_s",4);
?>
					<td>Tand- en mondverzorging</td>
					<td align="center"><input type="text"  name="ei_032_06_t" size="35" value="<?php print($Var_ei_032_06_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_07_s,"ei_032_07_s",1);
markselected($Var_ei_032_07_s,"ei_032_07_s",2);
markselected($Var_ei_032_07_s,"ei_032_07_s",3);
markselected($Var_ei_032_07_s,"ei_032_07_s",4);
?>
					<td>Prothesen</td>
					<td align="center"><input type="text"  name="ei_032_07_t" size="35" value="<?php print($Var_ei_032_07_t);?>" /></td>
				</tr>
            <tr class="verplicht">
					<td colspan="6" class="titel">Kleding :</td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_032_08_s,"ei_032_08_s",1);
markselected($Var_ei_032_08_s,"ei_032_08_s",2);
markselected($Var_ei_032_08_s,"ei_032_08_s",3);
markselected($Var_ei_032_08_s,"ei_032_08_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Aantrekken</td>
					<td align="center"><input type="text"  name="ei_032_08_t" size="35" value="<?php print($Var_ei_032_08_t);?>" /></td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_032_09_s,"ei_032_09_s",1);
markselected($Var_ei_032_09_s,"ei_032_09_s",2);
markselected($Var_ei_032_09_s,"ei_032_09_s",3);
markselected($Var_ei_032_09_s,"ei_032_09_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Uittrekken</td>
					<td align="center"><input type="text"  name="ei_032_09_t" size="35" value="<?php print($Var_ei_032_09_t);?>" /></td>
				</tr>
            <tr class="verplicht">
					<td colspan="6" class="titel">Voetbekleding :</td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_032_10_s,"ei_032_10_s",1);
markselected($Var_ei_032_10_s,"ei_032_10_s",2);
markselected($Var_ei_032_10_s,"ei_032_10_s",3);
markselected($Var_ei_032_10_s,"ei_032_10_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Aantrekken</td>
					<td align="center"><input type="text"  name="ei_032_10_t" size="35" value="<?php print($Var_ei_032_10_t);?>" /></td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_032_11_s,"ei_032_11_s",1);
markselected($Var_ei_032_11_s,"ei_032_11_s",2);
markselected($Var_ei_032_11_s,"ei_032_11_s",3);
markselected($Var_ei_032_11_s,"ei_032_11_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Uittrekken</td>
					<td align="center"><input type="text"  name="ei_032_11_t" size="35" value="<?php print($Var_ei_032_11_t);?>" /></td>
				</tr>
            <tr>
					<td colspan="6">&nbsp;</td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_12_s,"ei_032_12_s",1);
markselected($Var_ei_032_12_s,"ei_032_12_s",2);
markselected($Var_ei_032_12_s,"ei_032_12_s",3);
markselected($Var_ei_032_12_s,"ei_032_12_s",4);
?>
					<td>Incontinentie</td>
					<td align="center"><input type="text"  name="ei_032_12_t" size="35" value="<?php print($Var_ei_032_12_t);?>" /></td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_032_13_s,"ei_032_13_s",1);
markselected($Var_ei_032_13_s,"ei_032_13_s",2);
markselected($Var_ei_032_13_s,"ei_032_13_s",3);
markselected($Var_ei_032_13_s,"ei_032_13_s",4);
?>
					<td>Zorg dragen voor menstruatie</td>
					<td align="center"><input type="text"  name="ei_032_13_t" size="35" value="<?php print($Var_ei_032_13_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_032_14_s,"ei_032_14_s",1);
markselected($Var_ei_032_14_s,"ei_032_14_s",2);
markselected($Var_ei_032_14_s,"ei_032_14_s",3);
markselected($Var_ei_032_14_s,"ei_032_14_s",4);
?>
					<td>Individuele aandachtspunten</td>
					<td align="center"><input type="text"  name="ei_032_14_t" size="35" value="<?php print($Var_ei_032_14_t);?>" /></td>
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
					ei_032_01_s=".check4empty('ei_032_01_s').",ei_032_01_t='".$_POST['ei_032_01_t']."',
					ei_032_02_s=".check4empty('ei_032_02_s').",ei_032_02_t='".$_POST['ei_032_02_t']."',
					ei_032_03_s=".check4empty('ei_032_03_s').",ei_032_03_t='".$_POST['ei_032_03_t']."',
					ei_032_04_s=".check4empty('ei_032_04_s').",ei_032_04_t='".$_POST['ei_032_04_t']."',
					ei_032_05_s=".check4empty('ei_032_05_s').",ei_032_05_t='".$_POST['ei_032_05_t']."',
					ei_032_06_s=".check4empty('ei_032_06_s').",ei_032_06_t='".$_POST['ei_032_06_t']."',
					ei_032_07_s=".check4empty('ei_032_07_s').",ei_032_07_t='".$_POST['ei_032_07_t']."',
					ei_032_08_s=".check4empty('ei_032_08_s').",ei_032_08_t='".$_POST['ei_032_08_t']."',
					ei_032_09_s=".check4empty('ei_032_09_s').",ei_032_09_t='".$_POST['ei_032_09_t']."',
					ei_032_10_s=".check4empty('ei_032_10_s').",ei_032_10_t='".$_POST['ei_032_10_t']."',
					ei_032_11_s=".check4empty('ei_032_11_s').",ei_032_11_t='".$_POST['ei_032_11_t']."',
					ei_032_12_s=".check4empty('ei_032_12_s').",ei_032_12_t='".$_POST['ei_032_12_t']."',
					ei_032_13_s=".check4empty('ei_032_13_s').",ei_032_13_t='".$_POST['ei_032_13_t']."',
					ei_032_14_s=".check4empty('ei_032_14_s').",ei_032_14_t='".$_POST['ei_032_14_t']."'
				WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
//			print($qry);
			$result=mysql_query($qry); // Update record
		//-------------------------------
		//--------------------------------------
		print("<script type=\"text/javascript\">
		document.location=\"ingeven_evaluatie_instr_033.php\"
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