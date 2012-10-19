<script type="text/javascript" src="../javascript/prototype.js"></script>

<?php


  if ($_GET['overnemen']==1) {
    $actie = "patient_overnemen.php";
    $actiewoord = "Aanvraag versturen om deze pati&euml;nt over te nemen";
    $disable = " disabled=\"disabled\" ";
    $padding = 100;
    $testOfAllesIngevuldIs = false;
  }
  else {
    $actie = "patient_aanpassen_opslaan.php";
    $actiewoord = "Opslaan";
    $padding = 220;
    $testOfAllesIngevuldIs = true;
  }

    //------------------------------------------------------------

    // Postcodelijst Opstellen voor javascript
    if ($_SESSION['profiel']=="OC") {
      $beperkingGemeentes = "where zip = {$records['zip']}";
    }
    else {
      $beperkingGemeentes = "";
    }


    print("<script type=\"text/javascript\">");
    $query = "
		SELECT
            dlzip,
			dlnaam,
			id
		FROM
			gemeente
    $beperkingGemeentes
		ORDER BY
	  		dlzip";

    if ( $result=mysql_query($query) ){
        print ("var gemeenteList = Array(");
        for ($i=0; $i < mysql_num_rows ($result); $i++){
            $records2= mysql_fetch_array($result);
            print ("\"".$records2[0]." ".$records2[1]."\",\"".$records2[2]."\",\n");
        }
      print ("\"9999 onbekend\",\"9999\");");
    }
   print("</script>");
   //----------------------------------------------------------
//---------------------------------------------

?>

<!-- FORMULIER -->

<script type="text/javascript">
var typePatientGeselecteerd = true;

function checkAll() {
<?php
  if ($_SESSION['isOrganisator']==0) print("   return false;// alleen organisatoren mogen gegevens aanpassen.");
  if (!$testOfAllesIngevuldIs) print("return true; // als je aanvraag tot overnemen wil invullen, moeten we niet controleren");

?>

   var fouten = "";

   if (document.zorgplanform.naam.value == "") fouten = fouten + " - geen naam\n";

   if (document.zorgplanform.voornaam.value == "") fouten = fouten + " - geen voornaam\n";

   if (document.zorgplanform.adres.value == "") fouten = fouten + " - geen adres\n";

   if (document.zorgplanform.sex.value == "") fouten = fouten + " - geen geslacht aangeduid\n";

/*

   if (!isMutualiteit()) {

      fouten = fouten + " - geen correcte verzekeringsinstelling of mutualiteit\n";

      document.zorgplanform.mutualiteitInput.value = "";

   }

*/

//   if (isMutualiteit() && document.zorgplanform.mutnr.value == "") fouten = fouten + " - geen lidnummer van de verzekeringinstelling ingevuld\n";



   var rr = document.zorgplanform.rijksregister.value;

   if (rr.length != 11) fouten = fouten + " - het rijksregisternummer is niet correct: het moeten 11 cijfers zijn, en je hebt er maar " + rr.length + "\n";



   if (document.zorgplanform.burgstand_id.value == 1) fouten = fouten + " - geen burgerlijke staat geselecteerd\n";

   if (!($('diabetes').checked || $('nieren').checked || $('geen_zorgtraject').checked)) {
     fouten = fouten + " - niet aangeduid of er een zorgtraject is\n";
   }

   if ($('pat_type_keuze').style.display == "inline") {
     if (!$('c16').checked && !$('c18').checked) {
       fouten = fouten + " - niet gekozen tussen circuit jongeren en circuit volwassenen\n";
     }
   }


   if (fouten == "") {

      return true;

   }

   else {

      alert("We stelden volgende fouten vast in het formulier: \n" + fouten + "\n Probeer opnieuw");

      return false;

   }

}



function beperkMutualiteit() {

  var huidigeMut =  document.zorgplanform.mutualiteitInput.value;

  var huidigeMut1 = huidigeMut.substr(0, huidigeMut.length-1);

  var huidigeMut2 = huidigeMut.substr(0, huidigeMut1.length-1);

  for (key in mutList) {

     if (mutList[key] == huidigeMut1) {

       document.zorgplanform.mutualiteitInput.value = huidigeMut1;

       break;

     }

     else if (mutList[key] == huidigeMut2) {

       document.zorgplanform.mutualiteitInput.value = huidigeMut2;

       break;

     }

  }

}

