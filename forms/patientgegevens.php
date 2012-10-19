<script type="text/javascript" src="../javascript/prototype.js"></script>



<script type="text/javascript">

function createREQ() {

    try {

      req = new XMLHttpRequest(); // firefox, safari, …

    }

    catch (err1) { try {

      req = new ActiveXObject("Msxml2.XMLHTTP"); // sommige IE

    }

    catch (err2) { try {

      req = new ActiveXObject("Microsoft.XMLHTTP"); // meeste IE

    }

    catch (err3) {

      req = false;

      alert("Deze browser ondersteunt geen Ajax. Dikke pech!");

    }}}

  return req;

}

var typePatientGeselecteerd = false;

function checkAll() {

   beperkMutualiteit();

   beperkGemeente();


   var fouten = "";

   if (document.zorgplanform.pat_naam.value == "") fouten = fouten + " - geen naam\n";

   if (document.zorgplanform.pat_voornaam.value == "") fouten = fouten + " - geen voornaam\n";

   if (!typePatientGeselecteerd) fouten = fouten + " - geen type patient geselecteerd\n";
   
   if (!isGemeente()) fouten = fouten + " - geen geldige postcode\n";

   if (document.zorgplanform.pat_adres.value == "") fouten = fouten + " - geen adres\n";



   if ((document.zorgplanform.pat_gebdatum_dd.value == "") || (document.zorgplanform.pat_gebdatum_mm.value == "") || (document.zorgplanform.pat_gebdatum_jjjj.value == "")) fouten = fouten + " - geen geldige geboortedatum\n";


   if ($('pat_type_keuze').style.display == "inline") {
     if (!$('c16').checked && !$('c18').checked) {
       fouten = fouten + " - niet gekozen tussen circuit jongeren en circuit volwassenen\n";
     }
   }
/*

   if (!isMutualiteit()) {

      fouten = fouten + " - geen correcte verzekeringsinstelling of mutualiteit\n";

      document.zorgplanform.mutualiteitInput.value = "";

   }

*/

//   if (isMutualiteit() && document.zorgplanform.pat_mutnr.value == "") fouten = fouten + " - geen lidnummer van de verzekeringinstelling ingevuld\n";



   var rr = document.zorgplanform.rijksregister.value;

   if (rr.length != 11) fouten = fouten + " - het rijksregisternummer is niet correct:\n      i.p.v. 11 cijfers heb je er maar " + rr.length + "\n";
   else if (document.zorgplanform.pat_mutnr.value == "") document.zorgplanform.pat_mutnr.value = document.zorgplanform.rijksregister.value;



    if (!document.zorgplanform.pat_sex[0].checked && !document.zorgplanform.pat_sex[1].checked) fouten = fouten + " - geen geslacht aangeduid\n";

    if (document.zorgplanform.pat_burgstand_id.value == 1) fouten = fouten + " - geen burgerlijke staat geselecteerd\n";

    if (!($('diabetes').checked || $('nieren').checked || $('geen_zorgtraject').checked)) {
      fouten = fouten + " - niet aangeduid of er een zorgtraject is\n";
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

  var huidigeMut1 = "";

  if (huidigeMut.length >= 1 ) huidigeMut1 = huidigeMut.substr(0, huidigeMut.length-1);

  var huidigeMut2 = "";

  if (huidigeMut.length >= 2 ) huidigeMut2 = huidigeMut1.substr(0, huidigeMut1.length-1);

  for (key in mutList) {

     if (mutList[key] == huidigeMut1) {

       document.zorgplanform.mutualiteitInput.value = huidigeMut1;

       refreshList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20);

       break;

     }

     else if (mutList[key] == huidigeMut2) {

       document.zorgplanform.mutualiteitInput.value = huidigeMut2;

       refreshList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20);

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

function beperkGemeente() {

  var huidigeGemeente =  document.zorgplanform.postCodeInput.value;

  var huidigeGemeente1 = "";

  if (huidigeGemeente.length >= 1 ) huidigeGemeente1 = huidigeGemeente.substr(0, huidigeGemeente.length-1);

  var huidigeGemeente2 = "";

  if (huidigeGemeente.length >= 2 ) huidigeGemeente2 = huidigeGemeente1.substr(0, huidigeGemeente1.length-1);

  for (key in gemeenteList) {

     if (gemeenteList[key] == huidigeGemeente1) {

       document.zorgplanform.postCodeInput.value = huidigeGemeente1;

       refreshList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20);

       break;

     }

     else if (gemeenteList[key] == huidigeGemeente2) {

       document.zorgplanform.postCodeInput.value = huidigeGemeente2;

       refreshList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20);

       break;

     }

  }

}

