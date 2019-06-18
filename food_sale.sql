-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 Haz 2019, 13:56:32
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `food_sale`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `ip`) VALUES
(1453, 'admin@hotmail.com', '$2y$10$YZlU6bOgSAc10XDwNqPth.D6hYuKjxwhKm2R/KChtr90VPRPweMNS', '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `img` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(1, 'Kebaplar', 'https://i.hizliresim.com/qd5JnW.jpg'),
(2, 'Izgaralar', 'https://i.hizliresim.com/bVnLRV.jpg'),
(3, 'Fırın Ürünleri', 'https://i.hizliresim.com/5aZGzq.jpg'),
(4, 'Çiğ Köfteler', 'https://i.hizliresim.com/AD9yPX.jpg'),
(5, 'Dürümler', 'https://i.hizliresim.com/qd5JnW.jpg'),
(6, 'Tatlılar', 'https://i.hizliresim.com/MVOa4a.jpg'),
(7, 'İçecekler', 'https://i.hizliresim.com/XMaEp6.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_register`
--

CREATE TABLE `email_register` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `m_date` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `email_register`
--

INSERT INTO `email_register` (`id`, `email`, `ip`, `m_date`) VALUES
(3977791, 'mehmet_tuna_anadolu@hotmail.com', '::1', '1557277528'),
(4874871, 'mehmet_tuna_anadolu@hotmail.com', '::1', '1557277445'),
(5781583, 'mehmet_tuna_anadolu@hotmail.com', '::1', '1557277454'),
(7490335, 'mehmet_tuna_anadolu@hotmail.com', '::1', '1557277463');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurye`
--

CREATE TABLE `kurye` (
  `firstname` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` text COLLATE utf8_turkish_ci NOT NULL,
  `id` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `data` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kurye`
--

INSERT INTO `kurye` (`firstname`, `lastname`, `date`, `username`, `password`, `id`, `data`) VALUES
('mehmet', 'tuna', '2352343523', 'mehmet_tuna', '235235235', '1', ''),
('Enes ', 'Budak', '235235', 'enes_budak', '235235', '2', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_amount` float NOT NULL DEFAULT '0',
  `icerik` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
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
(34278, 35747, 4, '', '1560029048', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '1', '0', '::1'),
(63282, 35747, 66, '', '1560025329', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '1', '2', '::1'),
(64568, 35747, 12, '', '1560853989', '[{\"id\":\"130287\",\"count\":1,\"price\":\"12\",\"name\":\"Kaymaklı Künefe\"}]', '0', '2', '::1'),
(72850, 35747, 40, '', '1560852385', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '::1'),
(95671, 35747, 3, '', '1560720164', '[{\"id\":\"523399\",\"count\":1,\"price\":\"3\",\"name\":\"Ayran (30 cl.)\"}]', '1', '0', '::1'),
(97902, 35747, 4, '', '1560025789', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '1', '0', '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `numberOfProduct` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `unlimited` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `live` tinyint(1) NOT NULL,
  `card_text` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `img` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `other_img` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `stores` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `long_text` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `price`, `name`, `date`, `numberOfProduct`, `categoryId`, `unlimited`, `live`, `card_text`, `img`, `other_img`, `stores`, `long_text`) VALUES
(130287, 12, 'Kaymaklı Künefe', '1557250006', 100, 6, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(136207, 4, 'Coca-Cola Şekersiz (33 cl.)', '1557250070', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(151929, 24, 'Adana Dürüm', '1557249832', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(205023, 4, 'Fuse Tea (33 cl.)', '1557250115', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(232635, 26, 'Kemikli Tavuk', '1557246058', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(237965, 24, 'Kaşarlı Pide', '1557248906', 100, 3, '1', 1, 'Mevsim salatası, söğüş domates, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, söğüş domates, yeşillik, limon'),
(264977, 3, 'Şalgam Suyu (33 cl.)', '1557250169', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(276675, 40, 'Beyti (1,5 porsiyon)', '1557245495', 100, 1, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(303636, 26, 'Kuzu Kaburga', '1557246136', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(309440, 24, 'Kuşbaşı Dürüm', '1557249847', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(327652, 4, 'Cappy (33 cl.)', '1557250104', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(348995, 4, 'Coca-Cola Light (33 cl.)', '1557250063', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(365777, 24, 'Ciğer Dürüm', '1557249866', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(371670, 10, 'Künefe', '1557249991', 100, 6, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(372212, 26, 'Çöp Şiş', '1557245929', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(374382, 24, 'KEmiksiz Kaburga Dürüm', '1557249898', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(381622, 13, 'Fıstıklı Künefe', '1557250016', 100, 6, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(463701, 26, 'AntepLahmacun (3 Adet)', '1557246253', 100, 3, '1', 1, 'Mevsim salatası, söğüş domates, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, söğüş domates, yeşillik, limon'),
(486555, 26, 'Tavuk Pirzola', '1557246090', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(490605, 4, 'Coca-Cola (33 cl.)', '1557250054', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(506901, 40, 'Külbastı', '1557246040', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(523399, 3, 'Ayran (30 cl.)', '1557250129', 100, 7, '1', 1, 'Kutu', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(548493, 26, 'Kemiksiz Tavuk', '1557246067', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(574976, 6, 'Coca-Cola Şekersiz (1 L.)', '1557250237', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(621520, 24, 'Beyti Dürüm', '1557249880', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(648308, 14, 'Fıstıklı Kaymaklı Künefe', '1557250026', 100, 6, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(671107, 3, 'Açık Ayran (33 cl.)', '1557250143', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(709151, 1.5, 'Su', '1557250202', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(716353, 1.5, 'Soda', '1557250189', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(765051, 26, 'Sucuklu Kaşarlı Pide', '1557248965', 100, 3, '1', 1, 'Mevsim salatası, söğüş domates, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, söğüş domates, yeşillik, limon'),
(781750, 26, 'Kuşbaşı Kebap', '1557245471', 100, 1, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(793288, 4, 'Fanta (33 cl.)', '1557250082', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(794667, 6, 'Coca-Cola (1 L.)', '1557250218', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(802205, 27, 'Karışık Pide', '1557248934', 100, 3, '1', 1, 'Kuşbaşı et, kaşar peyniri ve yanında mevsim salatası, söğüş domates, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Kuşbaşı et, kaşar peyniri ve yanında mevsim salatası, söğüş domates, yeşillik, limon'),
(806792, 4, 'Sprite (33 cl.)', '1557250091', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(809453, 40, 'Kazbaşı', '1557245977', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(818052, 26, 'Ciğer  Şiş', '1557245962', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(876332, 40, 'Et Pirzola (Kemikli)', '1557246025', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(894674, 15, 'Çiğ Köfte ( 12 Sıkım )', '1557249782', 100, 4, '1', 1, 'Marul, yeşillik, ekmek ile', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Marul, yeşillik, ekmek ile'),
(895870, 4, 'Açık Ayran (50 cl.)', '1557250159', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(926243, 8, 'Açık Ayran (1 L.)', '1557250249', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(929658, 26, 'Kanat', '1557246075', 100, 2, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(930254, 24, 'Çöp Şiş Dürüm', '1557249858', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(936420, 2, 'Meyveli Soda', '1557250182', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(940352, 6, 'Coca-Cola Light (1 L.)', '1557250229', 100, 7, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(942504, 40, 'Patlıcan Kebap (1,5 porsiyon)', '1557245512', 100, 1, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(962937, 26, 'Kuşbaşı Pide', '1557248893', 100, 3, '1', 1, 'Mevsim salatası, söğüş domates, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, söğüş domates, yeşillik, limon'),
(982211, 26, 'Adana Kebap', '1557245392', 100, 1, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon'),
(992894, 24, 'Tavuk Dürüm', '1557249873', 100, 5, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon'),
(993298, 24, 'Adana Lahmacun (5 Adet)', '1557246212', 100, 3, '1', 1, 'Mevsim salatası, söğüş domates, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', 'Mevsim salatası, söğüş domates, yeşillik, limon');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `rezervasyon`
--

CREATE TABLE `rezervasyon` (
  `id` int(11) NOT NULL,
  `time` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `e_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kisi_sayisi` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `m_status` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `rez_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rezervasyon`
--

INSERT INTO `rezervasyon` (`id`, `time`, `name`, `e_mail`, `phone`, `kisi_sayisi`, `m_status`, `ip`, `rez_date`) VALUES
(18553, '1557277760', 'mehmet tuna', 'mehmet_tuna_anadolu@hotmail.com', '5302145201', '2', '1', '::1', '2019-05-09'),
(18683, '1557690369', 'mehmet tuna', 'tesasdasfdafawfwa@hotmail.com', '5302145201', '4', '2', '::1', '2019-05-02'),
(30328, '1557430747', 'Enes Budak', 'enesbudak.mdbf17@iste.edu.tr', '53899774', '5', '1', '172.20.10.3', '2019-05-17'),
(30393, '1557967454', 'mehmet tuna', 'mehmet_tuna_anadolu@hotmail.com', '5302145201', '2', '0', '::1', '2019-05-09'),
(33576, '1557932407', 'wqrqr', 'mehmet_tuna_anadolu@hotmail.com', '5302145201', '5', '0', '::1', '2019-05-23'),
(51563, '1557908766', 'deneme5', 'deneme@hotmail.com', '5302145201', '5', '2', '::1', '2019-05-09'),
(56802, '1557690540', 'Muhammet yurdan', 'muhammetyurdan369@gmail.com', '05347384165', '5', '2', '::1', '2019-05-14'),
(92826, '1557690343', 'mehmet tuna', 'sadi.anan.güzel@sadi.code', '5302145201', '4', '1', '::1', '2019-05-15'),
(99114, '1560852709', 'gunluk deneme', 'anil@demostore.com', '5302145201', '12', '0', '::1', '2019-06-06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL DEFAULT '1',
  `site_name` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `site_description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `site_create_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `site_url` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `site_online` tinyint(1) NOT NULL DEFAULT '1',
  `site_lisans` varchar(35) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `site`
--

INSERT INTO `site` (`id`, `site_name`, `site_description`, `site_create_date`, `site_url`, `site_online`, `site_lisans`) VALUES
(1, 'localhost', 'site aciklama ksimi demo 2', '1559808638', 'http://localhost:81', 1, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `first_order` tinyint(1) NOT NULL DEFAULT '0',
  `registration_date` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `verification_code` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `adress` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `adress_2` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `email_verified`, `first_order`, `registration_date`, `verification_code`, `ip`, `phone`, `adress`, `adress_2`) VALUES
(15883, 'enes@hotmail.com', '$2y$10$mvx/Mzc0jrT6f3cNB9pXoOSxwhlggbpP8IlOx3hJVRSQ6PXg/447a', 'enes', 'tuna', 1, 0, '1557070204', '', '::1', '5307280376', 'ellek kasabası', ''),
(35747, 'mehmet_tuna_anadolu@hotmail.com', '$2y$10$PB8USNS58UOnesfhlHmuJu7FbOsCT2VC1SPy7V4GDoTTV1tFf9jTa', 'mehmet', 'tuna', 1, 1, '1557057734', '', '::1', '5307280376', 'ellek kasabası ygr oauıyergo ıaygrou ıareoı yaeuwrg aueryg aoueguyaeg uyar eouıa', ''),
(45435, 'new@hotmail.com', '$2y$10$zMongk/LSiBCqTrljrR0UundTrc/sEwnkmZx1iQ63pD8/5Oljd4BW', 'enes', 'tuna', 1, 0, '1557167025', '', '::1', '5307280376', 'ellek kasabası', ''),
(86541, 'admin@hotmail.com', '$2y$10$n4q9S5Gpiv.XIDZTFvoJk.NL2bIPMN944ucv6u4RVKPNX8Av/3ERa', 'enes', 'tuna', 1, 0, '1557076972', '', '::1', '5307280376', 'ellek kasabası', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_statistics`
--

CREATE TABLE `user_statistics` (
  `id` int(11) NOT NULL,
  `m_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `details` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `worker`
--

CREATE TABLE `worker` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `m_date` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `authority` varchar(10) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `worker`
--

INSERT INTO `worker` (`id`, `email`, `password`, `name`, `m_date`, `ip`, `authority`) VALUES
(235235, 'demo@hotmail.com', '12345', 'mehmet tuna', '325235', '::1', '2');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`username`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `email_register`
--
ALTER TABLE `email_register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);

--
-- Tablo için indeksler `kurye`
--
ALTER TABLE `kurye`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`user_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `rezervasyon`
--
ALTER TABLE `rezervasyon`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);

--
-- Tablo için indeksler `user_statistics`
--
ALTER TABLE `user_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
