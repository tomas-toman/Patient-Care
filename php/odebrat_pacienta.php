<?php
    session_start();

    include "./conn.php";

    $data_pacient = $_SESSION['data_pacient'];

    $result = pg_prepare($conn, "my_query", 'UPDATE luzka SET fk_pacient = NULL WHERE fk_pacient = $1');
    $result = pg_execute($conn, "my_query", array($data_pacient[0]["fk_pacient"]));

    $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " odebral/a pacienta " . $data_pacient[0]["jmeno"] . " " . $data_pacient[0]["prijmeni"] . " z lůžka.";

    $result = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
    $result = pg_execute($conn, "log", array($logData));
?>