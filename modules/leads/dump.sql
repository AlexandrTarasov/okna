#
# TABLE STRUCTURE FOR: leads
#

DROP TABLE IF EXISTS `leads`;

CREATE TABLE `leads` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(255) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `source` enum('adwords','facebook','instagram','recommendation','call','youtube') COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('new','processing','accepted','canceled') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

