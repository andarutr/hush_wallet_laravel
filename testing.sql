-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table hush_wallet.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table hush_wallet.goals
CREATE TABLE IF NOT EXISTS `goals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `is_checked` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goals_user_id_foreign` (`user_id`),
  CONSTRAINT `goals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.goals: ~1 rows (approximately)

-- Dumping structure for table hush_wallet.income
CREATE TABLE IF NOT EXISTS `income` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `wallet_id` bigint unsigned NOT NULL,
  `id_transaksi` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pendapatan` enum('freelance','bekerja','belum bekerja') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `tgl_income` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_user_id_foreign` (`user_id`),
  KEY `income_wallet_id_foreign` (`wallet_id`),
  CONSTRAINT `income_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `income_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.income: ~4 rows (approximately)
INSERT INTO `income` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pendapatan`, `nominal`, `catatan`, `tgl_income`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'ATI275443', 'bekerja', 3600000, 'Gaji', '2024-04-30', '2024-07-22 19:33:25', '2024-07-22 19:34:04');
INSERT INTO `income` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pendapatan`, `nominal`, `catatan`, `tgl_income`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 'ATI688315', 'bekerja', 3600000, 'Gaji', '2024-05-31', '2024-07-22 19:40:47', '2024-07-22 19:40:47');
INSERT INTO `income` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pendapatan`, `nominal`, `catatan`, `tgl_income`, `created_at`, `updated_at`) VALUES
	(3, 1, 1, 'ATI167816', 'bekerja', 3600000, 'Gaji', '2024-06-23', '2024-07-22 19:41:23', '2024-07-22 19:41:23');
INSERT INTO `income` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pendapatan`, `nominal`, `catatan`, `tgl_income`, `created_at`, `updated_at`) VALUES
	(4, 1, 1, 'ATI313236', 'bekerja', 3600000, 'Gaji', '2024-07-31', '2024-07-22 19:57:25', '2024-07-22 19:57:25');
INSERT INTO `income` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pendapatan`, `nominal`, `catatan`, `tgl_income`, `created_at`, `updated_at`) VALUES
	(5, 1, 1, 'ATI583543', 'freelance', 500000, 'Pembuatan Fitur Skripsian', '2024-06-19', '2024-07-22 23:00:37', '2024-07-22 23:00:37');

-- Dumping structure for table hush_wallet.master_bank
CREATE TABLE IF NOT EXISTS `master_bank` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.master_bank: ~6 rows (approximately)
INSERT INTO `master_bank` (`id`, `nama_bank`, `picture`, `created_at`, `updated_at`) VALUES
	(1, 'Bank BCA', '1720056227.png', '2024-07-03 18:23:47', '2024-07-03 18:23:47');
INSERT INTO `master_bank` (`id`, `nama_bank`, `picture`, `created_at`, `updated_at`) VALUES
	(2, 'Bank Mandiri', '1720060448.png', '2024-07-03 19:34:08', '2024-07-03 19:34:08');
INSERT INTO `master_bank` (`id`, `nama_bank`, `picture`, `created_at`, `updated_at`) VALUES
	(3, 'Bank BRI', '1720060701.png', '2024-07-03 19:38:21', '2024-07-03 19:38:21');
INSERT INTO `master_bank` (`id`, `nama_bank`, `picture`, `created_at`, `updated_at`) VALUES
	(4, 'Bank BNI', '1720060836.png', '2024-07-03 19:40:36', '2024-07-03 19:40:36');
INSERT INTO `master_bank` (`id`, `nama_bank`, `picture`, `created_at`, `updated_at`) VALUES
	(5, 'Bank Raya', '1720061326.png', '2024-07-03 19:48:46', '2024-07-03 19:48:46');
INSERT INTO `master_bank` (`id`, `nama_bank`, `picture`, `created_at`, `updated_at`) VALUES
	(6, 'Bank NEO', '1720847891.png', '2024-07-12 22:18:11', '2024-07-12 22:18:11');

