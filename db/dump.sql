SET FOREIGN_KEY_CHECKS=0;
-- hr_staffing.auth_assignment definition

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.auth_item definition

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.auth_item_child definition

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.auth_rule definition

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.empresas definition

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(245) DEFAULT NULL,
  `social_name` varchar(245) DEFAULT NULL,
  `entity` int(11) DEFAULT NULL,
  `ref_int` varchar(60) DEFAULT NULL,
  `ref_ext` varchar(128) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `tms` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `datec` datetime DEFAULT NULL,
  `dateu` datetime DEFAULT NULL,
  `code` char(36) DEFAULT NULL,
  `address` varchar(245) DEFAULT NULL,
  `url` varchar(245) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `instagram` varchar(45) DEFAULT NULL,
  `phone_1` varchar(20) DEFAULT NULL,
  `phone_2` varchar(20) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `description_s` varchar(140) DEFAULT NULL,
  `description_l` text DEFAULT NULL,
  `idu` char(36) NOT NULL,
  `supplier_only` tinyint(4) DEFAULT 0,
  `slug` varchar(245) DEFAULT NULL,
  `user_owner` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.location_country definition

CREATE TABLE `location_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `official_name` varchar(150) DEFAULT NULL,
  `common_name` varchar(150) DEFAULT NULL,
  `iso_alpha2` char(2) NOT NULL,
  `iso_alpha3` char(3) NOT NULL,
  `iso_numeric` char(3) DEFAULT NULL,
  `calling_code_primary` varchar(8) DEFAULT NULL,
  `calling_codes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`calling_codes`)),
  `flag_emoji` varchar(8) DEFAULT NULL,
  `flag_svg_url` varchar(255) DEFAULT NULL,
  `flag_png_url` varchar(255) DEFAULT NULL,
  `capital` varchar(100) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `subregion` varchar(100) DEFAULT NULL,
  `currencies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`currencies`)),
  `languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`languages`)),
  `tld` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tld`)),
  `timezones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timezones`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_paises_iso_alpha2` (`iso_alpha2`),
  UNIQUE KEY `uq_paises_iso_alpha3` (`iso_alpha3`),
  KEY `idx_paises_name` (`name`),
  KEY `idx_paises_calling` (`calling_code_primary`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.novedad_opciones_dependientes definition

CREATE TABLE `novedad_opciones_dependientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campo_hijo` varchar(50) NOT NULL,
  `campo_padre` varchar(50) NOT NULL,
  `valor_padre` varchar(200) NOT NULL,
  `valor` varchar(200) NOT NULL,
  `etiqueta` varchar(200) DEFAULT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.setting definition

CREATE TABLE `setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) NOT NULL,
  `value_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value_json`)),
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_setting_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.novedad_tipo definition

CREATE TABLE `novedad_tipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_nt_empresa` (`empresa_id`),
  CONSTRAINT `fk_nt_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.novedad_tipo_campo definition

CREATE TABLE `novedad_tipo_campo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `novedad_tipo_id` int(10) unsigned NOT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  `campo_id` varchar(50) NOT NULL,
  `label` varchar(100) NOT NULL,
  `tipo_dato` varchar(30) NOT NULL,
  `requerido` tinyint(1) NOT NULL DEFAULT 0,
  `calculado` tinyint(1) NOT NULL DEFAULT 0,
  `formula` varchar(100) DEFAULT NULL,
  `max_length` smallint(6) DEFAULT NULL,
  `val_min` varchar(50) DEFAULT NULL,
  `val_max` varchar(50) DEFAULT NULL,
  `alerta_max` decimal(10,2) DEFAULT NULL,
  `fuente_opciones` varchar(50) DEFAULT NULL,
  `depende_de` varchar(50) DEFAULT NULL,
  `visible_si_campo` varchar(50) DEFAULT NULL,
  `visible_si_op` varchar(20) DEFAULT NULL,
  `visible_si_valor` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_campo_por_tipo` (`novedad_tipo_id`,`campo_id`),
  CONSTRAINT `fk_ntc_novedad_tipo` FOREIGN KEY (`novedad_tipo_id`) REFERENCES `novedad_tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.novedad_tipo_campo_opcion definition

CREATE TABLE `novedad_tipo_campo_opcion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `novedad_tipo_campo_id` int(10) unsigned NOT NULL,
  `valor` varchar(200) NOT NULL,
  `etiqueta` varchar(200) DEFAULT NULL,
  `orden` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_ntco_campo` (`novedad_tipo_campo_id`),
  CONSTRAINT `fk_ntco_campo` FOREIGN KEY (`novedad_tipo_campo_id`) REFERENCES `novedad_tipo_campo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.region definition

CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `code` varchar(12) NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` varchar(60) DEFAULT NULL,
  `parent_region_id` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_region_country_code` (`country_id`,`code`),
  KEY `idx_region_country` (`country_id`),
  KEY `idx_region_name` (`name`),
  KEY `idx_region_parent` (`parent_region_id`),
  CONSTRAINT `fk_region_country_id` FOREIGN KEY (`country_id`) REFERENCES `location_country` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_region_parent` FOREIGN KEY (`parent_region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.`user` definition

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `confirmed_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `auth_tf_key` varchar(16) DEFAULT NULL,
  `auth_tf_enabled` tinyint(1) DEFAULT 0,
  `auth_tf_type` varchar(20) DEFAULT NULL,
  `auth_tf_mobile_phone` varchar(20) DEFAULT NULL,
  `password_changed_at` int(11) DEFAULT NULL,
  `gdpr_consent` tinyint(1) DEFAULT 0,
  `gdpr_consent_date` int(11) DEFAULT NULL,
  `gdpr_deleted` tinyint(1) DEFAULT 0,
  `empresas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_user_username` (`username`),
  UNIQUE KEY `idx_user_email` (`email`),
  KEY `fk_user_empresas1_idx` (`empresas_id`),
  CONSTRAINT `fk_user_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.archivos definition

CREATE TABLE `archivos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `storage` enum('local','s3') NOT NULL DEFAULT 's3',
  `path` varchar(1024) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mime` varchar(120) DEFAULT NULL,
  `size_bytes` bigint(20) unsigned DEFAULT NULL,
  `sha256` char(64) DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_archivo_empresa` (`empresa_id`),
  KEY `idx_archivo_uploaded_by` (`uploaded_by`),
  CONSTRAINT `fk_archivo_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_archivo_uploader` FOREIGN KEY (`uploaded_by`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.area definition

CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) DEFAULT NULL,
  `user_create` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `area_padre` int(11) DEFAULT NULL,
  `empresas_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_area_user1_idx` (`user_create`),
  KEY `fk_area_area1_idx` (`area_padre`),
  KEY `fk_area_empresas1_idx` (`empresas_id`),
  CONSTRAINT `fk_area_area1` FOREIGN KEY (`area_padre`) REFERENCES `area` (`id`),
  CONSTRAINT `fk_area_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_area_user1` FOREIGN KEY (`user_create`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.city definition

CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `region_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `is_capital` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_city_country` (`country_id`),
  KEY `idx_city_region` (`region_id`),
  KEY `idx_city_name` (`name`),
  CONSTRAINT `fk_city_country_id` FOREIGN KEY (`country_id`) REFERENCES `location_country` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_city_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.novedad_concepto definition

CREATE TABLE `novedad_concepto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `novedad_tipo_id` int(10) unsigned DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `permite_masivo` tinyint(1) NOT NULL DEFAULT 0,
  `modo_masivo_ext` varchar(10) DEFAULT 'xlsx',
  `sync_temporapp` tinyint(1) NOT NULL DEFAULT 0,
  `va_a_nomina` tinyint(1) NOT NULL DEFAULT 0,
  `correo_notif` varchar(200) DEFAULT NULL,
  `tiene_handler` tinyint(1) NOT NULL DEFAULT 0,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_novedad_concepto_codigo` (`codigo`),
  KEY `idx_novedad_concepto_novedad_tipo` (`novedad_tipo_id`),
  CONSTRAINT `fk_novedad_concepto_novedad_tipo` FOREIGN KEY (`novedad_tipo_id`) REFERENCES `novedad_tipo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.novedad_flujo_paso definition

CREATE TABLE `novedad_flujo_paso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `novedad_tipo_id` int(10) unsigned NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_paso` varchar(20) NOT NULL DEFAULT 'aprobacion',
  `rol` varchar(50) DEFAULT NULL,
  `email_notif` varchar(200) DEFAULT NULL,
  `es_inicio` tinyint(1) NOT NULL DEFAULT 0,
  `siguiente_id` int(10) unsigned DEFAULT NULL,
  `siguiente_si_id` int(10) unsigned DEFAULT NULL,
  `siguiente_no_id` int(10) unsigned DEFAULT NULL,
  `condicion_campo` varchar(50) DEFAULT NULL,
  `condicion_op` varchar(20) DEFAULT NULL,
  `condicion_valor` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_nfp_novedad_tipo` (`novedad_tipo_id`),
  CONSTRAINT `fk_nfp_novedad_tipo` FOREIGN KEY (`novedad_tipo_id`) REFERENCES `novedad_tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.archivo_link definition

CREATE TABLE `archivo_link` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `archivo_id` bigint(20) unsigned NOT NULL,
  `entidad_type` enum('empleado','contrato','novedad','ss_ausentismo','nomina','otro') NOT NULL,
  `entidad_id` bigint(20) unsigned NOT NULL,
  `etiqueta` varchar(80) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_archivo_link` (`archivo_id`,`entidad_type`,`entidad_id`),
  KEY `idx_al_empresa` (`empresa_id`),
  KEY `idx_al_entidad` (`entidad_type`,`entidad_id`),
  CONSTRAINT `fk_al_archivo` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_al_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.novedad definition

CREATE TABLE `novedad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `concepto_id` int(10) unsigned NOT NULL,
  `novedad_tipo_id` int(10) unsigned NOT NULL,
  `estado` enum('borrador','pendiente','aprobada','rechazada') NOT NULL DEFAULT 'borrador',
  `datos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`datos`)),
  `schema_snapshot` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schema_snapshot`)),
  `alertas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`alertas`)),
  `paso_actual_id` int(10) unsigned DEFAULT NULL,
  `es_masivo` tinyint(1) NOT NULL DEFAULT 0,
  `lote_masivo_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_nov_empresa` (`empresa_id`),
  KEY `fk_nov_concepto` (`concepto_id`),
  KEY `fk_nov_novedad_tipo` (`novedad_tipo_id`),
  CONSTRAINT `fk_nov_concepto` FOREIGN KEY (`concepto_id`) REFERENCES `novedad_concepto` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_nov_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_nov_novedad_tipo` FOREIGN KEY (`novedad_tipo_id`) REFERENCES `novedad_tipo` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.cargos definition

