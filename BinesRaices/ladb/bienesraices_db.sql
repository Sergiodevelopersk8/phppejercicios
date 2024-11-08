

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `habitaciones` int(1) DEFAULT NULL,
  `wc` int(1) DEFAULT NULL,
  `estacionamient` int(1) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `idVendedores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamient`, `creado`, `idVendedores`) VALUES
(1, ' casa1', 1, '876d0c22436e149a4bb5f94755f579e0.jpg', '  casa1   casa1   casa1   casa1   casa1', 1, 1, 1, '2024-11-08', 1),
(2, ' casa 2', 2, 'cb912d8bc1851ee050ac6469b3148ddb.jpg', '  casa 2 casa 2 casa 2 casa 2 casa 2 casa 2 casa 2 casa 2 casa 2 casa 2 ', 2, 2, 2, '2024-11-08', 2),
(3, ' casa 3', 3, 'a4e4ed9c0039976800a056b1382c9fff.jpg', '  casa 3 casa 3 casa 3 casa 3 casa 3 casa 3', 3, 3, 3, '2024-11-08', 3),
(4, ' casa4 update', 41, 'dcf790ee90c5444309af707bfd1082b0.jpg', '   casa4 casa4 casa4 casa4 casa4 casa4 casa4 casa4 ', 2, 2, 2, '2024-11-08', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'correo@correo.com', '$2y$10$0t7SpXMd8BknU.nJqhNIw.ItrTncyuhNyk.31UZlHtkXhdxS0qafK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `idVendedores` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`idVendedores`, `nombre`, `apellido`, `telefono`) VALUES
(1, 'Sergio', 'Merino Cortez', '11111'),
(2, 'Abby', 'Donnelly', '22222'),
(3, 'Kiernan', 'Shipka', '33333'),
(4, 'Alan', 'hernandez', '44444'),
(5, 'Federico', 'Diaz ', 'acuña');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idVendedores` (`idVendedores`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`idVendedores`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `idVendedores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `idVendedores` FOREIGN KEY (`idVendedores`) REFERENCES `vendedores` (`idVendedores`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
