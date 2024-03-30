<?php
//siin on paneel hirmuamaja, kasutaja ja pileti tabeliga
//mis saab kasutada ainult admin

session_start();
require_once ('../funktsioonid.php');
require_once ('tabelid_funktsioonid.php');
//ühendage vajalikud failid



//kui valitud kustuta kasutaja
if (isset($_GET["kustutaKasutaja"])) {
    //votame id ja helisatame funktsioon
    $kasutajaId = $_GET["kustutaKasutaja"];
    kustutaKasutaja($kasutajaId);
    exit();

}

//kui valitud kustuta pilet
if (isset($_GET["kustutaPilet"])) {
    //votame id ja helisatame funktsioon
    $piletId = $_GET["kustutaPilet"];
    kustutaPilet($piletId);
    exit();

}

//kui valitud kustuta hirmumaja kylastus
if (isset($_GET["kustutaHirmumaja"])) {
    //votame id ja helisatame funktsioon
    $hirmId = $_GET["kustutaHirmumaja"];
    kustutaHirmumaja($hirmId);
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
    <title>Admini paneel</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

<header>
    <div class="konteiner">
        <!--  kui kasutaja on sisse logitud, kuvame tema nimega tervituse ja kui ei, siis lihtsalt tervitus-->
        <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
        <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
    <?php else : ?>
        <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
    <?php endif; ?>

        <!--navigeerimismenüü-->
        <nav>
        <ul>
        <li><a href="../index.php">Info</a></li>

        <li><a href="../sisenes/sisenes.php">Sisenes</a></li>

        <li><a href="../admin/tabelid.php">Admini paneel</a></li>

        <li><a href="../autoriseerimine/logiValja.php">Logi välja</a></li>
        </ul>

    </nav>
        <br>
        <!--   teine  admini navigeerimismenüü-->
        <nav>
        <ul>
        <li><a href="tabelid.php">Kasutajad</a></li>
        <li><a href="tabelid.php?piletid">Piletid</a></li>
        <li><a href="tabelid.php?hirmumaja">Hirmumaja</a></li>
        </ul>
    </nav>
    </div>
</header>
<main>
    <section class="tabelid">
        <div class="konteiner">
<!--    tabel piletid-->
        <?php if (isset($_REQUEST["piletid"]) ): ?>
        <div>
            <h2>Tabel piletid</h2>

            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>KasutajaId</th>
                    <th>Nimi</th>
                    <th>Ostu kuupäev</th>
                    <th>Kehtiv kuni</th>
                    <th>Tüpp</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
<!--           php funktsioon-->
                <?php piletid(); ?>
                </tbody>
            </table>
        </div>


<!--    tabel hirmumaja-->
    <?php elseif (isset($_REQUEST["hirmumaja"]) ): ?>
        <div>
            <h2>Tabel hirmumaja</h2>

            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>KasutajaId</th>
                    <th>Sisenes</th>
                    <th>Lahkus</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <!-- php funktsioon-->
                <?php hirmumaja(); ?>
                </tbody>
            </table>
        </div>


<!-- tabel kasutajad-->
    <?php else: ?>
        <div>
            <h2>Tabel kasutajad</h2>

            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Login</th>
                    <th>Parool</th>
                    <th>On admin</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <!-- php funktsioon-->
                <?php kasutajad(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
        </div>
    </section>
</main>
<!--footer-->
    <?php include '../elemendid/footer.php'; ?>
</body>
</html>
<?php