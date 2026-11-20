<?php

require_once __DIR__ . '/../config/env.php';

$juegos = require __DIR__ . '/../config/catalogo.php';

$categorias = [
  'todos' => 'Todos',
  'accion' => 'Acción',
  'aventura' => 'Aventura',
  'battle-royale' => 'Battle Royale',
  'rpg' => 'RPG',
  'deportes' => 'Deportes',
];

function escapar(?string $texto): string
{
  return htmlspecialchars($texto ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function valor_get(string $clave): string
{
  $valor = $_GET[$clave] ?? '';

  return is_string($valor) ? trim($valor) : '';
}

$q = valor_get('q');
$categoria = valor_get('categoria');

if (!array_key_exists($categoria, $categorias)) {
  $categoria = 'todos';
}

$errores_busqueda = [];
$longitud_q = mb_strlen($q, 'UTF-8');

if ($q !== '' && $longitud_q < 2) {
  $errores_busqueda[] = 'La búsqueda no se aplicó: ingresá al menos 2 caracteres.';
} elseif ($longitud_q > 50) {
  $errores_busqueda[] = 'La búsqueda no se aplicó: el texto no puede superar los 50 caracteres.';
}

$texto_busqueda = $errores_busqueda === [] ? mb_strtolower($q, 'UTF-8') : '';

$resultados = array_values(
  array_filter($juegos, static function (array $juego) use ($categoria, $texto_busqueda): bool {
    $coincide_categoria = $categoria === 'todos' || $juego['categoria'] === $categoria;
    $coincide_texto =
      $texto_busqueda === '' ||
      str_contains(mb_strtolower($juego['nombre'], 'UTF-8'), $texto_busqueda);

    return $coincide_categoria && $coincide_texto;
  })
);

$cantidad = count($resultados);

$titulo_pagina = 'Todos los juegos | Catálogo ' . APP_NAME;
$descripcion_pagina = 'Explorá el catálogo completo de BUYDIMA: diamantes y monedas de Free Fire, Mobile Legends, Roblox, Genshin Impact y Battlegrounds, filtrados por categoría.';
$pagina_activa = 'juegos';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main id="contenido-principal">
      <div class="container my-4">
        <button class="boton-volver" type="button" data-volver-atras>
          <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver
        </button>

        <header>
          <p class="etiqueta-catalogo">Catálogo BUYDIMA</p>
          <h1 class="titulo-pagina">Todos los juegos</h1>
          <p class="texto-suave">Encontrá tu juego favorito y recargá saldo en pocos minutos.</p>
        </header>

        <form class="row g-2 mt-3" role="search" method="get" action="juegos.php">
          <div class="col-12">
            <label class="visually-hidden" for="filtro-busqueda">Buscar juego por nombre</label>
            <div class="position-relative">
              <i
                class="bi bi-search position-absolute top-50 translate-middle-y ms-3 texto-suave"
                aria-hidden="true"
              ></i>
              <input
                type="search"
                class="form-control ps-5 py-2<?php echo $errores_busqueda !== [] ? ' is-invalid' : ''; ?>"
                id="filtro-busqueda"
                name="q"
                value="<?php echo escapar($q); ?>"
                maxlength="50"
                placeholder="Buscar por nombre de juego..."
                autocomplete="off"
              />
            </div>
          </div>
        </form>

        <?php if ($errores_busqueda !== []): ?>
          <div class="alert alert-warning mt-3" role="alert">
            <ul class="mb-0">
              <?php foreach ($errores_busqueda as $error): ?>
                <li><?php echo escapar($error); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <nav class="d-flex flex-wrap gap-2 mt-3" aria-label="Filtrar catálogo por categoría">
          <?php foreach ($categorias as $clave => $etiqueta): ?>
            <?php
            $url_categoria = 'juegos.php?' . http_build_query(['categoria' => $clave]);
            ?>
            <a
              class="chip-filtro<?php echo $clave === $categoria ? ' activo' : ''; ?>"
              href="<?php echo escapar($url_categoria); ?>"
              <?php echo $clave === $categoria ? 'aria-current="page"' : ''; ?>
            >
              <?php echo escapar($etiqueta); ?>
            </a>
          <?php endforeach; ?>
        </nav>

        <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
          <h2 class="h4 mb-0" id="titulo-catalogo">Explorá el catálogo</h2>
          <button class="btn btn-outline-light btn-sm" type="button" id="boton-populares">
            Más populares <i class="bi bi-chevron-right" aria-hidden="true"></i>
          </button>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3" id="grilla-juegos">
          <?php foreach ($resultados as $juego): ?>
            <div class="col">
              <article
                class="tarjeta-juego"
                data-categoria="<?php echo escapar($juego['categoria']); ?>"
                data-nombre="<?php echo escapar($juego['nombre']); ?>"
                data-popularidad="<?php echo escapar((string) $juego['popularidad']); ?>"
              >
                <img
                  src="../img/<?php echo escapar($juego['imagen']); ?>"
                  alt="<?php echo escapar($juego['alt']); ?>"
                />
                <div class="cuerpo">
                  <h3 class="h6"><?php echo escapar($juego['nombre']); ?></h3>
                  <a class="enlace-recargar" href="<?php echo escapar($juego['enlace']); ?>"
                    >Recargar <i class="bi bi-chevron-right" aria-hidden="true"></i
                    ><span class="visually-hidden"><?php echo escapar($juego['moneda']); ?></span></a
                  >
                </div>
              </article>
            </div>
          <?php endforeach; ?>
        </div>

        <p class="texto-suave mt-4 mb-0" id="cantidad-resultados" role="status">
          <?php echo $cantidad === 1 ? '1 juego encontrado' : $cantidad . ' juegos encontrados'; ?><?php if ($q !== '' && $errores_busqueda === []): ?> para «<?php echo escapar($q); ?>»<?php endif; ?>.
        </p>

        <?php if ($cantidad === 0): ?>
          <p class="texto-suave mt-2 mb-0" id="sin-resultados">
            No se encontraron juegos con ese criterio. Probá con otra búsqueda o categoría.
          </p>
        <?php endif; ?>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
