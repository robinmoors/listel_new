<?php

session_start();

//----------------------------------------------------------

/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

//----------------------------------------------------------



$paginanaam="Evaluatie ingeven";

$opgeslagen = false;



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



 $eersteOverlegResult = mysql_query("SELECT * FROM overleg WHERE patient_code='{$_SESSION['pat_code']}' order by datum limit 0,1");





 if (mysql_num_rows($eersteOverlegResult) == 0) {

    $tpCode = tpVisueel($_SESSION['pat_code']);

    print("<h3>Evaluatie invullen : </h3><p>Er is nog geen overleg geweest voor {$records['naam']} {$records['voornaam']} ({$_SESSION['pat_code']} $tpCode)");

    print("<br />En dus kan er ook geen evaluatie plaatsvinden.</p>");

 }

 else {

  $eersteOverleg = mysql_fetch_array($eersteOverlegResult);



  $tpRecord = project_van_patient($_SESSION['pat_code']);

  $isProject = ($tpRecord != 0);



     // effe meest recente overleg opzoeken ivm om bv. vorige Katz-score te kunnen tonen en zo

     $zoekQryMeestRecent = "select contact_hvl from overleg

                 where patient_code = '{$_SESSION['pat_code']}'

                 order by datum desc

                 limit 0,1";



     $vorigOverlegResult = mysql_query($zoekQryMeestRecent);

     if (mysql_num_rows($vorigOverlegResult) == 1) {

       $vorigOverleg = mysql_fetch_array($vorigOverlegResult);

     }



  if ((!isset($_POST['actie'])) && (!isset($_GET['id']))) {

     $alleenBasisGegevens = true;


     if ($patient['type']==16 || $patient['type']==18) {
        $extraTekst = "";
     }
     else if (!$isProject) {
       $extraTekst = " (en eventueel taakfiches invullen en/of katz aanpassen) ";
     }
     else {
       $extraTekst = " (en eventueel katz invullen) ";
     }

     $action = "insert";

   }

   else {

     $action = "update";

     if (isset($_GET['id'])) {

       $evalID = $_GET['id'];

       // gegevens van deze evaluatie ophalen

       $evalQry = "select * from evaluatie where id = $evalID";

       $eval = mysql_fetch_array(mysql_query($evalQry));

       $datum = $eval['datum'];

       $dd = substr($datum, 6, 2);

       $mm = substr($datum, 4, 2);

       $jj = substr($datum, 0, 4);

       $persoonID = $eval['uitvoerder_id'];

       $genre = $eval['genre'];

       $vooruitgang = $eval['vooruitgang'];

       $locatie = $eval['locatie'];

       if (isset($_GET['neemKatzIDover'])) {

          $neemKatzOverQry = "update evaluatie

                              set katz_id = {$_GET['neemKatzIDover']}

                              where id = {$_GET['id']};";

          mysql_query($neemKatzOverQry);

          $katzID = $_GET['neemKatzIDover'];

       }

       else

         $katzID = $eval['katz_id'];

       $vorm = $eval['locatie'];

     }

     else {

       $evalID = $_POST['id'];

       $katzID = $_POST['katzID'];

       $dd = $_POST['dd'];

       $mm = $_POST['mm'];

       $jj = $_POST['jj'];

       $datum = "$jj$mm$dd";



       $stuk = explode("|",$_POST['contact_hvl']);

       $persoonID = $stuk[0];

       $genre = $stuk[1];



       $vooruitgang = $_POST['vooruitgang'];

       $locatie = $_POST['locatie'];

       $vorm=(!isset($_POST['vorm']))?'ongekend':$_POST['vorm'];



       if ($_POST['actie']=="insert") {

          if (is_tp_patient()) {

            $vandaag = date("Ymd");

            $qryRechtenOC = "select * from patient_tp

                    where patient = \"{$_SESSION['pat_code']}\"   and actief = 1

                      and rechtenOC > 0 and rechtenOC <= $vandaag";

            // tp_rechtenOC nog zetten

            if (mysql_num_rows(mysql_query($qryRechtenOC)) == 1) {

              $tp_rechtenOC = 1;

            }

            else {

              $tp_rechtenOC = 0;

            }

          }

          else {

            $tp_rechtenOC = 1;

          }



          $qry="

                INSERT INTO

                    evaluatie

                        (

                        datum,

                        locatie,

                        vooruitgang,

                        uitvoerder_id,

                        genre,

                        tp_rechtenOC,

                        patient,

                        creatiedatum)

                VALUES

                    ($datum,

                     '$vorm',

                     '$vooruitgang',

                     $persoonID,

                     '$genre',

                     $tp_rechtenOC,

                     '{$_SESSION['pat_code']}',

                     " . time() .  ")";

           $result=mysql_query($qry) or die($_POST['contact_hvl'] . $qry . "<br/>" . mysql_error());

           $evalID = mysql_insert_id();

           /************************************/
           // en nu de rechten voor deze evaluatie opslaan
           $qryRechtenOpvragen="
               SELECT *
               FROM huidige_betrokkenen
               WHERE patient_code='".$_SESSION['pat_code']."'
                 and (overleggenre = 'gewoon')
                 and not (genre = 'org') order by id";
          if ($result1=mysql_query($qryRechtenOpvragen))
          {
              for ($i=0; $i < mysql_num_rows ($result1); $i++)
              {
                $records1= mysql_fetch_array($result1);
                $qryRechtenKopieren="
                     INSERT INTO
                       evaluatie_rechten (evaluatie, genre, id, rechten)
                     VALUES ($evalID, \"{$records1['genre']}\",{$records1['persoon_id']},{$records1['rechten']})";
                if (!mysql_query($qryRechtenKopieren)) {
                  print("<h1>begot: $qryRechtenKopieren lukt niet <br>" . mysql_error() . "</h1>");
                }
              }
          }
          else {
            print("<h1>begot: $qryRechtenOpvragen lukt niet <br>" . mysql_error() . "</h1>");
          }
           /************************************/
           // evaluatierechten zijn opgeslagen!
           if (isPatientPsy($patient['type'])) {
             $opgeslagen = true;
           }
        }

        else {

            // het is een update

            

            // nieuwe gegevens opslaan

          $qry="

                update evaluatie

                SET datum = $datum,

                    locatie = '$vorm',

                    vooruitgang = '$vooruitgang',

                    uitvoerder_id = $persoonID,

                    genre = '$genre'

                WHERE id = $evalID";

           $result=mysql_query($qry) or die(mysql_error());

           $opgeslagen = true;

             }

     }



     // effe vorig overleg opzoeken om bv. vorige Katz-score te kunnen tonen en zo

     $zoekQry = "select * from overleg

                 where datum < $datum

                 and patient_code = '{$_SESSION['pat_code']}'

                 order by datum desc

                 limit 0,1";



     $vorigOverlegResult = mysql_query($zoekQry);

     if (mysql_num_rows($vorigOverlegResult) == 1) {

       $vorigOverleg = mysql_fetch_array($vorigOverlegResult);

       $vorigeKatzID = $vorigOverleg['katz_id'];

       $datum2 = $vorigOverleg['datum'];

       $dd2 = substr($datum2, 6, 2);

       $mm2 = substr($datum2, 4, 2);

       $jj2 = substr($datum2, 0, 4);

       $vorigeKatzTekst = "het vorige overleg ($dd2/$mm2/$jj2)";



       // ook even kijken of er een evaluatie is met recentere katz

         $qryEvaluatieMetKatz="

        SELECT

            *

        FROM

            evaluatie

        WHERE

            patient='".$_SESSION['pat_code']."'

            and katz_id > 0

            and datum >  $datum2

            and datum <= $datum

        ORDER BY

            datum desc";

        $zoekEvalutieMetKatz = mysql_query($qryEvaluatieMetKatz);

        if (mysql_num_rows($zoekEvalutieMetKatz) >= 1) {

          $evalutieMetKatz = mysql_fetch_array($zoekEvalutieMetKatz);

          $vorigeKatzID = $evalutieMetKatz['katz_id'];

          $datum2 = $evalutieMetKatz['datum'];

          $dd2 = substr($datum2, 6, 2);

          $mm2 = substr($datum2, 4, 2);

          $jj2 = substr($datum2, 0, 4);

          $vorigeKatzTekst = "de evaluatie van $dd2/$mm2/$jj2";

        }



       if (isset($vorigeKatzID)) {

         $vorigeKatz = mysql_fetch_array(mysql_query(

                         "select * from katz where id = $vorigeKatzID or - id = $vorigeKatzID "));

         }

     }



   } // einde ofwel actie ofwel ophalen van huidige evaluatie









?>

<!-- FORMULIER -->



<script language="javascript">



<?php

if (isset($vorm))

  print("overlegVorm = '$vorm';\n");

else

  print("overlegVorm = -1;\n");

?>





function checkForm(){

    var message = "";

    if(document.zorgplanform.dd.value.length == 0) message += "- De datum van het overleg is niet ingevuld.\n";

    else if(document.zorgplanform.mm.value.length == 0) message += "- De datum van het overleg is niet ingevuld.\n";

    else if(document.zorgplanform.jj.value.length == 0) message += "- De datum van het overleg is niet ingevuld.\n";

    //if(document.zorgplanform.overleg_katzscore.value.length == 0) message += "- Verkeerde Katz-score.\n";

    else {

      var datumForm = document.zorgplanform.jj.value + document.zorgplanform.mm.value + document.zorgplanform.dd.value;

      var datumEersteOverleg = <?= $eersteOverleg['datum'] ?>;

      if (datumForm < datumEersteOverleg) {

        datum2 = ("" + datumEersteOverleg).substr(6,2) + "/" +

                 ("" + datumEersteOverleg).substr(4,2) + "/" +

                 ("" + datumEersteOverleg).substr(0,4);

        message += "- Een evaluatie kan pas n&agrave; een overleg, maar het eerste overleg " +

                   "vond pas plaats op " + datum2 + ".\n    Pas dus de datum van de evaluatie aan.\n";

      }

    }

    if (overlegVorm == -1) message += "- Er is geen locatie geselecteerd.\n";

    if (document.zorgplanform.vooruitgang.value.length == 0) message += "- U hebt de voortgang niet ingevuld.\n";

    if (document.zorgplanform.contact_hvl.value == 10431) message += "- U hebt geen uitvoerder geselecteerd.\n";

    if(message.length == 0) return true;

    else {

        message = "Deze evaluatie kan niet opgeslagen worden, want : \n" + message;

        alert(message);

        return false;

    }   

}

<?php

$tpCode = tpVisueel($_SESSION['pat_code']);

?>

</script>

<form action="fill_evaluatie_01.php" method="post" name="zorgplanform" onSubmit="alert checkForm();return false;"  />

    <fieldset>

        <div class="legende" style="text-align: left;">Registratie van een evaluatie voor <?= strtoupper($_SESSION['pat_naam']) ?> <?= $_SESSION['pat_voornaam'] ?> (<?= "{$_SESSION['pat_code']}$tpCode" ?>)</div>

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

         <div class="waardex"><table><tr>

<td><input type="radio" name="vorm" onClick="overlegVorm='huisbezoek';" value="huisbezoek" <?php $checked=($vorm=='huisbezoek')?"checked=\"checked\"":"";print($checked);?> /></td>

<td>Huisbezoek</td></tr><tr>

<td><input type="radio" name="vorm" onClick="overlegVorm='bureelbezoek';" value="bureelbezoek" <?php $checked=($vorm=='bureelbezoek')?"checked=\"checked\"":"";print($checked);?> /></td>

<td>Bureelbezoek</td></tr>

<tr>

  <td><input type="radio" name="vorm" onClick="overlegVorm='telefonisch';" value="telefonisch" <?php $checked=($vorm=='telefonisch')?"checked=\"checked\"":"";print($checked);?> /></td>

  <td>Telefonisch onderhoud</td></tr>

<tr>

  <td><input type="radio" name="vorm" onClick="overlegVorm='email';" value="email" <?php $checked=($vorm=='email')?"checked=\"checked\"":"";print($checked);?> /></td>

  <td>Email</td></tr>

</table>

         </div>  

      </div><!--overleg_vorm-->

        <div class="inputItem" id="IIContactpersoon">

         <div class="label160">Uitvoerder<div class="reqfield">*</div>&nbsp;: </div>

    <div class="waarde">

        <select size="1" name="contact_hvl" />

<?php

//----------------------------------------------------------

// Vul Input-select-element vanuit dbase met lijst

// betrokken hulpverleners voor deze patient (HVL's)

if (($_SESSION['isOrganisator']==0) && ($_SESSION['profiel']=="hulp")) {
   $extraVW = " and hb.persoon_id = {$_SESSION['usersid']} ";
   $alleenZichzelf = true;
}
else {
  $alleenZichzelf = false;
}




if (!$isProject) {
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
            hb.overleggenre = 'gewoon' AND
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            hb.genre = 'hulp' AND
            h.fnct_id=f.id
            $extraVW
        ORDER BY
            f.rangorde, hb.id, h.naam";
/*  dit stuk was toen menos en gdt beide evaluaties konden doen

  if ($patient['menos']==1 && $patient["actief"]==1) {
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
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            hb.genre = 'hulp' AND
            h.fnct_id=f.id
            $extraVW
        ORDER BY
            f.rangorde, hb.id, h.naam";
  }
  else if ($patient['menos']==1) {
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
  }
  else {
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
            hb.overleggenre = 'gewoon' AND
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            hb.genre = 'hulp' AND
            h.fnct_id=f.id
            $extraVW
        ORDER BY
            f.rangorde, hb.id, h.naam";
  }
  */
}
else {
    $queryHVL = "
        SELECT
            hb.persoon_id,
            hb.genre,
            h.naam,
            h.voornaam,
            f.naam  as functienaam
        FROM
            hulpverleners h,
            huidige_betrokkenen hb,
            functies f
        WHERE
            hb.overleggenre = 'gewoon' AND
            hb.patient_code ='".$_SESSION["pat_code"]."' AND
            hb.persoon_id=h.id AND
            (hb.genre = 'hulp' or hb.genre='orgpersoon') AND
            h.fnct_id=f.id
            $extraVW
        ORDER BY
            f.rangorde, hb.id, h.naam";
}

    $switch=false;

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

if (!$alleenZichzelf) {
// betrokken mantelzorgers voor deze patient (ZVL's)
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

// betrokken overlegcoordinatoren voor deze patient (ZVL's)

    $queryOC = "

        SELECT

            oc.id,

            oc.naam,

            oc.voornaam

        FROM

            logins oc,

            patient,

            gemeente

        WHERE

            oc.profiel = 'OC' AND

            oc.actief = 1 AND

            overleg_gemeente = gemeente.zip

            and gemeente.id = patient.gem_id

            and patient.code ='".$_SESSION["pat_code"]."'";

    if ($result=mysql_query($queryOC))

        {

        for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            if($persoonID==$records['id'] && $genre == "oc")

                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};

            print ("

               <option value=\"{$records['id']}|oc\" ".$selected.">".$records['naam']." ".$records['voornaam']." (OC TGZ)</option>\n");

            }

        }





if ($isProject) {

// betrokken PROJECTcoordinatoren voor deze patient (ZVL's)

    $queryTP = "

        SELECT

            oc.id,

            oc.naam,

            oc.voornaam,

            oc.profiel

        FROM

            logins oc,

            patient_tp

        WHERE

            (oc.profiel = 'hoofdproject' || oc.profiel = 'bijkomend project') AND

            oc.actief = 1 AND

            oc.tp_project = patient_tp.project

            and patient ='".$_SESSION["pat_code"]."'";

    if ($result=mysql_query($queryTP) or die($queryTP . mysql_error()))

        {

        for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            if($persoonID==$records['id'] && $genre == "oc")

                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};

            print ("

               <option value=\"{$records['id']}|{$records['profiel']}\" ".$selected.">".$records['naam']." ".$records['voornaam']."</option>\n");

            }

        }



}



        if($persoonID==-1 && $genre == "patient")

                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};

        print ("

               <option value=\"-1|patient\" ".$selected.">".$_SESSION['pat_naam']." ".$_SESSION['pat_voornaam']." (patient)</option>\n");



        $selected=($switch)?"":"selected=\"selected\"";

        print("<option value=\"10431\"".$selected.">Onbenoemd</option>");
}  // einde !$alleenZichzelf

