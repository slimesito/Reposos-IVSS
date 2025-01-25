$(document).ready(function() {
    $('#id_servicio, #id_centro_asistencial, #id_pat_general, #id_pat_especifica, #id_lugar, #cod_motivo').select2({
        placeholder: function() {
            return $(this).data('placeholder');
        },
        allowClear: true,
        width: '100%', // Ajusta el ancho si es necesario
        containerCssClass: 'custom-select2-container',
        dropdownParent: $('body'), // Asegura que el dropdown se abra hacia abajo
        matcher: function(params, data) {
            // Si no hay params.term, devuelve todos los datos
            if ($.trim(params.term) === '') {
                return data;
            }

            // Convierta el término de búsqueda a mayúsculas
            if (typeof data.text === 'undefined') {
                return null;
            }

            // Compara el término de búsqueda con el nombre en mayúsculas
            if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) > -1) {
                return data;
            }

            // Si no hay coincidencias, devuelve null
            return null;
        }
    });
});
