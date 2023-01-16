Pattern_GAME

Komentari dopunjeni tako da temeljno objasne nacin rada koda.
Razlozi zbog kojih su neka resenja sub-optimalna ili zbunjujuca u su u ovom file-u u napomenama.

Opis: 

Pattern_GAME je projekat ciji je cilj bio napraviti event-driven-u aplikaciju koristeci osnovni ES6 sa i Jquery.
Pattern_GAME je igra u kojoj igrac pamti i ponavlja sablone boja koje su mu zadate.

Napomene:

Audio ne radi. Dosta browsera blokira audio iz skripti i nisam mogao da nadjem nacin da to zaobidjem (sigurno je moguce, ali projekat radi i bez njega, tj. audio je opcioni i ostavio sam ga tako).
Takodje, kod nece raditi na masinama bez pristupa internetu.

- line 67:
posto audio ima problema sa pretrazivacima na nekima nece raditi. Mnogi ce izbaciti gresku da audio nije u redu.
audio.muted = true je u kodu da mi pretrazivaci ne izbacuju gresku i ne moram da izbacujem sve sto ima veze sa Audio() iz koda .

- line 140:
ne postoji handle za pokretanje funkcije nextSequence(). Igrac moze da prelazi nivoe tako sto ce samo pritiskati dugmice po tastaturi bez ijednog pogodjenog sablona boja.