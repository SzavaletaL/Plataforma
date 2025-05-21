<?php
require_once("layouts/header.php");
?>

<div class="container">
    <h1 class="text-center">EDITAR PRODUCTO</h1>
    <form action="index.php" method="POST">
        <?php foreach($dato as $value): ?>
            <?php foreach($value as $v): ?>
                <div class="form-group">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" 
                           value="<?php echo htmlspecialchars($v['nombre']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Precio:</label>
                    <input type="number" step="0.01" class="form-control" name="precio" 
                           value="<?php echo htmlspecialchars($v['precio']); ?>" required>
                </div>
                
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($v['id']); ?>">
                
                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="btn" value="ACTUALIZAR">
                    <a href="index.php" class="btn btn-cancelar">CANCELAR</a>
                    <input type="hidden" name="m" value="actualizar">
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </form>
</div>

<?php
require_once("layouts/footer.php");
?>