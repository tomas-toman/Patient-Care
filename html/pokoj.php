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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/db4d39efc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/pokoj.css">
    <title>Patient care | Pokoj č. <?php echo $_SESSION['cislo_pokoje']; ?></title>
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
                <li><a href="./menu.php">Navigační menu</a></li>
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
    <div id="container">
        <div id="title">
            <p>Pokoj č. <?php echo $_SESSION['cislo_pokoje']; ?> <br> (<?php echo $_SESSION['data_nazev']; ?>)</p>
        </div>
        <div id="buttons1">
            <?php foreach($_SESSION['data_luzka'] as $luzka): ?>
                <button id="bed-value">Lůžko č. <?php echo $luzka['cislo_luzka']; ?></button>
            <?php endforeach; ?>
        </div>
        <div id="info">
                <div id="info-card">
                    <i class="fa-solid fa-user" id="info-content"></i>
                    <div id="paragraphs"></div>
                    <p>ID: </p>
                    <p>Jméno: </p>
                    <p>Příjmení: </p>
                    <p>Pohlaví: </p>
                    <p>Datum narození: </p>
                    <p>Rodné číslo: </p>
                    <div id="info-content">
                        <button id="dokument-btn">Dokumentace</button>
                        <button id="close-btn">Zavřít</button>
                    </div>
                </div>
        </div>
        <div id="map">Mapa nemocnice</div>
    </div>
<script src="../js/pokoj.js"></script>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>