-- --------------------------------------------------------
-- Hôte :                        lamp-edu.condorcet.be
-- Version du serveur:           5.5.33-MariaDB - openSUSE package
-- SE du serveur:                Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de données de la table volkan_bostanci_citadelle.ATTENTE : ~0 rows (environ)
/*!40000 ALTER TABLE `ATTENTE` DISABLE KEYS */;
/*!40000 ALTER TABLE `ATTENTE` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.COMMANDE : ~3 rows (environ)
/*!40000 ALTER TABLE `COMMANDE` DISABLE KEYS */;
INSERT INTO `COMMANDE` (`ID_COMMANDE`, `ID_CLIENT`, `PRIX_TOTAL`, `PAYE`, `DATE`) VALUES
	(24, 1, 134.87, NULL, '2018-01-05 15:24:03'),
	(25, 1, 194.20, NULL, '2018-01-05 15:30:06'),
	(26, 1, 144.54, NULL, '2018-01-05 17:09:10');
/*!40000 ALTER TABLE `COMMANDE` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.COMMENTE : ~0 rows (environ)
/*!40000 ALTER TABLE `COMMENTE` DISABLE KEYS */;
/*!40000 ALTER TABLE `COMMENTE` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.COMPORTE : ~8 rows (environ)
/*!40000 ALTER TABLE `COMPORTE` DISABLE KEYS */;
INSERT INTO `COMPORTE` (`ID_COMMANDE`, `ID_PRODUIT`, `QUANTITE`, `PRIX`) VALUES
	(24, 18, 7, 5.85),
	(25, 18, 1, 5.85),
	(26, 18, 5, 5.85),
	(25, 20, 4, 13.45),
	(24, 22, 4, 23.48),
	(26, 22, 3, 23.48),
	(25, 23, 3, 44.85),
	(26, 23, 1, 44.85);
/*!40000 ALTER TABLE `COMPORTE` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.COULEURS : ~3 rows (environ)
/*!40000 ALTER TABLE `COULEURS` DISABLE KEYS */;
INSERT INTO `COULEURS` (`ID_COULEUR`, `NOM`) VALUES
	(1, 'Rouge'),
	(2, 'Rosé'),
	(3, 'Blanc');
/*!40000 ALTER TABLE `COULEURS` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.GOUTS : ~6 rows (environ)
/*!40000 ALTER TABLE `GOUTS` DISABLE KEYS */;
INSERT INTO `GOUTS` (`ID_GOUT`, `NOM`) VALUES
	(1, 'Fruité'),
	(2, 'Puissant'),
	(3, 'Boisé'),
	(4, 'Souple/Léger'),
	(5, 'Sec'),
	(6, 'Liquoreux/Sucré');