CREATE TABLE `cargos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(190) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cargo_codigo` (`empresa_id`,`codigo`),
  KEY `idx_cargo_empresa` (`empresa_id`),
  CONSTRAINT `fk_cargo_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.company_setting definition

CREATE TABLE `company_setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `key` varchar(120) NOT NULL,
  `value_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_company_setting` (`empresa_id`,`key`),
  KEY `idx_company_setting_empresa` (`empresa_id`),
  CONSTRAINT `fk_company_setting_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.concepto_integracion_map definition

CREATE TABLE `concepto_integracion_map` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `provider` enum('temporapp','otro') NOT NULL DEFAULT 'temporapp',
  `concepto_id` bigint(20) unsigned NOT NULL,
  `remote_code` varchar(80) NOT NULL,
  `remote_name` varchar(190) DEFAULT NULL,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cim` (`empresa_id`,`provider`,`concepto_id`),
  KEY `idx_cim_empresa` (`empresa_id`),
  KEY `fk_cim_concepto` (`concepto_id`),
  CONSTRAINT `fk_cim_concepto` FOREIGN KEY (`concepto_id`) REFERENCES `maestros_conceptos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cim_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.contabilidad_centro_costo definition

CREATE TABLE `contabilidad_centro_costo` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(190) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_ccosto` (`empresa_id`,`codigo`),
  KEY `idx_ccosto_empresa` (`empresa_id`),
  CONSTRAINT `fk_ccosto_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.contabilidad_centro_utilidad definition

CREATE TABLE `contabilidad_centro_utilidad` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(190) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cutil` (`empresa_id`,`codigo`),
  KEY `idx_cutil_empresa` (`empresa_id`),
  CONSTRAINT `fk_cutil_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.contrato_tipos definition

CREATE TABLE `contrato_tipos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `code` varchar(50) NOT NULL,
  `nombre` varchar(190) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `requiere_fecha_fin` tinyint(1) NOT NULL DEFAULT 0,
  `es_indefinido` tinyint(1) NOT NULL DEFAULT 0,
  `duracion_dias_default` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_ctipo` (`empresa_id`,`code`),
  KEY `idx_ctipo_empresa` (`empresa_id`),
  CONSTRAINT `fk_ctipo_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.email definition

