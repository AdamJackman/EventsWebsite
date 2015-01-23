<?php
class Calendar {
	private $db;
	private $functions;

	private $date;
	
	private $day; //gets current day
	private $month; //gets current month
	private $year; //gets current year
	
	private $prev_month;
	private $next_month;

	private $firstDay; //gets first day of month in time form
	private $month_title; //gets the month in word
	private $day_of_week; //get 3 letter representation of day
	private $blank;
	
	
	private $days_in_month; //amount of days in the month


	//DATABASE EVENTS
	/*
	$db->query("SELECT * FROM eventData WHERE unitID=?");
	$db->bind(1, $_SESSION['unitID']);
	$allEvents = $db->fetchAll();
	*/

	public function __construct($dbParam, $functionsParam, $monthParam = null, $yearParam = null) {
		$this->db = $dbParam;
		$this->functions = $functionsParam;

		$this->date = time();

		if(!is_null($monthParam) && !is_null($yearParam)) {
			if($monthParam == date("m", $this->date) && $yearParam == date("Y", $this->date)) {
				$this->day = date("d", $this->date);
			}
			//$day = 1;
			$this->month = $monthParam;
			$this->year = $yearParam;
		} else {
			$this->day = date("d", $this->date); //gets current day
			$this->month = date("m", $this->date); //gets current month
			$this->year = date("Y", $this->date); //gets current year
		}

		$this->prev_month = $this->month-1;
		$this->next_month = $this->month+1;

		//if month is less than 1
		if($this->prev_month < 1) {
			$this->prev_month = 12;
			$this->prev_year = $this->year-1;
		}
		if($this->next_month > 12) { //if month is greater than 12
			$this->next_month = 1;
			$this->next_year = $this->year+1;
		}

		$this->firstDay = mktime(0, 0, 0, $this->month, 1, $this->year); //gets first day of month in time form
		$this->month_title = date("F", $this->firstDay); //gets the month in word
		$this->day_of_week = date("D", $this->firstDay); //get 3 letter representation of day

		switch($this->day_of_week) { //depending of when the first day of the month is, determines the amount of spaces on the first week
			case 'Sun' : $this->blank = 0; break;
			case 'Mon' : $this->blank = 1; break;
			case 'Tue' : $this->blank = 2; break;
			case 'Wed' : $this->blank = 3; break;
			case 'Thu' : $this->blank = 4; break;
			case 'Fri' : $this->blank = 5; break;
			case 'Sat' : $this->blank = 6; break;
		}

		$this->days_in_month = date('t', mktime(0,0,0,$this->month,1,$this->year)); //amount of days in the month

	}

