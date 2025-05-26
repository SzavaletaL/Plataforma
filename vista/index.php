<?php include_once "layout/header.php"; ?>

<div class="container">
  <?php if (isset($_GET['success'])): ?>
    <div class="alert success">
      <?= htmlspecialchars(urldecode($_GET['success'])) ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_GET['error'])): ?>
    <div class="alert error">
      <?= htmlspecialchars(urldecode($_GET['error'])) ?>
    </div>
  <?php endif; ?>

  <div class="header-section">
    <h1 class="title">Gestión de Productos</h1>
    <a href="nuevo.php" class="btn btn-primary">
      <i class="fas fa-plus"></i> Nuevo Producto
    </a>
  </div>

  <div class="table-responsive">
    <table class="product-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th class="text-right">Precio (S/.)</th>
          <th class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($productos)): ?>
          <?php foreach ($productos as $producto): ?>
            <tr>
              <td><?= htmlspecialchars($producto['id']) ?></td>
              <td><?= htmlspecialchars($producto['nombre']) ?></td>
              <td class="text-right">
                S/ <?= number_format($producto['precio'], 2) ?>
              </td>
              <td class="action-buttons">
                <a href="editar.php?id=<?= $producto['id'] ?>"
                  class="btn btn-edit"
                  title="Editar producto">
                  <i class="fas fa-edit"></i>
                </a>

                <form method="POST" action="eliminar.php" class="d-inline">
                  <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                  <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                  <button type="submit"
                    class="btn btn-danger"
                    onclick="return confirm('¿Confirmar eliminación del producto <?= htmlspecialchars(addslashes($producto['nombre'])) ?>?')">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center">
              <div class="empty-state">
                <i class="fas fa-box-open fa-2x"></i>
                <p>No se encontraron productos registrados</p>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include_once "layout/footer.php"; ?>