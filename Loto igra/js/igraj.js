var ime = null;
var prezime = null;
var email = null;
var uslovi = null;
var imenaPoljaZaOdabir = ["prvo", "drugo","trece", "cetvrto", "peto", "sesto", "sedmo"];


var dobrodosliAlert = function() {
    alert("Dobrodosli na Loto izvlacenje");
};

var proveriIZapocni = function() {
    ime = document.korisnik.ime.value;
    prezime = document.korisnik.prezime.value;
    email = document.korisnik.email.value;
    uslovi = document.korisnik.usloviIgre.checked;

    var test = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var provera = email.match(test);

    if (provera !== null && uslovi === true && ime && prezime) {
        zapocni();
    } else if (uslovi !== true) {
        alert("Molimo Vas prihvatite uslove fer igra.");
    } else if (provera === null) {
        alert("Email nije validan.");
    } else {
        alert("Molimo Vas da popunite sve podatke.")
    }
};

var zavrtiBubanj = function() {

    var odabraniBrojevi = [];

    for (var i=0; i<imenaPoljaZaOdabir.length; i++){

        var imeElementa = imenaPoljaZaOdabir[i];
        var odabraniBroj = document.odabraniBrojevi[imeElementa].value;
        odabraniBrojevi.push(odabraniBroj);
    }

    for (var i=0; i<odabraniBrojevi.length; i++){
        var odabraniBroj = odabraniBrojevi[i];
        if(odabraniBroj<1 || odabraniBroj>40 || !odabraniBroj){
            alert("Odabrani brojevi nisu validni.");
            return;
        }

    }

    var randomBrojevi = [];

    while(randomBrojevi.length < 7) {

        var random = Math.floor(Math.random() * (40 - 1 + 1)) + 1;
        if (!randomBrojevi.includes(random)) {
           randomBrojevi.push(random);
        }
    }

    var brojPogodjenih = 0;
    for(var i=0; i<randomBrojevi.length; i++){
        var randomBroj = randomBrojevi[i];
        if(odabraniBrojevi.includes(randomBroj)){
            brojPogodjenih = brojPogodjenih+1;
        }
    }

    var rezultat = window.open();

    rezultat.document.write("<html>");

    rezultat.document.write("<head>");
    rezultat.document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/rezultat.css\">")
    rezultat.document.write("</head>");

    rezultat.document.write("<body>");
    rezultat.document.write("<div class=\"numbers\">");
    for(var i=0; i<randomBrojevi.length; i++) {
      var randomBroj = randomBrojevi[i];
      rezultat.document.write('<div class=\"number-wrapper\">');
      rezultat.document.write('<p class=\"number\">'+randomBroj+'</p>');
      rezultat.document.write('</div>');
    }
    rezultat.document.write('</div>');
    rezultat.document.write('<div class=\"result\">');
    rezultat.document.write("<h2 align='center'> Zdravo " + ime + " " + prezime + "</h2>");
    rezultat.document.write("<h2 align='center'> Pogodili ste: " + brojPogodjenih + " od 7</h2>");
    rezultat.document.write("<h4 align='center'>*Napomena: Rezultati ove igre bice vam dostavljeni na email adresu " + email + "</h2>");
    rezultat.document.write("</div>");
    rezultat.document.write("</body>");

    rezultat.document.write("</html>");
};

var zapocni = function(){
    var danas = new Date();
    var daniUNedelji = ["Nedelja", "Ponedeljak", "Utorak", "Sreda", "Cetvrtak", "Petak", "Subota"];
    var danUNedelji = daniUNedelji[danas.getDay()];
    var dan = danas.getDate();
    var godina = 1900+danas.getYear();
    var mesec = danas.getMonth()+1;
    var sat = danas.getHours();
    var minut = danas.getMinutes();
    var sekund = danas.getSeconds();

    var loginForma = document.getElementById('login');
    loginForma.style.display = 'none';
    var game = document.getElementById('game');
    game.style.display = 'flex';

    var vremeDiv = document.getElementById('vreme');
    vremeDiv.innerText = vremeDiv.innerText + sat+":"+minut+":"+sekund+", "+danUNedelji+" "+dan+"."+mesec+"."+godina;


    var odabirBrojevaElement = document.getElementById("odabirBrojeva");

    for(var i = 0; i < imenaPoljaZaOdabir.length; i++) {
        var input = document.createElement('input');
        input.type = 'number';
        input.name = imenaPoljaZaOdabir[i];
        input.min = 1;
        input.max = 40;
        odabirBrojevaElement.appendChild(input);
    }
};