CREATE TABLE `email` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `to_email` varchar(255) NOT NULL,
  `cc_email` varchar(255) DEFAULT NULL,
  `bcc_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body_html` mediumtext NOT NULL,
  `status` enum('queued','sent','failed') NOT NULL DEFAULT 'queued',
  `provider` varchar(80) DEFAULT NULL,
  `external_id` varchar(190) DEFAULT NULL,
  `error_message` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sent_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email_empresa` (`empresa_id`),
  KEY `idx_email_status` (`status`),
  KEY `idx_email_created` (`created_at`),
  CONSTRAINT `fk_email_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.empleado_venue_history definition

CREATE TABLE `empleado_venue_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `fecha_efectiva` date NOT NULL,
  `sede_id` bigint(20) unsigned DEFAULT NULL,
  `centro_costo_id` bigint(20) unsigned DEFAULT NULL,
  `centro_utilidad_id` bigint(20) unsigned DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `actor_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_ev_emp` (`profile_id`),
  KEY `idx_ev_empresa` (`empresa_id`),
  KEY `idx_ev_fecha` (`fecha_efectiva`),
  KEY `fk_ev_sede` (`sede_id`),
  KEY `fk_ev_ccosto` (`centro_costo_id`),
  KEY `fk_ev_cutil` (`centro_utilidad_id`),
  KEY `fk_ev_actor` (`actor_user_id`),
  CONSTRAINT `fk_ev_actor` FOREIGN KEY (`actor_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_ev_ccosto` FOREIGN KEY (`centro_costo_id`) REFERENCES `contabilidad_centro_costo` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_ev_cutil` FOREIGN KEY (`centro_utilidad_id`) REFERENCES `contabilidad_centro_utilidad` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_ev_empleado` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ev_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_ev_sede` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.empresa_integration definition

