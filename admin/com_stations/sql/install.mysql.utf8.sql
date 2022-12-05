CREATE TABLE IF NOT EXISTS `#__stations_destinations` (
                                                          `id` int(11) NOT NULL AUTO_INCREMENT,
                                                          `name` varchar(100)  NOT NULL DEFAULT '',
                                                          `alias` varchar(100)  NOT NULL DEFAULT '',
                                                          `address` varchar(100)  NOT NULL DEFAULT '',
                                                          `zipcode` varchar(10)  NOT NULL DEFAULT '',
                                                          `town` varchar(100) NOT NULL DEFAULT '',
                                                          `www` varchar(100) NOT NULL DEFAULT '',
                                                          `livestream` varchar(100) NOT NULL DEFAULT '',
                                                          `catid` int(11) NOT NULL DEFAULT 0,
                                                          `frn_id` int(5) NULL DEFAULT NULL,
                                                          `reception` text NOT NULL DEFAULT '',
                                                          `lat` varchar(200) NOT NULL DEFAULT '',
                                                          `long` varchar(200) NOT NULL DEFAULT '',
                                                          `published` tinyint(1) NOT NULL DEFAULT 0,
                                                          `checked_out` int(11) NOT NULL DEFAULT 0,
                                                          `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                                                          `txt` text NOT NULL DEFAULT '',
                                                          `picture` varchar(255) NOT NULL DEFAULT '',
                                                          `assign_routeplanning` tinyint(1) NOT NULL DEFAULT 1,
                                                          `ordering` int(11) NOT NULL DEFAULT 0,
                                                          `created_by` int(11) NOT NULL DEFAULT 0,
                                                          `country` int(11) NOT NULL DEFAULT 33,
                                                          `access` int(11) NOT NULL DEFAULT 0,
                                                          `language` varchar(7) NOT NULL DEFAULT '',
                                                          `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                                                          `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                                                          `modified_by` INT(11) NOT NULL DEFAULT 0
)