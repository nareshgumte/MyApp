CREATE TABLE IF NOT EXISTS `int_friends` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `uniq_id` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image_url` varchar(200) DEFAULT NULL,
  `network` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=330 ;
CREATE TABLE `int_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(56) NOT NULL,
  `firstname` varchar(56) DEFAULT NULL,
  `lastname` varchar(56) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(100) NOT NULL DEFAULT 'nouser.jpg',
  `password` varchar(100) NOT NULL,
  `login_via` int(2) NOT NULL DEFAULT '0' COMMENT '0--intropost,1--facebook,2--linkedin',
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0---user 1---admin 2--superadmin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 |BLE `int_login` ADD `status` ENUM( "0", "1", "2" ) NOT NULL DEFAULT '0' COMMENT '0---user 1---admin 2--superadmin' AFTER `login_via` ;