<?php
ob_start();
session_start();

$paginanaam="zorgplan";

if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))

    {

    //----------------------------------------------------------

    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

    //----------------------------------------------------------

    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");

?>

    </head>

    <body onLoad="parent.print();">

    <div align="center">

    <div class="pagina">

    <table width="570">

    <tr><td colspan="3"><div class="hidden"><img src="../images/logo_top_pagina_zorgenplan.gif" width="600"></div></td></tr>

<?php



// krijgt $_GET['patient']





?>













</table>

</div>

</div>

</body>

</html>

<?php



    //---------------------------------------------------------

    /* Sluit Dbconnectie */ include("../includes/dbclose.inc");

    //---------------------------------------------------------

    }

//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------



?>