$(document).ready(function () {

	const buttonColours = ['red', 'blue', 'green', 'yellow'];
	let gamePattern = [];
	let userClickedPattern = [];
	let level = 0;

	function nextSequence() {
		$('#level-title').text(`Level ${level}`);

		const randomNumber = Math.floor(Math.random() * 4);
		const randomChosenColour = buttonColours[randomNumber];
		gamePattern.push(randomChosenColour);

		$(`#${randomChosenColour}`).fadeOut(100).fadeIn(100);
		playSound(randomChosenColour);
		level += 1;
	}

	function handle() {
		const userChosenColour = $(this).attr('id');
		userClickedPattern.push(userChosenColour);
		console.log(userClickedPattern);
		playSound(userChosenColour);
		animatePress(userChosenColour);
		paintCheck();
	}

	function playSound(sound) {
		const audio = new Audio(`sounds/${sound}.mp3`);
		audio.muted = true;
		audio.play();
	}

	function animatePress(currColour) {
		const delay = 100;

		$(`#${currColour}`).addClass('pressed');
		setTimeout(function () {
			$(`#${currColour}`).removeClass('pressed');
		}, delay);
	}

	function paintCheck() {
		const delay = 1000;
		let flag = false;

		for (i = 0; i < userClickedPattern.length; i++) {
			if (userClickedPattern[i] === gamePattern[i]) {
				console.log('correct');
			} else {
				console.log('incorrect');
				const audio = new Audio('sounds/wrong.mp3');
				audio.muted = true;
				audio.play();
				userClickedPattern = [];
				gamePattern = [];
				flag = true;
				level = 0;

				

				$('body').addClass('game-over');
				setTimeout(() => {
					$('body').removeClass('game-over');
					$('#level-title').text('Game over, press any key to restart :)');
				}, 200)
				break;
			}
		}

		if ((userClickedPattern.length === gamePattern.length) && (!flag)) {
			userClickedPattern = [];

			setTimeout(() => {
				nextSequence();
			}, delay);
		}
	}


	$('html').keypress(nextSequence);

	$('.btn').click(handle);
 
	



	

});