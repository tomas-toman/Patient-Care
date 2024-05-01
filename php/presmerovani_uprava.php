<?php
    session_start();

    include './conn.php';

    $id = $_POST['button'];

    $result = pg_prepare($conn, "my_query", 'SELECT * FROM pacienti WHERE fk_pacient = $1');

    $result = pg_execute($conn, "my_query", array($id));

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $_SESSION['data_pacient'] = $data;

    header("Location: ../html/uprava-dokumentace.php");
?>