<?php
    session_start();
    
    include './conn.php';

    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $prih_jmeno = $_POST['prih_jmeno'];
    $heslo = password_hash($_POST['heslo'], PASSWORD_DEFAULT);
    $pozice = $_POST['pozice'];
    $specializace = $_POST['specializace'];
    $opravneni = $_POST['opravneni'];

    if($pozice_id != "-"){
        $result = pg_prepare($conn, "pozice_query", 'SELECT fk_pozice FROM pozice WHERE nazev_pozice = $1');
        $result = pg_execute($conn, "pozice_query", array($pozice));
        $pozice_id = pg_fetch_result($result, 0, 0);
    } else {
        $pozice_id = NULL;
    }

    if($specializace != "-") {
        $result = pg_prepare($conn, "specializace_query", 'SELECT fk_specializace FROM specializace WHERE nazev_specializace = $1');
        $result = pg_execute($conn, "specializace_query", array($specializace));
        $specializace_id = pg_fetch_result($result, 0, 0);
    } else {
        $specializace_id = NULL;
    }

    $result = pg_prepare($conn, "my_query", 'INSERT INTO zamestnanci (jmeno, prijmeni, prihlasovaci_jmeno, heslo, fk_pozice, fk_specializace, opravneni) VALUES ($1, $2, $3, $4, $5, $6, $7)');
    $result = pg_execute($conn, "my_query", array($jmeno, $prijmeni, $prih_jmeno, $heslo, $pozice_id, $specializace_id, $opravneni));

    $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " přidal/a zaměstnance " . $jmeno . " " . $prijmeni . " do databáze.";

    $result = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
    $result = pg_execute($conn, "log", array($logData));

    header('Location: ./vypis_zamestnancu.php');
?>