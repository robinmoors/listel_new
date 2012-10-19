<?php
//------------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//------------------------------------------------------------

$paginanaam="XVL toevoegen of aanpassen";


if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){
    
    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");
    require("../includes/checkForNumbersOnly.inc");

    //------------------------------------------------------------
    // Postcodelijst Opstellen voor javascript

    print("<script type=\"text/javascript\">");
    $query = "
        		SELECT
            			l.dlzip,
						l.dlnaam,
						l.id
       			FROM
            			gemeente l
				ORDER BY
         				l.dlzip";
    
	if ($result=mysql_query($query)){
        
        print ("var gemeenteList = Array(");
        for ($i=0; $i < mysql_num_rows ($result); $i++){
            
            $records= mysql_fetch_array($result);
            print ("\"".$records['dlzip']." ".$records['dlnaam']."\",\"".$records['id']."\",\n");

        }
		print ("\"9999 onbekend\",\"9999\");");
     }

   print("</script>"); 

    //----------------------------------------------------------

    print("</head>");
    print("<body>");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");

    require("../includes/header.inc");
    require("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    require("../includes/menu.inc");

    print("<div class=\"main\">");
    print("<div class=\"mainblock\">");


    if ( isset($_POST['id']) ){

		$a_hvl_id = $_POST['id'];

	}
    if ( isset($_POST['hvl_id']) ){

		$a_hvl_id = $_POST['hvl_id'];

	}
    if ( isset($_GET['hvl_id']) ){

		$a_hvl_id = $_GET['hvl_id'];

	}
  if ( isset($_GET['id']) ){ $a_hvl_id=$_GET['id']; }

    if ( isset($_POST['a_backpage']) ){

		$backpage = $_POST['a_backpage'];

	}
    if ( isset($_POST['backpage']) ){

		$backpage = $_POST['backpage'];

	}
    if ( isset($_GET['backpage']) ){

		$backpage = $_GET['backpage'];

	}

   if ( isset($_GET['a_backpage']) ){
		
		$backpage=$_GET['a_backpage'];

	}

     $action="toevoegen";  // default toevoegen; wordt veranderd indien nodig
 
    if ( !isset($_POST['action']) && ($_POST['wis'] != 1) ){ // $action niet gezet, en niet wissen,  dus formulier weergeven


       
        if ( isset($a_hvl_id) && $a_hvl_id != "" ){ // $a_hvl_id gezet dus gegevens ophalen om formulier te vullen
             //------------------------------------------------------------
            $bevestigChanges = "&& bevestigVeranderingen('edithvlform',velden)";

            $action="Aanpassen";

        $query = "
            SELECT
                h.id AS hid,
                h.naam AS hnaam,
                h.voornaam,
                h.adres,
                h.fnct_id,
                h.tel,
                h.adres,
                h.gem_id,
                h.email,
                h.reknr,
                h.vervangt,
                h.convenant,
				h.riziv1,
                h.riziv2,
                h.riziv3,
                h.organisatie,

                g.dlnaam,
                g.dlzip,

                f.naam AS fnaam,

                fg.naam AS fgnaam,
                fg.id AS fgid,

                h.fax,
                h.gsm,

                g.id AS gid

            FROM
                hulpverleners h,
                functies f,
                functiegroepen fg,
                gemeente g

            WHERE
                g.id = h.gem_id 	AND
                f.id = h.fnct_id 	AND
                fg.id = f.groep_id  AND
                h.id=".$a_hvl_id;


        $result = mysql_query($query);


        if (mysql_num_rows($result)<>0 ){


        //---------------------------------------------
        // een correcte record gevonden
        //---------------------------------------------
            
            $records= mysql_fetch_array($result);


          /* $valID=             $records['hulpverleners.id'];
            $valNaam=           $records['hulpverleners.naam'];
            $valVoornaam=       $records['hulpverleners.voornaam'];
            $valAdres=          $records['hulpverleners.adres'];
            $valGemeente=       $records['gemeente.dlzip']." ".$records['gemte_dlnaam'];
            $valTel=                $records['hulpverleners.tel'];
            $valFax=                $records['hulpverleners.fax'];
            $valGsm=                $records['hulpverleners.gsm'];
            $valEmail=          $records['hulpverleners.email'];
            $valReknr1=         substr($records['hulpverleners.reknr'],0,3);
            $valReknr2=         substr($records['hulpverleners.reknr'],4,7);
            $valReknr3=         substr($records['hulpverleners.reknr'],12,2);
            $valConvenant=      $records['hulpverleners.convenant'];
            $valConvenanttype=$records['hulpverleners.convenanttype'];
            $valRizivNr1=       substr($records['hulpverleners.riziv1'],0,1);
            $valRizivNr2=       substr($records['hulpverleners.riziv1'],1,5);
            $valRizivNr3=       $records['hulpverleners.riziv2'];
            $valRizivNr4=       $records['hulpverleners.riziv3'];
            $valFunctie=        $records['hulpverleners.fnct_id'];
            $valFunctieGroep=   $records['functies.groep_id'];
            $valGoedgekeurd=    $records['hulpverleners.goedgekeurd'];
            $valGem2=           $records['gemeente.id'];*/


            $valID=             $records['hid'];
            $valNaam=           $records['hnaam'];
            $valVoornaam=       $records['voornaam'];
            $valAdres=          $records['adres'];
            $valGemeente=       $records['dlzip']." ".$records['dlnaam'];
            $valTel=                $records['tel'];
            $valFax=                $records['fax'];
            $valGsm=                $records['gsm'];
            $valEmail=          $records['email'];

            $valReknr1=         substr($records['reknr'],0,3);
            $valReknr2=         substr($records['reknr'],4,7);
            $valReknr3=         substr($records['reknr'],12,2);

            $valConvenant=      $records['convenant'];

            $valRizivNr1=       substr($records['riziv1'],0,1);
            $valRizivNr2=       substr($records['riziv1'],1,5);

            $valRizivNr3=       $records['riziv2'];
            $valRizivNr4=       $records['riziv3'];
            $valFunctie=        $records['fnct_id'];
            $valFunctieGroep=   $records['groep_id'];
            $valGem2=           $records['gid'];
            $valVervangt=        $records['vervangt'];
                 $valOrganisatie =   $records['organisatie'];

            }

        else {
        //--------------------------------------------------
			// foute gegevens, geen record gevonden die voldeed
			//--------------------------------------------------
			
			print("Geen record gevonden");
			print(mysql_error());

			print("hvl_Id".$a_hvl_id);
			print("post hvl id".$_POST['hvl_id']);

        } // Haal gegevens van hulpverlener op die voldoen

    } //------------------------------------------------------------ 

  /* deze else in commentaar gezet omdat het toevoegen niet meer lukte
        else{
             //-------------------------------------------------------------
			 
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
				$valReknr1="";
				$valReknr2="";
				$valReknr3="";
				$valConvenant="";
				$valConvenanttype="";
				$valRizivNr1="";
				$valRizivNr2="";
				$valRizivNr3="";
				$valRizivNr4="";
				$valFunctie="";
				$valFunctieGroep="";
				$valGoedgekeurd="";
				$valGem2="9999"; // Variabelen vullen met niets om fouten te voorkomen

            } 
            //------------------------------------------------------------- 
	*/
if(!isset($valGem2)) $valGem2=9999; // Variabelen vullen met niets om fouten te voorkomen


?>

<script language="javascript" src="../includes/formuliervalidatie.js">
</script>

<script language="javascript" type="text/javascript">
function checkFormAnderen()
	{
	fouten = "";
	
	fouten = fouten + checkLeeg 	('edithvlform', 'naam', 	'- Vul een achternaam in');
	//fouten = fouten + checkLeeg 	('edithvlform', 'voornaam', '- Vul een voornaam in');
  //fouten = fouten + checkLeeg 	('edithvlform', 'adres', 	'- Vul een adres in');
	//fouten = fouten + checkLeeg 	('edithvlform', 'tel', 		'- Vul een geldig telefoonnummer in');
	//fouten = fouten + checkLeeg 	('edithvlform', 'postCodeInput', 		'- Vul een geldige postcode in');
	
  var velden = Array('email','gsm','fax','tel','postcode','adres','_organisatie','_fnct_id','voornaam','naam');
	//alert(bevestigVeranderingen('edithvlform',velden));
	return valideer() <?= $bevestigChanges ?>;
}

var origineel = new Array();

</script>


<form action="edit_anderen.php" method="post" name="edithvlform" onSubmit="return checkFormAnderen();"  autocomplete="off">
<input type="hidden" name="veranderd" value="-1" />

   <fieldset>
      <div class="legende">Gegevens anderen:</div>
      <div>&nbsp;</div>


        <div class="label160">Naam<div class="reqfield">*</div>&nbsp;: </div>
      <div class="waarde">
         <input type="text" size="35" value="<?php print($valNaam)?>" name="naam" />
      </div><!--Naam -->


        <div class="label160">Voornaam</sup>&nbsp;: </div>
      <div class="waarde">
         <input type="text" size="35" value="<?php print($valVoornaam)?>" name="voornaam" />
      </div><!--Voornaam -->


        <div class="label160">Functie<div class="reqfield">*</div>&nbsp;: </div>
        <div class="waarde">
            <select size="1" name="fnct_id" />


<?php
        //------------------------------------------------------------------
        $query = "
			SELECT
            	id,
                naam
            FROM
            	functies
            WHERE
                groep_id=3 OR groep_id=4
         	ORDER BY
				naam";

      if ( $result=mysql_query($query) ){
         
         for ($i=0; $i < mysql_num_rows ($result); $i++){
            
            $records= mysql_fetch_array($result);
                $selected=($valFunctie==$records[0])?"selected=\"selected\"":"";

            print ("
               <option value=\"".$records[0]."\" ".$selected.">".$records[1]."</option>\n");
            }

         } // Vul Input-select-element vanuit dbase: functies
        //------------------------------------------------------------------
?>



            </select>
        </div><!--Functie -->
<script language="javascript">
origineel['fnct_id'] = document.edithvlform.fnct_id.selectedIndex;
</script>

        <div class="label160">Organisatie&nbsp;: </div>
        <div class="waarde">
<script language="javascript">
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
  document.edithvlform.elements[id].value = "";
  document.getElementById(id).style.display='block';
  document.getElementById(id).innerHTML=organisaties[nr][id];
  document.edithvlform.elements[id].style.display='none';
}
function invoer(id) {
  document.edithvlform.elements[id].value = "";
  document.getElementById(id).style.display='none';
  document.edithvlform.elements[id].style.display='block';
}

function zoekGemeente(nr) {
   for (i=1; i< gemeenteList.length; i=i+2) {
     if (nr == gemeenteList[i])
       return gemeenteList[i-1];
   }
}

function toonPC(nr) {
 gemeente = zoekGemeente(organisaties[nr]['gem_id']);
 selectObj = document.edithvlform.hvl_gem_id;
 selectObj.length = 0;  // maak selectlijst leeg
 selectObj[0] = new Option(gemeente,organisaties[nr]['gem_id']);
 selectObj[1] = new Option("Onbepaald",9999);
 selectObj.options[1].selected = true;
 //handleSelectClick('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS')
 //alert(1);
 document.getElementById("postcodeinvoer").style.display='none';
 document.getElementById("postcodevast").style.display='block';
 document.getElementById("postcodevast").innerHTML=gemeente;
 document.edithvlform.elements['postCodeInput'].value = gemeente;
}

function invoerPC(id) {
 selectObj = document.edithvlform.hvl_gem_id;
 selectObj.options[0].selected = true;
  document.getElementById("postcodeinvoer").style.display='block';
  document.getElementById("postcodevast").style.display='none';
}
</script>

            <select size="1" name="organisatie" style="width: 360px;"
                     onChange="toonOrganisatie(this.value);" />
            <option value="1000">Onbepaald</option>
            <option value="999">NVT</option>
<?php
        //-----------------------------------------------------------
if ($_GET['genre'] == "xvlnp") {
  $genreXVL = "genre = 'XVLNP'";
}
else if ($_GET['genre'] == "xvlp") {
  $genreXVL = "genre = 'XVLP'";
}
else if (isset($_GET['patientTP'])) {
   $queryPartners = "select persoon_id as org from huidige_betrokkenen
                     where patient_code = \"{$_GET['patientTP']}\"
                       and genre = 'org'";
   $resultPartners = mysql_query($queryPartners) or die("dedoemme $queryPartners");
   $orgs = "";
   for ($i=0;$i<mysql_num_rows($resultPartners);$i++) {
     $org = mysql_fetch_assoc($resultPartners);
     $orgs .= ", {$org['org']}";
   }
   $orgs = substr($orgs, 1);
   $genreXVL = "id in ($orgs)";
}
else {
  $genreXVL = "genre LIKE 'XVL%' or genre is NULL";
}

      $query = "
	SELECT
	  	*
	FROM
    organisatie
  where
    actief = 1 AND
    ($genreXVL)
	ORDER BY
		naam";

      if ($result=mysql_query($query))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
                $selected=($valOrganisatie==$records[0])?"selected=\"selected\"":"";
            print ("
               <option value=\"".$records[0]."\" ".$selected.">".$records[1]."</option>\n");
            echo <<< EINDEJS
<script language="javascript">
organisaties[$records[0]] = new Array();
organisaties[$records[0]]['adres'] = "{$records['adres']}";
organisaties[$records[0]]['gem_id'] = "{$records['gem_id']}";
organisaties[$records[0]]['tel'] = "{$records['tel']}";
organisaties[$records[0]]['fax'] = "{$records['fax']}";
organisaties[$records[0]]['gsm'] = "{$records['gsm']}";
organisaties[$records[0]]['email'] = "{$records['email_inhoudelijk']}";
</script>
EINDEJS;
            }
         } // Vul Input-select-element vanuit dbase Partners
        //-----------------------------------------------------------
