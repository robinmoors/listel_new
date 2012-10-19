<?php

session_start();   // $_SESSION['pat_code']



$paginanaam="NVT: aanvragerformulier";


if (!(isset($_SESSION["profiel"]))) {
  die("KO;Geen toegang");
}
else if (!(isset($_GET['rr']))) {
  die("KO;Geen gegevens");
}




  //----------------------------------------------------------

  /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

  //----------------------------------------------------------
  
$qryPat = "select * from patient where rijksregister = '{$_GET['rr']}' order by actief desc";
$pat = mysql_fetch_assoc(mysql_query($qryPat));
  
       /***********************************************************/
       /*********** begin aanvrager van het overleg ***************/
       /***********************************************************/

//----------------------------------------------------------
// Vul Input-select-element vanuit dbase met lijst
// betrokken hulpverleners voor deze patient (HVL's)
    $queryHVL = "
        SELECT
            hb.persoon_id,
            hb.genre,
            h.naam,
            h.voornaam,
            h.organisatie,
            o.naam as org_naam,
            f.naam  as functienaam
        FROM
            hulpverleners h left join organisatie o on h.organisatie = o.id,
            huidige_betrokkenen hb,
            functies f
        WHERE
            hb.overleggenre = 'gewoon' AND
            hb.patient_code ='".$pat["code"]."' AND
            hb.persoon_id=h.id AND
            (hb.genre = 'hulp' or hb.genre='orgpersoon') AND
            h.fnct_id=f.id
        ORDER BY
            f.rangorde, hb.id, h.naam";


    $switch=false;

    if ($result=mysql_query($queryHVL))
    {
        $aantalxvl=mysql_num_rows ($result);
        if ($aantalxvl > 0) {
?>
    <div class="legende">Stap 4: de aanvrager<br/>&nbsp;</div>

        <div class="inputItem" id="IIContactpersoon">
         <div class="label220">Aanvrager<div class="reqfield">*</div>&nbsp;: </div>
    <div class="waarde">
        <input type="hidden" name="naam" id="naam" />
        <input type="hidden" name="functie" id="functie" />
        <input type="hidden" name="organisatieAanvrager" id="organisatieAanvrager" />

        <select size="1" name="aanvrager_complex" onchange="var nr=this.selectedIndex;vulAanvragerIn(this.options[nr].value);">
<?php
        }
        else {
           // er zijn nog geen betrokkenen, dus lege tekst terug geven!
?>
<?php
           /* Sluit Dbconnectie */ require("../includes/dbclose.inc");
           die("KO!!");
        }
        for ($i=0; $i < mysql_num_rows($result); $i++)
        {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['persoon_id'] && ($genre == "hulp" || $genre == "orgpersoon"))
                 {$selected=" selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"{$records['org_naam']}|{$records['functienaam']}|{$records['voornaam']} {$records['naam']}\" ".$selected." $stijl>".$records['naam']." ".$records['voornaam']." ({$records['functienaam']})</option>\n");
        }
    }
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
            hb.patient_code ='".$pat["code"]."' AND
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
               <option value=\"{$records['functienaam']}|mantel|{$records['voornaam']} {$records['naam']}\" ".$selected.">".$records['naam']." ".$records['voornaam']." ({$records['functienaam']})</option>\n");
            }
        }
// betrokken overlegcoordinatoren voor deze patient (OC-TGZ's)
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
            and patient.code ='".$pat["code"]."'";
    if ($result=mysql_query($queryOC))
        {
        for ($i=0; $i < mysql_num_rows ($result); $i++)
            {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['id'] && $genre == "oc")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"oc|oc|{$records['voornaam']} {$records['naam']}\" ".$selected.">".$records['naam']." ".$records['voornaam']." (OC TGZ)</option>\n");
            }
        }

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
            and patient ='".$pat["code"]."'";
    if ($result=mysql_query($queryTP) or die($queryTP . mysql_error()))
    {
        for ($i=0; $i < mysql_num_rows ($result); $i++)
        {
            $records= mysql_fetch_array($result);
            if($persoonID==$records['id'] && $genre == "oc")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
            print ("
               <option value=\"{$records['profiel']}|{$records['profiel']}|{$records['voornaam']} {$records['naam']}\" ".$selected.">".$records['naam']." ".$records['voornaam']."</option>\n");
        }
    }


        if($persoonID==-1 && $genre == "patient")
                 {$selected="selected=\"selected\"";$switch=true;}else{$selected="";};
        print ("
               <option value=\"-1|patient|patient\" ".$selected.">".$pat['naam']." ".$pat['voornaam']." (patient)</option>\n");
        $selected=($switch)?"":"selected=\"selected\"";
        print("<option value=\"onbenoemd|onbenoemd|onbenoemd\"".$selected.">Onbenoemd</option>");
//----------------------------------------------------------
?>
        </select>
        <div>Pas eventueel eerst de <a href="zorgteam_bewerken.php?pat_code=<?= $pat['code'] ?>">teamsamenstelling</a> aan.<br/>
             Je verliest dan wel de gegevens op deze pagina.</div>
    </div><!-- aanvrager -->
<?php

     /***********************************************************/
     /*********** einde aanvrager van het overleg ***************/
     /***********************************************************/




  //---------------------------------------------------------

  /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

  //---------------------------------------------------------




?>

