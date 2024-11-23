-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2024 a las 22:08:16
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `visitantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `idColaborador` int(11) NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dui` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaContratacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`idColaborador`, `nombres`, `apellidos`, `dui`, `direccion`, `correo`, `celular`, `fechaNacimiento`, `fechaContratacion`) VALUES
(1, 'Eduardo', 'Henríquez', '05182525-9', 'Santa Tecla', 'eder_22_95@hotmail.com', '78067547', '1995-05-22', '2024-01-04'),
(2, 'Salvador', 'Hernández', '01234567-8', 'Santa Tecla', 'salvamarhernandez@gmail.com', '74102356', '2001-07-22', '2024-01-06'),
(6, 'Juan', 'Rivera', '02480248-6', 'Santa Tecla', 'juan@gmail.com', '77886644', '2005-05-29', '2024-01-07'),
(7, 'Marcela', 'Rivera', '01478523-6', 'Santa Tecla', 'marcela@gmail.com', '77441100', '1985-01-01', '2024-01-07'),
(8, 'Reina', 'Cañas', '00112233-4', 'Tecla', 'rich@gmail.com', '77889966', '1960-07-08', '2024-01-10'),
(9, 'Hilda', 'Hernández', '01478523-6', 'Santa Tecla', 'marhil@gmail.com', '77553300', '1960-08-07', '2024-01-16'),
(10, 'Majo', 'Orantes', '21548796-3', 'Santa Tecla', 'majo@gmail.com', '77993311', '2000-01-15', '2024-01-16'),
(11, 'María', 'García', '00134679-5', 'Soyapango', 'mariagarcia@gmail.com', '70809060', '1954-01-13', '2024-01-18'),
(12, 'Claudia', 'Ortiz', '04852369-0', 'San Salvador', 'claudiaortiz@gmail.com', '74852369', '1990-04-01', '2024-02-18'),
(13, 'Carlos', 'Lopez', '34567890-1', 'San Salvador, San Salvador Centro, San Salvador', 'carlos@ejemplo.com', '3456-7890', '1992-03-03', '2024-02-18'),
(14, 'Ana', 'Martínez', '45678901-2', 'San Salvador, San Salvador Centro, Ciudad Delgado', 'ana@ejemplo.com', '4567-8901', '1994-04-04', '2024-02-19'),
(15, 'Jose', 'Hernández', '56789012-3', 'San Salvador, San Salvador Centro, Cuscatancingo', 'jose@ejemplo.com', '5678-9012', '1995-05-05', '2024-02-26'),
(16, 'Lucía', 'Ramírez', '67890123-4', 'La Libertad, La Libertad Centro, Ciudad Arce', 'lucia@ejemplo.com', '6789-0123', '1996-06-06', '2024-02-26'),
(20, 'Sofía', 'Sánchez', '89012345-6', 'La Libertad, La Libertad Este, Nuevo Cuscatlán', 'sofia@ejemplo.com', '8901-2345', '1998-08-08', '2024-03-06'),
(21, 'Rosa', 'Díaz', '90123456-7', 'La Libertad, La Libertad Centro, San Juan Opico', 'rosa@ejemplo.com', '9012-3456', '1999-09-09', '2024-03-06'),
(22, 'Ricardo', 'Mendez', '01234567-8', 'Bo. El Centro, San Salvador, San Salvador Este, Soyapango', 'ricardo@ejemplo.com', '0123-4567', '2000-10-10', '2024-03-06'),
(38, 'Alejandro', 'Chavez', '04567890-1', 'San Salvador, San Salvador Este, San Martín', 'alejandro@ejemplo.com', '1002-3456', '2006-06-25', '2024-03-12'),
(42, 'Fred', 'Hilari', '01020304-5', 'San Salvador, San Salvador Este, Ilopango', 'fred@ejemplo.com', '7565-7007', '1999-03-03', '2024-03-27'),
(44, 'Emilia', 'Ruiz', '01234567-8', 'San Miguel, San Miguel Centro, San Miguel', 'emilia@ejemplo.com', '7777-8888', '2002-02-20', '2024-04-01'),
(46, 'Rhina', 'Mancilla', '00551133-9', 'Santa Ana, Santa Ana Centro, Santa Ana', 'rhina@gmail.com', '75309510', '2000-02-02', '2024-04-04'),
(48, 'Ulises', 'Delgado', '06060606-6', 'Sonsonate, Sonsonate Centro, Sonsonate', 'ulises@ejemplo.com', '7676-7676', '2006-06-06', '2024-04-29'),
(50, 'Enzo', 'Ferrari', '01111111-1', 'Barrio Venecia #1, Italia', 'enzo@ejemplo.com', '7777-8888', '1950-01-01', '2024-07-16'),
(51, 'Junior Armando', 'Paredes Icaza', '01234567-8', 'Barrio El Centro #10', 'armaparedes@gmail.com', '7474-7474', '2004-04-04', '2024-07-17'),
(52, 'Alexander', 'García', '01234567-8', 'Soyapango, San Salvador', 'alex.garcia@gmail.com', '7530-0357', '1988-05-18', '2024-07-23'),
(53, 'Giovanni', 'García', '01234567-8', 'Cabañas, Ilobasco', 'gio.garcia@gmail.com', '7951-1597', '1990-01-13', '2024-07-23'),
(54, 'Sebastian', 'García', '05000000-0', 'Cabañas, Ilobasco', 'sebas.garcia@gmail.com', '75057505', '2004-10-03', '2024-10-04'),
(55, 'Juan', 'Pérez', '05012345-6', 'Jardines de La Hacienda Calle El Pedregal, La Libertad, La Libertad Sur, Santa Tecla', 'juan.perez@gmail.com', '7000-1234', '1995-05-15', '2024-10-31'),
(56, 'Roberto', 'Merino', '03456789-0', 'San Salvador, San Salvador Este, Ilopango', 'roberto@ejemplo.com', '1023-4567', '1985-08-19', '2024-10-31'),
(57, 'Juan', 'Pérez', '05012345-6', 'Jardines de La Hacienda Calle El Pedregal, La Libertad, La Libertad Sur, Santa Tecla', 'juan.perez@gmail.com', '7000-1234', '1995-05-15', '2024-11-04');

