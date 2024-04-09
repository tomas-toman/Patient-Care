<?php
    // Start nové session nebo pokračování stávající
    session_start();

    // Zahrnutí souboru s připojením k databázi
    include "./conn.php";

    //Ověření zda jsou vyplněny všechny údaje
    if (isset($_POST['uzivatelske_jmeno']) && isset($_POST['heslo'])) {
        //Přiřazení proměnných
        $uzivatelske_jmeno = $_POST['uzivatelske_jmeno'];
        $heslo = $_POST['heslo'];

        // Pokud jsou nějaké údaje prázdné, tak se přesměruje zpět na přihlášení a vypíše se chybová hláška
        if (empty($uzivatelske_jmeno) || empty($heslo)) {
            header("Location: ../html/prihlaseni.php?error=Vypňte všechny údaje!");
        } else {
            // Pokud jsou všechny údaje vyplněné, tak se připojí k databázi a zkontroluje se, zda je uživatel v databázi
            $query = pg_query($conn, "SELECT * FROM zamestnanci WHERE prihlasovaci_jmeno = '$uzivatelske_jmeno'");
            if (pg_num_rows($query) === 1) {
                // Pokud je uživatel v databázi, tak se načtou jeho údaje
                $user = pg_fetch_assoc($query);

                // Přiřazení dat uživatele do proměnných
                $user_id = $user['id'];
                $user_prihlasovaci_jmeno = $user['prihlasovaci_jmeno'];
                $user_heslo = $user['heslo'];
                $user_jmeno = $user['jmeno'];
                $user_prijmeni = $user['prijmeni'];

                // Ověření zadaného přihlašovacího jména a hesla z databáze
                if ($uzivatelske_jmeno === $user_prihlasovaci_jmeno) {
                    // Ověření, zda je zadané heslo stejné jako heslo v databázi
                    if (password_verify($heslo, $user_heslo)) {
                        // Nastavení uživatelských dat do session
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_jmeno'] = $user_jmeno;
                        $_SESSION['user_prijmeni'] = $user_prijmeni;

                        $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " se přihlásil/a.";

                        $result = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
                        $result = pg_execute($conn, "log", array($logData));
                        // Přesměrování na menu
                        header("Location: ../html/menu.php");
                    } else {
                        // Pokud se heslo neschoduje, tak se přesměruje zpět na přihlášení a vypíše se chybová hláška
                        header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
                    }
                } else {
                    // Pokud se zadanné uživatelské jméno neschoduje, tak se přesměruje zpět na přihlášení a vypíše se chybová hláška
                    header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
                
                }
            } else {
                // Pokud uživatel neexistuje, tak se přesměruje zpět na přihlášení a vypíše se chybová hláška
                header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
            }
        }
    } 
?>