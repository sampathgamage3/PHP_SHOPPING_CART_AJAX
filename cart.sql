/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cart

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-02-03 11:01:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tblproduct`
-- ----------------------------
DROP TABLE IF EXISTS `tblproduct`;
CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `view_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblproduct
-- ----------------------------
INSERT INTO `tblproduct` VALUES ('1', '3D Camera', '3DcAM01', 'product-images/camera.jpg', '1500.00', null);
INSERT INTO `tblproduct` VALUES ('2', 'External Hard Drive', 'USB02', 'product-images/external-hard-drive.jpg', '800.00', '1');
INSERT INTO `tblproduct` VALUES ('3', 'Wrist Watch', 'wristWear03', 'product-images/watch.jpg', '300.00', null);
INSERT INTO `tblproduct` VALUES ('4', '4D Camera', '4dCam', 'product-images/camera.jpg', '1500.00', null);
INSERT INTO `tblproduct` VALUES ('5', 'Pen Drive', 'USB30PEN', 'product-images/external-hard-drive.jpg', '9800.00', null);
INSERT INTO `tblproduct` VALUES ('6', 'Mobile Phone', 'Mobile009', 'product-images/watch.jpg', '900.00', null);