--
-- Disparadores `colaboradores`
--
DELIMITER $$
CREATE TRIGGER `actualizar_visitas_y_usuarios_al_borrar_colaborador` BEFORE DELETE ON `colaboradores` FOR EACH ROW BEGIN
    -- Verifica que no se trate del Administrador (idColaborador = 1)
    IF OLD.idColaborador <> 1 THEN
        -- Actualiza las referencias de idColaborador en la tabla visitas
        UPDATE visitas
        SET idColaborador = 1
        WHERE idColaborador = OLD.idColaborador;

        -- Elimina el registro del colaborador en la tabla usuarios
        DELETE FROM usuarios
        WHERE idColaborador = OLD.idColaborador;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `idFormulario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idColaborador` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipoColaborador` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idColaborador`, `username`, `password`, `tipoColaborador`) VALUES
(1, 1, 'admin', '$2y$10$J4muGGzfIxVtBhJJWR4yGOFyMtCzY5.WWGZqftl9HUPcSyUu.zSey', 'Administrador'),
(2, 2, 'salvamar', '$2y$10$J4muGGzfIxVtBhJJWR4yGOFyMtCzY5.WWGZqftl9HUPcSyUu.zSey', 'Colaborador'),
(3, 6, 'juan', '$10$ITikOWdviMupfTMhO1qlrue0tiCQbutGXqDHLUIKjoaMnXNJ4sdyO', 'Colaborador'),
(4, 7, 'marcela', '$2y$10$55gBrWQAz9XSa5FvBXs5OO1xyZ4gflOrJOH4BECl5cWHARhEYVenG', 'Colaborador'),
(5, 8, 'rich', '$2y$10$L9nCm6Nbeg2AzViTKwBjBujPiZStGvi9FFPoLc1cX4J/RBYXIrtbu', 'Administrador'),
(6, 10, 'majo', '$2y$10$WwYpJ0MgpPKMo1/j4qpEAOtU6YZiRsKEozKJ8Zo9bpbI67tpDIs5q', 'Administrador'),
(7, 9, 'hilda', '$2y$10$x10AIbyX1a4g1uKisBPGZOrE/Sam2jGeeGgzMIg8fbY.vDbcDtr.a', 'Administrador'),
(8, 12, 'cortiz', '$2y$10$DYoWJky2MITL7BdcIfRo4.hmL5xAn6/vdYtMLBEql3kld7XUbOJVe', 'Colaborador'),
(11, 14, 'anam', '$2y$10$OdSxNE8z8gvU12Owa76zyuAj2robWKPPF.mrWUemdhRorD4QPpj8O', 'Colaborador'),
(13, 57, 'juanpe', '$2y$10$a2LQf3UlBXMGu72A52kXPOrrhDDPS4VsohHVQ5sn7hpA1.BPrDHwW', 'Colaborador'),
(14, 16, 'lucira', '$2y$10$1o3gelyJwneiHCcVtUk7VOMamPYd57THjWr0iowR/RXpNzkDKBBXS', 'Colaborador'),
(15, 13, 'carlopez', '$2y$10$MLhc999YMK4iTI8hinfxa.m45lxZpA0fZLeGaBm95BfSK7EwbDeG6', 'Colaborador');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `actualizar_visitas_al_borrar_usuario` BEFORE DELETE ON `usuarios` FOR EACH ROW BEGIN
    -- Verifica que no se trate del Administrador (idColaborador = 1)
    IF OLD.idColaborador <> 1 THEN
        -- Actualiza las referencias de idColaborador en la tabla visitas
        UPDATE visitas
        SET idColaborador = 1
        WHERE idColaborador = OLD.idColaborador;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `idVisitante` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fechaVisita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`idVisitante`, `nombre`, `correo`, `asunto`, `comentario`, `fechaVisita`) VALUES
