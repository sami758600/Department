-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2013 at 11:21 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nirulawise`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) NOT NULL,
  `achievement_desc` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `category_id`, `achievement_desc`) VALUES
(1, 2, 0x536b2e466179616420676f742034746820506c61636520696e204a4e54554b20496e74657220556e69766572736974792054656e6e697320546f75726e616d656e7420496e20323031302e),
(2, 0, ''),
(3, 2, 0x54656a617377696e69203173742052616e6b20696e204669727374205965617220526573756c747320436f6e647563746564204279204a4e54554b20496e20323030382e);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'customer id is auto increament and primary key',
  `adminname` varchar(200) NOT NULL COMMENT 'user name',
  `password` varchar(50) NOT NULL COMMENT 'customer password is stored',
  `mail_id` varchar(500) NOT NULL COMMENT 'customer mail_id is stored',
  `firstname` varchar(500) NOT NULL COMMENT 'customer first name is stored',
  `lastname` varchar(500) NOT NULL COMMENT 'customer last name is stored',
  `gender` varchar(200) NOT NULL COMMENT 'gender',
  `address` varchar(25) NOT NULL COMMENT 'customer address is stored',
  `mobile_no` bigint(20) NOT NULL COMMENT 'customers mobile no is stored',
  `qualification` varchar(200) NOT NULL COMMENT 'Qualification',
  `image` varchar(500) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'customer created date and time is stored',
  `last_access` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'customer login time and date is stored',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`adminname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Users details are stored' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `password`, `mail_id`, `firstname`, `lastname`, `gender`, `address`, `mobile_no`, `qualification`, `image`, `created_on`, `last_access`) VALUES
(1, 'ithod', 'ff579cacc72253b9d3d41c4369fc090fa7a72dd3', 'it.nirula@gmail.com', 'IT', 'Department', '', 'Palakalur Road', 0, '', 'ithod.png', '2013-02-04 11:30:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) NOT NULL,
  `alumni_desc` blob NOT NULL,
  `alumni_img` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `alumni`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'document'),
(2, 'non_document');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_code` varchar(500) NOT NULL,
  `class_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_code`, `class_name`) VALUES
(0, 'passout', 'Pass Out'),
(1, 'IV IT', '4th Year IT SEM I'),
(2, 'III IT', '3rd Year IT SEM I'),
(3, 'II IT', '2nd Year IT SEM I'),
(4, 'I IT', '1st Year IT SEM I'),
(6, 'IV IT', '4th Year IT SEM II'),
(7, 'III IT', '3rd Year IT SEM II'),
(8, 'II IT', '2nd Year IT SEM II');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `type` varchar(100) NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `comment` blob NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `type`, `qualification`, `designation`, `comment`, `image`) VALUES
(1, 'Bhanu Prakash Battula', 'ithod', 'M.Tech,(PhD)', 'Head of the Department', 0x546865204465706172746d656e74206f6620496e666f726d6174696f6e20546563686e6f6c6f6779206973206c656176696e67206e6f2073746f6e6520756e7475726e656420746f20656e61626c652074686520796f756e6720627261696e7320746f20657863656c20696e20746865206669656c64206f6620546563686e6f6c6f67792061732077656c6c20617320536f66747761726520456e67696e656572696e672e205370656369616c20666f637573206973206f6e206f766572616c6c20706572736f6e616c69747920646576656c6f706d656e74206f662074686520696e646976696475616c2073747564656e7420616e642070726f766964696e6720496e647573747269616c206f7269656e746174696f6e20746f207468656d2e20546865204465706172746d656e7420697320776f726b696e6720746f776172647320696d70617274696e6720746865206c6174657374207472656e647320746563686e6f6c6f676963616c204b6e6f776c6564676520616e6420686f6e696e672074686520796f756e67206d696e647320746f206265636f6d65205175616c69747920456e67696e6565727320746f2062652072656164696c79206162736f726265642062792074686520496e64757374726965732e, 'ithod.png'),
(2, 'Dr. Paturi Radhika', 'principal', 'M.Tech, PhD', 'PRINCIPAL', 0x4954207374617274656420696e207468652079656172206f6620323030382c20776974682039302073747564656e74732e, 'principal.png'),
(3, 'Dr. Lavu Rathaiah', 'chairman', 'Ph.D', 'CHAIRMAN', 0x495420, 'adolfhitler.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type_id` int(11) NOT NULL,
  `event_name` varchar(500) NOT NULL,
  `event_desc` blob NOT NULL,
  `event_address` varchar(500) NOT NULL,
  `event_date` date NOT NULL,
  `reg_frm_date` date NOT NULL,
  `reg_to_date` date NOT NULL,
  `is_registration` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_type_id`, `event_name`, `event_desc`, `event_address`, `event_date`, `reg_frm_date`, `reg_to_date`, `is_registration`) VALUES
(1, 1, 'Quiz', 0x5175697a20636f6d7065746974696f6e, 'It Dept', '2013-01-01', '2012-11-16', '2012-12-31', 1),
(2, 1, 'Quiz', 0x546865, 'QUIZ', '2012-11-22', '2012-11-19', '2012-11-21', 1),
(3, 1, 'QUIZ COMPETITION', 0x524f554e442031095752495454454e205445535420284f532c2053452c2044424d532c20434e2c20432050524f4752414d4d494e47290d0a524f554e4420320947454e4552414c204b4e4f574c454447450d0a524f554e44203309544543484e4943414c20205155495a200d0a524f554e44203409454e5445525441494e4d454e54202853504f5254532c20504552534f4e414c4954592c204d4f56494553290d0a524f554e442035095241504944464952450d0a, 'Vignan,s Nirula Seminar Hall', '2012-07-18', '2012-07-07', '2012-07-14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_reg`
--

CREATE TABLE IF NOT EXISTS `event_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `event_reg`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_results`
--