function isGemeente() {

  var huidigeGemeente =  document.zorgplanform.postCodeInput.value;

  for (key in gemeenteList) {

     if (gemeenteList[key] == huidigeGemeente) {

        return true;

     }

  }

  return false;

}

var ditIsEenNieuwe = false;

function zoekDubbelePatienten() {
<?php
  if ($_SESSION['profiel']=="hoofdproject" || $_SESSION['profiel']=="bijkomend project") {
     print("    zoekDubbelePatientenOpNaam();\n");
  }
  else if ($_SESSION['profiel']=="psy") {
     print("    zoekDubbelePatientenOpRijksregister();kiesCircuit(true);\n");
  }
  else {
     print("    zoekDubbelePatientenOpRijksregister();kiesCircuit(false);\n");
  }
?>
}

function zoekDubbelePatientenOpNaam() {
   var geslacht = -1;

   if (document.zorgplanform.pat_sex[0].checked ) geslacht = document.zorgplanform.pat_sex[0].value;

   if (document.zorgplanform.pat_sex[1].checked ) geslacht = document.zorgplanform.pat_sex[1].value;

   if (($F('pat_gebdatum_dd') > 0) &&

       ($F('pat_gebdatum_mm') > 0) &&

       ($F('pat_gebdatum_jjjj') > 0) &&

       ($F('pat_naam') != "") &&

       ($F('pat_voornaam') != "")  &&

       (geslacht != -1) ) {

       // alle vakjes zijn ingevuld, dus nu alle gelijkenissen ophalen

       var datum =  (("" + $F('pat_gebdatum_jjjj')) + $F('pat_gebdatum_mm')) + $F('pat_gebdatum_dd');

       var url = "zoekDubbels.php?rand=" + parseInt(Math.random()*999999) + "&datum=" + datum

                  + "&naam=" + $F('pat_naam') + "&voornaam=" + $F('pat_voornaam')

                  + "&geslacht=" + geslacht;



       var http = createREQ();



       // de call-back functie

       http.onreadystatechange = function() {

         if (http.readyState == 4) {
           var response = http.responseText;
           response = response.replace(/(^\s*)|(\s*$)/gi,"");

           if (response != "") {

              // er zijn dubbels!

              var div = $('kiesPatient');

              div.innerHTML = http.responseText;

              div.style.display='block';

              $('opslaan').style.display='none';
           }

         }

       }



       // en nu nog de request uitsturen

       http.open("GET", url);

       http.send(null);

   }

}

function zoekDubbelePatientenOpRijksregister() {
   if (($F('rijksregister') != "") && !ditIsEenNieuwe) {
       // rijksregister is ingevuld, dus nu alle gelijkenissen ophalen
       var url = "zoekDubbels.php?rand=" + parseInt(Math.random()*999999) + "&rr=" + $F('rijksregister')
                  + "&naam=" + $F('pat_naam') + "&voornaam=" + $F('pat_voornaam')
      var http = createREQ();

       // de call-back functie
       http.onreadystatechange = function() {
         if (http.readyState == 4) {
           var response = http.responseText;
           response = response.replace(/(^\s*)|(\s*$)/gi,"");

           if (response != "") {
              // er zijn dubbels!
              var div = $('kiesPatient');
              div.innerHTML = response;
              div.style.display='block';
              $('opslaan').style.display='none';
           }
         }
       }

       // en nu nog de request uitsturen
       http.open("GET", url);
       http.send(null);
   }
}

function verstop() {

  $('kiesPatient').style.display='none';

  $('opslaan').style.display='inline';

}

</script>


<div id="kiesPatient" style="z-index: 10; display:none; background-color: #ffc; border: 1px black solid; position: absolute; top: 80px; left: 85px; width:420px; height:300px; padding: 8px;"></div>



<form action="patient_nieuw_opslaan.php" method="post" name="zorgplanform" onsubmit="return checkAll();" autocomplete="off">

    <fieldset>

        <div class="legende">Pati&euml;ntgegevens</div>

        <div><p>Voor een nieuwe pati&euml;nt vul je alle velden in. Wanneer je een pati&euml;nt wil overnemen van een andere organisator,
moet je <strong>eerst</strong> het rijksregisternummer invullen.
</p>
</div>

        <div class="inputItem" id="IIRijksregister">

            <div class="label220">Rijksregisternummer<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="6" type="text" size="12" name="rijksregister" id="rijksregister"
                       value="<?= $_GET['rr'] ?>"
                       onkeyup="checkForNumbersOnly(this,11,0,99999999999,'zorgplanform','rijksregister')"
                       onchange="zoekDubbelePatienten()"  /> (11 cijfers zonder leestekens)

            </div>

        </div><!--rijksregister-->

