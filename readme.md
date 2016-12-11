



CREATE SCHEMA IF NOT EXISTS `tictactoe` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `tictactoe`.`games` (
  `id_game` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player1` varchar(15) DEFAULT NULL,
  `player2` varchar(15) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_game`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tictactoe`.`matches` (
  `id_match` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `games_id_game` int(10) unsigned NOT NULL,
  `winner` tinyint(1) DEFAULT NULL,
  `match` varchar(17) DEFAULT NULL,
  `ended_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_match`),
  KEY `fk_matches_games_idx` (`games_id_game`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
