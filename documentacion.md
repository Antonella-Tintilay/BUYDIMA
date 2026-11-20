# Documentación técnica — BUYDIMA

Documento técnico que reúne las decisiones de diseño, estructura, tecnologías, funcionamiento y correcciones realizadas durante el desarrollo de BUYDIMA.

---

## 1. Tecnologías utilizadas

| Tecnología | Uso en el proyecto |
|---|---|
| HTML5 | Estructura semántica de las páginas. |
| CSS3 | Diseño visual y estilos personalizados. |
| Bootstrap 5 | Componentes y diseño adaptable. |
| Bootstrap Icons | Iconografía de la interfaz. |
| JavaScript | Interacciones del sitio, carrito, favoritos y validaciones del lado del cliente. |
| PHP 8.x | Procesamiento del lado del servidor y generación dinámica de contenido. |
| MySQL | Persistencia de datos. |
| PDO | Conexión y consultas preparadas a la base de datos. |
| Sesiones PHP | Autenticación y control de acceso. |
| Git y GitHub | Control de versiones y trabajo colaborativo. |
| XAMPP | Entorno local de desarrollo. |

El proyecto cuenta con persistencia de datos mediante MySQL. La autenticación de usuarios se implementa del lado del servidor mediante sesiones PHP, con registro, inicio y cierre de sesión, almacenamiento seguro de contraseñas y control de acceso según el rol del usuario.

El carrito y los favoritos continúan utilizando `localStorage` y no representan un sistema completo de procesamiento de pagos.

---

## 2. Estructura del proyecto

La estructura principal se organiza de la siguiente manera:

```text
BUYDIMA/
├── index.php
├── config/
│   ├── env.php
│   ├── conexion.php
│   ├── productos.php
│   ├── sesion.php
│   └── auth_guard.php
├── includes/
│   ├── header.php
│   ├── nav.php
│   ├── footer.php
│   ├── funciones.php
│   └── tabla-productos.php
├── admin/
│   ├── index.php
│   ├── crear.php
│   ├── editar.php
│   └── eliminar.php
├── paginas/
│   ├── registro.php
│   ├── login.php
│   ├── logout.php
│   ├── perfil.php
│   ├── historial-compras.php
│   ├── juegos.php
│   ├── ofertas.php
│   ├── metodos-pago.php
│   ├── contacto.php
│   ├── carrito.php
│   ├── favoritos.php
│   ├── detalle-juego.php
│   └── productos.php
├── css/
│   └── estilos.css
├── js/
│   └── main.js
├── img/
├── mockups/
├── capturas/
├── tp6/
├── .env
├── .env.example
├── .htaccess
├── router.php
├── .gitignore
├── README.md
└── documentacion.md
```

### Organización de carpetas

- `config/`: configuración del entorno, conexión a la base de datos, consultas de productos, sesiones y controles de acceso.
- `includes/`: componentes reutilizables de la interfaz y funciones auxiliares.
- `admin/`: operaciones administrativas para gestionar productos.
- `paginas/`: páginas públicas y secciones que requieren autenticación.
- `css/`: hojas de estilo.
- `js/`: funcionalidades e interacciones del lado del cliente.
- `img/`: imágenes utilizadas en el sitio.
- `mockups/`: diseños de referencia.
- `capturas/`: capturas del desarrollo.
- `tp6/`: scripts SQL correspondientes al diseño de la base de datos.

---

## 3. Modularización con includes

Se utilizaron archivos reutilizables para evitar repetir código en todas las páginas.

### `includes/header.php`

Contiene la estructura inicial del documento HTML, metadatos, título dinámico, enlaces a hojas de estilo y apertura del contenido.

### `includes/nav.php`

Contiene la navegación principal, el buscador, los accesos a las secciones y el menú hamburguesa.

También adapta las opciones según el estado de autenticación y el rol del usuario:

- Si no inició sesión, muestra las opciones para ingresar o registrarse.
- Si inició sesión, muestra el acceso a su cuenta y el cierre de sesión.
- Si tiene rol de administrador, también muestra el acceso al panel administrativo.

### `includes/footer.php`

Contiene el pie de página y la incorporación de los scripts necesarios.

### `includes/funciones.php`

