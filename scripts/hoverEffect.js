const consolas = document.querySelectorAll('.card');

let consolaActiva = null;

consolas.forEach(consola => {
    consola.addEventListener("mouseenter", () => {
        consolaActiva = consola.querySelector("img");
    });

    consola.addEventListener("mouseleave", () => {
    consolaActiva.style.setProperty("--rotarX", "0deg");
    consolaActiva.style.setProperty("--rotarY", "0deg");
    consolaActiva.style.scale = "1";
        consolaActiva = null;
    });
});

document.addEventListener("mousemove", e => {

    if (!consolaActiva) return;

    const x = e.clientX;
    const y = e.clientY;

    const centroX = window.innerWidth / 2;
    const centroY = window.innerHeight / 2;

    const diferenciaX = ((x - centroX) / centroX) * 60;
    const diferenciaY = ((y - centroY) / centroY) * 60;

    const distancia = Math.sqrt(diferenciaX ** 2 + diferenciaY ** 2);
    const escala = 1 + distancia / 100;

    consolaActiva.style.setProperty("--rotarX", -diferenciaY + "deg");
    //consolaActiva.style.setProperty("--rotarY", diferenciaX + "deg");
    //consolaActiva.style.scale = "1.05";
    consolaActiva.style.scale = escala;
});