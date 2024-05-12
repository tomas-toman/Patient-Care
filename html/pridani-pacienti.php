<?php
    session_start();

    if ($_SESSION['user_opravneni'] > 2) {
        header('Location: ./menu.php');
        exit();
    }

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_jmeno']) && isset($_SESSION['user_prijmeni']) && isset($_SESSION['user_opravneni'])) {;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/db4d39efc5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/pridani-pacienti.css">
    <link rel="icon" href="../img/Logo.png" type="image/x-icon"/>
    <title>Patient care | Přidání pacienta</title>
    <script>
        jQuery(function(){
            var checkboxGroups = {};

            jQuery('input[type="checkbox"]').each(function(){
                var $this = $(this);
                var name = this.name;

                if (!checkboxGroups[name]) {
                    checkboxGroups[name] = [];
                }

                if (this.checked) {
                    checkboxGroups[name].push($this);
                }
            });

            jQuery('input[type="checkbox"]').click(function(){
                var $this = $(this);
                var max = $this.data('max');
                var name = this.name;

                if (this.checked) {
                    checkboxGroups[name].push($this);
                    if (checkboxGroups[name].length > max) {
                        checkboxGroups[name].shift().prop('checked', false);
                    }
                } else {
                    var index = checkboxGroups[name].indexOf($this);
                    if (index > -1) {
                        checkboxGroups[name].splice(index, 1);
                    }
                }
            });

            jQuery('form').on('submit', function(e){
                var checkboxNames = ['vedomi[]', 'mobilita[]', 'komunikace[]', 'pomucky[]', 'dychani[]', 'vyziva[]', 'moc[]', 'stolice[]', 'vstupy[]', 'kuze[]', 'bolest[]', 'chovani[]'];
                for (var i = 0; i < checkboxNames.length; i++) {
                    var checked = jQuery('input[name="' + checkboxNames[i] + '"]:checked').length > 0;
                    if (!checked) {
                        alert('V každém poli prosím zaškrtněte aspon jednu možnost.');
                        e.preventDefault();
                        return;
                    }
                }
            });
            
            var handleInputChange = function(inputId, checkboxId, prefix) {
                jQuery('#' + checkboxId).change(function(){
                    if (this.checked) {
                        jQuery('#' + inputId).focus();
                    } else {
                        jQuery('#' + inputId).val('');
                    }
                });

                jQuery('#' + inputId).on('input', function(){
                    var $this = jQuery(this);
                    var text = $this.val();
                    jQuery('#' + checkboxId).val(prefix + text);
                });
            };

            var inputConfigs = [
                { inputId: 'pomuckyInput', checkboxId: 'pomuckyJine', prefix: 'Jiné: ' },
                { inputId: 'vyzivaInput1', checkboxId: 'vyzivaJine1', prefix: 'Dieta č.: ' },
                { inputId: 'vyzivaInput2', checkboxId: 'vyzivaJine2', prefix: 'Tekutiny: ' },
                { inputId: 'vyzivaInput3', checkboxId: 'vyzivaJine3', prefix: 'Jiné: ' },
                { inputId: 'stoliceInput', checkboxId: 'stoliceJine', prefix: 'Příměs: ' },
                { inputId: 'vstupyInput1', checkboxId: 'vstupyJine1', prefix: 'PŽK: ' },
                { inputId: 'vstupyInput2', checkboxId: 'vstupyJine2', prefix: 'CŽK: ' },
                { inputId: 'vstupyInput3', checkboxId: 'vstupyJine3', prefix: 'Drény: ' },
                { inputId: 'vstupyInput4', checkboxId: 'vstupyJine4', prefix: 'Jiné: ' },
                { inputId: 'kuzeInput', checkboxId: 'kuzeJine', prefix: 'Lokalizace: ' },
            ];

            inputConfigs.forEach(function(config) {
                handleInputChange(config.inputId, config.checkboxId, config.prefix);
            });

                jQuery('#bolestJine').change(function(){
                if (this.checked) {
                    jQuery('#bolestInput1').focus();
                } else {
                    jQuery('#bolestInput1').val('');
                    jQuery('#bolestInput2').val('');
                    jQuery('#bolestInput3').val('');
                }});

                jQuery('#bolestInput1, #bolestInput2, #bolestInput3').on('input', function(){
                    var text1 = jQuery('#bolestInput1').val();
                    var text2 = jQuery('#bolestInput2').val();
                    var text3 = jQuery('#bolestInput3').val();
                    jQuery('#bolestJine').val('Charakter: ' + text1 + '; Lokalizace: ' + text2 + '; Stupeň: ' + text3);
                });
            });
    </script>
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
                <li><a href="./menu.php">Navigační menu</a></li>
                <li><a href="#">Zaměstnanci <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <form action="../php/vypis_zamestnancu.php"><button type="submit" class="proklik"><li>Výpis zaměstnanců</li></button></form>
                        <?php
                            if ($_SESSION['user_opravneni'] == 1) {
                                echo '<li><a href="./pridani-zamestnanci.php">Přidání zaměstnance</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                        <form action="../php/vypis_pacientu.php"><button type="submit" class="proklik"><li>Výpis pacientů</li></button></form>
                        <?php
                            if ($_SESSION['user_opravneni'] <= 2) {
                                echo '<li class="current_page"><a href="./pridani-pacienti.php">Přidání pacienta</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li><a href="../php/log-vypis.php">Log akcí</a></li>
                <li>
                    <div class="logged">
                        <p>Jste přihlášen/a jako <?=$_SESSION['user_jmeno'] . " " . $_SESSION['user_prijmeni']?></p>
                        <a href="../php/odhlaseni.php"><button>Odhlásit se <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180"></i></button></a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Přidání pacienta</h1>
        <form action="../php/vytvorit_pacienta.php" method="post">
            <div class="area1">
                <div class="input-group">
                    <label for="rodne-cislo" class="input-label">Rodné číslo*</label>
                    <input type="text" id="rodne-cislo" placeholder="Rodné číslo*" required name="rodne-cislo"></input>
                </div>

                <div class="input-group">
                    <label for="jmeno" class="input-label">Jméno*</label>
                    <input type="text" id="jmeno" placeholder="Jméno*" required name="jmeno"></input>
                </div>

                <div class="input-group">
                    <label for="prijmeni" class="input-label">Příjmení*</label>
                    <input type="text" id="prijmeni" placeholder="Příjmení*" required name="prijmeni"></input>
                </div>

                <div class="input-group">
                    <label for="datum-narozeni" class="input-label">Datum narození* (RRRR-MM-DD)</label>
                    <input type="text" id="datum-narozeni" placeholder="Datum narození* (RRRR-MM-DD)" required name="datum-narozeni"></input>
                </div>

                <div class="input-group">
                    <label for="den-hospitalizace" class="input-label">Den hospitalizace* (RRRR-MM-DD)</label>
                    <input type="text" id="den-hospitalizace" placeholder="Den hospitalizace* (RRRR-MM-DD)" required name="den-hospitalizace"></input>
                </div>

                <div class="input-group">
                    <label for="rezim-operacni-den" class="input-label">Režim/Operační den*</label>
                    <input type="text" id="rezim-operacni-den" placeholder="Režim/Operační den*" required name="rezim-operacni-den"></input>
                </div>
                
                <div class="input-group">
                    <label for="diagnoza" class="input-label">Diagnóza*</label>
                    <input type="text" id="diagnoza" placeholder="Diagnóza*" required name="diagnoza"></input>
                </div>
                
                <div class="input-group">
                    <label for="alergie" class="input-label">Alergie*</label>
                    <input type="text" id="alergie" placeholder="Alergie*" required name="alergie"></input>
                </div>

                <div class="input-group">
                    <label for="vyska" class="input-label">Výška* (cm)</label>
                    <input type="text" id="vyska" placeholder="Výška* (cm)" required name="vyska"></input>
                </div>
                
                <div class="input-group">
                    <label for="vaha" class="input-label">Váha* (kg)</label>
                    <input type="text" id="vaha" placeholder="Váha* (kg)" required name="vaha"></input>
                </div>
            </div>
            <div class="area2">
                <div>
                    <h2>Vědomí* (1)</h2>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Při vědomí" checked/> Při vědomí</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Orientován"/> Orientován</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Dezorientován"> Dezorientován</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Somnolence"> Somnolence</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Sopor"> Sopor</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Kóma"> Kóma</input>
                </div>
                <div>
                    <h2>Mobilita, <br>soběstačnost* (1)</h2>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Chodící" checked> Chodící</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Chodící s doprovodem"> Chodící s doprovodem</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Chodící s kompenzační pomůckou"> Chodící s kompenzační pomůckou</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Na sedačce"> Na sedačce</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Ležící"> Ležící</input>
                </div>
                <div>
                    <h2>Komunikace* (3)</h2>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Bez omezení" checked> Bez omezení</input>
                    <br>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Porucha řeči" > Porucha řeči</input>
                    <br>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Porucha sluchu" > Porucha sluchu</input>
                    <br>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Porucha zraku"> Porucha zraku</input>
                </div>
                <div>
                    <h2>Kompenzační <br>pomůcky* (3)</h2>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Bez kompenzačních pomůcek" checked> Bez kompenzačních pomůcek</input>
                    <br>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Naslouchátka"> Naslouchátka</input>
                    <br>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Brýle"> Brýle</input>
                    <br>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Jiné: " id="pomuckyJine"> Jiné <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="pomuckyInput"></input></input>
                </div>
            </div>
            <div class="area3">
                <div>
                    <h2>Dýchání* (5)</h2>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Bez obtíží" checked> Bez obtíží</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Kašel"> Kašel</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Tachypnoe"> Tachypnoe</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Expektorace"> Expektorace</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Bradypnoe"> Bradypnoe</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Dušnost"> Dušnost</input>
                </div>
                <div>
                    <h2>Výživa a <br>tekutiny* (5)</h2>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Bez problémů" checked> Bez problémů</input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="" id="vyzivaJine1"> Dieta č. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vyzivaInput1"></input></input>
                    <br> 
                    <input type="checkbox" name="vyziva[]" data-max="5" value="" id="vyzivaJine2"> Tekutiny <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vyzivaInput2"></input></input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Sonda"> Sonda</input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Zubní protéza"> Zubní protéza</input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="" id="vyzivaJine3"> Jiné <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vyzivaInput3"></input></input>
                </div>
                <div>
                    <h2>Vylučování <br>moči* (1)</h2>
                    <input type="checkbox" name="moc[]" data-max="1" value="Spontánní" checked> Spontánní</input>
                    <br>
                    <input type="checkbox" name="moc[]" data-max="1" value="Inkontinence"> Inkontinence</input>
                    <br>
                    <input type="checkbox" name="moc[]" data-max="1" value="Retence"> Retence</input>
                    <br>
                    <input type="checkbox" name="moc[]" data-max="1" value="PMK - den"> PMK - den</input>
                </div>
                <div>
                    <h2>Vylučování <br>stolice* (3)</h2>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Pravidelná, bez obtíží" checked> Pravidelná, bez obtíží</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Obstipace"> Obstipace</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Průjem"> Průjem</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Inkontinence"> Inkontinence</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="" id="stoliceJine"> Příměs <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="stoliceInput"></input></input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Stomie"> Stomie</input>
                </div>
            </div>
            <div class="area4">
                <div>
                    <h2>Vstupy* (4)</h2>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="Bez vstupů" checked> Bez vstupů</input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="" id="vstupyJine1"> PŽK <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vstupyInput1"></input></input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="" id="vstupyJine2"> CŽK <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vstupyInput2"></input></input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="" id="vstupyJine3"> Drény <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vstupyInput3"></input></input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="" id="vstupyJine4"> Jiné <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vstupyInput4"></input></input>
                </div>
                <div>
                    <h2>Kůže* (6)</h2>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Beze změn" checked> Beze změn</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Ikterus"> Ikterus</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Cyanóza"> Cyanóza</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Dekubitus"> Dekubitus</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Bércový vřed"> Bércový vřed</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Hematom"> Hematom</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="" id="kuzeJine"> Lokalizace <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="kuzeInput"></input></input>
                </div>
                <div>
                    <h2>Bolest* (1)</h2>
                    <input type="checkbox" name="bolest[]" data-max="1" value="Bez bolesti" checked> Bez bolesti</input>
                    <br>
                    <input type="checkbox" name="bolest[]" data-max="1" value="" id="bolestJine"> Bolest:
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Charakter <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="bolestInput1"></input>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokalizace <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="bolestInput2"></input>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stupěň <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="bolestInput3"></input>
                    </input>
                </div>
                <div>
                    <h2>Chování, <br>spánek* (3)</h2>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Klidný" checked> Klidný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Neklidný"> Neklidný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Vyrovnaný" checked> Vyrovnaný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Nevyrovnaný"> Nevyrovnaný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Spolupracující" checked> Spolupracující</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Nespolupracující"> Nespolupracující</input>
                    <br>
                </div>
            </div>
            <div class="area5">
                <div>
                    <h2>Vyšetření*</h2>
                    <textarea rows="30" maxlength="512" name="vysetreni" required></textarea>
                </div>
                <div>
                    <h2>Léčba/Léky*</h2>
                    <textarea rows="30" maxlength="512" name="lecba" required></textarea>
                </div>
                <div>
                    <h2>Ordinace/ <br>Ošetřovatelská péče*</h2>
                    <textarea class="ordinace" rows="30" maxlength="512" name="ordinace" required></textarea>
                </div>
            </div>
            <div class="area6">
                <button id="add-btn" type="submit">Přidat</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    } else {
        header("Location: ./prihlaseni.php");
    }
?>