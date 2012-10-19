<?php
session_start();
$paginanaam="Evaluatie afdrukken";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {

  // krijgt $_GET['id']

  //----------------------------------------------------------
  /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
  //----------------------------------------------------------

    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");

function toonEval($evaluatie) {
    ?>
    <style type="text/css">
      .rand{border-bottom:1px solid black;border-right:1px solid black;}
      .randtable{border-top:1px solid black;border-left:1px solid black;}
    </style>
    </head>

    <body onload="parent.print();<?= $verder ?>">
    <div align="center">
    <div class="pagina">

<?php

$datum = $evaluatie['datum'];
$dd = substr($datum, 6, 2);
$mm = substr($datum, 4, 2);
$jj = substr($datum, 0, 4);
echo <<< EINDE
  <h1>{$_SESSION['pat_naam']} {$_SESSION['pat_voornaam']} ({$_SESSION['pat_code']})</h1>
  <h2>De evaluatie van $dd/$mm/$jj</h2>
  <h4>({$evaluatie['locatie']})</h4>

EINDE;

  if ($evaluatie['genre'] == "patient") {
   $langeNaam = $_SESSION['pat_naam'] . ' ' . $_SESSION['pat_voornaam'];
  }
  else {
    if ($evaluatie['genre'] == "mantel") {
      $tabel = "mantelzorgers";
    }
    else if ($evaluatie['genre'] == "hulp") {
      $tabel = "hulpverleners";
    }
    else if ($evaluatie['genre'] == "orgpersoon") {
      $tabel = "hulpverleners";
    }
    else {
      $tabel = "logins";
    }
    $naampje = mysql_fetch_array(mysql_query("select concat(naam, concat(' ', voornaam))
                    from $tabel where id = {$evaluatie['uitvoerder_id']}"));
    $langeNaam = $naampje[0];
  }

?>

                   <table cellpadding="5" width="100%">
                   <tr>
                      <th class="even" width="30%">Uitvoerder </td>
                      <th class="even" width="10%">Katz-score </td>
                      <th class="even" width="60%">Voortgang  </td>
                   </tr>
                   <tr>
                      <td valign="top"><?= $langeNaam ?> </td>

<?php

if ($evaluatie['katz_id'] < 0) {
  $katzNr =  -$evaluatie['katz_id'] ;
}
else {
  $katzNr = $evaluatie['katz_id'];
}
            $sql="
                SELECT
                 *
                FROM
                    katz
                WHERE
                    id = $katzNr";

//print($sql);

if (isset($evaluatie['katz_id']) && ($result=mysql_query($sql))) {
  $katz = mysql_fetch_array($result);
  print("<td valign=\"top\">{$katz['totaal']}\n");

}
//else if ($_GET['katz'] != "") {
//  print("<tr><td valign=\"top\"><p><strong>Katz-score</strong></p></td><td valign=\"top\"><p>{$_GET['katz']}<br />(overgenomen van voorgaand overleg)</p></td></tr>");
//}
else {
  print("<td valign=\"top\">niet ingevuld");
}
?>

</td>
<td valign="top"><?= $evaluatie['vooruitgang'] ?></td>
</tr>

</table>
</div></div>
<?php
}


$evaluatieQry = "select * from evaluatie where patient = '{$_SESSION['pat_code']}' order by datum desc";
$evaluatieResult = mysql_query($evaluatieQry);
for ($i=0; $i<mysql_num_rows($evaluatieResult); $i++) {
  $evaluatie = mysql_fetch_assoc($evaluatieResult);
  toonEval($evaluatie);
}

?>

</body></html>
<?php
    }

//---------------------------------------------------------
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>