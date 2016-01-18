<?php
	include_once("processEncourage.php");
	$processE = new MissionTripEncouragement();
?>
<html>
	<head>
		<title>Encouragement</title>
		<SCRIPT LANGUAGE="JavaScript">
		<!-- Dynamic Version by: Nannette Thacker -->
		<!-- http://www.shiningstar.net -->
		<!-- Original by :  Ronnie T. Moore -->
		<!-- Web Site:  The JavaScript Source -->
		<!-- Use one function for multiple text areas on a page -->
		<!-- Limit the number of characters per textarea -->
		<!-- Begin
		function textCounter(field,cntfield,maxlimit) {
		if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
		else
		cntfield.value = maxlimit - field.value.length;
		}
		//  End -->
</script>

	</head>
	<body>
		<form name="myForm" action = "addEncouragement.php" method = "post">
			To:<select name = "To">
				<?php $processE->getNames(); ?>
			</select>
			<br />
			From:<input type = "text" name = "From" />
			<br />
			Message:
			<br />
			<textarea name="Message" wrap="physical" cols="30" rows="10"
			onKeyDown="textCounter(document.myForm.Message,document.myForm.remLen2,800)"
			onKeyUp="textCounter(document.myForm.Message,document.myForm.remLen2,800)"></textarea>
			<br>
			<input readonly type="text" name="remLen2" size="3" maxlength="3" value="800">
			characters left

			<!--textarea rows = "10" cols = "30" name = "Message"></textarea-->
			<br />
			<input type = "submit" value = "Send" />
		</form>
	</body>
</html>