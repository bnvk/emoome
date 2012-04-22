INSERT INTO `settings` VALUES(NULL, 1, 'emoome', 'enabled', 'TRUE');

CREATE TABLE `emoome_words_link` (
  `link_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `word_id` int(11) DEFAULT NULL,
  `use` int(11) DEFAULT NULL,
  `time` int(16),
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_words` (
  `word_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(128) DEFAULT NULL,
  `stem` varchar(128) DEFAULT NULL,
  `type` char(1) DEFAULT 'U',
  `type_sub` char(1) DEFAULT 'U',
  `speech` varchar(4) DEFAULT 'U',
  PRIMARY KEY (`word_id`)
) ENGINE=MyISAM AUTO_INCREMENT=799 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` char(16) DEFAULT NULL,
  `time` int(16),  
  `geo_lat` varchar(16) DEFAULT NULL,
  `geo_lon` varchar(16) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_actions` (
  `action_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `word_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_words_taxonomy` (
  `word_taxonomy_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` int(11) NOT NULL,
  `taxonomy` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `count` int(5) NOT NULL,
  PRIMARY KEY (`word_taxonomy_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;