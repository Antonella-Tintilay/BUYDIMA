<?php
require_once __DIR__ . '/../config/auth_guard.php';
requiere_login();
require_once __DIR__ . '/../config/env.php';

$titulo_pagina = 'Historial de compras | ' . APP_NAME;
$descripcion_pagina = 'Revisá todos tus pedidos de BUYDIMA y consultá el estado de cada recarga: fechas, productos, importes y seguimiento de tus compras.';
$pagina_activa = 'historial';
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
          <h1 class="titulo-pagina">Historial de compras</h1>
          <p class="texto-suave">
            Revisá todos tus pedidos y consultá el estado de cada operación.
          </p>
        </header>

        <!-- Resumen de la actividad -->
        <section class="row row-cols-1 row-cols-md-3 g-3 mt-1" aria-labelledby="titulo-resumen">
          <h2 class="visually-hidden" id="titulo-resumen">Resumen de la actividad</h2>
          <div class="col">
            <article class="tarjeta-dato">
              <small>Compras totales</small><br />
              <strong>2</strong>
            </article>
          </div>
          <div class="col">
            <article class="tarjeta-dato">
              <small>Total invertido</small><br />
              <strong>$ 2.770,92</strong>
            </article>
          </div>
          <div class="col">
            <article class="tarjeta-dato">
              <small>Recargas completadas</small><br />
              <strong>2</strong>
            </article>
          </div>
        </section>

        <!-- Listado de pedidos -->
        <section class="mt-4" aria-labelledby="titulo-pedidos">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <h2 class="h4 mb-0" id="titulo-pedidos">Mis pedidos</h2>
            <div class="d-flex align-items-center gap-2">
              <label class="form-label mb-0" for="filtro-estado">Filtrar por estado</label>
              <select class="form-select form-select-sm w-auto" id="filtro-estado">
                <option value="todos" selected>Todos</option>
                <option value="completado">Completado</option>
                <option value="proceso">En proceso</option>
              </select>
            </div>
          </div>

          <div class="table-responsive panel p-3">
            <table class="table align-middle mb-0" id="tabla-pedidos">
              <caption class="visually-hidden">
                Listado de pedidos con número, fecha, producto, importe y estado
              </caption>
              <thead>
                <tr>
                  <th scope="col">N.º de pedido</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Videojuego</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Importe</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr data-estado="completado">
                  <th scope="row">BYD-000241</th>
                  <td>12/11/2026</td>
                  <td>Free Fire</td>
                  <td>560 diamantes</td>
                  <td>$ 1.647,96</td>
                  <td><span class="etiqueta-estado completado">Completado</span></td>
                  <td>
                    <a href="#" class="enlace-recargar"
                      >Ver detalle <span class="visually-hidden">del pedido BYD-000241</span></a
                    >
                  </td>
                </tr>
                <tr data-estado="completado">
                  <th scope="row">BYD-000238</th>
                  <td>05/11/2026</td>
                  <td>Roblox</td>
                  <td>1700 Robux</td>
                  <td>$ 1.922,96</td>
                  <td><span class="etiqueta-estado completado">Completado</span></td>
                  <td>
                    <a href="#" class="enlace-recargar"
                      >Ver detalle <span class="visually-hidden">del pedido BYD-000238</span></a
                    >
                  </td>
                </tr>
                <tr data-estado="proceso">
                  <th scope="row">BYD-000245</th>
                  <td>14/11/2026</td>
                  <td>Mobile Legends</td>
                  <td>Pase semanal</td>
                  <td>$ 1.200,00</td>
                  <td><span class="etiqueta-estado proceso">En proceso</span></td>
                  <td>
                    <a href="#" class="enlace-recargar"
                      >Ver detalle <span class="visually-hidden">del pedido BYD-000245</span></a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p class="texto-suave small mt-2 mb-0">
            Datos de demostración para el proyecto académico.
          </p>
        </section>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

