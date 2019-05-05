-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 May 2019, 14:15:37
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
  `password` int(50) NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email_register`
--

CREATE TABLE `email_register` (
  `id` int(11) NOT NULL,
  `email` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `m_date` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `m_date` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `orders` text COLLATE utf8_turkish_ci NOT NULL,
  `m_status` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `order_status` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`order_id`, `user_id`, `m_date`, `orders`, `m_status`, `order_status`, `ip`) VALUES
(27009, 35747, '1557058289', 'asdasdasd', '0', '0', '::1');

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
(35747, 'mehmet_tuna_anadolu@hotmail.com', '$2y$10$PB8USNS58UOnesfhlHmuJu7FbOsCT2VC1SPy7V4GDoTTV1tFf9jTa', 'mehmet', 'tuna', 1, 1, '1557057734', '', '::1', '5307280376', 'ellek kasabası', '');

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
-- Tablo için indeksler `email_register`
--
ALTER TABLE `email_register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);

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
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
