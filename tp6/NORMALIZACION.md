# TP6 – Diseño y Creación del Esquema Relacional en MySQL

## Parte 1: Normalización aplicada a BUYDIMA

### 1. Entidad principal sin normalizar

Se considera la siguiente tabla hipotética de pedidos de BUYDIMA, donde se almacenan los datos del cliente y los productos adquiridos.

| id_pedido | nombre_cliente | email | productos | cantidades |
|---|---|---|---|---|
| 1 | Juan Pérez | juan@gmail.com | 100 diamantes Free Fire, 800 Robux | 1, 2 |

**Problema detectado:** las columnas `productos` y `cantidades` contienen múltiples valores en un mismo campo, por lo que no cumplen con el principio de atomicidad de los datos.

### 2. Primera Forma Normal (1FN)

Para cumplir con la primera forma normal, se eliminan los valores múltiples de una misma columna, separando cada producto en un registro individual.

**Tabla resultante:**

| id_pedido | nombre_cliente | email | producto | cantidad |
|---|---|---|---|---|
| 1 | Juan Pérez | juan@gmail.com | 100 diamantes Free Fire | 1 |
| 1 | Juan Pérez | juan@gmail.com | 800 Robux | 2 |

**Resultado:** cada campo contiene un único valor. Sin embargo, los datos del cliente y del pedido se repiten cuando una compra contiene varios productos. Por este motivo, es necesario continuar con la normalización.

### 3. Segunda Forma Normal (2FN)

Para aplicar la segunda forma normal, primero se identifica que la tabla de detalle utiliza una clave primaria compuesta por `id_pedido` e `id_producto`.

Para identificar cada producto de manera única, se incorpora el atributo `id_producto`, que permite relacionarlo con su información correspondiente en la tabla PRODUCTOS.

Se observa que algunos atributos dependen solamente de una parte de esa clave:

- Los datos del cliente y del pedido dependen de `id_pedido`.
- El nombre y el juego al que pertenece cada producto dependen de `id_producto`.
- La cantidad comprada depende de la combinación de `id_pedido` e `id_producto`.

Para eliminar estas dependencias parciales, se separa la información en las siguientes tablas:

**PEDIDOS**

| id_pedido (PK) | nombre_cliente | email |
|---|---|---|
| 1 | Juan Pérez | juan@gmail.com |

**PRODUCTOS**

| id_producto (PK) | nombre_producto | juego |
|---|---|---|
| 1 | 100 diamantes | Free Fire |
| 2 | 800 monedas | Roblox |

**DETALLE_PEDIDO**

| id_pedido (PK, FK) | id_producto (PK, FK) | cantidad |
|---|---|---|
| 1 | 1 | 1 |
| 1 | 2 | 2 |

**Resultado:** se eliminaron las dependencias parciales. Cada atributo depende de la clave primaria completa de su tabla.

### 4. Tercera Forma Normal (3FN)

Para aplicar la tercera forma normal, se identifican las dependencias transitivas, es decir, los atributos que dependen de otros atributos que no son claves primarias.

En la tabla PEDIDOS, los datos personales del cliente dependen de su identificador de usuario. Por lo tanto, almacenar el nombre y el email directamente en PEDIDOS generaría una dependencia transitiva. Para evitarlo, se crea la tabla USUARIOS y se utiliza `id_usuario` como clave foránea en PEDIDOS.

También se separan los juegos en una tabla propia, ya que varios productos pueden pertenecer al mismo juego.

**Tablas resultantes:**

**USUARIOS**

| id_usuario (PK) | nombre | email |
|---|---|---|
| 1 | Juan Pérez | juan@gmail.com |

**PEDIDOS**

| id_pedido (PK) | id_usuario (FK) |
|---|---|
| 1 | 1 |

**JUEGOS**

| id_juego (PK) | nombre |
|---|---|
| 1 | Free Fire |
| 2 | Roblox |

**PRODUCTOS**

| id_producto (PK) | nombre_producto | id_juego (FK) |
|---|---|---|
| 1 | 100 diamantes | 1 |
| 2 | 800 monedas | 2 |

**DETALLE_PEDIDO**

| id_pedido (PK, FK) | id_producto (PK, FK) | cantidad | precio_unitario |
|---|---|---|---|
| 1 | 1 | 1 | 1500 |
| 1 | 2 | 2 | 3000 |

Además, se incorporan las tablas ROLES y ESTADOS_PEDIDO para organizar los permisos de los usuarios y los posibles estados de los pedidos. De esta manera, se evita repetir esos valores en las tablas principales y se facilita su administración.

**Resultado:** se separaron los datos de los usuarios y los juegos para evitar repeticiones y dependencias transitivas. La información queda distribuida en tablas relacionadas mediante claves primarias y foráneas.

### 5. Listado de tablas resultantes

Luego de aplicar las tres formas normales, el esquema relacional de BUYDIMA queda compuesto por las siguientes tablas:

| Tabla | Clave primaria (PK) | Claves foráneas (FK) |
|---|---|---|
| ROLES | id_rol | No posee |
| USUARIOS | id_usuario | id_rol → ROLES(id_rol) |
| JUEGOS | id_juego | No posee |
| PRODUCTOS | id_producto | id_juego → JUEGOS(id_juego) |
| ESTADOS_PEDIDO | id_estado | No posee |
| PEDIDOS | id_pedido | id_usuario → USUARIOS(id_usuario), id_estado → ESTADOS_PEDIDO(id_estado) |
| DETALLE_PEDIDO | id_pedido + id_producto | id_pedido → PEDIDOS(id_pedido), id_producto → PRODUCTOS(id_producto) |

**Relaciones entre las tablas:**

- Un rol puede estar asignado a muchos usuarios.
- Un usuario puede realizar muchos pedidos.
- Un juego puede tener muchos productos.
- Un estado puede corresponder a muchos pedidos.
- Un pedido puede contener varios productos.
- Un producto puede aparecer en distintos pedidos.

La tabla DETALLE_PEDIDO permite resolver la relación muchos a muchos entre PEDIDOS y PRODUCTOS.

**Conclusión:** la normalización permite organizar la información de BUYDIMA, reducir la redundancia y mantener la integridad de los datos mediante claves primarias y foráneas.