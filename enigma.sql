-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 11:51 AM
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
-- Database: `enigma`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(5) NOT NULL,
  `country_id` int(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `country_id`, `city`, `zip`, `address`, `user_id`) VALUES
(1, 155, 'Beograd', '11000', 'Zdravka Celara 16', 5);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(5) NOT NULL,
  `brand_name` varchar(20) NOT NULL,
  `is_deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `is_deleted`) VALUES
(1, 'bershka', b'0'),
(2, 'stradivarius', b'0'),
(3, 'zara', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `is_deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `is_deleted`) VALUES
(1, 'boots', b'0'),
(2, 'shirt', b'0'),
(3, 'dress', b'0'),
(4, 'sweater', b'0'),
(5, 'jacket', b'0'),
(6, 'sneakers', b'0'),
(7, 't-shirt', b'0'),
(8, 'boots', b'0'),
(9, 'shirt', b'0'),
(10, 'dress', b'0'),
(11, 'sweater', b'0'),
(12, 'jacket', b'0'),
(13, 'sneakers', b'0'),
(14, 't-shirt', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(5) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua and Barbuda'),
(7, 'Argentina'),
(8, 'Armenia'),
(9, 'Australia'),
(10, 'Austria'),
(11, 'Azerbaijan'),
(12, 'Bahamas'),
(13, 'Bahrain'),
(14, 'Bangladesh'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Bolivia'),
(22, 'Bosnia and Herzegovina'),
(23, 'Botswana'),
(24, 'Brazil'),
(25, 'Brunei'),
(26, 'Bulgaria'),
(27, 'Burkina Faso'),
(28, 'Burundi'),
(29, 'Cabo Verde'),
(30, 'Cambodia'),
(31, 'Cameroon'),
(32, 'Canada'),
(33, 'Central African Republic'),
(34, 'Chad'),
(35, 'Chile'),
(36, 'China'),
(37, 'Colombia'),
(38, 'Comoros'),
(39, 'Congo, Democratic Republic of '),
(40, 'Congo, Republic of the'),
(41, 'Costa Rica'),
(42, 'Croatia'),
(43, 'Cuba'),
(44, 'Cyprus'),
(45, 'Czech Republic'),
(46, 'Denmark'),
(47, 'Djibouti'),
(48, 'Dominica'),
(49, 'Dominican Republic'),
(50, 'East Timor (Timor-Leste)'),
(51, 'Ecuador'),
(52, 'Egypt'),
(53, 'El Salvador'),
(54, 'Equatorial Guinea'),
(55, 'Eritrea'),
(56, 'Estonia'),
(57, 'Eswatini'),
(58, 'Ethiopia'),
(59, 'Fiji'),
(60, 'Finland'),
(61, 'France'),
(62, 'Gabon'),
(63, 'Gambia'),
(64, 'Georgia'),
(65, 'Germany'),
(66, 'Ghana'),
(67, 'Greece'),
(68, 'Grenada'),
(69, 'Guatemala'),
(70, 'Guinea'),
(71, 'Guinea-Bissau'),
(72, 'Guyana'),
(73, 'Haiti'),
(74, 'Honduras'),
(75, 'Hungary'),
(76, 'Iceland'),
(77, 'India'),
(78, 'Indonesia'),
(79, 'Iran'),
(80, 'Iraq'),
(81, 'Ireland'),
(82, 'Israel'),
(83, 'Italy'),
(84, 'Jamaica'),
(85, 'Japan'),
(86, 'Jordan'),
(87, 'Kazakhstan'),
(88, 'Kenya'),
(89, 'Kiribati'),
(90, 'Korea, North'),
(91, 'Korea, South'),
(92, 'Kosovo'),
(93, 'Kuwait'),
(94, 'Kyrgyzstan'),
(95, 'Laos'),
(96, 'Latvia'),
(97, 'Lebanon'),
(98, 'Lesotho'),
(99, 'Liberia'),
(100, 'Libya'),
(101, 'Liechtenstein'),
(102, 'Lithuania'),
(103, 'Luxembourg'),
(104, 'Madagascar'),
(105, 'Malawi'),
(106, 'Malaysia'),
(107, 'Maldives'),
(108, 'Mali'),
(109, 'Malta'),
(110, 'Marshall Islands'),
(111, 'Mauritania'),
(112, 'Mauritius'),
(113, 'Mexico'),
(114, 'Micronesia, Federated States o'),
(115, 'Moldova'),
(116, 'Monaco'),
(117, 'Mongolia'),
(118, 'Montenegro'),
(119, 'Morocco'),
(120, 'Mozambique'),
(121, 'Myanmar (Burma)'),
(122, 'Namibia'),
(123, 'Nauru'),
(124, 'Nepal'),
(125, 'Netherlands'),
(126, 'New Zealand'),
(127, 'Nicaragua'),
(128, 'Niger'),
(129, 'Nigeria'),
(130, 'North Macedonia'),
(131, 'Norway'),
(132, 'Oman'),
(133, 'Pakistan'),
(134, 'Palau'),
(135, 'Palestine'),
(136, 'Panama'),
(137, 'Papua New Guinea'),
(138, 'Paraguay'),
(139, 'Peru'),
(140, 'Philippines'),
(141, 'Poland'),
(142, 'Portugal'),
(143, 'Qatar'),
(144, 'Romania'),
(145, 'Russia'),
(146, 'Rwanda'),
(147, 'Saint Kitts and Nevis'),
(148, 'Saint Lucia'),
(149, 'Saint Vincent and the Grenadin'),
(150, 'Samoa'),
(151, 'San Marino'),
(152, 'Sao Tome and Principe'),
(153, 'Saudi Arabia'),
(154, 'Senegal'),
(155, 'Serbia'),
(156, 'Seychelles'),
(157, 'Sierra Leone'),
(158, 'Singapore'),
(159, 'Slovakia'),
(160, 'Slovenia'),
(161, 'Solomon Islands'),
(162, 'Somalia'),
(163, 'South Africa'),
(164, 'Spain'),
(165, 'Sri Lanka'),
(166, 'Sudan'),
(167, 'Sudan, South'),
(168, 'Suriname'),
(169, 'Sweden'),
(170, 'Switzerland'),
(171, 'Syria'),
(172, 'Taiwan'),
(173, 'Tajikistan'),
(174, 'Tanzania'),
(175, 'Thailand'),
(176, 'Togo'),
(177, 'Tonga'),
(178, 'Trinidad and Tobago'),
(179, 'Tunisia'),
(180, 'Turkey'),
(181, 'Turkmenistan'),
(182, 'Tuvalu'),
(183, 'Uganda'),
(184, 'Ukraine'),
(185, 'United Arab Emirates'),
(186, 'United Kingdom'),
(187, 'United States'),
(188, 'Uruguay'),
(189, 'Uzbekistan'),
(190, 'Vanuatu'),
(191, 'Vatican City'),
(192, 'Venezuela'),
(193, 'Vietnam'),
(194, 'Yemen'),
(195, 'Zambia'),
(196, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(5) NOT NULL,
  `path` varchar(50) NOT NULL,
  `product_id` int(5) NOT NULL,
  `is_main` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `path`, `product_id`, `is_main`) VALUES
(65, 'boots1.jpg', 17, b'1'),
(66, 'boots2.jpg', 18, b'1'),
(67, 'boots3.jpg', 19, b'1'),
(68, 'boots4.jpg', 20, b'1'),
(69, 'dress1.jpg', 21, b'1'),
(70, 'dress2.jpg', 22, b'1'),
(71, 'jacket1.jpg', 23, b'1'),
(72, 'shirt1.jpg', 24, b'1'),
(73, 'shirt2.jpg', 25, b'1'),
(74, 'shirt3.jpg', 26, b'1'),
(75, 'shirt4.jpg', 27, b'1'),
(76, 'shirt5.jpg', 28, b'1'),
(77, 'shirt6.jpg', 29, b'1'),
(78, 'sweater1.jpg', 30, b'1'),
(79, 'sweater2.jpg', 31, b'1'),
(80, 'sweater3.jpg', 32, b'1'),
(81, 'boots5.webp', 34, b'1'),
(82, 'boots6.jpg', 35, b'1'),
(83, 'boots7.webp', 36, b'1'),
(84, 'jacket2.jpg', 37, b'1'),
(85, 'jacket3.jpg', 38, b'1'),
(86, 'jacket4.jpg', 39, b'1'),
(87, 'jacket5.jpg', 40, b'1'),
(88, 'sneakers1.jpg', 41, b'1'),
(89, 'sneakers2.jpg', 42, b'1'),
(90, 'sneakers3.jpg', 43, b'1'),
(91, 'sneakers4.jpg', 44, b'1'),
(92, 'sneakers5.jpg', 45, b'1'),
(93, 'sweater4.webp', 46, b'1'),
(94, 'sweater5.jpg', 47, b'1'),
(95, 'tshirt1.jpg', 48, b'1'),
(96, '666963259ee7e_Nikolina.jpg', 50, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `login_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(5) NOT NULL,
  `subject` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `category_id`, `message`, `user_id`, `subject`) VALUES
(1, 1, 'Message', 5, 'Message');

-- --------------------------------------------------------

--
-- Table structure for table `message_category`
--

CREATE TABLE `message_category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_category`
--

INSERT INTO `message_category` (`category_id`, `category_name`) VALUES
(1, 'Order Inquiries'),
(2, 'Product Questions'),
(3, 'Payment and Billing '),
(4, 'Returns and Refunds'),
(5, 'Technical Support');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `navigation_id` int(5) NOT NULL,
  `name` varchar(10) NOT NULL,
  `path` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`navigation_id`, `name`, `path`) VALUES
(1, 'Home', 'home'),
(2, 'Shop', 'shop'),
(4, 'Contact', 'contact'),
(7, 'Author', 'author');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `date_ordered`) VALUES
(3, 5, 86.93, '2024-06-11 10:25:43'),
(4, 5, 40.60, '2024-06-11 10:29:05'),
(5, 5, 69.33, '2024-06-11 10:30:30'),
(6, 5, 17.60, '2024-06-11 10:33:56'),
(7, 5, 0.00, '2024-06-11 10:34:42'),
(8, 5, 0.00, '2024-06-12 09:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_product_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 3, 17, 1, 33.33),
(2, 3, 22, 1, 17.60),
(3, 3, 24, 1, 36.00),
(4, 4, 18, 1, 20.30),
(5, 4, 18, 6, 20.30),
(6, 5, 24, 1, 36.00),
(7, 5, 17, 1, 33.33),
(8, 6, 22, 1, 17.60),
(9, 7, 18, 1, 20.30),
(10, 8, 17, 1, 33.33),
(11, 8, 18, 1, 20.30);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(5) NOT NULL,
  `brand_id` int(5) NOT NULL,
  `is_deleted` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `price`, `category_id`, `brand_id`, `is_deleted`) VALUES
(17, 'HIGH BLACK BOOTS', 'Step into sophistication with our women\'s black calf-length boots that effortlessly blend style and comfort. Crafted with precision, these boots feature a sleek black exterior that adds a touch of elegance to any outfit. The calf-length design offers a versatile look, perfect for pairing with skirts, dresses, or your favorite skinny jeans. With a comfortable fit and a subtle heel, these boots are an ideal choice for both casual and more formal occasions, ensuring you step out with confidence and flair.', 47.00, 1, 1, b'1'),
(18, 'HIGH HEEL WOMEN BOOTS', 'Elevate your fashion game with our high heel black boots, designed to make a bold statement wherever you go. The sleek black finish exudes a sense of timeless sophistication, while the high heel adds a touch of glamour and confidence to your stride. Perfect for a night out on the town or a special event, these boots not only enhance your stature but also showcase your impeccable taste in footwear. Embrace the allure of high fashion with these black beauties that seamlessly blend style and grace.', 29.00, 1, 1, b'1'),
(19, 'FLAT BLACK BOOTS', 'For a more laid-back and comfortable style, our black flat boots are a wardrobe essential. These boots offer a perfect blend of simplicity and versatility, making them an ideal choice for everyday wear. The classic black color ensures easy pairing with various outfits, while the flat sole provides comfort for all-day activities. Whether you\'re running errands or meeting friends for a casual outing, these boots will be your go-to choice for effortless style and comfort.', 50.00, 1, 1, b'0'),
(20, 'WHITE COWBOY BOOTS', 'Saddle up in style with our white cowboy boots that bring a touch of Western flair to your wardrobe. These boots showcase a bold and distinctive design, featuring traditional cowboy detailing such as pointed toes and intricate stitching. The crisp white color adds a modern twist to the classic cowboy boot, making them a unique and eye-catching choice for any fashion enthusiast. Whether you\'re hitting the dance floor or looking to make a statement at a festival, these white cowboy boots are the perfect blend of rugged charm and contemporary fashion.', 60.00, 1, 1, b'0'),
(21, 'LITTLE BLACK OFF-SHOULDER DRESS', 'Make a statement in our little black off-shoulder dress that effortlessly combines elegance with a hint of allure. The off-shoulder neckline adds a touch of sophistication, while the classic black hue ensures a timeless and versatile look. This dress is perfect for a night out, a special occasion, or any event where you want to turn heads and showcase your style.', 70.00, 3, 3, b'0'),
(22, 'SHORT BEIGE BODYCON DRESS', 'Show off your curves in style with our short bodycon beige dress. This dress hugs your figure for a flattering silhouette, and the neutral beige color adds a touch of understated glamour. Whether you\'re heading to a cocktail party or a night on the town, this dress is a go-to choice for a chic and modern look that exudes confidence.', 22.00, 3, 1, b'0'),
(23, 'BROWN LEATHER JACKET WITH WOOL', 'Stay warm in style with our brown leather jacket featuring cozy wool detailing. This jacket combines the rugged charm of leather with the comfort of wool, creating a versatile outerwear piece for the colder seasons. The rich brown color adds a touch of warmth and sophistication, making it the perfect choice for a casual yet polished look.', 35.00, 5, 1, b'0'),
(24, 'PLAIN BLUE SHIRT', 'Elevate your wardrobe with our classic blue shirt, a timeless staple for any occasion. This shirt features a crisp and clean design in a versatile shade of blue, making it a perfect choice for both casual and formal settings. Pair it with jeans for a relaxed look or tuck it into a skirt for a more polished appearance. The classic blue shirt is a must-have for every wardrobe.', 45.00, 2, 1, b'0'),
(25, 'ASYMMETRIC BLACK SHIRT', 'Make a bold statement with our black asymmetric shirt that adds a contemporary edge to your wardrobe. The unique asymmetrical design creates visual interest, while the black color maintains a sense of sophistication. Whether paired with jeans for a casual look or trousers for a more formal setting, this shirt is a versatile and stylish addition to your collection.', 55.00, 2, 1, b'1'),
(26, 'BLUE STRIPPED SHIRT', 'Infuse a touch of modern flair into your attire with our blue shirt featuring subtle lines for added texture. This shirt combines classic design with contemporary detailing, making it a versatile choice for various occasions. The blue hue adds a refreshing pop of color, and the lines provide a stylish twist that sets it apart from the ordinary.', 65.00, 2, 2, b'0'),
(27, 'BACKLESS WHITE SHIRT', 'Turn heads with our backless white shirt that combines simplicity with a hint of allure. The open back adds a touch of drama to this classic white shirt, making it a unique and stylish choice for a night out or a special event. Pair it with high-waisted trousers or a skirt to create a sophisticated and fashion-forward ensemble.', 23.00, 2, 1, b'1'),
(28, 'WHITE STRIPPED SHIRT', 'Add a touch of sophistication to your wardrobe with our white shirt featuring subtle lines for a refined look. The classic white color ensures versatility, while the subtle lines provide a modern twist to this timeless piece. Whether worn with tailored trousers for a polished office look or with jeans for a casual outing, this shirt is a wardrobe essential.', 37.00, 2, 1, b'0'),
(29, 'BODYCON BLACK SHIRT', 'Flaunt your silhouette in our bodycon black shirt that combines comfort with a touch of glamour. The figure-hugging design accentuates your curves, while the black color adds a sense of chic sophistication. Whether paired with jeans for a casual look or a sleek skirt for a night out, this shirt is a versatile and stylish choice for various occasions.', 48.00, 2, 1, b'0'),
(30, 'BEIGE TURTLENECK OVERSIZED SWEATER', 'Stay cozy and on-trend with our beige turtleneck oversized sweater. This sweater combines comfort with fashion, featuring a relaxed fit and a chic turtleneck design. The neutral beige color makes it easy to pair with different bottoms, creating a laid-back yet stylish look for the colder seasons.', 58.00, 4, 1, b'0'),
(31, 'BLACK AND WHITE STRIPPED CARDIGAN', 'Wrap yourself in style with our white cardigan featuring subtle lines for added texture. This cardigan adds a layer of sophistication to your outfit, whether you\'re dressing up for the office or heading out for a casual day. The white color and lines create a visually appealing and versatile piece that complements various styles.', 68.00, 4, 1, b'0'),
(32, 'WHITE OFF-SHOULDER SWEATER', 'Stay cozy and chic with our off-shoulder white sweater that combines comfort with a touch of allure. The off-shoulder neckline adds a hint of sophistication, while the white color creates a clean and classic look. Whether paired with jeans for a casual day out or with leggings for a relaxed night in, this sweater is a versatile and stylish addition to your winter wardrobe.', 25.00, 4, 2, b'0'),
(34, 'HIGH HEEL WOMEN BOOTS', '', 45.00, 1, 1, b'0'),
(35, 'MEN ANKLE BOOTS', '', 55.00, 1, 3, b'0'),
(36, 'BLACK CALF LENGTH BOOTS', 'desc', 65.00, 1, 2, b'0'),
(37, 'BLACK LEATHER BOMBER JACKET', '', 23.00, 5, 1, b'0'),
(38, 'BLACK BOMBER JACKET', '', 37.00, 5, 3, b'0'),
(39, 'OVERSIZED LEATHER BOMBER JACKET', '', 48.00, 5, 1, b'0'),
(40, 'WHITE LEATHER JACKET', '', 58.00, 5, 3, b'0'),
(41, 'WHITE LIFESTYLE SNEAKERS', 'desc', 68.00, 6, 2, b'0'),
(42, 'BLACK LIFESTYLE SNEAKERS', '', 25.00, 6, 3, b'0'),
(43, 'BLACK SNEAKERS WITH BROWN SOLE', '', 35.00, 6, 1, b'0'),
(44, 'WHITE RUNNING SNEAKERS', '', 45.00, 6, 3, b'0'),
(45, 'BEIGE RUNNING SNEAKERS', '', 55.00, 6, 1, b'0'),
(46, 'BLACK OVERSIZED SWEATER', 'desc', 65.00, 4, 2, b'0'),
(47, 'STRIPPED SWEATER FOR MEN', '', 23.00, 4, 3, b'0'),
(48, 'BEIGE OVERSIZED T-SHIRT', '', 37.00, 8, 1, b'1'),
(50, 'PUFF SLEEVES BEIGE DRESS', '', 12.00, 4, 2, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(1) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `price_id` int(5) NOT NULL,
  `sale` decimal(10,2) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `product_id` int(5) NOT NULL,
  `is_sale` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`price_id`, `sale`, `date_from`, `date_to`, `product_id`, `is_sale`) VALUES
(132, 33.33, '2024-06-09', '2024-07-09', 17, b'1'),
(134, 20.30, '2024-06-09', '2024-07-09', 18, b'1'),
(136, 40.00, '2024-06-09', '2024-07-09', 19, b'1'),
(138, 51.00, '2024-06-09', '2024-07-09', 20, b'1'),
(140, 63.00, '2024-06-09', '2024-07-09', 21, b'1'),
(142, 17.60, '2024-06-09', '2024-07-09', 22, b'1'),
(144, 28.00, '2024-06-09', '2024-07-09', 23, b'1'),
(146, 36.00, '2024-06-09', '2024-07-09', 24, b'1'),
(148, 44.00, '2024-06-09', '2024-07-09', 25, b'1'),
(152, 18.40, '2024-06-09', '2024-07-09', 27, b'1'),
(154, 29.60, '2024-06-09', '2024-07-09', 28, b'1'),
(156, 38.40, '2024-06-09', '2024-07-09', 29, b'1'),
(160, 54.40, '2024-06-09', '2024-07-09', 31, b'1'),
(162, 20.00, '2024-06-09', '2024-07-09', 32, b'1'),
(164, 36.00, '2024-06-09', '2024-07-09', 34, b'1'),
(166, 44.00, '2024-06-09', '2024-07-09', 35, b'1'),
(170, 18.40, '2024-06-09', '2024-07-09', 37, b'1'),
(172, 29.60, '2024-06-09', '2024-07-09', 38, b'1'),
(174, 38.40, '2024-06-09', '2024-07-09', 39, b'1'),
(178, 54.40, '2024-06-09', '2024-07-09', 41, b'1'),
(180, 20.00, '2024-06-09', '2024-07-09', 42, b'1'),
(182, 28.00, '2024-06-09', '2024-07-09', 43, b'1'),
(184, 36.00, '2024-06-09', '2024-07-09', 44, b'1'),
(186, 44.00, '2024-06-09', '2024-07-09', 45, b'1'),
(190, 18.40, '2024-06-09', '2024-07-09', 47, b'1'),
(192, 29.60, '2024-06-09', '2024-07-09', 48, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `role_id` int(5) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` bit(1) NOT NULL DEFAULT b'0',
  `is_disabled` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `role_id`, `created_at`, `is_active`, `is_disabled`) VALUES
(5, 'nikica', '1db9ed089550bfa86bd46a4cbeff3309', 'milanovic.nikolina03@gmail.com', 'Nikolina', 'Milanovic', 2, '2024-06-08 14:34:52', b'1', b'0'),
(6, 'adminiki', 'b32f177c0c0b07100aedc118c5f3531e', 'nikolina.milanovic.120.22@ict.edu.rs', 'Nikolina', 'Milanovic', 1, '2024-06-12 01:04:14', b'1', b'0'),
(8, 'mateja', 'ef93754b5172e3c008979dfd027aa7c3', 'h.mateja003@gmail.com', 'Mateja', 'Hegedis', 2, '2024-06-12 09:28:02', b'1', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `country_id` (`country_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `message_category`
--
ALTER TABLE `message_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`navigation_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `login_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message_category`
--
ALTER TABLE `message_category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `navigation_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `price_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `message_category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
