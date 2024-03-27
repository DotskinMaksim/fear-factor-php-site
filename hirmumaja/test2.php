<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Horizontal Menu</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f7f7f7;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        button,
        input[type="button"],
        input[type="submit"] {
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover,
        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Horizontal Menu */
        nav {
            background-color: #333;
            color: #fff;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            padding: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffcc00;
        }

        /* Main Content */
        body {
            padding: 20px;
        }

        /* Form Styles */
        form {
            margin-bottom: 20px;
        }

        form input[type="text"],
        form input[type="password"],
        form input[type="number"],
        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Website Title</h1>
</header>

<nav>


        <ul>
        <li><a href="ostamine/ostamine.php">Osta pilet</a></li>
        <li><a href="ostamine/omaPiletid.php">Minu piletid</a></li>
        <li><a href="admin/tabelid.php">Admini paneel</a></li>
        <li><a href="autoriseerimine/logiValja.php">Log out</a></li>
        <li><a href="autoriseerimine/logiSisse.php">Log in</a></li>
        <li><a href="autoriseerimine/registreerimine.php">Registreeri</a></li>
        </ul>
</nav>

<section>
    <h2>Main Content Heading</h2>
    <p>This is the main content area of your website.</p>
</section>

<footer>
    &copy; 2024 Your Website. All rights reserved.
</footer>
</body>
</html>
