<?php
session_start();
require_once ('../funktsioonid.php');
require_once ('sisenes_funktsioonid.php');


if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

if (isset($_REQUEST["sisenes"])) {
    sisenes();
    header("location: sisenes.php");
    exit();
}

if (isset($_REQUEST["lahkus"])) {
    lahkus();
    header("location: sisenes.php");
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
    <!--        <link rel="stylesheet" type="text/css" href="index/index_style.css">-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="sisenes_script.js"></script>
    <style>

    </style>

</head>
<body onload="onLoad()">
<header>
    <h1><a href="../index.php" class="koduleht-a">Hirmude maja</a></h1>

    <nav>
        <ul>
            <li><a href="sisenes.php">Sisenes</a></li>


            <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
                <?php if (!onAdmin()) : ?>


                    <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
                    <li><a href="../ostamine/omaPiletid.php">Minu piletid</a></li>
                <?php else : ?>
                    <li><a href="../admin/tabelid.php">Admini paneel</a></li>
                <?php endif; ?>
                <li><a href="../autoriseerimine/logiValja.php">Logi välja</a></li>
            <?php else : ?>
                <li><a href="../autoriseerimine/logiSisse.php">Logi sisse</a></li>
                <li><a href="../autoriseerimine/registreerimine.php">Registreeri</a></li>


            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
<section class="sisenes">
<div>
    <?php if (onAdmin()) : ?>
        <form action="" method="post">
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
                <?php
                if (isset($_REQUEST['piletAegunud'])) { ?>
                document.getElementById('vastus').innerHTML = "<span style=\"color: red;\">Pilet on aegunud</span>";
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
            <?php if (onAdmin()) : ?>
                <th></th>
            <?php endif; ?>


        </tr>
        </thead>
        <tbody>
        <?php naidataInimesiSisenes(); ?>
        </tbody>
    </table>

</div>
</section>
</main>
<?php include '../elemendid/footer.php'; ?>

</body>
</html>



