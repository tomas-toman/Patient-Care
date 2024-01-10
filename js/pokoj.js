document.addEventListener('DOMContentLoaded', function() {
    var bedButtons = document.querySelectorAll('#bed-value');
    var info = document.querySelector('#info');
    var container = document.querySelector('#container');
    var mediaQuery1 = window.matchMedia('(max-width: 1263px)');
    var mediaQuery2 = window.matchMedia('(max-width: 550px)');

    bedButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            info.style.display = 'flex';

            if (mediaQuery1.matches) {
                // The viewport is less than or equal to 1263px wide
                // Apply your JavaScript for small screens here
                container.style.gridTemplateColumns = '1fr';
                container.style.gridTemplateRows = '0.2fr 0.2fr 1fr 1fr';
                container.style.gridTemplateAreas = `
                "title"
                "buttons1"
                "info"
                "map"
                `;
            } 
            else if (mediaQuery2.matches) {
                // The viewport is greater than 1263px wide
                // Apply your JavaScript for large screens here
            } 
            else {
                container.style.gridTemplateColumns = '0.8fr 1.2fr 1fr';
                container.style.gridTemplateRows = '0.2fr 1fr'; // corrected here
                container.style.gridTemplateAreas = `
                "title info map"
                "buttons1 info map"
                `;
            }
        });
    });

    document.querySelector('#close-btn').addEventListener('click', function() {
        info.style.display = 'none';

        if (mediaQuery1.matches) {
            // The viewport is less than or equal to 1263px wide
            // Apply your JavaScript for small screens here
            container.style.gridTemplateColumns = '1fr';
            container.style.gridTemplateRows = '0.2fr 0.2fr 1fr';
            container.style.gridTemplateAreas = `
            "title"
            "buttons1"
            "map"
            `;
        } 
        else if (mediaQuery2.matches) {
            // The viewport is greater than 1263px wide
            // Apply your JavaScript for large screens here
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
});