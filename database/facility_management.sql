/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : facility_management

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-01-20 00:45:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_accounts`
-- ----------------------------
DROP TABLE IF EXISTS `admin_accounts`;
CREATE TABLE `admin_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of admin_accounts
-- ----------------------------
INSERT INTO `admin_accounts` VALUES ('1', 'admin', 'admin123');

-- ----------------------------
-- Table structure for `companies`
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES ('9', 'OBN', 'Obanana Corp.');
INSERT INTO `companies` VALUES ('10', 'PMI', 'Premium Megastructures Inc.');
INSERT INTO `companies` VALUES ('11', 'PIVI', 'Premium Infinite Ventures Inc.');

-- ----------------------------
-- Table structure for `facilities`
-- ----------------------------
DROP TABLE IF EXISTS `facilities`;
CREATE TABLE `facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` varchar(255) NOT NULL,
  `facility_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of facilities
-- ----------------------------
INSERT INTO `facilities` VALUES ('8', 'MTNGRM', 'Meeting Room');
INSERT INTO `facilities` VALUES ('9', 'BRDRM', 'Board Room');
INSERT INTO `facilities` VALUES ('11', 'BSKTBLLRM', 'Basketball Court');
INSERT INTO `facilities` VALUES ('12', 'VLLYBLLRM', 'Volleyball Court');
INSERT INTO `facilities` VALUES ('16', 'BDMNT', 'Badminton Court');

-- ----------------------------
-- Table structure for `facility_room_masters`
-- ----------------------------
DROP TABLE IF EXISTS `facility_room_masters`;
CREATE TABLE `facility_room_masters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_type` varchar(255) NOT NULL,
  `facility_number` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `floor_location` varchar(255) NOT NULL,
  `max_capacity` varchar(255) NOT NULL,
  `statuses` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facilities` (`facility_type`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of facility_room_masters
-- ----------------------------
INSERT INTO `facility_room_masters` VALUES ('1', 'Meeting Room', 'MTNGRM-1', 'Meeting Room 1', '15th floor', '2', 'ACTIVE');
INSERT INTO `facility_room_masters` VALUES ('2', 'Meeting Room', 'MTGRM-2', 'Meeting Room 2', '15th floor', '2', 'ACTIVE');
INSERT INTO `facility_room_masters` VALUES ('3', 'Board Room', 'BRDRM-1', 'Board Room 1', '16th floor', '2', 'ACTIVE');
INSERT INTO `facility_room_masters` VALUES ('4', 'Board Room', 'BRDRM-2', 'Board Room 2', '16th floor', '2', 'ACTIVE');
INSERT INTO `facility_room_masters` VALUES ('5', 'Basketball Court', 'BSKTBLLRM-1', 'Badminton Court 1', '17th floor', '1', 'ACTIVE');
INSERT INTO `facility_room_masters` VALUES ('6', 'Volleyball Court', 'VLLYBLC-1', 'Volleyball Court 1', '17th floor', '1', 'ACTIVE');
INSERT INTO `facility_room_masters` VALUES ('7', 'Badminton Court', 'BDMNTNCRT-1', 'Badminton Court 1', '17th floor', '1', 'ACTIVE');

-- ----------------------------
-- Table structure for `floors`
-- ----------------------------
DROP TABLE IF EXISTS `floors`;
CREATE TABLE `floors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_code` varchar(255) NOT NULL,
  `floor_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of floors
-- ----------------------------
INSERT INTO `floors` VALUES ('7', '15F', '15th floor');
INSERT INTO `floors` VALUES ('8', '16F', '16th floor');
INSERT INTO `floors` VALUES ('9', '17F', '17th floor');

-- ----------------------------
-- Table structure for `reservations`
-- ----------------------------
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `created_date` date DEFAULT current_timestamp(),
  `rsvn_no` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL DEFAULT '',
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `time_from` time(6) NOT NULL,
  `time_to` time(6) NOT NULL,
  `statuses` varchar(255) NOT NULL,
  `cancel_reasons` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users` (`users_id`),
  CONSTRAINT `fk_users` FOREIGN KEY (`users_id`) REFERENCES `users_accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of reservations
-- ----------------------------
INSERT INTO `reservations` VALUES ('6', '1', '2023-01-19', '1', 'Boado, Schultz Henry', 'Meeting Room', 'MTNGRM-1', '2023-01-19', '2023-01-19', '22:01:00.000000', '23:01:00.000000', 'PENDING', null);
INSERT INTO `reservations` VALUES ('8', '2', '2023-01-19', '2', 'Gloda, Bryan', 'Meeting Room', 'MTNGRM-1', '2023-01-19', '2023-01-19', '22:38:00.000000', '23:38:00.000000', 'PENDING', null);
INSERT INTO `reservations` VALUES ('10', '2', '2023-01-19', '2', 'Gloda, Bryan', 'Meeting Room', 'MTNGRM-1', '2023-01-19', '2023-01-19', '23:41:00.000000', '23:41:00.000000', 'PENDING', null);
INSERT INTO `reservations` VALUES ('14', '2', '2023-01-19', '2', 'Gloda, Bryan', 'Meeting Room', 'MTNGRM-1', '2023-01-19', '2023-01-19', '22:58:00.000000', '23:58:00.000000', 'PENDING', null);

-- ----------------------------
-- Table structure for `users_accounts`
-- ----------------------------
DROP TABLE IF EXISTS `users_accounts`;
CREATE TABLE `users_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_names` varchar(255) NOT NULL,
  `first_names` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `statuses` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users_accounts
-- ----------------------------
INSERT INTO `users_accounts` VALUES ('1', 'Boado', 'Schultz Henry', 'Obanana Corp.', 'schultzhenry.boado@obanana.com', '123', 'Users Approval', 'ACTIVE');
INSERT INTO `users_accounts` VALUES ('2', 'Gloda', 'Bryan', 'Obanana Corp.', 'bryan.gloda@obanana.com', '123', 'Users', 'ACTIVE');
INSERT INTO `users_accounts` VALUES ('4', 'Admin', 'Admin', 'Obanana Corp.', 'admin@gmail.com', 'admin123', 'Admin', 'ACTIVE');
