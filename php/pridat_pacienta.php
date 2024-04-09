<?php
    session_start();

    include "./conn.php";

    $button = $_POST['button-add'];
    
    $result = pg_prepare($conn, "my_query", "UPDATE luzka l SET fk_pacient = $1 FROM pokoje p JOIN oddeleni o ON p.fk_oddeleni = o.fk_oddeleni WHERE l.fk_pokoj = p.fk_pokoj AND l.cislo_luzka = $2 AND p.cislo_pokoje = $3 AND o.nazev = $4");
    $result = pg_execute($conn, "my_query", array($button, pg_escape_string($_SESSION['akt_luzko']), pg_escape_string($_SESSION['cislo_pokoje']), pg_escape_string($_SESSION['data_nazev'])));

    $result3 = pg_prepare($conn, "pacient_query", "SELECT jmeno, prijmeni FROM pacienti WHERE fk_pacient = $1");
    $result3 = pg_execute($conn, "pacient_query", array($button));

    $data = array();

    while ($row = pg_fetch_array($result3)) {
        $data[] = $row;
    }

    $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " přidal/a pacienta " . $data[0]["jmeno"] . " " . $data[0]["prijmeni"] . " na lůžko.";

    $result2 = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
    $result2 = pg_execute($conn, "log", array($logData));
?>