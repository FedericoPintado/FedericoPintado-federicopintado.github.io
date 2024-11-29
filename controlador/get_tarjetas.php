<?php
// Conexión a la base de datos (esto es solo un ejemplo)
require_once '../modelo/tarjeta.php';
$tarjeta = new Tarjeta();
$tarjetas = $tarjeta->obtenerTarjetas(); // Suponiendo que esta función devuelve un array de tarjetas

// Asegúrate de que los encabezados estén establecidos correctamente para JSON
header('Content-Type: application/json');

// Devuelve las tarjetas en formato JSON
echo json_encode($tarjetas);
?>
