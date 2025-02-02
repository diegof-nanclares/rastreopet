

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rastreopet`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
                              `entity_id` int NOT NULL,
                              `permission_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `permission_icon` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Icon code: feather https://feathericons.com',
                              `permission_action` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`entity_id`, `permission_name`, `permission_icon`, `permission_action`) VALUES
                                                                                                      (1, 'Usuarios', 'users', '/dashboard'),
                                                                                                      (2, 'Localizadores', 'map-pin', '/qr'),
                                                                                                      (3, 'Mascotas', 'list', '/pet/petsadmin'),
                                                                                                      (4, 'Mi Perfil', 'user', '/profile'),
                                                                                                      (5, 'Mis Mascotas', 'list', '/'),
                                                                                                      (6, 'Cerrar Sesión', 'log-out', '/closesession');

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
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`entity_id`, `name`, `pet_type`, `reward`, `diet`, `clinic_history`, `locator_id`, `alergy`, `img_name`, `medicine`, `pet_breed`, `weight`, `owner_id`, `img_path`, `age`) VALUES
                                                                                                                                                                                                  (53, 'Martín', 'Perro', 100000, '', NULL, NULL, 'Alergia al cuido Bla bla bla.', '667c289205d43.jpg', 'Debe consumir ciertos medicamentos ', 'Shi Tzu', 12, 57, NULL, '1'),
                                                                                                                                                                                                  (54, 'Michi', 'Gato', 0, '', NULL, NULL, '', '6504cf6016a5e.jpg', '', '', 0, 58, NULL, ''),
                                                                                                                                                                                                  (55, 'Freya', 'Perro', 0, 'Nutra nuggets cordero y arroz', NULL, NULL, 'Ninguna ', '65aac29172695.jpg', 'Ninguno \r\n\r\nLa perra está esterilizada y sufre de hemorragias si es herida no coagula bien la sangre ', 'Husky Siberiano ', 22, 59, NULL, '1'),
                                                                                                                                                                                                  (56, 'Tobby', 'Perro', 200000, '', NULL, NULL, '', '66a2ce53058c6.jpg', '', 'Sheltie', 6, 61, NULL, '5'),
                                                                                                                                                                                                  (57, 'Sebastian', 'Perro', 1000, '', NULL, NULL, '', '66a526295af90.png', '', 'Cangrejo', 1, 62, NULL, '1');

-- --------------------------------------------------------

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

--
-- Dumping data for table `position_track_history`
--

