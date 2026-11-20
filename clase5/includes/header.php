<?php

$ruta_base = $ruta_base ?? '.';
$titulo_pagina = $titulo_pagina ?? APP_NAME;
?>
<!doctype html>
<html lang="es" data-bs-theme="dark">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?php echo htmlspecialchars($titulo_pagina); ?></title>
    <meta
      name="description"
      content="<?php echo htmlspecialchars($descripcion_pagina ?? ''); ?>"
    />
    <meta property="og:title" content="<?php echo htmlspecialchars($titulo_pagina); ?>" />
    <meta
      property="og:description"
      content="Diamantes y monedas virtuales al mejor precio, con pago seguro y entrega inmediata."
    />
    <meta property="og:type" content="website" />
    <link
      rel="icon"
      href="<?php echo htmlspecialchars($ruta_base); ?>/img/logo-diamante.svg"
      type="image/svg+xml"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($ruta_base); ?>/css/estilos.css" />
  </head>

  <body data-pagina="<?php echo htmlspecialchars($pagina_activa ?? ''); ?>">
    <a class="salto-contenido btn btn-light" href="#contenido-principal"
      >Saltar al contenido principal</a
    >
