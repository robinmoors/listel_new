<script type="text/javascript">

function checkForNumbersOnly(numericField,aantal,ondergr,bovengr,formulier,next)

	{

	var checkOK = "0123456789";

	var checkStr = numericField.value;

	var allValid = true;

	var focusField = true;

	if(checkStr.length>aantal){numericField.value=checkStr.substring(0,aantal)}

	if(checkStr.length==aantal)

		{

		if(parseInt(checkStr,10)<=ondergr)

			{

			numericField.value="";

			alert("deze waarde klopt niet");

			numericField.focus();

			focusField=false;

			}

		if(parseInt(checkStr,10)>bovengr)

			{

			numericField.value="";

			alert("deze waarde klopt niet");

			numericField.focus();

			focusField=false;

			}

		if(focusField && next != "")

			{eval("document.forms['"+formulier+"'].elements['"+next+"'].focus()");}

		

		}

	var checkStr = numericField.value;

	for (i = 0;  i < checkStr.length;  i++)

		{

		ch = checkStr.charAt(i);

		for (j = 0;  j < checkOK.length;  j++)

			if (ch == checkOK.charAt(j)) break;

			if (j == checkOK.length)

				{

				allValid = false;

				i=checkStr.length;

				break;

				}

			}

	if (!allValid)

		{

		numericField.value=checkStr.substring(0,checkStr.length-1)

		numericField.focus();

		}

	}

function checkForNumbersLength(numericField,aantal)

	{

	var checkStr = numericField.value;

	if(!(checkStr.length==aantal)&&!(checkStr.length==0))

		{

		alert(aantal+" cijfers graag!");

		numericField.focus();

		}

	}

	

</script>