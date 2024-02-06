<?php
    include "./conn.php";

    $result = pg_prepare($conn, "my_query", 'SELECT p.fk_pacient, p.rodne_cislo, p.jmeno, p.prijmeni, p.datum_narozeni FROM pacienti p LEFT JOIN luzka l USING(fk_pacient) WHERE l.fk_pacient IS NULL ORDER BY p.prijmeni, p.jmeno');

    $result = pg_execute($conn, "my_query", array());

    $data = array();

    while ($row = pg_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
?>