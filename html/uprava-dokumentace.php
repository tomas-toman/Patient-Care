<?php
    session_start();
    $data_pacient = $_SESSION['data_pacient'][0];
    $info_json = json_decode($data_pacient['info_json'], true);
    $komunikace_values = isset($info_json['komunikace']) ? explode('; ', $info_json['komunikace']) : array();
    $pomucky_values = isset($info_json['kompenzacni_pomucky']) ? explode('; ', $info_json['kompenzacni_pomucky']) : array();
    $dychani_values = isset($info_json['dychani']) ? explode('; ', $info_json['dychani']) : array();
    $vyziva_tekutiny_values = isset($info_json['vyziva,tekutiny']) ? explode('; ', $info_json['vyziva,tekutiny']) : array();
    $stolice_values = isset($info_json['vylucovani_stolice']) ? explode('; ', $info_json['vylucovani_stolice']) : array();
    $vstupy_values = isset($info_json['vstupy']) ? explode('; ', $info_json['vstupy']) : array();
    $kuze_values = isset($info_json['kuze']) ? explode('; ', $info_json['kuze']) : array();
    $chovani_values = isset($info_json['chovani,spanek']) ? explode('; ', $info_json['chovani,spanek']) : array();

    function get_value($info, $label, $nextLabel) {
        $startPos = strpos($info, $label);
        if ($startPos !== false) {
            $startPos += strlen($label);
            $endPos = strpos($info, $nextLabel, $startPos);
            if ($endPos !== false) {
                $value = trim(substr($info, $startPos, $endPos - $startPos));
            } else {
                $value = trim(substr($info, $startPos));
            }
            return rtrim($value, ',');
        }
        return '';
    }

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_jmeno']) && isset($_SESSION['user_prijmeni'])) {;
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
                        <li><a href="./pridani-zamestnanci.php">Přidání zaměstnance</a></li>
                    </ul>
                </li>
                <li><a href="#">Pacienti <i class="fa-solid fa-caret-down fa-rotate-90"></i></a>
                    <ul>
                    <form action="../php/vypis_pacientu.php"><button type="submit" class="proklik"><li>Výpis pacientů</li></button></form>
                        <li class="current_page"><a href="./pridani-pacienti.php">Přidání pacienta</a></li>
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
        <h1>Úprava dokumentace</h1>
        <form action="../php/upravit_dokumentaci.php" method="post">
            <div class="area1">
                <div class="input-group">
                    <label for="rodne-cislo" class="input-label">Rodné číslo*</label>
                    <input type="text" id="rodne-cislo" placeholder="Rodné číslo*" required name="rodne-cislo" value="<?php echo $data_pacient['rodne_cislo']; ?>"></input>
                </div>

                <div class="input-group">
                    <label for="jmeno" class="input-label">Jméno*</label>
                    <input type="text" id="jmeno" placeholder="Jméno*" required name="jmeno" value="<?php echo $data_pacient['jmeno']; ?>"></input>
                </div>

                <div class="input-group">
                    <label for="prijmeni" class="input-label">Příjmení*</label>
                    <input type="text" id="prijmeni" placeholder="Příjmení*" required name="prijmeni" value="<?php echo $data_pacient['prijmeni']; ?>"></input>
                </div>

                <div class="input-group">
                    <label for="datum-narozeni" class="input-label">Datum narození* (RRRR-MM-DD)</label>
                    <input type="text" id="datum-narozeni" placeholder="Datum narození* (RRRR-MM-DD)" required name="datum-narozeni" value="<?php echo $data_pacient['datum_narozeni']; ?>"></input>
                </div>

                <div class="input-group">
                    <label for="den-hospitalizace" class="input-label">Den hospitalizace* (RRRR-MM-DD)</label>
                    <input type="text" id="den-hospitalizace" placeholder="Den hospitalizace* (RRRR-MM-DD)" required name="den-hospitalizace" value="<?php echo $data_pacient['den_hospitalizace']; ?>"></input>
                </div>

                <div class="input-group">
                    <label for="rezim-operacni-den" class="input-label">Režim/Operační den*</label>
                    <input type="text" id="rezim-operacni-den" placeholder="Režim/Operační den*" required name="rezim-operacni-den" value="<?php echo $data_pacient['rezim_operacni_den']; ?>"></input>
                </div>
                
                <div class="input-group">
                    <label for="diagnoza" class="input-label">Diagnóza*</label>
                    <input type="text" id="diagnoza" placeholder="Diagnóza*" required name="diagnoza" value="<?php echo isset($info_json['diagnoza']) ? $info_json['diagnoza'] : ''; ?>"></input>
                </div>
                
                <div class="input-group">
                    <label for="alergie" class="input-label">Alergie*</label>
                    <input type="text" id="alergie" placeholder="Alergie*" required name="alergie" value="<?php echo isset($info_json['alergie']) ? $info_json['alergie'] : ''; ?>"></input>
                </div>

                <div class="input-group">
                    <label for="vyska" class="input-label">Výška* (cm)</label>
                    <input type="text" id="vyska" placeholder="Výška* (cm)" required name="vyska" value="<?php echo isset($info_json['vyska']) ? $info_json['vyska'] : ''; ?>"></input>
                </div>
                
                <div class="input-group">
                    <label for="vaha" class="input-label">Váha* (kg)</label>
                    <input type="text" id="vaha" placeholder="Váha* (kg)" required name="vaha" value="<?php echo isset($info_json['vaha']) ? $info_json['vaha'] : ''; ?>"></input>
                </div>
            </div>
            <div class="area2">
                <div>
                    <h2>Vědomí* (1)</h2>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Při vědomí" <?php echo $info_json['vedomi'] == 'Při vědomí' ? 'checked' : ''; ?>/> Při vědomí</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Orientován" <?php echo $info_json['vedomi'] == 'Orientován' ? 'checked' : ''; ?>/> Orientován</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Dezorientován" <?php echo $info_json['vedomi'] == 'Dezorientován' ? 'checked' : ''; ?>> Dezorientován</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Somnolence" <?php echo $info_json['vedomi'] == 'Somnolence' ? 'checked' : ''; ?>> Somnolence</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Sopor" <?php echo $info_json['vedomi'] == 'Sopor' ? 'checked' : ''; ?>> Sopor</input>
                    <br>
                    <input type="checkbox" name="vedomi[]" data-max="1" value="Kóma" <?php echo $info_json['vedomi'] == 'Kóma' ? 'checked' : ''; ?>> Kóma</input>
                </div>
                <div>
                    <h2>Mobilita, <br>soběstačnost* (1)</h2>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Chodící" <?php echo $info_json['mobilita,sobestacnost'] == 'Chodící' ? 'checked' : ''; ?>> Chodící</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Chodící s doprovodem" <?php echo $info_json['mobilita,sobestacnost'] == 'Chodící s doprovodem' ? 'checked' : ''; ?>> Chodící s doprovodem</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Chodící s kompenzační pomůckou" <?php echo $info_json['mobilita,sobestacnost'] == 'Chodící s kompenzační pomůckou' ? 'checked' : ''; ?>> Chodící s kompenzační pomůckou</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Na sedačce" <?php echo $info_json['mobilita,sobestacnost'] == 'Na sedačce' ? 'checked' : ''; ?>> Na sedačce</input>
                    <br>
                    <input type="checkbox" name="mobilita[]" data-max="1" value="Ležící" <?php echo $info_json['mobilita,sobestacnost'] == 'Ležící' ? 'checked' : ''; ?>> Ležící</input>
                </div>
                <div>
                    <h2>Komunikace* (3)</h2>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Bez omezení" <?php echo in_array('Bez omezení', $komunikace_values) ? 'checked' : ''; ?>> Bez omezení</input>
                    <br>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Porucha řeči" <?php echo in_array('Porucha řeči', $komunikace_values) ? 'checked' : ''; ?>> Porucha řeči</input>
                    <br>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Porucha sluchu" <?php echo in_array('Porucha sluchu', $komunikace_values) ? 'checked' : ''; ?>> Porucha sluchu</input>
                    <br>
                    <input type="checkbox" name="komunikace[]" data-max="3" value="Porucha zraku" <?php echo in_array('Porucha zraku', $komunikace_values) ? 'checked' : ''; ?>> Porucha zraku</input>
                </div>
                <div>
                    <h2>Kompenzační <br>pomůcky* (3)</h2>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Bez kompenzačních pomůcek" <?php echo in_array('Bez kompenzačních pomůcek', $pomucky_values) ? 'checked' : ''; ?>> Bez kompenzačních pomůcek</input>
                    <br>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Naslouchátka" <?php echo in_array('Naslouchátka', $pomucky_values) ? 'checked' : ''; ?>> Naslouchátka</input>
                    <br>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="Brýle" <?php echo in_array('Brýle', $pomucky_values) ? 'checked' : ''; ?>> Brýle</input>
                    <br>
                    <input type="checkbox" name="pomucky[]" data-max="3" value="<?php echo strpos($info_json['kompenzacni_pomucky'], 'Jiné: ') !== false ? substr($info_json['kompenzacni_pomucky'], strpos($info_json['kompenzacni_pomucky'], 'Jiné: ')) : ''; ?>" id="pomuckyJine" <?php echo strpos($info_json['kompenzacni_pomucky'], 'Jiné: ') !== false ? 'checked' : ''; ?>> Jiné <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="pomuckyInput" value="<?php echo strpos($info_json['kompenzacni_pomucky'], 'Jiné: ') !== false ? substr($info_json['kompenzacni_pomucky'], strpos($info_json['kompenzacni_pomucky'], 'Jiné: ') + 7) : ''; ?>"></input>
                </div>
            </div>
            <div class="area3">
                <div>
                    <h2>Dýchání* (5)</h2>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Bez obtíží" <?php echo in_array('Bez obtíží', $dychani_values) ? 'checked' : ''; ?>> Bez obtíží</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Kašel" <?php echo in_array('Kašel', $dychani_values) ? 'checked' : ''; ?>> Kašel</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Tachypnoe" <?php echo in_array('Tachypnoe', $dychani_values) ? 'checked' : ''; ?>> Tachypnoe</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Expektorace" <?php echo in_array('Expektorace', $dychani_values) ? 'checked' : ''; ?>> Expektorace</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Bradypnoe" <?php echo in_array('Bradypnoe', $dychani_values) ? 'checked' : ''; ?>> Bradypnoe</input>
                    <br>
                    <input type="checkbox" name="dychani[]" data-max="5" value="Dušnost" <?php echo in_array('Dušnost', $dychani_values) ? 'checked' : ''; ?>> Dušnost</input>
                </div>
                <div>
                    <h2>Výživa a <br>tekutiny* (5)</h2>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Bez problémů" <?php echo in_array('Bez problémů', $vyziva_tekutiny_values) ? 'checked' : ''; ?>> Bez problémů</input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Sonda" <?php echo in_array('Sonda', $vyziva_tekutiny_values) ? 'checked' : ''; ?>> Sonda</input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Zubní protéza" <?php echo in_array('Zubní protéza', $vyziva_tekutiny_values) ? 'checked' : ''; ?>> Zubní protéza</input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Dieta č.: <?php echo get_value($info_json['vyziva,tekutiny'], 'Dieta č.: ', ';'); ?>" id="vyzivaJine1" <?php echo strpos($info_json['vyziva,tekutiny'], 'Dieta č.: ') !== false ? 'checked' : ''; ?>> Dieta č. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vyzivaInput1" value="<?php echo get_value($info_json['vyziva,tekutiny'], 'Dieta č.: ', ';'); ?>"></input>
                    <br> 
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Tekutiny: <?php echo get_value($info_json['vyziva,tekutiny'], 'Tekutiny: ', ';'); ?>" id="vyzivaJine2" <?php echo strpos($info_json['vyziva,tekutiny'], 'Tekutiny: ') !== false ? 'checked' : ''; ?>> Tekutiny <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vyzivaInput2" value="<?php echo get_value($info_json['vyziva,tekutiny'], 'Tekutiny: ', ';'); ?>"></input>
                    <br>
                    <input type="checkbox" name="vyziva[]" data-max="5" value="Jiné: <?php echo get_value($info_json['vyziva,tekutiny'], 'Jiné: ', ';'); ?>" id="vyzivaJine3" <?php echo strpos($info_json['vyziva,tekutiny'], 'Jiné: ') !== false ? 'checked' : ''; ?>> Jiné <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="vyzivaInput3" value="<?php echo get_value($info_json['vyziva,tekutiny'], 'Jiné: ', PHP_EOL); ?>"></input>
                </div>
                <div>
                    <h2>Vylučování <br>moči* (1)</h2>
                    <input type="checkbox" name="moc[]" data-max="1" value="Spontánní" <?php echo $info_json['vylucovani_moci'] == 'Spontánní' ? 'checked' : ''; ?>> Spontánní</input>
                    <br>
                    <input type="checkbox" name="moc[]" data-max="1" value="Inkontinence" <?php echo $info_json['vylucovani_moci'] == 'Inkontinence' ? 'checked' : ''; ?>> Inkontinence</input>
                    <br>
                    <input type="checkbox" name="moc[]" data-max="1" value="Retence" <?php echo $info_json['vylucovani_moci'] == 'Retence' ? 'checked' : ''; ?>> Retence</input>
                    <br>
                    <input type="checkbox" name="moc[]" data-max="1" value="PMK - den" <?php echo $info_json['vylucovani_moci'] == 'PMK - den' ? 'checked' : ''; ?>> PMK - den</input>
                </div>
                <div>
                    <h2>Vylučování <br>stolice* (3)</h2>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Pravidelná, bez obtíží" <?php echo in_array('Pravidelná, bez obtíží', $stolice_values) ? 'checked' : ''; ?>> Pravidelná, bez obtíží</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Obstipace" <?php echo in_array('Obstipace', $stolice_values) ? 'checked' : ''; ?>> Obstipace</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Průjem" <?php echo in_array('Průjem', $stolice_values) ? 'checked' : ''; ?>> Průjem</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Inkontinence" <?php echo in_array('Inkontinence', $stolice_values) ? 'checked' : ''; ?>> Inkontinence</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="Stomie" <?php echo in_array('Stomie', $stolice_values) ? 'checked' : ''; ?>> Stomie</input>
                    <br>
                    <input type="checkbox" name="stolice[]" data-max="3" value="<?php echo strpos($info_json['vylucovani_stolice'], 'Příměs: ') !== false ? substr($info_json['vylucovani_stolice'], strpos($info_json['vylucovani_stolice'], 'Příměs: ')) : ''; ?>" id="stoliceJine" <?php echo strpos($info_json['vylucovani_stolice'], 'Příměs: ') !== false ? 'checked' : ''; ?>> Příměs <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="stoliceInput" id="stoliceInput" value="<?php echo strpos($info_json['vylucovani_stolice'], 'Příměs: ') !== false ? substr($info_json['vylucovani_stolice'], strpos($info_json['vylucovani_stolice'], 'Příměs: ') + 11) : ''; ?>"></input>
                </div>
            </div>
            <div class="area4">
                <div>
                    <h2>Vstupy* (4)</h2>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="Bez vstupů" <?php echo in_array('Bez vstupů', $vstupy_values) ? 'checked' : ''; ?>> Bez vstupů</input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="PŽK: <?php echo get_value($info_json['vstupy'], 'PŽK: ', ';'); ?>" id="vstupyJine1" <?php echo strpos($info_json['vstupy'], 'PŽK: ') !== false ? 'checked' : ''; ?>> PŽK <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vstupyInput1" id="vstupyInput1" value="<?php echo get_value($info_json['vstupy'], 'PŽK: ', ';'); ?>"></input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="CŽK: <?php echo get_value($info_json['vstupy'], 'CŽK: ', ';'); ?>" id="vstupyJine2" <?php echo strpos($info_json['vstupy'], 'CŽK: ') !== false ? 'checked' : ''; ?>> CŽK <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vstupyInput2" id="vstupyInput2" value="<?php echo get_value($info_json['vstupy'], 'CŽK: ', ';'); ?>"></input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="Drény: <?php echo get_value($info_json['vstupy'], 'Drény: ', ';'); ?>" id="vstupyJine3" <?php echo strpos($info_json['vstupy'], 'Drény: ') !== false ? 'checked' : ''; ?>> Drény <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vstupyInput3" id="vstupyInput3" value="<?php echo get_value($info_json['vstupy'], 'Drény: ', ';'); ?>"></input>
                    <br>
                    <input type="checkbox" name="vstupy[]" data-max="4" value="Jiné: <?php echo get_value($info_json['vstupy'], 'Jiné: ', PHP_EOL); ?>" id="vstupyJine4" <?php echo strpos($info_json['vstupy'], 'Jiné: ') !== false ? 'checked' : ''; ?>> Jiné <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vstupyInput4" id="vstupyInput4" value="<?php echo get_value($info_json['vstupy'], 'Jiné: ',  PHP_EOL); ?>"></input>
                </div>
                <div>
                    <h2>Kůže* (6)</h2>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Beze změn" <?php echo in_array('Beze změn', $kuze_values) ? 'checked' : ''; ?>> Beze změn</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Ikterus" <?php echo in_array('Ikterus', $kuze_values) ? 'checked' : ''; ?>> Ikterus</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Cyanóza" <?php echo in_array('Cyanóza', $kuze_values) ? 'checked' : ''; ?>> Cyanóza</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Dekubitus" <?php echo in_array('Dekubitus', $kuze_values) ? 'checked' : ''; ?>> Dekubitus</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Bércový vřed" <?php echo in_array('Bércový vřed', $kuze_values) ? 'checked' : ''; ?>> Bércový vřed</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="Hematom" <?php echo in_array('Hematom', $kuze_values) ? 'checked' : ''; ?>> Hematom</input>
                    <br>
                    <input type="checkbox" name="kuze[]" data-max="6" value="<?php echo strpos($info_json['kuze'], 'Lokalizace: ') !== false ? substr($info_json['kuze'], strpos($info_json['kuze'], 'Lokalizace: ')) : ''; ?>" id="kuzeJine" <?php echo strpos($info_json['kuze'], 'Lokalizace: ') !== false ? 'checked' : ''; ?>> Lokalizace <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="kuzeJineInput" id="kuzeInput" value="<?php echo strpos($info_json['kuze'], 'Lokalizace: ') !== false ? substr($info_json['kuze'], strpos($info_json['kuze'], 'Lokalizace: ') + 12) : ''; ?>"></input>
                </div>
                <div>
                    <h2>Bolest* (1)</h2>
                    <input type="checkbox" name="bolest[]" data-max="1" value="Bez bolesti" <?php echo $info_json['bolest'] == 'Bez bolesti' ? 'checked' : ''; ?>> Bez bolesti</input>
                    <br>
                    <input type="checkbox" name="bolest[]" data-max="1" value="<?php echo strpos($info_json['bolest'], 'Charakter: ') !== false ? substr($info_json['bolest'], strpos($info_json['bolest'], 'Charakter: ')) : ''; ?>" id="bolestJine" <?php echo strpos($info_json['bolest'], 'Charakter: ') !== false ? 'checked' : ''; ?>> Bolest:
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Charakter <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="bolestInput1" value="<?php echo get_value($info_json['bolest'], 'Charakter: ', ';'); ?>"></input>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokalizace <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="bolestInput2" value="<?php echo get_value($info_json['bolest'], 'Lokalizace: ', ';'); ?>"></input>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stupěň <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="bolestInput3" value="<?php echo get_value($info_json['bolest'], 'Stupeň: ', PHP_EOL); ?>"></input>
                </div>
                <div>
                    <h2>Chování, <br>spánek* (3)</h2>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Klidný" <?php echo in_array('Klidný', $chovani_values) ? 'checked' : ''; ?>> Klidný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Neklidný" <?php echo in_array('Neklidný', $chovani_values) ? 'checked' : ''; ?>> Neklidný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Vyrovnaný" <?php echo in_array('Vyrovnaný', $chovani_values) ? 'checked' : ''; ?>> Vyrovnaný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Nevyrovnaný" <?php echo in_array('Nevyrovnaný', $chovani_values) ? 'checked' : ''; ?>> Nevyrovnaný</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Spolupracující" <?php echo in_array('Spolupracující', $chovani_values) ? 'checked' : ''; ?>> Spolupracující</input>
                    <br>
                    <input type="checkbox" name="chovani[]" data-max="3" value="Nespolupracující" <?php echo in_array('Nespolupracující', $chovani_values) ? 'checked' : ''; ?>> Nespolupracující</input>
                </div>
            </div>
            <div class="area5">
                <div>
                    <h2>Vyšetření*</h2>
                    <textarea rows="30" maxlength="512" name="vysetreni" required><?php echo $info_json['vysetreni']; ?></textarea>
                </div>
                <div>
                    <h2>Léčba/Léky*</h2>
                    <textarea rows="30" maxlength="512" name="lecba" required><?php echo $info_json['lecba,leky']; ?></textarea>
                </div>
                <div>
                    <h2>Ordinace/ <br>Ošetřovatelská péče*</h2>
                    <textarea class="ordinace" rows="30" maxlength="512" name="ordinace" required><?php echo $info_json['ordinace,osetrovatelska_pece']; ?></textarea>
                </div>
            </div>
            </div>
            <div class="area6">
                <button id="edit-btn" type="submit">Upravit dokumentaci</button>
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