<?php
require_once 'config/db.php';

if (isset($_GET['e'])) {
    $conexion->query("DELETE FROM productos WHERE id=".$_GET['e']);
    header("Location: index.php?m=productos");
    exit();
}

$id = $_GET['m'] ?? null;
$p = $id ? $conexion->query("SELECT * FROM productos WHERE id=$id")->fetch(PDO::FETCH_ASSOC) : ['nombre'=>'','precio'=>'','stock'=>''];

if ($_POST) {
    if ($id) {
        $st = $conexion->prepare("UPDATE productos SET nombre=?, precio=?, stock=? WHERE id=?");
        $st->execute([$_POST['nombre'], $_POST['precio'], $_POST['stock'], $id]);
    } else {
        $st = $conexion->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (?,?,?)");
        $st->execute([$_POST['nombre'], $_POST['precio'], $_POST['stock']]);
    }
    header("Location: index.php?m=productos");
    exit();
}
?>

<h2><?= $id ? 'Editar' : 'Nuevo' ?> Producto</h2>
<form method="POST">
    Nombre: <input name="nombre" value="<?=$p['nombre']?>" required><br><br>
    Precio: <input name="precio" type="number" step="0.01" value="<?=$p['precio']?>" required><br><br>
    Stock: <input name="stock" type="number" value="<?=$p['stock']?>" required><br><br>
    <button type="submit">Guardar</button>
    <a href="index.php?m=productos">Cancelar</a>
</form>