<?php

class Dragon
{
    private int $id;
    private string $nombre;
    private string $clase;
    private array $colores;
    private array $habilidades;
    private array $caracteristicas;
    private array $tamanio;
    private float $peso;
    private array $habitat;
    private array $dieta;
    private array $fortalezas;
    private array $debilidades;
    private array $ilustracion;

    /**
     * Lee el repositorio dragones.json y devuelve el catálogo completo de objetos Dragon.
     *
     * @return Dragon[] Array de instancias de Dragon.
     */
    public static function catalogo_completo(): array
    {
        $catalogo = [];
        $JSON = json_decode(file_get_contents("includes/dragones.json"));

        foreach ($JSON as $value) {
            $dragon = new self();
            $dragon->id = $value->id;
            $dragon->nombre = $value->nombre;
            $dragon->clase = $value->clase;
            $dragon->colores = $value->colores;
            $dragon->habilidades = $value->habilidades;
            $dragon->caracteristicas = $value->caracteristicas;
            $dragon->tamanio = (array) $value->tamanio;
            $dragon->peso = $value->peso;
            $dragon->habitat = $value->habitat;
            $dragon->dieta = $value->dieta;
            $dragon->fortalezas = $value->fortalezas;
            $dragon->debilidades = $value->debilidades;
            $dragon->ilustracion = (array) $value->ilustracion;

            $catalogo[] = $dragon;
        }

        return $catalogo;
    }

    /**
     * Busca y devuelve un dragón específico del catálogo según su identificador único.
     *
     * @param int $id Identificador único del dragón.
     * @return self|null Instancia de Dragon si se encuentra, o null en caso contrario.
     */
    public static function dragonPorId(int $id): ?self
    {
        $dragones = self::catalogo_completo();
        $match = null;

        foreach ($dragones as $dragon) {
            if ($dragon->id == $id) {
                $match = $dragon;
                break;
            }
        }

        return $match;
    }

    /**
     * Devuelve el ID del dragón.
     * @return int Id del dragón.
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * Función para setearle un ID al dragón.
     * @param int $value ID nueva del dragón.
     * @return void
     */
    public function setId(int $value)
    {
        $this->id = $value;
    }
/**
     * Devuelve el nombre de la especie del dragón.
     *
     * @return string Nombre del dragón.
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Establece el nombre de la especie del dragón.
     *
     * @param string $value Nuevo nombre del dragón.
     * @return void
     */
    public function setNombre(string $value)
    {
        $this->nombre = $value;
    }

    /**
     * Devuelve la clase a la que pertenece el dragón.
     *
     * @return string Clase del dragón.
     */
    public function getClase(): string
    {
        return $this->clase;
    }

    /**
     * Establece la clase a la que pertenece el dragón.
     *
     * @param string $value Nueva clase del dragón.
     * @return void
     */
    public function setClase(string $value)
    {
        $this->clase = $value;
    }

    /**
     * Devuelve los colores predominantes de las escamas del dragón.
     *
     * @return string[] Lista de colores.
     */
    public function getColores(): array
    {
        return $this->colores;
    }

    /**
     * Establece los colores predominantes del dragón.
     *
     * @param string[] $value Nueva lista de colores.
     * @return void
     */
    public function setColores(array $value)
    {
        $this->colores = $value;
    }

    /**
     * Devuelve la lista de habilidades especiales del dragón.
     *
     * @return string[] Array de habilidades.
     */
    public function getHabilidades(): array
    {
        return $this->habilidades;
    }

    /**
     * Establece la lista de habilidades especiales del dragón.
     *
     * @param string[] $value Nuevo array de habilidades.
     * @return void
     */
    public function setHabilidades(array $value)
    {
        $this->habilidades = $value;
    }

    /**
     * Devuelve los rasgos físicos y morfológicos del dragón.
     *
     * @return string[] Array de características físicas.
     */
    public function getCaracteristicas(): array
    {
        return $this->caracteristicas;
    }

    /**
     * Establece los rasgos físicos y morfológicos del dragón.
     *
     * @param string[] $value Nuevo array de características físicas.
     * @return void
     */
    public function setCaracteristicas(array $value)
    {
        $this->caracteristicas = $value;
    }

    /**
     * Devuelve las dimensiones del dragón (categoría de tipo, ancho, alto y envergadura de alas).
     *
     * @return array{tipo: string, ancho: float, alto: float, alas: float} Datos de tamaño.
     */
    public function getTamanio(): array
    {
        return $this->tamanio;
    }

    /**
     * Establece las dimensiones del dragón.
     *
     * @param array{tipo: string, ancho: float, alto: float, alas: float} $value Nuevos datos de tamaño.
     * @return void
     */
    public function setTamanio(array $value)
    {
        $this->tamanio = $value;
    }

    /**
     * Devuelve el peso del dragón en kilogramos.
     *
     * @return float Peso en Kg.
     */
    public function getPeso(): float
    {
        return $this->peso;
    }

    /**
     * Establece el peso del dragón en kilogramos.
     *
     * @param float $value Nuevo peso en Kg.
     * @return void
     */
    public function setPeso(float $value)
    {
        $this->peso = $value;
    }

    /**
     * Devuelve los hábitats naturales donde habita el dragón.
     *
     * @return string[] Lista de hábitats.
     */
    public function getHabitat(): array
    {
        return $this->habitat;
    }

    /**
     * Establece los hábitats naturales del dragón.
     *
     * @param string[] $value Nueva lista de hábitats.
     * @return void
     */
    public function setHabitat(array $value)
    {
        $this->habitat = $value;
    }

    /**
     * Devuelve los alimentos que componen la dieta del dragón.
     *
     * @return string[] Lista de alimentos.
     */
    public function getDieta(): array
    {
        return $this->dieta;
    }

    /**
     * Establece los alimentos que componen la dieta del dragón.
     *
     * @param string[] $value Nueva lista de alimentos.
     * @return void
     */
    public function setDieta(array $value)
    {
        $this->dieta = $value;
    }

    /**
     * Devuelve la lista de fortalezas adicionales del dragón.
     *
     * @return string[] Lista de fortalezas.
     */
    public function getFortalezas(): array
    {
        return $this->fortalezas;
    }

    /**
     * Establece la lista de fortalezas adicionales del dragón.
     *
     * @param string[] $value Nueva lista de fortalezas.
     * @return void
     */
    public function setFortalezas(array $value)
    {
        $this->fortalezas = $value;
    }

    /**
     * Devuelve la lista de debilidades y vulnerabilidades del dragón.
     *
     * @return string[] Lista de debilidades.
     */
    public function getDebilidades(): array
    {
        return $this->debilidades;
    }

    /**
     * Establece la lista de debilidades y vulnerabilidades del dragón.
     *
     * @param string[] $value Nueva lista de debilidades.
     * @return void
     */
    public function setDebilidades(array $value)
    {
        $this->debilidades = $value;
    }

    /**
     * Devuelve los datos de la ilustración del dragón (archivo de imagen y texto alternativo).
     *
     * @return array{img: string, alt: string} Datos de la ilustración.
     */
    public function getIlustracion(): array
    {
        return $this->ilustracion;
    }

    /**
     * Establece los datos de la ilustración del dragón.
     *
     * @param array{img: string, alt: string} $value Nuevos datos de la ilustración.
     * @return void
     */
    public function setIlustracion(array $value)
    {
        $this->ilustracion = $value;
    }


}



