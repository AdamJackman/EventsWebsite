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