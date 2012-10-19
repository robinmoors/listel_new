<script LANGUAGE="JavaScript">
function bevestigdel(itemid)
	{
	var agree=confirm("Weet u het zeker?");
	if (agree)
		document.location = "lijst_overlegcoord.php?a_overlcrd_id="+itemid
	else
		return false ;
	}
// -->
</script>
