CREATE TABLE IF NOT EXISTS `#__backup_backups` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL,
`created` DATETIME NOT NULL DEFAULT now(),
`bucket_key` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__backup_settings` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT
`checked_out` INT(11)  NOT NULL,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`cloud_service` TINYINT(1) NOT NULL DEFAULT '0',
`cloud_key` VARCHAR(255) NOT NULL,
`cloud_secret` VARCHAR(255) NOT NULL,
`local_secret` VARCHAR(255) NOT NULL,
`last_run` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;
