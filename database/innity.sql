-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 03:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innity`
--

-- --------------------------------------------------------

--
-- Create the `innity` database
--
CREATE DATABASE IF NOT EXISTS `innity`;

USE `innity`;

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` varchar(32) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `role`, `status`, `create_at`) VALUES
('6898741dc4c626898741dc4c65689874', 'admin', '$2y$10$RkcoafD3APo5HEBJbcK8oe89AOhwm/xPJ501UTuVjwnZCxpnFL3WK', 30, 10, '2025-08-10 13:57:41'),
('6898872cd27516898872cd2753689887', 'user-0', '$2y$10$a0orexqUVRucpLNj4eQIn.NZAd8vtbAovFW/IbJLRAuDYhblpge3q', 30, 10, '2025-08-10 15:19:34'),
('6898872ce41a46898872ce41a8689887', 'user-1', '$2y$10$k7Cm/qRpkoFlFTuWSi2EyObByn3b7delOvDIxwkO7H7Nc9YVxJAWy', 20, 10, '2025-08-10 15:19:34'),
('6898872d8029a6898872d8029d689887', 'user-10', '$2y$10$UbHPL.26olv.vCQNTIX7V.j2szfvrCGiWYLvOwlqoDq.idUSdx45S', 20, 10, '2025-08-10 15:19:34'),
('6898872d8fe866898872d8fe89689887', 'user-11', '$2y$10$wyO2roaqZz63CbyH32aokOAKIDOikV8c0xS.Sxu3gVjXJPuleEgTi', 20, 10, '2025-08-10 15:19:34'),
('6898872d9fb986898872d9fb9a689887', 'user-12', '$2y$10$QIniuJTxOwdUm5QpqHAHG.BVzmHIPFuPwn16kvFeX8a4vAYjL9h9y', 20, 10, '2025-08-10 15:19:34'),
('6898872db006e6898872db0071689887', 'user-13', '$2y$10$O4/.GqhH7gBQ79KtEllAbu3BbWBXpSb..0mWn8hTSIG/57pai1axW', 10, 10, '2025-08-10 15:19:34'),
('6898872dbffdd6898872dbffdf689887', 'user-14', '$2y$10$QL.ioPuHpEGSnMkIcp9uquTNvx8kjLBT8pwyHFE0K1HUNqzaQRyda', 10, 10, '2025-08-10 15:19:34'),
('6898872dd00646898872dd0068689887', 'user-15', '$2y$10$Etg8pNI7jUwin6osBvh33ek.bdcf7ePm5A.4lUmnVAcsVr2lLgYIq', 10, 10, '2025-08-10 15:19:34'),
('6898872de04e36898872de04e6689887', 'user-16', '$2y$10$9cq55kujOUxtqNixr61k/.NBUhQMWzknWJMdjWkqAgf/QBHFcFX2O', 30, 10, '2025-08-10 15:19:34'),
('6898872df037d6898872df037f689887', 'user-17', '$2y$10$9/MvTjLOSMXJ9gOUbRg1qee2JDITEtV2n5f6Mr3HYWQ19Ez/PGd7C', 10, 10, '2025-08-10 15:19:34'),
('6898872e0c33e6898872e0c341689887', 'user-18', '$2y$10$O2doxjJRFKI4x4C6G9mOcOrCK4wl3zHSz5grVMFGIE3iDO5LTqvRG', 10, 10, '2025-08-10 15:19:34'),
('6898872e1e5fe6898872e1e601689887', 'user-19', '$2y$10$2F9Euh/nnxSG.v/VAj.SkO3Ja9dLMsLOa5fBaV6to4RfRlNLliiiW', 10, 10, '2025-08-10 15:19:34'),
('6898872d006da6898872d006de689887', 'user-2', '$2y$10$QFkW/wO/b2ta6P1Osmyxje5mO.WupH7GMAaQy5NhASd1zwGT55Uaa', 10, 10, '2025-08-10 15:19:34'),
('6898872e2e5d06898872e2e5d3689887', 'user-20', '$2y$10$z1CN2RdvBWHnssmBzoWsTODWpH8sr8L5Yo70kxKVQxnVPar.172e2', 10, 10, '2025-08-10 15:19:34'),
('6898872e3e5446898872e3e546689887', 'user-21', '$2y$10$PQD2nbwYDvYcuQ7coU4/8Okpj6VE0REg7M8V7X68.1d3T7Rh7ZMLy', 10, 10, '2025-08-10 15:19:34'),
('6898872e4e1e36898872e4e1e6689887', 'user-22', '$2y$10$.tJRgsPJNFaotrOiVosuCuDh5qPgKNIm.G0nCr5INpaAJeMdTVM7C', 10, 10, '2025-08-10 15:19:34'),
('6898872e6e5956898872e6e597689887', 'user-24', '$2y$10$.3QbXG6Fml9lFGyITetBlOqVbCA86pGyKS85mJfu3EO5yWZw1uDB6', 10, 10, '2025-08-10 15:19:34'),
('6898872e7e9136898872e7e916689887', 'user-25', '$2y$10$lO3yWLAB1e8RLt4xlKsJmu1Y0s594mBDydrAoMVjbjgkqrq9mcTVG', 10, 10, '2025-08-10 15:19:34'),
('6898872e8ec896898872e8ec8b689887', 'user-26', '$2y$10$hUsl7Q7bbUUOC55i2QuPh.RvsNcjoWgaw4yilYSPhGVDk.wmjoz16', 10, 10, '2025-08-10 15:19:34'),
('6898872e9f0146898872e9f017689887', 'user-27', '$2y$10$tteCSqYrnvB1EAfBttWEsOSIsvuskd.G3ouQeDo000p3YDh9ZVSSm', 10, 10, '2025-08-10 15:19:34'),
('6898872eaf8f96898872eaf8fc689887', 'user-28', '$2y$10$7qOIa6VpjwfQu6KmUQh1/uiI.bNMNdDnA5f3CCp2y9sNh7UB4Z./e', 10, 10, '2025-08-10 15:19:34'),
('6898872ebfae16898872ebfae3689887', 'user-29', '$2y$10$b4UEycCgWjMa5E82Dh3WWOcLi21wTGdksU.HTxbHVWBui9lkjZNnS', 10, 10, '2025-08-10 15:19:34'),
('6898872d108106898872d10813689887', 'user-3', '$2y$10$.TwqPK3UaNYE8N0bia7n6OeCr/orqL2XgUj.mpPIBOPrExLF/GIBG', 10, 10, '2025-08-10 15:19:34'),
('6898872ecfbf46898872ecfbf7689887', 'user-30', '$2y$10$pLY6X3jeCYIv8TCRYv1mhOoKGd4eDHRH0UQ41CMqwPwSuUCkW6nsm', 10, 10, '2025-08-10 15:19:34'),
('6898872edf8b66898872edf8b9689887', 'user-31', '$2y$10$JnBMqAWyH00o55vov.Un3uQyQje4wqdDy3sW6kdnjGQHPvvp6KtiS', 10, 10, '2025-08-10 15:19:34'),
('6898872eef5d66898872eef5d9689887', 'user-32', '$2y$10$L887RJJyo96rheNr0NIkbeOBvCxOBqCUWpvpQqfuojiqVniqxKl4u', 10, 10, '2025-08-10 15:19:34'),
('6898872f0b4bb6898872f0b4be689887', 'user-33', '$2y$10$idEVawwDDlox6yeIDNHXRe1j/4k43GW8XXKqrV78l9nbBJxukayCu', 10, 10, '2025-08-10 15:19:34'),
('6898872f1b5d46898872f1b5d7689887', 'user-34', '$2y$10$Tf8fapGwD5wfo5115omGueufCpAlAtMTKY9TiJsanxA0kLdGIJIxe', 10, 10, '2025-08-10 15:19:34'),
('6898872f2c7716898872f2c774689887', 'user-35', '$2y$10$lgZXtBdmd/yQS57RPWmsq.SM5TPmwgzZCdytO70FHBTDw4j1gx1aK', 10, 10, '2025-08-10 15:19:34'),
('6898872f441726898872f44175689887', 'user-36', '$2y$10$jWkeJd/QTiBZmqg.ualC8.UTE9VRwgizvLkIEC8ygRM83822OxDPa', 10, 10, '2025-08-10 15:19:34'),
('6898872f54c146898872f54c17689887', 'user-37', '$2y$10$ivZxt.wm24ONn/2PB.KYeu3targvzRYP7DjaVsGizXREaEIROV1l.', 10, 10, '2025-08-10 15:19:34'),
('6898872f655d76898872f655da689887', 'user-38', '$2y$10$xrQaY5Ir8fpWL7qxSorz/.tnLu2x8pjkqDZTCwWM1d2EW7Iz6e78q', 10, 10, '2025-08-10 15:19:34'),
('6898872f758c66898872f758c9689887', 'user-39', '$2y$10$M4AGTwzUvk8zalk7turm7O.Rs0wdZwU6kY5fzkmzJctZnTf5IDajO', 10, 10, '2025-08-10 15:19:34'),
('6898872d205e96898872d205ec689887', 'user-4', '$2y$10$HOKXLiN7zRKxyRQD5KQd1.Q3CQHLgd6q5zAckUMAxbzWjAGru1vei', 10, 10, '2025-08-10 15:19:34'),
('6898872f859536898872f85956689887', 'user-40', '$2y$10$Aopi5l6/IWPutHolTw5WveZpnlWoXQEEvDWoInR2Xl9VeneE4eiNy', 10, 10, '2025-08-10 15:19:34'),
('6898872f957cd6898872f957cf689887', 'user-41', '$2y$10$FfsLNZaR.f0afCh0gqBGTe6dNmUvpZVRVirzI55EEckW4Ngfg7Ux2', 10, 10, '2025-08-10 15:19:34'),
('6898872fa596d6898872fa5970689887', 'user-42', '$2y$10$EJq1qLYujWZC/tMfKCBVHO7TDvClpPsP5TovSIh.R/ZmIa0TmTLWW', 10, 10, '2025-08-10 15:19:34'),
('6898872fb5d706898872fb5d73689887', 'user-43', '$2y$10$u13tegCFsRvWYiGtfgx2O.GfxRuvNyEqEOgawg.y.6S6TS/CI.d4S', 10, 10, '2025-08-10 15:19:34'),
('6898872fc63946898872fc6396689887', 'user-44', '$2y$10$FMaqSsmyg1IrUyvQKRP42uwQfR7BZ1CiJ.BfSRmNS.0r598tCIqO2', 10, 10, '2025-08-10 15:19:34'),
('6898872fd64366898872fd6439689887', 'user-45', '$2y$10$i/cllVxkWGbs2ehPYjLfmeNrGUxdoDi6rZwwU6fAcpB4AGfxW6Rje', 10, 10, '2025-08-10 15:19:34'),
('6898872fe65526898872fe6554689887', 'user-46', '$2y$10$FT7iWBmT.JeWHwclk4in/e5WUbd5T5er4SPFAvOOu2ON8kAwVUp5q', 10, 10, '2025-08-10 15:19:34'),
('68988730023db68988730023de689887', 'user-47', '$2y$10$Whzc7ofPMwlsm9Kh7grPlOQFIB7HOZAun0YRV2PoFo.EGBvyogDuK', 10, 10, '2025-08-10 15:19:34'),
('68988730125536898873012556689887', 'user-48', '$2y$10$KSkJ7uHBCTaOX1k7sPEHuOOKIdxIQLI/AL0e7hk6pNCp3AR6iyppO', 10, 10, '2025-08-10 15:19:34'),
('68988730224816898873022484689887', 'user-49', '$2y$10$FBLHg0WxEa2sl55YvKGCZuYNewrg6.9uDM9580WFn4qqRu2dI7Yrm', 10, 10, '2025-08-10 15:19:34'),
('6898872d308436898872d30846689887', 'user-5', '$2y$10$TzEkxxb/g2G1Q3xauURCdubtpji3c9LNXkOG46iKrShVbmz.0wK/C', 10, 10, '2025-08-10 15:19:34'),
('689887303b8fe689887303b901689887', 'user-50', '$2y$10$BmyNSG8JV/sfsyaRYYN8geUoX.Dszf7fK8eHGPsaQi8cKeu2fuzIO', 10, 10, '2025-08-10 15:19:34'),
('689887304c1f2689887304c1f5689887', 'user-51', '$2y$10$p0CRcdCQj84pVd/l9H264uDxxeub57AY9ZhAbxLA/uzDSRNOgamKa', 10, 10, '2025-08-10 15:19:34'),
('689887305d048689887305d04b689887', 'user-52', '$2y$10$vvGMmXRnGeWjbJLqIGs7mOOTJfoEo84s8.O9In9HnfZdq1nxKxYei', 10, 10, '2025-08-10 15:19:34'),
('689887306d80d689887306d810689887', 'user-53', '$2y$10$/t7daagYPS3se2yTSTPDMu0PCVe24vFFf5iV9aiEqV4z0MPdUwjce', 10, 10, '2025-08-10 15:19:34'),
('689887307de85689887307de88689887', 'user-54', '$2y$10$72l6cySAVp7bE3YumoteHeJFqeWvKeMInxuui.dF5YV5sRiMkIhOu', 10, 10, '2025-08-10 15:19:34'),
('689887308ea83689887308ea86689887', 'user-55', '$2y$10$qOM7Ke3157C4I.Sf/FINGe0SMBdenAxG5sVd4j5cZjJol9K2Uf3OS', 10, 10, '2025-08-10 15:19:34'),
('689887309f437689887309f43a689887', 'user-56', '$2y$10$GGy1sVuZNdEvwd4JnE2mg.sZV8vYsTVv3Pb28iv3MfMzUxSnawjIC', 10, 10, '2025-08-10 15:19:34'),
('68988730b024668988730b0249689887', 'user-57', '$2y$10$KKT/m6L3DePOua.PVTRpruLOZAJkQkZQjeJQcFNOAS9qhZiwhFMPS', 10, 10, '2025-08-10 15:19:34'),
('68988730c09d568988730c09d8689887', 'user-58', '$2y$10$c8Peo.lBdNY11I.WsWuaMuxl.sfuhxwjfZRQm1f59Rk4O2gMSH3xa', 10, 10, '2025-08-10 15:19:34'),
('68988730d13d768988730d13da689887', 'user-59', '$2y$10$5TFAR/1L.BaPZGoEgV8.JuGnjo6ZuwxJhwdUSSH8yYTYuEnAupEzK', 10, 10, '2025-08-10 15:19:34'),
('6898872d408206898872d40822689887', 'user-6', '$2y$10$tMfCx01na5.Uk2cEClq3NuQqnu6RsK7FxbuA4seCjPyJu7J3vE.me', 10, 10, '2025-08-10 15:19:34'),
('6898872d507fc6898872d507fe689887', 'user-7', '$2y$10$T0nOyUoJkWER55KINdpKFOX/0Ng5J79ldbeJ9OpY28eSZF3oWi2Nu', 10, 10, '2025-08-10 15:19:34'),
('6898872d608916898872d60894689887', 'user-8', '$2y$10$lXEojGTthGDA4IPeGbVED.1lV0.ScA0y9pMcOOW7RkNYAtxWjs9KG', 10, 10, '2025-08-10 15:19:34'),
('6898872d706036898872d70606689887', 'user-9', '$2y$10$zH9y4KcJxslOJxboyBF1ZeshIOJZl3tRPWY7IpM0wqx5QFFpmXehe', 10, 10, '2025-08-10 15:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` varchar(32) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `image` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `country` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `stars` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `owner`, `image`, `name`, `description`, `country`, `city`, `stars`, `status`, `created_at`) VALUES
('6899edbdd93db6899edbdd93dc6899ed', '6898741dc4c626898741dc4c65689874', 'hotel-1.jpg', 'Grand Palace Hotel', 'A luxurious 5-star hotel offering panoramic city views and world-class amenities.', 'United Kingdom', 'London', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd93e26899edbdd93e36899ed', '6898741dc4c626898741dc4c65689874', 'hotel-2.jpg', 'Ocean Breeze Resort', 'A beachfront paradise with crystal-clear waters and relaxing spa treatments.', 'Japan', 'Tokyo', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd93e76899edbdd93e86899ed', '6898872d8029a6898872d8029d689887', 'hotel-3.jpg', 'Mountain View Inn', 'Cozy accommodation surrounded by stunning mountain landscapes.', 'United States', 'New York', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd93ec6899edbdd93ed6899ed', '6898872d8fe866898872d8fe89689887', 'hotel-4.jpg', 'Sunset Boulevard Hotel', 'Charming rooms with balconies overlooking breathtaking sunsets.', 'Japan', 'Tokyo', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd93f16899edbdd93f26899ed', '6898872cd27516898872cd2753689887', 'hotel-5.jpg', 'Royal Garden Suites', 'Elegant suites with lush gardens and a private swimming pool.', 'Germany', 'Berlin', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd93f56899edbdd93f66899ed', '6898872d8fe866898872d8fe89689887', 'hotel-6.jpg', 'Skyline Tower Hotel', 'Modern high-rise hotel offering stunning skyline views.', 'Turkey', 'Istanbul', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd93fa6899edbdd93fb6899ed', '6898872d8fe866898872d8fe89689887', 'hotel-7.jpg', 'The Heritage Lodge', 'Historic building restored with modern comfort in the heart of the city.', 'Brazil', 'Rio de Janeiro', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd93ff6899edbdd94006899ed', '6898872cd27516898872cd2753689887', 'hotel-8.jpg', 'Golden Sands Resort', 'Perfect for beach lovers with direct access to golden sandy beaches.', 'Japan', 'Tokyo', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94036899edbdd94046899ed', '6898872cd27516898872cd2753689887', 'hotel-9.jpg', 'Riverfront Plaza Hotel', 'Riverside location with luxurious rooms and fine dining.', 'Australia', 'Sydney', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd94086899edbdd94096899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-10.jpg', 'Lakeside Retreat', 'Peaceful getaway by the lake with outdoor activities and cozy rooms.', 'Turkey', 'Istanbul', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd940d6899edbdd940e6899ed', '6898872cd27516898872cd2753689887', 'hotel-11.jpg', 'Emerald Bay Hotel', 'Beautiful seaside escape with turquoise waters and lush greenery.', 'Italy', 'Rome', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd94126899edbdd94136899ed', '6898872cd27516898872cd2753689887', 'hotel-12.jpg', 'City Lights Hotel', 'Trendy downtown stay with easy access to nightlife and shopping.', 'United States', 'New York', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd94176899edbdd94186899ed', '6898872d8029a6898872d8029d689887', 'hotel-13.jpg', 'Blue Horizon Resort', 'Luxury resort with infinity pool overlooking the ocean horizon.', 'Japan', 'Tokyo', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd941b6899edbdd941c6899ed', '6898872cd27516898872cd2753689887', 'hotel-14.jpg', 'Maple Leaf Inn', 'Warm and welcoming inn in a quiet neighborhood.', 'Italy', 'Rome', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94206899edbdd94216899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-15.jpg', 'Crown Royale Hotel', 'Regal experience with grand architecture and top-notch service.', 'United States', 'New York', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd94256899edbdd94266899ed', '6898872ce41a46898872ce41a8689887', 'hotel-16.jpg', 'Palm Grove Resort', 'Tropical resort surrounded by palm trees and exotic flowers.', 'Canada', 'Toronto', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94386899edbdd94396899ed', '6898872cd27516898872cd2753689887', 'hotel-17.jpg', 'The Vintage Manor', 'Elegant manor offering timeless charm and modern amenities.', 'Japan', 'Tokyo', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd943d6899edbdd943e6899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-18.jpg', 'Harbor View Hotel', 'Spectacular harbor views with fresh seafood dining.', 'Italy', 'Rome', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd94416899edbdd94426899ed', '6898872d8029a6898872d8029d689887', 'hotel-19.jpg', 'Alpine Heights Lodge', 'Mountain lodge perfect for skiing and winter adventures.', 'Italy', 'Rome', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd94466899edbdd94476899ed', '6898872cd27516898872cd2753689887', 'hotel-20.jpg', 'Pearl Coast Resort', 'Luxury resort along the coast with premium spa treatments.', 'Australia', 'Sydney', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd944b6899edbdd944c6899ed', '6898872d8029a6898872d8029d689887', 'hotel-21.jpg', 'Sunrise Vista Hotel', 'Wake up to magnificent sunrise views from your private balcony.', 'Italy', 'Rome', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd944f6899edbdd94506899ed', '6898872ce41a46898872ce41a8689887', 'hotel-22.jpg', 'The Majestic Plaza', 'Stylish hotel with a blend of modern design and classic elegance.', 'United States', 'New York', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94546899edbdd94556899ed', '6898872ce41a46898872ce41a8689887', 'hotel-23.jpg', 'Forest Edge Retreat', 'Eco-friendly resort tucked away in a lush forest.', 'Brazil', 'Rio de Janeiro', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd94586899edbdd94596899ed', '6898872d8fe866898872d8fe89689887', 'hotel-24.jpg', 'Coral Reef Resort', 'Snorkeling paradise with vibrant marine life and coral reefs.', 'Japan', 'Tokyo', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd945d6899edbdd945e6899ed', '6898872cd27516898872cd2753689887', 'hotel-25.jpg', 'Silver Star Hotel', 'Affordable luxury with excellent service and comfortable rooms.', 'Brazil', 'Rio de Janeiro', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94616899edbdd94626899ed', '6898872d8029a6898872d8029d689887', 'hotel-26.jpg', 'The Grand Imperial', 'Luxury palace-style hotel with lavish interiors.', 'France', 'Paris', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd94666899edbdd94676899ed', '6898872ce41a46898872ce41a8689887', 'hotel-27.jpg', 'The Seaside Villa', 'Private seaside villas with personal butler service.', 'Brazil', 'Rio de Janeiro', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd946a6899edbdd946b6899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-28.jpg', 'Desert Mirage Inn', 'Unique desert escape with starry night views.', 'Italy', 'Rome', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd946f6899edbdd94706899ed', '6898872ce41a46898872ce41a8689887', 'hotel-29.jpg', 'Aurora Lights Hotel', 'Best spot for witnessing the magical Northern Lights.', 'Brazil', 'Rio de Janeiro', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94736899edbdd94746899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-30.jpg', 'The Royal Palm', 'Elegant beachfront hotel with fine dining and spa services.', 'Brazil', 'Rio de Janeiro\n', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd94786899edbdd94796899ed', '6898872cd27516898872cd2753689887', 'hotel-31.jpg', 'Crystal Waters Resort', 'Resort with overwater bungalows and clear blue lagoons.', 'Brazil', 'Rio de Janeiro\n', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd947c6899edbdd947d6899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-32.jpg', 'Sunflower Inn', 'Charming countryside inn with flower-filled gardens.', 'Australia', 'Sydney', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd94816899edbdd94826899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-33.jpg', 'The Golden Crown', 'Premium 5-star hotel with luxurious amenities.', 'Italy', 'Rome', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd949f6899edbdd94a16899ed', '6898872d8029a6898872d8029d689887', 'hotel-34.jpg', 'Harbor Breeze Inn', 'Relaxing inn with fresh sea breeze and coastal charm.', 'Turkey', 'Istanbul', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd94a56899edbdd94a66899ed', '6898872cd27516898872cd2753689887', 'hotel-35.jpg', 'The White Orchid', 'Romantic boutique hotel surrounded by orchids.', 'Japan', 'Tokyo', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd95a56899edbdd95a96899ed', '6898872d8fe866898872d8fe89689887', 'hotel-36.jpg', 'Highland Escape', 'Quiet mountain escape with hiking trails and nature walks.', 'Italy', 'Rome', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd95b46899edbdd95b56899ed', '6898872d8029a6898872d8029d689887', 'hotel-37.jpg', 'Sapphire Bay Hotel', 'Coastal gem with panoramic ocean views.', 'Turkey', 'Istanbul', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95ba6899edbdd95bb6899ed', '6898872d8029a6898872d8029d689887', 'hotel-38.jpg', 'Rosewood Suites', 'Upscale suites with a warm and elegant touch.', 'Italy', 'Rome', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd95bf6899edbdd95c06899ed', '6898872ce41a46898872ce41a8689887', 'hotel-39.jpg', 'The City Crown', 'Urban luxury hotel in the heart of the financial district.', 'France', 'Paris', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95c46899edbdd95c56899ed', '6898872ce41a46898872ce41a8689887', 'hotel-40.jpg', 'The Blue Lagoon', 'Tropical escape with lagoon-style pools.', 'Canada', 'Toronto', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95c96899edbdd95ca6899ed', '6898872d8029a6898872d8029d689887', 'hotel-41.jpg', 'Silver Shores Resort', 'Luxury resort with pristine white beaches.', 'United Kingdom', 'London', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd95ce6899edbdd95cf6899ed', '6898872d8fe866898872d8fe89689887', 'hotel-42.jpg', 'The Serenity Lodge', 'Peaceful retreat ideal for meditation and yoga.', 'France', 'Paris', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd95d36899edbdd95d46899ed', '6898872d8fe866898872d8fe89689887', 'hotel-43.jpg', 'Amber Waves Hotel', 'Countryside hotel surrounded by golden fields.', 'Brazil', 'Rio de Janeiro', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95d76899edbdd95d86899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-44.jpg', 'The Grand Horizon', 'Elegant hotel with breathtaking rooftop views.', 'Brazil', 'Rio de Janeiro', 1, 10, '2025-08-11 16:49:26'),
('6899edbdd95dc6899edbdd95dd6899ed', '6898872d8029a6898872d8029d689887', 'hotel-45.jpg', 'Emerald Forest Lodge', 'Rustic lodge surrounded by lush green forests.', 'United States', 'New York', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95e06899edbdd95e16899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-46.jpg', 'Seabreeze Villas', 'Beachfront villas with private pools and sun decks.', 'Australia', 'Sydney', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd95e56899edbdd95e66899ed', '6898872d8fe866898872d8fe89689887', 'hotel-47.jpg', 'The Royal Orchid', 'Elegant resort with exotic gardens and spa.', 'France', 'Paris', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd95ea6899edbdd95eb6899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-48.jpg', 'Golden Horizon Hotel', 'Luxury seaside hotel with sunrise and sunset views.', 'Brazil', 'Rio de Janeiro', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd95ee6899edbdd95ef6899ed', '6898872ce41a46898872ce41a8689887', 'hotel-49.jpg', 'The Sunset Cliff', 'Romantic hotel perched on dramatic seaside cliffs.', 'Australia', 'Sydney', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95f36899edbdd95f46899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-50.jpg', 'Diamond Bay Resort', 'Exclusive luxury resort with crystal-clear waters.', 'United Kingdom', 'London', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95f76899edbdd95f86899ed', '6898872cd27516898872cd2753689887', 'hotel-51.jpg', 'The Majestic Bay', 'Elegant bayfront hotel with top-tier amenities.', 'France', 'Paris', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd95fc6899edbdd95fd6899ed', '6898872d8029a6898872d8029d689887', 'hotel-52.jpg', 'Ocean Pearl Hotel', 'Seaside luxury with fresh seafood cuisine.', 'United States', 'New York', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd96006899edbdd96016899ed', '6898872ce41a46898872ce41a8689887', 'hotel-53.jpg', 'The Grand Magnolia', 'Classic hotel surrounded by magnolia trees.', 'Brazil', 'Rio de Janeiro', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd96056899edbdd96066899ed', '6898872d8029a6898872d8029d689887', 'hotel-54.jpg', 'The Velvet Crown', 'Boutique luxury hotel with velvet interiors.', 'United States', 'New York', 2, 10, '2025-08-11 16:49:26'),
('6899edbdd96096899edbdd960a6899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-55.jpg', 'Sunrise Hill Lodge', 'Scenic hilltop lodge with panoramic views.', 'Turkey', 'Istanbul', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd96106899edbdd96116899ed', '6898872d8fe866898872d8fe89689887', 'hotel-56.jpg', 'The Coral Cove', 'Charming coastal retreat with coral reefs nearby.', 'Canada', 'Toronto', 5, 10, '2025-08-11 16:49:26'),
('6899edbdd96146899edbdd96156899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-57.jpg', 'Blue Reef Hotel', 'Stylish beach hotel with diving and water sports.', 'Italy', 'Rome', 4, 10, '2025-08-11 16:49:26'),
('6899edbdd96196899edbdd961a6899ed', '6898872ce41a46898872ce41a8689887', 'hotel-58.jpg', 'The Moonlight Bay', 'Romantic seaside escape under the moonlight.', 'United States', 'New York', 3, 10, '2025-08-11 16:49:26'),
('6899edbdd961e6899edbdd961f6899ed', '6898872d9fb986898872d9fb9a689887', 'hotel-59.jpg', 'The Royal Horizon', 'Opulent hotel with royal-style suites and service.', 'Japan', 'Tokyo', 4, 10, '2025-08-11 16:49:26'),
('689c8fe9a0176689c8fe9a0179689c8f', '6898741dc4c626898741dc4c65689874', 'hotel-60.jpg', 'Serene Stay', 'Some examples of hotel names include: Luxury Lodge Retreats, Serene Stay Accommodations, Dreamy Destiny Suites, and Whimsical Wellness Inns, according to Wix.com.', 'Canada', 'Toronto', 3, 10, '2025-08-13 16:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` varchar(32) NOT NULL,
  `hotel` varchar(32) NOT NULL,
  `reserved_by` varchar(32) DEFAULT NULL,
  `reserved_time` datetime DEFAULT NULL,
  `reserved_for` int(11) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 1,
  `number` int(11) NOT NULL,
  `bed` int(11) NOT NULL DEFAULT 1,
  `capacity` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel`, `reserved_by`, `reserved_time`, `reserved_for`, `image`, `description`, `price`, `number`, `bed`, `capacity`, `status`, `created_at`) VALUES
('689da5dde79cf689da5dde79d1689da5', '6899edbdd93db6899edbdd93dc6899ed', NULL, NULL, NULL, 'room-0.jpg', 'A cozy single room with modern furnishings and warm lighting.', 281, 20, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde79e1689da5dde79e2689da5', '6899edbdd93e26899edbdd93e36899ed', NULL, NULL, NULL, 'room-1.jpg', 'Spacious double room featuring a king-sized bed and city views.', 451, 2, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde79e6689da5dde79e7689da5', '6899edbdd93e76899edbdd93e86899ed', NULL, NULL, NULL, 'room-2.jpg', 'Elegant suite with private balcony overlooking the ocean.', 261, 33, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde79ea689da5dde79eb689da5', '6899edbdd93ec6899edbdd93ed6899ed', NULL, NULL, NULL, 'room-3.jpg', 'Compact yet comfortable single room perfect for solo travelers.', 349, 74, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde79ee689da5dde79ef689da5', '6899edbdd93f16899edbdd93f26899ed', NULL, NULL, NULL, 'room-4.jpg', 'Family room with two queen beds and a small seating area.', 270, 60, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde79f2689da5dde79f3689da5', '6899edbdd93f56899edbdd93f66899ed', NULL, NULL, NULL, 'room-5.jpg', 'Luxury room with marble bathroom and premium toiletries.', 63, 56, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde79f6689da5dde79f7689da5', '6899edbdd93fa6899edbdd93fb6899ed', NULL, NULL, NULL, 'room-6.jpg', 'Standard double room with free Wi-Fi and flat-screen TV.', 168, 95, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde79fa689da5dde79fb689da5', '6899edbdd93ff6899edbdd94006899ed', NULL, NULL, NULL, 'room-7.jpg', 'Deluxe suite with a private hot tub and panoramic skyline view.', 284, 7, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde79fe689da5dde79ff689da5', '6899edbdd94036899edbdd94046899ed', NULL, NULL, NULL, 'room-8.jpg', 'Economy single room ideal for budget-conscious guests.', 314, 49, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7a02689da5dde7a03689da5', '6899edbdd94086899edbdd94096899ed', NULL, NULL, NULL, 'room-9.jpg', 'Romantic room for couples with mood lighting and champagne service.', 181, 66, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7a06689da5dde7a07689da5', '6899edbdd940d6899edbdd940e6899ed', NULL, NULL, NULL, 'room-10.jpg', 'Executive suite with work desk and complimentary breakfast.', 445, 27, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7a0a689da5dde7a0b689da5', '6899edbdd94126899edbdd94136899ed', NULL, NULL, NULL, 'room-11.jpg', 'Charming room with rustic decor and garden access.', 265, 54, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7a0d689da5dde7a0e689da5', '6899edbdd94176899edbdd94186899ed', NULL, NULL, NULL, 'room-12.jpg', 'Minimalist double room with sleek modern design.', 455, 69, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7a11689da5dde7a12689da5', '6899edbdd941b6899edbdd941c6899ed', NULL, NULL, NULL, 'room-13.jpg', 'Spacious triple room perfect for groups or families.', 205, 55, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7a15689da5dde7a16689da5', '6899edbdd94206899edbdd94216899ed', NULL, NULL, NULL, 'room-14.jpg', 'Luxury penthouse suite with floor-to-ceiling windows.', 117, 96, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7a19689da5dde7a1a689da5', '6899edbdd94256899edbdd94266899ed', NULL, NULL, NULL, 'room-15.jpg', 'Standard twin room with comfortable beds and city view.', 490, 33, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7a1c689da5dde7a1d689da5', '6899edbdd94386899edbdd94396899ed', NULL, NULL, NULL, 'room-16.jpg', 'Oceanfront room with private terrace and sun loungers.', 399, 4, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7a2b689da5dde7a2c689da5', '6899edbdd943d6899edbdd943e6899ed', NULL, NULL, NULL, 'room-17.jpg', 'Cozy loft-style room with exposed brick walls.', 88, 3, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7a2f689da5dde7a30689da5', '6899edbdd94416899edbdd94426899ed', NULL, NULL, NULL, 'room-18.jpg', 'Business-friendly room with ergonomic workspace.', 387, 88, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7a33689da5dde7a34689da5', '6899edbdd94466899edbdd94476899ed', NULL, NULL, NULL, 'room-19.jpg', 'Rustic cabin-style room with wooden furniture and fireplace.', 254, 81, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7a36689da5dde7a37689da5', '6899edbdd944b6899edbdd944c6899ed', NULL, NULL, NULL, 'room-20.jpg', 'Pet-friendly room with easy outdoor access.', 302, 43, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7a3a689da5dde7a3b689da5', '6899edbdd944f6899edbdd94506899ed', NULL, NULL, NULL, 'room-21.jpg', 'Suite with a living area, kitchen, and two bedrooms.', 265, 67, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7a3d689da5dde7a3e689da5', '6899edbdd94546899edbdd94556899ed', NULL, NULL, NULL, 'room-22.jpg', 'Simple single room with all basic amenities.', 447, 90, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7a41689da5dde7a42689da5', '6899edbdd94586899edbdd94596899ed', NULL, NULL, NULL, 'room-23.jpg', 'Modern double room with rainfall shower.', 96, 41, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7a45689da5dde7a46689da5', '6899edbdd945d6899edbdd945e6899ed', NULL, NULL, NULL, 'room-24.jpg', 'Charming attic room with skylight windows.', 165, 30, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7a49689da5dde7a4a689da5', '6899edbdd94616899edbdd94626899ed', NULL, NULL, NULL, 'room-25.jpg', 'Room with spa access and complimentary treatments.', 227, 63, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7a4c689da5dde7a4d689da5', '6899edbdd94666899edbdd94676899ed', NULL, NULL, NULL, 'room-26.jpg', 'Family suite with bunk beds for children.', 257, 29, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7a50689da5dde7a51689da5', '6899edbdd946a6899edbdd946b6899ed', NULL, NULL, NULL, 'room-27.jpg', 'Elegant double room with antique furniture.', 413, 86, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7a53689da5dde7a54689da5', '6899edbdd946f6899edbdd94706899ed', NULL, NULL, NULL, 'room-28.jpg', 'Studio-style room with kitchenette and dining area.', 441, 45, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7a57689da5dde7a58689da5', '6899edbdd94736899edbdd94746899ed', NULL, NULL, NULL, 'room-29.jpg', 'Bright room with large windows and park view.', 394, 27, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7a5b689da5dde7a5c689da5', '6899edbdd94786899edbdd94796899ed', NULL, NULL, NULL, 'room-30.jpg', 'Classic double room with comfortable sofa corner.', 427, 54, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7a5e689da5dde7a5f689da5', '6899edbdd947c6899edbdd947d6899ed', NULL, NULL, NULL, 'room-31.jpg', 'Top-floor room with private rooftop access.', 467, 100, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7a62689da5dde7a63689da5', '6899edbdd94816899edbdd94826899ed', NULL, NULL, NULL, 'room-32.jpg', 'Luxury suite with personalized butler service.', 456, 6, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7a66689da5dde7a67689da5', '6899edbdd949f6899edbdd94a16899ed', NULL, NULL, NULL, 'room-33.jpg', 'Room with jacuzzi and romantic candle setup.', 325, 52, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7a69689da5dde7a6a689da5', '6899edbdd94a56899edbdd94a66899ed', NULL, NULL, NULL, 'room-34.jpg', 'Small yet functional room for short stays.', 424, 5, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7a6d689da5dde7a6e689da5', '6899edbdd95a56899edbdd95a96899ed', NULL, NULL, NULL, 'room-35.jpg', 'Eco-friendly room with sustainable materials.', 290, 57, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7b07689da5dde7b09689da5', '6899edbdd95b46899edbdd95b56899ed', NULL, NULL, NULL, 'room-36.jpg', 'Spacious room with art-decorated walls.', 429, 71, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7b0e689da5dde7b0f689da5', '6899edbdd95ba6899edbdd95bb6899ed', NULL, NULL, NULL, 'room-37.jpg', 'Quiet room facing the inner courtyard.', 206, 34, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7b12689da5dde7b13689da5', '6899edbdd95bf6899edbdd95c06899ed', NULL, NULL, NULL, 'room-38.jpg', 'Room with home-theater setup and premium sound system.', 305, 78, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7b16689da5dde7b17689da5', '6899edbdd95c46899edbdd95c56899ed', NULL, NULL, NULL, 'room-39.jpg', 'Vintage-style room with retro decorations.', 189, 73, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7b19689da5dde7b1a689da5', '6899edbdd95c96899edbdd95ca6899ed', NULL, NULL, NULL, 'room-40.jpg', 'Accessible room designed for wheelchair users.', 219, 68, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7b1d689da5dde7b1e689da5', '6899edbdd95ce6899edbdd95cf6899ed', NULL, NULL, NULL, 'room-41.jpg', 'Minimalist room with white tones and clean lines.', 342, 41, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7b21689da5dde7b22689da5', '6899edbdd95d36899edbdd95d46899ed', NULL, NULL, NULL, 'room-42.jpg', 'Garden-view room with outdoor seating.', 81, 75, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7b25689da5dde7b26689da5', '6899edbdd95d76899edbdd95d86899ed', NULL, NULL, NULL, 'room-43.jpg', 'City-center room close to major attractions.', 261, 3, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7b28689da5dde7b29689da5', '6899edbdd95dc6899edbdd95dd6899ed', NULL, NULL, NULL, 'room-44.jpg', 'Loft room with modern industrial design.', 471, 42, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7b2c689da5dde7b2d689da5', '6899edbdd95e06899edbdd95e16899ed', NULL, NULL, NULL, 'room-45.jpg', 'Comfortable double room with balcony access.', 500, 2, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7b2f689da5dde7b30689da5', '6899edbdd95e56899edbdd95e66899ed', NULL, NULL, NULL, 'room-46.jpg', 'Ocean-view suite with hammock and lounge area.', 163, 86, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7b33689da5dde7b34689da5', '6899edbdd95ea6899edbdd95eb6899ed', NULL, NULL, NULL, 'room-47.jpg', 'Room with free minibar and welcome gift.', 452, 79, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7b36689da5dde7b37689da5', '6899edbdd95ee6899edbdd95ef6899ed', NULL, NULL, NULL, 'room-48.jpg', 'Budget-friendly room with compact design.', 355, 95, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7b3a689da5dde7b3b689da5', '6899edbdd95f36899edbdd95f46899ed', NULL, NULL, NULL, 'room-49.jpg', 'Mountain-view room with panoramic windows.', 298, 11, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7b3d689da5dde7b3e689da5', '6899edbdd95f76899edbdd95f86899ed', NULL, NULL, NULL, 'room-50.jpg', 'Suite with fireplace and cozy armchairs.', 408, 23, 3, 3, 10, '2025-08-14 12:31:31'),
('689da5dde7b41689da5dde7b42689da5', '6899edbdd95fc6899edbdd95fd6899ed', NULL, NULL, NULL, 'room-51.jpg', 'Soundproof room perfect for light sleepers.', 473, 64, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7b45689da5dde7b46689da5', '6899edbdd96006899edbdd96016899ed', NULL, NULL, NULL, 'room-52.jpg', 'Room with walk-in closet and vanity area.', 447, 50, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7b48689da5dde7b49689da5', '6899edbdd96056899edbdd96066899ed', NULL, NULL, NULL, 'room-53.jpg', 'Elegant room with chandelier and plush bedding.', 336, 17, 4, 4, 10, '2025-08-14 12:31:31'),
('689da5dde7b4c689da5dde7b4d689da5', '6899edbdd96096899edbdd960a6899ed', NULL, NULL, NULL, 'room-54.jpg', 'Seaside room with easy beach access.', 309, 36, 6, 6, 10, '2025-08-14 12:31:31'),
('689da5dde7b51689da5dde7b52689da5', '6899edbdd96106899edbdd96116899ed', NULL, NULL, NULL, 'room-55.jpg', 'Room with writing desk and reading nook.', 89, 61, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7b54689da5dde7b55689da5', '6899edbdd96146899edbdd96156899ed', NULL, NULL, NULL, 'room-56.jpg', 'Large room with open-plan layout.', 314, 67, 2, 2, 10, '2025-08-14 12:31:31'),
('689da5dde7b58689da5dde7b59689da5', '6899edbdd96196899edbdd961a6899ed', NULL, NULL, NULL, 'room-57.jpg', 'Romantic suite with canopy bed and rose petals.', 350, 23, 5, 5, 10, '2025-08-14 12:31:31'),
('689da5dde7b5b689da5dde7b5c689da5', '6899edbdd961e6899edbdd961f6899ed', NULL, NULL, NULL, 'room-58.jpg', 'Room with private sauna and relaxation area.', 209, 66, 1, 1, 10, '2025-08-14 12:31:31'),
('689da5dde7b5f689da5dde7b60689da5', '689c8fe9a0176689c8fe9a0179689c8f', NULL, NULL, NULL, 'room-59.jpg', 'Deluxe room with high-end finishes and large bathtub.', 427, 68, 5, 5, 10, '2025-08-14 12:31:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel` (`hotel`),
  ADD KEY `reserved_by` (`reserved_by`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
