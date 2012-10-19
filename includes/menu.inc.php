<?php


if (!isset($_SESSION["profiel"])) {    //ingelogd via code

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">
<!--
        <ul>

                <li><a target="_blank "href="../evaluatieInstrumentHandleiding.pdf">Handleiding bij <br />

                het evaluatieinstrument</a></li>

        </ul>

        <hr />
-->
        Blanco documenten:

        <ul>
                <li><a target="_blank" href="/nl/files/ftp/KATZ-score.pdf">KATZ formulier</a></li>
                <li><a target="_blank" href="/nl/files/ftp/Evaluatie-instrument.pdf">Evaluatie-instrument</a></li>
                <li><a target="_blank" href="/nl/files/ftp/VerklaringHuisarts.pdf">Verklaring Huisarts</a></li>
                <li><a target="_blank" href="../html/omb_blanco_oc.html">Blanco registratieformulier<br/>ouderenmis(be)handeling</a></li>
        </ul>

    </div>

    </div>

</div>

<?php

}
else if ($_SESSION["profiel"]=="ziekenhuis") {  // ingelogd als ziekenhuis-mens
?>
<div class="navigation">
    <div class="navigationblock">
    <div class="bulletmenu">
        <ul>
            <li><a href="welkom.php">Zoek pati&euml;nt op</a></li>
            <li><a href="aanvraag_overleg.php">Doe aanvraag voor overleg</a></li>
        </ul>
        <hr />
        <ul>
            <li>Paswoordbeheer</li>
            <ul>
                <li><a href="chpw.php">Verander uw paswoord</a></li>
               <li><a href="uitloggen.php">Uitloggen</a></li>
            </ul>
        </ul>
    </div>
    </div>
</div>

<?php
}
else if ($_SESSION["profiel"]=="listel") {  // ingelogd als listel-mens

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>

            <li><a href="welkom.php">Home</a></li>
            <li><a href="aanvraag_overleg_overzicht.php">Overzicht aanvragen</a></li>
            <li><a href="aanvraag_overleg.php">Doe aanvraag voor overleg</a></li>
            <li>Pati&euml;ntenfiches</li>

            <ul>

                <li><a href="lijst_patienten.php">Overzicht pati&euml;nten</a></li>
                <li><a href="patient_overname_goedkeuren.php">Over te dragen pati&euml;nten</a></li>
            </ul>

            <li>Zorgplannen</li>

            <ul>
                <li><a href="select_zplan.php?a_next_php=patientoverzicht.php">Inhoud zorgplan</a></li>
                <li><a href="zorgenplannen_overzicht.php">Overzicht</a></li>
                <li><a href="zorgenplannen_per_organisatie.php">Zoek per organisatie</a></li>
                <li><a href="lijst_archief_01.php">Archief raadplegen</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Zoekfuncties</li>

            <ul>

                <li><a href="lijst_partners.php">Organisaties</a></li>

                <li><a href="lijst_alledeelnemers.php">Alle deelnemers</a></li>

                <li><a href="lijst_zorgverleners.php">Zorgverleners</a></li>

                <li><a href="lijst_hulpverleners.php">Hulpverleners GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlp">Hulpverleners niet-GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlnp">Niet-professionelen</a></li>
                <li><a href="lijst_geregistreerden.php">Geregistreerde gebruikers</a></li>

                <li><a href="lijst_functies.php">Disciplines</a></li>

                <li><a href="lijst_mutualiteiten.php">Verzekeringsinstellingen</a></li>

                <li><a href="lijst_burgstaat.php">Burgerlijke staat</a></li>

                <li><a href="lijst_verwantschap.php">Verwantschap</a></li>

                <li><a href="lijst_overlegcoord.php">octgz-ocmw</a></li>
                <li><a href="lijst_overlegcoord.php?rdc=1">octgz-rdc</a></li>
                <li><a href="lijst_overlegcoord.php?za=1">octgz-za</a></li>


            		<li><a href="lijst_overlegcoord.php?listel=1">Listelco&ouml;rdinatoren</a></li>

                <li><a href="lijst_sitkoppelingen.php">POPkoppelingen</a></li>

                <li><a href="lijst_rizivtarieven.php">Riziv-tarieven</a></li>

                <li><a href="buitenland.php">Buitenland toevoegen</a></li>

                <li><a href="stats_opvragen.php">Statistieken</a></li>

				<!-- <li><a href="gem_koppeling.php">Gemeentekoppelingen</a></li> -->

            </ul>

        </ul>

        <hr />

        <ul><li>Werk ivm Gewoon overleg</li>

            <ul><li><a href="lijst_controles.php">Controles</a></li>

              <li><a href="lijst_facturenGDT.php">Facturen GDT</a></li>
              <li><a href="lijst_facturen_organisatie.php">Uittreksel voor organisatie</a></li>
            </ul>
        </ul>

        <ul><li>Werk ivm TP</li>

            <ul><li><a href="lijst_controlesTP.php">Controles TP</a></li>

              <li><a href="lijst_facturenTP.php">Facturen TP</a></li>

              <li><a href="lijst_tp_afdrukken.php">TP In- en exclusies</a></li>

              <li><a href="lijst_controlesTP.php?soort=ForK">Controles For-K</a></li>

              <li><a href="lijst_facturenTP_ForK.php">Facturen For-K</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Fouten herstellen</li>

            <ul>

                <li><a href="update_zorgenplannummer_form.php">Zorgplannr aanpassen</a></li>

                <li><a href="overleg_heropenen_overzicht.php">Overleg heropenen</a></li>

                <li><a href="controle_heropenen_overzicht.php">Controle heropenen</a></li>

                <li><a href="controle_na_factuur.php">Controle n&agrave; factuur</a></li>

                <li><a href="maakCreditNota.php">Maak een credit-nota</a></li>

            </ul>

         </ul>

        <hr />

        <ul>

            <li>Paswoordbeheer</li>

            <ul>

                <li><a href="chpw.php">Verander uw paswoord</a></li>

               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

        <hr />

        <ul>
            <li>Psychiatrische pati&euml;nten</li>
            <ul>
            		<li><a href="lijst_overlegcoord.php?psy=1">Overlegco&ouml;rdinatoren</a></li>
            </ul>
        </ul>


        <hr />

        <ul>
            <li>Therapeutische projecten</li>
            <ul>
                <li><a href="tp_nieuw.php">Opstart</a></li>
            		<li><a href="lijst_overlegcoord.php?tp=1">Projectco&ouml;rdinatoren</a></li>
            		<li><a href="lijst_tp.php">Lijst TP</a></li>
            </ul>
        </ul>

        <hr />

        <ul>
            <li>Menos</li>
            <ul>
                <li><a href="lijst_overlegcoord.php?menos=1">Projectco&ouml;rdinatoren</a></li>
            </ul>
        </ul>
        <ul>
            <li>Ziekenhuizen</li>
            <ul>
                <li><a href="lijst_overlegcoord.php?ziekenhuis=1">Ziekenhuislogins</a></li>
                <li><a href="stats_ziekenhuis_opzoekingen_opvragen.php">Logs van opzoekingen</a></li>
            </ul>
        </ul>

        <hr />
        <ul>

            <li>Ouderenmis(be)handeling</li>

            <ul>

                <li><a href="omb_registratie.php">Nieuwe registratie</a></li>

                <li><a href="omb_lijst.php">Bestaande registraties</a></li>

                <li><a href="omb_lijst_ZP.php">Zorgplannen met OMB</a></li>

                <li><a target="blank" href="../html/omb_blanco.html">Blanco formulier</a></li>

                <li><a href="lijst_facturen_omb.php">Overzicht uittreksels</a></li>

                <li><a href="omb_extra_vergoedbare.php">Extra vergoedingen</a></li>

                <li><a href="omb_tijden_verslag.php">Tijdsbesteding door Listel</a></li>

            		<li><a href="lijst_overlegcoord.php?caw=1">CAW logins</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

  }
