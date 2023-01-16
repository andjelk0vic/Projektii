// Elements
let outputMinutes = document.querySelector('.min');
let outputSeconds = document.querySelector('.second');
let outputTens = document.querySelector('.ten');
let btnStart = document.querySelector('.btn-start');
let btnStop = document.querySelector('.btn-stop');
let btnReset = document.querySelector('.btn-reset');

let mins = 00;
let seconds = 00;
let tens = 00;
let interval;


// Functions
function startTime () {
    tens++;
    if (tens <= 9) {
        outputTens.innerHTML = '0' + tens;
    }
    if (tens > 9) {
        outputTens.innerHTML = tens;
    }
    if (tens > 99) {
        seconds++;
        outputSeconds.innerHTML = '0' + seconds;
        tens = 0;
        outputTens.innerHTML = '0' + 0;
    }
    if (seconds > 9) {
        outputSeconds.innerHTML = seconds;
    }
    if (seconds > 59) {
        mins++;
        outputMinutes.innerHTML = '0' + mins;
        seconds = 0;
        outputSeconds.innerHTML = '0' + 0;
    }
    if (mins > 9) {
        outputMinutes.innerHTML = mins;
    }
}
// Event listeners 
btnStart.addEventListener('click', () => {
    interval = setInterval(startTime, 10)
});

btnStop.addEventListener('click', () => {
    clearInterval(interval);
});

btnReset.addEventListener('click', () => {
    clearInterval(interval);
    mins = '00';
    seconds = '00';
    tens = '00';
    outputMinutes.innerHTML = mins;
    outputSeconds.innerHTML = seconds;
    outputTens.innerHTML = tens;
});