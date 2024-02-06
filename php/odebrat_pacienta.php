<?php
    session_start();

    include "./conn.php";

    $data_pacient = $_SESSION['data_pacient'];

    $result = pg_prepare($conn, "my_query", 'UPDATE luzka SET fk_pacient = NULL WHERE fk_pacient = $1');

    $result = pg_execute($conn, "my_query", array($data_pacient[0]["fk_pacient"]));
?>