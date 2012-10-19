<?php

session_start();

$paginanaam="Evaluatie-instrument nieuw";
$magAltijd = true;


if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")) && (!isset($_GET['code']))) {
//---------------------------------------------------------------
/* Open Empty Html */ require('../includes/open_empty_html.inc');
//---------------------------------------------------------------
?>
    U bent niet geautoriseerd tot deze pagina.
    U wordt dadelijk terug gestuurd naar de listel-site waar u links uit het menu een keuze kan maken.
    <script type="text/javascript">
     function redirect()
     {
         <?php print("document.location = \"/\";"); ?>
     }
     setTimeout("redirect()",500);
    </script>
<?php
//-----------------------------------------------------------------
/* Close Empty Html */ require('../includes/close_empty_html.inc');
//-----------------------------------------------------------------
exit;
}
// we hebben toegang tot de pagina


function eindePagina() {
	print("</div>");
	print("</div>");
	print("</div>");
	require("../includes/footer.inc");
	print("</div>");
	print("</div>");
    //---------------------------------------------------------
    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
    //---------------------------------------------------------
	print("</body>");
	print("</html>");

}





if (isset($_POST['pat_code'])) {
  $_SESSION['pat_code'] = $_POST['pat_code'];
}
else if (isset($_GET['patient'])) {
  $_SESSION['pat_code'] = $_GET['patient'];
}



