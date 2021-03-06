#
# HLstats Game Support file for Left 4 Dead
# ----------------------------------------------------
#
# If you want to insert this manually and not via the admin interface
# replace ++DB_PREFIX++ with the current table prefix !
# and import this into your hlstats database


#
# Game Definition
#
INSERT IGNORE INTO `++DB_PREFIX++_Games` VALUES ('l4d','Left 4 Dead','1','0');

#
# Awards
#
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES (NULL,'W','tf2','autoshotgun','Auto Shotgut','Kills with autoshotgut',NULL,NULL);
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES (NULL,'W','tf2','boomer_claw','Boom!','kills with Boomer\'s Claws',NULL,NULL);
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES (NULL,'W','tf2','hunter_claw','Open Season','kills with Hunter\'s Claws',NULL,NULL);
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES (NULL,'W','tf2','smoker_claw','Chain Smoker','kills with Smoker\'s Claws',NULL,NULL);
INSERT IGNORE INTO `++DB_PREFIX++_Awards` VALUES (NULL,'W','tf2','tank_claw','Burger Tank','kills with Taker\'s Claws',NULL,NULL);

#
# Actions
#
#INSERT INTO `++DB_PREFIX++_Actions` VALUES(116, 'l4d', 'builtobject_OBJ_ATTACHMENT_SAPPER', 1, 0, '', 'Built Object - Attachment Sapper', '1', '0', '0', '0');

#
# Teams
# 
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'l4d','Infected','Infected','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'l4d','Survivor','Survivor','0');
INSERT IGNORE INTO `++DB_PREFIX++_Teams` VALUES (NULL,'l4d','Spectator','Spectator','0');

#
# Roles
#
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','Manager','Manager','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','Biker','Biker','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','EXPLODING','Exploding','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','GAS','Gas','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','HUNTER','Hunter','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','NamVet','Bill','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','TANK','Tank','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','TeenGirl','Teen Girl','0');
INSERT IGNORE INTO `++DB_PREFIX++_Roles` VALUES (NULL,'l4d','Unknown','Unknown','0');

#
# Weapons
#
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','autoshotgun','Auto Shotgun',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','hunting_rifle','Hunting Rifle',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','infected','Infected Horde',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','pipe_bomb','Pipe Bomb',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','player','Player',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','prop_physics','Prop Physics',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','rifle','M16 Assault Rifle',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','witch','Witch\'s Claws',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','world','world',1.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','inferno','Molotov/Gas Can Fire',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','prop_minigun','Mounted Machine Gun',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','smg','Uzi',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','pumpshotgun','Pump Shotgun',1.30);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','first_aid_kit','First Aid Kit Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','gascan','Gas Can Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','molotov','Molotov Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','oxygentank','Oxygen Tank Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','pain_pills','Pain Pills Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','propanetank','Propane Tank Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','tank_rock','Tank\s Rock',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','dual_pistols','Dual Pistols',1.60);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','pistol','Pistol',2.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','boomer_claw','Boomer\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','entityflame','Blaze',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','hunter_claw','Hunter\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','smoker_claw','Smoker\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','tank_claw','Tank\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','spitter_claw','Spitter\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','jockey_claw','Jockey\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','charger_claw','Charger\'s Claws',3.00);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','vomitjar','Vomit Jar Smash',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','upgradepack_incendiary','Incendiary Pack Smash',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','upgradepack_explosive','Explosive Pack',1.20);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','tonfa','Tonfa',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','katana','Katana',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','insect_swarm','Insect Swarm',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','grenade_launcher','Grenade Launcher Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','golfclub','Golf Club',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','gnome','Gnome Smash',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','frying_pan','Frying Pan',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','first_aid_kit','First Aid Kit',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','fireworkcrate','Fireworks Crate',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','fireaxe','Fireaxe',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','env_fire','Fire',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','env_explosion','Explosion',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','electric_guitar','Electric Guitar',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','defibrillator','Defibrillator',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','crowbar','Crowbar',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','cricket_bat','Cricket Bat',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','cola_bottles','Cola Bottles',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','baseball_bat','Baseball Bat',1.50);
INSERT IGNORE INTO `++DB_PREFIX++_Weapons` VALUES (NULL,'l4d','adrenaline','Adrenaline Smash',1.50);

# end of file