?>
            </select>
        </div><!--Organisatie -->
<script language="javascript">
origineel['organisatie'] = document.edithvlform.organisatie.selectedIndex;
</script>

       <div class="label160"  ondblclick="invoer('adres');invoerPC();">Contactadres&nbsp; : </div>

    <div class="waarde">
        <input type="text" size="35" value="<?php print($valAdres)?>" name="adres" />
        <span  id="adres" style="display:none" ondblclick="invoer('adres');invoerPC();"></span>
    </div>


    <div class="inputItem" id="IIPostCode">
        <div class="label160" ondblclick="invoer('adres');invoerPC();">Postcode&nbsp;: </div>
        <div class="waarde">
            <span id="postcodeinvoer">
            <input onKeyUp="refreshList('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20)"
            onmouseUp="showCombo('IIPostCodeS',100)"
            onfocus="refreshList('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20)"
            type="text" name="postCodeInput" value="<?php print($valGemeente)?>">
            <input type="button"  value="<<"
            onClick="resetList('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS',gemeenteList,20,100)" />
           </span>
           <span id="postcodevast" ondblclick="invoer('adres');invoerPC();"></span>
        </div>
    </div>

      <div class="inputItem" id="IIPostCodeS">
         <div class="label160">Kies eventueel&nbsp;:</div>
         <div class="waarde">

            <select onClick="handleSelectClick('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS')" name="hvl_gem_id" size="5">
            </select>

         </div>
      </div><!--Contactadres -->




        <div class="label160" ondblclick="invoer('tel')">Tel.&nbsp;: </div>

      <div class="waarde">
        <input type="text" size="35" value="<?php print($valTel)?>" name="tel" />
        <span  id="tel" style="display:none" ondblclick="invoer('tel')"></span>
      </div><!--Tel -->

        <div class="label160" ondblclick="invoer('fax')">Fax&nbsp;: </div>

       <div class="waarde">
        <input type="text" size="35" value="<?php print($valFax)?>" name="fax" />
        <span  id="fax" style="display:none" ondblclick="invoer('fax')"></span>
       </div><!--Fax -->

        <div class="label160" ondblclick="invoer('gsm')">GSM&nbsp;: </div>

      <div class="waarde">
        <input type="text" size="35" value="<?php print($valGsm)?>" name="gsm" />
        <span  id="gsm" style="display:none" ondblclick="invoer('gsm')"></span>
      </div><!--GSM -->

        <div class="label160" ondblclick="invoer('email')">E-mail&nbsp;: </div>

      <div class="waarde">
        <input type="text" size="35" value="<?php print($valEmail)?>" name="email" />
        <span  id="email" style="display:none" ondblclick="invoer('email')"></span>
      </div><!--E-mail -->

