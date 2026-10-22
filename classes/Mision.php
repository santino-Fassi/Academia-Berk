<?php

class Mision
{
    private int $id;
    private string $titulo;
    private string $objetivo;
    private string $clima;
    private string $terreno;
    private array $habitatFavorable;
    private int $duracion;
    private array $tamaniosRiesgosos;
    private array $habilidadesClave;
    private array $riesgosDebilidades;
    private array $imagen;

    /**
     * Lee el repositorio misiones.json y devuelve el catálogo completo de objetos Mision.
     *
     * @return Mision[] Array de instancias de Mision.
     */
    public static function catalogo_completo(): array
    {
        $catalogo = [];
        $JSON = json_decode(file_get_contents("includes/misiones.json"));

        foreach ($JSON as $value) {
            $mision = new self();
            $mision->id = $value->id;
            $mision->titulo = $value->titulo;
            $mision->objetivo = $value->objetivo;
            $mision->clima = $value->clima;
            $mision->terreno = $value->terreno;
            $mision->habitatFavorable = $value->habitat_favorable;
            $mision->duracion = $value->duracion_dias;
            $mision->tamaniosRiesgosos = $value->tamanio_riesgoso;
            $mision->habilidadesClave = $value->habilidades_clave;
            $mision->riesgosDebilidades = $value->riesgos_debilidades;
            $mision->imagen = (array) $value->imagen;

            $catalogo[] = $mision;
        }

        return $catalogo;
    }

    /**
     * Busca y devuelve una misión específica del catálogo según su identificador único.
     *
     * @param int $id Identificador único de la misión.
     * @return self|null Instancia de Mision si existe, o null si no se encuentra.
     */
    public static function misionPorId(int $id): ?self
    {
        $misiones = self::catalogo_completo();
        $match = null;

        foreach ($misiones as $mision) {
            if ($mision->id == $id) {
                $match = $mision;
                break;
            }
        }

        return $match;
    }

    /**
     * Analiza las habilidades, hábitat, tamaño y debilidades de un dragón frente a las condiciones de la misión.
     *
     * @param Dragon $dragon Instancia del dragón asignado al usuario.
     * @return array{Ventajas: string[], Desventajas: string[], Puntaje: int} Array asociativo con las ventajas y desventajas detectadas, más su puntaje.
     */
    public function evaluarDragon(Dragon $dragon): array
    {
        $resultados = ["Ventajas" => [], "Desventajas" => [], "Puntaje" => 0];

        $poolHabilidades = array_merge($dragon->getHabilidades(), $dragon->getCaracteristicas());

        $resultados["Ventajas"] = array_merge($resultados["Ventajas"], array_intersect($poolHabilidades, $this->habilidadesClave));

        if (count(array_intersect($this->habitatFavorable, $dragon->getHabitat())) > 0) {
            $resultados["Ventajas"][] = "Familiarizado con el entorno";
        }

        if (in_array($dragon->getTamanio()["tipo"], $this->tamaniosRiesgosos)) {
            $resultados["Desventajas"][] = $dragon->getNombre() . " tendrá problemas en la misión por su tamaño.";
        }

        $debilidades = array_intersect($dragon->getDebilidades(), $this->riesgosDebilidades);
        $resultados["Desventajas"] = array_merge($resultados["Desventajas"], $debilidades);

        $resultados["Puntaje"] += count($resultados["Ventajas"]) - count($resultados["Desventajas"]);


        return $resultados;
    }

    /**
     * Busca en el catálogo y devuelve el dragón que mejor complementa al dragón del usuario para la misión.
     *
     * @param Dragon $dragon Dragón del Usuario.
     * @return Dragon El dragón compañero ideal para cubrir la misión.
     */
    public function sugerirCompaniero(Dragon $dragon): Dragon
    {
        $dragones = Dragon::catalogo_completo();
        $evaluacion = $this->evaluarDragon($dragon);
        $mejorCandidato = ["Dragon" => null, "Puntaje" => -999];

        foreach ($dragones as $candidato) {
            if ($candidato->getId() == $dragon->getId())
                continue;
            $evaluacionCandidato = $this->evaluarDragon($candidato);

            $complementos = array_diff($evaluacionCandidato["Ventajas"], $evaluacion['Ventajas']);
            $evaluacionCandidato["Puntaje"] += count($complementos);

            if ($evaluacionCandidato["Puntaje"] > $mejorCandidato['Puntaje']) {
                $mejorCandidato['Dragon'] = $candidato;
                $mejorCandidato['Puntaje'] = $evaluacionCandidato["Puntaje"];
            }

        }

        return $mejorCandidato['Dragon'];
    }