else if ($_SESSION['profiel']=="menos") {

    // menos

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>
            <li><a href="welkom.php">Home</a></li>
            <li><a href="aanvraag_overleg.php">Doe aanvraag voor overleg</a></li>
            <li>Pati&euml;ntenfiches</li>
            <ul>
                <li><a href="patient_nieuw.php">Nieuw of overnemen</a></li>
                <li><a href="select_zplan.php?a_next_php=patient_aanpassen.php">Gegevens aanpassen</a></li>
                <li><a href="select_zplan.php?a_next_php=patient_menos_vragen.php">Gegevens ivm Menos</a></li>
                <li><a href="lijst_patienten.php">Overzicht pati&euml;nten</a></li>
                <li><a href="select_zplan.php?a_next_php=zorgteam_bewerken.php">Zorgteam bewerken</a></li>
            </ul>

            <li>MENOS Interventies</li>
            <ul>
                <li><a href="select_zplan.php?a_next_php=menos_interventie.php">Registreren</a></li>
                <li><a href="select_zplan.php?a_next_php=menos_interventie_wissen.php">Aanpassen/wissen</a></li>
            </ul>
            <li>Zorgplannen</li>
            <ul>
                <li><a href="select_zplan.php?a_next_php=patientoverzicht.php">Inhoud zorgplan</a></li>
                <li><a href="zorgenplannen_overzicht.php">Overzicht</a></li>
                <li><a href="select_zplan.php?a_next_php=naar_archief_menos.php">Stopzetten</a></li>
                <li><a href="lijst_archief_menos.php">Archief raadplegen</a></li>
            </ul>
            <li>Brievenbus</li>
            <ul>
                <li><a href="select_zplan.php?a_next_php=bericht_maken.php">Bericht maken</a></li>
                <li><a href="berichten.php">Berichten lezen</a></li>
            </ul>
        </ul>

        <hr />
        <ul>
            <li>Ouderenmis(be)handeling</li>
            <ul>
                <li><a href="omb_registratie.php">Nieuwe registratie</a></li>
                <li><a href="omb_lijst.php">Bestaande registraties</a></li>
                <li><a target="_blank" href="../html/omb_blanco_oc.html">Blanco registratieformulier<br/>ouderenmis(be)handeling</a></li>
            </ul>
        </ul>
        <hr />

        <ul>

            <li>Zoekfuncties</li>

            <ul>

                <li><a href="lijst_partners.php">Organisaties</a></li>

                <li><a href="lijst_alledeelnemers.php">Alle deelnemers</a></li>

                <li><a href="lijst_zorgverleners.php">Zorgverleners</a></li>

                <li><a href="lijst_hulpverleners.php">Hulpverleners GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlp">Hulpverleners niet-GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlnp">Niet-professionelen</a></li>

                <li><a href="buitenland.php">Buitenland toevoegen</a></li>

                <li><a href="stats_menos_opvragen.php">Statistieken</a></li>

            </ul>

        </ul>
        <hr />

        <ul>

            <li>Paswoordbeheer</li>

            <ul>

                <li><a href="chpw.php">Verander uw paswoord</a></li>

               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

  }
