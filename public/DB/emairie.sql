-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table emairie. actualites
CREATE TABLE IF NOT EXISTS `actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appel` text NOT NULL,
  `resume` text,
  `description` text,
  `picture` varchar(200) DEFAULT NULL,
  `type_actualite_id` int(11) NOT NULL,
  `mairie_id` int(11) NOT NULL,
  `source` varchar(200) DEFAULT NULL,
  `source_link` varchar(200) DEFAULT NULL,
  `number_views` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `register_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.actualites : ~8 rows (environ)
/*!40000 ALTER TABLE `actualites` DISABLE KEYS */;
INSERT INTO `actualites` (`id`, `appel`, `resume`, `description`, `picture`, `type_actualite_id`, `mairie_id`, `source`, `source_link`, `number_views`, `created_at`, `updated_at`, `deleted_at`, `register_user_id`) VALUES
	(1, 'La Centrafrique n’est jamais vraiment passée de la crise à la réconciliation 2', 'Lorsque M. Touadéra a commencé son premier mandat, il y a cinq ans, on aurait pu espérer un avenir meilleur pour la Centrafrique. Le pays s’était lentement, douloureusement éloigné d’une catastrophe humanitaire en 2013 et, deux ans après, semblait plus ou moins prêt pour des élections démocratiques. Les forces de maintien de la paix de l’ONU, en collaboration avec l’armée française, avaient apporté une certaine sécurité ; le gouvernement de transition avait accepté d’organiser le scrutin et de rendre le pouvoir au vainqueur ; la communauté internationale s’était chargée de la logistique électorale dans un pays déchiré par la guerre et en grande partie sans infrastructures.\r\n\r\nDes groupes armés tantôt rivaux, tantôt alliés\r\nMiraculeusement, les élections de 2015-2016 qui ont porté M. Touadéra au pouvoir ont été largement pacifiques et les observateurs internationaux se sont accordés pour dire qu’elles respectaient globalement la volonté de l’électorat. Quelques mois après le scrutin, lors d’une conférence internationale des donateurs à Bruxelles, la communauté internationale a levé 2 milliards d’euros pour aider à la reconstruction du pays. Quelques années plus tard, en 2019, le gouvernement et une douzaine de groupes armés ont signé à Khartoum un accord de paix sous les auspices de l’Union africaine (UA) et de la Communauté économique des Etats de l’Afrique centrale (CEEAC).', 'Lorsque M. Touadéra a commencé son premier mandat, il y a cinq ans, on aurait pu espérer un avenir meilleur pour la Centrafrique. Le pays s’était lentement, douloureusement éloigné d’une catastrophe humanitaire en 2013 et, deux ans après, semblait plus ou moins prêt pour des élections démocratiques. Les forces de maintien de la paix de l’ONU, en collaboration avec l’armée française, avaient apporté une certaine sécurité ; le gouvernement de transition avait accepté d’organiser le scrutin et de rendre le pouvoir au vainqueur ; la communauté internationale s’était chargée de la logistique électorale dans un pays déchiré par la guerre et en grande partie sans infrastructures.\r\n\r\nDes groupes armés tantôt rivaux, tantôt alliés\r\nMiraculeusement, les élections de 2015-2016 qui ont porté M. Touadéra au pouvoir ont été largement pacifiques et les observateurs internationaux se sont accordés pour dire qu’elles respectaient globalement la volonté de l’électorat. Quelques mois après le scrutin, lors d’une conférence internationale des donateurs à Bruxelles, la communauté internationale a levé 2 milliards d’euros pour aider à la reconstruction du pays. Quelques années plus tard, en 2019, le gouvernement et une douzaine de groupes armés ont signé à Khartoum un accord de paix sous les auspices de l’Union africaine (UA) et de la Communauté économique des Etats de l’Afrique centrale (CEEAC).', 'actualites/YoszFRQESw7rUSqlPwDPFV0GLEq3F6ekGoP5vM3z.jpg', 1, 1, 'Le monde', 'https://www.lemonde.fr/afrique/article/2021/01/11/la-centrafrique-n-est-jamais-vraiment-passee-de-la-crise-a-la-reconciliation_6065894_3212.html', NULL, '2021-01-12 08:01:03', '2021-01-12 08:17:23', NULL, 1),
	(2, 'La Centrafrique n’est jamais vraiment passée de la crise à la réconciliation', 'La Centrafrique n’est jamais vraiment passée de la crise à la réconciliation', 'Lorsque M. Touadéra a commencé son premier mandat, il y a cinq ans, on aurait pu espérer un avenir meilleur pour la Centrafrique. Le pays s’était lentement, douloureusement éloigné d’une catastrophe humanitaire en 2013 et, deux ans après, semblait plus ou moins prêt pour des élections démocratiques. Les forces de maintien de la paix de l’ONU, en collaboration avec l’armée française, avaient apporté une certaine sécurité ; le gouvernement de transition avait accepté d’organiser le scrutin et de rendre le pouvoir au vainqueur ; la communauté internationale s’était chargée de la logistique électorale dans un pays déchiré par la guerre et en grande partie sans infrastructures.\r\n\r\nDes groupes armés tantôt rivaux, tantôt alliés\r\nMiraculeusement, les élections de 2015-2016 qui ont porté M. Touadéra au pouvoir ont été largement pacifiques et les observateurs internationaux se sont accordés pour dire qu’elles respectaient globalement la volonté de l’électorat. Quelques mois après le scrutin, lors d’une conférence internationale des donateurs à Bruxelles, la communauté internationale a levé 2 milliards d’euros pour aider à la reconstruction du pays. Quelques années plus tard, en 2019, le gouvernement et une douzaine de groupes armés ont signé à Khartoum un accord de paix sous les auspices de l’Union africaine (UA) et de la Communauté économique des Etats de l’Afrique centrale (CEEAC).', NULL, 1, 1, 'Le monde', 'https://www.lemonde.fr/afrique/article/2021/01/11/la-centrafrique-n-est-jamais-vraiment-passee-de-la-crise-a-la-reconciliation_6065894_3212.html', NULL, '2021-01-12 08:12:53', '2021-01-12 08:17:33', '2021-01-12 08:17:33', 1),
	(3, 'RDC : comment le camp Tshisekedi prépare la destitution du Premier ministre Sylvestre Ilunga Ilunkamba', 'En difficulté depuis l’annonce de la rupture de la coalition FCC-Cach, Sylvestre Ilunga Ilunkamba est désormais dans le viseur des députés pro-Tshisekedi. Voici comment ils comptent obtenir le départ du Premier ministre.', 'Un mois après la chute de Jeanine Mabunda, la présidente de l’Assemblée nationale, les députés ralliés à l’Union sacrée – la nouvelle coalition formée autour de Félix Tshisekedi – souhaitent désormais obtenir le départ de Sylvestre Ilunga Ilunkamba, le Premier ministre nommé en mai 2019.\r\n\r\nÀ LIRE RDC : Félix Tshisekedi demande la démission du Premier ministre Sylvestre Ilunga Ilunkamba', 'actualites/MHC5C1RjG6kFB4HUR9TFezoEqp5R6TVrMRpL4cma.jpg', 2, 1, 'https://www.jeuneafrique.com/', 'https://www.jeuneafrique.com/1104099/politique/rdc-comment-le-camp-tshisekedi-prepare-la-destitution-du-premier-ministre-sylvestre-ilunga-ilunkamba/', NULL, '2021-01-13 19:37:48', '2021-01-13 19:37:48', NULL, 1),
	(4, 'Procès des 100 jours en RDC : les dessous de la libération « surprise » des deux patrons', 'Condamnés à deux et cinq ans de prison dans le cadre du procès des 100 jours, Modeste Makabuza et Benjamin Wenga ont été libérés le 8 janvier, sans raison officielle. Voici pourquoi ils ont été libérés.', 'La libération le 8 janvier de Modeste Makabuza et Benjamin Wenga, directeurs généraux de la Société congolaise de construction (Sococ) et de l’Office des voiries et drainage (OVD), a fait scandale à Kinshasa. Aucune raison officielle n’a été avancée, alors que les deux hommes ont été condamnés en juin 2020 pour détournement de deniers publics, concussion et corruption dans le cadre du procès des 100 jours, lors duquel Vital Kamerhe a écopé de vingt ans de prison. L’ancien directeur de cabinet de Félix Tshisekedi n’a lui pas recouvré sa liberté, tout comme ses co-accusés Samih Jammal et Muhima Ndole.', 'actualites/9J0ez1sbFHNbDR3JxU4II73xRnDUmXMF5Ogj6Zgf.jpg', 1, 2, 'https://www.jeuneafrique.com/', 'https://www.jeuneafrique.com/1103023/politique/proces-des-100-jours-en-rdc-les-dessous-de-la-liberation-surprise-des-deux-patrons/', NULL, '2021-01-13 19:39:31', '2021-01-13 19:39:31', NULL, 1),
	(5, 'République démocratique du Congo', 'Appel à la vigilance maximale – risque d’attentat (04/11/2020)\r\n\r\nPour rappel, comme indiqué dans l’alerte générale, publiée le 29 octobre 2020, le risque d’attentat étant élevé, les Français résidents ou de passage à l’étranger sont appelés à faire preuve de vigilance maximale.\r\n\r\nIl convient en particulier de se tenir à l’écart de tout rassemblement et d’être prudent à l’occasion des déplacements. Il est également recommandé de se tenir informé de la situation et des risques, en consultant les recommandations des Conseils aux voyageurs.\r\nLes Français de passage sont invités à s’enregistrer sur le fil d’Ariane, afin de recevoir les alertes concernant le pays où ils se trouvent.', 'Appel à la vigilance maximale – risque d’attentat (04/11/2020)\r\n\r\nPour rappel, comme indiqué dans l’alerte générale, publiée le 29 octobre 2020, le risque d’attentat étant élevé, les Français résidents ou de passage à l’étranger sont appelés à faire preuve de vigilance maximale.\r\n\r\nIl convient en particulier de se tenir à l’écart de tout rassemblement et d’être prudent à l’occasion des déplacements. Il est également recommandé de se tenir informé de la situation et des risques, en consultant les recommandations des Conseils aux voyageurs.\r\n\r\nLes Français de passage sont invités à s’enregistrer sur le fil d’Ariane, afin de recevoir les alertes concernant le pays où ils se trouvent.', 'actualites/zYi5ewQiW4DRSQHrKvrHyVxD09NByPIVlYqgm3Dp.jpg', 1, 5, 'https://www.diplomatie.gouv.fr/', 'https://www.diplomatie.gouv.fr/fr/conseils-aux-voyageurs/conseils-par-pays-destination/republique-democratique-du-congo/', NULL, '2021-01-13 19:41:34', '2021-01-13 19:41:34', NULL, 1),
	(6, 'Muslims in Congo – Kinshasa', 'The Democratic Republic of the Congo (DRC) is located in central Africa, bordered to the north by the Central African Republic and South Sudan, to the east by Uganda, Rwanda, Burundi, and Tanzania, to the south by Zambia and Angola, to the west by the Republic of the Congo, and to the Southwest by the Atlantic Ocean.', 'The Democratic Republic of the Congo (DRC) is located in central Africa, bordered to the north by the Central African Republic and South Sudan, to the east by Uganda, Rwanda, Burundi, and Tanzania, to the south by Zambia and Angola, to the west by the Republic of the Congo, and to the Southwest by the Atlantic Ocean.\r\n\r\nThe Democratic Republic of the Congo (DRC) is located in central Africa, bordered to the north by the Central African Republic and South Sudan, to the east by Uganda, Rwanda, Burundi, and Tanzania, to the south by Zambia and Angola, to the west by the Republic of the Congo, and to the Southwest by the Atlantic Ocean.', 'actualites/YU5j0J0lAzQjezsE37BN6NbhYMEkIBzrSO85AOeM.jpg', 3, 5, 'http://nooralislam-lb.net/', 'http://nooralislam-lb.net/en/2019/03/18/muslims-in-congo-kinshasa/', NULL, '2021-01-13 19:43:40', '2021-01-13 19:43:40', NULL, 1),
	(7, 'RD CONGO – Kinshasa, belle de nuit et gueule de bois', 'Matongé. 2 h du matin. À l’entrée des boîtes de nuit, des milliers de jeunes Kinois s’agglutinent. Dans ce quartier chaud de Kinshasa, la fête dure toute la nuit.Tous les jours de la semaine.', 'Matongé. 2 h du matin. À l’entrée des boîtes de nuit, des milliers de jeunes Kinois s’agglutinent. Dans ce quartier chaud de Kinshasa, la fête dure toute la nuit.Tous les jours de la semaine. La bière coule à flots. La Primus congolaise ou la Simba du Katanga. Les jupes se portent courtes. Les seins et les formes se montrent. Loin du puritanisme d’autres capitales africaines. Les dollars américains passent allègrement d’une main à l’autre, à la lueur blafarde des bougies. L’éclairage public est presque inexistant. Et l’électricité rare certains soirs.', 'actualites/BdBb9vaUr3C8krByFzVjQetjIsFAtHMIt4LzBdDj.jpg', 2, 1, 'http://www.courrierdesafriques.net/', 'http://www.courrierdesafriques.net/', NULL, '2021-01-13 19:45:17', '2021-01-13 19:45:17', NULL, 1),
	(8, 'Congo Kinshasa : pays riche, pour le meilleur et pour le pire', NULL, 'Deuxième pays d’Afrique par sa superficie, la République Démocratique du Congo bat tous les records, tant par sa diversité géographique que par l’étendue de ses richesses, qui se trouvent dans sous-sol, ses ethnies, sa faune ou sa flore. Pendant des décennies, ce territoire a fait l’objet de convoitise de la part de nombreux pays occidentaux, au point de déclencher des conflits qui sévissent encore aujourd’hui. Malgré tout, le Congo Kinshasa est encore un diamant brut.\r\nEn remontant le fleuve Congo, véritable oasis au cœur de l’Afrique entouré d’une végétation luxuriante, on aperçoit des chaînes de montagnes, des volcans, des lacs, et des chutes d’eau vertigineuses.', 'actualites/xOhkHdRLLuzyw5kI8bcuYImnkAlz6fLeIZb5Ks1X.jpg', 2, 1, 'https://happyinafrica.com/', 'https://happyinafrica.com/', NULL, '2021-01-13 19:48:04', '2021-01-13 19:48:22', NULL, 1);
/*!40000 ALTER TABLE `actualites` ENABLE KEYS */;

-- Listage de la structure de la table emairie. administreds
CREATE TABLE IF NOT EXISTS `administreds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_commune_id` int(11) NOT NULL,
  `quartier_residence` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence_commune_id` int(11) DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_papers_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_papers_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mairie_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fichier_piece` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_user_id` int(11) NOT NULL,
  `last_updated_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `administreds_mairie_id_index` (`mairie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.administreds : ~0 rows (environ)
