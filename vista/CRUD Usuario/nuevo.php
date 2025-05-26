<?php
require_once("layout/header.php");
?>

<div class="container">
    <h1 class="text-center">NUEVO PRODUCTO</h1>
    <form action="index.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre del producto" name="nombre" required>
        </div>

        <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Precio (ej. 19.99)" name="precio" required>
        </div>

        <div class="form-actions">
            <input type="submit" class="btn btn-primary" value="GUARDAR">
            <a href="index.php" class="btn btn-cancelar">Cancelar</a>
            <input type="hidden" name="m" value="guardar">
        </div>
    </form>
</div>

<?php
require_once("layout/footer.php");
?>