/*!40000 ALTER TABLE `GOUTS` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.PAGES : ~3 rows (environ)
/*!40000 ALTER TABLE `PAGES` DISABLE KEYS */;
INSERT INTO `PAGES` (`ID_PAGE`, `NOM`, `TEXTE`) VALUES
	(1, 'FAQ', '<h2><strong>1 - Mon paiement en ligne est il securis&eacute; ?</strong></h2>\r\n\r\n<p>Citadelle du Vin utilise un syst&egrave;me de paiement s&eacute;curis&eacute; aux normes SSL, le protocole de cryptage le plus s&ucirc;r et le plus r&eacute;pandu actuellement. Vos coordonn&eacute;es bancaires sont directement crypt&eacute;es et rout&eacute;es vers notre organisme bancaire de paiement&nbsp;sans passer par notre site. Citadelle du Vin ne stocke donc aucune information bancaire.</p>\r\n\r\n<h2><strong>2 - Comment r&eacute;gler ma commande ?</strong></h2>\r\n\r\n<p>- Par Paypal,<br />\r\n<br />\r\nCes choix vous sont propos&eacute;s lors de la validation de votre commande en fonction des m&eacute;thodes de paiement valables pour votre pays de facturation.</p>\r\n\r\n<h2><strong>3 - Que se passe t-il en cas d&#39;absence lors de la livraison ?</strong></h2>\r\n\r\n<p>En cas d&#39;absence, le colis est automatiquement livr&eacute; dans le Relais Colis le plus proche. Vous en &ecirc;tes inform&eacute; par un avis de passage &agrave; votre domicile et recevez par SMS ou e-mail les coordonn&eacute;es du Relais Colis concern&eacute;. Vous pouvez alors aller chercher votre colis le jour m&ecirc;me d&egrave;s 15H selon vos disponibilit&eacute;s.</p>\r\n\r\n<h2><strong>4 - Que se passe t-il en cas de casse lors de la livraison ?</strong></h2>\r\n\r\n<p>Nos conditionnements sont &eacute;tudi&eacute;s sp&eacute;cifiquement pour le transport du vin. Nous avons un taux de casse tr&egrave;s faible (moins de 0.5 % des envois). Si l&#39;aspect de la livraison malgr&eacute; tout ne vous parait pas convenable, refusez la globalit&eacute; de la commande et faites notifier des r&eacute;serves pr&eacute;cises sur le bon de transport expliquant le refus. Contactez alors notre service client&egrave;le dans les 48 heures par mail &agrave; sav@citadelleduvin.be&nbsp;pr&eacute;cisant votre N&deg; de commande et la nature du litige. Nous prendrons toutes les dispositions n&eacute;cessaires pour vous r&eacute;exp&eacute;dier votre colis &agrave; nos frais dans les plus brefs d&eacute;lais.</p>\r\n\r\n<h2><strong>5 - Comment puis-je modifier ou annuler ma commande ?</strong></h2>\r\n\r\n<p>Si vous avez d&eacute;j&agrave; valid&eacute; enti&egrave;rement votre commande et votre paiement en ligne et que vous souhaitez la modifier ou l&#39;annuler, n&#39;h&eacute;sitez pas &agrave; nous contacter par mail &agrave; sav@citadelleduvin.be le plus rapidement possible. Nous ferons le n&eacute;cessaire imm&eacute;diatement.</p>'),
	(2, 'Informations générales', '<h1 style="text-align:center"><span style="color:#c0392b"><strong>En cours</strong></span></h1>'),
	(3, 'Accueil', '<div class="container text-center">\r\n<h1 style="text-align:center">CITADELLE DU VIN, LA PASSION DU CONSEIL</h1>\r\n\r\n<p style="text-align:center">CITADELLE DU VIN, c&#39;est 30 ans de savoir-faire dans la s&eacute;lection des vins. Marques en propre, exclusivit&eacute;s, l&rsquo;ensemble du vignoble fran&ccedil;ais et &eacute;tranger composent la gamme des vins. Vins de Bordeaux, de Bourgogne, de la Vall&eacute;e de la Loire, toutes les r&eacute;gions et les c&eacute;pages sont repr&eacute;sent&eacute;s.</p>\r\n\r\n<p style="text-align:center">&nbsp;</p>\r\n\r\n<h1>&nbsp;</h1>\r\n</div>');
/*!40000 ALTER TABLE `PAGES` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.PAYS : ~3 rows (environ)
/*!40000 ALTER TABLE `PAYS` DISABLE KEYS */;
INSERT INTO `PAYS` (`ID_PAYS`, `NOM`) VALUES
	(1, 'France'),
	(2, 'Portugal'),
	(3, 'Italie');
