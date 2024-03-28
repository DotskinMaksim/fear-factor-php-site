<?php
session_start();
require_once ('funktsioonid.php');


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
    <style>

    </style>

</head>
<body onload="onLoad()">
<header>
    <div class="konteiner">
        <h1><a href="index.php" class="koduleht-a">Hirmude maja</a></h1>


        <nav>
            <ul>
                    <li><a href="sisenes/sisenes.php">Sisenes</a></li>

                <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <?php if (!onAdmin()) : ?>
                    <li><a href="ostamine/ostamine.php">Osta pilet</a></li>
                    <li><a href="ostamine/omaPiletid.php">Minu piletid</a></li>
                <?php else : ?>
                    <li><a href="admin/tabelid.php">Admini paneel</a></li>
                <?php endif; ?>
                    <li><a href="autoriseerimine/logiValja.php">Logi välja</a> </li>
                <?php else : ?>
                    <li><a href="autoriseerimine/logiSisse.php">Logi sisse</a></li>
                    <li><a href="autoriseerimine/registreerimine.php">Registreeri</a></li>


            <?php endif; ?>
            </ul>


        </nav>
    </div>
</header>

<main class="koduleht-main">
    <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
    <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
    <?php else : ?>
    <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
    <?php endif; ?>



    <section class="kirjeldus">
        <h2>Kirjeldus</h2>
        <p>Tere tulemast õuduse maailma, kus ootavad teid kõige kohutavamad katsumused. Valmistuge oma piire ja hirme proovile panema</p>
        <div>
        <?php if (!isset($_REQUEST['info'])) : ?>

        <a href="index.php?info">Rohkem info</a>
        <?php else : ?>
            <a href="index.php">Sulge</a>

        <?php endif; ?>
        </div>

    </section>
    <?php if (isset($_REQUEST['info'])) : ?>

        <section class="rohkem-info">
            <h2>Hirmude Maja</h2>
            <p>Hirmude Maja pole lihtsalt lõbustuskoht, see on unikaalne maailm, kus kohtuvad teie sügavaimad hirmud ja fantaasiad. Siin igat tuba, igat detaili on loodud selleks, et sukelduda külastajaid uskumatu pinge ja hirmu õhkkonda.</p>
            <p>Hirmude Maja lugu algas palju aastaid tagasi, kui grupp kirevaid õudusearmastajaid otsustas ühendada oma jõud, et luua midagi tõeliselt ainulaadset. Meie asutajad - inimesed, kes alati unistasid sellest, et jagada oma kiret ühaste armastustega maailmaga. Nad tõid oma ande, loovuse ja aastatepikkuse kogemuse meelelahutustööstusesse, et muuta see unistus tegelikkuseks.</p>
            <p>Sellest ajast peale on Hirmude Maja saanud ekstreemsete meelelahutuste sümboliks ja kohaks, kuhu inimesed tulevad, et kogeda tõelist adrenaliini ja sukelduda tõelise hirmu õhkkonda. Meie hirmutubade ja näitlejate loodud ainulaadsed stsenaariumid panevad külastajaid tundma end osana elavast kohutavast filmist.</p>
            <p>Hirmude Maja pole lihtsalt koht, kus saate kohkuda. See on koht, kus saate kogeda uusi emotsioone, ületada oma hirme ja luua mälestusi, mis jäävad teiega igavesti. Tere tulemast maailma, kus reaalsus sulab kokku fantaasiaga ja hirm saab teieks liitlaseks unustamatus seikluses.</p>
        </section>


    <?php endif; ?>


    <br>
    <section class="meist">
        <h2>Meist</h2>
        <p>Oleme professionaalsetest õudusfilmitegijatest koosnev meeskond, kes loob teie nautimiseks kõige põnevamaid hirmutubasid</p>
        <!-- Здесь можно добавить фотографии или видео с комнатами страха -->
        <div class="galerii">
            <img src="pildid/info1.jpeg" alt="Kirjeldus 1">
            <img src="pildid/info2.jpeg" alt="Kirjeldus 2">
            <img src="pildid/info3.jpeg" alt="Kirjeldus 3">
        </div>
    </section>

    <!-- Дополнительные разделы можно добавить по мере необходимости -->
</main>

    <?php include 'elemendid/footer.php'; ?>
</body>
</html>



