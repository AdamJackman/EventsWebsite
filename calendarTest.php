<?php

require("libs/config.php");
require("includes/calendar.php");

$_SESSION["memberID"] = 48;

$cal = new Calendar($db, $functions);
$res = $cal->generateCalendar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSC309Project</title>

	<link href="css/calendar.css" rel="stylesheet" type="text/css"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript">
function goToCalendar(month, year) {
	//document.write(document.getElementById('prev').rel);
	$.ajax({
		type: 'get',
		url: 'calendarUpdate.php',
		data: 'month=' + month + '&year=' + year,
		success: function(response){
			document.getElementById('calendar').innerHTML = response;
			$(document).ready(function() {
				// tooltip demo
				$('.calendar-tr-day').tooltip({
					selector: "[rel=tooltip]",
					container: 'body'
				});
				$('.calendar-tr-day').mouseleave(function () {
					$('.tooltip').remove();
				});
				var isVisible = false;
				var clickedAway = false;
				$('.emptyDay, .current-date').popover({
					selector: "[data-toggle=popover]",
					container: 'body',
					html: true,
					trigger: 'manual'
				}).click(function(e) {
					if(isVisible && clickedAway) {
						$('.popover').remove();
						isVisible = clickedAway = false;
					}
					$(this).popover('show');
					var timeStamp = $(this).attr('timestamp');
					$('.popover-title').append('<button type="button" class="close">&times;</button>');
					$('.popover-content').append('<br /><br /><a href="eventModify.php?type=add&timeStamp='+timeStamp+'" type="button" class="btn-sm btn-primary">Add Event</a>'); clickedAway = false;
					isVisible = true;
					e.preventDefault();
				});
				$(document).click(function(e) {
					if(isVisible && clickedAway) {
						$('.popover').remove();
						isVisible = clickedAway = false;
					} else {
					clickedAway = true;
					}
				});
			});
		}
	});
} 
</script>

</head>
<body>
<div id="calendar">
	<?php echo $res; ?>
</div>

</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
		// tooltip demo
		$('.calendar-tr-day').tooltip({
			selector: "[rel=tooltip]",
			container: 'body'
		});

		$('.calendar-tr-day').mouseleave(function () {
			$('.tooltip').remove();
		});

		var isVisible = false;
		var clickedAway = false;

		$('.emptyDay, .current-date').popover({
			selector: "[data-toggle=popover]",
			container: 'body',
			html: true,
			trigger: 'manual'
		}).click(function(e) {
			if(isVisible && clickedAway) {
				$('.popover').remove();
				isVisible = clickedAway = false;
			}
			$(this).popover('show');
			var timeStamp = $(this).attr('timestamp');
			$('.popover-title').append('<button type="button" class="close">&times;</button>');
			$('.popover-content').append('<br /><br /><a href="eventModify.php?type=add&timeStamp='+timeStamp+'" type="button" class="btn-sm btn-primary">Add Event</a>');
			clickedAway = false;
			isVisible = true;
			e.preventDefault();
		});

		$(document).click(function(e) {
			if(isVisible && clickedAway) {
				$('.popover').remove();
				isVisible = clickedAway = false;
			} else {
				clickedAway = true;
			}
		});
    });
    	
</script>
</html>