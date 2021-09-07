-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2020 lúc 04:08 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pt15317project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `ma_b` int(11) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `id_hh` int(11) NOT NULL,
  `ma_kh` varchar(255) NOT NULL,
  `ngay_bl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`ma_b`, `noi_dung`, `id_hh`, `ma_kh`, `ngay_bl`) VALUES
(101, '4', 32, 'PH11301', '2020-09-21'),
(102, 'oke', 22, 'PH11301', '2020-09-21'),
(103, 'đẹp', 22, 'PH11301', '2020-09-21'),
(106, 'f', 34, 'PH11301', '2020-09-21'),
(107, 'nope', 34, 'PH11301', '2020-09-21'),
(109, 'h', 21, 'PH11301', '2020-09-21'),
(114, 'sss', 28, 'PH11301', '2020-09-21'),
(115, 'e', 34, 'PH11301', '2020-09-21'),
(116, 'vv', 21, 'PH11301', '2020-09-22'),
(117, 'd', 28, 'PH11301', '2020-09-22'),
(118, 'a', 28, 'PH11301', '2020-09-22'),
(120, 'eqttgq', 34, 'PH11301', '2020-09-22'),
(121, 'fl;', 33, 'PH11301', '2020-09-22'),
(122, 'agagaagaga', 5, 'PH11301', '2020-09-22'),
(123, 'sssj', 33, 'PH11301', '2020-09-22'),
(124, 'sshhs', 25, 'PH11301', '2020-09-22'),
(125, 'ahaha', 25, 'PH11301', '2020-09-22'),
(126, 'ahhah', 34, 'PH11301', '2020-09-22'),
(127, 'fffff', 33, 'PH11301', '2020-09-22'),
(128, 'eu', 34, 'PH11301', '2020-09-22'),
(129, 'rrr', 27, 'PH11301', '2020-09-22'),
(130, 'âtt', 6, 'PH11301', '2020-09-22'),
(132, 'nhu cc', 6, 'PH11301', '2020-09-22'),
(133, 'à thế à', 7, 'PH11301', '2020-09-22'),
(134, 'f', 28, 'PH11301', '2020-09-22'),
(135, 'f', 28, 'PH11301', '2020-09-22'),
(136, 'gs', 28, 'PH11301', '2020-09-22'),
(137, 'sss', 28, 'PH11301', '2020-09-22'),
(138, 'nu', 27, 'PH11301', '2020-09-22'),
(139, 'ád', 7, 'PH11301', '2020-09-22'),
(140, 'a', 18, 'PH11301', '2020-09-24'),
(141, 'tuyệt vời', 18, 'PH11301', '2020-09-24'),
(142, 'nope', 25, 'thuytn2222', '2020-09-26'),
(143, 'ssuhsuhs', 25, 'PH11301', '2020-09-26'),
(156, 'r', 27, 'PH11301', '2020-10-02'),
(158, 't', 27, 'thuytn2222', '2020-10-02'),
(159, 't', 34, 'thuytn2222', '2020-10-02'),
(160, 'pre', 27, 'PH11301', '2020-10-03'),
(161, '1234', 22, 'thuytn2222', '2020-10-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `ten_hh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_kh` varchar(255) NOT NULL,
  `dia_chi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int(11) NOT NULL,
  `yeu_cau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `tenloai` varchar(255) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders_products`
--

