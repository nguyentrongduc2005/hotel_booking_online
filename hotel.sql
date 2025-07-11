-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 01:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `transaction_id` int(11) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `status_checkin` enum('pending','done') DEFAULT 'pending',
  `status_checkout` enum('pending','done') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `user_id`, `guest_id`, `check_in`, `check_out`, `status`, `created_at`, `transaction_id`, `id_room`, `status_checkin`, `status_checkout`) VALUES
(35, 14, NULL, '2025-07-11 00:00:00', '2025-07-12 00:00:00', 'confirmed', '2025-07-11 00:35:53', 21, 1, 'done', 'pending'),
(36, 15, NULL, '2025-07-11 00:00:00', '2025-07-12 00:00:00', 'confirmed', '2025-07-11 04:16:43', 22, 4, 'done', 'pending'),
(37, NULL, 16, '2025-07-11 00:00:00', '2025-07-12 00:00:00', 'confirmed', '2025-07-11 04:18:18', 23, 1, 'done', 'pending'),
(38, NULL, 18, '2025-07-11 00:00:00', '2025-07-12 00:00:00', 'confirmed', '2025-07-11 04:19:35', 24, 3, 'done', 'pending');

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
(16, 'Lang Khach Duong Xa', '0987654321', 'khongtu1234@gmail.com', '0987654321', '2025-07-11 04:18:18'),
(18, 'Luu Ba On', '0987654320', 'luubaon1234@gmail.com', '0987654320', '2025-07-11 04:19:35');

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
(7, 1, 14, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:19:32', 12, NULL),
(8, 3, 15, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:19:38', 12, NULL),
(9, 6, 16, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:20:39', 12, NULL),
(10, 3, 17, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:23:38', 13, NULL),
(11, 1, 18, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:30:48', 14, NULL),
(12, 1, 20, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:37:10', 14, NULL),
(13, 3, 19, '2025-07-10 00:00:00', '2025-07-11 00:00:00', 'cancelled', '2025-07-11 00:37:11', 14, NULL);

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
(51, '/img/f(6).jpg', 6),
(102, '/img/room/68701ecba890f-10610_19022513520072500443.jpg', 11),
(103, '/img/room/68701ecbaa287-a5y7_rotwb_00_p_2048x1536.jpg', 11),
(104, '/img/room/68701ecbab3eb-b2t5_rokga_00_p_2048x1536.jpg', 11),
(105, '/img/room/68701f0359999-crowne-plaza-shanghai-7056208657-3x2.jpg', 12),
(106, '/img/room/68701f035f3f0-Fairmont-Ambassador-Suite-2-Accor.jpg', 12),
(107, '/img/room/68701f0360122-king-premier-room.jpg', 12),
(108, '/img/room/68701f03610e8-R.jpg', 12),
(109, '/img/room/687021488eab5-6.jpg', 13),
(110, '/img/room/68702148909aa-7.jpg', 13),
(111, '/img/room/68702148919bf-8.jpg', 13),
(112, '/img/room/6870214894061-9.jpg', 13),
(113, '/img/room/6870214894c1b-10.jpg', 13),
(114, '/img/room/6870263338905-5O4A8722-copy.jpg', 14),
(115, '/img/room/687026333e6d8-484374858.jpg', 14),
(116, '/img/room/687026333f8fe-A-3-scaled.jpg', 14),
(117, '/img/room/6870276557e6d-Deluxe-Room-1800x1200-1800x1200.jpg', 15),
(118, '/img/room/6870276559ebf-DEV05-CPI_0099-v2-scaled.jpg', 15),
(119, '/img/room/687027655b605-image-2788825-4.jpg', 15),
(120, '/img/room/687027c344de7-R (1).jpg', 16),
(121, '/img/room/687027c346b8c-R.jpg', 16),
(122, '/img/room/687027c3483b5-Superior-Room-1800x1200.jpg', 16),
(123, '/img/room/6870286f1c5d4-3fff1c110521635.5fefd3623f696.jpg', 17),
(124, '/img/room/6870286f1e632-968f0eb19f773af59a1a91ec6d38a96b.jpg', 17),
(125, '/img/room/6870286f1f70c-1085.jpg', 17),
(126, '/img/room/6870286f20744-3925b74ec7602ab363da66519b69952d.jpg', 17),
(127, '/img/room/687028a4443ce-1085.jpg', 18),
(128, '/img/room/687028a446390-3925b74ec7602ab363da66519b69952d.jpg', 18),
(129, '/img/room/687028a44716f-161642_17021608450051056238.jpg', 18),
(130, '/img/room/687028a448014-IMG_0032-final-scaled.jpg', 18),
(131, '/img/room/687028a449a55-Lion-Sands_Ivory-Lodge_3_Villa-En-Suite-Bathroom.jpg', 18),
(132, '/img/room/687028a44ada4-Lion-Sands-River-Lodge-View-from-Bathroom.jpg', 18),
(133, '/img/room/687028c696290-1085.jpg', 19),
(134, '/img/room/687028c69b1c8-3925b74ec7602ab363da66519b69952d.jpg', 19),
(135, '/img/room/687028c69c4a9-161642_17021608450051056238.jpg', 19),
(136, '/img/room/687028c6a226d-IMG_0032-final-scaled.jpg', 19),
(137, '/img/room/687028c6a3d22-Lion-Sands_Ivory-Lodge_3_Villa-En-Suite-Bathroom.jpg', 19),
(138, '/img/room/687028c6a4be6-Lion-Sands-River-Lodge-View-from-Bathroom.jpg', 19),
(139, '/img/room/68702a83326a2-110-The-St.-Regis-Kuala-Lumpur-Hotel-Kuala-Lumpur-Malaysia-Royal-Suite-Living-Area.jpg', 20),
(140, '/img/room/68702a8334c4c-22070717_21051812-N5-5704.jpg', 20),
(141, '/img/room/68702a83359d5-LUXURY-SUITE-60M2-1.jpg', 20),
(142, '/img/room/68702a8336785-presidential2.jpg', 20),
(143, '/img/room/68702a8337a3d-tpewh-suite-6966-hor-clsc.jpg', 20),
(144, '/img/room/68702ac15995c-00e8f764206031.623e1e2127660.jpg', 21),
(145, '/img/room/68702ac15bffd-81f40463725381.623e1ca1a0fbb.jpg', 21),
(146, '/img/room/68702ac15cb90-087-The-St.-Regis-Saadiyat-Island-Resort-Abu-Dhabi-UAE-Royal-Suite-Living-Room-Seating.jpg', 21),
(147, '/img/room/68702ac15d9c3-110-The-St.-Regis-Kuala-Lumpur-Hotel-Kuala-Lumpur-Malaysia-Royal-Suite-Living-Area.jpg', 21),
(148, '/img/room/68702ac160504-22070717_21051812-N5-5704.jpg', 21),
(149, '/img/room/68702ac161407-LUXURY-SUITE-60M2-1.jpg', 21),
(150, '/img/room/68702ac162281-presidential2.jpg', 21),
(151, '/img/room/68702ac162eeb-tpewh-suite-6966-hor-clsc.jpg', 21),
(152, '/img/room/68702b3da5714-a (1).jpg', 22),
(153, '/img/room/68702b3da7087-a (2).jpg', 22),
(154, '/img/room/68702b3da7efb-a (3).jpg', 22),
(155, '/img/room/68702b3da8ab3-a (4).jpg', 22),
(156, '/img/room/68702b3da96c8-a (5).jpg', 22),
(157, '/img/room/68702b3daa2a1-a (6).jpg', 22),
(158, '/img/room/68702b3daec55-a (7).jpg', 22),
(159, '/img/room/68702b3daf90f-a (8).jpg', 22),
(160, '/img/room/68702b5c40e0e-a (3).jpg', 23),
(161, '/img/room/68702b5c42558-a (4).jpg', 23),
(162, '/img/room/68702b5c436d7-a (5).jpg', 23),
(163, '/img/room/68702b5c443fb-a (6).jpg', 23),
(164, '/img/room/68702b5c453d2-a (7).jpg', 23),
(165, '/img/room/68702b5c466a9-a (8).jpg', 23),
(166, '/img/room/68702b5c47cb3-a (9).jpg', 23),
(167, '/img/room/68702b5c48a14-a (10).jpg', 23),
(168, '/img/room/68702bb420ba4-deluxe-small-single-room-1500x750_1.jpg', 24),
(169, '/img/room/68702bb422ea5-ew.jpg', 24),
(170, '/img/room/68702bb423d14-gallery_camere-business4.jpg', 24),
(171, '/img/room/68702bca0debd-hotel-diana-roof-garden-roma-camera-singola-IMG-2104.JPG.jpg', 25),
(172, '/img/room/68702bca10a9c-KKP-18-1-scaled.jpg', 25),
(173, '/img/room/68702bca11909-signature-room-00-jost-hotel-bordeaux.jpg', 25);

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
(1, 2, 1, 28.00, 'available', '2025-06-08 17:21:49', 'Designed for simplicity and ease, the Standard Room combines comfort with essential functionality. Featuring a soft double or twin bed, fast Wi-Fi, a modern TV, and climate control, the space is tailored to meet the needs of everyday travelers. Whether you’re visiting for work or a quick getaway, the room provides a peaceful environment with practical amenities and a calming, contemporary décor to help you unwind.', 'standard-room', 22, 'Room 101', 1, '/img/room/a(1).jpg'),
(2, 3, 1, 30.00, 'available', '2025-06-08 17:21:49', 'Step into refined comfort with our Superior Room, thoughtfully designed for travelers seeking extra space and style. Featuring a plush king-size or twin bed, a dedicated work area, and modern amenities such as high-speed Wi-Fi, flat-screen TV, minibar, and a personal safe, this room is ideal for both business and leisure stays. Large windows invite natural light, while tasteful décor and soft tones create a calm, elegant atmosphere. Select rooms may include a private balcony or city view, adding a touch of indulgence to your stay.', 'superior-room', 27, 'Room 201', 2, '/img/room/b(1).jpg'),
(3, 3, 1, 48.00, 'available', '2025-06-08 17:21:49', 'Spacious, modern, and beautifully appointed—our Deluxe Room offers an elevated stay with premium bedding, elegant décor, and upscale amenities. Perfect for those who appreciate refined comfort and a stylish environment.', 'deluxe-room', 32, 'Room 301', 3, '/img/room/c(1).jpg'),
(4, 4, 2, 100.00, 'available', '2025-06-08 17:21:49', 'Our Suite Room offers a perfect blend of luxury and space, featuring a separate bedroom and living area for added privacy and comfort. Enjoy premium amenities including a smart mirror, Bluetooth speaker, in-room coffee machine, and a large bathroom with both shower and soaking tub. Ideal for extended stays, families, or business travelers who appreciate more room to relax or work.', 'suite-room', 50, 'Room 501', 4, '/img/room/d(1).jpg'),
(5, 4, 2, 72.00, 'available', '2025-06-08 17:21:49', 'Designed with families in mind, our Suite Room features a spacious layout with separate sleeping and living areas, offering the comfort of home while you\'re away. Kids can relax or play in the lounge while parents unwind in a cozy bedroom. Ideal for quality family time during your holiday.', 'family-room', 42, 'Room 401', 5, '/img/room/e(1).jpg'),
(6, 1, 1, 26.00, 'available', '2025-06-08 17:21:49', 'Tailored for solo travelers, the Single Room offers a cozy bed, work desk, high-speed Wi-Fi, and all the essentials needed for a productive and comfortable stay.', 'single-room', 17, 'Room 110', 6, '/img/room/f(1).jpg'),
(11, 1, 1, 27.00, 'available', '2025-07-11 03:12:59', 'An ideal choice for guests seeking comfort and value. The Standard Room includes a cozy bed, private bathroom, air conditioning, Wi-Fi, and a flat-screen TV for a pleasant stay.', 'standard-room-11', 28, 'Room 102', 1, '/img/room/68701ecba890f-10610_19022513520072500443.jpg'),
(12, 2, 2, 32.00, 'available', '2025-07-11 03:13:55', 'Designed with simplicity and functionality in mind, our Standard Room features either a double or twin bed, a work desk, and essential amenities like high-speed Wi-Fi, cable TV, and air conditioning. A practical option for business or leisure travelers.', 'standard-room-12', 33, 'Room 103', 1, '/img/room/68701f0359999-crowne-plaza-shanghai-7056208657-3x2.jpg'),
(13, 2, 2, 37.00, 'available', '2025-07-11 03:23:36', 'Step into a clean, comfortable space where you can relax after a long day. The Standard Room blends modern décor with warm tones, offering restful sleep and the convenience of everyday amenities, all at an affordable rate.', 'standard-room-13', 35, 'Room 101', 1, '/img/room/687021488eab5-6.jpg'),
(14, 4, 2, 40.00, 'available', '2025-07-11 03:44:35', 'Enjoy enhanced comfort in our Superior Room, designed for those who appreciate a little extra space and style. Featuring a plush queen or twin bed, elegant interior décor, large windows for natural light, and upgraded amenities like a minibar and a dedicated workspace. Perfect for business travelers or guests seeking a more refined stay.', 'superior-room-14', 35, 'Room 202', 2, '/img/room/6870263338905-5O4A8722-copy.jpg'),
(15, 4, 2, 40.00, 'available', '2025-07-11 03:49:41', 'Upgrade your stay with our spacious Superior Room, offering enhanced comfort and refined design. This room features a plush king-size or twin bed, elegant furnishings, and large windows that fill the space with natural light. Enjoy modern amenities such as high-speed Wi-Fi, a flat-screen TV, a well-lit work desk, and an in-room coffee station. With warm tones and contemporary décor, the Superior Room is ideal for business travelers, couples, or anyone seeking a little extra space and style during their stay.', 'superior-room-15', 35, 'Room 203', 2, '/img/room/6870276557e6d-Deluxe-Room-1800x1200-1800x1200.jpg'),
(16, 3, 2, 38.00, 'available', '2025-07-11 03:51:15', 'Enjoy enhanced comfort in our Superior Room, designed for those who appreciate a little extra space and style. Featuring a plush queen or twin bed, elegant interior décor, large windows for natural light, and upgraded amenities like a minibar and a dedicated workspace. Perfect for business travelers or guests seeking a more refined stay.', 'superior-room-16', 36, 'Room 204', 2, '/img/room/687027c344de7-R (1).jpg'),
(17, 4, 2, 45.00, 'available', '2025-07-11 03:54:07', 'Step into elevated luxury with our Deluxe Room, where modern design meets cozy elegance. This room offers a spacious layout with a king-size bed, premium linens, a stylish seating area, and a private balcony in select units. Enjoy upgraded comforts such as a smart TV, rain shower, and personalized in-room amenities that make your stay truly exceptional.', 'Deluxe-room-17', 40, 'Room 302', 3, '/img/room/6870286f1c5d4-3fff1c110521635.5fefd3623f696.jpg'),
(18, 4, 2, 49.00, 'available', '2025-07-11 03:55:00', 'Step into a serene space where comfort meets elegance. The Deluxe Room features calming tones, soft lighting, and thoughtful design to create a restful retreat. Whether you\'re unwinding after a day of exploring or enjoying a slow morning with coffee by the window, this room invites you to relax, recharge, and feel at home—only better.', 'Deluxe-room-18', 44, 'Room 304', 3, '/img/room/687028a4443ce-1085.jpg'),
(19, 4, 2, 49.00, 'available', '2025-07-11 03:55:34', 'Spacious, modern, and beautifully appointed—our Deluxe Room offers an elevated stay with premium bedding, elegant décor, and upscale amenities. Perfect for those who appreciate refined comfort and a stylish environment.', 'Deluxe-room-19', 44, 'Room 303', 3, '/img/room/687028c696290-1085.jpg'),
(20, 4, 2, 100.00, 'available', '2025-07-11 04:02:59', 'Experience a new level of comfort in our Suite Room—designed for guests who value elegance and tranquility. Wake up in a spacious king-sized bed, enjoy a cup of coffee in your private lounge, or unwind in a luxurious bathtub after a long day. Every detail is crafted to make your stay extraordinary.', 'suite-room-20', 56, 'Room 502', 4, '/img/room/68702a83326a2-110-The-St.-Regis-Kuala-Lumpur-Hotel-Kuala-Lumpur-Malaysia-Royal-Suite-Living-Area.jpg'),
(21, 4, 2, 108.00, 'available', '2025-07-11 04:04:01', 'Refined, spacious, and elegant—the Suite Room offers a private retreat with separate living space, deluxe furnishings, and thoughtful touches for a memorable stay.', 'suite-room-21', 60, 'Room 503', 4, '/img/room/68702ac15995c-00e8f764206031.623e1e2127660.jpg'),
(22, 9, 4, 70.00, 'available', '2025-07-11 04:06:05', 'Perfect for family getaways, this Suite Room combines space, convenience, and comfort. Enjoy multiple seating areas, extra beds upon request, and kid-friendly amenities that make traveling with children easier. Whether it\'s a short trip or a longer stay, your whole family will feel right at home.', 'family-room-22', 50, 'Room 402', 5, '/img/room/68702b3da5714-a (1).jpg'),
(23, 9, 4, 70.00, 'available', '2025-07-11 04:06:36', 'Make memories together in our family-friendly Suite Room, where thoughtful design meets spacious comfort. With room for everyone to relax, talk, and laugh, it’s more than a stay—it’s a shared experience your family will cherish.', 'family-room-23', 50, 'Room 403', 5, '/img/room/68702b5c40e0e-a (3).jpg'),
(24, 1, 1, 22.00, 'available', '2025-07-11 04:08:04', 'Enjoy privacy and peace in our stylish Single Room, designed for individuals seeking comfort and convenience. Whether you\'re traveling for work or leisure, this space provides just what you need for a restful stay.', 'single-room-24', 25, 'Room 111', 6, '/img/room/68702bb420ba4-deluxe-small-single-room-1500x750_1.jpg'),
(25, 1, 1, 22.00, 'available', '2025-07-11 04:08:26', 'Your own personal retreat. The Single Room is thoughtfully designed for one, featuring a soft bed, calming colors, and everything you need to recharge after a busy day of travel or business.', 'single-room-25', 25, 'Room 112', 6, '/img/room/68702bca0debd-hotel-diana-roof-garden-roma-camera-singola-IMG-2104.JPG.jpg');

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
(1, 1, '2025-07-11 03:14:54'),
(1, 2, '2025-07-11 03:14:54'),
(1, 3, '2025-07-11 03:14:54'),
(1, 4, '2025-07-11 03:14:54'),
(1, 5, '2025-07-11 03:14:54'),
(2, 4, '2025-07-11 03:15:26'),
(2, 5, '2025-07-11 03:15:26'),
(2, 6, '2025-07-11 03:15:26'),
(2, 7, '2025-07-11 03:15:26'),
(2, 8, '2025-07-11 03:15:26'),
(3, 7, '2025-07-11 03:15:40'),
(3, 8, '2025-07-11 03:15:40'),
(3, 9, '2025-07-11 03:15:40'),
(3, 10, '2025-07-11 03:15:40'),
(3, 11, '2025-07-11 03:15:40'),
(4, 8, '2025-07-11 03:16:12'),
(4, 10, '2025-07-11 03:16:12'),
(4, 11, '2025-07-11 03:16:12'),
(4, 12, '2025-07-11 03:16:12'),
(4, 13, '2025-07-11 03:16:12'),
(5, 4, '2025-07-11 04:04:46'),
(5, 5, '2025-07-11 04:04:46'),
(5, 6, '2025-07-11 04:04:46'),
(5, 7, '2025-07-11 04:04:46'),
(5, 8, '2025-07-11 04:04:46'),
(5, 9, '2025-07-11 04:04:46'),
(6, 1, '2025-07-11 03:16:47'),
(6, 2, '2025-07-11 03:16:47'),
(11, 1, '2025-07-11 03:12:59'),
(11, 2, '2025-07-11 03:12:59'),
(11, 3, '2025-07-11 03:12:59'),
(11, 4, '2025-07-11 03:12:59'),
(11, 5, '2025-07-11 03:12:59'),
(12, 1, '2025-07-11 03:13:55'),
(12, 2, '2025-07-11 03:13:55'),
(12, 3, '2025-07-11 03:13:55'),
(12, 4, '2025-07-11 03:13:55'),
(13, 1, '2025-07-11 03:23:36'),
(13, 2, '2025-07-11 03:23:36'),
(13, 3, '2025-07-11 03:23:36'),
(13, 4, '2025-07-11 03:23:36'),
(14, 1, '2025-07-11 03:44:35'),
(14, 2, '2025-07-11 03:44:35'),
(14, 3, '2025-07-11 03:44:35'),
(14, 4, '2025-07-11 03:44:35'),
(14, 5, '2025-07-11 03:44:35'),
(14, 6, '2025-07-11 03:44:35'),
(14, 7, '2025-07-11 03:44:35'),
(15, 2, '2025-07-11 03:49:41'),
(15, 3, '2025-07-11 03:49:41'),
(15, 4, '2025-07-11 03:49:41'),
(15, 5, '2025-07-11 03:49:41'),
(15, 6, '2025-07-11 03:49:41'),
(16, 2, '2025-07-11 03:51:15'),
(16, 3, '2025-07-11 03:51:15'),
(16, 4, '2025-07-11 03:51:15'),
(16, 6, '2025-07-11 03:51:15'),
(17, 4, '2025-07-11 03:54:07'),
(17, 5, '2025-07-11 03:54:07'),
(17, 6, '2025-07-11 03:54:07'),
(17, 7, '2025-07-11 03:54:07'),
(17, 8, '2025-07-11 03:54:07'),
(17, 9, '2025-07-11 03:54:07'),
(18, 1, '2025-07-11 03:55:00'),
(18, 2, '2025-07-11 03:55:00'),
(18, 3, '2025-07-11 03:55:00'),
(18, 5, '2025-07-11 03:55:00'),
(18, 6, '2025-07-11 03:55:00'),
(18, 7, '2025-07-11 03:55:00'),
(18, 8, '2025-07-11 03:55:00'),
(18, 9, '2025-07-11 03:55:00'),
(19, 2, '2025-07-11 03:55:34'),
(19, 3, '2025-07-11 03:55:34'),
(19, 4, '2025-07-11 03:55:34'),
(19, 5, '2025-07-11 03:55:34'),
(19, 6, '2025-07-11 03:55:34'),
(19, 7, '2025-07-11 03:55:34'),
(19, 8, '2025-07-11 03:55:34'),
(19, 9, '2025-07-11 03:55:34'),
(20, 1, '2025-07-11 04:02:59'),
(20, 2, '2025-07-11 04:02:59'),
(20, 3, '2025-07-11 04:02:59'),
(20, 4, '2025-07-11 04:02:59'),
(20, 5, '2025-07-11 04:02:59'),
(20, 6, '2025-07-11 04:02:59'),
(20, 7, '2025-07-11 04:02:59'),
(20, 8, '2025-07-11 04:02:59'),
(20, 9, '2025-07-11 04:02:59'),
(20, 10, '2025-07-11 04:02:59'),
(20, 11, '2025-07-11 04:02:59'),
(20, 12, '2025-07-11 04:02:59'),
(20, 13, '2025-07-11 04:02:59'),
(21, 1, '2025-07-11 04:04:01'),
(21, 2, '2025-07-11 04:04:01'),
(21, 3, '2025-07-11 04:04:01'),
(21, 4, '2025-07-11 04:04:01'),
(21, 5, '2025-07-11 04:04:01'),
(21, 6, '2025-07-11 04:04:01'),
(21, 7, '2025-07-11 04:04:01'),
(21, 8, '2025-07-11 04:04:01'),
(21, 9, '2025-07-11 04:04:01'),
(21, 10, '2025-07-11 04:04:01'),
(21, 11, '2025-07-11 04:04:01'),
(21, 12, '2025-07-11 04:04:01'),
(21, 13, '2025-07-11 04:04:01'),
(22, 1, '2025-07-11 04:06:05'),
(22, 2, '2025-07-11 04:06:05'),
(22, 3, '2025-07-11 04:06:05'),
(22, 4, '2025-07-11 04:06:05'),
(22, 5, '2025-07-11 04:06:05'),
(22, 6, '2025-07-11 04:06:05'),
(22, 7, '2025-07-11 04:06:05'),
(22, 8, '2025-07-11 04:06:05'),
(22, 9, '2025-07-11 04:06:05'),
(22, 10, '2025-07-11 04:06:05'),
(23, 1, '2025-07-11 04:06:36'),
(23, 2, '2025-07-11 04:06:36'),
(23, 3, '2025-07-11 04:06:36'),
(23, 4, '2025-07-11 04:06:36'),
(23, 5, '2025-07-11 04:06:36'),
(23, 6, '2025-07-11 04:06:36'),
(23, 7, '2025-07-11 04:06:36'),
(24, 1, '2025-07-11 04:08:04'),
(24, 2, '2025-07-11 04:08:04'),
(25, 1, '2025-07-11 04:08:26'),
(25, 3, '2025-07-11 04:08:26');

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
(1, 'Spa Service', 'spa-service', 'Rejuvenate your body and mind at our tranquil spa, where relaxation meets professional care. Our skilled therapists offer a range of treatments, including traditional and modern massage therapies, revitalizing facials, and full-body care designed to relieve stress and restore balance. Using high-quality natural products in a serene setting, each session is tailored to your individual needs. Whether you\'re recovering from travel fatigue or simply indulging in a moment of peace, our spa promises a soothing experience that leaves you refreshed and renewed.', '2025-06-08 09:00:00', '/img/service/SpaService.jpg'),
(2, 'Dining Service', 'dining-service', 'Savor a world of flavors at our all-day buffet restaurant, where Asian delicacies meet European classics in a vibrant, inviting atmosphere. Open 24/7, the restaurant offers a wide array of freshly prepared dishes to suit every palate—whether you\'re in the mood for a hearty breakfast, a light lunch, or a gourmet dinner. Guests can enjoy live cooking stations, seasonal specials, and a selection of desserts and beverages. With elegant décor and attentive service, it’s the perfect place to dine at your convenience, anytime of day or night.\r\n\r\n', '2025-06-08 09:00:00', '/img/service/DiningService.jpg'),
(3, 'Room Service', 'room-service', 'Experience the comfort of dining in with our 24/7 room service, delivering a wide selection of food and beverages directly to your door. Whether you\'re craving a full-course meal, a late-night snack, or a refreshing drink, our menu features both local specialties and international favorites prepared fresh by our kitchen. Perfect for guests who prefer privacy or wish to relax after a long day, our room service ensures convenience, quality, and a touch of luxury—all from the comfort of your room.', '2025-06-08 09:00:00', '/img/service/RoomService.jpg'),
(4, 'Laundry Service', 'laundry-service', 'Our laundry service ensures your clothing is cleaned, pressed, and returned with care—all within the same day. Whether you’re staying for business or leisure, we offer fast turnaround times without compromising on quality. From delicate garments to everyday wear, each item is treated with professional attention using high-grade detergents and modern equipment. Guests can request express service, ironing, or dry cleaning, all conveniently handled by our housekeeping team. Simply place your laundry in the provided bag and let us take care of the rest—so you can stay fresh and worry-free during your visit.\r\n\r\n', '2025-06-08 09:00:00', '/img/service/LaundryService.jpg'),
(5, 'Airport Transfer', 'airport-transfer', 'Enjoy a stress-free arrival and departure with our reliable airport transfer service, available for both private and shared rides. Whether you\'re traveling solo, with family, or as part of a group, we offer a range of vehicle options—from comfortable sedans to spacious vans—tailored to your needs. Our professional drivers ensure timely pick-up and drop-off, assisting with luggage and providing a smooth, safe ride between the airport and the hotel. Advance booking is recommended for guaranteed availability and personalized service. Let us take care of your transportation so you can start or end your journey with ease.', '2025-06-08 09:00:00', '/img/service/AirportTransfer.jpg'),
(6, 'Car Rental', 'car-rental', 'Our car rental service offers a wide selection of well-maintained vehicles to suit your travel needs—whether you\'re exploring the city, going on a family trip, or attending a business meeting. Guests can choose from compact cars, sedans, SUVs, or luxury models, all available with flexible rental durations. Each vehicle is regularly inspected for safety and cleanliness, ensuring a smooth and worry-free journey. With optional services such as chauffeur hire, GPS navigation, and hotel pick-up, our rental experience is designed to provide maximum convenience, comfort, and freedom during your stay.\r\n\r\n', '2025-06-08 09:00:00', '/img/service/CarRental.jpg'),
(8, 'Fitness Center', 'fitness-center', 'Stay active while away from home at our fully equipped fitness center, featuring modern cardio machines, free weights, and workout space. Whether you\'re traveling for business or leisure, our gym is open daily to help you maintain your fitness routine with ease and comfort.', '2025-07-11 03:26:15', '/public/img/service/service_687021e74bc5f.jpg'),
(9, 'Swimming Pool', 'swimming-pool', 'Take a refreshing dip in our outdoor swimming pool or unwind on a sun lounger by the water. Perfect for relaxation, leisure, or a picturesque check-in moment, the pool area offers a peaceful escape right in the heart of the hotel.', '2025-07-11 03:27:29', '/public/img/service/service_687022315b54c.jpg'),
(10, 'Event & Conference', 'event-conference', 'Host your next meeting, wedding, or special occasion in our flexible event and conference spaces. With modern facilities, customizable setups, and professional support, we provide everything you need for a successful and memorable event.', '2025-07-11 03:28:07', '/public/img/service/service_687030786e061.jpg');

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
(8, 26.60, 'pending', 'ZaloPay', '2025-07-10 23:48:20'),
(9, 26.60, 'pending', NULL, '2025-07-10 23:48:36'),
(10, 26.60, 'pending', 'ZaloPay', '2025-07-10 23:48:38'),
(11, 28.50, 'pending', 'credit card', '2025-07-10 23:49:32'),
(12, 48.00, 'refunded', 'Momo', '2025-07-10 23:52:40'),
(13, 29.45, 'refunded', 'Momo', '2025-07-10 23:59:18'),
(14, 26.60, 'refunded', 'credit card', '2025-07-11 00:06:05'),
(15, 45.60, 'refunded', 'credit card', '2025-07-11 00:06:47'),
(16, 24.70, 'refunded', 'bank transfer', '2025-07-11 00:20:29'),
(17, 45.60, 'refunded', 'credit card', '2025-07-11 00:23:30'),
(18, 26.60, 'refunded', 'credit card', '2025-07-11 00:30:38'),
(19, 45.60, 'refunded', 'Momo', '2025-07-11 00:32:13'),
(20, 26.60, 'refunded', 'Momo', '2025-07-11 00:34:12'),
(21, 26.60, 'pending', 'credit card', '2025-07-11 00:35:53'),
(22, 95.00, 'pending', 'credit card', '2025-07-11 04:16:43'),
(23, 28.00, 'pending', 'bank transfer', '2025-07-11 04:18:18'),
(24, 48.00, 'pending', 'Momo', '2025-07-11 04:19:35');

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
  `discount` int(11) DEFAULT 0,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `sdt`, `cccd`, `pass`, `full_name`, `created_at`, `discount`, `role`) VALUES
(12, 'Jackyeudomdom@gmail.com', '0739238384', '083205001451', '$2y$10$B0nlOsRKgkR2cMe.g8iL0Ou9Oj7652/MTHy8YTvhpl5DoYfI9IE8u', 'Trinh Tran Phuong Tuan', '2025-07-10 23:58:58', 4, 'user'),
(13, 'minh@gmail.com', '0987932313', '087205001273732', '$2y$10$d4dp7ogHAa5Fez3T7K1IY.cwvY878YO48fTuIgEjWeRR.365wf2Fq', 'minhminh', '2025-07-11 00:23:17', 1, 'user'),
(14, 'My@gmail.com', '0987623839', '09137138237', '$2y$10$yK4h5EN0lMNvPwuEIDdbY.c7fYxqqnb6/bQGheTEXp.UMrWMmWk8W', 'Tran Thi Diem My', '2025-07-11 00:29:22', 4, 'user'),
(15, 'User1234@gmail.com', '098765432', '089765432', '$2y$10$b/DPjhurBY01kE5xLOClleaM2dUvd48AlkWy/2jHW9IprTMG2.KnS', 'Nguyen Van User', '2025-07-11 04:15:39', 1, 'user'),
(16, 'Admin123@gmail.com', '0989888777', '0989888777', '$2y$10$ywWVriCF.nW4L5FG.DQOW.pSThS3I4TxeyzPJhd1hUdq6OzYF23we', 'Nguyen Van Admin', '2025-07-11 04:25:24', 0, 'admin');

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
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `historybooking`
--
ALTER TABLE `historybooking`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `image_room`
--
ALTER TABLE `image_room`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id_type_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE SET NULL,
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
