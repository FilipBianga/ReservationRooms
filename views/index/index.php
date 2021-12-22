<h1>Reservation Room</h1>
<table border="1" cellpadding="5" width="800">
	<tr>
		<td valign="top">
		<form action="book.php" method="post">
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

<script>
    $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+0w",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
	  regional: "fi",
      changeMonth: true,
      numberOfMonths: 3,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });  </script>