function isMutualiteit() {

  var huidigeMut =  document.zorgplanform.mutualiteitInput.value;

  if (huidigeMut.substr(0,3) == "000") return false;

  for (key in mutList) {

     if (mutList[key] == huidigeMut) {

        return true;

     }

  }

  return false;

}



</script>

<style type="text/css">
 input[disabled] {
   color: black;
 }
</style>




<form action="<?= $actie ?>" method="post" name="zorgplanform" onsubmit="return checkAll();" autocomplete="off">
<?= $vanTP ?>

    <fieldset>

        <div class="legende">Pati&euml;ntgegevens</div>

        <div>&nbsp;</div>

        <div class="inputItem" id="IIRijksregister">

            <div class="label220">Rijksregisternummer<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="12" value="<?php print($records['rijksregister']);?>" name="rijksregister"  id="rijksregister"
                        <?= $disable ?>
                       onkeyup="checkForNumbersOnly(this,11,0,99999999999,'zorgplanform','rijksregister')"  /> (11 cijfers zonder leestekens)

            </div>

        </div><!--rijksregister-->


<?php

  if ($_SESSION['profiel']=="OC" || $_SESSION['profiel']=="rdc" || $_SESSION['profiel']=="hulp" || $_SESSION['profiel']=="listel") {

?>

        <div class="inputItem" id="IIType">

            <div class="label220">Type pati&euml;nt<div class="reqfield">*</div>&nbsp;: </div>

                <div class="waardex" style="float: none">

                <table>
                <tr>

                <td><input tabindex="4" type="radio" name="pat_type" value="0"

                        <?php $checked=($records['type']==0)?"checked=\"checked\"":"";print ($checked);print($disable); ?> /></td>

                  <td>'Gewone' pati&euml;nt (geen van onderstaande)</td>

                <tr>

                <td><input tabindex="2" type="radio" name="pat_type" value="1"

                        <?php $checked=($records['type']==1)?"checked=\"checked\"":"";print ($checked);print($disable); ?>  /></td>

                <td>PVS-pati&euml;nt</td></tr>


                <tr>
                                <td valign="top"><input tabindex="5" type="radio" name="pat_type" value="7" <?php $checked=($records['type']==7)?"checked=\"checked\"":"";print ($checked);print($disable); ?>/></td>
                                <td>
                                Verminderde psychische zelfredzaamheid<span style="position:relative;top:-2px">*</span>
                                </td>
                </tr>
                <tr>
                                <td valign="top"><input tabindex="5" type="radio" id="pat_type_psy" name="pat_type" value="18"
                                    <?php $checked=($records['type']==16 || $records['type']==18)?"checked=\"checked\"":"";print ($checked);print($disable); ?>
                                    onclick="kiesCircuit(true);"/></td>
                                <td>

                           Verminderde psychische zelfredzaamheid met psychiatrische problematiek   <br/>
                          <span id="pat_type_lang"></span>
                          <div class="reqfield" id="pat_type_req" style="display:none;"></div>
                     <input type="hidden" name="pat_type_hidden" id="pat_type_hidden" value="18" />
                     <input type="hidden" name="pat_type_check" id="pat_type_check" value="0" />
                     <span id="pat_type_keuze" style="display:none;">
                           Circuit
                           <input type="radio" name="pat_type_radio" id="c16" value="16"
                                  <?php if($records['type']==16) print(" checked=\"checked\" ");print($disable); ?>
                                  onclick="$('pat_type_psy').checked = true;" /> jongeren
                           <input type="radio" name="pat_type_radio" id="c18" value="18"
                                  <?php if($records['type']==18) print(" checked=\"checked\" ");print($disable); ?>
                                  onclick="$('pat_type_psy').checked = true;" /> volwassenen
                        <br/>&nbsp;<br/>
                     </span>
                </div>

                                </td>
                </tr>

               </table>
            </div>

        </div><!--pat_type-->

<?php

  }
  else if ($_SESSION['profiel']=="psy") {
?>
        <div class="inputItem" id="IIType">

            <div class="label220"> Type pati&euml;nt<div class="reqfield" id="pat_type_req" style="display:none;">*</div>&nbsp;: </div>

                <div class="waarde" >
                     <span id="pat_type_lang">Psychiatrisch circuit</span>
                     <input type="hidden" name="pat_type_hidden" id="pat_type_hidden" value="18" />
                     <input type="hidden" name="pat_type_check" id="pat_type_check" value="0" />
                     <span id="pat_type_keuze" style="display:none;">
                        Psychiatrisch circuit<br/>
                           <input type="radio" name="pat_type_radio" id="c16" value="16" <?= printChecked($records['type'],16); ?> /> jongeren
                           <input type="radio" name="pat_type_radio" id="c18" value="18" <?= printChecked($records['type'],18); ?> /> volwassenen
                        <br/>&nbsp;<br/>
                     </span>
                </div>
        </div>
<?php
  }
  else  {

     print('<!--menos of tp--><input type="hidden" name="pat_type" value="'. $records['type'] .'" />');

  }