//----------------------------------------------------------

?>

        </select>
<!--        <div>Pas eventueel eerst de <a href="zorgteam_bewerken.php">teamsamenstelling</a> aan.</div> -->
    </div><!--Contact HVL -->

        <div class="inputItem" id="IIVoortgang">

        <div class="label160">Voortgang&nbsp;:&nbsp;</div>

        <div>

            <textarea style="font-family: Arial, Helvetica, sans-serif; font-size:11px;"

                      rows="4" wrap="soft" cols="60" name="vooruitgang"><?php print($vooruitgang);?></textarea>

        </div> 

        </div><!--voortgang-->

<?php

  if (!isset($alleenBasisGegevens) && !(isPatientPsy($patient['type']))) {

?>

        <div class="inputItem" id="IIKatzscore">

        <div class="label160">Katz-score : &nbsp;</div>

        <div>

        <?php

        

         if (isset($katzID) && $katzID > 0) {

           $katz = mysql_fetch_array(mysql_query("select * from katz where id = $katzID"));

           $katzScore = $katz['totaal'];

           print("Huidige Katz-score is $katzScore. <br />\n");

           print("Als je wil, kan je <a href=\"katz_invullen.php?evalID=$evalID\">hier (her)berekenen.</a></p></li>");

         }

         else if (isset($katzID) && $katzID < 0) {

           $katz = mysql_fetch_array(mysql_query("select * from katz where id = -$katzID"));

           $katzScore = $katz['totaal'];

           print("Je hebt de Katz-score van het vorige overleg, zijnde $katzScore, overgenomen. <br />\n");

         }

         else if (isset($vorigeKatzID)) {

           print("De Katz-score bij $vorigeKatzTekst was {$vorigeKatz['totaal']}.<br />\n");

           print("<a href=\"fill_evaluatie_01.php?id=$evalID&neemKatzIDover=-$vorigeKatzID\">Neem deze over</a> ");

           print("of <a href=\"katz_invullen.php?evalID=$evalID\">vul een nieuwe in</a>.");

         }

        else {

           print("Vul een nieuwe <a href=\"katz_invullen.php?evalID=$evalID\">Katz-score in</a>.");

        }

         ?>

            <input type="hidden"  name="overnemen" value="" overneemValue="<?php print($VarOverleg_last_katzscore);?>" />

         </div> 

      </div><!--overleg_katzscore-->

<?php

     // taakfiches

   if (!$isProject) {

?>

        <div class="inputItem" >

        <div class="label160">Taakfiches :&nbsp;</div>

        <div>

<?php

     // taakfiches

             $refID = "evaluatie{$evalID}";

             $overlegID = $vorigOverleg['id'];

             require("../includes/taakfiches.php");

       print(" </div>

        </div><!--taakf_text--> \n");

  }

}

?>

    </fieldset>

    <fieldset>

        <div class="inputItem" id="IIButton">

         <div class="label160">Deze gegevens</div>

         <div class="waarde">

            <input type="hidden" name="actie" value="<?php print($action);?>" />

            <input type="hidden" name="id" value="<?php print($evalID);?>" />

            <input type="hidden" name="katzID" value="<?php print($katzID);?>" />

         <input type="submit" value="Opslaan <?= $extraTekst ?>" name="submit" onclick="return checkForm();" />

         </div> 

      </div><!--action-->

<?php

  if ($opgeslagen) {

?>

    <div style="clear: both;">

       De aanpassingen zijn opgeslagen. <br />Werk verder aan deze evaluatie, of kies links een nieuwe actie.



    </div>

<?php

  }

?>



    </fieldset>

</form>







<!-- EINDE FORMULIER -->

<?php









      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }

  } // einde else-tak van test of er al een overleg geweest is



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>