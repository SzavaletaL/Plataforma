<?php
require_once("modelo/index.php");

class modeloController
{
    // Atributo de la clase
    private $model;

    // Constructor
    public function __construct()
    {
        $this->model = new Modelo();
    }

    // Mostrar todos los productos
    static function index()
    {
        $producto = new Modelo();
        $productos = $producto->mostrar("products", "1=1"); // Cambiar $data por $productos
        require_once("vista/index.php");
    }

    // Mostrar formulario para nuevo producto
    static function nuevo()
    {
        require_once("vista/nuevo.php");
    }

    // Guardar nuevo producto
    static function guardar()
    {
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $data = "'" . $nombre . "','" . $precio . "'";
        $producto = new Modelo();
        $dato = $producto->insertar("productos", $data);
        header("location:" . urlsite);
    }

    // Mostrar formulario para editar producto
    static function editar()
    {
        $id = $_REQUEST['id'];
        $producto = new Modelo();
        $dato = $producto->mostrar("productos", "id=" . $id);
        require_once("vista/editar.php");
    }

    // Actualizar producto existente
    static function actualizar()
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $data = "nombre='" . $nombre . "',precio='" . $precio . "'";
        $producto = new Modelo();
        $dato = $producto->actualizar("productos", $data, "id=" . $id);
        header("location:" . urlsite);
    }

    // Eliminar producto
    static function eliminar()
    {
        $id = $_REQUEST['id'];
        $producto = new Modelo();
        $dato = $producto->eliminar("productos", "id=" . $id);
        header("location:" . urlsite);
    }
}