INSERT INTO `orders_products` (`id`, `ten_hh`, `ma_kh`, `dia_chi`, `so_luong`, `yeu_cau`, `image`, `tenloai`, `gia`) VALUES
(28, 'Oppo A9x 128GB Full HD LTPS IPS', 'PH11301', '56u4737', 3, '5', 'publics/uploads/5f65bc347882f-oppo-a9x-15581084167901955183579.jpg', '', 11700000),
(33, 'Apple Iphone 8 Plus 128GB chính hãng', 'PH11301', 'khối 8 phường quỳnh thiện', 2, 'r', 'publics/uploads/5f645436da58c-iphone_8_plus_1.jpg', '', 11700000),
(38, 'Oppo Reno4 Pro', 'PH11301', 'khối 8 phường quỳnh thiện', 3, '2345678kjn', 'publics/uploads/5f65bbaf312c3-_0001_combo_-_reno4_pro_-_white.jpg', '', 10800000),
(39, 'Samsung Galaxy Note 20+ Plus 2K 2020', 'PH11301', 'khối 8 phường quỳnh thiện', 2, 'edfrghjk', 'publics/uploads/5f646ea33b644-mint_final.jpg', '', 18480000),
(40, 'Samsung Galaxy Note 20+ Plus 2K 2020', 'PH11301', 'khối 8 phường quỳnh thiện', 2, 'edfrghjk', 'publics/uploads/5f646ea33b644-mint_final.jpg', '', 18480000),
(41, 'Samsung Galaxy S20+ BTS Edition', 'PH11301', 'khối 8 phường quỳnh thiện', 3, '5', 'publics/uploads/5f646e5eeb960-s20_ultra_bts_edition_0003_samsung_galaxy_s20_plus_bts_edit.jpg', '', 20010000),
(42, 'Samsung Galaxy Note 20 Plus 2K 2020', 'PH11301', 'khối 8 phường quỳnh thiện', 2, '4', 'publics/uploads/5f646ea33b644-mint_final.jpg', '', 18480000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ma_hh` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `don_gia` int(11) NOT NULL,
  `sale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenloai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hang_db` tinyint(11) NOT NULL,
  `ngay_nhap` date NOT NULL,
  `luot_xem` int(11) NOT NULL,
  `mo_ta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ky_gui` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ma_hh`, `name`, `don_gia`, `sale`, `image`, `tenloai`, `hang_db`, `ngay_nhap`, `luot_xem`, `mo_ta`, `ky_gui`) VALUES
