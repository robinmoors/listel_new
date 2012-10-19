<style type="text/css">
   .aanwezig {
      background-color: rgb(90%, 100%, 90%);
   }
   .afwezig {
      background-color: rgb(100%, 90%, 90%);
   }
</style>
<?php

$baseURL = $baseURL1 = "overleg.php";

//include("../includes/toonSessie.inc");


    print ("<p><table width=\"520\" style=\"border:solid 1px black;padding:10px;\">");

    if ($_SESSION['gdt'])
      $samenstellingOK = true;
    else
      $samenstellingOK = false;

    //----------------------------------------------------------
    // Eventuele waarschuwing weergeven
    if ($_SESSION['eersteOverleg']) {
       print ("<tr><td>".$meldingZP."</td></tr><tr><td><hr></td></tr>");
    }
    else  if ($_SESSION['wilGDT'] == 1) {
       print ("<tr><td>".$meldingWilGDT."</td></tr><tr><td><hr></td></tr>");
    }
    else  if ($_SESSION['gdt']) {
       print ("<tr><td>".$meldingGDT."</td></tr><tr><td><hr></td></tr>");
    }
    else if (isset($meldingKanGDT)) {
       print ("<tr><td class=\"tip\">$meldingKanGDT</td></tr><tr><td><hr></td></tr>");
    }
    if ($_SESSION['wilGDT'] == 1 && !$_SESSION['gdt']) {
       $terugGewoon = 1;
    }



    if ($_SESSION['gdt'] && (!isset($_SESSION['wilGDT']) || ($_SESSION['wilGDT'] == -1))) {
      $toonGDT = true;
          ?>
            <tr><td>Dit overleg komt in aanmerking voor vergoeding.
                  <form method="post" style="display:inline">
                     <input style="width:400px" type="submit" name="wilGDT" value="Procedure opstarten voor aanvraag vergoeding"
                        onClick="return confirm('Bevestig dat de pati&euml;nt ofwel thuis verblijft OF opgenomen is in een instelling\nwaarbij een terugkeer naar de thuisomgeving is gepland binnen de acht dagen.\n ' +
                        '\nBovendien wordt er verondersteld dat de pati&euml;nt nog ten minste 1 maand \nthuis zal blijven met een verminderde fysieke zelfredzaamheid.');">
                  </form>
                  <form method="post" style="display:inline">
                     <input style="width:400px" type="submit" name="geenGDT" value="Vergoeding niet aanvragen en doorgaan als gewoon overleg"
                        onClick="return confirm('Ben je zeker dat je wil doorgaan als een niet-vergoedbaar overleg?')";>
                  </form>
            </td></tr> <tr><th><hr /></th></tr>
          <?php
    }
    //----------------------------------------------------------

    //----------------------------------------------------------
    // Overlegcoordinator weergeven
    $OCQuery1="
            SELECT
                bl.betrokoc_id,
                bl.betrokoc_zb,
                bl.betrokoc_oc_id,
                o.overlcrd_id,
                o.overlcrd_voornaam,
                o.overlcrd_naam,
                o.overlcrd_adres,
                o.overlcrd_gem_id,
                o.overlcrd_tel,
                o.overlcrd_fax,
                o.overlcrd_gsm,
                o.overlcrd_email,
                o.overlcrd_sit_id,
                g.gemte_dlzip,
                g.gemte_dlnaam,
                g.gemte_id,
                bl.betrokoc_pat_nr 
            FROM
                betroklijstoc bl,
                overlegcoord o,
                gemeentes2 g
            WHERE
                bl.betrokoc_pat_nr=".$_SESSION['pat_nr']." AND
                bl.betrokoc_oc_id=o.overlcrd_id AND
                o.overlcrd_gem_id=g.gemte_id";
    $resultOCQuery1=mysql_query($OCQuery1);
    $oc_gegevens1= mysql_fetch_array($resultOCQuery1); //Query
    print ("<tr><td><b>Co&ouml;rdinatie&nbsp;van&nbsp;overleg</b></td></tr>");
    print ("<tr><td><hr></td></tr>");
    print ("<tr><td>
            <table><tr><td width=\"10\">&nbsp;</td>
            <td width=\"260\"><ul><li><b>".$oc_gegevens1[5]." ".$oc_gegevens1[4]."</b></li></ul></td>
            <td>Overlegco&ouml;rdinator TGZ</td></tr></table>
            </td></tr>");
    //----------------------------------------------------------

    //----------------------------------------------------------
    // HulpverlenersLijst weergeven
    print ("<tr>    <td>&nbsp;</td></tr>");
    print ("<tr>    <td><b>Zorg&nbsp;en&nbsp;hulpverlening</b></td></tr>");
    print ("<tr>    <td><hr></td></tr>");
    if (isset($_GET['alleenGroen'])) {
      $beperking = "AND betrokhvl_temp = 1";
    }
    else {
      $beperking = "";
    }
    $queryHVL = "
         SELECT 
                h.hvl_id, 
                h.hvl_naam, 
                h.hvl_voornaam, 
                f.fnct_naam,
                bl.betrokhvl_hvl_id,
                bl.betrokhvl_contact, 
                bl.betrokhvl_zb, 
                h.hvl_riziv1, 
                h.hvl_riziv2, 
                h.hvl_riziv3,
                bl.betrokhvl_id,
                fnct_groep_id,
                betrokhvl_temp
            FROM 
                betroklijsthvl bl, 
                hulpverleners h, 
                functies f 
            WHERE 
                h.hvl_fnct_id = f.fnct_id AND 
                bl.betrokhvl_hvl_id = h.hvl_id AND
                bl.betrokhvl_pat_nr=".$_SESSION['pat_nr']."
                AND betrokhvl_temp >= 0
                $beperking
            ORDER BY 
                f.fnct_rangorde"; // Query
                
      $huidigeGroep = 2;
      print ("
                    <tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_zvl_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>Zorgverleners</b></td></tr></table>                 
                    </td></tr>");
      if ($resultHVL=mysql_query($queryHVL))
         {
         for ($i=0; $i < mysql_num_rows ($resultHVL); $i++)
            {
            $recordsHVL= mysql_fetch_array($resultHVL);
            if ($huidigeGroep != $recordsHVL['fnct_groep_id']) {
               $huidigeGroep = $recordsHVL['fnct_groep_id'];
               if ($huidigeGroep == 1) print ("
                    <tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_hvl_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>Hulpverleners</b></td></tr></table>                 
                    </td></tr>");
               if ($huidigeGroep == 3) print ("
                    <tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_xvl_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>2e lijn en niet-professionele hulp</b></td></tr></table>                    
                    </td></tr>");
            }
            $veld1=($recordsHVL['hvl_naam']!="")    ?$recordsHVL['hvl_naam']    :"&nbsp;";
            $veld2=($recordsHVL['hvl_voornaam']!="")?$recordsHVL['hvl_voornaam']:"&nbsp;";
            $veld3=($recordsHVL['fnct_naam']!="")   ?$recordsHVL['fnct_naam']   :"&nbsp;";
            $veld3=($recordsHVL['betrokhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;
            $rizivnr=   substr($recordsHVL['hvl_riziv1'],0,1)."-".
                        substr($recordsHVL['hvl_riziv1'],1,5)."-".
                        $recordsHVL['hvl_riziv2']."-".$recordsHVL['hvl_riziv3'];
            $markering_s=($recordsHVL['betrokhvl_contact']==1)?"<img src=\"../images/contact.gif\" alt=\"Contactpersoon\"  border=\"0\"align=\"middle\">":"";
            $aanwezig = $recordsHVL['betrokhvl_temp'] == 1;

            if ($aanwezig)  {
              $stijl = "aanwezig";
              $checked = "checked = \"checked\" onClick=\"document.location = '$baseURL?a_wishvl_id={$recordsHVL['betrokhvl_id']}'\"";

            }
            else {
              $stijl = "afwezig";
              $checked = "onClick=\"document.location = '$baseURL?a_plushvl_id={$recordsHVL['betrokhvl_id']}'\"";
            }

            print ("
                <tr class=\"$stijl\" id=\"rij{$recordsHVL['betrokhvl_id']}\"><td>
                <table><tr><td><input type=\"checkbox\" name=\"id{$recordsHVL['betrokhvl_id']}\" $checked></td>
                <td width=\"220\">".$veld1." ".$veld2.$markering_s."</td>
                <td>".$veld3."</td>
                </tr></table>
                </td>
                <td><a href=\"$baseURL?a_stophvl_id=".$recordsHVL['betrokhvl_id']."\">
                <img src=\"../images/wis2.gif\" alt=\"Verwijder als betrokkene\"  border=\"0\"></a></td> 
                </tr>");}}
    //----------------------------------------------------------
   if ($huidigeGroep == 0) print ("
                    <tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_zvl_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>Zorgverleners</b></td></tr></table>                 
                    </td></tr>");
   if ($huidigeGroep == 0 || $huidigeGroep == 2 ) print ("
                    <tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_hvl_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>Hulpverleners</b></td></tr></table>                 
                    </td></tr>");
   if ($huidigeGroep == 0 || $huidigeGroep == 2 || $huidigeGroep == 1)print ("
                    <tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_xvl_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>2e lijn en niet-professionele hulp</b></td></tr></table>                    
                    </td></tr>");
                    
    

    //----------------------------------------------------------
    // MantelzorgersLijst weergeven
    print ("<tr><td>&nbsp;</td></tr>");
    print ("<tr><td><b>Mantelzorg</b></td></tr>");
    print ("<tr><td><hr></td></tr>");
    print ("<tr><td>
                    <table><tr><td><a href=\"overleg_plannen_select_mz_twee.php\">
                    <img src=\"../images/voegtoe.gif\" alt=\"Toevoegen\"  border=\"0\"></a>
                    </td><td><b>Mantelzorger</b></td></tr></table>                  
                    </td></tr>");   
    if (isset($_GET['alleenGroen'])) {
      $beperking = "AND betrokmz_temp = 1";
    }
    else {
      $beperking = "";
    }
    $query = "
         SELECT
                m.mzorg_id, 
                m.mzorg_naam, 
                m.mzorg_voornaam, 
                bl.betrokmz_mz_id,
                bl.betrokmz_contact,
                v.verwsch_naam,
                v.verwsch_rangorde,
                bl.betrokmz_id,
                betrokmz_temp
            FROM 
                betroklijstmz bl, 
                mantelzorgers m,
                verwantschap v
            WHERE 
                bl.betrokmz_mz_id = m.mzorg_id AND
                v.verwsch_id = m.mzorg_verwsch_id AND
                bl.betrokmz_pat_nr=".$_SESSION['pat_nr']."
                AND betrokmz_temp >= 0
                $beperking
            ORDER BY 
                v.verwsch_rangorde,m.mzorg_naam";
    
      if ($result=mysql_query($query))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            $veld1=($records['mzorg_naam']!="")?$records['mzorg_naam']:"&nbsp;";
            $veld2=($records['mzorg_voornaam']!="")?$records['mzorg_voornaam']:"&nbsp;";
            $markering_s=($records['betrokmz_contact']==1)?"<img src=\"../images/contact.gif\" alt=\"Contactpersoon\"  border=\"0\"align=\"middle\">":"";

            $aanwezig = $records['betrokmz_temp'] == 1;

            if ($aanwezig)  {
              $stijl = "aanwezig";
              $checked = "checked = \"checked\" onClick=\"document.location = '$baseURL?a_wismz_id={$records['betrokmz_id']}'\"";

            }
            else {
              $stijl = "afwezig";
              $checked = "onClick=\"document.location = '$baseURL?a_plusmz_id={$records['betrokmz_id']}'\"";
            }

            print ("
                <tr class=\"$stijl\" id=\"rijMZ{$records['betrokmz_id']}\"><td>
                <table><tr><td><input type=\"checkbox\" name=\"id{$records['betrokmz_id']}\" $checked></td>
                    <td width=\"220\">".$veld1." ".$veld2.$markering_s."</td>
                    <td>".$records['verwsch_naam']."</td></tr></table>
                    </td>
                    <td><a href=\"$baseURL?a_stopmz_id=".$records['betrokmz_id']."\">
                      <img src=\"../images/wis2.gif\" alt=\"Verwijder als betrokkene\"  border=\"0\"></a></td> 
                </tr>");}}
    //----------------------------------------------------------
    if (!$_SESSION['gdt']) {
      $fout = "Het zorgteam heeft nog niet de juiste samenstelling.\n";
    }

    //-- doe de katz als $katzScore gezet is
    if (isset($katzScore)) {
      print("<tr><td>Huidige KATZ-score is $katzScore, voorwaarde ");
      if ($katzScore < 5) {
         print("<b>niet</b> ");
      }
//      print("voldaan.  <a href=\"overleg_plannen_doe_katz.php\">(Her)bereken</a></td></tr>");
      print("voldaan.  <a href=\"katz_invullen.php\">(Her)bereken</a></td></tr>");

    }
    else {
      print("<tr><td>De KATZ-score is nog niet ingevuld. ");
//      print("<a href=\"overleg_plannen_doe_katz.php\">Doe dat hier.</a></td></tr>");
      print("<a href=\"katz_invullen.php\">Doe dat hier.</a></td></tr>");
    }
    if ($katzScore < 5)  {
      $_SESSION['zorgenplan']=false;
      $_SESSION['gdt']=false;
      $fout .= "De katz-score bedraagt maar $katzScore en dat is te weinig.\n";
    }
    // einde katzScore

    $queryEvaluatieInstrument = "select ei_overleg_id from evalinstr  where  ei_overleg_id = {$_SESSION['overleg_id']}";
    if ($resultEvIns=mysql_query($queryEvaluatieInstrument)) {
       if (mysql_num_rows($resultEvIns)==0) {
          $_SESSION["nogGeenEval"] = true;
          if ($_SESSION['actie'] == "afwerken") {
            $werkwoord = "moet";
          }
          else {
            $werkwoord = "kan";
          }
          if ($_SESSION['wilGDT']==1)
            print("<tr><td>Het evaluatie-instrument is nog <b>niet</b> ingevuld. Dit is een verplichte voorwaarde voor vergoeding. Je $werkwoord dat <a href=\"ingeven_evaluatie_instr_01.php\">hier doen</a>.</td></tr>");
          else
            print("<tr><td>Het evaluatie-instrument is nog <b>niet</b> ingevuld. Je $werkwoord dat <a href=\"ingeven_evaluatie_instr_01.php\">hier doen</a>.</td></tr>");
          $_SESSION['gdt']=false;
          $fout .= "Het evaluatie-instrument is nog niet ingevuld.\n";
       }
       else {
          if ($_SESSION['wilGDT']==1) $vergoedUitleg = "De voorwaarde voor een vergoedbaar overleg is voldaan.";
          print("<tr><td>Evaluatie-instrument is ingevuld. $vergoedUitleg <a href=\"ingeven_evaluatie_instr_01.php?action=Aanpassen\">Pas aan</a></td></tr>");
       }
    }
    else {
       print("shit de verkeerde $queryEvaluatieInstrument voor evalutieinstrument.");
    }

    ?>

    <tr><td><iframe src="../includes/doe_email.php" width="500" height="50" frameborder="0"></iframe></td></tr>

    <?php


    $queryContact = "select max(betrokhvl_contact) from betroklijsthvl where betrokhvl_pat_nr = {$_SESSION['pat_nr']};" ;
    if ($resultContact=mysql_query($queryContact)) {
       $rij = mysql_fetch_array($resultContact);
       if ($rij[0] == 0) {
          print("<tr><td>Je hebt nog geen contactpersonen gekozen. Doe dat <a href=\"overleg_plannen_select_contact_twee.php\">hier</a>.</td></tr>");
          $geenContactPersonen = true;
       }
       else {
          print("<tr><td>Wijzig hier eventueel je <a href=\"overleg_plannen_select_contact_twee.php\">contactpersonen</a>.</td></tr>");
       }
    }
    else {
       print("shit de verkeerde $queryContact voor contactpersonen.");
    }

       if ($_SESSION['actie'] == "afsluiten") {
         print("<tr><td>Vul hier de <a href=\"overleg_taakfiche.php\">taakfiches</a> in</td></tr> ");
       }  
         // yse - afsluiten upload docs
         
         // files verwijderen
         if (is_array($_POST['delfiles'])) {
            foreach ($_POST['delfiles'] as $bestand) {
                mysql_query("DELETE FROM overleg_files WHERE overleg_id = '" . $_SESSION['overleg_id'] . "' AND filename = '" . $bestand . "'");
                unlink($_SERVER['DOCUMENT_ROOT'] . '/_download/' . $bestand);
            }
         }

         // nieuwe files toevoegen

         if ($_FILES['upload']['tmp_name']) {
            $alias = pathinfo(strtolower($_FILES['upload']['name']));
            $filename = md5(uniqid(rand(), true)) . '.' . $alias["extension"];
            
            //toegelaten extensies
            $extensies_ok = array('pdf','xls','doc');
            if (in_array($alias["extension"],$extensies_ok)) {
                move_uploaded_file($_FILES['upload']['tmp_name'],$_SERVER['DOCUMENT_ROOT'] . '/_download/' . $filename);
                // insert query
                mysql_query("INSERT into overleg_files 
                        VALUES ('" . $_SESSION['overleg_id'] . "','" . $filename . "','" . $alias["basename"] . "',NOW())");    
                        
                $msg = "Bestand toegevoegd";
            } 
            else {
                $msg = '<span class="accentcel">Enkel PDF, Word-documenten en Excel documenten zijn toegestaan</span>';
                }
            
                    
         }
         
         
         // bestaande files weergeven        
         $file_res = mysql_query("SELECT * FROM overleg_files WHERE overleg_id = '". $_SESSION['overleg_id'] . "'");
         print("<tr><td><hr /><strong>Bijlagen</strong><br />$msg");
         print('<form action="" method="post" enctype="multipart/form-data" name="uploadform" onsubmit="document.uploadform.submit.disabled=\'true\';document.uploadform.submit.value=\'Bezig met versturen\'">');
         
         if (mysql_num_rows($file_res)) {
             print("Aangevinkte bestanden worden verwijderd wanneer je hieronder op de knop \"Bestanden bijwerken\" klikt.<br />");
             print("<ul style=\"margin: 10px 0\">");
             while ($overleg_file = mysql_fetch_object($file_res)) { 
                print("<li><input type=\"checkbox\" name=\"delfiles[]\" value=\"" . $overleg_file->filename . "\"><a href=\"/_download/" . $overleg_file->filename . "\">" . $overleg_file->alias . "</a></li>");
             }
             print("</ul>");             
         }
         
         print('Toevoegen: <input type="file" name="upload">                
            <br /><input type="submit" name="submit" value="Bestanden bijwerken"  />
            <input type="hidden" name="pat_nr" value="' . $_POST['pat_nr'] . '" />
            <input type="hidden" name="dossierCodeInput" value="' . $_POST['dossierCodeInput'] . '" />
            </form>');
         
         print("<hr /></td></tr>");
         

       
    if (($_SESSION['overleg_jj'] < 2003) || ($_SESSION['overleg_jj'] == 2003 && $_SESSION['overleg_mm'] < 7)) {
       $_SESSION['gdt'] = false;
       $fout = "Dit dossier is van voor de wetgeving op GDT's";
    }
    

    //----------------------------------------------------------
    // Buttons weergeven
    print ("<tr>    <td style=\"text-align:center;\"><table><tr>");
    //unset($_SESSION['wilGDT']);

    if ($terugGewoon) {
    ?>
          <td>Je wilde een vergoedbaar overleg, maar je samenstelling van het zorgteam is niet meer in orde.<br />
              <form method="post">
                     <input type="submit" name="wisGDT" value="Wil je verder gaan als niet-vergoedbaar overleg?">
              </form>
            </td></tr> <tr><th><hr /></th></tr>
    <?php
    }

    if ($toonGDT) {
          ?>
            <td>Dit overleg komt in aanmerking voor vergoeding.
                  <form method="post" style="display:inline">
                     <input style="width:400px" type="submit" name="wilGDT" value="Procedure opstarten voor aanvraag vergoeding"
                        onClick="return confirm('Bevestig dat de pati&euml;nt ofwel thuis verblijft OF opgenomen is in een instelling\nwaarbij een terugkeer naar de thuisomgeving is gepland binnen de acht dagen?\n ' +
                        '\nBovendien wordt er verondersteld dat de pati&euml;nt nog ten minste 1 maand \nthuis zal blijven met een verminderde fysieke zelfredzaamheid.');">
                  </form>
                  <form method="post" style="display:inline">
                     <input style="width:400px" type="submit" name="geenGDT" value="Vergoeding niet aanvragen en doorgaan als gewoon overleg"
                        onClick="return confirm('Ben je zeker dat je wil doorgaan als een niet-vergoedbaar overleg?')";>
                  </form>
            </td></tr> <tr><th><hr /></th></tr>
          <?php
    }
    else if ($geenContactPersonen) {
       print ("        <td><p>kies eerst de <a href=\"overleg_plannen_select_contact_twee.php\">contactpersonen</a> vooraleer documenten af te drukken</td>");
    }
    else if ($katzScore < 5 && $_SESSION['actie']=="afsluiten") {
       print ("        <td><p title=\"$fout\">afronden nog niet mogelijk (foute Katz-score)</td>");
    }
    else if ($_SESSION['actie']=="afsluiten" && $_SESSION['wilGDT']==1 && $_SESSION['gdt']) {
       print ("\n        <td><form action=\"overleg_definitief_afronden.php\"><input bgColor=\"green\" type=\"submit\" value=\"overleg definitief afronden\"   ");
       print ("                onClick=\"return confirm('Na deze stap worden alle gegevens definitief opgeslagen. \\n\\nDoorgaan?');\"></form></td>");
    }
    else if ($_SESSION['actie']!="afsluiten" && $_SESSION['wilGDT']==1 && $samenstellingOK) {
       print ("        <td><form action=\"overleg_plannen_printen.php\"><input bgColor=\"green\" type=\"submit\" value=\"documenten afdrukken voor vergoedbaar overleg\"></form></td>");
    }
    else if ($_SESSION['wilGDT']!=1 && $_SESSION['actie']!="afsluiten") {
       print ("        <td><form action=\"overleg_plannen_printen.php\"><input bgColor=\"green\" type=\"submit\" value=\"documenten afdrukken voor een gewoon overleg\"></form></td>");
    }
    else if ($_SESSION['wilGDT']!=1 && $katzScore >= 5 && $_SESSION['actie']=="afsluiten") {
       print ("\n        <td><form action=\"overleg_definitief_afronden.php\"><input bgColor=\"green\" type=\"submit\" value=\"overleg definitief afronden\" ");
       print ("                   onClick=\"return confirm('Na deze stap worden alle gegevens definitief opgeslagen.\\nControleer even of alles in orde is (juiste aanwezigheden, taakfiches ingevuld, ...).  \\n\\nDoorgaan?');\"></form></td>");
    }
    else {
       print ("        <td>volgende stap nog niet mogelijk: " . nl2br($fout) . "</td>");
    }
    // einde knopje gdt
    print ("
                    <td><form action=\"$baseURL1\" method=\"post\" name=\"ff\">
                    <input type=\"hidden\" name=\"resetter\" value=\"0\">

                    <!-- <input type=\"submit\" name=\"allenAanwezig\" onClick=\"document.ff.resetter.value=1;\" value=\"Reset lijst\"></form></td> -->
                    </tr></table></td></tr>                 
                    
");
    //----------------------------------------------------------
    
    print ("</table></p>");
?>