<?php
session_start();
$paginanaam="Contactpersonen aanduiden";
if (IsSet($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan"))
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect.inc');
//----------------------------------------------------------
    {
    include ('../includes/html_html.inc');
    print("<head>");
    include("../includes/html_head.inc");
    print("</head>");
    print("<body>");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");
    include("../includes/header.inc");
    include("../includes/pat_id.inc");
    print("<div class=\"contents\">");
    include("../includes/menu.inc");
    print("<div class=\"main\">");
    print("<div class=\"mainblock\">");
    if (!isset($action)) // $action niet gezet dus formulier weergeven
        {
        //---------------------------------------------------------------------------
        /* Toon form contactpersonen selecteren */ include('../forms/select_contact_twee.php');
        //---------------------------------------------------------------------------
        }
    else
        {
        //---------------------------------------------------------
        $doesql=mysql_query("
        UPDATE betroklijsthvl 
        SET betrokhvl_contact = 0,betrokhvl_zb = 0 
        WHERE betrokhvl_pat_nr = '".$_SESSION['pat_nr']."';");
        $doesql=mysql_query("
        UPDATE betroklijstmz 
        SET betrokmz_contact = 0 
        WHERE betrokmz_pat_nr = '".$_SESSION['pat_nr']."';");
        $doesql=mysql_query("
        UPDATE betroklijstoc 
        SET betrokoc_contact = 0
        WHERE betrokoc_pat_nr = '".$_SESSION['pat_nr']."';");

        $doesql=mysql_query("
        UPDATE betroklijsthvl 
        SET betrokhvl_contact = 1 
        WHERE betrokhvl_id = {$_POST['betrokhvl_id']}
        AND betrokhvl_pat_nr = {$_SESSION['pat_nr']};");
        $doesql=mysql_query("
        UPDATE betroklijstmz 
        SET betrokmz_contact = 1 
        WHERE betrokmz_id = {$_POST['betrokmz_id']}
        AND betrokmz_pat_nr = {$_SESSION['pat_nr']};");
        $doesql=mysql_query("
        UPDATE betroklijstoc 
        SET betrokoc_contact = 1 
        WHERE betrokoc_id = {$_POST['betrokoc_id']}
        AND betrokoc_pat_nr = {$_SESSION['pat_nr']};");
        if($_POST['zb_id']<>"00"){
          $doesql=mysql_query("
          UPDATE betroklijsthvl
          SET betrokhvl_zb = 1
          WHERE betrokhvl_id = {$_POST['zb_id']}
          AND betrokhvl_pat_nr = {$_SESSION['pat_nr']};");
        }
        // Opslaan gegevens contactpersonen
        $categorie=substr($_POST['pat_aanmelder_id'],0,1);
        $id= substr($_POST['pat_aanmelder_id'],1,strlen($_POST['pat_aanmelder_id']));
        $doesql=mysql_query("
            UPDATE patienten 
            SET 
                pat_aanmelder_id = ".$id.",
                pat_aanmelder_categorie='".$categorie."' 
            WHERE pat_nr = '".$_SESSION['pat_nr']."';");
        // Opslaan gegevens aanmelder
        //---------------------------------------------------------
        //---------------------------------------------------------
        print("
            <script>
                function redirect()
                    {
                    document.location = \"overleg.php\";
                    }
                setTimeout(\"redirect()\",0);
             </script>"); // Redirect to next page
        //---------------------------------------------------------
        }

    //---------------------------------------------------------
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