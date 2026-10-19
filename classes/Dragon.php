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

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $value)
    {
        $this->id = $value;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre(string $value)
    {
        $this->nombre = $value;
    }
    public function getClase(): string
    {
        return $this->clase;
    }
    public function setClase(string $value)
    {
        $this->clase = $value;
    }
    public function getColores(): array
    {
        return $this->colores;
    }
    public function setColores(array $value)
    {
        $this->colores = $value;
    }
    public function getHabilidades(): array
    {
        return $this->habilidades;
    }
    public function setHabilidades(array $value)
    {
        $this->habilidades = $value;
    }
    public function getCaracteristicas(): array
    {
        return $this->caracteristicas;
    }
    public function setCaracteristicas(array $value)
    {
        $this->caracteristicas = $value;
    }
    public function getTamanio(): array
    {
        return $this->tamanio;
    }
    public function setTamanio(array $value)
    {
        $this->tamanio = $value;
    }
    public function getPeso(): float
    {
        return $this->peso;
    }
    public function setPeso(float $value)
    {
        $this->peso = $value;
    }
    public function getHabitat(): array
    {
        return $this->habitat;
    }
    public function setHabitat(array $value)
    {
        $this->habitat = $value;
    }
    public function getDieta(): array
    {
        return $this->dieta;
    }
    public function setDieta(array $value)
    {
        $this->dieta = $value;
    }
    public function getFortalezas(): array
    {
        return $this->fortalezas;
    }
    public function setFortalezas(array $value)
    {
        $this->fortalezas = $value;
    }
    public function getDebilidades(): array
    {
        return $this->debilidades;
    }
    public function setDebilidades(array $value)
    {
        $this->debilidades = $value;
    }
    public function getIlustracion(): array
    {
        return $this->ilustracion;
    }
    public function setIlustracion(array $value)
    {
        $this->ilustracion = $value;
    }


}



