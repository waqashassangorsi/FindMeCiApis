-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2021 at 02:25 PM
-- Server version: 10.3.29-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ranaentp_findme`
--

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `id` int(2) NOT NULL,
  `pagename` varchar(25) NOT NULL,
  `icon` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id`, `pagename`, `icon`) VALUES
(1, 'Dashboard', 'entypo-gauge'),
(2, 'Configurations', 'glyphicon glyphicon-cog');

-- --------------------------------------------------------

--
-- Table structure for table `msgs`
--

CREATE TABLE `msgs` (
  `msg_id` int(11) NOT NULL,
  `recv_id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgs`
--

INSERT INTO `msgs` (`msg_id`, `recv_id`, `send_id`, `content`, `date`) VALUES
(1, 41, 51, 'Helo are u there? this is the testing msg to check if msgs are goinr or not', '2020-05-18 20:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `RecentSearches`
--

CREATE TABLE `RecentSearches` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` datetime NOT NULL,
  `u_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Service,1=Task'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RecentSearches`
--

INSERT INTO `RecentSearches` (`id`, `name`, `date`, `u_id`, `status`) VALUES
(2, 'Carpenter', '2020-05-31 19:57:10', 49, '1'),
(3, 'Carpenter', '2020-05-31 23:09:21', 45, '0'),
(4, 'dsfasfasdf', '2021-04-01 06:20:04', 40, '0'),
(5, 'dsfasfasdf', '2021-04-01 06:20:08', 41, '0'),
(6, 'dsfasfasdf', '2021-04-01 06:20:12', 42, '0'),
(7, 'dsfasfasdf', '2021-04-01 06:20:17', 43, '0'),
(8, 'dsfasfasdf', '2021-04-01 06:20:20', 44, '0'),
(9, 'dsfasfasdf', '2021-04-01 06:20:23', 46, '0'),
(10, 'dsfasfasdf', '2021-04-01 06:20:27', 49, '0'),
(11, 'dsfasfasdf', '2021-04-01 06:21:04', 49, '0'),
(12, 'dsfasfasdf', '2021-04-01 06:21:05', 49, '0'),
(13, 'dsfasfasdf', '2021-04-01 06:21:08', 40, '0'),
(14, 'dsfasfasdf', '2021-04-01 06:21:21', 41, '0'),
(15, 'dsfasfasdf', '2021-04-01 06:37:16', 41, '0');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `register_for` varchar(20) NOT NULL,
  `business_name` text NOT NULL,
  `phone_no` text DEFAULT NULL,
  `type_of_work` int(11) NOT NULL,
  `business_details` text NOT NULL,
  `business_lat` text NOT NULL,
  `business_long` text NOT NULL,
  `image` text NOT NULL,
  `u_id` int(11) NOT NULL,
  `experience` text DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `register_for`, `business_name`, `phone_no`, `type_of_work`, `business_details`, `business_lat`, `business_long`, `image`, `u_id`, `experience`, `status`) VALUES
(1, 'Yourself', 'waqas hasan', NULL, 12, 'the business details comes here', '12', '34', '', 48, 'my experience content will come here', 'Online'),
(2, 'Yourself', 'waqas hasan', NULL, 6, 'the business details comes here', '12', '34', '', 48, 'my experience content will come here', 'Online'),
(3, 'Yourself', 'waqas hasan', NULL, 6, 'the business details comes here', '12', '34', '', 48, 'my experience content will come here', 'Online'),
(4, 'Yourself', 'test', '+92123', 1, 'test des', '32.33333', '33.3333', 'uploads/image14', 41, 'test exp', 'Online'),
(5, 'Yourself', 'Sardar', '+923215582381', 1, 'test', '31.413950', '73.120308', 'uploads/image15', 41, 'test', 'Offline'),
(6, 'Yourself', 'Sandra', '+92123123123', 1, 'Ffggggg', '37.785834', '-122.406417', 'uploads/image17', 41, 'Ffgfennheddf', 'Online'),
(7, 'Friend', 'Waqas hassan', '+923335925685', 3, 'Nothing', '33.55802204286965', '73.02187794819474', 'uploads/image19', 49, 'My name is khan', 'Online'),
(9, 'Yourself', 'Zaheer hasan ', '+926469494', 2, 'Xbbdb', '24.927423216562524', '67.19029085710645', 'uploads/image21', 44, 'Bbdbsbbs', 'Offline'),
(11, 'Friend', 'Boss', '+92123456789', 1, 'Awesome bro', '24.93245410688096', '67.17737233266234', 'uploads/image28', 44, 'Awesom work done in paat to do it again n agai ', 'Online'),
(12, 'Friend', 'Ahmrd', '+923335262532', 2, 'Bxbxbxnxnx', '33.550304543522515', '73.12298180535436', 'uploads/image29', 49, 'Hdjdhdhsjdjd', 'Online'),
(14, 'Friend', 'Hldhzkzgksgk', '+92=$6$6=6$8369', 2, 'Hdodyohdo', '33.549331320168285', '73.12411202117801', 'uploads/', 95, 'Yskhdk', 'Online'),
(16, 'Friend', 'Djdnjddjdh', '+92) $$!) &) & ', 2, 'Dhdbjdndi', '33.54933159959572', '73.12411235645413', 'uploads/', 53, 'Djdbdndjj', 'Offline'),
(17, 'undefined', 'jdfl;dasjkf', '+92389343948394', 6, 'ajkf;ldafjd', '37.425129577624745', '-122.08687802776694', 'uploads/', 57, '', 'Online'),
(18, 'undefined', 'jdkalfjdsf', '+9283849343984', 0, 'jdal;kfadfkjds;f', '37.4219983', '-122.084', 'uploads/', 57, '', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(3) NOT NULL,
  `parentid` int(3) NOT NULL,
  `subpagename` varchar(30) NOT NULL,
  `pageurl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `parentid`, `subpagename`, `pageurl`) VALUES
(2, 2, 'User Management', 'Employee'),
(8, 2, 'Customers', 'Customers'),
(23, 2, 'TimeSlot', 'TimeSlot'),
(24, 2, 'Vendors', 'Vendors'),
(25, 2, 'Brand/Item', 'Item'),
(26, 2, 'Orders', 'Orders'),
(27, 2, 'Price Configuration', 'PriceConfig'),
(28, 2, 'TimeSlot Price Configuration', 'TimeSlotPrice');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `tag_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_of_service`
--

CREATE TABLE `type_of_service` (
  `service_id` int(11) NOT NULL,
  `service_name` text NOT NULL,
  `type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Profession,1=Business'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_service`
--

INSERT INTO `type_of_service` (`service_id`, `service_name`, `type`) VALUES
(1, 'Plumber', '0'),
(2, 'Carpenter', '0'),
(3, 'Other', '0'),
(4, 'Car center', '0'),
(5, 'Easypaisa Shop', '1'),
(6, 'Software House', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `phone_no` text NOT NULL,
  `l_name` text NOT NULL,
  `dp` text NOT NULL DEFAULT 'uploads/client.jpeg',
  `joining_date` date NOT NULL,
  `password` text NOT NULL,
  `session` text NOT NULL,
  `user_status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0=User,1=Admin,2=Employee,3=Vendor',
  `dashboard` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Hide,1=Show',
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `f_name`, `phone_no`, `l_name`, `dp`, `joining_date`, `password`, `session`, `user_status`, `dashboard`, `country`) VALUES
(5, '', '034255820', 'admin@gmail.com', 'uploads/client1.jpeg', '2020-02-21', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1707bad43d82f3f61add0add968f92d3', '1', '1', ''),
(57, 'Zaid', '+923051370433', 'Qureshi', 'uploads/client.jpeg', '2021-05-18', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '89df2207212f9f4ed127cdb981cb2bc9', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_new`
--

CREATE TABLE `users_new` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `do` text NOT NULL,
  `b` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_new`
--

INSERT INTO `users_new` (`id`, `name`, `do`, `b`) VALUES
(1, 'dsafhkj', 'sdafhjksdfh', 'hdfjkh');

-- --------------------------------------------------------

--
-- Table structure for table `user_rights`
--

CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights`
--

INSERT INTO `user_rights` (`id`, `u_id`, `page_id`) VALUES
(71, 3, 1),
(72, 3, 2),
(73, 3, 3),
(85, 10, 2),
(91, 11, 23),
(92, 11, 25),
(96, 6, 2),
(97, 6, 8),
(98, 6, 23),
(99, 6, 24),
(100, 6, 25),
(104, 21, 2),
(105, 21, 8),
(106, 21, 25);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `work_id` int(11) NOT NULL,
  `looking_for` text NOT NULL,
  `title` text NOT NULL,
  `job_details` text NOT NULL,
  `tags` text DEFAULT NULL,
  `phone_no` text NOT NULL,
  `lat` text NOT NULL,
  `longi` text NOT NULL,
  `image` text NOT NULL,
  `u_id` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`work_id`, `looking_for`, `title`, `job_details`, `tags`, `phone_no`, `lat`, `longi`, `image`, `u_id`, `date`) VALUES
(1, '1', 'plumber', 'shfdkasdf akshfkjashfkjs kjahfsdafksda  hhasjfhsdkf ', NULL, '+923215582381', '73.120308', '31.413950', 'uploads/image16', '41', '2020-05-15 16:07:23'),
(2, '1', 'Plumber at Rex city', 'Tested traerk jagsdft auisfdsfkdasffjk ausidfksadhfkjhdsa sdfadsbfjkdash hsdhfjk sdfhsdkjfh ksdjhffh hsdfhkjdsf kh  jhkjsdfkjas d selfhood asdfjkasdh', NULL, '+923215582381', '37.784089860689065', '-122.40055348724127', 'uploads/image18', '41', '2020-05-16 17:04:44'),
(3, '3', 'Caroenter in area who xan do so', 'Jejjsjsjen', NULL, '+9297664949499', '24.929217054882656', '67.1865146420896', 'uploads/image22', '44', '2020-05-18 22:17:24'),
(4, '4', 'Behjdjs jsjsjjs jsjsjs', 'Jejjsjsj', NULL, '+9265664646', '24.844510039140083', '67.0274443924427', 'uploads/image23', '44', '2020-05-18 22:18:46'),
(5, '1', 'Plus ', 'Ghbg gjff jggv ', NULL, '+923215582381', '31.3799947', '73.0812362', 'uploads/image24', '41', '2020-05-29 20:48:07'),
(6, '2', 'G', 'Gg', NULL, '+92555', '31.37998995407198', '73.08122048154473', 'uploads/image25', '41', '2020-05-29 20:52:34'),
(7, '1', 'H', 'Fhghbbj bjgg ', NULL, '+92123', '31.378797772759064', '73.0830386839807', 'uploads/image26', '41', '2020-05-29 21:03:52'),
(8, '3', 'Bbb', 'Hhh', NULL, '+923335925685', '33.55593522037776', '73.02370151504874', '', '49', '2020-05-31 22:58:22'),
(9, '1', 'a plummbberr', 'I need a plber i need a plumber', NULL, '+923335451993', '33.555984964262095', '73.02332835271955', '', '50', '2020-06-02 01:17:57'),
(10, '3', 'Developer', 'A php developer', NULL, '+923215582381', '31.38012477122262', '73.08107832446694', '', '41', '2020-07-21 23:20:15'),
(11, '2', 'Test', 'Test', NULL, '+923215582381', '31.380125057458407', '73.08107832446694', '', '41', '2020-07-21 23:22:24'),
(13, '1', 'Hdvdbdb', 'Xhzbsnsbh', NULL, '+92&(@$!$)$/$!$/$)?$', '33.58492605280532', '73.10347275808454', 'uploads/', '51', '2021-03-30 00:08:01'),
(15, '4', ' Cx', '?? ', NULL, '+92192.168.1.3 ', '33.5492801', '73.123896', 'uploads/', '51', '2021-03-30 01:48:46'),
(18, '4', 'Udbdbdb', 'Jdbdbdjsj', NULL, '+9237939228727', '33.548829755191804', '73.1202664040029', 'uploads/', '53', '2021-04-13 06:59:29'),
(19, '1', 'Developer', 'Hi this is testing', NULL, '+923051370433', '33.55001869697811', '73.12265256419778', 'uploads/', '57', '2021-05-18 06:23:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgs`
--
ALTER TABLE `msgs`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `RecentSearches`
--
ALTER TABLE `RecentSearches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `type_of_service`
--
ALTER TABLE `type_of_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_new`
--
ALTER TABLE `users_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rights`
--
ALTER TABLE `user_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `msgs`
--
ALTER TABLE `msgs`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `RecentSearches`
--
ALTER TABLE `RecentSearches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_of_service`
--
ALTER TABLE `type_of_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users_new`
--
ALTER TABLE `users_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_rights`
--
ALTER TABLE `user_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
