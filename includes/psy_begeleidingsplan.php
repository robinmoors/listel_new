<style type="text/css">
.planTabel table {
  border: 1px solid;
  border-collapse: collapse;
}
.planTabel tr {
  border: 1px dotted;
}
</style>
<form id="BegeleidingsplanForm">

<p style="text-align:left;">
<strong>Gegevens van belang voor verdere zorg- en hulpverlening</strong>  in algemene termen
(bijvoorbeeld: beschrijving van de hulpverleningsgeschiedenis in algemene termen,
de persoonlijke zorgbehoefte en de sociale situatie van de pati&euml;nt).
</p>
<textarea id="psy_algemeen" name="psy_algemeen" style="width:500px;"><?= $overlegInfo['psy_algemeen']?></textarea>
<p style="text-align:left;">
De algemene <strong>doelstellingen</strong> die met de pati&euml;nt nagestreefd worden.
</p>
<textarea id="psy_doelstellingen" name="psy_doelstellingen" style="width:500px;"><?= $overlegInfo['psy_doelstellingen']?></textarea> <br/>&nbsp;<br/>
<br/>
Noteer hier de taakafspraken voor de verschillende domeinen. <br/>Gebruik ctrl-klik voor meervoudige selectie van Actienemers.
<?php

if ($overlegInfo['psy_algemeen']=="" || $overlegInfo['psy_doelstellingen']=="") {
  print("<script type=\"text/javascript\">var tekstvakkenBegeleidingsplan = false;</script>\n");
}
else {
  print("<script type=\"text/javascript\">var tekstvakkenBegeleidingsplan = true;</script>\n");
}


  print("<script type=\"text/javascript\">var nietAllesIngevuldOpBegeleidingsplan = false;</script>\n");
  if ($overlegID > 0) {
    toonBegeleidingsplanVolledig($overlegID, $overlegInfo['afgerond']);
    if (heeftGGZTaak($overlegID)) {
      print("<script type=\"text/javascript\">var ggzHeeftTaak = true;</script>");
    }
    else {
      print("<script type=\"text/javascript\">var ggzHeeftTaak = false;</script>");
    }
    if (aantalDomeinen($overlegID)>=3) {
      print("<script type=\"text/javascript\">var genoegDomeinen = true;</script>");
    }
    else {
      print("<script type=\"text/javascript\">var genoegDomeinen = false;</script>");
    }
  }

  if (isset($_GET['code']) && isset($_GET['hvl_id'])) {
    print("<input type=\"hidden\" name=\"code\" value=\"{$_GET['code']}\"/>");
    print("<input type=\"hidden\" name=\"hvl_id\" value=\"{$_GET['hvl_id']}\"/>");
  }

?>
<div style="text-align:right">
Dit begeleidingsplan <input type="button" id="planOpslaan" value="opslaan" onclick="begeleidingsplanOpslaan('<?= $_SESSION['pat_code'] ?>',<?= $overlegID ?>);"/>
</div>
</form>

