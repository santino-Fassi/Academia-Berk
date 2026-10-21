<?php

class Perfil
{
    private string $nombre;
    private string $razonamiento;
    private string $lugarDesconectar;
    private string $ritmoVida;
    private array $talentos;
    private string $gustos;
    private string $estilos;


    public static function crearPerfil(array $datos): self {
        $perfil = new self();

        $perfil->nombre = $datos["nombreJinete"];
        $perfil->razonamiento = $datos["personalidad"];
        $perfil->lugarDesconectar = $datos["habitat"];
        $perfil->ritmoVida = $datos["energia"];
        $perfil->talentos = $datos["talentos"] ?? [];
        $perfil->gustos = $datos["dieta"];
        $perfil->estilos = $datos["colores"];

        return $perfil;
    }


    /**
     * Calcula y devuelve el dragón con mayor afinidad según las respuestas del perfil.
     * @return Dragon
     */
    public function calcularAfinidad(): Dragon
    {
        $dragones = Dragon::catalogo_completo();
        $dragonIdeal = null;
        $coincidenciasMaximas = 0;

        $mapaTalentos = [
            "noctambulo" => [
                "Camuflaje",
                "Invisibilidad por electricidad",
                "Camuflaje mediante explosiones de plasma",
                "Vuelo sigiloso",
                "Escamas reflectantes",
                "Camuflaje con nubes oscuras",
                "Dientes retráctiles",
                "Ojos felinos",
                "Ojos de gato",
                "Cresta larga y delgada que recorre la columna vertebral",
                "Cresta larga y delgada en las patas",
                "Cuatro pequeñas protuberancias en la cabeza"
            ],
            "complice" => [
                "Ouroboros llameante",
                "Transmisión de cerebros",
                "Control mental de dragones",
                "Creación de nidos de dragones a partir de su propio hielo",
                "Llamada ensordecedora",
                "Cola prensil",
                "Dos cabezas",
                "Cola dividida",
                "Mechones a lo largo del cuello, la espalda y la cola",
                "Volantes en la cabeza",
                "Pequeños cuernos",
                "Dientes pequeños en proporción al cuerpo"
            ],
            "terco" => [
                "Embestida frontal",
                "Inmunidad a la raíz de dragón",
                "Hibernación en el hielo",
                "Consumo e Inmunidad a las anguilas eléctricas",
                "Adaptaciones subacuáticas",
                "Potencia de fuego recargable",
                "Expansión de mandíbula",
                "Cola con forma de maza, Boca parecida a un martillo neumático",
                "Cuello blindado",
                "Largos cuernos en la cabeza",
                "Cuernos metálicos similares a los de un alce",
                "Cola en forma de hacha",
                "Espinas en forma de roca",
                "Protuberancias en el cuerpo",
                "Colmillos afilados",
                "Cuerno nasal romo",
                "Sobremordida",
                "Cara aplastada",
                "Grandes púas que sobresalen de la nuca",
                "Escamas similares a las del coral",
                "Cuernos"
            ],
            "adrenalina" => [
                "Ataque en picada",
                "velocidad mejorada",
                "Maniobrabilidad y buceo excepcionales",
                "Vuelo lateral",
                "Montar rayos para alcanzar velocidades supersónicas",
                "Volar hacia atrás y en todas direcciones",
                "Aletas detrás de las patas traseras",
                "Aletas en la cola",
                "Dos pares de alas",
                "Tres aletas caudales",
                "Aletas caudales triangulares",
                "Aletas caudales.",
                "Pequeña proporción de alas con respecto al cuerpo",
                "Garras en forma de gancho",
                "Alas con doble garra",
                "Largas garras en las alas"
            ],
            "radar" => [
                "Ecolocalización",
                "Increíble sentido del olfato",
                "Giro de cabeza de aproximadamente 180°",
                "Rastreo",
                "Detección de desastres",
                "Increíble precisión",
                "Cuerno nasal",
                "Corona puntiaguda",
                "Mandíbula superior en forma de pico",
                "Grandes ojos amarillos",
                "Punta de la cola en forma de flecha"
            ],
            "mecha_corta" => [
                "Espinas",
                "Disparo de espinas",
                "Autoinmolación",
                "Saliva inflamable",
                "Electroquinesis",
                "Cuernos llameantes",
                "Explosión dispersa por impacto",
                "Cola espinosa",
                "Dos pares de cuernos largos",
                "Espinas afiladas",
                "Cuello de serpiente",
                "Gel inflamable en la piel",
                "Espinas metálicas afiladas en la espalda",
                "Corona con púas en la cabeza",
                "Púas similares a una barba debajo de la barbilla",
                "Pequeñas espinas en la espalda y la cola",
                "Pequeñas espinas"
            ]
        ];

        $mapaHabitats = [
            "estrellas_altura" => ["DESCONOCIDO", "Montañas", "Regiones frías"],
            "montanas_cuevas" => ["Cuevas", "Montañas", "Casi todos los hábitats terrestres conocidos"],
            "bosque_pasto" => ["Bosques", " Bosques", "Casi todos los hábitats terrestres conocidos"],
            "playa_mar" => ["Nido de hielo oceánico", "Regiones frías", "DESCONOCIDO"]
        ];
        $mapaGustos = [
            "dulce_fruta" => ["Panal de miel", "Manzana", "Maiz", "Plantas", "Vegetales", "Hierba"],
            "pescado_mar" => ["Pescado", "Cangrejo", "Anguila eléctrica"],
            "carne_asada" => ["Carne Vacuna", "Pollo", "Cordero", "Jamón", "Jabalí", "Yak"],
            "crocante" => ["Rocas", "Cangrejo", "Maiz"]
        ];
        $mapaColores = [
            "oscuros" => ["Negro", "Azul Oscuro", "Gris oscuro", "Morado"],
            "vibrantes" => ["Azul", "Blanco", "Rosa", "Verde", "Variados"],
            "tierra" => ["Marrón madera", "Crema", "Crema en el vientre", "Marrón", "Gris", "Beige"],
            "fuego" => ["Rojo", "Amarillo", "Dorado", "Carmesí", "Variados"]
        ];

        foreach ($dragones as $dragon) {
            $coincidencias = 0;
            if ($this->razonamiento == $dragon->getClase()) {
                $coincidencias += 3;
            }

            $habitatsRelacionados = $mapaHabitats[$this->lugarDesconectar];
            if (count(array_intersect($habitatsRelacionados, $dragon->getHabitat())) > 0) {
                $coincidencias += 2;
            }



            switch ($this->ritmoVida) {
                case "inquieto_agil":
                    if ($dragon->getTamanio()["tipo"] == "Pequeño") $coincidencias += 2;
                    else if ($dragon->getTamanio()["tipo"] == "Mediano") $coincidencias++;
                    break;
                case "tranquilo_firme":
                    if ($dragon->getTamanio()["tipo"] == "Mediano")$coincidencias += 2;
                    else if ($dragon->getTamanio()["tipo"] == "Largo") $coincidencias++;
                    break;
                case "intenso_imponente":
                    if ($dragon->getTamanio()["tipo"] == "Largo" || $dragon->getTamanio()["tipo"] == "Gigantesco") $coincidencias += 2;
                    break;
            }

            $rasgosDragon = array_merge($dragon->getHabilidades(), $dragon->getCaracteristicas());

            foreach ($this->talentos as $talento) {
                $matches = count(array_intersect($mapaTalentos[$talento], $rasgosDragon));
                if ($matches >= 3) $coincidencias += 2;
                else if ($matches >= 1) $coincidencias++;
            }

            $comidasRelacionadas = $mapaGustos[$this->gustos];
            if (count(array_intersect($comidasRelacionadas, $dragon->getDieta())) > 0) {
                $coincidencias += 2;
            }

            $coloresRelacionados = $mapaColores[$this->estilos];
            if (count(array_intersect($coloresRelacionados, $dragon->getColores())) > 0) {
                $coincidencias += 2;
            }

            if ($coincidencias > $coincidenciasMaximas) {
                $coincidenciasMaximas = $coincidencias;
                $dragonIdeal = $dragon;
            }

        }



        return $dragonIdeal ?? $dragones[0];
    }





	public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

	public function getRazonamiento() : string {
		return $this->razonamiento;
	}

	public function setRazonamiento(string $value) {
		$this->razonamiento = $value;
	}

	public function getLugarDesconectar() : string {
		return $this->lugarDesconectar;
	}

	public function setLugarDesconectar(string $value) {
		$this->lugarDesconectar = $value;
	}

	public function getRitmoVida() : string {
		return $this->ritmoVida;
	}

	public function setRitmoVida(string $value) {
		$this->ritmoVida = $value;
	}

	public function getTalentos() : array {
		return $this->talentos;
	}

	public function setTalentos(array $value) {
		$this->talentos = $value;
	}

	public function getGustos() : string {
		return $this->gustos;
	}

	public function setGustos(string $value) {
		$this->gustos = $value;
	}

	public function getEstilos() : string {
		return $this->estilos;
	}

	public function setEstilos(string $value) {
		$this->estilos = $value;
	}
}