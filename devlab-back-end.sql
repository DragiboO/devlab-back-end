/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_public` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `album_like`;
CREATE TABLE `album_like` (
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `album_id` (`album_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `album_like_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`),
  CONSTRAINT `album_like_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `album_title`;
CREATE TABLE `album_title` (
  `album_id` int(11) NOT NULL,
  `title_id` int(11) DEFAULT NULL,
  KEY `album_id` (`album_id`),
  CONSTRAINT `album_title_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pending_request`;
CREATE TABLE `pending_request` (
  `user_id_owner` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `user_id_request` int(11) NOT NULL,
  KEY `user_id_owner` (`user_id_owner`),
  KEY `album_id` (`album_id`),
  KEY `user_id_request` (`user_id_request`),
  CONSTRAINT `pending_request_ibfk_1` FOREIGN KEY (`user_id_owner`) REFERENCES `user` (`id`),
  CONSTRAINT `pending_request_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`),
  CONSTRAINT `pending_request_ibfk_3` FOREIGN KEY (`user_id_request`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `validated` int(11) NOT NULL,
  `validated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user_album`;
CREATE TABLE `user_album` (
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `is_owner` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `user_album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `user_album_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;