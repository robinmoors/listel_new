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
   $paginanaam="Evaluatieinstrument Stap 8.1.";
   if ($_SESSION['binnenViaCode'] || (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")))
      {
      include("../includes/html_html.inc");
      print("<head>");
      include("../includes/html_head.inc");
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
		$Var_ei_081_01_s="";
		$Var_ei_081_01_t="";
		$Var_ei_081_02_s="";
		$Var_ei_081_02_t="";
		$Var_ei_081_03_s="";
		$Var_ei_081_03_t="";
		$Var_ei_081_04_s="";
		$Var_ei_081_04_t="";
		$Var_ei_081_05_s="";
		$Var_ei_081_05_t="";
		$Var_ei_081_06_s="";
		$Var_ei_081_06_t="";
		$Var_ei_081_07_s="";
		$Var_ei_081_07_t="";
		$Var_ei_081_08_s="";
		$Var_ei_081_08_t="";
		$Var_ei_081_09_s="";
		$Var_ei_081_09_t="";
		$Var_ei_081_10_s="";
		$Var_ei_081_10_t="";
		$Var_ei_081_11_s="";
		$Var_ei_081_11_t="";
		$Var_ei_081_12_s="";
		$Var_ei_081_12_t="";
		$Var_ei_081_13_s="";
		$Var_ei_081_13_t="";
		$Var_ei_081_14_s="";
		$Var_ei_081_14_t="";
		$Var_ei_081_15_s="";
		$Var_ei_081_15_t="";
		$Var_ei_081_16_s="";
		$Var_ei_081_16_t="";
		$Var_ei_081_17_s="";
		$Var_ei_081_17_t="";
		$Var_ei_081_18_s="";
		$Var_ei_081_18_t="";
		$Var_ei_081_19_s="";
		$Var_ei_081_19_t="";
 // Reset values
		//------------------------------

		if((isset($_SESSION['action']))AND($_SESSION['action']=="Aanpassen"))
			{
			//---------------------------
			$qry="
				SELECT
					ei_081_01_s,ei_081_01_t,
					ei_081_02_s,ei_081_02_t,
					ei_081_03_s,ei_081_03_t,
					ei_081_04_s,ei_081_04_t,
					ei_081_05_s,ei_081_05_t,
					ei_081_06_s,ei_081_06_t,
					ei_081_07_s,ei_081_07_t,
					ei_081_08_s,ei_081_08_t,
					ei_081_09_s,ei_081_09_t,
					ei_081_10_s,ei_081_10_t,
					ei_081_11_s,ei_081_11_t,
					ei_081_12_s,ei_081_12_t,
					ei_081_13_s,ei_081_13_t,
					ei_081_14_s,ei_081_14_t,
					ei_081_15_s,ei_081_15_t,
					ei_081_16_s,ei_081_16_t,
					ei_081_17_s,ei_081_17_t,
					ei_081_18_s,ei_081_18_t,
					ei_081_19_s,ei_081_19_t
				FROM
					evalinstr
				WHERE
          ei_id = {$_SESSION['evalinstr_id']}";
//			print($qry);
			$result=mysql_query($qry);
			$records=mysql_fetch_array($result); // Get record
			//---------------------------
			//-------------------------------------------------
			$Var_ei_081_01_s=$records['ei_081_01_s'];
			$Var_ei_081_01_t=$records['ei_081_01_t'];
			$Var_ei_081_02_s=$records['ei_081_02_s'];
			$Var_ei_081_02_t=$records['ei_081_02_t'];
			$Var_ei_081_03_s=$records['ei_081_03_s'];
			$Var_ei_081_03_t=$records['ei_081_03_t'];
			$Var_ei_081_04_s=$records['ei_081_04_s'];
			$Var_ei_081_04_t=$records['ei_081_04_t'];
			$Var_ei_081_05_s=$records['ei_081_05_s'];
			$Var_ei_081_05_t=$records['ei_081_05_t'];
			$Var_ei_081_06_s=$records['ei_081_06_s'];
			$Var_ei_081_06_t=$records['ei_081_06_t'];
			$Var_ei_081_07_s=$records['ei_081_07_s'];
			$Var_ei_081_07_t=$records['ei_081_07_t'];
			$Var_ei_081_08_s=$records['ei_081_08_s'];
			$Var_ei_081_08_t=$records['ei_081_08_t'];
			$Var_ei_081_09_s=$records['ei_081_09_s'];
			$Var_ei_081_09_t=$records['ei_081_09_t'];
			$Var_ei_081_10_s=$records['ei_081_10_s'];
			$Var_ei_081_10_t=$records['ei_081_10_t'];
			$Var_ei_081_11_s=$records['ei_081_11_s'];
			$Var_ei_081_11_t=$records['ei_081_11_t'];
			$Var_ei_081_12_s=$records['ei_081_12_s'];
			$Var_ei_081_12_t=$records['ei_081_12_t'];
			$Var_ei_081_13_s=$records['ei_081_13_s'];
			$Var_ei_081_13_t=$records['ei_081_13_t'];
			$Var_ei_081_14_s=$records['ei_081_14_s'];
			$Var_ei_081_14_t=$records['ei_081_14_t']; 
			$Var_ei_081_15_s=$records['ei_081_15_s'];
			$Var_ei_081_15_t=$records['ei_081_15_t']; 
			$Var_ei_081_16_s=$records['ei_081_16_s'];
			$Var_ei_081_16_t=$records['ei_081_16_t']; 
			$Var_ei_081_17_s=$records['ei_081_17_s'];
			$Var_ei_081_17_t=$records['ei_081_17_t']; 
			$Var_ei_081_18_s=$records['ei_081_18_s'];
			$Var_ei_081_18_t=$records['ei_081_18_t']; 
			$Var_ei_081_19_s=$records['ei_081_19_s'];
			$Var_ei_081_19_t=$records['ei_081_19_t']; 
			// Update values according to dbase
			//-------------------------------------------------
			}
?>
<!-- Start Formulier -->
<form action="ingeven_evaluatie_instr_081.php" method="post" name="evaluatieInstrForm">
   <fieldset>
      <div class="legende">8.1. Financi&euml;le ondersteuning</div>
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
<?php 
markselected($Var_ei_081_01_s,"ei_081_01_s",1);
markselected($Var_ei_081_01_s,"ei_081_01_s",2);
markselected($Var_ei_081_01_s,"ei_081_01_s",3);
markselected($Var_ei_081_01_s,"ei_081_01_s",4);
?>
					<td>Vergoedingen / tussenkomsten<br />nationaal, provinciaal, gemeentelijk</td>
					<td align="center"><input type="text"  name="ei_081_01_t" size="35" value="<?php print($Var_ei_081_01_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_02_s,"ei_081_02_s",1);
markselected($Var_ei_081_02_s,"ei_081_02_s",2);
markselected($Var_ei_081_02_s,"ei_081_02_s",3);
markselected($Var_ei_081_02_s,"ei_081_02_s",4);
?>
					<td>Hulp aan bejaarden</td>
					<td align="center"><input type="text"  name="ei_081_02_t" size="35" value="<?php print($Var_ei_081_02_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_03_s,"ei_081_03_s",1);
markselected($Var_ei_081_03_s,"ei_081_03_s",2);
markselected($Var_ei_081_03_s,"ei_081_03_s",3);
markselected($Var_ei_081_03_s,"ei_081_03_s",4);
?>
					<td>Kankerfonds</td>
					<td align="center"><input type="text"  name="ei_081_03_t" size="35" value="<?php print($Var_ei_081_03_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_04_s,"ei_081_04_s",1);
markselected($Var_ei_081_04_s,"ei_081_04_s",2);
markselected($Var_ei_081_04_s,"ei_081_04_s",3);
markselected($Var_ei_081_04_s,"ei_081_04_s",4);
?>
					<td>Kine: tussenkomst voor zware pathologie&euml;n</td>
					<td align="center"><input type="text"  name="ei_081_04_t" size="35" value="<?php print($Var_ei_081_04_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_05_s,"ei_081_05_s",1);
markselected($Var_ei_081_05_s,"ei_081_05_s",2);
markselected($Var_ei_081_05_s,"ei_081_05_s",3);
markselected($Var_ei_081_05_s,"ei_081_05_s",4);
?>
					<td>Mantelzorgtoelage</td>
					<td align="center"><input type="text"  name="ei_081_05_t" size="35" value="<?php print($Var_ei_081_05_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_06_s,"ei_081_06_s",1);
markselected($Var_ei_081_06_s,"ei_081_06_s",2);
markselected($Var_ei_081_06_s,"ei_081_06_s",3);
markselected($Var_ei_081_06_s,"ei_081_06_s",4);
?>
					<td>Parkeerkaart</td>
					<td align="center"><input type="text"  name="ei_081_06_t" size="35" value="<?php print($Var_ei_081_06_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_07_s,"ei_081_07_s",1);
markselected($Var_ei_081_07_s,"ei_081_07_s",2);
markselected($Var_ei_081_07_s,"ei_081_07_s",3);
markselected($Var_ei_081_07_s,"ei_081_07_s",4);
?>
					<td>Sociaal telefoontarief</td>
					<td align="center"><input type="text"  name="ei_081_07_t" size="35" value="<?php print($Var_ei_081_07_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_08_s,"ei_081_08_s",1);
markselected($Var_ei_081_08_s,"ei_081_08_s",2);
markselected($Var_ei_081_08_s,"ei_081_08_s",3);
markselected($Var_ei_081_08_s,"ei_081_08_s",4);
?>
					<td>Vermindering Kabel TV</td>
					<td align="center"><input type="text"  name="ei_081_08_t" size="35" value="<?php print($Var_ei_081_08_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_09_s,"ei_081_09_s",1);
markselected($Var_ei_081_09_s,"ei_081_09_s",2);
markselected($Var_ei_081_09_s,"ei_081_09_s",3);
markselected($Var_ei_081_09_s,"ei_081_09_s",4);
?>
					<td>Vlaams Fonds</td>
					<td align="center"><input type="text"  name="ei_081_09_t" size="35" value="<?php print($Var_ei_081_09_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_10_s,"ei_081_10_s",1);
markselected($Var_ei_081_10_s,"ei_081_10_s",2);
markselected($Var_ei_081_10_s,"ei_081_10_s",3);
markselected($Var_ei_081_10_s,"ei_081_10_s",4);
?>
					<td>WIGW-Statuut</td>
					<td align="center"><input type="text"  name="ei_081_10_t" size="35" value="<?php print($Var_ei_081_10_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_11_s,"ei_081_11_s",1);
markselected($Var_ei_081_11_s,"ei_081_11_s",2);
markselected($Var_ei_081_11_s,"ei_081_11_s",3);
markselected($Var_ei_081_11_s,"ei_081_11_s",4);
?>
					<td>Zorgverzekering</td>
					<td align="center"><input type="text"  name="ei_081_11_t" size="35" value="<?php print($Var_ei_081_11_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_12_s,"ei_081_12_s",1);
markselected($Var_ei_081_12_s,"ei_081_12_s",2);
markselected($Var_ei_081_12_s,"ei_081_12_s",3);
markselected($Var_ei_081_12_s,"ei_081_12_s",4);
?>
					<td>Tussenkomst voor incontinentiemateriaal</td>
					<td align="center"><input type="text"  name="ei_081_12_t" size="35" value="<?php print($Var_ei_081_12_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_13_s,"ei_081_13_s",1);
markselected($Var_ei_081_13_s,"ei_081_13_s",2);
markselected($Var_ei_081_13_s,"ei_081_13_s",3);
markselected($Var_ei_081_13_s,"ei_081_13_s",4);
?>
					<td>Tussenkomst voor palliatieve zorg</td>
					<td align="center"><input type="text"  name="ei_081_13_t" size="35" value="<?php print($Var_ei_081_13_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_14_s,"ei_081_14_s",1);
markselected($Var_ei_081_14_s,"ei_081_14_s",2);
markselected($Var_ei_081_14_s,"ei_081_14_s",3);
markselected($Var_ei_081_14_s,"ei_081_14_s",4);
?>
					<td>Tussenkomst voor rolstoel</td>
					<td align="center"><input type="text"  name="ei_081_14_t" size="35" value="<?php print($Var_ei_081_14_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_15_s,"ei_081_15_s",1);
markselected($Var_ei_081_15_s,"ei_081_15_s",2);
markselected($Var_ei_081_15_s,"ei_081_15_s",3);
markselected($Var_ei_081_15_s,"ei_081_15_s",4);
?>
					<td>Tussenkomst voor prothesen</td>
					<td align="center"><input type="text"  name="ei_081_15_t" size="35" value="<?php print($Var_ei_081_15_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_16_s,"ei_081_16_s",1);
markselected($Var_ei_081_16_s,"ei_081_16_s",2);
markselected($Var_ei_081_16_s,"ei_081_16_s",3);
markselected($Var_ei_081_16_s,"ei_081_16_s",4);
?>
					<td>Tussenkomst voor medische kosten, medicatie</td>
					<td align="center"><input type="text"  name="ei_081_16_t" size="35" value="<?php print($Var_ei_081_16_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_17_s,"ei_081_17_s",1);
markselected($Var_ei_081_17_s,"ei_081_17_s",2);
markselected($Var_ei_081_17_s,"ei_081_17_s",3);
markselected($Var_ei_081_17_s,"ei_081_17_s",4);
?>
					<td>Tussenkomst voor water / elektriciteit</td>
					<td align="center"><input type="text"  name="ei_081_17_t" size="35" value="<?php print($Var_ei_081_17_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_18_s,"ei_081_18_s",1);
markselected($Var_ei_081_18_s,"ei_081_18_s",2);
markselected($Var_ei_081_18_s,"ei_081_18_s",3);
markselected($Var_ei_081_18_s,"ei_081_18_s",4);
?>
					<td>Tussenkomst voor vuilniszakken</td>
					<td align="center"><input type="text"  name="ei_081_18_t" size="35" value="<?php print($Var_ei_081_18_t);?>" /></td>
				</tr>
            <tr>
<?php 
markselected($Var_ei_081_19_s,"ei_081_19_s",1);
markselected($Var_ei_081_19_s,"ei_081_19_s",2);
markselected($Var_ei_081_19_s,"ei_081_19_s",3);
markselected($Var_ei_081_19_s,"ei_081_19_s",4);
?>
					<td>Tussenkomst voor ............</td>
					<td align="center"><input type="text"  name="ei_081_19_t" size="35" value="<?php print($Var_ei_081_19_t);?>" /></td>
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
					ei_081_01_s=".check4empty('ei_081_01_s').",ei_081_01_t='".$_POST['ei_081_01_t']."',
					ei_081_02_s=".check4empty('ei_081_02_s').",ei_081_02_t='".$_POST['ei_081_02_t']."',
					ei_081_03_s=".check4empty('ei_081_03_s').",ei_081_03_t='".$_POST['ei_081_03_t']."',
					ei_081_04_s=".check4empty('ei_081_04_s').",ei_081_04_t='".$_POST['ei_081_04_t']."',
					ei_081_05_s=".check4empty('ei_081_05_s').",ei_081_05_t='".$_POST['ei_081_05_t']."',
					ei_081_06_s=".check4empty('ei_081_06_s').",ei_081_06_t='".$_POST['ei_081_06_t']."',
					ei_081_07_s=".check4empty('ei_081_07_s').",ei_081_07_t='".$_POST['ei_081_07_t']."',
					ei_081_08_s=".check4empty('ei_081_08_s').",ei_081_08_t='".$_POST['ei_081_08_t']."',
					ei_081_09_s=".check4empty('ei_081_09_s').",ei_081_09_t='".$_POST['ei_081_09_t']."',
					ei_081_10_s=".check4empty('ei_081_10_s').",ei_081_10_t='".$_POST['ei_081_10_t']."',
					ei_081_11_s=".check4empty('ei_081_11_s').",ei_081_11_t='".$_POST['ei_081_11_t']."',
					ei_081_12_s=".check4empty('ei_081_12_s').",ei_081_12_t='".$_POST['ei_081_12_t']."',
					ei_081_13_s=".check4empty('ei_081_13_s').",ei_081_13_t='".$_POST['ei_081_13_t']."',
					ei_081_14_s=".check4empty('ei_081_14_s').",ei_081_14_t='".$_POST['ei_081_14_t']."',
					ei_081_15_s=".check4empty('ei_081_15_s').",ei_081_15_t='".$_POST['ei_081_15_t']."',
					ei_081_16_s=".check4empty('ei_081_16_s').",ei_081_16_t='".$_POST['ei_081_16_t']."',
					ei_081_17_s=".check4empty('ei_081_17_s').",ei_081_17_t='".$_POST['ei_081_17_t']."',
					ei_081_18_s=".check4empty('ei_081_18_s').",ei_081_18_t='".$_POST['ei_081_18_t']."',
					ei_081_19_s=".check4empty('ei_081_19_s').",ei_081_19_t='".$_POST['ei_081_19_t']."'
				WHERE
                    ei_id = {$_SESSION['evalinstr_id']}";
			//print($qry);
			$result=mysql_query($qry); // Update record
		//-------------------------------
		//--------------------------------------
		print("<script type=\"text/javascript\">
		document.location=\"ingeven_evaluatie_instr_082.php\"
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