(1, 'Andrea Valle', 'andy@gmail.com', 'Curiosidad personal', 'Bonito', '2024-01-07'),
(2, 'Josué Armando', 'josh@gmail.com', 'Visita de negocio', 'Interesante', '2024-01-07'),
(3, 'Claudia Henríquez', 'claudia@gmail.com', 'Trabajo', 'Visita', '2024-01-09'),
(4, 'José García', 'jose@gmail.com', 'Prueba', 'Prueba', '2024-01-10'),
(5, 'Lourdes Chicas', 'lou@gmail.com', 'Prueba', 'Prueba', '2024-01-16'),
(6, 'Daniel Flores', 'daniel@gmail.com', 'Fregar', 'Fregar', '2024-01-18'),
(7, 'Claudia Ortiz', 'clauortiz@gmail.com', 'Campaña', 'Vamos', '2024-02-18'),
(8, 'Salvador Mejia', 'salvamar@gmail.com', 'Visita de prueba 2', 'Visita de prueba 2', '2024-04-16'),
(10, 'Beyonce', 'beyonce@musica.com', 'Presentación', 'Show', '2024-05-16'),
(12, 'Prueba', 'prueba@prueba.com', 'Prueba', 'Prueba', '2024-05-20'),
(13, 'Javier Milei', 'javilei@gmail.com', 'Curiosidad', 'Visita curiosa', '2024-06-13'),
(14, 'Felipe VI', 'rey@gmail.com', 'Donación', 'Apoyo', '2024-07-23'),
(17, 'Prueba Uno', 'pruebauno@gmail.com', 'Prueba Uno', 'Prueba Uno', '2024-10-12'),
(18, 'Prueba Dos', 'pruebados@gmail.com', 'Prueba Dos', 'Prueba Dos', '2024-10-16'),
(19, 'Prueba Tres', 'pruebatres@gmail.com', 'Prueba Tres', 'Prueba Tres', '2024-10-24'),
(20, 'Prueba Cuatro', 'pruebacuatro@gmail.com', 'Prueba Cuatro', 'Prueba Cuatro', '2024-10-28'),
(21, 'Prueba Cinco', 'pruebacinco@gmail.com', 'Prueba Cinco', 'Prueba Cinco', '2024-11-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `idVisita` int(11) NOT NULL,
  `idColaborador` int(11) NOT NULL,
  `idVisitante` int(11) NOT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaVisita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`idVisita`, `idColaborador`, `idVisitante`, `asunto`, `comentario`, `cantidad`, `fechaVisita`) VALUES
