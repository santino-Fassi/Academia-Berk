<?php

class Region
{
    private string $id;
    private string $nombre;
    private string $descripcion;
    private array $habitats;

    /**
     * Lee el repositorio regiones.json y devuelve el catálogo completo de objetos Region.
     *
     * @return Region[] Array de instancias de Region.
     */
    public static function catalogo_completo(): array
    {
        $catalogo = [];$JSON = json_decode(file_get_contents("includes/regiones.json"));

        foreach ($JSON as $value) {$region = new self();

            $region->id =$value->id;
            $region->nombre =$value->nombre;
            $region->descripcion =$value->descripcion;
            $region->habitats =$value->habitats;

            $catalogo[] =$region;
        }

        return $catalogo;
    }

    /**
     * Busca y devuelve una región específica del catálogo según su identificador en formato texto.
     *
     * @param string $id Identificador único de la región.
     * @return self|null Instancia de Region si se encuentra, o null en caso contrario.
     */
    public static function regionPorId(string $id): ?self
    {
        $regiones = self::catalogo_completo();

        foreach ($regiones as$region) {
            if ($region->getId() ==$id) {
                return $region;
            }
        }

        return null;
    }

    /**
     * Devuelve el identificador único de la región.
     *
     * @return string ID de la región.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Asigna el identificador único de la región.
     *
     * @param string $value Nuevo ID de la región.
     * @return void
     */
    public function setId(string $value)
    {
        $this->id =$value;
    }

    /**
     * Devuelve el nombre de la región.
     *
     * @return string Nombre de la región.
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Asigna el nombre de la región.
     *
     * @param string $value Nuevo nombre de la región.
     * @return void
     */
    public function setNombre(string $value)
    {
        $this->nombre =$value;
    }

    /**
     * Devuelve la descripción detallada de la región.
     *
     * @return string Descripción de la región.
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * Asigna la descripción de la región.
     *
     * @param string $value Nueva descripción de la región.
     * @return void
     */
    public function setDescripcion(string $value)
    {
        $this->descripcion =$value;
    }

    /**
     * Devuelve la lista de hábitats presentes en la región.
     *
     * @return string[] Array de hábitats de la región.
     */
    public function getHabitats(): array
    {
        return $this->habitats;
    }

    /**
     * Asigna la lista de hábitats de la región.
     *
     * @param string[] $value Nuevo array de hábitats.
     * @return void
     */
    public function setHabitats(array $value)
    {
        $this->habitats =$value;
    }
}