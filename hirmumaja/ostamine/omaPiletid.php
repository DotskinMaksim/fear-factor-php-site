<!--sellel lehel saab kasutaja vaadata juba ostetud pileteid-->
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
?>
<!doctype html>

<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minu piletid</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="ostamine_style.css">

    <script src="ostamine_script.js" ></script>
</head>
<body>
<header>
    <div class="konteiner">
        <!--kui kasutaja on sisse logitud, kuvame tema nimega tervituse ja kui ei, siis lihtsalt tervitus-->

        <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
        <?php else : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
        <?php endif; ?>

        <!-- navigeerimismenüü-->

        <nav>
            <ul>
                <li><a href="../index.php">Info</a></li>
                <li><a href="../sisenes/sisenes.php">Sisenes</a></li>
                <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
                <li><a href="omaPiletid.php">Minu piletid</a></li>
                <li><a href="../autoriseerimine/logiValja.php">Logi välja</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
<!-- piletid-->
    <section class="Piletid">
        <div class="konteiner">
<!--    helistame php funktsioon mis naitab ostetud piletid-->
            <?php  naitaOmaPiletid();  ?>
        </div>
    </section>
</main>
<!--footer-->
<?php include '../elemendid/footer.php'; ?>
</body>
</html><?php