?>



        <div class="inputItem" id="IINaam">

            <div class="label220">Naam<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['naam']);?>" <?= $disable ?> name="naam" />

            </div> 

        </div><!--pat_naam-->

        <div class="inputItem" id="IIVoornaam">

            <div class="label220">Voornaam<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['voornaam']);?>" <?= $disable ?> name="voornaam" />

            </div> 

        </div><!--pat_voornaam-->

        <div class="inputItem" id="IIAdres">

            <div class="label220">Adres<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['adres']);?>" <?= $disable ?> name="adres" />

            </div> 

        </div><!--pat_adres-->







        <div class="inputItem" id="IIPostCode">

            <div class="label220">Postcode<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input size="28"

                    onKeyUp="refreshList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20)"

                    onmouseUp="showCombo('IIPostCodeS',100)"

                    onfocus="showCombo('IIPostCodeS',100)"
                     <?= $disable ?>

                    type="text" name="postCodeInput" value="<?php print($records['dlzip']." ".$records['dlnaam']);?>">

                <input type="button"  <?= $disable ?> onClick="resetList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20,100)" value="<<">

            </div>

        </div><!--postCodeInput-->





        <div class="inputItem" id="IIPostCodeS">

            <div class="label220">Kies eventueel&nbsp;:</div>

            <div class="waarde">

                <select

                  onClick="handleSelectClick('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS')"

                  onblur="handleSelectClick('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS')"
                   <?= $disable ?>
                  name="pat_gem_id" id="pat_gem_id" size="5"></select>

            </div>

        </div><!--pat_gem_id-->







        <div class="inputItem" id="IISex">

            <div class="label220">Geslacht<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input type="radio" name="sex" value="0"  onclick="return false;"

                <?php $checked=($records['sex']==0)?"checked=\"checked\"":"";print ($checked);?> <?= $disable ?> />man&nbsp;&nbsp;

                <input type="radio" name="sex" value="1"  onclick="return false;"

                <?php $checked=($records['sex']==1)?"checked=\"checked\"":"";print ($checked);?> <?= $disable ?> />vrouw

            </div> 

        </div><!--pat_sex-->

        <div class="inputItem" id="IIGeboortedatum">

            <div class="label220">Geboortedatum (ddmmjjjj)<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="2" value="<?php print(substr($records['gebdatum'],6,2));?>" name="gebdatum_dd"

                onKeyup="checkForNumbersOnly(this,2,0,31,'zorgplanform','pat_gebdatum_mm')"
                 <?= $disable ?>
                onblur="checkForNumbersLength(this,2)" disabled="disabled" />&nbsp;/&nbsp;

                <input type="text" size="2" value="<?php print(substr($records['gebdatum'],4,2));?>" name="gebdatum_mm"

                onKeyup="checkForNumbersOnly(this,2,0,12,'zorgplanform','pat_gebdatum_jjjj')" 
                 <?= $disable ?>
                onblur="checkForNumbersLength(this,2)" disabled="disabled" />&nbsp;/&nbsp;

                <input type="text" size="4" value="<?php print(substr($records['gebdatum'],0,4));?>" name="gebdatum_jjjj"

                onKeyup="checkForNumbersOnly(this,4,1850,2030,'zorgplanform','mutualiteitInput')" 
                 <?= $disable ?>
                onblur="checkForNumbersLength(this,4)" disabled="disabled" />

            </div> 

        </div><!--pat_gebdatum_dd,pat_gebdatum_mm,pat_gebdatum_jjjj-->

        <div class="inputItem" id="IIGeboorteplaats">
            <div class="label220">Geboorteplaats&nbsp;: </div>
            <div class="waarde">
                <input tabindex="17" type="text" size="35" value="<?= $records['geboorteplaats'] ?>" name="geboorteplaats" />
            </div>
        </div><!--pat_geboorteplaats-->

        <div class="inputItem" id="IIMutualiteit">

            <div class="label220">Mutualiteit&nbsp;: </div>

            <div class="waarde">

                <input size="28"

                onKeyUp="refreshList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20)"

                onChange="refreshList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20)"

                onmouseUp="showCombo('IIMutualiteitS',100)" onFocus="showCombo('IIMutualiteitS',100)" type="text"
                 <?= $disable ?>
                name="mutualiteitInput" value="<?php print($records['verz_nr']." ".$records['verz_naam']);?>" />

                <input type="button" value="<<"
                 <?= $disable ?>
                onClick="resetList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20,100)" />

            </div> 

        </div>

        <div class="inputItem" id="IIMutualiteitS">

            <div class="label220">Kies eventueel&nbsp;:</div>

            <div class="waarde">

                <select onClick="handleSelectClick('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS')"
                 <?= $disable ?>
                name="pat_mut_id" size="5"></select>

            </div> 

        </div><!--pat_mut_id-->

        <div class="inputItem" id="IILidmaatschapsnummerMut">

            <div class="label220">Lidmaatschapsnummer Mutualiteit&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['mutnr']);?>" <?= $disable ?> name="mutnr" />

            </div> 

        </div><!--pat_mutnr-->


        <div class="inputItem" id="IIEmail">

            <div class="label220">E-mail&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['email']);?>" name="email" <?= $disable ?> />

            </div> 

        </div><!--pat_email-->

        <div class="inputItem" id="IITelefoon">

            <div class="label220">Tel.&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['tel']);?>" name="tel" <?= $disable ?> />

            </div> 

        </div><!--pat_tel-->

        <div class="inputItem" id="IIGsm">

            <div class="label220">GSM&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['gsm']);?>" name="gsm" <?= $disable ?> />

            </div> 

        </div><!--pat_gsm-->

        <div class="inputItem" id="IIBurgStand">

            <div class="label220">Burgerlijke Staat<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <select size="1" name="burgstand_id"  <?= $disable ?> >

