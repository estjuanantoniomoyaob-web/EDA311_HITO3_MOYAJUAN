<?php
require_once 'config/db.php';

if (isset($_POST['g'])) {
    $conexion->prepare("INSERT INTO pedidos VALUES (null,?,?,?,NOW())")->execute([$_POST['c'], $_POST['p'], $_POST['k']]);
    header("Location: pedidos.php");
}
if (isset($_GET['e'])) {
    $conexion->prepare("DELETE FROM pedidos WHERE id=?")->execute([$_GET['e']]);
    header("Location: pedidos.php");
}
$cli = $conexion->query("SELECT * FROM clientes")->fetchAll();
$pro = $conexion->query("SELECT * FROM productos")->fetchAll();
?>
<a href="index.php">Volver</a>
<form method="POST">
    Cliente: <select name="c"><?php foreach($cli as $x): ?><option value="<?=$x['id']?>"><?=$x['nombre']?></option><?php endforeach; ?></select><br>
    Producto: <select name="p"><?php foreach($pro as $x): ?><option value="<?=$x['id']?>"><?=$x['nombre']?></option><?php endforeach; ?></select><br>
    Cantidad: <input name="k"><br>
    <button name="g">Guardar</button>
</form>