CREATE TABLE IF NOT EXISTS `event_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `award` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `event_results`
--


-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `event_type`) VALUES
(1, 'Wise'),
(2, 'It Department');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` blob NOT NULL,
  `image_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `event_id`, `name`, `description`, `image_name`) VALUES
(7, -1, '1', 0x31, '1.png'),
(8, -1, '2', 0x32, '2.png'),
(9, -1, '3', 0x33, '3.png'),
(10, -1, '4', 0x34, '4.png'),
(11, -1, '5', 0x35, '5.png'),
(12, -1, '6', 0x36, '6.png'),
(13, -1, '7', 0x37, '7.png'),
(14, -1, '8', 0x38, '8.png'),
(15, -1, '10', 0x3130, '10.png'),
(16, -1, '11', 0x3131, '11.png'),
(17, -1, '12', 0x3132, '12.png'),
(18, -1, '13', 0x3133, '13.png'),
(19, -1, '14', 0x3134, '14.png'),
(20, -1, '15', 0x3135, '15.png'),
(21, -1, '16', 0x3136, '16.png'),
(22, -1, '17', 0x3137, '17.png'),
(23, -1, '18', 0x3138, '18.png'),
(25, -1, '19', 0x3139, '19.png'),
(26, -1, '20', 0x3230, '20.png'),
(27, -1, '21', 0x3231, '21.png'),
(28, -1, '22', 0x3232, '22.png'),
(29, -1, '23', 0x3233, '23.png'),
(30, -1, '24', 0x3234, '24.png'),
(31, -1, '25', 0x3235, '25.png'),
(32, -1, '26', 0x3236, '26.png'),
(33, -1, '27', 0x3237, '27.png'),
(34, -1, '28', 0x3238, '28.png'),
(35, -1, '29', 0x3239, '29.png'),
(36, -1, '30', 0x3330, '30.png'),
(119, 0, 'iitk1', '', 'iitk1.png'),
(120, 0, 'iitk2', '', 'iitk2.png'),
(121, 0, 'iitk3', '', 'iitk3.png'),
(123, 0, 'iitk5', '', 'iitk5.png'),
(124, 0, 'itk6', '', 'itk6.png'),
(126, 0, 'n1', '', 'n1.png'),
(127, 0, 'n2', '', 'n2.png'),
(128, 0, 'n3', '', 'n3.png'),
(129, 0, 'n5', '', 'n5.png'),
(130, 0, 'n6', '', 'n6.png'),
(131, 0, 'n7', '', 'n7.png'),
(132, 0, 'n8', '', 'n8.png'),
(133, 0, 'n9', '', 'n9.png'),
(134, 0, 'n10', '', 'n10.png'),
(135, 0, 'n11', '', 'n11.png'),
(136, 0, 'n12', 0x4e7373, 'n12.png'),
(137, 0, 'n13', 0x4e5353, 'n13.png'),
(138, 0, 'N15', 0x4e5353, 'n15.png'),
(139, 0, 'N16', 0x4e5353, 'n16.png'),
(140, 0, 'N19', 0x4e5353, 'n19.png'),
(141, 0, 'N21', 0x4e5353, 'n21.png'),
(142, 0, 'Q1', 0x5155495a, 'q1.png'),
(143, 0, 'Q2', 0x5155495a, 'q2.png'),
(144, 0, 'Q5', 0x5155495a, 'q5.png'),
(145, 0, 'Q5', 0x5155495a, 'q5.png'),
(146, 0, 'V1', 0x474c, 'v1.png'),
(147, 0, 'V2', 0x474c, 'v2.png'),
(148, 0, 'V3', 0x474c, 'v3.png'),
(149, 0, 'V4', 0x474c, 'v4.png'),
(150, 0, 'V5', 0x474c, 'v5.png'),
(151, 0, 'V6', 0x474c, 'v6.png'),
(152, 0, 'V7', 0x474c, 'v7.png'),
(153, 0, 'V8', 0x474c, 'v8.png'),
(154, 0, 'V9', 0x474c, 'v9.png'),
(155, 0, 'V10', 0x474c, 'v10.png'),
(157, 0, 'v21', 0x474c, 'v21.png'),
(158, 0, 'v22', 0x474c, 'v22.png'),
(159, -1, 'sambasiva rao', 0x646174616d696e6967, 'sambasivarao.png'),
(161, 0, 'dm1', 0x646d31, 'dm1.png'),
(162, 0, 'dm2', 0x646d32, 'dm2.png'),
(163, 0, 'dm3', 0x646d33, 'dm3.png'),
(164, 0, 'dm4', 0x646d34, 'dm4.png'),
(165, 0, 'dm5', 0x646d35, 'dm5.png'),
(166, 0, 'dm6', 0x646d36, 'dm6.png'),
(167, 0, 'dm7', 0x646d37, 'dm7.png'),
(168, 0, 'dm9', 0x646d39, 'dm9.png'),
(169, 0, 'dm10', 0x646d3130, 'dm10.png'),
(170, 0, 'dm11', 0x646d3131, 'dm11.png'),
(172, 0, 'dm13', 0x646d3133, 'dm13.png'),
(173, 0, 'dm14', 0x646d3134, 'dm14.png'),
(174, 0, 'dm15', 0x646d3135, 'dm15.png'),
(175, 0, 'dm17', 0x646d3137, 'dm17.png');

-- --------------------------------------------------------

--
-- Table structure for table `highlights`
--

CREATE TABLE IF NOT EXISTS `highlights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `high_light` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `highlights`
--

INSERT INTO `highlights` (`id`, `type`, `high_light`) VALUES
(5, 2, 0x45787465726e616c206c61627320666f722049492059656172204973656d20636f6d6d656e636520666f726d20397468206f6e77617264732e2e2e2e2e2e2e2e2e202020202020202020200d0a397468202d2039414d20746f20313220504d2049492049542041202d20454350204c41423b3b2020200d0a397468202d2031504d20746f203420504d2049492049542042202d20454350204c41423b3b2020200d0a31307468202d2039414d20746f20313220504d2049492049542041202d204453204c41423b203b20200d0a31307468202d2031504d20746f2034504d2049492049542042202d204453204c41423b3b0d0a31317468202d2041264220454443204c41423b3b),
(6, 2, 0x4a4e54554b20504f5354504f4e45442045585445524e414c204558414d2044415445530d0a464f5220495620594541522032375448204e4f562731322e0d0a49494920594541522032395448204e4f562731322e),
(7, 2, 0x436c617373657320636f6d6d656e63652066726f6d2032337264204e6f76656d62657220666f7220494949202620495620422e546563682073747564656e74732e),
(11, 1, 0x4775657374204c656374757265204f6e20202244617461204d696e696e672053636f706520616e64205369676e69666963616e74204361736520537475646965732c20446563656d62657220387468202c20323031322062792044722e422e53616d62617369766152616f2c20536369656e746973742c20496e6469616e204e6174696f6e616c2043656e74657220666f72204f6365616e20496e666f726d6174696f6e2053657276696365732028494e434f4953292c4d696e6973747279206f6620456172746820536369656e6365732c204879646572616261642e20),
(12, 2, 0x436c617373657320636f6d6d656e63652066726f6d2033726420446563656d6265722c3230313220666f7220494979722049492053656d2e20),
(13, 1, 0x4120576f726b73686f70206f6e20e2809c495420436f6e6e6578696f6e73e2809d2c20446563656d6265722032326e642c203230313220627920416e6472657773204d656573616c612c20546563686e6963616c204c656164204c617273656e202620546f7562726f20496e666f74656368204c696d697465642c2042616e67616c6f72652e);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` varchar(500) NOT NULL,
  `material_name` varchar(500) NOT NULL,
  `mater_file` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `sub_id`, `material_name`, `mater_file`) VALUES
(1, '5', 'Action Script', 'Action Script.pdf'),
(2, '5', 'Multimedia', 'unit-1.pdf'),
(3, '7', 'Computer Graphics', 'COMPUTER GRAPHICS.ppsx'),
(5, '9', '01 Introduction Network Models', '01 Introduction Network Models.pdf'),
(6, '9', '02 Circuit Switching and Telephone Network', '02 Circuit Switching and Telephone Network.pdf'),
(7, '9', '03 Data Link Layer Point-to-Point Access and Multiple Access', '03 Data Link Layer Point-to-Point Access and Multiple Access.pdf'),
(8, '9', '04 Wired Ethernet-based LANs Wireless LANs', '04 Wired Ethernet-based LANs Wireless LANs.pdf'),
(9, '9', '05 Connecting devices, backbone networks & VLANs Cellular Phones and Satellite Networks', '05 Connecting devices, backbone networks & VLANs Cellular Phones and Satellite Networks.pdf'),
(10, '2', 'Network Programming', 'UnixNetworkProgramming_all.pdf'),
(11, '15', 'DP', 'DP.rar'),
(12, '17', 'DAA', 'DAA.rar');

-- --------------------------------------------------------

--
-- Table structure for table `placements`
--

CREATE TABLE IF NOT EXISTS `placements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) NOT NULL,
  `placement_desc` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `placements`
