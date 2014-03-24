-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2013 at 11:28 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `askstein`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(255) NOT NULL AUTO_INCREMENT,
  `question_id` int(255) DEFAULT NULL,
  `answer_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text,
  `user_id` int(255) DEFAULT NULL,
  `average` float NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `answer_date`, `content`, `user_id`, `average`) VALUES
(4, 45, '2013-09-13 09:01:34', '', 20, 0),
(5, 45, '2013-09-13 09:03:04', 'loseR', 20, 0),
(6, 47, '2013-09-13 11:21:59', 'huhhhhhhhuhhuhu', 22, 0),
(7, 54, '2013-10-04 23:03:57', 'Diamonds in the sky.', 23, 0),
(8, 54, '2013-10-05 00:48:59', 'Sure oi? Dili buh kwarta?? Nawng baya kog kwarta! Hahahahaha', 23, 0),
(9, 55, '2013-10-20 23:33:03', 'Yes, it is!', 24, 0),
(10, 58, '2013-10-26 06:09:49', 'Hmmff. Just curious :) Can someone kindly fill up my craving mind?', 24, 0),
(11, 58, '2013-10-27 00:21:02', 'Makalagot! dili mupost!', 24, 0),
(12, 58, '2013-10-27 00:28:36', 'Tan-awa lang! Batia aning inyong website oi!', 24, 0),
(13, 58, '2013-10-27 02:06:41', 'Atay oi. Waý klaro! Tsk3x.', 24, 0),
(14, 58, '2013-10-27 02:07:21', 'Syaro... duhaon nakog answer ha!. Just observe.', 24, 0),
(15, 58, '2013-10-27 02:10:01', 'Kapuya na ani oi!', 24, 80),
(16, 58, '2013-10-27 02:11:05', 'Maypag nahimo kong alien duhh!', 24, 0),
(17, 58, '2013-10-27 02:41:34', 'Makapost unta ko oi! Hasula bitaw. Tsk.', 18, 76),
(18, 63, '2013-10-28 15:21:46', 'Yeah??', 16, 80),
(19, 60, '2013-10-28 15:37:37', 'Yeahh', 16, 0),
(20, 59, '2013-10-28 16:27:58', 'Vega ka teh??', 24, 80),
(21, 74, '2013-10-28 17:37:41', 'Yes.', 20, 0),
(22, 75, '2013-10-28 17:42:00', 'I don''t like it. ', 29, 70),
(23, 75, '2013-10-28 18:02:08', 'I don''t like it. You make me feel safe.', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Computers', NULL),
(2, 'Arts', NULL),
(3, 'Science', NULL),
(4, 'Education', NULL),
(5, 'Entertainment', NULL),
(6, 'Health', NULL),
(7, 'Fashion & Beauty', NULL),
(8, 'Politics', NULL),
(9, 'Travel', NULL),
(10, 'Electronics', NULL),
(11, 'Uncategorized', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(255) NOT NULL AUTO_INCREMENT,
  `answer_id` int(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `content` text,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `answer_id` (`answer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `answer_id`, `user_id`, `content`, `comment_date`) VALUES
(7, 6, 22, 'haahahahahahaha', '2013-09-13 11:31:24'),
(9, 8, 23, 'Hasula sad nimo oi. I think love man </3', '2013-10-05 01:28:19'),
(10, 9, 24, 'Sure??', '2013-10-20 23:33:18'),
(11, 9, 24, 'Sure??', '2013-10-20 23:33:56'),
(12, 10, 24, 'Sureness, wala nisulod sa database??', '2013-10-26 20:15:15'),
(13, 10, 24, 'Naunsa na man ni oi!', '2013-10-27 00:28:03'),
(14, 10, 18, 'Ngano man ni oi! Ganiha ra ka huhh!', '2013-10-27 02:43:45'),
(15, 18, 16, 'Sure??', '2013-10-28 15:21:59'),
(16, 20, 24, 'Sure??', '2013-10-28 16:28:15'),
(17, 22, 29, 'Hi.', '2013-10-28 17:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE IF NOT EXISTS `hashtags` (
  `hashtag_id` int(255) NOT NULL AUTO_INCREMENT,
  `hashtag` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator` int(11) DEFAULT NULL,
  PRIMARY KEY (`hashtag_id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`hashtag_id`, `hashtag`, `date_created`, `creator`) VALUES