/*!40000 ALTER TABLE `PAYS` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.PRODUITS : ~10 rows (environ)
/*!40000 ALTER TABLE `PRODUITS` DISABLE KEYS */;
INSERT INTO `PRODUITS` (`ID_PRODUIT`, `ID_PAYS`, `ID_GOUT`, `ID_COULEUR`, `NOM`, `DESCRIPTION`, `DEGRE_ALCOOL`, `MILLESIME`, `TEMP_SERVICE`, `STOCK`, `BIO`, `PHOTO`, `PRIX`, `SUPPRIME`) VALUES
	(18, 1, 5, 3, 'CHÂTEAU DE LA GUIMONIERE - ANJOU', 'Du nez à la dégustation, il nous a séduit et on comprend pourquoi il a été médaillé ! Ne jugez surtout pas ce vin à son prix....Coup de cœur pour les sommeliers de la Citadelle du vin que l’on souhaitait partager avec vous. Un vrai plaisir à déguster avec des crustacés, poissons et un assortiment de charcuteries. TOP AFFAIRE en Loire à savourez...', '12', '2011', 10, 124, 1, 'wine.png', 5.85, 1),
	(20, 1, 1, 1, 'BOURGOGNE DU CHATEAU DE MARSANNA', 'Le Bourgogne Rouge petit prix, idéal pour toute occasion ! Un vrai moment de plaisir assuré !\r\nVéritable Coup de Coeur de nos sommeliers, ce Bourgogne du Chateau de Marsannay est ample et généreuse sur le fruit. La bouche gourmande, ronde et fraîche en feront un atout majeur de votre cave... Il sera difficile pour vous de garder cette friandise loin de vos convives ! Une valeur sûre en puissance... Bref, foncez les yeux fermés !', '12,5', '2014', 15, 256, 1, 'wine.png', 13.45, 1),
	(22, 1, 2, 2, 'COEUR DE GRAIN 2016 - CHATEAU RO', 'E ROSE LE PLUS CÉLÈBRE DU MONDE ! LA référence des vins de Bandol !\r\nL\'élite des rosés. Récolté à la main, tri très sélectif, vieillissement en foudre de chêne. Célèbre entre tous, le rosé Coeur de grain séduit depuis les années 30 : aromatique, souple, nerveux et élégant. Idéal sur des crevettes flambées, une viande rouge très tendre ou un filet de poisson, ce Bandol inégalable reste LA référence des vins de Bandol.', '13', '2016', 8, 420, 0, 'wine.png', 23.48, 1),
	(23, 3, 2, 1, 'TEDESCHI - AMARONE CLASSICO 2013', 'Savourez un Amarone, la passion du domaine Tedeschi. Un processus de fabrication bien particulier qui permet d\'obtenir un vin à la richesse exceptionnelle !\r\nLe secret de fabrication de l\'Amarone commence par une vendange tardive, puis les raisins sont séchés à l\'air libre environ pendant trois 3 mois (passerillage) Il en résulte des vins puissants, veloutés, et concentrés en arômes. Votre palais découvrira ses parfums de cacao, d\'épices et de fruits noirs séchés (prune, datte, cerise, figue). En accompagnement d\'un magret de canard rôti, vous allez fondre pour son crémeux et sa finale envoûtante !', '12,5', '2013', 17, 124, 0, 'wine.png', 44.85, 1),
	(28, 1, 5, 2, 'MIRAVAL', 'Miraval rosé provient des meilleures vignes du château, bénéficiantde sa propre vallée au coeur de la Provence, ainsi que d\'une sélection de vignobles dans les meilleurs terroirs de Provence.\r\nLes sols sont argilo-calcaires, partiellement en terrasses, à une altitude moyenne de 350 mètres. Le climat frais pour la région et d’importantes variations de température entre le jour et la nuit permettent de conserver des équilibres parfaits dans les vins.\r\nLes raisins sont essentiellement vendangés le matin,puis triés et éraflés. Pressurage direct pour le Cinsault,le Grenache et le Rolle. La Syrah est vinifiée par saignée. Vinification en cuves inox, sous contrôle de température (95%) et en fûts (5%) avec bâtonnage.', '13', '2015', 8, 242, 0, '0', 19.00, 0),
	(29, 3, 1, 3, 'ALTROVE', 'Situé à 400 mètres au-dessus du niveau de mer, le climat est tempéré et caractérisé par un été chaud et venteux et de bonnes différences de température entre le jour et la nuit. Altrove signifie "dans un autre endroit", comme le paysage de Corleone où sont plantée les vignes, donnant la sensation de se trouver ailleur, dans un autre endroit.\r\n\r\nTreillis vertical, épi élagué en cordon. Densité de la plantation par ACRE : 4.500 pieds. Sélection des raisins méticuleuse, ramassé à la main.  Le Chardonnay mi- août ; les Catarratto et Insolia, la première semaine de septembre.\r\n\r\nPRODUCTION TECHNIQUE : doucement pressée, la fermentation se déroule entre 57° et 61 ° F. ensuite, le vin repose sur lies fines pendant 3 mois et en bouteille pendant 1 mois.', '9', '2015', 6, 12, 0, '83035', 13.60, 0),
	(30, 1, 1, 1, 'VIGNORONS DU VIEUX TINAILLER', 'Ce vin possède une robe délicate de couleur violette. Non content d’avoir l’air délicieux, il vous séduira aussi par son bouquet fruité et épicé. Ce vin sec léger et vif possède une acidité qui ne manque pas de caractère, ainsi qu’un corps léger et accessible. Nous avons là un vin spontané, qui développe des notes minérales en fin de bouche.', '13,5', '2015', 16, 145, 0, '72775', 6.49, 0),
	(31, 3, 2, 3, 'CASTEL DI SERRA', 'Fort de sa légèreté et de son élégance uniques, le Gavi di Gavi est l’un des meilleurs vins blancs d’Italie. Ce vin blanc sec élégant arbore une subtile robe jaune paille. Au nez et en bouche, on retrouve d’intenses arômes fruités d’ananas et de pomme ainsi que des notes de noix de muscade, d’ortie et de pierre à fusil. L’acidité est bien intégrée et la finale est longue. Nous avons ici un vin qui invite à se resservir.', '12,5', '2015', 10, 123, 0, '16614', 4.69, 0),
	(32, 1, 3, 1, 'THOMAS COLLONGE', 'Le vignoble du Beaujolais est une bande d’une cinquantaine de kilomètres de long sur une vingtaine de large, située au nord de la région lyonnaise. \r\nLe Beaujolais se caractérise par un sol granitique et acide et un climat continental aux hivers froids et secs bénéfiques à la vigne. \r\nLe vignoble souffre cependant parfois de printemps particulièrement froids et doit subir les assauts dévastateurs de gelées tardives. Cependant, la Saône a un rôle modérateur non négligeable et tempère la rudesse de ce climat.', '13.5', '2015', 16, 100, 0, '51163', 17.90, 0),
	(33, 1, 1, 1, 'DOMAINE JOLY', 'Le vignoble du Beaujolais est une bande d’une cinquantaine de kilomètres de long sur une vingtaine de large, située au nord de la région lyonnaise. \r\nLe Beaujolais se caractérise par un sol granitique et acide et un climat continental aux hivers froids et secs bénéfiques à la vigne. \r\nLe vignoble souffre cependant parfois de printemps particulièrement froids et doit subir les assauts dévastateurs de gelées tardives. Cependant, la Saône a un rôle modérateur non négligeable et tempère la rudesse de ce climat.', '13.5', '2015', 16, 36, 1, '43268', 8.20, 0);
