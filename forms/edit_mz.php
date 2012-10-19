<!--Start Formulier -->

<fieldset>

<form action="edit_mz.php?a_mzorg_id=<?= $_GET['a_mzorg_id'] ?>" method="post" name="zorgplanform" autocomplete="off">

	<div class="legende">Gegevens Mantelzorger:</div>

	<div>&nbsp;</div>

	<div class="label160">Naam&nbsp;: </div>

	<div class="waarde">

		<input type="text" size="35" value="<?php print($mz['naam']);?>" name="mzorg_naam" />

	</div><!--Naam -->

	<div class="label160">Voornaam&nbsp;: </div>

	<div class="waarde">

		<input type="text" size="35" value="<?php print($mz['voornaam']);?>" name="mzorg_voornaam" />

	</div><!--Voornaam -->

	<div class="label160">Verwantschap&nbsp;: </div>

	<div class="waarde">

		<select size="1" name="mzorg_verwsch_id" />

<?php

//----------------------------------------------------------

// Vul Input select element vanuit dbase

	$query = "

		SELECT

			*

		FROM

			verwantschap

		ORDER BY

			naam";

	if ($result=mysql_query($query))

		{

		for ($i=0; $i < mysql_num_rows ($result); $i++)

			{

			$records= mysql_fetch_array($result);

			$selected=($mz['verwsch_id']==$records[0])?"selected=\"selected\"":"";

			print ("<option value=\"".$records[0]."\" ".$selected.">".$records[1]."</option>\n");

			}

		}

//----------------------------------------------------------

?>

		</select>

	</div><!--Verwantschap -->

	<div class="label160">Telefoon&nbsp;: </div>

	<div class="waarde">

		<input type="text" size="35" value="<?php print($mz['tel']);?>" name="mzorg_tel" />

	</div><!--Telefoorn -->

	<div class="label160">GSM&nbsp;: </div>

	<div class="waarde">

		<input type="text" size="35" value="<?php print($mz['gsm']);?>" name="mzorg_gsm" />

	</div><!--Gsm -->

	<div class="label160">Adres&nbsp;: </div>

	<div class="waarde">

		<input type="text" size="35" value="<?php print($mz['adres']);?>" name="mzorg_adres" />

	</div><!--Adres -->

	<div class="inputItem" id="IIPostCode">

		<div class="label160">Postcode&nbsp;: </div>

		<div class="waarde">

			<input onKeyUp="refreshList('zorgplanform','postCodeInput','mzorg_gem_id',1,'IIPostCodeS',gemeenteList,20)" 

			onmouseUp="showCombo('IIPostCodeS',100)" onFocus="showCombo('IIPostCodeS',100)" type="text" name="postCodeInput" 

			value="<?php print($mz['dlzip']." ".$mz['dlnaam']);?>">

            <input type="button" value="<<" 

			onClick="resetList('zorgplanform','postCodeInput','mzorg_gem_id',1,'IIPostCodeS',gemeenteList,20,100)" />

		</div>

	</div>

	<div class="inputItem" id="IIPostCodeS">

		<div class="label160">Kies eventueel&nbsp;:</div>

		<div class="waarde">

			<select onClick="handleSelectClick('zorgplanform','postCodeInput','mzorg_gem_id',1,'IIPostCodeS')" 

			name="mzorg_gem_id" size="5">

			</select>

		</div>

	</div><!--Postcode -->

	<div class="label160">E-mail&nbsp;: </div>

	<div class="waarde" style="width:60%;">

		<input type="text" size="35" value="<?php print($mz['email']);?>" name="mzorg_email" />

	</div><!--E-mail -->

	<div class="label160">Deze gegevens</div>

	<div class="waarde">

		<input type="hidden" value="<?php print($_GET['a_mzorg_id']);?>" name="id" />

		<input type="submit" value="opslaan" name="update" />

	</div><!--Button toevoegen -->

</form>

</fieldset> 

<!--Einde Formulier -->

<script  type="text/javascript">

	hideCombo('IIPostCodeS');

</script>