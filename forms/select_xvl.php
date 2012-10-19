<form  method="post" action="<?= $action ?>" name="andereform"  class="select_vl"  autocomplete="off">

   <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />
   <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

   <fieldset>

      <div class="legende"><?= $titel ?></div>

      <div>&nbsp;</div>
<table>
<tr>
<td>
            <div class="label160">Naam&nbsp;: </div>
</td>
<td>

            <input  id="hierbeginnen" tabindex="1" class="invoer"

            onKeyUp="refreshListHash('andereform','IIAndere','hvl_id',1,'IIAndereS',andereList,50,zvlHash)"

            onmouseUp="showCombo('IIAndereS',100)" onfocus="showCombo('IIAndereS',100)" type="text" name="IIAndere" value="" />

            <input type="button" onClick="resetList('andereform','IIAndere','hvl_id',1,'IIAndereS',andereList,999,100)" value="<<" />



</td>
</tr>
</table>
<table>
<tr id="IIAndereS">
<td>
         <div class="label160">Kies eventueel&nbsp;:</div>
</td>
<td>
         <div class="waarde">

            <select class="invoer" style="margin-left: -7px;" tabindex="2"

            onBlur="handleSelectClick('andereform','IIAndere','hvl_id',1,'IIAndereS')"

            onClick="handleSelectClick('andereform','IIAndere','hvl_id',1,'IIAndereS')" name="hvl_id" size="5">

            </select>

         </div>

</td>
</tr>
</table>

      <div class="inputItem" id="IIbutton">

        <div class="label160">Deze persoon&nbsp;:</div>

        <div class="waarde">

            <input type="submit" tabindex="3" name="action" value="toevoegen">&nbsp;

            <input type="button" tabindex="4" value="of een nieuwe maken"

            onclick="javascript:document.location='edit_verlener.php?a_backpage=<?= $thisPage ?><?= $beperking ?>'">

        </div>

      </div><!--Button toevoegen -->

   </fieldset>

</form>

<script type="text/javascript">

    hideCombo('IIAndereS');

    document.getElementById('hierbeginnen').focus();

</script>

