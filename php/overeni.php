<?php
// Start nové session nebo pokračování stávající
session_start();

// Zahrnutí souboru s připojením k databázi
include "./conn.php";

// Ověření, zda jsou vyplněny všechny údaje
if (isset($_POST['uzivatelske_jmeno'], $_POST['heslo'])) {
    // Přiřazení proměnných s ošetřením proti SQL injection
    $uzivatelske_jmeno = pg_escape_string($conn, $_POST['uzivatelske_jmeno']);
    $heslo = pg_escape_string($conn, $_POST['heslo']);

    // Pokud jsou nějaké údaje prázdné, přesměrování zpět na přihlášení s chybovou zprávou
    if (empty($uzivatelske_jmeno) || empty($heslo)) {
        header("Location: ../html/prihlaseni.php?error=Vypňte všechny údaje!");
        exit(); // Zastavení provádění kódu
    }

    // Dotaz na databázi pro ověření uživatele
    $query = "SELECT * FROM zamestnanci WHERE prihlasovaci_jmeno = $1";
    $result = pg_query_params($conn, $query, array($uzivatelske_jmeno));

    // Kontrola, zda byl vrácen právě jeden záznam
    if (pg_num_rows($result) === 1) {
        $user = pg_fetch_assoc($result);

        // Ověření hesla
        if (password_verify($heslo, $user['heslo'])) {
            // Nastavení uživatelských dat do session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_jmeno'] = $user['jmeno'];
            $_SESSION['user_prijmeni'] = $user['prijmeni'];

            // Záznam do logu
            $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " se přihlásil/a.";
            $queryLog = "INSERT INTO log (data, datum) VALUES ($1, NOW())";
            $resultLog = pg_query_params($conn, $queryLog, array($logData));

            // Přesměrování na menu
            header("Location: ../html/menu.php");
            exit(); // Zastavení provádění kódu
        }
    }

    // Pokud nebyl nalezen shodující se uživatel nebo špatné heslo, přesměrování s chybovou zprávou
    header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
    exit(); // Zastavení provádění kódu
} else {
    // Pokud nebyla vyplněna všechna pole, přesměrování zpět na přihlášení
    header("Location: ../html/prihlaseni.php");
    exit(); // Zastavení provádění kódu
}
?>