<?php

//----------------------------------------------------------

// Haal records burgelijke staat

//----------------------------------------------------------



      $query = "

         SELECT

            id,

            omschr

         FROM

            burgstaat

    		 WHERE

		      	actief <>0

         ORDER BY

            omschr";

      if ($result=mysql_query($query))

      {

         for ($i=0; $i < mysql_num_rows ($result); $i++)

         {

            $velden= mysql_fetch_array($result);

            if ($velden['id']==$records['burgstand_id']) {

              print ("

               <option value=\"".$velden['id']."\" selected=\"selected\">".$velden['omschr']."</option>\n");

              $oudeBurgStaat = "<input type=\"hidden\" name=\"oud_burgstand_id\" value=\"{$velden['id']}\" />";

            }

            else {

            print ("

               <option value=\"".$velden['id']."\">".$velden['omschr']."</option>\n");

            }

         }

     }

     print($oudeBurgStaat);

?>

                </select>

            </div> 

        </div><!--pat_burgstand_id-->

        <div class="inputItem" id="IINaamPartner">

            <div class="label220">Naam Partner&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['naam_echtg']);?>" name="naam_echtg" <?= $disable ?> />

                <input type="hidden" value="<?php print($records['naam_echtg']);?>" name="oud_naam_echtg" <?= $disable ?> />

            </div> 

        </div><!--pat_naam_echtg-->

        <div class="inputItem" id="IIVoornaamPartner">

            <div class="label220">Voornaam Partner&nbsp;: </div>

            <div class="waarde">

                <input type="text" size="35" value="<?php print($records['voornaam_echtg']);?>" name="voornaam_echtg" <?= $disable ?> />

                <input type="hidden" value="<?php print($records['voornaam_echtg']);?>" name="oud_voornaam_echtg" />

            </div> 

        </div><!--pat_voornaam_echtg-->

        <div class="inputItem" id="IIAlarmsysteem__">

            <div class="label220">Alarmsysteem&nbsp;: </div>

            <div class="waarde">

                <input type="radio" name="alarm" value="0" 

                <?php $checked=($records['alarm']==0)?"checked=\"checked\"":"";print ($checked);?> <?= $disable ?> />nee&nbsp;&nbsp;

                <input type="radio" name="alarm" value="1" 

                <?php $checked=($records['alarm']==1)?"checked=\"checked\"":"";print ($checked);?>  <?= $disable ?>/>ja&nbsp;&nbsp;

                <input type="radio" name="alarm" value="2" 

                <?php $checked=($records['alarm']==2)?"checked=\"checked\"":"";print ($checked);?>  <?= $disable ?>/>onbekend

            </div> 
        </div><!--pat_alarm-->


        <div class="inputItem" id="IIZorgtraject">
            <div class="label220">Zorgtraject<div class="reqfield">*</div>:<a name="zorgtraject"> </a></div>
            <div class="waarde">
                Is de pati&euml;nt in een zorgtraject opgenomen?<br/>
                <input tabindex="29" type="checkbox" name="diabetes" id="diabetes" value="1" <?= printChecked($records['zorgtraject_diabetes'],1) ?> onclick="valideerZorgtraject();"/>Diabetes&nbsp;&nbsp;<br/>
                <input tabindex="30" type="checkbox" name="nieren" id="nieren" value="1" <?= printChecked($records['zorgtraject_nieren'],1) ?> onclick="valideerZorgtraject();"/>Chronische nierinsuffici&euml;ntie&nbsp;&nbsp;<br/>
