
const puntosMapa = document.querySelectorAll(".punto-mapa");
const informacionRegion = document.querySelector("#informacionRegion");
const cerrarTarjeta = document.querySelector("#cerrarTarjetaRegion");

const regiones = {
    berk: {
        nombre: "Isla de Berk",
        descripcion: "El hogar de los vikingos y el punto de partida de las aventuras por el archipiélago.",
        habitats: []
    },

    bosques: {
        nombre: "Bosques del archipiélago",
        descripcion: "Territorios con abundante vegetación donde diferentes especies encuentran refugio.",
        habitats: ["Bosques"]
    },

    montanas: {
        nombre: "Montañas del Norte",
        descripcion: "Regiones elevadas y rocosas donde habitan dragones adaptados a terrenos montañosos.",
        habitats: ["Montañas"]
    },

    glaciares: {
        nombre: "Glaciares Helados",
        descripcion: "Territorios de temperaturas extremas y paisajes cubiertos de hielo.",
        habitats: ["Regiones frías", "Nido de hielo oceánico"]
    },

    fuego: {
        nombre: "Montañas de Fuego",
        descripcion: "Una región volcánica que requiere exploración y precaución.",
        habitats: []
    }
};

let dragones = [];

fetch("includes/dragones.json")
    .then(respuesta => {
        if (!respuesta.ok) {
            throw new Error("No se pudo cargar el catálogo.");
        }

        return respuesta.json();
    })
    .then(datos => {
        dragones = datos;
    })
    .catch(error => {
        console.error(error);
    });

function mostrarRegion(idRegion) {
    const region = regiones[idRegion];

    if (!region) {
        return;
    }

    puntosMapa.forEach(punto => {
        punto.classList.toggle(
            "activo",
            punto.dataset.region === idRegion
        );
    });

    const titulo = informacionRegion.querySelector(".titulo-region");
    const descripcion = informacionRegion.querySelector(".descripcion-region");
    const contenedorDragones = informacionRegion.querySelector(".dragones-region");

    titulo.textContent = region.nombre;
    descripcion.textContent = region.descripcion;

    const dragonesRegion = dragones.filter(dragon => {
        return dragon.habitat.some(habitat => {
            return region.habitats.some(
                habitatRegion =>
                    habitat.toLowerCase() === habitatRegion.toLowerCase()
            );
        });
    });

    if (dragonesRegion.length > 0) {
        contenedorDragones.innerHTML = dragonesRegion.map(dragon => `
            <article class="dragon-region">
                <img
                    src="img/dragones/${dragon.ilustracion.img}"
                    alt="${dragon.ilustracion.alt}"
                    class="imagen-dragon-region"
                >

                <div>
                    <h4>${dragon.nombre}</h4>
                    <p><strong>Clase:</strong> ${dragon.clase}</p>
                    <p><strong>Hábitat:</strong> ${dragon.habitat.join(", ")}</p>

                    <a
                        href="index.php?vista=detalle-dragon&dragon_id=${dragon.id}"
                        class="btn btn-purple btn-sm mt-2">
                        Saber más
                    </a>
                </div>
            </article>
        `).join("");
    } else {
        contenedorDragones.innerHTML = `
            <p>No hay dragones asociados a esta región según los hábitats registrados en el catálogo.</p>
        `;
    }

    informacionRegion.hidden = false;

    const contenido = informacionRegion.querySelector(".contenido-tarjeta-region");
    contenido.scrollTop = 0;
}

puntosMapa.forEach(punto => {
    punto.addEventListener("click", () => {
        mostrarRegion(punto.dataset.region);
    });
});

cerrarTarjeta.addEventListener("click", () => {
    informacionRegion.hidden = true;

    puntosMapa.forEach(punto => {
        punto.classList.remove("activo");
    });
});