else if ($_SESSION["isOrganisator"] == 1 && $_SESSION['profiel']!="hoofdproject" && $_SESSION['profiel']!="bijkomend project") {

?>
<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>

            <li><a href="welkom.php">Home</a></li>
            <li><a href="aanvraag_overleg.php">Doe aanvraag voor overleg</a></li>
            <li>Pati&euml;ntenfiches</li>

            <ul>

<!--
                <li><a href="aanvraag_overleg.php?vervolg=patient_nieuw">Nieuwe pati&euml;nt</a></li>
-->
                <li><a href="patient_nieuw.php">Nieuw of overnemen</a></li>
                <li><a href="select_zplan.php?a_next_php=patient_aanpassen.php"><!--Pati&euml;nt-->Gegevens aanpassen</a></li>

                <li><a href="lijst_patienten.php">Overzicht pati&euml;nten</a></li>

                <li><a href="select_zplan.php?a_next_php=zorgteam_bewerken.php">Zorgteam bewerken</a></li>
                <li><a href="patient_overname_goedkeuren.php">Over te dragen pati&euml;nten</a></li>
            </ul>

            <li>Overleg</li>

            <ul>

                <li><a href="aanvraag_overleg.php?vervolg=overleg">Nieuw overleg</a></li>
<!--
                <li><a href="select_zplan.php?actie=nieuw">Nieuw overleg</a></li>
-->
                <li><a href="select_zplan.php?actie=bewerken">Bewerken</a></li>

                <li><a href="select_zplan.php?actie=afsluiten">Afronden</a></li>

                <li><a href="select_zplan.php?actie=wissen">Verwijderen</a></li>

            </ul>

            <li>Evaluaties</li>

            <ul>

                <li><a href="select_zplan.php?a_next_php=fill_evaluatie_01.php">Evaluatie registreren</a></li>

                <li><a href="select_zplan.php?a_next_php=wis_evaluatie.php">Evaluatie wissen</a></li>

            </ul>

            <li>Zorgplannen</li>

            <ul>

                <li><a href="afteronden.php">Af te ronden overleggen</a></li>

                <li><a href="select_zplan.php?a_next_php=patientoverzicht.php">Inhoud zorgplan</a></li>

                <li><a href="zorgenplannen_overzicht.php">Overzicht</a></li>
                <li><a href="zorgenplannen_per_organisatie.php">Zoek per organisatie</a></li>
                <li><a href="select_zplan.php?a_next_php=naar_archief_01.php">Stopzetten</a></li>

                <li><a href="lijst_archief_01.php">Archief raadplegen</a></li>

            </ul>

            <li>Brievenbus</li>
            <ul>
                <li><a href="select_zplan.php?a_next_php=bericht_maken.php">Bericht maken</a></li>
                <li><a href="berichten.php">Berichten lezen</a></li>
            </ul>


        </ul>


        <hr />

        <ul>

            <li>Ouderenmis(be)handeling</li>

            <ul>

                <li><a href="omb_registratie.php">Nieuwe registratie</a></li>

                <li><a href="omb_lijst.php">Bestaande registraties</a></li>

                <li><a href="omb_lijst_ZP.php">Zorgplannen met OMB</a></li>

                <li><a target="_blank" href="../html/omb_blanco_oc.html">Blanco formulier</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Blanco formulieren</li>
        <ul>
                <li><a target="_blank" href="/nl/files/ftp/VerklaringOrganisatorMVO.pdf">Verklaring organisator</a></li>
                <li><a target="_blank" href="/nl/files/ftp/KATZ-score.pdf">KATZ formulier</a></li>
                <li><a target="_blank" href="/nl/files/ftp/Evaluatie-instrument.pdf">Evaluatie-instrument</a></li>
                <li><a target="_blank" href="/nl/files/ftp/VerklaringHuisarts.pdf">Verklaring Huisarts</a></li>
               <li><a target="_blank" href="/html/Convenant GDT LISTEL vzw 2010.pdf">Convenant GDT (.pdf)</a></li>
            </ul>
        </ul>

        <hr />

        <ul>

            <li>Zoekfuncties</li>

            <ul>

                <li><a href="lijst_partners.php">Organisaties</a></li>

                <li><a href="lijst_alledeelnemers.php">Alle deelnemers</a></li>

                <li><a href="lijst_zorgverleners.php">Zorgverleners</a></li>

                <li><a href="lijst_hulpverleners.php">Hulpverleners GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlp">Hulpverleners niet-GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlnp">Niet-professionelen</a></li>

                <li><a href="buitenland.php">Buitenland toevoegen</a></li>
                <li><a href="stats_opvragen.php">Statistieken</a></li>

            </ul>

        </ul>
        <hr />

        <ul>

            <li>Paswoordbeheer</li>

            <ul>
<?php
if ($_SESSION['profiel']=="hulp") {
?>
                 <li><a href="edit_verlener.php?id=<?= $_SESSION['usersid'] ?>">Beheer je gegevens</a></li>
<?php
}
?>
                <li><a href="chpw.php">Verander uw paswoord</a></li>

               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

  }
