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
		<td id="top-left"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
		<td id="top-middle"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
		<td id="top-right"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
	</tr>
	<tr>
		<td class="outer-grid" id="middle-row">▶</td>
		<td id="middle-left"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
		<td id="middle-middle"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
		<td id="middle-right"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
	</tr>
	<tr>
		<td class="outer-grid" id="bottom-row">▶</td>
		<td id="bottom-left"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
		<td id="bottom-middle"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
		<td id="bottom-right"><p class="card-name" hidden></p><p class="manacost" hidden></p><img class="card-image" /></td>
	</tr>
</table>


<table id="pick-table"></table>

</div>
<script>

var cardsXml;
var numberOfCards;
var pickedCards = [];
var mythics = [];
var rares = [];
var uncommons = [];
var commons = [];

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
		loadCards(xhttp);
	}
};
xhttp.open("GET", "SOI.xml", false);
xhttp.send();

var numberOfMythics = 0;
var numberOfRares = 0;
var numberOfUncommons = 0;
var numberOfCommons = 0;

setRarityCounts();

buildDraftGrid();

/////////////////////////////////////////////////////////////////////////////////////////


function loadCards(xml) {
    cardsXml = xml.responseXML;
    numberOfCards = cardsXml.getElementsByTagName("card").length;
};

function getCardName(raritySet, cardNumber) {
	return raritySet[cardNumber].childNodes[1].childNodes[0].nodeValue;
};

function getCardColour(raritySet, cardNumber) {
	var cardColourId = raritySet[cardNumber].childNodes[5].childNodes[0].nodeValue;
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
    return cardColour;
};

function getCardManacost(raritySet, cardNumber) {
	return raritySet[cardNumber].childNodes[7].childNodes[0].nodeValue;
};

function getCardImageUrl(raritySet, cardNumber) {
	return raritySet[cardNumber].childNodes[3].getAttributeNode("picURL").value;
};

function getRandomCard() {

	var cardDetails = [];
	var raritySet;
	var randCard;
	
	var rarityRoll = Math.ceil(Math.random() * 112);
	
	if (rarityRoll <= 80) {
		raritySet = commons;
		randCard = Math.floor(Math.random() * numberOfCommons);
	} else if (rarityRoll <= 104) {
		raritySet = uncommons;
		randCard = Math.floor(Math.random() * numberOfUncommons);
	} else if (rarityRoll <= 111) {
		raritySet = rares;
		randCard = Math.floor(Math.random() * numberOfRares);
	} else {
		raritySet = mythics;
		randCard = Math.floor(Math.random() * numberOfMythics);
	}
	
	var cardName = getCardName(raritySet,randCard);
	cardDetails.push(cardName);
    
    var cardColour = getCardColour(raritySet,randCard);
	cardDetails.push(cardColour);		
    
    var cardManacost = getCardManacost(raritySet,randCard);
	cardDetails.push(cardManacost);
   	
   	var cardImageUrl = getCardImageUrl(raritySet,randCard);
   	cardDetails.push(cardImageUrl);
    
    return cardDetails;
};



function setRarityCounts() {
	var cards = cardsXml.getElementsByTagName("card");
	for(var i=0; i<cards.length; i++) {
  		switch (cards[i].getAttribute('rarity')) {
    		case "M":
    			mythics.push(cards[i]);
    			numberOfMythics++;
    			break;
    		case "R":
    			rares.push(cards[i]);
    			numberOfRares++;
    			break;
    		case "U":
    			uncommons.push(cards[i]);
    			numberOfUncommons++;
    			break;
    		case "C":
    			commons.push(cards[i]);
    			numberOfCommons++;
    			break;
    		default:
    			alert("There is a card with no rarity attribute. Check XML.");
    			break;
  		}
	}
}
	

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
		var cardImageUrl = randomCard[3];
		document.getElementById(position).childNodes[2].removeAttribute("src");
		document.getElementById(position).childNodes[2].removeAttribute("alt");
		document.getElementById(position).childNodes[2].setAttribute("alt", randomCard[0]);
		document.getElementById(position).childNodes[2].setAttribute("src", cardImageUrl);
		document.getElementById(position).childNodes[0].innerHTML = randomCard[0];
		document.getElementById(position).childNodes[1].innerHTML = randomCard[2];
		document.getElementById(position).style.backgroundColor = randomCard[1];
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