/*koristicemo globalne varijable za skorove, igrace i vrednosti kockica iz proslog bacanja
sto znaci da ce nam sve funkcije koje napisemo imati direktan pristup
*/
var scores, roundScore, activePLayer, gamePlaying, tempDice, tempDice2, goalScore, gamesCounter, tempGamesCounter;

//ovde zovemo funkciju init koja ce nam inicijalizovati projekat - opis funkcije na liniji 146
init();


/*
dodajemo EventListener na dugme klase btn-roll i osluskujemo na klik
dodajemo mu sledecu anonimnu funkciju
*/
document.querySelector('.btn-roll').addEventListener('click', function () {
	//da li je igra u toku? ispitujemo gamePlaying flag, u slucaju da jeste nastavljamo sa igrom
	if(gamePlaying) {
		/*
		bacanje kockica simuliramo tako sto uzimamo 2 slucajna broja koja ce predstavljati rezultate bacanja
		posto zelimo broj od 1 do 6 koristimo random da dobijemo borj od 0 do 1 ~NAPOMENA [0,1)~
		Math.random broj mnozimo sa 6 da bismo dobili 0 do 5 pa dodajemo 1 da bismo dobijali zeljene 1-6
		*/
		var dice = Math.floor(Math.random()*6) + 1;
		var dice2 = Math.floor(Math.random()*6) + 1;


		/* 
		posto sada imamo nase brojeve moramo da ih prikazemo igracima na kockicama
		imamo 6 slika kocki slicog imena, jedina razlika jeste u broju na kraju
		rezultati bacanja odgovaraju rednom broj odgovarajuce kockice pa ih prosledjujemo u string pri menjanju source
		atributa, naravn pre toga display->block jer zelimo da kocke prikazemo (init ga stavlja na none)
		*/
		var diceDOM = document.querySelector('.dice');
		diceDOM.style.display = 'block';
		diceDOM.src = 'dice-' + dice + '.png';

		var diceDOM2 = document.querySelector('.dice-2');
		diceDOM2.style.display = 'block';
		diceDOM2.src = 'dice-' + dice2 + '.png';


		//Ako nema jedinica u kockicama nastavljamo sa rundom aktivnog igraca
		if((dice !== 1) && (dice2 !== 1)) {
			//sabiramo rezultate kockica u varijablu roundScore
			roundScore = dice + dice2 + roundScore;
			//prikazujemo trenutne poene igracima, isit trik dodavanja vrednosti u string pri selektovanju kao i kod bacanja kocki
			document.querySelector('#current-' + activePLayer).textContent = roundScore;

			//ako je pak, igrac dobio kobnu jedinicu, zovemo funkciju nextPlayer() - objasnjenje funkcije na liniji 
		} else {	
			nextPlayer();
		}	

		/*
		ok, posto smo prosli prvu proveru pravila, sledi druga provera: da li je igrac dobio 2 sestice zaredom?
		2 sucaja prolaze proveru i obeshrabruju naseg aktivnog igraca: kada dice i tempDice imaj uvrednost 6
		ili dice2 i tempDice2 imaju 6, tj. ako na istoj kockici dobija sestice zaredom ulazimo u blok naredbi
		takodje proveravamo da nisu temp kockice -1, ako jesu to znaci da je to prvo bacanje u igri
		pri prvom bacanju ne vazi pravilo 6ica zaredom te ne idemo daljeu tom slucaju
		*/
		if(((dice === 6) && (tempDice === 6) && (tempDice !== -1)) || ((dice2 === 6) && (tempDice2 === 6) && (tempDice2 !== -1))){
			//igrac je nagrabusio i sada mu trajni skor stavljamo na nulu
			scores[activePLayer] = 0;
			//kao i trenutnoi skor
			roundScore = 0;
			//updateujemo promene rezultata u DOM
			document.querySelector('#score-' + activePLayer).textContent = scores[activePLayer];	
			document.querySelector('#current-' + activePLayer).textContent = roundScore;

			//zovemo funckiju nextPlayer();
			nextPlayer();
			//i krijemo kocke
			diceDOM.style.display = 'none';
			diceDOM2.style.display = 'none';
		}

		//igrac je prosao rundu, te je na nama samo da sacuvamo rezultate bacanja jer ce nam koristiti za pravilo 6ica
		tempDice = dice;
		tempDice2 = dice2;
	}
});

/*
dodajemo EventListener na dugme klase btn-hold i osluskujemo na klik
dodajemo mu sledecu anonimnu funkciju
*/
document.querySelector('.btn-hold').addEventListener('click', function () {
	
	//proveravamo da li je igra u toku
	if(gamePlaying){
		//Dodajemo current score na trajni score aktivnog igraca
		scores[activePLayer] += roundScore;

		//Update UI
		document.querySelector('#score-' + activePLayer).textContent = scores[activePLayer];

		//Provera da li je igrac postigao dovoljan broj poena za pobedu
		//ako jeste postavljamo klase winner na DOM strani pobednika, krijemo kocke i postavljamo flag za igru u toku na false
		if(scores[activePLayer] >= goalScore) {
			document.querySelector('#name-' + activePLayer).textContent = 'Winner';
			document.querySelector('.dice').style.display = 'none';
			document.querySelector('.dice-2').style.display = 'none';
			document.querySelector('.player-' + activePLayer + '-panel').classList.add('winner');
			document.querySelector('.player-' + activePLayer + '-panel').classList.remove('active');
			gamePlaying = false;

		} else {
			//ako ne, sledeci igrac je na redu da baca kocke
			nextPlayer();	
		}

	}
	
});