else if ($_SESSION["profiel"] ==  "caw") {

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>

            <li><a href="welkom.php">Home</a></li>
            <li><a href="aanvraag_overleg.php">Doe aanvraag voor overleg</a></li>
        </ul>

        <hr />


        <ul>

            <li>Ouderenmis(be)handeling</li>

            <ul>

                <li><a href="omb_registratie.php">Nieuwe registratie</a></li>

                <li><a href="omb_lijst.php">Bestaande registraties</a></li>

                <li><a target="_blank" href="../html/omb_blanco.html">Blanco registratieformulier<br/>ouderenmis(be)handeling</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Paswoordbeheer</li>

            <ul>

                <li><a href="chpw.php">Verander uw paswoord</a></li>

               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

}
else if ($_SESSION["profiel"]=="hulp" && $_SESSION['validatieStatus']=="gevalideerd") {  // ingelogd als hulpverlener

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>

            <li><a href="welkom.php">Home</a></li>
            <li><a href="aanvraag_overleg.php">Doe aanvraag voor overleg</a></li>
            <li>Pati&euml;ntenfiches</li>

            <ul>

                <li><a href="lijst_patienten.php">Overzicht pati&euml;nten</a></li>

            </ul>

            <li>Zorgplannen</li>

            <ul>

                <li><a href="select_zplan.php?a_next_php=patientoverzicht.php">Inhoud zorgplan</a></li>

                <li><a href="zorgenplannen_overzicht.php">Overzicht</a></li>
<?php
  if ($_SESSION['isOrganisator'] == 1) {
?>
                <li><a href="zorgenplannen_per_organisatie.php">Zoek per organisatie</a></li>
<?php
  }
?>
                <li><a href="lijst_archief_01.php">Archief raadplegen</a></li>

            </ul>
            
            <li>Brievenbus</li>
            <ul>
                <li><a href="select_zplan.php?a_next_php=bericht_maken.php">Bericht maken</a></li>
                <li><a href="berichten.php">Berichten lezen</a></li>
            </ul>


            <li>Evaluaties van GDT</li>

            <ul>

                <li><a href="select_zplan.php?a_next_php=fill_evaluatie_01.php">Evaluatie registreren</a></li>

                <li><a href="select_zplan.php?a_next_php=wis_evaluatie.php">Evaluatie wissen</a></li>

            </ul>

<!-- Alleen wanneer deze persoon betrokken is bij menos -->
<?php
           if ($_SESSION['profiel']=="hulp") {
                 /*
                 $query2 = "SELECT distinct patient.*
                            FROM (patient left join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code)
                            WHERE (
                                    (genre = 'hulp' and persoon_id = {$_SESSION['usersid']} and rechten = 1)
                                    OR
                                    (patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']})
                                  )
                              AND $actief";
                 */
                 $query2 = "(SELECT distinct patient.* FROM (patient inner join huidige_betrokkenen on patient.code = huidige_betrokkenen.patient_code
                                                                          and patient.menos = 1
                                                                          and overleggenre = 'menos'
                                                                          and genre = 'hulp' and persoon_id = {$_SESSION['usersid']} ))
                            union
                            (select distinct * from patient where patient.toegewezen_genre = 'hulp' and patient.toegewezen_id = {$_SESSION['usersid']}
                                                                  and patient.actief = 1)";
                $menosLatenZien = (mysql_num_rows(mysql_query($query2))>0);
            }
            else {
              $menosLatenZien = true;
            }
            
  if ($menosLatenZien) {

?>
            <li>MENOS Interventies</li>
            <ul>
                <li><a href="select_zplan.php?a_next_php=menos_interventie.php">Registreren</a></li>
                <li><a href="select_zplan.php?a_next_php=menos_interventie_wissen.php">Aanpassen/wissen</a></li>
            </ul>

<?php
  }
