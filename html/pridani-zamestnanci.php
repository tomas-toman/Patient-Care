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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/db4d39efc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/pridani-zamestnanci.css">
    <link rel="icon" href="../img/Logo.png" type="image/x-icon"/>
    <title>Patient care | Přidání zaměstnance</title>
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
                        <li class="current_page"><a href="./pridani-zamestnanci.php">Přidání zaměstnance</a></li>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                    <form action="../php/vypis_pacientu.php"><button type="submit" class="proklik"><li>Výpis pacientů</li></button></form>
                        <li><a href="./pridani-pacienti.php">Přidání pacienta</a></li>
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
    <div class="container">
        <div class="form">
            <h1>Přidání zaměstnance</h1>
            <form action="../php/pridani_zamestnance.php" method="post">
                <input type="text" placeholder="Jméno*" name="jmeno" required>
                <input type="text" placeholder="Příjmení*" name="prijmeni" required>
                <input type="text" placeholder="Přihlašovací jméno*" name="prih_jmeno" required>
                <input type="password" placeholder="Heslo*" name="heslo" required>

                <select id="pozice" name="pozice" required>
                    <option value="Pozice">Pozice*</option>
                    <option value="Lékař">Lékař</option>
                    <option value="Zdravotní sestra">Zdravotní sestra</option>
                    <option value="Zdravotnický technik">Zdravotnický technik</option>
                    <option value="Administrativní personál">Administrativní personál</option>
                    <option value="Podpůrný personál">Podpůrný personál</option>
                    <option value="Farmaceutický pracovník">Farmaceutický pracovník</option>
                    <option value="Terapeut">Terapeut</option>
                    <option value="Sociální pracovník">Sociální pracovník</option>
                    <option value="IT personál">IT personál</option>
                </select>

                <select id="specializace" name="specializace" required>
                    <option value="Specializace">Specializace*</option>
                    <option value="Chirurgie">Chirurgie</option>
                    <option value="Vnitřní lékařství">Vnitřní lékařství</option>
                    <option value="Gynekologie a porodnictví">Gynekologie a porodnictví</option>
                    <option value="Pediatrie">Pediatrie</option>
                    <option value="Anesteziologie">Anesteziologie</option>
                    <option value="Radiologie">Radiologie</option>
                    <option value="Oční medicína">Oční medicína</option>
                    <option value="Otorinolaryngologie">Otorinolaryngologie</option>
                    <option value="Psychiatrie">Psychiatrie</option>
                    <option value="Dermatologie">Dermatologie</option>
                    <option value="Infekční nemoci">Infekční nemoci</option>
                    <option value="Endokrinologie">Endokrinologie</option>
                    <option value="Ortopedie">Ortopedie</option>
                    <option value="Onkologie">Onkologie</option>
                    <option value="Fyzioterapie a rehabilitace">Fyzioterapie a rehabilitace</option>
                    <option value="Laboratorní medicína">Laboratorní medicína</option>
                    <option value="Zubní medicína">Zubní medicína</option>
                    <option value="Kardiologie">Kardiologie</option>
                    <option value="IT">IT</option>
                </select>

                <button id="add-btn" type="submit">Přidat</button>
            </form>
    </div>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>