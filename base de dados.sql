-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01-Mar-2017 às 17:11
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itv`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `video` int(11) NOT NULL,
  `texto` varchar(500) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `user`, `video`, `texto`, `data`) VALUES
(1, 2, 0, 'OlÃ¡', '2017-03-01 11:51:51'),
(2, 2, 2, 'OlÃ¡', '2017-03-01 11:52:41'),
(3, 2, 2, 'shfhwgfb', '2017-03-01 11:53:56'),
(4, 2, 2, 'jhvbjndjlbffhkfbkvhkfukjdfdddjfbdnfjdfbdjf', '2017-03-01 11:54:19'),
(5, 2, 2, 'nashwvqwhfkbshkvgbkksfb', '2017-03-01 11:54:59'),
(6, 2, 2, 'HKbwvfhjwrgvqiwhrgvlhkw', '2017-03-01 12:00:37'),
(7, 2, 2, 'Oi', '2017-03-01 14:11:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscritos`
--

CREATE TABLE `inscritos` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `conta` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inscritos`
--

INSERT INTO `inscritos` (`id`, `user`, `conta`, `data`) VALUES
(1, 2, 1, '2017-02-28 16:45:22'),
(2, 1, 2, '2017-02-28 16:45:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `imagem` text NOT NULL,
  `capa` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `password`, `imagem`, `capa`, `data`) VALUES
(1, 'Rodrigo', '7905d373cfab2e0fda04b9e7acc8c879', '053c273231f49b84967ac31897612cfbb88a9147', 'bg.jpeg', 'bg.jpeg', '2017-02-27 18:09:37'),
(2, 'Conta 1', '7905d373cfab2e0fda04b9e7acc8c879', '2e09bb0abb7189877013e00141357f39a14d0640', 'YouStream_Foto_103801imagem.jpg', 'YouStream_Foto_de_fundo_103801bg.jpeg', '2017-02-28 16:44:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `local` varchar(1000) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` text NOT NULL,
  `visualizacoes` int(11) NOT NULL,
  `user` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `videos`
--

INSERT INTO `videos` (`id`, `local`, `nome`, `descricao`, `imagem`, `visualizacoes`, `user`, `data`) VALUES
(1, 'video.mp4', 'Primeiro video', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed purus neque. Nam justo eros, porta non tortor in, finibus porttitor ante. Cras magna ipsum, lacinia ac justo eu, auctor mattis neque. Suspendisse ante augue, vulputate vitae ullamcorper in, euismod ac urna. Nulla a varius velit, quis fringilla mi. Nullam ac interdum sapien, ac maximus nulla. Praesent varius sodales lacus, id aliquam turpis consectetur ut. Donec ultricies tempor nisl, quis pulvinar nisl egestas at. Sed facilisis diam quis est pretium vestibulum. Curabitur in orci lacinia justo interdum gravida id ut leo. Praesent iaculis at turpis et imperdiet. Vestibulum vulputate ultricies lectus, id laoreet libero convallis sed. Vestibulum massa nibh, hendrerit id sapien auctor, semper pretium turpis.', 'bg.jpeg', 100, '1', '2017-03-01 11:30:49'),
(2, 'video.mp4', 'Primeiro video', 'bla bla bla', 'imagem.jpg', 1000000, '1', '2017-03-01 11:14:08'),
(3, 'video.mp4', 'Primeiro video', 'bla bla bla', 'bg.jpeg', 1000000, '1', '2017-03-01 11:14:10'),
(4, 'video.mp4', 'Primeiro video', 'bla bla bla', 'imagem.jpg', 1000000, '1', '2017-03-01 11:14:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inscritos`
--
ALTER TABLE `inscritos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `inscritos`
--
ALTER TABLE `inscritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
