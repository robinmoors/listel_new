<?php

//----------------------------------------------------------

/* Maak Dbconnectie */ include('../includes/dbconnect2.inc');

//----------------------------------------------------------



/*********************************************

           rizivtarieven

           thuis        elders                registratie

gewoon     773172       773216                773290

PVS        776532       776554                776576



           niet-        wel-

           ziekenhuis   ziekenhuis            niet-ZH   wel-ZH

TP         427350       427361                427372     427383



**********************************************/



   $paginanaam="Riziv-tarieven";



   if (isset($_SESSION["toegang"])&&($_SESSION["toegang"]=="toegestaan") && ($_SESSION['profiel']=="listel")){



      

      include("../includes/html_html.inc");



      print("<head>");



      include("../includes/html_head.inc");

      include("../includes/bevestigdel.inc");

?>

<style type="text/css">

#overzicht td {

  text-align: center;

  font-size: 11px;

}

th {

  text-align: center;

  font-size: 10px;

}

</style>



<?

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





     if (isset($_POST['datum1'])) {

       $qry = "insert into riziv_tarieven (datum, thuis, elders, registratie, thuisPVS, eldersPVS, registratiePVS, zhTP, nietzhTP, registratie_zhTP, registratie_nietzhTP, omb, registratieomb, organisatie, actief) values('{$_POST['datum3']}{$_POST['datum2']}{$_POST['datum1']}',{$_POST['t1']},{$_POST['t2']},{$_POST['t3']},{$_POST['t4']},{$_POST['t5']},{$_POST['t6']},{$_POST['t9']},{$_POST['t7']},{$_POST['t10']},{$_POST['t8']},{$_POST['omb']},{$_POST['ombregistratie']},{$_POST['organisatie']},1)";

       if (mysql_query($qry)) {

         print("<span style='background-color: #8f8'>Riziv-tarief succesvol toegevoegd.</span>");

       }

       else {

         print("<span style='background-color: #f88'>Riziv-tarief NIET kunnen toevoegen.$qry" .  mysql_error(). "</span>");

       }

     }

     else if (isset($_GET['verwijder'])) {

       if (mysql_query("update riziv_tarieven set actief = 0 where datum = '{$_GET['verwijder']}'")) {

         print("<span style='background-color: #8f8'>Riziv-tarief succesvol verwijderd</span>");

       }

       else {

         print("<span style='background-color: #f88'>Riziv-tarief NIET kunnen verwijderen.</span>");

       }

     }



