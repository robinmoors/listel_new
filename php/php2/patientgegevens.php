<script language="javascript">
function checkForm(){
    var message = "";
    if(document.zorgplanform.pat_naam.value.length == 0) message += "- Naam invullen.\n";
    if(document.zorgplanform.pat_voornaam.value.length == 0) message += "- Voornaam invullen.\n";   
    if(document.zorgplanform.pat_adres.value.length == 0) message += "- Adres invullen.\n"; 
    if(document.zorgplanform.postCodeInput.value.length == 0) message += "- Postcode invullen.\n";  
    if(document.zorgplanform.pat_gebdatum_dd.value.length == 0) message += "- Geboortedatum invullen.\n";   
    else if(document.zorgplanform.pat_gebdatum_mm.value.length == 0) message += "- Geboortedatum invullen.\n";  
    else if(document.zorgplanform.pat_gebdatum_jjjj.value.length == 0) message += "- Geboortedatum invullen.\n";    
    if(document.zorgplanform.mutualiteitInput.value.length == 0) message += "- Mutualiteit invullen.\n";    
    if(message.length == 0) return true;
    else {
        message = "Volgende fouten hebben zich voorgedaan : \n" + message;
        alert(message);
        return false;
    }   
}
</script>
<form action="patient_nieuw_opslaan.php" method="post" name="zorgplanform" onSubmit="return checkForm();">
    <fieldset>
        <div class="legende">Pati&euml;ntgegevens</div>
        <div>&nbsp;</div>
        <div class="inputItem" id="IIType">
            <div class="label220">Type pati&euml;nt<div class="reqfield">*</div>&nbsp;: </div>
                <div class="waardex">
                <table><tr>
                <td><input type="radio" name="pat_type" value="1" /></td>
                <td>PVS-pati&euml;nt(*)</td></tr><tr>
                <td><input type="radio" name="pat_type" value="2" /></td>
                <td>MRS-pati&euml;nt</td></tr><tr>
                <td><input type="radio" name="pat_type" value="3" /></td>
                <td>pati&euml;nt met een psychiatrische problematiek</td></tr><tr>
                <td><input type="radio" name="pat_type" value="4" /></td>
                <td>pati&euml;nt met een psychiatrische problematiek, opgenomen in een therapeutisch project</td></tr><tr>
                <td><input type="radio" name="pat_type" value="0" checked="checked" /></td>
                <td>andere</td></tr></table>
            </div>  
        </div><!--pat_type-->
        <div class="inputItem" id="IINaam">
            <div class="label220">Naam<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_naam" />
            </div> 
        </div><!--pat_naam-->
        <div class="inputItem" id="IIVoornaam">
            <div class="label220">Voornaam<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_voornaam" />
            </div> 
        </div><!--pat_voornaam-->
        <div class="inputItem" id="IIAdres">
            <div class="label220">Adres<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_adres" />
            </div> 
        </div><!--pat_adres-->
        <div class="inputItem" id="IIPostCode">
            <div class="label220">Postcode<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input onKeyUp="refreshList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20)"  onmouseUp="showCombo('IIPostCodeS',100)" onfocus="showCombo('IIPostCodeS',100)" type="text" name="postCodeInput" value="">
                <input type="button" onClick="resetList('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS',gemeenteList,20,100)" value="<<">
            </div> 
        </div><!--postCodeInput-->
        <div class="inputItem" id="IIPostCodeS">
            <div class="label220">Kies eventueel&nbsp;:</div>
            <div class="waarde">
                <select onClick="handleSelectClick('zorgplanform','postCodeInput','pat_gem_id',1,'IIPostCodeS')" name="pat_gem_id" size="5"></select>
            </div> 
        </div><!--pat_gem_id-->
        <div class="inputItem" id="IISex">
            <div class="label220">Geslacht<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input type="radio" name="pat_sex" value="0" checked="checked"/>man&nbsp;&nbsp;
                <input type="radio" name="pat_sex" value="1" />vrouw
            </div> 
        </div><!--pat_sex-->
        <div class="inputItem" id="IIGeboortedatum">
            <div class="label220">Geboortedatum (ddmmjjjj)<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="2" value="" name="pat_gebdatum_dd" 
                onKeyup="checkForNumbersOnly(this,2,0,31,'zorgplanform','pat_gebdatum_mm')"
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
                <input type="text" size="2" value="" name="pat_gebdatum_mm" 
                onKeyup="checkForNumbersOnly(this,2,0,12,'zorgplanform','pat_gebdatum_jjjj')" 
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
                <input type="text" size="4" value="" name="pat_gebdatum_jjjj" 
                onKeyup="checkForNumbersOnly(this,4,1850,2030,'zorgplanform','mutualiteitInput')" 
                onblur="checkForNumbersLength(this,4)" />
            </div> 
        </div><!--pat_gebdatum_dd,pat_gebdatum_mm,pat_gebdatum_jjjj-->
        <div class="inputItem" id="IIMutualiteit">
            <div class="label220">Mutualiteit<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input onKeyUp="refreshList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20)"
                onmouseUp="showCombo('IIMutualiteitS',100)" onfocus="showCombo('IIMutualiteitS',100)" type="text" 
                name="mutualiteitInput" value="" />
                <input type="button" value="<<" 
                onClick="resetList('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS',mutList,20,100)" />
            </div> 
        </div><!--mutCodeInput-->
        <div class="inputItem" id="IIMutualiteitS">
            <div class="label220">Kies eventueel<div class="reqfield">*</div>&nbsp;:</div>
            <div class="waarde">
                <select onClick="handleSelectClick('zorgplanform','mutualiteitInput','pat_mut_id',1,'IIMutualiteitS')" 
                name="pat_mut_id" size="5"><option value="1" selected="selected"></option></select>
            </div> 
        </div><!--pat_mut_id-->
        <div class="inputItem" id="IILidmaatschapsnummerMut">
            <div class="label220">Lidmaatschapsnummer Mutualiteit&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_mutnr" />
            </div> 
        </div><!--pat_mutnr-->
        <div class="inputItem" id="IIEmail">
            <div class="label220">E-mail&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_email" />
            </div> 
        </div><!--pat_email-->
        <div class="inputItem" id="IITelefoon">
            <div class="label220">Tel.&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_tel" />
            </div> 
        </div><!--pat_tel-->
        <div class="inputItem" id="IIGsm">
            <div class="label220">GSM&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_gsm" />
            </div> 
        </div><!--pat_gsm-->
        <div class="inputItem" id="IIBurgStand">
            <div class="label220">Burgerlijke Staat<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <select size="1" name="pat_burgstand_id" />
