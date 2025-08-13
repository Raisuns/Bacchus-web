-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Agu 2025 pada 06.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bacchus_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `hours` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact_info`
--

INSERT INTO `contact_info` (`id`, `description`, `address`, `phone`, `hours`) VALUES
(1, 'Consectetur adipisicing elit sed eiusmod tempor incididunt ut dolore magna labore eiusmod. Lorem ipsum dolor sit amet consectetur est adipisicing elit, sed do eiusmod tempor.', 'New York, NY, United States', '+1 234-567-890', '9:00 am – 5:00 pm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Rais uno', 'unorais3@gmail.com', '+6285385269101', 'dummy text\r\n', '2025-08-11 08:26:35'),
(2, 'Rais uno', 'unorais3@gmail.com', '+6285385269101', 'dummy', '2025-08-11 08:28:24'),
(3, 'Rais uno', 'unorais3@gmail.com', '+6285385269101', 'dummy', '2025-08-11 08:28:24'),
(4, 'Ranss', 'unorais3@gmail.com', '+6285385269101', 'hello this is me , do you still remember me', '2025-08-12 07:08:27'),
(5, 'Ranss', 'unorais3@gmail.com', '+6285385269101', 'hello this is me , do you still remember me', '2025-08-12 07:08:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `counters`
--

CREATE TABLE `counters` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `delay_class` varchar(20) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `counters`
--

INSERT INTO `counters` (`id`, `value`, `title`, `delay_class`, `sort_order`, `is_active`) VALUES
(1, 739, 'CUPS OF COFFEE', '', 1, 1),
(2, 540, 'TB USED', 'wait-03s', 2, 1),
(3, 6217, 'CALLS MADE', 'wait-06s', 3, 1),
(4, 1183, 'TWEETS', 'wait-09s', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `focus_section`
--

CREATE TABLE `focus_section` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `paragraph1` text NOT NULL,
  `paragraph2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `focus_section`
--

