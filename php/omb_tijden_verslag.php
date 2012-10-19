<?php
    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
	//----------------------------------------------------------
	
include("../includes/clearSessie.inc");

$paginanaam="OMB Tijdsbesteding door Listel";




if (isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") && ($_SESSION["profiel"]=="listel") ){
    
    $_SESSION['pat_code']="";
    $_SESSION['pat_naam']="";
    $_SESSION['pat_voornaam']="";

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

    print("</head>");
    print("<body>");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");

    include("../includes/header.inc");
    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");
    print("<div class=\"mainblock\">");


    if (!isset($_GET['maand'])) {
?>

<h3>Tijdsbesteding voor OMB</h3>
    
<p>Selecteer een maand uit een jaar</p>

<form method="get" action="omb_tijden_verslag.php" >
<select name="maand">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
</select>
<select name="jaar">
<?php
  for ($j=2008; $j <= date("Y"); $j++) {
    print("  <option>$j</option>\n");
  }
?>
</select>
<br/>
<input type="submit" value="Bekijk de tijdsbesteding" />
</form>


<?

}
else {

    print("<h3>Tijdsbesteding voor OMB tijdens {$_GET['maand']}/{$_GET['jaar']}</h3>\n");
    
    print("<ul>");

    $qry = "select * from omb_tijd where maand = {$_GET['maand']} and jaar = {$_GET['jaar']} and sec2 is not null";
    $result = mysql_query($qry) or die(mysql_error() . " dankzij $qry");

    for ($i=0; $i<mysql_num_rows($result); $i++) {
      $rij = mysql_fetch_assoc($result);
      print("<li>{$rij['dag']}/{$rij['maand']}/{$rij['jaar']} van {$rij['uur1']}u{$rij['min1']}:{$rij['sec1']} tot  {$rij['uur2']}u{$rij['min2']}:{$rij['sec2']}</li>\n");
      // optellen
      $secs = $rij['sec2'] - $rij['sec1'];
      $mins = $rij['min2'] - $rij['min1'];
      $uurs = $rij['uur2'] - $rij['uur1'];

      $totaalsec += $secs+ 60*$mins+ 3600*$uurs;
    }

    print("</ul>");
    $totaaluur = floor($totaalsec/3600);
    $totaalsec = $totaalsec%3600;
    
    $totaalmin = floor($totaalsec/60);
    $totaalsec = $totaalsec%60;

    print("<h3>Totale tijd: $totaaluur uur $totaalmin minuten $totaalsec seconden.</h3>");
    print("</div>");
    print("</div>");
    print("</div>");

    include("../includes/footer.inc");

    print("</div>");
    print("</div>");
    print("</body>");
    print("</html>");

    }
}

    //---------------------------------------------------------
    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");
    //---------------------------------------------------------

//---------------------------------------------------------
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>