<?php
 if (isset($valVervangt)) {
?>
        <div class="label160">Vervangt&nbsp;: </div>

      <div class="waarde">
         <a href="edit_anderen.php?readOnly=1&hvl_id=<?= $valVervangt ?>">hulpverlener <?= $valVervangt ?></a>
      </div><!--E-mail -->
<?php
}
?>
	
   </fieldset>

<?php
  if (!isset($_GET['readOnly'])) {
?>

   <fieldset>

      <div class="label160">Deze gegevens</div>
      <div class="waarde">
            <input type="hidden" name="action" value="<?php print($action)?>" />
            <input type="hidden" name="hvl_id" value="<?php print($valID)?>" />
            <input type="hidden" name="gem2_id" value="<?php print($valGem2)?>" />
            <input type="hidden" name="backpage" value="<?php print($backpage)?>" />
         <input type="submit" value="<?php print($action)?>" />
      </div><!--Button opslaan -->

   </fieldset>
<?php
}
?>


</form>

	<script type="text/javascript">
		document.forms['edithvlform'].elements['naam'].focus();startWaarde();
		hideCombo('IIPostCodeS');
	</script>


<?php
        }

    else{
        

        // ofwel is er een actie gezet, ofwel heeft de post-variabele wis de waarde 1



    if ($_POST['wis'] == 1 && $_POST['hvl_id'] > 0){       // wissen
    



		changeActive($_POST['hvl_id'], $backpage);



    }
    else if( isset($_POST['action']) ) {  // actie gedefinieerd

        //-------------------------------------------------------


        $hvl_gem_idstring=(!isset($_POST['hvl_gem_id']))?$_POST['gem2_id']:$_POST['hvl_gem_id'];

        //$hvl_goedgekeurdstring=(!isset($_POST['hvl_goedgekeurd']))?"0":$_POST['hvl_goedgekeurd'];

        //$hvl_convenantstring=(!isset($_POST['hvl_convenant']))?"0":$_POST['hvl_convenant'];

        //$hvl_convenanttypestring=(!isset($_POST['hvl_convenanttype']))?"0":$_POST['hvl_convenanttype'];



		if( !isset($_POST['hvl_gem_id']) ){
		
			$hvl_gem_idstring = $_POST['gem2_id'];
		
		}
		else{
			$hvl_gem_idstring = $_POST['hvl_gem_id'];
		}
		
   if ($hvl_gem_idstring == "0" ||  $hvl_gem_idstring == "") $hvl_gem_idstring = "9999";


        if ($_POST['organisatie']==1000)
            $organi = "NULL";
        else
            $organi = $_POST['organisatie'];

        if (isset($_POST['action']) && ($_POST['veranderd']==0)) {
            print("<script>
                function redirect()
                    {document.location = \"".$backpage."\";}
                setTimeout(\"redirect()\",1000);
                </script>");
			      print("Je hebt niks veranderd in het formulier en <br/>dus hebben we de gegegevens van de zorgverlener behouden.</b><br>");
            die();
        }
        else if( isset($_POST['action']) && ($_POST['action']=="toevoegen") ){

             //----------------------------------------------------------


   /*  $sql = "
         INSERT INTO
            hulpverleners
               (
                    naam,
                    voornaam,
                    tel,
                    fax,
                    gsm,
                    adres,
                    gem_id,
                    email,
                    fnct_id,
                    part_id,


               )
         VALUES
               (
               '".$_POST['hvl_naam']."',
               '".$_POST['hvl_voornaam']."',
               '".$_POST['hvl_tel']."',
               '".$_POST['hvl_fax']."',
               '".$_POST['hvl_gsm']."',
               '".$_POST['hvl_adres']."',
               ".$hvl_gem_idstring.",
               '".$_POST['hvl_email']."',
               ".$_POST['hvl_fnct_id'].",
                    ".$_POST['hvl_part_id'].",
                    ".$hvl_goedgekeurdstring.",
                    ".$hvl_convenantstring.",
                    ".$hvl_convenanttypestring."
               )"; // query om een nieuwe hulpverlener toe te voegen


			   */


        $hvl_gem_idstring=(!isset($_POST['hvl_gem_id']))?$_POST['gem2_id']:$_POST['hvl_gem_id'];

        $sql = "
         INSERT INTO
            hulpverleners
               (
                    naam,
                    voornaam,
                    tel,
                    fax,
                    gsm,
                    adres,
                    gem_id,
                    email,
                   organisatie,
                     fnct_id


               )
         VALUES
               (
               '".$_POST['naam']."',
               '".$_POST['voornaam']."',
               '".$_POST['tel']."',
               '".$_POST['fax']."',
               '".$_POST['gsm']."',
               '".$_POST['adres']."',
               ".$hvl_gem_idstring.",
               '".$_POST['email']."',
                $organi,
               ".$_POST['fnct_id']."


               )"; // query om een nieuwe hulpverlener toe te voegen
			       $ok = mysql_query($sql) or die(mysql_error());
			 
            } //----------------------------------------------------------


    else{
             //----------------------------------------------------------
        $sqlNieuw = "
         INSERT INTO
            hulpverleners
               (
                    naam,
                    voornaam,
                    tel,
                    fax,
                    gsm,
                    adres,
                    gem_id,
                    email,
                    fnct_id,
                   organisatie,
                     vervangt


               )
         VALUES
               (
               '".$_POST['naam']."',
               '".$_POST['voornaam']."',
               '".$_POST['tel']."',
               '".$_POST['fax']."',
               '".$_POST['gsm']."',
               '".$_POST['adres']."',
               ".$hvl_gem_idstring.",
               '".$_POST['email']."',
               ".$_POST['fnct_id'].",
                $organi,
               {$_POST['hvl_id']}


               )"; // query om een nieuwe hulpverlener toe te voegen
              $ok=mysql_query($sqlNieuw);
              $nieuwID = mysql_insert_id();

       $sqlUpdate = "
        UPDATE
            hulpverleners
		SET
      actief = 0
		WHERE
			id = ".$_POST['hvl_id'];

              $ok = $ok && mysql_query($sqlUpdate);

              $sqlPasAan = " update huidige_betrokkenen
                             set persoon_id = $nieuwID
                             where persoon_id = {$_POST['hvl_id']}
                             and genre = 'hulp'";
              $sqlOverlegContact = " update overleg
                             set contact_hvl = $nieuwID
                             where contact_hvl = {$_POST['hvl_id']}
                             and afgerond = 0";
              $ok = $ok && mysql_query($sqlPasAan) && mysql_query($sqlOverlegContact);


    } //----------------------------------------------------------


        if ($ok){
            
	        print("Formuliergegevens zijn <b>succesvol ingevoegd</b>");
            print("
				 <script>
				 function redirect()
					{
					document.location = \"".$backpage."\";
					}
				 setTimeout(\"redirect()\",1500);
				 </script>
			");
            }
        else{
            
            print("De gegevens van het formulier zijn <b>niet succesvol ingevoegd</b>,<br>");

			print($sql);

        } // $action gezet dus formulier-gegevens opslaan
      }
   } //-------------------------------------------------------



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
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------
//---------------------------------------------------------
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------
?>