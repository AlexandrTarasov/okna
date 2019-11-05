#
# TABLE STRUCTURE FOR: suppliers
#

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager_phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manager_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager2_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manager2_phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manager2_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `viber` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

