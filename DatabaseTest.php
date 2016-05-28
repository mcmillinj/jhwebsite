<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Database Test</title>
 <link rel="stylesheet" href="index.css" type="text/css" media="screen">
</head>
<body>
<nav class="nav">
    <ul>
        <li>
            <a href="index.html" title="Home">Home</a>
        </li>
        <li>
            <a href="Journalling&Musings.html" title="Read about our coding adventures!">Journal</a>
            <ul>
                <li><a href="Beginnings.html">Beginnings</a></li>
                <li><a href="February.html">February</a></li>
                <li><a href="March.html">March</a></li>
            </ul>
        </li>
        <li>
        	<a href="VocabTest.html" title="Test your vocab!">Vocab Test</a>
        </li>
        <li>
        	<a href="DatabaseTest.php" title="Test your database!">Database Test</a>
        </li>
    </ul>
</nav>

<h1>Database Test</h1>
<p>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cookguide";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$result = $conn->query("SELECT count(*) FROM meal");
$myMealId = rand(1,$result->fetch_assoc()["count(*)"]);
echo $myMealId;
$sql = "SELECT meal_name FROM meal WHERE meal_key = ".$myMealId;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "You are eating ". $row["meal_name"]. "!" ."<br>";

    	$ingredientsql = "SELECT i.ingredient_name 
    	FROM ingredient i 
    	JOIN meal_ingredient_bridge b 
    	ON i.ingredient_key = b.ingredient_key 
    	WHERE b.meal_key = ".$myMealId;
		
		$ingredientresult = $conn->query($ingredientsql);
		
		echo "You will need the following: <br>";
		while($ingredientrow = $ingredientresult->fetch_assoc()) {
			echo $ingredientrow["ingredient_name"]."<br>";
		}
    }
} else {
    echo "0 results";
}
$conn->close();
?></p>

</body>


