<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Peru varaus</title>
</head>

<body>

<?php
	
	if(empty($errors))
	{
        include "config/calendar.php";
        $conn = new Database();

		try
		{
			$id = intval(htmlspecialchars($_POST["id"]));

			$sql = "DELETE FROM reservation WHERE id = $id";
			if ($conn->query($sql)) {
				echo "<h3>Booking deleted.</h3>";
			}
			else {
				echo "\nPDO::errorInfo():\n";
				print_r($conn->errorInfo());
			}
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: '. $e->getMessage();
		}


		
		$conn = null;
	}
?>

<a href="dashboard"><p>Back to the calendar</p></a>

</body>

</html>
