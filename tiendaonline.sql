-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2024 a las 20:32:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12
CREATE DATABASE IF NOT EXISTS `tiendaonline`;
USE `tiendaonline`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendaonline`
--
CREATE DATABASE IF NOT EXISTS tiendaonline;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `url_imagen`) VALUES
(1, 'gafasSol.jpg'),
(2, 'gafasGraduadas.jpg'),
(3, 'gafasLectura.jpg'),
(4, 'gafasModa.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE `idiomas` (
  `idioma_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`idioma_id`, `nombre`) VALUES
(1, 'Español'),
(2, 'Ingles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_12_001016_create_roles_table', 1),
(2, '2024_01_11_191714_create_idiomas_table', 2),
(3, '2024_01_12_111235_create_categorias_table', 3),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(5, '2024_01_12_000557_create_usuarios_table', 4),
(6, '2024_01_12_112839_create_productos_table', 4),
(7, '2024_01_12_114218_create_pedidos_table', 4),
(8, '2024_01_12_164730_create_traduccion_categorias_table', 5),
(9, '2024_01_12_164738_create_traduccion_productos_table', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `precio_total` decimal(8,2) NOT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `producto_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `cantidad`, `fecha_pedido`, `precio_total`, `usuario_id`, `producto_id`) VALUES
(1, 2, '2024-02-21', 29.00, 4, 1),
(2, 2, '2024-02-21', 29.99, 4, 1),
(3, 1, '2024-02-21', 29.99, 4, 1),
(4, 1, '2024-02-21', 39.99, 4, 2),
(5, 1, '2024-02-21', 49.99, 4, 3),
(6, 1, '2024-02-21', 49.99, 4, 3),
(7, 1, '2024-02-21', 29.99, 4, 1),
(8, 1, '2024-02-21', 39.99, 4, 2),
(9, 1, '2024-02-28', 29.99, 4, 1);

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `actualizar_stock_despues_de_pedido` AFTER INSERT ON `pedidos` FOR EACH ROW BEGIN
    -- Actualizar el stock del producto después de que se complete un pedido
    UPDATE productos
    SET stock = stock - NEW.cantidad
    WHERE producto_id = NEW.producto_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  `categoria_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `precio`, `stock`, `imagen_url`, `categoria_id`) VALUES
