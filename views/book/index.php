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
			
			
			$sql = "SELECT * FROM reservation WHERE item='$item' AND (start_day>=$start_day OR start_day>=$start_day) AND canceled=0";
			$sql2 = "SELECT COUNT(*) FROM reservation WHERE phone='$phone'";
			$rez = $conn->query($sql2);
			$result = $conn->query($sql);

			$rw = $rez->fetch(PDO::FETCH_ASSOC);
			$ph = $rw['COUNT(*)'];

			// echo $ph;
			if($ph >= 3)
			{
				echo '<h3><font color="red">Unfortunately ' . $item . ' has to many times booked room.</font></h3>';
			}
			else
			{
				$day=intval(strtotime(htmlspecialchars($_POST['start_day'])));
				$sqlQuery = $conn->query("SELECT * FROM reservation WHERE start_day=$day");
				$secondResult = $sqlQuery->fetch(PDO::FETCH_ASSOC);
				$row = $result->fetch(PDO::FETCH_ASSOC);

				if ($result->rowCount() > 0)
				{
					while($row) {

						for ($i = $start_epoch; $i <= $end_epoch; $i=$i+600) {

							if ($i>($row["start_day"]+$row["start_time"]) && $i<($row["start_day"]+$row["end_time"])) {
									echo '<h3><font color="red">Unfortunately ' . $item . ' has already been booked for the time and nr.card requested.</font></h3>';
									goto end;
							}
							
						}

					}				
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
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
?>

<a href="index"><p>Back to the booking calendar</p></a>

</body>

</html>