<?php

  if ($_SESSION['profiel']=="menos") {

     print('<input type="hidden" name="pat_type" value="0" />');

  }
  else if ($_SESSION['profiel']=="hoofdproject" || $_SESSION['profiel']=="bijkomend project") {
     //TP
     print('<input type="hidden" name="pat_type" value="4" />');

  }
  else if ($_SESSION['profiel']=="OC" || $_SESSION['profiel']=="rdc" || $_SESSION['profiel']=="hulp" || $_SESSION['profiel']=="listel" ) {

?>

        <div class="inputItem" id="IIType">

            <div class="label220">Type pati&euml;nt<div class="reqfield">*</div>&nbsp;: </div>

                <div class="waardex" style="float: none">

                <table>
                <tr>

                  <td valign="top"><input tabindex="4" type="radio" name="pat_type" value="0" onclick="typePatientGeselecteerd=true;"/></td>
                  <td>'Gewone' pati&euml;nt (geen van onderstaande)</td>
                </tr>


                <tr>
                   <td valign="top"><input tabindex="2" type="radio" name="pat_type" value="1" onclick="typePatientGeselecteerd=true;" /></td>
                   <td>PVS-pati&euml;nt<span style="position:relative;top:-2px">*</span></td>
                </tr>
<!-- De oude, dynamische, maar lichtjes verwarrende versie
                <tr onmouseover="document.getElementById('infoPsy').style.display='block';">
                                <td><input tabindex="5" type="radio" name="pat_type" value="7" onclick="document.getElementById('infoPsy2').style.display='block';"/></td>
                                <td onmouseover="document.getElementById('infoPsy').style.display='block';"
                                    onmouseout="document.getElementById('infoPsy').style.display='none';">
                                Verminderde psychische zelfredzaamheid<br/>
                                <span style="display:none;font-size:9px;" id="infoPsy">
                                  Voor deze pati&euml;nten is er <strong>NOOIT vergoeding voor deelnemers</strong>,
                                  enkel een vergoeding voor de organisator van het overleg indien
                                  het voldoet aan de dezelfde voorwaarden als voor MVO.<br/>
                                </span>
                                <span style="display:none;font-size:9px;" id="infoPsy2">
                                  <input tabindex="3" type="radio" name="pat_type" value="3" /> met een psychiatrische problematiek
                                </span>
                                </td>
                </tr>
-->
                <tr>
                                <td valign="top"><input tabindex="5" type="radio" name="pat_type" value="7"/></td>
                                <td>
                                Verminderde psychische zelfredzaamheid<span style="position:relative;top:-2px">**</span>
                                </td>
                </tr>
                <tr>
                                <td valign="top"><input tabindex="5" type="radio" id="pat_type_psy" name="pat_type" value="18" onclick="typePatientGeselecteerd=true;kiesCircuit(true);"/></td>
                                <td>

                           Verminderde psychische zelfredzaamheid met psychiatrische problematiek   <br/>
                          <span id="pat_type_lang"></span>
                          <div class="reqfield" id="pat_type_req" style="display:none;"></div>
                     <input type="hidden" name="pat_type_hidden" id="pat_type_hidden" value="18" />
                     <input type="hidden" name="pat_type_check" id="pat_type_check" value="0" />
                     <span id="pat_type_keuze" style="display:none;">
                           Circuit
                           <input type="radio" name="pat_type_radio" id="c16" value="16"
                                  onclick="typePatientGeselecteerd=true;$('pat_type_psy').checked = true;" /> jongeren
                           <input type="radio" name="pat_type_radio" id="c18" value="18"
                                  onclick="typePatientGeselecteerd=true;$('pat_type_psy').checked = true;" /> volwassenen
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
                           <input type="radio" name="pat_type_radio" id="c16" value="16" onclick="typePatientGeselecteerd=true;" /> jongeren
                           <input type="radio" name="pat_type_radio" id="c18" value="18" onclick="typePatientGeselecteerd=true;" /> volwassenen
                        <br/>&nbsp;<br/>
                     </span>
                </div>

        </div>
<?php
  }


