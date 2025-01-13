-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2025 at 08:23 PM
-- Server version: 8.0.40-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE rastreopet;
USE rastreopet;


CREATE TABLE `permission` (
  `entity_id` int NOT NULL,
  `permission_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_icon` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Icon code: feather https://feathericons.com',
  `permission_action` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissionxrole`
--

CREATE TABLE `permissionxrole` (
  `entity_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `entity_id` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pet_type` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reward` decimal(45,0) DEFAULT NULL,
  `diet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `clinic_history` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `locator_id` int DEFAULT NULL,
  `alergy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `img_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `medicine` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pet_breed` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(45,0) DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `img_path` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `age` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Table structure for table `pet_type`
--

CREATE TABLE `pet_type` (
  `entity_id` int NOT NULL,
  `type_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position_track_history`
--

CREATE TABLE `position_track_history` (
  `entity_id` int NOT NULL,
  `lattitude` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pet_id` int DEFAULT NULL,
  `qr_identifier` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `qr_locator` (
  `entity_id` int NOT NULL,
  `qr_identifier` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `pet_id` int DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `img_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `img_ext` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pointer_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `entity_id` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_role` int DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_phone_whatsapp` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`entity_id`, `name`, `lastname`, `phone`, `address`, `user_role`, `password`, `username`, `is_phone_whatsapp`) VALUES
(1, 'Diego Fernando', 'Salazar Nanclares', '3014255849', NULL, 1, '$2y$12$.Isk5nUzLvU29nz6hlt.Yu3izNG3kTj930aKKMpRZ8IaPs3JGUr0W', 'dsalazar@gmail.com', 1);

CREATE TABLE `user_role` (
  `entity_id` int NOT NULL,
  `role_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`entity_id`, `role_name`) VALUES
(1, 'Super Administrador'),
(2, 'Cliente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `permissionxrole`
--
ALTER TABLE `permissionxrole`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `foreing_role` (`role_id`),
  ADD KEY `foreign_permission` (`permission_id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `foreign_owner` (`owner_id`);

--
-- Indexes for table `pet_type`
--
ALTER TABLE `pet_type`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `position_track_history`
--
ALTER TABLE `position_track_history`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `foreing_petxposition` (`pet_id`);

--
-- Indexes for table `qr_locator`
--
ALTER TABLE `qr_locator`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `foreign_pet` (`pet_id`),
  ADD KEY `foreign_ownerxlocator` (`owner_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `foreing_rolexuser` (`user_role`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`entity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `position_track_history`
--
ALTER TABLE `position_track_history`
  MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `qr_locator`
--
ALTER TABLE `qr_locator`
  MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissionxrole`
--
ALTER TABLE `permissionxrole`
  ADD CONSTRAINT `foreign_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreing_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `foreign_owner` FOREIGN KEY (`owner_id`) REFERENCES `user` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `position_track_history`
--
ALTER TABLE `position_track_history`
  ADD CONSTRAINT `foreing_petxposition` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `qr_locator`
--
ALTER TABLE `qr_locator`
  ADD CONSTRAINT `foreign_ownerxlocator` FOREIGN KEY (`owner_id`) REFERENCES `user` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreign_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `foreing_rolexuser` FOREIGN KEY (`user_role`) REFERENCES `user_role` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
