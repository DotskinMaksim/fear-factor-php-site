<?php
session_start();
require_once ('../konf.php');
require_once ('../funktsioonid.php');
require_once ('ostamine_funktsioonid.php');


if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}


if (isset($_REQUEST['tagasi'])){
    header("location: ../index.php");
    exit();
}

if (isset($_REQUEST['osta'])){
    ostamine();
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
            <link rel="stylesheet" href="../style.css">
            <link rel="stylesheet" href="ostamine_style.css">

            <script src="ostamine_script.js" ></script>
        </head>
        <body onload="onLoad()">
            <div>

                <h1>Ostamine</h1>
                <form action="?" method="post">
                    <p>Kui palju pileti soovite osta?</p>
                    <input type="number" name="piletiArv" id="piletiArv" oninput="ostamineKontroll()" >

                    <input type="checkbox" name="checkbox" id="checkbox" oninput="ostamineKontroll()">
                    Olen <a href="leping.php">lepingu</a> läbi lugenud ja nõustun sellega
                    <br>
                    <input type="submit" value="Osta"  name="osta" id="osta">
                    <input type="submit" value="Tagasi"  name="tagasi">

                </form>
            </div>
        </body>
    </html>
<?php