-- Dumping structure for table hush_wallet.master_platform
CREATE TABLE IF NOT EXISTS `master_platform` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_platform` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.master_platform: ~6 rows (approximately)
INSERT INTO `master_platform` (`id`, `nama_platform`, `picture`, `created_at`, `updated_at`) VALUES
	(1, 'Nanovest', '1720499970.png', '2024-07-08 21:39:30', '2024-07-08 21:39:30');
INSERT INTO `master_platform` (`id`, `nama_platform`, `picture`, `created_at`, `updated_at`) VALUES
	(2, 'Ajaib', '1720515859.png', '2024-07-09 02:04:19', '2024-07-09 02:04:19');
INSERT INTO `master_platform` (`id`, `nama_platform`, `picture`, `created_at`, `updated_at`) VALUES
	(3, 'Stockbit', '1720515942.png', '2024-07-09 02:05:42', '2024-07-09 02:05:42');
INSERT INTO `master_platform` (`id`, `nama_platform`, `picture`, `created_at`, `updated_at`) VALUES
	(4, 'Pluang', '1720848654.png', '2024-07-12 22:30:54', '2024-07-12 22:30:54');
INSERT INTO `master_platform` (`id`, `nama_platform`, `picture`, `created_at`, `updated_at`) VALUES
	(5, 'TokoCrypto', '1720848823.png', '2024-07-12 22:33:43', '2024-07-12 22:33:43');
INSERT INTO `master_platform` (`id`, `nama_platform`, `picture`, `created_at`, `updated_at`) VALUES
	(6, 'Neo Bank', '1721701826.jpg', '2024-07-22 19:30:26', '2024-07-22 19:30:26');

-- Dumping structure for table hush_wallet.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(18, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(19, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(20, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(21, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(22, '2024_07_02_065750_create_wallets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(23, '2024_07_02_070226_create_savings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(24, '2024_07_02_070333_create_goals_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(25, '2024_07_02_070355_create_income_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(26, '2024_07_02_070400_create_outcome_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(28, '2024_07_03_014348_create_master_bank_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(29, '2024_07_09_041323_create_master_platform_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(30, '2024_07_20_135959_add_id_wallet_to_income_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(31, '2024_07_20_140030_add_id_wallet_to_outcome_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(32, '2024_07_21_060848_add_is_checked_to_goals_table', 6);

-- Dumping structure for table hush_wallet.outcome
CREATE TABLE IF NOT EXISTS `outcome` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `wallet_id` bigint unsigned NOT NULL,
  `id_transaksi` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pengeluaran` enum('keperluan sehari-hari','hutang','cicilan','keinginan','bulanan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL,
  `nominal` int NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outcome_user_id_foreign` (`user_id`),
  KEY `outcome_wallet_id_foreign` (`wallet_id`),
  CONSTRAINT `outcome_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `outcome_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.outcome: ~9 rows (approximately)
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'ATO569259', 'keinginan', '2024-07-01', 129900, 'Beli Mouse di Tokopedia', '2024-07-22 19:55:17', '2024-07-22 19:55:17');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 'ATO368633', 'keinginan', '2024-07-19', 170000, 'Beli Celana Kerja 2 di BKT', '2024-07-22 19:56:41', '2024-07-22 19:56:41');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(3, 1, 1, 'ATO133553', 'keinginan', '2024-07-12', 125000, 'Beli Kemeja Putih Buat Kerja Di BKT', '2024-07-22 19:59:57', '2024-07-22 19:59:57');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(4, 1, 1, 'ATO128234', 'keinginan', '2024-05-03', 169900, 'Beli Sepatu Aero Street di Shopee', '2024-07-22 20:07:58', '2024-07-22 20:07:58');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(5, 1, 1, 'ATO744432', 'keinginan', '2024-06-10', 5200000, 'Beli Laptop Baru di PGC (Urgent)', '2024-07-22 20:09:56', '2024-07-22 20:09:56');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(6, 1, 1, 'ATO670218', 'keinginan', '2024-05-05', 700000, 'Ganti Kacamata Baru (+kacamata Ibu)', '2024-07-22 20:13:01', '2024-07-22 20:13:01');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(7, 1, 1, 'ATO420765', 'bulanan', '2024-04-12', 1000000, 'Listrik, Air, Wifi', '2024-07-22 20:16:02', '2024-07-22 20:16:02');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(8, 1, 1, 'ATO158875', 'bulanan', '2024-05-12', 1000000, 'Listrik, Air, Wifi', '2024-07-22 20:19:03', '2024-07-22 20:19:03');
INSERT INTO `outcome` (`id`, `user_id`, `wallet_id`, `id_transaksi`, `jenis_pengeluaran`, `tgl`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(9, 1, 1, 'ATO307188', 'bulanan', '2024-07-12', 1000000, 'Listrik, Air, Wifi', '2024-07-22 20:25:24', '2024-07-22 20:25:24');

-- Dumping structure for table hush_wallet.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table hush_wallet.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table hush_wallet.savings
CREATE TABLE IF NOT EXISTS `savings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `id_transaksi` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_tabungan` enum('jangka panjang','jangka pendek') COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `savings_user_id_foreign` (`user_id`),
  CONSTRAINT `savings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.savings: ~4 rows (approximately)
INSERT INTO `savings` (`id`, `user_id`, `id_transaksi`, `jenis_tabungan`, `platform`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(1, 1, 'ATS15039', 'jangka pendek', 'Nanovest', 100000, 'Fix Bug skripsian', '2024-07-22 19:44:25', '2024-07-22 19:44:25');
INSERT INTO `savings` (`id`, `user_id`, `id_transaksi`, `jenis_tabungan`, `platform`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(2, 1, 'ATS515353', 'jangka pendek', 'Neo Bank', 1000000, 'Deposito', '2024-07-22 20:27:41', '2024-07-22 20:27:41');
INSERT INTO `savings` (`id`, `user_id`, `id_transaksi`, `jenis_tabungan`, `platform`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(3, 1, 'ATS145547', 'jangka pendek', 'Neo Bank', 2500000, 'Deposito', '2024-04-22 20:29:33', '2024-07-22 20:29:33');
INSERT INTO `savings` (`id`, `user_id`, `id_transaksi`, `jenis_tabungan`, `platform`, `nominal`, `catatan`, `created_at`, `updated_at`) VALUES
	(4, 1, 'ATS830261', 'jangka pendek', 'Neo Bank', 2500000, 'Deposito', '2024-05-22 20:30:06', '2024-07-22 20:30:06');

-- Dumping structure for table hush_wallet.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` enum('bekerja','belum bekerja') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `nama`, `email`, `pekerjaan`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Andaru Triadi', 'andarutr@gmail.com', 'bekerja', '$2a$12$r6ZxWL90wjWJ9FlWfqZe2.WYbY3th8spV6vSLdbYYK8KBjhYja4uO', 'n', NULL, '2024-07-02 02:20:36', '2024-07-21 19:23:32');
INSERT INTO `users` (`id`, `nama`, `email`, `pekerjaan`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'Admin', 'admin@hush.com', NULL, '$2a$12$r6ZxWL90wjWJ9FlWfqZe2.WYbY3th8spV6vSLdbYYK8KBjhYja4uO', 'y', NULL, '2024-07-02 17:59:22', '2024-07-02 17:59:22');

-- Dumping structure for table hush_wallet.wallets
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `bank` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekening` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hush_wallet.wallets: ~2 rows (approximately)
INSERT INTO `wallets` (`id`, `user_id`, `bank`, `rekening`, `saldo`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Bank Mandiri', '1660004586749', 5405200, '2024-07-22 19:25:44', '2024-07-22 23:00:37');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