INSERT INTO `position_track_history` (`entity_id`, `lattitude`, `longitude`, `pet_id`, `qr_identifier`, `created_at`) VALUES
                                                                                                                          (119, '6.3029021', '-75.5813768', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-14 23:12:19'),
                                                                                                                          (120, '6.3028999', '-75.5813726', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-14 23:13:50'),
                                                                                                                          (122, '6.302903', '-75.5813695', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-14 23:20:42'),
                                                                                                                          (123, '6.302950768089108', '-75.58133283350011', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 09:34:46'),
                                                                                                                          (124, '6.3029556', '-75.5813688', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 11:21:40'),
                                                                                                                          (125, '6.3029154', '-75.5813786', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 11:46:28'),
                                                                                                                          (126, '6.3029154', '-75.5813786', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 11:47:28'),
                                                                                                                          (127, '6.2298743', '-75.5733282', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 13:57:29'),
                                                                                                                          (128, '6.2139732', '-75.5765035', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 16:11:30'),
                                                                                                                          (129, '6.2140236', '-75.5764831', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 16:22:31'),
                                                                                                                          (130, '6.2140234', '-75.5765944', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-09-15 16:37:10'),
                                                                                                                          (131, '6.3379444', '-75.5458569', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-10-13 21:00:13'),
                                                                                                                          (132, '6.3379064', '-75.5458369', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-10-13 21:01:06'),
                                                                                                                          (133, '6.3377072', '-75.5458491', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-10-23 14:54:00'),
                                                                                                                          (134, '6.3377487', '-75.545815', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-10-25 15:55:34'),
                                                                                                                          (135, '6.3262669', '-75.5584378', 53, 'cXI2NTAzNjg1ZDYwZTli', '2023-11-01 21:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `qr_locator`
--

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
-- Dumping data for table `qr_locator`
--

INSERT INTO `qr_locator` (`entity_id`, `qr_identifier`, `image_path`, `enabled`, `pet_id`, `owner_id`, `img_name`, `img_ext`, `pointer_url`) VALUES
                                                                                                                                                 (232, 'cXI2NGYyYTEzMTk3ZWM4', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr64f2a13197ec8.png', 0, NULL, NULL, 'qr64f2a13197ec8', 'png', NULL),
                                                                                                                                                 (233, 'cXI2NGZkZjM1Zjg1MTk3', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr64fdf35f85197.png', 0, NULL, NULL, 'qr64fdf35f85197', 'png', NULL),
                                                                                                                                                 (234, 'cXI2NGZkZjRkZjJkMDk3', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr64fdf4df2d097.png', 0, NULL, NULL, 'qr64fdf4df2d097', 'png', NULL),
                                                                                                                                                 (235, 'cXI2NGZkZjRkZmYwNjcx', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr64fdf4dff0671.png', 0, NULL, NULL, 'qr64fdf4dff0671', 'png', NULL),
                                                                                                                                                 (236, 'cXI2NGZkZmI3OWEwMjhm', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr64fdfb79a028f.png', 0, NULL, NULL, 'qr64fdfb79a028f', 'png', NULL),
                                                                                                                                                 (237, 'cXI2NGZkZmI4ZDA4ZTQ5', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr64fdfb8d08e49.png', 0, NULL, NULL, 'qr64fdfb8d08e49', 'png', NULL),
                                                                                                                                                 (238, 'cXI2NTAxMzM3ZTBkZjky', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr6501337e0df92.png', 0, NULL, NULL, 'qr6501337e0df92', 'png', NULL),
                                                                                                                                                 (239, 'cXI2NTAzNjg1ZDYwZTli', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr6503685d60e9b.png', 1, 53, 57, 'qr6503685d60e9b', 'png', 'https://www.rastreopet.com/checkqrstatus/?qrid=cXI2NTAzNjg1ZDYwZTli'),
                                                                                                                                                 (240, 'cXI2NTA0Y2UwYzgxNGM0', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr6504ce0c814c4.png', 1, 54, 58, 'qr6504ce0c814c4', 'png', 'https://www.rastreopet.com/checkqrstatus/?qrid=cXI2NTA0Y2UwYzgxNGM0'),
                                                                                                                                                 (241, 'cXI2NTBmNWUwNjFiMzBj', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr650f5e061b30c.png', 0, NULL, NULL, 'qr650f5e061b30c', 'png', 'https://www.rastreopet.com/checkqrstatus/?qrid=cXI2NTBmNWUwNjFiMzBj'),
                                                                                                                                                 (242, 'cXI2NWE4NTQ0ZjQ1OThl', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr65a8544f4598e.png', 1, 55, 59, 'qr65a8544f4598e', 'png', 'https://www.rastreopet.com/checkqrstatus/?qrid=cXI2NWE4NTQ0ZjQ1OThl'),
                                                                                                                                                 (243, 'cXI2NjhkZjIwNGE0ZmRk', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr668df204a4fdd.png', 0, NULL, NULL, 'qr668df204a4fdd', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NjhkZjIwNGE0ZmRk'),
                                                                                                                                                 (244, 'cXI2NjhkZjQwZTYyMzc3', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr668df40e62377.png', 0, NULL, NULL, 'qr668df40e62377', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NjhkZjQwZTYyMzc3'),
                                                                                                                                                 (245, 'cXI2NmEyOWI3NDI2NmZk', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr66a29b74266fd.png', 1, 56, 61, 'qr66a29b74266fd', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NmEyOWI3NDI2NmZk'),
                                                                                                                                                 (246, 'cXI2NmE1MjM5MDkzODA1', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr66a5239093805.png', 1, 57, 62, 'qr66a5239093805', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NmE1MjM5MDkzODA1'),
                                                                                                                                                 (247, 'cXI2NmMwZTViNjkwN2Mz', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr66c0e5b6907c3.png', 0, NULL, NULL, 'qr66c0e5b6907c3', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NmMwZTViNjkwN2Mz'),
                                                                                                                                                 (248, 'cXI2NmMwZTVjMmVkNGVk', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr66c0e5c2ed4ed.png', 0, NULL, 65, 'qr66c0e5c2ed4ed', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NmMwZTVjMmVkNGVk'),
                                                                                                                                                 (249, 'cXI2NzViOGZiZTEzYjU3', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr675b8fbe13b57.png', 0, NULL, NULL, 'qr675b8fbe13b57', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2NzViOGZiZTEzYjU3'),
                                                                                                                                                 (250, 'cXI2Nzg1MmQ3YmNmZjli', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr67852d7bcff9b.png', 0, NULL, NULL, 'qr67852d7bcff9b', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2Nzg1MmQ3YmNmZjli'),
                                                                                                                                                 (251, 'cXI2Nzg3MjZjNmIxYjhk', '/home/mrastrem7/public_html/app/Models/Qr/../../../public/static/img/locators/qr678726c6b1b8d.png', 0, NULL, NULL, 'qr678726c6b1b8d', 'png', 'https://rastreopet.com/checkqrstatus/?qrid=cXI2Nzg3MjZjNmIxYjhk');

-- --------------------------------------------------------

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
                                                                                                                                       (1, 'Diego Fernando', 'Salazar Nanclares', '3014255849', NULL, 1, '$2y$12$.Isk5nUzLvU29nz6hlt.Yu3izNG3kTj930aKKMpRZ8IaPs3JGUr0W', 'dsalazar@gmail.com', 1),
                                                                                                                                       (57, 'Jhon 2', 'Doe 2', '30142558491', 'Calle 101 DD #82 F 19 p2', 1, '$2y$12$4cZcwmPs7GgZF6CNPOiPIO5YQYmfw2wRwrf.EWPTFQLQIxVorLilC', 'diegof.nanclares@gmail.com', 1),
                                                                                                                                       (58, 'Pepito', 'Perez', '3043411949', 'Bdjdjzbz', 1, '$2y$12$S7GK42QB1gWQRNtW8Cw0nuyiJYqYkVfUVrCdfF3QTGz3HRb692su2', 'dsalzar@gmail.com', 1),
                                                                                                                                       (59, 'Carolina ', 'Usuga', '3024019346', 'Calle 101 dd # 82 f 17', 2, '$2y$12$mxur.8XOaUYZNZm4ZmFkYeE8sXuPwkGv0rdzqT7M7LeBDL7NsOlbK', 'caro.2405@hotmail.com', 1),
                                                                                                                                       (61, 'Sublismart', 'Diseño y creatividad ', '3043411949', 'Diagonal 50A 38-80', 2, '$2y$12$G6G9PLJ6cFETaFv1PeapsuEhRIYRKOxqEmyr6g/h1plL0fhxKQf2S', 'sublismart@gmail.com', 1),
                                                                                                                                       (62, 'Juan', 'Jimenez', '0000000000', 'Cll xx # xx xx', 2, '$2y$12$dpYkqqhVzg9arGQAn9MQfeXCMM9UKaX/iE5gUC42wq3hvnUblJTju', 'xxxx@xxxx.xxx', 1),
                                                                                                                                       (63, 'Diego Fernando', 'Salazar Nanclares', '3014255849', '', 1, '$2y$12$z8B9lECmQBMEY0BTCijYgO3VCT4WWqE4BDxt31gDubT5/gIDJ./kK', 'dsalazar@gmail.com', 1),
                                                                                                                                       (65, 'Sublismart', 'Diseño y creatividad', '3043411949', 'Av 50 #38-80', 2, '$2y$12$tIODTyoUqtQdM7jh0Qr6geDXslDfATj6qVNaXzUV6BkDiCi6vukHa', 'contactosublismart@gmail.com', 1),
                                                                                                                                       (70, 'test name1', 'test lastname1', '1234567891', '77 Ambassador1', 2, '$2y$12$s2RwQlhkc0e6ek2jb7ZGUeW3660MpjU9CQXMdh.FpHMDlbYhdlyUu', 'testuser1@gmail.com', 0),
                                                                                                                                       (71, NULL, NULL, NULL, NULL, 2, '$2y$12$B/wlhaeT30drwoEPmDWApuVEPeCr3lITl9yq9jhxGUo5JCqjiXzXO', NULL, 0),
                                                                                                                                       (72, 'Prueba1', 'Apellido 1', '3014255849', 'Calle 101 DD #82 F 19', 2, '$2y$12$76kUvKrvVVP4IiUqULA0fulFQIJlaCF.mFtJkj9215.QRrcUDITOG', 'diego@gmail.com', 1),
                                                                                                                                       (73, 'Test2', 'Last name 2', '30467493', 'Calle 101 DD #82 F 19', 2, '$2y$12$0cwbgXDUxU3RH7OHgMY0EuwAslEOovgLqVTlvZHIG0U79sks6UbxW', 'diegof@gmail.com', 1),
                                                                                                                                       (74, 'User 01', 'User 02', '3014255849', 'Bdbdbd', 2, '$2y$12$6eH8qC1buUw5XIytlqidQ.WSajpjzUr9xNDD70ggVNBP07r.wluf.', 'test2@gmail.com', 1),
                                                                                                                                       (75, 'Pedrito ', 'El malito', '3014255849', 'Bsbdbd', 2, '$2y$12$Pc5mkRKjh3sLdQJul/mNwe6bKcgX8KVUVxI4jbHw/anh5ZoM.pply', 'a@a.com', 1),
                                                                                                                                       (76, 'Testuser123', 'testuserlastname', '3673893930', 'cdcdcdcd', 2, '$2y$12$9bVFLAM9qaCBIpGEX0Jt1uHDQa43SJJBErSJnD1IyAMOrD6CSZW.q', 'testuser1234@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

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
  ADD KEY `permission_id` (`permission_id`) USING BTREE;

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
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
    MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
    MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `entity_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissionxrole`
--
ALTER TABLE `permissionxrole`
    ADD CONSTRAINT `foreing_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `permissionxrole_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`entity_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
