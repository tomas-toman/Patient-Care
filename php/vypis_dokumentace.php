<?php
    session_start();

    include "./conn.php";

    $data_pacient = $_SESSION['data_pacient'];

    $result = pg_prepare($conn, "my_query", 'SELECT * FROM pacienti WHERE fk_pacient = $1');

    $result = pg_execute($conn, "my_query", array($data_pacient[0]["fk_pacient"]));

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $_SESSION['data_pacient'] = $data;

    header("Location: ../html/dokumentace.php");
?>