-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2019 a las 15:12:53
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bddeportistas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`id`, `nombre`) VALUES
(1, 'Natación'),
(2, 'Patinaje artístico sobre hielo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportistas`
--

CREATE TABLE `deportistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_local` varchar(80) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'nombre en idioma local',
  `img` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `anno_nacimiento` int(11) NOT NULL,
  `bio` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `youtube` varchar(15) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_deporte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `deportistas`
--

INSERT INTO `deportistas` (`id`, `nombre`, `nombre_local`, `img`, `anno_nacimiento`, `bio`, `youtube`, `id_deporte`) VALUES
(1, 'Adam Peaty', NULL, 'adam_peaty.jpg', 1994, 'Es un nadador británico especializado en el estilo braza.\r\n\r\nPeaty entrena con el club City of Derby, donde es entrenado por Melanie Marshall, una antigua nadadora olímpica. Su primera participación profesional fue en el Campeonato Europeo de Natación en Piscina Corta de 2013, celebrado en Herning, donde consiguió mejorar tres de sus tiempos personales.\r\n\r\nPosteriormente participó en los Juegos de la Mancomunidad de 2014 celebrados en Glasgow. Participó en cuatro modalidades: 50 m braza, 100 m braza, 200 m braza y en los 4x100 m combinado. En los 50 m braza quedó segundo en la final con un tiempo de 26,78, quedando tan sólo a dos centésimas del sudafricano Cameron van der Burgh.​ En la prueba de 100 m sí pudo derrotar a Cameron van der Burgh, con un tiempo de 58,94.3​ En los 200 m braza quedó en cuarta posición a 0,15 de las medallas. En los 4x100 m combinado consiguió la medalla de oro junto a su equipo. Un mes después participó en el Campeonato Europeo de Natación de 2014. Ganó dos medallas de oro, en las pruebas de 100 m braza, y en los 4x100 combinado. En la prueba de 50 m braza, en las semifinales, arrebató el récord mundial a Cameron van der Burgh con un tiempo de 26,62.\r\n\r\nEl 17 de abril de 2015, en el Campeonato Británico, rompe el récord mundial de los 100 metros braza con un tiempo de 57,92. Un año más tarde rebajó su marca de los 50 m braza a 26,42.\r\n\r\nPeaty participó en los Juegos Olímpicos de Río de Janeiro 2016, donde consiguió la medalla de oro y batió el récord del mundo a 57,13 en 100 m braza.4​ En los 4x100 metros combinado obtuvo la medalla de plata junto a Chris Walker-Hebborn, James Guy y Duncan Scott con un tiempo de 3:29,24\r\n', 'YtGI2NHP9uU', 1),
(2, 'Aliona Savchenko', 'Олена Валентинівна Савченко', 'aliona_savchenko.jpg', 1984, 'Es una patinadora de nacionalidad alemana. Compite en la disciplina de patinaje en pareja.\r\n\r\nAl comienzo de su carrera, Savchenko representó a Ucrania con Dmitri Boyenko y Stanislav Morózov. Con Morózov ganó el Campeonato del Mundo Júnior en el año 2000 y fue campeona de Ucrania en dos ocasiones, además de competir en los Juegos Olímpicos de invierno de 2002, donde la pareja acabó en la decimoquinta plaza.\r\n\r\nEn 2003 empezó a competir por Alemania con Robin Szolkowy. Szolkowy y Savchenko ganaron la medalla de bronce en los Juegos Olímpicos de Vancouver 2010, fueron campeones en el Campeonato Mundial en cinco ocasiones y ganaron el Grand Prix cuatro veces. También fueron campeones europeos en cuatro ocasiones, y ocho veces campeones de Alemania. Fueron la primera pareja en recibir una nota perfecta en el nuevo sistema de puntuación de la ISU.2\r\n\r\nDesde la temporada 2014-2015 patina con Bruno Massot,​ con el que se proclamó campeona de Alemania, subcampeona de Europa y medallista mundial en 2016 y 2017. Campeona del Grand Prix 2017-18 y campeona olímpica 2018.\r\n', 'P05Nv_VMS00', 2),
(3, 'Yevguéniya Medvédeva', 'Евгения Армановна Медведева', 'evgenia_medvedeva.jpg', 1999, 'Es una patinadora artística sobre hielo rusa. Es medallista de plata Olímpica de 2018 (individual y por equipos) dos veces campeona del mundo (2016, 2017), dos veces campeona europea (2016, 2017), dos veces campeona de la Serie del Grand Prix (2015, 2016) y dos veces campeona nacional rusa (2016, 2017). A principios de su carrera, fue campeona del Mundial Júnior en 2015, la final del Grand Pix Júnior en 2014 y el campeonato Ruso Júnior en 2015. Medallista de bronce del Campeonato Mundial de Patinaje de 2019.\r\n\r\nGanó dos campeonatos consecutivos mundiales después de conseguir el Mundial Júnior. En el campeonato mundial del 2017, se convirtió en la primera patinadora en ganar consecutivamente desde Michelle Kwan en 2000 y 2001. y la primera mujer rusa en defender su título con éxito. Con el sistema de la ISU, ella ha roto el récord mundial 13 veces y es la primera patinadora en romper la marca de los 80 puntos para el programa corto, los 160 para el programa libre y los 230 y 240 para el total combinado. Medvédeva tiene el récord mundial del programa libre y el total combinado en el sistema anterior de la ISU. ', 'qKgPod-Nhho', 2),
(4, 'Katie Ledecky', NULL, 'katie_ledecky.jpg', 1997, 'Es una nadadora estadounidense de estilo libre, campeona olímpica de 200, 400, 800 y 4×200 metros libre en Río de Janeiro 2016; y campeona mundial de los 400, 800, 1500, 4×100 y 4×200 metros libre en Budapest 2017. Además, es plusmarquista mundial en 400, 800 y 1500 metros libre. ', NULL, 1),
(5, 'Mireia Belmonte', NULL, 'mireia_belmonte.jpg', 1990, 'Mireia Belmonte García (Badalona, 10 de noviembre de 1990) es una nadadora española, campeona olímpica, mundial y europea, que compite en las categorías de estilos, mariposa y libre. \r\nPertenece al UCAM Club Natación Fuensanta, club adscrito a la Universidad Católica San Antonio de Murcia, donde estudia un Grado en Publicidad y Relaciones Públicas. Palmarés internacional\r\n\r\nLa nadadora española ha participado en tres Juegos Olímpicos. Debutó en la competición olímpica con 17 años, en Pekín 2008. Su segunda participación fue en Londres 2012, en los que estrenó su medallero olímpico con dos platas en 200 m mariposa y en 800 m libres, rebajando en cuatro segundos el récord de España. En los más recientes de Río 2016, se proclamó campeona olímpica de 200 m mariposa, –prueba en la que se ha proclamado a su vez, campeona mundial y europea–, y logró la medalla de bronce en 400 m estilos.​\r\n\r\nEn Campeonatos Mundiales, logró seis medallas entre los años 2013 y 2017, y diez medallas en los Mundiales en Piscina Corta entre los años 2008 y 2014.5​ A nivel europeo, consiguió trece medallas en el Campeonato Europeo de Natación entre los años 2008 y 2016, y once medallas en el Campeonato Europeo de Natación en Piscina Corta entre los años 2007 y 2013.', 'Us2a9xPoBS0', 1),
(6, 'Shoma Uno', '宇野 昌磨', 'shoma_uno.jpg', 1997, 'Es un patinador japonés. Es subcampeón olímpico de Pieonchang 2018, subcampeón mundial de 2017 y 2018, subcampeón de los Cuatro Continentes en 2018 y campeón en 2019, tres veces medallista de la Final del Grand Prix (2015-2017), el campeón de los Juegos Asiáticos de Invierno de 2017, y dos veces Campeón Nacional Japonés (2016, 2017). En los inicios de su carrera consiguió ser el Campeón Mundial Júnior de 2015, campeón júnior de la Final del Grand Prix (2014-15), y subcampeón de los Juegos Olímpicos de la Juventud de 2012. Medallista de plata de la Final del Grand Prix de 2018-2019. Ganador del Campeonato Nacional de Japón 2018-2019.\r\n\r\nUno es el primer patinador en realizar exitosamente un flip cuádruple en una competición internacional.​ También tiene el récord actual de la mayor puntuación obtenida por un patinador júnior en el programa corto.', '9wx5YVvxxO0', 2),
(7, 'Sun Yang', '孫楊', 'sun_yang.jpg', 1991, 'Es un nadador chino, que posee el récord mundial de los 1500 m libre. Compitió en los Juegos Olímpicos de Pekín 2008, Londres 2012 y Río de Janeiro 2016 obteniendo dos medallas de oro, dos de plata y una de bronce.\r\n\r\nEn los Juegos Asiáticos de 2010, ganó los 1500 metros libre con un nuevo récord de Asia, que junto a sus otras tres medallas en los juegos fueron motivo para ser nombrado el Novato del Año en los Premios Deportivos de CCTV en 2010.\r\n\r\nEn el Campeonato Mundial de 2011, Sun rompió el récord mundial en los 1500 m de estilo libre, establecido desde hace mucho tiempo por Grant Hackett y que fue el récord mundial de más larga duración en la natación.\r\n\r\nEl 28 de julio de 2012, durante los Juegos Olímpicos de Londres, ganó el oro en los 400 m libre batiendo el récord olímpico y convirtiéndose en el primer chino en ganar un título olímpico de natación.5​ El 4 de agosto ganó el oro en los 1500 m libres y rompió su propio récord mundial. Además, consiguió el segundo lugar en los 200 m libre.\r\n\r\nEn el Campeonato Mundial de Barcelona del año 2013 ganó la medalla de oro en las tres pruebas de fondo, algo que sólo había conseguido antes el australiano Grant Hackett en Montreal 2005, lo que le valió para ser elegido el mejor nadador masculino del Mundial.\r\n\r\nEl 17 de mayo de 2014 Sun Yang dio positivo por un estimulante (trimetazidina), en un control efectuado en los campeonatos nacionales. La trimetazidina, una sustancia capaz de mejorar la circulación coronaria, fue añadida a la lista internacional de sustancias prohibidas en enero de 2014. Yang, que fue suspendido por 3 meses, alegó que tomó trimetazidina por unos problemas de circulación.\r\n\r\nEn los Juegos Olímpicos de Río de Janeiro 2016, Yang obtuvo dos medallas olímpicas. En los 200 metros libre obtuvo medalla de oro con una marca de 1:44,65 y medalla de plata en 400 metros libre con un tiempo de 3:41,68.\r\n', 'ZCINW_k3NCs', 1),
(8, 'Yuzuru Hanyu', '羽生 結弦', 'yuzuru_hanyu.jpg', 1994, 'Es un patinador japonés, campeón olímpico de Sochi 2014 y Pieonchang 2018 en patinaje artístico y campeón mundial de 2014 y 2017.\r\n\r\nHa sido campeón del Grand Prix de patinaje artístico sobre hielo desde 2013 hasta 2016,​ y cuatro veces campeón nacional japonés en 2012, 2013, 2014 y 2015. Se convirtió en el más joven ganador de los juegos olímpicos desde Dick Button en 1948, y el primer asiático en ganar el oro olímpico en patinaje masculino.​ En la final del Gran Prix de Barcelona 2015 alcanzó el récord mundial hasta la fecha en el programa corto y puntuación total.​ Hanyu se convirtió en el primer patinador en la historia en completar un cuádruple loop en una competición.​ Es el único patinador que ha ganado cuatro veces consecutivas la final del Grand Prix.\r\n\r\nConsiderado como uno de los patinadores artísticos más grandes, si no el más grande de la historia, Hanyu ha batido récords mundiales dieciocho veces, la mayor cantidad de veces entre los patinadores individuales desde la introducción del Sistema de Evaluación de la ISU en 2004. Tiene el récord mundial actual para el programa corto, además de los récords mundiales históricos para los tres segmentos de la era anterior a la temporada 2018-19.\r\n\r\nEs el primer hombre que ha roto la barrera de los 100 puntos en el programa corto de los hombres, la barrera de los 200 puntos en el patinaje libre de los hombres y la barrera de los 300 puntos en la puntuación total combinada ', 'U8VfFpC9K9o', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `deportistas`
--
ALTER TABLE `deportistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_deporte` (`id_deporte`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `deportistas`
--
ALTER TABLE `deportistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deportistas`
--
ALTER TABLE `deportistas`
  ADD CONSTRAINT `deportistas_ibfk_1` FOREIGN KEY (`id_deporte`) REFERENCES `deporte` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
