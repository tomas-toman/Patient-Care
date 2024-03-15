<?php
    session_start();

    include "../php/conn.php";

    $result = pg_prepare($conn, "my_query", 'SELECT p.fk_pacient, p.rodne_cislo, p.jmeno, p.prijmeni, p.datum_narozeni, l.cislo_luzka, po.cislo_pokoje, o.nazev FROM pacienti p INNER JOIN luzka l USING(fk_pacient) INNER JOIN pokoje po USING(fk_pokoj) INNER JOIN oddeleni o USING(fk_oddeleni) ORDER BY jmeno');

    $result = pg_execute($conn, "my_query", array());

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $_SESSION['data_pacienti_luzko'] = $data;

    $result2 = pg_prepare($conn, "my_query2", 'SELECT fk_pacient, rodne_cislo, jmeno, prijmeni, datum_narozeni FROM pacienti ORDER BY jmeno');

    $result2 = pg_execute($conn, "my_query2", array());

    $data2 = array();

    while ($row2 = pg_fetch_assoc($result2)) {
        $data2[] = $row2;
    }

    $_SESSION['data_pacienti_bez'] = $data2;

    header("Location: ../html/tabulka-pacienti.php");
?>