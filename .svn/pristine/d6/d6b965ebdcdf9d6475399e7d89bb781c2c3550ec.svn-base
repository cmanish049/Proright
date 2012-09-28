/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : proright

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-08-30 14:58:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `auth_modules`
-- ----------------------------
DROP TABLE IF EXISTS `auth_modules`;
CREATE TABLE `auth_modules` (
  `MODULE_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `MODULE_CODE` varchar(50) NOT NULL,
  `MODULE_NAME` varchar(255) NOT NULL,
  `MODULE_SINGLE_LABEL` varchar(255) NOT NULL,
  `MODULE_PLURAL_LABEL` varchar(255) DEFAULT NULL,
  `PARENT_ID` tinyint(4) DEFAULT NULL,
  `MODULE_URL` varchar(255) DEFAULT NULL,
  `ACTIVE` enum('yes','no') NOT NULL DEFAULT 'yes',
  `SHOW_IN_MENU` enum('yes','no') NOT NULL DEFAULT 'yes',
  `SHOW_IN_FORM` enum('yes','no') NOT NULL DEFAULT 'yes',
  `SEQUENCE_NUMBER` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`MODULE_ID`),
  UNIQUE KEY `modul_kodu` (`MODULE_CODE`) USING BTREE,
  KEY `modul_durumu` (`ACTIVE`),
  KEY `menude_goster` (`SHOW_IN_MENU`),
  KEY `formda_goster` (`SHOW_IN_FORM`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_modules
-- ----------------------------
INSERT INTO `auth_modules` VALUES ('8', 'auth_module', 'Module', 'Module', 'Modules', null, 'auth_module/', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('9', 'user', 'User', 'User', 'Users', '0', 'user/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('10', 'country', 'Country', 'Country', 'Countries', '0', 'country/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('11', 'city', 'City', 'City', 'Cities', '10', 'city/index', 'yes', 'yes', 'yes', '0');

-- ----------------------------
-- Table structure for `auth_ug_module_relationship`
-- ----------------------------
DROP TABLE IF EXISTS `auth_ug_module_relationship`;
CREATE TABLE `auth_ug_module_relationship` (
  `MODULE_ID` int(5) unsigned NOT NULL DEFAULT '0',
  `GROUP_ID` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`MODULE_ID`,`GROUP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_ug_module_relationship
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_ug_user_relationship`
-- ----------------------------
DROP TABLE IF EXISTS `auth_ug_user_relationship`;
CREATE TABLE `auth_ug_user_relationship` (
  `GROUP_ID` int(5) unsigned NOT NULL DEFAULT '0',
  `USER_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`GROUP_ID`,`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_ug_user_relationship
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_groups`;
CREATE TABLE `auth_user_groups` (
  `GROUP_ID` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `GROUP_NAME` varchar(255) NOT NULL DEFAULT '',
  `ACTIVE` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`GROUP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_user_groups
-- ----------------------------

-- ----------------------------
-- Table structure for `cities`
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `CITY_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CITY_NAME` varchar(255) NOT NULL,
  `COUNTRY_ID` bigint(20) unsigned DEFAULT NULL,
  `STATE_ID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`CITY_ID`),
  KEY `CITY_NAME` (`CITY_NAME`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`),
  KEY `STATE_ID` (`STATE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO `cities` VALUES ('2', 'Istanbul', '1', '0');
INSERT INTO `cities` VALUES ('4', 'Ankara', '1', '0');

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `COUNTRY_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `COUNTRY_NAME` varchar(200) NOT NULL,
  PRIMARY KEY (`COUNTRY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Turkey');

-- ----------------------------
-- Table structure for `courts`
-- ----------------------------
DROP TABLE IF EXISTS `courts`;
CREATE TABLE `courts` (
  `COURT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `COURT_NAME` varchar(255) NOT NULL,
  `LAW_TYPE_ID` int(10) unsigned DEFAULT NULL COMMENT 'MATTERS tablosundaki "MATTER_TYPE_ID" alanın beslendiği MATTER_TYPES tablosundan beslenir',
  `COUNTRY_ID` bigint(20) unsigned DEFAULT NULL,
  `MAILING_STATE_ID` bigint(20) unsigned DEFAULT NULL,
  `MAILING_CITY_ID` bigint(20) unsigned DEFAULT NULL,
  `MAILING_ZIP_CODE_ID` bigint(20) unsigned DEFAULT NULL,
  `MAILING_ADDRESS` varchar(255) DEFAULT NULL,
  `STREET_STATE_ID` bigint(20) unsigned DEFAULT NULL,
  `STREET_CITY_ID` bigint(20) unsigned DEFAULT NULL,
  `STREET_ZIP_CODE_ID` bigint(20) unsigned DEFAULT NULL,
  `STREET_ADDRESS` varchar(255) DEFAULT NULL,
  `BRANCH` text,
  `DIVISION` text,
  `DEPARTMENT` text,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE1` varchar(30) DEFAULT NULL,
  `PHONE2` varchar(30) DEFAULT NULL,
  `PHONE3` varchar(30) DEFAULT NULL,
  `FAX` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`COURT_ID`),
  KEY `COURT_NAME` (`COURT_NAME`),
  KEY `LAW_TYPE_ID` (`LAW_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courts
-- ----------------------------

-- ----------------------------
-- Table structure for `email_sendings`
-- ----------------------------
DROP TABLE IF EXISTS `email_sendings`;
CREATE TABLE `email_sendings` (
  `EMAIL_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `MATTER_ID` bigint(20) unsigned DEFAULT NULL,
  `USER_ID` bigint(20) unsigned DEFAULT NULL,
  `EMAIL_TO` varchar(255) NOT NULL,
  `EMAIL_CC` varchar(255) DEFAULT NULL,
  `EMAIL_BCC` varchar(255) DEFAULT NULL,
  `EMAIL_BODY` text NOT NULL,
  `SUCCESSFUL` tinyint(4) DEFAULT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`EMAIL_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `EMAIL_TO` (`EMAIL_TO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of email_sendings
-- ----------------------------

-- ----------------------------
-- Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `EVENT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CATEGORY_ID` bigint(20) unsigned NOT NULL,
  `EVENT_DATETIME` datetime DEFAULT NULL,
  `END_DATETIME` datetime DEFAULT NULL,
  `DESCRIPTION` text,
  `LOCATION_ID` bigint(20) unsigned DEFAULT NULL,
  `WITH_ID` bigint(20) unsigned DEFAULT NULL,
  `MATTER_ID` bigint(20) unsigned DEFAULT NULL,
  `PRIORITY_ID` tinyint(3) unsigned DEFAULT NULL,
  `EVENT_STATUS_ID` tinyint(3) unsigned DEFAULT NULL,
  `PRIVATE` tinyint(3) unsigned DEFAULT NULL,
  `REMINDER1_WITH` tinyint(3) unsigned DEFAULT NULL,
  `REMINDER1_DATE` datetime DEFAULT NULL,
  `REMINDER2_WITH` tinyint(3) unsigned DEFAULT NULL,
  `REMINDER2_DATE` datetime DEFAULT NULL,
  `REMINDER3_WITH` tinyint(3) unsigned DEFAULT NULL,
  `REMINDER3_DATE` datetime DEFAULT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`EVENT_ID`),
  KEY `EVENT_CATEGORY_ID` (`CATEGORY_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `WITH_ID` (`WITH_ID`),
  KEY `PRIORITY_ID` (`PRIORITY_ID`),
  KEY `EVENT_STATUS_ID` (`EVENT_STATUS_ID`),
  KEY `PRIVATE` (`PRIVATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events
-- ----------------------------

-- ----------------------------
-- Table structure for `event_categories`
-- ----------------------------
DROP TABLE IF EXISTS `event_categories`;
CREATE TABLE `event_categories` (
  `CATEGORY_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CATEGORY_NAME` varchar(100) NOT NULL,
  `CATEGORY_COLOR` varchar(10) DEFAULT NULL,
  `ICON_PATH` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CATEGORY_ID`),
  KEY `CATEGORY_NAME` (`CATEGORY_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `locations`
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `LOCATION_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `LOCATION_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`LOCATION_ID`),
  KEY `LOCATION_NAME` (`LOCATION_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of locations
-- ----------------------------

-- ----------------------------
-- Table structure for `matters`
-- ----------------------------
DROP TABLE IF EXISTS `matters`;
CREATE TABLE `matters` (
  `MATTER_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `MATTER_TYPE_ID` int(10) unsigned NOT NULL,
  `UNIQUE_KEY` varchar(50) DEFAULT NULL,
  `SUBJECT` varchar(255) NOT NULL,
  `FILE_OR_CASE_NUMBER` varchar(15) NOT NULL,
  `ATTORNEY_ID` bigint(20) unsigned DEFAULT NULL,
  `COURT_ID` bigint(20) unsigned DEFAULT NULL,
  `DESCRIPTION` text,
  `OPEN_DATE` datetime DEFAULT NULL,
  `CLOSE_DATE` datetime DEFAULT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`MATTER_ID`),
  KEY `UNIQUE_KEY` (`UNIQUE_KEY`),
  KEY `SUBJECT` (`SUBJECT`),
  KEY `FILE_OR_CASE_NUMBER` (`FILE_OR_CASE_NUMBER`),
  KEY `MATTER_TYPE_ID` (`MATTER_TYPE_ID`),
  KEY `ATTORNEY_ID` (`ATTORNEY_ID`),
  KEY `COURT_ID` (`COURT_ID`),
  KEY `OPEN_DATE` (`OPEN_DATE`),
  KEY `CLOSE_DATE` (`CLOSE_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matters
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_documents`
-- ----------------------------
DROP TABLE IF EXISTS `matter_documents`;
CREATE TABLE `matter_documents` (
  `DOC_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `DOC_PATH` varchar(255) NOT NULL,
  `DOC_NAME` varchar(255) NOT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned DEFAULT NULL,
  `DOC_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `AUTHOR` varchar(255) DEFAULT NULL,
  `DOC_STATUS_ID` int(10) unsigned DEFAULT NULL,
  `DESCRIPTION` text,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`DOC_ID`),
  KEY `DOC_NAME` (`DOC_NAME`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`),
  KEY `DOC_TYPE_ID` (`DOC_TYPE_ID`),
  KEY `DOC_STATUS_ID` (`DOC_STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_documents
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_doc_status`
-- ----------------------------
DROP TABLE IF EXISTS `matter_doc_status`;
CREATE TABLE `matter_doc_status` (
  `DOC_STATUS_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `DOC_STATUS_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`DOC_STATUS_ID`),
  KEY `DOC_STATUS_NAME` (`DOC_STATUS_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_doc_status
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_doc_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_doc_types`;
CREATE TABLE `matter_doc_types` (
  `DOC_TYPE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `DOC_TYPE_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`DOC_TYPE_ID`),
  KEY `DOC_TYPE_NAME` (`DOC_TYPE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_doc_types
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_exhibits`
-- ----------------------------
DROP TABLE IF EXISTS `matter_exhibits`;
CREATE TABLE `matter_exhibits` (
  `EXHIBIT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `EXHIBIT_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned DEFAULT NULL,
  `EXHIBIT_DOX_ID` bigint(20) unsigned DEFAULT NULL,
  `ACQUIRED_DATE` datetime DEFAULT NULL,
  `DEPOSITION_NUMBER` varchar(20) DEFAULT NULL,
  `TRIAL_NUMBER` varchar(20) DEFAULT NULL,
  `OFFERING_PARTY` varchar(30) DEFAULT NULL,
  `DESCRIPTION` text,
  `BATES_BEGIN` varchar(20) DEFAULT NULL,
  `BATES_END` varchar(20) DEFAULT NULL,
  `AUTHOR` varchar(40) DEFAULT NULL,
  `SIGNATORY` varchar(40) DEFAULT NULL,
  `IDENTIFIED_DATE` datetime DEFAULT NULL,
  `ADMITTED_DATE` datetime DEFAULT NULL,
  `IS_KEY_EXHIBIT` tinyint(4) DEFAULT NULL,
  `EXHIBIT_STATUS_ID` int(11) DEFAULT NULL,
  `VALUE_ID` int(11) DEFAULT NULL,
  `ANALYSIS` text,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`EXHIBIT_ID`),
  KEY `EXHIBIT_TYPE_ID` (`EXHIBIT_TYPE_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`),
  KEY `IS_KEY_EXHIBIT` (`IS_KEY_EXHIBIT`),
  KEY `STATUS_ID` (`EXHIBIT_STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_exhibits
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_exhibit_status`
-- ----------------------------
DROP TABLE IF EXISTS `matter_exhibit_status`;
CREATE TABLE `matter_exhibit_status` (
  `EXHIBIT_STATUS_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EXHIBIT_STATUS_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`EXHIBIT_STATUS_ID`),
  KEY `EXHIBIT_STATUS_NAME` (`EXHIBIT_STATUS_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_exhibit_status
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_exhibit_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_exhibit_types`;
CREATE TABLE `matter_exhibit_types` (
  `EXHIBIT_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EXHIBIT_TYPE_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`EXHIBIT_TYPE_ID`),
  KEY `EXHIBIT_TYPE_NAME` (`EXHIBIT_TYPE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_exhibit_types
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_facts`
-- ----------------------------
DROP TABLE IF EXISTS `matter_facts`;
CREATE TABLE `matter_facts` (
  `FACT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `FACT_TYPE_ID` bigint(20) unsigned NOT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `DESCRIPTION` text,
  `SOURCE` text,
  `ISSUE` text,
  `AUTHOR` varchar(40) DEFAULT NULL,
  `SIGNATORY` varchar(40) DEFAULT NULL,
  `IS_KEY_FACT` tinyint(4) DEFAULT NULL,
  `FACT_STATUS_ID` int(10) unsigned DEFAULT NULL,
  `VALUE_ID` int(10) unsigned DEFAULT NULL,
  `ANALYSIS` text,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`FACT_ID`),
  KEY `FACT_TYPE_ID` (`FACT_TYPE_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_facts
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_fact_status`
-- ----------------------------
DROP TABLE IF EXISTS `matter_fact_status`;
CREATE TABLE `matter_fact_status` (
  `FACT_STATUS_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FACT_STATUS_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`FACT_STATUS_ID`),
  KEY `FACT_STATUS_NAME` (`FACT_STATUS_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_fact_status
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_fact_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_fact_types`;
CREATE TABLE `matter_fact_types` (
  `FACT_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FACT_TYPE_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`FACT_TYPE_ID`),
  KEY `FACT_TYPE_NAME` (`FACT_TYPE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_fact_types
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_linked_clients`
-- ----------------------------
DROP TABLE IF EXISTS `matter_linked_clients`;
CREATE TABLE `matter_linked_clients` (
  `LINKED_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `LINK_TYPE_ID` int(10) unsigned NOT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned NOT NULL,
  `DESCRIPTION` text,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`LINKED_ID`),
  KEY `LINK_TYPE_ID` (`LINK_TYPE_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_linked_clients
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_linked_client_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_linked_client_types`;
CREATE TABLE `matter_linked_client_types` (
  `LINKED_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LINKED_TYPE_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`LINKED_TYPE_ID`),
  KEY `LINKED_TYPE_NAME` (`LINKED_TYPE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_linked_client_types
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_notes`
-- ----------------------------
DROP TABLE IF EXISTS `matter_notes`;
CREATE TABLE `matter_notes` (
  `NOTE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `NOTE_TYPE_ID` int(11) NOT NULL,
  `NOTE_DATE` datetime NOT NULL,
  `DESCRIPTION` text,
  `PHONE` varchar(30) DEFAULT NULL,
  `MINUTE` int(10) unsigned DEFAULT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned DEFAULT NULL,
  `OPERATOR_ID` bigint(20) unsigned NOT NULL,
  `IS_PRIVATE` tinyint(3) unsigned NOT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UDPATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`NOTE_ID`),
  KEY `NOTE_TYPE_ID` (`NOTE_TYPE_ID`),
  KEY `NOTE_DATE` (`NOTE_DATE`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`),
  KEY `IS_PRIVATE` (`IS_PRIVATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_notes
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_note_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_note_types`;
CREATE TABLE `matter_note_types` (
  `NOTE_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NOTE_TYPE_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`NOTE_TYPE_ID`),
  KEY `NOTE_TYPE_NAME` (`NOTE_TYPE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_note_types
-- ----------------------------

-- ----------------------------
-- Table structure for `matter_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_types`;
CREATE TABLE `matter_types` (
  `MATTER_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MATTER_TYPE_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`MATTER_TYPE_ID`),
  KEY `MATTER_TYPE_NAME` (`MATTER_TYPE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_types
-- ----------------------------

-- ----------------------------
-- Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `OPTION_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `OPTION_NAME` varchar(255) NOT NULL,
  `OPTION_VALUE` longtext NOT NULL,
  `AUTOLOAD` enum('yes','no') NOT NULL DEFAULT 'yes',
  `LANGUAGE_ID` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`OPTION_ID`),
  UNIQUE KEY `ayar` (`OPTION_NAME`) USING BTREE,
  KEY `language_id` (`LANGUAGE_ID`),
  KEY `autoload` (`AUTOLOAD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------

-- ----------------------------
-- Table structure for `sample`
-- ----------------------------
DROP TABLE IF EXISTS `sample`;
CREATE TABLE `sample` (
  `COUNTRY_ID` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `COUNTRY_NAME` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `COUNTRY_SEO` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`COUNTRY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- ----------------------------
-- Records of sample
-- ----------------------------
INSERT INTO `sample` VALUES ('235', 'Deneme', '', null);
INSERT INTO `sample` VALUES ('236', 'Deneme 2', '', null);
INSERT INTO `sample` VALUES ('237', 'Deneme 3', '', null);

-- ----------------------------
-- Table structure for `states`
-- ----------------------------
DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `STATE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `STATE_NAME` varchar(255) NOT NULL,
  `COUNTRY_ID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`STATE_ID`),
  KEY `STATE_NAME` (`STATE_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of states
-- ----------------------------

-- ----------------------------
-- Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `STATUS_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `STATUS_NAME` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `STATUS_TYPE` varchar(30) NOT NULL,
  PRIMARY KEY (`STATUS_ID`),
  KEY `STATUS_NAME` (`STATUS_NAME`),
  KEY `IS_ACTIVE` (`IS_ACTIVE`),
  KEY `STATUS_TYPE` (`STATUS_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `USER_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `USER_TYPE_ID` tinyint(3) unsigned NOT NULL,
  `UNIQUE_KEY` varchar(100) DEFAULT '0',
  `IS_ADMIN` tinyint(4) DEFAULT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(30) DEFAULT NULL,
  `LAST_NAME` varchar(30) DEFAULT NULL,
  `FULL_NAME` varchar(60) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` varchar(50) DEFAULT NULL,
  `DAY_PHONE` varchar(50) DEFAULT NULL,
  `EVENING_PHONE` varchar(50) DEFAULT NULL,
  `MOBILE` varchar(50) DEFAULT NULL,
  `FAX` varchar(50) DEFAULT NULL,
  `ADDRESS` text,
  `GENDER` varchar(10) DEFAULT NULL,
  `COUNTRY_ID` bigint(20) unsigned DEFAULT NULL,
  `STATE_ID` bigint(20) unsigned DEFAULT NULL,
  `CITY_ID` bigint(20) unsigned DEFAULT NULL,
  `ZIP_CODE_ID` bigint(20) unsigned DEFAULT NULL,
  `ATTORNEY_ID` bigint(20) unsigned DEFAULT NULL,
  `DATE_OF_RECORD` datetime DEFAULT NULL,
  `REFERRED_BY` varchar(100) DEFAULT NULL,
  `ACTIVE` tinyint(1) DEFAULT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for `user_notes`
-- ----------------------------
DROP TABLE IF EXISTS `user_notes`;
CREATE TABLE `user_notes` (
  `NOTE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` bigint(20) unsigned DEFAULT NULL,
  `NOTE_TITLE` varchar(255) DEFAULT NULL,
  `NOTE_BODY` text NOT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`NOTE_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_notes
-- ----------------------------

-- ----------------------------
-- Table structure for `user_types`
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `PERSON_TYPE_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `PERSON_TYPE_NAME` varchar(100) NOT NULL,
  `ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`PERSON_TYPE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_types
-- ----------------------------

-- ----------------------------
-- Table structure for `zip_codes`
-- ----------------------------
DROP TABLE IF EXISTS `zip_codes`;
CREATE TABLE `zip_codes` (
  `ZIP_CODE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ZIP_CODE` varchar(50) NOT NULL,
  `AREA_CODE` varchar(50) DEFAULT NULL,
  `COUNTRY_ID` bigint(20) unsigned DEFAULT NULL,
  `STATE_ID` bigint(20) unsigned DEFAULT NULL,
  `CITY_ID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`ZIP_CODE_ID`),
  KEY `ZIP_CODE` (`ZIP_CODE`),
  KEY `AREA_CODE` (`AREA_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zip_codes
-- ----------------------------
