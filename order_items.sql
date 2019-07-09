-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 08 Tem 2019, 01:26:39
-- Sunucu sürümü: 5.7.26
-- PHP Sürümü: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ciqaysof_food_sale`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_amount` float NOT NULL DEFAULT '0',
  `icerik` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `m_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `orders` text COLLATE utf8_turkish_ci NOT NULL,
  `m_status` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `order_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`order_id`, `user_id`, `order_amount`, `icerik`, `m_date`, `orders`, `m_status`, `order_status`, `ip`) VALUES
(20844, 35747, 40, '', '1560025176', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '::1'),
(23724, 11246, 66, NULL, '1562447656', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '5', '1', '5.46.109.169'),
(34278, 35747, 4, '', '1560029048', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '1', '0', '::1'),
(37336, 35747, 26, 'daha hizli getirin cok yavas calisiyonuz', '1560928559', '[{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Kebap\"}]', '1', '2', '::1'),
(43099, 15883, 66, NULL, '1562252018', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '0', '0', '5.46.25.95'),
(45483, 45435, 40, NULL, '1562510036', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '0', '1', '151.135.173.84'),
(46163, 45435, 40, NULL, '1562350989', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '151.135.173.84'),
(46592, 45435, 4, NULL, '1562510382', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola ?ekersiz (33 cl.)\"}]', '0', '0', '151.135.173.84'),
(48964, 31411, 217, NULL, '1562451209', '[{\"id\":\"276675\",\"count\":3,\"price\":120,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":3,\"price\":78,\"name\":\"Ku?ba?? Kebap\"},{\"id\":\"894674\",\"count\":1,\"price\":\"15\",\"name\":\"Çi? Köfte ( 12 S?k?m )\"},{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola ?ekersiz (33 cl.)\"}]', '5', '0', '78.190.77.27'),
(54833, 45435, 26, NULL, '1562429451', '[{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '5', '0', '151.135.173.84'),
(63282, 35747, 66, '', '1560025329', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '1', '2', '::1'),
(64561, 45435, 40, NULL, '1562510971', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '0', '0', '151.135.173.84'),
(64568, 35747, 12, '', '1560853989', '[{\"id\":\"130287\",\"count\":1,\"price\":\"12\",\"name\":\"Kaymaklı Künefe\"}]', '0', '2', '::1'),
(65595, 45435, 40, NULL, '1562427598', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '151.135.173.84'),
(71852, 15883, 66, NULL, '1562251922', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '0', '1', '5.46.25.95'),
(72850, 35747, 40, '', '1560852385', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '::1'),
(76861, 45435, 26, NULL, '1562510237', '[{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '0', '0', '151.135.173.84'),
(91719, 55065, 40, NULL, '1562251441', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '151.135.173.84'),
(95671, 35747, 3, '', '1560720164', '[{\"id\":\"523399\",\"count\":1,\"price\":\"3\",\"name\":\"Ayran (30 cl.)\"}]', '1', '0', '::1'),
(97902, 35747, 4, '', '1560025789', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '1', '0', '::1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
