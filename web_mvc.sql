-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2021 lúc 09:47 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_mvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `bill_Id` int(11) NOT NULL,
  `billName` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL,
  `billDate` varchar(50) NOT NULL,
  `billAddress` varchar(100) NOT NULL,
  `billPhone` varchar(10) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `check_seen` int(11) NOT NULL,
  `month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`bill_Id`, `billName`, `userId`, `billDate`, `billAddress`, `billPhone`, `subtotal`, `check_seen`, `month`) VALUES
(1, 'Bui Duc Hieu', 1, '12-11-2021 11:02:52pm', '12 Nhu Hoa, Son Tra, Da Nang, VietNam', '0987654321', 87000, 0, 11),
(2, 'Bui Duc Hieu', 1, '15-11-2021 09:18:12am', '12 Nhu Hoa, Son Tra, Da Nang, VietNam', '0987654321', 72000, 1, 11),
(3, 'Bui Duc Hieu', 1, '15-11-2021 10:35:37am', '12 Nhu Hoa, Son Tra, Da Nang, VietNam', '0987654321', 26000, 1, 11),
(4, 'Bui Duc Hieu', 1, '15-11-2021 10:55:14am', '12 Nhu Hoa, Son Tra, Da Nang, VietNam', '0987654321', 47000, 1, 11),
(5, 'Truong Tan', 8, '16-11-2021 11:08:32pm', '89 Thu Khoa Huan, Son Tra, Da Nang, VietNam', '0329734008', 87000, 1, 11),
(6, 'sdf', 10, '16-11-2021 11:58:33pm', '98 S, Son Tra, Da Nang, VietNam', '0948525026', 28000, 0, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_details`
--

