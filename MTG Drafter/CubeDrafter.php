<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Cube Drafter</title>
 <link rel="stylesheet" href="..\index.css" type="text/css" media="screen">
</head>
<body>
<nav class="nav">
    <ul>
        <li>
            <a href="..\index.html" title="Home">Home</a>
        </li>
        <li>
            <a href="..\Journalling&Musings.html" title="Read about our coding adventures!">Journal</a>
            <ul>
                <li><a href="..\Beginnings.html">Beginnings</a></li>
                <li><a href="..\February.html">February</a></li>
                <li><a href="..\March.html">March</a></li>
            </ul>
        </li>
        <li>
        	<a href="..\VocabTest.html" title="Test your vocab!">Vocab Test</a>
        </li>
        <li>
        	<a href="..\MealPlanner.php" title="What's on the menu?">Meal Planner</a>
        </li>
        <li>
        	<a href="CubeDrafter.php" title="Draft some Magic!">Cube Drafter</a>
        </li>
    </ul>
</nav>

<div id="cube-drafter-div">
	
	<h1>Cube Drafter</h1>

<table id="draft-grid">
	<tr>
		<td class="outer-grid" id="top-corner"></td>
		<td class="outer-grid" id="left-column">▼</td>
		<td class="outer-grid" id="middle-column">▼</td>
		<td class="outer-grid" id="right-column">▼</td>
	</tr>
	<tr>
		<td class="outer-grid" id="top-row">▶</td>
		<td id="top-left"><p class="card-name"></p><p class="manacost"></p></td>
		<td id="top-middle"><p class="card-name"></p><p class="manacost"></p></td>
		<td id="top-right"><p class="card-name"></p><p class="manacost"></p></td>
	</tr>
	<tr>
		<td class="outer-grid" id="middle-row">▶</td>
		<td id="middle-left"><p class="card-name"></p><p class="manacost"></p></td>
		<td id="middle-middle"><p class="card-name"></p><p class="manacost"></p></td>
		<td id="middle-right"><p class="card-name"></p><p class="manacost"></p></td>
	</tr>
	<tr>
		<td class="outer-grid" id="bottom-row">▶</td>
		<td id="bottom-left"><p class="card-name"></p><p class="manacost"></p></td>
		<td id="bottom-middle"><p class="card-name"></p><p class="manacost"></p></td>
		<td id="bottom-right"><p class="card-name"></p><p class="manacost"></p></td>
	</tr>
</table>


<table id="pick-table"></table>

</div>
<script>
var cardsXml;
var numberOfCards;
var pickedCards = [];

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
		loadCards(xhttp);
	}
};
xhttp.open("GET", "SOI.xml", false);
xhttp.send();

buildDraftGrid();


function loadCards(xml) {
    cardsXml = xml.responseXML;
    numberOfCards = cardsXml.getElementsByTagName("card").length;
};

function getRandomCard() {
	var cardDetails = [];
	var randCard = Math.floor((Math.random() * (numberOfCards)));
	cardDetails.push(randCard);
    var cardName = cardsXml.getElementsByTagName("card")[randCard].childNodes[1].childNodes[0].nodeValue;
    cardDetails.push(cardName);
    var cardColourId = cardsXml.getElementsByTagName("card")[randCard].childNodes[5].childNodes[0].nodeValue;
    var cardColour;
    switch (cardColourId) {
    	case "W":
    		cardColour = "#F5F4CB";
    		break;
    	case "U":
    		cardColour = "#92CBE8";
    		break;
    	case "B":
    		cardColour = "#9696A3";
    		break;
    	case "R":
    		cardColour = "#F2A98A";
    		break;
    	case "G":
    		cardColour = "#A2C78B";
    		break;
    	case "C":
    		cardColour = "#8F6B63";
    		break;
    	default:
    		cardColour = "#EBDB34";
    }
    cardDetails.push(cardColour);		
    var cardManacost = cardsXml.getElementsByTagName("card")[randCard].childNodes[7].childNodes[0].nodeValue;
    cardDetails.push(cardManacost);		
    return cardDetails;
};

function buildDraftGrid() {
	draftCard("top-left");
	draftCard("top-middle");
	draftCard("top-right");
	draftCard("middle-left");
	draftCard("middle-middle");
	draftCard("middle-right");
	draftCard("bottom-left");
	draftCard("bottom-middle");
	draftCard("bottom-right");
};

function draftCard(position) {
		var randomCard = getRandomCard();
		document.getElementById(position).childNodes[0].innerHTML = randomCard[1];
		document.getElementById(position).childNodes[1].innerHTML = randomCard[3];
		document.getElementById(position).style.backgroundColor = randomCard[2];
};	

function pickCardFromGrid(position) {
	var pickedCardName = document.getElementById(position).childNodes[0].innerHTML;
	var pickedCardManacost = document.getElementById(position).childNodes[1].innerHTML;
	var pickedCardColor = document.getElementById(position).style.backgroundColor;
	pickedCards.push(pickedCardName);
	var table = document.getElementById("pick-table");
    var row = table.insertRow(0);
    row.style.backgroundColor = pickedCardColor;
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = pickedCardName;
    cell2.innerHTML = pickedCardManacost;
};

function pickLine(position1, position2, position3) {
	pickCardFromGrid(position1);
	pickCardFromGrid(position2);
	pickCardFromGrid(position3);
	buildDraftGrid();
};

function pickTopRow() {
	pickLine("top-left","top-middle","top-right");
};

function pickMiddleRow() {
	pickLine("middle-left","middle-middle","middle-right");
};

function pickBottomRow() {
	pickLine("bottom-left","bottom-middle","bottom-right");
};

function pickLeftColumn() {
	pickLine("top-left","middle-left","bottom-left");
};

function pickMiddleColumn() {
	pickLine("top-middle","middle-middle","bottom-middle");
};

function pickRightColumn() {
	pickLine("top-right","middle-right","bottom-right");
};

var topRow = document.querySelector('#top-row');
topRow.addEventListener('click', pickTopRow);
var middleRow = document.querySelector('#middle-row');
middleRow.addEventListener('click', pickMiddleRow);
var bottomRow = document.querySelector('#bottom-row');
bottomRow.addEventListener('click', pickBottomRow);
var leftColumn = document.querySelector('#left-column');
leftColumn.addEventListener('click', pickLeftColumn);
var middleColumn = document.querySelector('#middle-column');
middleColumn.addEventListener('click', pickMiddleColumn);
var rightColumn = document.querySelector('#right-column');
rightColumn.addEventListener('click', pickRightColumn);

</script>


</body>