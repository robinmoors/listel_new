<style type="text/css">
   .aanwezig {
      background-color: rgb(90%, 100%, 90%);
   }
   .afwezig {
      background-color: rgb(100%, 90%, 90%);
   }
</style>
<?php

//include("../includes/toonSessie.inc");
// $overlegID wordt gezet in patientOverzicht.php

    print ("<div id=\"overleg$overlegID\" style=\"display:none\"><table width=\"520\" style=\"border:solid 1px black;padding:10px;\">");


    //----------------------------------------------------------

    //----------------------------------------------------------
    // Overlegcoordinator weergeven
    $OCQuery1="
            SELECT
                bl.aanwoc_id,
                bl.aanwoc_zb,
                bl.aanwoc_oc_id,
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
                g.gemte_id
            FROM
                aanweziglijstoc bl,
                overlegcoord o,
                gemeentes2 g
            WHERE
                bl.aanwoc_oc_id=o.overlcrd_id AND
                o.overlcrd_gem_id=g.gemte_id AND
                aanwoc_overleg_id = $overlegID;";

    $resultOCQuery1=mysql_query($OCQuery1);
    $oc_gegevens1= mysql_fetch_array($resultOCQuery1); //Query
    if ($recordsOverleg['overleg_type'] == 0) { // actief overleg
       print("<tr><td colspan=\"3\"><em>Dit is het huidige, nog niet afgeronde overleg.</em></td></tr>");
    }
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
    $queryHVL = "
         SELECT 
                h.hvl_id, 
                h.hvl_naam, 
                h.hvl_voornaam, 
                f.fnct_naam,
                bl.aanwhvl_hvl_id,
                bl.aanwhvl_contact,
                bl.aanwhvl_zb,
                h.hvl_riziv1, 
                h.hvl_riziv2, 
                h.hvl_riziv3,
                bl.aanwhvl_id,
                fnct_groep_id
            FROM 
                aanweziglijsthvl bl,
                hulpverleners h, 
                functies f 
            WHERE 
                h.hvl_fnct_id = f.fnct_id AND 
                bl.aanwhvl_hvl_id = h.hvl_id AND
                bl.aanwhvl_overleg_id = $overlegID
            ORDER BY
                f.fnct_rangorde"; // Query


      $huidigeGroep = 2;
      print ("
                    <tr><td>
                    <table><tr><td>&nbsp;
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
                    <table><tr><td>&nbsp;
                    </td><td><b>Hulpverleners</b></td></tr></table>                 
                    </td></tr>");
               if ($huidigeGroep == 3) print ("
                    <tr><td>
                    <table><tr><td>&nbsp;
                    </td><td><b>2e lijn en niet-professionele hulp</b></td></tr></table>
                    </td></tr>");
            }
            $veld1=($recordsHVL['hvl_naam']!="")    ?$recordsHVL['hvl_naam']    :"&nbsp;";
            $veld2=($recordsHVL['hvl_voornaam']!="")?$recordsHVL['hvl_voornaam']:"&nbsp;";
            $veld3=($recordsHVL['fnct_naam']!="")   ?$recordsHVL['fnct_naam']   :"&nbsp;";
            $veld3=($recordsHVL['aanwhvl_zb']==1) ?$veld3."<br />Zorgbemiddelaar" :$veld3;
            $rizivnr=   substr($recordsHVL['hvl_riziv1'],0,1)."-".
                        substr($recordsHVL['hvl_riziv1'],1,5)."-".
                        $recordsHVL['hvl_riziv2']."-".$recordsHVL['hvl_riziv3'];
            $markering_s=($recordsHVL['aanwhvl_contact']==1)?"<img src=\"../images/contact.gif\" alt=\"Contactpersoon\"  border=\"0\"align=\"middle\">":"";

            print ("
                <tr id=\"rij{$recordsHVL['aanwhvl_id']}\"><td>
                <table><tr><td>&nbsp;</td>
                <td width=\"220\"><li>".$veld1." ".$veld2.$markering_s."</li></td>
                <td>".$veld3."</td>
                </tr></table>
                </td>
                </tr>");}}
    //----------------------------------------------------------
   if ($huidigeGroep == 0) print ("
                    <tr><td>
                    <table><tr><td>&nbsp;
                    </td><td><b>Zorgverleners</b></td></tr></table>
                    </td></tr>");
   if ($huidigeGroep == 0 || $huidigeGroep == 2 ) print ("
                    <tr><td>
                    <table><tr><td>&nbsp;
                    </td><td><b>Hulpverleners</b></td></tr></table>
                    </td></tr>");
   if ($huidigeGroep == 0 || $huidigeGroep == 2 || $huidigeGroep == 1)print ("
                    <tr><td>
                    <table><tr><td>&nbsp;
                    </td><td><b>2e lijn en niet-professionele hulp</b></td></tr></table>
                    </td></tr>");
                    
    

    //----------------------------------------------------------
    // MantelzorgersLijst weergeven
    print ("<tr><td>&nbsp;</td></tr>");
    print ("<tr><td><b>Mantelzorg</b></td></tr>");
    print ("<tr><td><hr></td></tr>");
    print ("<tr><td>
                    <table><tr><td>&nbsp;
                    </td><td><b>Mantelzorger</b></td></tr></table>
                    </td></tr>");   
    $query = "
         SELECT
                m.mzorg_id, 
                m.mzorg_naam, 
                m.mzorg_voornaam, 
                bl.aanwmz_mz_id,
                bl.aanwmz_contact,
                v.verwsch_naam,
                v.verwsch_rangorde,
                bl.aanwmz_id
            FROM
                aanweziglijstmz bl,
                mantelzorgers m,
                verwantschap v
            WHERE 
                bl.aanwmz_mz_id = m.mzorg_id AND
                v.verwsch_id = m.mzorg_verwsch_id AND
                bl.aanwmz_overleg_id = $overlegID
            ORDER BY
                v.verwsch_rangorde,m.mzorg_naam";

      if ($result=mysql_query($query))
         {
         for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            $veld1=($records['mzorg_naam']!="")?$records['mzorg_naam']:"&nbsp;";
            $veld2=($records['mzorg_voornaam']!="")?$records['mzorg_voornaam']:"&nbsp;";
            $markering_s=($records['aanwmz_contact']==1)?"<img src=\"../images/contact.gif\" alt=\"Contactpersoon\"  border=\"0\"align=\"middle\">":"";


            print ("
                <tr  id=\"rijMZ{$records['aanwmz_id']}\"><td>
                <table><tr><td>&nbsp;</td>
                    <td width=\"220\"><li>".$veld1." ".$veld2.$markering_s."</li></td>
                    <td>".$records['verwsch_naam']."</td></tr></table>
                    </td>
                </tr>");}}
    //----------------------------------------------------------

    //-- doe de katz als $katzScore gezet is
    // katzScore ophalen
    $katzQry = "select  katz_totaal from katz where katz_overleg_id = $overlegID";
    //print($katzQry);
    if (!($katzResult = mysql_query($katzQry))) {
      die("dedju. kan katzscore niet ophalen bij patientoverzicht -- $katzQry");
    }
    else {
    $katzRij = mysql_fetch_array($katzResult);
    $katzScore = $katzRij['katz_totaal'];
    if ($katzScore > -1 ) {
        print("<tr><td>De KATZ-score was $katzScore. <a href=\"katz_bekijk.php\">Bekijk details</a></td></tr>");
      }
    else {
       print("<tr><td>De KATZ-score was niet ingevuld. ");
     }
    }
    // einde katzScore

    $queryEvaluatieInstrument = "select ei_overleg_id from evalinstr  where  ei_overleg_id = $overlegID";
    if ($resultEvIns=mysql_query($queryEvaluatieInstrument)) {
       if (mysql_num_rows($resultEvIns)!=0) {
            print("<tr><td>Het evaluatie-instrument was ingevuld. <a href=\"evaluatie_instrument_bekijk.php\">Bekijk details</a></td></tr>");
       }
       else {
            print("<tr><td>Het evaluatie-instrument was niet ingevuld.</td></tr>");
       }
    }
    else {
       print("shit de verkeerde $queryEvaluatieInstrument voor evalutieinstrument.");
    }


    //----------------------------------------------------------
    
    print ("</table></div>");
?>