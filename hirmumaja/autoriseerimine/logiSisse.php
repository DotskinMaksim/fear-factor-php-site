<?php
session_start();
require_once ('../konf.php');
require_once ('../funktsioonid.php');
require_once ('autoriseerimine_funktsioonid.php');


if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

if (isset($_REQUEST['logiSisse'])) {
    logiSisse();
    exit();
}
if (isset($_REQUEST['tagasi'])){
    header("location: ../index.php");
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
    <title>Logi sisse</title>
    <link rel="stylesheet" href="autoriseerimine_style.css">
    <link rel="stylesheet" href="../style.css">
    <script src="autoriseerimine_script.js"></script>

</head>
<body onload="onLoadSisse()">
<main>
    <section class="logiSisse">
        <h1>Logi sisse</h1>
        <form action="?" method="post">
            Nimi: <input type="text" name="nimi" id="nimi" oninput="logiSisseKontroll()" placeholder="Sisestage..."><br>
            Parool: <input type="password" name="parool" id="parool" oninput="logiSisseKontroll()" placeholder="Sisestage..."><br>
            <div id="vastus"></div>

            <input type="submit" value="Logi sisse"  name="logiSisse" id="logiSisse">
            <input type="submit" value="Tagasi"  name="tagasi">

            <br>
            <br>
            <span>Pole registreeritud?<a href="registreerimine.php"> Registreeri</a></span>

            <script>
                <?php
                if (isset($_REQUEST['vale'])) {
                ?>
                document.getElementById('vastus').innerHTML = "<span style=\"color: red;\">Vale nimi või parool</span>";
                <?php
                }
                ?>
            </script>
        </form>
    </>
</main>
    <?php include '../elemendid/footer.php'; ?>
</body>
</html>