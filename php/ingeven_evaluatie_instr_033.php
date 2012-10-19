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
   $paginanaam="Evaluatieinstrument Stap 3.3.";
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
	var radios= new Array("ei_033_01_s","ei_033_02_s","ei_033_05_s","ei_033_04_s");
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
switch(true)
	{
	case(!(isset($_POST['action']))):
		//------------------------------
			$Var_ei_033_01_s="";
		$Var_ei_033_01_t="";
		$Var_ei_033_02_s="";
		$Var_ei_033_02_t="";
		$Var_ei_033_03_s="";
		$Var_ei_033_03_t="";
		$Var_ei_033_04_s="";
		$Var_ei_033_04_t="";
		$Var_ei_033_05_s="";
		$Var_ei_033_05_t="";
		$Var_ei_033_06_s="";
		$Var_ei_033_06_t="";
		$Var_ei_033_07_s="";
		$Var_ei_033_07_t=""; 		
		$Var_ei_033_08_s="";
		$Var_ei_033_08_t="";// Reset values
		//------------------------------

		if((isset($_SESSION['action']))AND($_SESSION['action']=="Aanpassen"))
			{
			//---------------------------
			$qry="
				SELECT
					ei_033_01_s,ei_033_01_t,
					ei_033_02_s,ei_033_02_t,
					ei_033_03_s,ei_033_03_t,
					ei_033_04_s,ei_033_04_t,
					ei_033_05_s,ei_033_05_t,
					ei_033_06_s,ei_033_06_t,
					ei_033_07_s,ei_033_07_t,
					ei_033_08_s,ei_033_08_t
				FROM
					evalinstr
				WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
//			print($qry);
			$result=mysql_query($qry);
			$records=mysql_fetch_array($result); // Get record
			//---------------------------
			//-------------------------------------------------
				$Var_ei_033_01_s=$records['ei_033_01_s'];
			$Var_ei_033_01_t=$records['ei_033_01_t'];
			$Var_ei_033_02_s=$records['ei_033_02_s'];
			$Var_ei_033_02_t=$records['ei_033_02_t'];
			$Var_ei_033_03_s=$records['ei_033_03_s'];
			$Var_ei_033_03_t=$records['ei_033_03_t'];
			$Var_ei_033_04_s=$records['ei_033_04_s'];
			$Var_ei_033_04_t=$records['ei_033_04_t'];
			$Var_ei_033_05_s=$records['ei_033_05_s'];
			$Var_ei_033_05_t=$records['ei_033_05_t'];
			$Var_ei_033_06_s=$records['ei_033_06_s'];
			$Var_ei_033_06_t=$records['ei_033_06_t'];
			$Var_ei_033_07_s=$records['ei_033_07_s'];
			$Var_ei_033_07_t=$records['ei_033_07_t'];
			$Var_ei_033_08_s=$records['ei_033_08_s'];
			$Var_ei_033_08_t=$records['ei_033_08_t']; // Update values according to dbase
			//-------------------------------------------------
			}
?>
<form action="ingeven_evaluatie_instr_033.php" method="post" name="evaluatieInstrForm" onsubmit="return checkRadios()">
   <fieldset>
      <div class="legende">3.3. Mobiliteit</div>
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
            <tr class="verplicht">
					<td colspan="6" class="titel">Transfer :</td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_033_01_s,"ei_033_01_s",1);
markselected($Var_ei_033_01_s,"ei_033_01_s",2);
markselected($Var_ei_033_01_s,"ei_033_01_s",3);
markselected($Var_ei_033_01_s,"ei_033_01_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;In zit</td>
					<td align="center"><input type="text"  name="ei_033_01_t" size="35" value="<?php print($Var_ei_033_01_t);?>" /></td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_033_02_s,"ei_033_02_s",1);
markselected($Var_ei_033_02_s,"ei_033_02_s",2);
markselected($Var_ei_033_02_s,"ei_033_02_s",3);
markselected($Var_ei_033_02_s,"ei_033_02_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;In lig</td>
					<td align="center"><input type="text"  name="ei_033_02_t" size="35" value="<?php print($Var_ei_033_02_t);?>" /></td>
				</tr>
            <tr class="verplicht">
					<td colspan="6" class="titel">Verplaatsen :</td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_033_03_s,"ei_033_03_s",1);
