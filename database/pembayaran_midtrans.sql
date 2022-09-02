/*
 Navicat Premium Data Transfer

 Source Server         : MySql Local
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : bunayyadb

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 03/09/2022 00:40:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pembayaran_midtrans
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran_midtrans`;
CREATE TABLE `pembayaran_midtrans`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bulanan_no` bigint UNSIGNED NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `transaction_time` datetime NULL DEFAULT NULL,
  `transaction_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembayaran_midtrans
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