    /**
     * Calcula los kilos de comida necesarios para ambos dragones durante toda la misión y combina sus dietas para armar la lista de provisiones.
     *
     * @param Dragon $dragon Dragón del Usuario.
     * @param Dragon $aliado Dragón aliado que acompaña en la misión.
     * @return array{dias: int, dieta_combinada: string[], racion_diaria_aliado: float, racion_diaria_propio: float, total_kg: float} Datos del viaje.
     */
    public function calcularRacionesViaje(Dragon $dragon, Dragon $aliado): array
    {

        //Calculo el 1.5% del peso del dragon para las raciones por día, y lo acoto entre 3 y 25kg
        $racionesDragon = max(3, min(25, round($dragon->getPeso() * 0.015, 1)));
        $racionesAliado = max(3, min(25, round($aliado->getPeso() * 0.015, 1)));

        $totalKg = round(($racionesDragon + $racionesAliado) * $this->duracion, 1);

        $dietaCombinada = array_unique(array_merge($dragon->getDieta(), $aliado->getDieta()));

        $resultado = [
            "dias" => $this->duracion,
            "racion_diaria_propio" => $racionesDragon,
            "racion_diaria_aliado" => $racionesAliado,
            "total_kg" => $totalKg,
            "dieta_combinada" => $dietaCombinada
        ];

        return $resultado;
    }

