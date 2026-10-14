<?php
require_once 'config/db.php';
require_once 'class/nodo.php';
require_once 'class/ListaDoblementeEnlazada.php';

$m = $_GET['m'] ?? 'clientes';
$o = $_GET['o'] ?? 'id';

if ($m == 'productos') {
    $q = "SELECT * FROM productos";
} elseif ($m == 'pedidos') {
    $q = "SELECT * FROM pedidos";
} else {
    $q = "SELECT * FROM clientes";
}

$res = $conexion->query($q)->fetchAll(PDO::FETCH_ASSOC);

$l = new ListaDoblementeEnlazada();
foreach ($res as $r) $l->insertar($r);
if ($res) $l->ordenarBurbuja($o);
$data = $l->obtenerArreglo();
?>

<a href="index.php?m=clientes">Clientes</a> | 
<a href="index.php?m=productos">Productos</a> | 
<a href="index.php?m=pedidos">Pedidos</a> | 
<a href="<?=$m?>.php">Nuevo</a>
<hr>
<table border="1">
<tr>
    <?php if ($data): foreach (array_keys($data[0]) as $k): ?>
        <th><a href="index.php?m=<?=$m?>&o=<?=$k?>"><?=$k?></a></th>
    <?php endforeach; ?><th>Acción</th><?php endif; ?>
</tr>
<?php foreach ($data as $d): ?>
<tr>
    <?php foreach ($d as $v): ?><td><?=$v?></td><?php endforeach; ?>
    <td>
        <a href="<?=$m?>.php?m=<?=reset($d)?>">Editar</a> | 
        <a href="<?=$m?>.php?e=<?=reset($d)?>">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>
</table>