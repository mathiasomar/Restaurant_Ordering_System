-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2017 at 09:24 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pathfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `punchline` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `menu_image` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedate` timestamp NOT NULL DEFAULT current_timestamp() on update current_timestamp,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `menu_name`, `punchline`, `description`, `menu_image`, `status`, `regdate`, `updatedate`) VALUES
(1, 'Indian', 'Indian favorite food', 'Description Here', 'IMG-20220419-WA0001.jpg', '1', NULL, NULL),
(2, 'Swahili', 'Most delicius and favorite swahili dishes', 'Description Here', 'IMG-20220419-WA0005.jpg', '1', NULL, NULL);

--
-- Table structure for table `tbl_item_type`
--

CREATE TABLE IF NOT EXISTS `tbl_item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_item_type`
--

INSERT INTO `tbl_item_type` (`id`, `item_type`) VALUES
(1, 'Non-Veg'),
(2, 'Veg');

--
-- Table structure for table `tbl_item`
--

CREATE TABLE IF NOT EXISTS `tbl_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `item_cost` decimal(10,2) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `item_image` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(10) NOT NULL,
  `is_most_selling_item` varchar(20) not null,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`menu_id`) REFERENCES tbl_menu(`id`),
  FOREIGN KEY(`item_type_id`) REFERENCES tbl_item_type(`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`id`, `item_name`, `menu_id`, `item_cost`, `item_type_id`, `item_image`, `description`, `status`, `is_most_selling_item`) VALUES
(1, 'Biriyan', '1', '300', '1', 'IMG-20220419-WA0001.jpg', 'Description here', '1', 'Yes'),
(2, 'Pilau', '2', '200', '1', 'IMG-20220419-WA0004.jpg', 'Description here', '1', 'Yes');

--
-- Table structure for table `tbl_addons`
--

CREATE TABLE IF NOT EXISTS `tbl_addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(500) NOT NULL,
  `addon_image` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE IF NOT EXISTS `tbl_offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_name` varchar(100) NOT NULL,
  `offer_cost` decimal(10,2) NOT NULL,
  `offer_start_date` date NOT NULL,
  `offer_valid_date` date NOT NULL,
  `offer_condition` varchar(500) NOT NULL,
  `offer_image` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_offer_items`
--

CREATE TABLE IF NOT EXISTS `tbl_offer_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(15) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY(`offer_id`) REFERENCES tbl_offer(`id`),
  FOREIGN KEY(`menu_id`) REFERENCES tbl_menu(`id`),
  FOREIGN KEY(`item_id`) REFERENCES tbl_item(`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE IF NOT EXISTS `tbl_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(100) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_phone` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_faqs_category`
--

CREATE TABLE IF NOT EXISTS `tbl_faqs_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `status` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE IF NOT EXISTS `tbl_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `answer` varchar(300) NOT NULL,
  `status` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`category`) REFERENCES `tbl_faqs_category`
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_contactus_info`
--

CREATE TABLE IF NOT EXISTS `tbl_contactus_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `call_number` varchar(15) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `whatsapp` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_contactus_info`
--

INSERT INTO `tbl_contactus_info` (`id`, `email`, `call_number`, `instagram`, `whatsapp`) VALUES
(1, 'pathfinder@gmail.com', '0745293854', '@path__restaurant', '0706345123');

--
-- Table structure for table `tbl_contactus_query`
--

CREATE TABLE IF NOT EXISTS `tbl_contactus_query` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` mediumtext NOT NULL,
  `status` int(15) NOT NULL,
  `postdate` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(100) NOT NULL,
  `order_date` timestamp DEFAULT current_timestamp(),
  `order_item` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `status` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY(`order_item`) REFERENCES tbl_item(`id`),
  FOREIGN KEY(`customer`) REFERENCES tbl_customers(`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_page`
--

CREATE TABLE IF NOT EXISTS `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `page_name`, `type`, `text`) VALUES
(1, 'About Us', 'aboutus', 'About Us details'),
(2, 'Terms & Services', 'terms', 'Terms & Services details'),
(3, 'Privacy', 'privacy', 'Privacy details');

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE IF NOT EXISTS `tbl_subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `regdate` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_testimonial`
--

CREATE TABLE IF NOT EXISTS `tbl_testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `testimonial` mediumtext NOT NULL,
  `status` int(15)  NOT NULL,
  `post_date` timestamp DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