    /**
     * Calcula el porcentaje de éxito y simula el resultado final de la misión evaluando las habilidades del equipo,
     * las raciones y dieta provistas en el inventario, la afinidad con el terreno, las debilidades neutralizadas o sufridas y el tamaño.
     *
     * @param Dragon $dragon Dragón principal del usuario.
     * @param Dragon $aliado Dragón compañero seleccionado para la misión.
     * @param Inventario $inventario Inventario de suministros y raciones preparado para el viaje.
     * @return array{
     *     porcentaje: int|float,
     *     exito: bool,
     *     color: string,
     *     veredicto: string,
     *     mensaje: string,
     *     habilidades_cubiertas: int,
     *     habilidades_totales: int,
     *     kg_llevados: int|float,
     *     kg_requeridos: float,
     *     comidas_cubiertas: int,
     *     comidas_totales: int,
     *     debilidades_neutralizadas: string[],
     *     debilidades_sufridas: string[],
     *     problemas_tamanio: string[]
     * } Resumen detallado con las métricas y el veredicto de la misión.
     */
    public function calcularResultadoMision(Dragon $dragon, Dragon $aliado, Inventario $inventario): array
    {
        $puntaje = 10;

        $poolEquipo = array_unique(array_merge($dragon->getHabilidades(), $dragon->getCaracteristicas(), $aliado->getHabilidades(), $aliado->getCaracteristicas()));

        //puntos por habilidades
        $habilidadesCubiertas = array_intersect($this->habilidadesClave, $poolEquipo);
        $totalHabilidadesMision = count($this->habilidadesClave);
        $puntosHabilidades = round((count($habilidadesCubiertas) / $totalHabilidadesMision) * 35);
        $puntaje += $puntosHabilidades;

        //puntos por raciones y dieta
        $racionesNecesarias = $this->calcularRacionesViaje($dragon, $aliado);
        $racionesInventario = $inventario->obtenerRaciones();

        $proporcionKg = min(1, $racionesInventario["total_kg"] / max(1, $racionesNecesarias['total_kg']));
        $puntosKg = round($proporcionKg * 25);

        $comidasCubiertas = array_intersect($racionesNecesarias['dieta_combinada'], $racionesInventario["tipos"]);
        $totalComidas = count($racionesNecesarias['dieta_combinada']);
        $puntosDieta = round((count($comidasCubiertas) / $totalComidas) * 15);

        $penalizacionHambre = ($racionesInventario["total_kg"] == 0) ? 20 : 0;
        $puntaje += ($puntosKg + $puntosDieta) - $penalizacionHambre;

        //puntos por afinidad de terreno (habitats)
        $afinidadDragon = count(array_intersect($this->habitatFavorable, $dragon->getHabitat()));
        $afinidadAliado = count(array_intersect($this->habitatFavorable, $aliado->getHabitat()));

        $puntosTerreno = 0;
        if ($afinidadDragon > 0 && $afinidadAliado > 0)
            $puntosTerreno = 15;
        else if ($afinidadDragon > 0 || $afinidadAliado > 0)
            $puntosTerreno = 10;

        $puntaje += $puntosTerreno;

        //penalizaciones por debilidades y tamaño
        $neutralizadas = $inventario->obtenerNeutralizantes();
        $debilidadesSufridas = [];
        $debilidadesNeutralizadas = [];

        foreach ($this->riesgosDebilidades as $riesgo) {
            if (in_array($riesgo, $neutralizadas)) {
                $debilidadesNeutralizadas[] = $riesgo;
                continue;
            }
            if (in_array($riesgo, $dragon->getDebilidades()) || in_array($riesgo, $aliado->getDebilidades())) {
                $debilidadesSufridas[] = $riesgo;
            }
        }

        $penalizacionDebilidades = count($debilidadesSufridas);

        $penalizacionTamanio = 0;
        $problemasTamanio = [];
        if (in_array($dragon->getTamanio()["tipo"], $this->tamaniosRiesgosos) && in_array($aliado->getTamanio()["tipo"], $this->tamaniosRiesgosos)) {
            $penalizacionTamanio = 12;
            $problemasTamanio[] = $dragon->getTamanio()["tipo"];
        } else if (in_array($dragon->getTamanio()["tipo"], $this->tamaniosRiesgosos) || in_array($aliado->getTamanio()["tipo"], $this->tamaniosRiesgosos)) {
            $penalizacionTamanio = 6;
            if (in_array($dragon->getTamanio()["tipo"], $this->tamaniosRiesgosos))
                $problemasTamanio[] = $dragon->getTamanio()["tipo"];
            else
                $problemasTamanio[] = $aliado->getTamanio()["tipo"];
        }

        $puntaje -= $penalizacionDebilidades + $penalizacionTamanio;

        $porcentajeFinal = max(5, min(100, $puntaje));

        $exito = random_int(1, 100) <= $porcentajeFinal;

        return [
            "porcentaje" => $porcentajeFinal,
            "exito" => $exito,
            "color" => $exito ? "success" : "danger",
            "veredicto" => $exito ? "¡Victoria!" : "Retirada Forzosa",
            "mensaje" => $exito ? "¡Lograron cumplir el objetivo!" : "La misión no fue exitosa...",
            "habilidades_cubiertas" => count($habilidadesCubiertas),
            "habilidades_totales" => count($this->habilidadesClave),
            "kg_llevados" => $racionesInventario["total_kg"],
            "kg_requeridos" => $racionesNecesarias['total_kg'],
            "comidas_cubiertas" => count($comidasCubiertas),
            "comidas_totales" => count($racionesNecesarias['dieta_combinada']),
            "debilidades_neutralizadas" => $debilidadesNeutralizadas,
            "debilidades_sufridas" => $debilidadesSufridas,
            "problemas_tamanio" => $problemasTamanio
        ];

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value)
    {
        $this->id = $value;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $value)
    {
        $this->titulo = $value;
    }

    public function getObjetivo(): string
    {
        return $this->objetivo;
    }

    public function setObjetivo(string $value)
    {
        $this->objetivo = $value;
    }

    public function getClima(): string
    {
        return $this->clima;
    }

    public function setClima(string $value)
    {
        $this->clima = $value;
    }

    public function getTerreno(): string
    {
        return $this->terreno;
    }

    public function setTerreno(string $value)
    {
        $this->terreno = $value;
    }

    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function setDuracion(int $value)
    {
        $this->duracion = $value;
    }

    public function getTamaniosRiesgosos(): array
    {
        return $this->tamaniosRiesgosos;
    }

    public function setTamaniosRiesgosos(array $value)
    {
        $this->tamaniosRiesgosos = $value;
    }

    public function getHabilidadesClave(): array
    {
        return $this->habilidadesClave;
    }

    public function setHabilidadesClave(array $value)
    {
        $this->habilidadesClave = $value;
    }

    public function getRiesgosDebilidades(): array
    {
        return $this->riesgosDebilidades;
    }

    public function setRiesgosDebilidades(array $value)
    {
        $this->riesgosDebilidades = $value;
    }

    public function getImagen(): array
    {
        return $this->imagen;
    }

    public function setImagen(array $value)
    {
        $this->imagen = $value;
    }


    public function getHabitatFavorable(): array
    {
        return $this->habitatFavorable;
    }

    public function setHabitatFavorable(array $value)
    {
        $this->habitatFavorable = $value;
    }
}