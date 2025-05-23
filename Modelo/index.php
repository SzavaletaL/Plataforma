<?php
class Modelo
{
    // Atributos de la clase
    private $Modelo;
    private $db;
    private $datos;

    // Constructor
    public function __construct()
    {
        $this->Modelo = array();
        $this->db = new PDO('mysql:host=dataepis.uandina.pe:49206;dbname=BDProductos', "luissalas", "luissalas2025");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método para insertar datos
    public function insertar($tabla, $data)
    {
        $consulta = "INSERT INTO " . $tabla . " VALUES(null, " . $data . ")";
        $resultado = $this->db->query($consulta);
        return $resultado ? true : false;
    }

    // Método para mostrar datos
public function mostrar($tabla, $condicion = '1')
{
    $consul = "SELECT * FROM $tabla WHERE $condicion";
    $resu = $this->db->query($consul);
    return $resu->fetchAll(PDO::FETCH_ASSOC);
}


    // Método para actualizar datos
    public function actualizar($tabla, $data, $condicion)
    {
    $consulta = "UPDATE $tabla SET $data WHERE $condicion";
    $stmt = $this->db->prepare($consulta);

    foreach ($valores as $campo => $valor) {
        $stmt->bindValue(':' . $campo, $valor);
    }

    return $stmt->execute();
}

    // Método para eliminar datos
    public function eliminar($tabla, $condicion)
    {
        $eli = "DELETE FROM " . $tabla . " WHERE " . $condicion;
        $res = $this->db->query($eli);
        return $res ? true : false;
    }
}