markselected($Var_ei_033_03_s,"ei_033_03_s",2);
markselected($Var_ei_033_03_s,"ei_033_03_s",3);
markselected($Var_ei_033_03_s,"ei_033_03_s",4);
?>
					<td>&nbsp;&nbsp;&bull;&nbsp;Binnen</td>
					<td align="center"><input type="text"  name="ei_033_03_t" size="35" value="<?php print($Var_ei_033_03_t);?>" /></td>
				</tr>
            <tr class="verplicht">
					<td class="begincel" colspan="4"></td>
					<td colspan="2">&nbsp;&nbsp;&bull;&nbsp;Buiten</td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_033_04_s,"ei_033_04_s",1);
markselected($Var_ei_033_04_s,"ei_033_04_s",2);
markselected($Var_ei_033_04_s,"ei_033_04_s",3);
markselected($Var_ei_033_04_s,"ei_033_04_s",4);
?>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Met vervoermiddel</td>
					<td align="center"><input type="text"  name="ei_033_04_t" size="35" value="<?php print($Var_ei_033_04_t);?>" /></td>
				</tr>
            <tr class="verplicht">
<?php 
markselected($Var_ei_033_05_s,"ei_033_05_s",1);
markselected($Var_ei_033_05_s,"ei_033_05_s",2);
markselected($Var_ei_033_05_s,"ei_033_05_s",3);
markselected($Var_ei_033_05_s,"ei_033_05_s",4);
?>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&loz;&nbsp;Zonder vervoermiddel</td>
					<td align="center"><input type="text"  name="ei_033_05_t" size="35" value="<?php print($Var_ei_033_05_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_033_06_s,"ei_033_06_s",1);
markselected($Var_ei_033_06_s,"ei_033_06_s",2);
markselected($Var_ei_033_06_s,"ei_033_06_s",3);
markselected($Var_ei_033_06_s,"ei_033_06_s",4);
?>
					<td>Valpreventie</td>
					<td align="center"><input type="text"  name="ei_033_06_t" size="35" value="<?php print($Var_ei_033_06_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_033_07_s,"ei_033_07_s",1);
markselected($Var_ei_033_07_s,"ei_033_07_s",2);
markselected($Var_ei_033_07_s,"ei_033_07_s",3);
markselected($Var_ei_033_07_s,"ei_033_07_s",4);
?>
					<td>Tilprotocol</td>
					<td align="center"><input type="text"  name="ei_033_07_t" size="35" value="<?php print($Var_ei_033_07_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_033_08_s,"ei_033_08_s",1);
markselected($Var_ei_033_08_s,"ei_033_08_s",2);
markselected($Var_ei_033_08_s,"ei_033_08_s",3);
markselected($Var_ei_033_08_s,"ei_033_08_s",4);
?>
					<td>Individuele aandachtspunten</td>
					<td align="center"><input type="text"  name="ei_033_08_t" size="35" value="<?php print($Var_ei_033_08_t);?>" /></td>
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
					ei_033_01_s=".check4empty('ei_033_01_s').",ei_033_01_t='".$_POST['ei_033_01_t']."',
					ei_033_02_s=".check4empty('ei_033_02_s').",ei_033_02_t='".$_POST['ei_033_02_t']."',
					ei_033_03_s=".check4empty('ei_033_03_s').",ei_033_03_t='".$_POST['ei_033_03_t']."',
					ei_033_04_s=".check4empty('ei_033_04_s').",ei_033_04_t='".$_POST['ei_033_04_t']."',
					ei_033_05_s=".check4empty('ei_033_05_s').",ei_033_05_t='".$_POST['ei_033_05_t']."',
					ei_033_06_s=".check4empty('ei_033_06_s').",ei_033_06_t='".$_POST['ei_033_06_t']."',
					ei_033_07_s=".check4empty('ei_033_07_s').",ei_033_07_t='".$_POST['ei_033_07_t']."',
					ei_033_08_s=".check4empty('ei_033_08_s').",ei_033_08_t='".$_POST['ei_033_08_t']."'
				WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
//			print($qry);
			$result=mysql_query($qry); // Update record
		//-------------------------------
		//--------------------------------------
		print("<script type=\"text/javascript\">
		document.location=\"ingeven_evaluatie_instr_04.php\"
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