<?php
if (isset($_REQUEST['tagasi'])) {
    header("location: ostamine.php?ostukorv");
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
    <title>Leping</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="ostamine_style.css">

</head>
<body>
<main>
    <section class="leping">
        <h1>Litsentsileping</h1>
        <p>
            <strong>1. Pileti ostmine</strong><br>
            1.1. Pileti ost "Hirmude maja" külastamiseks eeldab kõigi selles lepingus sätestatud tingimuste aktsepteerimist.<br>
            1.2. Iga klient kohustub ostma pileti vastavalt lõbustuspargi kehtivatele hindadele ja reeglitele.
        </p>
        <p>
            <strong>2. Reeglid ja tingimused</strong><br>
            2.1. Klient kohustub järgima kõiki lõbustuspargi poolt "Hirmude maja" külastamiseks kehtestatud reegleid ja juhiseid.<br>
            2.2. "Hirmude maja" külastamiseks võib olla vanusepiiranguid, füüsilisi piiranguid või tervisega seotud piiranguid. Klient kohustub tutvuma selliste piirangutega enne pileti ostmist.
        </p>
        <p>
            <strong>3. Vastutus</strong><br>
            3.1. Lõbustuspark ei vastuta kliendi poolt "Hirmude majas" külastamise käigus saadud kahju, kaotuse, vigastuse või haigestumise eest, välja arvatud juhul, kui kahju on otsest kavatsust Lõbustuspargi poolt.<br>
            3.2. Klient tunnistab, et külastab "Hirmude maja" omal vastutusel.
        </p>
        <p>
            <strong>4. Nõusolek pildi kasutamiseks</strong><br>
            4.1. "Hirmude maja" külastamine võib hõlmata fotode või videote tegemist ning klient nõustub oma pildi kasutamisega reklaam- või turundusmaterjalides.
        </p>
        <p>
            <strong>5. Muud tingimused</strong><br>
            5.1. Kõik selles lepingus sätestatud õigused ja kohustused kehtivad kõigile klientidele, kes ostavad pileteid "Hirmude maja" külastamiseks.<br>
            5.2. Iga klient kinnitab, et ta on tutvunud ja mõistnud selle lepingu tingimusi enne pileti ostmist "Hirmude maja" külastamiseks.
        </p>
    </section>
    <div>
        <form action="">
            <input type="submit" name="tagasi" value="Tagasi">
        </form>
    </div>
</main>
    <?php include '../elemendid/footer.php'; ?>

</body>
</html>
