<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_jmeno']) && isset($_SESSION['user_prijmeni'])) {;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/db4d39efc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/menu.css">
    <title>Patient care | Navigační menu</title>
</head>
<body>
    <header>
        <a href="./menu.php" class="logo">
            <img src="../img/Logo.png" alt="">
        </a>

        <input type="checkbox" id="menu-bars">
        <label for="menu-bars"><i class="fa-solid fa-bars fa-xl" style="color: #719ED4;"></i></label>

        <nav class="navbar">
            <ul>
                <li><a href="#" class="current_page">Navigační menu</a></li>
                <li><a href="#">Zaměstnanci <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <li><a href="#">Výpis zamětnanců</a></li>
                        <li><a href="#">Přidání zamětnance</a></li>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <li><a href="#">Výpis pacientů</a></li>
                        <li><a href="#">Přidání pacienta</a></li>
                    </ul>
                </li>
                <li><a href="#">Log akcí</a></li>
                <li>
                    <div class="logged">
                        <p>Jste přihlášen/a jako <?=$_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni']?></p>
                        <a href="../php/odhlaseni.php"><button>Odhlásit se <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i></button></a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div id="title1">
            <p>1. Patro</p>
        </div>
        <div id="buttons1">
            <form action="../php/oddeleni_presmerovac.php" method="post">
                <button type="submit" name="button" value="1" onmouseover="changeImage('../img/Chirurgie.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">Chirurgické odd.</button>
                <button type="submit" name="button" value="5" onmouseover="changeImage('../img/ORL a CHHK.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">ORL a CHHK</button>
                <button type="submit" name="button" value="10" onmouseover="changeImage('../img/VIN I.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">VIN I.</button>
                <button type="submit" name="button" value="11" onmouseover="changeImage('../img/VIN II.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">VIN II.</button>
                <button type="submit" name="button" value="4" onmouseover="changeImage('../img/Traumatologické odd.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">Traumatologické odd.</button>
                <button type="submit" name="button" value="14" onmouseover="changeImage('../img/Neurologické odd.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">Neurologické odd.</button>
                <button type="submit" name="button" value="12" onmouseover="changeImage('../img/Urologické odd.png')" onmouseout="changeImage('../img/Mapa 1. patro.png')">Urologické odd.</button>

            </form>
        </div>
        <div id="title2">
            <p>2. Patro</p>
        </div>
        <div id="buttons2">
            <form action="../php/oddeleni_presmerovac.php" method="post">
                <button type="submit" name="button" value="6" onmouseover="changeImage('../img/Novorozenecké odd.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">Novorozenecké odd.</button>
                <button type="submit" name="button" value="3" onmouseover="changeImage('../img/Gynekologicko-porodnické odd.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">Gynekologicko-porodnické odd.</button>
                <button type="submit" name="button" value="2" onmouseover="changeImage('../img/JIP.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">JIP</button>
                <button type="submit" name="button" value="7" onmouseover="changeImage('../img/ARO.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">ARO</button>
                <button type="submit" name="button" value="8" onmouseover="changeImage('../img/Dětské odd.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">Dětské odd.</button>
                <button type="submit" name="button" value="9" onmouseover="changeImage('../img/DIP.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">DIP</button>
                <button type="submit" name="button" value="13" onmouseover="changeImage('../img/TRN.png')" onmouseout="changeImage('../img/Mapa 2. patro.png')">TRN</button></a>
            </form>
        </div>
        <div id="map">
            <img  id="mapImage" src="../img/Mapa 1. patro.png" alt="">
        </div>
    </div>
<script src="../js/zmenaMapy.js"></script>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>