<?php
$ruta_base = $ruta_base ?? '.';
$pagina_activa = $pagina_activa ?? '';

// Elementos del menú: si $pagina_activa coincide con el 'id', el enlace se marca activo.
$items_menu = [
  ['id' => 'inicio', 'href' => $ruta_base . '/index.php', 'icono' => 'bi-house', 'texto' => 'Inicio'],
  ['id' => 'juegos', 'href' => $ruta_base . '/paginas/juegos.php', 'icono' => 'bi-controller', 'texto' => 'Juegos'],
  [
    'id' => 'ofertas',
    'href' => $ruta_base . '/paginas/ofertas.php',
    'icono' => 'bi-percent',
    'texto' => 'Ofertas especiales',
  ],
  [
    'id' => 'metodos-pago',
    'href' => $ruta_base . '/paginas/metodos-pago.php',
    'icono' => 'bi-credit-card-2-front',
    'texto' => 'Métodos de pago',
  ],
  [
    'id' => 'favoritos',
    'href' => $ruta_base . '/paginas/favoritos.php',
    'icono' => 'bi-heart',
    'texto' => 'Mis favoritos',
  ],
  [
    'id' => 'contacto',
    'href' => $ruta_base . '/paginas/contacto.php',
    'icono' => 'bi-headset',
    'texto' => 'Contacto y soporte',
  ],
  ['id' => 'perfil', 'href' => $ruta_base . '/paginas/perfil.php', 'icono' => 'bi-person', 'texto' => 'Mi cuenta'],
];
?>
<header class="encabezado-sitio">
  <nav class="navbar navbar-expand-md py-3" aria-label="Navegación principal">
    <div class="container d-flex align-items-center justify-content-between gap-3">
      <a
        class="navbar-brand d-flex align-items-center gap-2 m-0"
        href="<?php echo htmlspecialchars($ruta_base); ?>/index.php"
      >
        <img
          src="<?php echo htmlspecialchars($ruta_base); ?>/img/logo-diamante.svg"
          alt="Logo de BUYDIMA"
          width="38"
          height="38"
        />
        <span class="logo-texto"
          ><span class="parte-buy">BUY</span><span class="parte-dima">DIMA</span></span
        >
      </a>

      <form
        role="search"
        action="<?php echo htmlspecialchars($ruta_base); ?>/paginas/juegos.php"
        method="get"
        class="buscador"
        novalidate
      >
        <div>
          <label class="visually-hidden" for="buscador-encabezado">Buscar juego</label>
          <input
            class="form-control"
            type="search"
            name="q"
            id="buscador-encabezado"
            placeholder="Buscar juego..."
            autocomplete="off"
          />
          <div class="invalid-feedback">Escribí al menos 2 caracteres para buscar.</div>
        </div>
        <button class="boton-buscar" type="submit" aria-label="Buscar">
          <i class="bi bi-search" aria-hidden="true"></i>
        </button>
      </form>

      <div class="d-flex align-items-center gap-1">
        <a
          class="boton-icono"
          href="<?php echo htmlspecialchars($ruta_base); ?>/paginas/perfil.php"
          aria-label="Mi cuenta"
        >
          <i class="bi bi-person" aria-hidden="true"></i>
        </a>
        <a
          class="boton-icono position-relative"
          href="<?php echo htmlspecialchars($ruta_base); ?>/paginas/carrito.php"
          aria-label="Ver carrito de compras"
        >
          <i class="bi bi-cart" aria-hidden="true"></i>
          <span class="contador-carrito" id="contador-carrito" hidden>0</span>
        </a>
        <button
          class="boton-menu"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#menu-principal"
          aria-controls="menu-principal"
          aria-label="Abrir menú principal"
        >
          <i class="bi bi-list" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </nav>

  <!-- Menú hamburguesa (se abre desde la derecha, como en el mockup 9) -->
  <div
    class="offcanvas offcanvas-end menu-lateral"
    tabindex="-1"
    id="menu-principal"
    aria-labelledby="titulo-menu"
  >
    <div class="offcanvas-header">
      <h2 class="offcanvas-title titulo-menu" id="titulo-menu">Menú principal</h2>
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="offcanvas"
        aria-label="Cerrar menú"
      ></button>
    </div>
    <div class="offcanvas-body">
      <nav aria-label="Menú del sitio">
        <ul class="lista-menu">
          <?php foreach ($items_menu as $item) : ?>
            <li>
              <a
                href="<?php echo htmlspecialchars($item['href']); ?>"
                <?php if ($item['id'] === $pagina_activa) : ?>class="activo" aria-current="page"<?php endif; ?>
                ><i
                  class="bi <?php echo htmlspecialchars($item['icono']); ?> icono-menu"
                  aria-hidden="true"
                ></i>
                <?php echo htmlspecialchars($item['texto']); ?>
                <i class="bi bi-chevron-right" aria-hidden="true"></i
              ></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </div>
  </div>
</header>
