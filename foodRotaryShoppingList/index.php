<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

$day = get_day_of_diet();

?>

<script src="../js/jquery-1.7.min.js"></script>
<script>
	$(document).ready(function(){
		var day = <?php echo $day; ?>;
		for(i=1; i<8; i++){
			console.log(i);
			$.ajax({
				type: "GET",
				url: "getFood.php?day="+day,
				ajaxI: i,
				dataType: "xml",
				success: function(xml) {
					i = this.ajaxI;
					var appendText = "";
					$(xml).find('foods').each(function() {
						var type = $(this).find('type').text();
						appendText = appendText + "<optgroup label='"+type+"'>";
						$(this).find('food').each(function(index, element) {
							appendText = appendText + "<option value='"+$(this).attr('id')+"'>"+$(this).text()+"</option>";
						});
						appendText = appendText + "</optgroup>";
					});
					var idName = "#foodSelect"+i;
					$(idName).append(appendText);
				}
			});
			day++;
		}
		
		$.ajax({
			type: "GET",
			url: "shoppingList.php",
			dataType: "xml",
			success: function(xml) {
				var appendText = "";
				$(xml).find('food').each(function() {
					appendText = appendText + "<option value='"+$(this).attr('id')+"'>"+$(this).text()+"</option>";
				});
				$('#shoppingList').append(appendText);
			}
		});
		
		$('.addToList').click(function(){
			$.ajax({
				type: "GET",
				url: "shoppingList.php?item="+$('#foodSelect'+$(this).attr('day')).val()+"&day="+$(this).attr('day'),
				dataType: "xml",
				success: function(xml){
					$(xml).find('food').each(function(){
						$('#shoppingList').append("<option value='"+$(this).attr('id')+"'>"+$(this).text()+"</option>");
					});
				}
			});
		});
		
		$('.deleteFromList').click(function(){
			$.ajax({
				type: "GET",
				url: "shoppingList.php?delete="+$('#shoppingList').val(),
				dataType: "xml",
				success: function(xml){
					$('#shoppingList').find('option').remove();
					$(xml).find('food').each(function(){
						$('#shoppingList').append("<option value='"+$(this).attr('id')+"'>"+$(this).text()+"</option>");
					});
				}
			});
		});
	});
</script>
Today is day <?php echo $day; ?>
<br />
<select multiple='multiple' id='foodSelect1' class='foodSelect' size='20'></select>
<select multiple='multiple' id='foodSelect2' class='foodSelect' size='20'></select>
<select multiple='multiple' id='foodSelect3' class='foodSelect' size='20'></select>
<select multiple='multiple' id='foodSelect4' class='foodSelect' size='20'></select>
<select multiple='multiple' id='foodSelect5' class='foodSelect' size='20'></select>
<select multiple='multiple' id='foodSelect6' class='foodSelect' size='20'></select>
<select multiple='multiple' id='foodSelect7' class='foodSelect' size='20'></select>
<input type='button' class='addToList' day='1' value='Add to Shopping List'/>
<input type='button' class='addToList' day='2' value='Add to Shopping List'/>
<input type='button' class='addToList' day='3' value='Add to Shopping List'/>
<input type='button' class='addToList' day='4' value='Add to Shopping List'/>
<input type='button' class='addToList' day='5' value='Add to Shopping List'/>
<input type='button' class='addToList' day='6' value='Add to Shopping List'/>
<input type='button' class='addToList' day='7' value='Add to Shopping List'/>
<br/>
Shopping List
<br/>
<select multiple='multiple' id='shoppingList' size='20'></select>
<br/>
<input type='button' class='deleteFromList' value='Remove From Shopping List'/>
<?php

function get_day_of_diet(){
	$ts1 = strtotime("2012-08-15");
	$ts2 = strtotime(date("Y-m-d"));
	$seconds_diff = $ts2 - $ts1;
	$daysSinceDayOne = floor($seconds_diff/3600/24);
	$day = ($daysSinceDayOne % 4) + 1;
	return $day;
}
?>