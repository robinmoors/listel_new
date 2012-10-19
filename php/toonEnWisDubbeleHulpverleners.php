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
   require("../includes/clearSessie.inc");

   $paginanaam="Af te ronden overleggen";


   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

      {

      require("../includes/html_html.inc");

      print("<head>");

      require("../includes/html_head.inc");
?>
<script type="text/javascript">
function wis(oud, nieuw) {
  if (!confirm('Bent u zeker dat u deze wil wissen?')) return false;
       var url = "wisHulpverlener.php?rand=" + parseInt(Math.random()*999999)
                  + "&oud=" + oud + "&nieuw=" + nieuw;
       var http = createREQ();

       // de call-back functie
       http.onreadystatechange = function() {
         if (http.readyState == 4) {
           if (http.responseText.indexOf("OK")>-1) {
              document.getElementById('div'+oud).style.visibility = "hidden";
           }
           else {
             alert("Probleem " + http.responseText);
           }
         }
       }

       // en nu nog de request uitsturen
       http.open("GET", url);
       http.send(null);
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




  $qry = "select hulpverleners.*, organisatie.naam as orgnaam
          from hulpverleners, organisatie

          where organisatie = organisatie.id

          AND fnct_id = {$_GET['functie_id']}

          AND hulpverleners.actief <> 0
          AND hulpverleners.id <> {$_GET['id']}";



$hvls = mysql_query($qry) or die($qry . "<br/>" . mysql_error());





if (mysql_num_rows($hvls)==0) die(""); // geen hvls

$aantal = 0;



for ($i=0; $i<mysql_num_rows($hvls); $i++) {

  $rijHVL = mysql_fetch_assoc($hvls);

  similar_text(strtoupper($rijHVL['voornaam']),strtoupper($_GET['voornaam']), $voor);

  similar_text(strtoupper($rijHVL['naam']),strtoupper($_GET['naam']), $achter);

  $nabij = round(($voor + $achter*2)/3,2);



  if ($nabij > 70) {

     $hvl[$aantal] = $rijHVL;

     $hvl[$aantal]['nabij'] = $nabij;

     $aantal++;

  }

}



if ($aantal == 0) die("Er zijn g&eacute;&eacute;n hulpverleners met soortgelijke eigenschappen.");  // geen gelijkenissen



uksort($hvl, "gelijkenis");

?>



<p>Deze "nieuwe" zorg- of hulpverlener (<strong><?= "{$_GET['naam']} {$_GET['voornaam']}" ?></strong>)

gelijkt sterk op volgende al bestaande zorg- en hulpverlener(s):

</p>



<p>Klik op een van deze mensen als je deze wil gebruiken, of bevestig onderaan

dat dit een &eacute;cht nieuwe zorg- of hulpverlener is.</p>



<table>

<tr><th>Wis</th><th>Gelijkenis</th><th style='text-align:left; padding-left: 10px;'>Persoon</th><th>Functie en organisatie</th></tr>



<?php



foreach ($hvl as $mens) {


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

    print("<tr id=\"div{$mens['id']}\"><td><img src=\"../images/wis.gif\" alt=\"wis\"  style=\"border: 0px;\" onclick=\"wis({$mens['id']},{$_GET['id']});\" /></td>
               <td style='text-align:center'>{$mens['nabij']}%</td>
               <td><strong style=\"border-bottom: dashed 1px;\" onclick=\"vertoon('subdiv{$mens['id']}');\">{$mens['naam']} {$mens['voornaam']}</strong><br/>
                           Loginstatus: {$mens['validatiestatus']}  <br/>
                           <div style=\"display:none\" id=\"subdiv{$mens['id']}\">Login: {$mens['login']}<br/>
                                                                      {$mens['email']}<br/>
                                                                      {$mens['adres']}<br/>
                                                                      {$mens['tel']} - {$mens['gsm']}<br/></div></td>

               <td>$kenmerk <strong></strong></td></tr>\n");

}

?>

</table>




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