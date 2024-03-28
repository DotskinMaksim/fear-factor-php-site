<?php
session_start();
require_once ('../funktsioonid.php');
require_once ('tabelid_funktsioonid.php');


if (isset($_GET["kustutaKasutaja"])) {
    $kasutajaId = $_GET["kustutaKasutaja"];
    kustutaKasutaja($kasutajaId);
    exit();

}

if (isset($_GET["kustutaPilet"])) {
    $piletId = $_GET["kustutaPilet"];
    kustutaPilet($piletId);
    exit();

}
if (isset($_GET["kustutaHirmumaja"])) {
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
    <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
        <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
    <?php else : ?>
        <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
    <?php endif; ?>
    <nav>
        <ul>
        <li><a href="../index.php">Info</a></li>

        <li><a href="../sisenes/sisenes.php">Sisenes</a></li>

        <li><a href="../admin/tabelid.php">Admini paneel</a></li>

        <li><a href="../autoriseerimine/logiValja.php">Logi välja</a></li>
        </ul>

    </nav>
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
                <?php piletid(); ?>
                </tbody>
            </table>
        </div>

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
                <?php hirmumaja(); ?>
                </tbody>
            </table>
        </div>

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
                <?php kasutajad(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
        </div>
    </section>
</main>
    <?php include '../elemendid/footer.php'; ?>
</body>
</html>



<?php