?>

     <form method="post" action="lijst_rizivtarieven.php">

       <table>

         <tr>

						<td>&nbsp;</td><td>Datum</td><td width="200"><input type="text" style="width: 22px;" name="datum1" />/<input type="text"  style="width: 22px;" name="datum2" />/<input type="text"  style="width: 42px;" name="datum3" /></td></tr>

		     <tr><td rowspan="3">GDT</td><td>Thuis 773172</td><td><input type="text" style="width: 80px;" name="t1" /></td></tr>

				 <tr>	    <td>Elders 773216</td><td><input type="text" style="width: 80px;" name="t2" /></td></tr>

				 <tr>	    <td>Registr. 773290</td><td><input type="text" style="width: 80px;" name="t3" /></td></tr>

         <tr><td colspan="3" width="100%" style="border-bottom: 1px dashed black;"></td></tr>

         <tr><td rowspan="3">PVS</td>	    <td>Thuis 776532<br/> of deskundig ziekenhuis </td><td><input type="text" style="width: 80px;" name="t4" /></td></tr>

				 <tr>	    <td>Elders 776554</td><td><input type="text" style="width: 80px;" name="t5" /></td></tr>

				 <tr>	    <td>Registr. 776576</td><td><input type="text" style="width: 80px;" name="t6" /></td></tr>

         <tr><td colspan="3" width="100%" style="border-bottom: 1px dashed black;"></td></tr>

				 <tr><td rowspan="2">TP<br/>niet ziekenhuis</td>	    <td>Overleg 427350</td><td><input type="text" style="width: 80px;" name="t7" /></td></tr>

				 <tr>	    <td>Registr. 427372</td><td><input type="text" style="width: 80px;" name="t8" /></td></tr>

         <tr><td colspan="3" width="100%" style="border-bottom: 1px dashed black;"></td></tr>

				 <tr><td rowspan="2">TP<br/>wel ziekenhuis</td>	    <td>Overleg 427361</td><td><input type="text" style="width: 80px;" name="t9" /></td></tr>

				 <tr>	    <td>Registr. 427383</td><td><input type="text" style="width: 80px;" name="t10" /></td></tr>



         <tr><td colspan="3" width="100%" style="border-bottom: 1px dashed black;"></td></tr>

		     <tr><td rowspan="2">OMB</td><td>ZVL, HVL, XVLP</td><td><input type="text" style="width: 80px;" name="omb" /></td></tr>

				 <tr>	    <td>Registratie</td><td><input type="text" style="width: 80px;" name="ombregistratie" /></td></tr>
				 <tr>	    <td colspan="2">Organisatie van het overleg</td><td><input type="text" style="width: 80px;" name="organisatie" /></td></tr>



          <tr><th colspan="3"><input type="submit" value="nieuw tarief opslaan" /></th></tr>

       </table>

     </form>





      <h1>Lijst Riziv-tarieven</h1>

				 <table class="klein" id="overzicht">

          <tr>

          <th>&nbsp;</th>

          <th>&nbsp;</th>

          <th colspan="3">GDT</th>

          <th colspan="3">PVS</th>

          <th colspan="2">TP<br/> niet-ziekenhuis</th>

          <th colspan="2">TP<br/> Ziekenhuis</th>

          <th colspan="2">OMB</th>

          </tr>

					<tr>

						<th>Wis</th>

						<th>Datum</th>

					    <th>Thuis <br/>773172</th>

					    <th>Elders <br/>773216</th>

					    <th>Registr. <br/>773290</th>

					    <th>Thuis <br/>776532</th>

					    <th>Elders <br/>776554</th>

					    <th>Registr. <br/>776576</th>

					    <th>Overleg <br/>427350</th>

					    <th>Registr. <br/>427372</th>

					    <th>Overleg <br/>427361</th>

					    <th>Registr. <br/>427383</th>

					    <th>..VL</th>

					    <th>Reg.</th>
					    <th>Orga<br/>nisatie</th>

					</tr>

					

<?php

      $query = "

            SELECT

                *

            FROM

                riziv_tarieven

            WHERE

               actief <> 0

         ORDER BY datum desc";









      if ($result = mysql_query($query) ){

         for ($i=0; $i < mysql_num_rows($result); $i++){

            $records= mysql_fetch_array($result);



			//print_r($records);

        print("

            <tr>

               <td>

					<a href=\"lijst_rizivtarieven.php?verwijder={$records['datum']}\" onclick=\"return confirm('Bent u zeker dat u dit tarief wil verwijderen?');\"><img src='../images/wis.gif' alt='wis' style='border: 0px;'></a>

			   </td>

               <td>{$records['datum']}</td>

               <td>{$records['thuis']}</td>

               <td>{$records['elders']}</td>

               <td>{$records['registratie']}</td>

               <td>{$records['thuisPVS']}</td>

               <td>{$records['eldersPVS']}</td>

               <td>{$records['registratiePVS']}</td>

               <td>{$records['nietzhTP']}</td>

               <td>{$records['registratie_nietzhTP']}</td>

               <td>{$records['zhTP']}</td>

               <td>{$records['registratie_zhTP']}</td>

               <td>{$records['omb']}</td>

               <td>{$records['registratieomb']}</td>
               <td>{$records['organisatie']}</td>

            </tr>");

            }

            print("</table>");

         }







      else{

         

         print ("Er werden geen records gevonden <br /><br />");

         print(mysql_error());

		 print($query);

         }



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

/* Sluit Dbconnectie */ include("../includes/dbclose.inc");

//---------------------------------------------------------





//---------------------------------------------------------

/* Geen Toegang */ include("../includes/check_access.inc");

//---------------------------------------------------------

?>