CREATE TABLE `empresa_integration` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `provider` enum('temporapp','otro') NOT NULL DEFAULT 'temporapp',
  `base_url` varchar(255) NOT NULL,
  `username` varchar(190) DEFAULT NULL,
  `password_enc` varbinary(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_integration` (`empresa_id`,`provider`),
  KEY `idx_integration_empresa` (`empresa_id`),
  CONSTRAINT `fk_integration_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.empresa_webhook definition

CREATE TABLE `empresa_webhook` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `event_name` varchar(120) NOT NULL,
  `url` varchar(500) NOT NULL,
  `secret` varchar(190) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `headers_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`headers_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_webhook` (`empresa_id`,`event_name`,`url`(180)),
  KEY `idx_webhook_empresa` (`empresa_id`),
  CONSTRAINT `fk_webhook_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.integration_log definition

CREATE TABLE `integration_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `empresa_integration_id` bigint(20) unsigned NOT NULL,
  `request_id` varchar(80) DEFAULT NULL,
  `endpoint` varchar(255) DEFAULT NULL,
  `method` varchar(10) DEFAULT NULL,
  `status_code` int(11) DEFAULT NULL,
  `duration_ms` int(11) DEFAULT NULL,
  `request_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`request_json`)),
  `response_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`response_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_il_empresa` (`empresa_id`),
  KEY `idx_il_integration` (`empresa_integration_id`),
  KEY `idx_il_created` (`created_at`),
  CONSTRAINT `fk_il_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_il_integration` FOREIGN KEY (`empresa_integration_id`) REFERENCES `empresa_integration` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.location_sedes definition

CREATE TABLE `location_sedes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(190) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_sede_codigo` (`empresa_id`,`codigo`),
  KEY `idx_sede_empresa` (`empresa_id`),
  CONSTRAINT `fk_sede_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.maestros_conceptos definition

