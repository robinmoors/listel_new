<?php

  if (isset($_GET['alleenKatz']) || isset($_SESSION['alleenKatz'])) {
    $_SESSION['alleenKatz'] = $_GET['alleenKatz'];
    $ookEval = false;
  }
  else if (is_tp_patient()) {
    $ookEval = false;
  }
  else {
    $ookEval = true;
  }
?>


  <script type="text/javascript">
     var mailDoel = "";
     var hvl_id = " ";
     function doeMail(genre) {
       //alert(mailDoel + "--" +hvl_id);

       if (hvl_id == " " || hvl_id == 0) return;

       var request = createREQ();

       var rand1 = parseInt(Math.random()*9);
       var rand2 = parseInt(Math.random()*999999);
       var url = "doe_email_versturen.php?hvl_id=" + hvl_id + "&adres=" + mailDoel + "&genre=" + genre;
       emailbestemming = "0|0";

       request.onreadystatechange = function() {
         if (request.readyState < 4) {
           document.getElementById('emailstatus').innerHTML = "email wordt verstuurd ....";
         }
         else {
           var result = request.responseText;
           //var spatie = 0;
           //while ((result.charAt(spatie) != 'O') && (result.charAt(spatie) != 'K') ) spatie++;
           //result = result.substring(spatie,result.length);

           if (result.indexOf("OK") >= 0) {
             document.getElementById('emailstatus').innerHTML =
                   "De email naar " + mailDoel + " is verstuurd!";
           }
           else {
             alert("Er is iets ambetant misgegaan, nl. " + result);
             document.getElementById('emailstatus').innerHTML = "email NIET verstuurd." + result;
           }
         }
      }

      // en nu nog de request uitsturen
      if (mailDoel != "") {
        request.open("GET", url);
        request.send(null);
      }
    }
var emailbestemming = "";
  </script>

 <?php

function toonEmailForm($result, $tekst, $genre) {
    if (mysql_num_rows($result) == 0) {
        print("<!-- Geen enkele van de zorgverleners heeft een emailadres. -->");
    }
    else {
    // toon formulier om email-uitverkorene te mailen
?>
   <li><p style="text-align:left">Stuur email i.v.m. <?php print($tekst); ?> <br/>
   <form>
   <select name="emailid" size="1"
           onchange="emailbestemming=this.value;">
      <option value="0|0">niemand</option>
<?php
          for ($i=0; $i < mysql_num_rows($result); $i++) {
              $zvl = mysql_fetch_array($result);

              if ($zvl['email'] != "") $email2 = $zvl['email'];
              else if (($zvl['org_email'] != "") && $zvl['org_id'] != 71) $email2 = $zvl['org_email'];
              else $email2 = "";
              if ($email2 != "")
                print("<option value=\"{$zvl['id']}|{$email2}\">{$zvl['hvl_naam']} {$zvl['voornaam']} -- {$zvl['fnct_naam']}</option>\n");
          }
?>
   </select>
   <input type="button" value="verstuur" onclick="hvl_id = emailbestemming.substr(0,emailbestemming.indexOf('|')); mailDoel=emailbestemming.substr(emailbestemming.indexOf('|')+1);doeMail('<?= $genre ?>')" />
   </form>
   </p></li>
<?php
    }
}
/************ EINDE FUNCTIE toonEmailForm *****************/

    $query = "
        SELECT
            h.naam as hvl_naam,
            h.voornaam,
            h.email,
            f.naam as fnct_naam,
            h.id,
            org.email_inhoudelijk as org_email,
            org.id as org_id
        FROM
            functies f,
            huidige_betrokkenen bl,
            hulpverleners h left join organisatie org on (h.organisatie = org.id)
        WHERE
            bl.overleggenre = 'gewoon' AND
            (f.id = 1 or f.id = 17) AND
            h.fnct_id=f.id  AND
            h.id = bl.persoon_id AND
            bl.genre = 'hulp' AND
            bl.patient_code = \"{$_SESSION['pat_code']}\" AND
            (h.email <> \"\"   OR org.email_inhoudelijk <> \"\")
        ORDER BY
             h.naam,h.voornaam";



    if ($ookEval) {
       $resultKatzMensen = mysql_query($query);
       toonEmailForm($resultKatzMensen, "KATZ &eacute;n evaluatie-instrument naar huisarts of verpleegkundige", "beide");
    }
    
    $resultKatzMensen = mysql_query($query);
    toonEmailForm($resultKatzMensen, "KATZ naar huisarts of verpleegkundige", "katz");

    if ($ookEval) {

      $query = "
        SELECT
            h.naam as hvl_naam,
            h.voornaam,
            h.email,
            f.naam as fnct_naam,
            h.id,
            org.email_inhoudelijk as org_email,
            org.id as org_id
        FROM
            functies f,
            huidige_betrokkenen bl,
            hulpverleners h left join organisatie org on (h.organisatie = org.id)
        WHERE
            bl.overleggenre = 'gewoon' AND
            h.fnct_id=f.id  AND
            h.id = bl.persoon_id AND
            bl.genre = 'hulp' AND
            bl.patient_code = \"{$_SESSION['pat_code']}\" AND
            (h.email <> \"\"   OR org.email_inhoudelijk <> \"\")
        ORDER BY
             h.naam,h.voornaam";

      $resultZVL = mysql_query($query);
      toonEmailForm($resultZVL, "evaluatie-instrument naar een zorg- of hulpverlener", "evaluatie");
    }

?>
   <div id="emailstatus" style="height:24px;"></div>

