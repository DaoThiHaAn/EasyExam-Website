-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 05:56 AM
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
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_name`) VALUES
('History'),
('Tiếng Anh'),
('Toán Học'),
('Vật Lý');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `question_text` text NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `picture_link` varchar(500) DEFAULT 'none',
  `difficulty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `category_name`, `question_text`, `correct_answer`, `option_a`, `option_b`, `option_c`, `option_d`, `picture_link`, `difficulty`) VALUES
(1, 'Vật Lý', 'Một vật dao động điều hòa theo phương trình x = A cos(ωt + φ). Pha của dao động ở thời điểm t là?', 'ωt + φ', 'ωt + φ', 'φ', 'ωt', 'φ - ωt', 'none', 1),
(2, 'Vật Lý', 'Một con lắc lò xo có độ cứng k dao động điều hòa dọc theo trục Ox nằm ngang. Khi vật ở vị trí có li độ x thì lực kéo về tác dụng lên vật có giá trị là?', '-kx', '-kx', 'kx', '-kx/2', '2kx', 'none', 1),
(3, 'Vật Lý', 'Một sóng cơ hình sin truyền theo trục Ox. Phương trình dao động của một phần tử trên Ox là u = 5cos(4πt - πx) (mm). Biên độ của sóng là?', '5 mm', '4 mm', '5 mm', '2 mm', '10 mm', 'none', 1),
(4, 'Vật Lý', 'Độ cao của âm là một đặc trưng sinh lí của âm gắn liền với?', 'Tần số âm', 'Mức cường độ âm', 'Đồ thị dao động âm', 'Cường độ âm', 'Tần số âm', 'none', 1),
(5, 'Vật Lý', 'Điện áp u = U0 cos(ωt) (V) có giá trị cực đại là?', 'U0 V', 'U0 V', 'U0/2 V', '2U0 V', 'U0/sqrt(2) V', 'none', 1),
(6, 'Vật Lý', 'Cuộn sơ cấp và cuộn thứ cấp của một máy biến áp lí tưởng có số vòng dây lần lượt là N1 và N2. Hệ thức đúng là?', 'U2/U1 = N2/N1', 'U2/U1 = N1/N2', 'U2/U1 = N2/N1', 'U2 N1 = U1 N2', 'U2 N2 = U1 N1', 'none', 1),
(7, 'Vật Lý', 'Trong sơ đồ khối của máy phát thanh vô tuyến đơn giản không có bộ phận nào sau đây?', 'Mạch tách sóng', 'Mạch khuếch đại', 'Anten phát', 'Mạch tách sóng', 'Micrô', 'none', 1),
(8, 'Vật Lý', 'Quang phổ liên tục do một vật rắn bị nung nóng phát ra?', 'Chỉ phụ thuộc vào nhiệt độ', 'Chỉ phụ thuộc vào bản chất vật', 'Phụ thuộc vào cả bản chất và nhiệt độ', 'Chỉ phụ thuộc vào nhiệt độ', 'Không phụ thuộc vào bản chất và nhiệt độ', 'none', 1),
(9, 'Vật Lý', 'Khi nói về tia γ, phát biểu nào sau đây là đúng?', 'Là sóng điện từ', 'Không có khả năng đâm xuyên', 'Là dòng hạt mang điện', 'Không truyền được trong chân không', 'Là sóng điện từ', 'none', 1),
(10, 'Vật Lý', 'Lần lượt chiếu các ánh sáng đơn sắc: đỏ, tím, vàng và cam vào một chất huỳnh quang thì có một trường hợp phát quang màu chàm. Ánh sáng kích thích là?', 'Tím', 'Cam', 'Tím', 'Vàng', 'Đỏ', 'none', 1),
(11, 'Vật Lý', 'Hạt nhân $_{92}^{235}U$ hấp thụ một hạt nơtron thì vỡ ra thành hai hạt nhân nhẹ hơn. Đây là?', 'Phản ứng phân hạch', 'Quá trình phóng xạ', 'Phản ứng thu năng lượng', 'Phản ứng nhiệt hạch', 'Phản ứng phân hạch', 'none', 1),
(12, 'Vật Lý', 'Cho các tia phóng xạ: $alpha, eta, gamma$. Tia nào có bản chất là sóng điện từ?', 'Tia $gamma$', 'Tia $alpha$', 'Tia $eta$', 'Tia $gamma$', 'Không có tia nào', 'none', 1),
(13, 'Vật Lý', 'Cho hai điện tích điểm đặt trong chân không. Khi khoảng cách giữa hai điện tích là $r$ thì lực tương tác điện giữa chúng có độ lớn là $F$. Khi khoảng cách giữa hai điện tích là $2r$ thì lực tương tác điện giữa chúng có độ lớn là?', '$F/4$', '$F/4$', '$F/2$', '$2F$', '$4F$', 'none', 2),
(14, 'Vật Lý', 'Một cuộn cảm có độ tự cảm $L = 0,2$ H. Khi cường độ dòng điện trong cuộn cảm giảm đều từ $I$ xuống $0$ trong khoảng thời gian $Delta t = 0,05$ s thì suất điện động tự cảm xuất hiện trong cuộn cảm có độ lớn là 8 V. Giá trị của $I$ là?', '2,0 A', '2,0 A', '0,04 A', '0,8 A', '1,25 A', 'none', 2),
(15, 'Vật Lý', 'Một con lắc đơn dao động với phương trình $s = 4cos(4pi t + frac{pi}{3})$ (cm, $t$ tính bằng giây). Tần số dao động của con lắc là?', '2 Hz', '1 Hz', '2 Hz', '$frac{1}{2}$ Hz', '$frac{1}{4}$ Hz', 'none', 2),
(16, 'Vật Lý', 'Trên một sợi dây đang có sóng dừng. Biết sóng truyền trên dây có bước sóng $lambda = 30$ cm. Khoảng cách ngắn nhất từ một nút đến một bụng là?', '15 cm', '30 cm', '60 cm', '7,5 cm', '15 cm', 'none', 2),
(17, 'Vật Lý', 'Đặt điện áp $u = 200sqrt{2} cos(100pi t)$ (V) vào hai đầu đoạn mạch gồm điện trở $100 Omega$, cuộn cảm thuần và tụ điện mắc nối tiếp. Biết trong đoạn mạch có cộng hưởng điện. Cường độ hiệu dụng của dòng điện trong đoạn mạch là?', '2 A', '2 A', '3 A', '1,5 A', '2,5 A', 'none', 2),
(18, 'Vật Lý', 'Một dòng điện có cường độ $i = 2sqrt{2} cos(100pi t)$ (A) chạy qua đoạn mạch chỉ có điện trở $100 Omega$. Công suất tiêu thụ của đoạn mạch là?', '200 W', '400 W', '100 W', '200 W', '50 W', 'none', 2),
(19, 'Vật Lý', 'Một mạch dao động lí tưởng đang có dao động điện từ tự do. Biểu thức điện tích của một bản tụ điện trong mạch là $q = 10^{-6} cos(10^6 t + frac{pi}{4})$ (C, $t$ tính bằng s). Ở thời điểm $t = 0$ s, giá trị của $q$ bằng?', '$10^{-6}$ C', '$10^{-6}$ C', '$10^{-7}$ C', '$10^{-5}$ C', '$10^{-8}$ C', 'none', 2),
(20, 'Vật Lý', 'Một bức xạ đơn sắc có tần số $f = 3 	imes 10^{14}$ Hz. Lấy $c = 3 	imes 10^8$ m/s. Đây là?', 'Ánh sáng tím', 'Bức xạ tử ngoại', 'Ánh sáng tím', 'Ánh sáng đỏ', 'Bức xạ hồng ngoại', 'none', 2),
(21, 'Vật Lý', 'Công thoát của electron khỏi kẽm có giá trị là $3,55$ eV. Lấy $h = 6,625 	imes 10^{-34}$ J.s, $c = 3 	imes 10^8$ m/s và $1$ eV = $1,6 	imes 10^{-19}$ J. Giới hạn quang điện của kẽm là?', '0,29 $mu m$', '0,35 $mu m$', '0,89 $mu m$', '0,29 $mu m$', '0,66 $mu m$', 'none', 2),
(22, 'Vật Lý', 'Xét nguyên tử hidro theo mẫu nguyên tử Bo, khi nguyên tử chuyển từ trạng thái dừng có năng lượng $-3,4$ eV sang trạng thái dừng có năng lượng $-13,6$ eV thì nó phát ra một photon có năng lượng là?', '10,2 eV', '10,2 eV', '3,4 eV', '17,0 eV', '13,6 eV', 'none', 2),
(23, 'Vật Lý', 'Một hạt nhân có độ hụt khối là $0,21$ u. Lấy $1$ u = $931,5$ MeV/$c^2$. Năng lượng liên kết của hạt nhân này là?', '195,615 MeV', '4435,7 J', '195,615 J', '4435,7 MeV', '195,615 MeV', 'none', 2),
(24, 'Vật Lý', 'Thực hiện thí nghiệm về dao động cưỡng bức. Năm con lắc đơn: (1), (2), (3), (4) và (con lắc điều khiển) được treo trên một sợi dây. Ban đầu hệ đang đứng yên ở vị trí cân bằng. Kích thích con lắc điều khiển dao động nhỏ thì con lắc dao động mạnh nhất là?', 'Con lắc (1)', 'Con lắc (4)', 'Con lắc (1)', 'Con lắc (3)', 'Con lắc (2)', 'none', 2),
(25, 'Vật Lý', 'Cho mạch điện với các giá trị $U = 24$ V, $R_1 = 4 Omega$, $U_2 = 12$ V, $R_2 = 6 Omega$, $R_3 = 8 Omega$. Bỏ qua điện trở của ampe kế và dây nối. Số chỉ của ampe kế là?', '2,57 A', '2,57 A', '2,0 A', '0,67 A', '4,5 A', 'none', 2),
(26, 'Vật Lý', 'Một thấu kính hội tụ có tiêu cự $f = 30$ cm. Vật sáng $AB$ đặt vuông góc với trục chính của thấu kính. Ảnh của vật tạo bởi thấu kính là ảnh ảo và cách vật 40 cm. Khoảng cách từ vật đến thấu kính có giá trị gần nhất với?', '26 cm', '26 cm', '60 cm', '43 cm', '10 cm', 'none', 2),
(27, 'Vật Lý', 'Dao động của một vật có khối lượng 100 g là tổng hợp của hai dao động cùng phương có phương trình lần lượt là $x_1 = 4cos(2pi t)$ cm và $x_2 = 3cos(2pi t + frac{pi}{2})$ cm. Động năng cực đại của vật là?', '37,5 mJ', '50 mJ', '37,5 mJ', '25 mJ', '12,5 mJ', 'none', 3),
(28, 'Vật Lý', 'Tiến hành thí nghiệm Y-âng về giao thoa ánh sáng với ánh sáng đơn sắc có bước sóng $0,6 mu m$. Khoảng cách giữa hai khe là $0,3$ mm, khoảng cách từ mặt phẳng chứa hai khe đến màn quan sát là 2 m. Trên màn, khoảng cách giữa vân sáng bậc 3 và vân sáng bậc 5 ở hai phía so với vân sáng trung tâm là?', '20 mm', '8 mm', '12 mm', '20 mm', '32 mm', 'none', 3),
(29, 'Vật Lý', 'Một tấm pin Mặt Trời được chiếu sáng bởi chùm sáng đơn sắc có tần số $5 	imes 10^{14}$ Hz. Biết công suất chiếu sáng vào tấm pin là 0,1 W. Lấy $h = 6,625 	imes 10^{-34}$ J.s. Số phôtôn đập vào tấm pin trong mỗi giây là?', '$6,04 	imes 10^{17}$', '$3,02 	imes 10^{17}$', '$6,04 	imes 10^{17}$', '$3,77 	imes 10^{17}$', '$7,55 	imes 10^{17}$', 'none', 3),
(30, 'Vật Lý', 'Biết số A-vô-ga-đrô là $6,022 	imes 10^{23}$ mol$^{-1}$. Số nơtron có trong $1,5$ mol $_{92}^{238}U$ là?', '$3,61 	imes 10^{24}$', '$9,03 	imes 10^{24}$', '$2,71 	imes 10^{24}$', '$6,32 	imes 10^{24}$', '$3,61 	imes 10^{24}$', 'none', 3),
(31, 'Vật Lý', 'Ở mặt nước, tại hai điểm $S_1$ và $S_2$ cách nhau 19 cm, có hai nguồn kết hợp dao động cùng pha theo phương thẳng đứng, phát ra hai sóng có bước sóng 4 cm. Trên đoạn $S_1S_2$, số điểm cực tiểu giao thoa là?', '6', '4', '6', '7', '5', 'none', 3),
(32, 'Vật Lý', 'Một sóng điện từ lan truyền trong chân không dọc theo đường thẳng từ điểm $A$ đến điểm $B$ cách nhau 45 m. Biết sóng này có thành phần điện trường tại mỗi điểm biến thiên điều hòa theo thời gian với tần số $5$ MHz. Lấy $c = 3 	imes 10^8$ m/s. Thời điểm nào sau đây cường độ điện trường tại $B$ bằng 0?', '8 ns', '12 ns', '10 ns', '8 ns', '6 ns', 'none', 3),
(33, 'Vật Lý', 'Một con lắc lò xo treo thẳng đứng. Từ vị trí cân bằng, nâng vật nhỏ của con lắc theo phương thẳng đứng lên đến vị trí lò xo không biến dạng rồi buông ra, đồng thời truyền cho vật vận tốc $v_0 = 5$ cm/s hướng về vị trí cân bằng. Con lắc dao động điều hòa với tần số $f = 5$ Hz. Lấy $g = 10$ m/s$^2$. Trong một chu kì dao động, khoảng thời gian mà lực kéo về và lực đàn hồi của lò xo tác dụng lên vật ngược hướng nhau là?', '0.4 s', '0.1 s', '0.2 s', '0.3 s', '0.4 s', 'none', 3),
(34, 'Vật Lý', 'Hai điểm sáng dao động điều hòa với cùng biên độ trên một đường thẳng, quanh vị trí cân bằng $O$. Các pha của hai dao động ở thời điểm $t$ là $varphi_1$ và $varphi_2$. Tính từ $t = 0$, thời điểm hai điểm sáng gặp nhau lần đầu là?', '0.15 s', '0.25 s', '0.15 s', '0.3 s', '0.2 s', 'none', 3),
(35, 'Vật Lý', 'Ở mặt nước, một nguồn sóng đặt tại điểm $O$ dao động điều hòa theo phương thẳng đứng. Sóng truyền trên mặt nước có bước sóng $lambda = 5$ cm. $M$ và $N$ là hai điểm trên mặt nước mà phần tử nước ở đó dao động cùng pha với nguồn. Trên các đoạn $OM$, $ON$ có số điểm dao động ngược pha với nguồn lần lượt là 5, 3 và 3. Độ dài đoạn $ON$ có giá trị gần nhất với?', '20 cm', '10 cm', '30 cm', '20 cm', '40 cm', 'none', 3),
(36, 'Vật Lý', 'Đặt điện áp $u = U_0 cos(omega t)$ (V) vào hai đầu đoạn mạch $RLC$ như hình dưới. Biết $R = 50 Omega$, cuộn cảm có $L = 0,2$ H, tụ điện có điện dung $C = 20 mu$F. Điều chỉnh điện dung của tụ điện đến giá trị $C$ sao cho $I$ đạt cực đại. Hệ số công suất của đoạn mạch lúc này bằng?', '866', '333', '500', '866', '894', 'none', 3),
(37, 'Vật Lý', 'Điện năng được truyền từ nhà máy điện đến nơi tiêu thụ bằng đường dây tải điện một pha. Để giảm hao phí trên đường dây, người ta tăng điện áp ở nơi truyền đi bằng máy tăng áp lí tưởng có tỉ số giữa số vòng dây của cuộn thứ cấp và số vòng dây của cuộn sơ cấp là $k$. Biết công suất của nhà máy điện không đổi, điện áp hiệu dụng giữa hai đầu cuộn sơ cấp không đổi, hệ số công suất của mạch điện bằng 1. Khi $k = 10$ thì công suất hao phí trên đường dây bằng 10% công suất ở nơi tiêu thụ. Để công suất hao phí bằng 5%, $k$ phải có giá trị là?', '2025-01-19 00:00:00', '5.0', '2025-01-19 00:00:00', '15.0', '2025-08-13 00:00:00', 'none', 3),
(38, 'Vật Lý', 'Đặt điện áp xoay chiều có giá trị hiệu dụng và tần số không đổi vào hai đầu đoạn mạch mắc nối tiếp gồm biến trở $R$, tụ điện có điện dung $C$ và cuộn cảm thuần có độ tự cảm $L$ thay đổi được. Ứng với mỗi giá trị của $L$, khi $R = 20Omega$ thì trong đoạn mạch có cộng hưởng, khi $R = 50Omega$ thì điện áp hiệu dụng giữa hai đầu cuộn cảm đạt giá trị cực đại. Giá trị của $C$ là?', '0.2 F', '0.5 F', '0.8 F', '0.4 F', '0.2 F', 'none', 3),
(39, 'Vật Lý', 'Tiến hành thí nghiệm Y-âng về giao thoa ánh sáng, nguồn sáng phát ra đồng thời hai ánh sáng đơn sắc có bước sóng $lambda_1$ và $lambda_2$. Trên màn, trong khoảng giữa hai vị trí có vân sáng trùng nhau liên tiếp có tất cả $N$ vị trí mà ở mỗi vị trí đó có một bức xạ cho vân sáng. Biết $lambda_1, lambda_2$ có giá trị nằm trong khoảng từ 400 nm đến 750 nm. $N$ không thể nhận giá trị nào sau đây?', '0.2 F', '5', '7', '6', '8', 'none', 3),
(40, 'Vật Lý', 'Bắn hạt $alpha$ có động năng $4,01$ MeV vào hạt nhân $_7^{14}N$ đứng yên thì thu được một hạt proton và một hạt nhân $_8^{17}O$. Phản ứng này thu năng lượng 1,21 MeV và không kèm theo bức xạ gamma. Biết tỉ số giữa tốc độ của hạt proton và tốc độ của hạt $_8^{17}O$ bằng 8,5. Lấy khối lượng các hạt nhân tính theo đơn vị $u$ bằng số khối của chúng, $c = 3 	imes 10^8$ m/s, 1 u = 931,5 MeV/$c^2$. Tốc độ của hạt $_8^{17}O$ là?', '3.63 × 10^6 m/s', '3.36 × 10^6 m/s', '9.73 × 10^6 m/s', '2.46 × 10^6 m/s', '3.63 × 10^6 m/s', 'none', 1),
(41, 'Vật Lý', 'Một vật dao động điều hòa với tần số $f$. Chu kì dao động của vật được tính bằng công thức?', '$frac{1}{f}$', '$frac{1}{f}$', '$2pi f$', '$2pi / f$', '$1 / (2pi f)$', 'none', 1),
(42, 'Vật Lý', 'Một con lắc lò xo gồm lò xo nhẹ và vật nhỏ có khối lượng $m$ đang dao động điều hòa. Khi vật có tốc độ $v$ thì động năng của con lắc là?', '$frac{1}{2} m v^2$', '$frac{1}{2} m v^2$', '$m v^2$', '$frac{1}{4} m v^2$', '$frac{1}{2} m v^2$', 'none', 1),
(43, 'Vật Lý', 'Trong sự truyền sóng cơ, chu kì dao động của một phần tử môi trường có sóng truyền qua được gọi là?', 'Chu kì của sóng', 'Chu kì của sóng', 'Năng lượng của sóng', 'Tần số của sóng', 'Biên độ của sóng', 'none', 1),
(44, 'Vật Lý', 'Một sóng âm có chu kì $T$ truyền trong một môi trường với tốc độ $v$. Bước sóng của sóng âm trong môi trường này là?', '$v/T$', '$T/v$', '$v/T$', '$Tv$', '$vT$', 'none', 1),
(45, 'Vật Lý', 'Cường độ dòng điện $i = I_0 cos(omega t)$ (A) ($t$ tính bằng s) có tần số góc bằng?', '$omega$', '$omega$', '$omega^2$', '$omega / 2$', '$omega / 4$', 'none', 1),
(46, 'Vật Lý', 'Máy phát điện xoay chiều một pha có phần cảm gồm $p$ cặp cực. Khi máy hoạt động, rôto quay đều với tốc độ $n$ vòng/giây. Suất điện động do máy tạo ra có tần số là?', '$np$', '$np$', '$n/p$', '$n p /2$', '$n p /4$', 'none', 1),
(47, 'Vật Lý', 'Trong quá trình truyền tải điện năng đi xa, để giảm công suất hao phí do tỏa nhiệt trên đường dây truyền tải, người ta thường sử dụng biện pháp nào sau đây?', 'Tăng điện áp hiệu dụng ở nơi truyền đi', 'Tăng điện áp hiệu dụng ở nơi truyền đi', 'Giảm tiết diện dây truyền tải', 'Tăng chiều dài dây truyền tải', 'Giảm điện áp hiệu dụng ở nơi truyền đi', 'none', 1),
(48, 'Vật Lý', 'Mạch dao động lí tưởng gồm tụ điện có điện dung $C$ và cuộn cảm thuần có độ tự cảm $L$. Trong mạch đang có dao động điện từ tự do với tần số $f$. Giá trị của $f$ là?', '$frac{1}{2pisqrt{LC}}$', '$frac{1}{2pisqrt{LC}}$', '$frac{1}{sqrt{2pi LC}}$', '$sqrt{frac{L}{C}}$', '$frac{1}{sqrt{LC}}$', 'none', 1),
(49, 'Vật Lý', 'Trong chân không, sóng điện từ có bước sóng nào sau đây là sóng vô tuyến?', '60 m', '60 m', '0.3 nm', '60 pm', '0.3 m', 'none', 1),
(50, 'Vật Lý', 'Trong bốn ánh sáng đơn sắc: đỏ, lục, lam và tím. Chiết suất của thủy tinh có giá trị lớn nhất đối với ánh sáng nào?', 'Tím', 'Lam', 'Đỏ', 'Tím', 'Lục', 'none', 1),
(51, 'Vật Lý', 'Tia $gamma$ có cùng bản chất với tia nào sau đây?', 'Tia tử ngoại', 'Tia X', 'Tia tử ngoại', 'Tia anpha', 'Tia $eta$', 'none', 1),
(52, 'Vật Lý', 'Gọi $h$ là hằng số Plank. Với ánh sáng đơn sắc có tần số $f$ thì mỗi phôtôn của ánh sáng đó mang năng lượng là?', '$hf$', '$hf$', '$h/f$', '$h + f$', '$h - f$', 'none', 1),
(53, 'Vật Lý', 'Số nuclôn có trong hạt nhân $_{13}^{27} Al$ là?', '27', '40', '13', '27', '14', 'none', 1),
(54, 'Vật Lý', 'Chất phóng xạ $_{90}^{226}Ra$ có hằng số phóng xạ $lambda$. Ban đầu ($t=0$), một mẫu có $N_0$ hạt nhân $Ra$. Tại thời điểm $t$, số hạt nhân $Ra$ còn lại trong mẫu là?', '$N_0 e^{-lambda t}$', '$N_0 e^{-lambda t}$', '$N_0 e^{-lambda t/2}$', '$N_0 e^{-2lambda t}$', '$N_0 e^{-lambda / t}$', 'none', 1),
(55, 'Vật Lý', 'Một điện tích điểm $q = 10^{-6}$ C được đặt tại điểm M trong điện trường thì chịu tác dụng của lực điện có độ lớn $F = 0,012$ N. Cường độ điện trường tại M có độ lớn là?', '2000 V/m', '2000 V/m', '18000 V/m', '12000 V/m', '3000 V/m', 'none', 2),
(56, 'Vật Lý', 'Cho dòng điện không đổi có cường độ 1,2 A chạy trong dây dẫn thẳng dài đặt trong không khí. Độ lớn cảm ứng từ do dòng điện này gây ra tại một điểm cách dây dẫn 0,1 m là?', '$2.4 	imes 10^{-6}$ T', '$2.4 	imes 10^{-6}$ T', '$2.4 	imes 10^{-5}$ T', '$2.4 	imes 10^{-4}$ T', '$2.4 	imes 10^{-3}$ T', 'none', 2),
(57, 'Vật Lý', 'Một con lắc đơn có chiều dài 1 m dao động điều hòa tại nơi có $g = 9,8$ m/s$^2$. Chu kì dao động của con lắc là?', '2 s', '2 s', '1 s', '0.5 s', '9.8 s', 'none', 2),
(58, 'Vật Lý', 'Một con lắc lò xo đang thực hiện dao động cưỡng bức dưới tác dụng của ngoại lực cưỡng bức với phương trình: $F = 4 cos(10t)$ (N) ($t$ tính bằng s). Con lắc dao động với tần số góc là?', '$20$ rad/s', '$10$ rad/s', '$5$ rad/s', '$20$ rad/s', '$30$ rad/s', 'none', 2),
(59, 'Vật Lý', 'Trên một sợi dây đàn hồi có hai đầu cố định đang có sóng dừng với 3 bụng sóng. Biết sóng truyền trên dây có bước sóng 80 cm. Chiều dài sợi dây là?', '120 cm', '180 cm', '120 cm', '240 cm', '160 cm', 'none', 2),
(60, 'Vật Lý', 'Dòng điện có cường độ $i = 2 cos(100 pi t)$ (A) chạy qua một điện trở $R = 50 Omega$. Điện áp hiệu dụng giữa hai đầu điện trở bằng?', '200 V', '100 V', '50 V', '200 V', '25 V', 'none', 2),
(61, 'Vật Lý', 'Khi cho dòng điện xoay chiều có cường độ hiệu dụng bằng 2 A chạy qua một điện trở $R$ thì công suất tỏa nhiệt trên nó là 60 W. Giá trị của $R$ là?', '15 $Omega$', '120 $Omega$', '7.5 $Omega$', '15 $Omega$', '30 $Omega$', 'none', 2),
(62, 'Vật Lý', 'Khi một sóng điện từ có tần số $f = 4 	imes 10^6$ Hz truyền trong một môi trường với tốc độ $v = 3 	imes 10^8$ m/s thì có bước sóng là?', '75 m', '75 m', '150 m', '60 m', '89 m', 'none', 2),
(63, 'Vật Lý', 'Trong thí nghiệm Y-âng về giao thoa ánh sáng, hai khe được chiếu bằng ánh sáng đơn sắc có bước sóng $lambda = 0,5$ μm. Khoảng cách giữa hai khe là 1 mm, khoảng cách từ mặt phẳng chứa hai khe đến màn quan sát là 1 m. Khoảng vân giao thoa trên màn quan sát là?', '0.50 mm', '0.50 mm', '0.25 mm', '0.75 mm', '1.00 mm', 'none', 2),
(64, 'Vật Lý', 'Trong chân không, bức xạ có bước sóng nào sau đây là bức xạ thuộc miền tử ngoại?', '310 nm', '450 nm', '620 nm', '310 nm', '1050 nm', 'none', 2),
(65, 'Vật Lý', 'Khi chiếu bức xạ có bước sóng nào sau đây vào CdTe (giới hạn quang dẫn là 0,82 μm) thì gây ra hiện tượng quang điện trong?', '0.76 μm', '0.9 μm', '0.76 μm', '1.1 μm', '1.9 μm', 'none', 2),
(66, 'Vật Lý', 'Xét nguyên tử hiđrô theo mẫu nguyên tử Bo. Gọi $r_0$ là bán kính Bo. Trong các quỹ đạo dừng của êlectron có bán kính lần lượt là $r_1, r_2, r_3$ và $r_4$, quỹ đạo có bán kính nào tương ứng với trạng thái dừng có mức năng lượng thấp nhất?', '$r_1$', '$r_1$', '$r_2$', '$r_3$', '$r_4$', 'none', 2),
(67, 'Vật Lý', 'Một hạt nhân có độ hụt khối là 0,21 u. Lấy 1 u = 931,5 MeV/$c^2$. Năng lượng liên kết của hạt nhân này là?', '4436 MeV', '4436 J', '4436 MeV', '196 MeV', '196 J', 'none', 2),
(68, 'Vật Lý', 'Để đo thân nhiệt của một người mà không cần tiếp xúc trực tiếp, ta dùng máy đo thân nhiệt điện tử. Máy tiếp nhận năng lượng bức xạ phát ra từ người cần đo. Nhiệt độ của người càng cao thì máy tiếp nhận được năng lượng càng lớn. Bức xạ chủ yếu mà máy nhận được do người phát ra thuộc miền?', 'Hồng ngoại', 'Hồng ngoại', 'Tử ngoại', 'Tia $gamma$', 'Tia X', 'none', 2),
(69, 'Vật Lý', 'Một điện trở $R = 10 Omega$ được mắc vào hai cực của một nguồn điện một chiều có suất điện động $E = 12$ V và điện trở trong $r = 2 Omega$ thành mạch điện kín. Công suất của nguồn điện là?', '14.4 W', '14.4 W', '8 W', '1.6 W', '16 W', 'none', 3),
(70, 'Vật Lý', 'Một thấu kính mỏng được đặt sao cho trục chính trùng với trục $Ox$ của hệ trục tọa độ vuông góc. Điểm sáng $S$ đặt gần trục chính, trước thấu kính. $S\'$ là ảnh của $S$ qua thấu kính. Tiêu cự của thấu kính là?', '60 cm', '30 cm', '60 cm', '75 cm', '12.5 cm', 'none', 3),
(71, 'Vật Lý', 'Dao động của một vật là tổng hợp của hai dao động điều hòa cùng phương, cùng tần số 5 Hz với các biên độ 6 cm và 8 cm. Biết hai dao động ngược pha nhau. Tốc độ của vật có giá trị cực đại là?', '36 cm/s', '63 cm/s', '4.4 m/s', '3.1 m/s', '36 cm/s', 'none', 3),
(72, 'Vật Lý', 'Một con lắc lò xo được treo vào một điểm M cố định, đang dao động điều hòa theo phương thẳng đứng. Hình dưới đây là đồ thị biểu diễn sự phụ thuộc của lực đàn hồi $F$ mà lò xo tác dụng vào vật theo thời gian $t$. Lấy $g = 9,8$ m/s$^2$. Độ dãn của lò xo khi con lắc ở vị trí cân bằng là?', '4 cm', '2 cm', '4 cm', '6 cm', '8 cm', 'none', 3),
(73, 'Vật Lý', 'Trong thí nghiệm về giao thoa sóng ở mặt chất lỏng, tại hai điểm $S_1$ và $S_2$ có hai nguồn dao động cùng pha theo phương thẳng đứng phát ra hai sóng kết hợp với tần số 20 Hz. Tại điểm $M$ cách $S_1$ và $S_2$ lần lượt là 8 cm và 15 cm có cực tiểu giao thoa. Biết số cực đại giao thoa trên các đoạn thẳng $S_1M$ và $S_2M$ lần lượt là 4 và 3. Tốc độ truyền sóng ở mặt chất lỏng là?', '40 cm/s', '20 cm/s', '40 cm/s', '35 cm/s', '45 cm/s', 'none', 3),
(74, 'Vật Lý', 'Một sóng cơ hình sin truyền trên một sợi dây đàn hồi dọc theo trục $Ox$. Hình dưới đây là hình dạng của một đoạn dây tại một thời điểm. Biên độ của sóng có giá trị gần nhất với giá trị nào sau đây?', '3.7 cm', '3.5 cm', '3.7 cm', '3.3 cm', '3.9 cm', 'none', 3),
(75, 'Vật Lý', 'Trong giờ thực hành, để đo điện dung $C$ của một tụ điện, một học sinh mắc mạch điện theo sơ đồ như hình dưới đây. Đặt vào hai đầu $A, B$ một điện áp xoay chiều có giá trị hiệu dụng không đổi và tần số 50 Hz. Khi đóng khóa $K$ vào chốt 1 thì số chỉ ampe kế $A_1$ là $I_1$. Chuyển khóa $K$ sang chốt 2 thì số chỉ của ampe kế $A_2$ là $I_2$. Biết $I_1 > I_2$. Giá trị của $C$ là?', '2.5 μF', '2.5 μF', '5.0 μF', '7.5 μF', '10.0 μF', 'none', 3),
(76, 'Vật Lý', 'Đặt điện áp xoay chiều $u = 200sqrt{2} cos(100 pi t)$ (V) ($t$ tính bằng s) vào hai đầu đoạn mạch mắc nối tiếp gồm điện trở 30 $Omega$, tụ điện có điện dung $C = 20$ $mu$F và cuộn cảm thuần có độ tự cảm $L$ thay đổi được. Điều chỉnh $L$ để cường độ hiệu dụng của dòng điện trong đoạn mạch đạt cực đại. Khi đó, điện áp hiệu dụng giữa hai đầu cuộn cảm là?', '400 V', '100 V', '200 V', '300 V', '400 V', 'none', 3),
(77, 'Vật Lý', 'Một con lắc đơn có vật nhỏ mang điện tích dương được treo ở một nơi trên mặt đất trong điện trường đều có cường độ điện trường $E$. Khi $E$ hướng thẳng đứng xuống dưới thì con lắc dao động điều hòa với chu kì $T_1$. Khi $E$ có phương nằm ngang thì con lắc dao động điều hòa với chu kì $T_2$. Biết trong hai trường hợp, độ lớn cường độ điện trường bằng nhau. Tỉ số $T_1/T_2$ có thể nhận giá trị nào sau đây?', '1.23', '0.89', '1.23', '0.96', '1.15', 'none', 3),
(78, 'Vật Lý', 'Ở mặt chất lỏng, tại hai điểm $S_1$ và $S_2$ có hai nguồn dao động cùng pha theo phương thẳng đứng phát ra hai sóng kết hợp có bước sóng $lambda$. Gọi $I$ là trung điểm của đoạn thẳng $S_1S_2$. Ở mặt chất lỏng, gọi $C$ là hình tròn nhận $S_1S_2$ là đường kính, $M$ là một điểm ở ngoài $C$ gần $I$ nhất mà phần tử chất lỏng ở đó dao động với biên độ cực đại và cùng pha với nguồn. Biết $IM = 2lambda$. Độ dài đoạn thẳng $IM$ có giá trị gần nhất với giá trị nào sau đây?', '4λ', '2λ', '3λ', '4λ', '5λ', 'none', 3),
(79, 'Vật Lý', 'Cho đoạn mạch $AB$ gồm cuộn cảm thuần $L$, điện trở $R = 50 Omega$ và tụ điện mắc nối tiếp theo thứ tự đó. Khi đặt vào hai đầu đoạn mạch $AB$ điện áp $u = 200sqrt{2} cos(100 pi t)$ (V) ($t$ tính bằng s) thì điện áp giữa hai đầu đoạn mạch chứa $R$ và $C$ có biểu thức $u_{RC} = 100sqrt{2} cos(100 pi t + pi/2)$ (V). Công suất tiêu thụ của đoạn mạch $AB$ bằng?', '200 W', '400 W', '100 W', '300 W', '200 W', 'none', 3),
(80, 'Vật Lý', 'Đặt điện áp xoay chiều $u = U_0 cos(omega t)$ (thay đổi được) vào hai đầu đoạn mạch $AB$ như Hình 1, trong đó $R$ là biến trở, tụ điện có điện dung $C = 20 mu$F, cuộn dây có điện trở $r = 10 Omega$ và có độ tự cảm $L = 0,1$ H. Ứng với mỗi giá trị của $R$, điều chỉnh $U_0$ sao cho điện áp giữa hai đầu đoạn mạch $RC$ và điện áp giữa hai đầu đoạn mạch $RL$ vuông pha với nhau. Hình H2 biểu diễn sự phụ thuộc của $U_0$ theo $R$. Giá trị của $R$ là?', '5.6 Ω', '5.6 Ω', '4 Ω', '28 Ω', '14 Ω', 'none', 3),
(81, 'Tiếng Anh', 'Have you decided who to talk about?', 'Not yet. I am still considering.', 'I see. I will talk to him.', 'Let\'s talk about your study.', 'I need to talk to you now.', 'Not yet. I am still considering.', 'none', 1),
(82, 'Tiếng Anh', 'What\'s new with you?', 'Nothing much.', 'Me too.', 'Nothing much.', 'See you later', 'Help yourself.', 'none', 1),
(83, 'Tiếng Anh', 'Connor is said to be very ambitious and aggressive.', 'People regard Connor as an ambitious and aggressive person.', 'People regard Connor as an ambitious and aggressive person.', 'People talk Connor as an ambitious and aggressive person.', 'People believe in Conor as an ambitious and aggressive person.', 'People feel Conor as an ambitious and aggressive person.', 'none', 1),
(84, 'Tiếng Anh', 'You can always count on me.', 'I\'ll never let you down.', ' I\'ll never take you down.', 'I\'ll never let you down.', 'I\'ll never hold you down.', 'I\'ll never make you down.', 'none', 1),
(85, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'campus', 'justice ', 'campus', 'culture', 'brush', 'none', 1),
(86, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'work', 'work', 'form', 'stork', 'force', 'none', 1),
(87, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'elephant', 'eleven', 'elephant', 'examine', 'exact', 'none', 1),
(88, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'assist', 'assure', 'pressure', 'possession', 'assist', 'none', 1),
(89, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'species', 'species', 'invent', 'medicine', 'tennis', 'none', 1),
(90, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'break', 'deal', 'teach', 'break', 'clean', 'none', 1),
(91, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'supported', 'supported', 'approached', 'noticed', 'finished', 'none', 1),
(92, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'campus     ', 'justice ', 'campus     ', 'culture', 'brush', 'none', 1),
(93, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'map', 'date', 'face', 'page', 'map', 'none', 1),
(94, 'Tiếng Anh', 'Choose the word that has a different phonetic', 'joined', 'dressed', 'dropped', 'matched', 'joined', 'none', 1),
(95, 'Tiếng Anh', 'Choose the word that has a different stress', 'tomato', 'workbook     ', 'tomato', 'mountain', 'lion', 'none', 1),
(96, 'Tiếng Anh', 'Choose the word that has a different stress', 'preparation', 'prescription', 'production', 'presumption', 'preparation', 'none', 1),
(97, 'Tiếng Anh', 'Choose the word that has a different stress', 'emergency', 'energy', 'emergency', 'constancy', 'sympathy', 'none', 1),
(98, 'Tiếng Anh', 'Choose the word that has a different stress', 'application', 'application', 'economy', 'photography', 'apology', 'none', 1),
(99, 'Tiếng Anh', 'Choose the word that has a different stress', 'humorous', 'incapable', 'unselfish', 'attraction', 'humorous', 'none', 1),
(100, 'Tiếng Anh', 'Choose the word that has a different stress', 'interesting', 'destination', 'productivity', 'interesting', 'economic', 'none', 1),
(101, 'Tiếng Anh', 'Choose the word that has a different stress', 'pollute', 'speechless', 'worthy', 'pollute', 'borrow', 'none', 1),
(102, 'Tiếng Anh', 'Choose the word that has a different stress', 'loyalty', 'loyalty', 'success', 'incapable', 'sincere', 'none', 1),
(103, 'Tiếng Anh', 'Choose the word that has a different stress', 'perform', 'govern', 'cover', 'perform', 'father', 'none', 1),
(104, 'Tiếng Anh', 'Choose the word that has a different stress', 'arrive', 'morning', 'college', 'arrive', 'famous', 'none', 1),
(105, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nI didn’t think his the comments were very appropriate at the time.', 'suitable', 'correct', 'right', 'exact', 'suitable', 'none', 2),
(106, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nGCSE are not compulsory, but they are the most common qualifications taken by students.', 'required', 'required', 'applied', 'fulfilled', 'specialized', 'none', 2),
(107, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\n received housing benefit when I was unemployed', 'out of work', 'out of order', 'out of fashion', 'out of work', 'out of practice', 'none', 2),
(108, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nThe related publications are far too numerous to list individually.', 'much', 'much', 'legion', 'few', 'full', 'none', 2),
(109, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nThe teacher gave some suggestions on what would come out for the examination.', 'hints', 'demonstrations', 'symptoms', 'effects', 'hints', 'none', 2),
(110, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nWhen being interviewed, you should concentrate on what the interviewer is saying or asking you.', 'pay attention to', 'relate on', 'be interested in  ', 'impress on ', 'pay attention to', 'none', 2),
(111, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nShe came to the meeting late on purpose so she would miss the introductory speech.', 'with a goal', 'aiming at', 'intentionally', 'reasonably', 'with a goal', 'none', 2),
(112, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nThe use of lasers in surgery has become relatively commonplace in recent years.', 'comparatively', 'comparatively', 'relevantly', 'absolutely', 'almost', 'none', 2),
(113, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nThe first few days at university can be very daunting, but with determination and positive attitude, freshmen will soon fit in with the new environment.', 'depressing', 'interseting', 'memorable', 'serious', 'depressing', 'none', 2),
(114, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nDid anyone acknowledge responsibility for the outbreak of the fire ?', 'accept', 'inquire about', 'accept', 'report', 'find out', 'none', 2),
(115, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nChildbearing is the women\'s most wonderful role.', 'Giving birth to a baby', 'Giving birth to a baby', 'Bring up a child', 'Educating a child', ' Having no child', 'none', 2),
(116, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nIn my experience, freshmen today are different from those I knew 25 years ago.', 'first-year students', 'first-year students', 'new students', 'new counselors', 'young professors', 'none', 2),
(117, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nS. Mayo Hospital in New Orleans was so named in recognition of Dr. Mayo’s outstanding humanitarianism.', 'remarkable', 'unpopular', 'widespread', 'remarkable', 'charitable', 'none', 2),
(118, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nMy parents’ warnings didn’t deter me from choosing the job of my dreams.', 'discourage', 'influence', 'discourage', 'reassure', 'inspire', 'none', 2),
(119, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\n“It’s no use talking to me about metaphysics. It’s a closed book to me.”', 'a subject that I don’t understand', 'a subject that I don’t understand', 'a theme that I like to discuss', 'a book that is never opened', 'an object that I really love', 'none', 2),
(120, 'Tiếng Anh', 'Find the symnonym of the underlined word:\r\nIf desired, garnish your plate with parsley, bell pepper rings or other vegetables', 'decorate', 'decorate', 'replace', 'associate', 'provide', 'none', 2),
(121, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nNutritionists believe that vitamins circumvent diseases.', 'help', 'defeat', 'nourish', 'help', 'treat', 'none', 2),
(122, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nAdverse weather conditions made it difficult to play the game.', 'Favourable', 'Favourable', 'Bad', 'Comfortable', 'Severe', 'none', 2),
(123, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nHe revealed his intentions of leaving the company to the manager during the office dinner party.', 'concealed', 'disclosed', 'concealed', 'misled', 'influenced', 'none', 2),
(124, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nMost of the guests at the dinner party chose to dress elegantly, but one man wore jeans and a T-shirt, he was later identified as a high school teacher.', 'unsophisticatedly ', 'unsophisticatedly ', 'decently', 'gaudily', 'gracefully', 'none', 2),
(125, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nThe minister came under fire for his rash decision to close the factory.', 'was acclaimed', 'was dismissed', 'was acclaimed', 'was criticized', 'was penalized', 'none', 2),
(126, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nThose who advocate for doctor-assisted suicide say the terminally ill should not have to suffer.', 'oppose', 'support', 'oppose', 'annul', 'convict', 'none', 2),
(127, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nGolf wear has become a very lucrative business for both the manufacturers and golf stars.', 'unprofitable', 'unprofitable', 'impoverished', 'inexpensive', 'unfavorable', 'none', 2),
(128, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nUnless you get your information from a credible website, you should doubt the veracity of the facts until you have confirmed them else where.', 'inexactness', 'inexactness', 'falsehoodness', 'unaccuracy', 'unfairness', 'none', 2),
(129, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nIf any employee knowingly breaks the terms of this contract, he will be dismissed immediately.', 'accidentally', 'coincidentally', 'deliberately', 'instinctively', 'accidentally', 'none', 2),
(130, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\n Because Jack defaulted on his loan, the bank took him to court.', 'paid in full', 'failed to pay ', 'paid in full', ' had a bad personality', 'was paid much money', 'none', 2),
(131, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nHis career in the illicit drug trade ended with the police raid this morning.', 'legal', 'elicited', 'irregular', 'secret', 'legal', 'none', 2),
(132, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nThe government is not prepared to tolerate this situation any longer.', 'look down on', 'look down on', 'put up with ', 'take away from', 'give on to', 'none', 2),
(133, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nThe US troops are using much more sophisticated weapons in the Far East.', 'simple and easy to use', 'expensive', 'complicated', 'simple and easy to use', 'difficult to operate', 'none', 2),
(134, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nIn remote communities, it\'s important to replenish stocks before the winter sets in.', 'empty', 'remake', 'empty', 'refill', 'repeat', 'none', 2),
(135, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nThere has been no discernible improvement in the noise levels since lorries were banned.', 'insignificant', 'clear', 'obvious', 'thin', 'insignificant', 'none', 2),
(136, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nHe was so insubordinate that he lost his job within a week.', 'obedient', 'fresh', 'disobedient', 'obedient', 'understanding', 'none', 2),
(137, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nUnless the two signatures are identical, the bank won’t honor the check.', 'different', 'similiar', 'different', 'fake', 'genuine', 'none', 2),
(138, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nHer father likes the head cabbage rare.', 'over-boiled', 'over-boiled', 'precious', 'scare', 'scarce', 'none', 2),
(139, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nMy cousin tends to look on the bright side in any circumstance.', 'be pessimistic', 'be pessimistic', 'be optimistic', 'be confident', 'be smart', 'none', 2),
(140, 'Tiếng Anh', 'Find the antonym of the underlined word:\r\nWe are now a 24/7 society where shops and services must be available all hours.', 'an inactive society', 'an active society', 'an inactive society', 'a physical society', 'a working society', 'none', 2),
(141, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nThere is a severe famine in Somalia, and thousands of people are dying from hunger.', 'from hunger', 'There is', 'thousands of people', 'are dying', 'from hunger', 'none', 3),
(142, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nIf you need to keep fit, then why not take on a sport such as badminton or tennis?', 'nan', 'to keep', 'why not take', 'on', 'a sport such as', 'none', 3),
(143, 'Tiếng Anh', 'Find the mistake in the sentence:\r\n He has made a lot of mistakes in his writing because his carelessness.', 'because', 'made', 'mistakes', 'in', 'because', 'none', 3),
(144, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nPeople are not allowed enter the park after midnight because of lack of security.', 'allowed enter', 'allowed enter', 'after', 'because of', 'of', 'none', 3),
(145, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nNeither his parents nor his teacher are satisfied with his result when he was at school.', 'are', 'neither', 'nor', 'are', 'with', 'none', 3),
(146, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nAlthough Nam worked very hard, but he didn’t pass the final exam.', 'Although', 'Although', 'hard', 'didn\'t', 'pass', 'none', 3),
(147, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nThe amount of women earning Master\'s Degrees has risen sharply in recent years.', 'The amount of', 'The amount of', 'Master\'s', 'has risen', 'recent years', 'none', 3),
(148, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nBecause blood from different individuals may different in the type of antigen on the surface of the red cells and the type of antibody in the plasma, a dangerous reaction can occur between the donor and recipient in a blood transfusion.', 'different', 'Because', 'different', 'can occur', 'and', 'none', 3),
(149, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nWhen mining for gold, you must first obtain the gold ore and then apart the gold from the ore.', 'must first', 'When mining', 'must first', 'and then', 'apart', 'none', 3),
(150, 'Tiếng Anh', 'Find the mistake in the sentence:\r\nThe Greek historian Herodotus reported that one hundred thousand men are employed for twenty years to build the Great Pyramid at Gizeh.', 'are', 'are', 'for', 'to build', 'at Gizeh', 'none', 3),
(151, 'Tiếng Anh', 'I’m afraid very few people know about the concert and almost no one will come. If only the posters ______ on time.', 'had been hung', 'were hanging', 'were hung', 'were hanged', 'had been hung', 'none', 3),
(152, 'Tiếng Anh', 'Jimmy sent his mother a _____ of flowers for her birthday.', 'bunch', 'bar', 'bunch', 'pack', 'packet', 'none', 3),
(153, 'Tiếng Anh', 'His jokes seemed to ______ a treat with his audience, if their laughter was any indication.', 'go down', 'go along ', 'go by', 'go off ', 'go down', 'none', 3),
(154, 'Tiếng Anh', 'It was such a sad film that we all were reduced_______ tears at the end.', 'to', 'with', 'onto', 'to', 'into', 'none', 3),
(155, 'Tiếng Anh', 'Those _______ boys often play tricks on their friends.', 'mischievous', 'mischievous', 'obedient', 'honest', 'well-behaved', 'none', 3),
(156, 'Tiếng Anh', 'Annie: \"Have a nice weekend\", - Riat “________”', 'You too', 'You have', 'You will', 'You too', 'You are too', 'none', 3),
(157, 'Tiếng Anh', 'As we wanted to be close to_______nature, we moved to the countryside.', 'Ø ', 'Ø ', 'a', 'an', 'the', 'none', 3),
(158, 'Tiếng Anh', 'Tom: \" Sorry, I forgot to phone you last night” . – Mary : “__________”', 'Never mind!', 'I have nothing to tell you.', 'Oh, poor me', 'Never mind!', 'You were absent-minded.', 'none', 3),
(159, 'Tiếng Anh', 'Is there ________ for everyone?', 'enough food and drink', 'food and drink enough', 'enough food and drink', 'enough of food and drink ', 'enough food and drink enough', 'none', 3),
(160, 'Tiếng Anh', 'The profit has now ________ towards the point where it nearly doubled.', 'advanced', 'arrived', 'approached', 'advanced', 'reached', 'none', 3),
(161, 'Tiếng Anh', 'In an ________ to diffuse the tension, I suggest that we go to see a movie.', 'attempt', 'attempt', 'improvement', 'determination', 'capability', 'none', 3),
(162, 'Tiếng Anh', 'I don’t think that everyone likes the way he makes fun, ______?', 'do they', 'don\'t I', 'do I', 'don\'t they', 'do they', 'none', 3),
(163, 'Tiếng Anh', 'I’ve never really enjoyed going to the ballet or the opera, they’re not really my ________.', 'cup of tea', 'piece of cake', 'sweets and candy', 'biscuit', 'cup of tea', 'none', 3),
(164, 'Tiếng Anh', 'The authorities _______ actions to stop illegal purchase of wild animals and their associated products effectively. However, they didn’t do so.', 'should have taken', 'must have taken', 'had to take', 'needed have taken', 'should have taken', 'none', 3),
(165, 'Tiếng Anh', '________ they arrived __________ they were told to go back.', 'Scarcely had/when', 'No sooner/when', 'Scarcely had/when', 'Scarcely/when', 'Hardly/when', 'none', 3),
(166, 'Tiếng Anh', 'The substance is very toxic. Protective clothing must be worn at all times.', 'So toxic is the substance that protective clothing must be worn at all times.', 'Since the substance is very toxic, so protective clothing must be worn at all times.', 'So toxic is the substance that protective clothing must be worn at all times.', 'The substance is such toxic that protective clothing must be worn at all times.', 'The substance is too toxic to wear protective clothing at all times.', 'none', 3),
(167, 'Tiếng Anh', '“You\'re always making terrible mistakes”, said the teacher.', 'The teacher complained about his students making terrible mistakes.', 'The teacher asked his students why they always made terrible mistakes.', 'The teacher realized that his students always made terrible mistakes.', 'The teacher complained about his students making terrible mistakes.', 'The teacher made his students not always make terrible mistakes.', 'none', 3),
(168, 'Tiếng Anh', 'He smokes too much, perhaps that’s why he can’t get rid of his cough.', 'If he smoked less, he might be able to get rid of his cough.', 'If he didn’t smoke so much, he may get rid of his cough.', 'If he smoked less, he might be able to get rid of his cough.', 'If he smoked so much, he couldn’t get rid of his cough.', 'If he does not smoke, he may not have his cough.', 'none', 3),
(169, 'Tiếng Anh', '“Why don’t you take extra classes in English if you want to become a tourist guide?” said my friend.', 'My friend suggested I take extra classes in English if I wanted to become a tourist guide.', 'My friend advised me to take extra classes in English only if I wanted to become a tourist guide.', 'My friend suggested I take extra classes in English if I wanted to become a tourist guide.', 'In my friend’s opinion, I will never become a tourist guide if I don’t take extra classes in English.', 'In my friend’s opinion, taking extra classes in English is necessary if I wanted to become a tourist guide.', 'none', 3),
(170, 'Tiếng Anh', 'They/ not answer/ phone/ this morning/ so/ must/ out/.', 'They didn’t answer the phone this morning so they must have gone out.', 'They hasn’t answered the phone this morning so they must have been out.', 'They didn’t answer the phone this morning so they must be out.', 'They didn’t answer the phone this morning so they must have gone out.', 'They hasn’t answered the phone this morning so they must go out.', 'none', 3),
(171, 'Tiếng Anh', 'Neil always forgets his wife’s birthday.', 'Neil never remembers his wife’s birthday.', 'At no time Neil remembers his wife’s birthday.', 'Neil never remembers his wife’s birthday.', 'Neil sometimes remembers his wife’s birthday.', 'Neil remembers his wife’s birthday all the time.', 'none', 3),
(172, 'Tiếng Anh', 'The boss was annoyed that his secretary came to work late.', 'The secretary came to work late, which annoyed the boss.', 'The secretary came to work late, which annoyed the boss.', 'The secretary came to work late causing annoyed.', 'That the secretary came to work late annoys the boss.', 'The boss disapproved of his secretary’s coming to work late.', 'none', 3),
(173, 'Tiếng Anh', 'The test was so difficult that we couldn’t finish it in two hours.', 'It was such a difficult test that we couldn’t finish it in two hours.', 'It was such a difficult test that we couldn’t finish it in two hours.', 'The test was too difficult for us to finish it in two hours.', 'The test was not difficult enough for us to finish in two hours.', 'The test was too difficult for us to finish it in two hour.', 'none', 3),
(174, 'Tiếng Anh', 'It is a basic requirement in the modern world to be able to deal with figures.', 'Being able to deal with figures is a basic requirement in the modern world.', 'The world requires us to have a basic understanding of figures.', 'Being able to deal with figures is a basic requirement in the modern world.', 'Dealing with the modern world requires a basic knowledge of figures.', 'Dealing with figures requires a basic knowledge of the modern world.', 'none', 3),
(175, 'Tiếng Anh', 'Although his legs were broken, he managed to get out of the car before it exploded.', 'Despite his broken legs, he managed to get out of the car before it exploded.', 'In spite of his broken legs be broken, he managed to get out of the car before it exploded.', 'In spite of his broken legs, he is able to get out of the car before exploding.', 'Despite his legs were broken, he managed to get out of the car before it exploded.', 'Despite his broken legs, he managed to get out of the car before it exploded.', 'none', 3),
(176, 'Tiếng Anh', 'I’m sorry I interrupted your speech in the middle.', 'I apologized for having interrupted your speech in the middle.', 'Your speech is very sorry for being interrupted in the middle.', 'I’m sorry to interrupt your speech in the middle.', 'It’s my pity to interrupt your speech in the middle.', 'I apologized for having interrupted your speech in the middle.', 'none', 3),
(177, 'Tiếng Anh', 'All applicants must ________ their university transcript and two reference letters to be considered for this job.', 'submit', 'permit', 'omit', 'submit', 'admit', 'none', 3),
(178, 'Tiếng Anh', 'It is said that a drizzle on the Phap Van – Cau Gie expressway caused poor ______ and a slippery road surface, leading to the vehicles, traveling at high speed, unable to respond safely.', 'visibility', 'vision', 'view', 'visibility', 'visionary', 'none', 3),
(179, 'Tiếng Anh', ' My cousin was nervous about being interviewed on television, but he ______ to the occasion wonderfully', 'rose', 'raised', 'rose', 'fell', 'faced', 'none', 3),
(180, 'Tiếng Anh', 'Daisy has spent the last two weekends _____ hundreds of photographs so that she can put them in separate albums. ', 'sorting out', 'playing at', 'sorting out', 'cutting off', 'filling up', 'none', 3),
(197, 'Toán Học', 'Cho hàm số: $$y = \\frac{ax + by + c}{cx + d}, \\quad ad - bc \\ne 0$$ có đồ thị như hình. Đường thẳng nào sau đây là tiệm cận đứng của đồ thị hàm số đã cho?', 'x = 1', 'x = 1', 'x = 2', 'y = 1', 'y = 2', '', 2),
(198, 'Toán Học', 'Cho cấp số nhân $(u_n)$ có $u_1 = 2$ và $u_2 = 8$. Công bội của cấp số nhân đã cho bằng', '4', '4', '-6', '1/2', '6', '', 2),
(199, 'Toán Học', 'Tập nghiệm của bất phương trình: $$\\log_{0.5}(x - 1) > -3$$ là', '(1; 9)', '(-∞; 9)', '(1; 9)', '(9; +∞)', '(91/8; ∞)', '', 3),
(200, 'Toán Học', 'Cho hình chóp $S.ABCD$ có đáy $ABCD$ là hình bình hành. Khi đó $\\vec{SA} + \\vec{BC}$ bằng', '$\\vec{SB}$', '$\\vec{SD}$', '$\\vec{SC}$', '$\\vec{SA}$', '$\\vec{SB}$', '', 3),
(201, 'Toán Học', 'Trong không gian $Oxyz$, cho mặt phẳng $(P): z = x + y - 1$. Một vectơ pháp tuyến của mặt phẳng $(P)$ là', '$(1; 1; -2)$', '$(1; 1; 2)$', '$(2; 2; -1)$', '$(1; 1; -2)$', '$(2; 2; 1)$', '', 3),
(202, 'Toán Học', 'Trong các phương trình sau, phương trình nào vô nghiệm?', '$\\log(x - 1) = 1$', '$5^x - 1 = 0$', '$\\log_2 x = 3$', '$3x + 2 = 0$', '$\\log(x - 1) = 1$', '', 1),
(203, 'Toán Học', 'Các bạn học sinh lớp 11A trả lời 40 câu hỏi. Nhóm có tần số lớn nhất là', '$[31; 36)$', '$[16; 21)$', '$[21; 26)$', '$[31; 36)$', '$[36; 41)$', '', 2),
(204, 'Toán Học', 'Cho hàm số $y = f(x)$ có bảng biến thiên như hình. Hàm số đồng biến trên khoảng nào?', '$(-3; 0)$', '$(-∞; -3)$', '$(-3; 3)$', '$(0; 3)$', '$(-3; 0)$', '', 2),
(205, 'Toán Học', 'Cho hình chóp $S.ABC$ có đáy là tam giác vuông cân tại $B$, $SA \\perp (ABC)$. Góc giữa hai mặt phẳng $(SBC)$ và $(ABC)$ là', '$\\angle ASB$', '$\\angle SBA$', '$\\angle ASC$', '$\\angle SCA$', '$\\angle ASB$', '', 3),
(206, 'Toán Học', 'Cho hàm số $y = f(x)$ có đạo hàm liên tục trên đoạn $[a; b]$, và $f(a) = 1, f(b) = -3$. Khi đó: $$\\int_a^b f\'(x) dx = ?$$', '$-4$', '$-3$', '$4$', '$-4$', '$-2$', '', 3),
(207, 'Toán Học', 'Trong không gian $Oxyz$, đường thẳng $d$ đi qua điểm $M(1; -1; 3)$ và song song với đường thẳng $\\dfrac{x - 1}{2} = \\dfrac{y + 1}{1} = \\dfrac{z + 1}{-3}$. Phương trình của đường thẳng $d$ là', 'x = 1 + t, y = -1 + t, z = 3 - t', 'x = 1 + t, y = -1 + t, z = t + 1', 'x = 1 + t, y = 1 + t, z = -t', 'x = 2 + t, y = -t, z = -t + 1', 'x = 1 + t, y = -1 + t, z = 3 - t', '', 2),
(208, 'Toán Học', 'Diện tích $S$ của hình phẳng giới hạn bởi đồ thị hàm số $y = f(x)$, trục $Ox$ và các đường thẳng $x = a$, $x = b$ với $a < b$ là', '$S = \\int_a^b f(x)\\,dx$', '$S = \\pi \\int_a^b f(x)\\,dx$', '$S = \\int_a^b f(x)\\,dx$', '$S = 2\\pi \\int_a^b f(x)\\,dx$', '$S = \\int_a^b f(x)\\,dx$', '', 2),
(209, 'Toán Học', 'Khoảng biến thiên của mẫu số liệu ghép nhóm với điểm từ 0 đến dưới 100 là', '100', '100', '38', '54 điểm', '1/8', '', 2),
(210, 'Toán Học', 'Trong không gian $Oxyz$, cho đường thẳng $d: \\dfrac{x - 1}{2} = \\dfrac{y + 1}{1} = \\dfrac{z + 1}{-3}$ và điểm $A(-2; -5; 6)$. Một véc-tơ chỉ phương của $d$ là', '(2; 1; -3)', '(2; 1; -3)', 'Phương trình mặt phẳng: $2x + y - 3z + 17 = 0$', 'H có tọa độ: $(-3; -1; -4)$', 'Mặt phẳng P: $4x + 2y + 7z + 4 = 0$', '', 3),
(211, 'Toán Học', 'Một phần đồ thị của hàm bậc ba có F là cực tiểu, I là cực đại, phương trình đạo hàm có dạng nào?', '$f\'(x) = a(x + 2)(x + 6)$ với $a \\in \\mathbb{R}$', 'Phương trình đường thẳng HB: $y = -4x + 48$', '$f\'(x) = a(x + 2)(x + 6)$ với $a \\in \\mathbb{R}$', 'Tiếp tuyến tại $x = 7$ song song với HB', 'Khoảng cách đến lối đi ngắn nhất: 2,56m', '', 3),
(212, 'Toán Học', 'Một xe ô tô đang chuyển động chậm dần đều với $v(t) = -t + 20$ m/s, dừng sau 20 giây. Xe có va chạm với chướng ngại vật cách 25m không?', 'Xe không va chạm', '$s(t)$ là nguyên hàm của $v(t)$', '$s(t) = -\\dfrac{t^2}{2} + 20t$', 'Xe dừng sau 20s', 'Xe không va chạm', '', 2),
(213, 'Toán Học', 'Cho hình chóp $S.ABCD$ có đáy là hình vuông cạnh $4\\sqrt{2}$ và các cạnh bên bằng $2\\sqrt{6}$. Khoảng cách giữa hai đường thẳng $AD$ và $SC$ là', '4', '4', '2', '$2\\sqrt{2}$', '4.5', '', 3);
INSERT INTO `questions` (`question_id`, `category_name`, `question_text`, `correct_answer`, `option_a`, `option_b`, `option_c`, `option_d`, `picture_link`, `difficulty`) VALUES
(214, 'Toán Học', 'Bạn Thuận có 6 bài hát khác nhau. Nghe 3 bài đầu rồi xáo trộn, sau đó nghe 3 bài tiếp. Xác suất nghe đủ 6 bài sau hai lần nghe là', '40%', '10%', '25%', '40%', '60%', '', 3),
(215, 'Toán Học', 'Cẩu trục chuyển vật liệu từ $A(6; 8; 0)$ đến $B(-4; 3; 15)$ theo ba giai đoạn. Quãng đường vật liệu di chuyển là', '50 m', '35 m', '40 m', '50 m', '55 m', '', 3),
(216, 'Toán Học', 'Một lều trại có dạng hình vuông cắt bởi hai parabol vuông góc, chiều cao đỉnh là 2m. Cạnh đáy $2\\sqrt{2}$ m. Thể tích của lều là', '16 m³', '12 m³', '16 m³', '18 m³', '20 m³', '', 2),
(217, 'Toán Học', 'Hàm số nào dưới đây đồng biến trên khoảng $(-\\infty; +\\infty)$?', '$y = x^3$', '$y = x^3 - 3x$', '$y = x^3$', '$y = -x^3$', '$y = x^4 - 2x^2$', '', 2),
(218, 'Toán Học', 'Cho hàm số $y = f(x)$ có bảng biến thiên như hình. Hàm số có bao nhiêu điểm cực trị?', '2', '0', '1', '2', '3', '', 2),
(219, 'Toán Học', 'Tìm giới hạn: $\\lim\\limits_{x \\to 2} \\dfrac{x^2 - 4}{x - 2}$', '4', '$+\\infty$', '$-\\infty$', '0', '4', '', 2),
(220, 'Toán Học', 'Giải phương trình: $\\log_2 (x^2 - 5x + 6) = 1$', '$x = 2$ hoặc $x = 3$', '$x = 2$', '$x = 3$', '$x = 2$ hoặc $x = 3$', 'Không có nghiệm', '', 3),
(221, 'Toán Học', 'Tập xác định của hàm số $y = \\sqrt{2x - 1}$ là', '$[\\dfrac{1}{2}; +\\infty)$', '$(1; +\\infty)$', '$[\\dfrac{1}{2}; +\\infty)$', '$(-\\infty; \\dfrac{1}{2})$', '$\\mathbb{R}$', '', 2),
(222, 'Toán Học', 'Thể tích hình cầu có bán kính $R$ là', '$\\dfrac{4}{3}\\pi R^3$', '$\\dfrac{4}{3}\\pi R^3$', '$4\\pi R^2$', '$2\\pi R$', '$\\pi R^2$', '', 1),
(223, 'Toán Học', 'Cho hình chóp $S.ABC$ có đáy là tam giác đều cạnh $a$, cạnh bên $SA$ vuông góc với đáy và $SA = a$. Tính thể tích khối chóp $S.ABC$.', '$\\dfrac{a^3\\sqrt{3}}{6}$', '$\\dfrac{a^3\\sqrt{3}}{6}$', '$\\dfrac{a^3\\sqrt{3}}{2}$', '$\\dfrac{a^3\\sqrt{3}}{3}$', '$\\dfrac{a^3\\sqrt{3}}{12}$', '', 3),
(224, 'Toán Học', 'Trong không gian $Oxyz$, phương trình nào dưới đây là phương trình mặt cầu?', '$(x - 1)^2 + (y + 2)^2 + (z - 3)^2 = 4$', '$(x - 1)^2 + (y + 2)^2 + (z - 3)^2 = 4$', '$x^2 + y^2 = 9$', '$x^2 + y^2 + z = 1$', '$x + y + z = 0$', '', 2),
(225, 'Toán Học', 'Giá trị lớn nhất của hàm số $y = -x^2 + 2x + 3$ trên đoạn $[0;3]$ là', '5', '4', '3', '5', '6', '', 2),
(226, 'Toán Học', 'Tập nghiệm của bất phương trình $\\log_2 (x - 1) > 3$ là', '$(9; +\\infty)$', '$(1; 8)$', '$(1; +\\infty)$', '$(0; 1)$', '$(8; +\\infty)$', '', 2),
(227, 'Toán Học', 'Hàm số $y = ax^3 + bx^2 + cx + d$ có đồ thị như hình. Hệ số $a$ có giá trị nào dưới đây?', 'a < 0', 'a > 0', 'a < 0', 'a = 0', 'Không xác định', '', 2),
(228, 'Toán Học', 'Giá trị nhỏ nhất của hàm số $y = x^2 - 4x + 7$ là', '3', '4', '3', '2', '7', '', 2),
(229, 'Toán Học', 'Tính đạo hàm của hàm số $y = \\sqrt{x}$ tại $x = 4$', '$\\dfrac{1}{4}$', '$\\dfrac{1}{2}$', '$\\dfrac{1}{4}$', '$2$', '$4$', '', 2),
(230, 'Toán Học', 'Cho hàm số $y = \\dfrac{1}{x}$ có đồ thị là đường hyperbol. Khẳng định nào sau đây đúng?', 'Hàm nghịch biến trên mỗi khoảng xác định', 'Hàm đồng biến', 'Hàm nghịch biến trên mỗi khoảng xác định', 'Không xác định', 'Hàm không có đạo hàm', '', 2),
(231, 'Toán Học', 'Giải bất phương trình: $2^x > 8$', 'x > 3', 'x < 3', 'x > 3', 'x = 3', 'x < 0', '', 2),
(232, 'Toán Học', 'Hàm số $y = \\log_2(x + 1)$ có tập xác định là', '$(-1; +\\infty)$', '$(-\\infty; 0)$', '$(-1; +\\infty)$', '$(0; +\\infty)$', '$\\mathbb{R}$', '', 2),
(233, 'Toán Học', 'Giá trị của biểu thức $\\log_3 81$ là', '4', '3', '4', '5', '2', '', 2),
(234, 'Toán Học', 'Cho hàm số $y = x^2 - 2x - 3$. Tìm tọa độ đỉnh của parabol.', '(1; -4)', '(-1; 4)', '(1; -4)', '(2; 1)', '(0; -3)', '', 2),
(235, 'Toán Học', 'Một hình tròn có chu vi bằng $2\\pi R$. Tính diện tích hình tròn đó.', '$\\pi R^2$', '$2\\pi R$', '$\\pi R^2$', '$4\\pi R^2$', '$\\pi R$', '', 2),
(236, 'Toán Học', 'Tìm nguyên hàm của hàm số $f(x) = 2x$', '$x^2 + C$', '$2x + C$', '$x^2 + C$', '$x + C$', '$4x + C$', '', 2),
(237, 'Toán Học', 'Số nghiệm của phương trình $\\sin x = \\dfrac{1}{2}$ trên đoạn $[0; 2\\pi]$ là', '2', '1', '2', '0', '4', '', 2),
(238, 'Toán Học', 'Hàm số $y = ax^3 + bx^2 + cx + d$ có đồ thị như hình. Hệ số $a$ có giá trị nào dưới đây?', 'a < 0', 'a > 0', 'a < 0', 'a = 0', 'Không xác định', '', 2),
(239, 'Toán Học', 'Giá trị nhỏ nhất của hàm số $y = x^2 - 4x + 7$ là', '3', '4', '3', '2', '7', '', 2),
(240, 'Toán Học', 'Tính đạo hàm của hàm số $y = \\sqrt{x}$ tại $x = 4$', '$\\dfrac{1}{4}$', '$\\dfrac{1}{2}$', '$\\dfrac{1}{4}$', '$2$', '$4$', '', 2),
(241, 'Toán Học', 'Cho hàm số $y = \\dfrac{1}{x}$ có đồ thị là đường hyperbol. Khẳng định nào sau đây đúng?', 'Hàm nghịch biến trên mỗi khoảng xác định', 'Hàm đồng biến', 'Hàm nghịch biến trên mỗi khoảng xác định', 'Không xác định', 'Hàm không có đạo hàm', '', 2),
(242, 'Toán Học', 'Giải bất phương trình: $2^x > 8$', 'x > 3', 'x < 3', 'x > 3', 'x = 3', 'x < 0', '', 2),
(243, 'Toán Học', 'Hàm số $y = \\log_2(x + 1)$ có tập xác định là', '$(-1; +\\infty)$', '$(-\\infty; 0)$', '$(-1; +\\infty)$', '$(0; +\\infty)$', '$\\mathbb{R}$', '', 2),
(244, 'Toán Học', 'Giá trị của biểu thức $\\log_3 81$ là', '4', '3', '4', '5', '2', '', 2),
(245, 'Toán Học', 'Cho hàm số $y = x^2 - 2x - 3$. Tìm tọa độ đỉnh của parabol.', '(1; -4)', '(-1; 4)', '(1; -4)', '(2; 1)', '(0; -3)', '', 2),
(246, 'Toán Học', 'Một hình tròn có chu vi bằng $2\\pi R$. Tính diện tích hình tròn đó.', '$\\pi R^2$', '$2\\pi R$', '$\\pi R^2$', '$4\\pi R^2$', '$\\pi R$', '', 2),
(247, 'Toán Học', 'Tìm nguyên hàm của hàm số $f(x) = 2x$', '$x^2 + C$', '$2x + C$', '$x^2 + C$', '$x + C$', '$4x + C$', '', 2),
(248, 'Toán Học', 'Số nghiệm của phương trình $\\sin x = \\dfrac{1}{2}$ trên đoạn $[0; 2\\pi]$ là', '2', '1', '2', '8', '3', '', 2),
(251, 'History', 'aaa', 'f', 'a', 'e', 'd', 'f', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT current_timestamp(),
  `end_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `user_id`, `test_id`, `score`, `start_time`, `end_time`, `duration`) VALUES
(15, 13, 16, 0, '2025-04-10 21:47:02', NULL, NULL),
(16, 13, 15, 0, '2025-04-10 21:54:54', NULL, NULL),
(21, 13, 17, 0, '2025-04-12 15:51:07', '2025-04-12 15:51:18', 11),
(22, 15, 16, 3, '2025-04-13 08:54:34', '2025-04-13 08:55:06', 32),
(23, 15, 17, 0, '2025-04-13 09:53:42', '2025-04-13 10:07:13', 811),
(24, 15, 15, 0, '2025-04-13 10:17:03', '2025-04-13 11:52:10', 5707),
(26, 15, 22, 0, '2025-04-14 09:41:48', '2025-04-14 09:53:01', 673),
(27, 15, 25, 0, '2025-04-14 10:13:02', '2025-04-14 10:13:10', 8),
(28, 15, 24, 0, '2025-04-14 10:19:35', '2025-04-14 10:44:18', 1483),
(29, 15, 20, 0, '2025-04-14 10:43:44', '2025-04-14 10:43:54', 10);

-- --------------------------------------------------------

--
-- Table structure for table `result_test_questions`
--

CREATE TABLE `result_test_questions` (
  `res_test_quest_id` int(11) NOT NULL,
  `result_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result_test_questions`
--

INSERT INTO `result_test_questions` (`res_test_quest_id`, `result_id`, `question_id`, `answer`, `correct_answer`) VALUES
(11, 15, 80, '', ''),
(12, 15, 76, '', ''),
(13, 15, 71, '', ''),
(14, 16, 180, '', ''),
(15, 16, 179, '', ''),
(16, 16, 178, '', ''),
(33, 21, 79, '300 W', ''),
(34, 21, 80, '', ''),
(35, 21, 77, '', ''),
(36, 21, 76, '', ''),
(37, 21, 75, '', ''),
(38, 21, 74, '', ''),
(39, 21, 73, '', ''),
(40, 21, 71, '', ''),
(41, 22, 80, '5.6 Ω', ''),
(42, 22, 76, '400 V', ''),
(43, 22, 71, '36 cm/s', ''),
(44, 23, 79, '', ''),
(45, 23, 80, '', ''),
(46, 23, 77, '', ''),
(47, 23, 76, '', ''),
(48, 23, 75, '', ''),
(49, 23, 74, '', ''),
(50, 23, 73, '', ''),
(51, 23, 71, '', ''),
(52, 24, 180, '', ''),
(53, 24, 179, '', ''),
(54, 24, 178, 'visionary', ''),
(56, 26, 251, 'd', ''),
(57, 26, 251, 'd', ''),
(58, 26, 251, 'd', ''),
(59, 27, 251, 'd', ''),
(60, 24, 161, '', ''),
(61, 24, 162, '', ''),
(62, 24, 163, '', ''),
(63, 24, 164, '', ''),
(64, 24, 165, '', ''),
(65, 24, 166, '', ''),
(66, 24, 167, '', ''),
(67, 24, 168, '', ''),
(68, 24, 169, '', ''),
(69, 24, 170, '', ''),
(70, 29, 32, '', ''),
(71, 29, 31, '', ''),
(72, 29, 35, '', ''),
(73, 28, 161, '', ''),
(74, 28, 162, '', ''),
(75, 28, 163, '', ''),
(76, 28, 164, '', ''),
(77, 28, 165, '', ''),
(78, 28, 166, '', ''),
(79, 28, 167, '', ''),
(80, 28, 168, '', ''),
(81, 28, 169, '', ''),
(82, 28, 170, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `test_category` varchar(100) NOT NULL,
  `test_time` time NOT NULL,
  `created_by` int(11) NOT NULL,
  `count` int(11) DEFAULT 0,
  `time_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`, `test_category`, `test_time`, `created_by`, `count`, `time_create`) VALUES
(15, 'test11', 'Tiếng Anh', '01:30:00', 11, 3, '2025-04-13 15:12:07'),
(16, 'test112', 'Vật Lý', '00:03:00', 11, 3, '2025-04-13 15:12:07'),
(17, 'test112', 'Vật Lý', '00:10:11', 11, 8, '2025-04-13 15:12:07'),
(20, 'test2', 'Vật Lý', '03:04:44', 17, 3, '2025-04-13 15:14:17'),
(22, 'mytest', 'History', '01:02:03', 17, 1, '2025-04-14 02:41:15'),
(23, 'his1', 'History', '00:04:00', 17, 1, '2025-04-14 02:57:26'),
(24, 'eng2', 'Tiếng Anh', '00:08:00', 17, 10, '2025-04-14 03:00:26'),
(25, 'his2', 'History', '00:01:01', 17, 1, '2025-04-14 03:08:16'),
(26, 'his3', 'History', '00:01:01', 17, 1, '2025-04-14 03:45:03'),
(27, 'eng4', 'Tiếng Anh', '05:06:06', 17, 7, '2025-04-14 03:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE `test_questions` (
  `test_quest_id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`test_quest_id`, `test_id`, `question_id`) VALUES
(6, 15, 180),
(7, 15, 179),
(8, 15, 178),
(9, 16, 80),
(10, 16, 76),
(11, 16, 71),
(12, 17, 79),
(13, 17, 80),
(14, 17, 77),
(15, 17, 76),
(16, 17, 75),
(17, 17, 74),
(18, 17, 73),
(19, 17, 71),
(26, 20, 32),
(27, 20, 31),
(28, 20, 35),
(30, 22, 251),
(31, 23, 251),
(32, 24, 161),
(33, 24, 162),
(34, 24, 163),
(35, 24, 164),
(36, 24, 165),
(37, 24, 166),
(38, 24, 167),
(39, 24, 168),
(40, 24, 169),
(41, 24, 170),
(42, 25, 251),
(43, 26, 251),
(44, 27, 180),
(45, 27, 170),
(46, 27, 163),
(47, 27, 161),
(48, 27, 101),
(49, 27, 102),
(50, 27, 103);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `email`, `role_user`) VALUES
(11, 'admin', '$2y$10$PJMR.3bwGIotMawIN9KNeuaFU6fDmQ9UshhtCBsfnDuqxzQVLnwpy', 'admin@gmail.com', 'admin'),
(12, 'user', '$2y$10$i666FsOX7fjNPZjkbsUbjuwBk0T4zC80ipxd5./HAfSFXW9NCFydO', 'user@gmail.com', 'user'),
(13, 'user123', '$2y$10$pUvJAJv68JedoQstLcl7fO625Yg6eoifzbDYPeBz9sHn.HCqAlH5.', 'user123@gmail.com', 'user'),
(14, 'admin1', '$2y$10$8LFxbsYI5aUCtCo9PV9F7.AH7gmY0vj409iui2JA1ssmzht8Hfmly', 'admin123@gmail.com', 'user'),
(15, 'an', '$2y$10$hMB/a.DaI9hW2nF0vzczqe3SvjWYtcjqTtjiSssvhcqSyP.5UJP/C', 'an.daothiha@hcmut.edu.vn', 'user'),
(17, 'ad', '$2y$10$JSO8uqsM5YH39i1jHqXKleZROPNhpeomHJg.YV0McDPyol5jS5k9S', 'daothihaan@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_category_name` (`category_name`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `result_test_questions`
--
ALTER TABLE `result_test_questions`
  ADD PRIMARY KEY (`res_test_quest_id`),
  ADD KEY `result_id` (`result_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `test_category` (`test_category`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`test_quest_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `result_test_questions`
--
ALTER TABLE `result_test_questions`
  MODIFY `res_test_quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `test_quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_category_name` FOREIGN KEY (`category_name`) REFERENCES `categories` (`category_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE;

--
-- Constraints for table `result_test_questions`
--
ALTER TABLE `result_test_questions`
  ADD CONSTRAINT `result_test_questions_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `results` (`result_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `result_test_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`test_category`) REFERENCES `categories` (`category_name`) ON DELETE CASCADE;

--
-- Constraints for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
