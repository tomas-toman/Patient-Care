<?php
    // Start nové session nebo pokračování stávající
    session_start();

    // Zahrnutí souboru s připojením k databázi
    include "../php/conn.php";

    // Získání dat z formuláře
    $button = $_POST['button'];

    // Získání dat o oddělení ve kterém aktuálně jsem pomocí session
    $sessionData = $_SESSION['data_nazev'];

    // Získání dat o pokoji
    $result = pg_prepare($conn, "my_query", "SELECT * FROM pokoje p INNER JOIN oddeleni o USING(fk_oddeleni) WHERE p.cislo_pokoje = $1 AND o.nazev = $2");

    $result = pg_execute($conn, "my_query", array($button, $sessionData));

    $data = pg_fetch_assoc($result);

    $_SESSION['cislo_pokoje'] = $data['cislo_pokoje'];

    // Získání dat o lůžkách
    $result2 = pg_prepare($conn, "my_query2", 'SELECT * FROM luzka WHERE fk_pokoj = $1');

    $result2 = pg_execute($conn, "my_query2", array($button));

    // Inicializace prázdného pole pro uložení dat
    $data2 = array();

    // Načtení každého řádku výsledku jako asociativní pole a jeho přidání do pole $data2
    while ($row = pg_fetch_assoc($result2)) {
        $data2[] = $row;
    }

    // Uložení dat do session
    $_SESSION['data_luzka'] = $data2;

    //Přesměrování na stránku s pokojem
    header("Location: ../html/pokoj.php");
?>