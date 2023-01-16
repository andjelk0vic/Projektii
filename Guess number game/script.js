let btnGuess = document.getElementById('btn-guess');
let btnAgain = document.getElementById('play-again');
let outputMessage = document.getElementById('message');
let allContent = document.querySelector('.content');


let number = Math.floor(Math.random() * 15) + 1;

btnGuess.addEventListener('click', function() {
    let userInput = document.getElementById('input-number').value;
    if(userInput > number) {
        outputMessage.innerHTML = 'Broj je previsok , probaj manji!';
    } else if (userInput < number) {
        outputMessage.innerHTML = 'Broj je mali , probaj veci!';
    } 
    if (userInput == number) {
        outputMessage.innerHTML = `Broj je tacan! Zamislio sam broj ${number}`;
        btnAgain.classList.remove('hidden');
        allContent.classList.add('hidden'); 
    }
});

btnAgain.addEventListener('click', function() {
    window.location.reload();
});