INSERT INTO `focus_section` (`id`, `image_path`, `image_alt`, `title`, `paragraph1`, `paragraph2`) VALUES
(1, 'images/image_icons.jpg', 'Focus and Photo Icons', 'Focus and Photo by Professionals', 'We choose to go to the moon in this decade and do the other things, not because they are easy, but because they are hard, because that goal will serve to organize and measure the best of our energies and skills.', 'We won’t be doing it just to get out there in space we’ll be doing it because the things we learn out there will be making life better for a lot of people.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `news_section`
--

CREATE TABLE `news_section` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `news_section`
--

INSERT INTO `news_section` (`id`, `category`, `title`, `excerpt`, `link`) VALUES
(1, 'INSPIRATIONAL', 'Time is on Our Side', 'Talent she for lively eat led sister. Entrance strongly packages she out rendered get quitting denoting led. Dwelling confined improved it he no doubtful raptures.', 'single.php'),
(2, 'THOUGHTS', 'Hello to my Second Post', 'Smile spoke total few great had never their too. Amongst moments do in arrived at my replied. Fat weddings servants but man believed prospect.', 'single.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portfolio_items`
--

CREATE TABLE `portfolio_items` (
  `id` int(11) NOT NULL,
  `item_type` enum('video','image','text','link') NOT NULL,
  `thumb_image` varchar(255) NOT NULL,
  `full_url` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `text_label` varchar(50) NOT NULL,
  `target_blank` tinyint(1) DEFAULT 0,
  `css_class` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portfolio_items`
--

INSERT INTO `portfolio_items` (`id`, `item_type`, `thumb_image`, `full_url`, `icon_image`, `text_label`, `target_blank`, `css_class`) VALUES
(1, 'video', 'images/portfolio_item_01.jpg', 'https://vimeo.com/157276599', 'images/icon_play@2x.png', 'VIDEO', 0, 'p_2x2'),
(2, 'image', 'images/portfolio_item_02.jpg', 'images/portfolio_item_02_large.jpg', 'images/icon_view@2x.png', 'IMAGE', 0, 'p_1x1'),
(3, 'text', 'images/portfolio_item_03.jpg', 'single.php', 'images/icon_post@2x.png', 'TEXT', 0, 'p_1x1'),
(4, 'link', 'images/portfolio_item_04.jpg', 'http://cocobasic.com', 'images/icon_external@2x.png', 'LINK', 1, 'p_1x1'),
(5, 'text', 'images/portfolio_item_05.jpg', 'single.php', 'images/icon_post@2x.png', 'TEXT', 0, 'p_1x1'),
(6, 'image', 'images/portfolio_item_06.jpg', 'images/portfolio_item_06_large.jpg', 'images/icon_view@2x.png', 'IMAGE', 0, 'p_1x1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portfolio_steps`
--

CREATE TABLE `portfolio_steps` (
  `id` int(11) NOT NULL,
  `step_number` int(11) NOT NULL,
  `step_total` int(11) NOT NULL DEFAULT 3,
  `text` varchar(255) NOT NULL,
  `delay_class` varchar(20) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `portfolio_steps`
--

INSERT INTO `portfolio_steps` (`id`, `step_number`, `step_total`, `text`, `delay_class`, `sort_order`, `is_active`) VALUES
(1, 1, 3, 'Explore & Collect Information', '', 1, 1),
(2, 2, 3, 'Explore & Collect Information', 'wait-03s', 2, 1),
(3, 3, 3, 'Explore & Collect Information', 'wait-06s', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pricing_features`
--

CREATE TABLE `pricing_features` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `feature_text` varchar(255) NOT NULL,
  `is_included` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pricing_features`
--

INSERT INTO `pricing_features` (`id`, `plan_id`, `feature_text`, `is_included`, `sort_order`) VALUES
(1, 1, 'Auctor neque in euismod', 1, 1),
(2, 1, 'Sem erat nec nibh nulla', 1, 2),
(3, 1, 'Magna est suspendisse sem', 1, 3),
(4, 1, 'Viverra eget interdum nec', 0, 4),
(5, 1, 'Dignissim ipsum nulla', 0, 5),
(6, 1, 'Porta vestibulum nec', 0, 6),
(7, 1, 'Auctor neque in euismod', 0, 7),
(8, 1, 'Sem erat nec nibh nulla', 0, 8),
(9, 2, 'Auctor neque in euismod', 1, 1),
(10, 2, 'Sem erat nec nibh nulla', 1, 2),
(11, 2, 'Magna est suspendisse sem', 1, 3),
(12, 2, 'Viverra eget interdum nec', 1, 4),
(13, 2, 'Dignissim ipsum nulla', 1, 5),
(14, 2, 'Porta vestibulum nec', 0, 6),
(15, 2, 'Auctor neque in euismod', 0, 7),
(16, 2, 'Sem erat nec nibh nulla', 0, 8),
(17, 3, 'Auctor neque in euismod', 1, 1),
(18, 3, 'Sem erat nec nibh nulla', 1, 2),
(19, 3, 'Magna est suspendisse sem', 1, 3),
(20, 3, 'Viverra eget interdum nec', 1, 4),
(21, 3, 'Dignissim ipsum nulla', 1, 5),
(22, 3, 'Porta vestibulum nec', 1, 6),
(23, 3, 'Auctor neque in euismod', 1, 7),
(24, 3, 'Sem erat nec nibh nulla', 1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(5) DEFAULT '$',
  `delay_class` varchar(20) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pricing_plans`
--

INSERT INTO `pricing_plans` (`id`, `title`, `price`, `currency`, `delay_class`, `sort_order`, `is_active`) VALUES
(1, 'STARTER PACK', 29.00, '$', '', 1, 1),
(2, 'BUSINESS PACK', 49.00, '$', 'wait-03s', 2, 1),
(3, 'PROFESSIONAL PACK', 69.00, '$', 'wait-06s', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_items`
--

CREATE TABLE `services_items` (
  `id` int(11) NOT NULL,
  `icon_path` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services_items`
--

INSERT INTO `services_items` (`id`, `icon_path`, `title`, `description`) VALUES
(1, 'images/icon_interactive@2x.png', 'Interactive', 'For those who have seen the Earth from space, and for the hundreds and perhaps thousands more.'),
(2, 'images/icon_brand@2x.png', 'Brand', 'Astronomy compels the soul to look upward, and leads us from this world to another.'),
(3, 'images/icon_print@2x.png', 'Print', 'I believe every human has a finite number of heartbeats. I don\'t intend to waste any of mine.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_section`
--

CREATE TABLE `services_section` (
  `id` int(11) NOT NULL,
  `big_title` varchar(255) NOT NULL,
  `description_1` text NOT NULL,
  `description_2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services_section`
--

INSERT INTO `services_section` (`id`, `big_title`, `description_1`, `description_2`) VALUES
(1, 'Services With Clean Code & Awesome Design', 'The regret on our side is, they used to say years ago, we are reading about you in science class. Now they say, we are reading about you in history class.', 'We choose to go to the moon in this decade and do the other things, not because they are easy, but because they are hard, because that goal will serve to organize and measure the best of our energies and skills.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `logo_path` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo_path`, `updated_at`) VALUES
(1, 'images/logo@2x.png', '2025-08-11 07:13:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `image_url`, `is_active`, `sort_order`) VALUES
(7, 'images/hero_img_01.jpg', 1, 1),
(8, 'images/hero_img_02.jpg', 1, 2),
(9, 'images/hero_img_03.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `support_items`
--

CREATE TABLE `support_items` (
  `id` int(11) NOT NULL,
  `support_id` int(11) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `alt_text` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL,
  `offset_class` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `support_items`
--

INSERT INTO `support_items` (`id`, `support_id`, `icon_image`, `alt_text`, `label`, `offset_class`) VALUES
(1, 1, 'images/icon_photo@2x.png', 'Photo Sessions', 'Photo Sessions', 'text-center animate wait-03s'),
(2, 1, 'images/icon_support@2x.png', '24/7 Support', '24/8 Support', 'text-center animate wait-03s offset-sm-3'),
(3, 1, 'images/icon_diamond@2x.png', 'Pixel Precise', 'Pixel Precise', 'text-center animate wait-03s offset-sm-3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `support_section`
--

CREATE TABLE `support_section` (
  `id` int(11) NOT NULL,
  `quote_text` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `support_section`
--

INSERT INTO `support_section` (`id`, `quote_text`, `description`) VALUES
(1, 'The art and science of asking questions is the source of all knowledge', 'Drawings me opinions returned absolute in. Otherwise therefore hex did are unfeeling something. Certain be ye amiable by exposed so. To celebrated estimating excellence do.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `delay_class` varchar(20) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `position`, `image_url`, `bio`, `featured`, `delay_class`, `sort_order`, `is_active`) VALUES
(1, 'Peter Johanson', 'CEO', 'images/about_img_01.jpg', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla', 1, '', 1, 1),
(2, 'John Willson', 'CODER', 'images/about_img_02.jpg', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.', 0, '', 2, 1),
(3, 'Molly Chen', 'DESIGNER', 'images/about_img_03.jpg', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.', 0, '', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `team_skills`
--

CREATE TABLE `team_skills` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(100) NOT NULL,
  `percent` int(11) NOT NULL DEFAULT 0,
  `delay_class` varchar(20) DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `team_skills`
--

INSERT INTO `team_skills` (`id`, `skill_name`, `percent`, `delay_class`, `sort_order`, `is_active`) VALUES
(1, 'HTML', 92, '', 1, 1),
(2, 'CSS', 93, 'wait-03s', 2, 1),
(3, 'PSD', 72, 'wait-06s', 3, 1),
(4, 'LOVE', 99, 'wait-09s', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_text` text NOT NULL,
  `author_img` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `author_name`, `author_text`, `author_img`, `is_active`, `sort_order`) VALUES
(1, 'Jane Williams', 'Imperdiet dui accumsan sit amet. Tempor id eu nisl nunc. Augue ut lectus arcu bibendum. Dignissim cras tincidunt lobortis feugiat vivamus.', 'images/avatar_img_01@2x.png', 1, 1),
(2, 'John Doe', 'Bibendum at varius vel pharetra. Enim ut tellus elementum sagittis vitae et leo duis ut. Arcu odio ut sem nulla pharetra diam sit amet.', 'images/avatar_img_02@2x.png', 1, 2),
(3, 'Anna Who', 'Nec feugiat in fermentum posuere urna nec tincidunt praesent semper. Dictum fusce ut placerat orci. Leo in vitae turpis massa sed.', 'images/avatar_img_03@2x.png', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'Ranss', '$2y$10$hjObTzdejiDwzFS0h9O7K.KML9FPNSM5eiViD2aWDldliHnUCT1Y.', '2025-08-12 08:18:02'),
(2, 'Raiden Shogun', '$2y$10$tm1KV0KgRKE9Joa8rMmIrOyzyuxLy74OCMoo4iObBOWYJdBzwmEpS', '2025-08-12 11:54:13');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `focus_section`
--
ALTER TABLE `focus_section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news_section`
--
ALTER TABLE `news_section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `portfolio_steps`
--
ALTER TABLE `portfolio_steps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pricing_features`
--
ALTER TABLE `pricing_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indeks untuk tabel `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_items`
--
ALTER TABLE `services_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_section`
--
ALTER TABLE `services_section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `support_items`
--
ALTER TABLE `support_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_id` (`support_id`);

--
-- Indeks untuk tabel `support_section`
--
ALTER TABLE `support_section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `team_skills`
--
ALTER TABLE `team_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `focus_section`
--
ALTER TABLE `focus_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `news_section`
--
ALTER TABLE `news_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `portfolio_items`
--
ALTER TABLE `portfolio_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `portfolio_steps`
--
ALTER TABLE `portfolio_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pricing_features`
--
ALTER TABLE `pricing_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `services_items`
--
ALTER TABLE `services_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `services_section`
--
ALTER TABLE `services_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `support_items`
--
ALTER TABLE `support_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `support_section`
--
ALTER TABLE `support_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `team_skills`
--
ALTER TABLE `team_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pricing_features`
--
ALTER TABLE `pricing_features`
  ADD CONSTRAINT `pricing_features_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `pricing_plans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `support_items`
--
ALTER TABLE `support_items`
  ADD CONSTRAINT `support_items_ibfk_1` FOREIGN KEY (`support_id`) REFERENCES `support_section` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