/*!40000 ALTER TABLE `PRODUITS` ENABLE KEYS */;

-- Export de données de la table volkan_bostanci_citadelle.UTILISATEURS : ~11 rows (environ)
/*!40000 ALTER TABLE `UTILISATEURS` DISABLE KEYS */;
INSERT INTO `UTILISATEURS` (`ID_CLIENT`, `NOM`, `PRENOM`, `RUE`, `CODE_POSTAL`, `LOCALITE`, `TELEPHONE`, `EMAIL`, `MOT_DE_PASSE`, `SALT`, `ROLE`) VALUES
	(1, 'DOE', 'JOHN', 'AVENUE DU CHAMPS DE MARS 15', '7000', 'MONS', '0487125841', 'JOHN.DOE@GMAIL.COM', '$2y$13$F9v8pl5u5WMrCorP9MLyJeyIsOLj.0/xqKd/hqa5440kyeB7FQ8te', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_ADMIN'),
	(2, 'BOSTANCI', 'VOLKAN', 'RUE ALBERT 1er 30', '7012', 'JEMAPPES', '0478128512', 'VOLKAN.TEST@GMAIL.COM', '$2y$13$X6uxZLc4FEKo6yjr2PawXewosQsQhqzIgjD4XggIODbo7tEubr8uS', 'd2c08f937841345575a9450', 'ROLE_USER'),
	(45, 'DUPONT', 'JEAN', 'RUE PORTE-AVION 13', '6000', 'CHARLEROI', '478995232', 'DUPONT.JEAN@GMAIL.COM', '$2y$13$qJmAHabfLoi/xr/PWHsNoeutEL6g.AVcoZlfGXnf0ieE/0omCNU8O', 'd8a4701e3fe3675c8c74bc0', 'ROLE_USER'),
	(46, 'ROUGE', 'GéRARD', 'RUE ALPHONE BRUNO 16', '7390', 'QUAREGNON', '0489121416', 'GERARD.ROUGE@GMAIL.COM', '$2y$13$XiU9ojbQUNVPpKvqXUq.JeZXQVUYKfRyilxEJj2evRgAATjuC6Lvi', '88e8ef03fa7e89634ae1e81', 'ROLE_USER'),
	(47, 'CHARLES', 'ELODIE', 'CHEMIN DU PETIT LION 26', '1020', 'BRUXELLES', '0498452368', 'CHARLES.ELODIE@MAIL.BE', '$2y$13$UsIiiVNuHuxVWo6QT77iiup2gkoWySCjpBhGkbZEKydcZYmKB4FfG', '09dc120abf2023a9ecafa1c', 'ROLE_USER'),
	(48, 'MURILLA', 'DAVID', 'RUE TOURNATE 125', '7100', 'LA LOUVIèRE', '0485127485', 'MUR.DAV@HOTMAIL.COM', '$2y$13$1t/jwHrhkY0dfBSrDKDtwejT82rSd6DbnF1XAcDCejAVk8pRs3Gsy', 'eac13776de1c93d835c4218', 'ROLE_USER'),
	(49, 'MARCASSIN', 'FRéDéRIC', 'RUE HENRY PAUL 2', '7080', 'FRAMERIES', '065742536', 'FRED.MARCASSIN@OUTLOOK.FR', '$2y$13$EM3JPc483pKakBOEub49tuQ6zajMWodEKKo5hyGHD9F1sQfBv3u6S', '27d9c800c3d346d92ae0b15', 'ROLE_USER'),
	(50, 'CLEMER', 'ALICE', 'RUE DE MONS', '1030', 'AUDERGHEM', '022595636', 'CLEMER.ALICE@LIVE.BE', '$2y$13$4uhC6H87P4W3zw9G5Z4mq.a/1AjVb8WVreurMigE40TBUpuWqO91O', 'd6c9243e188187b252204d0', 'ROLE_USER'),
	(51, 'DEBUCQUOY', 'ROSE', 'RUE MARéCHAL FOCH 112', '7012', 'JEMAPPES', '065781423', 'ROSE.D@GMAIL.COM', '$2y$13$pK5Wsk5GfMnFLk5WuAGM8exucam8txztzNxqw0pKPSATigHN5HL4O', '7c5e14dcb28754166d3e6b3', 'ROLE_USER'),
	(52, 'ACHOUR', 'TAREK', 'BOULEVARD CARLES 1ER 362B', '5000', 'NAMUR', '056125896', 'ACHOUR.T@OUTLOOK.FR', '$2y$13$k390ho0eXihEU8UtwO.3eue7oAyudCIqCY4b7hzUvWMgpSBlP3OQi', '8f97d6a3eaba43363177fc0', 'ROLE_USER'),
	(53, 'FéDé', 'FILIPPO', 'RUE CHARLEMAGNE 123', '1080', 'BRUXELLES', '0487125850', 'FILIPPOFEDE@GMAIL.COM', '$2y$13$XjBzCOakLuxhfbgq6s4fX.08CLMQD1uoj9Vtv9naA4ngdJJPMuSSW', '8078e335f9592eda47fe7ea', 'ROLE_USER');
/*!40000 ALTER TABLE `UTILISATEURS` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
