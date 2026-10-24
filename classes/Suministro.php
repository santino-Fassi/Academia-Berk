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

/**
	 * Devuelve el identificador único del suministro.
	 *
	 * @return int ID del suministro.
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * Establece el identificador único del suministro.
	 *
	 * @param int $value Nuevo ID del suministro.
	 * @return void
	 */
	public function setId(int $value)
	{
		$this->id = $value;
	}

	/**
	 * Devuelve el nombre del suministro.
	 *
	 * @return string Nombre del suministro.
	 */
	public function getNombre(): string
	{
		return $this->nombre;
	}

	/**
	 * Establece el nombre del suministro.
	 *
	 * @param string $value Nuevo nombre del suministro.
	 * @return void
	 */
	public function setNombre(string $value)
	{
		$this->nombre = $value;
	}

	/**
	 * Devuelve la categoría del suministro (racion, tactico, defensa).
	 *
	 * @return string Categoría del suministro.
	 */
	public function getCategoria(): string
	{
		return $this->categoria;
	}

	/**
	 * Establece la categoría del suministro.
	 *
	 * @param string $value Nueva categoría del suministro.
	 * @return void
	 */
	public function setCategoria(string $value)
	{
		$this->categoria = $value;
	}

	/**
	 * Devuelve la descripción del suministro.
	 *
	 * @return string Descripción del suministro.
	 */
	public function getDescripcion(): string
	{
		return $this->descripcion;
	}

	/**
	 * Establece la descripción del suministro.
	 *
	 * @param string $value Nueva descripción del suministro.
	 * @return void
	 */
	public function setDescripcion(string $value)
	{
		$this->descripcion = $value;
	}

	/**
	 * Devuelve el costo en monedas de oro del suministro.
	 *
	 * @return int Precio en oro.
	 */
	public function getPrecio(): int
	{
		return $this->precio;
	}

	/**
	 * Establece el costo en monedas de oro del suministro.
	 *
	 * @param int $value Nuevo precio en oro.
	 * @return void
	 */
	public function setPrecio(int $value)
	{
		$this->precio = $value;
	}

	/**
	 * Devuelve la cantidad de kilogramos de comida que aporta el suministro.
	 *
	 * @return int Kilogramos de alimento aportados.
	 */
	public function getAporteKg(): int
	{
		return $this->aporteKg;
	}

	/**
	 * Establece la cantidad de kilogramos de comida que aporta el suministro.
	 *
	 * @param int $value Nuevos kilogramos de aporte.
	 * @return void
	 */
	public function setAporteKg(int $value)
	{
		$this->aporteKg = $value;
	}

	/**
	 * Devuelve la lista de alimentos incluidos en este suministro.
	 *
	 * @return string[] Array de tipos de alimentos.
	 */
	public function getAlimentos(): array
	{
		return $this->alimentos;
	}

	/**
	 * Establece la lista de alimentos incluidos en este suministro.
	 *
	 * @param string[] $value Nuevo array de alimentos.
	 * @return void
	 */
	public function setAlimentos(array $value)
	{
		$this->alimentos = $value;
	}

	/**
	 * Devuelve los datos del ícono o imagen del suministro.
	 *
	 * @return array{img: string, alt: string} Array asociativo con la ruta y el texto alternativo.
	 */
	public function getIcono(): array
	{
		return $this->icono;
	}

	/**
	 * Establece los datos del ícono o imagen del suministro.
	 *
	 * @param array{img: string, alt: string} $value Nuevo array con datos de imagen.
	 * @return void
	 */
	public function setIcono(array $value)
	{
		$this->icono = $value;
	}

	/**
	 * Devuelve la habilidad clave que otorga el suministro, o null si no otorga ninguna.
	 *
	 * @return string|null Habilidad otorgada o null.
	 */
	public function getOtorgaHabilidad(): ?string
	{
		return $this->otorgaHabilidad;
	}

	/**
	 * Establece la habilidad clave que otorga el suministro.
	 *
	 * @param string|null $value Habilidad otorgada o null.
	 * @return void
	 */
	public function setOtorgaHabilidad(?string $value)
	{
		$this->otorgaHabilidad = $value;
	}

	/**
	 * Devuelve la debilidad que neutraliza el suministro, o null si no neutraliza ninguna.
	 *
	 * @return string|null Debilidad neutralizada o null.
	 */
	public function getNeutralizaDebilidad(): ?string
	{
		return $this->neutralizaDebilidad;
	}

	/**
	 * Establece la debilidad que neutraliza el suministro.
	 *
	 * @param string|null $value Debilidad neutralizada o null.
	 * @return void
	 */
	public function setNeutralizaDebilidad(?string $value)
	{
		$this->neutralizaDebilidad = $value;
	}
}