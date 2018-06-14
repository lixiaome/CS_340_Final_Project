function RerollStats(){
	var level = document.getElementById('level').value;
	var power = 5 * level + Math.floor(Math.random()*5);
	var intelligence = 5 * level + Math.floor(Math.random()*5);
	var endurance = 5 * level + Math.floor(Math.random()*5);
	document.getElementById('power').value = power;
	document.getElementById('intelligence').value = intelligence;
	document.getElementById('endurance').value = endurance;
}

function CalcCredits(){
	var level = document.getElementById('level').value;
	var cost = 5 * level + Math.floor(Math.random()*5)-3;
	document.getElementById('cost').value = cost;
}

function REroll(){
	RerollStats();
	CalcCredits();
}

window.onload = function(){
	REroll();
}

