var start;
var myVar;

function eventhandler(){
	var randomEvent = Math.floor(Math.random() * 100);
	if(randomEvent >=0 && randomEvent < 30) powerEvent();
	else if (randomEvent >=30 && randomEvent < 60) intellEvent();
	else if (randomEvent >= 60 && randomEvent <90) enduranEvent();
	else DuelEvent();
	winCheck();
}

function winCheck(){
	var display = document.getElementById('displayEvents');
	var numChams = document.getElementById('numChams').value;
	if(numChams > 1){

	}
	else{
		display.innerHTML += "A winnter has been decided, game ends.\n";
		clearInterval(myVar);
	}
}

function powerEvent(){
	var display = document.getElementById('displayEvents');
	display.innerHTML += "Test Power Event\n";

}

function intellEvent(){
	var display = document.getElementById('displayEvents');
	display.innerHTML += "Test Intell Event\n";
}

function enduranEvent(){
	var display = document.getElementById('displayEvents');
	display.innerHTML += "Test Enduran Event\n";
}

function DuelEvent(){
	var display = document.getElementById('displayEvents');
	display.innerHTML += "Test Duel Event\n";	
}

function areaStart(){
	if(start == true){
		myVar = setInterval(eventhandler, 2000);
		start = false;
	}	
}

window.onload = function(){
	start = true;
}