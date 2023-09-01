-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 09:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(255) NOT NULL,
  `author_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(3, 'J.K. Rowling'),
(5, 'George R.R. Martin'),
(11, 'Hector Gracia'),
(57, 'James Clear'),
(58, 'John Green'),
(59, 'Colleen Hoover'),
(60, 'Vyasa');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(100) NOT NULL,
  `book_title` varchar(1000) NOT NULL,
  `book_summary` mediumtext DEFAULT NULL,
  `book_language` varchar(100) NOT NULL,
  `author_id` int(100) NOT NULL,
  `total_pages` int(100) DEFAULT NULL,
  `publisher_id` int(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `book_type` varchar(30) NOT NULL,
  `trending_book` tinyint(1) NOT NULL DEFAULT 0,
  `publish_year` int(11) DEFAULT NULL,
  `book_image` varchar(10000) DEFAULT NULL,
  `book_pdf` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `book_summary`, `book_language`, `author_id`, `total_pages`, `publisher_id`, `rating`, `book_type`, `trending_book`, `publish_year`, `book_image`, `book_pdf`) VALUES
(5, 'ikigai', 'The Ikigai book introduces you to various topics related to the art of living, such as the blue zones, longevity, logotherapy, flow, yoga, tai chi, and resilience. It defines what Ikigai is and its rules. The book says that living a long and full life is under your control to an extent. Your habits and life choices can make a significant difference from an early age.\r\n<br/>\r\nThe authors of this book conducted 100 interviews in Ogimi, Okinawa (the world’s longest-living community) to gain an in-depth understanding of the longevity secrets of centenarians and supercentenarians. Each chapter delivers a well-researched account of Okinawans’ lifestyle, attitude, mindset, diet, and routine. The authors argue that your Ikigai keeps your body fighting and living longer. ', 'english', 11, 123, 3, 4, 'Free', 1, 2016, '/media/uploads/books_image/ikigai-the-japanese-secret-to-a-lon.jpg', '/media/uploads/books_pdf/mypdf.in_Ikigai_Book_Pdf_Download.pdf'),
(6, 'Harry Potter and the Sorcerer\'s Stone', '\"Harry Potter and the Sorcerer\'s Stone\" is the first novel in the Harry Potter series written by J.K. Rowling. It introduces readers to the enchanting world of magic and follows the journey of an orphaned boy named Harry Potter.\r\n<br>\r\nThe story begins with Harry Potter living a miserable life with his neglectful relatives, the Dursleys. On his eleventh birthday, Harry discovers that he is a wizard and receives an acceptance letter from Hogwarts School of Witchcraft and Wizardry. He learns that his parents were powerful wizards who were killed by the dark wizard Lord Voldemort, who mysteriously vanished after failing to kill Harry as an infant.\r\n<br>\r\nHarry embarks on a magical adventure as he enters the wizarding world. At Hogwarts, he befriends Ron Weasley and Hermione Granger, forming a tight-knit trio. They encounter various challenges and mysteries throughout the school year.\r\n<br>\r\nOne significant mystery revolves around the legendary Philosopher\'s Stone, an object that grants im   ', 'english', 3, 250, 7, 5, 'Free', 0, 1997, '/media/uploads/books_image/Harry Potter and the Sorcerers Stone.jpg', '/media/uploads/books_pdf/Harry Potter and the Sorcerers Stone.pdf'),
(7, 'A Game of Thrones', '\"A Game of Thrones\" is the first book in the epic fantasy series \"A Song of Ice and Fire\" written by George R.R. Martin. Set in the fictional continents of Westeros and Essos, the story revolves around the power struggles, political intrigues, and battles for the Iron Throne.<br><br>\r\nThe book introduces readers to a vast array of characters, noble houses, and their intricate relationships. The main plot follows the Stark family, led by Lord Eddard Stark, who is summoned to the capital city of King\'s Landing by his old friend, King Robert Baratheon. Eddard becomes the Hand of the King, the king\'s chief advisor, and must navigate the treacherous political landscape of the Seven Kingdoms.<br><br>\r\nAs Eddard delves into the courtly affairs, he uncovers a web of deception, corruption, and dark secrets. He becomes embroiled in a deadly game of power, where alliances shift and betrayals abound. Meanwhile, in the distant lands of Essos, Daenerys Targaryen, the exiled princess of the deposed T       ', 'english', 5, 569, 5, 5, 'Premiere', 1, 1995, '/media/uploads/books_image/A-Game-Of-Thrones-by-George-R.R.-Martin.jpeg', '/media/uploads/books_pdf/A-Game-Of-Thrones-by-George-R.R.-Martin.pdf'),
(17, 'Atomic Habits', '\"Atomic Habits\" by James Clear is a transformative self-help book that explores the science of habit formation and offers practical strategies for lasting change.<br/><br/>\r\n\r\nClear introduces the concept of \"atomic habits,\" emphasizing the power of small, consistent actions that compound over time.<br/><br/>\r\n\r\nThe book delves into the habit loop—cue, craving, response, reward—and how understanding and manipulating these stages can reshape behavior.<br/><br/>\r\n\r\nClear provides actionable advice like habit stacking, implementation intentions, and the two-minute rule to make habit formation easier.<br/><br/>\r\n\r\nHe discusses the plateau of latent potential, where progress may seem slow initially but accelerates with consistency.<br/><br/>\r\n\r\nThe book emphasizes the importance of identity and environment in habit formation and highlights the role of social influence.<br/><br/>\r\n\r\nKey takeaways include the Four Laws of Behavior Change: Make it obvious, attractive, easy, and satisfying.<br/><br/>\r\n\r\nOverall, \"Atomic Habits\" offers a roadmap to personal transformation through small, deliberate changes.<br/><br/> ', 'english', 57, 285, 8, 4, 'Free', 1, 2018, '/media/uploads/books_image/Atomic Habits by James Clear.jpg', '/media/uploads/books_pdf/Atomic Habits by James Clear.pdf'),
(18, 'The Fault in Our Stars', '\"The Fault in Our Stars\" is a young adult novel written by John Green. It tells the story of Hazel Grace Lancaster, a sixteen-year-old girl who has thyroid cancer that has spread to her lungs, and Augustus Waters, a seventeen-year-old boy who is in remission from osteosarcoma, a type of bone cancer. <br/><br/>\r\n\r\nThe two meet at a cancer support group and form a deep connection. Their relationship evolves as they bond over their shared experiences, humor, and a love for a book called \"An Imperial Affliction.\" Hazel introduces Augustus to the novel, and they become determined to find its reclusive author, Peter Van Houten, in Amsterdam to learn more about the story\'s unresolved ending. <br/><br/>\r\n\r\nAs Hazel and Augustus navigate the challenges of living with cancer, they experience moments of joy and sadness. Their love for each other grows stronger, but the harsh reality of their illnesses is always present. <br/><br/>\r\n\r\nThe novel explores themes of love, mortality, and the meaning of life, and it offers a poignant and emotional look at the lives of young people facing the profound challenges of illness. Without giving away too many spoilers, \"The Fault in Our Stars\" is a heartfelt and beautifully written story that delves into the complexities of life, love, and loss. It\'s a powerful exploration of the human condition and the enduring impact of genuine connections and relationships. ', 'english', 58, 195, 3, 4, 'Premiere', 1, 2012, '/media/uploads/books_image/The-Fault-in-Our-Stars-768x1178.jpg', '/media/uploads/books_pdf/The Fault in Our Stars book.pdf'),
(19, 'It Ends with Us', '\"It Ends with Us\" is a contemporary romance novel by Colleen Hoover. The story revolves around Lily Bloom, a young woman who has overcome a challenging past and is determined to build a better future for herself. <br/><br/>\r\n\r\nLily meets Ryle Kincaid, a talented neurosurgeon, and they share an instant connection. However, Ryle is adamant about his aversion to relationships and is not interested in love. Despite his reservations, Lily and Ryle\'s attraction intensifies, leading them into a passionate and complex relationship. <br/><br/>\r\n\r\nAs their love story unfolds, the novel also delves into Lily\'s past, including her first love, Atlas Corrigan, and the challenges she faced growing up. The story explores themes of love, resilience, domestic abuse, and the complexity of human relationships. <br/><br/>\r\n\r\nLily finds herself torn between her past and present, struggling to make choices that will determine her future. She must confront painful truths and make difficult decisions that will shape the course of her life. The novel offers a powerful and thought-provoking exploration of love, courage, and the strength to break the cycle of abuse. <br/><br/>\r\n\r\n\"It Ends with Us\" is a poignant and emotionally charged novel that tackles sensitive subjects with depth and empathy, leaving readers with a profound understanding of the complexities of human relationships and the strength it takes to stand up against adversity.', 'english', 59, 303, 9, 3, 'Free', 0, 2016, '/media/uploads/books_image/It Ends with Us.jfif', '/media/uploads/books_pdf/It_Ends_with_Us_by_Colleen_Hoover.pdf'),
(20, 'It Starts with Us', '\"It Ends with Us\" is a contemporary romance novel by Colleen Hoover. The story revolves around Lily Bloom, a young woman who has overcome a challenging past and is determined to build a better future for herself. <br/><br/>\r\n\r\nLily meets Ryle Kincaid, a talented neurosurgeon, and they share an instant connection. However, Ryle is adamant about his aversion to relationships and is not interested in love. Despite his reservations, Lily and Ryle\'s attraction intensifies, leading them into a passionate and complex relationship. <br/><br/>\r\n\r\nAs their love story unfolds, the novel also delves into Lily\'s past, including her first love, Atlas Corrigan, and the challenges she faced growing up. The story explores themes of love, resilience, domestic abuse, and the complexity of human relationships. <br/><br/>\r\n\r\nLily finds herself torn between her past and present, struggling to make choices that will determine her future. She must confront painful truths and make difficult decisions that will shape the course of her life. The novel offers a powerful and thought-provoking exploration of love, courage, and the strength to break the cycle of abuse. <br/><br/>\r\n\r\n\"It Ends with Us\" is a poignant and emotionally charged novel that tackles sensitive subjects with depth and empathy, leaving readers with a profound understanding of the complexities of human relationships and the strength it takes to stand up against adversity.', 'english', 59, 189, 9, 3, 'Premiere', 1, 2022, '/media/uploads/books_image/It-Starts-With-Us.jfif', '/media/uploads/books_pdf/It-Starts-With-Us.pdf'),
(21, 'Bhagavad Gita', 'The Bhagavad Gita, often referred to as the Gita, is a 700-verse Hindu scripture that is part of the Indian epic Mahabharata. It consists of a conversation between Prince Arjuna and the god Krishna, who serves as his charioteer. The dialogue takes place on the battlefield just before the Kurukshetra War, where Arjuna is filled with doubt and moral dilemma about fighting in the war. <br/><br/>\r\n\r\nKrishna imparts spiritual wisdom and guidance to Arjuna, addressing his concerns and questions. The Gita covers a wide range of philosophical and ethical topics, including the nature of the self, the purpose of life, the concept of dharma (duty/righteousness), and the paths to spiritual realization. <br/><br/>\r\n\r\nKey teachings in the Bhagavad Gita include the importance of selfless action (karma yoga), devotion to the divine (bhakti yoga), and the pursuit of knowledge and meditation (jnana yoga). Krishna emphasizes the need for detachment from the fruits of one\'s actions and encourages Arjuna to fulfill his duty as a warrior. <br/><br/>\r\n\r\nThe Gita concludes with Arjuna gaining clarity and determination, ready to fulfill his role in the war. The teachings of the Bhagavad Gita have had a profound influence on Hindu philosophy and spirituality, and they continue to inspire people of various backgrounds around the world. It is regarded as a timeless guide for leading a meaningful and purposeful life while navigating the challenges of the material world. <br/><br/>\r\n\r\nThe Bhagavad Gita is a revered scripture that provides profound insights into ethics, spirituality, and the human condition, making it a central text in Hindu philosophy and a source of wisdom for seekers of truth and enlightenment.', 'hindi', 60, 1299, 10, 5, 'Free', 0, 1968, '/media/uploads/books_image/bhagwat-geeta.jfif', '/media/uploads/books_pdf/bhagwat-geeta.pdf'),
(22, 'The Hunger Games', '\"The Hunger Games\" is a dystopian novel set in a future where a totalitarian government rules over a nation called Panem. Panem is divided into twelve districts, and the Capitol, which holds absolute power. As a form of control and punishment, the Capitol forces each district to send one boy and one girl, known as \"tributes,\" to participate in a televised event called the Hunger Games. The Games are a brutal fight to the death in a vast, manipulated arena, and they serve as a means of entertainment for the Capitol citizens and a reminder of the districts\' submission.\r\n<br/>\r\nThe story follows Katniss Everdeen, a resourceful and skilled archer from District 12, who volunteers to take her younger sister Prim\'s place as a tribute when Prim is chosen. Katniss is joined by Peeta Mellark, the other tribute from District 12. As they are thrust into the Capitol\'s world of extravagance and manipulation, Katniss and Peeta must form an alliance to survive the deadly competition.\r\n<br/>\r\nThroughout the Hunger Games, Katniss and Peeta face numerous challenges, including formidable opponents and dangerous traps set by the Capitol. Their growing bond and the way they present themselves as star-crossed lovers for the Capitol audience become a central strategy for gaining support and survival.\r\n<br/>\r\nThe novel explores themes of survival, rebellion, and the consequences of a society\'s obsession with entertainment and control. Katniss\'s defiance and strength inspire rebellion in the districts, making her a symbol of hope for those who seek to overthrow the Capitol\'s oppressive regime.\r\n<br/>\r\n\"The Hunger Games\" is the first book in a trilogy and sets the stage for Katniss\'s journey to challenge the Capitol\'s authority and ignite a revolution. It\'s a thrilling and thought-provoking tale that delves into the moral dilemmas of survival, sacrifice, and resistance in a harsh and unjust world.', 'english', 58, 1867, 6, 4, 'Free', 0, 2008, '/media/uploads/books_image/hunger games.jpg', '/media/uploads/books_pdf/the_hunger_games_-_trilogy.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `book_genres`
--

CREATE TABLE `book_genres` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `genre_id` int(100) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_genres`
--

