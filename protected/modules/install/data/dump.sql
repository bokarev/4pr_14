
--
-- Structure for table `ActionLog`
--

DROP TABLE IF EXISTS `ActionLog`;
CREATE TABLE `ActionLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `event` tinyint(255) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `model_title` text NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `event` (`event`),
  KEY `datetime` (`datetime`),
  KEY `model_name` (`model_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
 ('Admin', '1', NULL, NULL);



--
-- Structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
 ('Admin', '2', NULL, NULL, 'N;'),
 ('Authenticated', '2', NULL, NULL, 'N;'),
 ('Guest', '2', NULL, NULL, 'N;');



--
-- Structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
CREATE TABLE `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `class_name` varchar(100) NOT NULL,
  `object_pk` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `class_name_index` (`class_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `Discount`
--

DROP TABLE IF EXISTS `Discount`;
CREATE TABLE `Discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `sum` varchar(10) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `DiscountCategory`
--

DROP TABLE IF EXISTS `DiscountCategory`;
CREATE TABLE `DiscountCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;


--
-- Structure for table `DiscountManufacturer`
--

DROP TABLE IF EXISTS `DiscountManufacturer`;
CREATE TABLE `DiscountManufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discount_id` (`discount_id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


--
-- Structure for table `Order`
--

DROP TABLE IF EXISTS `Order`;
CREATE TABLE `Order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `secret_key` varchar(10) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `delivery_price` float(10,2) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `status_id` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL COMMENT 'delivery address',
  `user_phone` varchar(30) NOT NULL,
  `user_comment` varchar(500) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `secret_key` (`secret_key`),
  KEY `delivery_id` (`delivery_id`),
  KEY `status_id` (`status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `OrderProduct`
--

DROP TABLE IF EXISTS `OrderProduct`;
CREATE TABLE `OrderProduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `configurable_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `configurable_name` text NOT NULL COMMENT 'Store name of configurable product',
  `configurable_data` text NOT NULL,
  `variants` text NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `configurable_id` (`configurable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;


--
-- Structure for table `OrderStatus`
--

DROP TABLE IF EXISTS `OrderStatus`;
CREATE TABLE `OrderStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `position` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


--
-- Data for table `OrderStatus`
--

INSERT INTO `OrderStatus` (`id`, `name`, `position`) VALUES
 ('1', 'Новый', '0'),
 ('2', 'Доставлен', '1'),
 ('3', 'Отменен', '2');



--
-- Structure for table `Page`
--

DROP TABLE IF EXISTS `Page`;
CREATE TABLE `Page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `publish_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `layout` varchar(2555) NOT NULL,
  `view` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  KEY `url` (`url`),
  KEY `created` (`created`),
  KEY `updated` (`updated`),
  KEY `publish_date` (`publish_date`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;


--
-- Data for table `Page`
--

INSERT INTO `Page` (`id`, `user_id`, `category_id`, `url`, `created`, `updated`, `publish_date`, `status`, `layout`, `view`) VALUES
 ('8', '1', NULL, 'help', '2012-06-10 22:35:51', '2012-07-07 11:47:09', '2012-06-10 22:35:29', 'published', '', ''),
 ('9', '1', NULL, 'how-to-create-order', '2012-06-10 22:36:50', '2012-07-07 11:45:53', '2012-06-10 22:36:27', 'published', '', ''),
 ('10', '1', NULL, 'garantiya', '2012-06-10 22:37:06', '2012-07-07 11:45:38', '2012-06-10 22:36:50', 'published', '', ''),
 ('11', '1', NULL, 'dostavka-i-oplata', '2012-06-10 22:37:18', '2012-07-07 11:41:49', '2012-06-10 22:37:07', 'published', '', ''),
 ('12', '1', '7', 'samsung-pitaetsya-izbezhat-zapreta-na-galaxy-nexus-v-shtatah-pri-pomoshi-patcha', '2012-07-07 12:08:50', '2012-07-07 12:09:33', '2012-07-07 12:06:19', 'published', '', ''),
 ('13', '1', '7', 'za-85-mesyacev-android-40-popal-na-11-ustroistv', '2012-07-07 12:19:44', '2012-07-07 12:33:48', '2012-07-07 12:14:48', 'published', '', ''),
 ('14', '1', '7', 'google-prezentoval-svoi-ochki-dopolnennoi-realnosti', '2012-07-07 12:26:11', '2012-07-07 12:26:11', '2012-07-07 12:25:48', 'published', '', '');



--
-- Structure for table `PageCategory`
--

DROP TABLE IF EXISTS `PageCategory`;
CREATE TABLE `PageCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `full_url` text NOT NULL,
  `layout` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `page_size` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `url` (`url`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


--
-- Data for table `PageCategory`
--

INSERT INTO `PageCategory` (`id`, `parent_id`, `url`, `full_url`, `layout`, `view`, `created`, `updated`, `page_size`) VALUES
 ('7', NULL, 'news', 'news', '', '', '2012-07-07 12:06:03', '2012-07-07 12:06:03', NULL);



--
-- Structure for table `PageCategoryTranslate`
--

DROP TABLE IF EXISTS `PageCategoryTranslate`;
CREATE TABLE `PageCategoryTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;


--
-- Data for table `PageCategoryTranslate`
--

INSERT INTO `PageCategoryTranslate` (`id`, `object_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
 ('13', '7', '1', 'Новости', '', '', '', ''),
 ('14', '7', '9', 'Новости', '', '', '', '');



--
-- Structure for table `PageTranslate`
--

DROP TABLE IF EXISTS `PageTranslate`;
CREATE TABLE `PageTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text,
  `full_description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;


--
-- Data for table `PageTranslate`
--

INSERT INTO `PageTranslate` (`id`, `object_id`, `language_id`, `title`, `short_description`, `full_description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
 ('22', '11', '9', 'Доставка и оплата', '', '', '', '', ''),
 ('15', '8', '1', 'Помощь', 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).', '', '', '', ''),
 ('16', '8', '9', 'Помощь', '', '', '', '', ''),
 ('17', '9', '1', 'Как сделать заказ', '<p>Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или \"невозможных\" слов.</p>', '', '', '', ''),
 ('18', '9', '9', 'Как сделать заказ', '', '', '', '', ''),
 ('19', '10', '1', 'Гарантия', '<p>Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, \"consectetur\", и занялся его поисками в классической латинской литературе.</p>\r\n<p>В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги \"de Finibus Bonorum et Malorum\" (\"О пределах добра и зла\"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", происходит от одной из строк в разделе 1.10.32 Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 \"de Finibus Bonorum et Malorum\" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.</p>', '', '', '', ''),
 ('20', '10', '9', 'Гарантия', '', '', '', '', ''),
 ('21', '11', '1', 'Доставка и оплата', '<p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>', '', '', '', ''),
 ('23', '12', '1', 'Samsung пытается избежать запрета на Galaxy Nexus', 'Текущую ситуацию с судебным противостоянием Apple и Samsung в Штатах (ссылка по теме) можно описать строчкой их двух слов: всё плохо. ', 'В смысле всё плохо для Samsung — южнокорейская корпорация так и не сумела отбиться от назначенного судом предварительного запрета на американские продажи планшетников Galaxy Tab 10.1 и, главное, новейших смартфонов Galaxy Nexus. Расклад намечается хуже некуда: по некоторым выкладкам, потенциальный ущерб от подобного запрета может достигнуть 180 млн. долларов, две трети из которых придутся на непроданные Galaxy Nexus.', '', '', ''),
 ('25', '13', '1', 'За 8,5 месяцев Android 4.0 попал на 11% устройств', 'В свое время платформа Android 2.x распространялась активнее, чем Android 4.0 Ice Cream Sandwich, а ведь уже появилась новая мобильная ОС от Google — Android 4.1 Jelly Bean. За 8,5 месяцев своего существования Android ICS попал на 10,9% устройств, а лидировать на рынке продолжает Android 2,3 Gingerbread.', '', '', '', ''),
 ('24', '12', '9', 'Samsung пытается избежать запрета на Galaxy Nexus в Штатах при помощи патча', 'Текущую ситуацию с судебным противостоянием Apple и Samsung в Штатах (ссылка по теме) можно описать строчкой их двух слов: всё плохо. В смысле всё плохо для Samsung — южнокорейская корпорация так и не сумела отбиться от назначенного судом предварительного запрета на американские продажи планшетников Galaxy Tab 10.1 и, главное, новейших смартфонов Galaxy Nexus. Расклад намечается хуже некуда: по некоторым выкладкам, потенциальный ущерб от подобного запрета может достигнуть 180 млн. долларов, две трети из которых придутся на непроданные Galaxy Nexus.', '', '', '', ''),
 ('26', '13', '9', 'За 8,5 месяцев Android 4.0 попал на 11% устройств', 'В свое время платформа Android 2.x распространялась активнее, чем Android 4.0 Ice Cream Sandwich, а ведь уже появилась новая мобильная ОС от Google — Android 4.1 Jelly Bean. За 8,5 месяцев своего существования Android ICS попал на 10,9% устройств, а лидировать на рынке продолжает Android 2,3 Gingerbread.', '', '', '', ''),
 ('27', '14', '1', 'Google презентовал свои очки дополненной реальности‎', 'Компания Google приступит к продаже очков дополненной реальности, который разрабатываются в рамках проекта Google Project Glass, пишет блог All Things Digital. ', 'Очки будут стоить 1,5 тысячи долларов, и поставки стартуют в начале 2013 года. Устройство, однако, будет предназначено только для разработчиков. Оформить предварительный заказ на него смогут исключительно посетители конференции I/O, открывшейся 27 июня в Сан-Франциско. ', '', '', ''),
 ('28', '14', '9', 'Google презентовал свои очки дополненной реальности‎', 'Компания Google приступит к продаже очков дополненной реальности, который разрабатываются в рамках проекта Google Project Glass, пишет блог All Things Digital. ', 'Очки будут стоить 1,5 тысячи долларов, и поставки стартуют в начале 2013 года. Устройство, однако, будет предназначено только для разработчиков. Оформить предварительный заказ на него смогут исключительно посетители конференции I/O, открывшейся 27 июня в Сан-Франциско. ', '', '', '');



--
-- Structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
CREATE TABLE `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreAttribute`
--

DROP TABLE IF EXISTS `StoreAttribute`;
CREATE TABLE `StoreAttribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `display_on_front` tinyint(1) NOT NULL DEFAULT '1',
  `use_in_filter` tinyint(1) NOT NULL,
  `use_in_variants` tinyint(1) NOT NULL,
  `use_in_compare` tinyint(1) NOT NULL DEFAULT '0',
  `select_many` tinyint(1) NOT NULL,
  `position` int(11) DEFAULT '0',
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `use_in_filter` (`use_in_filter`),
  KEY `display_on_front` (`display_on_front`),
  KEY `position` (`position`),
  KEY `use_in_variants` (`use_in_variants`),
  KEY `use_in_compare` (`use_in_compare`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreAttributeOption`
--

DROP TABLE IF EXISTS `StoreAttributeOption`;
CREATE TABLE `StoreAttributeOption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `position` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreAttributeOptionTranslate`
--

DROP TABLE IF EXISTS `StoreAttributeOptionTranslate`;
CREATE TABLE `StoreAttributeOptionTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`),
  KEY `object_id` (`object_id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreAttributeTranslate`
--

DROP TABLE IF EXISTS `StoreAttributeTranslate`;
CREATE TABLE `StoreAttributeTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreCategory`
--

DROP TABLE IF EXISTS `StoreCategory`;
CREATE TABLE `StoreCategory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `full_path` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`),
  KEY `url` (`url`),
  KEY `full_path` (`full_path`)
) ENGINE=MyISAM AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;


--
-- Data for table `StoreCategory`
--

INSERT INTO `StoreCategory` (`id`, `lft`, `rgt`, `level`, `url`, `full_path`, `layout`, `view`, `description`) VALUES
 ('1', '1', '10', '1', 'root', '', '', '', NULL);



--
-- Structure for table `StoreCategoryTranslate`
--

DROP TABLE IF EXISTS `StoreCategoryTranslate`;
CREATE TABLE `StoreCategoryTranslate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;


--
-- Data for table `StoreCategoryTranslate`
--

INSERT INTO `StoreCategoryTranslate` (`id`, `object_id`, `language_id`, `name`, `meta_title`, `meta_keywords`, `meta_description`, `description`) VALUES
 ('1', '1', '1', 'root', '', '', '', NULL);



--
-- Structure for table `StoreCurrency`
--

DROP TABLE IF EXISTS `StoreCurrency`;
CREATE TABLE `StoreCurrency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `iso` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `rate` float(10,3) NOT NULL,
  `main` tinyint(1) DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


--
-- Data for table `StoreCurrency`
--

INSERT INTO `StoreCurrency` (`id`, `name`, `iso`, `symbol`, `rate`, `main`, `default`) VALUES
 ('1', 'Доллары', 'USD', '$', '1.000', '1', '1'),
 ('2', 'Рубли', 'RUR', 'руб.', '32.520', '0', '0');



--
-- Structure for table `StoreDeliveryMethod`
--

DROP TABLE IF EXISTS `StoreDeliveryMethod`;
CREATE TABLE `StoreDeliveryMethod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `free_from` float(10,2) NOT NULL DEFAULT '0.00',
  `position` smallint(6) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


--
-- Data for table `StoreDeliveryMethod`
--

INSERT INTO `StoreDeliveryMethod` (`id`, `price`, `free_from`, `position`, `active`) VALUES
 ('14', '10.00', '0.00', '0', '1'),
 ('15', '0.00', '0.00', '1', '1'),
 ('16', '30.00', '0.00', '2', '1');



--
-- Structure for table `StoreDeliveryMethodTranslate`
--

DROP TABLE IF EXISTS `StoreDeliveryMethodTranslate`;
CREATE TABLE `StoreDeliveryMethodTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


--
-- Data for table `StoreDeliveryMethodTranslate`
--

INSERT INTO `StoreDeliveryMethodTranslate` (`id`, `object_id`, `language_id`, `name`, `description`) VALUES
 ('1', '14', '1', 'Курьером', ''),
 ('2', '14', '9', 'English', 'english description'),
 ('3', '15', '1', 'Самовывоз', ''),
 ('4', '15', '9', 'Самовывоз', ''),
 ('5', '16', '1', 'Адресная доставка по стране', ''),
 ('6', '16', '9', 'Адресная доставка по стране', '');



--
-- Structure for table `StoreDeliveryPayment`
--

DROP TABLE IF EXISTS `StoreDeliveryPayment`;
CREATE TABLE `StoreDeliveryPayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COMMENT='Saves relations between delivery and payment methods ';


--
-- Data for table `StoreDeliveryPayment`
--

INSERT INTO `StoreDeliveryPayment` (`id`, `delivery_id`, `payment_id`) VALUES
 ('24', '12', '14'),
 ('23', '10', '16'),
 ('22', '10', '13'),
 ('21', '10', '14'),
 ('34', '11', '16'),
 ('33', '11', '13'),
 ('25', '12', '15'),
 ('26', '12', '16'),
 ('62', '14', '19'),
 ('61', '14', '20'),
 ('60', '14', '18'),
 ('59', '14', '17'),
 ('53', '15', '18'),
 ('54', '15', '20'),
 ('55', '16', '17'),
 ('56', '16', '18'),
 ('57', '16', '20'),
 ('58', '16', '19'),
 ('63', '14', '21');



--
-- Structure for table `StoreManufacturer`
--

DROP TABLE IF EXISTS `StoreManufacturer`;
CREATE TABLE `StoreManufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `layout` varchar(255) NOT NULL,
  `view` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreManufacturerTranslate`
--

DROP TABLE IF EXISTS `StoreManufacturerTranslate`;
CREATE TABLE `StoreManufacturerTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


--
-- Structure for table `StorePaymentMethod`
--

DROP TABLE IF EXISTS `StorePaymentMethod`;
CREATE TABLE `StorePaymentMethod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `payment_system` varchar(100) NOT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `currency_id` (`currency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;


--
-- Data for table `StorePaymentMethod`
--

INSERT INTO `StorePaymentMethod` (`id`, `currency_id`, `active`, `payment_system`, `position`) VALUES
 ('17', '1', '1', 'webmoney', '0'),
 ('18', '2', '1', '', '2'),
 ('19', '1', '1', 'robokassa', '1'),
 ('20', '2', '1', '', '3'),
 ('21', '2', '1', 'qiwi', '4');



--
-- Structure for table `StorePaymentMethodTranslate`
--

DROP TABLE IF EXISTS `StorePaymentMethodTranslate`;
CREATE TABLE `StorePaymentMethodTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


--
-- Data for table `StorePaymentMethodTranslate`
--

INSERT INTO `StorePaymentMethodTranslate` (`id`, `object_id`, `language_id`, `name`, `description`) VALUES
 ('1', '17', '1', 'WebMoney', 'WebMoney — это универсальное средство для расчетов в Сети, целая среда финансовых взаимоотношений, которой сегодня пользуются миллионы людей по всему миру.'),
 ('2', '17', '9', 'English payment1', 'russian description'),
 ('3', '18', '1', 'Наличная', 'Наличная оплата осуществляется только в рублях при доставке товара курьером покупателю.'),
 ('7', '20', '1', 'Безналичная', ' Стоимость товара при безналичной оплате без ПДВ равна розничной цене товара + 2% '),
 ('8', '20', '9', 'Безналичная', ''),
 ('4', '18', '9', 'Наличка', '<p>ыла оылдао ылдао ылдоа ылдва<br />ыаол ывла оывалд ыова</p>'),
 ('5', '19', '1', 'Robokassa', 'Многими пользователями электронные платежные системы расцениваются в качестве наиболее удобного средства оплаты товаров и услуг в Интернете.'),
 ('6', '19', '9', 'Robokassa', '<p>Description goes here</p>'),
 ('9', '21', '1', 'Qiwi', 'Оплата с помощью Qiwi'),
 ('10', '21', '9', 'Qiwi', 'Оплата с помощью Qiwi');



--
-- Structure for table `StoreProduct`
--

DROP TABLE IF EXISTS `StoreProduct`;
CREATE TABLE `StoreProduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `use_configurations` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `max_price` float(10,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL,
  `layout` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `availability` tinyint(2) NOT NULL DEFAULT '1',
  `auto_decrease_quantity` tinyint(2) NOT NULL DEFAULT '1',
  `views_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `added_to_cart_count` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  KEY `type_id` (`type_id`),
  KEY `price` (`price`),
  KEY `max_price` (`max_price`),
  KEY `is_active` (`is_active`),
  KEY `sku` (`sku`),
  KEY `created` (`created`),
  KEY `updated` (`updated`),
  KEY `added_to_cart_count` (`added_to_cart_count`),
  KEY `views_count` (`views_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductAttributeEAV`
--

DROP TABLE IF EXISTS `StoreProductAttributeEAV`;
CREATE TABLE `StoreProductAttributeEAV` (
  `entity` int(11) unsigned NOT NULL,
  `attribute` varchar(250) NOT NULL,
  `value` text NOT NULL,
  KEY `ikEntity` (`entity`),
  KEY `attribute` (`attribute`),
  KEY `value` (`value`(50))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductCategoryRef`
--

DROP TABLE IF EXISTS `StoreProductCategoryRef`;
CREATE TABLE `StoreProductCategoryRef` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `product` (`product`),
  KEY `is_main` (`is_main`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductConfigurableAttributes`
--

DROP TABLE IF EXISTS `StoreProductConfigurableAttributes`;
CREATE TABLE `StoreProductConfigurableAttributes` (
  `product_id` int(11) NOT NULL COMMENT 'Attributes available to configure product',
  `attribute_id` int(11) NOT NULL,
  UNIQUE KEY `product_attribute_index` (`product_id`,`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductConfigurations`
--

DROP TABLE IF EXISTS `StoreProductConfigurations`;
CREATE TABLE `StoreProductConfigurations` (
  `product_id` int(11) NOT NULL COMMENT 'Saves relations beetwen product and configurations',
  `configurable_id` int(11) NOT NULL,
  UNIQUE KEY `idsunique` (`product_id`,`configurable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductImage`
--

DROP TABLE IF EXISTS `StoreProductImage`;
CREATE TABLE `StoreProductImage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT '0',
  `uploaded_by` int(11) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductTranslate`
--

DROP TABLE IF EXISTS `StoreProductTranslate`;
CREATE TABLE `StoreProductTranslate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text,
  `full_description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `language_id` (`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreProductType`
--

DROP TABLE IF EXISTS `StoreProductType`;
CREATE TABLE `StoreProductType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `categories_preset` text NOT NULL,
  `main_category` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


--
-- Data for table `StoreProductType`
--

INSERT INTO `StoreProductType` (`id`, `name`, `categories_preset`, `main_category`) VALUES
 ('1', 'Простой продукт', '', '0');



--
-- Structure for table `StoreProductVariant`
--

DROP TABLE IF EXISTS `StoreProductVariant`;
CREATE TABLE `StoreProductVariant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  `price_type` tinyint(1) NOT NULL,
  `sku` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `option_id` (`option_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreRelatedProduct`
--

DROP TABLE IF EXISTS `StoreRelatedProduct`;
CREATE TABLE `StoreRelatedProduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Handle related products';


--
-- Structure for table `StoreTypeAttribute`
--

DROP TABLE IF EXISTS `StoreTypeAttribute`;
CREATE TABLE `StoreTypeAttribute` (
  `type_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`type_id`,`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreWishlist`
--

DROP TABLE IF EXISTS `StoreWishlist`;
CREATE TABLE `StoreWishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `StoreWishlistProducts`
--

DROP TABLE IF EXISTS `StoreWishlistProducts`;
CREATE TABLE `StoreWishlistProducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wishlist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlist_id` (`wishlist_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


--
-- Structure for table `SystemLanguage`
--

DROP TABLE IF EXISTS `SystemLanguage`;
CREATE TABLE `SystemLanguage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(25) NOT NULL,
  `locale` varchar(100) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `flag_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;


--
-- Data for table `SystemLanguage`
--

INSERT INTO `SystemLanguage` (`id`, `name`, `code`, `locale`, `default`, `flag_name`) VALUES
 ('1', 'Русский', 'ru', 'ru', '1', 'ru.png'),
 ('9', 'English', 'en', 'en', '0', 'us.png');



--
-- Structure for table `SystemModules`
--

DROP TABLE IF EXISTS `SystemModules`;
CREATE TABLE `SystemModules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;


--
-- Data for table `SystemModules`
--

INSERT INTO `SystemModules` (`id`, `name`, `enabled`) VALUES
 ('7', 'users', '1'),
 ('9', 'pages', '1'),
 ('11', 'core', '1'),
 ('12', 'rights', '1'),
 ('16', 'orders', '1'),
 ('15', 'store', '1'),
 ('17', 'comments', '1'),
 ('37', 'feedback', '1'),
 ('38', 'discounts', '1'),
 ('39', 'newsletter', '1'),
 ('40', 'csv', '1'),
 ('41', 'logger', '1'),
 ('52', 'accounting1c', '1'),
 ('53', 'yandexMarket', '1'),
 ('54', 'notifier', '1'),
 ('55', 'statistics', '1');



--
-- Structure for table `SystemSettings`
--

DROP TABLE IF EXISTS `SystemSettings`;
CREATE TABLE `SystemSettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;


--
-- Data for table `SystemSettings`
--

INSERT INTO `SystemSettings` (`id`, `category`, `key`, `value`) VALUES
 ('9', 'feedback', 'max_message_length', '1000'),
 ('8', 'feedback', 'enable_captcha', '1'),
 ('7', 'feedback', 'admin_email', 'admin@localhost.local'),
 ('10', '17_WebMoneyPaymentSystem', 'LMI_PAYEE_PURSE', 'Z1234565788'),
 ('11', '17_WebMoneyPaymentSystem', 'LMI_SECRET_KEY', 'theSercretPassword'),
 ('12', '18_WebMoneyPaymentSystem', 'LMI_PAYEE_PURSE', '1'),
 ('13', '18_WebMoneyPaymentSystem', 'LMI_SECRET_KEY', '2'),
 ('14', '19_RobokassaPaymentSystem', 'login', 'login'),
 ('15', '19_RobokassaPaymentSystem', 'password1', 'password1value'),
 ('16', '19_RobokassaPaymentSystem', 'password2', 'password2value'),
 ('22', 'accounting1c', 'password', 'f880fefe2aff8130bb31d480f08e47c03e655b60'),
 ('21', 'accounting1c', 'ip', '127.0.0.1'),
 ('23', 'accounting1c', 'tempdir', 'application.runtime'),
 ('24', 'yandexMarket', 'name', 'Демо магазин'),
 ('25', 'yandexMarket', 'company', 'Демо кампания'),
 ('26', 'yandexMarket', 'url', 'http://demo-company.loc/'),
 ('27', 'yandexMarket', 'currency_id', '2'),
 ('28', 'core', 'siteName', 'Eximus Commerce'),
 ('29', 'core', 'productsPerPage', '12,18,24'),
 ('30', 'core', 'productsPerPageAdmin', '20'),
 ('31', 'core', 'theme', 'default'),
 ('32', '20_QiwiPaymentSystem', 'shop_id', ''),
 ('33', '20_QiwiPaymentSystem', 'password', ''),
 ('34', '21_QiwiPaymentSystem', 'shop_id', '211182'),
 ('35', '21_QiwiPaymentSystem', 'password', 'xsi100500'),
 ('36', 'core', 'editorTheme', 'compant'),
 ('37', 'core', 'editorHeight', '300'),
 ('38', 'core', 'editorAutoload', '0');



--
-- Structure for table `accounting1c`
--

DROP TABLE IF EXISTS `accounting1c`;
CREATE TABLE `accounting1c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) DEFAULT NULL,
  `object_type` int(11) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_type` (`object_type`),
  KEY `external_id` (`external_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `grid_view_filter`
--

DROP TABLE IF EXISTS `grid_view_filter`;
CREATE TABLE `grid_view_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `grid_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


--
-- Data for table `notifications`
--

INSERT INTO `notifications` (`id`, `product_id`, `email`) VALUES
 ('1', '11', 'firstrow@gmail.com');



--
-- Structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
 ('m000000_000000_base', '1361214193'),
 ('m130218_190341_add_description_to_store_category', '1361214373'),
 ('m130218_190818_add_description_to_store_category_translate', '1361214547');



--
-- Structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `recovery_key` varchar(20) NOT NULL,
  `recovery_password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='Saves user accounts';


--
-- Data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `created_at`, `last_login`, `login_ip`, `recovery_key`, `recovery_password`) VALUES
 ('1', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@localhost.loc', '2011-08-21 10:17:15', '2013-04-07 13:57:05', '127.0.0.1', 'PXKMUEHFNK', '01A2QOPJE1KIYRP');



--
-- Structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


--
-- Data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `full_name`, `phone`, `delivery_address`) VALUES
 ('1', '1', 'Administrator', '000-000-00-00', 'where to delivery');


