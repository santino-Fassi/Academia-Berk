<?php
class Inventario
{

    private int $oroInicial;
    private int $oro;
    private array $objetos;

    /**
     * Crea e inicializa una instancia de Inventario con un presupuesto de oro y las cantidades de cada suministro.
     *
     * @param int $oro Presupuesto inicial de monedas de oro (por defecto 500).
     * @param array<int, int> $objetos Mapa asociativo [id_suministro => cantidad] con los objetos seleccionados.
     * @return Inventario Instancia del inventario con el oro actualizado.
     */
    public static function crearInventario(int $oro = 500, array $objetos = []): Inventario
    {
        $inventario = new self();
        $inventario->oroInicial = $oro;
        $inventario->oro = $inventario->oroInicial;
        $inventario->objetos = [];

        foreach (Suministro::catalogo_completo() as $suministro) {
            $id = $suministro->getId();
            $cantidad = isset($objetos[$id]) ? max(0, (int) $objetos[$id]) : 0;
            $inventario->objetos[$id] = $cantidad;
        }

        $inventario->ActualizarOro();

        return $inventario;
    }

    /**
     * Recalcula el oro disponible restando al oro inicial el costo total de todos los suministros en el inventario.
     *
     * @return void
     */
    public function ActualizarOro()
    {
        $this->oro = $this->oroInicial;
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            $this->oro -= $suministro->getPrecio() * $cantidad;
        }
    }

    /**
     * Calcula los kilogramos totales de comida acumulados en el inventario y lista los tipos de alimentos cubiertos.
     *
     * @return array{tipos: string[], total_kg: int|float} Resumen con los tipos de alimentos únicos y el peso total en Kg.
     */
    public function obtenerRaciones(): array
    {
        $raciones = ["tipos" => [], "total_kg" => 0];
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            if ($suministro->getCategoria() != "racion")
                continue;
            $raciones['total_kg'] += $suministro->getAporteKg() * $cantidad;
            if ($cantidad > 0) {
                $raciones["tipos"] = array_unique(array_merge($raciones["tipos"], $suministro->getAlimentos()));
            }
        }

        return $raciones;
    }

    /**
     * Obtiene todas las habilidades adicionales otorgadas por los suministros (que no sean raciones) presentes en el inventario.
     *
     * @return string[] Lista de habilidades otorgadas por el equipamiento.
     */
    public function obtenerHabilidades(): array
    {
        $habilidades = [];
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            if ($suministro->getCategoria() == "racion")
                continue;
            if ($cantidad > 0 && $suministro->getOtorgaHabilidad()) {
                $habilidades[] = $suministro->getOtorgaHabilidad();
            }
        }

        return $habilidades;
    }

    /**
     * Obtiene todas las debilidades que son neutralizadas por los suministros (que no sean raciones) presentes en el inventario.
     *
     * @return string[] Lista de debilidades o riesgos neutralizados.
     */
    public function obtenerNeutralizantes(): array
    {
        $neutralidos = [];
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            if ($suministro->getCategoria() == "racion")
                continue;
            if ($cantidad > 0 && $suministro->getNeutralizaDebilidad()) {
                $neutralidos[] = $suministro->getNeutralizaDebilidad();
            }
        }

        return $neutralidos;
    }

    /**
     * Verifica si el inventario cuenta con al menos una unidad de un suministro determinado.
     *
     * @param int $suministroId ID del suministro a consultar.
     * @return bool True si la cantidad es mayor a 0, False en caso contrario.
     */
    public function tengoSuministro(int $suministroId): bool
    {
        return $this->objetos[$suministroId] > 0;
    }

    /**
     * Devuelve la cantidad de unidades disponibles de un suministro específico en el inventario.
     *
     * @param int $suministroId ID del suministro a consultar.
     * @return int Cantidad de unidades en el inventario (0 si no existe).
     */
    public function cantidadSuministro(int $suministroId): int
    {
        return $this->objetos[$suministroId] ?? 0;
    }

    /**
     * Incrementa en 1 la cantidad de unidades de un suministro específico en el inventario.
     *
     * @param int $suministroId ID del suministro a agregar.
     * @return void
     */
    public function agregarSuministro(int $suministroId)
    {
        $this->objetos[$suministroId]++;
    }

    /**
     * Decrementa en 1 la cantidad de unidades de un suministro específico en el inventario.
     *
     * @param int $suministroId ID del suministro a quitar.
     * @return void
     */
    public function sacarSuministro(int $suministroId)
    {
        $this->objetos[$suministroId]--;
    }

    public function getOroInicial(): int
    {
        return $this->oroInicial;
    }
    public function setOroInicial(int $value)
    {
        $this->oroInicial = $value;
    }
    public function getOro(): int
    {
        return $this->oro;
    }
    public function setOro(int $value)
    {
        $this->oro = $value;
    }
    public function getObjetos(): array
    {
        return $this->objetos;
    }
    public function setObjetos(array $value)
    {
        $this->objetos = $value;
    }

}