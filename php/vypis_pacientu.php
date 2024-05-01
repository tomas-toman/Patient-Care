<?php
    session_start();

    include "../php/conn.php";

    $result = pg_prepare($conn, "my_query", 'SELECT p.fk_pacient, p.rodne_cislo, p.jmeno, p.prijmeni, p.datum_narozeni, l.cislo_luzka, po.cislo_pokoje, o.nazev FROM pacienti p INNER JOIN luzka l USING(fk_pacient) INNER JOIN pokoje po USING(fk_pokoj) INNER JOIN oddeleni o USING(fk_oddeleni) WHERE l.cislo_luzka IS NOT NULL AND po.cislo_pokoje IS NOT NULL AND o.nazev IS NOT NULL ORDER BY jmeno');

    $result = pg_execute($conn, "my_query", array());

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    $_SESSION['data_pacienti_luzko'] = $data;

    $result2 = pg_prepare($conn, "my_query2", 'SELECT p.fk_pacient, p.rodne_cislo, p.jmeno, p.prijmeni, p.datum_narozeni, l.cislo_luzka, po.cislo_pokoje, o.nazev FROM pacienti p LEFT JOIN luzka l ON p.fk_pacient = l.fk_pacient LEFT JOIN pokoje po ON l.fk_pokoj = po.fk_pokoj LEFT JOIN oddeleni o ON po.fk_oddeleni = o.fk_oddeleni WHERE l.fk_pacient IS NULL ORDER BY jmeno');

    $result2 = pg_execute($conn, "my_query2", array());

    $data2 = array();

    while ($row2 = pg_fetch_assoc($result2)) {
        $data2[] = $row2;
    }

    $_SESSION['data_pacienti_bez'] = $data2;

    header("Location: ../html/tabulka-pacienti.php");
?>