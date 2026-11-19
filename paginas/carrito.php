<?php

require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Mi carrito | ' . APP_NAME;
$descripcion_pagina = 'Revisá los productos de tu carrito en BUYDIMA antes de continuar con la compra: ajustá cantidades, aplicá códigos de descuento y calculá tu total.';
$pagina_activa = 'carrito';
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
          <h1 class="titulo-pagina">Mi carrito</h1>
          <p class="texto-suave">Revisá tus productos antes de continuar con la compra.</p>
        </header>

        <div class="row g-4 mt-1">
          <!-- Productos del carrito -->
          <section class="col-lg-8" aria-labelledby="titulo-productos">
            <h2 class="visually-hidden" id="titulo-productos">Productos en el carrito</h2>
            <div class="table-responsive panel p-3" id="carrito-vacio" hidden>
              <p class="texto-suave mb-0 text-center py-4">
                Tu carrito está vacío. <a href="juegos.php">Explorá el catálogo</a> para empezar a
                recargar.
              </p>
            </div>
            <div class="table-responsive panel p-3">
              <table class="table align-middle tabla-carrito mb-0">
                <caption class="visually-hidden">
                  Lista de productos en el carrito con cantidad, precio y acciones
                </caption>
                <thead>
                  <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col"><span class="visually-hidden">Acciones</span></th>
                  </tr>
                </thead>
                <tbody id="lista-carrito"></tbody>
              </table>
            </div>
          </section>

          <!-- Resumen de la compra -->
          <aside class="col-lg-4">
            <div class="panel-resumen">
              <h2 class="h5 mb-3">Resumen de compra</h2>
              <div id="filas-resumen" hidden>
                <div class="fila-resumen">
                  <span class="texto-suave">Subtotal</span>
                  <span id="resumen-subtotal">$ 0,00</span>
                </div>
                <div class="fila-resumen">
                  <span class="texto-suave">Descuentos</span>
                  <span id="resumen-descuento">− $ 0,00</span>
                </div>
                <div class="fila-resumen">
                  <span class="texto-suave">Código de descuento</span>
                  <form id="form-codigo" class="d-flex gap-1" novalidate>
                    <div>
                      <label class="visually-hidden" for="codigo-descuento"
                        >Código de descuento</label
                      >
                      <input
                        type="text"
                        class="form-control form-control-sm"
                        id="codigo-descuento"
                        placeholder="Código"
                      />
                      <div class="invalid-feedback">Código inválido. Probá con BUYDIMA10.</div>
                    </div>
                    <button class="btn btn-sm btn-outline-light" type="submit">Aplicar</button>
                  </form>
                </div>
                <hr />
                <div class="fila-resumen">
                  <span>Total</span>
                  <span class="total" id="resumen-total">$ 0,00</span>
                </div>
                <button class="btn boton-compra w-100 mt-3" type="button" id="boton-continuar">
                  Continuar compra <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </button>
                <p class="texto-suave small mt-2 mb-0 text-center">
                  Demostración: no se realiza ningún pago real.
                </p>
              </div>
            </div>
          </aside>
        </div>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

