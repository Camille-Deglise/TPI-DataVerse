
-- Base de données : `dataverse`
--

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(163) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `locations`
--

INSERT INTO `locations` (`id`, `name`, `zipcode`, `created_at`, `updated_at`) VALUES
(1, 'Lausanne', '1004', '2024-05-23 08:05:05', NULL),
(2, 'Echallens', '1040', '2024-05-23 08:05:05', NULL),
(3, 'Bex', '1880', '2024-05-23 08:05:05', NULL),
(4, 'Lugano', '6900', '2024-05-23 08:05:05', NULL),
(5, 'Geneva', '1201', '2024-05-23 08:05:05', NULL),
(6, 'Zurich', '8001', '2024-05-23 08:05:05', NULL),
(7, 'Bern', '3001', '2024-05-23 08:05:05', NULL),
(8, 'Lucerne', '6003', '2024-05-23 08:05:05', NULL),
(9, 'Basel', '4001', '2024-05-23 08:05:05', NULL),
(10, 'St. Gallen', '9000', '2024-05-23 08:05:05', NULL),
(13, 'Aigle', '1860', '2024-05-28 12:09:22', '2024-05-28 12:09:22'),
(15, 'Gratin', '88100', '2024-06-03 07:22:58', '2024-06-03 07:22:58');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(46, '2014_10_12_000000_create_users_table', 1),
(47, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(48, '2019_08_19_000000_create_failed_jobs_table', 1),
(49, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(50, '2024_05_21_073031_create_weather_datas_table', 1),
(51, '2024_05_21_073043_create_locations_table', 1),
(52, '2024_05_21_080501_add_foreign_key_location_to_weather_datas_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('mumu@boss.ch', '$2y$12$3FqoUtDWlxZ5Qlr9DnI5NeT48j2JuX43sVohwLkAIAULOHkNlUIN.', '2024-05-31 06:57:54'),
('test0@tests.ch', '$2y$12$qD8Qx4Ou4axZzeGbPuwDFuRTDI3thkIM/M4E/WaJFQOD5jW3fljkq', '2024-05-30 11:13:21');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `lastname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_activ` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `email_verified_at`, `password`, `is_admin`, `is_activ`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Doe', 'John', 'john@doe.fr', '2024-05-28 11:57:35', '$2y$12$IR/G7nRdH4jZWXMu9mJBA.eVrIlyVCxc9cCAYY.3JOKiHBXzpkFr6', 0, 1, 'DOo5Ln9IDogxUwDsYKTfpHacJVTzpxEQZmUn6AdQkIuPK5QV46HpMrtpWxMh', '2024-05-28 11:57:24', '2024-06-03 09:49:23'),
(2, 'Admin', 'Admin', 'admin@admin.ch', '2024-05-29 06:39:50', '$2y$12$UCdz0zAwVUvQGQB3h5/.QuHGEMCV0.TNL3sbM7h4FW968frKePjmy', 1, 1, NULL, '2024-05-29 06:39:36', '2024-06-03 09:50:24'),
(3, 'Clyde', 'Bonnie', 'bonnie.clyde@tests.ch', '2024-05-30 09:49:22', '$2y$12$RD1V3Y5pS0nZRue46M66t.iyaK4EP3Lom.9eID4H.Bk4APB07bd6a', 0, 1, NULL, '2024-05-30 09:48:54', '2024-05-30 09:49:22'),
(4, 'test', 'test', 'test0@tests.ch', '2024-05-30 11:12:08', '$2y$12$zESEZLIyj6Dx1nEO5HRMhegQOhCYDNduZoGhllQx8RXJg1FXqjgk.', 0, 1, NULL, '2024-05-30 11:11:54', '2024-05-30 11:14:20'),
(5, 'dgfdgfdgs', 'dfgfdgfdg', 'mumu@boss.ch', NULL, '$2y$12$yr4JLNVY2wJdMyFoOOOdjOq2MSGGPhGdBlj8wDPhTg99wbXR0eXNS', 0, 1, NULL, '2024-05-31 06:53:29', '2024-05-31 06:53:29'),
(6, 'De Vaud', 'Aliça', 'al.frege@test.ch', NULL, '$2y$12$iSZEMOUxaHjtY29519.V8.yZFQ5Fg6uhgK7ovB3xBi7et/QcD9NEC', 0, 1, NULL, '2024-05-31 06:55:31', '2024-05-31 06:55:31'),
(7, 'De Vaud', 'Daisy', 'ddv@tests.ch', '2024-05-31 10:00:47', '$2y$12$VTOUC90DYerijx5NdbP10eDg/GBHP3Y4i80jgI0kLRudXa4Aw.TEW', 0, 0, 'MBnBLnR7XkcAuPxRMoQO4ef7rda3WectIBLOJ8o1y2N1eHEZQKjUvqI5EPLt', '2024-05-31 10:00:34', '2024-05-31 10:43:11'),
(8, 'Test', 'Final', 'final@test.ch', '2024-06-03 07:18:36', '$2y$12$SBbFzXTFf45HKIm8u0yT9udwC8x5uyy/9F1aqZUnO5rxaBAVM6ZLe', 0, 1, NULL, '2024-06-03 07:18:22', '2024-06-03 07:28:55');

-- --------------------------------------------------------

--
-- Structure de la table `weather_datas`
--

CREATE TABLE `weather_datas` (
  `id` bigint UNSIGNED NOT NULL,
  `precipitation` decimal(4,1) DEFAULT NULL,
  `sunshine` decimal(4,1) DEFAULT NULL,
  `snow` decimal(4,1) DEFAULT NULL,
  `temperature` decimal(4,1) DEFAULT NULL,
  `humidity` decimal(4,1) DEFAULT NULL,
  `wind` decimal(4,1) DEFAULT NULL,
  `statement_date` date NOT NULL,
  `imported_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `location_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `weather_datas`
--

INSERT INTO `weather_datas` (`id`, `precipitation`, `sunshine`, `snow`, `temperature`, `humidity`, `wind`, `statement_date`, `imported_at`, `created_at`, `updated_at`, `user_id`, `location_id`) VALUES
(1, '12.5', '4.5', '0.0', '15.0', '60.0', '20.0', '2023-01-01', '2024-05-23 10:40:00', NULL, NULL, 1, 1),
(2, '14.5', '5.5', '0.0', '16.0', '62.0', '21.0', '2022-02-01', '2024-05-23 10:41:00', NULL, NULL, 1, 1),
(3, '16.5', '6.5', '0.0', '17.0', '64.0', '22.0', '2021-03-01', '2024-05-23 10:42:00', NULL, NULL, 1, 1),
(4, '18.5', '7.5', '0.0', '18.0', '66.0', '23.0', '2020-04-01', '2024-05-23 10:43:00', NULL, NULL, 1, 1),
(5, '20.5', '8.5', '0.0', '19.0', '68.0', '24.0', '2019-05-01', '2024-05-23 10:44:00', NULL, NULL, 1, 1),
(6, '22.5', '9.5', '0.0', '20.0', '70.0', '25.0', '2018-06-01', '2024-05-23 10:45:00', NULL, NULL, 1, 1),
(7, '24.5', '10.5', '0.0', '21.0', '72.0', '26.0', '2017-07-01', '2024-05-23 10:46:00', NULL, NULL, 1, 1),
(8, '26.5', '11.5', '0.0', '22.0', '74.0', '27.0', '2016-08-01', '2024-05-23 10:47:00', NULL, NULL, 1, 1),
(9, '28.5', '12.5', '0.0', '23.0', '76.0', '28.0', '2015-09-01', '2024-05-23 10:48:00', NULL, NULL, 1, 1),
(10, '30.5', '13.5', '0.0', '24.0', '78.0', '29.0', '2014-10-01', '2024-05-23 10:49:00', NULL, NULL, 1, 1),
(11, '32.5', '14.5', '1.0', '25.0', '80.0', '30.0', '2013-11-01', '2024-05-23 10:50:00', NULL, NULL, 1, 2),
(12, '34.5', '15.5', '2.0', '26.0', '82.0', '31.0', '2012-12-01', '2024-05-23 10:51:00', NULL, NULL, 1, 2),
(13, '36.5', '16.5', '3.0', '27.0', '84.0', '32.0', '2011-01-01', '2024-05-23 10:52:00', NULL, NULL, 1, 2),
(14, '38.5', '17.5', '4.0', '28.0', '86.0', '33.0', '2010-02-01', '2024-05-23 10:53:00', NULL, NULL, 1, 2),
(15, '40.5', '18.5', '5.0', '29.0', '88.0', '34.0', '2009-03-01', '2024-05-23 10:54:00', NULL, NULL, 1, 2),
(16, '42.5', '19.5', '6.0', '30.0', '90.0', '35.0', '2008-04-01', '2024-05-23 10:55:00', NULL, NULL, 1, 2),
(17, '44.5', '20.5', '7.0', '31.0', '92.0', '36.0', '2007-05-01', '2024-05-23 10:56:00', NULL, NULL, 1, 2),
(18, '46.5', '21.5', '8.0', '32.0', '94.0', '37.0', '2006-06-01', '2024-05-23 10:57:00', NULL, NULL, 1, 2),
(19, '48.5', '22.5', '9.0', '33.0', '96.0', '38.0', '2005-07-01', '2024-05-23 10:58:00', NULL, NULL, 1, 2),
(20, '50.5', '23.5', '10.0', '34.0', '98.0', '39.0', '2004-08-01', '2024-05-23 10:59:00', NULL, NULL, 1, 2),
(21, '52.5', '24.5', '11.0', '35.0', '60.0', '40.0', '2023-02-01', '2024-05-23 11:00:00', NULL, NULL, 1, 3),
(22, '54.5', '25.5', '12.0', '36.0', '62.0', '41.0', '2022-03-01', '2024-05-23 11:01:00', NULL, NULL, 1, 3),
(23, '56.5', '26.5', '13.0', '37.0', '64.0', '42.0', '2021-04-01', '2024-05-23 11:02:00', NULL, NULL, 1, 3),
(24, '58.5', '27.5', '14.0', '38.0', '66.0', '43.0', '2020-05-01', '2024-05-23 11:03:00', NULL, NULL, 1, 3),
(25, '60.5', '28.5', '15.0', '39.0', '68.0', '44.0', '2019-06-01', '2024-05-23 11:04:00', NULL, NULL, 1, 3),
(26, '62.5', '29.5', '16.0', '40.0', '70.0', '45.0', '2018-07-01', '2024-05-23 11:05:00', NULL, NULL, 1, 3),
(27, '64.5', '30.5', '17.0', '41.0', '72.0', '46.0', '2017-08-01', '2024-05-23 11:06:00', NULL, NULL, 1, 3),
(28, '66.5', '31.5', '18.0', '42.0', '74.0', '47.0', '2016-09-01', '2024-05-23 11:07:00', NULL, NULL, 1, 3),
(29, '68.5', '32.5', '19.0', '43.0', '76.0', '48.0', '2015-10-01', '2024-05-23 11:08:00', NULL, NULL, 1, 3),
(30, '70.5', '33.5', '20.0', '44.0', '78.0', '49.0', '2014-11-01', '2024-05-23 11:09:00', NULL, NULL, 1, 3),
(31, '72.5', '34.5', '21.0', '45.0', '80.0', '50.0', '2013-12-01', '2024-05-23 11:10:00', NULL, NULL, 1, 4),
(32, '74.5', '35.5', '22.0', '46.0', '82.0', '51.0', '2012-01-01', '2024-05-23 11:11:00', NULL, NULL, 1, 4),
(33, '76.5', '36.5', '23.0', '47.0', '84.0', '52.0', '2011-02-01', '2024-05-23 11:12:00', NULL, NULL, 1, 4),
(34, '78.5', '37.5', '24.0', '48.0', '86.0', '53.0', '2010-03-01', '2024-05-23 11:13:00', NULL, NULL, 1, 4),
(35, '80.5', '38.5', '25.0', '49.0', '88.0', '54.0', '2009-04-01', '2024-05-23 11:14:00', NULL, NULL, 1, 4),
(36, '82.5', '39.5', '26.0', '50.0', '90.0', '55.0', '2008-05-01', '2024-05-23 11:15:00', NULL, NULL, 1, 4),
(37, '84.5', '40.5', '27.0', '51.0', '92.0', '56.0', '2007-06-01', '2024-05-23 11:16:00', NULL, NULL, 1, 4),
(38, '86.5', '41.5', '28.0', '52.0', '94.0', '57.0', '2006-07-01', '2024-05-23 11:17:00', NULL, NULL, 1, 4),
(39, '88.5', '42.5', '29.0', '53.0', '96.0', '58.0', '2005-08-01', '2024-05-23 11:18:00', NULL, NULL, 1, 4),
(40, '90.5', '43.5', '30.0', '54.0', '98.0', '59.0', '2004-09-01', '2024-05-23 11:19:00', NULL, NULL, 1, 4),
(41, '92.5', '44.5', '31.0', '55.0', '60.0', '60.0', '2023-03-01', '2024-05-23 11:20:00', NULL, NULL, 1, 5),
(42, '94.5', '45.5', '32.0', '56.0', '62.0', '61.0', '2022-04-01', '2024-05-23 11:21:00', NULL, NULL, 1, 5),
(43, '96.5', '46.5', '33.0', '57.0', '64.0', '62.0', '2021-05-01', '2024-05-23 11:22:00', NULL, NULL, 1, 5),
(44, '98.5', '47.5', '34.0', '58.0', '66.0', '63.0', '2020-06-01', '2024-05-23 11:23:00', NULL, NULL, 1, 5),
(45, '100.5', '48.5', '35.0', '59.0', '68.0', '64.0', '2019-07-01', '2024-05-23 11:24:00', NULL, NULL, 1, 5),
(46, '102.5', '49.5', '36.0', '60.0', '70.0', '65.0', '2018-08-01', '2024-05-23 11:25:00', NULL, NULL, 1, 5),
(47, '104.5', '50.5', '37.0', '61.0', '72.0', '66.0', '2017-09-01', '2024-05-23 11:26:00', NULL, NULL, 1, 5),
(48, '106.5', '51.5', '38.0', '62.0', '74.0', '67.0', '2016-10-01', '2024-05-23 11:27:00', NULL, NULL, 1, 5),
(49, '108.5', '52.5', '39.0', '63.0', '76.0', '68.0', '2015-11-01', '2024-05-23 11:28:00', NULL, NULL, 1, 5),
(50, '110.5', '53.5', '40.0', '64.0', '78.0', '69.0', '2014-12-01', '2024-05-23 11:29:00', NULL, NULL, 1, 5),
(51, '112.5', '54.5', '41.0', '65.0', '80.0', '70.0', '2013-01-01', '2024-05-23 11:30:00', NULL, NULL, 1, 6),
(52, '114.5', '55.5', '42.0', '66.0', '82.0', '71.0', '2012-02-01', '2024-05-23 11:31:00', NULL, NULL, 1, 6),
(53, '116.5', '56.5', '43.0', '67.0', '84.0', '72.0', '2011-03-01', '2024-05-23 11:32:00', NULL, NULL, 1, 6),
(54, '118.5', '57.5', '44.0', '68.0', '86.0', '73.0', '2010-04-01', '2024-05-23 11:33:00', NULL, NULL, 1, 6),
(55, '120.5', '58.5', '45.0', '69.0', '88.0', '74.0', '2009-05-01', '2024-05-23 11:34:00', NULL, NULL, 1, 6),
(56, '122.5', '59.5', '46.0', '70.0', '90.0', '75.0', '2008-06-01', '2024-05-23 11:35:00', NULL, NULL, 1, 6),
(57, '124.5', '60.5', '47.0', '71.0', '92.0', '76.0', '2007-07-01', '2024-05-23 11:36:00', NULL, NULL, 1, 6),
(58, '126.5', '61.5', '48.0', '72.0', '94.0', '77.0', '2006-08-01', '2024-05-23 11:37:00', NULL, NULL, 1, 6),
(59, '128.5', '62.5', '49.0', '73.0', '96.0', '78.0', '2005-09-01', '2024-05-23 11:38:00', NULL, NULL, 1, 6),
(60, '130.5', '63.5', '50.0', '74.0', '98.0', '79.0', '2004-10-01', '2024-05-23 11:39:00', NULL, NULL, 1, 6),
(61, '132.5', '64.5', '51.0', '75.0', '60.0', '80.0', '2023-04-01', '2024-05-23 11:40:00', NULL, NULL, 1, 7),
(62, '134.5', '65.5', '52.0', '76.0', '62.0', '81.0', '2022-05-01', '2024-05-23 11:41:00', NULL, NULL, 1, 7),
(63, '136.5', '66.5', '53.0', '77.0', '64.0', '82.0', '2021-06-01', '2024-05-23 11:42:00', NULL, NULL, 1, 7),
(64, '138.5', '67.5', '54.0', '78.0', '66.0', '83.0', '2020-07-01', '2024-05-23 11:43:00', NULL, NULL, 1, 7),
(65, '140.5', '68.5', '55.0', '79.0', '68.0', '84.0', '2019-08-01', '2024-05-23 11:44:00', NULL, NULL, 1, 7),
(66, '142.5', '69.5', '56.0', '80.0', '70.0', '85.0', '2018-09-01', '2024-05-23 11:45:00', NULL, NULL, 1, 7),
(67, '144.5', '70.5', '57.0', '81.0', '72.0', '86.0', '2017-10-01', '2024-05-23 11:46:00', NULL, NULL, 1, 7),
(68, '146.5', '71.5', '58.0', '82.0', '74.0', '87.0', '2016-11-01', '2024-05-23 11:47:00', NULL, NULL, 1, 7),
(69, '148.5', '72.5', '59.0', '83.0', '76.0', '88.0', '2015-12-01', '2024-05-23 11:48:00', NULL, NULL, 1, 7),
(70, '150.5', '73.5', '60.0', '84.0', '78.0', '89.0', '2014-01-01', '2024-05-23 11:49:00', NULL, NULL, 1, 7),
(71, '152.5', '74.5', '61.0', '85.0', '80.0', '90.0', '2013-02-01', '2024-05-23 11:50:00', NULL, NULL, 1, 8),
(72, '154.5', '75.5', '62.0', '86.0', '82.0', '91.0', '2012-03-01', '2024-05-23 11:51:00', NULL, NULL, 1, 8),
(73, '156.5', '76.5', '63.0', '87.0', '84.0', '92.0', '2011-04-01', '2024-05-23 11:52:00', NULL, NULL, 1, 8),
(74, '158.5', '77.5', '64.0', '88.0', '86.0', '93.0', '2010-05-01', '2024-05-23 11:53:00', NULL, NULL, 1, 8),
(75, '160.5', '78.5', '65.0', '89.0', '88.0', '94.0', '2009-06-01', '2024-05-23 11:54:00', NULL, NULL, 1, 8),
(76, '162.5', '79.5', '66.0', '90.0', '90.0', '95.0', '2008-07-01', '2024-05-23 11:55:00', NULL, NULL, 1, 8),
(77, '164.5', '80.5', '67.0', '91.0', '92.0', '96.0', '2007-08-01', '2024-05-23 11:56:00', NULL, NULL, 1, 8),
(78, '166.5', '81.5', '68.0', '92.0', '94.0', '97.0', '2006-09-01', '2024-05-23 11:57:00', NULL, NULL, 1, 8),
(79, '168.5', '82.5', '69.0', '93.0', '96.0', '98.0', '2005-10-01', '2024-05-23 11:58:00', NULL, NULL, 1, 8),
(80, '170.5', '83.5', '70.0', '94.0', '98.0', '99.0', '2004-11-01', '2024-05-23 11:59:00', NULL, NULL, 1, 8),
(81, '172.5', '84.5', '71.0', '95.0', '60.0', '100.0', '2023-05-01', '2024-05-23 12:00:00', NULL, NULL, 1, 9),
(82, '174.5', '85.5', '72.0', '96.0', '62.0', '101.0', '2022-06-01', '2024-05-23 12:01:00', NULL, NULL, 1, 9),
(83, '176.5', '86.5', '73.0', '97.0', '64.0', '102.0', '2021-07-01', '2024-05-23 12:02:00', NULL, NULL, 1, 9),
(84, '178.5', '87.5', '74.0', '98.0', '66.0', '103.0', '2020-08-01', '2024-05-23 12:03:00', NULL, NULL, 1, 9),
(85, '180.5', '88.5', '75.0', '99.0', '68.0', '104.0', '2019-09-01', '2024-05-23 12:04:00', NULL, NULL, 1, 9),
(86, '182.5', '89.5', '76.0', '100.0', '70.0', '105.0', '2018-10-01', '2024-05-23 12:05:00', NULL, NULL, 1, 9),
(87, '184.5', '90.5', '77.0', '101.0', '72.0', '106.0', '2017-11-01', '2024-05-23 12:06:00', NULL, NULL, 1, 9),
(88, '186.5', '91.5', '78.0', '102.0', '74.0', '107.0', '2016-12-01', '2024-05-23 12:07:00', NULL, NULL, 1, 9),
(89, '188.5', '92.5', '79.0', '103.0', '76.0', '108.0', '2015-01-01', '2024-05-23 12:08:00', NULL, NULL, 1, 9),
(90, '190.5', '93.5', '80.0', '104.0', '78.0', '109.0', '2014-02-01', '2024-05-23 12:09:00', NULL, NULL, 1, 9),
(91, '192.5', '94.5', '81.0', '105.0', '80.0', '110.0', '2013-03-01', '2024-05-23 12:10:00', NULL, NULL, 1, 10),
(92, '194.5', '95.5', '82.0', '106.0', '82.0', '111.0', '2012-04-01', '2024-05-23 12:11:00', NULL, NULL, 1, 10),
(93, '196.5', '96.5', '83.0', '107.0', '84.0', '112.0', '2011-05-01', '2024-05-23 12:12:00', NULL, NULL, 1, 10),
(94, '198.5', '97.5', '84.0', '108.0', '86.0', '113.0', '2010-06-01', '2024-05-23 12:13:00', NULL, NULL, 1, 10),
(95, '200.5', '98.5', '85.0', '109.0', '88.0', '114.0', '2009-07-01', '2024-05-23 12:14:00', NULL, NULL, 1, 10),
(96, '202.5', '99.5', '86.0', '110.0', '90.0', '115.0', '2008-08-01', '2024-05-23 12:15:00', NULL, NULL, 1, 10),
(97, '204.5', '100.5', '87.0', '111.0', '92.0', '116.0', '2007-09-01', '2024-05-23 12:16:00', NULL, NULL, 1, 10),
(98, '206.5', '101.5', '88.0', '112.0', '94.0', '117.0', '2006-10-01', '2024-05-23 12:17:00', NULL, NULL, 1, 10),
(99, '208.5', '102.5', '89.0', '113.0', '96.0', '118.0', '2005-11-01', '2024-05-23 12:18:00', NULL, NULL, 1, 10),
(100, '210.5', '103.5', '90.0', '114.0', '98.0', '119.0', '2004-12-01', '2024-05-23 12:19:00', NULL, NULL, 1, 10),
(101, '65.0', '60.0', '0.0', '18.5', '0.0', '15.6', '2024-05-28', '2024-05-28 12:09:22', '2024-05-28 12:09:22', '2024-05-28 12:09:22', 1, 13),
(102, '40.0', '120.0', '0.0', '22.5', '0.0', '24.0', '2024-04-28', '2024-05-28 12:09:22', '2024-05-28 12:09:22', '2024-05-28 12:09:22', 1, 13),
(103, '85.0', '43.0', '15.0', '14.9', '65.0', '10.2', '2024-03-28', '2024-05-28 12:09:22', '2024-05-28 12:09:22', '2024-05-28 12:09:22', 1, 13),
(104, '65.0', '60.0', '0.0', '18.5', '0.0', '15.6', '2024-05-28', '2024-05-28 12:10:24', '2024-05-28 12:10:24', '2024-05-28 12:10:24', 1, 6),
(105, '40.0', '120.0', '0.0', '22.5', '0.0', '24.0', '2024-04-28', '2024-05-28 12:10:24', '2024-05-28 12:10:24', '2024-05-28 12:10:24', 1, 6),
(106, '85.0', '43.0', '15.0', '14.9', '65.0', '10.2', '2024-03-28', '2024-05-28 12:10:24', '2024-05-28 12:10:24', '2024-05-28 12:10:24', 1, 6),
(110, '65.0', '60.0', '0.0', '18.5', '0.0', '15.6', '2024-05-28', '2024-05-28 13:15:46', '2024-05-28 13:15:46', '2024-05-28 13:15:46', 1, 2),
(111, '40.0', '120.0', '0.0', '22.5', '0.0', '24.0', '2024-04-28', '2024-05-28 13:15:46', '2024-05-28 13:15:46', '2024-05-28 13:15:46', 1, 2),
(112, '85.0', '43.0', '15.0', '14.9', '65.0', '10.2', '2024-03-28', '2024-05-28 13:15:46', '2024-05-28 13:15:46', '2024-05-28 13:15:46', 1, 2),
(113, '65.0', '60.0', '0.0', '18.5', '0.0', '15.6', '2024-05-28', '2024-05-28 13:16:52', '2024-05-28 13:16:52', '2024-05-28 13:16:52', 1, 5),
(114, '40.0', '120.0', '0.0', '22.5', '0.0', '24.0', '2024-04-28', '2024-05-28 13:16:52', '2024-05-28 13:16:52', '2024-05-28 13:16:52', 1, 5),
(115, '85.0', '43.0', '15.0', '14.9', '65.0', '10.2', '2024-03-28', '2024-05-28 13:16:52', '2024-05-28 13:16:52', '2024-05-28 13:16:52', 1, 5),
(116, '65.0', '60.0', '0.0', '18.5', '0.0', '15.6', '2024-05-28', '2024-06-03 07:21:12', '2024-06-03 07:21:12', '2024-06-03 07:21:12', 8, 1),
(117, '12.0', '120.0', '0.0', '22.5', '0.0', '24.0', '2024-04-28', '2024-06-03 07:21:12', '2024-06-03 07:21:12', '2024-06-03 07:21:12', 8, 1),
(118, '188.0', '43.0', '15.0', '14.9', '65.0', '10.2', '2024-03-28', '2024-06-03 07:21:12', '2024-06-03 07:21:12', '2024-06-03 07:21:12', 8, 1),
(119, '85.0', '60.0', '0.0', '18.5', '0.0', '15.6', '2024-05-28', '2024-06-03 07:22:58', '2024-06-03 07:22:58', '2024-06-03 07:22:58', 8, 15),
(120, '98.0', '120.0', '0.0', '22.5', '0.0', '24.0', '2024-04-28', '2024-06-03 07:22:59', '2024-06-03 07:22:59', '2024-06-03 07:22:59', 8, 15),
(121, '112.0', '43.0', '15.0', '14.9', '65.0', '10.2', '2024-03-28', '2024-06-03 07:22:59', '2024-06-03 07:22:59', '2024-06-03 07:22:59', 8, 15);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique-locations` (`name`,`zipcode`) USING BTREE;

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `weather_datas`
--
ALTER TABLE `weather_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weather_datas_user_id_foreign` (`user_id`),
  ADD KEY `weather_datas_location_id_foreign` (`location_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `weather_datas`
--
ALTER TABLE `weather_datas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `weather_datas`
--
ALTER TABLE `weather_datas`
  ADD CONSTRAINT `weather_datas_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `weather_datas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