Agrupa funciones auxiliares utilizadas en distintas partes del proyecto.

### `includes/tabla-productos.php`

Permite reutilizar la presentación de los productos en el panel administrativo.

Los archivos se incorporan mediante `require_once`, evitando inclusiones repetidas.

Se utiliza `__DIR__` para construir rutas a partir de la ubicación real de cada archivo.

---

## 4. Títulos dinámicos y navegación

Cada página puede definir variables antes de incorporar los componentes compartidos:

```php
$titulo_pagina = 'Mi carrito | ' . APP_NAME;
$pagina_activa = 'carrito';
$ruta_base = '..';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
```

El título se genera dinámicamente desde PHP y la navegación identifica la sección activa.

La variable `$ruta_base` permite resolver correctamente los enlaces desde páginas ubicadas en distintos niveles de carpetas.

---

## 5. Variables de entorno

La configuración del proyecto se centraliza mediante variables de entorno almacenadas en `.env`.

El archivo `config/env.php` se encarga de cargar esas variables para que puedan utilizarse en el resto de la aplicación.

Entre las variables utilizadas se encuentran:

- `APP_NAME`: nombre de la aplicación.
- `SUPPORT_EMAIL`: correo de soporte.
- `APP_ENV`: entorno de ejecución.
- `DB_HOST`: servidor de base de datos.
- `DB_PORT`: puerto de conexión.
- `DB_NAME`: nombre de la base de datos.
- `DB_USER`: usuario de MySQL.
- `DB_PASSWORD`: contraseña de MySQL.

El archivo `.env.example` funciona como plantilla de configuración, sin incluir credenciales reales.

El archivo `.env` se encuentra excluido del control de versiones mediante `.gitignore`, ya que contiene información privada.

---

## 6. Conexión a la base de datos mediante PDO

La conexión se centraliza en `config/conexion.php`.

Se utiliza PDO para establecer la comunicación entre PHP y MySQL.

La configuración contempla:

- Juego de caracteres `utf8mb4`.
- Manejo de errores mediante excepciones.
- Resultados obtenidos como arreglos asociativos.
- Consultas preparadas nativas.

La función de conexión permite reutilizar la misma configuración en las distintas operaciones del sistema.

---

## 7. Base de datos y modelo relacional

La base de datos utilizada se denomina `buydima`.

El esquema se diseñó considerando las entidades necesarias para una tienda de productos digitales.

Las tablas principales son:

| Tabla | Función |
|---|---|
| `roles` | Almacena los tipos de usuario del sistema. |
| `usuarios` | Guarda los datos de las cuentas registradas. |
| `juegos` | Almacena los videojuegos disponibles. |
| `productos` | Contiene los paquetes y productos ofrecidos. |
| `estados_pedido` | Define los posibles estados de una compra. |
| `pedidos` | Registra los pedidos realizados. |
| `detalle_pedido` | Almacena los productos y cantidades asociados a cada pedido. |

Las relaciones se implementan mediante claves primarias y foráneas para mantener la integridad referencial.

Los scripts de creación y consultas se encuentran en la carpeta `tp6/`.

---

## 8. Persistencia y operaciones CRUD

Las operaciones relacionadas con productos se organizan en `config/productos.php`.

El sistema permite:

- **Crear:** registrar nuevos productos.
- **Leer:** obtener los productos almacenados.
- **Actualizar:** modificar la información de un producto.
- **Eliminar:** eliminar productos que no tengan relaciones que impidan la operación.

Las consultas utilizan sentencias preparadas de PDO.

Los formularios administrativos realizan validaciones del lado del servidor antes de ejecutar las operaciones.

Las restricciones de claves foráneas ayudan a conservar la integridad de los datos relacionados con pedidos.

---

## 9. Manejo de errores y correcciones realizadas

Durante el desarrollo se identificaron y corrigieron distintos problemas.