//----------------------------------------------------------
/* Maak Dbconnectie */ require('../includes/dbconnect2.inc');
//----------------------------------------------------------

    if (isset($_POST['returnPage'])) {
      $returnPage = $_POST['returnPage'];
    }
    else {
      $returnPage = $_SERVER['HTTP_REFERER'];
    }
    
    $returnPage = str_replace("Teamoverleg","Attesten",$returnPage);

    // eerst nakijken of er een code is meegegeven én of die code bestaat
    // als er geen code ingegeven is, kijken we naar toegang
    if (isset($_GET['code']) && !isset($_POST['overlegID'])) {
       $qryCode = "select patient_code, id, eval_nieuw, genre from overleg where logincode = \"{$_GET['code']}\"";
       if ($codeResult = mysql_query($qryCode)) {
          if (mysql_num_rows($codeResult) == 1) {
            $codeRij = mysql_fetch_array($codeResult);
            $evalID = $codeRij['eval_nieuw'];
            $overlegID = $codeRij['id'];
            if ($codeRij['genre'] == "menos") {
              $overlegGenre = "menos";
            }
            else {
              $overlegGenre = "gewoon";
            }
            $_SESSION['pat_code'] = $codeRij['patient_code'];
            $goedeCode = true;
          }
          else {
            die("Dit is een ongeldige code!");
          }
       }
       else {
         die("stomme code-query  $qryCode");
       }
    }
    else if (isset($_POST['overlegID'])) {
      $overlegID = $_POST['overlegID'];
      if ($_POST['overlegGenre'] == "menos") {
        $overlegGenre = "menos";
      }
      else {
        $overlegGenre = "gewoon";
      }
      $evalID = $_POST['evalID'];
      if ($_POST['evalID']==0) {
         // nieuwe evaluatie
         $qry = "insert into evalinstr_nieuw  (
uitvoerder_id,
dd,
mm,
jjjj,
v1_1,
v1_2,
v1_3,
v1_4,
v1_5,
v1_6,
v1_7,
v1_8,
v1_9,
v1_10,
v1_11,
v1_12,
v1_13,
v1_14,
v1_15,
v1_16,
v1_17,
v1_18,
v1_19,
v1_20,
v1_21,
v1_22,
v2_1,
v2_2,
v2_3,
v2_4,
v2_5,
v2_6,
v2_7,
v2_8,
v2_9,
v2_10,
v2_11,
v3_1,
v3_2,
v3_3,
v4_1,
v4_2,
v4_3,
v4_4,
v5_1,
v5_2,
v5_3,
v5_4,
v5_5,
v5_6,
v5_7,
extra1_1,
extra1_2,
extra1_3,
extra1_4,
extra1_5,
extra1_6,
extra1_7,
extra1_8,
extra1_9,
extra1_10,
extra1_11,
extra1_12,
extra1_13,
extra1_14,
extra1_15,
extra1_16,
extra1_17,
extra1_18,
extra1_19,
extra1_20,
extra1_21,
extra1_22,
extra2_1,
extra2_2,
extra2_3,
extra2_4,
extra2_5,
extra2_6,
extra2_7,
extra2_8,
extra2_9,
extra2_10,
extra2_11,
extra3_1,
extra3_2,
extra3_3,
extra4_1,
extra4_2,
extra4_3,
extra4_4,
extra5_1,
extra5_2,
extra5_3,
extra5_4,
extra5_5,
extra5_6,
extra5_7,

v6,
v7,
v8
                 )
                 values
(
{$_POST['uitvoerder_id']},
{$_POST['dd']},
{$_POST['mm']},
{$_POST['jjjj']},
{$_POST['v1_1']},
{$_POST['v1_2']},
{$_POST['v1_3']},
{$_POST['v1_4']},
{$_POST['v1_5']},
{$_POST['v1_6']},
{$_POST['v1_7']},
{$_POST['v1_8']},
{$_POST['v1_9']},
{$_POST['v1_10']},
{$_POST['v1_11']},
{$_POST['v1_12']},
{$_POST['v1_13']},
{$_POST['v1_14']},
{$_POST['v1_15']},
{$_POST['v1_16']},
{$_POST['v1_17']},
{$_POST['v1_18']},
{$_POST['v1_19']},
{$_POST['v1_20']},
{$_POST['v1_21']},
{$_POST['v1_22']},
{$_POST['v2_1']},
{$_POST['v2_2']},
{$_POST['v2_3']},
{$_POST['v2_4']},
{$_POST['v2_5']},
{$_POST['v2_6']},
{$_POST['v2_7']},
{$_POST['v2_8']},
{$_POST['v2_9']},
{$_POST['v2_10']},
{$_POST['v2_11']},
{$_POST['v3_1']},
{$_POST['v3_2']},
{$_POST['v3_3']},
{$_POST['v4_1']},
{$_POST['v4_2']},
{$_POST['v4_3']},
{$_POST['v4_4']},
{$_POST['v5_1']},
{$_POST['v5_2']},
{$_POST['v5_3']},
{$_POST['v5_4']},
{$_POST['v5_5']},
{$_POST['v5_6']},
{$_POST['v5_7']},
\"{$_POST['extra1_1']}\",
\"{$_POST['extra1_2']}\",
\"{$_POST['extra1_3']}\",
\"{$_POST['extra1_4']}\",
\"{$_POST['extra1_5']}\",
\"{$_POST['extra1_6']}\",
\"{$_POST['extra1_7']}\",
\"{$_POST['extra1_8']}\",
\"{$_POST['extra1_9']}\",
\"{$_POST['extra1_10']}\",
\"{$_POST['extra1_11']}\",
\"{$_POST['extra1_12']}\",
\"{$_POST['extra1_13']}\",
\"{$_POST['extra1_14']}\",
\"{$_POST['extra1_15']}\",
\"{$_POST['extra1_16']}\",
\"{$_POST['extra1_17']}\",
\"{$_POST['extra1_18']}\",
\"{$_POST['extra1_19']}\",
\"{$_POST['extra1_20']}\",
\"{$_POST['extra1_21']}\",
\"{$_POST['extra1_22']}\",
\"{$_POST['extra2_1']}\",
\"{$_POST['extra2_2']}\",
\"{$_POST['extra2_3']}\",
\"{$_POST['extra2_4']}\",
\"{$_POST['extra2_5']}\",
\"{$_POST['extra2_6']}\",
\"{$_POST['extra2_7']}\",
\"{$_POST['extra2_8']}\",
\"{$_POST['extra2_9']}\",
\"{$_POST['extra2_10']}\",
\"{$_POST['extra2_11']}\",
\"{$_POST['extra3_1']}\",
\"{$_POST['extra3_2']}\",
\"{$_POST['extra3_3']}\",
\"{$_POST['extra4_1']}\",
\"{$_POST['extra4_2']}\",
\"{$_POST['extra4_3']}\",
\"{$_POST['extra4_4']}\",
\"{$_POST['extra5_1']}\",
\"{$_POST['extra5_2']}\",
\"{$_POST['extra5_3']}\",
\"{$_POST['extra5_4']}\",
\"{$_POST['extra5_5']}\",
\"{$_POST['extra5_6']}\",
\"{$_POST['extra5_7']}\",

\"{$_POST['v6']}\",
\"{$_POST['v7']}\",
\"{$_POST['v8']}\"
)
                 ";
           $ok = mysql_query($qry) or die ($qry . mysql_error());
           $evalID = mysql_insert_id();
           $qry2 = "update overleg set eval_nieuw = $evalID where id = {$_POST['overlegID']}";

           $deleteKatzAanvraag = "delete from katz_aanvraag where overleg = {$_POST['overlegID']} and wat='evaluatie'";
           $ok3 = mysql_query($deleteKatzAanvraag);
           $updateKatzAanvraag = "update katz_aanvraag set wat='katz' where overleg = {$_POST['overlegID']} and (wat='katz+evaluatie' or wat='katz_evaluatie')";
           $ok4 = mysql_query($updateKatzAanvraag);

           $ok2 = mysql_query($qry2) or die ($qry2 . mysql_error());
           if ($ok && $ok2 && $ok3 && $ok4) {
              /************ begin email sturen naar organisator van het overleg ***********************/
              $overlegInfo = getFirstRecord("select * from overleg where id = {$_POST['overlegID']}");
              $organisator = organisatorRecordVanOverleg($overlegInfo);
              $msg = "De evaluatie bij patient {$_SESSION['pat_code']} is ingevuld. Je kan nu verder met het overleg.";
              htmlmail($organisator['email'],"Listel: evaluatie {$_SESSION['pat_code']} ingevuld.","Beste overlegco&ouml;rdinator<br/>$msg \n<br /><p>Met dank voor uw medewerking, <br />Het LISTEL e-zorgplan www.listel.be </p>");
              /************ einde email sturen naar OC TGZ ***********************/
              print("<div style=\"background-color: #6f6\">Evaluatie-instrument succesvol opgeslagen.</div>");
              print("<script type=\"text/javascript\">	setTimeout('document.location=\"{$_POST['returnPage']}\"',2000); </script>"); // Redirect
           }
           else {
              print("<div style=\"background-color: red\">Fout tijdens het opslaan van het evaluatie-instrument.</div>");
           }
      }
      else {
        // oude evaluatie updaten
        $qry = "update evalinstr_nieuw set
uitvoerder_id = {$_POST['uitvoerder_id']},
dd = {$_POST['dd']},
mm = {$_POST['mm']},
jjjj = {$_POST['jjjj']},
v1_1 = {$_POST['v1_1']}                                ,
v1_2 = {$_POST['v1_2']}                               ,
v1_3 = {$_POST['v1_3']}                              ,
v1_4 = {$_POST['v1_4']}                             ,
v1_5 = {$_POST['v1_5']}                            ,
v1_6 = {$_POST['v1_6']}                           ,
v1_7 = {$_POST['v1_7']}                          ,
v1_8 = {$_POST['v1_8']}                          ,
v1_9 = {$_POST['v1_9']}                         ,
v1_10 = {$_POST['v1_10']}                      ,
v1_11 = {$_POST['v1_11']}                     ,
v1_12 = {$_POST['v1_12']}                    ,
v1_13 = {$_POST['v1_13']}                   ,
v1_14 = {$_POST['v1_14']}                  ,
v1_15 = {$_POST['v1_15']}                 ,
v1_16 = {$_POST['v1_16']}                ,
v1_17 = {$_POST['v1_17']}               ,
v1_18 = {$_POST['v1_18']}              ,
v1_19 = {$_POST['v1_19']}             ,
v1_20 = {$_POST['v1_20']}            ,
v1_21 = {$_POST['v1_21']}           ,
v1_22 = {$_POST['v1_22']}          ,
v2_1 = {$_POST['v2_1']}           ,
v2_2 = {$_POST['v2_2']}          ,
v2_3 = {$_POST['v2_3']}         ,
v2_4 = {$_POST['v2_4']}        ,
v2_5 = {$_POST['v2_5']}       ,
v2_6 = {$_POST['v2_6']}      ,
v2_7 = {$_POST['v2_7']}     ,
v2_8 = {$_POST['v2_8']}    ,
v2_9 = {$_POST['v2_9']}   ,
v2_10 = {$_POST['v2_10']},
v2_11 = {$_POST['v2_11']}                                            ,
v3_1 = {$_POST['v3_1']}                                             ,
v3_2 = {$_POST['v3_2']}                                            ,
v3_3 = {$_POST['v3_3']}                                           ,
v4_1 = {$_POST['v4_1']}                                          ,
v4_2 = {$_POST['v4_2']}                                         ,
v4_3 = {$_POST['v4_3']}                                        ,
v4_4 = {$_POST['v4_4']}                                       ,
v5_1 = {$_POST['v5_1']}                                      ,
v5_2 = {$_POST['v5_2']}                                     ,
v5_3 = {$_POST['v5_3']}                                    ,
v5_4 = {$_POST['v5_4']}                                   ,
v5_5 = {$_POST['v5_5']}                                  ,
v5_6 = {$_POST['v5_6']}                                 ,
v5_7 = {$_POST['v5_7']}                                ,
extra1_1 = \"{$_POST['extra1_1']}\"                   ,
extra1_2 = \"{$_POST['extra1_2']}\"                  ,
extra1_3 = \"{$_POST['extra1_3']}\"                 ,
extra1_4 = \"{$_POST['extra1_4']}\"                ,
extra1_5 = \"{$_POST['extra1_5']}\"               ,
extra1_6 = \"{$_POST['extra1_6']}\"              ,
extra1_7 = \"{$_POST['extra1_7']}\"             ,
extra1_8 = \"{$_POST['extra1_8']}\"            ,
extra1_9 = \"{$_POST['extra1_9']}\"           ,
extra1_10 = \"{$_POST['extra1_10']}\"        ,
extra1_11 = \"{$_POST['extra1_11']}\"       ,
extra1_12 = \"{$_POST['extra1_12']}\"      ,
extra1_13 = \"{$_POST['extra1_13']}\"     ,
extra1_14 = \"{$_POST['extra1_14']}\"    ,
extra1_15 = \"{$_POST['extra1_15']}\"   ,
extra1_16 = \"{$_POST['extra1_16']}\"  ,
extra1_17 = \"{$_POST['extra1_17']}\" ,
extra1_18 = \"{$_POST['extra1_18']}\",
extra1_19 = \"{$_POST['extra1_19']}\"                         ,
extra1_20 = \"{$_POST['extra1_20']}\"                        ,
extra1_21 = \"{$_POST['extra1_21']}\"                       ,
extra1_22 = \"{$_POST['extra1_22']}\"                       ,
extra2_1 = \"{$_POST['extra2_1']}\"                        ,
extra2_2 = \"{$_POST['extra2_2']}\"                       ,
extra2_3 = \"{$_POST['extra2_3']}\"                      ,
extra2_4 = \"{$_POST['extra2_4']}\"                     ,
extra2_5 = \"{$_POST['extra2_5']}\"                    ,
extra2_6 = \"{$_POST['extra2_6']}\"                   ,
extra2_7 = \"{$_POST['extra2_7']}\"                  ,
extra2_8 = \"{$_POST['extra2_8']}\"                 ,
extra2_9 = \"{$_POST['extra2_9']}\"                ,
extra2_10 = \"{$_POST['extra2_10']}\"             ,
extra2_11 = \"{$_POST['extra2_11']}\"            ,
extra3_1 = \"{$_POST['extra3_1']}\"             ,
extra3_2 = \"{$_POST['extra3_2']}\"            ,
extra3_3 = \"{$_POST['extra3_3']}\"           ,
extra4_1 = \"{$_POST['extra4_1']}\"          ,
extra4_2 = \"{$_POST['extra4_2']}\"         ,
extra4_3 = \"{$_POST['extra4_3']}\"        ,
extra4_4 = \"{$_POST['extra4_4']}\"       ,
extra5_1 = \"{$_POST['extra5_1']}\"      ,
extra5_2 = \"{$_POST['extra5_2']}\"     ,
extra5_3 = \"{$_POST['extra5_3']}\"    ,
extra5_4 = \"{$_POST['extra5_4']}\"   ,
extra5_5 = \"{$_POST['extra5_5']}\"  ,
extra5_6 = \"{$_POST['extra5_6']}\" ,
extra5_7 = \"{$_POST['extra5_7']}\",
v6 = \"{$_POST['v6']}\",
v7 = \"{$_POST['v7']}\",
v8 = \"{$_POST['v8']}\"
where id = {$_POST['evalID']}";

           $ok = mysql_query($qry) or die ($qry . mysql_error());
           if ($ok) {
              print("<div style=\"background-color: #6f6\">Evaluatie-instrument succesvol opgeslagen.</div>");
              print("<script type=\"text/javascript\">	setTimeout('document.location=\"{$_POST['returnPage']}\"',2000); </script>"); // Redirect
           }
           else {
              print("<div style=\"background-color: red\">Fout tijdens het opslaan van het evaluatie-instrument.</div>");
           }
       }
    }
    else if (isset($_GET['eval_nieuw'])) {
       $codeRij['eval_nieuw'] = $_GET['eval_nieuw'];
       $evalID = $codeRij['eval_nieuw'];
       $overlegID = $_GET['overleg_id'];
       $qryCode = "select genre from overleg
                   where id $overlegID";
       $codeResult = mysql_query($qryCode);
       $codeRij = mysql_fetch_array($codeResult);
       if ($codeRij['genre'] == "menos") {
         $overlegGenre = "menos";
       }
       else {
        $overlegGenre = "gewoon";
       }
    }
    else  {  // nieuw evaluatieinstrument, dus laatste niet afgeronde overleg zoeken
       if ($_SESSION['profiel']=="menos") {
         $voorwaarde = " and genre = 'menos' ";
       }
       else {
          $voorwaarde = " AND (overleg.genre is NULL or overleg.genre = 'gewoon' or overleg.genre = 'TP') ";
       }
       $qryCode = "select id, eval_nieuw, genre from overleg
                   where patient_code = \"{$_SESSION['pat_code']}\"
                   $voorwaarde
                   AND afgerond = 0;";
       if ($codeResult = mysql_query($qryCode)) {
          if (mysql_num_rows($codeResult) == 1) {
            $codeRij = mysql_fetch_array($codeResult);
            $evalID = $codeRij['eval_nieuw'];
            $overlegID = $codeRij['id'];
            if ($codeRij['genre'] == "menos") {
              $overlegGenre = "menos";
            }
            else {
              $overlegGenre = "gewoon";
            }
          }
          else {
             die("er is geen overleg gepland voor deze patient");
          }
       }
       else {
         die("stomme code-query  $qryCode");
       }
    }

  $values = array();
  $values['vraag'] = array();
  $values['vraag']['v1_1']="gebruik maken van communicatie-apparatuur en -technieken (bv. telefoon)";
  $values['vraag']['v1_2']="zich zelfstandig buitenshuis verplaatsen";
  $values['vraag']['v1_3']="zich zelfstandig verplaatsen (zonder openbaar of priv&eacute; vervoer)";
  $values['vraag']['v1_4']="zorg dragen voor eigen gezondheid op vlak van medicatie";
  $values['vraag']['v1_5']="&nbsp;&nbsp;&nbsp;-	aanschaf medicatie";
  $values['vraag']['v1_6']="&nbsp;&nbsp;&nbsp;-	klaarzetten medicatie";
  $values['vraag']['v1_7']="&nbsp;&nbsp;&nbsp;-	inname medicatie";
  $values['vraag']['v1_8']="zorg dragen voor eigen gezondheid op vlak van voeding";
  $values['vraag']['v1_9']="boodschappen doen";
  $values['vraag']['v1_10']="eenvoudige maaltijden bereiden (voedsel roeren, koken, ..) ";
  $values['vraag']['v1_11']="het huishouden doen:";
  $values['vraag']['v1_12']="&nbsp;&nbsp;&nbsp;-	wassen en drogen kledij";
  $values['vraag']['v1_13']="&nbsp;&nbsp;&nbsp;-	schoonmaken kookruimte en afwas";
  $values['vraag']['v1_14']="&nbsp;&nbsp;&nbsp;-	schoonmaken woonruimte en sanitair";
  $values['vraag']['v1_15']="&nbsp;&nbsp;&nbsp;-	bedienen huishoudelijk apparatuur bv. wasmachine";
  $values['vraag']['v1_16']="&nbsp;&nbsp;&nbsp;-	verwijderen van afval";
  $values['vraag']['v1_17']="eenvoudige financi&euml;le transacties uitvoeren bv. geld gebruiken";
  $values['vraag']['v1_18']="instaan voor eigen administratie";
  $values['vraag']['v1_19']="deelnemen aan activiteiten i.k.v. recreatie en vrije tijd";
  $values['vraag']['v1_20']="zich verplaatsen binnen de woning (doorgang woning)";
  $values['vraag']['v1_21']="de woning is bereikbaar";
  $values['vraag']['v1_22']="de woning is bruikbaar";

  $values['vraag']['v2_1']="transfers uitvoeren in zitpositie";
  $values['vraag']['v2_2']="transfers uitvoeren in ligpositie";
  $values['vraag']['v2_3']="zich binnenshuis verplaatsen";
  $values['vraag']['v2_4']="zich wassen";
  $values['vraag']['v2_5']="zorgdragen voor toiletgang  (urineren, defecatie, menstruatie)";
  $values['vraag']['v2_6']="zich kleden:";
  $values['vraag']['v2_7']="&nbsp;&nbsp;&nbsp;-	aantrekken kleding";
  $values['vraag']['v2_8']="&nbsp;&nbsp;&nbsp;-	uittrekken kleding";
  $values['vraag']['v2_9']="&nbsp;&nbsp;&nbsp;-	aantrekken voetbedekking";
  $values['vraag']['v2_10']="&nbsp;&nbsp;&nbsp;-	uittrekken voetbedekking";
  $values['vraag']['v2_11']="eten  en drinken (naar de mond brengen, in stukken snijden, eetgerei gebruiken,...)";

  $values['vraag']['v3_1']="bewustzijn (mate van bewustzijn en alertheid)";
  $values['vraag']['v3_2']="ori&euml;ntatie (kan zich ori&euml;nteren in tijd, plaats en ruimte )";
  $values['vraag']['v3_3']="geheugen (kan informatie terug vinden)";

  $values['vraag']['v4_1']="zich gedragen volgens de sociale regels in gezelschap";
  $values['vraag']['v4_2']="informele sociale relaties aangaan, onderhouden ";
  $values['vraag']['v4_3']="omgaan met medebewoners";
  $values['vraag']['v4_4']="familiale relaties aangaan, onderhouden";

  $values['vraag']['v5_1']="is de naaste familie betrokken  ";
  $values['vraag']['v5_2']="is de verre familie betrokken (ooms, tantes,..)";
  $values['vraag']['v5_3']="is er contact met vrienden ( evt. buren)";
  $values['vraag']['v5_4']="zijn producten en technologie voor persoonlijk gebruik bij dagelijkse activiteiten aanwezig  (bv. telefoon)";
  $values['vraag']['v5_5']="zijn technische aspecten van de woning aangepast naar de behoefte (bv. bredere deuren , traplift) ";
  $values['vraag']['v5_6']="zijn zorg- en/of hulpverleners vanuit de eerstelijnsgezondheidszorg betrokken";
  $values['vraag']['v5_7']="zijn persoonlijke verzorgers en assistenten ingeschakeld (excl. Familie, vrienden en professionele hulpverlening)";

  if (isset($_POST['v1_1'])) {
    $values['keuze'] = $_POST;
  }
  else if ($evalID != 0) {
     $zoekEvalId = abs($evalID);
     $qry = "select * from evalinstr_nieuw where id = $zoekEvalId";
     $resultEval = mysql_query($qry) or die($qry . mysql_error());
     if (mysql_num_rows($resultEval) > 0) {
       $values['keuze'] = mysql_fetch_assoc($resultEval);
     }
  }
  
  if ($values['keuze']['dd']==0) $values['keuze']['dd'] = date("d");
  if ($values['keuze']['mm']==0) $values['keuze']['mm'] = date("m");
  if ($values['keuze']['jjjj']==0) $values['keuze']['jjjj'] = date("Y");

  if (strlen($values['keuze']['dd'])==1) $values['keuze']['dd'] = "0" . $values['keuze']['dd'];
  if (strlen($values['keuze']['mm'])==1) $values['keuze']['mm'] = "0" . $values['keuze']['mm'];


  function toonKeuze($index) {
    global $values;

    if ($values['keuze'][$index]==1) $een = " checked=\"checked\" ";
    if ($values['keuze'][$index]==-1) $minEen = " checked=\"checked\" ";

    $extraIndex = "extra" . substr($index, 1);

    print("<tr><td><input type=\"radio\" name=\"{$index}\" id=\"{$index}_1\" value=\"1\" $een/></td>
               <td><input type=\"radio\" name=\"{$index}\" id=\"{$index}_2\" value=\"-1\" $minEen/></td>
               <td>{$values['vraag'][$index]}</td>
               <td><input type=\"text\" size=\"35\" name=\"{$extraIndex}\" value=\"{$values['keuze'][$extraIndex]}\"></td>
           </tr>
          ");
  }



	require("../includes/html_html.inc");
	print("<head>");
	require("../includes/html_head.inc");
    //-----------------------------------------------------------------------------
    /* Controle numerieke velden */ include("../includes/checkForNumbersOnly.inc");
    //-----------------------------------------------------------------------------
    // --------------------------------------------------------



  print("<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/domtab4.css\" />\n");
  print("<style type=\"text/css\">.main {min-height: 880px;}</style>\n");
  print("</head>");
	print("<body>");
	print("<div align=\"center\">");
	print("<div class=\"pagina\">");
	require("../includes/header.inc");
	require("../includes/pat_id.inc");
	print("<div class=\"contents\">");
	require("../includes/menu.inc");
	print("<div class=\"main\" id=\"main\">");
	print("<div class=\"mainblock\">");



?>

<h1>Het (nieuwe) evaluatieformulier</h1>

<p>
Alle onderstaande items zijn verplicht aan te duiden om te kunnen afronden in het e-zorgplan!
</p>

<?php

/*
      for ($i=1; $i<=22; $i++) {
        print(" extra1_$i = \\\"{_POST['extra1_$i']}\\\"<br/>");
      }
      for ($i=1; $i<=11; $i++) {
        print(" extra2_$i = \\\"{_POST['extra1_$i']}\\\"<br/>");
      }
      for ($i=1; $i<=3; $i++) {
        print(" extra3_$i = \\\"{_POST['extra1_$i']}\\\"<br/>");
      }
      for ($i=1; $i<=4; $i++) {
        print(" extra4_$i = \\\"{_POST['extra1_$i']}\\\"<br/>");
      }
      for ($i=1; $i<=7; $i++) {
        print(" extra5_$i = \\\"{_POST['extra1_$i']}\\\"<br/>");
      }

      for ($i=1; $i<=22; $i++) {
        print(" extra1_$i, <br/>");
      }
      for ($i=1; $i<=11; $i++) {
        print(" extra2_$i, <br/>");
      }
      for ($i=1; $i<=3; $i++) {
        print(" extra3_$i, <br/>");
      }
      for ($i=1; $i<=4; $i++) {
        print(" extra4_$i, <br/>");
      }
      for ($i=1; $i<=7; $i++) {
        print(" extra5_$i, <br/>");
      }

      for ($i=1; $i<=22; $i++) {
        print(" \\\"{_POST['extra1_$i']}\\\", <br/>");
      }
      for ($i=1; $i<=11; $i++) {
        print(" \\\"{_POST['extra2_$i']}\\\", <br/>");
      }
      for ($i=1; $i<=3; $i++) {
        print(" \\\"{_POST['extra3_$i']}\\\", <br/>");
      }
      for ($i=1; $i<=4; $i++) {
        print(" \\\"{_POST['extra4_$i']}\\\", <br/>");
      }
      for ($i=1; $i<=7; $i++) {
        print(" \\\"{_POST['extra5_$i']}\\\", <br/>");
      }

      for ($i=1; $i<=22; $i++) {
        print(" `v1_$i` TINYINT NOT NULL, <br/>");
        print(" `extra1_$i` varchar(255) NULL, <br/>");
      }
      for ($i=1; $i<=11; $i++) {
        print(" `v2_$i` TINYINT NOT NULL, <br/>");
        print(" `extra2_$i` varchar(255) NULL, <br/>");
      }
      for ($i=1; $i<=3; $i++) {
        print(" `v3_$i` TINYINT NOT NULL, <br/>");
        print(" `extra3_$i` varchar(255) NULL, <br/>");
      }
      for ($i=1; $i<=4; $i++) {
        print(" `v4_$i` TINYINT NOT NULL, <br/>");
        print(" `extra4_$i` varchar(255) NULL, <br/>");
      }
      for ($i=1; $i<=7; $i++) {
        print(" `v5_$i` TINYINT NOT NULL, <br/>");
        print(" `extra5_$i` varchar(255) NULL, <br/>");
      }
*/

  $actieveTab = "Deel1";
?>

<form id="afrondformulier" name="f" method="post" onsubmit="return testAlles();">

<div  id="IINaam">



        Ingevuld door<span class="reqfield">*</span>&nbsp;:
            <select size="1" name="uitvoerder_id"  <?php print($disabledLang); ?> >
<?php
//----------------------------------------------------------
// Vul Input-select-element vanuit dbase met lijst
// betrokken hulpverleners voor deze patient (HVL's)

      $query2 = "
         SELECT
                bl.persoon_id,
                h.naam as hvl_naam,
                h.voornaam,
                f.naam as fnct_naam
         FROM
                hulpverleners h,
                huidige_betrokkenen bl,
                functies f
            WHERE
                bl.overleggenre = 'gewoon' AND
                bl.patient_code='".$_SESSION["pat_code"]."' AND
                bl.persoon_id=h.id AND
                (bl.genre = 'hulp' or bl.genre = 'orgpersoon') AND
                h.fnct_id=f.id
         ORDER BY
            h.naam";

      $switch=false;

      if ($result2=mysql_query($query2))
      {
         $aantalxvl=mysql_num_rows ($result2);
         for ($i=0; $i < mysql_num_rows ($result2); $i++)
         {
            $records2= mysql_fetch_array($result2);
            if ($records2['persoon_id']==$values['keuze']['uitvoerder_id']) {
               $selected=" selected=\"selected\"";$switch=true;
            }
            else if ($records2['persoon_id']==$_GET['hvl_id'] && $values['keuze']['uitvoerder_id']==0) {
               $selected=" selected=\"selected\"";$switch=true;
            }
            else {
              $selected="";
            }
            print ("
                <option $disabledLang value=\"".$records2['persoon_id']."\" ".$selected.">".$records2['hvl_naam']." ".$records2['voornaam']."</option>\n");
        }

         $selected=($switch)?"":" selected=\"selected\"";

            print("<option $disabledLang value=\"0\"".$selected.">Onbenoemd</option></select>");

         }

     else {

       print("mannekes $query2");

     }

//----------------------------------------------------------
?>
         op

        <span class="iinputItem" id="IIStartdatum">

         <span class="waarde2">

            <input type="text" size="2" value="<?php print($values['keuze']['dd']);?>" name="dd"  <?php print($disabledLang); ?>

                onKeyup="checkForNumbersOnly(this,2,0,31,'f','mm')"

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input type="text" size="2" value="<?php print($values['keuze']['mm']);?>" name="mm"  <?php print($disabledLang); ?>

                onKeyup="checkForNumbersOnly(this,2,0,12,'f','jjjj')"

                onblur="checkForNumbersLength(this,2)" />&nbsp;/&nbsp;

            <input type="text" size="2" value="<?php print($values['keuze']['jjjj']);?>" name="jjjj" <?php print($disabledLang); ?>

                onKeydown="checkForNumbersOnly(this,4,2010,2069,'f','jjjj')"

                onblur="checkForNumbersLength(this,4)" />

         </span>

      </span>
</div>

<div>
  <input type="submit" value="Opslaan en terug naar de vorige pagina" />
  <input type="hidden" name="overlegID" value="<?= $overlegID ?>" />
  <input type="hidden" name="evalID" value="<?= $evalID ?>" />
  <input type="hidden" name="overlegGenre" value="<?= $overlegGenre ?>" />
  <input type="hidden" name="returnPage" value="<?= $returnPage ?>" />
  <br/>&nbsp;<br/>
</div>

<div id="tabcontainer"> <!-- 4 opties -->
  <div class="tabmenu" id="tabDeel1"><a href="javascript:toon('Deel1');">Deel 1</a></div>
  <div class="tabmenu" id="tabDeel23"><a href="javascript:toon('Deel23');">Deel 2 en 3</a></div>
  <div class="tabmenu" id="tabDeel45"><a href="javascript:toon('Deel45');">Deel 4 en 5</a></div>
  <div class="tabmenu" id="tabDeel6"><a href="javascript:toon('Deel6');">Tekstvakken</a></div>

  <div class="tabcontent" id="Deel1">
  <h2>1. IADL (Instrumentele Activiteiten Dagelijks Leven)</h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>De pati&euml;nt kan</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=22; $i++) {
        toonKeuze("v1_$i");
      }
    ?>
  </table>
  </div>


  <div class="tabcontent" id="Deel23" >
  <h2>2.	ADL (Activiteiten Dagelijks Leven)  (zie ook KATZ-schaal)</h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>De pati&euml;nt kan</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=11; $i++) {
        toonKeuze("v2_$i");
      }
    ?>
  </table>
  <h2>3.	Functies van het organisme </h2>
  <table>
    <tr>
      <th>+</th>
      <th>-</th>
      <th>De functie is goed(+) of niet goed(-)</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=3; $i++) {
        toonKeuze("v3_$i");
      }
    ?>
  </table>
  </div>

  <div class="tabcontent" id="Deel45">
  <h2>4.	Functioneren in sociale omgeving </h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>De pati&euml;nt kan</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=4; $i++) {
        toonKeuze("v4_$i");
      }
    ?>
  </table>
  <h2>5.	Externe factoren </h2>
  <table>
    <tr>
      <th>Ja</th>
      <th>Nee</th>
      <th>&nbsp;</th>
      <th>Bijkomende opmerkingen</th>
    </tr>
    <?php
      for ($i=1; $i<=7; $i++) {
        toonKeuze("v5_$i");
      }
    ?>
  </table>
  </div>

  <div class="tabcontent" id="Deel6">
   <fieldset>
      <div class="legende">6.	Aanwezige hulpmiddelen (bv. tillift, gaankader,...)</div>
      <div>&nbsp;</div>
      <div class="waarde">
            <textarea rows="4" wrap="soft" cols="50" name="v6"><?= $values['keuze']['v6'] ?></textarea>
      </div>
      <div>&nbsp;</div>
   </fieldset>
   <fieldset>
      <div class="legende">7.	Tegemoetkomingen </div>
      <div>&nbsp;</div>
      <div class="waarde">
            <textarea rows="4" wrap="soft" cols="50" name="v7"><?= $values['keuze']['v7'] ?></textarea>
      </div>
      <div>&nbsp;</div>
   </fieldset>
   <fieldset>
      <div class="legende">8.	Bijkomende aandachtspunten</div>
      <div>&nbsp;</div>
      <div class="waarde">
            <textarea rows="4" wrap="soft" cols="50" name="v8"><?= $values['keuze']['v8'] ?></textarea>
      </div>
      <div>&nbsp;</div>
   </fieldset>
  </div>

