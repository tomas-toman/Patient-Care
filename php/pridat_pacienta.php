<?php
    session_start();

    include "./conn.php";

    $button = $_POST['button-add'];
    
    $result = pg_prepare($conn, "my_query", "UPDATE luzka l SET fk_pacient = $1 FROM pokoje p JOIN oddeleni o ON p.fk_oddeleni = o.fk_oddeleni WHERE l.fk_pokoj = p.fk_pokoj AND l.cislo_luzka = $2 AND p.cislo_pokoje = $3 AND o.nazev = $4");

    $result = pg_execute($conn, "my_query", array($button, pg_escape_string($_SESSION['akt_luzko']), pg_escape_string($_SESSION['cislo_pokoje']), pg_escape_string($_SESSION['data_nazev'])));
?>