CREATE TABLE `maestros_conceptos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(190) NOT NULL,
  `category` enum('ingreso','deduccion','aporte','provision','otro') NOT NULL DEFAULT 'otro',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_concepto` (`empresa_id`,`code`),
  KEY `idx_concepto_empresa` (`empresa_id`),
  CONSTRAINT `fk_concepto_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.malla_distribucion_horas definition

CREATE TABLE `malla_distribucion_horas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `payroll_period_id` bigint(20) unsigned NOT NULL,
  `profile_id` int(11) NOT NULL,
  `sede_id` bigint(20) unsigned DEFAULT NULL,
  `cargo_id` bigint(20) unsigned DEFAULT NULL,
  `centro_costo_id` bigint(20) unsigned DEFAULT NULL,
  `centro_utilidad_id` bigint(20) unsigned DEFAULT NULL,
  `fecha` date NOT NULL,
  `horas` decimal(6,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_mdh_empresa` (`empresa_id`),
  KEY `idx_mdh_periodo` (`payroll_period_id`),
  KEY `idx_mdh_emp_fecha` (`profile_id`,`fecha`),
  KEY `fk_mdh_sede` (`sede_id`),
  KEY `fk_mdh_cargo` (`cargo_id`),
  KEY `fk_mdh_ccosto` (`centro_costo_id`),
  KEY `fk_mdh_cutil` (`centro_utilidad_id`),
  KEY `fk_mdh_user` (`created_by`),
  CONSTRAINT `fk_mdh_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_mdh_ccosto` FOREIGN KEY (`centro_costo_id`) REFERENCES `contabilidad_centro_costo` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_mdh_cutil` FOREIGN KEY (`centro_utilidad_id`) REFERENCES `contabilidad_centro_utilidad` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_mdh_emp` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_mdh_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_mdh_periodo` FOREIGN KEY (`payroll_period_id`) REFERENCES `payroll_period` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_mdh_sede` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_mdh_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.mallas definition

CREATE TABLE `mallas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(190) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo` enum('fija','rotativa') NOT NULL DEFAULT 'fija',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`config_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_malla_empresa` (`empresa_id`),
  CONSTRAINT `fk_malla_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.mallas_horarios definition

CREATE TABLE `mallas_horarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `malla_id` bigint(20) unsigned NOT NULL,
  `dia_semana` tinyint(3) unsigned NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `minutos_descanso` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_mh_malla` (`malla_id`),
  CONSTRAINT `fk_mh_malla` FOREIGN KEY (`malla_id`) REFERENCES `mallas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.nomina_item definition

CREATE TABLE `nomina_item` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `nomina_run_id` bigint(20) unsigned NOT NULL,
  `profile_id` int(11) NOT NULL,
  `concepto_id` bigint(20) unsigned NOT NULL,
  `unidades` decimal(14,4) DEFAULT NULL,
  `valor` decimal(14,2) NOT NULL,
  `detalle_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalle_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_ni_run` (`nomina_run_id`),
  KEY `idx_ni_emp` (`profile_id`),
  KEY `idx_ni_concepto` (`concepto_id`),
  KEY `fk_ni_empresa` (`empresa_id`),
  CONSTRAINT `fk_ni_concepto` FOREIGN KEY (`concepto_id`) REFERENCES `maestros_conceptos` (`id`),
  CONSTRAINT `fk_ni_emp` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ni_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_ni_run` FOREIGN KEY (`nomina_run_id`) REFERENCES `nomina_run` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.nomina_limites_legales definition

CREATE TABLE `nomina_limites_legales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`config_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nll` (`empresa_id`,`year`),
  KEY `idx_nll_empresa` (`empresa_id`),
  CONSTRAINT `fk_nll_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.nomina_retencion_impuesto definition

CREATE TABLE `nomina_retencion_impuesto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `key` varchar(120) NOT NULL,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`config_json`)),
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nri` (`empresa_id`,`year`,`key`),
  KEY `idx_nri_empresa` (`empresa_id`),
  CONSTRAINT `fk_nri_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.nomina_run definition

CREATE TABLE `nomina_run` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `payroll_period_id` bigint(20) unsigned NOT NULL,
  `status` enum('queued','running','done','failed') NOT NULL DEFAULT 'queued',
  `input_params_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`input_params_json`)),
  `started_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `triggered_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_nr_empresa` (`empresa_id`),
  KEY `idx_nr_periodo` (`payroll_period_id`),
  KEY `idx_nr_status` (`status`),
  KEY `fk_nr_user` (`triggered_by`),
  CONSTRAINT `fk_nr_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_nr_periodo` FOREIGN KEY (`payroll_period_id`) REFERENCES `payroll_period` (`id`),
  CONSTRAINT `fk_nr_user` FOREIGN KEY (`triggered_by`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.payroll_period definition

CREATE TABLE `payroll_period` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` tinyint(3) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cutoff_date` date DEFAULT NULL,
  `status` enum('pendiente_cargar','cargada_pendiente_aut','procesada','cerrada','pagada') NOT NULL DEFAULT 'pendiente_cargar',
  `generated_at` datetime DEFAULT NULL,
  `authorized_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_periodo` (`empresa_id`,`year`,`month`),
  KEY `idx_periodo_empresa` (`empresa_id`),
  KEY `idx_periodo_status` (`status`),
  CONSTRAINT `fk_periodo_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.planilla_error definition

