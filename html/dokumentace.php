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
    <link rel="stylesheet" href="../css/dokumentace.css">
    <title>Patient care | Dokumentace</title>
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
        <p id="title">Dokumentace {jmeno} {prijmeni}</p>
        <div id="info">
            <table>
                <tr>
                    <th>Rodné číslo:</th>
                    <td>{rodne_cislo}</td>
                </tr>
                <tr>
                    <th>Jméno:</th>
                    <td>{jmeno}</td>
                </tr>
                <tr>
                    <th>Příjmení:</th>
                    <td>{prijmeni}</td>
                </tr>
                <tr>
                    <th>Datum narození:</th>
                    <td>{datum_narozeni}</td>
                </tr>
                <tr>
                    <th>Den hospitalizace:</th>
                    <td>{den_hospitalizace}</td>
                </tr>
                <tr>
                    <th>Režim/Operační den:</th>
                    <td>{rezim_operacni_den}</td>
                </tr>
                <tr>
                    <th>Diagnóza:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Výška (cm):</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Váha (kg):</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Vědomí:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Mobilita, soběstačnost:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Komunikace:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Kompenzační pomůcky:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Dýchání:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Výživa a tekutiny:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Vylučování moči:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Vylučovaní stolice:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Vstupy:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Kůže:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Bolest:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Chování, spánek:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Vyšetření:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Léčba/Léky:</th>
                    <td>{info_json}</td>
                </tr>
                <tr>
                    <th>Ordinace/Ošetřovatelská péče:</th>
                    <td>{info_json}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>