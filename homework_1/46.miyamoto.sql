-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2021 at 01:50 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `move_db`
--

CREATE TABLE `move_db` (
  `id` int(12) NOT NULL,
  `model_num` varchar(12) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `move_amount` int(12) NOT NULL,
  `place_from` varchar(64) NOT NULL,
  `place_to` varchar(64) NOT NULL,
  `person_in_charge` varchar(64) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `move_db`
--

INSERT INTO `move_db` (`id`, `model_num`, `product_name`, `move_amount`, `place_from`, `place_to`, `person_in_charge`, `indate`) VALUES
(1, '004-000001', '大胸筋マスター', 20, '倉庫', '倉庫', 'ジョンソン', '2021-03-31 16:01:29'),
(2, '002-544487', 'ナイキ靴下', 5, '倉庫', '倉庫', '浜松', '2021-03-31 17:40:20'),
(3, '002-544487', 'ナイキ靴下', 10, '店舗', '店舗', '浜田', '2021-03-31 17:40:49'),
(4, '002-382274', 'シャネル ランニングシューズ', 2, '倉庫', '倉庫', 'ゆめ', '2021-03-31 20:01:10'),
(5, '001-335432', 'ソイプロテイン', 2, '倉庫', '倉庫', 'ジャック', '2021-04-01 12:03:52'),
(6, '002-000003', 'アディダス シューズ', 20, '倉庫', '倉庫', '大和', '2021-04-01 12:19:42'),
(7, '001-498761', 'EAA グレープフルーツ味', 10, '倉庫', '倉庫', 'チャーリー', '2021-04-01 12:32:08'),
(8, '002-000003', 'アディダス シューズ', 10, '倉庫', '倉庫', 'トミー', '2021-04-01 14:27:10'),
(9, '003-888888', 'パワーベルト', 4, '倉庫', '倉庫', 'ボブ', '2021-04-01 15:11:09'),
(10, '001-000008', 'プロテイン　バニラ味', 20, '倉庫', '倉庫', 'チャーリー', '2021-04-03 13:38:35'),
(11, '001-000001', 'プロテイン　きなこ味', 30, '倉庫', '倉庫', 'キム', '2021-04-03 14:05:15'),
(12, '002-321982', 'アンダーアーマー Tシャツ', 20, '店舗', '店舗', 'ジョンソン', '2021-04-06 15:49:47'),
(13, '002-321982', 'アンダーアーマー Tシャツ', 40, '倉庫', '倉庫', 'ボブ', '2021-04-06 15:50:09'),
(14, '001-009920', 'aaa', 20, '倉庫', '倉庫', 'ジョンソン', '2021-04-08 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_db`
--

CREATE TABLE `order_db` (
  `id` int(12) NOT NULL,
  `category` varchar(64) NOT NULL,
  `model_num` varchar(12) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `indate` datetime NOT NULL,
  `order_amount` int(8) NOT NULL,
  `order_person` varchar(64) NOT NULL,
  `status` varchar(12) DEFAULT NULL,
  `delivery_person` varchar(64) DEFAULT NULL,
  `place` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_db`
--

INSERT INTO `order_db` (`id`, `category`, `model_num`, `product_name`, `indate`, `order_amount`, `order_person`, `status`, `delivery_person`, `place`) VALUES
(4, 'clothes', '002-038291', 'Tシャツ', '2021-03-30 23:09:44', 10, 'ボブ', 'done', '高木', '店舗：8 倉庫：2'),
(5, 'clothes', '002-038291', 'Tシャツ', '2021-03-30 23:10:01', 10, 'ボブ', 'done', 'ジェニファー', '店舗：5 倉庫：5'),
(7, 'supplements', '001-498761', 'EAA', '2021-03-30 23:26:28', 10, 'みやもと', 'done', 'トム', '店舗：10 倉庫：0'),
(8, 'clothes', '002-544487', 'ナイキ靴下', '2021-03-31 00:27:27', 20, 'ジョン', 'done', 'マイケル', '店舗：10 倉庫：10'),
(9, 'supplements', '001-498761', 'EAA', '2021-03-31 16:58:30', 5, 'モーリス', 'done', 'トムソン', '店舗：5 倉庫：0'),
(10, 'supplements', '001-498761', 'EAA', '2021-03-31 16:59:54', 5, 'トーマス', 'done', 'ボブ', '店舗：3 倉庫：2'),
(11, 'supplements', '001-498761', 'EAA', '2021-03-31 17:01:58', 5, '陳', 'done', 'ジョン', '店舗：0 倉庫：5'),
(12, 'supplements', '001-498761', 'EAA', '2021-03-31 17:04:45', 5, 'リンダ', 'done', 'キム', '店舗：0 倉庫：5'),
(13, 'supplements', '001-498761', 'EAA', '2021-03-31 17:05:50', 5, '高尾', 'done', 'トム', '店舗：2 倉庫：3'),
(28, 'clothes', '002-382274', 'シャネル', '2021-03-31 20:00:24', 3, 'ゆめ', 'done', 'ゆめ', '店舗：2 倉庫：1'),
(34, 'equipment', '003-888888', 'パワーベルト', '2021-04-01 15:16:07', 5, 'トーマス', 'done', '高木', '店舗：5 倉庫：0'),
(35, 'supplements', '001-000008', 'プロテイン　バニラ味', '2021-04-03 13:39:30', 30, '陳', 'done', 'トムソン', '店舗：20 倉庫：10'),
(36, 'supplements', '001-000001', 'プロテイン　きなこ味', '2021-04-03 14:06:02', 40, 'トーマス', 'done', '高木', '店舗：20 倉庫：20'),
(39, 'clothes', '002-321982', 'アンダーアーマー', '2021-04-06 15:52:54', 50, 'ジョン', 'done', 'マイケル', '店舗：10 倉庫：40'),
(40, 'clothes', '002-038291', 'Tシャツ', '2021-04-08 14:09:55', 10, 'ジョン', 'done', '高木', '店舗：8 倉庫：2'),
(41, 'supplements', '001-009920', 'aaa', '2021-04-08 15:09:23', 10, 'トーマス', 'done', 'ジェニファー', '店舗：8 倉庫：2');

-- --------------------------------------------------------

--
-- Table structure for table `product_num_master`
--

CREATE TABLE `product_num_master` (
  `model_num` varchar(12) NOT NULL,
  `category` varchar(64) NOT NULL,
  `product_name` varchar(64) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_num_master`
--

INSERT INTO `product_num_master` (`model_num`, `category`, `product_name`, `indate`) VALUES
('001-000001', 'supplements', 'プロテイン　きなこ味', '2021-04-03 14:04:27'),
('001-000007', 'supplements', 'プロテイン　バナナ味', '2021-04-03 13:28:54'),
('001-000008', 'supplements', 'プロテイン　バニラ味', '2021-04-03 13:37:22'),
('001-084312', 'supplements', 'グリコ　クレアチン', '2021-04-01 12:34:47'),
('001-335432', 'supplements', 'ソイプロテイン', '2021-03-30 10:49:34'),
('001-498761', 'supplements', 'EAA グレープフルーツ味', '2021-03-30 23:25:23'),
('002-000003', 'clothes', 'アディダス シューズ', '2021-03-30 22:34:36'),
('002-038291', 'clothes', 'Tシャツ', '2021-03-30 10:47:51'),
('002-382274', 'clothes', 'シャネル ランニングシューズ', '2021-03-31 19:59:44'),
('002-544487', 'clothes', 'ナイキ靴下', '2021-03-30 11:23:56'),
('003-888888', 'equipment', 'パワーベルト', '2021-04-01 15:10:46'),
('004-000001', 'books', '大胸筋マスター', '2021-03-30 22:35:24'),
('004-666531', 'books', 'ベースボールマガジン社　腹筋マスター', '2021-03-31 20:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `total_db`
--

CREATE TABLE `total_db` (
  `model_num` varchar(12) NOT NULL,
  `category` varchar(64) NOT NULL,
  `product_name` varchar(64) NOT NULL,
  `total_amount` int(8) DEFAULT NULL,
  `shop_amount` int(8) DEFAULT NULL,
  `warehouse_amount` int(8) DEFAULT NULL,
  `waiting_amount` int(8) DEFAULT NULL,
  `threshold` int(8) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `total_db`
--

INSERT INTO `total_db` (`model_num`, `category`, `product_name`, `total_amount`, `shop_amount`, `warehouse_amount`, `waiting_amount`, `threshold`, `indate`) VALUES
('001-000001', 'supplements', 'プロテイン　きなこ味', 70, 40, 30, 0, 70, '2021-04-03 14:04:27'),
('001-000008', 'supplements', 'プロテイン　バニラ味', 80, 50, 30, 0, 70, '2021-04-03 13:37:22'),
('001-084312', 'supplements', 'グリコ　クレアチン', 100, 15, 85, 0, 70, '2021-04-06 15:27:28'),
('001-335432', 'supplements', 'ソイプロテイン', 8, 3, 5, 0, 200, '2021-04-06 15:28:38'),
('001-498761', 'supplements', 'EAA グレープフルーツ味', 55, 40, 15, 0, 15, '2021-04-06 15:26:58'),
('002-000003', 'clothes', 'アディダス シューズ', 100, 60, 40, 0, 50, '2021-04-06 15:29:18'),
('002-038291', 'clothes', 'Tシャツ', 110, 79, 31, 0, 50, '2021-04-01 15:15:38'),
('002-382274', 'clothes', 'シャネル ランニングシューズ', 6, 4, 2, 0, 3, '2021-03-31 19:59:44'),
('002-544487', 'clothes', 'ナイキ靴下', 35, 15, 20, 0, 35, '2021-04-06 15:28:57'),
('003-888888', 'equipment', 'パワーベルト', 10, 7, 3, 0, 7, '2021-04-01 15:10:46'),
('004-000001', 'books', '大胸筋マスター', 110, 45, 55, 0, 50, '2021-03-30 23:08:47'),
('004-666531', 'books', 'ベースボールマガジン社　腹筋マスター', 20, 10, 10, 0, 15, '2021-04-06 15:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `use_db`
--

CREATE TABLE `use_db` (
  `id` int(12) NOT NULL,
  `category` varchar(64) NOT NULL,
  `model_num` varchar(12) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `use_amount` int(8) NOT NULL,
  `place` varchar(64) NOT NULL,
  `reason` varchar(64) NOT NULL,
  `person_in_charge` varchar(64) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `use_db`
--

INSERT INTO `use_db` (`id`, `category`, `model_num`, `product_name`, `use_amount`, `place`, `reason`, `person_in_charge`, `indate`) VALUES
(6, 'clothes', '002-544487', 'ナイキ靴下', 20, 'shop', 'sale', 'キム', '2021-03-31 14:39:29'),
(8, 'clothes', '002-544487', 'ナイキ靴下', 5, '倉庫', '紛失', 'トミー', '2021-03-31 14:42:36'),
(9, 'clothes', '002-382274', 'シャネル ランニングシューズ', 2, '店舗', '販売', 'ゆめ', '2021-03-31 20:01:54'),
(10, 'supplements', '001-335432', 'ソイプロテイン', 2, '店舗', '販売', 'ボブ', '2021-04-01 12:30:28'),
(11, 'supplements', '001-498761', 'EAA グレープフルーツ味', 10, '倉庫', '破損', 'ジョンソン', '2021-04-01 12:32:39'),
(12, 'equipment', '003-888888', 'パワーベルト', 5, '店舗', '販売', 'チャーリー', '2021-04-01 15:14:50'),
(13, 'supplements', '001-000008', 'プロテイン　バニラ味', 50, '店舗', '販売', 'ボブ', '2021-04-03 13:39:09'),
(14, 'supplements', '001-000001', 'プロテイン　きなこ味', 50, '店舗', '販売', 'チャーリー', '2021-04-03 14:05:38'),
(15, 'clothes', '002-321982', 'アンダーアーマー Tシャツ', 70, '店舗', '販売', 'トミー', '2021-04-06 15:50:27'),
(16, 'supplements', '001-000001', 'プロテイン　きなこ味', 20, '店舗', '販売', 'キム', '2021-04-08 15:08:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `move_db`
--
ALTER TABLE `move_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_db`
--
ALTER TABLE `order_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_num_master`
--
ALTER TABLE `product_num_master`
  ADD PRIMARY KEY (`model_num`,`indate`),
  ADD UNIQUE KEY `model_num` (`model_num`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `total_db`
--
ALTER TABLE `total_db`
  ADD PRIMARY KEY (`model_num`),
  ADD UNIQUE KEY `model_num` (`model_num`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `use_db`
--
ALTER TABLE `use_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `move_db`
--
ALTER TABLE `move_db`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_db`
--
ALTER TABLE `order_db`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `use_db`
--
ALTER TABLE `use_db`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
