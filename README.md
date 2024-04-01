# Hirmude maja

## Loojad
**Looja:** @MaksimDotskin

## Projekti eesmärgid
- [x] Looge veebisait, et osta pileteid hirmumajadesse ja vaadata seal viibivaid inimesi
- [x] Piletiga külastuste jälgimiseks looge administraatori leht
- [x] Registreerimine saidil
- [x] Andmebaasiga ühendus
      
## Kirjeldus
Veebisaidil on järgmised leheküljed:

### index.php - Põhilised kohad, kontaktid ja fotod, avaleht.

### sisenes.php - Lehekülg, kus saab vaadata hirmumajas viibivaid inimesi ja nende viibimise aega, ning administraator saab märkida külastajate sisenemise ja väljumise nende pileti ID ja ostja ID kaudu. On kehtivuse kontroll pileti ja ID järgi.

### ostamine.php - Lehekülg, kus on 3 sektsiooni - Vaatamine: Siin saab ostja vaadata olemasolevaid piletitüüpe, nende hindu ja muud teavet ning lisada need ostukorvi. Makseviisid: Siin saab vaadata olemasolevaid makseviise ja lisada uue vormi kaudu ning vajadusel kustutada. Ostukorv: Siin saab vaadata ostukorvi, vajadusel midagi eemaldada ning lugeda läbi lepingu maksmise kohta eelnevalt lisatud makseviisiga.

### minuPiletid.php - Siin saab ostja vaadata juba ostetud pileteid, näha nende kehtivusaega ja pileti ID-d ning oma ID-d, et hiljem sisenemisel näidata.

### tabelid.php - See on administraatoripaneel, kus ta saab vaadata kõiki andmebaasi tabeleid, välja arvatud makseviisid. Kasutajad, piletid, hirmumaja. Samuti saab ta kustutada mis tahes kirjeid tabelist ning määrata uusi administraatoreid.

### registreerimine/sisseLogimine.php - Sisselogimis- ja registreerimisvormid. Parooli turvalisuse kontrollimine.

Kõik leheküljed omavad ühist hirmumaja stiilis disaini, kogu kood on kommenteeritud, iga lehekülje funktsioonid SQL-operatsioonide ja muude funktsioonidega on eraldi PHP-failis. Samuti koos skripti ja mõnel juhul stiilidega. See on tehtud arenduse optimeerimise ja kasutusmugavuse tagamiseks.
