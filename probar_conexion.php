<?php
header('Content-Type: application/json');

$url = "https://app.invoicing.co/api/v1/products";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-API-Token: 9ycndqKvGDVBzd4FieP7AJuCMsDlVjwo1r43wQDLCOwxHaPpxsTooH5cTIOmu6Mk"
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

http_response_code($httpcode);
echo $response;
?>