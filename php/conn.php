<?php
    $conn = pg_connect("host=localhost dbname=PatientCare user=postgres password=admin");
    if (!$conn) {
        echo "Nepodařilo se připojit k databázi";
        exit;
    }
?>