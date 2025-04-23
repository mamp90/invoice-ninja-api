<?php
header('Content-Type: application/json');

$url = "https://martellsheetmetalllc.invoicing.co/api/v1/products";
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["codigo"]) || !isset($data["descripcion"]) || !isset($data["precio"])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos obligatorios"]);
    exit;
}

$payload = json_encode([
    "product_key" => $data["codigo"],
    "notes" => $data["descripcion"],
    "price" => floatval($data["precio"])
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-API-Token: VYFGbZoktBXdtZjnpvYLkQrZsUd456vXYXRTyZWUnEMf5bLaHTwYGbubr04DKUO6"
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo json_encode([
    "codigo_http" => $httpcode,
    "respuesta" => json_decode($response, true),
    "error_curl" => $error
]);
?>
