<!--see leht on mõeldud pileti ostmiseks, makseviisi lisamiseks kaardi näol, -->
<!--ostukorvi vaatamiseks ja piletite eest tasumiseks-->
<?php
session_start();
require_once ('../konf.php');
require_once ('../funktsioonid.php');
require_once ('ostamine_funktsioonid.php');

//ühendage vajalikud failid


//et saaksite brauseris koodi lugeda
if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}
//kui otsustakse makseviisi kustutada, helistame funktsioonile
if (isset($_GET["kustutaMakseViis"])) {
    $makseId = $_GET["kustutaMakseViis"];
    kustutaMakseviis($makseId);
    exit();

}


//kui otsustakse osta piletid, helistame funktsioonile

if (isset($_REQUEST['osta'])){
    ostamine();
    exit();
}

//kui otsustakse lisada soodus pilet ostukorvasse, helistame funktsioonile
if (isset($_REQUEST['lisaSoodusPilet'])){
    $_SESSION['soodusPiletiOstukorvis'] ++;
    header("location: ostamine.php?onLisatud");
    exit();
}

//kui otsustakse lisada lapse pilet ostukorvasse, helistame funktsioonile
if (isset($_REQUEST['lisaLapsePilet'])){
    $_SESSION['lapsePiletiOstukorvis'] ++;
    header("location: ostamine.php?onLisatud");
    exit();
}

//kui otsustakse lisada tavaline pilet ostukorvasse, helistame funktsioonile
if (isset($_REQUEST['lisaTavPilet'])){
    $_SESSION['tavPiletiOstukorvis'] ++;
    header("location: ostamine.php?onLisatud");
    exit();
}


//kui otsustakse kustada soodus pilet ostukorvist, helistame funktsioonile
if (isset($_REQUEST['kustSoodusPilet'])){
    $_SESSION['soodusPiletiOstukorvis'] --;
    header("location: ostamine.php?ostukorv");
    exit();
}

//kui otsustakse kustada lapse pilet ostukorvist, helistame funktsioonile
if (isset($_REQUEST['kustLapsePilet'])){
    $_SESSION['lapsePiletiOstukorvis'] --;
    header("location: ostamine.php?ostukorv");
    exit();
}

//kui otsustakse kustada tavaline pilet ostukorvist, helistame funktsioonile
if (isset($_REQUEST['kustTavPilet'])){
    $_SESSION['tavPiletiOstukorvis'] --;
    header("location: ostamine.php?ostukorv");
    exit();
}

//kui otsustakse lisada uus makseviis, helistame funktsioonile
if (isset($_REQUEST['saada'])){
    lisaMakseviis();
    header("location: ostamine.php?makseviisid");
    exit();
}
?>


<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ostamine</title>
    <link rel="stylesheet" href="ostamine_style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="ostamine_script.js" ></script>
</head>

<!--nupu deaktiveerimise skripti funktsiooni laadimine sõltuvalt lehe jaotisest-->
<?php if (isset($_REQUEST["makseviisid"]) ): ?>
<body onload="onLoadMaks()" >
<?php elseif (isset($_REQUEST["ostukorv"]) ): ?>
<body onload="onLoadOst()" >
<?php else : ?>
<body>
<?php endif; ?>

<header>
    <div class="konteiner">
        <!--        kui kasutaja on sisse logitud, kuvame tema nimega tervituse ja kui ei, siis lihtsalt tervitus-->
        <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
        <?php else : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
        <?php endif; ?>

        <!--        navigeerimismenüü-->
        <nav>
            <ul>
                <li><a href="../index.php">Info</a></li>
                <li><a href="../sisenes/sisenes.php">Sisenes</a></li>
                <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
                <li><a href="omaPiletid.php">Minu piletid</a></li>
                <li><a href="../autoriseerimine/logiValja.php">Logi välja</a></li>

            </ul>
        </nav>
        <br>
        <!--   teine   navigeerimismenüü-->
        <nav>
            <ul>
            <li><a href="ostamine.php">Vaatamine</a></li>
            <li><a href="ostamine.php?ostukorv">Ostukorv</a></li>
            <li><a href="ostamine.php?makseviisid">Makseviisid</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>

<!--    kui klõpsate makseviiside jaotist-->
<?php if (isset($_REQUEST["makseviisid"]) ): ?>
<section class="makseViisid">
    <div class="konteiner">
    <table>
        <thead>
            <tr>
                <th colspan="3">Minu makseviisid</th>
            </tr>
        </thead>
        <tbody>
<!--     helistame php funktsioon mis naitab makseviid tabelis-->
            <?php  naitaMakseviisid('tabelis'); ?>
        </tbody>
    </table>


    <br>
    <form action="" method="post">
<!--     vorm kaardiandmete teatud mustritega täitmiseks-->
        <label for="card_number">Kardi number:</label>
        <input type="text" id="kardiNumber" name="kardiNumber" placeholder="1234 5678 9101 1121" required oninput="saadamineKontroll()">

        <label for="card_name">Omaniku nimi:</label>
        <input type="text" id="kardiNimi" name="kardiNimi" placeholder="Sisestage..." required oninput="saadamineKontroll()">

        <div style="display: flex;">
            <div style="flex: 1; margin-right: 10px;">
                <label for="expiry_date">Kehtivus:</label>
                <input type="text" id="kehtivus" name="kehtivus" placeholder="KK/AA" pattern="\d{2}/\d{2}" title="Sisestage KK/AA vormingus aegumiskuupäev" required oninput="saadamineKontroll()">
            </div>
            <div style="flex: 1;">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="###" maxlength="3" pattern="\d{3}" title="VV koosneb 3 numbrist" required oninput="saadamineKontroll()">
            </div>
        </div>


        <br>
        <br>
        <input type="submit" value="Saada" name="saada" id="saada">
    </form>
    </div>
