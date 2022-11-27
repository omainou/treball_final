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
  `voluntaris` int(11) NOT NULL,
  `voluntaris_disponibles` int(11) NOT NULL,
  `esta_acceptada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

CREATE TABLE `voluntariat` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `activitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuari` (`id_usuari`);

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

ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activitat` (`id_activitat`),
  ADD KEY `id_usuari` (`id_usuari`);

ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `voluntariat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_activitat` (`id_activitat`),
  ADD KEY `id_usuari` (`id_usuari`);

ALTER TABLE `activitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `voluntariat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `activitat`
  ADD CONSTRAINT `activitat_ibfk_1` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

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

ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `transport_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

ALTER TABLE `voluntariat`
  ADD CONSTRAINT `voluntariat_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `voluntariat_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);
COMMIT;
