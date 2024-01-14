<?php
    // Start nové session nebo pokračování stávající
    session_start();

    // Zahrnutí souboru s připojením k databázi
    include "../php/conn.php";

    // Získání dat z formuláře
    $button = $_POST['button'];

    // Získání dat o oddělení
    $result = pg_prepare($conn, "my_query", 'SELECT * FROM oddeleni WHERE fk_oddeleni = $1');

    $result = pg_execute($conn, "my_query", array($button));

    $data = pg_fetch_assoc($result);

    $_SESSION['data_nazev'] = $data['nazev'];
    $_SESSION['data_img_src'] = $data['img_src'];

    // Získání dat o pokojích
    $result2 = pg_prepare($conn, "my_query2", 'SELECT * FROM pokoje WHERE fk_oddeleni = $1');

    $result2 = pg_execute($conn, "my_query2", array($button));
    
    // Inicializace prázdného pole pro uložení dat
    $data2 = array();

    // Načtení každého řádku výsledku jako asociativní pole a jeho přidání do pole $data2
    while ($row = pg_fetch_assoc($result2)) {
        $data2[] = $row;
    }

    // Uložení dat do session
    $_SESSION['data_pokoje'] = $data2;

    // Přesměrování na stránku s oddělením
    header("Location: ../html/oddeleni.php");
?>