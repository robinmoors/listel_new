<?php

session_start();

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Interventie ingeven";

$opgeslagen = false;

function eindePagina() {
      print("</div>");
      print("</div>");
      print("</div>");
      require("../includes/footer.inc");
      print("</div>");
      print("</div>");
      print("</body>");
      print("</html>");
}


unset($_SESSION['overleg_id']);



if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {



    if (isset($_POST['pat_code'])) $_SESSION['pat_code'] = $_POST['pat_code'];



    $records=mysql_fetch_array(mysql_query("SELECT * FROM patient WHERE code='{$_SESSION['pat_code']}'"));
    $patient = $records;

    $_SESSION['pat_voornaam'] = $records['voornaam'];

    $_SESSION['pat_naam'] = $records['naam'];



    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");



    //-----------------------------------------------------------------------------

    /* Controle numerieke velden */ require("../includes/checkForNumbersOnly.inc");

    //-----------------------------------------------------------------------------



    print("</head>");

    print("<body>");

    print("<div align=\"center\">");

    print("<div class=\"pagina\">");

    require("../includes/header.inc");

    require("../includes/pat_id.inc");

    print("<div class=\"contents\">");

    require("../includes/menu.inc");

    print("<div class=\"main\">");

    print("<div class=\"mainblock\">");

//require("../includes/toonSessie.inc");

// standaard moet je sebiet gegevens toevoegen
$action = "insert";
?>

<script language="javascript">
var vormJS = -1;
var subvormJS = -1;

function setVorm(nieuweVorm) {
  vormJS = nieuweVorm;
  if (vormJS != "overleg") {
    document.getElementById('subvorm1').checked = false;
    document.getElementById('subvorm2').checked = false;
    document.getElementById('subvorm3').checked = false;
    document.getElementById('subvorm4').checked = false;
  }
}
function setSubVorm(nieuweSubVorm) {
  subvormJS = nieuweSubVorm;
  vormJS = "overleg";
  document.getElementById("vormOverleg").checked = true;
}
</script>


<?php

if (isset($_GET['id'])) {
       // gegevens van deze interventie ophalen
       $evalID = $_GET['id'];
       $evalQry = "select * from menos_interventie where id = {$_GET['id']}";
/*
                        datum,
                        vorm,
                        subvorm,
                        vooruitgang,
                        uitvoerder_id,
                        genre,
                        patient,
                        uren,
                        creatiedatum)
*/
       $eval = mysql_fetch_array(mysql_query($evalQry)) or die(mysql_error());
       $datum = $eval['datum'];
       $dd = substr($datum, 6, 2);
       $mm = substr($datum, 4, 2);
       $jj = substr($datum, 0, 4);
       $persoonID = $eval['uitvoerder_id'];
       $vooruitgang = $eval['vooruitgang'];
       $uren = $eval['uren'];
       $vorm = $eval['vorm'];
       if ($vorm =="vorming") $vorming = $eval['subvorm'];
       $subvorm = $eval['subvorm'];
       $genre = $eval['genre'];
       $_SESSION['pat_code'] = $eval['patient'];
       $action = "update";
?>

<script language="javascript">
vormJS = "<?= $vorm ?>";
subvormJS = "<?php if($subvorm=="") print(-1); else print($subvorm); ?>";
</script>

<?php
}
else if (isset($_POST['actie'])) {
?>

<script language="javascript">
vormJS = "<?= $vorm ?>";
subvormJS = "<?php if($subvorm=="") print(-1); else print($subvorm); ?>";
</script>

<?php
       $action = "update";
       $evalID = $_POST['id'];

       $dd = $_POST['dd'];
       $mm = $_POST['mm'];
       $jj = $_POST['jj'];

       $datum = "$jj$mm$dd";

       $stuk = explode("|",$_POST['contact_hvl']);
       $persoonID = $stuk[0];
       $genre = $stuk[1];

       $vooruitgang = $_POST['vooruitgang'];
       $uren = $_POST['uren'];
       $vorm = $_POST['vorm'];

       if ($vorm =="vorming") {$vorming = $subvorm = $_POST['vorming'];}
       else if ($vorm =="overleg") $subvorm = $_POST['subvorm'];

       if ($_POST['actie']=="insert") {
          $qry="
                INSERT INTO
                    menos_interventie
                        (
                        datum,
                        vorm,
                        subvorm,
                        vooruitgang,
                        uitvoerder_id,
                        genre,
                        patient,
                        uren,
                        creatiedatum)
                VALUES
                    ($datum,
                     '$vorm',
                     '$subvorm',
                     '$vooruitgang',
                     $persoonID,
                     '$genre',
                     '{$_SESSION['pat_code']}',
                     $uren,
                     " . time() .  ")";

           $result=mysql_query($qry) or die($qry . "<br/>" . mysql_error());
           if ($result) {
               print("<div style=\"background-color: #8f8\">De interventie is succesvol opgeslagen!</div>");
               $evalID = mysql_insert_id();
               //print("<p>Je kan hiernaast in het menu een nieuwe actie selecteren.</p>");
               //eindePagina();
               //die();
           }
       }

            /************************************
             rechten voor een interventie moeten we niet opslaan.
             Indien dit toch moet, kan je bij fill_evaluatie_01.php inspiratie opdoen
            ************************************/
       else {
            // het is een update
            // nieuwe gegevens opslaan
/*
                        datum,
                        vorm,
                        subvorm,
                        vooruitgang,
                        uitvoerder_id,
                        genre,
                        patient,
                        uren,
                        creatiedatum)
*/
          $qry="
                update menos_interventie
                SET datum = $datum,
                    vorm = '$vorm',
                    subvorm = '$subvorm',
                    vooruitgang = '$vooruitgang',
                    uitvoerder_id = $persoonID,
                    uren = $uren,
                    genre = '$genre'
                WHERE id = $evalID";
           $result=mysql_query($qry) or die(mysql_error() . $qry);
           $opgeslagen = true;
           print("<div style=\"background-color: #8f8\">De interventie is succesvol aangepast!</div>");
       }

}

?>

<!-- FORMULIER -->




<script language="javascript">
function checkForm(){
    var message = "";
    if(document.zorgplanform.dd.value.length == 0) message += "- De datum van de interventie is niet ingevuld.\n";
    else if(document.zorgplanform.mm.value.length == 0) message += "- De datum van de interventie is niet ingevuld.\n";
    else if(document.zorgplanform.jj.value.length == 0) message += "- De datum van de interventie is niet ingevuld.\n";
    else {
      var datumForm = document.zorgplanform.jj.value + document.zorgplanform.mm.value + document.zorgplanform.dd.value;
    }

    if (vormJS == -1) message += "- Er is geen vorm geselecteerd.\n";
    if (vormJS == "overleg") {
      if (subvormJS == -1) message += "- Het juiste type overleg is nog niet geselecteerd.\n";
    }
    if (vormJS == "vorming") {
       if (document.zorgplanform.vorming.value.length == 0) message += "- U hebt de juiste vorming niet ingevuld.\n";
    }

    if (document.zorgplanform.vooruitgang.value.length == 0) message += "- U hebt de voortgang niet ingevuld.\n";
    if (document.zorgplanform.contact_hvl.value == "---") message += "- U hebt geen uitvoerder geselecteerd.\n";
    if (document.zorgplanform.uren.value.indexOf(",") >=0 ) message += "- U hebt een komma gebruikt in het aantal uren, maar dat moet een punt zijn (bv. 4.5).\n";
    if (isNaN(parseFloat(document.zorgplanform.uren.value))) message += "- U hebt geen correct aantal uren ingevuld.\n";

    if(message.length == 0) return true;
    else {
        message = "Deze interventie kan niet opgeslagen worden, want : \n" + message;
        alert(message);
        return false;
    }
}

</script>

<form action="menos_interventie.php" method="post" name="zorgplanform" onsubmit="return checkForm();">
    <fieldset>
        <div class="legende" style="text-align: left;">Registratie van een interventie voor <?= strtoupper($_SESSION['pat_naam']) ?> <?= $_SESSION['pat_voornaam'] ?></div>
        <div>&nbsp;</div>

        <div class="inputItem" id="IIStartdatum">
         <div class="label160">Datum (dd/mm/jjjj)<div class="reqfield">*</div>&nbsp;: </div>
         <div class="waarde">
            <input type="text" size="2" value="<?php print($dd);?>" name="dd"
                onKeyup="checkForNumbersOnly(this,2,0,31,'zorgplanform','mm')"
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="2" value="<?php print($mm);?>" name="mm"
                onKeyup="checkForNumbersOnly(this,2,0,12,'zorgplanform','jj')"
                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;
            <input type="text" size="4" value="<?php print($jj);?>" name="jj"
                onKeyup="checkForNumbersOnly(this,4,1970,2069,'zorgplanform','jj')"
                onblur="checkForNumbersLength(this,4)" />
         </div>
      </div><!--overleg_dd,overleg_mm,overleg_jj-->

        <div class="inputItem" id="IIvorm">
         <div class="label160">Vorm<div class="reqfield">*</div>&nbsp;: </div>
         <div class="waardex">
            <table style="width:360px;">
              <tr>
                 <td><input type="radio" name="vorm" onclick="setVorm('intake');"
                            value="intake" <?php $checked=($vorm=='intake')?"checked=\"checked\"":"";print($checked);?> />
                 </td>
                 <td>Intake</td>
              </tr>
              <tr>
                 <td><input type="radio" name="vorm" onclick="setVorm('schalen afnemen');"
                            value="schalen afnemen" <?php $checked=($vorm=='schalen afnemen')?"checked=\"checked\"":"";print($checked);?> />
                 </td>
                 <td>Schalen afnemen</td>
              </tr>
              <tr>
                 <td valign="top"><input type="radio" name="vorm" onclick="setVorm('overleg');" id="vormOverleg"
                            value="overleg" <?php $checked=($vorm=='overleg')?"checked=\"checked\"":"";print($checked);?> />
                 </td>
                 <td>Overleg: maak een keuze uit
                     <div style="margin-left:22px;">
                       <table style="width:300px;">
                         <tr>
                           <td><input type="radio" name="subvorm" onclick="setSubVorm('gerontopsychiatrisch overleg');" id="subvorm1"
                                      value="gerontopsychiatrisch overleg" <?php $checked=($subvorm=='gerontopsychiatrisch overleg')?"checked=\"checked\"":"";print($checked);?> />
                           </td>
                           <td>gerontopsychiatrisch overleg</td>
                         </tr>
                         <tr>
                           <td><input type="radio" name="subvorm" onclick="setSubVorm('telefonisch overleg');" id="subvorm2"
                                      value="telefonisch overleg" <?php $checked=($subvorm=='telefonisch overleg')?"checked=\"checked\"":"";print($checked);?> />
                           </td>
                           <td>telefonisch overleg</td>
                         </tr>
                         <tr>
                           <td><input type="radio" name="subvorm" onclick="setSubVorm('11/12 overleg');"  id="subvorm3"
                                      value="11/12 overleg" <?php $checked=($subvorm=='11/12 overleg')?"checked=\"checked\"":"";print($checked);?> />
                           </td>
                           <td>11/12 overleg</td>
                         </tr>
                         <tr>
                           <td><input type="radio" name="subvorm" onclick="setSubVorm('nabespreking groep');" id="subvorm4"
                                      value="nabespreking groep" <?php $checked=($subvorm=='nabespreking groep')?"checked=\"checked\"":"";print($checked);?> />
                           </td>
                           <td>nabespreking groep</td>
                         </tr>
                       </table>
                     </div>

                 </td>
              </tr>
              <tr>
                 <td><input type="radio" name="vorm" onclick="setVorm('groep');"
                            value="groep" <?php $checked=($vorm=='groep')?"checked=\"checked\"":"";print($checked);?> />
                 </td>
                 <td>Groep: Dementie! Wat nu?</td>
              </tr>
              <tr>
                 <td><input type="radio" name="vorm" onclick="setVorm('individueel');"
                            value="individueel" <?php $checked=($vorm=='individueel')?"checked=\"checked\"":"";print($checked);?> />
                 </td>
                 <td>Individuele counseling: individueel gesprek HV-oudere/mantelzorger</td>
              </tr>
<!--
              <tr>
                 <td><input type="radio" name="vorm" onclick="setVorm('vorming');"
                            value="vorming" <?php $checked=($vorm=='vorming')?"checked=\"checked\"":"";print($checked);?> />
                 </td>
                 <td>Vorming:  <input type="text" name="vorming" value="<?= $vorming ?>"/>
                 </td>
              </tr>
-->
            </table>
         </div>
      </div><!--overleg_vorm-->

<?php
  if ($_SESSION['profiel']=="menos") {
?>
        <div class="inputItem" id="IIContactpersoon">
         <div class="label160">Uitvoerder<div class="reqfield">*</div>&nbsp;: </div>
    <div class="waarde">
        <select size="1" name="contact_hvl" />
<?php
//----------------------------------------------------------
// Vul Input-select-element vanuit dbase met lijst
// betrokken hulpverleners voor deze patient (HVL's)
    $switch=false;
    if ($genre == "menos") {
      $selectedMenos = " selected=\"selected\" ";
      $switch = true;
    }
    print ("
          <option value=\"0|menos\" $selectedMenos>Menos-coordinator</option>\n");

    $queryHVL = "
        SELECT
            hb.persoon_id,
            h.naam,
            hb.genre,
            h.voornaam,
            f.naam  as functienaam
        FROM
            hulpverleners h,
            huidige_betrokkenen hb,
            functies f
        WHERE
            hb.overleggenre = 'menos' AND
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            hb.genre = 'hulp' AND
            h.fnct_id=f.id
            $extraVW
        ORDER BY
            f.rangorde, hb.id, h.naam";

    if ($result=mysql_query($queryHVL))
        {
        $aantalxvl=mysql_num_rows ($result);
        for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['persoon_id'] && ($genre == "hulp" || $genre == "orgpersoon"))
                 {$selected=" selected=\"selected\"";$switch=true;}else{$selected="";};
            if ($records['persoon_id'] == $vorigOverleg['contact_hvl'])
              $stijl = " style=\"font-weight: bold\" ";
            else
              $stijl = "";
            print ("
               <option value=\"{$records['persoon_id']}|{$records['genre']}\" ".$selected." $stijl>".$records['naam']." ".$records['voornaam']." ({$records['functienaam']})</option>\n");
            }
        }

