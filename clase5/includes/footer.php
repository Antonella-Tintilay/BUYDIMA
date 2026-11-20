<?php

$ruta_base = $ruta_base ?? '.';
?>
<footer class="pie-sitio">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-5">
        <a
          class="d-inline-flex align-items-center gap-2 text-decoration-none"
          href="<?php echo htmlspecialchars($ruta_base); ?>/index.php"
        >
          <img
            src="<?php echo htmlspecialchars($ruta_base); ?>/img/logo-diamante.svg"
            alt=""
            width="34"
            height="34"
          />
          <span class="logo-texto"
            ><span class="parte-dima">BUY</span><span class="parte-buy">DIMA</span></span
          >
        </a>
        <p class="firma-pie mt-2 mb-0">
          Tu tienda de confianza para comprar diamantes y monedas virtuales de forma simple y
          segura.
        </p>
      </div>
      <div class="col-6 col-md-2">
        <h2>Redes sociales</h2>
        <ul>
          <li><a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a></li>
          <li><a href="https://x.com" target="_blank" rel="noopener">X (Twitter)</a></li>
          <li><a href="https://discord.com" target="_blank" rel="noopener">Discord</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-2">
        <h2>Información</h2>
        <ul>
          <li><a href="#">Términos y condiciones</a></li>
          <li><a href="#">Política de privacidad</a></li>
          <li>
            <a href="<?php echo htmlspecialchars($ruta_base); ?>/paginas/metodos-pago.php"
              >Métodos de pago</a
            >
          </li>
        </ul>
      </div>
      <div class="col-md-3">
        <h2>Ayuda</h2>
        <ul>
          <li>
            <a href="<?php echo htmlspecialchars($ruta_base); ?>/paginas/contacto.php"
              >Contacto y soporte</a
            >
          </li>
          <li>
            <a href="<?php echo htmlspecialchars($ruta_base); ?>/paginas/favoritos.php"
              >Mis favoritos</a
            >
          </li>
        </ul>
      </div>
    </div>
    <p class="firma-pie mt-4 mb-0">
      © 2026 <?php echo htmlspecialchars(APP_NAME); ?>. Proyecto académico. Todos los juegos y
      marcas pertenecen a sus respectivos dueños.
    </p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo htmlspecialchars($ruta_base); ?>/js/main.js"></script>
</body>
</html>