	public function generateCalendar($data = null) {
		$calendar  = "<div id=\"calendar_container\">";
		$calendar .= "<div id=\"calendar_content\">";
		$calendar .= "<table class=\"calendar-table-calendar\" id=\"calendar_table_calendar\">";
		$calendar .= "<tbody>";
		$calendar .= "<tr class=\"calendar-tr-nav\">";
  		$calendar .= "<td><a rel=\"";

  		if(isset($this->prev_year)) $calendar .= $this->prev_year; else $calendar .= $this->year;

  		$calendar .= "\" rev=" . $this->prev_month . " href=\"javascript:void(0);\" class=\"month-nav prev\" onclick=\"goToCalendar(this.rev, this.rel);\"><span class=\"glyphicon glyphicon-chevron-left\"></span></a></td>";			
  		$calendar .= "<td class=\"current-month\" colspan=\"5\">" . $this->month_title . " " . $this->year . "</td>";
  		$calendar .= "<td><a rel=\"";

  		if(isset($this->next_year)) $calendar .= $this->next_year; else $calendar .= $this->year;

  		$calendar .= "\" rev=\"" . $this->next_month . "\" href=\"javascript:void(0);\" class=\"month-nav next\" onclick=\"goToCalendar(this.rev, this.rel);\"><span class=\"glyphicon glyphicon-chevron-right\"></span></a></td>";
		$calendar .= "</tr>";
		$calendar .= "<tr class=\"calendar-tr-space\">";
		$calendar .= "<td colspan=\"7\"></td>";
		$calendar .= "</tr>";
		
		$calendar .= "<tr class=\"calendar-tr-weekday\">";
		$calendar .= "<td class=\"week-day\">Sun</td>";
		$calendar .= "<td class=\"week-day\">Mon</td>";
		$calendar .= "<td class=\"week-day\">Tue</td>";
		$calendar .= "<td class=\"week-day\">Wed</td>";
		$calendar .= "<td class=\"week-day\">Thu</td>";
		$calendar .= "<td class=\"week-day\">Fri</td>";
		$calendar .= "<td class=\"week-day\">Sat</td>";
		$calendar .= "</tr>";

		$calendar .= "<tr class=\"calendar-tr-space\">";
		$calendar .= "<td colspan=\"7\"></td>";
		$calendar .= "</tr>";

		$dayCount = 1;

		$calendar .= "<tr class=\"calendar-tr-day\">";
						
		while($this->blank > 0) {
			$calendar .= "<td class=\"last-month-day\">&nbsp;</td>";
			$this->blank--;
			$dayCount++;
			
		}

		$day_num = 1;

		while($day_num <= $this->days_in_month) {
			if($dayCount > 7) { //creates new row after displaying 7 days
				$calendar .= "</tr>";
				$calendar .= "<tr class=\"calendar-tr-day\">";
				$dayCount = 1;
			}

			$dateFormat = $this->year.'-'.$this->month.'-'.$day_num;
			$data = $this->functions->occupiedDate($this->db, $dateFormat);

			/*
			$data = array(
					"actionID"		=> "1",
					"creatorID"		=> "1",
					"eventName"		=> "Event Name",
					"startDate" 	=> "Mar. 3, 2014",
					"endDate" 		=> "Mar. 4, 2014",
					"description" 	=> "This is the description",
					"location" 		=> "location",
					"coverPicture" 	=> "coverPicture",
					"minAttend" 	=> "3"
			);
			*/

			$timeStamp = dateToUnix($this->year.'-'.$this->month.'-'.$day_num);
			$isEvent = 0;

			if(is_array($data)) {
				$calendar .= "<td id=\"eventId" . $data['actionid'] . "\" onclick=\"\" class=\"";
				if($day_num == $this->day) $calendar .= "event-today"; else $calendar .= "has-event";
				$calendar .= "\" rel=\"tooltip\" data-placement=\"top\" data-original-title=\"Click to View Event\" href=\"\">" . $day_num . "</td>";
				$isEvent = 1;
			}
			
			if(!$isEvent) {
				if($day_num == $this->day) {
					$calendar .= "<td class=\"current-date\" data-toggle=\"popover\" data-placement=\"left\" data-original-title=\"No Events\" data-content=\"Click to Add Event for Today\" timeStamp=\"" . $timeStamp . "\">" . $day_num . "</td>";
				} else {
					$calendar .= "<td class=\"emptyDay\" data-toggle=\"popover\" data-placement=\"left\" data-original-title=\"No Events\" data-content=\"Click to Add Event for this Day\" timeStamp=\"" . $timeStamp . "\">" . $day_num . "</td>";
				}
			} else {
				$isEvent = 0;
			}

			$dayCount++;
			$day_num++;

		}

		while($dayCount < 8) {
			$calendar .= "<td class=\"next-month-day\">&nbsp;</td>";
			$dayCount++;
		}

		$calendar .= "</tbody>";
		$calendar .= "</table>";
		$calendar .= "<div id=\"calendar_event_detail\"></div>";
		$calendar .= "</div>"; //end calendar_content
		$calendar .= "</div>"; //END CALENDAR

		return $calendar;

	}

}

?>