| Problema | Solución aplicada |
|---|---|
| Repetición de código entre páginas | Se implementaron componentes reutilizables mediante `includes`. |
| Rutas incorrectas desde subcarpetas | Se utilizaron rutas basadas en `__DIR__`. |
| Consultas SQL con datos ingresados por usuarios | Se incorporaron consultas preparadas mediante PDO. |
| Posible exposición de credenciales | Se centralizó la configuración en `.env` y se excluyó del repositorio. |
| Datos dinámicos insertados en HTML | Se utilizó `htmlspecialchars()` para escapar la salida. |
| Eliminación de productos relacionados con pedidos | Se respetaron las restricciones de claves foráneas. |
| Acceso a páginas privadas sin iniciar sesión | Se incorporó `requiere_login()`. |
| Acceso de clientes al panel administrativo | Se incorporó `requiere_administrador()`. |
| Contraseñas almacenadas sin protección | Se implementó `password_hash()` y `password_verify()`. |
| Identificador de sesión potencialmente reutilizable después del login | Se incorporó `session_regenerate_id(true)`. |

---

## 10. Seguridad

Se aplicaron medidas de seguridad tanto en las operaciones con la base de datos como en la autenticación.

### 10.1. Consultas preparadas

Se utilizan consultas preparadas mediante PDO para separar las instrucciones SQL de los valores recibidos desde los formularios.

Esto ayuda a prevenir ataques de inyección SQL.

### 10.2. Validación de datos

Los datos recibidos se validan del lado del servidor antes de procesarse.

Se comprueban campos obligatorios, formatos, longitudes y valores permitidos según cada operación.

### 10.3. Escape de salida

Se utiliza `htmlspecialchars()` para mostrar datos dinámicos en HTML de manera segura y reducir el riesgo de ataques XSS.

### 10.4. Variables de entorno

Las credenciales de la base de datos se almacenan en `.env` y no se incluyen en el repositorio.

### 10.5. Contraseñas

Las contraseñas no se almacenan en texto plano.

Para crear los hashes se utiliza:

```php
password_hash($password, PASSWORD_BCRYPT);
```

Para comprobar una contraseña durante el inicio de sesión:

```php
password_verify($password, $usuario['password_hash']);
```

### 10.6. Control de acceso

Las páginas protegidas verifican la sesión y los permisos del usuario desde el servidor.

No se depende únicamente de ocultar enlaces o botones en la interfaz.

### 10.7. Seguridad de sesiones

Se configuran atributos de protección para las cookies de sesión:

- `HttpOnly`: impide que JavaScript acceda directamente a la cookie.
- `SameSite=Lax`: limita el envío de cookies en determinadas solicitudes entre sitios.
- `Secure`: exige HTTPS cuando la conexión utiliza ese protocolo.
- `session.use_strict_mode`: activa el modo estricto para las sesiones.

---

## 11. Autenticación y manejo de sesiones (TP8)

El Trabajo Práctico N.º 8 incorpora un sistema de registro, inicio y cierre de sesión, junto con controles de acceso según el rol del usuario.

La autenticación se realiza en el servidor utilizando PHP, MySQL y `$_SESSION`.

### 11.1. Configuración de sesiones

El archivo `config/sesion.php` contiene la función:

```php
iniciar_sesion_segura();
```

Esta función configura las opciones de seguridad y comienza la sesión.

Primero verifica que no exista una sesión activa. Luego establece el modo estricto y los parámetros de la cookie antes de ejecutar `session_start()`.

### 11.2. Registro de usuarios

El archivo `paginas/registro.php` permite crear una cuenta nueva.

El formulario solicita:

- Nombre.
- Correo electrónico.
- Contraseña.
- Confirmación de contraseña.

Antes de registrar al usuario se realizan las siguientes comprobaciones:

1. Se verifica que los campos estén completos.
2. Se valida el formato del correo electrónico.
3. Se controla la longitud de los datos.
4. Se comprueba que las contraseñas coincidan.
5. Se verifica que el correo no esté registrado previamente.
6. Se obtiene el identificador del rol `cliente`.
7. Se genera el hash de la contraseña mediante `password_hash()` con `PASSWORD_BCRYPT`.
8. Se inserta el usuario mediante una consulta preparada.

Los usuarios que se registran desde el formulario público reciben automáticamente el rol `cliente`. No pueden elegir el rol de administrador.

### 11.3. Inicio de sesión

El archivo `paginas/login.php` permite ingresar con una cuenta existente.

El proceso de autenticación es el siguiente:

1. Se reciben el correo electrónico y la contraseña.
2. Se consulta la tabla `usuarios` mediante una sentencia preparada.
3. Se obtiene también el nombre del rol mediante un `INNER JOIN` con la tabla `roles`.
4. Se comprueba que el usuario exista y que su cuenta esté activa.
5. Se verifica la contraseña con `password_verify()`.
6. Se regenera el identificador de sesión mediante `session_regenerate_id(true)`.
7. Se guardan los datos necesarios en `$_SESSION`.
8. Se redirige al usuario a su perfil.

Los datos almacenados en la sesión son:

```php
$_SESSION['usuario_id'];
$_SESSION['usuario_nombre'];
$_SESSION['rol'];
```

Si los datos son incorrectos o la cuenta está desactivada, se muestra un mensaje genérico.

### 11.4. Protección de páginas

El archivo `config/auth_guard.php` centraliza las comprobaciones de acceso.

Contiene dos funciones principales:

**`requiere_login()`**

Comprueba que exista una sesión autenticada mediante `$_SESSION['usuario_id']`.

Si el usuario no inició sesión, se lo redirige al formulario de login.

**`requiere_administrador()`**

Primero ejecuta `requiere_login()` y después comprueba que el rol almacenado en la sesión sea `administrador`.

Si el usuario no tiene permisos suficientes, se responde con el código HTTP 403.

### 11.5. Páginas protegidas

La función `requiere_login()` se utiliza en:

- `paginas/perfil.php`
- `paginas/historial-compras.php`

La función `requiere_administrador()` se utiliza en:

- `admin/index.php`
- `admin/crear.php`
- `admin/editar.php`
- `admin/eliminar.php`

Las comprobaciones se realizan al comienzo de cada archivo, antes de generar contenido HTML.

### 11.6. Cierre de sesión

El archivo `paginas/logout.php` se encarga de finalizar la sesión.

El procedimiento incluye:

1. Iniciar o recuperar la sesión existente.
2. Vaciar los datos de `$_SESSION`.
3. Eliminar la cookie de sesión del navegador.
4. Destruir la sesión mediante `session_destroy()`.
5. Redirigir al usuario.

Después del cierre de sesión, las páginas protegidas vuelven a solicitar autenticación.

### 11.7. Navegación según el estado del usuario

El archivo `includes/nav.php` adapta las opciones visibles según la sesión y el rol.

- **Visitante:** puede acceder a las secciones públicas, iniciar sesión o registrarse.
- **Cliente autenticado:** puede ingresar a su perfil y cerrar sesión.
- **Administrador autenticado:** además de las opciones anteriores, puede acceder al panel administrativo.

Esta adaptación mejora la navegación, mientras que la protección real se realiza mediante las funciones del archivo `auth_guard.php`.

### 11.8. Pruebas realizadas

Se realizaron pruebas locales para comprobar el funcionamiento de la autenticación y los permisos.

| Prueba | Resultado esperado | Resultado obtenido |
|---|---|---|
| Acceder al perfil sin iniciar sesión | Redirección al login | Correcto |
| Registrar un usuario nuevo | Crear una cuenta con rol cliente | Correcto |
| Iniciar sesión como cliente | Acceder al perfil | Correcto |
| Cerrar sesión | Destruir la sesión | Correcto |
| Acceder al panel como cliente | Mostrar error 403 | Correcto |
| Iniciar sesión como administrador | Acceder al perfil | Correcto |
| Acceder al panel como administrador | Permitir el acceso | Correcto |
| Comprobar sintaxis de los archivos PHP | No presentar errores de sintaxis | Correcto |

También se verificó que los archivos PHP del proyecto no presentaran errores de sintaxis mediante el comando de PHP `-l`.

---

## 12. Funcionalidades y limitaciones actuales

### 12.1. Funcionalidades implementadas

