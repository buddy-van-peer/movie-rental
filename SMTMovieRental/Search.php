<?php 

if (!isset($_POST['submit'])) { 

    ?>   
    	
<!-- Heading -->
<h1>Search</h1>
<!-- Form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <label>Title</label>
    <input type="text" name="title"/>
    <label>Genre</label>
    <input type="text" name="genre"/>
    <label>Rating</label>
    <input type="text" name="rating"/>
    <label>Year</label>
    <input type="text" name="year"/>
    <label for="submit">&nbsp;</label>
    <input type="submit" name="submit" value="Submit"/>
</form>

    <?php
    
	// Homepage link
    echo "<p><a href='Index.php'>Home</a></p>";
} else {
    // Get connection script
    include"connect.php";
    
	// Start of the SELECT (Search_ query
    $qry = "SELECT * FROM dvd WHERE ";
    
	// Variables for textboxes
    $title;
    $genre;
    $rating;
    $year;
    
	// String to SET the search count of each movie
    $setCount = "";
    
    // Variable to check if a textbox is the first one with an input and
    // therefore doesn't need an AND in the SQL query
    $isFirstTextBox = true;
    
	// Variable to check if all textboxes are empty and therefore skip an
    // if-else statement    
    $isEmpty = false;	
    
    // If textbox isn't empty then assign variable and 
    // append relevant SQL statement to $qry
    if (!empty($_POST['title'])) {
        $title = $_POST['title'];

        $qry .= "Title LIKE '%" . $title . "%'";
        
        $setCount = "UPDATE dvd SET Count = Count + 1 WHERE Title LIKE '%" .
        $title . "%'";
        
        $isFirstTextBox = false;
    }
    if (!empty($_POST['genre'])) {
        $genre = $_POST['genre'];
        
        if ($isFirstTextBox) {
            $qry .= "Genre LIKE '%" . $genre . "%'";
            $isFirstTextBox = false;
        } else {
            $qry .= " AND Genre LIKE '%" . $genre . "%'";
        }
    }
    if (!empty($_POST['rating'])) {
        $rating = $_POST['rating'];
        
        if ($isFirstTextBox) {
            $qry .= "Rating LIKE '" . $rating . "%'";
            $isFirstTextBox = false;
        } else {
            $qry .= " AND Rating LIKE '" . $rating . "%'";
        }
    }
    if (!empty($_POST['year'])) {
        $year = $_POST['year'];
        
        if ($isFirstTextBox) {
            $qry .= "Year LIKE '%" . $year . "%'";
            $isFirstTextBox = false;
        } else {
            $qry .= " AND Year LIKE '%" . $year . "%'";
        }
    }
    
    // Checking to see if every textbox is empty
    if (empty($_POST['title']) && empty($_POST['genre']) 
        && empty($_POST['rating']) && empty($_POST['year'])
    ) {
        echo "<h2>Invalid Search</h2>";
        echo "Please fill one or more textboxes before searching.";
        $isEmpty = true;
    }
    
    $result = $conn->query($qry);
    
	// Checks if title textbox has been filled before running statement
	if ($setCount != "") {
		$conn->query($setCount);
	}
    
    if (!$isEmpty && $result->num_rows > 0) {
        // Heading
        echo "<h2>Search Results</h2>";
        
        // Create a table
        echo "<table border = '1'>";
        echo "	<tr>
                    <th>ID</th>
					<th>Title</th>
					<th>Studio</th>
					<th>Status</th>
					<th>Sound</th>
					<th>Versions</th>
					<th>RecRetPrice</th>
					<th>Rating</th>
					<th>Year</th>
					<th>Genre</th>
					<th>Aspect</th>
				</tr>";
        
        // Assign variables
        while ($row = $result->fetch_assoc()) {
            $title = $row['Title'];
            $id = $row['ID'];
            $studio = $row['Studio'];
            $status = $row['Status'];
            $sound = $row['Sound'];
            $versions = $row['Versions'];
            $recRetPrice = $row['RecRetPrice'];
            $rating = $row['Rating'];
            $year = $row['Year'];
            $genre = $row['Genre'];
            $aspect = $row['Aspect'];
            
            // Output data into table
            echo "	<tr>
                        <td>$id</td>
						<td>$title</td>
						<td>$studio</td>
						<td>$status</td>
						<td>$sound</td>
						<td>$versions</td>
						<td>$recRetPrice</td>
						<td>$rating</td>
						<td>$year</td>
						<td>$genre</td>
						<td>$aspect</td>
					</tr>";
        }        
        echo "</table>";
    } else if (!$isEmpty) {
        echo "<h2>Search Results</h2>";
        echo "No movie found.";
    }
	// Other page links
    echo "<p><a href='Index.php'>Home</a></p>";
    echo "<p><a href='Search.php'>Search Again</a></p>";
    echo "<p><a href='TopSearched.php'>Top Searched Movies</a></p>";
}
?>