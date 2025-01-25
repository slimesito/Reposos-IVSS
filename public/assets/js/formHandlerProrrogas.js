document.addEventListener('DOMContentLoaded', function() {
    const capituloSelect = document.getElementById('id_capitulo');
    const patGeneralSelect = document.getElementById('id_pat_general');
    const patEspecificaSelect = document.getElementById('id_pat_especifica');

    capituloSelect.addEventListener('change', function() {
        if (this.value) {
            patGeneralSelect.disabled = false;
            patEspecificaSelect.disabled = false;

            patGeneralSelect.innerHTML = '<option hidden selected disabled>Seleccione la Patología General</option>';
            patEspecificaSelect.innerHTML = '<option hidden selected disabled>Seleccione la Patología Específica</option>';

            fetch(`/getPatologiasGenerales/${this.value}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(patologia => {
                        patGeneralSelect.innerHTML += `<option value="${patologia.id}">${patologia.descripcion}</option>`;
                    });
                })
                .catch(error => console.error('Error al cargar las patologías generales:', error));

            fetch(`/getPatologiasEspecificasPorCapitulo/${this.value}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(patologia => {
                        patEspecificaSelect.innerHTML += `<option value="${patologia.id}">${patologia.descripcion}</option>`;
                    });
                })
                .catch(error => console.error('Error al cargar las patologías específicas:', error));
        }
    });
});