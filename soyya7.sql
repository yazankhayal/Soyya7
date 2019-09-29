-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 سبتمبر 2019 الساعة 22:10
-- إصدار الخادم: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soyya7`
--

-- --------------------------------------------------------

--
-- بنية الجدول `comment_page`
--

CREATE TABLE `comment_page` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `comment_page`
--

INSERT INTO `comment_page` (`id`, `name`, `post_id`, `user_id`, `approve`, `created_at`, `updated_at`) VALUES
(1, 'nixce', 4, 1, 1, '2019-09-01 15:45:15', '2019-09-04 17:38:32'),
(3, 'nifds', 4, 1, 1, '2019-09-01 15:47:29', '2019-09-04 17:40:35'),
(4, 'Nice', 2, 1, 1, '2019-09-02 19:17:16', '2019-09-04 17:40:37');

-- --------------------------------------------------------

--
-- بنية الجدول `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_it` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_char_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `three_char_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `countries`
--

INSERT INTO `countries` (`id`, `name`, `two_char_code`, `three_char_code`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', NULL, NULL),
(2, 'Aland Islands', 'AX', 'ALA', NULL, NULL),
(3, 'Albania', 'AL', 'ALB', NULL, NULL),
(4, 'Algeria', 'DZ', 'DZA', NULL, NULL),
(5, 'American Samoa', 'AS', 'ASM', NULL, NULL),
(6, 'Andorra', 'AD', 'AND', NULL, NULL),
(7, 'Angola', 'AO', 'AGO', NULL, NULL),
(8, 'Anguilla', 'AI', 'AIA', NULL, NULL),
(9, 'Antarctica', 'AQ', 'ATA', NULL, NULL),
(10, 'Antigua and Barbuda', 'AG', 'ATG', NULL, NULL),
(11, 'Argentina', 'AR', 'ARG', NULL, NULL),
(12, 'Armenia', 'AM', 'ARM', NULL, NULL),
(13, 'Aruba', 'AW', 'ABW', NULL, NULL),
(14, 'Australia', 'AU', 'AUS', NULL, NULL),
(15, 'Austria', 'AT', 'AUT', NULL, NULL),
(16, 'Azerbaijan', 'AZ', 'AZE', NULL, NULL),
(17, 'Bahamas', 'BS', 'BHS', NULL, NULL),
(18, 'Bahrain', 'BH', 'BHR', NULL, NULL),
(19, 'Bangladesh', 'BD', 'BGD', NULL, NULL),
(20, 'Barbados', 'BB', 'BRB', NULL, NULL),
(21, 'Belarus', 'BY', 'BLR', NULL, NULL),
(22, 'Belgium', 'BE', 'BEL', NULL, NULL),
(23, 'Belize', 'BZ', 'BLZ', NULL, NULL),
(24, 'Benin', 'BJ', 'BEN', NULL, NULL),
(25, 'Bermuda', 'BM', 'BMU', NULL, NULL),
(26, 'Bhutan', 'BT', 'BTN', NULL, NULL),
(27, 'Bolivia', 'BO', 'BOL', NULL, NULL),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', 'BIH', NULL, NULL),
(30, 'Botswana', 'BW', 'BWA', NULL, NULL),
(31, 'Bouvet Island', 'BV', 'BVT', NULL, NULL),
(32, 'Brazil', 'BR', 'BRA', NULL, NULL),
(33, 'British Indian Ocean Territory', 'IO', 'IOT', NULL, NULL),
(34, 'Brunei', 'BN', 'BRN', NULL, NULL),
(35, 'Bulgaria', 'BG', 'BGR', NULL, NULL),
(36, 'Burkina Faso', 'BF', 'BFA', NULL, NULL),
(37, 'Burundi', 'BI', 'BDI', NULL, NULL),
(38, 'Cambodia', 'KH', 'KHM', NULL, NULL),
(39, 'Cameroon', 'CM', 'CMR', NULL, NULL),
(40, 'Canada', 'CA', 'CAN', NULL, NULL),
(41, 'Cape Verde', 'CV', 'CPV', NULL, NULL),
(42, 'Cayman Islands', 'KY', 'CYM', NULL, NULL),
(43, 'Central African Republic', 'CF', 'CAF', NULL, NULL),
(44, 'Chad', 'TD', 'TCD', NULL, NULL),
(45, 'Chile', 'CL', 'CHL', NULL, NULL),
(46, 'China', 'CN', 'CHN', NULL, NULL),
(47, 'Christmas Island', 'CX', 'CXR', NULL, NULL),
(48, 'Cocos (Keeling) Islands', 'CC', 'CCK', NULL, NULL),
(49, 'Colombia', 'CO', 'COL', NULL, NULL),
(50, 'Comoros', 'KM', 'COM', NULL, NULL),
(51, 'Congo', 'CG', 'COG', NULL, NULL),
(52, 'Cook Islands', 'CK', 'COK', NULL, NULL),
(53, 'Costa Rica', 'CR', 'CRI', NULL, NULL),
(54, 'Ivory Coast', 'CI', 'CIV', NULL, NULL),
(55, 'Croatia', 'HR', 'HRV', NULL, NULL),
(56, 'Cuba', 'CU', 'CUB', NULL, NULL),
(57, 'Curacao', 'CW', 'CUW', NULL, NULL),
(58, 'Cyprus', 'CY', 'CYP', NULL, NULL),
(59, 'Czech Republic', 'CZ', 'CZE', NULL, NULL),
(60, 'Democratic Republic of the Congo', 'CD', 'COD', NULL, NULL),
(61, 'Denmark', 'DK', 'DNK', NULL, NULL),
(62, 'Djibouti', 'DJ', 'DJI', NULL, NULL),
(63, 'Dominica', 'DM', 'DMA', NULL, NULL),
(64, 'Dominican Republic', 'DO', 'DOM', NULL, NULL),
(65, 'Ecuador', 'EC', 'ECU', NULL, NULL),
(66, 'Egypt', 'EG', 'EGY', NULL, NULL),
(67, 'El Salvador', 'SV', 'SLV', NULL, NULL),
(68, 'Equatorial Guinea', 'GQ', 'GNQ', NULL, NULL),
(69, 'Eritrea', 'ER', 'ERI', NULL, NULL),
(70, 'Estonia', 'EE', 'EST', NULL, NULL),
(71, 'Ethiopia', 'ET', 'ETH', NULL, NULL),
(72, 'Falkland Islands (Malvinas)', 'FK', 'FLK', NULL, NULL),
(73, 'Faroe Islands', 'FO', 'FRO', NULL, NULL),
(74, 'Fiji', 'FJ', 'FJI', NULL, NULL),
(75, 'Finland', 'FI', 'FIN', NULL, NULL),
(76, 'France', 'FR', 'FRA', NULL, NULL),
(77, 'French Guiana', 'GF', 'GUF', NULL, NULL),
(78, 'French Polynesia', 'PF', 'PYF', NULL, NULL),
(79, 'French Southern Territories', 'TF', 'ATF', NULL, NULL),
(80, 'Gabon', 'GA', 'GAB', NULL, NULL),
(81, 'Gambia', 'GM', 'GMB', NULL, NULL),
(82, 'Georgia', 'GE', 'GEO', NULL, NULL),
(83, 'Germany', 'DE', 'DEU', NULL, NULL),
(84, 'Ghana', 'GH', 'GHA', NULL, NULL),
(85, 'Gibraltar', 'GI', 'GIB', NULL, NULL),
(86, 'Greece', 'GR', 'GRC', NULL, NULL),
(87, 'Greenland', 'GL', 'GRL', NULL, NULL),
(88, 'Grenada', 'GD', 'GRD', NULL, NULL),
(89, 'Guadaloupe', 'GP', 'GLP', NULL, NULL),
(90, 'Guam', 'GU', 'GUM', NULL, NULL),
(91, 'Guatemala', 'GT', 'GTM', NULL, NULL),
(92, 'Guernsey', 'GG', 'GGY', NULL, NULL),
(93, 'Guinea', 'GN', 'GIN', NULL, NULL),
(94, 'Guinea-Bissau', 'GW', 'GNB', NULL, NULL),
(95, 'Guyana', 'GY', 'GUY', NULL, NULL),
(96, 'Haiti', 'HT', 'HTI', NULL, NULL),
(97, 'Heard Island and McDonald Islands', 'HM', 'HMD', NULL, NULL),
(98, 'Honduras', 'HN', 'HND', NULL, NULL),
(99, 'Hong Kong', 'HK', 'HKG', NULL, NULL),
(100, 'Hungary', 'HU', 'HUN', NULL, NULL),
(101, 'Iceland', 'IS', 'ISL', NULL, NULL),
(102, 'India', 'IN', 'IND', NULL, NULL),
(103, 'Indonesia', 'ID', 'IDN', NULL, NULL),
(104, 'Iran', 'IR', 'IRN', NULL, NULL),
(105, 'Iraq', 'IQ', 'IRQ', NULL, NULL),
(106, 'Ireland', 'IE', 'IRL', NULL, NULL),
(107, 'Isle of Man', 'IM', 'IMN', NULL, NULL),
(108, 'Israel', 'IL', 'ISR', NULL, NULL),
(109, 'Italy', 'IT', 'ITA', NULL, NULL),
(110, 'Jamaica', 'JM', 'JAM', NULL, NULL),
(111, 'Japan', 'JP', 'JPN', NULL, NULL),
(112, 'Jersey', 'JE', 'JEY', NULL, NULL),
(113, 'Jordan', 'JO', 'JOR', NULL, NULL),
(114, 'Kazakhstan', 'KZ', 'KAZ', NULL, NULL),
(115, 'Kenya', 'KE', 'KEN', NULL, NULL),
(116, 'Kiribati', 'KI', 'KIR', NULL, NULL),
(117, 'Kosovo', 'XK', '---', NULL, NULL),
(118, 'Kuwait', 'KW', 'KWT', NULL, NULL),
(119, 'Kyrgyzstan', 'KG', 'KGZ', NULL, NULL),
(120, 'Laos', 'LA', 'LAO', NULL, NULL),
(121, 'Latvia', 'LV', 'LVA', NULL, NULL),
(122, 'Lebanon', 'LB', 'LBN', NULL, NULL),
(123, 'Lesotho', 'LS', 'LSO', NULL, NULL),
(124, 'Liberia', 'LR', 'LBR', NULL, NULL),
(125, 'Libya', 'LY', 'LBY', NULL, NULL),
(126, 'Liechtenstein', 'LI', 'LIE', NULL, NULL),
(127, 'Lithuania', 'LT', 'LTU', NULL, NULL),
(128, 'Luxembourg', 'LU', 'LUX', NULL, NULL),
(129, 'Macao', 'MO', 'MAC', NULL, NULL),
(130, 'Macedonia', 'MK', 'MKD', NULL, NULL),
(131, 'Madagascar', 'MG', 'MDG', NULL, NULL),
(132, 'Malawi', 'MW', 'MWI', NULL, NULL),
(133, 'Malaysia', 'MY', 'MYS', NULL, NULL),
(134, 'Maldives', 'MV', 'MDV', NULL, NULL),
(135, 'Mali', 'ML', 'MLI', NULL, NULL),
(136, 'Malta', 'MT', 'MLT', NULL, NULL),
(137, 'Marshall Islands', 'MH', 'MHL', NULL, NULL),
(138, 'Martinique', 'MQ', 'MTQ', NULL, NULL),
(139, 'Mauritania', 'MR', 'MRT', NULL, NULL),
(140, 'Mauritius', 'MU', 'MUS', NULL, NULL),
(141, 'Mayotte', 'YT', 'MYT', NULL, NULL),
(142, 'Mexico', 'MX', 'MEX', NULL, NULL),
(143, 'Micronesia', 'FM', 'FSM', NULL, NULL),
(144, 'Moldava', 'MD', 'MDA', NULL, NULL),
(145, 'Monaco', 'MC', 'MCO', NULL, NULL),
(146, 'Mongolia', 'MN', 'MNG', NULL, NULL),
(147, 'Montenegro', 'ME', 'MNE', NULL, NULL),
(148, 'Montserrat', 'MS', 'MSR', NULL, NULL),
(149, 'Morocco', 'MA', 'MAR', NULL, NULL),
(150, 'Mozambique', 'MZ', 'MOZ', NULL, NULL),
(151, 'Myanmar (Burma)', 'MM', 'MMR', NULL, NULL),
(152, 'Namibia', 'NA', 'NAM', NULL, NULL),
(153, 'Nauru', 'NR', 'NRU', NULL, NULL),
(154, 'Nepal', 'NP', 'NPL', NULL, NULL),
(155, 'Netherlands', 'NL', 'NLD', NULL, NULL),
(156, 'New Caledonia', 'NC', 'NCL', NULL, NULL),
(157, 'New Zealand', 'NZ', 'NZL', NULL, NULL),
(158, 'Nicaragua', 'NI', 'NIC', NULL, NULL),
(159, 'Niger', 'NE', 'NER', NULL, NULL),
(160, 'Nigeria', 'NG', 'NGA', NULL, NULL),
(161, 'Niue', 'NU', 'NIU', NULL, NULL),
(162, 'Norfolk Island', 'NF', 'NFK', NULL, NULL),
(163, 'North Korea', 'KP', 'PRK', NULL, NULL),
(164, 'Northern Mariana Islands', 'MP', 'MNP', NULL, NULL),
(165, 'Norway', 'NO', 'NOR', NULL, NULL),
(166, 'Oman', 'OM', 'OMN', NULL, NULL),
(167, 'Pakistan', 'PK', 'PAK', NULL, NULL),
(168, 'Palau', 'PW', 'PLW', NULL, NULL),
(169, 'Palestine', 'PS', 'PSE', NULL, NULL),
(170, 'Panama', 'PA', 'PAN', NULL, NULL),
(171, 'Papua New Guinea', 'PG', 'PNG', NULL, NULL),
(172, 'Paraguay', 'PY', 'PRY', NULL, NULL),
(173, 'Peru', 'PE', 'PER', NULL, NULL),
(174, 'Phillipines', 'PH', 'PHL', NULL, NULL),
(175, 'Pitcairn', 'PN', 'PCN', NULL, NULL),
(176, 'Poland', 'PL', 'POL', NULL, NULL),
(177, 'Portugal', 'PT', 'PRT', NULL, NULL),
(178, 'Puerto Rico', 'PR', 'PRI', NULL, NULL),
(179, 'Qatar', 'QA', 'QAT', NULL, NULL),
(180, 'Reunion', 'RE', 'REU', NULL, NULL),
(181, 'Romania', 'RO', 'ROU', NULL, NULL),
(182, 'Russia', 'RU', 'RUS', NULL, NULL),
(183, 'Rwanda', 'RW', 'RWA', NULL, NULL),
(184, 'Saint Barthelemy', 'BL', 'BLM', NULL, NULL),
(185, 'Saint Helena', 'SH', 'SHN', NULL, NULL),
(186, 'Saint Kitts and Nevis', 'KN', 'KNA', NULL, NULL),
(187, 'Saint Lucia', 'LC', 'LCA', NULL, NULL),
(188, 'Saint Martin', 'MF', 'MAF', NULL, NULL),
(189, 'Saint Pierre and Miquelon', 'PM', 'SPM', NULL, NULL),
(190, 'Saint Vincent and the Grenadines', 'VC', 'VCT', NULL, NULL),
(191, 'Samoa', 'WS', 'WSM', NULL, NULL),
(192, 'San Marino', 'SM', 'SMR', NULL, NULL),
(193, 'Sao Tome and Principe', 'ST', 'STP', NULL, NULL),
(194, 'Saudi Arabia', 'SA', 'SAU', NULL, NULL),
(195, 'Senegal', 'SN', 'SEN', NULL, NULL),
(196, 'Serbia', 'RS', 'SRB', NULL, NULL),
(197, 'Seychelles', 'SC', 'SYC', NULL, NULL),
(198, 'Sierra Leone', 'SL', 'SLE', NULL, NULL),
(199, 'Singapore', 'SG', 'SGP', NULL, NULL),
(200, 'Sint Maarten', 'SX', 'SXM', NULL, NULL),
(201, 'Slovakia', 'SK', 'SVK', NULL, NULL),
(202, 'Slovenia', 'SI', 'SVN', NULL, NULL),
(203, 'Solomon Islands', 'SB', 'SLB', NULL, NULL),
(204, 'Somalia', 'SO', 'SOM', NULL, NULL),
(205, 'South Africa', 'ZA', 'ZAF', NULL, NULL),
(206, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', NULL, NULL),
(207, 'South Korea', 'KR', 'KOR', NULL, NULL),
(208, 'South Sudan', 'SS', 'SSD', NULL, NULL),
(209, 'Spain', 'ES', 'ESP', NULL, NULL),
(210, 'Sri Lanka', 'LK', 'LKA', NULL, NULL),
(211, 'Sudan', 'SD', 'SDN', NULL, NULL),
(212, 'Suriname', 'SR', 'SUR', NULL, NULL),
(213, 'Svalbard and Jan Mayen', 'SJ', 'SJM', NULL, NULL),
(214, 'Swaziland', 'SZ', 'SWZ', NULL, NULL),
(215, 'Sweden', 'SE', 'SWE', NULL, NULL),
(216, 'Switzerland', 'CH', 'CHE', NULL, NULL),
(217, 'Syria', 'SY', 'SYR', NULL, NULL),
(218, 'Taiwan', 'TW', 'TWN', NULL, NULL),
(219, 'Tajikistan', 'TJ', 'TJK', NULL, NULL),
(220, 'Tanzania', 'TZ', 'TZA', NULL, NULL),
(221, 'Thailand', 'TH', 'THA', NULL, NULL),
(222, 'Timor-Leste (East Timor)', 'TL', 'TLS', NULL, NULL),
(223, 'Togo', 'TG', 'TGO', NULL, NULL),
(224, 'Tokelau', 'TK', 'TKL', NULL, NULL),
(225, 'Tonga', 'TO', 'TON', NULL, NULL),
(226, 'Trinidad and Tobago', 'TT', 'TTO', NULL, NULL),
(227, 'Tunisia', 'TN', 'TUN', NULL, NULL),
(228, 'Turkey', 'TR', 'TUR', NULL, NULL),
(229, 'Turkmenistan', 'TM', 'TKM', NULL, NULL),
(230, 'Turks and Caicos Islands', 'TC', 'TCA', NULL, NULL),
(231, 'Tuvalu', 'TV', 'TUV', NULL, NULL),
(232, 'Uganda', 'UG', 'UGA', NULL, NULL),
(233, 'Ukraine', 'UA', 'UKR', NULL, NULL),
(234, 'United Arab Emirates', 'AE', 'ARE', NULL, NULL),
(235, 'United Kingdom', 'GB', 'GBR', NULL, NULL),
(236, 'United States', 'US', 'USA', NULL, NULL),
(237, 'United States Minor Outlying Islands', 'UM', 'UMI', NULL, NULL),
(238, 'Uruguay', 'UY', 'URY', NULL, NULL),
(239, 'Uzbekistan', 'UZ', 'UZB', NULL, NULL),
(240, 'Vanuatu', 'VU', 'VUT', NULL, NULL),
(241, 'Vatican City', 'VA', 'VAT', NULL, NULL),
(242, 'Venezuela', 'VE', 'VEN', NULL, NULL),
(243, 'Vietnam', 'VN', 'VNM', NULL, NULL),
(244, 'Virgin Islands, British', 'VG', 'VGB', NULL, NULL),
(245, 'Virgin Islands, US', 'VI', 'VIR', NULL, NULL),
(246, 'Wallis and Futuna', 'WF', 'WLF', NULL, NULL),
(247, 'Western Sahara', 'EH', 'ESH', NULL, NULL),
(248, 'Yemen', 'YE', 'YEM', NULL, NULL),
(249, 'Zambia', 'ZM', 'ZMB', NULL, NULL),
(250, 'Zimbabwe', 'ZW', 'ZWE', NULL, NULL);

-- --------------------------------------------------------

--
-- بنية الجدول `eye_post`
--

CREATE TABLE `eye_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `eye_post`
--

INSERT INTO `eye_post` (`id`, `ip_user`, `post_id`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 16, '2019-09-03 04:48:50', '2019-09-03 04:48:50'),
(2, '127.0.0.1', 15, '2019-09-03 05:03:42', '2019-09-03 05:03:42'),
(3, '127.0.0.1', 10, '2019-09-03 05:10:04', '2019-09-03 05:10:04'),
(4, '127.0.0.1', 6, '2019-09-03 05:37:17', '2019-09-03 05:37:17'),
(5, '127.0.0.1', 4, '2019-09-03 05:37:37', '2019-09-03 05:37:37'),
(6, '127.0.0.1', 2, '2019-09-04 17:38:41', '2019-09-04 17:38:41'),
(7, '127.0.0.1', 1, '2019-09-04 19:19:58', '2019-09-04 19:19:58');

-- --------------------------------------------------------

--
-- بنية الجدول `like_post`
--

CREATE TABLE `like_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `like_post`
--

INSERT INTO `like_post` (`id`, `ip_user`, `post_id`, `created_at`, `updated_at`) VALUES
(3, '127.0.0.1', 7, '2019-09-03 05:00:02', '2019-09-03 05:00:02'),
(4, '127.0.0.1', 16, '2019-09-03 05:05:53', '2019-09-03 05:05:53');

-- --------------------------------------------------------

--
-- بنية الجدول `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `visitor_id` int(10) UNSIGNED NOT NULL,
  `resident_id` int(10) UNSIGNED NOT NULL,
  `travel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_it` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `message`
--

INSERT INTO `message` (`id`, `visitor_id`, `resident_id`, `travel_id`, `created_at`, `updated_at`, `message`, `read_it`) VALUES
(74, 1, 3, 1, '2019-09-04 18:39:49', '2019-09-04 18:39:51', 'hi', 1),
(75, 3, 1, 1, '2019-09-04 18:39:55', '2019-09-04 18:39:57', 'hi', 1),
(76, 1, 3, 1, '2019-09-04 18:40:09', '2019-09-04 19:09:40', 'do want to help me ? please', 1),
(77, 3, 1, 1, '2019-09-04 18:40:32', '2019-09-04 19:13:27', 'yes', 1),
(78, 1, 3, 1, '2019-09-04 18:40:46', '2019-09-07 15:57:29', 'ok i want to number to call you', 1),
(79, 3, 1, 1, '2019-09-04 18:40:56', '2019-09-04 19:15:37', 'ok my number is 00559966225', 1),
(80, 1, 3, 1, '2019-09-04 18:41:04', '2019-09-07 15:57:30', 'and your email pl', 1),
(81, 3, 1, 1, '2019-09-04 18:41:08', '2019-09-04 19:13:31', 'ok', 1),
(82, 3, 1, 1, '2019-09-04 18:41:11', '2019-09-04 19:15:54', 'das@d.com', 1),
(83, 3, 1, 1, '2019-09-04 18:41:19', '2019-09-04 19:16:01', 'dsads@f.com', 1),
(84, 3, 1, 1, '2019-09-04 18:42:45', '2019-09-04 19:16:11', 'hi', 1),
(85, 1, 3, 1, '2019-09-04 18:42:50', '2019-09-07 15:57:30', 'ok', 1),
(86, 3, 1, 1, '2019-09-04 18:42:56', '2019-09-04 19:18:11', 'how ar d', 1),
(87, 1, 3, 1, '2019-09-04 18:43:00', '2019-09-07 15:57:32', 'dsadsa', 1),
(88, 3, 1, 1, '2019-09-04 18:43:05', '2019-09-04 19:18:45', 'dsadsa', 1),
(89, 1, 3, 1, '2019-09-04 18:43:09', '2019-09-07 15:57:33', 'dsadsa', 1),
(90, 3, 1, 1, '2019-09-04 18:43:14', '2019-09-04 19:18:51', 'dsa', 1),
(91, 1, 3, 1, '2019-09-04 18:43:19', '2019-09-07 15:57:34', 'dsa', 1),
(92, 1, 3, 1, '2019-09-04 18:43:20', '2019-09-07 15:57:35', 'dsa', 1),
(93, 1, 3, 1, '2019-09-04 18:43:30', '2019-09-07 15:57:50', 'zxczxcxzcxz', 1),
(94, 1, 3, 1, '2019-09-04 18:43:31', '2019-09-07 15:57:50', 'zxczxcxzcxz', 1),
(95, 1, 3, 1, '2019-09-04 19:09:23', '2019-09-07 15:57:51', 'g', 1),
(96, 3, 1, 1, '2019-09-04 19:09:45', '2019-09-04 19:19:12', 'das', 1),
(97, 3, 1, 1, '2019-09-04 19:09:51', '2019-09-04 19:19:07', 'das', 1),
(98, 1, 3, 1, '2019-09-04 19:09:57', '2019-09-07 15:57:52', 'dsa', 1),
(99, 1, 3, 1, '2019-09-04 19:10:05', '2019-09-07 15:57:52', 'dsa', 1),
(100, 3, 1, 1, '2019-09-04 19:10:12', '2019-09-04 19:19:13', 'dsadsa', 1),
(101, 3, 1, 1, '2019-09-04 19:10:19', '2019-09-04 19:19:13', 'dsa', 1),
(102, 3, 1, 1, '2019-09-04 19:10:27', '2019-09-04 19:19:15', 'dsa', 1),
(103, 1, 3, 1, '2019-09-04 19:10:34', '2019-09-07 15:57:54', 'cxzczxcxz', 1),
(104, 3, 1, 1, '2019-09-04 19:10:58', '2019-09-04 19:19:15', 'cxzdsa', 1),
(105, 1, 3, 1, '2019-09-04 19:11:05', '2019-09-07 15:57:54', 'x', 1),
(106, 3, 1, 1, '2019-09-04 19:11:09', '2019-09-07 15:47:12', 'xx', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_31_184530_create_countries_table', 1),
(4, '2019_08_31_185223_create_travel_table', 1),
(5, '2019_08_31_185554_create_message_table', 1),
(6, '2019_08_31_213350_create_post_table', 1),
(7, '2019_09_01_180253_create_comment_page_table', 1),
(8, '2019_09_01_180604_update_usere_table', 1),
(9, '2019_09_01_181149_create_setting_table', 1),
(10, '2019_09_01_181612_create_travel_gallery_table', 1),
(11, '2019_09_01_181703_create_contact_us_table', 1),
(12, '2019_09_02_224315_create_newslatter_table', 2),
(13, '2019_09_02_224907_create_partner_table', 3),
(14, '2019_09_03_074248_create_eye_post_table', 4),
(15, '2019_09_03_075113_create_like_post_table', 5),
(16, '2019_09_03_213714_create_resident_choice_travel_table', 6),
(17, '2019_09_03_213812_create_resident_star_travel_table', 6),
(18, '2019_09_07_181013_create_tourism__companies_table', 7),
(19, '2019_09_07_181135_create_tourism__companies_gallery_table', 7);

-- --------------------------------------------------------

--
-- بنية الجدول `newslatter`
--

CREATE TABLE `newslatter` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `newslatter`
--

INSERT INTO `newslatter` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'yazan.khayal@gmail.com', '2019-09-02 19:48:16', '2019-09-02 19:48:16');

-- --------------------------------------------------------

--
-- بنية الجدول `partner`
--

CREATE TABLE `partner` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'partner/no.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `partner`
--

INSERT INTO `partner` (`id`, `name`, `avatar`, `created_at`, `updated_at`, `link`) VALUES
(1, 'One', 'Partner/1567465394.png', '2019-09-02 20:03:14', '2019-09-02 20:03:14', '#dsadsa'),
(2, 'Two', 'Partner/1567465410.png', '2019-09-02 20:03:30', '2019-09-02 20:03:30', 'https://www.instagram.com/'),
(3, 'RRR', 'Partner/1567465424.png', '2019-09-02 20:03:44', '2019-09-02 20:03:44', 'https://www.facebook.com/'),
(4, 'Quality Management', 'Partner/1567465433.png', '2019-09-02 20:03:53', '2019-09-02 20:03:53', 'https://www.instagram.com/'),
(5, 'SSS', 'Partner/1567465443.png', '2019-09-02 20:04:03', '2019-09-02 20:04:03', 'https://www.instagram.com/'),
(6, 'Run', 'Partner/1567465452.png', '2019-09-02 20:04:12', '2019-09-02 20:04:12', 'https://www.facebook.com/');

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('yazan.khayal@gmail.com', '$2y$10$XfKI4wEUIRY7bLuAv6BO9uSTMc5JR5RZIgSgwH8.0cNYyU2GqgQe.', '2019-09-03 04:23:20');

-- --------------------------------------------------------

--
-- بنية الجدول `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar/no.png',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `post`
--

INSERT INTO `post` (`id`, `name`, `description`, `slug`, `body`, `type`, `avatar`, `user_id`, `created_at`, `updated_at`, `tags`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567362822.jpg', 1, '2019-09-01 15:33:42', '2019-09-02 16:12:08', 'post,tags,blog,php,laravel'),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567362830.jpg', 1, '2019-09-01 15:33:50', '2019-09-02 16:12:15', 'post,tags,blog,php,laravel'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567362837.jpg', 1, '2019-09-01 15:33:57', '2019-09-02 16:12:19', 'post,tags,blog,php,laravel'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567362845.jpg', 1, '2019-09-01 15:34:05', '2019-09-02 16:12:23', 'post,tags,blog,php,laravel'),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452073.jpg', 1, '2019-09-01 15:33:42', '2019-09-02 16:21:13', 'post,tags,blog,php,laravel'),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452092.jpg', 1, '2019-09-01 15:33:50', '2019-09-02 16:21:32', 'post,tags,blog,php,laravel'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452098.jpg', 1, '2019-09-01 15:33:57', '2019-09-02 16:21:38', 'post,tags,blog,php,laravel'),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452104.jpg', 1, '2019-09-01 15:34:05', '2019-09-02 16:21:44', 'post,tags,blog,php,laravel'),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452110.jpg', 1, '2019-09-01 15:33:42', '2019-09-02 16:21:50', 'post,tags,blog,php,laravel'),
(10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452116.jpg', 1, '2019-09-01 15:33:50', '2019-09-02 16:21:56', 'post,tags,blog,php,laravel'),
(11, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452128.jpg', 1, '2019-09-01 15:33:57', '2019-09-02 16:22:08', 'post,tags,blog,php,laravel'),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452132.jpg', 1, '2019-09-01 15:34:05', '2019-09-02 16:22:12', 'post,tags,blog,php,laravel'),
(13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452137.jpg', 1, '2019-09-01 15:33:42', '2019-09-02 16:22:17', 'post,tags,blog,php,laravel'),
(14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452143.jpg', 1, '2019-09-01 15:33:50', '2019-09-02 16:22:23', 'post,tags,blog,php,laravel'),
(15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452148.jpg', 1, '2019-09-01 15:33:57', '2019-09-02 16:22:28', 'post,tags,blog,php,laravel'),
(16, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'blog', 'Post/1567452153.jpg', 1, '2019-09-01 15:34:05', '2019-09-02 16:22:33', 'post,tags,blog,php,laravel'),
(17, 'About Us', 'About us', 'about-us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit', 'page', 'Post/1567462333.jpg', 1, '2019-09-02 19:12:13', '2019-09-02 19:12:13', 'abuout'),
(18, 'Privacy page', 'Privacy page', 'privacy-page', '<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div>', 'page', 'Post/1567462763.png', 1, '2019-09-02 19:19:23', '2019-09-02 19:19:23', 'Privacy,page'),
(19, 'Policy of use', 'Policy of use', 'policy-of-use', '<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br style=\"margin: 0px; padding: 0px; clear: both; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: center;\"><div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Where does it come from?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div>', 'page', 'Post/1567462848.png', 1, '2019-09-02 19:20:48', '2019-09-02 19:20:48', 'Policy,use');

-- --------------------------------------------------------

--
-- بنية الجدول `resident_choice_travel`
--

CREATE TABLE `resident_choice_travel` (
  `id` int(10) UNSIGNED NOT NULL,
  `visitor_id` int(10) UNSIGNED NOT NULL,
  `resident_id` int(10) UNSIGNED NOT NULL,
  `statues` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `finish` int(22) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `resident_choice_travel`
--

INSERT INTO `resident_choice_travel` (`id`, `visitor_id`, `resident_id`, `statues`, `created_at`, `updated_at`, `finish`) VALUES
(4, 1, 3, 3, '2019-09-03 19:28:12', '2019-09-03 20:01:47', 1),
(6, 1, 3, 3, '2019-09-03 20:03:36', '2019-09-03 20:10:27', 1),
(8, 1, 3, 3, '2019-09-04 04:52:29', '2019-09-04 05:13:09', 1),
(13, 1, 3, 3, '2019-09-04 05:22:26', '2019-09-04 05:23:39', 1),
(14, 1, 3, 3, '2019-09-04 05:23:59', '2019-09-04 05:24:45', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `resident_star_travel`
--

CREATE TABLE `resident_star_travel` (
  `id` int(10) UNSIGNED NOT NULL,
  `visitor_id` int(10) UNSIGNED NOT NULL,
  `resident_id` int(10) UNSIGNED NOT NULL,
  `star` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `resident_star_travel`
--

INSERT INTO `resident_star_travel` (`id`, `visitor_id`, `resident_id`, `star`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 5, 'Thanks is aoswme!♥', '2019-09-03 20:02:02', '2019-09-03 20:02:02'),
(4, 1, 3, 5, 'Yazan Khayal', '2019-09-03 20:10:52', '2019-09-03 20:10:52'),
(5, 1, 3, 5, 'Gaza', '2019-09-04 05:13:14', '2019-09-04 05:13:14'),
(6, 1, 3, 4, 'Gaza', '2019-09-04 05:23:45', '2019-09-04 05:23:45'),
(7, 1, 3, 5, 'Gaza', '2019-09-04 05:24:49', '2019-09-04 05:24:49');

-- --------------------------------------------------------

--
-- بنية الجدول `setting`
--

CREATE TABLE `setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo/no.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `setting`
--

INSERT INTO `setting` (`id`, `email`, `name`, `description`, `phone`, `location`, `logo`, `created_at`, `updated_at`, `script`) VALUES
(1, 'Soyya7@gmail.com', 'Soyya7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.', '599327008', 'Palestine gaza', 'setting/1567886912.png', '2019-09-02 17:21:11', '2019-09-07 17:08:32', '<!--Start of Tawk.to Script-->\r\n<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5cfeca74b534676f32ae40a0/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>\r\n<!--End of Tawk.to Script-->');

-- --------------------------------------------------------

--
-- بنية الجدول `tourism_companies`
--

CREATE TABLE `tourism_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tourism_companies_avatar/no.png',
  `user_id` int(10) UNSIGNED NOT NULL,
  `countries_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tourism_companies`
--

INSERT INTO `tourism_companies` (`id`, `name`, `description`, `slug`, `log`, `lat`, `body`, `avatar`, `user_id`, `countries_id`, `created_at`, `updated_at`, `email`, `phone`) VALUES
(1, 'Jordan Toursim', 'Jordan Toursim', 'jordan-toursim', '36.219864', '31.08881', '<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">hat is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><p><br style=\"margin: 0px; padding: 0px; clear: both; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: center;\"></p><div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Where does it come from?</h2></div>', 'TourismCompanies/1567880885.jpg', 1, 113, '2019-09-07 15:25:43', '2019-09-07 15:28:05', 'yazan.khayal@gmail.com', '123456789012'),
(2, 'Gaza Toursim', 'Gaza Toursim', 'gaza-toursim', '34.438325', '31.508029', '<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">hat is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><p><br style=\"margin: 0px; padding: 0px; clear: both; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: center;\"></p><div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Where does it come from?</h2></div>', 'TourismCompanies/1567880781.jpg', 1, 169, '2019-09-07 15:26:21', '2019-09-07 15:26:21', 'yazan.khayal@gmail.com', '123456789012'),
(3, 'Egypt Toursim', 'Egypt Toursim', 'egypt-toursim', '30.687046', '29.783002', '<div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">hat is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div style=\"margin: 0px 28.7969px 0px 14.3906px; padding: 0px; width: 436.797px; float: right; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Why do we use it?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><p><br style=\"margin: 0px; padding: 0px; clear: both; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: center;\"></p><div style=\"margin: 0px 14.3906px 0px 28.7969px; padding: 0px; width: 436.797px; float: left; font-family: &quot;Open Sans&quot;, Arial, sans-serif;\"><h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; line-height: 24px; font-family: DauphinPlain; font-size: 24px;\">Where does it come from?</h2></div>', 'TourismCompanies/1567880917.jpg', 1, 66, '2019-09-07 15:26:41', '2019-09-07 15:28:37', 'yazan.khayal@gmail.com', '123456789012');

-- --------------------------------------------------------

--
-- بنية الجدول `tourism_companies_gallery`
--

CREATE TABLE `tourism_companies_gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tourism_companies_gallery/no.png',
  `tourism_companies_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tourism_companies_gallery`
--

INSERT INTO `tourism_companies_gallery` (`id`, `name`, `tourism_companies_id`, `created_at`, `updated_at`) VALUES
(1, '1567880926255190801124057-nicolas-pepe-exlarge-169.jpg', 1, '2019-09-07 15:28:46', '2019-09-07 15:28:46'),
(2, '1567880926257190809110048-alex-iwobi-exlarge-169.jpg', 1, '2019-09-07 15:28:46', '2019-09-07 15:28:46'),
(3, '1567880926259andreescu_1280.jpg', 1, '2019-09-07 15:28:46', '2019-09-07 15:28:46'),
(4, '15678809378461556648879.jpg', 2, '2019-09-07 15:28:58', '2019-09-07 15:28:58'),
(5, '1567880937847app-privacy-policies-bed-microphone-blunder-sleep-number.jpg', 2, '2019-09-07 15:28:58', '2019-09-07 15:28:58'),
(6, '1567880937848Best of Fails Cars on Roads.PNG', 2, '2019-09-07 15:28:58', '2019-09-07 15:28:58'),
(7, '1567880946869BEST OF MOTORCYCLE MIRROR SMASHING 2019.PNG', 3, '2019-09-07 15:29:07', '2019-09-07 15:29:07'),
(8, '1567880946870photo-1515678916313-2263ebfad5cb.jpg', 3, '2019-09-07 15:29:07', '2019-09-07 15:29:07'),
(9, '1567880946872victor-rodriguez-726159-unsplash.jpg', 3, '2019-09-07 15:29:07', '2019-09-07 15:29:07');

-- --------------------------------------------------------

--
-- بنية الجدول `travel`
--

CREATE TABLE `travel` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar/no.png',
  `user_id` int(10) UNSIGNED NOT NULL,
  `countries_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `travel`
--

INSERT INTO `travel` (`id`, `name`, `description`, `slug`, `log`, `lat`, `avatar`, `user_id`, `countries_id`, `created_at`, `updated_at`, `body`) VALUES
(1, 'Gaza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'gaza', '34.471321', '31.501507', 'travel/1567364870.jpg', 1, 169, '2019-09-01 16:07:50', '2019-09-02 15:59:23', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit<br></p>'),
(2, 'Alexandria', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'alexandria', '29.75312', '30.79757', 'travel/1567376439.jpg', 1, 66, '2019-09-01 19:20:39', '2019-09-02 15:59:38', 'Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit'),
(3, 'Amman jordan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'amman-jordan', '35.594261', '32.16658', 'travel/1567376586.jpg', 1, 113, '2019-09-01 19:23:06', '2019-09-02 15:59:53', 'Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit'),
(4, 'Naser city', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'naser-city', '31.66468', '30.13213', 'travel/1567376640.jpg', 1, 66, '2019-09-01 19:24:00', '2019-09-02 15:59:57', 'Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit'),
(5, 'West bank', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'west-bank', '34.811615', '31.182882', 'travel/1567376684.jpg', 1, 169, '2019-09-01 19:24:44', '2019-09-02 15:59:50', 'Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit');

-- --------------------------------------------------------

--
-- بنية الجدول `travel_gallery`
--

CREATE TABLE `travel_gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'travel_gallery/no.png',
  `travel_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `travel_gallery`
--

INSERT INTO `travel_gallery` (`id`, `name`, `travel_id`, `created_at`, `updated_at`) VALUES
(7, '1567459738172g1.jpg', 1, '2019-09-02 18:28:58', '2019-09-02 18:28:58'),
(8, '1567459738174g2.jpg', 1, '2019-09-02 18:28:58', '2019-09-02 18:28:58'),
(9, '1567459738175g3.jpg', 1, '2019-09-02 18:28:58', '2019-09-02 18:28:58'),
(13, '1567460177022alx1.jpg', 2, '2019-09-02 18:36:17', '2019-09-02 18:36:17'),
(14, '1567460177025alx2.jpg', 2, '2019-09-02 18:36:17', '2019-09-02 18:36:17'),
(15, '1567460177027alx3.jpg', 2, '2019-09-02 18:36:17', '2019-09-02 18:36:17'),
(17, '1567460356635am1.jpg', 3, '2019-09-02 18:39:16', '2019-09-02 18:39:16'),
(18, '1567460356637am2.jpg', 3, '2019-09-02 18:39:16', '2019-09-02 18:39:16'),
(19, '1567460356639am3.jpg', 3, '2019-09-02 18:39:17', '2019-09-02 18:39:17'),
(28, '1567460718946nm1.jpg', 4, '2019-09-02 18:45:19', '2019-09-02 18:45:19'),
(29, '1567460718944n2.jpg', 4, '2019-09-02 18:45:19', '2019-09-02 18:45:19'),
(30, '1567460718947nm2.jpg', 4, '2019-09-02 18:45:19', '2019-09-02 18:45:19'),
(31, '1567460765235d2.jpg', 5, '2019-09-02 18:46:05', '2019-09-02 18:46:05'),
(32, '1567460765236d3.jpg', 5, '2019-09-02 18:46:05', '2019-09-02 18:46:05'),
(33, '1567460765237w1.jpg', 5, '2019-09-02 18:46:05', '2019-09-02 18:46:05');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar/no.png',
  `code_active` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '3',
  `role` int(11) NOT NULL DEFAULT '3',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `countries_id` int(10) UNSIGNED NOT NULL,
  `other_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `avatar`, `code_active`, `type`, `role`, `active`, `remember_token`, `created_at`, `updated_at`, `countries_id`, `other_id`, `type_login`) VALUES
(1, 'Admin', 'admin@gmail.com', '123456789012', '$2y$10$Tvs97ckPzvSNfW98Mcnm.eWNUxJdBujw6piMMzC5t9j3fj79xdP2K', 'avatar/1567468012.jpg', '', 3, 1, 1, '52YGFvrHBIAqfjKJkrJFoQRZ3qgCQOYgiYqgcc0XuwDlu3AiaaU4LFIy41oP', '2019-09-01 15:28:21', '2019-09-07 16:58:58', 169, '0', ''),
(2, 'Vistor', 'vis@g.com', '123426789012', '$2y$10$9gj4Ei0pSRTbkqVrO9vViufXVQdwCzkJp0ynDQs84OtuYipJqPgCW', 'avatar/1567454738.jpg', 'cb98a430-cce6-11e9-a5d8-73ef1ec07ae4', 3, 2, 1, 'MddWqHdUjgmXbNzxqCux14wT94WWj0ydncYmkBBG1KgffQR9HfW4Y4qjV63F', '2019-09-01 15:32:04', '2019-09-02 17:05:38', 169, '0', ''),
(3, 'Mega Cars Pro', 'ainstagram803@gmail.com', '123456788012', '$2y$10$0vvcIK6j2riFhJEHj3CxluJw4WsPMYsq4AvEdKBi0.ixArb8mg35K', 'avatar/1567366190.jpg', '', 3, 2, 1, 'NXnCrNUnjMK42oKIZMo4OSoBVzmDsJfWT0Tooba4wxdGoIzFEMLoJT75sBQU', '2019-09-01 16:29:50', '2019-09-01 16:29:52', 169, '0', ''),
(4, 'vistor', 'vistore_Gaza@gmail.com', '123456719012', '$2y$10$EyXLpaQodhczbN5wPPwLFemiflyp4sdqxyVquhKTHyagkN56BBWba', 'avatar/1567499745.jpg', '4a26a450-ce25-11e9-8635-130b8539765b', 3, 3, 1, '8M28vSdme0r2uff9ir68hU1eh7po7GNf4rUVUiVfY1V840yCAuSv878uqc5A', '2019-09-03 05:31:56', '2019-09-03 05:35:45', 169, '0', ''),
(5, 'test', 'test@gmail.com', '123456789055', '$2y$10$VGiUVMcE7CtO/SINIXefN.IHcEbkhco1xaIkusPDNT02y5qhwP5aS', 'avatar/no.png', '397f1d10-d199-11e9-b8fd-67d88e921e77', 3, 3, 1, NULL, '2019-09-07 14:59:23', '2019-09-07 15:30:37', 169, '0', ''),
(6, 'stripe yazan', 'yazan.stripe@gmail.com', '123456789012', '$2y$10$Q6j/1a7s/vL4g1fuVuaNGugJHqLFwXjjmO16bD2f/4RPcNr2QYuIi', 'https://lh3.googleusercontent.com/-qYzx44Rnj7c/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcBQdNVCy6zC8I7NvCSulbwxjhDNA/photo.jpg', '', 3, 2, 1, 'vNooXraG8vKsiFsOJ9NVMU9jJpkBLjKtsDFPEvXNsjEKmo27P1RorjgVD1Um', '2019-09-07 16:33:16', '2019-09-07 16:41:38', 1, '117074610565920284950', 'google'),
(7, 'YaZan M Khayal', 'yazan.khayal@gmail.com', '123456789012', '$2y$10$EgCQc3CihrOgluEh51S4DeXt2Co5Dk8XFbZPH3nSzjJJoyfxy1fR.', 'https://graph.facebook.com/v3.0/10210856991180380/picture?type=normal', '', 3, 2, 1, 'kzheJjU9yrqYCtkRc7SjNcciVS0sBjU9klk85cL10pd4DoT2MXkgX2dxEcOp', '2019-09-07 16:59:23', '2019-09-07 16:59:55', 1, '10210856991180380', 'facebook');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_page`
--
ALTER TABLE `comment_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_page_post_id_index` (`post_id`),
  ADD KEY `comment_page_user_id_index` (`user_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eye_post`
--
ALTER TABLE `eye_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eye_post_post_id_index` (`post_id`);

--
-- Indexes for table `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_post_post_id_index` (`post_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_visitor_id_index` (`visitor_id`),
  ADD KEY `message_resident_id_index` (`resident_id`),
  ADD KEY `message_travel_id_index` (`travel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newslatter`
--
ALTER TABLE `newslatter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newslatter_email_unique` (`email`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_id_index` (`user_id`);

--
-- Indexes for table `resident_choice_travel`
--
ALTER TABLE `resident_choice_travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_choice_travel_visitor_id_index` (`visitor_id`),
  ADD KEY `resident_choice_travel_resident_id_index` (`resident_id`);

--
-- Indexes for table `resident_star_travel`
--
ALTER TABLE `resident_star_travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_star_travel_visitor_id_index` (`visitor_id`),
  ADD KEY `resident_star_travel_resident_id_index` (`resident_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourism_companies`
--
ALTER TABLE `tourism_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourism_companies_user_id_index` (`user_id`),
  ADD KEY `tourism_companies_countries_id_index` (`countries_id`);

--
-- Indexes for table `tourism_companies_gallery`
--
ALTER TABLE `tourism_companies_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tourism_companies_gallery_tourism_companies_id_index` (`tourism_companies_id`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_user_id_index` (`user_id`),
  ADD KEY `travel_countries_id_index` (`countries_id`);

--
-- Indexes for table `travel_gallery`
--
ALTER TABLE `travel_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_gallery_travel_id_index` (`travel_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_countries_id_index` (`countries_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_page`
--
ALTER TABLE `comment_page`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `eye_post`
--
ALTER TABLE `eye_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `like_post`
--
ALTER TABLE `like_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `newslatter`
--
ALTER TABLE `newslatter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `resident_choice_travel`
--
ALTER TABLE `resident_choice_travel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `resident_star_travel`
--
ALTER TABLE `resident_star_travel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tourism_companies`
--
ALTER TABLE `tourism_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tourism_companies_gallery`
--
ALTER TABLE `tourism_companies_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `travel_gallery`
--
ALTER TABLE `travel_gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `comment_page`
--
ALTER TABLE `comment_page`
  ADD CONSTRAINT `comment_page_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_page_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `eye_post`
--
ALTER TABLE `eye_post`
  ADD CONSTRAINT `eye_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- القيود للجدول `like_post`
--
ALTER TABLE `like_post`
  ADD CONSTRAINT `like_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- القيود للجدول `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_travel_id_foreign` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `resident_choice_travel`
--
ALTER TABLE `resident_choice_travel`
  ADD CONSTRAINT `resident_choice_travel_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resident_choice_travel_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `resident_star_travel`
--
ALTER TABLE `resident_star_travel`
  ADD CONSTRAINT `resident_star_travel_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resident_star_travel_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `tourism_companies`
--
ALTER TABLE `tourism_companies`
  ADD CONSTRAINT `tourism_companies_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `tourism_companies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `tourism_companies_gallery`
--
ALTER TABLE `tourism_companies_gallery`
  ADD CONSTRAINT `tourism_companies_gallery_tourism_companies_id_foreign` FOREIGN KEY (`tourism_companies_id`) REFERENCES `tourism_companies` (`id`);

--
-- القيود للجدول `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `travel_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `travel_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `travel_gallery`
--
ALTER TABLE `travel_gallery`
  ADD CONSTRAINT `travel_gallery_travel_id_foreign` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`);

--
-- القيود للجدول `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
