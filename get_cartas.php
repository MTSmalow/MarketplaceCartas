<?php
// get_cartas.php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require 'database.php';

$db = new Database();
$cartas = $db->getCartas();

echo json_encode(["cartas" => $cartas]);
?>
