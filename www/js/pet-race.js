$(document).ready(function() {
    // Quando cambia il valore della regione
    $('#spec-sel').change(function() {
        var regioneID = $(this).val(); // Prendi l'ID selezionato

        if (regioneID) {
            // Chiamata AJAX
            $.ajax({
                type: 'POST',
                url: 'get_province.php', // File PHP che elabora la richiesta
                data: 'id_regione=' + regioneID,
                success: function(html) {
                    // Riempi il secondo selettore con l'HTML restituito
                    $('#provincia').html(html);
                    // Abilita il selettore
                    $('#provincia').prop('disabled', false);
                }
            });
        } else {
            // Se si deseleziona la regione, resetta e disabilita le province
            $('#provincia').html('<option value="">Seleziona prima una regione</option>');
            $('#provincia').prop('disabled', true);
        }
    });
});

getPetData();