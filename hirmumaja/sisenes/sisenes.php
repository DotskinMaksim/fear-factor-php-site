<?php
session_start();


//see on leht inimeste vaatamiseks hirmumajas ja -->
//ka pargitöötaja jaoks sisenevate ja väljuvate inimeste jälgimiseks-->


//ühendage vajalikud failid

require_once ('../funktsioonid.php');
//funktsioonid ainult sellel lehel
require_once ('sisenes_funktsioonid.php');

//et saaksite brauseris koodi lugeda
if (isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}

//kui valitud sisenes
if (isset($_REQUEST["sisenes"])) {
//helistame funktsioonile sisenes()
    sisenes();
//naasme tavalisele lehele
    header("location: sisenes.php");
    exit();
}
//kui valitud lahkus
if (isset($_REQUEST["lahkus"])) {
    //helistame funktsioonile lahkus()
    lahkus();
    //naasme tavalisele lehele
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
    <title>Sisenes</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
<!-- skript ainult sellele lehele-->
    <script src="sisenes_script.js"></script>
</head>
<!--funktsioon lehe laadimisel-->
<body onload="onLoad()">
<header>
    <div class="konteiner">
        <!-- kui kasutaja on sisse logitud, kuvame tema nimega tervituse ja kui ei, siis lihtsalt tervitus-->

        <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja, <?php echo $_SESSION['kasutajaNimi'];?>!</h1>
        <?php else : ?>
            <h1 class="tervitamine">Tere tulemast hirmude majja!</h1>
        <?php endif; ?>


        <!-- navigeerimismenüü-->
        <nav>
            <ul>
                <li><a href="../index.php">Info</a></li>
                <li><a href="sisenes.php">Sisenes</a></li>

                <!-- kuva menüüelemendid olenevalt kasutaja olekust-->
                <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
                    <!-- kui pole admin-->
                    <?php if (!onAdmin()) : ?>
                        <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
                        <li><a href="../ostamine/omaPiletid.php">Minu piletid</a></li>
                <!-- kui on-->
                    <?php else : ?>
                        <li><a href="../admin/tabelid.php">Admini paneel</a></li>
                    <?php endif; ?>

                    <li><a href="../autoriseerimine/logiValja.php">Logi välja</a></li>
                    <!--  kui kasutaja pole sisse logitud-->
                <?php else : ?>
                    <li><a href="../autoriseerimine/logiSisse.php">Logi sisse</a></li>
                    <li><a href="../autoriseerimine/registreerimine.php">Registreeri</a></li>

                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main>
<section class="sisenes">
<div class="konteiner">
<!-- kui kasutaja on admin siis lehel on paneel kuhu ta saab lisada kasutajate
pileti id ja tema id mida parast kasutalaj kustutakse pilet ja temal alustab näidata kaasatud nimekirjas-->
    <?php if (onAdmin()) : ?>
        <form action="" method="post">
            <h2>Sisenes paneel</h2>
<!--            input pileti id-->
            <input type="number" name="piletId" placeholder="Pilet id" id="piletId" oninput="sisenesKontroll()">
<!--            input kasutajate id-->
            <input type="number" name="kasutajaId" placeholder="Kasutaja id" id="kasutajaId" oninput="sisenesKontroll()">

<!--            koht kus kui id-ed on valed või plet on aegunud ilmub vigade kirja-->
            <div id="vastus"></div>
            <br>
<!--            nupp kinnitada-->
            <input type="submit" name="sisenes" value="Ok" id="sisenes">

<!--            võtke väärtused ja sõltuvalt vea tüübist väljastage vastav tekst-->
            <script>
                <?php
            //  kui id-ed on valed
                if (isset($_REQUEST['valePilet'])) { ?>
                document.getElementById('vastus').innerHTML = "<span style=\"color: red;\">Vale pilet</span>";
                <?php } ?>
                <?php
            //  kui pilet on aegunud
                if (isset($_REQUEST['piletAegunud'])) { ?>
                document.getElementById('vastus').innerHTML = "<span style=\"color: red;\">Pilet on aegunud</span>";
                <?php } ?>
            </script>
        </form>
    <?php endif; ?>
<!-- pea tabel-->
    <h2>Inimesed hirmude majas</h2>
    <table>
        <thead>
        <tr>
            <th>Nimi</th>
            <th>Aeg sees</th>
<!--   kui kasutaja on admin ilmub veel 1 kustuta veerg-->
            <?php if (onAdmin()) : ?>
                <th></th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
    <!--  näitame inimesed sisenes php funktsioonist-->
            <?php naidataInimesiSisenes(); ?>
        </tbody>
        <script>
            // seda script teeb taimeri uuendamine iga sekund kasu kasutades js funktsioon
            setInterval(uuendaAeg, 1000);
        </script>
    </table>

</div>
</section>
</main>
<!-- footer-->
<?php include '../elemendid/footer.php'; ?>

</body>
</html>