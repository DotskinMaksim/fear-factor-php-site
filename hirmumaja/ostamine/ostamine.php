<?php
session_start();
require_once ('../konf.php');
require_once ('../funktsioonid.php');
require_once ('ostamine_funktsioonid.php');

if (isset($_GET["kustutaMakseViis"])) {
    $makseId = $_GET["kustutaMakseViis"];
    kustutaMakseviis($makseId);
    exit();

}


if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}


if (isset($_REQUEST['tagasi'])){
    header("location: ../sisenes.php");
    exit();
}

if (isset($_REQUEST['osta'])){
    ostamine();
    exit();
}
if (isset($_REQUEST['lisaSoodusPilet'])){
    $_SESSION['soodusPiletiOstukorvis'] ++;
    header("location: ostamine.php?onLisatud");
    exit();
}
if (isset($_REQUEST['lisaLapsePilet'])){
    $_SESSION['lapsePiletiOstukorvis'] ++;
    header("location: ostamine.php?onLisatud");
    exit();
}
if (isset($_REQUEST['lisaTavPilet'])){
    $_SESSION['tavPiletiOstukorvis'] ++;
    header("location: ostamine.php?onLisatud");
    exit();
}



if (isset($_REQUEST['kustSoodusPilet'])){
    $_SESSION['soodusPiletiOstukorvis'] --;
    header("location: ostamine.php?ostukorv");
    exit();
}
if (isset($_REQUEST['kustLapsePilet'])){
    $_SESSION['lapsePiletiOstukorvis'] --;
    header("location: ostamine.php?ostukorv");
    exit();
}
if (isset($_REQUEST['kustTavPilet'])){
    $_SESSION['tavPiletiOstukorvis'] --;
    header("location: ostamine.php?ostukorv");
    exit();
}

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
        <body onload="onLoadMaks()" >

        <?php include '../elemendid/header.php'; ?>

        <nav>
            <ul>

            <li><a href="../sisenes/sisenes.php">Sisenes</a></li>

            <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
            <li><a href="omaPiletid.php">Minu piletid</a></li>
            <li><a href="../autoriseerimine/logiValja.php">Log out</a></li>

            </ul>
        </nav>
        <nav>
            <ul>
            <li><a href="ostamine.php">Vaatamine</a></li>
            <li><a href="ostamine.php?ostukorv">Ostukorv</a></li>
            <li><a href="ostamine.php?makseviisid">Makseviisid</a></li>
            </ul>
        </nav>
        <main>


    <?php if (isset($_REQUEST["makseviisid"]) ): ?>

        <section class="makseViisid">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">Minu makseviisid</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  naitaMakseviisid('tabelis'); ?>
                </tbody>
            </table>




            <form action="" method="post">
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



                <input type="submit" value="Saada" name="saada" id="saada">
            </form>
        </section>

    <?php elseif (isset($_REQUEST["ostukorv"]) ): ?>
        <body onload="onLoadOst()" >


        <section class="ostukorv">

                <table>
                    <thead>
                    <tr>
                        <th colspan="4">Ostukorv</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php naitaOstukorvist();
                    ?>

                    </tbody>
                </table>
                <form action="">

                <h3>Kokku: <?php arvutaKokku(); ?></h3>
                <input type="hidden" value="<?php echo arvutaKokku(); ?>" id="kokku">

                Makseviis:
                <select id="selectMakseviisid" name="selectMakseviisid" onchange="ostamineKontroll()">
                    <?php naitaMakseViisid('option'); ?>
                </select>
                <br>
                <input type="checkbox" name="checkbox" id="checkbox" oninput="ostamineKontroll()">
                Olen <a href="leping.php">lepingu</a> läbi lugenud ja nõustun sellega
                <br>
                <input type="submit" value="Osta"  name="osta" id="osta">
                <input type="submit" value="Tagasi"  name="tagasi">
                </form>
            </section>



        <?php else : ?>
        <body>

            <section class="Piletid">
                <div id="vastus"></div>

                <script>
                    <?php if (isset($_GET['onLisatud'])) : ?>
                    document.getElementById('vastus').innerHTML = "<span style=\"color: green; text-align: center;\">On lisatud ostukorvi</span>";
                    setTimeout(function() {
                        document.getElementById('vastus').innerHTML = '';
                    }, 2000);
                    <?php endif; ?>
                </script>



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
            </section>


        <?php endif; ?>
        </main>

            <?php include '../elemendid/footer.php'; ?>

        </body>
    </html>
<?php
