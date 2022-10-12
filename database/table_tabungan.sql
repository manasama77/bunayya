/*
 Navicat Premium Data Transfer

 Source Server         : MySql Local
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : u8625483_sdbunayya

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 10/10/2022 23:07:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for log_tabungan
-- ----------------------------
DROP TABLE IF EXISTS `log_tabungan`;
CREATE TABLE `log_tabungan`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` datetime NOT NULL,
  `id_master_tabungan` bigint UNSIGNED NOT NULL,
  `nilai` int UNSIGNED NOT NULL,
  `tipe` enum('masuk','keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log_tabungan
-- ----------------------------

-- ----------------------------
-- Table structure for master_tabungan
-- ----------------------------
DROP TABLE IF EXISTS `master_tabungan`;
CREATE TABLE `master_tabungan`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `tabungan` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_tabungan
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
