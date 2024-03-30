<?php
session_start();

//see leht on kasutaja põhiteabega saidi sisenemispunkt


require_once ('funktsioonid.php');
//ühendage vajalikud failid


//et saaksite brauseris koodi lugeda
if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

?>
<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hirmude maja</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<!--funktsioon lehe laadimisel-->
<body onload="onLoad()">
<header>
    <div class="konteiner">
<!-- kui kasutaja on sisse logitud, kuvame tema nimega tervituse ja kui ei, siis lihtsalt tervitus-->
        <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
        <?php else : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
        <?php endif; ?>
<!-- navigeerimismenüü-->
        <nav>
            <ul>
                <li><a href="index.php">Info</a></li>
                <li><a href="sisenes/sisenes.php">Sisenes</a></li>

<!-- kuva menüüelemendid olenevalt kasutaja olekust-->
                <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <!--  kui pole admin-->
                    <?php if (!onAdmin()) : ?>
                        <li><a href="ostamine/ostamine.php">Osta pilet</a></li>
                        <li><a href="ostamine/omaPiletid.php">Minu piletid</a></li>
            <!--  kui admin-->
                    <?php else : ?>
                        <li><a href="admin/tabelid.php">Admini paneel</a></li>
                    <?php endif; ?>
                    <li><a href="autoriseerimine/logiValja.php">Logi välja</a> </li>
            <!-- kui kasutaja pole sisse logitud-->
                <?php else : ?>
                    <li><a href="autoriseerimine/logiSisse.php">Logi sisse</a></li>
                    <li><a href="autoriseerimine/registreerimine.php">Registreeri</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<main class="koduleht-main">
<!-- sissejuhatus-->
    <section class="intro">
        <div class="konteiner">
            <h2>Hirmud muutuvad reaalsuseks</h2>
            <p>Valmistuge uskumatuks sukeldumiseks õudusmaailma, kus miski pole see, mis näib.</p>
        </div>
    </section>

<!-- kirjeldus-->
    <section class="kirjeldus">
        <div class="konteiner">
            <h2>Kirjeldus</h2>
            <p>Tere tulemast õuduse maailma, kus ootavad teid kõige kohutavamad katsumused. Valmistuge oma piire ja hirme proovile panema.</p>
            <div>
<!--   rohkem infot nupp selle kohta-->
            <?php if (!isset($_REQUEST['info'])) : ?>
                <a href="index.php?info">Rohkem info</a>
            <?php else : ?>
                <a href="index.php">Sulge</a>

            <?php endif; ?>
            </div>
        </div>
    </section>
<!-- kui klõpsasite rohkem teavet-->
    <?php if (isset($_REQUEST['info'])) : ?>
        <section class="rohkem-info">
            <div class="konteiner">
                <h2>Hirmude Maja</h2>
                <p>Hirmude Maja pole lihtsalt lõbustuskoht, see on unikaalne maailm, kus kohtuvad teie sügavaimad hirmud ja fantaasiad. Siin igat tuba, igat detaili on loodud selleks, et sukelduda külastajaid uskumatu pinge ja hirmu õhkkonda.</p>
                <p>Hirmude Maja lugu algas palju aastaid tagasi, kui grupp kirevaid õudusearmastajaid otsustas ühendada oma jõud, et luua midagi tõeliselt ainulaadset. Meie asutajad - inimesed, kes alati unistasid sellest, et jagada oma kiret ühaste armastustega maailmaga. Nad tõid oma ande, loovuse ja aastatepikkuse kogemuse meelelahutustööstusesse, et muuta see unistus tegelikkuseks.</p>
                <p>Sellest ajast peale on Hirmude Maja saanud ekstreemsete meelelahutuste sümboliks ja kohaks, kuhu inimesed tulevad, et kogeda tõelist adrenaliini ja sukelduda tõelise hirmu õhkkonda. Meie hirmutubade ja näitlejate loodud ainulaadsed stsenaariumid panevad külastajaid tundma end osana elavast kohutavast filmist.</p>
                <p>Hirmude Maja pole lihtsalt koht, kus saate kohkuda. See on koht, kus saate kogeda uusi emotsioone, ületada oma hirme ja luua mälestusi, mis jäävad teiega igavesti. Tere tulemast maailma, kus reaalsus sulab kokku fantaasiaga ja hirm saab teieks liitlaseks unustamatus seikluses.</p>
            </div>
        </section>
    <?php endif; ?>

<!--töötaja teave-->
    <section class="meist">
        <div class="konteiner">
            <h2>Meist</h2>
            <p>Oleme professionaalsetest õudusfilmitegijatest koosnev meeskond, kes loob teie nautimiseks kõige põnevamaid hirmutubasid.</p>
            <!-- Pildid-->
            <div class="galerii">
                <img src="pildid/info1.jpeg" alt="Kirjeldus 1">
                <img src="pildid/info2.jpeg" alt="Kirjeldus 2">
                <img src="pildid/info3.jpeg" alt="Kirjeldus 3">
            </div>
        </div>
    </section>
<!-- sidevahendid-->
    <section class="kontakt">
        <div class="konteiner">
            <h2>Võta meiega ühendust</h2>
            <p>Tel: 1234-5678</p>
            <p>Meil: info@hirmude-maja.ee</p>
        </div>
    </section>
</main>
<!-- footer-->
    <?php include 'elemendid/footer.php'; ?>
</body>
</html>