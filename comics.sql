-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 22 Novembre 2019 à 07:20
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `comics`
--

-- --------------------------------------------------------

--
-- Structure de la table `accueilwallpaper`
--

CREATE TABLE `accueilwallpaper` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `colorText` varchar(50) NOT NULL,
  `colorBouton` varchar(50) NOT NULL,
  `colorShadow` varchar(10) NOT NULL,
  `fond` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `accueilwallpaper`
--

INSERT INTO `accueilwallpaper` (`id`, `img`, `colorText`, `colorBouton`, `colorShadow`, `fond`) VALUES
(1, 'XtXqQc1.png', '#000', '#ffd900', '#bc1b05', 0),
(2, 'xmen.jpg', '#fff', '#aa1114', '#000', 0),
(0, 'comics.png', '#fff', 'transparent', '#000', 0),
(4, '407469.jpg', '#fff', '#000', '#824d69', 1),
(5, '84241dec1e2b93b39df4f005b123a26f.jpg', '#fcad36', '#000', '#6b3125', 0),
(6, '532b5918a15bd.jpg', '#fff', '#000', '#3771ba', 1),
(7, '332137-marvel-wallpapers.jpg', '#fff', '#000', '#d3137a', 1),
(8, '525071.jpg', '#71c04b', '#000', '#fff', 0),
(9, 'Hellboy-Wallpapers-002.jpg', '#cc3c46', '#e3a826', '#e3a826', 0),
(3, 'wolverine.jpg', '#ffb400', '#1d2158', '#1d2158', 1);

-- --------------------------------------------------------

--
-- Structure de la table `aecrit`
--

