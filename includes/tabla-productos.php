<?php

require_once __DIR__ . '/funciones.php';

$tabla_acciones = $tabla_acciones ?? false;
?>
<div class="table-responsive panel p-3">
  <table class="table align-middle mb-0">
    <caption class="visually-hidden">
      Productos disponibles con juego, precio y stock
    </caption>
    <thead>
      <tr>
        <th scope="col">Producto</th>
        <th scope="col">Juego</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <?php if ($tabla_acciones) : ?>
          <th scope="col">Acciones</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php if ($productos === []) : ?>
        <tr>
          <td colspan="<?php echo $tabla_acciones ? 5 : 4; ?>" class="text-center texto-suave py-4">
            No hay productos disponibles por el momento.
          </td>
        </tr>
      <?php else : ?>
        <?php foreach ($productos as $producto) : ?>
          <tr>
            <th scope="row">
              <?php echo escapar($producto['nombre_producto']); ?>
              <?php if (!empty($producto['descripcion'])) : ?>
                <span class="d-block small texto-suave fw-normal"
                  ><?php echo escapar($producto['descripcion']); ?></span
                >
              <?php endif; ?>
            </th>
            <td><?php echo escapar($producto['juego']); ?></td>
            <td><?php echo escapar(formatear_precio((float) $producto['precio'])); ?></td>
            <td>
              <?php if ((int) $producto['stock'] > 0) : ?>
                <span class="etiqueta-estado completado"
                  ><?php echo (int) $producto['stock']; ?> disponibles</span
                >
              <?php else : ?>
                <span class="etiqueta-estado proceso">Sin stock</span>
              <?php endif; ?>
            </td>
            <?php if ($tabla_acciones) : ?>
              <td>
                <div class="d-flex flex-wrap gap-3">
                  <a
                    class="enlace-recargar"
                    href="editar.php?id_producto=<?php echo (int) $producto['id_producto']; ?>"
                    >Editar<span class="visually-hidden">
                      <?php echo escapar($producto['nombre_producto']); ?></span
                    ></a
                  >
                  <a
                    class="enlace-recargar text-danger"
                    href="eliminar.php?id_producto=<?php echo (int) $producto['id_producto']; ?>"
                    >Eliminar<span class="visually-hidden">
                      <?php echo escapar($producto['nombre_producto']); ?></span
                    ></a
                  >
                </div>
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
