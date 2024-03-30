<!--siin on registrerimise form-->
<?php
session_start();
require_once ('../konf.php');
require_once ('../funktsioonid.php');
require_once ('autoriseerimine_funktsioonid.php');
//ühendage vajalikud failid



//et saaksite brauseris koodi lugeda
if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

//kui valitud registreeri nupp
if (isset($_REQUEST['register'])) {
    //helistame funktsioonile register()
    register();
    exit();
}


//kui valitud tagasi nupp
if (isset($_REQUEST['tagasi'])){
    //tagastame kasutaja kodulehele
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
    <title>Registreerimine</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="autoriseerimine_style.css">
    <script src="autoriseerimine_script.js"></script>


</head>
<!--funktsioon lehe laadimisel-->
<body onload="onLoadReg()">
<main>
<section class="registr">

<!--    registreerimis form-->

    <h1>Registreerimine</h1>
    <form action="?" method="post">
        Nimi: <input type="text" name="nimi" id="nimiReg" oninput="registreeriKontroll()" placeholder="Sisestage..."><br>
        <div id="vastusNimi"></div> <!-- nimi viga vastuse koht-->

        Parool: <input type="password" name="parool1" id="parool1" oninput="registreeriKontroll()" placeholder="Sisestage..."><br>
        Kinnitage parool: <input type="password" name="parool2" id="parool2" oninput="registreeriKontroll()" placeholder="Sisestage..."><br>
        <div id="vastusParool"></div> <!-- parooli viga vastuse koht-->
        <br>

        <input type="submit" value="Registreeri" name="register" id="register">
        <br>
        <br>
        <input type="submit" value="Tagasi"  name="tagasi">

        <br>
        <br>
        <!-- link et sisse logita-->
        <span>Olete juba sisse logitud? <a href="logiSisse.php">Logi sisse</a></span>

        <script>
            // võtke väärtused ja sõltuvalt vea tüübist väljastage vastav tekst
            <?php
            //kui ei ole samad paroolid
            if (isset($_REQUEST['poleSamadParoolid'])) { ?>
            document.getElementById('vastusParool').innerHTML = "<span style=\"color: red;\">Pole samad paroolid</span>";
            <?php }
            //kui nimi ja parool on juba andmebaasis
            if (isset($_REQUEST['onJubaRegistreeritud'])) { ?>
            document.getElementById('vastusNimi').innerHTML = "<span style=\"color: red;\">Nimi on juba võetud</span>";
            <?php }
            //kui parool on nõrk
            if (isset($_REQUEST['norkParool'])) { ?>
            document.getElementById('vastusParool').innerHTML = "<span style=\"color: red;\">Nõrk parool. Parool peab sisaldama vähemalt ühte numbrit, ühte tähte, ühte sümbolit, vähemalt 5 tähemärki pikk </span>";
            <?php } ?>
        </script>
    </form>

</section>
</main>
<!--footer-->
<?php include '../elemendid/footer.php'; ?>
</body>
</html>