(1, 1, 1, 'Visita personal', 'Tenía curiosidad de conocer el lugar', 1, '2023-12-22'),
(2, 1, 2, 'Trabajo', 'Servicio de comida', 1, '2024-01-09'),
(4, 1, 1, 'Trabajo', 'Entrevistas', 2, '2024-01-09'),
(6, 1, 2, 'Personal', 'Visita', 1, '2024-01-09'),
(8, 1, 1, 'Prueba 1', 'Prueba 1', 1, '2024-01-09'),
(10, 1, 1, 'Prueba 2', 'Prueba 2', 1, '2024-01-09'),
(11, 1, 1, 'Prueba 3', 'Prueba 3', 1, '2024-01-09'),
(12, 1, 1, 'Prueba 4', 'Prueba 4', 1, '2024-01-09'),
(13, 1, 3, 'Visita profesional', 'Ninguno', 1, '2024-01-09'),
(14, 1, 3, 'Prueba', 'Prueba', 2, '2024-01-10'),
(15, 1, 3, 'Prueba 2', 'Prueba 2', 1, '2024-01-10'),
(16, 1, 3, 'Prueba 3', 'Prueba 3', 1, '2024-01-10'),
(17, 1, 3, 'Prueba 4', 'Prueba 4', 1, '2024-01-10'),
(18, 1, 2, 'Prueba', 'Prueba', 1, '2024-01-10'),
(19, 1, 2, 'Prueba 2', 'Prueba 2', 1, '2024-01-10'),
(20, 1, 2, 'Prueba 3', 'Prueba 3', 1, '2024-01-10'),
(21, 1, 2, 'Prueba 4', 'Prueba 4', 1, '2024-01-10'),
(22, 1, 4, 'Prueba', 'Prueba', 1, '2024-01-10'),
(23, 1, 4, 'Prueba 2', 'Prueba 2', 1, '2024-01-10'),
(24, 1, 4, 'Prueba 3', 'Prueba 3', 1, '2024-01-10'),
(25, 1, 4, 'Prueba 4', 'Prueba 4', 1, '2024-01-10'),
(26, 1, 4, 'Prueba 5', 'Prueba 5', 1, '2024-01-10'),
(27, 1, 1, 'Prueba', 'Prueba', 1, '2024-01-10'),
(28, 1, 1, 'Prueba 2', 'Prueba 2', 1, '2024-01-14'),
(30, 1, 5, 'Prueba', 'Prueba', 1, '2024-01-16'),
(31, 1, 5, 'Prueba 2', 'Prueba 2', 1, '2024-01-16'),
(32, 1, 5, 'Prueba 3', 'Prueba 3', 1, '2024-01-17'),
(33, 1, 6, 'Prueba', 'Prueba', 2, '2024-01-17'),
(34, 1, 6, 'Prueba 2', 'Prueba 2', 1, '2024-01-18'),
(36, 1, 7, 'Campaña', 'Vamos', 1, '2024-02-18'),
(38, 2, 12, 'Prueba 1', 'Prueba 1', 1, '2024-05-28'),
(39, 2, 12, 'Prueba 2', 'Prueba 2', 1, '2024-06-07'),
(40, 2, 12, 'Prueba 3', 'Prueba 3', 1, '2024-06-07'),
(41, 2, 12, 'Prueba 4', 'Prueba 4', 1, '2024-06-08'),
(42, 2, 13, 'Curiosidad', 'Visita curiosa', 1, '2024-06-13'),
(43, 1, 13, 'Visita', 'Visita', 1, '2024-06-19'),
(44, 1, 1, 'Visita 2', 'Visita 2', 4, '2024-06-19'),
(45, 1, 1, 'Visita 3', 'Visita 3', 5, '2024-06-19'),
(46, 1, 1, 'Visita 4', 'Visita 4', 4, '2024-08-14'),
(48, 1, 17, 'Prueba Uno', 'Prueba Uno', 2, '2024-10-05'),
(49, 1, 17, 'Prueba Uno 2', 'Prueba Uno 2', 2, '2024-10-11'),
(50, 1, 18, 'Prueba Dos', 'Prueba Dos', 2, '2024-10-16'),
(51, 1, 18, 'Prueba Dos', 'Prueba Dos', 4, '2024-10-16'),
(52, 2, 19, 'Prueba Tres', 'Prueba Tres', 2, '2024-10-28'),
(53, 2, 19, 'Prueba Tres', 'Prueba Tres', 2, '2024-10-28'),
(54, 2, 19, 'Prueba Tres', 'Prueba Tres', 4, '2024-10-28'),
(55, 1, 17, 'Prueba Uno Juan Perez', 'Prueba Uno Juan Perez', 1, '2024-10-31'),
(56, 1, 18, 'Prueba Dos Juan Perez', 'Prueba Dos Juan Perez', 1, '2024-10-31'),
(57, 1, 19, 'Prueba Tres Juan Perez', 'Prueba Tres Juan Perez', 1, '2024-10-31'),
(58, 1, 20, 'Prueba Cuatro Juan Perez', 'Prueba Cuatro Juan Perez', 1, '2024-10-31'),
(59, 57, 17, 'Prueba Uno Juanpe', 'Prueba Uno Juanpe', 2, '2024-11-07'),
(60, 57, 18, 'Prueba Dos Juanpe', 'Prueba Dos Juanpe', 4, '2024-11-07'),
(61, 57, 19, 'Prueba Tres Juanpe', 'Prueba Tres Juanpe', 2, '2024-11-07'),
(62, 57, 20, 'Prueba Cuatro Juanpe', 'Prueba Cuatro Juanpe', 4, '2024-11-07'),
(63, 16, 17, 'Prueba Uno Lucira', 'Prueba Uno Lucira', 2, '2024-11-08'),
(64, 16, 18, 'Prueba Dos Lucira', 'Prueba Dos Lucira', 2, '2024-11-08'),
(65, 16, 19, 'Prueba Tres Lucira', 'Prueba Tres Lucira', 2, '2024-11-08'),
(66, 16, 20, 'Prueba Cuatro Lucira', 'Prueba Cuatro Lucira', 2, '2024-11-08'),
(67, 13, 17, 'Prueba Uno Carlopez', 'Prueba Uno Carlopez', 1, '2024-11-09'),
(68, 13, 18, 'Prueba Dos Carlopez', 'Prueba Dos Carlopez', 1, '2024-11-09'),
(69, 13, 19, 'Prueba Tres Carlopez', 'Prueba Tres Carlopez', 1, '2024-11-09'),
(70, 13, 20, 'Prueba Cuatro Carlopez', 'Prueba Cuatro Carlopez', 1, '2024-11-09'),
(71, 13, 21, 'Prueba Cinco', 'Prueba Cinco', 2, '2024-11-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`idColaborador`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`idFormulario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idColaborador` (`idColaborador`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`idVisitante`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`idVisita`),
  ADD KEY `idColaborador` (`idColaborador`),
  ADD KEY `idVisitante` (`idVisitante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `idColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `idFormulario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `idVisitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `idVisita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idColaborador`) REFERENCES `colaboradores` (`idColaborador`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`idColaborador`) REFERENCES `colaboradores` (`idColaborador`),
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`idVisitante`) REFERENCES `visitantes` (`idVisitante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