--

INSERT INTO `placements` (`id`, `category_id`, `placement_desc`) VALUES
(2, 1, 0x323030382d313220426174636820506c6163616d656e74732424706c6163656d656e74732e646f6378);

-- --------------------------------------------------------

--
-- Table structure for table `prev_papers`
--

CREATE TABLE IF NOT EXISTS `prev_papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_id` int(11) NOT NULL,
  `paper_name` varchar(500) NOT NULL,
  `paper_file` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `prev_papers`
--

INSERT INTO `prev_papers` (`id`, `subj_id`, `paper_name`, `paper_file`) VALUES
(2, 5, '2010', 'mad 2010.pdf'),
(8, 1, '2010', '2010 is.pdf'),
(9, 2, '2010', '2010 np.pdf'),
(10, 3, '2010', '2010 SPM.pdf'),
(11, 4, '2010', '2010 es.pdf'),
(12, 6, '2010', '2010 mc.pdf'),
(13, 7, '2011 R07', 'COMPUTER GRAPHICS.pdf'),
(14, 9, '2011 R07', 'COMPUTER NET WORKS.PDF'),
(15, 13, '2011 R07', 'WEB TECHNOLOGIES.pdf'),
(16, 1, '2011', '2011 IS.pdf'),
(17, 2, '2011', 'NETWORK PROGRAMMING.pdf'),
(18, 3, '2011', 'SOFTWARE PROJECT MANAGEMENT.pdf'),
(19, 4, '2011', 'EMBEDDED SYSTEMS.pdf'),
(20, 5, '2011', 'MULTIMEDIA AND APPLICATION DEVELOPMENT.pdf'),
(21, 6, '2011', 'MOBILE COMPUTING.PDF'),
(23, 14, '2011', '2011 MANAGEMENT SCIENCE.pdf'),
(24, 15, '2011', '2011 DESIGN PATTERNS.pdf'),
(25, 16, '2011', '2011 NETWORK MANAGEMENT SYSTEMS.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_code` varchar(500) NOT NULL,
  `section_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `class_id`, `section_code`, `section_name`) VALUES
(1, 1, 'IV IT A SEC ', '4th IT A Section'),
(2, 2, 'III IT A Sec', '3rd IT A Sec'),
(3, 3, 'II IT A Sec', '2nd IT A Section'),
(4, 3, 'II IT B Sec', '2nd IT B Section'),
(5, 4, 'I IT A Sec', '1st IT A Section'),
(6, 4, 'I IT B Sec', '1st IT B Section');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_categ_id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `designation` varchar(500) NOT NULL,
  `industry_exp` varchar(500) NOT NULL,
  `teach_exp` varchar(500) NOT NULL,
  `research` varchar(500) NOT NULL,
  `publ_national` blob NOT NULL COMMENT 'national wise publications',
  `publ_international` blob NOT NULL COMMENT 'inter-national wise publications',
  `conf_national` blob NOT NULL COMMENT 'national wise conferences',
  `conf_international` blob NOT NULL COMMENT 'inter-national wise conferences',
  `e_mail` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_categ_id`, `first_name`, `last_name`, `qualification`, `designation`, `industry_exp`, `teach_exp`, `research`, `publ_national`, `publ_international`, `conf_national`, `conf_international`, `e_mail`, `image`) VALUES
