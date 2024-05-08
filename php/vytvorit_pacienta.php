<?php
    session_start();

    include './conn.php';

    $rodne_cislo = $_POST['rodne-cislo'];
    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $datum_narozeni = $_POST['datum-narozeni'];
    $den_hospitalizace = $_POST['den-hospitalizace'];
    $rezim_operacni_den = $_POST['rezim-operacni-den'];

    $diagnoza = $_POST['diagnoza'];
    $alergie = $_POST['alergie'];
    $vyska = $_POST['vyska'];
    $vaha = $_POST['vaha'];
    $vedomi = isset($_POST['vedomi']) ? $_POST['vedomi'] : array();
    $mobilita = isset($_POST['mobilita']) ? $_POST['mobilita'] : array();
    $komunikace = isset($_POST['komunikace']) ? $_POST['komunikace'] : array();
    $pomucky = isset($_POST['pomucky']) ? $_POST['pomucky'] : array();
    $dychani = isset($_POST['dychani']) ? $_POST['dychani'] : array();
    $vyziva = isset($_POST['vyziva']) ? $_POST['vyziva'] : array();
    $moc = isset($_POST['moc']) ? $_POST['moc'] : array();
    $stolice = isset($_POST['stolice']) ? $_POST['stolice'] : array();
    $vstupy = isset($_POST['vstupy']) ? $_POST['vstupy'] : array();
    $kuze = isset($_POST['kuze']) ? $_POST['kuze'] : array();
    $bolest = isset($_POST['bolest']) ? $_POST['bolest'] : array();
    $chovani = isset($_POST['chovani']) ? $_POST['chovani'] : array();
    $vysetreni = $_POST['vysetreni'];
    $lecba = $_POST['lecba'];
    $ordinace = $_POST['ordinace'];

    $info_json = json_encode(array(
        "diagnoza" => $diagnoza,
        "alergie" => $alergie,
        "vyska" => $vyska,
        "vaha" => $vaha,
        "vedomi" => implode('; ', $vedomi),
        "mobilita,sobestacnost" => implode('; ', $mobilita),
        "komunikace" => implode('; ', $komunikace),
        "kompenzacni_pomucky" => implode('; ', $pomucky),
        "dychani" => implode('; ', $dychani),
        "vyziva,tekutiny" => implode('; ', $vyziva),
        "vylucovani_moci" => implode('; ', $moc),
        "vylucovani_stolice" => implode('; ', $stolice),
        "vstupy" => implode('; ', $vstupy),
        "kuze" => implode('; ', $kuze),
        "bolest" => implode('; ', $bolest),
        "chovani,spanek" => implode('; ', $chovani),
        "vysetreni" => $vysetreni,
        "lecba,leky" => $lecba,
        "ordinace,osetrovatelska_pece" => $ordinace
    ));
    
    $result = pg_prepare($conn, "pacient_query", 'INSERT INTO pacienti (rodne_cislo, jmeno, prijmeni, datum_narozeni, den_hospitalizace, rezim_operacni_den, info_json) VALUES ($1, $2, $3, $4, $5, $6, $7)');
    $result = pg_execute($conn, "pacient_query", array($rodne_cislo, $jmeno, $prijmeni, $datum_narozeni, $den_hospitalizace, $rezim_operacni_den, $info_json));

    $logData = $_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni'] . " přidal/a pacienta " . $jmeno . " " . $prijmeni . " do databáze.";

    $result = pg_prepare($conn, "log", "INSERT INTO log (data, datum) VALUES ($1, DATE_TRUNC('second', NOW()))");
    $result = pg_execute($conn, "log", array($logData));

    header('Location: ./vypis_pacientu.php');
?>