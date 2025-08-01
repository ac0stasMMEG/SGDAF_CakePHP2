-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2024 at 05:38 PM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `follow_ca`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 462),
(2, 1, NULL, NULL, 'ApprovalTypes', 2, 13),
(3, 2, NULL, NULL, 'index', 3, 4),
(4, 2, NULL, NULL, 'view', 5, 6),
(5, 2, NULL, NULL, 'add', 7, 8),
(6, 2, NULL, NULL, 'edit', 9, 10),
(7, 2, NULL, NULL, 'delete', 11, 12),
(8, 1, NULL, NULL, 'Approvals', 14, 47),
(9, 8, NULL, NULL, 'index', 15, 16),
(10, 8, NULL, NULL, 'view', 17, 18),
(11, 8, NULL, NULL, 'add', 19, 20),
(12, 8, NULL, NULL, 'add_duty', 21, 22),
(13, 8, NULL, NULL, 'edit', 23, 24),
(14, 8, NULL, NULL, 'delete', 25, 26),
(15, 8, NULL, NULL, 'send_email', 27, 28),
(16, 8, NULL, NULL, 'return_duty', 29, 30),
(17, 1, NULL, NULL, 'AttachmentTypes', 48, 59),
(18, 17, NULL, NULL, 'index', 49, 50),
(19, 17, NULL, NULL, 'view', 51, 52),
(20, 17, NULL, NULL, 'add', 53, 54),
(21, 17, NULL, NULL, 'edit', 55, 56),
(22, 17, NULL, NULL, 'delete', 57, 58),
(23, 1, NULL, NULL, 'Attachments', 60, 77),
(24, 23, NULL, NULL, 'index', 61, 62),
(25, 23, NULL, NULL, 'view', 63, 64),
(26, 23, NULL, NULL, 'add', 65, 66),
(27, 23, NULL, NULL, 'edit', 67, 68),
(28, 23, NULL, NULL, 'delete', 69, 70),
(29, 23, NULL, NULL, 'attach_file', 71, 72),
(30, 1, NULL, NULL, 'Charges', 78, 89),
(31, 30, NULL, NULL, 'index', 79, 80),
(32, 30, NULL, NULL, 'view', 81, 82),
(33, 30, NULL, NULL, 'add', 83, 84),
(34, 30, NULL, NULL, 'edit', 85, 86),
(35, 30, NULL, NULL, 'delete', 87, 88),
(36, 1, NULL, NULL, 'Duties', 90, 111),
(37, 36, NULL, NULL, 'index', 91, 92),
(38, 36, NULL, NULL, 'view', 93, 94),
(39, 36, NULL, NULL, 'add', 95, 96),
(40, 36, NULL, NULL, 'edit', 97, 98),
(41, 36, NULL, NULL, 'delete', 99, 100),
(42, 36, NULL, NULL, 'duty_options', 101, 102),
(43, 36, NULL, NULL, 'delete_blank', 103, 104),
(44, 1, NULL, NULL, 'DutyCategories', 112, 123),
(45, 44, NULL, NULL, 'index', 113, 114),
(46, 44, NULL, NULL, 'view', 115, 116),
(47, 44, NULL, NULL, 'add', 117, 118),
(48, 44, NULL, NULL, 'edit', 119, 120),
(49, 44, NULL, NULL, 'delete', 121, 122),
(50, 1, NULL, NULL, 'DutyMinistries', 124, 171),
(51, 50, NULL, NULL, 'index', 125, 126),
(52, 50, NULL, NULL, 'index_duty_ministry', 127, 128),
(53, 50, NULL, NULL, 'view', 129, 130),
(54, 50, NULL, NULL, 'add', 131, 132),
(55, 50, NULL, NULL, 'edit', 133, 134),
(56, 50, NULL, NULL, 'delete', 135, 136),
(57, 50, NULL, NULL, 'find_parent', 137, 138),
(58, 50, NULL, NULL, 'get_status', 139, 140),
(59, 50, NULL, NULL, 'get_buttons', 141, 142),
(60, 50, NULL, NULL, 'get_button_send', 143, 144),
(61, 1, NULL, NULL, 'DutyTypes', 172, 183),
(62, 61, NULL, NULL, 'index', 173, 174),
(63, 61, NULL, NULL, 'view', 175, 176),
(64, 61, NULL, NULL, 'add', 177, 178),
(65, 61, NULL, NULL, 'edit', 179, 180),
(66, 61, NULL, NULL, 'delete', 181, 182),
(67, 1, NULL, NULL, 'EvaluationDutyMinistries', 184, 239),
(68, 67, NULL, NULL, 'index', 185, 186),
(69, 67, NULL, NULL, 'view', 187, 188),
(70, 67, NULL, NULL, 'add', 189, 190),
(71, 67, NULL, NULL, 'detail', 191, 192),
(72, 67, NULL, NULL, 'edit', 193, 194),
(73, 67, NULL, NULL, 'delete', 195, 196),
(74, 67, NULL, NULL, 'get_value', 197, 198),
(75, 1, NULL, NULL, 'EvaluationTypes', 240, 251),
(76, 75, NULL, NULL, 'index', 241, 242),
(77, 75, NULL, NULL, 'view', 243, 244),
(78, 75, NULL, NULL, 'add', 245, 246),
(79, 75, NULL, NULL, 'edit', 247, 248),
(80, 75, NULL, NULL, 'delete', 249, 250),
(81, 1, NULL, NULL, 'Evaluations', 252, 275),
(82, 81, NULL, NULL, 'index', 253, 254),
(83, 81, NULL, NULL, 'view', 255, 256),
(84, 81, NULL, NULL, 'add', 257, 258),
(85, 81, NULL, NULL, 'edit', 259, 260),
(86, 81, NULL, NULL, 'delete', 261, 262),
(87, 1, NULL, NULL, 'Groups', 276, 287),
(88, 87, NULL, NULL, 'index', 277, 278),
(89, 87, NULL, NULL, 'view', 279, 280),
(90, 87, NULL, NULL, 'add', 281, 282),
(91, 87, NULL, NULL, 'edit', 283, 284),
(92, 87, NULL, NULL, 'delete', 285, 286),
(93, 1, NULL, NULL, 'Ministries', 288, 299),
(94, 93, NULL, NULL, 'index', 289, 290),
(95, 93, NULL, NULL, 'view', 291, 292),
(96, 93, NULL, NULL, 'add', 293, 294),
(97, 93, NULL, NULL, 'edit', 295, 296),
(98, 93, NULL, NULL, 'delete', 297, 298),
(99, 1, NULL, NULL, 'Pages', 300, 303),
(100, 99, NULL, NULL, 'display', 301, 302),
(101, 1, NULL, NULL, 'People', 304, 319),
(102, 101, NULL, NULL, 'index', 305, 306),
(103, 101, NULL, NULL, 'view', 307, 308),
(104, 101, NULL, NULL, 'add', 309, 310),
(105, 101, NULL, NULL, 'edit', 311, 312),
(106, 101, NULL, NULL, 'delete', 313, 314),
(107, 1, NULL, NULL, 'Periods', 320, 331),
(108, 107, NULL, NULL, 'index', 321, 322),
(109, 107, NULL, NULL, 'view', 323, 324),
(110, 107, NULL, NULL, 'add', 325, 326),
(111, 107, NULL, NULL, 'edit', 327, 328),
(112, 107, NULL, NULL, 'delete', 329, 330),
(113, 1, NULL, NULL, 'QuestionTypes', 332, 343),
(114, 113, NULL, NULL, 'index', 333, 334),
(115, 113, NULL, NULL, 'view', 335, 336),
(116, 113, NULL, NULL, 'add', 337, 338),
(117, 113, NULL, NULL, 'edit', 339, 340),
(118, 113, NULL, NULL, 'delete', 341, 342),
(119, 1, NULL, NULL, 'Users', 344, 363),
(120, 119, NULL, NULL, 'index', 345, 346),
(121, 119, NULL, NULL, 'view', 347, 348),
(122, 119, NULL, NULL, 'add', 349, 350),
(123, 119, NULL, NULL, 'edit', 351, 352),
(124, 119, NULL, NULL, 'delete', 353, 354),
(125, 119, NULL, NULL, 'login', 355, 356),
(126, 119, NULL, NULL, 'logout', 357, 358),
(127, 1, NULL, NULL, 'AclExtras', 364, 365),
(128, 67, NULL, NULL, 'calcularSize', 199, 200),
(129, 119, NULL, NULL, 'initDB', 359, 360),
(130, 8, NULL, NULL, 'read', 31, 32),
(131, 67, NULL, NULL, 'pdf', 201, 202),
(132, 1, NULL, NULL, 'CakePdf', 366, 367),
(133, 50, NULL, NULL, 'index_goal_ministry', 145, 146),
(134, 67, NULL, NULL, 'add_goal', 203, 204),
(135, 67, NULL, NULL, 'detail_modal', 205, 206),
(136, 67, NULL, NULL, 'detail_goal', 207, 208),
(137, 50, NULL, NULL, 'get_status2', 147, 148),
(138, 50, NULL, NULL, 'get_buttons2', 149, 150),
(139, 8, NULL, NULL, 'add_goal', 33, 34),
(140, 8, NULL, NULL, 'return_goal', 35, 36),
(141, 1, NULL, NULL, 'PersonCharges', 368, 379),
(142, 141, NULL, NULL, 'index', 369, 370),
(143, 141, NULL, NULL, 'view', 371, 372),
(144, 141, NULL, NULL, 'add', 373, 374),
(145, 141, NULL, NULL, 'edit', 375, 376),
(146, 141, NULL, NULL, 'delete', 377, 378),
(147, 1, NULL, NULL, 'Dashboards', 380, 391),
(148, 147, NULL, NULL, 'index', 381, 382),
(149, 147, NULL, NULL, 'view', 383, 384),
(150, 147, NULL, NULL, 'add', 385, 386),
(151, 147, NULL, NULL, 'edit', 387, 388),
(152, 147, NULL, NULL, 'delete', 389, 390),
(153, 101, NULL, NULL, 'home', 315, 316),
(154, 119, NULL, NULL, 'captcha', 361, 362),
(155, 1, NULL, NULL, 'Captcha', 392, 393),
(156, 50, NULL, NULL, 'index_goal_leader_sectoralist', 151, 152),
(157, 50, NULL, NULL, 'get_status3', 153, 154),
(158, 50, NULL, NULL, 'get_buttons3', 155, 156),
(159, 67, NULL, NULL, 'add_goal_leader_sectoralist', 209, 210),
(160, 101, NULL, NULL, 'right', 317, 318),
(161, 67, NULL, NULL, 'view_goal', 211, 212),
(162, 67, NULL, NULL, 'detail_goal_leader_sectoralist', 213, 214),
(163, 8, NULL, NULL, 'add_goal_leader_sectoralist', 37, 38),
(164, 50, NULL, NULL, 'index_goal_executive_secretary', 157, 158),
(165, 1, NULL, NULL, 'PersonMinistries', 394, 405),
(166, 165, NULL, NULL, 'index', 395, 396),
(167, 165, NULL, NULL, 'view', 397, 398),
(168, 165, NULL, NULL, 'add', 399, 400),
(169, 165, NULL, NULL, 'edit', 401, 402),
(170, 165, NULL, NULL, 'delete', 403, 404),
(171, 50, NULL, NULL, 'index_right_executive_secretary', 159, 160),
(172, 50, NULL, NULL, 'get_status4', 161, 162),
(173, 50, NULL, NULL, 'get_buttons4', 163, 164),
(174, 67, NULL, NULL, 'add_right', 215, 216),
(175, 67, NULL, NULL, 'detail_right', 217, 218),
(176, 67, NULL, NULL, 'view_right', 219, 220),
(177, 8, NULL, NULL, 'add_right', 39, 40),
(178, 8, NULL, NULL, 'return_right', 41, 42),
(179, 67, NULL, NULL, 'graphics', 221, 222),
(180, 36, NULL, NULL, 'index_organizations', 105, 106),
(181, 36, NULL, NULL, 'edit_organizations', 107, 108),
(182, 1, NULL, NULL, 'DutyOrganizations', 406, 417),
(183, 182, NULL, NULL, 'index', 407, 408),
(184, 182, NULL, NULL, 'view', 409, 410),
(185, 182, NULL, NULL, 'add', 411, 412),
(186, 182, NULL, NULL, 'edit', 413, 414),
(187, 182, NULL, NULL, 'delete', 415, 416),
(188, 67, NULL, NULL, 'organization_duties', 223, 224),
(189, 1, NULL, NULL, 'Organizations', 418, 439),
(190, 189, NULL, NULL, 'index', 419, 420),
(191, 189, NULL, NULL, 'view', 421, 422),
(192, 189, NULL, NULL, 'add', 423, 424),
(193, 189, NULL, NULL, 'edit', 425, 426),
(194, 189, NULL, NULL, 'delete', 427, 428),
(237, 23, NULL, NULL, 'view_repository', 75, 76),
(236, 23, NULL, NULL, 'repository', 73, 74),
(201, 50, NULL, NULL, 'index_right_civil_society', 165, 166),
(202, 50, NULL, NULL, 'get_status5', 167, 168),
(203, 50, NULL, NULL, 'get_buttons5', 169, 170),
(204, 67, NULL, NULL, 'add_society_secretary', 225, 226),
(205, 67, NULL, NULL, 'detail_society_secretary', 227, 228),
(206, 67, NULL, NULL, 'graphics2', 229, 230),
(207, 8, NULL, NULL, 'add_society_secretary', 43, 44),
(208, 8, NULL, NULL, 'return_right_society', 45, 46),
(209, 81, NULL, NULL, 'annual_report', 263, 264),
(210, 67, NULL, NULL, 'view_org', 231, 232),
(211, 67, NULL, NULL, 'get_value_organization', 233, 234),
(212, 67, NULL, NULL, 'find_child', 235, 236),
(213, 67, NULL, NULL, 'pdf2', 237, 238),
(214, 1, NULL, NULL, 'Answers', 440, 461),
(215, 214, NULL, NULL, 'index', 441, 442),
(216, 214, NULL, NULL, 'view', 443, 444),
(217, 214, NULL, NULL, 'add', 445, 446),
(218, 214, NULL, NULL, 'edit', 447, 448),
(219, 214, NULL, NULL, 'delete', 449, 450),
(220, 36, NULL, NULL, 'civil_society', 109, 110),
(221, 81, NULL, NULL, 'index_annual_report', 265, 266),
(222, 81, NULL, NULL, 'pdf', 267, 268),
(223, 81, NULL, NULL, 'save_field', 269, 270),
(224, 81, NULL, NULL, 'form', 271, 272),
(225, 81, NULL, NULL, 'get_info', 273, 274),
(226, 189, NULL, NULL, 'inscription', 429, 430),
(227, 189, NULL, NULL, 'edit_organization', 431, 432),
(228, 189, NULL, NULL, 'captcha', 433, 434),
(229, 189, NULL, NULL, 'home', 435, 436),
(230, 189, NULL, NULL, 'change_pass', 437, 438),
(231, 214, NULL, NULL, 'binnacle', 451, 452),
(232, 214, NULL, NULL, 'view_binnacle', 453, 454),
(233, 214, NULL, NULL, 'index_binnacle', 455, 456),
(234, 214, NULL, NULL, 'get_value', 457, 458),
(235, 214, NULL, NULL, 'delete_binnacle', 459, 460);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` char(36) NOT NULL,
  `evaluation_id` char(36) NOT NULL,
  `answer` blob NOT NULL,
  `group` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_answers_evaluations1_idx` (`evaluation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
CREATE TABLE IF NOT EXISTS `approvals` (
  `id` char(36) NOT NULL,
  `person_id` char(36) NOT NULL,
  `approval_type_id` char(36) NOT NULL,
  `duty_ministry_id` char(36) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `read` tinyint(4) DEFAULT '0',
  `observation` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_approvals_approval_types1_idx` (`approval_type_id`),
  KEY `fk_approvals_duty_ministries1_idx` (`duty_ministry_id`),
  KEY `fk_approvals_people1_idx` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `person_id`, `approval_type_id`, `duty_ministry_id`, `level`, `status`, `active`, `read`, `observation`, `created`, `modified`) VALUES
