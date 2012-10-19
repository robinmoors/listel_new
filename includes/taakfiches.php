<div><?php

if (!(isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))) {

	echo "Ongeldige bewerking";

	exit;

}



// verwacht variabele $refID

if (substr($refID, 0, 7) == "overleg") {

  $ref = " dit overleg";

  if (!isset($readOnly))

     print("<p><strong>Taakfiches voor {$_SESSION['pat_naam']} {$_SESSION['pat_voornaam']} - {$_SESSION['pat_code']}</strong><br /></p>");

}

else

  $ref = " deze evaluatie";





  // toon een korte beschrijving van alle taakfiches

  $res = mysql_query("select * from taakfiche where ref_id = '$refID' order by categorie");

  if (mysql_num_rows($res) == 0) {

    print("<p>Er werden (nog) geen taakafspraken ingevuld voor $ref.</p>");

  }

  else {

    print("<table class=\"taakfiche\"><tr><th>Domein</th><th>Taakafspraak</th></tr>\n");

    for ($i=0; $i< mysql_num_rows($res); $i++) {

      $taak = mysql_fetch_array($res);

      print("<tr><td>{$taak['categorie']}</td><td>" . substr($taak['taak'], 0, 48) . "...</td>");

      if (isset($readOnly))

        print("<td><a href=\"taakfiche_bewerken.php?overlegID=$overlegID&id={$taak['id']}&readOnly=1&refID=$refID\">Bekijk</a></td></tr>\n");

      else

        print("<td><a href=\"taakfiche_bewerken.php?overlegID=$overlegID&id={$taak['id']}&refID=$refID\">Bewerk</a>

                   of <a href=\"taakfiche_bewerken.php?wis=1&overlegID=$overlegID&id={$taak['id']}&refID=$refID\"

                           onClick=\"return confirm('Bent u zeker dat u deze taakfiche wil wissen?');\">wis</a>

        </td></tr>\n");

    }

    print("</table>\n");

  }

  



if (!isset($readOnly)) {





?>

<p> <br /><strong>

U kan hier <a href="taakfiche_bewerken.php?overlegID=<?= $overlegID ?>&refID=<?= $refID ?>">taken toevoegen</a>.</li>

</strong></p>



<?php

}

?>



</div>