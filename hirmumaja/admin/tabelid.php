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

<?php include '../elemendid/header.php'; ?>

<nav>
    <ul>
    <li><a href="../sisenes/sisenes.php">Sisenes</a></li>

    <li><a href="../admin/tabelid.php">Admini paneel</a></li>

    <li><a href="../autoriseerimine/logiValja.php">Log out</a></li>
    </ul>

</nav>
<nav>
    <ul>
    <li><a href="tabelid.php">Kasutajad</a></li>
    <li><a href="tabelid.php?piletid">Piletid</a></li>
    <li><a href="tabelid.php?hirmumaja">Hirmumaja</a></li>
    </ul>
</nav>
<main>
    <section class="tabelid">



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

    <?php else: ?>
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
    </section>
</main>
    <?php include '../elemendid/footer.php'; ?>
</body>
</html>



<?php