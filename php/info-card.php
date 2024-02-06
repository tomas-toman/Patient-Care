<?php
    session_start();

    include "../php/conn.php";

    $button = $_POST['button'];
    $cislo_pokoje = $_SESSION['cislo_pokoje'];
    $nazev_oddeleni = $_SESSION['data_nazev'];
    $_SESSION['akt_luzko'] = $button;

    $result = pg_prepare($conn, "my_query", 'SELECT p.fk_pacient, p.jmeno, p.prijmeni, p.datum_narozeni, p.rodne_cislo FROM pacienti p INNER JOIN luzka l USING(fk_pacient) INNER JOIN pokoje po USING(fk_pokoj) INNER JOIN oddeleni o USING(fk_oddeleni) WHERE l.cislo_luzka = $1 AND po.cislo_pokoje = $2 AND o.nazev = $3');

    $result = pg_execute($conn, "my_query", array($button, $cislo_pokoje, $nazev_oddeleni));

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);

    $_SESSION['data_pacient'] = $data;
?>