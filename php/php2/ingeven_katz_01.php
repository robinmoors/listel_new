<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
//----------------------------------------------------------
	session_start();
	$paginanaam="KATZ-score ingeven";
	if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
		{
		if (Isset($_SESSION['overleg_id']))
      		{
			$sql="
				SELECT
					katz_id,
					katz_overleg_id,
					katz_datum,
					katz_wassen,
					katz_kleden,
					katz_verpla,
					katz_toilet,
					katz_continent,
					katz_eten,
					katz_orient,
					katz_rust,
					katz_woon,
					katz_mantel,
					katz_sanitair,
					katz_totaal,
					katz_code,
					katz_naam  
				FROM
					katz
				WHERE
					katz_overleg_id=".$_SESSION['overleg_id'];
			if($result=mysql_query($sql))
				{
				if(mysql_num_rows($result)>0)
					{$records= mysql_fetch_array($result);}
				else
					{
					$records['katz_id']			="";
					$records['katz_overleg_id']	="";
					$records['katz_datum']		="";
					$records['katz_wassen']		="";
					$records['katz_kleden']		="";
					$records['katz_verpla']		="";
					$records['katz_toilet']		="";
					$records['katz_continent']	="";
					$records['katz_eten']		="";
					$records['katz_orient']		="";
					$records['katz_rust']		="";
					$records['katz_woon']		="";
					$records['katz_mantel']		="";
					$records['katz_sanitair']	="";
					$records['katz_totaal']		="";
					$records['katz_code']		="";
					$records['katz_naam']		="";
					}
				}
			}
		include("../includes/html_html.inc");
		print("<head>");
		include("../includes/html_head.inc");
?>
<script type="text/javascript">
<!--
function calculateKatz()
	{
	var waarde=0;
	var totaal1=0;
	var totaal2=0;
	var totaal3=0;
	var totaal4=0;
	var totaal5=0;
	var radios1= new Array("katz_wassen","katz_kleden","katz_verpla","katz_toilet","katz_continent","katz_eten");
	var radios2= new Array("katz_orient","katz_rust");
	var radios3= new Array("katz_woon");
	var radios4= new Array("katz_mantel");
	var radios5= new Array("katz_sanitair");
	for (var radio=0;radio<radios1.length;radio++)
		{radioObj=eval("document.forms['katz'].elements['"+radios1[radio]+"']");
   	for(var i = 0; i < radioObj.length; i++)
      	{if(radioObj[i].checked)
         	{var waarde=parseInt(radioObj[i].value);
				if (waarde>totaal1)totaal1=waarde;
				i=radioObj.length;};waarde=0;}}
	for (var radio=0;radio<radios2.length;radio++)
		{radioObj=eval("document.forms['katz'].elements['"+radios2[radio]+"']");
   	for(var i = 0; i < radioObj.length; i++)
      	{if(radioObj[i].checked)
         	{var waarde=parseInt(radioObj[i].value);
				if (waarde>totaal2)totaal2=waarde;
				i=radioObj.length;};waarde=0;}}
	for (var radio=0;radio<radios3.length;radio++)
		{radioObj=eval("document.forms['katz'].elements['"+radios3[radio]+"']");
   	for(var i = 0; i < radioObj.length; i++)
      	{if(radioObj[i].checked)
         	{var waarde=parseInt(radioObj[i].value);
				if (waarde>totaal3)totaal3=waarde;
				i=radioObj.length;};waarde=0;}}
	for (var radio=0;radio<radios4.length;radio++)
		{radioObj=eval("document.forms['katz'].elements['"+radios4[radio]+"']");
   	for(var i = 0; i < radioObj.length; i++)
      	{if(radioObj[i].checked)
         	{var waarde=parseInt(radioObj[i].value);
				if (waarde>totaal4)totaal4=waarde;
				i=radioObj.length;};waarde=0;}}
	for (var radio=0;radio<radios5.length;radio++)
		{radioObj=eval("document.forms['katz'].elements['"+radios5[radio]+"']");
   	for(var i = 0; i < radioObj.length; i++)
      	{if(radioObj[i].checked)
         	{var waarde=parseInt(radioObj[i].value);
				if (waarde>totaal5)totaal5=waarde;
				i=radioObj.length;};waarde=0;}}
	totaal=totaal1+totaal2+totaal3+totaal4+totaal5;
	document.getElementById('score').innerHTML=totaal;
	document.getElementById('totaal').value=totaal;}	
function checkRadios()
   {var melding="";
	waarde=""
	var radios= new Array("katz_wassen","katz_kleden","katz_verpla","katz_toilet","katz_continent","katz_eten","katz_orient","katz_rust","katz_woon","katz_mantel","katz_sanitair");
	for (var radio=0;radio<radios.length;radio++)
		{radioObj=eval("document.forms['katz'].elements['"+radios[radio]+"']");
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
?>
<!-- formulier -->
<form action="ingeven_katz_02.php" onsubmit="return checkRadios()" name="katz" method="post">
<input type="hidden" name="katz_totaal" value="0" id="totaal"/>
<input type="hidden" name="a_katz_id" value="<?php print($records['katz_id']);?>" />
<h1>Score zorgbehoevendheid</h1>
<div class="inputItem" id="IINaam">
	<div class="label220">Dit formulier werd ingevuld door<div class="reqfield">*</div>&nbsp;: </div>
	<div class="waarde">
		<input type="text" size="35" value="<?php print($records['katz_naam']);?>" name="katz_naam" />
	</div> 
</div><!--Naam interviewer-->
<p>
<table width="100%">
<tr>
<th colspan="6" align="left">A. Fysische afhankelijkheid</th>
</tr>
<tr>
<td colspan="2"></td>
<td width="15%" align="center">volledig<br />onafhankelijk</td>
<td width="15%" align="center">gedeeltelijk<br />met moeite</td>
<td width="15%" align="center">hulp<br />derden</td>
<td width="15%" align="center">volledig<br />afhankelijk</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Wassen</td>
<td width="15%" align="center"><input type="radio" name="katz_wassen" onClick="calculateKatz('katz_wassen',0)" value="1a" <?php $selected=($records['katz_wassen']=="1a")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="15%" align="center"><input type="radio" name="katz_wassen" onClick="calculateKatz('katz_wassen',1)" value="2b" <?php $selected=($records['katz_wassen']=="2b")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_wassen" onClick="calculateKatz('katz_wassen',2)" value="2c" <?php $selected=($records['katz_wassen']=="2c")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_wassen" onClick="calculateKatz('katz_wassen',3)" value="2d" <?php $selected=($records['katz_wassen']=="2d")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Kleden</td>
<td width="15%" align="center"><input type="radio" name="katz_kleden" onClick="calculateKatz('katz_kleden',0)" value="1a" <?php $selected=($records['katz_kleden']=="1a")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="15%" align="center"><input type="radio" name="katz_kleden" onClick="calculateKatz('katz_kleden',1)" value="2b" <?php $selected=($records['katz_kleden']=="2b")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_kleden" onClick="calculateKatz('katz_kleden',2)" value="3c" <?php $selected=($records['katz_kleden']=="3c")?"checked=\"checked\"":"";print($selected);?> /> 3</td>
<td width="15%" align="center"><input type="radio" name="katz_kleden" onClick="calculateKatz('katz_kleden',3)" value="3d" <?php $selected=($records['katz_kleden']=="3d")?"checked=\"checked\"":"";print($selected);?> /> 3</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Verplaatsen</td>
<td width="15%" align="center"><input type="radio" name="katz_verpla" onClick="calculateKatz('katz_verpla',0)" value="1a" <?php $selected=($records['katz_verpla']=="1a")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="15%" align="center"><input type="radio" name="katz_verpla" onClick="calculateKatz('katz_verpla',1)" value="2b" <?php $selected=($records['katz_verpla']=="2b")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_verpla" onClick="calculateKatz('katz_verpla',2)" value="4c" <?php $selected=($records['katz_verpla']=="4c")?"checked=\"checked\"":"";print($selected);?> /> 4</td>
<td width="15%" align="center"><input type="radio" name="katz_verpla" onClick="calculateKatz('katz_verpla',3)" value="4d" <?php $selected=($records['katz_verpla']=="4d")?"checked=\"checked\"":"";print($selected);?> /> 4</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Toiletbezoek</td>
<td width="15%" align="center"><input type="radio" name="katz_toilet" onClick="calculateKatz('katz_toilet',0)" value="1a" <?php $selected=($records['katz_toilet']=="1a")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="15%" align="center"><input type="radio" name="katz_toilet" onClick="calculateKatz('katz_toilet',1)" value="2b" <?php $selected=($records['katz_toilet']=="2b")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_toilet" onClick="calculateKatz('katz_toilet',2)" value="5c" <?php $selected=($records['katz_toilet']=="5c")?"checked=\"checked\"":"";print($selected);?> /> 5</td>
<td width="15%" align="center"><input type="radio" name="katz_toilet" onClick="calculateKatz('katz_toilet',3)" value="5d" <?php $selected=($records['katz_toilet']=="5d")?"checked=\"checked\"":"";print($selected);?> /> 5</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Continentie</td>
<td width="15%" align="center"><input type="radio" name="katz_continent" onClick="calculateKatz('katz_continent',0)" value="1a" <?php $selected=($records['katz_continent']=="1a")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="15%" align="center"><input type="radio" name="katz_continent" onClick="calculateKatz('katz_continent',1)" value="2b" <?php $selected=($records['katz_continent']=="2b")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_continent" onClick="calculateKatz('katz_continent',2)" value="6c" <?php $selected=($records['katz_continent']=="6c")?"checked=\"checked\"":"";print($selected);?> /> 6</td>
<td width="15%" align="center"><input type="radio" name="katz_continent" onClick="calculateKatz('katz_continent',3)" value="6d" <?php $selected=($records['katz_continent']=="6d")?"checked=\"checked\"":"";print($selected);?> /> 6</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Eten</td>
<td width="15%" align="center"><input type="radio" name="katz_eten" onClick="calculateKatz('katz_eten',0)" value="1a" <?php $selected=($records['katz_eten']=="1a")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="15%" align="center"><input type="radio" name="katz_eten" onClick="calculateKatz('katz_eten',1)" value="2b" <?php $selected=($records['katz_eten']=="2b")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
<td width="15%" align="center"><input type="radio" name="katz_eten" onClick="calculateKatz('katz_eten',2)" value="7c" <?php $selected=($records['katz_eten']=="7c")?"checked=\"checked\"":"";print($selected);?> /> 7</td>
<td width="15%" align="center"><input type="radio" name="katz_eten" onClick="calculateKatz('katz_eten',3)" value="7d" <?php $selected=($records['katz_eten']=="7d")?"checked=\"checked\"":"";print($selected);?> /> 7</td>
</tr>
</table></p>
<p>
<table width="100%">
<tr>
<th colspan="6" align="left">B. Psychische afhankelijkheid</th>
</tr>
<tr>
<td colspan="2"></td>
<td width="20%" align="center">geen<br />probleem</td>
<td width="20%" align="center">occasioneel</td>
<td width="20%" align="center">voortdurend</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Ori&euml;ntatie tijd en ruimte</td>
<td width="20%" align="center"><input type="radio" name="katz_orient" onClick="calculateKatz('katz_orient',0)" value="0a" <?php $selected=($records['katz_orient']=="0a")?"checked=\"checked\"":"";print($selected);?> /> 0</td>
<td width="20%" align="center"><input type="radio" name="katz_orient" onClick="calculateKatz('katz_orient',1)" value="1b" <?php $selected=($records['katz_orient']=="1b")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="20%" align="center"><input type="radio" name="katz_orient" onClick="calculateKatz('katz_orient',2)" value="2c" <?php $selected=($records['katz_orient']=="2c")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Rusteloosheid</td>
<td width="20%" align="center"><input type="radio" name="katz_rust" onClick="calculateKatz('katz_rust',0)" value="0a" <?php $selected=($records['katz_rust']=="0a")?"checked=\"checked\"":"";print($selected);?> /> 0</td>
<td width="20%" align="center"><input type="radio" name="katz_rust" onClick="calculateKatz('katz_rust',1)" value="1b" <?php $selected=($records['katz_rust']=="1b")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="20%" align="center"><input type="radio" name="katz_rust" onClick="calculateKatz('katz_rust',2)" value="2c" <?php $selected=($records['katz_rust']=="2c")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
</tr>
</table></p>
<p>
<table width="100%">
<tr>
<th colspan="6" align="left">C. Sociale context</th>
</tr>
<tr>
<td colspan="2"></td>
<td width="20%" align="center">met beschikb.<br />valide persoon</td>
<td width="20%" align="center">met niet-valide<br />of niet-beschikb.<br />persoon</td>
<td width="20%" align="center">alleen</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Woonsituatie<br />(onder hetzelfde dak)</td>
<td width="20%" align="center"><input type="radio" name="katz_woon" onClick="calculateKatz('katz_woon',0)" value="0a" <?php $selected=($records['katz_woon']=="0a")?"checked=\"checked\"":"";print($selected);?> /> 0</td>
<td width="20%" align="center"><input type="radio" name="katz_woon" onClick="calculateKatz('katz_woon',1)" value="1b" <?php $selected=($records['katz_woon']=="1b")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="20%" align="center"><input type="radio" name="katz_woon" onClick="calculateKatz('katz_woon',2)" value="2c" <?php $selected=($records['katz_woon']=="2c")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
</tr>
<tr>
<td colspan="2"></td>
<td width="20%" align="center">intensief<br />frequent<br />maximum</td>
<td width="20%" align="center">partieel<br />regelmatig<br />soms</td>
<td width="20%" align="center">alleen<br />minimum<br />sporadisch</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Mantelzorg<br />(niet onder hetzelfde dak)</td>
<td width="20%" align="center"><input type="radio" name="katz_mantel" onClick="calculateKatz('katz_mantel',0)" value="0a" <?php $selected=($records['katz_mantel']=="0a")?"checked=\"checked\"":"";print($selected);?> /> 0</td>
<td width="20%" align="center"><input type="radio" name="katz_mantel" onClick="calculateKatz('katz_mantel',1)" value="1b" <?php $selected=($records['katz_mantel']=="1b")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="20%" align="center"><input type="radio" name="katz_mantel" onClick="calculateKatz('katz_mantel',2)" value="2c" <?php $selected=($records['katz_mantel']=="2c")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
</tr>
</table></p>
<p>
<table width="100%">
<tr>
<th colspan="6" align="left">D. Comfort</th>
</tr>
<tr>
<td colspan="2"></td>
<td width="20%" align="center">ingerichte<br />badkamer</td>
<td width="20%" align="center">stromend warm<br />water (keuken)</td>
<td width="20%" align="center">geen stromend<br />water</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="30%">Woonsituatie<br />(onder hetzelfde dak)</td>
<td width="20%" align="center"><input type="radio" name="katz_sanitair" onClick="calculateKatz('katz_sanitair',0)" value="0a" <?php $selected=($records['katz_sanitair']=="0a")?"checked=\"checked\"":"";print($selected);?> /> 0</td>
<td width="20%" align="center"><input type="radio" name="katz_sanitair" onClick="calculateKatz('katz_sanitair',1)" value="1b" <?php $selected=($records['katz_sanitair']=="1b")?"checked=\"checked\"":"";print($selected);?> /> 1</td>
<td width="20%" align="center"><input type="radio" name="katz_sanitair" onClick="calculateKatz('katz_sanitair',2)" value="2c" <?php $selected=($records['katz_sanitair']=="2c")?"checked=\"checked\"":"";print($selected);?> /> 2</td>
</tr>
</table></p>
<div class="inputItem" id="IIButton">
	<div class="label280"><h1>Globale KATZ score: <span id="score"><?php print($records['katz_totaal']);?></span></h1></div>
	<div class="waarde">
		<input type="submit" onClick="calculateKatz(this)" value="Opslaan" name="action"></form>
	</div>
</div>
<!-- eindeformulier -->
<?php
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