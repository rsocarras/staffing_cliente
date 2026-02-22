CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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


CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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






CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `empresas_id` int(11) NOT NULL,
  `about` text DEFAULT NULL,
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
  `city` varchar(45) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_profile_empresas1_idx` (`empresas_id`),
  KEY `fk_profile_area1_idx` (`area_id`),
  CONSTRAINT `fk_profile_area1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  CONSTRAINT `fk_profile_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

