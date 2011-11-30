/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50515
 Source Host           : localhost
 Source Database       : s4

 Target Server Version : 50515
 File Encoding         : utf-8

 Date: 11/30/2011 08:03:05 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `modified` (`modified`),
  KEY `name_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `products`
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES ('1', 'Product 1', 'product1', '1.jpg', '9.95', '2011-10-12 04:04:08', '2011-11-28 06:32:03'), ('2', 'Product 2', 'product2', '2.jpg', '19.95', '2011-10-12 04:04:08', '2011-11-28 15:49:29'), ('3', 'Product 3', 'product3', '3.jpg', '19.95', '2011-10-12 04:04:10', '2011-11-28 00:50:07'), ('4', 'Product 4', 'product4', '4.jpg', '19.95', '2011-10-12 04:04:10', '2011-11-27 13:08:33'), ('5', 'Product 5', 'product5', '5.jpg', '19.95', '2011-10-12 04:04:10', '2011-11-28 15:43:53'), ('6', 'Product 6', 'product6', '6.jpg', '49.95', '2011-10-12 04:04:10', '2011-11-27 04:19:02'), ('7', 'Product 7', 'product7', '7.jpg', '19.95', '2011-10-12 04:04:10', '2011-11-27 09:43:42'), ('8', 'Product 8', 'product8', '8.jpg', '79.95', '2011-10-12 04:04:10', '2011-11-27 12:05:26'), ('9', 'Product 9', 'product9', '9.jpg', '19.95', '2011-10-12 04:04:10', '2011-11-28 00:50:03'), ('10', 'Product 10', 'product10', '10.jpg', '99.99', '2011-10-12 04:04:10', '2011-11-27 07:43:26');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
