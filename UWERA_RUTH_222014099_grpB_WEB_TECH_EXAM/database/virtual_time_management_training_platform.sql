-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:28 AM
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
-- Database: `virtual_time_management_training_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `AttendeeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`AttendeeID`, `UserID`) VALUES
(4, 1),
(2, 4),
(1, 5),
(3, 5),
(5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `CertificateID` int(11) NOT NULL,
  `AttendeeID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `IssueDate` date DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `CertificateLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`CertificateID`, `AttendeeID`, `WorkshopID`, `IssueDate`, `ExpiryDate`, `CertificateLink`) VALUES
(1, 1, 5, '2024-06-01', '2024-07-01', 'https://example.com/certificate-attendee1'),
(2, 4, 4, '2024-06-15', '2024-07-15', 'https://example.com/certificate-attendee2'),
(3, 3, 3, '2024-07-01', '2024-08-01', 'https://example.com/certificate-attendee3'),
(4, 1, 2, '2024-07-15', '2024-08-15', 'https://example.com/certificate-attendee4'),
(5, 2, 1, '2024-08-01', '2024-09-01', 'https://example.com/certificate-attendee5');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `EnrollmentID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `AttendeeID` int(11) NOT NULL,
  `EnrollmentDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`EnrollmentID`, `WorkshopID`, `AttendeeID`, `EnrollmentDate`) VALUES
