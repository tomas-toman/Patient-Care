<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/db4d39efc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/menu.css">
    <title>Patient care | Navigační menu</title>
</head>
<body>
    <header>
        <a href="./menu.php" class="logo">
            <img src="../img/Logo.png" alt="">
        </a>

        <input type="checkbox" id="menu-bars">
        <label for="menu-bars"><i class="fa-solid fa-bars fa-xl" style="color: #719ED4;"></i></label>

        <nav class="navbar">
            <ul>
                <li><a href="#">Navigační menu</a></li>
                <li><a href="#">Zaměstnanci <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <li><a href="#">Výpis zamětnanců</a></li>
                        <li><a href="#">Přidání zamětnance</a></li>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <li><a href="#">Výpis pacientů</a></li>
                        <li><a href="#">Přidání pacienta</a></li>
                    </ul>
                </li>
                <li><a href="#">Log akcí</a></li>
                <li>
                    <div class="logged">
                        <p>Jste přihlášen/a jako {user}</p>
                        <a href="./prihlaseni.php"><button>Odhlásit se <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i></button></a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div id="title1">
            <p>1. Patro</p>
        </div>
        <div id="buttons1">
            <a href="#"><button>Chirurgické odd.</button></a>
            <a href="#"><button>JIP</button></a>
            <a href="#"><button>Gynekologicko-porodnické odd.</button></a>
            <a href="#"><button>Traumatologické odd.</button></a>
            <a href="#"><button>ORL a CHHK</button></a>
            <a href="#"><button>Novorozenecké odd.</button></a>
        </div>
        <div id="title2">
            <p>2. Patro</p>
        </div>
        <div id="buttons2">
            <a href="#"><button>ARO</button></a>
            <a href="#"><button>Dětské odd.</button></a>
            <a href="#"><button>DIP</button></a>
            <a href="#"><button>VIN I.</button></a>
            <a href="#"><button>VIN II.</button></a>
            <a href="#"><button>Urologické odd.</button></a>
            <a href="#"><button>TRN</button></a>
            <a href="#"><button>Neurologické odd.</button></a>
        </div>
        <div id="map">Mapa nemocnice</div>
    </div>
</body>
</html>