CREATE TABLE `planilla_error` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `import_id` bigint(20) unsigned NOT NULL,
  `row_number` int(11) NOT NULL,
  `col_name` varchar(190) DEFAULT NULL,
  `error_code` varchar(50) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `raw_value` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_pe_import` (`import_id`),
  KEY `idx_pe_empresa` (`empresa_id`),
  CONSTRAINT `fk_pe_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_pe_import` FOREIGN KEY (`import_id`) REFERENCES `planilla_import` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.planilla_import definition

CREATE TABLE `planilla_import` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `payroll_period_id` bigint(20) unsigned NOT NULL,
  `template_id` bigint(20) unsigned NOT NULL,
  `archivo_id` bigint(20) unsigned NOT NULL,
  `status` enum('uploaded','validated','imported','failed') NOT NULL DEFAULT 'uploaded',
  `resumen_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`resumen_json`)),
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `processed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_pi_empresa` (`empresa_id`),
  KEY `idx_pi_periodo` (`payroll_period_id`),
  KEY `idx_pi_status` (`status`),
  KEY `fk_pi_template` (`template_id`),
  KEY `fk_pi_archivo` (`archivo_id`),
  KEY `fk_pi_user` (`created_by`),
  CONSTRAINT `fk_pi_archivo` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`),
  CONSTRAINT `fk_pi_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_pi_periodo` FOREIGN KEY (`payroll_period_id`) REFERENCES `payroll_period` (`id`),
  CONSTRAINT `fk_pi_template` FOREIGN KEY (`template_id`) REFERENCES `planilla_template` (`id`),
  CONSTRAINT `fk_pi_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.planilla_template definition

