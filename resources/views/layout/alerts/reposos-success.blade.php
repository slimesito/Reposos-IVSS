@if(session('successReposos') && session('id'))
    <div class="cardReposos">
        <button class="dismissReposos" type="button">×</button>
        <div class="headerReposos">
            <div class="imageReposos">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>
            <div class="contentReposos">
                <span class="titleReposos">{{ session('successReposos') }}</span>
                <p class="message">
                    Haz click en "Descargar" para obtener la Forma 14-73 en formato PDF.
                </p>
            </div>
            <div class="actionsReposos">
                <button class="descargarPDF" type="button" onclick="window.location.href='{{ route('reposo.enfermedad.downloadPDF', session('id')) }}'">Descargar</button>
                <button class="aceptarReposos" type="button" onclick="this.parentElement.parentElement.parentElement.style.display='none';">Aceptar</button>
            </div>
        </div>
    </div>
@endif
