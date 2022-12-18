-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: Mar 12, 2022 at 01:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `casas`
--

CREATE TABLE `casas` (
  `ID` int(11) NOT NULL,
  `Valor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `casas`
--

INSERT INTO `casas` (`ID`, `Valor`) VALUES
(1, 'Grupo Modelo'),
(3, 'Loba'),
(4, 'Colimita'),
(5, 'Barrilito'),
(6, 'Moctezuma');

-- --------------------------------------------------------

--
-- Table structure for table `cervezas`
--

CREATE TABLE `cervezas` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(31) NOT NULL,
  `Imagen` varchar(1023) NOT NULL,
  `Casa` varchar(31) NOT NULL,
  `Clasificacion` varchar(31) NOT NULL,
  `Tipo` varchar(31) NOT NULL,
  `Alcohol` decimal(4,1) NOT NULL,
  `Color` int(3) NOT NULL,
  `IBU` int(3) NOT NULL,
  `PH` decimal(2,1) NOT NULL,
  `Gas` varchar(10) NOT NULL,
  `Espesor` varchar(10) NOT NULL,
  `Viscocidad` varchar(10) NOT NULL,
  `Olor` varchar(10) NOT NULL,
  `Sabor` varchar(10) NOT NULL,
  `Retrogusto` varchar(10) NOT NULL,
  `Sensacion` varchar(255) NOT NULL,
  `Apariencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cervezas`
--

INSERT INTO `cervezas` (`ID`, `Nombre`, `Imagen`, `Casa`, `Clasificacion`, `Tipo`, `Alcohol`, `Color`, `IBU`, `PH`, `Gas`, `Espesor`, `Viscocidad`, `Olor`, `Sabor`, `Retrogusto`, `Sensacion`, `Apariencia`) VALUES
(1, 'Corona', 'corona.png', 'Grupo Modelo', 'Lager', 'Pilsener', '4.5', 6, 18, '4.4', 'Media', 'Baja', 'Nula', 'Baja', 'Media', 'Baja', 'Destacan sus ligeras notas afrutadas, resultado de la fermentación. En boca es moderadamente dulce y recuerda al sabor del cereal. Su amargor es limpio y ligero. Es una cerveza de cuerpo medio, fresca y equilibrada.', 'Cerveza clara y brillante, de espuma blanca y consistente.'),
(4, 'Victoria', 'victoria.jpg', 'Grupo Modelo', 'Lager', 'Vienna', '4.8', 8, 24, '4.2', 'Media', 'Nula', 'Nula', 'Media', 'Media', 'Media', 'Gaseosa y amarga.', 'Efervescente, color ámbar.'),
(20, 'Heineken', 'heineken.png', 'Loba', 'Ale', 'American Brown Ale', '5.5', 1, 45, '2.4', 'Nula', 'Baja', 'Media', 'Baja', 'Media', 'Baja', '', ''),
(21, 'XX', 'xx.png', 'Colimita', 'Ale', 'American Brown Ale', '5.1', 32, 18, '2.4', 'Nula', 'Baja', 'Media', 'Baja', 'Media', 'Baja', 'EDITAR', 'EDITAR'),
(22, 'Amstel', 'amstel.png', 'Colimita', 'Ale', 'American Brown Ale', '5.1', 32, 18, '2.4', 'Nula', 'Baja', 'Media', 'Baja', 'Media', 'Baja', 'Prueba2', 'Prueba2'),
(24, 'Ultra', 'ultra.png', 'Loba', 'Lager', 'American Light Lager', '5.1', 32, 18, '2.4', 'Nula', 'Baja', 'Media', 'Baja', 'Media', 'Baja', 'EDITAR', 'EDITAR'),
(30, 'FUNCIONAAAAA', '', 'Grupo Modelo', 'Ale', 'American Light Lager', '0.0', 21, 55, '3.0', 'Nula', 'Nula', 'Nula', 'Nula', 'Nula', 'Nula', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cervezas_ingredientes`
--

CREATE TABLE `cervezas_ingredientes` (
  `cervezaID` int(11) NOT NULL,
  `ingredienteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cervezas_ingredientes`
--

INSERT INTO `cervezas_ingredientes` (`cervezaID`, `ingredienteID`) VALUES
(1, 1),
(1, 2),
(4, 3),
(4, 4),
(30, 2),
(30, 3),
(30, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ingredientes`
--

CREATE TABLE `ingredientes` (
  `ID` int(11) NOT NULL,
  `Valor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredientes`
--

INSERT INTO `ingredientes` (`ID`, `Valor`) VALUES
(1, 'Malta'),
(2, 'Cebada'),
(3, 'Arroz'),
(4, 'Lúpulo'),
(6, 'Trigo');

-- --------------------------------------------------------

--
-- Table structure for table `resenias`
--

CREATE TABLE `resenias` (
  `ID` int(11) NOT NULL,
  `CervezaID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Estrellas` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resenias`
--

INSERT INTO `resenias` (`ID`, `CervezaID`, `Fecha`, `Estrellas`, `Descripcion`) VALUES
(1, 1, '2022-03-10', 5, 'Deliciosa y fresca, perfecta para disfrutar con amigos.'),
(2, 1, '2022-03-10', 4, 'Muy refrescante, pero el precio es un poco elevado.'),
(3, 4, '2022-03-09', 5, 'Excelente.'),
(4, 24, '2022-03-11', 5, 'La mejor cerveza ligera que he probado.');

-- --------------------------------------------------------

--
-- Table structure for table `tipos`
--

CREATE TABLE `tipos` (
  `ID` int(11) NOT NULL,
  `Valor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipos`
--

INSERT INTO `tipos` (`ID`, `Valor`) VALUES
(1, 'American Light Lager'),
(2, 'English Brown Ale'),
(3, 'American Brown Ale'),
(4, 'Pilsener'),
(5, 'Vienna'),
(6, 'Chile Ale'),
(7, 'Fruit'),
(8, 'Barley Wine'),
(9, 'Imperial Stout'),
(10, 'Bohemian Pilsener'),
(11, 'Irish Stout'),
(14, 'Blond Ale');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casas`
--
ALTER TABLE `casas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cervezas`
--
ALTER TABLE `cervezas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cervezas_ingredientes`
--
ALTER TABLE `cervezas_ingredientes`
  ADD PRIMARY KEY (`cervezaID`,`ingredienteID`),
  ADD KEY `cervezaID` (`cervezaID`),
  ADD KEY `ingredienteID` (`ingredienteID`);

--
-- Indexes for table `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `resenias`
--
ALTER TABLE `resenias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CervezaID` (`CervezaID`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `casas`
--
ALTER TABLE `casas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cervezas`
--
ALTER TABLE `cervezas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resenias`
--
ALTER TABLE `resenias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cervezas_ingredientes`
--
ALTER TABLE `cervezas_ingredientes`
  ADD CONSTRAINT `cervezas_ingredientes_ibfk_1` FOREIGN KEY (`cervezaID`) REFERENCES `cervezas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cervezas_ingredientes_ibfk_2` FOREIGN KEY (`ingredienteID`) REFERENCES `ingredientes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resenias`
--
ALTER TABLE `resenias`
  ADD CONSTRAINT `resenias_ibfk_1` FOREIGN KEY (`CervezaID`) REFERENCES `cervezas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
