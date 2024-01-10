<?php
    session_start();
    include "../php/conn.php";

    $button = $_POST['button'];

    //Data o oddělení

    $result = pg_prepare($conn, "my_query", 'SELECT * FROM oddeleni WHERE fk_oddeleni = $1');

    $result = pg_execute($conn, "my_query", array($button));

    $data = pg_fetch_assoc($result);

    $_SESSION['data_nazev'] = $data['nazev'];

    //Data o pokojích na oddělení

    $result2 = pg_prepare($conn, "my_query2", 'SELECT * FROM pokoje WHERE fk_oddeleni = $1');

    $result2 = pg_execute($conn, "my_query2", array($button));

    $data2 = array();

    while ($row = pg_fetch_assoc($result2)) {
        $data2[] = $row;
    }

    $_SESSION['data_pokoje'] = $data2;

    //Přesměrování na stránku s oddělením

    header("Location: ../html/oddeleni.php");
?>