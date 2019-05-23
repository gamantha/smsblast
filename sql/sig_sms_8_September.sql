/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : sig_sms

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 09/08/2016 22:01:23 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `bank_account`
-- ----------------------------
DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `virtual_account_number` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `fk_bank_account` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `bank_account`
-- ----------------------------
BEGIN;
INSERT INTO `bank_account` VALUES ('1', '1', 'bca', '1231412125'), ('2', '2', 'bni', '12312471249'), ('3', '3', 'bca', '1237198723'), ('4', '4', 'bni', '18236128623');
COMMIT;

-- ----------------------------
--  Table structure for `contact_info`
-- ----------------------------
DROP TABLE IF EXISTS `contact_info`;
CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `sms` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_info_customer_1` (`customer_id`),
  CONSTRAINT `fk_contact_info_customer_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `contact_info`
-- ----------------------------
BEGIN;
INSERT INTO `contact_info` VALUES ('1', '1', '085227227649', 'ivanyuliansyah17@gmail.com', 'Purwokerto'), ('2', '2', '081545474090', 'me.arifrahman@gmail.com', 'Balikpapan'), ('3', '3', '0811913848', 'renowijoyo@gmail.com', 'Jakarta'), ('4', '4', '085724945666', 'zenner88@gmail.com', 'Padalarang');
COMMIT;

-- ----------------------------
--  Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `proyek_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customer_proyek_1` (`proyek_id`),
  CONSTRAINT `fk_customer_proyek_1` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `customer`
-- ----------------------------
BEGIN;
INSERT INTO `customer` VALUES ('1', 'Ivan', '1'), ('2', 'Arif', '1'), ('3', 'Reno', '2'), ('4', 'Zenner', '2');
COMMIT;

-- ----------------------------
--  Table structure for `pesan`
-- ----------------------------
DROP TABLE IF EXISTS `pesan`;
CREATE TABLE `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `isi_pesan` varchar(255) DEFAULT NULL,
  `status` enum('undelivered','delivered','recurring') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pesan_customer_1` (`customer_id`),
  CONSTRAINT `fk_pesan_customer_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `pesan`
-- ----------------------------
BEGIN;
INSERT INTO `pesan` VALUES ('1', '1', 'Tolong bayar', 'undelivered'), ('2', '2', 'Sudah Lunas', 'undelivered'), ('3', '3', 'Kirimkan uang', 'recurring'), ('4', '4', 'Hubungi saya', 'undelivered');
COMMIT;

-- ----------------------------
--  Table structure for `proyek`
-- ----------------------------
DROP TABLE IF EXISTS `proyek`;
CREATE TABLE `proyek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_proyek` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `proyek`
-- ----------------------------
BEGIN;
INSERT INTO `proyek` VALUES ('1', 'ASI'), ('2', 'DAMAR');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_role_1` (`role_id`),
  CONSTRAINT `fk_user_role_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'reno', 'renowijoyo@gmail.com', '4XFGCO7IRlrb9wZuPcSrvWo8bt9H6Yra', '$2y$13$LFS3EIwRyS9vyc3CY7QLnOEBmc5YVmcwCeaDC3GTds63xTIrt0TzG', null, '1', '1442506740', '1442506740', '10'), ('2', 'rizki', 'rizki@gmail.com', '7RYZIpXilZwhK8bqFgp5K0yYfHypzWND', '$2y$13$kztNvx0vD0UIclTSMR5/1ONZZChb2V2nwVmkHY.uHdB5HXOn.ZEU.', null, '1', '1444883061', '1444883061', '10'), ('3', 'anis', 'anis@gmaill.com', 'WHogQVYFvrjtZ0UzEZ_2NYQ1R5VmMAL8', '$2y$13$jWRPiDGm76uk79hnYAy0QOKZTSulHATgjg27xHuWcpbrB2Ay/auNC', null, null, '1450062566', '1450062566', '10'), ('4', 'arif_test', 'me.arifrahman@gmail.com', 'cuKcqOFAPfDPMc-uuiVc49o5mZjJ7w_2', '$2y$13$uvDOAhWgyhx3T29l4h2TD.pspCP7UbOfwCF0UGs9nRFIkBn1wdqPC', null, null, '1470649840', '1470649840', '10');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
