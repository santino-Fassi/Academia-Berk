<?php

class Suministro
{
	private int $id;
	private string $nombre;
	private string $categoria;
	private string $descripcion;
	private int $precio;
	private int $aporteKg;
	private array $alimentos;
	private ?string $otorgaHabilidad;
	private ?string $neutralizaDebilidad;
	private array $icono;

	/**
	 * Lee el repositorio suministros.json y devuelve el catálogo completo de objetos Suministro.
	 *
	 * @return Suministro[] Array de instancias de Suministro.
	 */
	public static function catalogo_completo(): array
	{
		$catalogo = [];
		$JSON = json_decode(file_get_contents("includes/suministros.json"));

		foreach ($JSON as $value) {
			$suministro = new self();
			$suministro->id = $value->id;
			$suministro->nombre = $value->nombre;
			$suministro->categoria = $value->categoria;
			$suministro->descripcion = $value->descripcion;
			$suministro->precio = $value->costo_oro;
			$suministro->aporteKg = $value->aporte_kg;
			$suministro->alimentos = (array) $value->alimentos;
			$suministro->otorgaHabilidad = $value->otorga_habilidad;
			$suministro->neutralizaDebilidad = $value->neutraliza_debilidad;
			$suministro->icono = (array) $value->icono;

			$catalogo[] = $suministro;
		}

		return $catalogo;
	}

	/**
	 * Busca y devuelve un suministro específico del catálogo según su identificador único.
	 *
	 * @param int $id Identificador único del suministro.
	 * @return self|null Instancia de Suministro si existe, o null si no se encuentra.
	 */
	public static function suministroPorId(int $id): ?self
	{
		$suministros = self::catalogo_completo();
		$match = null;

		foreach ($suministros as $suministro) {
			if ($suministro->id == $id) {
				$match = $suministro;
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

	public function getCategoria(): string
	{
		return $this->categoria;
	}

	public function setCategoria(string $value)
	{
		$this->categoria = $value;
	}

	public function getDescripcion(): string
	{
		return $this->descripcion;
	}

	public function setDescripcion(string $value)
	{
		$this->descripcion = $value;
	}

	public function getPrecio(): int
	{
		return $this->precio;
	}

	public function setPrecio(int $value)
	{
		$this->precio = $value;
	}

	public function getAporteKg(): int
	{
		return $this->aporteKg;
	}

	public function setAporteKg(int $value)
	{
		$this->aporteKg = $value;
	}

	public function getAlimentos(): array
	{
		return $this->alimentos;
	}

	public function setAlimentos(array $value)
	{
		$this->alimentos = $value;
	}

	public function getIcono(): array
	{
		return $this->icono;
	}

	public function setIcono(array $value)
	{
		$this->icono = $value;
	}


	public function getOtorgaHabilidad(): ?string
	{
		return $this->otorgaHabilidad;
	}

	public function setOtorgaHabilidad(?string $value)
	{
		$this->otorgaHabilidad = $value;
	}

	public function getNeutralizaDebilidad(): ?string
	{
		return $this->neutralizaDebilidad;
	}

	public function setNeutralizaDebilidad(?string $value)
	{
		$this->neutralizaDebilidad = $value;
	}
}