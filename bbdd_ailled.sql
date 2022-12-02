SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `activitat` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `ubicacio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `participants` int(11) NOT NULL,
  `participants_disponibles` int(11) NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `preu` int(11) NOT NULL,
  `imatge` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `transport` int(11) NOT NULL,
  `lloc_sortida_transport` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_vehicle_transport` int(11) NOT NULL,
  `voluntaris` int(11) NOT NULL,
  `voluntaris_disponibles` int(11) NOT NULL,
  `esta_acceptada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `activitat` (`id`, `nom`, `id_usuari`, `ubicacio`, `descripcio`, `participants`, `participants_disponibles`, `dia`, `hora`, `preu`, `imatge`, `transport`, `lloc_sortida_transport`, `id_vehicle_transport`, `voluntaris`, `voluntaris_disponibles`, `esta_acceptada`) VALUES
(1, 'Excursió d\'Andorra', 1, 'Andorra la Vella', 'Excursió a Andorra. Visitarem el país més petit dels Pirineus. T\'hi apuntes?', 100, 100, '2023-03-01', '07:00:00', 0, '551_andorra.jpg', 1, 'Plaça de Lesseps de Barcelona', 4, 10, 10, 0),
(2, 'Excursió d\'Andorra', 1, 'Andorra la Vella', 'Excursió a Andorra. Visitarem el país més petit dels Pirineus. T\'hi apuntes?', 100, 100, '2023-03-01', '07:00:00', 0, '551_andorra.jpg', 1, 'Plaça de Lesseps de Barcelona', 4, 10, 10, 1);

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `titol` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `text` varchar(350) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `formulari_consultes` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `pregunta` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `opinio` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `titol` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `participants_apuntats` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `numero_participants` int(11) NOT NULL,
  `assistir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `qui_som` (
  `id` int(11) NOT NULL,
  `text` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `resposta_formulari_consultes` (
  `id` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `id_admin_resposta` int(11) NOT NULL,
  `resposta` varchar(350) COLLATE utf8_spanish_ci NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `persones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefon` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenya` text COLLATE utf8_spanish_ci NOT NULL,
  `imatge` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `es_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `usuari` (`id`, `nom`, `telefon`, `email`, `contrasenya`, `imatge`, `es_admin`) VALUES
(1, 'Oriol Mainou', 666666666, 'omainou@uoc.edu', '$2y$12$Y0uEpHVEx/I9UNH.pFUBb.67HwnbR8Umf5OI0BeBZHyDLE91Zhv9C', '8334_cadaques.jpg', 1),
(2, 'Josep Maria Estrada', 633333302, 'jmestrada@gmail.com', '$2y$12$5vSiees/hUz/MGo2gA/drOPbxA/yZOvRDrFvEbB1H71BCr.NJUbaK', '-', 0),
(3, 'Anna Perez', 654789654, 'annaperez@gmail.com', '$2y$12$5vSiees/hUz/MGo2gA/drOPbxA/yZOvRDrFvEbB1H71BCr.NJUbaK', '-', 0);

CREATE TABLE `vehicles_transport` (
  `id` int(11) NOT NULL,
  `vehicle` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `vehicles_transport` (`id`, `vehicle`) VALUES
(1, 'Cotxe'),
(2, 'Moto'),
(3, 'Tren'),
(4, 'Autocar'),
(5, 'Avió');

CREATE TABLE `voluntariat` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `activitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuari` (`id_usuari`),
  ADD KEY `id_vehicle_transport` (`id_vehicle_transport`);

ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

ALTER TABLE `formulari_consultes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuari` (`id_usuari`);

ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `opinio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuari` (`id_usuari`),
  ADD KEY `id_activitat` (`id_activitat`);

ALTER TABLE `participants_apuntats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activitat` (`id_activitat`),
  ADD KEY `id_usuari` (`id_usuari`);

ALTER TABLE `qui_som`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

ALTER TABLE `resposta_formulari_consultes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activitat` (`id_activitat`),
  ADD KEY `id_usuari` (`id_usuari`);

ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `vehicles_transport`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `voluntariat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activitat` (`id_activitat`),
  ADD KEY `id_usuari` (`id_usuari`);

ALTER TABLE `activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `formulari_consultes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `opinio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `participants_apuntats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `qui_som`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resposta_formulari_consultes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `vehicles_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `voluntariat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `activitat`
  ADD CONSTRAINT `activitat_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`),
  ADD CONSTRAINT `activitat_ibfk_2` FOREIGN KEY (`id_vehicle_transport`) REFERENCES `vehicles_transport` (`id`);

ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `usuari` (`id`);

ALTER TABLE `formulari_consultes`
  ADD CONSTRAINT `formulari_consultes_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

ALTER TABLE `opinio`
  ADD CONSTRAINT `opinio_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`),
  ADD CONSTRAINT `opinio_ibfk_2` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`);

ALTER TABLE `participants_apuntats`
  ADD CONSTRAINT `participants_apuntats_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `participants_apuntats_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

ALTER TABLE `qui_som`
  ADD CONSTRAINT `qui_som_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `usuari` (`id`);

ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `transport_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

ALTER TABLE `voluntariat`
  ADD CONSTRAINT `voluntariat_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `voluntariat_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);
COMMIT;
