<!DOCTYPE html>
<html lang="en">
<head>
  <title>Willem's website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-fluid">
<div class="jumbotron" style = "background-color: lightblue;">
  <h1 class="display-4">Prcoessing</h1>
  <hr class="my-4">
</div>
<?php
ob_start();
if(isset($_REQUEST['submit']))
{
	$email = $_REQUEST['email'];
	$problem = $_REQUEST['problem'];
	$link = mysqli_connect("localhost", "root", "", "website");
	if (!$link) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		$url = 'failure.html';
		header( "Location: $url" );
    exit;
	}
	else{
		$sql = "SELECT * FROM message";
		$result = mysqli_query($link, $sql);
		$num = mysqli_num_rows($result);
		$num++;
		$sql = "INSERT INTO `message`(`ID`, `email`, `text`) VALUES ('$num','$email','$problem')";
		if(mysqli_query($link, $sql)){
			echo "Record inserted...";
		}
		else{
			echo mysqli_error($link);
		}
	}

$url = 'success.html';
while (ob_get_status()) 
{
    ob_end_clean();
}
header( "Location: $url" );
	
	
}
?>
</body>
</html>