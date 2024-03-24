<?php
session_start();
require_once ('funktsioonid.php');
require_once ('index_funktsioonid.php');


if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

if (isset($_REQUEST["sisenes"])) {
    sisenes();
    header("location: index.php");
    exit();
}

if (isset($_REQUEST["lahkus"])) {
    lahkus();
    header("location: index.php");
    exit();
}



?>

    <!DOCTYPE html>
    <html lang="et">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Hirmude maja</title>
        <link rel="stylesheet" type="text/css" href="index/index_style.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="index/index_script.js"></script>

    </head>

    <header>
        <h1><a href="index.php">Hirmude maja</a></h1>
    </header>
    <nav >
        <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <?php if (!onAdmin()) : ?>

                <ul>
                    <a href="ostamine/ostamine.php">Osta pilet</a>
                </ul>
                <ul>
                    <a href="index.php?minuPiletid">Minu piletid</a>
                </ul>
            <?php else : ?>
                <ul>
                    <a href="admin/tabelid.php">Admini paneel</a>
                </ul>

            <?php endif; ?>
            <ul>
                <a href="autoriseerimine/logiValja.php">Log out</a>
            </ul>

        <?php else : ?>
            <ul>
                <a href="autoriseerimine/logiSisse.php">Log in</a>
            </ul>
            <ul>
                <a href="autoriseerimine/registreerimine.php">Registreeri</a>
            </ul>
        <?php endif; ?>
    </nav>



    <body onload="onLoad()">

    <?php if (isset($_REQUEST["minuPiletid"]) ): ?>
        <div>
            <h2>Minu piletid</h2>


            <table>
                <thead>
                    <tr>
                        <th>Pileti id</th>
                        <th>Kasutaja id</th>
                        <th>Kasutaja nimi</th>

                    </tr>
                </thead>
                <tbody>

                    <?php naidataOmaPiletid(); ?>


                </tbody>
            </table>
            <form action="?" method="post">
                <input type="submit" value="Sulge">
            </form>
        </div>
    <?php endif; ?>

        <div>
            <?php if (onAdmin()) : ?>
                <form action="?" method="post">
                    <h3>Sisenes</h3>
                    <input type="number" name="piletId" placeholder="Pilet id" id="piletId" oninput="sisenesKontroll()">
                    <input type="number" name="kasutajaId" placeholder="Kasutaja id" id="kasutajaId" oninput="sisenesKontroll()">
                    <div id="vastus"></div>

                    <input type="submit" name="sisenes" value="Ok" id="sisenes">

                    <script>
                        <?php
                        if (isset($_REQUEST['valePilet'])) { ?>
                        document.getElementById('vastus').innerHTML = "<span style=\"color: red;\">Vale pilet</span>";
                        <?php } ?>
                    </script>
                </form>
            <?php endif; ?>
            <h2>Inimesed hirmude majas</h2>

            <table>
                <thead>
                    <tr>
                        <th>Nimi</th>
                        <th>Aeg sees</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <?php naidataInimesiSisenes(); ?>
                </tbody>
            </table>

        </div>
    </body>
</html>



