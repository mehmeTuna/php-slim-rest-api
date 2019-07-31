-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 31 Tem 2019, 16:26:50
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
(1453, 'admin@hotmail.com', '$2y$10$RHajtzE57250ezO8CyuuseFocFMPANAg5hYlOHPKssSmNdvK7JWeS', '::1');

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
(1, 'Kebaplar', 'img/kebab.jpg'),
(2, 'Izgaralar', 'img/izgara.jpg'),
(3, 'Fırın Ürünleri', 'https://i.hizliresim.com/5aZGzq.jpg'),
(4, 'Çiğ Köfteler', 'img/cigkofte.jpg'),
(5, 'Dürümler', 'img/dürüm.jpg'),
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
-- Tablo için tablo yapısı `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_turkish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `feature`
--

INSERT INTO `feature` (`id`, `content`) VALUES
(159, '[{\"id\":903,\"content\":\"Acılı\"}]'),
(498, '[]'),
(557, '[{\"id\":214,\"content\":\"Yarım Pide\"},{\"id\":367,\"content\":\"Soğanlı\"},{\"id\":331,\"content\":\"Soğansız\"}]');

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
  `data` text COLLATE utf8_turkish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kurye`
--

INSERT INTO `kurye` (`firstname`, `lastname`, `date`, `username`, `password`, `id`, `data`) VALUES
('Yaşar', 'Budak', '1563144837', 'yasar@hotmail.com', '$2y$10$Cj7kDBaKQ7S3bj8.S4c73OkXh9tA70rjY.pyi01By4GEMADa5FEji', '18157', NULL),
('ERSEN', 'CAN', '1563620839', 'ersen', '$2y$10$9xomAVEKbmdRZ8m86CoyoeM6JD0nejH8fTG7v3l7tSWCvDXgh7Gmm', '76235', NULL),
('Yemlihan', 'Budak', '1563144856', 'yemlihan@hotmail.com', '$2y$10$eBk51/W82/Nr2XEREgcon.xZ0l9Yhas/09D7NTakrDqskxKYCD/Je', '82771', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurye_takip`
--

CREATE TABLE `kurye_takip` (
  `id` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `order_id` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kurye_id` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `start_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `finish_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kurye_takip`
--

INSERT INTO `kurye_takip` (`id`, `order_id`, `kurye_id`, `start_date`, `finish_date`) VALUES
('1180', '51143', '76235', '1563631431', '0'),
('1275', '35420', '2', '1563144305', '0'),
('1287', '84391', '2', '1563144318', '0'),
('1303', '67916', '82771', '1563402457', '0'),
('2113', '49864', '2', '1563144286', '0'),
('2156', '54833', '2', '1562432771', '0'),
('3379', '96786', '82771', '1564574028', '0'),
('3556', '85049', '82771', '1563190216', '0'),
('3693', '15790', '82771', '1563307843', '0'),
('4024', '94410', '18157', '1563145029', '0'),
('4261', '13955', '2', '1563144061', '0'),
('4274', '56860', '18157', '1563146730', '0'),
('4683', '72662', '2', '1562708715', '0'),
('4826', '36538', '2', '1563144312', '0'),
('5250', '35541', '2', '1563031077', '0'),
('5445', '52169', '82771', '1564574021', '0'),
('5801', '18886', '18157', '1563190420', '0'),
('5932', '23724', '2', '1562451821', '0'),
('5994', '48964', '2', '1562451771', '0'),
('6008', '35541', '2', '1563051522', '0'),
('6232', '38887', '2', '1562619831', '0'),
('6394', '49962', '2', '1562698536', '0'),
('6437', '19921', '18157', '1563145067', '0'),
('6720', '53615', '82771', '1563189365', '0'),
('6994', '53543', '2', '1562618103', '0'),
('7322', '90307', '18157', '1564574042', '0'),
('7702', '17933', '82771', '1563402473', '0'),
('7982', '72010', '18157', '1563307886', '0'),
('8311', '63941', '82771', '1563145019', '0'),
('8440', '53615', '18157', '1563189396', '0'),
('8538', '15790', '18157', '1563225571', '0'),
('8902', '74485', '82771', '1564244117', '0'),
('8923', '66892', '18157', '1563620498', '0'),
('9086', '19607', '2', '1563144076', '0'),
('9119', '65595', '2', '1562432764', '0'),
('9296', '87319', '82771', '1563146707', '0'),
('9327', '97758', '2', '1563143250', '0'),
('9332', '65307', '76235', '1563638202', '0'),
('9557', '58975', '18157', '1563620456', '0'),
('9642', '21976', '2', '1563144069', '0'),
('9650', '90357', '82771', '1564574034', '0'),
('9668', '44590', '82771', '1563620427', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_features`
--

CREATE TABLE `order_features` (
  `order_id` int(11) NOT NULL,
  `featuresDetay` text COLLATE utf8_turkish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adress` varchar(10) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'adress',
  `order_amount` float NOT NULL DEFAULT '0',
  `icerik` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `features` int(10) DEFAULT NULL,
  `m_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `orders` text COLLATE utf8_turkish_ci NOT NULL,
  `m_status` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `order_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`order_id`, `user_id`, `adress`, `order_amount`, `icerik`, `features`, `m_date`, `orders`, `m_status`, `order_status`, `ip`) VALUES
(13955, 15883, 'adress', 50, '', NULL, '1563141299', '[{\"id\":\"232635\",\"count\":\"1\",\"price\":26,\"name\":\"Kemikli Tavuk\"},{\"id\":\"309440\",\"count\":\"1\",\"price\":24,\"name\":\"Kuşbaşı Dürüm\"}]', '5', '1', '31.223.58.246'),
(15790, 48660, 'adress', 186, '', NULL, '1563225320', '[{\"id\":\"276675\",\"count\":\"2\",\"price\":80,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"942504\",\"count\":\"2\",\"price\":80,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"982211\",\"count\":\"1\",\"price\":26,\"name\":\"Adana Kebap\"}]', '5', '1', '31.223.58.246'),
(17933, 86541, 'adress', 26, '', NULL, '1563402245', '[{\"id\":\"982211\",\"count\":\"1\",\"price\":26,\"name\":\"Adana Kebap\"}]', '5', '1', '188.119.8.34'),
(18886, 92930, 'adress', 40, '', NULL, '1563190189', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '1', '5.46.5.201'),
(19607, 15883, 'adress', 40, '', NULL, '1563141460', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '31.223.58.246'),
(19740, 69962, 'adress', 40, '', NULL, '1563639091', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"}]', '0', '1', '78.190.64.36'),
(19921, 86227, 'adress', 40, 'sadsadsadasdsa', NULL, '1563145037', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '5.46.5.201'),
(20844, 35747, 'adress', 40, '', NULL, '1560025176', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '::1'),
(21452, 55858, 'adress', 100, '', NULL, '1563735697', '[{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"894674\",\"count\":2,\"price\":30,\"name\":\"Çiğ Köfte ( 12 Sıkım )\"},{\"id\":\"205023\",\"count\":\"1\",\"price\":4,\"name\":\"Fuse Tea (33 cl.)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"}]', '0', '0', '78.190.69.191'),
(21976, 15883, 'adress', 80, '', NULL, '1563141400', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"}]', '5', '0', '31.223.58.246'),
(22417, 45435, 'adress', 61.5, '', NULL, '1564177504', '[{\"id\":\"277101\",\"count\":5,\"price\":61.5,\"name\":\"deneme ürünü 5\",\"features\":[{\"count\":5,\"items\":[\"836\",\"65\"]}]}]', '1', '1', '::1'),
(23724, 11246, 'adress', 66, NULL, NULL, '1562447656', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '5', '1', '5.46.109.169'),
(24919, 45435, 'adress', 61.5, 'postmandan sipariş verme', NULL, '1564334904', '[{\"id\":\"277101\",\"count\":5,\"features\":[{\"count\":5,\"items\":[\"836\",\"65\"]}],\"price\":61.5,\"name\":\"deneme ürünü 5\"}]', '1', '0', '::1'),
(34278, 35747, 'adress', 4, '', NULL, '1560029048', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '5', '0', '::1'),
(35420, 45435, 'adress', 40, '', NULL, '1563141811', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '1', '5.46.5.201'),
(35541, 45435, 'adress', 40, 'fyulşfıuşfuış', NULL, '1563030986', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '5.177.190.144'),
(36538, 15883, 'adress', 160, 'çabuk olursa', NULL, '1563142282', '[{\"id\":\"276675\",\"count\":\"4\",\"price\":160,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '1', '31.223.58.246'),
(36655, 45435, 'adress_2', 61.5, 'Teelfon onay kısmına eklendi', NULL, '1564328171', '[{\"id\":\"277101\",\"count\":5,\"price\":61.5,\"name\":\"deneme ürünü 5\"}]', '1', '1', '::1'),
(37336, 35747, 'adress', 26, 'daha hizli getirin cok yavas calisiyonuz', NULL, '1560928559', '[{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Kebap\"}]', '5', '2', '::1'),
(38887, 45435, 'adress', 26, 'açişişişişişişi', NULL, '1562619664', '[{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '5', '1', '151.135.173.84'),
(43099, 15883, 'adress', 66, NULL, NULL, '1562252018', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '5', '0', '5.46.25.95'),
(44590, 46285, 'adress', 154, '', NULL, '1563602523', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"237965\",\"count\":\"1\",\"price\":24,\"name\":\"Kaşarlı Pide\"},{\"id\":\"151929\",\"count\":\"1\",\"price\":24,\"name\":\"Adana Dürüm\"}]', '5', '1', '78.190.69.191'),
(45025, 94193, 'adress', 211, 'Bol Yeşillik ', NULL, '1563108048', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"303636\",\"count\":1,\"price\":\"26\",\"name\":\"Kuzu Kaburga\"},{\"id\":\"486555\",\"count\":1,\"price\":\"26\",\"name\":\"Tavuk Pirzola\"},{\"id\":\"809453\",\"count\":1,\"price\":\"40\",\"name\":\"Kazbaşı\"},{\"id\":\"962937\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Pide\"},{\"id\":\"802205\",\"count\":1,\"price\":\"27\",\"name\":\"Karışık Pide\"}]', '5', '1', '31.223.58.246'),
(45483, 45435, 'adress', 40, NULL, NULL, '1562510036', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '1', '151.135.173.84'),
(46163, 45435, 'adress', 40, NULL, NULL, '1562350989', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '151.135.173.84'),
(46592, 45435, 'adress', 4, NULL, NULL, '1562510382', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola ?ekersiz (33 cl.)\"}]', '5', '0', '151.135.173.84'),
(47907, 26522, 'adress', 106, '', NULL, '1564071106', '[{\"id\":\"276675\",\"count\":1,\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":1,\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"}]', '0', '0', '::1'),
(48964, 31411, 'adress', 217, NULL, NULL, '1562451209', '[{\"id\":\"276675\",\"count\":3,\"price\":120,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":3,\"price\":78,\"name\":\"Ku?ba?? Kebap\"},{\"id\":\"894674\",\"count\":1,\"price\":\"15\",\"name\":\"Çi? Köfte ( 12 S?k?m )\"},{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola ?ekersiz (33 cl.)\"}]', '5', '0', '78.190.77.27'),
(49864, 15883, 'adress', 132, '', NULL, '1563141798', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"982211\",\"count\":\"1\",\"price\":26,\"name\":\"Adana Kebap\"}]', '5', '1', '31.223.58.246'),
(49962, 45435, 'adress', 14, 'wwerwerw', NULL, '1562698481', '[{\"id\":\"648308\",\"count\":1,\"price\":\"14\",\"name\":\"Fıstıklı Kaymaklı Künefe\"}]', '5', '0', '5.177.130.28'),
(51143, 56359, 'adress', 80, 'soğansız olsun', NULL, '1563631158', '[{\"id\":\"276675\",\"count\":\"2\",\"price\":80,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '37.154.75.232'),
(52169, 45435, 'adress_2', 54, 'rftyujıo', NULL, '1564529846', '[{\"id\":\"530891\",\"count\":2,\"features\":[{\"count\":1,\"items\":[903]},{\"count\":1,\"items\":[]}],\"price\":54,\"name\":\"Adana Kebap\"}]', '5', '0', '::1'),
(53543, 15883, 'adress', 52, 'h?zl? ya', NULL, '1562618028', '[{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"},{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '5', '1', '151.135.173.84'),
(53615, 92930, 'adress', 980, 'Sıcak olusn lütfen', NULL, '1563189263', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"982211\",\"count\":\"1\",\"price\":26,\"name\":\"Adana Kebap\"},{\"id\":\"232635\",\"count\":\"6\",\"price\":156,\"name\":\"Kemikli Tavuk\"},{\"id\":\"303636\",\"count\":\"1\",\"price\":26,\"name\":\"Kuzu Kaburga\"},{\"id\":\"486555\",\"count\":\"1\",\"price\":26,\"name\":\"Tavuk Pirzola\"},{\"id\":\"372212\",\"count\":\"1\",\"price\":26,\"name\":\"Çöp Şiş\"},{\"id\":\"548493\",\"count\":\"1\",\"price\":26,\"name\":\"Kemiksiz Tavuk\"},{\"id\":\"506901\",\"count\":\"1\",\"price\":40,\"name\":\"Külbastı\"},{\"id\":\"809453\",\"count\":\"1\",\"price\":40,\"name\":\"Kazbaşı\"},{\"id\":\"929658\",\"count\":\"1\",\"price\":26,\"name\":\"Kanat\"},{\"id\":\"876332\",\"count\":\"1\",\"price\":40,\"name\":\"Et Pirzola (Kemikli)\"},{\"id\":\"818052\",\"count\":\"1\",\"price\":26,\"name\":\"Ciğer  Şiş\"},{\"id\":\"463701\",\"count\":\"7\",\"price\":182,\"name\":\"AntepLahmacun (3 Adet)\"},{\"id\":\"993298\",\"count\":\"2\",\"price\":48,\"name\":\"Adana Lahmacun (5 Adet)\"},{\"id\":\"894674\",\"count\":\"1\",\"price\":15,\"name\":\"Çiğ Köfte ( 12 Sıkım )\"},{\"id\":\"374382\",\"count\":\"1\",\"price\":24,\"name\":\"KEmiksiz Kaburga Dürüm\"},{\"id\":\"365777\",\"count\":\"1\",\"price\":24,\"name\":\"Ciğer Dürüm\"},{\"id\":\"309440\",\"count\":\"1\",\"price\":24,\"name\":\"Kuşbaşı Dürüm\"},{\"id\":\"151929\",\"count\":\"1\",\"price\":24,\"name\":\"Adana Dürüm\"},{\"id\":\"621520\",\"count\":\"1\",\"price\":24,\"name\":\"Beyti Dürüm\"},{\"id\":\"930254\",\"count\":\"1\",\"price\":24,\"name\":\"Çöp Şiş Dürüm\"},{\"id\":\"648308\",\"count\":\"1\",\"price\":14,\"name\":\"Fıstıklı Kaymaklı Künefe\"},{\"id\":\"381622\",\"count\":\"1\",\"price\":13,\"name\":\"Fıstıklı Künefe\"}]', '5', '0', '5.46.5.201'),
(54010, 37669, 'adress', 74, '', NULL, '1562793829', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"205023\",\"count\":1,\"price\":\"4\",\"name\":\"Fuse Tea (33 cl.)\"},{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '5', '0', '78.190.69.191'),
(54833, 45435, 'adress', 26, NULL, NULL, '1562429451', '[{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '5', '0', '151.135.173.84'),
(56860, 15883, 'adress', 52, '', NULL, '1563146524', '[{\"id\":\"303636\",\"count\":\"1\",\"price\":26,\"name\":\"Kuzu Kaburga\"},{\"id\":\"372212\",\"count\":\"1\",\"price\":26,\"name\":\"Çöp Şiş\"}]', '5', '0', '31.223.58.246'),
(58975, 46285, 'adress', 125, 'Sogansiz ', NULL, '1563602641', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"894674\",\"count\":\"1\",\"price\":15,\"name\":\"Çiğ Köfte ( 12 Sıkım )\"},{\"id\":\"205023\",\"count\":\"1\",\"price\":4,\"name\":\"Fuse Tea (33 cl.)\"}]', '5', '1', '78.190.69.191'),
(60715, 45435, 'adress', 26, 'kuşbaşı kebap açıklama kısmı', NULL, '1562619119', '[{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Kebap\"}]', '1', '1', '151.135.173.84'),
(61739, 15883, 'adress', 120, 'sdsadsad', NULL, '1563144532', '[{\"id\":\"276675\",\"count\":\"3\",\"price\":120,\"name\":\"Beyti (1,5 porsiyon)\"}]', '2', '1', '31.223.58.246'),
(63282, 35747, 'adress', 66, '', NULL, '1560025329', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '1', '2', '::1'),
(63941, 45435, 'adress', 260, 'Kdksk', NULL, '1563144973', '[{\"id\":\"232635\",\"count\":\"10\",\"price\":260,\"name\":\"Kemikli Tavuk\"}]', '5', '0', '5.46.5.201'),
(64561, 45435, 'adress', 40, NULL, NULL, '1562510971', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '151.135.173.84'),
(64568, 35747, 'adress', 12, '', NULL, '1560853989', '[{\"id\":\"130287\",\"count\":1,\"price\":\"12\",\"name\":\"Kaymaklı Künefe\"}]', '5', '2', '::1'),
(65307, 34142, 'adress', 54, '', NULL, '1563636545', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"648308\",\"count\":\"1\",\"price\":14,\"name\":\"Fıstıklı Kaymaklı Künefe\"}]', '5', '0', '78.190.64.36'),
(65595, 45435, 'adress', 40, NULL, NULL, '1562427598', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '0', '151.135.173.84'),
(66892, 65027, 'adress', 107, 'dürüm soğansız', NULL, '1563619282', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"486555\",\"count\":\"1\",\"price\":26,\"name\":\"Tavuk Pirzola\"},{\"id\":\"894674\",\"count\":\"1\",\"price\":15,\"name\":\"Çiğ Köfte ( 12 Sıkım )\"}]', '5', '0', '95.108.225.215'),
(66926, 45435, 'adress', 400, '', NULL, '1563466545', '[{\"id\":\"276675\",\"count\":\"10\",\"price\":400,\"name\":\"Beyti (1,5 porsiyon)\"}]', '0', '0', '176.220.111.135'),
(67916, 86541, 'adress', 92, '', NULL, '1563400862', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"982211\",\"count\":\"1\",\"price\":26,\"name\":\"Adana Kebap\"},{\"id\":\"463701\",\"count\":\"1\",\"price\":26,\"name\":\"AntepLahmacun (3 Adet)\"}]', '1', '1', '188.119.8.34'),
(69126, 45435, 'adress', 0, '', NULL, '1564176973', '[{\"id\":\"277101\",\"count\":5,\"price\":0,\"name\":\"deneme ürünü 5\",\"features\":[{\"count\":5,\"items\":[\"836\",\"65\"]}]}]', '1', '0', '::1'),
(70391, 45435, 'adress_2', 24.6, '', NULL, '1564328308', '[{\"id\":\"277101\",\"count\":2,\"price\":24.6,\"name\":\"deneme ürünü 5\"}]', '2', '0', '::1'),
(71852, 15883, 'adress', 66, NULL, NULL, '1562251922', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '5', '1', '5.46.25.95'),
(72010, 94193, 'adress', 164, '', NULL, '1563307362', '[{\"id\":\"276675\",\"count\":\"2\",\"price\":80,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"486555\",\"count\":\"1\",\"price\":26,\"name\":\"Tavuk Pirzola\"},{\"id\":\"648308\",\"count\":\"1\",\"price\":14,\"name\":\"Fıstıklı Kaymaklı Künefe\"},{\"id\":\"136207\",\"count\":\"1\",\"price\":4,\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '5', '1', '188.119.8.34'),
(72662, 86541, 'adress', 106, 'denemeee', NULL, '1562708638', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":1,\"price\":\"40\",\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"}]', '5', '1', '5.177.130.28'),
(72850, 35747, 'adress', 40, '', NULL, '1560852385', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '::1'),
(74121, 45435, 'adress', 123, 'postmandan sipariş verme', NULL, '1564334566', '[{\"id\":\"277101\",\"count\":10,\"price\":123,\"name\":\"deneme ürünü 5\",\"features\":null}]', '5', '0', '::1'),
(74485, 45435, 'adress', 0, '', NULL, '1564176773', '[{\"id\":\"277101\",\"count\":50,\"price\":0,\"name\":\"deneme ürünü 5\",\"features\":[{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]},{\"count\":5,\"items\":[\"836\",\"65\"]}]}]', '5', '0', '::1'),
(74568, 45435, 'adress_2', 86.1, '', NULL, '1564332410', '[{\"id\":\"277101\",\"count\":7,\"price\":86.1,\"name\":\"deneme ürünü 5\",\"features\":null}]', '1', '0', '::1'),
(76861, 45435, 'adress', 26, NULL, NULL, '1562510237', '[{\"id\":\"232635\",\"count\":1,\"price\":\"26\",\"name\":\"Kemikli Tavuk\"}]', '5', '0', '151.135.173.84'),
(77852, 45435, 'adress', 123, 'postmandan sipariş verme', NULL, '1564333409', '[{\"id\":\"277101\",\"count\":15,\"price\":123,\"name\":null,\"features\":null}]', '1', '0', '::1'),
(78561, 79027, 'adress', 85, '', NULL, '1563815085', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":\"1\",\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"205023\",\"count\":\"1\",\"price\":4,\"name\":\"Fuse Tea (33 cl.)\"},{\"id\":\"894674\",\"count\":\"1\",\"price\":15,\"name\":\"Çiğ Köfte ( 12 Sıkım )\"}]', '0', '1', '37.154.45.187'),
(78873, 15883, 'adress', 306, '', NULL, '1564003288', '[{\"id\":\"150669\",\"count\":1,\"price\":0,\"name\":\"deneme ürünü 2\"},{\"id\":\"276675\",\"count\":1,\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"781750\",\"count\":1,\"price\":26,\"name\":\"Kuşbaşı Kebap\"},{\"id\":\"942504\",\"count\":6,\"price\":240,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"}]', '1', '0', '::1'),
(80616, 45435, 'adress', 26, 'iü??üiü??üü?ü?iüçiüğüğüüğ.işü.şüğ.şüi.üşğ.ş.', NULL, '1562618562', '[{\"id\":\"781750\",\"count\":1,\"price\":\"26\",\"name\":\"Ku?ba?? Kebap\"}]', '1', '1', '151.135.173.84'),
(84380, 25, 'adress', 27, '', NULL, '1564574672', '[{\"id\":\"530891\",\"count\":1,\"features\":[{\"count\":1,\"items\":[903]}],\"price\":27,\"name\":\"Adana Kebap\"}]', '1', '1', '::1'),
(84391, 15883, 'adress', 120, 'saassa', NULL, '1563144004', '[{\"id\":\"276675\",\"count\":\"3\",\"price\":120,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '1', '31.223.58.246'),
(85049, 15883, 'adress', 40, '', NULL, '1563147348', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"}]', '5', '1', '31.223.58.246'),
(87319, 15883, 'adress', 80, 'ggfgfdfd', NULL, '1563146487', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"}]', '5', '1', '31.223.58.246'),
(87866, 36087, 'adress', 40, 'safasfas', NULL, '1562619227', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '151.135.173.84'),
(88612, 25, 'adress', 312, '', NULL, '1564576786', '[{\"id\":\"530891\",\"count\":6,\"features\":[{\"count\":5,\"items\":[]},{\"count\":1,\"items\":[903]}],\"price\":162,\"name\":\"Adana Kebap\"},{\"id\":\"416376\",\"count\":6,\"features\":[{\"count\":1,\"items\":[]},{\"count\":5,\"items\":[331,367]}],\"price\":150,\"name\":\"Adana Dürüm\"}]', '1', '1', '::1'),
(90307, 45435, 'adress', 624, 'aaaaaaaaaaaaaawefr awe rfwef rwe4 w4e w4e t', NULL, '1564533579', '[{\"id\":\"530891\",\"count\":12,\"features\":[{\"count\":1,\"items\":[]},{\"count\":1,\"items\":[903]},{\"count\":5,\"items\":[]},{\"count\":5,\"items\":[903]}],\"price\":324,\"name\":\"Adana Kebap\"},{\"id\":\"416376\",\"count\":12,\"features\":[{\"count\":1,\"items\":[214,367,331]},{\"count\":1,\"items\":[]},{\"count\":5,\"items\":[]},{\"count\":5,\"items\":[331,367,214]}],\"price\":300,\"name\":\"Adana Dürüm\"}]', '5', '0', '::1'),
(90357, 45435, 'adress_2', 231, '', NULL, '1564532106', '[{\"id\":\"530891\",\"count\":3,\"features\":[{\"count\":1,\"items\":[903]},{\"count\":2,\"items\":[]}],\"price\":81,\"name\":\"Adana Kebap\"},{\"id\":\"416376\",\"count\":6,\"features\":[{\"count\":1,\"items\":[214,331]},{\"count\":5,\"items\":[367,331]}],\"price\":150,\"name\":\"Adana Dürüm\"}]', '5', '1', '::1'),
(91719, 55065, 'adress', 40, NULL, NULL, '1562251441', '[{\"id\":\"276675\",\"count\":1,\"price\":\"40\",\"name\":\"Beyti (1,5 porsiyon)\"}]', '1', '0', '151.135.173.84'),
(93050, 45435, 'adress_2', 12.3, 'Bu kısım telefon onay tarafından eklendi', NULL, '1564328255', '[{\"id\":\"277101\",\"count\":\"1\",\"price\":12.3,\"name\":\"deneme ürünü 5\"}]', '1', '0', '::1'),
(94410, 15883, 'adress', 120, 'sadsadasd', NULL, '1563144959', '[{\"id\":\"942504\",\"count\":\"3\",\"price\":120,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"}]', '5', '1', '31.223.58.246'),
(95671, 35747, 'adress', 3, '', NULL, '1560720164', '[{\"id\":\"523399\",\"count\":1,\"price\":\"3\",\"name\":\"Ayran (30 cl.)\"}]', '1', '0', '::1'),
(96786, 45435, 'adress', 27, '', NULL, '1564529888', '[{\"id\":\"530891\",\"count\":1,\"features\":[{\"count\":1,\"items\":[]}],\"price\":27,\"name\":\"Adana Kebap\"}]', '5', '1', '::1'),
(97758, 15883, 'adress', 106, '', NULL, '1563141257', '[{\"id\":\"276675\",\"count\":\"1\",\"price\":40,\"name\":\"Beyti (1,5 porsiyon)\"},{\"id\":\"942504\",\"count\":\"1\",\"price\":40,\"name\":\"Patlıcan Kebap (1,5 porsiyon)\"},{\"id\":\"982211\",\"count\":\"1\",\"price\":26,\"name\":\"Adana Kebap\"}]', '5', '0', '31.223.58.246'),
(97902, 35747, 'adress', 4, '', NULL, '1560025789', '[{\"id\":\"136207\",\"count\":1,\"price\":\"4\",\"name\":\"Coca-Cola Şekersiz (33 cl.)\"}]', '1', '0', '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `features` int(10) DEFAULT NULL,
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

INSERT INTO `products` (`id`, `price`, `features`, `name`, `date`, `numberOfProduct`, `categoryId`, `unlimited`, `live`, `card_text`, `img`, `other_img`, `stores`, `long_text`) VALUES
(416376, 25, 557, 'Adana Dürüm', '1564348461', 0, 1, '1', 1, 'Mevsim salatası, pişmiş domates ve biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(530891, 27, 159, 'Adana Kebap', '1564348317', 0, 1, '1', 1, 'Soğan salatası, ezme salata, mevsim salatası, pişmiş soğan, pişmiş domates, biber, yeşillik, limon', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', ''),
(702104, 10, 498, 'Künefe', '1564348540', 0, 6, '1', 1, '', '', '{\"1\":\"\",\"2\":\"\",\"3\":\"\"}', 'Adana', '');

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
  `message` text COLLATE utf8_turkish_ci,
  `m_status` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `rez_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `rezervasyon`
--

INSERT INTO `rezervasyon` (`id`, `time`, `name`, `e_mail`, `phone`, `kisi_sayisi`, `message`, `m_status`, `ip`, `rez_date`) VALUES
(16783, '1562104747', '43t4t34', 'demo@hotmail.com', '3465', '3', NULL, '1', '5.177.141.122', '2019-07-06'),
(24531, '1562509231', 'aasfasf', 'demo@hotmail.com', '124', '12', 'qwarwqrqw', '0', '151.135.173.84', '2019-07-05'),
(24943, '1562150492', 'ddrhdrhdrh', 'demo@hotmail.com', '123', '23', NULL, '0', '5.177.141.122', '2019-07-12'),
(33037, '1562509641', 'a', 'a@a.a', '1212312', '1', 'a', '0', '151.135.173.84', '0441-12-01'),
(33395, '1562509284', 'wewetw', 'demo@hotmail.com', '123', '1', 'q', '0', '151.135.173.84', '2019-07-12'),
(33504, '1563137912', 'Enes Budak', 'enes@hotmail.com', '5435292117', '33', 'sadasdasd', '0', '5.46.5.201', '2019-07-17'),
(37731, '1563630925', 'mehmet yusuf has', 'budakyemlihan@gmail.com', '5522284800', '15', 'bahçe kenarında bir yer olsa iyi olurdu', '0', '37.154.75.232', '2019-07-22'),
(37751, '1562083053', 'adfh', 'demo@hotmail.com', '345', '456', NULL, '0', '5.177.141.122', '2019-07-05'),
(42782, '1562151450', 'rewgerhg', 'demo@hotmail.com', '235', '235', NULL, '0', '5.177.141.122', '2019-07-05'),
(53544, '1563144572', 'yaşar budak', 'asdasdad@hotmail.com', '5435295478', '2', 'asdasda', '1', '31.223.58.246', '2019-07-06'),
(60443, '1562102707', 'rtyrty', 'demo@hotmail.com', '5687', '5', NULL, '2', '5.177.141.122', '2019-07-06'),
(61455, '1562100315', 'mehmet tuna', 'demo@hotmail.com', '3465346', '5', NULL, '0', '5.177.141.122', '2019-07-06'),
(65213, '1562509806', 'aewfgwaegf', 'demo@hotmail.com', '1241', '12', 'qwreqwre', '0', '151.135.173.84', '2019-07-06'),
(69266, '1562083004', 'sjht', 'ssr@srtj.sartj', '347', '34', NULL, '0', '5.177.141.122', '2019-07-03'),
(69592, '1563638646', 'ahmet toprak', 'yetki1@hotmail.com', '5522284800', '5', 'hjgjghjghjghjgh hhjghjhgjhg', '0', '78.190.64.36', '2019-07-26'),
(76960, '1562101398', 'wetwet', 'demo@hotmail.com', '3465', '3', NULL, '1', '5.177.141.122', '2019-07-04'),
(83971, '1563224702', 'asdasaf', 'yasarbudak@hotmail.com.tr', '1223342432', '2', 'sdsafa', '1', '31.223.58.246', '2018-07-19'),
(86374, '1562153138', 'werqag', 'demo@hotmail.com', '2345', '21', NULL, '0', '5.177.141.122', '2019-07-13'),
(91452, '1562086192', 'jhbg', 'demo@hotmail.com', '346', '2', NULL, '0', '5.177.141.122', '2019-07-31'),
(93401, '1563629902', 'sadasdassadasasda', 'admin@hotmail.com', '232131', '4', 'wdadsd', '1', '46.154.169.132', '2019-03-21'),
(97515, '1563602699', 'Ghhhhh', 'budakyemlihan@gmail.com', '5522284800', '8', 'Fggg', '1', '78.190.69.191', '2019-07-28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL DEFAULT '1',
  `site_name` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `site_description` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `site_create_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `site_url` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `site_online` tinyint(1) NOT NULL DEFAULT '1',
  `site_lisans` varchar(35) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `site`
--

INSERT INTO `site` (`id`, `site_name`, `site_description`, `site_create_date`, `site_url`, `site_online`, `site_lisans`) VALUES
(1, 'Aysoftdeneme', 'site aciklama ksimi demo 2', '1559808638', 'http://www.aysoftdemo.site', 1, '1');

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
  `adress` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adress_2` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `birthday` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `email_verified`, `first_order`, `registration_date`, `verification_code`, `ip`, `phone`, `adress`, `adress_2`, `birthday`) VALUES
(25, 'new@hotmail.com', '$2y$10$Flp4Q3HLpeVRZSKNLIRtJ.LC0V6wdPoUgHE3wrF1Cqj5inP31dANm', 'mehmet', 'tuna', 1, 1, '1564574416', '', '::1', '234233', 'wqerfwegtwet', NULL, '0');

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
(23523, 'yetki1@hotmail.com', '$2y$10$6P78trneNm4L7v9MdY4cCujxW9851cfWQX9e.TTT1q6bfIhOwYaf6', 'deneme', '2345', '235', '1'),
(235235, 'demo@hotmail.com', '$2y$10$6P78trneNm4L7v9MdY4cCujxW9851cfWQX9e.TTT1q6bfIhOwYaf6', 'mehmet tuna', '325235', '::1', '2');

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
-- Tablo için indeksler `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kurye`
--
ALTER TABLE `kurye`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kurye_takip`
--
ALTER TABLE `kurye_takip`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `order_features`
--
ALTER TABLE `order_features`
  ADD PRIMARY KEY (`order_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `features` (`features`);

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
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `feature`
--
ALTER TABLE `feature`
  ADD CONSTRAINT `options_product` FOREIGN KEY (`id`) REFERENCES `products` (`features`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
