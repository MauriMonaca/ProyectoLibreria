-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2019 a las 15:54:32
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_callejon'
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--


CREATE TABLE  IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL,
  `isbn` varchar(13) DEFAULT NULL UNIQUE,
  `nombre_libro` varchar(255) DEFAULT NULL,
  `autor_libro` varchar(255) DEFAULT NULL,
  `imagen_libro` varchar(255) DEFAULT NULL,
  `descripcion_libro` varchar(1000) DEFAULT NULL,
  `precio_libro` int(11) DEFAULT NULL,
  `stock_libro` int(11) DEFAULT NULL,
  `editorial` varchar(50) DEFAULT NULL,
  `anio` int(4) DEFAULT NULL,
  `tematicas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `libros` ( `id_libro`, `isbn`, `nombre_libro`, `autor_libro`, `imagen_libro`,
   `descripcion_libro`, `precio_libro`, `stock_libro`, `editorial`,`anio`,`tematicas`) VALUES
(1, '23467826234', 'Don Quijote de la Mancha', 'Miguel de Cervantes', './book-img/f0f39e05f02c298210806d9c6de3b4ac.jpg', 'Es la primera obra genuinamente desmitificadora de la tradición caballeresca y cortés por su tratamiento burlesco. Representa la primera novela moderna y la primera novela polifónica; como tal, ejerció un enorme influjo en toda la narrativa europea. Por considerarse -el mejor trabajo literario jamás escrito-, encabezó la lista de las mejores obras literarias de la historia.', '522', '24', 'Pangea','1605','Clasico Suspenso'),
(2, '213213111123', 'Juego de Tronos', 'George RR Martin', './book-img/aa666ce4b591ba99b59cc658ce305843.jpg', 'Tras el largo verano, el invierno se acerca a los Siete Reinos. Lord Eddard Stark, señor de Invernalia, deja sus dominios para unirse a la corte del rey Robert Baratheon el Usurpador, hombre díscolo y otrora guerrero audaz cuyas mayores aficiones son comer, beber y engendrar bastardos. Eddard Stark desempeñará el cargo de Mano del Rey e intentará desentrañar una maraña de intrigas que pondrá en peligro su vida... y la de los suyos. En un mundo cuyas estaciones duran décadas y en el que retazos de una magia inmemorial y olvidada surgen en los rincones más sombrios y maravillosos, la traición y la lealtad, la compasión y la sed de venganza, el amor y el poder hacen del juego de tronos una poderosa trampa que atrapa en sus fauces a los personajes... y al lector.', '1599', '21', 'Eidos','1996','Fantasia'),
(3, '993982938944', 'Ficciones', 'Jorge Luis Borges', './book-img/11467ffa2ba2e31a748e8801a83ed880.jpg', 'El libro se divide en dos secciones llamadas El jardín de senderos que se bifurcan y Artificios. A pesar de ello no difieren en estilo; la única diferencia notable reside en las fechas en que aparecieron los textos y en que la segunda sección es ligeramente más breve que la primera. La división del libro en dos se debe a que la primera parte había sido publicada originalmente tres años antes, en 1941, como un libro individual. A la serie de cuentos que constituían el libro El jardín de senderos que se bifurcan Borges agregó seis más, agrupados bajo el título general de Artificios, para diferenciarlos de algún modo de los cuentos de aquel y las dos partes, entonces, tomaron el nombre de Ficciones.', '352', '15', 'Centauri','1944','Nacional Surrealismo'),
(4, '489832478323', 'Rayuela', 'Julio Cortazar', './book-img/e4f1f0fd60194174f7e5af1bd7d3361a.jpg', 'Narra la historia de Horacio Oliveira, su protagonista, pone en juego la subjetividad del lector y tiene múltiples finales. A esta obra suele llamársela «antinovela», aunque el mismo Cortázar prefería denominarla «contranovela». Significó un salto al vacío que lo distanció de la seguridad controlada de los cuentos fantásticos de su primera época para adentrarse en una búsqueda sin hallazgos a través de preguntas sin respuesta. Si bien el estilo que se mantiene a lo largo de la novela es muy variado. Según el propio Cortázar, la obra: «De alguna manera es la experiencia de toda una vida y la tentativa de llevarla a la escritura»', '532', '22', 'Arda','1963','Clasico Nacional'),
(5, '601230123413', 'El Silmarillion', 'JRR Tolkien', './book-img/46cf04c941bea9d464f2d42a7842162e.jpg', 'El Silmarillion, como otros compendios de los trabajos de Tolkien (tales como los Cuentos inconclusos, Las aventuras de Tom Bombadil y otros poemas de El Libro Rojo, y El camino sigue y sigue), forma una trama que, aunque incompleta, describe el universo de la Tierra Media antes de que se produjeran los acontecimientos narrados en El hobbit y El Señor de los Anillos. La historia de la Tierra Media comprende doce volúmenes que examinan los procesos que condujeron a la publicación de estas obras, basándose en los borradores iniciales del autor y el comentario de Cristopher Tolkien.', '800', '42', 'Arda','1977','Clasico Fantasia'),
(6, '664234555125', 'El Nombre del Viento', 'Patrick Rothfuss', './book-img/0df8223c00078f507f501b574c159ed7.jpg', 'La obra se desarrolla en un mundo fantástico y narra la historia de Kvothe (pronunciado “Cuouz”), arcanista, asesino, enamorado, músico, estudiante y aventurero; y de cómo se convirtió en un personaje legendario. Usando el nombre de Kote para ocultar su verdadera identidad, regenta una apartada posada llamada Roca de Guía, acompañado de su discípulo Bast. Un día les visita Devan Lochees, un escribano conocido como “Cronista”, interesado en escribir las biografías de las figuras más importantes de su tiempo, quien intenta convencerle para que revele su verdadera historia. Kvothe accede, con la condición de hacerlo en tres días.', '755', '36', 'Eidos','2007','Suspenso Fantasia'),
(7, '884781734822', 'El Tunel', 'Ernesto Sabato', './book-img/a25edec3ab4b163666fa0c4c2c0ed871.jpg', 'El túnel es una novela corta argentina escrita por Ernesto Sábato en 1948. Juan Pablo Castel, personaje principal y narrador, cuenta desde la cárcel los motivos que lo llevaron a cometer un asesinato contra su amante María Iribarne. El protagonista que se complica a sí mismo, una persona fuertemente atribulada por la existencia, cree encontrar en María Iribarne un alma afín que le comprende y entiende sus pensamientos, cuando ella nota un rasgo de una de sus pinturas en una exposición, pero pronto descubre que no es así y se siente gravemente herido. La soledad se puede ver representada en la metáfora del túnel. Castel camina por un túnel del cual se encuentran alejadas las demás personas, va solo. Al matar a María le dice que lo hace porque lo ha dejado solo. Le teme a la soledad y busca a alguien que lo comprenda, que lo acompañe. También María busca a alguien, al final es eso lo que los lleva a conocerse.', '960', '74', 'Lyra','1948','Clasico Suspenso'),
(8, '834737712717', 'Asi hablo Zaratustra', 'Friedrich Nietzsche', './book-img/ee660671742bd31ae0aca66ce9e22c00.jpg', 'La obra contiene las principales ideas de Nietzsche, expresadas de forma poética: está compuesta por una serie de relatos y discursos que ponen en el centro de atención algunos hechos y reflexiones de un profeta llamado Zaratustra, personaje inspirado en Zoroastro, fundador del mazdeísmo o zoroastrismo. Compuesta principalmente por episodios más o menos independientes, sus historias pueden leerse en cualquier orden a excepción de la cuarta parte de la obra, pues son un cúmulo de ideas y relatos.', '566', '51', 'Pangea','1883','Clasico');



--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `id_editorial` int(10) NOT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `cuit` varchar(255) DEFAULT NULL,
  `nombre_editorial` varchar(255) DEFAULT NULL,
  `telefono` int(15) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL UNIQUE,
  `email` varchar(40) DEFAULT NULL UNIQUE,
  `género` varchar(12) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `rol` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nombre`, `email`, `género`, `password`, `rol`) VALUES
(1, 'admin123', 'admin@grancallejon.com', 'Masculino', 'admin123', 'administrador'),
(2, 'user1234', 'user@grancallejon.com', 'Masculino', 'user1234', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id_vendedor` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id_vendedor`, `nombre`, `apellido`, `fecha_ingreso`) VALUES
(1, 'Mercedes', 'Sosa', '2017-08-16'),
(2, 'Czeslav', 'Popowicz', '2016-09-25'),
(3, 'Elmer', 'Figueroa Arce', '2015-05-15'),
(4, 'Roberto', 'Sanchez', '2017-03-29'),
(5, 'Laura Ana', 'Merello', '2016-11-28'),
(6, 'Isabel', 'Sarli', '2016-04-18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `editorial
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id_vendedor`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `id_editorial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- AUTO_INCREMENT de la tabla `usuarios`
--  
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
