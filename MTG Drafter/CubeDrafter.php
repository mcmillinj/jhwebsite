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
<br>
	
<!--	<h1>Cube Drafter</h1> -->
<p>Packs remaining: <span id="packs-remaining">15</span></p>
<table id="draft-grid">
	<tr>
		<td class="outer-grid" id="top-corner"></td>
		<td class="outer-grid" id="left-column">▼</td>
		<td class="outer-grid" id="middle-column">▼</td>
		<td class="outer-grid" id="right-column">▼</td>
	</tr>
	<tr>
		<td class="outer-grid" id="top-row">▶</td>
		<td id="top-left"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
		<td id="top-middle"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
		<td id="top-right"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
	</tr>
	<tr>
		<td class="outer-grid" id="middle-row">▶</td>
		<td id="middle-left"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
		<td id="middle-middle"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
		<td id="middle-right"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
	</tr>
	<tr>
		<td class="outer-grid" id="bottom-row">▶</td>
		<td id="bottom-left"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
		<td id="bottom-middle"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
		<td id="bottom-right"><p class="card-name" hidden></p><p class="manacost" hidden></p><p class="colourid" hidden></p><img class="card-image" /></td>
	</tr>
</table>


<table id="pick-table">
    <colgroup>
       <col span="1" class="colourid-column">
       <col span="1" class="amount-column">
       <col span="1" class="name-column">
       <col span="1" class="manacost-column">
    </colgroup>
</table>

</div>
<script>

var cardsXml;
var numberOfCards;
var pickedCards = [];
var mythics = [];
var rares = [];
var uncommons = [];
var commons = [];
var flipCards = [];
var packsRemaining = 15;

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
var numberOfFlipCards = 0;

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
	var cardColourId = getCardColourId(raritySet, cardNumber);
    var cardColour;
    switch (cardColourId) {
    	case "1":
			cardColour = "#F5F4CB";
   			break;
   		case "2":
   			cardColour = "#92CBE8";
    		break;
   		case "3":
   			cardColour = "#9696A3";
   			break;
    	case "4":
   			cardColour = "#F2A98A";
   			break;
    	case "5":
   			cardColour = "#A2C78B";
   			break;
    	case "6":
   			cardColour = "#8F6B63";
   			break;
    	default:
   			cardColour = "#EBDB34";
    }
    return cardColour;
};

function getCardColourId(raritySet, cardNumber) {
	var cardColourLetter = raritySet[cardNumber].childNodes[5].childNodes[0].nodeValue;
	var cardColourId;
	switch (cardColourLetter) {
	    case "W":
			cardColourId = "1";
   			break;
   		case "U":
   			cardColourId = "2";
    		break;
   		case "B":
   			cardColourId = "3";
   			break;
    	case "R":
   			cardColourId = "4";
   			break;
    	case "G":
   			cardColourId = "5";
   			break;
    	case "C":
   			cardColourId = "6";
   			break;
    	default:
   			cardColourId = "7";
    }
    return cardColourId;
};

function getCardManacost(raritySet, cardNumber) {
	return raritySet[cardNumber].childNodes[7].childNodes[0].nodeValue;
};

function getCardImageUrl(raritySet, cardNumber) {
	return raritySet[cardNumber].childNodes[3].getAttributeNode("picURL").value;
};

function getCardFlipName(raritySet, cardNumber) {
	var cardChildNodes = raritySet[cardNumber].childNodes;
	for (var i = 0 ; i < cardChildNodes.length ; i++) {
		if(cardChildNodes[i].nodeName == "related") {
			return cardChildNodes[i].childNodes[0].nodeValue;
		}
	}
	return;
};

function getCardFlipImageUrl(raritySet, cardNumber) {
	var cardFlipName = getCardFlipName(raritySet, cardNumber);
	alert(cardFlipName); //seems to work fine
	for (var i = 0 ; i < flipCards.length ; i++) {
		var flipCardChildNodes = flipCards[i].childNodes;
		if(flipCardChildNodes[1].nodeName == cardFlipName) {
			return flipCardChildNodes[3].getAttributeNode("picURL").value;
		}
	}
	return;
};

