<?php



/* oud stuk om eventueel alleen vraag voor Katz te versturen

  if (isset($_GET['alleenKatz']) || isset($_SESSION['alleenKatz'])) {

    $_SESSION['alleenKatz'] = $_GET['alleenKatz'];

    $tekst = "Katz";

  }

  else {

    $tekst = "Katz en evaluatie-instrument";

  }

*/

$tekst = "Katz en evaluatie-instrument";







    // toon formulier om email-uitverkorene te mailen

    $query = "

        SELECT

            h.naam as h_naam,

            voornaam,

            email,

            f.naam as f_naam

        FROM

            hulpverleners h,

            functies f,

            huidige_betrokkenen bl,

            organisatie org



        WHERE
            bl.overleggenre = 'gewoon' AND
            bl.organisatie = org.id AND

            org.genre = 'ZVL' AND

            h.fnct_id=f.id  AND

            h.id = bl.persoon_id AND

            bl.betrokhvl_patient_code = '{$_SESSION['pat_code']}' AND

            h.email > \"\"

        ORDER BY

             h.naam,h.voornaam";

// was groep = 2

    $resultZVL = mysql_query($query);

    if (mysql_num_rows($resultZVL) == 0) {

        print("<!-- Geen enkele van de zorgverleners heeft een emailadres. -->");

    }

    else {

?>

  <script type="text/javascript">

     var mailDoel = "";

     function doeMail() {

        alert("moet ajax worden");

     }

  </script>

   <br />Stuur mail i.v.m. <?php print($tekst); ?> naar

   <select name="emailid" size="1" onChange="mailDoel=this.value;doeMail()">

      <option value="">niemand</option>

<?php

          for ($i=0; $i < mysql_num_rows($resultZVL); $i++) {

              $zvl = mysql_fetch_array($resultZVL);

              print("<option value=\"{$zvl['hvl_email']}\">{$zvl['hvl_naam']} {$zvl['hvl_voornaam']}</option>\n");

          }

?>

   </select>

<?php

    }

  }

  else {

    print("de emailquery $alGemaildQuery is fout");

  }





