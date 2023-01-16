DICE_GAME

Komentari dopunjeni tako da temeljno objasne nacin rada koda.
Razlozi zbog kojih su neka resenja sub-optimalna ili zbunjujuca u su u ovom file-u u napomenama.

Opis:

Cilj projekta je prikaz osnovnih principa programiranja koristeci ES5 JavaScript. 
Osmisljen je kao igra kockicama gde igraci bacaju kocke i tako povecavaju svoje trenutne poene. 
Pravila:
- Poeni se racunaju kao zbir brojeva sa kocki. U bilo kom trenutku igrac moze da odluci da sacuva svoje poene u svoj trajni skor
- Igrac koji dobije jedinicu na kocki gubi svoj trenutni skor i red je na drugog igraca da baca kocke
- Igrac koji dobije 6 na istoj kocki sa koje je rezultat bio 6 na proslom bacanju gubi ne samo trenutne vec i trajne poene
- Prvi do 100 pobedjuje. U slucaju da igra nije u toku, pobednicki skor moze biti izmenjen


Napomene: 

- line 138:
obicno bi trebalo da postoje 2 razlicite funkcije za pokretanje igre: inicijalizacija i restartovanje.
Da bi ustedeo na vremenu i jednostavije pisao kod, koristimo istu funkciju za oba slucaja (zbog cega imamo napomene ispod)
c
- line 208: 
iako smo koristili gamePlaying flag kao proveru da li je igra u toku ili ne
nismo ga koristili ovde jer btn-new poziva init() funkciju - tako sam ustedeo na pisanju nove funkcije npr. newGame(), restart()... 
ali onda imam konflikte sa gamePlaying jer nakon zavrsetka igre ide na false, sto bi znacilo da igraci mogu da menjaju target score samo
onda kada je igra zavrsena -> moraju barem jednu igru da odigraju do 100
Projekat nije bio zamisljen kao zavrsena aplikacija vec primer i nije ispeglan, te elegantnijih resenja nece biti

- line 213:
opet, projekat nije planiran kao utegnuta aplikacija, pa nema handle za promenu rezultata u prompt-u
Korisnik moze vrlo lako da srusi igru tako sto ce uneti bilo sta sto nije broj.