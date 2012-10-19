<?php

//------------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//------------------------------------------------------------



$paginanaam="HVL,ZVL of XVL toevoegen of aanpassen";



if ( isset($_SESSION["toegang"] ) && ($_SESSION["toegang"]=="toegestaan") )

    {

    require("../includes/html_html.inc");



    print("<head>");



    require("../includes/html_head.inc");

    require("../includes/checkForNumbersOnly.inc");

    require("../includes/checkCheque.inc");



    if (isset($_GET['a_backpage'])) $a_backpage = $_GET['a_backpage'];

    if (isset($_POST['a_backpage'])) $a_backpage = $_POST['a_backpage'];

    if (isset($_GET['backpage'])) $a_backpage = $_GET['backpage'];

    if (isset($_POST['backpage'])) $a_backpage = $_POST['backpage'];



    //------------------------------------------------------------

    // Postcodelijst Opstellen voor javascript



    print("<script type=\"text/javascript\">");



    $query = "

        SELECT

            dlzip,

			dlnaam,

			id

        FROM

           gemeente

      ORDER BY

         dlzip

	";



    if ($result=mysql_query($query)){

        

        print ("var gemeenteList = Array(");



        for ($i=0; $i < mysql_num_rows ($result); $i++){

            

            $records= mysql_fetch_array($result);



            print ("\"".$records[0]." ".$records[1]."\",\"".$records[2]."\",\n");



        }



      print ("\"9999 onbekend\",\"9999\");");



    }

	else{print(mysql_error());}

   print("</script>"); 

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



    if ( isset($_POST['hvl_id']) ){ $a_hvl_id=$_POST['hvl_id']; }

    if ( isset($_GET['id']) ){ $a_hvl_id=$_GET['id']; }



//------------------------------------------------------------

// Deze pagina kan gebruikt worden om nieuwe hulpverleners aan 

// de tabel HULPVERLENERS toe te voegen of om een bestaande

// record van deze tabel aan te passen. Indien a_hvl_id per

// URL wordt doorgegeven dan moeten de gegevens aangepast

// worden anders wordt er een nieuwe record aangemaakt. Delen

// van deze pagina worden niet weergegeven indien de login

// dit niet toestaat. Deze pagina verlangt ook een per URL

// doorgegeven pagina-naam om na afloop terug naar te springen.

//------------------------------------------------------------



    if (!isset($_POST['action']) && ($_POST['wis'] != 1) ){ // $action niet gezet, en niet wissen,  dus formulier weergeven

        

        if ( isset($a_hvl_id) ){

            

            //------------------------------------------------------------ 

            // $a_hvl_id gezet dus gegevens ophalen om formulier te vullen

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

					h.convenant,    

					h.riziv1,

                    h.riziv2,       

					h.riziv3, 

					h.organisatie,

                    h.fax,          

					h.gsm,

					h.vervangt,



					g.id AS gid,

                    g.dlnaam,     

					g.dlzip,      

						

					f.naam AS fnaam,



                    fg.naam AS fgnaam, 

					fg.id AS fgid

						





                FROM

                    hulpverleners h,

                    functies f,

                    functiegroepen fg,

                    gemeente g



                WHERE

                    g.id = h.gem_id AND

                    f.id=h.fnct_id AND

                    fg.id=f.groep_id AND

                    h.id=".$a_hvl_id;





            $result = mysql_query($query);



            if (mysql_num_rows($result)<>0 ){

                

                $records= mysql_fetch_array($result);



                $valID=             $records['hid'];

                $valNaam=           $records['hnaam'];

                $valVoornaam=       $records['voornaam'];

                $valAdres=          $records['adres'];



                $valGemeente=       $records['dlzip']." ".$records['dlnaam'];



                $valTel=            $records['tel'];

                $valFax=            $records['fax'];

                $valGsm=            $records['gsm'];

                $valEmail=          $records['email'];



                $valReknr1=         substr($records['reknr'],0,3);

                $valReknr2=         substr($records['reknr'],4,7);

                $valReknr3=         substr($records['reknr'],12,2);



                $valConvenant=      $records['convenant'];

                $valVervangt =      $records['vervangt'];



				//print($valConvenant);



                //$valConvenanttype=  $records['convenanttype'];



                $valRizivNr1=       substr($records['riziv1'],0,1);

                $valRizivNr2=       substr($records['riziv1'],1,5);



                $valRizivNr3=       ($records['riziv2']<10)?"0".$records['riziv2']:$records['riziv2'];



                $valRizivNr4=       ($records['riziv3']<100)?"0".$records['riziv3']:$records['riziv3'];

                $valRizivNr4=       ($records['riziv3']<10)?"0".$valRizivNr4:$valRizivNr4;



                $valFunctie=        $records['fnct_id'];

                $valFunctieGroep=   $records['fgid'];





                $valOrganisatie =   $records['organisatie'];

                $valGem2=           $records['gid'];   



                }



            else{

                print("Geen record gevonden");

				//print(mysql_error());

			}

            //------------------------------------------------------------

            }

        

        else{

             

            //-------------------------------------------------------------

            // Variabelen vullen met niets om fouten te voorkomen 



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

            //$valConvenanttype="";

            $valRizivNr1="";

            $valRizivNr2="";

            $valRizivNr3="";

            $valRizivNr4="";

            $valFunctie="";

            $valFunctieGroep="";





            $valGem2="9999"; 



            //-------------------------------------------------------------

            } 

?>



<script language="javascript" src="../includes/formuliervalidatie.js">

</script>



<script language="javascript" type="text/javascript">

var convenant = "<?= $valConvenant ?>";

var convenantOrigineel = "<?= $valConvenant ?>";



function checkFormZvl()

	{

	fouten = "";

	

	fouten = fouten + checkLeeg 	('edithvlform', 'naam', 	'- Vul een achternaam in');

	fouten = fouten + checkLeeg 	('edithvlform', 'voornaam', '- Vul een voornaam in');

	

	fouten = fouten + checkLeeg 	('edithvlform', 'riziv1', '- Vul het 1ste vakje van het RIZIV-nummer in');

	fouten = fouten + checkLeeg 	('edithvlform', 'riziv2', '- Vul het 2de vakje van het RIZIV-nummer in');

	fouten = fouten + checkLeeg 	('edithvlform', 'riziv3', '- Vul het 3de vakje van het RIZIV-nummer in');

	fouten = fouten + checkLeeg 	('edithvlform', 'riziv4', '- Vul het 4de vakje van het RIZIV-nummer in');



  functie = document.edithvlform.fnct_id.value;

  r1 = document.edithvlform.riziv1.value;

  r2 = document.edithvlform.riziv2.value;

  r3 = document.edithvlform.riziv3.value;

  r4 = document.edithvlform.riziv4.value;

  //alert(checkRiziv(functie, r1, r2, r3, r4));



  if (!checkRiziv(functie, r1, r2, r3, r4))

    fouten = fouten + "- Vul een geldig RIZIV-nummer in\n";



  if (checkLeeg('edithvlform','reknr1',"a") == "" ||

      checkLeeg('edithvlform','reknr2',"a") == "" ||

      checkLeeg('edithvlform','reknr3',"a") == "")

   	fouten = fouten + checkBank 	('edithvlform', 'reknr1', 'reknr2', 'reknr3');

	

	//fouten = fouten + checkLeeg 	('edithvlform', 'adres', 	'- Vul een adres in');

	//fouten = fouten + checkLeeg 	('edithvlform', 'tel', 		'- Vul een geldig telefoonnummer in');

	//fouten = fouten + checkLeeg 	('edithvlform', 'postCodeInput','- Vul een geldige postcode in');



	if (convenant == "" || convenant == "niet")

     fouten = fouten + '- Kies een van de twee convenantie-types';





  var velden = Array('convenant','email','gsm','fax','tel','postcode','adres','_organisatie','reknr3','reknr2','reknr1','riziv4','riziv3','riziv2','riziv1','_fnct_id','voornaam','naam');

	//alert(bevestigVeranderingen('edithvlform',velden));

	return valideer() <?= $bevestigChanges ?>;

	}



var origineel = new Array();



</script>



<form action="edit_zvl.php" method="post" name="edithvlform" onsubmit="return checkFormZvl();"  autocomplete="off">

<input type="hidden" name="veranderd" value="-1" />

<fieldset>

    <div class="legende">Gegevens zorgverlener:</div>

    <div>&nbsp;</div>



    <div class="label160">Naam<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valNaam)?>" name="naam" />

    </div><!--Naam -->

    <div class="label160">Voornaam<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="35" value="<?php print($valVoornaam)?>" name="voornaam" />

    </div><!--Voornaam -->

    <div class="label160">Functie<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <select size="1" name="fnct_id" />



<?php

//------------------------------------------------------------------

// Vul Input-select-element vanuit dbase: functies



$query = "

    SELECT

        f.id,

        f.naam

    FROM

        functies f

    WHERE

        (f.groep_id = 2 OR f.groep_id = 4)

	AND

		f.actief <> 0

    ORDER BY

        f.naam";



if ($result=mysql_query($query)){

    

    for ($i=0; $i < mysql_num_rows ($result); $i++){

        

        $records= mysql_fetch_array($result);



        $selected=($valFunctie==$records[0])?"selected=\"selected\"":"";



			print ("<option value=\"".$records[0]."\" ".$selected.">".$records[1]."</option>\n");



        }

    }

//------------------------------------------------------------------

?>

        </select>

    </div><!--Functie -->

<script language="javascript">

origineel['fnct_id'] = document.edithvlform.fnct_id.selectedIndex;

</script>





    <div class="label160">RIZIV nummer<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">



        <input type="text" size="1" value="<?php print($valRizivNr1)?>" name="riziv1" 

            onKeyup="checkForNumbersOnly(this,1,0,10,'edithvlform','riziv2')" />

            &nbsp;/&nbsp;

        <input type="text" size="5" value="<?php print($valRizivNr2)?>" name="riziv2" 

            onKeyup="checkForNumbersOnly(this,5,0,100000,'edithvlform','riziv3')" />

            &nbsp;/&nbsp;

        <input type="text" size="2" value="<?php print($valRizivNr3)?>" name="riziv3"

            onKeyup="checkForNumbersOnly(this,2,0,100,'edithvlform','riziv4')" />

            &nbsp;/&nbsp;

        <input type="text" size="3" value="<?php print($valRizivNr4)?>" name="riziv4"

            onKeyup="checkForNumbersOnly(this,3,0,1000,'edithvlform','reknr1')" />

      </div><!--RIZIV -->







    <div class="label160">Bankrekeningnummer&nbsp;: </div>

    <div class="waarde">

        <input type="text" size="3" value="<?php print($valReknr1)?>" name="reknr1" 

            onKeyup="checkForNumbersOnly(this,3,-1,1000,'edithvlform','reknr2')" />

            &nbsp;-&nbsp;

        <input type="text" size="7" value="<?php print($valReknr2)?>" name="reknr2" 

            onKeyup="checkForNumbersOnly(this,7,-1,10000000,'edithvlform','reknr3')" />

            &nbsp;-&nbsp;

        <input type="text" size="2" value="<?php print($valReknr3)?>" name="reknr3" 

            onKeyup="checkForNumbersOnly(this,2,-1,100,'edithvlform','organisatie')" onblur="checkCheque()" />

      </div><!--Bankrekening -->





        <div class="label160">Organisatie&nbsp;: </div>

        <div class="waarde" >

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

 selectObj = document.edithvlform.gem_id;

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

 selectObj = document.edithvlform.gem_id;

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

      $query = "

	SELECT

	  	*

	FROM

    organisatie

  where

    actief = 1 AND

    (genre = 'ZVL' or genre is NULL)

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









    <div class="label160" ondblclick="invoer('adres');invoerPC();">Contactadres&nbsp;: </div>

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

           <span id="postcodevast" ondblclick="invoer('adres');invoerPC()"></span>

        </div>

    </div>





    <div class="inputItem" id="IIPostCodeS">

        <div class="label160">Kies eventueel&nbsp;:</div>

        <div class="waarde">

            <select onClick="handleSelectClick('edithvlform','postCodeInput','hvl_gem_id',1,'IIPostCodeS')" 

            name="gem_id" id="hvl_gem_id" size="5">

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





    <div class="label160">Convenant<div class="reqfield">*</div>&nbsp;: </div>



    <!--<div class="waarde">



        <input type="checkbox" value="1" 

        name="convenant" <?php if($valConvenant=="1")print("checked=\"checked\""); ?> />

        &nbsp;Afgesloten&nbsp;&nbsp;&nbsp;



        <input type="checkbox" value="1" 

        name="convenant" <?php if($valConvenanttype=="1")print("checked=\"checked\""); ?> />

        &nbsp;Gezamelijk



    </div>--><!--Convenant -->



	<div class="waarde">



		<input type="radio" value="afgesloten" name="convenant"

           onclick="document.getElementById('convenantDoc').style.display='block';convenant='afgesloten';" <?php if($valConvenant=="afgesloten")print("checked=\"checked\""); ?> /> &nbsp;Individueel&nbsp;&nbsp;&nbsp;



		<input type="radio" value="gezamenlijk" name="convenant"

           onclick="document.getElementById('convenantDoc').style.display='none';convenant='gezamenlijk';" <?php if($valConvenant=="gezamenlijk")print("checked=\"checked\""); ?> /> &nbsp;Gezamelijk



    <div id="convenantDoc" style="display:none;">

       <a target="_blank" href="/html/Convenant GDT LISTEL vzw 2010.pdf">Druk convenant af [pdf]</a>

    </div>

	</div>





    <?php





?><!--Goedgekeurd -->





<?php

  if (isset($valVervangt)) {

?>

      <div class="label160">Vervangt : </div>

      <div class="waarde">

         <a href="edit_hvl.php?readOnly=1&hvl_id=<?= $valVervangt ?>">hulpverlener <?= $valVervangt ?></a>

      </div><!--GSM -->

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

            <input type="hidden" name="backpage" value="<?php print($a_backpage)?>" />

         <input type="submit" value="<?php print($action)?>" />

         </div>

    <!--Button opslaan -->

</fieldset>

<?php

}

?>



</form>





<script type="text/javascript">document.forms['edithvlform'].elements['naam'].focus();startWaarde();</script>



<?php

        }





    else{



        



        // ofwel is er een actie gezet, ofwel heeft de post-variabele wis de waarde 1





    if ($_POST['wis'] == 1 && $_POST['hvl_id'] > 0){        // wissen

    

   /*/ $query2="

        DELETE FROM

            hulpverleners

        WHERE

            id=".$_POST['id'];



    $doe2=mysql_query($query2);



        if ($doe2){

          print("Deze persoon is <b>succesvol verwijderd.</b>



				<script>



					 function redirect(){

						

						document.location = \"".$a_backpage."\";

					 }



					 setTimeout(\"redirect()\",1500);



				 </script>");



          }



        else{

            

            print("Deze persoon is <b>niet</b> succesvol verwijderd.<br />");



			//print($query2);

        }*/



		/*print($_POST['hvl_id']);

		print($_POST['IIZvl']);*/





		changeActive($_POST['hvl_id'], $a_backpage);





    }





    else if (isset($_POST['action'])) {  // actie gedefinieerd







        $gem_idstring=(!isset($_POST['gem_id']))?$_POST['gem2_id']:$_POST['gem_id'];

        if ($gem_idstring == "0" ||  $gem_idstring == "") $gem_idstring = "9999";

        

        //$goedgekeurdstring=(!isset($_POST['goedgekeurd']))?"0":$_POST['goedgekeurd'];



        //$convenantstring=(!isset($_POST['convenant']))?"niet":$_POST['convenant'];





		if(!isset($_POST['convenant']) ){

		

			$convenantstring = "niet";

		

		}



		else{

		

			//$convenantstring = "\"".$_POST['convenant']."\"";

			$convenantstring = $_POST['convenant'];

		}



        //$convenanttypestring=(!isset($_POST['convenanttype']))?"0":$_POST['convenanttype'];







        if( ($_POST['reknr1']<>"") && ($_POST['reknr2']<>"") && ($_POST['reknr3']<>"") ){



			$reknrstring = $_POST['reknr1']."-".$_POST['reknr2']."-".$_POST['reknr3'];



		}

        else{



			$reknrstring="";



		}



        $rizivstring = $_POST['riziv1'].$_POST['riziv2'];





        if (isset($_POST['action']) && ($_POST['veranderd']==0)) {

            print("<script>

                function redirect()

                    {document.location = \"".$a_backpage."\";}

                setTimeout(\"redirect()\",1000);

                </script>");

			      print("Je hebt niks veranderd in het formulier en <br/>dus hebben we de gegegevens van de zorgverlener behouden.</b><br>");

            die();

        }

        else if( isset($_POST['action']) && ($_POST['action'] == "toevoegen") ){

            

            //----------------------------------------------------------

            // query om een nieuwe hulpverlener toe te voegen



            /*$sql = "

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

                    riziv1,

                    riziv2,

                    riziv3,

                    fnct_id,

                    part_id,

                    goedgekeurd,

                    convenant,

                    convenanttype,

                    reknr

                    )

            VALUES

                (

                '".$_POST['naam'].      "',

                '".$_POST['voornaam'].  "',

                '".$_POST['tel'].       "',

                '".$_POST['fax'].       "',

                '".$_POST['gsm'].       "',

                '".$_POST['adres'].     "',

                '".$gem_idstring.       "',

                '".$_POST['riziv3'].    "',

                '".$_POST['riziv4'].    "',

                '".$_POST['email'].     "',

                '".$rizivstring.        "',

                '".$_POST['fnct_id'].   "',

                '".$_POST['part_id'].   "',

                '".$goedgekeurdstring.  "',

                '".$convenantstring.    "',

                '".$convenanttypestring."',

                '".$reknrstring.        "'

                )"; */



        if ($_POST['organisatie']==1000)

            $organi = "NULL";

        else

            $organi = $_POST['organisatie'];



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

                    riziv1,

                    riziv2,

                    riziv3,

                    fnct_id,

                    convenant,

                    organisatie,

                    reknr

                    )

            VALUES

                (

                '".$_POST['naam'].      "',

                '".$_POST['voornaam'].  "',

                '".$_POST['tel'].       "',

                '".$_POST['fax'].       "',

                '".$_POST['gsm'].       "',

                '".$_POST['adres'].     "',

                '".$gem_idstring.       "',

                '".$_POST['email'].     "',

                '".$rizivstring.        "',

                '".$_POST['riziv3'].    "',

                '".$_POST['riziv4'].    "',

                '".$_POST['fnct_id'].   "',

                '".$convenantstring.    "',

                $organi,

                '".$reknrstring.        "'

                )"; 

             $ok=mysql_query($sql);

            //----------------------------------------------------------

            }

        else{ 

            

            //----------------------------------------------------------

            // query om een hulpverlener aan te "passen"

            if ($_POST['organisatie']==1000)

              $organi = "NULL";

            else

              $organi = $_POST['organisatie'];



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

                    riziv1,

                    riziv2,

                    riziv3,

                    fnct_id,

                    convenant,

                    organisatie,

                    reknr,

                    vervangt

                    )

            VALUES

                (

                '".$_POST['naam'].      "',

                '".$_POST['voornaam'].  "',

                '".$_POST['tel'].       "',

                '".$_POST['fax'].       "',

                '".$_POST['gsm'].       "',

                '".$_POST['adres'].     "',

                '".$gem_idstring.       "',

                '".$_POST['email'].     "',

                '".$rizivstring.        "',

                '".$_POST['riziv3'].    "',

                '".$_POST['riziv4'].    "',

                '".$_POST['fnct_id'].   "',

                '".$convenantstring.    "',

                $organi,

                '".$reknrstring.        "',

                {$_POST['hvl_id']}

                )";

              $ok=mysql_query($sqlNieuw);

              $nieuwID = mysql_insert_id();



              $sqlUpdate = "

                UPDATE

                  hulpverleners

                SET

                  actief = 0

                WHERE

                  id=".$_POST['hvl_id'];

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



            //----------------------------------------------------------

            }

        if ($ok){

            

            print("<script>

                function redirect()

                    {document.location = \"".$a_backpage."\";}

                setTimeout(\"redirect()\",1000);

                </script>");

			print("De gegegevens van het formulier zijn <b>succesvol ingevoegd.</b><br>");

            }

        else{

            

            print("De gegevens van het formulier zijn <b>niet succesvol ingevoegd</b>,<br>");

			      print($sql);

         }

        }

    }





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

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>