function getRandomCard() {

	var cardDetails = [];
	var raritySet;
	var randCard;
	
	var rarityRoll = Math.ceil(Math.random() * 224);
	//var rarityRoll = Math.ceil(Math.random() * 112);
	
	//if (rarityRoll <= 80) {
	if (rarityRoll <= 176) {
		raritySet = commons;
		randCard = Math.floor(Math.random() * numberOfCommons);
	} else if (rarityRoll <= 216) {
//	} else if (rarityRoll <= 104) {
		raritySet = uncommons;
		randCard = Math.floor(Math.random() * numberOfUncommons);
//		alert('rolled '+rarityRoll+'. Uncommon #'+randCard+' out of '+numberOfUncommons);
	} else if (rarityRoll <= 223) {
//	} else if (rarityRoll <= 111) {
		raritySet = rares;
		randCard = Math.floor(Math.random() * numberOfRares);
//		alert('rolled '+rarityRoll+'. Rare #'+randCard+' out of '+numberOfRares);
	} else {
		raritySet = mythics;
		randCard = Math.floor(Math.random() * numberOfMythics);
//		alert('rolled '+rarityRoll+'. Mythic #'+randCard+' out of '+numberOfMythics);
	}
	
	var cardName = getCardName(raritySet,randCard);
	cardDetails.push(cardName);
    
    var cardColour = getCardColour(raritySet,randCard);
	cardDetails.push(cardColour);		
    
    var cardManacost = getCardManacost(raritySet,randCard);
	cardDetails.push(cardManacost);
   	
   	var cardImageUrl = getCardImageUrl(raritySet,randCard);
   	cardDetails.push(cardImageUrl);
   	
   	var cardColourId = getCardColourId(raritySet, randCard);
   	cardDetails.push(cardColourId);
   	
   	getCardFlipImageUrl(raritySet, randCard);
   	 
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
	var flipcards = cardsXml.getElementsByTagName("flipcard");
	for(var j = 0 ; j < flipcards.length ; j++) {
		flipCards.push(flipcards[j]);
		numberOfFlipCards++;
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
		document.getElementById(position).childNodes[3].removeAttribute("src");
		document.getElementById(position).childNodes[3].removeAttribute("alt");
		document.getElementById(position).childNodes[3].removeAttribute("title");
		document.getElementById(position).childNodes[3].setAttribute("alt", randomCard[0]);
		document.getElementById(position).childNodes[3].setAttribute("title", randomCard[0]);
		document.getElementById(position).childNodes[3].setAttribute("src", cardImageUrl);
		document.getElementById(position).childNodes[0].innerHTML = randomCard[0];
		document.getElementById(position).childNodes[1].innerHTML = randomCard[2];
		document.getElementById(position).childNodes[2].innerHTML = randomCard[4];
		document.getElementById(position).style.backgroundColor = randomCard[1];
};	

function pickCardFromGrid(position) {
	var pickedCardName = document.getElementById(position).childNodes[0].innerHTML;
	var pickedCardColour = document.getElementById(position).style.backgroundColor;
	var pickedCardManacost = document.getElementById(position).childNodes[1].innerHTML;
	var pickedCardColourId = document.getElementById(position).childNodes[2].innerHTML;
	var pickedCard = [pickedCardName, pickedCardColour, pickedCardColourId, pickedCardManacost];
	pickedCards.push(pickedCardName);
	var pickTable = document.getElementById("pick-table");
	addCardToTable(pickedCard, pickTable);
};

function addCardToTable(pickedCard, table) {

	var pickedCardName     = pickedCard[0];
	var pickedCardColour   = pickedCard[1];
	var pickedCardColourId = pickedCard[2];
	var pickedCardManacost = pickedCard[3];

	var tableRowCount = table.rows.length;
	if (tableRowCount == 0) {
		var newRow = table.insertRow(0);
		newRow.style.backgroundColor = pickedCardColour;
		var colourIdCell = newRow.insertCell(0);
    	var cardCountCell = newRow.insertCell(1);
    	var cardNameCell = newRow.insertCell(2);
    	var cardCostCell = newRow.insertCell(3);

		colourIdCell.innerHTML = pickedCardColourId;
    	cardCountCell.innerHTML = 1;
    	cardNameCell.innerHTML = pickedCardName;
    	cardCostCell.innerHTML = pickedCardManacost;
	} else {
		for (var i = 0; i < tableRowCount; i++) {
			var row = table.rows[i];
			if (pickedCardColourId < row.cells[0].innerHTML) {
				//pickedCard has lower colour than current row
				var newRow = table.insertRow(i);
				newRow.style.backgroundColor = pickedCardColour;
				var colourIdCell = newRow.insertCell(0);
	   	 		var cardCountCell = newRow.insertCell(1);
		 		var cardNameCell = newRow.insertCell(2);
    			var cardCostCell = newRow.insertCell(3);

				colourIdCell.innerHTML = pickedCardColourId;
    			cardCountCell.innerHTML = 1;
    			cardNameCell.innerHTML = pickedCardName;
    			cardCostCell.innerHTML = pickedCardManacost;
    			return;
			} else if (pickedCardColourId == row.cells[0].innerHTML && pickedCardName < row.cells[2].innerHTML) {
				//pickedCard has same colour as current row and name is lower
				var newRow = table.insertRow(i);
				newRow.style.backgroundColor = pickedCardColour;
				var colourIdCell = newRow.insertCell(0);
    			var cardCountCell = newRow.insertCell(1);
    			var cardNameCell = newRow.insertCell(2);
	    		var cardCostCell = newRow.insertCell(3);

				colourIdCell.innerHTML = pickedCardColourId;
    			cardCountCell.innerHTML = 1;
    			cardNameCell.innerHTML = pickedCardName;
	    		cardCostCell.innerHTML = pickedCardManacost;
	    		return;
    		} else if (pickedCardName == row.cells[2].innerHTML) {
    			//pickedCard has same name as current row
	    		row.cells[1].innerHTML++;
	    		return;
    		}
		}
		var newRow = table.insertRow(tableRowCount);
		newRow.style.backgroundColor = pickedCardColour;
		var colourIdCell = newRow.insertCell(0);
	   	var cardCountCell = newRow.insertCell(1);
		var cardNameCell = newRow.insertCell(2);
    	var cardCostCell = newRow.insertCell(3);

		colourIdCell.innerHTML = pickedCardColourId;
    	cardCountCell.innerHTML = 1;
    	cardNameCell.innerHTML = pickedCardName;
    	cardCostCell.innerHTML = pickedCardManacost;
    	return;
	}
};

function pickLine(position1, position2, position3) {
	if(packsRemaining > 0) {
		pickCardFromGrid(position1);
		pickCardFromGrid(position2);
		pickCardFromGrid(position3);
		packsRemaining--;
		document.getElementById("packs-remaining").innerHTML = packsRemaining;
		buildDraftGrid();
	} else {
		return;
	}
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