(1, 1, 2, '2024-05-01 00:00:00'),
(2, 2, 3, '2024-05-02 00:00:00'),
(3, 3, 1, '2024-05-03 00:00:00'),
(4, 4, 4, '2024-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `AttendeeID` int(11) NOT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `WorkshopID`, `AttendeeID`, `Rating`, `Comments`) VALUES
(1, 1, 5, 4, 'Great workshop! Learned a lot about time management.'),
(2, 2, 3, 5, 'Instructor was very knowledgeable and engaging.'),
(3, 3, 2, 4, 'The planning techniques were really helpful.'),
(4, 4, 1, 5, 'Excellent session! Lots of practical tips.'),
(5, 5, 4, 4, 'Enjoyed learning about advanced time optimization strategies.');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Bio` text DEFAULT NULL,
  `Expertise` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `UserID`, `Bio`, `Expertise`) VALUES
(1, 4, 'Experienced time management instructor', 'Time Management'),
(2, 1, 'Certified productivity coach', 'Productivity'),
(3, 4, 'Experienced speaker on time management', 'Time Management'),
(4, 5, 'Expert in personal productivity strategies', 'Productivity'),
(5, 9, 'Certified trainer in time management techniques', 'Time Management');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `MaterialID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`MaterialID`, `WorkshopID`, `Title`, `Description`, `Link`) VALUES
(1, 1, 'Time Management Worksheet', 'Worksheet to help you prioritize tasks and manage time effectively.', 'https://example.com/time-management-worksheet'),
(2, 5, 'Productivity Toolkit', 'Toolkit containing templates and tools for enhancing productivity.', 'https://example.com/productivity-toolkit'),
(3, 3, 'Effective Planning Guide', 'Guide to help you plan your tasks and activities efficiently.', 'https://example.com/effective-planning-guide'),
(4, 4, 'Efficiency Hacks eBook', 'Ebook with hacks and tips to improve personal efficiency.', 'https://example.com/efficiency-hacks-ebook'),
(5, 2, 'Time Optimization Checklist', 'Checklist to optimize your time management strategies.', 'https://example.com/time-optimization-checklist');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `SessionID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `SessionTitle` varchar(255) NOT NULL,
  `SessionDescription` text DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`SessionID`, `WorkshopID`, `SessionTitle`, `SessionDescription`, `StartTime`, `EndTime`) VALUES
(1, 5, 'Introduction to Time Management', 'Overview of key concepts in time management.', '2024-06-01 09:00:00', '2024-06-01 10:00:00'),
(2, 2, 'Setting SMART Goals', 'Learn to set goals that are Specific, Measurable, Achievable, Relevant, and Time-bound.', '2024-06-15 10:00:00', '2024-06-15 11:30:00'),
(3, 3, 'Effective Planning Techniques', 'Techniques to plan your tasks and activities effectively.', '2024-07-01 11:00:00', '2024-07-01 12:30:00'),
(4, 4, 'Boosting Personal Efficiency', 'Strategies to enhance your personal efficiency for better productivity.', '2024-07-15 09:30:00', '2024-07-15 11:30:00'),
(5, 3, 'Time Optimization Strategies', 'Learn advanced strategies to optimize your time for maximum productivity.', '2024-08-01 10:30:00', '2024-08-01 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `time_management_resources`
--

CREATE TABLE `time_management_resources` (
  `ResourceID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_management_resources`
--

INSERT INTO `time_management_resources` (`ResourceID`, `Title`, `Description`, `Link`) VALUES
(1, 'Time Management Guide', 'Comprehensive guide to effective time management.', 'https://example.com/time-management-guide'),
(2, 'Productivity Tips eBook', 'Get tips and tricks to enhance your productivity.', 'https://example.com/productivity-tips'),
(3, 'Effective Scheduling Techniques', 'Learn how to create efficient schedules for better time management.', 'https://example.com/scheduling-techniques'),
(4, 'Priority Matrix Template', 'Template to prioritize tasks based on urgency and importance.', 'https://example.com/priority-matrix-template'),
(5, 'Time Tracking Tool', 'Tool to track time spent on different activities for better time management.', 'https://example.com/time-tracking-tool');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'uwera', 'ruth', '222014099', 'uwerarth22@gmail.com', '0782064741', '$2y$10$8wSSw.M4HcSl8CMfNxV8sOx11O8DcjaHnSLVJssDu/wmD9gBl1cX.', '2024-05-18 11:17:19', '33344', 0),
(4, 'Mutuyimana ', 'francine', 'franc', 'mutuyimaamina@52gamil.com', '0781234565', '$2y$10$J/7r2LbsEoq/huB/m0kj5.S2BY2QKNeM9Iza9L/uR7Zhc4nTraWzK', '2024-05-18 16:23:01', '44455', 0),
(5, 'hirwa ', 'phionah', 'phio', 'rthuwera22@gmail.com', '0781434760', '$2y$10$s0Xt1tRYzcfWktmjmJ1G0ecA7DkcDEf/Nu8FTeWBeabQF3N2yFZPK', '2024-05-18 16:23:55', '23333', 0),
(9, 'titia', 'phionah', 'ingabire', 'phiohirwa22@gmail.com', '0781434760', '$2y$10$ELiVgQJIOF6XNtInmHVciOGtIxci2f.dmsHYi3Awj9VRI88q1Ytmm', '2024-05-18 16:25:25', '23333', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `WorkshopID` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`WorkshopID`, `InstructorID`, `Title`, `Description`, `Date`, `Time`, `Duration`, `Capacity`) VALUES
(1, 2, 'Effective Time Management', 'Learn to manage your time efficiently.', '2024-06-01', '09:00:00', 120, 50),
(2, 3, 'Mastering Productivity', 'Boost your productivity with proven techniques.', '2024-06-15', '10:00:00', 90, 30),
(3, 4, 'Time Management Workshop', 'Practical strategies for better time management.', '2024-07-01', '11:00:00', 90, 40),
(4, 5, 'Productivity Masterclass', 'Advanced techniques to enhance personal productivity.', '2024-07-15', '09:30:00', 120, 25),
(5, 1, 'Effective Time Utilization', 'Optimize your time utilization for greater productivity.', '2024-08-01', '10:30:00', 90, 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`AttendeeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`CertificateID`),
  ADD KEY `AttendeeID` (`AttendeeID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `WorkshopID` (`WorkshopID`),
  ADD KEY `AttendeeID` (`AttendeeID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `WorkshopID` (`WorkshopID`),
  ADD KEY `AttendeeID` (`AttendeeID`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`InstructorID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`MaterialID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `time_management_resources`
--
ALTER TABLE `time_management_resources`
  ADD PRIMARY KEY (`ResourceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`WorkshopID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `AttendeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `CertificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `time_management_resources`
--
ALTER TABLE `time_management_resources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `WorkshopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`),
  ADD CONSTRAINT `certificates_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
