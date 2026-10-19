<?php
class Inventario {

    private int $oroInicial;
    private int $oro;
    private array $objetos;

    public static function crearInventario(int $oro = 500, array $objetos = []): Inventario {
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

    public function ActualizarOro() {
        $this->oro = $this->oroInicial;
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            $this->oro -= $suministro->getPrecio() * $cantidad;
        }
    }

    public function obtenerRaciones(): array {
        $raciones = ["tipos" => [], "total_kg" => 0];
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            if ($suministro->getCategoria() != "racion") continue;
            $raciones['total_kg'] += $suministro->getAporteKg() * $cantidad;
            if ($cantidad > 0) {
                $raciones["tipos"] = array_unique(array_merge($raciones["tipos"], $suministro->getAlimentos()));
            }
        }

        return $raciones;
    }

    public function obtenerHabilidades(): array {
        $habilidades = [];
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            if ($suministro->getCategoria() == "racion") continue;
            if ($cantidad > 0 && $suministro->getOtorgaHabilidad()) {
                $habilidades[] = $suministro->getOtorgaHabilidad();
            }
        }

        return $habilidades;
    }

    public function obtenerNeutralizantes(): array {
        $neutralidos = [];
        foreach ($this->objetos as $id => $cantidad) {
            $suministro = Suministro::suministroPorId($id);
            if ($suministro->getCategoria() == "racion") continue;
            if ($cantidad > 0 && $suministro->getNeutralizaDebilidad()) {
                $neutralidos[] = $suministro->getNeutralizaDebilidad();
            }
        }

        return $neutralidos;
    }

    public function tengoSuministro(int $suministroId): bool {
        return $this->objetos[$suministroId] > 0;
    }
    public function cantidadSuministro(int $suministroId): int {
        return $this->objetos[$suministroId] ?? 0;
    }
    public function agregarSuministro(int $suministroId) {
        $this->objetos[$suministroId]++;
    }
    public function sacarSuministro(int $suministroId) {
        $this->objetos[$suministroId]--;
    }

    public function getOroInicial(): int {
        return $this->oroInicial;
    }
    public function setOroInicial(int $value) {
        $this->oroInicial = $value;
    }
    public function getOro(): int {
        return $this->oro;
    }
    public function setOro(int $value) {
        $this->oro = $value;
    }
    public function getObjetos(): array {
        return $this->objetos;
    }
    public function setObjetos(array $value) {
        $this->objetos = $value;
    }

}