INSERT INTO `book_genres` (`id`, `book_id`, `genre_id`, `counter`) VALUES
(10, 5, 25, 1),
(12, 6, 20, 1),
(13, 6, 24, 1),
(14, 6, 39, 1),
(16, 7, 18, 1),
(17, 7, 39, 2),
(25, 6, 10, 1),
(26, 7, 10, 2),
(27, 17, 25, 2),
(28, 18, 23, 1),
(29, 18, 28, 1),
(30, 18, 39, 3),
(31, 19, 23, 2),
(32, 19, 28, 2),
(33, 19, 39, 4),
(34, 20, 23, 3),
(35, 20, 28, 3),
(36, 20, 39, 5),
(37, 21, 25, 3),
(38, 21, 40, 1),
(39, 22, 9, 1),
(40, 22, 10, 3),
(41, 22, 15, 1),
(42, 22, 16, 1),
(43, 22, 24, 2),
(44, 22, 27, 1),
(45, 22, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(100) NOT NULL,
  `genre_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(9, 'Action'),
(10, 'Adventure'),
(11, 'Biography'),
(14, 'Comedy'),
(15, 'Crime'),
(16, 'Drama'),
(17, 'Fantasy'),
(18, 'Historical Fiction'),
(19, 'Horror'),
(20, 'Mystery'),
(21, 'Paranormal'),
(23, 'Romance'),
(24, 'Science Fiction'),
(25, 'Self-help'),
(27, 'Suspense/Thriller'),
(28, 'Teen/Young Adult'),
(31, 'Non-fiction'),
(32, 'Science'),
(35, 'Psychology'),
(39, 'Novel'),
(40, 'Religious');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `month_duration` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `payment_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `user_id`, `price`, `month_duration`, `start_date`, `expiry_date`, `status`, `payment_id`) VALUES
(2, 19, 999, 6, '2023-08-04', '2024-02-04', 'Active', 'pay_MLs7fEhIYOPLWx'),
(3, 20, 799, 6, '2023-08-07', '2024-02-07', 'Active', 'pay_MN2k7x9vLpGP8L'),
(4, 22, 199, 1, '2023-09-01', '2023-10-01', 'Active', 'pay_MWwfblCyoYnS3c');

