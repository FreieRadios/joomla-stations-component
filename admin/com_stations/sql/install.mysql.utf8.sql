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
    `access` int unsigned NOT NULL DEFAULT 0,
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


INSERT INTO `#__stations_destination` (`id`, `name`, `alias`, `address`, `zipcode`, `town`, `www`, `livestream`,
                                        `catid`, `frn_id`, `mhz`, `lat`, `long`, `published`, `checked_out`,
                                        `checked_out_time`, `txt`, `picture`, `assign_routeplanning`, `ordering`,
                                        `created_by`, `country`, `access`, `language`, `created`, `modified`,
                                        `modified_by`)
VALUES (1, 'bermuda.funk', '', 'Brückenstraße 2', '68167', 'Mannheim', 'http://www.bermudafunk.org',
        'http://streaming.fueralle.org:8000/bermudafunk.ogg.m3u', 33, 2, '105,4  & 89,6 ', '49.4956072', '8.4736773', 1,
        1, '0000-00-00 00:00:00', '', '', 1, 1, 62, 33, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (3, 'Freies Radio Freistadt', '', 'Salzgasse 25', '4240', 'Freistadt', 'http://www.radio-frei.de', '', 3, 0,
        '96,2 ', '48.5126244', '14.5034286', 1, 1, '0000-00-00 00:00:00', '', '', 1, 36, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (5, 'Radio Quer', '', 'Postfach 3048 ', '55020 ', 'Mainz ', 'http://www.radio-quer.de/', '', 53, 49, '92,5 ',
        '50.0701127', '8.2250201', 1, 1, '0000-00-00 00:00:00',
        '<p>Sendet im Sendefenster von \"Lokalradio Wiesbaden\" (Hessen)</p>', '', 1, 3, 62, 53, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (7, 'Radio Dreyeckland', '', 'Adlerstr. 12', '79098', 'Freiburg', 'http://www.rdl.de',
        'http://www.rdl.de:8000/rdl.m3u', 33, 39, '102,3 ', '47.9932791', '7.8408055', 1, 1, '0000-00-00 00:00:00', '',
        '', 1, 5, 62, 33, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (9, 'Radio T', '', 'Mühlenstraße 94', '09111', 'Chemnitz', 'http://www.radiot.de', '', 57, 91, '102,7',
        '50.8399403', '12.9246719', 1, 1, '0000-00-00 00:00:00', '', '', 1, 4, 62, 57, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (11, 'Radio free FM', '', 'Platzgasse 18', '89073', 'Ulm', 'http://www.freefm.de', 'http://www.freefm.de/stream',
        33, 7, '102,6 ', '48.4005835', '9.9909837', 1, 1, '0000-00-00 00:00:00', '', '', 1, 6, 62, 33, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (13, 'Freies Radio Freudenstadt', '', 'Forststraße 23', '72250', 'Freudenstadt', 'http://www.radio-fds.de', '',
        33, 9, '100,0 & 104,1 ', '48.466897', '8.41078', 1, 1, '0000-00-00 00:00:00', '', '', 1, 7, 62, 33, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (15, 'Freies Radio für Stuttgart', '', 'Stöckachstr. 16a', '70190', 'Stuttgart', 'www.freies-radio.de',
        'https://frs.kumbi.org/homepage/empfang.php', 33, 10, '99,2  ', '48.7901158', '9.197543', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 8, 62, 33, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (17, 'Freies Radio Wiesental', '', 'Hauptstrasse 82', '79650 ', 'Schopfheim',
        'http://www.freies-radio-wiesental.de', 'http://radio.freies-radio-wiesental.de:8000/frw-hi.m3u', 33, 18,
        '104,5 ', '47.6508763', '7.8234545', 1, 1, '0000-00-00 00:00:00', '', '', 1, 9, 62, 33, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (19, 'Radio StHörfunk', '', 'Haalstr. 9', '74523 ', 'Schwäbisch Hall', 'http://www.sthoerfunk.de',
        'http://stream.sthoerfunk.de:7000/sthoerfunk.ogg.m3u', 33, 62, '97,5 ', '49.111761', '9.7361773', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 10, 62, 33, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (21, 'Wüste Welle', '', 'Hechinger Str. 203', '72072 ', 'Tübingen', 'http://www.wueste-welle.de',
        'http://rs3.radiostreamer.com:8870/listen.pls', 33, 67, '96,6 ', '48.4994285', '9.0629581', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 12, 62, 33, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (23, 'Querfunk', '', 'Steinstraße 23', '76133', 'Karlsruhe ', 'http://www.querfunk.de',
        'http://www.querfunk.de/live.html', 33, 30, '104,8', '49.0070795', '8.4073858', 1, 1, '0000-00-00 00:00:00', '',
        '', 1, 11, 62, 33, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (25, 'Radio Z', '', 'Kopernikuspl. 12', '90459', 'Nürnberg', 'https://www.radio-z.net',
        'https://www.radio-z.net/Radio-Z.m3u', 35, 57, '95,8', '49.43936', '11.080779', 1, 1, '0000-00-00 00:00:00', '',
        '', 1, 13, 62, 35, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (27, 'Lora München', '', 'Schwanthalerstr. 81', '80336', 'München ', 'http://lora924.de',
        'http://lora924.de/?page_id=9', 35, 19, '92,4', '48.1277605', '11.6005703', 1, 1, '0000-00-00 00:00:00', '', '',
        1, 14, 62, 35, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (29, 'Onda', '', 'Köpenicker Str. 187/188', '10997', 'Berlin', 'http://www.npla.de/onda/index.html', '', 37, 68,
        '', '52.5022752', '13.4396431', 1, 1, '0000-00-00 00:00:00', '<p>(Internet-Projekt)</p>', '', 1, 15, 62, 37, 0,
        '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (37, 'Freies Sender Kombinat - FSK', '', 'Valentinskamp 34a', '20355', 'Hamburg', 'http://www.fsk-hh.org', '',
        43, 90, '93,0 ', '53.5600746', '9.9634747', 1, 1, '0000-00-00 00:00:00', '', '', 1, 19, 62, 43, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (39, 'Freies Radio Kassel', '', 'Opernstraße 2', '34117', 'Kassel', 'http://www.freies-radio-kassel.de', '', 45,
        11, '105,8 ', '51.3101164', '9.5245916', 1, 1, '0000-00-00 00:00:00', '', '', 1, 20, 62, 45, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (121, 'Pi-Radio', '', 'Lottumstraße 9/10', '10119', 'Berlin', 'www.piradio.de',
        'https://ice.rosebud-media.de:8000/88vier.m3u', 37, 129, 'Berlin 88,4 MHz / Potsdam 90,7', '52.53075',
        '13.4076', 1, 1, '0000-00-00 00:00:00', '', '', 1, 18, 0, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (43, 'Radio Unerhört Marburg', '', 'R.-Bultmann-Str. 2b', '35039', 'Marburg ', 'http://www.radio-rum.de',
        'http://www.radio-rum.de/stream', 45, 54, '90,1 ', '50.8158711', '8.7798507', 1, 1, '0000-00-00 00:00:00', '',
        '', 1, 22, 62, 45, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (45, 'RundFunk Meißner (RFM)', '', 'Mangelgasse 19', ' 37269 ', 'Eschwege ', 'radiorfm.de',
        'https://rfmhome.ddns.net/webstream-2', 45, 71, '99,7 MHz, in Witzenhausen 96,5', '51.177827', '10.0485055', 1,
        1, '0000-00-00 00:00:00', '', '', 1, 23, 62, 45, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (47, 'LOHRO', '', 'Friedrichstraße 23', '18057', 'Rostock', 'www.lohro.de', 'stream.lohro.de:8000/lohro.mp3', 47,
        96, '90,2', '54.0877018', '12.1154305', 1, 1, '0000-00-00 00:00:00', '', '', 1, 2, 62, 47, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (49, 'Radio Flora', '', 'Zur Bettfedernfabrik 1', ' 30451 ', 'Hannover ', 'www.radioflora.de',
        'https://www.radioflora.de/stream/', 49, 6, '106,5 ', '52.3761411', '9.7098726', 1, 1, '0000-00-00 00:00:00',
        '<p><em>(Internet-Radio)</em></p>', '', 1, 24, 62, 49, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (125, 'Freies BürgerRadio Słubfurt', '', 'Lindenstraße 6', '15230', 'Słubfurt [Frankfurt (Oder) / Słubice]',
        'www.radio.slubfurt.net', 'http://www.radio.slubfurt.net/player/player.html', 39, 156, '91,7', '', '', 1, 1,
        '0000-00-00 00:00:00',
        '<p><em> </em></p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -106px; top: -20.0028px;\"> </div>',
        '', 1, 1, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (127, 'Radio Fratz', '', 'Große Str. 4 Hinterhof 1OG Rechts', '24937', 'Flensburg', 'radio-fratz.de',
        'https://stream.radio-fratz.de/', 61, 0, '98,5', '', '', 1, 1, '0000-00-00 00:00:00', '', '', 1, 33, 0, 0, 0,
        '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (57, 'Radio Blau', '', 'Paul-Gruner-Str. 62', ' 04107 ', 'Leipzig ', 'http://www.radioblau.de',
        'http://www.radioblau.de/index.php?z=ar14&r=m1', 57, 37, '99,2 / 94,4 / 89,2 ', '51.3290274', '12.3699748', 1,
        1, '0000-00-00 00:00:00', '', '', 1, 28, 62, 57, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (59, 'coloRadio', '', 'Riesaer Straße 32', '01127', 'Dresden', 'http://www.coloradio.org',
        'http://217.172.183.184/live.pls', 57, 4, '98,4 / 99,3 ', '51.0687067', '13.7494385', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 29, 62, 57, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (61, 'Radio Corax', '', 'Unterberg 11', ' 06108', ' Halle (Saale)', 'http://www.radiocorax.de',
        'http://217.172.183.184:8000/corax.mp3.m3u', 59, 38, '95,9', '51.4878141', '11.9704054', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 30, 62, 59, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (63, 'Freie RadioCoope&shy;rative Husum', '', 'Süderstr. 136a,', '25813', 'Husum',
        'http://www.westkuestenet.de/husum9.htm', '', 61, 8, '97,6 & 98,8 ', '54.4770411', '9.0614222', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 31, 62, 61, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (65, 'Radio FREI', '', 'Gotthardtstr. 21', '99084', 'Erfurt', 'http://www.radio-frei.de',
        'http://streaming.fueralle.org:8000/Radio-F.R.E.I.m3u', 63, 40, '96,2', '50.980035', '11.031995', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 32, 62, 63, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (67, 'Radio 3FACH', '', 'Zürichstrasse 49', '6004', 'Luzern', 'http://www.3fach.ch/', '', 4, 32,
        '96.2 und 97.7 ', '47.0587771', '8.3092309', 1, 1, '0000-00-00 00:00:00', '', '', 1, 1, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (69, 'Radio Kaiseregg', '', 'Juchstrasse 8', '1712', 'Tafers', 'http://www.kaiseregg.ch', '', 4, 106,
        '106.5 und 105.0 ', '46.8117481', '7.2186238', 1, 1, '0000-00-00 00:00:00', '', '', 1, 2, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (71, 'Kanal K', '', 'Rohrerstrasse 20', '5001', 'Aarau ', 'http://www.kanalk.ch', '', 4, 17,
        '94.9, 103.4 u. 92.2 ', '47.3939893', '8.0583565', 1, 1, '0000-00-00 00:00:00', '', '', 1, 3, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (73, 'Radio LoRa', '', 'Militärstrasse 85a', '8004', 'Zürich', 'http://www.lora.ch/',
        'http://www.lora.ch/webradio.php', 4, 46, '97.5 ', '47.3784408', '8.5294572', 1, 1, '0000-00-00 00:00:00', '',
        '', 1, 4, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (75, 'Radio RaBe', '', 'Randweg 21', '3013', 'Bern', 'http://www.rabe.ch/',
        'http://www.rabe.ch/webradio/webradio.html', 4, 50, '104.6 ', '46.958', '7.4432962', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 5, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (77, 'Radio Rasa', '', 'Mühlenstrasse 40', '8200', 'Schaffhausen', 'http://www.rasa.ch/', '', 4, 60, '187.2 ',
        '47.6931866', '8.6279105', 1, 1, '0000-00-00 00:00:00', '', '', 1, 6, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (79, 'toxic.fm', '', 'Engelaustrasse 15', '9010', 'St.Gallen ', 'http://www.toxic.fm', '', 4, 0, '107.1 ',
        '47.4374856', '9.378405', 1, 1, '0000-00-00 00:00:00', '', '', 1, 7, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (81, 'Radio X', '', 'Spitalstrasse 2', '4056', 'Basel', 'http://www.radiox.ch', '', 4, 112, '94.5 ',
        '47.5621965', '7.5847163', 1, 1, '0000-00-00 00:00:00', '', '', 1, 8, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (83, 'Radio Cité', '', '36 av. du Cardinal-Mermillod', '1227', 'Carouge', 'http://www.radiocite.ch', '', 4, 0,
        '92.2 ', '46.1852737', '6.1441215', 1, 1, '0000-00-00 00:00:00', '', '', 1, 9, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (85, 'Agora', '', 'Paracelsusgasse 14', '9020', 'Klagenfurt', 'http://www.agora.at', '', 3, 33, '105.5 ',
        '46.6393377', '14.2980944', 1, 1, '0000-00-00 00:00:00', '', '', 1, 33, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (87, 'aufdraht', '', 'Haindorferstr. 17', '3550', 'Langenlois', 'http://www.aufdraht.org', '', 3, 0, '',
        '48.4802942', '15.6886863', 1, 1, '0000-00-00 00:00:00', '', '', 1, 34, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (89, 'Campusradio', '', 'Herzogenburgerstraße 68', '3100', 'St. Pölten', 'http://www.campusradio.at', '', 3, 0,
        '94.4 ', '48.2146495', '15.6372747', 1, 1, '0000-00-00 00:00:00', '', '', 1, 35, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (91, 'FREIRAD', '', 'Höttingergasse 31', '6020', 'Innsbruck', 'http://www.freirad.at', '', 3, 123, '105.9 ',
        '47.2699303', '11.3882643', 1, 1, '0000-00-00 00:00:00', '', '', 1, 37, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (93, 'Freies Radio Salzkam&shy;mer&shy;gut', '', 'Lindaustraße 28', '4820', 'Bad Ischl',
        'http://www.freiesradio.at', '', 3, 0, '100.2 / 107.3 / 104.2 / 107.5 ', '47.7098505', '13.604235', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 38, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (95, 'Radio Y', '', 'Josef Weisleinstraße 5', '2020', 'Hollabrunn', 'http://www.gymradio.at', '', 3, 0,
        '94.5 / 102.2 ', '48.5601538', '16.0739905', 1, 1, '0000-00-00 00:00:00', '', '', 1, 39, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (97, 'MORA', '', 'Parkgasse 3', '7304', 'Großwarasdorf', '', '', 3, 0, '', '47.5393999', '16.5542407', 1, 1,
        '0000-00-00 00:00:00', '', '', 1, 40, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (99, 'Orange', '', 'Klosterneuburger Str. 1', '1200', 'Wien', 'http://www.o94.at',
        'http://www.mp3.at/playlists/orange.m3u', 3, 81, '94', '48.2269996', '16.3692102', 1, 1, '0000-00-00 00:00:00',
        '', '', 1, 41, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (101, 'Radiofabrik', '', 'Josef-Preis-Allee 16', '5020 ', 'Salzburg', 'http://www.radiofabrik.at', '', 3, 59,
        '107.5 ', '47.7941508', '13.0561288', 1, 1, '0000-00-00 00:00:00', '', '', 1, 43, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (103, 'PRO-TON', '', 'Dr. Anton Schneider Straße 11/1', '6850', 'Dornbirn', 'http://www.radioproton.at', '', 3,
        29, '104.6 / 95.9 ', '47.4219814', '9.7480457', 1, 1, '0000-00-00 00:00:00', '', '', 1, 42, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (105, 'Radio B 138', '', 'Bahnhofstrasse 11', '4560 ', 'Kirchdorf', 'http://www.radio-b138.at', '', 3, 0, '138',
        '47.9050475', '14.1199082', 1, 1, '0000-00-00 00:00:00', '', '', 1, 44, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (107, 'Radio FREEQUENNS ', '', 'Kulturhausstraße 9', '8940', 'Liezen', 'http://www.freequenns.at', '', 3, 134,
        '100.8 ', '47.5666507', '14.241589', 1, 1, '0000-00-00 00:00:00', '', '', 1, 45, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (109, 'Radio FRO', '', 'Kirchengasse 4', '4040', 'Linz', 'http://www.fro.at',
        'http://www.fro.at/audio/audio.html', 3, 89, '105.0 ', '48.3101629', '14.2846074', 1, 1, '0000-00-00 00:00:00',
        '', '', 1, 46, 62, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (111, 'Radio Helsinki', '', 'Griesgasse 8 - Lindenpassage', '8020', 'Graz', 'http://www.helsinki.at', '', 3, 43,
        '92.6 ', '47.0703645', '15.4114059', 1, 1, '0000-00-00 00:00:00', '', '', 1, 47, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (113, 'Fréquence Banane', '', 'Centre-Est, EPFL, Station 1', '1015', 'Lausanne', 'http://www.frequencebanane.ch',
        '', 4, 0, '94,55 (Kabel)', '46.5235599', '6.5836548', 1, 1, '0000-00-00 00:00:00', '', '', 1, 10, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (115, 'Radio Industrie', '', 'Industriestrasse 45', '6302', 'Zug', 'http://www.radioindustrie.ch', '', 4, 0,
        '101.65', '47.1822171', '8.520759', 1, 1, '0000-00-00 00:00:00', '', '', 1, 11, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (117, 'Radio Stadtfilter', '', 'Turnerstrasse 1', '8400', 'Winterthur', 'http://www.stadtfilter.ch', '', 4, 125,
        '96.3', '47.5003808', '8.7252598', 1, 1, '0000-00-00 00:00:00', '', '', 1, 12, 62, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (119, 'vibration 108', '', 'Case Postale 2344', '1950', 'Sion', 'http://www.vibration108.ch', '', 4, 0, '108',
        '46.2270208', '7.3533351', 1, 1, '0000-00-00 00:00:00', '', '', 1, 13, 62, 0, 0, '', '0000-00-00 00:00:00',
        '0000-00-00 00:00:00', 0),
       (123, 'Punksender', '', 'Postfach 190242', '50499', 'Köln', 'http://www.punksender.de/',
        'http://www.punksender.de/punksender.m3u', 51, 0, '', '50.938056', '6.956944', 1, 1, '0000-00-00 00:00:00',
        '<p>(Internet-Radio)</p>', '', 1, 28, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (128, 'Frrapó - Freies Radio Potsdam', '', 'Friedrich-Engels-Str. 22', '14473', 'Potsdam',
        'http://www.frrapo.de',
        'http://frrapo.de/player/switch.php?swi=stop&str1=ttp://ice.rosebud-media.de:8000/88vier-ogg1.ogg&str', 39, 149,
        'Potsdam 90,7 MHz / Berlin 88,4', '52.389500', '13.077972', 1, 1, '0000-00-00 00:00:00', '', '', 1, 2, 62, 0, 0,
        '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (126, 'Freies Radio Neumünster', '', 'Großflecken 32', '24534', 'Neumünster', 'http://www.freiesradio-nms.de',
        'http://streaming.fueralle.org:8000/frn', 61, 0, '100,8', '', '', 1, 1, '0000-00-00 00:00:00', '', '', 1, 32, 0,
        0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (129, 'Freies Radio Berlin', '', 'Kreutziger Straße 23', '10247', 'Berlin', '', '', 37, 0,
        'Potsdam 90,7 MHz / Berlin 88,4', '', '', 1, 1, '0000-00-00 00:00:00', '', '', 1, 19, 0, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (130, 'Radio Woltersdorf', '', 'Schleusenstraße 34', '15569', 'Woltersdorf', 'www.radio-woltersdorf.org', '', 39,
        0, 'Potsdam 90,7 MHz / Berlin 88,4', '', '', 1, 1, '0000-00-00 00:00:00', '', '', 1, 3, 0, 0, 0, '',
        '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
       (131, 'Radio Ginseng', '', 'Mönchwinkeler Weg 10', '15537', 'Grünheide (Mark)', 'radioginseng.de', '', 39, 0, '',
        '', '', 1, 1, '0000-00-00 00:00:00', '', '', 1, 4, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00',
        0);


--{{inject: install_table}}