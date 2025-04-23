<?php
header('Content-Type: application/json');

$url = "https://app.invoicing.co/api/v1/products";
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["codigo"]) || !isset($data["descripcion"]) || !isset($data["precio"])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos obligatorios"]);
    exit;
}

$payload = json_encode([
    "product_key" => $data["codigo"],
    "notes" => $data["descripcion"],
    "cost" => floatval($data["precio"])
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-API-Token: 9ycndqKvGDVBzd4FieP7AJuCMsDlVjwo1r43wQDLCOwxHaPpxsTooH5cTIOmu6Mk"
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpcode);
echo $response;
// Última edición por Miguel
?>
