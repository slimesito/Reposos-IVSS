document.addEventListener('DOMContentLoaded', function() {
    const capituloSelect = document.getElementById('capitulo_id');
    const patGeneralSelect = document.getElementById('id_pat_general');

    capituloSelect.addEventListener('change', function() {
        patGeneralSelect.disabled = false;
        patGeneralSelect.innerHTML = '<option hidden selected disabled>Seleccione la Patología General</option>';

        fetch(`/getPatologiasGenerales/${this.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(patologia => {
                    patGeneralSelect.innerHTML += `<option value="${patologia.id}">${patologia.descripcion}</option>`;
                });
            });
    });
});