// betrokken mantelzorgers voor deze patient
    $queryMZ = "
        SELECT
            hb.persoon_id,
            h.naam,
            h.voornaam,
            f.naam  as functienaam
        FROM
            mantelzorgers h,
            huidige_betrokkenen hb,
            verwantschap f
        WHERE
            hb.overleggenre = 'menos'
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            hb.genre = 'mantel' AND
            h.verwsch_id=f.id
        ORDER BY

            f.rangorde, hb.id, h.naam";

    if ($result=mysql_query($queryMZ))
        {
        $aantalxvl=mysql_num_rows ($result);
        for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['persoon_id'] && $genre == "mantel")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"{$records['persoon_id']}|mantel\" ".$selected.">".$records['naam']." ".$records['voornaam']." ({$records['functienaam']})</option>\n");
            }
        }








        if($persoonID==-1 && $genre == "patient")

                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};

        print ("
               <option value=\"-1|patient\" ".$selected.">".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (patient)</option>\n");

        $selected=($switch)?"":"selected=\"selected\"";
        print("<option value=\"---\"".$selected.">Onbenoemd</option>");

//----------------------------------------------------------

?>

        </select>
        <div>Pas eventueel eerst de <a href="zorgteam_bewerken.php">teamsamenstelling</a> aan.<br/>
             (Pas op. Je verliest dan de ingevulde gegevens.)</div>
    </div><!--Contact HVL -->
<?php
}
else {
   print("<input type=\"hidden\" name=\"contact_hvl\" value=\"{$_SESSION['usersid']}|hulp\" />\n");
}
?>

    <div class="inputItem" id="IIVoortgang">
        <div class="label160">Voortgang<div class="reqfield">*</div>&nbsp;:&nbsp;</div>
        <div class="waardex">
            <textarea style="font-family: Arial, Helvetica, sans-serif; font-size:11px;"
                      rows="4" wrap="soft" cols="60" name="vooruitgang"><?php print($vooruitgang);?></textarea>
        </div>
    </div><!--voortgang-->

    <div class="inputItem" id="IIUren">
        <div class="label160">Aantal uren<div class="reqfield">*</div>&nbsp;:&nbsp;</div>
        <div class="waarde">
             <input type="text" name="uren" value="<?= $uren ?>" onchange="this.value = this.value.replace(',','.');"/> (in decimalen)    <br/>
             Om het aantal uren in decimalen in te kunnen geven,<br/> kan je onderstaande tabel gebruiken.<br/>

             <table style="width:300px;">
               <tr>
                 <th>Minuten</th><th>Decimaal</th>
               </tr>
               <tr>
                 <td>0:10</td><td>0.17</td>
               </tr>
               <tr>
                 <td>0:15</td><td>0.25</td>
               </tr>
               <tr>
                 <td>0:20</td><td>0.33</td>
               </tr>
               <tr>
                 <td>0:25</td><td>0.42</td>
               </tr>
               <tr>
                 <td>0:30</td><td>0.50</td>
               </tr>
               <tr>
                 <td>0:35</td><td>0.58</td>
               </tr>
               <tr>
                 <td>0:40</td><td>0.67</td>
               </tr>
               <tr>
                 <td>0:45</td><td>0.75</td>
               </tr>
               <tr>
                 <td>0:50</td><td>0.83</td>
               </tr>
               <tr>
                 <td>0:55</td><td>0.92</td>
               </tr>
               <tr>
                 <td>1:00</td><td>1.00</td>
               </tr>
             </table>
        </div>
    </div><!--uren-->

    </fieldset>

    <fieldset>

        <div class="inputItem" id="IIButton">

         <div class="label160">Deze gegevens</div>

         <div class="waarde">

            <input type="hidden" name="actie" value="<?php print($action);?>" />
            <input type="hidden" name="id" value="<?php print($evalID);?>" />

         <input type="submit" value="Opslaan " name="submit" />

         </div>

      </div><!--action-->


    </fieldset>

</form>







<!-- EINDE FORMULIER -->

<?php


      eindePagina();
      }




//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>