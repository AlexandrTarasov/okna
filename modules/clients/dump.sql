#
# TABLE STRUCTURE FOR: clients
#

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `phone2` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `e-mail` varchar(255) NOT NULL,
  `viber` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

