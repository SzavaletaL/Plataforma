<?php include_once "layout/header.php"; ?>

<div class="container">
  <h1>Lista de Productos</h1>

  <a href="nuevo.php" class="btn btn-agregar">Agregar Producto</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio (S/.)</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($productos as $producto): ?>
        <tr>
          <td><?= $producto['id'] ?></td>
          <td><?= htmlspecialchars($producto['nombre']) ?></td>
          <td><?= number_format($producto['precio'], 2) ?></td>
          <td>
            <a href="editar.php?id=<?= $producto['id'] ?>" class="btn btn-editar">Editar</a>
            <a href="eliminar.php?id=<?= $producto['id'] ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include_once "layout/footer.php"; ?>
