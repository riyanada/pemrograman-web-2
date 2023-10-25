/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MariaDB
 Source Server Version : 100519 (10.5.19-MariaDB-log)
 Source Host           : localhost:3306
 Source Schema         : belajar_laravel

 Target Server Type    : MariaDB
 Target Server Version : 100519 (10.5.19-MariaDB-log)
 File Encoding         : 65001

 Date: 25/10/2023 18:14:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai`  (
  `pegawai_id` int(11) NOT NULL,
  `pegawai_nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pegawai_jabatan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pegawai_umur` int(11) NULL DEFAULT NULL,
  `pegawai_alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`pegawai_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES (1, 'riyan', 'Presiden', 24, 'Di Bumi ');

SET FOREIGN_KEY_CHECKS = 1;
