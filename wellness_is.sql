-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2022 at 04:58 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wellness_is`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `mrn` varchar(10) NOT NULL,
  `name` varchar(70) NOT NULL,
  `ic_passport` varchar(12) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `sex` varchar(6) NOT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `race` varchar(20) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `next_of_kin` varchar(70) NOT NULL,
  `relationship` varchar(20) NOT NULL,
  `telephone_nok` varchar(15) NOT NULL,
  `smoker` varchar(5) DEFAULT NULL,
  `asthma` varchar(10) DEFAULT NULL,
  `diabetes` varchar(10) DEFAULT NULL,
  `heart_disease` varchar(10) DEFAULT NULL,
  `hypertension` varchar(10) DEFAULT NULL,
  `stroke` varchar(10) DEFAULT NULL,
  `cancer` varchar(10) DEFAULT NULL,
  `tuberculosis` varchar(10) DEFAULT NULL,
  `skin_disease` varchar(10) DEFAULT NULL,
  `kidneyp` varchar(10) DEFAULT NULL,
  `fits_psychiatric` varchar(10) DEFAULT NULL,
  `father_history` varchar(30) DEFAULT NULL,
  `mother_history` varchar(30) DEFAULT NULL,
  `siblings_history` varchar(30) DEFAULT NULL,
  `habits` varchar(30) DEFAULT NULL,
  `allergy` varchar(30) DEFAULT NULL,
  `others` varchar(30) DEFAULT NULL,
  `medication` varchar(50) DEFAULT NULL,
  `package` varchar(20) DEFAULT NULL,
  `lastUpdateMH` datetime DEFAULT NULL,
  `registeredOn` datetime DEFAULT NULL,
  `lastUpdateOn` datetime DEFAULT NULL,
  `addons` varchar(100) DEFAULT NULL,
  `pic` varchar(50) NOT NULL,
  PRIMARY KEY (`mrn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`mrn`, `name`, `ic_passport`, `date_of_birth`, `address`, `email`, `telephone`, `sex`, `occupation`, `race`, `religion`, `marital_status`, `next_of_kin`, `relationship`, `telephone_nok`, `smoker`, `asthma`, `diabetes`, `heart_disease`, `hypertension`, `stroke`, `cancer`, `tuberculosis`, `skin_disease`, `kidneyp`, `fits_psychiatric`, `father_history`, `mother_history`, `siblings_history`, `habits`, `allergy`, `others`, `medication`, `package`, `lastUpdateMH`, `registeredOn`, `lastUpdateOn`, `addons`, `pic`) VALUES
