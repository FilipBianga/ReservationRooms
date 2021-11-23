<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>login tutorial</title>
</head> 
<body>
    <?php
     if (empty($_SESSION['user']))
    echo '<form action="login.php" method="post">
      <input type="text" name="login" /> 
      <br/> 
      <input type="password" name="password" />
      <br/>
      <button id="submit" type="submit">log in</button>
    </form>';
    else
    header("Location: http://localhost:80/admin/admin.php");
    
?>
</body>
</html>
