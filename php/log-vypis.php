<?php
    session_start();
 
    include './conn.php';

    $result = pg_prepare($conn, "my_query", 'SELECT * FROM log ORDER BY id DESC');

    $result = pg_execute($conn, "my_query", array());

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $_SESSION['data_log'] = $data;

    header("Location: ../html/log.php");
?>