<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Meal Planner</title>
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
        	<a href="MealPlanner.php" title="What's on the menu?">Meal Planner</a>
        </li>
    </ul>
</nav>
<div id="meal-planner-div">
<h1>Meal Planner</h1>

<button type="button" id="healthy-button"></button>
<button type="button" id="leftovers-button"></button>

<p>
<?php
if(isset($_GET['healthyOption']))
{
    $healthyOption = $_GET['healthyOption'];
}
if(isset($_GET['leftoversOption']))
{
    $leftoversOption = $_GET['leftoversOption'];
}
echo "healthyOption is ".$healthyOption;
echo "<br>";
echo "leftoversOption is ".$leftoversOption;

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

$sql = "SELECT meal_name 
		FROM meal 
		WHERE meal_key = ".$myMealId
;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<h2>". $row["meal_name"]. "</h2>";

    	$ingredientsql = "SELECT i.ingredient_name, FORMAT(i.price/100, 2) price
    	FROM ingredient i 
    	JOIN meal_ingredient_bridge b 
    	ON i.ingredient_key = b.ingredient_key 
    	WHERE b.meal_key = ".$myMealId." 
    	ORDER BY price DESC";
		
		$ingredientresult = $conn->query($ingredientsql);
		
		echo "You will need the following: <br>";
		echo "<table class=\"center\">";
		echo "<tr><th>Ingredient</th><th>Price</th></tr>";
		while($ingredientrow = $ingredientresult->fetch_assoc()) {
			echo "<tr><td>".$ingredientrow["ingredient_name"]."</td><td>£".$ingredientrow["price"]."</td></tr>";
		}
		echo "<br>";
		
		$ingredienttotalsql = "SELECT FORMAT(SUM(i.price)/100, 2) price
		, SUM(i.kcal) kcal
		, SUM(i.fat) fat
		, SUM(i.satfat) satfat
		, SUM(i.carb) carb
		, SUM(i.sugar) sugar
		, SUM(i.fibre) fibre
		, SUM(i.protein) protein
		, MAX(m.portions) portions
		FROM ingredient i
		JOIN meal_ingredient_bridge b 
    	ON i.ingredient_key = b.ingredient_key 
    	JOIN meal m
    	ON b.meal_key = m.meal_key
    	WHERE m.meal_key = ".$myMealId;
    	
    	$ingredienttotalresult = $conn->query($ingredienttotalsql);
    	$totalprice = $ingredienttotalresult->fetch_assoc()["price"];

    	echo "<tfoot><tr><td>TOTAL</td><td>£".$totalprice."</td></tr></tfoot>";

    	echo "</table>";

    	$ingredienttotalresult = $conn->query($ingredienttotalsql);    	
    	$portions = $ingredienttotalresult->fetch_assoc()["portions"]; 
    	    	
    	$ingredienttotalresult = $conn->query($ingredienttotalsql);    	
    	$totalkcal = $ingredienttotalresult->fetch_assoc()["kcal"];
    	
		$kcalperportion = round($totalkcal / $portions,0);   	
   		
    	echo "<p>This meal makes ".$portions." portions and has ".$kcalperportion." calories per portion.</p>";

    }
} else {
    echo "0 results";
}
$conn->close();
?></p>
</div>

<script>

var healthyOption = sessionStorage.getItem('healthyOptionSession');
var leftoversOption = sessionStorage.getItem('leftoversOptionSession');

if (healthyOption == null) {
	healthyOption = 'false';
}
if (leftoversOption == null) {
	leftoversOption = 'false';
}
if(healthyOption == 'true') {
	document.getElementById("healthy-button").innerHTML = 'Healthy';
} else {
	document.getElementById("healthy-button").innerHTML = 'Unhealthy';
}	
document.getElementById("leftovers-button").innerHTML = leftoversOption;

var flipHealthy = function () {

	if(healthyOption == 'true') {
		healthyOption = 'false';
	} else {
		healthyOption = 'true';
	} 

	sessionStorage.setItem('healthyOptionSession', healthyOption);

	if(healthyOption == 'true') {
		document.getElementById("healthy-button").innerHTML = 'Healthy';
	} else {
		document.getElementById("healthy-button").innerHTML = 'Unhealthy';
	}
	window.location.href = "MealPlanner.php?healthyOption=" + healthyOption + "&leftoversOption=" + leftoversOption;
};

var flipLeftovers = function () {
	if(leftoversOption == 'true') {
		leftoversOption = 'false';
	} else {
		leftoversOption = 'true';
	} 
	sessionStorage.setItem('leftoversOptionSession', leftoversOption);
	document.getElementById("leftovers-button").innerHTML = leftoversOption;
	//location.reload();
	window.location.href = "MealPlanner.php?healthyOption=" + healthyOption + "&leftoversOption=" + leftoversOption;
};

var button = document.querySelector("#healthy-button");
button.addEventListener('click', flipHealthy);

var button = document.querySelector("#leftovers-button");
button.addEventListener('click', flipLeftovers);

</script>

</body>


