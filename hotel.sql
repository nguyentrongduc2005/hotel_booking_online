-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 05:46 PM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenity`
--

CREATE TABLE `amenity` (
  `amenity_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenity`
--

INSERT INTO `amenity` (`amenity_id`, `name`, `description`, `created_at`) VALUES
(1, 'High-Speed Wi-Fi', 'Free high-speed wireless Internet connection', '2025-06-08 10:00:00'),
(2, 'Flat-Screen TV', 'Flat-screen TV with international cable channels', '2025-06-08 10:00:00'),
(3, 'Air Conditioner', 'Individual air conditioning for each room', '2025-06-08 10:00:00'),
(4, 'Compact Work Desk', 'Work desk designed for business travelers', '2025-06-08 10:00:00'),
(5, 'Minibar', 'Mini fridge stocked with drinks and snacks', '2025-06-08 10:00:00'),
(6, 'Personal Safe', 'Secure safe for storing personal valuables', '2025-06-08 10:00:00'),
(7, 'Hair Dryer', 'Convenient in-room hair dryer', '2025-06-08 10:00:00'),
(8, 'Relaxing Bathtub', 'Luxurious bathtub for ultimate relaxation', '2025-06-08 10:00:00'),
(9, 'Private Living Room', 'Separate living area with elegant sofa', '2025-06-08 10:00:00'),
(10, 'Personal Coffee Machine', 'Espresso or capsule coffee maker', '2025-06-08 10:00:00'),
(11, 'Dining Table', 'Convenient dining table for family meals', '2025-06-08 10:00:00'),
(12, 'Microwave', 'Compact microwave for heating food', '2025-06-08 10:00:00'),
(13, 'Reading Lamp', 'Separate reading lamp for guests\' convenience', '2025-06-08 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `transaction_id` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `status_checkin` enum('pending','done') DEFAULT 'pending',
  `status_checkout` enum('pending','done') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `user_id`, `guest_id`, `check_in`, `check_out`, `status`, `created_at`, `transaction_id`, `id_room`, `status_checkin`, `status_checkout`) VALUES
(0, 1, NULL, '2025-06-05 00:00:00', '2025-06-07 00:00:00', 'confirmed', '2025-06-03 00:00:00', 1, 1, 'pending', 'pending'),
(17, 2, NULL, '2025-06-24 04:00:09', '2025-06-24 00:00:00', 'confirmed', '2025-06-24 00:00:00', 2, 2, 'done', 'done'),
(18, NULL, 4, '2025-06-24 05:15:12', '2025-06-24 00:00:00', 'confirmed', '2025-06-24 00:00:00', 3, 3, 'done', 'done'),
(19, NULL, 1, '2025-06-24 00:00:00', '2025-06-23 00:00:00', 'pending', '2025-06-23 00:00:00', 4, 4, 'pending', 'pending'),
(20, NULL, 5, '2025-06-09 00:00:00', '2025-06-11 00:00:00', 'pending', '2025-06-23 14:45:00', 5, 5, 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `cccd` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sdt` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `full_name`, `cccd`, `email`, `sdt`, `created_at`) VALUES
(1, 'Trần Lê Duy Minh', '086205001451', 'minhtld1451@ut.edu.vn', '0393336649', '2025-06-01 10:30:00'),
(2, 'Nguyễn Quang Linh', '086205001452', 'linh2712nha@gmail.com', '0971815720', '2025-06-03 14:00:00'),
(3, 'Nguyễn Trọng Đức', '086205001453', 'nguyentrongduc447@gmail.com', '0866225534', '2025-06-05 09:45:00'),
(4, 'Huỳnh Đại Hà', '086205001454', 'huynhdaihafc@gmail.com', '0903348270', '2025-06-06 11:20:00'),
(5, 'Lê Trường Thịnh', '086205001455', 'thinhlt1681@ut.edu.vn', '0365574437', '2025-06-07 08:15:00'),
(6, 'Phạm Thị Ánh', '086205001456', 'phamthianh@gmail.com', '0911223344', '2025-06-08 10:10:00'),
(7, 'Trần Văn Khải', '086205001457', 'tranvankhai@yahoo.com', '0909988776', '2025-06-09 09:40:00'),
(8, 'Nguyễn Thị Bích', '086205001458', 'nguyenthibich@outlook.com', '0967112334', '2025-06-10 13:25:00'),
(9, 'Lê Quang Huy', '086205001459', 'lequanghuy@gmail.com', '0356227711', '2025-06-11 14:50:00'),
(10, 'Bùi Diệu Linh', '086205001460', 'buidieulinh@gmail.com', '0388456789', '2025-06-12 08:30:00'),
(11, 'Đặng Ngọc Minh', '086205001461', 'dangngocminh@ut.edu.vn', '0911888222', '2025-06-13 11:00:00'),
(12, 'Võ Trần Hoàng Long', '086205001462', 'votranhoanglong@gmail.com', '0378992211', '2025-06-14 16:20:00'),
(13, 'Hoàng Phương Anh', '086205001463', 'hoangphuonganh@gmail.com', '0932445566', '2025-06-15 10:45:00'),
(14, 'Ngô Kiến Phát', '086205001464', 'ngokienphat@gmail.com', '0855223344', '2025-06-16 09:15:00'),
(15, 'Trần Hoàng My', '086205001465', 'tranhoangmy@ut.edu.vn', '0922113344', '2025-06-17 14:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `historybooking`
--

CREATE TABLE `historybooking` (
  `id_history` int(11) NOT NULL,
  `id_room` int(11) DEFAULT NULL,
  `transaction_id` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historybooking`
--

INSERT INTO `historybooking` (`id_history`, `id_room`, `transaction_id`, `check_in`, `check_out`, `status`, `created_at`, `user_id`, `guest_id`) VALUES
(2, 1, 1, '2025-06-10 14:00:00', '2025-06-12 12:00:00', 'confirmed', '2025-06-08 18:29:36', 1, NULL),
(3, 2, 2, '2025-06-11 15:00:00', '2025-06-13 12:00:00', 'pending', '2025-06-08 18:29:36', NULL, 2),
(4, 3, 3, '2025-06-12 14:00:00', '2025-06-14 12:00:00', '', '2025-06-08 18:29:36', 3, NULL),
(5, 4, 4, '2025-06-13 15:00:00', '2025-06-15 12:00:00', 'cancelled', '2025-06-08 18:29:36', NULL, 4),
(6, 5, 5, '2025-06-14 14:00:00', '2025-06-16 12:00:00', 'confirmed', '2025-06-08 18:29:36', 5, NULL),
(7, 2, 6, '2025-06-15 13:00:00', '2025-06-17 11:00:00', 'completed', '2025-06-08 18:30:00', 2, NULL),
(8, 3, 7, '2025-06-16 14:00:00', '2025-06-18 12:00:00', 'confirmed', '2025-06-08 18:30:00', NULL, 5),
(9, 4, 8, '2025-06-17 15:00:00', '2025-06-19 12:00:00', 'pending', '2025-06-08 18:30:00', 6, NULL),
(10, 5, 9, '2025-06-18 14:00:00', '2025-06-20 12:00:00', 'cancelled', '2025-06-08 18:30:00', NULL, 6),
(11, 1, 10, '2025-06-19 13:00:00', '2025-06-21 11:00:00', 'confirmed', '2025-06-08 18:30:00', 7, NULL),
(12, 2, 11, '2025-06-20 14:00:00', '2025-06-22 12:00:00', 'completed', '2025-06-08 18:30:00', NULL, 7),
(13, 3, 12, '2025-06-21 15:00:00', '2025-06-23 12:00:00', 'pending', '2025-06-08 18:30:00', 8, NULL),
(14, 4, 13, '2025-06-22 14:00:00', '2025-06-24 12:00:00', 'confirmed', '2025-06-08 18:30:00', NULL, 8),
(15, 5, 14, '2025-06-23 13:00:00', '2025-06-25 11:00:00', 'cancelled', '2025-06-08 18:30:00', 9, NULL),
(16, 1, 15, '2025-06-24 14:00:00', '2025-06-26 12:00:00', 'completed', '2025-06-08 18:30:00', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `image_room`
--

CREATE TABLE `image_room` (
  `id_image` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_room`
--

INSERT INTO `image_room` (`id_image`, `path`, `id_room`) VALUES
(1, '/img/room/a(1).jpg', 1),
(2, '/img/room/a(2).jpg', 1),
(3, '/img/room/a(3).jpg', 1),
(4, '/img/room/a(4).jpg', 1),
(5, '/img/room/a(5).jpg', 1),
(6, '/img/room/a(6).jpg', 1),
(7, '/img/room/a(7).jpg', 1),
(8, '/img/room/a(8).jpg', 1),
(9, '/img/room/a(9).jpg', 1),
(10, '/img/room/a(10).jpg', 1),
(11, '/img/room/b(1).jpg', 2),
(12, '/img/room/b(2).jpg', 2),
(13, '/img/room/b(3).jpg', 2),
(14, '/img/room/b(4).jpg', 2),
(15, '/img/room/b(5).jpg', 2),
(16, '/img/room/b(6).jpg', 2),
(17, '/img/room/b(7).jpg', 2),
(18, '/img/room/c(1).jpg', 3),
(19, '/img/room/c(2).jpg', 3),
(20, '/img/room/c(3).jpg', 3),
(21, '/img/room/c(4).jpg', 3),
(22, '/img/room/c(5).jpg', 3),
(23, '/img/room/c(6).jpg', 3),
(24, '/img/room/c(7).jpg', 3),
(25, '/img/room/c(8).jpg', 3),
(26, '/img/room/c(9).jpg', 3),
(27, '/img/room/d(1).jpg', 4),
(28, '/img/room/d(2).jpg', 4),
(29, '/img/room/d(3).jpg', 4),
(30, '/img/room/d(4).jpg', 4),
(31, '/img/room/d(5).jpg', 4),
(32, '/img/room/d(6).jpg', 4),
(33, '/img/room/d(7).jpg', 4),
(34, '/img/room/d(8).jpg', 4),
(35, '/img/room/e(1).jpg', 5),
(36, '/img/room/e(2).jpg', 5),
(37, '/img/room/e(3).jpg', 5),
(38, '/img/room/e(4).jpg', 5),
(39, '/img/room/e(5).jpg', 5),
(40, '/img/room/e(6).jpg', 5),
(41, '/img/room/e(7).jpg', 5),
(42, '/img/room/e(8).jpg', 5),
(43, '/img/room/e(9).jpg', 5),
(44, '/img/room/e(10).jpg', 5),
(45, '/img/room/e(11).jpg', 5),
(46, '/img/room/f(1).jpg', 6),
(47, '/img/room/f(2).jpg', 6),
(48, '/img/room/f(3).jpg', 6),
(49, '/img/room/f(4).jpg', 6),
(50, '/img/room/f(5).jpg', 6),
(51, '/img/f(6).jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `amount_bed` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','maintenance') DEFAULT 'available',
  `created_at` datetime DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `area` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `id_room_type` int(11) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `capacity`, `amount_bed`, `price`, `status`, `created_at`, `description`, `slug`, `area`, `name`, `id_room_type`, `thumb`) VALUES
(1, 2, 1, 28.00, 'available', '2025-06-08 17:21:49', 'A minimalist, modern, and economical room. Fully equipped with Wi-Fi, cable TV, air conditioning, work desk, wardrobe, private bathroom with shower and toiletries. Glossy floor, neutral tones, double-layer curtains for comfort and hygiene.', 'standard-room', 22, 'Standard Room', 1, '/img/room/a(1).jpg'),
(2, 3, 1, 30.00, 'available', '2025-06-08 17:21:49', 'An upgrade from Standard with minibar, Smart TV, safe, large work desk, full-length mirror, daily housekeeping. Modern wooden interior, warm tones. Ideal for long business stays or leisure.', 'superior-room', 27, 'Superior Room', 2, '/img/room/b(1).jpg'),
(3, 3, 1, 48.00, 'maintenance', '2025-06-08 17:21:49', 'Luxurious space with high-end furniture: natural wood, velvet, bathtub, minibar, electronic safe, hairdryer, and quiet air conditioning. Good natural light and views. Suitable for business or leisure travelers.', 'deluxe-room', 32, 'Deluxe Room', 3, '/img/room/c(1).jpg'),
(4, 4, 2, 100.00, 'available', '2025-06-08 17:21:49', 'A high-end mini-apartment style suite: separate living room, coffee machine, premium sofa, work desk. Natural wood interior, granite, blackout curtains. Large bathtub and luxurious robes. For families, special occasions, or VIPs.', 'suite-room', 50, 'Suite Room', 4, '/img/room/d(1).jpg'),
(5, 4, 2, 72.00, 'available', '2025-06-08 17:21:49', 'Common living space, dining area, microwave, fridge—ideal for families. Large tub for children, full family amenities like Wi-Fi, cable TV. Child-friendly and safe design.', 'family-room', 42, 'Family Room', 5, '/img/room/e(1).jpg'),
(6, 1, 1, 26.00, 'available', '2025-06-08 17:21:49', 'A neat room for solo travelers or short business stays. Includes work desk, Wi-Fi, air conditioning, TV, private bathroom. Prioritizes privacy and space-saving convenience.', 'single-room', 17, 'Single Room', 6, '/img/room/f(1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_amenity`
--

CREATE TABLE `room_amenity` (
  `id_room` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_amenity`
--

INSERT INTO `room_amenity` (`id_room`, `amenity_id`, `created_at`) VALUES
(1, 1, '2025-06-08 18:03:26'),
(1, 2, '2025-06-08 18:03:26'),
(2, 5, '2025-06-08 18:03:26'),
(2, 6, '2025-06-08 18:03:26'),
(3, 7, '2025-06-08 18:03:26'),
(3, 8, '2025-06-08 18:03:26'),
(4, 9, '2025-06-08 18:03:26'),
(4, 10, '2025-06-08 18:03:26'),
(5, 11, '2025-06-08 18:03:26'),
(5, 12, '2025-06-08 18:03:26'),
(6, 13, '2025-06-08 18:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id_type_room` int(11) NOT NULL,
  `name_type_room` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id_type_room`, `name_type_room`, `description`) VALUES
(1, 'Standard Room', 'Standard Room with area of 20–25 m², suitable for 2 adults. Equipped with basic amenities such as free Wi-Fi, flat-screen TV, air conditioning, private bathroom with shower and toiletries. Ideal for short stays or business trips.'),
(2, 'Superior Room', 'Superior Room of 25–30 m², accommodates 2 adults + 1 child. Modern design with minibar, mini fridge, safe, large work desk, bathroom with shower or bathtub, daily housekeeping. Suitable for guests seeking enhanced comfort.'),
(3, 'Deluxe Room', 'Deluxe Room with an area of 30–35 m², fits 2 adults + 1 child. Features a relaxing bathtub, diverse minibar, safe, hairdryer, modern air conditioner. Luxurious space ideal for upscale leisure experiences.'),
(4, 'Suite Room', 'Suite Room from 40–60 m², accommodates 2 adults + 2 children. Includes a private living room with sofa, coffee machine, large bathtub, safe, minibar. Offers high-end comfort, perfect for small families or business guests.'),
(5, 'Family Room', 'Family Room of 35–50 m², suitable for 3–4 people. Cozy design with dining area, microwave, fridge, bathtub. Ideal for families on vacation with kids, fully equipped like a home.'),
(6, 'Single Room\r\n', 'Single Room with area of 15–20 m², for 1 person. Compact and efficient, includes work desk, air conditioning, high-speed Wi-Fi. Best for solo travelers or business stays, offering privacy and convenience.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id_service` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `Path_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id_service`, `name`, `slug`, `description`, `created_at`, `Path_img`) VALUES
(1, 'Spa Service', 'spa-service', 'Relaxing spa treatments with professional massage therapy, facial and body care.', '2025-06-08 09:00:00', '/img/service/SpaService.jpg'),
(2, 'Dining Service', 'dining-service', 'Buffet restaurant offering a variety of Asian and European dishes, available 24/7.', '2025-06-08 09:00:00', '/img/service/DiningService.jpg'),
(3, 'Room Service', 'room-service', 'In-room food and beverage delivery.', '2025-06-08 09:00:00', '/img/service/RoomService.jpg'),
(4, 'Laundry Service', 'laundry-service', 'Fast and high-quality laundry service, available same day.', '2025-06-08 09:00:00', '/img/service/LaundryService.jpg'),
(5, 'Airport Transfer', 'airport-transfer', 'Convenient airport pick-up/drop-off service with private or shared vehicles.', '2025-06-08 09:00:00', '/img/service/AirportTransfer.jpg'),
(6, 'Car Rental', 'car-rental', 'Car rental service with various options for travel or business use.', '2025-06-08 09:00:00', '/img/service/CarRental.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed','refunded') DEFAULT 'pending',
  `payment_method` enum('ZaloPay','Momo','credit card','bank transfer') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `total_amount`, `payment_status`, `payment_method`, `created_at`) VALUES
(1, 1200000.00, 'completed', 'Momo', '2025-06-01 14:32:00'),
(2, 2500000.00, 'completed', 'bank transfer', '2025-06-02 09:45:00'),
(3, 950000.00, 'pending', NULL, '2025-06-03 18:20:00'),
(4, 1800000.00, 'failed', 'credit card', '2025-06-04 11:15:00'),
(5, 3200000.00, 'completed', 'ZaloPay', '2025-06-05 16:08:00'),
(6, 100.00, 'pending', 'credit card', '2025-06-25 15:22:26'),
(7, 100.00, 'pending', 'credit card', '2025-06-25 15:24:08');


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `cccd` varchar(20) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `discount` int(11) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `sdt`, `cccd`, `pass`, `full_name`, `created_at`, `discount`, `role`) VALUES
(1, 'minhtld1451@ut.edu.vn', '0393336649', '086205001451', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Trần Lê Duy Minh', '2025-06-01 10:00:00', 10, 'admin'),
(2, 'linh2712nha@gmail.com', '0971815720', '086205001452', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Nguyễn Quang Linh', '2025-06-02 09:30:00', 1, 'user'),
(3, 'nguyentrongduc447@gmail.com', '0866225534', '086205001453', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Nguyễn Trọng Đức', '2025-06-03 11:45:00', 0, 'user'),
(4, 'huynhdaihafc@gmail.com', '0903348270', '086205001454', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Huỳnh Đại Hà', '2025-06-04 08:20:00', 2, 'user'),
(5, 'thinhlt1681@ut.edu.vn', '0365574437', '086205001455', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Lê Trường Thịnh', '2025-06-05 14:15:00', 3, 'user'),
(6, 'phamthianh@gmail.com', '0911223344', '086205001456', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Phạm Thị Ánh', '2025-06-06 09:10:00', 4, 'user'),
(7, 'tranvankhai@yahoo.com', '0909988776', '086205001457', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Trần Văn Khải', '2025-06-07 10:45:00', 1, 'user'),
(8, 'nguyenthibich@outlook.com', '0967112334', '086205001458', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Nguyễn Thị Bích', '2025-06-08 13:00:00', 2, 'user'),
(9, 'lequanghuy@gmail.com', '0356227711', '086205001459', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Lê Quang Huy', '2025-06-09 08:55:00', 0, 'user'),
(10, 'buidieulinh@gmail.com', '0388456789', '086205001460', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Bùi Diệu Linh', '2025-06-10 15:40:00', 5, 'user'),
(11, 'dangngocminh@ut.edu.vn', '0911888222', '086205001461', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Đặng Ngọc Minh', '2025-06-11 11:20:00', 3, 'user'),
(12, 'votranhoanglong@gmail.com', '0378992211', '086205001462', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Võ Trần Hoàng Long', '2025-06-12 17:30:00', 2, 'user'),
(13, 'hoangphuonganh@gmail.com', '0932445566', '086205001463', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Hoàng Phương Anh', '2025-06-13 09:05:00', 1, 'user'),
(14, 'ngokienphat@gmail.com', '0855223344', '086205001464', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Ngô Kiến Phát', '2025-06-14 12:00:00', 0, 'user'),
(15, 'tranhoangmy@ut.edu.vn', '0922113344', '086205001465', '$2y$10$WHDY6gcvNiLL.1fJtx1zAO5Ns2Uk/ZP/UV1xewVhUljszGKl51fZu', 'Trần Hoàng My', '2025-06-15 14:25:00', 4, 'user');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenity`
--
ALTER TABLE `amenity`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `guest_id` (`guest_id`),
  ADD KEY `booking_ibfk_4` (`id_room`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`),
  ADD UNIQUE KEY `cccd` (`cccd`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- Indexes for table `historybooking`
--
ALTER TABLE `historybooking`
  ADD PRIMARY KEY (`id_history`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `guest_id` (`guest_id`),
  ADD KEY `booking_ibfk_5` (`id_room`);

--
-- Indexes for table `image_room`
--
ALTER TABLE `image_room`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `id_type_room_fk` (`id_room_type`);

--
-- Indexes for table `room_amenity`
--
ALTER TABLE `room_amenity`
  ADD PRIMARY KEY (`id_room`,`amenity_id`),
  ADD KEY `amenity_id` (`amenity_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id_type_room`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mail` (`email`),
  ADD UNIQUE KEY `cccd` (`cccd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenity`
--
ALTER TABLE `amenity`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `historybooking`
--
ALTER TABLE `historybooking`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `image_room`
--
ALTER TABLE `image_room`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id_type_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`) ON DELETE SET NULL;

--
-- Constraints for table `historybooking`
--
ALTER TABLE `historybooking`
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`) ON DELETE SET NULL,
  ADD CONSTRAINT `historybooking_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`),
  ADD CONSTRAINT `historybooking_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `historybooking_ibfk_4` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`);

--
-- Constraints for table `image_room`
--
ALTER TABLE `image_room`
  ADD CONSTRAINT `image_room_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `id_type_room_fk` FOREIGN KEY (`id_room_type`) REFERENCES `room_type` (`id_type_room`) ON DELETE SET NULL;

--
-- Constraints for table `room_amenity`
--
ALTER TABLE `room_amenity`
  ADD CONSTRAINT `room_amenity_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_amenity_ibfk_2` FOREIGN KEY (`amenity_id`) REFERENCES `amenity` (`amenity_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
