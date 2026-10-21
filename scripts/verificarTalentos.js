'use strict';

const talentos = document.querySelectorAll("input[name='talentos[]']");

function limitarTalentos() {
    const seleccionados = document.querySelectorAll("input[name='talentos[]']:checked").length;

    talentos.forEach(talento => {
        talento.disabled = seleccionados >= 3 && !talento.checked;
    });
}

talentos.forEach(talento => {
    talento.addEventListener("change", limitarTalentos);
});