CREATE TABLE `aecrit` (
  `idAuteur` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `allié`
--

CREATE TABLE `allié` (
  `heros` int(10) NOT NULL,
  `allie` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `allié`
--

INSERT INTO `allié` (`heros`, `allie`) VALUES
(6, 44),
(6, 43),
(6, 60),
(6, 20);

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `desc` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `commentaire` varchar(500) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `isbn`, `commentaire`, `user`, `date`) VALUES
(1, '2809454132', 'test', 5, '2019-09-24 12:50:40'),
(2, '2809454132', 'test2', 6, '2019-09-24 12:50:41'),
(3, '2809454132', 'test3', 5, '2019-09-24 12:50:42'),
(4, '2809454132', 'test4', 6, '2019-09-24 12:52:40'),
(20, '2809454132', 'php', 6, '2019-09-25 13:50:28'),
(21, '2809454132', 'testajax', 6, '2019-09-27 11:58:15'),
(22, '2809454132', 'testAjax', 5, '2019-09-27 11:58:15');

-- --------------------------------------------------------

--
-- Structure de la table `enemi`
--

CREATE TABLE `enemi` (
  `heros` int(10) NOT NULL,
  `enemi` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enemi`
--

INSERT INTO `enemi` (`heros`, `enemi`) VALUES
(6, 92),
(6, 99),
(6, 16),
(6, 42);

-- --------------------------------------------------------

--
-- Structure de la table `envie`
--

CREATE TABLE `envie` (
  `ISBN` varchar(500) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `envie`
--

INSERT INTO `envie` (`ISBN`, `idUser`, `date`) VALUES
('2809422133', 5, '2019-08-06 08:05:41'),
('2809422923', 5, '2019-08-06 08:07:45');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `equipe` int(11) NOT NULL,
  `heros` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`equipe`, `heros`) VALUES
(4, 6),
(74, 6);

-- --------------------------------------------------------

--
-- Structure de la table `herotocomics`
--

CREATE TABLE `herotocomics` (
  `idComics` varchar(100) NOT NULL,
  `idHeros` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `herotocomics`
--

INSERT INTO `herotocomics` (`idComics`, `idHeros`) VALUES
('2809468435 ', 1),
('2809467080', 1),
('280946085X', 1),
('2809463972', 1),
('2809438277', 2),
('2809455813', 3),
('2809466904', 5),
('102681166X', 4),
('2365779018', 6),
('1026812003', 6),
('2809448779', 7),
('2365778976', 15),
('2809425493 ', 1),
('2809425272 ', 1),
('2809423970', 1),
('2809423814', 1),
('2809423210', 1),
('2809422923', 1),
('280942280X', 1),
('2809422133', 1),
('280942179X', 1),
('2809420963 ', 1),
('2809418799', 1),
('2809467080', 126),
('2809448302', 7),
('2809455155', 130),
('2809468311', 7),
('2365778976', 71),
('2365778976', 63),
('2365778976', 54),
('2365778976', 75),
('2365778976', 36),
('2365778976', 98),
('2365778976', 76),
('2365778976', 67),
('2756093327', 12),
('2809428018', 1),
('2756080772', 12),
('2756093319', 12),
('2756077062 ', 12),
('102681166X', 6),
('102681166X', 17),
('102681166X', 10),
('102681166X', 20),
('102681166X', 83),
('102681166X', 22),
('102681166X', 70),
('102681166X', 14),
('2809473323', 128),
('2809462933', 1),
('2809463549', 1),
('2809462526', 1),
('2809460922', 1),
('2809460531', 1),
('280945986X', 1),
('280945972X', 1),
('2809459347', 1),
('2809459231', 1),
('2809459061', 1),
('2809458510', 1),
('2809462534', 1),
('2809459738', 1),
('280945924X', 1),
('2809463557', 7),
('2809462941', 7),
('2809462542', 7),
('2809460930', 7),
('280946054X', 7),
('2809459878', 7),
('2809459746', 7),
('2809459355', 7),
('2809459258', 7),
('280945907X', 7),
('2809458529', 7),
('2809458367', 7),
('2809460558', 7),
('2809459363', 7),
('2809458561', 7),
('2809464030', 8),
('2809458413', 8),
('2809462593', 8),
('2809455155', 129),
('2809454132', 129),
('2809462690', 7),
('2809471274', 129),
('2809452377', 129),
('280945292X', 129),
('280945292X', 130),
('2809454132', 130),
('2809452512', 129),
('2809452512', 130),
('2809458340', 1),
('2809450919', 7),
('2809451567', 7),
('2809452067', 7),
('2809452296', 7),
('2809452520', 7),
('2809452938', 7),
('2809453721', 7),
('2809463980', 7),
('2809464359', 7),
('2809465258', 7),
('2809465665', 7),
('2809465991', 7),
('280944143X', 7),
('2809448043', 7),
('2809456496', 7),
('2809439672', 7),
('2809439672', 26),
('2809447853', 7),
('2809447853', 26),
('2809455333', 128),
('2809455333', 7),
('2809456879', 7),
('2809462712', 7),
('280945731X', 7),
('280945731X', 8),
('2809460809', 7),
('2809460809', 8),
('2809452792', 7),
('2809441472', 7),
('2809450110', 7),
('2809462704', 7),
('2809470146', 7),
('2809477655', 7),
('2809451397', 7),
('2809465541', 1),
('2809466998', 1),
('2809470901', 1),
('2809473064', 1),
('2809476276', 1),
('2809477086', 1),
('2809442096', 1),
('2809447888', 1),
('2809450382', 1),
('2809453330', 1),
('2809435944', 1),
('2809440018', 1),
('2809446520', 1),
('2809451265', 1),
('2809455619', 1),
('2809457212', 1),
('2809462852', 1),
('2809465177', 1),
('2809464170', 1),
('2809453349', 1),
('2809441731', 1),
('2809476659', 1),
('2809452725', 1),
('2809451141', 1),
('2809473552', 1),
('2809441820', 1),
('2809444005', 1),
('2809451214', 1),
('2809453314', 1),
('2809454426', 1),
('2809473595', 1),
('2809446156', 1),
('2809450579', 1),
('2809453306', 1),
('2809457174', 1),
('280946281X', 1),
('2809465827', 1),
('2809463352', 1),
('2809470332', 1),
('2809470863', 1),
('2809429480', 1),
('2809432228', 1),
('2809432627', 1),
('2809434034', 1),
('2809436657', 1),
('2809437742', 1),
('2809438072', 1),
('2809441081', 1),
('2809442630', 1),
('2809445036', 1),
('2809446784', 1),
('2809447381', 1),
('2809448388', 1),
('280945096X', 1),
('2809452113', 1),
('2809452970', 1),
('2809454051', 1),
('2809447179', 1),
('2809449902', 1),
('2809452016', 1),
('2809453756', 1),
('2809454248', 1),
('2809452571', 1),
('2809427178', 1),
('2809429189', 1),
('2840557509', 11),
('2809464332', 1),
('280946524X', 1),
('2809465649', 1),
('2809465983', 1),
('2809464332', 1),
('280946524X', 1),
('2809465649', 1),
('2809465983', 1),
('2809467072', 1),
('2809467250', 1),
('2809468729', 1),
('2809469911', 1),
('2809470960', 1),
('2809471525', 1),
('2809469636', 1),
('2809464340', 1),
('2809465657', 1),
('2809471606', 1),
('2809473137', 1),
('2809473420', 1),
('2809473706', 1),
('2809473862', 1),
('2809474737', 1),
('2809476071', 1),
('2809476365', 1),
('2809476845', 1),
('2809477183', 1),
('2809477477', 1),
('2809477787', 1),
('2365775721', 13),
('2365778062', 13);

-- --------------------------------------------------------

--
-- Structure de la table `herotoseries`
--

CREATE TABLE `herotoseries` (
  `idHeros` int(10) NOT NULL,
  `idSerie` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `herotoseries`
--

INSERT INTO `herotoseries` (`idHeros`, `idSerie`) VALUES
(1, 1),
(1, 2),
(1, 45),
(12, 9),
(128, 10),
(1, 12),
(1, 13),
(7, 14),
(7, 15),
(8, 16),
(129, 17),
(129, 18),
(130, 17),
(1, 20),
(7, 22),
(7, 23),
(7, 24),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(7, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 46),
(11, 6),
(1, 47),
(1, 48),
(1, 49),
(13, 51);

-- --------------------------------------------------------

--
-- Structure de la table `héros`
--

CREATE TABLE `héros` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `pouvoir` varchar(500) NOT NULL,
  `img` varchar(500) DEFAULT 'heros.jpg',
  `Univers` varchar(50) NOT NULL,
  `Logo` varchar(200) DEFAULT 'logo.png'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `héros`
--

INSERT INTO `héros` (`id`, `nom`, `desc`, `pouvoir`, `img`, `Univers`, `Logo`) VALUES
(1, 'Deadpool', '                                                                                                                                                                                                                                                                                                                                                                                                 Wade Winston Wilson, alias Deadpool, est un anti-héros appartenant à l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Fabian Nicieza et le dessinateur/scénariste Rob Liefeld, le personnage de fiction apparaît pour la première fois dans The New Mutants #98 en février 1991.      \r\n                             \r\n                             \r\n                             \r\n                             \r\n                             \r\n                             ', 'Facteur guérisseur,Force, endurance, agilité, et réflexes accrus', 'heros1.jpg', 'Marvel', 'logo1.png'),
(2, 'Captain America', '                                                                                                                                                                Captain America est un super-héros de bande dessinée créé par le dessinateur Jack Kirby et le scénariste Joe Simon. Évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics, le personnage de fiction apparaît pour la première fois dans le comic book Captain America Comics #1 de décembre 1940n 1.\r\n\r\n                             \r\n                             \r\n                             \r\n                             \r\n                             ', 'Condition physique à l\'apogée de l\'évolution humaine', 'heros2.jpg', 'Marvel', 'logo2.png'),
(3, 'The Avengers', 'L\'équipe des Vengeurs (« The Avengers » en version originale) est un groupe de super-héros édité par Marvel Comics, appartenant à l\'univers Marvel et constitué de personnages déjà apparus dans des comics précédents.\n\nEn France, le comic a été publié pour la première fois par Arédit/Artima dans Eclipso no 15 (août 1971), même si les personnages avaient déjà fait quelques apparitions sporadiques dans d\'autres séries éditées chez Lug depuis 1970.\n                             ', '', 'heros3.jpg', 'Marvel', 'logo3.png'),
(4, 'Justice League of America ', 'La Ligue de justice d\'Amérique (Justice League of America ou JLA en version originale) est une équipe de fiction regroupant les principaux super-héros de l\'éditeur DC Comics.\n                             ', '', 'heros4.jpg', 'DC Comics', 'logo4.png'),
(5, 'Ms Marvel', 'Kamala Khan est une adolescente de 16 ans qui vit à Jersey City dans le New Jersey avec ses parents et son frère. Elle obtient ces pouvoirs dans un nuage de tératogène lié au crossover Infinity, ce qui fait d\'elle une inhumaine, une métamorphe.\n                             ', '', 'heros5.jpg', 'Marvel', 'logo5.png'),
(6, 'Batman', '                                Batman est un personnage de fiction appartenant à l\'univers de DC Comics. Créé par le dessinateur Bob Kane et le scénariste Bill Finger, il apparaît pour la première fois dans le comic book Detective Comics no 27 (date de couverture : mai 1939 mais la date réelle de parution est le 30 mars 1939) avec le nom de The Bat-Man. \n                             ', 'Aucun', 'heros6.jpg', 'DC Comics', 'logo6.png'),
(7, 'Les gardiens de la galaxie', 'Les Gardiens de la Galaxie est le nom de deux équipes de super-héros appartenant à l\'univers de Marvel Comics. Créée par le scénariste Arnold Drake et le dessinateur Gene Colan, la première équipe est apparue pour la première fois dans le comic book Marvel Super-Heroes #18 en 1969. \n                             ', '', 'heros7.jpg', 'Marvel', 'logo7.png'),
(8, 'X-men', '                                                                Les X-Men sont un groupe de super-héros, créé par le scénariste Stan Lee et le dessinateur Jack Kirby, dont les aventures ont été publiées dans le comic book X-Men édité par Marvel Comics à partir de septembre 1963. En France, ils sont apparus pour la première fois en janvier 1970 dans le journal Strange no 1 publié par les éditions Lug.\r\n                             \r\n                             ', '', 'heros8.jpg', 'Marvel', 'logo8.png'),
(9, 'X-Force', 'X-Force est une équipe de mutants appartenant à l\'univers de fiction de Marvel Comics. Apparue pour la première fois dans New Mutants Vol. 1 #100, créée par Fabian Nicieza et Rob Liefeld, elle donna lieu à sa propre série continue de 1991 à 2002, et à une mini-série parue entre la fin 2004 et 2005. Il s\'agissait de l\'une des nombreuses séries dérivées de la populaire franchise X-Men.\n                             ', '', 'heros9.jpg', 'Marvel', 'logo9.png'),
(10, 'Aquaman', 'Aquaman est un super-héros appartenant à l\'univers de DC Comics, et le héros de la série du même nom. Il a été créé par Paul Norris et Mort Weisinger dans More Fun Comics #73 publié en 1941.\n                             ', 'Adaptation à la vie sous-marine,Télépathie avec les entités marines,Force, endurance et sens développésRésistance à la chaleur et à tout type d\'énergie', 'heros10.jpg', 'DC Comics', 'logo10.png'),
(11, 'Hellboy', 'Hellboy est une série de comics mettant en scène le personnage éponyme, écrite et dessinée par Mike Mignola. Elle est constituée de one-shots et miniséries publiés d\'abord par Image Comics puis par Dark Horse aux États-Unis et traduits par Delcourt (qui succède à Dark Horse France) en France.\n                             ', '', 'heros11.jpg', 'Autre', 'logo11.png'),
(12, 'Spawn ', '                                                                Spawn est un comic book de fiction sur le personnage éponyme créé par Todd McFarlane. Il a été lancé par l\'éditeur Image Comics en mai 1992 aux États-Unis. En France, il est publié par Semic puis par Delcourt dans la collection Contrebande. Une adaptation cinématographique a été réalisée en 1997.\r\n                             \r\n                             ', '', 'heros12.jpg', 'Semic', 'logo12.png'),
(13, 'Arrow', 'Green Arrow (de son vrai nom Oliver « Ollie » Queen) est un personnage de comics appartenant à l\'univers de DC Comics créé par Mort Weisinger et George Papp. Il est apparu pour la première fois dans More Fun Comics #73 en 1941.\n                             ', 'Maître d\'arme (arc, sabres, épée, pistolets),expert au corps a corps, multi-flèche (flèche explosive, collantes, cryogénique, etc.)', 'heros13.jpg', 'DC Comics', 'logo13.png'),
(14, 'Green Lantern coprs', '                            \n                             ', '', 'heros14.jpg', 'DC Comics', 'logo14.png'),
(71, 'Harley Quinn', '                                \n                             ', '', 'heros71.jpg', 'DC Comics', 'logo71.png'),
(72, 'Hawkgirl', '                                \r\n                             ', '', 'heros72.jpg', 'DC Comics', 'logo72.png'),
(73, 'Hawkman', '                                \r\n                             ', '', 'heros73.jpg', 'DC Comics', 'logo73.png'),
(74, 'Justice League', '                                \r\n                             ', '', 'heros74.jpg', 'DC Comics', 'logo74.png'),
(75, 'Katana', '                                \r\n                             ', '', 'heros75.jpg', 'DC Comics', 'logo75.png'),
(76, 'Killer Croc', '                                \r\n                             ', '', 'heros76.jpg', 'DC Comics', 'logo76.png'),
(15, 'Suicide Squad', '                                Suicide Squad (L\'Escadron Suicide) est une équipe de super-vilains appartenant à l\'univers DC Comics. Elle est apparue pour la première fois en 1959 dans The Brave and the Bold #25. À partir de 1987, Suicide Squad possède sa propre bande dessinée. L\'équipe Task Force X est créée en 1987 par John Ostrander.\r\n                             ', '', 'heros15.jpg', 'DC Comics', 'logo15.png'),
(16, 'Joker ', '                                Le Joker est un personnage de fiction apparu dans les comic books de DC Comics. Le personnage a été créé par Jerry Robinson, Bill Finger et Bob Kane, et est apparu pour la première fois dans Batman #1, au printemps 1940. Le créateur du personnage est contesté, Kane et Robinson ayant à la fois revendiqué la conception du Joker mais reconnu l\'écriture du personnage de la main de Finger. \r\n                             ', '', 'heros16.jpg', 'DC Comics', 'logo16.png'),
(17, 'Superman', '                                Superman est un super-héros de bande dessinée américaine appartenant au monde imaginaire de l’Univers DC. Ce personnage de fiction est considéré comme une icône culturelle américaine\r\n                             ', 'pouvoirs physiques,extra sensoriels,gravitationnels,mentaux', 'heros17.jpg', 'DC Comics', 'logo17.png'),
(18, 'Spider Man', '                                Peter Parker, alias Spider-Man (souvent écrit « Spiderman » de façon erronée), est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee et le dessinateur Steve Ditko, le personnage de fiction apparaît pour la première fois dans le comic book Amazing Fantasy #15 en 1962.\r\n                             ', 'Force, endurance, agilité et réflexes surhumains,Précognition (« sens d\'araignée »)</li>,Facteur guérisseur', 'heros18.jpg', 'DC Comics', 'logo18.png'),
(19, 'Thor', '                                Thor est une divinité et un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par l\'éditeur Stan Lee, le scénariste Larry Lieber et le dessinateur Jack Kirby, le personnage de fiction apparaît pour la première fois dans le comic book Journey into Mystery #83 d\'août 1962. En France, sa première apparition a lieu dans Eclipso no 15 d\'août 1971.\r\n                             ', 'Force, durabilité et résistance surhumaines,Longévité', 'heros19.jpg', 'DC Comics', 'logo19.png'),
(20, 'Wonder Woman', '                                Wonder Woman est une super-héroïne de bande dessinée américaine créée par William Moulton Marston (sous le pseudonyme de Charles Moulton), en décembre 1941, dans All Star Comics. Elle est, à cette époque, l\'une des premières super-héroïnes et demeure la plus célèbre d\'entre elles.\r\n                             ', '<li>Super-force</li><li>vol</li><li>super-vitesse</li><li>longévité accrue</li><li>télépathie animale</li><li>résistance au contrôle mental</li><li>grande résistance à la magie</li><li>régénération</li><li>projection astrale</li>', 'heros20.jpg', 'DC Comics', 'logo20.png'),
(21, 'Nightwing', '                                Richard John « Dick » Grayson est un personnage de fiction créé par Bob Kane, Bill Finger et Jerry Robinson dans Detective Comics #38 en 1940. Il a porté le costume de Robin puis celui de Nightwing, un costume noir et bleu, et a endossé pendant une courte période celui de Batman. Récemment, il a repris son rôle de Nightwing, vêtu cette fois-ci de rouge et de noir.\r\n                             ', '', 'heros21.jpg', 'DC Comics', 'logo21.png'),
(22, 'Flash', '                                Flash est le nom de plusieurs personnages de fiction appartenant à l\'univers de DC Comics.\r\n                             ', '<li>Super-vitesse</li><li>Régénération accéléré</li><li>Voyage dans le temps</li><li>Endurance hors-norme</li>', 'heros22.jpg', 'DC Comics', 'logo22.png'),
(23, 'Les Quatre Fantastiques', '                                Les Quatre Fantastiques ou Les Fantastiques (Fantastic Four en anglais) sont un groupe de super-héros appartenant à l\'univers Marvel de la société Marvel Comics. Créée par le scénariste Stan Lee et le dessinateur Jack Kirby, l\'équipe apparaît pour la première fois dans le comic book Fantastic Four #1 de novembre 1961.\r\n                             ', '', 'heros23.jpg', 'DC Comics', 'logo23.png'),
(24, 'Surfer d\'argent', '                                Norrin Radd, alias le Surfer d’argent (« The Silver Surfer » en version originale) est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le dessinateur Jack Kirby, le personnage de fiction apparaît pour la première fois dans le comic book Fantastic Four #48 en mars 1966. En France, il apparaît dans Fantask no 1 en février 1969.\r\n                             ', '<li>pouvoir cosmique</li><li>Invulnérabilité</li><li>Immortalité</li><li>Vol supersonique et dans l\'espace (avec son surf)</li>', 'heros24.jpg', 'Marvel', 'logo24.png'),
(25, 'Wolverine', '                                Wolverine est un personnage de fiction appartenant à l\'univers de Marvel Comics. C\'est un super-héros, membre des X-Men et des New Avengers. Son vrai nom est James Howlett, mais ayant oublié son passé, il se fait appeler Logan.\r\n                             ', '<li>Facteur guérisseur et régénérateur</li><li>vieillissement ralenti</li><li>squelette et griffes en adamantium</li><li>sens hyper-développés</li><li>force extrême</li><li>forte endurance</li><li>grande agilité et vitesse de réaction accrue</li>', 'heros25.jpg', 'Marvel', 'logo25.png'),
(26, 'Iron Man', '                                Anthony « Tony » Stark, alias Iron Man (littéralement « l\'Homme de Fer »), est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee, développé par Larry Lieber, et conçu par les artistes Don Heck et Jack Kirby, le personnage de fiction apparaît pour la première fois dans le comic book Tales of Suspense #39 en mars 1963, scénarisé par Larry Lieber et dessiné par Don Heck.\r\n                             ', 'Avec son armure technologique :<li>Force et résistance surhumaines</li><li>Vol supersonique pouvant atteindre Mach 8</li><li>Répulseurs d\'énergie, lances-missiles et capteurs divers</li><li>Dispositif de survie et de régénération</li>', 'heros26.jpg', 'Marvel', 'logo26.png'),
(27, 'Supergirl', '                                Supergirl est le nom de plusieurs personnages de fiction appartenant à l\'univers de DC Comics. Les Supergirls sont des dérivés féminin de Superman, plusieurs personnages basés sur le même principe ont fait quelques apparitions dans les comics avant la création de Supergirl.\r\n                             ', '<li>pouvoirs physiques</li> <li>extra sensoriels</li><<li>gravitationnels</li><li>mentaux</li>', 'heros27.jpg', 'DC Comics', 'logo27.png'),
(28, 'Daredevil', '                                Matt Murdock, alias Daredevila, est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par Stan Lee et Bill Everett, avec l\'aide de Jack Kirby et Steve Ditko, le personnage de fiction apparaît pour la première fois dans Daredevil #1 d\'avril 1964. En France, il apparaît à partir de 1970 dans le périodique Strange.\r\n                             ', '<li>Sens hyper-développés (ouïe, toucher, goût, odorat)</li><li>« Sens de proximité »</li><li>Excellent combattant au corps à corps et gymnaste</li>', 'heros28.jpg', 'Marvel', 'logo28.png'),
(29, 'Hulk', '                                Robert Bruce Banner, alias Hulk, est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee et le dessinateur Jack Kirby, le personnage de fiction apparaît pour la première fois dans le comic book The Incredible Hulk #1 en mai 1962.\r\n                             ', '<li>Force et résistance physique surhumaines quasi illimitées</li><li>Cicatrisation (régénération) et rapidité surhumaines</li><li>Bonds dans les airs</li><li>Capacités psychiques limitées</li>', 'heros29.jpg', 'Marvel', 'logo29.png'),
(30, 'Cyborg', '                                Un cyborg (de l\'anglais « cybernetic organism », traduisible par « organisme cybernétique ») est un être humain — ou à la rigueur un autre être vivant intelligent, en science-fiction — qui a reçu des greffes de parties mécaniques ou électroniques.\r\n                             ', '', 'heros30.jpg', 'DC Comics', 'logo30.png'),
(31, 'Black Panther', '                                T\'Challa, alias La Panthère noire (Black Panther), est un super-héros appartenant à l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee et le dessinateur Jack Kirby, le personnage de fiction apparait pour la première fois dans le comic book Fantastic Four #52 en juillet 1966.\r\n                             ', '<li>Sens aiguisés, force et agilité accrues</li><li>Acrobate et gymnaste</li><li>Intelligence proche du génie</li>', 'heros31.jpg', 'Marvel', 'logo31.png'),
(32, 'Docteur Strange', '                                Le docteur Stephen Strange, alias Docteur Strange (Doctor Strange en VO) est un super-héros appartenant à l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par me scénariste Stan Lee2 et le dessinateur Steve Ditko, le personnage de fiction apparaît pour la première fois dans le comic book Strange Tales #110 en 1963.\r\n                             ', '<li>Pouvoirs occultes</li><li>Projection astrale</li><li>Connaissance exceptionnelle de la sorcellerie</li><li>Utilisation de plusieurs types de magies</li>', 'heros32.jpg', 'Marvel', 'logo32.png'),
(33, 'Nova', '                                                                \r\n                             \r\n                             ', '', 'heros33.jpg', 'Marvel', 'logo33.png'),
(34, 'Iron Fist', '                                Daniel Rand, alias Iron Fist (littéralement « Poing de fer »), est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Roy Thomas et le dessinateur Gil Kane, le personnage de fiction apparaît pour la première fois dans Marvel Premiere #15 en mai 1974.\r\n                             ', '<li>Maître des arts martiaux</li><li>Possibilité de concentrer son chi dans ses poings</li><li>Facteur guérisseur</li>', 'heros34.jpg', 'Marvel', 'logo34.png'),
(35, 'Alfred Pennyworth', '                                                                \r\n                             \r\n                             ', 'aucun', 'heros35.jpg', 'DC Comics', 'logo35.png'),
(36, 'Amanda Waller', '                                                                                                \r\n                             \r\n                             \r\n                             ', 'aucun', 'heros36.jpg', 'DC Comics', 'logo36.png'),
(37, 'Anarky', '                                \r\n                             ', '', 'heros37.jpg', 'DC Comics', 'logo37.png'),
(38, 'Ares', '                                \r\n                             ', '', 'heros38.jpg', 'DC Comics', 'logo38.png'),
(39, 'Arsenal', '                                \r\n                             ', '', 'heros39.jpg', 'DC Comics', 'logo39.png'),
(40, 'Atom', '                                \r\n                             ', '', 'heros40.jpg', 'DC Comics', 'logo40.png'),
(41, 'Atrocitus', '                                \r\n                             ', '', 'heros41.jpg', 'DC Comics', 'logo41.png'),
(42, 'Bane', '                                \r\n                             ', '', 'heros42.jpg', 'DC Comics', 'logo42.png'),
(43, 'Batgirl', '                                \r\n                             ', '', 'heros43.jpg', 'DC Comics', 'logo43.png'),
(44, 'Batwoman', '                                \r\n                             ', '', 'heros44.jpg', 'DC Comics', 'logo44.png'),
(45, 'Beast Boy', '                                \r\n                             ', '', 'heros45.jpg', 'DC Comics', 'logo45.png'),
(46, 'Big Barda', '                                \r\n                             ', '', 'heros46.jpg', 'DC Comics', 'logo46.png'),
(47, 'Birds of prey', '                                \r\n                             ', '', 'heros47.jpg', 'DC Comics', 'logo47.png'),
(48, 'Bizarro', '                                \r\n                             ', '', 'heros48.jpg', 'DC Comics', 'logo48.png'),
(49, 'Black Adam', '                                \r\n                             ', '', 'heros49.jpg', 'DC Comics', 'logo49.png'),
(50, 'Black canary', '                                \r\n                             ', '', 'heros50.jpg', 'DC Comics', 'logo50.png'),
(51, 'Black manta', '                                \r\n                             ', '', 'heros51.jpg', 'DC Comics', 'logo51.png'),
(52, 'Blue beetle', '                                \r\n                             ', '', 'heros52.jpg', 'DC Comics', 'logo52.png'),
(53, 'Brainiac', '                                \r\n                             ', '', 'heros53.jpg', 'DC Comics', 'logo53.png'),
(54, 'Captain boomerang', '                                \r\n                             ', '', 'heros54.jpg', 'DC Comics', 'logo54.png'),
(55, 'Captain Cold', '                                \r\n                             ', '', 'heros55.jpg', 'DC Comics', 'logo55.png'),
(56, 'Catwoman', '                                \r\n                             ', '', 'heros56.jpg', 'DC Comics', 'logo56.png'),
(57, 'Clayface', '                                \r\n                             ', '', 'heros57.jpg', 'DC Comics', 'logo57.png'),
(58, 'Comissaire Gordon', '                                \r\n                             ', '', 'heros58.jpg', 'DC Comics', 'logo58.png'),
(59, 'Constantine', '                                \r\n                             ', '', 'heros59.jpg', 'DC Comics', 'logo59.png'),
(60, 'Damian wayne', '                                \r\n                             ', '', 'heros60.jpg', 'DC Comics', 'logo60.png'),
(61, 'Darkseid', '                                \r\n                             ', '', 'heros61.jpg', 'DC comics', 'logo61.png'),
(62, 'Deadman', '                                \r\n                             ', '', 'heros62.jpg', 'DC Comics', 'logo62.png'),
(63, 'Deadshot', '                                \r\n                             ', '', 'heros63.jpg', 'DC Comics', 'logo63.png'),
(64, 'Deathstroke', '                                \r\n                             ', '', 'heros64.jpg', 'DC Comics', 'logo64.png'),
(65, 'DoomsDay', '                                \r\n                             ', '', 'heros65.jpg', 'DC Comics', 'logo65.png'),
(66, 'El Diablo', '                                \r\n                             ', '', 'heros66.jpg', 'DC Comics', 'logo66.png'),
(67, 'Enchantress', '                                \r\n                             ', '', 'heros67.jpg', 'DC Comics', 'logo67.png'),
(68, 'Firestorm', '                                \r\n                             ', '', 'heros68.jpg', 'DC Comics', 'logo68.png'),
(69, 'Gorilla Grodd', '                                \r\n                             ', '', 'heros69.jpg', 'DC Comics', 'logo69.png'),
(70, 'Green lantern', '                                \r\n                             ', '', 'heros70.jpg', 'DC Comics', 'logo70.png'),
(77, 'Killer Frost', '                                \r\n                             ', '', 'heros77.jpg', 'DC Comics', 'logo77.png'),
(78, 'Krypto', '                                \r\n                             ', '', 'heros78.jpg', 'DC Comics', 'logo78.png'),
(79, 'Lex Luthor', '                                \r\n                             ', '', 'heros79.jpg', 'DC Comics', 'logo79.png'),
(80, 'Lobo', '                                \r\n                             ', '', 'heros80.jpg', 'DC Comics', 'logo80.png'),
(81, 'Lois Lane', '                                \r\n                             ', '', 'heros81.jpg', 'DC Comics', 'logo81.png'),
(82, 'Lucius Fox', '                                \r\n                             ', '', 'heros82.jpg', 'DC Comics', 'logo82.png'),
(83, 'Martian Manhunter', '                                \r\n                             ', '', 'heros83.jpg', 'DC Comics', 'logo83.png'),
(84, 'Maxwell Lord', '                                \r\n                             ', '', 'heros84.jpg', 'DC Comics', 'logo84.png'),
(85, 'Mera', '                                \r\n                             ', '', 'heros85.jpg', 'DC Comics', 'logo85.png'),
(86, 'Midnighter', '                                \r\n                             ', '', 'heros86.jpg', 'DC Comics', 'logo86.png'),
(87, 'Mister Freeze', '                                \r\n                             ', '', 'heros87.jpg', 'DC Comics', 'logo87.png'),
(88, 'Mister Miracle', '                                \r\n                             ', '', 'heros88.jpg', 'DC Comics', 'logo88.png'),
(89, 'Mister Terrific', '                                \r\n                             ', '', 'heros89.jpg', 'DC Comics', 'logo89.png'),
(90, 'New Gods', '                                \r\n                             ', '', 'heros90.jpg', 'DC Comics', 'logo90.png'),
(91, 'Pandora', '                                \r\n                             ', '', 'heros91.jpg', 'DC Comics', 'logo91.png'),
(92, 'Penguin', '                                \r\n                             ', '', 'heros92.jpg', 'DC Comics', 'logo92.png'),
(93, 'Plastic Man', '                                \r\n                             ', '', 'heros93.jpg', 'DC Comics', 'logo93.png'),
(94, 'Poison Ivy', '                                \r\n                             ', '', 'heros94.jpg', 'DC Comics', 'logo94.png'),
(95, 'Ra\'s al Ghul', '                                \r\n                             ', '', 'heros95.jpg', 'DC Comics', 'logo95.png'),
(96, 'Raven', '                                \r\n                             ', '', 'heros96.jpg', 'DC Comics', 'logo96.png'),
(97, 'Reverse-Flash', '                                \r\n                             ', '', 'heros97.jpg', 'DC Comics', 'logo97.png'),
(98, 'Rick Flag', '                                \r\n                             ', '', 'heros98.jpg', 'DC Comics', 'logo98.png'),
(99, 'Riddler', '                                \r\n                             ', '', 'heros99.jpg', 'DC Comics', 'logo99.png'),
(100, 'Rip Hunter', '                                \r\n                             ', '', 'heros100.jpg', 'DC Comics', 'logo100.png'),
(101, 'Robin', '                                \r\n                             ', '', 'heros101.jpg', 'DC Comics', 'logo101.png'),
(102, 'Scarecrow', '                                \r\n                             ', '', 'heros102.jpg', 'DC Comics', 'logo102.png'),
(103, 'Shazam!', '                                                                                                \r\n                             \r\n                             \r\n                             ', '', 'heros103.jpg', 'DC Comics', 'logo103.png'),
(104, 'Sinestro', '                                \r\n                             ', '', 'heros104.jpg', 'DC Comics', 'logo104.png'),
(105, 'Solomon Grundy', '                                \r\n                             ', '', 'heros105.jpg', 'DC Comics', 'logo105.png'),
(106, 'StarFire', '                                \r\n                             ', '', 'heros106.jpg', 'DC Comics', 'logo106.png'),
(107, 'Steppenwolf', '                                \r\n                             ', '', 'heros107.jpg', 'DC Comics', 'logo107.png'),
(108, 'Steve Trevor', '                                \r\n                             ', '', 'heros108.jpg', 'DC Comics', 'logo108.png'),
(109, 'Superboy', '                                \r\n                             ', '', 'heros109.jpg', 'DC Comics', 'logo109.png'),
(110, 'Swamp Thing', '                                \r\n                             ', '', 'heros110.jpg', 'DC Comics', 'logo110.png'),
(111, 'Telos', '                                \r\n                             ', '', 'heros111.jpg', 'DC Comics', 'logo111.png'),
(112, 'The Phantom Stranger', '                                \r\n                             ', '', 'heros112.jpg', 'DC Comics', 'logo112.png'),
(113, 'Double Face', '                                \r\n                             ', '', 'heros113.jpg', 'DC Comics', 'logo113.png'),
(114, 'Vandal Savage', '                                \r\n                             ', '', 'heros114.jpg', 'DC Comics', 'logo114.png'),
(115, 'Vixen', '                                \r\n                             ', '', 'heros115.jpg', 'DC Comics', 'logo115.png'),
(116, 'Watchmen', '                                \r\n                             ', '', 'heros116.jpg', 'DC Comics', 'logo116.png'),
(117, 'Zatana', '                                \r\n                             ', '', 'heros117.jpg', 'DC Comics', 'logo117.png'),
(118, 'Zod', '                                \r\n                             ', '', 'heros118.jpg', 'DC Comics', 'logo118.png'),
(119, 'Zoom', '                                \r\n                             ', '', 'heros119.jpg', 'DC Comics', 'logo119.png'),
(124, 'Flèche noire', '                                                             \r\n            Blackagar Boltagon, alias Flèche Noire (« Black Bolt » en VO) est un super-héros évoluant dans l\'univers Marvel de la maison d\'édition Marvel Comics. Créé par le scénariste Stan Lee et le dessinateur Jack Kirby, le personnage de fiction apparaît pour la première fois dans le comic book Fantastic Four #45 en décembre 1965.\r\n\r\nFlèche Noire fait partie de la famille royale de la race des Inhumains, dont il en est le souverain.                  ', '', 'heros124.jpg', 'Marvel', 'logo124.png'),
(125, 'Ghost Rider', '                             ', '', 'heros125.jpg', 'Marvel', 'logo125.png'),
(126, 'The Punisher', '                                                                                             \r\n                             \r\n                             ', '', 'heros126.jpg', 'Marvel', 'logo126.png'),
(128, 'Venom', '                             ', '', 'heros128.jpg', 'Marvel', 'logo128.png'),
(129, 'Ant-man', '                             ', '', 'heros129.jpg', 'Marvel', 'logo129.png'),
(130, 'Wasp', '                             ', '', 'heros130.jpg', 'Marvel', 'logo130.png');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `ISBN` varchar(20) NOT NULL,
  `EAN` varchar(50) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `Format` varchar(20) NOT NULL DEFAULT 'Revue',
  `Editeur` varchar(50) NOT NULL DEFAULT 'inconnu',
  `img` varchar(100) NOT NULL,
  `desc` varchar(500) DEFAULT '',
  `date` date DEFAULT NULL,
  `serie` int(10) DEFAULT '-1',
  `prix` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`ISBN`, `EAN`, `titre`, `Format`, `Editeur`, `img`, `desc`, `date`, `serie`, `prix`) VALUES
('2809468435', '978-2809468434', 'Deadpool - Tome 8', 'Revue', 'Marvel', '2809468435.jpg', '', '2018-01-03', 1, '5.90'),
('2809467080', '978-2809467086', 'Deadpool HS - Tome 3', 'Revue', 'Marvel', '2809467080.jpg', '', '2017-11-22', 47, '5.60'),
('2809438277', '978-2809438277', 'Captain America - Tome 01', 'Cartonné', 'Marvel', '2809438277.jpg', '', '2014-03-26', 0, '14.95'),
('2809455813', '978-2809455816', 'Avengers - Tome 2', 'Cartonné', 'Marvel', '2809455813.jpg', '', '2016-07-26', 0, '14.95'),
('2809466904', '978-2809466904', 'Ms Marvel - Tome 06', 'Cartonné', 'Marvel', '2809466904.jpg', 'Miss Marvel va devoir affronter un adversaire très particulier, qui utilise les réseaux sociaux pour terrifier les camarades de classe de Kamala Khan. ', '2017-11-08', 0, '15.00'),
('102681166X', '979-1026811664', 'Justice League of America - Tome 3', 'Cartonné', 'DC Comics', '102681166X.jpg', 'Superman, Batman, Wonder Woman, Aquaman, Green Lantern ou encore Flash font partie de la Ligue de justice.', '2017-10-27', 0, '28.00'),
('2365779018', '978-2365779012', 'Batman New Gotham Tome 2', 'Cartonné', 'DC Comics', '2365779018.jpg', 'Pour Stephanie Brown, la justicière Spoiler, ce devait être l\'apogée de sa carrière : remplaçant Tim Drake, elle était choisie pour devenir la nouvelle Robin ! Mais après un échec cuisant et son renvoi par Batman, elle décide de lui prouver sa valeur en appliquant l\'un de ses plans de secours pour neutraliser la pègre de Gotham. Les conséquences vont être désastreuses.', '2017-09-22', 0, '22.50'),
('1026812003', '979-1026812005', 'Batman New Gotham Tome 1', 'Cartonné', 'DC Comics', '1026812003.jpg', 'La nouvelle ville de Gotham vient de renaître de ses cendres mais les tensions sont palpables, ce qui profite au crime. Ra\'s al Ghul lance alors une nouvelle offensive contre la pègre, épaulé par deux nouveaux venus.', '2017-06-16', 0, '28.00'),
('2809465142', '978-2809465143', 'Secret Wars : Thors', 'Cartonné', 'Marvel', '2809465142.jpg', 'Les Thor sont les policiers de Battleworld. Ils poursuivent les criminels et mènent une enquête difficile pour retrouver un tueur en série à Fatalistadt.', '2017-08-23', 5, '14.00'),
('2809463352', '978-2809463354', 'Deadpool Bad blood ', 'Cartonné', 'Marvel', '2809463352.jpg', 'Parmi les ennemis de Deadpool, il y en a un qui souhaite plus particulièrement prendre sa revanche. Qui est le mystérieux Thumper ? Wade Wilson pourra-t-il compter sur ses alliés Cable et Domino ?', '2017-08-23', 33, '18.00'),
('2365778976', '978-2365778978', 'Suicide Squad - Tome 2 ', 'Cartonné', 'DC Comics', '2365778976.jpg', 'Depuis sa dernière mission désastreuse, le doute plane dans les rangs de la Suicide Squad : un traître, surentrainé par le leader de l\'organisation Basilisk lui-même, aurait infiltré Depuis sa dernière mission désastreuse, le doute plane dans les rangs de la Suicide Squad : un traître, surentrainé par le leader de l\'organisation Basilisk lui-même, aurait infiltré l\'équipe de super-criminels dans le but d\'éliminer Amanda Waller. S\'agit-il d\'Harley Quinn,...  ', '2016-07-01', 0, '17.50'),
('2809463972', '978-2809463972', 'Deadpool - Tome 1', 'Revue', 'Marvel', '2809463972.jpg', 'La vie de Deadpool est de plus en plus compliquée alors que Civil War II s’achève. ', '2017-06-07', 1, '7.50'),
('2809418799', '978-2809418798', 'Deadpool - Tome 1', 'revue', 'Marvel', '2809418799.jpg', '', '2011-03-15', 2, '3.90'),
('2809420963 ', '978-2809420968', 'Deadpool - Tome 2', 'revue', 'Marvel', '2809420963.jpg', '', '2011-05-15', 2, '3.90'),
('280942179X', '978-2809421798', 'Deadpool - Tome 3', 'Revue', 'Marvel', '280942179X.jpg', '', '2011-07-13', 2, '3.90'),
('2809422133', '978-2809422139', 'Deadpool - Tome 4 ', 'Revue', 'Marvel', '2809422133.jpg', '', '2011-09-16', 2, '3.90'),
('280942280X', '978-2809422801', 'Deadpool - Tome 5 ', 'Revue', 'Marvel', '280942280X.jpg', '', '2011-10-18', 2, '3.90'),
('2809422923', '978-2809422924', 'Deadpool - Tome 6', 'Revue', 'Marvel', '2809422923.jpg', '', '2011-11-15', 2, '3.90'),
('2809423210', '978-2809423211', 'Deadpool - Tome 7', 'Revue', 'Marvel', '2809423210.jpg', '', '2011-12-16', 2, '3.90'),
('2809423814', '978-2809423815', 'Deadpool - Tome 8', 'Revue', 'Marvel', '2809423814.jpg', '', '2012-01-06', 2, '4.00'),
('2809423970', '978-2809423976', 'Deadpool - Tome 9 ', 'Revue', 'Marvel', '2809423970.jpg', '', '2012-01-31', 2, '4.00'),
('2809425272 ', '978-2809425277 ', 'Deadpool - Tome 10', 'Revue', 'Marvel', '2809425272.jpg', '', '2012-03-06', 2, '4.00'),
('2809425493 ', '978-2809425499 ', 'Deadpool - Tome 11', 'Revue', 'Marvel', '2809425493.jpg', '', '2012-05-04', 2, '4.00'),
('2809427178', '978-2809427172 ', 'Deadpool - Tome 1', 'Revue', 'Marvel', '2809427178.jpg', '', '2012-07-06', 44, '4.30'),
('2809457913', '978-2809457919 ', 'Old man Logan - Tome 3', 'Revue', 'Marvel', '2809457913.jpg', '', '2018-10-04', 7, '4.90'),
('2809458081', '978-2809458084 ', 'Old Man Logan - Tome 4', 'Revue', 'Marvel', '2809458081.jpg', '', '2016-04-01', 7, '4.90'),
('2809458766', '978-2809458763', 'Old Man Logan - Tome 5', 'Revue', 'Marvel', '2809458766.jpg', '', '2015-05-03', 7, '4.90'),
('2809455090', '978-2809455090 ', 'Old man Logan - Tome 1', 'Revue', 'Marvel', '2809455090.jpg', '', '2015-12-24', 7, '4.90'),
('2809456127', '978-2809456127 ', 'Old man Logan - Tome 2', 'Revue', 'Marvel', '2809456127.jpg', '', '2016-01-27', 7, '4.90'),
('2840557509', '978-2840557500', 'Hellboy - Tome 1 : Les germes de la destruction', 'Cartoné', 'Delcourt', '2840557509.jpg', '', '2004-01-01', 6, '14.95'),
('2756077062 ', '978-2756077062 ', 'Spawn Renaissance - Tome 1', 'Cartoné', 'Delcourt', '2756077062.jpg', '', '2016-03-02', 9, '15.95'),
('2756093327', '978-2756093321', 'Spawn Renaissance - Tome 4', 'Cartoné', 'Delcourt', '2756093327.jpg', '', '2018-01-03', 9, '17.95'),
('2756093319', '978-2756093314', 'Spawn Renaissance - Tome 3', 'Cartoné', 'Delcourt', '2756093319.jpg', '', '2017-05-24', 9, '15.95'),
('2756080772', '978-2756080772', 'Spawn Renaissance - Tome 2', 'Cartoné', 'Delcourt', '2756080772.jpg', '', '2016-10-26', 9, '16.95'),
('1026812631', '979-1026812630', 'Aquaman rebirth - Tome 1', 'Cartoné', 'DC Comics', '1026812631.jpg', '', '2018-01-12', -1, '22.50'),
('2809473323', '978-2809473322', 'Nous sommes Venom ', 'Cartoné', 'Marvel', '2809473323.jpg', '', '2018-09-19', 10, '25.00'),
('280946085X', '978-2809460858', 'Deadpool : Il faut soigner le soldat Wilson', 'Cartoné', 'Marvel', '280946085X.jpg', '', '2017-02-08', 20, '16.00'),
('2809458340', '978-2809458343', 'All-new Deadpool - Tome 1', 'Revue', 'Marvel', '2809458340.jpg', '', '2016-06-08', 12, '4.90'),
('2809458510', '978-2809458510', 'All-new Deadpool - Tome 2', 'Revue', 'Marvel', '2809458510.jpg', '', '2016-06-29', 12, '4.90'),
('2809459061', '978-2809459067', 'All-new deadpool - Tome 3', 'Revue', 'Marvel', '2809459061.jpg', '', '2016-08-03', 12, '4.90'),
('2809459231', '978-2809459234', 'All-new deadpool - Tome 4', 'Revue', 'Marvel', '2809459231.jpg', '', '2016-09-07', 12, '4.90'),
('2809459347', '978-2809459340', 'All-new deadpool - Tome 5', 'Revue', 'Marvel', '2809459347.jpg', '', '2016-10-05', 12, '4.90'),
('280945972X', '978-2809459722', 'All-new deadpool - Tome 6', 'Revue', 'Marvel', '280945972X.jpg', '', '2016-11-09', 12, '4.90'),
('280945986X', '978-2809459869', 'All-new deadpool - Tome 7', 'Revue', 'Marvel', '280945986X.jpg', '', '2016-11-30', 12, '4.90'),
('2809460531', '978-2809460537', 'All-new deadpool - Tome 8', 'Revue', 'Marvel', '2809460531.jpg', '', '2017-01-04', 12, '4.90'),
('2809460922', '978-2809460926', 'All-new deadpool - Tome 9 ', 'Revue', 'Marvel', '2809460922.jpg', '', '2017-02-08', 12, '4.90'),
('2809462526', '978-2809462524', 'All-new deadpool - Tome 10', 'Revue', 'Marvel', '2809462526.jpg', '', '2017-02-08', 12, '4.90'),
('2809462933', '978-2809462937', 'All-new deadpool - Tome 11', 'Revue', 'Marvel', '2809462933.jpg', '', '2017-04-05', 12, '4.90'),
('2809463549', '978-2809463545', 'All-new deadpool - Tome 12', 'Revue', 'Marvel', '2809463549.jpg', '', '2017-05-03', 12, '4.90'),
('280945924X', '978-2809459241', 'All-new deadpool hs - Tome 1', 'Revue', 'Marvel', '280945924X.jpg', '', '2016-09-21', 13, '5.50'),
('2809459738', '978-2809459739', 'All-new deadpool hs - Tome 2', 'Revue', 'Marvel', '2809459738.jpg', '', '2016-11-23', 13, '5.60'),
('2809462534', '978-2809462531', 'All-new deadpool hs - Tome 3', 'Revue', 'Marvel', '2809462534.jpg', '', '2017-03-22', 13, '5.70'),
('2809458367', '978-2809458367', 'All-new les Gardiens de la Galaxie - Tome 1', 'Revue', 'Marvel', '2809458367.jpg', '', '2016-06-08', 14, '4.90'),
('2809458529', '978-2809458527', 'All-new les Gardiens de la galaxie - Tome 2', 'Revue', 'Marvel', '2809458529.jpg', '', '2016-06-29', 14, '4.90'),
('280945907X', '978-2809459074', 'All-new les Gardiens de la galaxie - Tome 3', 'Revue', 'Marvel', '280945907X.jpg', '', '2016-08-03', 14, '4.90'),
('2809459258', '978-2809459258', 'All-new les gardiens de la galaxie - Tome 4', 'Revue', 'Marvel', '2809459258.jpg', '', '2016-09-07', 14, '4.90'),
('2809459355', '978-2809459357', 'All-new les gardiens de la galaxie - Tome 5', 'Revue', 'Marvel', '2809459355.jpg', '', '2016-10-05', 14, '4.90'),
('2809459746', '978-2809459746', 'All-new les gardiens de la galaxie - Tome 6', 'Revue', 'Marvel', '2809459746.jpg', '', '2016-11-09', 14, '4.90'),
('2809459878', '978-2809459876', 'All-new les gardiens de la galaxie - Tome 7', 'Revue', 'Marvel', '2809459878.jpg', '', '2016-11-30', 14, '4.90'),
('280946054X', '978-2809460544', 'All-new les gardiens de la galaxie - Tome 8 ', 'Revue', 'Marvel', '280946054X.jpg', '', '2017-01-04', 14, '4.90'),
('2809460930', '978-2809460933', 'All-new les gardiens de la galaxie - Tome 9', 'Revue', 'Marvel', '2809460930.jpg', '', '2017-02-08', 14, '4.90'),
('2809462542', '978-2809462548', 'All-new les gardiens de la galaxie - Tome 10', 'Revue', 'Marvel', '2809462542.jpg', '', '2017-03-08', 14, '4.90'),
('2809462941', '978-2809462944', 'All-new les gardiens de la galaxie - Tome 11', 'Revue', 'Marvel', '2809462941.jpg', '', '2017-04-05', 14, '4.90'),
('2809463557', '978-2809463552', 'All-new les gardiens de la galaxie - Tome 12', 'Revue', 'Marvel', '2809463557.jpg', '', '2017-05-03', 14, '4.90'),
('2809458561', '978-2809458565', 'All-new les gardiens de la galaxie hs - Tome 1', 'Revue', 'Marvel', '2809458561.jpg', '', '2016-06-29', 15, '5.70'),
('2809459363', '978-2809459364', 'All-new les gardiens de la galaxie hs - Tome 2', 'Revue', 'Marvel', '2809459363.jpg', '', '2016-10-19', 15, '5.70'),
('2809460558', '978-2809460551', 'All-new les gardiens de la galaxie hs - Tome 3', 'Revue', 'Marvel', '2809460558.jpg', '', '2017-01-04', 15, '5.70'),
('2809462593', '978-2809462593', 'All-New X-Men hs - Tome 2', 'Revue', 'Marvel', '2809462593.jpg', '', '2017-03-22', 16, '5.60'),
('2809458413', '978-2809458411', 'All-new X-Men hs - Tome 1', 'Revue', 'Marvel', '2809458413.jpg', '', '2016-06-08', 16, '5.60'),
('2809464030', '978-2809464030', 'All-New X-Men hs - Tome 3', 'Revue', 'Marvel', '2809464030.jpg', '', '2017-06-21', 16, '5.60'),
('2809452512', '978-2809452518', 'Ant-man - Tome 1', 'Revue', 'Marvel', '2809452512.jpg', '', '2015-06-27', 17, '4.60'),
('2809454132', '978-2809454130', 'Ant-man - Tome 3', 'Revue', 'Marvel', '2809454132.jpg', '', '2015-10-22', 17, '4.60'),
('280945292X', '978-2809452921', 'Ant-Man - Tome 2', 'Revue', 'Marvel', '280945292X.jpg', '', '2015-08-29', 17, '4.60'),
('2809455155', '978-2809455151', 'Ant-Man - Tome 4', 'Revue', 'Marvel', '2809455155.jpg', '', '2015-12-24', 17, '4.60'),
('2809452377', '978-2809452372', 'Ant-Man hs - Tome 1', 'Revue', 'Marvel', '2809452377.jpg', '', '2015-07-17', 18, '4.60'),
('2809471274', '978-2809471274', 'Ant-Man hs - Tome 2', 'Revue', 'Marvel', '2809471274.jpg', '', '2018-07-11', 18, '9.95'),
('2809462690', '978-2809462692', 'Nous sommes les Gardiens de la Galaxie', 'Cartoné', 'Marvel', '2809462690.jpg', '', '2017-04-19', 22, '25.00'),
('2809468311', '978-2809468311', 'Les Gardiens de la Galaxie : Mère entropie ', 'Cartoné', 'Marvel', '2809468311.jpg', '', '2018-01-03', 23, '18.00'),
('2809448302', '978-2809448306', 'Les Gardiens de la Galaxie  - Tome 1', 'Revue', 'Marvel', '2809448302.jpg', '', '2014-12-24', 24, '4.90'),
('2809448779', '978-2809448771', 'Les Gardiens de la Galaxie - Tome 2', 'Revue', 'Marvel', '2809448779.jpg', '', '2015-01-24', 24, '4.90'),
('2809450919', '978-2809450910', 'Les Gardiens de la Galaxie - Tome 3', 'Revue', 'Marvel', '2809450919.jpg', '', '2015-03-01', 24, '4.90'),
('2809451567', '978-2809451566', 'Les Gardiens de la Galaxie - Tome 4', 'Revue', 'Marvel', '2809451567.jpg', '', '2015-04-03', 24, '4.90'),
('2809452067', '978-2809452068', 'Les Gardiens de la Galaxie - Tome 5', 'Revue', 'Marvel', '2809452067.jpg', '', '2015-05-05', 24, '4.90'),
('2809452296', '978-2809452297', 'Les Gardiens de la Galaxie - Tome 6', 'Revue', 'Marvel', '2809452296.jpg', '', '2015-05-30', 24, '4.90'),
('2809452520', '978-2809452525', 'Les Gardiens de la Galaxie - Tome 7', 'Revue', 'Marvel', '2809452520.jpg', '', '2015-06-27', 24, '4.90'),
('2809452792', '978-2809452792', 'Les Gardiens de la Galaxie - Tome 8', 'Revue', 'Marvel', '2809452792.jpg', '', '2015-08-04', 24, '4.90'),
('2809452938', '978-2809452938', 'Les Gardiens de la Galaxie - Tome 9', 'Revue', 'Marvel', '2809452938.jpg', '', '2015-08-29', 24, '4.90'),
('2809453721', '978-2809453720', 'Les Gardiens de la Galaxie - Tome 10', 'Revue', 'Marvel', '2809453721.jpg', '', '2015-09-30', 24, '4.90'),
('2809463980', '978-2809463989', 'Les Gardiens de la Galaxie - Tome 1', 'Revue', 'Marvel', '2809463980.jpg', '', '2017-06-07', 25, '4.90'),
('2809464359', '978-2809464351', 'Les Gardiens de la Galaxie - Tome 2', 'Revue', 'Marvel', '2809464359.jpg', '', '2017-07-05', 25, '4.90'),
('2809465258', '978-2809465259', 'Les Gardiens de la Galaxie - Tome 3', 'Revue', 'Marvrl', '2809465258.jpg', '', '2017-08-02', 25, '4.90'),
('2809465665', '978-2809465662', 'Les Gardiens de la Galaxie - Tome 4', 'Revue', 'Marvel', '2809465665.jpg', '', '2017-09-06', 25, '4.90'),
('2809465991', '978-2809465990', 'Les Gardiens de la Galaxie - Tome 5', 'Revue', 'Marvel', '2809465991.jpg', '', '2017-10-04', 25, '5.50'),
('2809441472', '978-2809441475', 'Les Gardiens de la Galaxie - L\'intégrale Tome 01', 'Cartoné', 'Marvel', '2809441472.jpg', '', '2014-08-06', 26, '35.00'),
('2809450110', '978-2809450118', 'Les Gardiens de la Galaxie - L\'intégrale Tome 02', 'Cartoné', 'Marvel', '2809450110.jpg', '', '2015-08-26', 26, '35.00'),
('2809462704', '978-2809462708', 'Les Gardiens de la Galaxie - L\'intégrale Tome 03', 'Cartoné', 'Marvel', '2809462704.jpg', '', '2017-04-19', 26, '35.00'),
('2809470146', '978-2809470147', 'Les Gardiens de la Galaxie - L\'intégrale Tome 04', 'Cartoné', 'Marvel', '2809470146.jpg', '', '2018-06-06', 26, '35.00'),
('2809477655', '978-2809477658', 'Les Gardiens de la Galaxie - L\'intégrale Tome 05', 'Revue', 'Marvel', '2809477655.jpg', '', '2019-06-12', 26, '35.00'),
('280944143X', '978-2809441437', 'Les Gardiens de la Galaxie - Tome 1', 'Cartoné', 'Marvel', '280944143X.jpg', '', '2014-08-06', 27, '17.00'),
('2809448043', '978-2809448047', 'Les Gardiens de la Galaxie - Tome 02', 'Cartoné', 'Marvel', '2809448043.jpg', '', '2015-04-08', 27, '32.00'),
('2809456496', '978-2809456493', 'Les Gardiens de la Galaxie - Tome 03', 'Revue', 'Marvel', '2809456496.jpg', '', '2016-08-24', 27, '17.00'),
('2809439672', '978-2809439670', 'Les Gardiens de la Galaxie - Tome 1', 'Cartoné', 'Marvel', '2809439672.jpg', '', '2014-06-04', 28, '14.00'),
('2809447853', '978-2809447859', 'Les Gardiens de la Galaxie - Tome 02', 'Cartoné', 'Marvel', '2809447853.jpg', '', '2015-03-04', 28, '16.95'),
('2809455333', '978-2809455335', 'Les Gardiens de la Galaxie - Tome 03', 'Cartoné', 'Marvel', '2809455333.jpg', '', '2016-05-04', 28, '17.50'),
('2809456879', '978-2809456875', 'Les Gardiens de la Galaxie - Tome 04', 'Cartoné', 'Marvel', '2809456879.jpg', '', '2016-06-19', 28, '14.95'),
('2809462712', '978-2809462715', 'Les Gardiens de la Galaxie - Tome 05', 'Cartoné', 'Marvel', '2809462712.jpg', '', '2017-04-19', 28, '14.95'),
('280945731X', '978-2809457315', 'Les Gardiens de la Galaxie et All-New X-Men Tome 1', 'Cartoné', 'Marvel', '280945731X.jpg', '', '2016-11-30', 29, '14.95'),
('2809460809', '978-2809460803', 'Les Gardiens de la Galaxie et All-New X-Men Tome 2', 'Cartoné', 'Marvel', '2809460809.jpg', '', '2017-02-15', 29, '18.00'),
('2809451397', '978-2809451399', 'Le procès de Jean Grey ', 'Cartoné', 'Marvel', '2809451397.jpg', '', '2015-12-02', 29, '14.95'),
('2809465541', '978-2809465549', 'All-new Deadpool - Tome 1', 'Cartoné', 'Marvel', '2809465541.jpg', '', '2017-08-23', 30, '15.00'),
('2809466998', '978-2809466997', 'All-new Deadpool - Tome 2', 'Cartoné', 'Marvel', '2809466998.jpg', '', '2017-11-08', 30, '15.00'),
('2809470901', '978-2809470901', 'All-new Deadpool - Tome 3', 'Cartoné', 'Marvel', '2809470901.jpg', '', '2018-05-09', 30, '15.00'),
('2809473064', '978-2809473063', 'All-New Deadpool - Tome 4', 'Cartoné', 'Marvel', '2809473064.jpg', '', '2018-08-16', 30, '15.00'),
('2809476276', '978-2809476279', 'All-New Deadpool - Tome 5', 'Cartoné', 'Marvel', '2809476276.jpg', '', '2019-02-13', 30, '15.00'),
('2809477086', '978-2809477085', 'All-New Deadpool - Tome 6', 'Cartoné', 'Marvel', '2809477086.jpg', '', '2019-04-03', 30, '15.00'),
('2809442096', '978-2809442090', 'Deadpool et Cable - Tome 1', 'Cartoné', 'Marvel', '2809442096.jpg', '', '2014-10-08', 31, '30.00'),
('2809447888', '978-2809447880', 'Deadpool et Cable - Tome 2', 'Cartoné', 'Marvel', '2809447888.jpg', '', '2015-03-04', 31, '29.95'),
('2809450382', '978-2809450385', 'Deadpool et Cable - Tome 3', 'Cartoné', 'Marvel', '2809450382.jpg', '', '2015-09-16', 31, '29.95'),
('2809453330', '978-2809453331', 'Deadpool et Cable - Tome 4', 'Cartoné', 'Marvel', '2809453330.jpg', '', '2016-02-03', 31, '29.95'),
('2809435944', '978-2809435948', 'Deadpool - Tome 01', 'Revue', 'Marvel', '2809435944.jpg', '', '2013-11-27', 32, '16.00'),
('2809440018', '978-2809440010', 'Deadpool - Tome 02', 'Cartoné', 'Marvel', '2809440018.jpg', '', '2014-07-02', 32, '16.95'),
('2809446520', '978-2809446524', 'Deadpool - Tome 03', 'Cartoné', 'Marvel', '2809446520.jpg', '', '2015-02-04', 32, '16.95'),
('2809451265', '978-2809451269', 'Deadpool - Tome 04', 'Cartoné', 'Marvel', '2809451265.jpg', '', '2015-11-04', 32, '17.50'),
('2809455619', '978-2809455618', 'Deadpool - Tome 05', 'Revue', 'Marvel', '2809455619.jpg', '', '2016-06-15', 32, '18.00'),
('2809457212', '978-2809457216', 'Deadpool - Tome 06', 'Cartoné', 'Marvel', '2809457212.jpg', '', '2016-11-09', 32, '17.50'),
('2809462852', '978-2809462852', 'Deadpool - Tome 07', 'Cartoné', 'Marvel', '2809462852.jpg', '', '2017-04-05', 32, '18.00'),
('2809465177', '978-2809465174', 'Deadpool - Tome 08', 'Cartoné', 'Marvel', '2809465177.jpg', '', '0017-08-23', 32, '18.00'),
('2809470332', '978-2809470338', 'Deadpool - Flashbacks ', 'Cartoné', 'Marvel', '2809470332.jpg', '', '2018-04-18', 34, '18.00'),
('2809464170', '978-2809464177', 'Deadpool - Les guerres très très secrètes ', 'Cartoné', 'Marvel', '2809464170.jpg', '', '2017-06-28', 35, '14.00'),
('2809470863', '978-2809470864', 'Je suis Deadpool', 'Cartoné', 'Marvel', '2809470863.jpg', '', '2018-05-16', 36, '25.00'),
('2809453349', '978-2809453348', 'Deadpool les origines ', 'Cartoné', 'Marvel', '2809453349.jpg', '', '2016-02-10', 37, '20.50'),
('2809441731', '978-2809441734', 'Deadpool - suicide kings ', 'Cartoné', 'Marvel', '2809441731.jpg', '', '2014-09-17', 38, '15.00'),
('2809476659', '978-2809476651', 'Deadpool : Trop tôt ?', 'Cartoné', 'Marvel', '2809476659.jpg', '', '2019-03-06', 39, '18.00'),
('2809452725', '978-2809452723', 'Deadpool il faut soigner le soldat wilson ', 'Cartoné', 'Marvel', '2809452725.jpg', '', '2015-11-04', 40, '14.00'),
('2809451141', '978-2809451146', 'Deadpool : l\'art de la guerre ', 'Cartoné', 'Marvel', '2809451141.jpg', '', '2015-11-04', 40, '13.00'),
('2809473552', '978-2809473551', 'Deadpool - Retour au noir ', 'Cartoné', 'Marvel', '2809473552.jpg', '', '2018-10-03', 40, '15.00'),
('2809441820', '978-2809441826', 'Deadpool - la nuit des morts-vivants ', 'Cartoné', 'Marvel', '2809441820.jpg', '', '2014-10-08', 41, '13.00'),
('2809444005', '978-2809444001', 'Deadpool massacre marvel ', 'Cartoné', 'Marvel', '2809444005.jpg', '', '2014-11-05', 41, '13.00'),
('2809451214', '978-2809451214', 'Deadpool massacre les classiques', 'Revue', 'Marvel', '2809451214.jpg', '', '2015-11-12', 41, '13.00'),
('2809453314', '978-2809453317', 'Deadpool massacre deadpool ', 'Cartoné', 'Marvel', '2809453314.jpg', '', '2016-02-03', 41, '13.00'),
('2809454426', '978-2809454420', 'Deadpool : le retour du Deadpool vivant ', 'Cartoné', 'Marvel', '2809454426.jpg', '', '2016-03-09', 41, '16.00'),
('2809473595', '978-2809473599', 'Deadpool re-massacre Marvel ', 'Cartoné', 'Marvel', '2809473595.jpg', '', '2018-10-03', 41, '16.00'),
('2809446156', '978-2809446159', 'Deadpool - Tome 01', 'Cartoné', 'Marvel', '2809446156.jpg', '', '2015-01-07', 42, '28.50'),
('2809450579', '978-2809450576', 'Deadpool - Tome 02', 'Cartoné', 'Marvel', '2809450579.jpg', '', '2015-10-07', 42, '29.00'),
('2809453306', '978-2809453300', 'Deadpool - Tome 03', 'Cartoné', 'Marvel', '2809453306.jpg', '', '2016-02-03', 42, '29.00'),
('2809457174', '978-2809457179', 'Deadpool - Tome 4', 'Revue', 'Marvel', '2809457174.jpg', '', '2016-11-02', 42, '29.00'),
('280946281X', '978-2809462814', 'Deadpool - Tome 05 ', 'Cartoné', 'Marvel', '280946281X.jpg', '', '2017-04-12', 42, '20.00'),
('2809465827', '978-2809465822', 'Deadpool - Tome 06', 'Cartoné', 'Marvel', '2809465827.jpg', '', '2017-10-25', 42, '18.00'),
('2809428018', '978-2809428018', 'Deadpool - Tome 2', 'Revue', 'Marvel', '2809428018.jpg', '', '2012-09-06', 44, '4.30'),
('2809429189', '978-2809429183', 'Deadpool - Tome 3', 'Revue', 'Marvel', '2809429189.jpg', '', '2012-11-01', 44, '4.30'),
('2809429480', '978-2809429480', 'Deadpool - Tome 4', 'Revue', 'Marvel', '2809429480.jpg', '', '2013-01-01', 44, '4.30'),
('2809432228', '978-2809432220', 'Deadpool - Tome 5', 'Revue', 'Marvel', '2809432228.jpg', '', '2013-03-15', 44, '4.30'),
('2809432627', '978-2809432626', 'Deadpool - Tome 6', 'Revue', 'Marvel', '2809432627.jpg', '', '2013-05-15', 44, '4.30'),
('2809434034', '978-2809434033', 'Deadpool - Tome 1', 'Revue', 'Marvel', '2809434034.jpg', '', '2013-07-01', 45, '4.60'),
('2809436657', '978-2809436655', 'Deadpool - Tome 2', 'Revue', 'Marvel', '2809436657.jpg', '', '2013-09-17', 45, '4.60'),
('2809437742', '978-2809437744', 'Deadpool - Tome 3', 'Revue', 'Marvel', '2809437742.jpg', '', '2013-11-01', 45, '4.60'),
('2809438072', '978-2809438079', 'Deadpool - Tome 4', 'Revue', 'Marvel', '2809438072.jpg', '', '2014-01-11', 45, '4.60'),
('2809441081', '978-2809441086', 'Deadpool - Tome 5', 'Revue', 'Marvel', '2809441081.jpg', '', '2014-03-13', 45, '4.60'),
('2809442630', '978-2809442632', 'Deadpool - Tome 6', 'Revue', 'Marvel', '2809442630.jpg', '', '2014-05-14', 45, '4.60'),
('2809445036', '978-2809445039', 'Deadpool - Tome 7', 'Revue', 'Marvel', '2809445036.jpg', '', '2014-07-10', 45, '4.60'),
('2809446784', '978-2809446784', 'Deadpool - Tome 8', 'Revue', 'Marvel', '2809446784.jpg', '', '2014-09-12', 45, '4.60'),
('2809447381', '978-2809447385', 'Deadpool - Tome 9', 'Revue', 'Marvel', '2809447381.jpg', '', '2014-11-18', 45, '4.60'),
('2809448388', '978-2809448382', 'Deadpool - Tome 10', 'Revue', 'Marvel', '2809448388.jpg', '', '2015-01-16', 45, '4.60'),
('280945096X', '978-2809450965', 'Deadpool - Tome 11', 'Revue', 'Marvel', '280945096X.jpg', '', '2015-03-01', 45, '4.60'),
('2809452113', '978-2809452112', 'Deadpool - Tome 12', 'Revue', 'Marvel', '2809452113.jpg', '', '2015-05-12', 45, '4.60'),
('2809452571', '978-2809452570', 'Deadpool - Tome 13', 'Revue', 'Marvel', '2809452571.jpg', '', '2015-07-17', 45, '4.60'),
('2809452970', '978-2809452976', 'Deadpool - Tome 14', 'Revue', 'Marvel', '2809452970.jpg', '', '2015-09-09', 45, '4.60'),
('2809454051', '978-2809454055', 'Deadpool - Tome 15', 'Revue', 'Marvel', '2809454051.jpg', '', '2015-10-22', 45, '4.60'),
('2809447179', '978-2809447170', 'Deadpool - Hors Série Tome 1', 'Revue', 'Marvel', '2809447179.jpg', '', '2014-10-14', 46, '5.50'),
('2809449902', '978-2809449907', 'Deadpool - Hors Série Tome 2', 'Revue', 'Marvel', '2809449902.jpg', '', '2015-03-01', 46, '5.50'),
('2809452016', '978-2809452013', 'Deadpool - Hors Série Tome 3', 'Revue', 'Marvel', '2809452016.jpg', '', '2015-05-12', 46, '5.50'),
('2809453756', '978-2809453751', 'Deadpool - Hors Série Tome 4', 'Revue', 'Marvel', '2809453756.jpg', '', '2015-10-16', 46, '5.70'),
('2809454248', '978-2809454246', 'Deadpool - Hors Série Tome 5', 'Revue', 'Marvel', '2809454248.jpg', '', '2015-12-10', 46, '5.50'),
('2809464332', '978-2809464337', 'Deadpool - Tome 2', 'Revue', 'Marvel', '2809464332.jpg', '', '2017-07-05', 1, '4.90'),
('280946524X', '978-2809465242', 'Deadpool - Tome 3', 'Revue', 'Marvel', '280946524X.jpg', '', '2017-08-16', 1, '4.90'),
('2809465649', '978-2809465648', 'Deadpool - Tome 4', 'Revue', 'Marvel', '2809465649.jpg', '', '2017-09-06', 1, '4.90'),
('2809465983', '978-2809465983', 'Deadpool - Tome 5', 'Revue', 'Marvel', '2809465983.jpg', '', '2017-10-04', 1, '4.90'),
('2809467072', '978-2809467079', 'Deadpool - Tome 6', 'Revue', 'Marvel', '2809467072.jpg', '', '2017-11-08', 1, '4.90'),
('2809467250', '978-2809467253', 'Deadpool - Tome 7', 'Revue', 'Marvel', '2809467250.jpg', '', '2017-11-29', 1, '4.90'),
('2809468729', '978-2809468724', 'Deadpool - Tome 9', 'Revue', 'Marvel', '2809468729.jpg', '', '2018-02-07', 1, '4.90'),
('2809469636', '978-2809469639', 'Deadpool - Tome 10', 'Revue', 'Marvel', '2809469636.jpg', '', '2018-03-07', 1, '4.90'),
('2809469911', '978-2809469912', 'Deadpool - Tome 11', 'Revue', 'Marvel', '2809469911.jpg', '', '2018-04-04', 1, '4.90'),
('2809470960', '978-2809470963', 'Deadpool - Tome 12', 'Revue', 'Marvel', '2809470960.jpg', '', '2018-05-23', 1, '4.90'),
('2809471525', '978-2809471526', 'Deadpool - Tome 13', 'Revue', 'Marvel', '2809471525.jpg', '', '2018-06-13', 1, '4.90'),
('2809471606', '978-2809471601', 'Deadpool - Tome 1', 'Revue', 'Marvel', '2809471606.jpg', '', '2018-07-04', 48, '6.50'),
('2809464340', '978-2809464344', 'Deadpool HS - Tome 1', 'Revue', 'Marvel', '2809464340.jpg', '', '2017-07-05', 47, '5.60'),
('2809465657', '978-2809465655', 'Deadpool HS - Tome 2', 'Revue', 'Marvel', '2809465657.jpg', '', '2017-09-20', 47, '5.70'),
('2809473137', '978-2809473131', 'Deadpool - Tome 2', 'Revue', 'Marvel', '2809473137.jpg', '', '2018-08-08', 48, '6.50'),
('2809473420', '978-2809473421', 'Deadpool - Tome 3', 'Revue', 'Marvel', '2809473420.jpg', '', '2018-09-05', 48, '6.50'),
('2809473706', '978-2809473704', 'Deadpool - Tome 4', 'Revue', 'Marvel', '2809473706.jpg', '', '2018-10-03', 48, '6.50'),
('2809473862', '978-2809473865', 'Deadpool - Tome 5', 'Revue', 'Marvel', '2809473862.jpg', '', '2018-11-07', 48, '6.50'),
('2809474737', '978-2809474732', 'Deadpool - Tome 6', 'Revue', 'Marvel', '2809474737.jpg', '', '2018-11-28', 48, '6.50'),
('2809476071', '978-2809476071', 'Deadpool - Tome 7', 'Revue', 'Marvel', '2809476071.jpg', '', '2019-01-02', 48, '6.50'),
('2809476365', '978-2809476361', 'Deadpool - Tome 1', 'Revue', 'Marvel', '2809476365.jpg', '', '2019-02-06', 49, '7.50'),
('2809476845', '978-2809476842', 'Deadpool - Tome 2', 'Revue', 'Marvel', '2809476845.jpg', '', '2019-03-06', 49, '7.50'),
('2809477183', '978-2809477184', 'Deadpool - Tome 3', 'Revue', 'Marvel', '2809477183.jpg', '', '2019-04-03', 49, '7.50'),
('2809477477', '978-2809477474', 'Deadpool - Tome 4', 'Revue', 'Marvel', '2809477477.jpg', '', '2019-05-02', 49, '7.50'),
('2809477787', '978-2809477788', 'Deadpool - Tome 5', 'Revue', 'Marvel', '2809477787.jpg', '', '2019-06-05', 49, '7.50'),
('2845381263', '978-2845381261', 'Deadpool - Marvel Monster Tome 1', 'Revue', 'Marvel', '2845381263.jpg', '', '2002-09-01', -1, '25.00'),
('2845382014', '978-2845382015', 'Deadpool - Marvel Monster Tome 2', 'Revue', 'Marvel', '2845382014.jpg', '', '2003-12-01', -1, '25.00'),
('2365775721', '978-2365775724', 'Arrow - Tome 1', 'Cartoné', 'Dc Comics', '2365775721.jpg', '', '2014-11-06', 51, '10.00'),
('2365778062', '978-2365778060', 'Arrow - Tome 2', 'Cartoné', 'Dc Comics', '2365778062.jpg', '', '2015-11-20', 51, '10.00'),
('2809434042', '978-2809434040', 'Avengers - Tome 1', 'Revue', 'Marvel', '2809434042.jpg', '', '2013-07-10', -1, '4.80'),
('2809435227', '978-2809435221', 'Avengers - Tome 2', 'Revue', 'Marvel', '2809435227.jpg', '', '2013-08-01', -1, '4.80'),
('2809436576', '978-2809436570', 'Avengers - Tome 3', 'Revue', 'Marvel', '2809436576.jpg', '', '2013-09-03', -1, '4.80'),
('2809437467', '978-2809437461', 'Avengers - Tome 4', 'Revue', 'Marvel', '2809437467.jpg', '', '2013-10-01', -1, '4.80'),
('2809437734', '978-2809437737', 'Avengers - Tome 5', 'Revue', 'Marvel', '978-2809437737.jpg', '', '2013-11-01', -1, '4.80'),
('2809437998', '978-2809437997', 'Avengers - Tome 6', 'Revue', 'Marvel', '2809437998.jpg', '', '2013-11-27', -1, '4.80'),
('2809438153', '978-2809438154', 'Avengers - Tome 7', 'Revue', 'Marvel', '2809438153.jpg', '', '2014-01-01', -1, '4.80'),
('2809439192', '978-2809439199', 'Avengers - Tome 8', 'Revue', 'Marvel', '2809439192.jpg', '', '2014-01-29', -1, '4.80');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `idUser` int(20) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `note` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`idUser`, `ISBN`, `note`) VALUES
(5, '2809454132', 3),
(5, '2365775721', 5),
(5, '2809471525', 3),
(5, '2365778976', 4),
(5, '280945292X', 3),
(5, '2809465142', 4);

-- --------------------------------------------------------

--
-- Structure de la table `possède`
--

CREATE TABLE `possède` (
  `idUser` int(20) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prix` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `possède`
--

INSERT INTO `possède` (`idUser`, `ISBN`, `dateAjout`, `prix`) VALUES
(5, '2809459258', '2019-06-25 09:51:26', '4.90'),
(5, '2809467080', '2019-05-22 10:42:51', '5.60'),
(5, '2809463972', '2019-05-22 10:43:02', '7.50'),
(5, '2809463549', '2019-05-22 10:43:15', '4.90'),
(5, '2809462933', '2019-05-22 10:43:20', '4.90'),
(5, '2809462534', '2019-05-22 10:43:25', '5.70'),
(5, '2809420963 ', '2019-08-04 13:01:11', '3.90'),
(5, '2809458340', '2019-05-22 10:44:40', '4.90'),
(5, '2809427178', '2019-05-22 10:44:31', '4.30'),
(5, '2809458510', '2019-05-22 10:44:46', '4.90'),
(5, '2809459061', '2019-05-22 10:44:50', '4.90'),
(5, '2809459231', '2019-05-22 10:44:55', '4.90'),
(5, '2809459347', '2019-05-22 10:45:00', '4.90'),
(5, '280945972X', '2019-05-22 10:45:05', '4.90'),
(5, '280945986X', '2019-05-22 10:45:10', '4.90'),
(5, '2809460531', '2019-05-22 10:45:16', '4.90'),
(5, '2809460922', '2019-05-22 10:45:21', '4.90'),
(5, '2809462526', '2019-05-22 10:45:26', '4.90'),
(5, '280945924X', '2019-05-22 10:45:41', '5.50'),
(5, '2809459738', '2019-05-22 10:45:46', '5.60'),
(5, '280946085X', '2019-05-22 10:46:04', '16.00'),
(5, '2809471274', '2019-05-22 11:20:03', '9.95'),
(5, '2365778976', '2019-08-03 12:47:32', '17.50'),
(5, '2809438277', '2019-08-03 12:47:26', '14.95'),
(5, '2809452377', '2019-05-22 11:20:29', '4.60'),
(5, '2809452512', '2019-05-22 11:20:34', '4.60'),
(5, '2809458367', '2019-05-22 11:21:25', '4.90'),
(5, '2756077062', '2019-05-22 11:22:15', '15.95'),
(5, '2756093327', '2019-05-22 11:22:23', '17.95'),
(5, '2756093319', '2019-05-22 11:22:30', '15.95'),
(5, '2756080772', '2019-08-03 13:55:24', '16.95'),
(5, '2840557509', '2019-05-22 15:43:20', '14.95'),
(5, '2809458529', '2019-05-22 15:45:08', '4.90'),
(5, '280945907X', '2019-05-22 15:46:34', '4.90'),
(5, '2809462593', '2019-05-28 12:57:36', '5.60'),
(5, '2809459355', '2019-06-25 09:51:28', '4.90'),
(5, '2809459746', '2019-06-25 09:51:29', '4.90'),
(5, '2809459878', '2019-06-25 09:51:31', '4.90'),
(5, '280946054X', '2019-06-25 09:51:33', '4.90'),
(5, '2809460930', '2019-06-25 09:51:34', '4.90'),
(5, '2809462542', '2019-06-25 09:51:36', '4.90'),
(5, '2809462941', '2019-06-25 09:51:37', '4.90'),
(5, '2809463557', '2019-06-25 09:51:39', '4.90'),
(5, '2809458561', '2019-06-25 09:51:50', '5.70'),
(5, '2809459363', '2019-06-25 09:51:52', '5.70'),
(5, '2809460558', '2019-06-25 09:51:54', '5.70'),
(5, '2809462690', '2019-06-25 09:51:58', '25.00'),
(5, '2809468311', '2019-06-25 09:52:03', '18.00'),
(5, '2809448302', '2019-06-25 09:52:08', '4.90'),
(5, '2809448779', '2019-06-25 09:52:10', '4.90'),
(5, '2809450919', '2019-06-25 09:52:12', '4.90'),
(5, '2809451567', '2019-06-25 09:52:13', '4.90'),
(5, '2809452067', '2019-06-25 09:52:15', '4.90'),
(5, '2809452296', '2019-06-25 09:52:16', '4.90'),
(5, '2809452520', '2019-06-25 09:52:18', '4.90'),
(5, '2809452792', '2019-06-25 09:52:19', '4.90'),
(5, '2809452938', '2019-06-25 09:52:21', '4.90'),
(5, '2809453721', '2019-06-25 09:52:23', '4.90'),
(5, '2809463980', '2019-06-25 09:52:28', '4.90'),
(5, '2809464359', '2019-06-25 09:52:30', '4.90'),
(5, '2809465258', '2019-06-25 09:52:31', '4.90'),
(5, '2809465665', '2019-06-25 09:52:33', '4.90'),
(5, '2809465991', '2019-06-25 09:52:35', '5.50'),
(5, '2809439672', '2019-06-25 09:52:50', '14.00'),
(5, '2809447853', '2019-06-25 09:52:52', '16.95'),
(5, '2809468435 ', '2019-06-25 12:36:15', '5.90'),
(5, '2809442096', '2019-06-25 12:37:32', '30.00'),
(5, '2809447888', '2019-06-25 12:37:34', '29.95'),
(5, '2809450382', '2019-06-25 12:37:36', '29.95'),
(5, '2809453330', '2019-06-25 12:37:38', '29.95'),
(5, '2809463352', '2019-06-25 12:38:10', '18.00'),
(5, '2809470863', '2019-06-25 12:38:25', '25.00'),
(5, '2809453349', '2019-06-25 12:38:32', '20.50'),
(5, '2809452725', '2019-06-25 12:38:43', '14.00'),
(5, '2809451141', '2019-06-25 12:38:45', '13.00'),
(5, '2809441820', '2019-06-25 12:38:53', '13.00'),
(5, '2809444005', '2019-06-25 12:38:55', '13.00'),
(5, '2809451214', '2019-06-25 12:38:57', '13.00'),
(5, '2809454426', '2019-06-25 12:39:00', '16.00'),
(5, '2809428018', '2019-06-25 13:43:02', '4.30'),
(5, '2809429189', '2019-06-25 13:43:03', '4.30'),
(5, '2809429480', '2019-06-25 13:43:05', '4.30'),
(5, '2809432228', '2019-06-25 13:43:06', '4.30'),
(5, '2809432627', '2019-06-25 13:43:08', '4.30'),
(5, '2809447179', '2019-06-25 13:43:15', '5.50'),
(5, '2809449902', '2019-06-25 13:43:17', '5.50'),
(5, '2809452016', '2019-06-25 13:43:18', '5.50'),
(5, '2809453756', '2019-06-25 13:43:20', '5.70'),
(5, '2809454248', '2019-06-25 13:43:22', '5.50'),
(5, '2809434034', '2019-06-25 13:43:31', '42.00'),
(5, '2809436657', '2019-06-25 13:43:33', '4.60'),
(5, '2809437742', '2019-06-25 13:43:34', '4.60'),
(5, '2809438072', '2019-06-25 13:43:36', '4.60'),
(5, '2809441081', '2019-06-25 13:43:40', '4.60'),
(5, '2809442630', '2019-06-25 13:43:42', '4.60'),
(5, '2809445036', '2019-06-25 13:43:44', '4.60'),
(5, '2809446784', '2019-06-25 13:43:46', '4.60'),
(5, '2809447381', '2019-06-25 13:43:47', '4.60'),
(5, '2809448388', '2019-06-25 13:43:48', '4.60'),
(5, '280945096X', '2019-06-25 13:43:50', '4.60'),
(5, '2809452113', '2019-06-25 13:43:52', '4.60'),
(5, '2809452571', '2019-06-25 13:43:54', '4.60'),
(5, '2809452970', '2019-06-25 13:43:56', '4.60'),
(5, '2809454051', '2019-06-25 13:43:57', '4.60'),
(5, '2809464332', '2019-06-25 13:56:49', '4.90'),
(5, '280946524X', '2019-06-25 13:56:51', '4.90'),
(5, '2809465649', '2019-06-25 13:56:52', '4.90'),
(5, '2809465983', '2019-06-25 13:56:53', '4.90'),
(5, '2809467072', '2019-06-25 13:56:54', '4.90'),
(5, '2809471606', '2019-07-11 16:49:37', '6.50'),
(5, '2809473137', '2019-07-11 16:49:39', '6.50'),
(5, '2809473420', '2019-07-11 16:49:41', '6.50'),
(5, '2809473706', '2019-07-11 16:49:54', '6.50'),
(5, '2809473862', '2019-07-11 16:49:56', '6.50'),
(5, '2809474737', '2019-07-11 16:49:58', '6.50'),
(5, '2809464340', '2019-07-11 16:50:13', '5.60'),
(5, '2809465657', '2019-07-11 16:50:16', '5.70'),
(5, '2809468729', '2019-07-11 16:50:34', '4.90'),
(5, '2809469636', '2019-07-11 16:50:37', '4.90'),
(5, '2809469911', '2019-07-11 16:50:39', '4.90'),
(5, '2809470960', '2019-07-11 16:50:41', '4.90'),
(5, '2809467250', '2019-07-11 16:50:44', '4.90'),
(5, '2809471525', '2019-09-02 17:50:41', '4.90'),
(5, '2365778062', '2019-08-03 12:57:32', '10.00'),
(5, '280945292X', '2019-09-17 07:32:23', '4.60'),
(5, '2809454132', '2019-08-04 13:08:57', '4.60');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `label` varchar(10) NOT NULL,
  `auth_level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `label`, `auth_level`) VALUES
(1, 'admin', 2),
(2, 'user', 1);

-- --------------------------------------------------------

--
-- Structure de la table `serietocomics`
--

CREATE TABLE `serietocomics` (
  `idSerie` int(11) NOT NULL,
  `idComics` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `serietocomics`
--

INSERT INTO `serietocomics` (`idSerie`, `idComics`) VALUES
(1, '2809468435 '),
(1, '2809463972'),
(2, '2809425493 '),
(2, '2809425272 '),
(2, '2809423970'),
(2, '2809423814'),
(2, '2809423210'),
(2, '2809422923'),
(2, '280942280X'),
(2, '2809422133'),
(2, '280942179X'),
(2, '2809420963 '),
(2, '2809418799'),
(44, '2809427178'),
(7, '2809456127'),
(7, '2809455090'),
(7, '2809458766'),
(6, '2840557509'),
(5, '2809465142'),
(7, '2809458081'),
(7, '2809457913'),
(9, '2756080772'),
(9, '2756093319'),
(9, '2756093327'),
(9, '2756077062 '),
(10, '2809473323'),
(20, '280946085X'),
(12, '2809463549'),
(12, '2809462933'),
(12, '2809462526'),
(12, '2809460922'),
(12, '2809460531'),
(12, '280945986X'),
(12, '280945972X'),
(12, '2809459347'),
(12, '2809459231'),
(12, '2809459061'),
(12, '2809458510'),
(13, '2809462534'),
(13, '2809459738'),
(13, '280945924X'),
(14, '2809463557'),
(14, '2809462941'),
(14, '2809462542'),
(14, '2809460930'),
(14, '280946054X'),
(14, '2809459878'),
(14, '2809459746'),
(14, '2809459355'),
(14, '2809459258'),
(14, '280945907X'),
(14, '2809458529'),
(14, '2809458367'),
(15, '2809460558'),
(15, '2809459363'),
(15, '2809458561'),
(16, '2809464030'),
(16, '2809458413'),
(16, '2809462593'),
(17, '2809455155'),
(17, '280945292X'),
(17, '2809454132'),
(18, '2809471274'),
(18, '2809452377'),
(17, '2809452512'),
(12, '2809458340'),
(22, '2809462690'),
(23, '2809468311'),
(24, '2809448302'),
(24, '2809448779'),
(24, '2809450919'),
(24, '2809451567'),
(24, '2809452067'),
(24, '2809452296'),
(24, '2809452520'),
(24, '2809452792'),
(24, '2809452938'),
(24, '2809453721'),
(25, '2809463980'),
(25, '2809464359'),
(25, '2809465258'),
(25, '2809465665'),
(25, '2809465991'),
(26, '2809441472'),
(26, '2809450110'),
(26, '2809462704'),
(26, '2809470146'),
(26, '2809477655'),
(27, '280944143X'),
(27, '2809448043'),
(27, '2809456496'),
(28, '2809439672'),
(28, '2809447853'),
(28, '2809455333'),
(28, '2809456879'),
(28, '2809462712'),
(29, '280945731X'),
(29, '2809460809'),
(29, '2809451397'),
(30, '2809465541'),
(30, '2809466998'),
(30, '2809470901'),
(30, '2809473064'),
(30, '2809476276'),
(30, '2809477086'),
(31, '2809442096'),
(31, '2809447888'),
(31, '2809450382'),
(31, '2809453330'),
(32, '2809435944'),
(32, '2809440018'),
(32, '2809446520'),
(32, '2809451265'),
(32, '2809455619'),
(32, '2809457212'),
(32, '2809462852'),
(32, '2809465177'),
(33, '2809463352'),
(34, '2809470332'),
(35, '2809464170'),
(36, '2809470863'),
(37, '2809453349'),
(38, '2809441731'),
(39, '2809476659'),
(40, '2809452725'),
(40, '2809451141'),
(40, '2809473552'),
(41, '2809441820'),
(41, '2809444005'),
(41, '2809451214'),
(41, '2809453314'),
(41, '2809454426'),
(41, '2809473595'),
(42, '2809446156'),
(42, '2809450579'),
(42, '2809453306'),
(42, '2809457174'),
(42, '280946281X'),
(42, '2809465827'),
(44, '2809428018'),
(44, '2809429189'),
(44, '2809429480'),
(44, '2809432228'),
(44, '2809432627'),
(45, '2809434034'),
(45, '2809436657'),
(45, '2809437742'),
(45, '2809438072'),
(45, '2809441081'),
(45, '2809442630'),
(45, '2809445036'),
(45, '2809446784'),
(45, '2809447381'),
(45, '2809448388'),
(45, '280945096X'),
(45, '2809452113'),
(45, '2809452571'),
(45, '2809452970'),
(45, '2809454051'),
(46, '2809447179'),
(46, '2809449902'),
(46, '2809452016'),
(46, '2809453756'),
(46, '2809454248'),
(1, '2809464332'),
(1, '280946524X'),
(1, '2809465649'),
(1, '2809465983'),
(1, '2809467072'),
(1, '2809467250'),
(1, '2809468729'),
(1, '2809469911'),
(1, '2809470960'),
(1, '2809471525'),
(1, '2809469636'),
(47, '2809467080'),
(47, '2809464340'),
(47, '2809465657'),
(48, '2809471606'),
(48, '2809473137'),
(48, '2809473420'),
(48, '2809473706'),
(48, '2809473862'),
(48, '2809474737'),
(48, '2809476071'),
(49, '2809476365'),
(49, '2809476845'),
(49, '2809477183'),
(49, '2809477477'),
(49, '2809477787'),
(51, '2365775721'),
(51, '2365778062');

-- --------------------------------------------------------

--
-- Structure de la table `série`
--

CREATE TABLE `série` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `nblivre` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `série`
--

INSERT INTO `série` (`id`, `nom`, `nblivre`) VALUES
(1, 'Deadpool (2017-2018)', 13),
(2, 'Deadpool (2011-2012)', 11),
(45, 'Deadpool (2013-2015)', 15),
(4, 'Batman Métal', 0),
(5, 'Secret Wars', 1),
(6, 'Hellboy', 1),
(7, 'Old man Logan', 5),
(9, 'Spawn Renaissance', 4),
(10, 'Nous Somme Venom', 1),
(20, '20 ans Panini comics', 1),
(12, 'All-New Deadpool', 12),
(13, 'All-New Deadpool hs', 3),
(14, 'All-New Les gardiens de la galaxie ', 12),
(15, 'All-New Les gardiens de la galaxie hs', 3),
(16, 'All-New X-Men hs', 3),
(17, 'Ant-man', 4),
(18, 'ant-Man prologue film', 2),
(22, 'Nous sommes les Gardiens de la Galaxie', 1),
(23, 'Les gardiens de la Galaxie - Mère Entropie', 1),
(24, 'Les gardiens de la Galaxie (2015)', 10),
(25, 'Les gardiens de la Galaxie (2017)', 5),
(26, 'Les gardiens de la Galaxie (L\'Intégrale)', 5),
(27, 'Les gardiens de la Galaxie (Marvel Deluxe)', 3),
(28, 'Les gardiens de la Galaxie (Marvel Now!)', 5),
(29, 'Les gardiens de la Galaxie / All-New X-Men (Marvel Now!)', 3),
(30, 'All-New Deadpool (Marvel Now!)', 6),
(31, 'Cable & Deadpool', 4),
(32, 'Deadpool', 8),
(33, 'Deadpool - Bad Blood', 1),
(34, 'Deadpool - Flash-Back', 1),
(35, 'Deadpool - Guerres Très Très Secrètes', 1),
(36, 'Je suis Deadpool', 1),
(37, 'Deadpool - Les Origines', 1),
(38, 'Deadpool - Suicide Kings', 1),
(39, 'Deadpool : Trop tôt ?', 1),
(40, 'Deadpool (100% Marvel)', 3),
(41, 'Deadpool (Marvel Dark)', 6),
(42, 'Deadpool (Marvel Deluxe)', 6),
(43, 'Deadpool (1998)', 0),
(44, 'Deadpool (2012-2013)', 6),
(46, 'Deadpool Hors Série(2013-2015)', 5),
(47, 'Deadpool Hors Série(2017-2018)', 3),
(48, 'Deadpool (2018-2019)', 7),
(49, 'Deadpool (2019)', 5),
(51, 'Arrow', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(500) NOT NULL,
  `pseudo` varchar(500) NOT NULL,
  `role_id` int(1) NOT NULL,
  `mdp` varchar(500) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `pseudo`, `role_id`, `mdp`, `dateCreation`) VALUES
(7, 'test@gmail.fr', 'test', 1, '$2y$10$/LBwj2uCpg42tshQGbxN7eFKtttU4YVvsh2SmkO2heS10emzEgcxO', '2019-08-02 14:06:12'),
(6, 'lambda@gmail.com', 'lambda', 1, '$2y$10$bZ.ys/M/kdkfoDefNuiDv.Th1Muej4qD3uFONZZ70nMU6MvRtNfvq', '2019-07-21 18:43:43'),
(5, 'gauthierbrin@gmail.com', 'Rooster', 2, '$2y$10$aNCrCyuTItGd5XuCeqDP5um3dKsuZXCBLZxBrq4exLmSgWv4AzqIC', '2019-05-22 10:19:49');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `accueilwallpaper`
--
ALTER TABLE `accueilwallpaper`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`,`isbn`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`equipe`,`heros`);

--
-- Index pour la table `héros`
--
ALTER TABLE `héros`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`ISBN`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `série`
--
ALTER TABLE `série`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `accueilwallpaper`
--
ALTER TABLE `accueilwallpaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `auteur`
--
ALTER TABLE `auteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `héros`
--
ALTER TABLE `héros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `série`
--
ALTER TABLE `série`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
