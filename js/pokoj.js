document.addEventListener('DOMContentLoaded', function() {
    var info = document.querySelector('#info');
    var container = document.querySelector('#container');
    var mediaQuery1 = window.matchMedia('(max-width: 1270px)');

    function refreshInfoCard(buttonValue) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/info-card.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                var data = JSON.parse(this.responseText)[0];
                if (data) {
                    document.querySelector('#jmeno').innerHTML = 'Jméno: ' + data.jmeno;
                    document.querySelector('#prijmeni').innerHTML = 'Příjmení: ' + data.prijmeni;
                    document.querySelector('#datum_narozeni').innerHTML = 'Datum narození: ' + data.datum_narozeni;
                    document.querySelector('#rodne_cislo').innerHTML = 'Rodné číslo: ' + data.rodne_cislo;
                    document.querySelector('#dokument-btn').style.display = 'block';
                    document.querySelector('#add-btn').style.display = 'none';
                    document.querySelector('#rem-btn').style.display = 'block';
                } else {
                    document.querySelector('#jmeno').innerHTML = 'Jméno:';
                    document.querySelector('#prijmeni').innerHTML = 'Příjmení:';
                    document.querySelector('#datum_narozeni').innerHTML = 'Datum narození:';
                    document.querySelector('#rodne_cislo').innerHTML = 'Rodné číslo:';
                    document.querySelector('#dokument-btn').style.display = 'none';
                    document.querySelector('#add-btn').style.display = 'block';
                    document.querySelector('#rem-btn').style.display = 'none';
                }
            }
        };

        var params = 'button=' + encodeURIComponent(buttonValue);
        xhr.send(params);
    }

    document.querySelector('#buttons1').addEventListener('click', function(event) {
        if (event.target.classList.contains('bed-value')) {
            event.preventDefault();

            var buttons = document.querySelectorAll('.bed-value');
            buttons.forEach(function(button) {
                button.classList.remove('active');
            });

            
            event.target.style.backgroundColor = 'var(--primary)';
            event.target.style.color = 'var(--secondary)';
            event.target.style.boxShadow = '0 5px var(--secondary)';

            event.target.classList.add('active');

            if (event.target.classList.contains('active')) {
                event.target.style.backgroundColor = 'var(--secondary)';
                event.target.style.color = 'var(--primary)';
                event.target.style.boxShadow = '0 5px #5a7ca7';
            }

            info.style.display = 'flex';

            refreshInfoCard(event.target.value);

            if (mediaQuery1.matches) {
                container.style.gridTemplateColumns = '1fr';
                container.style.gridTemplateRows = '0.2fr 0.2fr 0.5fr 1fr';
                container.style.gridTemplateAreas = `
                "title"
                "buttons1"
                "info"
                "map"
                `;
            } 
            else {
                container.style.gridTemplateColumns = '0.8fr 1.2fr 1fr';
                container.style.gridTemplateRows = '0.2fr 1fr';
                container.style.gridTemplateAreas = `
                "title info map"
                "buttons1 info map"
                `;
            }
        }
    });

    document.querySelector('#buttons1').addEventListener('click', function(event) {
        if (event.target.classList.contains('bed-value')) {
            event.preventDefault();

            var buttons = document.querySelectorAll('.bed-value');
            buttons.forEach(function(button) {
                button.classList.remove('active');
                button.style.backgroundColor = 'var(--primary)';
                button.style.color = 'var(--secondary)';
                button.style.boxShadow = '0 5px var(--secondary)';
            });

            event.target.style.backgroundColor = 'var(--secondary)';
            event.target.style.color = 'var(--primary)';
            event.target.style.boxShadow = '0 5px #5a7ca7';

            event.target.classList.add('active');

            info.style.display = 'flex';

            refreshInfoCard(event.target.value);

            if (mediaQuery1.matches) {
                container.style.gridTemplateColumns = '1fr';
                container.style.gridTemplateRows = '0.2fr 0.2fr 0.5fr 1fr';
                container.style.gridTemplateAreas = `
                "title"
                "buttons1"
                "info"
                "map"
                `;
            } else {
                container.style.gridTemplateColumns = '0.8fr 1.2fr 1fr';
                container.style.gridTemplateRows = '0.2fr 1fr';
                container.style.gridTemplateAreas = `
                "title info map"
                "buttons1 info map"
                `;
            }
        }
    });

    document.querySelector('#rem-btn').addEventListener('click', function(event) {
        event.preventDefault();
    
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/odebrat_pacienta.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
        xhr.onload = function() {
            if (this.status == 200) {
                refreshInfoCard(document.querySelector('.bed-value.active').value);
            }
        };
    
        var params = 'button=' + encodeURIComponent(document.querySelector('.bed-value.active').value);
        xhr.send(params);
    });

    document.getElementById('add-btn').addEventListener('click', function(event) {
        event.preventDefault();

        document.getElementById('patient-table').style.display = 'block';
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/tabulka_pacientu.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                var data = JSON.parse(this.responseText);

                if (data) {
                    var table = document.getElementById('info-table');
                    var tbody = table.querySelector('tbody');

                    tbody.innerHTML = '';

                    data.forEach(item => {
                        const row = document.createElement('tr');

                        const rodne_cislo = document.createElement('td');
                        rodne_cislo.innerHTML = item.rodne_cislo;
                        rodne_cislo.setAttribute('data-title', 'Rod. čís.');

                        const jmeno = document.createElement('td');
                        jmeno.innerHTML = item.jmeno;
                        jmeno.setAttribute('data-title', 'Jméno');

                        const prijmeni = document.createElement('td');
                        prijmeni.innerHTML = item.prijmeni;
                        prijmeni.setAttribute('data-title', 'Příjmení');

                        const datum_narozeni = document.createElement('td');
                        datum_narozeni.innerHTML = item.datum_narozeni;
                        datum_narozeni.setAttribute('data-title', 'Dat. nar.');

                        const form = document.createElement('form');
                        form.method = 'post';
                        form.action = '../php/pridat_pacienta.php';

                        const button_cont = document.createElement('td');
                        const button = document.createElement('button');
                        button.innerHTML = 'Přidat';
                        button.type = 'submit';
                        button.name = 'button-add';
                        button.value = item.fk_pacient;
                        button.id = 'add-patient-btn';

                        row.appendChild(rodne_cislo);
                        row.appendChild(jmeno);
                        row.appendChild(prijmeni);
                        row.appendChild(datum_narozeni);

                        form.appendChild(button);
                        button_cont.appendChild(form);
                        row.appendChild(button_cont);

                        tbody.appendChild(row);
                    });
                    table.appendChild(tbody);
                }
            }
        }

        var params = 'button-add=' + encodeURIComponent(event.target.value);
        xhr.send(params);
    });

    document.querySelector('#close-btn').addEventListener('click', function() {
        info.style.display = 'none';

        if (mediaQuery1.matches) {
            container.style.gridTemplateColumns = '1fr';
            container.style.gridTemplateRows = '0.2fr 0.2fr 1fr';
            container.style.gridTemplateAreas = `
            "title"
            "buttons1"
            "map"
            `;
        } 
        else {
            container.style.gridTemplateColumns = '2fr 1fr';
            container.style.gridTemplateRows = '0.2fr 1fr';
            container.style.gridTemplateAreas = `
            "title map"
            "buttons1 map"
            `;
        }
    });

    document.getElementById('close-table-btn').addEventListener('click', function() {
        document.getElementById('patient-table').style.display = 'none';
    });

    document.addEventListener('click', function(event) {
        if (event.target.id === 'add-patient-btn') {
            event.preventDefault();

            document.getElementById('patient-table').style.display = 'none';

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../php/pridat_pacienta.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status == 200) {
                    refreshInfoCard(document.querySelector('.bed-value.active').value);
                }
            };

            var params = 'button-add=' + encodeURIComponent(event.target.value);
            xhr.send(params);
        }
    });
});