?>


        <div class="inputItem" id="IIJaar">

            <div class="label220">Opstartjaar<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="1" type="text" size="4" value="<?=date("Y");?>" name="opstartjaar" />

            </div>

        </div>

        <div class="inputItem" id="IINaam">

            <div class="label220">Naam<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="7" type="text" size="35" value="" id="pat_naam" name="pat_naam" onchange="zoekDubbelePatienten()" />

            </div> 

        </div><!--pat_naam-->

        <div class="inputItem" id="IIVoornaam">

            <div class="label220">Voornaam<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="8" type="text" size="35" value="" id="pat_voornaam" name="pat_voornaam" onchange="zoekDubbelePatienten()" />

            </div> 

        </div><!--pat_voornaam-->

        <div class="inputItem" id="IIAdres">

            <div class="label220">Adres<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="9" type="text" size="35" value="" name="pat_adres" />

            </div> 

        </div><!--pat_adres-->

        <div class="inputItem" id="IIPostCode">

            <div class="label220">Postcode<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input size="28"  tabindex="10"

                    onKeyUp="refreshList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20)"

                    onmouseUp="showCombo('IIPostCodeS',100)" onfocus="showCombo('IIPostCodeS',100)" type="text" name="postCodeInput" value="">

                <input type="button" onClick="resetList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20,100)" value="<<">

            </div> 

        </div><!--postCodeInput-->

        <div class="inputItem" id="IIPostCodeS">

            <div class="label220">Kies eventueel&nbsp;:</div>

            <div class="waarde">

                <select   tabindex="11"

                  onClick="handleSelectClick('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS')"

                  onblur="handleSelectClick('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS')"

                  name="pat_gem_id" size="5"></select>

            </div> 

        </div><!--pat_gem_id-->

        <div class="inputItem" id="IISex">

            <div class="label220">Geslacht<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="12" type="radio" name="pat_sex" value="0"  onclick="zoekDubbelePatienten()" />man&nbsp;&nbsp;

                <input tabindex="13" type="radio" name="pat_sex" value="1"  onclick="zoekDubbelePatienten()" />vrouw

            </div> 

        </div><!--pat_sex-->

        <div class="inputItem" id="IIGeboortedatum">

            <div class="label220">Geboortedatum (ddmmjjjj)<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <input tabindex="14" type="text" size="2" value="" id="pat_gebdatum_dd" name="pat_gebdatum_dd"

                onKeyup="checkForNumbersOnly(this,2,0,31,'zorgplanform','pat_gebdatum_mm')"

                 onchange="zoekDubbelePatienten()"

                 onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

                <input tabindex="15" type="text" size="2" value="" id="pat_gebdatum_mm" name="pat_gebdatum_mm"

                onKeyup="checkForNumbersOnly(this,2,0,12,'zorgplanform','pat_gebdatum_jjjj')" 

                 onchange="zoekDubbelePatienten()"

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

                <input type="text" tabindex="16" size="4" value="" id="pat_gebdatum_jjjj" name="pat_gebdatum_jjjj"

                onKeyup="checkForNumbersOnly(this,4,1850,2030,'zorgplanform','pat_geboorteplaats')"

                 onchange="zoekDubbelePatienten()"

                onblur="checkForNumbersLength(this,4)" />

            </div> 

        </div><!--pat_gebdatum_dd,pat_gebdatum_mm,pat_gebdatum_jjjj-->

        <div class="inputItem" id="IIGeboorteplaats">
            <div class="label220">Geboorteplaats&nbsp;: </div>
            <div class="waarde">
                <input tabindex="17" type="text" size="35" value="" name="pat_geboorteplaats" />
            </div>
        </div><!--pat_geboorteplaats-->

        <div class="inputItem" id="IIMutualiteit">

            <div class="label220">Mutualiteit&nbsp;: </div>

            <div class="waarde">

                <input size="28" tabindex="17"

                onKeyUp="refreshList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20)"

                onmouseUp="showCombo('IIMutualiteitS',100)" onfocus="showCombo('IIMutualiteitS',100)" type="text" 

                name="mutualiteitInput" value="" />

                <input type="button" value="<<" 

                onClick="resetList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20,100)" />

            </div> 

        </div><!--mutCodeInput-->

        <div class="inputItem" id="IIMutualiteitS">

            <div class="label220">Kies eventueel&nbsp;:</div>

            <div class="waarde">

                <select tabindex="18"

                onClick="handleSelectClick('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS')"

                onblur="handleSelectClick('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS')"

                name="pat_mut_id" size="5"><option value="1" selected="selected"></option></select>

            </div> 

        </div><!--pat_mut_id-->

        <div class="inputItem" id="IILidmaatschapsnummerMut">

            <div class="label220">Lidmaatschapsnummer Mutualiteit&nbsp;: </div>

            <div class="waarde">

                <input tabindex="19" type="text" size="35" value="" name="pat_mutnr" />

            </div> 

        </div><!--pat_mutnr-->


        <div class="inputItem" id="IIEmail">

            <div class="label220">E-mail&nbsp;: </div>

            <div class="waarde">

                <input tabindex="20" type="text" size="35" value="" name="pat_email" />

            </div> 

        </div><!--pat_email-->

        <div class="inputItem" id="IITelefoon">

            <div class="label220">Tel.&nbsp;: </div>

            <div class="waarde">

                <input tabindex="21" type="text" size="35" value="" name="pat_tel" />

            </div> 

        </div><!--pat_tel-->

        <div class="inputItem" id="IIGsm">

            <div class="label220">GSM&nbsp;: </div>

            <div class="waarde">

                <input tabindex="22" type="text" size="35" value="" name="pat_gsm" />

            </div> 

        </div><!--pat_gsm-->

        <div class="inputItem" id="IIBurgStand">

            <div class="label220">Burgerlijke Staat<div class="reqfield">*</div>&nbsp;: </div>

            <div class="waarde">

                <select tabindex="23" size="1" name="pat_burgstand_id" />

