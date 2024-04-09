<?php
    session_start();

    include "./conn.php";

    $button = $_POST['delete-btn'];

    $result3 = pg_prepare($conn, "pacient_query", "SELECT jmeno, prijmeni FROM pacienti WHERE fk_pacient = $1");
    $result3 = pg_execute($conn, "pacient_query", array($button));

    $data = array();

    while ($row = pg_fetch_array($result3)) {
        $data[] = $row;
    }

    $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " smazal/a pacienta " . $data[0]["jmeno"] . " " . $data[0]["prijmeni"] . " z databáze.";

    $result2 = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
    $result2 = pg_execute($conn, "log", array($logData));

    $result = pg_prepare($conn, "delete_pacient", "DELETE FROM pacienti WHERE fk_pacient = $1");
    $result = pg_execute($conn, "delete_pacient", array($button));

    header("Location: ./vypis_pacientu.php");
?>