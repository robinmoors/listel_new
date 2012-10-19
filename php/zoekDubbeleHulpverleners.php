<?php

// $_GET['naam'] en $_GET['voornaam']

session_start();



function gelijkenis($nr1, $nr2) {

  global $hvl;

  $pat1 = $hvl[$nr1];

  $pat2 = $hvl[$nr2];

  if ($pat1['nabij'] < $pat2['nabij'])

    return 1;

  else if ($pat1['nabij'] > $pat2['nabij'])

    return -1;

  else

    return 0;

}



   require("../includes/dbconnect2.inc");

   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {





  $qry = "select hulpverleners.*, organisatie.naam as orgnaam, functies.naam as functie

          from hulpverleners, organisatie, functies

          where organisatie = organisatie.id

          AND fnct_id = functies.id

          AND hulpverleners.actief <> 0";



$hvls = mysql_query($qry) or die($qry . "<br/>" . mysql_error());





if (mysql_num_rows($hvls)==0) die(""); // geen hvls

$aantal = 0;



for ($i=0; $i<mysql_num_rows($hvls); $i++) {

  $rijHVL = mysql_fetch_assoc($hvls);

  similar_text(strtoupper($rijHVL['voornaam']),strtoupper($_GET['voornaam']), $voor);

  similar_text(strtoupper($rijHVL['naam']),strtoupper($_GET['naam']), $achter);

  $nabij = round(($voor + $achter*2)/3,2);



  if ($nabij > 80) {

     $hvl[$aantal] = $rijHVL;

     $hvl[$aantal]['nabij'] = $nabij;

     $aantal++;

  }

}



if ($aantal == 0) die("");  // geen gelijkenissen



uksort($hvl, "gelijkenis");

?>



<p>Deze "nieuwe" zorg- of hulpverlener (<strong><?= "{$_GET['naam']} {$_GET['voornaam']}" ?></strong>)

gelijkt sterk op volgende al bestaande zorg- en hulpverlener(s):

</p>



<p>Klik op een van deze mensen als je deze wil gebruiken, of bevestig onderaan

dat dit een &eacute;cht nieuwe zorg- of hulpverlener is.</p>



<table>

<tr><th>Gelijkenis</th><th style='text-align:left; padding-left: 10px;'>Persoon</th><th>Functie en organisatie</th></tr>



<?php



foreach ($hvl as $mens) {

   // url nog aanpassen!

   if ((substr(strstr($mens['orgnaam'],"Zelfstandig"),0,11) == "Zelfstandig") || (substr(strstr($mens['orgnaam'],"NVT"),0,3) == "NVT")) {

     if ($mens['riziv1']>0) {

       $kenmerk = "Zelfstandig {$mens['functie']} met riziv {$mens['riziv1']}{$mens['riziv2']}{$mens['riziv3']}";

     }

     else {

       $kenmerk = "Zelfstandig {$mens['functie']} met rekening {$mens['iban']}";

     }

   }

   else {

     $kenmerk = "{$mens['functie']} van {$mens['orgnaam']}";

   }

    print("<tr><td style='text-align:center'>{$mens['nabij']}%</td>

               <td><strong><a href=\"edit_verlener.php?id={$mens['id']}&geenDubbelsZoeken=1&backpage={$_GET['backpage']}\">{$mens['naam']} {$mens['voornaam']}</a></strong></td>

               <td>$kenmerk <strong></strong></td></tr>\n");

}

?>

</table>



<p>Dit is een nieuwe <a href="#" onclick="verstop();return false;">zorg- of hulpverlener</a>. Ik ga verder met het invullen van dit formulier.

</p>

<?php

      }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------



//---------------------------------------------------------

/* Sluit Dbconnectie */ require("../includes/dbclose.inc");

//---------------------------------------------------------

?>