<?php

require_once __DIR__ . '/../config/env.php';

const MOTIVOS_CONTACTO = [
  'Problema con una recarga',
  'Pago o facturación',
  'Consulta sobre el catálogo',
  'Otro motivo',
];

function escapar(?string $texto): string
{
  return htmlspecialchars($texto ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function valor_post(string $clave): string
{
  $valor = $_POST[$clave] ?? '';

  return is_string($valor) ? trim($valor) : '';
}

$errores = [];
$nombre = '';
$correo = '';
$motivo = '';
$mensaje = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
  $nombre = valor_post('nombre');
  $correo = valor_post('correo');
  $motivo = valor_post('motivo');
  $mensaje = valor_post('mensaje');

  if ($nombre === '') {
    $errores['nombre'] = 'Ingresá tu nombre y apellido.';
  }

  if ($correo === '') {
    $errores['correo'] = 'Ingresá tu correo electrónico.';
  } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores['correo'] = 'Ingresá un correo electrónico válido.';
  }

  if ($motivo === '') {
    $errores['motivo'] = 'Seleccioná un motivo de consulta.';
  } elseif (!in_array($motivo, MOTIVOS_CONTACTO, true)) {
    $errores['motivo'] = 'Seleccioná un motivo de la lista.';
  }

  if ($mensaje === '') {
    $errores['mensaje'] = 'Escribí tu consulta.';
  } elseif (mb_strlen($mensaje, 'UTF-8') < 10) {
    $errores['mensaje'] = 'La consulta debe tener al menos 10 caracteres.';
  }

  if ($errores === []) {
    header('Location: contacto.php?enviado=1');
    exit;
  }
}

$enviado = ($_GET['enviado'] ?? '') === '1';

$titulo_pagina = 'Contacto y soporte | ' . APP_NAME;
$descripcion_pagina = 'Estamos para ayudarte antes, durante y después de tu compra. Escribí tu consulta al equipo de soporte de BUYDIMA y te responderemos a la brevedad.';
$pagina_activa = 'contacto';
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
          <h1 class="titulo-pagina">Contacto y soporte</h1>
          <p class="texto-suave">Estamos para ayudarte antes, durante y después de tu compra.</p>
        </header>

        <div class="row g-4 mt-1">

          <section class="col-lg-7">
            <h2 class="h4 mb-3">Escribí tu consulta</h2>
            <form
              id="form-contacto"
              class="panel p-4"
              method="post"
              action="contacto.php"
              novalidate
            >
              <?php if ($enviado): ?>
                <div class="alert alert-success" role="status">
                  ¡Consulta recibida! Te responderemos a la brevedad.
                </div>
              <?php elseif ($errores !== []): ?>
                <div class="alert alert-danger" role="alert">
                  <p class="mb-2"><strong>Revisá los datos del formulario:</strong></p>
                  <ul class="mb-0">
                    <?php foreach ($errores as $error): ?>
                      <li><?php echo escapar($error); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
              <div class="mb-3">
                <label class="form-label" for="campo-nombre">Nombre y apellido</label>
                <input
                  type="text"
                  class="form-control<?php echo isset($errores['nombre']) ? ' is-invalid' : ''; ?>"
                  id="campo-nombre"
                  name="nombre"
                  value="<?php echo escapar($nombre); ?>"
                  required
                  autocomplete="name"
                />
                <div
                  class="invalid-feedback<?php echo isset($errores['nombre']) ? ' d-block' : ''; ?>"
                >
                  <?php echo escapar($errores['nombre'] ?? 'Ingresá tu nombre y apellido.'); ?>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="campo-correo">Correo electrónico</label>
                <input
                  type="email"
                  class="form-control<?php echo isset($errores['correo']) ? ' is-invalid' : ''; ?>"
                  id="campo-correo"
                  name="correo"
                  value="<?php echo escapar($correo); ?>"
                  required
                  autocomplete="email"
                />
                <div
                  class="invalid-feedback<?php echo isset($errores['correo']) ? ' d-block' : ''; ?>"
                >
                  <?php echo escapar($errores['correo'] ?? 'Ingresá un correo electrónico válido.'); ?>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="campo-motivo">Motivo de consulta</label>
                <select
                  class="form-select<?php echo isset($errores['motivo']) ? ' is-invalid' : ''; ?>"
                  id="campo-motivo"
                  name="motivo"
                  required
                >
                  <option value="">Seleccioná un motivo...</option>
                  <?php foreach (MOTIVOS_CONTACTO as $opcion): ?>
                    <option
                      value="<?php echo escapar($opcion); ?>"
                      <?php echo $motivo === $opcion ? 'selected' : ''; ?>
                    >
                      <?php echo escapar($opcion); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div
                  class="invalid-feedback<?php echo isset($errores['motivo']) ? ' d-block' : ''; ?>"
                >
                  <?php echo escapar($errores['motivo'] ?? 'Seleccioná un motivo de consulta.'); ?>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="campo-mensaje">Mensaje</label>
                <textarea
                  class="form-control<?php echo isset($errores['mensaje']) ? ' is-invalid' : ''; ?>"
                  id="campo-mensaje"
                  name="mensaje"
                  rows="4"
                  required
                ><?php echo escapar($mensaje); ?></textarea>
                <div
                  class="invalid-feedback<?php echo isset($errores['mensaje']) ? ' d-block' : ''; ?>"
                >
                  <?php echo escapar($errores['mensaje'] ?? 'Escribí tu consulta (mínimo 10 caracteres).'); ?>
                </div>
              </div>
              <button class="btn boton-compra w-100" type="submit">Enviar consulta</button>
              <p class="texto-suave small mt-3 mb-0">
                Esta es una demostración académica: los datos se procesan en el servidor, pero no
                se envía un correo real.
              </p>
            </form>
          </section>

          <aside class="col-lg-5">
            <h2 class="h4 mb-3">¿En qué podemos ayudarte?</h2>
            <p class="texto-suave">
              Respondemos consultas sobre recargas pendientes, problemas de pago, monedas no
              acreditadas y cualquier duda sobre el funcionamiento del sitio.
            </p>
            <ul class="list-unstyled d-grid gap-3">
              <li class="tarjeta-metodo d-flex align-items-center gap-3">
                <i class="bi bi-clock-history" aria-hidden="true"></i>
                <span
                  ><strong>Horario de atención</strong><br /><span class="texto-suave small"
                    >Lunes a domingo, de 9 a 23 h.</span
                  ></span
                >
              </li>
              <li class="tarjeta-metodo d-flex align-items-center gap-3">
                <i class="bi bi-envelope" aria-hidden="true"></i>
                <span
                  ><strong>Correo</strong><br /><span class="texto-suave small"
                    ><?php echo htmlspecialchars(SUPPORT_EMAIL); ?></span
                  ></span
                >
              </li>
              <li class="tarjeta-metodo d-flex align-items-center gap-3">
                <i class="bi bi-chat-dots" aria-hidden="true"></i>
                <span
                  ><strong>Respuesta promedio</strong><br /><span class="texto-suave small"
                    >Menos de 24 horas hábiles.</span
                  ></span
                >
              </li>
            </ul>
          </aside>
        </div>
      </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
