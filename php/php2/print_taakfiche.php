<?php
session_start();
$paginanaam="Taakfiches";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
    {
 

    //----------------------------------------------------------
    /* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
    //----------------------------------------------------------
	
	if ($_GET['overleg_id'])
		$_SESSION['overleg_id'] = $_GET['overleg_id'];

	$overlegID = $_SESSION['overleg_id'];
	
	//---------------------------------------------------------
	/* TAAKFICHES */ include("../includes/taakfiches.php");
	//---------------------------------------------------------

    $overleginfo=mysql_fetch_array(mysql_query("SELECT overleg_datum,overleg_type FROM  overleg WHERE overleg_id=".$_GET['overleg_id']));
    include("../includes/html_html.inc");
    print("<head>");
    include("../includes/html_head.inc");
    ?>
    <style type="text/css">
      .rand{border-bottom:1px solid black;border-right:1px solid black;}
      .randtable{border-top:1px solid black;border-left:1px solid black;}
    </style>
    </head>
    <body onLoad="parent.print()">
    <div align="center">
    <div class="pagina">
    <table bgcolor="#FFFFFF">

    <tr><td><p><br /></td></tr>

    <tr><td  colspan="2"><div style="text-align:center">
    <table width="100%"><tr><td><img src="../images/logo_top_pagina_klein" width="100"></td>
    <td><div align="center"><h2>TAAKFICHES bij het overleg van <?php print(substr($overleginfo[0],6,2)."/".substr($overleginfo[0],4,2)."/".substr($overleginfo[0],0,4));?></h2>
    <h2><?php echo  $_SESSION['pat_naam'] . ' ' . $_SESSION['pat_voornaam'] . ' (' . $_SESSION['pat_id'] . ')';?></h2></div></td></tr></table></div></td></tr>


    <tr><td><p><br /></td></tr>
    <tr>
      <td><?php 
            $taakfiche = getTaakFiche($overlegID);
    echo getVerantwoordelijken(1,$overlegID,$overleginfo['overleg_type']);
    echo getVerantwoordelijken(2,$overlegID,$overleginfo['overleg_type']);
    echo getVerantwoordelijken(3,$overlegID,$overleginfo['overleg_type']);
    echo getVerantwoordelijken(4,$overlegID,$overleginfo['overleg_type']);
    echo getVerantwoordelijken(5,$overlegID,$overleginfo['overleg_type']);
    echo getVerantwoordelijken(6,$overlegID,$overleginfo['overleg_type']); ?></td>
    </tr>
</table>
</div></div></body></html>
<?php
    }

//---------------------------------------------------------
/* Geen Toegang */ include("../includes/check_access.inc");
//---------------------------------------------------------
?>