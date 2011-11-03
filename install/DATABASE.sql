INSERT INTO `settings` VALUES(NULL, 1, 'emoome', 'enabled', 'TRUE');

CREATE TABLE `emoome_words_link` (
  `link_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `word_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_words` (
  `word_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(128) DEFAULT NULL,
  `stem` varchar(128) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_log` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` char(16) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `emoome_actions` (
  `action_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `log_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;