(1, 1, 'Bhanu Prakash', 'Battula', 'M.Tech, (PhD)', 'HOD', '', '7', 'Information Security', 0x31, 0x34, 0x32, 0x32, 'prakashbattula@yahoo.com', 'BhanuPrakashBattula.png'),
(2, 1, 'DINESH', 'DIDLA', 'M.Tech', 'Assistant Professor', '-', '3 Years', '', '', '', '', '', '', 'DINESHDIDLA.png'),
(3, 1, 'MOULANA', 'MOHAMMED', 'M.Tech.,(Ph.D)', 'Assistant Professor', '-', '6 Years', 'Data Mining', 0x30, 0x34, 0x32, 0x33, 'mdmmsc@gmail.com', 'mohammedmoulana.png'),
(4, 2, 'Rama Krishna', 'Kamineni', 'B.Com', 'DEO', '', '', '', '', '', '', '', 'kameneni@gmail.com', 'kamineniramakrishna.png'),
(5, 2, 'Shakila Sk', '', 'SSC', 'Atender', '', '', '', '', '', '', '', '', 'skshakila.png'),
(6, 1, 'KrishnaChaitanya', ' Koppineedi', 'M.Tech', 'Assistant Professor', '-', '2 Years', '', '', 0x33, 0x31, '', 'chaitanyakoppineedi@gmail.com', 'krishnachaitanyak.png'),
(7, 1, 'Srinivas Praveen', 'Gudhi', 'M.Tech.,', 'Assistant Professor', '3 Years', '3 Years', '', '', '', '', '', 'srinivaspraveen.gudhi@gmail.com', 'SrinivasPraveenGudhi.png'),
(8, 1, 'Bala Krishna', 'K', ' M.Tech.,', 'Assistant Professor', '-', '4 Years', '', '', '', '', '', 'balu.kancherla@gmail.com', 'balakrishnak.png'),
(9, 1, 'Venkata Rao', 'M', 'M.Tech.,', 'Assistant Professor', '2 Years', '2 Years', '', '', '', '', '', 'venkatmaddumala@gmail.com', 'VenkataRaoM.png'),
(10, 1, 'Pavani', 'V', 'M.Tech', 'Assistant Professor', '', '1 Year', '', '', '', '', '', 'manojpavani81@gmail.com', 'pavaniv.png'),
(12, 1, 'Venkata Sesha Sai', 'Ramakrishna', 'M.Tech', 'Asst.Proffessor', '2', '4.5', '', '', '', '', '', 'ksai.mb@gmail.com', 'venkataseshasairamakrishna.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff_category`
--

CREATE TABLE IF NOT EXISTS `staff_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staff_category`
--

INSERT INTO `staff_category` (`id`, `category_name`) VALUES
(1, 'Teaching'),
(2, 'Non Teaching');

-- --------------------------------------------------------

--
-- Table structure for table `stream`
--

CREATE TABLE IF NOT EXISTS `stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stream_code` varchar(500) NOT NULL,
  `stream_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `stream`
--

INSERT INTO `stream` (`id`, `stream_code`, `stream_name`) VALUES
(1, 'IT', 'Information Technology'),
(2, 'CSE', 'Computer science & Enginering'),
(5, 'ECE', 'Electronics and Communication Engineering'),
(6, 'EEE', 'Electronics and Electrical Engineering'),
(7, 'Other', 'Any Other Branch');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_code` varchar(500) NOT NULL,
  `sub_name` varchar(500) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `sub_code`, `sub_name`, `class_id`) VALUES
(1, 'IS', 'Information Security', 1),
(2, 'NP', 'Network Programming', 1),
(3, 'SPM', 'Software Project Management', 1),
(4, 'ES', 'Embeded Systems', 1),
(5, 'MAD', 'Multimedia And Application Developement', 1),
(6, 'MC', 'Mobile Computing', 1),
(7, 'CG', 'Computer Graphics', 2),
(8, 'ADS', 'Adv Data Stractures', 2),
(9, 'CN', 'Computer Networks', 2),
(10, 'OS', 'Opreting System', 2),
(11, 'SE', 'Softwre Engineering', 2),
(12, 'WT', 'Web Technology', 0),
(13, 'WT', 'Web Technology', 2),
(14, 'MS', 'MANAGEMENT SCIENCE', 6),
(15, 'DP', 'DESIGN PATTERN', 6),
(16, 'NMS', 'NETWORK MANAGEMENT SYSTEMS', 6),
(17, 'DAA', 'DESIGN AND ANALYSIS OF ALGORITHMS', 7),
(18, 'UNIX', 'UNIX', 7),
(19, 'OOAD', 'OBJECT ORIENTED ANALYSIS AND DESIGN', 7),
(20, 'ACN', 'ADV COMPUTER NETWORKS', 7),
(21, 'AJP', 'ADV JAVA PROGAMMING', 7),
(22, 'MS', 'MANAGEMENT SCIENCE', 7),
(23, 'DC', 'DATA COMMUNICATION', 8),
(24, 'PPL', 'PRINCIPLES OF PROGRAMINNG LANGUAGES', 8),
(25, 'OOPS', 'OBJECT ORIENTED PROGRAMMING', 8),
(26, 'CO', 'COMPUTER ORGANIZATION AND ARCHITECTURE', 8),
(27, 'DBMS', 'DATABASE MANAGEMENT SYSTEMS', 8),
(28, 'ACD', 'AUTOMATA AND COMPILER DESIGN', 8);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE IF NOT EXISTS `syllabus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `syllabus_name` varchar(500) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `syllabus_name`, `class_id`) VALUES
(1, 'Syllabus-B.TechII YEAR.R10.pdf', 3),
(2, 'IT 4th year.pdf', 1),
(3, 'B.Tech. I Year.pdf', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'customer id is auto increament and primary key',
  `username` varchar(200) NOT NULL COMMENT 'user name',
  `password` varchar(50) NOT NULL COMMENT 'user password is stored',
  `mail_id` varchar(500) NOT NULL COMMENT 'user mail_id is stored',
  `firstname` varchar(50) NOT NULL COMMENT 'user first name is stored',
  `lastname` varchar(50) NOT NULL COMMENT 'user last name is stored',
  `gender` varchar(20) NOT NULL COMMENT 'gender',
  `address` varchar(25) NOT NULL COMMENT 'user address is stored',
  `mobile_no` bigint(20) NOT NULL COMMENT 'user mobile no is stored',
  `batch_id` int(11) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `section` smallint(6) NOT NULL COMMENT 'section',
  `admission_id` varchar(300) NOT NULL COMMENT 'Admission Id',
  `image` varchar(500) NOT NULL COMMENT 'Image Of User',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'customer created date and time is stored',
  `last_access` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'customer login time and date is stored',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Users details are stored' AUTO_INCREMENT=76 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail_id`, `firstname`, `lastname`, `gender`, `address`, `mobile_no`, `batch_id`, `stream_id`, `section`, `admission_id`, `image`, `created_on`, `last_access`, `status`) VALUES
