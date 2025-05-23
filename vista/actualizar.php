<?php include_once "layout/header.php"; ?>

<div class="container">
  <h2>Editar Producto</h2>

  <form action="actualizar.php" method="post">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" value="<?= $producto['precio'] ?>" step="0.01" required>

    <input type="submit" value="Actualizar">
  </form>
</div>

<?php include_once "layout/footer.php"; ?>