<?php
session_start();
$paginanaam="Teamoverleg plannen";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
	{
	//---------------------------------------------------------
	// Maak Dbconnectie 
	include('../includes/dbconnect.inc');
	//---------------------------------------------------------

	include("../includes/html_html.inc");
	print("<head>");
	include("../includes/html_head.inc");

	//---------------------------------------------------------
	// Controle numerieke velden  
	include("../includes/checkForNumbersOnly.inc");
	//---------------------------------------------------------

	//---------------------------------------------------------
	?><script type="text/javascript">
<!--
function checkRadios(){var melding="";
	waarde=""
	var radios= new Array("overleg_locatie_id");
	for (var radio=0;radio<radios.length;radio++)
		{radioObj=eval("document.forms['doeoverlegform'].elements['"+radios[radio]+"']");
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
</script><?php // check radio's
	//---------------------------------------------------------

	// --------------------------------------------------------
	$pat_type=mysql_fetch_array(mysql_query("SELECT pat_type FROM patienten WHERE pat_id='".$_SESSION['pat_id']."'"));
	$locatie=(($pat_type['pat_type']==1)OR($pat_type['pat_type']==2))?
		"<td><input type=\"radio\" name=\"overleg_locatie_id\" value=\"2\" /></td>
		<td>In deskundig ziekenhuiscentrum</td></tr><tr>":""; // eventueel invoegen van een derde 
	// locatie indien het patienttype  PVS of MRS is
	// --------------------------------------------------------

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
	print("<h1>Overleg plannen</h1>");
	print("<p>Voor <b>".$_SESSION['pat_id']." ".$_SESSION['pat_naam']."</b>.</p>");
	
	$katzok=($_SESSION['katz_totaal']>4)?"okay":"niet okay";
	$overlegdate_dd="";
	$overlegdate_mm="";
	$overlegdate_jj="";
	if ($_SESSION['aantal_teamoverleg']==0)
		{
		print("
			<p>Aangezien dit het eerste overleg is voor deze hulpbehoevende en dit dus de
			opstart van een zorgenplan betreft, is het noodzakelijk dat er voldaan is
			aan volgende eisen:</p><ul>
				<li>een KATZ-score van minimaal 5 huidige score is ".$_SESSION['katz_totaal']." dus <b>".$katzok."</b></li>
				<li>een vertegenwoordiging van de juiste personen op het eerste overleg</li></ul>
			<p>alvorens de nodige documenten geprint kunnen worden.</p>");
			$overlegdate_dd=substr($_SESSION['datum'],6,2);
			$overlegdate_mm=substr($_SESSION['datum'],4,2);
			$overlegdate_jj=substr($_SESSION['datum'],2,2);
		}


?>
<!-- Start Formulier -->		
<form action="doe_overleg_04.php" method="post" onsubmit="return checkRadios()" name="doeoverlegform">
   <fieldset>
      <div class="legende">Gegevens ivm overleg</div>
      <div>&nbsp;</div>

      <div class="inputItem" id="IIStartdatum">
         <div class="label280">Datum overleg (ddmmjj)&nbsp;: </div>
         <div class="waarde">
            <input type="text" size="2" value="<?php print ($overlegdate_dd); ?>" name="overleg_dd" 
				onKeyup="checkForNumbersOnly(this,2,0,31,'doeoverlegform','overleg_mm')" 
				onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?php print ($overlegdate_mm); ?>" name="overleg_mm" 
				onKeyup="checkForNumbersOnly(this,2,0,12,'doeoverlegform','overleg_jj')" 
				onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?php print ($overlegdate_jj); ?>" name="overleg_jj" 
				onKeyup="checkForNumbersOnly(this,2,0,25,'doeoverlegform','overleg_jj')" 
				onblur="checkForNumbersLength(this,2)" />
         </div> 
      </div><!--overleg_dd,overleg_mm,overleg_jj-->
      <div class="inputItem" id="IIOverleg_locatie_id">
         <div class="label280">Plaats v/h overleg<sup><font color="#CC3300">*</font></sup>&nbsp;: </div>
         <div class="waardex"><table><tr>
			<td><input type="radio" name="overleg_locatie_id" value="0" /></td>
			<td>Bij pati&euml;nt thuis</td></tr><tr><?php print($locatie);?>
			<td><input type="radio" name="overleg_locatie_id" value="1" /></td>
			<td>Elders</td></tr></table>
         </div>  
      </div><!--overleg_locatie_id-->
      <div class="inputItem" id="IIAanwezig">
         <div class="label280">De pati&euml;nt of zijn vertegenwoordiger stemt in met de deelnemers van het overleg </div>
         <div class="waardex"><input type="checkbox" name="overleg_aanwezig" />
         </div>  
      </div><!--overleg_aanwezig-->
      <div class="inputItem" id="IIAanwezig">
         <div class="label280">De pati&euml;nt of zijn vertegenwoordiger wenst niet aanwezig te zijn op het overleg</div>
         <div class="waardex"><input type="checkbox" name="overleg_afwezig" />
         </div>  
      </div><!--overleg_afwezig-->
	</fieldset>
	<fieldset>
      <div class="label280">Deze gegevens</div>
      <div class="waarde">
         <input type="submit" value="opslaan" name="action">
      </div><!--Button opslaan -->
   </fieldset>
</form>
<!-- Einde Formulier -->
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