<?php
$host = "10.0.40.85";
$db   = "tienda_moya";
$user = "u_moya_juan";
$pass = "Sur#26F2hM7";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexion: " . $e->getMessage());
}
?>