-- --------------------------------------------------------

--
-- Table structure for table `mybooks`
--

CREATE TABLE `mybooks` (
  `mybook_id` int(11) NOT NULL,
  `book_id` int(100) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `publisher_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publisher_name`) VALUES
(3, 'Penguin Random House'),
(4, 'HarperCollins Publishers'),
(5, 'Hachette Book Group'),
(6, 'Simon & Schuster'),
(7, 'Scholastic Corporation'),
(8, '‎Random House Business Books'),
(9, 'Atria Books'),
(10, 'Prakash Books India Pvt Ltd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(750) NOT NULL,
  `mobile_no` decimal(14,0) DEFAULT NULL,
  `joining_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_member` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `mobile_no`, `joining_date`, `last_login`, `is_admin`, `is_member`, `is_active`) VALUES
(12, 'om', 'adreja', 'admin', 'admin@gmail.com', '$2y$10$Thvv97cWd1ifGVH6SLDuwuulYSlOg3o5q4nUW8r00W8Xir720EhIq', NULL, '2023-06-06 21:06:01', '2023-09-01 06:55:34', 1, 0, 1),
(17, 'aastha', 'variya', 'aaatha', 'as@gmail.com', '$2y$10$9YtznrhOqMMrGVftu1g.ZO1qIo8xt38AqlwOqjxgAz8nNHgBF7qRu', NULL, '2023-06-23 11:15:42', NULL, 0, 0, 1),
(19, 'krupali', 'chotaliya', 'kc', 'kc@gmail.com', '$2y$10$5srOd7jIIgG8voyw9ZImTu2qAuxAvwpUwIvBIQ.87EegCI1Y.l0ia', NULL, '2023-08-04 10:42:29', '2023-08-04 07:14:54', 0, 1, 1),
(20, 'jasmansingh', 'bajaj', 'Jasmanbajaj', 'jasmansinghbajaj88@gmail.com', '$2y$10$rHhgiXu5kVwQCfk/wEUhGO4IpZB21pQVZa3325OlPvCroETHq3IOy', NULL, '2023-08-07 09:45:19', '2023-08-07 06:36:31', 0, 1, 1),
(21, 'om', 'adreja', 'Om', 'adrejaom@gmail.com', '$2y$10$EXaqWwdfPJPxwyyL0lfSguZuf4CEAVrmpkMaSLjIUBHUQFHxfWfEm', NULL, '2023-09-01 10:06:42', '2023-09-01 06:41:58', 0, 0, 1),
(22, 'Aum', 'Adreja', 'Aum', 'aum@gmail.com', '$2y$10$aE8TNGRnCaCePiNL3XKkp.sjBZCDjDd1FbaSgOQ/s3cFeyyrykKbO', NULL, '2023-09-01 10:07:29', '2023-09-01 06:48:15', 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `FK_author_id` (`author_id`),
  ADD KEY `FK_publisher_id` (`publisher_id`);

--
-- Indexes for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_books_book_id` (`book_id`),
  ADD KEY `FK_genres_genres_id` (`genre_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_user_id` (`user_id`);

--
-- Indexes for table `mybooks`
--
ALTER TABLE `mybooks`
  ADD PRIMARY KEY (`mybook_id`),
  ADD KEY `FK_book_id` (`book_id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usernameUK` (`username`),
  ADD UNIQUE KEY `emailUK` (`email`(200));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `book_genres`
--
ALTER TABLE `book_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mybooks`
--
ALTER TABLE `mybooks`
  MODIFY `mybook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `FK_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_publisher_id` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_genres`
--
ALTER TABLE `book_genres`
  ADD CONSTRAINT `FK_books_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_genres_genres_id` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mybooks`
--
ALTER TABLE `mybooks`
  ADD CONSTRAINT `FK_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
