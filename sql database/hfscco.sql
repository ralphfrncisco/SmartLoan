-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 02:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hfscco`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(200) NOT NULL,
  `actor` varchar(200) NOT NULL,
  `timestamp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `action`, `actor`, `timestamp`) VALUES
(610, 'Signed-in', 'membership.comm@gmail.com', '2024-11-11 23:39:50'),
(611, 'Edited account details of member KR8790', 'Membership Pesonnel', '2024-11-11 23:43:26'),
(612, 'Signed-in', 'aizelangeles@gmail.com', '2024-11-11 23:43:38'),
(613, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:44:10'),
(614, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:45:07'),
(615, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:45:46'),
(616, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:45:52'),
(617, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:47:30'),
(618, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:47:33'),
(619, 'Signed-in', 'membership.comm@gmail.com', '2024-11-11 23:48:04'),
(620, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-11 23:48:14'),
(621, 'Signed-in', 'membership.comm@gmail.com', '2024-11-11 23:52:47'),
(622, 'Signed-in', 'francis.dacillo@gmail.com', '2024-11-12 00:00:44'),
(623, 'Signed-in', 'francis.dacillo@gmail.com', '2024-11-12 00:03:11'),
(624, 'Signed-in', 'membership.comm@gmail.com', '2024-11-12 00:46:19'),
(625, 'Edited account details of member KR2078', 'Membership Pesonnel', '2024-11-12 00:46:30'),
(626, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-12 00:46:52'),
(627, 'Signed-in', 'membership.comm@gmail.com', '2024-11-12 09:56:14'),
(628, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-12 20:04:40'),
(629, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-12 20:09:18'),
(630, 'Evaluated Loan Application (ID: 40) of member #KR2078', 'Loan Personnel', '2024-11-12 20:10:06'),
(631, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 10:57:41'),
(632, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 10:59:21'),
(633, 'Signed-in', 'credit.comm@gmail.com', '2024-11-13 11:08:19'),
(634, 'Signed-in', 'credit.comm@gmail.com', '2024-11-13 11:08:50'),
(635, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 11:09:25'),
(636, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 11:09:54'),
(637, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 11:34:02'),
(638, 'Signed-in', 'credit.comm@gmail.com', '2024-11-13 11:34:55'),
(639, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 11:35:39'),
(640, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 11:36:49'),
(641, 'Signed-in', 'francis.dacillo@gmail.com', '2024-11-13 11:42:29'),
(642, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 11:45:32'),
(643, 'Signed-in', 'francis.dacillo@gmail.com', '2024-11-13 11:54:51'),
(644, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 11:58:10'),
(645, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 12:01:02'),
(646, 'Signed-in', 'membership.comm@gmail.com', '2024-11-13 13:59:43'),
(647, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 14:00:06'),
(648, 'Signed-in', 'francis.dacillo@gmail.com', '2024-11-13 14:00:21'),
(649, 'Evaluated Loan Application (ID: 40) of member #KR2078', 'CEO', '2024-11-13 14:00:50'),
(650, 'Signed-in', 'credit.comm@gmail.com', '2024-11-13 14:01:19'),
(651, 'Evaluated Loan Application (ID: 40) of member #KR2078', 'Director', '2024-11-13 14:01:41'),
(652, 'Signed-in', 'board2@gmail.com', '2024-11-13 14:03:10'),
(653, 'Evaluated Loan Application (ID: 40) of member #KR2078', 'Director', '2024-11-13 14:04:26'),
(654, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 14:04:39'),
(655, 'Signed-in', 'board3@gmail.com', '2024-11-13 14:06:24'),
(656, 'Evaluated Loan Application (ID: 40) of member #KR2078', 'Director', '2024-11-13 14:06:45'),
(657, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 14:06:51'),
(658, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 07:34:45'),
(659, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 09:21:19'),
(660, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-13 09:21:38'),
(661, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 09:21:58'),
(662, 'Evaluated Loan Application (ID: 41) of member #KR2078', 'Loan Personnel', '2024-11-13 09:22:13'),
(663, 'Signed-in', 'francis.dacillo@gmail.com', '2024-11-13 09:22:19'),
(664, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-13 10:02:28'),
(665, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-13 10:02:40'),
(666, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-16 16:22:11'),
(667, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-16 16:22:22'),
(668, 'Signed-in', 'loanPersonnel@gmail.com', '2024-11-16 17:01:13'),
(669, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-23 08:06:54'),
(670, 'Signed-in', 'ralphfrancisco1623@gmail.com', '2024-11-23 11:04:14'),
(671, 'Signed-in', 'membership.comm@gmail.com', '2024-12-02 12:56:36'),
(672, 'Signed-in', 'manuel.carlito@gmail.com', '2024-12-02 13:38:13'),
(673, 'Signed-in', 'manuel.carlito@gmail.com', '2024-12-02 13:39:12'),
(674, 'Signed-in', 'manuel.carlito@gmail.com', '2024-12-02 13:40:00'),
(675, 'Signed-in', 'manuel.carlito@gmail.com', '2024-12-02 13:40:05'),
(676, 'Signed-in', 'membership.comm@gmail.com', '2024-12-02 13:41:00'),
(677, 'Edited account details of member KR8795', 'Membership Personnel', '2024-12-02 20:41:17'),
(678, 'Signed-in', 'membership.comm@gmail.com', '2024-12-02 13:54:00'),
(679, 'Signed-in', 'manuel.carlito@gmail.com', '2024-12-02 13:54:23'),
(680, 'Signed-in', 'membership.comm@gmail.com', '2024-12-02 13:54:30'),
(681, 'Edited account details of member KR9071', 'Membership Personnel', '2024-12-02 20:54:49'),
(682, 'Signed-in', 'manuel.carlito@gmail.com', '2024-12-02 13:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `bod_approvals`
--

CREATE TABLE `bod_approvals` (
  `bod_evaluation_id` int(11) NOT NULL,
  `bod_acc_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `account_id` varchar(11) DEFAULT NULL,
  `bod_loanType` varchar(255) DEFAULT NULL,
  `bod_loanAmount` int(11) DEFAULT NULL,
  `bod_loanTerm` int(11) DEFAULT NULL,
  `bod_remarks` varchar(255) DEFAULT NULL,
  `board_approvalStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bod_approvals`
--

INSERT INTO `bod_approvals` (`bod_evaluation_id`, `bod_acc_id`, `application_id`, `account_id`, `bod_loanType`, `bod_loanAmount`, `bod_loanTerm`, `bod_remarks`, `board_approvalStatus`) VALUES
(52, 9992, 40, 'KR2078', '(GAFL)Gadget-Appliance-Furniture Loan', 31500, 6, 'grabeh.', 'Approved with Modification'),
(53, 9993, 40, 'KR2078', '(GAFL)Gadget-Appliance-Furniture Loan', 31500, 7, 'ok ok ok', 'Approved with Modification');

-- --------------------------------------------------------

--
-- Table structure for table `ceo_approvals`
--

CREATE TABLE `ceo_approvals` (
  `ceo_evaluation_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `account_id` varchar(11) DEFAULT NULL,
  `CEO_loanType` varchar(255) DEFAULT NULL,
  `CEO_loanAmount` int(11) DEFAULT NULL,
  `CEO_loanTerm` int(11) DEFAULT NULL,
  `CEO_remarks` varchar(255) DEFAULT NULL,
  `CEO_approvalStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ceo_approvals`
--

INSERT INTO `ceo_approvals` (`ceo_evaluation_id`, `application_id`, `account_id`, `CEO_loanType`, `CEO_loanAmount`, `CEO_loanTerm`, `CEO_remarks`, `CEO_approvalStatus`) VALUES
(17, 40, 'KR2078', '(GAFL)Gadget-Appliance-Furniture Loan', 30000, 7, 'wrong loan product category                  ', 'Approved with Modification'),
(18, 41, 'KR2078', '', NULL, NULL, '                                ', 'Disapproved');

-- --------------------------------------------------------

--
-- Table structure for table `creditcomm_approvals`
--

CREATE TABLE `creditcomm_approvals` (
  `creditcomm_evaluation_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `creditcomm_loanType` varchar(255) DEFAULT NULL,
  `creditcomm_loanAmount` varchar(255) DEFAULT NULL,
  `creditcomm_loanTerm` varchar(255) DEFAULT NULL,
  `creditcomm_remarks` varchar(255) DEFAULT NULL,
  `creditcomm_approvalStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creditcomm_approvals`
--

INSERT INTO `creditcomm_approvals` (`creditcomm_evaluation_id`, `application_id`, `account_id`, `creditcomm_loanType`, `creditcomm_loanAmount`, `creditcomm_loanTerm`, `creditcomm_remarks`, `creditcomm_approvalStatus`) VALUES
(19, 40, 'KR2078', '(GAFL)Gadget-Appliance-Furniture Loan', '31000', '7', 'bigyan natin pang casing', 'Approved with Modification');

-- --------------------------------------------------------

--
-- Table structure for table `financial_db`
--

CREATE TABLE `financial_db` (
  `application_id` int(11) NOT NULL,
  `loan_Amount` decimal(10,2) NOT NULL,
  `date_applied` varchar(100) NOT NULL,
  `loan_term_applied` varchar(10) NOT NULL,
  `loan_interest` varchar(10) NOT NULL,
  `loan_type` varchar(100) NOT NULL,
  `manner_of_payment` varchar(100) NOT NULL,
  `loan_purpose` varchar(500) NOT NULL,
  `account_id` varchar(11) DEFAULT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `Suffix` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `type_of_application` varchar(100) NOT NULL,
  `application_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_db`
--

INSERT INTO `financial_db` (`application_id`, `loan_Amount`, `date_applied`, `loan_term_applied`, `loan_interest`, `loan_type`, `manner_of_payment`, `loan_purpose`, `account_id`, `LastName`, `FirstName`, `MiddleName`, `Suffix`, `email`, `contact_no`, `type_of_application`, `application_status`) VALUES
(40, 35000.00, '11/12/2024', '8', '22', '(PL)Personal Loan', 'Walk In', 'pambili cellphone', 'KR2078', 'Francisco', 'Ralph', '', '', 'ralphfrancisco1623@gmail.com', '09811223334', 'New', 'For BOD Evaluation'),
(41, 5500.00, '11/13/2024', '6', '24', '(VL)Vendors Loan', 'Walk In', 'asdasdasdsa', 'KR2078', 'Francisco', 'Ralph', '', '', 'ralphfrancisco1623@gmail.com', '09811223334', 'Select Type', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `loan_balance`
--

CREATE TABLE `loan_balance` (
  `unique_ref` varchar(50) NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `loan` varchar(100) NOT NULL,
  `granted` varchar(255) NOT NULL,
  `balance` varchar(10) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `total` varchar(255) NOT NULL,
  `data_as_of` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_balance`
--

INSERT INTO `loan_balance` (`unique_ref`, `account_id`, `member_name`, `loan`, `granted`, `balance`, `interest`, `total`, `data_as_of`) VALUES
('KR3640IL45678', 'KR3640', 'REYES, NIKOLO', 'IL', 'November 13, 2024', '421780', '21780', '421780', 'December 13, 2024');

-- --------------------------------------------------------

--
-- Table structure for table `loan_person_approvals`
--

CREATE TABLE `loan_person_approvals` (
  `loanPersonnel_evaluationID` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `account_id` varchar(11) NOT NULL,
  `outstanding_loanType` varchar(255) DEFAULT NULL,
  `outstanding_balance` varchar(255) DEFAULT NULL,
  `outstanding_interestOnLoans` varchar(255) DEFAULT NULL,
  `outstanding_Fines` varchar(255) DEFAULT NULL,
  `outstanding_PastDueInterest` varchar(255) DEFAULT NULL,
  `loanPersonnel_loanType` varchar(255) DEFAULT NULL,
  `loanPersonnel_loanAmount` varchar(255) DEFAULT NULL,
  `loanPersonnel_loanTerm` varchar(255) DEFAULT NULL,
  `loanPersonnel_remarks` varchar(255) DEFAULT NULL,
  `loanPersonnel_approvalStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_person_approvals`
--

INSERT INTO `loan_person_approvals` (`loanPersonnel_evaluationID`, `application_id`, `account_id`, `outstanding_loanType`, `outstanding_balance`, `outstanding_interestOnLoans`, `outstanding_Fines`, `outstanding_PastDueInterest`, `loanPersonnel_loanType`, `loanPersonnel_loanAmount`, `loanPersonnel_loanTerm`, `loanPersonnel_remarks`, `loanPersonnel_approvalStatus`) VALUES
(20, 40, 'KR2078', '(SEL)Small Enterprise Loan', '123', '123', '123', '123', '(PL)Personal Loan', '30000', '6', '                                bakit 8 months?', 'Approved with Modification'),
(21, 41, 'KR2078', '', '', '', '', '', '(FLL-PROV)Fast Lane Loan (Providential)', '99999', '12', '                            121212    ', 'Approved with Modification');

-- --------------------------------------------------------

--
-- Table structure for table `members_acc`
--

CREATE TABLE `members_acc` (
  `account_id` varchar(11) NOT NULL,
  `application_num` bigint(20) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `access_type` varchar(100) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members_acc`
--

INSERT INTO `members_acc` (`account_id`, `application_num`, `Email`, `password`, `access_type`, `status`) VALUES
('1980', NULL, 'francis.dacillo@gmail.com', '7253d39e75db2d6d8686d47237e1166b', 'ceo', 'Active'),
('2', NULL, 'loanPersonnel@gmail.com', 'e2dc5641d26055af1349addc44b9b51d', 'loan_personnel', 'Active'),
('4', NULL, 'membership.comm@gmail.com', '49b68025891acea17b56e81f281e2515', 'membership_committee', 'Active'),
('5', NULL, 'credit.comm@gmail.com', 'b49824f02051f386c2a1b31c0a3102d6', 'credit_committee', 'Active'),
('9991', NULL, 'board1@gmail.com', 'd9020aeddc7bf68ea12bb21ac5c29030', 'board_of_director', 'Active'),
('9992', NULL, 'board2@gmail.com', 'baf222f10f4e46ec958ad489e1f7b7d7', 'board_of_director', 'Active'),
('9993', NULL, 'board3@gmail.com', 'ea7626428d20d618af048d81c4d98aeb', 'board_of_director', 'Active'),
('9994', NULL, 'board4@gmail.com', '7969fc587a9a4ab981bac2f8fd46542e', 'board_of_director', 'Active'),
('9995', NULL, 'board5@gmail.com', '0a21970151743798d334c659c7e5727c', 'board_of_director', 'Active'),
('9996', NULL, 'board6@gmail.com', '59a0c65521f41ab7322d7d3bcd5ef555', 'board_of_director', 'Active'),
('9997', NULL, 'board7@gmail.com', '64b0edb6db862d659290ee6bbbe3d0b4', 'board_of_director', 'Active'),
('KR2078', NULL, 'ralphfrancisco1623@gmail.com', '17ac1e525f8a398ef3431566b1bd1a19', 'member', 'Active'),
('KR9071', 202449022064, 'manuel.carlito@gmail.com', 'c28bbe0ef3adb7134a3ce058cc01ddda', 'member', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `members_db`
--

CREATE TABLE `members_db` (
  `application_num` bigint(20) DEFAULT NULL,
  `account_id` varchar(11) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) NOT NULL,
  `Suffix` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `educ_attainment` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `DateTime` varchar(200) NOT NULL,
  `approval_time` varchar(200) NOT NULL,
  `approval_status` varchar(100) NOT NULL,
  `acc_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members_db`
--

INSERT INTO `members_db` (`application_num`, `account_id`, `profile_pic`, `LastName`, `FirstName`, `MiddleName`, `Suffix`, `address`, `contact_no`, `email_address`, `gender`, `date_of_birth`, `place_of_birth`, `occupation`, `civil_status`, `educ_attainment`, `password`, `DateTime`, `approval_time`, `approval_status`, `acc_status`) VALUES
(202446120065, 'KR2078', '../uploads/profile_pics/profile_6741b2f8d4f491.56571389.jpeg', 'Francisco', 'Ralph', '', '', '278 McArthur', '09811223334', 'ralphfrancisco1623@gmail.com', 'Male', '2024-10-29', 'N/A', 'College Student', 'Single', 'Senior_High_School', '17ac1e525f8a398ef3431566b1bd1a19', 'November 12, 2024, 12:46 am', 'November 12, 2024, 12:46 am', 'Fully Approved', 'Active'),
(202449022064, 'KR9071', '../uploads/profile_pics/profile_674daf75896128.45439208.jpg', 'Manuel', 'Carlito', '', '', 'Bagong Bayan', '09273346918', 'manuel.carlito@gmail.com', 'Male', '2023-06-02', 'ewan', 'Tambay', 'Married', 'Elementary', 'c28bbe0ef3adb7134a3ce058cc01ddda', 'December 2, 2024, 8:53 pm', 'December 2, 2024, 8:54 pm', 'Fully Approved', 'Active'),
(202449022096, 'PND1316', '', 'Azuelo', 'Owen', '', '', 'Marilao', '09623188230', 'owen.azuelo123@gmail.com', 'Male', '2024-12-04', 'ewan', 'Painter', 'Single', 'High_School', '2eb97eae4041e1a9b837181d2ee51eb5', 'December 2, 2024, 8:03 pm', '', '', 'Pending'),
(202449021958, 'PND4279', '', 'Angeles', 'Aizel', 'Dellomas', '', 'Malabon City', '09811223334', 'angeles.aizel@gmail.com', 'Male', '2024-09-10', 'ewan', 'College Student', 'Single', 'Senior_High_School', '91dfa78404e04633208f36c46bc1b6da', 'December 2, 2024, 7:58 pm', '', '', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bod_approvals`
--
ALTER TABLE `bod_approvals`
  ADD PRIMARY KEY (`bod_evaluation_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `ceo_approvals`
--
ALTER TABLE `ceo_approvals`
  ADD PRIMARY KEY (`ceo_evaluation_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `creditcomm_approvals`
--
ALTER TABLE `creditcomm_approvals`
  ADD PRIMARY KEY (`creditcomm_evaluation_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `financial_db`
--
ALTER TABLE `financial_db`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `financial_db_ibfk_1` (`account_id`);

--
-- Indexes for table `loan_balance`
--
ALTER TABLE `loan_balance`
  ADD PRIMARY KEY (`unique_ref`);

--
-- Indexes for table `loan_person_approvals`
--
ALTER TABLE `loan_person_approvals`
  ADD PRIMARY KEY (`loanPersonnel_evaluationID`),
  ADD KEY `fk_application_id` (`application_id`);

--
-- Indexes for table `members_acc`
--
ALTER TABLE `members_acc`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `members_db`
--
ALTER TABLE `members_db`
  ADD PRIMARY KEY (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=683;

--
-- AUTO_INCREMENT for table `bod_approvals`
--
ALTER TABLE `bod_approvals`
  MODIFY `bod_evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `ceo_approvals`
--
ALTER TABLE `ceo_approvals`
  MODIFY `ceo_evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `creditcomm_approvals`
--
ALTER TABLE `creditcomm_approvals`
  MODIFY `creditcomm_evaluation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `financial_db`
--
ALTER TABLE `financial_db`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `loan_person_approvals`
--
ALTER TABLE `loan_person_approvals`
  MODIFY `loanPersonnel_evaluationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `financial_db`
--
ALTER TABLE `financial_db`
  ADD CONSTRAINT `financial_db_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `members_db` (`account_id`),
  ADD CONSTRAINT `fk_account_id` FOREIGN KEY (`account_id`) REFERENCES `members_db` (`account_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
