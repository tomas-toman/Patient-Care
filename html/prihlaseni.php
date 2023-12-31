<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/prihlaseni.css">
    <title>Patient care | Přihlášení</title>
</head>
<body>
    <div class="background">
        <div class="container">
            <form action="../php/overeni.php" method="post">
                <div class="img-box">
                    <img src="../img/Logo.png" alt="">
                </div>
                <div class="input-box">
                    <input type="text" class="input" name="uzivatelske_jmeno" placeholder="Uživatelské jméno">
                </div>
                <div class="input-box">
                    <input type="password" class="input" name="heslo" placeholder="Heslo">
                </div>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="alert"><?=$_GET['error']?></p>
                <?php } ?>
                <input type="submit" class="button-submit" value="Potvrdit">
            </form>
        </div>
    </div>
</body>
</html>