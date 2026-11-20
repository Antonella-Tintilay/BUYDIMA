<?php

$ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($ruta, '/.env')) {
    http_response_code(404);
    exit;
}

return false;