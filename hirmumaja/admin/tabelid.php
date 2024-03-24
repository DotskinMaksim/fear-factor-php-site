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
<header>
    <h1><a href="../index.php">Hirmude maja</a></h1>
</header>
<nav >
    <ul>
        <a href="../admin/tabelid.php">Admini paneel</a>
    </ul>

    <ul>
        <a href="../autoriseerimine/logiValja.php">Log out</a>
    </ul>

</nav>
<nav>
    <ul>
        <a href="tabelid.php?kasutajad">Kasutajad</a>
    </ul>
    <ul>
        <a href="tabelid.php?piletid">Piletid</a>
    </ul>
    <ul>
        <a href="tabelid.php?hirmumaja">Hirmumaja</a>
    </ul>
</nav>
<body>
    <?php if (isset($_REQUEST["kasutajad"]) ): ?>
        <div>
            <h3>Tabel kasutajad</h3>

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

    <?php if (isset($_REQUEST["piletid"]) ): ?>
        <div>
            <h3>Tabel piletid</h3>

            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>KasutajaId</th>
                    <th>Nimi</th>
                    <th>Ostu kuupäev</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php piletid(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if (isset($_REQUEST["hirmumaja"]) ): ?>
        <div>
            <h3>Tabel hirmumaja</h3>

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
    <?php endif; ?>

</body>
</html>



<?php