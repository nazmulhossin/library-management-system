-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2025 at 07:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `edition` varchar(5) DEFAULT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `total_copies` int(11) NOT NULL DEFAULT 1,
  `available_copies` int(11) DEFAULT NULL,
  `cover_image` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `description`, `author`, `publisher`, `publication_date`, `edition`, `isbn`, `pages`, `category`, `total_copies`, `available_copies`, `cover_image`, `uploaded_at`, `updated_at`) VALUES
(1, 'Discrete Mathematics and Its Applications', 'Discrete Mathematics and its Applications presents a precise, relevant, comprehensive approach to mathematical concepts. This world-renowned best-selling text was written to accommodate the needs across a variety of majors and departments, including mathematics, computer science, and engineering.', 'Kenneth Rosen', 'Mc Graw Hill', '2018-01-01', '8th', '9781260091991', 747, 'Mathematics', 5, 4, 'books/sQgQtoI4c94uLPXBBMSSefaKP9CR0OKnQAIeDUod.jpg', '2025-01-29 09:18:23', '2025-02-06 14:42:06'),
(2, 'HIGHER TRIGONOMETRY', 'HIGHER TRIGONOMETRY is a english book by author B. C. Das and B. N. Mukherjee. This book is published in year 1933 and contains 334 pages.', 'B. C. Das and B. N. Mukherjee', 'U. N. Dhur & Sons Pvt. Ltd.', NULL, '34th', '9789380673837', 334, 'Mathematics', 7, 5, 'books/i6XWcVMkdhu02BSE4AZeqtbdGMKw8NrT1jW7KdXI.jpg', '2025-01-29 09:22:38', '2025-02-06 14:51:04'),
(3, 'Computer Fundamentals', 'A book about computer fundamentals.', 'P.K. Sinha', 'BPB Publications', '2003-01-01', '8th', '9788176567527', 404, 'CSE', 3, 1, 'books/2B3YqlKcoMRvIJwZxi4zxEO280YPnpS5Ic4I0Yn6.jpg', '2025-01-29 09:26:26', '2025-02-02 08:41:50'),
(4, 'Programming in ANSI C', 'Designed to meet the needs of first-time learners and lifelong enthusiasts alike, this book invites readers to embark on a comprehensive journey through the world of C programming. Continuing its legacy as a bestseller, this edition offers a structured approach, guiding readers from basic to advanced concepts.', 'E Balagurusamy', 'McGraw Hill', '2024-07-11', '9th', '9789355326720', 632, 'Programming', 10, 7, 'books/q9q3tcLjWp9V50cyRCNW6hM69LkrLacL4WYjgXkD.jpg', '2025-01-29 09:30:27', '2025-02-07 15:51:00'),
(5, 'Fundamentals of Electrical Engineering and Electronics', '“Fundamentals of Electrical Engineering and Electronics” is a useful book for undergraduate students of electrical engineering and electronics as well as B.Sc. Electronics. The book discusses concepts such as Network Analysis, Capacitance, Electromagnetic Induction, Motors Circuits and Diodes in an easy to relate and thereby understand manner.\r\nDesigned in accordance with the syllabi of most major universities, the book is an essential resource for anyone aspiring to learn the fundamentals and teaches students much about the subject itself.', 'BL Theraja', 'Schand', '2006-06-10', NULL, NULL, 450, 'EEE', 3, 1, 'books/R1v3DyDGjxmNTDVOUbr1lloIDXi1411WSVfTsQ8N.jpg', '2025-01-29 09:35:25', '2025-02-11 07:58:16'),
(6, 'Data Structures', 'Data Structures (SIE) True to the ideology of the Schaums Outlines, the present version of this book includes the discussion on basics of data structures supplemented with solved examples and programming problems. The classic and popular text is back with refreshed pedagogy and programming problems helps the students to have an upper hand on the practical understanding of the subject.', 'Seymour Lipschutz', 'McGraw-Hill', NULL, NULL, '9780070601680', 345, 'CSE', 6, 4, 'books/te60cHXtXp6VKNNrc3cpwtajmdGWxhKMtTm8xe1B.jpg', '2025-01-29 09:38:31', '2025-02-11 07:58:21'),
(7, 'Basic Electronics', NULL, 'B.L. Theraja', 'S CHAND', NULL, NULL, '9788121925556', 643, 'EEE', 3, 2, 'books/wNYHv4a5dBQkTQCnBjoNMlRr8oIq1Bi9iNeaEtod.jpg', '2025-01-29 09:41:54', '2025-02-04 18:26:23'),
(8, 'Object Oriented Programming with C++', 'The bestseller book in now available for his readers in its new multicolor avatar. The revised edition maintains its simplicity and lucid presentation of Object Oriented C++ concepts thus an ideal for novices. It extensively covers all the important topics like- overloading, abstract classes, typecasting, dynamic memory allocation.', 'E Balagurusamy', 'Tata McGraw Hill Education Private Limited', '2013-05-20', '6th', '9789383286508', 562, 'Programming', 6, 6, 'books/w5otgEsXgz4TQU514tIwwKneJveSeaf9om8EocVX.jpg', '2025-01-29 09:47:49', '2025-02-02 14:42:17'),
(9, 'DIFFERENTIAL CALCULUS', 'DIFFERENTIAL CALCULUS is a english book by author B. C. Das and B. N. Mukherjee. This book is published in year 1949 and contains 648 pages.', 'B. C. Das and B. N. Mukherjee', 'U. N. Dhur & Sons Pvt. Ltd.', '1949-01-01', '55th', '9789380673875', 648, 'Mathematics', 7, 6, 'books/I4eFlTwBHxcJffLwOeeEHoyzcJeCuycpBOmS7DR7.jpg', '2025-01-29 09:52:04', '2025-01-30 20:11:45'),
(10, 'INTEGRAL CALCULUS - DIFFERENTIAL EQUATIONS', 'INTEGRAL CALCULUS - DIFFERENTIAL EQUATIONS is a english book by author B. C. Das and B. N. Mukherjee. This book is published in year 1938 and contains 664 pages.', 'B. C. Das and B. N. Mukherjee', 'U. N. Dhur & Sons Pvt. Ltd.', '1938-01-01', '57th', '9789380673882', 664, 'Mathematics', 8, 7, 'books/P58ybgeFIlz9jthKaveHt7hi5G9mMfdvnUV3GTpl.jpg', '2025-01-29 09:55:26', '2025-02-04 18:26:30'),
(11, 'Database System Concepts', 'Database System Concepts by Silberschatz, Korth and Sudarshan is now in its 6th edition and is one of the cornerstone texts of database education. It presents the fundamental concepts of database management in an intuitive manner geared toward allowing students to begin working with databases as quickly as possible.\r\nThe text is designed for a first course in databases at the junior/senior undergraduate level or the first year graduate level. It also contains additional material that can be used as supplements or as introductory material for an advanced course. Because the authors present concepts as intuitive descriptions, a familiarity with basic data structures, computer organization, and a high-level programming language are the only prerequisites. Important theoretical results are covered, but formal proofs are omitted. In place of proofs, figures and examples are used to suggest why a result is true.', 'Korth and Silverchatz', 'McGraw Hill', '2010-01-27', '6th', '0073523321', 1376, 'Database', 10, 10, 'books/MulWNT7QjNXK62YbsJ2a4h9x091xNskBoyRE6nNj.jpg', '2025-02-01 11:18:57', '2025-02-01 11:18:57'),
(12, 'Introduction to Algorithms', 'This internationally acclaimed textbook provides a comprehensive introduction to the modern study of computer algorithms. It covers a broad range of algorithms in depth, yet makes their design and analysis accessible to all levels of readers. Each chapter is relatively self-contained and presents an algorithm, a design technique, an application area, or a related topic. The algorithms are described and designed in a manner to be readable by anyone who has done a little programming. The explanations have been kept elementary without sacrificing depth of coverage or mathematical rigor.', 'Cormen, Thomas H., Leiserson, Charles E.', 'PHI Learning Pvt. Ltd.', '2010-02-02', '3rd', '9788120340077', 1312, 'Programming', 9, 9, 'books/uF5UoiGEppkIrCRElNnhbM5Fc8GSNFfqlTb5dDw3.jpg', '2025-02-01 11:20:13', '2025-02-01 11:20:13'),
(13, 'Operating System Concepts', 'Operating System Concepts, now in its ninth edition, continues to provide a solid theoretical foundation for understanding operating systems. The ninth edition has been thoroughly updated to include contemporary examples of how operating systems function. The text includes content to bridge the gap between concepts and actual implementations. End-of-chapter problems, exercises, review questions, and programming exercises help to further reinforce important concepts.  A new Virtual Machine provides interactive exercises to help engage students with the material.', 'Silberschatz and Galvin', 'Wiley', '2012-12-17', '9th', '1118063333', NULL, 'CSE', 6, 6, 'books/AbcUoujdi3ti8TXTmLFAwaJCsNaHjaju4RIzOuSt.jpg', '2025-02-01 11:22:44', '2025-02-01 11:22:44'),
(14, 'Assembly Language Programming and Organization of the IBM PC, McGraw-Hill', 'This introduction to the organization and programming of the 8086 family of microprocessors used in IBM microcomputers and compatibles is comprehensive and thorough. Includes coverage of I/O control, video/graphics control, text display, and OS/2. Strong pedagogy with numerous sample programs illustrates practical examples of structured programming.', 'Ytha Yu and CharlersMarut', 'McGraw-Hill/Irwin', '1992-02-01', '1st', '0070726922', 560, 'Programming', 9, 8, 'books/LLRwZRfEXBNRFpFCRUazWQHNcFgrM0JJdHUSnDOJ.jpg', '2025-02-01 11:26:50', '2025-02-06 15:48:19'),
(15, 'Data Communications and Networking', 'Data Communications and Networking is designed to help students understand the basics of data communications and networking, and the protocols used in the Internet in particular by using the protocol layering of the Internet and TCP/IP protocol suite. Technologies related to data communication and networking may be the fastest growing in today\'s culture. The appearance of some new social networking applications is a testimony to this claim. In this Internet-oriented society, specialists need to be trained to run and manage the Internet, part of the Internet, or an organization\'s network that is connected to the Internet. As both the number and types of students are increasing, it is essential to have a textbook that provides coverage of the latest advances, while presenting the material in a way that is accessible to students with little or no background in the field.\r\nUsing a bottom-up approach, Data Communications and Networking presents this highly technical subject matter without relying on complex formulas by using a strong pedagogical approach supported by more than 830 figures. Now in its Fifth Edition, this textbook brings the beginning student right to the forefront of the latest advances in the field, while presenting the fundamentals in a clear, straightforward manner. Students will find better coverage, improved figures and better explanations on cutting-edge material. The \"bottom-up\" approach allows instructors to cover the material in one course, rather than having separate courses on data communications and networking.', 'Behrouz A. Forouzan', 'McGraw Hill', '2012-02-17', '5th', '0073376221', 1264, 'CSE', 12, 12, 'books/KUsq8etoHbJviQ0zdv4yN42gouLNiqgGqFq2T0OP.jpg', '2025-02-01 11:30:39', '2025-02-01 11:30:39'),
(16, 'Digital Systems: Principles And Applications', 'Tocci and Widmer use a block diagram approach to basic logic operations, enabling readers to have a firm understanding of logic principles before they study the electrical characteristics of the logic ICs. KEY TOPICS For each new device or circuit, the authors describe the principle of the operation, give thorough examples, and then show its actual application. An excellent reference on modern digital systems.', 'Ronald J. Tocci, Neal Widmer', NULL, '2009-01-01', '10th', NULL, 940, 'EEE', 4, 4, 'books/OJ3CVT7blNn6BibGL33oueNalWnA27vK7fkCrN7M.jpg', '2025-02-01 11:44:05', '2025-02-01 11:44:05'),
(17, 'Complex Variables', 'Murray R. Spiegel’s Complex Variables is a classic textbook in the Schaum’s Outline Series, offering a clear and concise introduction to the fundamentals of complex analysis. Designed for students of mathematics, engineering, and physics, this book covers essential topics such as complex numbers, analytic functions, contour integration, conformal mapping, and applications of residue theory.\r\n\r\nWhat sets this book apart is its problem-solving approach, featuring over 300 fully solved problems and numerous supplementary exercises to reinforce key concepts. Spiegel’s systematic explanations, step-by-step derivations, and practical examples make complex analysis accessible, even to those new to the subject.\r\n\r\nWhether used as a standalone textbook or as a supplement to a formal course, Complex Variables provides a solid foundation in complex function theory, helping students develop a strong grasp of the subject with clarity and efficiency.', 'Murray R. Spiegel', 'McGraw-Hill Education', '2009-01-01', '2nd', '0070990107', 384, 'Mathematics', 10, 10, 'books/Dl1kE99UYBfGO3jEpHcMEDn2pL6YfgylgT8Xvosr.jpg', '2025-02-01 11:44:31', '2025-02-01 11:44:31'),
(18, 'Computer Architecture and Organization', 'The third edition of Computer Architecture and Organization features a comprehensive updating of the material-especially case studies, worked examples, and problem sets-while retaining the book\'s time-proven emphasis on basic prinicples. Reflecting the dramatic changes in computer technology that have taken place over the last decade, the treatment of performance-related topics such as pipelines, caches, and RISC\'s has been expanded. Many examples and end-of-chapter problems have also been added.', 'John P. Hayes', 'William C Brown Pub', '1997-12-01', '3rd', '9780070273559', 624, 'CSE', 12, 11, 'books/FkotpLwUQAt26sFZTqq237qDrXQixFrVX4g8yoks.jpg', '2025-02-01 11:48:19', '2025-02-02 08:41:31'),
(20, 'HAND BOOK OF ELECTRONICS', 'This is a book about \"HAND BOOK OF ELECTRONICS\".', 'Kumar Gupta', 'PRAGATI PRAKASHAN', '2016-01-01', NULL, '9789386306012', 1730, 'EEE', 6, 5, 'books/X2yoygDHOaUwZvY6GWjibQUViFHNhqXmOGE50erW.jpg', '2025-02-01 11:53:04', '2025-02-11 07:58:39'),
(21, 'Computer Graphics', 'A complete update of a bestselling introduction to computer graphics, this volume explores current computer graphics hardware and software systems, current graphics techniques, and current graphics applications. Includes expanded coverage of algorithms, applications, 3-D modeling and rendering, and new topics such as distributed ray tracing, radiosity, physically based modeling, and visualization techniques.', 'Donald Hearn and Paullin Baker', 'Prentice Hall Next', '1994-01-01', '1st', '0131615300', 652, 'CSE', 10, 10, 'books/cEhP7BW4OfOKz2gwQDSbtblsF5LyLle4WOZNnt3R.jpg', '2025-02-01 11:54:55', '2025-02-01 11:54:55'),
(22, 'Microcomputer Interfacing', 'Microcomputer Interfacing is a comprehensive guide that explores the principles and techniques involved in connecting microcomputers with external devices. This book covers essential topics such as digital and analog interfacing, communication protocols, peripheral device control, memory expansion, and real-world applications.\r\n\r\nDesigned for students, engineers, and hobbyists, the book provides detailed explanations, practical examples, and circuit diagrams to help readers understand how microcomputers interact with sensors, displays, storage devices, and other hardware components. Emphasizing both hardware and software aspects, it introduces programming techniques for effective interfacing.\r\n\r\nWhether you are working with embedded systems, industrial automation, or custom computing solutions, Microcomputer Interfacing serves as a valuable resource for mastering the fundamentals of interfacing technology.', 'Bruce A. Artwick', 'Prentice Hall', '1980-01-01', '1st', '0135809029', 320, 'CSE', 9, 9, 'books/DimyE0IAQyF9bNsiN3TTMQMdya9FUOE9aoqOzPXX.jpg', '2025-02-01 11:58:59', '2025-02-01 11:58:59'),
(23, 'Simulation Modeling and Analysis', 'Comprehensive, state-of-the-art coverage of every important simulation technique\r\n\r\nThis fully-revised book has the most comprehensive and up-to-date coverage of all aspects of a simulation study. Equally well suited for use in university courses, simulation practice, and self-study, the book offers clear and intuitive explanations as well as 300 figures, 218 examples, and 217 problems. You will get detailed discussions on modeling and simulation, simulation software, model verification and validation, input modeling, random-number and variate generation, statistical design and analysis of simulation experiments, experimental design, simulation optimization, agent-based simulation, machine learning, and much more.\r\n\r\nAuthored by an operations research analyst and industrial engineer with more than 40 years of experience, Simulation Modeling and Analysis is widely regarded as the “bible” of simulation and now has more than 178,000 copies in print and 23,700 citations. This sixth edition has been streamlined, with several chapters downsized to eliminate outdated simulation programs or statistical techniques that are rarely used in practice and are unnecessarily complicated. Most analyses of simulation output data can now be done using three simple and familiar statistical formulas or expressions. A new chapter covers AI and machine learning and their application to simulation.\r\n\r\nCovers what are arguably the three most-innovative and popular simulation-software packages: AnyLogic, FlexSim, and Simio\r\nIncludes a set of instructor’s resources\r\nHas been used at universities such as University of California-Berkeley, Stanford, Georgia Tech, Michigan, Cornell, Purdue, Virginia Tech, Penn State, Wisconsin, Columbia, Texas A&M, Washington, and Johns Hopkins\r\nWritten by a world-class expert in the field and an experienced educator who has presented more than 550 simulation and statistics short courses in 20 countries.', 'Averill M. Law', 'McGraw Hill', '2024-02-13', '6th', '1264268246', 688, 'CSE', 10, 10, 'books/dYhA3qKSbegBWBcRkJ1G3zXmb9EhvbcGP5EOKTfC.jpg', '2025-02-01 12:03:48', '2025-02-01 12:03:48'),
(24, 'INTERNET & WORLD WIDE WEB HOW TO PROGRAM', 'This is a book about INTERNET & WORLD WIDE WEB HOW TO PROGRAM.', 'Deitel', NULL, '2005-01-01', '5th', '9788177582390', 365, 'Programming', 5, 5, 'books/KsvfMdb2uLB1zmD4DyO7A81HZLqYnzJdHhJxO6en.jpg', '2025-02-01 12:05:17', '2025-02-01 12:05:17'),
(25, 'Numerical Methods', 'This book contains topics about Numerical Methods.', 'E Balagurusamy', 'Mc Graw Hill India', '2010-01-01', NULL, '9780074633113', 244, 'Mathematics', 8, 8, 'books/Akq6wFEdUu7nNg1nYWWVNs0MrF8rUU82f8itcYy7.jpg', '2025-02-01 12:10:31', '2025-02-04 18:44:21'),
(26, 'Statistics for Engineers: An Introduction', 'This practical text is an essential source of information for those wanting to know how to deal with the variability that exists in every engineering situation. Using typical engineering data, it presents the basic statistical methods that are relevant, in simple numerical terms. In addition, statistical terminology is translated into basic English.In the past, a lack of communication between engineers and statisticians, coupled with poor practical skills in quality management and statistical engineering, was damaging to products and to the economy.', 'Jim Morrison', 'Wiley-Blackwell', '2009-06-19', NULL, NULL, 463, 'Mathematics', 4, 4, 'books/ZPiobT0IRMEZCnKJ2Tzpv9G4GUf4VszlHqhePvcf.jpg', '2025-02-01 12:13:12', '2025-02-01 12:13:12'),
(27, 'Introduction to Automata, Theory, Languages and Computation', 'It has been more than 20 years since this classic book on formal languages, automata theory, and computational complexity was first published. With this long-awaited revision, the authors continue to present the theory in a concise and straightforward manner, now with an eye out for the practical applications. They have revised this book to make it more accessible to today\'s students, including the addition of more material on writing proofs, more figures and pictures to convey ideas, side-boxes to highlight other interesting material, and a less formal writing style. Exercises at the end of each chapter, including some new, easier exercises, help readers confirm and enhance their understanding of the material.', 'John E. Hopcroft , Jeffrey D. Ullman , Rotwani , Rajeev Motwani', 'Addison-Wesley', '2000-01-01', '2nd', '0201441241', 521, 'CSE', 4, 4, 'books/9XcEH6F6JbXZWBm8DEim1ZlIkiHmkKU2ccl5piJT.jpg', '2025-02-01 12:17:09', '2025-02-01 12:17:09'),
(28, 'Fundamentals of Multimedia', 'This book offers introductory-to-advanced material on all major aspects of multimedia, including pointers to current links for information and demos at the most advanced level, to form a complete reference. Topics covered include introduction to multimedia, graphics/image data representations, color models in images and video, basics of digital audio, lossy compression, image compression standards, basic video compression techniques, basic audio compression techniques, multimedia networks, and more. For professionals involved in Computer-Aided Engineering, Computer Systems Organization, Computer-Communication Networks, Computing Methodologies, Coding and Information Theory, or anyone interested in a good reference on current multimedia technologies.', 'Ze-Nian Li and Mark S. Drew:', 'Prentice Hall', '2003-01-01', '1st', '0130618721', 576, 'CSE', 8, 8, 'books/UsUUm34fGSeXlTUCK5nSw8NOZssXBpnnVR4FXDAq.jpg', '2025-02-01 12:21:08', '2025-02-01 12:21:08'),
(29, 'Machine Learning', 'While machine learning expertise doesn’t quite mean you can create your own Turing Test-proof android―as in the movie Ex Machina―it is a form of artificial intelligence and one of the most exciting technological means of identifying opportunities and solving problems fast and on a large scale. Anyone who masters the principles of machine learning is mastering a big part of our tech future and opening up incredible new directions in careers that include fraud detection, optimizing search results, serving real-time ads, credit-scoring, building accurate and sophisticated pricing models―and way, way more.', 'John Paul Mueller, Luca Massaron', 'For Dummies', '2021-02-09', '2nd', '9781119724018', 464, 'Machine Learning', 7, 7, 'books/QVeR38oNO5yvPfz2DHg9mVUMWT2ifOxemQVTLU4x.jpg', '2025-02-01 12:22:38', '2025-02-01 12:22:38'),
(31, 'An Introduction to Neural Computing', 'An Introduction to Neural Computing has been updated to include new areas of application for neural networks which include neurocontrol and financial forecasting; a description of commercial and industrial projects - data mining, condition monitoring, neuroforecasting, process monitoring and pattern analysis; a revised chapter on the \'weightless\' or \'lookup\' neural network and a new chapter on the latest research including a discussion of the introduction of intentionality into computing through neural systems and a research programme, \'artificial consciousness.\'', 'Igor Aleksander and Helen Morton', 'Chapman & Hall', '1990-01-01', '1st', '0412377802', 240, 'Machine Learning', 10, 9, 'books/MF1WLWtGGdS9aXZq7awaJ5Pi5vAy9nXWoyQATZ8f.jpg', '2025-02-01 12:35:04', '2025-02-02 08:41:58'),
(32, 'Data Communications and Computer Networks', 'Data and Computer Communications, 10e, is a two-time winner of the best Computer Science and Engineering textbook of the year award from the Textbook and Academic Authors Association. It is ideal for one/two-semester courses in Computer Networks, Data Communications, and Communications Networks in CS, CIS, and Electrical Engineering departments. This book is also suitable for Product Development personnel, Programmers, Systems Engineers, Network Designers and others involved in the design of data communications and networking products.\r\n\r\nWith a focus on the most current technology and a convenient modular format, this best-selling text offers a clear and comprehensive survey of the entire data and computer communications field. Emphasizing both the fundamental principles as well as the critical role of performance in driving protocol and network design, it explores in detail all the critical technical areas in data communications, wide-area networking, local area networking, and protocol design.', 'William Stallings', 'Pearson', '2013-09-13', '10th', '0133506487', 912, 'CSE', 11, 11, 'books/EgMaeJl5DUZnp6uq4LMAzAicm8jeBR6PAucR7KBS.jpg', '2025-02-01 12:40:42', '2025-02-01 12:40:42'),
(33, 'Discrete Time Signal Processing', 'Discrete-Time Signal Processing, Third Edition is the definitive, authoritative text on DSP – ideal for those with introductory-level knowledge of signals and systems. Written by prominent DSP pioneers, it provides thorough treatment of the fundamental theorems and properties of discrete-time linear systems, filtering, sampling, and discrete-time Fourier Analysis. By focusing on the general and universal concepts in discrete-time signal processing, it remains vital and relevant to the new challenges arising in the field.', 'Oppenheim & Schafer', 'Pearson', '2009-08-18', '3rd', '0131988425', 1144, 'CSE', 11, 11, 'books/uFQlQJaMbMHpELSLTjwxR9CmJfKx6PPPNCeIcnb2.jpg', '2025-02-01 12:44:33', '2025-02-01 12:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `borrow_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` date NOT NULL DEFAULT curdate(),
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `notify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`borrow_id`, `user_id`, `book_id`, `borrow_date`, `due_date`, `return_date`, `notify_date`) VALUES
(1, 6, 1, '2025-01-30', '2025-02-06', '2025-01-30', NULL),
(2, 6, 9, '2025-01-30', '2025-02-06', NULL, NULL),
(3, 6, 4, '2025-01-31', '2025-02-07', '2025-01-31', NULL),
(4, 12, 5, '2025-01-31', '2025-02-15', NULL, NULL),
(5, 11, 4, '2025-01-31', '2025-02-07', NULL, NULL),
(6, 11, 8, '2025-01-31', '2025-02-07', '2025-01-31', NULL),
(7, 11, 3, '2025-01-31', '2025-02-01', NULL, NULL),
(8, 13, 6, '2025-02-01', '2025-02-08', '2025-02-07', NULL),
(10, 6, 18, '2025-02-02', '2025-02-09', NULL, NULL),
(11, 11, 1, '2025-02-02', '2025-02-09', NULL, NULL),
(12, 6, 3, '2025-02-02', '2025-02-09', NULL, NULL),
(13, 6, 31, '2025-02-02', '2025-02-09', NULL, NULL),
(14, 6, 5, '2025-02-02', '2025-02-09', '2025-02-11', NULL),
(15, 6, 8, '2025-02-02', '2025-02-09', '2025-02-02', NULL),
(16, 6, 6, '2025-02-02', '2025-02-25', '2025-02-11', NULL),
(17, 6, 25, '2025-02-04', '2025-02-11', '2025-02-04', NULL),
(20, 12, 6, '2025-02-04', '2025-02-11', NULL, NULL),
(21, 12, 7, '2025-02-04', '2025-02-11', NULL, NULL),
(22, 12, 10, '2025-02-04', '2025-02-11', NULL, NULL),
(23, 11, 2, '2025-02-04', '2025-02-11', NULL, NULL),
(26, 12, 5, '2025-02-06', '2025-02-13', NULL, NULL),
(27, 12, 2, '2025-02-06', '2025-02-13', NULL, NULL),
(28, 7, 6, '2025-02-06', '2025-02-13', NULL, NULL),
(29, 7, 14, '2025-02-06', '2025-02-13', NULL, NULL),
(30, 13, 4, '2025-02-07', '2025-02-14', NULL, NULL),
(31, 6, 20, '2025-02-11', '2025-02-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_requests`
--

CREATE TABLE `borrow_requests` (
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `request_date` date NOT NULL DEFAULT curdate(),
  `is_notified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_requests`
--

INSERT INTO `borrow_requests` (`request_id`, `user_id`, `book_id`, `request_date`, `is_notified`) VALUES
(69, 12, 8, '2025-01-31', 0),
(76, 12, 9, '2025-01-31', 0),
(81, 11, 5, '2025-01-31', 0),
(129, 6, 29, '2025-02-04', 0),
(132, 6, 4, '2025-02-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_verification_tokens`
--

CREATE TABLE `email_verification_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_verification_tokens`
--

INSERT INTO `email_verification_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', 'L4rwrqH9HijUQf5ZsH1ei7FMb3E56UchlgJM62Ob5U0SYZijEkFJ8NN7PFmX', '2025-02-11 01:50:10'),
('sjnry24@gmail.com', 'p7Kdj0FVBhHzpYeAriczc7vsOvPPPWw29qlzlHgEgWszEUVTKdrhh52MOn2H', '2025-02-12 14:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2024_10_27_201845_create_users_table', 1),
(6, '2024_10_28_035647_create_sessions_table', 1),
(9, '2025_01_23_105317_create_books_table', 2),
(10, '2025_01_29_082121_create_borrow_requests_table', 3),
(12, '2025_01_29_090033_create_borrowed_books_table', 4),
(13, '2025_02_07_060026_create_password_resets_table', 5),
(15, '2025_02_09_114103_create_email_verification_tokens_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('s0tu6SK1rcfx0JXWqr8RBJLi94a3xQeazXFGwAsL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiempzNHNMdnQyMUIyVjdINEI5WFkzRFBFVmNDMlhhcjdOVEhNVE5YdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hbGwtYm9va3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7TjtzOjQ6InVzZXIiO086MTU6IkFwcFxNb2RlbHNcVXNlciI6MzI6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToidXNlcnMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxNDp7czo3OiJ1c2VyX2lkIjtpOjY7czo0OiJuYW1lIjtzOjE4OiJNZC4gTmF6bXVsIEhvc3NhaW4iO3M6NToidGl0bGUiO047czoxOToicmVnaXN0cmF0aW9uX251bWJlciI7czo3OiIxODE0MDIxIjtzOjc6InNlc3Npb24iO3M6OToiMjAxOC0yMDE5IjtzOjU6ImVtYWlsIjtzOjI1OiJtZG5hem11bGhvc3NhaW5AZ21haWwuY29tIjtzOjg6InVzZXJuYW1lIjtzOjIyOiJtZG5hem11bGhvc3NhaW4xODE0MDIxIjtzOjEyOiJwaG9uZV9udW1iZXIiO3M6MTE6IjAxOTQxMTAxODg4IjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkblBWd01IR2pzV1ZHRmVXTXlXNDU1T1kxZ1o3QTUzZWlRbzU1WHpUL204TlBMMmVFWlhYdWEiO3M6NToiaW1hZ2UiO3M6NTE6InBob3Rvcy9rdlNJTUQ0MVBHa2ZlV1BkVkZaVmpycXVtTk1naGlMeFJmRlo0WXlHLmpwZyI7czo5OiJ1c2VyX3R5cGUiO3M6NzoiU3R1ZGVudCI7czo2OiJzdGF0dXMiO3M6ODoiQXBwcm92ZWQiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjQtMTAtMjggMTU6Mjg6MDYiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDEtMjggMDY6MjQ6MTciO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNDp7czo3OiJ1c2VyX2lkIjtpOjY7czo0OiJuYW1lIjtzOjE4OiJNZC4gTmF6bXVsIEhvc3NhaW4iO3M6NToidGl0bGUiO047czoxOToicmVnaXN0cmF0aW9uX251bWJlciI7czo3OiIxODE0MDIxIjtzOjc6InNlc3Npb24iO3M6OToiMjAxOC0yMDE5IjtzOjU6ImVtYWlsIjtzOjI1OiJtZG5hem11bGhvc3NhaW5AZ21haWwuY29tIjtzOjg6InVzZXJuYW1lIjtzOjIyOiJtZG5hem11bGhvc3NhaW4xODE0MDIxIjtzOjEyOiJwaG9uZV9udW1iZXIiO3M6MTE6IjAxOTQxMTAxODg4IjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkblBWd01IR2pzV1ZHRmVXTXlXNDU1T1kxZ1o3QTUzZWlRbzU1WHpUL204TlBMMmVFWlhYdWEiO3M6NToiaW1hZ2UiO3M6NTE6InBob3Rvcy9rdlNJTUQ0MVBHa2ZlV1BkVkZaVmpycXVtTk1naGlMeFJmRlo0WXlHLmpwZyI7czo5OiJ1c2VyX3R5cGUiO3M6NzoiU3R1ZGVudCI7czo2OiJzdGF0dXMiO3M6ODoiQXBwcm92ZWQiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjQtMTAtMjggMTU6Mjg6MDYiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDEtMjggMDY6MjQ6MTciO31zOjEwOiIAKgBjaGFuZ2VzIjthOjA6e31zOjg6IgAqAGNhc3RzIjthOjI6e3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtzOjg6ImRhdGV0aW1lIjtzOjg6InBhc3N3b3JkIjtzOjY6Imhhc2hlZCI7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YToyOntpOjA7czo4OiJwYXNzd29yZCI7aToxO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6Mzp7aTowO3M6NDoibmFtZSI7aToxO3M6NToiZW1haWwiO2k6MjtzOjg6InBhc3N3b3JkIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czoxOToiACoAYXV0aFBhc3N3b3JkTmFtZSI7czo4OiJwYXNzd29yZCI7czoyMDoiACoAcmVtZW1iZXJUb2tlbk5hbWUiO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjt9fQ==', 1738168895);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `registration_number` varchar(20) DEFAULT NULL,
  `session` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_type` enum('Admin','Teacher','Student') NOT NULL,
  `status` enum('Pending','Approved') NOT NULL DEFAULT 'Pending',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `title`, `registration_number`, `session`, `email`, `username`, `phone_number`, `password`, `image`, `user_type`, `status`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(5, 'Admin', 'Librarian', NULL, NULL, 'admin@gmail.com', 'admin', '01300000000', '$2y$12$228CvmdxbfV7imYuFQh4HuJxfDS6cqf7tjrH5IOgdaV1Jkgf9dlBK', 'photos/MPjfxc7MUVUh4WSx7zpxllDGkVG862mpiqRtYPfN.png', 'Admin', 'Approved', '2025-02-10 14:36:24', '2024-10-28 02:38:11', '2025-02-11 04:39:44'),
(6, 'Md. Nazmul Hossain', NULL, '1814021', '2018-2019', 'mdnazmulhossin999@gmail.com', 'mdnazmulhossain1814021', '01941101888', '$2y$12$5QuwpnFMzlN4WEumQeW6KufF6koZMzIdA8gJBrKbaAkjXuaskphhK', 'photos/oWVvEMZwAXkNQrHXjeAT0ouGv7fdyas9EFTypUOA.jpg', 'Student', 'Approved', '2025-02-10 14:36:24', '2024-10-28 09:28:06', '2025-02-12 07:41:46'),
(7, 'Md. Mojahidul Islam', 'Associate Professor', '140270', NULL, 'mdmojahidulislam@gmail.com', 'mdmojahidulislam140270', '01914778500', '$2y$12$1lxZmAsednvDZxNSVTJkO.55xI8NHqutwNldHn6JURpuajkMAaYV6', 'photos/l8xa3NQffSXile78Lz6O2BTY6nXrfa2IZd62ZEpX.jpg', 'Teacher', 'Approved', NULL, '2024-10-28 10:06:01', '2024-10-28 10:06:01'),
(11, 'Fazle Rabbi Sarker', NULL, '1814039', '2018-2019', 'fazlerabbisarker71@gmail.com', 'fazlerabbisarker711814039', '01749755694', '$2y$12$d/Oj0oscvtp4VX90dW7H3uClBa.IZOY5ERjplXxSU6Aj/erBXFZZ2', 'photos/tNGElypfTiV7ymhWcir8OfTOaneY2RKsGqR7LtGf.jpg', 'Student', 'Approved', NULL, '2025-01-31 00:30:26', '2025-01-31 00:30:26'),
(12, 'ABDULLA-AL-MAHMOD', NULL, '1814017', '2018-2019', 'abdullah1814017@gmail.com', 'abdullah18140171814017', '01763342051', '$2y$12$iPyg2UI1oNfjpUZWBXuwuu6l9/kjJ7qNOiRd4b8LbespMqpcyqwyO', 'photos/7Oi15y1VLFEu8HV54VEI7ntw963Se18UmdAMvvps.png', 'Student', 'Approved', NULL, '2025-01-31 00:31:14', '2025-01-31 00:31:14'),
(13, 'Rabbani Islam Refat', NULL, '1814025', '2018-2019', 'refatr62@gmail.com', 'refatr621814025', '01572914977', '$2y$12$Jdaqmdx0.HQw7v.iUVUy.ehjnUaqbvO6IsxRRxAhSGhuHW4LYsi/K', 'photos/ICzu0Q4kChZKtWbqfJ0EazUnE84RooPPtKQaUcMK.jpg', 'Student', 'Approved', NULL, '2025-02-01 09:48:32', '2025-02-01 09:48:32'),
(15, 'Md. Saydur Rahman', NULL, '1814053', '2018-2019', 'saydurrsayeed@gmail.com', 'saydurrsayeed1814053', '01762131163', '$2y$12$Dwg9hy803qNV0Zci1JKgre..8HNC6iJ0dafZUMN66B4aBCh/iKgGi', 'photos/cmlMpzfux2P9k21NbeQGin7r6CClOh5UdH3xOgbL.jpg', 'Student', 'Pending', NULL, '2025-02-05 09:16:37', '2025-02-05 09:16:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `books_book_id_index` (`book_id`),
  ADD KEY `books_author_index` (`author`),
  ADD KEY `books_title_index` (`title`),
  ADD KEY `books_publisher_index` (`publisher`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `borrowed_books_user_id_foreign` (`user_id`),
  ADD KEY `borrowed_books_book_id_foreign` (`book_id`);

--
-- Indexes for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `borrow_requests_user_id_foreign` (`user_id`),
  ADD KEY `borrow_requests_book_id_foreign` (`book_id`);

--
-- Indexes for table `email_verification_tokens`
--
ALTER TABLE `email_verification_tokens`
  ADD KEY `email_verification_tokens_email_index` (`email`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_registration_number_index` (`registration_number`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_user_type_index` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `borrow_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  MODIFY `request_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowed_books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  ADD CONSTRAINT `borrow_requests_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrow_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
