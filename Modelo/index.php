<?php
class Modelo
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO(
            'mysql:host=dataepis.uandina.pe:49206;dbname=BDProductos;charset=utf8',
            "luissalas",
            "luissalas2025",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function insertar($tabla, $datos)
    {
        try {
            $campos = implode(', ', array_keys($datos));
            $placeholders = ':' . implode(', :', array_keys($datos));

            $stmt = $this->db->prepare("INSERT INTO $tabla ($campos) VALUES ($placeholders)");
            return $stmt->execute($datos);
        } catch (PDOException $e) {
            error_log("Error en inserción: " . $e->getMessage());
            return false;
        }
    }

    public function mostrar($tabla, $condicion = '1', $parametros = [])
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM $tabla WHERE $condicion");
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error en consulta: " . $e->getMessage());
            return [];
        }
    }

    public function actualizar($tabla, $datos, $condicion, $parametros = [])
    {
        try {
            $campos = [];
            foreach ($datos as $campo => $valor) {
                $campos[] = "$campo = :$campo";
            }
            $set = implode(', ', $campos);

            $stmt = $this->db->prepare("UPDATE $tabla SET $set WHERE $condicion");
            return $stmt->execute(array_merge($datos, $parametros));
        } catch (PDOException $e) {
            error_log("Error en actualización: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($tabla, $condicion, $parametros = [])
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM $tabla WHERE $condicion");
            return $stmt->execute($parametros);
        } catch (PDOException $e) {
            error_log("Error en eliminación: " . $e->getMessage());
            return false;
        }
    }
}
