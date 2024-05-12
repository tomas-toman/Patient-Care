<?php
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_jmeno']) && isset($_SESSION['user_prijmeni']) && isset($_SESSION['user_opravneni'])) {;
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
    <link rel="icon" href="../img/Logo.png" type="image/x-icon"/>
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
                        <form action="../php/vypis_zamestnancu.php"><button type="submit" class="proklik"><li>Výpis zaměstnanců</li></button></form>
                        <?php
                            if ($_SESSION['user_opravneni'] == 1) {
                                echo '<li><a href="./pridani-zamestnanci.php">Přidání zaměstnance</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <form action="../php/vypis_pacientu.php"><button type="submit" class="proklik"><li>Výpis pacientů</li></button></form>
                        <?php
                            if ($_SESSION['user_opravneni'] <= 2) {
                                echo '<li><a href="./pridani-pacienti.php">Přidání pacienta</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li><a href="../php/log-vypis.php">Log akcí</a></li>
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
        <p id="title">Dokumentace <?php foreach($_SESSION['data_pacient'] as $pacient) {echo $pacient['jmeno'];}?> <?php foreach($_SESSION['data_pacient'] as $pacient) {echo $pacient['prijmeni'];}?></p>
        <div id="info">
            <table>
                <tr>
                    <th>Rodné číslo:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                echo $pacient['rodne_cislo'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Jméno:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                echo $pacient['jmeno'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Příjmení:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                echo $pacient['prijmeni'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Datum narození:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                echo $pacient['datum_narozeni'];
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Den hospitalizace:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['den_hospitalizace'])) {
                                    echo $pacient['den_hospitalizace'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Režim/Operační den:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['rezim_operacni_den'])) {
                                    echo $pacient['rezim_operacni_den'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Diagnóza:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    echo $info_json['diagnoza'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Výška (cm):</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    echo $info_json['vyska'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Váha (kg):</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    echo $info_json['vaha'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Vědomí:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['vedomi'] = str_replace(';', ',', $info_json['vedomi']);
                                    echo $info_json['vedomi'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Mobilita, soběstačnost:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['mobilita,sobestacnost'] = str_replace(';', ',', $info_json['mobilita,sobestacnost']);
                                    echo $info_json['mobilita,sobestacnost'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Komunikace:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['komunikace'] = str_replace(';', ',', $info_json['komunikace']);
                                    echo $info_json['komunikace'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Kompenzační pomůcky:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['kompenzacni_pomucky'] = str_replace(';', ',', $info_json['kompenzacni_pomucky']);
                                    echo $info_json['kompenzacni_pomucky'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Dýchání:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['dychani'] = str_replace(';', ',', $info_json['dychani']);
                                    echo $info_json['dychani'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Výživa a tekutiny:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['vyziva,tekutiny'] = str_replace(';', ',', $info_json['vyziva,tekutiny']);
                                    echo $info_json['vyziva,tekutiny'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Vylučování moči:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['vylucovani_moci'] = str_replace(';', ',', $info_json['vylucovani_moci']);
                                    echo $info_json['vylucovani_moci'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Vylučovaní stolice:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['vylucovani_stolice'] = str_replace(';', ',', $info_json['vylucovani_stolice']);
                                    echo $info_json['vylucovani_stolice'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Vstupy:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['vstupy'] = str_replace(';', ',', $info_json['vstupy']);
                                    echo $info_json['vstupy'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Kůže:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['kuze'] = str_replace(';', ',', $info_json['kuze']);
                                    echo $info_json['kuze'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Bolest:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['bolest'] = str_replace(';', ',', $info_json['bolest']);
                                    echo $info_json['bolest'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Chování, spánek:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $info_json['chovani,spanek'] = str_replace(';', ',', $info_json['chovani,spanek']);
                                    echo $info_json['chovani,spanek'];
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Vyšetření:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $vysetreni = str_replace("\n", '<br>', $info_json['vysetreni']);
                                    echo $vysetreni;
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Léčba/Léky:</th>
                    <td>
                    <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $lecba_leky = str_replace("\n", '<br>', $info_json['lecba,leky']);
                                    echo $lecba_leky;
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Ordinace/Ošetřovatelská péče:</th>
                    <td>
                        <?php
                            foreach($_SESSION['data_pacient'] as $pacient) {
                                if(isset($pacient['info_json'])) {
                                    $info_json = is_array($pacient['info_json']) ? $pacient['info_json'] : json_decode($pacient['info_json'], true);
                                    $ordinace_osetrovatelska_pece = str_replace("\n", '<br>', $info_json['ordinace,osetrovatelska_pece']);
                                    echo $ordinace_osetrovatelska_pece;
                                }
                                else {
                                    echo "-";
                                }
                            }
                        ?>
                    </td>
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