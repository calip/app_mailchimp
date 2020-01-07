-- --------------------------------------------------------
--
-- Table structure for table `app_mailchimp_categories`
--

CREATE TABLE IF NOT EXISTS `app_mailchimp_categories` (
  `cid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `guid` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'untitled',
  `virtual_filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_available` datetime DEFAULT NULL,
  `date_expiry` datetime DEFAULT NULL,
  `sort_order` int(3) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `version` decimal(20,2) NOT NULL DEFAULT '1.00',
  `pageview` bigint(20) NOT NULL DEFAULT '0',
  `items_per_page` int(11) unsigned NOT NULL DEFAULT '10',
  `created_by_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `modified_by_id` bigint(20) unsigned DEFAULT NULL,
  `locked_by_id` bigint(20) DEFAULT NULL,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `summary` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `permission_write` text COLLATE utf8_unicode_ci,
  `permission_read` text COLLATE utf8_unicode_ci,
  `options` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,

  PRIMARY KEY (`cid`),
  KEY `date_created` (`date_created`),
  KEY `date_modified` (`date_modified`),
  KEY `sort_order` (`sort_order`),
  KEY `status` (`status`),
  KEY `created_by_id` (`created_by_id`),
  KEY `modified_by_id` (`modified_by_id`),
  UNIQUE KEY `guid` (`guid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_mailchimp_items`
--

CREATE TABLE IF NOT EXISTS `app_mailchimp_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `guid` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'untitled',
  `virtual_filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'untitled',
  `summary` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `date_available` datetime DEFAULT NULL,
  `date_expiry` datetime DEFAULT NULL,
  `created_by_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `modified_by_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `locked_by_id` bigint(20) DEFAULT NULL,
  `permission_write` text COLLATE utf8_unicode_ci,
  `permission_read` text COLLATE utf8_unicode_ci,
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `pageview` bigint(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `version` decimal(20,2) NOT NULL DEFAULT '1.00',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `options` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,

  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `title` (`title`),
  KEY `id_category_id` (`id`,`category_id`),
  KEY `id_category_id_status` (`id`,`category_id`,`status`),
  KEY `id_category_id_status_sort_order` (`id`,`category_id`,`status`,`sort_order`),
  KEY `virtual_filename` (`virtual_filename`),
  KEY `date_created` (`date_created`),
  KEY `date_modified` (`date_modified`),
  KEY `created_by_id` (`created_by_id`),
  KEY `modified_by_id` (`modified_by_id`),
  KEY `status` (`status`),
  KEY `sort_order` (`sort_order`),
  UNIQUE KEY `guid` (`guid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
