-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 24, 2022 at 06:56 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


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
  PRIMARY KEY (`mrn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`mrn`, `name`, `ic_passport`, `date_of_birth`, `address`, `email`, `sex`, `occupation`, `race`, `religion`, `marital_status`, `next_of_kin`, `relationship`, `telephone_nok`, `smoker`, `asthma`, `diabetes`, `heart_disease`, `hypertension`, `stroke`, `cancer`, `tuberculosis`, `skin_disease`, `kidneyp`, `fits_psychiatric`, `father_history`, `mother_history`, `siblings_history`, `habits`, `allergy`, `others`, `medication`, `package`, `lastUpdateMH`, `registeredOn`) VALUES
('5555', 'Adam Mukhreez Jamaludin', '021209100743', '2002-12-09', '3 Jalan Emas 1, Taman Melawis', 'adammukhreez2002@gmail.com', 'Male', 'student', 'malay', 'islam', 'Single', 'Jamaludin', 'father', '0193206165', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', '-', '-', '-', '-', 'cats', 'lactose intolerant', '-', '', '2022-06-24 04:11:21', '2022-06-21 07:17:58'),
('4565', 'Adam Mukhreez Jamaludin', '021209100743', '1998-06-10', '3 Jalan Emas 1, Taman Melawis', 'adammukhreez2002@gmail.com', 'Male', 'accountant', 'malay', 'islam', 'Seperated', 'Adam Mukhreez Jamaludin', 'friend', '01121002835', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', '-', '-', '-', '-', '-', '-', '-', 'Comprehensive', '2022-06-23 02:07:00', '2022-06-23 01:32:19'),
('55555', 'Aiman', '030330103303', '2003-03-30', '3 Jalan Emas 1, Taman Melawis', 'man@mail.com', 'Male', '', 'malay', 'islam', 'Married', 'Aina', 'Wife', '0156564842', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Comprehensive', NULL, '2022-06-24 00:57:01');

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
  PRIMARY KEY (`mrn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`mrn`, `appearance`, `weight`, `height`, `bmi`, `systolic`, `diastolic`, `pulse`, `va_aidedr`, `va_aidedl`, `va_unaidedr`, `va_unaidedl`, `colour_r`, `colour_l`, `fundoscopy_r`, `fundoscopy_l`, `nose`, `throat`, `neck`, `skin`, `excanal_r`, `excanal_l`, `eardrum_r`, `eardrum_l`, `discharged_r`, `discharged_l`, `sound`, `murmur`, `airentry`, `chestexp`, `breathsound`, `liver`, `spleen`, `kidney`, `mentalfunct`, `coordination`, `gait`, `genitalia`, `rectal`, `lpow_r`, `lpow_l`, `lref_r`, `lref_l`, `lsen_r`, `lsen_l`, `upow_r`, `upow_l`, `uref_r`, `uref_l`, `usen_r`, `usen_l`, `breast`, `lmp`, `gynaecology`, `lastps`, `cxr`, `ecg`, `mammogram`, `us_breast`, `us_abdopel`, `stresstest`, `pta`, `lft`, `urine`, `blood`, `impression`, `recommendation`, `lastUpdate`, `status`) VALUES
('5555', 'Normal', 88, 190, 24.38, 120, 82, 85, '6/6', '6/6', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Healthy', 'Healthy', 'Unhealthy', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Palpable', 'Palpable', 'Palpable', 'Normal', 'Normal', 'Normal', 'Unknown', 'Unknown', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'NA', 'NA', 'NA', 'NA', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'abcdefghijklmnopqrstuvwxyz', 'zyxwvutsrqponmlkjihgfedcba', '2022-06-24 03:30:32', 1),
('4565', 'Underweight', 50, 180, 15.43, 120, 80, 80, 'vaidedr', 'vaidedl', 'vuaidr', 'vuaidl', 'clrr', 'clrl', 'funr', 'funl', 'nose', 'throat', 'neck', 'skin', 'excr', 'excl', 'edr', 'edl', 'dcr', 'dcl', 'sound', 'murmurrrr', 'Normal', 'Normal', 'Normal', 'Palpable', 'Palpable', 'Palpable', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'lpr', 'lpl', 'lrr', 'lrl', 'lsr', 'lsl', 'upr', 'upl', 'urr', 'url', 'usr', 'usl', 'breast', 'lmp', 'gynae', 'lps', 'cxr', 'ecg', 'mammo', 'usb', 'usap', 'st', 'pta', 'lft', 'urine', 'blood', 'impressed', 'recommended', '2022-06-24 01:16:33', 1),
('55555', 'Underweight', 55, 180, 16.98, 120, 80, 80, '6/6', '6/6', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Healthy', 'Healthy', 'Unhealthy', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Palpable', 'Palpable', 'Palpable', 'Normal', 'Normal', 'Normal', 'Unknown', 'Unknown', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'NA', 'NA', 'NA', 'NA', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', '1324658', '845612498465132', '2022-06-24 03:16:11', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
