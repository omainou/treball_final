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
(1, 'Excursió a Andorra', 1, 'Andorra la Vella', 'Excursió a Andorra. Visitarem el país més petit dels Pirineus. T\'hi apuntes?', 100, 100, '2022-03-01', '07:00:00', 0, '551_andorra.jpg', 1, 'Plaça de Lesseps de Barcelona', 4, 10, 10, 1),
(2, 'Visita a Barcelona', 3, 'Barcelona', 'Visitarem la ciutat de Barcelona (monuments com la Pedrera, Sagrada Família, Casa Gaudí, etc.). T\'hi apuntes?', 39, 39, '2023-01-21', '12:15:00', 0, '1_bcn.jpg', 1, 'Carrer Diputació 22, Figueres', 4, 7, 6, 1),
(3, 'Visita a Tarragona', 3, 'Tarragona', 'Visitarem la ciutat Tarragona amb les seves muralles romanes.', 36, 36, '2022-12-09', '12:00:00', 0, '6264_tarragona.jpg', 1, 'Plaça Espanya de Barcelona', 4, 5, 5, 1),
(4, 'Futbol platja', 4, 'Barcelona', 'A la platja de la Barceloneta organitzem un campionat de futbol platja per a persones cegues. Activitat gratuïta i subvencionada per l\'associació catalana de futbol. Es necessita voluntaris per organitzar el torneig.', 135, 130, '2023-08-10', '11:45:00', 0, '8463_futbolplaya.jpg', 1, 'Plaça Espanya de Barcelona', 3, 5, 5, 1),
(5, 'Classes de pintura', 1, 'Platja d\'Aro', 'L\'ajuntament de Castell-Platja d\'Aro organitza classes de pintura per a persones amb discapacitat funcional. T\'hi esperem!', 10, 10, '2023-01-05', '11:00:00', 0, '6296_paint.jpg', 1, 'Plaça de Lesseps de Barcelona', 6, 0, 0, 1),
(6, 'Cuinem al Maresme', 2, 'Mataró', 'L\'ajuntament de Mataró organitza, a través de la seva televisió pública, un concurs de cuina anomenat \"Cuinem al Maresme\". El guanyador s\'emporta un xec de 5 mil euros. Els programes es graven cada dimarts i dijous de febrer a abril.', 30, 25, '2023-02-02', '16:15:00', 0, '6097_cuina.jpg', 1, 'Plaça Espanya de Barcelona', 4, 4, 3, 1),
(7, 'Classes de memòria', 1, 'Tortosa', 'AILLED organitza a la ciutat de Tortosa (Tarragona) classes de memòria per a persones amb discapacitat.', 11, 11, '2023-06-12', '09:30:00', 0, '3598_classe.jpg', 1, 'Carrer París, 19, Sant Cugat del Vallès', 3, 2, 2, 1),
(8, 'Taller de mecànica', 2, 'L\'Hospitalet de Llobregat', 'El taller \"Reparamos Coches Modernos\" realitza un taller per a persones amb discapacitat funcional per tal que, en un futur, puguin treballar amb l\'empresa. Activitat a càrrec del mecànic de cotxes Pedro Martí Alonso.', 10, 10, '2023-04-10', '10:15:00', 0, '7772_autos.jpg', 1, 'Carrer París, 19, Sant Cugat del Vallès', 3, 2, 1, 1),
(9, 'Hort urbà', 1, 'Badalona', 'L\'ajuntament de Badalona ha cedit a AILLED un terreny per tal que persones amb síndrome de Down puguin cultivar un hort urbà a la ciutat badalonina. T\'hi apuntes? Nosaltres t\'hi esperem!', 8, 6, '2022-12-29', '17:00:00', 0, '7717_taronja.jpg', 1, 'Plaça de Sants de Barcelona', 3, 1, 1, 1),
(10, 'Teatre', 1, 'Vilassar de Mar', 'Una associació del municipi de Vilassar ens deixa el seu local per dur a terme activitats a AILLED. Organitzem una classe de teatre per a persones amb discapacitat intel·lectual.', 25, 25, '2023-01-13', '16:30:00', 0, '2952_theatre.jpg', 1, 'Plaça de Lesseps de Barcelona', 4, 3, 3, 1),
(11, 'Classes d\'Excel', 2, 'Figueres', 'Des d\'AILLED organitzem, per a persones amb discapacitat, classes d\'Excel per tal que aprenguin a fer-lo servir. ', 22, 21, '2023-05-04', '09:45:00', 0, '9889_laptop.jpg', 1, 'Plaça de Lesseps de Barcelona', 4, 3, 2, 1),
(12, 'Museu de xocolata', 5, 'Manresa', 'El museu de xocolata de Manresa ens cedeix el seu espai per apendre com es fa la xocolata. Activitat per persones amb discapacitat i per a les seves families.', 50, 50, '2023-07-06', '11:30:00', 0, '6701_xocolata.jpg', 1, 'Plaça del Maresme (Mataró)', 3, 7, 7, 1),
(22, 'Visita al MNAC', 1, 'Barcelona', 'Visita al Museu Nacional d\'Art de Catalunya. Visita que ens explicarà l\'art modern català.', 23, 23, '2023-02-23', '09:30:00', 0, '5674_mnac.jpg', 0, '', 0, 2, 2, 1);

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