?>
        </ul>

        <hr />

        <ul>

            <li>Zoekfuncties</li>

            <ul>

                <li><a href="lijst_partners.php">Organisaties</a></li>

            </ul>

        </ul>

        <hr />



        <ul>

            <li>Beheer</li>

            <ul>
               <li><a href="edit_verlener.php?id=<?= $_SESSION['usersid'] ?>">Beheer je gegevens</a></li>
               <li><a href="chpw.php">Verander uw paswoord</a></li>

               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

  }
else if (($_SESSION["profiel"]=="hulp") && $_SESSION['validatieStatus']=="halfweg") {  // ingelogd als hulpverlener

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>

            <li><a href="welkom.php">Home</a></li>

               <li><a href="edit_verlener.php?id=<?= $_SESSION['usersid'] ?>">Beheer je gegevens</a></li>
               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

  }
else {

    // therapeutisch project

?>

<div class="navigation">

    <div class="navigationblock">

    <div class="bulletmenu">

        <ul>

            <li><a href="welkom.php">Home</a></li>

            <li>Uw Therapeutisch project</li>

            <ul>

<?php

  if ($_SESSION['profiel'] == "hoofdproject") {

?>

                <li><a href="tp_projectgegevens.php">Projectgegevens</a></li>

                <li><a href="tp_projectvragen.php">Statistische vragen</a></li>

                <li><a href="lijst_overlegcoord.php?tp=1">Projectco&ouml;rdinatoren</a></li>

                <li><a href="tp_partnersbepalen.php">Interne partners</a></li>

                <li><a href="select_zplan.php?a_next_php=rechtenOC.php">Rechten OC</a></li>

<?php

  }

?>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Pati&euml;ntenfiches</li>

            <ul>

<?php

  if ($_SESSION['profiel'] == "hoofdproject") {

?>

                <li><a href="patient_nieuw.php">Nieuw of overnemen</a></li>

<?php

  }

?>

                 <li><a href="select_zplan.php?a_next_php=patient_aanpassen.php"><!--Pati&euml;nt-->Gegevens aanpassen</a></li>

                <li><a href="lijst_patienten.php">Overzicht pati&euml;nten</a></li>

                <li><a href="select_zplan.php?a_next_php=zorgteam_bewerken.php">Zorgteam bewerken</a></li>
                <li><a href="patient_overname_goedkeuren.php">Over te dragen pati&euml;nten</a></li>

            </ul>

            <li>Overleg</li>

            <ul>

                <li><a href="select_zplan.php?actie=nieuw">Nieuw overleg</a></li>
                <li><a href="select_zplan.php?actie=bewerken">Bewerken</a></li>

                <li><a href="select_zplan.php?actie=afsluiten">Afronden</a></li>

                <li><a href="select_zplan.php?actie=wissen">Verwijderen</a></li>

                <li><a href="select_zplan.php?actie=weigeren">Weigeren voor inclusie</a></li>

            </ul>

            <li>Evaluaties</li>

            <ul>

                <li><a href="select_zplan.php?a_next_php=fill_evaluatie_01.php">Evaluatie registreren</a></li>

                <li><a href="select_zplan.php?a_next_php=wis_evaluatie.php">Evaluatie wissen</a></li>

            </ul>

            <li>Zorgplannen</li>

            <ul>

                <li><a href="afteronden.php">Af te ronden overleggen</a></li>

                <li><a href="select_zplan.php?a_next_php=patientoverzicht.php">Inhoud zorgplan</a></li>

                <li><a href="zorgenplannen_overzicht.php">Overzicht</a></li>
                <li><a href="zorgenplannen_per_organisatie.php">Zoek per organisatie</a></li>

<?php

  if ($_SESSION['profiel'] == "hoofdproject") {

?>

                <li><a href="select_zplan.php?a_next_php=naar_archief_01.php">Stopzetten</a></li>

<?php

  }

?>

                <li><a href="lijst_archief_01.php">Archief raadplegen</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Ouderenmis(be)handeling</li>

            <ul>

                <li><a href="omb_registratie.php">Nieuwe registratie</a></li>

                <li><a href="omb_lijst.php">Bestaande registraties</a></li>

                <li><a href="omb_lijst_ZP.php">Zorgplannen met OMB</a></li>

                <li><a target="_blank" href="../html/omb_blanco_oc.html">Blanco registratieformulier<br/>ouderenmis(be)handeling</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Blanco formulieren</li>

            <ul>
                <li><a target="_blank" href="/nl/files/ftp/KATZ-score.pdf">KATZ formulier</a></li>

<!--

                <li><a target="_blank" href="/html/evaluatie_instrument_leeg.html">Evaluatie-instrument</a></li>

                <li><a target="_blank "href="../evaluatieInstrumentHandleiding.pdf">Handleiding bij <br />

                het evaluatieinstrument</a></li>

                <li><a target="_blank" href="/html/verklaring_huisarts.html">Verklaring Huisarts</a></li>

-->

               <li><a target="_blank" href="/html/Convenant GDT LISTEL vzw 2010.pdf">Convenant GDT (.pdf)</a></li>

            </ul>

        </ul>

        <hr />

        <ul>

            <li>Zoekfuncties</li>

            <ul>

                <li><a href="lijst_partners.php">Organisaties</a></li>

                <li><a href="lijst_alledeelnemers.php">Alle deelnemers</a></li>

                <li><a href="lijst_zorgverleners.php">Zorgverleners</a></li>

                <li><a href="lijst_hulpverleners.php">Hulpverleners GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlp">Hulpverleners niet-GDT</a></li>

                <li><a href="lijst_anderen.php?genre=xvlnp">Niet-professionelen</a></li>

                <li><a href="buitenland.php">Buitenland toevoegen</a></li>

                <li><a href="stats_TP_opvragen.php">Verslag RIZIV/FOD</a></li>

            </ul>

        </ul>
        <hr />

        <ul>

            <li>Paswoordbeheer</li>

            <ul>

                <li><a href="chpw.php">Verander uw paswoord</a></li>

               <li><a href="uitloggen.php">Uitloggen</a></li>

            </ul>

        </ul>

    </div>

    </div>

</div>

<?php

}
?>

<script type="text/javascript" src="../javascript/functies.js"></script>