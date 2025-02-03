document.addEventListener('DOMContentLoaded', function () {
    const inicioReposoInput = document.getElementById('inicio_reposo');
    const finReposoInput = document.getElementById('fin_reposo');
    const diasIndemnizarInput = document.getElementById('dias_indemnizar');

    function calcularDiasIndemnizar() {
        const inicioReposo = new Date(inicioReposoInput.value);
        const finReposo = new Date(finReposoInput.value);

        if (!isNaN(inicioReposo) && !isNaN(finReposo) && finReposo >= inicioReposo) {
            const diffTime = Math.abs(finReposo - inicioReposo);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 para incluir el día de inicio
            diasIndemnizarInput.value = diffDays;
        } else {
            diasIndemnizarInput.value = '';
        }
    }

    inicioReposoInput.addEventListener('change', calcularDiasIndemnizar);
    finReposoInput.addEventListener('change', calcularDiasIndemnizar);
});
