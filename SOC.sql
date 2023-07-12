
CREATE TABLE `applicant` (
  `nameApp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ageApp` tinyint NOT NULL,
  `birthDate` date NOT NULL,
  `gender` char(1) NOT NULL,
  `CURP` char(18) NOT NULL,
  `emailApp` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(40) NOT NULL,
  `zip` int NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Estructura de tabla para la tabla `cat_destiny`
--

CREATE TABLE `cat_destiny` (
  `id` tinyint NOT NULL,
  `name` varchar(50) NOT NULL,
  `maxAmount` decimal(10,2) NOT NULL,
  `netMinAmount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cat_destiny`
--

INSERT INTO `cat_destiny` (`id`, `name`, `maxAmount`, `netMinAmount`) VALUES
(1, 'Casa', '200000.00', '50000.00'),
(2, 'Auto', '100000.00', '30000.00'),
(3, 'Préstamo', '50000.00', '20000.00'),
(4, 'Tarjeta de crédito', '20000.00', '20000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `income`
--

CREATE TABLE `income` (
  `idIncome` int NOT NULL,
  `nameCompany` varchar(200) NOT NULL,
  `fullIncome` decimal(12,2) NOT NULL,
  `netIncome` decimal(12,2) NOT NULL,
  `typeEmployment` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `documentIncome` varchar(100) NOT NULL,
  `startEmployment` date NOT NULL,
  `createRegister` datetime NOT NULL,
  `curpEmployee` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderApp`
--

CREATE TABLE `orderApp` (
  `idOrder` int NOT NULL,
  `createRegister` datetime NOT NULL,
  `period` tinyint NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `idDestiny` tinyint NOT NULL,
  `curpEmployee` char(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`CURP`);

--
-- Indices de la tabla `cat_destiny`
--
ALTER TABLE `cat_destiny`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`idIncome`),
  ADD KEY `fk_relacion` (`curpEmployee`);

--
-- Indices de la tabla `orderApp`
--
ALTER TABLE `orderApp`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `fk_idDestiny` (`idDestiny`),
  ADD KEY `fk_curpEmployee` (`curpEmployee`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_destiny`
--
ALTER TABLE `cat_destiny`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `income`
--
ALTER TABLE `income`
  MODIFY `idIncome` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orderApp`
--
ALTER TABLE `orderApp`
  MODIFY `idOrder` int NOT NULL AUTO_INCREMENT;

--
ALTER TABLE `income`
  ADD CONSTRAINT `fk_relacion` FOREIGN KEY (`curpEmployee`) REFERENCES `applicant` (`CURP`);

--
-- Filtros para la tabla `orderApp`
--
ALTER TABLE `orderApp`
  ADD CONSTRAINT `fk_curpEmployee` FOREIGN KEY (`curpEmployee`) REFERENCES `applicant` (`CURP`),
  ADD CONSTRAINT `fk_idDestiny` FOREIGN KEY (`idDestiny`) REFERENCES `cat_destiny` (`id`);
COMMIT;


