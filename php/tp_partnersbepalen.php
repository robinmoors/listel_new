<?php

session_start();





function voegToeAlsNogNietToegevoegd1x($organisatie, $patient, $overleg) {

   $qryAl = "select persoon_id from huidige_betrokkenen

             where overleggenre = 'gewoon'
             and persoon_id = $organisatie
             and genre = 'org'

             and patient_code = '$patient'";

   if (mysql_num_rows(mysql_query($qryAl))==0) {

      if ($overleg > 0) {

        $planOK = mysql_query("insert into overleg_tp_plan (overleg, genre, persoon) values ($overleg, 'org', $organisatie)");

      }

      else {

        $planOK = true;

      }

      if (mysql_query("insert into huidige_betrokkenen (patient_code, genre, persoon_id, overleggenre) values ('$patient', 'org', $organisatie),'gewoon'") && $planOK)

        return true;

      else

        return false;

   }

   else

      return false;

}



function voegToeAlsNogNietToegevoegd($organisaties,$patient,$overleg) {

   $toegevoegd = false;

   foreach ($organisaties as $org) {

     $toegevoegd = voegToeAlsNogNietToegevoegd1x($org, $patient, $overleg) || $toegevoegd;

   }

   return $toegevoegd;

}






   require("../includes/dbconnect2.inc");
   require("../includes/clearSessie.inc");

   $paginanaam="TP: Partners bepalen";

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan")

          && ($_SESSION['profiel'] == "hoofdproject" || $_SESSION['profiel'] == "bijkomend project"))

      {



// gegevens opslaan

if (isset($_POST['partner'])) {

   $reset = "delete from tp_partner where tp = {$_SESSION['tp_project']}";

   $values = "";

   foreach ($_POST['partner'] as $org) {

      $values .= ", ({$_SESSION['tp_project']}, $org)";

   }

   $values = substr($values,1);

   $insert = "insert into tp_partner values $values";

   if (mysql_query($reset) && mysql_query($insert)) {

     $print = "<p style='background-color: #8f8'>De partners zijn opgeslagen.</p>";



     // en nu de partners updaten

     $qryPatienten = "select patient from patient_tp where actief = 1 and project = {$_SESSION['tp_project']}";

     $resultPatienten = mysql_query($qryPatienten);

     $ergensToegevoegd = false;

     for ($ii=0; $ii<mysql_num_rows($resultPatienten); $ii++) {

       $rijPatient = mysql_fetch_assoc($resultPatienten);

       // effe kijken of deze patient een lopend overleg heeft

       $overlegDezePatient = getNrHuidigOverleg($rijPatient['patient']);

       $ergensToegevoegd = voegToeAlsNogNietToegevoegd($_POST['partner'],$rijPatient['patient'],$overlegDezePatient) || $ergensToegevoegd;

     }

     if ($ergensToegevoegd) {

        $print .= "<p style='background-color: #8f8'>Bovendien hebben we aan bestaande pati&euml;nten nieuwe partners toegevoegd.</p>";

     }





   }

   else {

     $print = "<p style='background-color: #f88'>goedverdoemme da mag ni zijn he. $reset en $insert geven fouten...</p>";

   }

}



      require("../includes/html_html.inc");

      print("<head>");

      print("\n<script type=\"text/javascript\" src=\"../javascript/prototype.js\"></script>\n");



      require("../includes/html_head.inc");

      

$qryPartners = "select organisatie.* from organisatie, tp_partner

                where tp_partner.partner = organisatie.id and tp_partner.tp = {$_SESSION['tp_project']}";

$resultPartners = mysql_query($qryPartners);



      

?>

<script type="text/javascript">

var partnerNr = <?= mysql_num_rows($resultPartners) ?> + 1;

function voegPartnerToe(nr) {

    var rij = document.getElementById('form').insertRow(partnerNr);

    partnerNr++;

    var cel = rij.insertCell(0);

    cel.className="label";

    cel.innerHTML = "Partner " + partnerNr + ":";

    cel = rij.insertCell(1);

    cel.className="input";

    cel.innerHTML = "<img src=\"../images/wis.gif\" onclick=\"verwijderPartner(" + partnerNr + ")\"/><input type=\"hidden\" name=\"partner[" + partnerNr + "]\" value=\"" + organisaties[nr]['id']+ "\"/>" + organisaties[nr]['naam'] + "\n";

}



function verwijderPartner(nr) {

  var rij = document.getElementById('form').rows[nr-1];

  rij.cells[0].innerHTML = "";

  rij.cells[1].innerHTML = "";

}

</script>



<?php

      print("</head>");

      print("<body>");

      print("<div align=\"center\">");

      print("<div class=\"pagina\">");

      require("../includes/header.inc");

      require("../includes/kruimelpad.inc");

      print("<div class=\"contents\">");

      require("../includes/menu.inc");

      print("<div class=\"main\">");

      print("<div class=\"mainblock\">");



// begin mainblock

?>

   <h1>Interne partners <?= tp_roepnaam($tp_basisgegevens) ?></h1>



<?= $print ?>





<p>Hieronder zie je de interne (vaste) partners van je project.<br/>

<p>Je kan partners toevoegen door de organisatie te selecteren uit de lijst<br />

en dan op de bijhorende knop te klikken. <br />

Verwijderen doe je door op het rode kruisje te klikken.</p>



<form method="post" name="f">



<?php

  toonZoekOrganisatie("f", "", " and organisatie.id <> 13", "");

?>



<br/>            <input type="button" value="voeg bovenstaande organisatie toe als partner" onclick="voegPartnerToe(document.f.organisatie.value)" />



<p>De lijst met organisaties die je hier onder ziet, wordt pas definitief opgeslagen

<br />wanneer je op de "opslaan"-knop klikt.

</p>



<table class="form" id="form">

<tr>

  <td class="label">Partner 1: </td>

  <td class="input">GDT LISTEL vzw</td>

</tr>

<?php



for ($i=0; $i<mysql_num_rows($resultPartners); $i++) {

  $rijPartner = mysql_fetch_assoc($resultPartners);

  $nr = $i+2;

  echo <<< EINDE

<tr>

  <td class="label">Partner $nr: </td>

  <td class="input"><input type="hidden" name="partner[$nr]" value="{$rijPartner['id']}"/><img src="../images/wis.gif" onclick="verwijderPartner($nr)"/>{$rijPartner['naam']}</td>

</tr>

EINDE;

}



?>

<tr>

  <td class="label">Gegevens: </td>

  <td class="input"><input type="submit" value="opslaan" /></td>

</tr>

</table>

</form>

<?php



// einde mainblock



      print("</div>");

      print("</div>");

      print("</div>");

      require("../includes/dbclose.inc");

      require("../includes/footer.inc");

      print("</div>");

      print("</div>");

      print("</body>");

      print("</html>");

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>