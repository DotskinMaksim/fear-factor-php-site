<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дом Ужасов</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Добро пожаловать в Дом Ужасов</h1>
        <nav>
            <ul>
                <li><a href="../sisenes/sisenes.php">Sisenes</a></li>

                <?php if (isset($_SESSION['kasutajaNimi']) != null) : ?>
                    <?php if (!onAdmin()) : ?>
                        <li><a href="../ostamine/ostamine.php">Osta pilet</a></li>
                        <li><a href="../ostamine/omaPiletid.php">Minu piletid</a></li>
                    <?php else : ?>
                        <li><a href="../admin/tabelid.php">Admini paneel</a></li>
                    <?php endif; ?>
                    <li><a href="../autoriseerimine/logiValja.php">Logi välja</a> </li>
                <?php else : ?>
                    <li><a href="../autoriseerimine/logiSisse.php">Logi sisse</a></li>
                    <li><a href="../autoriseerimine/registreerimine.php">Registreeri</a></li>


                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<main>
    <section class="intro">
        <div class="container">
            <h2>Страхи становятся реальностью</h2>
            <p>Готовьтесь к невероятному погружению в мир ужасов, где ничто не кажется тем, чем кажется.</p>
        </div>
    </section>
    <section class="services">
        <div class="container">
            <h2>Наши услуги</h2>
            <ul>
                <li>Экскурсии по заброшенным домам</li>
                <li>Зомби-тур</li>
                <li>Ночь в кладбище</li>
                <li>Мистические вечеринки</li>
            </ul>
        </div>
    </section>
    <section class="contact">
        <div class="container">
            <h2>Свяжитесь с нами</h2>
            <p>Телефон: 123-456-789</p>
            <p>Email: info@dom-uzhasov.com</p>
        </div>
    </section>
</main>
<footer>
    <div class="container">
        <p>&copy; 2024 Дом Ужасов. Все права защищены.</p>
    </div>
</footer>
</body>
</html>
