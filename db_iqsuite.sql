-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2014 at 04:43 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_iqsuite`
--
CREATE DATABASE IF NOT EXISTS `db_iqsuite` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `db_iqsuite`;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE IF NOT EXISTS `tblcategory` (
  `c_id` int(25) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(100) NOT NULL,
  `c_status` int(11) NOT NULL,
  `c_adddate` varchar(25) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`c_id`, `c_name`, `c_status`, `c_adddate`) VALUES
(1, 'Uniforms', 0, '26/03/2014'),
(3, 'Sports', 0, '27/03/2014'),
(4, 'Lonely', 0, '22/04/2014');

-- --------------------------------------------------------

--
-- Table structure for table `tblcurrency`
--

CREATE TABLE IF NOT EXISTS `tblcurrency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `currency` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tblcurrency`
--

INSERT INTO `tblcurrency` (`id`, `country`, `currency`) VALUES
(19, 'Canada Dollar', 'CAD'),
(20, 'India Rupee', 'INR'),
(21, 'Qatar Riyal', 'QAR');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE IF NOT EXISTS `tblcustomer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_code` varchar(25) NOT NULL,
  `cust_name` varchar(200) NOT NULL,
  `cust_mobile` int(25) NOT NULL,
  `cust_email` varchar(150) DEFAULT NULL,
  `cust_address` longtext NOT NULL,
  `cust_type` varchar(50) NOT NULL,
  `cust_cname` varchar(100) DEFAULT NULL,
  `cust_addate` varchar(25) NOT NULL,
  `cust_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`id`, `cust_code`, `cust_name`, `cust_mobile`, `cust_email`, `cust_address`, `cust_type`, `cust_cname`, `cust_addate`, `cust_status`) VALUES
(1, 'CUST1', 'Aslam Pasha', 77819188, '-', '-', 'Individual', NULL, '30/03/2014', 1),
(2, 'CUST2', 'Iqlas uddin', 987654321, '-', '-', 'Individual', NULL, '30/03/2014', 1),
(3, 'CUST3', 'manzoor', 22333333, '-', '-', 'Individual', NULL, '30/03/2014', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblglobal`
--

CREATE TABLE IF NOT EXISTS `tblglobal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `global_cname` varchar(150) NOT NULL,
  `global_ctagline` varchar(150) DEFAULT NULL,
  `global_caddress` mediumtext NOT NULL,
  `global_clandline` int(25) NOT NULL,
  `global_mobile` int(20) NOT NULL,
  `global_fax` int(20) NOT NULL,
  `global_email` varchar(100) NOT NULL,
  `global_currency` varchar(10) NOT NULL,
  `global_logo` varchar(50) NOT NULL,
  `global_favicon` varchar(50) NOT NULL,
  `global_copyinfo` longtext NOT NULL,
  `global_copylink` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblglobal`
--

INSERT INTO `tblglobal` (`id`, `user`, `global_cname`, `global_ctagline`, `global_caddress`, `global_clandline`, `global_mobile`, `global_fax`, `global_email`, `global_currency`, `global_logo`, `global_favicon`, `global_copyinfo`, `global_copylink`) VALUES
(4, 'info@luckylilac.com', 'Lucky', 'Lucky Lilac', 'Qatar', 987654321, 987654321, 987654318, 'info@luckylilac.com', 'QAR', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE IF NOT EXISTS `tblinvoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `i_id` varchar(25) NOT NULL,
  `o_id` varchar(25) NOT NULL,
  `i_amount` double NOT NULL,
  `i_date` varchar(25) NOT NULL,
  `inv_pending` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `i_id`, `o_id`, `i_amount`, `i_date`, `inv_pending`) VALUES
