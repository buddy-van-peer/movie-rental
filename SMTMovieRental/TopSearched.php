<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8"/>
</head>
<body>

<?php	
	// Connect to database
	$conn = mysqli_connect("localhost", "root", "usbw", "movierental");
	
	// Statement to check top 10 movie searches
	$qry = "SELECT * FROM `dvd` ORDER BY `Count` DESC";
	
	$result = mysqli_query($conn, $qry);
	
	$name[] = array();
	$list[] = array();
	
	// Heading
	echo "<h2>Top Searched Movies</h2>";
	
	// Puts top 10 movie searches in an array
	for ($i = 1; $i < 11; $i++) {
		$row = mysqli_fetch_assoc($result);
		$name[$i] = "{$row['Title']}";
		$list[$i] = "{$row['Count']}";
	}	
	
	$graph = imagecreate(412.5, 500);
	
	$brown = imagecolorallocate($graph, 204, 102, 0);
	$blue = imagecolorallocate($graph, 51, 255, 255);
	
	//Individual bar for each title
	imagefilledrectangle($graph, 0, 500, 35, 500 - ($list[1] * 10), $blue);
	imagefilledrectangle($graph, 42.5, 500, 77.5, 500 - ($list[2] * 10), $blue);
	imagefilledrectangle($graph, 85, 500, 120, 500 - ($list[3] * 10), $blue);
	imagefilledrectangle($graph, 127.5, 500, 162.5, 500 - ($list[4] * 10), $blue);
	imagefilledrectangle($graph, 170, 500, 205, 500 - ($list[5] * 10), $blue);
	imagefilledrectangle($graph, 212.5, 500, 247.5, 500 - ($list[6] * 10), $blue);
	imagefilledrectangle($graph, 255, 500, 285, 500 - ($list[7] * 10), $blue);
	imagefilledrectangle($graph, 292.5, 500, 327.5, 500 - ($list[8] * 10), $blue);
	imagefilledrectangle($graph, 335, 500, 370, 500 - ($list[9] * 10), $blue);
	imagefilledrectangle($graph, 377.5, 500, 412.5, 500 - ($list[10] * 10), $blue);
	
	imagepng($graph, "chart.png");
	
	//Displays the titles and search count in text form
	echo $name[1] . ": <b>" . $list[1] . "</b><br></br>";
	echo $name[2] . ": <b>" . $list[2] . "</b><br></br>";
	echo $name[3] . ": <b>" . $list[3] . "</b><br></br>";
	echo $name[4] . ": <b>" . $list[4] . "</b><br></br>";
	echo $name[5] . ": <b>" . $list[5] . "</b><br></br>";
	echo $name[6] . ": <b>" . $list[6] . "</b><br></br>";
	echo $name[7] . ": <b>" . $list[7] . "</b><br></br>";
	echo $name[8] . ": <b>" . $list[8] . "</b><br></br>";
	echo $name[9] . ": <b>" . $list[9] . "</b><br></br>";
	echo $name[10] . ": <b>" . $list[10]  . "</b><br></br>";
?>
<img src="chart.png"/>

<?php
	// Other page links
	echo "<p><a href='Index.php'>Home</a></p>";
	echo "<p><a href='Search.php'>Search Movies</a></p>";
?>

</body>
</html>