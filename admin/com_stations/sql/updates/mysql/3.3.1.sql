ALTER TABLE `#__stations_destinations` CHANGE `mhz` `reception` TEXT DEFAULT '' NOT NULL;
UPDATE `#__stations_destinations` SET mhz=CONCAT(`mhz`, ' Mhz') WHERE SUBSTRING(`mhz`, -3,3) NOT LIKE '%mhz%';