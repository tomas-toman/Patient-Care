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
                        <li><a href="#">Výpis zaměstnanců</a></li>
                        <li><a href="#">Přidání zaměstnance</a></li>
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
            <?php 
            $i = 1;
            foreach($_SESSION['data_luzka'] as $luzka): ?>
                <form action="../php/info-card.php" method="post">
                    <button type="submit" class="bed-value" name="button" value="<?php echo $i?>" onmouseover="changeImage('../img/Lůžko <?php echo $i; ?>.png')" onmouseout="changeImage('../img/Pokoj.png')">Lůžko č. <?php echo $i; ?></button>
                </form>
            <?php 
            $i++;
            endforeach; ?>
        </div>
        <div id="info">
                <div id="info-card">
                    <i class="fa-solid fa-user" id="info-content"></i>
                    <p id="jmeno">Jméno: </p>
                    <p id="prijmeni">Příjmení: </p>
                    <p id="datum_narozeni">Datum narození: </p>
                    <p id="rodne_cislo">Rodné číslo: </p>
                    <div id="info-content">
                        <a href="./dokumentace.php"><button id="dokument-btn">Dokumentace</button></a>
                        <form action="../php/tabulka_pacientu.php"><button id="add-btn">Přidat</button></form>
                        <form action="../php/odebrat_pacienta.php"><button id="rem-btn">Odebrat</button></form>
                        <button id="close-btn">Zavřít</button>
                    </div>
                </div>
        </div>
        <div id="map">
            <img  id="mapImage" src="../img/Pokoj.png" alt="">
        </div>
        <div id="patient-table">
            <table id="info-table">
                <thead>
                    <tr id="header-table">
                        <th class="second-header">Rodné číslo</th>
                        <th class="second-header">Jméno</th>
                        <th class="second-header">Příjmení</th>
                        <th class="second-header">Datum narození</th>
                        <th class="second-header"></th>
                        <th class="primary-header"><button id="close-table-btn"><i class="fa fa-times"></i></button></th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
            </table>
        </div>
    </div>  
<script src="../js/pokoj.js"></script>
<script src="../js/zmenaMapy.js"></script>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>