('1234', 'Imran Tono ', '122435465798', '2022-06-01', '3 Jalan Emas 1, Taman Melawis\r\n41100 Klang\r\nSelangor', 'imran@gmail.com', '01121002835', 'Male', 'student', 'malay', 'islam', 'Single', 'Kila', 'Wife', '9119', 'Yes', 'Yes', 'Unknown', 'Yes', 'No', 'Unknown', 'No', 'Yes', 'No', 'Unknown', 'No', ' no', ' no', ' no', ' no', ' no', ' no', 'no', 'Custom', '2022-07-05 02:33:30', '2022-06-24 17:17:16', '2022-07-05 11:47:47', 'Premium\r\n1. Hepatitis A Screening\r\n2. Pure Tone Audiometry\r\n3. Lung Function Test', 'admin'),
('12345', 'Amir', '52085285208', '2022-06-01', 'test', 'test@email.com', '3222541', 'Male', 'accountant', 'malay', 'islam', 'Married', 'Siti', 'Wife', '4135184', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Essential', NULL, '2022-06-29 02:36:22', NULL, NULL, ''),
('8552', 'Loga', '020202103325', '2002-02-02', 'Rumah', 'loga@gmail.com', '0147856936', 'Male', 'student', 'Indian', 'Buddha', 'Single', 'Thiva', 'Father', '0158764665', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Essential', NULL, '2022-06-28 08:09:10', NULL, NULL, ''),
('0220', 'Syafiq', '90123102452', '1990-01-23', 'Rumah', 'syafiq@gmail.com', '', 'Male', 'HR', 'Malay', 'Islam', 'Married', 'Ika', 'Wife', '0154886655', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', '-', '-', '-', '-', '-', '-', '-', 'Essential', '2022-06-28 08:23:05', '2022-06-28 06:33:48', '2022-06-28 08:22:22', NULL, ''),
('7894', 'Wong', '030330103303', '2003-03-30', 'Rumah', 'wong@gmail.com', '999', 'Male', 'Student', 'Chinese', 'Buddha', 'Single', 'Lim', 'Father', '1300882525', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Essential', NULL, '2022-06-29 02:31:37', '2022-06-29 02:35:25', '', ''),
('9632', 'Johnny Depp', '870202103325', '1987-02-02', 'somewhere', 'johnny@gmail.com', '1300888333', 'Male', 'Actor', 'Chinese', 'Christian', 'Divorced', 'Amber', 'Ex-Wife', '8008135', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Premium', NULL, '2022-07-01 02:08:51', '2022-07-04 07:49:02', NULL, 'admin'),
('6881', 'Faris', '980101102202', '1998-01-01', 'Rumah', 'faris@gmail.com', '03215565546', 'Male', 'Businessman', 'Malay', 'Islam', 'Single', 'Abdullah', 'Father', '24681012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Comprehensive', NULL, '2022-07-04 08:07:52', NULL, NULL, 'admin'),
('68818', 'Poppy', '852024135463', '2022-07-07', 'gfhjk', '', '', 'Female', 'Clerk', 'malay', 'islam', 'Married', 'Adam Mukhreez Jamaludin', 'father', '01121002835', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Essential', NULL, '2022-07-04 09:00:35', NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
  `mrn` varchar(10) NOT NULL,
  `appearance` varchar(20) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `bmi` float DEFAULT NULL,
  `systolic` int(11) DEFAULT NULL,
  `diastolic` int(11) DEFAULT NULL,
  `pulse` int(11) DEFAULT NULL,
  `va_aidedr` varchar(10) DEFAULT NULL,
  `va_aidedl` varchar(10) DEFAULT NULL,
  `va_unaidedr` varchar(10) DEFAULT NULL,
  `va_unaidedl` varchar(10) DEFAULT NULL,
  `colour_r` varchar(10) DEFAULT NULL,
  `colour_l` varchar(10) DEFAULT NULL,
  `fundoscopy_r` varchar(10) DEFAULT NULL,
  `fundoscopy_l` varchar(10) DEFAULT NULL,
  `nose` varchar(10) DEFAULT NULL,
  `throat` varchar(10) DEFAULT NULL,
  `neck` varchar(10) DEFAULT NULL,
  `skin` varchar(10) DEFAULT NULL,
  `excanal_r` varchar(10) DEFAULT NULL,
  `excanal_l` varchar(10) DEFAULT NULL,
  `eardrum_r` varchar(10) DEFAULT NULL,
  `eardrum_l` varchar(10) DEFAULT NULL,
  `discharged_r` varchar(10) DEFAULT NULL,
  `discharged_l` varchar(10) DEFAULT NULL,
  `sound` varchar(20) DEFAULT NULL,
  `murmur` varchar(20) DEFAULT NULL,
  `airentry` varchar(10) DEFAULT NULL,
  `chestexp` varchar(10) DEFAULT NULL,
  `breathsound` varchar(10) DEFAULT NULL,
  `liver` varchar(15) DEFAULT NULL,
  `spleen` varchar(15) DEFAULT NULL,
  `kidney` varchar(15) DEFAULT NULL,
  `mentalfunct` varchar(10) DEFAULT NULL,
  `coordination` varchar(10) DEFAULT NULL,
  `gait` varchar(10) DEFAULT NULL,
  `genitalia` varchar(10) DEFAULT NULL,
  `rectal` varchar(10) DEFAULT NULL,
  `lpow_r` varchar(10) DEFAULT NULL,
  `lpow_l` varchar(10) DEFAULT NULL,
  `lref_r` varchar(10) DEFAULT NULL,
  `lref_l` varchar(10) DEFAULT NULL,
  `lsen_r` varchar(10) DEFAULT NULL,
  `lsen_l` varchar(10) DEFAULT NULL,
  `upow_r` varchar(10) DEFAULT NULL,
  `upow_l` varchar(10) DEFAULT NULL,
  `uref_r` varchar(10) DEFAULT NULL,
  `uref_l` varchar(10) DEFAULT NULL,
  `usen_r` varchar(10) DEFAULT NULL,
  `usen_l` varchar(10) DEFAULT NULL,
  `breast` varchar(30) DEFAULT NULL,
  `lmp` varchar(20) DEFAULT NULL,
  `gynaecology` varchar(20) DEFAULT NULL,
  `lastps` varchar(20) DEFAULT NULL,
  `cxr` varchar(50) DEFAULT NULL,
  `ecg` varchar(50) DEFAULT NULL,
  `mammogram` varchar(50) DEFAULT NULL,
  `us_breast` varchar(50) DEFAULT NULL,
  `us_abdopel` varchar(50) DEFAULT NULL,
  `stresstest` varchar(50) DEFAULT NULL,
  `pta` varchar(50) DEFAULT NULL,
  `lft` varchar(50) DEFAULT NULL,
  `urine` varchar(50) DEFAULT NULL,
  `blood` varchar(50) DEFAULT NULL,
  `impression` varchar(300) DEFAULT NULL,
  `recommendation` varchar(300) DEFAULT NULL,
  `lastUpdate` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `doneBy` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`mrn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`mrn`, `appearance`, `weight`, `height`, `bmi`, `systolic`, `diastolic`, `pulse`, `va_aidedr`, `va_aidedl`, `va_unaidedr`, `va_unaidedl`, `colour_r`, `colour_l`, `fundoscopy_r`, `fundoscopy_l`, `nose`, `throat`, `neck`, `skin`, `excanal_r`, `excanal_l`, `eardrum_r`, `eardrum_l`, `discharged_r`, `discharged_l`, `sound`, `murmur`, `airentry`, `chestexp`, `breathsound`, `liver`, `spleen`, `kidney`, `mentalfunct`, `coordination`, `gait`, `genitalia`, `rectal`, `lpow_r`, `lpow_l`, `lref_r`, `lref_l`, `lsen_r`, `lsen_l`, `upow_r`, `upow_l`, `uref_r`, `uref_l`, `usen_r`, `usen_l`, `breast`, `lmp`, `gynaecology`, `lastps`, `cxr`, `ecg`, `mammogram`, `us_breast`, `us_abdopel`, `stresstest`, `pta`, `lft`, `urine`, `blood`, `impression`, `recommendation`, `lastUpdate`, `status`, `doneBy`) VALUES
('1234', 'Underweight', 55, 178, 17.36, 120, 80, 88, '6/6', '6/6', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Healthy', 'Healthy', 'Unhealthy', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Palpable', 'Palpable', 'Palpable', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, NULL, NULL, NULL, 'Normal', 'Normal', NULL, NULL, '-', '-', '-', '-', 'Normal', 'Normal', '1. High in cholestrol', '1. Control diet\r\n2. Exercise more\r\n3. Avoid oily food', '2022-07-05 11:36:39', 1, 'admin'),
('8552', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('7894', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0220', 'Normal', 65, 175, 21.22, 120, 80, 88, '6/6', '6/6', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Healthy', 'Healthy', 'Unhealthy', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Palpable', 'Palpable', 'Palpable', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, NULL, NULL, NULL, 'Normal', 'Normal', NULL, NULL, NULL, NULL, NULL, NULL, 'Normal', 'Normal', 'qwerty', 'uiop', '2022-06-28 07:39:54', 1, NULL),
('9632', 'Underweight', 50, 150, 22.22, 120, 80, 80, '6/6', '6/6', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Healthy', 'Healthy', 'Unhealthy', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Palpable', 'Palpable', 'Palpable', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, NULL, NULL, NULL, 'Normal', 'Normal', NULL, NULL, 'Normal', 'Normal', NULL, NULL, 'Normal', 'Normal', 'asdadsad', 'adadasd', '2022-07-01 08:54:43', 1, 'Dr. Shobana Supramaniam'),
('6881', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('68818', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `name`, `type`) VALUES
(1, 'admin', '@dm1n', 'admin', 'admin'),
(2, 'user1', 'abcd.1234', 'Dr. Shobana Supramaniam', 'doctor'),
(3, 'user', 'test', 'Nurse', 'staff');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
