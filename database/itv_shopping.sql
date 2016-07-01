/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100111
 Source Host           : localhost
 Source Database       : itv_shopping

 Target Server Type    : MariaDB
 Target Server Version : 100111
 File Encoding         : utf-8

 Date: 07/01/2016 10:02:28 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tbl_advertise`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_advertise`;
CREATE TABLE `tbl_advertise` (
  `adv_id` smallint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `link` varchar(256) DEFAULT NULL,
  `img_url` varchar(256) DEFAULT NULL,
  `position` smallint(3) DEFAULT NULL,
  `order_id` smallint(3) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `type_id` smallint(3) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `status` smallint(3) DEFAULT NULL,
  PRIMARY KEY (`adv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_advertise`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_advertise` VALUES ('1', 'Last chance', '/', 'http://demo.roadthemes.com/saharan_accessories/wp-content/uploads/2015/08/banner1.jpg', '1', '1', 'Bigest sale', 'Donec vitae est placerat, porttitor sem at, trum erat. Donec vitaeest placerat, porttitor sem at, rutrum erat donec vitae est placerat.', '1', '2016-02-03 09:45:08', '2016-02-03 09:45:11', '1'), ('2', 'Last chance', '/', 'http://demo.roadthemes.com/saharan_accessories/wp-content/uploads/2015/08/banner2.jpg', '1', '1', 'Bigest sale', 'Donec vitae est placerat, porttitor sem at, trum erat. Donec vitaeest placerat, porttitor sem at, rutrum erat donec vitae est placerat.', '1', '2016-02-03 09:46:44', '2016-02-03 09:46:46', '1');
COMMIT;

-- ----------------------------
--  Table structure for `tbl_brand`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE `tbl_brand` (
  `brand_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `order_id` tinyint(3) NOT NULL,
  `seo_url` varchar(256) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_brand`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_brand` VALUES ('1', 'Brand1', '1', '/home-trang-chu', '/images/upload/2016/01/26/198526-img_brand01.jpg', '2016-01-23 14:19:33', '2016-01-26 17:01:00', '1'), ('2', 'Brand2', '2', 'trang-chu', '/images/upload/2016/01/26/818531-img_brand02.jpg', '2016-01-23 14:19:55', '2016-01-26 17:02:00', '1');
COMMIT;

-- ----------------------------
--  Table structure for `tbl_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `cate_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent_id` smallint(5) NOT NULL,
  `seo_url` varchar(256) DEFAULT NULL,
  `order_id` tinyint(3) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_category`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_category` VALUES ('1', 'MAKEUP', '0', '/makeup/1', '1', '2016-01-20 18:02:48', '2016-01-25 16:46:00', '1'), ('2', 'SKINCARE', '0', '/skincare/2', '2', '2016-01-25 16:46:48', '2016-01-25 16:47:00', '1'), ('3', 'HAIR', '0', '/hair/3', '3', '2016-01-25 16:47:44', '2016-01-25 16:48:00', '1'), ('4', 'Face', '1', '', '4', '2016-01-25 16:48:49', null, '1'), ('5', 'Eye', '1', '/makeup/1/5/eye', '2', '2016-01-28 10:16:22', null, '1'), ('6', 'Shampoo', '3', '/hair/3/6/shampoo', '1', '2016-01-28 10:25:36', null, '1'), ('7', 'conditioner', '3', '/hair/3/7/conditioner', '2', '2016-01-28 10:26:10', null, '1'), ('8', 'Cleansers', '2', '/skincare/2/8/cleansers', '1', '2016-01-28 10:26:46', null, '1'), ('9', 'Toners', '2', '/skincare/2/9/toners', '2', '2016-01-28 10:27:02', null, '1');
COMMIT;

-- ----------------------------
--  Table structure for `tbl_color`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_color`;
CREATE TABLE `tbl_color` (
  `color_id` smallint(5) NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(64) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tbl_contact`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE `tbl_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `content` varchar(500) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_contact`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_contact` VALUES ('4', 'long', '1433', 'long@gmail.com', 'sdfsdf', '2016-01-29 16:21:00', '1');
COMMIT;

-- ----------------------------
--  Table structure for `tbl_product`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_id` smallint(5) NOT NULL,
  `cate_parent_id` smallint(5) DEFAULT '0',
  `brand_id` smallint(5) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `short_description` text,
  `shipping_return` text,
  `code` varchar(40) NOT NULL,
  `weight` float(6,0) NOT NULL,
  `original_price` decimal(18,0) NOT NULL,
  `price` decimal(18,0) NOT NULL,
  `keyword` varchar(256) NOT NULL,
  `model_number` varchar(64) DEFAULT NULL,
  `benefit` varchar(128) DEFAULT NULL,
  `size` varchar(128) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_product`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_product` VALUES ('1', '8', '2', '1', 'Quần Jean HandMake- AA1211D', ',bafasf\r\nkjfsbasif\r\nkjsbfaislf\r\njsbnfasbfusa\r\nsfjas;fbas', null, 'bfaslhibf\r\nskjfbaslf;á\r\njasbfio;á\r\nsjvas;iosa', 'PD_0091122_901232', '1', '5000', '49800', '123dd', 'M_0011D', 'OK', 'M-X-XXL', '2016-01-23 14:53:01', '2016-01-28 14:44:00', '1'), ('2', '6', '3', '1', 'Quần Jean HandMake- AA1211D', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.\r\n\r\nPellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.', null, 'no Shipping return', 'PD_0091122_901232', '1222', '2388', '2289', 'keyword', 'M_0011D', 'OK', 'M-X-XXL', '2016-01-25 10:15:38', '2016-01-28 14:45:00', '1'), ('3', '4', '1', '1', 'BECCA Shimmering Skin Perfector™ Pressed', 'What it is: \r\nA creamy powder highlighter that absorbs and reflects light for the ultimate natural glow. \r\n\r\nWhat it does: \r\nFind refined luminosity in any light. This bestselling formula is enriched with ultrafine luminescent pearls that absorb, reflect, and refract light so your natural radiance is never lost. Unlike the traditional pressed powder method which simply mixes and compresses dry ingredients, this unique process blends pigments with proprietary liquid binders, resulting in unparalleled, creamy application with balanced color dispersion. Like a compact full of crushed gemstones, the multi-toned, ultra-fine pigment pearls adjust to your skin’s natural undertones for a truly unique glow. \r\n\r\nWhat it is formulated WITHOUT: \r\n- Parabens \r\n\r\nWhat else you need to know: \r\nFor fuller-looking lips, follow lip gloss or lipstick with a dab of Shimmering Skin Perfector™ to the center of your lower lip.', null, 'BECCA\r\nShimmering Skin Perfector™ Pressed', '1538107', '1', '40', '38', 'BECCA Shimmering Skin Perfector™ Pressed', '43', '', '0.28 oz', '2016-01-28 10:10:23', null, '1'), ('4', '5', '1', '2', 'Anastasia Beverly Hills DIPBROW™ Pomade', ' What it is:\r\nA smudge-free, waterproof pomade formula that performs as an all-in-one brow product. \r\n\r\nWhat it does:\r\nThis creamy, multitasking product glides on skin and hair smoothly to create clean, defined brows. The standout formula works as a brow primer and provides color, sculpture, and shading. It is ideal for oily skin and in humid climates.', '', 'What it is:\r\nA smudge-free, waterproof pomade formula that performs as an all-in-one brow product. \r\n\r\nWhat it does:\r\nThis creamy, multitasking product glides on skin and hair smoothly to create clean, defined brows. The standout formula works as a brow primer and provides color, sculpture, and shading. It is ideal for oily skin and in humid climates.', '1538107', '4', '20', '18', 'eye', '', '', 'SIZE 0.14 oz', '2016-01-28 10:21:41', '2016-05-12 11:05:00', '1'), ('5', '6', '3', '1', 'SheaMoisture Curl Enhancing Smoothie ', ' SheaMoisture’s Coconut &amp; Hibiscus Curl Enhancing Smoothie defines curls, reduces frizz and smoothes hair for a soft, silky feel. Restores moisture, creates brilliant shine and conditions hair without weighing it down for bouncy, healthy curls.\r\n• Made with natural and certified organic ingredients.\r\n• Coconut Oil hydrates and protects hair while reducing breakage.\r\n• Silk Protein smoothes hair for a soft, silky feel.\r\n• Neem Oil controls frizz while adding brilliant shine.\r\nAll-natural hair dressing moisturizes hair and imparts a shine and bounce to curls\r\nDispense a dime-size amount into hands and massage into damp or dry hair\r\nStyle as desired\r\nMay also be used as a deep conditioner; apply to wet hair and leave on for 15 minutes, then rinse thoroughly\r\nPurpose: Strengthening\r\nType of Hair: All Hair Types\r\nProduct Form: cream\r\nTravel Size: No', '', 'SheaMoisture’s Coconut & Hibiscus Curl Enhancing Smoothie defines curls, reduces frizz and smoothes hair for a soft, silky feel. Restores moisture, creates brilliant shine and conditions hair without weighing it down for bouncy, healthy curls.\r\n• Made with natural and certified organic ingredients.\r\n• Coconut Oil hydrates and protects hair while reducing breakage.\r\n• Silk Protein smoothes hair for a soft, silky feel.\r\n• Neem Oil controls frizz while adding brilliant shine.\r\nAll-natural hair dressing moisturizes hair and imparts a shine and bounce to curls\r\nDispense a dime-size amount into hands and massage into damp or dry hair\r\nStyle as desired\r\nMay also be used as a deep conditioner; apply to wet hair and leave on for 15 minutes, then rinse thoroughly\r\nPurpose: Strengthening\r\nType of Hair: All Hair Types\r\nProduct Form: cream\r\nTravel Size: No', '111', '1', '12', '10', 'SheaMoisture Curl Enhancing Smoothie - Coconut and Hibiscus (12 oz)', '', '', '', '2016-01-28 10:39:16', '2016-01-28 16:23:00', '1'), ('6', '8', '2', '2', 'Olay Regenerist Micro-Sculpting Cream Face M', ' Target beauty skin care facial moisturizers\r\nOlay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz.\r\n\r\nOlay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz.\r\nmouse over image to zoom in.\r\nOlay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 1	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 2	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 3	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 4	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 5\r\nUSD 23,99\r\n5 (1383)\r\nquantity:  - \r\n1\r\n+\r\nadd to cart notes	\r\nPrices, promotions, styles and availability may vary by store and online.\r\nshare\r\nFind what you were looking for?nomaybeyes\r\noverview\r\nlabel info\r\nexpert reviews\r\nshipping &amp; returns\r\ndetails\r\nOlay skin scientists have formulated the #1 selling anti-aging moisturizer with an advanced Amino-Peptide Complex to penetrate deep into the skin’s surface to visibly reduce the appearance of wrinkles. Olay Regenerist Micro-Sculpting Cream moisturizer with Hyaluronic Acid hydrates to plump cells from within the skin’s surface. The luxurious-feeling moisturizer immediately leaves skin hydrated and softens the look of fine lines and wrinkles, reducing the look of 10 years of wrinkles in just 4 weeks. It also firms the look of skin with plumping hydration. Dramatic transformation. Not drastic measures. Anti-aging moisturizer that hydrates to firm and lift, helping retain skin’s youthful surface contours. Olay Regenerist Micro-Sculpting Cream moisturizer with Hyaluronic Acid hydrates to plump cells from within the skin’s surface. Reduces the look of up to 10 years of wrinkles in just 4 weeks. Formula with advanced Amino-Peptide Complex penetrates deep into skin surface to visibly reduce the appearance of wrinkles fast. Visible wrinkle results start day 1. One 1.7 oz. jar of Olay face moisturizer.\r\nNumber of Pieces: 1\r\nFor Use On: Face\r\nProduct Form: cream\r\nScent: Unscented\r\nTravel Size: No\r\nCapacity: Total Volume: .510\r\nProduct Warning: no warning applicable', '', 'Target beauty skin care facial moisturizers\r\nOlay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz.\r\n\r\nOlay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz.\r\nmouse over image to zoom in.\r\nOlay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 1	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 2	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 3	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 4	Olay Regenerist Micro-Sculpting Cream Face Moisturizer 1.7 oz. Additional View 5\r\nUSD 23,99\r\n5 (1383)\r\nquantity:  - \r\n1\r\n+\r\nadd to cart notes	\r\nPrices, promotions, styles and availability may vary by store and online.\r\nshare\r\nFind what you were looking for?nomaybeyes\r\noverview\r\nlabel info\r\nexpert reviews\r\nshipping & returns\r\ndetails\r\nOlay skin scientists have formulated the #1 selling anti-aging moisturizer with an advanced Amino-Peptide Complex to penetrate deep into the skin’s surface to visibly reduce the appearance of wrinkles. Olay Regenerist Micro-Sculpting Cream moisturizer with Hyaluronic Acid hydrates to plump cells from within the skin’s surface. The luxurious-feeling moisturizer immediately leaves skin hydrated and softens the look of fine lines and wrinkles, reducing the look of 10 years of wrinkles in just 4 weeks. It also firms the look of skin with plumping hydration. Dramatic transformation. Not drastic measures. Anti-aging moisturizer that hydrates to firm and lift, helping retain skin’s youthful surface contours. Olay Regenerist Micro-Sculpting Cream moisturizer with Hyaluronic Acid hydrates to plump cells from within the skin’s surface. Reduces the look of up to 10 years of wrinkles in just 4 weeks. Formula with advanced Amino-Peptide Complex penetrates deep into skin surface to visibly reduce the appearance of wrinkles fast. Visible wrinkle results start day 1. One 1.7 oz. jar of Olay face moisturizer.\r\nNumber of Pieces: 1\r\nFor Use On: Face\r\nProduct Form: cream\r\nScent: Unscented\r\nTravel Size: No\r\nCapacity: Total Volume: .510\r\nProduct Warning: no warning applicable', '111', '1', '45', '40', 'Olay', '', '', '', '2016-01-28 10:43:59', '2016-01-28 16:10:00', '1'), ('7', '9', '2', '2', 'Olay Regenerist Regenerating Cream Facial ', '  Experience an instant detox for your skin. Olay Regenerist Regenerating Cream Cleanser deep cleans while gently exfoliating skin to speed skin’s natural surface regeneration. The creamy, anti-aging formula with an Amino-Peptide Complex and oxygenated exfoliants regenerates and smoothes skin texture without over drying. Safe for daily use, it’s the perfect way to begin and end every day for a beautifully regenerated appearance. Anti-aging facial cleanser with creamy formula deep cleans to prep skin for daily beauty regimen. Smoothes skin surface and speeds skin’s natural surface regeneration. Immediately cleans, improving skin’s texture without over drying. Formulated with Amino-Peptide Complex and oxygenated exfoliants, the formula is like an instant detox diet for your skin. Use to prepare skin before applying your Olay Regenerist moisturizers and treatments. One 5.0 fl oz tube of Olay face cleanser.\r\nUsed For: basic cleansing\r\nFor Use On: Face\r\nProduct Form: cream\r\nHealth Facts: Contains Vitamin E\r\nScent: Unscented\r\nTravel Size: No\r\nCapacity: Total Volume: 5.000\r\nProduct Warning: no warning applicable', 'Experience an instant detox for your skin. Olay Regenerist Regenerating Cream Cleanser deep cleans while gently exfoliating skin to speed skin’s natural surface regeneration', '', '2222', '2', '16', '15', 'Olay Regenerist Regenerating Cream Facial', '', '', '', '2016-01-28 14:39:12', '2016-01-28 16:22:00', '1');
COMMIT;

-- ----------------------------
--  Table structure for `tbl_product_color`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_color`;
CREATE TABLE `tbl_product_color` (
  `product_color_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` smallint(5) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tbl_product_image`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_image`;
CREATE TABLE `tbl_product_image` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `img_url` varchar(256) NOT NULL,
  `order_id` tinyint(3) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_product_image`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_product_image` VALUES ('28', '3', null, '/images/upload/2016/01/28/236983-2.jpg', '1', '2016-01-28 10:10:23', '1'), ('29', '3', null, '/images/upload/2016/01/28/400836-1.jpg', '2', '2016-01-28 10:10:23', '1'), ('32', '5', null, '/images/upload/2016/01/28/206523-1.jpg', '1', '2016-01-28 10:39:16', '1'), ('33', '5', null, '/images/upload/2016/01/28/726378-2.jpg', '2', '2016-01-28 10:39:16', '1'), ('49', '1', null, '/images/upload/2016/01/28/896784-04.jpg', '1', '2016-01-28 14:44:56', '1'), ('50', '1', null, '/images/upload/2016/01/28/213157-05.jpg', '2', '2016-01-28 14:44:56', '1'), ('51', '1', null, '/images/upload/2016/01/28/191195-07.jpg', '3', '2016-01-28 14:44:56', '1'), ('52', '1', null, '/images/upload/2016/01/28/115688-11.jpg', '4', '2016-01-28 14:44:56', '1'), ('53', '2', null, '/images/upload/2016/01/28/562524-4.jpg', '1', '2016-01-28 14:45:37', '1'), ('54', '2', null, '/images/upload/2016/01/28/871019-03.png', '2', '2016-01-28 14:45:37', '1'), ('55', '2', null, '/images/upload/2016/01/28/852551-04.jpg', '3', '2016-01-28 14:45:37', '1'), ('56', '2', null, '/images/upload/2016/01/28/441381-05.jpg', '4', '2016-01-28 14:45:37', '1'), ('57', '6', null, '/images/upload/2016/01/28/961458-1.jpg', '1', '2016-01-28 16:10:23', '1'), ('58', '6', null, '/images/upload/2016/01/28/924315-2.jpg', '2', '2016-01-28 16:10:23', '1'), ('59', '6', null, '/images/upload/2016/01/28/355363-4.jpg', '3', '2016-01-28 16:10:23', '1'), ('60', '7', null, '/images/upload/2016/01/28/675074-2.jpg', '1', '2016-01-28 16:22:42', '1'), ('61', '7', null, '/images/upload/2016/01/28/140293-1.jpg', '2', '2016-01-28 16:22:42', '1'), ('62', '7', null, '/images/upload/2016/01/28/286076-3.jpeg', '3', '2016-01-28 16:22:42', '1'), ('63', '7', null, '/images/upload/2016/01/28/900648-5.jpg', '4', '2016-01-28 16:22:42', '1'), ('64', '4', null, '/images/upload/2016/05/12/930066-kc60.jpg', '1', '2016-05-12 11:05:49', '1'), ('65', '4', null, '/images/upload/2016/05/12/953856-ck59.jpg', '2', '2016-05-12 11:05:49', '1');
COMMIT;

-- ----------------------------
--  Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `tbl_user`
-- ----------------------------
BEGIN;
INSERT INTO `tbl_user` VALUES ('1', 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 'caodinhtuan@gmail.com', '1', '1', '2016-01-06 16:19:01', '2016-01-06 16:19:01');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
