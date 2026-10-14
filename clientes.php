<?php
require_once 'db.php';

if (isset($_POST['g'])) {
    $conexion->prepare("INSERT INTO clientes VALUES (null,?,?,?)")->execute([$_POST['n'], $_POST['e'], $_POST['t']]);
    header("Location: clientes.php");
}
if (isset($_GET['e'])) {
    $conexion->prepare("DELETE FROM clientes WHERE id=?")->execute([$_GET['e']]);
    header("Location: clientes.php");
}
if (isset($_POST['a'])) {
    $conexion->prepare("UPDATE clientes SET nombre=?, email=?, telefono=? WHERE id=?")->execute([$_POST['n'], $_POST['e'], $_POST['t'], $_POST['i']]);
    header("Location: clientes.php");
}
$c = isset($_GET['m']) ? $conexion->query("SELECT * FROM clientes WHERE id=".$_GET['m'])->fetch() : null;
?>
<a href="index.php">Volver</a>
<form method="POST">
    <input type="hidden" name="i" value="<?= $c['id']??'' ?>">
    Nombre: <input name="n" value="<?= $c['nombre']??'' ?>"><br>
    Email: <input name="e" value="<?= $c['email']??'' ?>"><br>
    Teléfono: <input name="t" value="<?= $c['telefono']??'' ?>"><br>
    <button name="<?= $c ? 'a' : 'g' ?>"><?= $c ? 'Actualizar' : 'Guardar' ?></button>
</form>