<?php
    session_start();

    include "./conn.php";

    $button = $_POST['button-add'];
    
    $result = pg_prepare($conn, "my_query", "UPDATE luzka l SET fk_pacient = $1 FROM pokoje p, oddeleni o WHERE l.fk_pokoj = p.fk_pokoj AND p.fk_oddeleni = o.fk_oddeleni AND l.cislo_luzka = '" . pg_escape_string($_SESSION['akt_luzko']) . "' AND l.fk_pokoj = '" . pg_escape_string($_SESSION['cislo_pokoje']) . "' AND o.nazev = '" . pg_escape_string($_SESSION['data_nazev']) . "'");
    
    $result = pg_execute($conn, "my_query", array($button));
?>