<?php require('config.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Calandar</title>
    
    <link href='<?=$dir;?>packages/core/main.css' rel='stylesheet' />
    <link href='<?=$dir;?>packages/daygrid/main.css' rel='stylesheet' />
    <link href='<?=$dir;?>packages/timegrid/main.css' rel='stylesheet' />
    <link href='<?=$dir;?>packages/list/main.css' rel='stylesheet' />
    <link href='<?=$dir;?>packages/bootstrap/css/bootstrap.css' rel='stylesheet' />
    <link href="<?=$dir;?>packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href='<?=$dir;?>packages/datepicker/datepicker.css' rel='stylesheet' />
    <link href='<?=$dir;?>packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <link href='<?=$dir;?>style.css' rel='stylesheet' />

    <script src='<?=$dir;?>packages/core/main.js'></script>
    <script src='<?=$dir;?>packages/daygrid/main.js'></script>
    <script src='<?=$dir;?>packages/timegrid/main.js'></script>
    <script src='<?=$dir;?>packages/list/main.js'></script>
    <script src='<?=$dir;?>packages/interaction/main.js'></script>
    <script src='<?=$dir;?>packages/jquery/jquery.js'></script>
    <script src='<?=$dir;?>packages/jqueryui/jqueryui.min.js'></script>
    <script src='<?=$dir;?>packages/bootstrap/js/bootstrap.js'></script>
    <script src='<?=$dir;?>packages/datepicker/datepicker.js'></script>
    <script src='<?=$dir;?>packages/colorpicker/bootstrap-colorpicker.min.js'></script>
    <script src='<?=$dir;?>calendar.js'></script>
</head>
<body>

<h1>Reservation Room</h1>

<table border="1" cellpadding="5" width="800">
	<tr>
		<td valign="top">
		<form id='createEvent' method="post" class="form-horizontal">
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
			<input maxlength="20" name="card" required="" type="text" /></td>
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
					<label for="appt-time">Choose an appointment time: </label>
					<input id="appt-time" type="time" name="start_hour" value="13:30">

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

			<button type="submit" class="btn btn-primary">Save changes</button>
		</form>

		</td>
	</tr>
</table>



<script>
var dateToday = new Date();
var dates = $("#from, #to").datepicker({
	beforeShowDay: function(date) {
		var show = true;
		if (date.getDay() == 0) show =false;
		return[show];
	},
    dateFormat: 'yy-mm-dd',
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

<div class="container">
    <br>
    <div id="calendar"></div>
</div>

</body>
</html>