- Navegación general del sitio.
- Catálogo de juegos y productos.
- Búsqueda y filtros.
- Ofertas especiales.
- Métodos de pago informativos.
- Formulario de contacto con validaciones.
- Conexión a MySQL mediante PDO.
- Operaciones CRUD de productos.
- Panel administrativo.
- Validaciones del lado del servidor.
- Consultas preparadas.
- Escape de salida con `htmlspecialchars()`.
- Configuración mediante variables de entorno.
- Registro de usuarios.
- Inicio de sesión.
- Cierre de sesión.
- Almacenamiento seguro de contraseñas.
- Manejo de sesiones PHP.
- Protección de páginas para usuarios autenticados.
- Control de acceso administrativo según el rol.
- Navegación adaptada al estado de autenticación.

### 12.2. Funcionalidades pendientes o limitaciones

- El carrito y los favoritos continúan utilizando `localStorage`.
- No se encuentra implementada una pasarela de pagos real.
- No se realiza la entrega automática de monedas o recargas.
- El historial de compras utiliza información demostrativa y todavía no está conectado a un flujo completo de pedidos reales.
- Algunas vistas y funcionalidades todavía requieren ajustes visuales y pruebas adicionales.

---

## 13. Próximas mejoras

- Completar las pruebas funcionales de las distintas secciones.
- Revisar la experiencia de usuario en dispositivos móviles.
- Mejorar las vistas y los recursos gráficos.
- Realizar pruebas de rendimiento y accesibilidad.
- Mantener actualizada la documentación técnica.
- Continuar el desarrollo de las funcionalidades pendientes.

---

## 14. Refactorización a MVC nativo en PHP (TP10)

Como parte del Trabajo Práctico N.º 10, se refactorizó el módulo de productos utilizando el patrón de arquitectura MVC (Modelo-Vista-Controlador).

Se reorganizó el código en las siguientes carpetas:

- `app/Models/`: contiene el modelo `Producto.php`, encargado de realizar las consultas a la base de datos mediante PDO.
- `app/Controllers/`: contiene `ProductoController.php`, que recibe las solicitudes y coordina la comunicación entre el modelo y la vista.
- `app/Views/`: contiene la vista `productos/index.php`, encargada de mostrar el catálogo de productos.

El archivo `paginas/productos.php` funciona como punto de entrada y delega la ejecución al controlador.

Esta organización permite separar las responsabilidades del sistema y facilita el mantenimiento del código.

## 15. Implementación de un módulo con Laravel (TP10)

Para la segunda parte del trabajo práctico se incorporó Laravel como framework PHP, creando un proyecto independiente dentro de la carpeta `laravel/`.

Se implementó un módulo de reporte de productos que permite consultar información de los productos activos de la tienda.

El módulo utiliza:

- **Rutas:** definidas en `routes/web.php`.
- **Controlador:** `ReporteProductoController.php`, encargado de procesar la solicitud y preparar los datos.
- **Modelos:** `Producto.php` y `Juego.php`, que representan las entidades de la base de datos.
- **Vista:** `productos.blade.php`, que utiliza el motor de plantillas Blade para mostrar el reporte.

El reporte presenta el total de productos activos, el stock total, el precio promedio y un listado con el nombre del producto, el juego al que pertenece, su precio y su stock.

Para acceder al módulo se utiliza la ruta `/reportes/productos`.

## 16. Organización y control de versiones del TP10

Los cambios correspondientes al Trabajo Práctico N.º 10 se realizaron en una rama independiente de Git llamada `feature/tp10-mvc-framework`.

Se mantuvo separada la aplicación PHP original del proyecto Laravel para evitar afectar las funcionalidades desarrolladas en los trabajos prácticos anteriores.

Se verificó el funcionamiento del catálogo refactorizado, la búsqueda dinámica de productos y el nuevo reporte implementado con Laravel.

Los cambios fueron registrados mediante un commit y enviados al repositorio remoto de GitHub.

## 17.Conclusión

BUYDIMA evolucionó desde una interfaz de tienda online hacia una aplicación con persistencia de datos y funcionalidades del lado del servidor.

La incorporación de PHP y MySQL permitió implementar operaciones CRUD, mientras que el TP8 agregó autenticación mediante sesiones, protección de contraseñas y control de acceso según roles.

La estructura modular facilita el mantenimiento del código y permite continuar incorporando funcionalidades sin repetir lógica en las distintas páginas.

El proyecto mantiene algunas funcionalidades de carácter demostrativo, por lo que todavía no constituye un sistema completo de venta y entrega automática de productos digitales.