<?php

session_start();

$paginanaam="Toestemmingsformulier voor het bespreken en verwerken van persoonlijke gegevens in therapeutisch project";

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

    <div class="pagina">

    <table width="570">

    <tr><td><img src="../images/logo_top_pagina_klein.gif" width="100" height="100"/></td>



<?php



// krijgt $_GET['code']

$qryPatient = "select * from patient, patient_tp where patient = code and patient = '{$_GET['code']}'";

$patientInfo = mysql_fetch_assoc(mysql_query($qryPatient));











?>

<td >

<h1 style="background-color: #BBB; width:500px;font-size:18px;">Toestemmingsformulier voor het bespreken en verwerken van persoonlijke gegevens <br/>

Patient <?= patient_roepnaam($_GET['code']) ?>

</h1>

</td>

</tr>





<tr>

<td colspan="2">



<p> Om ervoor te zorgen dat je op ieder moment de best mogelijke zorg ontvangt, is soms een overleg nodig tussen de hulpverleners van verschillende organisaties. Met dit formulier vragen we je schriftelijke toestemming

voor de bespreking en verwerking van je persoonlijke gegevens op een overleg in het kader van een therapeutische project.

Het overleg zal meermaals (ongeveer &eacute;&eacute;nmaal per trimester) doorgaan.  Jouw naam wordt vermeld op de verslaggeving. Op het overleg worden hulpverleners van volgende  organisaties uitgenodigd:

</p>



<?php

     $qryPartners = "select organisatie.naam from huidige_betrokkenen , organisatie

                     where overleggenre = 'gewoon' AND huidige_betrokkenen.genre = 'org' and persoon_id = organisatie.id and patient_code = '{$_GET['code']}'";

     $resultPartners = mysql_query($qryPartners) or die($qryPartners . mysql_error());

     $partners = "";

     for ($j = 0; $j < mysql_num_rows($resultPartners); $j++) {

        $rijPartner = mysql_fetch_assoc($resultPartners);

        $partners .= "<span style='margin-left: 10px;'>{$rijPartner['naam']} </span>";

     }

     $partners .= "<span style='margin-left: 10px;'>GDT LISTEL</span><br/>";

?>

<p><?="$partners"?></p>



<p>GDT LISTEL vzw zal ook in contact komen met uw gegevens om de partners die aan het overleg deelnemen, te kunnen vergoeden.

</p>



<p>Indien op een volgend overleg de aanwezigheid van andere organisaties wenselijk is, vragen we u hiervoor mondeling om toestemming.

<br/>

Uw gegevens worden opgenomen in een geautomatiseerd register.

</p>



<p>Voorwaarden<br/>

Op een overleg in het kader van het Therapeutisch Project worden enkel persoonlijke gegevens uitgewisseld die noodzakelijk zijn voor een goed overleg en in jouw belang.

<br/>De deelnemers aan het overleg zijn gebonden door het beroepsgeheim.

</p>



<p style="font-size:10px;">

De door u verstrekte gegevens zullen door LISTEL vzw met zetel te 3500 Hasselt, Rodenbachstraat 29/1, worden verwerkt.

Zij zullen uitsluitend worden gebruikt voor registratie van  uw dossier.

Overeenkomstig de wet van 8 december 1992, zoals gewijzigd, kan u steeds om mededeling en verbetering vragen van de u betreffende verwerkingen.

Ondergetekende pati&euml;nt of zijn vertegenwoordiger geeft toestemming om de op het elektronische invulformulier

vermelde persoonsgegevens op het beveiligde gedeelte van de website van LISTEL vzw te plaatsen in het kader van cli&euml;ntenregistratie.

</p>



<p>Toestemming

<br/><br/>

Ik, .......................................................(Naam en voornaam cli&euml;nt of vertegenwoordiger) <br/>

geef toestemming om dit overleg te organiseren en persoonlijke gegevens te bespreken en te verwerken.

<br/>

<br/>

</p>



<table>

<tr>

<td style="width: 250px; text-align:right;">

Handtekening cli&euml;nt of vertegenwoordiger

</td>

<td style="width: 250px; text-align:right;">

             	   Datum ondertekening

</td>

</tr>

<tr>

<td style="width: 250px; text-align:right;">

<br/><br/>....................................

</td>

<td style="width: 250px; text-align:right;">

<br/><br/>....................................

</td>

</tr>

</table>





<br/><br/><br/>

<hr />



<p><em>

Naam betrokken hulpverlener: ....................................

<br/><br />Voorziening: ....................................

<br/><br />Telefoon: ....................................

<br/><br />E-mail: ....................................

</em>

</p>



</td>

</tr>











</table>

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