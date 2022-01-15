CREATE TABLE IF NOT EXISTS `#__stations_destinations`
(
    `id`
    bigint
    NOT
    NULL
    AUTO_INCREMENT,
    `name`
    varchar
(
    255
) NOT NULL DEFAULT '',
    `alias` varchar
(
    300
) NOT NULL DEFAULT '',
    `address` varchar
(
    200
) NOT NULL,
    `zipcode` varchar
(
    50
) NOT NULL,
    `town` varchar
(
    250
) NOT NULL,
    `www` varchar
(
    100
) NOT NULL,
    `livestream` varchar
(
    100
) NOT NULL,
    `catid` int
(
    11
) NOT NULL DEFAULT 0,
    `frn_id` int
(
    5
) NOT NULL,
    `mhz` varchar
(
    30
) NOT NULL,
    `lat` varchar
(
    200
) NOT NULL,
    `long` varchar
(
    200
) NOT NULL,
    `published` tinyint
(
    1
) NOT NULL DEFAULT 0,
    `checked_out` int unsigned NOT NULL DEFAULT 0,
    `checked_out_time` datetime,
    `txt` text NOT NULL,
    `picture` varchar
(
    255
) NOT NULL DEFAULT '',
    `assign_routeplanning` tinyint
(
    1
) NOT NULL DEFAULT 1,
    `ordering` int NOT NULL DEFAULT 0,
    `created_by` int unsigned NOT NULL DEFAULT 0,
    `access` int unsigned NOT NULL DEFAULT 1,
    `country` int unsigned NOT NULL DEFAULT 0,
    `language` varchar
(
    7
) NOT NULL DEFAULT '*',
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    `modified_by` int unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE =utf8mb4_unicode_ci;


--{{inject: install_table}}