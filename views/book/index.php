<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Make booking</title>
</head>

<body>

<?php

	
	if(empty($errors))
	{
        include "config/calendar.php";
        $conn = new Database();
		
		
		try
		{
			$start_day = intval(strtotime(htmlspecialchars($_POST["start_day"])));
			$start_time = (60*60*intval(htmlspecialchars($_POST["start_hour"]))) + (60*intval(htmlspecialchars($_POST["start_minute"])));
			// $end_day = intval(strtotime(htmlspecialchars($_POST["end_day"])));
			$end_time = (60*60*intval(htmlspecialchars($_POST["end_hour"]))) + (60*intval(htmlspecialchars($_POST["end_minute"])));
			$name = htmlspecialchars($_POST["name"]);
			$phone = htmlspecialchars($_POST["phone"]);
			$item = htmlspecialchars($_POST["item"]);
			
			$start_epoch = $start_day + $start_time;
			$end_epoch = $start_day + $end_time;
			
			// W tym zapytaniu trzeba pokombinować z start_day i start_time
			$sql = "SELECT * FROM reservation WHERE item='$item' AND start_day=$start_day AND (start_time<=$start_time AND end_time>=$start_time) OR phone=$phone AND start_day=$start_day";
			$result = $conn->query($sql);

			$sql_query = "SELECT COUNT(*) FROM reservation WHERE phone=$phone";
			$result_query = $conn->query($sql_query);
			$row_query = $result_query->fetch(PDO::FETCH_ASSOC);
			$ph = $row_query['COUNT(*)'];

				$day=intval(strtotime(htmlspecialchars($_POST['start_day'])));
				$row = $result->fetch(PDO::FETCH_ASSOC);
				$max_time = $end_time - $start_time;

				if ($result->rowCount() > 0 || $ph >= 3 || $max_time > 10800)
				{
					// while($row) {

					// 	for ($i = $start_epoch; $i <= $end_epoch; $i=$i+600) {

					// 		if ($i>($row["start_day"]+$row["start_time"]) && $i<($row["start_day"]+$row["end_time"])) {
					// 			print_r($row);
					// 			echo $i;
					// 			print_r($result);
					// 				echo '<h3><font color="red">Unfortunately ' . $item . ' has already been booked for the time and nr.card requested.</font></h3>';
					// 				goto end;
					// 		}
							
					// 	}

					// }		

					echo '<h3><font color="red">Unfortunately ' . $item . ' has already been booked for the time and nr.card requested.</font></h3>';	
				}
				else
				{
					$sql = "INSERT INTO reservation (name, phone, item, start_day, start_time, end_time, canceled)
						VALUES ('$name','$phone', '$item', $start_day, $start_time, $end_time, 0)";
					if ($conn->query($sql)) {
						echo "<h3>Booking succeed.</h3>";
					} else {
						echo "\nPDO::errorInfo():\n";
						print_r($conn->errorInfo());
				}
		
				end:

				}

			$conn = null;

			}
		// }
		catch (PDOException $e)
		{
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
?>

<a href="index"><p>Back to the booking calendar</p></a>

</body>

</html>
