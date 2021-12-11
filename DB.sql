--
-- データベース: `campsite`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `token`) VALUES
(22, 's.masaki.8888@gmail.com', '$2y$10$Izf46SWgykt/DxJK6mnSPegu4XiaTwvNTgJadq83Sk004lMCwE3Q2', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `campsites`
--

CREATE TABLE `campsites` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `prefecture_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `address` varchar(50) DEFAULT NULL,
  `tel` bigint(11) UNSIGNED ZEROFILL DEFAULT NULL,
  `buisiness_hours` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `campsites`
--

INSERT INTO `campsites` (`id`, `name`, `image`, `prefecture_id`, `created_at`, `updated_at`, `address`, `tel`, `buisiness_hours`, `url`) VALUES
(208, '菅野将輝', '20211207003651cafe2.jpg', 2, '2021-12-07 00:36:51', '2021-12-07 00:36:51', '千葉県習志野市東習志野', 08013016674, '11:00〜19:00', 'www.humotonohara.autocamp.ca.jp');

-- --------------------------------------------------------

--
-- テーブルの構造 `camp_facilities`
--

CREATE TABLE `camp_facilities` (
  `id` int(11) NOT NULL,
  `campsite_id` int(50) NOT NULL,
  `facility_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `camp_facilities`
--

INSERT INTO `camp_facilities` (`id`, `campsite_id`, `facility_id`) VALUES
(332, 208, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `camp_structures`
--

CREATE TABLE `camp_structures` (
  `id` int(11) NOT NULL,
  `campsite_id` int(50) NOT NULL,
  `structure_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `camp_structures`
--

INSERT INTO `camp_structures` (`id`, `campsite_id`, `structure_id`) VALUES
(235, 208, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `facilities`
--

INSERT INTO `facilities` (`id`, `name`) VALUES
(1, 'トイレ'),
(2, 'シャワー'),
(3, '洗面台'),
(4, '宿泊');

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `campsite_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `campsite_id`) VALUES
(51, 28, 195),
(55, 28, 194);

-- --------------------------------------------------------

--
-- テーブルの構造 `histories`
--

CREATE TABLE `histories` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `campsite_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `campsite_id` int(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `insert_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `campsite_id` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `score` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `campsite_id`, `title`, `review`, `score`, `created_at`, `updated_at`) VALUES
(167, 29, 194, '評価', 'あまり面白くなかった。', 1, '2021-12-02 11:46:38', '2021-12-02 11:46:38');

-- --------------------------------------------------------

--
-- テーブルの構造 `prefectures`
--

CREATE TABLE `prefectures` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `prefectures`
--

INSERT INTO `prefectures` (`id`, `name`) VALUES
(1, '北海道'),
(2, '青森'),
(3, '岩手'),
(4, '宮城'),
(5, '秋田\r\n                                     '),
(6, '山形'),
(7, '福島'),
(8, '茨城'),
(9, '栃木'),
(10, '群馬'),
(11, '埼玉'),
(12, '千葉'),
(13, '東京'),
(14, '神奈川'),
(15, '新潟'),
(16, '富山'),
(17, '石川'),
(18, '福井'),
(19, '山梨'),
(20, '長野'),
(21, '岐阜'),
(22, '静岡'),
(23, '愛知'),
(24, '三重'),
(25, '滋賀'),
(26, '京都'),
(27, '大阪'),
(28, '兵庫'),
(29, '奈良'),
(30, '和歌山'),
(31, '鳥取'),
(32, '島根'),
(33, '岡山'),
(34, '広島'),
(35, '山口'),
(36, '徳島'),
(37, '香川'),
(38, '愛媛'),
(39, '高知'),
(40, '福岡'),
(41, '佐賀'),
(42, '長崎'),
(43, '熊本'),
(44, '大分'),
(45, '宮崎'),
(46, '鹿児島'),
(47, '沖縄');

-- --------------------------------------------------------

--
-- テーブルの構造 `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `campsite_id` int(50) NOT NULL,
  `star` decimal(5,0) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `structures`
--

CREATE TABLE `structures` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `structures`
--

INSERT INTO `structures` (`id`, `name`) VALUES
(1, 'ソロ'),
(2, 'ファミリー');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '氏名',
  `email` varchar(50) NOT NULL COMMENT 'Eメール',
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`, `token`) VALUES
(28, 'マック', 'm.sugano.1357@gmail.com', '$2y$10$K8GZ9crUgh04MC364l7VeeedZFgZx5s.iUAou.bM8B3o2h1VWW0im', NULL, '2021-11-29 20:47:46', '2021-11-29 20:47:46', '3aed6b742b96236068c0ff9452852fca');

--