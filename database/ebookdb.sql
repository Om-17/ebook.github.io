-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 09:54 AM
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
(4, 'Stephen King'),
(5, 'George R.R. Martin'),
(6, 'J.R.R. Tolkien'),
(7, 'Agatha Christie'),
(8, 'Harper Lee'),
(9, 'Dan Brown'),
(10, 'John Green'),
(11, 'Hector Gracia'),
(12, 'William Shakespeare'),
(13, 'Charles Dickens'),
(14, 'Mark Twain'),
(15, 'Jane Austen'),
(16, 'Leo Tolstoy'),
(17, 'Fyodor Dostoevsky'),
(18, 'George Orwell'),
(19, 'Ernest Hemingway'),
(20, 'Virginia Woolf'),
(21, 'Oscar Wilde'),
(22, 'Emily Dickinson'),
(23, 'Herman Melville'),
(24, 'Charlotte Brontë'),
(25, 'F. Scott Fitzgerald'),
(26, 'Victor Hugo'),
(27, 'Arthur Conan Doyle'),
(28, 'Toni Morrison'),
(29, 'Gabriel Garcia Marquez'),
(30, 'John Steinbeck'),
(31, 'Miguel de Cervantes'),
(32, 'Ralph Waldo Emerson'),
(33, 'Rudyard Kipling'),
(34, 'Edgar Allan Poe'),
(35, 'Homer'),
(36, 'H.G. Wells'),
(37, 'Thomas Hardy'),
(38, 'Anton Chekhov'),
(39, 'Voltaire'),
(40, 'Edith Wharton'),
(41, 'James Joyce'),
(42, 'Aldous Huxley'),
(43, 'Nathaniel Hawthorne'),
(44, 'H.P. Lovecraft'),
(45, 'Franz Kafka'),
(46, 'Walt Whitman'),
(47, 'Jules Verne'),
(48, 'Charlotte Perkins Gilman'),
(49, 'Dante Alighieri'),
(50, 'Hans Christian Andersen'),
(51, 'John Milton'),
(52, 'Albert Camus'),
(53, 'Truman Capote'),
(54, 'Gustave Flaubert'),
(55, 'Kurt Vonnegut'),
(56, 'Mary Shelley');

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
  `publish_year` int(11) DEFAULT NULL,
  `book_image` varchar(10000) DEFAULT NULL,
  `book_pdf` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `book_summary`, `book_language`, `author_id`, `total_pages`, `publisher_id`, `rating`, `book_type`, `publish_year`, `book_image`, `book_pdf`) VALUES
(5, 'ikigai', 'The Ikigai book introduces you to various topics related to the art of living, such as the blue zones, longevity, logotherapy, flow, yoga, tai chi, and resilience. It defines what Ikigai is and its rules. The book says that living a long and full life is under your control to an extent. Your habits and life choices can make a significant difference from an early age.\r\n<br/>\r\nThe authors of this book conducted 100 interviews in Ogimi, Okinawa (the world’s longest-living community) to gain an in-depth understanding of the longevity secrets of centenarians and supercentenarians. Each chapter delivers a well-researched account of Okinawans’ lifestyle, attitude, mindset, diet, and routine. The authors argue that your Ikigai keeps your body fighting and living longer. ', 'english', 11, 123, 3, 4, 'Free', 2016, '/media/uploads/books_image/ikigai-the-japanese-secret-to-a-lon.jpg', '/media/uploads/books_pdf/mypdf.in_Ikigai_Book_Pdf_Download.pdf'),
(6, 'Harry Potter and the Sorcerer\'s Stone', '\"Harry Potter and the Sorcerer\'s Stone\" is the first novel in the Harry Potter series written by J.K. Rowling. It introduces readers to the enchanting world of magic and follows the journey of an orphaned boy named Harry Potter.\r\n<br>\r\nThe story begins with Harry Potter living a miserable life with his neglectful relatives, the Dursleys. On his eleventh birthday, Harry discovers that he is a wizard and receives an acceptance letter from Hogwarts School of Witchcraft and Wizardry. He learns that his parents were powerful wizards who were killed by the dark wizard Lord Voldemort, who mysteriously vanished after failing to kill Harry as an infant.\r\n<br>\r\nHarry embarks on a magical adventure as he enters the wizarding world. At Hogwarts, he befriends Ron Weasley and Hermione Granger, forming a tight-knit trio. They encounter various challenges and mysteries throughout the school year.\r\n<br>\r\nOne significant mystery revolves around the legendary Philosopher\'s Stone, an object that grants im', 'english', 3, 250, 7, 5, 'Free', 1997, '/media/uploads/books_image/Harry Potter and the Sorcerers Stone.jpg', '/media/uploads/books_pdf/Harry Potter and the Sorcerers Stone.pdf'),
(7, 'A Game of Thrones', '\"A Game of Thrones\" is the first book in the epic fantasy series \"A Song of Ice and Fire\" written by George R.R. Martin. Set in the fictional continents of Westeros and Essos, the story revolves around the power struggles, political intrigues, and battles for the Iron Throne.<br><br>\r\nThe book introduces readers to a vast array of characters, noble houses, and their intricate relationships. The main plot follows the Stark family, led by Lord Eddard Stark, who is summoned to the capital city of King\'s Landing by his old friend, King Robert Baratheon. Eddard becomes the Hand of the King, the king\'s chief advisor, and must navigate the treacherous political landscape of the Seven Kingdoms.<br><br>\r\nAs Eddard delves into the courtly affairs, he uncovers a web of deception, corruption, and dark secrets. He becomes embroiled in a deadly game of power, where alliances shift and betrayals abound. Meanwhile, in the distant lands of Essos, Daenerys Targaryen, the exiled princess of the deposed T', 'english', 5, 569, 5, 4, 'Free', 1996, '/media/uploads/books_image/A-Game-Of-Thrones-by-George-R.R.-Martin.jpeg', '/media/uploads/books_pdf/A-Game-Of-Thrones-by-George-R.R.-Martin.pdf');

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
(11, 6, 17, 1),
(12, 6, 20, 1),
(13, 6, 24, 1),
(14, 6, 39, 1),
(15, 7, 17, 2),
(16, 7, 18, 1),
(17, 7, 39, 2);

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
(13, 'Children\'s'),
(14, 'Comedy'),
(15, 'Crime'),
(16, 'Drama'),
(17, 'Fantasy'),
(18, 'Historical Fiction'),
(19, 'Horror'),
(20, 'Mystery'),
(21, 'Paranormal'),
(22, 'Poetry'),
(23, 'Romance'),
(24, 'Science Fiction'),
(25, 'Self-help'),
(26, 'Short Stories'),
(27, 'Suspense/Thriller'),
(28, 'Teen/Young Adult'),
(29, 'Travel'),
(30, 'Western'),
(31, 'Historical Non-fiction'),
(32, 'Science'),
(33, 'Philosophy'),
(34, 'Business'),
(35, 'Psychology'),
(36, 'Biography/Memoir'),
(37, 'Health/Fitness'),
(38, 'Cookbooks'),
(39, 'Novel');

