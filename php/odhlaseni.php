<?php
    session_start();

    include "./conn.php";

    $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " se odhlásil/a.";

    $result = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
    $result = pg_execute($conn, "log", array($logData));

    session_unset();
    session_destroy();

    header("Location: ../html/prihlaseni.php");