<?php
    session_start();
    include "../php/conn.php";

    $button = $_POST['button'];
    $sessionData = $_SESSION['data_nazev'];

    //Data o pokoji ve kterém jsem

    $result = pg_prepare($conn, "my_query", "SELECT * FROM pokoje p INNER JOIN oddeleni o USING(fk_oddeleni) WHERE p.cislo_pokoje = $1 AND o.nazev = $2");

    $result = pg_execute($conn, "my_query", array($button, $sessionData));

    $data = pg_fetch_assoc($result);

    $_SESSION['cislo_pokoje'] = $data['cislo_pokoje'];

    //Data o lůžkách v pokoji ve kterém jsem

    $result2 = pg_prepare($conn, "my_query2", 'SELECT * FROM luzka WHERE fk_pokoj = $1');

    $result2 = pg_execute($conn, "my_query2", array($button));

    $data2 = array();

    while ($row = pg_fetch_assoc($result2)) {
        $data2[] = $row;
    }

    $_SESSION['data_luzka'] = $data2;

    //Přesměrování na stránku s pokojem

    header("Location: ../html/pokoj.php");
?>