<?php
  if ($records['zorgtraject_datum'] != "0000-00-00" && $records['zorgtraject_diabetes']==0 && $records['zorgtraject_nieren']==0) {
    $geenZorgtraject = " checked=\"checked\" ";
  }
?>
                <input tabindex="31" type="checkbox" name="geen_zorgtraject" id="geen_zorgtraject" value="1" <?= $geenZorgtraject ?> onclick="geenZorgtraject();"/>Geen zorgtraject<br/>&nbsp;<br/>
            </div>
        </div><!--toestemming_zh-->

        <div class="inputItem" id="IIToestemming_zh">
            <div class="label220">Toestemming voor ziekenhuis<span style="position:relative;top:-2px">**</span>: </div>
            <div class="waarde">
                <input tabindex="29" type="radio" name="toestemming_zh" value="-1" <?= printChecked($records['toestemming_zh'],-1) ?>/>nee&nbsp;&nbsp;
                <input tabindex="30" type="radio" name="toestemming_zh" value="1" <?= printChecked($records['toestemming_zh'],1) ?>/>ja&nbsp;&nbsp;
                <input tabindex="31" type="radio" name="toestemming_zh" value="0" <?= printChecked($records['toestemming_zh'],0) ?> />nog geen antwoord
            </div>
        </div><!--toestemming_zh-->

    </fieldset>

<?php


