/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : facility_management

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-01-06 11:13:23
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
INSERT INTO `admin_accounts` VALUES ('1', 'admin', '123');

-- ----------------------------
-- Table structure for `companies`
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of facilities
-- ----------------------------
INSERT INTO `facilities` VALUES ('8', 'MTNGRM', 'Meeting Room');
INSERT INTO `facilities` VALUES ('9', 'BRDRM', 'Board Room');
INSERT INTO `facilities` VALUES ('11', 'BSKTBLLRM', 'Basketball Room');
INSERT INTO `facilities` VALUES ('12', 'VLLYBLLRM', 'Volleyball Room');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of facility_room_masters
-- ----------------------------
INSERT INTO `facility_room_masters` VALUES ('5', 'Meeting Room', 'MTGRM - 1', 'MEETING ROOM 1', '15th floor', '20', 'ACTIVE');

-- ----------------------------
-- Table structure for `floors`
-- ----------------------------
DROP TABLE IF EXISTS `floors`;
CREATE TABLE `floors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_code` varchar(255) NOT NULL,
  `floor_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `time_from` time(6) NOT NULL,
  `time_to` time(6) NOT NULL,
  `statuses` varchar(255) NOT NULL,
  `cancel_reasons` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users` (`users_id`),
  CONSTRAINT `fk_users` FOREIGN KEY (`users_id`) REFERENCES `users_accounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of reservations
-- ----------------------------
INSERT INTO `reservations` VALUES ('1', '1', '2023-01-06', '1231231313131231321', 'Boado, Schultz Henry', 'Meeting Room', '2023-01-06', '2023-01-06', '10:38:00.000000', '11:38:00.000000', 'REJECT', 'asdasdasd\r\n');
INSERT INTO `reservations` VALUES ('3', '1', '2023-01-06', '12345', 'Boado, Schultz Henry', 'Meeting Room', '2023-01-06', '2023-01-06', '10:37:00.000000', '11:37:00.000000', 'APPROVED', '');

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
  `statuses` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users_accounts
-- ----------------------------
INSERT INTO `users_accounts` VALUES ('1', 'Boado', 'Schultz Henry', 'Obanana Corp.', 'schultzhenry.boado@obanana.com', '202cb962ac59075b964b07152d234b70', 'ACTIVE');
INSERT INTO `users_accounts` VALUES ('2', 'Gloda', 'John Bryan', 'Premium Megastructures Inc.', 'bryan.gloda@obanana.com', '202cb962ac59075b964b07152d234b70', 'ACTIVE');
INSERT INTO `users_accounts` VALUES ('3', 'Mangalo', 'Ryan Christian', 'Obanana Corp.', 'ryan.mangalo@obanana.com', '202cb962ac59075b964b07152d234b70', 'ACTIVE');
INSERT INTO `users_accounts` VALUES ('8', 'Matias', 'Ryan', 'Obanana Corp.', 'ryan.matias@obanana.com', '10f9033ee9d4fe20f8f7257f4307c1df', 'INACTIVE');
