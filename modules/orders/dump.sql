#
# TABLE STRUCTURE FOR: orders
#

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `calculation_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contract_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `installer_id` int(10) NOT NULL,
  `gauger_id` int(10) NOT NULL COMMENT 'Same as Installer',
  `discount` int(5) NOT NULL,
  `order_date` date NOT NULL,
  `measurement_date` date NOT NULL,
  `readiness_date` date NOT NULL,
  `removal_date` date NOT NULL,
  `total_price` int(100) NOT NULL,
  `montage_price` int(100) NOT NULL,
  `prepaid` float NOT NULL,
  `additional_price` float NOT NULL,
  `measuring_price` float NOT NULL,
  `gazda_price` float NOT NULL,
  `balance` float NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('new','processing','measuring','during','in_work','complete','fulfilled','archive') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