/*!40000 ALTER TABLE `administreds` DISABLE KEYS */;
INSERT INTO `administreds` (`id`, `firstname`, `lastname`, `phone`, `phone2`, `email`, `birth_date`, `birth_place`, `birth_commune_id`, `quartier_residence`, `residence_commune_id`, `job`, `picture`, `gender`, `identity_papers_type`, `identity_papers_id`, `birth_certificate_number`, `mairie_id`, `status`, `fichier_piece`, `signature`, `register_user_id`, `last_updated_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'AYEKPA ', 'ABLE ', '98989889', '678687687', 'ayey@gmail.com', '2021-01-13', 'jkffhf', 1, 'jkdfdh', 1, 'klfnlkf', 'actualites/YoszFRQESw7rUSqlPwDPFV0GLEq3F6ekGoP5vM3z.jpg', 'M', '4242442', 'CNI', 'ABC3245', 1, 'dsds', 'sjksjk', NULL, 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `administreds` ENABLE KEYS */;

-- Listage de la structure de la table emairie. agents
CREATE TABLE IF NOT EXISTS `agents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mairie_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agents_mairie_id_index` (`mairie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.agents : ~10 rows (environ)
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` (`id`, `firstname`, `lastname`, `phone`, `email`, `picture`, `job`, `mairie_id`, `status`, `signature`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'De cocody', 'Admin Fonctionnel', '82637201', 'acocody@gmail.com', 'agents/bQ7lboGm86uTiDhYqX7g1tl7zR9tv37ZmEJQ5Ndj.jpeg', 'Moyens generaux', 5, NULL, 'agents/signature/4QsJj8yPgrCmJOEu8YtF4r46bN8sPYOtTFy0qkQr.png', '2020-12-10 19:39:50', '2021-01-13 11:06:58', NULL),
	(2, 'De Yopugon', 'Admin Fonctionnel', '82229399', 'ayopougon@gmail.com', 'agents/i3eCrIFjBWUcGvIPzZDlbvgqIYpvSIsvJORSoxdl.jpeg', 'Informaticien', 4, NULL, NULL, '2020-12-10 19:43:53', '2020-12-10 19:43:53', NULL),
	(3, 'Agent simple', 'Agent 1', '36363737', 'a1@gmail.com', 'agents/xDEktGMIz1GQxmDIM58uyyUByDi2B2GeiqSPrDOe.jpeg', 'Collecteur', 4, NULL, NULL, '2020-12-10 19:49:40', '2020-12-10 19:49:40', NULL),
	(4, 'simple', 'Agent', '88393993', 'a2@gmail.com', 'agents/gWQ1AAg636LJAb82RkJ1jw5l4cjtjF4LAwxYv7Gi.jpeg', 'Coommercial', 4, NULL, NULL, '2020-12-10 19:50:48', '2020-12-10 19:50:48', NULL),
	(7, 'ABLE', 'AYEKPA', '58055334', 'ayekpad@gmail.com', 'agents/XVBRoHuYFYMIqSptpjRgflyYfTqhpa28XSNxQDo6.jpeg', 'Developpeur', 4, NULL, NULL, '2020-12-10 20:15:47', '2020-12-10 20:15:47', NULL),
	(8, 'bdjbjdd', 'AGENT', '20020202', 'aas@gmail.com', 'agents/3bbc90ngf2ZFsR7zrCNocAjz7h8eupWvUZHHgsf7.jpg', 'DEV', 5, NULL, NULL, '2021-01-13 09:58:22', '2021-01-13 09:58:22', NULL),
	(9, 'bdjbjdd', 'AGENT', '20020223', 'saas@gmail.com', 'agents/LMjClnUNylMiMvXNx4XwnQcZqnehN1lL1r2rv5Hr.jpg', 'DEV', 5, NULL, NULL, '2021-01-13 09:58:51', '2021-01-13 09:58:51', NULL),
	(10, 'DEE', 'DDD²', '94949494', 'ss@gmail.com', 'agents/cLuHRq5faYRIuHt7Y50Egm8tdwqPEVbFaG6QHQot.jpg', 'jncdjcnkjdc', 5, NULL, NULL, '2021-01-13 10:00:29', '2021-01-13 10:00:29', NULL),
	(11, 'DEE', 'DDD²', '94949414', 'sdds@gmail.com', 'agents/6zcY9sen7QzCDUSvLaHxJERE4g4t1WyUjq9ckm1d.jpg', 'jncdjcnkjdc', 5, NULL, NULL, '2021-01-13 10:01:49', '2021-01-13 10:01:49', NULL),
	(12, 'DEE', 'DDD²', '92949414', 'sdd2s@gmail.com', 'agents/9btnUSYRUX1BGNfv3GjrgqvjHF1kLr4RT0XoX1Pn.jpg', 'jncdjcnkjdc', 5, NULL, NULL, '2021-01-13 10:02:44', '2021-01-13 10:02:44', NULL);
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;

-- Listage de la structure de la table emairie. commerces
CREATE TABLE IF NOT EXISTS `commerces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administred_id` bigint(20) unsigned NOT NULL,
  `commune_id` int(11) DEFAULT NULL,
  `picture` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `raison_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quartier` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_localisation` text COLLATE utf8mb4_unicode_ci,
  `mairie_id` bigint(20) unsigned NOT NULL,
  `type_commerce_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double(10,8) DEFAULT NULL,
  `longitude` double(10,8) DEFAULT NULL,
  `register_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commerces_administred_id_index` (`administred_id`),
  KEY `commerces_mairie_id_index` (`mairie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.commerces : ~3 rows (environ)
/*!40000 ALTER TABLE `commerces` DISABLE KEYS */;
INSERT INTO `commerces` (`id`, `identifier`, `administred_id`, `commune_id`, `picture`, `raison_social`, `description`, `quartier`, `detail_localisation`, `mairie_id`, `type_commerce_id`, `status`, `latitude`, `longitude`, `register_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 1, 1, 'commerces/iy1GtLjfCHL7HW4RUxYqpGzalN3hyOVYMcYYnirv.jpg', 'Fleuve Congo', 'a Ville de Kinshasa dénombre 1.340 hôtels en raison de 1.067 hôtels homologués classés sans étoile soit 79,62 % contre 273 hôtels homologués classés avec étoiles soit 20,38 %. Ces chiffres démontrent alors qu’il y a d’énormes disparités entre les deux catégories dont l’origine peut s’expliquer par le manque d’une vision prospective de la planification et de l’aménagement urbain.', 'DIVO', 'TD', 5, 2, NULL, -11.56705030, 25.84993150, 21, '2021-01-13 23:59:39', '2021-01-13 23:59:39', NULL),
	(2, NULL, 1, 1, 'commerces/UGpPzVipYvq2NyaJwaG4eoufsDnRYpNLfEWHRgpB.jpg', 'BEATRICE HOTEL', 'La croissance démographique spectaculaire que connait la Ville de Kinshasa entraine par le fait la croissance des hôtels à travers l’espace urbain.', 'ffdf', 'hjvhv', 5, 1, NULL, -4.30013740, 15.31743430, 21, '2021-01-14 00:00:54', '2021-01-14 00:00:54', NULL),
	(3, NULL, 1, 1, 'commerces/BPIzp4mJh7v6OaW7t6JwLQgBWHXbTTXIkSi3TlNS.jpg', 'Restaurant l\'Okapi', 'La croissance démographique spectaculaire que connait la Ville de Kinshasa entraine par le fait la croissance des hôtels à travers l’espace urbain.', 'sjsjdsjd', 'hjhjb<s', 5, 2, NULL, -3.39442000, 20.18667000, 21, '2021-01-14 00:07:02', '2021-01-14 00:07:02', NULL);
/*!40000 ALTER TABLE `commerces` ENABLE KEYS */;

-- Listage de la structure de la table emairie. communes
CREATE TABLE IF NOT EXISTS `communes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `communes_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.communes : ~4 rows (environ)
/*!40000 ALTER TABLE `communes` DISABLE KEYS */;
INSERT INTO `communes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Bandalungwa', '2020-09-23 17:03:17', '2020-09-23 17:03:17', NULL),
	(2, 'Barumbu', '2020-09-23 17:03:26', '2020-09-23 17:03:26', NULL),
	(3, 'Bumbu', '2020-09-23 17:03:34', '2020-09-23 17:03:34', NULL),
	(4, 'Gombe', '2020-10-07 10:47:13', '2020-10-07 10:47:13', NULL);
/*!40000 ALTER TABLE `communes` ENABLE KEYS */;

-- Listage de la structure de la table emairie. demande_acte_naissance
CREATE TABLE IF NOT EXISTS `demande_acte_naissance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(255) DEFAULT NULL,
  `user_prenoms` varchar(255) DEFAULT NULL,
  `user_date_naissance` date DEFAULT NULL,
  `user_lieu_naissance` varchar(255) DEFAULT NULL,
  `user_pays_residence` varchar(255) DEFAULT NULL,
  `user_commune` varchar(255) DEFAULT NULL,
  `user_quartier` varchar(255) DEFAULT NULL,
  `user_adresse_postale` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_telephone` varchar(255) DEFAULT NULL,
  `titulaire_nom` varchar(255) DEFAULT NULL,
  `titulaire_prenoms` varchar(255) DEFAULT NULL,
  `titulaire_date_naissance` date DEFAULT NULL,
  `titulaire_lieu_naissance` varchar(255) DEFAULT NULL,
  `titulaire_nom_pere` varchar(255) DEFAULT NULL,
  `titulaire_nom_mere` varchar(255) DEFAULT NULL,
  `numero_acte_naissance` varchar(25) DEFAULT NULL,
  `nombre_copies` int(11) DEFAULT NULL,
  `qualite_demandeur` int(11) DEFAULT NULL,
  `motif` varchar(255) DEFAULT NULL,
  `statut` enum('BROUILLON','VALIDE','TRAITE') DEFAULT 'BROUILLON',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Listage des données de la table emairie.demande_acte_naissance : ~0 rows (environ)
/*!40000 ALTER TABLE `demande_acte_naissance` DISABLE KEYS */;
INSERT INTO `demande_acte_naissance` (`id`, `user_nom`, `user_prenoms`, `user_date_naissance`, `user_lieu_naissance`, `user_pays_residence`, `user_commune`, `user_quartier`, `user_adresse_postale`, `user_email`, `user_telephone`, `titulaire_nom`, `titulaire_prenoms`, `titulaire_date_naissance`, `titulaire_lieu_naissance`, `titulaire_nom_pere`, `titulaire_nom_mere`, `numero_acte_naissance`, `nombre_copies`, `qualite_demandeur`, `motif`, `statut`) VALUES
	(5, 'SEYDOU', 'KONE', NULL, NULL, NULL, NULL, NULL, NULL, 'krak225@gmail.com', '0101101111', 'SEYDOU', 'KONE', NULL, NULL, NULL, NULL, NULL, 1, 5, NULL, 'BROUILLON');
/*!40000 ALTER TABLE `demande_acte_naissance` ENABLE KEYS */;

-- Listage de la structure de la table emairie. demande_mairie_services
CREATE TABLE IF NOT EXISTS `demande_mairie_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mairie_id` int(11) NOT NULL,
  `administred_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `birth_certificate_number` varchar(200) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `total_price` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `register_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.demande_mairie_services : ~11 rows (environ)
/*!40000 ALTER TABLE `demande_mairie_services` DISABLE KEYS */;
INSERT INTO `demande_mairie_services` (`id`, `mairie_id`, `administred_id`, `service_id`, `status`, `birth_certificate_number`, `quantite`, `total_price`, `created_at`, `updated_at`, `deleted_at`, `register_user_id`) VALUES
	(1, 4, 1, 1, 'ATTENTE', 'ABC3245', 3, NULL, '2021-01-14 07:42:17', '2021-01-14 07:42:17', NULL, 1),
	(2, 3, 1, 1, 'ATTENTE', 'ABC3245', 1, NULL, '2021-01-14 15:05:06', '2021-01-14 15:05:06', NULL, 1),
	(3, 1, 1, 1, 'ATTENTE', 'ABC3245', 10, NULL, '2021-01-14 15:08:58', '2021-01-14 15:08:58', NULL, 1),
	(4, 2, 1, 1, 'ATTENTE', 'ABC3245', 3, NULL, '2021-01-14 15:09:30', '2021-01-14 15:09:30', NULL, 1),
	(5, 1, 1, 1, 'ATTENTE', 'ABC3245', 2, NULL, '2021-01-14 15:10:52', '2021-01-14 15:10:52', NULL, 1),
	(6, 5, 1, 1, 'TRAITEE', 'ABC3245', 4, NULL, '2021-01-14 15:12:28', '2021-01-14 19:29:00', NULL, 1),
	(7, 1, 1, 2, 'ATTENTE', 'ABC3245', 2, NULL, '2021-01-14 19:22:08', '2021-01-14 19:22:08', NULL, 21),
	(8, 6, 1, 4, 'TRAITEE', 'ABC3245', 2, NULL, '2021-02-23 06:21:09', '2021-02-23 06:49:32', NULL, 1),
	(9, 6, 1, 4, 'ATTENTE', 'ABC3245', 10, NULL, '2021-02-23 09:50:39', '2021-02-23 09:50:39', NULL, 26),
	(10, 5, 1, 99, 'ATTENTE', 'ABC3245', 100, NULL, '2021-02-23 10:27:26', '2021-02-23 10:27:26', NULL, 26),
	(11, 6, 1, 4, 'ATTENTE', 'ABC3245', 10, NULL, '2021-02-23 10:54:19', '2021-02-23 10:54:19', NULL, 26);
/*!40000 ALTER TABLE `demande_mairie_services` ENABLE KEYS */;

-- Listage de la structure de la table emairie. demande_mairie_service_histories
CREATE TABLE IF NOT EXISTS `demande_mairie_service_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demande_mairie_service_id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `register_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.demande_mairie_service_histories : ~6 rows (environ)
/*!40000 ALTER TABLE `demande_mairie_service_histories` DISABLE KEYS */;
INSERT INTO `demande_mairie_service_histories` (`id`, `demande_mairie_service_id`, `status`, `created_at`, `updated_at`, `register_user_id`) VALUES
	(1, 6, 'EN TRAITEMENT', '2021-01-14 18:00:15', '2021-01-14 18:00:15', 21),
	(2, 6, 'TRAITEE', '2021-01-14 18:32:24', '2021-01-14 18:32:24', 21),
	(3, 6, 'EN TRAITEMENT', '2021-01-14 19:27:55', '2021-01-14 19:27:55', 21),
	(4, 6, 'TRAITEE', '2021-01-14 19:29:00', '2021-01-14 19:29:00', 21),
	(5, 8, 'EN TRAITEMENT', '2021-02-23 06:22:49', '2021-02-23 06:22:49', 1),
	(6, 8, 'TRAITEE', '2021-02-23 06:49:32', '2021-02-23 06:49:32', 1);
/*!40000 ALTER TABLE `demande_mairie_service_histories` ENABLE KEYS */;

-- Listage de la structure de la table emairie. events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL,
  `resume` text,
  `description` text,
  `picture` varchar(200) DEFAULT NULL,
  `marie_id` int(11) NOT NULL,
  `source` varchar(200) DEFAULT NULL,
  `source_link` varchar(200) DEFAULT NULL,
  `number_views` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `register_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.events : ~0 rows (environ)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Listage de la structure de la table emairie. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table emairie. mairies
CREATE TABLE IF NOT EXISTS `mairies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune_id` bigint(20) unsigned NOT NULL,
  `type_organe_id` int(11) NOT NULL DEFAULT '1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mairies_commune_id_index` (`commune_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.mairies : ~5 rows (environ)
/*!40000 ALTER TABLE `mairies` DISABLE KEYS */;
INSERT INTO `mairies` (`id`, `nom`, `localisation`, `phone`, `email`, `picture`, `commune_id`, `type_organe_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'MAIRIE Bandalungwa', 'A LA GARE', '08-58-98-99', 'mairieabobo@gmail.com', 'mairies/raEFu8kr8nS0P6sb86IxYD0az2c5r9WIrFQH6KYs.jpeg', 2, 1, NULL, '2020-09-23 17:06:09', '2020-12-10 19:11:31', NULL),
	(2, 'MAIRIE Barumbu', 'QUARTIER ABC', '99-39-39-99', 'mairie1@gmail.com', 'mairies/Q1ZgVodPerXWhKXq1aldgsrBWr8shiZ99zm25bt2.jpeg', 4, 1, NULL, '2020-09-23 17:40:09', '2020-12-10 19:10:21', NULL),
	(4, 'MAIRIE DE Bumbu', 'SEL MERE', '53-55-35-36', 'mairieyopougon@gmail.com', 'mairies/ob4IcCWLQuudJofDq0XGEkFvqUXrws86MeC73axo.jpeg', 3, 1, NULL, '2020-09-23 17:42:24', '2020-12-10 19:09:01', NULL),
	(5, 'MAIRIE DE Gombe', 'SAINT JEAN', '0232232_', 'mairiecocody@gmail.com', 'mairies/8O9Qh7juynG82NAuJoExvVlVYE4LNkjyEUXEOE6V.jpg', 1, 1, NULL, '2020-12-10 19:01:04', '2021-01-30 07:58:20', NULL),
	(6, 'MINISTERE DE LA CULTURE ET DES ARTS', 'RAS', '00000000', 'culture@gmail.com', 'mairies/BnfFK185niwPuqC7MDmnQAL8hApk4D5lta6tsEFL.jpg', 2, 2, NULL, '2021-02-23 04:39:36', '2021-02-23 04:39:36', NULL);
/*!40000 ALTER TABLE `mairies` ENABLE KEYS */;

-- Listage de la structure de la table emairie. mairie_services
CREATE TABLE IF NOT EXISTS `mairie_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `mairie_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `register_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.mairie_services : ~98 rows (environ)
/*!40000 ALTER TABLE `mairie_services` DISABLE KEYS */;
INSERT INTO `mairie_services` (`id`, `service_id`, `mairie_id`, `created_at`, `updated_at`, `deleted_at`, `register_user_id`) VALUES
	(7, 1, 5, '2021-01-12 13:03:21', '2021-01-12 13:03:21', NULL, 1),
	(8, 3, 5, '2021-01-12 13:03:21', '2021-01-12 13:03:21', NULL, 1),
	(97, 4, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(98, 5, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(99, 6, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(100, 7, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(101, 8, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(102, 9, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(103, 10, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(104, 11, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(105, 12, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(106, 13, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(107, 14, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(108, 15, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(109, 16, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(110, 17, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(111, 18, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(112, 19, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(113, 20, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(114, 21, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(115, 22, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(116, 23, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(117, 24, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(118, 25, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(119, 26, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(120, 27, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(121, 28, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(122, 29, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(123, 30, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(124, 31, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(125, 32, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(126, 33, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(127, 34, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(128, 35, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(129, 36, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(130, 37, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(131, 38, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(132, 39, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(133, 40, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(134, 41, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(135, 42, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(136, 43, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(137, 44, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(138, 45, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(139, 46, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(140, 47, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(141, 48, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(142, 49, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(143, 50, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(144, 51, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(145, 52, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(146, 53, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(147, 54, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(148, 55, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(149, 56, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(150, 57, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(151, 58, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(152, 59, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(153, 60, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(154, 61, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(155, 62, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(156, 63, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(157, 64, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(158, 65, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(159, 66, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(160, 67, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(161, 68, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(162, 69, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(163, 70, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(164, 71, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(165, 72, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(166, 73, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(167, 74, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(168, 75, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(169, 76, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(170, 77, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(171, 78, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(172, 79, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(173, 80, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(174, 81, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(175, 82, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(176, 83, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(177, 84, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(178, 85, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(179, 86, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(180, 87, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(181, 88, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(182, 89, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(183, 90, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(184, 91, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(185, 92, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(186, 93, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(187, 94, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(188, 95, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(189, 96, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(190, 97, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(191, 98, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1),
	(192, 99, 6, '2021-02-23 04:51:01', '2021-02-23 04:51:01', NULL, 1);
/*!40000 ALTER TABLE `mairie_services` ENABLE KEYS */;

-- Listage de la structure de la table emairie. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.migrations : ~16 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_09_15_164140_create_administreds_table', 1),
	(5, '2020_09_15_164158_create_mairies_table', 1),
	(6, '2020_09_15_164218_create_communes_table', 1),
	(7, '2020_09_15_164228_create_typecommerces_table', 1),
	(8, '2020_09_15_164416_create_commerces_table', 1),
	(9, '2020_09_15_164424_create_agents_table', 1),
	(10, '2020_09_15_164456_create_roles_table', 1),
	(11, '2020_09_15_164603_create_permissions_table', 1),
	(12, '2020_09_21_151933_create_role_permission_table', 1),
	(13, '2020_09_22_133845_create_user_permission_table', 1),
	(14, '2020_10_05_134633_create_themes_table', 2),
	(15, '2020_10_05_161339_create_theme_mairies_table', 3),
	(16, '2020_10_07_164511_create_mode_paiements_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table emairie. min
CREATE TABLE IF NOT EXISTS `min` (
  `name` text,
  `generateur` text,
  `taux` text,
  `periode` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.min : ~116 rows (environ)
/*!40000 ALTER TABLE `min` DISABLE KEYS */;
INSERT INTO `min` (`name`, `generateur`, `taux`, `periode`) VALUES
	('Taxe  d’agrément pour association culturelle, artistique et artisanale :  troupe théâtrale ou des majorettes. ', 'Demande d’agrément   ', '150', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale :  troupe folklorique    ', 'Demande d’agrément   ', '100', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : centre culturel, salon littéraire, etc… ', 'Demande d’agrément   ', '50', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : groupe de danse moderne   ', 'Demande d’agrément   ', '50', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : orchestre  ', 'Demande d’agrément   ', '150', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : cercle ou club culturel  ', 'Demande d’agrément   ', '150', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : groupe chorégraphique ou chorale   ', 'Demande d’agrément   ', '150', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale :  centre de formation en arts et métiers ', 'Demande d’agrément   ', '100', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : maison de production, d’animation, de diffusion ou production culturelle ', 'Demande d’agrément   ', '100', 'non renouvelable '),
	('Taxe  d’agrément pour association culturelle, artistique et artisanale : bureau d’études ou de création artistique   ', 'Demande d’agrément   ', '100', 'non renouvelable '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle :   artiste ', 'Demande d’autorisation ', '50/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle :  élection miss ', 'Demande d’autorisation ', '50/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : carnaval ', 'Demande d’autorisation ', '500/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : kermesse ', 'Demande d’autorisation ', '150/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle :  défilé de mode ', 'Demande d’autorisation ', '100/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : campagne d’évangélisation ', 'Demande d’autorisation ', '100/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : dépôt de calicot ou banderole ', 'Demande d’autorisation ', '25/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : concert des orchestres musicaux modernes ou promotion culturelle : - orchestre national ', 'Demande d’autorisation ', '100/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : orchestre local ', 'Demande d’autorisation ', '50/jour ', 'ponctuelle '),
	('Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : théâtre local ', 'Demande d’autorisation ', '50/jour ', 'ponctuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau routier sur Boulevard du 30 juin-Lumumba-Triomphal-Sendwe ', 'Demande d’autorisation ', '2,5/m2/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  panneau routier sur les autres artères ', 'Demande d’autorisation ', '1,5m2/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau mural ', 'Demande d’autorisation ', '5/m2/mois ', 'mensuelle '),
	(' Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau trivision ', 'Demande d’autorisation ', '3/m2/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  panneau déroulant ', 'Demande d’autorisation ', '4/m2/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau sucette ', 'Demande d’autorisation ', '20/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: totem ', 'Demande d’autorisation ', '30/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  panneau indicateur ', 'Demande d’autorisation ', '20/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 1 à 5 m2 -  1 face ', 'Demande d’autorisation ', '30/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 1 à 5 m2 - 2 face ', 'Demande d’autorisation ', '50/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 6 à 10  m2 - 1 face ', 'Demande d’autorisation ', '40/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne lumineuse de 1 à 5 m2 - 2 face ', 'Demande d’autorisation ', '70/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 10 m2  ', 'Demande d’autorisation ', '3,5/m2/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non lumineuse de 1 à 5 m2 - 1 face ', 'Demande d’autorisation ', '20/mois ', 'mensuelle '),
	(' Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non  lumineuse de 1 à 5 m2 - 2 face ', 'Demande d’autorisation ', '30/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non lumineuse de 6 à 10 m2 - 1 face ', 'Demande d’autorisation ', '30/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne non lumineuse de 6 à 10 m2 - 2 face ', 'Demande d’autorisation ', '50/mois ', 'mensuelle '),
	(' Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non  lumineuse de 10  m2  ', 'Demande d’autorisation ', '3/m2/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: écran géant de la publicité ', 'Demande d’autorisation ', '25/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité engin roulant peint  sur les cotés ', 'Demande d’autorisation ', '35/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité engin roulant peint entièrement ', 'Demande d’autorisation ', '100/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité par panneau tracté ', 'Demande d’autorisation ', '15/mois ', 'journalier '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: carnaval motorisé ', 'Demande d’autorisation ', '500/mois ', 'ponctuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: banderole ', 'Demande d’autorisation ', '25/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: articles distribués gratuitement T-shirt, Képi  ', 'Demande d’autorisation ', '10% de la facture  ', 'ponctuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: autocollant ', 'Demande d’autorisation ', '0,05/u ', 'ponctuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité sur autorisation ', 'Demande d’autorisation ', '10% de la facture  ', 'ponctuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: signes graphiques   ', 'Demande d’autorisation ', '25/mois ', 'mensuelle '),
	('Taxe de dépôt des affiches et des panneaux dans les lieux publics: peinture murale   ', 'Demande d’autorisation ', '5/m2/mois ', 'mensuelle '),
	('Taxe de vente :  des services et biens artistiques ', 'Demande d’autorisation ', '100', 'ponctuelle '),
	('Taxe de vente :  des objets d’arts et artisanat   ', 'Demande d’autorisation ', '100', 'ponctuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison d’édition  des livres et des disques ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :maison de couture : ', 'Demande d’autorisation de production ou d’exécution ', '0 à  4 machines 20 :-- Plus de 4 machines 50 :- Haute couture   100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison  de  diversement  public ', 'Demande d’autorisation de production ou d’exécution ', 'terrasse ordinaire    50:- terrasse VIP 100: - bar 100:- dancing bar  350:- lounge bar, night-club ', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : parc d’attraction   ', 'Demande d’autorisation de production ou d’exécution ', '200', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  salle de fêtes  ou des spectacles   ', 'Demande d’autorisation de production ou d’exécution ', '350', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  salle de fêtes ou des spectacles VIP   ', 'Demande d’autorisation de production ou d’exécution ', '350', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : salle polyvalente (fête, conférence, exposition dépouille mortelle) ', 'Demande d’autorisation de production ou d’exécution ', '150', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : autres lieux de fêtes ou des spectacles   ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : fabrique de fournitures de bureau      ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : fabrique artisanale de mobilier :   ', 'Demande d’autorisation de production ou d’exécution ', 'En bois 70: - En fer 100 :-En aluminium 150', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : ferronnerie artisanale (atelier métallique et ajustage)   ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  maroquinerie et cordonnerie :   ', 'Demande d’autorisation de production ou d’exécution ', 'Artisanale 50 :- Moderne 150  ', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : boutique de produits artisanaux   ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : imprimerie :   ', 'Demande d’autorisation de production ou d’exécution ', 'Artisanale 50 :- Moderne 150  ', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  briqueterie  artisanale   ', 'Demande d’autorisation de production ou d’exécution ', '50', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : ciné :   Filmothèque', 'Demande d’autorisation de production ou d’exécution ', '30', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : ciné :   vidéothèque    ', 'Demande d’autorisation de production ou d’exécution ', '30', 'ponctuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : bijouterie', 'Demande d’autorisation de production ou d’exécution ', ' Fabrication et/ou vente 100 :- Réparation des bijoux 30', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  studio photos   ', 'Demande d’autorisation de production ou d’exécution ', 'développement de photo (labo) 100 :- développement de photo (Imprimante) 80', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de décoration :   ', 'Demande d’autorisation de production ou d’exécution ', ' fabrication et/ou vente des articles de décoration (lustres, vitres,  carreaux…)   100 :-fabrication et/*ou vente de peinture 200 :- exposition et/ou vente des meubles 100 :- vente des mèches   150 :- peinture auto   150', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de coiffure  de défrisage, tressage, tissage et postiche ', 'Demande d’autorisation de production ou d’exécution ', 'ordinaire 50 :- de luxe (VIP) 100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :galerie d’arts   ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : comptoir de vente d’objets  d’art   ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : librairie,  procure  et  papeterie ', 'Demande d’autorisation de production ou d’exécution ', '150', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : fabrique des dents artificielles  (prothèses)   ', 'Demande d’autorisation de production ou d’exécution ', '50', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de pressage  de  disques   ', 'Demande d’autorisation de production ou d’exécution ', '30', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : centre culturel   ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : bibliothèque privée ', 'Demande d’autorisation de production ou d’exécution ', '50', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de soins traditionnels ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : atelier artistique    ', 'Demande d’autorisation de production ou d’exécution ', 'sérigraphie et gravure 150 :- fabrique et/ou vente de cercueils, services funéraires 100 : - carreaux et/ou peinture artisanale    100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : musée privé ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :laboratoire photos ', 'Demande d’autorisation de production ou d’exécution ', '100', 'annuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  par artiste ', 'Demande d’autorisation ', '150', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire par une agence en publicité et/ou une agence conseil en publicité et autres ', 'Demande d’autorisation ', '200', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  par imprimerie ', 'Demande d’autorisation ', '250', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  par une bureautique ', 'Demande d’autorisation ', '100', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  par un atelier de fabrication des supports publicitaires ', 'Demande d’autorisation ', '150', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  par une entreprise industrielle de fabrication textile et de fourniture de bureau ', 'Demande d’autorisation ', '300', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  œuvre publicitaire réalisée à l’étranger ', 'Demande d’autorisation ', '350', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  marque décorative et inscription promotionnelle sur un objet et autres supports ', 'Demande d’autorisation ', '10% de la mise ', 'ponctuelle et/ou mensuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  jeu concours promotionnel et tombola ', 'Demande d’autorisation ', '10% de la mise ', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  impression à caractère publicitaire sur un support quelconque (billet, titre de voyage, pagne et autres) ', 'Demande d’autorisation ', '10% de la mise ', 'ponctuelle '),
	(NULL, 'Demande d’autorisation ', NULL, 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  papier à en-tête, ballon ou baudruches gonflables ', 'Demande d’autorisation ', '10% de la mise ', 'ponctuelle '),
	('Taxe  sur la réalisation d’une œuvre publicitaire  publicité sur appareils cellulaires ', 'Demande d’autorisation ', '10% de la mise ', 'ponctuelle '),
	('Frais  de carte d’abonnement à une bibliothèque publique de la ville ', 'Demande d’abonnement ', '0,5', 'annuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : cirque ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : défilé de mode ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : élection miss ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : show  ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : concert   ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : théâtre   ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : concours de beauté ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : foire ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : carnaval ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : festival ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : kermesse ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : fancy-fair ', 'Paiement des droits d’entrée ', '10%', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : jeu concours promotionnel et tombola ', 'Paiement des droits d’entrée ', '10% de la mise ', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : autres manifestations analogues ', 'Paiement des droits d’entrée ', '10% de la mise ', 'ponctuelle '),
	('Quotité du Trésor provincial sur les droits d’entrée dans une manifestation culturelle à caractère provincial ou local : prestations des maisons de loterie (Sonal et autres) ', 'Paiement des droits d’entrée ', '10%', 'mensuelle '),
	('Quotité sur la vente des billets d’accès aux manifestations culturelles dans les installations sportives de la ville  ', 'Vente de billets ', '5% des recettes brutes ', 'ponctuelle '),
	(NULL, NULL, NULL, ' '),
	('Taxe sur l’autorisation pour organisation des spectacles et autres manifestations à caractère promotionnel ', 'Demande d’autorisation ', 'Carnaval promotionnel 500/jr :- Action promotionnelle 150/Jr :- Exposition vente  75/jr :- Sensibilisation 50/jr :- Vente libre  15/jr :- Jeux concours promotionnel et tombola 200/jr :- Peinture murale 5/m2', 'ponctuelle '),
	('Taxe sur l’autorisation pour organisation des spectacles et autres manifestations à caractère social et religieux : ', 'Demande d’autorisation ', 'Campagne d’évangélisation, réjouissante, conférence symposium, forum, mariage, collation de grade, dans le parking des hôtels, stade et espace de plus de 500 places…., 100/jr :Campagne d’évangélisation, réjouissance, conférence, symposium, forum, mariage, collation de grade, dans le parking des hôtels, stade et espace de moins de 500 places….  50/jr :- Baptême et anniversaire 20', 'ponctuelle ');
/*!40000 ALTER TABLE `min` ENABLE KEYS */;

-- Listage de la structure de la table emairie. mode_paiements
CREATE TABLE IF NOT EXISTS `mode_paiements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.mode_paiements : ~4 rows (environ)
/*!40000 ALTER TABLE `mode_paiements` DISABLE KEYS */;
INSERT INTO `mode_paiements` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'MOBILE MONEY', NULL, NULL, NULL),
	(2, 'CHEQUE', NULL, NULL, NULL),
	(3, 'CASH', NULL, NULL, NULL),
	(4, 'PORTEFEUILLE VIRTUEL', NULL, NULL, NULL);
/*!40000 ALTER TABLE `mode_paiements` ENABLE KEYS */;

-- Listage de la structure de la table emairie. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table emairie. permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.permissions : ~26 rows (environ)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `comment`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Listing Paramètres', 'Liste des paramètres', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(2, 'Listing Roles', 'Liste des rôles', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(3, 'Listing Agents', 'Liste des agents', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(4, 'Listing Mairies', 'Liste des mairies', '0', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(5, 'Listing Administrés', 'Liste des administrés', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(6, 'Listing Commerces', 'Liste des administrés', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(7, 'Ajouter,Modifier Permission', 'Ajouter, modifier une permission', '0', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(8, 'Supprimer Permission', ' supprimer une permission', '0', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(9, 'Permissions Assign', 'Attribuer une permission à un rôle', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(10, 'Delegate Permission', 'Déléguer une permission à un agent', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(11, 'Ajouter, Modifier Roles ', 'Ajouter, modifier un rôle ', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(12, 'Supprimer Roles ', ' supprimer un rôle ', '1', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(13, 'Listing paiements', 'Methode paiement', '0', '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(14, 'Listing Zones', 'Liste des zone', '1', '2020-12-07 08:31:27', '2020-12-07 08:31:27', NULL),
	(15, 'Ajouter Zone', 'Ajouter une zone', '1', '2020-12-07 08:31:53', '2020-12-07 08:31:53', NULL),
	(16, 'Modifier, Supprimer Zone', 'Modifier, Supprimer Zone', '1', '2020-12-07 08:32:31', '2020-12-07 08:32:31', NULL),
	(17, 'Affecter Zone', 'Affecter un commerce ou un agent à une zone', '1', '2020-12-07 08:33:06', '2020-12-07 08:33:06', NULL),
	(18, 'Listing Type de taxe', 'Liste des types de taxe', '1', '2020-12-07 08:33:42', '2020-12-07 08:33:42', NULL),
	(19, 'Ajouter, Modifier,Supprimer type de taxe', 'Ajouter, Modifier,Supprimer type de taxe', '1', '2020-12-07 08:34:04', '2020-12-07 08:34:04', NULL),
	(21, 'Ajouter, Modifier, Supprimer taxes forfaits', 'Ajouter, Modifier, Supprimer taxes forfaits', '1', '2020-12-07 08:35:50', '2020-12-07 08:35:50', NULL),
	(22, 'Listing Type Taxe Forfait', 'Listing Type Taxe Forfait', '1', '2020-12-07 09:46:20', '2020-12-07 09:46:20', NULL),
	(23, 'Ajouter,Modifier,Supprimer Type Taxe Forfait', 'Ajouter,Modifier,Supprimer Type Taxe Forfait', '1', '2020-12-07 09:46:45', '2020-12-07 09:46:45', NULL),
	(24, 'Changer fortfait taxe commerce', 'Changer fortfait taxe commerce', '1', '2020-12-08 21:22:04', '2020-12-08 21:22:04', NULL),
	(25, 'Tableau de bord des taxes', 'Tableau de bord des taxes', '1', '2020-12-09 08:43:01', '2020-12-09 08:43:01', NULL),
	(26, 'Listing Taxe  Mois', 'Listing Taxe  Mois', '1', '2020-12-09 08:43:59', '2020-12-09 08:43:59', NULL),
	(27, 'Generer Taxe Mois', 'Generer Taxe Mois', '1', '2020-12-09 08:44:40', '2020-12-09 08:44:40', NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table emairie. qualites
CREATE TABLE IF NOT EXISTS `qualites` (
  `qualite_id` int(11) NOT NULL AUTO_INCREMENT,
  `qualite_libelle` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`qualite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table emairie.qualites : ~4 rows (environ)
/*!40000 ALTER TABLE `qualites` DISABLE KEYS */;
INSERT INTO `qualites` (`qualite_id`, `qualite_libelle`, `deleted_at`) VALUES
	(1, 'Le titulaire', NULL),
	(2, 'Le père', NULL),
	(3, 'La mère', NULL),
	(4, 'Le fils/ La fille', NULL),
	(5, 'Le conjoint/ la conjointe', NULL);
/*!40000 ALTER TABLE `qualites` ENABLE KEYS */;

-- Listage de la structure de la table emairie. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `mairie_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.roles : ~5 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `comment`, `mairie_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Administrateur Système', 'Administrateur système', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(2, 'Administrateur Fonctionnel', 'Administrateur de la mairie', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(3, 'Agent Percepteur', 'Agent percepteur pour la collecte des taxes', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(4, 'Agent', 'Agent de la mairie', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(5, 'Administred', 'Administrés', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table emairie. role_permission
CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.role_permission : ~46 rows (environ)
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
INSERT INTO `role_permission` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, NULL),
	(1, 2, NULL, NULL),
	(1, 3, NULL, NULL),
	(1, 4, NULL, NULL),
	(1, 5, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 6, NULL, NULL),
	(1, 7, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 8, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 9, NULL, NULL),
	(1, 10, NULL, NULL),
	(1, 11, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 12, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 13, NULL, NULL),
	(1, 14, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 15, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 16, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 17, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 18, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 19, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 21, '2020-12-07 08:45:16', '2020-12-07 08:45:16'),
	(1, 22, '2020-12-07 09:56:34', '2020-12-07 09:56:34'),
	(1, 23, '2020-12-07 09:56:34', '2020-12-07 09:56:34'),
	(1, 24, '2020-12-08 21:22:40', '2020-12-08 21:22:40'),
	(1, 25, '2020-12-09 09:37:24', '2020-12-09 09:37:24'),
	(1, 26, '2020-12-09 09:37:24', '2020-12-09 09:37:24'),
	(1, 27, '2020-12-09 09:37:24', '2020-12-09 09:37:24'),
	(2, 1, NULL, NULL),
	(2, 2, NULL, NULL),
	(2, 3, NULL, NULL),
	(2, 5, NULL, NULL),
	(2, 6, NULL, NULL),
	(2, 9, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 10, NULL, NULL),
	(2, 13, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 14, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 15, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 16, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 17, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 18, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 19, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 21, '2020-12-07 08:52:43', '2020-12-07 08:52:43'),
	(2, 24, '2020-12-09 13:04:21', '2020-12-09 13:04:21'),
	(2, 25, '2020-12-09 09:54:39', '2020-12-09 09:54:39'),
	(2, 26, '2020-12-09 09:37:54', '2020-12-09 09:37:54'),
	(2, 27, '2020-12-09 09:37:54', '2020-12-09 09:37:54'),
	(4, 6, NULL, NULL);
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;

-- Listage de la structure de la table emairie. services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `fait_generateur` varchar(200) DEFAULT NULL,
  `taux` text,
  `periode_paiement` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `price` varchar(20) DEFAULT '250',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.services : ~99 rows (environ)
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` (`id`, `name`, `picture`, `fait_generateur`, `taux`, `periode_paiement`, `type`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'EXTRAIT DE NAISSANCE', NULL, NULL, NULL, NULL, 'MAIRIE', '500', '2021-01-11 18:20:46', '2021-01-11 18:20:46', NULL),
	(2, 'DEMANDE DE MARIAGE', NULL, NULL, NULL, NULL, 'MAIRIE', '500', '2021-01-11 18:21:01', '2021-01-11 18:21:01', NULL),
	(3, 'ATTESTATION DE BONNE CONDUITE', 'services/LkjVpkomOPrxVAPcf2cGof0tY4jX3rkAOIMvLxAl.jpg', NULL, NULL, NULL, 'MAIRIE', '1000', '2021-01-11 18:29:18', '2021-01-11 18:29:18', NULL),
	(4, 'Droits de délivrance du document de recensement annuel   : carte d’artisan,  d’écrivain, etc. ', NULL, 'Délivrance de document   ', '10', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(5, 'Droits de délivrance du document de recensement annuel   : certificat de recensement d’une association culturelle  ', NULL, 'Délivrance de document   ', '20', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(6, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : association culturelle, artistique et artisanale. ', NULL, 'Demande d’agrément   ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(7, 'Taxe  d’agrément pour association culturelle, artistique et artisanale :  troupe théâtrale ou des majorettes. ', NULL, 'Demande d’agrément   ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(8, 'Taxe  d’agrément pour association culturelle, artistique et artisanale :  troupe folklorique    ', NULL, 'Demande d’agrément   ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(9, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : centre culturel, salon littéraire, etc… ', NULL, 'Demande d’agrément   ', '50', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(10, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : groupe de danse moderne   ', NULL, 'Demande d’agrément   ', '50', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(11, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : orchestre  ', NULL, 'Demande d’agrément   ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(12, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : cercle ou club culturel  ', NULL, 'Demande d’agrément   ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(13, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : groupe chorégraphique ou chorale   ', NULL, 'Demande d’agrément   ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(14, 'Taxe  d’agrément pour association culturelle, artistique et artisanale :  centre de formation en arts et métiers ', NULL, 'Demande d’agrément   ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(15, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : maison de production, d’animation, de diffusion ou production culturelle ', NULL, 'Demande d’agrément   ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(16, 'Taxe  d’agrément pour association culturelle, artistique et artisanale : bureau d’études ou de création artistique   ', NULL, 'Demande d’agrément   ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(17, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle :   artiste ', NULL, 'Demande d’autorisation ', '50/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(18, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle :  élection miss ', NULL, 'Demande d’autorisation ', '50/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(19, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : carnaval ', NULL, 'Demande d’autorisation ', '500/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(20, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : kermesse ', NULL, 'Demande d’autorisation ', '150/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(21, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle :  défilé de mode ', NULL, 'Demande d’autorisation ', '100/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(22, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : campagne d’évangélisation ', NULL, 'Demande d’autorisation ', '100/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(23, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : dépôt de calicot ou banderole ', NULL, 'Demande d’autorisation ', '25/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(24, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : concert des orchestres musicaux modernes ou promotion culturelle : - orchestre national ', NULL, 'Demande d’autorisation ', '100/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(25, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : orchestre local ', NULL, 'Demande d’autorisation ', '50/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(26, 'Taxe  sur autorisation d’organiser une exposition des œuvres d’art ou une manifestation  culturelle : théâtre local ', NULL, 'Demande d’autorisation ', '50/jour ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(27, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau routier sur Boulevard du 30 juin-Lumumba-Triomphal-Sendwe ', NULL, 'Demande d’autorisation ', '2,5/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(28, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  panneau routier sur les autres artères ', NULL, 'Demande d’autorisation ', '1,5m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(29, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau mural ', NULL, 'Demande d’autorisation ', '5/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(30, ' Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau trivision ', NULL, 'Demande d’autorisation ', '3/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(31, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  panneau déroulant ', NULL, 'Demande d’autorisation ', '4/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(32, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: panneau sucette ', NULL, 'Demande d’autorisation ', '20/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(33, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: totem ', NULL, 'Demande d’autorisation ', '30/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(34, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  panneau indicateur ', NULL, 'Demande d’autorisation ', '20/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(35, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 1 à 5 m2 -  1 face ', NULL, 'Demande d’autorisation ', '30/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(36, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 1 à 5 m2 - 2 face ', NULL, 'Demande d’autorisation ', '50/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(37, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 6 à 10  m2 - 1 face ', NULL, 'Demande d’autorisation ', '40/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(38, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne lumineuse de 1 à 5 m2 - 2 face ', NULL, 'Demande d’autorisation ', '70/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(39, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne lumineuse de 10 m2  ', NULL, 'Demande d’autorisation ', '3,5/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(40, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non lumineuse de 1 à 5 m2 - 1 face ', NULL, 'Demande d’autorisation ', '20/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(41, ' Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non  lumineuse de 1 à 5 m2 - 2 face ', NULL, 'Demande d’autorisation ', '30/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(42, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non lumineuse de 6 à 10 m2 - 1 face ', NULL, 'Demande d’autorisation ', '30/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(43, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics:  enseigne non lumineuse de 6 à 10 m2 - 2 face ', NULL, 'Demande d’autorisation ', '50/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(44, ' Taxe de dépôt des affiches et des panneaux dans les lieux publics: enseigne non  lumineuse de 10  m2  ', NULL, 'Demande d’autorisation ', '3/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(45, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: écran géant de la publicité ', NULL, 'Demande d’autorisation ', '25/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(46, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité engin roulant peint  sur les cotés ', NULL, 'Demande d’autorisation ', '35/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(47, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité engin roulant peint entièrement ', NULL, 'Demande d’autorisation ', '100/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(48, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité par panneau tracté ', NULL, 'Demande d’autorisation ', '15/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(49, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: carnaval motorisé ', NULL, 'Demande d’autorisation ', '500/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(50, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: banderole ', NULL, 'Demande d’autorisation ', '25/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(51, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: articles distribués gratuitement T-shirt, Képi  ', NULL, 'Demande d’autorisation ', '10% de la facture  ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(52, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: autocollant ', NULL, 'Demande d’autorisation ', '0,05/u ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(53, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: publicité sur autorisation ', NULL, 'Demande d’autorisation ', '10% de la facture  ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(54, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: signes graphiques   ', NULL, 'Demande d’autorisation ', '25/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(55, 'Taxe de dépôt des affiches et des panneaux dans les lieux publics: peinture murale   ', NULL, 'Demande d’autorisation ', '5/m2/mois ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(56, 'Taxe de vente :  des services et biens artistiques ', NULL, 'Demande d’autorisation ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(57, 'Taxe de vente :  des objets d’arts et artisanat   ', NULL, 'Demande d’autorisation ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(58, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison d’édition  des livres et des disques ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(59, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :maison de couture : ', NULL, 'Demande d’autorisation de production ou d’exécution ', '0 à  4 machines 20 :-- Plus de 4 machines 50 :- Haute couture   100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(60, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison  de  diversement  public ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'terrasse ordinaire    50:- terrasse VIP 100: - bar 100:- dancing bar  350:- lounge bar, night-club ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(61, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : parc d’attraction   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '200', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(62, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  salle de fêtes  ou des spectacles   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '350', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(63, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  salle de fêtes ou des spectacles VIP   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '350', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(64, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : salle polyvalente (fête, conférence, exposition dépouille mortelle) ', NULL, 'Demande d’autorisation de production ou d’exécution ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(65, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : autres lieux de fêtes ou des spectacles   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(66, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : fabrique de fournitures de bureau      ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(67, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : fabrique artisanale de mobilier :   ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'En bois 70: - En fer 100 :-En aluminium 150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(68, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : ferronnerie artisanale (atelier métallique et ajustage)   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(69, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  maroquinerie et cordonnerie :   ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'Artisanale 50 :- Moderne 150  ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(70, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : boutique de produits artisanaux   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(71, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : imprimerie :   ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'Artisanale 50 :- Moderne 150  ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(72, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  briqueterie  artisanale   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '50', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(73, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : ciné :   Filmothèque', NULL, 'Demande d’autorisation de production ou d’exécution ', '30', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(74, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : ciné :   vidéothèque    ', NULL, 'Demande d’autorisation de production ou d’exécution ', '30', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(75, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : bijouterie', NULL, 'Demande d’autorisation de production ou d’exécution ', ' Fabrication et/ou vente 100 :- Réparation des bijoux 30', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(76, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :  studio photos   ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'développement de photo (labo) 100 :- développement de photo (Imprimante) 80', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(77, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de décoration :   ', NULL, 'Demande d’autorisation de production ou d’exécution ', ' fabrication et/ou vente des articles de décoration (lustres, vitres,  carreaux…)   100 :-fabrication et/*ou vente de peinture 200 :- exposition et/ou vente des meubles 100 :- vente des mèches   150 :- peinture auto   150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(78, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de coiffure  de défrisage, tressage, tissage et postiche ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'ordinaire 50 :- de luxe (VIP) 100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(79, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :galerie d’arts   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(80, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : comptoir de vente d’objets  d’art   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(81, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : librairie,  procure  et  papeterie ', NULL, 'Demande d’autorisation de production ou d’exécution ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(82, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : fabrique des dents artificielles  (prothèses)   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '50', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(83, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de pressage  de  disques   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '30', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(84, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : centre culturel   ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(85, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : bibliothèque privée ', NULL, 'Demande d’autorisation de production ou d’exécution ', '50', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(86, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : maison de soins traditionnels ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(87, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : atelier artistique    ', NULL, 'Demande d’autorisation de production ou d’exécution ', 'sérigraphie et gravure 150 :- fabrique et/ou vente de cercueils, services funéraires 100 : - carreaux et/ou peinture artisanale    100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(88, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  : musée privé ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(89, 'Taxe de production ou d’exécution d’œuvres d’arts et culturelles anonymes  :laboratoire photos ', NULL, 'Demande d’autorisation de production ou d’exécution ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(90, 'Taxe  sur la réalisation d’une œuvre publicitaire  par artiste ', NULL, 'Demande d’autorisation ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(91, 'Taxe  sur la réalisation d’une œuvre publicitaire par une agence en publicité et/ou une agence conseil en publicité et autres ', NULL, 'Demande d’autorisation ', '200', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(92, 'Taxe  sur la réalisation d’une œuvre publicitaire  par imprimerie ', NULL, 'Demande d’autorisation ', '250', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(93, 'Taxe  sur la réalisation d’une œuvre publicitaire  par une bureautique ', NULL, 'Demande d’autorisation ', '100', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(94, 'Taxe  sur la réalisation d’une œuvre publicitaire  par un atelier de fabrication des supports publicitaires ', NULL, 'Demande d’autorisation ', '150', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(95, 'Taxe  sur la réalisation d’une œuvre publicitaire  par une entreprise industrielle de fabrication textile et de fourniture de bureau ', NULL, 'Demande d’autorisation ', '300', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(96, 'Taxe  sur la réalisation d’une œuvre publicitaire  œuvre publicitaire réalisée à l’étranger ', NULL, 'Demande d’autorisation ', '350', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(97, 'Taxe  sur la réalisation d’une œuvre publicitaire  marque décorative et inscription promotionnelle sur un objet et autres supports ', NULL, 'Demande d’autorisation ', '10% de la mise ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(98, 'Taxe  sur la réalisation d’une œuvre publicitaire  jeu concours promotionnel et tombola ', NULL, 'Demande d’autorisation ', '10% de la mise ', '', 'MINISTERE', '25', NULL, NULL, NULL),
	(99, 'Taxe  sur la réalisation d’une œuvre publicitaire  impression à caractère publicitaire sur un support quelconque (billet, titre de voyage, pagne et autres) ', NULL, 'Demande d’autorisation ', '10% de la mise ', '', 'MINISTERE', '25', NULL, NULL, NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Listage de la structure de la table emairie. taxeforfait_commerce_selecteds
CREATE TABLE IF NOT EXISTS `taxeforfait_commerce_selecteds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typetaxeforfait_id` int(11) NOT NULL COMMENT 'l''identifiant de la table type forfait, pour indexer la forfait choisie pour ce commerce',
  `commerce_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `register_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Relation entre le forfait de la taxe selectionné pour ce com';

-- Listage des données de la table emairie.taxeforfait_commerce_selecteds : ~0 rows (environ)
/*!40000 ALTER TABLE `taxeforfait_commerce_selecteds` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxeforfait_commerce_selecteds` ENABLE KEYS */;

-- Listage de la structure de la table emairie. taxes
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(20) NOT NULL,
  `type_taxe_id` int(11) NOT NULL,
  `commerce_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `type_paiment_id` int(11) NOT NULL,
  `paided_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.taxes : ~0 rows (environ)
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;

-- Listage de la structure de la table emairie. taxe_commerce_paideds
CREATE TABLE IF NOT EXISTS `taxe_commerce_paideds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxecommerce_id` int(11) NOT NULL COMMENT 'l''identifiant de la relation type forfait et le commerce',
  `payed_user_id` int(11) DEFAULT NULL,
  `amount_prev` double(10,2) DEFAULT NULL,
  `amount_paided` double(10,2) DEFAULT NULL,
  `month` varchar(20) NOT NULL,
  `date_paided` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Table pour enregistrer les montant pevu et payé des taxes , elle puisse sur l''identifiant de la taxe choisie par le commerce';

-- Listage des données de la table emairie.taxe_commerce_paideds : ~4 rows (environ)
/*!40000 ALTER TABLE `taxe_commerce_paideds` DISABLE KEYS */;
INSERT INTO `taxe_commerce_paideds` (`id`, `taxecommerce_id`, `payed_user_id`, `amount_prev`, `amount_paided`, `month`, `date_paided`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, NULL, 30000.00, NULL, '04-2020', NULL, '2020-12-09 11:53:01', '2020-12-09 11:53:01', NULL),
	(2, 1, NULL, 30000.00, NULL, '06-2019', NULL, '2020-12-09 11:53:10', '2020-12-09 11:53:10', NULL),
	(3, 1, NULL, 30000.00, NULL, '12-2020', NULL, '2020-12-10 00:10:16', '2020-12-10 00:10:16', NULL),
	(4, 2, NULL, 30000.00, NULL, '12-2020', NULL, '2020-12-10 00:10:16', '2020-12-10 00:10:16', NULL);
/*!40000 ALTER TABLE `taxe_commerce_paideds` ENABLE KEYS */;

-- Listage de la structure de la table emairie. taxe_months
CREATE TABLE IF NOT EXISTS `taxe_months` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(20) NOT NULL,
  `year` int(4) NOT NULL,
  `mairie_id` int(11) NOT NULL,
  `register_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.taxe_months : ~0 rows (environ)
/*!40000 ALTER TABLE `taxe_months` DISABLE KEYS */;
INSERT INTO `taxe_months` (`id`, `month`, `year`, `mairie_id`, `register_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '01-2020', 2020, 5, 21, '2021-01-14 19:38:09', '2021-01-14 19:38:09', NULL);
/*!40000 ALTER TABLE `taxe_months` ENABLE KEYS */;

-- Listage de la structure de la table emairie. themes
CREATE TABLE IF NOT EXISTS `themes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.themes : ~19 rows (environ)
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'amber', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(2, 'black', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(3, 'blue', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(4, 'blue-grey', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(5, 'brown', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(6, 'cyan', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(7, 'deep-orange', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(8, 'deep-purple', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(9, 'green', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(10, 'grey', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(11, 'indigo', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(12, 'light-blue', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(13, 'lime', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(14, 'orange', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(15, 'pink', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(16, 'purple', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(17, 'red', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(18, 'teal', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL),
	(19, 'yellow', NULL, '2020-10-06 14:50:17', '2020-10-06 14:50:17', NULL);
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;

-- Listage de la structure de la table emairie. theme_mairies
CREATE TABLE IF NOT EXISTS `theme_mairies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mairie_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.theme_mairies : ~0 rows (environ)
/*!40000 ALTER TABLE `theme_mairies` DISABLE KEYS */;
INSERT INTO `theme_mairies` (`id`, `theme`, `mairie_id`, `created_at`, `updated_at`) VALUES
	(53, 'brown', 0, '2020-10-06 18:18:22', '2020-10-06 18:18:22');
/*!40000 ALTER TABLE `theme_mairies` ENABLE KEYS */;

-- Listage de la structure de la table emairie. transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double(10,2) NOT NULL,
  `payed_for` varchar(200) NOT NULL,
  `administred_id` int(11) NOT NULL,
  `payed_user_id` int(11) NOT NULL,
  `payed_date` datetime NOT NULL,
  `type_transaction` varchar(20) NOT NULL,
  `plateform` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.transactions : ~0 rows (environ)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Listage de la structure de la table emairie. typecommerces
CREATE TABLE IF NOT EXISTS `typecommerces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.typecommerces : ~2 rows (environ)
/*!40000 ALTER TABLE `typecommerces` DISABLE KEYS */;
INSERT INTO `typecommerces` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Petit', NULL, NULL, NULL),
	(2, 'Grand', NULL, NULL, NULL);
/*!40000 ALTER TABLE `typecommerces` ENABLE KEYS */;

-- Listage de la structure de la table emairie. type_actualites
CREATE TABLE IF NOT EXISTS `type_actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.type_actualites : ~3 rows (environ)
/*!40000 ALTER TABLE `type_actualites` DISABLE KEYS */;
INSERT INTO `type_actualites` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'COMMUNIQUE', '2021-01-11 18:08:34', '2021-01-11 18:08:34', NULL),
	(2, 'ACTUALITE', '2021-01-11 18:10:54', '2021-01-11 18:10:54', NULL),
	(3, 'PRESSE', '2021-01-11 18:11:01', '2021-01-11 18:11:01', NULL);
/*!40000 ALTER TABLE `type_actualites` ENABLE KEYS */;

-- Listage de la structure de la table emairie. type_organes
CREATE TABLE IF NOT EXISTS `type_organes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.type_organes : ~2 rows (environ)
/*!40000 ALTER TABLE `type_organes` DISABLE KEYS */;
INSERT INTO `type_organes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Mairie', NULL, NULL, NULL),
	(2, 'Ministère', NULL, NULL, NULL);
/*!40000 ALTER TABLE `type_organes` ENABLE KEYS */;

-- Listage de la structure de la table emairie. type_taxes
CREATE TABLE IF NOT EXISTS `type_taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.type_taxes : ~3 rows (environ)
/*!40000 ALTER TABLE `type_taxes` DISABLE KEYS */;
INSERT INTO `type_taxes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Impot', '2020-12-07 08:24:25', '2020-12-07 08:24:25', NULL),
	(2, 'Taxe communale', '2020-12-07 08:24:36', '2020-12-07 08:25:30', NULL),
	(3, 'Vignette', '2020-12-07 08:25:10', '2020-12-07 08:25:10', NULL);
/*!40000 ALTER TABLE `type_taxes` ENABLE KEYS */;

-- Listage de la structure de la table emairie. type_taxe_forfaits
CREATE TABLE IF NOT EXISTS `type_taxe_forfaits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double(10,2) NOT NULL,
  `type_taxe_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.type_taxe_forfaits : ~0 rows (environ)
/*!40000 ALTER TABLE `type_taxe_forfaits` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_taxe_forfaits` ENABLE KEYS */;

-- Listage de la structure de la table emairie. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administred_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.users : ~7 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `administred_id`, `agent_id`, `email_verified_at`, `role_id`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'mylogin@gmail.com', NULL, NULL, NULL, NULL, 1, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', '3S4jZqazMOIrG8fAoSw5RzRNC0ndXdRMBvOlCvnVOxUVOjaUH3xCG9aNd4Ca', '2020-09-23 15:25:47', '2020-09-29 18:46:41', NULL),
	(21, 'Admin Fonctionnel Admin Fonctionnel', 'acocody@gmail.com', NULL, NULL, '1', NULL, 2, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'voIGXILlSkfOQOLuS8ZhEASAQLchdLX6TnC047U7zZ8VzRkM7LVeHuGqAuga', '2020-12-10 19:39:51', '2020-12-10 19:39:51', NULL),
	(22, 'Admin Fonctionnel Admin Fonctionnel', 'ayopougon@gmail.com', NULL, NULL, '2', NULL, 2, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'Z475JY485NTXJKTOkmzpemdxFCZEgWxPPUruAnXmOy9vmIHJbxABS5fd1Jxs', '2020-12-10 19:43:53', '2020-12-10 19:43:53', NULL),
	(23, 'Agent 1 Agent 1', 'a1@gmail.com', NULL, NULL, '3', NULL, 3, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', NULL, '2020-12-10 19:49:40', '2020-12-10 19:49:40', NULL),
	(24, 'Agent Agent', 'a2@gmail.com', NULL, NULL, '4', NULL, 4, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', NULL, '2020-12-10 19:50:48', '2020-12-10 19:50:48', NULL),
	(26, 'AYEKPA AYEKPA', 'ayekpad@gmail.com', NULL, '1', '', NULL, 5, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', 'Uj9wv60lKUF2bnCHfvGZOHwZG3VwZs4GTMAKCPJEAnGEbMUMJhOLDLcB1R3y', '2020-12-10 20:15:48', '2020-12-10 20:15:48', NULL),
	(27, 'DDD² DDD²', 'sdd2s@gmail.com', '92949414', NULL, '12', NULL, 4, '$2y$10$fZhXFwI.ut.FPElsY9Fk1eItums4OvPFpD.AqAqTD43x8ZPZQAmG2', NULL, '2021-01-13 10:02:45', '2021-01-13 10:02:45', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table emairie. user_permission
CREATE TABLE IF NOT EXISTS `user_permission` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table emairie.user_permission : ~2 rows (environ)
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` (`user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
	(17, 5, NULL, NULL),
	(17, 6, '2020-10-06 18:12:50', '2020-10-06 18:12:50');
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;

-- Listage de la structure de la table emairie. virtual_accounts
CREATE TABLE IF NOT EXISTS `virtual_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double(10,2) DEFAULT NULL,
  `administred_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.virtual_accounts : ~6 rows (environ)
/*!40000 ALTER TABLE `virtual_accounts` DISABLE KEYS */;
INSERT INTO `virtual_accounts` (`id`, `amount`, `administred_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 50000.00, 20, NULL, '2020-12-01 21:41:18', '2020-12-01 21:41:18', NULL),
	(2, 50000.00, 21, NULL, '2020-12-01 23:09:16', '2020-12-01 23:09:16', NULL),
	(3, 50000.00, 22, NULL, '2020-12-02 08:45:49', '2020-12-02 08:45:49', NULL),
	(4, 50000.00, 23, NULL, '2020-12-02 08:48:32', '2020-12-02 08:48:32', NULL),
	(5, 50000.00, 24, NULL, '2020-12-02 08:52:04', '2020-12-02 08:52:04', NULL),
	(6, 50000.00, 25, NULL, '2020-12-04 20:21:32', '2020-12-04 20:21:32', NULL);
/*!40000 ALTER TABLE `virtual_accounts` ENABLE KEYS */;

-- Listage de la structure de la table emairie. zones
CREATE TABLE IF NOT EXISTS `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `latitude` double(10,8) DEFAULT NULL,
  `mairie_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.zones : ~0 rows (environ)
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` (`id`, `name`, `latitude`, `mairie_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'DDKDKD', NULL, 5, '2021-01-13 10:03:30', '2021-01-13 10:03:30', NULL);
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;

-- Listage de la structure de la table emairie. zone_commerces
CREATE TABLE IF NOT EXISTS `zone_commerces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `commerce_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table emairie.zone_commerces : ~0 rows (environ)
/*!40000 ALTER TABLE `zone_commerces` DISABLE KEYS */;
/*!40000 ALTER TABLE `zone_commerces` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
