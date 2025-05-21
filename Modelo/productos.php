<?php
class Producto {
  private $pdo;

  public function __construct() {
    try {
      $this->pdo = new PDO('mysql:host=localhost;dbname=mi_mvc', 'root', '');
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Error de conexión: " . $e->getMessage());
    }
  }

  public function obtenerTodos() {
    $stmt = $this->pdo->query("SELECT * FROM productos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function obtenerPorId($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function guardar($nombre, $precio) {
    $stmt = $this->pdo->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
    $stmt->execute([$nombre, $precio]);
  }

  public function actualizar($id, $nombre, $precio) {
    $stmt = $this->pdo->prepare("UPDATE productos SET nombre = ?, precio = ? WHERE id = ?");
    $stmt->execute([$nombre, $precio, $id]);
  }

  public function eliminar($id) {
    $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$id]);
  }
}
