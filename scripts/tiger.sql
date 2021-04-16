/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 - 2021 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */



SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acl_resource
-- ----------------------------
DROP TABLE IF EXISTS `acl_resource`;
CREATE TABLE `acl_resource` (
    `resource_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `module_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
    `resource_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `resource_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `resource` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `privilege` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`resource_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for acl_role
-- ----------------------------
DROP TABLE IF EXISTS `acl_role`;
CREATE TABLE `acl_role` (
    `role_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `priority` int(11) DEFAULT NULL,
    `role_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `parent_role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `role_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime DEFAULT NULL,
    `update_date` datetime DEFAULT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `active` tinyint(1) DEFAULT NULL,
    `deleted` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for acl_rule
-- ----------------------------
DROP TABLE IF EXISTS `acl_rule`;
CREATE TABLE `acl_rule` (
    `rule_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `priority` int(11) DEFAULT NULL,
    `rule_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `rule_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `permission` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `resource` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `privilege` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `assertion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime DEFAULT NULL,
    `update_date` datetime DEFAULT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `active` tinyint(1) DEFAULT NULL,
    `deleted` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`rule_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
    `address_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `type_address` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Suite #, Floor #, etc.',
    `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `county` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `country` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `postal_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `ip_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'System Setting - Can be used for geo-location',
    `lat` decimal(12,8) DEFAULT NULL,
    `lng` decimal(12,8) DEFAULT NULL,
    `primary` tinyint(1) unsigned DEFAULT NULL,
    `create_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) DEFAULT NULL,
    `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`address_id`) USING BTREE,
    KEY `lat` (`lat`) USING BTREE,
    KEY `lng` (`lng`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
    `config_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime DEFAULT NULL,
    `update_date` datetime DEFAULT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `active` tinyint(1) DEFAULT NULL,
    `deleted` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
    `contact_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `type_contact` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'EMAIL, PHONE, WEB, ...',
    `contact_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Value: me@you.com, 1234567890, www.domain.com, ...',
    `primary` tinyint(1) unsigned NOT NULL,
    `create_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT 'Option to disable',
    `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`contact_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
    `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
    `code_3` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `code_numeric` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `sort` int(11) DEFAULT NULL,
    `name_en` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `name_es` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `name_fr` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for doc
-- ----------------------------
DROP TABLE IF EXISTS `doc`;
CREATE TABLE `doc` (
    `doc_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'UUID v1',
    `parent_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'UUID v1',
    `title` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `thumbnail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime NOT NULL DEFAULT current_timestamp(),
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinytext CHARACTER SET utf8mb4 NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`doc_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for log_application
-- ----------------------------
DROP TABLE IF EXISTS `log_application`;
CREATE TABLE `log_application` (
    `log_application_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `source` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `priority` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `timestamp` datetime(6) NOT NULL,
    `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`log_application_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
    `login_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `session_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `login_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Set if a successful username or email found.',
    `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Set if a successful username or email found.',
    `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hashed',
    `lat` float(12,8) DEFAULT NULL,
    `lng` float(12,8) DEFAULT NULL,
    `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `login_datetime` datetime DEFAULT NULL,
    `logout_datetime` datetime DEFAULT NULL COMMENT 'Set only if the user actively logs out.',
    `warning_level` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
    `media_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `type_storage` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'FILE, S3',
    `media_folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `bucket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'S3',
    `prefix_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `original_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `full_file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `extension` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `caption_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `public_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `height` smallint(6) DEFAULT NULL,
    `width` smallint(6) DEFAULT NULL,
    `size` int(11) DEFAULT NULL,
    `upload_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime DEFAULT NULL,
    `update_date` datetime DEFAULT NULL,
    `active` tinyint(1) DEFAULT NULL,
    `deleted` tinyint(1) DEFAULT NULL,
    PRIMARY KEY (`media_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for org
-- ----------------------------
DROP TABLE IF EXISTS `org`;
CREATE TABLE `org` (
    `org_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `parent_org_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `orgname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `org_display_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `org_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `domain` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `referral_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `type_org` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key',
    `type_hearabout` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key',
    `type_business` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key',
    `referral_org_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `referral_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_date` datetime NOT NULL COMMENT 'System Setting',
    `update_date` datetime NOT NULL COMMENT 'System Setting',
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'System Setting',
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'System Setting',
    `create_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'System Setting',
    `update_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'System Setting',
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`org_id`) USING BTREE,
    UNIQUE KEY `orgname` (`orgname`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for org_address
-- ----------------------------
DROP TABLE IF EXISTS `org_address`;
CREATE TABLE `org_address` (
    `org_address_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `org_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`org_address_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for org_contact
-- ----------------------------
DROP TABLE IF EXISTS `org_contact`;
CREATE TABLE `org_contact` (
    `org_contact_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `org_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `contact_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`org_contact_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Org Contact Linking Table';

-- ----------------------------
-- Table structure for org_user
-- ----------------------------
DROP TABLE IF EXISTS `org_user`;
CREATE TABLE `org_user` (
    `org_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `org_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`org_user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Org User Linking Table';

-- ----------------------------
-- Table structure for package
-- ----------------------------
DROP TABLE IF EXISTS `package`;
CREATE TABLE `package` (
    `package_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This comes from the root composer.json file, vendor/package, and should be unique.',
    `target_version` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This comes from the root composer.json file.',
    `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This comes from the package''s composer.json file.',
    `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'This comes from the package''s composer.json file.',
    `required` tinyint(1) DEFAULT NULL COMMENT 'This comes from core module config.',
    `version` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The current version installed as reported by Composer.',
    `latest` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The latest version as reported by Composer.',
    `repo_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'If this is empty, then it''s a Packagist repo',
    `repo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'If this is empty, then it''s a Packagist repo',
    `create_date` datetime NOT NULL,
    `update_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) NOT NULL COMMENT 'Active means it''s been copied to the module''s direcotry. Inactive means it''s been removed.',
    `deleted` tinyint(1) NOT NULL COMMENT 'Not used.',
    PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
    `page_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Page Id as UUID v1',
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Page Name',
    `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'page | layout | partial | blog',
    `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Category name or id',
    `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The URL expressed as file-name-as-key',
    `theme` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Module Theme',
    `scheme` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Theme color scheme',
    `layout` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Module Theme Layout',
    `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Page Title',
    `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'HTML Content of the page',
    `locale` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'en, en_US, es, es_MX, etc.',
    `options` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Theme and Layout options JSON',
    `links` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Head Links JSON',
    `headScripts` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Head JS Scripts',
    `inlineScripts` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Inline JS Scripts',
    `meta` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Head Meta JSON',
    `styles` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Raw CSS Styles <style>',
    `scripts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Raw JS Scripts <script>',
    `create_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`page_id`) USING BTREE,
    UNIQUE KEY `KEY_UNIQUE` (`key`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
    `question_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `locale` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`question_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
    `session_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `save_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
    `message_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Translation Key',
    `message_text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Translation Text',
    `locale` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_date` datetime NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
    `type_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `reference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user, org, address, etc.',
    `key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'The key is an immutable reference that doesn''t change between languages and can be sent as a field name.',
    `type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `sort_order` tinyint(4) NOT NULL,
    `default` tinyint(1) NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`type_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for us_zip_code
-- ----------------------------
DROP TABLE IF EXISTS `us_zip_code`;
CREATE TABLE `us_zip_code` (
    `zip_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
    `lat` decimal(12,8) DEFAULT NULL,
    `lng` decimal(12,8) DEFAULT NULL,
    `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `state` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `county` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `country` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`zip_code`) USING BTREE,
    KEY `zip_code` (`zip_code`) USING BTREE,
    KEY `city` (`city`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A time-based UUID',
    `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Hashed password',
    `password_reset_key` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A time-based UUID / System Setting',
    `role` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verify_key` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A time-based UUID / System Setting',
    `user_display_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `type_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key',
    `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `type_suffix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key',
    `company_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `locale_preference` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'System Setting',
    `referral_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `referral_org_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `type_hearabout` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key',
    `type_question_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key UUID',
    `answer_1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hashed answer',
    `type_question_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key UUID',
    `answer_2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hashed answer',
    `type_question_3` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'A type key UUID',
    `answer_3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Hashed answer',
    `last_login_date` datetime DEFAULT NULL COMMENT 'System Setting',
    `last_login_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'System Setting',
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'System Setting',
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'System Setting',
    `create_date` datetime NOT NULL COMMENT 'System Setting',
    `update_date` datetime NOT NULL COMMENT 'System Setting',
    `create_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'System Setting',
    `update_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'System Setting',
    `active` tinyint(1) unsigned NOT NULL DEFAULT 0,
    `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`user_id`) USING BTREE,
    UNIQUE KEY `email` (`email`) USING BTREE,
    UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
    `user_address_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`user_address_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for user_contact
-- ----------------------------
DROP TABLE IF EXISTS `user_contact`;
CREATE TABLE `user_contact` (
    `user_contact_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `contact_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `create_date` datetime NOT NULL,
    `update_user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `update_date` datetime NOT NULL,
    `active` tinyint(1) NOT NULL,
    `deleted` tinyint(1) NOT NULL,
    PRIMARY KEY (`user_contact_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='User Contact Linking Table';

SET FOREIGN_KEY_CHECKS = 1;
