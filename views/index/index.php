<h1>Reservation Room</h1>
<table border="1" cellpadding="5" width="800">
	<tr>
		<td valign="top">
		<form action="book" method="post">
			<h3>Make booking</h3>
			<p><input checked="checked" name="item" type="radio" value="Room 1" />Room 1
			| <input name="item" type="radio" value="Room 2" />Room 2
			| <input name="item" type="radio" value="Room 3" />Room 3
			| <input name="item" type="radio" value="Room 4" />Room 4
			| <input name="item" type="radio" value="Room 5" />Room 5 | 
			<input name="item" type="radio" value="Room 6" />Room 6</p>
			<table style="width: 70%">
				<tr>
					<td>Name:</td>
					<td> <input maxlength="50" name="name" required="" type="text" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Nr. card:</td>
					<td>
			<input maxlength="20" name="phone" required="" type="text" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Reservation date:</td>
					<td>
			<input id="from" name="start_day" required="" type="text" /></td>

				</tr>
				
				<tr>
					<td>Reservation Time</td>
					<td>Start: <select name="start_hour">	
			<option selected="selected">08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			<option>13</option>
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<option>17</option>
			<option>18</option>
			<option>19</option>
			<option>20</option>
			<option>21</option>
			<option>22</option>
			<option>23</option>
			</select>:<select name="start_minute">
			<option selected="selected">00</option>
			<option>00</option>
			<option>10</option>
			<option>20</option>
			<option>30</option>
			<option>40</option>
			<option>50</option>
			</select></td>
					<td>&nbsp;</td>
					<td>End: <select name="end_hour">
			<option selected="selected">08</option>
			<option>09</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			<option>13</option>
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<option>17</option>
			<option>18</option>
			<option>19</option>
			</select>:<select name="end_minute">
			<option>00</option>
			<option>10</option>
			<option>20</option>
			<option>30</option>
			<option>40</option>
			<option>50</option>
			<option selected="selected">30</option>
			</select></td>
				</tr>
			</table>
			<p>

			<input name="book" type="submit" name="submit" value="Book" />
		</form>

		</td>
	</tr>
</table>
<?php


function draw_calendar($month,$year){
	include "config/calendar.php";
	$conn = new Database();

	try
	{
		$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

		$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

		$running_day = date('w',mktime(0,0,0,$month,0,$year));
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();

		$calendar.= '<tr class="calendar-row">';

		for($x = 0; $x < $running_day; $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
			$days_in_this_week++;
		endfor;

		for($list_day = 1; $list_day <= $days_in_month; $list_day++):
			if($running_day == 6)
			{
				$calendar.= '<td class="calendar-day" style="background-color: grey;><div><p>closed</p></div>';
			}
			
			$calendar.= '<td class="calendar-day">';
			
				$calendar.= '<div class="day-number">'.$list_day.'</div>';

				$calendar.= str_repeat('<p> </p>',2);
				$current_epoch = mktime(0,0,0,$month,$list_day,$year);
				
				$sql = "SELECT * FROM reservation WHERE $current_epoch BETWEEN start_day AND start_day";
							
				$result = $conn->query($sql);

				if ($result->rowCount() > 0) {

					while($row = $result->fetch(PDO::FETCH_ASSOC)) {
						if($row["canceled"] == 1) $calendar .= "<font color=\"grey\"><s>";
						$calendar .= "<b>" . $row["item"] . "</b><br>ID: " . $row["id"] . "<br>" . $row["name"] . "<br>" . $row["phone"] . "<br>";
						if($current_epoch == $row["start_day"] AND $current_epoch != $row["start_day"]) {
							$calendar .= "Booking starts: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br><hr><br>";
						}
						if($current_epoch == $row["start_day"] AND $current_epoch == $row["start_day"]) {
							$calendar .= "Booking starts: " . sprintf("%02d:%02d", $row["start_time"]/60/60, ($row["start_time"]%(60*60)/60)) . "<br>";
						}
						if($current_epoch == $row["start_day"]) {
							$calendar .= "Booking ends: " . sprintf("%02d:%02d", $row["end_time"]/60/60, ($row["end_time"]%(60*60)/60)) . "<br><hr><br>";
						}
						if($current_epoch != $row["start_day"] AND $current_epoch != $row["start_day"]) {
							$calendar .= "Booking: 24h<br><hr><br>";
						}
						if($row["canceled"] == 1) $calendar .= "</s></font>";
					}
				} else {
					if($running_day == 6)
					{
						$calendar .= "Library closed";
					}
					else
					{
						$calendar .= "No bookings";
					}

				}

			$calendar.= '</td>';
			if($running_day == 6):
				$calendar.= '</tr>';
				if(($day_counter+1) != $days_in_month):
					$calendar.= '<tr class="calendar-row">';
				endif;
				$running_day = -1;
				$days_in_this_week = 0;
			endif;
			$days_in_this_week++; $running_day++; $day_counter++;
		endfor;

		if($days_in_this_week < 8 AND $days_in_this_week > 1):
			for($x = 1; $x <= (8 - $days_in_this_week); $x++):
				$calendar.= '<td class="calendar-day-np"> </td>';
			endfor;
		endif;

		$calendar.= '</tr>';

		$calendar.= '</table>';
		
		$conn = null;
	}
	catch (PDOException $e)
	{
		echo 'Connection failed: ' . $e->getMessage();
	}
	return $calendar;
}

include_once "config/calendar.php";

$d = new DateTime(date("Y-m-d"));
echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
echo draw_calendar($d->format('m'),$d->format('Y'));

$d->modify( 'first day of next month' );
echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
echo draw_calendar($d->format('m'),$d->format('Y'));

// $d->modify( 'first day of next month' );
// echo '<h3>' . $months[$d->format('n')-1] . ' ' . $d->format('Y') . '</h3>';
// echo draw_calendar($d->format('m'),$d->format('Y'));

?>
<script>
var dateToday = new Date();
var dates = $("#from, #to").datepicker({
	beforeShowDay: function(date) {
		var show = true;
		if (date.getDay() == 0) show =false;
		return[show];
	},
	firstDay: 1,
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    minDate: dateToday,
	maxDate: 7,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
</script>