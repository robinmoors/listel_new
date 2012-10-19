<?php

    //----------------------------------------------------------

    /* Maak Dbconnectie */ require('../includes/dbconnect2.inc');

    //----------------------------------------------------------



$paginanaam="Dossier wegschrijven in archief";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

{

    require("../includes/html_html.inc");

    print("<head>");

    require("../includes/html_head.inc");

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

    print ("<h1>Lijst gearchiveerde zorgplannen</h1>");

?>

<!-- Start FORMULIER -->

<form action="lijst_archief_02.php" method="post" name="archiefform">

   <fieldset>

      <div class="legende">Stopzetting lag tussen:</div>

      <div>&nbsp;</div>

      <div class="inputItem" id="IIStartjaar">

         <div class="label160">Startjaar&nbsp;: </div>

         <div class="waarde">

            <select size="1" name="startjaar" >

                    <option value="19910000">1991</option>

                    <option value="19920000">1992</option>

                    <option value="19930000">1993</option>

                    <option value="19940000">1994</option>

                    <option value="19950000">1995</option>

                    <option value="19960000">1996</option>

                    <option value="19970000">1997</option>

                    <option value="19980000">1998</option>

                    <option value="19990000">1999</option>

                    <option value="20000000">2000</option>

                    <option value="20010000">2001</option>

                    <option value="20020000">2002</option>

                    <option value="20030000">2003</option>

                    <option value="20040000">2004</option>

                    <option value="20050000">2005</option>

                    <option value="20060000">2006</option>

                    <option value="20070000">2007</option>

                    <option value="20080000">2008</option>

                    <option value="20090000">2009</option>

                    <option value="20100000">2010</option>

                    <option value="20110000">2011</option>

<?php

  for ($i = 12; $i < 99; $i++)

    print("                <option value=\"20$i0000\">20$i</option>\n");

?>

            </select>

         </div> 

      </div><!--pat_startjaar-->

      <div class="inputItem" id="IIEindjaar">

         <div class="label160">Eindjaar&nbsp;: </div>

         <div class="waarde">

            <select size="1" name="eindjaar" >

                    <option value="19919999">1991</option>

                    <option value="19929999">1992</option>

                    <option value="19939999">1993</option>

                    <option value="19949999">1994</option>

                    <option value="19959999">1995</option>

                    <option value="19969999">1996</option>

                    <option value="19979999">1997</option>

                    <option value="19989999">1998</option>

                    <option value="19999999">1999</option>

                    <option value="20009999">2000</option>

                    <option value="20019999">2001</option>

                    <option value="20029999">2002</option>

                    <option value="20039999">2003</option>

                    <option value="20049999">2004</option>

                    <option value="20059999">2005</option>

                    <option value="20069999">2006</option>

                    <option value="20079999">2007</option>

                    <option value="20089999">2008</option>

                    <option value="20099999">2009</option>

                    <option value="20109999">2010</option>

                    <option value="20119999">2011</option>

<?php

  for ($i = 12; $i < 99; $i++)

    print("                <option value=\"20" . "{$i}9999\">20" . "$i</option>\n");

?>

                    <option value="20999999" selected="selected">2099</option>

            </select>

         </div> 

      </div><!--pat_eindjaar-->

    </fieldset>

    <fieldset>

        <div class="inputItem" id="IIButton">

         <div class="label220">Dossier &nbsp;</div>

         <div class="waarde">

         <input type="submit" value="openen" name="action" />

         </div> 

      </div><!--action-->

   </fieldset>

</form>

<?php

                

    //---------------------------------------------------------

    /* Sluit Dbconnectie */ require("../includes/dbclose.inc");

    //---------------------------------------------------------



    print("</div>");

    print("</div>");

    print("</div>");

    require("../includes/footer.inc");

    print("</div>");

    print("</div>");

    print("</body>");

    print("</html>");

    }



//---------------------------------------------------------

/* Geen Toegang */ require("../includes/check_access.inc");

//---------------------------------------------------------

?>