('01c893eb-ab5d-4e66-b360-4a3a0dbeb27c', '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 3, 1, 0, 0, NULL, '2024-01-10 21:00:21', '2024-01-10 21:00:21'),
('026fe98d-23d6-4d36-91ca-3964d56cc732', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 1, 1, 0, 0, NULL, '2024-01-10 20:57:51', '2024-01-10 20:57:51'),
('05b18809-c6b7-4621-ba0e-7bda13074a30', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 2, 0, 0, 0, NULL, '2024-01-10 18:08:10', '2024-01-10 18:08:10'),
('060c666c-eb8c-4c50-9113-d66e09b08d9c', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 4, 1, 1, 0, NULL, '2024-01-10 18:52:12', '2024-01-10 18:52:12'),
('12cddf27-6336-4ffc-81bd-6725c9d3b5ea', '8d975715-6ec8-4a33-ab48-a4be30401aab', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', 2, 1, 0, 0, NULL, '2024-01-10 19:23:16', '2024-01-10 19:23:16'),
('1421f92d-0872-4048-a457-8eb823505832', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 2, 1, 0, 0, NULL, '2024-01-10 18:34:06', '2024-01-10 18:34:06'),
('164b85d2-0781-4b9d-800c-7d9eb5ae0ffc', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '44d2097c-c378-4c01-9f60-790218be1e0f', 2, 0, 0, 0, NULL, '2024-01-10 20:56:12', '2024-01-10 20:56:12'),
('1c8ec97e-eb84-4775-b4af-55c4e1e16f8b', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 1, 1, 0, 0, NULL, '2024-01-10 20:38:03', '2024-01-10 20:38:03'),
('1db3f41c-3b02-44dd-8878-a52e3bd77ef8', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', 4, 1, 1, 0, NULL, '2024-01-11 11:20:46', '2024-01-11 11:20:46'),
('1e989905-1315-4edd-8f68-2cd266255398', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '44d2097c-c378-4c01-9f60-790218be1e0f', 1, 1, 0, 0, NULL, '2024-01-10 20:38:03', '2024-01-10 20:38:03'),
('23226718-2937-4842-933e-0bcb48aab24a', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 2, 0, 0, 0, NULL, '2024-01-10 17:08:50', '2024-01-10 17:08:50'),
('2403be69-69a8-43e4-86ac-8f0ea9969e78', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 2, 0, 0, 0, NULL, '2024-01-10 18:08:10', '2024-01-10 18:08:10'),
('26f987c6-a980-4b16-b34d-d554dfd1b477', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 3, 1, 0, 0, NULL, '2024-01-10 18:34:40', '2024-01-10 18:34:40'),
('293e8fea-3231-4124-95b7-67314b01eff6', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 2, 0, 0, 0, NULL, '2024-01-10 17:08:50', '2024-01-10 17:08:50'),
('29611264-227c-49c7-9414-1cc54c4f59ad', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', '97d46c47-2e4b-4571-b024-a1e520206658', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 1, 1, 1, 0, NULL, '2024-01-11 12:01:00', '2024-01-11 12:01:00'),
('2c177a48-6506-408e-8af7-16da0b670e67', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 1, 0, 0, NULL, '2024-01-10 18:35:37', '2024-01-10 18:35:37'),
('316d59ff-7d86-44ea-9587-a4bddae98132', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 2, 1, 0, 0, NULL, '2024-01-10 20:58:55', '2024-01-10 20:58:55'),
('33517f7d-5a10-4c8e-99ec-60adbb925605', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '44d2097c-c378-4c01-9f60-790218be1e0f', 1, 1, 0, 0, NULL, '2024-01-10 20:57:51', '2024-01-10 20:57:51'),
('39d69d69-31f9-422b-a320-b12c29a43ae5', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 2, 0, 0, 0, NULL, '2024-01-10 18:08:10', '2024-01-10 18:08:10'),
('3a01149b-b556-4fd2-a263-43752786aad1', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 4, 1, 0, 0, NULL, '2024-01-10 18:51:03', '2024-01-10 18:51:03'),
('3b5ec7c8-c5c9-46de-bd91-fa4e149707ce', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 4, 1, 0, 0, NULL, '2024-01-10 18:35:37', '2024-01-10 18:35:37'),
('3bf35aa2-06c3-472f-9169-499b9dbabcc4', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 2, 0, 0, 0, 'adassad', '2024-01-10 17:58:57', '2024-01-10 17:58:57'),
('3f93e9b9-ad6b-4922-9c09-b3bd2afe078d', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 3, 1, 0, 0, NULL, '2024-01-10 17:30:23', '2024-01-10 17:30:23'),
('40b21692-661f-4929-8703-0f21e6f00f73', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 1, 1, 0, 0, NULL, '2024-01-10 18:32:03', '2024-01-10 18:32:03'),
('44f06494-bd90-4991-b17b-96aae8db2c72', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 4, 1, 0, 0, NULL, '2024-01-10 18:51:03', '2024-01-10 18:51:03'),
('4d451b3c-8437-4a09-bbdc-4ff18a259307', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 4, 1, 0, 0, NULL, '2024-01-10 18:47:29', '2024-01-10 18:47:29'),
('4e09f0b3-68ac-4278-9aef-35a25f18e479', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 1, 1, 0, 0, NULL, '2024-01-10 17:58:29', '2024-01-10 17:58:29'),
('5180206c-f38d-4783-b89b-2eba622fbb08', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 1, 1, 0, 0, NULL, '2024-01-10 16:37:12', '2024-01-10 16:37:12'),
('57a83f29-aaee-4b01-a5a0-310965ebcdc1', '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '44d2097c-c378-4c01-9f60-790218be1e0f', 3, 1, 0, 0, NULL, '2024-01-10 21:00:21', '2024-01-10 21:00:21'),
('59cbae8d-019e-45f2-8345-c9586fca0e2b', 'dff794b2-60e2-4592-b5a7-f16f698a0559', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '5209fee7-2288-4e47-bcac-1bbadd3ac467', 1, 1, 0, 0, NULL, '2024-01-10 18:58:10', '2024-01-10 18:58:10'),
('5ba79061-ef6a-45fc-b741-f5db7f4ca87b', 'dff794b2-60e2-4592-b5a7-f16f698a0559', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '55b9d685-43b9-4042-8d85-64682fb377a8', 1, 1, 0, 0, NULL, '2024-01-10 18:58:10', '2024-01-10 18:58:10'),
('5bcef104-40c1-4305-8878-5b7a76074b95', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 4, 1, 0, 0, NULL, '2024-01-10 18:35:37', '2024-01-10 18:35:37'),
('5be201fe-575b-4ec3-82aa-f5d430e53f8f', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 2, 1, 0, 0, NULL, '2024-01-10 20:58:55', '2024-01-10 20:58:55'),
('5dc9f6e8-0c29-4504-b084-c3ece6f66c48', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 1, 1, 0, 0, NULL, '2024-01-10 16:37:12', '2024-01-10 16:37:12'),
('5e355291-1666-4fff-9815-5b99965d7144', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 4, 1, 1, 0, NULL, '2024-01-10 21:03:39', '2024-01-10 21:03:39'),
('5eb1dd3a-27f7-4d0a-bad8-6ac28586a9a9', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', '97d46c47-2e4b-4571-b024-a1e520206658', '476d6a00-5b33-479b-95c2-e49f237be040', 1, 1, 0, 0, NULL, '2024-01-11 11:53:38', '2024-01-11 11:53:38'),
('5f4a1864-5afa-4296-a105-41ce9b0f4a84', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 2, 0, 0, 1, NULL, '2024-01-10 18:08:10', '2024-01-10 18:08:10'),
('61d184f7-29ef-4d8e-b05d-2ab7e94cbe54', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 4, 1, 0, 0, NULL, '2024-01-10 18:47:29', '2024-01-10 18:47:29'),
('65c37bd1-5f58-43a1-9b32-837f1d184d41', '6bc7162d-6899-454b-98ed-07b7032c701e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', 3, 1, 0, 0, NULL, '2024-01-11 11:19:17', '2024-01-11 11:19:17'),
('65c6a9bd-429e-4f5b-bcc2-4f4527f062f6', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 1, 1, 0, 0, NULL, '2024-01-10 16:37:12', '2024-01-10 16:37:12'),
('6769ecc9-1864-4432-88e4-55e509314f5b', 'dff794b2-60e2-4592-b5a7-f16f698a0559', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', 1, 1, 0, 0, NULL, '2024-01-10 18:58:10', '2024-01-10 18:58:10'),
('6984cfab-1ca1-4a4b-b2ae-33b732776cad', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 3, 1, 0, 0, NULL, '2024-01-10 18:34:40', '2024-01-10 18:34:40'),
('6b34aa02-700a-4398-8cec-2b97514a7348', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 2, 1, 0, 0, NULL, '2024-01-10 18:34:06', '2024-01-10 18:34:06'),
('6de2e9fd-e35b-4410-9636-b6db02c06188', '8d975715-6ec8-4a33-ab48-a4be30401aab', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '55b9d685-43b9-4042-8d85-64682fb377a8', 2, 1, 0, 0, NULL, '2024-01-10 19:23:16', '2024-01-10 19:23:16'),
('7012a22d-bb0a-4fa1-b15e-41480ddf09db', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 1, 1, 0, 0, NULL, '2024-01-10 20:38:03', '2024-01-10 20:38:03'),
('71b2792f-eec1-4f25-8394-6afa54c4aeab', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 1, 0, 0, NULL, '2024-01-10 18:35:15', '2024-01-10 18:35:15'),
('736e54b7-2804-477d-87ad-bbbf40b8a4f7', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 2, 0, 0, 1, NULL, '2024-01-10 17:08:50', '2024-01-10 17:08:50'),
('75b0c6f6-c227-48e6-9f9e-873536e7cad1', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '44d2097c-c378-4c01-9f60-790218be1e0f', 4, 1, 1, 0, NULL, '2024-01-10 21:03:39', '2024-01-10 21:03:39'),
('78e0d3c0-98db-484b-a73b-5a6620c0e0e3', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 3, 1, 0, 0, NULL, '2024-01-10 17:30:23', '2024-01-10 17:30:23'),
('7beebe91-21a8-4b4e-b938-6de4da45a3af', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 1, 1, 0, 0, NULL, '2024-01-10 20:57:51', '2024-01-10 20:57:51'),
('808ff1f2-4cb1-4f3d-bdfc-8c43416cdc76', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 4, 0, 0, 0, NULL, '2024-01-10 17:54:57', '2024-01-10 17:54:57'),
('80e65c5b-d47d-434e-9b6a-57cecf672d7f', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 0, 0, 1, NULL, '2024-01-10 17:54:57', '2024-01-10 17:54:57'),
('87bcb201-c687-4702-98bd-6949e4c27544', '6bc7162d-6899-454b-98ed-07b7032c701e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '5209fee7-2288-4e47-bcac-1bbadd3ac467', 3, 1, 0, 0, NULL, '2024-01-11 11:19:17', '2024-01-11 11:19:17'),
('89537563-5e65-47e5-928b-8c27eaae1f4e', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 1, 1, 0, 0, NULL, '2024-01-10 20:38:03', '2024-01-10 20:38:03'),
('89c3c775-065e-4d04-95b2-7d4376a5e17d', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 1, 1, 0, 0, NULL, '2024-01-10 16:37:12', '2024-01-10 16:37:12'),
('8badfa3a-af4d-4e71-a4a1-dc6508dc74c1', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 4, 1, 1, 0, NULL, '2024-01-10 21:03:39', '2024-01-10 21:03:39'),
('8c71cc90-cc23-4ef0-a8f3-916ca5584fbd', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 2, 0, 0, 0, NULL, '2024-01-10 20:56:12', '2024-01-10 20:56:12'),
('8dbc0fd7-52d0-44b5-ab33-abee86672133', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 1, 1, 0, 0, NULL, '2024-01-10 18:32:03', '2024-01-10 18:32:03'),
('94576ea2-4212-4c20-a21f-acec5ec9c52e', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 1, 1, 0, 0, NULL, '2024-01-10 17:58:29', '2024-01-10 17:58:29'),
('953ce676-2059-42c3-8a90-ad916925dc19', '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 3, 1, 0, 0, NULL, '2024-01-10 21:00:21', '2024-01-10 21:00:21'),
('969b0e8e-1766-4b45-8c8f-ac71e0eb309d', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 1, 0, 0, NULL, '2024-01-10 18:47:29', '2024-01-10 18:47:29'),
('98c6f31b-a848-4156-bcdd-2cbb070c59b5', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 1, 0, 0, NULL, '2024-01-10 18:51:03', '2024-01-10 18:51:03'),
('9903537b-f303-4ca4-8c94-b7356bd303d1', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 4, 1, 0, 0, NULL, '2024-01-10 18:52:12', '2024-01-10 18:52:12'),
('9b260cee-6b91-4b46-b6f9-6df08653f156', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 3, 1, 0, 0, NULL, '2024-01-10 18:34:40', '2024-01-10 18:34:40'),
('9bd3ad6f-f318-4239-b5da-755c1031c15b', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 1, 1, 0, 0, NULL, '2024-01-10 18:32:03', '2024-01-10 18:32:03'),
('a1284fa6-eaba-4ebf-a499-fc9a8c320838', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 4, 1, 0, 0, NULL, '2024-01-10 18:52:12', '2024-01-10 18:52:12'),
('a1f28567-fc70-4a0e-b1cd-f98f65ab29fe', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 2, 0, 0, 1, 'Hola Camila', '2024-01-10 20:50:03', '2024-01-10 20:50:03'),
('a5c3b99d-c6ab-4d99-9b9b-d7854dfee81d', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 4, 1, 0, 0, NULL, '2024-01-10 18:35:37', '2024-01-10 18:35:37'),
('ab750c86-687e-4a38-90e1-f50ac4ed1cc1', '6bc7162d-6899-454b-98ed-07b7032c701e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '55b9d685-43b9-4042-8d85-64682fb377a8', 3, 1, 0, 0, NULL, '2024-01-11 11:19:17', '2024-01-11 11:19:17'),
('ad87aeed-c3e1-4712-864a-49f973eb8aad', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 3, 1, 0, 0, NULL, '2024-01-10 17:30:23', '2024-01-10 17:30:23'),
('af56ab7c-ca2f-4776-9950-6ea589e0e6d9', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 1, 0, 0, NULL, '2024-01-10 18:52:12', '2024-01-10 18:52:12'),
('b1eeb5a7-b065-46c1-bbfe-25e574f71bf8', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 4, 1, 0, 0, NULL, '2024-01-10 18:47:29', '2024-01-10 18:47:29'),
('b4225bf2-4825-4d90-a8bf-a70981b10b63', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 1, 1, 0, 0, NULL, '2024-01-10 20:57:51', '2024-01-10 20:57:51'),
('b5576761-5997-4226-90e4-1adbab732eb7', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 2, 0, 0, 0, NULL, '2024-01-10 17:08:50', '2024-01-10 17:08:50'),
('b7e65cde-3739-4b82-850c-5349c8d1bdbd', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 4, 1, 0, 0, NULL, '2024-01-10 18:35:15', '2024-01-10 18:35:15'),
('b965e513-4376-4128-a102-0483bd783528', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 4, 1, 0, 0, NULL, '2024-01-10 18:35:15', '2024-01-10 18:35:15'),
('ba1c1760-aed4-4e9c-bd8a-f9f86787982d', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 4, 1, 0, 0, NULL, '2024-01-10 18:51:03', '2024-01-10 18:51:03'),
('bf8733eb-42c0-4b35-bbfd-7cbd2db67922', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 3, 1, 0, 0, NULL, '2024-01-10 17:30:23', '2024-01-10 17:30:23'),
('c1c9fefe-c811-4952-8a51-a546d2aa82ac', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 2, 1, 0, 0, NULL, '2024-01-10 18:34:06', '2024-01-10 18:34:06'),
('c515fe37-3337-40db-9f22-b2e2877bc76d', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '44d2097c-c378-4c01-9f60-790218be1e0f', 2, 1, 0, 0, NULL, '2024-01-10 20:58:55', '2024-01-10 20:58:55'),
('c626b8af-dd60-4fc1-bac4-d8e43a2fed6b', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 1, 1, 0, 0, NULL, '2024-01-10 18:32:03', '2024-01-10 18:32:03'),
('c77f3606-6795-4c00-8af0-6bce2e57d945', '8d975715-6ec8-4a33-ab48-a4be30401aab', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '5209fee7-2288-4e47-bcac-1bbadd3ac467', 2, 1, 0, 0, NULL, '2024-01-10 19:23:16', '2024-01-10 19:23:16'),
('cfba38e9-063f-4feb-bb5b-c747ee99d4d7', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', '97d46c47-2e4b-4571-b024-a1e520206658', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 1, 1, 1, 0, NULL, '2024-01-11 12:37:00', '2024-01-11 12:37:00'),
('d36f49d6-7204-4eda-a4e4-1ece5943f3b9', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '5209fee7-2288-4e47-bcac-1bbadd3ac467', 4, 1, 1, 0, NULL, '2024-01-11 11:20:46', '2024-01-11 11:20:46'),
('d8f8aa1d-fec0-4096-8a67-4bc0ff89873e', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 2, 1, 0, 0, NULL, '2024-01-10 20:58:55', '2024-01-10 20:58:55'),
('dbf9f6c9-b9b1-4f1b-ae50-5be81a868a7f', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 1, 1, 0, 0, NULL, '2024-01-10 17:58:29', '2024-01-10 17:58:29'),
('ddb1a908-fecc-46ed-8a7a-86aba151137e', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 4, 1, 1, 0, NULL, '2024-01-10 21:03:39', '2024-01-10 21:03:39'),
('ddfbbfd4-e711-4319-8d9c-d284cd510d99', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', '97d46c47-2e4b-4571-b024-a1e520206658', '476d6a00-5b33-479b-95c2-e49f237be040', 4, 1, 1, 0, NULL, '2024-01-11 12:49:36', '2024-01-11 12:49:36'),
('dee1186d-44af-4184-8c0e-c8aeba455714', '96661e52-6288-4cb2-8384-425c7093e28d', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 2, 0, 0, 0, NULL, '2024-01-10 20:56:12', '2024-01-10 20:56:12'),
('e1044a2c-9aae-4b0a-890f-dfdf9c704414', '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 3, 1, 0, 0, NULL, '2024-01-10 21:00:21', '2024-01-10 21:00:21'),
('e10b3b6b-3f97-43d8-9a7a-c148e4b261eb', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 4, 0, 0, 0, 'adssadas', '2024-01-10 17:53:06', '2024-01-10 17:53:06'),
('e1b17ef3-9b2b-4ffd-9811-7c598d7de3af', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 4, 1, 0, 0, NULL, '2024-01-10 18:35:15', '2024-01-10 18:35:15'),
('e28083ca-9423-442d-863b-356b59dcead5', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '476d6a00-5b33-479b-95c2-e49f237be040', 3, 1, 0, 0, NULL, '2024-01-10 18:34:40', '2024-01-10 18:34:40'),
('eac6ef4c-31fb-4844-8bd7-d435e3e32ff4', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '55b9d685-43b9-4042-8d85-64682fb377a8', 4, 1, 1, 0, NULL, '2024-01-11 11:20:46', '2024-01-11 11:20:46'),
('ed2c64e6-b5c0-433d-8bfb-7913a4899836', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 1, 1, 0, 0, NULL, '2024-01-10 17:58:29', '2024-01-10 17:58:29'),
('f43ffa8b-8d72-45dd-8a5d-d15b77b4e411', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'aa48cb9a-9960-4327-aaf8-db52207f453f', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 2, 1, 0, 0, NULL, '2024-01-10 18:34:06', '2024-01-10 18:34:06'),
('f459280b-bed6-49d2-a45c-e383cedc233a', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'aa48cb9a-9960-4327-aaf8-db52207f453f', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 4, 0, 0, 0, NULL, '2024-01-10 17:54:57', '2024-01-10 17:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `approval_types`
--

DROP TABLE IF EXISTS `approval_types`;
CREATE TABLE IF NOT EXISTS `approval_types` (
  `id` char(36) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approval_types`
--

INSERT INTO `approval_types` (`id`, `name`, `created`, `modified`) VALUES
('27726501-74f9-4940-972d-35e459bfff4c', 'Cuarto Nivel', '2023-12-07 18:58:59', '2023-12-07 18:58:59'),
('639be73c-1007-4cbd-9249-aaec84ac6364', 'Sexto nivel', '2023-12-25 19:30:33', '2023-12-25 19:30:33'),
('6b6e60a7-942e-4bae-a183-0726f1008ebf', 'Tercer Nivel', '2023-11-16 02:47:53', '2023-11-16 02:47:53'),
('97d46c47-2e4b-4571-b024-a1e520206658', 'Segundo Nivel', '2023-10-02 01:12:39', '2023-10-02 01:12:39'),
('aa48cb9a-9960-4327-aaf8-db52207f453f', 'Primer Nivel', '2023-08-30 01:41:54', '2023-08-30 01:41:54'),
('d65641cd-c090-4183-8ed5-95c92ac7341e', 'Quinto nivel', '2023-12-25 19:30:15', '2023-12-25 19:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 2),
(2, NULL, 'Group', 2, NULL, 3, 6),
(3, NULL, 'Group', 3, NULL, 7, 10),
(4, NULL, 'Group', 4, NULL, 11, 14),
(5, NULL, 'Group', 5, NULL, 15, 18),
(6, 2, 'User', 6, NULL, 4, 5),
(7, 3, 'User', 7, NULL, 8, 9),
(8, 4, 'User', 8, NULL, 12, 13),
(9, 5, 'User', 9, NULL, 16, 17),
(10, NULL, 'Group', 6, NULL, 19, 20),
(11, NULL, 'Group', 7, NULL, 21, 22),
(12, NULL, 'Group', 8, NULL, 23, 24);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '1', '1', '1', '1'),
(3, 3, 1, '1', '1', '1', '1'),
(4, 4, 1, '1', '1', '1', '1'),
(5, 5, 1, '1', '1', '1', '1'),
(6, 10, 1, '1', '1', '1', '1'),
(7, 11, 1, '1', '1', '1', '1'),
(8, 12, 1, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` char(36) NOT NULL,
  `evaluation_duty_ministry_id` char(36) DEFAULT NULL,
  `attachment_type_id` char(36) NOT NULL,
  `answer_id` char(36) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `data` mediumblob,
  `size` int(11) DEFAULT NULL,
  `view` tinyint(4) DEFAULT '1',
  `web` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachments_attachment_types1_idx` (`attachment_type_id`),
  KEY `fk_attachments_evaluation_duty_ministries1_idx` (`evaluation_duty_ministry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `evaluation_duty_ministry_id`, `attachment_type_id`, `answer_id`, `name`, `description`, `type`, `data`, `size`, `view`, `web`, `created`, `modified`) VALUES
('1c9b6675-fa78-4074-aab8-020a08fcf6a3', 'd0ad31c0-82c4-40f6-bbd5-ba7d30db8bb6', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Correos Web PI_MGC (1).docx', 'dsasad', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 17916, 1, 0, '2024-01-10 18:57:49', '2024-01-10 18:57:49'),
('1ea548d1-ac0e-43f7-a370-35d4eae2f0fb', 'df3d5cd1-f49a-4cd9-8e37-5ae20368390a', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Ministerio (1) (1).docx', 'dasdds', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 16356, 1, 0, '2024-01-09 12:59:03', '2024-01-09 12:59:03'),
('21cea8ed-8973-4427-8781-1fea37498f80', 'ad97b78a-f347-40b9-b209-d6b7883558ed', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Correos Web PI_MGC (1).docx', 'dasdsa', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 17916, 1, 0, '2024-01-10 18:57:34', '2024-01-10 18:57:34'),
('33e67a96-45fc-4327-a06b-da8a45d7f883', '987434e4-4b29-45b0-8ebd-219b2174476d', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Flujo 19.10 (1).pdf', 'dewrewrergr', 'application/pdf', NULL, 98910, 1, 0, '2024-01-10 20:36:39', '2024-01-10 20:36:39'),
('33f14b9f-df05-4be6-b0d2-df6b7ce00c0e', '5bbd0bbc-6ed0-43ce-a263-41ce65e4f1e4', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Correos Web PI_MGC (1).docx', 'dassadsad', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 17916, 1, 0, '2024-01-10 18:58:04', '2024-01-10 18:58:04'),
('444ca42d-0557-4f97-a02a-22901c09061e', '1e1d082f-245c-4fa6-bc1e-77a06fa2c722', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Flujo 19.10.pdf', 'dsadasadssadsad', 'application/pdf', NULL, 98910, 0, 0, '2024-01-10 20:34:19', '2024-01-10 20:34:46'),
('5361d36a-92b4-4fda-bf4e-bbcf14c696ae', 'bc16425b-33db-44a3-88b1-3b14a93c7785', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'dgmn-certificado-de-situacion-militar-17128122.pdf', 'sdas', 'application/pdf', NULL, 359564, 1, 0, '2024-01-09 12:50:06', '2024-01-09 12:50:06'),
('54199c58-9aad-4869-b0f1-b8b604621f9d', NULL, '63a8e819-5cc7-4787-9129-0dfc7c289b21', NULL, 'ticket.jpg', 'Reporte Anual 2022', 'image/jpeg', NULL, 33763, 1, 1, '2024-01-15 02:39:54', '2024-01-15 14:15:10'),
('571ec820-23db-4ed4-82b0-2832821e721f', NULL, '935466e7-1f9d-451e-b2eb-893de98b050f', NULL, 'portada.jpeg', NULL, 'image/jpeg', NULL, 37754, 1, 0, '2024-01-11 18:46:05', '2024-01-11 18:46:05'),
('6cfba09f-dbce-4f5a-a796-adbd2a371815', '40ee71af-e2f2-4b8b-a065-4faca7975ccb', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Ministerio (1) (1).docx', '', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 16356, 1, 0, '2024-01-08 17:44:48', '2024-01-08 17:44:48'),
('81b4482f-fdda-43a5-89b8-60d321498c6f', NULL, '63a8e819-5cc7-4787-9129-0dfc7c289b21', NULL, 'agomez.png', 'Reporte Anual 2021', 'image/png', NULL, 16423, 1, 1, '2024-01-15 01:50:09', '2024-01-15 02:42:23'),
('85992e4e-4c83-4155-8991-fad567eaae42', '0f9abf02-3f8f-4b13-993d-cf18fc655e86', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Ministerio (1) (1).docx', 'dasadsasd', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 16356, 1, 0, '2024-01-09 12:54:09', '2024-01-09 12:54:09'),
('965aed9c-ed3e-4a3d-9263-b245b8081a09', NULL, '63a8e819-5cc7-4787-9129-0dfc7c289b21', NULL, 'first.png', 'Reporte Anual 2023', 'image/png', NULL, 302277, 1, 1, '2024-01-15 01:32:57', '2024-01-15 02:29:06'),
('cae7785e-3036-473b-ad3b-05583413ebb7', '6dc48a4c-fe2d-4782-881b-d66f98aac2f4', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Flujo 19.10 (1).pdf', 'ffdsdfs', 'application/pdf', NULL, 98910, 1, 0, '2024-01-10 20:36:59', '2024-01-10 20:36:59'),
('cf4a8572-3c73-4bfd-98ee-60df7511edd7', 'a8d4898b-d9cc-4e22-9841-90ca2bede3d8', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Flujo 19.10 (1).pdf', 'dsdsadadssad', 'application/pdf', NULL, 98910, 1, 0, '2024-01-10 20:36:15', '2024-01-10 20:36:15'),
('efa15901-c555-4b88-ae67-09d9947189fe', '1e1d082f-245c-4fa6-bc1e-77a06fa2c722', 'fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', NULL, 'Correos Web PI_MGC (1).docx', 'wadwdaadwdawdaw', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', NULL, 17916, 1, 0, '2024-01-10 20:34:19', '2024-01-10 20:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `attachment_types`
--

DROP TABLE IF EXISTS `attachment_types`;
CREATE TABLE IF NOT EXISTS `attachment_types` (
  `id` char(36) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachment_types`
--

INSERT INTO `attachment_types` (`id`, `name`, `created`, `modified`) VALUES
('63a8e819-5cc7-4787-9129-0dfc7c289b21', 'Antecedentes', '2024-01-15 01:32:30', '2024-01-15 01:32:30'),
('935466e7-1f9d-451e-b2eb-893de98b050f', 'Portada Informe Anual', '2024-01-08 03:37:10', '2024-01-08 03:37:10'),
('c97b3050-b609-4bd9-aada-8b348636420e', 'BitÃ¡cora de Encuentros Ciudadanos', '2024-01-12 01:37:21', '2024-01-12 01:37:21'),
('fb42ad79-5ead-42f4-b2ce-1edbbf5cabb2', 'Medio VerficaciÃ³n Indicador', '2023-08-22 16:15:43', '2023-08-22 16:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
CREATE TABLE IF NOT EXISTS `charges` (
  `id` char(36) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `name`, `created`, `modified`) VALUES
('041c3795-11b6-414d-a3ec-ce3c410f490c', 'Asesora Ministerial de GÃ©nero', '2023-08-30 02:11:43', '2023-08-30 02:11:43'),
('1a6bbf77-f500-44be-b5e5-b28d86443d7f', 'Jefa/e de Gabinete', '2023-08-30 02:12:14', '2023-08-30 02:12:14'),
('2a0d54a7-f814-4e3f-a02a-ddf3092b43e3', 'Jefe Superior', '2023-08-30 02:13:30', '2023-08-30 02:13:30'),
('509dec7b-3c44-4e8d-9bbc-ae1320372b11', 'Sectorialista', '2023-08-30 02:14:13', '2023-08-30 02:14:13'),
('85f82b26-109e-444b-8739-e675636bdd82', 'Jefatura SecretarÃ­a Ejecutiva', '2023-12-10 22:34:50', '2023-12-10 22:34:50'),
('8a375439-f7eb-44eb-879e-fc7d6d7895cd', 'Sociedad Civil', '2023-12-15 03:44:57', '2023-12-15 03:44:57'),
('a9825973-bd21-426a-809a-ff0525cfc72d', 'Sector', '2023-08-30 14:35:22', '2023-08-30 14:35:22'),
('abc3b974-007e-414c-a835-d81304c8f710', 'Digitadora', '2023-11-24 01:23:44', '2023-11-24 01:23:44'),
('c2e456b7-215e-4d20-94f3-f877f4f4a50b', 'Analista SecretarÃ­a Ejecutiva', '2023-11-16 13:28:03', '2023-11-16 13:28:03'),
('cff60054-4592-4f14-bcfc-b3ea0094e91d', 'Sectorialista Lider', '2023-11-12 01:39:10', '2023-11-12 01:39:10'),
('fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Administrador/a Plataforma', '2023-10-06 18:31:44', '2023-10-06 18:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
CREATE TABLE IF NOT EXISTS `dashboards` (
  `id` char(36) NOT NULL,
  `charge_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(45) NOT NULL,
  `order` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dashboars_charges1_idx` (`charge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dashboards`
--

INSERT INTO `dashboards` (`id`, `charge_id`, `name`, `url`, `icon`, `order`, `created`, `modified`) VALUES
('047714bb-54b8-4cc1-92bc-5c8f0e422638', 'c2e456b7-215e-4d20-94f3-f877f4f4a50b', 'Reporte avance por derecho', 'duty_ministries/index_right_executive_secretary', 'fa fa-list ', 2, '2023-12-07 18:08:44', '2023-12-07 18:08:44'),
('0886ba86-1246-4304-8bf9-3d4b42c6d445', '2a0d54a7-f814-4e3f-a02a-ddf3092b43e3', 'Reporte de avance por indicador', 'duty_ministries/index_duty_ministry/3', 'fa fa-list', 1, NULL, NULL),
('0886ba86-7046-4304-8bf3-3d4b42c6d473', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Tipo Derechos', 'duty_types/index', 'fa fa-th-large', 7, '2023-10-06 18:35:54', '2023-10-06 18:35:54'),
('09a361fe-8a1f-4406-aefe-499baa63f847', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Preguntas', 'evaluations/index', 'fa fa-list-alt', 13, '2023-10-07 00:48:21', '2023-10-07 00:48:21'),
('0c96c4c4-51b8-4f05-82ae-0de65f4c8a5f', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Cargos', 'charges/index', 'fa fa-user-plus', 4, '2023-10-06 18:34:32', '2023-10-06 18:34:32'),
('2210f72e-ed91-49a1-bdc4-eed1528a0089', 'c2e456b7-215e-4d20-94f3-f877f4f4a50b', 'Reporte sociedad civil', 'duty_ministries/index_right_civil_society', 'fa fa-list ', 3, '2023-12-25 15:27:17', '2023-12-25 15:27:17'),
('2c228c21-2a59-4eb4-80c2-679ded562fe2', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Ministerios', 'ministries/index', 'fa fa-bank', 9, '2023-10-06 18:36:55', '2023-10-06 18:36:55'),
('2e102835-a54d-4220-80f9-b2f290055003', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Derechos', 'duties/index', 'fa fa-list', 6, '2023-10-06 18:35:26', '2023-10-06 18:35:26'),
('35302d22-26fe-4259-942c-b046d8ffb761', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Tipo Instrumento', 'evaluation_types/index', 'fa fa-files-o', 11, '2023-10-07 00:47:21', '2023-10-07 00:47:21'),
('3c1eb8c0-068c-46fb-b47f-42fd053c39e8', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Categoria Derechos', 'duty_categories/index', 'fa fa-th-large', 8, '2023-10-06 18:36:33', '2023-10-06 18:36:33'),
('3c4a8ed5-9e7c-4d97-b57c-cbf0b3fc1ae9', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Organizaciones Sociedad Civil', 'organizations/index', 'fa fa-list', 14, '2023-12-15 03:34:40', '2023-12-15 03:34:40'),
('43e42185-bc9e-4cff-943d-9ec1231a8349', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Tipo Preguntas', 'question_types/index', 'fa fa-files-o', 12, '2023-10-07 00:47:53', '2023-10-07 00:47:53'),
('495d0a3d-5f9b-4041-ab57-cb0e7c575306', '041c3795-11b6-414d-a3ec-ce3c410f490c', 'Reporte de avance por meta', 'duty_ministries/index_goal_ministry/1', 'fa fa-list', 2, '2023-10-07 00:43:53', '2023-10-07 00:50:54'),
('49664f65-7496-48e8-89fa-b17d009b9654', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'BitÃ¡cora de Encuentros Ciudadanos', 'answers/index_binnacle', 'fa fa-list', 14, '2024-01-12 01:10:46', '2024-01-12 01:10:46'),
('56504c3c-9a48-489b-8f35-6300405156d8', '1a6bbf77-f500-44be-b5e5-b28d86443d7f', 'Reporte de avance por indicador', 'duty_ministries/index_duty_ministry/2', 'fa fa-list', 1, '2023-10-07 00:39:56', '2023-10-07 00:39:56'),
('5711bada-6d0e-4480-9de3-b48d114ddffa', '041c3795-11b6-414d-a3ec-ce3c410f490c', 'Reporte de avance por indicador', 'duty_ministries/index_duty_ministry/1', 'fa fa-list', 1, '2023-10-07 00:38:45', '2023-10-07 00:51:10'),
('640ea9cb-49c9-4e80-9afb-f98d9a1665da', '509dec7b-3c44-4e8d-9bbc-ae1320372b11', 'Reporte de avance por indicador', 'duty_ministries/index_duty_ministry/4', 'fa fa-list', 1, '2023-10-07 00:40:15', '2023-10-07 00:42:12'),
('686a133b-39de-4412-976d-093e768781b4', '8a375439-f7eb-44eb-879e-fc7d6d7895cd', 'Derechos', 'evaluation_duty_ministries/organization_duties', 'fa fa-list', 1, '2023-12-15 14:45:29', '2023-12-24 17:39:13'),
('6e0447b4-acb9-49f6-a2d9-c8c083777836', '85f82b26-109e-444b-8739-e675636bdd82', 'Reporte sociedad civil', 'duty_ministries/index_right_civil_society', 'fa fa-list ', 2, '2023-12-25 15:29:36', '2023-12-25 15:29:36'),
('74beb884-bec4-4f82-a2b8-3435fc4f095d', '041c3795-11b6-414d-a3ec-ce3c410f490c', 'Informe Anual', 'evaluations/index_annual_report', 'fa fa-list', 14, '2024-01-11 18:26:25', '2024-01-11 18:26:25'),
('7616869b-c778-4e50-94e4-425d1cfde17b', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Periodos', 'periods/index', 'fa fa-calendar-check-o', 5, '2023-10-06 18:34:54', '2023-10-06 18:34:54'),
('7d65f6fb-450d-4cf6-b503-baa6109edeca', 'c2e456b7-215e-4d20-94f3-f877f4f4a50b', 'Reporte de avance por meta', 'duty_ministries/index_goal_executive_secretary ', 'fa fa-list', 1, '2023-11-16 13:35:27', '2023-11-16 13:35:27'),
('7fb2db01-a684-430f-a7ca-da89aa257702', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Usuarios', 'users/index', 'fa fa-user', 1, '2023-10-06 18:32:58', '2023-10-06 18:32:58'),
('9a120c17-c5d0-4564-9a54-95bb177ca491', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Grupos', 'groups/index', 'fa fa-cubes', 3, '2023-10-06 18:33:55', '2023-10-06 18:33:55'),
('9b9bb919-cf7e-4c3e-bfad-6c3deef47e9f', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Asociar Derechos/Organizaciones Sociedad Civil', 'duties/index_organizations', 'fa fa-list', 15, '2023-12-15 03:35:10', '2023-12-15 03:35:10'),
('a641662a-a407-473e-8992-0aa1fd52e41d', 'abc3b974-007e-414c-a835-d81304c8f710', 'Mantenedor de Derechos', 'duties/index', 'fa fa-list', 1, '2023-11-24 01:28:44', '2023-11-24 01:28:44'),
('a78c2dc5-0a21-4a86-8767-936f82203ef2', 'cff60054-4592-4f14-bcfc-b3ea0094e91d', 'Reporte de avance por meta', 'duty_ministries/index_goal_leader_sectoralist', 'fa fa-list', 1, '2023-11-12 01:55:00', '2023-11-12 01:55:00'),
('bd0f366b-7ecb-4497-a9de-e5b2e0724187', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Repositorio', 'attachments/repository', 'fa fa-list', 20, '2024-01-13 16:27:33', '2024-01-13 16:27:33'),
('d0e4ef71-7bb9-4c98-bab0-cb2dafa66aed', '85f82b26-109e-444b-8739-e675636bdd82', 'Reporte avance por derecho ', 'duty_ministries/index_right_executive_secretary/6', 'fa fa-list  ', 1, '2023-12-10 22:40:01', '2023-12-10 23:22:20'),
('d883ac05-bd60-4c06-aa74-b22af62d0f46', '509dec7b-3c44-4e8d-9bbc-ae1320372b11', 'Reporte de avance por meta', 'duty_ministries/index_goal_ministry/4', 'fa fa-list', 2, '2023-10-07 00:44:36', '2023-10-07 00:44:36'),
('e118ac56-06fc-407c-8781-4982d2e71922', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Sector/Indicador', 'duty_ministries/index', 'fa fa-plus', 10, '2023-10-06 18:37:25', '2023-10-06 18:37:25'),
('fa88e07e-8034-4521-b41a-22e622545aa1', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', 'Personas', 'people/index', 'fa fa-user', 2, '2023-10-06 18:33:28', '2023-10-06 18:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `duties`
--

DROP TABLE IF EXISTS `duties`;
CREATE TABLE IF NOT EXISTS `duties` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `duty_type_id` char(36) NOT NULL,
  `duty_category_id` char(36) DEFAULT NULL,
  `name` text NOT NULL,
  `number` int(11) NOT NULL,
  `observation` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_duties_duty_types1_idx` (`duty_type_id`),
  KEY `fk_duties_duties1_idx` (`parent_id`),
  KEY `fk_duties_duty_categories1_idx` (`duty_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duties`
--

INSERT INTO `duties` (`id`, `parent_id`, `duty_type_id`, `duty_category_id`, `name`, `number`, `observation`, `created`, `modified`) VALUES
('095bd2fd-8ef0-415d-a8bf-420150b71b60', '53a79b51-8a41-44f5-a5e9-a2bc943ebbe5', '266f9143-e84a-4dc9-b97b-3a317fda7f86', NULL, 'Disminuir la brecha de empleo pleno y productivo entre mujeres y hombres.', 17, '', '2023-08-21 16:33:05', '2023-08-21 16:33:05'),
('1d3a9eb9-6894-4e71-85d7-943cd48e98c8', '5035e762-ab38-49af-80e4-392f969cea31', '266f9143-e84a-4dc9-b97b-3a317fda7f86', NULL, 'Contar  con autoridades de servicios pÃºblicos regionales nombradas  con criterio de paridad  de gÃ©nero como piso.', 3, '', '2023-08-21 16:30:28', '2023-08-21 16:30:28'),
('27b3a020-e141-4a76-839c-afa290a67698', NULL, '1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', NULL, 'Colectivos y ambientales', 6, '', '2023-08-10 19:33:20', '2023-08-10 19:33:20'),
('29a6c91a-194a-49eb-b2d8-b94e8a684298', 'ebcef2a1-f564-4ef9-9941-623bff57212a', 'daadc208-6af7-427b-9e28-a9da234dcd79', '06df1ef7-ce74-43dd-9371-2c5e8d400e97', 'Tasa embarazo en niÃ±as y adolescentes entre 15 y 19 aÃ±os, por quintiles.', 153, '2030', '2023-08-21 16:36:34', '2023-08-24 16:13:49'),
('5035e762-ab38-49af-80e4-392f969cea31', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '23fc6557-e263-4a5a-be1f-ea58aa8f1bdc', NULL, 'Objetivo  especÃ­fico  1.1:  Aumentar  la  representatividad  polÃ­tica  y  social  de  la  diversidad  de  mujeres,  incrementando  sus  capacidades  de  incidencia,  en condiciones de paridad de gÃ©nero, como actoras estratÃ©gicas en la toma de decisiones en el espacio pÃºblico y privado.\r\nObjetivo especÃ­fico 1.2: Ampliar la participaciÃ³n social y polÃ­tica de todos los grupos de mujeres, especialmente de los que tienen menor acceso a espacios y cargos de poder y de toma de decisiones (entre otras, mujeres rurales, mujeres de pueblos originarios, mujeres afrodescendientes, mujeres migrantes, mujeres de las diversidades sexo genÃ©ricas, mujeres en situaciÃ³n de discapacidad).', 1, '', '2023-08-21 16:02:07', '2023-08-21 16:02:07'),
('53a79b51-8a41-44f5-a5e9-a2bc943ebbe5', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '23fc6557-e263-4a5a-be1f-ea58aa8f1bdc', NULL, 'Objetivo especÃ­fico 2.1: Aumentar la participaciÃ³n laboral y econÃ³mica de las mujeres, en condiciones de trabajo decente, para reducir la brecha de gÃ©nero ocasionada por la pandemia y por la crisis econÃ³mica.\r\nObjetivo especÃ­fico 2.2: Reducir las desigualdades en el empleo y en la economÃ­a, con especial incidencia en las desigualdades retributivas entre hombres y mujeres, reduciendo la segregaciÃ³n en el mercado laboral, asÃ­ como mejorando el acceso de las mujeres al desarrollo productivo - industrial y a la innovaciÃ³n tecnolÃ³gica.\r\nObjetivo   especÃ­fico   2.3:   Reducir   las   desigualdades   que   afectan   a   las   mujeres   en   sus   iniciativas   de emprendimiento y aumentar su acceso a instrumentos de fomento productivo.\r\nObjetivo especÃ­fico 2.4: Modificar los estereotipos de gÃ©nero que afectan las relaciones laborales y limitan las oportunidades que tienen la diversidad de mujeres en sus trayectorias laborales.', 2, '', '2023-08-21 16:32:22', '2023-08-21 16:32:22'),
('5cde7a2f-8657-4ebd-9d5d-59f2df8280db', '1d3a9eb9-6894-4e71-85d7-943cd48e98c8', 'daadc208-6af7-427b-9e28-a9da234dcd79', 'ab3ad79c-f7ff-4448-8ee8-b8d42aa31d4b', '% de Direcciones Regionales y Provinciales de servicios PÃºblicos nombradas con criterio  de  paridad  de gÃ©nero.', 7, '2025', '2023-08-21 16:31:23', '2023-08-24 16:13:41'),
('7dcc0e13-1cd1-4e15-ad4c-4eb6c46d3401', '5035e762-ab38-49af-80e4-392f969cea31', '266f9143-e84a-4dc9-b97b-3a317fda7f86', NULL, 'Avanzar  en  un  Congreso  constituido con  criterio  paridad  de  gÃ©nero  como piso (2030).', 1, '', '2023-08-21 16:03:02', '2023-08-21 16:03:02'),
('7e702ee1-d532-4c62-a9d1-94f0fbd30528', '7dcc0e13-1cd1-4e15-ad4c-4eb6c46d3401', 'daadc208-6af7-427b-9e28-a9da234dcd79', 'ab3ad79c-f7ff-4448-8ee8-b8d42aa31d4b', '%   de   mujeres   en   el congreso.', 1, '2030', '2023-08-21 16:04:02', '2023-08-24 16:13:33'),
('7ef20a9a-e561-41be-babb-8d160458937f', NULL, '1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', NULL, 'A una vida libre de violencia y discriminaciÃ³n', 4, '', '2023-08-10 19:32:38', '2023-12-29 20:33:22'),
('8c56565e-c625-4cf3-8b78-52e104d1abac', NULL, '1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', NULL, 'Sociales y culturales', 5, '', '2023-08-10 19:33:01', '2023-08-10 19:33:01'),
('9a71956b-60c4-4173-aa78-4baa3b286b18', 'f54b5a89-c856-4bf8-b795-0ac3b4e96710', '23fc6557-e263-4a5a-be1f-ea58aa8f1bdc', NULL, 'Objetivo especÃ­fico 3.1: Incrementar la autonomÃ­a fÃ­sica de las mujeres, garantizando la informaciÃ³n oportuna y el acceso a prestaciones de salud de carÃ¡cter integral que mejoren su bienestar y calidad de vida, considerando su identidad de gÃ©nero, su cultura, su orientaciÃ³n sexual, en los diversos momentos de su ciclo vital.\r\nObjetivo especÃ­fico 3.2:  Garantizar y cautelar el desarrollo integral, fÃ­sico y psicolÃ³gico de las mujeres, respetando la diversidad cultural, asÃ­ como su orientaciÃ³n sexual e identidad de gÃ©nero.', 3, '', '2023-08-21 16:35:03', '2023-08-21 16:35:03'),
('a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', NULL, '1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', NULL, 'EconÃ³micos ', 2, '', '2023-08-10 19:27:03', '2024-01-02 14:27:16'),
('c01e9e1d-2573-4ee8-82c2-e0758d430fc6', '7dcc0e13-1cd1-4e15-ad4c-4eb6c46d3401', 'daadc208-6af7-427b-9e28-a9da234dcd79', 'ab3ad79c-f7ff-4448-8ee8-b8d42aa31d4b', '% de mujeres en CÃ¡mara Diputadas/os', 2, '2030', '2023-08-21 16:29:24', '2023-08-24 16:13:24'),
('db591c02-5b74-4b29-8e99-f5198ffad490', '095bd2fd-8ef0-415d-a8bf-420150b71b60', 'daadc208-6af7-427b-9e28-a9da234dcd79', '06df1ef7-ce74-43dd-9371-2c5e8d400e97', 'RelaciÃ³n entre mujeres y hombres en torno a la  tasa  de  empleo,  por  Rama  y  CategorÃ­a ocupacional.', 31, '2030', '2023-08-21 16:34:09', '2023-08-24 16:13:10'),
('e08084c1-7911-4b0a-bb1f-da380c462a2e', NULL, '1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', NULL, 'Civiles y polÃ­ticos ', 1, '', '2023-08-10 19:23:30', '2024-01-08 14:53:54'),
('ebcef2a1-f564-4ef9-9941-623bff57212a', '9a71956b-60c4-4173-aa78-4baa3b286b18', '266f9143-e84a-4dc9-b97b-3a317fda7f86', NULL, 'Disminuir el embarazo en niÃ±as y adolescentes entre 15 y 19 aÃ±os.', 93, '', '2023-08-21 16:35:45', '2023-08-21 16:35:45'),
('f54b5a89-c856-4bf8-b795-0ac3b4e96710', NULL, '1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', NULL, 'Sexuales y reproductivos, y a la salud integral', 3, '', '2023-08-10 19:27:34', '2023-12-27 17:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `duty_categories`
--

DROP TABLE IF EXISTS `duty_categories`;
CREATE TABLE IF NOT EXISTS `duty_categories` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duty_categories`
--

INSERT INTO `duty_categories` (`id`, `name`, `created`, `modified`) VALUES
('06df1ef7-ce74-43dd-9371-2c5e8d400e97', 'Cantidad', '2023-08-24 16:06:36', '2023-08-24 16:06:36'),
('ab3ad79c-f7ff-4448-8ee8-b8d42aa31d4b', 'Porcentaje', '2023-08-24 16:06:46', '2023-08-24 16:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `duty_ministries`
--

DROP TABLE IF EXISTS `duty_ministries`;
CREATE TABLE IF NOT EXISTS `duty_ministries` (
  `id` char(36) NOT NULL,
  `period_id` char(36) NOT NULL,
  `duty_id` char(36) NOT NULL,
  `ministry_id` char(36) NOT NULL,
  `organization_id` char(36) DEFAULT NULL,
  `leader` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_duties_has_ministries_ministries1_idx` (`ministry_id`),
  KEY `fk_duties_has_ministries_duties1_idx` (`duty_id`),
  KEY `fk_duty_ministries_periods1_idx` (`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duty_ministries`
--

INSERT INTO `duty_ministries` (`id`, `period_id`, `duty_id`, `ministry_id`, `organization_id`, `leader`, `created`, `modified`) VALUES
('0c5ebf8b-f025-474e-8f5b-dd0b65308afd', '426ab6fd-bd71-472c-be83-be02650ca79c', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '70a41546-4009-4d8c-ab72-04275fe72a97', '8bf0a86d-9856-4465-a85b-8f777d23b444', 1, '2024-01-02 02:44:29', '2024-01-02 02:44:29'),
('0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', '426ab6fd-bd71-472c-be83-be02650ca79c', 'db591c02-5b74-4b29-8e99-f5198ffad490', '812e3cf3-c50a-4006-998f-7870d43a2920', NULL, 1, '2023-08-21 18:04:43', '2023-08-30 01:53:55'),
('2e049d57-dcff-4cae-93f6-dcef327b89fe', '426ab6fd-bd71-472c-be83-be02650ca79c', 'c01e9e1d-2573-4ee8-82c2-e0758d430fc6', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', NULL, 0, '2023-09-29 18:05:51', '2023-09-29 18:05:51'),
('44d2097c-c378-4c01-9f60-790218be1e0f', '426ab6fd-bd71-472c-be83-be02650ca79c', '29a6c91a-194a-49eb-b2d8-b94e8a684298', '812e3cf3-c50a-4006-998f-7870d43a2920', NULL, 0, '2023-08-21 17:52:12', '2023-08-30 01:54:01'),
('476d6a00-5b33-479b-95c2-e49f237be040', '426ab6fd-bd71-472c-be83-be02650ca79c', '5cde7a2f-8657-4ebd-9d5d-59f2df8280db', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', NULL, 0, '2023-08-21 18:02:01', '2023-08-30 01:53:39'),
('5209fee7-2288-4e47-bcac-1bbadd3ac467', '426ab6fd-bd71-472c-be83-be02650ca79c', '7e702ee1-d532-4c62-a9d1-94f0fbd30528', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', NULL, 1, '2023-08-21 18:02:30', '2023-08-30 01:53:22'),
('55b9d685-43b9-4042-8d85-64682fb377a8', '426ab6fd-bd71-472c-be83-be02650ca79c', '29a6c91a-194a-49eb-b2d8-b94e8a684298', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', NULL, 0, '2023-08-21 17:52:12', '2023-08-30 01:53:30'),
('578e12eb-8d02-47d6-967a-80327cfac0cd', '426ab6fd-bd71-472c-be83-be02650ca79c', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '70a41546-4009-4d8c-ab72-04275fe72a97', '333b8050-63a2-4258-85e4-389ec5794abd', 1, '2024-01-02 14:29:35', '2024-01-02 14:29:35'),
('59ac0e44-d88c-4082-8319-e1ebebec1fbb', '426ab6fd-bd71-472c-be83-be02650ca79c', 'db591c02-5b74-4b29-8e99-f5198ffad490', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', NULL, 0, '2023-08-21 18:04:43', '2023-08-30 01:53:35'),
('690db4c9-243a-41c4-aee0-4447b5cb1381', '426ab6fd-bd71-472c-be83-be02650ca79c', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '70a41546-4009-4d8c-ab72-04275fe72a97', '675c84d0-61c4-4262-8691-7b785c954edd', 1, '2023-12-27 02:14:21', '2023-12-27 02:14:21'),
('693aab4d-f866-45fc-9b17-e4b7c913eac0', '426ab6fd-bd71-472c-be83-be02650ca79c', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '70a41546-4009-4d8c-ab72-04275fe72a97', '129ba635-92e5-4b50-bc9a-d10618ba70b4', 1, '2024-01-02 14:20:07', '2024-01-02 14:20:07'),
('6a705d0c-3161-4c79-a7ea-50a575c16afb', '426ab6fd-bd71-472c-be83-be02650ca79c', 'c01e9e1d-2573-4ee8-82c2-e0758d430fc6', '812e3cf3-c50a-4006-998f-7870d43a2920', NULL, 0, '2023-08-21 18:04:31', '2023-08-30 01:54:05'),
('710b6532-edee-41ae-b33a-b6dc44c47d4c', '426ab6fd-bd71-472c-be83-be02650ca79c', '29a6c91a-194a-49eb-b2d8-b94e8a684298', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', NULL, 1, '2023-08-21 17:52:12', '2023-08-30 01:53:44'),
('888805ab-c375-4f33-bfd3-e75417b60f92', '426ab6fd-bd71-472c-be83-be02650ca79c', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '70a41546-4009-4d8c-ab72-04275fe72a97', '333b8050-63a2-4258-85e4-389ec5794abd', 1, '2023-12-29 20:55:33', '2023-12-29 20:55:33'),
('923afb43-fcbe-4a1e-890c-d4ab497e01fa', '426ab6fd-bd71-472c-be83-be02650ca79c', '5cde7a2f-8657-4ebd-9d5d-59f2df8280db', '812e3cf3-c50a-4006-998f-7870d43a2920', NULL, 1, '2023-08-21 18:02:01', '2023-08-30 01:54:10'),
('9d0d48e3-e425-4f8f-bc4f-45ea4df3f100', '426ab6fd-bd71-472c-be83-be02650ca79c', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '70a41546-4009-4d8c-ab72-04275fe72a97', '8bf0a86d-9856-4465-a85b-8f777d23b444', 1, '2023-12-27 02:25:09', '2023-12-27 02:25:09'),
('eafd01ed-462f-4b20-989a-fa971c8823ad', '426ab6fd-bd71-472c-be83-be02650ca79c', 'db591c02-5b74-4b29-8e99-f5198ffad490', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', NULL, 0, '2023-08-21 18:04:43', '2023-08-30 01:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `duty_organizations`
--

DROP TABLE IF EXISTS `duty_organizations`;
CREATE TABLE IF NOT EXISTS `duty_organizations` (
  `id` char(36) NOT NULL,
  `duty_id` char(36) NOT NULL,
  `organization_id` char(36) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_duties_has_organizations_organizations1_idx` (`organization_id`),
  KEY `fk_duties_has_organizations_duties1_idx` (`duty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duty_organizations`
--

INSERT INTO `duty_organizations` (`id`, `duty_id`, `organization_id`, `created`, `modified`) VALUES
('123de67a-d8ec-41e6-bd4d-80223547ae63', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '333b8050-63a2-4258-85e4-389ec5794abd', NULL, NULL),
('25249b56-1172-4424-9fe5-fa82172eb276', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '129ba635-92e5-4b50-bc9a-d10618ba70b4', NULL, NULL),
('3cd472b4-d7c6-446e-816a-2c6ee6182671', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '8bf0a86d-9856-4465-a85b-8f777d23b444', NULL, NULL),
('6b255c61-3e47-471b-8533-c3242cd89467', '7ef20a9a-e561-41be-babb-8d160458937f', '8bf0a86d-9856-4465-a85b-8f777d23b444', NULL, NULL),
('a295df41-8be1-425d-a5eb-26ffcdb5f4b4', 'a70dd32e-fc9d-47f2-94c0-837b5cb6bcc5', '8bf0a86d-9856-4465-a85b-8f777d23b444', NULL, NULL),
('a895e101-6041-4f32-a0e7-a6971f263b2d', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '333b8050-63a2-4258-85e4-389ec5794abd', NULL, NULL),
('b9577d64-4205-4a38-a5c3-47941a374a1c', 'e08084c1-7911-4b0a-bb1f-da380c462a2e', '675c84d0-61c4-4262-8691-7b785c954edd', NULL, NULL),
('e3ee45e9-6b5a-465f-84c9-19ddcbe0508e', 'f54b5a89-c856-4bf8-b795-0ac3b4e96710', '675c84d0-61c4-4262-8691-7b785c954edd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `duty_types`
--

DROP TABLE IF EXISTS `duty_types`;
CREATE TABLE IF NOT EXISTS `duty_types` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duty_types`
--

INSERT INTO `duty_types` (`id`, `name`, `created`, `modified`) VALUES
('1f3b60ae-ebfd-4e01-b4bb-e5c65a7d3ceb', 'Derecho', '2023-08-10 19:21:37', '2023-08-10 19:21:37'),
('23fc6557-e263-4a5a-be1f-ea58aa8f1bdc', 'Objetivo EspecÃ­fico', '2023-08-21 13:38:56', '2023-08-21 13:38:56'),
('266f9143-e84a-4dc9-b97b-3a317fda7f86', 'Meta', '2023-08-10 19:22:01', '2023-08-10 19:22:01'),
('daadc208-6af7-427b-9e28-a9da234dcd79', 'Indicador', '2023-08-10 19:21:49', '2023-08-10 19:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` char(36) NOT NULL,
  `evaluation_type_id` char(36) NOT NULL,
  `question_type_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `info` text,
  `bold` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evaluations_evaluation_types1_idx` (`evaluation_type_id`),
  KEY `fk_evaluations_question_types1_idx` (`question_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `evaluation_type_id`, `question_type_id`, `name`, `order`, `info`, `bold`, `created`, `modified`) VALUES
('027746a2-ddd1-473f-b27b-248a7d634f6f', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'PRESENTACIÃ“N', 3, '3', 1, '2023-12-27 02:08:35', '2024-01-10 14:28:11'),
('04807b00-dbfd-4ae1-9a42-764a27f41d94', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'Descripcion', 11, '', 0, '2023-10-11 17:54:40', '2023-11-20 19:53:52'),
('06fb08ad-c3e7-4daa-9f30-9a18a1f4bccd', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'II. ENFOQUES QUE SUSTENTAN EL CUARTO PLAN NACIONAL DE IGUALDAD EN- TRE MUJERES Y HOMBRES 2018-2030', 6, '7', 0, '2023-12-27 02:11:42', '2024-01-11 03:12:27'),
('071ce043-4f57-4fe8-a7a8-0fcd308f8562', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3 SEXUALES Y REPRODUCTIVOS, Y A LA SALUD INTEGRAL', 30, '', 0, '2024-01-10 16:42:32', '2024-01-10 16:42:32'),
('0918d65d-d347-4386-a170-5210b8de4b1c', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'FUENTES DE DATOS CONSULTADAS', 113, '', 0, '2024-01-10 20:08:09', '2024-01-10 20:08:09'),
('09ca2c88-134f-4510-8cb9-b87731226179', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.2 RECOMENDACIONES', 86, '', 0, '2024-01-10 19:40:12', '2024-01-10 19:40:12'),
('0a0a54c9-196c-4c45-a2f7-23d56d02d76f', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.1 PRINCIPALES AVANCES', 103, '', 0, '2024-01-10 19:47:13', '2024-01-10 19:47:13'),
('0a0d3c2c-30ae-4579-802a-ef4e41bcd7d8', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'Avance de la Meta Reportada por los Sectores', 3, '', 0, '2023-11-15 01:56:57', '2023-11-15 01:56:57'),
('0b4d3664-6d2d-4983-ba2d-22d13f38b274', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7 MUJERES MIGRANTES', 66, '', 0, '2024-01-10 19:16:05', '2024-01-10 19:16:05'),
('0be41e0f-564e-4f03-bdb9-66abd00870df', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '276b9d80-a68f-43ed-b64f-4e2b620a2ed3', 'Anexos', 13, '', 0, '2023-11-15 02:09:40', '2023-11-15 02:09:40'),
('10e52a05-95b4-4ae1-8d12-a52a8d5c2d12', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '3.1.2 RECOMENDACIONES', 14, '', 0, '2023-12-27 02:26:42', '2023-12-27 02:26:42'),
('130f7279-7dd1-410c-a1db-d8ccd69cb408', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'AnÃ¡lisis Cualitativo Nudo CrÃ­tico', 8, '', 0, '2023-09-29 00:12:20', '2023-11-20 19:50:49'),
('13517225-9fe7-47e5-9972-bd6311f16fd3', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.2 RECOMENDACIONES', 59, '', 0, '2024-01-10 19:14:00', '2024-01-10 19:14:00'),
('15ad605e-5d3b-40fa-8751-b5fdfab0f451', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.6 RECOMENDACIONES', 108, '', 0, '2024-01-10 20:01:03', '2024-01-10 20:01:03'),
('16e90a6a-e6e7-457e-8ed4-7a7f1ea2d52e', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.8 IMAGENES ENCUENTROS CIUDADANOS', 110, '', 0, '2024-01-10 20:00:34', '2024-01-10 20:00:34'),
('1713b5fa-7b94-47de-8c15-45880f0b20fc', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.6 RECOMENDACIONES', 27, '', 0, '2024-01-10 16:40:05', '2024-01-10 16:40:05'),
('1817f1f3-af14-4454-8c71-9af171fc409d', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.1 PRINCIPALES AVANCES', 40, '', 0, '2024-01-10 16:47:02', '2024-01-10 16:47:02'),
('18f7f691-2c1c-489f-bed7-d570ee483704', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '3.1.4 MONITOREO DE LA SOCIEDAD CIVIL', 16, '', 1, '2023-12-27 02:27:13', '2023-12-27 02:27:13'),
('198887d4-6064-43fb-a8aa-e33311b53686', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '886f652c-be17-4119-ac73-972d37d4e519', 'Elementos/Actividades a Destacar para la Sociedad Civil/ Enlace de DifusiÃ³n', 11, '', 0, '2023-11-15 02:07:06', '2023-11-15 02:07:06'),
('1ce0e33f-f785-499b-88cf-5e8017f8bb86', '9dd8170a-a85a-41fc-ac78-4469938f83fd', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'Porcentaje(%) avance de la meta', 3, '', 0, '2023-11-20 19:44:15', '2023-12-06 15:37:52'),
('1da1e19e-2802-4de9-96cd-752bc80e7873', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.6 RECOMENDACIONES', 90, '', 0, '2024-01-10 19:40:59', '2024-01-10 19:40:59'),
('1f619304-9f30-4b1e-bd98-0bfc2dff632e', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.1.7 DATOS PARTICIPACIÃ“N CIUDADANA', 19, '', 0, '2024-01-10 14:42:02', '2024-01-10 14:42:02'),
('1f7dcf88-72c1-4aeb-9fc4-f6ecacb075e4', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'Elementos/Actividades a destacar para la Sociedad Civil/Enlace de DifusiÃ³n', 9, '', 0, '2023-09-29 00:14:11', '2023-11-20 19:53:15'),
('2101f5cb-a85f-4dcf-9251-a86fd4ca9d77', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.3 DATOS REPORTE DERECHOS', 69, '', 0, '2024-01-10 19:16:43', '2024-01-10 19:16:43'),
('2117dc2c-a59a-4f99-af74-0c0f3fb9b555', '9dd8170a-a85a-41fc-ac78-4469938f83fd', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'Cantidad de mujeres impactadas', 4, '', 0, '2023-11-20 19:45:17', '2023-12-06 15:38:52'),
('2212ed19-49d9-46d6-b28e-0419a5eb26d1', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.1 PRINCIPALES AVANCES', 76, '', 0, '2024-01-10 19:37:01', '2024-01-10 19:37:01'),
('22302b17-6f79-401f-87ff-19df832cfa90', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'Observaciones', 12, '', 0, '2023-09-29 00:17:18', '2023-11-20 19:54:06'),
('22f8003a-cb1b-4852-8711-2e142c83019a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5 SOCIALES Y CULTURALES', 48, '', 0, '2024-01-10 19:02:39', '2024-01-10 19:02:39'),
('2389e37d-c89e-4a01-be38-37c036bdd739', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'AnÃ¡lisis Cualitativo Meta', 2, '', 0, '2023-11-15 01:56:00', '2023-11-15 01:56:00'),
('23901512-3b8e-4bb7-ab4e-e7953a5e06ea', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.5 OBSERVACIONES', 80, '', 0, '2024-01-10 19:38:05', '2024-01-10 19:38:05'),
('279dd61b-2c31-4475-bd38-52bde2b1b59e', '60dec512-3212-499f-b718-4da5629a8c4c', '757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'Organizaciones de la Sociedad Civil Participantes', 7, '', 0, '2024-01-12 01:04:11', '2024-01-12 01:04:11'),
('29b402ad-5808-419c-8d8a-ea742e3338f0', 'd5e8e45b-859b-4d5c-bf59-91647a96d03b', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'Observaciones y recomendaciones', 3, '3000 caracteres', 0, '2023-12-09 01:22:57', '2023-12-09 01:22:57'),
('2b0a4cbf-344a-42f0-b140-afdcb616c32e', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.3 DATOS REPORTE DERECHOS', 60, '', 0, '2024-01-10 19:14:14', '2024-01-10 19:14:14'),
('2bcf37fd-ea54-481a-ab32-081d54f1ebdd', '60dec512-3212-499f-b718-4da5629a8c4c', '276b9d80-a68f-43ed-b64f-4e2b620a2ed3', 'Adjuntar Archivo', 10, '', 0, '2024-01-12 01:05:19', '2024-01-12 01:05:19'),
('2ca796d7-b27e-44db-8087-a4093a4a7924', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.7 DATOS PARTICIPACIÃ“N CIUDADANA', 73, '', 0, '2024-01-10 19:17:33', '2024-01-10 19:17:33'),
('2fbbb88a-9a9e-484e-b3fc-02b158fa7de0', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.2 RECOMENDACIONES', 77, '', 0, '2024-01-10 19:37:14', '2024-01-10 19:37:14'),
('3067b983-0809-4dca-8f52-d4aaa89c254c', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.5 OBSERVACIONES', 89, '', 0, '2024-01-10 19:40:47', '2024-01-10 19:40:47'),
('30c38e9b-dbd1-4912-85d6-8a9c804ba521', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '405eceda-3eec-4c98-81bf-6ae21a5d948e', 'ParticipaciÃ³n Ciudadana', 9, '', 0, '2023-11-15 02:04:24', '2023-11-15 02:04:24'),
('3212b93c-2fea-4276-a554-daa15ec55cae', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.8 IMAGENES ENCUENTROS CIUDADANOS', 83, '', 0, '2024-01-10 19:38:45', '2024-01-10 19:38:45'),
('32f05a3e-5382-4151-8b9c-45f0e14c3fb0', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.3 DATOS REPORTE DERECHOS', 24, '', 0, '2024-01-10 16:39:27', '2024-01-10 16:39:27'),
('353eb811-e609-4a27-a7f1-a30ab555e787', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '3.1.1 PRINCIPALES AVANCES', 13, '', 0, '2023-12-27 02:26:25', '2023-12-27 02:26:25'),
('35f9f5c7-0b4a-48b0-bc8f-f315690edbce', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.4 MONITOREO DE LA SOCIEDAD CIVIL', 106, '', 0, '2024-01-10 19:59:52', '2024-01-10 19:59:52'),
('3624bf16-6a73-4d33-b8f0-925b3e1c90a0', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '55e68658-73d1-45a1-b7f0-6b064b3b02d5', 'Grupos de Mujeres', 6, '', 0, '2023-11-15 02:00:36', '2023-11-15 02:00:36'),
('36eeb92d-8173-4450-9b93-704b164e0596', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.4 MONITOREO DE LA SOCIEDAD CIVIL', 43, '', 1, '2024-01-10 16:47:41', '2024-01-10 16:47:41'),
('38415d47-d862-4084-8513-4ae35f404680', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.3 DATOS REPORTE DERECHOS', 105, '', 0, '2024-01-10 19:47:36', '2024-01-10 19:47:36'),
('39da766c-5335-46e7-bc2f-5fe0a64becb7', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.6 RECOMENDACIONES', 54, '', 0, '2024-01-10 19:04:20', '2024-01-10 19:04:20'),
('3ba4fa8f-6f96-4821-a013-a53a4eba6e44', '4beb018d-4cea-48d2-8aa7-5ae0290cc032', '5134558a-bfa6-4c10-a090-6279b7d15334', 'Analisis', 1, '1000 caracteres', 0, '2023-12-25 19:26:29', '2023-12-25 19:26:29'),
('3d3501af-338c-4571-8898-bd4f021f055b', '60dec512-3212-499f-b718-4da5629a8c4c', '757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'RegiÃ³n', 5, '', 0, '2024-01-12 01:03:38', '2024-01-12 01:03:38'),
('3fea35d0-e3b0-45b2-b3b5-cc68d87d5ff5', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.6 RECOMENDACIONES', 36, '', 0, '2024-01-10 16:44:55', '2024-01-10 16:44:55'),
('4245039f-d8e8-448f-9974-323f0adbeb54', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.7 DATOS PARTICIPACIÃ“N CIUDADANA', 37, '', 0, '2024-01-10 16:45:09', '2024-01-10 16:45:09'),
('42b4739e-f83f-4ac9-8b5a-d56de04605b4', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.4 MONITOREO DE LA SOCIEDAD CIVIL', 79, '', 1, '2024-01-10 19:37:53', '2024-01-10 19:37:53'),
('43a94e47-2389-4fb9-bbcc-705388d8d2a1', 'ef1e3d24-cf32-42bb-94c0-e5ab56016b02', '5134558a-bfa6-4c10-a090-6279b7d15334', 'ObservaciÃ³n cualitativa del derecho', 1, '1000 caracteres', 0, '2023-12-24 23:15:50', '2023-12-24 23:16:37'),
('446d05cf-5457-44ba-9d77-cd7419398bf1', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '29eac2c2-6784-48e9-ae6a-5fbb30fba588', 'ParticipaciÃ³n de Organizaciones', 10, '', 0, '2023-09-29 00:16:18', '2023-11-20 19:53:36'),
('44ade925-0bd5-44ef-abd8-c86a171968bc', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2 ECONÃ“MICOS', 21, '9', 0, '2024-01-10 16:37:26', '2024-01-11 14:02:04'),
('479ef1fc-1941-4b55-94f0-5e3eee9f9fbe', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.7 DATOS PARTICIPACIÃ“N CIUDADANA', 64, '', 0, '2024-01-10 19:15:05', '2024-01-10 19:15:05'),
('4b799fac-426a-4d65-802c-5a9fea626d42', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '120e4f94-9986-4246-ba9b-a51e5a0b4239', 'Nudo CrÃ­tico', 7, '', 0, '2023-09-29 00:10:01', '2023-11-20 19:50:18'),
('4e13f4d8-44dd-4bed-b80e-7af8197dd35f', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'Otros', 7, '', 0, '2023-11-15 02:01:54', '2023-11-20 20:53:13'),
('4e76d78b-7cea-40e7-8c89-e69fb156708f', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.1 PRINCIPALES AVANCES', 85, '', 0, '2024-01-10 19:40:01', '2024-01-10 19:40:01'),
('52ae023d-7bcb-4c30-9bce-8b5cab274ed1', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.7 DATOS PARTICIPACIÃ“N CIUDADANA', 46, '', 0, '2024-01-10 16:48:33', '2024-01-10 16:48:33'),
('53788853-77a8-4aac-bbb6-fb0b7d90ffdc', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.7 DATOS PARTICIPACIÃ“N CIUDADANA', 100, '', 0, '2024-01-10 19:44:08', '2024-01-10 19:44:08'),
('55d4c13b-024a-4132-8346-b638c66d1fe0', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.5 OBSERVACIONES', 53, '', 0, '2024-01-10 19:04:08', '2024-01-10 19:04:08'),
('567af9c4-428d-4180-9b16-4b61dbf14ccb', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '276b9d80-a68f-43ed-b64f-4e2b620a2ed3', '3.3.8 IMAGENES ENCUENTROS CIUDADANOS', 38, '', 0, '2024-01-10 16:45:25', '2024-01-10 16:45:25'),
('5a6b54a9-f3d4-43c5-a010-933a33b15495', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.6 RECOMENDACIONES', 81, '', 0, '2024-01-10 19:38:17', '2024-01-10 19:38:17'),
('5f2129c2-73c1-4662-8242-af03085cd50a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.8 IMAGENES ENCUENTROS CIUDADANOS', 74, '', 0, '2024-01-10 19:17:45', '2024-01-10 19:17:45'),
('60049a6f-5395-44cb-96d6-f6e352dca364', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.7 DATOS PARTICIPACIÃ“N CIUDADANA', 55, '', 0, '2024-01-10 19:04:35', '2024-01-10 19:04:35'),
('620ef0d1-2589-4298-9790-7a9ec067e649', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.3 DATOS REPORTE DERECHOS', 96, '', 0, '2024-01-10 19:43:14', '2024-01-10 19:43:14'),
('65dd1ce7-641b-4de2-88dc-cce5843656f5', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.1 PRINCIPALES AVANCES', 49, '', 0, '2024-01-10 19:02:52', '2024-01-10 19:02:52'),
('66435665-03ab-4be3-9e3c-708ff3a62e1e', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.3 DATOS REPORTE DERECHOS', 42, '', 0, '2024-01-10 16:47:28', '2024-01-10 16:47:28'),
('680608b0-682d-47a8-9d83-46708a9456e2', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11 INSTITUCIONALIDAD DE GÃ‰NERO Y ARTICULACIÃ“N DE INICIATIVASÂ DELÂ ESTADO', 102, '', 0, '2024-01-10 19:46:52', '2024-01-10 19:46:52'),
('687f5e2a-bd42-4a02-b670-74cf1923b314', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.7 DATOS PARTICIPACIÃ“N CIUDADANA', 28, '', 0, '2024-01-10 16:40:17', '2024-01-10 16:40:17'),
('6940cc4e-746c-457c-8224-e57b983537b9', 'd5e8e45b-859b-4d5c-bf59-91647a96d03b', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'Analisis cualitativo', 1, '3000 caracteres', 0, '2023-12-07 19:36:50', '2023-12-07 19:36:50'),
('6cd9709e-a613-4910-93dd-dc2b1cba5cc7', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.6 RECOMENDACIONES', 63, '', 0, '2024-01-10 19:14:50', '2024-01-10 19:14:50'),
('6d03a7b1-167e-41b8-92de-e329fb86d901', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.1 PRINCIPALES AVANCES', 58, '', 0, '2024-01-10 19:06:12', '2024-01-10 19:06:12'),
('6de9d3e7-020e-4715-aa72-5c1a7ecfb1fe', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '1.1.	ENFOQUE DE DERECHOS HUMANOS DE LAS MUJERES', 7, '', 0, '2023-12-27 02:16:30', '2024-01-09 13:13:27'),
('6f7baf11-295f-45a6-a889-2149f94eac39', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.3 DATOS REPORTE DERECHOS', 51, '', 0, '2024-01-10 19:03:22', '2024-01-10 19:03:22'),
('7006a89d-05f3-42fd-a025-8c09ce6e9ea1', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10 MUJERES DE LAS DIVERSIDADES - SEXO GENÃ‰RICOS', 93, '', 0, '2024-01-10 19:42:41', '2024-01-10 19:42:41'),
('70167ba2-130c-413d-a2d3-f8c67a13c635', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.3 DATOS REPORTE DERECHOS', 33, '', 0, '2024-01-10 16:44:14', '2024-01-10 16:44:14'),
('716faee4-c25c-40a6-a3da-e15f291bdee2', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'AnÃ¡lisis nudo crÃ­tico', 16, '', 0, '2023-11-24 18:33:23', '2023-11-24 18:33:23'),
('721dd4b3-edd0-4cf4-a5bd-997023be4f85', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '1.3.	ENFOQUE DE CIUDADANÃA PLURAL, DEMOCRACIA PARITARIA, REPRESENTATIVA Y PARTICIPATIVA', 9, '', 0, '2023-12-27 02:19:31', '2024-01-09 13:13:30'),
('733a55e7-6461-440d-ae08-e652af12b090', 'd5e8e45b-859b-4d5c-bf59-91647a96d03b', 'cbf1222d-9a28-4da9-90f0-948301e87368', 'Datos cuantitativos', 2, 'Graficos', 0, '2023-12-09 01:22:18', '2023-12-09 01:22:18'),
('73dd6741-f8c5-439e-87f7-d3b65b45c3fe', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'cuÃ¡l o cuÃ¡les', 6, '', 0, '2023-11-20 19:47:36', '2023-11-20 19:47:36'),
('742eae03-900f-44a0-8ad3-13449cae5115', '60dec512-3212-499f-b718-4da5629a8c4c', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'Cantidades de Asistentes', 9, '', 0, '2024-01-12 01:04:48', '2024-01-12 01:04:48'),
('807513f5-0d7d-4dca-af78-709d7d5ffa43', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '276b9d80-a68f-43ed-b64f-4e2b620a2ed3', 'Imagen Primera Pagina', 1, '', 0, '2023-12-27 02:06:13', '2023-12-27 02:06:13'),
('80bc279b-a73b-45f7-95d5-085f37e9f06f', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.4 MONITOREO DE LA SOCIEDAD CIVIL', 88, '', 0, '2024-01-10 19:40:35', '2024-01-10 19:40:35'),
('80dbfa14-788f-4aad-8b30-29c3369617a3', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.6 RECOMENDACIONES', 72, '', 0, '2024-01-10 19:17:19', '2024-01-10 19:17:19'),
('81d22ab4-1dfa-48dc-8b7f-306878e511ec', '60dec512-3212-499f-b718-4da5629a8c4c', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'Otra OrganizaciÃ³n de la Sociedad Civil', 8, '', 0, '2024-01-13 15:53:46', '2024-01-13 15:53:46'),
('846ae21b-3d61-478b-b17f-120213c6ec17', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'Recomendaciones', 13, '', 0, '2023-11-21 15:23:11', '2023-11-21 15:26:09'),
('88f8d9fc-4f80-4a6a-bde2-720eb5200dfc', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '82775101-ed13-4e93-aea6-b0bd0fae9f58', 'Nivel de Avance Meta', 1, '', 0, '2023-11-15 01:55:25', '2023-11-15 01:55:25'),
('8c32eb5a-f0fb-42d2-a61e-42b079e54c2a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.5 OBSERVACIONES', 44, '', 0, '2024-01-10 16:47:56', '2024-01-10 16:47:56'),
('8e7f29a5-fbd2-43c7-898a-dc44d8c539f5', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.6 RECOMENDACIONES', 45, '', 0, '2024-01-10 16:48:21', '2024-01-10 16:48:21'),
('8f5627dc-d620-4a6e-bdb2-248bd8378014', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.8 IMAGENES ENCUENTROS CIUDADANOS', 65, '', 0, '2024-01-10 19:15:20', '2024-01-10 19:15:20'),
('8f600bd7-301f-47ca-b47d-470a4f711375', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'TÃ­tulo', 2, '', 0, '2024-01-08 18:59:23', '2024-01-08 18:59:23'),
('9055ed11-eafd-4131-b16c-39d7a29e5848', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.1 PRINCIPALES AVANCES', 67, '', 0, '2024-01-10 19:16:19', '2024-01-10 19:16:19'),
('90a2fd7f-f6c7-469a-97ed-afedcac90ae1', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'AnÃ¡lisis Cualitativo Avance de meta', 2, '', 0, '2023-09-29 00:06:58', '2023-12-18 14:21:36'),
('90a7a054-132d-40f6-9fd8-be547bb9c168', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '4. BIBLIOGRAFÃA', 111, '', 0, '2024-01-10 20:03:47', '2024-01-10 20:03:47'),
('94021ff3-aef6-45bf-b228-6e84b7caee2e', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.5 OBSERVACIONES', 107, '', 0, '2024-01-10 20:00:02', '2024-01-10 20:00:02'),
('94eca3c1-c6d6-4189-a8da-076a07584c4d', '7a00a141-675f-4a91-baa7-90a5c6442410', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'Avance Cualitativo', 2, 'Se deben reportar aquellas acciones estratÃ©gicas desarrolladas por el sector para lograr avances en las metas comprometidas. ', 0, '2023-08-22 14:26:55', '2023-08-22 18:38:22'),
('95aeb49a-b61f-496b-b34f-c1665dc40671', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.8 IMAGENES ENCUENTROS CIUDADANOS', 56, '', 0, '2024-01-10 19:04:49', '2024-01-10 19:04:49'),
('97c248be-6a25-4a8c-99a8-65df31b12e8a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.8 IMAGENES ENCUENTROS CIUDADANOS', 101, '', 0, '2024-01-10 19:44:29', '2024-01-10 19:44:29'),
('9b20f6ed-14cc-499e-a4d4-de0467900d76', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.2 RECOMENDACIONES', 32, '', 0, '2024-01-10 16:44:03', '2024-01-10 16:44:03'),
('9d7e231a-c6b1-4bb4-9e73-79d7e48513fc', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.5 OBSERVACIONES', 35, '', 0, '2024-01-10 16:44:39', '2024-01-10 16:44:39'),
('9dd9231b-38b6-4c6c-969c-bae514ba77ed', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.8 IMAGENES ENCUENTROS CIUDADANOS', 47, '', 0, '2024-01-10 16:48:59', '2024-01-10 16:48:59'),
('a0423b6e-2fc3-4908-9dae-36cbd7d9eb10', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.1 PRINCIPALES AVANCES', 31, '', 0, '2024-01-10 16:43:49', '2024-01-10 16:43:49'),
('a050ac9d-e64a-4c34-8e20-be6b5125156a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '1.2.	ENFOQUES DE INTERCULTURALIDAD E INTERSECCIONALIDAD', 8, '', 0, '2023-12-27 02:18:23', '2024-01-09 13:13:29'),
('a10795f6-442f-4752-b825-72af598a9c99', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '276b9d80-a68f-43ed-b64f-4e2b620a2ed3', '3.1.8 IMAGENES ENCUENTROS CIUDADANOS', 20, '', 0, '2024-01-10 14:52:20', '2024-01-10 15:50:39'),
('a132cf4f-1f6e-421d-a403-fb0798e0c6c1', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.8 IMAGENES ENCUENTROS CIUDADANOS', 29, '', 0, '2024-01-10 16:40:35', '2024-01-10 16:40:35'),
('a4f6621c-8016-41bd-a941-f79d2fa753e8', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.3 DATOS REPORTE DERECHOS', 78, '', 0, '2024-01-10 19:37:35', '2024-01-10 19:37:35'),
('a5ab035e-5974-423a-98a8-8d386f5ee3f8', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'III. AVANCES  POR DERECHOS PLAN NACIONAL DE IGUALDAD ', 11, '', 1, '2023-12-27 02:21:16', '2024-01-10 14:33:03'),
('a6b679f2-6923-4ed2-980c-6de06d03e609', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.4 MONITOREO DE LA SOCIEDAD CIVIL', 97, '', 0, '2024-01-10 19:43:25', '2024-01-10 19:43:25'),
('b0908cf4-c65f-428d-9d30-7dab3dc52a11', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '5134558a-bfa6-4c10-a090-6279b7d15334', 'Recomendaciones', 12, '', 0, '2023-11-15 02:09:00', '2023-11-15 02:09:00'),
('b1c6428c-81ec-4ff4-b946-edee26401867', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.3.4 MONITOREO DE LA SOCIEDAD CIVIL', 34, '', 1, '2024-01-10 16:44:26', '2024-01-10 16:44:26'),
('b1f2862a-2cbd-4e77-ba2f-95069348d358', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '1.4.	ENFOQUE TERRITORIAL', 10, '', 0, '2023-12-27 02:20:09', '2024-01-09 13:13:31'),
('b20a1f2b-51df-4a05-99eb-748507be45c2', '60dec512-3212-499f-b718-4da5629a8c4c', '96e2714c-9980-4e12-9d54-79183524c246', 'Modalidad', 4, '', 0, '2024-01-12 01:02:57', '2024-01-12 01:02:57'),
('b37c4cf4-07b0-4d56-adb9-08f77338d847', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.2 RECOMENDACIONES', 23, '', 0, '2024-01-10 16:37:59', '2024-01-10 16:37:59'),
('b7d72b93-a691-4976-b435-aae4e52fa0e8', '60dec512-3212-499f-b718-4da5629a8c4c', '21ad8b73-b0e4-11ee-9054-00090ffe0001', 'Fecha Encuentro Ciudadano', 2, '', 0, '2024-01-12 01:00:25', '2024-01-12 01:00:25'),
('bc378813-4df6-4986-bdd8-9c07ba0bd450', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.5 OBSERVACIONES', 71, '', 0, '2024-01-10 19:17:08', '2024-01-10 19:17:08'),
('beb7887f-a150-47c8-a480-09580fb03664', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'Avance de Metas Vinculado a Objetivos de cada Derecho', 8, '', 0, '2023-11-15 02:03:00', '2023-11-15 02:03:00'),
('bf5f65ac-2e3d-43f6-9e2c-5d4752c6f815', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8 MUJERES RURALES', 75, '', 0, '2024-01-10 19:36:32', '2024-01-10 19:36:32'),
('c2f3c553-94cb-4014-af1d-76c2a055ba20', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', ' Impacto en Mujeres', 5, 'Cantidad de mujeres impactadas (dato de cobertura).', 0, '2023-11-15 01:58:34', '2023-11-15 01:58:34'),
('c42b9d56-109e-4d01-8794-52b1cc64404d', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'OTROS PLANES CONSULTADOS POR WEB', 112, '', 0, '2024-01-10 20:07:33', '2024-01-10 20:07:33'),
('c5b6b018-ffb8-48dc-8e10-720354bf7e27', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9 PUEBLOS ORIGINARIOS Y AFRODESCENDIENTES', 84, '', 0, '2024-01-10 19:39:47', '2024-01-10 19:39:47'),
('c5c5cf42-f556-446c-9b78-21b4fd03527c', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', 'I. INTRODUCCIÃ“N', 5, '5', 0, '2024-01-09 02:04:44', '2024-01-09 16:56:26'),
('c79daed0-4522-40e0-beec-9f7681449fd1', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.6 RECOMENDACIONES', 99, '', 0, '2024-01-10 19:43:56', '2024-01-10 19:43:56'),
('c7b870e8-44f0-46fa-bbee-ae688d980f6d', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.7 DATOS PARTICIPACIÃ“N CIUDADANA', 91, '', 0, '2024-01-10 19:41:12', '2024-01-10 19:41:12'),
('c8494d3a-afaf-4407-a56a-621c78363b4a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6 COLECTIVOS Y AMBIENTALES', 57, '', 0, '2024-01-10 19:05:55', '2024-01-10 19:05:55'),
('c8daf4ed-3c85-4ff4-9b10-44b538009f73', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.8 IMAGENES ENCUENTROS CIUDADANOS', 92, '', 0, '2024-01-10 19:41:24', '2024-01-10 19:41:24'),
('cb0c076f-1006-42c5-995d-234c3cf77964', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'Recomendaciones', 15, '', 0, '2023-11-24 18:33:04', '2023-11-24 18:33:04'),
('cb3bf87b-d742-4bb6-9d3f-e7a842bad54b', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.2 RECOMENDACIONES', 50, '', 0, '2024-01-10 19:03:08', '2024-01-10 19:03:08'),
('ccaaeb53-f2e7-4afb-8e39-721b1b0ea112', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.2 RECOMENDACIONES', 104, '', 0, '2024-01-10 19:47:26', '2024-01-10 19:47:26'),
('cd23a9ba-e8be-4e5f-bc2d-16925e2d8812', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', 'd1374de7-07c8-4bde-bd7b-5fa147b49174', 'Nivel', 10, '', 0, '2023-11-15 02:06:20', '2023-11-15 02:06:20'),
('ce86b504-3bf3-41bf-aff9-ca9f1c941b34', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.5 OBSERVACIONES', 98, '', 0, '2024-01-10 19:43:36', '2024-01-10 19:43:36'),
('ce9282da-5ccf-4121-a59f-a4770f8980e2', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.1.6 RECOMENDACIONES', 18, '', 0, '2024-01-10 14:39:51', '2024-01-10 14:39:51'),
('d46228fa-3e13-4be0-803a-471d2aae3edf', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.4 MONITOREO DE LA SOCIEDAD CIVIL', 61, '', 1, '2024-01-10 19:14:26', '2024-01-10 19:14:26'),
('d7f8ad86-d416-4f6b-8d0b-c3f527c8f58f', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.4 MONITOREO DE LA SOCIEDAD CIVIL', 70, '', 1, '2024-01-10 19:16:55', '2024-01-10 19:16:55'),
('d9db9390-7374-44f1-a82f-4ab907bfb7fc', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.11.7 DATOS PARTICIPACIÃ“N CIUDADANA', 109, '', 0, '2024-01-10 20:00:21', '2024-01-10 20:00:21'),
('dd490000-c25a-40e5-9aa4-287889fcb7dd', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '55e68658-73d1-45a1-b7f0-6b064b3b02d5', 'Grupos de mujeres', 5, '', 0, '2023-11-20 19:46:14', '2023-11-20 19:49:13'),
('de872293-575e-4d24-8bbf-17a5bfee2091', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '3.1.5 OBSERVACIONES ', 17, '', 0, '2023-12-27 02:27:29', '2023-12-27 02:27:29'),
('def9e964-aabf-4fbc-a4c5-d097915b62c4', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.9.3 DATOS REPORTE DERECHOS', 87, '', 0, '2024-01-10 19:40:24', '2024-01-10 19:40:24'),
('e2765e7d-771e-487d-9164-16e4307a608f', '60dec512-3212-499f-b718-4da5629a8c4c', '2384dc97-758b-46c0-b1dc-afa312cd4d25', 'DescripciÃ³n Encuentro Ciudadano', 1, '', 0, '2024-01-12 00:59:46', '2024-01-12 00:59:46'),
('e79eb57d-81e4-4c39-818f-fede5250ab57', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.2 RECOMENDACIONES', 95, '', 0, '2024-01-10 19:43:03', '2024-01-10 19:43:03'),
('e8607073-abfb-4150-a281-f3cbaa8017aa', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '3.1.3 DATOS REPORTE DERECHOS', 15, '', 0, '2023-12-27 02:26:58', '2023-12-27 02:26:58'),
('ea2e8a46-2fc4-40b2-a302-ecea06877510', '7a00a141-675f-4a91-baa7-90a5c6442410', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', 'Avance Cuantitativo', 1, 'Debe reportar sÃ³lo el % que presenta el indicador a la fecha del informe.', 0, '2023-08-22 14:26:18', '2023-08-22 14:43:35'),
('eb30043f-0863-4e54-a805-64d721755f26', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4 LIBRE DE VIOLENCIAS Y DISCRIMINACIÃ“N', 39, '', 0, '2024-01-10 16:46:32', '2024-01-10 16:46:32'),
('ec0737f7-c58f-4807-b51a-9efee9b04c89', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.4.2 RECOMENDACIONES', 41, '', 0, '2024-01-10 16:47:16', '2024-01-10 16:47:16'),
('efe5b47f-7008-430c-8a64-5df629a8a086', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.10.1 PRINCIPALES AVANCES', 94, '', 0, '2024-01-10 19:42:52', '2024-01-10 19:42:52'),
('f0147986-09ee-41d1-905f-09f5e31ce19a', '83aa525f-6d16-4fc8-b361-84dbf84eb908', 'af4e68f3-2ccd-43d5-95e8-cba74824963d', '3.1 DERECHOS CIVILES Y POLÃTICO', 12, '', 0, '2023-12-27 02:26:00', '2023-12-27 02:26:00'),
('f0995eda-1c71-45dd-98d4-56157b3a3dd6', 'ef1e3d24-cf32-42bb-94c0-e5ab56016b02', '2384dc97-758b-46c0-b1dc-afa312cd4d25', 'Recomendaciones del derecho', 2, '500 caracteres', 0, '2023-12-24 23:17:01', '2023-12-24 23:17:01'),
('f0de5ac8-6044-4d88-b7cb-8f34c2af6be1', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.6.5 OBSERVACIONES', 62, '', 0, '2024-01-10 19:14:39', '2024-01-10 19:14:39'),
('f16be4ee-2be7-44f5-9a39-8e5e359ea6c4', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.8.7 DATOS PARTICIPACIÃ“N CIUDADANA', 82, '', 0, '2024-01-10 19:38:28', '2024-01-10 19:38:28'),
('f3227f66-01f4-4783-b20a-3607e9245721', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '82775101-ed13-4e93-aea6-b0bd0fae9f58', 'AnÃ¡lisis de GÃ©nero de Avance de la Meta', 1, '', 0, '2023-09-29 00:05:24', '2023-09-29 00:05:24'),
('f53a556c-98fc-4f8c-a6df-a50653c63478', 'bc2571f9-7e18-40e8-8438-dac4869cc8b1', '886f652c-be17-4119-ac73-972d37d4e519', 'AnÃ¡lisis Cualitativo del Porcentaje de Avance', 4, '', 0, '2023-11-15 01:57:33', '2023-11-15 01:57:33'),
('f634b978-a92a-46b9-9f7d-5fdc77651a1f', '60dec512-3212-499f-b718-4da5629a8c4c', '757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'Derecho', 3, '', 0, '2024-01-12 01:00:42', '2024-01-12 01:00:42'),
('f93fa416-cc6a-4e18-a12c-83ec5b70567e', '60dec512-3212-499f-b718-4da5629a8c4c', '757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'Alcance Territorial', 6, '', 0, '2024-01-12 01:03:50', '2024-01-12 01:03:50'),
('f9aa8e5d-fa41-4a78-8702-f9bddf9559b0', '4beb018d-4cea-48d2-8aa7-5ae0290cc032', '2384dc97-758b-46c0-b1dc-afa312cd4d25', 'Recomendaciones', 2, '500 caracteres', 0, '2023-12-25 19:27:03', '2023-12-25 19:27:03'),
('fa6103ab-d78a-4493-a5f9-c6503899bc61', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.7.2 RECOMENDACIONES', 68, '', 0, '2024-01-10 19:16:31', '2024-01-10 19:16:31'),
('fa975338-c00d-4f49-a7d3-00db5cdbc8f0', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.4 MONITOREO DE LA SOCIEDAD CIVIL', 25, '', 1, '2024-01-10 16:39:39', '2024-01-10 16:39:39'),
('fcbd5592-7b90-4846-850e-ae69a8514d06', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.5.4 MONITOREO DE LA SOCIEDAD CIVIL', 52, '', 1, '2024-01-10 19:03:49', '2024-01-10 19:03:49'),
('fee0d432-ea7a-488a-ac27-c1239dd011dc', '7a00a141-675f-4a91-baa7-90a5c6442410', '276b9d80-a68f-43ed-b64f-4e2b620a2ed3', 'Medios de VerificaciÃ³n', 3, '', 0, '2023-08-22 14:32:06', '2023-08-22 14:43:43'),
('ffa32dea-e278-401e-8311-baba258c160b', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.5 OBSERVACIONES', 26, '', 0, '2024-01-10 16:39:52', '2024-01-10 16:39:52'),
('ffd2067e-3498-4d7d-a33a-200e54317f69', '9dd8170a-a85a-41fc-ac78-4469938f83fd', '886f652c-be17-4119-ac73-972d37d4e519', 'Analisis nudo critico', 14, '', 0, '2023-11-21 15:24:25', '2023-11-21 15:25:23'),
('ffebc3d1-7724-4c20-906d-bf2a2462a9e0', '83aa525f-6d16-4fc8-b361-84dbf84eb908', '2f839d3e-329a-4adf-812e-850baf90bd6a', '3.2.1 PRINCIPALES AVANCES', 22, '', 0, '2024-01-10 16:37:44', '2024-01-10 16:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_duty_ministries`
--

DROP TABLE IF EXISTS `evaluation_duty_ministries`;
CREATE TABLE IF NOT EXISTS `evaluation_duty_ministries` (
  `id` char(36) NOT NULL,
  `evaluation_id` char(36) NOT NULL,
  `duty_ministry_id` char(36) NOT NULL,
  `answer` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evaluations_has_duty_ministries_duty_ministries1_idx` (`duty_ministry_id`),
  KEY `fk_evaluations_has_duty_ministries_evaluations1_idx` (`evaluation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_duty_ministries`
--

INSERT INTO `evaluation_duty_ministries` (`id`, `evaluation_id`, `duty_ministry_id`, `answer`, `created`, `modified`) VALUES
('00a485e8-8288-40b2-9828-eef5fa617c99', 'f3227f66-01f4-4783-b20a-3607e9245721', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'No iniciado', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('08188ba3-3722-4d51-b15b-4a53f79c8754', '22302b17-6f79-401f-87ff-19df832cfa90', '476d6a00-5b33-479b-95c2-e49f237be040', 'sadsaddas', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('08fbfb0b-9609-40a9-a590-ae786f8b90dc', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '55b9d685-43b9-4042-8d85-64682fb377a8', 'dsadassad', '2024-01-10 18:58:04', '2024-01-10 18:58:04'),
('0f93643c-03d1-415c-996b-a0521d5c8b7d', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'asdsasad', '2024-01-08 17:44:48', '2024-01-08 17:44:48'),
('0f9abf02-3f8f-4b13-993d-cf18fc655e86', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', 'eafd01ed-462f-4b20-989a-fa971c8823ad', NULL, '2024-01-09 12:54:09', '2024-01-09 12:54:09'),
('141b552a-3899-4fa3-86f2-ef2eea52f7e3', '73dd6741-f8c5-439e-87f7-d3b65b45c3fe', '2e049d57-dcff-4cae-93f6-dcef327b89fe', '', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('1b3686bf-0bed-4778-a5b3-51e4dabb1c51', '1ce0e33f-f785-499b-88cf-5e8017f8bb86', '2e049d57-dcff-4cae-93f6-dcef327b89fe', '2', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('1df5a9b0-d63f-4496-9bba-07b053a121c2', '22302b17-6f79-401f-87ff-19df832cfa90', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'sadadsads', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('1e1d082f-245c-4fa6-bc1e-77a06fa2c722', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', NULL, '2024-01-10 20:34:19', '2024-01-10 20:34:46'),
('2071f9c4-7dd6-415d-b0f2-133dbdabeb73', 'dd490000-c25a-40e5-9aa4-287889fcb7dd', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'LGBTIQA+', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('2a8ba688-c010-4a03-a712-6e1cc671ff4d', '73dd6741-f8c5-439e-87f7-d3b65b45c3fe', '476d6a00-5b33-479b-95c2-e49f237be040', '', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('2c73f950-a159-42a2-b771-486914d3c2a5', '90a2fd7f-f6c7-469a-97ed-afedcac90ae1', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'sadsaaddasdas', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('2c987293-e8e2-482e-8a3d-aed121c96493', '1f7dcf88-72c1-4aeb-9fc4-f6ecacb075e4', '476d6a00-5b33-479b-95c2-e49f237be040', 'asdsad', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('33a5e49a-db5a-4110-8986-857b30ecb8bc', '2117dc2c-a59a-4f99-af74-0c0f3fb9b555', '2e049d57-dcff-4cae-93f6-dcef327b89fe', '2', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('3b92a47d-b5de-4612-bca2-e85abe17ccd1', '446d05cf-5457-44ba-9d77-cd7419398bf1', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'Si', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('40ee71af-e2f2-4b8b-a065-4faca7975ccb', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '2e049d57-dcff-4cae-93f6-dcef327b89fe', NULL, '2024-01-08 17:44:48', '2024-01-08 17:44:48'),
('47fe7fd4-47c5-449b-9d26-0a992f5745a4', '4b799fac-426a-4d65-802c-5a9fea626d42', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'Gobernanza Interna de GÃ©nero', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('482aeb4b-9302-49f8-b3f6-dcedcd88f1e6', 'dd490000-c25a-40e5-9aa4-287889fcb7dd', '476d6a00-5b33-479b-95c2-e49f237be040', 'Rurales', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('487fade1-34bd-4785-88e3-a4a49e71eef3', '446d05cf-5457-44ba-9d77-cd7419398bf1', '476d6a00-5b33-479b-95c2-e49f237be040', 'Si', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('4901d023-b6b6-4378-a575-bced028726d8', 'f3227f66-01f4-4783-b20a-3607e9245721', '476d6a00-5b33-479b-95c2-e49f237be040', 'En implementaciÃ³n', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('4e3474d3-c1a9-47ba-946e-63a9633e8151', '04807b00-dbfd-4ae1-9a42-764a27f41d94', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'sdaaddas', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('51675205-9dfd-43d0-b138-ac2622ae04ab', '73dd6741-f8c5-439e-87f7-d3b65b45c3fe', 'eafd01ed-462f-4b20-989a-fa971c8823ad', '', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('52595a7e-bdb9-493d-9c3a-f461b34a2100', '1f7dcf88-72c1-4aeb-9fc4-f6ecacb075e4', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'dsadasdadas', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('54dd2f48-5fe4-4f4c-832d-6ded2d3bda07', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', '2', '2024-01-10 20:34:19', '2024-01-10 20:34:46'),
('5bbd0bbc-6ed0-43ce-a263-41ce65e4f1e4', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '55b9d685-43b9-4042-8d85-64682fb377a8', NULL, '2024-01-10 18:58:04', '2024-01-10 18:58:04'),
('5c987057-3a50-471f-9d63-35ce5d709f99', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '5209fee7-2288-4e47-bcac-1bbadd3ac467', 'sdasas', '2024-01-10 18:57:34', '2024-01-10 18:57:34'),
('5d8485f4-8426-4553-8603-3493a8a0ca94', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '2e049d57-dcff-4cae-93f6-dcef327b89fe', '2', '2024-01-08 17:44:48', '2024-01-08 17:44:48'),
('5e5e0047-8f3c-4e9a-87df-b6ee5c0d74ba', '04807b00-dbfd-4ae1-9a42-764a27f41d94', '476d6a00-5b33-479b-95c2-e49f237be040', 'daadssad', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('61766b75-2b86-4be2-83b7-6e1337240bee', '1f7dcf88-72c1-4aeb-9fc4-f6ecacb075e4', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'dsaadsads', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('64973437-0c63-45f6-b9b1-5ef6ab8bcb83', '1ce0e33f-f785-499b-88cf-5e8017f8bb86', 'eafd01ed-462f-4b20-989a-fa971c8823ad', '2', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('653e7c13-745f-4b65-a99d-36cef3b40ad8', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', 'asdsda', '2024-01-10 18:57:49', '2024-01-10 18:57:49'),
('6606c1d0-abae-4d2c-bf3a-00e55eecdd2e', '2117dc2c-a59a-4f99-af74-0c0f3fb9b555', '476d6a00-5b33-479b-95c2-e49f237be040', '21', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('66114d43-e92f-4552-8d51-40a5430ff342', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', 'eafd01ed-462f-4b20-989a-fa971c8823ad', '123', '2024-01-09 12:54:09', '2024-01-09 12:54:09'),
('69216a0d-efbd-4ea9-886e-c2141ecd93a4', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '44d2097c-c378-4c01-9f60-790218be1e0f', '123', '2024-01-10 20:36:59', '2024-01-10 20:36:59'),
('6dc48a4c-fe2d-4782-881b-d66f98aac2f4', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '44d2097c-c378-4c01-9f60-790218be1e0f', NULL, '2024-01-10 20:36:59', '2024-01-10 20:36:59'),
('7117c5ad-7217-4894-b939-363e540854ad', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '55b9d685-43b9-4042-8d85-64682fb377a8', '1232', '2024-01-10 18:58:04', '2024-01-10 18:58:04'),
('7409a840-a06e-45bf-8179-c393252b456f', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '710b6532-edee-41ae-b33a-b6dc44c47d4c', '123', '2024-01-09 12:59:03', '2024-01-09 12:59:03'),
('7492783f-890c-4ae8-b5ad-28faed9ae7bb', '1ce0e33f-f785-499b-88cf-5e8017f8bb86', '476d6a00-5b33-479b-95c2-e49f237be040', '2', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('76bddd76-fe8e-4439-a79b-cb2ff7ad977c', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '476d6a00-5b33-479b-95c2-e49f237be040', 'asddsads', '2024-01-09 12:50:06', '2024-01-09 12:50:06'),
('7eaed832-10c5-419a-b561-fcdec6cceadd', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '0df83bd1-e7e5-4ecc-8974-f98c0f1a2bb4', 'dasdassadsaddsdsadsadadssad', '2024-01-10 20:34:19', '2024-01-10 20:34:46'),
('8194d9fc-3518-486a-b7cc-1c275ad1b836', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '6a705d0c-3161-4c79-a7ea-50a575c16afb', '1', '2024-01-10 20:36:15', '2024-01-10 20:57:41'),
('8998f836-f694-4b35-94fe-df1035efdf19', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '710b6532-edee-41ae-b33a-b6dc44c47d4c', 'sadssad', '2024-01-09 12:59:03', '2024-01-09 12:59:03'),
('8a3317af-9d47-488a-95d4-c724a32282e0', '90a2fd7f-f6c7-469a-97ed-afedcac90ae1', '476d6a00-5b33-479b-95c2-e49f237be040', 'adadasadssda', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('8f040ee0-510c-4993-a49e-2dc3284c7349', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '6a705d0c-3161-4c79-a7ea-50a575c16afb', 'retro', '2024-01-10 20:36:15', '2024-01-10 20:57:41'),
('93af7aba-bdc4-4818-8b70-16438a9e4501', '94eca3c1-c6d6-4189-a8da-076a07584c4d', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'sddasdassad', '2024-01-09 12:54:09', '2024-01-09 12:54:09'),
('94ac9b24-dc82-46fa-bb31-de197aaedec2', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '44d2097c-c378-4c01-9f60-790218be1e0f', 'mnbvcxzkjhgfds', '2024-01-10 20:36:59', '2024-01-10 20:36:59'),
('95d5c3b3-8371-4875-8501-d67bd5e706d4', '446d05cf-5457-44ba-9d77-cd7419398bf1', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'Si', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('987434e4-4b29-45b0-8ebd-219b2174476d', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', NULL, '2024-01-10 20:36:39', '2024-01-10 20:36:39'),
('a4848dfb-ac91-4cca-beed-3be097f13a39', '130f7279-7dd1-410c-a1db-d8ccd69cb408', '476d6a00-5b33-479b-95c2-e49f237be040', 'dsssdadsa', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('a8d4898b-d9cc-4e22-9841-90ca2bede3d8', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '6a705d0c-3161-4c79-a7ea-50a575c16afb', NULL, '2024-01-10 20:36:15', '2024-01-10 20:57:41'),
('a98d2cac-7f6d-48b2-85c2-8d7d94c8b964', '4b799fac-426a-4d65-802c-5a9fea626d42', '476d6a00-5b33-479b-95c2-e49f237be040', 'Gobernanza Interna de GÃ©nero', '2024-01-11 11:29:19', '2024-01-11 11:29:19'),
('ad97b78a-f347-40b9-b209-d6b7883558ed', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '5209fee7-2288-4e47-bcac-1bbadd3ac467', NULL, '2024-01-10 18:57:34', '2024-01-10 18:57:34'),
('b64c14ef-8353-4021-adbc-492fc97c02fb', '4b799fac-426a-4d65-802c-5a9fea626d42', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'Gobernanza Interna de GÃ©nero', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('bc16425b-33db-44a3-88b1-3b14a93c7785', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '476d6a00-5b33-479b-95c2-e49f237be040', NULL, '2024-01-09 12:50:06', '2024-01-09 12:50:06'),
('c70cf8d4-6dc3-4690-bbdf-21ae5c3950ab', 'dd490000-c25a-40e5-9aa4-287889fcb7dd', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'LGBTIQA+', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('c9de82b6-3f3b-40b1-ae81-e4283dfd36e9', '04807b00-dbfd-4ae1-9a42-764a27f41d94', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'adsadsdas', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('cd8ce00a-b003-4003-b21f-7734be34b326', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', '12', '2024-01-10 18:57:49', '2024-01-10 18:57:49'),
('cdceac7f-7f06-4e35-b56d-120328624ad4', 'f3227f66-01f4-4783-b20a-3607e9245721', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'En implementaciÃ³n', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('d0ad31c0-82c4-40f6-bbd5-ba7d30db8bb6', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '59ac0e44-d88c-4082-8319-e1ebebec1fbb', NULL, '2024-01-10 18:57:49', '2024-01-10 18:57:49'),
('d8967bee-a1c6-4761-b918-bb912012ec59', '22302b17-6f79-401f-87ff-19df832cfa90', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'dassad', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('df3d5cd1-f49a-4cd9-8e37-5ae20368390a', 'fee0d432-ea7a-488a-ac27-c1239dd011dc', '710b6532-edee-41ae-b33a-b6dc44c47d4c', NULL, '2024-01-09 12:59:03', '2024-01-09 12:59:03'),
('e0c8ca0e-8f1a-490c-b17c-94e8bab18c5c', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '476d6a00-5b33-479b-95c2-e49f237be040', '12', '2024-01-09 12:50:06', '2024-01-09 12:50:06'),
('e6430442-7b66-48d1-9c00-64a6b3b66b80', '130f7279-7dd1-410c-a1db-d8ccd69cb408', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'asddassadsad', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('e9224051-1438-4285-9058-662538e3aeb4', '2117dc2c-a59a-4f99-af74-0c0f3fb9b555', 'eafd01ed-462f-4b20-989a-fa971c8823ad', '2', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('ea93c96b-4472-4a43-8b4c-c373a1a16e5e', '94eca3c1-c6d6-4189-a8da-076a07584c4d', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', 'dsdasdasdasads', '2024-01-10 20:36:39', '2024-01-10 20:36:39'),
('eb07eaff-325c-47b2-88ee-92355e813d9c', '90a2fd7f-f6c7-469a-97ed-afedcac90ae1', 'eafd01ed-462f-4b20-989a-fa971c8823ad', 'asddasdasads', '2024-01-11 12:05:10', '2024-01-11 12:05:10'),
('fbcc803d-7b78-4a51-ba0d-08fc94f1d762', '130f7279-7dd1-410c-a1db-d8ccd69cb408', '2e049d57-dcff-4cae-93f6-dcef327b89fe', 'sddasadssad', '2024-01-11 11:58:55', '2024-01-11 11:58:55'),
('ff0a8e12-629f-4b1e-a28d-24d5c04b290e', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '923afb43-fcbe-4a1e-890c-d4ab497e01fa', '3', '2024-01-10 20:36:39', '2024-01-10 20:36:39'),
('ff9d5c17-9806-45d2-8e15-f09776535d61', 'ea2e8a46-2fc4-40b2-a302-ecea06877510', '5209fee7-2288-4e47-bcac-1bbadd3ac467', '1', '2024-01-10 18:57:34', '2024-01-10 18:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_types`
--

DROP TABLE IF EXISTS `evaluation_types`;
CREATE TABLE IF NOT EXISTS `evaluation_types` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_types`
--

INSERT INTO `evaluation_types` (`id`, `name`, `created`, `modified`) VALUES
('4beb018d-4cea-48d2-8aa7-5ae0290cc032', 'Herramienta para la EvaluaciÃ³n de Derechos(Sociedad civil-jefatura Analista ejecutiva)', '2023-12-25 15:37:28', '2023-12-25 19:07:25'),
('60dec512-3212-499f-b718-4da5629a8c4c', 'BitÃ¡cora de Encuentros Ciudadanos', '2024-01-12 00:58:27', '2024-01-12 00:58:27'),
('7a00a141-675f-4a91-baa7-90a5c6442410', 'Herramienta para la EvaluaciÃ³n de Indicadores', '2023-08-22 14:14:24', '2023-08-22 14:46:33'),
('83aa525f-6d16-4fc8-b361-84dbf84eb908', 'Informe Anual', '2023-12-27 01:57:56', '2023-12-27 01:57:56'),
('9dd8170a-a85a-41fc-ac78-4469938f83fd', 'Herramienta para la EvaluaciÃ³n de Metas', '2023-08-22 14:14:59', '2023-08-22 14:46:39'),
('bc2571f9-7e18-40e8-8438-dac4869cc8b1', 'Herramienta para la EvaluaciÃ³n de Metas (lider)', '2023-08-22 14:15:26', '2023-09-10 02:57:44'),
('d5e8e45b-859b-4d5c-bf59-91647a96d03b', 'Herramienta para la EvaluaciÃ³n de Derechos', '2023-12-07 19:00:45', '2023-12-07 19:00:45'),
('ef1e3d24-cf32-42bb-94c0-e5ab56016b02', 'Herramienta para la EvaluaciÃ³n de Derechos(Sociedad civil)', '2023-12-24 23:14:47', '2023-12-24 23:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `level`, `created`, `modified`) VALUES
(1, 'Administrador', 0, '2023-09-11 02:02:38', '2023-09-11 02:02:38'),
(2, 'Asesora', 1, '2023-09-11 02:03:16', '2023-09-11 02:03:16'),
(3, 'Gabinete', 2, '2023-09-11 02:03:27', '2023-09-11 02:03:27'),
(4, 'Superior', 3, '2023-09-11 02:03:39', '2023-09-11 02:03:39'),
(5, 'Sectorialista', 4, '2023-09-11 02:03:57', '2023-09-11 02:03:57'),
(6, 'Secretaria Ejecutiva', 5, '2023-11-16 13:26:36', '2023-11-16 13:26:36'),
(7, 'Digitadora', 0, '2023-11-24 01:24:52', '2023-11-24 01:24:52'),
(8, 'Jefatura SecretarÃ­a Ejecutiva', 6, '2023-12-10 22:34:00', '2023-12-10 22:34:00'),
(9, 'Sociedad Civil', 0, '2023-12-15 03:44:36', '2023-12-15 03:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `ministries`
--

DROP TABLE IF EXISTS `ministries`;
CREATE TABLE IF NOT EXISTS `ministries` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ministries`
--

INSERT INTO `ministries` (`id`, `name`, `created`, `modified`) VALUES
('09b9c7de-7bf1-4646-8450-143b56d68669', 'Ministerio de Transportes y Telecomunicaciones', '2024-01-10 19:10:25', '2024-01-10 19:10:25'),
('0d85e84f-54dc-4201-9212-58c55677c964', 'Ministerio de MinerÃ­a', '2024-01-10 19:10:18', '2024-01-10 19:10:18'),
('3dd9832f-a809-4868-8a97-63a17951f034', 'Ministerio de las Culturas, las Artes y el Patrimonio', '2024-01-10 19:10:59', '2024-01-10 19:10:59'),
('418a5c34-577e-44c9-b82b-d0ca28c4f5f2', 'Ministerio de Vivienda y Urbanismo', '2024-01-10 19:10:04', '2024-01-10 19:10:04'),
('63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 'Ministerios de la Mujer y la Equidad de GÃ©nero', '2023-08-14 13:36:43', '2023-08-14 13:36:43'),
('70a41546-4009-4d8c-ab72-04275fe72a97', 'No Aplica', NULL, NULL),
('7198d647-e554-41f1-9be3-afe084cdc5a8', 'Ministerio de Desarrollo Social y Familia', '2024-01-10 19:00:58', '2024-01-10 19:00:58'),
('7658a7d2-b19f-4479-bb32-c33e90b46200', 'Ministerio del Deporte', '2024-01-10 19:10:52', '2024-01-10 19:10:52'),
('7fa8a593-dc4f-4080-9320-ba1ee4edd364', 'Poder Legislativo', '2023-08-14 13:37:31', '2023-08-14 13:37:31'),
('812e3cf3-c50a-4006-998f-7870d43a2920', 'Ministerio SecretarÃ­a General de la Presidencia de Chile', '2023-08-14 13:36:24', '2023-08-14 13:36:24'),
('8929aabf-9f07-4579-a25c-d453f9ea5b9d', 'Ministerio del Trabajo y PrevisiÃ³n Social', '2024-01-10 19:09:39', '2024-01-10 19:09:39'),
('905b738d-2f64-480f-986d-cad60188f0a8', 'Ministerio de Defensa Nacional', '2024-01-10 19:00:12', '2024-01-10 19:00:12'),
('9343d37d-eb65-4303-a7de-97a3d80d7d0a', 'Ministerio de Agricultura', '2024-01-10 19:10:10', '2024-01-10 19:10:10'),
('9f0b7b08-d576-4ac5-8d9c-68d7da54809b', 'Ministerio de Bienes Nacionales', '2024-01-10 19:10:31', '2024-01-10 19:10:31'),
('a4dba5c8-0269-4313-8392-5c67ea777826', 'Ministerio de Ciencia, TecnologÃ­a, Conocimiento e InnovaciÃ³n', '2024-01-10 19:11:07', '2024-01-10 19:11:07'),
('a611fbe7-9492-49bb-a9a1-978682101283', 'Ministerio de Salud', '2024-01-10 19:09:57', '2024-01-10 19:09:57'),
('abca7dde-5d52-4256-86c0-90a841593918', 'Ministerio del Interior y Seguridad PÃºblica', '2024-01-10 18:59:47', '2024-01-10 18:59:47'),
('b50f76a4-b654-434f-b7f2-077a3c7e8e69', 'Ministerio de EconomÃ­a, Fomento y Turismo', '2024-01-10 19:00:50', '2024-01-10 19:00:50'),
('bbe4151d-d84b-43b7-85af-e289a271d474', 'Ministerio de Relaciones Exteriores', '2024-01-10 19:00:01', '2024-01-10 19:00:01'),
('bc38b8b9-62c5-45bb-b31f-bf36803803d6', 'Ministerio de EnergÃ­a', '2024-01-10 19:10:41', '2024-01-10 19:10:41'),
('bef622df-a7ed-4ab4-a886-a96ce81ff4b2', 'PRESIDENCIA DE LA REPÃšBLICA', '2024-01-10 19:19:39', '2024-01-10 19:19:39'),
('ca223487-4db2-434f-a05c-5b9211d07932', 'Ministerio de EducaciÃ³n', '2024-01-10 19:09:17', '2024-01-10 19:09:17'),
('d069fe47-fca5-426c-bee4-5b82df14b948', 'Ministerio SecretarÃ­a General de Gobierno', '2024-01-10 19:00:43', '2024-01-10 19:00:43'),
('d51107ce-ff0e-4118-b7db-78118298b7d3', 'Ministerio de Justicia y Derechos Humanos', '2024-01-10 19:09:29', '2024-01-10 19:09:29'),
('eb61a4d9-fcec-4288-b1e6-fb74fcb4ffbc', 'Ministerio de Hacienda', '2024-01-10 19:00:19', '2024-01-10 19:00:19'),
('f6070fbe-7ff0-42f3-9a74-f15c7c4baea5', 'Ministerio de Obras PÃºblicas', '2024-01-10 19:09:51', '2024-01-10 19:09:51'),
('f838bd6d-429a-4546-b7c1-24a3cebe9d6b', 'Ministerio del Medio Ambiente', '2024-01-10 19:10:47', '2024-01-10 19:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `regions` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `legal_representative` varchar(255) DEFAULT NULL,
  `description` text,
  `web` tinyint(4) DEFAULT '0',
  `approved` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `regions`, `email`, `phone`, `legal_representative`, `description`, `web`, `approved`, `created`, `modified`) VALUES
('129ba635-92e5-4b50-bc9a-d10618ba70b4', 'organizacion de camila', 'RegiÃ³n de Antofagasta', 'cuyevil1@gmail.com', '965414134', 'camila', 'asdsda', 0, NULL, '2024-01-02 14:12:10', '2024-01-02 14:12:10'),
('333b8050-63a2-4258-85e4-389ec5794abd', 'OrganizaciÃ³n 2', 'RegiÃ³n de Arica y Parinacota', 'organizacion2@org.com', '46637282919', 'Shrek', 'lnldkasjdlasd', 0, NULL, '2023-12-15 03:02:46', '2023-12-15 03:40:53'),
('6126dff7-227d-4fcd-812c-a6187bab903f', 'hola', 'RegiÃ³n de Coquimbo', 'prueba@prueba.cl', '965414134', 'yo', 'asddassadd', 0, NULL, '2024-01-08 12:44:07', '2024-01-08 12:44:07'),
('675c84d0-61c4-4262-8691-7b785c954edd', 'OrganizaciÃ³n 1', 'RegiÃ³n Metropolitana', '', '', NULL, NULL, 0, NULL, '2023-12-15 03:01:46', '2023-12-15 03:01:46'),
('8bf0a86d-9856-4465-a85b-8f777d23b444', 'organizacion de gonzalo', 'RegiÃ³n de TarapacÃ¡', 'cuyevil1@gmail.com', '965414134', 'mauricio', 'camila', 0, NULL, '2023-12-29 20:08:17', '2023-12-29 20:09:38'),
('a11e92fa-ecb8-4b31-bee7-ac88b52e2beb', 'organizacion de catalina', 'RegiÃ³n de Coquimbo', 'catalina.prueba@gmail.com', '123456789', 'catalina', 'esto es una prueba', 0, NULL, '2024-01-08 14:46:59', '2024-01-08 14:46:59'),
('fc2d0165-e8e2-46bc-8bca-5a1a77058053', 'OrganizaciÃ³n 3', 'RegiÃ³n de Oâ€™Higgins', 'organizacion3@org.com', '9695957474', NULL, NULL, 0, NULL, '2023-12-15 03:03:21', '2023-12-15 03:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id` char(36) NOT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `organization_id` char(36) DEFAULT NULL,
  `name` varchar(125) NOT NULL,
  `lastname` varchar(125) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `run` varchar(8) DEFAULT NULL,
  `div` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_people_people1_idx` (`parent_id`),
  KEY `fk_people_organizations1_idx` (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `parent_id`, `organization_id`, `name`, `lastname`, `email`, `phone`, `run`, `div`, `created`, `modified`) VALUES
('0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', NULL, 'asesora3', '3', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-10-20 17:48:52', '2023-12-02 03:12:19'),
('11fbc4a2-b460-4549-93fb-2f24d76e75fa', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', NULL, 'mauricio', 'sectorialista', 'christian1998inf@gmail.com', NULL, NULL, NULL, '2023-08-30 14:38:49', '2023-12-18 13:58:51'),
('13e806c9-12c5-4398-aa61-08c866d85075', NULL, NULL, 'Analista Secretaria', 'Ejecutiva', 'acortes@mmeg.cl', NULL, NULL, NULL, '2023-11-16 13:32:29', '2023-12-02 03:01:58'),
('15907f0d-e3df-420e-9090-9e964a6cc4a4', NULL, NULL, 'usuario uno', 'uno', 'christian1998inf@gmail.com', NULL, NULL, NULL, '2023-09-11 02:26:08', '2024-01-09 12:53:35'),
('42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', NULL, 'usuario dos', 'dos', 'cuyevil1@gmail.com', NULL, NULL, NULL, '2023-08-30 14:37:47', '2024-01-09 12:53:01'),
('4b48c350-4f93-4864-8ac8-eb3d6e2eba53', NULL, NULL, 'jefatura3', '3', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-10-20 17:52:52', '2023-12-02 03:05:35'),
('687f88b2-32e0-4c6e-9d89-eda84aa85b3f', NULL, NULL, 'Digitadora', 'Digitadora', 'test@gsd.cl', NULL, NULL, NULL, '2023-11-24 01:24:11', '2023-12-02 03:06:09'),
('6bc7162d-6899-454b-98ed-07b7032c701e', NULL, NULL, 'americo superior', 'tres', 'castete@ogconsultores.cl', NULL, NULL, NULL, '2023-08-30 14:38:07', '2024-01-11 11:16:26'),
('7dc6c48b-5507-49c0-9758-70b2eadbd669', NULL, '333b8050-63a2-4258-85e4-389ec5794abd', 'Nombre Sociedad Civil', 'Apellido Sociedad Civil', 'test@gsd.cl', NULL, NULL, NULL, '2023-12-15 14:34:33', '2023-12-24 17:41:23'),
('8d975715-6ec8-4a33-ab48-a4be30401aab', NULL, NULL, 'christian', 'gabinete', 'cuyevil1@gmail.com', NULL, NULL, NULL, '2023-08-30 14:38:30', '2023-12-02 03:08:25'),
('8edd4b9b-8b1e-4688-8d51-b1b15571f7fd', NULL, '8bf0a86d-9856-4465-a85b-8f777d23b444', 'gonzalo ', 'gonzalo', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-12-29 20:11:51', '2023-12-29 20:11:51'),
('96661e52-6288-4cb2-8384-425c7093e28d', NULL, NULL, 'gabinete3', '3', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-10-20 17:52:35', '2023-12-02 03:09:02'),
('b2a17b23-4329-404e-81a3-dda82fffeb66', NULL, '129ba635-92e5-4b50-bc9a-d10618ba70b4', 'camila', 'camila', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2024-01-02 14:13:43', '2024-01-02 14:13:43'),
('bf227a31-43c2-4636-93c1-ed50ae18140d', NULL, NULL, 'Sectorialista Lider', 'Apellido Sectorialista Lider', 'acortes@minmujeryeg.gob.cl', NULL, NULL, NULL, '2023-11-12 01:40:56', '2023-12-02 03:10:02'),
('c20fd500-b083-4ff0-b415-9d63fefcc5cc', NULL, NULL, 'test', 'test', 'test@gsd.cl', NULL, NULL, NULL, '2023-12-02 02:25:08', '2023-12-02 02:54:55'),
('c3438fe0-aab2-431f-baa8-3964feafbae2', NULL, NULL, 'jefatura secretaria', 'ejecutiva', 'cuyevil1@gmail.com', '12345678', '12323', '4', '2023-12-10 22:36:22', '2023-12-10 22:36:22'),
('d4df06fa-caca-4253-b99c-7e65aca78f6b', NULL, '333b8050-63a2-4258-85e4-389ec5794abd', 'organizacion 2', '2', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-12-29 19:44:29', '2023-12-29 19:46:46'),
('dff794b2-60e2-4592-b5a7-f16f698a0559', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', NULL, 'asesora2', '2', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-10-11 14:55:50', '2023-12-02 03:14:22'),
('e880cdea-53cc-4d8d-bd1f-bd59083705cd', NULL, NULL, 'jefatura2', '2', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-10-20 17:51:50', '2023-12-02 03:11:18'),
('f8a3c559-bd41-4cc4-b428-821d009b00af', NULL, NULL, 'gabinete2', '2', 'cuyevil1@gmail.com', '965414134', NULL, NULL, '2023-10-20 17:51:22', '2023-12-02 03:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

DROP TABLE IF EXISTS `periods`;
CREATE TABLE IF NOT EXISTS `periods` (
  `id` char(36) NOT NULL,
  `name` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `name`, `active`, `created`, `modified`) VALUES
('426ab6fd-bd71-472c-be83-be02650ca79c', 2024, 1, '2023-08-30 01:39:41', '2023-08-30 01:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `person_charges`
--

DROP TABLE IF EXISTS `person_charges`;
CREATE TABLE IF NOT EXISTS `person_charges` (
  `id` char(36) NOT NULL,
  `charge_id` char(36) NOT NULL,
  `person_id` char(36) NOT NULL,
  `default` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_charges_has_people_people1_idx` (`person_id`),
  KEY `fk_charges_has_people_charges1_idx` (`charge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_charges`
--

INSERT INTO `person_charges` (`id`, `charge_id`, `person_id`, `default`, `created`, `modified`) VALUES
('1c211b9e-1a8a-48a0-9c08-6cf4a2720176', '2a0d54a7-f814-4e3f-a02a-ddf3092b43e3', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 1, NULL, NULL),
('1d510f30-6ced-4452-8eeb-32b8930e82b1', '041c3795-11b6-414d-a3ec-ce3c410f490c', 'dff794b2-60e2-4592-b5a7-f16f698a0559', 1, NULL, NULL),
('1e5a2480-1a88-4f47-b034-6af9d8b9bb3a', '509dec7b-3c44-4e8d-9bbc-ae1320372b11', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 1, NULL, NULL),
('371939f4-f1d7-4484-a61e-135c3dfec764', '1a6bbf77-f500-44be-b5e5-b28d86443d7f', '8d975715-6ec8-4a33-ab48-a4be30401aab', 1, NULL, NULL),
('38121327-fee6-4554-ae70-1ecd7a65d9ec', '8a375439-f7eb-44eb-879e-fc7d6d7895cd', '8edd4b9b-8b1e-4688-8d51-b1b15571f7fd', 1, NULL, NULL),
('413ec37f-d745-4659-88b4-29804fcf68a4', 'fe923c1a-4014-4b9f-8fed-32df50be52cb', '15907f0d-e3df-420e-9090-9e964a6cc4a4', 1, NULL, NULL),
('4320de1e-4d3d-4c41-914e-d14f15820bb4', '85f82b26-109e-444b-8739-e675636bdd82', 'c3438fe0-aab2-431f-baa8-3964feafbae2', 1, NULL, NULL),
('46c6541a-ffd5-4ac6-bad9-09b1ab7a21ad', '8a375439-f7eb-44eb-879e-fc7d6d7895cd', 'd4df06fa-caca-4253-b99c-7e65aca78f6b', 1, NULL, NULL),
('64e2c871-8f0f-4625-a54a-12714566f63b', '8a375439-f7eb-44eb-879e-fc7d6d7895cd', '7dc6c48b-5507-49c0-9758-70b2eadbd669', 1, NULL, NULL),
('692c2ba5-d258-4b48-93d8-0e296efec858', '1a6bbf77-f500-44be-b5e5-b28d86443d7f', 'c20fd500-b083-4ff0-b415-9d63fefcc5cc', 0, NULL, NULL),
('6c48ca0b-e552-4d21-89dc-5e07fd526c3c', '1a6bbf77-f500-44be-b5e5-b28d86443d7f', 'f8a3c559-bd41-4cc4-b428-821d009b00af', 1, NULL, NULL),
('6d1ce8ac-7b64-404f-8884-60c22861b01b', 'abc3b974-007e-414c-a835-d81304c8f710', '687f88b2-32e0-4c6e-9d89-eda84aa85b3f', 1, NULL, NULL),
('7c8c038a-6bf0-46dd-8a64-7cc486cce407', '8a375439-f7eb-44eb-879e-fc7d6d7895cd', 'b2a17b23-4329-404e-81a3-dda82fffeb66', 1, NULL, NULL),
('9d1a3676-db3d-4d12-99de-d6cdbd3931b2', '509dec7b-3c44-4e8d-9bbc-ae1320372b11', 'c20fd500-b083-4ff0-b415-9d63fefcc5cc', 1, NULL, NULL),
('b25cf9f4-08ec-4b9b-9de2-40c9c217ea2d', 'c2e456b7-215e-4d20-94f3-f877f4f4a50b', '13e806c9-12c5-4398-aa61-08c866d85075', 1, NULL, NULL),
('b384ace3-a199-4220-8045-9e3da5ff9a90', '2a0d54a7-f814-4e3f-a02a-ddf3092b43e3', '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', 1, NULL, NULL),
('b585a180-1f96-451b-94c8-81f54f76a84f', 'cff60054-4592-4f14-bcfc-b3ea0094e91d', 'bf227a31-43c2-4636-93c1-ed50ae18140d', 1, NULL, NULL),
('b7ef127e-7b13-46a7-a919-c2de19ef5d0f', '041c3795-11b6-414d-a3ec-ce3c410f490c', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 1, NULL, NULL),
('ce56a8a3-122d-4a03-8c9c-14da9f6e8378', '1a6bbf77-f500-44be-b5e5-b28d86443d7f', '96661e52-6288-4cb2-8384-425c7093e28d', 1, NULL, NULL),
('d621795e-af06-4a20-a8aa-c6dca7c0a22c', '2a0d54a7-f814-4e3f-a02a-ddf3092b43e3', '6bc7162d-6899-454b-98ed-07b7032c701e', 0, NULL, NULL),
('dd283d55-16d1-4137-aa41-4c9fefa25e3b', '509dec7b-3c44-4e8d-9bbc-ae1320372b11', '6bc7162d-6899-454b-98ed-07b7032c701e', 1, NULL, NULL),
('f50edbaa-3fd8-453b-bab4-287635286079', '041c3795-11b6-414d-a3ec-ce3c410f490c', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `person_ministries`
--

DROP TABLE IF EXISTS `person_ministries`;
CREATE TABLE IF NOT EXISTS `person_ministries` (
  `id` char(36) NOT NULL,
  `person_id` char(36) NOT NULL,
  `ministry_id` char(36) NOT NULL,
  `default` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_people_has_ministries_ministries1_idx` (`ministry_id`),
  KEY `fk_people_has_ministries_people1_idx` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_ministries`
--

INSERT INTO `person_ministries` (`id`, `person_id`, `ministry_id`, `default`, `created`, `modified`) VALUES
('00c6543e-cd9a-475c-8d13-b10756e8087c', '6bc7162d-6899-454b-98ed-07b7032c701e', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('0dd2398e-c38e-4d4b-bd5d-2b638ad95a60', 'b2a17b23-4329-404e-81a3-dda82fffeb66', '70a41546-4009-4d8c-ab72-04275fe72a97', 1, NULL, NULL),
('0eda9698-664e-4c24-8c66-612f7e39841a', '8edd4b9b-8b1e-4688-8d51-b1b15571f7fd', '70a41546-4009-4d8c-ab72-04275fe72a97', 1, NULL, NULL),
('14b46edc-b078-4de8-8eef-ed85fa8e2f1d', 'bf227a31-43c2-4636-93c1-ed50ae18140d', '812e3cf3-c50a-4006-998f-7870d43a2920', 0, NULL, NULL),
('29fd1ac0-1073-4c7c-ab13-d2ff599ccdad', 'bf227a31-43c2-4636-93c1-ed50ae18140d', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('2cfe73ab-935a-48cb-8e08-18b939aa58e0', '13e806c9-12c5-4398-aa61-08c866d85075', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('372a6f0a-ef90-4f72-8448-f2af4f9eb154', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', '812e3cf3-c50a-4006-998f-7870d43a2920', 0, NULL, NULL),
('3f8b2baf-6107-4a50-b0ba-fbcd3d94fb90', 'c3438fe0-aab2-431f-baa8-3964feafbae2', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('4222626a-d3b9-4459-9a3d-3866fae78e16', '15907f0d-e3df-420e-9090-9e964a6cc4a4', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('50d06555-e7ce-4402-987b-d52c29454ad5', '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', '812e3cf3-c50a-4006-998f-7870d43a2920', 1, NULL, NULL),
('6dd4a9b6-faf6-4334-962c-beaf9e23278f', '7dc6c48b-5507-49c0-9758-70b2eadbd669', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('6e5fbecf-57dd-4d6c-9c3b-f85579cd9748', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('80c7f3d5-8141-47ce-9594-8ac700a3c816', 'dff794b2-60e2-4592-b5a7-f16f698a0559', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('8ebac3a8-b704-4862-a44d-f7594ce55ed5', 'c20fd500-b083-4ff0-b415-9d63fefcc5cc', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', 1, NULL, NULL),
('9b33f9d3-8354-4d4e-9c9c-1e8d1d8c78bd', '687f88b2-32e0-4c6e-9d89-eda84aa85b3f', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('a740bb27-8bd7-4214-b2f9-eb6a03f4d658', 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', 1, NULL, NULL),
('aae7ac47-f3b6-4343-8536-68d585261188', '8d975715-6ec8-4a33-ab48-a4be30401aab', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('b1693df5-ae99-40ba-8ebb-6c4116caa0c7', '96661e52-6288-4cb2-8384-425c7093e28d', '812e3cf3-c50a-4006-998f-7870d43a2920', 1, NULL, NULL),
('b3eb2487-3f50-4f45-8633-377787929c4f', 'f8a3c559-bd41-4cc4-b428-821d009b00af', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', 1, NULL, NULL),
('b9878b01-27ee-4fef-982f-2906673c5925', 'd4df06fa-caca-4253-b99c-7e65aca78f6b', '63f2a1db-6c91-43bb-8cce-0a3c3fd738ab', 1, NULL, NULL),
('be303752-216f-4760-8f01-a192144f0ee2', 'c3438fe0-aab2-431f-baa8-3964feafbae2', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', 0, NULL, NULL),
('c8cd9e1b-7926-40e2-a059-83a78041e76d', '11fbc4a2-b460-4549-93fb-2f24d76e75fa', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', 0, NULL, NULL),
('e774a8d3-82c8-4118-b4e1-0bcb91492392', 'c3438fe0-aab2-431f-baa8-3964feafbae2', '812e3cf3-c50a-4006-998f-7870d43a2920', 0, NULL, NULL),
('eecca802-a275-4373-9c8e-ceae501ac02f', '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', '7fa8a593-dc4f-4080-9320-ba1ee4edd364', 1, NULL, NULL),
('f1804f06-aedc-4d71-aba4-2326b5c996c5', '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', '812e3cf3-c50a-4006-998f-7870d43a2920', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

DROP TABLE IF EXISTS `question_types`;
CREATE TABLE IF NOT EXISTS `question_types` (
  `id` char(36) NOT NULL,
  `name` varchar(45) NOT NULL,
  `limit` int(11) NOT NULL,
  `options` text,
  `required` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`id`, `name`, `limit`, `options`, `required`, `created`, `modified`) VALUES
('120e4f94-9986-4246-ba9b-a51e5a0b4239', 'option 2', 0, 'GestiÃ³n pÃºblica\r\nDisponibilidad Presupuestaria\r\nGobernanza Interna de GÃ©nero\r\nRegistros Administrativos\r\nLegislaciÃ³n y/o Normativa\r\nCoordinaciÃ³n PÃºblico/Privada\r\nCapacitaciÃ³n\r\nOtra\r\nNo Aplica', 1, '2023-09-29 00:08:59', '2023-09-29 00:08:59'),
('21ad8b73-b0e4-11ee-9054-00090ffe0001', 'date', 0, NULL, 1, NULL, NULL),
('2384dc97-758b-46c0-b1dc-afa312cd4d25', 'textarea 3', 500, '', 1, '2023-10-19 20:42:06', '2023-10-19 20:42:06'),
('276b9d80-a68f-43ed-b64f-4e2b620a2ed3', 'Adjunto', 200, NULL, 0, '2023-08-22 14:43:17', '2023-08-30 19:18:29'),
('29eac2c2-6784-48e9-ae6a-5fbb30fba588', 'option 3', 0, 'Si\r\nNo', 1, '2023-09-29 00:15:57', '2023-09-29 00:15:57'),
('2f839d3e-329a-4adf-812e-850baf90bd6a', 'textarea', 3000, '', 1, '2023-08-22 14:42:16', '2023-09-10 02:50:55'),
('405eceda-3eec-4c98-81bf-6ae21a5d948e', 'option 5', 0, 'Si\r\nNo\r\nNo Aplica', 1, '2023-11-15 02:03:59', '2023-11-15 02:12:18'),
('5134558a-bfa6-4c10-a090-6279b7d15334', 'textarea 4', 1000, '', 1, '2023-11-15 02:08:39', '2023-11-15 02:08:39'),
('55e68658-73d1-45a1-b7f0-6b064b3b02d5', 'option 4', 0, 'Pueblos Originarios\r\nRurales\r\nLGBTIQA+\r\nMigrantes\r\nOtros', 1, '2023-11-15 01:59:57', '2023-11-15 02:12:36'),
('757f130c-ff98-477b-b6ad-7cb1a3dbc47b', 'textarea 5', 100, '', 0, '2023-11-20 19:47:08', '2023-11-20 19:47:08'),
('82775101-ed13-4e93-aea6-b0bd0fae9f58', 'option', 0, 'No iniciado\r\nEn implementaciÃ³n\r\nTerminado', 1, '2023-09-08 17:57:22', '2023-09-29 00:06:00'),
('886f652c-be17-4119-ac73-972d37d4e519', 'textarea 2', 1500, '', 1, '2023-09-29 00:11:03', '2023-09-29 00:11:49'),
('96e2714c-9980-4e12-9d54-79183524c246', 'option 8', 0, 'Presencial/Online', 1, '2024-01-12 01:02:37', '2024-01-12 01:02:37'),
('af4e68f3-2ccd-43d5-95e8-cba74824963d', 'number', 33, '', 1, '2023-08-22 14:42:10', '2023-11-16 02:51:57'),
('cbf1222d-9a28-4da9-90f0-948301e87368', 'option 7', 0, 'GrÃ¡fico:estado de metas.\r\nGrÃ¡fico: % de avance por meta que compone el derecho. \r\nGrÃ¡fico de participaciÃ³n ciudadana.\r\nEtiqueta: Cantidad de Mujeres impactadas.\r\nGrÃ¡fico % de de los grupos impactados.', 1, '2023-12-07 19:40:01', '2023-12-17 02:07:59'),
('d1374de7-07c8-4bde-bd7b-5fa147b49174', 'option 6', 0, 'Informativo\r\nConsultivo\r\nDecisorio\r\nCogestiÃ³n', 1, '2023-11-15 02:05:59', '2023-11-15 02:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `person_id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `first` tinyint(4) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_groups1_idx` (`group_id`),
  KEY `fk_users_people1_idx1` (`person_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `person_id`, `username`, `password`, `first`, `created`, `modified`) VALUES
(8, 4, '6bc7162d-6899-454b-98ed-07b7032c701e', 'jefe_superior', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-09-11 02:07:44', '2023-10-10 15:56:12'),
(7, 3, '8d975715-6ec8-4a33-ab48-a4be30401aab', 'gabinete', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-09-11 02:07:20', '2023-10-10 15:53:35'),
(6, 2, '42ec4e61-5fdf-4347-b4fc-b2f7ddcff4e5', 'asesora', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-09-11 02:07:04', '2023-09-11 02:07:04'),
(9, 5, '11fbc4a2-b460-4549-93fb-2f24d76e75fa', 'sectorialista', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-09-11 02:08:02', '2023-09-11 02:08:02'),
(10, 1, '15907f0d-e3df-420e-9090-9e964a6cc4a4', 'administrador', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-09-11 02:26:42', '2023-09-11 02:26:42'),
(11, 2, 'dff794b2-60e2-4592-b5a7-f16f698a0559', 'asesora2', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-10-11 14:56:08', '2023-10-11 14:56:08'),
(12, 3, 'f8a3c559-bd41-4cc4-b428-821d009b00af', 'gabinete2', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-10-20 17:53:46', '2023-10-20 17:53:46'),
(13, 4, 'e880cdea-53cc-4d8d-bd1f-bd59083705cd', 'jefatura2', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-10-20 17:54:08', '2023-10-20 17:54:08'),
(14, 2, '0d4139ad-f6ee-44c8-8f8f-d7f8d0937b7e', 'asesora3', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-10-20 17:54:24', '2023-10-20 17:54:24'),
(15, 3, '96661e52-6288-4cb2-8384-425c7093e28d', 'gabinete3', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-10-20 17:54:38', '2023-10-20 17:54:38'),
(16, 4, '4b48c350-4f93-4864-8ac8-eb3d6e2eba53', 'jefatura3', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-10-20 17:55:03', '2023-10-20 17:55:03'),
(17, 5, 'bf227a31-43c2-4636-93c1-ed50ae18140d', 'sectorialista_lider', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-11-12 01:41:59', '2023-11-12 01:41:59'),
(18, 6, '13e806c9-12c5-4398-aa61-08c866d85075', 'secretaria_ejecutiva', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-11-16 13:33:21', '2023-11-16 13:33:21'),
(19, 7, '687f88b2-32e0-4c6e-9d89-eda84aa85b3f', 'digitadora', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-11-24 01:25:41', '2023-11-24 01:25:41'),
(20, 8, 'c3438fe0-aab2-431f-baa8-3964feafbae2', 'Jefa_secretaria', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-12-10 22:36:56', '2023-12-10 22:36:56'),
(21, 8, '7dc6c48b-5507-49c0-9758-70b2eadbd669', 'sociedad_civil', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-12-15 14:35:03', '2023-12-15 14:35:03'),
(22, 9, 'd4df06fa-caca-4253-b99c-7e65aca78f6b', 'organizacion2', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-12-29 19:44:57', '2023-12-29 19:45:55'),
(23, 8, '8edd4b9b-8b1e-4688-8d51-b1b15571f7fd', 'gonzalo', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2023-12-29 20:12:46', '2023-12-29 20:30:04'),
(24, 8, 'b2a17b23-4329-404e-81a3-dda82fffeb66', 'organizacioncamila', '8833ee6222fc2db5f8e1119892193327b8b8cec9', 1, '2024-01-02 14:15:34', '2024-01-02 14:15:34');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_evaluations1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `fk_approvals_approval_types1` FOREIGN KEY (`approval_type_id`) REFERENCES `approval_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_approvals_duty_ministries1` FOREIGN KEY (`duty_ministry_id`) REFERENCES `duty_ministries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_approvals_people1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `fk_attachments_attachment_types1` FOREIGN KEY (`attachment_type_id`) REFERENCES `attachment_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attachments_evaluation_duty_ministries1` FOREIGN KEY (`evaluation_duty_ministry_id`) REFERENCES `evaluation_duty_ministries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD CONSTRAINT `fk_dashboars_charges1` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `duties`
--
ALTER TABLE `duties`
  ADD CONSTRAINT `fk_duties_duties1` FOREIGN KEY (`parent_id`) REFERENCES `duties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_duties_duty_categories1` FOREIGN KEY (`duty_category_id`) REFERENCES `duty_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_duties_duty_types1` FOREIGN KEY (`duty_type_id`) REFERENCES `duty_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `duty_ministries`
--
ALTER TABLE `duty_ministries`
  ADD CONSTRAINT `fk_duties_has_ministries_duties1` FOREIGN KEY (`duty_id`) REFERENCES `duties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_duties_has_ministries_ministries1` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_duty_ministries_periods1` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `duty_organizations`
--
ALTER TABLE `duty_organizations`
  ADD CONSTRAINT `fk_duties_has_organizations_duties1` FOREIGN KEY (`duty_id`) REFERENCES `duties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_duties_has_organizations_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `fk_evaluations_evaluation_types1` FOREIGN KEY (`evaluation_type_id`) REFERENCES `evaluation_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evaluations_question_types1` FOREIGN KEY (`question_type_id`) REFERENCES `question_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `evaluation_duty_ministries`
--
ALTER TABLE `evaluation_duty_ministries`
  ADD CONSTRAINT `fk_evaluations_has_duty_ministries_duty_ministries1` FOREIGN KEY (`duty_ministry_id`) REFERENCES `duty_ministries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evaluations_has_duty_ministries_evaluations1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `fk_people_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_people_people1` FOREIGN KEY (`parent_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `person_charges`
--
ALTER TABLE `person_charges`
  ADD CONSTRAINT `fk_charges_has_people_charges1` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_charges_has_people_people1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `person_ministries`
--
ALTER TABLE `person_ministries`
  ADD CONSTRAINT `fk_people_has_ministries_ministries1` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_people_has_ministries_people1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
