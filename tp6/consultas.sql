USE buydima;

INSERT INTO roles (id_rol, nombre, descripcion) VALUES
  (1, 'Administrador', 'Acceso completo a la gestión de la tienda.'),
  (2, 'Cliente', 'Usuario que compra recargas en el catálogo.');

INSERT INTO estados_pedido (id_estado, nombre, descripcion) VALUES
  (1, 'Pendiente', 'Pedido creado y pendiente de pago.'),
  (2, 'Pagado', 'Pago confirmado.'),
  (3, 'Cancelado', 'Pedido cancelado por el cliente.');

INSERT INTO usuarios (id_usuario, id_rol, nombre, email, password_hash) VALUES
  (1, 1, 'Ana Torres', 'ana.torres@buydima.com', '$2y$10$1gJY2DFYOy57i1xeZr8RieTreu/CUgnFlBMHxUndM64o.SkQxHjCy'),
  (2, 2, 'Juan Pérez', 'juan.perez@gmail.com', '$2y$10$LL7tuz9A7rOBBW5gBgEYkeKsJVAc574EUu2KdSK4d..TBAGkNbkRa');

INSERT INTO juegos (id_juego, nombre, descripcion) VALUES
  (1, 'Free Fire', 'Recargas de diamantes para Free Fire.'),
  (2, 'Roblox', 'Recargas de Robux para Roblox.'),
  (3, 'Genshin Impact', 'Recargas de Cristales Génesis para Genshin Impact.');

INSERT INTO productos (id_producto, id_juego, nombre_producto, descripcion, precio, stock) VALUES
  (1, 1, '100 diamantes Free Fire', 'Paquete de 100 diamantes.', 1500.00, 50),
  (2, 1, '310 diamantes Free Fire', 'Paquete de 310 diamantes.', 4200.00, 30),
  (3, 2, '800 Robux', 'Paquete de 800 Robux.', 3000.00, 40),
  (4, 3, '60 Cristales Génesis', 'Paquete de 60 Cristales Génesis.', 2800.00, 25);

INSERT INTO pedidos (id_pedido, id_usuario, id_estado, total, created_at) VALUES
  (1, 1, 2, 5700.00, '2026-11-10 14:30:00'),
  (2, 2, 1, 6000.00, '2026-11-12 09:15:00'),
  (3, 2, 3, 2800.00, '2026-11-13 18:00:00');

INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES
  (1, 1, 1, 1500.00),
  (1, 2, 1, 4200.00),
  (2, 3, 2, 3000.00),
  (3, 4, 1, 2800.00);

SELECT id_producto, nombre_producto, precio, stock
FROM productos
WHERE activo = TRUE AND stock > 0
ORDER BY precio DESC, nombre_producto ASC;

SELECT
  p.id_pedido,
  p.created_at AS fecha_pedido,
  u.nombre AS cliente,
  u.email,
  e.nombre AS estado,
  j.nombre AS juego,
  pr.nombre_producto,
  dp.cantidad,
  dp.precio_unitario,
  (dp.cantidad * dp.precio_unitario) AS subtotal,
  p.total
FROM pedidos p
INNER JOIN usuarios u ON u.id_usuario = p.id_usuario
INNER JOIN estados_pedido e ON e.id_estado = p.id_estado
INNER JOIN detalle_pedido dp ON dp.id_pedido = p.id_pedido
INNER JOIN productos pr ON pr.id_producto = dp.id_producto
INNER JOIN juegos j ON j.id_juego = pr.id_juego
ORDER BY p.id_pedido ASC, pr.nombre_producto ASC;

UPDATE pedidos
SET id_estado = 2
WHERE id_pedido = 2;

DELETE FROM detalle_pedido
WHERE id_pedido = 3 AND id_producto = 4;

DELETE FROM pedidos
WHERE id_pedido = 3;
