var noOfClicks = 0;
var whatsClicked = [];
var firstClick = 0;
var secondClcik = 1;
var selectedHole = 0;
var availableHoles = [];
var possibleMoves = [];

possibleMoves[0] = [{jumpFrom:0, jumpOver:1, landTo:3}, {jumpFrom:0, jumpOver:2, landTo:5}];
possibleMoves[1] = [{jumpFrom:1, jumpOver:3, landTo:6}, {jumpFrom:1, jumpOver:4, landTo:8}];
possibleMoves[2] = [{jumpFrom:2, jumpOver:4, landTo:7}, {jumpFrom:2, jumpOver:5, landTo:9}];
possibleMoves[3] = [{jumpFrom:3, jumpOver:1, landTo:0},  {jumpFrom:3, jumpOver:4, landTo:5},
					{jumpFrom:3, jumpOver:6, landTo:10}, {jumpFrom:3, jumpOver:7, landTo:12}];
possibleMoves[4] = [{jumpFrom:4, jumpOver:7, landTo:11}, {jumpFrom:4, jumpOver:8, landTo:13}];
possibleMoves[5] = [{jumpFrom:5, jumpOver:2, landTo:0},  {jumpFrom:5, jumpOver:9, landTo:14},
					{jumpFrom:5, jumpOver:4, landTo:3},  {jumpFrom:5, jumpOver:8, landTo:12}];
possibleMoves[6] = [{jumpFrom:6, jumpOver:3, landTo:1}, {jumpFrom:6, jumpOver:7, landTo:8}];
possibleMoves[7] = [{jumpFrom:7, jumpOver:4, landTo:2}, {jumpFrom:7, jumpOver:8, landTo:9}];
possibleMoves[8] = [{jumpFrom:8, jumpOver:4, landTo:1}, {jumpFrom:8, jumpOver:7, landTo:6}];
possibleMoves[9] = [{jumpFrom:9, jumpOver:5, landTo:2}, {jumpFrom:9, jumpOver:8, landTo:7}];
possibleMoves[10] = [{jumpFrom:10, jumpOver:6, landTo:3}, {jumpFrom:10, jumpOver:11, landTo:12}];
possibleMoves[11] = [{jumpFrom:11, jumpOver:7, landTo:4}, {jumpFrom:11, jumpOver:12, landTo:13}];
possibleMoves[12] = [{jumpFrom:12, jumpOver:11, landTo:10}, {jumpFrom:12, jumpOver:13, landTo:14},
					 {jumpFrom:12, jumpOver:7, landTo:3},  {jumpFrom:12, jumpOver:8, landTo:5}];
possibleMoves[13] = [{jumpFrom:13, jumpOver:12, landTo:11}, {jumpFrom:13, jumpOver:8, landTo:4}];
possibleMoves[14] = [{jumpFrom:14, jumpOver:13, landTo:12}, {jumpFrom:14, jumpOver:9, landTo:5}];




function randomHole() {
	var myRandom = Math.floor(Math.random() * (14 - 0 + 1)) + 0;
	selectedHole = myRandom;
	availableHoles.push(selectedHole);
	var hole = "myDiv" + myRandom;
    var dev= document.getElementById(hole);
    dev.style.backgroundColor = 'black';
	document.getElementById("randomHole").disabled = true;
}
function gameReset(){
	location.reload();
}

function movePass(id){
	noOfClicks = noOfClicks + 1;
	var name = id.substring(5);
	whatsClicked.push(parseInt(name, 10));
	if (noOfClicks == 2){
		noOfClicks = 0;
		var isAvailable = availableHoles.indexOf(parseInt(name,10));
		if (isAvailable >= 0){
			var myJumpFrom = whatsClicked[0];
			var myLandTo = whatsClicked[1];
			var isLegalMove = 0;
			for(counter=0; counter<possibleMoves[myJumpFrom].length; counter++){
				if(possibleMoves[myJumpFrom][counter].jumpFrom == myJumpFrom && possibleMoves[myJumpFrom][counter].landTo == myLandTo){
					var holeFrom = "myDiv" + myJumpFrom;
					var colorFrom = document.getElementById(holeFrom).style.backgroundColor;
					var holeTo = "myDiv" + myLandTo;
					var colorTo = document.getElementById(holeTo).style.backgroundColor;
					var holeOver = "myDiv" + possibleMoves[myJumpFrom][counter].jumpOver;
					var colorOver = document.getElementById(holeOver).style.backgroundColor;
					if(!(colorOver.localeCompare("black") == 0)){
						isLegalMove = 1;
						document.getElementById(holeTo).style.backgroundColor = colorFrom;
						document.getElementById(holeOver).style.backgroundColor = colorTo;
						document.getElementById(holeFrom).style.backgroundColor = colorTo;
					
						var positionToDelete =	availableHoles.indexOf(myLandTo);
						if(positionToDelete >= -1){
							availableHoles.splice(positionToDelete, 1);
						}
						availableHoles.push(myJumpFrom);
						availableHoles.push(possibleMoves[myJumpFrom][counter].jumpOver);
					
						whatsClicked = [];
					}
				}
			}
			if(isLegalMove == 1){
				var currentpegs = []
				var numberOfLegalMoves = 0;
				for(pegCounter=0; pegCounter<=14; pegCounter++){
					var hole = "myDiv" + pegCounter;
					var holeColor = document.getElementById(hole).style.backgroundColor;
					if(!(holeColor.localeCompare("black") == 0)){
						currentpegs.push(pegCounter);
					}
				}
				for(pegCounter=0; pegCounter<currentpegs.length; pegCounter++){
					var currentPegMoves = [];
					currentPegMoves = possibleMoves[currentpegs[pegCounter]];
					for(stepCounter=0; stepCounter<currentPegMoves.length; stepCounter++ ){
						if((currentpegs.indexOf(currentPegMoves[stepCounter].jumpFrom) > -1) && (currentpegs.indexOf(currentPegMoves[stepCounter].landTo) ==-1)
							&& (currentpegs.indexOf(currentPegMoves[stepCounter].jumpOver) > -1)){
							numberOfLegalMoves = numberOfLegalMoves + 1;
						} 
					}
				}
				if(numberOfLegalMoves == 0){
					if(currentpegs.length >= 4){
						alert("Better luck next time.");
					}
					if(currentpegs.length == 3){
						alert("You are improving! Try again!");
					}
					if(currentpegs.length == 2){
						alert("So close! Try again!");
					}
					if(currentpegs.length == 1){
						alert("Victory!");
					}
				}
			}
			if(isLegalMove == 0){
				whatsClicked = [];
				alert("The move is invalid.");
			}
		}
		else{
				whatsClicked = [];
				alert("The move is invalid.");
		}
	}
}


