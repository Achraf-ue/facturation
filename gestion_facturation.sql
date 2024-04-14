-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 05 fév. 2024 à 21:15
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_facturation`
--

-- --------------------------------------------------------

--
-- Structure de la table `banques`
--

CREATE TABLE `banques` (
  `id` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `telephone` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `nCompte` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `banques`
--

INSERT INTO `banques` (`id`, `nom`, `adress`, `telephone`, `image`, `nCompte`, `created_at`, `updated_at`) VALUES
(1, 'BMCE', 'casa', '0522798556', 'Backend/banque/images/1789991576763734.jpeg', '5484545H4144440', '2024-02-04 17:49:53', '2024-02-04 17:49:53'),
(2, 'SGMB', 'TANGER', '0537895623', 'Backend/banque/images/1789991654416809.png', '4128H22425385', '2024-02-04 17:51:07', '2024-02-04 17:51:07');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `telephone` text DEFAULT NULL,
  `ICE` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `adress`, `telephone`, `ICE`, `created_at`, `updated_at`) VALUES
(1, 'ALPHA', 'FRANCE', '01445224245', '5252424242411', '2024-02-04 17:52:12', '2024-02-04 17:52:12'),
(2, 'adoha', 'casa', '0522789963', '45548485485485', '2024-02-04 19:57:10', '2024-02-04 19:57:10');

-- --------------------------------------------------------

--
-- Structure de la table `facture_echeances`
--

CREATE TABLE `facture_echeances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `nom_complet` varchar(255) NOT NULL,
  `n_facture` varchar(255) NOT NULL,
  `taxation` text DEFAULT NULL,
  `date_facture` date NOT NULL,
  `date_payement` datetime DEFAULT NULL,
  `mantant` int(11) NOT NULL,
  `facture_pdf` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `Payement` varchar(255) DEFAULT NULL,
  `Nemero_payement` varchar(255) DEFAULT NULL,
  `file_payement` varchar(255) DEFAULT NULL,
  `date_echeance` datetime DEFAULT NULL,
  `n_bon_commande` text DEFAULT NULL,
  `fichie_bon_commande` text DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `v_banque` int(11) DEFAULT 0,
  `banque` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture_echeances`
--

INSERT INTO `facture_echeances` (`id`, `type`, `nom_complet`, `n_facture`, `taxation`, `date_facture`, `date_payement`, `mantant`, `facture_pdf`, `status`, `Payement`, `Nemero_payement`, `file_payement`, `date_echeance`, `n_bon_commande`, `fichie_bon_commande`, `remarque`, `created_at`, `updated_at`, `v_banque`, `banque`) VALUES
(1, 'Client', 'ALPHA', '10223', 'exonore', '2024-02-05', '2024-02-05 20:43:26', 1000, 'Backend/Factures/Pdf/Facture-Client-ALPHA-aaa-2024-02-05.pdf', 'Payé', '0', '0', 'lien', '2024-02-29 00:00:00', 'aaa', 'Backend/bon_commande/Pdf/bon_command-Client-ALPHA-aaa-2024-02-05.pdf', '100dh', '2024-02-05 18:38:32', '2024-02-05 19:12:44', 1, NULL),
(2, 'Client', 'adoha', 'aaaaa-a', 'exonore', '2024-02-05', '2024-02-05 20:51:36', 1000, 'Backend/Factures/Pdf/Facture-Client-adoha-ccccccc-2024-02-05.pdf', 'Payé', 'Cheque', '202002', 'Backend/Factures/Pdf/mode_payment-Client-adoha-ccccccc-2024-02-05.pdf', '2024-02-29 00:00:00', 'ccccccc', 'Backend/bon_commande/Pdf/bon_command-Client-adoha-ccccccc-2024-02-05.pdf', '100dh', '2024-02-05 18:51:36', '2024-02-05 19:12:47', 1, 'BMCE');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fourniseurs`
--

CREATE TABLE `fourniseurs` (
  `id` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `telephone` text DEFAULT NULL,
  `ICE` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fourniseurs`
--

INSERT INTO `fourniseurs` (`id`, `nom`, `adress`, `telephone`, `ICE`, `created_at`, `updated_at`) VALUES
(1, 'ADALO', 'TURKY', '4550520520', '124205074575', '2024-02-04 17:52:53', '2024-02-04 17:52:53');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Notifiaction` varchar(255) NOT NULL,
  `Lire_notification` int(11) NOT NULL,
  `id_fature` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `Titre`, `Notifiaction`, `Lire_notification`, `id_fature`, `created_at`, `updated_at`) VALUES
(1, 'Facture de reference : 10223', 'Facture de type Client et le nom complet ALPHA et de mantant 1000 est de status en cours', 1, 1, '2024-02-05 18:38:32', '2024-02-05 18:41:27');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('E1zFB3WiiWAJpa5cjvJJYxCcfwKxYKc635IwhHiv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibGdtNGhKVVI0dHR5aG1vOFBFVkJTY1pIVnc5QzlSbzMzUEhNNGNpQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mYWN0dXJlX2VjaGVhbmNlcy92dWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJExKdWtZQ24yVTUucGI4ckFYZHBvYmVNQ3RjdzBtalFNS01XN21ESmFQZmF5bTlvZG1ES1dxIjt9', 1707163972),
('YZvSRnIYECa3W8nOPY1hY3PjfqnPHyA5Pv2cHo0r', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTlVlT09sQXJFdjVWZlFXd3U2OVl1eEJ3dWZmbmpTb1VMUlNtaUxZRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZmFjdHVyZV9lY2hlYW5jZXMvdnVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRMSnVrWUNuMlU1LnBiOHJBWGRwb2JlTUN0Y3cwbWpRTUtNVzdtREphUGZheW05b2RtREtXcSI7fQ==', 1707162728);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'firinfo', 'SHER@gmail.com', NULL, '$2y$10$LJukYCn2U5.pb8rAXdpobeMCtcw0mjQMKMW7mDJaPfaym9odmDKWq', NULL, NULL, NULL, '48HK30VxU0bsWEJiwQ5TZmPO1KQ6NVOaHZat8Pnlqzbxt0NrtJc9b2maTj7Y', NULL, NULL, '2022-09-13 20:40:08', '2022-09-13 20:40:08');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `banques`
--
ALTER TABLE `banques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facture_echeances`
--
ALTER TABLE `facture_echeances`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fourniseurs`
--
ALTER TABLE `fourniseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `banques`
--
ALTER TABLE `banques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `facture_echeances`
--
ALTER TABLE `facture_echeances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fourniseurs`
--
ALTER TABLE `fourniseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