(1, '09NN1A1202', '2e7d766265011e75021c4410b13c8b2f6bc5562c', 'sushma@gmail.com', 'ALURU', 'SUSHMA', 'female', 'guntur', 0, 2, 1, 1, '09NN1A1202', 'user_09NN1A1202.png', '2012-10-10 16:03:43', '0000-00-00 00:00:00', 1),
(2, '10NN1A1267', 'b5db2e18571e255998b1cb4e54d7b299b4e00699', 'it.nirula@gmail.com', 'Jaya Deepthi', 'T', 'female', 'vignan''s Nirula Institute', 9912976339, 3, 1, 2, '10NN1A1267', 'user_10NN1A1267.png', '2012-11-06 12:02:51', '0000-00-00 00:00:00', 1),
(4, '09NN1A1246', '2ce9e2cf1bf06e69d3b45df7e4eb8bfd9806b09b', '', 'Silpa', 'Perni', 'female', 'Dept.of.IT', 0, 2, 1, 1, '09NN1A1246', 'user_09NN1A1246.png', '2012-11-09 10:49:49', '0000-00-00 00:00:00', 1),
(5, '10NN1A1253', '7fc2e56020f35cb90fbf0aae5474aefc2973f097', '', 'Madhuri', 'P', 'female', 'Dept.of.IT', 0, 3, 1, 0, '10NN1A1253', 'user_10NN1A1253.png', '2012-11-09 10:51:30', '0000-00-00 00:00:00', 1),
(6, '09NN1A1245', '1f6b58a47b4e752ea3454a0903343d6ed4ff5701', '', 'Anusha', 'Pappu', 'female', 'Dept.of.IT', 0, 2, 1, 1, '09NN1A1245', 'user_09NN1A1245.png', '2012-11-09 10:53:55', '0000-00-00 00:00:00', 1),
(7, '10NN1A1239', 'b088e713fc85108933bc50031e1ebd6734259dbd', '', 'Veda', 'Bharathi', 'female', 'Dept.of.IT', 0, 3, 1, 2, '10NN1A1239', 'user_10NN1A1239.png', '2012-11-09 10:57:25', '0000-00-00 00:00:00', 1),
(8, 'Madhuri', '51cb4476d83a9323c6f2228c0c9f2e807feb2746', '', 'Lakshmi Madhuri', 'P', 'female', 'Dept.of.IT', 0, 3, 1, 2, '10NN1A1253a', 'user_10NN1A1253a.png', '2012-11-09 11:14:20', '0000-00-00 00:00:00', 1),
(9, 'chaitu', '5424f9974a9f5dc2489ad6d7e72946d2a670b03b', 'youmailchaitu@gmail.com', 'Krishna', 'Chaitanya', 'male', 'Guntur', 9912976339, 1, 7, 0, '', 'user_.png', '2012-11-21 16:10:35', '0000-00-00 00:00:00', 1),
(11, 'anuja', 'fc31f30370bee040d2033ca940f8745d465e4929', 'mandava.anuja@gmail.com', 'anuja', 'mandava', 'female', 'seetharama puram', 9491645019, 2, 1, 0, '09NN1A1235', 'user_09NN1A1235.png', '2012-11-29 15:50:15', '0000-00-00 00:00:00', 1),
(12, 'Hema Reddy', '4e49a98932cc9c605b4d1d279d33a09b5f7788c8', '92.hemareddy@gmail.com', 'hema', 'reddy', 'female', 'Guntur', 9494677562, 2, 1, 0, '09NN1A1224', '', '2012-11-29 15:51:41', '0000-00-00 00:00:00', 1),
(13, 'sravani.vintha@gmail.com', '3019a42b97f5eb0d0b9d556054c55a4928907764', 'sravani.vintha@gmail.com', 'sravani', 'vintha', 'female', 'kollipara', 9491126904, 2, 1, 0, '09NN1A1264', '', '2012-11-29 15:56:13', '0000-00-00 00:00:00', 1),
(14, 'saisindhuja', '8eddd566e078f27e67224bb506ddc37538e13908', 'saisindhu28@nirulawise.com', 'sindhu', 'chowdary', 'female', 'vidya nagar 1st line,', 9701231692, 2, 1, 0, '09NN1A1223', '', '2012-12-06 13:35:46', '0000-00-00 00:00:00', 1),
(15, 'sruthi', '3b122274a16b62b8edd20d5c5840c31d4195124b', 'sruthi4444.p@gmail.com', 'potru', 'sruthi', 'female', 'guntur', 0, 3, 1, 2, '10NN1A1256', '', '2012-12-06 16:00:36', '0000-00-00 00:00:00', 1),
(17, 'Swathiparuchuri10', '091c938bd5ea586b41042e211e6bb317f21a220e', 'pinkyparuchuri@gmail.com', 'swathi', 'paruchuri', 'female', 'guntur', 9493443438, 3, 1, 0, '10NN1A1251', 'user_10NN1A1251.png', '2012-12-07 18:38:48', '0000-00-00 00:00:00', 1),
(18, 'yamini', 'd545fc84ceb3bb3efc0e50a5e26bef41608e3e5d', 'yaminiramesh.r@gmail.com', 'yamini', 'rayi', 'female', '', 8099426383, 2, 1, 0, '09NN1A1250', '', '2012-12-08 16:13:20', '0000-00-00 00:00:00', 1),
(19, 'vjd772@gmail.com', '6777c6f3bd3f730026e1510c8d031781d4391487', 'vjd772@gmail.com', 'jeevan durga', 'vankayalapati', 'female', 'D:NO:-4-21-58/1,chaitanya', 9291907723, 2, 1, 0, '09NN1A1263', 'user_09NN1A1263.png', '2012-12-08 17:47:57', '0000-00-00 00:00:00', 1),
(20, 'sumalika', '1e9b4e8e3f09f96098128722b7f3f33cfa469980', 'sumalikakotha@gmail.com', 'sumalika', 'kotha', 'female', '103,sri balaji residency,', 9441128452, 3, 1, 0, '10NN1A1238', '', '2012-12-11 20:05:52', '0000-00-00 00:00:00', 1),
(21, 'pulligadda harika', 'f52b010a1d55cc6e5cb193bd7bc988589b04fe35', 'sweetchinni91@gmail.com', 'HARIKA', 'PULLIGADDA', 'female', '', 0, 4, 1, 0, '11NN1A1261', '', '2012-12-12 17:50:34', '0000-00-00 00:00:00', 1),
(22, '09NN1A1261', '3c08cdd203d70cae5c1edda3902168f85efe63b6', 'thannneru.srilekha@gmail.com', 'srilekha', 'thanneru', 'female', 'tenli', 8143285445, 2, 1, 0, '09NN1A1261', '', '2012-12-15 11:52:53', '0000-00-00 00:00:00', 1),
(23, 's. sneha', '9b2c873d206b45504a48c85ef8637293e7a93d03', 'sneha.sneha256@gmail.com', 'sannayila', 'sneha', 'female', 'tenali,ithanagar,dongeyst', 9492713526, 0, 0, 0, '09NN1A1256', '', '2012-12-15 12:09:53', '0000-00-00 00:00:00', 1),
(24, 'farheen612@gmail.com', '0560c12d284ad0e8096b131eb041ef4dcd1869e5', 'farheen612@gmail.com', 'FARHEEN', '.........................', 'female', 'sarada nilayam,flat-no201', 8019558390, 2, 1, 0, '09NN1A1238', '', '2012-12-15 12:18:18', '0000-00-00 00:00:00', 1),
(25, 'vanidhya', '74f53739a28360514990f90ea667cdd8571390ee', 'vanidhya.ginjupalli@gmail.com', 'vanidhya', 'ginjupalli', 'female', 'flot no : 204, kakatiya n', 9866031123, 4, 1, 3, '11NN1A1223', 'user_11NN1A1223.png', '2012-12-15 15:51:13', '0000-00-00 00:00:00', 1),
(26, 'adilakshmi', '01eaa880b64ec1075586be86fb7150bf00b1f5b3', 'adi.lakshmi.adi32@gmail.com', 'nallabirudu', 'adilakshmi', 'female', 'gurazala', 9908740359, 4, 1, 0, '11NN1A1252', '', '2012-12-15 16:04:14', '0000-00-00 00:00:00', 1),
(27, '11NN1A1271', 'ad652807ab3372b4a3a4cb04c24bcd88b9e90db0', '11NN1A1271', 'SHAIK', 'AZMEEN', 'female', 'AT.AGRAHARAM', 9394154949, 4, 1, 0, '11NN1A1271', '', '2012-12-15 17:08:14', '0000-00-00 00:00:00', 1),
(28, 'navya.94', '64c7f199d6cde33c0527291e15a7255bac643bd0', 'bachinanavya07@gmail.com', 'Bachina', 'Navya', 'female', '', 0, 4, 1, 0, '11NN1A1264', '', '2012-12-15 17:25:57', '0000-00-00 00:00:00', 1),
(29, 'lakshmi tanuja', '45910e763d30f4ce8ea22edade98f2300de11c7e', 'pltanuja@gmail.com', 'lakshmi tanuja', 'padmanabhuni', 'female', 'vetapalem', 9032611329, 4, 1, 0, '11NN1A1256', '', '2012-12-16 08:49:10', '0000-00-00 00:00:00', 1),
(30, 'sowmya lankireddy', '35e9617895a212f60895b4c41dda19dae9006313', 'swmrddy007@gmail.com', 'sowmya', 'lankireddy', 'female', 'padarthi towers,flatno. 1', 8142761990, 4, 1, 0, '11NN1A1245', 'user_11NN1A1245.png', '2012-12-16 10:35:38', '0000-00-00 00:00:00', 1),
(31, 'Mounika', 'af08e18a35f3686d1ffd33952d593714bd223124', 'chinnumoni64@yahoo.com', 'mouni', 'akki', 'female', 'Jayanthinagar,1st lane,op', 9494806303, 4, 1, 0, '11NN1A1248', 'user_11NN1A1248.png', '2012-12-16 16:24:30', '0000-00-00 00:00:00', 1),
(32, 'vamsireddy', 'ebfd65192e19327b4bb676636b7d9184eb4d9e26', 'vamsireddy136@gmail.com', 'vamsi', 'reddy', 'female', 'macherla', 9700473688, 2, 1, 0, '09nn1a1216', '', '2012-12-17 13:54:07', '0000-00-00 00:00:00', 1),
(33, 'vinodareddy', '6bd857b409748d34fa669017e308251155f6191d', 'smiley.vinoda@gmail.com', 'vinoda', 'reddy', 'female', 'guntur', 9494699878, 2, 1, 0, '09NN1A1244', '', '2012-12-17 14:18:28', '0000-00-00 00:00:00', 1),
(34, 'k.suddestha', '6b03621353585802bab6626fac3aa6a6605bbf17', 'ksuddeshata@gmail.com', 'kanamarlapudi', '', 'female', 'Do:No-5-82-13,Lakshmipura', 9246469495, 2, 1, 0, '09NN1A1225', '', '2012-12-17 14:19:17', '0000-00-00 00:00:00', 1),
(35, 'rupa', '2b5572da0079db060305cb656bebf47653391735', 'emanirupa@gmail.com', 'rupa', 'emani', 'female', 'hanumaiahnagar-3rdline,4-', 9293231313, 2, 1, 0, '09NN1A1220', '', '2012-12-17 14:20:54', '0000-00-00 00:00:00', 1),
(36, 'MOUNIKAREDDY', 'f6164ff9d4c6e8b34a88a06237919bf18eea355b', 'mounikabonthu41@gmail.com', 'BONTHU', 'MOUNIKA', 'female', 'PLOTNO:301,B-BLOCK,SRI SA', 9397970296, 2, 1, 0, '09NN1A1210', '', '2012-12-17 14:21:38', '0000-00-00 00:00:00', 1),
(37, 'chandana', '540867bc1733d7ab2742f48b0e3274afb24727fc', 'maddi.chandana@gmail.com', 'rama', 'chandana', 'female', 'velpuru', 9704287397, 2, 1, 0, '09NN1A1234', '', '2012-12-17 14:22:20', '0000-00-00 00:00:00', 1),
(38, 'y.bindumadhavi', 'ba36b00efec204974652b82fdf533d2cfd98c1f9', 'bindumadhavi1992@gmail.com', 'bindu', 'madhavi', 'female', 'guntur', 9030250253, 2, 1, 0, '09NN1A1268', '', '2012-12-17 14:22:54', '0000-00-00 00:00:00', 1),
(39, 'divya', '57f675d951839ebc1202a25deedb946f2fe1a48a', 'divya.chinni12@gmail.com', 'divya', 'ch.divya', 'female', 'guntur', 9581384984, 2, 1, 0, '09NN1A1212', '', '2012-12-17 14:23:26', '0000-00-00 00:00:00', 1),
(40, 'd.s.jyothirami', 'c672f1357a450a2dfad4562d005e5cfd88d7ab1e', 'jyothi.nakshatra@gmail.com', 'jyothi', 'sai', 'female', 'd.sai jyothirami,d/o d.sa', 9491121400, 2, 1, 0, '09NN1A1215', '', '2012-12-17 14:24:49', '0000-00-00 00:00:00', 1),
(41, 'madhavi', '8748f85c85a8d3ab8af64f388aba3745b32310f2', 'dasarimadhavi8@gmail.com', 'dasari', 'madhavi', 'female', 'D.madhavi,(D/O)D.Ramesh,P', 9492316083, 2, 1, 0, '09NN1A1214', '', '2012-12-17 14:25:43', '0000-00-00 00:00:00', 1),
(42, '123', 'b8797b3406a9b97f68a019b3c5403272e0304237', 'asha.asha257@gmail.com', 'asha', 'shaik', 'female', 'd/o:sk subhani,d-no1-8-56', 9966185781, 2, 1, 0, '09NN1A1257', '', '2012-12-17 14:25:50', '0000-00-00 00:00:00', 1),
(43, 'Badineni himabindu', '8334918da76533b5c14f235f374e327c95035aa3', 'himabindu.badineni@gmail.com', 'badineni', 'himabindu', 'female', 'saibaba road', 9912957098, 2, 1, 0, '09NN1A1206', '', '2012-12-17 14:26:58', '0000-00-00 00:00:00', 1),
(44, 'ManneGayathri', '257088db38ea181381d9ad4543ee3174de41f1eb', 'mannemickey@gmail.com', 'Manne', 'chowdary', 'female', 'meddaramettla,guntur dist', 9985607790, 2, 1, 0, '09NN1A1236', 'user_09NN1A1236.png', '2012-12-17 14:27:34', '0000-00-00 00:00:00', 1),
(45, 'pushpa', '290df7dfcc58c8f74fd08ec69e187c3cde978f60', 'pushpa.atukuri@gmail.com', 'atukuri', 'pushpa', 'female', 'a.pushpalatha,(d/o)a.srin', 9494848063, 2, 1, 0, '09NN1A1204', '', '2012-12-17 14:27:38', '0000-00-00 00:00:00', 1),
(46, 'supraja', 'f7686c524eea3f359f09c1cc9e3e4093853c90f5', 'supraja1265@gmail.com', 'supraja', 'vintha', 'female', 'mandapadu,guntur(dt)', 9491124734, 2, 1, 0, '09NN1A1265', '', '2012-12-17 14:27:56', '0000-00-00 00:00:00', 1),
(47, 'vaishnavi', 'ff97b08d0ae300c846af98ad59d3db56afef0c0f', 'vaishnavi.116@gmail.com', 'kandimalla', 'vaishnavi', 'female', 'pattabhipuram,2nd lane,d.', 9700700248, 2, 1, 0, '09NN1A1226', 'user_09NN1A1226.png', '2012-12-17 14:28:20', '0000-00-00 00:00:00', 1),
(48, 'revathipulivarthi', '596d4a7cf00bd979faad2d6e794835cbd6f776ba', 'revathipulivarthi@gmail.com', 'pulivarthi', 'revathi', 'female', 'arundelpet 16/2,dno:6-16-', 8142832822, 2, 1, 0, '09NN1A1249', '', '2012-12-17 14:28:42', '0000-00-00 00:00:00', 1),
(49, 'Chava.Aswini', 'c4f4f30ca4dfec96e9f162871b481cbf1f555380', 'aswini.chava999@gmail.com', 'Chava', 'Aswini', 'female', 'door no:11_3_240,police q', 8500653857, 2, 1, 0, '09NN1A1211', 'user_09NN1A1211.png', '2012-12-17 14:28:57', '0000-00-00 00:00:00', 1),
(50, 'kota priyanka', '7ca85f993d9c433e3e6b438c81d1144760762d28', 'priyanka.k1230@gmail.com', 'kota', 'priyanka', 'female', 'reddy palem,guntur(m)', 8121583793, 2, 1, 0, '09NN1A1230', 'user_09NN1A1230.png', '2012-12-17 14:29:11', '0000-00-00 00:00:00', 1),
(51, 'tejaswini.d', '6162231b0c16eb4408d2c31904c0e03f9ba0f6f2', 'vijjutejaswini19@gmail.com', 'DUGGINENI', 'TEJASWINI', 'female', 'NALANDANAGAR2/1,GUNTUR', 9440638736, 2, 1, 0, '09NN1A1219', '', '2012-12-17 14:29:53', '0000-00-00 00:00:00', 1),
(52, 'rajyalakshmi', '98037abcf4056e5e662762859b3f0ec474b207e2', 'rajyalakshmi7kurmam@gmail.com', 'kurmam', 'rajyalakshmi', 'female', '6/2 nallacheruvu ,guntur', 9848333593, 2, 1, 0, '09NN1A1232', '', '2012-12-17 14:30:00', '0000-00-00 00:00:00', 1),
(53, 'sirisha', '224fc3b437aa2b5157085fcc9fec6963a175b942', 'manukonda.siri@gmail.com', 'sirisha', 'manukonda', 'female', 'abburu(po),sattenapalli(m', 9491133788, 2, 1, 0, '09NN1A1237', '', '2012-12-17 14:30:21', '0000-00-00 00:00:00', 1),
(54, 'krishnaveni', '21a1e704d6d34ca56571bc3974a2eab9b191c9ca', 'krishnavenisadarajapalli@gmail.com', 'krishnaveni', '', 'female', 'guntur', 9490306520, 2, 1, 0, '09NN1A1254', '', '2012-12-17 14:31:06', '0000-00-00 00:00:00', 1),
(55, 'rajimunagala', 'c8bca1e4ce35296a4779d54e49a3475e9aade8d2', 'rajimunagala.it@gmail.com', 'Raji', 'munagala', 'female', 'jakkavari sreet,perala,ch', 9292555103, 2, 1, 0, '09NN1A1241', '', '2012-12-17 14:31:12', '0000-00-00 00:00:00', 1),
(56, 'khasimbee.ramagiri@gmail.com', '17e6f7f265e4551a81d2c91e558186dbbfbfe030', 'khasimbee.ramagiri@gmail.com', 'ramagiri', 'khasimbee', 'female', 'Sri kameswari Devi Nilaya', 8142270936, 2, 1, 0, '09NN1A1252', '', '2012-12-17 14:31:30', '0000-00-00 00:00:00', 1),
(57, 'usharani', '1ce1416347075b6070a35ce5e9d26b61d91ea6c3', 'munagotiusharani@gmail.com', 'usha', 'rani', 'female', 'Garapadu(post)Pedakurapad', 8790215842, 2, 1, 0, '09NN1A1242', '', '2012-12-17 14:32:40', '0000-00-00 00:00:00', 1),
(58, 'shaikshabna', '876c9ce3179aa2accde418150b43d7e5ab80ceaf', 'shaikshabna1992@gmail.com', 'shaik', 'shabna', 'female', 'housing bordcolony saibab', 9290539571, 2, 1, 0, '09NN1A1258', '', '2012-12-17 14:32:52', '0000-00-00 00:00:00', 1),
(59, 'Maddi.himaja', 'ac56cf9f8ad6041d9d05192a943999a289c3dc99', 'himaja9maddi@gmail.com', 'maddi', 'himaja', 'female', 'kothapeta,guntur', 9703505854, 2, 1, 0, '09NN1A1233', 'user_09NN1A1233.png', '2012-12-17 14:35:04', '0000-00-00 00:00:00', 1),
(60, 'r.chayasinduja', '9d592481ee4e46760a52e615514638c7381b8b01', 'sindhuja.rayaprolu@gmail.com', 'Rayaprolu', 'Chaya Sinduja', 'female', 'D/O R.Badari Prasad,3/17,', 8297943145, 2, 1, 0, '09N1A1253', '', '2012-12-17 14:39:31', '0000-00-00 00:00:00', 1),
(61, 'PrasannaLakshmi.R', 'eb77579c1911c89786ab7c4d92f05af038c76297', 'prasannait1251@gmail.com', 'Prasanna', 'Rachapudi', 'female', '3-1 Main Road,Modukuru,Ts', 9492690605, 2, 1, 1, '09NN1A1251', '', '2012-12-17 14:49:16', '0000-00-00 00:00:00', 1),
(62, 'JAYASRI', '40a5592da6c4f80ffdb038ffec5762a15fa15d85', 'jayasri1240@gmail.com', 'JAYASRI', 'MOTAMARRI', 'female', 'D/O M.APPARAO,  MUTLUR(PT', 9440666819, 2, 1, 0, '09NN1A1240', 'user_09NN1A1240.png', '2012-12-17 14:58:58', '0000-00-00 00:00:00', 1),
(63, 'poojitha', '9bf30d4c5e5b6a373f68791ac1a2fc079f4b9029', 'poojithabanisetty@gmail.com', 'BANISETTY', 'POOJITHA', 'female', 'sarada colony opp 23 rd l', 9866229396, 2, 1, 0, '09NN1A1208', '', '2012-12-17 15:42:08', '0000-00-00 00:00:00', 1),
(64, 'N.kalyani', '744356ce1764dca6bae0d9e6aa61d28d8b02f149', 'kalyani.nelluri54', 'kalyani', 'nelluri', 'female', 'gurazala', 9177984609, 4, 1, 0, '11NN1A1254', '', '2012-12-17 16:14:52', '0000-00-00 00:00:00', 1),
(65, 'P.Harshitha', 'c1d5512044e2ee723be61309dac5a0da66c0b31b', 'harshitha460', 'Harshitha', 'Pemmasani', 'female', 'dechavaram', 9959478381, 4, 1, 0, '11NN1A1257', '', '2012-12-17 16:21:29', '0000-00-00 00:00:00', 1),
(66, 'P.sasimounika', '2771aab07977cedbd07d260aef174f9afd806de5', 'sasimounika94', 'sasimounika', 'puligadda', 'female', 'gullapalli', 9959344563, 4, 1, 0, '11NN1A1262', '', '2012-12-17 16:27:55', '0000-00-00 00:00:00', 1),
(67, 'y.Divya', '2b717289e448c4f616c987b953b8b84ebf538f87', 'ydivya93@gmail.com', 'yarlagadda', 'divya', 'female', 'nagulapalem', 9949812324, 4, 1, 0, '11NN1A1284', '', '2012-12-17 17:39:48', '0000-00-00 00:00:00', 1),
(68, 'pidikitisujatha', '5bd78fdf00f81de3b35727db3d613b772d6f070d', 'pidikitisujatha@gmail.com', 'pidikiti', 'sujatha', 'female', 'amanigudipadu', 9963342926, 4, 0, 0, '11NN1A1258', '', '2012-12-17 20:23:43', '0000-00-00 00:00:00', 1),
(69, 'latha', 'f44459ac911137fb933b5e067d8e1b5ccd79e0ae', 'lathas714@gmail.com', 'sri', 'latha', 'female', 'near vidyanagar,guntur', 7893150531, 4, 1, 0, '11NN1A1250', '', '2012-12-18 17:45:25', '0000-00-00 00:00:00', 1),
(70, 't.s.m.swaroopa', '3ce89f5bf09c48f8b77f10c24f4ae914fae8e3cd', 'maruthi610@gmail.com', 'TONDEPU', 'SIVA MARUTHI SWAROOPA', 'female', '8/1 nalla cheruvu  guntur', 9247861684, 4, 1, 0, '11NN1A1276', 'user_11NN1A1276.png', '2012-12-19 15:54:11', '0000-00-00 00:00:00', 1),
(71, 'P.ANUSHA', 'a5a16ecee16c6c96a698aa5f3762be19ea5e9169', 'anushapyneni5', 'anusha', 'pyneni', 'female', 'lemallepadu', 9948517655, 4, 1, 0, '11NN1A1266', '', '2012-12-20 15:33:00', '0000-00-00 00:00:00', 1),
(72, 'V .VYSHNAVI', 'e82f69404be98e3697ca4c1b98a782f599bb2f2b', 'vyshnaviarya.reddy', 'VYSHNAVI', 'VEERABADRUNI', 'female', 'sowpadu', 9848182927, 4, 1, 0, '11NN1A1279', '', '2012-12-20 15:36:06', '0000-00-00 00:00:00', 1),
(73, 'M.chandrika', '1e76106d57eda7c7b26e4180013756f89b8c75d3', 'mchandrika49@gmail.com', 'movva', 'chandrika', 'female', 'mutlur', 9492471187, 4, 1, 0, '11NN1A1249', '', '2012-12-20 15:54:18', '0000-00-00 00:00:00', 1),
(74, 'N.THRIVENI', '903e11ca687f1dd49a2b04156b151210e8ae4f70', 'THRIVENI@GMAIL.COM', 'NADENDLA', 'THRIVENI', 'female', 'THRIVENI51', 9948993013, 4, 1, 0, '11NN1A1251', '', '2012-12-20 15:57:27', '0000-00-00 00:00:00', 1),
(75, 'n.chandrusha', 'ee9a89ab8173f19c17f9607bcc7e8bbb1b39c5df', 'chandrusha.nallamothu', 'chandrusha', 'nallamothu', 'female', 'nadendla', 9705702693, 4, 1, 0, '11NN1A1253', '', '2012-12-20 16:12:12', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wise_committee`
--

CREATE TABLE IF NOT EXISTS `wise_committee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `committee_cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wise_committee`
--

INSERT INTO `wise_committee` (`id`, `committee_cat_id`, `user_id`) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 5, 4),
(4, 7, 6),
(5, 6, 8),
(6, 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `wise_committee_cat`
--

CREATE TABLE IF NOT EXISTS `wise_committee_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `wise_committee_cat`
--

INSERT INTO `wise_committee_cat` (`id`, `category_name`) VALUES
(1, 'Chairman'),
(2, 'Vice Chairman'),
(3, 'President'),
(4, 'Vice-President'),
(5, 'Secretary'),
(6, 'Join-Secretary'),
(7, 'Tresurer'),
(8, 'join-Tresurer');

-- --------------------------------------------------------

--
-- Table structure for table `year_batch`
--

CREATE TABLE IF NOT EXISTS `year_batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `batch` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `year_batch`
--

INSERT INTO `year_batch` (`id`, `batch`) VALUES
(1, '2008-12 Batch'),
(2, '2009-13 Batch'),
(3, '2010-14 Batch'),
(4, '2011-15 Batch'),
(5, 'Other');
