<form method="post" action="<?= $action ?>" name="zvlform" class="select_vl"  autocomplete="off">

    <input type="hidden" name="vanWaar" value="<?= $vanWaar ?>" />
    <input type="hidden" name="overleg" value="<?= $controleOverleg ?>" />

    <fieldset>

        <div class="legende">Zorgverleners</div>
        <div>&nbsp;</div>

<table>
<tr>
<td>
            <div class="label160">Naam zorgverlener&nbsp;: </div>
</td>
<td>
            <div class="waarde">
              <input id="hierbeginnen" class="invoer" style="margin-left: -7px;" tabindex="1"

                 onKeyUp="refreshListHash('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,50,zvlHash)"

                 onmouseUp="showCombo('IIZvlS',100)" onfocus="showCombo('IIZvlS',100)" type="text" name="IIZvl" value="" />

              <input type="button" onClick="resetList('zvlform','IIZvl','hvl_id',1,'IIZvlS',zvlList,999,100)" value="<<">

            </div>
        <div id="IIZorgverlener">


        </div>
</td>
</tr>
</table>


        <div class="inputItem" id="IIZvlS">

            <div class="label160">Kies eventueel&nbsp;:</div>

            <div class="waarde">

                <select class="invoer" tabindex="2"

                onBlur="handleSelectClick('zvlform','IIZvl','hvl_id',1,'IIZvlS')"

                onClick="handleSelectClick('zvlform','IIZvl','hvl_id',1,'IIZvlS')" name="hvl_id" size="5">

                </select>

            </div>

        </div><!--Naam zorgverlener-->

        <div class="label160">Deze zorgverlener&nbsp;:</div>

        <div class="waarde">

            <input type="submit" tabindex="3" value="toevoegen">&nbsp;

            <input type="button" tabindex="4" value="of een nieuwe maken"

            onClick="javascript:document.location='edit_verlener.php?a_backpage=<?= $backpage ?>'">

        </div><!--Button toevoegen -->

   </fieldset>

</form>

<script type="text/javascript">

    hideCombo('IIZvlS');

    document.getElementById('hierbeginnen').focus();

</script>