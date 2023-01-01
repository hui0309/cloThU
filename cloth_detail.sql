-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-01 18:19:40
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `clothu`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cloth_detail`
--

CREATE TABLE `cloth_detail` (
  `cloth_id` bigint(15) NOT NULL,
  `cloth_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cloth_style` int(20) DEFAULT NULL,
  `cloth_img` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cloth_category` int(20) DEFAULT NULL,
  `cloth_info` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `store_id` bigint(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cloth_detail`
--

INSERT INTO `cloth_detail` (`cloth_id`, `cloth_name`, `cloth_style`, `cloth_img`, `cloth_category`, `cloth_info`, `store_id`) VALUES
(1, 'try', 1, NULL, 1, 'erdgtfhyjh', 1),
(2, 'try2', 2, NULL, 2, 'qq33q', 0),
(3, 'try3', 4, NULL, 4, 'qewfdsrgtyuiyouytre', 0),
(4, 'yuitrsiopohgf', 2, NULL, 1, NULL, NULL),
(6, 'wafrdtg', 2, NULL, 1, 'weaara', 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cloth_detail`
--
ALTER TABLE `cloth_detail`
  ADD PRIMARY KEY (`cloth_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