CREATE TABLE `bill_details` (
  `bill_Id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bill_details`
--

INSERT INTO `bill_details` (`bill_Id`, `productId`, `productName`, `productQuantity`, `productPrice`, `total`, `discount`, `month`) VALUES
(1, 1, 'Black Coffee ', 4, 13000, 52000, 0, 11),
(1, 2, 'Milk Coffee', 1, 15000, 15000, 0, 11),
(1, 3, 'Capuchino', 1, 20000, 20000, 0, 11),
(2, 1, 'Black Coffee ', 4, 13000, 52000, 0, 11),
(2, 3, 'Capuchino', 1, 20000, 20000, 0, 11),
(3, 1, 'Black Coffee ', 2, 13000, 26000, 0, 11),
(4, 2, 'Milk Coffee', 2, 15000, 30000, 0, 11),
(4, 4, 'Coffee Saigon', 1, 17000, 17000, 0, 11),
(5, 1, 'Black Coffee ', 4, 13000, 52000, 0, 11),
(5, 2, 'Milk Coffee', 1, 15000, 15000, 0, 11),
(5, 3, 'Capuchino', 1, 20000, 20000, 0, 11),
(6, 1, 'Black Coffee ', 1, 13000, 13000, 0, 11),
(6, 2, 'Milk Coffee', 1, 15000, 15000, 0, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `cartName` varchar(50) NOT NULL,
  `cartImage` varchar(50) NOT NULL,
  `cartPrice` int(11) NOT NULL,
  `cartQuantity` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cartId`, `productId`, `cartName`, `cartImage`, `cartPrice`, `cartQuantity`, `userId`) VALUES
(36, 1, 'Black Coffee ', 'cfden.png', 13000, 3, 1),
(40, 5, 'White', 'bx.png', 22000, 1, 1),
(41, 10, 'Blueberry Yogurt', 'scvq.png', 35000, 3, 1),
(42, 11, 'Latte', 'latte.png', 35000, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `commentproduct`
--

CREATE TABLE `commentproduct` (
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userAvatar` varchar(50) NOT NULL,
  `commentDate` varchar(25) NOT NULL,
  `commentContent` varchar(500) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `commentproduct`
--

INSERT INTO `commentproduct` (`commentId`, `userId`, `userName`, `userAvatar`, `commentDate`, `commentContent`, `productId`) VALUES
(1, 1, 'Bui Duc Hieu', 'avt.png', '17-11-2021 03:35:53pm', 'So good for product...', 1),
(2, 1, 'Bui Duc Hieu', 'avt.png', '17-11-2021 03:37:22pm', 'Beautiful this coffee!!!', 1),
(3, 8, 'Truong Tan', 'avt.png', '17-11-2021 03:47:15pm', 'nice!!!\r\nFree ship <3', 1),
(4, 8, 'Truong Tan', 'avt.png', '17-11-2021 03:48:06pm', 'Pro pro pro !?>,', 2),
(5, 1, 'Bui Duc Hieu', 'avt.png', '17-11-2021 03:53:51pm', 'Hello...', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `contactId` int(11) NOT NULL,
  `contactName` varchar(50) NOT NULL,
  `contactEmail` varchar(50) NOT NULL,
  `contactTitle` varchar(500) NOT NULL,
  `contactMessage` varchar(2000) NOT NULL,
  `contactDate` varchar(25) NOT NULL,
  `check_seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`contactId`, `contactName`, `contactEmail`, `contactTitle`, `contactMessage`, `contactDate`, `check_seen`) VALUES
(1, 'Truong Tan', 'truongtannauan@gmail.com', '2', '23', '17-11-2021 04:38:33pm', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'TruongTan', 'tan@gmail.com', 'tanadmin', 'e10adc3949ba59abbe56e057f20f883e', 0),
(2, 'HongVan', 'hongvan@gmail.com', 'admin', '123', 1),
(3, 'dung', '', 'ad', '', 2),
(4, 'dung123', 'truongtannauan@gmail.com', 'ad2', '202cb962ac59075b964b07152d234b70', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `bannerId` int(11) NOT NULL,
  `bannerName` varchar(100) NOT NULL,
  `bannerImage` varchar(50) NOT NULL,
  `bannerDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_banner`
--

INSERT INTO `tbl_banner` (`bannerId`, `bannerName`, `bannerImage`, `bannerDescription`) VALUES
(1, 'Banner 1', 'banner-01.jpg', 'See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.'),
(2, 'Banner 2', 'banner-02.jpg', 'See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.'),
(3, 'Banner 3', 'banner-03.jpg', 'See how your users experience your website in realtime or view <br> trends to see any changes in performance over time.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blogs`
--

CREATE TABLE `tbl_blogs` (
  `blogId` int(11) NOT NULL,
  `blogName` varchar(50) NOT NULL,
  `blogDemo` varchar(500) NOT NULL,
  `blogDescription` varchar(50) NOT NULL,
  `blogUpDate` datetime NOT NULL,
  `blogImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_blogs`
--

INSERT INTO `tbl_blogs` (`blogId`, `blogName`, `blogDemo`, `blogDescription`, `blogUpDate`, `blogImage`) VALUES
(1, 'Good things about coffee and love.', 'Add a little sugar to sweeten the coffee? A little more love, do we belong together? Love is like a cup of coffee without sugar, going through so many bitterness of thorns will return with a sweet taste.', 'blog1.txt', '2021-11-07 04:10:33', 'blogs1.jpg'),
(4, 'Coffee and relax', '“Coffee makes us strong, calm and wise” – Jonathan Swifl\r\n“Every morning when I wake up, without a cup of coffee, I feel tasteless!” – Napoleon', 'blog2.txt', '2021-11-07 21:09:15', 'blogs2.jpg'),
(5, 'The most effective way to filter the air and deodo', 'Coffee shop business is not a bad idea and this market is really becoming a delicious piece of cake for investors. The market is attractive, but to survive and develop is not an easy story.', 'blog3.txt', '2021-11-07 21:27:06', 'blog3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` varchar(255) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
('CoffeeViet', 'Coffee Viet'),
('ItaliaCoffee', 'Italia Coffee'),
('SugarcaneJuice', 'Sugarcane Juice'),
('Tea', 'Tea'),
('Vitamin', 'Vitamin'),
('Yogurt', 'Yogurt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_img_ig`
--

CREATE TABLE `tbl_img_ig` (
  `imageId` int(11) NOT NULL,
  `imageImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_img_ig`
--

INSERT INTO `tbl_img_ig` (`imageId`, `imageImage`) VALUES
(1, 'instagram-1.jpg'),
(2, 'instagram-2.jpg'),
(3, 'instagram-3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productDescription` varchar(2000) NOT NULL,
  `brandID` varchar(255) NOT NULL,
  `productCurrentstatus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `productImage`, `productPrice`, `productDescription`, `brandID`, `productCurrentstatus`) VALUES
(1, 'Black Coffee ', 'cfden.png', 13000, '<p>good coffee</p>', 'CoffeeViet', 'NEW'),
(2, 'Milk Coffee', 'cfs.png', 15000, '<p>milk</p>', 'CoffeeViet', 'NEW'),
(3, 'Capuchino', 'capuchino.png', 20000, '<p>cass</p>', 'ItaliaCoffee', 'SALE'),
(4, 'Coffee Saigon', 'cfden.png', 17000, '<p>Coffee Saigon</p>', 'CoffeeViet', 'NEW'),
(5, 'White', 'bx.png', 22000, 'Bac Xiu, the standard of the 50s of the last century, was to drink it hot, served with porridge or pepper cake. However, because the weather of Saigon is hot all year round, people have put a little more ice to calm the sweltering heat. Unexpectedly, after adding ice, the dish became delicious again.', 'CoffeeViet', ''),
(6, 'Peach Orange Tea', 'tdcs.png', 35000, 'The aroma from lemongrass goes well with oranges to create a refreshing drink that is quite attractive. From now on, you don\'t have to spend a lot of money to drink a cup of peach and lemongrass tea in the right style and can be made at home!', 'Tea', 'NEW'),
(7, 'Lemon Tea', 'tchanh.png', 25000, 'Lemon tea is a refreshing drink that combines the balance between the mild acrid taste of tea and the sour taste of lemon to create a unique refreshing drink in the summer. Lemon tea gives drinkers mental alertness, relaxation and comfort.', 'Tea', 'NEW'),
(8, 'Strawberry Tea', 'tdv.png', 40000, 'Strawberry tea steeped with the novelty, sweet and sour taste of strawberries at the tip of the tongue, in harmony with the mild acrid taste of the tea when taken in, is sweetly sweet in the throat, creating the mesmerizing appeal of the solid drink. this distinction.', 'Tea', 'NEW'),
(9, 'Mango Smoothies', 'xoaidaxay.png', 35000, 'Mango is a tropical fruit that is quite popular and loved by all ages. Dubbed the king of fruits, mangoes are not only sweet and easy to eat, but also rich in fiber, protein, vitamins C, A... memory…', 'Vitamin', 'NEW'),
(10, 'Blueberry Yogurt', 'scvq.png', 35000, 'If you want to help your body cool down effectively and safely this summer, you definitely cannot ignore Yogurt Blueberry. This is a nutritious food, with many essential nutrients beneficial for health.', 'Yogurt', 'NEW'),
(11, 'Latte', 'latte.png', 35000, 'Latte is an Italian milk coffee style, made from the main ingredients of Espresso and milk, in which Espresso accounts for 1/3, hot milk accounts for 1/3 and the remaining 1/3 is milk foam. The special thing to create an attractive Latte is the artistically shaped milk foam layer.', 'ItaliaCoffee', 'NEW'),
(12, 'Coconut Coffee', 'cfd.png', 35000, 'If you are a fan of coffee, you will certainly not be able to forget the delicious taste of coconut milk mixed with the bitter taste of coffee. All create an extremely attractive drink called coconut milk coffee.', 'CoffeeViet', 'NEW');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `Id` int(11) NOT NULL,
  `reservationName` varchar(50) NOT NULL,
  `reservationDate` varchar(50) NOT NULL,
  `reservationHour` varchar(10) NOT NULL,
  `reservationPhone` varchar(10) NOT NULL,
  `reservationEmail` varchar(50) NOT NULL,
  `reservationPeople` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `check_seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`Id`, `reservationName`, `reservationDate`, `reservationHour`, `reservationPhone`, `reservationEmail`, `reservationPeople`, `userId`, `check_seen`) VALUES
(1, 'Huy', 'Sunday', '8: 00', '0329734008', '', 2, 0, 1),
(2, '2s', '23', '2', '3333333333', '', 2, 0, 0),
(3, '2s', '23', '2', '3333333333', '', 2, 0, 0),
(5, 'Huy', '2021-11-12', '8: 00', '0329734008', 'vtttan.20it11@vku.udn.vn', 2, 0, 0),
(6, 'Huy', '2021-11-13', '8: 00', '0329734008', 'bdhieu@gmail.com', 1, 0, 0),
(7, 'Nguyen Dung', '2021-11-18', '11: 00', '0946242342', 'ntdung.20it10@vku.udn.vn', 2, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `shipId` int(11) NOT NULL,
  `shipName` varchar(50) NOT NULL,
  `shipPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`shipId`, `shipName`, `shipPrice`) VALUES
(1, 'Standard Delivery', 0),
(2, 'Express Delivery', 50000),
(3, 'Next Business day', 100000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staffId` int(10) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `staffEmail` varchar(50) NOT NULL,
  `staffPhone` varchar(10) NOT NULL,
  `staffPosision` varchar(50) NOT NULL,
  `staffSalary` int(10) NOT NULL,
  `staffBirth` date NOT NULL,
  `staffStartdate` date NOT NULL,
  `staffUser` varchar(50) NOT NULL,
  `staffPass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_staff`
--

INSERT INTO `tbl_staff` (`staffId`, `staffName`, `staffEmail`, `staffPhone`, `staffPosision`, `staffSalary`, `staffBirth`, `staffStartdate`, `staffUser`, `staffPass`) VALUES
(1, 'Bui Duc Hieu', 'bdhieu@gmail.com', '0981238172', 'Accountant', 0, '1994-10-08', '2021-10-08', 'bdhieu', '202cb962ac59075b964b07152d234b70'),
(2, 'Nguyen Dung', 'ntdung@gmail.com', '0981238112', 'Salesman', 0, '2001-10-11', '2021-10-03', 'ntdung', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPhone` varchar(10) NOT NULL,
  `userAddress` varchar(50) NOT NULL,
  `userStartdate` varchar(21) NOT NULL,
  `userUser` varchar(50) NOT NULL,
  `userPass` varchar(50) NOT NULL,
  `userAvatar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `userName`, `userEmail`, `userPhone`, `userAddress`, `userStartdate`, `userUser`, `userPass`, `userAvatar`) VALUES
(1, 'Bui Duc Hieu', 'bdhieu@gmail.com', '0987654321', '12 Nhu Hoa', '10-11-2021 12:37:19pm', 'bdhieu', '202cb962ac59075b964b07152d234b70', 'avt.png'),
(8, 'Truong Tan', 'votatruongtan2601@gmail.com', '0329734008', '89 Thu Khoa Huan', '15-11-2021 02:47:10pm', 'votatruongtan', '202cb962ac59075b964b07152d234b70', 'avt.png'),
(9, 'Nguyen Dung', 'ntdung.20it10@vku.udn.vn', '', '', '16-11-2021 11:37:50pm', 'dungdan', '202cb962ac59075b964b07152d234b70', 'avt.png'),
(10, 'sdf', 'levietvy2@dtu.edu.vn', '', '', '16-11-2021 11:58:04pm', 'luongkhanhty', '202cb962ac59075b964b07152d234b70', 'avt.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_Id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `wishlistName` varchar(50) NOT NULL,
  `wishlistImage` varchar(50) NOT NULL,
  `wishlistPrice` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`wishlist_Id`, `productId`, `wishlistName`, `wishlistImage`, `wishlistPrice`, `userId`) VALUES
(1, 1, 'Black Coffee ', 'cfden.png', 13000, 8),
(2, 3, 'Capuchino', 'capuchino.png', 20000, 8);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_Id`);

--
-- Chỉ mục cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD KEY `bill_Id` (`bill_Id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Chỉ mục cho bảng `commentproduct`
--
ALTER TABLE `commentproduct`
  ADD PRIMARY KEY (`commentId`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`bannerId`);

--
-- Chỉ mục cho bảng `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  ADD PRIMARY KEY (`blogId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_img_ig`
--
ALTER TABLE `tbl_img_ig`
  ADD PRIMARY KEY (`imageId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `brandID` (`brandID`);

--
-- Chỉ mục cho bảng `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`shipId`);

--
-- Chỉ mục cho bảng `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staffId`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_Id`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `commentproduct`
--
ALTER TABLE `commentproduct`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `bannerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_img_ig`
--
ALTER TABLE `tbl_img_ig`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `shipId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staffId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_ibfk_1` FOREIGN KEY (`bill_Id`) REFERENCES `bill` (`bill_Id`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`brandID`) REFERENCES `tbl_brand` (`brandId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
