

<form  method="post" action="<?= $action ?>" name="hvlform" class="select_vl" autocomplete="off">

   <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />
   <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

   <fieldset>

      <div class="legende">Hulpverleners</div>

      <div>&nbsp;</div>


<table>
<tr>
<td>
            <div class="label160">Naam hulpverlener&nbsp;: </div>
</td>
<td>
         <div class="waarde">

            <input  id="hierbeginnen" class="invoer" style="margin-left: -7px;" tabindex="1"

                   onKeyUp="refreshListHash('hvlform','IIHvl','hvl_id',1,'IIHvlS',hvlList,50,zvlHash)"

                   onmouseUp="showCombo('IIHvlS',100)" onfocus="showCombo('IIHvlS',100)" type="text" name="IIHvl" value="">

            <input type="button" onClick="resetList('hvlform','IIHvl','hvl_id',1,'IIHvlS',hvlList,999,100)" value="<<">

         </div>
</td>
</tr>
</table>

      <div class="inputItem" id="IIHvlS">

         <div class="label160">Kies eventueel&nbsp;:</div>

         <div class="waarde">

            <select class="invoer" tabindex="2"

            onblur="handleSelectClick('hvlform','IIHvl','hvl_id',1,'IIHvlS')"

            onclick="handleSelectClick('hvlform','IIHvl','hvl_id',1,'IIHvlS')" name="hvl_id" size="5">

            </select>

         </div>

      </div><!--Naam hulpverlener -->

      <div class="label160">Deze hulpverlener&nbsp;:</div>

      <div class="waarde">

         <input type="submit" tabindex="3" value="toevoegen">&nbsp;

         <input type="button" tabindex="4" value="of een nieuwe maken" onclick="javascript:document.location='edit_verlener.php?a_backpage=<?= $backpage ?>'">

      </div><!--Button toevoegen -->

   </fieldset>

</form>

<script type="text/javascript">

    hideCombo('IIHvlS');

    document.getElementById('hierbeginnen').focus();

</script>