CREATE TABLE `planilla_template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `version` int(11) NOT NULL DEFAULT 1,
  `nombre` varchar(190) NOT NULL,
  `columnas_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`columnas_json`)),
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_pt_empresa` (`empresa_id`),
  CONSTRAINT `fk_pt_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.profile definition

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `tipo_doc` enum('CC','CE','NIT','PAS','TI','OTRO') NOT NULL DEFAULT 'CC',
  `num_doc` varchar(40) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `sexo` enum('M','F','X') DEFAULT NULL,
  `empresas_id` int(11) NOT NULL,
  `about` text DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `telefono` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `position` varchar(245) DEFAULT NULL,
  `photo_` varchar(245) DEFAULT NULL,
  `instagram` varchar(145) DEFAULT NULL,
  `tiktok` varchar(145) DEFAULT NULL,
  `linkedin` varchar(145) DEFAULT NULL,
  `youtube` varchar(145) DEFAULT NULL,
  `website` varchar(145) DEFAULT NULL,
  `address` varchar(145) DEFAULT NULL,
  `data_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_json`)),
  `sede_id` bigint(20) unsigned DEFAULT NULL,
  `cargo_id` bigint(20) unsigned DEFAULT NULL,
  `centro_costo_id` bigint(20) unsigned DEFAULT NULL,
  `centro_utilidad_id` bigint(20) unsigned DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_profile_empresas1_idx` (`empresas_id`),
  KEY `fk_profile_area1_idx` (`area_id`),
  KEY `fk_empleado_sede` (`sede_id`),
  KEY `fk_empleado_cargo` (`cargo_id`),
  KEY `fk_empleado_ccosto` (`centro_costo_id`),
  KEY `fk_empleado_cutil` (`centro_utilidad_id`),
  CONSTRAINT `fk_empleado_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_empleado_ccosto` FOREIGN KEY (`centro_costo_id`) REFERENCES `contabilidad_centro_costo` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_empleado_cutil` FOREIGN KEY (`centro_utilidad_id`) REFERENCES `contabilidad_centro_utilidad` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_empleado_sede` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_profile_area1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  CONSTRAINT `fk_profile_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- hr_staffing.profile_eventos_log definition

CREATE TABLE `profile_eventos_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `event_type` varchar(120) NOT NULL,
  `entity_type` varchar(80) DEFAULT NULL,
  `entity_id` bigint(20) unsigned DEFAULT NULL,
  `actor_user_id` int(11) DEFAULT NULL,
  `before_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`before_json`)),
  `after_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`after_json`)),
  `contexto_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contexto_json`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_evt_emp` (`profile_id`),
  KEY `idx_evt_empresa` (`empresa_id`),
  KEY `idx_evt_created` (`created_at`),
  KEY `idx_evt_entity` (`entity_type`,`entity_id`),
  KEY `fk_evt_actor` (`actor_user_id`),
  CONSTRAINT `fk_evt_actor` FOREIGN KEY (`actor_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_evt_empleado` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_evt_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- hr_staffing.profile_salarios definition

CREATE TABLE `profile_salarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `fecha_efectiva` date NOT NULL,
  `salario_base` decimal(14,2) NOT NULL,
  `moneda` char(3) NOT NULL DEFAULT 'COP',
  `motivo` varchar(255) DEFAULT NULL,
  `actor_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_salario_emp` (`profile_id`),
  KEY `idx_salario_empresa` (`empresa_id`),
  KEY `idx_salario_fecha` (`fecha_efectiva`),
  KEY `fk_salario_actor` (`actor_user_id`),
  CONSTRAINT `fk_salario_actor` FOREIGN KEY (`actor_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_salario_empleado` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_salario_empresa` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;