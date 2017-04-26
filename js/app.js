var counter = 0;


function buildBoard(size) {
	var $board = $('#board');
	$board.empty();
	for(var i = 0; i < size; i++) {
		$board.append('<tr id="row'+i+'"></tr>');
		for(var j = 0; j < size; j++) {
			$('#row'+i).append('<td id="row'+i+'col'+j+'" class="board-cell"></td>');
		}
	}
}


function runSim(size) {
	
	$.ajax({
		type: 'POST',
		url: 'php/runSim.php',
		data: {'size': size, 'simNum': $('#simulation-select').val()},
		success: function() {

		}
	}).done(function(data) {
		console.log(data);
		var boardArray = JSON.parse(data);
		console.log(boardArray);
		// console.log(boardArray[4][5]);
		for(var i = 0; i < size; i++) {
			for(var j = 0; j < size; j++) {
				var color = Math.floor(boardArray[i][j]);
				$('#row'+i+'col'+j).css('background-color', 'rgb('+color+', '+color+', '+color+')');
			}
		}
		$('#start-sim').text('Start Simulation');
	});	
}

$(document).ready(function() {
	var size = 8;
	// initializeBoardArray(size);
	buildBoard(size);
	// $('#row2col2').css('background-color', 'rgb(0, 0, 150)');
	$('#size-select').on('change', function() {
		size = $(this).val();
		buildBoard(size);
	});
	$('#start-sim').click(function() {
		$('#start-sim').text('Simulation Running');
		runSim(size);
	})
})