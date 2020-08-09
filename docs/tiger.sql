-- ------------------------------------------------------------
-- Tiger DB Schema
-- This may be used to build the Tiger database in AWS RDS.
-- ------------------------------------------------------------

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
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




SET FOREIGN_KEY_CHECKS = 1;
