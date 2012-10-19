<?php

session_start();

$paginanaam="Teamoverleggen aanvullen met geld_voor_hvl";



if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    



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



//include("../includes/toonSessie.inc");



function doeOverleg($overlegID) {

// is er geld voor de hulpverleners

$qry="

    SELECT

        count(bl.persoon_id)

    FROM

        afgeronde_betrokkenen bl,

        hulpverleners h,

        functies f,

        functiegroepen fg

    WHERE
        bl.overleggenre = 'gewoon' AND
        bl.overleg_id = $overlegID AND

        bl.genre = 'hulp' AND

        bl.persoon_id=h.id AND

        h.fnct_id=f.id AND

        f.groep_id=fg.id AND

        fg.id=2 AND

        bl.aanwezig=1

   GROUP BY

         h.fnct_id

        ";



$result=mysql_query($qry);

$aantal_zvl=mysql_num_rows($result);



  if ($aantal_zvl < 4)

    $geldVoorHVL = 1;

  else

    $geldVoorHVL = 0;



//---------------------------------------------------------

// Zet de geld_voor_hvl op

$qry1="

    UPDATE overleg

    SET  geld_voor_hvl = $geldVoorHVL

    WHERE id  = $overlegID";

//print($qry1);

if (!$result1=mysql_query($qry1))    {

  print("<h1>begot: $qry1 lukt niet <br>" . mysql_error() . "</h1>");

}

else {

  print("<p><li>Overleg $overlegID heeft als geld_voor_hvl $geldVoorHVL </li></p>");

}



}



$afgerondeOverleggen = mysql_query("select id from overleg where afgerond = 1");

for ($i=0; $i<mysql_num_rows($afgerondeOverleggen); $i++) {

  $overleg = mysql_fetch_array($afgerondeOverleggen);

  doeOverleg($overleg['id']);

}





    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    print("</div>");

    print("</div>");

    print("</div>");

    include("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>