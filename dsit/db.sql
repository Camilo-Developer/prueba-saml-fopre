-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla fopre_cafe.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.answers: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maximum_age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.categories: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_id` bigint unsigned NOT NULL,
  `estado_id` bigint unsigned NOT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirección_correspondencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_correspondencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular_correspondencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comporbante_registro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registro_invima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `examen_microbiologico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formato_sgsst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `protocolos_bioseguridad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_saneamiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copia_carnet_manipulacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copia_carnet_vacunacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copia_plantilla_arp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logistico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electrico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tamaño_carpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `array_medios_pago` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_usuario_id_foreign` (`usuario_id`),
  KEY `companies_estado_id_foreign` (`estado_id`),
  CONSTRAINT `companies_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `states` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `companies_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.companies: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.id_types
CREATE TABLE IF NOT EXISTS `id_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.id_types: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.inscriptions
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.inscriptions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_estado_id_foreign` (`estado_id`),
  KEY `menus_company_id_foreign` (`company_id`),
  CONSTRAINT `menus_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `menus_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `states` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.menus: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.menu_product
CREATE TABLE IF NOT EXISTS `menu_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_product_product_id_foreign` (`product_id`),
  KEY `menu_product_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_product_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `menu_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.menu_product: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2013_04_20_155401_create_states_table', 1),
	(2, '2014_10_12_000000_create_users_table', 1),
	(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(5, '2019_06_24_140207_create_saml2_tenants_table', 1),
	(6, '2019_08_19_000000_create_failed_jobs_table', 1),
	(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(8, '2020_10_22_140856_add_relay_state_url_column_to_saml2_tenants_table', 1),
	(9, '2020_10_23_072902_add_name_id_format_column_to_saml2_tenants_table', 1),
	(10, '2023_04_11_213934_create_sessions_table', 1),
	(11, '2023_04_20_155233_create_menus_table', 1),
	(12, '2023_04_20_155234_create_pays_table', 1),
	(13, '2023_04_20_155235_create_sale_reports_table', 1),
	(14, '2023_04_20_155236_create_companies_table', 1),
	(15, '2023_04_20_155237_create_products_table', 1),
	(16, '2023_04_20_155636_create_pre_orders_table', 1),
	(17, '2023_04_20_155637_create_menu_product_table', 1),
	(18, '2023_04_28_170429_create_permission_tables', 1),
	(19, '2023_05_02_144901_create_questions_table', 1),
	(20, '2023_05_02_144919_create_modalities_table', 1),
	(21, '2023_05_02_145005_create_answers_table', 1),
	(22, '2023_05_02_145149_create_categories_table', 1),
	(23, '2023_05_02_145217_create_sizes_table', 1),
	(24, '2023_05_02_145245_create_transports_table', 1),
	(25, '2023_05_02_145246_create_inscriptions_table', 1),
	(26, '2023_05_03_191116_create_id_types_table', 1),
	(27, '2023_05_11_211348_create_pre_order_product_table', 1),
	(28, '2023_05_15_232655_create_pay_sale_report_table', 1),
	(29, '2023_05_22_223800_create_type_states_table', 1),
	(30, '2024_04_20_195502_create_relationships_table', 1);

-- Volcando estructura para tabla fopre_cafe.modalities
CREATE TABLE IF NOT EXISTS `modalities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_modality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_modality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observations_modality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modalities_state_id_foreign` (`state_id`),
  CONSTRAINT `modalities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.modalities: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.model_has_permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.model_has_roles: ~0 rows (aproximadamente)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(3, 'App\\Models\\User', 4);

-- Volcando estructura para tabla fopre_cafe.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.pays
CREATE TABLE IF NOT EXISTS `pays` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `metodo_pago` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.pays: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.pay_sale_report
CREATE TABLE IF NOT EXISTS `pay_sale_report` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_report_id` bigint unsigned NOT NULL,
  `pay_id` bigint unsigned NOT NULL,
  `amount` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pay_sale_report_sale_report_id_foreign` (`sale_report_id`),
  KEY `pay_sale_report_pay_id_foreign` (`pay_id`),
  CONSTRAINT `pay_sale_report_pay_id_foreign` FOREIGN KEY (`pay_id`) REFERENCES `pays` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pay_sale_report_sale_report_id_foreign` FOREIGN KEY (`sale_report_id`) REFERENCES `sale_reports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.pay_sale_report: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.permissions: ~0 rows (aproximadamente)
INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin.dashboard', 'Ver dashboard del Admin y Empresa', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(2, 'admin.states.index', 'Lista de Estados Disponibles', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(3, 'admin.states.create', 'Creacion de Estados', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(4, 'admin.states.edit', 'Edicion de Estados', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(5, 'admin.states.show', 'Ver detalles de Estado', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(6, 'admin.states.destroy', 'Eliminar Estados', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(7, 'admin.roles.index', 'Lista de Estados Disponibles', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(8, 'admin.roles.create', 'Creacion de Estados', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(9, 'admin.roles.edit', 'Edicion de Estados', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(10, 'admin.roles.show', 'Ver detalles de Estado', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(11, 'admin.roles.destroy', 'Eliminar Estados', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(12, 'admin.users.index', 'Lista de Usuarios', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(13, 'admin.users.create', 'Creacion de Usuarios', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(14, 'admin.users.edit', 'Edicion de Usuarios', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(15, 'admin.users.show', 'Ver detalles de Usuario', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(16, 'admin.users.destroy', 'Eliminar Usuario', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(17, 'admin.products.index', 'Lista de Productos', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(18, 'admin.products.create', 'Crear Producto', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(19, 'admin.products.edit', 'Editar Producto', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(20, 'admin.products.show', 'Ver detalles del Producto', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(21, 'admin.products.destroy', 'Eliminar Producto', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(22, 'admin.menus.index', 'Lista de Menus', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(23, 'admin.menus.create', 'Crear Menu', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(24, 'admin.menus.edit', 'Editar Menu', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(25, 'admin.menus.show', 'Ver detalle del  Menu', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(26, 'admin.menus.destroy', 'Eliminar Menu', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(27, 'admin.pays.index', 'Lista de metodos de Pago', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(28, 'admin.pays.create', 'Crear metodos de pago', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(29, 'admin.pays.edit', 'editar metodo de pago', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(30, 'admin.pays.show', 'ver metodo de pago', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(31, 'admin.pays.destroy', 'eliminar metodo de pago', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(32, 'admin.salereports.index', 'Listar reporte de ventas', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(33, 'admin.salereports.create', 'Crear reporte de venta', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(34, 'admin.salereports.edit', 'Editar reporte de venta', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(35, 'admin.salereports.show', 'Ver detalle del reporte de venta', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(36, 'admin.salereports.destroy', 'Eliminar reporte de venta', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(37, 'admin.companies.index', 'Lista de empresas', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(38, 'admin.companies.create', 'Crear empresa', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(39, 'admin.companies.edit', 'Editar empresa', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(40, 'admin.companies.show', 'Ver detalle de la empresa', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(41, 'admin.companies.destroy', 'Eliminar empresa', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(42, 'admin.preorders.index', 'Lista de pedidos pendientes', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(43, 'admin.preorders.entregados', 'Lista de pedidos entregados', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(44, 'admin.preorders.create', 'Crear un pedido anticipado', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(45, 'admin.preorders.edit', 'Editar de pedidos pendientes', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(46, 'admin.preorders.show', 'Ver detalles de pedidos pendientes', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(47, 'admin.preorders.destroy', 'Eliminar pedidos pendientes', 'web', '2023-06-15 01:25:31', '2023-06-15 01:25:31');

-- Volcando estructura para tabla fopre_cafe.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.pre_orders
CREATE TABLE IF NOT EXISTS `pre_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dependence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_center` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_cost_center` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_auth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_claim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observations` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int unsigned NOT NULL,
  `usuario_id` bigint unsigned NOT NULL,
  `estado_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_orders_usuario_id_foreign` (`usuario_id`),
  KEY `pre_orders_estado_id_foreign` (`estado_id`),
  KEY `pre_orders_company_id_foreign` (`company_id`),
  CONSTRAINT `pre_orders_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `pre_orders_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `states` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `pre_orders_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.pre_orders: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.pre_order_product
CREATE TABLE IF NOT EXISTS `pre_order_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int unsigned NOT NULL,
  `subtotal` int unsigned NOT NULL,
  `pre_order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_order_product_pre_order_id_foreign` (`pre_order_id`),
  KEY `pre_order_product_product_id_foreign` (`product_id`),
  CONSTRAINT `pre_order_product_pre_order_id_foreign` FOREIGN KEY (`pre_order_id`) REFERENCES `pre_orders` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `pre_order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.pre_order_product: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `imagen_producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `impoconsumo_producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_company_id_foreign` (`company_id`),
  CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.products: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `modality_id` bigint unsigned NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.questions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.roles: ~0 rows (aproximadamente)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(2, 'Empresa', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30'),
	(3, 'Usuario', 'web', '2023-06-15 01:25:30', '2023-06-15 01:25:30');

-- Volcando estructura para tabla fopre_cafe.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.role_has_permissions: ~0 rows (aproximadamente)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(1, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2),
	(22, 2),
	(24, 2),
	(25, 2),
	(32, 2),
	(33, 2),
	(34, 2),
	(35, 2),
	(36, 2),
	(39, 2),
	(42, 2),
	(43, 2),
	(44, 2),
	(45, 2),
	(46, 2);

-- Volcando estructura para tabla fopre_cafe.sale_reports
CREATE TABLE IF NOT EXISTS `sale_reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_reports_company_id_foreign` (`company_id`),
  CONSTRAINT `sale_reports_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.sale_reports: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.saml2_tenants
CREATE TABLE IF NOT EXISTS `saml2_tenants` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idp_entity_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idp_login_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idp_logout_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idp_x509_cert` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `relay_state_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_id_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'persistent',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.saml2_tenants: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.sessions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.sizes
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.sizes: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.states
CREATE TABLE IF NOT EXISTS `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_state_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `states_type_state_id_foreign` (`type_state_id`),
  CONSTRAINT `states_type_state_id_foreign` FOREIGN KEY (`type_state_id`) REFERENCES `type_states` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.states: ~0 rows (aproximadamente)
INSERT INTO `states` (`id`, `color`, `nombre_estado`, `type_state_id`, `created_at`, `updated_at`) VALUES
	(1, '#000000', 'Disponible', 1, '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(2, '#000000', 'No Disponible', 2, '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(3, '#000000', 'Pendiente', 3, '2023-06-15 01:25:31', '2023-06-15 01:25:31');

-- Volcando estructura para tabla fopre_cafe.transports
CREATE TABLE IF NOT EXISTS `transports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_transport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation_transport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.transports: ~0 rows (aproximadamente)

-- Volcando estructura para tabla fopre_cafe.type_states
CREATE TABLE IF NOT EXISTS `type_states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type_state` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.type_states: ~0 rows (aproximadamente)
INSERT INTO `type_states` (`id`, `type_state`, `name`, `created_at`, `updated_at`) VALUES
	(1, '1', 'Activo', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(2, '2', 'No activo', '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(3, '3', 'Pendiente', '2023-06-15 01:25:31', '2023-06-15 01:25:31');

-- Volcando estructura para tabla fopre_cafe.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `identity_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sso_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_estado_id_foreign` (`estado_id`),
  CONSTRAINT `users_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `states` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla fopre_cafe.users: ~4 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `identity_card`, `sso_user_id`, `estado_id`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Admin', 'admindre@uniandes.edu.co', '$2y$10$.KtTAbm4ztTdtblpvuEXke8Kq1niBaSHm9MO85PxTRwBDjdpxMwiu', NULL, NULL, NULL, '123456', '', 1, '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(2, 'Aprendiz', 'Aprendiz', 'aprendiz@uniandes.edu.co', '$2y$10$vbu8apSGDVO7rq/tZEEEqOgr87DDM8bya8tPNu9PxZmaETo8Jz2Ta', NULL, NULL, NULL, '123456', '', 1, '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(3, 'Empresa', 'Empresa', 'empresa@gmail.com', '$2y$10$.h402lU/cILXXhnnyjNUq.guI75IzRDpDLZF3qRz6IBVT95RHiGJ6', NULL, NULL, NULL, '123456', '', 1, '2023-06-15 01:25:31', '2023-06-15 01:25:31'),
	(4, 'Usuario', 'Usuario', 'usuario@gmail.com', '$2y$10$UIgqyshM1dLwBsHifJVx6.djHkRf7OBPKgT1XnHrMvHdyZqRH6f8e', NULL, NULL, NULL, '123456', '', 1, '2023-06-15 01:25:31', '2023-06-15 01:25:31');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
