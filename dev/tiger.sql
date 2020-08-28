-- ------------------------------------------------------------
-- Tiger DB Schema
-- This may be used to build the Tiger database in AWS RDS.
-- ------------------------------------------------------------

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------
-- Table structure for config
-- ---------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
    `config_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime DEFAULT NULL,
    `updated_date` datetime DEFAULT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `active` tinyint(1) DEFAULT NULL,
    `deleted` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
    `session_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `modified` int(11) DEFAULT NULL,
    `lifetime` int(11) DEFAULT NULL,
    `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `org_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `orgname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`session_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for translation
-- ----------------------------
DROP TABLE IF EXISTS `translation`;
CREATE TABLE `translation` (
    `translation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `msg_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `msg_str` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `locale` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;