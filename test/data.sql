--
-- 資料庫： `chiikawashop`
--
CREATE DATABASE IF NOT EXISTS `chiikawashop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chiikawashop`;

-- --------------------------------------------------------

--
-- 資料表結構 `商品`
--

CREATE TABLE `商品` (
  `商品名稱` char(100) NOT NULL,
  `商品描述` text DEFAULT NULL,
  `商品庫存` char(100) DEFAULT NULL,
  `價格` int(11) NOT NULL,
  `會員編號` int(100) DEFAULT NULL,
  `圖片路徑` char(100) DEFAULT NULL,
  `商品編號` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `商品`
--

INSERT INTO `商品` (`商品名稱`, `商品描述`, `商品庫存`, `價格`, `會員編號`, `圖片路徑`, `商品編號`) VALUES
('魔法少女一代-烏薩奇', '☀商品名稱：吉伊卡哇一代-魔法少女掛件<br>☀尺寸：約 H170 x W140 x D80mm<br>☀材質：聚酯纖維、鐵', '10', 540, 1, '/assets/images/magic_usagi.jpg', 1),
('魔法少女一代-吉伊卡哇', '☀商品名稱：吉伊卡哇 一代-魔法少女掛件\r\n☀尺寸：約 H170 x W140 x D80mm\r\n☀材質：聚酯纖維、鐵', '10', 540, 1, '/assets/images/magic_chii.jpg', 2),
('魔法少女一代-小八', '☀商品名稱：吉伊卡哇 一代-魔法少女掛件\r\n☀尺寸：約 H170 x W140 x D80mm\r\n☀材質：聚酯纖維、鐵', '10', 540, 1, '/assets/images/magic_hachi.jpg', 3),
('黑魔法系列-吉伊卡哇', '☀商品名稱：吉伊卡哇 一代-魔法少女掛件\r\n☀尺寸：約 H170 x W140 x D80mm\r\n☀材質：聚酯纖維、鐵', '10', 540, 1, '/assets/images/black_chii.jpg', 4),
('黑魔法系列-小八', '☀商品名稱：吉伊卡哇 一代-魔法少女掛件\r\n☀尺寸：約 H170 x W140 x D80mm\r\n☀材質：聚酯纖維、鐵', '10', 540, 1, '/assets/images/black_hachi.jpg', 5),
('黑魔法系列-烏薩奇', '☀商品名稱：吉伊卡哇 一代-魔法少女掛件\r\n☀尺寸：約 H170 x W140 x D80mm\r\n☀材質：聚酯纖維、鐵', '10', 540, 1, '/assets/images/black_usagi.jpg', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `會員`
--

CREATE TABLE `會員` (
  `帳號` char(100) NOT NULL,
  `密碼` char(100) NOT NULL,
  `會員編號` int(100) NOT NULL,
  `姓名` char(100) DEFAULT NULL,
  `生日` char(100) DEFAULT NULL,
  `管理員` tinyint(4) DEFAULT NULL,
  `地址` char(100) DEFAULT NULL,
  `電話` char(100) NOT NULL,
  `電郵` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `會員`
--

INSERT INTO `會員` (`帳號`, `密碼`, `會員編號`, `姓名`, `生日`, `管理員`, `地址`, `電話`, `電郵`) VALUES
('admin', 'admin', 1, '吉伊大師', '940710', 1, '吉伊的家', '1234567890', 'chii@gmail.com');

-- --------------------------------------------------------

--
-- 資料表結構 `訂單`
--

CREATE TABLE `訂單` (
  `訂單編號` int(100) NOT NULL,
  `運費` int(100) DEFAULT NULL,
  `總價格` int(100) DEFAULT NULL,
  `郵遞區號` char(100) DEFAULT NULL,
  `運送方式` char(100) DEFAULT NULL,
  `運送國家` char(100) DEFAULT NULL,
  `運送地址` char(100) DEFAULT NULL,
  `顧客編號` int(100) DEFAULT NULL,
  `顧客姓名` char(100) DEFAULT NULL,
  `顧客電話` char(100) DEFAULT NULL,
  `顧客電郵` char(100) DEFAULT NULL,
  `商品編號` int(100) DEFAULT NULL,
  `商品名稱` char(100) DEFAULT NULL,
  `商品數量` char(100) DEFAULT NULL,
  `訂單狀態` char(100) DEFAULT '訂單成立',
  `付款狀態` char(100) DEFAULT '未付款',
  `下單日期` timestamp(5) NULL DEFAULT current_timestamp(5),
  `預計到貨日期` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `購物車`
--

CREATE TABLE `購物車` (
  `商品編號` int(100) NOT NULL,
  `圖片` char(100) DEFAULT NULL,
  `會員編號` int(100) NOT NULL,
  `數量` char(100) DEFAULT NULL,
  `價格` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `商品`
--
ALTER TABLE `商品`
  ADD PRIMARY KEY (`商品編號`),
  ADD KEY `商品_ibfk_1` (`會員編號`);

--
-- 資料表索引 `會員`
--
ALTER TABLE `會員`
  ADD PRIMARY KEY (`會員編號`),
  ADD KEY `idx_會員_姓名` (`姓名`,`電話`,`電郵`);

--
-- 資料表索引 `訂單`
--
ALTER TABLE `訂單`
  ADD PRIMARY KEY (`訂單編號`),
  ADD KEY `訂單_商品編號_fk` (`商品編號`),
  ADD KEY `idx_訂單_顧客電話` (`顧客電話`),
  ADD KEY `idx_訂單_顧客電郵` (`顧客電郵`),
  ADD KEY `idx_訂單_顧客姓名` (`顧客姓名`);

--
-- 資料表索引 `購物車`
--
ALTER TABLE `購物車`
  ADD PRIMARY KEY (`會員編號`,`商品編號`),
  ADD KEY `購物車_商品編號_fk` (`商品編號`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `商品`
--
ALTER TABLE `商品`
  MODIFY `商品編號` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `會員`
--
ALTER TABLE `會員`
  MODIFY `會員編號` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `訂單`
--
ALTER TABLE `訂單`
  MODIFY `訂單編號` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `商品`
--
ALTER TABLE `商品`
  ADD CONSTRAINT `商品_ibfk_1` FOREIGN KEY (`會員編號`) REFERENCES `會員` (`會員編號`);

--
-- 資料表的限制式 `訂單`
--
ALTER TABLE `訂單`
  ADD CONSTRAINT `訂單_商品編號_fk` FOREIGN KEY (`商品編號`) REFERENCES `商品` (`商品編號`);

--
-- 資料表的限制式 `購物車`
--
ALTER TABLE `購物車`
  ADD CONSTRAINT `購物車_商品編號_fk` FOREIGN KEY (`商品編號`) REFERENCES `商品` (`商品編號`),
  ADD CONSTRAINT `購物車_會員編號_fk` FOREIGN KEY (`會員編號`) REFERENCES `會員` (`會員編號`);