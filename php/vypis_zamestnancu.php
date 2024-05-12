<?php
    session_start();

    include "../php/conn.php";

    $result = pg_prepare($conn, "my_query", 'SELECT z.id, z.jmeno, z.prijmeni, p.nazev_pozice, s.nazev_specializace FROM zamestnanci z LEFT JOIN pozice p USING(fk_pozice) LEFT JOIN specializace s USING(fk_specializace) ORDER BY z.jmeno');

    $result = pg_execute($conn, "my_query", array());

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $_SESSION['data_zamestnanci'] = $data;

    header("Location: ../html/tabulka-zamestnanci.php");
?>