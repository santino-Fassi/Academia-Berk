<?PHP

class Producto {
    private int $id;
    private string $nombre;
    private string $descripcion;
    private int $precio;
    private string $imagen;
    private string $alt;
    private string $categoria;


    public static function catalogo_completo(): array
    {
        $catalogo = [];
        $JSON = json_decode(file_get_contents("includes/productos.json"));

        foreach ($JSON as $value)
        {
            $producto = new self();
            $producto->id = $value->id;
            $producto->nombre = $value->nombre;
            $producto->descripcion = $value->descripcion;
            $producto->precio = $value->precio;
            $producto->imagen = $value->imagen;
            $producto->alt = $value->alt;
            $producto->categoria = $value->categoria;

            $catalogo[] = $producto;
        }

        return $catalogo;
    }

    public static function catalogo_x_compania(string $compania): array
    {
        $productos = self::catalogo_completo();
        $filtrados = [];

        foreach ($productos as $producto) {
            if ($producto->categoria == $compania) {
                $filtrados[] = $producto;
            }
        }

        return $filtrados;
    }

    public static function producto_x_id(int $id): mixed {
        $productos = self::catalogo_completo();
        $match = null;

        foreach ($productos as $producto) {
            if ($producto->id == $id) {
                $match = $producto;
                break;
            }
        }

        return $match;
    }


	public function getId() : int {
		return $this->id;
	}

	public function setId(int $value) {
		$this->id = $value;
	}

	public function getNombre() : string {
		return $this->nombre;
	}

	public function setNombre(string $value) {
		$this->nombre = $value;
	}

	public function getDescripcion() : string {
		return $this->descripcion;
	}

	public function setDescripcion(string $value) {
		$this->descripcion = $value;
	}

	public function getPrecio() : int {
		return $this->precio;
	}

	public function setPrecio(int $value) {
		$this->precio = $value;
	}

	public function getImagen() : string {
		return $this->imagen;
	}

	public function setImagen(string $value) {
		$this->imagen = $value;
	}

	public function getAlt() : string {
		return $this->alt;
	}

	public function setAlt(string $value) {
		$this->alt = $value;
	}

	public function getCategoria() : string {
		return $this->categoria;
	}

	public function setCategoria(string $value) {
		$this->categoria = $value;
	}


}