INSERT INTO `formulari_consultes` (`id`, `id_usuari`, `pregunta`, `dia`, `hora`) VALUES
(1, 4, 'No em funciona com afegir la imatge a l\'activitat.', '2022-12-11', '19:14:17'),
(2, 3, 'A les activitats de muntanya es necessari un calçat esportiu?', '2022-12-11', '23:25:59'),
(16, 5, 'Vull crear una activitat, però tinc un dubte:  haig de resevar els autocars o els gestiona AILLED?', '2022-12-13', '16:08:28');

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `enviat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `newsletter` (`id`, `email`, `enviat`) VALUES
(1, 'oriolmainou@gmail.com', 1),
(2, 'pedrovazquez@gmail.com', 0),
(3, 'albertvarsovia@yahoo.es', 1);

CREATE TABLE `opinio` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `titol` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `valoracio` int(11) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `opinio` (`id`, `id_usuari`, `id_activitat`, `titol`, `descripcio`, `valoracio`, `dia`) VALUES
(1, 2, 1, 'Tornarem amb AILLED!!!', 'Ens ho hem passat molt bé amb vosaltres, hi tornarem!', 5, '2022-12-06'),
(2, 3, 1, 'Espectacular', 'No havíem esquiat mai, els monitors ens van ajudar a aprendre. Gràcies!', 5, '2022-12-07');

CREATE TABLE `participants_apuntats` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `numero_participants` int(11) NOT NULL,
  `ha_pagat` int(11) NOT NULL,
  `assistir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `participants_apuntats` (`id`, `id_usuari`, `id_activitat`, `numero_participants`, `ha_pagat`, `assistir`) VALUES
(5, 1, 4, 5, 0, 0),
(6, 5, 9, 2, 0, 0),
(7, 5, 6, 5, 0, 0),
(8, 5, 11, 1, 0, 0);

CREATE TABLE `qui_som` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8_spanish_ci NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `qui_som` (`id`, `text`, `id_persona`) VALUES
(1, 'AILLED som una associació que organitza activitats culturals i esportives per a persones amb discapacitat per a que puguin dur a terme activitats grupals. A més, cada usuari pot crear la seva pròpia activitat sent cada una d\'elles validada pels administradors de la pàgina. Es busca que aquestes activitats lúdiques siguin sempre gratuïtes (subvencionades per associacions / fundacions) o bé de preus molt reduïts pels seus beneficiaris. Crea, apuntat i participa. T\'esperem a AILLED!!', 1);

CREATE TABLE `resposta_formulari_consultes` (
  `id` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `id_admin_resposta` int(11) NOT NULL,
  `resposta` varchar(350) COLLATE utf8_spanish_ci NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `resposta_formulari_consultes` (`id`, `id_consulta`, `id_admin_resposta`, `resposta`, `dia`, `hora`) VALUES
(6, 2, 1, 'Sí, és obligatòri.', '2022-12-12', '08:50:35'),
(12, 1, 1, 'Ja funciona correctament, hem tingut problemes de servidor.', '2022-12-12', '17:43:49');

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL,
  `persones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `transport` (`id`, `id_usuari`, `id_activitat`, `persones`) VALUES
(1, 4, 3, 4),
(3, 5, 6, 5),
(4, 5, 11, 1);

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
(1, 'Oriol Mainou', 666666666, 'omainou@uoc.edu', '$2y$12$K6b2oxkW6FyCXaU8juC4N.YDszTTKU0IynuWq0/NeD2.oU/dcELs2', '8334_cadaques.jpg', 1),
(2, 'Josep Maria Estrada', 633333302, 'jmestrada@gmail.com', '$2y$12$5vSiees/hUz/MGo2gA/drOPbxA/yZOvRDrFvEbB1H71BCr.NJUbaK', '-', 0),
(3, 'Anna Perez', 654789654, 'annaperez@gmail.com', '$2y$12$5vSiees/hUz/MGo2gA/drOPbxA/yZOvRDrFvEbB1H71BCr.NJUbaK', '-', 0),
(4, 'Maria Pedrosa', 632144778, 'mariapedrosa@gmail.com', '$2y$12$/dzwt83TpecpKD5jLAtsCOpjqpMcEj9egbKfu1p9wYPOe02GM7DE.', '-', 0),
(5, 'Xavier Olot', 600225540, 'xaviolot8@msn.com', '$2y$12$w52IoyNCpqus0buedpXO4Ond8SeF6EpSrpTqQ8ZyEjP6dGvDvR90q', '-', 0);

CREATE TABLE `vehicles_transport` (
  `id` int(11) NOT NULL,
  `vehicle` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `vehicles_transport` (`id`, `vehicle`) VALUES
(0, 'Cap vehicle'),
(1, 'Cotxe'),
(2, 'Moto'),
(3, 'Tren'),
(4, 'Autocar'),
(5, 'Avió'),
(6, 'Autobús');

CREATE TABLE `voluntariat` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_activitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `voluntariat` (`id`, `id_usuari`, `id_activitat`) VALUES
(5, 1, 11),
(6, 1, 2),
(7, 1, 8),
(8, 1, 6);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_admin_resposta` (`id_admin_resposta`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `formulari_consultes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `opinio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `participants_apuntats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `qui_som`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `resposta_formulari_consultes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `usuari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `vehicles_transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `voluntariat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

ALTER TABLE `resposta_formulari_consultes`
  ADD CONSTRAINT `resposta_formulari_consultes_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `formulari_consultes` (`id`),
  ADD CONSTRAINT `resposta_formulari_consultes_ibfk_2` FOREIGN KEY (`id_admin_resposta`) REFERENCES `usuari` (`id`);

ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `transport_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);

ALTER TABLE `voluntariat`
  ADD CONSTRAINT `voluntariat_ibfk_1` FOREIGN KEY (`id_activitat`) REFERENCES `activitat` (`id`),
  ADD CONSTRAINT `voluntariat_ibfk_2` FOREIGN KEY (`id_usuari`) REFERENCES `usuari` (`id`);
COMMIT;
