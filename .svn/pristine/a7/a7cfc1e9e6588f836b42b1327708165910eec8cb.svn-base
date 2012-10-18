/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : proright

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-10-18 12:08:16
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_modules
-- ----------------------------
INSERT INTO `auth_modules` VALUES ('8', 'auth_module', 'Module', 'Module', 'Modules', null, 'auth_module/', 'yes', 'no', 'no', null);
INSERT INTO `auth_modules` VALUES ('9', 'user', 'User', 'User', 'Users', '14', 'user/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('10', 'country', 'Country', 'Country', 'Countries', '14', 'country/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('11', 'city', 'City', 'City', 'Cities', '14', 'city/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('12', 'state', 'State', 'State', 'States', '14', 'state/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('13', 'zip_code', 'Zip Code', 'Zip Code', 'Zip Codes', '14', 'zip_code/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('14', 'menu_item_defination', 'Defination', 'Defination', 'Definations', '0', '', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('15', 'location', 'Location', 'Location', 'Locations', '14', 'location/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('16', 'menu_item_status_definations', 'Status', 'Status', 'Status', '14', '', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('17', 'matter_doc_status', 'Document Status', 'Document Status', 'Document Status', '16', 'status/index/?status_type=matter_doc_status', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('18', 'matter_exhibit_status', 'Exhibit Status', 'Exhibit Status', 'Exhibit Status', '16', 'status/index/?status_type=matter_exhibit_status', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('19', 'matter_fact_status', 'Fact Status', 'Fact Status', 'Fact Status', '16', 'status/index/?status_type=matter_fact_status', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('20', 'matter_doc_type', 'Document Type', 'Document Type', 'Document Types', '14', 'matter_doc_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('21', 'matter_exhibit_type', 'Exhibit Type', 'Exhibit Type', 'Exhibit Types', '14', 'matter_exhibit_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('23', 'matter_fact_type', 'Fact Type', 'Fact Type', 'Fact Types', '14', 'matter_fact_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('24', 'matter_linked_client_type', 'Linked Client Type', 'Linked Client Type', 'Linked Client Types', '14', 'matter_linked_client_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('25', 'matter_note_type', 'Matter Note Type', 'Matter Note Type', 'Matter Note Types', '14', 'matter_note_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('26', 'matter_type', 'Matter Type', 'Matter Type', 'Matter Types', '14', 'matter_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('27', 'user_type', 'User Type', 'User Type', 'User Types', '14', 'user_type/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('28', 'developer', 'For Developers', 'For Developers', 'For Developers', null, 'developer/index', 'yes', 'yes', 'no', '100');
INSERT INTO `auth_modules` VALUES ('29', 'matter', 'Matter', 'Matter', 'Matters', null, 'matter/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('30', 'matter_linked_client', 'Linked Client', 'Linked Client', 'Linked Clients', '29', 'matter_linked_client/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('31', 'matter_note', 'Matter Note', 'Matter Note', 'Matter Notes', '29', 'matter_note/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('32', 'email_template', 'Email Template', 'Email Template', 'Email Templates', '33', 'email_template/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('33', 'email', 'Email', 'Email', 'Emails', '29', 'email/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('34', 'matter_document', 'Matter Document', 'Matter Document', 'Matter Documents', '29', 'matter_document/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('35', 'event', 'Event', 'Event', 'Events', null, 'event/index', 'yes', 'yes', 'yes', '1');
INSERT INTO `auth_modules` VALUES ('36', 'event_category', 'Event Category', 'Event Category', 'Event Categories', '35', 'event_category/index', 'yes', 'yes', 'yes', '0');
INSERT INTO `auth_modules` VALUES ('37', 'event_subject', 'Event Subject', 'Event Subject', 'Event Subjects', '35', 'event_subject/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('38', 'event_priority', 'Event Priority', 'Event Priority', 'Event Priorities', '35', 'event_priority/index', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('39', 'event_status', 'Event Status', 'Event Status', 'Event Status', '16', 'status/index/?status_type=event_status', 'yes', 'yes', 'yes', null);
INSERT INTO `auth_modules` VALUES ('40', 'event_calendar', 'Calendar', 'Calendar', 'Calendar', '35', 'event/calendar', 'yes', 'yes', 'yes', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO `cities` VALUES ('2', 'Istanbul', '1', '0');
INSERT INTO `cities` VALUES ('4', 'Ankara', '1', '0');
INSERT INTO `cities` VALUES ('6', 'Dallas', '2', '5');
INSERT INTO `cities` VALUES ('7', 'Los Angeles', '2', '2');
INSERT INTO `cities` VALUES ('10', 'Gaziantep', '1', '0');

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
-- Table structure for `companies`
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `COMPANY_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `COMPANY_NAME` text NOT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` varchar(50) DEFAULT NULL,
  `FAX` varchar(50) DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `ADDRESS` text,
  `COUNTRY_ID` bigint(20) DEFAULT NULL,
  `STATE_ID` bigint(20) DEFAULT NULL,
  `CITY_ID` bigint(20) unsigned DEFAULT NULL,
  `ZIP_CODE_ID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`COMPANY_ID`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`),
  KEY `STATE_ID` (`STATE_ID`),
  KEY `CITY_ID` (`CITY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of companies
-- ----------------------------

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `COUNTRY_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `COUNTRY_NAME` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`COUNTRY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Turkey');
INSERT INTO `countries` VALUES ('2', 'America');
INSERT INTO `countries` VALUES ('3', 'England');

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
-- Table structure for `emails`
-- ----------------------------
DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails` (
  `EMAIL_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `MATTER_ID` bigint(20) DEFAULT NULL,
  `EMAIL_SUBJECT` varchar(255) DEFAULT NULL,
  `EMAIL_BODY` text NOT NULL,
  `EMAIL_TEMPLATE_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERTER_ID` bigint(20) DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`EMAIL_ID`),
  KEY `EMAIL_SUBJECT` (`EMAIL_SUBJECT`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of emails
-- ----------------------------
INSERT INTO `emails` VALUES ('15', '1', 'Deneme Maili', '&lt;p&gt;&lt;strong&gt;&lt;span&gt;Nizamülmülk\'ün katipleri, o zamanın adetlerine göre kemerlerinin üzerine kuşak takarlardı. Kalemlerinin kutuları vardı.&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=\"font-size:xx-small;\"&gt;Yazıları bittikten sonra kalemleri kuşaklarına takarlardı. Yazıları bittikten sonra kalemlerini kutularına koyarlar ve kuşaklarına sokarlardı. Daha sonra biz Avrupalılar, onları taklit etmeye başladık. Bu nedenle Avrupalılar bir şey yazacakları zaman çok güçlüklerle karşılaşıyorlardı. Bu güçlüğü düşünen Avrupalılar, yazı işlerini mahkumlarına yaptırıyorlardı.&lt;/span&gt; &lt;/p&gt;&lt;p&gt;&lt;span style=\"font-size:small;\"&gt;Halbuki Doğu\'da bu işi en faziletli kişiler yapıyor, o işi yapanlara alim gözü ile bakıyorlar ve yapılan işi de faziletlerin en güzeli biliyorlardı. Onlara saygın kişiler olarak saygı gösteriyorlardı. Avrupalılar, Doğu ülkelerine giden aydınların, yazının önemini kavradıklarından bu işi kendi ülkelerinde uygulamaya başladılar. İtalya ve Fransa bu işlere öncülük ettiler. Bundan sonra kiliselerde bu işin önemini anladıkları için, kilisenin ileri gelenleri bu yazıyı öğrendikleri gibi kendi çocuklarına da öğrettiler. Böylece Avrupa\'da asiller, okuma yazma öğrenmiş oldular. Avrupalılar okuma yazma bilmekle övünüyorlardı. O zaman bir Avrupalı mektup yazmak isterse, kağıdını ve mürekkebini yaprak ve ağaç gibi bitkilerden ilkel bir şekilde yapıyor, bu iş çok güç oluyordu. Bunlar bu güçlükle uğraşırken Doğulu katipler kalemlerini kamıştan yapıyorlar, hokkalarını kalemlerini kemerlerine bağladıkları kuşaklarına sokuyorlardı.&lt;/span&gt;&lt;br /&gt;&lt;/p&gt;', '2', null, '2012-10-08 14:25:50');

-- ----------------------------
-- Table structure for `email_sendings`
-- ----------------------------
DROP TABLE IF EXISTS `email_sendings`;
CREATE TABLE `email_sendings` (
  `EMAIL_ID` bigint(20) unsigned NOT NULL,
  `RECEIVER_ID` bigint(20) unsigned DEFAULT NULL,
  `EMAIL_TO` varchar(255) NOT NULL,
  `IS_SUCCESSFUL` tinyint(4) NOT NULL,
  PRIMARY KEY (`EMAIL_ID`),
  KEY `USER_ID` (`RECEIVER_ID`),
  KEY `EMAIL_TO` (`EMAIL_TO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of email_sendings
-- ----------------------------
INSERT INTO `email_sendings` VALUES ('12', '1', 'serkandaglioglu@hotmail.com', '0');
INSERT INTO `email_sendings` VALUES ('13', '1', 'serkandaglioglu@hotmail.com', '0');
INSERT INTO `email_sendings` VALUES ('14', '1', 'serkandaglioglu@hotmail.com', '0');
INSERT INTO `email_sendings` VALUES ('15', '1', 'serkandaglioglu@hotmail.com', '0');

-- ----------------------------
-- Table structure for `email_templates`
-- ----------------------------
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `EMAIL_TEMPLATE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `EMAIL_TEMPLATE_NAME` varchar(255) NOT NULL,
  `EMAIL_TEMPLATE_SUBJECT` varchar(255) DEFAULT NULL,
  `EMAIL_TEMPLATE_BODY` text NOT NULL,
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`EMAIL_TEMPLATE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of email_templates
-- ----------------------------
INSERT INTO `email_templates` VALUES ('1', 'Test Email', 'Test Email Subject', '<blockquote>Test <strong>Email </strong>Body</blockquote>', '1');
INSERT INTO `email_templates` VALUES ('2', '2. Test Email', '2. Test Email Subject', '<p><strong><span>Nizamülmülk\'ün katipleri, o zamanın adetlerine göre kemerlerinin üzerine kuşak takarlardı. Kalemlerinin kutuları vardı.</span></strong></p><p><span style=\"font-size:xx-small;\">Yazıları bittikten sonra kalemleri kuşaklarına takarlardı. Yazıları bittikten sonra kalemlerini kutularına koyarlar ve kuşaklarına sokarlardı. Daha sonra biz Avrupalılar, onları taklit etmeye başladık. Bu nedenle Avrupalılar bir şey yazacakları zaman çok güçlüklerle karşılaşıyorlardı. Bu güçlüğü düşünen Avrupalılar, yazı işlerini mahkumlarına yaptırıyorlardı.</span> </p><p><span style=\"font-size:small;\">Halbuki Doğu\'da bu işi en faziletli kişiler yapıyor, o işi yapanlara alim gözü ile bakıyorlar ve yapılan işi de faziletlerin en güzeli biliyorlardı. Onlara saygın kişiler olarak saygı gösteriyorlardı. Avrupalılar, Doğu ülkelerine giden aydınların, yazının önemini kavradıklarından bu işi kendi ülkelerinde uygulamaya başladılar. İtalya ve Fransa bu işlere öncülük ettiler. Bundan sonra kiliselerde bu işin önemini anladıkları için, kilisenin ileri gelenleri bu yazıyı öğrendikleri gibi kendi çocuklarına da öğrettiler. Böylece Avrupa\'da asiller, okuma yazma öğrenmiş oldular. Avrupalılar okuma yazma bilmekle övünüyorlardı. O zaman bir Avrupalı mektup yazmak isterse, kağıdını ve mürekkebini yaprak ve ağaç gibi bitkilerden ilkel bir şekilde yapıyor, bu iş çok güç oluyordu. Bunlar bu güçlükle uğraşırken Doğulu katipler kalemlerini kamıştan yapıyorlar, hokkalarını kalemlerini kemerlerine bağladıkları kuşaklarına sokuyorlardı.</span><br /></p>', '1');

-- ----------------------------
-- Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `EVENT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CATEGORY_ID` bigint(20) unsigned NOT NULL,
  `IS_ALL_DAY` tinyint(4) NOT NULL,
  `BEGIN_DATE` datetime DEFAULT NULL,
  `END_DATE` datetime DEFAULT NULL,
  `SUBJECT_ID` bigint(20) unsigned DEFAULT NULL,
  `DESCRIPTION` text,
  `EVENT_LOCATION_ID` bigint(20) unsigned DEFAULT NULL,
  `PRIORITY_ID` tinyint(3) unsigned DEFAULT NULL,
  `EVENT_STATUS_ID` tinyint(3) unsigned DEFAULT NULL,
  `MATTER_ID` bigint(20) unsigned DEFAULT NULL,
  `CLIENT_ID` bigint(20) unsigned DEFAULT NULL,
  `IS_PRIVATE` tinyint(3) unsigned DEFAULT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`EVENT_ID`),
  KEY `EVENT_CATEGORY_ID` (`CATEGORY_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `WITH_ID` (`CLIENT_ID`),
  KEY `PRIORITY_ID` (`PRIORITY_ID`),
  KEY `EVENT_STATUS_ID` (`EVENT_STATUS_ID`),
  KEY `PRIVATE` (`IS_PRIVATE`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES ('1', '3', '0', '2012-10-15 15:00:00', '2012-10-15 16:00:00', '1', 'İş görüşmesi yapılacak.', '3', '2', '9', '1', '2', '1', null, null, null, null);
INSERT INTO `events` VALUES ('2', '3', '0', '2012-10-16 17:15:00', '2012-10-16 18:50:00', '2', null, '3', '1', '9', null, null, '0', null, '2012-10-15 17:52:54', null, '2012-10-17 12:16:29');
INSERT INTO `events` VALUES ('3', '18', '0', '2012-10-12 08:00:00', '2012-10-13 09:15:00', '4', null, '3', '2', '10', null, null, '0', null, '2012-10-16 11:01:46', null, '2012-10-17 12:15:13');
INSERT INTO `events` VALUES ('5', '1', '0', '2012-10-03 13:42:00', '2012-10-04 14:43:00', '1', null, null, null, null, null, null, '0', null, '2012-10-16 11:45:42', null, '2012-10-16 12:00:46');
INSERT INTO `events` VALUES ('6', '2', '0', '2012-10-09 10:00:00', '2012-10-09 12:12:00', '2', null, null, null, null, null, null, '0', null, '2012-10-16 12:01:50', null, '2012-10-16 12:02:07');
INSERT INTO `events` VALUES ('7', '3', '0', '2012-10-16 06:00:00', '2012-10-16 09:00:00', '1', null, null, '2', '9', null, null, '0', null, '2012-10-16 12:03:25', null, null);
INSERT INTO `events` VALUES ('8', '18', '0', '2012-10-16 11:30:00', '2012-10-16 13:00:00', '1', null, null, '2', '9', null, null, '0', null, '2012-10-16 12:06:06', null, null);
INSERT INTO `events` VALUES ('9', '1', '0', '2012-10-16 09:30:00', '2012-10-16 10:30:00', '3', null, null, null, null, null, null, '0', null, '2012-10-16 12:07:02', null, null);
INSERT INTO `events` VALUES ('10', '2', '0', '2012-10-16 14:00:00', '2012-10-16 16:30:00', '1', 'asdfasdf', '3', null, null, null, null, '0', null, '2012-10-17 12:16:07', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_categories
-- ----------------------------
INSERT INTO `event_categories` VALUES ('1', 'Appoinment', 'red', 'upload/event_category/sep11.png');
INSERT INTO `event_categories` VALUES ('2', 'Task', '#831874', null);
INSERT INTO `event_categories` VALUES ('3', 'Things to do', '#395648', 'upload/event_category/Desert18.jpg');
INSERT INTO `event_categories` VALUES ('18', 'Test Category', '#896544', null);

-- ----------------------------
-- Table structure for `event_priorities`
-- ----------------------------
DROP TABLE IF EXISTS `event_priorities`;
CREATE TABLE `event_priorities` (
  `PRIORITY_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `PRIORITY_NAME` varchar(255) NOT NULL,
  `PRIORITY_COLOR` varchar(20) DEFAULT NULL,
  `PRIORITY_RATING` tinyint(4) NOT NULL,
  PRIMARY KEY (`PRIORITY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_priorities
-- ----------------------------
INSERT INTO `event_priorities` VALUES ('1', 'Very İmportant', '#156486', '7');
INSERT INTO `event_priorities` VALUES ('2', 'İmportant', 'yellow', '5');

-- ----------------------------
-- Table structure for `event_reminders`
-- ----------------------------
DROP TABLE IF EXISTS `event_reminders`;
CREATE TABLE `event_reminders` (
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `REMINDER_WITH` tinyint(4) NOT NULL,
  `REMINDER_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_reminders
-- ----------------------------

-- ----------------------------
-- Table structure for `event_subjects`
-- ----------------------------
DROP TABLE IF EXISTS `event_subjects`;
CREATE TABLE `event_subjects` (
  `SUBJECT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `SUBJECT` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`SUBJECT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_subjects
-- ----------------------------
INSERT INTO `event_subjects` VALUES ('1', 'Telefon Görüşmesi', '1');
INSERT INTO `event_subjects` VALUES ('2', 'Toplantı', '1');
INSERT INTO `event_subjects` VALUES ('3', 'Test Subject', '1');
INSERT INTO `event_subjects` VALUES ('4', 'Breakfeast', '1');

-- ----------------------------
-- Table structure for `event_users`
-- ----------------------------
DROP TABLE IF EXISTS `event_users`;
CREATE TABLE `event_users` (
  `EVENT_ID` bigint(20) unsigned NOT NULL,
  `USER_ID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`EVENT_ID`,`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_users
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of locations
-- ----------------------------
INSERT INTO `locations` VALUES ('1', 'Los Angeles Superior Case');
INSERT INTO `locations` VALUES ('3', 'Office');

-- ----------------------------
-- Table structure for `matters`
-- ----------------------------
DROP TABLE IF EXISTS `matters`;
CREATE TABLE `matters` (
  `MATTER_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `MATTER_TYPE_ID` int(10) unsigned NOT NULL,
  `MATTER_NAME` varchar(255) DEFAULT NULL,
  `CASE_NUMBER` varchar(50) NOT NULL,
  `COURT_CASE_NUMBER` varchar(50) DEFAULT NULL,
  `ATTORNEY_ID` bigint(20) unsigned DEFAULT NULL,
  `COURT_ID` bigint(20) unsigned DEFAULT NULL,
  `DESCRIPTION` text,
  `OPEN_DATE` datetime DEFAULT NULL,
  `CLOSE_DATE` datetime DEFAULT NULL,
  `IS_CLOSED` tinyint(4) NOT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`MATTER_ID`),
  KEY `FILE_OR_CASE_NUMBER` (`CASE_NUMBER`),
  KEY `MATTER_TYPE_ID` (`MATTER_TYPE_ID`),
  KEY `ATTORNEY_ID` (`ATTORNEY_ID`),
  KEY `COURT_ID` (`COURT_ID`),
  KEY `OPEN_DATE` (`OPEN_DATE`),
  KEY `CLOSE_DATE` (`CLOSE_DATE`),
  KEY `IS_CLOSED` (`IS_CLOSED`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matters
-- ----------------------------
INSERT INTO `matters` VALUES ('1', '5', 'X Busines', '25692547255', null, null, null, null, '2012-10-10 00:00:00', null, '0', null, null, null, '2012-10-03 11:16:10');
INSERT INTO `matters` VALUES ('2', '7', 'Y Matter', '87494484', '2456822', null, null, null, '2012-10-11 00:00:00', null, '0', null, '2012-10-03 11:15:42', null, '2012-10-17 17:22:43');

-- ----------------------------
-- Table structure for `matter_documents`
-- ----------------------------
DROP TABLE IF EXISTS `matter_documents`;
CREATE TABLE `matter_documents` (
  `DOC_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `DOC_TYPE_ID` bigint(10) unsigned DEFAULT NULL,
  `DOC_STATUS_ID` bigint(10) unsigned DEFAULT NULL,
  `DOC_NAME` varchar(255) NOT NULL,
  `DOC_FILE_NAME` varchar(255) NOT NULL,
  `DOC_FILE_PATH` varchar(255) NOT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned DEFAULT NULL,
  `AUTHOR` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_documents
-- ----------------------------
INSERT INTO `matter_documents` VALUES ('1', '2', '1', 'deneme adı', 'Chrysanthemum16.jpg', 'upload/matter_docs_files/Chrysanthemum16.jpg', '1', '1', 'author', 'desc', null, null, null, null);
INSERT INTO `matter_documents` VALUES ('2', null, null, 'deneme', 'deneme.jpg', 'upload/matter_docs_files/deneme.jpg', '1', null, null, null, null, null, null, null);
INSERT INTO `matter_documents` VALUES ('3', '2', '1', 'çalı KÜŞU', 'cali-kusu.jpg', 'upload/matter_docs_files/cali-kusu.jpg', '2', null, null, null, null, null, null, '2012-10-17 12:40:17');
INSERT INTO `matter_documents` VALUES ('4', '1', null, 'çetere', 'cetere.jpg', 'upload/matter_docs_files/cetere.jpg', '1', null, null, null, null, null, null, '2012-10-17 13:15:20');
INSERT INTO `matter_documents` VALUES ('5', '2', '1', 'döküman ismi', 'dokuman-ismi.jpg', 'upload/matter_docs_files/dokuman-ismi.jpg', '1', '1', null, null, null, '2012-10-15 12:32:21', null, '2012-10-17 13:05:36');
INSERT INTO `matter_documents` VALUES ('6', '2', '1', 'subgriddeneklendi', 'subgriddeneklendi.txt', 'upload/matter_docs_files/subgriddeneklendi.txt', '2', null, null, null, null, '2012-10-17 18:51:45', null, null);
INSERT INTO `matter_documents` VALUES ('7', null, null, 'denemeeeee', 'denemeeeee.txt', 'upload/matter_docs_files/denemeeeee.txt', '1', null, null, null, null, '2012-10-17 18:52:11', null, null);

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
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`DOC_TYPE_ID`),
  KEY `DOC_TYPE_NAME` (`DOC_TYPE_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_doc_types
-- ----------------------------
INSERT INTO `matter_doc_types` VALUES ('1', 'HotDocs answer file', '1');
INSERT INTO `matter_doc_types` VALUES ('2', 'Client Bill', '1');

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
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`EXHIBIT_TYPE_ID`),
  KEY `EXHIBIT_TYPE_NAME` (`EXHIBIT_TYPE_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_exhibit_types
-- ----------------------------
INSERT INTO `matter_exhibit_types` VALUES ('1', 'Blueprint', '1');
INSERT INTO `matter_exhibit_types` VALUES ('2', 'Contract', '1');
INSERT INTO `matter_exhibit_types` VALUES ('3', 'Deposition', '1');
INSERT INTO `matter_exhibit_types` VALUES ('4', 'Email', '0');

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
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`FACT_TYPE_ID`),
  KEY `FACT_TYPE_NAME` (`FACT_TYPE_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_fact_types
-- ----------------------------
INSERT INTO `matter_fact_types` VALUES ('1', 'Report', '1');
INSERT INTO `matter_fact_types` VALUES ('2', 'Web Page', '1');
INSERT INTO `matter_fact_types` VALUES ('3', 'Phone Call', '1');

-- ----------------------------
-- Table structure for `matter_linked_clients`
-- ----------------------------
DROP TABLE IF EXISTS `matter_linked_clients`;
CREATE TABLE `matter_linked_clients` (
  `LINKED_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `LINKED_TYPE_ID` int(10) unsigned NOT NULL,
  `MATTER_ID` bigint(20) unsigned NOT NULL,
  `CLIENT_ID` bigint(20) unsigned NOT NULL,
  `DESCRIPTION` text,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`LINKED_ID`),
  KEY `LINK_TYPE_ID` (`LINKED_TYPE_ID`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_linked_clients
-- ----------------------------
INSERT INTO `matter_linked_clients` VALUES ('1', '1', '1', '1', 'deneme', null, '2012-10-03 13:51:17', null, '2012-10-03 20:10:23');
INSERT INTO `matter_linked_clients` VALUES ('2', '2', '2', '1', 'deneme açıklaması', null, '2012-10-03 20:19:55', null, '2012-10-17 16:06:29');

-- ----------------------------
-- Table structure for `matter_linked_client_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_linked_client_types`;
CREATE TABLE `matter_linked_client_types` (
  `LINKED_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LINKED_TYPE_NAME` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`LINKED_TYPE_ID`),
  KEY `LINKED_TYPE_NAME` (`LINKED_TYPE_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_linked_client_types
-- ----------------------------
INSERT INTO `matter_linked_client_types` VALUES ('1', 'Bill to this client', '1');
INSERT INTO `matter_linked_client_types` VALUES ('2', 'Client', '1');
INSERT INTO `matter_linked_client_types` VALUES ('3', 'Defendant', '0');
INSERT INTO `matter_linked_client_types` VALUES ('4', 'Judge', '1');
INSERT INTO `matter_linked_client_types` VALUES ('7', 'fghfgh', '1');
INSERT INTO `matter_linked_client_types` VALUES ('8', 'kkkkkkkkkkk', '1');
INSERT INTO `matter_linked_client_types` VALUES ('9', 'kkkkkkk', '1');

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
  `OPERATOR_ID` bigint(20) unsigned DEFAULT NULL,
  `IS_PRIVATE` tinyint(3) unsigned NOT NULL,
  `INSERTER_ID` bigint(20) unsigned DEFAULT NULL,
  `INSERT_DATE` datetime DEFAULT NULL,
  `UPDATER_ID` bigint(20) unsigned DEFAULT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`NOTE_ID`),
  KEY `NOTE_TYPE_ID` (`NOTE_TYPE_ID`),
  KEY `NOTE_DATE` (`NOTE_DATE`),
  KEY `MATTER_ID` (`MATTER_ID`),
  KEY `CLIENT_ID` (`CLIENT_ID`),
  KEY `IS_PRIVATE` (`IS_PRIVATE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_notes
-- ----------------------------
INSERT INTO `matter_notes` VALUES ('1', '2', '2012-10-04 12:00:00', 'My note about this matter', null, null, '2', null, null, '0', null, null, null, '2012-10-17 12:31:35');
INSERT INTO `matter_notes` VALUES ('2', '3', '2012-10-17 12:32:00', 'fgrgr rg rg', null, null, '2', null, null, '0', null, '2012-10-17 12:32:24', null, '2012-10-17 13:10:46');

-- ----------------------------
-- Table structure for `matter_note_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_note_types`;
CREATE TABLE `matter_note_types` (
  `NOTE_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NOTE_TYPE_NAME` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`NOTE_TYPE_ID`),
  KEY `NOTE_TYPE_NAME` (`NOTE_TYPE_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_note_types
-- ----------------------------
INSERT INTO `matter_note_types` VALUES ('1', 'Likes', '1');
INSERT INTO `matter_note_types` VALUES ('2', 'Added from a phone through AbacusSync', '1');
INSERT INTO `matter_note_types` VALUES ('3', 'Legal Advertisement', '1');
INSERT INTO `matter_note_types` VALUES ('4', 'Medical Report', '1');

-- ----------------------------
-- Table structure for `matter_types`
-- ----------------------------
DROP TABLE IF EXISTS `matter_types`;
CREATE TABLE `matter_types` (
  `MATTER_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MATTER_TYPE_NAME` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`MATTER_TYPE_ID`),
  KEY `MATTER_TYPE_NAME` (`MATTER_TYPE_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matter_types
-- ----------------------------
INSERT INTO `matter_types` VALUES ('1', 'Administrative Law', '1');
INSERT INTO `matter_types` VALUES ('4', 'Banking', '0');
INSERT INTO `matter_types` VALUES ('5', 'Business Law', '1');
INSERT INTO `matter_types` VALUES ('6', 'Civil Litigation', '0');
INSERT INTO `matter_types` VALUES ('7', 'Wrongful termination', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of states
-- ----------------------------
INSERT INTO `states` VALUES ('1', 'Marmara', '1');
INSERT INTO `states` VALUES ('2', 'Florida', '2');
INSERT INTO `states` VALUES ('3', 'Montana', '2');
INSERT INTO `states` VALUES ('4', 'California', '2');
INSERT INTO `states` VALUES ('5', 'Utah', '2');
INSERT INTO `states` VALUES ('6', 'New York', '2');

-- ----------------------------
-- Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `STATUS_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `STATUS_NAME` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `STATUS_TYPE` tinyint(4) NOT NULL,
  PRIMARY KEY (`STATUS_ID`),
  KEY `STATUS_NAME` (`STATUS_NAME`),
  KEY `IS_ACTIVE` (`IS_ACTIVE`),
  KEY `STATUS_TYPE` (`STATUS_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'x doc status', '1', '1');
INSERT INTO `status` VALUES ('2', 'Confirmed by them', '1', '2');
INSERT INTO `status` VALUES ('3', 'Confirmed by us', '1', '2');
INSERT INTO `status` VALUES ('4', 'Disputed by them', '1', '2');
INSERT INTO `status` VALUES ('5', 'Disputed by us', '0', '2');
INSERT INTO `status` VALUES ('6', 'Confirmed by them', '1', '3');
INSERT INTO `status` VALUES ('7', 'Confirmed by us', '1', '3');
INSERT INTO `status` VALUES ('8', 'Done', '1', '4');
INSERT INTO `status` VALUES ('9', 'Not done', '1', '4');
INSERT INTO `status` VALUES ('10', 'Off Calendar', '1', '4');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `USER_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `USER_TYPE_ID` tinyint(3) unsigned NOT NULL,
  `ADMIN_TYPE_ID` tinyint(3) unsigned DEFAULT NULL,
  `IS_ADMIN` tinyint(4) DEFAULT NULL,
  `UNIQUE_KEY` varchar(32) DEFAULT '0',
  `USERNAME` varchar(20) DEFAULT NULL,
  `NAME_PREFIX` varchar(50) DEFAULT NULL,
  `FIRST_NAME` varchar(30) DEFAULT NULL,
  `MIDDLE_NAME` varchar(30) DEFAULT NULL,
  `LAST_NAME` varchar(30) DEFAULT NULL,
  `MAIDEN_NAME` varchar(30) DEFAULT NULL,
  `FULL_NAME` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `COMPANY_ID` bigint(255) DEFAULT NULL,
  `HOME_PHONE` varchar(50) DEFAULT NULL,
  `WORK_PHONE` varchar(50) DEFAULT NULL,
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
  `HEIGHT` float DEFAULT NULL,
  `WEIGHT` float DEFAULT NULL,
  `HAIR_COLOR` varchar(20) DEFAULT NULL,
  `EYE_COLOR` varchar(20) DEFAULT NULL,
  `DATE_OF_BIRTH` datetime DEFAULT NULL,
  `BIRTH_COUNTRY` varchar(100) DEFAULT NULL,
  `BIRTH_STATE` varchar(100) DEFAULT NULL,
  `BIRTH_CITY` varchar(100) DEFAULT NULL,
  `NATIONALITY` varchar(100) DEFAULT NULL,
  `RACE` varchar(100) DEFAULT NULL,
  `SSN` varchar(9) DEFAULT NULL,
  `PASSPORT` varchar(100) DEFAULT NULL,
  `PASSPORT_COUNTRY_ID` bigint(20) unsigned DEFAULT NULL,
  `DATE_PASSPORT_EXPIRES` datetime DEFAULT NULL,
  `MARITAL_STATUS_ID` bigint(20) unsigned DEFAULT NULL,
  `PREVIOUS_MARRIAGES_COUNT` tinyint(3) unsigned DEFAULT NULL,
  `DATE_MARRIED` datetime DEFAULT NULL,
  `PLACE_MARRIED` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '1', '0', 'F4DDB18C2477A867A8D304F7442F403E', null, 'Dr.', 'Serkan', 'Alexander', 'Dağlıoğlu', null, 'Dr. Serkan Alexander Dağlıoğlu', 'serkandaglioglu@hotmail.com', 'http://www.serkandaglioglu.com', null, '05064485669', '05064485669', '05064485669', '05064485669', '05064485669', null, null, '1', '1', '2', null, '1', null, '2012-10-04 00:00:00', null, '1', null, '2012-10-01 18:13:18', null, '2012-10-01 18:13:18', null, null, null, null, '1988-05-16 00:00:00', null, null, null, null, null, null, null, '1', '2012-10-01 13:54:00', null, '0', '2012-10-01 13:54:00', null, null);
INSERT INTO `users` VALUES ('2', '2', null, '0', '9B7892CFABB8D8B2AA5D1B03B6F0CC0F', null, 'Şiş.', 'Burak', null, 'Okumuş', null, 'Şiş. Burak  Okumuş', 'burakokumus3@gmail.com', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2012-10-05 15:21:42', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

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
  `USER_TYPE_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `USER_TYPE_NAME` varchar(100) NOT NULL,
  `ACTIVE` tinyint(4) NOT NULL,
  PRIMARY KEY (`USER_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'Client', '1');
INSERT INTO `user_types` VALUES ('2', 'Judge', '1');
INSERT INTO `user_types` VALUES ('14', 'Attorney', '1');
INSERT INTO `user_types` VALUES ('15', 'Owner', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zip_codes
-- ----------------------------
INSERT INTO `zip_codes` VALUES ('1', '27070', '255K8', '1', '0', '4');
INSERT INTO `zip_codes` VALUES ('2', '24510', '410', '2', '0', '6');
INSERT INTO `zip_codes` VALUES ('4', 'gfhfgh', '', '1', '0', '0');
