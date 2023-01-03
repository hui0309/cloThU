-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-03 15:41:21
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
-- 資料表結構 `cloth_number`
--

CREATE TABLE `cloth_number` (
  `user_id` varchar(20) CHARACTER SET utf8 NOT NULL,
  `cloth_id` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cloth_number`
--

INSERT INTO `cloth_number` (`user_id`, `cloth_id`) VALUES
('00957117', 1),
('00957117', 2),
('00957117', 3),
('00957117', 4);

--
-- 觸發器 `cloth_number`
--
DELIMITER $$
CREATE TRIGGER `cloth_del` AFTER DELETE ON `cloth_number` FOR EACH ROW BEGIN
delete from cloth_detail
WHERE cloth_detail.cloth_id = OLD.cloth_id;
END
$$
DELIMITER ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cloth_number`
--
ALTER TABLE `cloth_number`
  ADD PRIMARY KEY (`user_id`,`cloth_id`),
  ADD KEY `cloth_idfk` (`cloth_id`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `cloth_number`
--
ALTER TABLE `cloth_number`
  ADD CONSTRAINT `cloth_idfk` FOREIGN KEY (`cloth_id`) REFERENCES `cloth_detail` (`cloth_id`),
  ADD CONSTRAINT `user_idfk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
