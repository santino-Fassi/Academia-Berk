
<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="conoceTuCompanero">

    <div class="text-center mb-5">

        <p class="text-uppercase fw-bold text-primary">Academia de Jinetes de Berk
        </p>

        <h2 class="text-primary mb-4 text-shadow-titles">
            Evaluación para Aspirantes a Jinetes
        </h2>

        <p class="lead">Todo vikingo tiene un destino y todo dragón busca un compañero compatible. Respondé estas preguntas y descubrí qué dragón podría elegirte.
        </p>

        <p>Completá tu perfil para comenzar tu entrenamiento.
        </p>

    </div>


    <form class="row g-4" action="index.php?vista=resultado" method="post">

        <!-- 1. NOMBRE DEL JINETE -->
        <div class="col-12">

            <h3 class="h4 text-primary fw-bold">
                1. Nombre del jinete
            </h3>

            <label for="nombreJinete" class="form-label">
                ¿Cuál es tu nombre, joven vikingo?
            </label>

            <input type="text" class="form-control" id="nombreJinete" name="nombreJinete" placeholder="Ingresá tu nombre"required>

        </div>


        <!-- 2. FORMA DE ENCARAR PROBLEMAS  TODO: Sacar los <strong> por clase con negrita-->
        <div class="col-12 col-md-6">

            <fieldset>

                <legend class="h4 text-primary fw-bold">
                    2. Forma de encarar problemas
                </legend>

                <p>
                    Cuando tenés que resolver un problema difícil
                    o trabajar en equipo, ¿qué actitud te sale
                    más natural?
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadA" value="Huelga" required>

                    <label class="form-check-label" for="personalidadA">
                        <strong>A.</strong> Analizo todo en silencio, busco la solución más lógica y actúo rápido sin dar vueltas.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadB" value="Boulder">

                    <label class="form-check-label"
                           for="personalidadB">
                        <strong>B.</strong> Soy el cable a tierra del grupo: paciente, constante y el que sostiene todo cuando hay caos.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadC" value="Rastreador">

                    <label class="form-check-label" for="personalidadC">
                        <strong>C.</strong> Soy súper detallista, tengo memoria para todo y no paro hasta encontrar lo que busco.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadD" value="Fogonero">

                    <label class="form-check-label" for="personalidadD">
                        <strong>D.</strong> Voy de frente con mucha energía y pasión; soy intenso y no me achico ante ninguna discusión.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadE" value="Afilada">

                    <label class="form-check-label" for="personalidadE">
                        <strong>E.</strong> Soy perfeccionista y cuido mucho mi imagen; me gusta destacar y hacer las cosas con precisión.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadF" value="Misterio">

                    <label class="form-check-label" for="personalidadF">
                        <strong>F.</strong> Salgo con ideas raras que nadie espera; me divierte el humor irónico, el misterio y salirme del molde.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadG" value="Marea">

                    <label class="form-check-label" for="personalidadG">
                        <strong>G.</strong> Me adapto y fluyo según el momento; parezco tranquilo por fuera, pero tengo un carácter profundo e indomable.
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 3. LUGAR PARA DESCONECTAR -->
        <div class="col-12 col-md-6">

            <fieldset>

                <legend class="h4 text-primary fw-bold">
                    3. Lugar para desconectar
                </legend>

                <p>
                    Después de una semana agotadora, ¿cuál es tu plan ideal para relajarte y recargar energías?
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatA" value="estrellas_altura" required>

                    <label class="form-check-label" for="habitatA">
                        <strong>A.</strong> Subir a una terraza o lugar alto de noche a mirar las estrellas en silencio, lejos del ruido.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatB" value="montanas_cuevas">

                    <label class="form-check-label" for="habitatB">
                        <strong>B.</strong> Quedarme al calor de una fogata o chimenea, o hacer senderismo entre montañas rocosas.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatC" value="bosque_pasto">

                    <label class="form-check-label" for="habitatC">
                        <strong>C.</strong> Caminar entre los árboles de un bosque o tirarme en el pasto a sentir el viento.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatD" value="playa_mar">

                    <label class="form-check-label" for="habitatD">
                        <strong>D.</strong> Ir a la playa a nadar en el mar, escuchar las olas o ver una tormenta frente a la costa.
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 4. RITMO DE VIDA Y ENERGÍA -->
        <div class="col-12 col-md-6">

            <fieldset>

                <legend class="h4 text-primary fw-bold">
                    4. Ritmo de vida y energía
                </legend>

                <p>
                    ¿Cómo describirías tu nivel de energía en el día a día?
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="energia" id="energiaA" value="inquieto_agil" required>

                    <label class="form-check-label" for="energiaA">
                        <strong>A.</strong> Inquieto y ágil: me gusta moverme rápido, hacer mil cosas a la vez y cambiar de planes sobre la marcha.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="energia" id="energiaB" value="tranquilo_firme">

                    <label class="form-check-label" for="energiaB">
                        <strong>B.</strong> Tranquilo y firme: prefiero ir a mi propio ritmo, disfrutar la comodidad, las siestas y que nadie me apure.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="energia" id="energiaC" value="intenso_imponente">

                    <label class="form-check-label" for="energiaC">
                        <strong>C.</strong> Intenso e imponente: cuando llego a un lugar me hago notar; me gusta abarcar mucho espacio y liderar.
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 5. MANÍAS Y TALENTOS -->
        <div class="col-12 col-md-6">

            <fieldset>

                <legend class="h4 text-primary fw-bold">
                    5. Manías y talentos personales
                </legend>

                <p>
                    Elegí hasta 3 características que tus amigos dirían que tenés.
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoA" value="noctambulo">

                    <label class="form-check-label" for="talentoA">
                        Noctámbulo y sigiloso: rindo mucho mejor de noche y a veces aparezco sin que me escuchen llegar.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoB" value="complice">

                    <label class="form-check-label" for="talentoB">
                        Necesito un cómplice: funciono mejor haciendo bromas o planeando cosas de a dos.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoC" value="terco">

                    <label class="form-check-label" for="talentoC">
                        Terco e irrompible: cuando me pongo algo en la cabeza, aguanto cualquier presión sin quebrarme.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoD" value="adrenalina">

                    <label class="form-check-label" for="talentoD">
                        Adicto a la adrenalina: me encantan la velocidad y tomar decisiones en un segundo.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoE" value="radar">

                    <label class="form-check-label" for="talentoE">
                        Radar humano: noto cambios de humor, ruidos o pistas que a los demás se les pasan.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoF" value="mecha_corta">

                    <label class="form-check-label" for="talentoF">
                        Temperamento de mecha corta: si me provocan, exploto rápido, aunque enseguida se me pasa.
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 6. ANTOJO GASTRONÓMICO -->
        <div class="col-12 col-md-6">

            <fieldset>

                <legend class="h4 text-primary fw-bold">
                    6. Antojo gastronómico
                </legend>

                <p>
                    En una juntada o banquete, ¿a qué plato vas directo sin dudarlo?
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaA" value="dulce_fruta" required>

                    <label class="form-check-label" for="dietaA">
                        <strong>A.</strong> Algo dulce, como miel y manzanas.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaB" value="pescado_mar">

                    <label class="form-check-label" for="dietaB">
                        <strong>B.</strong> Pescado fresco a la parrilla o sushi.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaC" value="carne_asada">

                    <label class="form-check-label" for="dietaC">
                        <strong>C.</strong> Un buen plato de carne.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaD" value="crocante">

                    <label class="form-check-label" for="dietaD">
                        <strong>D.</strong> Snacks súper crocantes, duros y salados. ¡Cuanto más ruido hagan al masticar, mejor!
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 7. ESTILO PERSONAL -->
        <div class="col-12 col-md-6">

            <fieldset>

                <legend class="h4 text-primary fw-bold">
                    7. Estilo personal
                </legend>

                <p>
                    Si mirás tu armario o cómo decorarías tu cuarto, ¿qué paleta de colores elegís siempre?
                </p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="colores" id="coloresA" value="oscuros" required>

                    <label class="form-check-label" for="coloresA">
                        <strong>A.</strong> Negro, gris oscuro o tonos nocturnos.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="colores" id="coloresB" value="vibrantes">

                    <label class="form-check-label" for="coloresB">
                        <strong>B.</strong> Colores vibrantes, como azul eléctrico, turquesa, violeta o amarillo.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="colores" id="coloresC" value="tierra">

                    <label class="form-check-label" for="coloresC">
                        <strong>C.</strong> Tonos tierra, verde musgo, marrón o bronce.
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="colores" id="coloresD" value="fuego">

                    <label class="form-check-label" for="coloresD">
                        <strong>D.</strong> Rojo intenso, naranja o dorado.
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- BOTÓN DE ENVÍO -->
        <div class="col-12 d-flex justify-content-center mt-5">

            <button type="submit"
                    class="btn btn-purple btn-lg mx-1 px-5 fw-bold">
                Descubrir mi dragón
            </button>

        </div>

    </form>

</section>