</div> <!-- einde 4 opties -->


</form>


<script type="text/javascript">
  function testAlles() {
      var msg = "";
     
      if (document.f.dd.value.length == 0 ||
        document.f.mm.value.length == 0 ||
        document.f.jjjj.value.length == 0 ) {
        msg = msg + "  - u hebt geen datum ingevuld.\n";
      }

      if (document.f.uitvoerder_id.value == 0) {
        msg = msg + "  - u hebt niet aangeduid wie de evaluatie ingevuld heeft\n";
      }

      for ($i=1; $i<=22; $i++) {
        if (!(document.getElementById("v1_" + $i + "_1").checked || document.getElementById("v1_" + $i + "_2").checked)) {
         msg = msg + "  - er zijn nog niet ingevulde vragen in deel 1\n";
         break;
        }
      }
      for ($i=1; $i<=11; $i++) {
        if (!(document.getElementById("v2_" + $i + "_1").checked || document.getElementById("v2_" + $i + "_2").checked)) {
         msg = msg + "  - er zijn nog niet ingevulde vragen in deel 2\n";
         break;
        }
      }
      for ($i=1; $i<=3; $i++) {
        if (!(document.getElementById("v3_" + $i + "_1").checked || document.getElementById("v3_" + $i + "_2").checked)) {
         msg = msg + "  - er zijn nog niet ingevulde vragen in deel 3\n";
         break;
        }
      }
      for ($i=1; $i<=4; $i++) {
        if (!(document.getElementById("v4_" + $i + "_1").checked || document.getElementById("v4_" + $i + "_2").checked)) {
         msg = msg + "  - er zijn nog niet ingevulde vragen in deel 4\n";
         break;
        }
      }
      for ($i=1; $i<=7; $i++) {
        if (!(document.getElementById("v5_" + $i + "_1").checked || document.getElementById("v5_" + $i + "_2").checked)) {
         msg = msg + "  - er zijn nog niet ingevulde vragen in deel 5\n";
         break;
        }
      }

    if (msg == "") return true;
    else {
      alert("Het evaluatieformulier is nog niet volledig: \n" + msg);
      return false;
    }
  }

  var alleItems = new Array("Deel1",
                            "Deel23",
                            "Deel45",
                            "Deel6");

  function activeer(item) {
    var elem = document.getElementById(item);
    var tab = document.getElementById("tab"+item).firstChild;
    elem.style.display = 'block';
    tab.style.fontStyle = 'normal';
    //tab.style.color = 'black';
    tab.style.backgroundColor = '#FFCC66';
  }

  function desactiveer(item) {
    var elem = document.getElementById(item);
    var tab = document.getElementById("tab"+item).firstChild;
    elem.style.display = 'none';
    //tab.style.color = '#D58700';
    tab.style.fontStyle = 'normal';
    tab.style.backgroundColor = 'white';
  }

  function disableTab(item) {
    desactiveer(item);
    var tab = document.getElementById("tab"+item).firstChild;
    tab.style.fontStyle = "italic";
    tab.style.color = '#D5CCCC';
  }


  function enableTab(item) {
    var tab = document.getElementById("tab"+item).firstChild;
    tab.style.color = '#D58700';
  }




  function toon(item) {
    // alleen wanneer er een andere tab dan Basisgegevens geselecteerd is
    // kan er écht geklikt worden op de verschillende tabs
    for (nr in alleItems) {
      desactiveer(alleItems[nr]);
    }
    activeer(item);
  }

  toon("Deel1");
</script>



<?php
  eindePagina();
?>



