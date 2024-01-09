<?php
    session_start();
    include "./conn.php";

    if (isset($_POST['uzivatelske_jmeno']) && isset($_POST['heslo'])) {
        $uzivatelske_jmeno = $_POST['uzivatelske_jmeno'];
        $heslo = $_POST['heslo'];

        if (empty($uzivatelske_jmeno) || empty($heslo)) {
            header("Location: ../html/prihlaseni.php?error=Vypňte všechny údaje!");
        } else {
            $query = pg_query($conn, "SELECT * FROM zamestnanci WHERE prihlasovaci_jmeno = '$uzivatelske_jmeno'");
            if (pg_num_rows($query) === 1) {
                $user = pg_fetch_assoc($query);

                $user_id = $user['id'];
                $user_prihlasovaci_jmeno = $user['prihlasovaci_jmeno'];
                $user_heslo = $user['heslo'];
                $user_jmeno = $user['jmeno'];
                $user_prijmeni = $user['prijmeni'];

                if ($uzivatelske_jmeno === $user_prihlasovaci_jmeno) {
                    if (password_verify($heslo, $user_heslo)) {
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_jmeno'] = $user_jmeno;
                        $_SESSION['user_prijmeni'] = $user_prijmeni;
                        header("Location: ../html/menu.php");
                    } else {
                        header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
                    }
                } else {
                    header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
                
                }
            } else {
                header("Location: ../html/prihlaseni.php?error=Špatně zadané údaje!");
            }
        }
    } 
?>