/************ einde uitwisseling tussen menos en gdt ************/
  if ($records['actief'] == 1 && $records['menos']==1) {
    // zowel in gdt als in menos
    $patient_menos = getUniqueRecord("select * from patient_menos where patient = '{$records['code']}'");
    
    if ($_SESSION['profiel']=="menos") {
      // vragen aan menos
?>
    <fieldset>
        <div class="inputItem" id="IIUitwisseling">
            <div class="label220">Uitwisseling tussen zorgteams</div>
            <div class="waarde">
                 <input type="checkbox" value="1" name="gdt2menosVraag" <?= printChecked(1,$patient_menos['gdt2menos_vraag']); ?> />
                 Ik wens dat personen die toegevoegd worden aan het zorgteam van SEL automatisch aan mijn zorgteam toegevoegd worden.
                 <?php
                   if ($patient_menos['gdt2menos_toestemming']==1) {
                     print("<br/><em>Deze vraag werd positief beantwoord.</em>\n");
                   }
                 ?>
                 <br/>
                 <input type="checkbox" value="1" name="menos2gdtToestemming" <?= printChecked(1,$patient_menos['menos2gdt_toestemming']); ?> />
                 Ik geef toestemming dat personen die ik toevoeg aan mijn zorgteam ook aan het zorgteam van SEL toegevoegd worden.
                 <?php
                   if ($patient_menos['menos2gdt_vraag']==1) {
                     print("<br/><em>Deze vraag werd gesteld door de overlegco&ouml;rdinator GDT.</em>\n");
                   }
                 ?>
                 <input type="hidden" name="menosVragen" value="1" />
            </div>
        </div>
   </fieldset>
<?php
    }
    else {
      // vragen aan gdt
?>
    <fieldset>
        <div class="inputItem" id="IIUitwisseling">
            <div class="label220">Uitwisseling tussen zorgteams</div>
            <div class="waarde">
                 <input type="checkbox" value="1" name="menos2gdtVraag" <?= printChecked(1,$patient_menos['menos2gdt_vraag']); ?> />
                 Ik wens dat personen die toegevoegd worden aan het zorgteam van Menos automatisch aan mijn zorgteam toegevoegd worden.
                 <?php
                   if ($patient_menos['menos2gdt_toestemming']==1) {
                     print("<br/><em>Deze vraag werd positief beantwoord.</em>\n");
                   }
                 ?>
                 <br/>
                 <input type="checkbox" value="1" name="gdt2menosToestemming" <?= printChecked(1,$patient_menos['gdt2menos_toestemming']); ?> />
                 Ik geef toestemming dat personen die ik toevoeg aan mijn zorgteam ook aan het zorgteam van Menos toegevoegd worden.
                 <?php
                   if ($patient_menos['gdt2menos_vraag']==1) {
                     print("<br/><em>Deze vraag werd gesteld door Menos.</em>\n");
                   }
                 ?>
                 <input type="hidden" name="gdtVragen" value="1" />
            </div>
        </div>
   </fieldset>
<?php
    }
  }
/************ einde uitwisseling tussen menos en gdt ************/


  if ($_SESSION['isOrganisator']==0) $bekijk = 1;

  if (!isset($bekijk)) {

?>

    <fieldset>

        <div class="inputItem" id="IIButton">


            <div class="waarde" style="padding-left: <?= $padding ?>px;">

                <input type="hidden" name="nr" value="<?php print($_POST['pat_nr']);?>"  />

                <input type="hidden" name="h_pat_gem_id" value="<?php print($records['gem_id']);?>"  />

                <input type="hidden" name="h_pat_mut_id" value="<?php print($records['mut_id']);?>" />


                <input type="submit" value="<?= $actiewoord ?>" name="action" />

            </div> 

        </div><!--action-->

   </fieldset>

<?php

  }

  

?>





</form>

<script type="text/javascript">
<?php
  if ($_SESSION['profiel']=="psy" || $records['type']==16 || $records['type']==18) {
    print("   var isPsy = true;");
  }
  else {
    print("   var isPsy = false;");
  }
?>

  var rr = $F('rijksregister');
  var ouderdom = leeftijd(rr);
<?php
  if ($records['type']==16) {
?>
  if (ouderdom < 16) {
    kiesCircuit(isPsy);
  }
  else {
    $('pat_type_keuze').style.display = "inline";
  }
<?php
  }
  else {
?>
  if (ouderdom >= 18) {
    kiesCircuit(isPsy);
  }
<?php
  }
  if ($_GET['verspring']=="zorgtraject") {
?>
    window.location.hash = "zorgtraject";
<?php
  }
  else {
?>
    document.forms['zorgplanform'].elements['naam'].focus();
<?php
  }
?>
    hideCombo('IIPostCodeS');

    hideCombo('IIMutualiteitS');

</script>

<!-- EINDE FORMULIER -->