<?php
//----------------------------------------------------------
// Haal records burgelijke stand
//----------------------------------------------------------

      $query = "
         SELECT
            burgstaat_id,
                burgstaat_omschr
         FROM
            burgstaat
         ORDER BY
            burgstaat_omschr";
      if ($result=mysql_query($query))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
                $selected=($records['burgstaat_id']==$valBurgstaat)?"selected=\"selected\"":"";
            print ("
               <option value=\"".$records['burgstaat_id']."\" ".$selected.">".$records['burgstaat_omschr']."</option>\n");
            }
         }
?>
                </select>
            </div> 
        </div><!--pat_burgstand_id-->
        <div class="inputItem" id="IINaamPartner">
            <div class="label220">Naam Partner&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_naam_echtg" />
            </div> 
        </div><!--pat_naam_echtg-->
        <div class="inputItem" id="IIVoornaamPartner">
            <div class="label220">Voornaam Partner&nbsp;: </div>
            <div class="waarde">
                <input type="text" size="35" value="" name="pat_voornaam_echtg" />
            </div> 
        </div><!--pat_voornaam_echtg-->
        <div class="inputItem" id="IIAlarmsysteem">
            <div class="label220">Alarmsysteem<div class="reqfield">*</div>&nbsp;: </div>
            <div class="waarde">
                <input type="radio" name="pat_alarm" value="0" checked="checked" />nee&nbsp;&nbsp;
                <input type="radio" name="pat_alarm" value="1" />ja&nbsp;&nbsp;
                <input type="radio" name="pat_alarm" value="2" />onbekend
            </div> 
        </div><!--pat_alarm-->
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
<script type="text/javascript">
    document.forms['zorgplanform'].elements['pat_naam'].focus();
    hideCombo('IIPostCodeS');
    hideCombo('IIMutualiteitS');
</script>