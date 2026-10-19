<?PHP

class Vista
{
    private string $nombre;
    private string $titulo;

    public static function validarVista(?string $identificador)
    {
        $JSON = json_decode(file_get_contents("includes/vistas.json"));

        foreach ($JSON as $vista)
        {
            if ($vista->nombre == $identificador)
            {
                if (!$vista->activa) continue;
                if ($vista->restringida) continue;
                if (!file_exists("views/$vista->nombre.php")) continue;

                $objVista = new self();
                $objVista->nombre = $vista->nombre;
                $objVista->titulo = $vista->titulo;

                return $objVista;
            }

            $vista404 = new self();
            $vista404->nombre = "404";
            $vista404->titulo = "Error 404 - Página no encontrada";
            
        }

        return $vista404;
    }



	public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

	public function getTitulo() : string {
		return $this->titulo;
	}

	public function setTitulo(string $value) {
		$this->titulo = $value;
	}
}