(5, 'INV1', 'ORD8', 108, '26/03/2014', 0),
(6, 'INV2', 'ORD9', 1254, '26/03/2014', -46),
(7, 'INV3', 'ORD10', 165, '27/03/2014', -335),
(8, 'INV4', 'ORD13', 180, '27/03/2014', 0),
(9, '', '', 0, '30/03/2014', 0),
(10, 'INV5', 'ORD14', 1530, '30/03/2014', 0),
(11, 'INV7', 'ORD16', 225, '20/04/2014', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoiceitems`
--

CREATE TABLE IF NOT EXISTS `tblinvoiceitems` (
  `inv_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_id` varchar(6) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_rate` varchar(12) NOT NULL,
  `item_quantity` varchar(12) NOT NULL,
  PRIMARY KEY (`inv_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tblinvoiceitems`
--

INSERT INTO `tblinvoiceitems` (`inv_item_id`, `inv_id`, `item_name`, `item_rate`, `item_quantity`) VALUES
(30, '60001', 'khansa ', '35', '8'),
(31, '60001', 'hello world', '35', '8'),
(32, '60001', 'hello w', '987', '4'),
(36, '60001', 'mariyu', '45', '5'),
(37, '60001', 'hello w', '4', '3'),
(40, '60002', 'Khansa Mariyul', '55', '20'),
(41, '60002', 'Tshirt', '65', '10'),
(42, '60003', 'Khansa', '987', '45'),
(43, '60004', 'Khansa', '55', '50');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice_direct`
--

CREATE TABLE IF NOT EXISTS `tblinvoice_direct` (
  `inv_id` varchar(10) NOT NULL,
  `inv_date` varchar(16) DEFAULT NULL,
  `cust_name` varchar(128) DEFAULT NULL,
  `cust_contact` varchar(11) DEFAULT NULL,
  `discount` varchar(3) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `grand_total` varchar(12) DEFAULT NULL,
  `advancepayment` int(11) NOT NULL,
  `balancepayment` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`inv_id`),
  UNIQUE KEY `inv_id` (`inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinvoice_direct`
--

INSERT INTO `tblinvoice_direct` (`inv_id`, `inv_date`, `cust_name`, `cust_contact`, `discount`, `total`, `grand_total`, `advancepayment`, `balancepayment`, `status`) VALUES
('60001', '05/03/2014', 'Iqlas Uddin', '0987654321', '0', '4745', '4745', 4745, 0, 1),
('60002', '05/04/2014', 'hudhaifa', '1234567890', '10', '1750', '1575', 1575, 0, 1),
('60003', '05/04/2014', 'Suhail', '9837667362', '10', '44415', '39973.5', 8000, 31974, 1),
('60004', '05/04/2014', 'Abdul Qadir', '98765432', '0', '2750', '2750', 1250, 1500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE IF NOT EXISTS `tbllogin` (
  `u_id` int(25) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_mobile` int(25) NOT NULL,
  `u_address` varchar(150) NOT NULL,
  `u_type` varchar(25) NOT NULL,
  `u_status` int(2) NOT NULL,
  `u_adddate` varchar(20) NOT NULL,
  `u_lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`u_id`, `password`, `firstname`, `lastname`, `u_email`, `u_mobile`, `u_address`, `u_type`, `u_status`, `u_adddate`, `u_lastupdate`) VALUES
(1, 'lucky@2013', 'Lucky', 'Lucky Lilac WLL', 'info@luckylilac.com', 2147483647, 'qatar', '1', 1, '', '2014-03-26 07:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE IF NOT EXISTS `tblorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_code` varchar(50) NOT NULL,
  `ord_date` varchar(25) NOT NULL,
  `ord_delivery` varchar(25) DEFAULT NULL,
  `cust_name` varchar(150) NOT NULL,
  `cus_mobile` int(11) NOT NULL,
  `o_total` int(11) NOT NULL,
  `o_discount` int(3) DEFAULT NULL,
  `o_grand` int(11) NOT NULL,
  `inv_code` varchar(25) DEFAULT NULL,
  `inv_date` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`id`, `ord_code`, `ord_date`, `ord_delivery`, `cust_name`, `cus_mobile`, `o_total`, `o_discount`, `o_grand`, `inv_code`, `inv_date`, `status`) VALUES
(7, 'ORD1', '26/03/2014', '03/26/2014', 'Mohammed AfzalKhan', 2147483647, 3300, 5, 3135, NULL, NULL, 0),
(8, 'ORD8', '26/03/2014', '03/26/2014', 'Mohammed AfzalKhan', 2147483647, 110, 2, 108, 'INV1', '26/03/2014', 1),
(9, 'ORD9', '26/03/2014', '26/03/2014', 'Mohammed AfzalKhan', 2147483647, 1320, 5, 1254, 'INV2', '26/03/2014', 1),
(10, 'ORD10', '27/03/2014', '27/03/2014', 'Noora mohd', 33465499, 165, 0, 165, 'INV3', '27/03/2014', 1),
(11, 'ORD11', '27/03/2014', '03/31/2014', 'Aslam', 77819188, 110, 0, 110, NULL, NULL, 0),
(12, 'ORD12', '27/03/2014', '03/30/2014', 'muthaz', 30347495, 330, 0, 330, NULL, NULL, 0),
(13, 'ORD13', '27/03/2014', '27/03/2014', 'muthaz', 30347495, 180, 0, 180, 'INV4', '27/03/2014', 1),
(14, 'ORD14', '30/03/2014', '', 'manzoor', 22333333, 1530, 0, 1530, 'INV5', '30/03/2014', 1),
(15, 'ORD15', '18/04/2014', '04/19/2014', 'Iqlas uddin', 987654321, 90, 0, 90, NULL, NULL, 0),
(16, 'ORD16', '04/20/2014', '04/20/2014', ' Aslam Pasha', 77819188, 225, 0, 225, 'INV7', '20/04/2014', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_`
--

CREATE TABLE IF NOT EXISTS `tblorder_` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `ord_code` varchar(25) NOT NULL,
  `p_id` varchar(50) NOT NULL,
  `p_q` varchar(25) NOT NULL,
  `p_rate` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblorder_`
--

INSERT INTO `tblorder_` (`id`, `user`, `ord_code`, `p_id`, `p_q`, `p_rate`) VALUES
(1, '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_content`
--

CREATE TABLE IF NOT EXISTS `tblorder_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_code` varchar(50) DEFAULT NULL,
  `itm_code` varchar(25) NOT NULL,
  `p_quantity` varchar(25) NOT NULL,
  `p_rate` double NOT NULL,
  `inv_code` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `tblorder_content`
--

INSERT INTO `tblorder_content` (`id`, `ord_code`, `itm_code`, `p_quantity`, `p_rate`, `inv_code`) VALUES
(11, 'ORD1', 'ITM1', '56', 3080, NULL),
(12, 'ORD1', 'ITM1', '2', 110, NULL),
(13, 'ORD1', 'ITM1', '2', 110, NULL),
(14, 'ORD8', 'ITM1', '2', 110, 'INV1'),
(15, 'ORD9', 'ITM1', '24', 1320, 'INV2'),
(16, 'ORD10', 'ITM14', '3', 165, 'INV3'),
(20, 'ORD13', 'ITM1', '2', 90, 'INV4'),
(21, 'ORD13', 'ITM2', '2', 90, 'INV4'),
(22, 'ORD14', 'ITM1', '5', 225, 'INV5'),
(23, 'ORD14', 'ITM4', '2', 90, 'INV5'),
(24, 'ORD14', 'ITM2', '1', 45, 'INV5'),
(25, 'ORD14', 'ITM16', '9', 585, 'INV5'),
(26, 'ORD14', 'ITM16', '9', 585, 'INV5'),
(28, 'ORD16', 'ITM1', '5', 225, 'INV7');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_temp`
--

CREATE TABLE IF NOT EXISTS `tblorder_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `ord_code` varchar(25) NOT NULL,
  `p_id` varchar(50) NOT NULL,
  `p_q` int(11) NOT NULL,
  `p_rate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblrcpt`
--

CREATE TABLE IF NOT EXISTS `tblrcpt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rcpt_code` varchar(20) NOT NULL,
  `inv_code` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `method` varchar(10) NOT NULL,
  `ch_num` int(11) DEFAULT NULL,
  `ch_date` varchar(15) DEFAULT NULL,
  `ch_bank` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tblrcpt`
--

INSERT INTO `tblrcpt` (`id`, `rcpt_code`, `inv_code`, `date`, `amount`, `method`, `ch_num`, `ch_date`, `ch_bank`) VALUES
(1, 'REC1', 'INV2', '03/26/2014', 323, 'cash', NULL, NULL, NULL),
(2, 'REC2', 'INV1', '03/26/2014', 50, 'cash', NULL, NULL, NULL),
(3, 'REC3', 'INV1', '03/26/2014', 58, 'cheque', 987654321, '15/10/2014', 'Bangalore'),
(4, 'REC4', 'INV2', '03/26/2014', 1000, 'cash', NULL, NULL, NULL),
(5, 'REC5', 'INV3', '03/27/2014', 500, 'cash', NULL, NULL, NULL),
(6, 'REC6', 'INV2', '03/27/2014', 300, 'cash', NULL, NULL, NULL),
(7, 'REC7', 'INV5', '03/30/2014', 1530, 'cash', NULL, NULL, NULL),
(8, 'REC8', 'INV7', '04/20/2014', 225, 'cash', NULL, NULL, NULL),
(9, 'REC9', 'INV4', '04/20/2014', 60, 'cheque', 0, '03/19/2014', 'RT Nagar Bangalore'),
(10, 'REC10', 'INV4', '04/20/2014', 20, 'cheque', 987654321, '04/14/2014', 'kbl'),
(11, 'REC11', 'INV4', '04/20/2014', 100, 'cash', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstock`
--

CREATE TABLE IF NOT EXISTS `tblstock` (
  `itemid` int(25) NOT NULL AUTO_INCREMENT,
  `itemdate` varchar(20) NOT NULL,
  `itemcode` varchar(50) NOT NULL,
  `itemname` varchar(150) NOT NULL,
  `itemcategory` varchar(100) NOT NULL,
  `itembrand` varchar(150) NOT NULL,
  `itemuom` varchar(100) NOT NULL,
  `itemquantity` int(11) NOT NULL,
  `itemprice` int(25) NOT NULL,
  `itemsellingprice` int(25) NOT NULL,
  `itemstatus` int(2) NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `tblstock`
--

INSERT INTO `tblstock` (`itemid`, `itemdate`, `itemcode`, `itemname`, `itemcategory`, `itembrand`, `itemuom`, `itemquantity`, `itemprice`, `itemsellingprice`, `itemstatus`) VALUES
(25, '26/03/2014', 'ITM1', 'S size T-shirt', 'Sports', 'Abu ayub al ansari', 'MTR', 206, 0, 45, 1),
(26, '26/03/2014', 'ITM2', 'M-size T-Shirt', 'Sports', 'Abu ayub al ansari', 'MTR', 228, 0, 45, 1),
(27, '27/03/2014', 'ITM3', 'L-size T-shirt', 'Sports', 'Abu ayub al ansari', 'MTR', 228, 45, 45, 1),
(28, '27/03/2014', 'ITM4', 'XL-size Tshirt', 'Sports', 'Abu ayub al ansari', 'MTR', 94, 45, 45, 1),
(29, '27/03/2014', 'ITM5', 'XXL-size T-shirt', 'Sports', 'Abu ayub al ansari', 'MTR', 47, 45, 45, 1),
(30, '27/03/2014', 'ITM6', '4 size-shirt', 'Uniforms', 'Sumiya School', 'MTR', 77, 55, 55, 1),
(31, '27/03/2014', 'ITM7', '6-size shirt', 'Uniforms', 'Sumiya School', 'MTR', 68, 55, 55, 1),
(32, '27/03/2014', 'ITM8', '8-size shirt', 'Uniforms', 'Sumiya School', 'MTR', 65, 55, 55, 1),
(33, '27/03/2014', 'ITM9', '10-size shirt', 'Uniforms', 'Sumiya School', 'MTR', 36, 55, 55, 1),
(34, '27/03/2014', 'ITM10', '12-size shirt', 'Uniforms', 'Sumiya School', 'MTR', 30, 55, 55, 1),
(35, '27/03/2014', 'ITM11', '4-size shirt', 'Uniforms', 'Khansaa School', 'MTR', 76, 55, 55, 1),
(36, '27/03/2014', 'ITM12', '6-size shirt', 'Uniforms', 'Khansaa school', 'MTR', 70, 55, 55, 1),
(37, '27/03/2014', 'ITM13', '8-size shirt', 'Uniforms', 'Khansaa school', 'MTR', 84, 55, 55, 1),
(38, '27/03/2014', 'ITM14', '8-size Khansa shirt', 'Uniforms', 'Khansa School', 'MTR', 84, 55, 55, 1),
(39, '27/03/2014', 'ITM15', 'Khansa Mariol  S- SIZE', 'Uniforms', 'Khansa', 'MTR', 160, 65, 65, 1),
(40, '27/03/2014', 'ITM16', 'Khansa Mariol M- Size', 'Uniforms', 'khansa school', 'MTR', 140, 65, 65, 1),
(41, '27/03/2014', 'ITM17', 'Khansa Mariol L - SIZE', 'Uniforms', 'Khansa School', 'MTR', 69, 65, 65, 1),
(42, '27/03/2014', 'ITM18', 'Zubaida school-S - SIZE Mariol', 'Uniforms', 'Zubaida School', 'MTR', 93, 65, 65, 1),
(43, '27/03/2014', 'ITM19', 'Zubaida School M- Size Mariol', 'Uniforms', 'Zubauda School', 'MTR', 79, 65, 65, 1),
(44, '27/03/2014', 'ITM20', 'Zubaida School L -Size Mariol', 'Uniforms', 'Zubaida School', 'MTR', 46, 65, 65, 1),
(45, '27/03/2014', 'ITM21', 'S-Size Pants- SPORTS', 'Sports', 'Sports', 'MTR', 8, 50, 50, 1),
(46, '27/03/2014', 'ITM22', 'M- Size Sports Pants', 'Sports', 'Sports', 'MTR', 67, 50, 50, 1),
(47, '27/03/2014', 'ITM23', 'L - size Sports Pants', 'Sports', 'Sports', 'MTR', 99, 50, 50, 1),
(48, '27/03/2014', 'ITM24', 'XL Size Sports Pants', 'Sports', 'Sports', 'MTR', 166, 50, 50, 1),
(49, '27/03/2014', 'ITM25', 'XXL - Size Sports Pants', 'Sports', 'Sports', 'MTR', 64, 50, 50, 1),
(50, '27/03/2014', 'ITM26', '3XL-Size Sports Pants', 'Sports', 'Sports', 'MTR', 1, 50, 50, 1),
(51, '27/03/2014', 'ITM27', 'XL-Size Elastic Sports Pants', 'Sports', 'Sports', 'MTR', 26, 50, 50, 1),
(52, '27/03/2014', 'ITM28', 'L-Size Elastic Sports Pants', 'Sports', 'Sports', 'MTR', 2, 50, 50, 1),
(53, '27/03/2014', 'ITM29', 'XXL-Size Elastic Sports Pants', 'Sports', 'Sports', 'MTR', 2, 50, 50, 1),
(54, '27/03/2014', 'ITM30', 'S-Size Khadeeja Sports Pants', 'Sports', 'Sports', 'MTR', 13, 50, 50, 1),
(55, '27/03/2014', 'ITM31', 'M-Size Khadeeja Sports Pants', 'Sports', 'Sports', 'MTR', 24, 50, 50, 1),
(56, '27/03/2014', 'ITM32', 'S-Size Khadeeja Sports Pants', 'Sports', 'Sports', 'MTR', 23, 40, 40, 1),
(57, '27/03/2014', 'ITM33', 'XS-Size Khadeeja Sports T Shirt', 'Sports', 'Sports', 'MTR', 1, 40, 40, 1),
(58, '27/03/2014', 'ITM34', 'M-Size Khadeeja Sports T Shirt', 'Sports', 'Sports', 'MTR', 16, 40, 40, 1),
(59, '27/03/2014', 'ITM35', 'L-Size Khadeeja Sports T Shirt', 'Sports', 'Sports', 'MTR', 2, 40, 40, 1),
(60, '27/03/2014', 'ITM36', 'XL-Size Khadeeja Sports T Shirt', 'Sports', 'Sports', 'MTR', 23, 40, 40, 1),
(61, '27/03/2014', 'ITM37', 'XXL-Size Khadeeja Sports T Shirt', 'Sports', 'Sports', 'MTR', 5, 40, 40, 1),
(62, '27/03/2014', 'ITM38', '3XL-Size Khadeeja Sports T Shirt', 'Sports', 'Sports', 'MTR', 7, 40, 40, 1),
(63, '27/03/2014', 'ITM39', 'S-Size Khansaa Sports T Shirt', 'Sports', 'Sports', 'MTR', 26, 40, 40, 1),
(64, '27/03/2014', 'ITM40', 'L-Size Khansa Sports T Shirt', 'Sports', 'Sports', 'MTR', 34, 40, 40, 1),
(65, '27/03/2014', 'ITM41', 'XL-Size Khansa Sports T Shirt', 'Sports', 'Sports', 'MTR', 53, 40, 40, 1),
(66, '27/03/2014', 'ITM42', 'XXL-Size Khansa Sports T Shirt', 'Sports', 'Sports', 'MTR', 10, 40, 40, 1),
(67, '27/03/2014', 'ITM43', '3XL-Size Khansa Sports T Shirt', 'Sports', 'Sports', 'MTR', 11, 40, 40, 1),
(68, '27/03/2014', 'ITM44', 'S-Size Hafsa Sports T Shirt', 'Sports', 'Sports', 'MTR', 89, 40, 40, 1),
(69, '27/03/2014', 'ITM45', 'M-Size Hafsa Sports T Shirt', 'Sports', 'Sports', 'MTR', 66, 40, 40, 1),
(70, '27/03/2014', 'ITM46', 'L-Size Hafsa Sports T Shirt', 'Sports', 'Sports', 'MTR', 89, 40, 40, 1),
(71, '27/03/2014', 'ITM47', 'XL-Size Hafsa Sports T Shirt', 'Sports', 'Sports', 'MTR', 86, 40, 40, 1),
(72, '27/03/2014', 'ITM48', 'XXL-Size Hafsa Sports T Shirt', 'Sports', 'Sports', 'MTR', 104, 40, 40, 1),
(73, '27/03/2014', 'ITM49', '3XL-Size Hafsa Sports T Shirt', 'Sports', 'Sports', 'MTR', 54, 40, 40, 1),
(74, '27/03/2014', 'ITM50', 'White Line Black Pants', 'Sports', 'Sports', 'MTR', 40, 50, 50, 1),
(75, '27/03/2014', 'ITM51', 'S-Size Hafsa Jacket', 'Sports', 'Sports', 'MTR', 47, 60, 60, 1),
(76, '27/03/2014', 'ITM52', 'M-Size Hafsa Jacket', 'Sports', 'Sports', 'MTR', 182, 60, 60, 1),
(77, '27/03/2014', 'ITM53', 'L-Size Hafsa Jacket', 'Sports', 'Sports', 'MTR', 133, 60, 60, 1),
(78, '27/03/2014', 'ITM54', 'XL-Size Hafsa Jacket', 'Sports', 'Sports', 'MTR', 70, 60, 60, 1),
(79, '27/03/2014', 'ITM55', 'XXL-Size Hafsa Jacket', 'Sports', 'Sports', 'MTR', 11, 60, 60, 1),
(80, '27/03/2014', 'ITM56', 'XS-Size Khadeeja Jacket', 'Sports', 'Sports', 'MTR', 6, 60, 60, 1),
(81, '27/03/2014', 'ITM57', 'S-Size Khadeeja Jacket', 'Sports', 'Sports', 'MTR', 1, 60, 60, 1),
(82, '27/03/2014', 'ITM58', 'XS-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 43, 60, 60, 1),
(83, '27/03/2014', 'ITM59', 'S-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 110, 60, 60, 1),
(84, '27/03/2014', 'ITM60', 'M-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 148, 60, 60, 1),
(85, '27/03/2014', 'ITM61', 'L-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 48, 60, 60, 1),
(86, '27/03/2014', 'ITM62', 'XL-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 80, 60, 60, 1),
(87, '27/03/2014', 'ITM63', 'XXL-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 12, 60, 60, 1),
(88, '27/03/2014', 'ITM64', '3XL-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 10, 60, 60, 1),
(89, '27/03/2014', 'ITM65', '16-Size Khansa Jacket', 'Sports', 'Sports', 'MTR', 42, 60, 60, 1),
(90, '27/03/2014', 'ITM66', '29/30 white shirt', 'Uniforms', 'white', 'MTR', 25, 55, 55, 1),
(91, '27/03/2014', 'ITM67', '31/32 white shirt', 'Uniforms', 'white', 'MTR', 86, 55, 55, 1),
(92, '27/03/2014', 'ITM68', '33/34 white shirt', 'Uniforms', 'white', 'MTR', 120, 55, 55, 1),
(93, '27/03/2014', 'ITM69', '35/36 white shirt', 'Uniforms', 'white', 'MTR', 94, 55, 55, 1),
(94, '27/03/2014', 'ITM70', '37/38 white shirt', 'Uniforms', 'white', 'MTR', 35, 55, 55, 1),
(95, '27/03/2014', 'ITM71', '39/40 white shirt', 'Uniforms', 'white', 'MTR', 27, 55, 55, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluom`
--

CREATE TABLE IF NOT EXISTS `tbluom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbluom`
--

INSERT INTO `tbluom` (`id`, `u_name`) VALUES
(1, 'MTR'),
(2, 'LTR'),
(3, 'NOS'),
(4, 'KGS'),
(5, 'LBS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instrec`
--

CREATE TABLE IF NOT EXISTS `tbl_instrec` (
  `instrec_no` varchar(10) COLLATE utf8_bin NOT NULL,
  `instrec_inv_no` varchar(10) COLLATE utf8_bin NOT NULL,
  `instrec_date` varchar(25) COLLATE utf8_bin NOT NULL,
  `instrec_amt` int(11) NOT NULL,
  PRIMARY KEY (`instrec_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_instrec`
--

INSERT INTO `tbl_instrec` (`instrec_no`, `instrec_inv_no`, `instrec_date`, `instrec_amt`) VALUES
('4001', '60001', '05/04/2014', 500),
('4002', '60001', '05/04/2014', 200),
('4003', '60001', '05/04/2014', 4045),
('4004', '60002', '05/04/2014', 200),
('4005', '60002', '05/04/2014', 500),
('4006', '60002', '05/04/2014', 875),
('4007', '60003', '05/04/2014', 8000),
('4008', '60004', '05/04/2014', 1250);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
