<?php

class Vista
{
    private string $nombre;
    private string $titulo;

    /**
     * Valida si el identificador de la vista solicitada existe en vistas.json, está activa y cuenta con su archivo físico.
     * Si no cumple los requisitos, devuelve una instancia configurada para la vista de error 404.
     *
     * @param string|null $identificador Nombre clave de la vista recibida por GET.
     * @return self Instancia de la vista validada o de la vista 404.
     */
    public static function validarVista(?string $identificador): self
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

    /**
     * Devuelve el nombre del archivo de la vista.
     *
     * @return string Nombre identificador de la vista.
     */
    public function getNombre() : string {
        return $this->nombre;
    }

    /**
     * Establece el nombre del archivo de la vista.
     *
     * @param string $value Nuevo nombre de la vista.
     * @return void
     */
    public function setNombre(string $value) {
        $this->nombre = $value;
    }

    /**
     * Devuelve el título de la vista para mostrar en la pestaña del navegador.
     *
     * @return string Título de la vista.
     */
    public function getTitulo() : string {
        return $this->titulo;
    }

    /**
     * Establece el título de la vista.
     *
     * @param string $value Nuevo título de la vista.
     * @return void
     */
    public function setTitulo(string $value) {
        $this->titulo = $value;
    }
}