<?php

//----------------------------------------------------------

// Haal records burgelijke stand

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

            $records= mysql_fetch_array($result);

                $selected=($records['id']==$valBurgstaat)?"selected=\"selected\"":"";

            print ("

               <option value=\"".$records['id']."\" ".$selected.">".$records['omschr']."</option>\n");

            }

         }

?>

                </select>

            </div> 

        </div><!--pat_burgstand_id-->

        <div class="inputItem" id="IINaamPartner">

            <div class="label220">Naam Partner&nbsp;: </div>

            <div class="waarde">

                <input tabindex="24" type="text" size="35" value="" name="pat_naam_echtg" />

            </div> 

        </div><!--pat_naam_echtg-->

        <div class="inputItem" id="IIVoornaamPartner">

            <div class="label220">Voornaam Partner&nbsp;: </div>

            <div class="waarde">

                <input tabindex="25" type="text" size="35" value="" name="pat_voornaam_echtg" />

            </div> 

        </div><!--pat_voornaam_echtg-->

        <div class="inputItem" id="IIAlarmsysteem__">

            <div class="label220">Alarmsysteem&nbsp;: </div>

            <div class="waarde">

                <input tabindex="26" type="radio" name="pat_alarm" value="0" />nee&nbsp;&nbsp;

                <input tabindex="27" type="radio" name="pat_alarm" value="1" />ja&nbsp;&nbsp;

                <input tabindex="28" type="radio" name="pat_alarm" value="2" />onbekend

            </div> 

        </div><!--pat_alarm-->


        <div class="inputItem" id="IIZorgtraject">
            <div class="label220">Zorgtraject<div class="reqfield">*</div>: </div>
            <div class="waarde">
                Is de pati&euml;nt in een zorgtraject opgenomen?<br/>
                <input tabindex="29" type="checkbox" name="diabetes" id="diabetes" value="1" onclick="valideerZorgtraject();"/>Diabetes&nbsp;&nbsp;<br/>
                <input tabindex="30" type="checkbox" name="nieren" id="nieren" value="1" onclick="valideerZorgtraject();"/>Chronische nierinsuffici&euml;ntie&nbsp;&nbsp;<br/>
                <input tabindex="31" type="checkbox" name="geen_zorgtraject" id="geen_zorgtraject" value="1" onclick="geenZorgtraject();"/>Geen zorgtraject<br/>&nbsp;<br/>
            </div>
        </div><!--toestemming_zh-->

        <div class="inputItem" id="IIToestemming_zh">
            <div class="label220">Toestemming voor ziekenhuis<span style="position:relative;top:-2px">***</span>: </div>
            <div class="waarde">
                <input tabindex="32" type="radio" name="toestemming_zh" value="-1" />nee&nbsp;&nbsp;
                <input tabindex="33" type="radio" name="toestemming_zh" value="1" />ja&nbsp;&nbsp;
                <input tabindex="34" type="radio" name="toestemming_zh" value="0" checked="checked" />nog geen antwoord
            </div>
        </div><!--toestemming_zh-->
    </fieldset>

    <fieldset>

        <div class="inputItem" id="IIButton">

            <div class="label220">Deze gegevens</div>

            <div class="waarde">

                <input id="opslaan" tabindex="29" type="submit" value="Opslaan" name="action" />

            </div> 

        </div><!--action-->

    </fieldset>

</form>

<script type="text/javascript">

    document.forms['zorgplanform'].elements['rijksregister'].focus();

    hideCombo('IIPostCodeS');

    hideCombo('IIMutualiteitS');

</script>