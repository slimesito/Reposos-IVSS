document.addEventListener('DOMContentLoaded', function() {
    const capituloSelect = document.getElementById('capitulo_id');
    const patGeneralSelect = document.getElementById('id_pat_general');

    capituloSelect.addEventListener('change', function() {
        patGeneralSelect.disabled = false;
        patGeneralSelect.innerHTML = '<option hidden selected disabled>Seleccione la Patología General</option>';

        fetch(`/getPatologiasGenerales/${this.value}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Añade esto para ver los datos en la consola
                data.forEach(patologia => {
                    patGeneralSelect.innerHTML += `<option value="${patologia.id}">${patologia.descripcion}</option>`;
                });
            })
            .catch(error => {
                console.error('Error al cargar las patologías generales:', error);
            });
    });
});
