<?php
require_once("modelo/index.php");

class ModeloController
{
    // Constante para redirecciones
    const URL_SITE = 'http://tu-dominio.com/'; // Cambiar por tu URL real

    // Método para obtener instancia del modelo
    private static function getModel()
    {
        return new Modelo();
    }

    // Mostrar todos los productos
    static function index()
    {
        try {
            $model = self::getModel();
            $productos = $model->mostrar("products", "1", []);
            require_once("vista/index.php");
        } catch (Exception $e) {
            self::handleError($e);
        }
    }

    // Mostrar formulario para nuevo producto
    static function nuevo()
    {
        require_once("vista/nuevo.php");
    }

    // Guardar nuevo producto
    static function guardar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            $nombre = self::sanitizeInput($_POST['nombre']);
            $precio = self::sanitizeFloat($_POST['precio']);

            $model = self::getModel();
            $model->insertar("products", [
                'nombre' => $nombre,
                'precio' => $precio
            ]);

            self::redirect();
        } catch (Exception $e) {
            self::handleError($e);
        }
    }

    // Mostrar formulario para editar producto
    static function editar()
    {
        try {
            $id = self::validateId($_GET['id']);
            $model = self::getModel();
            $producto = $model->mostrar("products", "id = :id", ['id' => $id]);

            if (empty($producto)) {
                throw new Exception('Producto no encontrado');
            }

            require_once("vista/editar.php");
        } catch (Exception $e) {
            self::handleError($e);
        }
    }

    // Actualizar producto existente
    static function actualizar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            $id = self::validateId($_POST['id']);
            $nombre = self::sanitizeInput($_POST['nombre']);
            $precio = self::sanitizeFloat($_POST['precio']);

            $model = self::getModel();
            $model->actualizar(
                "products",
                ['nombre' => $nombre, 'precio' => $precio],
                "id = :id",
                ['id' => $id]
            );

            self::redirect();
        } catch (Exception $e) {
            self::handleError($e);
        }
    }

    // Eliminar producto
    static function eliminar()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Método no permitido');
            }

            $id = self::validateId($_POST['id']);
            $model = self::getModel();
            $model->eliminar("products", "id = :id", ['id' => $id]);

            self::redirect();
        } catch (Exception $e) {
            self::handleError($e);
        }
    }

    // Métodos de utilidad
    private static function sanitizeInput($value)
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }

    private static function sanitizeFloat($value)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    private static function validateId($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false || $id < 1) {
            throw new Exception('ID inválido');
        }
        return $id;
    }

    private static function redirect()
    {
        header("Location: " . self::URL_SITE);
        exit();
    }

    private static function handleError($exception)
    {
        error_log($exception->getMessage());
        header("Location: " . self::URL_SITE . "?error=" . urlencode($exception->getMessage()));
        exit();
    }
}