-- --------------------------------------------------------

--
-- Table structure for table `mybook`
--

CREATE TABLE `mybook` (
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
(7, 'Scholastic Corporation');

-- --------------------------------------------------------

--
-- Table structure for table `trending_book`
--

CREATE TABLE `trending_book` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 'om', 'adreja', 'om17', 'om@gmail.com', '$2y$10$6uHHt3KVCiTWRWQ5nnXk4eJQfH2obxXDj20Y./O0u7WlR3O0yr.Nm', 1234567890, '2023-05-05 01:07:36', NULL, 0, 0, 1),
(8, 'om', 'Adreja', 'om178', 'omadreja178@gmail.com', '$2y$10$g1SLjXRwl56RdJwXzlurQefgPk9tytS7w70q6JqB3.POIkETR72kC', NULL, '2023-05-10 00:25:10', NULL, 0, 0, 1),
(12, 'om', 'adreja', 'admin', 'admin@gmail.com', '$2y$10$Thvv97cWd1ifGVH6SLDuwuulYSlOg3o5q4nUW8r00W8Xir720EhIq', NULL, '2023-06-06 21:06:01', '2023-06-27 06:12:03', 1, 0, 1),
(13, 'om', 'adreja', 'admin123', 'admin123@gmail.com', '$2y$10$wqRcYydxkNXnU90uyykqcOznPBukNx7TW6CAZdTPOtLaGVDICZYoi', NULL, '2023-06-06 21:07:33', NULL, 0, 0, 1),
(14, 'om', 'adreja', 'admin1234', 'admin1234@gmail.com', '$2y$10$oPpVz2n4CoOINjo1VrHH2uyu6mex7VHNYWPNgrkyuqO/50hSbqT7a', NULL, '2023-06-06 21:09:10', NULL, 0, 0, 1),
(15, 'om', 'adreja', 'om', 'omadreja@gmail.com', '$2y$10$MKUmHVaALrjMDlSH.ggs9uP92Mu7R6PajmJPBwOgFXvb0XIHj1SNi', NULL, '2023-06-07 22:34:07', '2023-06-07 21:33:20', 0, 0, 1),
(16, 'om', 'adreja', 'Omadreja', 'omadreja17@gmail.com', '$2y$10$H5VHqRCGBDimNYjPvD3mR.BiSzRlGfUuMpXvDyCoqyAqBVTPKjDY.', NULL, '2023-06-09 12:54:10', '2023-06-23 07:43:48', 0, 0, 1),
(17, 'aastha', 'variya', 'aaatha', 'as@gmail.com', '$2y$10$9YtznrhOqMMrGVftu1g.ZO1qIo8xt38AqlwOqjxgAz8nNHgBF7qRu', NULL, '2023-06-23 11:15:42', NULL, 0, 0, 1);

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
-- Indexes for table `mybook`
--
ALTER TABLE `mybook`
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
  MODIFY `author_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_genres`
--
ALTER TABLE `book_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `mybook`
--
ALTER TABLE `mybook`
  MODIFY `mybook_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `FK_genres_genres_id` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mybook`
--
ALTER TABLE `mybook`
  ADD CONSTRAINT `FK_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
