<?php
//----------------------------------------------------------
/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');
//----------------------------------------------------------

$paginanaam="Lijst alle deelnemers";



if ( isset($_SESSION["toegang"]) && ($_SESSION["toegang"]=="toegestaan") ){
    
    include("../includes/html_html.inc");

    print("<head>");

    include("../includes/html_head.inc");
    include("../includes/bevestigdel.inc");

    print("<script type=\"text/javascript\">");

//----------------------------------------------------------
    $query = "
        SELECT
            h.id,
            h.naam,
            h.voornaam,
            f.naam  as f_naam,
            organisatie.genre
        FROM
            hulpverleners h left join organisatie on h.organisatie = organisatie.id ,
            functies f
        WHERE
        h.fnct_id = f.id and
			 h.actief <> 0
        ORDER BY
             h.naam, h.voornaam;";



        print ("var zvlHash = Array();//zvlHash init voor ongevulde letters \n");
        $zoek1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i=0; $i < 26; $i++) {
          $letter = substr($zoek1, 0, 1);
          print("zvlHash['$letter'] = 0;\n");
          $zoek1 = substr($zoek1,1);
        }
        $zoek = "BCDEFGHIJKLMNOPQRSTUVWXYZ_";
        $letter = "A";

        print ("var zvlList = Array(");

      if ($result=mysql_query($query)){
         
         for ($i=0; $i < mysql_num_rows ($result); $i++){
            
				   $records= mysql_fetch_array($result);
				   print ("\"".$records[1]." ".$records[2]."  -  ".$records['genre']. " - " . $records[3]."\",\"".$records[0]."\",\n");

           if ($letter==substr($records['naam'],0,1)) {
              $hash .= "zvlHash['$letter'] = $i;\n";
              $letter = substr($zoek,0,1);
              $zoek = substr($zoek,1);
           }

          }
      }

		 //else{print(mysql_error());}

        print ("\"9999 onbekend\",\"9999\");\n"); // ZorgverlenersLijst opvullen
        print ($hash);

//----------------------------------------------------------

    print("function hide(){
            document.getElementById('IIZvlS').style.display=\"none\";}");
    print("</script>");
    print("</head>");
    print("<body onload=\"hide()\">");
    print("<div align=\"center\">");
    print("<div class=\"pagina\">");

    include("../includes/header.inc");
    include("../includes/kruimelpad.inc");

    print("<div class=\"contents\">");

    include("../includes/menu.inc");

    print("<div class=\"main\">");
    print("<div class=\"mainblock\">");
    print ("<h1>Lijst deelnemers</h1>")

// --------------------------------------------------------
// Snelkeuze form

?>
   <fieldset>


      <div class="legende">Alle deelnemers</div>

      <div>&nbsp;</div>

      <div class="inputItem" id="IIZorgverlener">

         <div class="label160">Naam deelnemer&nbsp;: </div>

         <div class="waarde">
		 
		 <form autocomplete="off" action="edit_verlener.php?a_backpage=lijst_alledeelnemers.php" method="post" name="zvlform">

            <input class="invoer" onKeyUp="refreshListHash('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,50,zvlHash )" onmouseUp="showCombo('IIZvlS',100)" onfocus="showCombo('IIZvlS',100)" type="text" name="IIZvl" value="" />

            <input type="button" onClick="resetList('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,999,100)" value="<<">

         </div>
      </div>

      <div class="inputItem" id="IIZvlS">

         <div class="label160">Kies eventueel&nbsp;:</div>

         <div class="waarde">

            <select class="invoer" onClick="handleSelectClick('zvlform','IIZvl','hvl_id',1,'IIZvlS')" name="hvl_id" size="5">
            </select>

         </div>

      </div><!--Naam zorgverlener -->



      <div class="label160">Deze deelnemer&nbsp;:</div>
      <div class="waarde">
         <input type="hidden" name="a_backpage" value="lijst_alledeelnemers.php" />
         <input type="hidden" name="readonly" value="0" />
         <input type="submit" value="Bekijken" onClick="document.zvlform.wis.value=0;document.zvlform.readonly.value=1;" />&nbsp;
       </div><!--Button aanpassen -->

      <div class="label160">Deze deelnemer&nbsp;:</div>
      <div class="waarde">
         <input type="hidden" name="a_backpage" value="lijst_alledeelnemers.php" />
         <input type="submit" value="Aanpassen" onClick="document.zvlform.wis.value=0;document.zvlform.readonly.value=0;" />&nbsp;
       </div><!--Button aanpassen -->


       <div class="label160">Deze deelnemer&nbsp;:</div>
      <div class="waarde">
        <input type="hidden" name="wis" value="0" />
        <input type="submit" value="Op non-actief zetten" onClick="var ok = confirm('Ben je zeker dat je op non-actief wil zetten?');if (ok) document.zvlform.wis.value=1; else return false;" />&nbsp;</form>
      </div><!--Button verwijderen -->


       <div class="label160">Een deelnemer&nbsp;:</div>
      <div class="waarde">
        <form action="edit_verlener.php?a_backpage=lijst_alledeelnemers.php" method="post" name="formulier"><input type="submit" value="Toevoegen">&nbsp;</form>
      </div><!--Button toevoegen -->


   </fieldset>

<?php


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
/* Sluit Dbconnectie */ require("../includes/dbclose.inc");
//---------------------------------------------------------

//---------------------------------------------------------
/* Geen Toegang */ require("../includes/check_access.inc");
//---------------------------------------------------------
?>