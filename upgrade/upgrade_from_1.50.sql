ALTER TABLE hlstats_Events_Frags ADD INDEX ( victimId );
ALTER TABLE hlstats_Events_Frags ADD INDEX ( killerId );
ALTER TABLE hlstats_Events_Frags ADD INDEX ( weapon );
ALTER TABLE hlstats_Weapons ADD INDEX ( code );
ALTER TABLE `hlstats_Events_Frags` ADD INDEX ( `map` )  ;
ALTER TABLE `hlstats_Players` ADD `skillchangeDate` INT( 10 ) NULL AFTER `oldSkill` ;
ALTER TABLE `hlstats_Players` ADD `active` INT( 1 ) NOT NULL DEFAULT '1' AFTER `skillchangeDate` ;
ALTER TABLE `hlstats_Players` ADD INDEX ( `active` ) ;
ALTER TABLE `hlstats_Players` ADD INDEX ( `hideranking` );
ALTER TABLE `hlstats_Events_PlayerActions` ADD INDEX ( `actionId` );
ALTER TABLE `hlstats_Events_PlayerActions` ADD INDEX ( `playerId` );
ALTER TABLE `hlstats_Events_PlayerActions` ADD INDEX ( `serverId` );
ALTER TABLE `hlstats_Events_PlayerPlayerActions` ADD INDEX ( `serverId` );
ALTER TABLE `hlstats_Events_PlayerPlayerActions` ADD INDEX ( `playerId` );
ALTER TABLE `hlstats_Events_PlayerPlayerActions` ADD INDEX ( `victimId` );
ALTER TABLE `hlstats_Events_PlayerPlayerActions` ADD INDEX ( `actionId` );