(4, 'Iphone 11 128GB chính hãng 2020', 19000000, '10', 'publics/uploads/5f782c98315d3-5f645430d8d16-ip-11-mint.jpg', '1', 1, '2020-10-26', 6, 'Ngoài phiên bản 128GB, bạn cũng có thể lựa chọn cho mình điện thoại iPhone 11 64GB nếu nhu cầu sử dụng của bạn không quá nhiều.', 1),
(5, 'Apple Iphone 8 Plus 128GB chính hãng', 13000000, '10', 'publics/uploads/5f782d707a76e-5f645436da58c-iphone_8_plus_1.jpg', '1', 0, '2020-10-29', 14, 'Kế thừa sự thành công của iPhone 7/7 Plus, Apple lại tiếp tục làm cộng đồng yêu công nghệ phải chú ý khi cho ra mắt mẫu điện thoại iPhone 12 và kế tiếp của họ - iPhone 8 Plus 128GB. iPhone 8 Plus 128GB sở hữu thiết kế đẳng cấp với mặt lưng làm từ kính hoà', 0),
(6, 'Apple Iphone 7 Plus 128GB chính hãng', 9000000, '10', 'publics/uploads/5f782da86cbb8-5f64543da79a0-iphone-7-plus-den.jpg', '1', 0, '2020-10-29', 2, 'Với bộ nhớ được nâng cấp lên 128Gb, iPhone 7 Plus 128Gb xóa tan nỗi lo cạn kiệt bộ nhớ của bạn, giúp bạn thỏa sức chụp ảnh, quay phim cùng trải nghiệm những tựa game mới nhất một cách thoải mái mà không phải lo lắng đến việc thiếu hụt bộ nhớ cho các nhu c', 0),
(7, 'iPhone 11 64GB chính hãng VN/A 2020', 17000000, '12', 'publics/uploads/5f782df6d2628-5f64544390b72-iphone-11-white_.jpg', '1', 0, '2020-10-29', 9, 'iPhone 11 có kiểu dáng đẹp mắt khi được hoàn thiện từ nhôm và vỏ kính bền nhất trong thế giới smartphone. Máy được sử dụng tới 7 tầm nền màu sắc giúp màu sơn có độ sâu đầy ấn tượng phản chiếu qua lớp kính sang trọng.\r\nThiết kế từ nhôm và vỏ kính, chuẩn ch', 0),
(18, 'Oppo Find X2 Snapdragon 865 12GB RAM', 17800000, '12', 'publics/uploads/5f782e58e7e18-5f646c7ac2292-637191049692122812_oppo-find-x2-xanh-1.png', '2', 1, '2020-10-29', 6, 'Cung cấp sức mạnh cho chiếc điện thoại Oppo Find X2 là con chip là Snapdragon 865 mới nhất hiện nay. Vi xử lý này cho hiệu năng cải thiện 15% đồng thời tiết kiệm pin tới 14% so với những máy dùng Snapdragon 660, có thể trải nghiệm tốt nhiều tựa game.\r\nVi ', 0),
(19, 'OPPO A12 4GB IPS LCD , HD Plus ColorOS 6.1', 4000000, '10', 'publics/uploads/5f782e31683f8-5f646ccd96311-a12-den_2.png', '2', 0, '2020-10-29', 3, 'Về cấu hình, Oppo A12 3GB được tích hợp con chip MediaTek Helio P35 8 nhân với 4 nhân tốc độ cao 2.3 GHz và 4 nhân tốc độ 1.8 GHz. Bộ nhớ trong 32GB, hỗ trợ khe gắn thẻ nhớ ngoài Micro SD lên tới 256 GB giúp người dùng lưu trữ nhiều dữ liệu như phim, ảnh,', 0),
(20, 'Oppo Reno 3 Pro Helio P95 ColorOS 7', 10000000, '10', 'publics/uploads/5f782ec28748a-oppo-reno3-pro-den-400x460-400x460.png', '2', 0, '2020-10-29', 2, 'Phiên bản nâng cấp của điện thoại OPPO Reno3 với tên gọi OPPO Reno 3 Pro đã chính thức được hãng OPPO trình làng vào tháng 3/2020. Với thiết kế nổi bật, hiệu năng mạnh mẽ cùng camera đột phá, Reno 3 Pro hứa hẹn sẽ là chiếc sm', 0),
(21, 'Oppo A92 128GB Snapdragon 665 8GB RAM', 6000000, '10', 'publics/uploads/5f7830c5a8952-5f646d528c413-oppo_a92_trang.png', '2', 0, '2020-10-29', 4, 'OPPO A92 là mẫu smartphone tầm trung vừa mới được OPPO cho ra mắt, gây ấn tượng với thiết kế màn hình khoét lỗ tràn viền, cụm bốn camera ấn tượng và đang được bán với mức giá vô cùng phải chăng.', 0),
(22, 'Samsung Galaxy Note 20 Ultra 5G', 29600000, '15', 'publics/uploads/5f7830f8917b6-5f646ddee95db-yellow_final_2.jpg', '4', 1, '2020-10-29', 17, 'Bên cạnh biên bản Note 20 thường, Samsung còn cho ra mắt Note 20 Ultra 5G cho khả năng kết nối dữ liệu cao cùng thiết kế nguyên khối sang trọng, bắt mắt. Đây sẽ là sự lựa chọn hoàn hảo dành cho bạn để sử dụng mà không bị lỗi thời sau thời gian dài ra mắt.', 0),
(23, 'Samsung Galaxy Z Flip 256GB 2020', 23000000, '13', 'publics/uploads/5f78311e5d7b1-5f646e21d2f51-z-flip-1_1.jpg', '4', 0, '2020-10-29', 4, 'Chúng ta đều biết Samsung là thương hiệu nổi tiếng đến từ Hàn Quốc, đây cũng là đất nước bắt nguồn cho làn sóng Kpop bùng nổ mạnh mẽ trên toàn thế giới. Một trong những nhóm nhạc nam nổi tiếng nhất nhì Kpop và sở hữu số lượng người hâm mộ “cực khủng” trên', 0),
(24, 'Samsung Galaxy S20 Plus BTS Edition', 23000000, '13', 'publics/uploads/5f78314daee6f-5f646e5eeb960-s20_ultra_bts_edition_0003_samsung_galaxy_s20_plus_bts_edit.jpg', '4', 0, '2020-10-29', 28, 'Chúng ta đều biết Samsung là thương hiệu nổi tiếng đến từ Hàn Quốc, đây cũng là đất nước bắt nguồn cho làn sóng Kpop bùng nổ mạnh mẽ trên toàn thế giới. Một trong những nhóm nhạc nam nổi tiếng nhất nhì Kpop và sở hữu số lượng người hâm mộ “cực khủng” trên', 0),
(25, 'Samsung Galaxy Note 20 Plus 2K 2020', 21000000, '12', 'publics/uploads/5f79aaab59a27-5f646ea33b644-mint_final.jpg', '4', 0, '2020-10-29', 62, 'Trong thời đại mà công nghệ phát triển từng ngày thì ngày càng nhiều dòng smartphone đẳng cấp được ra mắt để cạnh tranh trên thị trường. Samsung chính là một trong những thương hiệu đi đầu trong việc thường xuyên cho ra mắt những dòng điện thoại thông min', 0),
(27, 'iPhone SE 2020 128GB chính hãng VN/A', 12100000, '10', 'publics/uploads/5f782b913e8f6-5f674cb931c21-iphone-se-2020.jpg', '1', 0, '2020-10-29', 371, 'Nếu nhu cầu lưu trữ của bạn không quá nhiều thì điện thoại iPhone SE 2020 64GB là sự lựa chọn hợp lý.', 0),
(28, 'iPhone X 64GB chính hãng Mã ( VN/A ) 2020', 19000000, '12', 'publics/uploads/5f782bcf40232-5f671c3e29b86-iphone-x-final_1_1.jpg', '1', 1, '2020-10-29', 6, 'Sản phẩm kỷ niệm 10 năm ra mắt của Apple nên iPhone X 64GB có sự thay đổi so với bộ đôi iPhone 8, 8 Plus trước đó từ tính năng đến thiết kế khiến nhiều người dùng smartphone khao khát. Ngoài ra, bạn có thể tham khảo phiên bản dung lượng bộ nhớ trong cao h', 0),
(31, 'Oppo Reno4 Pro Snapdragon 720G 5G', 12000000, '10', 'publics/uploads/5f782c09e7aec-5f671dd0c3e0d-_0001_combo_-_reno4_pro_-_white.jpg', '2', 0, '2020-10-29', 3, 'Hãng smartphone nổi tiếng OPPO vừa qua đã trình làng sản phẩm mới thuộc dòng Reno, đó chính là OPPO Reno 4 Pro cùng với Reno 4. Đây là chiếc smartphone có thiết kế thời thượng, hiệu năng mạnh mẽ cùng bộ ba camera chụp ảnh ấn tượn', 0),
(32, 'Oppo A9x 128GB Full HD LTPS IPS LCD', 13000000, '10', 'publics/uploads/5f79aaff9ad06-5f65bc347882f-oppo-a9x-15581084167901955183579.jpg', '2', 0, '2020-10-29', 7, 'Bên cạnh biên bản Note 20 thường, Samsung còn cho ra mắt Note 20 Ultra 5G cho khả năng kết nối dữ liệu cao cùng thiết kế nguyên khối sang trọng, bắt mắt. Đây sẽ là sự lựa chọn hoàn hảo dành cho bạn để sử dụng mà không bị lỗi thời sau thời gian dài ra mắt.', 0),
(33, 'Samsung Galaxy Z Fold2 5G 256GB', 50000000, '17', 'publics/uploads/5f782c2b20ffc-5f65bd47b3359-galaxy-z-fold2-5g-1.jpg', '4', 1, '2020-10-29', 9, 'Trong thời đại mà công nghệ phát triển từng ngày thì ngày càng nhiều dòng smartphone đẳng cấp được ra mắt để cạnh tranh trên thị trường. Samsung chính là một trong những thương hiệu đi đầu trong việc thường xuyên cho ra mắt những dòng điện thoại thông min', 0),
(34, 'Samsung Galaxy Note 10 (Plus) Exynos 9825', 27000000, '14', 'publics/uploads/5f782c4e987b4-5f65bd7f69140-note_10_plus_xanh.jpg', '4', 0, '2020-10-29', 52, 'Là phiên bản nâng cấp đáng giá ra đời cùng thời điểm với Samsung Galaxy Note 10, Samsung Galaxy Note 10 Plus là sự lựa chọn tuyệt vời cho người dùng đam mê công nghệ có nhu cầu sở hữu một chiếc điện thoại hoàn hảo về mọi mặt. Với Note 10 Plus, Samsung đã ', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sectors`
--

CREATE TABLE `sectors` (
  `ma_loai` int(11) NOT NULL,
  `ten_loai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sectors`
--

INSERT INTO `sectors` (`ma_loai`, `ten_loai`) VALUES
(1, 'Iphone'),
(2, 'Oppo '),
(4, 'Samsung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ma_kh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kich_hoat` tinyint(1) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vai_tro` tinyint(1) DEFAULT NULL,
  `ngay_sinh` date NOT NULL,
  `number_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ma_kh`, `name`, `password`, `kich_hoat`, `email`, `avatar`, `vai_tro`, `ngay_sinh`, `number_phone`) VALUES
('fqtw', 'Huy Phan', '$2y$10$WM2tD7e6SlkmmcLEJonl7uMyrJnuIp88aiyYMmn8iECzr08slzIAC', 1, 'huypqph11301@fpt.edu.vn', 'publics/uploads/5f942f59483a7-màn hình mockup banner.jpg', 0, '2020-10-25', '0974743636'),
('fqtw11', 'Huy Phan', '$2y$10$YHAafZNibtKNdDSwcuhld.z2IcHJNzaxPwykAg0DHr8ERSl7PKDsK', 1, 'huypqph13@gmail.com', 'publics/uploads/5f94311829761-màn hình mockup banner.jpg', 1, '2020-10-26', '0382233421'),
('huy123455', 'Huy Phan', '$2y$10$Xi83uPfkODkxrGOQbNh0o.4.GzSxSjaxil4KHhaQDQraaybpicpim', 1, 'huypqph22@gmail.com', 'publics/uploads/5f942caa80c3d-Screenshot (11).png', 1, '2020-10-26', '0382233423'),
('PH11301', 'Quốc Huy', '$2y$10$eUJ2JJGi6uMEa7kjWirDDeTRPa/X6cl4RrvAOJt97qF.6zKq4MBM2', 1, 'something@gmail.com', 'publics/uploads/5f671dd0c3e0d-_0001_combo_-_reno4_pro_-_white.jpg', 1, '2020-10-29', '0365791629'),
('thuytn2222', 'Huy Phan', '$2y$10$8PXExd/DHzUd7fDWrAiBQ.CMem/a3icGwFpVsLTgsnckAse6qhcyC', 1, 'phanquochuypthm@gmail.com', 'publics/uploads/5f671dececb6f-galaxy-z-fold2-5g-1.jpg', 0, '2020-10-25', '0963374464');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ma_b`);

--
-- Chỉ mục cho bảng `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ma_hh`);

--
-- Chỉ mục cho bảng `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`ma_loai`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ma_kh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `ma_b` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT cho bảng `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ma_hh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `sectors`
--
ALTER TABLE `sectors`
  MODIFY `ma_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