(1, 29.99, 43, 'https://images.pexels.com/photos/343720/pexels-photo-343720.jpeg', 1),
(2, 39.99, 28, 'https://images.pexels.com/photos/5472304/pexels-photo-5472304.jpeg', 1),
(3, 49.99, 18, 'https://images.pexels.com/photos/5472317/pexels-photo-5472317.jpeg', 1),
(4, 59.99, 15, 'https://images.pexels.com/photos/690887/pexels-photo-690887.jpeg', 1),
(5, 69.99, 10, 'https://images.pexels.com/photos/13982235/pexels-photo-13982235.jpeg', 1),
(6, 79.99, 40, 'https://th.bing.com/th/id/OIP.dtRYlzkhUzcjKGmjqIBS9gHaHa', 2),
(7, 89.99, 35, 'https://th.bing.com/th/id/OIP.g4vr5iMvqswRH3dtPMwRAAHaHa', 2),
(8, 99.99, 25, 'https://th.bing.com/th/id/OIP.TRYpxFB1sMARK8m8f9HXzwHaHa', 2),
(9, 109.99, 20, 'https://th.bing.com/th/id/OIP.KoV2Gra_GuK3mIqHSaiWewHaHa', 2),
(10, 119.99, 15, 'https://th.bing.com/th/id/OIP.mLzLCZhAjPhDyUIHUAXPhQHaDT', 2),
(11, 19.99, 50, 'https://th.bing.com/th/id/OIP.dTg8UfpJN80rU34hfDLnawHaHa', 3),
(12, 24.99, 40, 'https://th.bing.com/th/id/OIP.NCNxTwY474hzwjNnCLxV2wHaHa', 3),
(13, 29.99, 30, 'https://th.bing.com/th/id/OIP.otCv-fzl16xF4UYyK-dfUAHaHa', 3),
(14, 34.99, 25, 'https://th.bing.com/th/id/OIP.MqOehV2hDiRGUq4P0TCflwHaHa', 3),
(15, 39.99, 20, 'https://th.bing.com/th/id/OIP.Y51lu9qiE3cr1_PkCSxdywHaHa', 3),
(16, 49.99, 50, 'https://th.bing.com/th/id/OIP.Qx1LgY8EvQn916N9sMwEhgHaE7', 4),
(17, 59.99, 40, 'https://th.bing.com/th/id/OIP.qUjAICokuPuDdqjnKrJnDwHaEK', 4),
(18, 69.99, 30, 'https://th.bing.com/th/id/OIP.na4YmG8USzbdkKh1ktKtNQHaDV', 4),
(19, 79.99, 25, 'https://th.bing.com/th/id/OIP.pn5d1Clp0Z66GN43DemSXQHaHa', 4),
(20, 89.99, 20, 'https://th.bing.com/th/id/OIP.rIIgq7pN5YlwMkoTGzlxYgHaFR', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `nombre`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traduccion_categorias`
--

CREATE TABLE `traduccion_categorias` (
  `traduccion_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_traducido` varchar(255) NOT NULL,
  `categoria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `idioma_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `traduccion_categorias`
--

INSERT INTO `traduccion_categorias` (`traduccion_id`, `nombre_traducido`, `categoria_id`, `idioma_id`) VALUES
(1, 'Gafas de Sol', 1, 1),
(2, 'Gafas Graduadas', 2, 1),
(3, 'Gafas de Lectura', 3, 1),
(4, 'Gafas de Moda', 4, 1),
(5, 'Sunglasses', 1, 2),
(6, 'Prescription Glasses', 2, 2),
(7, 'Reading Glasses', 3, 2),
(8, 'Fashion Glasses', 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traduccion_productos`
--

CREATE TABLE `traduccion_productos` (
  `traduccion_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_traducido` varchar(255) NOT NULL,
  `descripcion_traducida` text NOT NULL,
  `producto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `idioma_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `traduccion_productos`
--

INSERT INTO `traduccion_productos` (`traduccion_id`, `nombre_traducido`, `descripcion_traducida`, `producto_id`, `idioma_id`) VALUES
(1, 'Gafas de sol clásicas', 'Gafas de sol clásicas con protección UV', 1, 1),
(2, 'Classic sunglasses', 'Classic sunglasses with UV protection', 1, 2),
(3, 'Gafas de sol modernas', 'Gafas de sol modernas con lentes polarizadas', 2, 1),
(4, 'Modern sunglasses', 'Modern sunglasses with polarized lenses', 2, 2),
(5, 'Gafas de sol elegantes', 'Gafas de sol elegantes con montura de metal', 3, 1),
(6, 'Stylish sunglasses', 'Stylish sunglasses with metal frame', 3, 2),
(7, 'Gafas de sol deportivas', 'Gafas de sol deportivas para actividades al aire libre', 4, 1),
(8, 'Sport sunglasses', 'Sport sunglasses for outdoor activities', 4, 2),
(9, 'Gafas de sol retro', 'Gafas de sol retro con diseño vintage', 5, 1),
(10, 'Retro sunglasses', 'Retro sunglasses with vintage design', 5, 2),
(11, 'Gafas graduadas elegantes', 'Gafas graduadas elegantes con montura de acetato', 6, 1),
(12, 'Stylish prescription glasses', 'Stylish prescription glasses with acetate frame', 6, 2),
(13, 'Gafas graduadas modernas', 'Gafas graduadas modernas con lentes antirreflejo', 7, 1),
(14, 'Modern prescription glasses', 'Modern prescription glasses with anti-reflective lenses', 7, 2),
(15, 'Gafas graduadas clásicas', 'Gafas graduadas clásicas con montura metálica', 8, 1),
(16, 'Classic prescription glasses', 'Classic prescription glasses with metal frame', 8, 2),
(17, 'Gafas graduadas deportivas', 'Gafas graduadas deportivas para actividades diarias', 9, 1),
(18, 'Sporty prescription glasses', 'Sporty prescription glasses for daily activities', 9, 2),
(19, 'Gafas graduadas juveniles', 'Gafas graduadas juveniles con colores vibrantes', 10, 1),
(20, 'Youth prescription glasses', 'Youth prescription glasses with vibrant colors', 10, 2),
(21, 'Gafas de lectura clásicas', 'Gafas de lectura clásicas con montura de plástico', 11, 1),
(22, 'Classic reading glasses', 'Classic reading glasses with plastic frame', 11, 2),
(23, 'Gafas de lectura modernas', 'Gafas de lectura modernas con estuche protector', 12, 1),
(24, 'Modern reading glasses', 'Modern reading glasses with protective case', 12, 2),
(25, 'Gafas de lectura elegantes', 'Gafas de lectura elegantes con diseño ligero', 13, 1),
(26, 'Elegant reading glasses', 'Elegant reading glasses with lightweight design', 13, 2),
(27, 'Gafas de lectura plegables', 'Gafas de lectura plegables para mayor comodidad', 14, 1),
(28, 'Folding reading glasses', 'Folding reading glasses for added convenience', 14, 2),
(29, 'Gafas de lectura de moda', 'Gafas de lectura de moda con colores vivos', 15, 1),
(30, 'Fashion reading glasses', 'Fashion reading glasses with vibrant colors', 15, 2),
(31, 'Gafas de moda retro', 'Gafas de moda retro con montura de carey', 16, 1),
(32, 'Retro fashion glasses', 'Retro fashion glasses with tortoise shell frame', 16, 2),
(33, 'Gafas de moda vintage', 'Gafas de moda vintage con diseño clásico', 17, 1),
(34, 'Vintage fashion glasses', 'Vintage fashion glasses with classic design', 17, 2),
(35, 'Gafas de moda elegantes', 'Gafas de moda elegantes con cristales tintados', 18, 1),
(36, 'Elegant fashion glasses', 'Elegant fashion glasses with tinted lenses', 18, 2),
(37, 'Gafas de moda modernas', 'Gafas de moda modernas con diseño minimalista', 19, 1),
(38, 'Modern fashion glasses', 'Modern fashion glasses with minimalist design', 19, 2),
(39, 'Gafas de moda juveniles', 'Gafas de moda juveniles con colores brillantes', 20, 1),
(40, 'Youthful fashion glasses', 'Youthful fashion glasses with bright colors', 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `contrasena`, `direccion`, `telefono`, `email`, `rol_id`) VALUES
(1, 'admin', 'admin', 'miTienda', 123456789, 'admin@gmail.com', 1),
(4, 'Javier', '1234', 'CasaJavi', 640562830, 'jzaforas23@gmail.com', 2),
(6, 'Julio', '1234', 'CasaJulio', 234560911, 'julio@gmail.com', 2),
(8, 'Lola', '1234', 'Casa de Lola', 198346754, 'lola@gmail.com', 2),
(9, 'Pablo', '1234', 'casa de Pablo', 986345621, 'pablo@gmail.com', 2),
(10, 'Marta', '1234', 'Casa de Marta', 238907546, 'marta@gmail.com', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`idioma_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  ADD KEY `pedidos_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `traduccion_categorias`
--
ALTER TABLE `traduccion_categorias`
  ADD PRIMARY KEY (`traduccion_id`),
  ADD KEY `traduccion_categorias_categoria_id_foreign` (`categoria_id`),
  ADD KEY `traduccion_categorias_idioma_id_foreign` (`idioma_id`);

--
-- Indices de la tabla `traduccion_productos`
--
ALTER TABLE `traduccion_productos`
  ADD PRIMARY KEY (`traduccion_id`),
  ADD KEY `traduccion_productos_producto_id_foreign` (`producto_id`),
  ADD KEY `traduccion_productos_idioma_id_foreign` (`idioma_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `usuarios_rol_id_foreign` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `idioma_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `traduccion_categorias`
--
ALTER TABLE `traduccion_categorias`
  MODIFY `traduccion_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `traduccion_productos`
--
ALTER TABLE `traduccion_productos`
  MODIFY `traduccion_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `traduccion_categorias`
--
ALTER TABLE `traduccion_categorias`
  ADD CONSTRAINT `traduccion_categorias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `traduccion_categorias_idioma_id_foreign` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`idioma_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `traduccion_productos`
--
ALTER TABLE `traduccion_productos`
  ADD CONSTRAINT `traduccion_productos_idioma_id_foreign` FOREIGN KEY (`idioma_id`) REFERENCES `idiomas` (`idioma_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `traduccion_productos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