(1, 'honesto', '2013-10-25 18:54:16', 24),
(2, 'today', '2013-10-25 18:54:16', 24),
(3, 'omg', '2013-10-25 18:54:16', 24),
(4, 'canThisBeLove', '2013-10-25 18:54:16', 24),
(5, 'life', '2013-10-26 06:08:58', 24),
(6, 'galaxy', '2013-10-26 06:08:58', 24),
(7, 'yeah', '2013-10-28 13:44:21', 16),
(8, 'PLL', '2013-10-28 16:54:31', 24),
(9, 'curious', '2013-10-28 17:15:38', 20),
(10, 'maoy', '2013-10-28 17:37:11', 24),
(11, 'broken', '2013-10-28 17:37:11', 24),
(12, 'science', '2013-10-28 18:01:21', 30);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(255) NOT NULL AUTO_INCREMENT,
  `num_of_followers` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `content` text NOT NULL,
  `ask_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `num_of_followers`, `user_id`, `content`, `ask_date`) VALUES
(45, 0, 18, 'Anong plano mo??', '2013-09-12 02:20:58'),
(46, 0, 18, '845utd8', '2013-09-12 02:21:47'),
(47, 0, 18, 'Anong plano mo??', '2013-09-12 02:24:44'),
(48, 0, 18, 'leui5hmto4', '2013-09-12 02:28:29'),
(49, 0, 19, 'Life? What is life?', '2013-09-13 05:25:04'),
(50, 0, 19, 'What is asktein?', '2013-09-13 05:25:38'),
(51, 0, 19, 'hahaha', '2013-09-13 05:39:55'),
(52, 0, 17, 'hahahaha', '2013-09-13 07:53:02'),
(53, 0, 17, 'follow', '2013-09-13 07:53:41'),
(54, 0, 23, 'What is the most precious thing in your world?', '2013-10-04 23:03:35'),
(55, 0, 24, 'Askstein is nice, right??', '2013-10-20 23:32:49'),
(56, 0, 24, '#honesto. #today. #omg.\r\n\r\n#canThisBeLove i am so qwerty qwerty 3x', '2013-10-25 18:54:15'),
(57, 0, 24, '#honesto. #today. #omg.\r\n\r\n#canThisBeLove i am so qwerty qwerty 3x', '2013-10-25 18:59:48'),
(58, 0, 24, 'It is possible that there are another #life in another dimensions in #galaxy?', '2013-10-26 06:08:56'),
(59, 0, 24, '#canThisBeLove again?', '2013-10-27 04:44:51'),
(60, 0, 17, '#canThisBelove, may tag mu-trending ka :?', '2013-10-27 04:46:40'),
(61, 0, 16, 'OMG', '2013-10-28 13:42:00'),
(62, 0, 16, 'I''m a survivor! #yeah', '2013-10-28 13:44:21'),
(63, 0, 16, 'Blah blah!', '2013-10-28 15:21:32'),
(64, 0, 16, 'I''m a survivor!', '2013-10-28 16:09:11'),
(65, 0, 24, 'Nagno mdiay??', '2013-10-28 16:54:02'),
(66, 0, 24, '#PLL', '2013-10-28 16:54:31'),
(69, 0, 20, 'How to fix flashdrive?', '2013-10-28 17:02:25'),
(70, 0, 20, 'Huhh??', '2013-10-28 17:05:08'),
(71, 0, 20, 'Ngano??', '2013-10-28 17:09:29'),
(72, 0, 20, 'Why is the sky blue?? #curious', '2013-10-28 17:15:38'),
(73, 0, 24, 'Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue? Why is the sky blue?', '2013-10-28 17:36:00'),
(74, 0, 24, 'Dont you remember you told me you love me, baby? #maoy #broken', '2013-10-28 17:37:11'),
(75, 0, 28, 'How do you like my profile picture? ', '2013-10-28 17:40:15'),
(76, 0, 30, 'What is an atom? #science', '2013-10-28 18:01:21'),
(77, 0, 30, 'nag #maoy ko run.', '2013-10-28 18:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `question_categories`
--

CREATE TABLE IF NOT EXISTS `question_categories` (
  `question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`,`category_id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_categories`
--

INSERT INTO `question_categories` (`question_id`, `category_id`, `sub_category_id`) VALUES
(56, 3, 1),
(57, 3, 1),
(69, 3, 1),
(58, 1, 3),
(63, 2, 3),
(73, 2, 3),
(76, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `question_follow`
--

CREATE TABLE IF NOT EXISTS `question_follow` (
  `user_id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `date_followed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`,`question_id`),
  KEY `user_id_2` (`user_id`),
  KEY `user_id_3` (`user_id`),
  KEY `user_id_4` (`user_id`,`question_id`),
  KEY `user_id_5` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_follow`
--

INSERT INTO `question_follow` (`user_id`, `question_id`, `date_followed`) VALUES
(17, 59, '2013-10-27 05:36:05'),
(18, 58, '2013-10-27 02:33:45'),
(24, 47, '2013-10-27 04:00:56'),
(24, 48, '2013-10-27 03:57:29'),
(24, 49, '2013-10-27 04:00:37'),
(24, 50, '2013-10-27 00:14:53'),
(24, 51, '2013-10-27 00:13:24'),
(24, 52, '2013-10-27 00:09:46'),
(24, 53, '2013-10-27 00:03:19'),
(24, 54, '2013-10-25 20:52:20'),
(24, 60, '2013-10-28 16:44:56'),
(29, 75, '2013-10-28 17:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `question_hashtags`
--

CREATE TABLE IF NOT EXISTS `question_hashtags` (
  `question_id` int(11) NOT NULL DEFAULT '0',
  `hashtag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`question_id`,`hashtag_id`),
  KEY `hashtag_id` (`hashtag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_hashtags`
--

INSERT INTO `question_hashtags` (`question_id`, `hashtag_id`) VALUES
(57, 1),
(57, 2),
(57, 3),
(57, 4),
(59, 4),
(60, 4),
(58, 5),
(58, 6),
(62, 7),
(66, 8),
(72, 9),
(74, 10),
(77, 10),
(74, 11),
(76, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level_ratings` enum('1','2','3','4','5') NOT NULL,
  KEY `answer_id` (`answer_id`),
  KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`answer_id`, `question_id`, `user_id`, `level_ratings`) VALUES
(17, 58, 17, '4'),
(17, 58, 16, '3'),
(17, 58, 23, '3'),
(17, 58, 18, '4'),
(17, 58, 24, '5'),
(15, 58, 24, '4'),
(18, 63, 16, '4'),
(20, 59, 24, '4'),
(22, 75, 29, '4'),
(22, 75, 30, '3');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_category_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_category_id`, `name`, `description`, `category_id`) VALUES
(1, 'Programming', NULL, 1),
(1, 'Dance', NULL, 2),
(1, 'Biology', NULL, 3),
(1, 'Homework', NULL, 4),
(1, 'Games', NULL, 5),
(1, 'Medical conditions & procedures', NULL, 6),
(1, 'Beauty & skin care', NULL, 7),
(1, 'Government', NULL, 8),
(1, 'Travel & vacation planning', NULL, 9),
(1, 'Technology', NULL, 10),
(2, 'Software and Hardware', NULL, 1),
(2, 'Music', NULL, 2),
(2, 'Mathematics', NULL, 3),
(2, 'Project', NULL, 4),
(2, 'Hobbies', NULL, 5),
(2, 'Drugs & medicine', NULL, 6),
(2, 'Hairstyles', NULL, 7),
(2, 'Current issues', NULL, 8),
(2, 'Tourism', NULL, 9),
(2, 'Device', NULL, 10),
(3, 'Troubleshooting', NULL, 1),
(3, 'Book', NULL, 2),
(3, 'Engineering', NULL, 3),
(3, 'Exam', NULL, 4),
(3, 'Movies/Television', NULL, 5),
(3, 'Health care system', NULL, 6),
(3, 'Fashion', NULL, 7),
(3, 'Laws', NULL, 8),
(3, 'Road trips', NULL, 9),
(3, 'Invention', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email_address`) VALUES
(16, 'lindyloupepito', 'lindylou11*', 'lindyloupepito@gmail.com'),
(17, 'aldwyn101', 'charbaki', 'charbaki@gmail.com'),
(18, 'wiwyn123', 'wiwyn', 'wiwyntv@gmail.com'),
(19, 'yenyeeen', 'yey', 'maryainneranoa@gmail.com'),
(20, 'elise', 'e', 'elisesumanga@gmail.com'),
(22, 'Aldwyn', 'al', 'obra@obra.com'),
(23, 'Margaux143', 'margaux143', 'margaux143@porno.com'),
(24, 'anne', 'yap', 'charbaki@g.com'),
(25, 'emrs1018', 'emrs1018', 'emrs1018@gmail.com'),
(26, 'aldwyn123', 'aldwyn123', 'aldwyn123@gmail.com'),
(27, 'champagne', 'champagne', 'champagne@gmail.com'),
(28, 'angellocsin', 'phil', 'angel@gmail.com'),
(29, 'philyounghusbang', 'phil', 'phil@gmail.com'),
(30, 'doratheexplorer', 'dora', 'dora@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_ask`
--

CREATE TABLE IF NOT EXISTS `user_ask` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_ask`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_follow`
--

CREATE TABLE IF NOT EXISTS `user_follow` (
  `follower_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `date_follow` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`follower_id`,`follow_id`),
  KEY `follow_id` (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_follow`
--

INSERT INTO `user_follow` (`follower_id`, `follow_id`, `date_follow`) VALUES
(17, 24, '2013-10-27 06:49:37'),
(20, 17, '2013-09-13 08:31:48'),
(20, 18, '2013-09-13 08:32:36'),
(24, 19, '2013-10-25 21:18:16'),
(24, 20, '2013-10-28 17:32:21'),
(24, 23, '2013-10-25 21:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `level` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `user_id` int(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `bio` varchar(140) DEFAULT NULL,
  `gender` enum('MALE','FEMALE') DEFAULT 'MALE',
  `location` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT '0000-00-00',
  `prof_pic` varchar(255) NOT NULL DEFAULT 'default.gif',
  `cover_pic` varchar(255) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`user_id`, `firstname`, `lastname`, `bio`, `gender`, `location`, `birthdate`, `prof_pic`, `cover_pic`) VALUES
(16, 'Lindy Lou', 'Pepito', 'ISKOLAR.', 'FEMALE', 'Cebu City', '1994-08-27', '526ed588809b5.jpg', '526ede836876a.jpg'),
(17, 'Wiwyn', 'Caba', 'A proud Iskolar ng Bayan with failing grades. Tsk. Way to gow!', 'MALE', 'Cebu City', '0000-00-00', '526daeace28cd.jpg', '526daeace7574.jpg'),
(18, 'Wiwyn', 'Flores', 'Ikolar ng Bayan. Tunay. Palaban. Makabayan. Proud NKE-ish UPS member!', 'MALE', 'Cebu City', '0000-00-00', '526ed81000f2b.jpg', '526ed810016c5.jpg'),
(19, 'Shai', 'Man', 'nnn', 'FEMALE', '', '0000-00-00', '', ''),
(20, 'Elise', 'Sumanga', 'ha', 'FEMALE', 'Talamban', '2013-10-16', '526e28a05532d.jpg', '526e28a055788.jpg'),
(22, 'Aldwyn', 'Wiwy', 'haha', 'FEMALE', '', '0000-00-00', '', ''),
(23, 'Lindy', 'Pepitos', 'I have a mole -- a big, big mole at point 11!', 'FEMALE', 'Labangon, Labangonon', '0000-00-00', '', ''),
(24, 'Anne Curtis', 'Smith Yap', 'kjbfrgkjd', 'FEMALE', 'udhrgfkuhdf', '2013-10-14', 'default.gif', '526e2e8a13e62.jpg'),
(27, 'Yen', 'Ainne', 'I am not a beverage nor a cocktail. Anyhow, just cheer for who I am.', 'MALE', 'Philadelphia', '1994-09-04', 'default.gif', 'default.jpg'),
(28, 'Angel', 'Locsin', 'Ambisyosa', 'FEMALE', 'Manila', '2013-10-28', '526e30d9b9d0c.jpg', '526e30d9ba75c.jpg'),
(29, 'Phil', 'Younghusband', 'Soccer', 'FEMALE', 'Azkal', '2013-10-11', '526e315007df8.jpg', '526e315008331.jpg'),
(30, 'Dora', 'Chicadora', '', 'FEMALE', 'Labangon, Labangonon', '2012-12-05', '526e3740ea48c.jpg', '526e358c853dc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE IF NOT EXISTS `user_registration` (
  `user_registration_id` int(255) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_registration`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `hashtags`
--
ALTER TABLE `hashtags`
  ADD CONSTRAINT `hashtags_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `question_categories`
--
ALTER TABLE `question_categories`
  ADD CONSTRAINT `question_categories_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_categories_ibfk_3` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`sub_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_follow`
--
ALTER TABLE `question_follow`
  ADD CONSTRAINT `question_follow_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_follow_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_hashtags`
--
ALTER TABLE `question_hashtags`
  ADD CONSTRAINT `question_hashtags_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_hashtags_ibfk_2` FOREIGN KEY (`hashtag_id`) REFERENCES `hashtags` (`hashtag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_ask`
--
ALTER TABLE `user_ask`
  ADD CONSTRAINT `user_ask_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ask_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_follow`
--
ALTER TABLE `user_follow`
  ADD CONSTRAINT `user_follow_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_follow_ibfk_2` FOREIGN KEY (`follow_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_level`
--
ALTER TABLE `user_level`
  ADD CONSTRAINT `user_level_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
