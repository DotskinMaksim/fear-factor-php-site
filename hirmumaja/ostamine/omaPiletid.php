<?php
session_start();
require_once ('../konf.php');
require_once ('../funktsioonid.php');
require_once ('ostamine_funktsioonid.php');
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
<?php include '../elemendid/header.php'; ?>

<nav>
    <ul>
        <li><a href="../sisenes/sisenes.php">Sisenes</a></li>
        <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
        <li><a href="omaPiletid.php">Minu piletid</a></li>
        <li><a href="../autoriseerimine/logiValja.php">Log out</a></li>

    </ul>
</nav>
<main>


    <section class="Piletid">
        <?php  naitaOmaPiletid();  ?>

    </section>
</main>
<?php include '../elemendid/footer.php'; ?>
</body>
</html><?php
