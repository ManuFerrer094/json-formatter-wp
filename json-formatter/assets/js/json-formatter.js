document.addEventListener("DOMContentLoaded", function() {
    $('#json-input').on('dragover', function(event) {
        event.preventDefault();
        $(this).addClass('drag-over');
    });

    $('#json-input').on('dragleave', function(event) {
        event.preventDefault();
        $(this).removeClass('drag-over');
    });

    $('#json-input').on('drop', function(event) {
        event.preventDefault();
        $(this).removeClass('drag-over');

        var files = event.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#json-input').val(e.target.result);
            };
            reader.readAsText(files[0]);
        }
    });

    $('#format-button').on('click', function() {
        try {
            var jsonString = $('#json-input').val();
            var selectedFormat = $('#format-select').val();
            var validationType = $('#validation-type').val();
            console.log('JSON recibido:', jsonString);
            var jsonObject;

            // Validar el JSON según el tipo de validación seleccionado
            if (validationType === 'ecma-404' || validationType === 'rfc-8259' || validationType === 'rfc-7159' || validationType === 'rfc-4627') {
                jsonlint.parse(jsonString);
                jsonObject = JSON.parse(jsonString);
            } else if (validationType === 'skip-validation') {
                // No se aplica validación
                jsonObject = JSON.parse(jsonString);
            } else {
                throw new Error('Tipo de validación no reconocido');
            }

            var formattedJson = JSON.stringify(jsonObject, null, parseInt(selectedFormat));

            $('#formatted-json').val(formattedJson);
        } catch (error) {
            $('#formatted-json').val(error.message);
        }
    });

    $('#download-button').on('click', function() {
        var content = $('#formatted-json').val();
        if (content) {
            var blob = new Blob([content], { type: 'application/json' });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'formatted-file.json';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        } else {
            alert('No hay contenido para descargar.');
        }
    });

    $('#clear-button').on('click', function() {
        $('#json-input').val('');
        $('#formatted-json').val('');
    });

    $('#copy-button').on('click', function() {
        $('#formatted-json').select();
        document.execCommand('copy');
        alert('JSON copiado al portapapeles.');
    });
});
