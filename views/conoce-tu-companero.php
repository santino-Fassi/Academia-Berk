<section class="evaluacion-berk mt-5 mb-5" id="conoceTuCompanero">

    <header class="portada-berk">

        <div class="portada-contenido">

            <span class="insignia-berk">
                ✦ EXPEDIENTE DE ASPIRANTE ✦
            </span>

            <p class="subtitulo-berk">
                Academia de Jinetes de Berk
            </p>

            <h2>
                Encontrá tu dragón
            </h2>

            <div class="separador-runas">
                <span></span>
                ᛟ
                <span></span>
            </div>

            <p class="texto-portada">
                Todo vikingo tiene un destino y todo dragón busca un compañero compatible.
            </p>

            <p class="texto-portada-secundario">
                Demostrá quién sos. Descubrí quién te elegirá.
            </p>

        </div>

        <div class="indicador-expediente">
            REGISTRO DE BERK / N.º 001
        </div>

    </header>

    <!-- INTRODUCCIÓN -->
    <div class="introduccion-berk">

        <div>
            <h3>Tu historia comienza aquí</h3>

            <p>
                Cada jinete tiene algo que lo hace único. Completá tu evaluación y descubrí qué dragón podría
                convertirse en tu compañero de aventuras.
            </p>
        </div>

    </div>

    <!-- FORMULARIO -->
    <form class="row g-4 formulario-berk" action="index.php?vista=resultado" method="post">

        <!-- 1. NOMBRE DEL JINETE -->
        <div class="col-12">

            <fieldset class="panel-pregunta">
                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">01</span>
                    <span>Nombre del jinete</span>
                </legend>

                <label for="nombreJinete" class="form-label">
                    ¿Cuál es tu nombre, joven vikingo?
                </label>

                <input type="text" class="form-control" id="nombreJinete" name="nombreJinete"
                    placeholder="Ingresá tu nombre" required>

            </fieldset>

        </div>


        <!-- 2. FORMA DE ENCARAR PROBLEMAS  TODO: Sacar los <strong> por clase con negrita-->
        <div class="col-12 col-md-6">

            <fieldset class="panel-pregunta">

                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">02</span>
                    <span>Forma de encarar problemas</span>
                </legend>

                <p class="descripcion-pregunta">
                    Cuando tenés que resolver un problema difícil o trabajar en equipo, ¿qué actitud te sale más
                    natural?
                </p>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadA" value="Huelga"
                        required>

                    <label for="personalidadA">
                        <span class="letra-opcion">A</span>
                        <span>
                            Analizo todo en silencio, busco la solución
                            más lógica y actúo rápido sin dar vueltas.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadB" value="Boulder">

                    <label for="personalidadB">
                        <span class="letra-opcion">B</span>
                        <span>
                            Soy el cable a tierra del grupo: paciente, constante y el que sostiene todo cuando hay caos.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadC"
                        value="Rastreador">

                    <label for="personalidadC">
                        <span class="letra-opcion">C</span>
                        <span>
                            Soy súper detallista, tengo memoria para todo y no paro hasta encontrar lo que busco.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadD"
                        value="Fogonero">

                    <label for="personalidadD">
                        <span class="letra-opcion">D</span>
                        <span>
                            Voy de frente con mucha energía y pasión; soy intenso y no me achico ante ninguna discusión.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadE" value="Afilada">

                    <label for="personalidadE">
                        <span class="letra-opcion">E</span>
                        <span>
                            Soy perfeccionista y cuido mucho mi imagen; me gusta destacar y hacer las cosas con
                            precisión.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadF"
                        value="Misterio">

                    <label for="personalidadF">
                        <span class="letra-opcion">F</span>
                        <span>
                            Salgo con ideas raras que nadie espera; me divierte el humor irónico, el misterio y salirme
                            del molde.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="personalidad" id="personalidadG" value="Marea">

                    <label for="personalidadG">
                        <span class="letra-opcion">G</span>
                        <span>
                            Me adapto y fluyo según el momento; parezco tranquilo por fuera, pero tengo un carácter
                            profundo e indomable.
                        </span>
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 3. LUGAR PARA DESCONECTAR -->
        <div class="col-12 col-md-6">

            <fieldset class="panel-pregunta">

                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">03</span>
                    <span>Lugar para desconectar</span>
                </legend>

                <p class="descripcion-pregunta">
                    Después de una semana agotadora, ¿cuál es tu plan ideal para relajarte y recargar energías?
                </p>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatA" value="estrellas_altura"
                        required>

                    <label for="habitatA">
                        <span class="letra-opcion">A</span>
                        <span>
                            Subir a una terraza o lugar alto de noche a mirar las estrellas en silencio, lejos del
                            ruido.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatB" value="montanas_cuevas">

                    <label for="habitatB">
                        <span class="letra-opcion">B</span>
                        <span> Quedarme al calor de una fogata o chimenea, o hacer senderismo entre montañas rocosas.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatC" value="bosque_pasto">

                    <label for="habitatC">
                        <span class="letra-opcion">C</span>
                        <span>
                            Caminar entre los árboles de un bosque o tirarme en el pasto a sentir el viento.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="habitat" id="habitatD" value="playa_mar">

                    <label for="habitatD">
                        <span class="letra-opcion">D</span>
                        <span> Ir a la playa a nadar en el mar, escuchar las olas o ver una tormenta frente a la
                            costa.</span>
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 4. RITMO DE VIDA Y ENERGÍA -->
        <div class="col-12 col-md-6">

            <fieldset class="panel-pregunta">

                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">04</span>
                    <span>Ritmo de vida y energía</span>
                </legend>


                <p class="descripcion-pregunta">
                    ¿Cómo describirías tu nivel de energía en el día a día?
                </p>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="energia" id="energiaA" value="inquieto_agil"
                        required>

                    <label for="energiaA">
                        <span class="letra-opcion">A</span>
                        <span> Inquieto y ágil: me gusta moverme rápido, hacer mil cosas a la vez y cambiar de planes
                            sobre la marcha.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="energia" id="energiaB" value="tranquilo_firme">

                    <label for="energiaB">
                        <span class="letra-opcion">B</span>
                        <span> Tranquilo y firme: prefiero ir a mi propio ritmo, disfrutar la comodidad, las siestas y
                            que nadie me apure.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="energia" id="energiaC" value="intenso_imponente">

                    <label for="energiaC">
                        <span class="letra-opcion">A</span>
                        <span> Intenso e imponente: cuando llego a un lugar me hago notar; me gusta abarcar mucho
                            espacio y liderar.</span>
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 5. MANÍAS Y TALENTOS -->
        <div class="col-12 col-md-6">

            <fieldset class="panel-pregunta">

                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">05</span>
                    <span>Manías y talentos personales</span>
                </legend>

                <p class="descripcion-pregunta">
                    Elegí hasta 3 características que tus amigos dirían que tenés.
                </p>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoA" value="noctambulo">

                    <label for="talentoA">
                        <span>
                            Noctámbulo y sigiloso: rindo mucho mejor de noche y a veces aparezco sin que me escuchen
                            llegar.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoB" value="complice">

                    <label for="talentoB">
                        <span>
                            Necesito un cómplice: funciono mejor haciendo bromas o planeando cosas de a dos.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoC" value="terco">

                    <label for="talentoC">
                        Terco e irrompible: cuando me pongo algo en la cabeza, aguanto cualquier presión sin quebrarme.
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoD" value="adrenalina">

                    <label for="talentoD">
                        <span>
                            Adicto a la adrenalina: me encantan la velocidad y tomar decisiones en un segundo.
                        </span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoE" value="radar">

                    <label for="talentoE">
                        <span>
                            Radar humano: noto cambios de humor, ruidos o pistas que a los demás se les pasan.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="checkbox" name="talentos[]" id="talentoF" value="mecha_corta">

                    <label for="talentoF">
                        <span>
                            Temperamento de mecha corta: si me provocan, exploto rápido, aunque enseguida se me
                            pasa.</span>
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 6. ANTOJO GASTRONÓMICO -->
        <div class="col-12 col-md-6">

            <fieldset class="panel-pregunta">

                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">06</span>
                    <span> Antojo gastronómico</span>
                </legend>

                <p class="descripcion-pregunta">
                    En una juntada o banquete, ¿a qué plato vas directo sin dudarlo?
                </p>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaA" value="dulce_fruta" required>

                    <label for="dietaA">
                        <span class="letra-opcion">A</span>
                        <span> Algo dulce, como miel y manzanas.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaB" value="pescado_mar">

                    <label class="form-check-label" for="dietaB">
                        <span class="letra-opcion"><B></B></span>
                        <span> Pescado fresco a la parrilla o sushi.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaC" value="carne_asada">

                    <label for="dietaC">
                        <span class="letra-opcion">C</span>
                        <span> Un buen plato de carne.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="dieta" id="dietaD" value="crocante">

                    <label for="dietaD">
                        <span class="letra-opcion">A</span>
                        <span> Snacks súper crocantes, duros y salados. ¡Cuanto más ruido hagan al masticar,
                            mejor!</span>
                    </label>
                </div>

            </fieldset>

        </div>


        <!-- 7. ESTILO PERSONAL -->
        <div class="col-12 col-md-6">

            <fieldset class="panel-pregunta">

                <legend class="titulo-pregunta">
                    <span class="numero-pregunta">07</span>
                    <span>Estilo personal</span>
                </legend>

                <p class="descripcion-pregunta">
                    Si mirás tu armario o cómo decorarías tu cuarto, ¿qué paleta de colores elegís siempre?
                </p>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="colores" id="coloresA" value="oscuros" required>

                    <label for="coloresA">
                        <span class="letra-opcion">A</span>
                        <span>Negro, gris oscuro o tonos nocturnos.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="colores" id="coloresB" value="vibrantes">

                    <label class="form-check-label" for="coloresB">
                        <span class="letra-opcion">B</span>
                        <span> Colores vibrantes, como azul eléctrico, turquesa, violeta o amarillo.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="colores" id="coloresC" value="tierra">

                    <label for="coloresC">
                        <span class="letra-opcion">C</span>
                        <span> Tonos tierra, verde musgo, marrón o bronce.</span>
                    </label>
                </div>

                <div class="opcion-dragon">
                    <input class="form-check-input" type="radio" name="colores" id="coloresD" value="fuego">

                    <label class="form-check-label" for="coloresD">
                        <span class="letra-opcion">D</span>
                        <span>
                            Rojo intenso, naranja o dorado.
                        </span>
                    </label>
                </div>
            </fieldset>
        </div>


        <div class="col-12 cierre-evaluacion">

            <div class="ornamento-cierre">ᛟ</div>

            <p class="texto-cierre">
                Tu compañero está esperando.
            </p>

            <button type="submit" class="btn btn-descubrir">Descubrir mi dragón
                <span aria-hidden="true"> →</span>
            </button>

            <p class="nota-cierre">
                LA AVENTURA COMIENZA EN BERK
            </p>

        </div>

    </form>

</section>

<script src="scripts/verificarTalentos.js"></script>