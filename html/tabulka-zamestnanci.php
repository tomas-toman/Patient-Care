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
    <link rel="stylesheet" href="../css/tabulky.css">
    <title>Patient care | Tabulka pacientů</title>
    <script>
        $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table-tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
    </script>
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
                        <form action="../php/vypis_zamestnancu.php"><button type="submit" class="proklik"><li class="current_page">Výpis zaměstnanců</li></button></form>
                        <li><a href="#">Přidání zaměstnance</a></li>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                    <form action="../php/vypis_pacientu.php"><button type="submit" class="proklik"><li>Výpis pacientů</li></button></form>
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
    <input id="search" type="text" placeholder="&#xF002; Vyhledat" style="font-family: Montserrat, FontAwesome" />
    <div class="container">
        <table id="employee-table">
            <thead class="table-head">
                <tr>
                    <th>Jméno</th>
                    <th>Příjmení</th>
                    <th>Pozice</th>
                    <th>Specializace</th>
                    <th><button class="add-btn">Přidat</button></th>
                </tr>
                <tbody id="table-tbody">
                    <?php
                        foreach ($_SESSION['data_zamestnanci'] as $row) {
                            echo "<tr class='table-body'>";
                            echo "<td>" . $row['jmeno'] . "</td>";
                            echo "<td>" . $row['prijmeni'] . "</td>";
                            if ($row['nazev_pozice'] == null) {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row['nazev_pozice'] . "</td>";
                            }
                            if ($row['nazev_specializace'] == null) {
                                echo "<td>-</td>";
                            } else {
                                echo "<td>" . $row['nazev_specializace'] . "</td>";
                            }
                            echo '<td><button value=' . $row["id"] . ' class="delete-btn">Smazat</button></td>';
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </thead>
        </table>
    </div>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>