/*
dodajemo EventListener na dugme klase btn-set-goal i osluskujemo na klik
dodajemo mu sledecu callback funckiju setGoal linija -> 
*/
document.querySelector('.btn-set-goal').addEventListener('click',setGoal);


function nextPlayer() {
	activePLayer === 0 ? activePLayer = 1 : activePLayer = 0;
	roundScore = 0;

	document.getElementById('current-0').textContent = '0';
	document.getElementById('current-1').textContent = '0';

	document.querySelector('.player-0-panel').classList.toggle('active');
	document.querySelector('.player-1-panel').classList.toggle('active');

	tempDice = -1;

}

/*
da bismo resetovali igru, pozivamo init() da ocisti playing field
Napomena - ReadMe
*/
document.querySelector('.btn-new').addEventListener('click', init);

/*
Svrha ove funkcije jeste da pokrene igru
Zelimo da imamo sve rezultate na pocetne vrednosti, tj. na 0
*/
function init() {

	//bool gamePlaying nam je flag za igru u toku
	gamePlaying = true; //postavljamo flag na true, sto znaci da je igra u toku

	/*
	niz scores sadrzi 2 broja - trajne poene igraca
	prvi oznacava skor prvog igraca, drugi skor drugog
	*/
	scores = [0,0];  //reset rezultata
	/*
	slicno scores varijabli, activePlayer je number tipa i koristicemo ga
	tako da 0 oznacava prvog igraca, a 1 drugog
	*/
	activePLayer = 0; //reset aktivnog igraca -> prvi uvek baca prvi
	//round score je trenutni skor i njega ce deliti oba igraca naizmenicno
	roundScore = 0;
	/*
	temp dice je varijabla koja oznacava kocku bacenu u proslom bacanju
	uveo sam je jer ce nam trebati provera da li igrac dobija sestice zaredom
	pa nam treba neka varijabla da cuva vrednosti
	*/
	tempDice = -1; //hard set za kocku, ide na -1 jer takav rezultat ne ocekujemo i -1 cesto predstavlja ne inicijalizovane varijable
	//default broj poena za pobedu u igri
	goalScore = 100;
	/*
	krijemo obe kocke ako nema igre u toku, za to koristimo CSS selektor da targetujemo html elemente sa klasom dice
	i postavljamo im display -> "none" sto znaci da se nece prikazati
	*/
	document.querySelector('.dice').style.display = 'none';
	document.querySelector('.dice-2').style.display = 'none';

	/* 
	posto rezultate bacanja prikazujemo prikazujemo igracima preko html div elemenata koji su imali neke placeholder vrednosti
	moramo da ih postavimo na 0 jer ocekujemo da igraci pocinju da sakupljaju poene od 0
	opet, score-0/1, current-0/1 prikazuju poene prvog/drugog igraca
	*/
	document.getElementById('score-0').textContent = '0';
	document.getElementById('score-1').textContent = '0';
	document.getElementById('current-0').textContent = '0';
	document.getElementById('current-1').textContent = '0';

	/* 
	zbog toga sto menjamo imena igracima nakon zavrsetka igre u winner/loser moramo i to da resetujemo
	*/
	document.getElementById('name-0').textContent = 'Player 1';
	document.getElementById('name-1').textContent = 'Player 2';

	/*
	opciono, imamo css stil klase koje su neativne, tj. nijedan element ih ne sadrzi
	one menjaju boju aktivnom igracu, bolduju nazive aktivnog igraca/pobednika
	tehnikom dodavanja/oduzimanja klasa mozemo dinamicki da menjamo izglem DOM elementima
	ovde ih zada oduzimamo jer ocekujemo da smo ih dodavali u prosloj igri
	*/

	document.querySelector('.player-0-panel').classList.remove('winner'); //obojica nisu vise winner reset
	document.querySelector('.player-1-panel').classList.remove('winner');
	document.querySelector('.player-0-panel').classList.remove('active'); //obojica nisu vise active reset
	document.querySelector('.player-1-panel').classList.remove('active');
	
	//kada se igra resetuje player 1 je active igrac te mu dodajemo klasu active
	document.querySelector('.player-0-panel').classList.add('active');
}

/*
set goal funckija nam omogucava da postavimo custom broj poena
proveru vrsimo tako sto gledamo da li su svi skorovi na nuli
~Napomena: "koristio gamePLaying kao flag sve vreme za proveru toka igre, zasto ne i ovde?" - ReadME
*/
function setGoal() {
	//napomena ReadME
	if((scores[0] === 0) && (scores[1] === 0) && (roundScore === 0)) {
		goalScore = prompt('Enter the score (default is 100)');
		alert('Score has changed');
	} else {
		alert('Game is in progress');
	}
}

/*
function setGoal() {
	if(!gamePlaying) {
		goalScore = prompt('Enter the score (default is 100)');
		alert('Score has changed');
	} else {
		alert('Game is in progress');
	}
}
*/