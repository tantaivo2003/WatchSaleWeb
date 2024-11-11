-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3390
-- Thời gian đã tạo: Th12 08, 2023 lúc 03:56 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ltw_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `orderId` int(11) NOT NULL,
  `orderUsername` varchar(255) NOT NULL,
  `orderTotalPrice` int(11) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`orderId`, `orderUsername`, `orderTotalPrice`, `orderDate`, `status`) VALUES
(276899, 'dungdinh', 221800, '2023-12-07', 'Awaiting Shipment'),
(341795, 'duongminh', 56950, '2023-12-08', 'Pending'),
(497970, 'duongminh', 239997, '2023-12-08', 'Pending'),
(706374, 'dungdinh', 319996, '2023-12-07', 'Pending'),
(944072, 'dungdinh', 79999, '2023-12-07', 'Pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhangbaogomsp`
--

CREATE TABLE `donhangbaogomsp` (
  `oId` int(11) NOT NULL,
  `oProductId` int(11) NOT NULL,
  `totalProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhangbaogomsp`
--

INSERT INTO `donhangbaogomsp` (`oId`, `oProductId`, `totalProduct`) VALUES
(276899, 1, 2),
(276899, 3, 2),
(341795, 2, 1),
(497970, 1, 1),
(706374, 1, 4),
(944072, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohangbaogomsp`
--

CREATE TABLE `giohangbaogomsp` (
  `cUsername` varchar(255) NOT NULL,
  `cProductId` int(11) NOT NULL,
  `totalProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohangbaogomsp`
--

INSERT INTO `giohangbaogomsp` (`cUsername`, `cProductId`, `totalProduct`) VALUES
('dungdinh', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `isbanned` tinyint(1) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`username`, `password`, `fullname`, `phoneNumber`, `email`, `sex`, `address`, `dateOfBirth`, `avatar`, `isbanned`, `role`) VALUES
('dungdinh', '$2y$10$0SHiTQnSGC0LvqICVY4AT.YzRb1OZJvwuoUmlLBQiv.GTz/1zvMza', 'Đinh Hoàng Dũng', '0123456133', 'tantaivo2003@gmail.com', 'Male', 'Tp. Mỹ Tho', '2023-12-31', '', 1, 'user'),
('duongminh', '$2y$10$C0mIU5z2PY7r2hwsQrstoOM4X.4s/E7Icqsnk3zptPnsLHMmpfBFu', 'Dương Minh', '0869209520', 'tantaivo2003@gmail.com', 'male', 'Tp. Mỹ Tho', '0000-00-00', '', 0, 'user'),
('hiuchoet', '$2y$10$SkRFd1w1cEKFDdPF4T0Vge1oWwlw26sMazaODLjSQqtVSc54qMk.m', 'Hiếu', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'user'),
('tantai', '$2y$10$VWNudJygg6lpTElzTKDs5OF4jHanGJlL.CDhCCw9pYPlPbZgevbcS', 'Tài', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidungdanhgiasp`
--

CREATE TABLE `nguoidungdanhgiasp` (
  `rId` int(11) NOT NULL,
  `rUsername` varchar(255) DEFAULT NULL,
  `rProductId` int(11) DEFAULT NULL,
  `numberStar` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `dateComment` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidungdanhgiasp`
--

INSERT INTO `nguoidungdanhgiasp` (`rId`, `rUsername`, `rProductId`, `numberStar`, `comment`, `dateComment`) VALUES
(5, 'dungdinh', 3, 5, 'adađâ', '2023-12-07'),
(10, 'tantai', 3, 5, 'ngon đấy', '2023-12-07'),
(11, 'dungdinh', 1, 5, 'âs', '2023-12-07'),
(12, 'hiuchoet', 1, 5, 'sản phẩm rất tốt!', '2023-12-08'),
(13, 'hiuchoet', 2, 5, 'mua ngay đi ae', '2023-12-08'),
(14, 'hiuchoet', 2, 5, 'sản phẩm tốt', '2023-12-08'),
(15, 'duongminh', 1, 5, 'sản phẩm tốt', '2023-12-08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `productId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `productType` varchar(50) DEFAULT NULL,
  `display` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`productId`, `name`, `price`, `description`, `imageUrl`, `productType`, `display`) VALUES
(1, 'Patek Phillipe Aquanaut REF 5167/1A-001', 79999, 'Đồng hồ tự động Patek Philippe Aquanaut đã qua sử dụng (5066/1J-001), có một vỏ 18k vàng vàng 36mm bao quanh mặt đen trên dây đeo cổ tay cùng làm từ vàng 18k với khóa gập. Các chức năng bao gồm giờ, phút, giây và ngày. Đồng hồ đi kèm với bản sao trích xuất nguyên bản. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!', 'https://watchbox-cdn.imgix.net/posted-product-images/638355438865294417_pate324117_4858171_96793_36-10.jpg?', 'Patek Phillipe', 0),
(2, 'Patek Phillipe Aquanaut REF 5167/1A-001', 56950, 'Đồng hồ tự động Patek Philippe Aquanaut đã qua sử dụng (5167/1A-001), có một vỏ thép không gỉ 40mm bao quanh mặt đen có họa tiết, được đặt trên dây đeo bằng thép không gỉ với khóa gập. Các chức năng bao gồm giờ, phút, giây và ngày. Đồng hồ này đã được bảo dưỡng và đi kèm với hộp đựng và giấy tờ nguyên bản. Còn thời gian bảo hành dịch vụ của nhà sản xuất!', 'https://watchbox-cdn.imgix.net/posted-product-images/638301972530653699_PATE319323_4831988_95426_40-2.jpg?', 'Patek Phillipe', 1),
(3, 'Vacheron Constantin Traditionnelle World Time REF 86060/000R-8985', 30950, 'Đồng hồ tự động Vacheron Constantin Traditionnelle World Time đã qua sử dụng (86060/000R-8985), có một vỏ vàng hồng 18k kích thước 42.5mm bao quanh mặt đồng hồ màu bạc và hồng, được đặt trên dây đeo da cá sấu màu nâu hoàn toàn mới với khóa gập vàng hồng 18k. Chức năng bao gồm giờ, phút, giây và thời gian thế giới. Đồng hồ này đã được bảo dưỡng và đi kèm với hộp và giấy bảo hành nguyên bản. Còn thời gian bảo hành dịch vụ của nhà sản xuất!', 'https://watchbox-cdn.imgix.net/posted-product-images/637950628952387224_VACH304765_4551230_77836_42-1.jpg?', 'Vacheron Constantin', 1),
(4, 'Audemars Piguet Millenary REF 77266OR.GG.A823CR.01', 18950, 'Đồng hồ tự động Audemars Piguet Millenary đã qua sử dụng (77266ORGGA823CR01), có một vỏ vàng hồng 18k mờ kích thước 39.5mm bao quanh mặt đồng hồ màu nâu với hoa văn gồm nhiều chấm trên dây đeo da cá sấu nâu, được kết hợp với khóa cài vàng hồng 18k. Chức năng bao gồm giờ và phút. Đồng hồ này đi kèm đầy đủ với hộp và giấy tờ. Số serial K. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!', 'https://watchbox-cdn.imgix.net/posted-product-images/637750153503954343.jpg?', 'Audemars Piguet', 1),
(5, 'Audemars Piguet CODE 11.59 Chronograph\r\nREF 26393OR.OO.A028CR.01', 40950, 'Đồng hồ tự động Audemars Piguet CODE 11.59 Chronograph đã qua sử dụng (26393OR.OO.A028CR.01), có một vỏ vàng hồng 18k kích thước 41mm bao quanh mặt đồng hồ màu xanh dương với hiệu ứng nắng trên dây đeo da cá sấu đen, được kết hợp với khóa cài vàng hồng 18k. Chức năng bao gồm giờ, phút, giây nhỏ, ngày, đồng hồ bấm giờ và vòng đo tốc độ. Đồng hồ này đi kèm đầy đủ với hộp và giấy tờ nguyên bản. Số serial phân tán. Còn thời gian bảo hành nhà máy!', 'https://watchbox-cdn.imgix.net/posted-product-images/638247709776466704_aude310660_4834990_95731_41-11.jpg?', 'Audemars Piguet', 1),
(6, 'Audemars Piguet Royal Oak \"Jumbo\" Extra-Thin\r\nREF 16202ST.OO.1240ST.02', 89950, 'Đồng hồ tự động Audemars Piguet Royal Oak \"Jumbo\" Extra-Thin đã qua sử dụng (16202ST.OO.1240ST.02), có một vỏ thép không gỉ kích thước 39mm bao quanh mặt đồng hồ màu \"bleu nuit nuage 50\" Petite Tapisserie, được đặt trên dây đeo thép không gỉ với khóa gập. Chức năng bao gồm giờ, phút và ngày. Đồng hồ này đi kèm với hộp và giấy tờ nguyên bản. Số serial phân tán. Hầu hết thời gian bảo hành nhà máy vẫn còn lại! Để duy trì đặc tính và giá trị sưu tập, chúng tôi không mài đánh đồng hồ này. Đồng hồ này sẽ sẵn sàng gửi trong vòng 5-7 ngày!!', 'https://watchbox-cdn.imgix.net/posted-product-images/638212905100818165_AUDE314092_4830709_95543_39-14.jpg?', 'Audemars Piguet', 1),
(7, 'Patek Phillipe Calatrava REF 4896G-001', 21950, 'Đồng hồ Patek Philippe Calatrava đã qua sử dụng (4896G-001), sử dụng cơ cấu quay bằng tay, có một vỏ vàng trắng 18k có kích thước 33mm với đính kim cương trên viền bao quanh mặt đồng hồ màu xanh đậm guilloche, được đặt trên dây đeo satin màu xanh hoàn toàn mới với khóa cài bằng vàng trắng 18k. Chức năng bao gồm giờ và phút. Đồng hồ này đi kèm với giấy tờ. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm! Đồng hồ này sẽ sẵn sàng gửi trong vòng 5-7 ngày!', 'https://watchbox-cdn.imgix.net/posted-product-images/638326008717798910_pate602981_4886719_97840_33-31.jpg?', 'Patek Phillipe', 1),
(8, 'Patek Phillipe Grand Complications Perpetual Calendar Minute Repeater Tonneau REF 5013J-001', 349950, 'Đồng hồ tự động Patek Philippe Grand Complications Perpetual Calendar Minute Repeater Tonneau đã qua sử dụng (5013J-001), có một vỏ vàng vàng 18k kích thước 36mm bao quanh mặt đồng hồ màu bạc, được đặt trên dây đeo da cá sấu đen hoàn toàn mới với khóa cài vàng 18k. Các chức năng bao gồm giờ, phút, giây, ngày, thứ, máy kêu, tháng, pha mặt trăng và lịch vạn niên. Đồng hồ này đã được bảo dưỡng, đi kèm với dấu niêm phong dịch vụ và bản trích xuất. Còn thời gian bảo hành dịch vụ của nhà sản xuất! Đồng hồ này sẽ sẵn sàng gửi trong vòng 5-7 ngày!', 'https://watchbox-cdn.imgix.net/posted-product-images/638210339572835037_pate323036_4762191_91769-2.jpg?', 'Patek Phillipe', 1),
(9, 'Vacheron Patrimony Special Edition REF 91180/000R-9192', 16950, 'Đồng hồ cơ Vacheron Constantin Patrimony Special Edition đã qua sử dụng (91180/000R-9192), có một vỏ vàng hồng 18k kích thước 40mm bao quanh mặt đồng hồ màu đen, được đặt trên dây đeo da cá sấu màu đen với khóa cài vàng hồng 18k. Chức năng bao gồm giờ, phút và giây nhỏ. Đồng hồ này không đi kèm với hộp hoặc giấy tờ. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!\r\n\r\n\r\n\r\n\r\n\r\n', 'https://watchbox-cdn.imgix.net/posted-product-images/638314277192786481_5f29cd48-5ed1-42d1-abd2-4a4696bee67c.jpg?', 'Vacheron Constantin', 1),
(10, 'Patek Phillipe Nautilus REF 3900/1A-001', 39950, 'Đồng hồ Patek Philippe Nautilus đã qua sử dụng (3900/1A-001), sử dụng cơ cấu quartz, có một vỏ thép không gỉ 32mm bao quanh mặt đồng hồ màu xanh lá cây, đặt trên dây đeo bằng thép không gỉ với khóa gập. Các chức năng bao gồm giờ, phút, giây và ngày. Đồng hồ này không đi kèm với hộp hoặc giấy tờ. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!', 'https://watchbox-cdn.imgix.net/posted-product-images/638338425328130782_1679d390-5519-4095-94fa-f95d5a4b86a9.jpg?', 'Patek Phillipe', 1),
(11, 'Vacheron Overseas Perpetual Calendar Ultra-Thin REF 4300V/120G-B945', 109950, 'Đồng hồ tự động Vacheron Constantin Overseas Perpetual Calendar Ultra-Thin đã qua sử dụng (4300V/120G-B945), có một vỏ vàng trắng 18k kích thước 41.5mm bao quanh mặt đồng hồ màu xanh dương, được đặt trên dây đeo vàng trắng 18k với khóa gập. Chức năng bao gồm giờ, phút, giây, ngày, thứ, tháng, pha mặt trăng và lịch vạn niên. Đồng hồ này đi kèm với hộp và giấy tờ nguyên bản. Còn thời gian bảo hành nhà máy! Đồng hồ này sẽ sẵn sàng gửi trong vòng 5-7 ngày!', 'https://watchbox-cdn.imgix.net/posted-product-images/638192500230570518_vach_4776662_RR_1.jpg?', 'Vacheron Constantin', 1),
(12, 'Vacheron Overseas Chronograph REF 5500V/110A-B686', 33950, 'Đồng hồ tự động Vacheron Constantin Overseas Chronograph đã qua sử dụng (5500V/110A-B686), có một vỏ thép không gỉ kích thước 42.5mm bao quanh mặt đồng hồ màu bạc, được đặt trên dây đeo thép không gỉ với khóa gập. Chức năng bao gồm giờ, phút, giây nhỏ, ngày và đồng hồ bấm giờ. Đồng hồ này đi kèm với hộp và giấy tờ nguyên bản. Hầu hết thời gian bảo hành nhà máy vẫn còn lại!', 'https://watchbox-cdn.imgix.net/posted-product-images/638369426434774415_vach306969_4901104_98837_43-24.jpg?', 'Vacheron Constantin', 1),
(13, 'Vacheron Overseas REF 4500V/110R-B705', 72950, 'Đồng hồ tự động Vacheron Constantin Overseas đã qua sử dụng (4500V/110R-B705), có một vỏ vàng hồng 18k kích thước 41mm bao quanh mặt đồng hồ màu xanh dương, được đặt trên dây đeo vàng hồng 18k với khóa gập. Chức năng bao gồm giờ, phút, giây và ngày. Đồng hồ này đi kèm với hộp và giấy tờ nguyên bản. Còn thời gian bảo hành nhà máy!', 'https://watchbox-cdn.imgix.net/posted-product-images/638367612359211099_VACH306978_4901864_98671_41-1.jpg?', 'Vacheron Constantin', 1),
(14, 'Audemars Piguet Edward Piguet Large Date Tourbillon\r\nREF 26009BC.OO.D002CR.01', 54950, 'Đồng hồ cơ Audemars Piguet Edward Piguet Large Date Tourbillon đã qua sử dụng (26009BC.OO.D002CR.01), có một vỏ vàng trắng 18k kích thước 34mm x 51mm bao quanh mặt đồng hồ màu bạc, được đặt trên dây đeo da cá sấu màu đen với khóa cài vàng trắng 18k. Chức năng bao gồm giờ, phút, tourbillon và ngày. Đồng hồ này đi kèm với giấy tờ. Số serial F. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!', 'https://watchbox-cdn.imgix.net/posted-product-images/638113696570180874_aude313243_4713681_89726_34-1.jpg?', 'Audemars Piguet', 1),
(15, 'Audemars Piguet Royal Oak Chronograph Frosted Limited Edition REF 26331BC.GG.1224BC.03', 184950, 'Đồng hồ tự động Audemars Piguet Royal Oak Chronograph Frosted Limited Edition đã qua sử dụng (26331BC.GG.1224BC.03), có một vỏ vàng trắng 18k mờ kích thước 41mm bao quanh mặt đồng hồ màu đen Grande Tapiserrie, được đặt trên dây đeo vàng trắng 18k mờ với khóa gập. Chức năng bao gồm giờ, phút, giây nhỏ, đồng hồ bấm giờ và ngày. Đồng hồ này đi kèm đầy đủ với hộp và giấy tờ. Số serial phân tán. Đây là một phiên bản giới hạn chỉ có 111 chiếc! Còn thời gian bảo hành nhà máy!', 'https://watchbox-cdn.imgix.net/posted-product-images/638091363878605556_aude313557_4763389_91806_41_1.jpg?', 'Audemars Piguet', 1),
(16, 'Audemars Piguet Royal Oak REF 15413OR.YY.1220OR.01', 299950, 'Đồng hồ tự động Audemars Piguet Royal Oak đã qua sử dụng (15413OR.YY.1220OR.01), có một vỏ vàng hồng 18k kích thước 41mm với đính cầu vồng màu xinh đẹp, bao quanh mặt đồng hồ màu kim cương, được đặt trên dây đeo vàng hồng 18k với khóa gập. Chức năng bao gồm giờ, phút, giây và ngày. Đồng hồ này đi kèm với hộp và giấy tờ nguyên bản cũng như hướng dẫn sử dụng. Số serial K. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm! Đồng hồ này sẽ sẵn sàng gửi trong vòng 5-7 ngày!', 'https://watchbox-cdn.imgix.net/posted-product-images/637939159983467303_aude313235_4711693_89678_41_4.jpg?', 'Audemars Piguet', 1),
(17, 'Patek Phillipe Grand Complication Split-Seconds Chronograph REF 5370P-011', 234950, 'Đồng hồ cơ Patek Philippe Grand Complication Split-Seconds Chronograph đã qua sử dụng (5370P-011), có một vỏ bằng bạch kim kích thước 41mm bao quanh mặt đồng hồ màu xanh đậm grand feu bleu enamel, được đặt trên dây đeo da cá sấu màu hải quân mới hoàn toàn với khóa gập Calatrava Cross bằng bạch kim. Chức năng bao gồm giờ, phút, giây nhỏ, đồng hồ bấm giờ chia và vòng đo tốc độ. Đồng hồ này đi kèm đầy đủ với hộp và giấy tờ nguyên bản. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!', 'https://watchbox-cdn.imgix.net/posted-product-images/638223286591789300_PATE323663_4839726_95998_41-1.jpg?', 'Patek Phillipe', 1),
(18, 'Patek Phillipe Grand Complications Perpetual Calendar Chronograph REF 5270P-001', 199950, 'Đồng hồ cơ Patek Philippe Grand Complications Perpetual Calendar Chronograph đã qua sử dụng (5270P-001), có một vỏ bằng bạch kim kích thước 41mm bao quanh mặt đồng hồ màu hồng vàng opaline, được đặt trên dây đeo da cá sấu màu nâu với khóa gập Calatrava Cross bằng bạch kim. Chức năng bao gồm giờ, phút, giây nhỏ, ngày, đồng hồ bấm giờ, ngày, tháng, pha mặt trăng và lịch vạn niên. Đồng hồ này đi kèm đầy đủ với hộp và giấy tờ nguyên bản. Chúng tôi hỗ trợ sản phẩm này với bảo hành WatchBox 2 năm!', 'https://watchbox-cdn.imgix.net/posted-product-images/638340111167641138_PATE324521_4894812_98611-41-10.jpg?', 'Patek Phillipe', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thenganhang`
--

CREATE TABLE `thenganhang` (
  `cardNumber` varchar(20) NOT NULL,
  `CVV` varchar(4) DEFAULT NULL,
  `expirationDate` date DEFAULT NULL,
  `cardUsername` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thenganhang`
--

INSERT INTO `thenganhang` (`cardNumber`, `CVV`, `expirationDate`, `cardUsername`) VALUES
('61319319193', '1313', '2023-12-10', 'dungdinh'),
('144451451413', '1331', '2024-01-07', 'duongminh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtin`
--

CREATE TABLE `thongtin` (
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtin`
--

INSERT INTO `thongtin` (`address`, `phone`, `email`, `facebook`, `instagram`) VALUES
('268 Lý Thường Kiệt Phường 14, Quận 10, Thành phố Hồ Chí Minh', '0948315738', 'timeElite@gmail.com', 'www.facebook.com/TimeElite.vn', '@TimeElite');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `orderUsernameToUsername` (`orderUsername`);

--
-- Chỉ mục cho bảng `donhangbaogomsp`
--
ALTER TABLE `donhangbaogomsp`
  ADD PRIMARY KEY (`oId`,`oProductId`),
  ADD KEY `oProductIdtoProductId` (`oProductId`);

--
-- Chỉ mục cho bảng `giohangbaogomsp`
--
ALTER TABLE `giohangbaogomsp`
  ADD PRIMARY KEY (`cUsername`,`cProductId`),
  ADD KEY `cProductIdtoProductId` (`cProductId`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `nguoidungdanhgiasp`
--
ALTER TABLE `nguoidungdanhgiasp`
  ADD PRIMARY KEY (`rId`),
  ADD KEY `rUsernameToUsername` (`rUsername`),
  ADD KEY `rProductIdToProductId` (`rProductId`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`productId`);

--
-- Chỉ mục cho bảng `thenganhang`
--
ALTER TABLE `thenganhang`
  ADD PRIMARY KEY (`cardUsername`);

--
-- Chỉ mục cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  ADD PRIMARY KEY (`address`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `nguoidungdanhgiasp`
--
ALTER TABLE `nguoidungdanhgiasp`
  MODIFY `rId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `orderUsernameToUsername` FOREIGN KEY (`orderUsername`) REFERENCES `khachhang` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhangbaogomsp`
--
ALTER TABLE `donhangbaogomsp`
  ADD CONSTRAINT `oIdtoOrderId` FOREIGN KEY (`oId`) REFERENCES `donhang` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oProductIdtoProductId` FOREIGN KEY (`oProductId`) REFERENCES `sanpham` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giohangbaogomsp`
--
ALTER TABLE `giohangbaogomsp`
  ADD CONSTRAINT `cProductIdtoProductId` FOREIGN KEY (`cProductId`) REFERENCES `sanpham` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cUsernametoUsername` FOREIGN KEY (`cUsername`) REFERENCES `khachhang` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `nguoidungdanhgiasp`
--
ALTER TABLE `nguoidungdanhgiasp`
  ADD CONSTRAINT `rProductIdToProductId` FOREIGN KEY (`rProductId`) REFERENCES `sanpham` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rUsernameToUsername` FOREIGN KEY (`rUsername`) REFERENCES `khachhang` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thenganhang`
--
ALTER TABLE `thenganhang`
  ADD CONSTRAINT `CardToKH` FOREIGN KEY (`cardUsername`) REFERENCES `khachhang` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