</section>
    <!-- kui klõpsate ostukorvi jaotist-->

<?php elseif (isset($_REQUEST["ostukorv"]) ): ?>

<section class="ostukorv">
    <div class="konteiner">

        <table>
            <thead>
            <tr>
                <th colspan="5">Ostukorv</th>
            </tr>
            </thead>
            <tbody>
            <!--helistame php funktsioon mis naitab piletid ostukorvist tabelis-->

            <?php naitaOstukorvist();
            ?>

            </tbody>
        </table>

        <form action="">

            <!--helistame php funktsioon mis naitab arvub summa-->

                <h3>Kokku: <?php arvutaKokku(); ?></h3>
            <input type="hidden" value="<?php echo arvutaKokku(); ?>" id="kokku">

            <br>
            <div class="makse">
                <h3>Makseviis</h3>
                <select id="selectMakseviisid" name="selectMakseviisid" onchange="ostamineKontroll()">
                    <!-- helistame php funktsioon mis naitab makseviid option-select-is -->
                    <?php naitaMakseViisid('option'); ?>
                </select>
                <br>
                <br>
<!--         ostja kinnitus, et ta on reeglitega tutvunud ja -->
<!--          nõustub sellega, kuni ostunupp ei sütti enne, kui ta on kinnitanud-->
                <input type="checkbox" name="checkbox" id="checkbox" oninput="ostamineKontroll()">
                Olen <a href="leping.php">lepingu</a> läbi lugenud ja nõustun sellega
            </div>
            <br>
            <br>
            <input type="submit" value="Osta"  name="osta" id="osta">
        </form>
    </div>
</section>


    <!--    kui klõpsate pileti vaatamise jaotist-->
<?php else : ?>
    <section class="Piletid">
        <div class="konteiner">

<!-- koht kus tagastab vastus et pilet on lisatud ostukorvi-->
        <div id="vastus"></div>

        <script>
            // kui pilet on lisatud ostukorvi naitame kirja seda eest mis kaob 3 sekundi parast
            <?php if (isset($_GET['onLisatud'])) : ?>
            document.getElementById('vastus').innerHTML = "<span style=\"color: green; text-align: center;\">On lisatud ostukorvi</span>";
            setTimeout(function() {
                document.getElementById('vastus').innerHTML = '';
            }, 3000);
            <?php endif; ?>
        </script>


<!--   tavaline pilet-->
        <form action="">
            <div class="PiletDiv">
                <div class="PiletHeader">
                    <h2>Tavaline pilet</h2>
                </div>
                <div class="PiletKirjeldus">
                    <p>Tallinna Hirmudemajja ühekordse külastuse pilet täiskasvanule</p>
                </div>
                <div class="PiletInfo">
                    <span>On kehtiv pool aastat</span>

                </div>
                <div class="PiletInfo">
                    <span>Koht: Tallinna hirmude maja | Sõpruse pst 182, 13424 Tallinn</span>
                </div>
                <div class="PiletInfo">
                    <span>Hind: 10€</span>
                    <form action=""><input type="submit" name="lisaTavPilet" value="+" class="PiletLisaNupp">
                </div>
            </div>


<!--   lapse pilet-->
            <div class="PiletDiv">
                <div class="PiletHeader">
                    <h2>Lapse pilet</h2>
                </div>
                <div class="PiletKirjeldus">
                    <p>Tallinna Hirmudemajja ühekordse külastuse pilet alla 7-aastasele lapsele</p>
                </div>
                <div class="PiletInfo">
                    <span>On kehtiv 1 aasta</span>

                </div>
                <div class="PiletInfo">
                    <span>Koht: Tallinna hirmude maja | Sõpruse pst 182, 13424 Tallinn</span>
                </div>
                <div class="PiletInfo">
                    <span>Hind: 5€</span>
                    <input type="submit" name="lisaLapsePilet" value="+" class="PiletLisaNupp">
                </div>
            </div>


<!--     soodus pilet-->

            <div class="PiletDiv">
                <div class="PiletHeader">
                    <h2>Soodus pilet</h2>
                </div>
                <div class="PiletKirjeldus">
                    <p>Tallinna Hirmudemajja ühekordse külastuse pilet pensionäridele, puuetega inimestele ja õpilastele</p>
                </div>
                <div class="PiletInfo">
                    <span>On kehtiv pool aastat</span>

                </div>
                <div class="PiletInfo">
                    <span>Koht: Tallinna hirmude maja | Sõpruse pst 182, 13424 Tallinn</span>
                </div>
                <div class="PiletInfo">
                    <span>Hind: 8€</span>
                    <input type="submit" name="lisaSoodusPilet" value="+" class="PiletLisaNupp">
                </div>

            </div>
        </form>
        </div>
    </section>


<?php endif; ?>
</main>
<!-- footer-->
    <?php include '../elemendid/footer.php'; ?>

</body>
</html>
<?php
