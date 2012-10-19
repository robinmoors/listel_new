<!-- Start Formulier -->

    <form  method="post" action="<?= $action ?>" name="zorgplanform"  class="select_vl" autocomplete="off">

      <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />
      <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

      <fieldset>

       <table>

         <tr>

          <td class="legende" colspan="2">

            Gegevens Mantelzorger:

          </td>

         </tr>

         

         <tr>

          <td class="label160">

             Naam :

          </td>

          <td class="waarde">

             <input type="text" size="35" value="" name="mzorg_naam" />

          </td>

         </tr>



         <tr>

          <td class="label160">

             Voornaam :

          </td>

          <td class="waarde">

             <input type="text" size="35" value="" name="mzorg_voornaam" />

          </td>

         </tr>



         <tr>

          <td class="label160">

             Verwantschap :

          </td>

          <td class="waarde">

            &nbsp;<select size="1" name="mzorg_verwsch_id" />

<?php

//----------------------------------------------------------

// Vul Input select element vanuit dbase



      $query = "

         SELECT

            *

         FROM

            verwantschap

         where

            actief = 1

         ORDER BY

            naam";



      if ($result=mysql_query($query))

         {

         for ($i=0; $i < mysql_num_rows ($result); $i++)

            {

            $records= mysql_fetch_array($result);

            print ("

               <option value=\"".$records[0]."\">".$records[1]."</option>\n");

            }

         }

//----------------------------------------------------------

?>

            </select>

          </td>

         </tr>



         <tr>

          <td class="label160">

             Telefoon :

          </td>

          <td class="waarde">

             <input type="text" size="35" value="" name="mzorg_tel" />

          </td>

         </tr>



         <tr>

          <td class="label160">

              GSM :

          </td>

          <td class="waarde">

             <input type="text" size="35" value="" name="mzorg_gsm" />

          </td>

         </tr>



         <tr>

          <td class="label160">

              Adres :

          </td>

          <td class="waarde">

             <input type="text" size="35" value="" name="mzorg_adres" />

          </td>

         </tr>



         <tr id="IIPostCode">

          <td class="label160">

              Postcode :

          </td>

          <td class="waarde">

                <input onKeyUp="refreshList('zorgplanform','postCodeInput','mzorg_gem_id',1,'IIPostCodeS',gemeenteList,20)"

                onmouseUp="showCombo('IIPostCodeS',100)" onFocus="showCombo('IIPostCodeS',100)" type="text"

                name="postCodeInput" value="" style="width: 160px" />

                <input type="button"

                onClick="resetList('zorgplanform','postCodeInput','mzorg_gem_id',1,'IIPostCodeS',gemeenteList,20,100)"

                value="<<">

          </td>

         </tr>

      </table>

      

      <table>

        <tr class="inputItem" id="IIPostCodeS">

            <td class="label160">Kies eventueel&nbsp;:</td>

            <td class="waarde">

                <select onClick="handleSelectClick('zorgplanform','postCodeInput','mzorg_gem_id',1,'IIPostCodeS')"

                name="mzorg_gem_id" size="5">

                </select>

            </td>

        </tr><!--Postcode -->

      </table>



      <table>

        <tr>

          <td class="label160">

              E-mail :

          </td>

          <td class="waarde">

             <input type="text" size="35" value="" name="mzorg_email" />

          </td>

         </tr>



        <tr>

          <td class="label160">

              Deze mantelzorger

          </td>

          <td class="waarde">

            <input type="submit" value="toevoegen">

          </td>

         </tr>



       </table>

      </fieldset>

    </form>

<!-- Einde Formulier -->

<script type="text/javascript">document.forms['zorgplanform'].elements['mzorg_naam'].focus();</script>