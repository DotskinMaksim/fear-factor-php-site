# Hirmude maja

## Sisukord
1. [Projekti kohta](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#Projekti-kohta)
2. [Loojad](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#Loojad)
3. [Projekti eesmärgid](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#Projekti-eesmärgid)
4. [Kirjeldus](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#Kirjeldus)
   - [Info](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#index.php)
   - [Sisenes](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#sisenes.php)
   - [Ostamine](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#ostamine.php)
   - [Minu piletid](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#minuPiletid.php)
   - [Tabelid](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#tabelid.php)
   - [Autoriseerimine](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#registreerimine/sisseLogimine.php)
5. [Järeldus](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#Järeldus)
6. [Link](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/README.md#Link)


## Projekti kohta
Saiti on vaja hirmumajja pileti ostmiseks ja külastajate kontrollimiseks


## Loojad
[@MaksimDotskin](https://github.com/MaksimDotskin)

## Projekti eesmärgid
- [x] Looge veebisait, et osta pileteid hirmumajadesse ja vaadata seal viibivaid inimesi
- [x] Piletiga külastuste jälgimiseks looge administraatori leht
- [x] Registreerimine saidil
- [x] Andmebaasiga ühendus
      
## Kirjeldus
Veebisaidil on järgmised leheküljed:


### index.php:
Põhilised kohad, kontaktid ja fotod, avaleht.


### sisenes.php:
Lehekülg, kus saab vaadata hirmumajas viibivaid inimesi ja nende viibimise aega, ning administraator saab märkida külastajate sisenemise ja väljumise nende pileti ID ja ostja ID kaudu. On kehtivuse kontroll pileti ja ID järgi.
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/sisenes.png)



### ostamine.php:
Lehekülg, kus on 3 sektsiooni - 


#### Vaatamine:
Siin saab ostja vaadata olemasolevaid piletitüüpe, nende hindu ja muud teavet ning lisada need ostukorvi.
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/vaatamine.png)


#### Makseviisid:
Siin saab vaadata olemasolevaid makseviise ja lisada uue vormi kaudu ning vajadusel kustutada.

![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/makseviisid.png)


#### Ostukorv:
Siin saab vaadata ostukorvi, vajadusel midagi eemaldada ning lugeda läbi lepingu maksmise kohta eelnevalt lisatud makseviisiga.
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/ostukorv.png)



### minuPiletid.php:
Siin saab ostja vaadata juba ostetud pileteid, näha nende kehtivusaega ja pileti ID-d ning oma ID-d, et hiljem sisenemisel näidata.
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/minupiletid.png)


### tabelid.php:
See on administraatoripaneel, kus ta saab vaadata kõiki andmebaasi tabeleid, välja arvatud makseviisid. Kasutajad, piletid, hirmumaja. Samuti saab ta kustutada mis tahes kirjeid tabelist ning määrata uusi administraatoreid.
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/admin.png)


### registreerimine/sisseLogimine.php:
Sisselogimis- ja registreerimisvormid. Parooli turvalisuse kontrollimine.
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/logisisse.png)
![pilt](https://github.com/MaksimDotskin/Hirmude-maja/blob/main/hirmumaja/pildid/registreerimine.png)


## Järeldus
Kõik leheküljed omavad ühist hirmumaja stiilis disaini, kogu kood on kommenteeritud, iga lehekülje funktsioonid SQL-operatsioonide ja muude funktsioonidega on eraldi PHP-failis. Samuti koos skripti ja mõnel juhul stiilidega. See on tehtud arenduse optimeerimise ja kasutusmugavuse tagamiseks.

##Link
[Hirmude maja](https://maksimdotskin22.thkit.ee/andmebaasid/hirmumaja/index.php)

